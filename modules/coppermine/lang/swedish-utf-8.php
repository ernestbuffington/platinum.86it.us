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
define('PIC_VOTES', 'Röster');
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
    'Sön', 'Mån', 'Tis', 'Ons', 'Tors', 'Fre', 'Lör');
$lang_month = array(
    'Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Ja';
$lang_no = 'Nej';
$lang_back = 'TILLBAKA';
$lang_continue = 'FORTSÄTT';
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
    '*knulla*', 'fitta', 'arsle', 'kuk', 'mutta', 'fan', 'helvete', 'blatte', 'nigger', 'svarting', 'nasse', 'röv', 'ollon', 'dildo', 'fanculo', 'pattar', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Slumpmässiga bilder',
    'lastup' => 'Senast inlagda',
    'lastupby' => 'Mina Senaste Bidrag', // new 1.2.2
    'lastalb' => 'Senaste uppdaterade album',
    'lastcom' => 'Senaste kommentarer',
    'lastcomby' => 'Mina Senaste kommentarer', // new 1.2.2
    'topn' => 'Mest visade',
    'toprated' => 'Topplista',
    'lasthits' => 'Senast visat',
    'search' => 'Sökresultat',
    'favpics' => 'Favoritbilder'
    );

$lang_errors = array('access_denied' => 'Du har inte rättigheter till den här sidan.',
    'perm_denied' => 'Du har inte tillåtelse att göra den här operationen.',
    'param_missing' => 'Skript startat utan rätt parameter(ar).',
    'non_exist_ap' => 'Det valda albumet/bilden finns inte !',
    'quota_exceeded' => 'Diskkvoten övertrasserad<br /><br />Du har en diskkvot på [quota]K, din bild är på [space]K, att lägga till den här bilden gör att du övertrasserar diskkvoten.',
    'gd_file_type_err' => 'Vid användande av GD image library, så är endast JPEG- och PNG-format tillåtna.',
    'invalid_image' => 'Bilden du laddade upp är skadad eller kan inte hanteras av GD library',
    'resize_failed' => 'Kan inte skapa miniatyrbild eller förändra bildstorleken.',
    'no_img_to_display' => 'Ingen bild att visa',
    'non_exist_cat' => 'Den valda kategorin finns inte',
    'orphan_cat' => 'En kategori har en s.k. non-existing parent, kör kategorihanteraren för att rätta till problemet.',
    'directory_ro' => 'Biblioteket \'%s\' är inte skrivbart, bilden kan inte raderas',
    'non_exist_comment' => 'Den valda kommentaren finns inte.',
    'pic_in_invalid_album' => 'Bilden är i ett icke existerande album (%s)!?',
    'banned' => 'Du är för tillfället blockerad från den här sajten.',
    'not_with_udb' => 'Den här funktionen är inaktiverad i Coppermine för att den är integrerad med forumets mjukvara. Vad du än försöker göra så stöds det inte i den här konfigurationen, eller så ska funktionen skötas av forumets mjukvara.',
    'members_only' => 'Denna funktion är för medlemmar enbart, anslut dig.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'Denna funktion är enbart för sajtens admin. Du måste vara inloggad som superadmin, god konto för att accessa denna funktion'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Gå till albumlistan',
    'alb_list_lnk' => 'Albumlista',
    'my_gal_title' => 'Gå till mitt privata galleri',
    'my_gal_lnk' => 'Mitt galleri',
    'my_prof_lnk' => 'Min profil',
    'adm_mode_title' => 'Växla till adminläge',
    'adm_mode_lnk' => 'Adminläge',
    'usr_mode_title' => 'Växla till användarläge',
    'usr_mode_lnk' => 'Användarläge',
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
    'search_lnk' => 'Sök',
    'fav_lnk' => 'Mina Favoriter',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Klara för publicering',
    'config_lnk' => 'Konfigurera',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'Kategorier',
    'users_lnk' => 'Användare',
    'groups_lnk' => 'Grupper',
    'comments_lnk' => 'Kommentarer',
    'searchnew_lnk' => 'Lägg till ett parti av bilder',
    'util_lnk' => 'Ändra storlek på bilden', //not used yet
    'ban_lnk' => 'Blockera användare',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Skapa / sortera mina album',
    'modifyalb_lnk' => 'Ändra i mina album',
    'my_prof_lnk' => 'Min profil',
    );

$lang_cat_list = array('category' => 'Kategori',
    'albums' => 'Album',
    'pictures' => 'Bilder',
    );

$lang_album_list = array('album_on_page' => '%d album på %d sida(or)'
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
    'pic_on_page' => '%d bilder på %d sida(or)',
    'user_on_page' => '%d användare på %d sida(or)',
    'sort_ra' => 'Sortera efter värdering stigande', // new in cpg1.2.0nuke
    'sort_rd' => 'Sortera efter värdering fallande', // new in cpg1.2.0nuke
    'rating' => 'V�?RDERING', // new in cpg1.2.0nuke
    'sort_title' => 'Sortera bilder efter:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Återvänd till miniatyrbildsida',
    'pic_info_title' => 'Visa/dölj bild information',
    'slideshow_title' => 'Bildspel',
    'slideshow_disabled' => 'e-vykort är avslaget', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['medlemmar enbart'], // new in cpg1.2.0nuke
    'ecard_title' => 'Skicka den här bilden som ett e-vykort',
    'ecard_disabled' => 'e-vykort är inaktiverat',
    'ecard_disabled_msg' => 'Du har inte rättigheter att skicka e-vykort',
    'prev_title' => 'Se föregående bild',
    'next_title' => 'Se nästa bild',
    'pic_pos' => 'BILD %s/%s',
    'no_more_images' => 'Det finns inte fler bilder i detta galleri', // new in cpg1.2.0nuke
    'no_less_images' => 'Detta är första bilden i galleriet', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Betygsätt den här bilden ',
    'no_votes' => '(Ingen röst än)',
    'rating' => '(nuvarande betyg : %s / 5 från %s röster)',
    'rubbish' => 'Skräp',
    'poor' => 'Kass',
    'fair' => 'Godkänd',
    'good' => 'Bra',
    'excellent' => 'Mycket bra',
    'great' => 'Bäst',
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
    'n_votes' => '(%s röster)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Exclamation',
        'Question' => 'Fråga',
        'Very Happy' => 'Mycket glad',
        'Smile' => 'Smil',
        'Sad' => 'Ledsen',
        'Surprised' => 'Överraskad',
        'Shocked' => 'Kvävd',
        'Confused' => 'Förbryllad',
        'Cool' => 'Cool',
        'Laughing' => 'Skrattande',
        'Mad' => 'Galen',
        'Razz' => 'Razz',
        'Embarassed' => 'Förlägen',
        'Crying or Very sad' => 'Gråter eller Mycket ledsen',
        'Evil or Very Mad' => 'Elak eller mycket arg',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rullande ögon',
        'Wink' => 'Blink',
        'Idea' => 'Idé',
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
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Lämnar admin läge...',
        1 => 'Startar admin läge...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Album måste namnges!',
        'confirm_modifs' => 'Är du säker på att du vill göra dessa förändringar?',
        'no_change' => 'Du gjorde ingen förändring!',
        'new_album' => 'Nytt album',
        'confirm_delete1' => 'Är du säker att du vill radera detta album?',
        'confirm_delete2' => '\nAlla bilder och dess kommentarer kommer att förloras!',
        'select_first' => 'Välj ett album först',
        'alb_mrg' => 'Albumhanterare',
        'my_gallery' => '* Mitt galleri *',
        'no_category' => '* Ingen kategori *',
        'delete' => 'Radera',
        'new' => 'Nytt',
        'apply_modifs' => 'Verkställ förändringar',
        'select_category' => 'Välj kategori',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametrar som krävs för \'%s\'operationen stöds inte!',
        'unknown_cat' => 'Giltig kategori finns inte i databasen',
        'usergal_cat_ro' => 'Kategorin Användargalleri kan inte raderas!',
        'manage_cat' => 'Inställningar för kategorier',
        'confirm_delete' => 'Är du säker att du vill RADERA denna kategori',
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
        'restore_cfg' => 'Återställ systemets grundinställningar',
        'save_cfg' => 'Spara ny konfiguration',
        'notes' => 'Anm.',
        'info' => 'Information',
        'upd_success' => 'Coppermine konfigurationen uppdaterades',
        'restore_success' => 'Coppermines grundinställning återskapades',
        'name_a' => 'Namn stigande',
        'name_d' => 'Namn fallande',
        'title_a' => 'Titel stigande',
        'title_d' => 'Titel fallande',
        'date_a' => 'Datum stigande',
        'date_d' => 'Datum fallande',
        'rating_a' => 'Värdering stigande', // new in cpg1.2.0nuke
        'rating_d' => 'Värdering fallande', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspekt',
        'th_ht' => 'Höjd',
        'th_wd' => 'Vidd',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Generella inställningar',
        array(
            'Galleri namn', 'gallery_name', 0),
        array(
            'Galleri beskrivning', 'gallery_description', 0),
        array(
            'Galleri administratör e-post', 'gallery_admin_email', 0),
        array(
            'Adress till nukemapp dvs http://www.mysite.tld/html/', 'ecards_more_pic_target', 0),
        array(
            'Språk', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array(
            'Sid Specifika Titlar istället för >Coppermine', 'nice_titles', 1), 
        array('Visa block till höger', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Utseende för albumlista',
        array(
            'Bredd på huvudtabell (pixlar eller %)', 'main_table_width', 0),
        array(
            'Antal underkategorier att visa', 'subcat_level', 0),
        array(
            'Antal album att visa', 'albums_per_page', 0),
        array(
            'Antal kolumner i albumlista', 'album_list_cols', 0),
        array(
            'Storlek på miniatyrbilder i pixlar', 'alb_list_thumb_size', 0),
        array(
            'Innehåll på huvudsidan', 'main_page_layout', 0),
        array(
            'Visa första underkategorins miniatyrbilder i kategorierna', 'first_level', 1), 
        // 'Thumbnail view',
        'Utseende för miniatyrbildsfunktion',
        array(
            'Antal kolumner på miniatyrbildssida', 'thumbcols', 0),
        array(
            'Antal rader på miniatyrbildssida', 'thumbrows', 0),
        array(
            'Max antal flikar att visa', 'max_tabs', 0),
        array(
            'Visa bildrubrik (inkl. titel) nedanför miniatyrbild', 'caption_in_thumbview', 1),
        array(
            'Visa antalet kommentarer under miniatyrbild', 'display_comment_count', 1),
        array(
            'Grundinställning för sortering av bilder', 'default_sort_order', 3),
        array(
            'Minimum antal röster för en bild för att det ska synas i \'topplistan\' ', 'min_votes_for_rating', 0),
        array(
            'Alts och titeltaggar av miniatyrbild visar titel och nyckelord istället för bildinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Utseende för bilder &amp; inställningar för kommentarer',
        array(
            'Tabellbredd för bildvisning (pixlar eller %)', 'picture_table_width', 0),
        array(
            'Bildinformation är synlig som grundinställning', 'display_pic_info', 1),
        array(
            'Filtrera fula ord i kommentarer', 'filter_bad_words', 1),
        array(
            'Tillåt smilies i kommentarer', 'enable_smilies', 1),
        array(
            'Tillåt flera påföljande kommentarer om en bild från samma användare', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'E-posta sajtens admin vid kommentarbidrag' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Max längd på bildbeskrivning', 'max_img_desc_length', 0),
        array(
            'Max antal tecken i ett ord', 'max_com_wlength', 0),
        array(
            'Max antal på rader i en kommentar', 'max_com_lines', 0),
        array(
            'Max längd på en kommentar', 'max_com_size', 0),
        array(
            'Visa filmsekvens', 'display_film_strip', 1),
        array(
            'Antal objekt i en filmsekvens', 'max_film_strip_items', 0),
        array(
            'Tillåt visning av bilder i full storlek av anonym', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
        // 'Pictures and thumbnails settings',
        'Bild- och miniatyrbildsinställningar',
        array(
            'Kvalitet på JPEG filer', 'jpeg_qual', 0),
        array(
            'Max dimension på en miniatyrbild <strong>*</strong>', 'thumb_width', 0),
        array(
            'Använda dimensioner (bredd eller höjd eller Maxstorlek för miniatyrbild)<strong>*</strong>', 'thumb_use', 7),
        array(
            'Skapa mellanliggande bilder', 'make_intermediate', 1),
        array(
            'Max bredd eller höjd på en mellanliggande bild <strong>*</strong>', 'picture_width', 0),
        array(
            'Max storlek för uppladdade bilder (KB)', 'max_upl_size', 0),
        array(
            'Max bredd eller höjd för uppladdade bilder (pixlar)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Användarinställningar',
        array(
            'Tillåt nya användare att registreras', 'allow_user_registration', 1),
        array(
            'Användarregistrering kräver e-postverifiering', 'reg_requires_valid_email', 1),
        array(
            'Tillåt två användare att ha samma e-postadress', 'allow_duplicate_emails_addr', 1),
        array(
            'Användare kan ha privata album', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
        // 'Custom fields for image description (leave blank if unused)',
        'Valfria fält för bildbeskrivningar (lämna blankt om du inte vill använda funktionen)',
        array(
            'Fält 1 namn', 'user_field1_name', 0),
        array(
            'Fält 2 namn', 'user_field2_name', 0),
        array(
            'Fält 3 namn', 'user_field3_name', 0),
        array(
            'Fält 4 namn', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Avancerade inställningar för bilder och miniatyrbilder',
        array(
            'Visa ikon för privata album för ej inloggade användare', 'show_private', 1),
        array(
            'Förbjudna tecken i filnamn', 'forbiden_fname_char', 0),
        array(
            'Accepterade filändelser för uppladdade bilder', 'allowed_file_extensions', 0),
        array(
            'Metod för ändra bildstorleksförändring', 'thumb_method', 2),
        array(
            'Sökväg till ImageMagick \'konverterings\' funktion (exempel /usr/bin/X11/)', 'impath', 0),
        array(
            'Tillåtna bildformat (gäller endast för ImageMagick)', 'allowed_img_types', 0),
        array(
            'Kommandolinjeval för ImageMagick', 'im_options', 0),
        array(
            'Läs EXIF data i JPEG filer', 'read_exif_data', 1),
        array(
            'Läs IPTC data i JPEG filer', 'read_iptc_data', 1),
        array(
            'Albumbibliotek <strong>*</strong>', 'fullpath', 0),
        array(
            'Bibliotek för användarnas bilder <strong>*</strong>', 'userpics', 0),
        array(
            'Prefix för mellanliggande bilder <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefix för miniatyrbilder <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Standardläge för bibliotek', 'default_dir_mode', 0),
        array(
            'Standardläge för bilder', 'default_file_mode', 0),
        array(
            'Bildinfo visa filnamn', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa albumnamn', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa_filstorlek', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa dimensioner', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa summa visningar', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa URL som bokmärkeslänk', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array(
            'Bildinfo visa favvo albumlvänk', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        // 'Cookies &amp; Charset settings',
        'Inställningar för cookies &amp; teckenkodning',
        array(
            'Namn på cookie som scriptet använder sig av', 'cookie_name', 0),
        array(
            'Sökväg till cookie som scriptet använder sig av', 'cookie_path', 0),
        array(
            'Teckenkodning', 'charset', 4),
        // 'Miscellaneous settings',
        'Övriga inställningar',
        array(
            'Aktivera debuggläge', 'debug_mode', 1),
        array(
'Slå på avancerat debuggläge', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Visa Coppermine Uppdatering Varning för Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Fält märkta med * får INTE ändras om du redan har bilder i ditt galleri</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Du måste skriva ditt namn och en kommentar',
        'com_added' => 'Din kommentar är inlagd',
        'alb_need_title' => 'Du måste ge albumet en titel!',
        'no_udp_needed' => 'Ingen uppdatering behövs.',
        'alb_updated' => 'Album uppdaterades',
        'unknown_album' => 'Valt album existerar inte eller så har du inte rättigheter att ladda upp i detta album',
        'no_pic_uploaded' => 'Ingen bild laddades upp!<br /><br />Om du är säker på att du valt en bild för uppladdning, kontrollera att servern tillåter uppladdning...',
        'err_mkdir' => 'Misslyckades att skapa biblioteket %s !',
        'dest_dir_ro' => 'Målbiblioteket %s är inte skrivbart av scriptet!',
        'err_move' => 'Omöjligt att flytta %s till %s !',
        'err_fsize_too_large' => 'Bildstorleken du laddat upp är för stor (max tillåtet är %s x %s) !',
        'err_imgsize_too_large' => 'Storleken på filen du laddat upp är för stor (max tillåtet är %s KB) !',
        'err_invalid_img' => 'Filen du laddat upp är inte i tillåtet format!',
        'allowed_img_types' => 'Du kan bara ladda upp %s bilder.',
        'err_insert_pic' => 'Bilden \'%s\' kan inte infogas i albumet ',
        'upload_success' => 'Din bild laddades upp utan problem<br /><br />Den kommer att bli synlig efter att admin godkänt den.',
        'info' => 'Information',
        'com_added' => 'Kommentar inlagd',
        'alb_updated' => 'Album uppdaterat',
        'err_comment_empty' => 'Din kommentar är tom!',
        'err_invalid_fext' => 'Endast filer med följande ändelser är tillåtna: <br /><br />%s.',
        'no_flood' => 'Ledsen men du är redan författare av den senaste kommentaren som är inlagd för den här bilden<br /><br />Ändra den redan inlagda kommentaren om du vill ämdra något',
        'redirect_msg' => 'Du förflyttas.<br /><br /><br /Klicka \'FORTSÄTT\' om inte sidan uppdateras automatiskt',
        'upl_success' => 'Din bild infogades utan problem.',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Rubrik',
        'fs_pic' => 'full storlek på bild',
        'del_success' => 'Radering lyckades',
        'ns_pic' => 'normal storlek på bild',
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
        'del_user' => 'Radera användare',
        'err_unknown_user' => 'Vald användare finns inte!',
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
    $lang_display_image_php = array('confirm_del' => 'Är du säker på att du vill RADERA denna bild? \\nComments will also be deleted.',
        'del_pic' => 'RADERA DENNA BILD',
        'size' => '%s x %s pixlar',
        'views' => '%s gånger',
        'slideshow' => 'Bildspel',
        'stop_slideshow' => 'STOPPA BILDSPEL',
        'view_fs' => 'Klicka för att se fullstorlek på bilden',
        'edit_pic' => 'REDIGERA BILD INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Bildinformation',
        'Filename' => 'Filnamn',
        'Album name' => 'Albumnamn',
        'Rating' => 'Betyg (%s röster)',
        'Keywords' => 'Nyckelord',
        'File Size' => 'Filstorlek',
        'Dimensions' => 'Dimensioner',
        'Displayed' => 'Visat',
        'Camera' => 'Kamera',
        'Date taken' => 'Datum för fototillfälle',
        'Aperture' => 'Slutare',
        'Exposure time' => 'Exponeringstid',
        'Focal length' => 'Focallängd',
        'Comment' => 'Kommentar',
        'addFav' => 'Lägg till Fav',
        'addFavPhrase' => 'Favoriter',
        'remFav' => 'Ta bort från Fav',
        'iptcTitle' => 'IPTC Titel', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Nyckelord', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Kategori', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Underkategori', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bokmärkes Bild', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Redigera denna kommentar',
        'confirm_delete' => 'Är du säker på att du vill radera denna kommentar?',
        'add_your_comment' => 'Lägg till din kommentar',
        'name' => 'Namn',
        'comment' => 'Kommentar',
        'your_name' => 'Anonym',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Klicka på bilden för att stänga det här fönstret',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Skicka ett e-vykort',
        'invalid_email' => '<strong>Varning</strong> : felaktig e-postadress !',
        'ecard_title' => 'Ett e-vykort från %s till dig!',
        'view_ecard' => 'Klicka på den här länken om inte e-vykortet visas riktigt',
        'view_more_pics' => 'Klicka på den här länken för att se fler bilder!',
        'send_success' => 'Ditt e-vykort skickades',
        'send_failed' => 'Ledsen men servern kan inte skicka ditt e-vykort...',
        'from' => 'Från',
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
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Bild&nbsp;info',
        'album' => 'Album',
        'title' => 'Titel',
        'desc' => 'Beskrivning',
        'keywords' => 'Nyckelord',
        'pic_info_str' => '%sx%s - %sKB - %s visningar - %s röster',
        'approve' => 'Godkänn bild',
        'postpone_app' => 'Senarelägg godkännande',
        'del_pic' => 'Radera bild',
        'reset_view_count' => 'Nollställ räknare för bildbesökare',
        'reset_votes' => 'Nollställ röster',
        'del_comm' => 'Radera kommentarer',
        'upl_approval' => 'Godkännande för uppladdning',
        'edit_pics' => 'Redigera bilder',
        'see_next' => 'Se kommande bild',
        'see_prev' => 'Se föregående bilder',
        'n_pic' => '%s bilder',
        'n_of_pic_to_disp' => 'Antal bilder att visa',
        'apply' => 'Verkställ förändringar'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Grupp namn',
        'disk_quota' => 'Diskkvot',
        'can_rate' => 'Kan betygsätta bilder',
        'can_send_ecards' => 'Kan skicka e-vykort',
        'can_post_com' => 'Kan skriva kommentarer',
        'can_upload' => 'Kan ladda upp bilder',
        'can_have_gallery' => 'Kan ha ett personligt galleri',
        'apply' => 'Verkställ förändringar',
        'create_new_group' => 'Skapa ny grupp',
        'del_groups' => 'Radera vald grupp(er)',
        'confirm_del' => 'Varning, när du raderar en grupp kommer användare i den gruppen att flyttas till gruppen \'Registrerad\' !\n\nVill du fortsätta ?',
        'title' => 'Behandla användargrupper',
        'approval_1' => 'Pub. Uppl. godkännande (1)',
        'approval_2' => 'Priv. Uppl. godkännande (2)',
        'note1' => '<strong>(1)</strong> Uppladdningar i ett publikt album kräver godkännande från admin',
        'note2' => '<strong>(2)</strong> Uppladdningar i ett album som tillhör användare kräver godkännande från admin',
        'notes' => 'Anteckningar',
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Välkommen!'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Är du säker att du vill RADERA detta album? \\nAlla bilder och kommentarer kommer även att raderas.',
        'delete' => 'RADERA',
        'modify' => 'EGENSKAPER',
        'edit_pics' => 'REDIGERA BILDER',
        );

    $lang_list_categories = array('home' => 'Hem',
        'stat1' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album och <strong>[cat]</strong> kategorier med <strong>[comments]</strong> kommentarer visade <strong>[views]</strong> gånger',
        'stat2' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album visade <strong>[views]</strong> gånger',
        'xx_s_gallery' => '%s\'s Galleri',
        'stat3' => '<strong>[pictures]</strong> bilder i <strong>[albums]</strong> album med <strong>[comments]</strong> kommentarer visade <strong>[views]</strong> gånger'
        );

    $lang_list_users = array('user_list' => 'Användarlista',
        'no_user_gal' => 'Det finns inga användargallerier',
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
        'general_settings' => 'Generella inställningar',
        'alb_title' => 'Album titel',
        'alb_cat' => 'Album kategori',
        'alb_desc' => 'Album beskrivning',
        'alb_thumb' => 'Album miniatyrbild',
        'alb_perm' => 'Rättigheter för detta album',
        'can_view' => 'Album kan ses av',
        'can_upload' => 'Besökare kan ladda upp bilder',
        'can_post_comments' => 'Besökare kan kommentera',
        'can_rate' => 'Besökare kan betygsätta bilder',
        'user_gal' => 'Användargalleri',
        'no_cat' => '* Ingen kategori *',
        'alb_empty' => 'Album är tomt',
        'last_uploaded' => 'Senast uppladdat',
        'public_alb' => 'Alla (publikt album)',
        'me_only' => 'Endast jag',
        'owner_only' => 'Endast albumägare (%s)',
        'groupp_only' => 'Medlemmar av gruppen \'%s\'',
        'err_no_alb_to_modify' => 'Inget album att redigera i databasen.',
        'update' => 'Uppdatera album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Ledsen men du har redan betygsatt den här bilden',
        'rate_ok' => 'Din röst är registrerad',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Fastän administratörer på den här sajten (SITE_NAME) försöker att ta bort eller ändra allt störande eller stötande material så fort som möjligt, är det omöjligt att gå igenom alla meddelanden. Vi vill därför meddela dig om att alla inlägg som skrivits på de här forumet uttrycker vad författaren tänker och tycker, och administratörer inte skall stå till ansvar för det (förutom för det de själva lagt in).<br />
<br />
Du går med på att inte posta något störande, stötande, rasistiskt, sexistiskt, vulgärt, hatiskt, hotande eller något annat material som kan tänkas bryta mot någon tillämplig lag. Om du bryter mot det här kan det leda till att du blir permanent avstängd från forumen (och din Internet leverantör blir kontaktad). Ip adressen av alla meddelanden sparas för att stärka de här vilkoren. Du går med på att webmaster, administratör och moderatorer har rätt att ta bort, ändra, flytta eller stänga vilka inlägg som helst när som helst. Som en användare går du med på att all information som du skrivit in sparas i databasen. Den informationen kommer INTE att distribueras till någon 3:e part utan ditt samtycke. Webmastern, administratören eller moderatorer kan inte hållas ansvariga vid hackningsförsök som kan leda till att data stjäls. <br />
<br />
Det här systemet använder cookies till att spara information på din dator. Dessa cookies innehåller inte något av den information du skrivit in, utan används endast för att göra ditt användande av forumet bättre och smidigare. E-post adressen används bara för att aktivera din registrering, samt för omregistrering vid t.ex. byte av din e-post adress.<br />
<br />
Genom att klicka på knappen "Ja" nedan godkänner du villkoren ovan.

EOT;

    $lang_register_php = array('page_title' => 'Användarregistrering',
        'term_cond' => 'Användarvillkor',
        'i_agree' => 'Jag godkänner',
        'submit' => 'Skicka registrering',
        'err_user_exists' => 'Användarnamnet du skrev in finns redan, välj ett nytt',
        'err_password_mismatch' => 'Lösenorden stämmer inte med varandra, skriv in dem igen',
        'err_uname_short' => 'Användarnamnet måste vara minst 2 tecken långt',
        'err_password_short' => 'Lösenordet måste vara minst 2 tecken långt',
        'err_uname_pass_diff' => 'Användarnamn och lösenord får inte vara olika',
        'err_invalid_email' => 'E-postadressen är ogiltig',
        'err_duplicate_email' => 'En annan användare har redan registrerat den e-postadress du skrev',
        'enter_info' => 'Fyll i registreringsinformation',
        'required_info' => 'Obligatorisk information',
        'optional_info' => 'Valfri information',
        'username' => 'Användarnamn',
        'password' => 'Lösenord',
        'password_again' => 'Skriv lösenordet igen',
        'email' => 'E-post',
        'location' => 'Plats',
        'interests' => 'Intressen',
        'website' => 'Hemsida',
        'occupation' => 'Yrke',
        'error' => 'FEL',
        'confirm_email_subject' => '%s - Registreringsinformation',
        'information' => 'Information',
        'failed_sending_email' => 'Registreringsinformationen kan inte skickas!',
        'thank_you' => 'Tack för din registrering.<br /><br />Ett e-postmeddelande med information om hur du ska aktivera ditt konto skickades till den e-postadress du angav.',
        'acct_created' => 'Ditt konto har skapats och du kan nu logga in med ditt användarnamn och lösenord',
        'acct_active' => 'Ditt konto är nu aktivt och du kan nu logga in med ditt användarnamn och lösenord',
        'acct_already_act' => 'Ditt konto är redan aktiverat!',
        'acct_act_failed' => 'Detta konto kan inte aktiveras!',
        'err_unk_user' => 'Vald användare finns inte!',
        'x_s_profile' => '%s\'s profil',
        'group' => 'Grupp',
        'reg_date' => 'Blev medlem',
        'disk_usage' => 'Diskanvändning',
        'change_pass' => 'Byt lösenord',
        'current_pass' => 'Nuvarande lösenord',
        'new_pass' => 'Nytt lösenord',
        'new_pass_again' => 'Nytt lösenord igen',
        'err_curr_pass' => 'Detta lösenord är inte korrekt',
        'apply_modif' => 'Verkställ ändringar',
        'change_pass' => 'Ändra mitt lösenord',
        'update_success' => 'Din profil uppdaterades',
        'pass_chg_success' => 'Ditt lösenord ändrades',
        'pass_chg_error' => 'Ditt lösenord ändrades inte',
        );

    $lang_register_confirm_email = <<<EOT
Tack för att du registrerade dig på {SITE_NAME}

Ditt användarnamn är : "{USER_NAME}"
Ditt lösenord är : "{PASSWORD}"

För att ditt konto ska aktiveras måste du klicka på nedanstående länk
eller kopiera och klistra in den i din webbläsare.

{ACT_LINK}

Vänligen,

Administratören av {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Granska kommentarer',
        'no_comment' => 'Det finns ingen kommentar att granska',
        'n_comm_del' => '%s kommentar(er) raderade',
        'n_comm_disp' => 'Antal kommentarer att visa',
        'see_prev' => 'Se föregående',
        'see_next' => 'Se nästa',
        'del_comm' => 'Radera valda kommentarer',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Sök i bildkollektionen',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Sök efter nya bilder',
        'select_dir' => 'Välj bibliotek',
        'select_dir_msg' => 'Den här funktionen gör det möjligt att lägga till ett parti med foton som du laddat upp på servern via FTP.<br /><br />Välj biblioteket där bilderna finns.',
        'no_pic_to_add' => 'Det finns ingen bild att lägga till',
        'need_one_album' => 'Du måste minst ha ett album för att kunna använda denna funktion',
        'warning' => 'Varning',
        'change_perm' => 'scriptet kan inte skriva i detta bibliotek, du måste ändra rättigheterna i det till 755 eller 777 innan du kan lägga till bilder!',
        'target_album' => '<strong>Lägg bilderna &quot;</strong>%s<strong>&quot; i </strong>%s',
        'folder' => 'Mapp',
        'image' => 'Bild',
        'album' => 'Album',
        'result' => 'Resultat',
        'dir_ro' => 'Inte skrivbart. ',
        'dir_cant_read' => 'Inte läsbart. ',
        'insert' => 'Lägger till nya bilder i galleriet',
        'list_new_pic' => 'Förteckning på nya bilder',
        'insert_selected' => 'Sätt in valda bilder',
        'no_pic_found' => 'Ingen ny bild hittades',
        'be_patient' => 'Ha tålamod, scriptet behöver lite tid att bearbeta bilderna',
        'notes' => '<ul>' . '<li><strong>OK</strong> : betyder att bilden blev inlagd' . '<li><strong>DP</strong> : betyder att bilden är en kopia och redan finns i databasen' . '<li><strong>PB</strong> : betyder att bilden inte kunde läggas till, kontrollera din konfiguration och rättigheterna i biblioteken där bilderna ska placeras' . '<li>Om OK, DP, PB \'symbolen\' inte visas, klicka på den felaktiga bilden för att se felmeddelandet som skapats av PHP' . '<li>Om din din browser gör timeout, tryck på knappen \'Uppdatera\'' . '</ul>',
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
        'max_fsize' => 'Max filstorlek är %s KB',
        'album' => 'Album',
        'picture' => 'Bild',
        'pic_title' => 'Bildtitel',
        'description' => 'Bildbeskrivning',
        'keywords' => 'Nyckelord (avskiljda med mellanslag)',
        'err_no_alb_uploadables' => 'Ledsen, men det finns inget album där du har tillåtelse att ladda upp bilder i',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Användarinställningar',
        'name_a' => 'Namn stigande',
        'name_d' => 'Namn fallande',
        'group_a' => 'Grupp stigande',
        'group_d' => 'Grupp fallande',
        'reg_a' => 'Reg datum stigande',
        'reg_d' => 'Reg datum fallande',
        'pic_a' => 'Bildräknare stigande',
        'pic_d' => 'Bildräknare fallande',
        'disku_a' => 'Diskanvändande stigande',
        'disku_d' => 'Diskanvändande fallande',
        'sort_by' => 'Sortera användare i',
        'err_no_users' => 'Användartabell är tom!',
        'err_edit_self' => 'Du kan inte redigera din egen profil, använd \'Min profil\' länken för det',
        'edit' => 'REDIGERA',
        'delete' => 'RADERA',
        'name' => 'Användarnamn',
        'group' => 'Grupp',
        'inactive' => 'Inaktiv',
        'operations' => 'Funktioner',
        'pictures' => 'Bilder',
        'disk_space' => 'Utrymme använt / Kvot',
        'registered_on' => 'Registrerad den',
        'u_user_on_p_pages' => '%d användare på %d sida(or)',
        'confirm_del' => 'Är du säker att du vill RADERA denna användare? \\nAlla bilder och album kommer även att raderas för denna användare.',
        'mail' => 'E-POST',
        'err_unknown_user' => 'Vald användare finns inte!',
        'modify_user' => 'Spara användare',
        'notes' => 'Anteckningar',
        'note_list' => '<li>Om du inte vill ändra nuvarande lösenord, lämna "lösenord" fältet blankt',
        'password' => 'Lösenord',
        'user_active' => 'Användaren är aktiv',
        'user_group' => 'Användargrupp',
        'user_email' => 'Användar e-post',
        'user_web_site' => 'Användarens hemsida',
        'create_new_user' => 'Skapa ny användare',
        'user_from' => 'Användarens plats',
        'user_interests' => 'Användarens intressen',
        'user_occ' => 'Användarens yrke',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Storleksändra bilder',
        'what_it_does' => 'Vad den gör',
        'what_update_titles' => 'Uppdatera titlar från filnamnet',
        'what_delete_title' => 'Radera titlar',
        'what_rebuild' => 'Återuppbygger miniatyrbilder och storleksändrade bilder',
        'what_delete_originals' => 'Raderar bildstorlek på originalet och ersätter den med den storleksändrade versionen',
        'file' => 'Fil',
        'title_set_to' => 'titel satt till',
        'submit_form' => 'skicka',
        'updated_succesfully' => 'uppdatering lyckades',
        'error_create' => 'FEL vid skapande av',
        'continue' => 'Bearbeta fler bilder',
        'main_success' => 'Filen %s används nu som huvudbild',
        'error_rename' => 'Fel vid namnbyte från %s till %s',
        'error_not_found' => 'Filen %s hittades inte',
        'back' => 'tillbaka till huvudsidan',
        'thumbs_wait' => 'Uppdaterar miniatyrbilder och/eller storleksändrade bilder, v.v. vänta...',
        'thumbs_continue_wait' => 'Fortsätter att uppdatera miniatyrbilder och/eller storleksförändrade bilder...',
        'titles_wait' => 'Uppdaterar titlar, v.v. vänta...',
        'delete_wait' => 'Raderar titlar, v.v. vänta...',
        'replace_wait' => 'Raderar original och ersätter dem med storleksförändrade bilder, v.v. vänta..',
        'instruction' => 'Snabbinstruktioner',
        'instruction_action' => 'Välj funktion',
        'instruction_parameter' => 'Sätt parametrar',
        'instruction_album' => 'Välj album',
        'instruction_press' => 'Tryck %s',
        'update' => 'Uppdatera miniatyrbilder och/eller storleksförändrade bilder',
        'update_what' => 'Vad som ska uppdateras',
        'update_thumb' => 'Endast miniatyrbilder',
        'update_pic' => 'Endast storleksförändrade bilder',
        'update_both' => 'Både miniatyrbilder och storleksförändrade bilder',
        'update_number' => 'Antal bearbetade bilder per klick',
        'update_option' => '(Försök att ställa detta alternativ lägre om du får timeout problem)',
        'filename_title' => 'Filnamn &rArr; Bildtitel',
        'filename_how' => 'Hur ska filnamnet ändras',
        'filename_remove' => 'Ta bort .jpg ändelsen och ersätt _ (understruket) med mellanslag',
        'filename_euro' => 'Ändra 2003_11_23_13_20_20.jpg till 23/11/2003 13:20',
        'filename_us' => 'Ändra 2003_11_23_13_20_20.jpg till 11/23/2003 13:20',
        'filename_time' => 'Ändra 2003_11_23_13_20_20.jpg till 13:20',
        'delete' => 'Radera bildtitlar eller originalbildstorlek',
        'delete_title' => 'Radera bildtitlar',
        'delete_original' => 'Radera originalbildstorlek',
        'delete_replace' => 'Raderar orginalbilder och ersätter med storleksförändrade versioner',
        'select_album' => 'Välj album',
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