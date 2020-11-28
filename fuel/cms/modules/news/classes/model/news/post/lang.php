<?php namespace News;

class Model_News_Post_Lang extends \Orm\Model
{
	protected static $_properties = array(
		"post_id","lang_code","title","summary","summary2","body","meta_keywords","meta_description",
	);

  

	protected static $_table_name = 'news_posts_lang';

	protected static $_primary_key = array();

	protected static $_has_many = array(
    /*'news_post' => array(
      'key_from' => 'post_id',
      'model_to' => 'News\Model_News_Post',
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
    /*'news_post' => array(
      'key_from' => 'post_id',
      'model_to' => 'News\Model_News_Post',
      'key_to' => 'id',
      'cascade_save' => true,
      'cascade_delete' => false,
    )*/
	);
}
