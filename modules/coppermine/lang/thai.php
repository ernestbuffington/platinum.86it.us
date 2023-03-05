<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke Language Pack 0.9                  //
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
// to all devs: stop update just before committing this file!
// info about translators and translated language
define('PIC_VIEWS', '����');
define('PIC_VOTES', '��ǵ');
define('PIC_COMMENTS', '���Ԩ�ó�');

$lang_translation_info = array('lang_name_english' => 'English', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Thai', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'th', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'CenturY', // the name of the translator - can be a nickname
    'trans_email' => 'century_100@hotmail.com', // translator's email address (optional)
    'trans_website' => 'http://mem9.dochost.net/', // translator's website (optional)
    'trans_date' => '2003-12-10', // the date the translation was created / last modified
    );

$lang_charset = 'windows-874';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('亵�', '����亵�', '�����亵�');

// Day of weeks and months
$lang_day_of_week = array('��.', '�.', '�.', '�.', '��.', '�.', '�.');
$lang_month = array('�.�.', '�.�.', '��.�.', '��.�.', '�.�.', '��.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.');

// Some common strings
$lang_yes = '��';
$lang_no  = '���';
$lang_back = '��Ѻ';
$lang_continue = '����';
$lang_info = '��������´';
$lang_error = '�Դ��Ҵ';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y @ %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y @ %I:%M %p';
$comment_date_fmt = '%B %d, %Y @ %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
    'random' => '�ҾẺ����',
    'lastup' => '���Ҿ����ش',
    'lastupby' => '�Ҿ����ش�ͧ�ѹ', // new 1.2.2
    'lastalb' => '��ź�����Ѻ��ا����ش',// new 1.2.2
    'lastcom' => '�Ԩ�ó�����ش',
    'lastcomby' => '���Ԩ�ó�����ش�ͧ�ѹ', // new 1.2.2
    'topn' => '��Ҫ��ҡ�ش',
    'toprated' => '�ѹ�Ѻ�٧�ش',
    'lasthits' => '��Ҫ�����ش',
    'search' => '�š�ä���',
    'favpics' => '�Ҿ����ô��ҹ', // changed in cpg1.2.0nuke
    );

$lang_errors = array(
    'access_denied' => '�س������Ѻ͹حҵ���������ѧ��ǹ���',
    'perm_denied' => '�س�������ö��зӡ����',
    'param_missing' => 'Script �ӧҹ�»��Ȩҡ����÷�����',
    'non_exist_ap' => ' ����� ��ź���/�Ҿ ����ҹ���͡ !',
    'quota_exceeded' => '���鹷���Թ��˹�<br /><br />�س���Ѻ��鹷�� [quota] ����亵�  ��й��س���鹷�� [space] ����亵�, ��������ٻ�з����س���鹷���Թ��˹�',
    'gd_file_type_err' => '�������ҹ GD image library ����ö��ҹ�Ҿ�Ẻ JPEG ��� PNG ��ҹ��',
    'invalid_image' => '�Ҿ���س�觢����ջѭ�������������ö�Ѵ��ô��� GD library',
    'resize_failed' => '�������ö���ҧ thumbnail ����Ŵ��Ҵ�Ҿ��',
    'no_img_to_display' => '������Ҿ�����ʴ�',
    'non_exist_cat' => '�������Ǵ���������͡',
    'orphan_cat' => '��Ǵ�����ջѭ�� ��سҨѴ��ü�ҹ�к���èѴ����Ҿ',
    'directory_ro' => '�������ö��¹ Directory \'%s\' �� �������öź�Ҿ��',
    'non_exist_comment' => '����դ��Ԩ�ó������͡',
    'pic_in_invalid_album' => '������Ҿ���ź��� (%s)!?',
    'banned' => '�س�١������Ҫ��Ǻ䫵���',
    'not_with_udb' => '�������ö��ҹ�ѧ��ѹ������ coppermine ���ͧ�ҡ��١����Ѻ�к���дҹ���� ���ͤ���к�����ͧ�Ѻ��������ö��� �����к���дҹ�����������ö�Ѵ��ä�������ö�����',
    'members_only' => '��������ö�������੾����Ҫԡ��ҹ�� ��س���Ѥ���Ҫԡ��͹', // changed in cpg1.2.0nuke
    'mustbe_god' => '��������ö�������੾�м�������ҹ�� �س�е�ͧ�������к�㹰ҹм����� �֧������ö��ҹ��'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array(
    'alb_list_title' => '��ѧ��¡����ź���',
    'alb_list_lnk' => '��¡����ź���',
    'my_gal_title' => '��ѧ�������ǹ���',
    'my_gal_lnk' => '�������ǹ���',
    'my_prof_lnk' => '��������ǹ���',
    'adm_mode_title' => '����¹��ʶҹм�����',
    'adm_mode_lnk' => 'ʶҹм�����',
    'usr_mode_title' => '����¹��ʶҹм����ҹ',
    'usr_mode_lnk' => 'ʶҹм����',
    'upload_pic_title' => '���Ҿ�Ҿ�����ź���',
    'upload_pic_lnk' => '���Ҿ',
    'register_title' => '���ҧ��ª��ͼ����',
    'register_lnk' => 'ŧ����¹',
    'login_lnk' => '�������к�',
    'logout_lnk' => '�͡�ҡ�к�',
    'lastup_lnk' => '���Ҿ����ش',
    'lastcom_lnk' => '�Ԩ�ó�����ش',
    'topn_lnk' => '��Ҫ��ҡ�ش',
    'toprated_lnk' => '�ѹ�Ѻ�٧�ش',
    'search_lnk' => '����',
    'fav_lnk' => '�Ҿ����ô��ҹ',
    );

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => '��Ǩ�ͺ������Ҿ ',
    'config_lnk' => '��˹����',
    'albums_lnk' => '��ź���',
    'categories_lnk' => '��Ǵ����',
    'users_lnk' => '�����ҹ',
    'groups_lnk' => '�����',
    'comments_lnk' => '���Ԩ�ó�',  // changed in cpg1.2.0nuke
    'searchnew_lnk' => '�����Ҿ������ͧ',
    'util_lnk' => '��Ѻ��Ҵ�Ҿ', //not used yet
    'ban_lnk' => '���������',
    );

$lang_user_admin_menu = array(
    'albmgr_lnk' => '���ҧ��ź���',
    'modifyalb_lnk' => '�����ź���',
    'my_prof_lnk' => '��������ǹ���',
    );

$lang_cat_list = array(
    'category' => '��Ǵ����',
    'albums' => '��ź���',
    'pictures' => '�Ҿ',
    );

$lang_album_list = array(
    'album_on_page' => '%d ��ź��� �ӹǹ %d ˹��'
    );

$lang_thumb_view = array(
    'date' => '�ѹ���',
    'name' => '����',
    'sort_da' => '���§����ѹ �ҡ������ҡ',
    'sort_dd' => '���§����ѹ �ҡ�ҡ仹���',
    'sort_na' => '���§������� �ҡ������ҡ',
    'sort_nd' => '���§������� �ҡ�ҡ仹���',
    'sort_ta' => '���§����������ͧ �ҡ������ҡ',
    'sort_td' => '���§����������ͧ �ҡ�ҡ仹���',
    'pic_on_page' => '%d �Ҿ �ӹǹ %d ˹��',
    'user_on_page' => '%d �����ҹ �ӹǹ %d ˹��',
    'sort_ra' => '���§����ѹ�Ѻ �ҡ������ҡ', // new in cpg1.2.0nuke
    'sort_rd' => '���§����ѹ�Ѻ �ҡ�ҡ仹���', // new in cpg1.2.0nuke
    'rating' => '�Ѵ�ѹ�Ѻ', // new in cpg1.2.0nuke
    'sort_title' => '���§�Ҿ��:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
    'thumb_title' => '��Ѻ��ѧ˹���ʴ��Ҿ��� ',
    'pic_info_title' => '�ʴ�/��͹ ��������´�ͧ�Ҿ',
    'slideshow_title' => '�ʴ���Ŵ�',
    'slideshow_disabled' => '�������ö��ҹ e-cards ��', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => '���ҾẺ e-card',
    'ecard_disabled' => '�������ö��ҹ e-cards �� ',
    'ecard_disabled_msg' => '�س�������ö�� ecards ��',
    'prev_title' => '�Ҿ��͹˹��',
    'next_title' => '�Ҿ�Ѵ�',
    'pic_pos' => '�Ҿ %s/%s',
    'no_more_images' => '������Ҿ��������ա����', // new in cpg1.2.0nuke
    'no_less_images' => '�Ҿ��� ���Ҿ�á������', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array(
    'rate_this_pic' => '����ṹ ',
    'no_votes' => '(�ѧ����ա����ǵ)',
    'rating' => '(��ṹ : %s / 5 �ҡ %s ��ǵ)',
    'rubbish' => '����ҡ',
    'poor' => '���',
    'fair' => '����',
    'good' => '��',
    'excellent' => '���ҡ',
    'great' => '�����!',
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
    CRITICAL_ERROR => '�Դ��Ҵ�����ç',
    'file' => '��� : ',
    'line' => '��÷Ѵ : ',
    );

$lang_display_thumbnails = array(
    'filename' => '������� : ',
    'filesize' => '��Ҵ��� : ',
    'dimensions' => '��Ҵ�Ҿ : ',
    'date_added' => '����������ѹ��� : '
    );

$lang_get_pic_data = array(
    'n_comments' => '%s ���Ԩ�ó�',
    'n_views' => '%s ��Ҫ�',
    'n_votes' => '(%s ��ǵ)'
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
    0 => '�͡�ҡʶҹм����� ...',
    1 => '������ʶҹм����� ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => '��س���������ź��� !',
    'confirm_modifs' => '������ ������¹�ŧ��ҹ�� ?',
    'no_change' => '�س�ѧ���������¹�ŧ���� !',
    'new_album' => '��ź�������',
    'confirm_delete1' => '������ ��ź��ź������ ?',
    'confirm_delete2' => '\n �Ҿ��Ф��Ԩ�ó�������ж١ź !',
    'select_first' => '��س����͡��ź�����͹',
    'alb_mrg' => '�к��Ѵ�����ź���',
    'my_gallery' => '*  �������ǹ���*',
    'no_category' => '* �������Ǵ���� *',
    'delete' => 'ź',
    'new' => '���ҧ����',
    'apply_modifs' => '�ѹ�֡�������¹�ŧ',
    'select_category' => '���͡��Ǵ����',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => '���������Ѻ \'%s\'���١��ͧ !',
    'unknown_cat' => '�������Ǵ���������͡',
    'usergal_cat_ro' => '�������öź������� !',
    'manage_cat' => '�Ѵ�����Ǵ����',
    'confirm_delete' => '������ ��ź��Ǵ������',
    'category' => '��Ǵ����',
    'operations' => '��з�',
    'move_into' => '������ѧ',
    'update_create' => '��Ѻ��ا/���ҧ��Ǵ����',
    'parent_cat' => '��Ǵ������ѡ',
    'cat_title' => '������Ǵ����',
    'cat_desc' => '��������´��Ǵ����'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => '��˹����',
    'restore_cfg' => '��Ѻ�ѧ������',
    'save_cfg' => '�ѹ�֡�������',
    'notes' => '�ѹ�֡',
    'info' => '��������´',
    'upd_success' => '��Ѻ��ا��Ңͧ Coppermine ����',
    'restore_success' => '��Ѻ���������ͧ Coppermine ����',
    'name_a' => '���� �ҡ������ҡ',
    'name_d' => '���� �ҡ�ҡ仹���',
    'title_a' => '�������ͧ �ҡ������ҡ',
    'title_d' => '�������ͧ �ҡ�ҡ仹���',
    'date_a' => '�ѹ��� �ҡ������ҡ',
    'date_d' => '�ѹ��� �ҡ�ҡ仹���',
    'rating_a' => '�ѹ�Ѻ �ҡ������ҡ', // new in cpg1.2.0nuke
    'rating_d' => '�ѹ�Ѻ �ҡ�ҡ仹���', // new in cpg1.2.0nuke
    'th_any' => '��Ҵ�ҡ�ش',
    'th_ht' => '�٧',
    'th_wd' => '���ҧ',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
    '��駤�ҷ����',
    array('��������� ', 'gallery_name', 0),
    array('��������´����� ', 'gallery_description', 0),
    array('E-mail ����������� ', 'gallery_admin_email', 0),
    array('address ����Ѻ links  \'���Ҿ�ա...\' �ͧ e-cards', 'ecards_more_pic_target', 0),
    array('����', 'lang', 5),
// for postnuke change
        array('���', 'cpgtheme', 6),
        array('�������ͧ����к�᷹ >Coppermine', 'nice_titles', 1),
    array('�ʴ����ٷҧ��ҹ������', 'right_blocks', 1), // new 1.2.2
    '�ʴ���ź���',
    array('�������ҧ���ҧ��ѡ (pixels or %)', 'main_table_width', 0),
    array('�ӹǹ�дѺ�ͧ��Ǵ����', 'subcat_level', 0),
    array('�ӹǹ��ź���', 'albums_per_page', 0),
    array('�ӹǹʴ���ͧ��ź���', 'album_list_cols', 0),
    array('��Ҵ�ͧ�ҾẺ��� ˹��� pixels', 'alb_list_thumb_size', 0),
    array('�����Ңͧ˹�Ҩ���ѡ', 'main_page_layout', 0),
    array('�ʴ��ӴѺ�á�ͧ�Ҿ��Ҵ��ͧ͢��ź������Ǵ', 'first_level', 1), 

    '�ʴ��ҾẺ���',
    array('�ӹǹʴ����˹���ҾẺ���', 'thumbcols', 0),
    array('�ӹǹ���˹���ҾẺ���', 'thumbrows', 0),
    array('�ӹǹᶺ�ҡ�ش�����ʴ�', 'max_tabs', 0),
    array('�ʴ���ͤ�������˹��������ҾẺ���', 'caption_in_thumbview', 1),
    array('�ʴ��ӹǹ���Ԩ�ó�������ҾẺ���', 'display_comment_count', 1),
    array('������§�ӴѺ�Ҿ�»�����', 'default_sort_order', 3),
    array('�ӹǹ���·���ش�ͧ�����ǵ����Ѻ�Ҿ�����ʴ����¡�÷������ҡ����ش', 'min_votes_for_rating', 0),
    array('�������ͧ�ͧ�Ҿ��Ҵ��� ��Ф��Ӥѭ᷹��������´�Ҿ', 'seo_alts', 1), // new in cpg1.2.0nuke

    '��õ�駤�ҡ���Ԩ�ó�ͧ����ʴ��Ҿ',
    array('�������ҧ�ͧ���ҧ�ͧ����ʴ��Ҿ(pixels or %)', 'picture_table_width', 0),
    array('�ʴ���������´�ͧ�Ҿ�»�����', 'display_pic_info', 1),
    array('��ͧ����Һ㹤��Ԩ�ó�', 'filter_bad_words', 1),
    array('���ٻ����㹤��Ԩ�ó���', 'enable_smilies', 1),
    array('���������餹���ǡѹ�Ԩ�ó����¤��駵Դ��͡ѹ� 1 �Ҿ ', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
    array('Email ��ѧ������ ������դ��Ԩ�ó�' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
    array('��������ҡ�ش�ͧ�ӨӡѴ�����ͧ�Ҿ', 'max_img_desc_length', 0),
    array('�ӹǹ�ѡ����ҡ�ش', 'max_com_wlength', 0),
    array('�ӹǹ��÷Ѵ�ҡ�ش', 'max_com_lines', 0),
    array('��������ҡ�ش�ͧ���Ԩ�ó�', 'max_com_size', 0),
    array('�ʴ�ᶺ�����', 'display_film_strip', 1),
    array('�ӹǹ�ҡ�ش�ͧ�Ҿᶺ�����', 'max_film_strip_items', 0),
    array('�������������ʧ���͡������Ҿ��Ҵ��� ', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',		


    '��õ�駤���Ҿ����ҾẺ���',
    array('�س�Ҿ�ͧ��� JPEG ', 'jpeg_qual', 0),
    array('�������ҧ���ͤ����٧�ҡ�ش�ͧ�ҾẺ��� <strong>*</strong>', 'thumb_width', 0),
    array('�颹Ҵ�Ҿ ( �������ҧ ���ͤ����٧�ͧ�ҾẺ��� )<strong>*</strong>', 'thumb_use', 7),
    array('���ҧ�Ҿ㹷ѹ��','make_intermediate',1),
    array('�������ҧ���ͤ����٧�ҡ�ش�ͧ�Ҿ����ʴ�㹷ѹ�� <strong>*</strong>', 'picture_width', 0),
    array('��Ҵ�ҡ�ش�ͧ�Ҿ���������� (KB)', 'max_upl_size', 0),
    array('�������ҧ���ͤ����٧�ҡ�ش�ͧ�Ҿ���������� (pixels)', 'max_upl_width_height', 0),

    '��駤�Ҽ����ҹ',
    array('͹حҵ����ա��ŧ����¹�����ҹ����', 'allow_user_registration', 1),
    array('��ͧ�׹�ѹ email ����Ѻ���ŧ����¹', 'reg_requires_valid_email', 1),
    array('����������ҹ 2 �� �� email ��ӡѹ', 'allow_duplicate_emails_addr', 1),
    array('�����ҹ����ö����ź�����ǹ���', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

    '��Ŵ����˹��ͧ����Ѻ�ӨӡѴ�����ͧ�Ҿ (�������ҧ �������ͧ�����ҹ)',
    array('���Ϳ�Ŵ� 1', 'user_field1_name', 0),
    array('���Ϳ�Ŵ� 2 ', 'user_field2_name', 0),
    array('���Ϳ�Ŵ� 3 ', 'user_field3_name', 0),
    array('���Ϳ�Ŵ� 4 ', 'user_field4_name', 0),

    '��駤��Ẻ����˹�Ңͧ�Ҿ����ҾẺ���',
    array('�ʴ��ѭ�ѡɳ���ź�����ǹ��� ����Ѻ�������������������к�', 'show_private', 1),
    array('�ѡ��е�ͧ����㹪������', 'forbiden_fname_char',0),
    array('���ʡ�Ţͧ�Ҿ����������������', 'allowed_file_extensions',0),
    array('�Ըա��Ŵ��Ҵ�Ҿ','thumb_method',2),
    array('�������ͧ����ŧ�Ҿ�ͧ ImageMagick (�� /usr/bin/X11/)', 'impath', 0),
    array('��Դ�ͧ�Ҿ���͹حҵ(������Ѻ ImageMagick ��ҹ��)', 'allowed_img_types',0),
    array('����������������Ѻ ImageMagick', 'im_options', 0),
    array('��ҹ������ EXIF ���� JPEG ', 'read_exif_data', 1),
    array('��ҹ������ IPTC ���� JPEG ', 'read_iptc_data', 1), // new in cpg1.2.0nuke
    array('directory �ͧ��ź��� <strong>*</strong>', 'fullpath', 0),
    array('directory ����Ѻ��ź����ͧ�����ҹ <strong>*</strong>', 'userpics', 0),
    array('�ӹ�˹������Ѻ�Ҿ㹷ѹ�� <strong>*</strong>', 'normal_pfx', 0),
    array('�ӹ�˹������Ѻ�ҾẺ��� <strong>*</strong>', 'thumb_pfx', 0),
    array('����»����¢ͧ directory', 'default_dir_mode', 0),
    array('����»����¢ͧ�Ҿ', 'default_file_mode', 0),
    array('�ʴ��������', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
    array('�ʴ�������ź���', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
    array('�ʴ���Ҵ���', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
    array('�ʴ���Ҵ�Ҿ', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
    array('�ʴ��ӹǹ�Ѻ', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
    array('�ʴ� URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
    array('�ʴ� URL ��ٻẺ�ԧ�� bookmark ', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
    array('�ʴ��ԧ����ź�������ô��ҹ', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke

    '��õ�駤�� Cookies ',
    array('���ͧ͢ cookie �����ҹ�� script', 'cookie_name', 0),
    array('�������ͧ cookie �����ҹ�� script', 'cookie_path', 0),
    array('�����ѡ���', 'charset', 4),

    '��駤������',
    array('�� debug mode', 'debug_mode', 1),
    array('�Դ��ҹ debug mode Ẻ����˹��', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
    array('�ʴ�����͹��û�Ѻ��ا coppermine ��������к�', 'showupdate', 1), // new 1.2.2
    '<br /><div align="center">(*) ��ͧ����� * �е�ͧ����ա������¹�ŧ ����ҡ�س���ٻ����� gallery ����</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => '��س����������Ф��Ԩ�ó�',
    'com_added' => '�������Ԩ�ó�����',
    'alb_need_title' => '��س�����������ͧ�ͧ��ź��� !',
    'no_udp_needed' => '�����繵�ͧ��Ѻ��ا',
    'alb_updated' => '��ź������Ѻ��û�Ѻ��ا����',
    'unknown_album' => '�������ź������س���͡ ���ͤس������Է������Ҿ�����ź���',
    'no_pic_uploaded' => '����ա�����Ҿ�����!<br /><br />��Ҥس���͡�Ҿ���������ǡ�سҵ�Ǩ�ͺ��õ�駤��͹حҵ����Ѻ������',
    'err_mkdir' => '�������ö���ҧ directory %s !',
    'dest_dir_ro' => 'directory ���·ҧ %s �������ö��¹�� ��script !',
    'err_move' => '�������ö����͹���� %s ��ѧ %s !',
    'err_fsize_too_large' => '��Ҵ�ͧ�Ҿ���س��������˭��Թ� (��Ҵ�ҡ�ش���͹حҵ ��� %s x %s) !',
    'err_imgsize_too_large' => '��Ҵ�ͧ�����س��������˭��Թ�  (��Ҵ�ҡ�ش���͹حҵ ��� %s ����亵�) !',
    'err_invalid_img' => '�ٻẺ�ͧ�����س����������١��ͧ !',
    'allowed_img_types' => '�س����ö���Ҿ�������§ %s �Ҿ',
    'err_insert_pic' => '�������ö���Ҿ  \'%s\' �����ź����� ',
    'upload_success' => '���Ҿ���º��������<br /><br />���ʴ��� ����ͼ��������Ǩ�ͺ����',
    'info' => '��������´',
    'com_added' => '�������Ԩ�ó�����',
    'alb_updated' => '��Ѻ��ا��ź�������',
    'err_comment_empty' => '���Ԩ�ó�ͧ�س��ҧ���� !',
    'err_invalid_fext' => '�����͹حҵ�е�ͧ�չ��ʡ�� : <br /><br />%s.',
    'no_flood' => '����㨴��� ���ͧ�ҡ�س�繼����¹���Ԩ�ó�����ش<br /><br />�س���Ҷ��䢤��Ԩ�ó�ͧ�س����ҹ��',
    'redirect_msg' => '�س���ѧ�١����ѧ<br /><br /><br />������ \'����\' ����ҡ�ѧ����ա������¹˹�Ҩ�',
    'upl_success' => '�����Ҿ�ͧ�س���º��������',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => '��ͤ�������˹��',
    'fs_pic' => '�Ҿ��Ҵ���',
    'del_success' => 'ź���º��������',
    'ns_pic' => '��Ҵ�Ҿ����',
    'err_del' => '�������öź��',
    'thumb_pic' => '�ҾẺ���',
    'comment' => '���Ԩ�ó�',
    'im_in_alb' => '�Ҿ���ź���',
    'alb_del_success' => 'ź��ź���  \'%s\' ',
    'alb_mgr' => '�к��Ѵ�����ź���',
    'err_invalid_data' => '�դ����Դ��Ҵ�ͧ������� \'%s\'',
    'create_alb' => '���ҧ��ź��� \'%s\'',
    'update_alb' => '��Ѻ��ا��ź��� \'%s\' �����������ͧ  \'%s\' ��дѪ�� \'%s\'',
    'del_pic' => 'ź�Ҿ',
    'del_alb' => 'ź��ź���',
    'del_user' => 'ź�����ҹ',
    'err_unknown_user' => '����ռ����ҹ������͡ !',
    'comment_deleted' => 'ź���Ԩ�ó����º��������',
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
    'confirm_del' => '�س������ ��ź�Ҿ��� ? \\n ���Ԩ�ó�ж١ź仴���',
    'del_pic' => 'ź�Ҿ',
    'size' => '%s x %s pixels',
    'views' => '%s ����',
    'slideshow' => '�ʴ���Ŵ�',
    'stop_slideshow' => '��ش����ʴ���Ŵ�',
    'view_fs' => '���Ҿ��Ҵ���',
    'edit_pic' => '�����������´�ͧ�Ҿ', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array(
    'title' =>'��������´�ͧ�Ҿ',
    'Filename' => '�������',
    'Album name' => '������ź���',
    'Rating' => '�ѹ�Ѻ (%s ��ǵ)',
    'Keywords' => '���Ӥѭ',
    'File Size' => '��Ҵ���',
    'Dimensions' => '��Ҵ�Ҿ',
    'Displayed' => '�ʴ�����ǡѺ',
    'Camera' => '���ͧ',
    'Date taken' => '����������ѹ���',
    'Aperture' => '���Ѻ�ʧ',
    'Exposure time' => '���������Ѻ�ʧ',
    'Focal length' => '�������⿡��',
    'Comment' => '���Ԩ�ó�',
    'addFav' => '������ѧ��ź�������ô��ҹ',//different in 1.2.0nuke
    'addFavPhrase' => '�ô��ҹ', // new in cpg1.2.0different in 1.2.0nuke
    'remFav' => 'ź�͡�ҡ��ź�������ô��ҹ',
    'iptcTitle' => '�������ͧ IPTC ', // new in cpg1.2.0nuke
    'iptcCopyright' => '�Ԣ�Է��� IPTC ', // new in cpg1.2.0nuke
    'iptcKeywords' => '���Ӥѭ IPTC ', // new in cpg1.2.0nuke
    'iptcCategory' => '��Ǵ IPTC ', // new in cpg1.2.0nuke
    'iptcSubCategories' => '��Ǵ���� IPTC ', // new in cpg1.2.0nuke
    'bookmark_page' => 'Bookmark �Ҿ ', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array(
    'OK' => '��ŧ',
    'edit_title' => '��䢤��Ԩ�ó�',
    'confirm_delete' => '�س�����Ҩ�ź���Ԩ�ó��� ?',
    'add_your_comment' => '�������Ԩ�ó�',
    'name' => '����',
    'comment' => '���Ԩ�ó�',
    'your_name' => '���ͧ͢�س',
        );

    $lang_fullsize_popup = array('click_to_close' => '������Ҿ ���ͻԴ˹�ҵ�ҧ���',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array(
    'title' => '���� e-card',
    'invalid_email' => '<strong>����͹</strong> : email ���١��ͧ !',
    'ecard_title' => ' e-card �ҡ %s �֧�س',
    'view_ecard' => '����ҡ e-card �ʴ������١��ͧ ��سҡ� link ���',
    'view_more_pics' => '�� link ������ʹ��Ҿ�����ա !',
    'send_success' => '�� ecard ���º��������',
    'send_failed' => '������ ����ͧ�������������ö��  e-card �ͧ�س��',
    'from' => '�ҡ',
    'your_name' => '���ͧ͢�س',
    'your_email' => 'email �ͧ�س',
    'to' => '�֧',
    'rcpt_name' => '�������Ѻ',
    'rcpt_email' => 'email ����Ѻ',
    'greetings' => '���ʴ������Թ��',
    'message' => '��ͤ���',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => '��������´�Ҿ',
    'album' => '��ź���',
    'title' => '�������ͧ',
    'desc' => '�ӨӡѴ����',
    'keywords' => '���Ӥѭ',
    'pic_info_str' => '%sx%s - %s ����亵� - ��Ҫ� %s ���� - %s ��ǵ',
    'approve' => '�Ҿ�������Ѻ',
    'postpone_app' => '����͹�������Ѻ',
    'del_pic' => 'ź�Ҿ',
    'read_exif' => '��ҹ������ EXIF �ա����', // new in cpg1.2.0nuke
    'reset_view_count' => '��駤�ҵ�ǹѺ�����Ҫ�����',
    'reset_votes' => '��駤����ǵ����',
    'del_comm' => 'ź���Ԩ�ó�',
    'upl_approval' => '��Ǩ�ͺ�Ҿ����������',
    'edit_pics' => '����Ҿ',
    'see_next' => '�Ҿ����',
    'see_prev' => '�Ҿ��͹˹��',
    'n_pic' => '%s �Ҿ',
    'n_of_pic_to_disp' => '�ӹǹ�Ҿ����ʴ�',
    'apply' => '�ѹ�֡�������¹�ŧ'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => '���͡����',
    'disk_quota' => '�ǵ�Ҿ�鹷��',
    'can_rate' => '����ö�Ѵ�дѺ�Ҿ (rate)��',
    'can_send_ecards' => '����ö�� ecards ��',
    'can_post_com' => '����ö�Ԩ�ó���',
    'can_upload' => '����ö���Ҿ��',
    'can_have_gallery' => '����ö���������ǹ�����',
    'apply' => '�ѹ�֡�������¹�ŧ',
    'create_new_group' => '���ҧ���������',
    'del_groups' => 'ź�����������͡',
    'confirm_del' => '����͹ !! �����ź��������� ��Ҫԡ㹡������鹨ж١������ѧ�����  \'ŧ����¹\' ᷹!\n\n��ͧ��÷ӵ��������� ?',
    'title' => '�Ѵ��á����',
    'approval_1' => '��Ǩ�ͺ������Ҿ�Ҹ�ó� (1)',
    'approval_2' => '��Ǩ�ͺ������Ҿ��ǹ��� (2)',
    'note1' => '<strong>(1)</strong> ������Ҿ�����ź����Ҹ�ó� �е�ͧ���Ѻ��õ�Ǩ�ͺ�ҡ������',
    'note2' => '<strong>(2)</strong> ������Ҿ�����ź�����ǹ��� �е�ͧ���Ѻ��õ�Ǩ�ͺ�ҡ������',
    'notes' => '�ѹ�֡'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array(
    'welcome' => '�Թ�յ�͹�Ѻ !'
        );

    $lang_album_admin_menu = array(
    'confirm_delete' => '�س�����Ҩ�ź��ź������ ? \\n�Ҿ��Ф��Ԩ�ó�������ж١ź仴���',
    'delete' => 'ź',
    'modify' => '�س���ѵ�',
    'edit_pics' => '����Ҿ',
        );

    $lang_list_categories = array(
    'home' => '˹���á',
    'stat1' => '<strong>[pictures]</strong> �Ҿ  � <strong>[albums]</strong> ��ź��� ��� <strong>[cat]</strong> ��Ǵ����  <strong>[comments]</strong> ���Ԩ�ó�  �ա����Ҫ�<strong>[views]</strong> ����',
    'stat2' => '<strong>[pictures]</strong>�Ҿ � <strong>[albums]</strong> ��ź��� �ա����Ҫ� <strong>[views]</strong> ����',
    'xx_s_gallery' => '%s\'s �����',
    'stat3' => '<strong>[pictures]</strong> �Ҿ � <strong>[albums]</strong> ��ź���  <strong>[comments]</strong> ���Ԩ�ó� �ա����Ҫ� <strong>[views]</strong> ����'
        );

    $lang_list_users = array(
    'user_list' => '��ª��ͼ����ҹ',
    'no_user_gal' => '����ռ����ҹ������Ѻ͹حҵ�������ź��� ',
    'n_albums' => '%s ��ź���',
    'n_pics' => '%s �Ҿ'
        );

    $lang_list_albums = array(
    'n_pictures' => '%s �Ҿ',
    'last_added' => ', ��������ش����� %s'
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
    'upd_alb_n' => '��Ѻ��ا��ź��� %s',
    'general_settings' => '��駤�ҷ����',
    'alb_title' => '�������ͧ��ź���',
    'alb_cat' => '��Ǵ������ź���',
    'alb_desc' => '�ӨӡѴ������ź���',
    'alb_thumb' => '�ҾẺ��ͧ͢��ź���',
    'alb_perm' => '���͹حҵ����Ѻ��ź���',
    'can_view' => '��ź��� ����ö������',
    'can_upload' => '��������͹����ö���Ҿ��',
    'can_post_comments' => '��������͹����ö�Ԩ�ó���',
    'can_rate' => '��������͹����ö�Ѵ�дѺ�Ҿ��',
    'user_gal' => '����բͧ�����ҹ',
    'no_cat' => '* �������Ǵ���� *',
    'alb_empty' => '�������ź���',
    'last_uploaded' => '���Ҿ����ش',
    'public_alb' => '��ź����Ҹ�ó�',
    'me_only' => '��ź�����ǹ���',
    'owner_only' => '��Ңͧ��ź��� (%s) ��ҹ��',
    'groupp_only' => '��Ҫԡ����� \'%s\' ',
    'err_no_alb_to_modify' => '�������ź������س����ö��� 㹰ҹ������',
    'update' => '��Ѻ��ا��ź���'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => '������ �س��Ѵ�дѺ�Ҿ�������',
    'rate_ok' => '�����ǵ�ͧ�س���Ѻ�������Ѻ',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
�������к��ͧ {SITE_NAME} ����ö�������ź�Ҿ���͢������� �͡��㹷ѹ�� ������ͧ�ҡ�������ö��Ǩ�ͺ����ʴ������Դ���������� �ѧ��鹾֧���֡������� ����ʴ������Դ��繵�ҧ��繢ͧ�����¹ �������Ǣ�ͧ�Ѻ�����������ҧ� (¡����繡���ʴ������Դ����¼������ͧ) ��������Ѻ�Դ�ͺ�������<br />
<br />
�س�е�ͧ������Ҿ���ͤ��Ԩ�ó��������١��ͧ  ����͹Ҩ�� ������¼����� ������´��ҡ��� �ء��������� ����ͧ����ǡѺ���� ������ʴ����㴷���Ҩ�Դ������ ��������к��ͧ {SITE_NAME} ���Է������ź���������������´���ʹ����  㹰ҹм����ҹ�س�е�ͧ����Ѻ��������´�ء���ҧ���س���������㹰ҹ������ ��觢���������ҹ�� ������ա���Դ�µ���Ҹ�ó��»��Ȩҡ����Թ����ͧ�س ��� �������к�������Ѻ�Դ�ͺ���͡��������¢ͧ������<br />
<br />
�Ǻ䫵��� �ա���� cookies 㹡�úѹ�֡�����ŷ������ͧ����١���� ��� cookies �����繢��������ͻ�Ѻ��ا��ԡ������Դ�����֧��㨢ͧ�س��ҹ�� email �ж١�������׹�ѹ�����š��ŧ����¹��ҹ��<br />
<br />
��سҡ����� '����Ѻ' ����ҡ�س��繴���
EOT;

    $lang_register_php = array(
    'page_title' => 'ŧ����¹�����ҹ',
    'term_cond' => '��͵�ŧ㹡����ҹ',
    'i_agree' => '����Ѻ',
    'submit' => 'ŧ����¹',
    'err_user_exists' => '���ͷ��س���͡�ռ��������  ��س����͡�������',
    'err_password_mismatch' => '���ʼ�ҹ 2 �������ç�ѹ ��سҡ�͡����',
    'err_uname_short' => '���ͼ���� �е�ͧ�դ����������ӡ��� 2 ����ѡ��',
    'err_password_short' => '���ʼ�ҹ �е�ͧ�դ����������ӡ��� 2 ����ѡ��',
    'err_uname_pass_diff' => '���ͼ���� �Ѻ ���ʼ�ҹ �е�ͧ�������͹�ѹ',
    'err_invalid_email' => 'Email ���١��ͧ',
    'err_duplicate_email' => '�ռ��ŧ����¹���� email �������',
    'enter_info' => '��������´���ŧ����¹',
    'required_info' => '�����Ũ���',
    'optional_info' => '�������������',
    'username' => '���ͼ����',
    'password' => '���ʼ�ҹ',
    'password_again' => '�׹�ѹ���ʼ�ҹ',
    'email' => 'Email',
    'location' => '�������',
    'interests' => '����ʹ�',
    'website' => 'Home page',
    'occupation' => '�Ҫվ',
    'error' => '�Դ��Ҵ',
    'confirm_email_subject' => '�׹�ѹ���ŧ����¹�ͧ %s ',
    'information' => '��������´',
    'failed_sending_email' => '�������ö�� email  �׹�ѹ���ŧ����¹��!',
    'thank_you' => '�͢ͺ�س���ŧ����¹<br /><br /> �����š���Դ��ҹ�ѭ�բͧ�س�ж١����ѧ email ���س�к����',
    'acct_created' => '�ѭ�ռ����ͧ�س�١���ҧ����  ��Фس����ö�������к����� ���ͼ����������ʼ�ҹ�ͧ�س����',
    'acct_active' => '�ѭ�ռ����ͧ�س����ö��ҹ������ ��Фس����ö�������к����� ���ͼ����������ʼ�ҹ�ͧ�س����',
    'acct_already_act' => '�ѭ�ռ����ͧ�س�Դ��ҹ���� !',
    'acct_act_failed' => '�������ö�Դ��ҹ�ѭ�ռ������ !',
    'err_unk_user' => '����ռ����ҹ���س���͡ !',
    'x_s_profile' => '�����Ţͧ %s\'s ',
    'group' => '�����',
    'reg_date' => '������������',
    'disk_usage' => '��鹷�������',
    'change_pass' => '����¹���ʼ�ҹ',
    'current_pass' => '���ʼ�ҹ�Ѩ�غѹ',
    'new_pass' => '���ʼ�ҹ����',
    'new_pass_again' => '�׹�ѹ���ʼ�ҹ����',
    'err_curr_pass' => '���ʼ�ҹ�Ѩ�غѹ���١��ͧ',
    'apply_modif' => '�ѹ�֡�������¹�ŧ',
    'change_pass' => '����¹���ʼ�ҹ',
    'update_success' => '��Ѻ��ا����������',
    'pass_chg_success' => '����¹���ʼ�ҹ����',
    'pass_chg_error' => '���ʼ�ҹ�������¹�ŧ'
        );

    $lang_register_confirm_email = <<<EOT
�͢ͺ�س����Ѻ���ŧ����¹��� {SITE_NAME}

���ͼ���� : "{USER_NAME}"
���ʼ�ҹ : "{PASSWORD}"

㹡���Դ�ѭ�ռ����ҹ �س�е�ͧ����� link ��ҧ��ҧ���
���� copy ���� paste 㹺�������

{ACT_LINK}

���ʴ������Ѻ���,

�������к� {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => '���ǹ���Ԩ�ó�',
    'no_comment' => '����դ��Ԩ�ó�',
    'n_comm_del' => 'ź %s ���Ԩ�ó� ',
    'n_comm_disp' => '�ӹǹ���Ԩ�ó�����ʴ�',
    'see_prev' => '�١�͹˹��',
    'see_next' => '�ٶѴ�',
    'del_comm' => 'ź���Ԩ�ó���١���͡',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(
    0 => '�����Ҿ',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => '���Ҿ����',
    'select_dir' => '���͡ directory',
    'select_dir_msg' => '���¤���觹�� �س����ö���Ҿ������ͧ���ѧ����ͧ�������¼�ҹ�ҧ FTP<br /><br />��س����͡ directory ����ͧ������Ҿ',
    'no_pic_to_add' => '������Ҿ��������',
    'need_one_album' => '㹡�������觹�� �س�е�ͧ�����ҧ���� 1 ��ź���',
    'warning' => '����͹',
    'change_perm' => '�ش������������ö�ѹ�֡ directory ����� �س�е�ͧ����¹ mode �� 755 ���� 777 ��͹���зӡ�������Ҿ !',
    'target_album' => '<strong>�����Ҿ &quot;</strong>%s<strong>&quot; ��ѧ </strong>%s',
    'folder' => '������',
    'image' => '�Ҿ',
    'album' => '��ź���',
    'result' => '�ʴ���',
    'dir_ro' => '�������ö�ѹ�֡�� ',
    'dir_cant_read' => '�������ö��ҹ��. ',
    'insert' => '�����Ҿ����������',
    'list_new_pic' => '�ʴ���¡���Ҿ����',
    'insert_selected' => '�����Ҿ������͡',
    'no_pic_found' => '��辺�Ҿ����',
    'be_patient' => '��س��ͫѡ���� ���ͧ�ҡ�ش����觵�ͧ������㹡�������Ҿ',
    'notes' =>  '<ul>'.
                '<li><strong>OK</strong> : ���¶֧ �����Ҿ�����'.
                '<li><strong>DP</strong> : ���¶֧ ���Ҿ��� ��������������㹰ҹ������'.
                '<li><strong>PB</strong> : ���¶֧ �������ö�����Ҿ�� ��سҵ�Ǩ�ͺ��ҵԴ�����С��͹حҵ�ͧ directories ���١��ͧ'.
                '<li>����ҡ �ѭ�ѡɳ� OK, DP, PB ����ҡ�  ��顴���Ҿ����ջѭ�����ʹ٢�ͼԴ��Ҵ����Դ���'.
                '<li>����ҡ��������������� ��سҡ����� Refresh '.
                '</ul>',
        'select_album' => '���͡��ź���', // new in nuke
        'no_album' => '�ѧ��������͡��ź��� ��سҡ�Ѻ����͡��ź�������ͧ��è������Ҿ',
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
    'title' => '���Ҿ',
    'max_fsize' => '��Ҵ����˭��ش���͹حҵ ���  %s KB',
    'album' => '��ź���',
    'picture' => '�Ҿ',
    'pic_title' => '�������ͧ�Ҿ',
    'description' => '�ӨӡѴ����',
    'keywords' => '���Ӥѭ (�¡�ҡ�ѹ���ª�ͧ��ҧ)',
    'err_no_alb_uploadables' => '������ �������ź������س����ö���Ҿ��',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => '�Ѵ��ü����ҹ',
    'name_a' => '���� �ҡ������ҡ',
    'name_d' => '���� �ҡ�ҡ仹���',
    'group_a' => '����� �ҡ������ҡ',
    'group_d' => '����� �ҡ�ҡ仹���',
    'reg_a' => '�ѹ���ŧ����¹ �ҡ������ҡ',
    'reg_d' => '�ѹ���ŧ����¹ �ҡ�ҡ仹���',
    'pic_a' => '�ӹǹ�Ҿ �ҡ������ҡ',
    'pic_d' => '�ӹǹ�Ҿ �ҡ�ҡ仹���',
    'disku_a' => '������鹷�� �ҡ������ҡ',
    'disku_d' => '������鹷�� �ҡ�ҡ仹���',
    'sort_by' => '�Ѵ���§�����ҹ��',
    'err_no_users' => '���ҧ�����ҹ��ҧ���� !',
    'err_edit_self' => '�س�������ö��䢢�������ǹ�����  ����� link  \'��������ǹ���\' ᷹',
    'edit' => '���',
    'delete' => 'ź',
    'name' => '���ͼ����',
    'group' => '�����',
    'inactive' => '���ӧҹ',
    'operations' => '��á�з�',
    'pictures' => '�Ҿ',
    'disk_space' => '��鹷���� / ��鹷���˹�',
    'registered_on' => 'ŧ����¹ �����',
    'u_user_on_p_pages' => '%d �����ҹ �ӹǹ %d ˹��',
    'confirm_del' => '�س��㨷���ź�����ҹ����� ? \\n�Ҿ�����ź����������ͧ�Ҩж١ź仴���',
    'mail' => '���',
    'err_unknown_user' => '����ռ����ҹ���س���͡ !',
    'modify_user' => '����¹�ŧ�����ҹ',
    'notes' => '�ѹ�֡',
    'note_list' => '<li>��Ҥس����ͧ�������¹�ŧ���ʼ�ҹ�Ѩ�غѹ ��سһ������ҧ��Ŵ� "���ʼ�ҹ" ',
    'password' => '���ʼ�ҹ',
    'user_active_cp' => '���������ö��ҹ��', // different var in cpg1.2.0nuke
    'user_group_cp' => '������ͧ�����', // different var in cpg1.2.0nuke
    'user_email' => 'email',
    'user_web_site' => 'web site',
    'create_new_user' => '���ҧ���������',
   'user_from' => 'ʶҹ�������', // different var in cpg1.2.0nuke
    'user_interests' => '����ʹ�',
    'user_occ' => '�Ҫվ', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '��Ѻ��Ҵ�Ҿ',
        'what_it_does' => '�����ѧ�',
        'what_update_titles' => '��Ѻ��ا�������ͧ�ҡ�������',
        'what_delete_title' => 'ź�������ͧ',
        'what_rebuild' => '���ҧ�Ҿ��Ҵ��� ��л�Ѻ��Ҵ�Ҿ����',
        'what_delete_originals' => 'ź��Ҵ�Ҿ�鹩�Ѻ ���᷹��������蹷���Ѻ��Ҵ����',
        'file' => '���',
        'title_set_to' => '����������ͧ��',
        'submit_form' => '��ŧ',
        'updated_succesfully' => '��Ѻ��ا���º��������',
        'error_create' => '�բ�ͼԴ��Ҵ㹡�����ҧ',
        'continue' => '���Թ��áѺ�Ҿ�����ա',
        'main_success' => '��� %s �١�����Ҿ��ѡ����',
        'error_rename' => '�բ�ͼԴ��Ҵ㹡������¹���ͨҡ  %s ��� %s',
        'error_not_found' => '��辺��� %s ',
        'back' => '��Ѻ��ѧ˹�Ҩ���ѡ',
        'thumbs_wait' => '���ѧ��Ѻ��ا�Ҿ��Ҵ��� ���/���ͻ�Ѻ��Ҵ�Ҿ  ��س��ͫѡ����...',
        'thumbs_continue_wait' => '���ѧ���Թ��û�Ѻ��ا�Ҿ��Ҵ��� ���/���� ��Ѻ��Ҵ�Ҿ...',
        'titles_wait' => '���ѧ��Ѻ��ا�������ͧ  ��س��ͫѡ����...',
        'delete_wait' => '���ѧź�������ͧ  ��س��ͫѡ����...',
        'replace_wait' => '���ѧź�鹩�Ѻ ���᷹�������Ҿ����Ѻ��Ҵ���� ��س��ͫѡ����..',
        'instruction' => '���й�Ẻ��觴�ǹ',
        'instruction_action' => '���͡��¡�÷���ͧ���',
        'instruction_parameter' => '��駤�ҵ�ҧ�',
        'instruction_album' => '���͡��ź���',
        'instruction_press' => '�� %s',
        'update' => '��Ѻ��ا�Ҿ��Ҵ��� ���/���ͻ�Ѻ��Ҵ�Ҿ',
        'update_what' => '�зӡ�û�Ѻ��ا����',
        'update_thumb' => '੾���Ҿ��Ҵ���',
        'update_pic' => '੾�л�Ѻ��Ҵ�Ҿ',
        'update_both' => '����Ҿ��Ҵ��� ��л�Ѻ��Ҵ�Ҿ',
        'update_number' => '�ӹǹ�Ҿ�����Թ��õ�ͤ���',
        'update_option' => '(��������駤������� ��Ҥس���ջѭ������ͧ����㹡�÷Ӥ���������§��)',
        'filename_title' => '������� &rArr; �������ͧ�Ҿ',
        'filename_how' => '����䢪�����������ҧ��',
        'filename_remove' => 'ź .jpg ��������ҧ��ѧ�͡ ����᷹������ _ (underscore) �������ͧ��ҧ',
        'filename_euro' => '����¹�ҡ 2003_11_23_13_20_20.jpg ��� 23/11/2003 13:20',
        'filename_us' => '����¹�ҡ 2003_11_23_13_20_20.jpg ��� 11/23/2003 13:20',
        'filename_time' => '����¹�ҡ 2003_11_23_13_20_20.jpg ��� 13:20',
        'delete' => 'ź�������ͧ�Ҿ �����Ҿ�鹩�Ѻ',
        'delete_title' => 'ź�������ͧ�Ҿ',
        'delete_original' => 'ź�Ҿ�鹩�Ѻ',
        'delete_replace' => 'ź�Ҿ�鹩�Ѻ ����᷹�������Ҿ����Ѻ��Ҵ����',
        'select_album' => '���͡��ź���',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => '���ѧ���Ҿ',
    'usr' => "'s Photo Gallery",
    'photogallery' => '������Ҿ',
    );

?>