<?php
/**
 * Events Observers
 * 
 * @author Mobanbase.com
 *
 */
class MultiObservers extends base{
    function __construct(){
        $eventIds = array(
            'NOTIFY_HEADER_END_PRODUCT_INFO',
            'NOTIFIER_CART_ADD_CART_END',
            'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_INFO'
            // add the eventId  which you want listen
        );
        $this->attach($this, $eventIds);
    }
    
    function update(&$class, $eventId, $param){
        switch ($eventId){
            case 'NOTIFY_HEADER_END_PRODUCT_INFO':      // view history
                if(isset($_COOKIE['viewhistory'])){
                    $viewHistory = unserialize($_COOKIE['viewhistory']);
                    if(isset($_GET['products_id']) && !in_array($_GET['products_id'], $viewHistory)){
                        if(count($viewHistory) >= 6) array_shift($viewHistory);
                        $viewHistory[] = $_GET['products_id'];
                        setcookie('viewhistory',serialize($viewHistory),time()+24*3600);
                    }
                }else{
                    if(isset($_GET['products_id'])){
                        $viewHistory = array($_GET['products_id']);
                        setcookie('viewhistory',serialize($viewHistory),time()+24*3600);
                    }
                }
                
                // we caclulate the reviews ratings here
                $reviews_query = "select rd.title, rd.reviews_text,r.reviews_id,r.customers_name,r.date_added, r.reviews_rating as rating from " . TABLE_REVIEWS . " r, "
                    . TABLE_REVIEWS_DESCRIPTION . " rd
                       where r.products_id = '" . (int)$_GET['products_id'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       " and r.status = '1'";
                global $db;
                $list = $db->Execute($reviews_query);
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
                
            break;
                
            case 'NOTIFIER_CART_ADD_CART_END':          // add shopping cart end
                switch ($_GET['action']){
                    case 'add_product':
                        $ret = array('result'=>'success','info'=>'add success');
                        echo json_encode($ret);
                        exit;
                    break;
                    
                    case 'update_product':
                        
                    break;
                }
                break;
        }
    }
}