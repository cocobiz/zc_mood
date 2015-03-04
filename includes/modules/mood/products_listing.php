<?php
if(!isset($listing_sql)) $show_list = false;
$numPerRow = (isset($_GET['limit']) && ctype_digit($_GET['limit'])) ? $_GET['limit'] : MAX_DISPLAY_PRODUCTS_LISTING;
$listing_split = new splitPageResults($listing_sql, $numPerRow, 'p.products_id', 'page');

if($listing_split->number_of_rows > 0){
    $show_list = true;
    $list_content  = array();
    $listing = $db->Execute($listing_split->sql_query);
    while(!$listing->EOF){
        $list_content[] = array(
            'id'   => $listing->fields['products_id'],
            'img'  => $listing->fields['products_image'],
            'name' => $listing->fields['products_name'],
            'mcid' => $listing->fields['master_categories_id'],
            'model'=> $listing->fields['products_model'],
            'baseprice'   => zen_get_products_base_price($listing->field['products_id']),
            'specialprice'=> zen_get_products_special_price($listing->field['products_id'], true),
            'saleprice'   => zen_get_products_special_price($listing->field['products_id'], false),
        );        
        $listing->MoveNext();
    }
}