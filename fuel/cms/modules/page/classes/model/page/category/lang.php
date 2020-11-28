<?php namespace Page;

class Model_Page_Category_Lang extends \Orm\Model
{
	protected static $_properties = array(
		"category_id","lang_code","title","summary","body","meta_keywords","meta_description",
	);

  

	protected static $_table_name = 'page_categories_lang';

	protected static $_primary_key = array();

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
    'page_category' => array(
      'key_from' => 'category_id',
      'model_to' => 'Page\Model_Page_Category',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )
	);
}
