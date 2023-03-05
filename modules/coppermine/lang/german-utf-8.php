<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002  Grégory DEMAR <gdemar@wanadoo.fr>                    //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
// http://www.stoverud.com/PHPhotoalbum/                                    //
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
// Translation by Joachim M&uuml;ller <mail@gaugau.de>                      //
// http://gaugau.de/                                                        //
// ------------------------------------------------------------------------- //
define('PIC_VIEWS', 'Angesehen');
define('PIC_VOTES', 'Bewertungen');
define('PIC_COMMENTS', 'Kommentare');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'German', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Deutsch', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '????????' or 'Espa&ntilde;ol'
    'lang_country_code' => 'de', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'GauGau', // the name of the translator - can be a nickname
    'trans_email' => 'mail@gaugau.de', // translator's email address (optional)
    'trans_website' => 'http://gaugau.de/', // translator's website (optional)
    'trans_date' => '2003-11-20', // the date the translation was created / last modified
    );

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'kB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
$lang_month = array('Januar', 'Februar', 'M&auml;rz', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
// Some common strings
$lang_yes = 'Ja';
$lang_no = 'Nein';
$lang_back = 'zur&uuml;ck';
$lang_continue = 'weiter';
$lang_info = 'Information';
$lang_error = 'Fehler';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d.%B %Y';
$lastcom_date_fmt = '%d.%m.%y um %H:%M';
$lastup_date_fmt = '%d.%B %Y';
$register_date_fmt = '%d.%B %Y';
$lasthit_date_fmt = '%d.%B %Y um %H:%M';
$comment_date_fmt = '%d.%B %Y um %H:%M';
// For the word censor
$lang_bad_words = array('*fuck*', '*fick*', '*arsch*', 'hure*', 'nutte', 'fotze', 'm&ouml;se', 'scheiss*', 'scheiß*', 'motherfucker', 'nigger*', 'pussy', 'shit', 'slut', 'titties', 'titty');

$lang_meta_album_names = array('random' => 'Zufalls-Bilder',
    'lastup' => 'Neueste Bilder',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Zuletzt aktualisierte Alben',
    'lastcom' => 'Neueste Kommentare',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Am meisten angesehen',
    'toprated' => 'Am besten bewertet',
    'lasthits' => 'Zuletzt angesehen',
    'search' => 'Suchergebnisse',
    'favpics' => 'Bevorzugte Bilder'

    );

$lang_errors = array('access_denied' => 'Du hast kein Recht, diese Seite einzusehen.',
    'perm_denied' => 'Du hast nicht das Recht, diese Operation auszuf&uuml;hren.',
    'param_missing' => 'Das Skript wurde ohne den/die erfordlichen Parameter aufgerufen.',
    'non_exist_ap' => 'Das gew&auml;hlte Album bzw. Bild existiert nicht!',
    'quota_exceeded' => 'Speicherplatz ersch&ouml;pft<br /><br />Du hast ein Speicherlimit von [quota]K, Deine Bilder belegen zu Zeit [space] kB, das Hinzuf&uuml;gen dieses Bildes w&uuml;rde Deinen Speicherplatz &uuml;berschreiten.',
    'gd_file_type_err' => 'Bei Verwendung der GD-Bibliothek sind nur die Dateitypen JPG und PNG erlaubt.',
    'invalid_image' => 'Das Bild, das Du hochgeladen hast ist besch&auml;digt oder kann nicht von der GD-Bibliothek verarbeitet werden',
    'resize_failed' => 'Kann Thumbnail nicht erzeugen.',
    'no_img_to_display' => 'Kein Bild zum Anzeigen vorhanden (oder Du hast keine Berechtigung, das Album ein zu sehen)',
    'non_exist_cat' => 'Die gew&auml;hlte Kategorie existiert nicht',
    'orphan_cat' => 'Eine Kategorie besitzt ein nicht-existierendes Eltern-Element, benutze den Kategorie-Manager um das Problem zu beheben.',
    'directory_ro' => 'Das Verzeichnis \'%s\' ist nicht beschreibbar, die Bilder k&ouml;nnen nicht gel&ouml;scht werden',
    'non_exist_comment' => 'Der gew&auml;hlte Kommentar existiert nicht.',
    'pic_in_invalid_album' => 'Das Bild befindet sich in einem nicht-existierenden Album (%s)!?',
    'banned' => 'Du bist zur Zeit von dieser Seite verbannt.',

    'not_with_udb' => 'Diese Funktion ist innerhalb Coppermine deaktiviert, weil Sie in die Forum-Software integriert ist. Entweder wird das, was Du gerade zu tun versucht hast in dieser Konfiguration nicht unterst&uuml;tzt oder die Funktion sollte von der Forum-Software &uuml;bernommen werden.',

    'members_only' => 'Diese Funktion ist nur f&uuml;r Mitglieder, bitte anmelden.', // changed in cpg1.2.0 nuke
    'mustbe_god' => 'Diese Funktion ist nur f&uuml;r die Adminseite. Du solltest als Superadmin, Gott einloggen um diese Funktion benutzen zu k&ouml;nnen'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Gehe zur Alben-&Uuml;bersicht',
    'alb_list_lnk' => 'Alben-&Uuml;bersicht',
    'my_gal_title' => 'Zu meiner pers&ouml;nlichen Galerie',
    'my_gal_lnk' => 'Meine Galerie',
    'my_prof_lnk' => 'Mein Profil',
    'adm_mode_title' => 'Zum Admin-Modus schalten',
    'adm_mode_lnk' => 'Admin-Modus',
    'usr_mode_title' => 'Zum Benutzer-Modus schalten',
    'usr_mode_lnk' => 'Benutzer-Modus',
    'upload_pic_title' => 'Bild in ein Album hochladen',
    'upload_pic_lnk' => 'Bild hochladen',
    'register_title' => 'Konto erzeugen',
    'register_lnk' => 'Registrieren',
    'login_lnk' => 'Anmelden',
    'logout_lnk' => 'Abmelden',
    'lastup_lnk' => 'Neueste Uploads',
    'lastcom_lnk' => 'Neueste Kommentare',
    'topn_lnk' => 'Am meisten angesehen',
    'toprated_lnk' => 'Am besten bewertet',
    'search_lnk' => 'Suche',
    'fav_lnk' => 'Meine Favoriten',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Upload-Best&auml;tigung',
    'config_lnk' => 'Einstellungen',
    'albums_lnk' => 'Alben',
    'categories_lnk' => 'Kategorien',
    'users_lnk' => 'Benutzer',
    'groups_lnk' => 'Gruppen',
    'comments_lnk' => 'Kommentare', // changed in cpg1.2.0 nuke
    'searchnew_lnk' => 'Batch-hinzuf&uuml;gen',
    'util_lnk' => 'Gr&ouml;sse &auml;ndern',

    'ban_lnk' => 'Benutzer verbannen',

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

$lang_thumb_view = array('date' => 'DATUM',
    'name' => 'Dateiname',
    'title' => 'Titel',
    'sort_da' => 'aufsteigend nach Datum sortieren',
    'sort_dd' => 'absteigend nach Datum sortieren',
    'sort_na' => 'austeigend nach Name sortieren',
    'sort_nd' => 'absteigend nach Name sortieren',
    'sort_ta' => 'aufsteigend nach Titel sortieren',
    'sort_td' => 'absteigend nach Titel sortieren',
    'pic_on_page' => '%d Bilder auf %d Seite(n)',
    'user_on_page' => '%d Benutzer auf %d Seite(n)',
    'sort_ra' => 'aufsteigend nach Bewertung',
    'sort_rd' => 'absteigend nach Bewertung',
    'rating' => 'BEWERTUNG',
    'sort_title' => 'Sortiere Bilder nach:',
    );

$lang_img_nav_bar = array('thumb_title' => 'zur&uuml;ck zur Fingerabdruck-Seite',
    'pic_info_title' => 'Bildinformationen anzeigen/verbergen',
    'slideshow_title' => 'Diashow',
    'ecard_title' => 'Bild als eCard versenden',
    'slideshow_disabled' => 'Bilddurchlauf Funktion ist ausgeschaltet',
    'slideshow_disabled_msg' => $lang_errors['members_only'],
    'ecard_disabled' => 'eCards sind deaktiviert',
    'ecard_disabled_msg' => 'Du hast nicht das Recht, eCards zu versenden',
    'prev_title' => 'vorheriges Bild anzeigen',
    'next_title' => 'n&auml;chstes Bild anzeigen',
    'pic_pos' => 'Bild %s/%s',
    'no_more_images' => 'Es sind in der Gallerie keine Bilder mehr vorhanden',
    'no_less_images' => 'Dies ist das erste Bild der Gallerie',
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
    'filesize' => 'Dateigr&ouml;sse : ',
    'dimensions' => 'Abmessungen : ',
    'date_added' => 'hinzugef&uuml;gt am : '
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
        'Very Happy' => 'sehr gl&uuml;cklich',
        'Smile' => 'lachen',
        'Sad' => 'traurig',
        'Surprised' => '&uuml;berrascht',
        'Shocked' => 'schockiert',
        'Confused' => 'verwirrt',
        'Cool' => 'cool',
        'Laughing' => 'lachend',
        'Mad' => 'w&uuml;tend',
        'Razz' => 'scheu',
        'Embarassed' => 'sch&uuml;chtern',
        'Crying or Very sad' => 'traurig',
        'Evil or Very Mad' => 'b&ouml;se',
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
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Alben m&uuml;ssen einen Namen haben!',
        'confirm_modifs' => 'Bist Du sicher, dass Du diese &Auml;nderungen durchf&uuml;hren willst?',
        'no_change' => 'Du hast nichts ver&auml;ndert!',
        'new_album' => 'Neues Album',
        'confirm_delete1' => 'Willst Du dieses Album wirklich l&ouml;schen?',
        'confirm_delete2' => '\nAlle Bilder und Kommentare, die darin enthalten sind werden gel&ouml;scht!',
        'select_first' => 'W&auml;hle zuerst ein Album',
        'alb_mrg' => 'Alben-Manager',
        'my_gallery' => '* Meine Galerie *',
        'no_category' => '* Keine Kategorie *',
        'delete' => 'L&ouml;schen',
        'new' => 'Neu',
        'apply_modifs' => '&Auml;nderungen &uuml;bernehmen',
        'select_category' => 'W&auml;hle Kategorie',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Fehlender Parameter f&uuml;r die Operation \'%s\' !',
        'unknown_cat' => 'Gew&auml;hlte Kategorie existiert nicht in Datenbank',
        'usergal_cat_ro' => 'Benutzer-Galerie kann nicht gel&ouml;scht werden!',
        'manage_cat' => 'Kategorien verwalten',
        'confirm_delete' => 'Willst Du diese Kategorie wirklich L&Ouml;SCHEN',
        'category' => 'Kategorie',
        'operations' => 'Operationen',
        'move_into' => 'verschieben in',
        'update_create' => 'Kategorie erzeugen/&auml;ndern',
        'parent_cat' => 'Eltern-Kategorie',
        'cat_title' => 'Titel der Kategorie',
        'cat_desc' => 'Beschreibung Kategorie',
        'no_category' => 'keine Kategorie'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Einstellungen',
        'restore_cfg' => 'auf Werkseinstellungen zur&uuml;cksetzen',
        'save_cfg' => 'neue Einstellungen speichern',
        'notes' => 'Anmerkungen',
        'info' => 'Information',
        'upd_success' => 'Die Einstellungen von Coppermine wurden aktualisiert',
        'restore_success' => 'Coppermine Standard-Einstellungen wiederhergestellt',
        'name_a' => 'aufsteigend nach Name',
        'name_d' => 'absteigend nach Name',
        'title_a' => 'aufsteigend nach Titel',
        'title_d' => 'absteigend nach Titel',
        'date_a' => 'aufsteigend nach Datum',
        'date_d' => 'absteigend nach Datum',
        'rating_a' => 'Beurteiliung aufsteigend',
        'rating_d' => 'Beurteilung absteigend',
        'th_any' => 'Maximalwert (entweder H&ouml;he oder Breite)',
        'th_ht' => 'H&ouml;he',
        'th_wd' => 'Breite',
        );

if (defined('CONFIG_PHP')) $lang_config_data = array('Allgemeine Einstellungen',
        array('Galerie-Name', 'gallery_name', 0),
        array('Galerie Beschreibung', 'gallery_description', 0),
        array('Galerie-Admin E-Mail', 'gallery_admin_email', 0),
        array('Ziel-URL (http://www.ihreseite.de) um  \'mehr Bilder ansehen\' Link in e-cards', 'ecards_more_pic_target', 0),
        array('Sprache', 'lang', 5),
        // array('Sprachauswahl aktivieren', 'lang_select_enable', 8),
// for postnuke change
        array('Design', 'cpgtheme', 6),
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // array('Theme-Auswahl durch Benutzer aktivieren', 'theme_select_enable', 8),
        'Ansicht Albumliste',
        array('Breite der Haupttabelle (in Pixel oder %)', 'main_table_width', 0),
        array('Anzahl anzuzeigende Kategorie-Ebenen', 'subcat_level', 0),
        array('Anzahl anzuzeigende Alben', 'albums_per_page', 0),
        array('Anzahl Spalten in Album-Liste', 'album_list_cols', 0),
        array('Fingerabdruck-Gr&ouml;sse in Pixel', 'alb_list_thumb_size', 0),
        array('Inhalt der Hauptseite', 'main_page_layout', 0),
        array('Erste Ebene des Fingerabdruck der Alben auch in Kategorien anzeigen', 'first_level', 1),

        'Ansicht Fingerabdruck',
        array('Spaltenzahl auf Fingerabdruck-Seite', 'thumbcols', 0),
        array('Zeilenzahl auf Fingerabdruck-Seite', 'thumbrows', 0),
        array('Anzahl maximal anzuzeigende Tabs', 'max_tabs', 0),
        array('Bild-Beschriftung anzeigen (zus&auml;tzlich zum Bild-Titel) unterhalb des Fingerabdruck', 'caption_in_thumbview', 1),
        array('Anzahl der Kommentare unterhalb des Fingerabdruck anzeigen', 'display_comment_count', 1),
        array('Standard-Sortierung f&uuml;r Bilder', 'default_sort_order', 3),
        array('Mindestmenge Stimmen, die ein Bild ben&ouml;tigt, um in der \'am besten bewertet\' Liste zu erscheinen', 'min_votes_for_rating', 0),
        array('Seitenspezifische Titel benutzen, nicht die von > Coppermine', 'nice_titles', 1),

        'Ansicht Bild &amp; Einstellungen Kommentare',
        array('Tabellenbreite f&uuml;r Bildanzeige (in Pixel oder %)', 'picture_table_width', 0),
        array('Bildinformationen sind standardm&auml;ßig sichtbar', 'display_pic_info', 1),
        array('Schimpfw&ouml;rter in Kommentaren zensieren', 'filter_bad_words', 1),
        array('Smilies in Kommentaren erlauben', 'enable_smilies', 1),
        array('Erlauben von mehreren Kommentaren zu einem Bild von einem Mittglied', 'disable_flood_protection', 1),
        array('E-mail zum Administrator wenn neus Bild empfangen ist' , 'comment_email_notification', 1),
        array('Maximall&auml;nge f&uuml;r Bildbeschreibung', 'max_img_desc_length', 0),
        array('Maximale Anzahl von Buchstaben in einem Wort', 'max_com_wlength', 0),
        array('Maximale Zeilenzahl eines Kommentars', 'max_com_lines', 0),
        array('Maximale L&auml;nge eines Kommentars', 'max_com_size', 0),
        array('Film-Streifen anzeigen', 'display_film_strip', 1),
        array('Anzahl Elemente in Film-Streifen', 'max_film_strip_items', 0),
        array('Vollbild anzeigen f&uuml;r unregistrierten Betutzer', 'allow_anon_fullsize', 1),
		array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
       // 'Pictures and thumbnails settings',
	           'Bild- und Fingerabdruck-Einstellungen',
        array('Qualit&auml;t f&uuml;r JPEG-Dateien', 'jpeg_qual', 0),
        array('Welche Dimension soll genutzt werden f&uuml;r den Fingerabdruck ( Breite oder H&ouml;he oder das, was jeweils gr&ouml;sser ist)<strong>*</strong>', 'thumb_use', 7),

        array('Maximale H&ouml;he oder Breite vom Fingerabdruck <strong>*</strong>', 'thumb_width', 0),
        array('Bilder in Zwischengr&ouml;ße erzeugen', 'make_intermediate', 1),
        array('Maximale Breite oder H&ouml;he von Bildern in Zwischengr&ouml;ße <strong>*</strong>', 'picture_width', 0),
        array('Maximalgr&ouml;ße f&uuml;r das Hochladen von Bildern (KB)', 'max_upl_size', 0),
        array('Maximale Breite oder H&ouml;he f&uuml;r das Hochladen von Bildern (in Pixel)', 'max_upl_width_height', 0),

        'Benutzer-Einstellungen',
        array('Registrierung von Benutzern zulassen', 'allow_user_registration', 1),
        array('Registrierung von Benutzern erfordert &Uuml;berpr&uuml;fung per E-Mail', 'reg_requires_valid_email', 1),
        array('Zulassen, daß mehrere Benutzer die gleiche E-Mail Adresse haben', 'allow_duplicate_emails_addr', 1),
        array('Benutzer d&uuml;rfen Privatalbum anlegen', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Benutzerdefinierte Felder f&uuml;r zus&auml;tzliche Bildinformationen (leer lassen, falls nicht ben&ouml;tigt)',
        array('Name Feld 1', 'user_field1_name', 0),
        array('Name Feld 2', 'user_field2_name', 0),
        array('Name Feld 3', 'user_field3_name', 0),
        array('Name Feld 4', 'user_field4_name', 0),

        'Erweiterte Bild- und Fingerabdruck-Einstellungen',
        array('Icons f&uuml;r Pers&ouml;nliche Alben nicht eingeloggten Benutzern anzeigen?', 'show_private', 1),
        array('Nicht erlaubte Zeichen in Dateinamen', 'forbiden_fname_char', 0),
        array('erlaubte Datei-Erweiterungen f&uuml;r das Hochladen von Bildern', 'allowed_file_extensions', 0),
        array('Methode zur Gr&ouml;ßen&auml;nderung von Bildern', 'thumb_method', 2),
        array('Pfad zur \'convert\' Anwendung von ImageMagick (z.B. /usr/bin/X11/)', 'impath', 0),
        array('Erlaubte Datei-Typen (nur g&uuml;ltig f&uuml;r ImageMagick)', 'allowed_img_types', 0),
        array('Kommandozeilen-Parameter f&uuml;r ImageMagick', 'im_options', 0),
        array('EXIF-Daten in JPEG-Dateien lesen', 'read_exif_data', 1),
        array('Lese IPTC Daten aus JPEG Bildern', 'read_iptc_data', 1),
        array('Alben-Verzeichnis <strong>*</strong>', 'fullpath', 0),
        array('Verzeichnis f&uuml;r Benutzer-Bilder <strong>*</strong>', 'userpics', 0),
        array('Vorsilbe f&uuml;r Bilder in Zwischengr&ouml;ße <strong>*</strong>', 'normal_pfx', 0),
        array('Vorsilbe f&uuml;r den Fingerabdruck <strong>*</strong>', 'thumb_pfx', 0),
        array('Standard-Modus f&uuml;r Verzeichnisse', 'default_dir_mode', 0),
        array('Standard-Modus f&uuml;r Bilder', 'default_file_mode', 0),
        array('Bildinfo anzeigen Datei-Name', 'picinfo_display_filename', '1'),
        array('Bildinfo anzeigen Album-Name', 'picinfo_display_album_name', '1'),
        array('Bildinfo anzeigen Datei-Gr&ouml;ße', 'picinfo_display_file_size', '1'),
        array('Bildinfo anzeigen Dimensionen', 'picinfo_display_dimensions', '1'),
        array('Bildinfo anzeigen Wiedergabe-Z&auml;hler', 'picinfo_display_count_displayed', '1'),
        array('Bildinfo anzeigen URL', 'picinfo_display_URL', '1'),
        array('Bildinfo anzeigen URL als Favorit', 'picinfo_display_URL_bookmark', '1'),
        array('Bildinfo anzeigen favorisiertes Album', 'picinfo_display_favorites', '1'),

        'Cookies &amp; Zeichensatz-Einstellungen',
        array('Cookie-Name, der vom Skript verwendet wird', 'cookie_name', 0),
        array('Cookie-Pfad', 'cookie_path', 0),
        array('Zeichensatz', 'charset', 4),

        'Verschiedene Einstellungen',
        array('Debug-Modus ein', 'debug_mode', 1),
        array('Einschalten ausf&uuml;hrlicher Debug-Modus', 'advanced_debug_mode', 1),
        array('Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Felder, die mit * gekennzeichnet sind d&uuml;rfen nicht ge&auml;ndert werden, wenn sich schon Bilder in der Galerie befinden!</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Du musst Deinen Namen und einen Kommentar eingeben',
        'com_added' => 'Dein Kommentar wurde hinzugef&uuml;gt',
        'alb_need_title' => 'Du musst einen Titel f&uuml;r das Album eingeben!',
        'no_udp_needed' => 'Keine Aktualisierung notwendig.',
        'alb_updated' => 'Das Album wurde aktualisiert',
        'unknown_album' => 'Das gew&auml;hlte Album existiert nicht oder Du hast keine Berechtigung, Bilder in dieses Album hochzuladen',
        'no_pic_uploaded' => 'Es wurde kein Bild hochgeladen!<br /><br />Wenn Du tats&auml;chlich ein Bild zum Hochladen selektiert hast, &uuml;berpr&uuml;fe ob Dein Server das Hochladen von Dateien zul&auml;sst...',
        'err_mkdir' => 'Verzeichnis %s konnte nicht angelegt werden!',
        'dest_dir_ro' => 'In das Zielverzeichnis %s kann vom Skript nicht geschrieben werden!',
        'err_move' => '%s kann nicht nach %s verschoben werden!',
        'err_fsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu groß (maximal zul&auml;ssig ist %s x %s) !',
        'err_imgsize_too_large' => 'Die Datei, die Du hochgeladen hast ist zu groß (maximal zul&auml;ssig ist %s KB) !',
        'err_invalid_img' => 'Die Datei, die Du hochgeladen hast ist kein g&uuml;ltiger Bildtyp!',
        'allowed_img_types' => 'Du kannst nur %s Bilder hochladen.',
        'err_insert_pic' => 'Das Bild \'%s\' kann nicht in das Album eingef&uuml;gt werden',
        'upload_success' => 'Dein Bild wurde erfolgreich hochgeladen.<br /><br />Es wird nach der Best&auml;tigung durch den Admin sichtbar sein.',
        'info' => 'Information',
        'com_added' => 'Kommentar hinzugef&uuml;gt',
        'alb_updated' => 'Album aktualisiert',
        'err_comment_empty' => 'Dein Kommentar enth&auml;lt keine Zeichen!',
        'err_invalid_fext' => 'Nur Dateien mit den folgenden Erweiterungen sind zul&auml;ssig: <br /><br />%s.',
        'no_flood' => 'Leider bist Du schon der Autor des letzten Kommentars zu diesem Bild<br /><br />Bearbeite Deinen bestehenden Kommentar, wenn Du ihn ver&auml;ndern willst',
        'redirect_msg' => 'Du wirst weitergeleitet.<br /><br /><br />Klicke \'weiter\', falls die Seite sich nicht automatisch aktualisiert',
        'upl_success' => 'Dein Bild wurde erfolgreich hinzugef&uuml;gt',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => '&Uuml;berschrift',
        'fs_pic' => 'Bild in Originalgr&ouml;ße',
        'del_success' => 'erfolgreich gel&ouml;scht',
        'ns_pic' => 'normal grosses Bild',
        'err_del' => 'kann nicht gel&ouml;scht werden',
        'thumb_pic' => 'Fingerabdruck',
        'comment' => 'Kommentar',
        'im_in_alb' => 'Bild in Album',
        'alb_del_success' => 'Album \'%s\' gel&ouml;scht',
        'alb_mgr' => 'Alben-Manager',
        'err_invalid_data' => 'Ung&uuml;ltige Daten empfangen in \'%s\'',
        'create_alb' => 'Erzeuge Album \'%s\'',
        'update_alb' => 'Aktualisiere Album \'%s\' mit Titel \'%s\' und Index \'%s\'',
        'del_pic' => 'Bild l&ouml;schen',
        'del_alb' => 'Album l&ouml;schen',
        'del_user' => 'Benutzer l&ouml;schen',
        'err_unknown_user' => 'Der gew&auml;hlte Benutzer ist nicht vorhanden!',
        'comment_deleted' => 'Kommentar wurde gel&ouml;scht',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Dieses Bild wirklich L&Ouml;SCHEN? \\nKommentare werden ebenfalls gel&ouml;scht.',
        'del_pic' => 'Dieses Bild L&ouml;schen',
        'edit_pic' => 'Dieses Bild bearbeiten',
        'size' => '%s x %s Pixel',
        'views' => '%s mal',
        'slideshow' => 'Diashow',
        'stop_slideshow' => 'Diashow anhalten',
        'view_fs' => 'Klicken f&uuml;r Bild in voller Gr&ouml;sse',
        'edit_pic' => 'Bearbeiten Bild-Info',
        );

    $lang_picinfo = array('title' => 'Bild-Information',
        'Filename' => 'Dateiname',
        'Album name' => 'Name des Albums',
        'Rating' => 'Bewertung (%s Stimmen)',
        'Keywords' => 'Stichworte',
        'File Size' => 'Dateigr&ouml;sse',
        'Dimensions' => 'Abmessungen',
        'Displayed' => 'Angezeigt',
        'Camera' => 'Kamera',
        'Date taken' => 'Aufnahmedatum',
        'Aperture' => 'Blende',
        'Exposure time' => 'Belichtungszeit',
        'Focal length' => 'Brennweite',
        'Comment' => 'Kommentar',
        'addFav' => 'zu Favoriten hinzuf&uuml;gen',

        'addFavPhrase' => 'Favoriten',

        'remFav' => 'aus Favoriten entfernen',

        'iptcTitle' => 'IPTC Titel',
        'iptcCopyright' => 'IPTC Copyright',
        'iptcKeywords' => 'IPTC Schl&uuml;sselworte',
        'iptcCategory' => 'IPTC Kategorie',
        'iptcSubCategories' => 'IPTC Unterkategorie(n)',
        'bookmark_page' => 'Bild favorisieren',
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Diesen Kommentar bearbeiten',
        'confirm_delete' => 'Willst Du diesen Kommentar wirklich l&ouml;schen?',
        'add_your_comment' => 'F&uuml;ge Deinen Kommentar hinzu',
        'name' => 'Name',
        'comment' => 'Kommentar',
        'your_name' => 'Dein Name',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Bild anklicken, um das Fenster zu schliessen!',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'eCard senden',
        'invalid_email' => '<strong>Achtung</strong> : ung&uuml;ltige E-Mail Adresse !',
        'ecard_title' => 'Eine eCard von %s f&uuml;r Dich',
        'view_ecard' => 'Falls diese eCard nicht korrekt angezeigt wird klicke auf den folgenden Link: ',
        'view_more_pics' => 'Klicke auf diesen Link, um mehr Bilder ansehen zu k&ouml;nnen!',
        'send_success' => 'Deine eCard wurde gesendet',
        'send_failed' => 'Leider kann der Server Deine eCard nicht versenden...',
        'from' => 'Von',
        'your_name' => 'Dein Name',
        'your_email' => 'Deine E-Mail Adresse',
        'to' => 'An',
        'rcpt_name' => 'Empf&auml;nger Name',
        'rcpt_email' => 'Empfanger E-Mail Adresse',
        'greetings' => 'Gr&uuml;sse',
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
        'pic_info_str' => '%sx%s - %sKB - %s x angesehen - %s x bewertet',
        'approve' => 'Bild genehmigen',
        'postpone_app' => 'Genehmigung verschieben',
        'del_pic' => 'Bild l&ouml;schen',
        'read_exif' => 'Auslesen der EXIF Daten wiederholen',
        'reset_view_count' => 'Z&auml;hler x mal angesehen auf Null setzen',
        'reset_votes' => 'Anzahl Stimmen auf Null setzen',
        'del_comm' => 'Kommentare l&ouml;schen',
        'upl_approval' => 'Genehmigung zum Hochladen',
        'edit_pics' => 'Bilder bearbeiten',
        'see_next' => 'n&auml;chste Bilder ansehen',
        'see_prev' => 'vorherige Bilder ansehen',
        'n_pic' => '%s Bilder',
        'n_of_pic_to_disp' => 'Bilder pro Seite',
        'apply' => '&Auml;nderungen ausf&uuml;hren'
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
        'can_have_gallery' => 'Darf eine pers&ouml;nliche Galerie haben',
        'apply' => '&Auml;nderungen ausf&uuml;hren',
        'create_new_group' => 'Neue Gruppe erstellen',
        'del_groups' => 'ausgew&auml;hlte Gruppe(n) l&ouml;schen',
        'confirm_del' => 'Achtung: wenn Du eine Gruppe l&ouml;schst werden die dazu geh&ouml;renden Benutzer in die Gruppe \'Registrierte Benutzer\' Verschoben !\n\nWillst Du das ?',
        'title' => 'Benutzer-Gruppen verwalten',
        'approval_1' => '&Ouml;ffentl. Upload best. (1)',
        'approval_2' => 'Priv. Upload best. (2)',
        'note1' => '<strong>(1)</strong> Das Hochladen in ein &ouml;ffentliches Album muß durch den Admin best&auml;tigt werden',
        'note2' => '<strong>(2)</strong> Das Hochladen in ein privates Album muß durch den Admin best&auml;tigt werden',
        'notes' => 'Anmerkungen'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Startseite'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Willst Du dieses Album wirklich L&Ouml;SCHEN? \\nAlle darin befindlichen Bilder und Kommentare werden ebenfalls gel&ouml;scht.',
        'delete' => 'L&ouml;schen',
        'modify' => 'Eigenschaften',
        'edit_pics' => 'Bilder bearbeiten',
        );

    $lang_list_categories = array('home' => 'Galerie',
        'stat1' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben und <strong>[cat]</strong> Kategorien mit <strong>[comments]</strong> Kommentaren, <strong>[views]</strong> mal angesehen',
        'stat2' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben, <strong>[views]</strong> mal angesehen',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<strong>[pictures]</strong> Bilder in <strong>[albums]</strong> Alben mit <strong>[comments]</strong> Kommentaren, <strong>[views]</strong> mal angesehen'
        );

    $lang_list_users = array('user_list' => 'Benutzer-Liste',
        'no_user_gal' => 'Es gibt keine Benutzer, die eigene Alben haben d&uuml;rfen',
        'n_albums' => '%s Album/en',
        'n_pics' => '%s Bild(er)'
        );

    $lang_list_albums = array('n_pictures' => '%s Bilder',
        'last_added' => ', letzte Aktualisierung am %s'
        );
} 
// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
if (defined('LOGIN_PHP')) $lang_login_php = array('login' => 'Anmeldung (Login)',
        'enter_login_pswd' => 'Gib Deinen Benutzernamen und Dein Passwort ein, um Dich anzumelden',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'remember_me' => 'Immer angemeldet bleiben',
        'welcome' => 'Hallo %s ...',
        'err_login' => '*** Konnte Dich nicht anmelden. Versuche es nochmal ***',
        'err_already_logged_in' => 'Du bist schon angemeldet!',
        );
// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //
if (defined('LOGOUT_PHP')) $lang_logout_php = array('logout' => 'Abmelden',
        'bye' => 'Tsch&uuml;ss %s ...',
        'err_not_loged_in' => 'Du bist nicht angemeldet!',
        );
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Album %s aktualisieren',
        'general_settings' => 'Allgemeine Einstellungen',
        'alb_title' => 'Album Titel',
        'alb_cat' => 'Album Kategorie',
        'alb_desc' => 'Album Beschreibung',
        'alb_thumb' => 'Album Fingerabdruck',
        'alb_perm' => 'Berechtigungen f&uuml;r dieses Album',
        'can_view' => 'Album kann angesehen werden von',
        'can_upload' => 'Besucher k&ouml;nnen Bilder hochladen',
        'can_post_comments' => 'Besucher k&ouml;nnen Kommentare abgeben',
        'can_rate' => 'Besucher k&ouml;nnen Bilder bewerten',
        'user_gal' => 'Benutzer-Galerie',
        'no_cat' => '* keine Kategorie *',
        'alb_empty' => 'Album ist leer',
        'last_uploaded' => 'Letzes Bild, das hochgeladen wurde',
        'public_alb' => 'Jeder (&ouml;ffentliches Album)',
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
Obwohl die Administratoren von {SITE_NAME} versuchen werden, generell alle anst&ouml;ssigen Inhalte so schnell wie m&ouml;glich zu l&ouml;schen oder bearbeiten ist es unm&ouml;glich, jeden Beitrag zu &uuml;berpr&uuml;fen. Daher best&auml;tigst Du, dass alle Beitr&auml;ge auf dieser Seite die Ansichten und Meinungen des Authors widerspiegeln und nicht die des Administrators oder Webmasters (außer den Beitr&auml;gen, die durch sie verfasst wurden) und sie daher daf&uuml;r nicht verantwortlich gemacht werden k&ouml;nnen.<br />
<br />
Du stimmst zu, keine beleidigende, obsz&ouml;ne, vulg&auml;re, verleumderische, verhetzende,drohende, sexuell-orientierte oder sonstwie illegalen Beitr&auml;ge zu verfassen. Du stimmst zu, daß der/die Webmaster, Administrator(en) oder Moderator(en) von {SITE_NAME} das recht haben, jeden Inhalt zu l&ouml;schen oder &auml;ndern, bei dem sie es f&uuml;r richtig halten. Als Benutzer stimmst Du zu, daß alle Informationen, die Du oben eingetragen hast in einer Datenbank gespeichert werden. Obwohl diese Daten ohne Deine ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben werden k&ouml;nnen der Webmaster oder Administrator nicht daf&uuml;r zur Verantwortung gezogen werden, wenn durch einen Angriff (Hacking) die gespeicherten Daten kompromitiert werden.<br />
<br />
Diese Seite benutzt Cookies, um Daten auf Deinem Rechner zu speichern. Diese Cookies dienen nur dazu, die Bedienung der Seite zu erm&ouml;glichen. Die E-Mail Adresse wird nur dazu verwendet, die Registrierungs-Details und das Passwort zu best&auml;tigen.<br />
<br />
Durch das Anklicken von 'ich stimme zu' stimmst Du diesen Bedingungen zu.
EOT;

    $lang_register_php = array('page_title' => 'Benutzer-Registrierung',
        'term_cond' => 'Nutzungsbedingungen',
        'i_agree' => 'ich stimme zu',
        'submit' => 'Registrieren absenden',
        'err_user_exists' => 'Der Benutzername, den Du eingegeben hast existiert schon, bitte w&auml;hle einen anderen',
        'err_password_mismatch' => 'Die Passw&ouml;rter stimmen nicht &uuml;berein, bitte nochmals eingeben',
        'err_uname_short' => 'Der Benutzername muß mindestens 2 Zeichen lang sein',
        'err_password_short' => 'Das Passwort muß mindestens 2 Zeichen lang sein',
        'err_uname_pass_diff' => 'Benutzername und Passwort m&uuml;ssen unterschiedlich sein',
        'err_invalid_email' => 'E-Mail Adresse ist ung&uuml;ltig',
        'err_duplicate_email' => 'Es hat sich schon ein anderer Benutzer mit der angegebenen E-Mail Adresse registriert',
        'enter_info' => 'Gib Registrierungs-Informationen ein',
        'required_info' => 'Pflichtfeld',
        'optional_info' => 'Optional',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'password_again' => 'Passwort-Best&auml;tigung',
        'email' => 'E-Mail Adresse',
        'location' => 'Ort',
        'interests' => 'Hobbies',
        'website' => 'Homepage',
        'occupation' => 'Beruf',
        'error' => 'ERROR',
        'confirm_email_subject' => '%s - Registrierungs-Best&auml;tigung',
        'information' => 'Information',
        'failed_sending_email' => 'Die Registrierungs-best&auml;tigung kann nicht per E-Mail versendet werden!',
        'thank_you' => 'Danke f&uuml;r Deine Registrierung.<br /><br />Eine E-Mail mit Informationen, wie Du Dein Benutzerkonto aktivieren kannst wurde an die angegebene E-Mail Adresse gesendet.',
        'acct_created' => 'Dein Benutzerkonto wurde erstellt. Du kannst Dich jetzt mit Benutzername und passwort anmelden',
        'acct_active' => 'Dein Benutzerkonto ist jetzt aktiviert - Du kannst Dich mit Benutzername und Passwort anmelden',
        'acct_already_act' => 'Dein Benutzerkonto ist bereits aktiviert!',
        'acct_act_failed' => 'Dieses Benutzerkonto kann nicht aktiviert werden!',
        'err_unk_user' => 'Der gew&auml;hlte Benutzer existiert nicht!',
        'x_s_profile' => '%s\'s Benutzerprofil',
        'group' => 'Gruppe',
        'reg_date' => 'Registriert am',
        'disk_usage' => 'Speicherplatz-Verbrauch',
        'change_pass' => 'Passwort &auml;ndern',
        'current_pass' => 'derzeitiges Passwort',
        'new_pass' => 'neues Passwort',
        'new_pass_again' => 'neues Passwort best&auml;tigen',
        'err_curr_pass' => 'Derzeitiges Passwort ist verkehrt',
        'apply_modif' => '&Auml;nderungen speichern',
        'change_pass' => 'Mein Passwort &auml;ndern',
        'update_success' => 'Dein Benutzerprofil wurde aktualisiert',
        'pass_chg_success' => 'Dein Passwort wurde ge&auml;ndert',
        'pass_chg_error' => 'Dein Passwort wurde nicht ge&auml;ndert',
        );

    $lang_register_confirm_email = <<<EOT
Danke f&uuml;r Deine Registrierung bei {SITE_NAME}

Dein Benutzername ist : "{USER_NAME}"
Dein Passwort lautet : "{PASSWORD}"

Um Dein Benutzerkonto zu aktivieren musst Du auf untenstehenden Link klicken
oder ihn kopieren und in der Adresszeile Deines Browsers einf&uuml;gen.
{ACT_LINK}

Gr&uuml;sse,

Das Team von {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Kommentare bearbeiten',
        'no_comment' => 'keine zu bearbeitenden Kommentare vorhanden',
        'n_comm_del' => '%s Kommentar(e) gel&ouml;scht',
        'n_comm_disp' => 'Anzahl anzuzeigende Kommentare',
        'see_prev' => 'vorherigen anzeigen',
        'see_next' => 'n&auml;chsten anzeigen',
        'del_comm' => 'markierte Kommentare l&ouml;schen',
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
        'select_dir' => 'W&auml;hle Verzeichnis',
        'select_dir_msg' => 'Diese Funktion erm&ouml;glicht, mehrere Bilder der Galerie hinzuzuf&uuml;gen, die mit einem FTP-Programm schon auf Deine Webseite hochgeladen wurden.<br /><br />W&auml;hle das Verzeichnis, in das Du die Bilder hochgeladen hast',
        'no_pic_to_add' => 'Kein Bild zum Hinzuf&uuml;gen gefunden',
        'need_one_album' => 'Du brauchst mindestens ein Album, um dieses Funktion auszuf&uuml;hren',
        'warning' => 'Achtung',
        'change_perm' => 'das Skript kann in dieses Verzeichnis nicht schreiben, Du musst die Lese-/Schreibberechtigung (chmod) auf 755 oder 777 setzen, bevor Du versuchst, Bilder hinzuzuf&uuml;gen!',
        'target_album' => '<strong>Bilder aus dem Verzeichnis &quot;</strong>%s<strong>&quot; in </strong>%s ablegen',
        'folder' => 'Verzeichnis',
        'image' => 'Bild',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Verzeichnis nicht beschreibbar. ',
        'dir_cant_read' => 'Verzeichnis nicht lesbar. ',
        'insert' => 'F&uuml;ge neue Bilder der Galerie hinzu',
        'list_new_pic' => 'Liste neuer Bilder',
        'insert_selected' => 'Markierte Bilder einf&uuml;gen',
        'no_pic_found' => 'Keine neuen Bilder gefunden',
        'be_patient' => 'Bitte Geduld, das Skript braucht Zeit, um die Bilder hinzuzuf&uuml;gen',
        'notes' => '<ul>' . '<li><strong>OK</strong> : bedeuted, daß das Bild erfolgreich hinzugef&uuml;gt wurde' . '<li><strong>DP</strong> : bedeutet, daß das Bild ein Duplikat ist und schon in der Datenbank vorhanden ist' . '<li><strong>PB</strong> : bedeutet, daß das Bild nicht hinzugef&uuml;gt werden konnte; &uuml;berpr&uuml;fe Deine Einstellungen und die Berechtigungen der Verzeichnisse, in dem die Bilder liegen' . '<li>Falls die OK, DP, PB \'Zeichen\' nicht erscheinen klicke auf die nicht-funktionierenden Bilder, um die Fehlermeldungen von PHP zu sehen' . '<li>Wenn Dein Browser in ein Timeout l&auml;uft, klicke auf die Aktualisieren-Schaltfl&auml;che' . '</ul>',
        'select_album' => 'W&auml;hle ein Album', // new in nuke
        'no_album' => 'Es wurde kein Album ausgew&auml;hlt, gehe zur&uuml;ck um ein Album f&uuml;r die Bilder zu w&auml;hlen',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //
if (defined('BANNING_PHP')) $lang_banning_php = array('title' => 'Benutzer verbannen',
        'user_name' => 'Benutzername',
        'ip_address' => 'IP-Adresse',
        'expiry' => 'l&auml;ft ab (leer bedeutet &quot;f&uuml;r immer&quot;)',
        'edit_ban' => '&Auml;nderungen speichern',
        'delete_ban' => 'L&ouml;schen',
        'add_new' => 'Neuen Bann hinzuf&uuml;gen',
        'add_ban' => 'hinzuf&uuml;gen',
        );
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Bild hochladen',
        'max_fsize' => 'Maximal zul&auml;ssige Dateigr&ouml;sse ist %s KB. Es k&ouml;nnen nur .jpg und .png - Dateien hochgeladen werden',
        'album' => 'Album',
        'picture' => 'Bild',
        'pic_title' => 'Bild-Titel',
        'description' => 'Bild-Beschreibung',
        'caption' => 'Bild-Beschreibung',
        'keywords' => 'Stichworte (Trennung mit Komma)',
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
        'err_edit_self' => 'Du kannst Dein eigenes Profil hier nicht bearbeiten, benutze daf&uuml;r den Link \'mein Profil\'',
        'edit' => 'bearbeiten',
        'delete' => 'l&ouml;schen',
        'name' => 'Benutzername',
        'group' => 'Gruppe',
        'inactive' => 'Inaktiv',
        'operations' => 'Operationen',
        'pictures' => 'Bilder',
        'disk_space' => 'Speicherplatzverbrauch / Quota',
        'registered_on' => 'Registriert am',
        'u_user_on_p_pages' => '%d Benutzer auf %d Seite(n)',
        'confirm_del' => 'Willst Du diesen Benutzer wirklich L&Ouml;SCHEN? \\nAlle seine Bilder und Alben werden ebenfalls gel&ouml;scht.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Gew&auml;hlter Benutzer existiert nicht!',
        'modify_user' => 'Benutzer &auml;ndern',
        'notes' => 'Anmerkungen',
        'note_list' => '<li>Wenn Du das derzeitige Passwort nicht &auml;ndern willst, lasse das Feld "Passwort" leer',
        'password' => 'Passwort',
        'user_active_cp' => 'Benutzer ist aktiv', // different var in cpg1.2.0nuke
        'user_group_cp' => 'Benutzergruppe', // different var in cpg1.2.0nuke
        'user_email' => 'E-Mail Adresse des Benutzers',
        'user_web_site' => 'Webseite des Benutzers',
        'create_new_user' => 'neuen Benutzer anlegen',
        'user_from' => 'Ort', // different var in cpg1.2.0nuke
        'user_interests' => 'Hobbies/Interessen',
        'user_occ' => 'Beruf/Besch&auml;ftigung', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Gr&ouml;sse &auml;ndern',
        'what_it_does' => 'Was macht dieses Tool',
        'what_update_titles' => 'Erzeugt Titel aus Dateinamen',
        'what_delete_title' => 'L&ouml;scht Titel',
        'what_rebuild' => 'Erneuert Fingerabdruck und Bilder in Zwischengr&ouml;sse gem&auml;ß aktuellen EInstellungen',
        'what_delete_originals' => 'L&ouml;scht Bilder in Original-Gr&ouml;sse und ersetzt sie mit Bildern in Zwischengr&ouml;sse',
        'file' => 'Datei',
        'title_set_to' => '&Auml;ndere Titel auf',
        'submit_form' => 'los',
        'updated_succesfully' => 'erfolgreich ge&auml;ndert',
        'error_create' => 'FEHLER beim erzeugen von',
        'continue' => 'Mehr Bilder durchlaufen',
        'main_success' => 'Die Datei %s wurde erfolgreich als Hauptbild benutzt',
        'error_rename' => 'Fehler beim Umbenennen von %s zu %s',
        'error_not_found' => 'Die Datei %s wurde nicht gefunden',
        'back' => 'zur&uuml;ck zur Auswahl',
        'thumbs_wait' => 'Aktualisiere Fingerabdruck und/oder Bilder in Zwischengr&ouml;sse, bitte warten...',
        'thumbs_continue_wait' => 'Fortfahren mit der Aktualisierung der Fingerabdruck und/oder Bilder in Zwischengr&ouml;sse...',
        'titles_wait' => 'Aktualisiere &Uuml;berschriften, bitte warten...',
        'delete_wait' => 'L&ouml;sche &Uuml;berschriften, bitte warten...',
        'replace_wait' => 'L&ouml;sche Originale und ersetze sie mit Bilder in Zwischengr&ouml;sse, bitte warten..',
        'instruction' => 'Kurzanleitung',
        'instruction_action' => 'W&auml;hle Aktion',
        'instruction_parameter' => 'W&auml;hle Parameter',
        'instruction_album' => 'W&auml;hle Album',
        'instruction_press' => 'Klicke %s',
        'update' => 'Fingerabdruck und/oder Bilder in Zwischengr&ouml;sse aktualisieren',
        'update_what' => 'Was soll aktualisiert werden',
        'update_thumb' => 'Nur Fingerabdruck',
        'update_pic' => 'Nur Bilder in Zwischengr&ouml;sse',
        'update_both' => 'Sowohl Fingerabdruck als auch Bilder in Zwischengr&ouml;sse',
        'update_number' => 'Anzahl der Bilder, die pro Klick aktualisiert werden sollen',
        'update_option' => '(Verringere diesen Wert niedriger, wenn &quot;Time-Out&quot;-Probleme auftreten sollten)',
        'filename_title' => 'Dateiname &rArr; Bild-&Uuml;berschrift',
        'filename_how' => 'Wie soll der Dateiname modifiziert werden',
        'filename_remove' => '&Uuml;bersetze die Engung .jpg und ersetze _ (Unterstrich) mit Leerzeichen',
        'filename_euro' => '&Auml;ndere 2003_11_23_13_20_20.jpg zu 23/11/2003 13:20',
        'filename_us' => '&Auml;ndere 2003_11_23_13_20_20.jpg zu 11/23/2003 13:20',
        'filename_time' => '&Auml;ndere 2003_11_23_13_20_20.jpg zu 13:20',
        'delete' => 'L&ouml;sche Bild-&Uuml;berschriften oder Bilder in Original-Gr&ouml;sse',
        'delete_title' => 'Bild-&Uuml;berschriften l&ouml;schen',
        'delete_original' => 'Bilder in Originalgr&ouml;sse l&ouml;schen',
        'delete_replace' => 'L&ouml;sche die Original-Bilder und ersetze sie mit Bilder in Zwischengr&ouml;sse',
        'select_album' => 'W&auml;hle Album',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'Bild ansehen',
    'usr' => "'s Bilder-Gallerie",
    'photogallery' => 'Bilder-Gallerie',
    );

?>