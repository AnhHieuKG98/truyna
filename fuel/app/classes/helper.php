<?php
class Helper{
  public static function tm_alert($val,$name="",$mess=""){
    $m = !empty($name) ? $val->error($name)->get_message() : $mess;
    $m = !empty($m) ? $m : "Bạn chưa nhập!";
    return "<ul class=\"parsley-errors-list filled\"><li class=\"parsley-required\">".$m."</li></ul>";
  }
  public static function dropdown_status($selected = ""){

    $options = array(""=>"--All--","A"=>l("Active"),"H"=>l("Hidden"));
    $option_render = "";
    foreach($options as $v=>$t){
      $_selected = ($selected==$v) ? " selected " : "";
      $option_render .= "<option $_selected value=\"$v\">$t</option>";
    }
    return "<select class=\"form-control\" name=\"status\">$option_render</select>";
  }

  public static function dropdown_order_status($selected = ""){

    $options = array(""=>"--All--","O"=>"Open","P"=>"Processed","C"=>"Complete","I"=>"Canceled");
    $option_render = "";
    foreach($options as $v=>$t){
      $_selected = ($selected==$v) ? " selected " : "";
      $option_render .= "<option $_selected value=\"$v\">$t</option>";
    }
    return "<select class=\"form-control\" name=\"status\">$option_render</select>";
  }

  /*
    $s = "00" : format d/m/Y 00:00

    $s = "23" : format d/m/Y 23:59
  */
  public static function date_to_int($string_date,$s = NULL){
    $hi = "";
    if($s=="00")
      $hi = " 00:00";
    if($s=="23")
      $hi = " 23:59";
    $date_format = \Registry::get_setting("general.date_format");
    if($date_format=="d/m/Y"){
      $_array = explode("/", $string_date);
      $_Ymd = $_array[2]."/".$_array[1]."/".$_array[0];
      return  strtotime($_Ymd.$hi);
    }
    return  strtotime($string_date.$hi);
  }


  public static function create_seo_name( $_object_name ){
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

  public static function array_level1($model,&$result)
	{
		foreach($model as $item){
			$result[] = $item;
			if(!empty($item['childs'])){
				$tmp = $item['childs'];
				unset($item['childs']);
				$result[] = Helper::array_append($tmp,$result);
				unset($item['childs']);

			}
		}
    /*
		for($i=0;$i<count($result);$i++){
			if(count($result[$i]) > 0){
				$result[$i]['childs'] = NULL;
				unset($result[$i]['childs']);
			}
			else{
				unset($result[$i]);
			}
		}*/
    for($i=0;$i<count($result);$i++){
      if(!empty($result[$i])){
        if(count($result[$i]) > 0){
          $result[$i]['childs'] = NULL;
          unset($result[$i]['childs']);
        }
      }
      else{
        unset($result[$i]);
      }
      
		}
		foreach($result as $key=>&$value){
			if(count($result[$key])==0)
				unset($result[$key]);
		}
		//print_r($result);exit;
	}
  public static function k2_array_for_select()
	{
		$args = func_get_args();

		$return = array();
		switch (count($args))
		{
			case 5: // co child
				foreach ($args[0] as $itteration):
					if (is_object($itteration)){
						$id = $itteration->id ;
						if($id != $args[4]){
							$itteration = (array) $itteration;
							$return[ $itteration[$args[1]]] = $itteration[$args[3]].$itteration[$args[2] ];
						}
					}

				endforeach;
				break;
			case 4: // co child
				foreach ($args[0] as $itteration):
          #echo "<pre>";
          #print_r($itteration);
          #echo "<hr />";
          #echo "</pre>";
          #if( isset($itteration[$args[1]]) AND isset($itteration[$args[3]]) AND isset($itteration[$args[2]]) ){
            if (is_object($itteration))
              $itteration = (array) $itteration;
            $return[ $itteration[$args[1]]] = $itteration[$args[3]].$itteration[$args[2] ];
          #}
				endforeach;
				break;
			case 3:
				foreach ($args[0] as $itteration):
					if (is_object($itteration))
						$itteration = (array) $itteration;
					$return[$itteration[$args[1]]] = $itteration[$args[2]];
				endforeach;
				break;

			case 2:
				foreach ($args[0] as $key => $itteration):
					if (is_object($itteration))
						$itteration = (array) $itteration;
					$return[$key] = $itteration[$args[1]];
				endforeach;
				break;

			case 1:
				foreach ($args[0] as $itteration):
					$return[$itteration] = $itteration;
				endforeach;
				break;

			default:
				return false;
		}

		return $return;
	}
  public static function array_append($model,&$result){
		foreach($model as $item){
			$result[] = $item;
			if(!empty($item['childs'])){
				$tmp = $item['childs'];
				unset($item['childs']);
				$result[] = Helper::array_append($tmp,$result);
				unset($item['childs']);
			}
		}

  //		echo print_r($result);exit;
	}

  public static function time_elapsed_string($datetime, $full = false) {
    if(is_numeric($datetime))
      $datetime = date("Y/m/d H:i:s",$datetime);
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
  public static function text_short($string , $l = 100){
    $string = html_entity_decode($string);
    return mb_strimwidth($string, 0, $l, "...", "utf8");
  }

  public static function price($value){
    return number_format($value,0,"",",");
  }

  public static function seo_url($object,$type="p"){
    $u = "";
    if($type=="p"){
      $u = "shop/product/";
    }

    return Uri::base().$u.$object["slug"];
  }
}
