<div id="center">
	<div class="inner-container">
	<?php if (!$this_is_home_page && DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
        <div id="breadcrumb"><?php echo $breadcrumb->trail('<span class="gt">&gt;</span>'); ?></div>
    <?php } ?>
    <h1 class="cate-heading"><?php echo $breadcrumb->last(); ?></h1>
    <?php if ($categories_image = zen_get_categories_image($current_category_id)) { ?>
    <div class="cate-img"><img src="<?php echo DIR_WS_IMAGES . $categories_image;?>" /></div>
    <?php }?>
    <div class="product-filter-wrapper">
        <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_products_filter.php'; ?>
    </div>
		<div class="product-listing-wrapper">
	    <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_products_listing.php'; ?>
	</div>
	</div>
</div>