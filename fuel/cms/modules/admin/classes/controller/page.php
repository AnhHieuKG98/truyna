<?php
namespace Admin;
class Controller_Page extends \Controller_Backend
{
  public $categories_tree;
 public $module_name = "page";
  public function before(){
    parent::before();
    \Module::load('page');
    $form_buttons_data = array(
      "back_link"  => 'admin/page'
    );
    $this->template->set_global('form_buttons', \View::forge("common/form_buttons",$form_buttons_data));
    //get categories
    $params = array('parent_id'=>'0');#,'frefix'=>""
		$_categories = \Page\Model_Page_Category::fn_get_categories($params);
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
          $models = \Page\Model_Page_Post::query()->where('id','in',$table_records)->get();
          foreach($models as $model){
            if(!empty($models)){
              \Page\Model_Page_Category_Post::query()->where('post_id', $model['id'])->delete();
              $model->delete();
            }
          }
          \Response::redirect('admin/page');
        }
      }#elseif(Input::post("update_form")){
        else{#chỉ cần enter hoặc bấm vào update form nhưng update form phải để đầu tiên
        $position = \Input::post("position");
        
        foreach($position as $obj=>$_position){
          $update = \Page\Model_Page_Post::find($obj);
          #print_r($update);exit;
          $update->position = $_position; 
       
          $update->save();
         
        }
        \Response::redirect('admin/page');
      }
    }
    $params = \Input::get();
    $query = \Page\Model_Page_Post::query()->order_by('created_at','desc')->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    
    if(!empty($params['s'])){
      $s = $params['s'];
          

      $query->or_where_open();
      $query->where("lang.title","like","%$s%");
      $query->or_where("lang.summary","like","%$s%");
      $query->or_where_close();
    }
    if(!empty($params['cid'])){
      //join to table page_categories_posts
      $subcats = \Page\Model_Page_Category::get_subcats($params['cid']);
      $subcats[] = $params['cid'];
      $query->related('page_categories_posts')->related('page_categories_posts.page_post')->where('page_categories_posts.category_id',"IN",$subcats);
    }
    if(!empty($params['status'])){
      $query->where("status","=",$params['status']);
    }
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap3',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => $this->posts_per_page,
      #'uri_segment'    => 3,
    ),"bootstrap3");
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);
    #$file_page_cache = 'backend.page.posts.'.md5("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]").\Lang::get_lang();

    #try
    #{
    #    $models = \Cache::get($file_page_cache);

    #}
    #catch (\CacheNotFoundException $e)
    #{
    $models = $query->get();
    #echo \DB::last_query();exit;
    foreach($models as &$model){
      $blog_image_width_small = \Registry::get_setting("appearance.blog_image_width_small");
      $blog_image_height_small = \Registry::get_setting("appearance.blog_image_height_small");
      $model->image_small_grid = \Simage::get_image_size("page",$model["id"],"p","A",$blog_image_width_small,$blog_image_height_small);
    }
    #\Cache::set($file_page_cache, $models);
    #}
    
    $data['model'] = $models;
    $this->template->set_global('pagination',$pagination,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    $this->template->title = "Posts";
    $this->template->content = \View::forge('modules/page/index', $data);
    $content = \View::forge('modules/page/index', $data);
    $this->theme->get_template()->set('title', 'Page');
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
				$model = \Page\Model_Page_Post::forge(array(
					
					'slug' => $slug,
					'user_id' => \Auth::get('id'),//Input::post('user_id'),
          'status' => \Input::post('status'),
          'image' => \Input::post('image'),
          'position' => \Input::post('position'),
          'og_image' => \Input::post('og_image'),
				));
				if ($model and $model->save()){
          //save langs
          
          //save langs 
          $langs = fn_get_langs();
          foreach($langs as $lang){
            \Page\Model_Page_Post_Lang::forge(array(
              'post_id'           => $model->id,
              'lang_code'         => $lang,
              'title'             => \Input::post('title'),
              'summary'           => \Input::post('summary'),
              'body'              => \Input::post('body'),
              'block'             => \Input::post('block'),
              'caption'           => \Input::post('caption'),
              'meta_keywords'     => \Input::post('meta_keywords'),
              'meta_description'  => \Input::post('meta_description'),
              #'data_1'             => \Input::post('data_1'),
              #'data_2'             => \Input::post('data_2'),
              #'data_3'             => \Input::post('data_3'),
            ))->save();
          }
          
          cms_upload_image($model->id,$this->module_name);
          
          //insert into table[page_categories_posts]
          foreach($category_data_selected as $category_id){
            \Page\Model_Page_Category_Post::forge(array(
              'category_id' => $category_id,
              'post_id' => $model->id,
            ))->save();
          }
					\Session::set_flash('success', e('Added post #'.$model->id.'.'));
					$submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/page');
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/page/edit/'.$model->id);
				}else{
					\Session::set_flash('error', e('Could not save post.'));
				}
			}else{
				\Session::set_flash('error', $val->error());
			}
      $this->template->set_global('category_data_selected', $category_data_selected);
		}
    $content = \View::forge('modules/page/create');
    $this->theme->get_template()->set('title', 'Add Post');
    $this->theme->get_template()->set('content', $content);
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);

    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);
	}

	public function action_edit($id = null)
	{
    $model = \Page\Model_Page_Post::find($id,array('related' => array(
          "lang"=>array(
            "where" => array(
              "lang_code" => \Lang::get_lang(),
              "post_id" => $id,
            ),
          )
        )
      )
    );#->to_array()
    $blog_image_width = \Registry::get_setting("appearance.blog_image_width");
    $blog_image_height = \Registry::get_setting("appearance.blog_image_height");
    $model->image_main_grid = \Simage::get_image_size("page",$model["id"],"p","A",$blog_image_width,$blog_image_height);
    $model->image_banner = \Simage::get_image_size("page",$model["id"],"p","B",250,100);

    
    
    //json data
    if($model["id"] == 1){ // trang about
      $data_4_string = (string)$model->lang->data_4;
      
      $model->lang->data_4_array = array();
      if(!empty($data_4_string)){
        $model->lang->data_4_array = \Format::forge($data_4_string, 'json')->to_array();
        #print_r($model->lang->data_4_array);exit;
      }
    }
    
    
    
    $data = array();
    $data['model'] = $model;
    #get categories_posts
    $category_data_selected = array();
    $columns = array('category_id','post_id');
    $categories_posts = \DB::select_array($columns)->from('page_categories_posts')->where('post_id','=',$id)->execute()->as_array();
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
          //save lang 
          /*
          $model->lang->title = \Input::post('title');
          $model->lang->summary = \Input::post('summary');
          $model->lang->body = \Input::post('body');
          $model->lang->meta_keywords = \Input::post('meta_keywords');
          $model->lang->meta_description = \Input::post('meta_description');
          */
          $query = \DB::update('page_posts_lang')->where("post_id",$id)->where("lang_code",\Lang::get_lang());
          $query->set(array(
            'title' => \Input::post('title'),
            'summary' => \Input::post('summary'),
            'body' => \Input::post('body'),
            'block' => \Input::post('block'),
            'caption' => \Input::post('caption'),
            'meta_keywords' => \Input::post('meta_keywords'),
            'meta_description' => \Input::post('meta_description'),
          ));//->execute();
          
          if($id==1){
            $data_4 = \Input::post('data4');
            $data_4_json = json_encode($data_4,JSON_FORCE_OBJECT);
            
            $query->set(array(
              'data_1' => \Input::post('data_1'),
              'data_2' => \Input::post('data_2'),
              'data_3' => \Input::post('data_3'),
              'data_4'  => $data_4_json,
            ));
          }
          $query->execute();
          
          //ảnh banner 
          cms_upload_image($id,$this->module_name);
          
          
          \Session::set_flash('success', e('Updated post #' . $id));
          \Page\Model_Page_Category_Post::query()->where('post_id', $id)->delete();
          foreach($category_data_selected as $category_id){
            \Page\Model_Page_Category_Post::forge(array(
              'category_id' => $category_id,
              'post_id' => $id,
            ))->save();
          }
          
          $submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/page');
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/page/edit/'.$id);
        }else{
					\Session::set_flash('error', e('Could not save post.'));
				}
      }else{
				\Session::set_flash('error', $val->error());
			}
    }
    
    
    //giành cho page có form 
    $page_form = \Page\Model_Page_Form::find("first",array(
      'where' => array("page_id"=>$model->id),
      "related" => array(
        "fields"  => array(
          "related" => array(
            "lang"  => array("where"=>array("lang_code"=>\Lang::get_lang()))
          )
        )
      ),
    ));#->to_array()
    if(!empty($page_form)){
      //get page_form_data
      $page_form = $page_form->to_array();
      $form_id = $page_form["id"];
      $email_submit = \DB::select("lang_code","email")->from("page_form_data")->where("form_id",$form_id)->execute()->as_array();
      $list_email = array();
      foreach($email_submit as $data_submit){
        if(!empty(trim($data_submit["email"]))){
          $list_email[$data_submit["lang_code"]][$data_submit["email"]] = $data_submit["email"];
        }
      }
      $this->template->set_global('list_email', $list_email);
      
    }
    $content = \View::forge('modules/page/edit',$data);
    $this->theme->get_template()->set('title', 'Edit Post');
    $this->theme->get_template()->set('content', $content);
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);
    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);
	}

  

	public function action_delete($id = null)
	{
		if ($model = \Page\Model_Page_Post::find($id)){
      if($model->core=="Y"){
        \Session::set_flash('error', l('Could not delete post #').$id);
        \Response::redirect('admin/page');
      }
      \Page\Model_Page_Category_Post::query()->where('post_id', $id)->delete();
			$model->delete();
			\Session::set_flash('success', l('Deleted post #').$id);
		}else{
			\Session::set_flash('error', l('Could not delete post #').$id);
		}
		\Response::redirect('admin/page');
	}
}
