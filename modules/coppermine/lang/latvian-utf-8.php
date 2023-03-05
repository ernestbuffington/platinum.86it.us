<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke - Language Pack 0.9                //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
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
// to all devs: stop update just before committing this file!
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// info about translators and translated language
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
    'Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jûn', 'Jûl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'Jâ';
$lang_no  = 'Nç';
$lang_back = 'ATGRIEZTIES';
$lang_continue = 'TURPINÂT';
$lang_info = 'Informâcija';
$lang_error = 'Kïûda';

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
    '*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'pimp*', 'peþ*', 'pipel*', 'bïaì*', 'nahu*', 'pist*', 'pisien*', 'mirl*', 'sûd*', 'bled', 'blad', 'pizde*', 'mauka', 'maucî*', 'ânus*', 'kaka', 'sûkâ');

$lang_meta_album_names = array(
    'random' => 'Izlases veida attçli',
    'lastup' => 'Jaunâkie papildinâjumi',
   'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb'=> 'Pçdçjie atjaunotie albumi', 
    'lastcom' => 'Jaunâkie komentâri',
    'lastcomby' => 'My Last comments', // new 1.2.2
   'topn' => 'Skatîtâkie',
    'toprated' => 'Vispopulârâkie',
    'lasthits' => 'Pçdçjie skatîtie',
    'search' => 'Meklçðanas rezultâti', 
    'favpics'=> 'Attçlu favorîti' 

);

$lang_errors = array(
    'access_denied' => 'Tev nav pieejas tiesîbu ðai lapai.',
    'perm_denied' => 'Tev nav tiesîbu veikt ðâdu darbîbu.',
    'param_missing' => 'Tika izsaukta komanda bez parametriem.',
    'non_exist_ap' => 'Izvçlçtais albums/attçls neeksistç!',
    'quota_exceeded' => 'Nav vietas uz diska.<br /><br />Tev ir pieðíirts ierobeþojums [quota]K, bet paðlaik jau aizòemti [space]K, tâpçc ðî attçla pievienoðana nav ieteicama (tiks pârsniegts ierobeþojums).',
    'gd_file_type_err' => 'Izmantojot GD attçlu bibliotçku, atïauts izmantot tikai JPEG un PNG formâtus.',
    'invalid_image' => 'Attçls bojâts vai arî sistçmas GD attçlu bibliotçka nespçj to atkodçt.',
    'resize_failed' => 'Nav iespçjams izveidot mazo attçlu vai izmainît tâ izmçrus.',
    'no_img_to_display' => 'Nav attçla',
    'non_exist_cat' => 'Izvçlçtâ sadaïa neeksistç',
    'orphan_cat' => 'Ðai apakðsadaïai nav sadaïas, kam tâ piederçtu, lûdzu izmanto sadaïu menedþeri, lai atrisinâtu problçmu.',
    'directory_ro' => 'Direktorijâ \'%s\' nav atïauts rakstît, tâpçc attçlus nav iespçjams izdzçst.',
    'non_exist_comment' => 'Izvçlçtais komentârs neeksistç.',
    'pic_in_invalid_album' => 'Attçls atrodas neeksistçjoðâ albumâ (%s)!?', 
    'banned' => 'Pieeja foto galerijai aizliegta.', 
    'not_with_udb' => 'Ðî iespçja ir atslçgta, jo tai jâbût integrçtai kopâ ar foruma programmatûru. Trûkst attiecîgâs konfigurâcijas, vai nepiecieðams uzinstalçt forumu.', 
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'

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
    'adm_mode_title' => 'Pârslçgties Administratora reþîmâ',
    'adm_mode_lnk' => 'Administratora reþîms',
    'usr_mode_title' => 'Pârslçgties lietotâja reþîmâ',
    'usr_mode_lnk' => 'Lietotâja reþîms',
    'upload_pic_title' => 'Ielikt attçlu albumâ',
    'upload_pic_lnk' => 'Pievienot attçlu',
    'register_title' => 'Izveidot kontu',
    'register_lnk' => 'Reìistrçties',
    'login_lnk' => 'Pieslçgties',
    'logout_lnk' => 'Beigt darbu',
    'lastup_lnk' => 'Jaunâkie attçli',
    'lastcom_lnk' => 'Jaunâkie komentâri',
    'topn_lnk' => 'Skatîtâkie attçli',
    'toprated_lnk' => 'Vispopulârâkie',
    'search_lnk' => 'Meklçt',
    'fav_lnk' => 'Favorîti', 

);

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'Apstiprinât',
    'config_lnk' => 'Konfigurçt',
    'albums_lnk' => 'Albumi',
    'categories_lnk' => 'Sadaïas',
    'users_lnk' => 'Lietotâji',
    'groups_lnk' => 'Grupas',
    'comments_lnk' => 'Komentâri',
    'searchnew_lnk' => 'Attçlu grupas...',
    'util_lnk' => 'Mainît attçla izmçrus', 
    'ban_lnk' => 'Aiziegt piekïuvi', 
);

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'Izveidot manu albumu',
    'modifyalb_lnk' => 'Mainît manu albumu',
    'my_prof_lnk' => 'Profails',
);

$lang_cat_list = array(
    'category' => 'Sadaïas',
    'albums' => 'Albumi',
    'pictures' => 'Attçli',
);

$lang_album_list = array(
    'album_on_page' => '%d albums(-i) %d lapâ(s)'
);

$lang_thumb_view = array(
    'date' => 'LAIKS',
    'name' => 'NOSAUKUMS', 
    'title' => 'VIRSRAKSTS', 
    'sort_da' => 'pçc datuma augoði',
    'sort_dd' => 'pçc datuma dilstoði',
    'sort_na' => 'pçc nosaukuma augoði',
    'sort_nd' => 'pçc nosaukuma dilstoði',
    'sort_ta' => 'pçc virsraksta augoði', 
    'sort_td' => 'Sort by title descending',
    'pic_on_page' => '%d attçls(-i) %d lapâ(s)',
    'user_on_page' => '%d lietotâjs(-i) %d lapâ(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
);

$lang_img_nav_bar = array(
    'thumb_title' => 'Atgriezties uz attçlu indeksu',
    'pic_info_title' => 'Râdît/paslçpt informâciju par attçlu',
    'slideshow_title' => 'Slaidðovs',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Sûtît kâ e-kartiòu',
    'ecard_disabled' => 'e-kartiòu sûtîðana atslçgta',
    'ecard_disabled_msg' => 'Tev nav pietiekamu tiesîbu, lai sûtîtu e-kartiòas',
    'prev_title' => 'Iepriekðçjais attçls',
    'next_title' => 'Nâkamais attçls',
    'pic_pos' => 'ATTÇLS %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
);


$lang_rate_pic = array(
    'rate_this_pic' => 'Novçrtçt ',
    'no_votes' => '(novçrtçjuma nav)',
    'rating' => '(novçrtçjums: %s balsis no 5 (balsots %s reizi(-es))',
    'rubbish' => 'Mçsls',
    'poor' => 'Vâji',
    'fair' => 'Viduvçji',
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
    CRITICAL_ERROR => 'Kritiska kïûda',
    'file' => 'Fails: ',
    'line' => 'Rinda: ',
);

$lang_display_thumbnails = array(
    'filename' => 'Nosaukums : ',
    'filesize' => 'Lielums : ',
    'dimensions' => 'Izmçrs : ',
    'date_added' => 'Pievienots : '
);

$lang_get_pic_data = array(
    'n_comments' => 'komentâri: <strong>%s</strong>',
    'n_views' => 'skatîjumi: <strong>%s</strong>',
    'n_votes' => 'vçrtçjumi: <strong>%s</strong>'
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
    0 => 'Pametam administrçðanas reþîmu...',
    1 => 'Uz administrçðanas reþîmu...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'Kâ sauksim albumu?',
    'confirm_modifs' => 'Apstiprinât veiktâs izmaiòas?',
    'no_change' => 'Nekas nav mainîts!',
    'new_album' => 'Jauns albums',
    'confirm_delete1' => 'Tieðâm dzçst ðo albumu?',
    'confirm_delete2' => '\nVisi attçli un komentâri tajâ tiks izdzçsti!',
    'select_first' => 'Vispirms jâizvçlas albumu',
    'alb_mrg' => 'Albumu menedþeris',
    'my_gallery' => '* Mana galerija *',
    'no_category' => '* Mana sadaïa *',
    'delete' => 'Dzçst',
    'new' => 'Jauns',
    'apply_modifs' => 'Apstiprinât izmaiòas',
    'select_category' => 'Izvçlçties sadaïu',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'Komandas \'%s\' izpildîðanai trûkst nepiecieðamie parametri!',
    'unknown_cat' => 'Izvçlçtâ sadaïa datu bâzç neeksistç',
    'usergal_cat_ro' => 'Lietotâja galerijas sadaïa nevar tikt dzçsta!',
    'manage_cat' => 'Administrçt sadaïas',
    'confirm_delete' => 'Tieðâm dzçst ðo sadaïu',
    'category' => 'Sadaïa',
    'operations' => 'Darbîbas',
    'move_into' => 'Pârvietot uz',
    'update_create' => 'Modificçt/izveidot sadaïu',
    'parent_cat' => 'Pieder sadaïai',
    'cat_title' => 'Sadaïas virsraksts',
    'cat_desc' => 'Sadaïas apraksts'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'Konfigurâcija',
    'restore_cfg' => 'Atjaunot noklusçtâs vçrtîbas',
    'save_cfg' => 'Saglabât jaunos uzstâdîjumus',
    'notes' => 'Piezîmes',
    'info' => 'Informâcija',
    'upd_success' => 'Coppermine konfigurâcija saglabâta',
    'restore_success' => 'Coppermine noklusçtâ konfigurâcija uzstâdîta',
    'name_a' => 'Nosaukums augoði',
    'name_d' => 'Nosaukums dilstoði',
    'title_a' => 'Virsraksts augoði', 
    'title_d' => 'Virsraksts dilstoði', 
    'date_a' => 'Datums augoði',
    'date_d' => 'Datums dilstoði',
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
    'Galvenie uzstâdîjumi',
array(
'Nosaukums', 'gallery_name', 0),
array(
'Apraksts', 'gallery_description', 0),
array(
'Administrators', 'gallery_admin_email', 0),
array(
'Adrese, kas bûs e-kartiòâ pie teksta \'Citi attçli...\'', 'ecards_more_pic_target', 0),
array(
'Valoda', 'lang', 5),
// for postnuke change
array(
'Tçma', 'theme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2
// 'Album list view',
'Albumu saraksta skatîjums',
array(
'Galvenâs tabulas platums (pikseïos vai %)', 'main_table_width', 0),
array(
'Cik lîmeòos sadaïas atspoguïot', 'subcat_level', 0),
array(
'Cik albumus atspoguïot', 'albums_per_page', 0),
array(
'Cik kolonnâs atspoguïot albûmus', 'album_list_cols', 0),
array(
'Cik lieli pikseïos bûs mazie attçli', 'alb_list_thumb_size', 0),
array(
'Galvenâs lapas saturs', 'main_page_layout', 0),
array(
'Râdît pirmâ lîmeòa mazos attçlus pa sadaïâm','first_level',1), 
// 'Thumbnail view',
'Mazo attçlu skatîjums',
array(
'Cik kolonnâs râdît mazos attçlus', 'thumbcols', 0),
array(
'Cik rindâs râdît mazos attçlus', 'thumbrows', 0),
array(
'Cik tabulas atspoguïot', 'max_tabs', 0),
array(
'Blakus mazajam attçlam atspoguïot ne tikai attçla virsrakstu, bet arî aprakstu', 'caption_in_thumbview', 1),
array(
'Atspoguïot komentâru skaitu', 'display_comment_count', 1),
array(
'Kâ kârtot attçlus', 'default_sort_order', 3),
array(
'Minimâlais balsu skaits, lai attçls tiktu iekïauts vispopulârâko sarakstâ', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
//'Image view &amp; Comment settings',
'Attçlu skatîðanâs &amp; Komentâri',
array(
'Attçla tabulas platums (pikseïos vai %)', 'picture_table_width', 0),
array(
'Attçla informâcija redzama pçc noklusçðanas', 'display_pic_info', 1),
array(
'Filtrçt sliktus vârdus komentâros', 'filter_bad_words', 1),
array(
'Atïaut sejiòas komentâros', 'enable_smilies', 1),
array(
'Max attçla apraksta garums', 'max_img_desc_length', 0),
array(
'Max simbolu skaits vienâ vârdâ', 'max_com_wlength', 0),
array(
'Max rindu skaits komentârâ', 'max_com_lines', 0),
array(
'Max komentâra garums', 'max_com_size', 0),
array(
'Filmas skatîjums', 'display_film_strip', 1), 
array(
'Attçlu skaits filmas skatîjumâ', 'max_film_strip_items', 0), 
array(
'Number of items in film strip', 'max_film_strip_items', 0),
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',

'Lielo un mazo attçlu kvalitâte',
array(
'JPEG failu kvalitâte', 'jpeg_qual', 0),
array(
'Max mazâ attçla platums vai augstums <strong>*</strong>', 'thumb_width', 0),
array(
'Izmantojamie izmçri ( platums vai augstums )<strong>*</strong>', 'thumb_use', 7), 
array(
'Izveidot arî \'starpattçlus\'','make_intermediate',1),
array(
'Max \'starpattçla\' platums vai augstums <strong>*</strong>', 'picture_width', 0),
array(
'Max uzliktâ attçla lielums (KB)', 'max_upl_size', 0),
array(
'Max uzliktâ attçla platums vai augstums (pikseïos)', 'max_upl_width_height', 0),
//'User settings',
'Lietotâju uzstâdîjumi',
array(
'Atïaut jaunu lietotâju piereìistrçðanos', 'allow_user_registration', 1),
array(
'Lietotâja sekmîgai reìistrâcija nepiecieðams e-pasta apstiprinâjums', 'reg_requires_valid_email', 1),
array(
'Atïaut diviem daþâdiem lietotâjiem izmantot vienâdas e-pasta adreses', 'allow_duplicate_emails_addr', 1),
array(
'Lietotâjs drîkst veidot personîgus albûmus', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

    'Rezerves lauki attçla aprakstam (ja neizmanto, atstâj tukðus)',
array(
'Lauka 1 nosaukums', 'user_field1_name', 0),
array(
'Lauka 2 nosaukums', 'user_field2_name', 0),
array(
'Lauka 3 nosaukums', 'user_field3_name', 0),
array(
'Lauka 4 nosaukums', 'user_field4_name', 0),
//'Pictures and thumbnails advanced settings',
'Lielo un mazo attçlu îpaðie uzstâdîjumi',
array(
'Râdît personîgâ albuma ikonu anonîmajiem apmeklçtâjiem','show_private',1), 
array(
'Kâdi simboli aizliegti failu nosaukumos', 'forbiden_fname_char',0),
array(
'Uzliekamo attçlu atïautie failu paplaðinâjumi', 'allowed_file_extensions',0),
array(
'Attçlu izmçru mainîðanas metodes','thumb_method',2),
array(
'Ceïð uz ImageMagick / netpbm \'convert\' utilîtu (piemçram, /usr/bin/X11/)', 'impath', 0),
array(
'Atïauti attçlu formâti (tikai priekð ImageMagick)', 'allowed_img_types',0),
array(
'Komandrindas parametri ImageMagick utilîtai', 'im_options', 0),
array(
'Izmantot JPEG attçlu EXIF informâciju', 'read_exif_data', 1),
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'Albumu direktorija <strong>*</strong>', 'fullpath', 0),
array(
'Lietotâju albumu direktorija <strong>*</strong>', 'userpics', 0),
array(
'Starpattçlu prefikss <strong>*</strong>', 'normal_pfx', 0),
array(
'Mazo attçlu prefikss <strong>*</strong>', 'thumb_pfx', 0),
array(
'Direktoriju skatîjuma reþîms pçc noklusçðanas', 'default_dir_mode', 0),
array(
'Attçlu reþîms', 'default_file_mode', 0),
'Cepumi (cookies) &amp; Kodçjums',
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
array(
'Cookie nosaukumus', 'cookie_name', 0),
array(
'Cookie ceïð', 'cookie_path', 0),
array(
'Teksta kodçjums', 'charset', 4),

    'Citi uzstâdîjumi',
array(
'Debug reþîms', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2

    '<br /><div align="center">(*) Ar * atzîmçtos parametrus nav ieteicams mainît, ja galerîjâs jau ir attçli</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'Ja nebûs vârds un komentâra teksts, nekas nesanâks',
    'com_added' => 'Komentârs pievienots',
    'alb_need_title' => 'Kâds ir albuma virsraksts (nosaukums)?',
    'no_udp_needed' => 'Izmaiòas nav nepiecieðamas.',
    'alb_updated' => 'Albumâ veiksmîgi veiktas izmaiòas',
    'unknown_album' => 'Izvçlçtais albums neeksistç vai arî nav tiesîbu tajâ pievienot attçlus',
    'no_pic_uploaded' => 'Attçls netika uzlikts!<br /><br />Vai uz servera ir uzlikta atïauja ðâdâm operâcijâm?',
    'err_mkdir' => 'Direktorija %s NEtika izveidota!',
    'dest_dir_ro' => 'Nav tiesîbu veikt ierakstu direktrijâ %s!',
    'err_move' => 'Nav iespçjams pârvietot %s uz %s !',
    'err_fsize_too_large' => 'Uzliekamâ attçla izmçrs pârsniedz max atïauto (max atïautais ir %s x %s) !',
    'err_imgsize_too_large' => 'Uzliekamâ attçla faila izmçrs pârsniedz max atïauto (max atïautais ir %s KB) !',
    'err_invalid_img' => 'Uzliekamais fails nav klasificçjams kâ attçls!',
    'allowed_img_types' => 'Tu drîksti uzlikt %s attçlus.',
    'err_insert_pic' => 'Attçls \'%s\' nevar tikt pievienots ',
    'upload_success' => 'Attçls veiksmîgi uzlikts<br /><br />Tas bûs redzams galerijâ, tiklîdz Administrators to bûs akceptçjis.',
    'info' => 'Informâcija',
    'com_added' => 'Komentârs pievienots',
    'alb_updated' => 'Albums modificçts',
    'err_comment_empty' => 'Nav komentâra!',
    'err_invalid_fext' => 'Atïauti faili ar ðâdiem paplaðinâjumiem : <br /><br />%s.',
    'no_flood' => 'Atvaino, bet tieði tu arî esi pçdçjâ iesûtîtâ komentâra autors.<br /><br />Modificç sava pçdçjâ iesûtîtâ komentâra tekstu',
    'redirect_msg' => 'Notiek pâradresâcija.<br /><br /><br />Spied uz \'TURPINÂT\', ja lapa nepârlâdçjas',
    'upl_success' => 'Attçls veiksmîgi pievienots',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'Teksts',
    'fs_pic' => 'pilnâ izmçra attçls',
    'del_success' => 'veiksmîgi izdzçsts',
    'ns_pic' => 'normâla izmçra attçls',
    'err_del' => 'nevar tikt izdzçsts',
    'thumb_pic' => 'mazais attçls',
    'comment' => 'komentârs',
    'im_in_alb' => 'attçls albumâ',
    'alb_del_success' => 'Albums \'%s\' izdzçsts',
    'alb_mgr' => 'Albuma menedþeris',
    'err_invalid_data' => 'Saòemta nekorekta informâcija \'%s\'',
    'create_alb' => 'Tiek veidots albums \'%s\'',
    'update_alb' => 'Tiek modificçts albums \'%s\' ar virsrakstu \'%s\' un indeksu \'%s\'',
    'del_pic' => 'Dzçst attçlu',
    'del_alb' => 'Dzçst albumu',
    'del_user' => 'Dzçst lietotâju',
    'err_unknown_user' => 'Izvçlçtais lietotâjs neeksistç!',
    'comment_deleted' => 'Komentârs veiksmîgi izdzçsts',
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
    'confirm_del' => 'Tieðâm DZÇST ðo attçlu? \\nArî komentâri tiks izdzçsti.',
    'del_pic' => 'IZDZÇST ÐO ATTÇLU',
    'size' => '%s x %s px',
    'views' => '%s reizes',
    'slideshow' => 'Slaidðovs',
    'stop_slideshow' => 'APSTÂDINÂT SLAIDÐOVU',
    'view_fs' => 'Uzspied, lai redzçtu pilna izmçra attçlu',
);

$lang_picinfo = array(
    'title' =>'Informâcija par attçlu',
    'Filename' => 'Attçls',
    'Album name' => 'Albums',
    'Rating' => 'Vçrtçjums (%s balsis)',
    'Keywords' => 'Atslçgas vârdi',
    'File Size' => 'Faila lielums',
    'Dimensions' => 'Izmçrs',
    'Displayed' => 'Attçlots',
    'Camera' => 'Kamera',
    'Date taken' => 'Uzòemðanas datums',
    'Aperture' => 'Objektîva diametrs',
    'Exposure time' => 'Ekspozîcijas laiks',
    'Focal length' => 'Fokuss',
    'Comment' => 'Komentâri',
    'addFav'=>'Uz favorîtiem', 

'addFavPhrase'=>'Favorîti', 

'remFav'=>'Dzçst no favorîtiem', 

);

$lang_display_comments = array(
    'OK' => 'OK',
    'edit_title' => 'Modificçt komentâru',
    'confirm_delete' => 'Tieðâm DZÇST ðo komentâru?',
    'add_your_comment' => 'Pievienot komentâru',
    'name'=>'Vârds', 

'comment'=>'Komentârs', 

'your_name' => 'Anonîms', 

);

$lang_fullsize_popup = array(
    'click_to_close' => 'Uzklikðíini uz attçla, lai aizvçrtu ðo logu', 

);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
    'title' => 'Nosûtît e-kartiòu',
    'invalid_email' => '<strong>UZMANÎBU</strong> : kïûdaina adrese!',
    'ecard_title' => 'Sveiciens no %s',
    'view_ecard' => 'Ðo sveicienu var redzçt arî sekojoða adresç',
    'view_more_pics' => 'Citi forði attçli...',
    'send_success' => 'E-kartiòa nosûtîta',
    'send_failed' => 'Atvaino, serveris nevar nosûtît tavu E-kartiòu...',
    'from' => 'No kâ',
    'your_name' => 'Vârds',
    'your_email' => 'E-pasta adrese',
    'to' => 'Kam',
    'rcpt_name' => 'Saòemçja vârds',
    'rcpt_email' => 'Saòçmçja e-pasta adrese',
    'greetings' => 'Sveiciens',
    'message' => 'Pilnais teksts',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'Attçla&nbsp;dati',
    'album' => 'Albums',
    'title' => 'Virsraksts',
    'desc' => 'Apraksts',
    'keywords' => 'Atslçgas vârdi',
    'pic_info_str' => '%sx%s - %sKB - %s skatîjumi - %s balsis',
    'approve' => 'Apstiprinât attçla pievienoðanu',
    'postpone_app' => 'Noraidît attçla pievienoðanu',
    'del_pic' => 'Dzçst attçlu',
    'reset_view_count' => 'Nodzçst skatîjumi skaitîtâju',
    'reset_votes' => 'Nodzçst balsojumu skaitu',
    'del_comm' => 'Dzçst komentârus',
    'upl_approval' => 'Uzlikðanas apstiprinâjums',
    'edit_pics' => 'Modificçt attçlus',
    'see_next' => 'Iepriekðçjie attçli',
    'see_prev' => 'Nâkamie attçli',
    'n_pic' => '%s attçli',
    'n_of_pic_to_disp' => 'Cik attçlus atspoguïot',
    'apply' => 'Apstiprinât izmaiòas'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'Grupa',
    'disk_quota' => 'Kvota (atmiòas ierobeþojumi)',
    'can_rate' => 'Drîkst vçrtçt attçlus',
    'can_send_ecards' => 'Drîkst sûtît e-kartiòas',
    'can_post_com' => 'Drîkst komentçt',
    'can_upload' => 'Drîkst likt attçlus',
    'can_have_gallery' => 'Drîkst bût personîga galerija',
    'apply' => 'Apstiprinât izmaiòas',
    'create_new_group' => 'Izveidot jaunu grupu',
    'del_groups' => 'Dzçst grupu(-as)',
    'confirm_del' => 'Uzmanîbu! Dzçðot grupu, visi tai piederîgie lietotâji tiks pârvietoti uz reìistrçto lietotâju grupu!\n\nTurpinât?',
    'title' => 'Administrçt lietotâju grupas',
    'approval_1' => 'Publisks uzlikðanas apstiprinâjums (1)',
    'approval_2' => 'Privâts uzlikðanas apstiprinâjums (2)',
    'note1' => '<strong>(1)</strong> Attçlu uzlikðanai publiskâ albûmâ ir nepiecieðama administratora atïauja',
    'note2' => '<strong>(2)</strong> Attçlu pievienoðanai albumâ, kas pieder ðim lietotâjam, nepiecieðama administratora atïauja',
    'notes' => 'Piezîmes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
    'welcome' => 'Laipni lûdzam!'
);

$lang_album_admin_menu = array(
    'confirm_delete' => 'Tieðâm DZÇST ðo albumu? \\nVisi attçli un komentâri tajâ tiks izdzçsti.',
    'delete' => 'IZDZÇST',
    'modify' => 'UZSTÂDÎJUMI',
    'edit_pics' => 'MODIFICÇT ATTÇLUS',
);

$lang_list_categories = array(
    'home' => 'Galvenâ lapa',
    'stat1' => 'attçli: <strong>[pictures]</strong> | albumi: <strong>[albums]</strong> | sadaïas: <strong>[cat]</strong> | komentâri: <strong>[comments]</strong> | <strong>skatîts [views]</strong> reizes',
    'stat2' => 'attçli: <strong>[pictures]</strong> | albumi: <strong>[albums]</strong> | skatîti <strong>[views]</strong> reizes',
    'xx_s_gallery' => 'Autors %s',
    'stat3' => '<strong>[pictures]</strong> attçli | <strong>[albums]</strong> albumi | <strong>[comments]</strong> komentâri | skatîti <strong>[views]</strong> reizes'
);

$lang_list_users = array(
    'user_list' => 'Lietotâju saraksts',
    'no_user_gal' => 'Nav lietotâju galerijas',
    'n_albums' => 'albumi: <strong>%s</strong>',
    'n_pics' => 'attçli: <strong>%s</strong>'
);

$lang_list_albums = array(
    'n_pictures' => '<strong>%s</strong> attçli',
    'last_added' => ', pçdçjais pievienots <strong>%s</strong>'
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
    'upd_alb_n' => 'Modificçt albumu %s',
    'general_settings' => 'Galvenie uzstâdîjumi',
    'alb_title' => 'Albuma virsraksts',
    'alb_cat' => 'Sadaïa',
    'alb_desc' => 'Albuma apraksts',
    'alb_thumb' => 'Albuma mazais attçls',
    'alb_perm' => 'Albuma lietotâju tiesîbas',
    'can_view' => 'Albumu var skatîties',
    'can_upload' => 'Apmeklçtâjie drîkst pievienot attçlus',
    'can_post_comments' => 'Apmeklçtâji drîkst komentçt',
    'can_rate' => 'Apmeklçtâji drîkst vçrtçt attçlus',
    'user_gal' => 'Lietotâja galerija',
    'no_cat' => '* Kategorijas nav *',
    'alb_empty' => 'Albums ir tukðs',
    'last_uploaded' => 'Pçdejoreiz uzlikts attçls',
    'public_alb' => 'Ikviens (publiskais albums)',
    'me_only' => 'Tikai es',
    'owner_only' => 'Tikai albuma îpaðnieks (%s)',
    'groupp_only' => 'Tikai \'%s\' grupâ esoðie',
    'err_no_alb_to_modify' => 'Tev nav tiesîbu modificçt albumus.',
    'update' => 'Saglabât izmaiòas'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'Atvaino, bet tu jau esi iesniedzis savu vçrtçjumu',
    'rate_ok' => 'Vçrtçjums pieòemts',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Ar ðo Tu apòemies neievietot citus aizskaroðus, piedauzîgus, vulgârus, apmelojoðus, pretîgus, draudoðus, seksuâli orientçtus, vai jebkâdus citus materiâlus, kas pârkâpj jebkâdus likumus. Likumu nezinâðana neatbrîvo no atbildîbas!!! Tu piekrîti, ka ðîs lapas webmasters, administrators un moderators ir tiesîgi izdzçst vai mainît saturu jebkurâ laikâ, kad vien vçlâs. Kâ lietotâjs Tu piekrîti, ka visa informâcija ko Tu ievadîsi tiks saglabâta datubâzç. Webmasters un administrators nav atbildîgi par jebkâdu tavas informâcijas uzlauðanu vai izmainîðanu.<br />
<br />
Ðî lapa izmanto 'cookies', lai saglabâtu informâciju tavâ datorâ. 'Cookies' vienîgi uzlabo lapas parâdîðanas kvalitâti. E-pasta adrese tiek izmantota vienîgi Tavas reìistrâcijas apstiprinâðanai, lai nosûtîtu paroli.<br />
<br />
Izvçloties zemâk 'Es piekrîtu' Tu piekrîti visam iepriekð rakstîtajam.
EOT;

$lang_register_php = array(
    'page_title' => 'Lietotâja reìistrâcija',
    'term_cond' => 'Vienoðanâs nosacîjumi',
    'i_agree' => 'Es piekrîtu',
    'submit' => 'Apstiprinât reìistrâciju',
    'err_user_exists' => 'Ðis lietotâja vârds jau ir reìistrçts, izvçlies citu',
    'err_password_mismatch' => 'Paroles nesakrît, raksti vçlreiz',
    'err_uname_short' => 'Lietotâja vârda minimâlais simbolu skaits ir 2',
    'err_password_short' => 'Parolç jâbût ne mazâk kâ 2 simboliem',
    'err_uname_pass_diff' => 'Lietotâja vârds un parole nedrîkst bût vienâdi',
    'err_invalid_email' => 'E-pasta adres ir nepareiza',
    'err_duplicate_email' => 'Ðâda email adrese jau ir datu bâzç',
    'enter_info' => 'Reìistrâcijas informâcija',
    'required_info' => 'Nepiecieðamâ informâcija',
    'optional_info' => 'Neobligâtâ informâcija',
    'username' => 'Lietotâja vârds',
    'password' => 'Parole',
    'password_again' => 'Vçlreiz parole',
    'email' => 'E-pasts',
    'location' => 'Atraðanâs vieta',
    'interests' => 'Intereses',
    'website' => 'Mâjas lapa',
    'occupation' => 'Nodarboðanâs',
    'error' => 'KÏÛDA',
    'confirm_email_subject' => '%s - Reìistrâcijas apstiprinâjums',
    'information' => 'Informâcija',
    'failed_sending_email' => 'Nevar tikt nosûtîta reìistrâcijas apstiprinâjuma vçstule!',
    'thank_you' => 'Paldies par reìistrçðanos.<br /><br />Vçstule ar sîkâku informâciju, kâ pabeigt reìistrçðanâs procesu, tika nosûtîta uz iepriekð minçto adresi.',
    'acct_created' => 'Konts izveidots un tu vari pieslçgties ar savu lietotâja vârdu un paroli',
    'acct_active' => 'Konts ir aktîvs un tu tagad vari pieslçgties sistçmai',
    'acct_already_act' => 'Konts jau ir aktîvs!',
    'acct_act_failed' => 'Ðis konts nevar tikt aktivizçts!',
    'err_unk_user' => 'Izvçlçtais lietotâjs neeksistç!',
    'x_s_profile' => '%s : profails',
    'group' => 'Grupa',
    'reg_date' => 'Pievienojies',
    'disk_usage' => 'Diska izmantoðana',
    'change_pass' => 'Nomainît paroli',
    'current_pass' => 'Paðreizçjâ parole',
    'new_pass' => 'Jauna parole',
    'new_pass_again' => 'Vçlreiz jaunâ parole',
    'err_curr_pass' => 'Paðreizçjâ parole nepareiza',
    'apply_modif' => 'Apstiprinât izmaiòas',
    'change_pass' => 'Nomainît paroli',
    'update_success' => 'Profails izmainîts',
    'pass_chg_success' => 'Parole nomainîta',
    'pass_chg_error' => 'Parole netika nomainîta',
);

$lang_register_confirm_email = <<<EOT
Paldies par reìistrçðanos {SITE_NAME}

Lietotâja vârds : "{USER_NAME}"
Lietotâja parole : "{PASSWORD}"

Lai aktivizçtu savu kontu, nepiecieðams ielâdçt zemâk redzamo lapu.

{ACT_LINK}

Lai veicas,

{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'Apskatîties komentârus',
    'no_comment' => 'Komentâru nav',
    'n_comm_del' => '%s komentâri izdzçsti',
    'n_comm_disp' => 'Cik komentârus atspoguïot',
    'see_prev' => 'Iepriekðçjie',
    'see_next' => 'Nâkamie',
    'del_comm' => 'Dzçst izvçlçtos komentârus',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
    0 => 'Meklçt attçlu kolekcijâ',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'Meklçt jaunus attçlus',
    'select_dir' => 'Izvçlçties direktoriju',
    'select_dir_msg' => 'Ðî funkcija ïauj pievienot daudzus attçlus vienlaikus, ja tie iepriekð uzlikti ar FTP.<br /><br />Izvçlies direktoriju, kur tika uzlikti attçli',
    'no_pic_to_add' => 'Nav attçlu, ko varçtu pievienot',
    'need_one_album' => 'Lai izmantotu ðo funkciju, nepiecieðams vismaz viens albums',
    'warning' => 'Uzmanîbu',
    'change_perm' => 'nav pieeja direktorijai, tai jâizmaina tiesîbas (chmod) no 755 uz 777, lai varçtu pievienot attçlus!',
    'target_album' => '<strong>Ievietot attçlus &quot;</strong>%s<strong>&quot; </strong>%s',
    'folder' => 'Direktorija',
    'image' => 'Attçls',
    'album' => 'Albums',
    'result' => 'Rezultâti',
    'dir_ro' => 'Nav rakstîðanas tiesîbu. ',
    'dir_cant_read' => 'Nav lasîðanas tiesîbu. ',
    'insert' => 'Jaunu attçlu pievienoðana',
    'list_new_pic' => 'Jauno attçlu saraksts',
    'insert_selected' => 'Pievienot izvçlçtos attçlus',
    'no_pic_found' => 'Jauni attçli netika atrasti',
    'be_patient' => 'Lûdzu esiet pacietîgi, kamçr tiek pievienoti jaunie attçli',
    'notes' =>  '<ul>'.
            '<li><strong>OK</strong> : attçls veiksmîgi pievienots'.
            '<li><strong>DP</strong> : nozîmç, ka tâds attçls jau ir datu bâzç'.
            '<li><strong>PB</strong> : attçlu nevar pievienot, jâpârbauda pieejas tiesîbas'.
            '<li>Ja OK, DP, PB \'zîmes\' neparâdâs, jâklikðíina uz attçla, kas parâdâs, lai iegûtu detalizçtâku kïûdas aprakstu'.
            '<li>Ja pârlûkâ parâdâs paziòojums par taimautu, lapa ir jâpârlâdç'.
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
    'title' => 'Uzlikt attçlu',
    'max_fsize' => 'Max pievienojamâ faila lielums %s KB',
    'album' => 'Albums',
    'picture' => 'Attçls',
    'pic_title' => 'Attçla virsraksts',
    'description' => 'Attçla apraksts',
    'keywords' => 'Atslçgas vârdi (atdalît ar atstarpçm)',
    'err_no_alb_uploadables' => 'Atvaino, nav neviena albuma, kurâ tu varçtu ievietot savus attçlus',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'Administrçt lietotâjus',
    'name_a' => 'Vârds augoði',
    'name_d' => 'Vârds dilstoði',
    'group_a' => 'Grupa augoði',
    'group_d' => 'Grupa dilstoði',
    'reg_a' => 'Reg datums augoði',
    'reg_d' => 'Reg datums dilstoði',
    'pic_a' => 'Attçlu skaits augoði',
    'pic_d' => 'Attçlu skaits dilstoði',
    'disku_a' => 'Diska atmiòa augoði',
    'disku_d' => 'Diska atmiòa dilstoði',
    'sort_by' => 'Kârtot',
    'err_no_users' => 'Lietotâju tabulâ nav datu!',
    'err_edit_self' => 'Nemaini te savu profailu, tam izmanto \'Mans profails\'',
    'edit' => 'MODIFICÇT',
    'delete' => 'DZÇST',
    'name' => 'Lietotâjs',
    'group' => 'Grupa',
    'inactive' => 'Neaktîvs',
    'operations' => 'Darbîbas',
    'pictures' => 'Attçli',
    'disk_space' => 'Izmantotâ atmiòa / Ierobeþojums',
    'registered_on' => 'Reìistrçts',
    'u_user_on_p_pages' => '%d lietotâji %d lapâ(s)',
    'confirm_del' => 'Tieðâm DZÇST ðo lietotâju? \\nVisi viòa attçli un komentâri arî tiks izdzçsti',
    'mail' => 'MAIL',
    'err_unknown_user' => 'Izvçlçtais lietotâjs neeksistç!',
    'modify_user' => 'Mainît datus',
    'notes' => 'Piezîmes',
    'note_list' => '<li>Ja nevçlies mainît paroli, atstâj paroles lauku tukðu',
    'password' => 'Parole',
    'user_active' => 'Lietotâjs aktîvs',
    'user_group' => 'Grupa',
    'user_email' => 'Emails',
    'user_web_site' => 'Mâjas lapa',
    'create_new_user' => 'Izveidot',
    'user_location' => 'Atraðanâs',
    'user_interests' => 'Intereses',
    'user_occupation' => 'Nodarboðanâs',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
    'title' => 'Attçlu zimçri', 

'what_it_does' => 'Funkcijas', 

'what_update_titles' => 'Virsraksti tiek òemti no failu nosaukumiem', 

'what_delete_title' => 'Dzçst virsrakstus', 

'what_rebuild' => 'Pârveidot attçlus', 

'what_delete_originals' => 'Dzçst oriìinâlos attçlus un nomainît tos ar samazinâtajiem/palielinâtajiem', 

'file' => 'Fails', 

'title_set_to' => 'virsraksts', 

'submit_form' => 'Apstiprinât', 

'updated_succesfully' => 'Veiksmîgi izmanîts', 

'error_create' => 'Kïûda', 

'continue' => 'Turpinât ar citiem attçliem', 

'main_success' => 'Fails %s tiek izmantots kâ galvenais attçls', 

'error_rename' => 'Kïûda %s pârsaucot par %s', 

'error_not_found' => 'Fails %s nav atrasts', 

'back' => 'Atgriezties', 

'thumbs_wait' => 'Notiek mazo un normâlo attçlu modificçðana, lûdzu uzgaidi...', 

'thumbs_continue_wait' => 'Turpinam modificçt mazos un normâlos attçlus...', 

'titles_wait' => 'Norit sparîga virsrakstu modificçðana, uzgaidi...', 

'delete_wait' => 'Dzçðu virsrakstus, lûdzu uzgaidi...', 

'replace_wait' => 'Dzçðu oriìinâlus, nomainot tos ar modificçtajiem attçliem, lûdzu uzgaidi...', 

'instruction' => 'Ieteikumi', 

'instruction_action' => 'Izvçlies darbîbu', 

'instruction_parameter' => 'Uzliec parametrus', 

'instruction_album' => 'Izvçlies albumu', 

'instruction_press' => 'Nospied %s', 

'update' => 'Modificç mazos un/vai normâlos attçlus', 

'update_what' => 'Kas jâmodificç', 

'update_thumb' => 'Tikai mazos attçlus', 

'update_pic' => 'Tikai modificçtos attçlus', 

'update_both' => 'Gan mazie, gan normâlie attçli', 

'update_number' => 'Cik attçlus var modificçt ar vienu klikðíi', 

'update_option' => '(Ðo parametru samazini, ja ir problçmas ar modificçðanu)', 

'filename_title' => 'Faila nosaukums &rArr; Attçla virsraksts', 

'filename_how' => 'Kâ modificçt attçlu', 

'filename_remove' => 'Dzçst .jpg paplaðinâjumu un _ nomainît ar atstarpi', 

'filename_euro' => 'Konvertçt 2003_11_23_13_20_20.jpg uz 23/11/2003 13:20', 

'filename_us' => 'Konevertçt 2003_11_23_13_20_20.jpg uz 11/23/2003 13:20', 

'filename_time' => 'Konvertçt 2003_11_23_13_20_20.jpg uz 13:20', 

'delete' => 'Attçlu virsrakstu un attçlu dzçðana', 

'delete_title' => 'Dzçst attçlu virsrakstus', 

'delete_original' => 'Dzçst oriìinâlus', 

'delete_replace' => 'Dzçst oriìinâlus aizstâjot tos ar modificçtajiem attçliem', 

'select_album' => 'Izvçlies albumu', 

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