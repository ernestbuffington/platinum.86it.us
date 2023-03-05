<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
define('PIC_VIEWS', 'Angesehen');
define('PIC_VOTES', 'Bewertungen');
define('PIC_COMMENTS', 'Kommentare');

// to all devs: stop update just before committing this file!
// info about translators and translated language
$lang_translation_info = array('lang_name_english' => 'German', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Deutsch', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'de', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Sascha Heiner', // the name of the translator - can be a nickname
    'trans_email' => 'greeny@discofreaks.com', // translator's email address (optional)
    'trans_website' => 'http://www.discofreaks.com/', // translator's website (optional)
    'trans_date' => '2003-11-19', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
$lang_month = array('Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez');
// Some common strings
$lang_yes = 'Ja';
$lang_no = 'Nein';
$lang_back = 'zur�ck';
$lang_continue = 'weiter';
$lang_info = 'Information';
$lang_error = 'Fehler';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d %B, %Y';
$lastcom_date_fmt = '%d/%m/%y um %H:%M';
$lastup_date_fmt = '%d %B, %Y';
$register_date_fmt = '%d %B, %Y';
$lasthit_date_fmt = '%d %B, %Y um %I:%M %p';
$comment_date_fmt = '%d %B, %Y um %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', '*fick*', '*assi*', '*schwanz*', '*bitches*', '*bescheuert*', '*hoden*', '*fischgesicht*', '*depp*', '*schwuchtel*', '*ausl�nder*', '*idiot*', '*wixer*', '*penner*', '*wichser*', '*wixer*', '*kanacke*', '*m�se*', '*pussy*', '*m�pse*', '*sack*', '*arsch*', 'hure*', '*schwul*', 'nutte', 'fotze', 'm�se', 'scheiss*', 'schei�*', 'motherfucker', 'nigger*', 'pussy', 'shit', 'slut', 'titties', '*titt*');

$lang_meta_album_names = array('random' => 'Zufalls Bilder',
    'lastup' => 'neueste Bilder',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'neueste Alben',
    'lastcom' => 'neueste Kommentare',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'am meisten angesehen',
    'toprated' => 'am besten bewertet',
    'lasthits' => 'zuletzt angesehen',
    'search' => 'Ergebnisse der Suche',
    'favpics' => 'Lieblings Bilder' // changed in cpg1.2.0nuke
    );

$lang_errors = array('access_denied' => 'Du hast kein Recht, diese Seite anzusehen.',
    'perm_denied' => 'Du hast nicht das Recht, diese Operation auszuf�hren.',
    'param_missing' => 'Das Skript wurde ohne den/die erfordlichen Parameter aufgerufen.',
    'non_exist_ap' => 'Das gew�hlte Album bzw. Bild existiert nicht!',
    'quota_exceeded' => 'Speicherplatz ersch�pft<br /><br />Du hast ein Speicherlimit von [quota]K, Deine Bilder belegen zu Zeit [space] kB, das Hinzuf�gen dieses Bildes w�rde Deinen Speicherplatz �berschreiten.',
    'gd_file_type_err' => 'Bei Verwendung der GD-Bibliothek sind nur die Dateitypen JPG und PNG erlaubt.',
    'invalid_image' => 'Das Bild, das Du hochgeladen hast ist besch�digt oder kann nicht von der GD-Bibliothek verarbeitet werden',
    'resize_failed' => 'Kann Thumbnail nicht erzeugen.',
    'no_img_to_display' => 'Kein Bild zum Anzeigen vorhanden',
    'non_exist_cat' => 'Die gew�hlte Kategorie existiert nicht',
    'orphan_cat' => 'Eine Kategorie besitzt ein nicht-existierendes Eltern-Element, benutze den Kategorie-Manager um das Problem zu beheben.',
    'directory_ro' => 'Das Verzeichnis \'%s\' ist nicht beschreibbar, die Bilder k�nnen nicht gel�scht werden',
    'non_exist_comment' => 'Der gew�hlte Kommentar existiert nicht.',
    'pic_in_invalid_album' => 'Das Bild befindet sich in einem nicht-existierenden Album (%s)!?',
    'banned' => 'Dein Zugang zur Seite wurde gesperrt.',
    'not_with_udb' => 'Diese Funtion ist deativiert,weil sie in die Forumsoftware integriert wurde. Diese Funktion wird nicht mit der jetztigen Konfiguration unterst�zt oder die Funktion wird von der Forumsoftware ausgef�hrt.',
    'members_only' => 'Diese Funktion ist nur f�r Mitglieder, melde dich bitte an.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'Diese Funktion ist nur f�r den Administrator, du mu�t dich als superadmin oder god account anmelden um die Funktion zu Nutzen.'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Gehe zur Alben-�bersicht',
    'alb_list_lnk' => 'Alben-�bersicht',
    'my_gal_title' => 'zu meiner pers�nlichen Galerie',
    'my_gal_lnk' => 'meine Galerie',
    'my_prof_lnk' => 'mein Profil',
    'adm_mode_title' => 'in Admin-Modus schalten',
    'adm_mode_lnk' => 'Admin-Modus',
    'usr_mode_title' => 'in Benutzer-Modus schalten',
    'usr_mode_lnk' => 'Benutzer-Modus',
    'upload_pic_title' => 'Bild in ein Album hochladen',
    'upload_pic_lnk' => 'Bild hochladen',
    'register_title' => 'Konto erzeugen',
    'register_lnk' => 'Registrieren',
    'login_lnk' => 'anmelden',
    'logout_lnk' => 'abmelden',
    'lastup_lnk' => 'neueste Uploads',
    'lastcom_lnk' => 'neueste Kommentare',
    'topn_lnk' => 'am meisten angesehen',
    'toprated_lnk' => 'am besten bewertet',
    'search_lnk' => 'Suche',
    'fav_lnk' => 'Lieblings Bilder',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Upload-Best�tigung',
    'config_lnk' => 'Einstellungen',
    'albums_lnk' => 'Alben',
    'categories_lnk' => 'Kategorien',
    'users_lnk' => 'Benutzer',
    'groups_lnk' => 'Gruppen',
    'comments_lnk' => 'Kommentare',
    'searchnew_lnk' => 'Batch-hinzuf�gen',
    'util_lnk' => 'Bildgr��e �ndern',
    'ban_lnk' => 'User Sperren',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Alben erzeugen / anordnen',
    'modifyalb_lnk' => 'Meine Alben bearbeiten',
    'my_prof_lnk' => 'Mein Profil',
    );

$lang_cat_list = array('category' => 'Kategorie',
    'albums' => 'Alben',
    'pictures' => 'Bilder',
    );

$lang_album_list = array('album_on_page' => '%d Alben auf %d Seite(n)'
    );

$lang_thumb_view = array('date' => 'Datum',
    'name' => 'Dateiname',
    'title' => 'Titel',
    'sort_da' => 'aufsteigend nach Datum sortieren',
    'sort_dd' => 'absteigend nach Datum sortieren',
    'sort_na' => 'aufsteigend nach Name sortieren',
    'sort_nd' => 'absteigend nach Name sortieren',
    'sort_ta' => 'aufsteigend nach Titel',
    'sort_td' => 'absteigend nach Titel',
    'pic_on_page' => '%d Bilder auf %d Seite(n)',
    'user_on_page' => '%d Benutzer auf %d Seite(n)',
    'sort_ra' => 'aufsteigend nach Bewertung', // new in cpg1.2.0nuke
    'sort_rd' => 'absteigend nach Bewertung', // new in cpg1.2.0nuke
    'rating' => 'Bewertung', // new in cpg1.2.0nuke
    'sort_title' => 'Sortierung nach:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'zur�ck zur Thumbnail-Seite',
    'pic_info_title' => 'Bildinformationen anzeigen/verbergen',
    'slideshow_title' => 'Diashow',
    'slideshow_disabled' => 'eCard wurde deaktiviert', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Bild als eCard versenden',
    'ecard_disabled' => 'eCards sind deaktiviert',
    'ecard_disabled_msg' => 'Du hast nicht das Recht, eCards zu versenden',
    'prev_title' => 'vorheriges Bild anzeigen',
    'next_title' => 'n�chstes Bild anzeigen',
    'pic_pos' => 'Bild %s/%s',
    'no_more_images' => 'Keine weitern Bilder in der Gallery vorhanden', // new in cpg1.2.0nuke
    'no_less_images' => 'Das ist das erste Bild in der Gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Dieses Bild bewerten ',
    'no_votes' => '(noch keine Bewertung)',
    'rating' => '- derzeitige Bewertung : %s/5 mit %s Stimme(n)',
    'rubbish' => 'sehr schlecht',
    'poor' => 'schlecht',
    'fair' => 'ganz OK',
    'good' => 'gut',
    'excellent' => 'sehr gut',
    'great' => 'super',
    );
// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //
$lang_cpg_die = array(
    INFORMATION => $lang_info,
    ERROR => $lang_error,
    CRITICAL_ERROR => 'Kritischer Fehler',
    'file' => 'Datei: ',
    'line' => 'Zeile: ',
    );

$lang_display_thumbnails = array('filename' => 'Dateiname : ',
    'filesize' => 'Dateigr�sse : ',
    'dimensions' => 'Abmessungen : ',
    'date_added' => 'hinzugef�gt am : '
    );

$lang_get_pic_data = array('n_comments' => '%s Kommentar(e)',
    'n_views' => '%s x angesehen',
    'n_votes' => '(%s Bewertungen)'
    );
// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Ausruf',
        'Question' => 'Frage',
        'Very Happy' => 'sehr gl�cklich',
        'Smile' => 'lachen',
        'Sad' => 'traurig',
        'Surprised' => '�berrascht',
        'Shocked' => 'schockiert',
        'Confused' => 'verwirrt',
        'Cool' => 'cool',
        'Laughing' => 'lachend',
        'Mad' => 'w�tend',
        'Razz' => 'scheu',
        'Embarassed' => 'sch�chtern',
        'Crying or Very sad' => 'traurig',
        'Evil or Very Mad' => 'b�se',
        'Twisted Evil' => 'verschlagen',
        'Rolling Eyes' => 'na ja',
        'Wink' => 'zwinker',
        'Idea' => 'Idee',
        'Arrow' => 'Pfeil',
        'Neutral' => 'neutral',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Beende Admin-Modus...',
        1 => 'Starte Admin-Modus...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Alben m�ssen einen Namen haben!',
        'confirm_modifs' => 'Bist Du sicher, dass Du diese �nderungen durchf�hren willst?',
        'no_change' => 'Du hast nichts ver�ndert!',
        'new_album' => 'neues Album',
        'confirm_delete1' => 'Willst Du dieses Album wirklich l�schen?',
        'confirm_delete2' => '\nAlle Bilder und Kommentare, die darin enthalten sind werden gel�scht!',
        'select_first' => 'W�hle zuerst ein Album',
        'alb_mrg' => 'Alben-Manager',
        'my_gallery' => '* meine Galerie *',
        'no_category' => '* keine Kategorie *',
        'delete' => 'l�schen',
        'new' => 'neu',
        'apply_modifs' => '�nderungen �bernehmen',
        'select_category' => 'Select category',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Fehlender Parameter f�r die Operation \'%s\' !',
        'unknown_cat' => 'Gew�hlte Kategorie existiert nicht in Datenbank',
        'usergal_cat_ro' => 'Benutzer-Galerie kann nicht gel�scht werden!',
        'manage_cat' => 'Kategorien verwalten',
        'confirm_delete' => 'Willst Du diese Kategorie wriklich L�SCHEN',
        'category' => 'Kategorie',
        'operations' => 'Operationen',
        'move_into' => 'verschieben in',
        'update_create' => 'Kategorie erzeugen/�ndern',
        'parent_cat' => 'Eltern-Kategorie',
        'cat_title' => 'Titel der Kategorie',
        'cat_desc' => 'Beschreibung Kategorie'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Einstellungen',
        'restore_cfg' => 'auf Werkseinstellungen zur�cksetzen',
        'save_cfg' => 'neue Einstellungen speichern',
        'notes' => 'Anmerkungen',
        'info' => 'Information',
        'upd_success' => 'Die Einstellungen von Coppermine wurden aktualisiert',
        'restore_success' => 'Coppermine Standard-Einstellungen wieder hergestellt',
        'name_a' => 'aufsteigend nach Name',
        'name_d' => 'absteigend nach Name',
        'title_a' => 'aufsteigend nach Titel',
        'title_d' => 'absteigend nach Titel',
        'date_a' => 'aufsteigend nach Datum',
        'date_d' => 'absteigend nach Datum',
        'rating_a' => 'aufsteigend nach Bewertung', // new in cpg1.2.0nuke
        'rating_d' => 'absteigend nach Bewertung', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspekt',
        'th_ht' => 'H�he',
        'th_wd' => 'Breite'
        );

if (defined('CONFIG_PHP'))
    $lang_config_data = array('Allgemeine Einstellungen',
        array('Galerie-Name', 'gallery_name', 0),
        array('Galerie Beschreibung', 'gallery_description', 0),
        array('Galerie-Admin E-Mail', 'gallery_admin_email', 0),
        array('Ziel-Adresse f�r Nuke Ordner z.b. http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array('Sprache', 'lang', 5),
// for postnuke change
        array('Design', 'cpgtheme', 6),
        array('Seiten Titel anstelle >Coppermine', 'nice_titles', 1),
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2

        'Ansicht Albumliste',
        array('Breite der Haupttabelle (in Pixel oder %)', 'main_table_width', 0),
        array('Anzahl anzuzeigende Kategorie-Ebenen', 'subcat_level', 0),
        array('Anzahl anzuzeigende Alben', 'albums_per_page', 0),
        array('Anzahl Spalten in Album-Liste', 'album_list_cols', 0),
        array('Thumbnail-Gr�sse in Pixel', 'alb_list_thumb_size', 0),
        array('Inhalt der Hauptseite', 'main_page_layout', 0),
        array('Zeige first level Album thumbnails in den Kategorien', 'first_level', 1),
        'Ansicht Thumbnail',
        array('Spaltenzahl auf Thumbnail-Seite', 'thumbcols', 0),
        array('Zeilenzahl auf Thumbnail-Seite', 'thumbrows', 0),
        array('Anzahl maximal anzuzeigende Tabs', 'max_tabs', 0),
        array('Bild-Beschriftung anzeigen (zus�tzlich zum Bild-Titel) unterhalb der Thumbnails', 'caption_in_thumbview', 1),
        array('Anzahl der Kommentare unterhalb dem Thumbnail anzeigen', 'display_comment_count', 1),
        array('Standard-Sortierung f�r Bilder', 'default_sort_order', 3),
        array('Mindestmenge Stimmen, die ein Bild ben�tigt, um in der \'am besten bewertet\' Liste zu erscheinen', 'min_votes_for_rating', 0),
        array('Alternative zeige den Titel und keyword anstatt der Bildinformation', 'seo_alts', 1), // new in cpg1.2.0nuke
        'Ansicht Bild &amp; Einstellungen Kommentare',
        array('Tabellenbreite f�r Bildanzeige (in Pixel oder %)', 'picture_table_width', 0),
        array('Bildinformationen sind standardm��ig sichtbar', 'display_pic_info', 1),
        array('Schimpfw�rter in Kommentaren zensieren', 'filter_bad_words', 1),
        array('Smilies in Kommentaren erlauben', 'enable_smilies', 1),
        array('Erlaube Mehrfache Kommentare unter einem Bild von einem User', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array('Email Benachrichtigung nach Kommentar eingabe' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array('Maximall�nge f�r Bildbeschreibung', 'max_img_desc_length', 0),
        array('Maximale Anzahl von Buchstaben in einem Wort', 'max_com_wlength', 0),
        array('Maximale Zeilenzahl eines Kommentars', 'max_com_lines', 0),
        array('Maximale L�nge eines Kommentars', 'max_com_size', 0),
        array('Zeige Filmstreifen', 'display_film_strip', 1),
        array('Anzahl der Einzelteile in einem Filmstreifen', 'max_film_strip_items', 0),
        array('Anonyme k�nnen die Bilder in voller Gr��e betrachten', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',
        'Bild- und Thumbnail-Einstellungen',
        array('Qualit�t f�r JPEG-Dateien', 'jpeg_qual', 0),
        array('Maximale H�he oder Breite von Thumbnails <strong>*</strong>', 'thumb_width', 0),
        array('Dimensionen ( H�he, Breite oder Maximaler Aspekt f�r die thumbnails )<strong>*</strong>', 'thumb_use', 7),
        array('Bilder in Zwischengr��szlig;e erzeugen', 'make_intermediate', 1),
        array('Maximale Breite oder H�he von Bildern in Zwischengr��e <strong>*</strong>', 'picture_width', 0),
        array('Maximalgr��e f�r das Hochladen von Bildern (KB)', 'max_upl_size', 0),
        array('Maximale Breite oder H�he f�r das Hochladen von Bildern (in Pixel)', 'max_upl_width_height', 0),

        'User settings',
        array('Registrierung von Benutzern zulassen', 'allow_user_registration', 1),
        array('Registrierung von Benutzern erfordert �berpr�fung per E-Mail', 'reg_requires_valid_email', 1),
        array('Zulassen, da� mehrere Benutzer die gleiche E-Mail Adresse haben', 'allow_duplicate_emails_addr', 1),
        array('Benutzer d�rfen Privatalbum anlegen', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Benutzerdefinierte Felder f�r zus�tzliche Bildinformationen (leer lassen, falls nicht ben�tigt)',
        array('Name Feld 1', 'user_field1_name', 0),
        array('Name Feld 2', 'user_field2_name', 0),
        array('Name Feld 3', 'user_field3_name', 0),
        array('Name Feld 4', 'user_field4_name', 0),

        'Erweiterte Bild- und Thumbnail-Einstellungen',
        array('Zeige das Private Album Icon ausgeloggten Usern', 'show_private', 1),
        array('Nicht erlaubte Zeichen in Dateinamen', 'forbiden_fname_char', 0),
        array('erlaubte Datei-Erweiterungen f�r das Hochladen von Bildern', 'allowed_file_extensions', 0),
        array('Methode zur Gr��en�nderung von Bildern', 'thumb_method', 2),
        array('Pfad zur \'convert\' Anwendung von ImageMagick (z.B. /usr/bin/X11/)', 'impath', 0),
        array('Erlaubte Datei-Typen (nur g�ltig f�r ImageMagick)', 'allowed_img_types', 0),
        array('Kommandozeilen-Parameter f�r ImageMagick', 'im_options', 0),
        array('EXIF-Daten in JPEG-Dateien lesen', 'read_exif_data', 1),
        array('Lese IPTC Daten der JPEG Dateien', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array('Alben-Verzeichnis <strong>*</strong>', 'fullpath', 0),
        array('Verzeichnis f�r Benutzer-Bilder <strong>*</strong>', 'userpics', 0),
        array('Vorsilbe f�r Bilder in Zwischengr��e <strong>*</strong>', 'normal_pfx', 0),
        array('Vorsilbe f�r Thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array('Standard-Modus f�r Verzeichnisse', 'default_dir_mode', 0),
        array('Standard-Modus f�r Bilder', 'default_file_mode', 0),
        array('Picinfo Zeige Dateiname', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige Album Name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige_Datei_Gr��e', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige_Dimensionen', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige URL als Bookmark Link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array('Picinfo Zeige Lieblings Bilder Link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        'Cookies &amp; Zeichensatz-Einstellungen',
        array('Cookie-Name, der vom Skript verwendet wird', 'cookie_name', 0),
        array('Cookie-Pfad', 'cookie_path', 0),
        array('Zeichensatz', 'charset', 4),

        'Verschiedene Einstellungen',
        array('Debug-Modus ein', 'debug_mode', 1),
        array('Erweiterten Debug-Modus ein', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Die Felder die mit einem * markiert sind, m�ssen nicht ge�ndert werden wenn du schon Bilder in der Gallery hast</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Du musst Deinen Namen und einen Kommentar eingeben',
        'com_added' => 'Dein Kommentar wurde hinzugef�gt',
        'alb_need_title' => 'Du musst einen Titel f�r das Album eingeben!',
        'no_udp_needed' => 'Keine Aktualisierung notwendig.',
        'alb_updated' => 'Das Album wurde aktualisiert',
        'unknown_album' => 'Das gew�hlte Album existiert nicht oder Du hast keine Berechtigung, Bilder in dieses Album hochzuladen',
        'no_pic_uploaded' => 'Es wurde kein Bild hochgeladen!<br /><br />Wenn Du tats�chlich ein Bild zum Hochladen selektiert hast, �berpr�fe ob Dein Server das Hochladen von Dateien zul�sst...',
        'err_mkdir' => 'Verzeichnis %s konnte nicht angelegt werden!',
        'dest_dir_ro' => 'In das Zielverzeichnis %s kann vom Skript nicht geschrieben werden!',
        'err_move' => '%s kann nicht nach %s verschoben werden!',
        'err_fsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu gro� (maximal zul�ssig ist %s x %s) !',
        'err_imgsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu gro� (maximal zul�ssig ist %s KB) !',
        'err_invalid_img' => 'Die Datei, die Du hochgeladen hast ist kein g�ltiger Bildtyp!',
        'allowed_img_types' => 'Du kannst nur %s Bilder hochladen.',
        'err_insert_pic' => 'Das Bild \'%s\' kann nicht in das Album eingef�gt werden',
        'upload_success' => 'Dein Bild wurde erfolgreich hochgeladen.<br /><br />Es wird nach der Best�tigung durch den Admin sichtbar sein.',
        'info' => 'Information',
        'com_added' => 'Kommentar hinzugef�gt',
        'alb_updated' => 'Album aktualisiert',
        'err_comment_empty' => 'Dein Kommentar enth�lt keine Zeichen!',
        'err_invalid_fext' => 'Nur Dateien mit den folgenden Erweiterungen sind zul�ssig: <br /><br />%s.',
        'no_flood' => 'Leider bist Du schon der Autor des letzten Kommentars zu diesem Bild<br /><br />Bearbeite Deinen bestehenden Kommentar, wenn Du ihn ver�ndern willst',
        'redirect_msg' => 'Du wirst weitergeleitet.<br /><br /><br />Klicke \'weiter\', falls die Seite sich nicht automatisch aktualisiert',
        'upl_success' => 'Dein Bild wurde erfolgreich hinzugef�gt',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => '�berschrift',
        'fs_pic' => 'Bild in Originalgr��e',
        'del_success' => 'erfolgreich gel�scht',
        'ns_pic' => 'normal grosses Bild',
        'err_del' => 'kann nicht gel�scht werden',
        'thumb_pic' => 'Thumbnail',
        'comment' => 'Kommentar',
        'im_in_alb' => 'Bild in Album',
        'alb_del_success' => 'Album \'%s\' gel�scht',
        'alb_mgr' => 'Alben-Manager',
        'err_invalid_data' => 'Ung�ltige Daten empfangen in \'%s\'',
        'create_alb' => 'Erzeuge Album \'%s\'',
        'update_alb' => 'Aktualisiere Album \'%s\' mit Titel \'%s\' und Index \'%s\'',
        'del_pic' => 'Bild l�schen',
        'del_alb' => 'Album l�schen',
        'del_user' => 'Benutzer l�schen',
        'err_unknown_user' => 'Der gew�hlte Benutzer ist nicht vorhanden!',
        'comment_deleted' => 'Kommentar wurde gel�scht',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Dieses Bild wirklich L�SCHEN? \\nKommentare werden ebenfalls gel�scht.',
        'del_pic' => 'Dieses Bild L�schen',
        'size' => '%s x %s Pixel',
        'views' => '%s mal',
        'slideshow' => 'Diashow',
        'stop_slideshow' => 'Diashow anhalten',
        'view_fs' => 'Click to view full size image',
        'edit_pic' => 'Bildinformation �ndern', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Bild-Information',
        'Filename' => 'Dateiname',
        'Album name' => 'Name des Albums',
        'Rating' => 'Bewertung (%s Stimmen)',
        'Keywords' => 'Stichworte',
        'File Size' => 'Dateigr�sse',
        'Dimensions' => 'Abmessungen',
        'Displayed' => 'Angezeigt',
        'Camera' => 'Kamera',
        'Date taken' => 'Aufnahmedatum',
        'Aperture' => 'Blende',
        'Exposure time' => 'Belichtungszeit',
        'Focal length' => 'Brennweite',
        'Comment' => 'Kommentar',
        'addFav' => 'Zu den Lieblings Bildern Hinzuf�gen',//different in 1.2.0nuke
        'addFavPhrase' => 'Lieblings Bilder', // new in cpg1.2.0different in 1.2.0nuke
        'remFav' => 'Entferne aus den Lieblings Bildern',
        'iptcTitle' => 'IPTC Titel', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Kategorie', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Bild', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'OK' => 'OK',
        'edit_title' => 'Diesen Kommentar bearbeiten',
        'confirm_delete' => 'Willst Du diesen Kommentar wirklich l�schen?',
        'add_your_comment' => 'F�ge Deinen Kommentar hinzu',
        'name' => 'Name',
        'comment' => 'Kommentar',
        'your_name' => 'Anonym',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klicke auf das Bild um das Fenster zu schlie�en',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'eCard senden',
        'invalid_email' => '<strong>Achtung</strong> : ung�ltige E-Mail Adresse !',
        'ecard_title' => 'Eine eCard von %s f�r Dich',
        'view_ecard' => 'Falls diese eCard nicht korrekt angezeigt wird klicke auf den folgenden Link: ',
        'view_more_pics' => 'Klicke auf diesen Link, um mehr Bilder ansehen zu k�nnen!',
        'send_success' => 'Deine eCard wurde gesendet',
        'send_failed' => 'Leider kann der Server Deine eCard nicht versenden...',
        'from' => 'Von',
        'your_name' => 'Dein Name',
        'your_email' => 'Deine E-Mail Adresse',
        'to' => 'An',
        'rcpt_name' => 'Empf�nger Name',
        'rcpt_email' => 'Empfanger E-Mail Adresse',
        'greetings' => 'Gr�sse',
        'message' => 'Nachricht',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Bild-Info',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beschreibung',
        'keywords' => 'Stichworte',
        'pic_info_str' => '%sx%s - %sKB - %s x angesehen - %s x abgestimmt',
        'approve' => 'Bild genehmigen',
        'postpone_app' => 'Geneh,igung verschieben',
        'del_pic' => 'Bild l�schen',
        'read_exif' => 'Lese die EXIF info nochmal', // new in cpg1.2.0nuke
        'reset_view_count' => 'Z�hler x mal angesehen auf Null setzen',
        'reset_votes' => 'Anzahl Stimmen auf Null setzen',
        'del_comm' => 'Kommentare l�schen',
        'upl_approval' => 'Genehmigung zum Hochladen',
        'edit_pics' => 'Bilder bearbeiten',
        'see_next' => 'n�chste Bilder ansehen',
        'see_prev' => 'vorherige Bilder ansehen',
        'n_pic' => '%s Bilder',
        'n_of_pic_to_disp' => 'Bilder pro Seite',
        'apply' => '�nderungen ausf�hren',
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Gruppen-Name',
        'disk_quota' => 'Speicherplatz',
        'can_rate' => 'Darf Bilder bewerten',
        'can_send_ecards' => 'Darf eCards versenden',
        'can_post_com' => 'Darf Kommentare abgeben',
        'can_upload' => 'Darf Bilder hochladen',
        'can_have_gallery' => 'Darf eine pers�nliche Galerie haben',
        'apply' => '�nderungen ausf�hren',
        'create_new_group' => 'Neue Gruppe erstellen',
        'del_groups' => 'ausgew�hlte Gruppe(n) l�schen',
        'confirm_del' => 'Achtung: wenn Du eine Gruppe l�schst werden die dazu geh�renden Benutzer in die Gruppe \'Registrierte Benutzer\' Verschoben !\n\nWillst Du das ?',
        'title' => 'Benutzer-Gruppen verwalten',
        'approval_1' => '�ffentl.Hochlad.Best. (1)',
        'approval_2' => 'Priv.Hochlad.Best. (2)',
        'note1' => '<strong>(1)</strong> Das Hochladen in ein �ffentliches Album mu� durch den Admin best�tigt werden',
        'note2' => '<strong>(2)</strong> Das Hochladen in ein privates Album mu� durch den Admin best�tigt werden',
        'notes' => 'Anmerkungen'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Startseite'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Willst Du dieses Album wirklich L�SCHEN? \\nAlle darin befindlichen Bilder und Kommentare werden ebenfalls gel�scht.',
        'delete' => 'l�schen',
        'modify' => '�ndern',
        'edit_pics' => 'Bilder bearbeiten',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben und <strong>[cat]</strong> Kategorien mit <strong>[comments]</strong> Kommentaren, <strong>[views]</strong> mal angesehen',
        'stat2' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben, <strong>[views]</strong> mal angesehen',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben mit <strong>[comments]</strong> Kommentaren, <strong>[views]</strong> mal angesehen'
        );

    $lang_list_users = array('user_list' => 'Benutzer-Liste',
        'no_user_gal' => 'Es gibt keine Benutzer, die eigene Alben haben d�rfen',
        'n_albums' => '%s Album/en',
        'n_pics' => '%s Bild(er)'
        );
    $lang_list_albums = array('n_pictures' => '%s Bilder',
        'last_added' => ', letzte Aktualisierung am %s'
        );
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Album %s aktualisieren',
        'general_settings' => 'Allgemeine Einstellungen',
        'alb_title' => 'Album Titel',
        'alb_cat' => 'Album Kategorie',
        'alb_desc' => 'Album Beschreibung',
        'alb_thumb' => 'Album Thumbnail',
        'alb_perm' => 'Berechtigungen f�r dieses Album',
        'can_view' => 'Album kann angesehen werden von',
        'can_upload' => 'Besucher k�nnen Bilder hochladen',
        'can_post_comments' => 'Besucher k�nnen Kommentare abgeben',
        'can_rate' => 'Besucher k�nnen Bilder bewerten',
        'user_gal' => 'Benutzer-Galerie',
        'no_cat' => '* keine Kategorie *',
        'alb_empty' => 'Album ist leer',
        'last_uploaded' => 'Letzes Bild, das hochgeladen wurde',
        'public_alb' => 'Jeder (�ffentliches Album)',
        'me_only' => 'Nur ich',
        'owner_only' => 'Nur der Besitzer des Albums (%s)',
        'groupp_only' => 'Mitglieder der Gruppe \'%s\'',
        'err_no_alb_to_modify' => 'Es ist kein Album zum Bearbeiten in der Datenbank.',
        'update' => 'Album aktualisieren'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Du hast dieses Bild schon bewertet',
        'rate_ok' => 'Deine Bewertung wurde akzeptiert',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Obwohl die Administratoren von {SITE_NAME} versuchen werden, generell alle anst�ssigen Inhalte so schnell wie m�glich zu l�schen oder bearbeiten ist es unm�glich, jeden Beitrag zu �berpr�fen. Daher best�tigst Du, dass alle Beitr�ge auf dieser Seite die Ansichten und Meinungen des Authors widerspiegeln und nicht die des Administrators oder Webmasters (au�er den Beitr�gen, die durch sie verfasst wurden) und sie daher daf�r nicht verantwortlich gemacht werden k�nnen.<br />
<br />
Du stimmst zu, keine beleidigende, obsz�ne, vulg�re, verleumderische, verhetzende,drohende, sexuell-orientierte oder sonstwie illegalen Beitr�ge zu verfassen. Du stimmst zu, da� der/die Webmaster, Administrator(en) oder Moderator(en) von {SITE_NAME} das recht haben, jeden Inhalt zu l�schen oder �ndern, bei dem sie es f�r richtig halten. Als Benutzer stimmst Du zu, da� alle Informationen, die Du oben eingetragen hast in einer Datenbank gespeichert werden. Obwohl diese Daten ohne Deine ausdr�ckliche Zustimmung nicht an Dritte weitergegeben werden k�nnen der Webmaster oder Administrator nicht daf�r zur Verantwortung gezogen werden, wenn durch einen Angriff (Hacking) die gespeicherten Daten kompromitiert werden.<br />
<br />
Diese Seite benutzt Cookies, um Daten auf Deinem Rechner zu speichern. Diese Cookies dienen nur dazu, die Bedienung der Seite zu erm�glichen. Die E-Mail Adresse wird nur dazu verwendet, die Registrierungs-Details und das Passwort zu best�tigen.<br />
<br />
Durch das Anklicken von 'ich stimme zu' stimmst Du diesen Bedingungen zu.
EOT;

    $lang_register_php = array('page_title' => 'Benutzer-Registrierung',
        'term_cond' => 'Nutzungsbedingungen',
        'i_agree' => 'ich stimme zu',
        'submit' => 'Registrieren absenden',
        'err_user_exists' => 'Der Benutzername, den Du eingegeben hast existiert schon, bitte w�hle einen anderen',
        'err_password_mismatch' => 'Die Passw�rter stimmen nicht �berein, bitte nochmals eingeben',
        'err_uname_short' => 'Der Benutzername mu� mindestens 2 Zeichen lang sein',
        'err_password_short' => 'Das Passwort mu� mindestens 2 Zeichen lang sein',
        'err_uname_pass_diff' => 'Benutzername und Passwort m�ssen unterschiedlich sein',
        'err_invalid_email' => 'E-Mail Adresse ist ung�ltig',
        'err_duplicate_email' => 'Es hat sich schon ein anderer Benutzer mit der angegebenen E-Mail Adresse registriert',
        'enter_info' => 'Gib Registrierungs-Informationen ein',
        'required_info' => 'Pflichtfeld',
        'optional_info' => 'Optional',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'password_again' => 'Passwort-Best�tigung',
        'email' => 'E-Mail Adresse',
        'location' => 'Ort',
        'interests' => 'Hobbies',
        'website' => 'Homepage',
        'occupation' => 'Beruf',
        'error' => 'ERROR',
        'confirm_email_subject' => '%s - Registrierungs-Best�tigung',
        'information' => 'Information',
        'failed_sending_email' => 'Die Registrierungs-best�tigung kann nicht per E-Mail versendet werden!',
        'thank_you' => 'Danke f�r Deine Registrierung.<br /><br />Eine E-Mail mit Informationen, wie Du Dein Benutzerkonto aktivieren kannst wurde an die angegebene E-Mail Adresse gesendet.',
        'acct_created' => 'Dein Benutzerkonto wurde erstellt. Du kannst Dich jetzt mit Benutzername und passwort anmelden',
        'acct_active' => 'Dein Benutzerkonto ist jetzt aktiviert - Du kannst Dich mit Benutzername und Passwort anmelden',
        'acct_already_act' => 'Dein Benutzerkonto ist bereits aktiviert!',
        'acct_act_failed' => 'Dieses Benutzerkonto kann nicht aktiviert werden!',
        'err_unk_user' => 'Der gew�hlte Benutzer existiert nicht!',
        'x_s_profile' => '%s\'s Benutzerprofil',
        'group' => 'Gruppe',
        'reg_date' => 'Registriert am',
        'disk_usage' => 'Speicherplatz-Verbrauch',
        'change_pass' => 'Passwort �ndern',
        'current_pass' => 'derzeitiges Passwort',
        'new_pass' => 'neues Passwort',
        'new_pass_again' => 'neues Passwort best�tigen',
        'err_curr_pass' => 'Derzeitiges Passwort ist verkehrt',
        'apply_modif' => '�nderungen speichern',
        'change_pass' => 'Mein Passwort �ndern',
        'update_success' => 'Dein Benutzerprofil wurde aktualisiert',
        'pass_chg_success' => 'Dein Passwort wurde ge�ndert',
        'pass_chg_error' => 'Dein Passwort wurde nicht ge�ndert',
        );

    $lang_register_confirm_email = <<<EOT
Danke f�r Deine Registrierung bei {SITE_NAME}

Dein Benutzername ist : "{USER_NAME}"
Dein Passwort lautet : "{PASSWORD}"

Um Dein Benutzerkonto zu aktivieren musst Du auf untenstehenden Link klicken
oder ihn kopieren und in der Adresszeile Deines Browsers einf�gen.
{ACT_LINK}

Gr�sse,

Das Team von {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Kommentare bearbeiten',
        'no_comment' => 'keine zu bearbeitenden Kommentare vorhanden',
        'n_comm_del' => '%s Kommentar(e) gel�scht',
        'n_comm_disp' => 'Anzahl anzuzeigende Kommentare',
        'see_prev' => 'vorherigen anzeigen',
        'see_next' => 'n�chsten anzeigen',
        'del_comm' => 'markierte Kommentare l�schen',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Bildersammlung durchsuchen',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'neue Bilder suchen',
        'select_dir' => 'W�hle Verzeichnis',
        'select_dir_msg' => 'Diese Funktion erm�glicht, mehrere Bilder der Galerie hinzuzuf�gen, die mit einem FTP-Programm schon auf Deine Webseite hochgeladen wurden.<br /><br />W�hle das Verzeichnis, in das Du die Bilder hochgeladen hast',
        'no_pic_to_add' => 'Kein Bild zum Hinzuf�gen gefunden',
        'need_one_album' => 'Du brauchst mindestens ein Album, um dieses Funktion auszuf�hren',
        'warning' => 'Achtung',
        'change_perm' => 'das Skript kann in dieses Verzeichnis nicht schreiben, Du musst die Lese-/Schreibberechtigung (chmod) auf 755 oder 777 setzen, bevor Du versuchst, Bilder hinzuzuf�gen!',
        'target_album' => '<strong>Bilder aus dem Verzeichnis &quot;</strong>%s<strong>&quot; in </strong>%s ablegen',
        'folder' => 'Verzeichnis',
        'image' => 'Bild',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Verzeichnis nicht beschreibbar. ',
        'dir_cant_read' => 'Verzeichnis nicht lesbar. ',
        'insert' => 'F�ge neue Bilder der Galerie hinzu',
        'list_new_pic' => 'Liste neuer Bilder',
        'insert_selected' => 'Markierte Bilder einf�gen',
        'no_pic_found' => 'Keine neuen Bilder gefunden',
        'be_patient' => 'Bitte Geduld, das Skript brauchst Zeit, um die Bilder hinzuzuf�gen',
        'notes' => '<ul>' . '<li><strong>OK</strong> : bedeuted, da� das Bild erfolgreich hinzugef�gt wurde' . '<li><strong>DP</strong> : bedeutet, da� das Bild ein Duplikat ist und schon in der Datenbank vorhanden ist' . '<li><strong>PB</strong> : bedeutet, da� das Bild nicht hinzugef�gt werden konnte; �berpr�fe Deine Einstellungen und die Berechtigungen der Verzeichnisse, in dem die Bilder liegen' . '<li>Falls die OK, DP, PB \'Zeichen\' nicht erscheinen klicke auf die nicht-funktionierenden Bilder, um die Fehlermeldungen von PHP zu sehen' . '<li>Wenn Dein Browser in ein Timeout l�uft, klicke auf die Aktualisieren-Schaltfl�che' . '</ul>',
        'select_album' => 'Album Ausw�hlen', // new in nuke
        'no_album' => 'Es wurde kein Album Name ausgew�hlt, geh zur�ck und gebe ein Album Name an',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Bild hochladen',
        'max_fsize' => 'Maximal zul�ssige Dateigr�sse ist %s KB',
        'album' => 'Album',
        'picture' => 'Bild',
        'pic_title' => 'Bild-Titel',
        'description' => 'Picture description',
        'keywords' => 'Stichworte (Trennung mit Leerzeichen)',
        'err_no_alb_uploadables' => 'Leider gibt es kein Album, in das Du Bilder hochladen darfst',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Benutzer verwalten',
        'name_a' => 'Name aufsteigend',
        'name_d' => 'Name absteigend',
        'group_a' => 'Gruppe aufsteigend',
        'group_d' => 'Gruppe absteigend',
        'reg_a' => 'Registrierungsdatum aufsteigend',
        'reg_d' => 'Registrierungsdatum absteigend',
        'pic_a' => 'Bilderanzahl aufsteigend',
        'pic_d' => 'Bilderanzahl absteigend',
        'disku_a' => 'Speicherplatz-Verbrauch aufsteigend',
        'disku_d' => 'Speicherplatz-Verbrauch absteigend',
        'sort_by' => 'Benutzer sortieren nach',
        'err_no_users' => 'Benutzer-Tabelle ist leer!',
        'err_edit_self' => 'Du kannst Dein eigenes Profil hier nicht bearbeiten, benutze daf�r den Link \'mein Profil\'',
        'edit' => 'bearbeiten',
        'delete' => 'l�schen',
        'name' => 'Benutzername',
        'group' => 'Gruppe',
        'inactive' => 'Inaktiv',
        'operations' => 'Operationen',
        'pictures' => 'Bilder',
        'disk_space' => 'Speicherplatzverbrauch / Quota',
        'registered_on' => 'Registriert am',
        'u_user_on_p_pages' => '%d Benutzer auf %d Seite(n)',
        'confirm_del' => 'Willst Du diesen Benutzer wirklich L�SCHEN? \\nAlle seine Bilder und Alben werden ebenfalls gel�scht.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Gew�hlter Benutzer existiert nicht!',
        'modify_user' => 'Benutzer �ndern',
        'notes' => 'Anmerkungen',
        'note_list' => '<li>Wenn Du das derzeitige Passwort nicht �ndern willst, lasse das Feld "Passwort" leer',
        'password' => 'Passwort',
        'user_active_cp' => 'Benutzer ist aktiv', // different var in cpg1.2.0nuke
        'user_group_cp' => 'Benutzergruppe', // different var in cpg1.2.0nuke
        'user_email' => 'E-Mail Adresse des Benutzers',
        'user_web_site' => 'Webseite des Benutzers',
        'create_new_user' => 'neuen Benutzer anlegen',
        'user_from' => 'Ort des Benutzers', // different var in cpg1.2.0nuke
        'user_interests' => 'Hobbies des Benutzers',
        'user_occ' => 'Beruf des Benutzers', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Bildgr��e �ndern',
        'what_it_does' => 'Was es macht',
        'what_update_titles' => 'Aktualisierung des titels vom Dateinamen',
        'what_delete_title' => 'L�sche Titel',
        'what_rebuild' => 'Erstelle neue Thumbnails und gr��enver�nderte Bilder',
        'what_delete_originals' => 'L�sche die Original Bilder und ersetze sie mit den Gr��enver�nderten',
        'file' => 'Datei',
        'title_set_to' => '�ndere den Titel in',
        'submit_form' => 'Absenden',
        'updated_succesfully' => 'Update Erfolgreich',
        'error_create' => 'Fehler beim Erstellen',
        'continue' => 'Verarbeiten Sie mehr Bilder',
        'main_success' => 'Diese Datei %s wurde erfolgreich als Hauptbild gew�hlt',
        'error_rename' => 'Fehler beim Umbenennen von %s zu %s',
        'error_not_found' => 'Die Datei %s wurde nicht gefunden',
        'back' => 'Zur�ck zur Hauptseite',
        'thumbs_wait' => 'Aktualisierung der Thumbnails und gr��enver�nderte Bilder, Bitte warten...',
        'thumbs_continue_wait' => 'Fortsetzung der Aktualisierung der Thumbnails und gr��enver�nderte Bilder, Bitte warten...',
        'titles_wait' => 'Aktualisierung der Titel, Bitte warten...',
        'delete_wait' => 'L�sche Titel, Bitte warten...',
        'replace_wait' => 'L�sche Original Bilder und ersetze sie mit den gr��enver�nderte Bilder, Bitte warten..',
        'instruction' => 'Schnelle Anweisungen',
        'instruction_action' => 'Aktion ausw�hlen',
        'instruction_parameter' => 'Parameter einstellen',
        'instruction_album' => 'Album ausw�hlen',
        'instruction_press' => 'Dr�cke %s',
        'update' => 'Aktualisiere Thumbnails und gr��enver�nderte Bilder',
        'update_what' => 'Was soll aktualisiert werden',
        'update_thumb' => 'Nur Thumbnails',
        'update_pic' => 'Nur gr��enver�nderte Bilder',
        'update_both' => 'Thumbnails und gr��enver�nderte Bilder',
        'update_number' => 'Anzahl der bearbeiten Bilder pro Klick',
        'update_option' => '(Versuchen Sie, diese Wahl niedriger einzustellen, wenn Sie TIMEOUTPROBLEME haben)',
        'filename_title' => 'Dateiname &rArr; Bild Titel',
        'filename_how' => 'Wie soll der Dateiname ge�ndert werden',
        'filename_remove' => 'Entferne die .jpg endung und ersetze sie mit _ (underscore) mit Leerzeichen',
        'filename_euro' => '�ndere 2003_11_23_13_20_20.jpg in 23/11/2003 13:20',
        'filename_us' => '�ndere 2003_11_23_13_20_20.jpg in 11/23/2003 13:20',
        'filename_time' => '�ndere 2003_11_23_13_20_20.jpg in 13:20',
        'delete' => 'Delete picture titles or original size photos',
        'delete_title' => 'L�sche Bild Titel',
        'delete_original' => 'L�sche Original Bilder',
        'delete_replace' => 'L�sche die Original Bilder und ersetze sie mit den Gr��enver�nderten',
        'select_album' => 'Album ausw�hlen',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'Bilder anschauen',
    'usr' => "'s Bild Gallery",
    'photogallery' => 'Bild Gallery',
    );

?>