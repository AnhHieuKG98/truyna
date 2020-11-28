<?php
namespace Admin;
class Controller_News extends \Controller_Backend
{
  public $categories_tree;
  public $module_name = "news";
  public function before(){
    parent::before();
    
    
    \Module::load($this->module_name);
    \Config::load($this->module_name.'::config'); #OK 
    \Lang::load($this->module_name.'::backend');
    ####$this->module_name = \Config::get('module.name');//return name module 
    
    
    $form_buttons_data = array(
      "back_link"  => 'admin/'.$this->module_name
    );
    $this->template->set_global('form_buttons', \View::forge("common/form_buttons",$form_buttons_data));
    //get categories
    $params = array('parent_id'=>'0');#,'frefix'=>""
		$_categories = \News\Model_News_Category::fn_get_categories($params);
		$categories = array();
		\Helper::array_level1($_categories,$categories);
    #$categories = Helper::k2_array_for_select($categories,'id','title','frefix');
    $this->categories_tree = $categories;

    $this->template->set_global('categories_tree', $this->categories_tree);
  }
	public function action_index()
	{
    if (\Input::method() == 'POST')
		{
      if(\Input::post("delete_selected")){
        $table_records = \Input::post("table_records");
        if(!empty($table_records)){
          $models = \News\Model_News_Post::query()->where('id','in',$table_records)->get();
          foreach($models as $model){
            if(!empty($models)){
              \News\Model_News_Category_Post::query()->where('post_id', $model['id'])->delete();
              $model->delete();
            }
          }
          \Response::redirect('admin/'.$this->module_name);
        }
      }#elseif(Input::post("update_form")){
        else{#chỉ cần enter hoặc bấm vào update form nhưng update form phải để đầu tiên
        $position = \Input::post("position");
        
        foreach($position as $obj=>$_position){
          $update = \News\Model_News_Post::find($obj);
          #print_r($update);exit;
          $update->position = $_position; 
       
          $update->save();
         
        }
        \Response::redirect('admin/'.$this->module_name);
      }
    }
    $params = \Input::get();
    $query = \News\Model_News_Post::query()->order_by('created_at','desc')->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    
    if(!empty($params['s'])){
      $s = $params['s'];
          

      $query->or_where_open();
      $query->where("lang.title","like","%$s%");
      $query->or_where("lang.summary","like","%$s%");
      $query->or_where_close();
    }
    if(!empty($params['cid'])){
      $subcats = \News\Model_News_Category::get_subcats($params['cid']);
      $subcats[] = $params['cid'];
      $query->related($this->module_name.'_categories_posts')->related($this->module_name.'_categories_posts.'.$this->module_name.'_post')->where($this->module_name.'_categories_posts.category_id',"IN",$subcats);
    }
    if(!empty($params['status'])){
      $query->and_where_open();
      $query->where("status","=",$params['status']);
      $query->and_where_close();
    }
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap3',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => $this->posts_per_page,
      #'uri_segment'    => 3,
    ),"bootstrap3");
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);

    $models = $query->get();
    
    foreach($models as &$model){
      $image_width_small = 100;
      $image_height_small = 80;
      #$model->image_small_grid = \Simage::get_image_size($this->module_name,$model["id"],"p","A",$image_width_small,$image_height_small);
    }
    
    $data['model'] = $models;
    $this->template->set_global('pagination',$pagination,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    $this->template->title = "Posts";
    $this->template->content = \View::forge('modules/'.$this->module_name.'/index', $data);
    $content = \View::forge('modules/'.$this->module_name.'/index', $data);
    $this->theme->get_template()->set('title', 'News');
    $this->theme->get_template()->set('content', $content);
	}

	public function action_view($id = null)
	{
		$data['model'] = Model_Post::find($id);
		$this->template->title = "Post";
		$this->template->content = View::forge('modules/posts/view', $data);
	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
      $val = \Validation::forge();
      $val->add('title', 'Title')
			    ->add_rule('required');
      $this->template->set_global('val', $val);
      $category_data_selected = \Input::post('category_data') ? \Input::post('category_data') : array();
			if ($val->run())
			{
        $slug = \Input::post('slug');
        if(empty($slug)){
          $slug = \Helper::create_seo_name(\Input::post('title'));
        }
				$model = \News\Model_News_Post::forge(array(
					
					'slug' => $slug,
					'user_id' => \Auth::get('id'),//Input::post('user_id'),
          'status' => \Input::post('status'),
          #'image' => \Input::post('image'),
          'position' => \Input::post('position'),
          #'og_image' => \Input::post('og_image'),
				));
				if ($model and $model->save()){
          //save hình ảnh 
          cms_upload_image($model->id,$this->module_name);
          
          //save langs 
          $langs = fn_get_langs();
          foreach($langs as $lang){
            \News\Model_News_Post_Lang::forge(array(
              'post_id'           => $model->id,
              'lang_code'         => $lang,
              'title'             => \Input::post('title'),
              'summary'           => \Input::post('summary'),
              'summary2'           => \Input::post('summary2'),
              'body'              => \Input::post('body'),
              'meta_keywords'     => \Input::post('meta_keywords'),
              'meta_description'  => \Input::post('meta_description'),
            ))->save();
          }
         
          
          foreach($category_data_selected as $category_id){
            \News\Model_News_Category_Post::forge(array(
              'category_id' => $category_id,
              'post_id' => $model->id,
            ))->save();
          }
					\Session::set_flash('success', l('Added post #').$model->id);
          
					$submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/'.$this->module_name);
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/'.$this->module_name.'/edit/'.$model->id);
				}else{
					\Session::set_flash('error', l('Could not save post.'));
				}
			}else{
				\Session::set_flash('error', $val->error());
			}
      $this->template->set_global('category_data_selected', $category_data_selected);
		}
    $content = \View::forge('modules/'.$this->module_name.'/create');
    $this->theme->get_template()->set('title', 'Add Post');
    $this->theme->get_template()->set('content', $content);
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);

    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);
	}

	public function action_edit($id = null)
	{
    $model = \News\Model_News_Post::find($id,array('related' => array(
          "lang"=>array(
            "where" => array(
              "lang_code" => \Lang::get_lang(),
              "post_id" => $id,
            ),
          )
        )
      )
    );#->to_array()
    $image_width = 250;
    $image_height = 120;
    $model->image_main_grid = \Simage::get_image_size($this->module_name,$model["id"],"p","A",$image_width,$image_height);

    
    $data = array();
    $data['model'] = $model;
    #get categories_posts
    $category_data_selected = array();
    $columns = array('category_id','post_id');
    $categories_posts = \DB::select_array($columns)->from($this->module_name.'_categories_posts')->where('post_id','=',$id)->execute()->as_array();
    foreach($categories_posts as $_c){
      $category_data_selected[$_c['category_id']] = $_c['category_id'];
    }
    $this->template->set_global('category_data_selected', $category_data_selected);
    if (\Input::method() == 'POST'){
      $category_data_selected = \Input::post('category_data') ? \Input::post('category_data') : array();    #khi post
      $val = \Validation::forge();
      $val->add('title', 'Title')
			    ->add_rule('required');
      $this->template->set_global('val', $val);
      if ($val->run()){        
        $slug = \Input::post('slug');
        if(empty($slug)){
          $slug = \Helper::create_seo_name(\Input::post('title'));
        }
        $model->slug = $slug;
        $model->status = \Input::post('status');
        $model->image = \Input::post('image');
        $model->position = \Input::post('position');
        $model->og_image = \Input::post('og_image');
        
        
				if ($model->save()){
          //save hình ảnh 
          cms_upload_image($id,$this->module_name);
          
          $query = \DB::update($this->module_name.'_posts_lang')->where("post_id",$id)->where("lang_code",\Lang::get_lang());
          $query->set(array(
            'title' => \Input::post('title'),
            'summary' => \Input::post('summary'),
            'summary2' => \Input::post('summary2'),
            'body' => \Input::post('body'),
            'meta_keywords' => \Input::post('meta_keywords'),
            'meta_description' => \Input::post('meta_description'),
          ))->execute();
          
          
          
          
          \Session::set_flash('success', l('Updated post #').$id);
          \News\Model_News_Category_Post::query()->where('post_id', $id)->delete();
          foreach($category_data_selected as $category_id){
            \News\Model_News_Category_Post::forge(array(
              'category_id' => $category_id,
              'post_id' => $id,
            ))->save();
          }
          
          $submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/'.$this->module_name);
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/'.$this->module_name.'/edit/'.$id);
        }else{
					\Session::set_flash('error', l('Could not save post'));
				}
      }else{
				\Session::set_flash('error', $val->error());
			}
    }
    $content = \View::forge('modules/'.$this->module_name.'/edit',$data);
    $this->theme->get_template()->set('title', 'Edit Post');
    $this->theme->get_template()->set('content', $content);
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);
    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);
	}

  

	public function action_delete($id = null)
	{
		if ($model = \News\Model_News_Post::find($id)){
      
      \News\Model_News_Category_Post::query()->where('post_id', $id)->delete();
			$model->delete();
			\Session::set_flash('success', l('Deleted post #').$id);
		}else{
			\Session::set_flash('error', e('Could not delete post #'.$id));
		}
		\Response::redirect('admin/'.$this->module_name);
	}
}
