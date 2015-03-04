<?php

// if not login redirect

if(!$_SESSION['customer_id']){
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// if the first time to this page  init the database a board

$res = $db->Execute("select count(*) as total from boards where uid=".intval($_SESSION['customer_id']));

$boardsTotal = $res->fields['total'];

if($boardsTotal == 0){
    $sql = "insert into boards values(null, 'My New Board', '".$_SESSION['customer_id']."', '0',null , '". time() ."', '1')";
    $db->Execute($sql);
}

// create a new board
//@todo: Exception
if(isset($_GET['action'])){
    switch ($_GET['action']){
        case 'edit':
            $name = mysql_real_escape_string(strip_tags($_POST['name']));
            $desc = mysql_real_escape_string(strip_tags($_POST['desc']));
            $private = isset($_POST['private']) ? '1' : '0';
            $bid  = intval($_POST['bid']);
            
            $sql = "update boards set name='".$name."', description = '".$desc."', private = '".$private."' where bid = ".$bid;
            $db->Execute($sql);
            break;
            
        case 'new':
          
            $name = mysql_real_escape_string(strip_tags($_POST['name']));
            $desc = mysql_real_escape_string(strip_tags($_POST['desc']));
            $private = isset($_POST['private']) ? '0' : '1';
            
            $sql = "insert into boards values(null, '".$name."', '".$_SESSION['customer_id']."', '".$private."','".$desc."' , '". time() ."', '1')";
            $db->Execute($sql);
            
            break;
        case 'delete':
            $db->Execute("delete from boards where bid = ".intval($_GET['bid']) . " and uid = ".intval($_SESSION['customer_id']));
            break;
            
        case 'upload':
            
            if($_FILES['board_image']['error']==0){
                if ((($_FILES["board_image"]["type"] == "image/gif") || ($_FILES["board_image"]["type"] == "image/png") || ($_FILES["board_image"]["type"] == "image/jpeg") || ($_FILES["board_image"]["type"] == "image/pjpeg")) && ($_FILES["board_image"]["size"] < 500000))
                {
                   
                    $newName = md5('mood'.time());
                    $suffix = end(explode('.',$_FILES['board_image']['name']));
                    $fullName = $newName.'.'.$suffix;
                    if(move_uploaded_file($_FILES["board_image"]["tmp_name"], "./images/uploads/" .$fullName )){
                        
                        $sql = 'insert into board_works values(null, "", '.intval($_GET['bid']).', '.$_SESSION['customer_id'].', "'.$fullName.'", '.time().', 1)';
                        $db->Execute($sql);
                    }
                    
                }
                else
                {
                    echo "Invalid file";exit;
                }
            }else{
                echo "Return Code: " . $_FILES["board_image"]["error"] . "<br />";exit;
            }
            break;
    }
}



// read the stroed boards
$res = $db->Execute("select bid, name, uid, description, timeline from boards where status=1 and private=0 and uid=".intval($_SESSION['customer_id']));
$boards = array();
while(!$res->EOF){
    $boards[] = $res->fields;
    $res->MoveNext();
}

// read the stored images
$tempBoard = end($boards);
$tempBid = isset($_GET['bid'])?$_GET['bid']:$tempBoard['bid'];
unset($tempBoard);

$res = $db->Execute("select wid,name,bid,uid,images from board_works where status=1 and uid = ".intval($_SESSION['customer_id']).' and bid='.intval($tempBid));
unset($tempBid);

$imageList = array();
if($res->RecordCount()>0){
    while(!$res->EOF){
        $imageList[] = $res->fields;        
        $res->MoveNext();
    }
}



