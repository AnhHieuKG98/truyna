<?php
namespace News;
class Controller_News extends \Controller_Frontend
{
  public $module_name = "news";# $this->module_name
  public function before(){
    parent::before();
    \Module::load($this->module_name);
    \Config::load($this->module_name.'::config'); 
    \Lang::load($this->module_name.'::frontend');
    
    
    //tin mới nhất 
    $news_recent = \News\Model_News_Post::find("all",array('related' => array(
          "lang"=>array(
            "where" => array(
              "lang_code" => \Lang::get_lang(),
            ),
          )
        ),
        #'where' =>  array(array("id","!=",$model["id"])),
        'limit' => 5,
      )
    );
    $image_width_small = 100;
    
    $image_height_small = 80;
    foreach($news_recent as &$item){
      $item["url"]   = \Uri::create($this->module_name."/".$item["slug"]);
    }
    $this->template->set_global("news_recent",$news_recent);
    
    
    
    
    $this->template->set_global("breadcrumb_title",l($this->module_name.".title"));
    
    
    
     //
    $params = array('parent_id'=>'0',"status"=>"A");#,'frefix'=>""
    $_categories = \News\Model_News_Category::fn_get_categories($params);
    //apply posts
    foreach($_categories as &$cat){
      $subcats = array($cat["id"]);
      $query = \News\Model_News_Post::query()->order_by('created_at','desc')->order_by('position','asc');
      $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
      $query->related($this->module_name.'_categories_posts')->related($this->module_name.'_categories_posts.'.$this->module_name.'_post')->where($this->module_name.'_categories_posts.category_id',"IN",$subcats);
    
      $query->and_where_open();
      $query->where("status","=","A");
      $query->and_where_close();
      $query->rows_limit(10);
      $cat["posts"] = $query->get();
    }
    $this->template->set_global('news_categories',$_categories,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    
  }
	public function action_index()
	{
   
    
    
    $data = array();
    
    $params = \Input::get();
    $query = \News\Model_News_Post::query()->order_by('created_at','desc')->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    if(!empty($params['s'])){
      $s = $params['s'];
      #echo 222;exit;
          

      $query->or_where_open();
      $query->where("lang.title","like","%$s%");
      #$query->or_where("lang.summary","like","%$s%");
      #$query->or_where("lang.body","like","%$s%");
      $query->or_where_close();
      #$query->where("status","=","A");
    }
    if(!empty($params['cid'])){
      $subcats = \News\Model_News_Category::get_subcats($params['cid']);
      $subcats[] = $params['cid'];
      $query->related($this->module_name.'_categories_posts')->related($this->module_name.'_categories_posts.'.$this->module_name.'_post')->where($this->module_name.'_categories_posts.category_id',"IN",$subcats);
    }
    $query->and_where_open();
    $query->where("status","=","A");
    $query->and_where_close();
    
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap4',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => 10,
      #'uri_segment'    => 3,
    ),"bootstrap4");
    
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);
    $models = $query->get();
    #echo \DB::last_query();exit;
    
    $image_width = 100;
    $image_height = 80;
    
    foreach($models as &$model){
      $model['image_medium'] = \Simage::get_image_size($this->module_name,$model["id"],"p","A",$image_width,$image_height);
      $model['lang']["summary"] = $model['lang']["summary"] ? $model['lang']["summary"] : strip_tags($model['lang']["body"]);
      $model['url'] = \Uri::create($this->module_name."/".$model["slug"]);
    }
    
    $data["models"] = $models;
    $this->template->set_global('pagination',$pagination,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    
    $this->theme->get_template()->set('content', \View::forge('modules/'.$this->module_name.'/index',$data,false));
    
    $this->breadcrumbs[] = array("title"=>l($this->module_name.".title"));
	}
  public function action_detail($slug){
    
    #$seo = \News\Model_News_Post::query()->where("slug",$slug)->get_one();
    $seo = \DB::select()->from($this->module_name."_posts")->where("slug",$slug)->execute()->as_array();
    
    #print_r($seo);exit;
    if(!empty($seo)){
      $seo = reset($seo);
      $object_id = $seo["id"];
      $model = \News\Model_News_Post::find($object_id,array('related' => array(
            "lang"=>array(
              "where" => array(
                "lang_code" => \Lang::get_lang(),
                "post_id" => $object_id,
              ),
            )
          )
        )
      );
      #echo \DB::last_query();
      
     # print_r($model);exit;
      $data["model"] = $model;
      
      
      
      $columns = array('category_id','post_id');
      $categories_posts = \DB::select_array($columns)->from($this->module_name.'_categories_posts')->where('post_id','=',$model["id"])->execute()->as_array();
      foreach($categories_posts as $_c){
        $category_main_id = $_c['category_id'];
        $data["main_category"] = \News\Model_News_Category::find($category_main_id,array('related' => array(
              "lang"=>array(
                "where" => array(
                  "lang_code" => \Lang::get_lang(),
                ),
              )
            )
          )
        )->to_array();
        
      }
      
      
      
    
    
    $this->breadcrumbs[] = array("title"=>l($this->module_name.".title"),"link"=>\Uri::create($this->module_name));
    $this->breadcrumbs[] = array("title"=>$model["lang"]["title"]);
    
    //SEO META
    $this->template->set_global('title', $model["lang"]["title"]." | ".\Registry::get_setting("site.site_name"));
    $this->template->set_global("meta_description",$model["lang"]["meta_description"] ? $model["lang"]["meta_description"] : \Str::truncate(strip_tags($model["lang"]["body"]),299));#\Registry::get_setting("site.site_description")
    $this->template->set_global("meta_keywords",$model["lang"]["meta_keywords"] ? $model["lang"]["meta_keywords"] : \Registry::get_setting("site.site_keywords"));
    //OG image
    $og_image = \Simage::get_image_size($this->module_name,$model["id"],"p","A",600,315);
    $this->template->set_global("og_image",$og_image);
      
      $this->template->set_global('body_class',"body-news body-news-detail");#true sẽ là html->text , false sẽ chuyển text->html sang
      $this->theme->get_template()->set('content', \View::forge('modules/'.$this->module_name.'/detail',$data,false)); 
    }
  }
  
  public function action_cat($slug)
	{
    $cat_data = \News\Model_News_Category::find("first",array(
        "related" => array("lang" => array("where"=>array("lang_code"=>\Lang::get_lang()))),
        "where"=>array(array("slug"=>$slug))
      )
    );
    #print_r($cat_data);exit;
    $cid = $cat_data->id;
    $subcats = array($cid);
    
    
    $data = array();
    
    $params = \Input::get();
    $query = \News\Model_News_Post::query()->order_by('created_at','desc')->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    
    
    #$query->related($this->module_name.'_categories_posts')->related($this->module_name.'_categories_posts.'.$this->module_name.'_post')->where($this->module_name.'_categories_posts.category_id',"IN",$subcats);
    
    
    $params['cid'] = $cid;

    if(!empty($params['cid'])){
      $subcats = \News\Model_News_Category::get_subcats($params['cid']);
      $subcats[] = $params['cid'];
      $query->related($this->module_name.'_categories_posts')->related($this->module_name.'_categories_posts.'.$this->module_name.'_post')->where($this->module_name.'_categories_posts.category_id',"IN",$subcats);
    }
    #print_r($subcats);exit;
    #$query->and_where_open();
    #$query->where("status","=","A");
    #$query->and_where_close();
    
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap3',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => 2,
      #'uri_segment'    => 3,
    ),"bootstrap3");
    
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);
    $models = $query->get();
    #print_r($models);exit;
    #echo \DB::last_query();exit;
    
    $image_width = 297;
    $image_height = 183;
    
    foreach($models as &$model){
      $model['image_medium'] = \Simage::get_image_size($this->module_name,$model["id"],"p","A",$image_width,$image_height);
      $model['lang']["summary"] = $model['lang']["summary"] ? $model['lang']["summary"] : strip_tags($model['lang']["body"]);
      $model['url'] = \Uri::create($this->module_name."/".$model["slug"]);
    }
    
    $data["cat_data"] = $cat_data;
    $data["models"] = $models;
    $this->template->set_global('pagination',$pagination,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    $this->theme->get_template()->set('content', \View::forge('modules/'.$this->module_name.'/cat',$data,false));
	}
}
