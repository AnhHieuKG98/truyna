<?php
namespace Admin;
class Controller_Setting extends \Controller_Backend
{
  public function before(){
    parent::before();
    \Module::load("setting");
    $this->theme->get_template()->set('title', 'Settings');

    $assets_js = array('jquery-ui/jquery-ui.min.js','ckeditor/ckeditor.js','elfinder/js/elfinder.full.js');
    $this->theme->get_partial('js_footer', 'layouts/partials/js_footer')->set('assets_js',$assets_js);

    $assets_css = array('jquery-ui/jquery-ui.min.css');
    $this->theme->get_partial('css_head', 'layouts/partials/css_head')->set('assets_css',$assets_css);

  }
  public function form_common($type="general",$title="General",$text = "Cấu hình chung"){

/*
$date_f = array(
        "B" => "Track without options",
        "O" => "Track with options",
      );
      echo serialize($date_f);exit;*/
       /*
       $date_f = array(
        "grid" => "Grid",
        "list" => "List",
      );
      echo serialize($date_f);exit;

      $date_f = array(
        "d/m/Y" => "17/02/2018 (day/month/year)",
        "Y/d/m" => "2018/02/17 (year/month/day)",
      );
      $t = serialize($date_f);
      $a = unserialize($t);
      print_r($a);
      echo $t;exit;*/

    if (\Input::method() == 'POST')
		{




      $setting_data = \Input::post("setting_data");

      //lấy model [checkbox] tương ứng theo section
      #mục đích là do checkbox khi post nếu ko checked sẽ ko có phần tử
      #chúng ta phải join với 1 mảng phần tử khởi tạo là 0
      $model_checkbox = \Setting\Model_Setting::find("all",array(
        "where"=>array(
          array("type",$type),
          array("tag","checkbox"),
        )
      ));
      if(!empty($model_checkbox)){
        $model_checkbox_data = array();
        foreach($model_checkbox as $_c){
          $model_checkbox_data[$_c['id']] = 0;
        }
        $setting_data = $setting_data + $model_checkbox_data;
        #print_r($setting_data);exit;
      }
      foreach($setting_data as $_id => $_value){
        $update = \Setting\Model_Setting::find($_id);
        $update->value = $_value;
        if($update->save()){
          //luu ngôn ngữ
          if($update->lang_active=="Y"){
            $query = \DB::update('settings_lang')->where("setting_id",$_id)->where("lang_code",\Lang::get_lang());
            $query->value('value', $_value)->execute();
          }
        }
      }

    }
    $data = array(
      "title"=>$title,
      "text"  => $text,
    );
    $model = \Setting\Model_Setting::find("all",array(
      "where"=>array(
        array("type",$type),
      ),
      'order_by' => array('position' => 'asc'),
    ));
    foreach($model as &$m){
      if(!empty($m["value_json"]) AND $m["tag"]=="select" ){
        $m['serialize'] = unserialize($m["value_json"]);
      }
      if(!empty($m["value_json"]) AND $m["tag"] == "select_function" ){
        $m['serialize'] = \Registry::fn_call_function($m["value_json"]);
      }
      if($m["lang_active"]=="Y"){
        $m_value = \DB::select()->from("settings_lang")->where("setting_id",$m["id"])->where("lang_code",\Lang::get_lang())->execute()->as_array();
        $m_value = reset($m_value);
        $m["value"] = $m_value["value"];
      }
    }
    $data['model'] = $model;
    $content = \View::forge('admin/setting/index', $data);
    $this->theme->get_template()->set('content', $content);
  }
	public function action_index()
	{
    $this->form_common();
	}

  public function action_email()
	{
    $this->form_common("email","Email","Cấu hình email");
	}

  public function action_site()
	{
    $this->form_common("site","Site","Cấu hình Web");
	}

  public function action_company()
	{
    $this->form_common("company","Công ty","Cấu hình thông tin công ty");
	}

  public function action_appearance()
  {
    $this->form_common("appearance","Hiển thị","Cấu hình hiển thị");
  }

  public function action_product()
  {
    $this->form_common("product","Hiển thị","Cấu hình Sản phẩm");
  }

  public function action_theme()
  {
    $this->form_common("theme","Cấu hình Theme","Cấu hình Front-end");
  }

  public function action_social()
  {
    $this->form_common("social","Cấu hình Social","Cấu hình Link social cho Front-end");
  }
  
  public function action_home()
  {
    $this->form_common("home","Cấu hình Home page","Cấu hình data cho Front-end");
  }





	public function action_create()
	{
	}

	public function action_edit($id = null)
	{

	}

	public function action_delete($id = null)
	{
	}
}
