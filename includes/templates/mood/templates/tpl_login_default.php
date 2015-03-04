<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_default.php 18695 2011-05-04 05:24:19Z drbyte $
 */
?>
<div id="center">
	<div class="inner-container login-page">
	   <h1 class="title">Login or Create an Account</h1>
	   <?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>
	   <?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginForm"'); ?>
	   <div class="body fix">
	       <div class="login-box l">
	           <div class="content">
    	           <h2>Registered Customers</h2>
    	           <p>If you have an account with us, please log in.</p>
    	           <ul class="form-list">
                        <li class="fix">
                            <label class="required" for="login-email-address">Email Address<em>*</em></label>
                            <div class="input-box">
                                <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?>  
                            </div>
                        </li>
                        <li class="fix">
                            <label class="required" for="login-password">Password<em>*</em></label>
                            <div class="input-box">
                                <?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password') . ' id="login-password"'); ?>
                                <?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
                            </div>
    						<a class="b-more-link" href="<?php echo zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL')?> ">Forgot Your Password?</a>
                        </li>
                    </ul>
                </div>
	       </div>
	       <div class="create-box r">
	           <div class="content">
					<h2>New Customers</h2>
					<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
				</div>
	       </div>
	   </div>
	   <div class="buttons fix">
            <div class="login-btn l">
                <button type="submit">Login</button><span class="required">* Required Fields</span>
            </div>
			<div class="create-btn r">
				<div class="buttons-set">
					<button onclick="window.location='<?php echo zen_href_link('create_account')?>';" class="button inverted" title="Create an Account" type="button"><span><span>Create an Account</span></span></button>
				</div>
			</div>
        </div>
        </form>
	</div>
</div>