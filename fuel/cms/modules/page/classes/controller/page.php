<?php
namespace Page;

class Controller_Page extends \Controller_Frontend
{

  public function before()
  {
    parent::before();
  }
	public function action_index($slug)
	{

    #$breadcrumbs = $this->breadcrumbs;
    
    #$breadcrumbs = $this->template->breadcrumbs;
    
    
    
    
    
    $data = array();
    $page_object = \DB::select()->from("page_posts")->where("slug",$slug)->execute()->as_array();
    if(!empty($page_object))
      $page_object = reset($page_object);
   # print_r($page_object);exit;
    
    #$page_object = \Page\Model_Page_Post::query()->where("slug",$slug)->get_one();
    
    if(!empty($page_object)){
      $page_id = $page_object["id"];
      $model = \Page\Model_Page_Post::find($page_id,array('related' => array(
            "lang"=>array(
              "where" => array(
                "lang_code" => \Lang::get_lang(),
                "post_id" => $page_id,
              ),
            ),
          )
        )
      );
      if($model["id"]==1){

        #print_r($model);exit;
        $data_4 = $model["lang"]["data_4"];
        $model["lang"]["data_4_array"] = \Format::forge($data_4, 'json')->to_array();
        
      }
      
      $this->breadcrumbs[] = array("title"=>$model["lang"]["title"]);
      
      $this->template->set_global("breadcrumb_title",$model["lang"]["title"]);
      
      $this->theme->get_template()->set('title', $model["lang"]["title"]." | ".\Registry::get_setting("site.site_name"));
      $this->template->set_global('title', $model["lang"]["title"]." | ".\Registry::get_setting("site.site_name"));
      $this->template->set_global("meta_description",$model["lang"]["meta_description"] ? $model["lang"]["meta_description"] : \Registry::get_setting("site.site_description"));
      $this->template->set_global("meta_keywords",$model["lang"]["meta_keywords"] ? $model["lang"]["meta_keywords"] : \Registry::get_setting("site.site_keywords"));
      
      //OG image 
      $og_image = \Simage::get_image_size("page",$model["id"],"p","A",600,315);
      $this->template->set_global("og_image",$og_image);
      
      #$get_default = true;
     # $banner_image = \Simage::get_image("page",0,$model["id"],"p","B",false,$get_default);# B: lấy banner
      $banner_image = cms_get_image_one($model["id"],"page_p_B");
     # print_r($image);exit;
      
      $banner_summary = $model["lang"]["caption"];
      #print_r($banner_image);exit;
      $banners = array(
        array("banner_image"=>$banner_image,"lang"=>array("summary"=>$banner_summary)),
      );
      $this->template->set_global("banners",$banners,false);
      
      
      #print_r($data["banners"]);exit;
      
      $data["model"] = $model;
      
      
      
      $data["page_form"] = array();
      //get form
      #array("related"=>array("lang")
      /*$page_form = \Page\Model_Page_Form::query()->where("page_id",$page_id)
        ->related("fields",array("related"=>"lang")
        )
      ->get_one()->to_array();*/
      $page_form = \Page\Model_Page_Form::find("first",array(
        'where' => array("page_id"=>$page_id),
        "related" => array(
          "fields"  => array(
            "related" => array(
              "lang"  => array("where"=>array("lang_code"=>\Lang::get_lang()))
            )
          )
        ),
      ));#->to_array()
      if(!empty($page_form)){
        $data["page_form"] = $page_form->to_array();
        
        #echo "<pre>";
        #print_r($data["page_form"]);
        #echo "</pre>";
        #exit;
      }
      $data["form_post"] = \Input::post();
      if(\Input::method() == 'POST'){
       
        
        $full_name = '';
        $val = \Validation::forge();
        foreach($data["page_form"]["fields"] as $field){
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
          foreach($data["page_form"]["fields"] as $field){
            
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
          
          #$email->subject(l('Contact from').\Registry::get_setting("site.site_name"));
          $email->subject('[Contact Form]  Khách '.$full_name.' đã để lại thông tin liên hệ từ website');
          
          
          $email->body($template_body);
          //save to table[page_form_data]
          
          $extra = json_encode($data_post);
          
          $email_client = $data_post["email"];
          \DB::insert("page_form_data")->set(array(
            "form_id" => $page_form->id,
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
            \Response::redirect('page/'.$slug);
            
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
          \Session::set_flash('error_frontend', $val->error());
        }
      }
    }
    
    if(empty($data)){
      $this->theme->get_template()->set('content', \View::forge('404'));
    }else{
      $this->theme->get_template()->set('content', \View::forge('modules/page/index',$data,false));
    }
    
	}
  
}
