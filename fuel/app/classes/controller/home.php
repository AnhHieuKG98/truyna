<?php
class Controller_Home extends Controller_Frontend
{
  #public function before()
  #{
    #parent::before();
  #}
	public function action_index()
	{
    \Module::load("page");    
    
    $this->template->set_global('body_class', "page-top");
    
    $data = array();

    
    
    
    //section About us 
    $about_slug = "about-us";
    $page_about = \DB::select()->from("page_posts")->where("slug",$about_slug)->execute()->as_array();
    $page_about = reset($page_about);
    
    if(!empty($page_about)){
      $page_id = $page_about["id"];
      $about_block = \Page\Model_Page_Post::find($page_id,array('related' => array(
            "lang"=>array(
              "where" => array(
                "lang_code" => \Lang::get_lang(),
                "post_id" => $page_id,
              ),
            ),
          )
        )
      )->to_array();
      $data["about_block"] = $about_block;
      #print_r($data["about_block"]);exit;
    }
   
    
    #NEWS section 
    //***********section news ***//
    \Module::load("news");
    $query = \News\Model_News_Post::query()->order_by('created_at','desc')->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    $query->where("status","=","A")->limit(3);
    $news = $query->get();
    $data["news"] = $news;
    
    
    
    $content = \View::forge("home/index",$data,false);#ko luu cache 
    #$content = get_cache_frontend("home","home/index",$data);//lưu cache luôn cho trang chủ 
    $this->theme->get_template()->set('content', $content);
    
    //OG image
    $og_image = \Registry::get_setting("site.site_og_logo");
    $this->template->set_global("og_image",$og_image);
    
	}
}
