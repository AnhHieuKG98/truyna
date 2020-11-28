<?php
//Hỗ trợ các hàm liên quan tới hình ảnh
class Simage{

  /* 1 thư mục chứa 300 tấm hình, tính toán để tạo folder_id, dự kiến 1 thư mục sản phẩm có thể lên 1000 tấm vì 1 sản phẩm có nhiều hình */
  /* object_id là id của table.image */
  public static function create_folder($module='blog', $object_id = 1, $object_type , $get_thumbs = false)
	{
		\Module::load('image');#load module image
		$folder_id = 0;
		#$folder_id = ceil($object_id/300);#phai lay image_id để tính toán
		//lấy image_id cuối cùng >>> NO
		// đổi lại lấy object ID luôn
		#$image_last = \Image\Model_Image::find("last");
		#$object_id = isset($image_last) ?  $image_last->id : 1;
		$folder_id = ceil($object_id/300);

    /*
		$_object_type = 'blog';
		if($object_type == 'c'){
			$_object_type = 'category';
		}
		elseif($object_type == 'v'){
			$_object_type = 'variant';
		}
		elseif($object_type == 'b'){
			$_object_type = 'banner';
		}*/
    $_object_type = $module;
		$folder = DOCROOT.'files'.DS.'images'.DS.$_object_type.DS.$folder_id;
#echo $folder;exit;
		if(!is_dir($folder))
		{
			mkdir($folder,0777,TRUE);
		}
		$folder_thumb = DOCROOT.'files'.DS.'images'.DS.'thumbnails'.DS.$_object_type.DS.$folder_id;
		if(!is_dir($folder_thumb))
		{
			mkdir($folder_thumb,0777,TRUE);
		}
		$path = array('full_path'=>$folder);
		if($get_thumbs == true){
			$path['thumb_path'] = $folder_thumb;
		}
		//path related , save to database
		$path['image_path'] = 'files/images/thumbnails/'.$_object_type.'/'.$folder_id.'/';
		$path['image_path_save'] = $_object_type.'/'.$folder_id.'/';
		return $path;
	}

	/*
		$path : Array()
			$path['full_path']  : đường dẫn tuyệt đối để lưu ảnh gốc lên server
			$path['thumb_path'] : đường dẫn tuyệt đối để lưu ảnh thumb lên server
			$path['image_path'] : lưu database, đây là đường dẫn tương đối
	*/
	public static function upload_img($module='blog',$object_id =0 , $path, $object_type = 'p',$file_name, $type = 'M' , $overwrite = true, $_file_ext=true){
		\Module::load('image');#load module image
		#$alt = $file_name;
		#$file_name = 'canlam.net-'.TIME().'-'.$file_name;#file name sẽ lưu database và file trong thư mục

		#$image_last = \Image\Model_Image::find("last");
		#$object_id = isset($image_last) ?  $image_last->id : 1;
/*
		$_object_type = 'post';
		if($object_type == 'c')
			$_object_type = 'category';
		elseif($object_type == 'v')
			$_object_type = 'variant';
		elseif($object_type == 'b')
			$_object_type = 'banner';
    */
    $_object_type = $module;
		if($type=='A' && !empty($overwrite)){
			//// nếu Type = A tức là chỉ cần tồn tại 1 ảnh, nó là ảnh đại diện, lưu URL vào bảng đối tượng (shop_products)
			\Simage::delete_image(0,$object_id, $object_type,$type,$overwrite,$module);
		}
		$result = NULL;
		//--------------UPLOAD--------------
		// Custom configuration for this upload
		$config = array(
        'max_size'    => 2048000,#10kb  10240   1024000 ; 4096000 400kb , 512000 : 500kb    2048000 : 2MB
		    'path' => $path['full_path'],//DOCROOT.'files'
		    'randomize' => true,
		    'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
		);
		#echo $file_name;exit;

		// process the uploaded files in $_FILES
		Upload::process($config);
		// if there are any valid files
		if (Upload::is_valid())
		{
		    // save them according to the config
		    Upload::save();
		    // call a model method to update the database

		    $file_upload = Upload::get_files();
		    $file_name_upload = $file_upload[0]["saved_as"];
		    $alt = $file_upload[0]['basename'];
		    $file_name = "tmiads.vn-".Helper::create_seo_name($file_upload[0]['basename'])."-".TIME();
				$file_name .= '.'.$file_upload[0]['extension'];

				#echo $file_name_upload;
				#echo "____";
				#echo $file_name;exit;
		    //đổi tên file lại theo đúng tên file bạn đã up, có thể chèn text đầu file
		    \File::rename($path["full_path"].DS.$file_name_upload, $path["full_path"].DS.$file_name);

		    #$image_path = $path["image_path"].$file_name;#$file_name;
		    $image_path = $path["image_path_save"].$file_name;#luu database chỉ lấy từ folder type

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
			  	if($type=="A__________BK"){
			  		\Module::load('blog');
            
			  		if($object_type=="p"){
			  			$product_update = \Blog\Model_Blog_Post::find($object_id);
			  			#echo $object_id;print_r($product_update);exit;
			  			$product_update->image = $image_path;

			  			if($product_update->save()){
			  				#print_r($product_update);exit;
			  			}
			  		}
			  	}
			  	//tạo ảnh thumb, sau này sẽ xoá đi và dùng setting để lấy tương ứng
			  	\Image::load($path['full_path'].'/'.$file_name)->crop_resize(100, 100)->save($path['thumb_path'].'/'.$file_name);

			  	return $image_model->id;
		  	}
		}else{
      return false;
    }
		//------------------------------UPLOAD IMAGE----------------
		return $result;
	}
	//$overwrite
	public static function delete_image( $image_id = 0,$object_id, $object_type, $type , $overwrite = true ,$module = "blog"  )//$overwrite = false thì xóa hình folder
	{
   # print_r($object_id);exit;
		\Module::load('image');
    
		$image = \Image\Model_Image::query()->where('object_id', $object_id)->where("module",$module)->where("object_type",$object_type)->where("type",$type)->get_one();
    
    #print_r($module);exit;
    
    
		$image_path = $image['image_path'];
    
		//delete in database
    \Image\Model_Image::query()->where('object_id', $object_id)->where("object_type",$object_type)->where("type",$type)->delete();
		//delete in folder
		$folder_file_full = DOCROOT.'files/images/'.$image_path;
    $folder_thumb = DOCROOT.'files/images/thumbnails/'.$image_path;
    if(is_file($folder_file_full))
      unlink($folder_file_full);
    if(is_file($folder_thumb))
      unlink($folder_thumb);

	}

	//Chưa sử dụng, dùng cho front-end
	public static function get_images( $image_id = 0,$object_id = 0, $object_type = 'p', $type = 'M',$thumb = false  )
	{
		$image_url = Uri::create('files/no_image.png');

    /*
    $_object_type = 'product';
		if($object_type == 'c'){
			$_object_type = 'category';
		}
		elseif($object_type == 'v'){
			$_object_type = 'variant';
		}
		elseif($object_type == 'b'){
			$_object_type = 'banner';
		}
    */
		#$ci =& get_instance();
		if(!empty($image_id)){ //get image default
      /*
			$ci->db->where('image_id',$image_id);
			$ci->db->where('type',$type);
			$ci->db->limit(1);
			$image = $ci->db->get('images')->row_array();
			if(!empty($image)){
				$folder_id = 0;
				$folder_id = ceil($image['object_id']/300);
				$_thumb = '';
				if(!empty($thumb))
					$_thumb = 'thumbnails/';
				$folder = '/uploads/images/'.$_thumb.$_object_type.'/'.$folder_id.'/';
				$_image_url = base_url($folder.$image['image_path']);
				//$image_url = is_file($_image_url);
				//echo site_url($folder.$image['image_path']);exit;
				$image_url = @file_get_contents($_image_url) ? $_image_url : $image_url;
				return $image_url;
			}
      */
		}
		elseif(empty($image_id) && !empty($object_id)){ //get list image
    	\Module::load('image');
    	$image = \Image\Model_Image::query()->where('object_id',$object_id)->where('object_type',$object_type)->where('type',$type)->get();

    	return $image;
			#$ci->db->where('object_id',$object_id);
			#$ci->db->where('object_type',$object_type);
			#$ci->db->where('type',$type);
			#return $ci->db->get('images')->result_array();
		}
		return base_url('uploads/images/no_image.png');
	}

	//get 1 Image
	public static function get_image($module="blog", $image_id = 0,$object_id = 0, $object_type = 'p', $type = 'M',$thumb = false , $get_default = false )
	{
		$no_image = Uri::create('files/no_image.png');


		if(!empty($image_id)){ //get image default

		}
		elseif(empty($image_id) && !empty($object_id)){ //get list image
    	\Module::load('image');
    	$image = \Image\Model_Image::query()->where('object_id',$object_id)->where('object_type',$object_type)->where('type',$type)->where('module',$module)->get_one();
    	if(!empty($image)){
	    	#return $image;
	    	if($thumb == true){
	    		return Uri::create('files/images/thumbnails/'.$image['image_path']);
	    	}
	    	else{
	    		return Uri::create('files/images/'.$image['image_path']);
	    	}
    	}else{
        if($get_default == true){
          return Uri::create("files/banner-default.jpg");
        }
				return $no_image;
    	}

		}
		return $no_image;
	}
	//lấy hình ảnh theo size
	public static function get_image_size( $module = "blog", $object_id = 0, $object_type = 'p', $type = 'M', $width = 200, $height = 200,$image_id = 0,$no_data = false) #$no_data = true thì sẽ trả về false chứ ko trả về path
	{
   # if($object_id==25)
     # return "";
		\Module::load('image');
		$no_image = Uri::create('files/no_image.png');


		if(!empty($image_id)){ //get image default
			$image = \Image\Model_Image::query()->where("id",$image_id)->where('object_type',$object_type)->where('type',$type)->where("module",$module)->get_one();
		}
		elseif(empty($image_id) && !empty($object_id)){ //get list image
    	$image = \Image\Model_Image::query()->where('object_id',$object_id)->where('object_type',$object_type)->where('type',$type)->where("module",$module)->get_one();
		}


		if(!empty($image)){
  		$img_full_path = "files/images/".$image['image_path'];

      

      if(is_file($img_full_path)){
        $sizes = \Image::sizes($img_full_path);
        
        if($sizes->width > 4000){ #nếu ảnh quá to
          return Uri::base().$img_full_path.'?size=full';// $img_full_path;
        }
        
        $file_size = \File::file_info($img_full_path);
        if($file_size["size"] > 1500000){ #2M 1500000
          return Uri::base().$img_full_path;// $img_full_path;
        }
        
        $file_size = \File::file_info($img_full_path);
        if($file_size["size"] > 1500000){
          return Uri::base().$img_full_path;// $img_full_path;
        }
        
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
        if(!is_file($cache_image)){
          \Image::load($img_full_path)->crop_resize($width, $height)->save($folder_cache.'/'.$image['image_path']);
        }


        return Uri::base().$cache_image;// $img_full_path;
        return Uri::create('files/images/thumbnails/'.$image['image_path']);
      }

  	}else{
      if($no_data)
        return false;
			return $no_image;
  	}
    if($no_data)
        return false;
		return $no_image;
	}

}
