<?php

class Controller_Sitemap extends Controller_Frontend
{

	public function action_index()
	{
    \Module::load("discover");
    
    $params = array('parent_id'=>'0');#,'frefix'=>""
		$discover_categories = \Discover\Model_Discover_Category::fn_get_categories($params);
    $this->template->set_global("discover_categories",$discover_categories,false);
    
		$data = array();
    
    $banner_image = \Uri::create("files/banner-default.jpg");
    $banner_summary = "";
    #print_r($banner_image);exit;
    $banners = array(
      array("image_full"=>$banner_image,"lang"=>array("summary"=>$banner_summary)),
    );
    $this->template->set_global("banners",$banners,false);
    
    
    $content = \View::forge("sitemap",$data,false);
    $this->theme->get_template()->set('content', $content);
	}
}
