<?php namespace News;

class Model_News_Category_Post extends \Orm\Model
{
	protected static $_properties = array(
		/*"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),*/
		"category_id" => array(
			"label" => "Category id",
			"data_type" => "int",
		),
		"post_id" => array(
			"label" => "Post id",
			"data_type" => "int",
		)
	);

  /*
	protected static $_observers = array(
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
  */

	protected static $_table_name = 'news_categories_posts';

	protected static $_primary_key = array();

	protected static $_has_many = array(
    
	);
	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
    'news_post' => array(
      'key_from' => 'post_id',
      'model_to' => 'News\Model_News_Post',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )
	);

}
