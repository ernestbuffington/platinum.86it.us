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
'trans_name'=> 'Jacek Domo�', //the name of the translator - can be a nickname
'trans_email' => 'plusz@plusnet.pl', //translator's email address (optional)
'trans_website' => 'http://www.plusz.futuremedia.pl/', //translator's website (optional)
'trans_date' => '2003-04-20', //the date the translation was created / last modified
);

$lang_charset = 'iso-8859-2';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bajty', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('Niedziela', 'Poniedzia�ek', 'Wtorek', '�roda', 'Czwartek', 'Pi�tek', 'Sobota');
$lang_month = array('Stycze�', 'Luty', 'Marzec', 'Kwiecie�', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpie�', 'Wrzesie�', 'Pa�dziernik', 'Listopad', 'Grudzie�');

// Some common strings
$lang_yes = 'Tak';
$lang_no  = 'Nie';
$lang_back = 'Wstecz';
$lang_continue = 'Dalej';
$lang_info = 'Informacja';
$lang_error = 'B��d';

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
        'random' => 'Losowo wybrane zdj�cia ',
        'lastup' => 'Ostatnio dodane zdj�cia',
        'lastupby' => 'My Last Additions', // new 1.2.2
        'lastalb'=> 'Ostatnio dodane albumy', 
        'lastcom' => 'Ostatnio dodane komentarze',
        'lastcomby' => 'My Last comments', // new 1.2.2
        'topn' => 'Najpopularniejsze zdj�cia',
        'toprated' => 'Najwy�ej oceniane zdj�cia',
        'lasthits' => 'Ostatnio ogl�dane zdj�cia',
        'search' => 'Wyniki wyszukiwania', 
        'favpics'=> 'Ulubione zdj�cia' 
);

$lang_errors = array(
        'access_denied' => 'Nie masz uprawnie� aby ogl�da� t� stron�.',
        'perm_denied' => 'Nie masz uprawnie� aby wykona� t� operacj�.',
        'param_missing' => 'Skrypt zosta� wywo�any bez wymaganego parametru/�w.',
        'non_exist_ap' => 'Wybrany album/zdj�cie nie istnieje!!',
        'quota_exceeded' => 'Przekroczono limit miejsca na pliki<br /><br />Tw�j przydzia�: [quota]K, Twoje zdj�cia u�ywaj� obecnie: [space]K. Dodanie tego zdj�cia powoduje przekroczenie limitu.',
        'gd_file_type_err' => 'Je�li w u�yciu jest biblioteka GD, dozwolone formaty zdj�� to wy��cznie JPEG i PNG.',
        'invalid_image' => 'Zdj�cie kt�re przes�ano nie mo�e by� obs�u�one przez bibliotek� GD.',
        'resize_failed' => 'Nie mo�na stworzy� miniatury lub zdj�cia po�redniego.',
        'no_img_to_display' => 'Brak zdj�cia do wy�wietlenia',
        'non_exist_cat' => 'Wybrana kategoria nie istnieje',
        'orphan_cat' => 'Kategoria nie ma nadrz�dnej ga��zi, uruchom mened�era kategorii aby rozwi�za� ten problem.',
        'directory_ro' => 'Katalog \'%s\' jest zabezpieczony przed zapisem',
        'non_exist_comment' => 'Wybrany komentarz nie istnieje.',
        'pic_in_invalid_album' => 'Zdj�cie znajduje si� w nieistniej�cym albumie (%s)!?', 
        'banned' => 'Obecnie Tw�j dost�p do strony zosta� zablokowany.', 
        'not_with_udb' => 'Ta funkcja jest zablokowana, poniewa� Coppermine jest zintegrowane z oprogramowaniem do obs�ugi forum. Alternatywnie funkcja nie jest obs�ugiwana przy bie��cej konfiguracji.', 
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
        'alb_list_title' => 'Przejd� do listy album�w',
        'alb_list_lnk' => 'Albumy',
        'my_gal_title' => 'Do prywatnej galerii',
        'my_gal_lnk' => 'Moja galeria',
        'my_prof_lnk' => 'M�j profil',
        'adm_mode_title' => 'Prze��cz w tryb administratora',
        'adm_mode_lnk' => 'Tryb administratora',
        'usr_mode_title' => 'Prze��cz w tryb u�ytkownika',
        'usr_mode_lnk' => 'Tryb u�ytkownika',
        'upload_pic_title' => 'Upload zdj�cia do albumu',
        'upload_pic_lnk' => 'Upload zdj�cia',
        'register_title' => 'Utw�rz konto',
        'register_lnk' => 'Zarejestruj si�',
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
        'upl_app_lnk' => 'Akceptacja zdj��',
        'config_lnk' => 'Konfiguracja',
        'albums_lnk' => 'Albumy',
        'categories_lnk' => 'Kategorie',
        'users_lnk' => 'U�ytkownicy',
        'groups_lnk' => 'Grupy',
        'comments_lnk' => 'Komentarze',
        'searchnew_lnk' => 'Wsadowe przetwarzanie zdj��',
        'util_lnk' => 'Zmiana rozmiaru zdj��', 
        'ban_lnk' => 'Banowanie', 
);

$lang_user_admin_menu = array(
        'albmgr_lnk' => 'Tworzenie / porz�dkowanie album�w',
        'modifyalb_lnk' => 'Modyfikacja moich album�w',
        'my_prof_lnk' => 'M�j profil',
);

$lang_cat_list = array(
        'category' => 'Kategoria',
        'albums' => 'Albumy',
        'pictures' => 'Zdj�cia',
);

$lang_album_list = array(
        'album_on_page' => 'album�w: %d stron: %d'
);

$lang_thumb_view = array(
        'date' => 'DATA',
        'name' => 'NAZWA PLIKU', 
        'title' => 'TYTU�', 
        'sort_da' => 'Sortowanie wg daty rosn�co',
        'sort_dd' => 'Sortowanie wg daty malej�co',
        'sort_na' => 'Sortowanie wg nazwy rosn�co',
        'sort_nd' => 'Sortowanie wg nazwy malej�co',
        'sort_ta' => 'Sortowanie wg tytu�u rosn�co', 
        'sort_td' => 'Sortowanie wg tytu�u malej�co', 
        'pic_on_page' => 'zdj��: %d stron: %d',
        'user_on_page' => 'u�ytkownik�w: %d stron: %d',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
        'thumb_title' => 'Wr�� do widoku miniatur',
        'pic_info_title' => 'Wy�wietl/ukryj info o zdj�ciu',
        'slideshow_title' => 'Pokaz slajd�w',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Wy�lij jako e-kartk�',
        'ecard_disabled' => 'e-kartki s� wy��czone',
        'ecard_disabled_msg' => 'Nie masz uprawnie� do wysy�ania e-kartek',
        'prev_title' => 'Poprzednie zdj�cie',
        'next_title' => 'Nast�pne zdj�cie',
        'pic_pos' => 'Zdj�cie %s/%s',
        'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
);

$lang_rate_pic = array(
        'rate_this_pic' => 'Oce� te zdj�cie ',
        'no_votes' => '(Brak g�os�w)',
        'rating' => '(obecna ocena : %s / 5 g�os�w: %s)',
        'rubbish' => 'Do niczego',
        'poor' => 'S�abe',
        'fair' => 'Niez�e',
        'good' => 'Dobre',
        'excellent' => 'B. dobre',
        'great' => 'Doskona�e',
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
        CRITICAL_ERROR => 'B��d krytyczny',
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
        'n_views' => 'ods�on: %s ',
        'n_votes' => '(g�os�w: %s)'
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
        'Smile' => 'U�miechni�ty',
        'Sad' => 'Smutny',
        'Surprised' => 'Zaskoczony',
        'Shocked' => 'Zszokowany',
        'Confused' => 'Zniesmaczony',
        'Cool' => 'Luzak',
        'Laughing' => '�mieje si�',
        'Mad' => 'W�ciek�y',
        'Razz' => 'J�zorek',
        'Embarassed' => 'Zawstydzony / gafa',
        'Crying or Very sad' => 'Zrozpaczony',
        'Evil or Very Mad' => 'W�ciek�y do kwadratu',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Przewraca oczami',
        'Wink' => 'Puszcza oczko',
        'Idea' => 'Pomys�',
        'Arrow' => 'Strza�ka',
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
        0 => 'Zako�czono prac� administratora...',
        1 => 'Prze��czanie do trybu administratora...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
        'alb_need_name' => 'Albumy musz� mie� nazw� !',
        'confirm_modifs' => 'Czy na pewno chcesz dokona� tych modyfikacji ?',
        'no_change' => 'Nie dokona�e�/a� �adnej zmiany !',
        'new_album' => 'Nowy album',
        'confirm_delete1' => 'Czy na pewno chcesz skasowa� ten album ?',
        'confirm_delete2' => '\nWszystkie zdj�cia i komentarze kt�re zawiera zostan� stracone !',
        'select_first' => 'Wybierz pierwszy album',
        'alb_mrg' => 'Mened�er album�w',
        'my_gallery' => '* Moja galeria *',
        'no_category' => '* Bez kategorii *',
        'delete' => 'Kasuj',
        'new' => 'Nowy',
        'apply_modifs' => 'Wykonaj modyfikacje',
        'select_category' => 'Wybierz kategori�',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
        'miss_param' => 'Brak parametr�w do operacji \'%s\'!',
        'unknown_cat' => 'Wybrana kategoria nie istnieje w bazie danych',
        'usergal_cat_ro' => 'Galerie u�ytkownik�w nie mog� by� kasowane!',
        'manage_cat' => 'Zarz�dzaj kategoriami',
        'confirm_delete' => 'Czy jeste� pewny/a �e chcesz SKASOWA� t� kategori�',
        'category' => 'Kategoria',
        'operations' => 'Operacje',
        'move_into' => 'Przesu� do',
        'update_create' => 'Uaktualnij / stw�rz kategori�',
        'parent_cat' => 'Kategoria wy�szego rz�du',
        'cat_title' => 'Tytu� kategorii',
        'cat_desc' => 'Opis kategorii'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
'title' => 'Konfiguracja',
'restore_cfg' => 'Przywr�� ustawienia domy�lne',
'save_cfg' => 'Zachowaj now� konfiguracj�',
'notes' => 'Notatki',
'info' => 'Informacja',
'upd_success' => 'Konfiguracja Coppermine zosta�a uaktualniona',
'restore_success' => 'Konfiguracja Coppermine zosta�a przywr�cona',
'name_a' => 'Nazwa rosn�co',
'name_d' => 'Nazwa malej�co',
'title_a' => 'Tytu� rosn�co', 
'title_d' => 'Tytu� malej�co', 
'date_a' => 'Data rosn�co',
'date_d' => 'Data malej�co',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
'th_any' => 'Maksymalne rozmiary',
'th_ht' => 'Wysoko��',
'th_wd' => 'Szeroko��',
      );
// start left side interpretation
if (defined('CONFIG_PHP')) 
$lang_config_data = array(
//'General settings',
'Ustawienia g��wne',
array(
'Nazwa galerii', 'gallery_name', 0),        
array(
'Opis galerii', 'gallery_description', 0),        
array(
'E-mail administratora galerii', 'gallery_admin_email', 0),        
array(
'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
array(
'J�zyk', 'lang', 5),
// for postnuke change
array(
'Styl galerii', 'theme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
//'Album list view',
'Przegl�danie listy album�w',        
array(
'Szeroko�� g��wnej galerii (piksele lub %)', 'main_table_width', 0),        
array(
'Ilo�� kategorii do wy�wietlenia', 'subcat_level', 0),        
array(
'Ilo�� album�w do wy�wietlenia', 'albums_per_page', 0),        
array(
'Ilo�� kolumn w li�cie album�w', 'album_list_cols', 0),        
array(
'Rozmiar miniatur w pikselach', 'alb_list_thumb_size', 0),        
array(
'Zawarto�� strony g��wnej', 'main_page_layout', 0),        
array(
'Poka� miniatur� pierwszego poziomu w miniaturach albumu','first_level',1), 
//'Thumbnail view',
'Widok miniatur',        
array(
'Ilo�� kolumn na stronie miniatur', 'thumbcols', 0),        
array(
'Ilo�� wierszy na stronie miniatur', 'thumbrows', 0),        
array(
'Maksymalna ilo�� pask�w do wy�wietlenia', 'max_tabs', 0),        
array(
'Wy�wietl opis zdj�cia (opr�cz tytu�u) poni�ej miniatury', 'caption_in_thumbview', 1),        
array(
'Wy�wietl ilo�� komentarzy poni�ej miniatury', 'display_comment_count', 1),        
array(
'Domy�lny porz�dek sortowania zdj��', 'default_sort_order', 3),        
array(
'Minimalna ilo�� g�os�w niezb�dna do umieszczenia zdj�cia w kategorii \'Top Lista\'', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
//'Image view &amp; Comment settings',
'Ustawienia wy�wietlania zdj�� &amp; komentarzy',        
array(
'Szeroko�� tabeli wy�wietlaj�cej zdj�cia (piksele lub %)', 'picture_table_width', 0),        
array(
'Domy�lne pokazywanie Informacji o zdj�ciu', 'display_pic_info', 1),        
array(
'Blokowanie s��w z "listy zakazanych" w komentarzach', 'filter_bad_words', 1),        
array(
'Wy�wietlanie emotikon w komentarzach', 'enable_smilies', 1),        
array(
'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
array(
'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
array(
'Maksymalna d�ugo�� opisu zdj�cia', 'max_img_desc_length', 0),        
array(
'Maksymalna ilo�� znak�w w s�owie', 'max_com_wlength', 0),        
array(
'Maksymalna ilo�� linii w komentarzu', 'max_com_lines', 0),        
array(
'Maksymalna d�ugo�� komentarza (znak�w)', 'max_com_size', 0),        
array(
'Poka� "pasek filmu" z miniaturami', 'display_film_strip', 1),        
array(
'Ilo�� element�w wy�wietlanych w "pasku filmu" z miniaturami', 'max_film_strip_items', 0), 
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke

//'Pictures and thumbnails settings',
'Ustawienia zdj�� i miniatur',        
array(
'Jako�� plik�w JPEG', 'jpeg_qual', 0),        
array(
'Maksymalny rozmiar miniatury <strong>*</strong>', 'thumb_width', 0),        
array(
'U�yj wymiaru (szeroko��, wysoko�� lub maksymalny widok dla miniatury)<strong>*</strong>', 'thumb_use', 7),        
array(
'Tw�rz zdj�cia po�rednie','make_intermediate',1),        
array(
'Maksymalna szeroko�� zdj�cia po�redniego <strong>*</strong>', 'picture_width', 0),        
array(
'Maksymalny rozmiar uploadowanych zdj�� (KB)', 'max_upl_size', 0),        
array(
'Maksymana wysoko�� lub szeroko�� uploadowanych zdj�� (w pikselach)', 'max_upl_width_height', 0),
//'User settings',
'Ustawienia u�ytkownik�w',        
array(
'Zezwalanie na rejestracj� nowych u�ytkownik�w', 'allow_user_registration', 1),        
array(
'Rejestracja u�ytkownika wymaga potwierdzenia e-mail', 'reg_requires_valid_email', 1),        
array(
'Zezwalanie posiadania tego samego adresu e-mail przez dw�ch u�ytkownik�w', 'allow_duplicate_emails_addr', 1),        
array(
'U�ytkownicy mog� tworzy� albumy prywatne', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
'Nazwy dodatkowych p�l do opisu zdj�cia (pozostaw je puste je�eli nie s� u�ywane)',        
array(
'Nazwa pola 1', 'user_field1_name', 0),        
array(
'Nazwa pola 2', 'user_field2_name', 0),        
array(
'Nazwa pola 3', 'user_field3_name', 0),        
array(
'Nazwa pola 4', 'user_field4_name', 0),
//'Pictures and thumbnails advanced settings',
'Zaawansowane ustawienia zdj�� i miniatur',        
array(
'Pokazuj prywatn� ikon� albumu niezalogowanemu u�ytkownikowi','show_private',1),        
array(
'Znaki zabronione w nazwach plik�w', 'forbiden_fname_char',0),        
array(
'Akceptowane rozszerzenia uploadowanych plik�w', 'allowed_file_extensions',0),        
array(
'Metoda zmiany rozmiaru zdj��','thumb_method',2),        
array(
'�cie�ka dost�pu do narz�dzia konwertuj�cego ImageMagick / netpbm \'convert\' (na przyk�ad /usr/bin/X11/)', 'impath', 0),        
array(
'Dozwolone nazwy plik�w (w�a�ciwe dla ImageMagick)', 'allowed_img_types',0),        
array(
'Komendy linii polece� dla ImageMagick', 'im_options', 0),        
array(
'Czytaj dane EXIF w plikach JPEG', 'read_exif_data', 1),        
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'�cie�ka katalogu z albumami<strong>*</strong>', 'fullpath', 0),        
array(
'Nazwa katalogu na zdj�cia u�ytkownik�w<strong>*</strong>', 'userpics', 0),        
array(
'Prefix dla zdj�� po�rednich <strong>*</strong>', 'normal_pfx', 0),        
array(
'Prefix dla miniatur<strong>*</strong>', 'thumb_pfx', 0),        
array(
'Domy�lne uprawnienia katalog�w (LINUX i podobne systemy)', 'default_dir_mode', 0),        
array(
'Domy�lne uprawnienia plik�w ze zdj�ciami (LINUX i podobne systemy)', 'default_file_mode', 0),
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
'Ustawienia cookies &amp; zestawu znak�w',        
array(
'Nazwa plik�w cookie tworzonych przez skrypt', 'cookie_name', 0),        
array(
'�cie�ka plik�w cookie tworzonych przez skrypt', 'cookie_path', 0),        
array(
'Zestaw znak�w', 'charset', 4),
'R�ne ustawienia',        
array(
'W��cz tryb debugowania', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
'<br /><div align="center">(*) Pola oznaczone gwiazdk� nie mog� by� zmienione je�eli w galerii s� ju� zdj�cia</div><br />'
);
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
'empty_name_or_com' => 'Musisz poda� swoje imi� i napisa� komentarz',
        'com_added' => 'Tw�j komentarz zosta� dodany',
        'alb_need_title' => 'Musisz poda� tytu� dla albumu!',
        'no_udp_needed' => 'Zmiana nie jest konieczna.',
        'alb_updated' => 'Album zosta� uaktualniony',
        'unknown_album' => 'Wybrany album nie istnieje, lub nie masz uprawnie� do uploadu',
        'no_pic_uploaded' => 'Zdj�cie nie zosta�o dodane!<br /><br />Je�eli wybrano zdj�cie do przes�ania, sprawd� czy serwer na to zezwala...',
        'err_mkdir' => 'Nie uda�o si� utworzy� katalogu %s !',
        'dest_dir_ro' => 'Katalog docelowy %s nie mo�e by� zapisany przez skrypt!',
        'err_move' => 'Nie mo�na przenie�� %s do %s !',
        'err_fsize_too_large' => 'Zdj�cie kt�re przesy�asz ma zbyt du�y rozmiar (maksymalnie dozwolony: %s x %s) !',
        'err_imgsize_too_large' => 'Zdj�cie kt�re przesy�asz ma zbyt du�y rozmiar (maksymalnie dozwolony: to %s KB) !',
        'err_invalid_img' => 'Przes�ane zdj�cie nie jest w dozwolonym formacie!',
        'allowed_img_types' => 'Mo�esz przes�a� tylko %s zdj��.',
        'err_insert_pic' => 'Zdj�cie \'%s\' nie mo�e zosta� wstawione do albumu ',
        'upload_success' => 'Zdj�cie zosta�o przes�ane<br /><br />B�dzie widoczne po akceptacji przez administratora.',
        'info' => 'Informacja',
        'com_added' => 'Dodano komentarz',
        'alb_updated' => 'Uaktualniono album',
        'err_comment_empty' => 'Tw�j komentarz jest pusty!',
        'err_invalid_fext' => 'Akceptowane s� jedynie zdj�cia z nast�puj�cymi rozszerzeniami: <br /><br />%s.',
        'no_flood' => 'Przykro mi ale jeste�/a� autorem ostatniego dodanego komentarza<br /><br />Mo�esz go edytowa� aby zmieni� tre��',
        'redirect_msg' => 'Jeste� przekierowywany.<br /><br /><br />Kliknij \'DALEJ\' je�eli strona nie zmieni si� automatycznie',
        'upl_success' => 'Zdj�cie zosta�o przes�ane',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
'caption' => 'Tytu�',
        'fs_pic' => 'pe�ny rozmiar',
        'del_success' => 'skasowano',
        'ns_pic' => 'normalny rozmiar',
        'err_del' => 'nie mo�e by� skasowane',
        'thumb_pic' => 'miniatura',
        'comment' => 'komentarz',
        'im_in_alb' => 'zdj�cie z albumu',
        'alb_del_success' => 'Skasowano album \'%s\' ',
        'alb_mgr' => 'Mened�er album�w',
        'err_invalid_data' => 'Otrzymano niew�a�ciwe dane \'%s\'',
        'create_alb' => 'Tworzenie albumu \'%s\'',
        'update_alb' => 'Uaktualnienie albumu: \'%s\' tytu�: \'%s\' index: \'%s\'',
        'del_pic' => 'Kasowanie zdj�cia',
        'del_alb' => 'Kasowanie albumu',
        'del_user' => 'Kasowanie u�ytkownika',
        'err_unknown_user' => 'Wybrany u�ytkownik nie istnieje!',
        'comment_deleted' => 'Komentarz zosta� dodany',
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
        'confirm_del' => 'Czy na pewno chcesz skasowa� te zdj�cie? \\nZostan� skasowane r�wnie� komentarze do niego.',
        'del_pic' => 'SKASUJ TE ZDJ�CIE',
        'size' => '%s x %s pixels',
        'views' => '%s times',
        'slideshow' => 'Pokaz slajd�w',
        'stop_slideshow' => 'ZATRZYMAJ POKAZ',
        'view_fs' => 'Kliknij aby zobaczy� pe�ny rozmiar',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
);

$lang_picinfo = array(
        'title' =>'Informacja',
        'Filename' => 'Nazwa pliku',
        'Album name' => 'Nazwa albumu',
        'Rating' => 'Ocena (%s g�os�w)',
        'Keywords' => 'S�owa kluczowe',
        'File Size' => 'Rozmiar pliku',
        'Dimensions' => 'Wymiary',
        'Displayed' => 'Wy�wietle�',
        'Camera' => 'Aparat fotograficzny',
        'Date taken' => 'Data zrobienia zdj�cia',
        'Aperture' => 'Przes�ona',
        'Exposure time' => 'Czas ekspozycji',
        'Focal length' => 'Ogniskowa',
        'Comment' => 'Komentarz',
        'addFav'=>'Dodaj do Ulubionych', 
        'addFavPhrase'=>'Ulubione', 
        'remFav'=>'Usu� z Ulubionych', 
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
        'confirm_delete' => 'Czy na pewno chcesz skasowa� ten komentarz ?',
        'add_your_comment' => 'Dodaj komentarz',
        'name'=>'Pseudonim', 
        'comment'=>'Komentarz', 
        'your_name' => 'Anonim', 
);

$lang_fullsize_popup = array(
        'click_to_close' => 'Kliknij zdj�cie aby zamkn�� okno', 
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
        'title' => 'Wy�lij e-kartk�',
        'invalid_email' => '<strong>Uwaga!</strong> : niepoprawny adres e-mail !',
        'ecard_title' => 'e-kartka od %s dla Ciebie',
        'view_ecard' => 'Je�eli e-kartka nie wy�wietla si� poprawnie, kliknij ten link',
        'view_more_pics' => 'Kliknij ten link aby zobaczy� wi�cej zdj��!',
        'send_success' => 'Twoja e-kartka zosta�a wys�ana',
        'send_failed' => 'Niestety, serwer nie mo�e wys�a� Twojej e-kartki...',
        'from' => 'Od',
        'your_name' => 'Twoje imi�',
        'your_email' => 'Tw�j adres e-mail',
        'to' => 'Do',
        'rcpt_name' => 'Nazwa odbiorcy',
        'rcpt_email' => 'Adres e-mail odbiorcy',
        'greetings' => 'Temat',
        'message' => 'Wiadomo��',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
        'pic_info' => 'Zdj�cie&nbsp;Info',
        'album' => 'Album',
        'title' => 'Tytu�',
        'desc' => 'Opis',
        'keywords' => 'S�owa kluczowe',
        'pic_info_str' => '%s &razy; %s - %s KB - %s ods�on - %s g�os�w',
        'approve' => 'Akceptuj zdj�cie',
        'postpone_app' => 'Odrocz akceptacj�',
        'del_pic' => 'Skasuj zdj�cie',
        'reset_view_count' => 'Resetuj licznik ods�on',
        'reset_votes' => 'Resetuj g�osowania',
        'del_comm' => 'Skasuj komentarze',
        'upl_approval' => 'Akceptacja uploadu',
        'edit_pics' => 'Edytuj zdj�cia',
        'see_next' => 'Zobacz nast�pne zdj�cia',
        'see_prev' => 'Zobacz poprzednie zdj�cia',
        'n_pic' => 'zdj��: %s',
        'n_of_pic_to_disp' => 'Ilo�� zdj�� do wy�wietlenia',
        'apply' => 'Zastosuj zmiany'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
        'group_name' => 'Nazwa grupy',
        'disk_quota' => 'Miejsce na dane',
        'can_rate' => 'Mo�e ocenia� zdj�cia',
        'can_send_ecards' => 'Mo�e wysy�a� e-kartki',
        'can_post_com' => 'Mo�e zamieszcza� komentarze',
        'can_upload' => 'Mo�e przesy�a� zdj�cia',
        'can_have_gallery' => 'Mo�e mie� galeri� osobist�',
        'apply' => 'Zastosuj zmiany',
        'create_new_group' => 'Stw�rz now� grup�',
        'del_groups' => 'Skasuj zaznaczon� grup�/y',
        'confirm_del' => 'Uwaga: je�eli skasujesz t� grup� jej cz�onkowie zostan� przeniesieni do grupy \'Zarejestrowani\'!\n\nKontynuowa�?',
        'title' => 'Zarz�dzanie grupami',
        'approval_1' => 'Zgoda na pub. upl.(1)',
        'approval_2' => 'Zgoda na priv. upl.(2)',
        'note1' => '<strong>(1)</strong> Przesy�anie zdj�� do albumu publicznego wymaga zgody administratora',
        'note2' => '<strong>(2)</strong> Przesy�anie zdj�� do albumu u�ytkownika wymaga zgody administratora',
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
        'confirm_delete' => 'Czy na pewno chcesz skasowa� ten album? \\nZostan� skasowane r�wnie� wszystkie zdj�cia i komentarze.',
        'delete' => 'KASUJ',
        'modify' => 'W�A�CIWO�CI',
        'edit_pics' => 'EDYTUJ ZDJ�CIA',
);

$lang_list_categories = array(
        'home' => 'Strona g��wna',
        'stat1' => 'zdj�cia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, kategorie: <strong>[cat]</strong>, komentarze: <strong>[comments]</strong>, ods�ony: <strong>[views]</strong>',
        'stat2' => 'zdj�cia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, ods�ony: <strong>[views]</strong>',
        'xx_s_gallery' => '%s\'s galeria',
        'stat3' => 'zdj�cia: <strong>[pictures]</strong>, albumy: <strong>[albums]</strong>, komentarze: <strong>[comments]</strong>, ods�ony: <strong>[views]</strong>'
);

$lang_list_users = array(
        'user_list' => 'Lista u�ytkownik�w',
        'no_user_gal' => 'Galerie u�ytkownik�w nie istniej�',
        'n_albums' => '%s album/y',
        'n_pics' => '%s zdj�cie/��'
);

$lang_list_albums = array(
        'n_pictures' => 'zdj��: %s',
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
        'general_settings' => 'Ustawienia og�lne',
        'alb_title' => 'Tytu� albumu',
        'alb_cat' => 'Kategoria albumu',
        'alb_desc' => 'Opis albumu',
        'alb_thumb' => 'Miniatury',
        'alb_perm' => 'Uprawnienia albumu',
        'can_view' => 'Mo�e by� ogl�dany przez',
        'can_upload' => 'Go�cie mog� przesy�a� zdj�cia',
        'can_post_comments' => 'Go�cie mog� dodawa� komentarze',
        'can_rate' => 'Go�cie mog� ocenia� zdj�cia',
        'user_gal' => 'Galeria u�ytkownika',
        'no_cat' => '* Bez kategorii *',
        'alb_empty' => 'Album jest pusty',
        'last_uploaded' => 'Ostatnio przes�ane',
        'public_alb' => 'Wszyscy (album publiczny)',
        'me_only' => 'Tylko ja',
        'owner_only' => 'Tylko w�a�ciciel albumu: (%s)',
        'groupp_only' => 'Cz�onkowie grupy: \'%s\'',
        'err_no_alb_to_modify' => 'Nie mo�na modyfikowa� �adnego albumu w bazie.',
        'update' => 'Uaktualnij album'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
        'already_rated' => 'Przykro nam, ale ju� oceni�e� te zdj�cie',
        'rate_ok' => 'Tw�j g�os zosta� zapisany',
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
        'page_title' => 'Rejestrowanie u�ytkownika',
        'term_cond' => 'Warunki korzystania z serwisu',
        'i_agree' => 'Zgadzam si�',
        'submit' => 'Wykonaj rejestracj�',
        'err_user_exists' => 'Nazwa u�ytkownika kt�r� wybra�e� ju� istnieje. Wybierz inn�',
        'err_password_mismatch' => 'Has�a nie pasuj� do siebie. Wpisz je ponownie',
        'err_uname_short' => 'Nazwa u�ytkownika musi mie� co najmniej 2 znaki',
        'err_password_short' => 'Has�o musi mie� co najmniej 2 znaki',
        'err_uname_pass_diff' => 'Nazwa u�ytkownika i has�o musz� si� od siebie r�ni�',
        'err_invalid_email' => 'Adres e-mail jest niepoprawny',
        'err_duplicate_email' => 'W bazie jest ju� u�ytkownik o podanym przez Ciebie adresie e-mail',
        'enter_info' => 'Wprowad� informacje potrzebne do rejestracji',
        'required_info' => 'Informacje wymagane',
        'optional_info' => 'Informacje opcjonalne',
        'username' => 'Nazwa u�ytkownika',
        'password' => 'Has�o',
        'password_again' => 'Wprowad� ponownie has�o',
        'email' => 'E-mail',
        'location' => 'Lokalizacja',
        'interests' => 'Zainteresowania',
        'website' => 'Strona domowa',
        'occupation' => 'Zaj�cie / zaw�d',
        'error' => 'B��D',
        'confirm_email_subject' => '%s - Informacja o rejestracji',
        'information' => 'Informacja',
        'failed_sending_email' => 'E-mail z potwierdzeniem nie mo�e by� wys�any!',
        'thank_you' => 'Dzi�kujemy za rejestracj�.<br /><br />Na podany przez Ciebie adres e-mail zosta� wys�any list z pro�b� o potwierdzenie.',
        'acct_created' => 'Konto zosta�o utworzone. Mo�esz ju� zalogowa� si� podaj�c wybran� wczesniej nazw� u�ytkownika, oraz has�o',
        'acct_active' => 'Konto jest ju� aktywne. Mo�esz ju� zalogowa� si� podaj�c wybran� wczesniej nazw� u�ytkownika, oraz has�o',
        'acct_already_act' => 'Twoje konto zosta�o ju� aktywowane!',
        'acct_act_failed' => 'Te konto nie mo�e by� aktywowane!',
        'err_unk_user' => 'Podany u�ytkownik nie istnieje!',
        'x_s_profile' => 'profil: %s',
        'group' => 'Grupa',
        'reg_date' => 'Do��czy�/a',
        'disk_usage' => 'U�yte miejsce',
        'change_pass' => 'Zmie� has�o',
        'current_pass' => 'Bie��ce has�o',
        'new_pass' => 'Nowe has�o',
        'new_pass_again' => 'Podaj ponownie nowe has�o',
        'err_curr_pass' => 'Bie��ce has�o jest niepoprawne',
        'apply_modif' => 'Zastosuj zmiany',
        'change_pass' => 'Zmia� moje has�o',
        'update_success' => 'Tw�j profil zosta� uaktualniony',
        'pass_chg_success' => 'Twoje has�o zosta�o zmienione',
        'pass_chg_error' => 'Twoje has�o nie zosta�o zmienione',
);

$lang_register_confirm_email = <<<EOT
Dzi�kujemy za rejestracj� w witrynie {SITE_NAME}

Twoja nazwa u�ytkownika to: "{USER_NAME}"
Twoje has�o to: "{PASSWORD}"

Aby aktywowa� konto kliknij na poni�szy link albo skopiuj go
i wklej do swojej przegl�darki internetowej.

{ACT_LINK}

Pozdrowienia,

Zesp� strony {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
        'title' => 'Przegl�daj komentarze',
        'no_comment' => 'Nie ma komentarzy do przegl�dania',
        'n_comm_del' => 'Skasowano komentarzy: %s',
        'n_comm_disp' => 'Ilo�� komentarzy do wy�wietlenia',
        'see_prev' => 'Zobacz poprzednie',
        'see_next' => 'Zobacz nast�pne',
        'del_comm' => 'Skasuj wybrane komentarze',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
        0 => 'Wyszukiwarka zdj��',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
        'page_title' => 'Wyszukiwarka zdj��',
        'select_dir' => 'Wybierz katalog',
        'select_dir_msg' => 'Wybrana funkcja umo�liwia wsadowe dodawanie do galerii zdj�� kt�re zosta�y przes�ane na serwer.<br /><br />Wybierz katalog do kt�rego zosta�y przes�ane wybrane zdj�cia',
        'no_pic_to_add' => 'Brak zdj�� do dodania',
        'need_one_album' => 'Aby funkcja dzia�a�a, potrzebny jest przynajmniej jeden album',
        'warning' => 'Ostrze�enie',
        'change_perm' => 'skrypt nie mo�e zapisywa� plik�w do wybranego katalogu. Zmie� ustawienia na 755 lub 777 zanim spr�bujesz doda� zdj�cia!',
        'target_album' => '<strong>Zapisuje zdj�cia do katalogu &quot;</strong>%s<strong>&quot; </strong>%s',
        'folder' => 'Katalog',
        'image' => 'Zdj�cie',
        'album' => 'Album',
        'result' => 'Wynik',
        'dir_ro' => 'Nie mo�na zapisa�. ',
        'dir_cant_read' => 'Nie mo�na odczyta�. ',
        'insert' => 'Dodawanie nowych zdj�� do galerii',
        'list_new_pic' => 'Lista nowych zdj��',
        'insert_selected' => 'Wstaw wybrane zdj�cia',
        'no_pic_found' => 'Nie znaleziono nowych zdj��',
        'be_patient' => 'Prosz� o cierpliwo��, skrypt potrzebuje czasu na dodanie zdj��',
        'notes' =>  '<ul>'.
                                '<li><strong>OK</strong> : oznacza, �e zdj�cie zosta�o dodane'.
                                '<li><strong>DP</strong> : oznacza, �e zdj�cie jest zduplikowane i istnieje ju� w bazie'.
                                '<li><strong>PB</strong> : oznacza brak mo�liwo�ci dodania zdj�cia. Sprawd� swoje uprawnienia do zapisywania katalog�w i plik�w'.
                                '<li>Je�eli OK, \'znaki\' DP, PB nie pojawiaj� si�, kliknij na zdj�ciu aby otrzyma� komunikat generowany przez PHP'.
                                '<li>Je�eli przegl�darka nie za�adowa�a strony, wci�nij klawisz F5 aby j� od�wie�y�'.
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
        'title' => 'Prze�lij zdj�cie',
        'max_fsize' => 'Maksymalny rozmiar zdj�cia to %s KB',
        'album' => 'Album',
        'picture' => 'Zdj�cie',
        'pic_title' => 'Tytu� zdj�cia',
        'description' => 'Opis zdj�cia',
        'keywords' => 'S�owa kluczowe (oddzielone spacjami)',
        'err_no_alb_uploadables' => 'Przykro mi, ale nie ma albumu do kt�rego m�g�by�/a� przes�a� zdj�cia',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
        'title' => 'Zarz�dzanie u�ytkownikami',
        'name_a' => 'Nazwa rosn�co',
        'name_d' => 'Nazwa malej�co',
        'group_a' => 'Grupa rosn�co',
        'group_d' => 'Grupa malej�co',
        'reg_a' => 'Data rej. rosn�co',
        'reg_d' => 'Data rej. malej�co',
        'pic_a' => 'Liczba zdj�� rosn�co',
        'pic_d' => 'Liczba zdj�� malej�co',
        'disku_a' => 'U�ycie dysku rosn�co',
        'disku_d' => 'U�ycie dysku malej�co',
        'sort_by' => 'Posortuj u�ytkownik�w wg',
        'err_no_users' => 'Tabela u�ytkownik�w jest pusta!',
        'err_edit_self' => 'Nie mo�esz modyfikowa� teraz swojego profilu. Aby to zrobi� kliknij ��cze \'M�j profil\'',
        'edit' => 'EDYTUJ',
        'delete' => 'KASUJ',
        'name' => 'Nazwa u�ytkownika',
        'group' => 'Grupa',
        'inactive' => 'Nieaktywny',
        'operations' => 'Operacje',
        'pictures' => 'Pictures',
        'disk_space' => 'U�yte miejsce / Quota',
        'registered_on' => 'Zerejestrowano',
        'u_user_on_p_pages' => 'u�ytkownik�w: %d na stronach: %d',
        'confirm_del' => 'Czy na pewno chcesz skasowa� tego u�ytkownika? \\nWszystkie jego zdj�cia i alumy zostan� automatycznie skasowane.',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'Wybrany u�ytkownik nie istnieje',
        'modify_user' => 'Modyfikuj u�ytkownika',
        'notes' => 'Uwagi',
        'note_list' => '<li>Je�eli nie chcesz zmienia� swojego ulubionego has�a teraz, zostaw pole "has�o" puste',
        'password' => 'Has�o',
        'user_active' => 'U�ytkownik jest aktywny',
        'user_group' => 'Grupa u�ytkownik�w',
        'user_email' => 'Adres e-mail u�ytkownika',
        'user_web_site' => 'Strona sieci web u�ytkownika',
        'create_new_user' => 'Utw�rz nowego u�ytkownika',
        'user_from' => 'Lokacja u�ytkownika',
        'user_interests' => 'Zainteresowania',
        'user_occ' => 'Zaj�cie',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Zmie� rozmiar zdj��', 
        'what_it_does' => 'Do czego to s�u�y', 
        'what_update_titles' => 'Uaktualnia tytu�y nazwami plik�w', 
        'what_delete_title' => 'Kasuje tytu�y', 
        'what_rebuild' => 'Odbudowuje miniatury i zdj�cia po�rednie', 
        'what_delete_originals' => 'Kasuje zdj�cia �r�d�owe, zast�puj�c je zdj�ciami o zmienionych wymiarach', 
        'file' => 'Plik', 
        'title_set_to' => 'tytu�', 
        'submit_form' => 'prze�lij', 
        'updated_succesfully' => 'zaktualizowano', 
        'error_create' => 'B��D tworzenia', 
        'continue' => 'Przetwarza wi�cej zdj��', 
        'main_success' => 'Plik %s zosta� ustawiony jako zdj�cie g��wne', 
        'error_rename' => 'B��d przy zmiany nazwy z %s na %s', 
        'error_not_found' => 'Plik %s nie zosta� znaleziony', 
        'back' => 'powr�t na stron� g��wn�', 
        'thumbs_wait' => 'Uaktualniam miniatury i/lub zrewymiarowane zdj�cia, prosz� czeka�...', 
        'thumbs_continue_wait' => 'Trwa uaktualnianie miniatur i/lub zrewymiarowanych zdj��...', 
        'titles_wait' => 'Uaktualnianie tytu��w, prosz� czeka�...', 
        'delete_wait' => 'Kasowanie tytu��w, prosz� czeka�...', 
        'replace_wait' => 'Kasowanie orygina��w i zamienianie ich na zdj�cia o zmienionych wymiarach..', 
        'instruction' => 'Szybkie instrukcje', 
        'instruction_action' => 'Wybierz akcj�', 
        'instruction_parameter' => 'Ustaw parametry', 
        'instruction_album' => 'Wybierz album', 
        'instruction_press' => 'Naci�nij %s', 
        'update' => 'Uaktualnij miniatury i/lub zrewymiarowane zdj�cia', 
        'update_what' => 'Do uaktualnienia', 
        'update_thumb' => 'Tylko miniatury', 
        'update_pic' => 'Tylko zdj�cia o zmienionych wymiarach', 
        'update_both' => 'Zar�wno miniatury jak i zrewymiarowane zdj�cia', 
        'update_number' => 'Ilo�� przetworzonych zdj��/klikni�cie', 
        'update_option' => '(Spr�buj zmniejszy� t� ilo��, je�eli zaobserwujesz problem z timeoutem)', 
        'filename_title' => 'Nazwa pliku &rArr; Tytu� zdj�cia', 
        'filename_how' => 'Jak modyfikowa� nazw� pliku', 
        'filename_remove' => 'Usu� rozszerzenie .jpg i zamie� _ (podkre�lenie) na spacje', 
        'filename_euro' => 'Zmienia 2003_11_23_13_20_20.jpg na 23/11/2003 13:20', 
        'filename_us' => 'Zmienia 2003_11_23_13_20_20.jpg na 11/23/2003 13:20', 
        'filename_time' => 'Zmienia 2003_11_23_13_20_20.jpg na 13:20', 
        'delete' => 'Kasowanie tytu��w lub oryginalnych zdj��', 
        'delete_title' => 'Skasuj tytu�y zdj��', 
        'delete_original' => 'Skasuj oryginalne zdj�cia', 
        'delete_replace' => 'Kasuje oryginalne zdj�cia zast�puj�c je zdj�ciami zrewymiarowanymi', 
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