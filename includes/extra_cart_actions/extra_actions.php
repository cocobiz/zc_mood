<?php
/**
 * Extra Cart Actions: [get_cart] etc.
 * @author Mobanbase.com
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

switch ($_GET['action']){
    case 'get_cart':
        if(isset($_GET['in_ajax'])){
            $productsNum = $_SESSION['cart']->count_contents();
            $list        = $_SESSION['cart']->get_products();
            $total       = $_SESSION['cart']->show_total();
            
            $list = array_slice(array_reverse($list), 0, 3);
            
            array_walk($list, function(&$item) use ($currencies){
                $item['image'] = '<img src="'.\misc_func\generate_images($item['image'], 60, 60).'" width="60" height="60">';
                $item['final_price'] = $currencies->display_price($item['final_price'], 0);
            });
            echo json_encode(array('result'=>'success','list'=>$list,'total'=>$currencies->display_price($total,0), 'productsNum'=>$productsNum));
            exit;
        }
    break;
    
    default:;
}