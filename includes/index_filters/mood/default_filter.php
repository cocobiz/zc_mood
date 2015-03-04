<?php
/**
 * @author Mobanbase.com
 * 
 * 此处的产品filter只对以下参数过滤
 * $_GET['datetime']        => (a|d)产品时间排序
 * $_GET['best_seller']     => (a|d)热销
 * $_GET['sale']            => 1 促销
 * $_GET['color']           => (颜色值)
 * $_GET['price']           => (a-b)价格区间        因为这里涉及到特价产品以及打折产品，所以这块单独处理
 * $_GET['type']            => 产品类型
 * $_GET['cid']             => 分类ID
 *
 */
if (! defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
// These constant's value is fixed by the data from database
define('COLOR_OPTION_ID',  1);
define('CONTENT_OPTION_ID', 2);
define('TYPE_OPTION_ID',    3);

if(! isset($categories_products_id_list)) $categories_products_id_list = array();
$productsInCategory = zen_get_categories_products_list( $cPath, false, true, 0, '');
// Generate $listing_sql by conditions
if(count($productsInCategory)){
    $productsIds = '';
    foreach ($productsInCategory as $k => $v){
        $productsIds .= $k . ', ';
    }
    $productsIds = substr($productsIds, 0, -2);
    
    $select = 'select  distinct p.products_id, p.products_model, p.products_image, pd.products_name,p.products_date_added, p.products_price, p.master_categories_id';
    
    $from   = ' from ' . TABLE_PRODUCTS . ' p inner join ' . TABLE_PRODUCTS_DESCRIPTION . ' pd on p.products_id = pd.products_id ';
    
    $where  = ' where  pd.language_id = ' . (int)$_SESSION['languages_id'] . ' and p.products_status = 1 and p.products_id in (' . $productsIds . ') ';
    
    $order  = ' order by p.products_id ASC';
    
    if(isset($_GET['color']) || isset($_GET['content']) || isset($_GET['type'])){
        $from  .= ' inner join ' . TABLE_PRODUCTS_ATTRIBUTES . ' pa on pa.products_id = p.products_id';
        $attArr = array();
        if(isset($_GET['color'])){
            $attArr['color']  = array_map("intval",explode('_', $_GET['color']));
            $_where = ' (pa.options_id = ' .COLOR_OPTION_ID . ' and pa.options_values_id in('.implode(',', $attArr['color']).'))';
        }
        if(isset($_GET['content'])){
            $attArr['content']  = array_map("intval",explode('_', $_GET['content']));
            $_where = isset($_where)?$_where . ' or ' : '';
            $_where .= ' (pa.options_id = ' .CONTENT_OPTION_ID . ' and pa.options_values_id in('.implode(',', $attArr['content']).'))';
        }
        if(isset($_GET['type'])){
            $attArr['type']  = array_map("intval",explode('_', $_GET['type']));
            $_where = isset($_where)?$_where . ' or ' : '';
            $_where .= ' (pa.options_id = ' .TYPE_OPTION_ID . ' and pa.options_values_id in('.implode(',', $attArr['type']).'))';
        }
        $where .= ' and ('.$_where.')';
        unset($_where);
    }
    
    // sale and price condition is exclusive
    if(isset($_GET['sale']) && $_GET['sale'] == '1'){
        if(!\misc_func\isSaleCategory($current_category_id)){
            $from  .= ' inner join ' . TABLE_SPECIALS . ' s on s.products_id = p.products_id';
            $where .= ' and (s.expires_date >= now() or s.expires_date = "0001-01-01") and (s.specials_date_available >= now() or s.specials_date_available = "0001-01-01")';
        }
    }else if(isset($_GET['price'])){
        list($priceFrom, $priceTo) = explode('-', $_GET['price']);
        $priceFrom = floatval($priceFrom);
        $priceTo   = floatval($priceTo);
        $from .= ' left join '. TABLE_SPECIALS .' s on s.products_id = p.products_id';
        if($priceTo == ''){
            $where .= ' and ((p.products_price >= '.$priceFrom.') or (s.specials_new_products_price >= '.$priceFrom.'))';                    
        }else{
            $where .= ' and ((p.products_price >= '.$priceFrom.' and p.products_price <= '.$priceTo.') or (s.specials_new_products_price >= '.$priceFrom.' and s.specials_new_products_price <= '.$priceTo.'))';
        }
    }
    
    if(isset($_GET['best_seller']) && $_GET['best_seller'] == '1'){
        $where .= ' and p.products_ordered > 0';
        $order = ' order by p.products_ordered DESC';
    }
    if(isset($_GET['datetime'])){
        $order = ' order by p.products_id ' . ($_GET['datetime'] == 'd' ? 'DESC' : 'ASC');
    }
    $listing_sql = $select . $from . $where . $order;
}else{
    zen_redirect('404.html');
}
//echo $listing_sql;exit;

