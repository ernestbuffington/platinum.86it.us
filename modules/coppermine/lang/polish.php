<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by CPG-nuke Dev Team                                                 //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');
$lang_translation_info = array(
'lang_name_english' => 'Polish',  
'lang_name_native' => 'Polish', 
'lang_country_code' => 'pl', 
'trans_name'=> 'Jacek Domoñ', //the name of the translator - can be a nickname
'trans_email' => 'plusz@plusnet.pl', //translator's email address (optional)
'trans_website' => 'http://www.plusz.futuremedia.pl/', //translator's website (optional)
'trans_date' => '2003-04-20', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bajty', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Niedziela', 'Poniedzia³ek', 'Wtorek', '¦roda', 'Czwartek', 'Pi±tek', 'Sobota');
$lang_month = array('Styczeñ', 'Luty', 'Marzec', 'Kwiecieñ', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpieñ', 'Wrzesieñ', 'Pa¼dziernik', 'Listopad', 'Grudzieñ');

// Some common strings
$lang_yes = 'Tak';
$lang_no  = 'Nie';
$lang_back = 'Wstecz';
$lang_continue = 'Dalej';
$lang_info = 'Informacja';
$lang_error = 'B³±d';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y @ %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y @ %I:%M %p';
$comment_date_fmt =  '%B %d, %Y @ %I:%M %p';

// For the word censor
$lang_bad_words = array('');

$lang_meta_album_names = array(
        'random' => 'Losowo wybrane zdjêcia ',
        'lastup' => 'Ostatnio dodane zdjêcia',
        'lastupby' => 'My Last Additions', // new 1.2.2
        'lastalb'=> 'Ostatnio dodane albumy', 
        'lastcom' => 'Ostatnio dodane komentarze',
        'lastcomby' => 'My Last comments', // new 1.2.2
        'topn' => 'Najpopularniejsze zdjêcia',
        'toprated' => 'Najwy¿ej oceniane zdjêcia',
        'lasthits' => 'Ostatnio ogl±dane zdjêcia',
        'search' => 'Wyniki wyszukiwania', 
        'favpics'=> 'Ulubione zdjêcia' 
);

$lang_errors = array(
        'access_denied' => 'Nie masz uprawnieñ aby ogl±daæ tê stronê.',
        'perm_denied' => 'Nie masz uprawnieñ aby wykonaæ tê operacjê.',
        'param_missing' => 'Skrypt zosta³ wywo³any bez wymaganego parametru/ów.',
        'non_exist_ap' => 'Wybrany album/zdjêcie nie istnieje!!',
        'quota_exceeded' => 'Przekroczono limit miejsca na pliki<br /><br />Twój przydzia³: [quota]K, Twoje zdjêcia u¿ywaj± obecnie: [space]K. Dodanie tego zdjêcia powoduje przekroczenie limitu.',
        'gd_file_type_err' => 'Je¿li w u¿yciu jest biblioteka GD, dozwolone formaty zdjêæ to wy³±cznie JPEG i PNG.',
        'invalid_image' => 'Zdjêcie które przes³ano nie mo¿e byæ obs³u¿one przez bibliotekê GD.',
        'resize_failed' => 'Nie mo¿na stworzyæ miniatury lub zdjêcia po¶redniego.',
        'no_img_to_display' => 'Brak zdjêcia do wy¶wietlenia',
        'non_exist_cat' => 'Wybrana kategoria nie istnieje',
        'orphan_cat' => 'Kategoria nie ma nadrzêdnej ga³êzi, uruchom mened¿era kategorii aby rozwi±zaæ ten problem.',
        'directory_ro' => 'Katalog \'%s\' jest zabezpieczony przed zapisem',
        'non_exist_comment' => 'Wybrany komentarz nie istnieje.',
        'pic_in_invalid_album' => 'Zdjêcie znajduje siê w nieistniej±cym albumie (%s)!?', 
        'banned' => 'Obecnie Twój dostêp do strony zosta³ zablokowany.', 
        'not_with_udb' => 'Ta funkcja jest zablokowana, poniewa¿ Coppermine jest zintegrowane z oprogramowaniem do obs³ugi forum. Alternatywnie funkcja nie jest obs³ugiwana przy bie¿±cej konfiguracji.', 
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Przejd¼ do listy albumów',
        'alb_list_lnk' => 'Albumy',
        'my_gal_title' => 'Do prywatnej galerii',
        'my_gal_lnk' => 'Moja galeria',
        'my_prof_lnk' => 'Mój profil',
        'adm_mode_title' => 'Prze³±cz w tryb administratora',
        'adm_mode_lnk' => 'Tryb administratora',
        'usr_mode_title' => 'Prze³±cz w tryb u¿ytkownika',
        'usr_mode_lnk' => 'Tryb u¿ytkownika',
        'upload_pic_title' => 'Upload zdjêcia do albumu',
        'upload_pic_lnk' => 'Upload zdjêcia',
        'register_title' => 'Utwórz konto',
        'register_lnk' => 'Zarejestruj siê',
        'login_lnk' => 'Zaloguj',
        'logout_lnk' => 'Wyloguj',
        'lastup_lnk' => 'Ostatnie uploady',
        'lastcom_lnk' => 'Ostatnie komentarze',
        'topn_lnk' => 'Najpopularniejsze',
        'toprated_lnk' => 'Top Lista',
        'search_lnk' => 'Szukaj',
        'fav_lnk' => 'Ulubione', 

);

$lang_gallery_admin_menu = array(
        'upl_app_lnk' => 'Akceptacja zdjêæ',
        'config_lnk' => 'Konfiguracja',
        'albums_lnk' => 'Albumy',
        'categories_lnk' => 'Kategorie',
        'users_lnk' => 'U¿ytkownicy',
        'groups_lnk' => 'Grupy',
        'comments_lnk' => 'Komentarze',
        'searchnew_lnk' => 'Wsadowe przetwarzanie zdjêæ',
        'util_lnk' => 'Zmiana rozmiaru zdjêæ', 
        'ban_lnk' => 'Banowanie', 
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Tworzenie / porz±dkowanie albumów',
        'modifyalb_lnk' => 'Modyfikacja moich albumów',
        'my_prof_lnk' => 'Mój profil',
);

$lang_cat_list = array(
        'category' => 'Kategoria',
        'albums' => 'Albumy',
        'pictures' => 'Zdjêcia',
);

$lang_album_list = array(
        'album_on_page' => 'albumów: %d stron: %d'
);

$lang_thumb_view = array(
        'date' => 'DATA',
        'name' => 'NAZWA PLIKU', 
        'title' => 'TYTU£', 
        'sort_da' => 'Sortowanie wg daty rosn±co',
        'sort_dd' => 'Sortowanie wg daty malej±co',
        'sort_na' => 'Sortowanie wg nazwy rosn±co',
        'sort_nd' => 'Sortowanie wg nazwy malej±co',
        'sort_ta' => 'Sortowanie wg tytu³u rosn±co', 
        'sort_td' => 'Sortowanie wg tytu³u malej±co', 
        'pic_on_page' => 'zdjêæ: %d stron: %d',
        'user_on_page' => 'u¿ytkowników: %d stron: %d',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
        'thumb_title' => 'Wróæ do widoku miniatur',
        'pic_info_title' => 'Wy¶wietl/ukryj info o zdjêciu',
        'slideshow_title' => 'Pokaz slajdów',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Wy¶lij jako e-kartkê',
        'ecard_disabled' => 'e-kartki s± wy³±czone',
        'ecard_disabled_msg' => 'Nie masz uprawnieñ do wysy³ania e-kartek',
        'prev_title' => 'Poprzednie zdjêcie',
        'next_title' => 'Nastêpne zdjêcie',
        'pic_pos' => 'Zdjêcie %s/%s',
        'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Oceñ te zdjêcie ',
        'no_votes' => '(Brak g³osów)',
        'rating' => '(obecna ocena : %s / 5 g³osów: %s)',
        'rubbish' => 'Do niczego',
        'poor' => 'S³abe',
        'fair' => 'Niez³e',
        'good' => 'Dobre',
        'excellent' => 'B. dobre',
        'great' => 'Doskona³e',
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
        CRITICAL_ERROR => 'B³±d krytyczny',
        'file' => 'Plik: ',
        'line' => 'Linia: ',
);

$lang_display_thumbnails = array(
        'filename' => 'Nazwa pliku: ',
        'filesize' => 'Rozmiar pliku: ',
        'dimensions' => 'Wymiary: ',
        'date_added' => 'Data dodania: '
);

$lang_get_pic_data = array(
        'n_comments' => 'komentarzy: %s ',
        'n_views' => 'ods³on: %s ',
        'n_votes' => '(g³osów: %s)'
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
        'Exclamation' => 'Wykrzyknik',
        'Question' => 'Pytanie',
        'Very Happy' => 'Bardzo zadowolony',
        'Smile' => 'U¶miechniêty',
        'Sad' => 'Smutny',
        'Surprised' => 'Zaskoczony',
        'Shocked' => 'Zszokowany',
        'Confused' => 'Zniesmaczony',
        'Cool' => 'Luzak',
        'Laughing' => '¦mieje siê',
        'Mad' => 'W¶ciek³y',
        'Razz' => 'Jêzorek',
        'Embarassed' => 'Zawstydzony / gafa',
        'Crying or Very sad' => 'Zrozpaczony',
        'Evil or Very Mad' => 'W¶ciek³y do kwadratu',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Przewraca oczami',
        'Wink' => 'Puszcza oczko',
        'Idea' => 'Pomys³',
        'Arrow' => 'Strza³ka',
        'Neutral' => 'Neutralny',
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
        0 => 'Zakoñczono pracê administratora...',
        1 => 'Prze³±czanie do trybu administratora...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albumy musz± mieæ nazwê !',
        'confirm_modifs' => 'Czy na pewno chcesz dokonaæ tych modyfikacji ?',
        'no_change' => 'Nie dokona³e¶/a¶ ¿adnej zmiany !',
        'new_album' => 'Nowy album',
        'confirm_delete1' => 'Czy na pewno chcesz skasowaæ ten album ?',
        'confirm_delete2' => '\nWszystkie zdjêcia i komentarze które zawiera zostan± stracone !',
        'select_first' => 'Wybierz pierwszy album',
        'alb_mrg' => 'Mened¿er albumów',
        'my_gallery' => '* Moja galeria *',
        'no_category' => '* Bez kategorii *',
        'delete' => 'Kasuj',
        'new' => 'Nowy',
        'apply_modifs' => 'Wykonaj modyfikacje',
        'select_category' => 'Wybierz kategoriê',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Brak parametrów do operacji \'%s\'!',
        'unknown_cat' => 'Wybrana kategoria nie istnieje w bazie danych',
        'usergal_cat_ro' => 'Galerie u¿ytkowników nie mog± byæ kasowane!',
        'manage_cat' => 'Zarz±dzaj kategoriami',
        'confirm_delete' => 'Czy jeste¶ pewny/a ¿e chcesz SKASOWAÆ tê kategoriê',
        'category' => 'Kategoria',
        'operations' => 'Operacje',
        'move_into' => 'Przesuñ do',
        'update_create' => 'Uaktualnij / stwórz kategoriê',
        'parent_cat' => 'Kategoria wy¿szego rzêdu',
        'cat_title' => 'Tytu³ kategorii',
        'cat_desc' => 'Opis kategorii'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
'title' => 'Konfiguracja',
'restore_cfg' => 'Przywróæ ustawienia domy¶lne',
'save_cfg' => 'Zachowaj now± konfiguracjê',
'notes' => 'Notatki',
'info' => 'Informacja',
'upd_success' => 'Konfiguracja Coppermine zosta³a uaktualniona',
'restore_success' => 'Konfiguracja Coppermine zosta³a przywrócona',
'name_a' => 'Nazwa rosn±co',
'name_d' => 'Nazwa malej±co',
'title_a' => 'Tytu³ rosn±co', 
'title_d' => 'Tytu³ malej±co', 
'date_a' => 'Data rosn±co',
'date_d' => 'Data malej±co',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
'th_any' => 'Maksymalne rozmiary',
'th_ht' => 'Wysoko¶æ',
'th_wd' => 'Szeroko¶æ',
      );
// start left side interpretation
if (defined('CONFIG_PHP')) 
$lang_config_data = array(
//'General settings',
'Ustawienia g³ówne',
array(
'Nazwa galerii', 'gallery_name', 0),        
array(
'Opis galerii', 'gallery_description', 0),        
array(
'E-mail administratora galerii', 'gallery_admin_email', 0),        
array(
'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
array(
'Jêzyk', 'lang', 5),
// for postnuke change
array(
'Styl galerii', 'theme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
//'Album list view',
'Przegl±danie listy albumów',        
array(
'Szeroko¶æ g³ównej galerii (piksele lub %)', 'main_table_width', 0),        
array(
'Ilo¶æ kategorii do wy¶wietlenia', 'subcat_level', 0),        
array(
'Ilo¶æ albumów do wy¶wietlenia', 'albums_per_page', 0),        
array(
'Ilo¶æ kolumn w li¶cie albumów', 'album_list_cols', 0),        
array(
'Rozmiar miniatur w pikselach', 'alb_list_thumb_size', 0),        
array(
'Zawarto¶æ strony g³ównej', 'main_page_layout', 0),        
array(
'Poka¿ miniaturê pierwszego poziomu w miniaturach albumu','first_level',1), 
//'Thumbnail view',
'Widok miniatur',        
array(
'Ilo¶æ kolumn na stronie miniatur', 'thumbcols', 0),        
array(
'Ilo¶æ wierszy na stronie miniatur', 'thumbrows', 0),        
array(
'Maksymalna ilo¶æ pasków do wy¶wietlenia', 'max_tabs', 0),        
array(
'Wy¶wietl opis zdjêcia (oprócz tytu³u) poni¿ej miniatury', 'caption_in_thumbview', 1),        
array(
'Wy¶wietl ilo¶æ komentarzy poni¿ej miniatury', 'display_comment_count', 1),        
array(
'Domy¶lny porz±dek sortowania zdjêæ', 'default_sort_order', 3),        
array(
'Minimalna ilo¶æ g³osów niezbêdna do umieszczenia zdjêcia w kategorii \'Top Lista\'', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
//'Image view &amp; Comment settings',
'Ustawienia wy¶wietlania zdjêæ &amp; komentarzy',        
array(
'Szeroko¶æ tabeli wy¶wietlaj±cej zdjêcia (piksele lub %)', 'picture_table_width', 0),        
array(
'Domy¶lne pokazywanie Informacji o zdjêciu', 'display_pic_info', 1),        
array(
'Blokowanie s³ów z "listy zakazanych" w komentarzach', 'filter_bad_words', 1),        
array(
'Wy¶wietlanie emotikon w komentarzach', 'enable_smilies', 1),        
array(
'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
array(
'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
array(
'Maksymalna d³ugo¶æ opisu zdjêcia', 'max_img_desc_length', 0),        
array(
'Maksymalna ilo¶æ znaków w s³owie', 'max_com_wlength', 0),        
array(
'Maksymalna ilo¶æ linii w komentarzu', 'max_com_lines', 0),        
array(
'Maksymalna d³ugo¶æ komentarza (znaków)', 'max_com_size', 0),        
array(
'Poka¿ "pasek filmu" z miniaturami', 'display_film_strip', 1),        
array(
'Ilo¶æ elementów wy¶wietlanych w "pasku filmu" z miniaturami', 'max_film_strip_items', 0), 
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke

//'Pictures and thumbnails settings',
'Ustawienia zdjêæ i miniatur',        
array(
'Jako¶æ plików JPEG', 'jpeg_qual', 0),        
array(
'Maksymalny rozmiar miniatury <strong>*</strong>', 'thumb_width', 0),        
array(
'U¿yj wymiaru (szeroko¶æ, wysoko¶æ lub maksymalny widok dla miniatury)<strong>*</strong>', 'thumb_use', 7),        
array(
'Twórz zdjêcia po¶rednie','make_intermediate',1),        
array(
'Maksymalna szeroko¶æ zdjêcia po¶redniego <strong>*</strong>', 'picture_width', 0),        
array(
'Maksymalny rozmiar uploadowanych zdjêæ (KB)', 'max_upl_size', 0),        
array(
'Maksymana wysoko¶æ lub szeroko¶æ uploadowanych zdjêæ (w pikselach)', 'max_upl_width_height', 0),
//'User settings',
'Ustawienia u¿ytkowników',        
array(
'Zezwalanie na rejestracjê nowych u¿ytkowników', 'allow_user_registration', 1),        
array(
'Rejestracja u¿ytkownika wymaga potwierdzenia e-mail', 'reg_requires_valid_email', 1),        
array(
'Zezwalanie posiadania tego samego adresu e-mail przez dwóch u¿ytkowników', 'allow_duplicate_emails_addr', 1),        
array(
'U¿ytkownicy mog± tworzyæ albumy prywatne', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
'Nazwy dodatkowych pól do opisu zdjêcia (pozostaw je puste je¿eli nie s± u¿ywane)',        
array(
'Nazwa pola 1', 'user_field1_name', 0),        
array(
'Nazwa pola 2', 'user_field2_name', 0),        
array(
'Nazwa pola 3', 'user_field3_name', 0),        
array(
'Nazwa pola 4', 'user_field4_name', 0),
//'Pictures and thumbnails advanced settings',
'Zaawansowane ustawienia zdjêæ i miniatur',        
array(
'Pokazuj prywatn± ikonê albumu niezalogowanemu u¿ytkownikowi','show_private',1),        
array(
'Znaki zabronione w nazwach plików', 'forbiden_fname_char',0),        
array(
'Akceptowane rozszerzenia uploadowanych plików', 'allowed_file_extensions',0),        
array(
'Metoda zmiany rozmiaru zdjêæ','thumb_method',2),        
array(
'¦cie¿ka dostêpu do narzêdzia konwertuj±cego ImageMagick / netpbm \'convert\' (na przyk³ad /usr/bin/X11/)', 'impath', 0),        
array(
'Dozwolone nazwy plików (w³a¶ciwe dla ImageMagick)', 'allowed_img_types',0),        
array(
'Komendy linii poleceñ dla ImageMagick', 'im_options', 0),        
array(
'Czytaj dane EXIF w plikach JPEG', 'read_exif_data', 1),        
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'¦cie¿ka katalogu z albumami<strong>*</strong>', 'fullpath', 0),        
array(
'Nazwa katalogu na zdjêcia u¿ytkowników<strong>*</strong>', 'userpics', 0),        
array(
'Prefix dla zdjêæ po¶rednich <strong>*</strong>', 'normal_pfx', 0),        
array(
'Prefix dla miniatur<strong>*</strong>', 'thumb_pfx', 0),        
array(
'Domy¶lne uprawnienia katalogów (LINUX i podobne systemy)', 'default_dir_mode', 0),        
array(
'Domy¶lne uprawnienia plików ze zdjêciami (LINUX i podobne systemy)', 'default_file_mode', 0),
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
//'Cookies &amp; Charset settings',
'Ustawienia cookies &amp; zestawu znaków',        
array(
'Nazwa plików cookie tworzonych przez skrypt', 'cookie_name', 0),        
array(
'¦cie¿ka plików cookie tworzonych przez skrypt', 'cookie_path', 0),        
array(
'Zestaw znaków', 'charset', 4),
'Ró¿ne ustawienia',        
array(
'W³±cz tryb debugowania', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
'<br /><div align="center">(*) Pola oznaczone gwiazdk± nie mog± byæ zmienione je¿eli w galerii s± ju¿ zdjêcia</div><br />'
);
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
'empty_name_or_com' => 'Musisz podaæ swoje imiê i napisaæ komentarz',
        'com_added' => 'Twój komentarz zosta³ dodany',
        'alb_need_title' => 'Musisz podaæ tytu³ dla albumu!',
        'no_udp_needed' => 'Zmiana nie jest konieczna.',
        'alb_updated' => 'Album zosta³ uaktualniony',
        'unknown_album' => 'Wybrany album nie istnieje, lub nie masz uprawnieñ do uploadu',
        'no_pic_uploaded' => 'Zdjêcie nie zosta³o dodane!<br /><br />Je¿eli wybrano zdjêcie do przes³ania, sprawd¼ czy serwer na to zezwala...',
        'err_mkdir' => 'Nie uda³o siê utworzyæ katalogu %s !',
        'dest_dir_ro' => 'Katalog docelowy %s nie mo¿e byæ zapisany przez skrypt!',
        'err_move' => 'Nie mo¿na przenie¶æ %s do %s !',
        'err_fsize_too_large' => 'Zdjêcie które przesy³asz ma zbyt du¿y rozmiar (maksymalnie dozwolony: %s x %s) !',
        'err_imgsize_too_large' => 'Zdjêcie które przesy³asz ma zbyt du¿y rozmiar (maksymalnie dozwolony: to %s KB) !',
        'err_invalid_img' => 'Przes³ane zdjêcie nie jest w dozwolonym formacie!',
        'allowed_img_types' => 'Mo¿esz przes³aæ tylko %s zdjêæ.',
        'err_insert_pic' => 'Zdjêcie \'%s\' nie mo¿e zostaæ wstawione do albumu ',
        'upload_success' => 'Zdjêcie zosta³o przes³ane<br /><br />Bêdzie widoczne po akceptacji przez administratora.',
        'info' => 'Informacja',
        'com_added' => 'Dodano komentarz',
        'alb_updated' => 'Uaktualniono album',
        'err_comment_empty' => 'Twój komentarz jest pusty!',
        'err_invalid_fext' => 'Akceptowane s± jedynie zdjêcia z nastêpuj±cymi rozszerzeniami: <br /><br />%s.',
        'no_flood' => 'Przykro mi ale jeste¶/a¶ autorem ostatniego dodanego komentarza<br /><br />Mo¿esz go edytowaæ aby zmieniæ tre¶æ',
        'redirect_msg' => 'Jeste¶ przekierowywany.<br /><br /><br />Kliknij \'DALEJ\' je¿eli strona nie zmieni siê automatycznie',
        'upl_success' => 'Zdjêcie zosta³o przes³ane',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
'caption' => 'Tytu³',
        'fs_pic' => 'pe³ny rozmiar',
        'del_success' => 'skasowano',
        'ns_pic' => 'normalny rozmiar',
        'err_del' => 'nie mo¿e byæ skasowane',
        'thumb_pic' => 'miniatura',
        'comment' => 'komentarz',
        'im_in_alb' => 'zdjêcie z albumu',
        'alb_del_success' => 'Skasowano album \'%s\' ',
        'alb_mgr' => 'Mened¿er albumów',
        'err_invalid_data' => 'Otrzymano niew³a¶ciwe dane \'%s\'',
        'create_alb' => 'Tworzenie albumu \'%s\'',
        'update_alb' => 'Uaktualnienie albumu: \'%s\' tytu³: \'%s\' index: \'%s\'',
        'del_pic' => 'Kasowanie zdjêcia',
        'del_alb' => 'Kasowanie albumu',
        'del_user' => 'Kasowanie u¿ytkownika',
        'err_unknown_user' => 'Wybrany u¿ytkownik nie istnieje!',
        'comment_deleted' => 'Komentarz zosta³ dodany',
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
        'confirm_del' => 'Czy na pewno chcesz skasowaæ te zdjêcie? \\nZostan± skasowane równie¿ komentarze do niego.',
        'del_pic' => 'SKASUJ TE ZDJÊCIE',
        'size' => '%s x %s pixels',
        'views' => '%s times',
        'slideshow' => 'Pokaz slajdów',
        'stop_slideshow' => 'ZATRZYMAJ POKAZ',
        'view_fs' => 'Kliknij aby zobaczyæ pe³ny rozmiar',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
);

$lang_picinfo = array(
        'title' =>'Informacja',
        'Filename' => 'Nazwa pliku',
        'Album name' => 'Nazwa albumu',
        'Rating' => 'Ocena (%s g³osów)',
        'Keywords' => 'S³owa kluczowe',
        'File Size' => 'Rozmiar pliku',
        'Dimensions' => 'Wymiary',
        'Displayed' => 'Wy¶wietleñ',
        'Camera' => 'Aparat fotograficzny',
        'Date taken' => 'Data zrobienia zdjêcia',
        'Aperture' => 'Przes³ona',
        'Exposure time' => 'Czas ekspozycji',
        'Focal length' => 'Ogniskowa',
        'Comment' => 'Komentarz',
        'addFav'=>'Dodaj do Ulubionych', 
        'addFavPhrase'=>'Ulubione', 
        'remFav'=>'Usuñ z Ulubionych', 
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
);

$lang_display_comments = array(
        'OK' => 'OK',
        'edit_title' => 'Edytuj ten komentarz',
        'confirm_delete' => 'Czy na pewno chcesz skasowaæ ten komentarz ?',
        'add_your_comment' => 'Dodaj komentarz',
        'name'=>'Pseudonim', 
        'comment'=>'Komentarz', 
        'your_name' => 'Anonim', 
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknij zdjêcie aby zamkn±æ okno', 
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Wy¶lij e-kartkê',
        'invalid_email' => '<strong>Uwaga!</strong> : niepoprawny adres e-mail !',
        'ecard_title' => 'e-kartka od %s dla Ciebie',
        'view_ecard' => 'Je¿eli e-kartka nie wy¶wietla siê poprawnie, kliknij ten link',
        'view_more_pics' => 'Kliknij ten link aby zobaczyæ wiêcej zdjêæ!',
        'send_success' => 'Twoja e-kartka zosta³a wys³ana',
        'send_failed' => 'Niestety, serwer nie mo¿e wys³aæ Twojej e-kartki...',
        'from' => 'Od',
        'your_name' => 'Twoje imiê',
        'your_email' => 'Twój adres e-mail',
        'to' => 'Do',
        'rcpt_name' => 'Nazwa odbiorcy',
        'rcpt_email' => 'Adres e-mail odbiorcy',
        'greetings' => 'Temat',
        'message' => 'Wiadomo¶æ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Zdjêcie&nbsp;Info',
        'album' => 'Album',
        'title' => 'Tytu³',
        'desc' => 'Opis',
        'keywords' => 'S³owa kluczowe',
        'pic_info_str' => '%s &razy; %s - %s KB - %s ods³on - %s g³osów',
        'approve' => 'Akceptuj zdjêcie',
        'postpone_app' => 'Odrocz akceptacjê',
        'del_pic' => 'Skasuj zdjêcie',
        'reset_view_count' => 'Resetuj licznik ods³on',
        'reset_votes' => 'Resetuj g³osowania',
        'del_comm' => 'Skasuj komentarze',
        'upl_approval' => 'Akceptacja uploadu',
        'edit_pics' => 'Edytuj zdjêcia',
        'see_next' => 'Zobacz nastêpne zdjêcia',
        'see_prev' => 'Zobacz poprzednie zdjêcia',
        'n_pic' => 'zdjêæ: %s',
        'n_of_pic_to_disp' => 'Ilo¶æ zdjêæ do wy¶wietlenia',
        'apply' => 'Zastosuj zmiany'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Nazwa grupy',
        'disk_quota' => 'Miejsce na dane',
        'can_rate' => 'Mo¿e oceniaæ zdjêcia',
        'can_send_ecards' => 'Mo¿e wysy³aæ e-kartki',
        'can_post_com' => 'Mo¿e zamieszczaæ komentarze',
        'can_upload' => 'Mo¿e przesy³aæ zdjêcia',
        'can_have_gallery' => 'Mo¿e mieæ galeriê osobist±',
        'apply' => 'Zastosuj zmiany',
        'create_new_group' => 'Stwórz now± grupê',
        'del_groups' => 'Skasuj zaznaczon± grupê/y',
        'confirm_del' => 'Uwaga: je¿eli skasujesz tê grupê jej cz³onkowie zostan± przeniesieni do grupy \'Zarejestrowani\'!\n\nKontynuowaæ?',
        'title' => 'Zarz±dzanie grupami',
        'approval_1' => 'Zgoda na pub. upl.(1)',
        'approval_2' => 'Zgoda na priv. upl.(2)',
        'note1' => '<strong>(1)</strong> Przesy³anie zdjêæ do albumu publicznego wymaga zgody administratora',
        'note2' => '<strong>(2)</strong> Przesy³anie zdjêæ do albumu u¿ytkownika wymaga zgody administratora',
        'notes' => 'Uwagi'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
        'welcome' => 'Witaj!'
);

$lang_album_admin_menu = array(
        'confirm_delete' => 'Czy na pewno chcesz skasowaæ ten album? \\nZostan± skasowane równie¿ wszystkie zdjêcia i komentarze.',
        'delete' => 'KASUJ',
        'modify' => 'W£A¦CIWO¦CI',
        'edit_pics' => 'EDYTUJ ZDJÊCIA',
);

$lang_list_categories = array(
        'home' => 'Strona g³ówna',
        'stat1' => 'zdjêcia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, kategorie: <strong>[cat]</strong>, komentarze: <strong>[comments]</strong>, ods³ony: <strong>[views]</strong>',
        'stat2' => 'zdjêcia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, ods³ony: <strong>[views]</strong>',
        'xx_s_gallery' => '%s\'s galeria',
        'stat3' => 'zdjêcia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, komentarze: <strong>[comments]</strong>, ods³ony: <strong>[views]</strong>'
);

$lang_list_users = array(
        'user_list' => 'Lista u¿ytkowników',
        'no_user_gal' => 'Galerie u¿ytkowników nie istniej±',
        'n_albums' => '%s album/y',
        'n_pics' => '%s zdjêcie/êæ'
);

$lang_list_albums = array(
        'n_pictures' => 'zdjêæ: %s',
        'last_added' => ', ostatnie dodano: %s'
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

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
        'upd_alb_n' => 'Uaktualnij album %s',
        'general_settings' => 'Ustawienia ogólne',
        'alb_title' => 'Tytu³ albumu',
        'alb_cat' => 'Kategoria albumu',
        'alb_desc' => 'Opis albumu',
        'alb_thumb' => 'Miniatury',
        'alb_perm' => 'Uprawnienia albumu',
        'can_view' => 'Mo¿e byæ ogl±dany przez',
        'can_upload' => 'Go¶cie mog± przesy³aæ zdjêcia',
        'can_post_comments' => 'Go¶cie mog± dodawaæ komentarze',
        'can_rate' => 'Go¶cie mog± oceniaæ zdjêcia',
        'user_gal' => 'Galeria u¿ytkownika',
        'no_cat' => '* Bez kategorii *',
        'alb_empty' => 'Album jest pusty',
        'last_uploaded' => 'Ostatnio przes³ane',
        'public_alb' => 'Wszyscy (album publiczny)',
        'me_only' => 'Tylko ja',
        'owner_only' => 'Tylko w³a¶ciciel albumu: (%s)',
        'groupp_only' => 'Cz³onkowie grupy: \'%s\'',
        'err_no_alb_to_modify' => 'Nie mo¿na modyfikowaæ ¿adnego albumu w bazie.',
        'update' => 'Uaktualnij album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Przykro nam, ale ju¿ oceni³e¶ te zdjêcie',
        'rate_ok' => 'Twój g³os zosta³ zapisany',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'I agree' below you agree to be bound by these conditions.
EOT;

$lang_register_php = array(
        'page_title' => 'Rejestrowanie u¿ytkownika',
        'term_cond' => 'Warunki korzystania z serwisu',
        'i_agree' => 'Zgadzam siê',
        'submit' => 'Wykonaj rejestracjê',
        'err_user_exists' => 'Nazwa u¿ytkownika któr± wybra³e¶ ju¿ istnieje. Wybierz inn±',
        'err_password_mismatch' => 'Has³a nie pasuj± do siebie. Wpisz je ponownie',
        'err_uname_short' => 'Nazwa u¿ytkownika musi mieæ co najmniej 2 znaki',
        'err_password_short' => 'Has³o musi mieæ co najmniej 2 znaki',
        'err_uname_pass_diff' => 'Nazwa u¿ytkownika i has³o musz± siê od siebie ró¿niæ',
        'err_invalid_email' => 'Adres e-mail jest niepoprawny',
        'err_duplicate_email' => 'W bazie jest ju¿ u¿ytkownik o podanym przez Ciebie adresie e-mail',
        'enter_info' => 'Wprowad¼ informacje potrzebne do rejestracji',
        'required_info' => 'Informacje wymagane',
        'optional_info' => 'Informacje opcjonalne',
        'username' => 'Nazwa u¿ytkownika',
        'password' => 'Has³o',
        'password_again' => 'Wprowad¼ ponownie has³o',
        'email' => 'E-mail',
        'location' => 'Lokalizacja',
        'interests' => 'Zainteresowania',
        'website' => 'Strona domowa',
        'occupation' => 'Zajêcie / zawód',
        'error' => 'B£¡D',
        'confirm_email_subject' => '%s - Informacja o rejestracji',
        'information' => 'Informacja',
        'failed_sending_email' => 'E-mail z potwierdzeniem nie mo¿e byæ wys³any!',
        'thank_you' => 'Dziêkujemy za rejestracjê.<br /><br />Na podany przez Ciebie adres e-mail zosta³ wys³any list z pro¶b± o potwierdzenie.',
        'acct_created' => 'Konto zosta³o utworzone. Mo¿esz ju¿ zalogowaæ siê podaj±c wybran± wczesniej nazwê u¿ytkownika, oraz has³o',
        'acct_active' => 'Konto jest ju¿ aktywne. Mo¿esz ju¿ zalogowaæ siê podaj±c wybran± wczesniej nazwê u¿ytkownika, oraz has³o',
        'acct_already_act' => 'Twoje konto zosta³o ju¿ aktywowane!',
        'acct_act_failed' => 'Te konto nie mo¿e byæ aktywowane!',
        'err_unk_user' => 'Podany u¿ytkownik nie istnieje!',
        'x_s_profile' => 'profil: %s',
        'group' => 'Grupa',
        'reg_date' => 'Do³±czy³/a',
        'disk_usage' => 'U¿yte miejsce',
        'change_pass' => 'Zmieñ has³o',
        'current_pass' => 'Bie¿±ce has³o',
        'new_pass' => 'Nowe has³o',
        'new_pass_again' => 'Podaj ponownie nowe has³o',
        'err_curr_pass' => 'Bie¿±ce has³o jest niepoprawne',
        'apply_modif' => 'Zastosuj zmiany',
        'change_pass' => 'Zmiañ moje has³o',
        'update_success' => 'Twój profil zosta³ uaktualniony',
        'pass_chg_success' => 'Twoje has³o zosta³o zmienione',
        'pass_chg_error' => 'Twoje has³o nie zosta³o zmienione',
);

$lang_register_confirm_email = <<<EOT
Dziêkujemy za rejestracjê w witrynie {SITE_NAME}

Twoja nazwa u¿ytkownika to: "{USER_NAME}"
Twoje has³o to: "{PASSWORD}"

Aby aktywowaæ konto kliknij na poni¿szy link albo skopiuj go
i wklej do swojej przegl±darki internetowej.

{ACT_LINK}

Pozdrowienia,

Zespó³ strony {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Przegl±daj komentarze',
        'no_comment' => 'Nie ma komentarzy do przegl±dania',
        'n_comm_del' => 'Skasowano komentarzy: %s',
        'n_comm_disp' => 'Ilo¶æ komentarzy do wy¶wietlenia',
        'see_prev' => 'Zobacz poprzednie',
        'see_next' => 'Zobacz nastêpne',
        'del_comm' => 'Skasuj wybrane komentarze',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Wyszukiwarka zdjêæ',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Wyszukiwarka zdjêæ',
        'select_dir' => 'Wybierz katalog',
        'select_dir_msg' => 'Wybrana funkcja umo¿liwia wsadowe dodawanie do galerii zdjêæ które zosta³y przes³ane na serwer.<br /><br />Wybierz katalog do którego zosta³y przes³ane wybrane zdjêcia',
        'no_pic_to_add' => 'Brak zdjêæ do dodania',
        'need_one_album' => 'Aby funkcja dzia³a³a, potrzebny jest przynajmniej jeden album',
        'warning' => 'Ostrze¿enie',
        'change_perm' => 'skrypt nie mo¿e zapisywaæ plików do wybranego katalogu. Zmieñ ustawienia na 755 lub 777 zanim spróbujesz dodaæ zdjêcia!',
        'target_album' => '<strong>Zapisuje zdjêcia do katalogu &quot;</strong>%s<strong>&quot; </strong>%s',
        'folder' => 'Katalog',
        'image' => 'Zdjêcie',
        'album' => 'Album',
        'result' => 'Wynik',
        'dir_ro' => 'Nie mo¿na zapisaæ. ',
        'dir_cant_read' => 'Nie mo¿na odczytaæ. ',
        'insert' => 'Dodawanie nowych zdjêæ do galerii',
        'list_new_pic' => 'Lista nowych zdjêæ',
        'insert_selected' => 'Wstaw wybrane zdjêcia',
        'no_pic_found' => 'Nie znaleziono nowych zdjêæ',
        'be_patient' => 'Proszê o cierpliwo¶æ, skrypt potrzebuje czasu na dodanie zdjêæ',
        'notes' =>  '<ul>'.
                                '<li><strong>OK</strong> : oznacza, ¿e zdjêcie zosta³o dodane'.
                                '<li><strong>DP</strong> : oznacza, ¿e zdjêcie jest zduplikowane i istnieje ju¿ w bazie'.
                                '<li><strong>PB</strong> : oznacza brak mo¿liwo¶ci dodania zdjêcia. Sprawd¼ swoje uprawnienia do zapisywania katalogów i plików'.
                                '<li>Je¿eli OK, \'znaki\' DP, PB nie pojawiaj± siê, kliknij na zdjêciu aby otrzymaæ komunikat generowany przez PHP'.
                                '<li>Je¿eli przegl±darka nie za³adowa³a strony, wci¶nij klawisz F5 aby j± od¶wie¿yæ'.
                                '</ul>',
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

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
        'title' => 'Prze¶lij zdjêcie',
        'max_fsize' => 'Maksymalny rozmiar zdjêcia to %s KB',
        'album' => 'Album',
        'picture' => 'Zdjêcie',
        'pic_title' => 'Tytu³ zdjêcia',
        'description' => 'Opis zdjêcia',
        'keywords' => 'S³owa kluczowe (oddzielone spacjami)',
        'err_no_alb_uploadables' => 'Przykro mi, ale nie ma albumu do którego móg³by¶/a¶ przes³aæ zdjêcia',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Zarz±dzanie u¿ytkownikami',
        'name_a' => 'Nazwa rosn±co',
        'name_d' => 'Nazwa malej±co',
        'group_a' => 'Grupa rosn±co',
        'group_d' => 'Grupa malej±co',
        'reg_a' => 'Data rej. rosn±co',
        'reg_d' => 'Data rej. malej±co',
        'pic_a' => 'Liczba zdjêæ rosn±co',
        'pic_d' => 'Liczba zdjêæ malej±co',
        'disku_a' => 'U¿ycie dysku rosn±co',
        'disku_d' => 'U¿ycie dysku malej±co',
        'sort_by' => 'Posortuj u¿ytkowników wg',
        'err_no_users' => 'Tabela u¿ytkowników jest pusta!',
        'err_edit_self' => 'Nie mo¿esz modyfikowaæ teraz swojego profilu. Aby to zrobiæ kliknij ³±cze \'Mój profil\'',
        'edit' => 'EDYTUJ',
        'delete' => 'KASUJ',
        'name' => 'Nazwa u¿ytkownika',
        'group' => 'Grupa',
        'inactive' => 'Nieaktywny',
        'operations' => 'Operacje',
        'pictures' => 'Pictures',
        'disk_space' => 'U¿yte miejsce / Quota',
        'registered_on' => 'Zerejestrowano',
        'u_user_on_p_pages' => 'u¿ytkowników: %d na stronach: %d',
        'confirm_del' => 'Czy na pewno chcesz skasowaæ tego u¿ytkownika? \\nWszystkie jego zdjêcia i alumy zostan± automatycznie skasowane.',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'Wybrany u¿ytkownik nie istnieje',
        'modify_user' => 'Modyfikuj u¿ytkownika',
        'notes' => 'Uwagi',
        'note_list' => '<li>Je¿eli nie chcesz zmieniaæ swojego ulubionego has³a teraz, zostaw pole "has³o" puste',
        'password' => 'Has³o',
        'user_active' => 'U¿ytkownik jest aktywny',
        'user_group' => 'Grupa u¿ytkowników',
        'user_email' => 'Adres e-mail u¿ytkownika',
        'user_web_site' => 'Strona sieci web u¿ytkownika',
        'create_new_user' => 'Utwórz nowego u¿ytkownika',
        'user_from' => 'Lokacja u¿ytkownika',
        'user_interests' => 'Zainteresowania',
        'user_occ' => 'Zajêcie',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmieñ rozmiar zdjêæ', 
        'what_it_does' => 'Do czego to s³u¿y', 
        'what_update_titles' => 'Uaktualnia tytu³y nazwami plików', 
        'what_delete_title' => 'Kasuje tytu³y', 
        'what_rebuild' => 'Odbudowuje miniatury i zdjêcia po¶rednie', 
        'what_delete_originals' => 'Kasuje zdjêcia ¼ród³owe, zastêpuj±c je zdjêciami o zmienionych wymiarach', 
        'file' => 'Plik', 
        'title_set_to' => 'tytu³', 
        'submit_form' => 'prze¶lij', 
        'updated_succesfully' => 'zaktualizowano', 
        'error_create' => 'B£¡D tworzenia', 
        'continue' => 'Przetwarza wiêcej zdjêæ', 
        'main_success' => 'Plik %s zosta³ ustawiony jako zdjêcie g³ówne', 
        'error_rename' => 'B³±d przy zmiany nazwy z %s na %s', 
        'error_not_found' => 'Plik %s nie zosta³ znaleziony', 
        'back' => 'powrót na stronê g³ówn±', 
        'thumbs_wait' => 'Uaktualniam miniatury i/lub zrewymiarowane zdjêcia, proszê czekaæ...', 
        'thumbs_continue_wait' => 'Trwa uaktualnianie miniatur i/lub zrewymiarowanych zdjêæ...', 
        'titles_wait' => 'Uaktualnianie tytu³ów, proszê czekaæ...', 
        'delete_wait' => 'Kasowanie tytu³ów, proszê czekaæ...', 
        'replace_wait' => 'Kasowanie orygina³ów i zamienianie ich na zdjêcia o zmienionych wymiarach..', 
        'instruction' => 'Szybkie instrukcje', 
        'instruction_action' => 'Wybierz akcjê', 
        'instruction_parameter' => 'Ustaw parametry', 
        'instruction_album' => 'Wybierz album', 
        'instruction_press' => 'Naci¶nij %s', 
        'update' => 'Uaktualnij miniatury i/lub zrewymiarowane zdjêcia', 
        'update_what' => 'Do uaktualnienia', 
        'update_thumb' => 'Tylko miniatury', 
        'update_pic' => 'Tylko zdjêcia o zmienionych wymiarach', 
        'update_both' => 'Zarówno miniatury jak i zrewymiarowane zdjêcia', 
        'update_number' => 'Ilo¶æ przetworzonych zdjêæ/klikniêcie', 
        'update_option' => '(Spróbuj zmniejszyæ tê ilo¶æ, je¿eli zaobserwujesz problem z timeoutem)', 
        'filename_title' => 'Nazwa pliku &rArr; Tytu³ zdjêcia', 
        'filename_how' => 'Jak modyfikowaæ nazwê pliku', 
        'filename_remove' => 'Usuñ rozszerzenie .jpg i zamieñ _ (podkre¶lenie) na spacje', 
        'filename_euro' => 'Zmienia 2003_11_23_13_20_20.jpg na 23/11/2003 13:20', 
        'filename_us' => 'Zmienia 2003_11_23_13_20_20.jpg na 11/23/2003 13:20', 
        'filename_time' => 'Zmienia 2003_11_23_13_20_20.jpg na 13:20', 
        'delete' => 'Kasowanie tytu³ów lub oryginalnych zdjêæ', 
        'delete_title' => 'Skasuj tytu³y zdjêæ', 
        'delete_original' => 'Skasuj oryginalne zdjêcia', 
        'delete_replace' => 'Kasuje oryginalne zdjêcia zastêpuj±c je zdjêciami zrewymiarowanymi', 
        'select_album' => 'Wybierz album', 
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