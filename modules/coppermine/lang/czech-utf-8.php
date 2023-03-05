<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by CPG-nuke Dev Team                                                 //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
define('PIC_VIEWS', 'ZobrazenÃ­');
define('PIC_VOTES', 'Hlas(Ã¹))');
define('PIC_COMMENTS', 'KomentÃ¡Ã¸(Ã¹)');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Czech', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => '&#x10C;esky', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espan~ol'
    'lang_country_code' => 'cz', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Michal Soukup aka migon', // the name of the translator - can be a nickname
    'trans_email' => 'migon@boule.cz', // translator's email address (optional)
    'trans_website' => 'http://www.boule.cz/', // translator's website (optional)
    'trans_date' => '2003-10-02', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('BytÃ¹', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'Ãšt', 'St', 'Ãˆt', 'PÃ¡', 'So');
$lang_month = array('Leden', 'Ãšnor', 'BÃ¸ezen', 'Duben', 'KvÃ¬ten', 'Ãˆerven', 'Ãˆervenec', 'Srpen', 'ZÃ¡Ã¸Ã­', 'Ã˜Ã­jen', 'Listopad', 'Prosinec');
// Some common strings
$lang_yes = 'Ano';
$lang_no = 'Ne';
$lang_back = 'ZPÃŒT';
$lang_continue = 'POKRAÃˆOVAT';
$lang_info = 'Informace';
$lang_error = 'Chyba';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('pÃ­Ã¨a', 'hovno', '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'NÃ¡hodnÃ© obrÃ¡zky',
    'lastup' => 'NejnovÃ¬jÂ¹Ã­',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Naposledy aktualizovanÃ¡ alba',
    'lastcom' => 'NejnovÃ¬jÂ¹Ã­ komentÃ¡Ã¸e',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'NejprohlÃ­Â¾enÃ¬jÂ¹Ã­',
    'toprated' => 'NejlÃ©pe hodnocenÃ©',
    'lasthits' => 'Naposledy zobrazenÃ©',
    'search' => 'VÃ½sledky hledÃ¡nÃ­',
    'favpics' => 'OblÃ­benÃ© obrÃ¡zky',
    );

$lang_errors = array('access_denied' => 'NemÃ¡te oprÃ¡vnÃ¬nÃ­ na tuto strÃ¡nku',
    'perm_denied' => 'NemÃ¡te dostateÃ¨nÃ¡ prÃ¡va pro potvrzenÃ­ tÃ©to operace.',
    'param_missing' => 'Skriptu nebyly pÃ¸edÃ¡ny potÃ¸ebnÃ© parametry',
    'non_exist_ap' => 'VybranÃ© album/obrÃ¡zek neexistuje',
    'quota_exceeded' => 'VyÃ¨erpal(a) jste mÃ­sto na disku.<br /><br />VaÂ¹e kvÃ³ta je[quota]K, VaÂ¹e obrÃ¡zky zbÃ­rajÃ­ [space]K, pÃ¸idÃ¡nÃ­m tohoto obrÃ¡zku by jste svoji kvÃ³tu pÃ¸ekroÃ¨il',
    'gd_file_type_err' => 'Pokud pouÂ¾Ã­vÃ¡te GD knihovnu jsou podporovÃ¡ny jen obrÃ¡zky JPG a PNG',
    'invalid_image' => 'Tento obrÃ¡zek je poÂ¹kozen/poruÂ¹en GD knihovna s nÃ­m nemÃ¹Â¾e pracovat.',
    'resize_failed' => 'Nelze vytvoÃ¸it nÃ¡hled Ã¨i zmenÂ¹enÃ½ obrÃ¡zek',
    'no_img_to_display' => 'Zde nenÃ­ obrÃ¡zek kterÃ½ by jste si mohl(a) prohlÃ©dnout',
    'non_exist_cat' => 'VybranÃ¡ kategorie neexistuje',
    'orphan_cat' => 'Podkategorie nemÃ¡ nadÃ¸Ã­zenou kategorii. ProblÃ©m opravte pÃ¸es nastavenÃ­ kategoriÃ­.',
    'directory_ro' => 'Do adresÃ¡Ã¸e \'%s\' nelze zapisovat (nedostateÃ¨nÃ¡ prÃ¡va), obrÃ¡zky nemohly bÃ½t smazÃ¡ny.',
    'non_exist_comment' => 'VybranÃ½ komentÃ¡Ã¸ neexistuje',
    'pic_in_invalid_album' => 'ObrÃ¡zek(y) je/jsou v neexitujÃ­cÃ­m albu (%s)!?',
    'banned' => 'Byl jse vykopnut z tÃ¬chto strÃ¡nek, nenÃ­ VÃ¡m umoÂ¾nÃ¬no je pouÂ¾Ã­vat.',
    'not_with_udb' => 'Tato funkce je vypnutÃ¡ jelikoÂ¾ je integrovÃ¡na ve fÃ³ru. BuÃ¯ nenÃ­ poÂ¾adovanÃ¡ fukce dostupnÃ¡ na tomto systÃ©mu, nebo tuto/tyto funci/e plnÃ­ fÃ³rum.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'PÃ¸ejÃ­t na seznam galeriÃ­',
    'alb_list_lnk' => 'Seznam galeriÃ­',
    'my_gal_title' => 'PÃ¸ejÃ­t do mÃ© osobnÃ­ galerie',
    'my_gal_lnk' => 'Moje galerie',
    'my_prof_lnk' => 'MÃ¹j Profil',
    'adm_mode_title' => 'Do Admin mÃ³du',
    'adm_mode_lnk' => 'Admin mÃ³d',
    'usr_mode_title' => 'Do UÂ¾ivatelskÃ©ho mÃ³du',
    'usr_mode_lnk' => 'UÂ¾ivatelskÃ½ mÃ³d',
    'upload_pic_title' => 'NahrÃ¡t obrÃ¡zek do gallerie',
    'upload_pic_lnk' => 'Upload obrÃ¡zku',
    'register_title' => 'VytvoÃ¸it ÃºÃ¨et',
    'register_lnk' => 'Registrovat se',
    'login_lnk' => 'PÃ¸ihlÃ¡sit',
    'logout_lnk' => 'OdhlÃ¡sit',
    'lastup_lnk' => 'NejnovÃ¬jÂ¹Ã­ obrÃ¡zky',
    'lastcom_lnk' => 'PoslednÃ­ komentÃ¡Ã¸e',
    'topn_lnk' => 'NejprohlÃ­Â¾enÃ¬jÂ¹Ã­',
    'toprated_lnk' => 'NejlÃ©pe hodnocenÃ©',
    'search_lnk' => 'VyhledÃ¡vÃ¡nÃ­',
    'fav_lnk' => 'OblÃ­benÃ©',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'PotvrzenÃ­ uploadu',
    'config_lnk' => 'NastavenÃ­',
    'albums_lnk' => 'Galerie',
    'categories_lnk' => 'Kategorie',
    'users_lnk' => 'UÂ¾ivatelÃ©',
    'groups_lnk' => 'UÂ¾. skupiny',
    'comments_lnk' => 'KomentÃ¡Ã¸e',
    'searchnew_lnk' => 'DÃ¡vkovÃ© pÃ¸idÃ¡nÃ­ obrÃ¡zkÃ¹',
    'util_lnk' => 'ZmÃ¬nit velikost obrÃ¡zkÃ¹',
    'ban_lnk' => 'Vykopnout uÂ¾ivatele',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'VytvoÃ¸it / organizovat moje galerie',
    'modifyalb_lnk' => 'ZmÃ¬nit moje galerie',
    'my_prof_lnk' => 'MÃ¹j profil',
    );

$lang_cat_list = array('category' => 'Kategorie',
    'albums' => 'Galerie',
    'pictures' => 'ObrÃ¡zky',
    );

$lang_album_list = array('album_on_page' => '%d GaleriÃ­ na %d strÃ¡nkÃ¡ch'
    ); 
// ascending VZESTUPNE
$lang_thumb_view = array(
	'date' => 'DATUM', 
    'name' => 'JMÃ‰NO SOUBORU',
    'title' => 'NADPIS',
    'sort_da' => 'Ã˜adit vzestupnÃ¬ podle data',
    'sort_dd' => 'Ã˜adit sestupnÃ¬ podle data',
    'sort_na' => 'Ã˜adit vzestupnÃ¬ podle jmÃ©na',
    'sort_nd' => 'Ã˜adit sestupnÃ¬ podle jmÃ©na',
    'sort_ta' => 'Ã˜adit podle nadpisu vzestupnÃ¬',
    'sort_td' => 'Ã˜adit podle nadpisu sestupnÃ¬',
    'pic_on_page' => '%d obrÃ¡zkkÃ¹ na %d strÃ¡nkÃ¡ch',
    'user_on_page' => '%d uÂ¾ivatelÃ¹ na %d strÃ¡nkÃ¡ch',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke

    );

$lang_img_nav_bar = array('thumb_title' => 'ZpÃ¬t na strÃ¡nku s nÃ¡hledy',
    'pic_info_title' => 'Zobraz/skryj informace o obrÃ¡zku',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Poslat tento obrÃ¡zek jako pohlednici',
    'ecard_disabled' => 'Pohlednice jsou vypnutÃ©',
    'ecard_disabled_msg' => 'NemÃ¡te dostateÃ¨nÃ¡ prÃ¡va pro zaslÃ¡nÃ­ pohlednice',
    'prev_title' => 'PÃ¸edchozÃ­ obrÃ¡zek',
    'next_title' => 'DalÂ¹Ã­ obrÃ¡zek',
    'pic_pos' => 'OBRÃZEK %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Hodnotit tento obrÃ¡zek ',
    'no_votes' => '(Â¾Ã¡dnÃ© hodnocenÃ­)',
    'rating' => '(AktualnÃ­ hodnocenÃ­ : %s / z 5, hlasovÃ¡no %s krÃ¡t)',
    'rubbish' => 'HnusnÃ½',
    'poor' => 'MizernÃ½',
    'fair' => 'Ujde to',
    'good' => 'DobrÃ½',
    'excellent' => 'VÃ½bornÃ½',
    'great' => 'DokonalÃ½',
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
    CRITICAL_ERROR => 'KritickÃ¡ chyba',
    'file' => 'Soubor: ',
    'line' => 'Ã˜Ã¡dka: ',
    );

$lang_display_thumbnails = array('filename' => 'JmÃ©no souboru : ',
    'filesize' => 'Velikost souboru : ',
    'dimensions' => 'RozmÃ¬ry : ',
    'date_added' => 'Datum pÃ¸idÃ¡nÃ­ : '
    );

$lang_get_pic_data = array('n_comments' => '%s KomentÃ¡Ã¸(Ã¹)',
    'n_views' => '%s zobrazenÃ­',
    'n_votes' => '(%s hlas(Ã¹))'
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
        'Question' => 'Question',
        'Very Happy' => 'Very Happy',
        'Smile' => 'Smile',
        'Sad' => 'Sad',
        'Surprised' => 'Surprised',
        'Shocked' => 'Shocked',
        'Confused' => 'Confused',
        'Cool' => 'Cool',
        'Laughing' => 'Laughing',
        'Mad' => 'Mad',
        'Razz' => 'Razz',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => 'Crying or Very sad',
        'Evil or Very Mad' => 'Evil or Very Mad',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rolling Eyes',
        'Wink' => 'Wink',
        'Idea' => 'Idea',
        'Arrow' => 'Arrow',
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
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'OpouÂ¹tÃ­m Admin MÃ³d....:-(',
        1 => 'Vstupuji do Admin MÃ³du....:-)',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Galerie musÃ­ mÃ­t jmÃ©no',
        'confirm_modifs' => 'Ste si jist(a) tÃ¬mito zmÃ¬nami ?',
        'no_change' => 'NeudÃ¬lal(a) jste Â¾Ã¡dnÃ© zmÃ¬ny !',
        'new_album' => 'NovÃ¡ galerie',
        'confirm_delete1' => 'Jste si jist(a), Â¾e chcete smazat tuto galerii ?',
        'confirm_delete2' => '\nVÂ¹echny obrÃ¡zky a komentÃ¡Ã¸e budou smazÃ¡ny !',
        'select_first' => 'Nejprve vyberte galerii',
        'alb_mrg' => 'SprÃ¡vce galeriÃ­',
        'my_gallery' => '* Moje galerie *',
        'no_category' => '* NenÃ­ kategorie *',
        'delete' => 'Smazat',
        'new' => 'NovÃ½/Ã¡',
        'apply_modifs' => 'Potvrdit zmÃ¬ny',
        'select_category' => 'Vybrat kategorii',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametry potÃ¸ebnÃ© pro \'%s\'operaci not supplied !',
        'unknown_cat' => 'VybranÃ¡ kategorie v databÃ¡zi neexistuje',
        'usergal_cat_ro' => 'Nelze smazat uÂ¾ivatelskÃ© galerie !',
        'manage_cat' => 'Spravovat kategorie',
        'confirm_delete' => 'Opravdu chcete SMAZAT tuto kategorii',
        'category' => 'Kategorie',
        'operations' => 'Operace',
        'move_into' => 'PÃ¸esunout do',
        'update_create' => 'Aktualizovat/VytvoÃ¸it kategorii',
        'parent_cat' => 'NadÃ¸azenÃ¡ kategorie',
        'cat_title' => 'Nadpis kategorie',
        'cat_desc' => 'Popis kategorie'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'NastavenÃ­',
        'restore_cfg' => 'Nastavit vÃ½chozÃ­',
        'save_cfg' => 'UloÂ¾it konfiguraci',
        'notes' => 'PoznÃ¡mky',
        'info' => 'Informace',
        'upd_success' => 'Konfigurace byla zmÃ¬nÃ¬na',
        'restore_success' => 'Konfigurace byla nastavena na vÃ½chozÃ­ nastavenÃ­',
        'name_a' => 'JmÃ©no vzestupnÃ¬',
        'name_d' => 'JmÃ©no sestupnÃ¬',
        'date_a' => 'Datum vzestupnÃ¬',
        'date_d' => 'Datum sestupnÃ¬',
        'title_a' => 'Nadpis vzestupnÃ¬',
        'title_d' => 'Nadpis sestupnÃ¬',
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
        'ZÃ¡kladnÃ­ nastavenÃ­',
        array(
            'JmÃ©no gallerie', 'gallery_name', 0),
        array(
            'Popis Galerie', 'gallery_description', 0),
        array(
            'Email administrÃ¡tora galerie', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Jazyk', 'lang', 5),
// for postnuke change
        array('TÃ©mÃ¡tko', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'NastavenÃ­ zobrazenÃ­',
        array(
            'Â©Ã­Ã¸ka hlavnÃ­ tabulky v (pixelech nebo %)', 'main_table_width', 0),
        array(
            'PoÃ¨et ÃºrovnÃ­ subkategoriÃ­', 'subcat_level', 0),
        array(
            'PoÃ¨et galeriÃ­ na strÃ¡nku', 'albums_per_page', 0),
        array(
            'PoÃ¨et sloupcÃ¹ v pÃ¸ehledu galeriÃ­', 'album_list_cols', 0),
        array(
            'Velikost nÃ¡hledÃ¹ v pixelech', 'alb_list_thumb_size', 0),
        array(
            'Obsah hlavnÃ­ strÃ¡nky', 'main_page_layout', 0),
        array(
            'Ukazovat v kategoriÃ­ch nÃ¡hledy galeriÃ­ prvnÃ­ ÃºrovnÃ¬', 'first_level', 1), 
        // 'Thumbnail view',
        'ZobrazenÃ­ nÃ¡hledÃ¹',
        array(
            'PoÃ¨et sloupcÃ¹ na strÃ¡nku', 'thumbcols', 0),
        array(
            'PoÃ¨et Ã¸Ã¡dkÃ¹ na strÃ¡nku', 'thumbrows', 0),
        array(
            'MaximÃ¡lnÃ­ mnoÂ¾stvÃ­ zÃ¡loÂ¾ek', 'max_tabs', 0),
        array(
            'Zobrazit legendu obrÃ¡zku pod nÃ¡hledem', 'caption_in_thumbview', 1),
        array(
            'Zobrazit poÃ¨et komentÃ¡Ã¸Ã¹ pod nÃ¡hldem', 'display_comment_count', 1),
        array(
            'ZÃ¡kladnÃ­ Ã¸azenÃ­ nÃ¡hledÃ¹', 'default_sort_order', 3),
        array(
            'Min. poÃ¨et hlasÃ¹ potÃ¸ebnÃ½ k zaÃ¸azenÃ­ do seznamu \'NejlÃ©pe hodnocenÃ©\'', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'ZobrazenÃ­ obrÃ¡zkÃ¹ &amp; NastavenÃ­ komentÃ¡Ã¸Ã¹',
        array(
            'Â©Ã­Ã¸ka tabulky pro zobrazenÃ­ obrÃ¡zku (v pixelech nebo %)', 'picture_table_width', 0),
        array(
            'VÂ¾dy zobrazit podrobnÃ© info', 'display_pic_info', 1),
        array(
            'CENZUROVAT slova v komentÃ¡Ã¸Ã­ch', 'filter_bad_words', 1),
        array(
            'Povilit smajlÃ­ky v komentÃ¡Ã¸Ã­ch', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'MaximÃ¡lnÃ­ dÃ¡lka popisu obrÃ¡zku', 'max_img_desc_length', 0),
        array(
            'MaximÃ¡lnÃ­ dÃ©lka slova v komentÃ¡Ã¸i', 'max_com_wlength', 0),
        array(
            'MaximÃ¡lnÃ­ mnoÂ¾stvÃ­ Ã¸Ã¡dkÃ¹ v komentÃ¡Ã¸i', 'max_com_lines', 0),
        array(
            'MaximÃ¡lnÃ­ dÃ©lka komentÃ¡Ã¸e', 'max_com_size', 0),
        array(
            'UkÃ¡zat filmovÃ½ prouÂ¾ek', 'display_film_strip', 1),
        array(
            'PoÃ¨et poloÂ¾ek ve filmovÃ©m prouÂ¾ku', 'max_film_strip_items', 0),
        array('Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
		array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
       // 'Pictures and thumbnails settings',


        'ObrÃ¡zky a nastavenÃ­ nÃ¡hledÃ¹',
        array(
            'Kvalita souborÃ¹ JPEG', 'jpeg_qual', 0),
        array(
            'MaximÃ¡lnÃ­ rozmÃ¬ry nÃ¡hledu <strong>*</strong>', 'thumb_width', 0),
        array(
            'PouÂ¾Ã­t rozmÃ¬r ( Â¹Ã­Ã¸ka nebo vÃ½Â¹ka nebo maximÃ¡lnÃ­ rozmÃ¬r nÃ¡hledu )<strong>*</strong>', 'thumb_use', 7),
        array(
            'VytvoÃ¸it stÃ¸ednÃ­ obrÃ¡zek', 'make_intermediate', 1),
        array(
            'MaximÃ¡lnÃ­ Â¹Ã­Ã¸ka nebo vÃ½Â¹ka stÃ¸enÃ­ho obrÃ¡zku <strong>*</strong>', 'picture_width', 0),
        array(
            'MaximÃ¡lnÃ­ velikost uploadovanÃ½ch obrÃ¡zkÃ¹ (KB)', 'max_upl_size', 0),
        array(
            'MaximÃ¡lnÃ­ rozmÃ¬ry uploadovanÃ½ch obrÃ¡zkÃ¹ (v pixelech)', 'max_upl_width_height', 0),
        // 'User settings',
        'NastavenÃ­ uÂ¾ivatelÃ¹',
        array(
            'Povolit registraci novÃ½ch uÂ¾ivatelÃ¹', 'allow_user_registration', 1),
        array(
            'Pro registraci vyÂ¾adovat potvrzenÃ­ admina', 'reg_requires_valid_email', 1),
        array(
            'Povolit pro dva uÂ¾ivatele stejnÃ½ email', 'allow_duplicate_emails_addr', 1),
        array(
            'MajÃ­ mÃ­t uÂ¾ivatelÃ© vlastnÃ­ galerii?', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Custom fields for image description (Nechte prÃ¡znÃ© a nezobrazÃ­ se)',
        array(
            'JmÃ©no poloÂ¾ky 1', 'user_field1_name', 0),
        array(
            'JmÃ©no poloÂ¾ky 2', 'user_field2_name', 0),
        array(
            'JmÃ©no poloÂ¾ky 3', 'user_field3_name', 0),
        array(
            'JmÃ©no poloÂ¾ky 4', 'user_field4_name', 0),
        // 'Pictures and thumbnails advanced settings',
        'ObrÃ¡zky a nÃ¡hledy rozÂ¹Ã­Ã¸enÃ© nastavenÃ­',
        array(
            'Zobrazit ikonu zamknutÃ© galerie nepÃ¸ihlÃ¡Â¹enÃ©mu uÂ¾ivateli.', 'show_private', 1),
        array(
            'Znaky zakÃ¡zanÃ© v nÃ¡zvech souborÃ¹', 'forbiden_fname_char', 0),
        array(
            'PovolenÃ© koncovky uploadovanÃ½ch souborÃ¹', 'allowed_file_extensions', 0),
        array(
            'Metoda zmÃ¬ny velikosti obrÃ¡zkÃ¹', 'thumb_method', 2),
        array(
            'Cesta k ImageMagicu (pÃ¸Ã­klad /usr/bin/X11/)', 'impath', 0),
        array(
            'PovolenÃ© typy obrÃ¡zkÃ¹ (pouze pro ImageMagic)', 'allowed_img_types', 0),
        array(
            'Parametry pro ImageMagic', 'im_options', 0),
        array(
            'ÃˆÃ­st EXIF data ze souborÃ¹ JPEG', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'AdresÃ¡Ã¸ pro galerie <strong>*</strong>', 'fullpath', 0),
        array(
            'AdresÃ¡Ã¸ pro galerie uÂ¾ivatelÃ¹ <strong>*</strong>', 'userpics', 0),
        array(
            'Prefix pro stÃ¸ednÃ¬ velkÃ© obrÃ¡zky <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefix pro nÃ¡hledy <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'ZÃ¡kladnÃ­ mÃ³d pro adresÃ¡Ã¸e', 'default_dir_mode', 0),
        array(
            'ZÃ¡kladnÃ­ mÃ³d pro obrÃ¡zky', 'default_file_mode', 0),
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
        'Cookies &amp; KÃ³dovÃ¡ strÃ¡ka',
        array(
            'JmÃ©no cookies uÂ¾Ã­vanÃ© programem (expertnÃ­ volba)', 'cookie_name', 0),
        array(
            'Cesta pro cookies uÂ¾Ã­vanÃ¡ programem (expertnÃ­ volba)', 'cookie_path', 0),
        array(
            'KÃ³dovÃ¡ strÃ¡nka', 'charset', 4), 
        // 'Miscellaneous settings',
        'DalÂ¹Ã­ nastavenÃ­',
        array(
            'Zapnour debug mÃ³d (jen pro testovÃ¡nÃ­)', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) PoloÂ¾ky oznaÃ¨enÃ© * se NESMÃ zmÃ¬nit pokud jiÂ¾ mÃ¡te ve vaÂ¹Ã­ Galerii nahranÃ© obrÃ¡zky</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'VloÂ¾te jmÃ©no a VÃ¡Â¹ komentÃ¡Ã¸',
        'com_added' => 'VÃ¡Â¹ komentÃ¡Ã¸ byl pÃ¸idÃ¡n',
        'alb_need_title' => 'ProsÃ­m, dejte galerii nadpis !',
        'no_udp_needed' => 'Aktualizace nenÃ­ tÃ¸eba.',
        'alb_updated' => 'Galerie byla pÃ¸idÃ¡na',
        'unknown_album' => 'VybranÃ© album neexistuje nebo nemÃ¡te prÃ¡va pro upload do tohoto alba',
        'no_pic_uploaded' => 'ObrÃ¡zek nebyl uploadovÃ¡n!<br /><br />zkontrolujte zda server podporuje upload souborÃ¹, Ã¨i zda jste opravdu zadal(a) obrÃ¡zek k uploadu...',
        'err_mkdir' => '  ERROR: Chyba pÃ¸i vytvÃ¡Ã¸enÃ­ adresÃ¡Ã¸e (nebyl vytvoÃ¸en) %s !',
        'dest_dir_ro' => 'Do cÃ­lovÃ©ho adresÃ¡Ã¸e %s nemÃ¹Â¾e skript zapisovat (zkontrolujte prÃ¡va) !',
        'err_move' => 'Nelze pÃ¸esunout %s do %s !',
        'err_fsize_too_large' => 'RozmÃ¬ry obrÃ¡zku, kterÃ½ se snaÂ¾Ã­te uploadovat, jsou pÃ¸Ã­liÂ¹ velkÃ© (max. velikost je %s x %s) !',
        'err_imgsize_too_large' => 'Velikost souboru, kterÃ½ se snaÂ¾Ã­te uploadovat, je pÃ¸Ã­liÂ¹ velkÃ¡ (max. velikost je %s KB) !',
        'err_invalid_img' => 'Soubor kterÃ½ jste nahrÃ¡l(a) na server nenÃ­ validnÃ­m obrÃ¡zkem !',
        'allowed_img_types' => 'MÃ¹Â¾ete uploadovat pouze obrÃ¡zky %s .',
        'err_insert_pic' => 'ObrÃ¡zek \'%s\' nelze vloÂ¾it do galerie ',
        'upload_success' => 'VÃ¡Â¹ obrÃ¡zek byl nahrÃ¡n na server bez problÃ©mÃ¹<br /><br />Bude viditelnÃ½ po schvÃ¡lenÃ­ adminem.',
        'info' => 'Informace',
        'com_added' => 'KomentÃ¡Ã¸u pÃ¸idÃ¡no',
        'alb_updated' => 'Galerie aktualizovÃ¡na',
        'err_comment_empty' => 'VÃ¡Â¹ komentÃ¡Ã¸ je prÃ¡zdnÃ½ !',
        'err_invalid_fext' => 'Pouze soubory s nÃ¡sledujÃ­cÃ­mi koncovkami jsou podporovanÃ© : <br /><br />%s.',
        'no_flood' => 'Jste autor poslednÃ­ho komentÃ¡Ã¸e k tomuto obrÃ¡zku<br /><br />Pokud ho chcete zmÃ¬nit pouÂ¾ijte volbu upravit ',
        'redirect_msg' => 'PrÃ¡vÃ¬ jste pÃ¸esmÃ¬rovÃ¡vÃ¡n(a).<br /><br /><br />KliknÃ¬te na \'POKRAÃˆOVAT\' pokud se strÃ¡nka nepÃ¸esmÃ¬ruje sama',
        'upl_success' => 'VÃ¡Â¹ obrÃ¡zek byl v poÃ¸Ã¡dku pÃ¸idÃ¡n',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Legenda(popisek)',
        'fs_pic' => 'pÃ¹vodnÃ­ velikost obrÃ¡zku',
        'del_success' => 'bezchybnÃ¬ smazÃ¡no',
        'ns_pic' => 'normÃ¡lnÃ­ velikost obrÃ¡zku',
        'err_del' => 'nelze smazat',
        'thumb_pic' => 'nÃ¡hled',
        'comment' => 'komentÃ¡Ã¸',
        'im_in_alb' => 'patÃ¸Ã­ do galerie',
        'alb_del_success' => 'Galerie \'%s\' smazÃ¡na',
        'alb_mgr' => 'SprÃ¡vce galeriÃ­',
        'err_invalid_data' => 'ObdrÂ¾ena chybnÃ¡ data \'%s\'',
        'create_alb' => 'VytvÃ¡Ã¸Ã­m galerii \'%s\'',
        'update_alb' => 'Aktualizuji galerii \'%s\' s nadpisem \'%s\' a seznamem \'%s\'',
        'del_pic' => 'Smazat obrÃ¡zek',
        'del_alb' => 'Smazat galerii',
        'del_user' => 'Smazat uÂ¾ivatele',
        'err_unknown_user' => 'VybranÃ½ uÂ¾ivatel neexistuje !',
        'comment_deleted' => 'KomentÃ¡Ã¸ bezchybnÃ¬ smazÃ¡n ! ',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Jste si jist, Â¾e chcete smazat tento obrÃ¡zek ? \\nPÃ¸iloÂ¾enÃ© komentÃ¡Ã¸e budou straceny.',
        'del_pic' => 'SMAZAT TENTO OBRÃZEK',
        'size' => '%s x %s pixelelÃ¹',
        'views' => '%s krÃ¡t',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'ZASTAVIT SLIDESHOW',
        'view_fs' => 'kliknÃ¬te pro zobrazenÃ­ pÃ¹vodnÃ­ho obrÃ¡zku',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informace o obrÃ¡zku',
        'Filename' => 'JmÃ©no souboru',
        'Album name' => 'JmÃ©no galerie',
        'Rating' => 'HodnocenÃ­ (%s hlas(Ã¹))',
        'Keywords' => 'KlÃ­Ã¨ovÃ¡ slova',
        'File Size' => 'Velikost souboru',
        'Dimensions' => 'RozmÃ¬ry',
        'Displayed' => 'Zobrazeno',
        'Camera' => 'FotoaparÃ¡t',
        'Date taken' => 'Datum poÃ¸Ã­zenÃ­ snÃ­mku',
        'Aperture' => 'Clona',
        'Exposure time' => 'ExpoziÃ¨nÃ­ Ã¨as',
        'Focal length' => 'OhniskovÃ¡ vzdÃ¡lenost',
        'Comment' => 'KomentÃ¡Ã¸e',
        'addFav' => 'PÃ¸idat k oblÃ­benÃ½m',
        'addFavPhrase' => 'OblÃ­benÃ©',
        'remFav' => 'Odstranit z oblÃ­benÃ½ch',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Upravit tento komentÃ¡Ã¸',
        'confirm_delete' => 'Jste si jist(a), Â¾e chcete smazat tento komentÃ¡Ã¸ ?',
        'add_your_comment' => 'PÃ¸idat komentÃ¡Ã¸',
        'name' => 'JmÃ©no',
        'comment' => 'KomentÃ¡Ã¸',
        'your_name' => 'Anonym',
        );

    $lang_fullsize_popup = array('click_to_close' => 'KliknutÃ­m na obrÃ¡zek zavÃ¸ete okno',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Poslat pohlednici',
        'invalid_email' => '<strong>VarovÃ¡nÃ­</strong> : neplatnÃ¡ emailovÃ¡ adresa !',
        'ecard_title' => 'Pohlednice ze serveru %s pro vÃ¡s/tebe',
        'view_ecard' => 'Pokud se pohlednice nezobrazila klikni na link',
        'view_more_pics' => 'Klikni pro dalÂ¹Ã­ obrÃ¡zky !',
        'send_success' => 'VaÂ¹e pohlednice byla odeslÃ¡na',
        'send_failed' => 'OmlouvÃ¡me se, ale server nebyl schopen odeslat VaÂ¹Ã­ pohlednici zkuste
     to znovu za chvÃ­li...',
        'from' => 'Od',
        'your_name' => 'VaÂ¹e jmÃ©no',
        'your_email' => 'VÃ¡Â¹ email',
        'to' => 'Komu',
        'rcpt_name' => 'JmÃ©no pÃ¸Ã­jemce',
        'rcpt_email' => 'DoruÃ¨it na email',
        'greetings' => 'Pozdrav/oslovenÃ­',
        'message' => 'ZprÃ¡va',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Info&nbsp;o obrÃ¡zku',
        'album' => 'Galerie',
        'title' => 'Nadpis',
        'desc' => 'Popis',
        'keywords' => 'KlÃ­Ã¨ovÃ¡ slova',
        'pic_info_str' => '%sx%s - %sKB - %s zobrazenÃ­ - %s hlas(Ã¹)',
        'approve' => 'SchvÃ¡lit obrÃ¡zek',
        'postpone_app' => 'OdloÂ¾it schvÃ¡lenÃ­',
        'del_pic' => 'Smazat obrÃ¡zek',
        'reset_view_count' => 'Vynulovat poÃ¨Ã­tadlo zobrazenÃ­',
        'reset_votes' => 'Vynulovat hlasy',
        'del_comm' => 'Smazat komentÃ¡Ã¸e',
        'upl_approval' => 'PotvrzenÃ­ uploadu',
        'edit_pics' => 'Upravit obrÃ¡zky',
        'see_next' => 'Zobrazit dalÂ¹Ã­ obrÃ¡zky',
        'see_prev' => 'Zobrazit pÃ¸edchozÃ­ obrÃ¡zky',
        'n_pic' => '%s obrÃ¡zkÃ¹',
        'n_of_pic_to_disp' => 'PoÃ¨et obrÃ¡zku k zobrazenÃ­',
        'apply' => 'UloÂ¾it zmÃ¬ny'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'JmÃ©no skupiny',
        'disk_quota' => 'DiskovÃ¡ kvÃ³ta',
        'can_rate' => 'Mohou hodnotit obrÃ¡zky',
        'can_send_ecards' => 'mohou posÃ­lat pohlednice',
        'can_post_com' => 'Mohou posÃ­lat komentÃ¡Ã¸e',
        'can_upload' => 'Mohou nahrÃ¡vat obrÃ¡zky',
        'can_have_gallery' => 'Mohou mÃ­t osobnÃ­ galerii',
        'apply' => 'UloÂ¾it zmÃ¬ny',
        'create_new_group' => 'VytvoÃ¸it novou skupinu',
        'del_groups' => 'Smazat vybranÃ© skupiny',
        'confirm_del' => 'Pokud smaÂ¾ete tuto skupinu vÂ¹ichni uÂ¾ivatelÃ©, patÃ¸Ã­cÃ­ do tÃ©to skupiny budou pÃ¸esunuti do skupiny \'Registered\' !\n\nPÃ¸ejete si pokraÃ¨ovat ?',
        'title' => 'Spravovat uÂ¾ivatelskÃ© skupiny',
        'approval_1' => 'PotvrzenÃ­ veÃ¸ejnÃ©ho. Upl. (1)',
        'approval_2' => 'PotvrzenÃ­ soukromÃ©ho. Upl. (2)',
        'note1' => '<strong>(1)</strong> Upload do veÃ¸ejnÃ½ch galeriÃ­ vyÂ¾aduje potvrzenÃ­ adminem',
        'note2' => '<strong>(2)</strong> Upload do galerie patÃ¸Ã­cÃ­ uÂ¾ivateli vyÂ¾aduje potvrzenÃ­ adminem',
        'notes' => 'PoznÃ¡mky'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Welcome !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Jste si jist(a), Â¾e chcete smazat tuto galerii? \\nVÂ¹echny obrÃ¡zky a komentÃ¡Ã¸e pÃ¹jdou do pekla taky. PÃ¸ejete si pokraÃ¨ovat.',
        'delete' => 'SMAZAT',
        'modify' => 'VLASTNOSTI',
        'edit_pics' => 'UPRAVIT OBR.',
        );

    $lang_list_categories = array('home' => 'DomÃ¹',
        'stat1' => '<strong>[pictures]</strong> obrÃ¡zky v <strong>[albums]</strong> glalerii <strong>[cat]</strong>v kategorii s <strong>[comments]</strong> komentÃ¡Ã¸i zobrazeno <strong>[views]</strong> krÃ¡t',
        'stat2' => '<strong>[pictures]</strong> obrÃ¡zky v <strong>[albums]</strong> galerii zobrazeno <strong>[views]</strong> krÃ¡t',
        'xx_s_gallery' => '%s\' Galerie',
        'stat3' => '<strong>[pictures]</strong> obrÃ¡zkÃ¹ v <strong>[albums]</strong> galserii s <strong>[comments]</strong> komentÃ¡Ã¸i zobrazeno <strong>[views]</strong> krÃ¡t'
        );

    $lang_list_users = array('user_list' => 'Seznam uÂ¾ivatelÃ¹',
        'no_user_gal' => 'Nejsou Â¾Ã¡dnÃ© uÂ¾ivatelskÃ© alerie',
        'n_albums' => '%s galeriÃ­',
        'n_pics' => '%s obrÃ¡zkÃ¹'
        );

    $lang_list_albums = array('n_pictures' => '%s obrÃ¡zkÃ¹',
        'last_added' => ', poslednÃ­ pÃ¸idÃ¡n %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Aktualizovat album %s',
        'general_settings' => 'ZÃ¡kladnÃ­ nastavenÃ­',
        'alb_title' => 'Nadpis galerie',
        'alb_cat' => 'Kategorie galerie',
        'alb_desc' => 'Popis galerie',
        'alb_thumb' => 'NÃ¡hled reprezentujÃ­cÃ­ album',
        'alb_perm' => 'PÃ¸Ã­stupovÃ¡ prÃ¡va pro tuto galerii',
        'can_view' => 'Album mÃ¹Â¾ou prohlÃ­Â¾et',
        'can_upload' => 'NÃ¡vÂ¹tÃ¬vnÃ­ci smÃ¬jÃ­ pÃ¸idÃ¡vat obrÃ¡zky',
        'can_post_comments' => 'Povolit komentÃ¡Ã¸e',
        'can_rate' => 'NÃ¡vÂ¹tÃ¬vnÃ­ci mohou hlasovat',
        'user_gal' => 'User Gallery',
        'no_cat' => '* NenÃ­ kategorie *',
        'alb_empty' => 'Galerie je prÃ¡zdnÃ¡',
        'last_uploaded' => 'NejnovÃ¬jÂ¹Ã­ obrÃ¡zek',
        'public_alb' => 'kdokoliv (veÃ¸ejnÃ¡ galerie)',
        'me_only' => 'Pouze jÃ¡',
        'owner_only' => 'Pouze vlastnÃ­k (%s)',
        'groupp_only' => 'ÃˆlenovÃ© skupiny \'%s\'',
        'err_no_alb_to_modify' => 'Album nelze modifikovat v databÃ¡zi.',
        'update' => 'Aktualizovat album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Tento obÃ¡zek jste jiÂ¾ hodnotil(a)',
        'rate_ok' => 'VÃ¡s hlas byl pÃ¸ijat. DÃ¬kujeme.',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
AdministrÃ¡toÃ¸i serveru {SITE_NAME}, potaÂ¾mo tÃ©to galerie si vyhrazujÃ­ prÃ¡vo zÃ¡sahu do obsahu galerie napÃ¸. komentÃ¡Ã¸e, mazÃ¡nÃ­ obrÃ¡zkÃ¹ pÃ¸Ã­padnÃ¬ Ãºprava (pokud poruÂ¹ujÃ­ pravidla galerie nebo dobrÃ© mravy).
Pokud budou obrÃ¡zky nahranÃ© uÂ¾ivetelem poruÂ¹ovat zÃ¡kon(y) budou ihned po zjiÂ¹tÃ¬nÃ­ jejich umÃ­stÃ¬nÃ­ na serveru smazÃ¡ny. AdministrÃ¡toÃ¸i/provozovatelÃ© tÃ©to galerie si distancujÃ­ od
pÃ¸Ã­padnÃ©ho zÃ¡vadnÃ©ho obsahu nahranÃ©ho na server uÂ¾ivateli. VlastnÃ­kem dat v galerii jsou jejich autoÃ¸i. AdministrÃ¡toÃ¸i pÃ¸edpoklÃ¡dajÃ­, Â¾e na server jsou umÃ­sÂ»ovanÃ¡ uÂ¾ivateli pouze obrÃ¡zky k nÃ­mÂ¾ vlastnÃ­ uÂ¾ivatel autorskÃ¡ prÃ¡va.
<br />
Pokud souhlasÃ­te, Â¾e nebudete posÃ­lat jakÃ½koliv zÃ¡vadnÃ½ materiÃ¡l jako vulgÃ¡rnÃ­ a obscÃ©nÃ­ obrÃ¡zky/komentÃ¡Ã¸e, jakÃ½koliv materiÃ¡l vzbuzujÃ­cÃ­ nenÃ¡vist, rasismus, nebo jinÃ½ materiÃ¡l poruÂ¹ujÃ­cÃ­ zÃ¡kony. SouhlasÃ­te, Â¾e administrÃ¡toÃ¸i, provozovatelÃ© a moderÃ¡toÃ¸i  {SITE_NAME}   majÃ­ prÃ¡vo smazat pÃ¸Ã­padnÃ¬ upravit jakÃ½koliv materiÃ¡l kdykoliv to uznajÃ­ za vhodnÃ©. VloÂ¾enÃ© informace budou uloÂ¾enÃ© na serveru a v databÃ¡zi a nebudou poskytnuty Â¾Ã¡dnÃ© tÃ¸etÃ­ stranÃ¬ bez vaÂ¹eho souhlasu. AdministÃ¡toÃ¸i/povozovatelÃ© serveru  vÂ¹ak nejsou ani nebudou ruÃ¨it za data na serveru uloÂ¾enÃ¡ pokud dojde k jakÃ©mukoliv Ãºtoku na sever.
<br />
<br />
Tyto strÃ¡nky vyuÂ¾Ã­vajÃ­ k uloÂ¾enÃ­ uÂ¾ivatelskÃ½ch dat cookies. Cookies slouÂ¾Ã­ pouze pro zvÃ½Â¹enÃ­ konfortu pÃ¸i pouÂ¾Ã­vÃ¡nÃ­ tÃ©to aplikace. EmailovÃ¡ adresa slouÂ¾Ã­ jen pro potvrzenÃ­ vaÂ¹ich ÃºdajÃ¹ a poslÃ¡nÃ­ hesla.<br />
<br />
KliknutÃ­m na 'SouhlasÃ­m' souhlasÃ­te z vÃ½Â¹e uvedenÃ½mi pravidly..
EOT;

    $lang_register_php = array('page_title' => 'Registrace novÃ©ho uÂ¾ivatele',
        'term_cond' => 'PodmÃ­nky a pravidla',
        'i_agree' => 'SouhlasÃ­m',
        'submit' => 'Poslat registraci',
        'err_user_exists' => 'ZadanÃ© uÂ¾ivatelskÃ© jmÃ©no jiÂ¾ existuje vyberte si prosÃ­m jinÃ©',
        'err_password_mismatch' => 'Hesla se musÃ­ schodovat pokuste je obÃ¬ zadat znovu',
        'err_uname_short' => 'MinimÃ¡lnÃ­ dÃ©lka uÂ¾ivatelskÃ©ho jmÃ©na je 2 znaky',
        'err_password_short' => 'Heslo musÃ­ bÃ½t alespoÃ² 2 znaky dlouhÃ©',
        'err_uname_pass_diff' => 'JmÃ©no a heslo se nesmÃ­ shodovat',
        'err_invalid_email' => 'Byla zadÃ¡na neplatnÃ¡ emailovÃ¡ adresa',
        'err_duplicate_email' => 'JinÃ½ uÂ¾ivatel se zaregistroval se zadanÃ½m emailem. Email musÃ­ bÃ½t jedineÃ¨nÃ½',
        'enter_info' => 'ZadanÃ© registraÃ¨nÃ­ informace',
        'required_info' => 'VyÂ¾adovanÃ© informace',
        'optional_info' => 'VolitelnÃ© informace',
        'username' => 'JmÃ©no',
        'password' => 'Heslo',
        'password_again' => 'Heslo (potvrzenÃ­)',
        'email' => 'Email',
        'location' => 'MÃ­sto (napÃ¸. Brno apod.)',
        'interests' => 'ZÃ¡jmy',
        'website' => 'DomÃ¡cÃ­ strÃ¡nka',
        'occupation' => 'PovolÃ¡nÃ­',
        'error' => 'CHYBA',
        'confirm_email_subject' => '%s - PotvrzenÃ­ registracce',
        'information' => 'Informace',
        'failed_sending_email' => 'Nelze odeslat potvrzenÃ­ registace !',
        'thank_you' => 'DÃ¬kujeme za registraci.<br /><br />Na adresu zadanou pÃ¸i registraci VÃ¡m budou doruÃ¨eny informace o aktivaci vaÂ¹eho ÃºÃ¨tu',
        'acct_created' => 'VÃ¡Â¹ uÂ¾ivatelskÃ½ ÃºÃ¨et byl bezchybnÃ¬ vytvoÃ¸en. NynÃ­ se pÃ¸ihlaÂ¹te pomocÃ­ vaÂ¹eho jmÃ©na a hesla',
        'acct_active' => 'VÃ¡Â¹ ÃºÃ¨et je nynÃ­ aktivnÃ­ pÃ¸ihlaÂ¹te se pomocÃ­ vaÂ¹eho jmÃ©na a hesla.',
        'acct_already_act' => 'VÃ¡Â¹ ÃºÃ¨et je jiÂ¾ aktivnÃ­ !',
        'acct_act_failed' => 'Tento ÃºÃ¨et nmÃ¹Â¾e bÃ½t aktivovÃ¡n !',
        'err_unk_user' => 'VybranÃ½ uÂ¾ivatel neexistuje !',
        'x_s_profile' => '%s\' profil',
        'group' => 'Skupina',
        'reg_date' => 'PÃ¸ipojen',
        'disk_usage' => 'VyuÂ¾itÃ­ disku',
        'change_pass' => 'ZmÃ¬nit heslo',
        'current_pass' => 'SouÃ¨asnÃ© heslo',
        'new_pass' => 'NovÃ© heslo',
        'new_pass_again' => 'NovÃ© heslo (kontola)',
        'err_curr_pass' => 'SouÃ¨asnÃ© heslo zadÃ¡no nesprÃ¡vnÃ¬',
        'apply_modif' => 'potvrdit zmÃ¬ny',
        'change_pass' => 'ZmÃ¬nit heslo',
        'update_success' => 'VÃ¡Â¹ profil byl aktualizovÃ¡n',
        'pass_chg_success' => 'VyÂ¹e heslo bylo zmÃ¬nÃ¬no',
        'pass_chg_error' => 'VaÂ¹e heslo nebylo zmÃ¬nÃ¬no',
        );

    $lang_register_confirm_email = <<<EOT
DÃ¬kujeme za registraci na {SITE_NAME}

VaÂ¹e jmÃ©no je : "{USER_NAME}"
VaÂ¹e heslo je: "{PASSWORD}"

Pro aktivaci vaÂ¹eho ÃºÃ¨tu je pÃ¸eba kliknout na odkaz nÃ­Â¾e nebo ho zkopÃ­rovat
do adresnÃ­ho Ã¸Ã¡dku vaÂ¹eho browseru a pÃ¸ejÃ­t na tuto strÃ¡nku


{ACT_LINK}

S Pozdravem,

SprÃ¡va serveru {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Kontrola komentÃ¡Ã¸Ã¹',
        'no_comment' => 'Zde nejsou komentÃ¡Ã¸e ke kontrole',
        'n_comm_del' => '%s komentÃ¡Ã¸(Ã¹) smazÃ¡n(o)',
        'n_comm_disp' => 'PoÃ¨et komentÃ¡Ã¸Ã¹ k zobrazenÃ­',
        'see_prev' => 'PÃ¸edchozÃ­',
        'see_next' => 'DalÂ¹Ã­',
        'del_comm' => 'Smazat vybranÃ© komentÃ¡Ã¸e',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'ProhledÃ¡vat obrÃ¡zky',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'NajÃ­t novÃ© obrÃ¡zky',
        'select_dir' => 'Vybrat adresÃ¡Ã¸',
        'select_dir_msg' => 'Tato funkce vÃ¡m umoÂ¾nÃ­ dÃ¡vkovÃ¬ zpracovat obrÃ¡zky nahranÃ© pÃ¸es FTP.<br /><br />Vyberte adresÃ¡Ã¸ kde se nachÃ¡zejÃ­ obrÃ¡zky k spracovÃ¡nÃ­',
        'no_pic_to_add' => 'Nejsou zde Â¾Ã¡dnÃ© obrÃ¡zky k pÃ¸idÃ¡nÃ­',
        'need_one_album' => 'PoÃ¸ebujete mÃ­t vytvoÃ¸enu alespoÃ² jednu galerii',
        'warning' => 'VarovÃ¡nÃ­',
        'change_perm' => 'Skript nemÃ¹Â¾e zapisovat do tohoto adresÃ¡Ã¸e, musÃ­te ho nastavit na CHMOD 755 nebo 777 pÃ¸ed pÃ¸idÃ¡nÃ­m obrÃ¡zkÃ¹ !',
        'target_album' => '<strong>VloÂ¾it obrÃ¡zky z &quot;</strong>%s<strong>&quot; do </strong>%s',
        'folder' => 'SloÂ¾ka',
        'image' => 'ObrÃ¡zek',
        'album' => 'Galerie',
        'result' => 'VÃ½sledek',
        'dir_ro' => 'NezapisovatelnÃ¡. ',
        'dir_cant_read' => 'NeÃ¨itelnÃ¡. ',
        'insert' => 'PÃ¸idÃ¡vÃ¡m novÃ© obrÃ¡zky do galerie',
        'list_new_pic' => 'Seznam obrÃ¡zkÃ¹',
        'insert_selected' => 'VloÂ¾it vybranÃ© obrÃ¡zky',
        'no_pic_found' => 'NovÃ© obrÃ¡zky nenalezeny',
        'be_patient' => 'ProsÃ­m buÃ¯te trpÃ¬livÃ½(Ã¡), program potÃ¸ebuje na zpracovÃ¡nÃ­ obrÃ¡zku nÃ¬jaÃ½ ten Ã¨as.',
        'notes' => '<ul>' . '<li><strong>OK</strong> : Tyto obrÃ¡zky byly pÃ¸idÃ¡ny' . '<li><strong>DP</strong> : ZdvojenÃ­!, Tento obrÃ¡zek ji existuje' . '<li><strong>PB</strong> : tento obrÃ¡zek nelze pÃ¸idat, skontrolujte konfiguraci pÃ¸Ã­padnÃ¬ pÃ¸Ã­stupovÃ¡ prÃ¡va' . '<li>KdyÂ¾ se neukÃ¡Â¾e \'oznaÃ¨enÃ­\' OK, DP, PB klepnÃ¬te na obrÃ¡zek a uvidÃ­te chybovou hlÃ¡Â¹ku generovanou PHP, kterÃ¡ VÃ¡m pomÃ¹Â¾e zjistit pÃ¸Ã­Ã¨inu problÃ©mu' . '<li>Pokud dojde k timeoutu F5 nebo reload strÃ¡nky by mÃ¬l pomoci' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Uploadnout obrÃ¡zek',
        'max_fsize' => 'Max. velikost souboru je %s KB',
        'album' => 'Galerie',
        'picture' => 'ObrÃ¡zek',
        'pic_title' => 'Nadpis obrÃ¡zku',
        'description' => 'Popis obrÃ¡zku',
        'keywords' => 'KlÃ­Ã¨ovÃ¡ slova (oddÃ¬lenÃ¡ mezerou)',
        'err_no_alb_uploadables' => 'Zde se nenalÃ©zÃ¡ galerie do kterÃ© je povolen upload.',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Spravovat uÂ¾ivatele',
        'name_a' => 'JmÃ©no vzestup.',
        'name_d' => 'JmÃ©no sestup.',
        'group_a' => 'Skupina vzestup.',
        'group_d' => 'Skupina sestup.',
        'reg_a' => 'Datum registrace vzestup.',
        'reg_d' => 'Datum registrace sestup.',
        'pic_a' => 'PoÃ¨et obrÃ¡zkÃ¹ vzestup.',
        'pic_d' => 'PoÃ¨et obrÃ¡zkÃ¹ sestup.',
        'disku_a' => 'VyuÂ¾itÃ­ disku vzestup.',
        'disku_d' => 'VyuÂ¾itÃ­ disku sestup.',
        'sort_by' => 'Ã˜adit uÂ¾Ã¸ivatele podle',
        'err_no_users' => 'Tabulka uÂ¾ivatelÃ¹ je prÃ¡zdnÃ¡!',
        'err_edit_self' => 'Zde nelze editovat vlastnÃ­ profil pouÂ¾ijte pÃ¸Ã­sluÂ¹nou volbu pracujÃ­cÃ­ s vaÂ¹Ã­m profilem',
        'edit' => 'UPRAVIT',
        'delete' => 'SMAZAT',
        'name' => 'UÂ¾iv. jmÃ©no',
        'group' => 'Skupina UÂ¾iv.',
        'inactive' => 'NeaktivnÃ­',
        'operations' => 'Operace',
        'pictures' => 'ObrÃ¡zky',
        'disk_space' => 'MÃ­sto vyuÂ¾itÃ© / kvÃ³ta',
        'registered_on' => 'RegistrovÃ¡n',
        'u_user_on_p_pages' => '%d uÂ¾ivatelÃ¹ na %d strÃ¡nkÃ¡ch',
        'confirm_del' => 'Jste si jist(a), Â¾e chcete smazat tohoto uÂ¾ivatele ? \\nVÂ¹echny jeho obrÃ¡zky, galerie a komentÃ¡Ã¸e budou smazÃ¡ny.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'VybranÃ½ uÂ¾iv. neexistuje !',
        'modify_user' => 'ZmÃ¬nit uÂ¾iv.',
        'notes' => 'PoznÃ¡mky',
        'note_list' => '<li>Pokud nechcete zmÃ¬nit heslo ponechte polÃ­Ã¨ko pro heslo prÃ¡zdnÃ©',
        'password' => 'Heslo',
        'user_active' => 'UÂ¾iv. je aktivnÃ­',
        'user_group' => 'UÂ¾iv. Skupina',
        'user_email' => 'UÂ¾iv. emaill',
        'user_web_site' => 'UÂ¾iv. domÃ¡cÃ­ strÃ¡nka',
        'create_new_user' => 'VytvoÃ¸it novÃ©ho uÂ¾ivatle.',
        'user_location' => 'MÃ­sto UÂ¾iv. (napÃ¸. Praha apod.)',
        'user_interests' => 'UÂ¾iv. zÃ¡jmy',
        'user_occupation' => 'UÂ¾iv. povolÃ¡nÃ­',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'ZmÃ¬nit velikost obrÃ¡zku',
        'what_it_does' => 'Co to dÃ¬lÃ¡?',
        'what_update_titles' => 'Aktualizovat nadpisy podle jmÃ©na souborÃ¹',
        'what_delete_title' => 'Smazat nadpisy',
        'what_rebuild' => 'PÃ¸edÃ¬lat nahledy a zmÃ¬nÃ¬nÃ© obrÃ¡zky',
        'what_delete_originals' => 'Smazat originÃ¡ly a nahradit je stÃ¸ednÃ­mi obrÃ¡zky',
        'file' => 'Soubor',
        'title_set_to' => 'Nastavit nadpis na',
        'submit_form' => 'odeslat',
        'updated_succesfully' => 'Aktualizace probÃ¬hla OK',
        'error_create' => 'CHYBA pÃ¸i vytvÃ¡Ã¸enÃ­',
        'continue' => 'ZpracovatvÃ­ce obrÃ¡zkÃ¹',
        'main_success' => 'Skoubor %s byl uspÃ¬Â¹nÃ¬ pouÂ¾it jako hlavnÃ­ obrÃ¡zek',
        'error_rename' => 'Chyba pÃ¸ejmenovÃ¡nÃ­ %s na %s',
        'error_not_found' => 'Soubor %s nebyl nalezen',
        'back' => 'zpÃ¬t na halvnÃ­',
        'thumbs_wait' => 'Aktualizuji nÃ¡hledy a/nebo stÃ¸ednÃ­ obrÃ¡zky, prosÃ­m Ã¨ekejte...',
        'thumbs_continue_wait' => 'PokraÃ¨uji v aktualizaci nÃ¡hledÃ¹ a/nebo stÃ¸ednÃ­ch obrÃ¡zkÃ¹...',
        'titles_wait' => 'Aktualizuji nadpisy, prosÃ­m Ã¨ekejte...',
        'delete_wait' => 'MaÂ¾u nadpisy, prosÃ­m Ã¨ekejte...',
        'replace_wait' => 'MaÂ¾u originÃ¡ly a nahrazuji je stÃ¸ednÃ­mi obrÃ¡zky, prosÃ­m Ã¨ekejte...',
        'instruction' => 'RychlÃ© instrukce',
        'instruction_action' => 'Vyberte akci',
        'instruction_parameter' => 'Nastavit parametry',
        'instruction_album' => 'Vybrat galerii',
        'instruction_press' => 'StisknÃ¬te %s',
        'update' => 'Aktualizovat nÃ¡hledy a/nebo stÃ¸ednÃ­ obrÃ¡zky',
        'update_what' => 'Co mÃ¡ bÃ½t aktualizovÃ¡no',
        'update_thumb' => 'Jen nÃ¡hledy',
        'update_pic' => 'Pouze stÃ¸ednÃ­ obrÃ¡zky',
        'update_both' => 'ObojÃ­ nÃ¡hledy i stÃ¸ednÃ­ obrÃ¡zky',
        'update_number' => 'PoÃ¨et obrÃ¡zkÃ¹, kterÃ© zpracovat na 1 kliknutÃ­',
        'update_option' => '(SniÂ¾te Ã¨Ã­slo pokud mÃ¡te problÃ©my s timeoutem)',
        'filename_title' => 'JmÃ©no souboru ? Nadpis obrÃ¡zku',
        'filename_how' => 'Jak se mÃ¡ zmÃ¬nit jmÃ©no obrÃ¡zku?',
        'filename_remove' => 'Odstranit .jpg koncovku a pÃ¸epsat _ (podtrÂ¾Ã­tka mezerami)',
        'filename_euro' => 'ZmÃ¬nit 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'ZmÃ¬nit 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'ZmÃ¬nit 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Smazat nadpisy obrÃ¡zkÃ¹ nebo originÃ¡lnÃ­ obrÃ¡zky',
        'delete_title' => 'Smazat nadpisy obrÃ¡zkÃ¹',
        'delete_original' => 'Smazat originÃ¡lnÃ­ obrÃ¡zky',
        'delete_replace' => 'Smazat originÃ¡ly a nahradit je stÃ¸ednÃ­ verzÃ­ obrÃ¡zkÃ¹',
        'select_album' => 'Vybrat galerii',
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