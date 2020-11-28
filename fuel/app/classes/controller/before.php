<?php

class Controller_Before extends Controller_Template
{
 
	public function before()
	{
		parent::before();
    //kiểm tra và lưu cache
    \Module::load('setting');
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
    
	}
  public function fn_get_langs(){
    return array(
      "en","vi"
    );
  }
}
