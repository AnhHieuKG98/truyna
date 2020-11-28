<?php namespace Page;

class Model_Page_Post extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"user_id" => array(
			"label" => "User id",
			"data_type" => "int",
		),
		"slug" => array(
			"label" => "Slug",
			"data_type" => "varchar",
		),
    "updated_at" => array(
			"label" => "Updated at",
			"data_type" => "int",
		),
    //
    "status" => array(
			"label" => "Status",
			"data_type" => "char",
		),
    "image" => array(
			"label" => "Image",
			"data_type" => "varchar",
		),
    "created_at" => array(
			"label" => "Created at",
			"data_type" => "int",
		),
		
    "position" => array(
			"label" => "Position",
			"data_type" => "int",
		),
    "og_image" => array(
			"label" => "og:image",
			"data_type" => "varchar",
		),
    "core" => array(
			"label" => "core",
			"data_type" => "char",
		),
   
    
	);
  
  public static function fn_update_page_post($id,$post_data,$lang_code=NULL){

    $slug = \Input::post('slug');
    if(empty($slug)){
      $slug = \Helper::create_seo_name(\Input::post('title'));
    }

    $update = array(
      'slug'  => $slug,
      'status'  => !empty(\Input::post('status')) ? \Input::post('status') : "A",
      'image'  => \Input::post('image'),
      'position'  => \Input::post('position'),
      'og_image'  => \Input::post('og_image'),
    );
    $query = \DB::update("page_posts")->where("id",$id);
    $query->set($update)->execute();
    //save lang
    $update = array(
      'title'  => \Input::post('title'),
      'summary'  => \Input::post('summary'),
      'meta_keywords'  => \Input::post('meta_keywords'),
      'meta_description'  => \Input::post('meta_description'),
      'body'  => \Input::post('body'),
    );
    
    $query = \DB::update("page_posts_lang")->where("post_id",$id)->where("lang_code",$lang_code);
    $query->set($update)->execute();
    
    //save seo
    $seo = \Seo\Model_Seo::query()->where("object_id","=",$id)->where("type","=","p")->where("module","=","page")->get_one();
    if(!empty($seo)){
      $seo->slug = $slug;
    }else{
      $seo = \Seo\Model_Seo::forge(array(
        'module'  => 'page',
        'slug'  => $slug,
        'object_id'  => $model->id,
        'type'  => 'p',#page_post
      ));
    }
    $seo->save();
    #\Cache::delete_all('backend.page.posts', 'file');
    return 1;
  }
  
  public static function fn_gather_additional_posts_data(&$models){
    foreach($models as &$model){
      $model_lang = \DB::select()->from("page_posts_lang")->where("post_id",$model["id"])->where("lang_code",\Lang::get_lang())->execute()->as_array();
      if(!empty($model_lang)){
        $model_lang = reset($model_lang);
        $model->title = $model_lang["title"];
        $model->summary = $model_lang["summary"];
        $model->meta_keywords = $model_lang["meta_keywords"];
        $model->meta_description = $model_lang["meta_description"];
      }
      
    }
    
  }
  public static function fn_get_page_posts($id,$lang_code=NULL){
    $blog_image_width = \Registry::get_setting("appearance.blog_image_width");
    $blog_image_height = \Registry::get_setting("appearance.blog_image_height");
   
    $table = "page_posts";
    $table_lang = "page_posts_lang";
    $query = \DB::select()->from($table)->join($table_lang,"LEFT")->on($table.'.id', '=', $table_lang.'.post_id')->where($table_lang.".lang_code","=",$lang_code);#\DB::expr($lang_code)
    if(is_numeric($id)){
      $query->where("id",$id);
    }
    
    $models = $query->execute()->as_array();#->as_object('\Page\Model_Page_Post')
    print_r($models);exit;
    foreach($models as $model){
      $model["image_main_grid"] = \Simage::get_image_size($id,"p","A",$blog_image_width,$blog_image_height);
      
      return $model;
    }
    return $models;
  }
  
  public static function find_BK($id = NULL, array  $options = Array()){
    $model = parent::find($id,$options);#->to_array()
    
    $lang_code = \Lang::get_lang();
    if(is_numeric($id)){
      $model_lang = \DB::select()->from("page_posts_lang")->where("lang_code",$lang_code)->where("post_id",$id)->execute()->as_array();
      print_r($id);exit;
      $model_lang = reset($model_lang);

      $model->lang_code = $model_lang["lang_code"];
      $model->title = $model_lang["title"];
      $model->summary = $model_lang["summary"];
      $model->body = $model_lang["body"];
      $model->meta_keywords = $model_lang["meta_keywords"];
      $model->meta_description = $model_lang["meta_description"];
    }
    
    return $model;
  }

  
  public function _event_before_delete()
  {
    //remove langs 
    \DB::delete('page_posts_lang')->where('post_id', $this->id)->execute();
    //remove cache 
    #\Cache::delete_all('backend.page.posts', 'file');
  }
  public function _event_before_update()
  {
    
  }
  public function _event_before_save()
  {
    $this->status = !empty($this->status) ? $this->status : "A";
    //check slug not exist
    #check xem co ton tai slug tuong tu ko
    $exist_slug = \Page\Model_Page_Post::query()->where('id','!=',$this->id)->where('slug',"=",$this->slug)->get_one();
    if(!empty($exist_slug)){
      $this->slug = $this->slug ."-". TIME();
    }
    
    //remove cache 
    #\Cache::delete_all('backend.page.posts', 'file');
  }
  
	protected static $_observers = array(
    'Orm\\Observer_Self' => array(
      'events' => array('after_save','before_save','before_update','before_delete')
    ),
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'page_posts';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
  
    'page_categories_posts' => array( #Model_Page_Category_Post page_category_post
      'model_to' => 'Page\Model_Page_Category_Post',
      'key_from' => 'id',
      'key_to' => 'post_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    ),
    
    /*
     "lang"  => array(
      'key_from' => 'id',
      'model_to' => '\Page\Model_Page_Post_Lang',
      'key_to' => 'post_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    ),*/
	);

	protected static $_many_many = array(
    //dùng cho table `page_categories_posts`
	);

	protected static $_has_one = array(
    'lang' => array(
      'key_from' => 'id',
      'model_to' => '\Page\Model_Page_Post_Lang',
      'key_to' => array('post_id','lang_code'),
      'cascade_save' => true,
      'cascade_delete' => true,
      'conditions' => array(
        #"where" => array("lang_code"=>"vi"),
      )
    )
	);

	protected static $_belongs_to = array(
    /*"lang"  => array(
      'key_from' => 'id',
      'model_to' => '\Page\Model_Page_Post_Lang',
      'key_to' => 'post_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    ),*/
	);

}
