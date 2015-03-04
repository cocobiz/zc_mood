<?php
// read stored boards

$sql = 'select b.bid, b.uid,b.name, b.timeline, c.customers_lastname as author from boards b join customers c on b.uid = c.customers_id';
if(isset($_GET['rating'])){
    $sql .=' join reviews r on r.products_id = b.bid';
}

$sql .=' where b.status=1';

if(isset($_GET['rating'])){
    $sql .=' and r.type=2 and r.reviews_rating='.intval($_GET['rating']);
}
$sort = isset($_GET['isort'])?$_GET['isort']:'DESC';

$sql .= " order by b.bid ". $sort;
$numPerRow = (isset($_GET['limit']) && ctype_digit($_GET['limit'])) ? $_GET['limit'] : 20;
$listing_split = new splitPageResults($sql, $numPerRow, 'b.bid', 'page');

if($listing_split->number_of_rows>0){
    $rs = $db->Execute($listing_split->sql_query);
    $boardList = array();
    if($rs->RecordCount()>0){
    
        while(!$rs->EOF){
    
            $logo = $db->Execute("select images from board_works where bid = ".$rs->fields['bid'].' order by wid DESC limit 1');
            $rs->fields['logo'] = $logo->fields['images'];
            
            
            // we caclulate the reviews ratings here
            $reviews_query = "select rd.title, rd.reviews_text,r.reviews_id,r.customers_name,r.date_added, r.reviews_rating as rating from " . TABLE_REVIEWS . " r, "
                . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$rs->fields['bid'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                                   " and r.status = '1' and r.type=2";
            
            $list = $db->Execute($reviews_query);
            
            $reviewsTotal = $list->RecordCount();
            if($list->RecordCount()){
                $total = intval($list->RecordCount()) * 5;
                $subTotal = 0;
                while(!$list->EOF)
                {
                    $subTotal += intval($list->fields['rating']);
                    
                    $list->MoveNext();
                }
                $rs->fields['reviewsRating'] = floatval($subTotal/$total)*100 . '%';
            }else{
                $rs->fields['reviewsRating'] = '0';
            }
            
            
    
            $boardList[] = $rs->fields;
    
            $rs->MoveNext();
        }
    }
}
//print_r($boardList);exit;


