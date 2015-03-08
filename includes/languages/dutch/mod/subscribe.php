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
// $Id: subscribe.php,v 1.1 2006/06/16 01:46:14 Owner Exp $
//

define('NAVBAR_TITLE', 'Aanmelden');
define('HEADING_TITLE', 'Aanmelden');

define('TEXT_INFORMATION', '');
// you don't need to fill in TEXT_INFORMATION if you wish to edit the subscribe text from the Admin area
// If filled in, this text is shown below the defined page text
// Note: This uses the same defined_page for both subscriptions and confirmation

define('TEXT_INFORMATION_CONFIRM', '
  Voordat u begint met het ontvangen van uw abonnement op onze nieuwsbrief, MOET u antwoorden op onze bevestigings aanvraag verstuurd naar uw e-mail<strong>%s</strong>.
  <br />
  <br />
  Controleer uw e-mail inbox. Wanneer u het verzoek om bevestiging ontvangt, klikt u op de bevestigingslink ingesloten in de e-mail.
  <br />
  <br />
  Als u problemen heeft met aanmelden, stuur dan een bericht naar <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .'</a>.
  ');

// greeting salutation
define('EMAIL_SUBJECT', 'Gelieve nieuwsbrief aanmelding van ' . STORE_NAME . ' te bevestigen');

// First line of the greeting
define('EMAIL_WELCOME', '' . "\n" . '<p />Wij willen u verwelkomen bij ' . STORE_NAME . '.<p />');
define('EMAIL_SEPARATOR', '--------------------');

define('EMAIL_TEXT', 'Deze e-mail is geregistreerd voor een nieuwsbrief abonnement op onze site.<br />' . "\n" . 'Voordat u kunt beginnen met het ontvangen van de nieuwsbrief, moet u dit bevestigen uw e-mailadres.<p />' . "\n\n" . 'Als u zich niet heeft aangemeld, is er geen actie nodig.<p />' . "\n\n" . '');

define('EMAIL_CONFIRMATION_TEXT','Klik op de link hieronder om uw inschrijving te bevestigen:<br />' . "\n\n" . '%s  '. "\n\n" );

define('EMAIL_CONTACT', '<br />Voor hulp bij een van onze online services, stuur een email naar de winkel-eigenaar: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a><br />\n\n");
define('EMAIL_CLOSURE','Sincerely,' . "\n\n" . STORE_OWNER . "\nStore Owner\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Dit e-mailadres is ons gegeven door u of door een van onze klanten. Als u zich niet heeft aangemelden voor een account, of het gevoel dat u deze e-mail ten onrechte heeft ontvangen, is er geen actie nodig is. Geen nieuwsbrieven worden verzonden zonder bevestiging, en U ontvangt geen andere. U bent altijd welkom om ons te contacteren met eventuele problemen die u hebt.');

?>
