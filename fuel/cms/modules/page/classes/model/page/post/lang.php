<?php namespace Page;

class Model_Page_Post_Lang extends \Orm\Model
{
	protected static $_properties = array(
		"post_id","lang_code","title","summary","body","meta_keywords","meta_description","block","caption"
    ,"data_1","data_2","data_3","data_4"
	);

  

	protected static $_table_name = 'page_posts_lang';

	protected static $_primary_key = array();

	protected static $_has_many = array(
    /*'page_post' => array(
      'key_from' => 'post_id',
      'model_to' => 'Page\Model_Page_Post',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )*/
	);

	protected static $_many_many = array(
    
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
    /*'page_post' => array(
      'key_from' => 'post_id',
      'model_to' => 'Page\Model_Page_Post',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )*/
	);
}
