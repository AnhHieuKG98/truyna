<?php
class Kcart{
  public static function price($value){
    return number_format($value,0,"",",")." đ";
  }

  /*
  public static function product_grid_price__BK($product){
    $html = "";
    if($product["price"] > $product["discount"] AND $product["discount"] > 0){
      $html .= '<del class="silver"><span>'.$product["price"].'</span></del>';
      $html .= '<ins class="color"><span>'.$product["discount"].'</span></ins>';
    }else{
      $html .= '<ins class="color"><span>'.$product["price"].'</span></ins>';
    }
  }*/

  public static function subtotal($format=false){
    $cart = \Session::get('cart');
    if($format==true)
      return self::price($cart["subtotal"]);
    return $cart["subtotal"];
  }
  public static function total($format=false){
    $cart = \Session::get('cart');
    if($format==true)
      return self::price($cart["total"]);
    return $cart["total"];
  }

  public static function recalculate_cart(){
    //tính lại subtotal
    $subtotal_discount = 0;
    $cart = \Session::get('cart');
    $subtotal = 0;
    foreach($cart["products"] as $item => $_p){
      $_sub = 0;
      if($_p["discount"] > 0 AND $_p["discount"] <  $_p["price"]){
        $_sub = $_p["discount"] * $_p["amount"];
        $subtotal += $_sub;

      }else{
        $_sub = $_p["price"] * $_p["amount"];
        $subtotal += $_sub;
      }
      $cart["products"][$item]["subtotal"] = $_sub;
    }
    $cart["subtotal"] = $subtotal;
    #foreach($cart["products"] as $item => $_p){

    #  $subtotal_discount += ($_p["subtotal_discount"]>0) ? $_p["subtotal_discount"] * $_p["amount"]  : $_p["subtotal"] * $_p["amount"];

    #}
    #$cart["subtotal"] = $subtotal_discount;
    #if($subtotal_discount == 0){
    #  foreach($cart["products"] as $_p){
    #    $cart["subtotal"] += $_p["subtotal"];
    #  }
    #}

    $cart["total"] = $cart["subtotal"];#tạm thời = nhau, chờ có khuyến mãi sẽ áp dụng
    \Session::set('cart', $cart);
    \Session::set_flash('success', e('Your Cart updated'));
    return $cart;
  }

}
