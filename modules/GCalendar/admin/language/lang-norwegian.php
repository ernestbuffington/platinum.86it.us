<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// admin language/lang-english.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
//
// Admin language file; Norwegian. Translation by Paal Fondevik
//
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'GCalendar Admin Panel');
define('_ADMIN_DENIED',       'Du har ikke tillatelse til å administrere denne modulen.');
define('_ADMIN_APPROVE',      'Godkjenne uavgjorte begivenheter');
define('_ADMIN_ADD_EVENT',    'Legg til begivenhet');
define('_ADMIN_EDIT_CONFIG',  'Opsjoner');
define('_ADMIN_EDIT_CAT',     'Kategorier');
define('_ADMIN_EDIT_EVENTS',  'Editer begivenheter');

define('_CONF_YES',  'Ja');
define('_CONF_NO',   'Nei');
define('_NONE_SELECTED',      'Ingen begivenhet er valgt for sletting');
define('_CONFIRM_DELETE',     'Vil du virkelig slette den valgte begivenheten?');
define('_EVENTS_DEL_ERR',     'Feil under sletting av begivenheten(e)!');

define('_NO_PENDING_EVENTS',  'Ingen begivenheter trenger godkjenning nå.');
define('_NO_EVENTS',          'Ingen godkjente begivenheter nå.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Start Dato');
define('_EVENT_TITLE',        'Tittel');
define('_EVENT_SUBMITTER',    'Lagt inn av');
define('_EVENT_ACTIONS',      'Aksjoner');
define('_EVENT_SELECT',       'Velg');

define('_VIEW_TITLE',         'Vis begivenhet');
define('_EDIT_TITLE',         'Editer/Godkjenn begivenhet');
define('_DEL_SELECTED',       'Slett valgt begivenhet(er)');
define('_SELECT_ALL',         'Velg alle');
define('_SELECT_NONE',        'Velg ingen');
define('_SORT_BY_TITLE',      'Klikk for å sortere på denne kolonnen');

define('_ADMIN_FORM_EDIT_TITLE', 'Editer begivenhet: ');
define('_ADMIN_FORM_ADD_TITLE',  'Legg til begivenhet: ');

define('_ADMIN_SUBMIT_LABEL', 'Oppdater begivenhet');
define('_ADMIN_ADD_LABEL',    'Legg til begivenhet');

define('_ADMIN_VIEW_EVENT',   'Vis begivenhet #');
define('_ADMIN_EDIT_EVENT',   'Editer begivenhet #');
define('_ADMIN_UPDATE_EVENT', 'Oppdater begivenhet #');
define('_ADMIN_CONFIRM_DEL',  'Vil du virkelig slette begivenhet #%d?');
define('_ADMIN_DELETE_OK',    'Vellykket sletting av begivenhet #');
define('_ADMIN_DELETE_ERR',   'Feil under sletting av begivenhet #');
define('_ADMIN_UPDATE_ERR',   'Feil under oppdatering av begivenhet #');
define('_ADMIN_ADD_OK',       'Vellykket lagt til begivenhet');
define('_ADMIN_ADD_ERR',      'Feil under innlegging av begivenheten');

define('_CURRENT_CATS',       'Nåværende kategori liste:');
define('_MODIFY_BUTTON',      'Endre valgt kategori:');
define('_DELETE_BUTTON',      'Slett valgt kategori');
define('_ADD_BUTTON',         'Legg til kategori:');
define('_CONFIRM_DELETE_CAT', 'Vil du virkelig slette kategorien?');
define('_NO_ADD_TEXT',        'Spesifiser navn på kategori');

define('_ADMIN_PURGE_RESULTS',   'Slett utgåtte begivenhet resultater');
define('_PURGE_BUTTON_TEXT',  'Slett utgåtte begivenheter');
define('_PURGE_CONFIRM_HELP',
   'Vil du virkelig slette utgåtte begivenheter? Dette vil slette alle godkjente ikke repeterte begivenheter med startdatoer' .
   ' i fortid og alle godkjente repeterte begivenheter med slutt datoer i fortid.');
define('_ADMIN_DB_OK',     'Suksess');
define('_ADMIN_DB_ERR',    'Database Feil!');

define('_ADMIN_CONFIG_FORM_TITLE',  'Editer konfigurasjon opsjoner: ');
define('_ADMIN_CONFIG_TITLE',       'Tittel:');
define('_ADMIN_CONFIG_IMAGE',       'Bilde:');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Valgfritt; sti til bilde brukt av kalender visning');
define('_ADMIN_CONFIG_MIN_YEAR',    'Min. År:');
define('_ADMIN_CONFIG_MAX_YEAR',    'Max. År:');
define('_ADMIN_CONFIG_UPDATE',      'Lagre Opsjoner');
define('_ADMIN_CONFIG_YEAR_TIP',    'Lagre rekke: typisk 1902-2037 for Unix servere; 1970-2037 for Windows servere');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Lagt inn av brukere:');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Kontrollere hvem som kan legge inn begivenheter');
define('_ADMIN_CONFIG_REQ_APP',     'begivenheter trenger godkjenning:');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Kort dato format:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Vanlig dato format:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Langt dato format:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Se i manualen)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Første dag i uken:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Tids format:');
define('_ADMIN_CONFIG_TAGS',        'Tillatte HTML tagger:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Legg inn komma separerte liste over HTML tagger');
define('_ADMIN_CONFIG_ATTRS',       'Tillatte HTML Tag atributter:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Legg inn komma separerte liste over HTML tagger atributter');
define('_ADMIN_CONFIG_AUTO_LINK',   'Tillat Auto-Links:');
define('_ADMIN_CONFIG_LOC_REQ',     'Begivenhet lokasjon-felt nødvendig:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Begivenhet detaljer-felt nødvendig:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Send epost informasjon på nye begivenheter:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Send epost til disse adressene:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Legg inn en komma separert liste over epost adressene');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Epost fra adresse:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Epost emne:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Epost melding:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Vis kategori forklaring:');

define('_SUBMIT_OFF',      'Ingen');
define('_SUBMIT_MEMBERS',  'Bare medlemmer');
define('_SUBMIT_ANYONE',   'Alle');

define('_ADMIN_EDIT_EVENT_LINK', 'Editer denne begivenheten');

define('_CATEGORY_ID', 'Kategori ID:');

define('_ADMIN_CONFIG_WYSIWYG', 'Bruk RavenNuke Editor:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Brukere kan oppdatere sine begivenheter:');

define('_ADMIN_GOTO_MODULE', 'Gå til GCalendar Modulen');
define('_RSVP_OFF',        'Av');
define('_RSVP_ON',         'På');
define('_RSVP_ON_EMAIL',   'På med epost varsel');
define('_ADMIN_CONFIG_RSVP',  'RSVP:');
define('_ADMIN_CONFIG_RSVP_SUBJECT', 'RSVP Epost Emne:');
define('_GCAL_RSVP_ADMIN_TITLE', 'Editer RSVP');
define('_GCAL_ADMIN_EDIT_RSVP', 'Editer RSVP informasjon for begivenhet#');
define('_GCAL_DEL_RSVP', 'Slett valgte brukere fra RSVP listen');
define('_GCAL_EMPTY_RSVP_LIST', 'Ingen på RSVP listen');
define('_GCAL_DEL_RSVP_CONFIRM', 'Er du sikker på at du vil slette brukerne fra RSVP listen?');
define('_GCAL_ADMIN_ABOUT', 'Om');
define('_GCAL_ADMIN_ABOUT_TEXT', 'GCalendar er Copyright &copy; 2007 av Brian Neal');
define('_GCAL_ADMIN_ABOUT_TEXT2', 'GCalendar er fri programvare frigitt under GNU GPL regler. Se filen COPYING ' .
   'i GCalender distribusjons arkiv.');
define('_GCAL_ADMIN_ABOUT_TEXT3',
   'Vær snill å lese den inkluderte manualen for instruksjoner, en full liste med credits, og lisens informasjon.<br />' .
   'For support, gå inn på <a href="http://sourceforge.net/projects/gcalendar-nuke/">GCalendar for PHP-Nuke' .
   ' Support Website</a>.');
define('_GCAL_ADMIN_ABOUT_TEXT4', 'Hvis du finner GCalender nyttig, vær snill å gi en donasjon!');
define('_GCAL_ADMIN_DONATE', 'Donasjon til GCalendar');

define('_SUBMIT_GROUPS',   'Grupper');
define('_ADMIN_GROUPS',    'Grupper');
define('_ADMIN_NO_GROUPS', 'Du har ikke NSN Groups installert eller du har ikke ingen grupper enda.');
define('_ADMIN_GROUP_PERM_LABEL', 'Gruppe rettigheter: ');
define('_ADMIN_GROUP_PERM_GROUP', 'Gruppe');
define('_ADMIN_GROUP_PERM_SUBMIT', 'Kan avgi begivenheter');
define('_ADMIN_GROUP_PERM_APPROV', 'Begivenheter trenger ingen godkjennelse');
define('_ADMIN_GROUP_PERM_SAVE', 'Lagre');
define('_ADMIN_GROUP_SUBMIT_NOTE', 'Forekommer bare hvis \'Bruker anførsler\' opsjon er satt til \'Grupper\'');
define('_ADMIN_GROUP_CAT_LABEL', 'Kategori tilordning: ');
define('_ADMIN_GROUP_CAT_EXPLANATION',
   'Kategorier kan tilordnes til grupper; i dette tilfelle kan bare gruppe medlemmer se begivenheter i disse kategoriene. ' .
   'Hvis en kategori ikke er tilordnet til en gruppe, er den synlig for alle. ' .
   'Flere grupper kan bli tilordnet til en kategori(shift- eller ctrl- klikk gruppene).');
define('_ADMIN_GROUP_CAT_COMBO', 'Kategori:');
define('_ADMIN_GROUP_CAT_GROUPS', 'Tilordnet grupper:');
define('_ADMIN_GROUP_CAT_SAVE', 'Oppdater kategori');
?>
