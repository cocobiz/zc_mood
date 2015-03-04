<div id="center">
    <div class="inner-container">
     <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_boards_nav.php';?>
     <div class="product-filter-wrapper">
    	<div class="filter-select-wrapper">
        	<div class="filter-select fix">
        	   <span class="l b">Filter By</span>
        		<ul class="fix l">
        			<li class="l">
        				<div class="input rel" style="width: 160px;">
        					<span class="value">Sort By Most Recent</span>
        					<span class="button"></span>
        					<div class="dropdown abs dn" style="width: 168px;">
        						<ul>
                                    <li><a href="" class="db">Sort By Most Recent</a></li>
                                    <li><a href="" class="db">Sort By Most Old</a></li>
                                </ul>
        					</div>
        				</div>
        			</li>
        			<li class="l">
        				<div class="input rel" style="width: 160px;">
        					<span class="value">Country</span>
        					<span class="button"></span>
        					<div class="dropdown abs dn" style="width: 168px;">
        						<ul>
                                    <li><a href="" class="db">Sort By Most Recent</a></li>
                                    <li><a href="" class="db">Sort By Most Old</a></li>
                                </ul>
        					</div>
        				</div>
        			</li>
        			<li class="l">
        			     <input type="text" value="Enter Username"/>
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
	<div class="product-listing-wrapper" id="users-list">
			<div class="split-page fix">
				<ul class="limit fix l">
					<li style="padding-right: 5px" class="l">Items Per Page:</li>
					<li class="l">
						<a href="" class="">12</a>
					</li>
					<li class="l" style="padding: 0 5px">|</li>
					<li class="l">
						<a href="" class="">20</a>
					</li>
					<li class="l" style="padding: 0 5px">|</li>
					<li class="l">
						<a href="" class="">50</a>
					</li>
				</ul>
				<div class="page-links r">
					&nbsp;
					<strong class="current item">1</strong>
					&nbsp;&nbsp;
					<a class="item" title=" Page 2 " href="">2</a>
					&nbsp;&nbsp;
					<a class="next item" title=" Next Page " href="">NEXT</a>
					&nbsp;
				</div>
			</div>
			<ul class="product-listing fix b-users-list">
				<li class="item">
				<div class="user-image">
					<a href="<?php echo zen_href_link('user_detail')?>">
						<img width="170" height="170"  src="http://www.moodfabrics.com/skin/frontend/moodfabrics/default/images/placeholders/profiles.jpg">
					</a>
				</div>
				<h3 class="user-name"><a href="<?php echo zen_href_link('user_detail')?>">Kijani Grinage</a></h3>
				</li>
				
			</ul>
			<div class="split-page fix">
				<ul class="limit fix l">
					<li style="padding-right: 5px" class="l">Items Per Page:</li>
					<li class="l">
						<a href="" class="">12</a>
					</li>
					<li class="l" style="padding: 0 5px">|</li>
					<li class="l">
						<a href="" class="">20</a>
					</li>
					<li class="l" style="padding: 0 5px">|</li>
					<li class="l">
						<a href="" class="">50</a>
					</li>
				</ul>
				<div class="page-links r">
					&nbsp;
					<strong class="current item">1</strong>
					&nbsp;&nbsp;
					<a class="item" title=" Page 2 " href="">2</a>
					&nbsp;&nbsp;
					<a class="next item" title=" Next Page " href="">NEXT</a>
					&nbsp;
				</div>
			</div>
		</div>
    </div>
</div>