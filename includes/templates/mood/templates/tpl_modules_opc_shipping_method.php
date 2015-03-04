
<?php 

require (DIR_WS_CLASSES . 'shipping.php');
$shipping_modules = new shipping();

$quotes = $shipping_modules->quote();

?>
<div class="step-title fix">
	<span class="number l"><?php echo ++$_step?></span>
	<h2 class="l">Shipping Method</h2>
</div>
<div class="step">
    <div class="">
    <?php
        $radio_buttons = 0;
        for ($i = 0, $n = sizeof($quotes); $i < $n; $i ++) {
            // bof: field set
            // allows FedEx to work comment comment out Standard and Uncomment FedEx
            // if ($quotes[$i]['id'] != '' || $quotes[$i]['module'] != '') { // FedEx
            if ($quotes[$i]['module'] != '') { // Standard
                ?>
<fieldset>
		<legend><?php echo $quotes[$i]['module']; ?>&nbsp;<?php if (isset($quotes[$i]['icon']) && zen_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></legend>

<?php
                if (isset($quotes[$i]['error'])) {
                    ?>
      <div><?php echo $quotes[$i]['error']; ?></div>
<?php
                } else {
                    for ($j = 0, $n2 = sizeof($quotes[$i]['methods']); $j < $n2; $j ++) {
                        // set the radio button to be checked if it is the method chosen
                        $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);
                        
                        if (($checked == true) || ($n == 1 && $n2 == 1)) {
                            // echo ' <div id="defaultSelected" class="moduleRowSelected">' . "\n";
                            // } else {
                            // echo ' <div class="moduleRow">' . "\n";
                        }
                        ?>
<?php

                        if (($n > 1) || ($n2 > 1)) {
                            ?>
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></div>
<?php
                        } else {
                            ?>
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></div>
<?php
                        }
                        ?>

<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']) .'"'); ?>
<label for="ship-<?php echo $quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']); ?>" class="checkboxLabel"><?php echo $quotes[$i]['methods'][$j]['title']; ?></label>
		<!--</div>-->
		<br class="clearBoth" />
<?php
                        $radio_buttons ++;
                    }
                }
                ?>

</fieldset>
<?php
            }
            // eof: field set
        }
        ?>
    </div>
    <div class="control">
        <button class="submit" onclick="return save_shipping_method()">Continue</button>
    </div>
</div>
<script>
function save_shipping_method(){
    var method = $('input[name="shipping"]:checked').val();

    if(!method) {alert('Please choose a shipping method');return false;}

    var data = {shipping:method,action:'save_shipping_method','securityToken':'<?php echo $_SESSION['securityToken']?>'};

    var callback = function(response){
	    var progress = response.progress;
	    $('.opc-progress-wrapper .block-content').html(progress);
	    $('#opc-shipping_method').addClass('allow').removeClass('active');
	    $('#opc-payment').addClass('active');
	}

	$.post(Mobanbase.one_page.url, data, callback,'JSON');
    return false;
}
</script>