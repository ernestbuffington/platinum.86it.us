<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.1                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- // 


// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Slovak',  
'lang_name_native' => 'Slovensky', 
'lang_country_code' => 'sk', 
'trans_name'=> 'Rado Kertes', //the name of the translator - can be a nickname
'trans_email' => 'radovan@kertes.net', //translator's email address (optional)
'trans_website' => 'http://www.kertes.net/', //translator's website (optional)
'trans_date' => '2003-11-25', //the date the translation was created / last modified
);


$lang_charset = 'windows-1250';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytov', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Ne', 'Po', 'Ut', 'St', 'Št', 'Pi', 'So');
$lang_month = array('Január', 'Február', 'Marec', 'Apríl', 'Máj', 'Jún', 'Júl', 'August', 'September', 'Október', 'November', 'December');

// Some common strings
$lang_yes = 'Ano';
$lang_no  = 'Nie';
$lang_back = 'SPA';
$lang_continue = 'POKRAÈOVA';
$lang_info = 'Informácie';
$lang_error = 'Chyba';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('pièa', 'hovno', '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'Náhodné obrázky',
        'lastup' => 'Najnovšie',
        'lastalb'=> 'Naposledy aktualizované albumy',
        'lastcom' => 'Najnovjšie komentáre',
        'topn' => 'Nejprezeranejšie',
        'toprated' => 'Nejlepšie hodnotené',
        'lasthits' => 'Naposledy zobrazené',
        'search' => 'Výsledky h¾adania',
        'favpics'=> 'Ob¾úbené obrázky',
);

$lang_errors = array(
    'access_denied' => 'Nemáte oprávnenie na túto stránku',
    'perm_denied' => 'Nemáte dostatoèné práva pre potvrdenie tejto operácie.',
    'param_missing' => 'Skriptu neboli predané potrebné parametre',
    'non_exist_ap' => 'Vybraný album/obrázok neexistuje',
    'quota_exceeded' => 'Vyèerpal(a) ste miesto na disku.<br /><br />Vaša kvóta je[quota]K, Vaše obrázky zaberajú [space]K, pridaním tohto obrázku by jste svoju kvótu prekroèili',
    'gd_file_type_err' => 'Pokia¾ používate GD knižnicu, sú podporované len obrázky JPG a PNG',
    'invalid_image' => 'Tento obrázok je poškodený/porušený, GD knižnica s ním nemôže pracova.',
    'resize_failed' => 'Nemožno vytvori náh¾ad èi zmenšený obrázok',
    'no_img_to_display' => 'Tu nie je obrázok ktorý by ste si mohli(a) prezrie',
    'non_exist_cat' => 'Vybraná kategória neexistuje',
    'orphan_cat' => 'Podkategória nemá nadradenú kategóriu. Problém opravte cez nastavenie kategórií.',
    'directory_ro' => 'Do adresára \'%s\' nemožno zapisova (nedostatoèné práva), obrázky nemohli by zmazané.',
    'non_exist_comment' => 'Vybraný komentár neexistuje',
    'pic_in_invalid_album' => 'Obrázok(y) je/sú v neexistujúcom albume (%s)!?',
    'banned' => 'Boli ste vykopnutý z týchto stránok, nie je Vám umožnené ich používa.',
    'not_with_udb' => 'Táto funkcia je vypnutá pretože je integrovaná vo fóre. Buï nie je požadovaná funkcia dostupná v tomto systéme, alebo túto/tieto funkciu/e plní fórum.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Prejs na zoznam galérií',
    'alb_list_lnk' => 'Zoznam galérií',
    'my_gal_title' => 'Prejs do mojej osobnej galérie',
    'my_gal_lnk' => 'Moja galéria',
    'my_prof_lnk' => 'Môj Profil',
    'adm_mode_title' => 'Do Admin módu',
    'adm_mode_lnk' => 'Admin mód',
    'usr_mode_title' => 'Do Užívate¾ského módu',
    'usr_mode_lnk' => 'Uživate¾ský mód',
    'upload_pic_title' => 'Nahra obrázok do galérie',
    'upload_pic_lnk' => 'Upload obrázku',
    'register_title' => 'Vytvori úèet',
    'register_lnk' => 'Registrova sa',
    'login_lnk' => 'Prihlási',
    'logout_lnk' => 'Odhlási',
    'lastup_lnk' => 'Najnovjšie obrázky',
    'lastcom_lnk' => 'Posledné komentáre',
    'topn_lnk' => 'Najprezeranejšie',
    'toprated_lnk' => 'Nejlepšie hodnotené',
    'search_lnk' => 'Vyh¾adávanie',
    'fav_lnk' => 'Ob¾úbené',
);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Potvrdenie uploadu',
    'config_lnk' => 'Nastavenie',
    'albums_lnk' => 'Galérie',
    'categories_lnk' => 'Kategórie',
    'users_lnk' => 'Uživatelia',
    'groups_lnk' => 'Už. skupiny',
    'comments_lnk' => 'Komentáre',
    'searchnew_lnk' => 'Dávkové pridanie obrázkov',
    'util_lnk' => 'Zmeni ve¾kos obrázkov',
    'ban_lnk' => 'Vykopnú uživate¾a',
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Vytvori / organizova moje galérie',
    'modifyalb_lnk' => 'Zmeni moje galérie',
    'my_prof_lnk' => 'Môj profil',
);

$lang_cat_list = array(
    'category' => 'Kategórie',
    'albums' => 'Galérie',
    'pictures' => 'Obrázky',
);

$lang_album_list = array(
    'album_on_page' => '%d Galérií na %d stránkach'
);
           //ascending VZESTUPNE
$lang_thumb_view = array(
    'date' => 'DÁTUM',
    //Sort by filename and title
    'name' => 'MÉNO SÚBORU',
    'title' => 'NADPIS',
    'sort_da' => 'Radi vzostupne pod¾a dátumu',
    'sort_dd' => 'Radi zostupne pod¾a dátumu',
    'sort_na' => 'Radi vzostupne pod¾a mena',
    'sort_nd' => 'Radi zostupne pod¾a mena',
    'sort_ta' => 'Radi pod¾a nadpisu vzostupne',
    'sort_td' => 'Radi pod¾a nadpisu zostupne',
    'pic_on_page' => '%d obrázkov na %d stránkach',
    'user_on_page' => '%d užívate¾ov na %d stránkach'
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Spä na stránku s náh¾admi',
    'pic_info_title' => 'Zobraz/skryj informácie o obrázku',
    'slideshow_title' => 'Slideshow',
    'ecard_title' => 'Posla tento obrázok ako poh¾adnicu',
    'ecard_disabled' => 'Poh¾adnice sú vypnuté',
    'ecard_disabled_msg' => 'Nemáte dostatoèné práva pre zaslanie poh¾adnice',
    'prev_title' => 'Predchádzajúci obrázok',
    'next_title' => 'Ïalší obrázok',
    'pic_pos' => 'OBRÁZOK %s/%s',
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Hodnoti tento obrázok ',
    'no_votes' => '(žiadne hodnotenie)',
    'rating' => '(Aktuálne hodnotenie : %s / z 5, hlasované %s krát)',
    'rubbish' => 'Hnusný',
    'poor' => 'Mizerný',
    'fair' => 'Ujde to',
    'good' => 'Dobrý',
    'excellent' => 'Výborný',
    'great' => 'Dokonalý',
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
    CRITICAL_ERROR => 'Kritická chyba',
    'file' => 'Súbor: ',
    'line' => 'Riadok: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Meno súboru : ',
    'filesize' => 'Ve¾kos súboru : ',
    'dimensions' => 'Rozmery : ',
    'date_added' => 'Dátum pridania : '
);

$lang_get_pic_data = array(
    'n_comments' => '%s Komentár(ov)',
    'n_views' => '%s zobrazení',
    'n_votes' => '(%s hlas(ov))'
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

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
    'Exclamation' => 'Exclamation',
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

if (defined('ADMIN_PHP')) $lang_admin_php = array(
    0 => 'Opúšam Admin Mód....:-(',
    1 => 'Vstupujem do Admin Módu....:-)',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Galéria musí ma meno',
    'confirm_modifs' => 'Ste si istý(á) týmito zmenami ?',
    'no_change' => 'Neurobil(a) ste žiadne zmeny !',
    'new_album' => 'Nová galéria',
    'confirm_delete1' => 'Ste si istý(á), že chcete zmaza túto galériu ?',
    'confirm_delete2' => '\nVšetky obrázky a komentáre budú zmazané !',
    'select_first' => 'Najprv vyberte galériu',
    'alb_mrg' => 'Správca galérií',
    'my_gallery' => '* Moje galérie *',
    'no_category' => '* Nie je kategória *',
    'delete' => 'Zmaza',
    'new' => 'Nový/á',
    'apply_modifs' => 'Potvrdi zmeny',
    'select_category' => 'Vybra kategóriu',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Parametre potrebné pre \'%s\'operáciu not supplied !',
    'unknown_cat' => 'Vybraná kategória v databázi neexistuje',
    'usergal_cat_ro' => 'Nemožno zmaza užívate¾ské galérie !',
    'manage_cat' => 'Spravova kategórie',
    'confirm_delete' => 'Naozaj chcete ZMAZA túto kategóriu',
    'category' => 'Kategórie',
    'operations' => 'Operácie',
    'move_into' => 'Presunú do',
    'update_create' => 'Aktualizova/Vytvori kategóriu',
    'parent_cat' => 'Nadradená kategória',
    'cat_title' => 'Nadpis kategórie',
    'cat_desc' => 'Popis kategórie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Nastavenie',
    'restore_cfg' => 'Nastavi východzie',
    'save_cfg' => 'Uloži konfiguráciu',
    'notes' => 'Poznámky',
    'info' => 'Informácie',
    'upd_success' => 'Konfigurácia bola zmenená',
    'restore_success' => 'Konfigurácia bola nastavená na východzie nastavenie',
    'name_a' => 'Meno vzostupne',
    'name_d' => 'Meno zostupne',
    'date_a' => 'Dátum vzostupne',
    'date_d' => 'Dátum zostupne',
    'title_a' => 'Nadpis vzostupne',
    'title_d' => 'Nadpis zostupne',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
    'Základné nastavenie',
    array('Meno gallérie', 'gallery_name', 0),
    array('Popis galérie', 'gallery_description', 0),
    array('Email administrátora galérie', 'gallery_admin_email', 0),
    array('Cie¾ová adresa pre odkaz \'Zobrazi ïalšie obrázky\' v odkaze poh¾adnice', 'ecards_more_pic_target', 0),
    array('Jazyk', 'lang', 5),
    array('Téma', 'theme', 6),

    'Nastavení zobrazení',
    array('Šírka hlavnej tabu¾ky v (pixeloch alebo %)', 'main_table_width', 0),
    array('Poèet úrovní subkategórii', 'subcat_level', 0),
    array('Poèet galéri na stránku', 'albums_per_page', 0),
    array('Poèet stlpcov v preh¾ade galérii', 'album_list_cols', 0),
    array('Ve¾kos náh¾adov v pixeloch', 'alb_list_thumb_size', 0),
    array('Obsah hlavnej stránky', 'main_page_layout', 0),
    array('Ukazova v kategóriach náh¾ady galérii prvej úrovne','first_level',1),

    'Zobrazení náhledù',
    array('Poèet stlpcov na stránku', 'thumbcols', 0),
    array('Poèet riadkov na stránku', 'thumbrows', 0),
    array('Maximálne množství záložiek', 'max_tabs', 0),
    array('Zobrazi legendu obrázku pod náh¾adom', 'caption_in_thumbview', 1),
    array('Zobrazi poèet komentárov pod náh¾adom', 'display_comment_count', 1),
    array('Základné radenie náh¾adov', 'default_sort_order', 3),
    array('Min. poèet hlasov potrebný k zaradeniu do zoznamu \'Nejlepšie hodnotené\'', 'min_votes_for_rating', 0),

    'Zobrazenie obrázkov &amp; Nastavenie komentárov',
    array('Šírka tabu¾ky pre zobrazenie obrázku (v pixeloch alebo %)', 'picture_table_width', 0),
    array('Vždy zobrazi podrobné info', 'display_pic_info', 1),
    array('CENZUROVA slová v komentároch', 'filter_bad_words', 1),
    array('Povoli smajlíky v komentároch', 'enable_smilies', 1),
    array('Maximálna dåžka popisu obrázku', 'max_img_desc_length', 0),
    array('Maximálna dåžka slova v komentáre', 'max_com_wlength', 0),
    array('Maximálne množstvo riadkov v komentáre', 'max_com_lines', 0),
    array('Maximálna dåžka komentára', 'max_com_size', 0),
    array('Ukáza filmový prúžok', 'display_film_strip', 1),
    array('Poèet položiek vo filmovom prúžku', 'max_film_strip_items', 0),

    'Obrázky a nastavení náhledù',
    array('Kvalita súborov JPEG', 'jpeg_qual', 0),
    array('Maximálne rozmery náh¾adu <strong>*</strong>', 'thumb_width', 0),
    array('Použi rozmer ( šírka alebo výška alebo maximálny rozmer náh¾adu )<strong>*</strong>', 'thumb_use', 7),
    array('Vytvori stredný obrázok','make_intermediate',1),
    array('Maximálna šírka alebo výška stredného obrázku <strong>*</strong>', 'picture_width', 0),
    array('Maximálna ve¾kos uploadovaných obrázkov (KB)', 'max_upl_size', 0),
    array('Maximálne rozmery uploadovaných obrázkov (v pixeloch)', 'max_upl_width_height', 0),

    'Nastavenie uživate¾ov',
    array('Povoli registráciu nových užívate¾ov', 'allow_user_registration', 1),
    array('Pre registráciu vyžadova potvrdenie admina', 'reg_requires_valid_email', 1),
    array('Povoli pre dvoch užívate¾ov rovnaký email', 'allow_duplicate_emails_addr', 1),
    array('Majú ma užívatelia vlastnú galériu?', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

    'Volite¾né polia pre popis obrázkov (Nechajte prázdne a nezobrazí sa)',
    array('Meno položky 1', 'user_field1_name', 0),
    array('Meno položky 2', 'user_field2_name', 0),
    array('Meno položky 3', 'user_field3_name', 0),
    array('Meno položky 4', 'user_field4_name', 0),

    'Obrázky a náh¾ady rozšírene nastavenie',
    array('Zobrazi ikonu zamknuté galérie neprihlásenému užívate¾ovi.','show_private',1),
    array('Znaky zakázané v názvoch súborov', 'forbiden_fname_char',0),
    array('Povolené koncovky uploadovaných súborov', 'allowed_file_extensions',0),
    array('Metóda zmeny ve¾kosti obrázkov','thumb_method',2),
    array('Cesta k ImageMagicu (príklad /usr/bin/X11/)', 'impath', 0),
    array('Povolené typy obrázkov (iba pre ImageMagic)', 'allowed_img_types',0),
    array('Parametre pre ImageMagic', 'im_options', 0),
    array('Èíta EXIF data zo súborov JPEG', 'read_exif_data', 1),
    array('Adresár pre galérie <strong>*</strong>', 'fullpath', 0),
    array('Adresár pre galérie užívate¾ov <strong>*</strong>', 'userpics', 0),
    array('Prefix pre stredne ve¾ké obrázky <strong>*</strong>', 'normal_pfx', 0),
    array('Prefix pre náh¾ady <strong>*</strong>', 'thumb_pfx', 0),
    array('Základný mód pre adresáre', 'default_dir_mode', 0),
    array('Základný mód pre obrázky', 'default_file_mode', 0),
    array('Zakáza kliknutia pravým tlaèítkom pri plnom zobrazení ( JavaScript metoda - NIE nepriestrelná odradí amatérov :-D )', 'disable_popup_rightclick', 1),
    array('Zakáza kliknutia pravým tlaèítkom na normálnych stránkach ( JavaScript metoda - NE nepriestrelná odradí amatérov :-D )', 'disable_gallery_rightclick', 1),

    'Cookies &amp; Kódová stránka',
    array('Meno cookies užívané programom (expertná vo¾ba)', 'cookie_name', 0),
    array('Cesta pre cookies užívaná programom (expertná vo¾ba)', 'cookie_path', 0),
    array('Kódová stránka', 'charset', 4),

    'Ïalšie nastavenia',
    array('Zapnú debug mód (len pre testovanie)', 'debug_mode', 1),

    '<br /><div align="center">(*) Položky oznaèené * se NESMÚ meni pokia¾ už máte ve vašej Galérii nahrané obrázky</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Vložte meno a Váš komentár',
    'com_added' => 'Váš komentár bol pridaný',
    'alb_need_title' => 'Prosím, dajte galérii nadpis !',
    'no_udp_needed' => 'Aktualizácia nie je potrebná.',
    'alb_updated' => 'Galéria bola pridaná',
    'unknown_album' => 'Vybraný album neexistuje alebo nemáte právo na upload do tohto albumu',
    'no_pic_uploaded' => 'Obrázok nebol uploadovaný!<br /><br />skontrolujte èi server podporuje upload súborov a èi ste naozaj zadal(a) obrázok na uploadu...',
    'err_mkdir' => '  ERROR: Chyba pri vytváraní adresára (nebol vytvorený) %s !',
    'dest_dir_ro' => 'Do cie¾ového adresára %s nemôže skript zapisova (skontrolujte oprávnenia) !',
    'err_move' => 'Nemožno presunú %s do %s !',
    'err_fsize_too_large' => 'Rozmery obrázka, ktorý se snažíte uploadova, sú príliš ve¾ké (max. ve¾kos je %s x %s) !',
    'err_imgsize_too_large' => 'Ve¾kos súboru, ktorý se snažíte uploadova, je príliš ve¾ká (max. ve¾kos je %s KB) !',
    'err_invalid_img' => 'súbor ktorý ste nahral(a) na server nie je korektným obrázkom !',
    'allowed_img_types' => 'Môžete uploadova iba obrázky %s .',
    'err_insert_pic' => 'Obrázok \'%s\' nemožno vloži do galérie ',
    'upload_success' => 'Váš obrázok bol nahraný na server bez problémov<br /><br />Bude vidite¾ný po schválení adminom.',
    'info' => 'Informácie',
    'com_added' => 'Komentárov pridaných',
    'alb_updated' => 'Galéria aktualizovaná',
    'err_comment_empty' => 'Váš komentár je prázdny !',
    'err_invalid_fext' => 'Iba súbory s následujúcimi koncovkami sú podporované : <br /><br />%s.',
    'no_flood' => 'Ste autorom posledného komentára k tomuto obrázku<br /><br />Pokia¾ ho chcete zmeni použijte vo¾bu upravi ',
    'redirect_msg' => 'Práve ste presmerovávaný(a).<br /><br /><br />Kliknite na \'POKRAÈOVA\' pokia¾ sa stránka nepresmeruje sama',
    'upl_success' => 'Váš obrázok bol pridaný v poriadku',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Legenda(popis)',
    'fs_pic' => 'pôvodná ve¾kos obrázku',
    'del_success' => 'bezchybne zmazané',
    'ns_pic' => 'normálna ve¾kos obrázku',
    'err_del' => 'nemožno zmaza',
    'thumb_pic' => 'náh¾ad',
    'comment' => 'komentár',
    'im_in_alb' => 'patrí do galérie',
    'alb_del_success' => 'Galéria \'%s\' zmazaná',
    'alb_mgr' => 'Správca galérií',
    'err_invalid_data' => 'Obdržané chybné data \'%s\'',
    'create_alb' => 'Vytváram galériu \'%s\'',
    'update_alb' => 'Aktualizujem galériu \'%s\' s nadpisom \'%s\' a zoznamom \'%s\'',
    'del_pic' => 'Zmaza obrázok',
    'del_alb' => 'Zmaza galériu',
    'del_user' => 'Zmaza užívate¾a',
    'err_unknown_user' => 'Vybraný užívate¾ neexistuje !',
    'comment_deleted' => 'Komentár bezchybne zmazaný ! ',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
    'confirm_del' => 'Ste si istý, že chcete zmaza tento obrázok ? \\nPriložené komentáre budú stratené.',
      'del_pic' => 'ZMAZA TENTO OBRÁZOK',
    'size' => '%s x %s pixelov',
    'views' => '%s krát',
    'slideshow' => 'Slideshow',
    'stop_slideshow' => 'ZASTAV SLIDESHOW',
        'view_fs' => 'kliknite pre zobrazenie pôvodného obrázku',
);

$lang_picinfo = array(
    'title' =>'Informácie o obrázku',
    'Filename' => 'Meno súboru',
    'Album name' => 'Meno galérie',
    'Rating' => 'Hodnotenie (%s hlas(ov))',
    'Keywords' => 'K¾úèové slová',
    'File Size' => 'Ve¾kos súboru',
    'Dimensions' => 'Rozmery',
    'Displayed' => 'Zobrazené',
    'Camera' => 'Fotoaparát',
    'Date taken' => 'Dátum vytvorenia snímky',
    'Aperture' => 'Clona',
    'Exposure time' => 'Expozièný èas',
    'Focal length' => 'Ohnisková vzdialenos',
    'Comment' => 'Komentáre',
    'addFav' => 'Prida k ob¾úbeným',
    'addFavPhrase' => 'Ob¾úbené',
    'remFav' => 'Odstrani z ob¾úbených',
);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Upravi tento komentár',
    'confirm_delete' => 'Ste si istý(á), že chcete zmaza tento komentár ?',
    'add_your_comment' => 'Prida komentár',
    'name'=>'Meno',
    'comment'=>'Komentár',
    'your_name' => 'Anonym',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknutím na obrázok zavriete okno',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Posla poh¾adnicu',
    'invalid_email' => '<strong>Varovanie</strong> : neplatná emailová adresa !',
    'ecard_title' => 'Poh¾ednica zo servra %s pro vás/teba',
    'view_ecard' => 'Pokia¾ se poh¾ednica nezobrazila klikni na link',
    'view_more_pics' => 'Klikni pre ïalšie obrázky !',
    'send_success' => 'Vaša poh¾adnica bola odoslaná',
    'send_failed' => 'Prepáète, ale server nebol schopný odosla Vašu poh¾adnicu skúste
     to znova za chví¾u...',
    'from' => 'Od',
    'your_name' => 'Vaše meno',
    'your_email' => 'Váš email',
    'to' => 'Komu',
    'rcpt_name' => 'Meno príjemcu',
    'rcpt_email' => 'Doruèi na email',
    'greetings' => 'Pozdrav/oslovenie',
    'message' => 'Správa',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Info o obrázku',
    'album' => 'Galéria',
    'title' => 'Nadpis',
    'desc' => 'Popis',
    'keywords' => 'K¾úèové slová',
    'pic_info_str' => '%sx%s - %sKB - %s zobrazení - %s hlas(ov)',
    'approve' => 'Schváli obrázok',
    'postpone_app' => 'Odloži schválenie',
    'del_pic' => 'Zmaza obrázok',
    'reset_view_count' => 'Vynulova poèítadlo zobrazení',
    'reset_votes' => 'Vynulova hlasy',
    'del_comm' => 'Zmaza komentáre',
    'upl_approval' => 'Potvrdenie uploadu',
    'edit_pics' => 'Upravi obrázky',
    'see_next' => 'Zobrazi dalšie obrázky',
    'see_prev' => 'Zobrazi predchádzajúce obrázky',
    'n_pic' => '%s obrázkov',
    'n_of_pic_to_disp' => 'Poèet obrázkov na zobrazenie',
    'apply' => 'Uloži zmeny'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Meno skupiny',
    'disk_quota' => 'Disková kvóta',
    'can_rate' => 'Môžu hodnoti obrázky',
    'can_send_ecards' => 'Môžu posiela poh¾adnice',
    'can_post_com' => 'Môžu posiela komentáre',
    'can_upload' => 'Môžu nahráva obrázky',
    'can_have_gallery' => 'Môžu ma osobnú galériu',
    'apply' => 'Uloži zmeny',
    'create_new_group' => 'Vytvori novú skupinu',
    'del_groups' => 'Zmaza vybrané skupiny',
    'confirm_del' => 'Pokia¾ zmažete túto skupinu všetci užívatelia, patriaci do tejto skupiny budú presunutí do skupiny \'Registered\' !\n\nPrajete si pokraèova ?',
    'title' => 'Spravova užívate¾ské skupiny',
    'approval_1' => 'Potvrdenie verejného. Upl. (1)',
    'approval_2' => 'Potvrdenie súkromného. Upl. (2)',
    'note1' => '<strong>(1)</strong> Upload do verejných galérií vyžaduje potvrdenie adminom',
    'note2' => '<strong>(2)</strong> Upload do galérie patriacej užívate¾ovi vyžaduje potvrdenie adminom',
    'notes' => 'Poznámky'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Vítajte !'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Ste si jistý(á), že chcete zmaza túto galériu? \\nVšetky obrázky a komentáre pôjdu do pekla tiež. Prajete si pokraèova?',
    'delete' => 'ZMAZA',
    'modify' => 'VLASTNOSTI',
    'edit_pics' => 'UPRAVI OBR.',
);

$lang_list_categories = array(
    'home' => 'Domov',
    'stat1' => '<strong>[pictures]</strong> obrázky v <strong>[albums]</strong> galérii <strong>[cat]</strong>v kategórii s <strong>[comments]</strong> komentárami zobrazené <strong>[views]</strong> krát',
    'stat2' => '<strong>[pictures]</strong> obrázky v <strong>[albums]</strong> galérii zobrazené <strong>[views]</strong> krát',
    'xx_s_gallery' => '%s\' Galéria',
    'stat3' => '<strong>[pictures]</strong> obrázkov v <strong>[albums]</strong> galérii s <strong>[comments]</strong> komentárami zobrazené <strong>[views]</strong> krát'
);

$lang_list_users = array(
    'user_list' => 'Zoznam užívate¾ov',
    'no_user_gal' => 'Nie sú žiadne užívate¾ské galérie',
    'n_albums' => '%s galérií',
    'n_pics' => '%s obrázkov'
);

$lang_list_albums = array(
    'n_pictures' => '%s obrázkov',
    'last_added' => ', posledné pridanie %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
    'login' => 'Prihlásenie',
    'enter_login_pswd' => 'Zadajte Vaše meno a heslo pre prihlásenie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'remember_me' => 'Pamätaj si ma',
    'welcome' => 'Vítaj u nás %s ...',
    'err_login' => '*** Chyba pri prihlásení skúste to znova ***',
    'err_already_logged_in' => 'Už ste prihlásený !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
    'logout' => 'Odhlási',
    'bye' => 'Tak si to užij zase inde %s ...',
    'err_not_loged_in' => 'Nie ste prihlásený !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
    'upd_alb_n' => 'Aktualizova album %s',
    'general_settings' => 'Základné nastavenie',
    'alb_title' => 'Nadpis galérie',
    'alb_cat' => 'Kategórie galérie',
    'alb_desc' => 'Popis galérie',
    'alb_thumb' => 'Náh¾ad reprezentujúci album',
    'alb_perm' => 'Prístupové práva pre túto galériu',
    'can_view' => 'Album môžu prezera',
    'can_upload' => 'Návštevníci smú pridáva obrázky',
    'can_post_comments' => 'Povoli komentáre',
    'can_rate' => 'Návštevníci môžu hlasova',
    'user_gal' => 'Užívate¾ská galéria',
    'no_cat' => '* Bez kategórie *',
    'alb_empty' => 'Galéria je prázdna',
    'last_uploaded' => 'Najnovší obrázok',
    'public_alb' => 'ktoko¾vek (verejná galéria)',
    'me_only' => 'Iba ja',
    'owner_only' => 'Iba vlastník (%s)',
    'groupp_only' => 'Èlenovia skupiny \'%s\'',
    'err_no_alb_to_modify' => 'Album nemožno modifikova v databáze.',
    'update' => 'Aktualizova album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Tento obázok ste už hodnotil(a)',
    'rate_ok' => 'Váš hlas bol prijatý. Ïakujeme.',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Administrátori servra {SITE_NAME}, poažmo tejto galérie si vyhradzujú právo zásahu do obsahu galérie napr. komentáre, mazanie obrázkov prípadne úprava (Pokia¾ porušujú pravidlá galérie alebo dobré mravy).
Pokia¾ budú obrázky nahrané užívate¾om porušova zákon(y) budú ihneï po zistení ich umiestnenia na serveri zmazané. Administrátori/prevádzkovatelia tejto galérie sa dištancujú od
prípadného závadného obsahu nahraného na server užívate¾om. Vlastníkom dát v galérii sú ich autori. Administrátori predpokladajú, že na server sú umiestòované užívate¾mi iba obrázky ku ktorým má užívate¾ autorské práva.
<br />
Pokia¾ súhlasíte, že nebudete posiela akýko¾vek závadný materiál ako vulgárny a obscénny obrázky/komentáre, akýko¾vek materiál vzbudzujúci nenávis, rasizmus, alebo iný materiál porušujúci zákony. Súhlasíte, že administrátori, prevádzkovatelia a moderátori  {SITE_NAME}   majú právo zmaza prípadne upravi akýko¾vek materiál kedyko¾vek to uznajú za vhodné. Vložené informácie budú uložené na servri a v databáze a nebudú poskytnuté žiadnej tretej strane bez vášho súhlasu. Administrátori/prevádzkovatelia servra  však nie sú ani nebudú ruèi za dáta na servri uložená pokia¾ dôjde k akémuko¾vek útoku na sever.
<br />
<br />
Tieto stránky využívajú k uloženiu užívate¾ských dát cookies. Cookies slúžia len pre zvýšenie komfortu pri používaní tejto aplikácie. Emailová adresa slúži len pre potvrdenie vašich údajov a zaslanie hesla.<br />
<br />
Kliknutím na 'Súhlasím' súhlasíte z vyššie uvedenými pravidlami..

EOT;

$lang_register_php = array(
    'page_title' => 'Registrácia nového užívate¾a',
    'term_cond' => 'Podmienky a pravidlá',
    'i_agree' => 'Súhlasím',
    'submit' => 'Posla registráciu',
    'err_user_exists' => 'Zadané užívate¾ské mno už existuje vyberte si prosím iné',
    'err_password_mismatch' => 'Hesla sa musia zhodova pokuste sa ich obe zada znova',
    'err_uname_short' => 'Minimálna dåžka užívate¾ského mena je 2 znaky',
    'err_password_short' => 'Heslo musí by aspoò 2 znaky dlhé',
    'err_uname_pass_diff' => 'Meno a heslo se nesmú zhodova',
    'err_invalid_email' => 'Bola zadaná neplatná emailová adresa',
    'err_duplicate_email' => 'Iný užívate sa zaregistroval so zadaným emailom. Email musí by jedineèný',
    'enter_info' => 'Zadané registraèné informácie',
    'required_info' => 'Vyžadované informácie',
    'optional_info' => 'Volite¾né informácie',
    'username' => 'Meno',
    'password' => 'Heslo',
    'password_again' => 'Heslo (potvrdenie)',
    'email' => 'Email',
    'location' => 'Mesto (napr. Košice apod.)',
    'interests' => 'Záujmy',
    'website' => 'Domáca stránka',
    'occupation' => 'Povolanie',
    'error' => 'CHYBA',
    'confirm_email_subject' => '%s - Potvrdenie registrácie',
    'information' => 'Informácie',
    'failed_sending_email' => 'Nemožno odosla potvrdenie registrácie !',
    'thank_you' => 'Ïakujeme za registráciu.<br /><br />Na adresu zadanú pri registrácii Vám budú doruèené informácie o aktivácii vašho úètu',
    'acct_created' => 'Váš užívate¾ský úèet bol úspešne vytvorený. Teraz sa prihláste pomocou vášho mena a hesla',
    'acct_active' => 'Váš úèet je teraz aktívny prihláste se pomocou vášho mena a hesla.',
    'acct_already_act' => 'Váš úèet je už aktívny !',
    'acct_act_failed' => 'Tento úèet nemôže by aktivovaný !',
    'err_unk_user' => 'Vybraný užívate¾ neexistuje !',
    'x_s_profile' => '%s\' profil',
    'group' => 'Skupina',
    'reg_date' => 'Pripojený',
    'disk_usage' => 'Využitie disku',
    'change_pass' => 'Zmeni heslo',
    'current_pass' => 'Súèasné heslo',
    'new_pass' => 'Nové heslo',
    'new_pass_again' => 'Nové heslo (kontrola)',
    'err_curr_pass' => 'Súèasné heslo zadáné nesprávne',
    'apply_modif' => 'potvrdi zmeny',
    'change_pass' => 'Zmeni heslo',
    'update_success' => 'Váš profil bol aktualizovaný',
    'pass_chg_success' => 'Vaše heslo bolo zmenené',
    'pass_chg_error' => 'Vaše heslo nebolo zmenené',
);

$lang_register_confirm_email = <<<EOT
Ïakujeme za registráciu na {SITE_NAME}

Vaše meno je : "{USER_NAME}"
Vaše heslo je: "{PASSWORD}"

Pre aktiváci vašeho úètu je potrebné kliknú na odkaz nižšie alebo ho skopírova
do adresného riadku vášho browsera a prejs na túto stránku


{ACT_LINK}

S Pozdravom,

Správa serveru {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Kontrola komentárov',
    'no_comment' => 'Tu nie sú komentáre na kontrolu',
    'n_comm_del' => '%s komentár(ov) zmazaný(ch)',
    'n_comm_disp' => 'Poèet komentárov na zobrazenie',
    'see_prev' => 'Predchádzajúci',
    'see_next' => 'Ïalší',
    'del_comm' => 'Zmaza vybrané komentáre',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Preh¾adáva obrázky',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Nájs nové obrázky',
    'select_dir' => 'Vybra adresár',
    'select_dir_msg' => 'Táto funkcia vám umožní dávkovo spracova obrázky nahrané cez FTP.<br /><br />Vyberte adresár kde sa nachádzajú obrázky na spracovanie',
    'no_pic_to_add' => 'Nie su tu žiadne obrázky na pridanie',
    'need_one_album' => 'Porebujete ma vytvorenú aspoò jednu galériu',
    'warning' => 'Varovanie',
    'change_perm' => 'Skript nemôže zapisova do tohto adresára, musíte ho nastavit na CHMOD 755 alebo 777 pred pridaním obrázkov !',
    'target_album' => '<strong>Vloži obrázky z &quot;</strong>%s<strong>&quot; do </strong>%s',
    'folder' => 'Zložka',
    'image' => 'Obrázok',
    'album' => 'Galéria',
    'result' => 'Výsledok',
    'dir_ro' => 'Nezapisovate¾ná. ',
    'dir_cant_read' => 'Neèitate¾ná. ',
    'insert' => 'Pridávám nové obrázky do galérie',
    'list_new_pic' => 'Zoznam obrázkov',
    'insert_selected' => 'Vloži vybrané obrázky',
    'no_pic_found' => 'Nové obrázky neboli nájdené',
    'be_patient' => 'Prosím buïte trpezlivý(á), program potrebuje na spracovanie obrázka nejaký ten èas.',
    'notes' =>  '<ul>'.
                '<li><strong>OK</strong> : Tieto obrázky boli pridané'.
                '<li><strong>DP</strong> : Zdvojenie!, Tento obrázok už existuje'.
                '<li><strong>PB</strong> : tento obrázok nemožno prida, skontrolujte konfiguráciu prípadne prístupové práva'.
                '<li>Ak se neukáže \'oznaèenie\' OK, DP, PB kliknite na obrázek a uvidíte chybovú hlášku generovanú PHP, ktorá Vám pomôže zisti príèinu problému'.
                '<li>Pokia¾ dôjde k timeoutu F5 alebo reload stránky by mal pomôc'.
                '</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'Vykopnutý užívatelia',
                'user_name' => 'Užívate¾ske meno',
                'ip_address' => 'IP Adresa',
                'expiry' => 'Vyprší za (nevyplòova pre stále vykopnutie)',
                'edit_ban' => 'Uloži zmeny',
                'delete_ban' => 'Zmaza',
                'add_new' => 'Prida dalšie vykopnutie',
                'add_ban' => 'Prida',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
    'title' => 'Uploadnú obrázok',
    'max_fsize' => 'Max. ve¾kos súboru je %s KB',
    'album' => 'Galéria',
    'picture' => 'Obrázok',
    'pic_title' => 'Nadpis obrázku',
    'description' => 'Popis obrázku',
    'keywords' => 'K¾úèové slová (oddelené medzerou)',
    'err_no_alb_uploadables' => 'Nie je tu galéria do ktorej je povolený upload.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Spravova užívate¾ov',
    'name_a' => 'Meno vzostup.',
    'name_d' => 'Meno zostup.',
    'group_a' => 'Skupina vzostup.',
    'group_d' => 'Skupina zostup.',
    'reg_a' => 'Dátum registrácie vzostup.',
    'reg_d' => 'Dátum registrácie zostup.',
    'pic_a' => 'Poèet obrázkov vzostup.',
    'pic_d' => 'Poèet obrázkov zostup.',
    'disku_a' => 'Využitie disku vzostup.',
    'disku_d' => 'Využitie disku zostup.',
    'sort_by' => 'Radi užívate¾ov pod¾a',
    'err_no_users' => 'Tabu¾ka užívate¾ov je prázdna!',
    'err_edit_self' => 'Tu nemôžte editova vlastný profil použijte príslušnú vo¾bu pracujúcu s vašim profilom',
    'edit' => 'UPRAVI',
    'delete' => 'ZMAZA',
    'name' => 'Uživ. meno',
    'group' => 'Skupina Uživ.',
    'inactive' => 'Neaktivný',
    'operations' => 'Operácia',
    'pictures' => 'Obrázky',
    'disk_space' => 'Miesto využité / kvóta',
    'registered_on' => 'Registrovaný',
    'u_user_on_p_pages' => '%d užívate¾ov na %d stránkach',
    'confirm_del' => 'Ste si jistý(á), že chcete zmaza tohto užívate¾a ? \\nVšetky jeho obrázky, galérie a komentáre budú zmazané.',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Vybraný užív. neexistuje !',
    'modify_user' => 'Zmeni užív.',
    'notes' => 'Poznámky',
    'note_list' => '<li>Pokia¾ nechcete zmeni heslo ponechajte políèko pre heslo prázdne',
    'password' => 'Heslo',
    'user_active' => 'Užív. je aktívny',
    'user_group' => 'Užív. Skupina',
    'user_email' => 'Užív. emaill',
    'user_web_site' => 'Užív. domáca stránka',
    'create_new_user' => 'Vytvori nového užívate¾a.',
    'user_location' => 'Mesto Užív. (napr. Košice apod.)',
    'user_interests' => 'Užív. záujmy',
    'user_occupation' => 'Užív. povolanie',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmeni ve¾kos obrázku',
        'what_it_does' => 'Èo to robí?',
        'what_update_titles' => 'Aktualizova nadpisy pod¾a mena súborov',
        'what_delete_title' => 'Zmaza nadpisy',
        'what_rebuild' => 'Prerobi náh¾ady a zmenené obrázky',
        'what_delete_originals' => 'Zmaza originály a nahradi ich strednými obrázkami',
        'file' => 'súbor',
        'title_set_to' => 'Nastavi nadpis na',
        'submit_form' => 'odosla',
        'updated_succesfully' => 'Aktualizácia probehla OK',
        'error_create' => 'CHYBA pri vytváraní',
        'continue' => 'Spracova viac obrázkov',
        'main_success' => 'Súbor %s bol uspešne použitý ako hlavný obrázok',
        'error_rename' => 'Chyba premenovávaní %s na %s',
        'error_not_found' => 'súbor %s nebol nájdený',
        'back' => 'spä na halvnú',
        'thumbs_wait' => 'Aktualizujem náh¾ady a/alebo stredné obrázky, prosím èakajte...',
        'thumbs_continue_wait' => 'Pokraèujem v aktualizácii náh¾adov a/alebo stredných obrázkov...',
        'titles_wait' => 'Aktualizujem nadpisy, prosím èakajte...',
        'delete_wait' => 'Mažem nadpisy, prosím èakajte...',
        'replace_wait' => 'Mažem originály a nahrádzam ich strednými obrázkami, prosím èakajte...',
        'instruction' => 'Rýchle inštrukcie',
        'instruction_action' => 'Vyberte akciu',
        'instruction_parameter' => 'Nastavi parametre',
        'instruction_album' => 'Vybra galériu',
        'instruction_press' => 'Stlaète %s',
        'update' => 'Aktualizova náh¾ady a/alebo stredné obrázky',
        'update_what' => 'Èo má by aktualizované',
        'update_thumb' => 'Len náh¾ady',
        'update_pic' => 'Iba stredné obrázky',
        'update_both' => 'Oboje náh¾ady i stredné obrázky',
        'update_number' => 'Poèet obrázkov, ktoré spracova na 1 kliknutie',
        'update_option' => '(Znížte èíslo pokia¾ máte problémy s timeoutom)',
        'filename_title' => 'Meno súboru ? Nadpis obrázka',
        'filename_how' => 'Ako sa má zmeni meno obrázka?',
        'filename_remove' => 'Odstráni .jpg koncovku a prepísa _ (podtržítka medzerami)',
        'filename_euro' => 'Zmeni 2003_11_23_13_20_20.jpg na 23/11/2003 13:20',
        'filename_us' => 'Zmeni 2003_11_23_13_20_20.jpg na 11/23/2003 13:20',
        'filename_time' => 'Zmeni 2003_11_23_13_20_20.jpg na 13:20',
        'delete' => 'Zmaza nadpisy obrázkov alebo originálne obrázky',
        'delete_title' => 'Zmaza nadpisy obrázkov',
        'delete_original' => 'Zmaza originálne obrázky',
        'delete_replace' => 'Zmaza originály a nahradi ich strednými verziami obrázkov',
        'select_album' => 'Vybra galériu',
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