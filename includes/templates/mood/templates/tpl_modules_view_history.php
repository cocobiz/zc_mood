<?php
$show_template = false;
include DIR_WS_MODULES . $template_dir . '/view_history.php';

if ($show_template) {
?>
<div class="box">
<h2 class="header">Recently Viewed Products</h2>
<ul class="body">
	<?php foreach($contentBox as $product){?>
	<li class="item l"><a href="<?php echo zen_href_link($_GET['main_page'],'products_id='.$product['products_id'])?>" title="<?php echo $product['products_name']?>"><img src="<?php echo DIR_WS_IMAGES.$product['products_image']?>" width="118" height="118"/></a></li>
	<?php }?>
</ul>
</div>
<?php }?>