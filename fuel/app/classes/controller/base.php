<?php

class Controller_Base extends Controller_Template   #Controller_Template Controller_Template
{
	public function before()
	{
		parent::before();

		$this->current_user = null;

		foreach (\Auth::verified() as $driver)
		{
			if (($id = $driver->get_user_id()) !== false)
			{
				$this->current_user = Model\Auth_User::find($id[1]);
			}
			break;
		}

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
	}
  
  public function after($response)
  {
      // If no response object was returned by the action,
      if (empty($response) or  ! $response instanceof Response)
      {
          // render the defined template
          $response = \Response::forge(\Theme::instance()->render());
      }

      return parent::after($response);
  }

}
