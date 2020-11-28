<?php namespace Page;

class Model_Page_Form_Fields extends \Orm\Model
{
	protected static $_properties = array(   
    "id","form_id","type","required","name"
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

	protected static $_table_name = 'page_form_fields';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
  
    
	);

	protected static $_many_many = array(
    
	);

	protected static $_has_one = array(
   'lang' => array( 
      'model_to' => '\Page\Model_Page_Form_Fields_Lang',
      'key_from' => 'id',
      'key_to' => 'field_id',
      'cascade_save' => true,
      'cascade_delete' => false,
    ),
	);

	protected static $_belongs_to = array(
   
	);

}
