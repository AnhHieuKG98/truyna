<?php #page cart ?>
<?php foreach($cart["products"] as $item_id=>$product){ ?>
<tr class="cart_item">
  <td class="product-remove">
    <a class="remove" data-cart-remove-item="<?php echo $item_id;?>" href="#"><i class="fa fa-times"></i></a>
  </td>
  <td class="product-thumbnail">
    <a href="#"><img  src="<?php echo $product["image"]?>" alt=""/></a>					
  </td>
  <td class="product-name" data-title="Product">
    <a href="#"><?php echo $product["product"]?></a>					
  </td>
  <td class="product-price" data-title="Price">
    <span class="amount"><?php echo \Kcart::price(!empty($product["discount"]) ? $product["discount"] : $product["price"]);?></span>
  </td>
  <td class="product-quantity" data-title="Quantity">
    <div class="detail-qty info-qty border radius6 text-center">
      <a href="#" class="qty-down"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
      <span class="qty-val"><?php echo $product["amount"]?></span>
      <a href="#" class="qty-up"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
      <input type="hidden" name="cart_product[<?php echo $item_id?>][amount]" value="<?php echo $product["amount"]?>" class="qty-val-input" />
    </div>		
  </td>
  <td class="product-subtotal" data-title="Total">
    <span class="amount"><?php #echo $product["subtotal"];?><?php echo \Kcart::price(!empty($product["discount"]) ? $product["discount"] * $product["amount"] : $product["price"]* $product["amount"]);?></span>					
  </td>
</tr>
<?php } ?>
