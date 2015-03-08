<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Originally Programmed By: Christopher Bradley (www.wizardsandwars.com) for OsCommerce
 * @copyright Modified by Jim Keebaugh for OsCommerce
 * @copyright Adapted for Zen Cart
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: unsubscribe.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('NAVBAR_TITLE', 'Unsubscribe');
define('HEADING_TITLE', 'Unsubscribe from our Newsletter');

define('UNSUBSCRIBE_TEXT_INFORMATION', '<br />We vinden het jammer dat u zich wilt afmelden voor onze nieuwsbrief. Als u zich zorgen maakt over uw privacy, zie onze <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">privacy verklaring</span></a>.<br /><br />Abonnees op onze nieuwsbrief blijven op de hoogte van nieuwe producten, kortingen, en site nieuws.<br /><br />Als u nog steeds niet wenst om onze nieuwsbrief te ontvangen, klik dan op de onderstaande knop.');
define('UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN', '<br />We vinden het jammer dat u zich wilt afmelden voor onze nieuwsbrief. Als u zich zorgen maakt over uw privacy, zie onze <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">privacy verklaring</span></a>.<br /><br />Abonnees op onze nieuwsbrief blijven op de hoogte van nieuwe producten, kortingen, en site nieuws.<br /><br />Als u nog steeds niet wenst om onze nieuwsbrief te ontvangen, klik dan op de onderstaande knop. U wordt naar uw account-voorkeuren pagina gebracht, waar u uw abonnement kunt bewerken. Mogelijk wordt u gevraagd om eerst in te loggen.');
define('UNSUBSCRIBE_DONE_TEXT_INFORMATION', '<br />Uw e-mailadres, hieronder vermeld, is volgens uw verzoek verwijderd uit onze Nieuwsbrief ledenlijst. <br /><br />');
define('UNSUBSCRIBE_ERROR_INFORMATION', '<br />Het e-mailadres dat u hebt opgegeven is niet gevonden in onze nieuwsbrief database, of is al verwijderd uit onze nieuwsbrief abonnementen lijst. <br /><br />');
// BEGIN newsletter_subscribe mod 1/1
//email unsubscribes
define('UNSUBSCRIBE_EMAIL_SUBJECT', 'Abonnement op de nieuwsbrief stopgezet');
define('UNSUBSCRIBE_EMAIL_WELCOME', '' . "\n" . '<p />Nieuwsbrief uitschrijving bevestiging van ' . STORE_NAME . '.<p />');
define('UNSUBSCRIBE_EMAIL_SEPARATOR', '--------------------');
define('UNSUBSCRIBE_EMAIL_TEXT', 'Uw e-mailadres is nu afgemeld voor onze nieuwsbrief.<br />' . "\n" . '<p />' . "\n\n" . 'Als u ooit besluit dat u onze nieuwsbrief opnieuw wenst te ontvangen, kunt u terecht op onze website en opnieuw inschrijven met uw e-mail adres.<p />' . "\n\n" . '');
define('UNSUBSCRIBE_EMAIL_CONTACT', '<br />Als u vragen heeft stuur ons dan een e-mail: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a><br />\n\n");
define('UNSUBSCRIBE_EMAIL_CLOSURE','Hoogachtend,' . "\n\n" . STORE_OWNER . "\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");
// send to admins when newsletter in unsubscribed
define('UNSUBSCRIBE_ADMIN_EMAIL_SUBJECT', 'Abonnement op de nieuwsbrief stopgezet');
define('UNSUBSCRIBE_ADMIN_EMAIL_TEXT', 'Nieuwsbrief uitgeschreven voor e-mail adres: %s on %s');

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('UNSUBSCRIBE_EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Dit e-mail adres is uitgeschreven van onze website. Als dit onjuist is, neem dan contact met ons op zodat we kunnen onderzoeken wat kan dit hebben veroorzaakt. U kunt opnieuw inschrijven in onze webshop in de tussentijd, dank u.');
// END newsletter_subscribe mod 1/1

?>
