<?php
/**
 * Common Template
 *
 * outputs the html header. i,e, everything that comes before the \</head\> tag <br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: DrByte  Tue Jul 17 16:02:00 2012 -0400 Modified in v1.5.1 $
 */
/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
/**
 * output main page HEAD tag and related headers/meta-tags, etc
 */
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance' || $robotsNoIndex === true) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php if (defined('FAVICON')) { ?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<?php } //endif FAVICON ?>

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />
<?php if (isset($canonicalLink) && $canonicalLink != '') { ?>
<link rel="canonical" href="<?php echo $canonicalLink; ?>" />
<?php } ?>
<?php 
/**
 * 为了提高访问性能，这里去掉了zc自带的加载css和js的规则(IO开销很大),js文件移到页面底部.
 * 只加载两个css文件
 *  1. ../css/common.css  包含reset和一个公共样式库
 *  2. ../css/pc_all.css  包含全站css,每一个页面根据$current_page_base为命名空间进行书写
 */
if(!file_exists(DIR_WS_TEMPLATE . 'css/common.css')) die('common.css 文件不存在');
if(!file_exists(DIR_WS_TEMPLATE . 'css/pc_all.css')) die('pc_all.css 文件不存在');

echo '<link rel="stylesheet" type="text/css" href="'.DIR_WS_TEMPLATE.'css/common.css" />'."\n";
echo '<link rel="stylesheet" type="text/css" href="'.DIR_WS_TEMPLATE.'css/pc_all.css" />'."\n";
echo '<script src="'.DIR_WS_TEMPLATE.'jscript/jquery-1.8.3.min.js"></script>'."\n";
echo '<script src="'.DIR_WS_TEMPLATE.'jscript/lib.js"></script>'."\n";
?>
</head>
