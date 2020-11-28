<?php

class Controller_Backend extends Controller_Before#Controller_Template
{
  public $posts_per_page;
	public function before()
	{
    
    #ini_set("memory_limit","256M");
		parent::before();
    
    Fuel::load(APPPATH.DS.'..'.DS.'cms'.DS.'my_helper.php');
    Fuel::load(APPPATH.DS.'..'.DS.'cms'.DS.'image_helper.php');
    
    $lang_code = \Session::get('lang_current');
    
    if(empty($lang_code)){
      $lang_code = \Lang::get_lang();
    }
    
    if(\Input::get("lang_code")){
      $lang_code = \Input::get("lang_code");
      \Session::set('lang_current', $lang_code);
    }
    \Config::set('language', $lang_code);
    \Lang::set_lang($lang_code);
    View::set_global('lang_current', $lang_code);
    
    \Module::load("langs");#load ngôn ngữ tại module langs
    Lang::load('langs::backend');
   
    
		$this->current_user = null;

		foreach (\Auth::verified() as $driver)
		{
			if (($id = $driver->get_user_id()) !== false)
			{
				$this->current_user = Model\Auth_User::find($id[1]);
			}
			break;
		}


        if (\Request::active()->controller !== 'Controller_Admin' or ! in_array(\Request::active()->action, array('login', 'logout')))
        {

            if (\Auth::check())
            {

                $admin_group_id = \Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;

                if ( ! \Auth::member($admin_group_id))
                {
                    \Session::set_flash('error', e('You don\'t have access to the admin panel'));
                    \Response::redirect('/');
                }
            }
            else
            {
                if(\Request::active()->action!="login")
                    \Response::redirect('admin/login');
            }
        }

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);


    //Registry settings for back-end
    $this->posts_per_page = Registry::get_setting("general.per_page_b");


    Asset::add_path('assets/backend/images/', 'img');
    Asset::add_path('assets/backend/js/', 'js');
    Asset::add_path('assets/backend/css/', 'css');
    //build
    Asset::add_path('assets/backend/build/images/', 'img');
    Asset::add_path('assets/backend/build/js/', 'js');
    Asset::add_path('assets/backend/build/css/', 'css');

    //vendors
    Asset::add_path('assets/backend/vendors/', 'css');
    Asset::add_path('assets/backend/vendors/', 'js');
    Asset::add_path('assets/backend/vendors/', 'img');

    //libs ex : ckeditor , elfinder cần set config add_mtime = false để ko bị biến get ở đường dẫn file
    Asset::add_path('assets/libs/', 'css');
    Asset::add_path('assets/libs/', 'js');
    Asset::add_path('assets/libs/', 'img');

    //Đưa backend vào theme
    $this->theme = \Theme::instance();
    $this->theme->active('backend');
    $this->theme->fallback('backend');
    $this->theme->set_template('layouts/template');


    ####set_partial
    /* lấy sidebar  */
     $sidebar = array(array('name'=>'News'),array('name'=>'Settings'));
     $this->theme->set_partial('sidebar', 'layouts/partials/sidebar')->set('model', $sidebar);

     $this->theme->set_partial('js_head', 'layouts/partials/js_head');
     $this->theme->set_partial('js_footer', 'layouts/partials/js_footer');
     $this->theme->set_partial('css_head', 'layouts/partials/css_head');
     #$this->theme->set_partial('form_buttons', 'layouts/partials/common/form_buttons');

     //add views vào theme
     Finder::instance()->add_path(APPPATH.'..'.DS.'cms'.DS.'themes' . DS . 'backend', -1);
     
      //Load ngôn ngữ của module
    \Module::load("news");
    Lang::load('news::backend');

	}

  public function after($response) {
     if (empty($response) or  ! $response instanceof Response) {
        $response = \Response::forge(\Theme::instance()->render());
     }
     return parent::after($response);
  }
}
