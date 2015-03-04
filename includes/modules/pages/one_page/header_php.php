<?php
// if there is nothing in the customers cart, redirect them to the shopping cart page
if ($_SESSION['cart']->count_contents() <= 0) {
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
}


// Validate Cart for checkout
$_SESSION['valid_to_checkout'] = true;
$_SESSION['cart']->get_products(true);
if ($_SESSION['valid_to_checkout'] == false) {
    $messageStack->add('header', ERROR_CART_UPDATE, 'error');
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
}

// Stock Check
if ((STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true')) {
    $products = $_SESSION['cart']->get_products();
    for ($i = 0, $n = sizeof($products); $i < $n; $i ++) {
        if (zen_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
            zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
            break;
        }
    }
}
$logon = false;
if(isset($_SESSION['customer_id']) && !!$_SESSION['customer_id']){
    $logon = true;
}

if(isset($_REQUEST['action'])){
    switch ($_REQUEST['action']){
        case 'save_method':
            
            if(in_array($_GET['registerMode'], array('guest','register'))){
            
                $_SESSION['one_page']['registerMode'] = $_GET['registerMode'];
                echo $_SESSION['one_page']['registerMode'];exit;
            }
            
            break;
        case 'save_billing':
            
            
            $_SESSION['one_page']['billingAddress'] = array(
                'firstname' => $_POST['firstname'],
                'lastname'  => $_POST['lastname'],
                'company'   => $_POST['company'],
                'email'   => $_POST['email'],
                'add1'   => $_POST['add1'],
                'add2'   => $_POST['add2'],
                'city'   => $_POST['city'],
                'zone_id'   => $_POST['zone_id'],
                'postcode'   => $_POST['postcode'],
                'country_id'   => $_POST['country_id'],
                'telphone'   => $_POST['telphone'],
                'fax'   => $_POST['fax'],
            );
             
            if($_SESSION['one_page']['registerMode'] == 'register'){
                $_SESSION['one_page']['billingAddress']['password'] = $_POST['password'];
            }
            
            $progress = <<<EOF
                    
<dl><dt>Billing Address</dt>
	<dd>{$_POST['firstname']} {$_POST['lastname']}</dd>
	<dd>{$_POST['company']} </dd>
	<dd>{$_POST['add1']} </dd>
	<dd>{$_POST['add2']} </dd>
	<dd>{$_POST['city']}, {$_POST['zone_id']}, {$_POST['postcode']}</dd>
	<dd>{$_POST['country_id']}</dd>
	<dd>{$_POST['telphone']}</dd>
    <dt>Shipping Address</dt>
	<dd>{$_POST['firstname']} {$_POST['lastname']}</dd>
	<dd>{$_POST['company']} </dd>
	<dd>{$_POST['add1']} </dd>
	<dd>{$_POST['add2']} </dd>
	<dd>{$_POST['city']}, {$_POST['zone_id']}, {$_POST['postcode']}</dd>
	<dd>{$_POST['country_id']}</dd>
	<dd>{$_POST['telphone']}</dd>
    <dt>Shipping Method</dt>
    <dt>Payment Method</dt>
</dl>        
EOF;
            echo json_encode(array('progress'=>$progress));
            exit;
            
            
            break;
            
        case 'save_shipping_method':
            
            require (DIR_WS_CLASSES . 'shipping.php');
            $shipping_modules = new shipping();
            
            $quote = array();
            
         
            if ((isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_'))) {
                
                $_SESSION['shipping'] = $_POST['shipping'];
                list ($module, $method) = explode('_', $_SESSION['shipping']);
                if (is_object($$module) || ($_SESSION['shipping'] == 'free_free')) {
                    if ($_SESSION['shipping'] == 'free_free') {
                        $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
                        $quote[0]['methods'][0]['cost'] = '0';
                    } else {
                        $quote = $shipping_modules->quote($method, $module);
                    }
        
                    if (isset($quote['error'])) {
                        $_SESSION['shipping'] = '';
                    } else {
                        if ((isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost']))) {
                            $_SESSION['shipping'] = array(
                                'id' => $_SESSION['shipping'],
                                'title' => (($free_shipping == true) ? $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']
                            );
                            $progress = <<<EOF
                            
<dl><dt>Billing Address</dt>
	<dd>{$_SESSION['one_page']['billingAddress']['firstname']} {$_SESSION['one_page']['billingAddress']['lastname']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['company']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add1']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add2']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['city']}, {$_SESSION['one_page']['billingAddress']['zone_id']}, {$_SESSION['one_page']['billingAddress']['postcode']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['country_id']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['telphone']}</dd>
    <dt>Shipping Address</dt>
	<dd>{$_SESSION['one_page']['billingAddress']['firstname']} {$_SESSION['one_page']['billingAddress']['lastname']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['company']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add1']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add2']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['city']}, {$_SESSION['one_page']['billingAddress']['zone_id']}, {$_SESSION['one_page']['billingAddress']['postcode']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['country_id']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['telphone']}</dd>
    <dt>Shipping Method</dt>
	<dd>{$_SESSION['shipping']['title']}</dd>
    <dt>Payment Method</dt>
</dl>
EOF;
            echo json_encode(array('progress'=>$progress));
            exit;
                                }
                            }
                        } else {
                            $_SESSION['shipping'] = false;
                        }
                    }
            
            
            
            break;
            
        case 'save_payment':
            $_SESSION['payment'] = $_POST['payment'];
            $progress = <<<EOF
            
<dl><dt>Billing Address</dt>
	<dd>{$_SESSION['one_page']['billingAddress']['firstname']} {$_SESSION['one_page']['billingAddress']['lastname']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['company']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add1']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add2']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['city']}, {$_SESSION['one_page']['billingAddress']['zone_id']}, {$_SESSION['one_page']['billingAddress']['postcode']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['country_id']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['telphone']}</dd>
    <dt>Shipping Address</dt>
	<dd>{$_SESSION['one_page']['billingAddress']['firstname']} {$_SESSION['one_page']['billingAddress']['lastname']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['company']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add1']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['add2']} </dd>
	<dd>{$_SESSION['one_page']['billingAddress']['city']}, {$_SESSION['one_page']['billingAddress']['zone_id']}, {$_SESSION['one_page']['billingAddress']['postcode']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['country_id']}</dd>
	<dd>{$_SESSION['one_page']['billingAddress']['telphone']}</dd>
    <dt>Shipping Method</dt>
	<dd>{$_SESSION['shipping']['title']}</dd>
    <dt>Payment Method</dt>
	<dd>{$_SESSION['payment']}</dd>
</dl>
EOF;
            // load the selected payment module
            require(DIR_WS_CLASSES . 'payment.php');
            
            $payment_modules = new payment($_SESSION['payment']);
            $payment_modules->update_status();
            if (isset($$_SESSION['payment']->form_action_url)) {
                $form_action_url = $$_SESSION['payment']->form_action_url;
            } else {
                $form_action_url = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
            }
            
            
            echo json_encode(array('progress'=>$progress,'formURL'=>$form_action_url));
            exit;
            
            break;
            
        case 'confirm_order':
            
            
            
            break;
            
    }
}


require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);
