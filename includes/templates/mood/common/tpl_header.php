<?php
// 所有的信息都统一的头部
if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
}
if ($messageStack->size('update') > 0) {
    echo $messageStack->output('update');   
}          
if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
    echo htmlspecialchars(urldecode($_GET['error_message']), ENT_COMPAT, CHARSET, TRUE);
}
if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
    echo htmlspecialchars($_GET['info_message'], ENT_COMPAT, CHARSET, TRUE);
} else {}
?>
<?php if (! isset($flag_disable_header) || ! $flag_disable_header) { ?>
<?php include DIR_WS_MODULES . $template_dir . '/categories_tree.php';?>
<div id="header-wrapper">
    <div class="header-top">
        <div class="inner-container fix">
            <ul class="top-left l fix">
                <li class="first l"></li>
                <li class="l"><a href="">blog</a></li>
                <li class="l"><a href="" class="available"><span class="live-chat-icon dib"></span>live chat</a></li>
                <li class="l"><a href="" class="available">classes</a></li>
            </ul>
            <ul class="top-right r fix">
                <?php if ($_SESSION['customer_id']) { ?>
                <li class="l"><a class="available" href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a></li>
                <li class="l"><a class="available" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
                <?php }else{?>
                <li class="l"><a href="<?php echo zen_href_link('create_account')?>" class="available">join</a></li>
                <li class="l"><a href="<?php echo zen_href_link('login')?>" class="available">login</a></li>
                <?php }?>
                <li class="l rel">
                    <a href="javascript:;" class="header-cart-status dib"><span class="items db"><?php echo $_SESSION['cart']->count_contents()?> items</span></a>
                    <div class="header-cart-box abs dn"></div>
                    <script>
                    $(function(){
                        $('body').click(function(){$('.header-cart-box').addClass('dn')});
                        $('.header-cart-box').click(function(e){e.stopPropagation();});
                        $('.header-cart-status').click(function(){
                        	$('.header-cart-box').html('<div class="loading"></div>').removeClass('dn');
                            Mobanbase.getCart();
                            return false;
                        });
                     });
                    </script> 
                </li>
            </ul>
        </div>
    </div>
    <div class="header-main inner-container fix">
        <h1 class="logo l"><a class="db" href=""></a></h1>
        <div class="quick-access r">
            <ul class="tools">
              <li class="contact dib">201-933-7565</li>  
              <li class="search-bar dib rel">
                <input type="text" name="searchKey" class="search-input" value="search" />
                <a href="javascript:;" class="search-btn abs"></a>
              </li>  
            </ul>
            <div class="nav-bar rel">
                <ul class="fix" style="margin-left:26px;">
                    <?php 
                        foreach($categoriesList as $level0){
                            $_cPath0 = $level0['categories_id']
                     ?>
                    <li class="nav-depath-0 l">
                        <a href="<?php echo zen_href_link('index','cPath='.$_cPath0)?>" class="db"><?php echo $level0['categories_name']?></a>
                        <ul class="nav-container abs" style="">
                            <li class="nav-header nav-depath-1 fix">
                                <ul>
                                   <li class="l"><a href="<?php echo zen_href_link('index','cPath='.$_cPath0.'&datetime=d')?>" class="dib">New Arrivals</a></li>
                                    <li class="l"><a href="<?php echo zen_href_link('index','cPath='.$_cPath0.'&best_seller=1')?>" class="dib">Best Sellers</a></li>
                                    <li class="l"><a href="<?php echo zen_href_link('index','cPath='.$_cPath0.'&price=0-10')?>" class="dib">$10 Or Less</a></li>
                                    <li class="l"><a href="<?php echo zen_href_link('index','cPath='.$_cPath0.'&sale=1')?>" class="dib sale">Sale</a></li>
                                </ul>
                            </li>
                            <li class="nav-body nav-depath-1">
                                <ul>
                                    <?php for($i=0;$i<5;$i++){?>
                                    <li class="nav-depath-2 dib" style="margin:0;">
                                        <ul>
                                            <?php 
                                            if(count($level0['_child']) > 0){
                                            foreach($level0['_child'] as $k => $level1){
                                                $_cPath1 = $_cPath0 . '_' .$level1['categories_id'];
                                            ?>
                                            <li class="nav-depath-3"><h5><?php echo $level1['categories_name']?></h5></li>
                                            <li class="nav-depath-3"><a class="view-all db" href="<?php echo zen_href_link('index','cPath='.$_cPath1)?>">&gt;View All</a></li>
                                            <li class="nav-depath-3">
                                                <ul>
                                                    <?php 
                                                    if(count($level1['_child']) > 0){
                                                    foreach($level1['_child'] as $level2){
                                                        $_cPath2 = $_cPath1 . '_' .$level2['categories_id'];
                                                    ?>
                                                    <li class="nav-depath-4"><a href="<?php echo zen_href_link('index','cPath='.$_cPath2)?>"><?php echo $level2['categories_name']?></a></li>
                                                    <?php }}?>
                                                </ul>
                                            </li>
                                            <?php 
                                                unset($level0['_child'][$k]);
                                                if(count($level1['_child']) > 10){
                                                    break;
                                                }
                                            }}?>
                                        </ul>
                                    </li>
                                   <?php }?>
                                </ul>
                            </li>
                        </ul>
                        <div class="triangle-wrapper rel"><div class="triangle-up abs dn"></div></div>
                    </li>
                    <?php }?>
                </ul>
                <a class="my-mood-board abs db" href="<?php echo zen_href_link('boards')?>"></a>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
	$('.nav-depath-0').hover(function(){
		$(this).children('.nav-container').css('left','-73px');
		$(this).children('.triangle-wrapper').find('.triangle-up').removeClass('dn');
		},function(){
		$(this).children('.nav-container').css('left','-9999px');
		$(this).children('.triangle-wrapper').find('.triangle-up').addClass('dn');
		});
});
</script>
<?php } ?>