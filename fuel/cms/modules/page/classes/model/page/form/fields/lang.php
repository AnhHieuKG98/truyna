<?php namespace Page;

class Model_Page_Form_Fields_Lang extends \Orm\Model
{
	protected static $_properties = array(   
    "field_id","lang_code","label","placeholder","values"
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

	protected static $_table_name = 'page_form_fields_lang';

	protected static $_primary_key = array('field_id');

	protected static $_has_many = array(
  
	);

	protected static $_many_many = array(
    
	);

	protected static $_has_one = array(
   
	);

	protected static $_belongs_to = array(
   
	);

}
