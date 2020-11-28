<?php

class Controller_Frontend extends Controller_Before#Controller_Template
{
  public $lang_code;
  public $breadcrumbs;
  public $menu_top_active;
  /* những thay đổi front-end hay những mục cần thêm ở từng dự án khác nhau sẽ được thêm ở đây */
  public function loadfortheme(){
    
  }
	public function before()
	{
		parent::before();
   
    
    Fuel::load(APPPATH.DS.'..'.DS.'cms'.DS.'my_helper.php');
    Fuel::load(APPPATH.DS.'..'.DS.'cms'.DS.'image_helper.php');
    
    
    $this->lang_code = \Lang::get_lang();
    
    #echo $this->lang_code;
    
    $this->lang_code = \Session::get('lang_current_front');#lang_current_c : Front-end
    
    if(empty($this->lang_code)){
      $this->lang_code = \Lang::get_lang();
    }
    
    if(\Input::get("lang_code")){
      $this->lang_code = \Input::get("lang_code");
      \Session::set('lang_current_front', $this->lang_code);
    }
    \Config::set('language', $this->lang_code);
    \Lang::set_lang($this->lang_code);
    View::set_global('lang_current_front', $this->lang_code);
    
    
    \Module::load("langs");#load ngôn ngữ tại module langs
    Lang::load('langs::frontend');

    $theme_front = \Registry::get_setting("theme.core_theme_front");
    $this->theme = \Theme::instance();
    $this->theme->active($theme_front);
    $this->theme->fallback($theme_front);


    //theme parent
    Asset::add_path('themes/default/img/', 'img');
    Asset::add_path('themes/default/images/', 'img');
    Asset::add_path('themes/default/js/', 'js');
    Asset::add_path('themes/default/css/', 'css');
    Asset::add_path('themes/default/js/', 'css');
    //theme parent libs
    Asset::add_path('themes/default/libraries/', 'img');
    Asset::add_path('themes/default/libraries/', 'js');
    Asset::add_path('themes/default/libraries/', 'css');
    
    //theme parent fontawesome
    Asset::add_path('themes/default/fontawesome/', 'img');
    Asset::add_path('themes/default/fontawesome/', 'js');
    Asset::add_path('themes/default/fontawesome/', 'css');

    //theme children
    #Asset::add_path("themes/$theme_front/images/", 'img');
    #Asset::add_path("themes/$theme_front/js/", 'js');
   # Asset::add_path("themes/$theme_front/css/", 'css');


    #add data
    $this->template->set_global("title",\Registry::get_setting("site.site_name"));
    $this->template->set_global("meta_description",\Registry::get_setting("site.site_description"));
    $this->template->set_global("meta_keywords",\Registry::get_setting("site.site_keywords"));


     //add views từ theme default : không xoá, theme này sẽ là parent của các theme khác
    Finder::instance()->add_path(APPPATH.'..'.DS.'cms'.DS.'themes' . DS . "default", -1);
    //add views từ theme
    Finder::instance()->add_path(APPPATH.'..'.DS.'cms'.DS.'themes' . DS . $theme_front, -1);

    $this->theme->set_template('layouts/default');


    //HEAD
    $view_meta_head = \View::forge('partials/meta_head',array(),true);
    $this->template->set_global("meta_head",$view_meta_head);

    $meta_head_hook = \View::forge('layouts/hooks/meta_head.post',array(),true);
    $this->template->set_global("meta_head_hook",$meta_head_hook);

    //FOOTER JS
    $view_footer_include = \View::forge('partials/footer_include',array(),true);
    $this->template->set_global("footer_include",$view_footer_include);

    //HEADER Template
    $view_footer  = \View::forge('partials/footer',array(),true);
    $this->template->set_global("FOOTER",$view_footer);
    //FOOTER Template
    $view_header  = \View::forge('partials/header',array(),true);
    $this->template->set_global("HEADER",$view_header);

    $cart = \Session::get('cart');
    $this->template->set_global("cart",$cart);
    
    //Page
    \Module::load("page");
    
    //contact 
    #$page_data_contact = \Page\Model_Page_Post::find("first",array("where"=>array("slug"=>"contact-us")))->to_array();
    $page_data_contact = \DB::select()->from("page_posts")->where("slug","contact-us")->execute()->as_array();
    if(!empty($page_data_contact))
      $page_data_contact = reset($page_data_contact);
    
    if(!empty($page_data_contact)){
      $page_id = $page_data_contact['id'];
       $contact_form = \Page\Model_Page_Form::find("first",array(
        'where' => array("page_id"=>$page_id),
        "related" => array(
          "fields"  => array(
            "related" => array(
              "lang"  => array("where"=>array("lang_code"=>\Lang::get_lang()))
            )
          )
        ),
      ));//->to_array();
      $this->template->set_global("contact_form",$contact_form);
      
      
      
      if(\Input::method() == 'POST'){
        
        #print_r($contact_form["page_form"]["fields"]);exit;
        #print_r($contact_form["fields"]);exit;
       #echo \Input::post("block_contact");exit;
        if(\Input::post("block_contact") == 'block_contact'){
          $full_name = '';
          $val = \Validation::forge();
          
          //g-recaptcha-response
          $val->add_field("g-recaptcha-response", "Captcha", 'required');
        
          foreach($contact_form["fields"] as $field){
              if($field["required"]=="Y"){
                if($field["type"]=="text" OR $field["type"]=="textarea"){
                  $val->add($field["name"], $field["lang"]["label"])->add_rule('required');
                  $val->set_message('required', l("input_required"));#array("field"=>$field["lang"]["label"])
                }elseif($field["type"]=="email"){
                  $val->add_field($field["name"], $field["lang"]["label"], 'required|trim|valid_email');
                  $val->set_message('valid_email', l("ẹmail_valid"));#array("field"=>$field["lang"]["label"])
                }
                elseif($field["type"]=="tel"){
                  $val->add_field($field["name"], $field["lang"]["label"], 'required|trim|valid_string[numeric]');
                  $val->set_message('valid_string', l("phone_valid"));
                }
              }
          }
          $this->template->set_global('val', $val);
        
          if ($val->run())
          {
            $template_email = '';
            $template_email .= '<h3>Nội dung: </h3>';
            
            #foreach($contact_form["page_form"]["fields"] as $field){
            foreach($contact_form["fields"] as $field){
              
              if($field["name"]=="fullname"){
                $full_name = \Input::post("fullname");
              }
              $template_email .= '<p>♦ '.$field["lang"]["label"].': :'.$field["name"].'</p>';
            }
            #$template_email .= '';
            
            #echo $template_email;
            
            //append value to template 
            
            $data_post = \Input::post();
            $template_body = \Str::tr($template_email,$data_post);
            #echo $template_body;
            
            /*************************** send email ******************/ 
            //get SMTP info 
            
            $smtp_email_received = \Registry::get_setting("email.email");
            $smtp_host = \Registry::get_setting("email.smtp_host");#<!-- \Registry::get_setting("email.smtp_host") -->
            $smtp_encryption = \Registry::get_setting("email.smtp_encryption");#<!-- \Registry::get_setting("email.smtp_encryption") -->
            $smtp_port = \Registry::get_setting("email.smtp_port");#<!-- \Registry::get_setting("email.smtp_port") -->
            $smtp_user = \Registry::get_setting("email.smtp_user");#<!-- \Registry::get_setting("email.smtp_user") -->
            $smtp_pass = \Registry::get_setting("email.smtp_pass");#<!-- \Registry::get_setting("email.smtp_pass") -->
            
            
            \Package::load('email');
            // Create an instance _email
            $config = array( 
              'driver' => 'smtp',
              'is_html' => true,
              'charset' => 'utf-8',
              'smtp' => array(
                'host' => \Registry::get_setting("email.smtp_host"),#ssl://smtp.gmail.com
                'port' => \Registry::get_setting("email.smtp_port"),
                'username' => \Registry::get_setting("email.smtp_user"),
                'password' => \Registry::get_setting("email.smtp_pass"),
                'timeout' => 5,
                #'starttls'  => true,#\Registry::get_setting("email.smtp_autotls")
              ),
              'from'  => array(
                'email' => $smtp_user,
                'name'  => \Registry::get_setting("site.site_name")
              ),
              'newline' => "\r\n"
            );
           
           #print_r($config_email);exit;
            $email = \Email::forge($config);
            #print_r($config_email);exit;
            $email->to($smtp_email_received , \Registry::get_setting("site.site_name"));
            $email->cc('haiyen301@gmail.com', 'CC web GiaNguyenAds');
            
            #$email->subject(l('Contact from').\Registry::get_setting("site.site_name"));
            $email->subject('[Contact Form] '.$full_name.' đã để lại thông tin liên hệ từ website '.$_SERVER['SERVER_NAME']);
            
            
            $email->body($template_body);
            //save to table[page_form_data]
            
            $extra = json_encode($data_post);
            
            $email_client = $data_post["email"];
            \DB::insert("page_form_data")->set(array(
              "form_id" => $contact_form->id,
              "page_id" => $page_id,
              "lang_code" => \Lang::get_lang(),
              "extra" => $extra,
              "body"     => $template_body,
              "email" => $email_client ? $email_client : " ",
            ))->execute();
            
            try
            {
              $email->send();
              #\Session::set_flash('success_frontend', l('email_send_success'));
              
              \Session::set_flash('success_frontend_scroll', l('email_send_success'));
              #\Response::redirect('page/'.$slug);
              \Response::redirect(\Uri::create());
              
              #if($email->send()){
              
              #}
            }
            catch(\EmailValidationFailedException $e)
            {
                // The validation failed
                echo l("send email error");
            }
            
            
             #print_r($config_email);exit;
            // Set the from address
            
            
           # exit;
          }else{
            $form_post = \Input::post();
            $this->template->set_global("form_post",$form_post);
            \Session::set_flash('error_frontend', $val->error());
          }
        }
      }
      
    }
    
  //newsletter
    
   
    //breadcrumb
    $this->breadcrumbs = array(
      array("title"=>l("Home"),"link"=>Uri::base()),
    );
    $this->menu_top_active = "";
    
    #$this->template->set_global("breadcrumbs",$this->breadcrumbs);
    
    
    self::loadfortheme();
    

	}

  public function after($response)
  {
      // If no response object was returned by the action,
      if (empty($response) or  ! $response instanceof Response)
      {
        // render the defined template
        $response = \Response::forge(\Theme::instance()->render());
      }
      #$response = tm_outputfilter_gzip($response);
      
      
      $this->theme->get_template()->set('breadcrumbs',$this->breadcrumbs);
      $this->theme->get_template()->set('menu_top_active',$this->menu_top_active);
      
      return parent::after($response);
  }
  
  public function action_404()
	{
		#return Response::forge(Presenter::forge('welcome/404'), 404);
    $data = array();
    $this->theme->get_template()->set('content', \View::forge('404/404',$data,false));
	}

}
