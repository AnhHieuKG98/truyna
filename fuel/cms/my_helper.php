<?php 
if ( ! function_exists('get_posts_by_cat'))
{
  #module news
  function get_posts_by_cat($attr = array()){
    $module_name = "news";
    \Module::load($module_name);
    $_data = array();
    $limit = !empty($attr["limit"]) ? $attr["limit"] : 10;
    
     $cat_data = \News\Model_News_Category::find("first",array(
        "related" => array("lang" => array("where"=>array("lang_code"=>\Lang::get_lang()))),
        "where"=>array(array("slug"=>$attr["category_slug"]))
      )
    );
    if(!empty($cat_data)){
      $cid = $cat_data->id;
      $subcats = array($cid);
      $query = \News\Model_News_Post::query();
      $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
     
      $query->related($module_name.'_categories_posts')->related($module_name.'_categories_posts.'.$module_name.'_post',array(
      
      "where"=>array(
        array($module_name.'_categories_posts.category_id',"IN",$subcats)
      ),
      "order_by"=>array("position"=>"asc")
      
      ));
      #$query->and_where_open();
      $query->where("status","=","A")->rows_limit($limit);
      #$query->and_where_close();
      $items =  $query->get();
      return $items;
    }
    
    
    
    
  }
}
if ( ! function_exists('tk_lines_to_array')) # xoá ảnh trong thư mục và database
{
  function tk_lines_to_array($string){
    return explode(PHP_EOL,$string);
  }
}
if ( ! function_exists('tk_delete_image')) # xoá ảnh trong thư mục và database
{
  function tk_delete_image($attrs = array()){
    
    $object_id = $attrs["object_id"];
    $object_type = $attrs["object_type"];
    $module = $attrs["module"];
    $type = !empty($attrs["type"]) ? $attrs["type"] : false;
    $no_remove_db = !empty($attrs["no_remove_db"]) ? $attrs["no_remove_db"] : false;
    
    $images_query = \DB::select()->from('images')->where('object_id', $object_id)->where('object_type', $object_type)->where('module', $module);
    if(!empty($type)){
      $images_query = $images_query->where("type",$type);
    }
    $images = $images_query->execute()->as_array();
    
    foreach($images as $image_object){
      $image_id = $image_object["id"];
      $image_path = $image_object["image_path"];
      
      //delete in folder
      $folder_file_full = DOCROOT.'files/images/'.$image_path;
      $folder_thumb = DOCROOT.'files/images/thumbnails/'.$image_path;
      if(is_file($folder_file_full))
        unlink($folder_file_full);
      if(is_file($folder_thumb))
        unlink($folder_thumb);
      if(!$no_remove_db){
        \DB::delete('images')->where('id', $image_id)->execute();
      }
    }
  }
}
if ( ! function_exists('tk_upload_image'))
{
  //tên input đặt dạng 
  /*
  name="dining_c_A"  : [module][object_type][type]
  */
	function tk_upload_image($object_id,$attrs = array())
	{
    \Module::load('image');#load module image
    
    $module = $attrs["module"];
    $object_type = $attrs["object_type"];
    $type = $attrs["type"];
    $field = $attrs["field"];
    
    $edit = !empty($attrs["edit"]) ? $attrs["edit"] : false;
   # echo $field;exit;
    
    
    //1 : tạo folder lấy path 
    $folder_id = ceil($object_id/300);
    $folder = DOCROOT.'files'.DS.'images'.DS.$module.DS.$folder_id;
    if(!is_dir($folder))
		{
			mkdir($folder,0777,TRUE);
		}
    $folder_thumb = DOCROOT.'files'.DS.'images'.DS.'thumbnails'.DS.$module.DS.$folder_id;
		if(!is_dir($folder_thumb))
		{
			mkdir($folder_thumb,0777,TRUE);
		}
    $path = array('full_path'=>$folder);
    $path['image_path'] = 'files/images/thumbnails/'.$module.'/'.$folder_id.'/';
		$path['image_path_save'] = $module.'/'.$folder_id.'/';
    
    
    
    //2 : up ảnh lên 
    $config = array(
      #'field' => $field,
      #'name' => $field,
       'max_size'    => 2048000,#10kb  10240   1024000 ; 4096000 400kb , 512000 : 500kb    2048000 : 2MB
      'path' => $path['full_path'],//DOCROOT.'files'
      'randomize' => true,
      'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
		);
    
    Upload::process($config);
    if (Upload::is_valid())
		{
    #print_r($config);exit;  
      // save them according to the config
      Upload::save();
     
      // call a model method to update the database
      $file_upload = \Upload::get_files();
      #print_r($file_upload);exit;
       
      $file_name_upload = $file_upload[0]["saved_as"];
      $alt = $file_upload[0]['basename'];
      $file_name = "tmiads.vn-".Helper::create_seo_name($file_upload[0]['basename'])."-".TIME();
      $file_name .= '.'.$file_upload[0]['extension'];
      
      #print_r($file_name);exit;

      #echo $file_name_upload;
      #echo "____";
      #echo $file_name;exit;
      //đổi tên file lại theo đúng tên file bạn đã up, có thể chèn text đầu file
      #@echo $path["full_path"].DS.$file_name_upload;exit;
      \File::rename($path["full_path"].DS.$file_name_upload, $path["full_path"].DS.$file_name);

      #$image_path = $path["image_path"].$file_name;#$file_name;
      $image_path = $path["image_path_save"].$file_name;#luu database chỉ lấy từ folder type

      #if($edit == false)
        //kiem tra hinh anh da co trong database chưa 
      $images_exist = \DB::select()->from("images")->where("object_id",$object_id)->where("object_type",$object_type)->where("type",$type)->where("module",$module)->execute()->as_array();
      
      if(!empty($images_exist) AND !empty($edit)){
        //xoá ảnh cũ 
        
        $data_upload = array("object_id"=>$object_id,"module"=>$module,"object_type"=>$object_type,"type"=>$type,"no_remove_db"=>true);
        tk_delete_image($data_upload);
          
        \DB::update("images")->where("object_id",$object_id)->where("object_type",$object_type)->where("type",$type)->where("module",$module)->set(array(
          "image_path"	=> $image_path,
          'file_size'		=> $file_upload[0]['size'],
          'alt'		=> $alt,
        ))->execute();
      }else{
        $image_model = \Image\Model_Image::forge(array(
          "object_id"=>$object_id,
          "object_type"	=> $object_type,
          "type"	=> $type,
          "image_path"	=> $image_path,
          'file_size'		=> $file_upload[0]['size'],
          'alt'		=> $alt,
          'module'		=> $module,
        ));
        if($image_model->save()){
          //lưu URL vào bảng đối tượng (shop_products) cho  type=A
          //tạo ảnh thumb, sau này sẽ xoá đi và dùng setting để lấy tương ứng
          ##\Image::load($path['full_path'].'/'.$file_name)->crop_resize(100, 100)->save($path['thumb_path'].'/'.$file_name);
          return $image_model->id;
        }
      }
		}
  }
}
if ( ! function_exists('get_path_image_size'))
{
  //$module = "blog", $object_id = 0, $object_type = 'p', $type = 'M', $width = 200, $height = 200,$image_id = 0
	function get_path_image_size($object_id,$attrs = array())
	{
    
    $module = $attrs["module"];
    $object_type = $attrs["object_type"];
    $type = $attrs["type"];
    $width = isset($attrs["width"]) ? $attrs["width"] : 100;
    $height = isset($attrs["height"]) ? $attrs["height"] : 80;
    $full = !empty($attrs["full"]) ? $attrs["full"] : false;
    \Module::load('image');
    $image = \Image\Model_Image::query()->where('object_id',$object_id)->where('object_type',$object_type)->where('type',$type)->where("module",$module)->get_one();
    
    
    
    if(!empty($image)){
  		$img_full_path = "files/images/".$image['image_path'];
      
      
        
        
      //phai kiem tra hình anh co tren server ko 
      if(!is_file($img_full_path)){
        return "";
        #return "khong co file ".$img_full_path;
      }else{
        # return "co file ".$img_full_path;
      }
      
      if(!empty($full)){
        return Uri::base().$img_full_path;// $img_full_path;
      }
      $sizes = \Image::sizes($img_full_path);
      if($width > $height){ // hình chữ nhật ngang
        if($sizes->width < $sizes->height){
          return Uri::base().$img_full_path;// $img_full_path;
        }
      }
      
      
  		//make folder cache
  		$folder_cache = "files/images/cache";
  		if(!is_dir($folder_cache))
			{
				mkdir($folder_cache,0777,TRUE);
			}
			$folder_cache .= "/".$width;
			if(!is_dir($folder_cache))
			{
				mkdir($folder_cache,0777,TRUE);
			}
			$folder_cache .= "/".$height;
			if(!is_dir($folder_cache))
			{
				mkdir($folder_cache,0777,TRUE);
			}


			$folder_save = explode("/",$image['image_path']);
			$folder_cache_end = $folder_cache."/".$folder_save[0];
			if(!is_dir($folder_cache_end))
			{
				mkdir($folder_cache_end,0777,TRUE);
			}
			$folder_cache_end .= "/".$folder_save[1];
			if(!is_dir($folder_cache_end))
			{
				mkdir($folder_cache_end,0777,TRUE);
			}

  		#$img_cache_path = "files/images/cache/".$image['image_path'];

			$cache_image = $folder_cache.'/'.$image['image_path'];
      $sizes = \Image::sizes($img_full_path);
      if(!empty($sizes)){
        if($sizes->width > 2500){
          return \Uri::base().$img_full_path;
        }
        
        
        
      }
      
      
      
			if(!is_file($cache_image)){
        
  			#\Image::load($img_full_path)->resize($width, $height)->save($folder_cache.'/'.$image['image_path']);
        \Image::load($img_full_path)->crop_resize($width, $height)->save($folder_cache.'/'.$image['image_path']);
			}

      
      
  		return Uri::base().$cache_image;// $img_full_path;
    	return Uri::create('files/images/thumbnails/'.$image['image_path']);
  	}
    return false;
  }
}

if ( ! function_exists('l'))
{
	function l($string)
	{
    return __($string) ? __($string) : $string.'-['.\Lang::get_lang().']';
  }
}
if ( ! function_exists('fn_send_email'))
{
  //\Registry::get_setting("email.smtp_host"),#ssl://smtp.gmail.com
  function fn_send_email($email_received,$subject,$template_body){
    $smtp_user = \Registry::get_setting("email.smtp_user");
    \Package::load('email');
    $config = array( 
      'driver' => 'smtp',
      'is_html' => true,
      'charset' => 'utf-8',
      'smtp' => array(
        'host' => "ssl://smtp.gmail.com",
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
    $email = \Email::forge($config);
    $email->to($email_received , \Registry::get_setting("site.site_name"));
    $email->subject($subject);
    $email->body($template_body);
    $email->send();
  }
}
if ( ! function_exists('fn_get_langs'))
{
  function fn_get_langs(){
    #$locales = Config::get('locales');
    return array(
      "en","vi"
    );
  }
  #$ Dollar
  function fn_get_currency(){
    #$locales = Config::get('locales');
    $currencies = array(
      "en"=>'$ Dollar',
      "vi"=>"đ VND"
    );
    return $currencies[\Lang::get_lang()];
  }
}


/*
ex : 
    $file_cache = "frontend.".md5("home");
    try
    {
      $content = \Cache::get($file_cache);

    }
    catch (\CacheNotFoundException $e)
    {
      $content = \View::forge('home/index',$data,false);
      \Cache::set($file_cache, $content);
    }
*/
if ( ! function_exists('get_cache_frontend'))
{
    function get_cache_frontend($file,$path,$data){
      $file_cache = "frontend.".md5($file).\Lang::get_lang();
      try
      {
        $content = \Cache::get($file_cache);

      }
      catch (\CacheNotFoundException $e)
      {
        $content = \View::forge($path,$data,false);
        //minify HTML 
        #$content = tm_outputfilter_gzip($content);
        
        \Cache::set($file_cache, $content);
      }
      return $content;
    }
}

function tm_outputfilter_gzip($content)
{
   $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $content = preg_replace($search, $replace, $content);
    return $content;
}

if ( ! function_exists('remove_width_attribute')) #frontend
{
  function remove_width_attribute( $html ) {
     $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
     $html = preg_replace('/(<img[^>]+) style=".*?"/i', '$1', $html);
     //get src and replace with Uri::create
    preg_match_all('/<img[^>]+>/i',$html, $imgTags);
    for ($i = 0; $i < count($imgTags[0]); $i++) {
      preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
      if(isset($imgage[1])){
        $src = $imgage[1];
        $html = str_replace($src, \Uri::create($src), $html);
      }
      //get alt 
      #preg_match( '@alt="([^"]+)"@' , $html, $match );
      #$alt = array_pop($match);
      #$html .= $alt;
      
    }
    return $html;
  }
}


if ( ! function_exists('remove_style_font')) #frontend
{
  function remove_style_font( $html ) {
    #$html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);#xoá luôn style=""
    $html = preg_replace('/font-family.+?;/', "", $html); # chỉ xoá font-family trong style
    return $html;
  }
}