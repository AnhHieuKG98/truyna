<?php



class Shtml{

  /*
  ## thay thế Form::select
  ## Dùng Shtml::select tương tự nhưng sẽ có thêm 1 attribute cho option đó là disabled thông qua $id_except

  $id_except : không cho chọn option có value
  */
  public static function select($field, $values = null, array $options = array(), array $attributes = array(),$id_except = null)
	{
    $_attrs = "";
    foreach($attributes as $key=>$v){
      $_attr_value = array_key_exists($key, $attributes) ? $attributes[$key] : null;
      if(!empty($_attr_value))
        $_attrs .= $key.'="'.$_attr_value.'" ';
    }

    $html = "<select name=\"$field\" $_attrs>";
    foreach($options as $v=>$t){
      $disabled = $selected = '';
      if($id_except == $v)
        $disabled = 'disabled';
      if($values == $v)
        $selected = 'selected';
      $html .= "<option $selected $disabled value=\"$v\">$t</option>";
    }
    $html .= '</select>';
    return $html;
	}
  /* dùng dropdown của bootstrap  cho select */
  public static function dropdown_status($obj_id,$post=NULL){
    $data = array(
      'model'  => $post,
      'obj_id' => $obj_id
    );
    echo  \View::forge("common/status",$data);#ADMIN
  }
  public static function dropdown_status_ajax($obj_id,$selected,$table,$id){
    $data = array(
      'table' => $table,
      'id' => $id,
      'selected'  => $selected,
      'obj_id' => $obj_id
    );
    echo  \View::forge("common/status_ajax",$data);#ADMIN
  }

  public static function dropdown_order_status_ajax($obj_id,$selected,$table,$id){
    $data = array(
      'table' => $table,
      'id' => $id,
      'selected'  => $selected,
      'obj_id' => $obj_id
    );
    echo  \View::forge("admin/common/order_status_ajax",$data);
  }
}
