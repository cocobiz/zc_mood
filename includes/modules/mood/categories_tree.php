<?php
/**
 * 分类导航数据
 * @author Mobanbase.com
 */
$sql = 'select c.categories_id, c.parent_id, cd.categories_name from categories c inner join categories_description cd using (categories_id)';
$categoriesResult = $db->Execute($sql);
$categoriesList   = array();
while(!$categoriesResult->EOF){
    $categoriesList[] = $categoriesResult->fields;
    $categoriesResult->MoveNext();
}

$categoriesList = \misc_func\get_tree_from_list($categoriesList,'categories_id','parent_id');
