ï»¿<?php 
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
// info about translators and translated language
define('PIC_VIEWS', 'Pregleda');
define('PIC_VOTES', 'Glasova');
define('PIC_COMMENTS', 'Komentara');

$lang_translation_info = array('lang_name_english' => 'Bosnian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Bosanski', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'gb', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Kakanj.net', // the name of the translator - can be a nickname
    'trans_email' => 'info@kakanj.net', // translator's email address (optional)
    'trans_website' => 'http://Kakanj.net/', // translator's website (optional)
    'trans_date' => '2003-04-07', // the date the translation was created / last modified
    );

$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'Ã¨etvrtak', 'petak', 'Sub');
$lang_month = array('jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec');
// Some common strings
$lang_yes = 'Da';
$lang_no = 'Ne';
$lang_back = 'NAZAD';
$lang_continue = 'Nastavi';
$lang_info = 'Informacija';
$lang_error = 'GreÅ¡ka';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'SluÃ¨ajna slika',
    'lastup' => 'Posljednje dodano',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Last updated albums',
    'lastcom' => 'Posljedni komentari',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Najgledanije',
    'toprated' => 'Visoko rangirano',
    'lasthits' => 'Posljednje pogledano',
    'search' => 'Rezultati pretrage',
    'favpics' => 'Favourite Pictures',
    );

$lang_errors = array('access_denied' => 'NemaÅ¡ pristup ovoj stranici.',
    'perm_denied' => 'Nije ti dozvoljeno da izvrÅ¡iÅ¡ tu operaciju.',
    'param_missing' => 'Skripta je pozvana bez obaveznih parametara.',
    'non_exist_ap' => 'Izabrani album/slika viÅ¡e ne postoji !',
    'quota_exceeded' => 'Disk kvota prekoraÃ¨ena<br /><br />Imate dozvoljenu kvotu od [quota]K, vaÅ¡e slike zauzimaju [space]K, dodavanjem ove slike probijate dozvoljenu kvotu.',
    'gd_file_type_err' => 'Ukoliko kotristite GD slikovnu galeriju dozvoljene slike su samo JPG i PNG.',
    'invalid_image' => 'Slika koju ste uploadali je odbaÃ¨ena ili je ne moÅ¾e obraditi GD galerija',
    'resize_failed' => 'Nije moguÃ¦e napraviti manju sliÃ¨icu.',
    'no_img_to_display' => 'Nema slike za prikaz',
    'non_exist_cat' => 'Izabrana kategorija ne postoji',
    'orphan_cat' => 'Kategorija ne postoji, pokrenite organizator kategorija da bi rijeÅ¡ili problem.',
    'directory_ro' => 'Direktoriju \'%s\' nije dodjeljen status writable, slike ne mogu biti izbrisane',
    'non_exist_comment' => 'Izabrani komentar ne postoji.',
    'pic_in_invalid_album' => 'Slika je u nepostojeÃ¦em albumu (%s)!?',
    'banned' => 'You are currently banned from using this site.',
    'not_with_udb' => 'This function is disabled in Coppermine because it is integrated with forum software. Either what you are trying to do is not supported in this configuration, or the function should be handled by the forum software.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Idi na listu albuma',
    'alb_list_lnk' => 'Lista albuma',
    'my_gal_title' => 'Idi na moju liÃ¨nu galeriju',
    'my_gal_lnk' => 'Moja galerija',
    'my_prof_lnk' => 'Moj profil',
    'adm_mode_title' => 'Prebaci na admin mod',
    'adm_mode_lnk' => 'Admin mod',
    'usr_mode_title' => 'Prebaci na korisniÃ¨ki mod',
    'usr_mode_lnk' => 'KorisniÃ¨ki mod',
    'upload_pic_title' => 'Uploadaj sliku u album',
    'upload_pic_lnk' => 'Upload sliku',
    'register_title' => 'Kreiraj account',
    'register_lnk' => 'Registracija',
    'login_lnk' => 'Ulaz',
    'logout_lnk' => 'Izlaz',
    'lastup_lnk' => 'Posljednje dodano',
    'lastcom_lnk' => 'Posljednji komentari',
    'topn_lnk' => 'Najgledanije',
    'toprated_lnk' => 'Visoko rangirano',
    'search_lnk' => 'Pretraga',
    'fav_lnk' => 'My Favorites',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Dozvola uploada',
    'config_lnk' => 'Konfiguracija',
    'albums_lnk' => 'Albumi',
    'categories_lnk' => 'Kategorije',
    'users_lnk' => 'Korisnici',
    'groups_lnk' => 'Grupe',
    'comments_lnk' => 'Komentari',
    'searchnew_lnk' => 'Prebacivanje',
    'util_lnk' => 'Resize pictures',
    'ban_lnk' => 'Ban Users',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Kreiraj / poredaj moje albume',
    'modifyalb_lnk' => 'Prepravi moje albume',
    'my_prof_lnk' => 'Moj profil',
    );

$lang_cat_list = array('category' => 'Kategorija',
    'albums' => 'Albumi',
    'pictures' => 'Slike',
    );

$lang_album_list = array('album_on_page' => '%d albuma na %d stranici'
    );

$lang_thumb_view = array('date' => 'DATUM', 
    // Sort by filename and title
    'name' => 'NAZIV',
    'title' => 'TITLE',
    'sort_da' => 'Poredaj po datumu novije',
    'sort_dd' => 'Poredaj po datumu starije',
    'sort_na' => 'Poredaj po nazivu novije',
    'sort_nd' => 'Poredaj po nazivu starije',
    'sort_ta' => 'Sort by title ascending',
    'sort_td' => 'Sort by title descending',
    'pic_on_page' => '%d slika na %d stranici',
    'user_on_page' => '%d korisnika na %d stranici',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Povratak na sliÃ¨ice',
    'pic_info_title' => 'PokaÅ¾i/sakrij info o fotografiji',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'PoÅ¡alji ovu sliku kao razglednicu',
    'ecard_disabled' => 'razglednica je iskljuÃ¨ena',
    'ecard_disabled_msg' => 'Nije ti dozvoljeno da poÅ¡aljeÅ¡ razglednicu',
    'prev_title' => 'Pogledaj prethodnu sliku',
    'next_title' => 'Pogledaj sljedeÃ¦u sliku',
    'pic_pos' => 'SLIKA %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Ocijeni ovu fotografiju ',
    'no_votes' => '(JoÅ¡ nema ocjena)',
    'rating' => '(trenute ocjene : %s / 5 sa %s glasova)',
    'rubbish' => 'Bez veze',
    'poor' => 'Onako',
    'fair' => 'MoÅ¾e proÃ¦i',
    'good' => 'Dobro',
    'excellent' => 'OdliÃ¨no',
    'great' => 'FantastiÃ¨no',
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
    CRITICAL_ERROR => 'KritiÃ¨na greÅ¡ka',
    'file' => 'Datoteka: ',
    'line' => 'Linija: ',
    );

$lang_display_thumbnails = array('filename' => 'Naziv datoteke : ',
    'filesize' => 'VeliÃ¨ina : ',
    'dimensions' => 'Dimenzije : ',
    'date_added' => 'Dodana : '
    );

$lang_get_pic_data = array('n_comments' => '%s komentara',
    'n_views' => '%s pregleda',
    'n_votes' => '(%s glasova)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Uzvik',
        'Question' => 'Pitanje',
        'Very Happy' => 'Veoma sretan',
        'Smile' => 'Osmjeh',
        'Sad' => 'TuÅ¾an',
        'Surprised' => 'IznenaÃ°en',
        'Shocked' => 'Å okiran',
        'Confused' => 'Zbunjen',
        'Cool' => 'Cool',
        'Laughing' => 'Smijeh',
        'Mad' => 'Bijesan',
        'Razz' => 'VaÅ¾an',
        'Embarassed' => 'PostiÃ°en',
        'Crying or Very sad' => 'Veoma tuÅ¾an',
        'Evil or Very Mad' => 'Zao',
        'Twisted Evil' => 'Ãavo',
        'Rolling Eyes' => 'KotrljajuÃ¦e oÃ¨i',
        'Wink' => 'Mig',
        'Idea' => 'Ideja',
        'Arrow' => 'Strelica',
        'Neutral' => 'Neutralan',
        'Mr. Green' => 'G. Zeleni',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'NapuÅ¡tanje administratorskog moda...',
        1 => 'Ulaz u administratorski mod...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'MoraÅ¡ upisati ime albuma !',
        'confirm_modifs' => 'Da li ste sigurni da Å¾elite napraviti promjene ?',
        'no_change' => 'Niste napravili nikakvu promjenu !',
        'new_album' => 'Novi album',
        'confirm_delete1' => 'Da li ste sigurni da Å¾elite izbrisati ovaj album ?',
        'confirm_delete2' => '\nSve slike i komentari koji su tu biÃ¦e izbrisani !',
        'select_first' => 'Prvo izaberite album',
        'alb_mrg' => 'Organizacija albuma',
        'my_gallery' => '* Moja galerija *',
        'no_category' => '* Nema kategorija *',
        'delete' => 'IzbriÅ¡i',
        'new' => 'Novo',
        'apply_modifs' => 'Napravi promjene',
        'select_category' => 'Izaberi kategoriju',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametri obavezni za \'%s\'komanda nije izvrÅ¡ena !',
        'unknown_cat' => 'Izabrana kategorija ne postoji u bazi podataka',
        'usergal_cat_ro' => 'KoriÅ¡niÃ¨ka kategorija ne moÅ¾e biti izbrisana !',
        'manage_cat' => 'Organizuj kategorije',
        'confirm_delete' => 'Da li ste sigurni da Å¾elite IZBRISATI ovu kategoriju',
        'category' => 'Kategorija',
        'operations' => 'Operacije',
        'move_into' => 'Pomjeri u',
        'update_create' => 'OsvjeÅ¾i/Napravi kategoriju',
        'parent_cat' => 'Osnovna kategorija',
        'cat_title' => 'Naziv kategorije',
        'cat_desc' => 'Opis kategorije',
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Konfiguracija',
        'restore_cfg' => 'Vrati na osnovnu konfiguraciju',
        'save_cfg' => 'Snimi novu konfiguraciju',
        'notes' => 'Napomena',
        'info' => 'Informacija',
        'upd_success' => 'Konfiguracija je osvjeÅ¾ena',
        'restore_success' => 'Osnova konfiguracija je vraÃ¦ena',
        'name_a' => 'Naziv novije',
        'name_d' => 'Naziv starije',
        'title_a' => 'Title ascending',
        'title_d' => 'Title descending',
        'date_a' => 'Datum novije',
        'date_d' => 'Datum starije',
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
        'Osnovno podeÅ¡avanje',
        array('Naziv galerije', 'gallery_name', 0),
        array('Opis galerije', 'gallery_description', 0),
        array('Email administratora galerije', 'gallery_admin_email', 0),
        array('Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array('Jezik', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array('Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2

        // General settings
        'Album list view',
        array('Å irina glavne tabele (pikseli ili %)', 'main_table_width', 0),
        array('Broj levela kategorija za prikaz', 'subcat_level', 0),
        array('Broj albuma za prikaz', 'albums_per_page', 0),
        array('Broj kolona za listu albuma', 'album_list_cols', 0),
        array('VeliÃ¨ina sliÃ¨ice u pikselima', 'alb_list_thumb_size', 0),
        array('SadrÅ¾aj naslovne stranice', 'main_page_layout', 0),
        array('Show first level album thumbnails in categories', 'first_level', 1),
        // 'Thumbnail view',
        'Thumbnail view',
        array('Number of columns on thumbnail page', 'thumbcols', 0),
        array('Number of rows on thumbnail page', 'thumbrows', 0),
        array('Maximum number of tabs to display', 'max_tabs', 0),
        array('Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
        array('Display number of comments below the thumbnail', 'display_comment_count', 1),
        array('Default sort order for pictures', 'default_sort_order', 3),
        array('Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),
        array('Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Image view &amp; Comment settings',
        array('Width of the table for picture display (pixels or %)', 'picture_table_width', 0),
        array('Picture information are visible by default', 'display_pic_info', 1),
        array('Filter bad words in comments', 'filter_bad_words', 1),
        array('Allow smiles in comments', 'enable_smilies', 1),
        array('Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array('Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array('Max length for an image description', 'max_img_desc_length', 0),
        array('Max number of characters in a word', 'max_com_wlength', 0),
        array('Max number of lines in a comment', 'max_com_lines', 0),
        array('Maximum length of a comment', 'max_com_size', 0),
        array('Show film strip', 'display_film_strip', 1),
        array('Number of items in film strip', 'max_film_strip_items', 0),
        array('Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
       array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
		//'Pictures and thumbnails settings',
        'Pictures and thumbnails settings',
        array('Quality for JPEG files', 'jpeg_qual', 0),
        array('Max dimension of a thumbnail <strong>*</strong>', 'thumb_width', 0),
        array('Use dimension ( width or height or Max aspect for thumbnail )<strong>*</strong>', 'thumb_use', 7),
        array('Create intermediate pictures', 'make_intermediate', 1),
        array('Max width or height of an intermediate picture <strong>*</strong>', 'picture_width', 0),
        array('Max size for uploaded pictures (KB)', 'max_upl_size', 0),
        array('Max width or height for uploaded pictures (pixels)', 'max_upl_width_height', 0),
        // 'User settings',
        'User settings',
        array('Allow new user registrations', 'allow_user_registration', 1),
        array('User registration requires email verification', 'reg_requires_valid_email', 1),
        array('Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
        array('Users can can have private albums', 'allow_private_albums', 1),
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Custom fields for image description (leave blank if unused)',
        array('Field 1 name', 'user_field1_name', 0),
        array('Field 2 name', 'user_field2_name', 0),
        array('Field 3 name', 'user_field3_name', 0),
        array('Field 4 name', 'user_field4_name', 0),
        // 'Pictures and thumbnails advanced settings',
        'Pictures and thumbnails advanced settings',
        array('Show private album Icon to unlogged user', 'show_private', 1),
        array('Characters forbidden in filenames', 'forbiden_fname_char', 0),
        array('Accepted file extensions for uploaded pictures', 'allowed_file_extensions', 0),
        array('Method for resizing images', 'thumb_method', 2),
        array('Path to ImageMagick / netpbm \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
        array('Allowed image types (only valid for ImageMagick)', 'allowed_img_types', 0),
        array('Command line options for ImageMagick', 'im_options', 0),
        array('Read EXIF data in JPEG files', 'read_exif_data', 1),
        array('Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array('The album directory <strong>*</strong>', 'fullpath', 0),
        array('The directory for user pictures <strong>*</strong>', 'userpics', 0),
        array('The prefix for intermediate pictures <strong>*</strong>', 'normal_pfx', 0),
        array('The prefix for thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array('Default mode for directories', 'default_dir_mode', 0),
        array('Default mode for pictures', 'default_file_mode', 0),
        array('Picinfo display filename', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array('Picinfo display album name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_file_size', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_dimensions', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array('Picinfo display URL as bookmark link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array('Picinfo display fav album link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        // 'Cookies &amp; Charset settings',
        'Cookies &amp; Charset settings',
        array('Name of the cookie used by the script', 'cookie_name', 0),
        array('Path of the cookie used by the script', 'cookie_path', 0),
        array('Character encoding', 'charset', 4),
        // 'Miscellaneous settings',
        'Miscellaneous settings',
        array('Enable debug mode', 'debug_mode', 1),
        array('Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
        array('Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
    );
        // end left side interpretation
        // ------------------------------------------------------------------------- //
        // File db_input.php
        // ------------------------------------------------------------------------- //
        if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Potrebno je da upiÅ¡ete svoje ime i komentar',
                'com_added' => 'VaÅ¡ komentar je dodan',
                'alb_need_title' => 'Morate upisati naziv za album !',
                'no_udp_needed' => 'Nije potrebno osvjeÅ¾avanje.',
                'alb_updated' => 'Album je osvjeÅ¾en',
                'unknown_album' => 'Izabrani album ne postoji ili nemate dozvolu za upload u ovaj album',
                'no_pic_uploaded' => 'Slika nije dodana !<br /><br />Ako ste zaista izabrali sliku za upload, onda je tenutna greÅ¡ka...',
                'err_mkdir' => 'Nije moguÃ¦e napraviti direktorij %s !',
                'dest_dir_ro' => 'Destinacija direktorija %s nije writable u skripti !',
                'err_move' => 'Nije moguÃ¦e pomjeriti %s u %s !',
                'err_fsize_too_large' => 'Dimenzije slike koju uploadate je prevelika (maksimalno dozvoljeno je %s x %s) !',
                'err_imgsize_too_large' => 'VeliÃ¨ina koju uploadate je prevelika (maksimalno dozvoljeno je %s KB) !',
                'err_invalid_img' => 'Datoteka koju uploadate nije  dozvoljeni format slike !',
                'allowed_img_types' => 'MoÅ¾ete uploadati samo %s slika.',
                'err_insert_pic' => 'Slika \'%s\' (ne)moÅ¾e biti ubaÃ¨ena u album ',
                'upload_success' => 'VaÅ¡a slika je uploadana uspjeÅ¡no<br /><br />Slika Ã¦e biti vidljiva nakon administratove dozvole.',
                'info' => 'Informacija',
                'com_added' => 'Komentar dodan',
                'alb_updated' => 'Album osvjeÅ¾en',
                'err_comment_empty' => 'VaÅ¡ komentar je prazan !',
                'err_invalid_fext' => 'Samo datoteke sa sljedeÃ¦im ekstenzijama su prihvatljive : <br /><br />%s.',
                'no_flood' => 'Å½ao nam je vi ste veÃ¦ autor posljednjeg komentara upisanog za ovu sliku<br /><br />Prepravite komentar koji ste poslali ako Å¾elite promijeniti komentar o slici',
                'redirect_msg' => 'BiÃ¦ete prebaÃ¨eni automatski.<br /><br /><br />Klinki \'CONTINUE\' ako se stranica ne osvjeÅ¾i automatski',
                'upl_success' => 'Slika uspjeÅ¡no dodana',
                );
        // ------------------------------------------------------------------------- //
        // File delete.php
        // ------------------------------------------------------------------------- //
        if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Naziv',
                'fs_pic' => 'puna veliÃ¨ina slike',
                'del_success' => 'uspjeÅ¡no',
                'ns_pic' => 'normalna veliÃ¨ina slike',
                'err_del' => 'nemoÅ¾e biti izbrisano',
                'thumb_pic' => 'sliÃ¨ica',
                'comment' => 'komentar',
                'im_in_alb' => 'slika u albumu',
                'alb_del_success' => 'Album \'%s\' izbrisan',
                'alb_mgr' => 'Organizator albuma',
                'err_invalid_data' => 'Neispravni podaci primljenji u \'%s\'',
                'create_alb' => 'Kreiranje albuma \'%s\'',
                'update_alb' => 'OsvjeÅ¾avanje albuma \'%s\' sa malo \'%s\' i index \'%s\'',
                'del_pic' => 'IzbriÅ¡i sliku',
                'del_alb' => 'IzbriÅ¡i album',
                'del_user' => 'IzbriÅ¡i korisnika',
                'err_unknown_user' => 'Izabrani korisnik ne postoji !',
                'comment_deleted' => 'komentar uspjeÅ¡no izbrisan',
                );
        // ------------------------------------------------------------------------- //
        // File displayecard.php
        // ------------------------------------------------------------------------- //
        // Void
        // ------------------------------------------------------------------------- //
        // File displayimage.php
        // ------------------------------------------------------------------------- //
        if (defined('DISPLAYIMAGE_PHP')) {
            $lang_display_image_php = array('confirm_del' => 'Da li sigurno Å¾elite IZBRISATI ovu sliku ? \\nKomentari Ã¦e takoÃ°e biti izbrisani.',
                'del_pic' => 'IZBRIÅ I OVU SLIKU',
                'size' => '%s x %s pixela',
                'views' => '%s puta',
                'slideshow' => 'Slideshow',
                'stop_slideshow' => 'ZAUSTAVI SLIDESHOW',
                'view_fs' => 'Klikni da vidiš u punoj velièini',
                'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
                );
            $lang_picinfo = array('title' => 'Informacije o slici',
                'Filename' => 'Ime datoteke',
                'Album name' => 'Ime albuma',
                'Rating' => 'Ocjena (%s glasova)',
                'Keywords' => 'KljuÃ¨ne rijeÃ¨i',
                'File Size' => 'VeliÃ¨ina datoteke',
                'Dimensions' => 'Dimenzije',
                'Displayed' => 'Prikazano',
                'Camera' => 'Kamera',
                'Date taken' => 'Datum uzimanja',
                'Aperture' => 'Otvor',
                'Exposure time' => 'Vrijeme izlaganja',
                'Focal length' => 'Odstojanje od centra',
                'Comment' => 'Komentar',
                'addFav' => 'Add to Fav',
                'addFavPhrase' => 'Favourites',
                'remFav' => 'Remove from Fav',
                'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
                'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
                'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
                'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
                'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
                'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
                );
            $lang_display_comments = array('OK' => 'OK',
                'edit_title' => 'Prepravi ovaj komentar',
                'confirm_delete' => 'Sigurni ste da Å¾elite izbrisati ovaj komentar ?',
                'add_your_comment' => 'Dodajte svoj komentar',
                'name' => 'Name',
                'comment' => 'Comment',
                'your_name' => 'VaÅ¡e ime',
                );
            $lang_fullsize_popup = array('click_to_close' => 'Click image to close this window',
                );
        } 
        // ------------------------------------------------------------------------- //
        // File ecard.php
        // ------------------------------------------------------------------------- //
        if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Send an e-card',
                'invalid_email' => '<strong>Ops</strong> : neispravna email adresa !',
                'ecard_title' => 'Razglednica od %s za tebe',
                'view_ecard' => 'Ako razglednica nije prikazana ispravno, kliknite na ovaj link',
                'view_more_pics' => 'Kliknite na ovaj link da vidite viÅ¡e slika !',
                'send_success' => 'VaÅ¡a razglednica je poslana',
                'send_failed' => 'Å½ao nam je, ali server ne moÅ¾e poslati vaÅ¡u razglednicu...',
                'from' => 'Od',
                'your_name' => 'VaÅ¡e ime',
                'your_email' => 'VaÅ¡a email adresa',
                'to' => 'Za',
                'rcpt_name' => 'Ime primatelja',
                'rcpt_email' => 'Email adresa primatelja',
                'greetings' => 'Naslov',
                'message' => 'Poruka',
                );
        // ------------------------------------------------------------------------- //
        // File editpics.php
        // ------------------------------------------------------------------------- //
        if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Slika&nbsp;info',
                'album' => 'Album',
                'title' => 'Naslov',
                'desc' => 'Opis',
                'keywords' => 'KljuÃ¨ne rijeÃ¨i',
                'pic_info_str' => '%sx%s - %sKB - %s pregleda - %s glasova',
                'approve' => 'Odobri sliku',
                'postpone_app' => 'Odgodi odobrenje',
                'del_pic' => 'IzbriÅ¡i sliku',
                'reset_view_count' => 'Resetuj brojaÃ¨ pregleda',
                'reset_votes' => 'Resetuj glasove',
                'del_comm' => 'IzbriÅ¡i komentare',
                'upl_approval' => 'Odobri upload',
                'edit_pics' => 'Prepravi slike',
                'see_next' => 'Pogledaj sljedeÃ¦e slike',
                'see_prev' => 'Pogledaj prethodne slike',
                'n_pic' => '%s slike',
                'n_of_pic_to_disp' => 'Broj slika za prikazivanje',
                'apply' => 'Napravi promjene'
                );
        // ------------------------------------------------------------------------- //
        // File groupmgr.php
        // ------------------------------------------------------------------------- //
        if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Naziv grupe',
                'disk_quota' => 'Kvota diska',
                'can_rate' => 'MoÅ¾e ocijeniti sliku',
                'can_send_ecards' => 'MoÅ¾e poslati razglednicu',
                'can_post_com' => 'MoÅ¾e komentirati',
                'can_upload' => 'MoÅ¾e uploadati sliku',
                'can_have_gallery' => 'MoÅ¾e imati liÃ¨nu galeriju',
                'apply' => 'Napravi promjene',
                'create_new_group' => 'Kreiraj novu grupu',
                'del_groups' => 'IzbriÅ¡i izabrane grupe',
                'confirm_del' => 'Upozorenje, kada izbriÅ¡eÅ¡ grupu, korisnici koji pripadaju toj grupi biÃ¦e prebaÃ¨eni u \'Registered\' grupu !\n\nDa li Å¾eliÅ¡ nastaviti ?',
                'title' => 'Organizuj korisniÃ¨ke grupe',
                'approval_1' => 'Pub. Upl. approval (1)',
                'approval_2' => 'Priv. Upl. approval (2)',
                'note1' => '<strong>(1)</strong> Za upload u javni album potrebna dozvola administratora',
                'note2' => '<strong>(2)</strong> Za upload u album koji pripada korisniku potrebna dozvola administratora',
                'notes' => 'Napomena'
                );
        // ------------------------------------------------------------------------- //
        // File index.php
        // ------------------------------------------------------------------------- //
        if (defined('INDEX_PHP')) {
            $lang_index_php = array('welcome' => 'Dobro doÅ¡li !'
                );
            $lang_album_admin_menu = array('confirm_delete' => 'Da li ste sigurni da Å¾elite IZBRISATI ovaj album ? \\nSve slike i komentari Ã¦e takoÃ°e biti izbrisani.',
                'delete' => 'IZBRIÅ I',
                'modify' => 'KARAKTERISTIKE',
                'edit_pics' => 'PREPRAVKA',
                );
            $lang_list_categories = array('home' => 'POÃˆETNA',
                'stat1' => '<strong>[pictures]</strong> slika u <strong>[albums]</strong> albuma i <strong>[cat]</strong> kategorija sa <strong>[comments]</strong> komentara pogledani <strong>[views]</strong> puta',
                'stat2' => '<strong>[pictures]</strong> slika u <strong>[albums]</strong> albumi pregledani <strong>[views]</strong> puta',
                'xx_s_gallery' => '%s\'s Galerija',
                'stat3' => '<strong>[pictures]</strong> slika u <strong>[albums]</strong> albuma sa <strong>[comments]</strong> komentara pogledano <strong>[views]</strong> puta'
                );
            $lang_list_users = array('user_list' => 'Lista korisnika',
                'no_user_gal' => 'Nema korisniÃ¨kih galerija',
                'n_albums' => '%s album(a)',
                'n_pics' => '%s slika'
                );
            $lang_list_albums = array('n_pictures' => '%s slika',
                'last_added' => ', zadnja dodana %s'
                );
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
            if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'OsvjeÅ¾i album %s',
                    'general_settings' => 'Osnovno Å¡timanje',
                    'alb_title' => 'Naziv albuma',
                    'alb_cat' => 'Kategorija albuma',
                    'alb_desc' => 'Opis albuma',
                    'alb_thumb' => 'SliÃ¨ice albuma',
                    'alb_perm' => 'Dozvole za ovaj album',
                    'can_view' => 'Album moÅ¾e biti vidljiv',
                    'can_upload' => 'Posjetioci mogu uploadat slike',
                    'can_post_comments' => 'Posjetioci mogu pisati komentare',
                    'can_rate' => 'Posjetioci mogu ocijenjivati slike',
                    'user_gal' => 'Korisnikova galerija',
                    'no_cat' => '* Nema kategorije *',
                    'alb_empty' => 'Album je prazan',
                    'last_uploaded' => 'Zadnje uploadano',
                    'public_alb' => 'Svi (javni album)',
                    'me_only' => 'Samo ja',
                    'owner_only' => 'Vlasnik albuma (%s) samo',
                    'groupp_only' => 'Members of the \'%s\' group',
                    'err_no_alb_to_modify' => 'U bazi podataka nema albuma koji moÅ¾ete prepraviti.',
                    'update' => 'OsvjeÅ¾i album'
                    );
            // ------------------------------------------------------------------------- //
            // File ratepic.php
            // ------------------------------------------------------------------------- //
            if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Å½ao mi je veÃ¦ ste ocijenili ovu sliku',
                    'rate_ok' => 'Glas upisan',
                    );
            // ------------------------------------------------------------------------- //
            // File register.php & profile.php
            // ------------------------------------------------------------------------- //
            if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
                $lang_register_disclamer = <<<EOT
Za postavljanje vlastitih fotografija u galeriju potrebno je registrovati se. Prilikom registracije obavezno morate upisati vaÅ¡u ispravnu, postojeÃ¦u email adresu, na koju Ã¦e vam biti poslan email sa linkom kojim Ã¦ete potvrditi vaÅ¡u registraciju.<br />
<br /> 
SlaÅ¾em se da neÃ¦u postavljati bilo kakve uznemirujuÃ¦e, pornografske, vulgarne fotografije kao i fotografije koje potiÃ¨u na bilo kakav oblik mrÅ¾nje. SlaÅ¾em se takoÃ°e da Administrator ovog dijela Administrator ima pravo da izbriÅ¡e sve fotografije koje nisu prihvatljive, odnosno nabrojane kategorije fotografija. SlaÅ¾em se da Administrator moÅ¾e izbrisati svaki moj komentar ukoliko ocijeni da nije prikladan. Kao korisnik ovoe foto galerije slaÅ¾em se da svi moji podaci koje upiÅ¡em u registracijsku formu budu pohranjeni u bazu podataka. Ukoliko na bilo kakav naÃ¨in uznemiravam foto galeriju slaÅ¾em se da administator banuje moju IP adresu, odnosno da mi do daljnjeg zabrani pristup ovoim stranicama. I tako dalje, nadamo se da Ã¦ete poÅ¡tovati ova pravila.<br />
<br />
Ova stranica koristi cookies za pohranu podataka na vaÅ¡em raÃ¨unaru. Email adresa se koristi samo za potvrdu vaÅ¡e registracije.<br />
<br />
Klikom na 'SlaÅ¾em se' prihvatate uslove koriÅ¡tenja i nadamo se da ih neÃ¦ete prekrÅ¡iti.
EOT;
                $lang_register_php = array('page_title' => 'Registracija',
                    'term_cond' => 'Pravila i uslovi',
                    'i_agree' => 'SlaÅ¾em se',
                    'submit' => 'PoÅ¡alji registraciju',
                    'err_user_exists' => 'Izabrano korisniÃ¨ko ime veÃ¦ je registrovano, probajte neko drugo',
                    'err_password_mismatch' => 'Nedostaju dvije Å¡ifre, upiÅ¡ite ponovno',
                    'err_uname_short' => 'KorisniÃ¨ko ime mora imati najmanje 2 znaka',
                    'err_password_short' => 'Å ifra mora imati najmanje 2 znaka',
                    'err_uname_pass_diff' => 'KorisniÃ¨ko ime i Å¡ifra ne mogu biti isti',
                    'err_invalid_email' => 'Neispravna email adresa',
                    'err_duplicate_email' => 'VeÃ¦ je neko registrovan sa istom email adresom koju ste upisali',
                    'enter_info' => 'UpiÅ¡ite registracijske podatke',
                    'required_info' => 'Obavezni podaci',
                    'optional_info' => 'Dodatni podaci',
                    'username' => 'KorisniÃ¨ko ime',
                    'password' => 'Å ifra',
                    'password_again' => 'Å ifra ponvno',
                    'email' => 'Email',
                    'location' => 'Lokacija',
                    'interests' => 'Interesi',
                    'website' => 'Web stranica',
                    'occupation' => 'Zanimanje',
                    'error' => 'GREÅ KA',
                    'confirm_email_subject' => '%s - Potvrdite registraciju',
                    'information' => 'Informacija',
                    'failed_sending_email' => 'Registracijsku konfirmaciju nije moguÃ¦e poslati !',
                    'thank_you' => 'Hvala na registraciji.<br /><br />Email sa informacijama kako da aktivirate vaÅ¡ korisniÃ¨ki raÃ¨un je poslan na email adresu koju ste upisali prilikom registracije.',
                    'acct_created' => 'VaÅ¡ korisniÃ¨ki raÃ¨un je otvoren i sada moÅ¾ete pristupiti stranici sa vaÅ¡im korisniÃ¨im imenom i Å¡ifrom',
                    'acct_active' => 'VaÅ¡ korisniÃ¨ki raÃ¨un od sada je aktivan i moÅ¾ete stranici pristupiti sa vaÅ¡im korisniÃ¨im imeno i Å¡ifrom',
                    'acct_already_act' => 'VaÅ¡ korisniÃ¨ki raÃ¨un je veÃ¦ aktivan !',
                    'acct_act_failed' => 'Ovaj korisniÃ¨ki raÃ¨un ne moÅ¾e biti aktivan !',
                    'err_unk_user' => 'Izabrani korisnik ne postoji !',
                    'x_s_profile' => '%s\'s profil',
                    'group' => 'Grupa',
                    'reg_date' => 'Registovan(a)',
                    'disk_usage' => 'IskoriÅ¡tenost disk prostora',
                    'change_pass' => 'Promijeni Å¡ifru',
                    'current_pass' => 'Trenutna Å¡ifra',
                    'new_pass' => 'Nova Å¡ifra',
                    'new_pass_again' => 'Nova Å¡ifra ponovno',
                    'err_curr_pass' => 'Trenutna Å¡ifra nije ispravna',
                    'apply_modif' => 'IzvrÅ¡i promjene',
                    'change_pass' => 'Promijeni moju Å¡ifru',
                    'update_success' => 'VaÅ¡ profil je osvjeÅ¾en',
                    'pass_chg_success' => 'VaÅ¡a Å¡ifra je promijenjena',
                    'pass_chg_error' => 'VaÅ¡a Å¡ifra nije promijenjena',
                    );
$lang_register_confirm_email = <<<EOT
Hvala na registraciji na {SITE_NAME}

VaÅ¡e korisniÃ¨ko ime : "{USER_NAME}"
VaÅ¡a Å¡ifra : "{PASSWORD}"

Da bi aktivirali vaÅ¡ korisniÃ¨ki raÃ¨un potrebno je da kliknete na link ispod ili ako Å¾elite kopirajte link i nalijepite u vaÅ¡ web browser.

{ACT_LINK}

Pozdrav,

Team {SITE_NAME}

EOT;
}
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'ProÃ¨itajte komentare',
        'no_comment' => 'Nema komentara za Ã¨itanje',
        'n_comm_del' => '%s komentari su izbrisani',
        'n_comm_disp' => 'Broj komentara za prikaz',
        'see_prev' => 'Pogledaj prethodno',
        'see_next' => 'Pogledaj sljedeÃ¦e',
        'del_comm' => 'IzbriÅ¡i izabrane komentare',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'PretraÅ¾ite kolekciju slika',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Pretraga novih slika',
        'select_dir' => 'Izaberi direktorij',
        'select_dir_msg' => 'Ova funkcija dozvoljava vam da napravite put do slike koju imate na svom server.<br /><br />Izaberite direktorij gdje ste uploadali svoje slike',
        'no_pic_to_add' => 'Nema slike za dodati',
        'need_one_album' => 'Morate imati najmanje jedan album da bi koristili ovu funkciju',
        'warning' => 'Upozorenje',
        'change_perm' => 'skripta ne moÅ¾e upisivati u ovaj direktorij, morate promijeniti CHMOD na 755 ili 777 prije nego Å¡to dodate slike !',
        'target_album' => '<strong>Prebaci sliku iz &quot;</strong>%s<strong>&quot; u </strong>%s',
        'folder' => 'Folder',
        'image' => 'Slika',
        'album' => 'Album',
        'result' => 'Rezultat',
        'dir_ro' => 'Nije writable. ',
        'dir_cant_read' => 'Nije readable. ',
        'insert' => 'Dodavanje novih slika u galeriju',
        'list_new_pic' => 'Lista novih slika',
        'insert_selected' => 'Ubaci izabrane slike',
        'no_pic_found' => 'Nije pronaÃ°ema nova slika',
        'be_patient' => 'Molimo budite strpljivi, skripti treba vremena da doda slike',
        'notes' => '<ul>' . '<li><strong>OK</strong> : znaÃ¨i da je slika uspjeÅ¡no dodana' . '<li><strong>DP</strong> : znaÃ¨i da je slika duplikat i da je veÃ¦ u bazi podataka' . '<li><strong>PB</strong> : znaÃ¨i da sliku nije moguÃ¦e dodati, provjerite vlastitu konfiguraciju i dozvolu direktorija gdje su slike locirane' . '<li>Ako OK, DP, PB \'signs\' se ne pojave klikni na puknutu sliku da vidiÅ¡ koju je greÅ¡ku napravio PHP' . '<li>Ako je sesija istekla, pritisnite refresh' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Upload sliku',
        'max_fsize' => 'Maksimalno dozvoljena veliÃ¨ina je %s KB',
        'album' => 'Album',
        'picture' => 'Slika',
        'pic_title' => 'Naslov slike',
        'description' => 'Opis slike',
        'keywords' => 'KljuÃ¨ne rijeÃ¨i (odvojiti praznim mjestom)',
        'err_no_alb_uploadables' => 'Å½ao nam je ovdje nema albuma gdje bi mogli ubaciti sliku.',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Organizuj korisnike',
        'name_a' => 'Ime ascending',
        'name_d' => 'Ime descending',
        'group_a' => 'Grupa ascending',
        'group_d' => 'Grupa descending',
        'reg_a' => 'Datum registracije ascending',
        'reg_d' => 'Datum registracije descending',
        'pic_a' => 'Broj slika ascending',
        'pic_d' => 'Broj slika descending',
        'disku_a' => 'IskoriÅ¡tenost diska ascending',
        'disku_d' => 'IskoriÅ¡tenost diska descending',
        'sort_by' => 'Poredaj korisnike po',
        'err_no_users' => 'KorisniÃ¨ka tabla je prazna !',
        'err_edit_self' => 'Ne moÅ¾ete promijeniti svoj profil, koristite \'My profile\' link za to',
        'edit' => 'PREPRAVI',
        'delete' => 'IZBRIÅ I',
        'name' => 'KorisniÃ¨ko ime',
        'group' => 'Grupa',
        'inactive' => 'Neaktivno',
        'operations' => 'Operacije',
        'pictures' => 'Slike',
        'disk_space' => 'IskoriÅ¡teno prostora / Kvota',
        'registered_on' => 'Registrovan',
        'u_user_on_p_pages' => '%d korisnika na %d stranica',
        'confirm_del' => 'Da li ste sigurni da Å¾elite OBRISATI korisnika ? \\nSve njegove slike i albumi Ã¦e biti izbrisani.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Izabrani korisnik ne postoji !',
        'modify_user' => 'Modificiraj korisnika',
        'notes' => 'Napomena',
        'note_list' => '<li>Ako ne Å¾elite da promijenite trenutnu Å¡ifru, ostavite "Å¡ifra" polje prazno',
        'password' => 'Å ifra',
        'user_active' => 'Korisnik je aktivan',
        'user_group' => 'Grupa',
        'user_email' => 'Email',
        'user_web_site' => 'Web stranica',
        'create_new_user' => 'Kreiraj novog korisnika',
        'user_location' => 'Lokacija',
        'user_interests' => 'Interesi',
        'user_occupation' => 'Zanimanje',
        );
// ------------------------------------------------------------------------- //
// File util.php //
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Resize pictures',
        'what_it_does' => 'What it does',
        'what_update_titles' => 'Updates titles from filename',
        'what_delete_title' => 'Deletes titles',
        'what_rebuild' => 'Rebuilds thumbnails and resized photos',
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version',
        'file' => 'File',
        'title_set_to' => 'title set to',
        'submit_form' => 'submit',
        'updated_succesfully' => 'updated succesfully',
        'error_create' => 'ERROR creating',
        'continue' => 'Process more images',
        'main_success' => 'The file %s was successfully used as main picture',
        'error_rename' => 'Error renaming %s to %s',
        'error_not_found' => 'The file %s was not found',
        'back' => 'back to main',
        'thumbs_wait' => 'Updating thumbnails and/or resized images, please wait...',
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
        'titles_wait' => 'Updating titles, please wait...',
        'delete_wait' => 'Deleting titles, please wait...',
        'replace_wait' => 'Deleting originals and replacing them with resized images, please wait..',
        'instruction' => 'Quick instructions',
        'instruction_action' => 'Select action',
        'instruction_parameter' => 'Set parameters',
        'instruction_album' => 'Select album',
        'instruction_press' => 'Press %s',
        'update' => 'Update thumbs and/or resized photos',
        'update_what' => 'What should be updated',
        'update_thumb' => 'Only thumbnails',
        'update_pic' => 'Only resized pictures',
        'update_both' => 'Both thumbnails and resized pictures',
        'update_number' => 'Number of processed images per click',
        'update_option' => '(Try setting this option lower if you experience timeout problems)',
        'filename_title' => 'Filename â‡’ Picture title',
        'filename_how' => 'How should the filename be modified',
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces',
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20',
        'delete' => 'Delete picture titles or original size photos',
        'delete_title' => 'Delete picture titles',
        'delete_original' => 'Delete original size photos',
        'delete_replace' => 'Deletes the original images replacing them with the sized versions',
        'select_album' => 'Select album',
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