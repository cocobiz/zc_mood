<?php
/**
 * @author Mobanbase.com
 * 
 */
namespace misc_func;

/**
 * 判断一个分类是否是促销分类
 * @param unknown $categories_id
 */
function isSaleCategory($categories_id){
    global $db;
    $rs = $db->Execute('select count(*) as count from ' . TABLE_SALEMAKER_SALES .' where sale_categories_all like "%,'.$categories_id.',%"');
    return $rs->fields['count'] > 0 ? true : false;
}

  
function zen_get_price($products_id){
    global $db, $currencies;
    
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call, products_type from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");
    
    $basePrice    = $currencies->display_price(zen_get_products_base_price($products_id), zen_get_tax_rate($product_check->fields['products_tax_class_id']));
    $salePrice    = $currencies->display_price(zen_get_products_special_price($products_id, false), zen_get_tax_rate($product_check->fields['products_tax_class_id']));
    $finalPrice   = '<span class="normal-price no-through">'.$basePrice.'</span>';
    if($salePrice != $basePrice && intval(substr($salePrice,1)) != 0){
        $finalPrice = '<span class="normal-price through">'.$basePrice.'</span><span class="sale-price">'.$salePrice.'</span>';
    }
    return $finalPrice;
}

function hasAttribute($products_id, $optID){
    global $db;
    $products_id = intval($products_id);
    $optID       = intval($optID);
    $rs = $db->Execute('select count(*) as count from ' . TABLE_PRODUCTS_ATTRIBUTES . ' where products_id = '. $products_id .' and options_id = '.$optID);
    return $rs->fields['count'] > 0 ? true : false;
}

function getAttributeValue($products_id, $optID){
    global $db;
    $rs = $db->Execute('select pov.products_options_values_name, pa.options_values_id from '.TABLE_PRODUCTS_ATTRIBUTES .' pa inner join ' . TABLE_PRODUCTS_OPTIONS_VALUES .' pov on pa.options_values_id = pov.products_options_values_id '.
                        ' where pa.products_id = '.intval($products_id) . ' and pa.options_id ='.intval($optID));
    if($rs->RecordCount() > 0){
        return array($rs->fields['options_values_id'], $rs->fields['products_options_values_name']);
    }
    return false;
}
function get_tree_from_list($list, $pk='id', $pid='pid', $child='_child', $root=0){
    if(is_array($list)){
        $refer = array();
        foreach($list as $key => $value){
            $refer[$value[$pk]] = &$list[$key];
        }
        foreach($refer as $key => $value){
            $refer[$value[$pid]][$child][$key] = &$refer[$key];
        }
        return isset($refer[$root][$child]) ? $refer[$root][$child] : array();
    }else{
        return array();
    }
}

function getAttributeName($id){
    if(!ctype_digit($id)) return false;
    global $db;
    $rs = $db->Execute('select products_options_values_name as name from products_options_values where products_options_values_id = '.intval($id));
    if($rs->RecordCount()>0){
        return $rs->fields['name'];
    }
    return false;
}
// generate images API
function generate_images($src,$width,$height){
    // $imageMarker = new ImageMarker();
    return DIR_WS_IMAGES.$src;
}

function get_products_field_value($products_id, $field){
    if(!is_numeric($products_id) || empty($field)) return false;
    
    global $db;
    $rs = $db->Execute('select '. $field . ' from ' . TABLE_PRODUCTS .' where products_id = ' . intval($products_id));
    if($rs->RecordCount() > 0){
        return $rs->fields[$field];
    }
    return false;
}

function get_zone_by_country_id($country_id){
    global $db;
    
    $list = $db->Execute('select zone_id, zone_name from zones where zone_country_id = '.intval($country_id));
    
    if($list->RecordCount()){
        $ret = array();
        while(!$list->EOF){
            $ret[] = $list->fields;
            $list->MoveNext();
        }
        return $ret;
    }
    return false;
}

function get_ezpage_content($id){
    if(!is_numeric($id) || empty($id)) return false;
    
    global $db;
    $rs = $db->Execute('select pages_html_text as content from ezpages where pages_id = '.intval($id));
    return $rs->fields['content'];
}