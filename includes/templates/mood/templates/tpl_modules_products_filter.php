<?php
$show_filter = false;
include DIR_WS_MODULES . $template_dir . '/products_filter.php';
if ($show_filter) {
    ?>
<div class="filter-switch fix">
	<ul class="fix l">
		<li class="l rel<?php echo (!isset($_GET['datetime']) && !isset($_GET['best_seller']) && !isset($_GET['sale'])) ? ' current' : '';?>">
			<a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('datetime','best_seller','sale','content','type','color','price')));?> ">ALL</a>
			<span></span>
		</li>
		<li class="l rel<?php echo ($_GET['datetime'] == 'd') ? ' current' : '';?>">
			<a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('datetime','best_seller','sale')).'&datetime=d');?> ">New Arrivals</a>
			<span></span>
		</li>
		<li class="l rel<?php echo ($_GET['best_seller'] == '1') ? ' current' : '';?>">
			<a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('datetime','best_seller','sale')).'&best_seller=1');?> ">Best Sellers</a>
			<span></span>
		</li>
		<li class="l rel<?php echo ($_GET['sale'] == '1') ? ' current' : '';?>">
			<a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('datetime','best_seller','sale','price')).'&sale=1');?> ">
				<em>Sale</em>
			</a>
			<span></span>
		</li>
	</ul>
	<div class="view-mode r">
		<span class="result"><?php echo $listing->RecordCount()?> Results</span>

	</div>
</div>
<div class="filter-select-wrapper">
	<div class="filter-select">
		<ul class="fix">
			<li class="l">
				<div class="input rel">
					<span class="value">Content</span>
					<span class="button"></span>
					<div class="dropdown abs dn">
						<ul>
                            <?php
    foreach ($contents as $key => $v) {
        $_class = (isset($attArr['content']) && in_array($v['id'], $attArr['content'])) ? 'current' : '';
        $vid = (isset($attArr['content']) && ! empty($attArr['content']) && ! in_array($v[id], $attArr['content'])) ? implode('_', $attArr['content']) . '_' . $v['id'] : $v['id'];
        echo '<li><a class="db ' . $_class . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array(
            'content'
        )) . '&content=' . $vid) . '"><span></span>' . $key . '(' . $v['num'] . ')' . '</a></li>';
    }
    ?>
                        </ul>
					</div>
				</div>
			</li>
			<li class="l">
				<div class="input rel">
					<span class="value">Fabric Type</span>
					<span class="button"></span>
					<div class="dropdown abs dn">
						<ul>
                            <?php
    
    foreach ($types as $key => $v) {
        $_class = (isset($attArr['type']) && in_array($v['id'], $attArr['type'])) ? 'current' : '';
        $vid = (isset($attArr['type']) && ! empty($attArr['type']) && ! in_array($v[id], $attArr['type'])) ? implode('_', $attArr['type']) . '_' . $v['id'] : $v['id'];
        echo '<li><a class="db ' . $_class . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array(
            'type'
        )) . '&type=' . $vid) . '"><span></span>' . $key . '(' . $v['num'] . ')' . '</a></li>';
    }
    ?>
                        </ul>
					</div>
				</div>
			</li>
			<li class="l">
				<div class="input rel">
					<span class="value">Color</span>
					<span class="button"></span>
					<div class="dropdown abs dn">
						<ul>
                            <?php
    
    foreach ($colors as $key => $v) {
        $_class = (isset($attArr['color']) && in_array($v['id'], $attArr['color'])) ? 'current' : '';
        $vid = (isset($attArr['color']) && ! empty($attArr['type']) && ! in_array($v[id], $attArr['color'])) ? implode('_', $attArr['color']) . '_' . $v['id'] : $v['id'];
        echo '<li><a class="db ' . $_class . '" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array(
            'color'
        )) . '&color=' . $vid) . '"><span></span>' . $key . '</a></li>';
    }
    ?>
                        </ul>
					</div>
				</div>
			</li>
			<li class="l">
				<div class="input rel">
					<span class="value">Prices</span>
					<span class="button"></span>
					<div class="dropdown abs dn">
						<ul>
						  <?php 
						      foreach($prices as $key => $price){
						      $price = $currencies->display_price($price, zen_get_tax_rate(0));
						      $fromPrice  = isset($prices[$key-1])? $currencies->display_price($prices[$key-1], zen_get_tax_rate(0)):'0';
						      if($key>=3) $toPrice = '';
						      else    $toPrice = $prices[$key];
						      $param = (isset($prices[$key-1])?$prices[$key-1]:0).'-'.$toPrice;
						      ?>
							<li>
								<a class="<?php echo ($param == $_GET['price']?'current':'')?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('price')).'price='.$param)?>"><span></span><?php echo ($key >= 3) ? $price.' and above ' : $fromPrice .' - '. $price; ?></a>
							</li>
							<?php if($key>=3) break;}?>
						</ul>
					</div>
				</div>
			</li>
		</ul>
		<?php if(isset($_GET['color']) || isset($_GET['content']) || isset($_GET['type']) || isset($_GET['price'])){?>
		<div class="filter-selected">
		  <ul class="fix">
		      <li class="item l">
		          <ul>
		          <?php 
		              if(isset($_GET['content'])){
		              $tempArr = explode('_', $_GET['content']);
		              foreach($tempArr as $key => $v){
		                  $tempCopy = $tempArr;
		                  unset($tempCopy[$key]);
		                   $param = (count($tempCopy) > 0) ? '&content='.implode('_', $tempCopy):'';
		                  $name  = \misc_func\getAttributeName($v);
		          ?>
		              <li><a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('content')).$param)?>" class="dib">Remove</a><span class="dib"><?php echo $name?></span></li>
		          <?php }}?>
		          <li></li>
		          </ul>
		      </li>
		      <li class="item l">
		          <ul>
		          <?php 
		              if(isset($_GET['type'])){
		              $tempArr = explode('_', $_GET['type']);
		              foreach($tempArr as $key => $v){
		                  $tempCopy = $tempArr;
		                  unset($tempCopy[$key]);
		                  $param = (count($tempCopy) > 0) ? '&type='.implode('_', $tempCopy):'';
		                  $name  = \misc_func\getAttributeName($v);
		          ?>
		              <li><a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('type')).$param)?>" class="dib">Remove</a><span class="dib"><?php echo $name?></span></li>
		           <?php }}?>
		           <li></li>
		          </ul>
		      </li>
		      <li class="item l">
		          <ul>
		          <?php 
		              if(isset($_GET['color'])){
		              $tempArr = explode('_', $_GET['color']);
		              foreach($tempArr as $key => $v){
		                  $tempCopy = $tempArr;
		                  unset($tempCopy[$key]);
		                   $param = (count($tempCopy) > 0) ? '&color='.implode('_', $tempCopy):'';
		                  $name  = \misc_func\getAttributeName($v);
		          ?>
		              <li><a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('color')).$param)?>" class="dib">Remove</a><span class="dib"><?php echo $name?></span></li>
		          <?php }}?>
		          <li></li>
		          </ul>
		      </li>
		      
		      <li class="item l">
		          <ul>
		          <?php 
		              if(isset($_GET['price'])){
		                  $tempArr = explode('-',$_GET['price']);
		                  if(count($tempArr) ==1){
		                      $name = $tempArr[0].' and above';
		                  }else{
		                      $name = $_GET['price'];
		                  }
    		          ?>
		              <li><a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('price')))?>" class="dib">Remove</a><span class="dib"><?php echo $name?></span></li>
		          <?php }?>
		          <li></li>
		          </ul>
		      </li>
		      <li class="r"><a href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('content','color','type','price')))?>" style="color:#000;">Clear All</a></li>
		  </ul>
		</div>
		<?php unset($name,$param,$tempCopy,$tempArr);}?>
	</div>
</div>
<script>
$(function(){
	$('.filter-select-wrapper .input').hover(function(){
		$(this).find('.dropdown').stop().slideDown();
	},function(){
		$(this).find('.dropdown').stop().slideUp();
	});
});
</script>
<?php }else{}?>
