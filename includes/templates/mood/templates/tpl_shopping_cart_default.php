<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.<br />
 * Displays shopping-cart contents
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart_default.php 15881 2010-04-11 16:32:39Z wilt $
 */
?>
<div id="center">
	<div class="inner-container shopping-cart">
	<?php
      if ($flagHasCartContents) {
    ?>
    <?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>
    <?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product', $request_type)); ?>
    <div class="cart-header fix">
        <h1 class="l">Shopping Cart</h1>
        <ul class="checkout-types r fix">
            <li class="paypal l">
                <!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->
                <?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0
                if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
                  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');
                }
                ?>
                <!-- ** END PAYPAL EXPRESS CHECKOUT ** -->
                <span class="or">-OR-</span>
            </li>
            <li class="process-checkout l">
               <?php echo '<a href="' . zen_href_link('one_page', '', 'SSL') . '">'?>Proceed to Checkout</a>
            </li>
        </ul>
    </div>
    <div class="cart-contents">
    <table class="cart-table">
        <thead>
        <tr>
            <th></th>
            <th>Product Name</th>
            <th></th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
          foreach ($productArray as $product) {
        ?>
        <tr class="<?php echo $product['rowClass']; ?>">
            <td><a href="<?php echo $product['linkProductsName']; ?>"><img src="<?php echo \misc_func\generate_images(\misc_func\get_products_field_value($product['id'], 'products_image'), 75, 75)?>" width="75" height="75"></a></td>
            <td class="name"><a href="<?php echo $product['linkProductsName']; ?>"><?php echo $product['productsName'] ?></a><br>
            <span style="font-size: 12px; color: #444;">Item #: <?php echo \misc_func\get_products_field_value($product['id'], 'products_model')?></span>
            </td>
            <td><a href="<?php echo $product['linkProductsName']; ?>" style="color: #000">Edit</a></td>
            <td><?php echo $product['productsPriceEach']; ?></td>
            <td><?php echo $product['quantityField'] ?><input type="hidden" name="products_id[]" value="<?php echo $product['id']?>"/></td>
            <td><?php echo $product['productsPrice']; ?></td>
            <td class="remove"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>">x</a></td>
        </tr>
        <?php }?>
        </tbody>
        <tfoot>
            <td colspan="50">
            <?php echo zen_back_link()?>Continue Shopping</a>
            <button type="submit">Update Shopping Cart</button>
            <a href="<?php echo zen_href_link('shopping_cart', 'action=empty_cart')?>" class="btn">Clear Shopping Cart</a>
            </td>
        </tfoot>
    </table>
   
    </div>
    <div class="cart-footer fix">
        <ul class="r">
            <li style="font:italic bold 18px Georgia,serif;padding:10px 0;"><span style="padding-right: 20px;">Grand Total</span><span> <?php echo $cartShowTotal; ?></span></li>
            <li class="paypal">
                <!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->
                <?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0
                if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
                  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');
                }
                ?>
                <!-- ** END PAYPAL EXPRESS CHECKOUT ** -->
                <!-- <span class="or">-OR-</span> -->
            </li>
            <li class="process-checkout">
                <?php echo '<a href="' . zen_href_link('one_page', '', 'SSL') . '">'?>Proceed to Checkout</a>
            </li>
         <?php //require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>
    </div>
    </form>
    <?php }else{?>
    <h2 id="cartEmptyText" style="margin:20px 0 "><?php echo TEXT_CART_EMPTY; ?></h2>
    <div style="font-size:14px;line-height:1.4;margin-bottom:20px">
You have no items in your shopping cart.<br>
Click <a href="">here</a> to continue shopping.
    </div>
    <?php }?>
	</div>
</div>

