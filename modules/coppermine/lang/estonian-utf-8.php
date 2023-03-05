ï»¿<?php 
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
define('PIC_VIEWS', 'Korda');
define('PIC_VOTES', 'HÃ¶Ã¶lt');
define('PIC_COMMENTS', 'Kommentaari');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Estonian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Eesti', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'ee', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Meelis RÃ¼Ã¼tli', // the name of the translator - can be a nickname
    'trans_name2' => 'Vallo JÃµeorg', // the name of the translator - can be a nickname
    'trans_email2' => 'vallo@infonet.ee', // translator's email address (optional)
    'trans_website2' => 'http://pontu.infonet.ee', // translator's website (optional)
    'trans_date' => '2003-10-19', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-4';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Baiti', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('PÃ¼hapÃ¤ev', 'EsmaspÃ¤ev', 'TeisipÃ¤ev', 'KolmapÃ¤ev', 'NeljapÃ¤ev', 'Reede', 'LaupÃ¤ev');
$lang_month = array('Jaanuar', 'Veebruar', 'MÃ¤rts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');
// Some common strings
$lang_yes = 'Jah';
$lang_no = 'Ei';
$lang_back = 'TAGASI';
$lang_continue = 'JÃ„TKA';
$lang_info = 'Informatsioon';
$lang_error = 'Viga';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%A %d %B %Y';
$lastcom_date_fmt = '%d %B %Y kell %H:%M';
$lastup_date_fmt = '%A %d %B %Y';
$register_date_fmt = '%A %d %B %Y';
$lasthit_date_fmt = '%d %B %Y kell %H:%M';
$comment_date_fmt = '%d %B %Y kell %H:%M';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Juhuslikud pildid',
    'lastup' => 'Viimati lisatud',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Viimati lisatud album',

    'lastcom' => 'Viimati kommenteeritud',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Enim vaadatud',
    'toprated' => 'Edetabel',
    'lasthits' => 'Viimati vaadatud',
    'search' => 'Otsingu tulemused',

    'favpics' => 'Eelistatud pildid'

    );

$lang_errors = array('access_denied' => 'Teil pole Ãµigusi sellele lehele pÃ¤Ã¤suks',
    'perm_denied' => 'Teil pole Ãµigust toimingu tegemiseks',
    'param_missing' => 'Skripti kÃ¤ivitamiseks puuduvad vajalikud parameetrid.',
    'non_exist_ap' => 'Valitud pilt vÃµi album puudub.',
    'quota_exceeded' => 'Lubatud kettakasutus Ã¼letatud<br /><br />Teil on lubatud kasutada [quota]K kettaruumi, Teie pildid vÃµtavad hetkel [space]K  ruumi, selle pildi lisamisel vÃµib lubatud maht olla Ã¼letatud.',
    'gd_file_type_err' => 'GD teegi puhul on lubatud ainult JPEG ja PNG tÃ¼Ã¼pi pildid.',
    'invalid_image' => 'Pilt on vigane vÃµi seda pole vÃµimalik kÃ¤sitleda GD teegi poolt.',
    'resize_failed' => 'Ei suuda luua pisipilti vÃµi vÃ¤hendada pildi suurust.',
    'no_img_to_display' => 'Pole Ã¼htegi pilti.',
    'non_exist_cat' => 'Valitud kategooria puudub.',
    'orphan_cat' => 'Kategoorial puudub vanem, kasuta kategooria-haldurit probleemi lahendamiseks.',
    'directory_ro' => 'Kataloogil \'%s\' puudub kirjutamisÃµigus, Ã¼ilte ei saa kustutada.',
    'non_exist_comment' => 'Valitud kommentaar puudub.',
    'pic_in_invalid_album' => 'Pilt asub olematus albumis (%s)!?',

    'banned' => 'Sul on hetkel keelatud selle albumi kasutamine.',

    'not_with_udb' => 'See funktsioon on keelatud, kuna album on integreeritud foorumiga. Ehk tegevus mida Sa Ã¼ritad ei ole toetatud antud konfiguratsioonis vÃµi tuleks teha kasutades foorumi tarkvara.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'

    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Mine albumite loetellu',
    'alb_list_lnk' => 'Albumite loetelu',
    'my_gal_title' => 'Mine minu personaalsesse galeriisse',
    'my_gal_lnk' => 'Minu Galerii',
    'my_prof_lnk' => 'Minu Profiil',
    'adm_mode_title' => 'LÃ¼litu admin olekusse',
    'adm_mode_lnk' => 'Admin olek',
    'usr_mode_title' => 'LÃ¼litu kasutaja olekusse',
    'usr_mode_lnk' => 'Kasutaja olek',
    'upload_pic_title' => 'Lisa pilt albumisse',
    'upload_pic_lnk' => 'Lisa pilt',
    'register_title' => 'Loo konto',
    'register_lnk' => 'Registreeri',
    'login_lnk' => 'Logi sisse',
    'logout_lnk' => 'Logi vÃ¤lja',
    'lastup_lnk' => 'Viimati lisatud',
    'lastcom_lnk' => 'Viimased kommentaarid',
    'topn_lnk' => 'Enim vaadatud',
    'toprated_lnk' => 'Edetabel',
    'search_lnk' => 'Otsing',
    'fav_lnk' => 'Minu eelistused',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Lisamise kinnitus',
    'config_lnk' => 'Konfiguratsioon',
    'albums_lnk' => 'Albumid',
    'categories_lnk' => 'Kategooriad',
    'users_lnk' => 'Kasutajad',
    'groups_lnk' => 'Grupid',
    'comments_lnk' => 'Kommentaarid',
    'searchnew_lnk' => 'Lisa Ã¼les laetud pilte',
    'util_lnk' => 'Muuda piltide suurust',

    'ban_lnk' => 'Blokeeri kasutajaid',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Loo / telli minu albumeid',
    'modifyalb_lnk' => 'Muuda minu albumeid',
    'my_prof_lnk' => 'Minu profiil',
    );

$lang_cat_list = array('category' => 'Kategooria',
    'albums' => 'Albumid',
    'pictures' => 'Pildid',
    );

$lang_album_list = array('album_on_page' => '%d albumit %d lehel'
    );

$lang_thumb_view = array('date' => 'KUUPÃ„EV', 
    // Sort by filename and title
    'name' => 'FAILI NIMI',

    'title' => 'PEALKIRI',

    'sort_da' => 'JÃ¤rjesta kuupÃ¤eva jÃ¤rgi kasvavalt',
    'sort_dd' => 'JÃ¤rjesta kuupÃ¤eva jÃ¤rgi kahanevalt',
    'sort_na' => 'JÃ¤rjesta nime jÃ¤rgi kasvavalt',
    'sort_nd' => 'JÃ¤rjesta nime jÃ¤rgi kahanevalt',
    'sort_ta' => 'JÃ¤rjesta pealkirja jÃ¤rgi kasvavalt',

    'sort_td' => 'JÃ¤rjesta pealkirja jÃ¤rgi kahanevalt',

    'pic_on_page' => '%d pilti on %d-el lehel',
    'user_on_page' => '%d kasutajat on %d-el lehel'
    );

$lang_img_nav_bar = array('thumb_title' => 'Tagasi pisipiltide lehele',
    'pic_info_title' => 'NÃ¤ita/peida pildi info',
    'slideshow_title' => 'Slaidiesitus',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Saada see pilt e-kaardina',
    'ecard_disabled' => 'e-kaartid on keelatud',
    'ecard_disabled_msg' => 'Teil pole Ãµigust saata e-kaarte',
    'prev_title' => 'Vaata eelmist pilti',
    'next_title' => 'Vaata jÃ¤rgmist pilti',
    'pic_pos' => 'PILT %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Hinda seda pilti ',
    'no_votes' => '(Veel hindamata)',
    'rating' => '(Hetke hinne : %s / 5-st %s hÃ¤Ã¤lega)',
    'rubbish' => 'KÃµlbmatu',
    'poor' => 'Kasin',
    'fair' => 'Keskmine',
    'good' => 'Hea',
    'excellent' => 'SuurepÃ¤rane',
    'great' => 'Fantastiline',
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
    CRITICAL_ERROR => 'Kriitiline viga',
    'file' => 'Fail: ',
    'line' => 'Rida: ',
    );

$lang_display_thumbnails = array('filename' => 'Failinimi : ',
    'filesize' => 'Failisuurus : ',
    'dimensions' => 'MÃµÃµtmed : ',
    'date_added' => 'Lisamise kuupÃ¤ev : ',
    );

$lang_get_pic_data = array('n_comments' => '%s kommentaari',
    'n_views' => '%s kord(a)',
    'n_votes' => '(%s hÃ¶Ã¶l(t))',
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'HÃ¼Ã¼atus',
        'Question' => 'KÃ¼simus',
        'Very Happy' => 'VÃ¤ga Ãµnnelik',
        'Smile' => 'RÃµÃµmus',
        'Sad' => 'Kurb',
        'Surprised' => 'Ãœllatunud',
        'Shocked' => 'Vapustaud',
        'Confused' => 'Hammeldunud',
        'Cool' => 'Lahe',
        'Laughing' => 'Naerev',
        'Mad' => 'Hull',
        'Razz' => 'Razz',
        'Embarassed' => 'HÃ¤bistatud',
        'Crying or Very sad' => 'Nuttev vÃµi vÃ¤ga kurb',
        'Evil or Very Mad' => 'Ã•el vÃµi PÃ¤ris hull',
        'Twisted Evil' => 'Eelarvamuslik Ãµel',
        'Rolling Eyes' => 'Silmi pÃ¶Ã¶ritav',
        'Wink' => 'Silmapilgutus',
        'Idea' => 'Idee',
        'Arrow' => 'Nool',
        'Neutral' => 'Neutraalne',
        'Mr. Green' => 'Mr. Roheline',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Lahkumine admin olekust...',
        1 => 'Sisenemine admin olekusse...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Albumitel peab olema nimi !',
        'confirm_modifs' => 'Oled kindel, et tahad teha neid muudatusi ?',
        'no_change' => 'Sa ei muutnud midagi !',
        'new_album' => 'Uus album',
        'confirm_delete1' => 'Kindel, et tahad albumit kustutada ?',
        'confirm_delete2' => '\nKÃµik siin sisalduvad pildid ja kommentaarid lÃ¤hevad kaduma !',
        'select_first' => 'Vali enne album',
        'alb_mrg' => 'Albumi-haldur',
        'my_gallery' => '* Minu Galerii *',
        'no_category' => '* Kategooriata *',
        'delete' => 'Kustuta',
        'new' => 'Uus',
        'apply_modifs' => 'Omista muudatused',
        'select_category' => 'Vali kategooria',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Puuduvad parameetrid \'%s\'tooimingut ei tehtud !',
        'unknown_cat' => 'Valitud kategooria puudub andmebaasis',
        'usergal_cat_ro' => 'Kasutaja galeriisid ei saa kustutada !',
        'manage_cat' => 'Halda kategooriaid',
        'confirm_delete' => 'Oled kindel, et tahad KUSTUTADA seda kategooriat',
        'category' => 'Kategooria',
        'operations' => 'Toimingud',
        'move_into' => 'Liigu',
        'update_create' => 'Uuenda/Loo Kategooria',
        'parent_cat' => 'Juurkategooria',
        'cat_title' => 'Kategooria tiitel',
        'cat_desc' => 'Kategooria kirjeldus'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Konfiguratsioon',
        'restore_cfg' => 'Taasta tehase vaikeseaded',
        'save_cfg' => 'Salvesta uus konfiguratsioon',
        'notes' => 'MÃ¤rkused',
        'info' => 'Informatsioon',
        'upd_success' => 'Konfiguratsioon uuendatud',
        'restore_success' => 'Vaikekonfiguratsioon taastatud',
        'name_a' => 'Nimed kasvavalt',
        'name_d' => 'Nimed kahanevalt',
        'title_a' => 'Pealkirjad kasvavalt',

        'title_d' => 'Pealkirjad kahanevalt',

        'date_a' => 'KuupÃ¤ev kasvavalt',
        'date_d' => 'KuupÃ¤ev kahanevalt',
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
        'Ãœldised seaded',
array(
'Galerii nimi', 'gallery_name', 0),
array(
'Galrii kirjeldus', 'gallery_description', 0),
array(
'Galerii administraatorile epost', 'gallery_admin_email', 0),
array(
'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
array(
'Keel', 'lang', 5),
// for postnuke change
array(
'Teema', 'cpgtheme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Albumite loetelu vaade',
array(
'Peatabeli laius (pixelites vÃµi %)', 'main_table_width', 0),
array(
'Number kategooria tasandeid kuvamiseks', 'subcat_level', 0),
array(
'Number albumeid kuvamiseks', 'albums_per_page', 0),
array(
'Number veergusid albumi loeteluks', 'album_list_cols', 0),
array(
'pisipildi suurus pixelites', 'alb_list_thumb_size', 0),
array(
'Pealehe sisu', 'main_page_layout', 0),
array(
'NÃ¤ita esimese taseme albumite pisipilte kategooriates', 'first_level', 1), 
        // 'Thumbnail view',
        'Pisipiltide vaade',
array(
'Veergude arv pisipiltide lehel', 'thumbcols', 0),
array(
'Ridade arv pisipiltide lehel', 'thumbrows', 0),
array(
'Maksimaalne lahtrite arv kuvamiseks', 'max_tabs', 0),
array(
'Kuva pildi selgitus (lisaks tiitlile) pisipildi all', 'caption_in_thumbview', 1),
array(
'Kuva kommentaaraide arv  pisipildi all', 'display_comment_count', 1),
array(
'VaikejÃ¤rjestus piltidele', 'default_sort_order', 3),
array(
'Minimaalne hÃ¤Ã¤lte arv pildi sattumiseks \'Edetabel\' nimekirja', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Pildivaade &amp; Kommentaaride seaded',
array(
'Tabeli laius pildi kuvamiseks (pixelites vÃµi %)', 'picture_table_width', 0),
array(
'Pildi info on vaikimisi nÃ¤htav', 'display_pic_info', 1),
array(
'Filtreeri pahad sÃµnad kommentaarides', 'filter_bad_words', 1),
array(
'Luba smile\'isi kommentaarides', 'enable_smilies', 1),
array(
'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
array(
'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
array(
'Maksimaalne pildikirjelduse pikkus', 'max_img_desc_length', 0),
array(
'Maksimaalne tÃ¤htede arv sÃµnas', 'max_com_wlength', 0),
array(
'Maksimaalne ridade arv kommentaaris', 'max_com_lines', 0),
array(
'Maksimaalne kommentaari pikkus', 'max_com_size', 0),
array(
'NÃ¤ita filmilinti', 'display_film_strip', 1),
array(
'Kaadrite arv filmilindil', 'max_film_strip_items', 0),
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
'Piltide ja pisipiltide seaded',
array(
'JPEG failide kvaliteet', 'jpeg_qual', 0),
array(
'Pisipildi max laius vÃµi kÃµrgus <strong>*</strong>', 'thumb_width', 0),
array(
'Kasuta mÃµÃµte (kÃµrgus vÃµi laius vÃµi Max aspect pisipiltide jaoks )<strong>*</strong>', 'thumb_use', 7),
array(
'Loo keskmised pildid', 'make_intermediate', 1),
array(
'Keskmiste piltide laius vÃµi kÃµrgus <strong>*</strong>', 'picture_width', 0),
array(
'Salvestatud piltide max suurus (KB)', 'max_upl_size', 0),
array(
'Salvestatud piltide max laius vÃµi kÃµrgus (pixelites)', 'max_upl_width_height', 0), 
// 'User settings',
'Kasutaja seaded',
array(
'Luba uue kasutaja registreerimist', 'allow_user_registration', 1),
array(
'Kasutaja registreerimine nÃµuab eposti-kinnitust', 'reg_requires_valid_email', 1),
array(
'Luba kahel kasutajal Ã¼hte-sama eposti aadressi', 'allow_duplicate_emails_addr', 1),
array(
'Kasutajatel vÃµib olla privaat-albumid', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)', 
//Custom fields 
'Kohandatavad vÃ¤ljad pildi kirjelduseks (jÃ¤ta tÃ¼hjaks kui ei kasuta)',
array(
'VÃ¤lja 1 nimi', 'user_field1_name', 0),
array(
'VÃ¤lja 2 nimi', 'user_field2_name', 0),
array(
'VÃ¤lja 3 nimi', 'user_field3_name', 0),
array(
'VÃ¤lja 4 nimi', 'user_field4_name', 0), 
// 'Pictures and thumbnails advanced settings',
'Piltide ja pisipiltide lisaseaded',
array(
'Faili nimes keelatud tÃ¤hemÃ¤rgid', 'forbiden_fname_char', 0),
array(
'Lubatud failitÃ¼Ã¼bid salvestatavatele piltidele', 'allowed_file_extensions', 0),
array(
'Piltide suurusemuutmise meetod', 'thumb_method', 2),
array(
'ImageMagick / netpbm \'u \'konvertimise\' abiprogrammi tee (nÃ¤iteks /usr/bin/X11/)', 'impath', 0),
array(
'Lubatud pilditÃ¼Ã¼bid (ainult ImageMagick / netpbm \'u jaoks)', 'allowed_img_types', 0),
array(
'KÃ¤surea parameetrid ImageMagick / netpbm \'ule', 'im_options', 0),
array(
'Lugeda EXIF andmed JPEG failides', 'read_exif_data', 1),
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'Albumi kataloog <strong>*</strong>', 'fullpath', 0),
array(
'Kasutajapiltide kataloog <strong>*</strong>', 'userpics', 0),
array(
'Eesliide keskmistele piltidele <strong>*</strong>', 'normal_pfx', 0),
array(
'Eesliide pisipiltidele <strong>*</strong>', 'thumb_pfx', 0),
array(
'Vaikemood kataloogidele', 'default_dir_mode', 0),
array(
'Vaikemood piltidele', 'default_file_mode', 0),
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
        'PrÃ¤Ã¤nikud &amp; TÃ¤hestiku seaded',
array(
'Skripti poolt kasutatava prÃ¤Ã¤niku nimi', 'cookie_name', 0),
array(
'Skripti poolt kasutatava prÃ¤Ã¤niku failitee', 'cookie_path', 0),
array(
'TÃ¤htekodeering', 'charset', 4), 
        // 'Miscellaneous settings',
        'Muud seaded',
array(
'VÃµimalda parandusmood', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) * MÃ¤rgitud vÃ¤lju ei tohi muuta kui galeriis on juba pilte</div><br />',
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Sa pead trÃ¼kkima oma nime ja kommentaari',
        'com_added' => 'Sinu kommentaar lisati',
        'alb_need_title' => 'Sinult oodatakse pealkirja albumile !',
        'no_udp_needed' => 'Uuendust pole vaja.',
        'alb_updated' => 'Album uuendatud',
        'unknown_album' => 'Valitud album puudub vÃµi sul pole Ãµigusi salvestada sellesse albumisse',
        'no_pic_uploaded' => 'Ãœhtegi pilti ei salvestatud !<br /><br />Kui sul tÃµesti on valitud pilt salvestamiseks, kontrolli et server lubaks failide salvestamist...',
        'err_mkdir' => 'Viga kataloogi %s loomisel !',
        'dest_dir_ro' => 'Sihtkataloog %s pole skripti poolt kirjutamisÃµiguslik !',
        'err_move' => 'VÃµimatu liigutada %s -> %s !',
        'err_fsize_too_large' => 'Sinu poolt salvestatava pildi suurus liiga suur (maksimum lubatud %s x %s) !',
        'err_imgsize_too_large' => 'Sinu poolt salvestatava faili suurus liiga suur (maksimum lubatud %s KB) !',
        'err_invalid_img' => 'Sinu poolt salvestatav fail pole sobiv pilt !',
        'allowed_img_types' => 'Sa vÃµid salvestada ainult %s pilti.',
        'err_insert_pic' => 'Pilti  \'%s\' ei saa lisada albumisse ',
        'upload_success' => 'Sinu pilt salvestati edukalt<br /><br />See saab nÃ¤htavaks pÃ¤rast admini heakskiitu.',
        'info' => 'Informatsioon',
        'com_added' => 'Kommentaar lisatud',
        'alb_updated' => 'Album uuendatud',
        'err_comment_empty' => 'Sinu kommentaar on tÃ¼hi !',
        'err_invalid_fext' => 'Ainult jÃ¤rgmised failitÃ¼Ã¼bid aksepteeritakse : <br /><br />%s.',
        'no_flood' => 'Vabandust, aga sa oled juba selle pildile viimati lisatud kommentaari autor<br /><br />Paranda oma lisatud kommentaari kui soovid seda muuta',
        'redirect_msg' => 'Sind suunatakse Ã¼mber.<br /><br /><br />Klikka \'JÃ„TKA\' kui lehekÃ¼lg automaatselt ei uuene',
        'upl_success' => 'Sinu pilt edukalt lisatud',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Selgitus',
        'fs_pic' => 'TÃ¤is suuruses pilt',
        'del_success' => 'edukalt kustutatud',
        'ns_pic' => 'normaal suuruses pilt',
        'err_del' => 'ei saa kustutada',
        'thumb_pic' => 'pisipilt',
        'comment' => 'kommentaar',
        'im_in_alb' => 'pilt albumis',
        'alb_del_success' => 'Album \'%s\' kustutatud',
        'alb_mgr' => 'Albumi Haldur',
        'err_invalid_data' => 'Vigased andmed laekunud \'%s\'',
        'create_alb' => 'Loon albumit \'%s\'',
        'update_alb' => 'Uuendan albumit \'%s\' pealkirjaga \'%s\' ja indeksiga \'%s\'',
        'del_pic' => 'Kustuta pilt',
        'del_alb' => 'Kustuta album',
        'del_user' => 'Kustuta kasutaja',
        'err_unknown_user' => 'Valitud kasutajat pole olemas !',
        'comment_deleted' => 'Kommentaar edukalt kustutatud',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Oled kindel, et tahad seda pilti KUSTUTADA ? \\nKommentaarid kustutatakse samuti.',
        'del_pic' => 'KUSTUTA SEE PILT',
        'size' => '%s x %s pixelit',
        'views' => '%s korda',
        'slideshow' => 'Slaidivaade',
        'stop_slideshow' => 'PEATA SLAIDIVAADE',
        'view_fs' => 'Klikka vaatamaks tÃ¤issuuruses pilti',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Pildi Informatsioon',
        'Filename' => 'Faili nimi',
        'Album name' => 'Albumi nimi',
        'Rating' => 'Reiting (%s votes)',
        'Keywords' => 'MÃ¤rksÃµnad',
        'File Size' => 'Faili suurus',
        'Dimensions' => 'MÃµÃµdud',
        'Displayed' => 'Kuvatud',
        'Camera' => 'Kaamera',
        'Date taken' => 'ÃœlesvÃµtte kuupÃ¤ev',
        'Aperture' => 'Ava',
        'Exposure time' => 'SÃ¤riaeg',
        'Focal length' => 'Fookus kaugus',
        'Comment' => 'Kommentaar',
        'addFav' => 'Lisa eelistustele',

        'addFavPhrase' => 'Eelistused',

        'remFav' => 'Eemalda eelistustest',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Muuda komentaari',
        'confirm_delete' => 'Oled kindel, et tahad seda kommentaari kustutada ?',
        'add_your_comment' => 'Lisa komentaar',
        'name' => 'Nimi',

        'comment' => 'Kommentaar',

        'your_name' => 'Sinu nimi',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Akna sulgemiseks klÃµpsa pildil',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Saada e-kaart',
        'invalid_email' => '<strong>Hoiatus</strong> : Vigane e-posti aadress !',
        'ecard_title' => 'Sulle on e-kaart %s\' lt',
        'view_ecard' => 'Kui e-kaarti ei kuvata korrektselt, klÃµpsake lingil',
        'view_more_pics' => 'Rohkemate piltide vaatamiseks klÃµpsake lingil !',
        'send_success' => 'Sinu e-kaart on saadetud',
        'send_failed' => 'Vabandust, kuid serveril ei Ãµnnestu Sinu e-kaardi saatmine...',
        'from' => 'Kellelt',
        'your_name' => 'Sinu Nimi',
        'your_email' => 'Sinu e-posti aadress',
        'to' => 'Kellele',
        'rcpt_name' => 'Aadressaadi nimi',
        'rcpt_email' => 'Aadressaadi e-posti aadress',
        'greetings' => 'Tervitused',
        'message' => 'SÃµnum',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Pildi&nbsp;info',
        'album' => 'Album',
        'title' => 'Pealkiri',
        'desc' => 'Kirjeldus',
        'keywords' => 'MÃ¤rksÃµnad',
        'pic_info_str' => '%sx%s - %sKB - %s vaadet - %s hÃ¤Ã¤lt',
        'approve' => 'Kinnita pilt',
        'postpone_app' => 'LÃ¼kka kinnitus edasi',
        'del_pic' => 'Kustuta pilt',
        'reset_view_count' => 'Nulli vaadete loendur',
        'reset_votes' => 'Nulli hÃ¤Ã¤led',
        'del_comm' => 'Kustuta kommendaarid',
        'upl_approval' => 'Salvestuse kinnitus',
        'edit_pics' => 'Paranda pilte',
        'see_next' => 'Vaata jÃ¤rgmisi pilte',
        'see_prev' => 'Vaata eelmisi pilte',
        'n_pic' => '%s pilti',
        'n_of_pic_to_disp' => 'Piltide arv kuvamiseks',
        'apply' => 'Omista muudatused'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Grupi nimi',
        'disk_quota' => 'Ketta kvoot',
        'can_rate' => 'VÃµib hinnata pilte',
        'can_send_ecards' => 'VÃµib saata e-kaarte',
        'can_post_com' => 'VÃµib kommenteerida',
        'can_upload' => 'VÃµib salvestada pilte',
        'can_have_gallery' => 'VÃµib luua isikliku galerii',
        'apply' => 'Omista muudatused',
        'create_new_group' => 'Loo uus grupp',
        'del_groups' => 'Kustuta valitud grupp(id)',
        'confirm_del' => 'Hoiatus, kui sa kustutad grupi, siis kustutava grupi kasutajad kantakse \'Registereeritud\' gruppi !\n\nTahad sa jÃ¤tkata ?',
        'title' => 'Korralda kasutajagruppe',
        'approval_1' => 'Av. salv. kinnitus (1)',
        'approval_2' => 'Isik. salv. kinnitus (2)',
        'note1' => '<strong>(1)</strong> Salvestused avalikku albumisse vajavad admini kinnitust',
        'note2' => '<strong>(2)</strong> Salvestused kasutaja albumisse vajavad admini kinnitust',
        'notes' => 'MÃ¤rkused'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Tere tulemast !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Oled kindel, et tahad seda albumit KUSTUDADA ? \\nKÃµik pildid ja kommentaarid kustutakse samuti.',
        'delete' => 'KUSTUTA',
        'modify' => 'OMADUSED',
        'edit_pics' => 'REDIGEERI PILTE',
        );

    $lang_list_categories = array('home' => 'Avaleht',
        'stat1' => '<strong>[pictures]</strong> pilti <strong>[albums]</strong> albumit ja <strong>[cat]</strong> kategooriat koos <strong>[comments]</strong> kommentaariga vaadatud <strong>[views]</strong> korda',
        'stat2' => '<strong>[pictures]</strong> pilti <strong>[albums]</strong> albumit vaadatud <strong>[views]</strong> korda',
        'xx_s_gallery' => '%s\' Galerii',
        'stat3' => '<strong>[pictures]</strong> pilti <strong>[albums]</strong> albumit koos <strong>[comments]</strong> kommentaariga vaadatud <strong>[views]</strong> korda'
        );

    $lang_list_users = array('user_list' => 'Kasutajate loetelu',
        'no_user_gal' => 'Siin pole kasutajate galeriisid',
        'n_albums' => '%s album(it)',
        'n_pics' => '%s pilt(i)'
        );

    $lang_list_albums = array('n_pictures' => '%s pilt(i)',
        'last_added' => ', viimane lisati %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Uuenda album %s',
        'general_settings' => 'Ãœldised seaded',
        'alb_title' => 'Albumi pealkiri',
        'alb_cat' => 'Albumi kategooria',
        'alb_desc' => 'Albumi kirjeldus',
        'alb_thumb' => 'Albumi pisipilt',
        'alb_perm' => 'Ã•igused sellele albumile',
        'can_view' => 'Albumit vÃµivad vaadata',
        'can_upload' => 'KÃ¼lastajad vÃµivad salvestada pilte',
        'can_post_comments' => 'KÃ¼lastajad vÃµivad kommenteerida',
        'can_rate' => 'KÃ¼lastajad vÃµivad hinnata pilte',
        'user_gal' => 'Kasutaja Galerii',
        'no_cat' => '* Kategooriata *',
        'alb_empty' => 'Album on tÃ¼hi',
        'last_uploaded' => 'Viimati salvestatud',
        'public_alb' => 'IgaÃ¼ks (avalik album)',
        'me_only' => 'Ainult mina',
        'owner_only' => 'Albumi omanik (%s) ainult',
        'groupp_only' => 'Grupi \'%s\' liikmed',
        'err_no_alb_to_modify' => 'Ãœhtegi albumit sa ei saa muuta andmebaasis.',
        'update' => 'Uuenda album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Vabandust, aga sa oled juba seda pilti hinnanud',
        'rate_ok' => 'Sinu hÃ¤Ã¤l on vastu vÃµetud',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Kuigi saidi {SITE_NAME} administraatorid pÃ¼Ã¼avad eemaldada vÃµi muuta mistahes Ã¼ldiselt pahaks-pandavad materjalid niipea kui vÃµimalik, pole vÃµimalik nendegi poolt kohe nÃ¤ha iga postitust. SeetÃµttu pead tunnistama, et kÃµik postitused, mis siia kiirvÃ¤ljaandesse tehakse (pildid, kommentaarid, arvamused) teiste autorite poolt, nende eest administraatorid ja webmasterid ei saa vastutada (vÃ¤ljaarvatud nende endi postitused).<br />
<br />
Sa nÃµustud mitte postitama sÃµimu, roppusi, rÃµvedusi, laimu, solvanguid, Ã¤hvardusi, soolisi- ega muid mÃ¤rkusi ja kommentaare ning materjale, mis oleksid vastuolus kehtivate seadustega. Sa nÃµustud et webmaster, administraator ja saidi {SITE_NAME} vahekohtunikud omavad Ãµigust kustutada vÃµi parandada mistahes sisu kuidas ja millal neile sobib. Kasutajana sa nÃµustud, et kogu sinu Ã¼lal sisestatud info salvestatakse andmebaasi. Kuigi seda infot ei avaldata kolmandatele isikutele ilma sinu nÃµusolekuta, ei saa webmaster ja administraator vÃµtta endale vastutust  hÃ¤kkimiskatsete eest, mis vÃµivad andmed ohtu seada.<br />
<br />
See sait kasutab prÃ¤Ã¤nikuid slavestamaks infot sinu lokaalses arvutis. Need prÃ¤Ã¤nikud on mÃµeldud ainult tÃµstmaks sinu vaatamise rÃµÃµmu. Eposti aadressi kasutatakse ainult kinnitamaks sinu registreerumise detaile ja parooli.<br />
<br />
Kilkates 'Olen nÃµus' allpool, nÃµustud sa nende nÃµuete ja tingimustega.
EOT;

    $lang_register_php = array('page_title' => 'Kasutaja registreerimine',
        'term_cond' => 'Terminid ja tingimused',
        'i_agree' => 'Olen nÃµus',
        'submit' => 'Saada registreerimine',
        'err_user_exists' => 'Sinu siseatud kasutajanimi juba olemas, palun vali muu',
        'err_password_mismatch' => 'Kaks parooli ei lange kokku, palun sisesta nad uuesti',
        'err_uname_short' => 'Kasutajanimi peab olema vÃ¤hemalt 2 tÃ¤hte',
        'err_password_short' => 'Parool peab olema vÃ¤hemalt 2 tÃ¤hte',
        'err_uname_pass_diff' => 'Kasutajanimi peab paroolist erinema',
        'err_invalid_email' => 'Vigane e-posti aadress',
        'err_duplicate_email' => 'Keegi on juba registreerunud sinu sisestatud e-posti aadressiga',
        'enter_info' => 'Sisesta registreerimisinfo',
        'required_info' => 'Vajalik info',
        'optional_info' => 'Vabatahtlik info',
        'username' => 'Kasutajanimi',
        'password' => 'Parool',
        'password_again' => 'Parool uuesti',
        'email' => 'E-post',
        'location' => 'Elukoht',
        'interests' => 'Huvid',
        'website' => 'Koduleht',
        'occupation' => 'Elukutse',
        'error' => 'VIGA',
        'confirm_email_subject' => '%s - Registreerumise kinnitus',
        'information' => 'Informatsioon',
        'failed_sending_email' => 'Reigistreerumise kinnituse e-posti ei saa saata !',
        'thank_you' => 'TÃ¤name Teid registreerumast.<br /><br />E-post infoga, kuidas oma kontot aktiveerida, saadeti sinu antud e-posti aadressile.',
        'acct_created' => 'Sinu konto on loodud ja nÃ¼Ã¼d sa vÃµid sisse logida oma kasutajanime ja parooliga',
        'acct_active' => 'Sinu konto on nÃ¼Ã¼d aktiveeritud ja sa vÃµid sisse logida oma kasutajanime ja parooliga',
        'acct_already_act' => 'Sinu konto on juba aktiivne !',
        'acct_act_failed' => 'Seda kontot ei saa aktiveerida !',
        'err_unk_user' => 'Valitud kasutaja puudub !',
        'x_s_profile' => '%s\'i profiil',
        'group' => 'Grupp',
        'reg_date' => 'Liitutud',
        'disk_usage' => 'Ketta kasutus',
        'change_pass' => 'Muuda parooli',
        'current_pass' => 'Kehtiv parool',
        'new_pass' => 'Uus parool',
        'new_pass_again' => 'Uus parool veelkord',
        'err_curr_pass' => 'Praegune parool on vale',
        'apply_modif' => 'Omista muudatused',
        'change_pass' => 'Muuda minu parool',
        'update_success' => 'Sinu profiil on uuendatud',
        'pass_chg_success' => 'Sinu parool on muudetud',
        'pass_chg_error' => 'Sinu parooli ei muudetud',
        );

    $lang_register_confirm_email = <<<EOT
TÃ¤name sind registreerumast {SITE_NAME}\'s

Sinu kasutajanimi on : "{USER_NAME}"
Sinu parool on : "{PASSWORD}"

JÃ¤rgnevalt et aktiveerida oma konto, pead klikkama lingile allpool
vÃµi kopeeri ja kleebi see oma weebisirvijasse.

{ACT_LINK}

Tervitustega,

{SITE_NAME} 

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Kommentaaride Ã¼levaade',
        'no_comment' => 'Siin pole Ã¼htegi kommentaari Ã¼le vaadata',
        'n_comm_del' => '%s kommentaar(i) kustutatud',
        'n_comm_disp' => 'Kommentaaride arv kuvamiseks',
        'see_prev' => 'Vaata eelmist',
        'see_next' => 'Vaata jÃ¤rgmist',
        'del_comm' => 'Kustuta valitud kommentaarid',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Otsi pildikogumikku',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Otsi uusi pilte',
        'select_dir' => 'Vali kataloog',
        'select_dir_msg' => 'See funktsioon lubab sul lisada kogumiku pilte, mis sa oled salvestanud oma serverisse FTP\'ga.<br /><br />Vali kataloog kuhu sa oma pildid oled salvestanud',
        'no_pic_to_add' => 'Siin pole pilte lisada',
        'need_one_album' => 'Sa vajad vÃ¤hemalt Ã¼hte albumit selle funktsiooni kasutamiseks',
        'warning' => 'Hoiatus',
        'change_perm' => 'see skript ei saa kirjutada sellesse kataloogi, sa pead muutma selle Ãµigusi (mood 755 vÃµi 777) enne kui Ã¼ritad uuesti lisada pilte !',
        'target_album' => '<strong>Pane &quot;</strong>%s<strong>&quot; pildid albumisse </strong>%s',
        'folder' => 'Kaust',
        'image' => 'Pilt',
        'album' => 'Album',
        'result' => 'Tulemus',
        'dir_ro' => 'Pole kirjutatav. ',
        'dir_cant_read' => 'Pole loetav. ',
        'insert' => 'Lisan uued pildid galeriisse',
        'list_new_pic' => 'Uute piltide loetelu',
        'insert_selected' => 'Lisa valitud pildid',
        'no_pic_found' => 'Ei leitud uusi pilte',
        'be_patient' => 'Palun ole kannatlik, skript vajab piltide lisamiseks aega',
        'notes' => '<ul>' . '<li><strong>OK</strong> : tÃ¤hendab, et pilt lisati edukalt' . '<li><strong>DP</strong> : tÃ¤hendab, et pilt on dublikaat ja sisaldub juba andmebaasis' . '<li><strong>PB</strong> : tÃ¤hendab, et pilti ei saa lisada, kontrolli oma seadeid ja kataloogi Ãµigusi kus su pildid asuvad' . '<li>Kui mÃ¤rgid \'OK, DP, PB\' ei ilmu, klikka katkenud pildil nÃ¤gemaks mistahes PHP poolt antud veateadet' . '<li>Kui su sirvijal on \'timeout\', vajuta reload nuppu' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Salvesta pilt',
        'max_fsize' => 'Maksimaalne lubatud failisuurus on %s KB',
        'album' => 'Album',
        'picture' => 'Pilt',
        'pic_title' => 'Pildi pealkiri',
        'description' => 'Pildi kirjeldus',
        'keywords' => 'MÃ¤rksÃµnad (eralda tÃ¼hikutega)',
        'err_no_alb_uploadables' => 'Vabandust, kuid siin pole albumit kuhu sul oleks piltide salvestamine lubatud',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Halda kasutajaid',
        'name_a' => 'Nimed kasvavalt',
        'name_d' => 'Nimed kahanevalt',
        'group_a' => 'Grupid kasvavalt',
        'group_d' => 'Grupid kahanevalt',
        'reg_a' => 'Reg kuupÃ¤ev kasvavalt',
        'reg_d' => 'Reg kuupÃ¤ev kahanevalt',
        'pic_a' => 'Piltide arv kasvavalt',
        'pic_d' => 'Piltide arv kahanevalt',
        'disku_a' => 'Ketta kasutus kasvavalt',
        'disku_d' => 'Ketta kasutus kahanevalt',
        'sort_by' => 'Sordi kasutajaid',
        'err_no_users' => 'Kasutajate tabel tÃ¼hi !',
        'err_edit_self' => 'Sa vÃµid muuta oma profiili, kasuta \'Minu profiil\' linki selleks',
        'edit' => 'MUUDA',
        'delete' => 'KUSTUTA',
        'name' => 'Kasutajanimi',
        'group' => 'Grupp',
        'inactive' => 'Mitteaktiivne',
        'operations' => 'Funktsioonid',
        'pictures' => 'Pildid',
        'disk_space' => 'Kasutatud ruumi / Kvoot',
        'registered_on' => 'Registreeritud',
        'u_user_on_p_pages' => '%d kasutajat %d-el lehel',
        'confirm_del' => 'Oled kindel, et tahad selle kasutaja KUSTUTADA ? \\nKÃµik tema pildid ja albumid kustutatakse samuti.',
        'mail' => 'POST',
        'err_unknown_user' => 'Valitud kasutajat pole !',
        'modify_user' => 'Muuda kasutaja',
        'notes' => 'MÃ¤rkused',
        'note_list' => '<li>Kui sa ei taha muuta kasutuselolevat parooli, jÃ¤ta "parool" vÃ¤li tÃ¼hjaks',
        'password' => 'Parool',
        'user_active' => 'Kasutaja aktiivne',
        'user_group' => 'Kasutaja grupp',
        'user_email' => 'Kasutaja epost',
        'user_web_site' => 'Kasutaja kodukas',
        'create_new_user' => 'Loo uus kasutaja',
        'user_location' => 'Kasutaja elukoht',
        'user_interests' => 'Kasutaja huvid',
        'user_occupation' => 'Kasutaja elukutse',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Pildisuuruse muutmine',

        'what_it_does' => 'Mida see teeb',

        'what_update_titles' => 'uuendab failist pealkirju',

        'what_delete_title' => 'Kustutab pealkirju',

        'what_rebuild' => 'Genereerib uued pisipildid ja muudetud suurusega pildid',

        'what_delete_originals' => 'Kustutab orginaalsuurusega pildid, asendades need uue suurusega piltidega',

        'file' => 'Fail',

        'title_set_to' => 'pealkiri muudetud ',

        'submit_form' => 'sisesta',

        'updated_succesfully' => 'uuendatud edukalt',

        'error_create' => 'VIGA tekitamisel',

        'continue' => 'Process more images',

        'main_success' => 'Fail %s was successfully used as main picture',

        'error_rename' => ' %s Ã¼mbernimetamine %s ebaÃµnnestus',

        'error_not_found' => 'Faili %s ei leitud',

        'back' => 'Tagasi pealehele',

        'thumbs_wait' => 'Uuendan pisipilte ja/vÃµi muudetud suurusega pilte, palun oota...',

        'thumbs_continue_wait' => 'JÃ¤tkan pisipiltidde ja/vÃµi muudetud suurusega piltide uuendamist...',

        'titles_wait' => 'Uuendan pealkirju, palun oota...',

        'delete_wait' => 'Kustutan pealkirju, palun oota...',

        'replace_wait' => 'Kustutan orginaalid ja asendan muudetud suurusega piltidega, palun oota ...',

        'instruction' => 'LÃ¼hijuhend',

        'instruction_action' => 'Vali tegevus',

        'instruction_parameter' => 'Sea parameetrid',

        'instruction_album' => 'Vali album',

        'instruction_press' => 'Vajuta %s',

        'update' => 'Uuenda pisipildid ja/vÃµi muudetud suurusega fotod',

        'update_what' => 'Mida tuleks uuendada',

        'update_thumb' => 'Ainult pisipildid',

        'update_pic' => 'Ainult muudetud suurusega pildid',

        'update_both' => 'MÃµlemad, pisipildid ja muudetud suurusga pildid',

        'update_number' => 'TÃ¶Ã¶deldud piltide arv kliki kohta',

        'update_option' => '(Sea see valik vÃ¤iksemaks kui tekkib probleem ajalimiidiga (timeout))',

        'filename_title' => 'Failinimi &rArr; Pildi pealkiri',

        'filename_how' => 'Kuidas tuleks failinime muuta',

        'filename_remove' => 'Eemalda .jpg lÃµpp ja asenda _ (alakriipsud) tÃ¼hikutega',

        'filename_euro' => 'Muuda 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',

        'filename_us' => 'Muuda 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',

        'filename_time' => 'Muuda 2003_11_23_13_20_20.jpg to 13:20',

        'delete' => 'Pildi pealkirjade vÃµi orginaalsuurusega piltide kustutamine',

        'delete_title' => 'Kustuta pildi pealkirjad',

        'delete_original' => 'Kustusta orginaalsuurusega fotod',

        'delete_replace' => 'Kustuta orginaalsuurusega fotod asendades need muudetud suurusega piltidega',

        'select_album' => 'Vali album',

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