<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: newsletter_subscribe.php, v1 2006/05/16, dmcl1/notgoddess
//  

  define('BOX_HEADING_SUBSCRIBE', 'Nieuwsbrief'); // sidebox title
  
  define('BUTTON_IMAGE_SUBSCRIBE', 'button_subscribe.gif');
  define('BUTTON_SUBSCRIBE_ALT', 'Inschrijven');
  define('BOX_SUBSCRIBE_DEFAULT_TEXT', 'Vul uw e-mailadres in om te abonneren op onze nieuwsbrief.');
  
// header Subscribe Button/Box Subscribe Button
  define('HEADER_SUBSCRIBE_LABEL', 'Nieuwsbrief:'); // header text before input field
  define('HEADER_SUBSCRIBE_BUTTON','Inschrijven'); // button text for css buttons
  define('HEADER_SUBSCRIBE_DEFAULT_TEXT', 'Vul uw e-mailadres in'); // in input field

  define('TEXT_SUBSCRIBER_DEFAULT_NAME', 'Nieuwsbrief abonnee');

  define('TEXT_NEWSONLY_SUBSCRIPTIONS_DISABLED','Op dit moment worden nieuwsbrief-only abonnementen niet geaccepteerd. Onze excuses. Wij heten u van harte welkom om een account aan te maken.');

define('SUBSCRIBE_DUPLICATE_CUSTOMERS_ERROR', 'Er is al een klant-account met dat e-mailadres. Om u te abonneren op de nieuwsbrief, <a href="index.php?main_page=login">LOGIN</a> en selecteer de Mijn Account link.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ERROR', 'Dit e-mailadres is al geplaatst in een nieuwsbrief-Only abonnement.  Als u het verzoek om bevestiging niet hebt ontvangen, e-mail: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a> van het adres en vraag het abonnement aan.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ACCT', 'Een nieuwsbrief-Only abonnement is geregistreerd bij dit e-mailadres. Als u op dit moment onze nieuwsbrief ontvangt, maar geen account heeft.');
define('SUBSCRIBE_MERGED_NEWSONLY_ACCT', 'Een nieuwsbrief-Only abonnement is geregistreerd bij dit e-mailadres. Uw abonnement is toegevoegd aan uw nieuwe klantaccount. U kunt uw abonnement nu beheren vanaf uw accountpagina.');
define('SUBSCRIBE_NEWSLETTER_ONLY', 'Nieuwsbrief-Only Abonnee:');
define('SUBSCRIBE_NEWSLETTER_ONLY2', '(Controleer of u op dit moment onze nieuwsbrief ontvangt, maar geen account heeft.)');
define('SUBSCRIBE_DUPLICATE_OTHER_ACCT', 'Dit e-mailadres wordt al gebruikt door een andere klant Account.');
define('SUBSCRIBE_DUPLICATE_CONFIRM_ERROR', 'Dit e-mailadres is al geplaatst in een nieuwsbrief-Only abonnement.');
define('SUBSCRIBE_NONEXISTANT_EMAIL_ERROR','Dit e-mailadres is niet geregistreerd.');
define('SUBSCRIBE_MULTIPLE_EMAIL_ERROR','Neem contact op met <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a> met betrekking tot uw abonnement.');

?>
