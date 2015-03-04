<?php
/**
 * 首页
 */

$indexBanners = zen_banner_exists('dynamic', 'index-banners');

?>
<div id="center">
	<div class="inner-container">
		<div class="index-banner">
			<div class="silder-box rel">
				<ul class="silder-entity fix abs">
				    <?php while(!$indexBanners->EOF){?>
					<li class="silder-item l">
						<a href="<?php echo $indexBanners->fields['banners_url']?>">
							<img src="<?php echo DIR_WS_IMAGES . '/' .$indexBanners->fields['banners_image'];?>" width="960" height="369" alt="<?php echo $indexBanners->fields['banners_title']?>" title="<?php echo $indexBanners->fields['banners_title']?>" />
						</a>
					</li>
					<?php $indexBanners->MoveNext();}?>
				</ul>
				<div class="dot-thumb abs">
				    <?php for($i=0; $i<$indexBanners->RecordCount(); $i++){?>
				    <a href="javascript:;" class="dot dib <?php echo $i==0 ? 'current' : '';?>"></a>
				    <?php }?>    
				</div>
				<a href="javascript:;" class="prev db abs"></a>
				<a href="javascript:;" class="next db abs"></a>
			</div>
		</div>
		<script>
	    $(function(){
	        var $sliderBox = $('.silder-box');
	        var $scrEntity = $sliderBox.find('.silder-entity'); 
	        var $items     = $sliderBox.find('.silder-item');
	        var _width     = 960;
	        var _total     = $items.length;
	        var index      = 0;
	        var timer      = null;
	        var delay      = 5000;
	        
	        $items.each(function(){$scrEntity.append($(this).clone());});

	        $sliderBox.mouseover(function(){ window.clearTimeout(timer);});
	        $sliderBox.mouseout(function(){timer = window.setTimeout(function(){$sliderBox.find('.prev').trigger('click');timer = setTimeout(arguments.callee,delay);},delay);});
	        $sliderBox.trigger('mouseout');
	        
	        $sliderBox.click(function(e){
	            if(e.target.className.indexOf('prev') !== -1){
	                if(parseInt($scrEntity.css('left')) == 0) $scrEntity.css('left',-(_width * _total));
	                $scrEntity.not(':animated').animate({'left':'+='+_width});
	                index < _total && (++index);
	                index == _total && (index = 0);
	                $('.dot').eq(index).addClass('current').siblings().removeClass('current');
		        }
	            if(e.target.className.indexOf('next') !== -1){
	                if(parseInt($scrEntity.css('left')) <= -(_width * _total)) $scrEntity.css('left',0);
	                $scrEntity.not(':animated').animate({'left':'-='+_width});
	                index == 0 && (index = _total);
	                index > 0 && (--index);
	                $('.dot').eq(index).addClass('current').siblings().removeClass('current');
		        }
	            if(e.target.className.indexOf('dot') !== -1){
		            $(e.target).addClass('current').siblings().removeClass('current');
	            	index = $(e.target).index();
	            	$scrEntity.not(':animated').animate({'left':-_width * index});
		        }
		    });	        
		});
		</script>
		<ul class="index-cate-lite fix">
		<?php $i=0;foreach ($categoriesList as $categories){?>
			<li class="l rel">
				<a href="<?php echo zen_href_link('index','cPath='.$categories['categories_id'])?>" class="db">
					<span class="title abs"><?php echo $categories['categories_name']?></span>
					<img src="images/cate_icon/<?php echo 'No_'.$i++?>.jpg" height="76" title="" alt="" />
				</a>
			</li>
		<?php } unset($i);?>
		</ul>
		<div class="index-block index-feature rel">
			<h2 class="title rel">
				Featured PRODUCTS
			</h2>
			<div class="content rel">
				<ul class="fix scroll-entity abs" style="width: 10000px;">
				<?php require DIR_WS_MODULES.$template_dir.'/featured_products.php'?>
					<?php 
					if(count($contentBox,1)){
    					foreach($contentBox as $index => $item){
    					   if($index%2 == 0){
    					       echo '<li class="l"><a href="'.zen_href_link('product_info','products_id='.$item['products_id']).'"><img src="'.\misc_func\generate_images($item['products_image'], 101, 101) . '" width="101" height="101"/></a>';
    					   }else{
    					       echo '<a href="'.zen_href_link('product_info','products_id='.$item['products_id']).'"><img src="'.\misc_func\generate_images($item['products_image'], 101, 101).'" width="101" height="101"/></a></li>';
    					   }
    					}
					}
					?>
				</ul>
			</div>
			<a class="prev abs db" href="javascript:;">prev</a>
			<a class="next abs db" href="javascript:;">next</a>
			<script>
$(function(){
	var $wrapper = $('.index-feature');
    var $prevBtn = $wrapper.find('.prev');
    var $nextBtn = $wrapper.find('.next');
    var $scrollEntity = $wrapper.find('.scroll-entity');
    if($scrollEntity.find('li').length>8){
        $prevBtn.click(function(){
        	var left = parseInt($scrollEntity.css('left'));
            if(left <= -108*($scrollEntity.find('li').length - 8)) return false;
        	$scrollEntity.not(':animated').animate({'left':'-=108px'});
        });
        $nextBtn.click(function(){
            var left = parseInt($scrollEntity.css('left'));
            if(left==0) return false;
        	$scrollEntity.not(':animated').animate({'left':'+=108px'});
        });
    }
});
			</script>
		</div>
		<?php //require DIR_WS_TEMPLATE . 'templates/tpl_modules_index_sns.php';?>
	</div>
</div>