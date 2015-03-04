<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 15511 2010-02-18 07:19:44Z drbyte $
 */
require (DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php
if (! isset($flag_disable_footer) || ! $flag_disable_footer) {
    
    ?>
<div id="before-footer">
	
	<?php require DIR_WS_LANGUAGES . $_SESSION['language'] .'/html_includes/define_footer_links.php';?>
	<?php require DIR_WS_LANGUAGES . $_SESSION['language'] .'/html_includes/define_footer_location.php';?>
	
	<div id="footer-newsletter">
	<div class="inner-container fix">
		<div class="title l">
			<h5>Newsletter Signup</h5>
			<p>Get latest news &amp; updates from Mood.</p>
		</div>
		<div class="newsletter-input fix l">
			<div class="input-box l">
				<input type="text" value="example@mail.com" class="input-text placeholder" tabindex="-1" style="">
			</div>
			<button type="submit" class="button">
				<span>
					<i></i>
					Submit
				</span>
			</button>
		</div>
		<div class="secure-shopping l fix">
			<h5 class="sub-title dib l">
				Secure
				<br>
				Shopping
			</h5>
			<ul class="fix l">
				<li class="l">
					<a href="" class="apparel db"></a>
				</li>
				<li class="l">
					<a href="" class="secure db"></a>
				</li>
				<li class="l">
					<a href="" class="getseal db"></a>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>

<div id="footer-copyright">
	<div class="inner-container fix">
		<div class="item first">&copy; Copyright 2014 Mood Fabrics</div>
		<div class="item">
			<div class="b-social">
				<span class="b-social__title">Connect</span>
				<ul class="b-social__list dib fix">
					<li class="b-social__list__item b-social__list__item_type_facebook">
						<a target="_blank" href="http://www.facebook.com/">Facebook</a>
					</li>
					<li class="b-social__list__item b-social__list__item_type_twitter">
						<a target="_blank" href="http://twitter.com/>Twitter</a>
					</li>
					<li class="b-social__list__item b-social__list__item_type_pinterest">
						<a target="_blank" href="http://pinterest.com/">Pinterest</a>
					</li>
					<li class="b-social__list__item b-social__list__item_type_flickr">
						<a target="_blank" href="http://www.flickr.com/">Flickr</a>
					</li>
					<li class="b-social__list__item b-social__list__item_type_instagram">
						<a target="_blank" href="http://instagram.com/">Instagram</a>
					</li>
					<li class="b-social__list__item b-social__list__item_type_bloglovin">
						<a target="_blank" href="https://www.bloglovin.com/">Bloglovin</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="item links">
			<ul class="fix">
				<li>
					<a href="<?php echo zen_href_link('site_map')?>">Sitemap</a>
				</li>
				<li>
					<a href="<?php echo zen_href_link('conditions')?>">Terms &amp; Conditions</a>
				</li>
				<li>
					<a href="<?php echo zen_href_link('privacy')?>">Privacy &amp; Security</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
} // flag_disable_footer
?>
<?php 
if(!isset($_COOKIE['showPopNewsletter']) || $_COOKIE['showPopNewsletter'] == '0'){
?>
<div class="mask abs"></div>
<div class="pop-newsletter rel">
    <div class="win"></div>
    <p>Sign up for the chance to win<br>
a Janome DC2014 ($499 Value!)</p>
    <div class="gift">
    <img src="images/Janome.png">
    </div>
    <div class="input-wrapper">
        <input type="text" class="input-text" value="Enter Email"/>
        <input type="submit" class="submit" value="SIGN ME UP">
    </div>
    <a href="javascript:;" class="close abs">x</a>
</div>
<script>
$(function(){
    var $mask = $('.mask');
    var $popNewsletter = $('.pop-newsletter');
    var $input = $popNewsletter.find('.input-text');
    var $submit = $popNewsletter.find('.submit');
    var $close = $popNewsletter.find('.close');

    $mask.height($('body').height());
    Mobanbase.setCookie('showPopNewsletter','1','','',9999);
    
    $input.focus(function(){if(this.value.toLowerCase() == 'enter email'){this.value='';}});
    $input.blur(function(){if(this.value == ''){this.value='Enter Email';}});
    $close.click(function(){
	    $popNewsletter.fadeOut(function(){$popNewsletter.remove();});
	    $mask.fadeOut(function(){$mask.remove()});
	 });
    $submit.click(function(){
	    var email = $input.val();
	    if(!/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test(email)){
		    alert('Please input a correct email address');
		    return false;
		}
		var url = '<?php echo zen_href_link('ajax')?>';
		var data = {'email':encodeURIComponent(email),'in_ajax':1,'action':'subscrib'};
		var callback = function(response){
		    $popNewsletter.fadeOut(function(){$popNewsletter.remove();});
		    $mask.fadeOut(function(){$mask.remove()});
		    alert('Thank you for subscrib our newsletter!');
		}
		$.getJSON(url, data, callback);
	});
});
</script>
<?php }?>
<?php
if ( DISPLAY_PAGE_PARSE_TIME == 'true') {
    echo '<i class="dn">Pares Time:' , $parse_time , ', Number Of Queries:' , $db->queryCount() , ', Query Time:' , $db->queryTime(), '</i>'; 
}
?>