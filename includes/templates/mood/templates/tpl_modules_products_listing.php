<?php
/**
 * 分类产品列表模板
 */
$showList = false;
include DIR_WS_MODULES . $template_dir . '/products_listing.php';

if ($show_list === false) {
    echo 'There is no products';
} else {
    ?>
<div class="split-page fix">
	<ul class="limit fix l">
		<li class="l" style="padding-right: 5px">Items Per Page:</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 27 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=27')?>">27</a>
		</li>
		<li style="padding: 0 5px" class="l">|</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 54 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=54')?>">54</a>
		</li>
		<li style="padding: 0 5px" class="l">|</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 99 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=99')?>">99</a>
		</li>
	</ul>
	<div class="page-links r"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
</div>
<ul class="product-listing fix">
<?php
    foreach ($list_content as $p) {
        $href = zen_href_link('product_info', 'cPath=' . (zen_get_generated_category_path_rev($p['mcid'])) . '&products_id=' . $p['id']);
        echo '<li class="product-box l rel">', 
            '<div class="img-wrapper"><a href="', $href, '"><img src="', DIR_WS_IMAGES, $p['img'], '" width="300" height="300" alt="', $p['name'], '" title="', $p['name'], '"/></a></div>', 
            '<h2 class="name"><a href="', $href, '">', $p['name'], '</a></h2>', 
            '<div class="model">Product #:', $p['model'], '</div>', 
            '<div class="price">Price: ',\misc_func\zen_get_price($p['id']), '</div>',
            '<div class="cart-box abs f12 dn" data="',$p['id'],'"><div class="mask abs"></div><div class="input-box rel">QTY:<input type="text" name="qty" value="1" maxlength="4" class="ml5"/> Yards</div><button class="submit rel">ADD To Cart</button></div>', 
            '</li>';
    }
    ?>
</ul>
<script>
$(function(){
	$('.product-box').hover(function(){
		$(this).find('.cart-box').removeClass('dn');
	},function(){
		$(this).find('.cart-box').addClass('dn');
	});
	$('.cart-box button').click(function(e){
	    var num = $(this).parent().find('input[name="qty"]').val();
	    var productId  = $(this).parent().attr('data');
	    if(!/^\d+$/.test(num)){
	    	alert('Please input a number');
	    	return false;
	    }
	    var $dot = $('.animated-dot');
	    var $end = $('#header-wrapper .header-cart-status');
	    var offsetLeft = $end[0].getBoundingClientRect().left, offsetTop = $(window).scrollTop();
	    $dot.css({'left':e.pageX,'top':e.pageY}).removeClass('dn');
	   
	    $dot.animate({'left':offsetLeft,'top':offsetTop},'slow',function(){
	        $dot.addClass('dn');
	        $('.header-cart-box').html('<div class="loading"></div>').removeClass('dn');
	        var url = 'index.php?action=add_product&in_ajax=1';
	        var data = 
		        {
					'products_id':productId,
					'cart_quantity':1,
					'securityToken':'<?php echo $_SESSION['securityToken']?>'
				}
			var callback = function(response){
	        	   if(response.result == 'success'){
	        		   Mobanbase.getCart();
		           }
				};
	        $.post(url, data, callback, 'JSON');
		});
	});
});
</script>
<div class="split-page fix">
	<ul class="limit fix l">
		<li class="l" style="padding-right: 5px">Items Per Page:</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 27 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=27')?>">27</a>
		</li>
		<li style="padding: 0 5px" class="l">|</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 54 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=54')?>">54</a>
		</li>
		<li style="padding: 0 5px" class="l">|</li>
		<li class="l">
			<a class="<?php echo $_GET['limit'] == 99 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=99')?>">99</a>
		</li>
	</ul>
	<div class="page-links r"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
</div>
<div class="abs animated-dot dn">dot</div>
<?php }?>
