<?php
class Controller_Search extends Controller_Frontend
{
	public function action_index()
	{
    \Module::load("seo");
    \Module::load("page");
    \Module::load("gallery");
    \Module::load("offer");
    \Module::load("meeting");
    
    
    //sidebar 
    \Module::load("discover");
    
    $data = array();    
    $params = \Input::get();
    
    $params["s"]  = isset($params["s"]) ? $params["s"] : "";
    
    $search_query = $params["s"];
    
    
    $params['m'] =  !empty($params['m']) ? $params['m'] : "discover";
    
    if($params['m'] == "discover"){
      $query = \Discover\Model_Discover_Post::forge()->query()->order_by('created_at','desc')->order_by('position','asc');#->order_by('created_at','desc')
      $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
      $query->related('discover_categories_posts')->related('discover_categories_posts.discover_post');
      $query->where("status","=","A");
      
      
      if(!empty($search_query)){
        $s = $search_query;
            

        $query->and_where_open();
        $query->where("lang.title","like","%$s%");
        $query->or_where("lang.summary","like","%$s%");
        $query->and_where_close();
      }
    
    }elseif($params['m'] == "meeting"){
      $query = \Meeting\Model_Meeting_Post::query()->order_by('created_at','desc')->order_by('position','asc');
      $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
      $query->related('meeting_categories_posts')->related('meeting_categories_posts.meeting_post');
      $query->where("status","=","A");
      
      
      if(!empty($search_query)){
        $s = $search_query;
        $query->and_where_open();
        $query->where("lang.title","like","%$s%");
        $query->or_where("lang.summary","like","%$s%");
        $query->and_where_close();
      }
    }
    
    
    
    $per_page = 4;
    if($params['m'] == "meeting"){
      $per_page = 6;
    }
    
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap3',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => $per_page,# 1 để test, nhưng đưa thực tế để 3
      #'uri_segment'    => 3,
    ),"bootstrap3");
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);
    
    
    $posts = $query->get();
    #echo \DB::last_query();
    
    
    $data["posts"] = $posts;
    
    
    
    
    
    
    
    
    
    
    $_params = array('parent_id'=>'0');#,'frefix'=>""
		$_categories = \Discover\Model_Discover_Category::fn_get_categories($_params);
		$discover_categories = array();
		\Helper::array_level1($_categories,$discover_categories);
    foreach($discover_categories as $cid=>&$value){
      //count posts 
      $result = \DB::select('*')->from('discover_posts');
      $result = $result->join('discover_categories_posts','LEFT')->on('discover_categories_posts.post_id', '=', 'discover_posts.id')->where("discover_categories_posts.category_id",$value["id"])->where("discover_posts.status","A");
      $result = $result->execute();
      #echo "<br />";
      #echo \DB::last_query();
      #echo "<br />";
      
      $value["posts_count"] = count($result);
    }
    $this->template->set_global('discover_categories', $discover_categories);
    
    //RECENT POST
    $query = \Discover\Model_Discover_Post::query()->order_by('created_at','desc')->order_by('position','asc');#->order_by('created_at','desc')
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    $query->related('discover_categories_posts')->related('discover_categories_posts.discover_post');
    //->where('discover_categories_posts.category_id',"=",$category["id"]);
    $query->where("status","=","A")->limit(3);
    $discover_recent = $query->get();
    $this->template->set_global('discover_recent', $discover_recent);
    
    $this->template->set_global('search_query', $search_query);
    
    
    
    $this->template->set_global('body_class', "page-search");
    
    
    
    
    
    $this->template->set_global('pagination',$pagination,false);#true sẽ là html->text , false sẽ chuyển text->html sang
    
    
    //doi lai thanh gallery categories
    $gallery_categories = \DB::select()->from("galleries_categories")->join("galleries_categories_lang")->on("galleries_categories.id","=","galleries_categories_lang.category_id")->where("galleries_categories_lang.lang_code","=",\Lang::get_lang())->order_by("position","asc")->execute()->as_array();     
    $data["gallery_categories"] = $gallery_categories;
    
    #print_r($params);
    $data["module"] = $params["m"];
    $content = \View::forge("search/index",$data,false);#ko luu cache 
    #$content = get_cache_frontend("home","home/index",$data);//lưu cache luôn cho trang chủ 
    
    $this->theme->get_template()->set('content', $content);
    
    
    
    
    
    
	}
}
