<div class="box-rating fix">
	<h3 class="overall">Overall:</h3>
	<div class="ratings l fix">
		<div class="rating-box l">
			<div style="width: <?php echo floatval($_GET['reviews']['rating'])*100 . '%'?>;" class="rating"></div>
		</div>
		<div class="rating-reviews l">(<?php echo $reviews->fields['count']?> reviews)</div>
		<p class="rating-links l">
			<span class="separator">|</span>
			<a class="add-reviews-btn" href="javascript:;">Add a Review</a>
		</p>
	</div>
	<br class="cl" />
	<div class="stars fix">
		<dl>
			<dt>5 Stars</dt>
			<dd>
				<span class="star-rating">
					<span style="width: <?php echo $_GET['reviews']['stars']['5']*100 . '%'?>"></span>
				</span>
			</dd>
			<dt>4 Stars</dt>
			<dd>
				<span class="star-rating">
					<span style="width: <?php echo $_GET['reviews']['stars']['4']*100 . '%'?>"></span>
				</span>
			</dd>
			<dt>3 Stars</dt>
			<dd>
				<span class="star-rating">
					<span style="width: <?php echo $_GET['reviews']['stars']['3']*100 . '%'?>"></span>
				</span>
			</dd>
			<dt>2 Stars</dt>
			<dd>
				<span class="star-rating">
					<span style="width: <?php echo $_GET['reviews']['stars']['2']*100 . '%'?>"></span>
				</span>
			</dd>
			<dt>1 Stars</dt>
			<dd>
				<span class="star-rating">
					<span style="width: <?php echo $_GET['reviews']['stars']['1']*100 . '%'?>"></span>
				</span>
			</dd>
		</dl>
	</div>
</div>
<?php if(count($_GET['reviews']['list'])){?>
<div id="customer-reviews" class="box-collateral box-reviews">
	<h3 class="title">Customer Reviews</h3>
	<ul class="reviews">
	   <?php foreach($_GET['reviews']['list'] as $item){?>
		<li class="review fix">
			<div class="user-info fix l">
				<h4 class="user-name">
					<a href=""><?php echo $item['customers_name']?></a>
				</h4>
				<div class="fix">
					<p class="rating-label l">Rating:</p>
					<div class="rating-box l">
						<div style="width:<?php echo intval($item['rating'])/0.05 . '%'?>;" class="rating"></div>
					</div>
				</div>
			</div>
			<div class="user-review l">
				<h4 class="title"><?php echo $item['title']?></h4>
				<p class="date"><?php echo $item['date_added']?></p>
				<p class="comment"><?php echo $item['reviews_text']?></p>
			</div>
		</li>
		<?php }?>
	</ul>
</div>
<?php }?>
<script>
$(function(){
$('.read-reviews-btn').click(function(){
    var $target = $('.description .header li').eq(1)
    var top = Mobanbase.getPosition($target[0]).top - 30;
    $('body,html').animate({'scrollTop':top});
    $target.trigger('click');
});

$('.add-reviews-btn').click(function(){
    new Mobanbase.popWindow({content:$('#add_a_review_form').clone(true)});
});
$('#rating-inputs label').hover(function(){
    $(this).add($(this).prevAll()).addClass('highlight');
},function(){
    $(this).add($(this).siblings()).removeClass('highlight');
}).click(function(){
    $(this).add($(this).siblings()).removeClass('selected').end().add($(this).prevAll()).addClass('selected');
    $(this).find('input').attr('checked','checked');
});
$('.buttons-set button').click(function(){
    var data = {};
    data.nickName = $('.pop-window input[name="nickname"]').val();
    data.title  = $('.pop-window input[name="title"]').val();
    data.detail  = $('.pop-window textarea[name="detail"]').val();
    data.rating = $('.pop-window input[name="ratings[1]"]:checked').val();
    
    if(data.nickName == ''){alert('Nick name can not be null.');return false;}
    if(data.title == ''){alert('Summary of your review  can not be null.');return false;}
    if(data.detail == ''){alert('Review can not be null.');return false;}
    if(!data.rating){alert('Please make a rating.');return false;}

    data.products_id = '<?php echo $_GET['products_id'];?>';
    data.securityToken = '<?php echo $_SESSION['securityToken']?>';
    data.type = <?php echo $_GET['reviews_type']?>;
    var url = 'index.php?main_page=ajax&action=add_review';
    var callback = function(response){
	    alert(response);
	    $('.pop-window .close').trigger('click');
	}
	$.post(url,data,callback);
});
});

</script>
<div id="add_a_review_form" class="form-add dn">
	<h2>Write Your Own Review</h2>
	<ul class="form-list fix">
		<li>
			<label class="required">
				<em>*</em>
				How do you rate this product?
			</label>
			<span id="input-message-box"></span>
			<div id="rating-inputs">
				<p>
					<strong>Quality:</strong>
					<span class="labels">
						<label>
							<input type="radio" class="radio" value="1" id="Quality_1" name="ratings[1]">
						</label>
						<label>
							<input type="radio" class="radio" value="2" id="Quality_2" name="ratings[1]">
						</label>
						<label>
							<input type="radio" class="radio" value="3" id="Quality_3" name="ratings[1]">
						</label>
						<label>
							<input type="radio" class="radio" value="4" id="Quality_4" name="ratings[1]">
						</label>
						<label>
							<input type="radio" class="radio" value="5" id="Quality_5" name="ratings[1]">
						</label>
					</span>
				</p>
			</div>
			<input type="hidden" value="" class="validate-rating" name="validate_rating">
		</li>
		<li>
			<label class="required" for="nickname_field">
				<em>*</em>
				Profile Name
			</label>
			<div class="input-box">
				<input type="text" value="" class="input-text required-entry" id="nickname_field" name="nickname">
			</div>
		</li>
		<li>
			<label class="required" for="summary_field">
				<em>*</em>
				Summary of Your Review
			</label>
			<div class="input-box">
				<input type="text" value="" class="input-text required-entry" id="summary_field" name="title">
			</div>
		</li>
		<li>
			<label class="required" for="review_field">
				<em>*</em>
				Review
			</label>
			<div class="input-box">
				<textarea class="required-entry" rows="3" cols="5" id="review_field" name="detail"></textarea>
			</div>
		</li>
	</ul>
	<div class="message"></div>
	<div class="buttons-set">
		<button class="submit" title="Submit Review" >Submit Review</button>
	</div>
</div>