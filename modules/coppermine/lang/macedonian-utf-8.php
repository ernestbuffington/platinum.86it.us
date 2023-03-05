<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.94                //
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
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// to all devs: stop update just before committing this file!
// info about translators and translated language
$lang_translation_info = array( 
'lang_name_english' => 'Macedonian',  //the name of your language in English, e.g. 'Greek' or 'Spanish' 
'lang_name_native' => 'Makedonski', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol' 
'lang_country_code' => 'mk', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es' 
'trans_name'=> 'www.pcinfo.com.mk', //the name of the translator - can be a nickname 
'trans_email' => 'info@pcinfo.com.mk', //translator's email address (optional) 
'trans_website' => 'http://www.pcinfo.com.mk/', //translator's website (optional) 
'trans_date' => '2004-12-07', //the date the translation was created / last modified 
); 

$lang_charset = 'UTF-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('недела', 'понеделник', 'вторник', 'среда', 'Четврток', 'петок', 'сабота');
$lang_month = array('јан', 'феб', 'мар', 'апр', 'мај', 'јун', 'јул', 'авг', 'сеп', 'окт', 'нов', 'дек');

// Some common strings
$lang_yes = 'Да';
$lang_no  = 'Не';
$lang_back = 'Назад';
$lang_continue = 'ПРОДОЛЖИ';
$lang_info = 'ИНФОРМАЦИЈА';
$lang_error = 'Грешка';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'случајна слика',
	'lastup' => 'Последно додадено',
	
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Last updated albums',
	'lastcom' => 'Последни коментари',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Најгледани',
	'toprated' => 'Високо рангирано',
	'lasthits' => 'Последно видено',
	'search' => 'Резултати на пребарувањето',
     'favpics'=> 'Омилени слики', //new in cpg1.2.0
);

$lang_errors = array(
'access_denied' => 'Немаш пристап на оваа страница.',
	'perm_denied' => 'Не ти е дозволено да ја извршиш таа операција.',
	'param_missing' => 'Скриптата е повикана без потребните параметри.',
	'non_exist_ap' => 'Избраниот албум/ слика повеќе не постои !',
	'quota_exceeded' => 'Диск квотата е преполнета<бр /><бр />Имате дозволена квота од [quota]K, вашите слики завземаат [space]K, со доавање на овие слики ја пробивате дозволената квота.',
	'gd_file_type_err' => 'Ако користите ГД сликовна галерија дозволени слики се само ЈПГ и ПНГ.',
	'invalid_image' => 'Слката која ја аплоудиравте е одбиена или ГД галеријата не може да ја обработи',
	'resize_failed' => 'Нема можност да се направи мала сликиЧка.',
	'no_img_to_display' => 'Нема слики за приказ',
	'non_exist_cat' => 'Избраната категорија не постои',
	'orphan_cat' => 'Категоријата не постои, покренете го организаторот на категоријата за да се реши проблемот.',
	'directory_ro' => 'На директориумот \'%s\' не е доделен статусот writable, сликите неможат да бидат избришани',
	'non_exist_comment' => 'Избраниот коментар не постои.',
	'pic_in_invalid_album' => 'Сликата е во непостоечкиот албум (%s)!?',
        'banned' => 'Моментално ви е забрането да го користите овој сајт.',  //new in cpg1.2.0
        'not_with_udb' => 'Оваа функција е непристапна во Coppermine бидејќи е интегрирана со форум софтверот. Друго што и да се обидувате да направите не е подржано во таа конфигурација, или функцијата ќе била задржана од форум софтверот.',  //new in cpg1.2.0
'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array(
	'alb_list_title' => 'Оди на листата на албумот',
	'alb_list_lnk' => 'Листа на албумот',
	'my_gal_title' => 'Оди на мојата листа на галерија',
	'my_gal_lnk' => 'Моја галерија',
	'my_prof_lnk' => 'Мој профил',
	'adm_mode_title' => 'Префрли на админ мод',
	'adm_mode_lnk' => 'Админ мод',
	'usr_mode_title' => 'Префрли на кориснички мод',
	'usr_mode_lnk' => 'Кориснички мод',
	'upload_pic_title' => 'Аплоудирај ја сликата во албумот,',
	'upload_pic_lnk' => 'Аплоудирај слика',
	'register_title' => 'Креирај извештај',
	'register_lnk' => 'Регистрација',
	'login_lnk' => 'Влез',
	'logout_lnk' => 'Излез',
	'lastup_lnk' => 'Последно додадено',
	'lastcom_lnk' => 'Последни коментари',
	'topn_lnk' => 'Најгледани',
	'toprated_lnk' => 'Високо рангирано',
	'search_lnk' => 'Пребарување',
     'fav_lnk' => 'Мои омилени', //new in cpg1.2.0
    );

$lang_gallery_admin_menu = array(	
     'upl_app_lnk' => 'Дозвола за аплоудирање',
	'config_lnk' => 'Конфигурација',
	'albums_lnk' => 'Албуми',
	'categories_lnk' => 'Категории',
	'users_lnk' => 'Корисници',
	'groups_lnk' => 'Групи',
	'comments_lnk' => 'Коментари',
	'searchnew_lnk' => 'Префрлување',
        'util_lnk' => 'Менување на димензии на слики',  //new in cpg1.2.0
        'ban_lnk' => 'Забранети корисници',  //new in cpg1.2.0
    );

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Креирај/пореди ги моите албуми',
	'modifyalb_lnk' => 'Преправи ги моите албуми',
	'my_prof_lnk' => 'Мој профил',
    );

$lang_cat_list = array(
	'category' => 'Категорија',
	'albums' => 'Албуми',
	'pictures' => 'Слики',
    );

$lang_album_list = array(
	'album_on_page' => '%d албум на %d страница'
    );

$lang_thumb_view = array(
    'date' => 'ДАТУМ',
    'name' => 'Име', //new in cpg1.2.0
    'title' => 'Наслов', //new in cpg1.2.0'sort_da' => 'Sort by date ascending',
	'sort_da' => 'Распореди ги новите по дата',
	'sort_dd' => 'Распореди ги старите по дата',
	'sort_na' => 'Распореди ги новите по име',
	'sort_nd' => 'Распореди ги старите по име',
        'sort_ta' => 'Сортирање со внесениот наслов',  //new in cpg1.2.0
        'sort_td' => 'Сортирање со спуштениот наслов',  //new in cpg1.2.0
	'pic_on_page' => '%d слика(и) на %d страница',
	'user_on_page' => '%d корисници на %d страници',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
	'thumb_title' => 'Повраток на сликичките',
	'pic_info_title' => 'Покажи/Сокриј инфо за фотографијата',
	'slideshow_title' => 'Slideshow',
     'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
	'ecard_title' => 'Испрати ја оваа слика како разгледница',
	'ecard_disabled' => 'разгледницата е исклучена',
	'ecard_disabled_msg' => 'Не ти е дозволено да ја испратиш разгледницата',
	'prev_title' => 'Погледнија ја претходната слика',
	'next_title' => 'Погледнија следната слика',
	'pic_pos' => 'СЛИКА(и) %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array(
     'rate_this_pic' => 'Оцени ја оваа слика',
	'no_votes' => '(Уште нема оценка)',
	'rating' => '(Моментални оценки : %s / 5 со %s гласови)',
	'rubbish' => 'Без врска',
	'poor' => 'Онака',
	'fair' => 'Може да помине',
	'good' => 'Добро',
	'excellent' => 'одлиЧно',
	'great' => 'Фантастично',
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
	CRITICAL_ERROR => 'Критична грешка',
	'file' => 'Datoteka: ',
	'line' => 'Linija: ',
    );

$lang_display_thumbnails = array(
	'filename' => 'Име на датотека: ',
	'filesize' => 'Величина: ',
	'dimensions' => 'Димензии: ',
	'date_added' => 'Додадена: '
    );

$lang_get_pic_data = array(
	'n_comments' => '%s коментари',
	'n_views' => '%s прегледи',
	'n_votes' => '(%s гласови)'
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
	'Exclamation' => 'Повик',
	'Question' => 'Прашање',
	'Very Happy' => 'Многу среќен',
	'Smile' => 'Насмевка',
	'Sad' => 'Тажен',
	'Surprised' => 'Изненаден',
	'Shocked' => 'шокиран',
	'Confused' => 'Збунет',
	'Cool' => 'Куул',
	'Laughing' => 'Смеење',
	'Mad' => 'Бесен',
	'Razz' => 'Важен',
	'Embarassed' => 'Посрамотен',
	'Crying or Very sad' => 'Многу тажен',
	'Evil or Very Mad' => 'Лош',
	'Twisted Evil' => 'Ѓавол',
	'Rolling Eyes' => 'Тркалести очи',
	'Wink' => 'Момент',
	'Idea' => 'Идеа',
	'Arrow' => 'Стрелка',
	'Neutral' => 'Неутрален',
	'Mr. Green' => 'Г. Зелен',
);       
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Напуштање на администраторскиот мод ...',
	1 => 'Влез во администраторсиот мод ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Мораш да го впишеш името на албумот !',
	'confirm_modifs' => 'Дали сте сигурни во намерата да направите промени ?',
	'no_change' => 'Не сте направиле никаква промена !',
	'new_album' => 'Нов албум',
	'confirm_delete1' => 'Дали сте сигурни во намерата да го избришите овој албум ?',
	'confirm_delete2' => '\нСите слики и коментари кои се тука ќе бидат избришани !',
	'select_first' => 'Прво изберете албум',
	'alb_mrg' => 'Организација на албумот',
	'my_gallery' => '* Моја галерија *',
	'no_category' => '* Нема категорија *',
	'delete' => 'Избриши',
	'new' => 'Ново',
	'apply_modifs' => 'Направи промени',
	'select_category' => 'Избери категорија',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Потребни параметри за \'%s\'Командата не е извршена !',
	'unknown_cat' => 'Избраната категорија не постои во базата на податоци',
	'usergal_cat_ro' => 'Корисничката категорија неможе да биде избришана !',
	'manage_cat' => 'Организирај ги категориите',
	'confirm_delete' => 'Дали сте сигурни во желбата да ја ИЗБРИШЕТЕ оваа категорија',
	'category' => 'Категорија',
	'operations' => 'Операции',
	'move_into' => 'Помести во',
	'update_create' => 'Освежи/Направи категорија',
	'parent_cat' => 'Основна категорија',
	'cat_title' => 'Име на категорија',
	'cat_desc' => 'Опис на категорија'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Конфигурација',
	'restore_cfg' => 'Врати на основната конфигурација',
	'save_cfg' => 'Сними нова конфигурација',
	'notes' => 'Напомена',
	'info' => 'Информација',
	'upd_success' => 'Конфигурацијата е освежена',
	'restore_success' => 'Основата на конфигурацијата е вратена',
	'name_a' => 'Име на новите',
	'name_d' => 'Име на старите',
        'title_a' => 'Влезен наслов',  //new in cpg1.2.0
        'title_d' => 'Спуштен наслов',  //new in cpg1.2.0
	'date_a' => 'Дата на новите',
	'date_d' => 'Дата на старите',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Макс форма',
        'th_ht' => 'Висина',
        'th_wd' => 'Ширина',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
	'Основно подесување',
	array('Име на галерија', 'gallery_name', 0),
	array('Опис на галерија', 'gallery_description', 0),
	array('Емаил на администраторот на галеријата', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
	array('Јазик', 'lang', 5),
	// for postnuke change
        array('Тема', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Album list view',
	array('Ширина на главната табела (пиксели или %)', 'main_table_width', 0),
	array('Број на нивоа на категории за прикажување', 'subcat_level', 0),
	array('Број албуми за прикажување', 'albums_per_page', 0),
	array('Број колони за листата на албумот', 'album_list_cols', 0),
	array('Големина на сликишките во пиксели', 'alb_list_thumb_size', 0),
	array('Содржина на насловната страница', 'main_page_layout', 0),
        array('Покажи го првото ниво на албум сликишките во категории','first_level',1),  //new in cpg1.2.0
        // 'Thumbnail view',
        'Thumbnail view',
	array('Број на колони на страната на сликичката', 'thumbcols', 0),
	array('Број на редови на страната на сликичката', 'thumbrows', 0),
	array('Максимален број на табови за прикажување', 'max_tabs', 0),
	array('Прикажување на сликата како наслов за статија (во едицијата на наслови) доле на сликичката', 'caption_in_thumbview', 1),
	array('Приказ на бројот на коментари долу на сликичката', 'display_comment_count', 1),
	array('Дефинирај по вид ред на сликите', 'default_sort_order', 3),
	array('Минимум број на гласови на слики преставени во \'top-rated\' list', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Image view &amp; Comment settings',
        array(
		'Ширина на табела за прикажување на сликите(пиксели или %)', 'picture_table_width', 0),

	array(
		'Информација на сликата се пристапни по дефиниција', 'display_pic_info', 1),
	array(
		'Филтер за лоши зборови и коментари', 'filter_bad_words', 1),
	array(
		'Горни смајлови во коментари', 'enable_smilies', 1),
	 array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
	array(
		'Максимална должина за опис на имагинацијата', 'max_img_desc_length', 0),
	array(
		'Максимален број на карактери во зборот', 'max_com_wlength', 0),
	array(
		'Максимален број на линии во коментар', 'max_com_lines', 0),
	array(
		'Максимална должина на коментар', 'max_com_size', 0),
        array(
        	'Покажи  филм стрип', 'display_film_strip', 1),  //new in cpg1.2.0
        array(
        	'Број на делови во филм стрип', 'max_film_strip_items', 0), 
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Pictures and thumbnails settings',
	array('Квалитет за ЈПЕГ фајлови', 'jpeg_qual', 0),
        array('Максимална димензија на сликичка <strong>*</strong>', 'thumb_width', 0),  //new in cpg1.2.0
        array('Користена димензија ( ширина или висина или Максимален изглед на сликичка )<strong>*</strong>', 'thumb_use', 7),  //new in cpg1.2.0
	array('креирање на средишни слики','make_intermediate',1),
	array('Максимална ширина или висина на средишна слика <strong>*</strong>', 'picture_width', 0),
	array('Максимална големина за аплоудирани слики (KB)', 'max_upl_size', 0),
	array('Максимална ширина и висина за аплоадирани слики  (пиксели)', 'max_upl_width_height', 0),
       // 'User settings',
        'Користени подесувачи',
        	array('Горе корисник на регистрација', 'allow_user_registration', 1),
	array('Регистрација на корисникот побарува емаил верификација', 'reg_requires_valid_email', 1),
	array('Горе двајца корисници имаат иста емаил адреса', 'allow_duplicate_emails_addr', 1),
	array('Корисниците можат да имаат приватни албуми', 'allow_private_albums', 1),
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Custom fields for image description (leave blank if unused)',
	array('Поле 1 име', 'user_field1_name', 0),
	array('Поле 2 име', 'user_field2_name', 0),
	array('Поле 3 име', 'user_field3_name', 0),
	array('Поле 4 име', 'user_field4_name', 0),
        // 'Pictures and thumbnails advanced settings',
        'Pictures and thumbnails advanced settings',
        array(
            'Show private album Icon to unlogged user', 'show_private', 1),
        array(
            'Characters forbidden in filenames', 'forbiden_fname_char', 0),
        array(
            'Accepted file extensions for uploaded pictures', 'allowed_file_extensions', 0),
        array(
            'Method for resizing images', 'thumb_method', 2),
        array(
            'Path to ImageMagick / netpbm \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
        array(
            'Allowed image types (only valid for ImageMagick)', 'allowed_img_types', 0),
        array(
            'Command line options for ImageMagick', 'im_options', 0),
        array(
            'Read EXIF data in JPEG files', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'The album directory <strong>*</strong>', 'fullpath', 0),
        array(
            'The directory for user pictures <strong>*</strong>', 'userpics', 0),
        array(
            'The prefix for intermediate pictures <strong>*</strong>', 'normal_pfx', 0),
        array(
            'The prefix for thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Default mode for directories', 'default_dir_mode', 0),
        array(
            'Default mode for pictures', 'default_file_mode', 0),
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
            'Name of the cookie used by the script', 'cookie_name', 0),
        array(
            'Path of the cookie used by the script', 'cookie_path', 0),
        array(
            'Character encoding', 'charset', 4), 
        // 'Miscellaneous settings',
        'Miscellaneous settings',
        array(
            'Enable debug mode', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />',
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Потребно е да го впишете своето име и коментар',
	'com_added' => 'Вашиот коментар е додаден',
	'alb_need_title' => 'Морате да го впишете името на албумот !',
	'no_udp_needed' => 'Не е потребно освежување.',
	'alb_updated' => 'Албумот е освежен',
	'unknown_album' => 'Избраниот албум не постои или немате дозвола за аплоадирање во овој албум',
	'no_pic_uploaded' => 'Сликата не е додадена !<br /><br />Ако навистина ја избравте сликата за аплоадирање,тогаш е моментална грешка...',
	'err_mkdir' => 'Не е можно да се направи директориум %s !',
	'dest_dir_ro' => 'Дестинација на директориумот %s Не е впишано во скрипта !',
	'err_move' => 'Не е можно да се придвижи %s u %s !',
	'err_fsize_too_large' => 'Димензијата на сликата која ја аплоадиравте е преголема (максимално дозволена е  %s x %s) !',
	'err_imgsize_too_large' => 'Големината која ја аплоадиравте е преголема (максимално дозволена е %s KB) !',
	'err_invalid_img' => 'Датотеката која ја аплоадирате не е дозволен формат на сликата !',
	'allowed_img_types' => 'Можете да аплоадирате само %s слика(и).',
	'err_insert_pic' => 'слика(и) \'%s\' (не)може да биде уфрлена во албум',
	'upload_success' => 'Вашата слика е аплоадирано успешно<br /><br />Сликата ќе биде видлива после администраторската дозвола.',
	'info' => 'Информација',
	'com_added' => 'Додаден коментар',
	'alb_updated' => 'Освежен албум',
	'err_comment_empty' => 'Вашиот коментар е празен !',
	'err_invalid_fext' => 'Само датотеките со следниве екстензии се прифатливи : <br /><br />%s.',
	'no_flood' => 'Жал ни е вие сте веќе автор на последниот коментар впишан за оваа слика<br /><br />Преправете го коментарот кој го испративте ако сакате да го смените коментарот за сликата',
	'redirect_msg' => 'Ќе бидете автоматски префрлени.<br /><br /><br />Klinki \'CONTINUE\' ако страницата не се освежи автоматски',
	'upl_success' => 'Сликата е успешно доддена',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Име',
	'fs_pic' => 'Цела големина на сликата',
	'del_success' => 'успежно',
	'ns_pic' => 'нормална големина на сликата',
	'err_del' => 'не може да се избрише',
	'thumb_pic' => 'сликичка',
	'comment' => 'коментар',
	'im_in_alb' => 'слика во коментарот',
	'alb_del_success' => 'Албум \'%s\' избришан',
	'alb_mgr' => 'Организатор на албумот',
	'err_invalid_data' => 'Неисправни податоци примени во \'%s\'',
	'create_alb' => 'Креирање на албум\'%s\'',
	'update_alb' => 'Освежување на албум \'%s\' со мало \'%s\' и индекс \'%s\'',
	'del_pic' => 'Избриши слика',
	'del_alb' => 'Избриши албум',
	'del_user' => 'Избриши го корисникот',
	'err_unknown_user' => 'Избраниот корисник не постои !',
	'comment_deleted' => 'Коментарот е успешно избришен',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')) {
$lang_display_image_php = array(
    		'confirm_del' => 'Дали сигурно саката да ја ИЗБРИШЕТЕ оваа слика ? \\н коментари истотака ќе бидат избришани.',
	'del_pic' => 'ИЗБРИШИ ЈА ОВАА СЛИКА',
	'size' => '%s x %s пиксели',
	'views' => '%s пати',
	'slideshow' => 'Слајд шоу',
	'stop_slideshow' => 'Стопирај ГО СЛАЈДШОУТО',
	'view_fs' => 'Кликни за да видиш во целосна големина',
        );
$lang_picinfo = array(
	'title' =>'Информации за сликата',
	'Filename' => 'Име на датотеката',
	'Album name' => 'Име на албумот',
	'Rating' => 'Оценка(%s гласови)',
	'Keywords' => 'Клучни зборови',
	'File Size' => 'Големина на датотеката',
	'Dimensions' => 'Димензии',
	'Displayed' => 'Прикажано',
	'Camera' => 'Камера',
	'Date taken' => 'Дата на земања',
	'Aperture' => 'Отвор',
	'Exposure time' => 'Време на излагање',
	'Focal length' => 'Растојание од центар',
	'Comment' => 'Коментар',
        'addFav' => 'Сместување во Омилени',  //new in cpg1.2.0
        'addFavPhrase' => 'Омилени',  //new in cpg1.2.0
        'remFav'=>'Преместување од омилени',  //new in cpg1.2.0
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

$lang_display_comments = array(
	'OK' => 'Ок',
	'edit_title' => 'Преправи го овој коментар',
	'confirm_delete' => 'Дали сте сигурни во намерата да го избришете овој коментар ?',
	'add_your_comment' => 'Додадете свој коментар',
        'name'=>'Име',  //new in cpg1.2.0
        'comment'=>'Коментар',  //new in cpg1.2.0
	'your_name' => 'Ваше име',
        );
$lang_fullsize_popup = array(
        'click_to_close' => 'Кликни на имаге за да се затвори овој прозорец',  //new in cpg1.2.0
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array(
	'title' => 'Испрати е-кард',
	'invalid_email' => '<strong>Ops</strong> : неисправен емаил адреса!',
	'ecard_title' => 'Разгледница од %s за тебе',
	'view_ecard' => 'Ако разгледницата не е исправно прикажана,кликнете на овој линк',
	'view_more_pics' => 'Кликнете на овој линк за да видите повеќе слики!',
	'send_success' => 'Вашата разгледница е испратена',
	'send_failed' => 'Жал ни е, но серверот не може да ја испрати вашата разгледница ...',
	'from' => 'Од',
	'your_name' => 'Ваше име',
	'your_email' => 'Ваша емаил адреса',
	'to' => 'За',
	'rcpt_name' => 'Имиња на пријатели',
	'rcpt_email' => 'Емаил адреса на примачот',
	'greetings' => 'Наслов',
	'message' => 'Порака',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Слика&nbsp;info',
	'album' => 'Албум',
	'title' => 'Наслов',
	'desc' => 'Опис',
	'keywords' => 'Клучни зборови',
	'pic_info_str' => '%sx%s - %sKB - %s Прегледи - %s гласови',
	'approve' => 'Одобри ја сликата',
	'postpone_app' => 'Одложи го одобрувањето',
	'del_pic' => 'Избриши ја сликата',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
	'reset_view_count' => 'Ресетирај го бројот на прегледи',
	'reset_votes' => 'Ресетирај ги гласовите',
	'del_comm' => 'Избриши ги коментарите',
	'upl_approval' => 'Одобри аплоадирање',
	'edit_pics' => 'Преправи ја сликата',
	'see_next' => 'Погледни ги следните слики',
	'see_prev' => 'Погледни ги претходните слики',
	'n_pic' => '%s Слики',
	'n_of_pic_to_disp' => 'Број на слики за прикажување',
	'apply' => 'Направи промени'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Име на групата',
	'disk_quota' => 'Квота на дискот',
	'can_rate' => 'Може да се оцени сликата',
	'can_send_ecards' => 'Може да се оспрати разгледницата',
	'can_post_com' => 'Може да се коментира',
	'can_upload' => 'Може да се аплоадира сликата',
	'can_have_gallery' => 'Може да се има лична галерија',
	'apply' => 'Направи промени',
	'create_new_group' => 'Креирај нова група',
	'del_groups' => 'Избриши ги избраните групи',
	'confirm_del' => 'Внимание,кога избришеш група, корисници кои припаќаат на групата ќе бидат префрлени во \'Регистрирано\' група!\н\нДали сакаш да продолжиш?',
	'title' => 'Организирај кориснички групи',
        'approval_1' => 'Pub. Upl. approval (1)',
        'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<strong>(1)</strong> За аплоадирање во јавен албум потребна е дозвола од администраторот',
	'note2' => '<strong>(2)</strong> За аплоадирање во албум кој припаќа на корисникот потребна е дозвола од администраторот',
	'notes' => 'Напомена'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array(
	'welcome' => 'Добро дојдовте!'
        );
$lang_album_admin_menu = array(
	'confirm_delete' => 'Дали сте сигурни во намерата да го ИЗБРИШЕТЕ овој албум? \\нСите слики и коментари ќе бидат истотака избришани.',
	'delete' => 'ИСБРИШИ',
	'modify' => 'КАРАКТЕРИСТИКИ',
	'edit_pics' => 'ПОПРАВКА',
);

$lang_list_categories = array(
	'home' => 'ПОЧЕТНА',
	'stat1' => '<strong>[pictures]</strong> слики во <strong>[albums]</strong> албум и <strong>[cat]</strong> категорија со <strong>[comments]</strong> погледнати коментари <strong>[views]</strong> пати',
	'stat2' => '<strong>[pictures]</strong> слка(и) во <strong>[albums]</strong> албуми прегледани <strong>[views]</strong> пати',
	'xx_s_gallery' => '%s\'s Галерија',
	'stat3' => '<strong>[pictures]</strong> слика во <strong>[albums]</strong> албум со <strong>[comments]</strong> коментари прегледани <strong>[views]</strong> пати'
);
$lang_list_users = array(
	'user_list' => 'Листа на корисници',
	'no_user_gal' => 'Нема кориснички галерии',
	'n_albums' => '%s албум(а)',
	'n_pics' => '%s слика(и)'
);

    $lang_list_albums = array(
	'n_pictures' => '%s слика(и)',
	'last_added' => ', последна додадена %s'
);
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Освежи го албумот %s',
	'general_settings' => 'Основно штимање',
	'alb_title' => 'Наслов на албумот',
	'alb_cat' => 'Категорија на албумот',
	'alb_desc' => 'Опис на албумот',
	'alb_thumb' => 'Сликички на албумот',
	'alb_perm' => 'Дозволи за овој албум',
	'can_view' => 'Албумот може да биде видлив',
	'can_upload' => 'Посетителите можат да ја аплоадираат слики',
	'can_post_comments' => 'Посетителите можат да пишуваат коментари',
	'can_rate' => 'Посетителите можат да ги оценуваат сликите',
	'user_gal' => 'Галерија на корисникот',
	'no_cat' => '* Нема категории *',
	'alb_empty' => 'Албумот е празен',
	'last_uploaded' => 'Последно аплоадирано',
	'public_alb' => 'Сите(Јавен албум)',
	'me_only' => 'Само јас',
	'owner_only' => 'Сопственик на албум (%s) само',
	'groupp_only' => 'Членови на\'%s\' група',
	'err_no_alb_to_modify' => 'Во базата на податоци нема албум кој можете да го преправите.',
	'update' => 'Освежи албум'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Жал ни е веќе ја оценивте сликата',
	'rate_ok' => 'Впишан глас',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Za postavljanje vlastitih fotografija u galeriju potrebno je registrovati se. Prilikom registracije obavezno morate upisati vaљu ispravnu, postojeжu email adresu, na koju жe vam biti poslan email sa linkom kojim жete potvrditi vaљu registraciju.<br />
<br />
Slaћem se da neжu postavljati bilo kakve uznemirujuжe, pornografske, vulgarne fotografije kao i fotografije koje potiиu na bilo kakav oblik mrћnje. Slaћem se takoрe da Administrator ovog dijela Administrator ima pravo da izbriљe sve fotografije koje nisu prihvatljive, odnosno nabrojane kategorije fotografija. Slaћem se da Administrator moћe izbrisati svaki moj komentar ukoliko ocijeni da nije prikladan. Kao korisnik ovoe foto galerije slaћem se da svi moji podaci koje upiљem u registracijsku formu budu pohranjeni u bazu podataka. Ukoliko na bilo kakav naиin uznemiravam foto galeriju slaћem se da administator banuje moju IP adresu, odnosno da mi do daljnjeg zabrani pristup ovoim stranicama. I tako dalje, nadamo se da жete poљtovati ova pravila.<br />
<br />
Ova stranica koristi cookies za pohranu podataka na vaљem raиunaru. Email adresa se koristi samo za potvrdu vaљe registracije.<br />
<br />
Klikom na 'Slaћem se' prihvatate uslove koriљtenja i nadamo se da ih neжete prekrљiti.
EOT;

$lang_register_php = array(
	'page_title' => 'Регистрација',
	'term_cond' => 'Правила и услови',
	'i_agree' => 'Се сложувам',
	'submit' => 'Испрати ја регистрацијата',
	'err_user_exists' => 'Избраното корисничко име веќе е регистрирано, пробајте некое друго',
	'err_password_mismatch' => 'Недостигаат две шифри, повторно впишете',
	'err_uname_short' => 'Корисничкото име мора да има најмалку 2 знака',
	'err_password_short' => 'Шифрата мора да има најмалку 2 знака',
	'err_uname_pass_diff' => 'Корисничкото име и шифрата не можат да имаат исто име',
	'err_invalid_email' => 'Неисправна емаил адреса',
	'err_duplicate_email' => 'Веќе е некој регистриран со иста емаил адреса со која се впишавте',
	'enter_info' => 'Впишете ги податоците за регистрација',
	'required_info' => 'Потребни податоци',
	'optional_info' => 'Дополнителни податоци',
	'username' => 'Корисничко име',
	'password' => 'Шифра',
	'password_again' => 'Повторно шифра',
	'email' => 'Емаил',
	'location' => 'Локација',
	'interests' => 'Интереси',
	'website' => 'Веб страница',
	'occupation' => 'Професија',
	'error' => 'ГРЕШКА',
	'confirm_email_subject' => '%s - Потврдете ја регистрацијата',
	'information' => 'Информација',
	'failed_sending_email' => 'Регистрациската конфимација не може да се испрати !',
	'thank_you' => 'Ви благодариме на регистрацијата.<br /><br />Емаил со информации како да активирате ваша корисничка сметка е испратен на емаил адреса која ја впишавте при регистрација.',
	'acct_created' => 'Вашата корисничка сметка е отворена и можете да пристапитена страницата со вашето корисничко име и шифра',
	'acct_active' => 'Вашата корисничка сметка од сега е активна и можете на страницата да пристапите со вашето корисничко име и шифра',
	'acct_already_act' => 'Вашата корисничка сметка е веќе активна!',
	'acct_act_failed' => 'Оваа корисничка сметка не може да биде активна!',
	'err_unk_user' => 'Избраниот корисник не постои!',
	'x_s_profile' => '%s\'s профил',
	'group' => 'Група',
	'reg_date' => 'Регистриран(а)',
	'disk_usage' => 'Искористеност на диск просторот',
	'change_pass' => 'Промени ја шифрата',
	'current_pass' => 'Моментална шифра',
	'new_pass' => 'Нова шифра',
	'new_pass_again' => 'Нова шифра повторно',
	'err_curr_pass' => 'Моменталната шифра не е исправна',
	'apply_modif' => 'Изврши промени',
	'change_pass' => 'Промени ја мојата шифра',
	'update_success' => 'Вашиот профил е освежен',
	'pass_chg_success' => 'Вашата шифра е променета',
	'pass_chg_error' => 'Вашата шифра не е променета',
);

$lang_register_confirm_email = <<<EOT
Hvala na registraciji na {SITE_NAME}

Vaљe korisniиko ime : "{USER_NAME}"
Vaљa љifra : "{PASSWORD}"

Da bi aktivirali vaљ korisniиki raиun potrebno je da kliknete na link ispod ili ako ћelite kopirajte link i nalijepite u vaљ web browser.

{ACT_LINK}

Pozdrav,

Team {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'Прочитајте ги коментарите',
	'no_comment' => 'Нема коментари за читање',
	'n_comm_del' => '%s коментарите се избришани',
	'n_comm_disp' => 'Број коментари за прикажување',
	'see_prev' => 'Погледај претходно',
	'see_next' => 'Погледај ги следните',
	'del_comm' => 'Избриши ги избраните коментари',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'Пребарајте ја колекцијата на слики',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Пребарани нови слики',
	'select_dir' => 'Ибери директориум',
	'select_dir_msg' => 'Оваа функција дозволува да направите пат до сликата која ја имате на својот сервер.<br /><br />Изберете директориум каде ја аплоадиравте својата слика',
	'no_pic_to_add' => 'Нема слики за додавање',
	'need_one_album' => 'Морате да имате најмалку еден албум за да ја користите оваа функција',
	'warning' => 'Предупредување',
	'change_perm' => 'Скриптата не може да се впише во овој директориум, морате да го смените ЦХМОД на 755 ili 777 пред да додадете слики!',
	'target_album' => '<strong>Префрли ја сликата од &quot;</strong>%s<strong>&quot; u </strong>%s',
	'folder' => 'Фолдер',
	'image' => 'Слика',
	'album' => 'Албум',
	'result' => 'Резултат',
	'dir_ro' => 'Не е впишано. ',
	'dir_cant_read' => 'Не е читливо. ',
	'insert' => 'Додавање на нови слики во галерија',
	'list_new_pic' => 'Листа на нови слики',
	'insert_selected' => 'Уфрли ги избраните слики',
	'no_pic_found' => 'Не е пронајдена нова слика',
	'be_patient' => 'Ве молиме бидете трпеливи, на скриптата и треба време да ја додаде сликата',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : znaиi da je slika uspjeљno dodana'.
				'<li><strong>DP</strong> : znaиi da je slika duplikat i da je veж u bazi podataka'.
				'<li><strong>PB</strong> : znaиi da sliku nije moguжe dodati, provjerite vlastitu konfiguraciju i dozvolu direktorija gdje su slike locirane'.
				'<li>Ako OK, DP, PB \'signs\' se ne pojave klikni na puknutu sliku da vidiљ koju je greљku napravio PHP'.
				'<li>Ako je sesija istekla, pritisnite refresh'.
				'</ul>',
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

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Аплоадирај слика',
	'max_fsize' => 'Максимално дозволена големина е %s KB',
	'album' => 'Албум',
	'picture' => 'Слика',
	'pic_title' => 'Наслов на сликата',
	'description' => 'Опис на слики',
	'keywords' => 'Клучни зборови (одвојте празно место)',
	'err_no_alb_uploadables' => 'Жал ни е овде нема албуми каде може да уфрлите слика.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'Организирај ги корисниците',
	'name_a' => 'Име на растечкиот',
	'name_d' => 'Име на опаќачкиот',
	'group_a' => 'Група на растечките',
	'group_d' => 'Група на опаќачките',
	'reg_a' => 'Датум на регистрација на растечките',
	'reg_d' => 'Датум на регистрација на опаќачките',
	'pic_a' => 'Број на растечки слики',
	'pic_d' => 'Број на опаќачки слики',
	'disku_a' => 'Искористеност на растечкиот диск',
	'disku_d' => 'Искористеност на опаќачкиот диск',
	'sort_by' => 'Пореди ги корисниците по',
	'err_no_users' => 'Корисничката табла е празна!',
	'err_edit_self' => 'Не можете да го менувате својот профил, користете \'My profile\' врска за тоа',
	'edit' => 'ПОПРАВИ',
	'delete' => 'ИЗБРИШИ',
	'name' => 'Корисничко име',
	'group' => 'Група',
	'inactive' => 'Неактивно',
	'operations' => 'Операции',
	'pictures' => 'Слики',
	'disk_space' => 'Искористен простор / квота',
	'registered_on' => 'Регистриран',
	'u_user_on_p_pages' => '%d корисници на%d страна',
	'confirm_del' => 'Дали сте сигурни во намерата да го ИЗБРИШЕТЕ корисникот? \\нСите негови слики и албуми ќе бидат избришани.',
	'mail' => 'МАИЛ',
	'err_unknown_user' => 'Одбраниот корисник не постои!',
	'modify_user' => 'Модифицирај ги корисниците',
	'notes' => 'Забелешка',
	'note_list' => '<li>Ако не сакате да ја промените моменталната шифра,оставете го полето за "шифра" празно',
	'password' => 'Шифра',
	'user_active' => 'Корисникот е активен',
	'user_group' => 'Група',
	'user_email' => 'Емаил',
	'user_web_site' => 'Веб страница',
	'create_new_user' => 'Креирај нов корисник',
        'user_from' => 'Локација', // different var in cpg1.2.0nuke
        'user_interests' => 'Интереси',
        'user_occ' => 'Професија', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'Промени ја големината на сликите', 
        'what_it_does' => 'Што е ова', 
        'what_update_titles' => 'Ажурирај ги насловите од фајл имињата', 
        'what_delete_title' => 'Избриши наслови', 
        'what_rebuild' => 'Повторно направи ги сликичките и променија големината на фотографиите', 
        'what_delete_originals' => 'Избриши ги оригиналните големини на фотографиите премести ги со верзираната големина', 
        'file' => 'Фајл', 
        'title_set_to' => 'смести го насловот', 
        'submit_form' => 'поднаслов', 
        'updated_succesfully' => 'ажурирај успешно', 
        'error_create' => 'Креирана е грешка', 
        'continue' => 'Создади повеќе имагинации', 
        'main_success' => 'Фајлот %s беше успешно искористен како главна слика', 
        'error_rename' => 'Грешка во именувањето %s во %s', 
        'error_not_found' => 'Фајлот %s не беше најден', 
        'back' => 'назад на главното', 
        'thumbs_wait' => 'Ажурирање сликички и/или менување на големината на имагинациите, ве молиме причекајте ...', 
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
        'titles_wait' => 'Ажурирање на наслови, ве молиме причекајте...', 
        'delete_wait' => 'Бришење на наслови, ве молиме почекајте...', 
        'replace_wait' => 'Бришење на оригинали и преместување на истите со менување на големината на имагинациите, ве молиме почекајте..', 
        'instruction' => 'Брзи инструкции', 
        'instruction_action' => 'Селектирана акција', 
        'instruction_parameter' => 'Смести параметри', 
        'instruction_album' => 'Селектирај албум', 
        'instruction_press' => 'Притисни %s', 
        'update' => 'Ажурирај ја сликичката и/или променија големината на фотографиите', 
        'update_what' => 'Што ќе било ажурирано', 
        'update_thumb' => 'Само сликички', 
        'update_pic' => 'Само изменетите слики', 
        'update_both' => 'И сликички и изменети слики', 
        'update_number' => 'Број на процесирани имагинации со кликнување', 
        'update_option' => '(Обиди се да ја подесиш оваа опција подолу доколку има проблеми со времето)', 
        'filename_title' => 'Име на фајл ? Наслов на слика', 
        'filename_how' => 'Колку би можело да се модифицира името на фајлот', 
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces',
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20',
        'delete' => 'Избриши го насловот на сликата или оригиналната големина на фотографијата', 
        'delete_title' => 'Избриши го насловот на сликата', 
        'delete_original' => 'Избриши ја оригиналната големина на фотографијата', 
        'delete_replace' => 'Избриши оригинални имагинации и премести ги нив со верзираната големина', 
        'select_album' => 'Селектирај албум', 
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