<?php
/**
 * Index Featured Box
 * @author Mobanbase.com
 */
$sql = 'select p.products_id, p.products_image, pd.products_name from featured f join products p using(products_id) join products_description pd using (products_id) 
        where f.status = 1
        and (f.expires_date = "0001-01-01" or f.expires_date > now())
        order by f.featured_id DESC
        limit 20';

$list = $db->Execute($sql);

if($list->RecordCount()){
    $contentBox = array();
    while(!$list->EOF){
        $contentBox[] = $list->fields;
        $list->MoveNext();
    }
}
unset($sql);
unset($list);