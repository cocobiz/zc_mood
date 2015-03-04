<div class="step-title fix">
	<span class="number l"><?php echo ++$_step?></span>
	<h2 class="l">Checkout Method</h2>
</div>
<div class="step">
	<div class="fix">
		<div class="l col-1">
			<h3>Checkout as a Guest or Register</h3>
			<p>Register with us for future convenience:</p>
			<ul class="form-list">
				<li class="control">
					<input type="radio" class="radio" value="guest" id="login:guest" name="checkout_method">
					<label for="login:guest">Checkout as Guest</label>
				</li>
				<li class="control">
					<input type="radio" class="radio" value="register" id="login:register" name="checkout_method">
					<label for="login:register">Register</label>
				</li>
			</ul>
			<h4>Register and save time!</h4>
			<p>Register with us for future convenience:</p>
			<ul class="ul">
				<li>Fast and easy check out</li>
				<li>Easy access to your order history and status</li>
			</ul>
		</div>
		<div class="r col-2">
			<h3>Login</h3>
			<form method="post" action="<?php echo zen_href_link('login','action=process')?>" id="login-form">
			<?php echo '<input type="hidden" name="securityToken" value="' . $_SESSION['securityToken'] . '" />'?>
				<h4>Already registered?</h4>
				<p>Please log in below:</p>
				<ul class="form-list">
					<li>
						<label class="required" for="login-email">
							Email Address<em>*</em>
						</label>
						<div class="input-box">
							<input type="text" value="" name="email_address" id="login-email" class="input-text required-entry validate-email">
						</div>
					</li>
					<li>
						<label class="required" for="login-password">
							Password<em>*</em>
						</label>
						<div class="input-box">
							<input type="password" name="password" id="login-password" class="input-text required-entry">
						</div>
					</li>
				</ul>
			</form>
			<p class="forgot-password">
				<a class="b-more-link" href="<?php echo zen_href_link(FILENAME_PASSWORD_FORGOTTEN)?>">Forgot your password?</a>
			</p>
		</div>
	</div>
	<div class="fix mt20">
	   <div class="col-1">
	       <button class="submit" id="register-btn" onclick="return saveRegister();">Continue</button>
	   </div>
	   <div class="col-2">
	       <button class="submit l" onclick="return document.getElementById('login-form').submit();">login</button>
	       <p class="required l">* Required Fields</p>    
	   </div>
	</div>
</div>
<script>
function saveRegister(){
    var checkMethod = $('input[name="checkout_method"]:checked').val();
    if(!checkMethod){
	    alert('Please choose a regist mode');
	    return false;
	}
	var data={'registerMode':checkMethod,'action':'save_method'};
	var callback = function(response){
	    // do nothing
	};
	
    $.getJSON(Mobanbase.one_page.url,data,callback);
    // we directly show the next step
    if(checkMethod == 'guest'){
	   $('#register-customer-password').addClass('dn');    
	}else{
	   $('#register-customer-password').removeClass('dn');
	}
    $('#opc-login').removeClass('active').addClass('allow');
    $('#opc-billing').addClass('active');
}
</script>