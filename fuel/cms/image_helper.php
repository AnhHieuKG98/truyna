<?php
if ( ! function_exists('cms_upload_image'))
{
	function cms_upload_image($object_id,$module,$params = array())
	{
    
    //remove image 
    
    $remove_image = \Input::post("remove_image");
    if(!empty($remove_image)){
      foreach($remove_image as $image_id=>$on){
        $images = \DB::select()->from("images")->where("id","=",$image_id)->execute()->as_array();
        foreach($images as $image){
          $image_path = $image["image_path"];
          $folder_file_full = DOCROOT.'files/images/'.$image_path;
          if(is_file($folder_file_full))
            unlink($folder_file_full);
          \DB::delete("images")->where("id","=",$image_id)->execute();
        }
      }
    }
    $folder_id = ceil($object_id/300);
    
    $files = $_FILES;
    
    
    $folder = DOCROOT.'files'.DS.'images'.DS.$module.DS.$folder_id;
    if(!is_dir($folder))
    {
      mkdir($folder,0777,TRUE);
    }
    $path = array(
      'full_path'=>$folder,
      'image_path_save' => $module.'/'.$folder_id.'/'
    );
    
    #$path = cms_create_folder_image($object_id,$module);
    
    #https://www.tutorialspoint.com/fuelphp/fuelphp_file_uploading.htm
    $config = array(
        'max_size'    => 2048000,#10kb  10240   1024000 ; 4096000 400kb , 512000 : 500kb | 2048000 : 2MB
        'path' => $path["full_path"],
        'randomize' => false,
        #'new_name' => 'my_pic.jpg',
        'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png', 'tif', 'svg'),
    );
    \Upload::process($config);
    if (\Upload::is_valid())
    {
     
      \Upload::save();
      $image_uploaded = \Upload::get_files();
      
      $images_name = array();
      foreach($files as $fname=>$datas){
        if(!empty($datas["name"])){#
          if(is_array($datas["name"])){
            $images_name = array_merge($images_name,$datas["name"]);#
          }else{
            $images_name[] = $datas["name"];
          }
        }
        
      }
      
      foreach($images_name as $index=>&$name){
        $_ext = substr($name,-4);//.jpg
        $_file_name_old = substr($name,0,-4);//.jpg
        $images_name[$index] = cms_img_create_seo_name($_file_name_old).'-'.time();
      }
      
      foreach($image_uploaded as $_value){
        $images_path[$_value["field"]] = array(
            "image_path"=>$path["image_path_save"].$_value['saved_as'],
            "file_size"=>$_value['size'],
            "alt"=>$_value['basename'],
        );
      }
      $all_image_data_tmp = array();
      foreach($images_path as $f => $_image_value){ #$f : image_files:0 image_files:1 image_files:2 
        $f_cel = explode(":",$f);
        $f_name = reset($f_cel);
        //tính toán $f_name để đưa ra data cho table images 
        $image_data = explode("_",$f_name);
        $all_image_data_tmp[] = array(
          "object_id"=>$object_id,
          "module"=>$image_data[0],
          "object_type"=>$image_data[1],
          "type"=>$image_data[2],
          "image_path"=>$_image_value["image_path"],
          'file_size'		=> $_image_value["file_size"],
          'alt'		=> $_image_value["alt"]
        );//"field_name"=>$f_name,
      }
      //lưu vào database 
      $images_id = array();
      foreach($all_image_data_tmp as $insert){
        $query = \DB::insert('images');
        list($insert_id,) = $query->set($insert)->execute();
        $images_id[] = $insert_id;
      }
      
      ////kiêm tra file gốc với định dạng trên web đúng ko, nếu ko đúng thì cập nhật lại database và rename lại ảnh
      $images_insert = \DB::select()->from("images")->where("id","in",$images_id)->execute()->as_array();    
      $index = 0;
      
      foreach($images_insert as $_img){
        $_img_path = DOCROOT.'files/images/'.$_img['image_path'];
        if(is_file($_img_path)){
          
          $info = getimagesize($_img_path);
if(!empty($info)){
          
            #print_r($_img_path);exit;
            
            $ext = pathinfo($_img_path, PATHINFO_EXTENSION);
            $mime = $info["mime"];#mime là chính xác nhất
            $mime_ext = explode("/",$mime);
            $mime_ext = $mime_ext[1];
            
            if($ext != $mime_ext){
              #\DB::select()->from("images")->where("id","in",$images_id)->execute()
              
              if(strpos($_img_path,'.'.$ext,1)) {
                $srcfile = $_img_path;
                $ext_old = substr($_img_path,-4);
                $newfile = str_replace($ext_old,'.'.$mime_ext,$_img_path);

                $old = explode("/",$_img["image_path"]);
                $_pos = count($old)-1;
                #echo $old[$_pos];exit;
                $newfile = str_replace($old[$_pos],$images_name[$index].'.'.$mime_ext,$_img["image_path"]);// cms_img_create_seo_name($newfile);
                
                $image_path_save_db = $newfile;
                $newfile = DOCROOT.'files/images/'.$newfile;
                
              
                
                rename($srcfile,$newfile);
                $query = \DB::update('images')->where("id",$_img["id"])->set(array("image_path"=>$image_path_save_db))->execute();              
              }         
            }
          }
        }
        
        $index++;
        
      }
      
      //replace lại tên đúng với tên đã up nhưng có slug $images_name
      
      
    }
  }
}
//tạo thư mục để chứa hình ảnh upload 
function cms_get_images($object_id , $field_name)
{
  
  if(!empty($object_id)){
    
    $image_data = explode("_",$field_name);
    
    $cache_file = "image.".$object_id."_".$field_name;#frontend
    #try
    #{
        #$images = \Cache::get($cache_file);

    #}
    #catch (\CacheNotFoundException $e)
    #{
      $images = \DB::select()->from("images")->where("object_id",$object_id)->where("module",$image_data[0])->where("object_type",$image_data[1])->where("type",$image_data[2])->execute()->as_array();    
    #}
    
    
    
    return $images;
    #foreach($images as $image){
      
    #}
  }
  return false;
}
function cms_src_image($image,$attr = array())
{
  if(!empty($image)){
    
    $image_path = $image["image_path"];
    //nếu SVG thì render ra luôn
    $mime = explode(".",$image_path);
    if(end($mime)=="svg"){
      return Uri::create('files/images/'.$image_path);
    }
    
    $image_path_relative = 'files/images/'.$image_path;
    $img_full_path = DOCROOT.'files/images/'.$image_path;
   # return $img_full_path;
    if(is_file($img_full_path)){
      if(!empty($attr["full"])){
        return Uri::create($image_path_relative);
      }
      ####$sizes = \Image::sizes($img_full_path); chưa cần xét tới
      //tạo folder cache 
      $folder_cache = "files/images/cache";
      if(!is_dir($folder_cache))
      {
        mkdir($folder_cache,0777,TRUE);
      }
      
      if(!empty($attr["width"])){
        $folder_cache .= "/".$attr["width"];
        if(!is_dir($folder_cache))
        {
          mkdir($folder_cache,0777,TRUE);
        }
      }
      if(!empty($attr["height"])){
        $folder_cache .= "/".$attr["height"];
        if(!is_dir($folder_cache))
        {
          mkdir($folder_cache,0777,TRUE);
        }
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
      $cache_image = $folder_cache.'/'.$image['image_path'];
        //END tạo folder cache 
      if(!is_file($cache_image)){
        
        $quality = 60;
        
        $attr["width"] = !empty($attr["width"]) ? $attr["width"] : 0;
        if($attr["width"] < 160){# || $attr["height"] < 160
          $quality = 100;
        }
        
        if($attr["width"] > 1500){
          $quality = 30;
        }
        $image_c = \Image::forge(array(
          'quality' => $quality
        ));
        if(!empty($attr["width"]) && empty($attr["height"])){ #resize width
          $image_c->load($img_full_path)->resize($attr["width"], 0,true,true)->save($folder_cache.'/'.$image['image_path']);
        }
        elseif(!empty($attr["height"]) && empty($attr["width"])){ #resize height
          $image_c->load($img_full_path)->resize(0, $attr["height"],true,true)->save($folder_cache.'/'.$image['image_path']);
        }else{          
          $image_c->load($img_full_path)->crop_resize($attr["width"], $attr["height"],true,true)->save($folder_cache.'/'.$image['image_path']);
        }
        /*
        elseif( !empty($attr["width"]) && !empty($attr["height"]) ){ #crop image width height
          //w > h
          
          
          if(($sizes->width >= $sizes->height) && ($attr["width"] >= $attr["height"])){
            
            \Image::load($img_full_path)->crop_resize($attr["width"], $attr["height"])->save($folder_cache.'/'.$image['image_path']);
            
         
          }else{
            \Image::load($img_full_path,false)->resize($attr["width"])->save($folder_cache.'/'.$image['image_path']);
          }          
        }*/
        
        
      }
      
      return Uri::base().$cache_image;
    }
    //check image 
    
  }
  return false;
}

function cms_get_image_one($object_id , $field_name)
{
  if(!empty($object_id)){
    
    $image_data = explode("_",$field_name);
    
    #$cache_file = "image.".$object_id."_".$field_name;#frontend
    #try
    #{
    #    $images = \Cache::get($cache_file);

    #}
    #catch (\CacheNotFoundException $e)
    #{
      
      $images = \DB::select()->from("images")->where("object_id",$object_id)->where("module",$image_data[0])->where("object_type",$image_data[1])->where("type",$image_data[2])->execute()->as_array();
      #\Cache::set($cache_file, $images);
    #}
    #$images = \DB::select()->from("images")->where("object_id",$object_id)->where("module",$image_data[0])->where("object_type",$image_data[1])->where("type",$image_data[2])->execute()->as_array();    
    foreach($images as $image){
      return $image;
    }
    
    #foreach($images as $image){
      
    #}
  }
  return false;
}
function cms_remove_image_after_delete_object($object_id , $field_name)
{
  if(!empty($object_id)){
    
    $image_data = explode("_",$field_name);#->where("type",$image_data[2])
    $images = \DB::select()->from("images")->where("object_id",$object_id)->where("module",$image_data[0])->where("object_type",$image_data[1])->where("type",$image_data[2])->execute()->as_array();
    foreach($images as $image){
      $image_id = $image["id"];
      $image_path = $image["image_path"];
      $folder_file_full = DOCROOT.'files/images/'.$image_path;
      if(is_file($folder_file_full))
        unlink($folder_file_full);
      \DB::delete("images")->where("id","=",$image_id)->execute();
    }
    ##$images = \DB::delete("images")->where("object_id",$object_id)->where("module",$image_data[0])->where("object_type",$image_data[1])->execute();
  }
}
function cms_img_create_seo_name( $_object_name ){
    $space_replace = '-';
    $object_name = mb_strtolower($_object_name);
    $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á',
      'd'=>'đ|Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
    );
    foreach($unicode as $nonUnicode=>$uni)
      $object_name = preg_replace("/($uni)/i",$nonUnicode,$object_name);
    $object_name = str_replace(" ",$space_replace,$object_name);

    // remove unwanted characters
    $object_name = preg_replace('~[^-\w]+~', '-', $object_name);
    // remove duplicate -
    $object_name = preg_replace('~-+~', '-', $object_name);

    return $object_name;
  }