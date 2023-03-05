ï»¿<?php 
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
// to all devs: stop update just before committing this file!
// info about translators and translated language
define('PIC_VIEWS', 'láº§n xem');
define('PIC_VOTES', 'láº§n Ä‘Ã¡nh giÃ¡)');
define('PIC_COMMENTS', 'nháº­n xÃ©t');

$lang_translation_info = array(
    'lang_name_english' => 'VietNamese', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'tiáº¿ng Viá»‡t', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'vn', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Há»¯u Tá»«', // the name of the translator - can be a nickname
    'trans_email' => 'cutu9@yahoo.com', // translator's email address (optional)
    'trans_website' => 'http://www.u2u.us', // translator's website (optional)
    'trans_date' => '2003-10-30', // the date the translation was created / last modified
    );

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Chá»§ nháº­t', 'Thá»© 2', 'Thá»© 3', 'Thá»© 4', 'Thá»© 5', 'Thá»© 6', 'Thá»© 7');
$lang_month = array('ThÃ¡ng 1', 'ThÃ¡ng 2', 'ThÃ¡ng 3', 'ThÃ¡ng 4', 'ThÃ¡ng 5', 'ThÃ¡ng 6', 'ThÃ¡ng 7', 'ThÃ¡ng 8', 'ThÃ¡ng 9', 'ThÃ¡ng 10', 'ThÃ¡ng 11', 'ThÃ¡ng 12');
// Some common strings
$lang_yes = 'CÃ³';
$lang_no = 'KhÃ´ng';
$lang_back = 'TRá»ž Láº I';
$lang_continue = 'TIáº¾P Tá»¤C';
$lang_info = 'ThÃ´ng tin';
$lang_error = 'Lá»—i';
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

$lang_meta_album_names = array('random' => 'HÃ¬nh ngáº«u nhiÃªn',
    'lastup' => 'HÃ¬nh má»›i thÃªm vÃ o',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Album vá»«a cáº­p nháº­t',

    'lastcom' => 'Nháº­n xÃ©t cuá»‘i',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Xem nhiá»u',
    'toprated' => 'ÄÃ¡nh giÃ¡ cao',
    'lasthits' => 'Xem láº§n cuá»‘i',
    'search' => 'Káº¿t quáº£ tÃ¬m tháº¥y',

    'favpics' => 'YÃªu thÃ­ch'

    );

$lang_errors = array('access_denied' => 'Báº¡n khÃ´ng cÃ³ quyá»n á»Ÿ trang nÃ y',
    'perm_denied' => 'Báº¡n khÃ´ng cÃ³ quyá»n Ä‘á»ƒ thá»±c hiá»‡n',
    'param_missing' => 'Gá»i khÃ´ng cÃ³ thÃ´ng sá»‘',
    'non_exist_ap' => 'Lá»±a chá»n album/hÃ¬nh khÃ´ng cÃ³!',
    'quota_exceeded' => 'Háº¿t dung lá»±Æ¡ng<br /><br /Báº¡n chá»‰ cÃ³  [quota]K,hÃ¬nh cá»§a báº¡n Ä‘Ã£ chiáº¿m  [space]K, thÃªm hÃ¬nh nÃ y vÃ o sáº½ vá»±Æ¡t khoáº£ng trá»‘ng cho phÃ©p.',
    'gd_file_type_err' => 'Khi dÃ¹ng thÆ° viá»‡n GD chá»‰ xá»­ lÃ½ Ä‘á»±Æ¡c hÃ¬nh cÃ³ Ä‘uÃ´i lÃ  JPEG vÃ  PNG.',
    'invalid_image' => 'HÃ¬nh báº¡n táº£i lÃªn gáº·p trá»¥c tráº·c hoáº·c khÃ´ng thá»ƒ Ä‘á»±Æ¡c  thÆ° viá»‡n GD xá»­ lÃ½',
    'resize_failed' => 'KhÃ´ng thá»ƒ táº¡o thumbnail hoáº·c thay Ä‘á»•i kÃ­ch thá»©Æ¡c hÃ¬nh',
    'no_img_to_display' => 'KhÃ´ng cÃ³ hÃ¬nh nÃ o cáº£',
    'non_exist_cat' => 'PhÃ¢n loáº¡i báº¡n chá»n khÃ´ng tá»“n táº¡i',
    'orphan_cat' => 'PhÃ¢n loáº¡i báº¡n chá»n khÃ´ng cÃ³ PhÃ¢n loáº¡i gÃ´c, vÃ o pháº§n quáº£n lÃ½ PhÃ¢n loáº¡i Ä‘á»ƒ chá»‰nh láº¡i.',
    'directory_ro' => 'Äá»«Æ¡ng dáº«n \'%s\' khÃ´ng thá»ƒ thá»±c thi, hÃ¬nh khÃ´ng thá»ƒ xoÃ¡',
    'non_exist_comment' => 'Nháº­n xÃ©t báº¡n chá»n khÃ´ng tá»“n táº¡i.',
    'pic_in_invalid_album' => 'PHÃ¬nh náº±m trong Album khÃ´ng tá»“n táº¡i (%s)!?',

    'banned' => 'Báº¡n Ä‘ang bá»‹ cáº¥m tham gia site nÃ y.',

    'not_with_udb' => 'Chá»©c nÄƒng nÃ y khÃ´ng Ä‘á»±Æ¡c phÃ©p sá»­ dá»¥ng vÃ¬ nÃ³ tÆ°Æ¡ng tÃ¡c vá»›i forum. Báº¡n hÃ£y cáº¥u hÃ¬nh láº¡i hoáº·c chá»‰nh trong chá»©c nÄƒng cá»§a forum',

    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Danh sÃ¡ch Album',
    'alb_list_lnk' => 'nhá»¯ng Album',
    'my_gal_title' => 'HÃ¬nh cÃ¡ nhÃ¢n',
    'my_gal_lnk' => 'HÃ¬nh cá»§a tÃ´i',
    'my_prof_lnk' => 'GÃ³c cÃ¡ nhÃ¢n',
    'adm_mode_title' => 'chuyá»ƒn admin mode',
    'adm_mode_lnk' => 'Admin mode',
    'usr_mode_title' => 'Chuyá»ƒn user mode',
    'usr_mode_lnk' => 'Chuyá»ƒn qua giao diá»‡n ngá»«Æ¡i dÃ¹ng',
    'upload_pic_title' => 'Táº£i hÃ¬nh vÃ o Album',
    'upload_pic_lnk' => 'Táº£i  hÃ¬nh',
    'register_title' => 'Táº¡o tÃ i khoáº£n',
    'register_lnk' => 'ÄÄƒng kÃ½',
    'login_lnk' => 'ÄÄƒng nháº­p',
    'logout_lnk' => 'ThoÃ¡t',
    'lastup_lnk' => 'Má»›i táº£i lÃªn',
    'lastcom_lnk' => 'Má»›i nháº­n xÃ©t',
    'topn_lnk' => 'Xem nhiá»u',
    'toprated_lnk' => 'ÄÃ¡nh giÃ¡ cao',
    'search_lnk' => 'TÃ¬m',
    'fav_lnk' => 'YÃªu thÃ­ch',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Luáº­t khi upload',
    'config_lnk' => 'Cáº¥u hÃ¬nh',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'PhÃ¢n loáº¡i',
    'users_lnk' => 'Users',
    'groups_lnk' => 'NhÃ³m',
    'comments_lnk' => 'Nháº­n xÃ©t',
    'searchnew_lnk' => 'Äá»«Æ¡ng dáº«n vÃ  HÃ¬nh',
    'util_lnk' => 'chá»‰nh kÃ­ch cá»¡',

    'ban_lnk' => 'Cáº¥m tham gia',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Táº¡o, sáº¯p xáº¿p',
    'modifyalb_lnk' => 'Chá»‰nh Album cá»§a mÃ¬nh',
    'my_prof_lnk' => 'CÃ¡ nhÃ¢n',
    );

$lang_cat_list = array('category' => 'PhÃ¢n lá»ai',
    'albums' => 'Albums',
    'pictures' => 'HÃ¬nh',
    );

$lang_album_list = array('album_on_page' => '%d album trÃªn %d trang'
    );

$lang_thumb_view = array('date' => 'DATE',
    'name' => 'FILE NAME',

    'title' => 'TITLE',

    'sort_da' => 'Sáº¯p xáº¿p tÄƒng dáº§n',
    'sort_dd' => 'Sáº¯p xáº¿p giáº£m dáº§n',
    'sort_na' => 'Sáº¯p xáº¿p tÄƒng ',
    'sort_nd' => 'Sáº¯p xáº¿p giáº£m dáº§n',
    'sort_ta' => 'Sáº¯p xáº¿p tÄƒng dáº§n',

    'sort_td' => 'Sáº¯p xáº¿p giáº£m dáº§n',

    'pic_on_page' => '%d hÃ¬nh trÃªn %d trang',
    'user_on_page' => '%d hÃ¬nh trÃªn %d trang',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'trá»Ÿ láº¡i trang thumbnail',
    'pic_info_title' => 'Hiá»‡n/áº¨n thÃ´ng tin hÃ¬nh',
    'slideshow_title' => 'LÆ°á»›t qua',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Gá»­i hÃ¬nh nÃ y lÃ m thiá»‡p táº·ng',
    'ecard_disabled' => 'e-cards khÃ´ng cho phÃ©p',
    'ecard_disabled_msg' => 'Báº¡n khÃ´ng cÃ³ quyá»n Ä‘á»ƒ gá»­i hÃ¬nh',
    'prev_title' => 'Xem hÃ¬nh trá»©oc',
    'next_title' => 'Xem hÃ¬nh sau',
    'pic_pos' => 'HÃŒNH %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'ÄÃ¡nh giÃ¡ hÃ¬nh nÃ y ',
    'no_votes' => '(ChÆ°a ai Ä‘Ã¡nh giÃ¡)',
    'rating' => '(Má»©c Ä‘á»±Æ¡c Ä‘Ã¡nh giÃ¡: %s / 5 vá»›i %s láº§n Ä‘Ã¡nh giÃ¡)',
    'rubbish' => 'Tá»‡',
    'poor' => 'Xáº¥u',
    'fair' => 'Äá»±Æ¡c',
    'good' => 'Tá»‘t',
    'excellent' => 'Ráº¥t tá»‘t',
    'great' => 'Tuyá»‡t vá»i',
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
    CRITICAL_ERROR => 'Lá»—i',
    'file' => 'File: ',
    'line' => 'DÃ²ng: ',
    );

$lang_display_thumbnails = array('filename' => 'TÃªn file : ',
    'filesize' => 'Dung luá»£ng file : ',
    'dimensions' => 'Äá»‹nh kÃ­ch cá»¡ : ',
    'date_added' => 'NgÃ y Ä‘Æ°a vÃ o : '
    );

$lang_get_pic_data = array('n_comments' => '%s nháº­n xÃ©t',
    'n_views' => '%s láº§n xem',
    'n_votes' => '(%s láº§n Ä‘Ã¡nh giÃ¡)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'ThÃ¡n phá»¥c',
        'Question' => 'CÃ¢u há»i',
        'Very Happy' => 'Ráº¥t háº¡nh phÃºc',
        'Smile' => 'Cá»«Æ¡i',
        'Sad' => 'Buá»“n',
        'Surprised' => 'Ngáº¡c nhiÃªn',
        'Shocked' => 'ChoÃ¡ng',
        'Confused' => 'LÃºng tÃºng',
        'Cool' => 'Tuyá»‡t',
        'Laughing' => 'Cá»«Æ¡i to',
        'Mad' => 'KhÃ¬n',
        'Razz' => 'Cháº¿ giá»…u',
        'Embarassed' => 'áº¤n tá»±Æ¡ng',
        'Crying or Very sad' => 'Buá»“n khÃ³c',
        'Evil or Very Mad' => 'Ráº¥t khÃ¹ng',
        'Twisted Evil' => 'Qá»§y',
        'Rolling Eyes' => 'Liáº¿c máº¯t',
        'Wink' => 'NhÃ¡y máº¯t',
        'Idea' => 'Ã tá»­Æ¡ng',
        'Arrow' => 'MÅ©i tÃªn',
        'Neutral' => 'Trung láº­p',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'ThoÃ¡t khá»i giao diá»‡n Quáº£n trá»‹....',
        1 => 'ÄÄƒng nháº­p vÃ o giao diá»‡n Quáº£n trá»‹ ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Cáº§n Ä‘áº·t tÃªn cho Album',
        'confirm_modifs' => 'Cháº¯c cháº¯n lÃ  báº¡n muá»‘n chá»‰nh sá»­a nhÆ° tháº¿ chá»© ?',
        'no_change' => 'ChÆ°a chá»‰nh sá»­a gÃ¬ cáº£ !',
        'new_album' => 'Album má»›i',
        'confirm_delete1' => 'Cháº¯c cháº¯n xoÃ¡ Album nÃ y Ä‘i chá»© ?',
        'confirm_delete2' => '\n Táº¥t cáº£ hÃ¬nh trong nÃ y cÅ©ng sáº½ bá»‹ xoÃ¡ theo luÃ´n',
        'select_first' => 'Trá»©Æ¡c tiÃªn pháº£i chá»n Album',
        'alb_mrg' => 'Quáº£n lÃ½ Album ',
        'my_gallery' => '* HÃ¬nh cá»§a tÃ´i*',
        'no_category' => '* KhÃ´ng phÃ¢n loáº¡i *',
        'delete' => 'XoÃ¡',
        'new' => 'Má»›i',
        'apply_modifs' => 'Cáº­p nháº­t chá»‰nh sá»­a',
        'select_category' => 'Chá»n phÃ¢n loáº¡i',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => 'PhÃ¢n loáº¡i nÃ y khÃ´ng náº±m trong cÆ¡ sá»Ÿ dá»¯ liá»‡u',
        'usergal_cat_ro' => 'HÃ¬nh cá»§a User khÃ´ng thá»ƒ bá»‹ xoÃ¡',
        'manage_cat' => 'Quáº£n lÃ½ PhÃ¢n loáº¡i',
        'confirm_delete' => 'Are you sure you want to DELETE this category',
        'category' => 'PhÃ¢n loáº¡i',
        'operations' => 'Hoáº¡t Ä‘á»™ng',
        'move_into' => 'Chuyá»ƒn vÃ o',
        'update_create' => 'Cáº­p nháº­t/Táº¡o PhÃ¢n loáº¡i',
        'parent_cat' => 'PhÃ¢n loáº¡i cha',
        'cat_title' => 'TÃªn PhÃ¢n loáº¡i',
        'cat_desc' => 'MÃ´ táº£ phÃ¢n loáº¡i'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Cáº¥u hÃ¬nh',
        'restore_cfg' => 'Quay láº¡i máº·c Ä‘á»‹nh',
        'save_cfg' => 'Cháº¥p nháº­n cáº¥u hÃ¬nh má»›i',
        'notes' => 'Ghi chÃº',
        'info' => 'ThÃ´ng tin',
        'upd_success' => 'OK Ä‘Ã£ Ä‘á»±Æ¡c cáº­p nháº­t!',
        'restore_success' => 'ÄÃ£ trá»Ÿ láº¡i máº·c Ä‘á»‹nh !',
        'name_a' => 'TÃªn tÄƒng dáº§n',
        'name_d' => 'TÃªn giáº£m dáº§n',
        'title_a' => 'Tá»±a Ä‘á» tÄƒng dáº§n',

        'title_d' => 'Tá»±a Ä‘á» giáº£m dáº§n',

        'date_a' => 'NgÃ y tÄƒng dáº§n',
        'date_d' => 'NgÃ y giáº£m dáº§',
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
        'Chung chung',
        array(
            'TÃªn trang web', 'gallery_name', 0),
        array(
            'Lá»i mÃ´ táº£', 'gallery_description', 0),
        array(
            'Mail cá»§a ngá»«Æ¡i quáº£n trá»‹', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'NgÃ´n ngá»¯', 'lang', 5),
// for postnuke change
        array('Giao diá»‡n', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Xem danh sÃ¡ch Album',
        array(
            'Chiá»u ngang table chÃ­nh (pixels hay %)', 'main_table_width', 0),
        array(
            'Sá»‘ thá»© tá»± phÃ¢n loáº¡i sáº½ hiá»ƒn thá»‹', 'subcat_level', 0),
        array(
            'Sá»‘ cá»§a Album sáº½ hiá»ƒn thá»‹', 'albums_per_page', 0),
        array(
            'Sá»‘ cá»™t cá»§a 1 Album', 'album_list_cols', 0),
        array(
            'KÃ­ch thá»©Æ¡c 1 ThumbNails', 'alb_list_thumb_size', 0),
        array(
            'Ná»™i dung cá»§a trang chÃ­nh', 'main_page_layout', 0),
        array(
            'Hiá»ƒn thá»‹ Album Ä‘áº§u tiÃªn dáº¡ng thumbnails trong PhÃ¢n loáº¡i', 'first_level', 1), 
        // 'Thumbnail view',
        'Xem dáº¡ng Thumbnail',
        array(
            'Sá»‘ cá»™t Thumbnail 1 trang', 'thumbcols', 0),
        array(
            'Sá»‘ dÃ²ng thumbnail 1 trang', 'thumbrows', 0),
        array(
            'Tá»‘i Ä‘a  tabs thá»ƒ hiá»‡n', 'max_tabs', 0),
        array(
            'Hiá»ƒn thá»‹ thÃ´ng tin vá» táº¥m hÃ¬nh phÃ­a dá»©Æ¡i má»—i táº¥m hÃ¬nh', 'caption_in_thumbview', 1),
        array(
            'Hiá»ƒn thá»‹ sá»‘ láº§n nháº­n xÃ©t dÆ°á»›i má»—i táº¥m hÃ¬nh', 'display_comment_count', 1),
        array(
            'Sáº¯p xáº¿p theo thá»© tá»± hay nhÆ° máº·c Ä‘á»‹nh', 'default_sort_order', 3),
        array(
            'Tá»‘i thiá»ƒu sá»‘ láº§n Ä‘Ã¡nh giÃ¡  1 táº¥m hÃ¬nh Ä‘á»ƒ Ä‘á»±Æ¡c xuáº¥t hiá»‡n trÃªn danh sÃ¡ch Ä‘á»±Æ¡c Ä‘Ã¡nh giÃ¡ cao', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Xem hÃ¬nh &amp; Lá»i nháº­n xÃ©t',
        array(
            'Chiáº¿u ngang cho 1 táº¥m hÃ¬nh hiá»ƒn thá»‹ (pixels hay %)', 'picture_table_width', 0),
        array(
            'ThÃ´ng tin hÃ¬nh hiá»ƒn thá»‹ nhÆ° máº·c Ä‘á»‹nh', 'display_pic_info', 1),
        array(
            'Lá»c tá»« ngá»¯ trong pháº§n nháº­n xÃ©t', 'filter_bad_words', 1),
        array(
            'Cho phÃ©p hiá»ƒn thá»‹ Icon cá»«Æ¡i trong nháº­n xÃ©t ?', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Äá»™ dÃ i cho lá»i miÃªu táº£ táº¥m hÃ¬nh', 'max_img_desc_length', 0),
        array(
            'Tá»‘i Ä‘a kÃ½ tá»± trong 1 tá»«', 'max_com_wlength', 0),
        array(
            'Tá»‘i Ä‘a sá»‘ dÃ²ng trong lá»i nháº­n xÃ©t', 'max_com_lines', 0),
        array(
            'Tá»‘i Ä‘a 1 lá»i nháº­n xÃ©t', 'max_com_size', 0),
        array(
            'Hiá»ƒn thá»‹ nhÆ° lÃ  hÃ¬nh 1 phim', 'display_film_strip', 1),

        array(
            'Sá»‘ hÃ¬nh ', 'max_film_strip_items', 0),

        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'HÃ¬nh vÃ  Thumnail',
        array(
            'Cháº¥t lÆ°á»£ng JPEG files', 'jpeg_qual', 0),
        array(
            'KÃ­ch thá»©Æ¡c cao nháº¥t 1 thumnail <strong>*</strong>', 'thumb_width', 0),

        array(
            'KÃ­ch thá»©Æ¡c bá» ngoÃ i Thumnail<strong>*</strong>', 'thumb_use', 7),

        array(
            'Táº¡o hÃ¬nh trung gian', 'make_intermediate', 1),
        array(
            'Tá»‘i Ä‘a chiá»u rá»™ng hay cao 1 hÃ¬nh trung gian<strong>*</strong>', 'picture_width', 0),
        array(
            'Dung lá»±Æ¡ng tá»‘i Ä‘a 1 táº¥m hÃ¬nh Ä‘á»±Æ¡c táº£i lÃªn(KB)', 'max_upl_size', 0),
        array(
            'Tá»‘i Ä‘a kÃ­ch thá»©Æ¡c 1 táº¥m hÃ¬nh Ä‘á»±Æ¡c táº£i lÃªn', 'max_upl_width_height', 0), 
        // 'User settings',
        'Ngá»«Æ¡i dÃ¹ng',
        array(
            'Cho phÃ©p ngá»«Æ¡i dÃ¹ng Ä‘Äƒng kÃ½', 'allow_user_registration', 1),
        array(
            'Khi Ä‘Äƒng kÃ½ ngá»«Æ¡i dÃ¹ng cáº§n pháº£i kÃ­ch hoáº¡t mail', 'reg_requires_valid_email', 1),
        array(
            'Cho phÃ©p trÃ¹ng mail khi Ä‘Äƒng kÃ½', 'allow_duplicate_emails_addr', 1),
        array(
            'Ngá»«Æ¡i dÃ¹ng Ä‘á»±Æ¡c táº¡o Album riÃªng', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Chá»‰nh sá»­a chá»— Ä‘iá»n lá»i mÃ´ táº£ cho táº¥m (bá» tráº¯ng náº¿u khÃ´ng thÃ­ch)',
        array(
            'Pháº§n 1 tÃªn ', 'user_field1_name', 0),
        array(
            'Pháº§n 2 tÃªn', 'user_field2_name', 0),
        array(
            'Pháº§n 3 tÃªn', 'user_field3_name', 0),
        array(
            'Pháº§n 4 tÃªn', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Chá»‰nh sá»­a chi tiáº¿t hÆ¡n HÃ¬nh vÃ  Thumnail',
        array(
            'Hiá»ƒn thá»‹ Album riÃªng cho ngá»«Æ¡i chÆ°a Ä‘Äƒng nháº­p ?', 'show_private', 1),

        array(
            'KÃ½ tá»± bá»‹ ngÄƒn cáº¥m', 'forbiden_fname_char', 0),
        array(
            'Cháº¥p nháº­n cho file má»Ÿ rá»™ng khi táº£i hÃ¬nh lÃªn?', 'allowed_file_extensions', 0),
        array(
            'PhÆ°Æ¡ng thá»©c chá»‰nh sá»­a kÃ­ch thá»©Æ¡c hÃ¬nh', 'thumb_method', 2),
        array(
            'Äá»«Æ¡ng dáº«n\'convert\' tiá»‡n Ã­ch(vÃ­ dá»¥ nhÆ° /usr/bin/X11/)', 'impath', 0),
        array(
            'Cho phÃ©p hÃ¬nh cÃ³ Ä‘uÃ´i dáº¡ng (chÃ­ cÃ³ tÃ¡c dá»¥ng khi dÃ¹ng ImageMagick)', 'allowed_img_types', 0),
        array(
            'DÃ²ng lá»‡nh tÃ¹y chá»n  cho  ImageMagick', 'im_options', 0),
        array(
            'Äá»c EXIF dá»¯ liá»‡u trong JPEG files', 'read_exif_data', 1),
        array(
            'Äá»c ITPC dá»¯ liá»‡u trong JPEG files', 'read_itpc_data', 1),
        array(
            'Äá»«Æ¡ng dáº«n Album <strong>*</strong>', 'fullpath', 0),
        array(
            'Äá»«Æ¡ng dáº«n Ä‘áº¿n nÆ¡i lÆ°u giá»¯ hÃ¬nh cá»§a User <strong>*</strong>', 'userpics', 0),
        array(
            'KÃ½ tá»± phÃ­a trá»©Æ¡c tÃªn cá»§a má»—i file hÃ¬nh má»Ÿ rá»™ng  <strong>*</strong>', 'normal_pfx', 0),
        array(
            'KÃ½ tá»± phÃ­a trá»©Æ¡c má»—i thumnail <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Cháº¿ Ä‘á»™ máº·c Ä‘á»‹nh cho Ä‘á»«Æ¡ng dáº«n', 'default_dir_mode', 0),
        array(
            'Cháº¿ Ä‘á»™ máº·c Ä‘á»‹nh cho hÃ¬nh ', 'default_file_mode', 0),
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
        'Cookies &amp; Charset ',
        array(
            'TÃªn cá»§a cookie', 'cookie_name', 0),
        array(
            'Äá»«Æ¡ng dáº«n cá»§a cookie', 'cookie_path', 0),
        array(
            'Kiá»ƒu mÃ£ hoÃ¡ kÃ½ tá»± (charset)', 'charset', 4),

        'Linh tinh',
        array(
            'Cho phÃ©p cháº¿ Ä‘á»™ bÃ¡o lá»—i', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Nhá»¯ng dÃ²ng cÃ³ * khÃ´ng Ä‘á»±Æ¡c thay Ä‘á»•i khi hÃ¬nh Ä‘Ã£ cÃ³ trong Album rá»“i</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Báº¡n cáº§n viáº¿t tÃªn vÃ  lá»i nháº­n xÃ©t vÃ o',
        'com_added' => 'Lá»i nháº­n xÃ©t Ä‘á»±Æ¡c cháº¥p nháº­n !',
        'alb_need_title' => 'Báº¡n cáº§n Ä‘áº·t tÃªn cho Album!',
        'no_udp_needed' => 'KhÃ´ng cáº§n sá»± cáº­p nháº­t',
        'alb_updated' => 'Album Ä‘á»±Æ¡c cáº­p nháº­t',
        'unknown_album' => 'Album vá»«a chá»n khÃ´ng cÃ³ hoáº·c lÃ  báº¡n khÃ´ng cÃ³ quyá»n Ä‘á»ƒ táº£i hÃ¬nh lÃªn á»Ÿ album nÃ y rá»“i ',
        'no_pic_uploaded' => 'KhÃ´ng cÃ³ hÃ¬nh nÃ o Ä‘á»±Æ¡c táº£i lÃªn cáº£!!<br /><br />Báº¡n coi láº¡i xem táº¥m hÃ¬nh táº£i lÃªn server nÃ y cÃ³ há»£p yÃªu cáº§u chÆ°a ?',
        'err_mkdir' => 'Lá»—i khi táº¡o Ä‘á»«Æ¡ng dáº«n %s !',
        'dest_dir_ro' => 'Äá»«Æ¡ng dáº«n Ä‘áº¿n %s khÃ´ng thá»ƒ truy cáº­p  !',
        'err_move' => 'KhÃ´ng thá»ƒ di chuyá»ƒn %s Ä‘áº¿n %s !',
        'err_fsize_too_large' => 'KÃ­ch thá»©Æ¡c cá»§a táº¥m hÃ¬nh báº¡n táº£i lÃªn quÃ¡ lá»›n so vá»›i qui Ä‘á»‹nh (tá»‘i Ä‘a lÃ  %s x %s) !',
        'err_imgsize_too_large' => 'Dung lÆ°á»£ng file báº¡n táº£i lÃªn quÃ¡ lá»›n so vá»›i qui Ä‘á»‹nh (tá»‘i Ä‘a lÃ  %s KB) !',
        'err_invalid_img' => 'File báº¡n muá»‘n táº£i lÃªn Ä‘Ã¢u pháº£i lÃ  hÃ¬nh áº£nh !',
        'allowed_img_types' => 'Chá»‰ Ä‘á»±Æ¡c phÃ©p táº£i  hÃ¬nh %s ',
        'err_insert_pic' => 'HÃ¬nh \'%s\' khÃ´ng thá»ƒ Ä‘á»±Æ¡c chÃ¨n vÃ o Album ',
        'upload_success' => 'HÃ¬nh cá»§a báº¡n Ä‘Ã£ Ä‘á»±Æ¡c táº£i lÃªn thÃ nh cÃ´ng !<br /><br />NÃ³ sáº½ Ä‘á»±Æ¡c hiá»ƒn thá»‹ khi Ban Quáº£n Trá»‹ ch phÃ©p',
        'info' => 'ThÃ´ng tin',
        'com_added' => 'Lá»i nháº­n xÃ©t Ä‘á»±Æ¡c cháº¥p nháº­n',
        'alb_updated' => 'Album Ä‘á»±Æ¡c cáº­p nháº­t!',
        'err_comment_empty' => 'Nháº­n xÃ©t cá»§a báº¡n trá»‘ng!',
        'err_invalid_fext' => 'Chá»‰ cÃ³ cÃ¡c loáº¡i file vá»›i Ä‘uÃ´i sau Ä‘Ã¢y Ä‘á»±Æ¡c cháº¥p nháº­n : <br /><br />%s.',
        'no_flood' => 'Xin lÃ´i, báº¡n Ä‘Ã£ lÃ  tÃ¡c giáº£ cá»§a lá»i nháº­n xÃ©t hÃ¬nh nÃ  rá»“i <br /><br />Sá»­a láº¡i nháº­n xÃ©t nÃ y náº¿u báº¡n muá»‘n !',
        'redirect_msg' => 'ChÃºng tÃ´i sáº½ chuyá»ƒn báº¡n Ä‘áº¿n<br /><br /><br />Click \'CONTINUE\' náº¿u trang nÃ y khÃ´ng tá»± Ä‘á»™ng',
        'upl_success' => 'ChÃºc má»«ng, hÃ¬nh cá»§a báº¡n Ä‘Ã£ Ä‘á»±Æ¡c táº£i lÃªn thÃ nh cÃ´ng',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'MÃ´ táº£',
        'fs_pic' => 'KÃ­ch thá»©Æ¡c hÃ¬nh',
        'del_success' => 'XoÃ¡ thÃ nh cÃ´ng!',
        'ns_pic' => 'kÃ­ch thá»©Æ¡c hÃ¬nh bÃ¬nh thá»«Æ¡ng',
        'err_del' => 'khÃ´ng thá»ƒ xÃ³a',
        'thumb_pic' => 'thumbnail',
        'comment' => 'nháº­n xÃ©t',
        'im_in_alb' => 'hÃ¬nh trong album',
        'alb_del_success' => 'Album \'%s\' Ä‘Ã£ bá»‹ xoÃ¡',
        'alb_mgr' => 'Quáº£n lÃ½ Album ',
        'err_invalid_data' => 'Dá»¯ liá»‡u khÃ´ng Ä‘Ãºng á»Ÿ \'%s\'',
        'create_alb' => 'Äang táº¡o Album \'%s\'',
        'update_alb' => 'Äang cáº­p nháº­t Album \'%s\' vá»›i tá»±a \'%s\' vÃ  chá»‰ má»¥c \'%s\'',
        'del_pic' => 'XoÃ¡ hÃ¬nh',
        'del_alb' => 'XoÃ¡ Album',
        'del_user' => 'XoÃ¡ User',
        'err_unknown_user' => 'User nÃ y khÃ´ng tá»“n táº¡i!',
        'comment_deleted' => 'Nháº­n xÃ©t Ä‘Ã£ bá»‹ xÃ³a bá»',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'CÃ³ cháº¯c cháº¯n xÃ³a hÃ¬nh nÃ y kÃ´ ? \\nNháº­n xÃ©t cÅ©ng sáº½ bÃ­ xoÃ¡',
        'del_pic' => 'XOÃ HÃŒNH NÃ€Y',
        'size' => '%s x %s pixels',
        'views' => '%s láº§n',
        'slideshow' => 'lá»©Æ¡t qua',
        'stop_slideshow' => 'Dá»«ng láº¡i',
        'view_fs' => 'Clik vÃ o Ä‘á»ƒ xem hÃ¬nh to hÆ¡n',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'thÃ´ng tin hÃ¬nh',
        'Filename' => 'TÃªn file',
        'Album name' => 'tÃªn Album',
        'Rating' => 'ÄÃ¡nh giÃ¡ (%s láº§n)',
        'Keywords' => 'Tá»« khoÃ¡',
        'File Size' => 'Dung lá»±Æ¡ng file',
        'Dimensions' => 'KÃ­ch cá»¡',
        'Displayed' => 'ÄÃ£ há»‹iá»ƒn thá»‹',
        'Camera' => 'Camera',
        'Date taken' => 'Date taken',
        'Aperture' => 'Äá»™ má»Ÿ',
        'Exposure time' => 'Exposure time',
        'Focal length' => 'Focal length',
        'Comment' => 'Nháº­n xÃ©t',
        'addFav' => 'ThÃªm vÃ o pháº§n yÃªu thÃ­ch',

        'addFavPhrase' => 'YÃªu thÃ­ch',

        'remFav' => 'XoÃ¡ khá»i pháº§n yÃªu thÃ­ch',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Sá»­a lá»i nháº­n xÃ©t nÃ y',
        'confirm_delete' => 'CÃ³ cháº¯c lÃ  muá»‘n xoÃ¡ nháº­n xÃ©t nÃ y khÃ´ng  ?',
        'add_your_comment' => 'ThÃªm nháº­n xÃ©t vÃ o',
        'name' => 'TÃªn',

        'comment' => 'Nháº­n xÃ©t',

        'your_name' => 'náº·c danh',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Click vÃ o hÃ¬nh Ä‘á»ƒ Ä‘Ã³ng cá»­a sá»• nÃ y',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Gá»­i an e-card',
        'invalid_email' => '<strong>Cáº£nh bÃ¡o</strong> : Ä‘á»‹a chá»‰ mail khÃ´ng há»£p lÃ½ !',
        'ecard_title' => 'thiá»‡p tá»« %s cho báº¡n',
        'view_ecard' => 'náº¿u táº¥m thiá»‡p nÃ y khÃ´ng hiá»ƒn thá»‹ Ä‘Ãºng thÃ¬ hÃ£y click vÃ o Ä‘Ã¢y',
        'view_more_pics' => 'Click vÃ o Ä‘Ã¢y Ä‘á»ƒ cÃ³ thá»ƒ xem nhiá»u hÃ¬nh hÆ¡n',
        'send_success' => 'thiá»‡p cá»§a báº¡n Ä‘Ã£ Ä‘á»±Æ¡c gá»­i',
        'send_failed' => 'Xin lá»—i, server khÃ´ng thá»ƒ gá»­i thiá»‡p cá»§a báº¡n Ä‘i Ä‘á»±Æ¡c',
        'from' => 'Tá»«',
        'your_name' => 'TÃªn cá»§a báº¡n',
        'your_email' => 'Mail cá»§a báº¡n',
        'to' => 'Äáº¿n',
        'rcpt_name' => 'tÃªn ngá»«Æ¡i nháº­n',
        'rcpt_email' => 'Mail cá»§a ngá»«Æ¡i nháº­n',
        'greetings' => 'lá»i chÃ o',
        'message' => 'Ná»™i dung chÃºc',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'HÃ¬nh&nbsp;thÃ´ng tin',
        'album' => 'Album',
        'title' => 'Tá»±a Ä‘á»',
        'desc' => 'MÃ´ táº£',
        'keywords' => 'Tá»« khoÃ¡',
        'pic_info_str' => '%sx%s - %sKB - %s láº§n xem - %s láº§n Ä‘Ã¡nh giÃ¡',
        'approve' => 'cháº¥p nháº­n hÃ¬nh',
        'postpone_app' => 'khoan cháº¥p nháº­n',
        'del_pic' => 'XoÃ¡ hÃ¬nh',
        'reset_view_count' => 'tráº£ láº¡i sá»‘ láº§n xem',
        'reset_votes' => 'tráº£ láº¡i sá»‘ láº§n Ä‘Ã¡nh giÃ¡',
        'del_comm' => 'XÃ³a nháº­n xÃ©t',
        'upl_approval' => 'cho phÃ©p táº£i lÃªn',
        'edit_pics' => 'Sá»­a hÃ¬nh',
        'see_next' => 'Xem hÃ¬nh káº¿ tiáº¿p',
        'see_prev' => 'Xem hÃ¬nh trá»©Æ¡c',
        'n_pic' => '%s hÃ¬nh',
        'n_of_pic_to_disp' => 'Sá»‘ hÃ¬nh Ä‘á»±Æ¡c hiá»ƒn thá»‹',
        'apply' => 'Cáº­p nháº­t thay Ä‘á»•i nÃ y'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'tÃªn nhÃ³m',
        'disk_quota' => 'Dung lá»±Æ¡ng Ä‘Ä©a',
        'can_rate' => 'CÃ³ thá»ƒ Ä‘Ã¡nh giÃ¡ hÃ¬nh',
        'can_send_ecards' => 'CÃ³ thá»ƒ gá»­i thiá»‡p',
        'can_post_com' => 'CÃ³ thá»ƒ viáº¿t nháº­n xÃ©t',
        'can_upload' => 'CÃ³ thá»ƒ táº£i hÃ¬nh lÃªn',
        'can_have_gallery' => 'CÃ³ gÃ³c cÃ¡ nhÃ¢n riÃªng',
        'apply' => 'Cáº­p nháº­t thay Ä‘á»•i nÃ y',
        'create_new_group' => 'Táº¡o nhÃ³m má»›i',
        'del_groups' => 'XoÃ¡ cÃ¡c nhÃ³m Ä‘Ã£ chá»n',
        'confirm_del' => 'ChÃº Ã½, khi xoÃ¡ 1 nhÃ³m thÃ¬ cÃ¡c thÃ nh viÃªn trong nhÃ³m nÃ y sáº½ Ä‘á»±Æ¡c chuyá»ƒn Ä‘áº¿n nhÃ³m \'Registered\' !\n\n Báº¡n cÃ³ muá»‘n tiáº¿n hÃ nh ?',
        'title' => 'Äiá»u khiá»ƒn nhÃ³m',
        'approval_1' => 'Pub. Upl. cháº¥p nháº­n (1)',
        'approval_2' => 'Priv. Upl. cháº¥p nháº­n (2)',
        'note1' => '<strong>(1)</strong> Ä‘á»±Æ¡c táº£i há»‰nh lÃªn chá»— cáº§n Ä‘á»±Æ¡c Ban Quáº£n Trá»‹ Ä‘á»“ng Ã½ ',
        'note2' => '<strong>(2)</strong> Ä‘á»±Æ¡c upload lÃªn nÆ¡i mÃ  user cáº§n Ban Quáº£n Tri cho phÃ©p',
        'notes' => 'Ghi chÃº'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'ChÃ o má»«ng !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'CÃ³ cháº¯c lÃ  báº¡n muá»‘n xÃ³a Album nÃ y  ? \\n Táº¥t cáº£ hÃ¬nh vÃ  nháº­n xÃ©t cÅ©ng sáº½ bá»‹ xoÃ¡.',
        'delete' => 'XÃ“A',
        'modify' => 'THUá»˜C TÃNH',
        'edit_pics' => 'Sá»¬A HÃŒNH',
        );

    $lang_list_categories = array('home' => 'Trang chá»§',
        'stat1' => '<strong>[pictures] </strong> hÃ¬nh trong <strong>[albums]</strong> album vÃ  <strong>[cat]</strong> PhÃ¢n loáº¡i vá»›i <strong>[comments]</strong> nháº­n xÃ©t, xem <strong>[views]</strong> láº§n',
        'stat2' => '<strong>[pictures]</strong> hÃ¬nh trong <strong>[albums]</strong> album Ä‘á»±Æ¡c xem <strong>[views]</strong> láº§n',
        'xx_s_gallery' => 'hÃ¬nh cá»§a %s\ ',
        'stat3' => '<strong>[pictures]</strong> hÃ¬nh trong <strong>[albums]</strong> album vá»›i <strong>[comments]</strong> nháº­n xÃ©t, Ä‘á»±Æ¡c xem <strong>[views]</strong> láº§n'
        );

    $lang_list_users = array('user_list' => 'Danh sÃ¡ch ngá»«Æ¡i dÃ¹ng',
        'no_user_gal' => 'KhÃ´ng cÃ³ hÃ¬nh ngá»«Æ¡i dÃ¹ng',
        'n_albums' => '%s album',
        'n_pics' => '%s hÃ¬nh'
        );

    $lang_list_albums = array('n_pictures' => '%s hÃ¬nh',
        'last_added' => ', láº§n cuá»‘i thÃªm vÃ o: %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Cáº­p nháº­t album %s',
        'general_settings' => 'Chung chung',
        'alb_title' => 'tá»±a Ä‘á» Album',
        'alb_cat' => 'phÃ¢n loáº¡i Album ',
        'alb_desc' => 'mÃ´ táº£ Album',
        'alb_thumb' => 'Album thumbnail',
        'alb_perm' => 'Quyá»n háº¡n cho Album nÃ y',
        'can_view' => 'Album nÃ y cÃ³ thá»ƒ Ä‘á»±Æ¡c xem bá»Ÿi',
        'can_upload' => 'KhÃ¡ch cÃ³ thá»ƒ táº£i hÃ¬nh lÃªn',
        'can_post_comments' => 'KhÃ¡ch cÃ³ thá»ƒ nháº­n xÃ©t',
        'can_rate' => 'KhÃ¡ch cÃ³ thá»ƒ Ä‘Ã¡nh giÃ¡ hÃ¬nh',
        'user_gal' => 'hÃ¬nh cá»§a ngá»«Æ¡i dÃ¹ng',
        'no_cat' => '* KhÃ´ng cÃ³ phÃ¢n loáº¡i *',
        'alb_empty' => 'Album trá»‘ng',
        'last_uploaded' => 'Cáº­p nháº­t láº§n cuá»‘i',
        'public_alb' => 'Táº¥t cáº£ má»i ngÆ°á»i (album cÃ´ng cá»™ng)',
        'me_only' => 'Chá»‰ riÃªng tÃ´i',
        'owner_only' => 'chá»‰ chá»§ cá»§a Album (%s)',
        'groupp_only' => 'ThÃ nh vien nhÃ³m \'%s\' ',
        'err_no_alb_to_modify' => 'khÃ´ng cÃ³ album nÃ o báº¡n cÃ³ thá»ƒ thay Ä‘á»•i trong dá»¯ liá»‡u.',
        'update' => 'Cáº­p nháº­t album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Xin lá»—i, báº¡n Ä‘Ã£ Ä‘Ã¡nh giÃ¡ hÃ¬nh nÃ y 1 láº§n rá»“i',
        'rate_ok' => 'CÃ¡m Æ¡n báº¡n Ä‘Ã£ Ä‘Ã¡nh giÃ¡',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Trong khi Ban Quáº£n Trá»‹ cá»§a {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
Náº¿u Ä‘á»“ng Ã½ báº¡n vui lÃ²ng click vÃ o  'I agree' dá»©Æ¡i Ä‘Ã¢y.
EOT;

    $lang_register_php = array('page_title' => 'ÄÄƒng kÃ½ lÃ m thÃ nh viÃªn',
        'term_cond' => 'Ná»™i qui',
        'i_agree' => 'tÃ´i Ä‘á»“ng Ã½',
        'submit' => 'Gá»­i thÃ´ng tin Ä‘Äƒng kÃ½ Ä‘i',
        'err_user_exists' => 'TÃªn báº¡n Ä‘Äƒng kÃ½ Ä‘Ã£ cÃ³ ngá»«Æ¡i sá»­ dá»¥ng, vui lÃ²ng chá»n 1 cÃ¡i khac ',
        'err_password_mismatch' => 'Máº­t khuáº©u báº¡n nháº­p 2 láº§n khÃ´ng trÃ¹ng nhau, Ä‘iá»n láº¡i.',
        'err_uname_short' => 'TÃªn tá»‘i thiá»ƒu pháº£i 2 kÃ½ tá»± trá»Ÿ lÃªn',
        'err_password_short' => 'Máº­t kháº©u pháº£i trÃªn 2 kÃ½ tá»±',
        'err_uname_pass_diff' => 'TÃªn vÃ  máº­t kháº©u khÃ´ng Ä‘á»±Æ¡c giá»‘ng nhau',
        'err_invalid_email' => 'Email khÃ´ng há»£p lÃ½',
        'err_duplicate_email' => 'TÃ i khoáº£n khÃ¡c Ä‘Ã£ xÃ i Mail nÃ y rá»“i, báº¡n vui lÃ²ng dÃ¹ng cai khÃ¡c',
        'enter_info' => 'Äiá»n thÃ´ng tin Ä‘Äƒng kÃ½',
        'required_info' => 'ThÃ´ng tin báº¯t buá»™c pháº£i Ä‘iá»n',
        'optional_info' => 'ThÃ´ng tin thÃªm',
        'username' => 'TÃªn',
        'password' => 'Máº­t kháº©u',
        'password_again' => 'Nháº­p láº¡i máº­t kháº©u',
        'email' => 'Email',
        'location' => 'NÆ¡i Ä‘ang sá»‘ng',
        'interests' => 'YÃªu thÃ­ch',
        'website' => 'website riÃªng cua báº¡n',
        'occupation' => 'CÃ´ng viá»‡c',
        'error' => 'Lá»–i',
        'confirm_email_subject' => '%s - ThÃ´ng tin Ä‘Äƒng kÃ½',
        'information' => 'ThÃ´ng tin',
        'failed_sending_email' => 'KhÃ´ng thá»ƒ gá»­i báº£n Ä‘ang kÃ½ nÃ y Ä‘áº¿n mail Ä‘á»±Æ¡c!',
        'thank_you' => 'CÃ¡m Æ¡n báº¡n Ä‘Ã£ Ä‘Äƒng kÃ½.<br /><br />Má»™t eMail vá»›i thÃ´ng tin há»©Æ¡ng dáº«n báº¡n kÃ­ch hoáº¡t tÃ i khoáº£n cá»§a báº¡n  Ä‘Ã£ Ä‘á»±oc gá»­i Ä‘áº¿n mail mÃ  báº¡n Ä‘Ã£ cung cáº¥p cho chÃºng tÃ´i.',
        'acct_created' => 'OK, tÃ i khoáº£n cá»§a báº¡n Ä‘Ã£ Ä‘á»±Æ¡c kÃ­ch hoáº¡t, bÃ¢y giá» báº¡n cÃ³ thá»ƒ Ä‘Äƒng nháº­p vá»›i TÃªn vÃ  máº­t kháº©u cá»§a báº¡n',
        'acct_active' => 'HÃ£y Ä‘Äƒng nháº­p vá»›i TÃªn vÃ  máº­t kháº©u cá»§a báº¡n',
        'acct_already_act' => 'TÃ i khoáº£n Ä‘Ã£ Ä‘á»±Æ¡c kÃ­ch hoáº¡t!',
        'acct_act_failed' => 'TÃ i khoáº£n nÃ y khÃ´ng thá»ƒ Ä‘á»±Æ¡c kÃ­ch hoáº¡t!',
        'err_unk_user' => 'TÃ i khoáº£n nÃ y khÃ´ng tá»“n táº¡i!',
        'x_s_profile' => 'thÃ´ng tin cá»§a %s ',
        'group' => 'nhÃ³m',
        'reg_date' => 'tham gia tá»«',
        'disk_usage' => 'dung lá»±Æ¡ng',
        'change_pass' => 'Äá»•i máº­t kháº©u',
        'current_pass' => 'Máº­t kháº©u hiá»‡n táº¡i',
        'new_pass' => 'Máº­t kháº©u má»›i',
        'new_pass_again' => 'Nháº­p láº¡i máº­t kháº©u má»›i 1 láº§n ná»¯a',
        'err_curr_pass' => 'Máº­t kháº©u hiá»‡n thá»i báº¡n nháº­p khÃ´ng chÃ­nh xÃ¡c',
        'apply_modif' => 'Cáº­p nháº­t thay Ä‘á»•i',
        'change_pass' => 'Thay Ä‘á»•i máº­t kháº©u',
        'update_success' => 'ThÃ´ng tin cá»§a báº¡n Ä‘Ã£ Ä‘á»±Æ¡c chá»‰nh sá»­a',
        'pass_chg_success' => 'Máº­t kháº©u Ä‘Ã£ Ä‘á»±Æ¡c thay Ä‘á»•i',
        'pass_chg_error' => 'Máº­t kháº©u cá»§a báº¡n khÃ´ng Ä‘á»±Æ¡c thay Ä‘á»•i',
        );

    $lang_register_confirm_email = <<<EOT
CÃ¡m Æ¡n báº¡n Ä‘Ã£ Ä‘Äƒng kÃ½ vá»›i chÃºng tÃ´i táº¡i {SITE_NAME}

TÃªn tÃ  khoáº£n cá»§a báº¡n lÃ  : "{USER_NAME}" 
Máº­t kháº©u lÃ  : "{PASSWORD}"

Äá»ƒ kÃ­ch hoáº¡t tÃ i khoáº£n, báº¡n cáº§n click vÃ o link sau .

{ACT_LINK}

thÃ¢n,

ban quáº£n trá»‹ {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'xem láº¡i nháº­n xÃ©t',
        'no_comment' => 'KhÃ´ng cÃ³ nháº­n xÃ©t nÃ o Ä‘á»ƒ xem cáº£',
        'n_comm_del' => '%s nháº­n xÃ©t bá»‹ xoÃ¡',
        'n_comm_disp' => 'Sá»‘ nháº­n xÃ©t Ä‘á»±Æ¡c hiá»ƒn thá»‹',
        'see_prev' => 'Xem nháº­n xÃ©t trá»©Æ¡c',
        'see_next' => 'Xem nháº­n xÃ©t sau',
        'del_comm' => 'XÃ³a nháº­n xÃ©t Ä‘Ã£ chá»n',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'TÃ¬m kiáº¿m hÃ¬nh tá»•ng há»£p',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'TÃ¬m hÃ¬nh má»›i',
        'select_dir' => 'Chá»n Ä‘á»«Æ¡ng dáº«n',
        'select_dir_msg' => 'Chá»©c nÄƒng nÃ y cho phÃ©p báº¡n thÃªm Ä‘á»«Æ¡ng dáº«n cá»§a hÃ¬nh mÃ  Ä‘Ã£ Ä‘á»±Æ¡c táº£i lÃªn  server báº±ng FTP.<br /><br />Chá»n Ä‘á»«Æ¡ng dáº«n mÃ  báº¡n muá»‘n táº£i hÃ¬nh lÃªn',
        'no_pic_to_add' => 'KhÃ´ng cÃ³ hÃ¬nh Ä‘á»ƒ thÃªm vÃ o',
        'need_one_album' => 'Báº¡n pháº£i cÃ³ Ã­t nháº¥t 1 album Ä‘á»ƒ xÃ i chá»©c nÄƒng nÃ y',
        'warning' => 'Cáº£nh bÃ¡o',
        'change_perm' => 'tkhÃ´ng thá»ƒ chÃ©p vÃ o thÆ° má»¥c nÃ y, cáº§n pháº£i Chmod lÃ  755 hay 777 !',
        'target_album' => '<strong>Äáº·t hÃ¬nh cá»§a  &quot;</strong>%s<strong>&quot; vÃ o </strong>%s',
        'folder' => 'ThÆ° má»¥c',
        'image' => 'HÃ¬nh',
        'album' => 'Album',
        'result' => 'Káº¿t quáº£',
        'dir_ro' => 'KhÃ´ng thá»ƒ chá»‰nh sá»­a',
        'dir_cant_read' => 'KhÃ´ng thá»ƒ xem',
        'insert' => 'ThÃªm hÃ¬nh vÃ o',
        'list_new_pic' => 'Danh sÃ¡ch hÃ¬nh má»›i',
        'insert_selected' => 'ChÃ¨n hÃ¬nh Ä‘Ã£ chá»n',
        'no_pic_found' => 'KhÃ´ng tÃ¬m tháº¥y hÃ¬nh mÆ¡i nÃ o cáº£',
        'be_patient' => 'Please be patient, the script needs time to add the pictures',
        'notes' => '<ul>' . '<li><strong>OK</strong> : hÃ¬nh Ä‘Ã£ Ä‘á»±Æ¡c thÃªm vÃ o' . '<li><strong>DP</strong> : hÃ¬nh nÃ y trÃ¹ng láº·p vÃ  Ä‘Ã£ cÃ³ trong cÆ¡ sá»Ÿ dá»¯ liá»‡u' . '<li><strong>PB</strong> : hÃ¬nh cá»§a báº¡n khÃ´ng thá»ƒ Ä‘á»±Æ¡c thÃªm vÃ o, kiá»ƒm tra láº¡i cáº¥u hÃ¬nh hoáº·c quyá»n.' . '<li>Náº¿u OK, DP, PB \'signs\' khÃ´ng xuáº¥t hiá»‡n thÃ¬ click vÃ o hÃ¬nh Ä‘á»ƒ PHP thÃ´ng bÃ¡o lá»—i gáº·p pháº£i' . '<li>Náº¿u web bá»‹ Ä‘á»©ng, báº¥m F5 hoáº·c refresh' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Táº£i hÃ¬nh lÃªn',
        'max_fsize' => 'Dung lá»±Æ¡ng tá»‘i Ä‘a cho phÃ©p lÃ  %s KB',
        'album' => 'Album',
        'picture' => 'HÃ¬nh',
        'pic_title' => 'Tá»±a Ä‘á» hÃ¬nh',
        'description' => 'MÃ´ táº£ hÃ¬nh',
        'keywords' => 'Tá»« khoÃ¡',
        'err_no_alb_uploadables' => 'KhÃ´ng cÃ³ Album Ä‘Ã³',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Quáº£n lÃ½ ngá»«Æ¡i dÃ¹ng',
        'name_a' => 'TÃªn tÄƒng dáº§n',
        'name_d' => 'TÃªn giáº£m dáº§n',
        'group_a' => 'NhÃ³m tÄƒng dáº§n',
        'group_d' => 'NhÃ³m giáº£m dáº§n',
        'reg_a' => 'NgÃ y tham gia tÄƒng dáº§n',
        'reg_d' => 'NgÃ y tham gia giáº£m dáº§n',
        'pic_a' => 'Sá»‘ hÃ¬nh tÄƒng',
        'pic_d' => 'Sá»‘ hÃ¬nh giáº£m',
        'disku_a' => 'Dung lá»±Æ¡ng tÄƒng',
        'disku_d' => 'Dung lÆ°Æ¡ng giáº£m',
        'sort_by' => 'Sáº¯p xáº¿p ngá»«Æ¡i dÃ¹ng theo',
        'err_no_users' => 'Báº£ng quáº£n lÃ½ ngá»«Æ¡i dÃ¹ng trá»‘ng !',
        'err_edit_self' => 'Báº¡n khÃ´ng thá»ƒ tá»± mÃ¬nh thay Ä‘á»•i thÃ´ng tin cÃ¡ nhÃ¢n, sá»­ dá»¥ng  \'My profile\' Ä‘á»ƒ lÃ m',
        'edit' => 'THAY Äá»”I',
        'delete' => 'XOÃ',
        'name' => 'tÃªn tÃ i khoáº£n',
        'group' => 'NhÃ³m',
        'inactive' => 'khÃ´ng hoáº¡t Ä‘á»™ng',
        'operations' => 'Há»‡ Ä‘iá»u hÃ nh',
        'pictures' => 'hÃ¬nh',
        'disk_space' => 'Dung lÆ°á»£ng cho phÃ©p xÃ i',
        'registered_on' => 'ÄÄƒng kÃ­',
        'u_user_on_p_pages' => '%d ngá»«Æ¡i trÃªn %d trang',
        'confirm_del' => 'Cháº¯c cháº¯n xoÃ¡ tÃ i khoáº£n nÃ y chá»© ? \\n Táº¥t cáº£ hÃ¬nh, nháº­n xÃ©t cá»§a há» cÅ©ng sáº½ bá»‹ xoÃ¡.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'TÃ i khoáº£n nÃ y khÃ´ng tá»“n táº¡i!',
        'modify_user' => 'Sá»­a Ä‘á»•i',
        'notes' => 'ghi chÃº',
        'note_list' => '<li>Náº¿u khÃ´ng muá»‘n thay Ä‘á»•i máº­t kháº©u thÃ¬ Ä‘á»ƒ trá»‘ng.',
        'password' => 'Máº­t kháº©u',
        'user_active' => 'TÃ i khoáº£n nÃ y Ä‘á»±Æ¡c kÃ­ch hoáº¡t',
        'user_group' => 'NhÃ³m',
        'user_email' => 'email',
        'user_web_site' => 'website ',
        'create_new_user' => 'Táº¡o tÃ i khoáº£n má»›i',
        'user_location' => 'NÆ¡i cÆ° ngá»¥',
        'user_interests' => 'Viá»‡c lÃ m',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Chá»‰nh kÃ­ch cá»¡ hÃ¬nh',

        'what_it_does' => 'NÃ³ lÃ  cÃ¡i gÃ¬',

        'what_update_titles' => 'Sá»­a tá»± Ä‘á» tá»« tÃªn file táº£i lÃªn',

        'what_delete_title' => 'XoÃ¡ tá»±a Ä‘á»',

        'what_rebuild' => 'Chá»‰nh láº¡i thumbnail vÃ  kÃ­ch cá»¡ hÃ¬nh',

        'what_delete_originals' => 'XoÃ¡ dung lá»±Æ¡ng cÅ© vÃ  thay tháº¿ vá»›i dung lÆ°Æ¡ng má»›i ',

        'file' => 'File',

        'title_set_to' => 'Ä‘áº·t tÃªn cho',

        'submit_form' => 'Gá»­i Ä‘i',

        'updated_succesfully' => 'Cáº­p nháº­t thÃ nh cÃ´ng',

        'error_create' => 'Lá»–I !',

        'continue' => 'xá»­ lÃ½ thÃªm hÃ¬nh',

        'main_success' => 'File %s Ä‘á»±Æ¡c dÃ¹ng nhÆ° hÃ¬nh chÃ­nh',

        'error_rename' => 'Lá»—i trong khoáº£ng  %s Ä‘áº¿n %s',

        'error_not_found' => 'File %s khÃ´ng tÃ¬m tháº¥y',

        'back' => 'Trá»Ÿ vá» trang chÃ­nh',

        'thumbs_wait' => 'Äang chá»‰nh sá»­a, vui lÃ²ng chá» ...',

        'thumbs_continue_wait' => 'Tiáº¿p tá»¥c chá»‰nh sá»­a ...',

        'titles_wait' => 'Sá»­a tÃªn, vui lÃ²ng chá» ...',

        'delete_wait' => 'XoÃ¡ tÃªn,  vui lÃ²ng chá» ...',

        'replace_wait' => 'Sá»­a, xoÃ¡ dung lá»±Æ¡ng cÅ©, thay vá»›i dung lÆ°Æ¡ng má»›i, vui lÃ²ng chá» ...',

        'instruction' => 'TÃ i liá»‡u nhanh',

        'instruction_action' => 'Chá»n hoáº¡t Ä‘á»™ng',

        'instruction_parameter' => 'Chá»n thÃ´ng sá»‘',

        'instruction_album' => 'chá»n album',

        'instruction_press' => 'Nháº¥n %s',

        'update' => 'Äang xá»­ lÃ½',

        'update_what' => 'CÃ¡i gÃ¬ cáº§n cáº­p nháº­t',

        'update_thumb' => 'Chá»‰thumbnails',

        'update_pic' => 'Chá»‰ chá»‰nh dung lÆ°á»£ng hÃ¬nh',

        'update_both' => 'Cáº£ thumbnails vÃ  dung lÆ°á»£ng hÃ¬nh',

        'update_number' => 'Sá»‘ láº§n thá»±c thi sau má»—i láº§n click',

        'update_option' => '(giáº£m nÃ³ xuá»‘ng náº¿u báº¡n gáº·p váº¥n Ä‘á» vá» timeout)',

        'filename_title' => 'TÃªn file &rArr; Tá»±a Ä‘á» hÃ¬nh',

        'filename_how' => 'LÃ m sao Ä‘á»ƒ Ä‘á»•i tÃªn file',

        'filename_remove' => 'xoÃ¡ file .jpg vÃ  thay tháº¿  _ vá»›i  khoáº£ng trá»‘ng',

        'filename_euro' => 'Thay 2003_11_23_13_20_20.jpg báº±ng 23/11/2003 13:20',

        'filename_us' => 'Thay 2003_11_23_13_20_20.jpg báº±ng 11/23/2003 13:20',

        'filename_time' => 'Thay 2003_11_23_13_20_20.jpg thÃ nh 13:20',

        'delete' => 'Thay tÃªn hÃ¬nh hoáº·c dung lÆ°á»£ng cá»§a hÃ¬nh',

        'delete_title' => 'XoÃ¡ tÃªn hÃ¬nh',

        'delete_original' => 'XoÃ¡ dung lÆ°á»£ng hÃ¬nh',

        'delete_replace' => 'XoÃ¡ dung lÆ°á»£ng cÅ© cá»§a hÃ¬nh vÃ  thay tháº¿ vá»›i cÃ¡i má»›i',

        'select_album' => 'Chá»n album',

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