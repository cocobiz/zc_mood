<div id="center">
	<div class="inner-container">
    <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_boards_nav.php';?>
    <div class="product-filter-wrapper">
			<div class="filter-select-wrapper">
				<div class="filter-select fix">
					<span class="l b">Filter By</span>
					<ul class="fix l">
						<li class="l">
							<div class="input rel">
								<span class="value">Rating</span>
								<span class="button"></span>
								<div class="dropdown abs dn">
									<ul>
										<li>
											<a href="<?php echo zen_href_link('boards','rating=5')?>" class="db">5 Star</a>
										</li>
										<li>
											<a href="<?php echo zen_href_link('boards','rating=4')?>" class="db">4 Star</a>
										</li>
										<li>
											<a href="<?php echo zen_href_link('boards','rating=3')?>" class="db">3 Star</a>
										</li>
										<li>
											<a href="<?php echo zen_href_link('boards','rating=2')?>" class="db">2 Star</a>
										</li>
										<li>
											<a href="<?php echo zen_href_link('boards','rating=1')?>" class="db">1 Star</a>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li class="l">
							<div class="input rel" style="width: 160px;">
								<span class="value">Sort By Most Recent</span>
								<span class="button"></span>
								<div class="dropdown abs dn" style="width: 168px;">
									<ul>
										<li>
											<a href="<?php echo zen_href_link('boards','isort=desc')?>" class="db">Sort By Most Recent</a>
										</li>
										<li>
											<a href="<?php echo zen_href_link('boards','isort=asc')?>" class="db">Sort By Most Old</a>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
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
		</div>
		<div class="product-listing-wrapper" id="boards-list">
			<div class="split-page fix">
				<ul class="limit fix l">
					<li style="padding-right: 5px" class="l">Items Per Page:</li>
					<li class="l">
            			<a class="<?php echo $_GET['limit'] == 12 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=12')?>">12</a>
            		</li>
            		<li style="padding: 0 5px" class="l">|</li>
            		<li class="l">
            			<a class="<?php echo $_GET['limit'] == 20 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=20')?>">20</a>
            		</li>
            		<li style="padding: 0 5px" class="l">|</li>
            		<li class="l">
            			<a class="<?php echo $_GET['limit'] == 50 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=50')?>">50</a>
            		</li>
				</ul>
				<div class="page-links r">
					<?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
				</div>
			</div>
			<ul class="product-listing fix b-moodboards-list">
			
			 <?php 
			 
			 foreach($boardList as $board){?>
				<li class="product-box l rel">
    				<div class="moodboard-image new">
    					<a href="<?php echo zen_href_link('board_detail','bid='.$board['bid'].'&uid='.$board['uid'].'&time='.$board['timeline'])?>">
    						<img width="221" height="221" src="<?php echo DIR_WS_IMAGES.'uploads/'.$board['logo']?>">
    					</a>
    					<span class="icon"></span>				</div>
    				<h3 class="moodboard-name">
    				<a href="<?php echo zen_href_link('board_detail','bid='.$board['bid'].'&uid='.$board['uid'].'&time='.$board['timeline'])?>"><?php echo $board['name']?></a></h3>
                    <p class="moodboard-author">Author: <?php echo $board['author']?></p>
    				<div class="moodboard-rating fix">
    					<span class="label">Rated:</span>
    					<div class="ratings">
    						<div class="rating-box">
    							<div style="width: <?php echo $board['reviewsRating']?>;" class="rating"></div>
    						</div>
    					</div>
    				</div>
    				<p class="moodboard-date">Created: <?php echo date('Y-m-d H:i:s',$board['timeline'])?></p>
    			</li>
				<?php }?>
			</ul>
			<div class="split-page fix">
				<ul class="limit fix l">
					<li style="padding-right: 5px" class="l">Items Per Page:</li>
					<li class="l">
            			<a class="<?php echo $_GET['limit'] == 12 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=12')?>">12</a>
            		</li>
            		<li style="padding: 0 5px" class="l">|</li>
            		<li class="l">
            			<a class="<?php echo $_GET['limit'] == 20 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=20')?>">20</a>
            		</li>
            		<li style="padding: 0 5px" class="l">|</li>
            		<li class="l">
            			<a class="<?php echo $_GET['limit'] == 50 ? 'current':''?>" href="<?php echo zen_href_link($_GET['main_page'],zen_get_all_get_params(array('limit')) . '&limit=50')?>">50</a>
            		</li>
				</ul>
				<div class="page-links r">
					<?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
				</div>
			</div>
		</div>
	</div>
</div>
