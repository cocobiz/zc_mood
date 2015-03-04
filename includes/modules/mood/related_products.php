<?php
// @author Mobanbase.com

$relatedProducts = $db->Execute('select p.products_id, p.products_image, pd.products_name from products_to_categories ptc inner join products p using(products_id) inner join products_description pd using(products_id) where ptc.categories_id = '. intval($current_category_id) . ' limit 8');

if($relatedProducts->RecordCount() > 0){
    $show_template = true;
    $contentBox = array();

    while(!$relatedProducts->EOF){
        $contentBox[] = array(
            'products_id' => $relatedProducts->fields['products_id'],
            'products_name' => $relatedProducts->fields['products_name'],
            'products_image' => $relatedProducts->fields['products_image']
        );
        
        $relatedProducts->MoveNext();
    }
}