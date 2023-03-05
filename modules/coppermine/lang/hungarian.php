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

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Hungarian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Magyar', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '????????' or 'Espa�ol'
    'lang_country_code' => 'hu', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Peter Ardo', // the name of the translator - can be a nickname
    'trans_email' => 'petardo@freemail.hu', // translator's email address (optional)
    'trans_website' => '', // translator's website (optional)
    'trans_date' => '2003-10-20', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('byte', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('H', 'K', 'Sze', 'Cs', 'P', 'Szo', 'V');
$lang_month = array('Jan', 'Feb', 'M�r', '�pr', 'M�j', 'J�n', 'J�l', 'Aug', 'Szept', 'Okt', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Igen';
$lang_no = 'Nem';
$lang_back = 'VISSZA';
$lang_continue = 'TOV�BB';
$lang_info = 'Inform�ci�';
$lang_error = 'Hiba';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%Y %B %d';
$lastcom_date_fmt = '%y.%m.%d %H:%M';
$lastup_date_fmt = '%Y %B %d';
$register_date_fmt = '%Y %B %d';
$lasthit_date_fmt = '%Y %B %d %H:%M';
$comment_date_fmt = '%Y %B %d %H:%M';
// For the word censor
$lang_bad_words = array('basz*', 'segg*', 'fasz*', 'kurva*', 'picsa', 'geci');

$lang_meta_album_names = array('random' => 'V�letlen k�plista',
    'lastup' => 'Friss felt�lt�sek',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Utolj�ra m�dos�tott albumok',
    'lastcom' => 'Friss hozz�sz�l�sok',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Legt�bbsz�r n�zett',
    'toprated' => 'Legt�bb szavazat',
    'lasthits' => 'Utolj�ra n�zett',
    'search' => 'Keres�s eredm�nye',
    'favpics' => 'Kedvenc k�peim'
    );

$lang_errors = array('access_denied' => 'Nincs jogosults�god ennek az oldalnak a megtekint�s�hez.',
    'perm_denied' => 'Nincs jogosults�god ennek a m�veletnek az elv�gz�s�hez.',
    'param_missing' => 'Szkript h�v�s a sz�ks�ge param�ter(ek) megad�sa n�lk�l.',
    'non_exist_ap' => 'A kijel�lt album / k�p nem tal�lhat�!',
    'quota_exceeded' => 'Diszk kv�ta t�ll�pve<br /><br />A be�ll�tott diszkkv�ta [quota]K, a k�peid �ltal jelenleg elfoglalt t�rhely [space]K, ennek a k�pnek a felt�lt�s�vel t�ll�pn�d a kv�t�j�t.',
    'gd_file_type_err' => 'GD k�nyvt�r haszn�lata eset�n csak JPEG �s PNG t�pusok megengedettek.',
    'invalid_image' => 'A felt�lt�tt k�p s�r�lt, vagy a GD k�nyvt�r �ltal nem kezelhet�',
    'resize_failed' => 'Nem siker�lt az ikoniz�lt vagy �tm�retezett k�pek gener�l�sa.',
    'no_img_to_display' => 'Nincs megjelen�thet� k�p',
    'non_exist_cat' => 'A kijel�lt kateg�ria nem l�tezik',
    'orphan_cat' => 'A kateg�ria sz�l�kateg�ri�ja nem l�tezik, futtasd a kateg�riamenedzsert a probl�ma kik�sz�b�l�s�re.',
    'directory_ro' => 'A \'%s\' k�nyvt�r nem �rhat�, a k�peket nem lehet t�r�lni',
    'non_exist_comment' => 'A kijel�lt hozz�sz�l�s nem l�tezik.',
    'pic_in_invalid_album' => 'K�p nem l�tez� albumban (%s)!?',
    'banned' => 'Jelenleg ki vagy tiltva a weblap haszn�lat�b�l.',
    'not_with_udb' => 'Ez a funkci� le van tiltva a Coppermine-ban, mivel a f�rum sw r�sze. A k�rt funkci�t vagy nem t�mogatja a jelen konfigur�ci�, vagy a f�rum sw kezeli.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'

    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Ugr�s az albumlist�ra',
    'alb_list_lnk' => 'Albumlista',
    'my_gal_title' => 'Ugr�s a szem�lyes k�pt�rra',
    'my_gal_lnk' => '�n k�pt�ram',
    'my_prof_lnk' => '�n profilom',
    'adm_mode_title' => 'V�lt�s adminisztr�tor m�dra',
    'adm_mode_lnk' => 'Adminisztr�tor m�d',
    'usr_mode_title' => 'V�lt�s felhaszn�l� m�dra',
    'usr_mode_lnk' => 'Felhaszn�l� m�d',
    'upload_pic_title' => 'K�p felt�lt�s az albumba',
    'upload_pic_lnk' => 'K�p felt�lt�se',
    'register_title' => 'Felhaszn�l� hozz�ad�sa',
    'register_lnk' => 'Regisztr�ci�',
    'login_lnk' => 'Bejelentkez�s',
    'logout_lnk' => 'Kijelentkez�s',
    'lastup_lnk' => 'Friss felt�lt�sek',
    'lastcom_lnk' => 'Friss hozz�sz�l�sok',
    'topn_lnk' => 'Legt�bbsz�r n�zett',
    'toprated_lnk' => 'Legt�bb szavazat',
    'search_lnk' => 'Keres�s',
    'fav_lnk' => 'Kedvencek',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Felt�lt�s j�v�hagy�s',
    'config_lnk' => 'Konfigur�ci�',
    'albums_lnk' => 'Albumok',
    'categories_lnk' => 'Kateg�ri�k',
    'users_lnk' => 'Felhaszn�l�k',
    'groups_lnk' => 'Csoportok',
    'comments_lnk' => 'Hozz�sz�l�sok',
    'searchnew_lnk' => 'K�tegelt felt�lt�s',
    'util_lnk' => 'K�pek �tm�retez�se',
    'ban_lnk' => 'Felhaszn�l�k kitilt�sa',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Szem�lyes albumok szerkeszt�se',
    'modifyalb_lnk' => 'Szem�lyes albumok tulajdons�gai',
    'my_prof_lnk' => '�n profilom',
    );

$lang_cat_list = array('category' => 'Kateg�ria',
    'albums' => 'Albumok',
    'pictures' => 'K�pek',
    );

$lang_album_list = array('album_on_page' => '%d album %d oldalon'
    );

$lang_thumb_view = array('date' => 'D�TUM',
    'name' => 'N�V',
    'title' => 'K�p c�m',
    'sort_da' => 'D�tum szerinti sorrendez�s, n�vekv�',
    'sort_dd' => 'D�tum szerinti sorrendez�s, cs�kken�',
    'sort_na' => 'N�v szerinti sorrendez�s, n�vekv�',
    'sort_nd' => 'N�v szerinti sorrendez�s, cs�kken�',
    'sort_ta' => 'Sorrendez�s c�m szerint - n�vekv�',
    'sort_td' => 'Sorrendez�s c�m szerint - cs�kken�',
    'pic_on_page' => '%d k�p %d oldalon',
    'user_on_page' => '%d felhaszn�l� %d oldalon',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Vissza az ikonos elrendez�sre',
    'pic_info_title' => 'K�p inform�ci� megtekint�se / elrejt�se',
    'slideshow_title' => 'Diavet�t�s',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'K�p elk�ld�se e-k�peslapk�nt',
    'ecard_disabled' => 'e-k�peslapok k�ld�se nem enged�lyezett',
    'ecard_disabled_msg' => 'Nincs jogosults�god e-k�peslap k�ld�s�re',
    'prev_title' => 'El�z� k�p',
    'next_title' => 'K�vetkez� k�p',
    'pic_pos' => 'K�P %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'K�p oszt�lyoz�sa ',
    'no_votes' => '(M�g nincs oszt�lyozva)',
    'rating' => '(jelenlegi oszt�lyzat: %s, %s szavazattal)',
    'rubbish' => 'Vacak',
    'poor' => 'Gyenge',
    'fair' => 'Megfelel�',
    'good' => 'J�',
    'excellent' => 'Kit�n�',
    'great' => 'Szuper',
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
    CRITICAL_ERROR => 'Kritikus hiba',
    'file' => 'F�jl: ',
    'line' => 'Sor: ',
    );

$lang_display_thumbnails = array('filename' => 'F�jln�v : ',
    'filesize' => 'F�jlm�ret : ',
    'dimensions' => 'M�retek : ',
    'date_added' => 'Felt�lt�s d�tuma : '
    );

$lang_get_pic_data = array('n_comments' => '%s komment�r',
    'n_views' => '%s megtekint�s',
    'n_votes' => '(%s szavazat)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Felki�lt�s',
        'Question' => 'K�rd�s',
        'Very Happy' => 'Nagyon boldog',
        'Smile' => 'Mosolyog',
        'Sad' => 'Szomor�',
        'Surprised' => 'Meglepett',
        'Shocked' => 'Sokkolt',
        'Confused' => 'Zavarodott',
        'Cool' => 'Higgadt',
        'Laughing' => 'Nevet',
        'Mad' => '�r�lt',
        'Razz' => 'G�nyos',
        'Embarassed' => 'K�nos',
        'Crying or Very sad' => 'S�r / nagyon szomor�',
        'Evil or Very Mad' => 'Gonosz vagy �r�lt',
        'Twisted Evil' => 'Torz gonosz',
        'Rolling Eyes' => 'Gurul� szemek',
        'Wink' => 'Kacsint',
        'Idea' => '�tlet',
        'Arrow' => 'Ny�l',
        'Neutral' => 'Semleges',
        'Mr. Green' => 'Mr. Z�ld',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Kil�p�s adminisztr�tor m�db�l...',
        1 => 'V�lt�s adminisztr�tor m�dra...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Az albumokat el kell nevezni!',
        'confirm_modifs' => 'Biztos v�gre akarod hajtani ezt a m�dos�t�st?',
        'no_change' => 'Semmit nem v�ltoztatt�l!',
        'new_album' => '�j album',
        'confirm_delete1' => 'Biztos t�rl�d az albumot?',
        'confirm_delete2' => '\nA tartalmazott �sszes k�p �s hozz�sz�l�s t�rl�dik!',
        'select_first' => 'El�sz�r v�lassz albumot',
        'alb_mrg' => 'Albummenedzser',
        'my_gallery' => '* Az �n k�pt�ram *',
        'no_category' => '* Nincs kateg�ria *',
        'delete' => 'T�rl�s',
        'new' => '�j',
        'apply_modifs' => 'M�dos�t�sok v�grehajt�sa',
        'select_category' => 'V�lassz kateg�ri�t',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'A \'%s\' m�velethez sz�ks�ges param�terek hi�nyoznak!',
        'unknown_cat' => 'Nincs az adatb�zisban a kijel�lt kateg�ria ',
        'usergal_cat_ro' => 'A szem�lyes k�pt�rak nem t�r�lhet�k!',
        'manage_cat' => 'Kateg�ri�k menedzsel�se',
        'confirm_delete' => 'Biztosan t�rl�d ezt a kateg�ri�t?',
        'category' => 'Kateg�ria',
        'operations' => 'M�veletek',
        'move_into' => 'Mozgat�s a k�vetkez�be',
        'update_create' => 'Kateg�ria l�trehoz�s / m�dos�t�s',
        'parent_cat' => 'Sz�l� kateg�ria',
        'cat_title' => 'Kateg�ria megnevez�s',
        'cat_desc' => 'Kateg�ria le�r�sa'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Konfigur�ci�',
        'restore_cfg' => 'Gy�ri be�ll�t�sok',
        'save_cfg' => 'Konfigur�ci� t�rol�sa',
        'notes' => 'Megjegyz�sek',
        'info' => 'Inform�ci�',
        'upd_success' => 'Coppermine konfigur�ci� friss�tve',
        'restore_success' => 'Coppermine gy�ri be�ll�t�s vissza�ll�tva',
        'name_a' => 'N�v - n�vekv�',
        'name_d' => 'N�v - cs�kken�',
        'title_a' => 'C�m szerint - n�vekv�',
        'title_d' => 'C�m szerint - cs�kken�',
        'date_a' => 'D�tum n�vekv�',
        'date_d' => 'D�tum cs�kken�',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        '�ltal�nos be�ll�t�sok',
        array(
            'K�pt�r neve', 'gallery_name', 0),
        array(
            'K�pt�r le�r�sa', 'gallery_description', 0),
        array(
            'K�pt�r adminisztr�tor email c�me', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Nyelv megad�sa', 'lang', 5),
// for postnuke change
        array('Megjelen�t�si t�ma', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',,
        'Albumlista n�zet',
        array(
            'F�t�bl�zat sz�less�ge (pixel vagy %)', 'main_table_width', 0),
        array(
            'Kateg�ri�k megjelen�tend� sz�ma', 'subcat_level', 0),
        array(
            'Oldalank�nt megjelen�tend� albumok sz�ma', 'albums_per_page', 0),
        array(
            'Albumlista oszlopainak sz�ma', 'album_list_cols', 0),
        array(
            'Ikonok m�rete pixelben', 'alb_list_thumb_size', 0),
        array(
            'A f�oldal tartalma', 'main_page_layout', 0),
        array(
            'Els� szint� albumok ikonok megjelen�t�se a kateg�ri�kban', 'first_level', 1), 
        // 'Thumbnail view',
        'Ikonlista n�zet',
        array(
            'Oszlopok sz�ma az ikonlist�ban', 'thumbcols', 0),
        array(
            'Sorok sz�ma az ikonlist�ban', 'thumbrows', 0),
        array(
            'Megjelen�tend� tab- f�lek maxim�lis sz�ma', 'max_tabs', 0),
        array(
            'K�p le�r�s megjelen�t�s (a k�p c�m�n fel�l) az ikonok alatt', 'caption_in_thumbview', 1),
        array(
            'Az ikon alatt megjelenjen -e a hozz�sz�l�sok sz�ma', 'display_comment_count', 1),
        array(
            'K�pek alap�rtelmezett sorrendje', 'default_sort_order', 3),
        array(
            'Szavazatok minimuma a \'legt�bbsz�r n�zett\' list�ra val� felker�l�shez', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'K�p-n�zet �s hozz�sz�l�s be�ll�t�sok',
        array(
            'A k�p-n�zethez tartoz� t�bl�zat sz�less�ge (pixel vagy %)', 'picture_table_width', 0),
        array(
            'K�pinform�ci�k l�that�k alap�rtelmez�sben', 'display_pic_info', 1),
        array(
            'Tr�g�r szavak kisz�r�se a hozz�sz�l�sokb�l', 'filter_bad_words', 1),
        array(
            'Hangulatkarakterek enged�lyez�se a hozz�sz�l�sokban', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'A k�ple�r�s maxim�lis hossza', 'max_img_desc_length', 0),
        array(
            'Maxim�lis karaktersz�m szavank�nt', 'max_com_wlength', 0),
        array(
            'Sorok maxim�lis sz�ma hozz�sz�l�sonk�nt', 'max_com_lines', 0),
        array(
            'Hozz�sz�l�sok maxim�lis hossza', 'max_com_size', 0),
        array(
            'Filmcs�k megjelen�t�se', 'display_film_strip', 1),
        array(
            'K�pkock�k sz�ma a filmcs�kban', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'K�p- �s ikonbe�ll�t�sok',
        array(
            'JPEG f�jlok min�s�ge', 'jpeg_qual', 0),
        array(
            'Ikonok maxim�lis m�rete <strong>*</strong>', 'thumb_width', 0),
        array(
            'M�retek haszn�lata (ikonok sz�less�ge, magass�ga, vagy maxim�lis m�rete)<strong>*</strong>', 'thumb_use', 7),
        array(
            'K�zbens� m�ret� k�p gener�l�sa', 'make_intermediate', 1),
        array(
            'K�zbens� m�ret� k�pmaxim�lis sz�less�ge �smagass�ga <strong>*</strong>', 'picture_width', 0),
        array(
            'Felt�lt�tt k�pf�jlok maxim�lis m�rete (KB)', 'max_upl_size', 0),
        array(
            'Felt�lt�tt k�pek maxim�lis sz�less�ge �s magass�ga (pixel)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Felhaszn�l� be�ll�t�sok',
        array(
            '�j felhaszn�l�k regisztr�lhatnak', 'allow_user_registration', 1),
        array(
            'Regisztr�ci� email meger�s�t�shez k�t�tt', 'reg_requires_valid_email', 1),
        array(
            'K�t felhaszn�l�nak lehet azonos email c�me', 'allow_duplicate_emails_addr', 1),
        array(
            'Felhaszn�l�knak lehetnek priv�t albumai', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Saj�t mez�k a k�pek le�r�s�hoz (hagyd �resen, ha nem haszn�lod)',
        array(
            '1. mez�n�v', 'user_field1_name', 0),
        array(
            '2. mez�n�v', 'user_field2_name', 0),
        array(
            '3. mez�n�v', 'user_field3_name', 0),
        array(
            '4. mez�n�v', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'K�pek �s ikonok k�l�nleges be�ll�t�sai',
        array(
            'Priv�t album ikon megjelen�t�se be nem jelentkezett felhaszn�l� eset�n', 'show_private', 1),
        array(
            'F�jln�vben tiltott karakterek', 'forbiden_fname_char', 0),
        array(
            'F�jlnevek megengedett kiterjeszt�sei', 'allowed_file_extensions', 0),
        array(
            'K�pek �tm�retez�s�hez haszn�lt m�dszer', 'thumb_method', 2),
        array(
            'ImageMagick / netpbm \'convert\' programj�hoz vezet� �tvonal  (pld. /usr/bin/X11/)', 'impath', 0),
        array(
            'Megengedett k�pfajt�k (csak ImageMagick eset�ben)', 'allowed_img_types', 0),
        array(
            'Parancssor opci�k ImageMagick-hoz', 'im_options', 0),
        array(
            'EXIF adatok olvas�sa  JPEG f�jlokban', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Album el�r�si �tvonala <strong>*</strong>', 'fullpath', 0),
        array(
            'Felhaszn�l�i k�pek el�r�si �tvonala <strong>*</strong>', 'userpics', 0),
        array(
            'K�z�pm�retezett k�pek el�tagja <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Ikonf�jlok el�tagja <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'K�nyvt�rak alap�rtelmezett jogosults�g be�ll�t�sa', 'default_dir_mode', 0),
        array(
            'K�pek alap�rtelmezett jogosults�g be�ll�t�sa', 'default_file_mode', 0),
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
        'Cooky �s karakterk�szlet be�ll�t�sok',
        array(
            'A szkript �ltal haszn�lt cookyn�v', 'cookie_name', 0),
        array(
            'A szkript �ltal haszn�lt cooky �tvonala', 'cookie_path', 0),
        array(
            'Karakter k�dol�s', 'charset', 4), 
        // 'Miscellaneous settings',
        'Egy�b be�ll�t�sok',
        array(
            'Debug m�d enged�lyez�se', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) * -gal jel�lt mez�ket nem szabad megv�ltoztatni, ha m�r nem �res a k�pt�r</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Meg kell adnod a neved �s egy hozz�sz�l�st',
        'com_added' => 'Hozz�sz�l�sod r�gz�tett�k',
        'alb_need_title' => 'Adj nevet az albumnak!',
        'no_udp_needed' => 'Nincs mit m�dos�tani.',
        'alb_updated' => 'Az album m�dos�t�sa megt�rt�nt',
        'unknown_album' => 'A kiv�lasztott album nem l�tezik, vagy nincs felt�lt�si jogosults�god az albumhoz',
        'no_pic_uploaded' => 'Nem t�rt�nt felt�lt�s!<br /><br />Ha t�nyleg kijel�lt�l felt�lt�sre k�pet, ellen�rizd, hogy a szerveren megengedett-e a felt�lt�s...',
        'err_mkdir' => 'Nem siker�lt a %s k�nyvt�r l�trehoz�sa !',
        'dest_dir_ro' => 'A szkript nem �rhat a %s c�lk�nyvt�rba!',
        'err_move' => 'Nem mozgathat� %s %s -be!',
        'err_fsize_too_large' => 'A felt�lt�tt k�p m�rete t�l nagy (maximum megengedett: %s x %s)!',
        'err_imgsize_too_large' => 'A felt�lt�tt f�jl m�rete t�l nagy (maximum megengedett: %s KB) !',
        'err_invalid_img' => 'A felt�lt�tt f�jl nem egy �rv�nyes k�pform�tum !',
        'allowed_img_types' => 'Csak %s k�p felt�lt�se megengedett.',
        'err_insert_pic' => 'A \'%s\' k�p nem adhat� hozz� az albumhoz ',
        'upload_success' => 'A k�p felt�lt�se sikeres volt<br /><br />J�v�hagy�s ut�n l�that� lesz.',
        'info' => 'Inform�ci�',
        'com_added' => 'Komment�r hozz�ad�sa megt�rt�nt',
        'alb_updated' => 'Album m�dos�tva',
        'err_comment_empty' => 'Nem adott meg komment�rt !',
        'err_invalid_fext' => 'Csak a k�vetkez� kiterjeszt�s� f�jlok megengedettek: <br /><br />%s.',
        'no_flood' => 'M�r hozz�sz�lt�l a k�phez.<br /><br />Szerkeszd az el�z� hozz�sz�l�sod, ha sz�ks�ges',
        'redirect_msg' => '�tir�ny�t�s folyamatban.<br /><br /><br />Nyomd meg a \'CONTINUE\'-t, ha a k�p nem friss�l automatikusan',
        'upl_success' => 'A k�p sikeresen hozz�ad�sra ker�lt',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'K�pal��r�s',
        'fs_pic' => 'teljes m�ret� k�p',
        'del_success' => 't�rl�s sikeres',
        'ns_pic' => 'norm�l m�ret� k�p',
        'err_del' => 'nem lehet t�r�lni',
        'thumb_pic' => 'ikon',
        'comment' => 'megjegyz�s',
        'im_in_alb' => 'k�p az albumban',
        'alb_del_success' => ' \'%s\' album t�r�lve',
        'alb_mgr' => 'Albummenedzser',
        'err_invalid_data' => '�rv�nytelen adat a k�vetkez�ben \'%s\'',
        'create_alb' => 'Album gener�l�sa \'%s\'',
        'update_alb' => 'Album m�dos�t�s \'%s\' n�v: \'%s\' index: \'%s\'',
        'del_pic' => 'K�p t�rl�se',
        'del_alb' => 'Album t�rl�se',
        'del_user' => 'Felhaszn�l� t�rl�se',
        'err_unknown_user' => 'A kijel�lt felhaszn�l� nem l�tezik !',
        'comment_deleted' => 'A megjegyz�st sikeresen t�r�lt�k',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Biztosan t�r�lni akarod ezt a k�pet? \\nA hozz�sz�l�sok is t�rl�dnek.',
        'del_pic' => 'A K�P T�RL�SE',
        'size' => '%s x %s pixel',
        'views' => '%s',
        'slideshow' => 'Diavet�t�s',
        'stop_slideshow' => 'DIAVET�T�S V�GE',
        'view_fs' => 'Teljes m�ret� k�p megtekint�se',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'K�p inform�ci�',
        'Filename' => 'F�jln�v',
        'Album name' => 'Album n�v',
        'Rating' => 'Oszt�lyoz�s (%s szavazat)',
        'Keywords' => 'Kulcsszavak',
        'File Size' => 'F�jlm�ret',
        'Dimensions' => 'M�retek',
        'Displayed' => 'Megtekint�sek sz�ma',
        'Camera' => 'Kamera',
        'Date taken' => 'Felv�tel d�tuma',
        'Aperture' => 'Apert�ra',
        'Exposure time' => 'Expoz�ci� id�pontja',
        'Focal length' => 'F�kuszt�vols�g',
        'Comment' => 'Megjegyz�s',
        'addFav' => 'Hozz�ad�s a kedvencekhez',
        'addFavPhrase' => 'Kedvencek',
        'remFav' => 'Kiv�tel kedvencekb�l',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Hozz�sz�l�s szerkeszt�se',
        'confirm_delete' => 'Biztos t�r�lni k�v�nod a hozz�sz�l�st?',
        'add_your_comment' => 'Hozz�sz�l�s hozz�f�z�se',
        'name' => 'N�v',
        'comment' => 'Megjegyz�s',
        'your_name' => 'Anon',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klikkelj a k�pre az ablak bez�r�s�hoz',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'E-k�peslap k�ld�se',
        'invalid_email' => '<strong>Figyelmeztet�s</strong> : �rv�nytelen e-mail c�m!',
        'ecard_title' => 'Egy e-k�peslap %s -t�l neked',
        'view_ecard' => 'Ha az e-k�peslap nem jelenik meg helyesen, klikkelj a k�vetkez� linkre',
        'view_more_pics' => 'Klikkelj erre a linkre tov�bbi k�pek megtekint�s�hez!',
        'send_success' => 'E-k�peslapod tov�bb�tottuk',
        'send_failed' => 'Sajn�lom, de a szerver nem tud e-k�peslapot k�ldeni...',
        'from' => 'Felad�',
        'your_name' => 'Neved',
        'your_email' => 'E-mail c�med',
        'to' => 'C�mzett',
        'rcpt_name' => 'C�mzett neve',
        'rcpt_email' => 'C�mzett e-mail c�me',
        'greetings' => '�dv�zlet',
        'message' => '�zenet',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'K�p inform�ci�',
        'album' => 'Album',
        'title' => 'C�m',
        'desc' => 'Le�r�s',
        'keywords' => 'Kulcsszavak',
        'pic_info_str' => '%sx%s - %sKB - %s megtekint�s - %s szavazat',
        'approve' => 'K�p j�v�hagy�sa',
        'postpone_app' => 'J�v�hagy�s k�s�bb',
        'del_pic' => 'K�p t�rl�s',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
        'reset_view_count' => 'N�zetts�gsz�ml�l� null�z�sa',
        'reset_votes' => 'Szavazatsz�ml�l� alaphelyzetbe',
        'del_comm' => 'Hozz�sz�l�sok t�rl�se',
        'upl_approval' => 'Felt�lt�s j�v�hagy�s',
        'edit_pics' => 'K�pek rendez�se',
        'see_next' => 'K�vetkez� k�p',
        'see_prev' => 'El�z� k�p',
        'n_pic' => '%s k�p',
        'n_of_pic_to_disp' => 'K�p / oldal',
        'apply' => 'M�dos�t�sok v�grehajt�sa'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Csoport megnevez�se',
        'disk_quota' => 'Diszk kv�ta',
        'can_rate' => 'Oszt�lyozhat k�peket',
        'can_send_ecards' => 'K�ldhet e-k�peslapot',
        'can_post_com' => 'Hozz�sz�l�st k�ldhet',
        'can_upload' => 'Felt�lthet k�peket',
        'can_have_gallery' => 'Lehet szem�lyes k�pt�ra',
        'apply' => 'M�dos�t�sok v�grehajt�sa',
        'create_new_group' => '�j csoport l�trehoz�sa',
        'del_groups' => 'Kijel�lt csoport(ok) t�rl�se ',
        'confirm_del' => 'Figyelmeztet�s: ha t�r�lsz egy csoportot, a hozz� tartoz� felhaszn�l�k �thelyez�dnek a \'Registered\' csoportba !\n\nFolytatod ?',
        'title' => 'Felhaszn�l�csoportok menedzsel�se',
        'approval_1' => 'Nyilv�nos felt�lt�s j�v�hagy�s (1)',
        'approval_2' => 'Priv�t felt�lt�s j�v�hagy�s (2)',
        'note1' => '<strong>(1)</strong> A nyilv�nos albumba t�rt�n� felt�lt�s adminisztr�tori j�v�hagy�st ig�nyel',
        'note2' => '<strong>(2)</strong> A felhaszn�l� album�ba t�rt�n� felt�lt�s adminisztr�tori j�v�hagy�st ig�nyel',
        'notes' => 'Megjegyz�sek'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => '�dv�z�llek!'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Biztos t�r�lni akarod az albumot? \\nMinden k�p �s hozz�sz�l�s is t�rl�dik!',
        'delete' => 'T�RL�S',
        'modify' => 'TULAJDONS�GOK',
        'edit_pics' => 'SZERKESZT�S',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> k�p <strong>[albums]</strong> albumban �s <strong>[cat]</strong> kateg�ri�ban <strong>[comments]</strong> hozz�sz�l�ssal, megtekint�sek sz�ma: <strong>[views]</strong>',
        'stat2' => '<strong>[pictures]</strong> k�p <strong>[albums]</strong> albumban, megtekint�sek sz�ma: <strong>[views]</strong>',
        'xx_s_gallery' => '%s k�pt�ra',
        'stat3' => '<strong>[pictures]</strong> k�p <strong>[albums]</strong> albumban <strong>[comments]</strong> hozz�sz�l�ssal, megtekint�sek sz�ma: <strong>[views]</strong>'
        );

    $lang_list_users = array('user_list' => 'Felhaszn�l�k list�ja',
        'no_user_gal' => 'Nincs felhaszn�l� a k�pt�rban',
        'n_albums' => '%s album(ok)',
        'n_pics' => '%s k�p(ek)'
        );

    $lang_list_albums = array('n_pictures' => '%s k�p',
        'last_added' => ', utols� felt�lt�s: %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => '%s album m�dos�t�sa ',
        'general_settings' => '�ltal�nos be�ll�t�sok',
        'alb_title' => 'Album c�m',
        'alb_cat' => 'Album kateg�ria',
        'alb_desc' => 'Album le�r�s',
        'alb_thumb' => 'Album ikon',
        'alb_perm' => 'Album jogosults�gok',
        'can_view' => 'Albumot l�thatja: ',
        'can_upload' => 'L�togat�k felt�lthetnek k�pet',
        'can_post_comments' => 'L�togat�k k�ldhetnek hozz�sz�l�sokat',
        'can_rate' => 'L�togat�k oszt�lyozhatj�k a k�peket',
        'user_gal' => 'Felhaszn�l�i k�pt�r',
        'no_cat' => '* Nincs kateg�ria *',
        'alb_empty' => 'Az album �res',
        'last_uploaded' => 'Utolj�ra felt�lt�tt',
        'public_alb' => 'Mindenki (nyilv�nos album)',
        'me_only' => 'Csak �n',
        'owner_only' => 'Csak a (%s) album tulajdonosa',
        'groupp_only' => 'Csak a \'%s\' csoport tagjai',
        'err_no_alb_to_modify' => 'Nincs m�dos�that� album az adatb�zisban.',
        'update' => 'Album m�dos�t�sa'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Sajn�lom, de m�r oszt�lyoztad ezt a k�pet',
        'rate_ok' => 'Oszt�lyzatod elfogadtuk',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
B�r a {SITE_NAME} adminisztr�tora mindent elk�vet, hogy amilyen gyorsan csak lehet, szerkesszen vagy t�r�lj�n minden kifog�solhat� dokumentumot, lehetetlen minden k�ldem�ny ellen�rz�se. K�rj�k ez�rt annak meg�rt�s�t, hogy minden erre a weblapra c�mzett k�ldem�ny annak szerz�je n�zet�t �s v�lem�ny�t fejezi ki, �s nem az adminisztr�tor�t, illetve webmester�t (kiv�ve az �ltaluk post�zott k�ldem�nyeket). Enn�l fogva nem tudunk �rt�k felel�ss�get v�llalni.<br />
<br />
Elfogadod, hogy nem post�zol semmilyen s�rt�, obszc�n, vulg�ris, r�galmaz�, gy�l�lk�d�, fenyeget�, szexu�lis tartalm�, vagy b�rmilyen m�s olyan tartalm� anyagot, amely �rv�nyes t�rv�nyt s�rt. Elfogadod, hogy a {SITE_NAME} webmester�nek, adminisztr�tor�nak, vagy moder�tor�nak b�rmikor jog�ban �ll b�rmilyen tartalmat sz�ks�g eset�n t�r�lni, vagy szerkeszteni. Mint felhaszn�l� egyet�rtesz a k�z�lt inform�ci�k adatb�zisban t�rt�n� t�rol�s�hoz. B�r a webmester, illetve adminisztr�tor nem adja ki harmadik feleknek ezeket az inform�ci�kat a hozz�j�rul�sod n�lk�l, nem tehet� felel�ss� semmilyen olyan hacker k�s�rlet�rt, melyek az adatok kompromitt�l�s�hoz vezet.<br />
<br />
Ez a weblap cookie form�j�ban inform�ci�t t�rol a sz�m�t�g�peden. Ezek a cookie-k csak azt a c�lt szolg�lj�k, hogy fokozz�k a n�zhet�s�gi �lm�nyt. Az email c�m csak a regisztr�ci�s adataidnak �s jelszavadnak nyugt�z�s�ra szolg�l.<br />
<br />
Az 'Egyet�rtek'-re klikkelve elfogadod ezeket a felt�teleket.
EOT;

    $lang_register_php = array('page_title' => 'Felhaszn�l� regisztr�ci�',
        'term_cond' => 'Regisztr�ci�s felt�telek',
        'i_agree' => 'Egyet�rtek',
        'submit' => 'Regisztr�l�s',
        'err_user_exists' => 'A megadott felhaszn�l�n�v m�r l�tezik, adjon meg m�sikat',
        'err_password_mismatch' => 'A k�t jelsz� nem egyezik, add meg �jra',
        'err_uname_short' => 'A felhaszn�l�n�v legal�bb 2 karakter hossz� kell, hogy legyen',
        'err_password_short' => 'A jelsz� legal�bb 2 karakter hossz� kell, hogy legyen',
        'err_uname_pass_diff' => 'A felhaszn�l�n�vnek �s a jelsz�nak k�l�nb�znie kell',
        'err_invalid_email' => '�rv�nytelen email c�m',
        'err_duplicate_email' => 'Egy m�sik felhaszn�l� m�r regisztr�lt ezzel az email c�mmel',
        'enter_info' => 'Regisztr�ci�s inform�ci�k megad�sa',
        'required_info' => 'K�telez� adat',
        'optional_info' => 'Opcion�lis adat',
        'username' => 'Felhaszn�l�n�v',
        'password' => 'Jelsz�',
        'password_again' => 'Jelsz� m�g egyszer',
        'email' => 'Email',
        'location' => 'Tart�zkod�si hely',
        'interests' => '�rdekl�d�si k�r',
        'website' => 'Honlap',
        'occupation' => 'Foglalkoz�s',
        'error' => 'HIBA',
        'confirm_email_subject' => '%s - Regisztr�ci� nyugt�z�sa',
        'information' => 'Inform�ci�',
        'failed_sending_email' => 'A regisztr�ci�s meger�s�t� emailt nem siker�lt elk�ldeni !',
        'thank_you' => 'K�sz�nj�k, hogy regisztr�lt�l.<br /><br />K�ldt�nk egy emailt a megadott email c�mre, amiben megadtuk, hogy hogyan aktiv�lhatod felhaszn�l�i hozz�f�r�sed.',
        'acct_created' => 'Felhaszn�l�i hozz�f�r�sed l�trehoztuk �s bejelentkezhetsz a felhaszn�l�neveddel �s jelszavaddal',
        'acct_active' => 'Felhaszn�l�i hozz�f�r�sed aktiv�ltuk �s bejelentkezhetsz a felhaszn�l�neveddel �s jelszavaddal',
        'acct_already_act' => 'Felhaszn�l�i hozz�f�r�sed m�r akt�v !',
        'acct_act_failed' => 'Ezt a felhaszn�l�i hozz�f�r�st nem lehet aktiv�lni !',
        'err_unk_user' => 'A kiv�lasztott felhaszn�l� nem l�tezik !',
        'x_s_profile' => '%s profilja',
        'group' => 'Csoport',
        'reg_date' => 'Csatlakoz�s ideje',
        'disk_usage' => 'T�rfelhaszn�l�s',
        'change_pass' => 'Jelsz� megv�ltoztat�sa',
        'current_pass' => 'Jelenlegi jelsz�',
        'new_pass' => '�j jelsz�',
        'new_pass_again' => '�j jelsz� m�g egyszer',
        'err_curr_pass' => 'A jelenlegi jelsz� hib�s',
        'apply_modif' => 'M�dos�t�sok v�grehajt�sa',
        'change_pass' => 'Jelsz� megv�ltoztat�sa',
        'update_success' => 'Profilod aktualiz�ltuk',
        'pass_chg_success' => 'Jelszavad megv�ltoztattuk',
        'pass_chg_error' => 'Jelszavad nem v�ltoztattuk meg',
        );

    $lang_register_confirm_email = <<<EOT
K�sz�nj�k, hogy regisztr�lt�l '{SITE_NAME}' weblapunkon

Felhaszn�l�neved : "{USER_NAME}"
Jelszavad : "{PASSWORD}"

Felhazn�l�i hozz�f�r�sed aktiv�l�s�hoz az al�bbi linkre kell klikkelned.

{ACT_LINK}

�dv�zlettel,

A '{SITE_NAME}' adminisztr�tora

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Hozz�sz�l�sok megtekint�se',
        'no_comment' => 'Nincs hozz�sz�l�s',
        'n_comm_del' => '%s hozz�sz�l�s(ok) t�r�lve',
        'n_comm_disp' => 'Megjelen�tend� hozz�sz�l�sok sz�ma',
        'see_prev' => 'El�z�',
        'see_next' => 'K�vetkez�',
        'del_comm' => 'Kijel�lt hozz�sz�l�sok t�r�lve',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Keres�s a k�pt�rban',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => '�j k�p keres�se',
        'select_dir' => 'K�nyvt�r v�laszt�sa',
        'select_dir_msg' => 'Ez a funkci� lehet�v� teszi egy k�teg - FTP-vel a szerverre m�solt - k�p hozz�ad�s�t a k�pt�rhoz.<br /><br />V�laszd ki a k�nyvt�rat, ahonnan hozz� akarsz adni a k�pt�rhoz k�peket',
        'no_pic_to_add' => 'Nincs hozz�adhat� k�p',
        'need_one_album' => 'Ehhez a funkci�hoz legal�bb egy albumnak l�teznie kell',
        'warning' => 'Figyelmeztet�s',
        'change_perm' => 'a szkript nem tud �rni ebbe a k�nyvt�rba, 755-r�l 777-re kell cser�lned a jogosults�g�t miel�tt hozz�adsz k�peket !',
        'target_album' => '<strong>Adja hozz� a </strong>"%s"<strong> k�nyvt�rb�l a k�peket a </strong>%s albumhoz',
        'folder' => 'K�nyvt�r',
        'image' => 'K�p',
        'album' => 'Album',
        'result' => 'Eredm�ny',
        'dir_ro' => 'Nem �rhat�. ',
        'dir_cant_read' => 'Nem olvashat�. ',
        'insert' => '�j k�pek hozz�ad�sa a k�pt�rhoz',
        'list_new_pic' => '�j k�pek felsorol�sa',
        'insert_selected' => 'Kijel�lt k�pek hozz�ad�sa',
        'no_pic_found' => 'Nincs �j k�p',
        'be_patient' => 'L�gy t�relemmel, a szkriptnek id� kell a k�pek hozz�ad�s�hoz',
        'notes' => '<ul>' . '<li><strong>OK</strong> : azt jelenti, hogy a k�p hozz�ad�sa sikeres volt' . '<li><strong>DP</strong> : azt jelenti, hogy a k�p m�r az adatb�zisban volt' . '<li><strong>PB</strong> : azt jelenti, hogy a k�p nem volt hozz�adhat�, ellen�rizd a konfigur�ci�t �s a k�peket tartalmaz� k�nyvt�rak jogosults�gait ' . '<li>Ha az OK, DP, PB \'jelek\' nem l�that�k, klikkelj a hib�s k�pre a PHP hiba�zenet�nek megjelen�t�s�hez' . '<li>Ha a browser leid�z�tett, nyomja meg a friss�t�s gombot' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  not in cpg1.2.0-nuke//
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'K�p felt�lt�se',
        'max_fsize' => 'Maximum megengedett f�jlm�ret %s KB',
        'album' => 'Album',
        'picture' => 'K�p',
        'pic_title' => 'K�p c�me',
        'description' => 'K�p le�r�sa',
        'keywords' => 'Kulcsszavak (sz�k�z�kkel elv�lasztva)',
        'err_no_alb_uploadables' => 'Nincs album, ahova enged�lyezett a felt�lt�s',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Felhaszn�l�k menedzsel�se',
        'name_a' => 'N�v n�vekv�',
        'name_d' => 'N�v cs�kken�',
        'group_a' => 'Csoport n�vekv�',
        'group_d' => 'Csoport cs�kken�',
        'reg_a' => 'Reg. d�tum n�vekv�',
        'reg_d' => 'Reg. d�tum cs�kken�',
        'pic_a' => 'K�psz�m n�vekv�',
        'pic_d' => 'K�psz�m cs�kken�',
        'disku_a' => 'Diszkfelhaszn�l�s n�vekv�',
        'disku_d' => 'Diszkfelhaszn�l�s cs�kken�',
        'sort_by' => 'Felhaszn�l�k sorrendez�se',
        'err_no_users' => 'Nincs felhaszn�l� !',
        'err_edit_self' => 'Nem szerkesztheted a saj�t profilod, haszn�ld az \'�n profilom\' men�pontot',
        'edit' => 'SZERKESZT',
        'delete' => 'T�R�L',
        'name' => 'Felhaszn�l�n�v',
        'group' => 'Csoport',
        'inactive' => 'Inakt�v',
        'operations' => 'M�veletek',
        'pictures' => 'K�pek',
        'disk_space' => 'Felhaszn�lt t�rhely / kv�ta',
        'registered_on' => 'Regisztr�lva',
        'u_user_on_p_pages' => '%d felhaszn�l� %d oldalon',
        'confirm_del' => 'Bizt�s t�r�lni k�v�nod a felhaszn�l�t? \\nMinden k�pe �s albuma is t�rl�dni fog.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'A kijel�lt felhaszn�l� nem l�tezik !',
        'modify_user' => 'Felhaszn�l� m�dos�t�sa',
        'notes' => 'Megjegyz�sek',
        'note_list' => '<li>Ha nem k�v�nod megv�ltoztatni az aktu�lis jelsz�t, hagyd �resen a "jelsz�" mez�t',
        'password' => 'Jelsz�',
        'user_active' => 'Felhaszn�l� akt�v',
        'user_group' => 'Felhaszn�l� csoport',
        'user_email' => 'Felhaszn�l� email c�me',
        'user_web_site' => 'Felhaszn�l� honlapja',
        'create_new_user' => '�j felhaszn�l� l�trehoz�sa',
        'user_from' => 'Felhaszn�l� lakhelye',
        'user_interests' => 'Felhaszn�l� �rdekl�d�si k�re',
        'user_occ' => 'Felhaszn�l� foglalkoz�sa',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'K�pek �tm�retez�se',
        'what_it_does' => 'Mi t�rt�njen',
        'what_update_titles' => 'C�mek aktualiz�l�sa f�jlnevekb�l',
        'what_delete_title' => 'C�mek t�rl�se',
        'what_rebuild' => 'Ikonok �s �tm�retezett k�pek �jragener�l�sa',
        'what_delete_originals' => 'Eredeti k�pek fel�l�r�sa az �tm�retezettekkel',
        'file' => 'F�jl',
        'title_set_to' => 'c�m be�ll�t�sa ..',
        'submit_form' => '�rv�nyes�t�s',
        'updated_succesfully' => 'sikeres m�dos�t�s',
        'error_create' => 'HIBA a gener�l�s sor�n',
        'continue' => 'T�bb k�p feldolgoz�sa',
        'main_success' => 'A % f�jlok felhaszn�l�sa els�dleges k�pk�nt sikeres volt',
        'error_rename' => '%s %s -ra �tnevez�se sor�n HIBA',
        'error_not_found' => 'A % f�jlok nem tal�lhat�k',
        'back' => 'vissza a f�oldalra',
        'thumbs_wait' => 'Ikonok �s/vagy �tm�retezett k�pek aktualiz�l�sa, k�rlek v�rj...',
        'thumbs_continue_wait' => 'Ikonok �s/vagy �tm�retezett k�pek aktualiz�l�s�nak folytat�sa...',
        'titles_wait' => 'C�mek aktualiz�l�sa, k�rlek v�rj...',
        'delete_wait' => 'C�mek t�rl�se, k�rlek v�rj...',
        'replace_wait' => 'Eredeti k�pek fel�l�r�sa az �tm�retezettekkel, k�rlek v�rj...',
        'instruction' => 'Gyors utas�t�sok',
        'instruction_action' => 'M�velet kiv�laszt�sa',
        'instruction_parameter' => 'Param�terek be�ll�t�sa',
        'instruction_album' => 'Album kiv�laszt�sa',
        'instruction_press' => 'Nyomj %-t',
        'update' => 'Ikonok �s/vagy �tm�retezett f�nyk�pek aktualiz�l�sa',
        'update_what' => 'Mit kell aktualiz�lni',
        'update_thumb' => 'Csak ikonokat',
        'update_pic' => 'Csak �tm�retezett k�peket',
        'update_both' => 'Ikonokat �s �tm�retezett k�peket is',
        'update_number' => 'Klikkel�senk�nt feldolgozand� k�pek sz�ma',
        'update_option' => '(Pr�b�ld cs�kkenteni ezt az �rt�ket, ha leid�z�t�si probl�m�t �szlelsz)',
        'filename_title' => 'F�jln�v &#8594; K�p c�m',
        'filename_how' => 'Hogy legyen m�dos�tva a f�jln�v',
        'filename_remove' => 'A jpg v�gz�d�s t�rl�se �s _ (alulvon�s) helyettes�t�se sz�k�zzel',
        'filename_euro' => '2003_11_23_13_20_20.jpg �tnevez�se 23/11/2003 13:20-ra',
        'filename_us' => '2003_11_23_13_20_20.jpg �tnevez�se 11/23/2003 13:20-ra',
        'filename_time' => '2003_11_23_13_20_20.jpg �tnevez�se 13:20ra',
        'delete' => 'K�p c�mek vagy eredeti m�ret� k�pek t�rl�se',
        'delete_title' => 'K�p c�mek t�rl�se',
        'delete_original' => 'Eredeti m�ret� k�pek t�rl�se',
        'delete_replace' => 'Eredeti k�pek fel�l�r�sa �tm�retezettel',
        'select_album' => 'Album kiv�laszt�sa',
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