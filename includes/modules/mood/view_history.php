<?php
// @author Mobanbase.com
if(isset($_COOKIE['viewhistory']) && count(unserialize($_COOKIE['viewhistory']))){
    $show_template = true;
    $viewHistory = unserialize($_COOKIE['viewhistory']);
    $rs = $db->Execute('select p.products_id, p.products_image,pd.products_name from products p join products_description pd using(products_id) where p.products_id in ('.implode(',',$viewHistory).')');
    if($rs->RecordCount()>0){
        $contentBox = array();
        
        while(!$rs->EOF){
            $contentBox[] = array(
                'products_id' => $rs->fields['products_id'],
                'products_name'=>$rs->fields['products_name'],
                'products_image'=>$rs->fields['products_image']
            );
            $rs->MoveNext();
        }
    }
}
