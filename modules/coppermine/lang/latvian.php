<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke - Language Pack 0.9                //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stoverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
define('PIC_VIEWS', 'Views');//new in 1.2.2nuke
define('PIC_VOTES', 'Votes');//new in 1.2.2nuke
define('PIC_COMMENTS', 'Comments');//new in 1.2.2nuke
$lang_translation_info = array(
'lang_name_english' => 'Latvian',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'Latviski', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'lv', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Kaspars Priedols', //the name of the translator - can be a nickname
'trans_email' => 'house@tvertne.nu', //translator's email address (optional)
'trans_website' => 'http://foto.tvertne.nu/', //translator's website (optional)
'trans_date' => '2003-10-15', //the date the translation was created / last modified
);

$lang_charset = 'windows-1257';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array(
    'B', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array(
    'Sv', 'Pr', 'Ot', 'Tr', 'Ct', 'Pt', 'Ss');
$lang_month = array(
    'Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'J�n', 'J�l', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'J�';
$lang_no  = 'N�';
$lang_back = 'ATGRIEZTIES';
$lang_continue = 'TURPIN�T';
$lang_info = 'Inform�cija';
$lang_error = 'K��da';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d/%m/%Y %H:%M';
$lastcom_date_fmt = '%d/%m/%Y %H:%M';
$lastup_date_fmt = '%d/%m/%Y %H:%M';
$register_date_fmt = '%d/%m/%Y %H:%M';
$lasthit_date_fmt = '%d/%m/%Y %H:%M';
$comment_date_fmt = '%d/%m/%Y %H:%M';

// For the word censor
$lang_bad_words = array(
    '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'pimp*', 'pe�*', 'pipel*', 'b�a�*', 'nahu*', 'pist*', 'pisien*', 'mirl*', 's�d*', 'bled', 'blad', 'pizde*', 'mauka', 'mauc�*', '�nus*', 'kaka', 's�k�');

$lang_meta_album_names = array(
    'random' => 'Izlases veida att�li',
    'lastup' => 'Jaun�kie papildin�jumi',
    'lastupby' => 'My Last additions', // new 1.2.2
    'lastalb'=> 'P�d�jie atjaunotie albumi', 
    'lastcom' => 'Jaun�kie koment�ri',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Skat�t�kie',
    'toprated' => 'Vispopul�r�kie',
    'lasthits' => 'P�d�jie skat�tie',
    'search' => 'Mekl��anas rezult�ti', 
    'favpics'=> 'Att�lu favor�ti' 

);

$lang_errors = array(
    'access_denied' => 'Tev nav pieejas ties�bu �ai lapai.',
    'perm_denied' => 'Tev nav ties�bu veikt ��du darb�bu.',
    'param_missing' => 'Tika izsaukta komanda bez parametriem.',
    'non_exist_ap' => 'Izv�l�tais albums/att�ls neeksist�!',
    'quota_exceeded' => 'Nav vietas uz diska.<br /><br />Tev ir pie��irts ierobe�ojums [quota]K, bet pa�laik jau aiz�emti [space]K, t�p�c �� att�la pievieno�ana nav ieteicama (tiks p�rsniegts ierobe�ojums).',
    'gd_file_type_err' => 'Izmantojot GD att�lu bibliot�ku, at�auts izmantot tikai JPEG un PNG form�tus.',
    'invalid_image' => 'Att�ls boj�ts vai ar� sist�mas GD att�lu bibliot�ka nesp�j to atkod�t.',
    'resize_failed' => 'Nav iesp�jams izveidot mazo att�lu vai izmain�t t� izm�rus.',
    'no_img_to_display' => 'Nav att�la',
    'non_exist_cat' => 'Izv�l�t� sada�a neeksist�',
    'orphan_cat' => '�ai apak�sada�ai nav sada�as, kam t� pieder�tu, l�dzu izmanto sada�u mened�eri, lai atrisin�tu probl�mu.',
    'directory_ro' => 'Direktorij� \'%s\' nav at�auts rakst�t, t�p�c att�lus nav iesp�jams izdz�st.',
    'non_exist_comment' => 'Izv�l�tais koment�rs neeksist�.',
    'pic_in_invalid_album' => 'Att�ls atrodas neeksist�jo�� album� (%s)!?', 
'banned' => 'Pieeja foto galerijai aizliegta.', 
'not_with_udb' => '�� iesp�ja ir atsl�gta, jo tai j�b�t integr�tai kop� ar foruma programmat�ru. Tr�kst attiec�g�s konfigur�cijas, vai nepiecie�ams uzinstal�t forumu.', 
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function',

);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
    'alb_list_title' => 'Uz albumu sarakstu',
    'alb_list_lnk' => 'Albumu saraksts',
    'my_gal_title' => 'Uz manu galeriju',
    'my_gal_lnk' => 'Mana galerija',
    'my_prof_lnk' => 'My profails',
    'adm_mode_title' => 'P�rsl�gties Administratora re��m�',
    'adm_mode_lnk' => 'Administratora re��ms',
    'usr_mode_title' => 'P�rsl�gties lietot�ja re��m�',
    'usr_mode_lnk' => 'Lietot�ja re��ms',
    'upload_pic_title' => 'Ielikt att�lu album�',
    'upload_pic_lnk' => 'Pievienot att�lu',
    'register_title' => 'Izveidot kontu',
    'register_lnk' => 'Re�istr�ties',
    'login_lnk' => 'Piesl�gties',
    'logout_lnk' => 'Beigt darbu',
    'lastup_lnk' => 'Jaun�kie att�li',
    'lastcom_lnk' => 'Jaun�kie koment�ri',
    'topn_lnk' => 'Skat�t�kie att�li',
    'toprated_lnk' => 'Vispopul�r�kie',
    'search_lnk' => 'Mekl�t',
    'fav_lnk' => 'Favor�ti', 

);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Apstiprin�t',
    'config_lnk' => 'Konfigur�t',
    'albums_lnk' => 'Albumi',
    'categories_lnk' => 'Sada�as',
    'users_lnk' => 'Lietot�ji',
    'groups_lnk' => 'Grupas',
    'comments_lnk' => 'Koment�ri',
    'searchnew_lnk' => 'Att�lu grupas...',
    'util_lnk' => 'Main�t att�la izm�rus', 
    'ban_lnk' => 'Aiziegt piek�uvi', 
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Izveidot manu albumu',
    'modifyalb_lnk' => 'Main�t manu albumu',
    'my_prof_lnk' => 'Profails',
);

$lang_cat_list = array(
    'category' => 'Sada�as',
    'albums' => 'Albumi',
    'pictures' => 'Att�li',
);

$lang_album_list = array(
    'album_on_page' => '%d albums(-i) %d lap�(s)'
);

$lang_thumb_view = array(
    'date' => 'LAIKS',
    'name' => 'NOSAUKUMS', 
    'title' => 'VIRSRAKSTS', 
    'sort_da' => 'p�c datuma augo�i',
    'sort_dd' => 'p�c datuma dilsto�i',
    'sort_na' => 'p�c nosaukuma augo�i',
    'sort_nd' => 'p�c nosaukuma dilsto�i',
    'sort_ta' => 'p�c virsraksta augo�i', 
    'sort_td' => 'Sort by title descending',
    'pic_on_page' => '%d att�ls(-i) %d lap�(s)',
    'user_on_page' => '%d lietot�js(-i) %d lap�(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Atgriezties uz att�lu indeksu',
    'pic_info_title' => 'R�d�t/pasl�pt inform�ciju par att�lu',
    'slideshow_title' => 'Slaid�ovs',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'S�t�t k� e-karti�u',
    'ecard_disabled' => 'e-karti�u s�t��ana atsl�gta',
    'ecard_disabled_msg' => 'Tev nav pietiekamu ties�bu, lai s�t�tu e-karti�as',
    'prev_title' => 'Iepriek��jais att�ls',
    'next_title' => 'N�kamais att�ls',
    'pic_pos' => 'ATT�LS %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
);

$lang_rate_pic = array(
    'rate_this_pic' => 'Nov�rt�t ',
    'no_votes' => '(nov�rt�juma nav)',
    'rating' => '(nov�rt�jums: %s balsis no 5 (balsots %s reizi(-es))',
    'rubbish' => 'M�sls',
    'poor' => 'V�ji',
    'fair' => 'Viduv�ji',
    'good' => 'Labi',
    'excellent' => 'Teicami',
    'great' => 'Lieliski',
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
    CRITICAL_ERROR => 'Kritiska k��da',
    'file' => 'Fails: ',
    'line' => 'Rinda: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Nosaukums : ',
    'filesize' => 'Lielums : ',
    'dimensions' => 'Izm�rs : ',
    'date_added' => 'Pievienots : '
);

$lang_get_pic_data = array(
    'n_comments' => 'koment�ri: <strong>%s</strong>',
    'n_views' => 'skat�jumi: <strong>%s</strong>',
    'n_votes' => 'v�rt�jumi: <strong>%s</strong>'
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
    0 => 'Pametam administr��anas re��mu...',
    1 => 'Uz administr��anas re��mu...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'K� sauksim albumu?',
    'confirm_modifs' => 'Apstiprin�t veikt�s izmai�as?',
    'no_change' => 'Nekas nav main�ts!',
    'new_album' => 'Jauns albums',
    'confirm_delete1' => 'Tie��m dz�st �o albumu?',
    'confirm_delete2' => '\nVisi att�li un koment�ri taj� tiks izdz�sti!',
    'select_first' => 'Vispirms j�izv�las albumu',
    'alb_mrg' => 'Albumu mened�eris',
    'my_gallery' => '* Mana galerija *',
    'no_category' => '* Mana sada�a *',
    'delete' => 'Dz�st',
    'new' => 'Jauns',
    'apply_modifs' => 'Apstiprin�t izmai�as',
    'select_category' => 'Izv�l�ties sada�u',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Komandas \'%s\' izpild��anai tr�kst nepiecie�amie parametri!',
    'unknown_cat' => 'Izv�l�t� sada�a datu b�z� neeksist�',
    'usergal_cat_ro' => 'Lietot�ja galerijas sada�a nevar tikt dz�sta!',
    'manage_cat' => 'Administr�t sada�as',
    'confirm_delete' => 'Tie��m dz�st �o sada�u',
    'category' => 'Sada�a',
    'operations' => 'Darb�bas',
    'move_into' => 'P�rvietot uz',
    'update_create' => 'Modific�t/izveidot sada�u',
    'parent_cat' => 'Pieder sada�ai',
    'cat_title' => 'Sada�as virsraksts',
    'cat_desc' => 'Sada�as apraksts'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Konfigur�cija',
    'restore_cfg' => 'Atjaunot noklus�t�s v�rt�bas',
    'save_cfg' => 'Saglab�t jaunos uzst�d�jumus',
    'notes' => 'Piez�mes',
    'info' => 'Inform�cija',
    'upd_success' => 'Coppermine konfigur�cija saglab�ta',
    'restore_success' => 'Coppermine noklus�t� konfigur�cija uzst�d�ta',
    'name_a' => 'Nosaukums augo�i',
    'name_d' => 'Nosaukums dilsto�i',
    'title_a' => 'Virsraksts augo�i', 
	'title_d' => 'Virsraksts dilsto�i', 
	'date_a' => 'Datums augo�i',
    'date_d' => 'Datums dilsto�i',
    'th_any' => 'Max Aspect',
    'th_ht' => 'Height',
    'th_wd' => 'Width',
);
// start left side interpretation

if (defined('CONFIG_PHP')) 
$lang_config_data = array(
//'General settings',
'Galvenie uzst�d�jumi',
array(
'Nosaukums', 'gallery_name', 0),
array(
'Apraksts', 'gallery_description', 0),
array(
'Administrators', 'gallery_admin_email', 0),
array(
'Adrese, kas b�s e-karti�� pie teksta \'Citi att�li...\'', 'ecards_more_pic_target', 0),
array(
'Valoda', 'lang', 5),
// for postnuke change
array(
'T�ma', 'theme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
//'Album list view',
'Albumu saraksta skat�jums',
array(
'Galven�s tabulas platums (pikse�os vai %)', 'main_table_width', 0),
array(
'Cik l�me�os sada�as atspogu�ot', 'subcat_level', 0),
array(
'Cik albumus atspogu�ot', 'albums_per_page', 0),
array(
'Cik kolonn�s atspogu�ot alb�mus', 'album_list_cols', 0),
array(
'Cik lieli pikse�os b�s mazie att�li', 'alb_list_thumb_size', 0),
array(
'Galven�s lapas saturs', 'main_page_layout', 0),
array(
'R�d�t pirm� l�me�a mazos att�lus pa sada��m','first_level',1), 
//'Thumbnail view',
'Mazo att�lu skat�jums',
array(
'Cik kolonn�s r�d�t mazos att�lus', 'thumbcols', 0),
array(
'Cik rind�s r�d�t mazos att�lus', 'thumbrows', 0),
array(
'Cik tabulas atspogu�ot', 'max_tabs', 0),
array(
'Blakus mazajam att�lam atspogu�ot ne tikai att�la virsrakstu, bet ar� aprakstu', 'caption_in_thumbview', 1),
array(
'Atspogu�ot koment�ru skaitu', 'display_comment_count', 1),
array(
'K� k�rtot att�lus', 'default_sort_order', 3),
array(
'Minim�lais balsu skaits, lai att�ls tiktu iek�auts vispopul�r�ko sarakst�', 'min_votes_for_rating', 0),
//'Image view &amp; Comment settings',
'Att�lu skat��an�s &amp; Koment�ri',
array(
'Att�la tabulas platums (pikse�os vai %)', 'picture_table_width', 0),
array(
'Att�la inform�cija redzama p�c noklus��anas', 'display_pic_info', 1),
array(
'Filtr�t sliktus v�rdus koment�ros', 'filter_bad_words', 1),
array(
'At�aut seji�as koment�ros', 'enable_smilies', 1),
array(
'Max att�la apraksta garums', 'max_img_desc_length', 0),
array(
'Max simbolu skaits vien� v�rd�', 'max_com_wlength', 0),
array(
'Max rindu skaits koment�r�', 'max_com_lines', 0),
array(
'Max koment�ra garums', 'max_com_size', 0),
array(
'Filmas skat�jums', 'display_film_strip', 1), 

array(
'Att�lu skaits filmas skat�jum�', 'max_film_strip_items', 0), 
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',

'Lielo un mazo att�lu kvalit�te',
array(
'JPEG failu kvalit�te', 'jpeg_qual', 0),
array(
'Max maz� att�la platums vai augstums <strong>*</strong>', 'thumb_width', 0),
array(
'Izmantojamie izm�ri ( platums vai augstums )<strong>*</strong>', 'thumb_use', 7), 

array(
'Izveidot ar� \'starpatt�lus\'','make_intermediate',1),
array(
'Max \'starpatt�la\' platums vai augstums <strong>*</strong>', 'picture_width', 0),
array(
'Max uzlikt� att�la lielums (KB)', 'max_upl_size', 0),
array(
'Max uzlikt� att�la platums vai augstums (pikse�os)', 'max_upl_width_height', 0),
//'User settings',
'Lietot�ju uzst�d�jumi',
array(
'At�aut jaunu lietot�ju piere�istr��anos', 'allow_user_registration', 1),
array(
'Lietot�ja sekm�gai re�istr�cija nepiecie�ams e-pasta apstiprin�jums', 'reg_requires_valid_email', 1),
array(
'At�aut diviem da��diem lietot�jiem izmantot vien�das e-pasta adreses', 'allow_duplicate_emails_addr', 1),
array(
'Lietot�js dr�kst veidot person�gus alb�mus', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

    'Rezerves lauki att�la aprakstam (ja neizmanto, atst�j tuk�us)',
array(
'Lauka 1 nosaukums', 'user_field1_name', 0),
array(
'Lauka 2 nosaukums', 'user_field2_name', 0),
array(
'Lauka 3 nosaukums', 'user_field3_name', 0),
array(
'Lauka 4 nosaukums', 'user_field4_name', 0),
//'Pictures and thumbnails advanced settings',
'Lielo un mazo att�lu �pa�ie uzst�d�jumi',
array(
'R�d�t person�g� albuma ikonu anon�majiem apmekl�t�jiem','show_private',1), 
array(
'K�di simboli aizliegti failu nosaukumos', 'forbiden_fname_char',0),
array(
'Uzliekamo att�lu at�autie failu papla�in�jumi', 'allowed_file_extensions',0),
array(
'Att�lu izm�ru main��anas metodes','thumb_method',2),
array(
'Ce�� uz ImageMagick / netpbm \'convert\' util�tu (piem�ram, /usr/bin/X11/)', 'impath', 0),
array(
'At�auti att�lu form�ti (tikai priek� ImageMagick)', 'allowed_img_types',0),
array(
'Komandrindas parametri ImageMagick util�tai', 'im_options', 0),
array(
'Izmantot JPEG att�lu EXIF inform�ciju', 'read_exif_data', 1),
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'Albumu direktorija <strong>*</strong>', 'fullpath', 0),
array(
'Lietot�ju albumu direktorija <strong>*</strong>', 'userpics', 0),
array(
'Starpatt�lu prefikss <strong>*</strong>', 'normal_pfx', 0),
array(
'Mazo att�lu prefikss <strong>*</strong>', 'thumb_pfx', 0),
array(
'Direktoriju skat�juma re��ms p�c noklus��anas', 'default_dir_mode', 0),
array(
'Att�lu re��ms', 'default_file_mode', 0),
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
'Cepumi (cookies) &amp; Kod�jums',
array(
'Cookie nosaukumus', 'cookie_name', 0),
array(
'Cookie ce��', 'cookie_path', 0),
array(
'Teksta kod�jums', 'charset', 4),
'Citi uzst�d�jumi',
array(
'Debug re��ms', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2

    '<br /><div align="center">(*) Ar * atz�m�tos parametrus nav ieteicams main�t, ja galer�j�s jau ir att�li</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Ja neb�s v�rds un koment�ra teksts, nekas nesan�ks',
    'com_added' => 'Koment�rs pievienots',
    'alb_need_title' => 'K�ds ir albuma virsraksts (nosaukums)?',
    'no_udp_needed' => 'Izmai�as nav nepiecie�amas.',
    'alb_updated' => 'Album� veiksm�gi veiktas izmai�as',
    'unknown_album' => 'Izv�l�tais albums neeksist� vai ar� nav ties�bu taj� pievienot att�lus',
    'no_pic_uploaded' => 'Att�ls netika uzlikts!<br /><br />Vai uz servera ir uzlikta at�auja ��d�m oper�cij�m?',
    'err_mkdir' => 'Direktorija %s NEtika izveidota!',
    'dest_dir_ro' => 'Nav ties�bu veikt ierakstu direktrij� %s!',
    'err_move' => 'Nav iesp�jams p�rvietot %s uz %s !',
    'err_fsize_too_large' => 'Uzliekam� att�la izm�rs p�rsniedz max at�auto (max at�autais ir %s x %s) !',
    'err_imgsize_too_large' => 'Uzliekam� att�la faila izm�rs p�rsniedz max at�auto (max at�autais ir %s KB) !',
    'err_invalid_img' => 'Uzliekamais fails nav klasific�jams k� att�ls!',
    'allowed_img_types' => 'Tu dr�ksti uzlikt %s att�lus.',
    'err_insert_pic' => 'Att�ls \'%s\' nevar tikt pievienots ',
    'upload_success' => 'Att�ls veiksm�gi uzlikts<br /><br />Tas b�s redzams galerij�, tikl�dz Administrators to b�s akcept�jis.',
    'info' => 'Inform�cija',
    'com_added' => 'Koment�rs pievienots',
    'alb_updated' => 'Albums modific�ts',
    'err_comment_empty' => 'Nav koment�ra!',
    'err_invalid_fext' => 'At�auti faili ar ��diem papla�in�jumiem : <br /><br />%s.',
    'no_flood' => 'Atvaino, bet tie�i tu ar� esi p�d�j� ies�t�t� koment�ra autors.<br /><br />Modific� sava p�d�j� ies�t�t� koment�ra tekstu',
    'redirect_msg' => 'Notiek p�radres�cija.<br /><br /><br />Spied uz \'TURPIN�T\', ja lapa nep�rl�d�jas',
    'upl_success' => 'Att�ls veiksm�gi pievienots',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Teksts',
    'fs_pic' => 'piln� izm�ra att�ls',
    'del_success' => 'veiksm�gi izdz�sts',
    'ns_pic' => 'norm�la izm�ra att�ls',
    'err_del' => 'nevar tikt izdz�sts',
    'thumb_pic' => 'mazais att�ls',
    'comment' => 'koment�rs',
    'im_in_alb' => 'att�ls album�',
    'alb_del_success' => 'Albums \'%s\' izdz�sts',
    'alb_mgr' => 'Albuma mened�eris',
    'err_invalid_data' => 'Sa�emta nekorekta inform�cija \'%s\'',
    'create_alb' => 'Tiek veidots albums \'%s\'',
    'update_alb' => 'Tiek modific�ts albums \'%s\' ar virsrakstu \'%s\' un indeksu \'%s\'',
    'del_pic' => 'Dz�st att�lu',
    'del_alb' => 'Dz�st albumu',
    'del_user' => 'Dz�st lietot�ju',
    'err_unknown_user' => 'Izv�l�tais lietot�js neeksist�!',
    'comment_deleted' => 'Koment�rs veiksm�gi izdz�sts',
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
    'confirm_del' => 'Tie��m DZ�ST �o att�lu? \\nAr� koment�ri tiks izdz�sti.',
    'del_pic' => 'IZDZ�ST �O ATT�LU',
    'size' => '%s x %s px',
    'views' => '%s reizes',
    'slideshow' => 'Slaid�ovs',
    'stop_slideshow' => 'APST�DIN�T SLAID�OVU',
    'view_fs' => 'Uzspied, lai redz�tu pilna izm�ra att�lu',
);

$lang_picinfo = array(
    'title' =>'Inform�cija par att�lu',
    'Filename' => 'Att�ls',
    'Album name' => 'Albums',
    'Rating' => 'V�rt�jums (%s balsis)',
    'Keywords' => 'Atsl�gas v�rdi',
    'File Size' => 'Faila lielums',
    'Dimensions' => 'Izm�rs',
    'Displayed' => 'Att�lots',
    'Camera' => 'Kamera',
    'Date taken' => 'Uz�em�anas datums',
    'Aperture' => 'Objekt�va diametrs',
    'Exposure time' => 'Ekspoz�cijas laiks',
    'Focal length' => 'Fokuss',
    'Comment' => 'Koment�ri',
    'addFav'=>'Uz favor�tiem', 

'addFavPhrase'=>'Favor�ti', 

'remFav'=>'Dz�st no favor�tiem', 

);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Modific�t koment�ru',
    'confirm_delete' => 'Tie��m DZ�ST �o koment�ru?',
    'add_your_comment' => 'Pievienot koment�ru',
    'name'=>'V�rds', 

'comment'=>'Koment�rs', 

'your_name' => 'Anon�ms', 

);

$lang_fullsize_popup = array(
    'click_to_close' => 'Uzklik��ini uz att�la, lai aizv�rtu �o logu', 

);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Nos�t�t e-karti�u',
    'invalid_email' => '<strong>UZMAN�BU</strong> : k��daina adrese!',
    'ecard_title' => 'Sveiciens no %s',
    'view_ecard' => '�o sveicienu var redz�t ar� sekojo�a adres�',
    'view_more_pics' => 'Citi for�i att�li...',
    'send_success' => 'E-karti�a nos�t�ta',
    'send_failed' => 'Atvaino, serveris nevar nos�t�t tavu E-karti�u...',
    'from' => 'No k�',
    'your_name' => 'V�rds',
    'your_email' => 'E-pasta adrese',
    'to' => 'Kam',
    'rcpt_name' => 'Sa�em�ja v�rds',
    'rcpt_email' => 'Sa��m�ja e-pasta adrese',
    'greetings' => 'Sveiciens',
    'message' => 'Pilnais teksts',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Att�la&nbsp;dati',
    'album' => 'Albums',
    'title' => 'Virsraksts',
    'desc' => 'Apraksts',
    'keywords' => 'Atsl�gas v�rdi',
    'pic_info_str' => '%sx%s - %sKB - %s skat�jumi - %s balsis',
    'approve' => 'Apstiprin�t att�la pievieno�anu',
    'postpone_app' => 'Noraid�t att�la pievieno�anu',
    'del_pic' => 'Dz�st att�lu',
    'reset_view_count' => 'Nodz�st skat�jumi skait�t�ju',
    'reset_votes' => 'Nodz�st balsojumu skaitu',
    'del_comm' => 'Dz�st koment�rus',
    'upl_approval' => 'Uzlik�anas apstiprin�jums',
    'edit_pics' => 'Modific�t att�lus',
    'see_next' => 'Iepriek��jie att�li',
    'see_prev' => 'N�kamie att�li',
    'n_pic' => '%s att�li',
    'n_of_pic_to_disp' => 'Cik att�lus atspogu�ot',
    'apply' => 'Apstiprin�t izmai�as'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Grupa',
    'disk_quota' => 'Kvota (atmi�as ierobe�ojumi)',
    'can_rate' => 'Dr�kst v�rt�t att�lus',
    'can_send_ecards' => 'Dr�kst s�t�t e-karti�as',
    'can_post_com' => 'Dr�kst koment�t',
    'can_upload' => 'Dr�kst likt att�lus',
    'can_have_gallery' => 'Dr�kst b�t person�ga galerija',
    'apply' => 'Apstiprin�t izmai�as',
    'create_new_group' => 'Izveidot jaunu grupu',
    'del_groups' => 'Dz�st grupu(-as)',
    'confirm_del' => 'Uzman�bu! Dz��ot grupu, visi tai pieder�gie lietot�ji tiks p�rvietoti uz re�istr�to lietot�ju grupu!\n\nTurpin�t?',
    'title' => 'Administr�t lietot�ju grupas',
    'approval_1' => 'Publisks uzlik�anas apstiprin�jums (1)',
    'approval_2' => 'Priv�ts uzlik�anas apstiprin�jums (2)',
    'note1' => '<strong>(1)</strong> Att�lu uzlik�anai publisk� alb�m� ir nepiecie�ama administratora at�auja',
    'note2' => '<strong>(2)</strong> Att�lu pievieno�anai album�, kas pieder �im lietot�jam, nepiecie�ama administratora at�auja',
    'notes' => 'Piez�mes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Laipni l�dzam!'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Tie��m DZ�ST �o albumu? \\nVisi att�li un koment�ri taj� tiks izdz�sti.',
    'delete' => 'IZDZ�ST',
    'modify' => 'UZST�D�JUMI',
    'edit_pics' => 'MODIFIC�T ATT�LUS',
);

$lang_list_categories = array(
    'home' => 'Galven� lapa',
    'stat1' => 'att�li: <strong>[pictures]</strong> | albumi: <strong>[albums]</strong> | sada�as: <strong>[cat]</strong> | koment�ri: <strong>[comments]</strong> | <strong>skat�ts [views]</strong> reizes',
    'stat2' => 'att�li: <strong>[pictures]</strong> | albumi: <strong>[albums]</strong> | skat�ti <strong>[views]</strong> reizes',
    'xx_s_gallery' => 'Autors %s',
    'stat3' => '<strong>[pictures]</strong> att�li | <strong>[albums]</strong> albumi | <strong>[comments]</strong> koment�ri | skat�ti <strong>[views]</strong> reizes'
);

$lang_list_users = array(
    'user_list' => 'Lietot�ju saraksts',
    'no_user_gal' => 'Nav lietot�ju galerijas',
    'n_albums' => 'albumi: <strong>%s</strong>',
    'n_pics' => 'att�li: <strong>%s</strong>'
);

$lang_list_albums = array(
    'n_pictures' => '<strong>%s</strong> att�li',
    'last_added' => ', p�d�jais pievienots <strong>%s</strong>'
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
    'upd_alb_n' => 'Modific�t albumu %s',
    'general_settings' => 'Galvenie uzst�d�jumi',
    'alb_title' => 'Albuma virsraksts',
    'alb_cat' => 'Sada�a',
    'alb_desc' => 'Albuma apraksts',
    'alb_thumb' => 'Albuma mazais att�ls',
    'alb_perm' => 'Albuma lietot�ju ties�bas',
    'can_view' => 'Albumu var skat�ties',
    'can_upload' => 'Apmekl�t�jie dr�kst pievienot att�lus',
    'can_post_comments' => 'Apmekl�t�ji dr�kst koment�t',
    'can_rate' => 'Apmekl�t�ji dr�kst v�rt�t att�lus',
    'user_gal' => 'Lietot�ja galerija',
    'no_cat' => '* Kategorijas nav *',
    'alb_empty' => 'Albums ir tuk�s',
    'last_uploaded' => 'P�dejoreiz uzlikts att�ls',
    'public_alb' => 'Ikviens (publiskais albums)',
    'me_only' => 'Tikai es',
    'owner_only' => 'Tikai albuma �pa�nieks (%s)',
    'groupp_only' => 'Tikai \'%s\' grup� eso�ie',
    'err_no_alb_to_modify' => 'Tev nav ties�bu modific�t albumus.',
    'update' => 'Saglab�t izmai�as'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Atvaino, bet tu jau esi iesniedzis savu v�rt�jumu',
    'rate_ok' => 'V�rt�jums pie�emts',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Ar �o Tu ap�emies neievietot citus aizskaro�us, piedauz�gus, vulg�rus, apmelojo�us, pret�gus, draudo�us, seksu�li orient�tus, vai jebk�dus citus materi�lus, kas p�rk�pj jebk�dus likumus. Likumu nezin��ana neatbr�vo no atbild�bas!!! Tu piekr�ti, ka ��s lapas webmasters, administrators un moderators ir ties�gi izdz�st vai main�t saturu jebkur� laik�, kad vien v�l�s. K� lietot�js Tu piekr�ti, ka visa inform�cija ko Tu ievad�si tiks saglab�ta datub�z�. Webmasters un administrators nav atbild�gi par jebk�du tavas inform�cijas uzlau�anu vai izmain��anu.<br />
<br />
�� lapa izmanto 'cookies', lai saglab�tu inform�ciju tav� dator�. 'Cookies' vien�gi uzlabo lapas par�d��anas kvalit�ti. E-pasta adrese tiek izmantota vien�gi Tavas re�istr�cijas apstiprin��anai, lai nos�t�tu paroli.<br />
<br />
Izv�loties zem�k 'Es piekr�tu' Tu piekr�ti visam iepriek� rakst�tajam.
EOT;

$lang_register_php = array(
    'page_title' => 'Lietot�ja re�istr�cija',
    'term_cond' => 'Vieno�an�s nosac�jumi',
    'i_agree' => 'Es piekr�tu',
    'submit' => 'Apstiprin�t re�istr�ciju',
    'err_user_exists' => '�is lietot�ja v�rds jau ir re�istr�ts, izv�lies citu',
    'err_password_mismatch' => 'Paroles nesakr�t, raksti v�lreiz',
    'err_uname_short' => 'Lietot�ja v�rda minim�lais simbolu skaits ir 2',
    'err_password_short' => 'Parol� j�b�t ne maz�k k� 2 simboliem',
    'err_uname_pass_diff' => 'Lietot�ja v�rds un parole nedr�kst b�t vien�di',
    'err_invalid_email' => 'E-pasta adres ir nepareiza',
    'err_duplicate_email' => '��da email adrese jau ir datu b�z�',
    'enter_info' => 'Re�istr�cijas inform�cija',
    'required_info' => 'Nepiecie�am� inform�cija',
    'optional_info' => 'Neoblig�t� inform�cija',
    'username' => 'Lietot�ja v�rds',
    'password' => 'Parole',
    'password_again' => 'V�lreiz parole',
    'email' => 'E-pasts',
    'location' => 'Atra�an�s vieta',
    'interests' => 'Intereses',
    'website' => 'M�jas lapa',
    'occupation' => 'Nodarbo�an�s',
    'error' => 'K��DA',
    'confirm_email_subject' => '%s - Re�istr�cijas apstiprin�jums',
    'information' => 'Inform�cija',
    'failed_sending_email' => 'Nevar tikt nos�t�ta re�istr�cijas apstiprin�juma v�stule!',
    'thank_you' => 'Paldies par re�istr��anos.<br /><br />V�stule ar s�k�ku inform�ciju, k� pabeigt re�istr��an�s procesu, tika nos�t�ta uz iepriek� min�to adresi.',
    'acct_created' => 'Konts izveidots un tu vari piesl�gties ar savu lietot�ja v�rdu un paroli',
    'acct_active' => 'Konts ir akt�vs un tu tagad vari piesl�gties sist�mai',
    'acct_already_act' => 'Konts jau ir akt�vs!',
    'acct_act_failed' => '�is konts nevar tikt aktiviz�ts!',
    'err_unk_user' => 'Izv�l�tais lietot�js neeksist�!',
    'x_s_profile' => '%s : profails',
    'group' => 'Grupa',
    'reg_date' => 'Pievienojies',
    'disk_usage' => 'Diska izmanto�ana',
    'change_pass' => 'Nomain�t paroli',
    'current_pass' => 'Pa�reiz�j� parole',
    'new_pass' => 'Jauna parole',
    'new_pass_again' => 'V�lreiz jaun� parole',
    'err_curr_pass' => 'Pa�reiz�j� parole nepareiza',
    'apply_modif' => 'Apstiprin�t izmai�as',
    'change_pass' => 'Nomain�t paroli',
    'update_success' => 'Profails izmain�ts',
    'pass_chg_success' => 'Parole nomain�ta',
    'pass_chg_error' => 'Parole netika nomain�ta',
);

$lang_register_confirm_email = <<<EOT
Paldies par re�istr��anos {SITE_NAME}

Lietot�ja v�rds : "{USER_NAME}"
Lietot�ja parole : "{PASSWORD}"

Lai aktiviz�tu savu kontu, nepiecie�ams iel�d�t zem�k redzamo lapu.

{ACT_LINK}

Lai veicas,

{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Apskat�ties koment�rus',
    'no_comment' => 'Koment�ru nav',
    'n_comm_del' => '%s koment�ri izdz�sti',
    'n_comm_disp' => 'Cik koment�rus atspogu�ot',
    'see_prev' => 'Iepriek��jie',
    'see_next' => 'N�kamie',
    'del_comm' => 'Dz�st izv�l�tos koment�rus',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Mekl�t att�lu kolekcij�',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Mekl�t jaunus att�lus',
    'select_dir' => 'Izv�l�ties direktoriju',
    'select_dir_msg' => '�� funkcija �auj pievienot daudzus att�lus vienlaikus, ja tie iepriek� uzlikti ar FTP.<br /><br />Izv�lies direktoriju, kur tika uzlikti att�li',
    'no_pic_to_add' => 'Nav att�lu, ko var�tu pievienot',
    'need_one_album' => 'Lai izmantotu �o funkciju, nepiecie�ams vismaz viens albums',
    'warning' => 'Uzman�bu',
    'change_perm' => 'nav pieeja direktorijai, tai j�izmaina ties�bas (chmod) no 755 uz 777, lai var�tu pievienot att�lus!',
    'target_album' => '<strong>Ievietot att�lus &quot;</strong>%s<strong>&quot; </strong>%s',
    'folder' => 'Direktorija',
    'image' => 'Att�ls',
    'album' => 'Albums',
    'result' => 'Rezult�ti',
    'dir_ro' => 'Nav rakst��anas ties�bu. ',
    'dir_cant_read' => 'Nav las��anas ties�bu. ',
    'insert' => 'Jaunu att�lu pievieno�ana',
    'list_new_pic' => 'Jauno att�lu saraksts',
    'insert_selected' => 'Pievienot izv�l�tos att�lus',
    'no_pic_found' => 'Jauni att�li netika atrasti',
    'be_patient' => 'L�dzu esiet paciet�gi, kam�r tiek pievienoti jaunie att�li',
    'notes' =>  '<ul>'.
            '<li><strong>OK</strong> : att�ls veiksm�gi pievienots'.
            '<li><strong>DP</strong> : noz�m�, ka t�ds att�ls jau ir datu b�z�'.
            '<li><strong>PB</strong> : att�lu nevar pievienot, j�p�rbauda pieejas ties�bas'.
            '<li>Ja OK, DP, PB \'z�mes\' nepar�d�s, j�klik��ina uz att�la, kas par�d�s, lai ieg�tu detaliz�t�ku k��das aprakstu'.
            '<li>Ja p�rl�k� par�d�s pazi�ojums par taimautu, lapa ir j�p�rl�d�'.
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
    'title' => 'Uzlikt att�lu',
    'max_fsize' => 'Max pievienojam� faila lielums %s KB',
    'album' => 'Albums',
    'picture' => 'Att�ls',
    'pic_title' => 'Att�la virsraksts',
    'description' => 'Att�la apraksts',
    'keywords' => 'Atsl�gas v�rdi (atdal�t ar atstarp�m)',
    'err_no_alb_uploadables' => 'Atvaino, nav neviena albuma, kur� tu var�tu ievietot savus att�lus',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Administr�t lietot�jus',
    'name_a' => 'V�rds augo�i',
    'name_d' => 'V�rds dilsto�i',
    'group_a' => 'Grupa augo�i',
    'group_d' => 'Grupa dilsto�i',
    'reg_a' => 'Reg datums augo�i',
    'reg_d' => 'Reg datums dilsto�i',
    'pic_a' => 'Att�lu skaits augo�i',
    'pic_d' => 'Att�lu skaits dilsto�i',
    'disku_a' => 'Diska atmi�a augo�i',
    'disku_d' => 'Diska atmi�a dilsto�i',
    'sort_by' => 'K�rtot',
    'err_no_users' => 'Lietot�ju tabul� nav datu!',
    'err_edit_self' => 'Nemaini te savu profailu, tam izmanto \'Mans profails\'',
    'edit' => 'MODIFIC�T',
    'delete' => 'DZ�ST',
    'name' => 'Lietot�js',
    'group' => 'Grupa',
    'inactive' => 'Neakt�vs',
    'operations' => 'Darb�bas',
    'pictures' => 'Att�li',
    'disk_space' => 'Izmantot� atmi�a / Ierobe�ojums',
    'registered_on' => 'Re�istr�ts',
    'u_user_on_p_pages' => '%d lietot�ji %d lap�(s)',
    'confirm_del' => 'Tie��m DZ�ST �o lietot�ju? \\nVisi vi�a att�li un koment�ri ar� tiks izdz�sti',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Izv�l�tais lietot�js neeksist�!',
    'modify_user' => 'Main�t datus',
    'notes' => 'Piez�mes',
    'note_list' => '<li>Ja nev�lies main�t paroli, atst�j paroles lauku tuk�u',
    'password' => 'Parole',
    'user_active' => 'Lietot�js akt�vs',
    'user_group' => 'Grupa',
    'user_email' => 'Emails',
    'user_web_site' => 'M�jas lapa',
    'create_new_user' => 'Izveidot',
    'user_location' => 'Atra�an�s',
    'user_interests' => 'Intereses',
    'user_occupation' => 'Nodarbo�an�s',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
    'title' => 'Att�lu zim�ri', 

'what_it_does' => 'Funkcijas', 

'what_update_titles' => 'Virsraksti tiek �emti no failu nosaukumiem', 

'what_delete_title' => 'Dz�st virsrakstus', 

'what_rebuild' => 'P�rveidot att�lus', 

'what_delete_originals' => 'Dz�st ori�in�los att�lus un nomain�t tos ar samazin�tajiem/palielin�tajiem', 

'file' => 'Fails', 

'title_set_to' => 'virsraksts', 

'submit_form' => 'Apstiprin�t', 

'updated_succesfully' => 'Veiksm�gi izman�ts', 

'error_create' => 'K��da', 

'continue' => 'Turpin�t ar citiem att�liem', 

'main_success' => 'Fails %s tiek izmantots k� galvenais att�ls', 

'error_rename' => 'K��da %s p�rsaucot par %s', 

'error_not_found' => 'Fails %s nav atrasts', 

'back' => 'Atgriezties', 

'thumbs_wait' => 'Notiek mazo un norm�lo att�lu modific��ana, l�dzu uzgaidi...', 

'thumbs_continue_wait' => 'Turpinam modific�t mazos un norm�los att�lus...', 

'titles_wait' => 'Norit spar�ga virsrakstu modific��ana, uzgaidi...', 

'delete_wait' => 'Dz��u virsrakstus, l�dzu uzgaidi...', 

'replace_wait' => 'Dz��u ori�in�lus, nomainot tos ar modific�tajiem att�liem, l�dzu uzgaidi...', 

'instruction' => 'Ieteikumi', 

'instruction_action' => 'Izv�lies darb�bu', 

'instruction_parameter' => 'Uzliec parametrus', 

'instruction_album' => 'Izv�lies albumu', 

'instruction_press' => 'Nospied %s', 

'update' => 'Modific� mazos un/vai norm�los att�lus', 

'update_what' => 'Kas j�modific�', 

'update_thumb' => 'Tikai mazos att�lus', 

'update_pic' => 'Tikai modific�tos att�lus', 

'update_both' => 'Gan mazie, gan norm�lie att�li', 

'update_number' => 'Cik att�lus var modific�t ar vienu klik��i', 

'update_option' => '(�o parametru samazini, ja ir probl�mas ar modific��anu)', 

'filename_title' => 'Faila nosaukums &rArr; Att�la virsraksts', 

'filename_how' => 'K� modific�t att�lu', 

'filename_remove' => 'Dz�st .jpg papla�in�jumu un _ nomain�t ar atstarpi', 

'filename_euro' => 'Konvert�t 2003_11_23_13_20_20.jpg uz 23/11/2003 13:20', 

'filename_us' => 'Konevert�t 2003_11_23_13_20_20.jpg uz 11/23/2003 13:20', 

'filename_time' => 'Konvert�t 2003_11_23_13_20_20.jpg uz 13:20', 

'delete' => 'Att�lu virsrakstu un att�lu dz��ana', 

'delete_title' => 'Dz�st att�lu virsrakstus', 

'delete_original' => 'Dz�st ori�in�lus', 

'delete_replace' => 'Dz�st ori�in�lus aizst�jot tos ar modific�tajiem att�liem', 

'select_album' => 'Izv�lies albumu', 

);
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(// new in cpg1.2.0nuke    'divider' => '>',
    'viewing' => 'Viewing Photo',
    'usr' => "'s Photo Gallery",
    'photogallery' => 'Photo Gallery',
    );
?>