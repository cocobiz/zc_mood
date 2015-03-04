<?php
require(DIR_WS_MODULES . zen_get_module_directory('additional_images.php'));

?>
<style>
.jqzoom{ width:411px; height:411px; position:relative;}


/*jqzoom*/
.jqzoom{position:relative;padding:0;}
.zoomdiv{z-index:100;position:absolute;top:1px;left:0px;width:411px;height:411px;border:1px solid #e4e4e4;display:none;text-align:center;overflow: hidden;}
.bigimg{width:800px;height:800px;}
.jqZoomPup{z-index:10;visibility:hidden;position:absolute;top:0px;left:0px;width:50px;height:50px;border:1px solid #aaa;background:#FEDE4F 50% top no-repeat;opacity:0.5;-moz-opacity:0.5;-khtml-opacity:0.5;filter:alpha(Opacity=50);cursor:move;}
#spec-list{ position:relative; width:322px; margin-right:6px;}
#spec-list div{ margin-top:0;margin-left:-30px; *margin-left:0;}
</style>
<script src="<?php echo DIR_WS_TEMPLATE . 'jscript/zoom.js'?>"></script>
<div class="main-image jqzoom">
    <img src="<?php echo \misc_func\generate_images($products_image,411,411);?>" jqimg="<?php echo \misc_func\generate_images($products_image,411,411);?>" width="411" height="411" title="<?php echo $products_name?>" alt="<?php echo $products_name?>"/>
</div>
<ul class="additional-images fix">
    <?php 
    if(count($images_array))
    foreach($images_array as $img){?>
    <li class="l"><a href=""><img src="<?php echo $products_image_directory  .$img;?>" width="74" height="74" /></a></li>
    <?php }?>
</ul>
<script>
$(function(){			
	   $(".jqzoom").jqueryzoom({
			xzoom:400,
			yzoom:400,
			offset:10,
			position:"right",
			preload:1,
			lens:1
		});
	   $('.additional-images').click(function(e){
		   var oTargetImg = $('.main-image img')[0];
	       if(e.target.tagName.toLowerCase() == 'img'){
		       var src = e.target.src;
		       oTargetImg.src = src;
		       $(oTargetImg).attr('jqimg',src);
		   }
	       return false;
	   });
	})
</script>