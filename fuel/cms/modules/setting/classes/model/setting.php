<?php namespace Setting;

class Model_Setting extends \Orm\Model
{
	protected static $_properties = array(
		"id" => array(
			"label" => "Id",
			"data_type" => "int",
		),

    "default" => array(
			"label" => "Default",
			"data_type" => "char",
		),
    "type" => array(
			"label" => "Type",
			"data_type" => "varchar",
		),
    "module" => array(
			"label" => "Module",
			"data_type" => "varchar",
		),
    "label" => array(
			"label" => "Label",
			"data_type" => "varchar",
		),
    "note" => array(
			"label" => "Note",
			"data_type" => "varchar",
		),
    "name" => array(
			"label" => "Name",
			"data_type" => "varchar",
		),
    "value" => array(
			"label" => "Value",
			"data_type" => "text",
		),
    "tag" => array(
			"label" => "Tag HTML",
			"data_type" => "text",
		),
    "position" => array(
			"label" => "Position",
			"data_type" => "text",
		),

    #để lưu dữ liệu Select, Checkbox Radio, checked được lấy từ Value
    "value_json" => array(
			"label" => "Value Json",#lưu dạng serialize
			"data_type" => "text",
		),
    "lang_active" => array(
			"label" => "lang_active",
			"data_type" => "char",
		),

    /*
    tạo dữ liệu mẫu để lấy giá trị lưu vào database
      $date_f = array(
        "d/m/Y" => "17/02/2018 (day/month/year)",
        "Y/d/m" => "2018/02/17 (year/month/day)",
      );
      $t = serialize($date_f);
      echo $t;exit;*/



    /*
		"created_at" => array(
			"label" => "Created at",
			"data_type" => "int",
		),
		"updated_at" => array(
			"label" => "Updated at",
			"data_type" => "int",
		),*/
	);

  public static function get_value($name){

  }
  public function fn_get_langs(){
    return array(
      "en","vi"
    );
  }
  public function _event_after_save()
  {
    //remove all cache
    
    //remove cache setting and save again
    \Cache::delete_all();
    
    $langs = $this->fn_get_langs();
    foreach($langs as $lang_code){      
      try
      {
        $settings = \Cache::get('setting_model_'.$lang_code);
      }
      catch (\CacheNotFoundException $e)
      {
        $settings = \Setting\Model_Setting::find("all");
        $settings_arr = array();
        foreach($settings as $s){
          if(!empty($s["name"])){
            //kiem tra ngon ngu va lay tuong ung value
            $value = $s["value"];
            if($s["lang_active"]=="Y"){
              $m_value = \DB::select()->from("settings_lang")->where("setting_id",$s["id"])->where("lang_code",$lang_code)->execute()->as_array();
              $m_value = reset($m_value);
              $value = $m_value["value"];
            }
            $settings_arr[$s["type"]][$s["name"]] = $value;
          }
        }
        \Cache::set('setting_model_'.$lang_code, $settings_arr);
      }
    }
    
    
    #\Cache::delete_all('backend.blog', 'file');
    #\Cache::delete_all('setting_model_'.\Lang::get_lang(), 'file');
    
    //chỉ cần xoá, thao tác lưu cache chỉ dùng duy nhất ở Before_Controller
    /*
    $settings = \Setting\Model_Setting::find("all");
    $settings_arr = array();
    foreach($settings as $s){
      if(!empty($s["name"])){
        $value = $s["value"];
        if($s["lang_active"]=="Y"){
          #echo $value;exit;
          $check_lang = \DB::select()->from("settings_lang")->where("setting_id",$s["id"])->where("lang_code",\Lang::get_lang())->execute()->as_array();
          #print_r($check_lang);exit;
          if(!empty($check_lang)){
            $lang_setting = array(
              "value" => $value,
            );
            
            \DB::update("settings_lang")->where("setting_id",$s["id"])->where("lang_code",\Lang::get_lang())->set($lang_setting)->execute();
          }
        }
        
        $settings_arr[$s["type"]][$s["name"]] = $value;
      }
    }
    \Cache::set('setting_model_'.\Lang::get_lang(), $settings_arr);
    */
  }

	protected static $_observers = array(
    'Orm\\Observer_Self' => array(
      'events' => array('after_save')
    )
	);

	protected static $_table_name = 'settings';

	protected static $_primary_key = array('id');

	protected static $_has_many = array(
	);

	protected static $_many_many = array(
	);

	protected static $_has_one = array(
	);

	protected static $_belongs_to = array(
	);

}
