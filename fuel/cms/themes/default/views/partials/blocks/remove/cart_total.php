<table class="table">
  <tbody>
    <tr class="cart-subtotal">
      <th>Subtotal</th>
      <td><strong class="amount"><?php echo \Kcart::subtotal(true);?></strong></td>
    </tr>
    <tr class="shipping">
      <th>Shipping</th>
      <td>
        <ul class="list-none" id="shipping_method">
          <li>
            <input type="radio" class="shipping_method" checked="checked" value="free_shipping" id="shipping_method_0_free_shipping" data-index="0" name="shipping_method[0]">
            <label for="shipping_method_0_free_shipping">Free Shipping</label>
          </li>
          <li>
            <input type="radio" class="shipping_method" value="local_delivery" id="shipping_method_0_local_delivery" data-index="0" name="shipping_method[0]">
            <label for="shipping_method_0_local_delivery">Local Delivery (Free)</label>
          </li>
          <li>
            <input type="radio" class="shipping_method" value="local_pickup" id="shipping_method_0_local_pickup" data-index="0" name="shipping_method[0]">
            <label for="shipping_method_0_local_pickup">Local Pickup (Free)</label>
          </li>
        </ul>
      </td>
    </tr>
    <tr class="order-total">
      <th>Total</th>
      <td><strong><span class="amount"><?php echo \Kcart::total(true);?></span></strong> </td>
    </tr>
  </tbody>
</table>