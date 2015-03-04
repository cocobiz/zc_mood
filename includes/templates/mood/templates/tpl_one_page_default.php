<?php
/**
 * One Page For Checkout
 * @author Mobanbase.com
 *
 */
?>
<script>
Mobanbase.one_page = {
	url:'<?php echo zen_href_link('one_page')?>',
}
$(function(){
    $('.step-title').click(function(){
	    if($(this.parentNode).hasClass('allow')){
		    $(this.parentNode).addClass('active').removeClass('allow').siblings().removeClass('active');
		}
	});
    
});

function update_zone(theCountry, targetClassName){
    if(!/^\d+$/.test(theCountry.value)) return false;
    var url = '<?php echo zen_href_link('ajax')?>';
    var data = {'in_ajax':1,'action':'get_zone','country_id':theCountry.value};
    var callback = function(list){
	    if(list=='0'){
		    $('.'+targetClassName).parent().html('<input type="text" class="billing-zone input-text" name="zone_id" style="width:279px;">');
		}else{
		    opt = '<select class="billing-zone" name="zone_id">';
		    opt += '<option value="">Please select region, state or province</option>';
		    for(var i=0;i<list.length;i++){
			    opt += '<option value="'+ list[i].zone_id +'">' + list[i].zone_name + '</option>';
			}
			opt += '</select>'
		    $('.'+targetClassName).parent().html(opt);
		}
	};

	$.getJSON(url, data, callback);
}

</script>
<div id="center">
	<div class="inner-container one-page fix">
		<div class="opc-steps-wrapper l" style="width: 620px;">
			<h1 class="mt10 mb20">Checkout</h1>
			<ol class="checkout-steps rel">
			<?php $_step = 0;?>
			 <?php if(!$logon){?>
				<li id="opc-login" class="section active">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_login.php';?>
    	       </li>
    	       <?php }?>
				<li id="opc-billing" class="section <?php echo !$logon?'':'active'?>">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_billing_address.php';?>
    	       </li>
				<li id="opc-shipping" class="section">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_shipping_address.php';?>
    	       </li>
				<li id="opc-shipping_method" class="section">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_shipping_method.php';?>
    	       </li>
				<li id="opc-payment" class="section">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_payment.php';?>
    	       </li>
				<li id="opc-review" class="section">
    	           <?php include DIR_WS_TEMPLATE . 'templates/tpl_modules_opc_confirm.php';?>
    	       </li>
			</ol>
		</div>
		<div class="opc-progress-wrapper r" style="width: 310px;">
			<h1 class="mt10 mb20 ml10">Your Checkout Progress</h1>
			<div class="block-content">
				<dl>
					<dt>Billing Address</dt>
					<dt>Shipping Address</dt>
					<dt>Shipping Method</dt>
					<dt>Payment Method</dt>
				</dl>
			</div>
		</div>
	</div>
</div>
