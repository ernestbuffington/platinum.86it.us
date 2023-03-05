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

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Romanian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Romana', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'ro', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Silviu Vulcan', // the name of the translator - can be a nickname
    'trans_email' => 'openphoto@miv.directnet.ro', // translator's email address (optional)
    'trans_website' => 'http://openphoto.binary-pulse.org/', // translator's website (optional)
    'trans_date' => '2003-10-07', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Da';
$lang_no = 'Nu';
$lang_back = 'INAPOI';
$lang_continue = 'CONTINUARE';
$lang_info = 'Informatii';
$lang_error = 'Eroare';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'pizda', 'pula', 'sugi', 'coaie', 'cur', 'buci');

$lang_meta_album_names = array('random' => 'Imagini aleatoare',
    'lastup' => 'Ultimele adaugate',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Ultimele albume modificate',

    'lastcom' => 'Ultimele comentarii',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Cele mai vizitate',
    'toprated' => 'Cele mai apreciate',
    'lasthits' => 'Ultimele vizitate',
    'search' => 'Rezultatele cautarii',

    'favpics' => 'Imaginile favorite'

    );

$lang_errors = array('access_denied' => 'Nu aveti dreptul sa accesati aceasta pagina.',
    'perm_denied' => 'Nu aveti dreptul sa efectuati aceasta operatie',
    'param_missing' => 'Scriptul a fost rulat fara parametrul - parametrii necesari.',
    'non_exist_ap' => 'Albumul/imaginea selectata nu exista !',
    'quota_exceeded' => 'Cota dumneavoastra a fost depasita<br /><br />Aveti o cota pe disk de [quota]K, pozele dumneavoastra ocupa acum [space]K, adaugand aceasta imagine veti depasi aceasta cota.',
    'gd_file_type_err' => 'Cand folositi biblioteca GD tipurile de fisiere ce le putei utiliza sunt JPEG si PNG.',
    'invalid_image' => 'Imaginea inregistrata de dumneavoastra este corupta sau nu poate fi prelucrata de biblioteca GD',
    'resize_failed' => 'Nu s-a putut crea pictograma sau imaginea redusa.',
    'no_img_to_display' => 'Nici o imagine de incarcat',
    'non_exist_cat' => 'Categoria selectata nu exista',
    'orphan_cat' => 'O categorie are parintele inexistent, rulati managerul de categorii pentru a corecta problema.',
    'directory_ro' => 'Directorul \'%s\' nu poate fi scris, imaginile nu pot fi sters',
    'non_exist_comment' => 'Comentariul selectat nu exista.',
    'pic_in_invalid_album' => 'Imaginea este intr-un album inexistent (%s)!?',

    'banned' => 'Sunteti exclus de pe aceasta pagina web.',

    'not_with_udb' => 'Aceasta functie este blocata in Coppermine deoarece este integrata cu programul ce ruleaza forumul. Ce incercati sa faceti ori nu este suportat in aceasta configuratie, ori functia trebuie executata de programul ce ruleaza forumul.',

    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Lista albumelor',
    'alb_list_lnk' => 'Lista albumelor',
    'my_gal_title' => 'Galeria mea personala',
    'my_gal_lnk' => 'Galeria mea',
    'my_prof_lnk' => 'Profilul meu',
    'adm_mode_title' => 'Schimbati in modul administrator',
    'adm_mode_lnk' => 'Mod administrator',
    'usr_mode_title' => 'Schimbati in modul utilizator',
    'usr_mode_lnk' => 'Mod utilizator',
    'upload_pic_title' => 'Incarcati o imagine intr-un album',
    'upload_pic_lnk' => 'Incarcati o imagine',
    'register_title' => 'Creati un cont',
    'register_lnk' => 'Inregistrare',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => 'Ultimele imagini incarcate',
    'lastcom_lnk' => 'Ultimele comentarii',
    'topn_lnk' => 'Cele mai vizitate',
    'toprated_lnk' => 'Cele mai apreciate',
    'search_lnk' => 'Cautare',
    'fav_lnk' => 'Favoritele mele',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Aprobarea inregistrarilor',
    'config_lnk' => 'Configurare',
    'albums_lnk' => 'Albume',
    'categories_lnk' => 'Categorii',
    'users_lnk' => 'Utilizatori',
    'groups_lnk' => 'Grupuri',
    'comments_lnk' => 'Comentarii',
    'searchnew_lnk' => 'Adaugati imagini in mod \'batch\'',
    'util_lnk' => 'Redimensionati imaginile',

    'ban_lnk' => 'Banati utilizatori',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Creati / ordonati albumele mele',
    'modifyalb_lnk' => 'Modificati albumele mele',
    'my_prof_lnk' => 'Profilul meu',
    );

$lang_cat_list = array('category' => 'Categorie',
    'albums' => 'Albume',
    'pictures' => 'Imagini',
    );

$lang_album_list = array('album_on_page' => '%d albume pe %d pagini'
    );

$lang_thumb_view = array('date' => 'DATA',
    'name' => 'NUMELE FISIERULUI',

    'title' => 'TITLU',

    'sort_da' => 'Sortare dupa data, ascendent',
    'sort_dd' => 'Sortare dupa data, descendent',
    'sort_na' => 'Sortare dupa nume, ascendent',
    'sort_nd' => 'Sortare dupa nume, ascendent',
    'sort_ta' => 'Sortare dupa titlu, ascendent',

    'sort_td' => 'Sortare dupa titlu, ascendent',

    'pic_on_page' => '%d imagini pe %d pagini',
    'user_on_page' => '%d utilizatori pe %d pagini',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Inapoi la pagina cu pictograme',
    'pic_info_title' => 'Afisare/Ascundere informatii despre imagine',
    'slideshow_title' => 'Diaporama',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Trimiteti aceasta imagine ca vedere electronica',
    'ecard_disabled' => 'vederile electronice sunt dezactivate',
    'ecard_disabled_msg' => 'Nu aveti permisiune sa trimiteti vederi electronice',
    'prev_title' => 'Vizualizati imaginea precedenta',
    'next_title' => 'Vizualizati imaginea urmatoare',
    'pic_pos' => 'IMAGINEA %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Apreciaza aceasta imagine ',
    'no_votes' => '(Nici un vot inca)',
    'rating' => '(aprecierea curenta : %s / 5 cu %s voturi)',
    'rubbish' => 'Nereusita',
    'poor' => 'Slaba',
    'fair' => 'Acceptabila',
    'good' => 'Buna',
    'excellent' => 'Excelenta',
    'great' => 'Nemaipomenita',
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
    CRITICAL_ERROR => 'Critical error',
    'file' => 'File: ',
    'line' => 'Line: ',
    );

$lang_display_thumbnails = array('filename' => 'Nume fisier : ',
    'filesize' => 'Marimea fiserului : ',
    'dimensions' => 'Dimensiuni : ',
    'date_added' => 'Data adaugarii : '
    );

$lang_get_pic_data = array('n_comments' => '%s comentarii',
    'n_views' => '%s vizitari',
    'n_votes' => '(%s voturi)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Exclamare',
        'Question' => 'Intrebare',
        'Very Happy' => 'Foarte bucuros',
        'Smile' => 'Zambeste',
        'Sad' => 'Suparat',
        'Surprised' => 'Surprins',
        'Shocked' => 'Socat',
        'Confused' => 'Confuz',
        'Cool' => 'Cool',
        'Laughing' => 'Razand',
        'Mad' => 'Nervos',
        'Razz' => 'Razz',
        'Embarassed' => 'Stanjenit',
        'Crying or Very sad' => 'Plangand sau foarte suparat',
        'Evil or Very Mad' => 'Rau sau foarte suparat',
        'Twisted Evil' => 'Foarte rau',
        'Rolling Eyes' => 'Rostogolind ochii',
        'Wink' => 'Clipeste',
        'Idea' => 'Idee',
        'Arrow' => 'Sageata',
        'Neutral' => 'Neutru',
        'Mr. Green' => 'Dl. Verde',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Paraseste modul administrator...',
        1 => 'Intra in modul administrator...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Albumele trebuia sa aiba un nume !',
        'confirm_modifs' => 'Sunteti sigur ca vreti sa faceti aceste modificari ?',
        'no_change' => 'Nu ati facut nici o modificare !',
        'new_album' => 'Album nou',
        'confirm_delete1' => 'Sunteti sigur ca vreti sa stergeti acest album ?',
        'confirm_delete2' => '\nToate imaginile si comentariile continute vor fi pierdute !',
        'select_first' => 'Selectati un album inainte',
        'alb_mrg' => 'Managerul de albume',
        'my_gallery' => '* Galeria mea *',
        'no_category' => '* Nici o categorie *',
        'delete' => 'Sterge',
        'new' => 'Nou',
        'apply_modifs' => 'Efectuati modificarile',
        'select_category' => 'Selectati o categorie',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametrii necesari pentru operatia \'%s\' nu au fost stabiliti !',
        'unknown_cat' => 'Categoria selectata nu exista in baza de date',
        'usergal_cat_ro' => 'Categoria Galeria Utilizatorului nu poate fi stearsa !',
        'manage_cat' => 'Administrati categoriile',
        'confirm_delete' => 'Sunteti sigur ca doriti sa STERGETI aceasta categorie',
        'category' => 'Categorie',
        'operations' => 'Operatii',
        'move_into' => 'Mutati in',
        'update_create' => 'Modificati/Creati o categorie',
        'parent_cat' => 'Categoria parinte',
        'cat_title' => 'Titlul categoriei',
        'cat_desc' => 'Descrierea categoriei'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Configurare',
        'restore_cfg' => 'Reveniti la setarile predefinite',
        'save_cfg' => 'Salvati noua configuratie',
        'notes' => 'Note',
        'info' => 'Informatii',
        'upd_success' => 'Configuratia Coppermine a fost modificata',
        'restore_success' => 'Configuratia Coppermine predefinita a fost restabilita',
        'name_a' => 'Nume ascendent',
        'name_d' => 'Nume descendent',
        'title_a' => 'Titlu ascendent',

        'title_d' => 'Titlu descendent',

        'date_a' => 'Data ascendenta',
        'date_d' => 'Data descendenta',
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
        'generale',
        array(
            'Numele galeriei', 'gallery_name', 0),
        array(
            'Descrierea galeriei', 'gallery_description', 0),
        array(
            'Adresa e-mail a administratorului', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Limba', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Lista cu albume',
        array(
            'Latimea tabelului principal (pixeli sau %)', 'main_table_width', 0),
        array(
            'Numarul de nivele de categorii care sa fie afisate', 'subcat_level', 0),
        array(
            'Numarul albumelor ce vor fi afisate', 'albums_per_page', 0),
        array(
            'Numarul de coloane in lista de albume', 'album_list_cols', 0),
        array(
            'Dimensiunea pictogramelor in pixeli', 'alb_list_thumb_size', 0),
        array(
            'Continutul paginii principale', 'main_page_layout', 0),
        array(
            'Afiseaza pictogramele albumelor din primul nivel in categorii', 'first_level', 1), 
        // 'Thumbnail view',
        'Pictograme',
        array(
            'Numarul de coloane pe pagina cu pictograme', 'thumbcols', 0),
        array(
            'Numarul de randuri pe pagina cu pictograme', 'thumbrows', 0),
        array(
            'Maximul numar de taburi ce vor fi afisate', 'max_tabs', 0),
        array(
            'Afiseaza descrierea imaginii (pe langa titlu) sub pictograma', 'caption_in_thumbview', 1),
        array(
            'Afiseaza numarul de comentarii sub pictograma', 'display_comment_count', 1),
        array(
            'Ordinea de sortare a imaginilor predefinita', 'default_sort_order', 3),
        array(
            'Numarul minim de voturi pentru ca o imagine sa apara in lista \'Cele mai apreciate\' ', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Afisarea imaginii &amp; setarile comentariilor',
        array(
            'Latimea tabelului pentru afisarea imaginii (pixeli sau %)', 'picture_table_width', 0),
        array(
            'Informatiile despre imagine sunt vizibile in mod predefinit', 'display_pic_info', 1),
        array(
            'Filtrati cuvintele urate in comentarii', 'filter_bad_words', 1),
        array(
            'Activeaza codurile zambitori in comentarii', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Lungimea maxima a descrierii imagini', 'max_img_desc_length', 0),
        array(
            'Numarul maxim de caractere intr-un cuvant', 'max_com_wlength', 0),
        array(
            'Numarul maxim de linii intr-un comentariu', 'max_com_lines', 0),
        array(
            'Lungimea maxima a unui comentariu', 'max_com_size', 0),
        array(
            'Afiseaza rama film', 'display_film_strip', 1),

        array(
            'Numarul de obiecte in rama film', 'max_film_strip_items', 0),

        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Setari pentru imagini si pictograme',
        array(
            'Calitatea fisierelor JPEG', 'jpeg_qual', 0),
        array(
            'Dimensiunea maxima a unei pictograme <strong>*</strong>', 'thumb_width', 0),

        array(
            'Utilizati dimensiunea ( latime sau inaltime sau aspectul Maxim pentru pictograma )<strong>*</strong>', 'thumb_use', 7),

        array(
            'Creaza imagini intermediare', 'make_intermediate', 1),
        array(
            'Latimea sau inaltimea maxima a unei imagini intermediare <strong>*</strong>', 'picture_width', 0),
        array(
            'Dimensiunea maxima a unei imagini (KB)', 'max_upl_size', 0),
        array(
            'Latimea sau inaltimea maxima a imaginilor inregistrate (pixeli)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Setari pentru utilizatori',
        array(
            'Permiteti inregistrarea de noi utilizatori', 'allow_user_registration', 1),
        array(
            'Inregistrarea utilizatorilor necesita inregistrarea prin e-mail', 'reg_requires_valid_email', 1),
        array(
            'Doi utilizatori pot avea aceeasi adresa e-mail', 'allow_duplicate_emails_addr', 1),
        array(
            'Utilizatorii pot avea albume private', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Descrierea campurilor aditionale (lasati necompletat daca nu le utilizati)',
        array(
            'Numele campului 1', 'user_field1_name', 0),
        array(
            'Numele campului 2', 'user_field2_name', 0),
        array(
            'Numele campului 3', 'user_field3_name', 0),
        array(
            'Numele campului 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Setari avansate pentru imagini si pictograme',
        array(
            'Afiseaza Icoana privat utilizatorilor neinregistrati', 'show_private', 1),

        array(
            'Caractere interzise in numele de fisiere', 'forbiden_fname_char', 0),
        array(
            'Extensii acceptate pentru fisierele incarcate', 'allowed_file_extensions', 0),
        array(
            'Metoda de redimensionare a imaginilor', 'thumb_method', 2),
        array(
            'Calea catre utilitarul ImageMagick / netpbm \'convert\' (examplu /usr/bin/X11/)', 'impath', 0),
        array(
            'Tipuri de imagini permise (valid doar pentru ImageMagick)', 'allowed_img_types', 0),
        array(
            'Optiuni in linie de comanda pentru ImageMagick', 'im_options', 0),
        array(
            'Extrage informatiile EXIF din fisierele JPEG', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Directorul cu albume <strong>*</strong>', 'fullpath', 0),
        array(
            'Directorul pentru imaginile utilizatorilor <strong>*</strong>', 'userpics', 0),
        array(
            'Prefixul pentru imaginile intermediare <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefixul pentru pictograme <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Modul predefinit al directoarelor', 'default_dir_mode', 0),
        array(
            'Modul predefinit al imaginilor', 'default_file_mode', 0),
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
        'Cookies &amp; Charset settings',
        array(
            'Numele cookie-ului utilizat de script', 'cookie_name', 0),
        array(
            'Calea cookie-ului utilizat de script', 'cookie_path', 0),
        array(
            'Character encoding', 'charset', 4), 
        // 'Miscellaneous settings',
        'Miscellaneous settings',
        array(
            'Activeaza modul debug', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Campurile marcate cu * nu trebuie modificate daca aveti deja imagini in galeria dvs.</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Trebuie sa introduceti numele dvs. si un comentariu',
        'com_added' => 'Comentariul dvs. a fost adaugat',
        'alb_need_title' => 'Trebuie sa furnizati un titlu pentru album !',
        'no_udp_needed' => 'Nici o modificare necesara.',
        'alb_updated' => 'Albumul a fost modificat',
        'unknown_album' => 'Albumul selectat nu exista sau nu aveti permisiunea sa incarcati in acest album',
        'no_pic_uploaded' => 'Nici o imagine nu a fost incarcata !<br /><br />Daca intradevar ati selectat o imagine, verificati daca serveruol permite uploaduri...',
        'err_mkdir' => 'Eroare in creearea directorului %s !',
        'dest_dir_ro' => 'Directorul destinatie %s nu poate fi scris de catre script !',
        'err_move' => 'Imposibil de deplasat %s in %s !',
        'err_fsize_too_large' => 'Dimensiunea imaginii este prea mare (maximul permis este %s x %s) !',
        'err_imgsize_too_large' => 'Marimea fisierului incarcat este prea mare (maximul permis este %s KB) !',
        'err_invalid_img' => 'Fiserul incarcat nu este o imagine valida !',
        'allowed_img_types' => 'Puteti incarca doar %s imagini.',
        'err_insert_pic' => 'Imaginea \'%s\' nu poate fi inserat in album ',
        'upload_success' => 'Imaginea dvs. a fost incarcata cu succes<br /><br />Va fi vizibila dupa aprobarea administratorului.',
        'info' => 'Informatii',
        'com_added' => 'Comentariu adaugat',
        'alb_updated' => 'Album modificat',
        'err_comment_empty' => 'Cometariul dvs. este gol !',
        'err_invalid_fext' => 'Doar fisierele cu urmatoarele extensii sunt permise : <br /><br />%s.',
        'no_flood' => 'Ne pare rau dar sunteti deja autorul ultimului comentariu postat pentru aceasta imagine<br /><br />Editati comentariul postat daca doriti sa-l modificati',
        'redirect_msg' => 'Sunteti redirectat.<br /><br /><br />Click pe \'CONTINUE\' daca pagina nu se incarca automat',
        'upl_success' => 'Imaginea dvs. a fost adaugata cu succes',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Descriere',
        'fs_pic' => 'imaginea la dimensiuni maxime',
        'del_success' => 'stearsa cu succes',
        'ns_pic' => 'imaginea de dimensiuni normale',
        'err_del' => 'nu poate fi stearsa',
        'thumb_pic' => 'pictograma',
        'comment' => 'comentariul',
        'im_in_alb' => 'imaginea in album',
        'alb_del_success' => 'Albumul \'%s\' a fost sters',
        'alb_mgr' => 'Managerul de albume',
        'err_invalid_data' => 'Date nevalide primite in \'%s\'',
        'create_alb' => 'Creare album \'%s\'',
        'update_alb' => 'Modificare album \'%s\' cu titlul \'%s\' si indexul \'%s\'',
        'del_pic' => 'Sterge imaginea',
        'del_alb' => 'Sterge albumul',
        'del_user' => 'Sterge utilizatorul',
        'err_unknown_user' => 'Utilizatorul selectat nu exista !',
        'comment_deleted' => 'Comentariul a fost sters cu succes',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Sunteti sigur ca doriti sa STERGETI aceasta imagine ? \\nComentariile vor fi de asemenea sterse.',
        'del_pic' => 'STERGE ACEASTA IMAGINE',
        'size' => '%s x %s pixeli',
        'views' => '%s ori',
        'slideshow' => 'Diaporama',
        'stop_slideshow' => 'OPRESTE DIAPORAMA',
        'view_fs' => 'Click pentru a vedea imaginea la dimensiuni originale',
        );

    $lang_picinfo = array('title' => 'Informatii despre imagine',
        'Filename' => 'Nume fisier',
        'Album name' => 'Nume album',
        'Rating' => 'Apreciere (%s voturi)',
        'Keywords' => 'Cuvinte cheie',
        'File Size' => 'Dimensiune fisier',
        'Dimensions' => 'Dimensiune imagine',
        'Displayed' => 'Afisata',
        'Camera' => 'Camera',
        'Date taken' => 'Data fotografierii',
        'Aperture' => 'Apertura',
        'Exposure time' => 'Timp de expunere',
        'Focal length' => 'Focala',
        'Comment' => 'Comentariu',
        'addFav' => 'Adauga in Favorite',

        'addFavPhrase' => 'Favorite',

        'remFav' => 'Sterge din Favorite',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Editeaza acest comentariu',
        'confirm_delete' => 'Sunteti sigur ca doriti sa stergeti acest comentariu ?',
        'add_your_comment' => 'Adaugati comentariul dvs.',
        'name' => 'Nume',

        'comment' => 'Comentariu',

        'your_name' => 'Anonim',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Click pe imagine pentru a inchide fereastra',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Trimite o vedere electronica',
        'invalid_email' => '<strong>Atentie</strong> : adresa email incorecta !',
        'ecard_title' => 'O vedere electronica de la %s pentru dvs.',
        'view_ecard' => 'Daca vederea nu este afisata corect da-ti click pe aceasta legatura',
        'view_more_pics' => 'Click aici pentru a vedea mai multe imagini !',
        'send_success' => 'Vederea dvs. a fost trimisa',
        'send_failed' => 'Ne pare rau dar serverul nu poate trimite vederea dvs...',
        'from' => 'De la',
        'your_name' => 'Numele dvs.',
        'your_email' => 'Adresa dvs. e-mail',
        'to' => 'Catre',
        'rcpt_name' => 'Numele adresantului',
        'rcpt_email' => 'Adresa e-mail destinatie',
        'greetings' => 'Buna ziua',
        'message' => 'Mesaj',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Picture&nbsp;info',
        'album' => 'Album',
        'title' => 'Titlu',
        'desc' => 'Descriere',
        'keywords' => 'Cuvinte cheie',
        'pic_info_str' => '%sx%s - %sKB - %s afisari - %s voturi',
        'approve' => 'Aproba imaginea',
        'postpone_app' => 'Amana aprobarea',
        'del_pic' => 'Sterge imaginea',
        'reset_view_count' => 'Reseteaza contorul de afisari',
        'reset_votes' => 'Reseteaza voturile',
        'del_comm' => 'Sterge comentariile',
        'upl_approval' => 'Aprobare incarcari',
        'edit_pics' => 'Editeaza imagini',
        'see_next' => 'Arata imaginile urmatoare',
        'see_prev' => 'Arata imaginile precedente',
        'n_pic' => '%s imagini',
        'n_of_pic_to_disp' => 'Numarul de imagini care sa fie afisate',
        'apply' => 'Executa modificarile'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Numele grupului',
        'disk_quota' => 'Cota pe disc',
        'can_rate' => 'Poate aprecia imaginile',
        'can_send_ecards' => 'Poate trimite vederi',
        'can_post_com' => 'Poate posta comentarii',
        'can_upload' => 'Poate incarca imagini',
        'can_have_gallery' => 'Poate avea o galerie personala',
        'apply' => 'Executa modificarile',
        'create_new_group' => 'Creaza un grup nou',
        'del_groups' => 'Sterge grupul/grupurile selectat(e)',
        'confirm_del' => 'Atentie, cand stergeti un grup, utilizatorii apartinand acestui grup vor fi transferati in grupul \'Registered\' !\n\nSunteti sigur ca doriti sa continuati ?',
        'title' => 'Administreaza grupurile de utilizatori',
        'approval_1' => 'Aprobare Inreg. Pub. (1)',
        'approval_2' => 'Aprobare Inreg. Priv. (2)',
        'note1' => '<strong>(1)</strong> Incarcarea intr-un album public necesita aprobarea administratorului',
        'note2' => '<strong>(2)</strong> Incarcarea intr-un album apartinand utilizatorului necesita aprobarea administratorului',
        'notes' => 'Notes'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Bine ati venit !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Sunteti sigur ca doriti sa STERGETI acest album ? \\nToate imaginile si comentariile continute vor fi sterse de asemenea.',
        'delete' => 'STERGE',
        'modify' => 'PROPRIETATI',
        'edit_pics' => 'EDITARE IMAGINI',
        );

    $lang_list_categories = array('home' => 'Pagina principala',
        'stat1' => '<strong>[pictures]</strong> imagini in <strong>[albums]</strong> albume si <strong>[cat]</strong> categorii cu <strong>[comments]</strong> comentarii afisate de <strong>[views]</strong> ori',
        'stat2' => '<strong>[pictures]</strong> imagini in <strong>[albums]</strong> albume afisate de <strong>[views]</strong> ori',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<strong>[pictures]</strong> imagini in <strong>[albums]</strong> albume cu <strong>[comments]</strong> comentarii afisate de <strong>[views]</strong> ori'
        );

    $lang_list_users = array('user_list' => 'Lista utilizatorilor',
        'no_user_gal' => 'Nu exista galerii utilizator',
        'n_albums' => '%s album(e)',
        'n_pics' => '%s imagini'
        );

    $lang_list_albums = array('n_pictures' => '%s imagini',
        'last_added' => ', ultima adaugata la %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Modifica album %s',
        'general_settings' => 'Setaru generale',
        'alb_title' => 'Titlu album',
        'alb_cat' => 'Categoria albumului',
        'alb_desc' => 'Descrierea albumului',
        'alb_thumb' => 'Pictograma albumului',
        'alb_perm' => 'Permisiile acestui album',
        'can_view' => 'Albumul poate fi vazut de',
        'can_upload' => 'Vizitatorii pot incarca imagini',
        'can_post_comments' => 'Vizitatorii pot posta comentarii',
        'can_rate' => 'Vizitatorii pot aprecia imaginile',
        'user_gal' => 'Galeria utilizatorului',
        'no_cat' => '* Nici o categorie *',
        'alb_empty' => 'Albumul este gol',
        'last_uploaded' => 'Ultimile incarcate',
        'public_alb' => 'Toata lumea (album public)',
        'me_only' => 'Doar eu',
        'owner_only' => 'Proprietarul albumul doar (%s)',
        'groupp_only' => 'Membrii grupului \'%s\'',
        'err_no_alb_to_modify' => 'Nici un album pe care il puteti modifica in baza de date.',
        'update' => 'Modifca album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Ne pare rau dar ati votat deja aceasta imagine',
        'rate_ok' => 'Votul dvs. ',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Desi administratorii paginii {SITE_NAME} vor incerca sa stearga sau sa editeze orice material nepermis sau obscen cat de repede cu putinta, este imposibil sa fie verificat fiecare mesaj sau comentariu. De aceea sunteti de acord ca toate mesajele postate pe acest sit exprima opiniile autorului si nu al administratorilor (excepand mesajele transmise de ei) si deci nu pot fi trasi la raspundere.<br />
<br />
Sunteti de acord sa nu postati nici un mesaj obscen, vulgar, amenintator, cu orientare sexuala sau orice alt mesaj ce incalca legile. Sunteti de acord ca administratorul si moderatorii site-ului {SITE_NAME} au dreptul sa modifice sau sa stearga orice continut oricand considera ei necesar. Ca utilizator sunteti de acord ca orice informatie introdusa mai sus va fi stocata intr-o baza de date. Desi aceasta informatie nu va fi oferita unei terte parti administratorii nu pot fi facut responsabili in cazul unei accesari fortate, ilegale a bazaei de date ce ar duce la compromiterea acesteia. <br />
<br />
Acest sit foloseste cookie-uri pentru a stoca informatie pe computerul dvs. Acestea servesc doar la buna functionare a sit-ului. Adresa dvs. e-mail este folosita doar pentru a verifica parola si procesul de inregistrare. <br />
<br />
Dand click pe butonul 'Sunt de acord' de mai jos sunteti de acord sa respectati si acceptati conditiile de mai sus.
EOT;

    $lang_register_php = array('page_title' => 'Inregistrare utilizator',
        'term_cond' => 'Termeni si conditii',
        'i_agree' => 'Sunt de acord',
        'submit' => 'Trimite inregistrarea',
        'err_user_exists' => 'Numele utilizator ales exista deja, va rugam sa alegeti altul',
        'err_password_mismatch' => 'Cele doua parole nu sunt identice, va rugam sa le re-introduceti',
        'err_uname_short' => 'Numele utilizator trebuie sa aiba minim 2 caractere',
        'err_password_short' => 'Parola trebuie sa aiba minim 2 caractere',
        'err_uname_pass_diff' => 'Numele utilizator si parola trebuie sa fie diferite',
        'err_invalid_email' => 'Adresa e-mail este incorecta',
        'err_duplicate_email' => 'Alt utilizator este inregistrat deja cu aceasta adresa e-mail',
        'enter_info' => 'Introduceti datele pentru inregistrare',
        'required_info' => 'Informatii necesare',
        'optional_info' => 'Informatii optionale',
        'username' => 'Utilizator',
        'password' => 'Parola',
        'password_again' => 'Confirmati parola',
        'email' => 'Email',
        'location' => 'Locatie',
        'interests' => 'Interese',
        'website' => 'Pagina web',
        'occupation' => 'Ocupatie',
        'error' => 'ERROARE',
        'confirm_email_subject' => '%s - Confirmarea inregistrarii',
        'information' => 'Informatii',
        'failed_sending_email' => 'Mesajul de confirmare a inregistrarii nu poate fi trimis !',
        'thank_you' => 'Va multumim pentru ca v-ati inregistrat.<br /><br />Un email continand informatii despre cum sa activati contul dvs. a fost trimis la adresa e-mail specificata.',
        'acct_created' => 'Contul dvs. a fost creat si va puteti loga cu contul si parola dvs.',
        'acct_active' => 'Contul dvs. este acum activ si va puteti loga cu contul si parola dvs.',
        'acct_already_act' => 'Contul dvs. este deja activ !',
        'acct_act_failed' => 'This account can\'t be activated !',
        'err_unk_user' => 'Utilizatorul selectat nu exista !',
        'x_s_profile' => 'Profilul lui %s',
        'group' => 'Grup',
        'reg_date' => 'Inregistrat la',
        'disk_usage' => 'Utilizare disc',
        'change_pass' => 'Schimbare parola',
        'current_pass' => 'Parola curenta',
        'new_pass' => 'Parola noua',
        'new_pass_again' => 'Reintroduceti parola noua',
        'err_curr_pass' => 'Parola curenta este incorecta',
        'apply_modif' => 'Executa modificarile',
        'change_pass' => 'Schimba parola mea',
        'update_success' => 'Profilul dumneavoastra a fost modificat',
        'pass_chg_success' => 'Parola dumneavoastra a fost schimbata',
        'pass_chg_error' => 'Parola dumneavoastra nu a fost schimbata',
        );

    $lang_register_confirm_email = <<<EOT
Va multumim ca v-ati inregistrat la {SITE_NAME}

Contul dvs. este : "{USER_NAME}"
Parola dvs. este : "{PASSWORD}"

Pentru a activa contul dvs. va rugam sa dati click pe legatura de mai jos
sau sa o copiati si lipiti in navigatorul dvs. de internet.

{ACT_LINK}

Cu stima,

Conducerea {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Revizuire comentarii',
        'no_comment' => 'Nu exista comentarii care sa fie revizuite',
        'n_comm_del' => '%s comentarii sterse',
        'n_comm_disp' => 'Numarul de comentarii de afisat',
        'see_prev' => 'Afiseaza precedentul',
        'see_next' => 'Afiseaza urmatorul',
        'del_comm' => 'Sterge comentariile selectate',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Cauta in colectia de imagini',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Cauta imagini noi',
        'select_dir' => 'Selecteaza directorul',
        'select_dir_msg' => 'Aceasta functie va permite sa adaugati mai multe imagini o data, imagini incarcate de dvs. pe server prin FTP.<br /><br />Selectati directorul unde ati incarcat imaginile',
        'no_pic_to_add' => 'Nu exista nici o imagine de adaugat',
        'need_one_album' => 'Aveti nevoie de cel putin un album pentru a folosi aceasta functie',
        'warning' => 'Atentie',
        'change_perm' => 'scriptul nu poate scrie in acest director, trebuie sa schimbati modul la 755 sau 777 inainte de a incerca sa adaugati imaginile !',
        'target_album' => '<strong>Pune imaginile din &quot;</strong>%s<strong>&quot; in </strong>%s',
        'folder' => 'Director',
        'image' => 'Imagine',
        'album' => 'Album',
        'result' => 'Rezultat',
        'dir_ro' => 'Nu poate fi scris. ',
        'dir_cant_read' => 'Nu poate fi citit. ',
        'insert' => 'Adauga imagini noi in galerie',
        'list_new_pic' => 'Lista noilor imagini',
        'insert_selected' => 'Insereaza imaginile selectate',
        'no_pic_found' => 'Nu a fost gasita nici o imagine noua',
        'be_patient' => 'Va rugam asteptati, scriptul necesita timp pentru a procesa imaginile',
        'notes' => '<ul>' . '<li><strong>OK</strong> : inseamna ca imaginea a fost adaugata cu succes' . '<li><strong>DP</strong> : inseamna ca imaginea este un duplicat si exista deja in baza de date' . '<li><strong>PB</strong> : inseamna ca imaginea nu a putut fi adaugat, verificati configuratia si permisiile directoarelor un imaginile sunt stocate' . '<li>Daca \'semnele\' OK, DP, PB nu apar, dati click pe icoana de imagine defecta pentru a verifica mesajele de eroare produse de PHP' . '<li>Daca navigatorul dvs. raporteaza \'timeout\', apasati butonul de reincarcare a paginii' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  //not used in cpg1.2.0-nuke
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Incarca o imagine',
        'max_fsize' => 'Dimensiunea maxima a fisierului este %s KB',
        'album' => 'Album',
        'picture' => 'Imagine',
        'pic_title' => 'Titlul imaginii',
        'description' => 'Descrierea imaginii',
        'keywords' => 'Cuvinte cheie (separate cu spatii)',
        'err_no_alb_uploadables' => 'Ne pare rau, dar nu exista nici un album unde puteti incarca imagini',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Administrare utilizatori',
        'name_a' => 'Nume ascendent',
        'name_d' => 'Nume descendent',
        'group_a' => 'Grup ascendent',
        'group_d' => 'Grup descendent',
        'reg_a' => 'Data inregistrarii ascendent',
        'reg_d' => 'Data inregistrarii descendent',
        'pic_a' => 'Numar imagini ascendent',
        'pic_d' => 'Numar imagini descendent',
        'disku_a' => 'Utilizare spatiu ascendent',
        'disku_d' => 'Utilizare spatiu descendent',
        'sort_by' => 'Sorteaza utilizatorii dupa',
        'err_no_users' => 'Tabelul cu utilizatori este gol !',
        'err_edit_self' => 'Nu puteti edita propriul profil. Folositi optiunea \'Profilul meu\' pentru aceasta',
        'edit' => 'EDITEAZA',
        'delete' => 'STERGE',
        'name' => 'Nume utilizator',
        'group' => 'Grup',
        'inactive' => 'Inactiv',
        'operations' => 'Operatii',
        'pictures' => 'Imagini',
        'disk_space' => 'Spatiu utilizat / Cota',
        'registered_on' => 'Inregistrat la',
        'u_user_on_p_pages' => '%d utilizatori pe %d pagini',
        'confirm_del' => 'Sunteti sigur ca doriti sa STERGETI acest utilizator ? \\nToate imaginile si albumele sale vor fi de asemenea sterse',
        'mail' => 'POSTA',
        'err_unknown_user' => 'Utilizatorul selectat nu exista !',
        'modify_user' => 'Modifica utilizatorul',
        'notes' => 'Note',
        'note_list' => '<li>Daca nu doriti sa schimbati parola, lasati campurile "Parola" libere',
        'password' => 'Parola',
        'user_active' => 'Utilizatorul este activ',
        'user_group' => 'Grup utilizatori',
        'user_email' => 'E-mail',
        'user_web_site' => 'Pagina web',
        'create_new_user' => 'Creaza utilizator nou',
        'user_from' => 'Locatie',
        'user_interests' => 'Interese',
        'user_occ' => 'Ocupatie',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Redimensioneaza imagini',

        'what_it_does' => 'Ce face',

        'what_update_titles' => 'Modifica titlurile dupa numele fisier',

        'what_delete_title' => 'Sterge titlurile',

        'what_rebuild' => 'Reconstruieste pictogramele si imaginile intermediare',

        'what_delete_originals' => 'Sterge imaginile dimensionate initial, inlocuindu-le cu versiunea dimensionata',

        'file' => 'Fisier',

        'title_set_to' => 'titlu setat ca',

        'submit_form' => 'trimite',

        'updated_succesfully' => 'modificata cu succes',

        'error_create' => 'ERROARE creeare',

        'continue' => 'Proceseaza mai multe imagini',

        'main_success' => 'Fisierul %s a fost folosit cu succes ca imagine principala',

        'error_rename' => 'Erroare redenumire %s cu %s',

        'error_not_found' => 'Fisierul %s nu a fost gasit',

        'back' => 'inapoi la principal',

        'thumbs_wait' => 'Modificare pictograme si/sau imagini intermediare, va rugam asteptati...',

        'thumbs_continue_wait' => 'Continua sa modifica pictograme si/sau imaginile intermediare...',

        'titles_wait' => 'Modifica titluri, va rugam asteptati...',

        'delete_wait' => 'Stergere titluri, va rugam asteptati...',

        'replace_wait' => 'Sterge originalele si le modifica cu versiunile redimensionate, va rugam asteptati...',

        'instruction' => 'Instructiuni rapide',

        'instruction_action' => 'Selecteaza o actiune',

        'instruction_parameter' => 'Seteaza parametrii',

        'instruction_album' => 'Selecteaza album',

        'instruction_press' => 'Apasa %s',

        'update' => 'Modifica pictograme si/sau imagini intermediare',

        'update_what' => 'Ce trebuie modificat',

        'update_thumb' => 'Doar pictograme',

        'update_pic' => 'Doar imaginile intermediare',

        'update_both' => 'Amandoua',

        'update_number' => 'Numarul de imagini procesate per click',

        'update_option' => '(Incercati o setare mai mica daca experimentati timeout-uri)',

        'filename_title' => 'Nume fisier &rArr; Titlu imagine',

        'filename_how' => 'Cum trebuie modificat titlul',

        'filename_remove' => 'Elimina .jpg din final si inlocuieste _ (liniuta de subliniere) cu spatii',

        'filename_euro' => 'Schimba 2003_11_23_13_20_20.jpg cu 23/11/2003 13:20',

        'filename_us' => 'Schimba 2003_11_23_13_20_20.jpg cu 11/23/2003 13:20',

        'filename_time' => 'Schimba 2003_11_23_13_20_20.jpg cu 13:20',

        'delete' => 'Sterge titlurile sau imaginile originale',

        'delete_title' => 'Sterge titlurile imaginilor',

        'delete_original' => 'Sterge imaginile originale',

        'delete_replace' => 'Sterge originalele, inlocuindu-le cu versiunile dimensionata',

        'select_album' => 'Selecteaza album',

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