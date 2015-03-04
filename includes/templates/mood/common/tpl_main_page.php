<?php
/**
 *  布局模板页面
 *  此处对全局布局模板进行了高度定制，去除了column_left & column_right, 去除了zc原有才有table布局的方式，只保留了必要的精简后的布局模块
 *  因为zc是开源程序，所以会考虑不同人群的使用方式，但一些额外的逻辑判断和业务处理在我们明确业务逻辑和运行环境的情况下完全可以屏蔽掉，以提高系统运行性能
 */
?>
<body>
<?php
if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
        ?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
}
?>
<?php
if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_header = true;
}
require(DIR_WS_TEMPLATE . 'common/tpl_header.php');
?>
<?php require ($body_code);?>
<?php
if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_footer = true;
}
require DIR_WS_TEMPLATE . 'common/tpl_footer.php';
?>
</body>