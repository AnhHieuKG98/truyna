<?php
class Controller_Ajax extends Controller {#Controller Controller_Frontend
  public function before(){
    parent::before();
   # \Module::load("shop");
    //add path 
    
    $theme_front = \Registry::get_setting("theme.core_theme_front");
    //add views từ theme default : không xoá, theme này sẽ là parent của các theme khác
    Finder::instance()->add_path(APPPATH.'..'.DS.'cms'.DS.'themes' . DS . "default", -1);
    //add views từ theme
    Finder::instance()->add_path(APPPATH.'..'.DS.'cms'.DS.'themes' . DS . $theme_front, -1);
  }

  public function action_remove_cart(){
    Session::delete('cart');
  }
  public function action_status() {
    $table  = Input::post("table");
    $id     = Input::post("id");
    $status = Input::post("status");

    if(\Input::is_ajax()) {
      //status old

      $status_old = DB::select()->from($table)->where('id', $id)->execute()->get("status");


      $query = DB::update($table)->where('id', $id)->value('status', $status)->execute();#\DB::expr("A")
      $data = array(
        "table" => $table,
        "id"  => $id,
        "status"  => $status,
        "tr_class_old" => "tm-status-".strtolower($status_old),
        "tr_class_new" => "tm-status-".strtolower($status),
        "tr_id_update" => 'status_update_'.$id,
      );
      $_m = str_replace("_",".",$table);#blog.categories
      //remove cache categories.tree
      Cache::delete_all("backend.$_m",'file');
      #Cache::delete_all('backend.blog.categories','file');
      #Cache::delete_all('backend.blog.posts', 'file');
      echo json_encode($data);
    }
    exit;
  }


  public function action_add_to_cart(){
    if(\Input::is_ajax()) {
      $post_data = \Input::post();
      $product_id = $post_data["product_id"];

      //**************************
      //sau này sẽ add to cart với option nữa
      //**************************

      $shop_image_width_small = \Registry::get_setting("appearance.shop_image_width_small");
      $shop_image_height_small = \Registry::get_setting("appearance.shop_image_height_small");

      $product_data = \Shop\Model_Shop_Product::find($product_id)->to_array();
      list($options,$variants) = \Shop\Model_Shop_Product_Option::fn_get_options($product_id,array("get_variants"=>"Y"));
      $product_data["options"] = $options;

      $item_id = \Shop\Model_Shop_Product_Option::fn_generate_hash_id($product_data["id"]);#id for order_details


      $image_thumb = \Simage::get_image_size($product_data["id"],"p","A",$shop_image_width_small,$shop_image_height_small);

      $amount = !empty($post_data["amount"]) ? $post_data["amount"] : 1;
      $cart_product_item = array(
          "product_id"          => $product_data["id"],
          "product"             => $product_data["title"],
          "product_code"             => $product_data["product_code"],
          "amount"              => $amount,
          "price"               => $product_data["price"],
          "discount"            => $product_data["discount"],
          "subtotal"            => $product_data["price"] * $post_data["amount"],
          "subtotal_discount"   => $product_data["discount"] * $post_data["amount"],
          "image"               => $image_thumb,
          "options"             => array(),
          "options_selected"    => array(),
      );
      if($product_data["discount"]>0 AND $product_data["discount"]<$product_data["price"]){
        #$cart_product_item["subtotal_discount"] = $product_data["discount"] * $post_data["amount"];
      }

      $cart = \Session::get('cart');

      if(empty($cart)){
        #$cart = \Session::instance('cart');
        $_cart = array("products"=>array(),"total"=>0,"subtotal"=>0);
        $_cart["products"][$item_id] = $cart_product_item;
        \Session::set('cart', $_cart);
      }else{
        if(isset($cart["products"][$item_id])){
          $cart["products"][$item_id]["amount"] = $cart["products"][$item_id]["amount"] + $amount;
        }else{
          $cart["products"][$item_id] = $cart_product_item;
        }
        \Session::set('cart', $cart);
      }
      $cart = \Kcart::recalculate_cart();      
      //lấy HTML của 1 số block 
      #print_r($cart);exit;
      $cart_block_content = render('modules/order/blocks/cart_content',array("cart"=>$cart));
      $data = array(
        'cart_block_content'  => $cart_block_content
      );
      echo json_encode($data);exit;
    }
    exit;
  }
}
