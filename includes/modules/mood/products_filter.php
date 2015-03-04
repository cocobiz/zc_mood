<?php
/**
 * @author Mobanbase.com
 */
if(!isset($listing_sql) || empty($listing_sql)){
    $show_filter = false;
}else{
    $show_filter = true;
    
    $listing = $db->Execute($listing_sql);
    
    $contents = $types = $colors = $prices = array();
    // Generate attribute filter by current $listing_sql
    while(!$listing->EOF)
    {
        if(\misc_func\hasAttribute($listing->fields['products_id'], CONTENT_OPTION_ID)){
            list($contentId, $contentName) = \misc_func\getAttributeValue($listing->fields['products_id'], CONTENT_OPTION_ID);
            if(array_key_exists($contentName, $contents)){
                $contents[$contentName]['num'] += 1;
            }else{
                $contents[$contentName]['id']  = $contentId;
                $contents[$contentName]['num'] = 1;
            }
        }
        if(\misc_func\hasAttribute($listing->fields['products_id'], COLOR_OPTION_ID)){
            list($colorId, $colorName) = \misc_func\getAttributeValue($listing->fields['products_id'], COLOR_OPTION_ID);
            if(array_key_exists($colorName, $colors)){
                $colors[$colorName]['num'] += 1;
            }else{
                $colors[$colorName]['id']  = $colorId;
                $colors[$colorName]['num'] = 1;
            }
        }
        if(\misc_func\hasAttribute($listing->fields['products_id'], TYPE_OPTION_ID)){
            list($typeId, $typeName) = \misc_func\getAttributeValue($listing->fields['products_id'], TYPE_OPTION_ID);
            if(array_key_exists($typeName, $types)){
                $types[$typeName]['num'] += 1;
            }else{
                $types[$typeName]['id']  = $typeId;
                $types[$typeName]['num'] = 1;
            }
        }
        
        $basePrice = zen_get_products_base_price($listing->fields['products_id']);
        $salePrice = zen_get_products_special_price($listing->fields['products_id'],false);
        $price = is_bool($salePrice) ? $basePrice : $salePrice;
        $prices[] = number_format($price, 2, '.', '');
        
        unset($price);
        
        $listing->MoveNext();
    }
    
    
    // If We get the last $_GET variables, then reset this variables' attributes
    $tempArr = array('content'=>CONTENT_OPTION_ID, 'type'=>TYPE_OPTION_ID, 'color'=>COLOR_OPTION_ID);
    $i = count($_GET);
    $__GET = array_reverse($_GET);
    foreach ($__GET as $key => $val){
        if(array_key_exists($key, $tempArr)){
            $last = $key;break;
        }
    }
    unset($__GET);
    
    if(isset($last)){
        $tempVal = array();
        $aProductsIds = explode(',',$productsIds);
        foreach($aProductsIds as $pid){
            if(\misc_func\hasAttribute($pid, $tempArr[$last])){
                list($id, $name) = \misc_func\getAttributeValue($pid, $tempArr[$last]);
                if(array_key_exists($name, $tempVal)){
                    $tempVal[$name]['num'] += 1;
                }else{
                    $tempVal[$name]['id']  = $id;
                    $tempVal[$name]['num'] = 1;
                }
            }
        }
        if($last == 'content') $contents = $tempVal;
        if($last == 'type')    $types = $tempVal;
        if($last == 'color')   $colors = $tempVal;
        unset($tempVal,$last);
    }
    unset($tempArr);
    
    // unique $prices
    
    $prices = array_unique($prices);
    sort($prices);
    
}
