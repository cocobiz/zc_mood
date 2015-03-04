<?php 
// load all enabled payment modules
require(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment;
?>
<div class="step-title fix">
	<span class="number l"><?php echo ++$_step?></span>
	<h2 class="l">Payment Information</h2>
</div>
<div class="step">
    <div class="">
        <?php
// ** BEGIN PAYPAL EXPRESS CHECKOUT **
if (! $payment_modules->in_special_checkout()) {
    // ** END PAYPAL EXPRESS CHECKOUT **     ?>
<fieldset>
		<legend><?php echo 'Payment Method'; ?></legend>

<?php
    
    if (SHOW_ACCEPTED_CREDIT_CARDS != '0') {
        ?>

<?php
        if (SHOW_ACCEPTED_CREDIT_CARDS == '1') {
            echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();
        }
        if (SHOW_ACCEPTED_CREDIT_CARDS == '2') {
            echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled('IMAGE_');
        }
        ?>
<br class="clearBoth" />
<?php } ?>

<?php
    $selection = $payment_modules->selection();
    
    if (sizeof($selection) > 1) {
        ?>
<p class="important"><?php echo 'Please select a payment method for this order.'; ?></p>
<?php
    } elseif (sizeof($selection) == 0) {
        ?>
<p class="important"><?php echo TEXT_NO_PAYMENT_OPTIONS_AVAILABLE; ?></p>

<?php
    }
    ?>

<?php
    $radio_buttons = 0;
    for ($i = 0, $n = sizeof($selection); $i < $n; $i ++) {

        if (sizeof($selection) > 1) {
            if (empty($selection[$i]['noradio'])) {
                
                echo zen_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $_SESSION['payment'] ? true : false), 'id="pmt-' . $selection[$i]['id'] . '"');
            }
        } else {
            
            echo zen_draw_hidden_field('payment', $selection[$i]['id'], 'id="pmt-' . $selection[$i]['id'] . '"');
        }
        ?>
<label for="pmt-<?php echo $selection[$i]['id']; ?>" class="radioButtonLabel"><?php echo $selection[$i]['module']; ?></label>

<?php
        if (defined('MODULE_ORDER_TOTAL_COD_STATUS') && MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod') {
            ?>
<div class="alert"><?php echo TEXT_INFO_COD_FEES; ?></div>
<?php
        } else {
            // echo 'WRONG ' . $selection[$i]['id'];
            ?>
<?php
        }
        ?>
<br class="clearBoth" />

<?php
        if (isset($selection[$i]['error'])) {
            ?>
    <div><?php echo $selection[$i]['error']; ?></div>

<?php
        } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
            ?>

<div class="ccinfo">
<?php
            for ($j = 0, $n2 = sizeof($selection[$i]['fields']); $j < $n2; $j ++) {
                ?>
<label <?php echo (isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : ''); ?> class="inputLabelPayment"><?php echo $selection[$i]['fields'][$j]['title']; ?></label><?php echo $selection[$i]['fields'][$j]['field']; ?>
<br class="clearBoth" />
<?php
            }
            ?>
</div>
		<br class="clearBoth" />
<?php
        }
        $radio_buttons ++;
        ?>
<br class="clearBoth" />
<?php
    }
    ?>

</fieldset>
<?php
    // ** BEGIN PAYPAL EXPRESS CHECKOUT **
} else {
    ?><input type="hidden" name="payment" value="<?php echo $_SESSION['payment']; ?>" /><?php
}
// ** END PAYPAL EXPRESS CHECKOUT ** ?>
    </div>
    <div class="control">
        <button class="submit" onclick="return save_payment()">Continue</button>
    </div>
</div>
<script>
function save_payment(){
    var payment = $('input[name="payment"]:checked').val();

    if(!payment) {alert('Please choose a payment');return false;}

    var data = {payment:payment,action:'save_payment','securityToken':'<?php echo $_SESSION['securityToken']?>'};

    var callback = function(response){
	    var progress = response.progress;
	    $('.opc-progress-wrapper .block-content').html(progress);
	    $('#opc-payment').addClass('allow').removeClass('active');
	    $('#opc-review').addClass('active');
	    $('#checkout_confirmation').attr('action',response.formURL);
	}

	$.post(Mobanbase.one_page.url, data, callback,'JSON');
    return false;
}
</script>