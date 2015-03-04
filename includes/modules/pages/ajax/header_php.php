<?php
/**
 * This Page is a AJAX API
 * 
 * @author Mobanbase.com
 */


if(isset($_GET['action']))
{
    
    switch ($_GET['action'])
    {
        case 'get_zone':
            
            if(isset($_GET['country_id']))
            {
                $zoneList = \misc_func\get_zone_by_country_id(intval($_GET['country_id']));
                if($zoneList){
                    echo json_encode($zoneList);
                    exit;
                }else{
                    echo '0';
                    exit;
                }
            }else{
                die('');
            }
            
        break;
        
        case 'subscrib':
            
            $email = $_GET['email'];
            
            //todo: add the email to customer table
            
            break;
            
        case 'ezpage':
            
            if(isset($_GET['id'])){
                
                $_GET['id'] = intval($_GET['id']);
                $rs = \misc_func\get_ezpage_content($_GET['id']);
                $data = array('error'=>0, 'data'=>$rs);
                
                echo json_encode($data);
                exit;
            }
            break;
            
            
        case 'add_review':
            
            if(isset($_POST['nickName'],$_POST['title'],$_POST['detail'],$_POST['rating'],$_POST['products_id'])){
               $sql = 'insert into reviews values(
                   null, '.intval($_POST['products_id']).', 0, "'.
                   mysql_real_escape_string($_POST['nickName']).'", '.intval($_POST['rating']).', now(), now(), 0, 0, '.$_POST['type'].')';
               
               $rs = $db->Execute($sql);
               if($rs)
               {
                   $insertID =  $db->insert_ID();
                   $sql = 'insert into reviews_description values('.$insertID.', 1, "'.mysql_real_escape_string(strip_tags($_POST['title'])).'", "'.mysql_real_escape_string(strip_tags($_POST['detail'])).'")';
                   $rs = $db->Execute($sql);
                   if($rs){
                       echo 'Your review has been accepted for moderation.';exit;
                   }                        
               }
               
            }
            break;
            
            
        default:
            die('Illegal Access!');
    }
}