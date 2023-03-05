<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by CPG-nuke Dev Team                                                 //
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
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

$lang_translation_info = array(
    'lang_name_english' => 'Norwegian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Norwegian', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa�ol'
    'lang_country_code' => 'no', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => '�yvind Nondal', // the name of the translator - can be a nickname
    'trans_email' => 'oyvindnondal@hotmail.com', // translator's email address (optional)
    'trans_website' => 'http://home.no.net/asellus/dev/', // translator's website (optional)
    'trans_date' => '2003-10-03', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'kB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('S�n', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'L�r');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des');
// Some common strings
$lang_yes = 'Ja';
$lang_no = 'Nei';
$lang_back = 'TILBAKE';
$lang_continue = 'FORTSETT';
$lang_info = 'Informasjon';
$lang_error = 'Feil';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d. %B, %Y';
$lastcom_date_fmt = '%d/%b/%y kl. %H:%M';
$lastup_date_fmt = '%d. %B, %Y';
$register_date_fmt = '%d. %B, %Y';
$lasthit_date_fmt = '%d. %B, %Y kl. %R';
$comment_date_fmt = '%d. %B, %Y kl. %R';
// For the word censor (sensurer ufine ord)
$lang_bad_words = array('*faen*', 'fitte', 'kuk', 'hore*', 'klitt', 'pakkis', 's�d', 'helvete', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Tilfeldige bilder',
    'lastup' => 'Siste bilder',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Sist oppdaterte album',
    'lastcom' => 'Siste kommentarer',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Mest viste',
    'toprated' => 'Beste karakter',
    'lasthits' => 'Siste visninger',
    'search' => 'S�keresultat',
    'favpics' => 'Favoritter'

    );

$lang_errors = array('access_denied' => 'Du har ikke adgang til denne siden.',
    'perm_denied' => 'Du kan ikke utf�re denne handlingen.',
    'param_missing' => 'Scriptet ble kallet uten n�dvendige paramenter.',
    'non_exist_ap' => 'Det valgte album/bilde eksisterer ikke!',
    'quota_exceeded' => 'Diskmengde er oppbrukt<br /><br />Du har plass til [quota]K, dine bilder bruker [space]K. Legger du inn flere bilder overskrider du den tillatte mengden',
    'gd_file_type_err' => 'N�r albumet bruker GD Graphics- teknikk er det kun tillatt � bruke JPEG eller PNG bilder. Har du muligheter for � bruke PNG er dette det beste valget!',
    'invalid_image' => 'Bildet du lastet opp er defekt eller st�tter ikke GD teknikk',
    'resize_failed' => 'Kunne ikke forandre st�rrelsen p� bildet eller opprette miniatyrbilde.',
    'no_img_to_display' => 'Ingen bilder � vise',
    'non_exist_cat' => 'Den valgte kategorien eksisterer ikke',
    'orphan_cat' => 'En kategori har ikke noe tilh�rsforhold. Kj�r kategorimanager for � rette problemet.',
    'directory_ro' => 'Mappen \'%s\' er skrivebeskyttet. Bildet kan ikke slettes.',
    'non_exist_comment' => 'Den valgte kommentaren finnes ikke.',
    'pic_in_invalid_album' => 'Bilder i album som ikke eksisterer (%s)!?',
    'banned' => 'Du har mistet tilatelsen til � bruke denne siden.',
    'not_with_udb' => 'Funksjonen er deaktivert fordi Coppermine kj�rer sammen med et forum.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    ); 
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'G� til albumlisten',
    'alb_list_lnk' => 'Albumliste',
    'my_gal_title' => 'G� til personlig galleri',
    'my_gal_lnk' => 'Mitt galleri',
    'my_prof_lnk' => 'Min profil',
    'adm_mode_title' => 'Skift til admin mode',
    'adm_mode_lnk' => 'Admin mode',
    'usr_mode_title' => 'Skift til bruker mode',
    'usr_mode_lnk' => 'Bruker mode',
    'upload_pic_title' => 'Last opp et bilde til album',
    'upload_pic_lnk' => 'Last opp bilde',
    'register_title' => 'Opprett konto',
    'register_lnk' => 'Registrer',
    'login_lnk' => 'Logg inn',
    'logout_lnk' => 'Logg ut',
    'lastup_lnk' => 'Siste opplastinger',
    'lastcom_lnk' => 'Siste kommentarer',
    'topn_lnk' => 'Mest viste',
    'toprated_lnk' => 'Beste karakter',
    'search_lnk' => 'S�k',
    'fav_lnk' => 'Mine favoritter',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Last opp til godkjennelse',
    'config_lnk' => 'Konfigurasjon',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'Kategorier',
    'users_lnk' => 'Bruker',
    'groups_lnk' => 'Grupper',
    'comments_lnk' => 'Kommentarer',
    'searchnew_lnk' => 'S�k p� nytt',
    'util_lnk' => 'Reduser bilder',
    'ban_lnk' => 'Utvis brukere',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Opprett / ordne albumer',
    'modifyalb_lnk' => 'Rediger album',
    'my_prof_lnk' => 'Min profil',
    );

$lang_cat_list = array('category' => 'Kategori',
    'albums' => 'Album',
    'pictures' => 'Bilder',
    );

$lang_album_list = array('album_on_page' => '%d album p� %d sider'
    );

$lang_thumb_view = array('date' => 'DATO',
    'name' => 'NAVN',
    'title' => 'TITTEL',
    'sort_da' => 'Sorteret i stigende dato rekkef�lge',
    'sort_dd' => 'Sortret i synkende dato rekkef�lge',
    'sort_na' => 'Sorteret alfabetisk stigende rekkef�lge',
    'sort_nd' => 'Sorteret alfabetisk synkende rekkef�lge',
    'sort_ta' => 'Sorter bilder i stigende rekkef�lge',
    'sort_td' => 'Sorter bilder synkende rekkef�lge',
    'pic_on_page' => '%d bilder p� %d side(r)',
    'user_on_page' => '%d brukere p� %d side(r)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Returner til oversikt',
    'pic_info_title' => 'Vis/skjul informasjon om bildet',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Send dette bildet som et e-postkort',
    'ecard_disabled' => 'e-postkort er sl�tt av',
    'ecard_disabled_msg' => 'Du har ikke tillatelse til � sende e-postkort',
    'prev_title' => 'Se forrige bilde',
    'next_title' => 'Se neste bilde',
    'pic_pos' => 'BILDE %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Kommenter dette bildet ',
    'no_votes' => '(Ingen kommentar enda)',
    'rating' => '(Aktuell karakter : %s / 5 med %s stemmer)',
    'rubbish' => 'D�rlig',
    'poor' => 'Middels',
    'fair' => 'Rimelig',
    'good' => 'Bra',
    'excellent' => 'Bedre en bra',
    'great' => 'Fantastisk',
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
    CRITICAL_ERROR => 'Kritisk feil',
    'file' => 'Fil: ',
    'line' => 'Linje: ',
    );

$lang_display_thumbnails = array('filename' => 'Filnavn: ',
    'filesize' => 'Filst�rrelse: ',
    'dimensions' => 'Dimensjoner: ',
    'date_added' => 'Lagt inn dato: '
    );

$lang_get_pic_data = array('n_comments' => '%s kommentar',
    'n_views' => '%s visninger',
    'n_votes' => '(%s stemmer)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Utrop',
        'Question' => 'Sp�rsm�l',
        'Very Happy' => 'Veldig glad',
        'Smile' => 'Smil',
        'Sad' => 'Trist',
        'Surprised' => 'Overrasket',
        'Shocked' => 'Sjokkert',
        'Confused' => 'Forvirret',
        'Cool' => 'Kult',
        'Laughing' => 'Latter',
        'Mad' => 'Sur',
        'Razz' => 'Fleiper',
        'Embarassed' => 'Sjenert',
        'Crying or Very sad' => 'Gr�ter eller veldig trist',
        'Evil or Very Mad' => 'Ond eller veldig sur',
        'Twisted Evil' => 'Ond',
        'Rolling Eyes' => 'Ruller med �yne',
        'Wink' => 'Vinker',
        'Idea' => 'God ide',
        'Arrow' => 'Pil',
        'Neutral' => 'N�ytral',
        'Mr. Green' => 'Mr. Gr�nn',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'forlater admin mode...',
        1 => 'kommer inn i admin mode...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Album m� ha et navn!',
        'confirm_modifs' => 'Er du sikker p� at du vil lagre disse instillingene?',
        'no_change' => 'Du lagret ingen endringer!',
        'new_album' => 'Nytt album',
        'confirm_delete1' => 'Er du sikker p� at du vil slette album?',
        'confirm_delete2' => '\nAlle bilder og kommentarer forsvinner!',
        'select_first' => 'Velg f�rst et albim',
        'alb_mrg' => 'Album Manager',
        'my_gallery' => '* Mitt galleri *',
        'no_category' => '* Ingen kategori *',
        'delete' => 'Slett',
        'new' => 'Ny',
        'apply_modifs' => 'Godkjenn rettelser',
        'select_category' => 'Velg kategori',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Obligatorisk paramenter ved \'%s\'operasjonen ble ikke utf�rt!',
        'unknown_cat' => 'Den valgte kategorien eksisterer ikke i databasen',
        'usergal_cat_ro' => 'Brukergalleri kategorien kan ikke slettes!',
        'manage_cat' => 'Administrer kategorier',
        'confirm_delete' => 'Er du sikker p� at du �nsker og slette denne kategorien',
        'category' => 'Kategori',
        'operations' => 'Handling',
        'move_into' => 'Flytt til',
        'update_create' => 'Oppdater/Opprett kategori',
        'parent_cat' => 'Hoved kategori',
        'cat_title' => 'Kategori tittel',
        'cat_desc' => 'Kategori beskrivelse'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => 'Konfigurasjon',
        'restore_cfg' => 'Gjenopprett standardoppsett',
        'save_cfg' => 'Lagre ny konfigurasjon',
        'notes' => 'Noter',
        'info' => 'Informasjon',
        'upd_success' => 'Coppermine konfigurasjonen er oppdatert',
        'restore_success' => 'Coppermine standartoppsett ble oppdatert',
        'name_a' => 'Navn stigende',
        'name_d' => 'Navn synkende',
        'title_a' => 'Tittel i stigende rekkef�lge',
        'title_d' => 'Tittel i synkende rekkef�lge',
        'date_a' => 'Dato stigende',
        'date_d' => 'Date synkende',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Generelle instillinger',
        array(
            'Galleri navn', 'gallery_name', 0),
        array(
            'Galleri beskrivelse', 'gallery_description', 0),
        array(
            'Galleri administrator e-mail', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0),
        array(
            'Spr�k', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Album liste visning',
        array(
            'Bredde p� hoved tabell (piksler eller %)', 'main_table_width', 0),
        array(
            'Antall rader i kategorier for visning', 'subcat_level', 0),
        array(
            'Antall album for fremvisning', 'albums_per_page', 0),
        array(
            'Antal kolonner for fremvisning', 'album_list_cols', 0),
        array(
            'St�rrelse p� miniatyrbilde i piksler', 'alb_list_thumb_size', 0),
        array(
            'Innholdet p� hovedsiden', 'main_page_layout', 0),
        array(
            'Vis miniatyrbilder fra f�rste niv� i kategorier', 'first_level', 1), 
        // 'Thumbnail view',
        'Miniatyrbilde',
        array(
            'Antall kolonner p� siden med miniatyrbilder', 'thumbcols', 0),
        array(
            'Antall rader p� siden med miniatyrbilder', 'thumbrows', 0),
        array(
            'Maks antall miniatyrbilder p� hver side', 'max_tabs', 0),
        array(
            'Vis bildeoverskriften nedenfor miniatyrbilde', 'caption_in_thumbview', 1),
        array(
            'Vis antall kommentarer nedenfor miniatyrbilde', 'display_comment_count', 1),
        array(
            'Standard sortering av bilderekkef�lgen', 'default_sort_order', 3),
        array(
            'Minimum antall stemmer p� bilde f�r visning i \'beste karakter\' listen', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Bildevisning og kommentarer',
        array(
            'Bredde for tabellen av visning av bilder (piksler eller %)', 'picture_table_width', 0),
        array(
            'Informasjon om bilde er synlig som standard', 'display_pic_info', 1),
        array(
            'Fildrer ufine ord som standrard', 'filter_bad_words', 1),
        array(
            'Smilefjes er tillatt', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Maksimum lengde p� bildebeskrivelse', 'max_img_desc_length', 0),
        array(
            'Maks lengde p� hele ord', 'max_com_wlength', 0),
        array(
            'Maks linjer i en kommentar', 'max_com_lines', 0),
        array(
            'Maks lengde p� en kommentar', 'max_com_size', 0),
        array(
            'Vis filmstripe', 'display_film_strip', 1),
        array(
            'Antall punkt i filmstripe', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Bilde og miniatyrbilder',
        array(
            'Kvalitet p� JPEG', 'jpeg_qual', 0),
        array(
            'Maks bredde og h�yde p� miniatyrbilder <strong>*</strong>', 'thumb_width', 0),
        array(
            'Bruk dimensjon ( bredde og h�yde eller maks  )<strong>*</strong>', 'thumb_use', 7), // Get a "invalid error" message on configuration page
        array(
            'Opprett mellomliggende bilder', 'make_intermediate', 1),
        array(
            'Maks h�yde eller bredde p� mellomliggende bilde <strong>*</strong>', 'picture_width', 0),
        array(
            'Maks st�rrelse p� bilder til opplasting (kB)', 'max_upl_size', 0),
        array(
            'Maks bredde eller h�yde for bilder til opplasting (piksler)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Instillinger for brukere',
        array(
            'Tillat at nye brukere kan registrere seg', 'allow_user_registration', 1),
        array(
            'Nye brukere m� aktivere med e-post adresse', 'reg_requires_valid_email', 1),
        array(
            'Tillat to brukere og ha samme e-post', 'allow_duplicate_emails_addr', 1),
        array(
            'Brukere kan ha private album', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Spesialfelt ved bildebeskrivelse (la disse v�re blanke som standard)',
        array(
            'Felt 1 navn', 'user_field1_name', 0),
        array(
            'Felt 2 navn', 'user_field2_name', 0),
        array(
            'Felt 3 navn', 'user_field3_name', 0),
        array(
            'Felt 4 navn', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Avanserte instillinger for bilder og miniatyrbilder',
        array(
            'Vis ikon for privat album til ikke p�logget bruker', 'show_private', 1),
        array(
            'Forbudte tegn i filnavn', 'forbiden_fname_char', 0),
        array(
            'Aksepter andre filtyper for opplasting', 'allowed_file_extensions', 0),
        array(
            'Metode for endring av st�rrelse p� bilder', 'thumb_method', 2),
        array(
            'Adresse til ImageMagick / netpbm \'konverterings\' verkt�y (eksempel /usr/bin/X11/)', 'impath', 0),
        array(
            'Tillat bildetyper (kun tilgjengelig ved bruk av ImageMagick)', 'allowed_img_types', 0),
        array(
            'Kommandolinje ved bruk av ImageMagick', 'im_options', 0),
        array(
            'Les EXIF data i JPEG filer', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Album mappen <strong>*</strong>', 'fullpath', 0),
        array(
            'Mappen for brukerenes bilder <strong>*</strong>', 'userpics', 0),
        array(
            'forh�ndsvalgt navn p� medlemsbilder <strong>*</strong>', 'normal_pfx', 0),
        array(
            'f�rh�ndsvalgt navn p� miniatyrbilder <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Standard tilstand p� mapper', 'default_dir_mode', 0),
        array(
            'Standard tilstand p� bilder', 'default_file_mode', 0),
        array(
            'Picinfo display filename', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display album name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_file_size', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_dimensions', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display URL as bookmark link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display fav album link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        // 'Cookies &amp; Charset settings',
        'Cookies og tegnkoding',
        array(
            'Navnet p� den cookie brukt av dette systemet', 'cookie_name', 0),
        array(
            'Adressen til den cookie brukt at dette systemet', 'cookie_path', 0),
        array(
            'Tegnkodning', 'charset', 4), 
        // 'Miscellaneous settings',
        'Diverse instillinger',
        array(
            'Still om for testing (debug)', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Felter markert med * skal skiftes hvis du allerede har bilder i ditt galleri</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'You need to type your name and a comment',
        'com_added' => 'Your comment was added',
        'alb_need_title' => 'You have to provide a title for the album !',
        'no_udp_needed' => 'No update needed.',
        'alb_updated' => 'The album was updated',
        'unknown_album' => 'Selected album does not exist or you don\'t have permission to upload in this album',
        'no_pic_uploaded' => 'No picture was uploaded !<br /><br />If you have really selected a picture to upload, check that the server allows file uploads...',
        'err_mkdir' => 'Failed to create directory %s !',
        'dest_dir_ro' => 'Destination directory %s is not writable by the script !',
        'err_move' => 'Impossible to move %s to %s !',
        'err_fsize_too_large' => 'The size of picture you have uploaded is too large (maximum allowed is %s x %s) !',
        'err_imgsize_too_large' => 'The size of the file you have uploaded is too large (maximum allowed is %s KB) !',
        'err_invalid_img' => 'The file you have uploaded is not a valid image !',
        'allowed_img_types' => 'You can only upload %s images.',
        'err_insert_pic' => 'The picture \'%s\' can\'t be inserted in the album ',
        'upload_success' => 'Your picture was uploaded successfully<br /><br />It will be visible after admin approval.',
        'info' => 'Information',
        'com_added' => 'Comment added',
        'alb_updated' => 'Album updated',
        'err_comment_empty' => 'Your comment is empty !',
        'err_invalid_fext' => 'Only files with the following extensions are accepted : <br /><br />%s.',
        'no_flood' => 'Sorry but you are already the author of the last comment posted for this picture<br /><br />Edit the comment you have posted if you want to modify it',
        'redirect_msg' => 'You are being redirected.<br /><br /><br />Click \'CONTINUE\' if the page does not refresh automatically',
        'upl_success' => 'Your picture was successfully added',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Overskrift',
        'fs_pic' => 'Full st�rrelse',
        'del_success' => 'Slettet',
        'ns_pic' => 'Normal st�rrelse',
        'err_del' => 'Kan ikke slettes',
        'thumb_pic' => 'Miniatyrbilde',
        'comment' => 'Kommentar',
        'im_in_alb' => 'Bilde i album',
        'alb_del_success' => 'Album \'%s\' slettet',
        'alb_mgr' => 'Album Administrator',
        'err_invalid_data' => '�delagt data i \'%s\'',
        'create_alb' => 'Oppretter album \'%s\'',
        'update_alb' => 'Oppdaterer album \'%s\' med tittel \'%s\' og index \'%s\'',
        'del_pic' => 'Slett bilde',
        'del_alb' => 'Slett album',
        'del_user' => 'Slett bruker',
        'err_unknown_user' => 'Den valgte brukeren eksisterer ikke!',
        'comment_deleted' => 'Kommentarer er slettet',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Er du sikker p� at du vil slette dette bildet? \\nKommentarer bilr ogs� slettet.',
        'del_pic' => 'SLETT DETTE BILDET',
        'size' => '%s x %s piksler',
        'views' => '%s ganger',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'STOP SLIDESHOW',
        'view_fs' => 'Klikk for � vise i full st�rrelse',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informasjon om bildet',
        'Filename' => 'Filnavn',
        'Album name' => 'Album navn',
        'Rating' => 'Karakter (%s stemmer)',
        'Keywords' => 'N�kkelord',
        'File Size' => 'Filst�rrelse',
        'Dimensions' => 'Dimensjoner',
        'Displayed' => 'Visninger',
        'Camera' => 'Kamera',
        'Date taken' => 'Tatt dato',
        'Aperture' => '�pning',
        'Exposure time' => 'Eksponeringstid ',
        'Focal length' => 'Brennvidde',
        'Comment' => 'Kommentar',
        'addFav' => 'Legg til i favoritter',
        'addFavPhrase' => 'Favoritter',
        'remFav' => 'Fjern fra favoritter',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Endre denne kommentaren',
        'confirm_delete' => 'Er du sikker p� du vil slette denne kommentaren?',
        'add_your_comment' => 'Legg til din kommentar',
        'name' => 'Navn',
        'comment' => 'Kommentar',
        'your_name' => 'Anonym',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klikk p� bildet for � lukke',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Send et e-postkort',
        'invalid_email' => '<strong>Advarsel</strong> : ugyldig e-post adresse!',
        'ecard_title' => 'E-postkort fra %s til deg!',
        'view_ecard' => 'Hvis kortet ikke vises riktig, klikk her',
        'view_more_pics' => 'Klikk p� denne linken for flere bilder!',
        'send_success' => 'Ditt e-postkort ble sendt',
        'send_failed' => 'Beklager, serveren kunne ikke sende...',
        'from' => 'Fra',
        'your_name' => 'Ditt navn',
        'your_email' => 'Din e-post adresse',
        'to' => 'Til',
        'rcpt_name' => 'Navn p� mottaker',
        'rcpt_email' => 'E-post adresse til mottaker',
        'greetings' => 'Hilsen',
        'message' => 'Beskjed',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Informasjon om bilde',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beskrivelse',
        'keywords' => 'N�kkelord',
        'pic_info_str' => '%sx%s - %skB - %s visninger - %s stemmer',
        'approve' => 'Godkjenn bilde',
        'postpone_app' => 'Avsl� godkjennelse',
        'del_pic' => 'Slett billede',
        'reset_view_count' => 'Tilbakestill teller',
        'reset_votes' => 'Tilbakestill avstemmning',
        'del_comm' => 'Slett kommentarer',
        'upl_approval' => 'Last opp godkjennelse',
        'edit_pics' => 'Rediger bilder',
        'see_next' => 'Se neste bilde',
        'see_prev' => 'Se forrige bilde',
        'n_pic' => '%s bilder',
        'n_of_pic_to_disp' => 'bilder til fremvisning',
        'apply' => 'Legg til rettelser'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Gruppenavn',
        'disk_quota' => 'Disk kvote',
        'can_rate' => 'Kan gi karakterer',
        'can_send_ecards' => 'Kan sende e-postkort',
        'can_post_com' => 'Kan opprette kommentar',
        'can_upload' => 'Kan laste opp bilder',
        'can_have_gallery' => 'Kan ha privat galleri',
        'apply' => 'Legg til rettelser',
        'create_new_group' => 'Opprett ny gruppe',
        'del_groups' => 'Slett valgte grupper',
        'confirm_del' => 'Advarsel, n�r du sletter en gruppe vil medlemme i denne bli flyttet til \'Registrert\' gruppe !\n\nVil du fortsette ?',
        'title' => 'Administrer brukergrupper',
        'approval_1' => 'Godkjennelse p� offentlige opplastinger(1)',
        'approval_2' => 'Godkjennelse p� private opplastinger(2)',
        'note1' => '<strong>(1)</strong> Opplastinger i offentlig album krever administrators godkjennelse',
        'note2' => '<strong>(2)</strong> Opplastinger i privat album som tilh�rer brukeren krever administrators godkjennelse',
        'notes' => 'Notes'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Velkommen!'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Er du sikker p� at du vil slette dette albumet? \\nAlle bilder og kommentarer vil ogs� bli slettet.',
        'delete' => 'SLETT',
        'modify' => 'REDIGER',
        'edit_pics' => 'REDIGER BILDER',
        );

    $lang_list_categories = array('home' => 'Hjem',
        'stat1' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album og <strong>[cat]</strong> kategorier med <strong>[comments]</strong> kommentarer vist <strong>[views]</strong> ganger',
        'stat2' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album vist <strong>[views]</strong> ganger',
        'xx_s_gallery' => '%s\'s Galleri',
        'stat3' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album med <strong>[comments]</strong> kommentarer vist <strong>[views]</strong> ganger'
        );

    $lang_list_users = array('user_list' => 'Brukerliste',
        'no_user_gal' => 'Ingen brukere kan ha album',
        'n_albums' => '%s album',
        'n_pics' => '%s bilder'
        );

    $lang_list_albums = array('n_pictures' => '%s bilder',
        'last_added' => ', siste lagt inn %s'
        );
} 
// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Oppdaterer album %s',
        'general_settings' => 'Generelle instillinger',
        'alb_title' => 'Album tittel',
        'alb_cat' => 'Album kategori',
        'alb_desc' => 'Album beskrivelse',
        'alb_thumb' => 'Album miniatyrbilder',
        'alb_perm' => 'Tillatelser for dette album',
        'can_view' => 'Album kan vises av',
        'can_upload' => 'Gjester kan laste opp bilder',
        'can_post_comments' => 'Gjester kan skrive kommentarer',
        'can_rate' => 'Gjester kan stemme p� bilder',
        'user_gal' => 'Brukergalleri',
        'no_cat' => '* Ingen kategori *',
        'alb_empty' => 'Album er tomt',
        'last_uploaded' => 'Sist lastet opp',
        'public_alb' => 'Alle (offentlige album)',
        'me_only' => 'Kun meg',
        'owner_only' => 'Albumet eies av (%s)',
        'groupp_only' => 'Medlemmer av \'%s\' gruppen',
        'err_no_alb_to_modify' => 'Ingen album � redigere.',
        'update' => 'Oppdater album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Beklager, men du har allerede stemt p� dette bildet',
        'rate_ok' => 'Din stemme ble akseptert',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
// Lag egne vilk�r for bruk her hvis du ikke vil ha det som er standard
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Denne siden kan ha album som gjester kan laste opp i. Noe administratorene ikke alltid har kontroll over,
men vi pr�ver fjerne st�tende materiale s� raskt som mulig om dette forekommer.
Du m� derfor akseptere at slikt innhold kan forekomme ved � klikke p� "Jeg Aksepterer" knappen nedenfor.
EOT;

    $lang_register_php = array('page_title' => 'Registrering av ny bruker',
        'term_cond' => 'Regler og betingelser',
        'i_agree' => 'Jeg Aksepterer',
        'submit' => 'Send registrering',
        'err_user_exists' => 'Brukernavnet finnes allerede. Velg et annet!',
        'err_password_mismatch' => 'Passordene var ikke like',
        'err_uname_short' => 'Brukernavnet var for kort',
        'err_password_short' => 'Passordet var for kort',
        'err_uname_pass_diff' => 'Brukernavn og passord m� v�re forskjellige',
        'err_invalid_email' => 'E-mail adresse er ugyldig',
        'err_duplicate_email' => 'En annen bruker er oppf�rt med din e-post adresse.',
        'enter_info' => 'Angi informajson om registrering',
        'required_info' => 'Forlanget informasjon',
        'optional_info' => 'Valgfri informasjon',
        'username' => 'Brukernavn',
        'password' => 'Passord',
        'password_again' => 'Gjennta passord',
        'email' => 'E-post',
        'location' => 'Sted',
        'interests' => 'Interesser',
        'website' => 'Hjemmeside',
        'occupation' => 'Jeg bor i',
        'error' => 'FEIL',
        'confirm_email_subject' => '%s - Godkjennelse',
        'information' => 'Informasjon',
        'failed_sending_email' => 'Godkjennelsen kan ikke sendes!',
        'thank_you' => 'Takk for din registrering.<br /><br />en e-post er sendt til deg der du m� aktivere din konto.',
        'acct_created' => 'Din konto er n� opprettet og du kan logge inn med ditt brukernavn og passord',
        'acct_active' => 'Din konto er n� aktiv og du kan logge p� med ditt brukernavn og passord',
        'acct_already_act' => 'Din konto er allerede aktiv !',
        'acct_act_failed' => 'Denne kontoen kan ikke bli aktivert !',
        'err_unk_user' => 'Den valgte brukeren eksisterer ikke !',
        'x_s_profile' => '%s\'s profil',
        'group' => 'Gruppe',
        'reg_date' => 'Tilsluttet',
        'disk_usage' => 'Disk behandling',
        'change_pass' => 'Bytt passord',
        'current_pass' => 'N�v�rende passord',
        'new_pass' => 'Nytt passord',
        'new_pass_again' => 'Bekreft passord',
        'err_curr_pass' => 'Feil under nytt passord',
        'apply_modif' => 'Legg til rettelser',
        'change_pass' => 'Bytt mitt passord',
        'update_success' => 'Din profil ble oppdatert',
        'pass_chg_success' => 'Ditt passord ble endret',
        'pass_chg_error' => 'Ditt passord ble ikke endret',
        );

    $lang_register_confirm_email = <<<EOT
Takk for din registrering hos {SITE_NAME}

Ditt brukernavn er : "{USER_NAME}"
Dit passord er : "{PASSWORD}"

For � aktivere din konto m� du klikke p� linken under eller lime den inn i den nettleser.

{ACT_LINK}

Vennlig hilsen,

Administrasjonen av - {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Overblikk p� kommentarer',
        'no_comment' => 'Der er ingen kommentarer � se p�',
        'n_comm_del' => '%s kommentarer slettet',
        'n_comm_disp' => 'Kommentarer og vise',
        'see_prev' => 'Se forrige',
        'see_next' => 'Se neste',
        'del_comm' => 'Slett valgte kommentarer',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'S�k i bilder',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'S�k i nye bilder',
        'select_dir' => 'Velg mappe',
        'select_dir_msg' => 'Denne funksjonen tillater deg og legge inn bilder du har lastet opp via FTP.<br /><br />Velg mappen du har lastet opp bilder i',
        'no_pic_to_add' => 'Det finnes ingen bilder � legge til',
        'need_one_album' => 'Du m� ha minst et album for � legge til bilder',
        'warning' => 'Advarsel',
        'change_perm' => 'Systemet kan ikke skrive til denne mappen, du m� endre rettigheter med CHMOD 755 eller 777 f�r du pr�ver igjen !',
        'target_album' => '<strong>Flytt bilder av &quot;</strong>%s<strong>&quot; til </strong>%s',
        'folder' => 'Mappe',
        'image' => 'Bilde',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Ikke skrivbar. ',
        'dir_cant_read' => 'Kan ikke lese. ',
        'insert' => 'Sett inn nye bilder til album',
        'list_new_pic' => 'Liste med nye bilder',
        'insert_selected' => 'Sett inn valge bilder',
        'no_pic_found' => 'Ingen nye bilder ble funnet',
        'be_patient' => 'Ha litt tolmodighet, systemet arbeider n� med bildene',
        'notes' => '<ul>' . '<li><strong>OK</strong> : Betyr at bildet er lagt inn' . '<li><strong>DP</strong> : Betyr at bildet er en kopi og ligger i databasen' . '<li><strong>PB</strong> : Betyr at bildet ikke kan legges inn, sjekk tillatelser' . '<li>Hvis OK, DP, PB \'signalet\' ikke kommer frem klikk da p� manglende bilder og se om signalet kommer frem i PHP' . '<li>Hvis din nettleser lager timeout pr�v og oppdatere den' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  not used in cpg1.2.0-nuke   //
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Last opp bilde',
        'max_fsize' => 'Maks filst�rrelse er satt til %s kB',
        'album' => 'Album',
        'picture' => 'Bilde',
        'pic_title' => 'Tittel p� bilde',
        'description' => 'Beskrivelse p� bilde',
        'keywords' => 'N�kkelord (separer med komma. bmw, m3, mpower etc.)',
        'err_no_alb_uploadables' => 'Beklager, ingen album tillatt for opplasting av bilder',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Administrer bruker',
        'name_a' => 'Navn stigende',
        'name_d' => 'Navn synkende',
        'group_a' => 'Gruppe stigende',
        'group_d' => 'Gruppe synkende',
        'reg_a' => 'Reg dato stigende',
        'reg_d' => 'Reg dato synkende',
        'pic_a' => 'Bilder stigende',
        'pic_d' => 'Bilder synkende',
        'disku_a' => 'Disk behandling stigende',
        'disku_d' => 'Disk behandling synkene',
        'sort_by' => 'Sorteret av bruker',
        'err_no_users' => 'Brukertabell er tom!',
        'err_edit_self' => 'Du kan ikke rette i egen profil, bruk \'Min profil\' link til dette form�l',
        'edit' => 'REDIGER',
        'delete' => 'SLETT',
        'name' => 'Brukernavn',
        'group' => 'Gruppe',
        'inactive' => 'Ikke aktiv',
        'operations' => 'Handlinger',
        'pictures' => 'Bilder',
        'disk_space' => 'Plass brukt / Kvote',
        'registered_on' => 'Registreret den',
        'u_user_on_p_pages' => '%d brukere p� %d sider',
        'confirm_del' => 'Er du sikker p� du vil SLETTE denne brukeren ? \\nAlle billeder og album vil ogs� bli slettet.',
        'mail' => 'POST',
        'err_unknown_user' => 'Den valgte brukeren eksisterer ikke!',
        'modify_user' => 'Rediger bruker',
        'notes' => 'Noter',
        'note_list' => '<li>Hvis du ikke vil rette det aktuelle passordet, la feltet "passord" st� tomt',
        'password' => 'Passord',
        'user_active' => 'Brukeren er ikke aktiv',
        'user_group' => 'Brukergruppe',
        'user_email' => 'Bruker e-post',
        'user_web_site' => 'Brukerens hjemmeside',
        'create_new_user' => 'Opprett ny bruker',
        'user_from' => 'Brukerens plassering',
        'user_interests' => 'Brukerens interesser',
        'user_occ' => 'Brukerens beskrivelse',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Reduser st�rrelsen p� bilder',
        'what_it_does' => 'Hva det gj�r',
        'what_update_titles' => 'Oppdater tittler fra bildenavn',
        'what_delete_title' => 'Slett tittler',
        'what_rebuild' => 'Gjennoppbygg miniatyrbilder fra endrede bilder',
        'what_delete_originals' => 'Sletter originalbilder og bytter disse om med den versjonen du har endret st�rrelsen p�',
        'file' => 'Fil',
        'title_set_to' => 'tittel settes til',
        'submit_form' => 'send',
        'updated_succesfully' => 'oppdatert med suksess',
        'error_create' => 'FEIL under opprettelse av',
        'continue' => 'Flere bilder',
        'main_success' => 'Filen %s ble brukt som hovedbilde',
        'error_rename' => 'Kunne ikke gi nytt navn til %s to %s',
        'error_not_found' => 'Tittelen %s ble ikke funnet',
        'back' => 'tilbake til hovedsiden',
        'thumbs_wait' => 'Oppdaterer bilder... vennligst vent...',
        'thumbs_continue_wait' => 'Fortsetter oppdateringen av bilder...',
        'titles_wait' => 'Oppdaterer tittler, vennligst vent...',
        'delete_wait' => 'Sletter tittler, vennligst vent..',
        'replace_wait' => 'Sletter originalbilder og erstatter med endrede bilder..',
        'instruction' => 'Hurtiginstrukser',
        'instruction_action' => 'Velg handling',
        'instruction_parameter' => 'Sett paramenter',
        'instruction_album' => 'Velg album',
        'instruction_press' => 'Trykk %s',
        'update' => 'Oppdater album og / eller endrede bilder',
        'update_what' => 'Hva skal oppdateres',
        'update_thumb' => 'Kun miniatyrbilder',
        'update_pic' => 'Kun reduserte bilder',
        'update_both' => 'Begge, sm�bilder og reduserte bilder',
        'update_number' => 'Antall fullf�rte bilder pr klikk',
        'update_option' => '(Pr�v � sette instillingen til lavere om du f�r time-out i nettlesren)',
        'filename_title' => 'Filnavn ? Tittel p� bilde',
        'filename_how' => 'Hvordan skal filen modifiseres',
        'filename_remove' => 'Fjern .jpg slutten og bytt om med _ (flatstrek) med mellomrom',
        'filename_euro' => 'Endre 2003_11_23_13_20_20.jpg til 23/11/2003 13:20',
        'filename_us' => 'Endre 2003_11_23_13_20_20.jpg til 11/23/2003 13:20',
        'filename_time' => 'Endre 2003_11_23_13_20_20.jpg til 13:20',
        'delete' => 'Slett tittler p� bilder og endrede bilder',
        'delete_title' => 'Slett tittler p� bilder',
        'delete_original' => 'Slett bilder med original st�rrelse',
        'delete_replace' => 'Sletter originale bilder og bytter om med endrede bilder',
        'select_album' => 'Velg album',
        ); 
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'Viewing Photo',
    'usr' => "'s Photo Gallery",
    'photogallery' => 'Photo Gallery',
    );

?>