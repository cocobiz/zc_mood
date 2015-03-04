<div id="center">
    <div class="inner-container">
    <?php require DIR_WS_TEMPLATE . 'templates/tpl_modules_boards_nav.php';?>
    <div class="my-boards">
        <div class="tips"></div>
        <div class="b-moodboard__menu fix">
			<div class="left l">
				<b>Select a Board</b>
				<select style="" class="b-core-ui-select__select_state_hide" name="current_board" onchange="location.href='index.php?main_page=my_board&bid='+this.value">
				    <?php 
				    $boards = array_reverse($boards);
				    foreach($boards as $board){
				        if($_GET['bid'] == $board['bid']){
				            $selected = ' selected="selected"';
				            $currentBoard = $board;
				        }else{
				            $selected='';
				        }
				        echo '<option value="'.$board['bid'].'"'.$selected.'>'.$board['name'].'</option>';     
				    }
				    $currentBoard = isset($currentBoard)?$currentBoard:$boards[0];
				    ?>
				</select>
				
				<span class="rel"><a href="javascript:;" class="board-button edit "><span></span>Edit</a>
				<div class="mood-pop abs" style="left:-80px;display:none;">
				    <form action="<?php echo zen_href_link('my_board','action=edit&bid='.$currentBoard['bid'])?>" method="post">
				    <input type="hidden" name="securityToken" value="<?php echo $_SESSION['securityToken']?>">
				    <input type="hidden" name="bid" value="<?php echo $currentBoard['bid']?>">
				    <h3 class="title">Edit Board</h3>
				    <ul>
				        <li>Title</li>
				        <li><input type="text" name="name" class="input-text" value="<?php echo $currentBoard['name']?>" onfocus="this.value= this.value=='My New Board'?'':this.value;" onblur="this.value=this.value==''?'My New Board':this.value;"/></li>
				        <li>Description</li>
				        <li><textarea name="desc" onfocus="this.value= this.value=='Default Description'?'':this.value;" onblur="this.value=this.value==''?'Default Description':this.value;"><?php echo $currentBoard['description']?></textarea></li>
				        <li><input type="checkbox" value="1" style="margin:0;padding:0;" <?php echo $currentBoard['private']==0?'checked="checked"':''?>> Everyone can see my board</li>
				        <li style="border-top:1px solid #b2b2b2;margin-top:20px;"></li>
				        <li class="tr mt10"><input class="submit" type="submit" value="SUBMIT"/></li>
				    </ul>
				    <span class="arrow abs"></span>
				    <a class="close abs" href="javascript:;"></a>
				    </form>
				</div>
				</span>
				<span class="rel"><a href="javascript:;" class="board-button new"><span></span>New Board</a>
				<div class="mood-pop abs" style="left:-80px;display:none;">
				<form action="<?php echo zen_href_link('my_board','action=new')?>" method="post">
				<input type="hidden" name="securityToken" value="<?php echo $_SESSION['securityToken']?>">
				    <h3 class="title">New Board</h3>
				    <ul>
				        <li>Title</li>
				        <li><input type="text" name="name" class="input-text" value="New Board Title" onfocus="this.value= this.value=='New Board Title'?'':this.value;" onblur="this.value=this.value==''?'New Board Title':this.value;"/></li>
				        <li>Description</li>
				        <li><textarea name="desc" onfocus="this.value= this.value=='Default Description'?'':this.value;" onblur="this.value=this.value==''?'Default Description':this.value;">Default Description</textarea></li>
				        <li><input type="checkbox" name="private" value="1" style="margin:0;padding:0;" checked="checked"> Everyone can see my board</li>
				        <li style="border-top:1px solid #b2b2b2;margin-top:20px;"></li>
				        <li class="tr mt10"><input class="submit" type="submit" value="SUBMIT"/></li>
				    </ul>
				    <span class="arrow abs"></span>
				    <a class="close abs" href="javascript:;"></a>
				</form>
				</div>
				</span>
			</div>
			<script>
			$(function(){
			    $('a.edit, a.new').click(function(e){
				    $(this).parent().find('.mood-pop').show();
				    return false;
				});
				$('.mood-pop').click(function(e){e.stopPropagation();});
			    $('.close').click(function(){
				    $(this).closest('.mood-pop').hide();
				});
				$('body').click(function(){
				    $('.mood-pop').hide();
				})
				$('.board-delete').click(function(){
				    if(confirm('Are you sure to delete this board?')){
					    var bid = $('input[name="bid"]').val();
					    location.href = 'index.php?main_page=my_board&action=delete&bid='+bid;
					}
				});
				$('.filename').click(function(){
					$('.user_upload_image').trigger('click');
			    });
				$('.user_upload_image').change(function(){
				    $('.filename').val(this.value);
				});

				$('.upload-btn').click(function(){
				    if($('.user_upload_image').val() ==''){
					    alert('Please input a Picuure');
					    return false;
					}
					$('form[name="upload_image"]').submit();
				});
			 });
			</script>
			<div class="right r">
                <span class="preloader"></span>
               
                <a href="javascript:;" class="board-button board-delete"><span></span>Delete</a>
                
            </div>
		</div>
		<div class="b-moodboard__submenu fix">
            <div class="left l" style="margin-left:-10px;">
                    <span class="file-upload">
                    <form name="upload_image" action="<?php echo zen_href_link('my_board','action=upload&bid='.$currentBoard['bid'])?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="securityToken" value="<?php echo $_SESSION['securityToken']?>">
                    <input type="text" value="Upload Image" class="filename">
                    <a href="javascript:;" class="upload-btn dib rel">UPLOAD</a>
                    <input type="file" class="user_upload_image" name="board_image">
                    </form>
                </span>
                <span class="file-upload-message" style="display: none;">File was uploaded successfully</span>
            </div>
        </div>
        <div class="b-moodboard__board_wrapper">
			<div class="b-moodboard__board">
				<div class="b-moodboard__area fix">
				  <ul>
				    <?php foreach($imageList as $item){?>
				      <li class="l rel">
				          <img src="<?php echo DIR_WS_IMAGES.'uploads/'.$item['images']?>" width="200" height="200">
				          <span class="ding abs"></span>
				      </li>
				      <?php }?>
				  </ul>
				</div>
			</div>
		</div>
		
    </div>
    </div>
</div>