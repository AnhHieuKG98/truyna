<?php
class Controller_Simage extends Controller
{
  public function before()
  {
    parent::before();
    \Module::load('image');
  }
  public function action_delete( $image_id ){

    //1. lay imges
    $image = \Image\Model_Image::query()->where('id',$image_id)->get_one();
    $image_path = $image['image_path'];
    $image->delete();

    //remove file in /files/images/.$image_path
    //remove file in /files/images/thumbnails/.$image_path
    #print_r($image_path);exit;


    $object_type  = $image['object_type'];
    $object_id    =  $image['object_id'];
    /*
    $_object_type = 'product';
    if($object_type == 'c')
      $_object_type = 'category';
    elseif($object_type == 'v')
      $_object_type = 'variant';
    $folder_id = 0;
    $folder_id = ceil($object_id/300);*/
    $folder_file_full = DOCROOT.'files/images/'.$image_path;
    $folder_thumb = DOCROOT.'files/images/thumbnails/'.$image_path;
    #$file_name = $image['image_path'];
    if(is_file($folder_file_full))
      unlink($folder_file_full);
    if(is_file($folder_thumb))
      unlink($folder_thumb);
    //xoa database
    #$this->db->where('image_id',$image_id);
   # $this->db->delete('images');
    echo 1;exit;
  }
}
