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
// info about translators and translated language
define('PIC_VIEWS', 'Visade');
define('PIC_VOTES', 'R�ster');
define('PIC_COMMENTS', 'Kommentarer');

$lang_translation_info = array(
    'lang_name_english' => 'Swedish', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Svenska', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'se', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'David Garcia', // the name of the translator - can be a nickname
    'trans_email' => 'lejonturbo@yahoo.se', // translator's email address (optional)
    'trans_website' => 'http://www.nope.com/', // translator's website (optional)
    'trans_date' => '2004-03-12', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array(
    'Byte', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array(
    'S�n', 'M�n', 'Tis', 'Ons', 'Tors', 'Fre', 'L�r');
$lang_month = array(
    'Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Ja';
$lang_no = 'Nej';
$lang_back = 'TILLBAKA';
$lang_continue = 'FORTS�TT';
$lang_info = 'Information';
$lang_error = 'Fel';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array(
    '*knulla*', 'fitta', 'arsle', 'kuk', 'mutta', 'fan', 'helvete', 'blatte', 'nigger', 'svarting', 'nasse', 'r�v', 'ollon', 'dildo', 'fanculo', 'pattar', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Slumpm�ssiga bilder',
    'lastup' => 'Senast inlagda',
    'lastupby' => 'Mina Senaste Bidrag', // new 1.2.2
    'lastalb' => 'Senaste uppdaterade album',
    'lastcom' => 'Senaste kommentarer',
    'lastcomby' => 'Mina Senaste kommentarer', // new 1.2.2
    'topn' => 'Mest visade',
    'toprated' => 'Topplista',
    'lasthits' => 'Senast visat',
    'search' => 'S�kresultat',
    'favpics' => 'Favoritbilder'
    );

$lang_errors = array('access_denied' => 'Du har inte r�ttigheter till den h�r sidan.',
    'perm_denied' => 'Du har inte till�telse att g�ra den h�r operationen.',
    'param_missing' => 'Skript startat utan r�tt parameter(ar).',
    'non_exist_ap' => 'Det valda albumet/bilden finns inte !',
    'quota_exceeded' => 'Diskkvoten �vertrasserad<br /><br />Du har en diskkvot p� [quota]K, din bild �r p� [space]K, att l�gga till den h�r bilden g�r att du �vertrasserar diskkvoten.',
    'gd_file_type_err' => 'Vid anv�ndande av GD image library, s� �r endast JPEG- och PNG-format till�tna.',
    'invalid_image' => 'Bilden du laddade upp �r skadad eller kan inte hanteras av GD library',
    'resize_failed' => 'Kan inte skapa miniatyrbild eller f�r�ndra bildstorleken.',
    'no_img_to_display' => 'Ingen bild att visa',
    'non_exist_cat' => 'Den valda kategorin finns inte',
    'orphan_cat' => 'En kategori har en s.k. non-existing parent, k�r kategorihanteraren f�r att r�tta till problemet.',
    'directory_ro' => 'Biblioteket \'%s\' �r inte skrivbart, bilden kan inte raderas',
    'non_exist_comment' => 'Den valda kommentaren finns inte.',
    'pic_in_invalid_album' => 'Bilden �r i ett icke existerande album (%s)!?',
    'banned' => 'Du �r f�r tillf�llet blockerad fr�n den h�r sajten.',
    'not_with_udb' => 'Den h�r funktionen �r inaktiverad i Coppermine f�r att den �r integrerad med forumets mjukvara. Vad du �n f�rs�ker g�ra s� st�ds det inte i den h�r konfigurationen, eller s� ska funktionen sk�tas av forumets mjukvara.',
    'members_only' => 'Denna funktion �r f�r medlemmar enbart, anslut dig.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'Denna funktion �r enbart f�r sajtens admin. Du m�ste vara inloggad som superadmin, god konto f�r att accessa denna funktion'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'G� till albumlistan',
    'alb_list_lnk' => 'Albumlista',
    'my_gal_title' => 'G� till mitt privata galleri',
    'my_gal_lnk' => 'Mitt galleri',
    'my_prof_lnk' => 'Min profil',
    'adm_mode_title' => 'V�xla till adminl�ge',
    'adm_mode_lnk' => 'Adminl�ge',
    'usr_mode_title' => 'V�xla till anv�ndarl�ge',
    'usr_mode_lnk' => 'Anv�ndarl�ge',
    'upload_pic_title' => 'Ladda upp en bild till ett album',
    'upload_pic_lnk' => 'Ladda upp bild',
    'register_title' => 'Skapa ett konto',
    'register_lnk' => 'Registrera',
    'login_lnk' => 'Logga in',
    'logout_lnk' => 'Logga ut',
    'lastup_lnk' => 'Senaste uppladdningar',
    'lastcom_lnk' => 'Senaste kommentarer',
    'topn_lnk' => 'Mest visade',
    'toprated_lnk' => 'Topplista',
    'search_lnk' => 'S�k',
    'fav_lnk' => 'Mina Favoriter',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Klara f�r publicering',
    'config_lnk' => 'Konfigurera',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'Kategorier',
    'users_lnk' => 'Anv�ndare',
    'groups_lnk' => 'Grupper',
    'comments_lnk' => 'Kommentarer',
    'searchnew_lnk' => 'L�gg till ett parti av bilder',
    'util_lnk' => '�ndra storlek p� bilden', //not used yet
    'ban_lnk' => 'Blockera anv�ndare',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Skapa / sortera mina album',
    'modifyalb_lnk' => '�ndra i mina album',
    'my_prof_lnk' => 'Min profil',
    );

$lang_cat_list = array('category' => 'Kategori',
    'albums' => 'Album',
    'pictures' => 'Bilder',
    );

$lang_album_list = array('album_on_page' => '%d album p� %d sida(or)'
    );

$lang_thumb_view = array('date' => 'DATUM', 
    // Sort by filename and title
    'name' => 'FILNAMN',
    'title' => 'TITEL',
    'sort_da' => 'Sortera datum stigande',
    'sort_dd' => 'Sortera datum fallande',
    'sort_na' => 'Sortera namn stigande',
    'sort_nd' => 'Sortera namn fallande',
    'sort_ta' => 'Sortera titel stigande',
    'sort_td' => 'Sortera titel fallande',
    'pic_on_page' => '%d bilder p� %d sida(or)',
    'user_on_page' => '%d anv�ndare p� %d sida(or)',
    'sort_ra' => 'Sortera efter v�rdering stigande', // new in cpg1.2.0nuke
    'sort_rd' => 'Sortera efter v�rdering fallande', // new in cpg1.2.0nuke
    'rating' => 'V�RDERING', // new in cpg1.2.0nuke
    'sort_title' => 'Sortera bilder efter:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => '�terv�nd till miniatyrbildsida',
    'pic_info_title' => 'Visa/d�lj bild information',
    'slideshow_title' => 'Bildspel',
    'slideshow_disabled' => 'e-vykort �r avslaget', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['medlemmar enbart'], // new in cpg1.2.0nuke
    'ecard_title' => 'Skicka den h�r bilden som ett e-vykort',
    'ecard_disabled' => 'e-vykort �r inaktiverat',
    'ecard_disabled_msg' => 'Du har inte r�ttigheter att skicka e-vykort',
    'prev_title' => 'Se f�reg�ende bild',
    'next_title' => 'Se n�sta bild',
    'pic_pos' => 'BILD %s/%s',
    'no_more_images' => 'Det finns inte fler bilder i detta galleri', // new in cpg1.2.0nuke
    'no_less_images' => 'Detta �r f�rsta bilden i galleriet', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Betygs�tt den h�r bilden ',
    'no_votes' => '(Ingen r�st �n)',
    'rating' => '(nuvarande betyg : %s / 5 fr�n %s r�ster)',
    'rubbish' => 'Skr�p',
    'poor' => 'Kass',
    'fair' => 'Godk�nd',
    'good' => 'Bra',
    'excellent' => 'Mycket bra',
    'great' => 'B�st',
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
    CRITICAL_ERROR => 'Kritiskt fel',
    'file' => 'Fil: ',
    'line' => 'Rad: ',
    );

$lang_display_thumbnails = array('filename' => 'Filnamn : ',
    'filesize' => 'Filstorlek : ',
    'dimensions' => 'Bildstorlek : ',
    'date_added' => 'Inlagd den : '
    );

$lang_get_pic_data = array('n_comments' => '%s kommentarer',
    'n_views' => '%s visade',
    'n_votes' => '(%s r�ster)'
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
        'Question' => 'Fr�ga',
        'Very Happy' => 'Mycket glad',
        'Smile' => 'Smil',
        'Sad' => 'Ledsen',
        'Surprised' => '�verraskad',
        'Shocked' => 'Kv�vd',
        'Confused' => 'F�rbryllad',
        'Cool' => 'Cool',
        'Laughing' => 'Skrattande',
        'Mad' => 'Galen',
        'Razz' => 'Razz',
        'Embarassed' => 'F�rl�gen',
        'Crying or Very sad' => 'Gr�ter eller Mycket ledsen',
        'Evil or Very Mad' => 'Elak eller mycket arg',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rullande �gon',
        'Wink' => 'Blink',
        'Idea' => 'Ide',
        'Arrow' => 'Pil',
        'Neutral' => 'Neutral',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'L�mnar admin l�ge...',
        1 => 'Startar admin l�ge...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Album m�ste namnges!',
        'confirm_modifs' => '�r du s�ker p� att du vill g�ra dessa f�r�ndringar?',
        'no_change' => 'Du gjorde ingen f�r�ndring!',
        'new_album' => 'Nytt album',
        'confirm_delete1' => '�r du s�ker p� att du vill radera detta album?',
        'confirm_delete2' => '\nAlla bilder och dess kommentarer kommer att f�rloras!',
        'select_first' => 'V�lj ett album f�rst',
        'alb_mrg' => 'Albumhanterare',
        'my_gallery' => '* Mitt galleri *',
        'no_category' => '* Ingen kategori *',
        'delete' => 'Radera',
        'new' => 'Nytt',
        'apply_modifs' => 'Verkst�ll f�r�ndringar',
        'select_category' => 'V�lj kategori',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametrar som kr�vs f�r \'%s\'operationen st�ds inte!',
        'unknown_cat' => 'Giltig kategori finns inte i databasen',
        'usergal_cat_ro' => 'Kategorin Anv�ndargalleri kan inte raderas!',
        'manage_cat' => 'Inst�llningar f�r kategorier',
        'confirm_delete' => '�r du s�ker att du vill RADERA denna kategori',
        'category' => 'Kategori',
        'operations' => 'Operationer',
        'move_into' => 'Flytta till',
        'update_create' => 'Uppdatera/Skapa kategori',
        'parent_cat' => 'Huvudkategori',
        'cat_title' => 'Kategorititel',
        'cat_desc' => 'Kategoribeskrivning'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Konfiguration',
        'restore_cfg' => '�terst�ll systemets grundinst�llningar',
        'save_cfg' => 'Spara ny konfiguration',
        'notes' => 'Anm.',
        'info' => 'Information',
        'upd_success' => 'Coppermine konfigurationen uppdaterades',
        'restore_success' => 'Coppermines grundinst�llning �terskapades',
        'name_a' => 'Namn stigande',
        'name_d' => 'Namn fallande',
        'title_a' => 'Titel stigande',
        'title_d' => 'Titel fallande',
        'date_a' => 'Datum stigande',
        'date_d' => 'Datum fallande',
        'rating_a' => 'V�rdering stigande', // new in cpg1.2.0nuke
        'rating_d' => 'V�rdering fallande', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspekt',
        'th_ht' => 'H�jd',
        'th_wd' => 'Vidd',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Generella inst�llningar',
        array(
            'Galleri namn', 'gallery_name', 0),
        array(
            'Galleri beskrivning', 'gallery_description', 0),
        array(
            'Galleri administrat�r e-post', 'gallery_admin_email', 0),
        array(
            'Adress till nukemapp dvs http://www.mysite.tld/html/', 'ecards_more_pic_target', 0),
        array(
            'Spr�k', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array(
            'Sid Specifika Titlar ist�llet f�r >Coppermine', 'nice_titles', 1), 
        array('Visa block till h�ger', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Utseende f�r albumlista',
        array(
            'Bredd p� huvudtabell (pixlar eller %)', 'main_table_width', 0),
        array(
            'Antal underkategorier att visa', 'subcat_level', 0),
        array(
            'Antal album att visa', 'albums_per_page', 0),
        array(
            'Antal kolumner i albumlista', 'album_list_cols', 0),
        array(
            'Storlek p� miniatyrbilder i pixlar', 'alb_list_thumb_size', 0),
        array(
            'Inneh�ll p� huvudsidan', 'main_page_layout', 0),
        array(
            'Visa f�rsta underkategorins miniatyrbilder i kategorierna', 'first_level', 1), 
        // 'Thumbnail view',
        'Utseende f�r miniatyrbildsfunktion',
        array(
            'Antal kolumner p� miniatyrbildssida', 'thumbcols', 0),
        array(
            'Antal rader p� miniatyrbildssida', 'thumbrows', 0),
        array(
            'Max antal flikar att visa', 'max_tabs', 0),
        array(
            'Visa bildrubrik (inkl. titel) nedanf�r miniatyrbild', 'caption_in_thumbview', 1),
        array(
            'Visa antalet kommentarer under miniatyrbild', 'display_comment_count', 1),
        array(
            'Grundinst�llning f�r sortering av bilder', 'default_sort_order', 3),
        array(
            'Minimum antal r�ster f�r en bild f�r att det ska synas i \'topplistan\' ', 'min_votes_for_rating', 0),
        array(
            'Alts och titeltaggar av miniatyrbild visar titel och nyckelord ist�llet f�r bildinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Utseende f�r bilder &amp; inst�llningar f�r kommentarer',
        array(
            'Tabellbredd f�r bildvisning (pixlar eller %)', 'picture_table_width', 0),
        array(
            'Bildinformation �r synlig som grundinst�llning', 'display_pic_info', 1),
        array(
            'Filtrera fula ord i kommentarer', 'filter_bad_words', 1),
        array(
            'Till�t smilies i kommentarer', 'enable_smilies', 1),
        array(
            'Till�t flera p�f�ljande kommentarer om en bild fr�n samma anv�ndare', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'E-posta sajtens admin vid kommentarsbidrag' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Max l�ngd p� bildbeskrivning', 'max_img_desc_length', 0),
        array(
            'Max antal tecken i ett ord', 'max_com_wlength', 0),
        array(
            'Max antal p� rader i en kommentar', 'max_com_lines', 0),
        array(
            'Max l�ngd p� en kommentar', 'max_com_size', 0),
        array(
            'Visa filmsekvens', 'display_film_strip', 1),
        array(
            'Antal objekt i en filmsekvens', 'max_film_strip_items', 0),
        array(
            'Till�t visning av bilder i full storlek av anonym', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
        // 'Pictures and thumbnails settings',
        'Bild- och miniatyrbildsinst�llningar',
        array(
            'Kvalitet p� JPEG filer', 'jpeg_qual', 0),
        array(
            'Max dimension p� en miniatyrbild <strong>*</strong>', 'thumb_width', 0),
        array(
            'Anv�nda dimensioner (bredd eller h�jd eller Maxstorlek f�r miniatyrbild)<strong>*</strong>', 'thumb_use', 7),
        array(
            'Skapa mellanliggande bilder', 'make_intermediate', 1),
        array(
            'Max bredd eller h�jd p� en mellanliggande bild <strong>*</strong>', 'picture_width', 0),
        array(
            'Max storlek f�r uppladdade bilder (KB)', 'max_upl_size', 0),
        array(
            'Max bredd eller h�jd f�r uppladdade bilder (pixlar)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Anv�ndarinst�llningar',
        array(
            'Till�t nya anv�ndare att registreras', 'allow_user_registration', 1),
        array(
            'Anv�ndarregistrering kr�ver e-postverifiering', 'reg_requires_valid_email', 1),
        array(
            'Till�t tv� anv�ndare att ha samma e-postadress', 'allow_duplicate_emails_addr', 1),
        array(
            'Anv�ndare kan ha privata album', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
        // 'Custom fields for image description (leave blank if unused)',
        'Valfria f�lt f�r bildbeskrivningar (l�mna blankt om du inte vill anv�nda funktionen)',
        array(
            'F�lt 1 namn', 'user_field1_name', 0),
        array(
            'F�lt 2 namn', 'user_field2_name', 0),
        array(
            'F�lt 3 namn', 'user_field3_name', 0),
        array(
            'F�lt 4 namn', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Avancerade inst�llningar f�r bilder och miniatyrbilder',
        array(
            'Visa ikon f�r privata album f�r ej inloggade anv�ndare', 'show_private', 1),
        array(
            'F�rbjudna tecken i filnamn', 'forbiden_fname_char', 0),
        array(
            'Accepterade fil�ndelser f�r uppladdade bilder', 'allowed_file_extensions', 0),
        array(
            'Metod f�r �ndra bildstorleksf�r�ndring', 'thumb_method', 2),
        array(
            'S�kv�g till ImageMagick \'konverterings\' funktion (exempel /usr/bin/X11/)', 'impath', 0),
        array(
            'Till�tna bildformat (g�ller endast f�r ImageMagick)', 'allowed_img_types', 0),
        array(
            'Kommandolinjeval f�r ImageMagick', 'im_options', 0),
        array(
            'L�s EXIF data i JPEG filer', 'read_exif_data', 1),
        array(
            'L�s IPTC data i JPEG filer', 'read_iptc_data', 1),
        array(
            'Albumbibliotek <strong>*</strong>', 'fullpath', 0),
        array(
            'Bibliotek f�r anv�ndarnas bilder <strong>*</strong>', 'userpics', 0),
        array(
            'Prefix f�r mellanliggande bilder <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefix f�r miniatyrbilder <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Standardl�ge f�r bibliotek', 'default_dir_mode', 0),
        array(
            'Standardl�ge f�r bilder', 'default_file_mode', 0),
        array(
            'Bildinfo visa filnamn', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa albumnamn', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa_filstorlek', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa dimensioner', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa antal visningar', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa URL som bokm�rkesl�nk', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa favvo albuml�nk', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        // 'Cookies &amp; Charset settings',
        'Inst�llningar f�r cookies &amp; teckenkodning',
        array(
            'Namn p� cookie som scriptet anv�nder sig av', 'cookie_name', 0),
        array(
            'S�kv�g till cookie som scriptet anv�nder sig av', 'cookie_path', 0),
        array(
            'Teckenkodning', 'charset', 4), 
        // 'Miscellaneous settings',
        '�vriga inst�llningar',
        array(
            'Aktivera debuggl�ge', 'debug_mode', 1),
        array(
'Sl� p� avancerat debuggl�ge', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Visa Coppermine Uppdatering Varning f�r Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) F�lt m�rkta med * f�r INTE �ndras om du redan har bilder i ditt galleri</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
     'empty_name_or_com' => 'Du m�ste skriva ditt namn och en kommentar',
        'com_added' => 'Din kommentar �r inlagd',
        'alb_need_title' => 'Du m�ste ge albumet en titel!',
        'no_udp_needed' => 'Ingen uppdatering beh�vs.',
        'alb_updated' => 'Album uppdaterades',
        'unknown_album' => 'Valt album existerar inte eller s� har du inte r�ttigheter att ladda upp i detta album',
        'no_pic_uploaded' => 'Ingen bild laddades upp!<br /><br />Om du �r s�ker p� att du valt en bild f�r uppladdning, kontrollera att servern till�ter uppladdning...',
        'err_mkdir' => 'Misslyckades att skapa biblioteket %s !',
        'dest_dir_ro' => 'M�lbiblioteket %s �r inte skrivbart av scriptet!',
        'err_move' => 'Om�jligt att flytta %s till %s !',
        'err_fsize_too_large' => 'Bildstorleken du laddat upp �r f�r stor (max till�tet �r %s x %s) !',
        'err_imgsize_too_large' => 'Storleken p� filen du laddat upp �r f�r stor (max till�tet �r %s KB) !',
        'err_invalid_img' => 'Filen du laddat upp �r inte i till�tet format!',
        'allowed_img_types' => 'Du kan bara ladda upp %s bilder.',
        'err_insert_pic' => 'Bilden \'%s\' kan inte infogas i albumet ',
        'upload_success' => 'Din bild laddades upp utan problem<br /><br />Den kommer att bli synlig efter att admin godk�nt den.',
        'info' => 'Information',
        'com_added' => 'Kommentar inlagd',
        'alb_updated' => 'Album uppdaterat',
        'err_comment_empty' => 'Din kommentar �r tom!',
        'err_invalid_fext' => 'Endast filer med f�ljande �ndelser �r till�tna: <br /><br />%s.',
        'no_flood' => 'Ledsen men du �r redan f�rfattare av den senaste kommentaren som �r inlagd f�r den h�r bilden<br /><br />�ndra den redan inlagda kommentaren om du vill �mdra n�got',
        'redirect_msg' => 'Du f�rflyttas.<br /><br /><br /Klicka \'FORTS�TT\' om inte sidan uppdateras automatiskt',
        'upl_success' => 'Din bild infogades utan problem.',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Rubrik',
        'fs_pic' => 'full storlek p� bild',
        'del_success' => 'Radering lyckades',
        'ns_pic' => 'normal storlek p� bild',
        'err_del' => 'kan inte raderas',
        'thumb_pic' => 'miniatyrbild',
        'comment' => 'kommentar',
        'im_in_alb' => 'bild i album',
        'alb_del_success' => 'Album \'%s\' raderades',
        'alb_mgr' => 'Albumhanterare',
        'err_invalid_data' => 'Ogiltig data mottogs i \'%s\'',
        'create_alb' => 'Skapar album \'%s\'',
        'update_alb' => 'Uppdaterar album \'%s\' med titeln \'%s\' och index \'%s\'',
        'del_pic' => 'Radera bild',
        'del_alb' => 'Radera album',
        'del_user' => 'Radera anv�ndare',
        'err_unknown_user' => 'Vald anv�ndare finns inte!',
        'comment_deleted' => 'Kommentaren raderades utan problem',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => '�r du s�ker p� att du vill RADERA denna bild?  \\nKommentarerna kommer ocks� att tas bort.',
        'del_pic' => 'RADERA DENNA BILD',
        'size' => '%s x %s pixlar',
        'views' => '%s g�nger',
        'slideshow' => 'Bildspel',
        'stop_slideshow' => 'STOPPA BILDSPEL',
        'view_fs' => 'Klicka f�r att se fullstorlek p� bilden',
        'edit_pic' => 'REDIGERA BILD INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Bildinformation',
        'Filename' => 'Filnamn',
        'Album name' => 'Albumnamn',
        'Rating' => 'Betyg (%s r�ster)',
        'Keywords' => 'Nyckelord',
        'File Size' => 'Filstorlek',
        'Dimensions' => 'Dimensioner',
        'Displayed' => 'Visat',
        'Camera' => 'Kamera',
        'Date taken' => 'Datum f�r fototillf�lle',
        'Aperture' => 'Slutare',
        'Exposure time' => 'Exponeringstid',
        'Focal length' => 'Fokall�ngd',
        'Comment' => 'Kommentar',
        'addFav' => 'L�gg till Fav',
        'addFavPhrase' => 'Favoriter',
        'remFav' => 'Ta bort fr�n Fav',
        'iptcTitle' => 'IPTC Titel', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Nyckelord', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Kategori', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Underkategori', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bokm�rkes Bild', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Redigera denna kommentar',
        'confirm_delete' => '�r du s�ker p� att du vill radera denna kommentar?',
        'add_your_comment' => 'L�gg till din kommentar',
        'name' => 'Namn',
        'comment' => 'Kommentar',
        'your_name' => 'Anonym',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klicka p� bilden f�r att st�nga det h�r f�nstret',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Skicka ett e-vykort',
        'invalid_email' => '<strong>Varning</strong> : felaktig e-postadress !',
        'ecard_title' => 'Ett e-vykort fr�n %s till dig!',
        'view_ecard' => 'Klicka p� den h�r l�nken om inte e-vykortet visas riktigt',
        'view_more_pics' => 'Klicka p� den h�r l�nken f�r att se fler bilder!',
        'send_success' => 'Ditt e-vykort skickades',
        'send_failed' => 'Ledsen men servern kan inte skicka ditt e-vykort...',
        'from' => 'Fr�n',
        'your_name' => 'Ditt namn',
        'your_email' => 'Din e-postadress',
        'to' => 'Till',
        'rcpt_name' => 'Mottagarens namn',
        'rcpt_email' => 'Mottagarens e-postadress',
        'greetings' => 'Hej!',
        'message' => 'Meddelande',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Bildinfo',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beskrivning',
        'keywords' => 'Nyckelord',
        'pic_info_str' => '%sx%s - %sKB - %s visningar - %s r�ster',
        'approve' => 'Godk�nn bild',
        'postpone_app' => 'Senarel�gg godk�nnande',
        'del_pic' => 'Radera bild',
        'reset_view_count' => 'Nollst�ll r�knare f�r bildbes�kare',
        'reset_votes' => 'Nollst�ll r�ster',
        'del_comm' => 'Radera kommentarer',
        'upl_approval' => 'Godk�nnande f�r uppladdning',
        'edit_pics' => 'Redigera bilder',
        'see_next' => 'Se kommande bild',
        'see_prev' => 'Se f�reg�ende bilder',
        'n_pic' => '%s bilder',
        'n_of_pic_to_disp' => 'Antal bilder att visa',
        'apply' => 'Verkst�ll f�r�ndringar'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Gruppnamn',
        'disk_quota' => 'Diskkvot',
        'can_rate' => 'Kan betygs�tta bilder',
        'can_send_ecards' => 'Kan skicka e-vykort',
        'can_post_com' => 'Kan skriva kommentarer',
        'can_upload' => 'Kan ladda upp bilder',
        'can_have_gallery' => 'Kan ha ett personligt galleri',
        'apply' => 'Verkst�ll f�r�ndringar',
        'create_new_group' => 'Skapa ny grupp',
        'del_groups' => 'Radera vald grupp(er)',
        'confirm_del' => 'Varning, n�r du raderar en grupp kommer anv�ndare i den gruppen att flyttas till gruppen \'Registrerad\' !\n\nVill du forts�tta ?',
        'title' => 'Behandla anv�ndargrupper',
        'approval_1' => 'Pub. Uppl. godk�nnande (1)',
        'approval_2' => 'Priv. Uppl. godk�nnande (2)',
        'note1' => '<strong>(1)</strong> Uppladdningar i ett publikt album kr�ver godk�nnande fr�n admin',
        'note2' => '<strong>(2)</strong> Uppladdningar i ett album som tillh�r anv�ndare kr�ver godk�nnande fr�n admin',
        'notes' => 'Anteckningar',
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'V�lkommen!'
        );

    $lang_album_admin_menu = array('confirm_delete' => '�r du s�ker att du vill RADERA detta album? \\nAlla bilder och kommentarer kommer �ven att raderas.',
        'delete' => 'RADERA',
        'modify' => 'EGENSKAPER',
        'edit_pics' => 'REDIGERA BILDER',
        );

    $lang_list_categories = array('home' => 'Hem',
        'stat1' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album och <strong>[cat]</strong> kategorier med <strong>[comments]</strong> kommentarer visade <strong>[views]</strong> g�nger',
        'stat2' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album visade <strong>[views]</strong> g�nger',
        'xx_s_gallery' => '%s\'s Galleri',
        'stat3' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album med <strong>[comments]</strong> kommentarer visade <strong>[views]</strong> g�nger'
        );

    $lang_list_users = array('user_list' => 'Anv�ndarlista',
        'no_user_gal' => 'Det finns inga anv�ndargallerier',
        'n_albums' => '%s album',
        'n_pics' => '%s bild(er)'
        );

    $lang_list_albums = array('n_pictures' => '%s bilder',
        'last_added' => ', senaste inlagd den %s'
        );
} 
// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File logout.php
// / ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Uppdatera album %s',
        'general_settings' => 'Generella inst�llningar',
        'alb_title' => 'Album titel',
        'alb_cat' => 'Album kategori',
        'alb_desc' => 'Album beskrivning',
        'alb_thumb' => 'Album miniatyrbild',
        'alb_perm' => 'R�ttigheter f�r detta album',
        'can_view' => 'Album kan ses av',
        'can_upload' => 'Bes�kare kan ladda upp bilder',
        'can_post_comments' => 'Bes�kare kan kommentera',
        'can_rate' => 'Bes�kare kan betygs�tta bilder',
        'user_gal' => 'Anv�ndargalleri',
        'no_cat' => '* Ingen kategori *',
        'alb_empty' => 'Album �r tomt',
        'last_uploaded' => 'Senast uppladdat',
        'public_alb' => 'Alla (publikt album)',
        'me_only' => 'Endast jag',
        'owner_only' => 'Endast album�gare (%s)',
        'groupp_only' => 'Medlemmar av gruppen \'%s\'',
        'err_no_alb_to_modify' => 'Inget album att redigera i databasen.',
        'update' => 'Uppdatera album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Ledsen men du har redan betygsatt den h�r bilden',
        'rate_ok' => 'Din r�st �r registrerad',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Fast�n administrat�rer p� den h�r sajten (SITE_NAME) f�rs�ker att ta bort eller �ndra allt st�rande eller st�tande material s� fort som m�jligt, �r det om�jligt att g� igenom alla meddelanden. Vi vill d�rf�r meddela dig om att alla inl�gg som skrivits p� de h�r forumet uttrycker vad f�rfattaren t�nker och tycker, och administrat�rer inte skall st� till ansvar f�r det (f�rutom f�r det de sj�lva lagt in).<br />
<br />
Du g�r med p� att inte posta n�got st�rande, st�tande, rasistiskt, sexistiskt, vulg�rt, hatiskt, hotande eller n�got annat material som kan t�nkas bryta mot n�gon till�mplig lag. Om du bryter mot det h�r kan det leda till att du blir permanent avst�ngd fr�n forumen (och din Internet leverant�r blir kontaktad). Ip adressen av alla meddelanden sparas f�r att st�rka de h�r vilkoren. Du g�r med p� att webmaster, administrat�r och moderatorer har r�tt att ta bort, �ndra, flytta eller st�nga vilka inl�gg som helst n�r som helst. Som en anv�ndare g�r du med p� att all information som du skrivit in sparas i databasen. Den informationen kommer INTE att distribueras till n�gon 3:e part utan ditt samtycke. Webmastern, administrat�ren eller moderatorer kan inte h�llas ansvariga vid hackningsf�rs�k som kan leda till att data stj�ls. <br />
<br />
Det h�r systemet anv�nder cookies till att spara information p� din dator. Dessa cookies inneh�ller inte n�got av den information du skrivit in, utan anv�nds endast f�r att g�ra ditt anv�ndande av forumet b�ttre och smidigare. E-postadressen anv�nds bara f�r att aktivera din registrering, samt f�r omregistrering vid t.ex. byte av din e-postadress.<br />
<br />
Genom att klicka p� knappen "Ja" nedan godk�nner du villkoren ovan.

EOT;

    $lang_register_php = array('page_title' => 'Anv�ndarregistrering',
        'term_cond' => 'Anv�ndarvillkor',
        'i_agree' => 'Jag godk�nner',
        'submit' => 'Skicka registrering',
        'err_user_exists' => 'Anv�ndarnamnet du skrev in finns redan, v�lj ett nytt',
        'err_password_mismatch' => 'L�senorden st�mmer inte med varandra, skriv in dem igen',
        'err_uname_short' => 'Anv�ndarnamnet m�ste vara minst 2 tecken l�ngt',
        'err_password_short' => 'L�senordet m�ste vara minst 2 tecken l�ngt',
        'err_uname_pass_diff' => 'Anv�ndarnamn och l�senord f�r inte vara olika',
        'err_invalid_email' => 'E-postadressen �r ogiltig',
        'err_duplicate_email' => 'En annan anv�ndare har redan registrerat den e-postadress du skrev',
        'enter_info' => 'Fyll i registreringsinformation',
        'required_info' => 'Obligatorisk information',
        'optional_info' => 'Valfri information',
        'username' => 'Anv�ndarnamn',
        'password' => 'L�senord',
        'password_again' => 'Skriv l�senordet igen',
        'email' => 'E-post',
        'location' => 'Plats',
        'interests' => 'Intressen',
        'website' => 'Hemsida',
        'occupation' => 'Yrke',
        'error' => 'FEL',
        'confirm_email_subject' => '%s - Registreringsinformation',
        'information' => 'Information',
        'failed_sending_email' => 'Registreringsinformationen kan inte skickas!',
        'thank_you' => 'Tack f�r din registrering.<br /><br />Ett e-postmeddelande med information om hur du ska aktivera ditt konto skickades till den e-postadress du angav.',
        'acct_created' => 'Ditt konto har skapats och du kan nu logga in med ditt anv�ndarnamn och l�senord',
        'acct_active' => 'Ditt konto �r nu aktivt och du kan nu logga in med ditt anv�ndarnamn och l�senord',
        'acct_already_act' => 'Ditt konto �r redan aktiverat!',
        'acct_act_failed' => 'Detta konto kan inte aktiveras!',
        'err_unk_user' => 'Vald anv�ndare finns inte!',
        'x_s_profile' => '%s\'s profil',
        'group' => 'Grupp',
        'reg_date' => 'Blev medlem',
        'disk_usage' => 'Diskanv�ndning',
        'change_pass' => 'Byt l�senord',
        'current_pass' => 'Nuvarande l�senord',
        'new_pass' => 'Nytt l�senord',
        'new_pass_again' => 'Nytt l�senord igen',
        'err_curr_pass' => 'Detta l�senord �r inte korrekt',
        'apply_modif' => 'Verkst�ll �ndringar',
        'change_pass' => '�ndra mitt l�senord',
        'update_success' => 'Din profil uppdaterades',
        'pass_chg_success' => 'Ditt l�senord �ndrades',
        'pass_chg_error' => 'Ditt l�senord �ndrades inte',
        );

    $lang_register_confirm_email = <<<EOT
Tack f�r att du registrerade dig p� {SITE_NAME}

Ditt anv�ndarnamn �r : "{USER_NAME}"
Ditt l�senord �r : "{PASSWORD}"

F�r att ditt konto ska aktiveras m�ste du klicka p� nedanst�ende l�nk
eller kopiera och klistra in den i din webbl�sare.

{ACT_LINK}

V�nligen,

Administrat�ren av {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Granska kommentarer',
        'no_comment' => 'Det finns ingen kommentar att granska',
        'n_comm_del' => '%s kommentar(er) raderade',
        'n_comm_disp' => 'Antal kommentarer att visa',
        'see_prev' => 'Se f�reg�ende',
        'see_next' => 'Se n�sta',
        'del_comm' => 'Radera valda kommentarer',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'S�k i bildkollektionen',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'S�k efter nya bilder',
        'select_dir' => 'V�lj bibliotek',
        'select_dir_msg' => 'Den h�r funktionen g�r det m�jligt att l�gga till ett parti med foton som du laddat upp p� servern via FTP.<br /><br />V�lj biblioteket d�r bilderna finns.',
        'no_pic_to_add' => 'Det finns ingen bild att l�gga till',
        'need_one_album' => 'Du m�ste minst ha ett album f�r att kunna anv�nda denna funktion',
        'warning' => 'Varning',
        'change_perm' => 'scriptet kan inte skriva i detta bibliotek, du m�ste �ndra r�ttigheterna i det till 755 eller 777 innan du kan l�gga till bilder!',
        'target_album' => '<strong>L�gg bilderna &quot;</strong>%s<strong>&quot; i </strong>%s',
        'folder' => 'Mapp',
        'image' => 'Bild',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Inte skrivbart. ',
        'dir_cant_read' => 'Inte l�sbart. ',
        'insert' => 'L�gger till nya bilder i galleriet',
        'list_new_pic' => 'F�rteckning p� nya bilder',
        'insert_selected' => 'S�tt in valda bilder',
        'no_pic_found' => 'Ingen ny bild hittades',
        'be_patient' => 'Ha t�lamod, scriptet beh�ver lite tid att bearbeta bilderna',
        'notes' => '<ul>' . '<li><strong>OK</strong> : betyder att bilden blev inlagd' . '<li><strong>DP</strong> : betyder att bilden �r en kopia och redan finns i databasen' . '<li><strong>PB</strong> : betyder att bilden inte kunde l�ggas till, kontrollera din konfiguration och r�ttigheterna i biblioteken d�r bilderna ska placeras' . '<li>Om OK, DP, PB \'symbolen\' inte visas, klicka p� den felaktiga bilden f�r att se felmeddelandet som skapats av PHP' . '<li>Om din din browser g�r timeout, tryck p� knappen \'Uppdatera\'' . '</ul>',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  //not in cpg1.2.0-nuke
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Ladda upp bild',
        'max_fsize' => 'Max filstorlek �r %s KB',
        'album' => 'Album',
        'picture' => 'Bild',
        'pic_title' => 'Bildtitel',
        'description' => 'Bildbeskrivning',
        'keywords' => 'Nyckelord (avskiljda med mellanslag)',
        'err_no_alb_uploadables' => 'Ledsen, men det finns inget album d�r du har till�telse att ladda upp bilder i',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Anv�ndarinst�llningar',
        'name_a' => 'Namn stigande',
        'name_d' => 'Namn fallande',
        'group_a' => 'Grupp stigande',
        'group_d' => 'Grupp fallande',
        'reg_a' => 'Reg datum stigande',
        'reg_d' => 'Reg datum fallande',
        'pic_a' => 'Bildr�knare stigande',
        'pic_d' => 'Bildr�knare fallande',
        'disku_a' => 'Diskanv�ndande stigande',
        'disku_d' => 'Diskanv�ndande fallande',
        'sort_by' => 'Sortera anv�ndare i',
        'err_no_users' => 'Anv�ndartabell �r tom!',
        'err_edit_self' => 'Du kan inte redigera din egen profil, anv�nd \'Min profil\' l�nken f�r det',
        'edit' => 'REDIGERA',
        'delete' => 'RADERA',
        'name' => 'Anv�ndarnamn',
        'group' => 'Grupp',
        'inactive' => 'Inaktiv',
        'operations' => 'Funktioner',
        'pictures' => 'Bilder',
        'disk_space' => 'Utrymme anv�nt / Kvot',
        'registered_on' => 'Registrerad den',
        'u_user_on_p_pages' => '%d anv�ndare p� %d sida(or)',
        'confirm_del' => '�r du s�ker att du vill RADERA denna anv�ndare? \\nAlla bilder och album kommer �ven att raderas f�r denna anv�ndare.',
        'mail' => 'E-POST',
        'err_unknown_user' => 'Vald anv�ndare finns inte!',
        'modify_user' => 'Spara anv�ndare',
        'notes' => 'Anteckningar',
        'note_list' => '<li>Om du inte vill �ndra nuvarande l�senord, l�mna "l�senord" f�ltet blankt',
        'password' => 'L�senord',
        'user_active' => 'Anv�ndaren �r aktiv',
        'user_group' => 'Anv�ndargrupp',
        'user_email' => 'Anv�ndar e-post',
        'user_web_site' => 'Anv�ndarens hemsida',
        'create_new_user' => 'Skapa ny anv�ndare',
        'user_from' => 'Anv�ndarens plats',
        'user_interests' => 'Anv�ndarens intressen',
        'user_occ' => 'Anv�ndarens yrke',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Storleks�ndra bilder',
        'what_it_does' => 'Vad den g�r',
        'what_update_titles' => 'Uppdatera titlar fr�n filnamnet',
        'what_delete_title' => 'Radera titlar',
        'what_rebuild' => '�teruppbygger miniatyrbilder och storleks�ndrade bilder',
        'what_delete_originals' => 'Raderar bildstorlek p� originalet och ers�tter den med den storleks�ndrade versionen',
        'file' => 'Fil',
        'title_set_to' => 'titel satt till',
        'submit_form' => 'skicka',
        'updated_succesfully' => 'uppdatering lyckades',
        'error_create' => 'FEL vid skapande av',
        'continue' => 'Bearbeta fler bilder',
        'main_success' => 'Filen %s anv�nds nu som huvudbild',
        'error_rename' => 'Fel vid namnbyte fr�n %s till %s',
        'error_not_found' => 'Filen %s hittades inte',
        'back' => 'tillbaka till huvudsidan',
        'thumbs_wait' => 'Uppdaterar miniatyrbilder och/eller storleks�ndrade bilder, v.v. v�nta...',
        'thumbs_continue_wait' => 'Forts�tter att uppdatera miniatyrbilder och/eller storleksf�r�ndrade bilder...',
        'titles_wait' => 'Uppdaterar titlar, v.v. v�nta...',
        'delete_wait' => 'Raderar titlar, v.v. v�nta...',
        'replace_wait' => 'Raderar original och ers�tter dem med storleksf�r�ndrade bilder, v.v. v�nta..',
        'instruction' => 'Snabbinstruktioner',
        'instruction_action' => 'V�lj funktion',
        'instruction_parameter' => 'S�tt parametrar',
        'instruction_album' => 'V�lj album',
        'instruction_press' => 'Tryck %s',
        'update' => 'Uppdatera miniatyrbilder och/eller storleksf�r�ndrade bilder',
        'update_what' => 'Vad som ska uppdateras',
        'update_thumb' => 'Endast miniatyrbilder',
        'update_pic' => 'Endast storleksf�r�ndrade bilder',
        'update_both' => 'B�de miniatyrbilder och storleksf�r�ndrade bilder',
        'update_number' => 'Antal bearbetade bilder per klick',
        'update_option' => '(F�rs�k att st�lla detta alternativ l�gre om du f�r timeout problem)',
        'filename_title' => 'Filnamn &rArr; Bildtitel',
        'filename_how' => 'Hur ska filnamnet �ndras',
        'filename_remove' => 'Ta bort .jpg �ndelsen och ers�tt _ (understruket) med mellanslag',
        'filename_euro' => '�ndra 2003_11_23_13_20_20.jpg till 23/11/2003 13:20',
        'filename_us' => '�ndra 2003_11_23_13_20_20.jpg till 11/23/2003 13:20',
        'filename_time' => '�ndra 2003_11_23_13_20_20.jpg till 13:20',
        'delete' => 'Radera bildtitlar eller originalbildstorlek',
        'delete_title' => 'Radera bildtitlar',
        'delete_original' => 'Radera originalbildstorlek',
        'delete_replace' => 'Raderar orginalbilder och ers�tter med storleksf�r�ndrade versioner',
        'select_album' => 'V�lj album',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(// new in cpg1.2.0nuke
    // new in cpg1.2.0 nuke    'separator' => '>',
    'viewing' => 'Visa Foto',
    'usr' => "'s Foto Galleri",
    'photogallery' => 'Foto Galleri',
    );

?>