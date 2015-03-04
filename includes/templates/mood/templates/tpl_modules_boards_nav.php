<div class="b-tabs mt10">
	
    	<div class="b-tabs__switches">
    		<ul>
    			<li class="<?php echo $_GET['main_page'] == 'boards'?'active':'';?>"><a href="<?php echo zen_href_link('boards')?>">Mood Boards<span></span></a></li>
    			<!--  li class="<?php echo $_GET['main_page'] == 'users'?'active':'';?>"><a href="<?php echo zen_href_link('users')?>">User Profiles<span></span></a></li-->
    			<li class="<?php echo $_GET['main_page'] == 'my_board'?'active':'';?>"><a href="<?php echo zen_href_link('my_board')?>">My Boards</a><span></span></li>
    			<!-- li><a href="<?php echo zen_href_link('boards')?>">My Profile<span></span></a></li -->
    		</ul>
    	</div>
    	
</div>