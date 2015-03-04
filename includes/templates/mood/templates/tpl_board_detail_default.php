<div id="center">
	<div class="inner-container">
		<div class="b-user-profile">
			<!-- <div class="b-user-profile__info">
				<div class="b-user-profile__info-picture">
					<img width="290" height="290" alt="Profile Sarah Gunn" src="http://www.moodfabrics.com/skin/frontend/moodfabrics/default/images/placeholders/profiles.jpg">
				</div>
				<div class="b-user-profile__info-description">
					<h3 class="user-name">Sarah Gunn</h3>
					<p>
						State: South Carolina
						<br>
						Country: United States
						<br>
						Skill Level: Intermediate
						<br>
					</p>
				</div>
			</div> -->
			<div class="b-tabs" id="user-profile-info">
				<div class="b-tabs__switches">
					<ul>
						<li class="active">
							Mood Boards
							<span></span>
						</li>
					</ul>
				</div>
				<div class="b-tabs__content">
					<ul>
						<li class="b-tabs__item" id="user-moodboards-area" style="display: list-item;">
							<div data-url="" class="b-moodboard">
								<div class="b-moodboard__menu fix">
									<div class="left l">
										<b>Select a Board</b>
										<select name="current_board" class="b-core-ui-select__select_state_hide" style="" onchange="location.href='index.php?main_page=board_detail&bid='+this.value">
										<?php 
										foreach($boardList as $board){
										    if($_GET['bid'] == $board['bid']){
										        $selected = ' selected="selected"';
										    }else{
										        $selected='';
										    }
										    echo '<option value="'.$board['bid'].'"'.$selected.'>'.$board['name'].'</option>';
										}
										?>
										</select>
										<span class="created">Created: <?php echo date('Y-m-d H:i:s',$_GET['timeline'])?></span>
									</div>
								</div>
								<div class="b-moodboard__submenu fix">
									<div class="left left fix">
										<div class="rating-title l">Rated</div>
										<div class="ratings l fix">
											<div class="rating-box l rel" style="top:15px;margin-left:10px;">
												<div style="width: <?php echo floatval($_GET['reviews']['rating'])*100 . '%'?>;" class="rating"></div>
											</div>
											
											<p class="rating-links l">
												<a class="read-moodboard-reviews" href="javascript:;"><?php echo $reviewsTotal;?> reviews</a>
												<span class="separator">|</span>
												<a class="add-reviews-btn" href="javascript:;">Add a Review</a>
											</p>
										</div>
									</div>
								</div>
								<div class="b-moodboard__board_wrapper">
									<div class="b-moodboard__board">
										<div class="b-moodboard__area fix">
										  <ul>
										  <?php foreach($imageList as $item){?>
										      <li class="l rel">
										          <img src="<?php echo DIR_WS_IMAGES.'uploads/'.$item['images']?>" width="200" height="200"/>
										          <span class="ding abs"></span>
										      </li>
										      <?php }?>
										  </ul>
										</div>
									</div>
								</div>
								<div class="reviews mt20">
								<?php require DIR_WS_TEMPLATE . '/templates/tpl_modules_reviews.php';?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>