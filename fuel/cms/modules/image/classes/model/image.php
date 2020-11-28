<?php namespace Image;

class Model_Image extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),
		"object_id" => array(
			"label" => "Object id",
			"data_type" => "int",
		),
    "object_type" => array(
			"label" => "Object type",
			"data_type" => "char",
		),
		"type" => array(
			"label" => "Type",
			"data_type" => "varchar",
		),
		"image_path" => array(
      "label" => "Image path",
      "data_type" => "varchar",
    ),
    "file_size" => array(
      "label" => "File size",
      "data_type" => "varchar",
    ),
    "alt" => array(
      "label" => "Alt",
      "data_type" => "varchar",
    ),
    "module" => array(
      "label" => "module",
      "data_type" => "varchar",
    ),


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
    )
	);

	protected static $_table_name = 'images';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(

    /*'shop_product_images' => array(
      'model_to' => 'Shop\Model_Shop_Product',
      'key_from' => 'object_id',
      'key_to' => 'id',
      'cascade_save' => false,
      'cascade_delete' => false,
    ),*/
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);


  public static function get_images($object_id, $object_type = 'p', $type = array()){//$type = M:lay tat ca nhung hinh anh khac | $type = A: lay hinh anh dai dien
    $columns = array('id', 'object_id','object_type','type','image_path','file_size','alt','module');
    $query = \DB::select_array($columns)->from('images')->where('object_id','=',$object_id)->where('object_type','=',$object_type);
		if(!empty($type))
			$query->where('type','in',$type);
    return $query->execute()->as_array();
	}

}
