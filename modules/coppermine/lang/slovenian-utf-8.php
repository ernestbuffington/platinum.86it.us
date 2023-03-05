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
define('PIC_VIEWS', 'Å t. ogledov');
define('PIC_VOTES', 'Å¡t. ocen');
define('PIC_COMMENTS', 'Å t. komentarjev');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Slovenian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'SlovenÅ¡Ã¨ina', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'si', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 's55hh', // the name of the translator - can be a nickname
    'trans_email' => 's55hh.jani@siol.net', // translator's email address (optional)
    'trans_website' => 'http://slovhf.net/', // translator's website (optional)
    'trans_date' => '2003-10-11', // the date the translation was created / last modified
    );

$lang_charset = 'UTF-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bitov', 'kB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'To', 'Sr', 'Ãˆe', 'Pe', 'So');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Da';
$lang_no = 'Ne';
$lang_back = 'NAZAJ';
$lang_continue = 'NAPREJ';
$lang_info = 'Informacija';
$lang_error = 'Napaka';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d.%m.%Y';
$lastcom_date_fmt = '%d.%m.%Y ob %H:%M';
$lastup_date_fmt = '%d.%m.%Y';
$register_date_fmt = '%d.%m.%Y';
$lasthit_date_fmt = '%d.%m.%Y ob %I:%M %p';
$comment_date_fmt = '%d.%m.%Y ob %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'NakljuÃ¨ne slike',
    'lastup' => 'Zadnje dodane slike',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Zadnji dodani albumi',

    'lastcom' => 'Zadnji komentarji',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'NajveÃ¨ ogledov',
    'toprated' => 'Naj ocene',
    'lasthits' => 'Zadnji ogledi',
    'search' => 'Rezultati iskanja',

    'favpics' => 'Priljubljene slike'

    );

$lang_errors = array('access_denied' => 'NimaÅ¡ pravic za dostop do te strani.',
    'perm_denied' => 'NimaÅ¡ pravic za izvedbo tega ukaza.',
    'param_missing' => 'Manjkajo podatki za izvedbo...',
    'non_exist_ap' => 'Izbrani album/slika ne obstaja!',
    'quota_exceeded' => 'Disk je poln<br /><br />Na razpolago imaÅ¡ [quota]K, tvoje slike pa trenutno zasedajo [space]K, Ã¨e bi dodal pa Å¡e to sliko, bi prekoraÃ¨il prostor na disku.',
    'gd_file_type_err' => 'Pri uporabi GD knjiÅ¾nice lahko uporabiÅ¡ samo JPEG in PNG slike.',
    'invalid_image' => 'Poslana slika je poÅ¡kodovana ali pa ni v pravilnem formatu za GD knjiÅ¾nico.',
    'resize_failed' => 'Ne morem narediti ikone ali pomanjÅ¡ane slike.',
    'no_img_to_display' => 'Trenutno Å¡e brez slik',
    'non_exist_cat' => 'Izbrana kategorija ne obstaja',
    'orphan_cat' => 'Kategorija ima doloÃ¨eno neobstojeÃ¨o nadrejeno kategorijo. Popravi napako v nastavitvah.',
    'directory_ro' => 'Direktorij \'%s\' ne dopuÅ¡Ã¨a pisanja, slik ni moÅ¾no pobrisati',
    'non_exist_comment' => 'Izbrani komentar ne obstaja.',
    'pic_in_invalid_album' => 'Slika je v neobstojeÃ¨em albumu (%s)!?',

    'banned' => 'Trenutno imaÅ¡ prepoved dostopa do teh strani.',

    'not_with_udb' => 'Ta ukaz je onemogoÃ¨en, ker je premaknjen v forum. Ali to kar Å¾eliÅ¡ narediti ni omogoÃ¨eno v nastavitvah ali pa je predvideno za izvedbo v forumu.',

    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'

    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Pojdi na seznam albumov',
    'alb_list_lnk' => 'Seznam albumov',
    'my_gal_title' => 'Pojdi v mojo osebno galerijo',
    'my_gal_lnk' => 'Moja galerija',
    'my_prof_lnk' => 'Moj profil',
    'adm_mode_title' => 'Preklop v administracijo',
    'adm_mode_lnk' => 'Administracija',
    'usr_mode_title' => 'Preklop v uporabniÅ¡ki naÃ¨in',
    'usr_mode_lnk' => 'UporabniÅ¡ki naÃ¨in',
    'upload_pic_title' => 'NaloÅ¾i sliko v album',
    'upload_pic_lnk' => 'Nalaganje slik',
    'register_title' => 'Ustvari raÃ¨un',
    'register_lnk' => 'Registracija',
    'login_lnk' => 'Prijava',
    'logout_lnk' => 'Odjava',
    'lastup_lnk' => 'Zadnje dodane slike',
    'lastcom_lnk' => 'Zadnji komentarji',
    'topn_lnk' => 'NajveÃ¨ ogledov',
    'toprated_lnk' => 'Najbolj ocenjeno',
    'search_lnk' => 'Iskanje',
    'fav_lnk' => 'Moji favoriti',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Odobri slike',
    'config_lnk' => 'Nastavitve',
    'albums_lnk' => 'Albumi',
    'categories_lnk' => 'Kategorije',
    'users_lnk' => 'Uporabniki',
    'groups_lnk' => 'Skupine',
    'comments_lnk' => 'Komentarji',
    'searchnew_lnk' => 'Najdi nove slike',
    'util_lnk' => 'Spremeni velikost slike',

    'ban_lnk' => 'Zavrni uporabnika',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Ustvari/naroÃ¨i svoj album',
    'modifyalb_lnk' => 'Spremeni svoj album',
    'my_prof_lnk' => 'Moj profil',
    );

$lang_cat_list = array('category' => 'Kategorija',
    'albums' => 'Albumi',
    'pictures' => 'Slike',
    );

$lang_album_list = array('album_on_page' => 'Å t. albumov:%d (Å¡t. strani:%d)'
    );

$lang_thumb_view = array('date' => 'Datum', 
    // Sort by filename and title
    'name' => 'Datoteka',

    'title' => 'Naziv',

    'sort_da' => 'Sortiraj po datumu naraÅ¡Ã¨ujoÃ¨e',
    'sort_dd' => 'Sortiraj po datumu padajoÃ¨e',
    'sort_na' => 'Sortiraj po imenu datoteke naraÅ¡Ã¨ujoÃ¨e',
    'sort_nd' => 'Sortiraj po imenu datoteke padajoÃ¨e',
    'sort_ta' => 'Sortiraj po nazivu naraÅ¡Ã¨ujoÃ¨e',

    'sort_td' => 'Sortiraj po nazivu padajoÃ¨e',

    'pic_on_page' => 'Å t. slik:%d (Å¡t. strani:%d)',
    'user_on_page' => 'Å t. uporabnikov:%d (Å¡t. strani:%d)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Nazaj na stran z ikonami',
    'pic_info_title' => 'PrikaÅ¾i/skrij informacije o sliki',
    'slideshow_title' => 'Samodejno predvajaj slike',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'PoÅ¡lji sliko kot e-razglednico',
    'ecard_disabled' => 'PoÅ¡iljanje e-razglednic ni dovoljeno',
    'ecard_disabled_msg' => 'NimaÅ¡ pravic za poÅ¡iljanje e-razglednic',
    'prev_title' => 'Poglej predhodno sliko',
    'next_title' => 'Poglej naslednjo sliko',
    'pic_pos' => 'Slika %s od %s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Oceni to sliko ',
    'no_votes' => '(Brez ocen do sedaj)',
    'rating' => '(trenutna ocena: %s (najveÃ¨ 5; Å¡t. glasov:%s)',
    'rubbish' => 'ZaniÃ¨',
    'poor' => 'Slabo',
    'fair' => 'Tako tako',
    'good' => 'Dobro',
    'excellent' => 'OdliÃ¨no',
    'great' => 'Super',
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
    CRITICAL_ERROR => 'KritiÃ¨na napaka',
    'file' => 'Datoteka: ',
    'line' => 'Vrstica: ',
    );

$lang_display_thumbnails = array('filename' => 'Ime datoteke: ',
    'filesize' => 'Velikost datoteke: ',
    'dimensions' => 'Dimenzija: ',
    'date_added' => 'Datum objave: '
    );

$lang_get_pic_data = array('n_comments' => 'Å t. komentarjev:%s',
    'n_views' => 'Å t. ogledov:%s',
    'n_votes' => '(Å¡t. ocen:%s)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Vzklik',
        'Question' => 'VpraÅ¡anje',
        'Very Happy' => 'Zelo sreÃ¨en',
        'Smile' => 'SmeÅ¡ko',
        'Sad' => 'Å½alosten',
        'Surprised' => 'PreseneÃ¨en',
        'Shocked' => 'V Å¡oku',
        'Confused' => 'Zmeden',
        'Cool' => 'Hladen',
        'Laughing' => 'Nasmejan',
        'Mad' => 'Nor',
        'Razz' => 'Nagajiv',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => 'JokajoÃ¨ ali Å¾alosten',
        'Evil or Very Mad' => 'VraÅ¾ji ali zloben',
        'Twisted Evil' => 'Slepar',
        'Rolling Eyes' => 'KotaleÃ¨e oÃ¨i',
        'Wink' => 'MeÅ¾ikanje',
        'Idea' => 'Ideja',
        'Arrow' => 'PuÅ¡Ã¨ica',
        'Neutral' => 'Nevtralen',
        'Mr. Green' => 'Gospod zelenko',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'ZapuÅ¡Ã¨am administracijo...',
        1 => 'Vstop v administracijo...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Album mora imeti ime!',
        'confirm_modifs' => 'Res Å¾eliÅ¡ izvesti te spremembe?',
        'no_change' => 'Nobenih sprememb nisi naredil!',
        'new_album' => 'Novi album',
        'confirm_delete1' => 'Res Å¾eliÅ¡ pobrisati ta album?',
        'confirm_delete2' => '\nVse slike in vsi komentarji bodo prav tako pobrisani!',
        'select_first' => 'Najprej izberi album',
        'alb_mrg' => 'Urejanje albumov',
        'my_gallery' => '* Moja galerija *',
        'no_category' => '* Brez kategorij *',
        'delete' => 'Brisanje',
        'new' => 'Novo',
        'apply_modifs' => 'Izvedi spremembe',
        'select_category' => 'Izberi kategorijo',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parameter potreben za \'%s\'operacijo ni vpisan!',
        'unknown_cat' => 'Izbrana kategorija ne obstaja v bazi',
        'usergal_cat_ro' => 'Brisanje kategorije od uporabniÅ¡kih galerij ni moÅ¾no!',
        'manage_cat' => 'Urejanje kategorij',
        'confirm_delete' => 'Res Å¾eliÅ¡ pobrisati to kategorijo',
        'category' => 'Kategorija',
        'operations' => 'Operacija',
        'move_into' => 'Premakni v',
        'update_create' => 'Posodobi/ustvari kategorijo',
        'parent_cat' => 'Nadrejena kategorija',
        'cat_title' => 'Ime kategorije',
        'cat_desc' => 'Opis kategorije'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Nastavitve',
        'restore_cfg' => 'Povrni osnovne nastavitve',
        'save_cfg' => 'Shrani nove nastavitve',
        'notes' => 'Opombe',
        'info' => 'Informacija',
        'upd_success' => 'Nastavitve galerije so bile uspeÅ¡no posodobljene',
        'restore_success' => 'Povrnjene so bile osnovne nastavitve galerije',
        'name_a' => 'Naziv naraÅ¡Ã¨ujoÃ¨e',
        'name_d' => 'Naziv padajoÃ¨e',
        'title_a' => 'Naslov naraÅ¡Ã¨ujoÃ¨e',

        'title_d' => 'Naslov padajoÃ¨e',

        'date_a' => 'Datum naraÅ¡Ã¨ujoÃ¨e',
        'date_d' => 'Datum padajoÃ¨e',
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
        'Osnovne nastavitve',
array(
'Ime galerije', 'gallery_name', 0),
array(
'Opis galerije', 'gallery_description', 0),
array(
'Administratorjev e-mail', 'gallery_admin_email', 0),
array(
'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0),
array(
'Jezik', 'lang', 5),
// for postnuke change
array(
'Tema', 'cpgtheme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Seznam albumov',
array(
'Å irina glavne tabele (pixli ali %)', 'main_table_width', 0),
array(
'Å tevilo nivojev za prikaz kategorij', 'subcat_level', 0),
array(
'Å tevilo albumov na strani', 'albums_per_page', 0),
array(
'Å tevilo kolon za prikaz albumov', 'album_list_cols', 0),
array(
'Velikost ikon v pixlih', 'alb_list_thumb_size', 0),
array(
'Vsebina na glavni strani', 'main_page_layout', 0),
array(
'Prikaz ikon albumov za prvi nivo kategorij', 'first_level', 1), 
        // 'Thumbnail view',
        'Prikaz ikon',
array(
'Å tevilo kolon na strani z ikonami', 'thumbcols', 0),
array(
'Å tevilo vrstic na strani z ikonami', 'thumbrows', 0),
array(
'Max. Å¡t. tabulatorjev', 'max_tabs', 0),
array(
'PrikaÅ¾i opis slike (zraven imena) pod ikono', 'caption_in_thumbview', 1),
array(
'PrikaÅ¾i Å¡tevilo komentarjev pod ikono', 'display_comment_count', 1),
array(
'Privzeto sortiranje slik', 'default_sort_order', 3),
array(
'Minimalno Å¡tevilo ocen za sliko, da se uvrsti na seznam  \'naj-ocene\'', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Prikaz slik &amp; nastavitve za komentarje',
array(
'Å irina tabele za prikaz slik (pixli ali %)', 'picture_table_width', 0),
array(
'Informacija o sliki je privzeto vidna', 'display_pic_info', 1),
array(
'IzloÃ¨i grde besede v komentarjih', 'filter_bad_words', 1),
array(
'Dovoli smeÅ¡kote v komentarjih', 'enable_smilies', 1),
array(
'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
array(
'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
array(
'Max. velikost za opis slike', 'max_img_desc_length', 0),
array(
'Max. Å¡tevilo zankov v besedi', 'max_com_wlength', 0),
array(
'Max. Å¡tevilo vrstic komentarja', 'max_com_lines', 0),
array(
'Max. velikost komentarja', 'max_com_size', 0),
array(
'PrikaÅ¾i filmski trak z ikonami', 'display_film_strip', 1),
array(
'Å t. ikon na traku', 'max_film_strip_items', 0),
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Nastavitve slik in ikon',
array(
'Kvaliteta za JPEG datoteke', 'jpeg_qual', 0),
array(
'Max. velikost za ikone <strong>*</strong>', 'thumb_width', 0),
array(
'Velikost uporabi za Å¡irino ali viÅ¡ino ali razmerje ikone <strong>*</strong>', 'thumb_use', 7),
array(
'Ustvari vmesne slike', 'make_intermediate', 1),
array(
'Max. Å¡irina ali viÅ¡ina vmesnih slik <strong>*</strong>', 'picture_width', 0),
array(
'Max. velikost datotek/slik (kB)', 'max_upl_size', 0),
array(
'Max. Å¡irina ali viÅ¡ina dodanih slik (pixli)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Nastavitve uporabnikov',
array(
'Dovoli registriranje novih uporabnikov', 'allow_user_registration', 1),
array(
'Registracija zahteva preverjanje e-mail naslova', 'reg_requires_valid_email', 1),
array(
'Dva uporabnika lahko imata enak e-mail naslov', 'allow_duplicate_emails_addr', 1),
array(
'Uporabnik ima lahko privatni album', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Dodatna polja za vpis informacij o sliki (pusti prazno, Ã¨e ne uporabljaÅ¡)',
array(
'Polje 1', 'user_field1_name', 0),
array(
'Polje 2', 'user_field2_name', 0),
array(
'Polje 3', 'user_field3_name', 0),
array(
'Polje 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Dodatne nastavitve za slike in ikone',
array(
'PrikaÅ¾i ikone privatnih albumov neprijavljenim uporabnikom', 'show_private', 1),
array(
'Prepovedani znaki v imenih datotek', 'forbiden_fname_char', 0),
array(
'Dovoljene vrste datotek za dodajanje slik', 'allowed_file_extensions', 0),
array(
'NaÃ¨in kreiranja ikon', 'thumb_method', 2),
array(
'Pot do ImageMagick programa (npr. /usr/bin/X11/)', 'impath', 0),
array(
'Dovoljene vrste datotek (samo za ImageMagick)', 'allowed_img_types', 0),
array(
'Opcija za ukazno vrstico od ImageMagick', 'im_options', 0),
array(
'PrikaÅ¾i EXIF podatke v JPEG datotekah', 'read_exif_data', 1),
array(
'Prikaži IPTC podatke v JPEG datotekah', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'Direktorij za albume <strong>*</strong>', 'fullpath', 0),
array(
'Direktorij za slike od uporabnikov <strong>*</strong>', 'userpics', 0),
array(
'Predpona za vmesne slike <strong>*</strong>', 'normal_pfx', 0),
array(
'Predpona za ikone <strong>*</strong>', 'thumb_pfx', 0),
array(
'Privzete pravice za direktorije', 'default_dir_mode', 0),
array(
'Privzete pravice za slike', 'default_file_mode', 0),
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
        'PiÅ¡kotki in kodne tabele',
array(
'Ime za piÅ¡kotke, ki jih uporablja galerija', 'cookie_name', 0),
array(
'Pot do piÅ¡kotkov', 'cookie_path', 0),
array(
'Kodiranje strani', 'charset', 4), 
        // 'Miscellaneous settings',
        'Ostale nastavitve',
array(
'VkljuÃ¨i naÃ¨in za odkrivanje napak', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Polja oznaÃ¨ena z * se ne smejo spreminjati, Ã¨e so v galeriji Å¾e slike</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Vpisati moraÅ¡ svoje ime in komentar',
        'com_added' => 'Tvoj komentar je bil dodan',
        'alb_need_title' => 'Vpisati moraš ime albuma!',
        'no_udp_needed' => 'Posodobitve niso potrebne.',
        'alb_updated' => 'Album je bil posodobljen',
        'unknown_album' => 'Izbrani album ne obstaja ali pa nimaÅ¡ pravic za dodajanje slik v njega',
        'no_pic_uploaded' => 'Nobena slika ni bila dodana!<br /><br />Ãˆe si resniÃ¨no poslal sliko, preveri ali je to sploh dovoljeno...',
        'err_mkdir' => 'Kreiranje direktorija %s ni bilo uspeÅ¡no!',
        'dest_dir_ro' => 'Å½eljeni direktorij %s ne omogoÃ¨a pisanja - pravice!',
        'err_move' => 'NemogoÃ¨e je premakniti %s v %s !',
        'err_fsize_too_large' => 'Dimenzije slike so prevelike (dovoljeno je %s x %s) !',
        'err_imgsize_too_large' => 'Velikost datoteke presega limit (dovoljeno je %s kB) !',
        'err_invalid_img' => 'Poslana slika ni v pravilnem formatu!',
        'allowed_img_types' => 'DodaÅ¡ lahko samo %s slike.',
        'err_insert_pic' => 'Slike \'%s\' se ne da dodati v album ',
        'upload_success' => 'Tvoja slika je bila dodana.<br /><br />Vidna bo takoj po administratorjevi odobritvi.',
        'info' => 'Informacija',
        'com_added' => 'Komentar dodan',
        'alb_updated' => 'Album posodobljen',
        'err_comment_empty' => 'Komentar je prazen!',
        'err_invalid_fext' => 'Veljavne so samo datoteke z naslednjimi konÃ¨nicami: <br /><br />%s.',
        'no_flood' => 'Oprosti, ampak si Å¾e avtor zadnjega komentarja za to sliko<br /><br />Izberi urejanje,Ã¨e ga Å¾eliÅ¡ spremeniti',
        'redirect_msg' => 'Prestavljen boÅ¡ na novo stran.<br /><br /><br />Klikni \'NAPREJ\', Ã¨e se stran samodejno ne zamenja',
        'upl_success' => 'Tvoje slike so bile uspeÅ¡no dodane',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Naslov',
        'fs_pic' => 'velika slika',
        'del_success' => 'uspeÅ¡no pobrisano',
        'ns_pic' => 'normalna velikost slike',
        'err_del' => 'brisanje ni moÅ¾no',
        'thumb_pic' => 'ikona',
        'comment' => 'komentar',
        'im_in_alb' => 'slika v albumu',
        'alb_del_success' => 'Album \'%s\' pobrisan',
        'alb_mgr' => 'Urejanje albumov',
        'err_invalid_data' => 'NapaÃ¨ni podatki v \'%s\'',
        'create_alb' => 'Kreiram album \'%s\'',
        'update_alb' => 'Posodabljam album \'%s\' z naslovom \'%s\' in indeksom \'%s\'',
        'del_pic' => 'PobriÅ¡i sliko',
        'del_alb' => 'PobriÅ¡i album',
        'del_user' => 'PobriÅ¡i uporabnika',
        'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
        'comment_deleted' => 'Komentar uspeÅ¡no pobrisan',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Res Å¾eliÅ¡ pobrisati to sliko? \\nTudi komentarji od nje bodo pobrisani.',
        'del_pic' => 'POBRIÅ I TO SLIKO',
        'size' => '%s x %s pixlov',
        'views' => '%s krat',
        'slideshow' => 'Samodejno predvajanje',
        'stop_slideshow' => 'Ustavi predvajanje',
        'view_fs' => 'Klikni za ogled veÃ¨je slike',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informacija o sliki',
        'Filename' => 'Ime datoteke',
        'Album name' => 'Ime albuma',
        'Rating' => 'Ocena (Å¡t. glasov:%s)',
        'Keywords' => 'KljuÃ¨ne besede',
        'File Size' => 'Velikost datoteke',
        'Dimensions' => 'Velikost slike',
        'Displayed' => 'Å t. ogledov',
        'Camera' => 'Kamera',
        'Date taken' => 'Datum posnetka',
        'Aperture' => 'Zaslonka',
        'Exposure time' => 'Ãˆas',
        'Focal length' => 'GoriÅ¡Ã¨na razdalja',
        'Comment' => 'Komentar',
        'addFav' => 'Dodaj med priljubljene',

        'addFavPhrase' => 'Priljubljene',

        'remFav' => 'Odstrani iz priljubljenih',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Uredi komentar',
        'confirm_delete' => 'Res Å¾eliÅ¡ pobrisati komentar?',
        'add_your_comment' => 'Dodaj komentar',
        'name' => 'Ime',

        'comment' => 'Komentar',

        'your_name' => 'AnonimneÅ¾',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Klikni sliko, da zapreÅ¡ to okno',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'PoÅ¡lji e-razglednico',
        'invalid_email' => '<strong>Opozorilo</strong>: napaÃ¨ni e-mail naslov!',
        'ecard_title' => 'To je e-razglednica od %s za tebe',
        'view_ecard' => 'Ãˆe razglednice ne vidiÅ¡ pravilno, klikni na to povezavo',
        'view_more_pics' => 'Klikni tukaj za ogled veÃ¨ih slik!',
        'send_success' => 'Razglednica je bila poslana',
        'send_failed' => 'Oprosti, ampak serven ne omogoÃ¨a poÅ¡iljanja razglednic...',
        'from' => 'Od',
        'your_name' => 'Tvoje ime',
        'your_email' => 'Tvoj e.mail naslov',
        'to' => 'Za',
        'rcpt_name' => 'Naslovnikovo ime',
        'rcpt_email' => 'Naslovnikov e-mail naslov',
        'greetings' => 'Pozdrav',
        'message' => 'SporoÃ¨ilo',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Informacija o sliki',
        'album' => 'Album',
        'title' => 'Naziv',
        'desc' => 'Opis',
        'keywords' => 'KljuÃ¨ne besede',
        'pic_info_str' => '%sx%s - %skB - %s ogledov - %s ocen',
        'approve' => 'Odobri sliko',
        'postpone_app' => 'PreloÅ¾i odobritev',
        'del_pic' => 'PobriÅ¡i sliko',
        'reset_view_count' => 'Resetiraj Å¡tevec ogledov',
        'reset_votes' => 'Resetiraj ocene',
        'del_comm' => 'PobriÅ¡i komentarje',
        'upl_approval' => 'Dodaj odobritev',
        'edit_pics' => 'Uredi sliko',
        'see_next' => 'Naslednja slika',
        'see_prev' => 'predhodna slika',
        'n_pic' => '%s slik',
        'n_of_pic_to_disp' => 'Å tevilo slik za prikaz',
        'apply' => 'Izvedi spremembe'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Ime skupine',
        'disk_quota' => 'Velikost diska',
        'can_rate' => 'Lahko ocenjuje slike',
        'can_send_ecards' => 'Lahko poÅ¡ilja razglednice',
        'can_post_com' => 'Lahko dodaja komentarje',
        'can_upload' => 'Lahko dodaja slike',
        'can_have_gallery' => 'Lahko ima osebno galerijo',
        'apply' => 'Izvedi spremembe',
        'create_new_group' => 'Ustvari novo skupino',
        'del_groups' => 'PobriÅ¡i izbrano skupino',
        'confirm_del' => 'Opozorilo: pri brisanju skupine se vsi Ã¨lani prmaknejo v skupino z imenom \'Registered\'!\n\nÅ½eliÅ¡ nadaljevati?',
        'title' => 'Urejanje uporabniÅ¡kih skupin',
        'approval_1' => 'Javne odobritve slik (1)',
        'approval_2' => 'Privatne odobritve slik (2)',
        'note1' => '<strong>(1)</strong> Slike v javnih albumih potrebujejo odobritev za prikaz',
        'note2' => '<strong>(2)</strong> Slike v privatnih albumih potrebujejo odobritev za prikaz',
        'notes' => 'Notes'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'DobrodoÅ¡el!'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Res Å¾eliÅ¡ pobrisati ta album? \\nVse slike in komentarji bodo pobriani.',
        'delete' => 'BRISANJE',
        'modify' => 'LASTNOSTI',
        'edit_pics' => 'UREJANJE',
        );

    $lang_list_categories = array('home' => 'Domov',
        'stat1' => 'Å t. slik:<strong>[pictures]</strong> - Å¡t. albumov:<strong>[albums]</strong> - Å¡t. kategorij:<strong>[cat]</strong>  - Å¡t. komentarjev:<strong>[comments]</strong> - Å¡t. ogledov:<strong>[views]</strong>',
        'stat2' => 'Å t. slik:<strong>[pictures]</strong> - Å¡t. albumov:<strong>[albums]</strong> - Å¡t. ogledov<strong>[views]</strong>',
        'xx_s_gallery' => 'Galerija od %s',
        'stat3' => 'Å t. slik:<strong>[pictures]</strong> - Å¡t. albumov:<strong>[albums]</strong> - Å¡t. komentarjev:<strong>[comments]</strong>  - Å¡t. ogledov:<strong>[views]</strong>'
        );

    $lang_list_users = array('user_list' => 'Seznam uporabnikov',
        'no_user_gal' => 'Brez uporabniÅ¡kih galerij',
        'n_albums' => 'Å t. albumov:%s',
        'n_pics' => 'Å t. slik:%s'
        );

    $lang_list_albums = array('n_pictures' => 'Å t. slik:%s',
        'last_added' => ', zadnja dodana %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Posodobi album %s',
        'general_settings' => 'SploÅ¡ne nastavitve',
        'alb_title' => 'Ime albuma',
        'alb_cat' => 'Kategorija od albuma',
        'alb_desc' => 'Opis albuma',
        'alb_thumb' => 'Ikona albuma',
        'alb_perm' => 'Pravice za ta album',
        'can_view' => 'Album lahko vidijo',
        'can_upload' => 'Obiskovalci lahko dodajajo slike',
        'can_post_comments' => 'Obiskovalci lahko dodajajo komentarje',
        'can_rate' => 'Obiskovalci lahko ocenjujejo slike',
        'user_gal' => 'UporabniÅ¡ka galerija',
        'no_cat' => '* Brez kategorije *',
        'alb_empty' => 'Album je prazen',
        'last_uploaded' => 'Zadnje dodano...',
        'public_alb' => 'Vsi (javni album)',
        'me_only' => 'Samo jaz',
        'owner_only' => 'Lastnik albuma (%s)',
        'groupp_only' => 'Ãˆlani skupine \'%s\'',
        'err_no_alb_to_modify' => 'Brez albuma - spremembe moÅ¾ne samo v bazi.',
        'update' => 'Posodobi album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Oprosti, ampak to sliko si Å¾e ocenil',
        'rate_ok' => 'Tvoja ocena je bila zabeleÅ¾ena',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Ãˆeprav bo administrator {SITE_NAME} poskuÅ¡al odstraniti vsako neprimerno vsebino objavljeno v galeriji, je nemogoÃ¨e hkrati in pravoÃ¨asno pregledati vse kar je objavljeno s strani obiskovalcev. Zavedati se morate, da vse objavljeno na teh straneh predstavlja pogled in mnenje avtorja in ne administratorja oz. vzdrÅ¾evalca teh spletnih strani (razen tistega kar je objavljeno z njune strani).<br />
<br />
S sodelovanjem na teh spletnih straneh se tudi strinjate, da ne boste objavljali nobenih obscenih, vulgarnih, Å¾aljivih, seksualnih, sovraÅ¾nih, rasno nestrpnih in ostalih vsebin, ki so v nasprotju z veljavno zakonodajo. Strinjate se tudi, da ima aministrator in/ali moderator doloÃ¨enih vsebin na {SITE_NAME} pravico v katerem koli trenutku pravico odstraniti po njegovem mnenju sporni objavljeni prispevek. Kot uporabnik se strinjate, da je z vaÅ¡e strani objavljeno gradivo shranjeno v bazi. Ãˆeprav ti podatki ne bodo posredovani nobeni tretji stranki, administrator oziroma skrbnik teh strani ne odgovarja za izgubljene podatke v primeru hekerskega poskusa kraje podatkov.<br />
<br />
Te spletne strani uporabljajo piÅ¡kotke (cookies) za shranjevanje informacij na vaÅ¡em raÃ¨unalniku. Ti podatki so namenjeni iskljuÃ¨no temu, da vam olajÅ¡ajo brskanje na teh straneh. VaÅ¡ email naslov pa je uporabljen samo za to, da vam lahko posredujemo geslo za prijavo.<br />
<br />
S klikom na 'STRINJAM SE' potrjujete, da ste seznanjeni s pogoji sodelovanje na straneh {SITE_NAME}.
EOT;

    $lang_register_php = array('page_title' => 'Registracija',
        'term_cond' => 'Navodila in pogoji za sodelovanje',
        'i_agree' => 'STRINJAM SE',
        'submit' => 'PoÅ¡lji registracijo',
        'err_user_exists' => 'To uporabniÅ¡ko ime Å¾e obstaja, izberi si drugo',
        'err_password_mismatch' => 'Gesli se ne ujemata - ponovi vpis',
        'err_uname_short' => 'UporabniÅ¡ko ime mora imeti vsaj dva znaka',
        'err_password_short' => 'Geslo mora biti dolgo vsaj dva znaka',
        'err_uname_pass_diff' => 'UporabniÅ¡ko ime in geslo morata biti razliÃ¨na',
        'err_invalid_email' => 'NapaÃ¨ni e-mail naslov!',
        'err_duplicate_email' => 'Ta e-mail naslov je nekdo Å¾e uporabil',
        'enter_info' => 'Vpis podatkov za registracijo',
        'required_info' => 'Obvezni podatki',
        'optional_info' => 'Neobvezni vpis',
        'username' => 'UporabniÅ¡ko ime',
        'password' => 'Geslo',
        'password_again' => 'Ponovi geslo',
        'email' => 'e-mail',
        'location' => 'Kraj',
        'interests' => 'Zanimanje',
        'website' => 'DomaÃ¨a stran',
        'occupation' => 'Zaposlitev',
        'error' => 'NAPAKA',
        'confirm_email_subject' => '%s - registracija potrjena',
        'information' => 'Informacija',
        'failed_sending_email' => 'Ne morem poslati e-mail sporoÃ¨ila s podatki o registraciji!',
        'thank_you' => 'Hvala za registracijo.<br /><br />Navodila za aktiviranje raÃ¨una so bila poslana na vpisani e-mail naslov.',
        'acct_created' => 'Tvoj raÃ¨un je bil ustvarjen - lahko se prijaviÅ¡ s svojim uporabniÅ¡kim imenom in geslom',
        'acct_active' => 'Tvoj raÃ¨un je aktiven in se lahko prijaviÅ¡',
        'acct_already_act' => 'Tvoj raÃ¨un je Å¾e aktiven!',
        'acct_act_failed' => 'Tega raÃ¨una ni moÅ¾no aktivirati!',
        'err_unk_user' => 'Izbrani uporabnik ne obstaja!',
        'x_s_profile' => 'Profil od %s',
        'group' => 'Skupina',
        'reg_date' => 'Datum pristopa',
        'disk_usage' => 'Velikost diska',
        'change_pass' => 'Spremeni geslo',
        'current_pass' => 'Staro geslo',
        'new_pass' => 'Novo geslo',
        'new_pass_again' => 'Novo geslo ponovno',
        'err_curr_pass' => 'Staro geslo ni pravilno',
        'apply_modif' => 'Izvedi spremembe',
        'change_pass' => 'Spremeni moje geslo',
        'update_success' => 'Profil je bil posodobljen',
        'pass_chg_success' => 'Geslo je bilo spremenjeno',
        'pass_chg_error' => 'Geslo ni bilo spremenjeno',
        );

    $lang_register_confirm_email = <<<EOT
Hvala za registracijo pri: {SITE_NAME}

Tvoje uporabniÅ¡ko ime je: "{USER_NAME}"
Tvoje geslo je: "{PASSWORD}"

Ãˆe Å¾eliÅ¡ aktivirati svoj raÃ¨un, moraÅ¡ klikniti na spodnjo povezavo
ali pa jo vpisati v naslovno vrstico brskalnika.

{ACT_LINK}

Lep pozdrav,

administrator od {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Prikaz komentarjev',
        'no_comment' => 'Ni komentarjev za prikaz',
        'n_comm_del' => 'Å t. pobrisanik komentarjev:%s',
        'n_comm_disp' => 'Å t. komentarjev za prikaz',
        'see_prev' => 'Poglej predhodnega',
        'see_next' => 'Poglej naslednjega',
        'del_comm' => 'PobriÅ¡i izbrane komentarje',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Iskanje slik',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Iskanje novih slik',
        'select_dir' => 'Izberi direktorij',
        'select_dir_msg' => 'Ta ukaz ti omogoÃ¨a dodajanje slik, ki si jih dodal na server s pomoÃ¨jo FTP protokola.<br /><br />Izberi direktorij v katerega si dodal slike',
        'no_pic_to_add' => 'Tu ni nobenih slik za dodajanje',
        'need_one_album' => 'Za uporabo te funkcije moraÅ¡ imeti vsaj en album',
        'warning' => 'Opozorilo',
        'change_perm' => 'pisanje v direktorij ni omogoÃ¨eno, spremeni pravice v 755 ali 777 pred ponovnim poskusom dodajanja slik!',
        'target_album' => '<strong>Dodaj slike </strong>%s<strong> v </strong>%s',
        'folder' => 'Direktorij',
        'image' => 'Slika',
        'album' => 'Album',
        'result' => 'Rezultat',
        'dir_ro' => 'Pisanje onemogoÃ¨eno. ',
        'dir_cant_read' => 'Branje onemoboÃ¨eno. ',
        'insert' => 'Dodajanje novih slik v galerijo',
        'list_new_pic' => 'Seznam novih slik',
        'insert_selected' => 'Dodaj izbrane slike',
        'no_pic_found' => 'Brez novih slik',
        'be_patient' => 'PotrpeÅ¾ljivost... dodajanje traja nekaj Ã¨asa',
        'notes' => '<ul>' . '<li><strong>OK</strong>: pomeni, da so slike uspeÅ¡no dodane' . '<li><strong>DP</strong>: pomeni, da je slika duplikat in je Å¾e v bazi' . '<li><strong>PB</strong>: pomeni, da slike ni moÅ¾no dodati. Preveri nastavitve in pravice za direktorij v katerem se nahajajo' . '<li>Ãˆe ne vidiÅ¡ oznak OK, DP ali PB, klikni na manjkajoÃ¨o slikico za prikaz napake, ki jo generira PHP' . '<li>Za osveÅ¾itev prikaza pritisni tipko reload  v svojem brskalniku' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Dodaj sliko',
        'max_fsize' => 'NajveÃ¨ja dovoljena velikost datoteke je %s kB',
        'album' => 'Album',
        'picture' => 'Slika',
        'pic_title' => 'Ime slike',
        'description' => 'Opis slike',
        'keywords' => 'KljuÃ¨ne besede (loÃ¨i jih s presledki)',
        'err_no_alb_uploadables' => 'Oprosti, trenutno ni albuma v katerega bi lahko dodal slike',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Urejanje uporabnikov',
        'name_a' => 'Ime naraÅ¡Ã¨ajoÃ¨e',
        'name_d' => 'Ime padajoÃ¨e',
        'group_a' => 'Skupina naraÅ¡Ã¨ajoÃ¨e',
        'group_d' => 'Skupina padajoÃ¨e',
        'reg_a' => 'Datum reg. naraÅ¡Ã¨ajoÃ¨e',
        'reg_d' => 'Datum reg. padajoÃ¨e',
        'pic_a' => 'Å t. slik naraÅ¡Ã¨ajoÃ¨e',
        'pic_d' => 'Å t. slik padajoÃ¨e',
        'disku_a' => 'Poraba diska naraÅ¡Ã¨ajoÃ¨e',
        'disku_d' => 'Poraba diska padajoÃ¨e',
        'sort_by' => 'Sortiraj uporabnike po',
        'err_no_users' => 'Tabela s podatki je prazna!',
        'err_edit_self' => 'Svojega prifila ne moreÅ¡ spremeniti. Uporabi povezavo \'Moj profil\'',
        'edit' => 'UREJANJE',
        'delete' => 'BRISANJE',
        'name' => 'UporabniÅ¡ko ime',
        'group' => 'Skupina',
        'inactive' => 'Neaktivni',
        'operations' => 'Operacije',
        'pictures' => 'Slike',
        'disk_space' => 'Porabljen prostor',
        'registered_on' => 'Registriran',
        'u_user_on_p_pages' => 'Å t. uporabnikov:%d (Å¡t. strani:%d)',
        'confirm_del' => 'Res Å¾eliÅ¡ pobrisati tega uporabnika? \\nTudi njegove slike in albumi bodo pobrisani.',
        'mail' => 'POÅ TA',
        'err_unknown_user' => 'Izbrani uporabnik ne obstaja!',
        'modify_user' => 'Uredi uporabnika',
        'notes' => 'Opombe',
        'note_list' => '<li>Ãˆe gesla ne Å¾eliÅ¡ spreminjati, pusti polje za geslo prazno',
        'password' => 'Geslo',
        'user_active' => 'Uporabnik je aktiven',
        'user_group' => 'Uporabnikova skupina',
        'user_email' => 'Uporabnikov email',
        'user_web_site' => 'Uporabnikova domaÃ¨a stran',
        'create_new_user' => 'Ustvari novega uporabnika',
        'user_from' => 'Uporabnikova lokacija',
        'user_interests' => 'Uporabnikovo zanimanje',
        'user_occ' => 'Uporabnikova zaposlitev',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Spremeni velikost slik',

        'what_it_does' => 'Kaj to pomeni',

        'what_update_titles' => 'Kreira imena slik iz imena datotek',

        'what_delete_title' => 'Brisanje imen',

        'what_rebuild' => 'Ponastavi ikone in spremeni velikost slik',

        'what_delete_originals' => 'PobriÅ¡e originalne slike in jih nadomesti z novimi',

        'file' => 'Datoteka',

        'title_set_to' => 'naslov spremenjen v',

        'submit_form' => 'poÅ¡lji',

        'updated_succesfully' => 'uspeÅ¡no posodobljeno',

        'error_create' => 'NAPAKA pri kreiranju',

        'continue' => 'Nadaljuj na naslednjih slikah',

        'main_success' => 'Datoteka %s je bila uporabljena za originalno sliko',

        'error_rename' => 'Napaka pri preimenovanju %s v %s',

        'error_not_found' => 'Ne najdem datoteke %s',

        'back' => 'nazaj na glavno stran',

        'thumbs_wait' => 'Poteka posodabljanje ikon in/ali spreminjanje slik, prosim poÃ¨akaj...',

        'thumbs_continue_wait' => 'Nadaljujem s posodabljanjem ikon in/ali slik, prosim poÃ¨akaj...',

        'titles_wait' => 'Posodabljanje naslovov, prosim poÃ¨akaj...',

        'delete_wait' => 'Brisanje naslovov, prosim poÃ¨akaj...',

        'replace_wait' => 'Brisanje originalnih slik in nadomeÅ¡Ã¨anje s spremenjenimi, prosim poÃ¨akaj..',

        'instruction' => 'Kratka navodila',

        'instruction_action' => 'Izberi ukaz',

        'instruction_parameter' => 'Nastavi parametre',

        'instruction_album' => 'Izberi album',

        'instruction_press' => 'Pritisni %s',

        'update' => 'Posodobi ikone in/ali spremeni velikost slik',

        'update_what' => 'Kaj naj posodobim',

        'update_thumb' => 'Samo ikone',

        'update_pic' => 'Samo spremenjene slike',

        'update_both' => 'Ikone in spremenjene slike',

        'update_number' => 'Å tevilo slik za spreminjanje za vsak klik',

        'update_option' => '(Poskusi z manjÅ¡o vrednostjo, Ã¨e pride do poteka Ã¨asa med izvajanjem opracije)',

        'filename_title' => 'Ime datoteke &rArr; Ime slike',

        'filename_how' => 'Kako naj pretvorim ime datoteke',

        'filename_remove' => 'Odstrani konÃ¨nico .jpg in nadomesti _ (podÃ¨rtaj) s presledki',

        'filename_euro' => 'Spremeni 2003_11_23_13_20_20.jpg v 23/11/2003 13:20',

        'filename_us' => 'Spremeni 2003_11_23_13_20_20.jpg v 11/23/2003 13:20',

        'filename_time' => 'Spremeni 2003_11_23_13_20_20.jpg v 13:20',

        'delete' => 'PobriÅ¡i naslove slik ali originalne slike',

        'delete_title' => 'PobriÅ¡i naslove slik',

        'delete_original' => 'PobriÅ¡i originalne slike',

        'delete_replace' => 'PobriÅ¡i originalne slike, nadomesti jih s spremenjenimi (po velikosti)',

        'select_album' => 'Izberi album',

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