<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
//
// language/lang-norwegian.php - This file is part of GCalendar
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
// This is the Norwegian language constants file for GCalendar.
// Translation by Paal Fondevik.
//
///////////////////////////////////////////////////////////////////////

// names for months and weekdays are provided here in case your server's
// locale differs from your site's language:

define('_MONTH1_NAME', 'Januar');
define('_MONTH2_NAME', 'Februar');
define('_MONTH3_NAME', 'Mars');
define('_MONTH4_NAME', 'April');
define('_MONTH5_NAME', 'Mai');
define('_MONTH6_NAME', 'Juni');
define('_MONTH7_NAME', 'Juli');
define('_MONTH8_NAME', 'August');
define('_MONTH9_NAME', 'September');
define('_MONTH10_NAME', 'Oktober');
define('_MONTH11_NAME', 'November');
define('_MONTH12_NAME', 'Desember');

define('_DAY0_NAME', 'Søndag');
define('_DAY1_NAME', 'Mandag');
define('_DAY2_NAME', 'Tirsdag');
define('_DAY3_NAME', 'Onsdag');
define('_DAY4_NAME', 'Torsdag');
define('_DAY5_NAME', 'Fredag');
define('_DAY6_NAME', 'Lørdag');

define('_DAY0_ABBREV', 'Søn');
define('_DAY1_ABBREV', 'Man');
define('_DAY2_ABBREV', 'Tir');
define('_DAY3_ABBREV', 'Ons');
define('_DAY4_ABBREV', 'Tor');
define('_DAY5_ABBREV', 'Fre');
define('_DAY6_ABBREV', 'Lør');

define('_DAY0_LETTER', 'S');
define('_DAY1_LETTER', 'M');
define('_DAY2_LETTER', 'T');
define('_DAY3_LETTER', 'O');
define('_DAY4_LETTER', 'T');
define('_DAY5_LETTER', 'F');
define('_DAY6_LETTER', 'L');

define('_TIME_FORMAT12', '%I:%M %p');
define('_TIME_FORMAT24', '%H:%M');

define('_TIME_SEP', ':');
define('_TIME_AM',  'AM');
define('_TIME_PM',  'PM');

define('_HEADER_MONTH', 'Måned:');
define('_HEADER_YEAR', 'År:');
define('_HEADER_TODAYS_DATE', 'Dagens dato:');
define('_HEADER_SUBMIT_INFO', 'Legg inn avale');
define('_HEADER_PRINTABLE', 'Skriver vennlig side');
define('_HEADER_GOTO_MONTH', 'Gå');

define('_VIEW_MONTH_GOTO_THIS_MONTH', 'Gå til aktuell måned');
define('_VIEW_MONTH_BULLET', '&bull; ');
define('_CAT_TABLE_LEGEND', 'Vis kategoriene:');
define('_SHOW_ALL', 'Sjekk alle');
define('_SHOW_NONE', 'Ikke sjekk noen');

define('_VIEW_DAY_EVENTS_FOR',   'Alle begivenheter for ');
define('_VIEW_DAY_EVENT_DETAIL', 'Viser begivenhet #');
define('_VIEW_DAY_NO_TIME',      '(Ingen tid)');
define('_VIEW_DAY_TITLE',        'Tittel:');
define('_VIEW_DAY_CATEGORY',     'Kategori:');
define('_VIEW_DAY_TIME',         'Tid:');
define('_VIEW_DAY_LOCATION',     'Sted:');
define('_VIEW_DAY_DESC',         'Beskrivelse:');
define('_VIEW_DAY_NOTES',        'Notater:');
define('_VIEW_DAY_SUBMITTER',    'Lagt til av:');

define('_VIEW_DAY_EVENT_REPEATS', 'Denne begivenhet gjentas hver ');
define('_VIEW_DAY_DAYS',         'Dag(er)');
define('_VIEW_DAY_WEEKS',        'Uke(er)');
define('_VIEW_DAY_MONTHS',       'Måned(er)');
define('_VIEW_DAY_YEARS',        'År');
define('_VIEW_DAY_ON',           ' på: ');
define('_VIEW_DAY_EVERY',        'hver');
define('_VIEW_DAY_ENDS_ON',      'Denne begivenhet slutter ');
define('_VIEW_DAY_VIEW_ALL',     'Vis alle begivenheter på denne dagen');
define('_VIEW_DAY_NO_EVENTS',    'Det er ikke begivenheter denne dagen.');

define('_SUBMIT_FORM_TITLE',     'Ny begivenhet:');

define('_FORM_INSTRUCTIONS',
   'For å legge inn en begivenhet i kalenderen, fyll ut skjemaet under og trykke OK tasten.');

define('_FORM_SUBMIT',           'OK');
define('_FORM_TITLE',            'Tittel:');
define('_FORM_LOCATION',         'Lokasjon:');
define('_FORM_DATE',             'Dato:');
define('_FORM_TIME',             'Tid:');
define('_FORM_NO_TIME',          'Ingen tid');
define('_FORM_START_TIME',       'Start:');
define('_FORM_END_TIME',         'Slutt:');
define('_FORM_CATEGORY',         'Kategori:');
define('_FORM_DETAILS',          'Detaljer:');
define('_FORM_REPEAT',           'Gjenta:');
define('_FORM_EVERY',            'Hver:');
define('_FORM_END_ON',           'Slutt på: ');
define('_FORM_NO_END',           'Ingen slutt dato');
define('_FORM_REPEAT_ON',        'Gjenta på:');
define('_FORM_REPEAT_BY',        'Gjenta av:');
define('_FORM_REPEAT_BY_DAY',    'Dag');
define('_FORM_REPEAT_BY_DATE',   'Dato');
define('_FORM_NO_CATEGORIES',    '(Ingen kategorier tilgjengelig)');
define('_FORM_SUBMITTER',        'Lagt inn av:');
define('_FORM_APPROVE',          'Godkjent:');
define('_FORM_DELETE_LABEL',     'Slett begivenhet');
define('_FORM_DEL_EVENT_CONFIRM','Er du sikker på å slette denne begivenheten?');

define('_FORM_DAYS',             'Dag(er)');
define('_FORM_WEEKS',            'Uke(r)');
define('_FORM_MONTHS',           'Måned(er)');
define('_FORM_YEARS',            'År');

define('_REPEAT_NONE',           'Ingen');
define('_REPEAT_DAY',            'Daglig');
define('_REPEAT_WEEK',           'Ukentlig');
define('_REPEAT_MONTH',          'Måndelig');
define('_REPEAT_YEAR',           'Årlig');

define('_FORM_BY_DAY_EX', '(Eks. tredje onsdagen i hver måned)');
define('_FORM_BY_DATE_EX', '(Eks. Den 23. i hver måned)');

define('_ERR_PLEASE_FIX',
   'Feil ble funnet med din begivenhet; rett feilene vist under og trykk OK igjen.');
define('_ERR_NO_TITLE',       'Savner kalender tittel');
define('_ERR_START_DATE',     'Feil start dato');
define('_ERR_TIME',           'Feil start eller slutt tid');
define('_ERR_CATEGORY',       'Feil kategori');
define('_ERR_REPEAT',         'Feil gjentakelse type');
define('_ERR_INTERVAL',       'Feil gjentakelse intervall');
define('_ERR_END_DATE',       'Feil slutt dato');
define('_ERR_NO_LOCATION',    'Savner lokasjon');
define('_ERR_NO_DETAILS',     'Savner detaljer');

define('_THANKS_SUBMISSION',     'Takk for å ha lagt inn begivenheten!');
define('_APPROVAL_REQUIRED',     'Din begivenhet vil bli lagt inn av administrator.');
define('_NO_APPROVAL_REQUIRED',  'Din begivenhet er lagt inn i kalenderen.');
define('_SUBMIT_ERROR',          'Oops, en database feil har oppstått; gi beskjed til administrator.');
define('_SUBMIT_DISABLED',       'Du har ikke rettigheter til å legge inn begivenheter.');

define('_GCAL_GO_BACK', 'Gå tilbake');
define('_ADMIN_NAME',   'Admin');

define('_CAL_IMAGE_ALT', 'Kalender bilde');

define('_VIEW_WEEK_EVENTS_FOR',     'Viser begivenheter for uke');
define('_VIEW_WEEK_GOTO_THIS_WEEK', 'Gå til aktuell uke');
define('_VIEW_WEEK_OF',             'Vis uke: ');
define('_GO_WEEK_VIEW',             'Gå');

define('_SEND_TO_FRIEND', 'Send epost begivenhet til en venn');
define('_YOU_WILL_SEND_EVENT', 'Du vil sende en link til en venn for denne begivenheten: ');
define('_YOUR_NAME', 'Ditt navn:');
define('_YOUR_EMAIL', 'Din epostadresse:');
define('_FRIEND_NAME', 'Din venns navn:');
define('_FRIEND_EMAIL', 'Din venns epostadresse:');
define('_SEND_EVENT', 'Send begivenheten');
define('_INVALID_EMAIL', 'Feil epostadresse');

define('_FRIEND_EMAIL_SUBJECT', 'Interessant kalender begivenhet fra ');
define('_FRIEND_GREETING', 'Hei ');
define('_FRIEND_GREETING_PUNCT', ':');
define('_FRIEND_YOUR_FRIEND', 'Din venn ');
define('_FRIEND_WANTED_TO_SEND', ' ønsker at du vet om denne begivenheten:');
define('_FRIEND_WAS_SENT_FROM', 'Denne begivenheten er sendt fra ');
define('_FRIEND_EVENT_SENT', 'Denne begivenheten er sendt til din venn, takker!');

define('_VIEW_DAY_START_DATE', 'Start dato:');
define('_UPDATE_EVENT', 'Oppdater begivenhet');
define('_FORM_CANCEL_LABEL', 'Kansellere');

define('_HEADER_GOTO_ADMIN', 'GCalendar Admin');
define('_FORM_RSVP_LABEL',    'RSVP:');
define('_FORM_RSVP_OFF',      'Ingen RSVP');
define('_FORM_RSVP_ON',       'Tillat RSVP');
define('_FORM_RSVP_EMAIL',    'Tillat RSVP og send epost til meg');

define('_VIEW_DAY_RSVP',            'RSVP Liste:');
define('_GCAL_RSVP_EVENT',          'RSVP til denne begivenhet');
define('_GCAL_CANCEL_RSVP_EVENT',   'Kanseller RSVP');
define('_VIEW_DAY_EVENT_NUM',       'Begivenhet #');
define('_GCAL_RSVP_GREETING',       'Kjære ');
define('_GCAL_RSVP_END_GREETING',   ':');
define('_GCAL_RSVP_MESSAGE',        'Noen har oppdatert deres RSVP status til en av dine begivenheter.');
define('_GCAL_RSVP_USER',           'Bruker: ');
define('_GCAL_RSVP_ACTION',         'Aksjon: ');
define('_GCAL_RSVP_RSVP',           'RSVP Akseptert');
define('_GCAL_RSVP_CANCEL',         'RSVP Kansellert');
define('_GCAL_RSVP_EVENT_LINK',     'Event Link: ');

define('_GCAL_REPEAT_OPTIONS',         'Dette er en begivenhet som gjentar seg; ønsker du å endre:');
define('_GCAL_REPEAT_THIS_ONLY',       'Bare denne forekomst');
define('_GCAL_REPEAT_THIS_FUTURE',     'Denne forekomst og alle fremtidige');
define('_GCAL_REPEAT_ALL_SAME_START',  'Alle forekomster men behold original start dato av ');
define('_GCAL_REPEAT_ALL_NEW_START',   'Alle forekomster og endre startdato som ovenfor');
define('_GCAL_REPEAT_NO_BRANCH_DATE',  'Dette er en repeterende begivenhet; endringer vil endres på alle forekomster');
?>
