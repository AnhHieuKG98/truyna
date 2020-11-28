<?php
namespace Admin;
class Controller_Admin extends \Controller_Backend
{

	public function before()
	{
		parent::before();
    #\Module::load('blog');
	}
  public function action_remove_cache($redirect = "admin"){
    //remove css, js 
    $redirect = \Input::get("redirect") ? \Input::get("redirect")  : $redirect;
    \Asset::add_path('themes/default/js/', 'js');
    \Asset::add_path('themes/default/css/', 'css');
    
    $css_path = \Asset::find_file("taki-min.css", 'css');
    $js_path  = \Asset::find_file("taki-min.js","js");
    if(!empty($css_path)){
      unlink($css_path);
    }
    if(!empty($js_path)){
      unlink($js_path);
    }
    //remove cache folder frontend
    \Cache::delete_all('frontend', 'file');
    
    \Session::set_flash('success', l('cache_removed'));
    #\Response::redirect($redirect);
    \Response::redirect("admin");
  }
  public function action_lang($lang_code,$redirect = "admin"){    
    \Config::set('language', $lang_code);
    #echo \Lang::get_lang();exit;
    \Lang::set_lang($lang_code);
    #echo \Lang::get_lang();exit;
    \Response::redirect($redirect);
  }
	public function action_login()
	{
		// Already logged in
		\Auth::check() and \Response::redirect('admin');

		$val = \Validation::forge();

		if (\Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				if ( ! \Auth::check())
				{
					if (\Auth::login(\Input::post('email'), \Input::post('password')))
					{
						// assign the user id that lasted updated this record
						foreach (\Auth::verified() as $driver)
						{
							if (($id = $driver->get_user_id()) !== false)
							{
								// credentials ok, go right in
								$current_user = \Model\Auth_User::find($id[1]);
								\Session::set_flash('success', e('Welcome, '.$current_user->username));
								\Response::redirect('admin');
							}
						}
					}
					else
					{
						$this->template->set_global('login_error', 'Login failed!');
					}
				}
				else
				{
					$this->template->set_global('login_error', 'Already logged in!');
				}
			}
		}

		#$this->template->title = 'Login';
		#$this->template->content = View::forge('admin/login', array('val' => $val), false);

    #$this->theme->get_template()->set('title',"test abc");
    $this->theme->set_template('layouts/login');
    $this->theme->get_template()->set('title', 'Administrator');
    $this->theme->get_template()->set('content', \View::forge('admin/login', array('val' => $val), false));


    #$this->theme->get_template()->set('content', \View::forge('admin/login',$data));

    //login thì ko dùng theme nữa

	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		\Auth::logout();
		\Response::redirect('admin');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		

    //get orders group status

  #echo \DB::last_query();exit;

    $data = array(
     
    );

    $this->theme->get_template()->set('title',"Admin Index ");
    $this->theme->get_template()->set('content', \View::forge('admin/dashboard',$data,false));
	}

  public function action_profile()
	{
    #\Lang::load('langs::module_admin');
    $data = array();
    
    $val = \Validation::forge();

		if (\Input::method() == 'POST')
		{
			$val->add('password_old', l('Password old'))
			    ->add_rule('required');
			$val->add('password_new', l('Password new'))
			    ->add_rule('required');

			if ($val->run())
			{
        $currentpassword = \Input::post("password_old");
        $newpassword = \Input::post("password_new");
        $status = \Auth::change_password($currentpassword,$newpassword);
        if($status){
          //Gửi thông tin mật khẩu tới Email 
          $email_current = \Auth::get_email();
          $subject = l("Admin infomation change");
          $template_body = l("Password new")." : ".$newpassword;
          
          fn_send_email($email_current,$subject,$template_body);
          //END : Gửi thông tin mật khẩu tới Email 
          
          \Session::set_flash('success', l("admin_change_password_success"));
        }else{
          \Session::set_flash('error', l("admin_change_password_fail"));
        }
      }else{
				\Session::set_flash('error', $val->error());
			}
    }
    
    $this->theme->get_template()->set('title', l('Profile'));
    #$view = $this->theme->view('admin/test',$data);
    $data["random"] = self::randomPassword();
		$this->theme->get_template()->set('content', \View::forge('admin/profile',$data));
  }
  public function randomPassword() {
      $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+-={}:"[];,.<>?/';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 10; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }
  public function action_test()
	{
    echo "test";exit;
    $data = array();
    $this->template->title = 'Example Page';
    #$this->template->content = View::forge('admin/test', $data);

    $data = array(
      'title' => 'Test'
    );
    $this->theme->get_template()->set('title', 'Test page');
    $view = $this->theme->view('admin/test',$data);
		$this->theme->get_template()->set('content', \View::forge('admin/test',$data));


    #echo $view;
    #echo 22;exit;
	}

}

/* End of file admin.php */
