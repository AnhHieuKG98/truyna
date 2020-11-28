<?php namespace Page;

class Model_Page_Form extends \Orm\Model
{
	protected static $_properties = array(   
    "id","email","page_id"
	);
  
 
  
  public function _event_before_delete()
  {
    
  }
  public function _event_before_update()
  {
    
  }
  public function _event_before_save()
  {
    
  }
  
	protected static $_observers = array(
    'Orm\\Observer_Self' => array(
      'events' => array('after_save','before_save','before_update','before_delete')
    ),
	);

	protected static $_table_name = 'page_form';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
  
    'fields' => array( #Model_Page_Category_Post page_category_post
      'model_to' => '\Page\Model_Page_Form_Fields',
      'key_from' => 'id',
      'key_to' => 'form_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    ),
	);

	protected static $_many_many = array(
    //dùng cho table `page_categories_posts`
	);

	protected static $_has_one = array(
   
	);

	protected static $_belongs_to = array(
   
	);

}
