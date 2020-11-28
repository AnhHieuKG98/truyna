<?php #block cart right 
#print_r($cart);?>
<a class="mini-cart-link" href="<?php echo Uri::create("order/cart")?>">
  <span class="mini-cart-icon title18 color"><i class="fa fa-shopping-basket"></i></span>
  <?php if(!empty($cart)){?>
    <span class="mini-cart-number"><?php echo count($cart["products"])?> <?php echo l("Items")?> - <span class="color"><?php echo \Kcart::subtotal(true)?></span></span>
  <?php } else {?>
    <span class="mini-cart-number">0 <?php echo l("Item")?> - <span class="color">0,000</span></span>
  <?php }?>
</a>
<div class="mini-cart-content text-left">

  <?php if(!empty($cart)){
    $cart_products = $cart["products"];
    ?>
  <h2 class="title18 color">(<?php echo count($cart_products)?>) ITEMS IN MY CART</h2>
   <div class="list-mini-cart-item">

    <?php foreach($cart_products as $item_id=>$_p){?>
    <div class="product-mini-cart table">
      <div class="product-thumb">
        <a href="detail.html" class="product-thumb-link"><img alt="" src="<?php echo $_p["image"]?>"></a>
        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
      </div>
      <div class="product-info">
        <h3 class="product-title"><a href="#"><?php echo $_p["product"]?></a></h3>
        <div class="product-price">
          <?php echo render("common/product_price",array("product"=>$_p));?>
        </div>
        <!--<div class="product-rate">
          <div class="product-rating" style="width:100%"></div>
        </div>-->
      </div>
    </div><?php } ?>

  </div>


  <div class="mini-cart-total  clearfix">
    <strong class="pull-left title18"><?php echo l("Total")?></strong>
    <span class="pull-right color title18"><?php echo \Kcart::subtotal(true)?></span>
  </div>
  <div class="mini-cart-button">
    <a class="mini-cart-view shop-button" href="<?php echo Uri::create("order/cart")?>">View cart </a>
    <a class="mini-cart-checkout shop-button" href="<?php echo Uri::create("order/checkout")?>">Checkout</a>
  </div>

  <?php } ?>




</div>
