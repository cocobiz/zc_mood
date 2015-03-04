<?php
/**
 * This Modules is used for getting produts which based on Products Model
 * For Example:
 * 
 * Current Product Model: #9527
 * Related Products Model likes: #9527-1, #9527-2, #9527-3 ... etc.
 * 
 * ^ ^ Just For Colors Modules ^ ^
 * 
 * @author Mobanbase.com
 */
$show_template = false;
include DIR_WS_MODULES . $template_dir .'/model_related_proudcts.php';

if($show_template){
?>
Colors:
<ul class="fix">
<?php 
foreach($contentBox as $product){
?>
    <li class="l"><a href="<?php echo zen_href_link('product_info','products_id='.$product['products_id'])?>">
    <img src="<?php echo \misc_func\generate_images($product['products_image'], 30, 30)?>" width="30px" height="30px"></a></li>
  
<?php 
}
echo '</ul>';
}
?>
