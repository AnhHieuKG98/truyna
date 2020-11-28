<?php
class Registry{
  /*
    get setting value
    ex :
      general.per_page_b
      general.per_page_f

  */
  public static function get_setting($val){
    \Module::load('setting');
    
    
    
    $settings = \Cache::get('setting_model_'.\Lang::get_lang());#đã lưu tự động ở Controller_Before
    $val_arr = explode(".",$val);
    $type = $val_arr[0];
    $name = $val_arr[1];
    return $settings[$type][$name];
    
    
    
    
    
    //khong dung cach cu nua, cach moi là dung before ở Controller_Before
    
    /*
    
    $val_arr = explode(".",$val);
    $type = $val_arr[0];
    $name = $val_arr[1];
    #print_r($val_arr);exit;
    $setting = \Setting\Model_Setting::query()->where('type','=',$type)->where('name','=', $name)->get_one()->to_array();
    return $setting['value'];
    */

    //lấy cache
    try
    {
        $settings = \Cache::get('setting_model_'.\Lang::get_lang());

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
            //kiểm tra xem có chưa thì tự insert theo ngôn ngữ
            $check_langs = \DB::select()->from("settings_lang")->where("setting_id",$s["id"])->execute()->as_array();
            if(empty($check_langs)){
              #print_r($s->to_array());exit;
              $langs = fn_get_langs();
              foreach($langs as $lang_code){
                $lang_setting = array(
                  "setting_id"  => $s->id,
                  "lang_code" => $lang_code,
                  "value" => $value,
                );
                \DB::insert("settings_lang")->set($lang_setting)->execute();
              }
            }
          }
          $settings_arr[$s["type"]][$s["name"]] = $value;
        }
      }
      \Cache::set('setting_model_'.\Lang::get_lang(), $settings_arr);
    }
    #print_r($settings);exit;
    $val_arr = explode(".",$val);
    $type = $val_arr[0];
    $name = $val_arr[1];
    return $settings[$type][$name];


  }

  public static function fn_call_function($function_name){
    #call_user_func("self::$function_name");
    $class = '\Registry';
    return call_user_func(array($class, $function_name));
  }
  /*
    giành cho table [settings]
      tag:select_function thì sẽ call function tương ứng
  */
      public static function fn_get_themes(){
        $folder_themes = APPPATH.'..'.DS.'cms'.DS.'themes';
        $themes = array();
        $dir = new DirectoryIterator($folder_themes);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {

                $name =  $fileinfo->getFilename();
                if($name != "backend"){# && $name != "default"
                  $themes[$name] = $name;
                }
            }
        }
        return $themes;
      }
      
  public static function fn_get_langs(){
    return array(
      "en","vi"
    );
  }
}
