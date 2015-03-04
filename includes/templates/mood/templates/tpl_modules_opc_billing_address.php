<div class="step-title fix">
	<span class="number l"><?php echo ++$_step?></span>
	<h2 class="l">Billing Information</h2>
</div>
<div class="step">
	<form action="" id="co-billing-form">
		<ul class="form-list">
			<li id="billing-new-address-form">
				<input type="hidden" id="billing:address_id" value="" name="billing[address_id]">
				<ul>
					<li class="fields fix">
						<div class="customer-name">
							<div class="field name-firstname">
								<label class="required" for="billing:firstname">
									First Name
									<em>*</em>
								</label>
								<div class="input-box">
									<input type="text" class="input-text required-entry" maxlength="255" title="First Name" value="<?php echo $logon['firstmame']?>" name="firstname" id="billing:firstname">
								</div>
							</div>
							<div class="field name-lastname">
								<label class="required" for="billing:lastname">
									Last Name
									<em>*</em>
								</label>
								<div class="input-box">
									<input type="text" class="input-text required-entry" maxlength="255" title="Last Name" value="<?php echo $logon['lastname']?>" name="lastname" id="billing:lastname">
								</div>
							</div>
						</div>
					</li>
					<li class="fields fix">
						<div class="field">
							<label for="billing:company">Company</label>
							<div class="input-box">
								<input type="text" class="input-text " title="Company" value="" name="company" id="billing:company">
							</div>
						</div>
						<div class="field">
							<label class="required" for="billing:email">
								Email Address
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="text" class="input-text validate-email required-entry" title="Email Address" value="<?php echo $logon['email']?>" id="billing:email" name="email">
							</div>
						</div>
					</li>
					<li class="wide">
						<label class="required" for="billing:street1">
							Address
							<em>*</em>
						</label>
						<div class="input-box">
							<input type="text" class="input-text  required-entry" value="" id="billing:street1" name="address1" title="Street Address">
						</div>
					</li>
					<li class="wide">
						<div class="input-box">
							<input type="text" class="input-text " value="" id="billing:street2" name="address2" title="Street Address 2">
						</div>
					</li>
					<li class="fields fix">
						<div class="field">
							<label class="required" for="billing:city">
								City
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="text" id="billing:city" class="input-text  required-entry" value="" name="city" title="City">
							</div>
						</div>
						<div class="field">
							<label class="required" for="billing:region_id">
								State/Province
								<em>*</em>
							</label>
							<div class="input-box">
								<select style="top: 0px; left: 0px;" class="billing-zone" title="State/Province" name="zone_id" id="billing:region_id" defaultvalue="">
								      <option value="">Please select region, state or province</option>
								</select>
							</div>
						</div>
					</li>
					<li class="fields fix">
						<div class="field">
							<label class="required" for="billing:postcode">
								Zip/Postal Code
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="text" class="input-text validate-zip-international  required-entry" value="" id="billing:postcode" name="postcode" title="Zip/Postal Code">
							</div>
						</div>
						<div class="field">
							<label class="required" for="billing:country_id">
								Country
								<em>*</em>
							</label>
							<div class="input-box">
								<?php echo zen_get_country_list('zone_country_id', $selected_country, 'class="country" onchange="update_zone(this,\'billing-zone\');"'); ?>
							</div>
						</div>
					</li>
					<li class="fields fix">
						<div class="field">
							<label class="required" for="billing:telephone">
								Telephone
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="text" id="billing:telephone" class="input-text  required-entry" title="Telephone" value="" name="telphone">
							</div>
						</div>
						<div class="field">
							<label for="billing:fax">Fax</label>
							<div class="input-box">
								<input type="text" id="billing:fax" class="input-text " title="Fax" value="" name="fax">
							</div>
						</div>
					</li>
					<?php if(!$logon){?>
					<li id="register-customer-password" class="fields fix">
						<div class="field">
							<label class="required" for="billing:customer_password">
								Password
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="password" class="input-text required-entry validate-password" title="Password" id="billing:customer_password" name="password">
							</div>
						</div>
						<div class="field">
							<label class="required" for="billing:confirm_password">
								Confirm Password
								<em>*</em>
							</label>
							<div class="input-box">
								<input type="password" class="input-text required-entry validate-cpassword" id="billing:confirm_password" title="Confirm Password" name="confirm_password">
							</div>
						</div>
					</li>
					<?php }?>
				</ul>
			</li>
			<li class="control">
				<input type="radio" class="radio" onclick="" title="Ship to this address" checked="checked" value="1" id="use_for_shipping_yes" name="use_for_shipping">
				<label for="billing:use_for_shipping_yes">Ship to this address</label>
			</li>
			<li class="control">
				<input type="radio" class="radio" onclick="" title="Ship to different address" value="0" id="use_for_shipping_no" name="use_for_shipping">
				<label for="billing:use_for_shipping_no">Ship to different address</label>
			</li>
		</ul>
		<div id="billing-buttons-container" class="buttons-set fix">
			<button class="submit l" onclick="return saveBilling();">Continue</button>
			<p class="required l">* Required Fields</p>
			<span style="display: none;" id="billing-please-wait" class="please-wait">
				<img class="v-middle" title="Loading next step..." alt="Loading next step..." src="">
				Loading next step...
			</span>
		</div>
	</form>
</div>
<script>
update_zone({'value':'223'},'billing-zone');
$('option[value="223"]').attr('selected','selected');
function saveBilling(){
    var $root = $('#co-billing-form');
    var firstname = $root.find('input[name="firstname"]').val(); 
    var lastname = $root.find('input[name="lastname"]').val(); 
    var company = $root.find('input[name="company"]').val(); 
    var email = $root.find('input[name="email"]').val(); 
    var add1 = $root.find('input[name="address1"]').val(); 
    var add2 = $root.find('input[name="address2"]').val(); 
    var city = $root.find('input[name="city"]').val(); 
    var zone_id = $root.find('select[name="zone_id"]').val(); 
    var postcode = $root.find('input[name="postcode"]').val(); 
    var country_id = $root.find('select[name="zone_country_id"]').val(); 
    var telphone = $root.find('input[name="telphone"]').val(); 
    var fax = $root.find('input[name="fax"]').val(); 


	if(firstname == ''){alert('Firstname can not be null');return false};
	if(lastname == ''){alert('Lastname can not be null');return false};
	if(email == ''){alert('Email address can not be null');return false};
	if(add1 == ''){alert('Adress can not be null');return false};
	if(city == ''){alert('city can not be null');return false};
	if(zone_id == ''){alert('region can not be null');return false};
	if(postcode == ''){alert('postcode can not be null');return false};
	if(country_id == ''){alert('country can not be null');return false};
	if(telphone == ''){alert('telphone can not be null');return false};

	if($('#register-customer-password:visible').length){
	   var password = $root.find('input[name="password"]').val(); 
	   var confirm_passowrd = $root.find('input[name="confirm_passowrd"]').val(); 
	   if(password == '' || password != confirm_password){
	       alert('The confirm password must match the password');
	       $root.find('input[name="confirm_passowrd"]').focus();
	       return false;
	   }
	} 

	var data = {
		    'firstname':firstname,
		    'lastname':lastname,
		    'email':email,
		    'add1':add1,
		    'company':company,
		    'add2':add2,
		    'city':city,
		    'zone_id':zone_id,
		    'postcode':postcode,
		    'country_id':country_id,
		    'telphone':telphone,
		    'fax':fax,
		    'securityToken':'<?php echo $_SESSION['securityToken']?>'
		};
		
	var callback = function(response){
	    var progress = response.progress;
	    $('.opc-progress-wrapper .block-content').html(progress);
	    $('#opc-billing').addClass('allow').removeClass('active');
	    
	    if($('input[name="use_for_shipping"]:checked').val() == '1'){
		    $('#opc-shipping_method').addClass('active');
		    data.use_for_shipping = 1;
		}else{
		    data.use_for_shipping = 0;
		    $('#opc-shipping').addClass('active');
		}
	}
	$.post(Mobanbase.one_page.url+'&action=save_billing',data,callback,'JSON');
	return false;
}
</script>