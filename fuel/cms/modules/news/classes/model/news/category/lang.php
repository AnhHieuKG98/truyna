<?php namespace News;

class Model_News_Category_Lang extends \Orm\Model
{
	protected static $_properties = array(
		"category_id","lang_code","title","summary","body","meta_keywords","meta_description",
	);

  

	protected static $_table_name = 'news_categories_lang';

	protected static $_primary_key = array();

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
    'news_category' => array(
      'key_from' => 'category_id',
      'model_to' => 'News\Model_News_Category',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )
	);
}
