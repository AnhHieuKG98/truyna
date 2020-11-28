<?php
namespace Admin;
class Controller_Page_Category extends \Controller_Backend
{
  public function before(){
    parent::before();
    \Module::load('page');

    $form_buttons_data = array(
      "back_link"  => 'admin/page/category'
    );
    $this->template->set_global('form_buttons', \View::forge("common/form_buttons",$form_buttons_data));
  }
  public function action_index(){

    //Delete selected

    if (\Input::method() == 'POST')
		{
      #$delete_selected = Input::post("delete_selected");
      if(\Input::post("delete_selected")){
        $table_records = \Input::post("table_records");
        //remove bulk
        if(!empty($table_records)){
                $categories = \Page\Model_Page_Category::query()->where('id','in',$table_records)->get();

          foreach($categories as $category){
            if(!empty($category)){
              

              $parent_id_moved = $category['parent_id'];
              $category->delete();
              //moved categories childs to parent removed // chuyển toàn bộ danh mục con của nó tới làm con của cha nó
              $query = \DB::update('page_categories')->where('parent_id', $category['id']);
              // Set the columns
              $query->value('parent_id', $parent_id_moved)->execute();

            }
          }


          //remove cache
          ####Cache::delete('backend.page.categories.fulltree');
          \Response::redirect('admin/page/category');
        }



      }#elseif(Input::post("update_form")){
        else{#chỉ cần enter hoặc bấm vào update form nhưng update form phải để đầu tiên
        #update position
        $position = \Input::post("position");
        foreach($position as $obj=>$_position){
          $query_update = \Page\Model_Page_Category::query()->where('id','=',$obj)->get_one();
          $query_update->position = $_position;
          $query_update->save();
        }
        //remove cache
        ####Cache::delete('backend.page.categories.fulltree');
        \Response::redirect('admin/page/category');
      }
      #print_r(Input::post());exit;

    }

    $params = \Input::get();
    $data = array();

    #$query = \Page\Model_Page_Category::query();
    #$data['model'] = $query->get();


    //Tree categories
    #try
    #{
        #$categories = \Cache::get('backend.page.categories.fulltree');
    #}
   # catch (\CacheNotFoundException $e)
   # {
       $params = array('parent_id'=>'0');#,'frefix'=>""
        $_categories = \Page\Model_Page_Category::fn_get_categories($params);


        $categories = array();
        \Helper::array_level1($_categories,$categories);
        #\Cache::set('backend.page.categories.fulltree', $categories);#_fulltree
    #}
    $data['model'] = $categories;
    //


    $this->template->title = "Categories";
    $this->template->content = \View::forge('modules/page/category/index', $data);
    $content = \View::forge('modules/page/category/index', $data);

    $this->theme->get_template()->set('title', 'Page');
    $this->theme->get_template()->set('content', $content);
  }

  public function action_create(){
    $data = array();
    //
    $params = array('parent_id'=>'0');#,'frefix'=>""

		$_categories = \Page\Model_Page_Category::fn_get_categories($params);

		$categories = array();
		\Helper::array_level1($_categories,$categories);
    $categories = \Helper::k2_array_for_select($categories,'id','title','frefix');
    $data['categories'] = $categories;
    //end



    if (\Input::method() == 'POST')
		{
      $val = \Validation::forge();
      $val->add('title', 'Title')
			    ->add_rule('required');



      $this->template->set_global('val', $val);

			if ($val->run())
			{
        $slug = \Input::post('slug');
        if(empty($slug)){
          $slug = \Helper::create_seo_name(\Input::post('title'));
        }

				$category = \Page\Model_Page_Category::forge(array(
					
					'slug' => $slug,
					#'summary' => \Input::post('summary'),
          'status' => \Input::post('status'),
					#'body' => \Input::post('body'),
          'image' => \Input::post('image'),
          'position' => \Input::post('position'),
					'parent_id' => !empty(\Input::post('parent_id')) ? \Input::post('parent_id') : "0",
          #'meta_keywords' => \Input::post('meta_keywords'),
          #'meta_description' => \Input::post('meta_description'),
          'og_image' => \Input::post('og_image'),

				));

				if ($category and $category->save())
				{
          //save langs 
          $langs = fn_get_langs();
          foreach($langs as $lang){
            \Page\Model_Page_Category_Lang::forge(array(
              'category_id'       => $category->id,
              'lang_code'         => $lang,
              'title'             => \Input::post('title'),
              'body'              => \Input::post('body'),
              'summary'              => \Input::post('summary'),
              'meta_keywords'     => \Input::post('meta_keywords'),
              'meta_description'  => \Input::post('meta_description'),
            ))->save();
          }
          
          
					\Session::set_flash('success', e('Added post #'.$category->id.'.'));
          //remove cache
          ####Cache::delete('backend.page.categories.fulltree');

					\Response::redirect('admin/page/category');
				}

				else
				{
					\Session::set_flash('error', e('Could not save post.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

    $content = \View::forge('modules/page/category/create',$data);//->auto_filter();

    $this->theme->get_template()->set('title', 'Add Category');
    $this->theme->get_template()->set('content', $content);


    #đưa JS elfinder xuống footer
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);

    //JS nào cần sẽ đưa lên <head>
    #$assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    #$this->theme->get_partial('js_head', 'layouts/partials/js_head')->set('assets_js',$assets_js);

    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);

  }

  public function action_edit($id){

    $category = \Page\Model_Page_Category::find($id,array('related' => array(
          "lang"=>array(
            "where" => array(
              "lang_code" => \Lang::get_lang(),
            ),
          )
        )
      )
    );//->to_array();
    #print_r($category);exit;
    $data = array();
    $data['model'] = $category;

    //
    $params = array('parent_id'=>'0');#,'frefix'=>""
		$_categories = \Page\Model_Page_Category::fn_get_categories($params);
		$categories = array();
		\Helper::array_level1($_categories,$categories);
    $categories = \Helper::k2_array_for_select($categories,'id','title','frefix');
    $data['categories'] = $categories;
    //end
    



    if (\Input::method() == 'POST')
		{
      $val = \Validation::forge();
      $val->add('title', 'Title')
			    ->add_rule('required');



      $this->template->set_global('val', $val);

			if ($val->run())
			{
        $slug = \Input::post('slug');
        if(empty($slug)){
          $slug = \Helper::create_seo_name(\Input::post('title'));
        }

        $category->title = \Input::post('title');
        $category->slug = $slug;
        #$category->summary = \Input::post('summary');
        #$category->body = \Input::post('body');
        $category->status = !empty(\Input::post('status')) ? \Input::post('status') : "A";
        $category->image = \Input::post('image');
        $category->parent_id = !empty(\Input::post('parent_id')) ? \Input::post('parent_id') : "0";
        $category->position = \Input::post('position');
        #$category->meta_keywords = \Input::post('meta_keywords');
        #$category->meta_description = \Input::post('meta_description');
        $category->og_image = \Input::post('og_image');
				if ($category->save())
				{
          //save lang
          /*
          $update_lang = \Page\Model_Page_Category_Lang::find(array("where"=>
            array("category_id",$id),array("lang_code",\Lang::get_lang())
          ));
          #print_r($update_lang);exit;
          #$update_lang = \Page\Model_Page_Category_Lang::find($id,array("where"=>array("lang_code"=>\Lang::get_lang())));
          $update_lang->title = \Input::post('title');
          $update_lang->summary = \Input::post('summary');
          $update_lang->body = \Input::post('body');
          $update_lang->meta_keywords = \Input::post('meta_keywords');
          $update_lang->meta_description = \Input::post('meta_description');
          $update_lang->save();
          */
          #print_r($update_lang);exit;
          $query = \DB::update('page_categories_lang')->where("category_id",$id)->where("lang_code",\Lang::get_lang());
          $query->set(array(
            'title' => \Input::post('title'),
            'summary' => \Input::post('summary'),
            'body' => \Input::post('body'),
            'meta_keywords' => \Input::post('meta_keywords'),
            'meta_description' => \Input::post('meta_description'),
          ))->execute();
          
          
         
          
          
          
          \Session::set_flash('success', e('Updated post #' . $id));

          ####Cache::delete('backend.page.categories.fulltree');

          $submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/page/category');
          }elseif($submit == "save"){

          }
          \Response::redirect('admin/page/category/edit/'.$id);


				}

				else
				{
					\Session::set_flash('error', e('Could not save post.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

    $content = \View::forge('modules/page/category/edit',$data);//->auto_filter();

    $this->theme->get_template()->set('title', 'Edit Category');
    $this->theme->get_template()->set('content', $content);


    #đưa JS elfinder xuống footer
    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);

    //JS nào cần sẽ đưa lên <head>
    #$assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    #$this->theme->get_partial('js_head', 'layouts/partials/js_head')->set('assets_js',$assets_js);

    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);
  }

  public function action_delete($id){
    $category = \Page\Model_Page_Category::find($id);
    if(!empty($category)){
      $parent_id_moved = $category['parent_id'];
      #echo $parent_id_moved;exit;
      $category->delete();
      //moved categories childs to parent removed // chuyển toàn bộ danh mục con của nó tới làm con của cha nó

      $query = \DB::update('page_categories')->where('parent_id', $id);
      // Set the columns
      $query->value('parent_id', $parent_id_moved)->execute();

      //remove cache
      ####Cache::delete('backend.page.categories.fulltree');
      \Response::redirect('admin/page/category');
    }
  }
}
