<?php namespace Page;

class Model_Page_Category extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"slug" => array(
			"label" => "Slug",
			"data_type" => "varchar",
		),
    "status" => array(
			"label" => "Status",
			"data_type" => "char",
		),
    "parent_id" => array(
			"label" => "Parent id",
			"data_type" => "int",
      #'default' => 0,
		),
    "image" => array(
			"label" => "Image",
			"data_type" => "varchar",
		),
    "position" => array(
			"label" => "Position",
			"data_type" => "int",
		),
    "og_image" => array(
			"label" => "og:image",
			"data_type" => "varchar",
		),
	);

  public static function get_subcats($parent_id){
    $subs_cat_ids = array();
    $subs = \Page\Model_Page_Category::query()->where("parent_id",$parent_id)->get();
    if(!empty($subs)){
      foreach($subs as $_sub){
        $subs_cat_ids[] = $_sub["id"];
        $subs_cat_ids_recursive = self::get_subcats($_sub["id"]);
        $subs_cat_ids = array_merge($subs_cat_ids,$subs_cat_ids_recursive);
      }
    }
    return $subs_cat_ids;
  }
  public function _event_before_delete()
  {
    //remove langs 
    \DB::delete('page_categories_lang')->where('category_id', $this->id)->execute();
  }
  protected static $_observers = array('Orm\\Observer_Self' => array(
      'events' => array('after_save','before_save','before_delete')
  ));


	protected static $_table_name = 'page_categories';

	protected static $_primary_key = array('id');#key_from in _belongs_to

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
    "lang"  => array(
      'key_from' => 'id',
      'model_to' => '\Page\Model_Page_Category_Lang',
      'key_to' => 'category_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )
  );
  /*
  protected function post_update($result)
  {
      // Do something with the result
      echo 22;exit;
      return $result;
  }*/

  public static function fn_get_categories($params){

    $frefix_child = '►';
    $frefix = !empty($params['frefix']) ? $params['frefix'] : '';
    $categories = \DB::select()->from("page_categories")->join("page_categories_lang")->on("page_categories.id","=","page_categories_lang.category_id")->where("page_categories_lang.lang_code","=",\Lang::get_lang())->where('page_categories.parent_id','=',$params['parent_id'])->execute()->as_array();
    #echo \DB::last_query();exit;
    #print_r($categories);exit;

    $level = !empty($params['level']) ? $params['level'] : 0;
    foreach($categories as $key=>&$cat){

      if(!empty($params['frefix'])){
				$cat['frefix'] = $frefix;
				$cat['level'] = $level + 1;
			}
			if($cat['parent_id']==0){
				$cat['frefix'] = '';
			}
       $params['frefix'] = $frefix.$frefix_child;

      $params['parent_id'] = $cat['id'];
      $params['level'] = $level + 1;
      $childs = Model_Page_Category::fn_get_categories( $params );
			if(!empty($childs))
				$cat['childs'] = $childs;
    }
    return $categories;
  }

  public static function save_model(){

  }
}
