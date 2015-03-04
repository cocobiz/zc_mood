<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_create_account_default.php 5523 2007-01-03 09:37:48Z drbyte $
 */
?>
<div class="join-page centerColumn">
<h1 class="title">Create an Account</h1>
<?php if ($messageStack->size('create_account') > 0) echo $messageStack->output('create_account'); ?>
<?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', '') . zen_draw_hidden_field('action', 'process'); ?>
<ul class="form-box mb20">
    <li class="header">Personal Information</li>
    <li class="fix">
        <div class="l mr20">
            <label class="required" for="first-name">First Name<em>*</em></label>
            <div class="input-box">
                <input name="firstname" type="text" />
            </div>
        </div>
        <div class="l">
            <label class="required" for="last-name">Last Name<em>*</em></label>
            <div class="input-box">
                <input name="lastname" type="text" />
            </div>
        </div>
    </li>
    <li class="fix mt10">
        <div class="l mr20">
            <label class="required" for="first-name">Email Address<em>*</em></label>
            <div class="input-box">
                <input name="email_address" type="text" />
            </div>
        </div>
        <div class="l">
            <label class="required" for="first-name">Confirm Email Address<em>*</em></label>
            <div class="input-box">
                <input name="confirm_email" type="text" />
            </div>
        </div>
    </li>
    <li class="mt10 mb20 f14"><input type="checkbox" class="newsletter-checkbox" value="1" name="newsletter">Sign Up for Newsletter</li>
    <li class="header">Login Information</li>
    <li class="fix">
        <div class="l mr20">
            <label class="required" for="password">Password<em>*</em></label>
            <div class="input-box">
                <input name="password" type="password" />
            </div>
        </div>
        <div class="l">
            <label class="required" for="confirm_password">Confirm Password<em>*</em></label>
            <div class="input-box">
                <input name="confirm_password" type="password" />
            </div>
        </div>
    </li>
    <li class="mt20 mb20 required">
        <button type="submit" class="submit">Submit</button> <em class="ml10 f12">*Required Fields</em>
    </li>
</ul>
</form>
</div>
<script>
$(function(){
    $('form[name="create_account"]').submit(function(){
	    var firstName       = $('input[name="firstname"]').val();
	    var lastName        = $('input[name="lastname"]').val();
	    var email           = $('input[name="email_address"]').val(); 
	    var confirmEmail    = $('input[name="confirm_email"]').val();
	    var password        = $('input[name="password"]').val();
	    var confirmPassword = $('input[name="confirm_password"]').val();

	    if($.trim(firstName) == ''){
		    alert('The First Name can not be null');
		    return false;
		    } 
	    if($.trim(lastName) == ''){
		    alert('The Last Name can not be null');
		    return false;
		    }
	    if($.trim(email) == ''){
		    alert('The Email Address can not be null');
		    return false;
		    }
	    if(email != confirmEmail){
		    alert('The Email Confirmation must match your Email.');
		    return false;
		    }
	    if($.trim(password) == '' || password.length < 7){
		    alert('The Password must contain a minimum of 7 characters.');
		    return false;
		    }
	    if(password != confirmPassword){
		    alert('The Password Confirmation must match your Password.');
		    return false;
		    }

	    return true;
            
    });
	
});
</script>