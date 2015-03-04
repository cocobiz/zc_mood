<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 19690 2011-10-04 16:41:45Z drbyte $
 */
 //require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
$_GET['reviews_type'] = 1;// product
?>
<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>
<div id="center">
	<div class="inner-container pro-wrapper">
	<?php if (!$this_is_home_page && DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
        <div id="breadcrumb"><?php echo $breadcrumb->trail('<span class="gt">&gt;</span>'); ?></div>
    <?php } ?>
    
    <div class="pro-header">
			<a href="javascript:;" class="back-link db l">Back to List</a>
			<a href="javascript:;" class="db r shippinfo-btn">Shipping Info</a>
			<span class="separator db r">|</span>
			<a href="javascript:;" class="db r policy-btn">Return Policy</a>
			<script>
         $(function(){
        	   $('.back-link').click(function(){
        		   location.href = $('#breadcrumb').find('a:last').attr('href');
            	   });	  
         });
        </script>
		</div>
		<ul class="pro-center fix">
			<li class="main-pic-wrapper l">
         <?php if(zen_not_null($products_image)) require DIR_WS_TEMPLATE . 'templates/tpl_modules_products_images.php';?>
         <?php echo '<link rel="stylesheet" type="text/css" href="'.DIR_WS_TEMPLATE.'css/social_widgets.css" />'."\n";?>
         <div class="social-widgets">
					<span displaytext="Email" class="st_email_vcount" st_processed="yes">
						<span style="text-decoration: none; color: #000000; display: inline-block; cursor: pointer;" class="stButton">
							<div>
								<div class="stBubble" style="display: block;">
									<div class="stBubble_count">0</div>
								</div>
								<span class="stMainServices st-email-counter" style="background-image: url(&quot;http://w.sharethis.com/images/email_counter.png&quot;);">&nbsp;</span>
							</div>
						</span>
					</span>
					<span displaytext="Tweet" class="st_twitter_vcount" st_processed="yes">
						<span style="text-decoration: none; color: #000000; display: inline-block; cursor: pointer;" class="stButton">
							<div>
								<div class="stBubble" style="display: block;">
									<div class="stBubble_count">0</div>
								</div>
								<span class="stMainServices st-twitter-counter" style="background-image: url(&quot;http://w.sharethis.com/images/twitter_counter.png&quot;);">&nbsp;</span>
							</div>
						</span>
					</span>
					<span displaytext="Facebook" class="st_facebook_vcount" st_processed="yes">
						<span style="text-decoration: none; color: #000000; display: inline-block; cursor: pointer;" class="stButton">
							<div>
								<div class="stBubble" style="display: block;">
									<div class="stBubble_count">0</div>
								</div>
								<span class="stMainServices st-facebook-counter" style="background-image: url(&quot;http://w.sharethis.com/images/facebook_counter.png&quot;);">&nbsp;</span>
							</div>
						</span>
					</span>
					<span displaytext="Pinterest" class="st_pinterest_vcount" st_processed="yes">
						<span style="text-decoration: none; color: #000000; display: inline-block; cursor: pointer;" class="stButton">
							<div>
								<div class="stBubble" style="display: block;">
									<div class="stBubble_count">0</div>
								</div>
								<span class="stMainServices st-pinterest-counter" style="background-image: url(&quot;http://w.sharethis.com/images/pinterest_counter.png&quot;);">&nbsp;</span>
							</div>
						</span>
					</span>
					<span st_username="moodfabrics" displaytext="Instagram" class="st_instagram_vcount" st_processed="yes">
						<span style="text-decoration: none; color: #000000; display: inline-block; cursor: pointer;" class="stButton">
							<div>
								<div class="stBubble" style="display: block;">
									<div class="stBubble_count">0</div>
								</div>
								<span class="stButton_gradient">
									<span class="chicklets instagram">Instagram</span>
								</span>
							</div>
						</span>
					</span>
				</div>
			</li>
			<li class="pro-data-wrapper r">
				<h1 class="name"><?php echo $products_name; ?></h1>
				<p class="model">Product #: <?php echo $products_model?></p>
				<ul class="pro-misc fix">
					<li class="l">
						<ul>
							<li class="price">Price: $11.99 / Yard</li>
							<li class="in-stock">
								Availability:
								<span>In stock</span>
								<i title="Tips" class="dib">CL</i>
							</li>
							<li style="line-height: 1.5">Returnable: No</li>
						</ul>
					</li>
					<li class="reviews r">
						<div class="ratings-wrapper fix">
							<div class="ratings-box l">
								<div class="rating" style="width: <?php echo floatval($_GET['reviews']['rating'])*100 . '%'?>;"></div>
							</div>
							<div class="num l">(<?php echo $reviews->fields['count']?> Reviews)</div>
						</div>
						<p class="btn">
							<a href="javascript:;" class="read-reviews-btn">Read Reviews</a>
							<span class="separator">|</span>
							<a href="javascript:;" class="add-reviews-btn">Add a Review</a>
						</p>
					</li>
				</ul>
				<div class="attributes">
            <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_model_related_products.php';?>
            </div>
				<div class="add-bo-box">
					<div class="fix" style="width: 180px;">
						<!-- p style="padding-left:49px">Yards<span style="padding-left:19px;width:55px;">Half Yards</span></p-->
						<label>
							<span class="dib" style="width: 45px; text-transform: uppercase;">Qty:</span>
							<input class="qty-input" type="text" value="1" maxlength="12" name="cart_quantity" />
						</label>
						<!-- <span>+</span>
                    <div class="ui-option dib rel r">
                        <span class="value">-</span>
                        <span class="btn"></span>
                        <ul class="ui-selects abs dn">
                            <li><a href="" class="db">-</a></li>
                            <li><a href="" class="db">1/2</a></li>
                        </ul>
                    </div> -->
						<span class="">Yards</span>
					</div>
					<input type="hidden" name="products_id" value="<?php echo $_GET['products_id']?>">
					<div class="add-to-cart">
						<a href="javascript:;" class="db btn">
							<span>Add To Cart</span>
						</a>
					</div>
				</div>
				<div class="description">
					<ul class="header fix">
						<li class="current l rel" onclick="return tab(this)">
							Products Details
							<span></span>
						</li>
						<li class="l rel" onclick="return tab(this)">Reviews(<?php echo $reviews->fields['count']?>)<span></span>
						</li>
					</ul>
					<ul class="body">
						<li class="item">
                    <?php if ($products_description != '') { ?>
                    <div id="productDescription" class="productGeneral biggerText"><?php echo stripslashes($products_description); ?></div>
                    <?php } ?></li>
						<li class="item dn">
							<?php require DIR_WS_TEMPLATE . '/templates/tpl_modules_reviews.php';?>
						</li>
					</ul>
				</div>
				<script>
            function tab(o){
        	    var index = $(o).index();
        	    $(o).addClass('current').siblings().removeClass('current');
        	    $('.description .body li').eq(index).removeClass('dn').siblings().addClass('dn');
            }
            </script>
			</li>
		</ul>
		<ul class="pro-footer fix">
			<li class="related-pro l">
        <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_related_products.php';?>
        </li>
			<li class="history r">
        <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_view_history.php';?>
        </li>
		</ul>
	</div>
</div>
<script>
$(function(){
	$('.add-to-cart .btn').click(function(){
	    var qty = $('input[name="cart_quantity"]').val();
	    //var qty2 = $('')
	    if(qty < 1){
	        alert('The quantity is Illegal');return false;
		}

		$.post(
				'<?php echo zen_href_link('product_info',zen_get_all_get_params(array('action')).'&action=add_product')?>'.replace(/&amp;/g,'&'),
				{
					'products_id':$('input[name="products_id"]').val(),
					'cart_quantity':qty,
					'securityToken':'<?php echo $_SESSION['securityToken']?>'
				},
				function(response){
				   if(response.result == 'success'){
					    location.href='<?php echo zen_href_link('shopping_cart')?>';
					}
				},
				'json'
				);
	});

    $('.shippinfo-btn').click(function(){
       
    	var url = 'index.php?main_page=ajax&action=ezpage&id=15';
        var callback = function(response){
            if(response.error=='0'){
                var $html = $('<div class="pop-shippinginfo">'+response.data+'</div>');
                //$('body').append($html);
                new Mobanbase.popWindow({content:$html});
            }
        }
        
        $.getJSON(url,callback);
        
     });
    $('.policy-btn').click(function(){

    	var url = 'index.php?main_page=ajax&action=ezpage&id=16';
        var callback = function(response){
            if(response.error=='0'){
                var $html = $('<div class="pop-policy">'+response.data+'</div>');
                //$('body').append($html);
                new Mobanbase.popWindow({content:$html});
            }
        }
        
        $.getJSON(url,callback);
    });

	
});      
</script>

