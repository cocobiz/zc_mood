<?php
/**
 * Model 
 * @author Mobanbase.com
 */

if(isset($_GET['products_id']) && isset($products_model))
{
    list($model, $num) = explode('-',$products_model);
    
    if($model)
    {
        $sql = 'select p.products_id, p.products_image, pd.products_name from products p join products_description pd using(products_id) 
                where p.products_model like "%' . $model.'-%"';
        
        
        $list = $db->Execute($sql);
        
        $contentBox = array();
        if($list->RecordCount())
        {
            $show_template = true;
            
            while(!$list->EOF)
            {
                if($list->fields['products_id'] == $_GET['products_id']){
                    $list->MoveNext();
                    continue;
                }
    
                $contentBox[] = $list->fields;
                $list->MoveNext();
            }
        }
    }
    
}