<?php

if(isset($_GET['bid']))
{
    $res = $db->Execute("select uid, timeline from boards where bid = ".intval($_GET['bid']));
    
    $_GET['uid'] = $res->fields['uid'];
    
    $_GET['timeline'] = $res->fields['timeline'];
    
    $res = $db->Execute("select wid,name,bid,uid,images from board_works where status=1  and bid=".intval($_GET['bid']));
    
    $imageList = array();
    if($res->RecordCount()>0){
        while(!$res->EOF){
            $imageList[] = $res->fields;
            $res->MoveNext();
        }
    }
    
    
    // read the stroed boards
    $res = $db->Execute("select bid, name, uid, description, timeline from boards where status=1 and private=0 and uid=".intval($_GET['uid']));
    $boardList = array();
    while(!$res->EOF){
        $boardList[] = $res->fields;
        $res->MoveNext();
    }
    
    
    // we caclulate the reviews ratings here
    $reviews_query = "select rd.title, rd.reviews_text,r.reviews_id,r.customers_name,r.date_added, r.reviews_rating as rating from " . TABLE_REVIEWS . " r, "
        . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$_GET['bid'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           " and r.status = '1' and r.type=2";
    
    $list = $db->Execute($reviews_query);
    
    $reviewsTotal = $list->RecordCount();
    if($list->RecordCount()){
        $total = intval($list->RecordCount()) * 5;
        $subTotal = 0;
        $stars = array('1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0);
        $tempArr = array();
        while(!$list->EOF)
        {
            $subTotal += intval($list->fields['rating']);
            switch(intval($list->fields['rating']))
            {
                case 1:
                    ++$stars['1'];
                    break;
                case 2:
                    ++$stars['2'];
                    break;
                case 3:
                    ++$stars['3'];
                    break;
                case 4:
                    ++$stars['4'];
                    break;
                case 5:
                    ++$stars['5'];
                    break;
            }
            $temArr[] = $list->fields;
            $list->MoveNext();
        }
    
        foreach($stars as &$star){
            $star = $star/$list->RecordCount();
        }
    
        $_GET['reviews']['rating'] = $subTotal/$total;
        $_GET['reviews']['stars'] = $stars;
        $_GET['reviews']['list']  = &$temArr;
    
    }
    $_GET['products_id'] = $_GET['bid'];// 
    $_GET['reviews_type'] = 2;// product
    
    
    
}else{
    echo 'Fate Error!';
}

//print_r($imageList);exit;