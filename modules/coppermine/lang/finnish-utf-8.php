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
define('PIC_VIEWS', 'tarkastelua');
define('PIC_VOTES', 'Ã¤Ã¤ntÃ¤');
define('PIC_COMMENTS', 'Kommenttia');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Finnish', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Suomea', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'EspaÃ±ol'
    'lang_country_code' => 'fi', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'V.Taavila', // the name of the translator - can be a nickname
    'trans_email' => 'quandox@kastema.to', // translator's email address (optional)
    'trans_website' => 'http://', // translator's website (optional)
    'trans_date' => '2003-10-14', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-15';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La');
$lang_month = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'KesÃ¤kuu', 'HeinÃ¤kuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');
// Some common strings
$lang_yes = 'KyllÃ¤';
$lang_no = 'Ei';
$lang_back = 'TAKAISIN';
$lang_continue = 'JATKA';
$lang_info = 'Info';
$lang_error = 'Virhe';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Satunaiset kuvat',
    'lastup' => 'Uusimmat kuvat',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Viimeksi pÃ¤ivitetyt albumit',
    'lastcom' => 'Uusimmat komentit',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Katsotuimmat',
    'toprated' => 'Suosituimmat',
    'lasthits' => 'Viimeksi tarkasteltu',
    'search' => 'Haun tulokset',
    'favpics' => 'Suosikkikini'
    );

$lang_errors = array('access_denied' => 'Ei oikeuksia tÃ¤lle sivulle.',
    'perm_denied' => 'Ei oikeuksia kyseisen toiminnon suorittamiseen.',
    'param_missing' => 'ScriptiÃ¤ kutsuttu ilman vaadittavia parametrejÃ¤.',
    'non_exist_ap' => 'Valittua albumia/kuvaa ei lÃ¶ydy !',
    'quota_exceeded' => 'Levytilasi on tÃ¤ynnÃ¤<br /><br />Levytilasi on tÃ¤ynnÃ¤ [quota]K, kuviesi vievÃ¤ tila [space]K, lisÃ¤Ã¤mÃ¤llÃ¤ tÃ¤mÃ¤n kuvan tilasi koko ylittyisi.',
    'gd_file_type_err' => 'Kun kÃ¤ytÃ¤t GD:tÃ¤ sallitut tiedostomuodot ovat JPEG ja PNG.',
    'invalid_image' => 'Kuva on korruptoitunut eikÃ¤ sitÃ¤ voi kÃ¤sitellÃ¤ GD:llÃ¤',
    'resize_failed' => 'Ongelma thumbnailien luomisessa.',
    'no_img_to_display' => 'Ei nÃ¤yttettÃ¤viÃ¤ kuvia',
    'non_exist_cat' => 'Valittua kategoriaa ei lÃ¶ydy',
    'orphan_cat' => 'Ongelmia kategoriassa, aja kategoria manageri selvitÃ¤Ã¤ksesi ongelma.',
    'directory_ro' => 'Hakemistoon \'%s\' ei ole mÃ¤Ã¤ritelty kirjoitusoikeuksia. Kuvia ei voi poistaa',
    'non_exist_comment' => 'Valittua kommenttia ei lÃ¶ydy.',
    'pic_in_invalid_album' => 'Kuvaa ei ole albumissa (%s)!?',
    'banned' => 'Sinulta on evÃ¤tty pÃ¤Ã¤sy tÃ¤lle sivulle.',
    'not_with_udb' => 'TÃ¤mÃ¤ toiminto on poistettu kÃ¤ytÃ¶stÃ¤ Coppermine gallerissa koska tÃ¤mÃ¤ on integroitu foorumi ohjelmistoon. Toiminto jota eritit tehdÃ¤ ei ole tuettuna tÃ¤ssÃ¤ kokoonpanossa, toiminto lÃ¶ytyy mahdollisesti foorumi ohjelmistosta.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Mene albumi listaan',
    'alb_list_lnk' => 'Albumi lista',
    'my_gal_title' => 'Mene omaan galleriaan',
    'my_gal_lnk' => 'Oma galleria',
    'my_prof_lnk' => 'Omat asetukset',
    'adm_mode_title' => 'Vaihda yllÃ¤pitotilaan',
    'adm_mode_lnk' => 'YllÃ¤pitotila',
    'usr_mode_title' => 'Vaihda kÃ¤yttÃ¤jÃ¤tilaan',
    'usr_mode_lnk' => 'KÃ¤yttÃ¤jÃ¤tila',
    'upload_pic_title' => 'LisÃ¤Ã¤ kuva albumiin',
    'upload_pic_lnk' => 'LisÃ¤Ã¤ kuva',
    'register_title' => 'Luo uusi tili',
    'register_lnk' => 'RekisterÃ¶idy',
    'login_lnk' => 'Kirjaudu',
    'logout_lnk' => 'Poistu',
    'lastup_lnk' => 'Viimeksi lisÃ¤tty',
    'lastcom_lnk' => 'Uusimmat kommentit',
    'topn_lnk' => 'Katsotuimmat',
    'toprated_lnk' => 'Suosituimmat',
    'search_lnk' => 'Haku',
    'fav_lnk' => 'Suosikkini',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Tarkistettavat',
    'config_lnk' => 'Asetukset',
    'albums_lnk' => 'Albumit',
    'categories_lnk' => 'Kategoriat',
    'users_lnk' => 'KÃ¤yttÃ¤jÃ¤t',
    'groups_lnk' => 'RyhmÃ¤t',
    'comments_lnk' => 'Kommentit',
    'searchnew_lnk' => 'LisÃ¤Ã¤ "FTP" kuvat',
    'util_lnk' => 'KÃ¤sittele Kuvia',
    'ban_lnk' => 'KiellÃ¤ KÃ¤yttÃ¤jiÃ¤',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Luo / muokkaa albumeita',
    'modifyalb_lnk' => 'Muokkaa omaa albumia',
    'my_prof_lnk' => 'Omat asetukset',
    );

$lang_cat_list = array('category' => 'Kategoria',
    'albums' => 'Albumit',
    'pictures' => 'Kuvat',
    );

$lang_album_list = array('album_on_page' => '%d albumia %d sivu(a)'
    );

$lang_thumb_view = array('date' => 'PVM', 
    // Sort by filename and title
    'name' => 'NIMI',
    'title' => 'OTSIKKO',
    'sort_da' => 'JÃ¤rjestÃ¤ pÃ¤ivÃ¤mÃ¤Ã¤rittÃ¤in nousevasti',
    'sort_dd' => 'JÃ¤rjestÃ¤ pÃ¤ivÃ¤mÃ¤Ã¤rittÃ¤in laskevasti',
    'sort_na' => 'JÃ¤rjestÃ¤ nimellÃ¤ nousevasti',
    'sort_nd' => 'JÃ¤rjestÃ¤ nimellÃ¤ laskevasti',
    'sort_ta' => 'JÃ¤rjestÃ¤ otsikolla nousevasti',
    'sort_td' => 'JÃ¤rjestÃ¤ otsikolla laskevasti',
    'pic_on_page' => '%d kuvaa %d sivu(a)',
    'user_on_page' => '%d kÃ¤yttÃ¤jÃ¤Ã¤ %d sivu(a)'
    );

$lang_img_nav_bar = array('thumb_title' => 'Takaisin thumbnail sivulle',
    'pic_info_title' => 'NÃ¤ytÃ¤/piilota kuvan tiedot',
    'slideshow_title' => 'diashow',
    'ecard_title' => 'LÃ¤hetÃ¤ tÃ¤mÃ¤ kuva e-korttina',
    'ecard_disabled' => 'e-kortit pois pÃ¤Ã¤ltÃ¤',
    'ecard_disabled_msg' => 'Sinulla ei ole oikeuksia lÃ¤hettÃ¤Ã¤ e-kortteja',
    'prev_title' => 'NÃ¤ytÃ¤ edellinen kuva',
    'next_title' => 'NÃ¤ytÃ¤ seuraava kuva',
    'pic_pos' => 'KUVA %s/%s',
    'next_title' => 'See next picture',
    'pic_pos' => 'PICTURE %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Ã„Ã¤nestÃ¤ tÃ¤tÃ¤ kuvaa ',
    'no_votes' => '(ei Ã¤Ã¤niÃ¤ vielÃ¤)',
    'rating' => '(nykyinen taso : %s / 5 ja %s Ã¤Ã¤ntÃ¤)',
    'rubbish' => 'Roskaa',
    'poor' => 'TylsÃ¤Ã¤',
    'fair' => 'Keskinkertainen',
    'good' => 'HyvÃ¤',
    'excellent' => 'Loistava',
    'great' => 'Mahtava',
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
    CRITICAL_ERROR => 'Kriittinen Virhe',
    'file' => 'Tiedosto: ',
    'line' => 'Rivi: ',
    );

$lang_display_thumbnails = array('filename' => 'Tiedostonimi : ',
    'filesize' => 'Tiedostokoko : ',
    'dimensions' => 'Tarkkuus : ',
    'date_added' => 'LisÃ¤tty : '
    );

$lang_get_pic_data = array('n_comments' => '%s kommenttia',
    'n_views' => '%s tarkastelua',
    'n_votes' => '(%s Ã¤Ã¤ntÃ¤)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Huuto',
        'Question' => 'Kysymys',
        'Very Happy' => 'ErittÃ¤in Iloinen',
        'Smile' => 'Hymy',
        'Sad' => 'Suru',
        'Surprised' => 'YllÃ¤ttynyt',
        'Shocked' => 'JÃ¤rkyttynyt',
        'Confused' => 'HÃ¤keltynyt',
        'Cool' => 'Cool',
        'Laughing' => 'Nauru',
        'Mad' => 'Hullu',
        'Razz' => 'Razz',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => 'ItkeÃ¤',
        'Evil or Very Mad' => 'ErittÃ¤in Hullu',
        'Twisted Evil' => 'Kieroutunut Hullu',
        'Rolling Eyes' => 'PyÃ¶rivÃ¤t silmÃ¤t',
        'Wink' => 'Vink',
        'Idea' => 'Idea',
        'Arrow' => 'Nuoli',
        'Neutral' => 'Neutraali',
        'Mr. Green' => 'Mr. VihreÃ¤',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Poistuu yllÃ¤pitotilasta...',
        1 => 'SisÃ¤Ã¤n yllÃ¤pitotilaan...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Albumi tarvitsee nimen !',
        'confirm_modifs' => 'Haluatko varmasti tehdÃ¤ nÃ¤mÃ¤ muutokset ?',
        'no_change' => 'Et tehnyt yhtÃ¤Ã¤n muutosta !',
        'new_album' => 'Uusi albumi',
        'confirm_delete1' => 'Haluatko varmasti poistaa tÃ¤mÃ¤n albumin albumin ?',
        'confirm_delete2' => '\nKaikki kuvat ja kommentit tulevat poistumaan !',
        'select_first' => 'Valitse albumi ensin',
        'alb_mrg' => 'Albumi Manageri',
        'my_gallery' => '* Oma galleria *',
        'no_category' => '* Ei kategoriaa *',
        'delete' => 'Poista',
        'new' => 'Uusi',
        'apply_modifs' => 'HyvÃ¤ksy muutokset',
        'select_category' => 'Valitse Kategoria',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Toimintoa \'%s\'ei voitu suorittaa !',
        'unknown_cat' => 'Valittua kategoriaa ei ole enÃ¤Ã¤ tietokannassa',
        'usergal_cat_ro' => 'KÃ¤yttÃ¤jien gallerioiden kategorioita ei voi poistaa !',
        'manage_cat' => 'Hallitse kategorioita',
        'confirm_delete' => 'Haluatko varmasti POISTAA tÃ¤mÃ¤n kategorian',
        'category' => 'Kategoria',
        'operations' => 'Toiminnot',
        'move_into' => 'SiirrÃ¤',
        'update_create' => 'PÃ¤ivitÃ¤/Luo kategoria',
        'parent_cat' => 'PÃ¤Ã¤kategoria',
        'cat_title' => 'Kategorian otsikko',
        'cat_desc' => 'Kategorian tarkenne'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Asetukset',
        'restore_cfg' => 'Palauta oletukset',
        'save_cfg' => 'Tallenna muutokset',
        'notes' => 'Huomio',
        'info' => 'Info',
        'upd_success' => 'Coppermine asetukset pÃ¤ivitetty',
        'restore_success' => 'Coppermine oletusasetukset palautettu',
        'name_a' => 'Nimi nousevasti',
        'name_d' => 'Nimi laskevasti',
        'title_a' => 'Otsikko nousevasti',
        'title_d' => 'Otsikko laskevasti',
        'date_a' => 'PÃ¤ivÃ¤ nousevasti',
        'date_d' => 'PÃ¤ivÃ¤ laskevasti',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings'Yleiset asetukset',
        array(
            'Gallerian nimi', 'gallery_name', 0),
        array(
            'Gallerian tarkenne', 'gallery_description', 0),
        array(
            'Gallerian yllÃ¤pitÃ¤jÃ¤n sÃ¤hkÃ¶posti', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0),
        array(
            'Kieli', 'lang', 5),
// for postnuke change
        array('Teema', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), // new in cpg1.2.0nuke
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Albumin "nÃ¤yttÃ¶" asetukset',
        array(
            'PÃ¤Ã¤taulukon leveys (pikseleissÃ¤ tai %)', 'main_table_width', 0),
        array(
            'Kuinka monta kategoriaa nÃ¤ytetÃ¤Ã¤n tasolla', 'subcat_level', 0),
        array(
            'Kuinka monta albumia nÃ¤ytetÃ¤Ã¤n sivulla', 'albums_per_page', 0),
        array(
            'Kuinka monta saraketta nÃ¤ytetÃ¤Ã¤n albumi listassa', 'album_list_cols', 0),
        array(
            'Thumbnailien koko pikseleissÃ¤', 'alb_list_thumb_size', 0),
        array(
            'MitÃ¤ tietoja etusivulla nÃ¤ytetÃ¤Ã¤n', 'main_page_layout', 0),
        array(
            'NÃ¤ytÃ¤ ensimmÃ¤isen tason albumin thumbnailit kategoriassa', 'first_level', 1), 
        // 'Thumbnail view',
        'Thumbnailien nÃ¤yttÃ¶',
        array(
            'Sarakkeita thumbnail sivulla', 'thumbcols', 0),
        array(
            'RivejÃ¤ thumbnail sivulla', 'thumbrows', 0),
        array(
            'Kaistaleiden maksimi mÃ¤Ã¤rÃ¤', 'max_tabs', 0),
        array(
            'NÃ¤ytÃ¤ kuvateksti thumbnaileissa', 'caption_in_thumbview', 1),
        array(
            'NÃ¤ytÃ¤ kommenttien mÃ¤Ã¤rÃ¤ thumbnaileissa', 'display_comment_count', 1),
        array(
            'Kuvien oletus jÃ¤rjestys', 'default_sort_order', 3),
        array(
            'Tarvittavien Ã¤Ã¤nien mÃ¤Ã¤rÃ¤ ennen \'suosituimmat\' listalle pÃ¤Ã¤syÃ¤', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Kuvien nÃ¤yttÃ¶ &amp; Kommentti asetukset',
        array(
            'Kuvan nÃ¤yttÃ¶ taulukon leveys (pikseleinÃ¤ tai %)', 'picture_table_width', 0),
        array(
            'Kuvan info oletuksena piilotettu', 'display_pic_info', 1),
        array(
            'Rumasana filtteri', 'filter_bad_words', 1),
        array(
            'HyvÃ¤ksy hymiÃ¶t kommentissa', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Kuvatekstin maksimi pituus', 'max_img_desc_length', 0),
        array(
            'Maksimi mÃ¤Ã¤rÃ¤ merkkejÃ¤ sanassa', 'max_com_wlength', 0),
        array(
            'Kommentti rivien maksimi mÃ¤Ã¤rÃ¤', 'max_com_lines', 0),
        array(
            'Kommentin maksimi pituus', 'max_com_size', 0),
        array(
            'NÃ¤ytÃ¤ thumbnaileja kuva sivulla', 'display_film_strip', 1),
        array(
            'Thumbnaileja kuva sivulla', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Kuvien ja thumbnailien asetukset',
        array(
            'Tarkkuus JPEG tiedostoilla', 'jpeg_qual', 0),
        array(
            'Thumbnail maksimi leveys tai korkeus <strong>*</strong>', 'thumb_width', 0),
        array(
            'KÃ¤ytÃ¤ mittaa ( leveys tai korkeus tai Maksimi mitta thumbnaileissa )<strong>*</strong>', 'thumb_use', 7),
        array(
            'Luo vÃ¤liaikaiset kuvat', 'make_intermediate', 1),
        array(
            'VÃ¤liaikaiset kuvien maksimi leveys tai korkeus <strong>*</strong>', 'picture_width', 0),
        array(
            'Ladattavien kuvien maksimi koko (KB)', 'max_upl_size', 0),
        array(
            'Ladattavien kuvien maksimi leveys (pikseleinÃ¤)', 'max_upl_width_height', 0), 
        // 'User settings'
        'KÃ¤yttÃ¤jÃ¤ asetukset',
        array(
            'Salli uusien kÃ¤yttÃ¤jien rekisterÃ¶ityÃ¤', 'allow_user_registration', 1),
        array(
            'RekisterÃ¶inti vaatii sÃ¤hkÃ¶posti varmistuksen', 'reg_requires_valid_email', 1),
        array(
            'Salli kahdelle kÃ¤yttÃ¤jÃ¤lle sama sÃ¤hkÃ¶posti osoite', 'allow_duplicate_emails_addr', 1),
        array(
            'KÃ¤yttÃ¤jÃ¤t saavat yksityiset albumit', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Valinnaiset kentÃ¤t kuvan nÃ¤ytÃ¶ssÃ¤ (jÃ¤tÃ¤ tyhjÃ¤ksi jos et halua kÃ¤yttÃ¤Ã¤)',
        array(
            'KenttÃ¤ 1 nimi', 'user_field1_name', 0),
        array(
            'KenttÃ¤ 2 nimi', 'user_field2_name', 0),
        array(
            'KenttÃ¤ 3 nimi', 'user_field3_name', 0),
        array(
            'KenttÃ¤ 4 nimi', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Kuvien ja thumbnailien lisÃ¤ asetukset',
        array(
            'NÃ¤ytÃ¤ yksityisessa albumissa Ikoni kirjautumattomalle kÃ¤yttÃ¤jÃ¤lle', 'show_private', 1),
        array(
            'Kielletyt merkit tiedostonimissÃ¤', 'forbiden_fname_char', 0),
        array(
            'HyvÃ¤ksytyt tiedotopÃ¤Ã¤tteet', 'allowed_file_extensions', 0),
        array(
            'Kuvien koot muutetaan kÃ¤yttÃ¤mÃ¤llÃ¤', 'thumb_method', 2),
        array(
            'TÃ¤ydellinen ImageMagick polku \'konventteri\' (esimerkiksi /usr/bin/X11/)', 'impath', 0),
        array(
            'KyvÃ¤ksytyt kuva tyypit (kelpaa vain ImageMagickia kÃ¤ytettÃ¤essÃ¤)', 'allowed_img_types', 0),
        array(
            'ImageMagick komentorivin asetukset', 'im_options', 0),
        array(
            'Lue EXIF tiedot JPEG kuvista', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Albumi hakemisto <strong>*</strong>', 'fullpath', 0),
        array(
            'KÃ¤yttÃ¤jien kuvien hakemisto <strong>*</strong>', 'userpics', 0),
        array(
            'VÃ¤liaikaisten kuvien etuliite <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Thumbnailien etuliite <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Hakemistojen oletus oikeudet', 'default_dir_mode', 0),
        array(
            'Kuvien oletus oikeudet', 'default_file_mode', 0),
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
        'EvÃ¤ste &amp; koodaus asetukset',
        array(
            'EvÃ¤steen nimi', 'cookie_name', 0),
        array(
            'EvÃ¤steen polku', 'cookie_path', 0),
        array(
            'KÃ¤ytettÃ¤vÃ¤ koodaus', 'charset', 4), 
        // 'Miscellaneous settings',
        'Muut asetukset',
        array(
            'NÃ¤ytÃ¤ palvelimen virheilmoitukset', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) KentÃ¤t joissa on * merkki ei saa muuttaa jos galleriassa on jo kuvia.</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Sinun on kirjoitettava nimesi kommenttiin',
        'com_added' => 'Kommenttisi on lisÃ¤tty',
        'alb_need_title' => 'Albumin otsikko puuttuu !',
        'no_udp_needed' => 'PÃ¤ivitysta ei tarvita.',
        'alb_updated' => 'Albumi pÃ¤ivitetty',
        'unknown_album' => 'Valittua albumia ei lÃ¶ydy tai sinulla ei ole oikeuksia siihen',
        'no_pic_uploaded' => 'Ei lisÃ¤ttyÃ¤ kuvaa !<br /><br />Jos todella valitsit lisÃ¤ttÃ¤vÃ¤n kuvan pyydÃ¤ yllÃ¤pitÃ¤jÃ¤Ã¤ tarkistamaan palvelimen asetukset...',
        'err_mkdir' => 'Virhe hakemiston luomisessa %s !',
        'dest_dir_ro' => 'LÃ¤hde hakemisto %s ei ole luettavissa !',
        'err_move' => 'Mahdotonta siirtÃ¤Ã¤ %s - %s !',
        'err_fsize_too_large' => 'Tiedosto jota yritit lisÃ¤tÃ¤ oli liian suuri (suurin sallittu koko %s x %s) !',
        'err_imgsize_too_large' => 'Tiedosto jota yritit lisÃ¤tÃ¤ oli liian suuri (suurin sallittu koko on %s KB) !',
        'err_invalid_img' => 'Tiedosto jota yritit lisÃ¤tÃ¤ ei hyvÃ¤ksytÃ¤ !',
        'allowed_img_types' => 'Voit lisÃ¤tÃ¤ ainostaan %s kuvia.',
        'err_insert_pic' => 'Kuvaa \'%s\' ei voi liittÃ¤Ã¤ albumiin ',
        'upload_success' => 'Kuva lisÃ¤tty onnistuneesti<br /><br />Se tulee julkiseksi jos yllÃ¤pitÃ¤jÃ¤ hyvÃ¤ksyy sen.',
        'info' => 'Info',
        'com_added' => 'Kommentti lisÃ¤tty',
        'alb_updated' => 'Albumi pÃ¤ivitetty',
        'err_comment_empty' => 'Kommenttisi oli tyhjÃ¤ !',
        'err_invalid_fext' => 'Vain seuraavat tiedostopÃ¤Ã¤tteet ovat sallittuja : <br /><br />%s.',
        'no_flood' => 'Viimeinen kommentti on jo lisÃ¤tty<br /><br />Muokkaa kommenttia jos haluat muuttaa sitÃ¤',
        'redirect_msg' => 'Sinut siirretÃ¤Ã¤n.<br /><br /><br />Klikkaa \'JATKA\' jos sivu ei pÃ¤ivity automaattisesti',
        'upl_success' => 'Kuvasi lisÃ¤tty onnistuneesti',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Kuvateksti',
        'fs_pic' => 'tÃ¤ysikokoinen kuva',
        'del_success' => 'onnistuneesti poistettu',
        'ns_pic' => 'normaali kokoinen kuva',
        'err_del' => 'ei voi poistaa',
        'thumb_pic' => 'thumbnaili',
        'comment' => 'kommentti',
        'im_in_alb' => 'kuva albumissa',
        'alb_del_success' => 'Albumi \'%s\' poistettu',
        'alb_mgr' => 'Albumin Hallinta',
        'err_invalid_data' => 'VirhellistÃ¤ dataa vÃ¤litetty \'%s\'',
        'create_alb' => 'Luodaan albumia \'%s\'',
        'update_alb' => 'PÃ¤ivitetÃ¤Ã¤n albumia \'%s\' otsikko \'%s\' ja indeksi \'%s\'',
        'del_pic' => 'Poista kuva',
        'del_alb' => 'Poista albumi',
        'del_user' => 'Poista kÃ¤yttÃ¤jÃ¤',
        'err_unknown_user' => 'Valittua kÃ¤yttÃ¤jÃ¤Ã¤ ei lÃ¶ydy !',
        'comment_deleted' => 'Komentti poistettu onnistuneesti',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Haluatko varmasti POISTAA tÃ¤mÃ¤n kuvan ? \\nKommentit poistetaan samalla.',
        'del_pic' => 'POISTA TÃ„MÃ„ KUVA',
        'size' => '%s x %s pikseliÃ¤',
        'views' => '%s kertaa',
        'slideshow' => 'Diashow',
        'stop_slideshow' => 'PYSÃ„YTÃ„ DIASHOW',
        'view_fs' => 'Klikkaamalla kuvaa voit tarkastella sitÃ¤ tÃ¤ysikokoisena',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Kuvan tiedot',
        'Filename' => 'Tiedostonimi',
        'Album name' => 'Albumin nimi',
        'Rating' => 'Arvo (%s Ã¤Ã¤ntÃ¤)',
        'Keywords' => 'Hakusanat',
        'File Size' => 'Tiedostokoko',
        'Dimensions' => 'Tarkkuus',
        'Displayed' => 'Tarkasteltu',
        'Camera' => 'Kamera',
        'Date taken' => 'Kuva otettu',
        'Aperture' => 'Aukko',
        'Exposure time' => 'Valotusaika',
        'Focal length' => 'PolttovÃ¤li',
        'Comment' => 'Kommentti',
        'addFav' => 'LisÃ¤Ã¤ suosikkeihin',
        'addFavPhrase' => 'Suosikit',
        'remFav' => 'Poista suosikeista',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Muokkaa kommenttia',
        'confirm_delete' => 'Haluatko varmasti poistaa tÃ¤mÃ¤n kommentin ?',
        'add_your_comment' => 'LisÃ¤Ã¤ kommenttisi',
        'name' => 'Nimi',
        'comment' => 'Komenti',
        'your_name' => 'Nimesi',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klikkaa kuvaa sulkeaksesi tÃ¤mÃ¤ ikkuna',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'lÃ¤hetÃ¤ e-kortti',
        'invalid_email' => '<strong>Varoitus</strong> : virheellinen sÃ¤hkÃ¶posti osoite!',
        'ecard_title' => 'E-kortti %s sinulle',
        'view_ecard' => 'Jos e-kortti nÃ¤kyy virheellisesti klikkaa tÃ¤stÃ¤',
        'view_more_pics' => 'Klikkaa tÃ¤sta nÃ¤hdÃ¤ksesi lisÃ¤Ã¤ kuvia !',
        'send_success' => 'E-kortti lÃ¤hetetty',
        'send_failed' => 'Palvelin ei salli e-korttien lÃ¤hetystÃ¤...',
        'from' => 'LÃ¤hettÃ¤jÃ¤',
        'your_name' => 'Nimesi',
        'your_email' => 'SÃ¤hkÃ¶posti',
        'to' => 'Vastaanottaja',
        'rcpt_name' => 'Vastaanottajan nimi',
        'rcpt_email' => 'Vastaanottaja sÃ¤hkÃ¶posti',
        'greetings' => 'Terveiset',
        'message' => 'Viesti',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Kuvan&nbsp;tiedot',
        'album' => 'Albumi',
        'title' => 'Otsikko',
        'desc' => 'Tarkenne',
        'keywords' => 'Hakusanat',
        'pic_info_str' => '%sx%s - %sKB - %s tarkastelua - %s Ã¤Ã¤ntÃ¤',
        'approve' => 'HyvÃ¤ksy kuva',
        'postpone_app' => 'LykkÃ¤Ã¤ vahvistamista',
        'del_pic' => 'Poista kuva',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
        'reset_view_count' => 'Nollaa laskuri',
        'reset_votes' => 'Nollaa Ã¤Ã¤net',
        'del_comm' => 'Poista kommentit',
        'upl_approval' => 'LisÃ¤tyt hyvÃ¤ksyttÃ¤vÃ¤t',
        'edit_pics' => 'Muokkaa kuvia',
        'see_next' => 'NÃ¤ytÃ¤ seuraavat kuvat',
        'see_prev' => 'NÃ¤ytÃ¤ edelliset kuvat',
        'n_pic' => '%s kuvat',
        'n_of_pic_to_disp' => 'Kuinka monta kuvaa nÃ¤ytetÃ¤Ã¤n',
        'apply' => 'HyvÃ¤ksy muutokset'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'RyhmÃ¤n nimi',
        'disk_quota' => 'Levytila',
        'can_rate' => 'Voi Ã¤Ã¤nestÃ¤Ã¤ kuvia',
        'can_send_ecards' => 'Voi lÃ¤hettÃ¤Ã¤ e-kortteja',
        'can_post_com' => 'Voi kommentoida',
        'can_upload' => 'Voi lisÃ¤tÃ¤ kuvia',
        'can_have_gallery' => 'Voi saada oman gallerian',
        'apply' => 'HyvÃ¤ksy muutokset',
        'create_new_group' => 'Luo uusi ryhmÃ¤',
        'del_groups' => 'Poista valitut ryhmÃ¤t',
        'confirm_del' => 'Varoitus, kun poistat ryhmÃ¤n, kÃ¤yttÃ¤jÃ¤t ketkÃ¤ kuuluvat ryhmÃ¤Ã¤n siirretÃ¤Ã¤n \'RekisterÃ¶idyt\' ryhmÃ¤Ã¤n !\n\nHaluatko jatkaa ?',
        'title' => 'Muokkaa kÃ¤yttÃ¤jÃ¤ ryhmiÃ¤',
        'approval_1' => 'HyvÃ¤ksyntÃ¤ asetus (1)',
        'approval_2' => 'HyvÃ¤ksyntÃ¤ asetus (2)',
        'note1' => '<strong>(1)</strong> LisÃ¤ykset julkiseen albumiin tarvitsevat yllÃ¤pidon hyvÃ¤ksynnÃ¤n',
        'note2' => '<strong>(2)</strong> LisÃ¤ykset kÃ¤yttÃ¤jÃ¤n albumiin tarvitsevat yllÃ¤pidon hyvÃ¤ksynnÃ¤n',
        'notes' => 'Huomio'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Tervetuloa !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Haluatko varmasti POISTAA tÃ¤mÃ¤n albumin ? \\nKaikki kuvat ja kommentit poistetaan myÃ¶s.',
        'delete' => 'POISTA',
        'modify' => 'MUOKKAA',
        'edit_pics' => 'MUOKKAA KUVIA',
        );

    $lang_list_categories = array('home' => 'Etusivu',
        'stat1' => '<strong>[pictures]</strong> kuvaa <strong>[albums]</strong> albumia ja <strong>[cat]</strong> kategoriaa sekÃ¤ <strong>[comments]</strong> kommentia. Kuvia tarkasteltu <strong>[views]</strong> kertaa',
        'stat2' => '<strong>[pictures]</strong> kuvaa <strong>[albums]</strong> albumia tarkasteltu <strong>[views]</strong> kertaa',
        'xx_s_gallery' => '%s\'s Galleria',
        'stat3' => '<strong>[pictures]</strong> kuvaa <strong>[albums]</strong> albumia jossa <strong>[comments]</strong> kommenttia. Kuvia tarkasteltu <strong>[views]</strong> kertaa'
        );

    $lang_list_users = array('user_list' => 'KÃ¤yttÃ¤jÃ¤ lista',
        'no_user_gal' => 'Ei ole kÃ¤yttÃ¤jiÃ¤ joilla oikeus albumiin',
        'n_albums' => '%s albumi(t)',
        'n_pics' => '%s kuva(a)'
        );

    $lang_list_albums = array('n_pictures' => '%s kuvaa',
        'last_added' => ', viimeisin lisÃ¤tty %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'PÃ¤ivitÃ¤ albumi %s',
        'general_settings' => 'Yleiset asetukset',
        'alb_title' => 'Albumin otsikko',
        'alb_cat' => 'Albumin kategoria',
        'alb_desc' => 'Albumin tarkenne',
        'alb_thumb' => 'Albumi thumbnailit',
        'alb_perm' => 'Albumin oikeudet',
        'can_view' => 'Albumia voi tarkastella',
        'can_upload' => 'Vierailijat voivat lisÃ¤tÃ¤ kuvia',
        'can_post_comments' => 'Vierailijat voivat kommentoida',
        'can_rate' => 'VierÃ¤ilijat voivat arvostella',
        'user_gal' => 'KÃ¤yttÃ¤jÃ¤n Galleria',
        'no_cat' => '* Ei kategoriaa *',
        'alb_empty' => 'Albumi on tyhja',
        'last_uploaded' => 'Viimeksi lisÃ¤tty',
        'public_alb' => 'Kaikki (julkinen albumi)',
        'me_only' => 'MinÃ¤ ainoastaan',
        'owner_only' => 'Albumin omistaja (%s) ainoastaan',
        'groupp_only' => 'JÃ¤senet ryhmÃ¤stÃ¤ \'%s\' ',
        'err_no_alb_to_modify' => 'Ei muokattavia albumeita tietokannassa.',
        'update' => 'PÃ¤ivitÃ¤ albumi'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Olet jo arvostellut tÃ¤mÃ¤n kuvan',
        'rate_ok' => 'Ã„Ã¤nesi hyvÃ¤ksytty',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Sivuston {SITE_NAME} yllÃ¤pitÃ¤jÃ¤t poistavat kaiken sopimattoman materiaalin niin nopeasti kuin mahdollista. SÃ¤hkÃ¶posti osoitteen on oltava toimiva koska asetuksista riippuen saatat joutua aktivoimaan tilisi sÃ¤hkÃ¶postin vÃ¤lityksellÃ¤.<br />
<br />
HyvÃ¤ksymÃ¤llÃ¤ tÃ¤mÃ¤n sopimuksen sitoudut olemaan lÃ¤hettÃ¤mÃ¤ttÃ¤ laitonta, seksuaalista tai muuten sopimatonta materiaalia muuten {SITE_NAME} yllÃ¤pitÃ¤jÃ¤t ovat tapauksen sattuessa oikeutettu poistamaan kuvat sekÃ¤ tunnuksesi varoituksetta.<br />
<br />
Sivu kÃ¤yttÃ¤Ã¤ evÃ¤steitÃ¤ tallentamaa informaatiota. EvÃ¤steiden tarkoitus on ainoastaa helpottaa sivun kÃ¤yttÃ¶Ã¤. SÃ¤hkÃ¶posti osoitetta ei luovuteta ulkopuolisten tietoon tarkoituksellisesti.<br />
<br />
Klikkaamalla 'HyvÃ¤ksyn' hyvÃ¤ksyt nÃ¤mÃ¤ sÃ¤Ã¤nnÃ¶t.
EOT;

    $lang_register_php = array('page_title' => 'RekisterÃ¶inti',
        'term_cond' => 'KÃ¤yttÃ¶sopimus',
        'i_agree' => 'HyvÃ¤ksyn',
        'submit' => 'LÃ¤hetÃ¤ rekisterÃ¶inti',
        'err_user_exists' => 'Tunnus on jo kÃ¤ytÃ¶ssÃ¤, ole hyvÃ¤ ja valitse toinen',
        'err_password_mismatch' => 'Salasanat eivÃ¤t tÃ¤smÃ¤Ã¤',
        'err_uname_short' => 'Tunnuksen on oltava vÃ¤hintÃ¤Ã¤n 2 merkkiÃ¤ pitkÃ¤',
        'err_password_short' => 'Salasanan on oltava vÃ¤hintÃ¤Ã¤n 2 merkkiÃ¤ pitkÃ¤',
        'err_uname_pass_diff' => 'Tunnuksen ja salasanan on oltava eri',
        'err_invalid_email' => 'SÃ¤hkÃ¶posti osoite on virhellinen',
        'err_duplicate_email' => 'Joku on jo rekisterÃ¶itynyt samalla sÃ¤hkÃ¶posti osoitteella',
        'enter_info' => 'LisÃ¤Ã¤ rekisterÃ¶inti tiedot',
        'required_info' => 'Pakolliset tiedot',
        'optional_info' => 'Vapaaehtoiset tiedot',
        'username' => 'KÃ¤yttÃ¤jÃ¤nimi',
        'password' => 'Salasana',
        'password_again' => 'Salasana uudestaan',
        'email' => 'SÃ¤hkÃ¶posti',
        'location' => 'Sijainti',
        'interests' => 'Kiinnostukset',
        'website' => 'Kotisivu',
        'occupation' => 'Koulutus',
        'error' => 'VIRHE',
        'confirm_email_subject' => '%s - RekisterÃ¶inti tiedot',
        'information' => 'Info',
        'failed_sending_email' => 'RekisterÃ¶innin varmistavaa sÃ¤hkÃ¶postia ei voi lÃ¤hettÃ¤Ã¤!',
        'thank_you' => 'Kiitos rekisterÃ¶itymisestÃ¤.<br /><br />Tilisi tÃ¤ytyy vielÃ¤ aktivoida. Valitsemaasi sÃ¤hkÃ¶posti osoitteeseen on lÃ¤hetty ohjeet kÃ¤yttÃ¤jÃ¤tilisi aktivointiin.',
        'acct_created' => 'KÃ¤yttÃ¤jÃ¤tilisi on nyt luotu. Voit kirjautua sisÃ¤Ã¤n kÃ¤yttÃ¤mÃ¤llÃ¤ tunnustasi sekÃ¤ salasanaasi',
        'acct_active' => 'KÃ¤yttÃ¤jÃ¤tilisi on nyt aktivoitu. Voit kirjautua sisÃ¤Ã¤n kÃ¤yttÃ¤mÃ¤llÃ¤ tunnustasi sekÃ¤ salasanaasi',
        'acct_already_act' => 'Tilisi on jo aktiivinen !',
        'acct_act_failed' => 'TiliÃ¤si ei voi aktivoida !',
        'err_unk_user' => 'Valittua kÃ¤yttÃ¤jÃ¤Ã¤ ei lÃ¶ydy !',
        'x_s_profile' => '%s\' asetukset',
        'group' => 'RyhmÃ¤',
        'reg_date' => 'Liittynyt',
        'disk_usage' => 'Levyn kÃ¤yttÃ¶',
        'change_pass' => 'Vaihda salasana',
        'current_pass' => 'Nykyinen salasana',
        'new_pass' => 'uusi salasana',
        'new_pass_again' => 'Uusi salasana uudestaan',
        'err_curr_pass' => 'Nykyinen salasana vÃ¤Ã¤rin',
        'apply_modif' => 'HyvÃ¤ksy muutokset',
        'change_pass' => 'Vaihda salasana',
        'update_success' => 'Profiilisi pÃ¤ivitetty',
        'pass_chg_success' => 'Salasanasi vaihdettu',
        'pass_chg_error' => 'Salasanaasi ei vaihdettu',
        );

    $lang_register_confirm_email = <<<EOT
Kiitos rekisterÃ¶itymisestÃ¤ {SITE_NAME} sivulle.

Tunnus : "{USER_NAME}"
Salasana : "{PASSWORD}"

Sinun on aktivoitava tilisi, tarvitsee vain klikata alla olevaa linkkiÃ¤
tai leikkaa/liitÃ¤ (copy/paste) se www selaimeesi.

{ACT_LINK}

Terveisin,

Sivun {SITE_NAME} yllÃ¤pitÃ¤jÃ¤.

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'NÃ¤ytÃ¤ kommentit',
        'no_comment' => 'Ei kommentteja',
        'n_comm_del' => '%s kommentti poistettu',
        'n_comm_disp' => 'Kuinka monta kommenttia nÃ¤ytetÃ¤Ã¤n',
        'see_prev' => 'Edellinen',
        'see_next' => 'Seuraava',
        'del_comm' => 'Poista valitut kommentit',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Hae kuva',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Etsi uusia kuvia',
        'select_dir' => 'Valitse hakemisto',
        'select_dir_msg' => 'Voit lisÃ¤tÃ¤ FTP:llÃ¤ lisÃ¤tyt kuvat hakemistoihin<br /><br />Valitse hakemisto johon laitoit kuvat',
        'no_pic_to_add' => 'Ei lisÃ¤ttÃ¤viÃ¤ kuvia',
        'need_one_album' => 'Tarvitset vÃ¤hintÃ¤Ã¤n yhden albumin voidaksesi kÃ¤yttÃ¤Ã¤ toimintoa',
        'warning' => 'Varoitus',
        'change_perm' => 'scripti ei voi kirjoittaa tÃ¤hÃ¤n hakemistoon. Oikeuksien tÃ¤ytyy olla 755 tai 777 ennen kuin yritÃ¤t lisÃ¤tÃ¤ kuvia !',
        'target_album' => '<strong>Laita kuvat hakemistosta &quot;</strong>%s<strong>&quot;</strong>%s albumiin',
        'folder' => 'Hakemisto',
        'image' => 'Kuva',
        'album' => 'Albumi',
        'result' => 'Tulos',
        'dir_ro' => 'Ei kirjoitettavissa. ',
        'dir_cant_read' => 'Ei luettavissa. ',
        'insert' => 'LisÃ¤tÃ¤Ã¤n uusia kuvia galleriaan',
        'list_new_pic' => 'Lista uusista kuvista',
        'insert_selected' => 'LisÃ¤Ã¤ valitut kuvat',
        'no_pic_found' => 'Uusia kuvia ei lÃ¶ytynyt',
        'be_patient' => 'Odota hetki. Menee pikkuisen aikaa kuvien kÃ¤sittelyssÃ¤',
        'notes' => '<ul>' . '<li><strong>OK</strong> : tarkoittaa kuva lisÃ¤tty onnistuneesti' . '<li><strong>DP</strong> : tarkoittaa kuva on jo aiemmin lisÃ¤tty' . '<li><strong>PB</strong> : tarkoittaa kuvaa ei voitu lisÃ¤tÃ¤, tarkista asetukset ja oikeudet' . '<li>Jos OK, DP, PB \'merkit\' eivÃ¤t ilmesty klikkaa rikkinÃ¤istÃ¤ kuvaa nÃ¤hdÃ¤ksesi PHP: virheilmoituksen' . '<li>Jos selaimesi menee timeouttiin, lataa sivu uudestaan' . '</ul>',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //
if (defined('BANNING_PHP')) $lang_banning_php = array('title' => 'KiellÃ¤ KÃ¤ttÃ¤jiÃ¤',
        'user_name' => 'KÃ¤yttÃ¤jÃ¤nimi',
        'ip_address' => 'IP Osoite',
        'expiry' => 'PÃ¤Ã¤ttyy (tyhjÃ¤ jos pysyvÃ¤)',
        'edit_ban' => 'Tallenna Muutokset',
        'delete_ban' => 'Poista',
        'add_new' => 'LisÃ¤Ã¤ uusi esto',
        'add_ban' => 'LisÃ¤Ã¤',
        );
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'LisÃ¤Ã¤ kuva',
        'max_fsize' => 'Suurin sallittu tiedostokoko %s KB',
        'album' => 'Albumi',
        'picture' => 'Kuva',
        'pic_title' => 'Kuvan otsikko',
        'description' => 'Kuvan tarkenne',
        'keywords' => 'Hakusana (erota vÃ¤lilyÃ¶nnillÃ¤)',
        'err_no_alb_uploadables' => 'Ei albumeita joille oikeus lisÃ¤tÃ¤ kuvia',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Muokkaa kÃ¤yttÃ¤jiÃ¤',
        'name_a' => 'NimellÃ¤ nousevasti',
        'name_d' => 'NimellÃ¤ laskevasti',
        'group_a' => 'RyhmittÃ¤in nousevasti',
        'group_d' => 'RyhmittÃ¤in laskevasti',
        'reg_a' => 'RekisterÃ¶inti pÃ¤ivÃ¤llÃ¤ nousevasti',
        'reg_d' => 'RekisterÃ¶inti pÃ¤ivÃ¤llÃ¤ laskevasti',
        'pic_a' => 'Kuvien mÃ¤Ã¤rÃ¤llÃ¤ nousevasti',
        'pic_d' => 'Kuvien mÃ¤Ã¤rÃ¤llÃ¤ laskevasti',
        'disku_a' => 'Levyn kÃ¤yttÃ¶ nousevasti',
        'disku_d' => 'Levyn kÃ¤yttÃ¶ laskevasti',
        'sort_by' => 'JÃ¤rjestÃ¤ kÃ¤yttÃ¤jÃ¤t',
        'err_no_users' => 'KÃ¤yttÃ¤jÃ¤taulu on tyhjÃ¤ !',
        'err_edit_self' => 'Et voi muokata profiiliasi tÃ¤Ã¤ltÃ¤ \'Omat asetukset\' linkistÃ¤ pÃ¤Ã¤set tekemÃ¤Ã¤n sen',
        'edit' => 'MUOKKAA',
        'delete' => 'POISTA',
        'name' => 'Tunnus',
        'group' => 'RyhmÃ¤',
        'inactive' => 'Passiivinen',
        'operations' => 'Toiminto',
        'pictures' => 'Kuvat',
        'disk_space' => 'Tilaa kÃ¤ytetty / Maksimi',
        'registered_on' => 'RekisterÃ¶itynyt',
        'u_user_on_p_pages' => '%d kÃ¤yttÃ¤jÃ¤Ã¤ %d sivu(a)',
        'confirm_del' => 'Haluatko varmasti POISTAA tÃ¤mÃ¤n kÃ¤yttÃ¤jÃ¤n ? \\nKaikki albumit ja kuvat poistuvat myÃ¶s.',
        'mail' => 'POSTI',
        'err_unknown_user' => 'Valittua kÃ¤yttÃ¤jÃ¤Ã¤ ei lÃ¶ydy !',
        'modify_user' => 'Muokkaa kÃ¤yttÃ¤jÃ¤Ã¤',
        'notes' => 'Huomio',
        'note_list' => '<li>Jos et halua vaihtaa salasanaa, jÃ¤tÃ¤ "salasana" kenttÃ¤ tyhjÃ¤ksi',
        'password' => 'Salasana',
        'user_active' => 'KÃ¤yttÃ¤jÃ¤ aktiivinen',
        'user_group' => 'KÃ¤yttÃ¤jÃ¤n ryhmÃ¤',
        'user_email' => 'KÃ¤yttÃ¤jÃ¤n sÃ¤hkÃ¶posti',
        'user_web_site' => 'KÃ¤yttÃ¤jÃ¤n kotisivu',
        'create_new_user' => 'Luo uusi kÃ¤yttÃ¤jÃ¤',
        'user_location' => 'KÃ¤yttÃ¤jÃ¤n sijainti',
        'user_interests' => 'KÃ¤yttÃ¤jÃ¤n kiinnostukset',
        'user_occupation' => 'KÃ¤yttÃ¤jÃ¤n koulutus',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'PienennÃ¤ kuvia',
        'what_it_does' => 'Ominaisuudet',
        'what_update_titles' => 'PÃ¤ivittÃ¤Ã¤ otsikot tiedostonimiin',
        'what_delete_title' => 'Poistaa otsikot',
        'what_rebuild' => 'Tekee uudet thumbnailit ja pienentÃ¤Ã¤ kuvat',
        'what_delete_originals' => 'Poistaa alkuperÃ¤isen kokoiset kuvat ja korvaa ne pienennetyillÃ¤ versioilla',
        'file' => 'Tiedosto',
        'title_set_to' => 'otsikon asetti',
        'submit_form' => 'lÃ¤hetÃ¤',
        'updated_succesfully' => 'pÃ¤ivitetty onnistuneesti',
        'error_create' => 'VIRHE tapahtumassa',
        'continue' => 'KÃ¤sittele lisÃ¤Ã¤ kuvia',
        'main_success' => 'Tiedostoa %s on onnistuneesti kÃ¤ytetty pÃ¤Ã¤kuvana',
        'error_rename' => 'Virhe uudelleen nimeÃ¤misessÃ¤ %s ei voitu nimetÃ¤ %s',
        'error_not_found' => 'Tiedostoa %s ei lÃ¶ydy',
        'back' => 'takaisin',
        'thumbs_wait' => 'PÃ¤ivitÃ¤Ã¤ thumbnaileja ja/tai pienentÃ¤Ã¤ kuvia, odota hetki...',
        'thumbs_continue_wait' => 'Jatkaa thumbnailien pÃ¤ivittÃ¤mistÃ¤ ja/tai kuvien pienentÃ¤mistÃ¤...',
        'titles_wait' => 'PÃ¤ivittÃ¤Ã¤ otsikoita, odota hetki...',
        'delete_wait' => 'Poistaa otsikoita, odota hetki...',
        'replace_wait' => 'Poistaa alkuperÃ¤isia kuvia ja korvaa ne pienennetyillÃ¤, odota hetki..',
        'instruction' => 'Pikaohje',
        'instruction_action' => 'Valitse toiminto',
        'instruction_parameter' => 'Aseta arvot',
        'instruction_album' => 'Valitse albumi',
        'instruction_press' => 'Paina %s',
        'update' => 'PÃ¤ivitÃ¤ thumbnailit ja/tai pienennÃ¤ kuvat',
        'update_what' => 'MitÃ¤ pÃ¤ivitetÃ¤Ã¤n',
        'update_thumb' => 'Ainoastaan thumbnailit',
        'update_pic' => 'PienennetÃ¤Ã¤n pelkÃ¤t kuvat',
        'update_both' => 'PienennetÃ¤Ã¤n kuvat ja pÃ¤ivitetÃ¤Ã¤n thumbnailit',
        'update_number' => 'Kuinka monta kuvaa kÃ¤sitellÃ¤Ã¤n joka klikkauksella',
        'update_option' => '(Kokeile sÃ¤Ã¤tÃ¤Ã¤ toimintoa pienemmÃ¤lle jos tulee timeout ongelmia)',
        'filename_title' => 'Tiedostonimi ? Kuvan otsikko',
        'filename_how' => 'Kuinka tiedostonimet muokatann',
        'filename_remove' => 'Poista .jpg pÃ¤Ã¤te ja korvaa vÃ¤lit _ (alleviivaus)',
        'filename_euro' => 'Muuta 2003_11_23_13_20_20.jpg tÃ¤mmÃ¶iseksi 23/11/2003 13:20',
        'filename_us' => 'Muuta 2003_11_23_13_20_20.jpg tÃ¤mmÃ¶iseksi 11/23/2003 13:20',
        'filename_time' => 'Muuta 2003_11_23_13_20_20.jpg tÃ¤mmÃ¶iseksi 13:20',
        'delete' => 'Poista otsikot tai alkuperÃ¤isen kokoiset kuvat',
        'delete_title' => 'Poista kuvien otsikot',
        'delete_original' => 'Poista alkuperÃ¤isen kokoiset kuvat',
        'delete_replace' => 'Poistaa alkuperÃ¤iset kuvat ja korvaa ne pienennetyillÃ¤ versioilla',
        'select_album' => 'Valitse albumi',
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