<?php
class Controller_Supload extends Controller
{
  public function before()
  {
    parent::before();
    \Module::load('image');
  }
  public function action_index(){
    if(\Input::is_ajax()) {

      $id = \Input::get("id");

      $file = $_FILES;
      if(!empty($file)){
        $path = \Simage::create_folder($id,'p',true);
        $_file = $file['file'];
        $file_ext = false;
        $image = \Simage::upload_img($id,$path,'p',$_file['name'],'M',false,$file_ext);
        echo json_encode(array('image_id'=>$image));die();
      }
      exit;
    }
    exit;
  }
  //all image M
  public function action_get_images(){


    //$object_id, $object_type, $type
    $gets = \Input::get();
    $object_id = $gets['object_id'];
    $object_type = $gets['object_type'];
    $type = array($gets['type']);

    $images = \Image\Model_Image::get_images($object_id,$object_type,$type);
    #print_r($images);exit;
    //set path
    foreach($images as $k=>&$image){
      #$thumb = get_images($image['image_id'],NULL,$object_type,'M',true);
      $thumb = Uri::base().'files/images/thumbnails/'.$image['image_path'];
     # echo $thumb;exit;
      $image['thumb'] = $thumb;
    }
    //echo $this->db->last_query();exit;
    header("Content-Type: application/json", true);
    echo json_encode($images);exit;
  }
}
