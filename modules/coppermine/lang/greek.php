<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
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
// Greek language by lykman, �������� ��������� ��� �������� �., ver. 1.0   //
// You can mail me for errors or suggestions about GReek, lykman@freemail.gr //
// ��� ����� ���� � ��������� ��� ��������, ������� mail, lykman@freemail.gr //
// ------------------------------------------------------------------------- //
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Greek', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa�ol'
    'lang_country_code' => 'GR', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'lykman', // the name of the translator - can be a nickname
    'trans_email' => 'lykman@freemail.gr', // translator's email address (optional)
    'trans_website' => 'http://www.lykman.com', // translator's website (optional)
    'trans_date' => '03-10-2003', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-7';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('���', '���', 'T��', '���', '���', '���', '���');
$lang_month = array('���', '���', 'M��', 'A��', 'M��', '����', '����', 'A��', '���', '���', 'No�', '���');
// Some common strings
$lang_yes = '���';
$lang_no = '���';
$lang_back = '����';
$lang_continue = '��������';
$lang_info = '�����������';
$lang_error = '�����';
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

$lang_meta_album_names = array('random' => '������� �����������',
    'lastup' => '���������� ���������',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => '�������� ����������� �������',
    'lastcom' => '��������� ������',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => '������������ ����������',
    'toprated' => '��������� ����������',
    'lasthits' => '���������� ����������',
    'search' => '������������ ����������',
    'favpics' => '���������� �����������'
    );

$lang_errors = array('access_denied' => '��� ���������� � �������� �� ����� ��� ������.',
    'perm_denied' => '��� ���������� �� ���������� ����� ��� ����������.',
    'param_missing' => '�������� ���������� ��� ��� ��������.',
    'non_exist_ap' => '�� ���������� �������/���������� ��� �������!',
    'quota_exceeded' => '� ����� ��� ������<br /><br />��� �������� ����� [quota]K, �� ����������� ��� ���� ��� ������ ������������� [space]K, ������������ ����� ��� ���������� �� ��������� �� ����.',
    'gd_file_type_err' => '��������������� �� GD image library, ������������ ����� ����� ���� �� JPEG ��� PNG.',
    'invalid_image' => '� ���������� ��� ��������� ����� ������������ � �������.',
    'resize_failed' => '��� ���� ������� �� ������������ thumbnail � ������ ��������� ��������.',
    'no_img_to_display' => '������ ������ ���� ��������',
    'non_exist_cat' => '� ���������� ��������� ��� �������',
    'orphan_cat' => '� ��������� ��� ���� ���������, ������� ��� category manager ��� �� ��������� �� ��������.',
    'directory_ro' => '� ��������� \'%s\' ��� ����� ���������� ��� �����������, �� ����������� ��� ������� �� ����������',
    'non_exist_comment' => '�� ���������� ������ ��� �������.',
    'pic_in_invalid_album' => '� ���������� ����� �� ��������� ������� (%s)!?',
    'banned' => '����� ����������� ��� ���� �� site.',
    'not_with_udb' => '���� � ���������� ����� ���������������� ��� Coppermine ����� ����� ���������������� �� �� software ��� ������. � ���� ��� ����������� �� ������ ��� ������������� ���� ������� ����������, � ��� ���������� �� ������ �� ��� ���������� �� ���� �� ������.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => '���������� ���� ����� ��� �������',
    'alb_list_lnk' => '����� ��� �������',
    'my_gal_title' => '���������� ��o ��������� ���� �������',
    'my_gal_lnk' => '�� ���� ������� ���',
    'my_prof_lnk' => '�� ������ ���',
    'adm_mode_title' => '����������� �����������',
    'adm_mode_lnk' => '��������� �����������',
    'usr_mode_title' => '����������� ������',
    'usr_mode_lnk' => '��������� ������',
    'upload_pic_title' => '�������� ����������� �� �������',
    'upload_pic_lnk' => '�������� �����������',
    'register_title' => '���������� �����������',
    'register_lnk' => '�������',
    'login_lnk' => '�������',
    'logout_lnk' => '������',
    'lastup_lnk' => '���������� ���������',
    'lastcom_lnk' => '��������� ������',
    'topn_lnk' => '������������ ����������',
    'toprated_lnk' => '��������� ����������',
    'search_lnk' => '���������',
    'fav_lnk' => '�� ��������� ���',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => '������� ���������',
    'config_lnk' => '���������',
    'albums_lnk' => '�������',
    'categories_lnk' => '����������',
    'users_lnk' => '�������',
    'groups_lnk' => '������',
    'comments_lnk' => '������',
    'searchnew_lnk' => '�������� ������� �����������',
    'util_lnk' => '������ �������� �����������',
    'ban_lnk' => '����������� �������',
    );

$lang_user_admin_menu = array('albmgr_lnk' => '���������� / ���������� �������',
    'modifyalb_lnk' => '����������� ��� �������',
    'my_prof_lnk' => '�� ������ ���',
    );

$lang_cat_list = array('category' => '���������',
    'albums' => 'A������',
    'pictures' => '�����������',
    );

$lang_album_list = array('album_on_page' => '%d ������� �� %d ������(��)'
    );

$lang_thumb_view = array('date' => '��/���',
    'name' => '����� �������',
    'title' => '������',
    'sort_da' => '�������� ��� ���������� ���� ������� ����������',
    'sort_dd' => '�������� ��� ������� ���� ���������� ����������',
    'sort_na' => '�������� ���������� �������',
    'sort_nd' => '�������� ���������� ��������',
    'sort_ta' => '�������� �� ����� �������',
    'sort_td' => '�������� �� ����� ��������',
    'pic_on_page' => '%d ����������(��) �� %d ������(��)',
    'user_on_page' => '%d �������(��) �� %d ������(��)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => '��������� ���� ������ �� �� thumbnail',
    'pic_info_title' => '��������/�������� ����������� �����������',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => '�������� ����� ��� ������� ��� ����������� �����',
    'ecard_disabled' => '�� ������������ ������ ����� ���������������',
    'ecard_disabled_msg' => '��� ��� ���������� �� �������� ������������ ������',
    'prev_title' => '�������� ������������ �����������',
    'next_title' => '�������� �������� �����������',
    'pic_pos' => '���������� %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => '������������ ����� ��� ���������� ',
    'no_votes' => '(����� ���� �����)',
    'rating' => '(������ ���������� : %s / 5 �� %s ������)',
    'rubbish' => '�����',
    'poor' => '����',
    'fair' => '������',
    'good' => '����',
    'excellent' => '�����',
    'great' => '������������',
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
    CRITICAL_ERROR => 'Critical error',
    'file' => '������: ',
    'line' => '������: ',
    );

$lang_display_thumbnails = array('filename' => '����� ������� : ',
    'filesize' => '������� ������� : ',
    'dimensions' => '���������� : ',
    'date_added' => '���������� ��������� : '
    );

$lang_get_pic_data = array('n_comments' => '%s ������',
    'n_views' => '%s ����������',
    'n_votes' => '(%s �����)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => '���������',
        'Question' => '�������',
        'Very Happy' => '���� ����������',
        'Smile' => '��������',
        'Sad' => '���������',
        'Surprised' => '���������',
        'Shocked' => '������������',
        'Confused' => '�����������',
        'Cool' => 'Cool',
        'Laughing' => '��������',
        'Mad' => '������',
        'Razz' => 'Razz',
        'Embarassed' => '�������������',
        'Crying or Very sad' => '��������',
        'Evil or Very Mad' => '����������',
        'Twisted Evil' => '������������',
        'Rolling Eyes' => '������� �����',
        'Wink' => 'Wink',
        'Idea' => 'I���',
        'Arrow' => '�����',
        'Neutral' => '���������',
        'Mr. Green' => 'Mr. ��������',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => '��������������� ��� ����������� �����������...',
        1 => '������� ���� ����������� �����������...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => '�� ������� ������ �� ����� ����� !',
        'confirm_modifs' => '����� �������� ��� ������ �� ������ ����� ��� ������� ?',
        'no_change' => '��� ������ ����� ������ !',
        'new_album' => 'N�� �������',
        'confirm_delete1' => '����� �������� ��� ������ �� ���������� ���� �� ������� ?',
        'confirm_delete2' => '\n���� �� ����������� ��� �� ������ ��� ����������� �� ������ !',
        'select_first' => '�������� ��� ������� �����',
        'alb_mrg' => '���������� A������',
        'my_gallery' => '* �� ���� ������� ��� *',
        'no_category' => '* ����� ��������� *',
        'delete' => '��������',
        'new' => 'N��',
        'apply_modifs' => '�������� �������',
        'select_category' => 'Select category',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => '�� ���������� ��� ����������� ��� \'%s\'���������� ��� ������� !',
        'unknown_cat' => '� ���������� ��������� ��� ������� ���� database',
        'usergal_cat_ro' => '�� ���� ������� ��� ������� ��� ������� �� ���������� !',
        'manage_cat' => '���������� ����������',
        'confirm_delete' => '����� �������� ��� ������ �� ���������� ����� ��� ���������',
        'category' => '���������',
        'operations' => '�����������',
        'move_into' => 'M��������� ��',
        'update_create' => '��������/���������� ����������',
        'parent_cat' => '���������� ����������',
        'cat_title' => '������ ����������',
        'cat_desc' => '��������� ����������'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => '���������',
        'restore_cfg' => '��������� ������� ���������',
        'save_cfg' => '���������� ���� ���������',
        'notes' => '����������',
        'info' => '�����������',
        'upd_success' => '�� ��������� ��� Coppermine �����������',
        'restore_success' => '�� ����������������� ��������� ��� Coppermine �������������',
        'name_a' => '����� �����',
        'name_d' => '������ �����',
        'title_a' => '����� ������',
        'title_d' => '������ ������',
        'date_a' => '������� ����������',
        'date_d' => '�������� ����������',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP')) $lang_config_data = array(
        // General settings
        '������� ��������',
        array(
            '����� �������', 'gallery_name', 0),
        array(
            '��������� ���� �������', 'gallery_description', 0),
        array(
            '�-mail ����������� ��� ���� �������', 'gallery_admin_email', 0),
        array(
            '��������� ��������� ��� \'����� ������������ �����������\' ���������� ���� ������������ ������', 'ecards_more_pic_target', 0),
        array(
            '������', 'lang', 5),
// for postnuke change
        array('����', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        '�������� ������ �������',
        array(
            '������ ������ ������ (����� � %)', 'main_table_width', 0),
        array(
            '������ ������������� ���� ��������', 'subcat_level', 0),
        array(
            '������ ������� ���� ��������', 'albums_per_page', 0),
        array(
            '������ ������ ��� ��� ����� ��� �������', 'album_list_cols', 0),
        array(
            '������� ��� thumbnails �� �����', 'alb_list_thumb_size', 0),
        array(
            '����������� ��� ��������� �������', 'main_page_layout', 0),
        array(
            '�������� ������ �������� thumbnails ��� ������� ���� ����������', 'first_level', 1), 
        // 'Thumbnail view',
        '�������� Thumbnail',
        array(
            '������ ������ ���� ������ ��� thumbnail', 'thumbcols', 0),
        array(
            '������ ������� ���� ������ ��� thumbnail', 'thumbrows', 0),
        array(
            '������� ������ tabs ��� ��������', 'max_tabs', 0),
        array(
            '�������� ������������� ������� (����������� ��� ������) ���� ��� �� thumbnail', 'caption_in_thumbview', 1),
        array(
            '�������� ������� ������� ���� ��� �� thumbnail', 'display_comment_count', 1),
        array(
            '���������� �������� ��������� ��� ��� �����������', 'default_sort_order', 3),
        array(
            '�������� ������ ����� ��� ��� ���������� ��� �� ���������� ���� ���� ����� �� ��� \'top-rated\' .', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        '�������� ������� &amp; ��������� �������',
        array(
            '������ ������ ��� �������� ����������� (����� � %)', 'picture_table_width', 0),
        array(
            '�� ������������ �� ����������� ��� ����������� �����?', 'display_pic_info', 1),
        array(
            '����������� ������������� ������ ��� ������', 'filter_bad_words', 1),
        array(
            '�� ���������� �� ��������� ��� ������', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'M������ ����� ��� ��� ��������� ���� �����������', 'max_img_desc_length', 0),
        array(
            'M������ ������ ���������� ��� ����', 'max_com_wlength', 0),
        array(
            'M������� ������� ������� ��� ������', 'max_com_lines', 0),
        array(
            'M������ ����� �������', 'max_com_size', 0),
        array(
            '�������� film strip', 'display_film_strip', 1),
        array(
            '������� ������������ ���� ��� film strip', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'P�������� ����������� ��� thumbnails',
        array(
            '�������� ��� JPEG �������', 'jpeg_qual', 0),
        array(
            '������� �������� ��� thumbnail <strong>*</strong>', 'thumb_width', 0),
        array(
            '����� ��������� ( ������ � ���� � ������� �������� ��� �� thumbnail )<strong>*</strong>', 'thumb_use', 7),
        array(
            '���������� ���������� �����������', 'make_intermediate', 1),
        array(
            'M������ ������ � ���� ���������� ����������� <strong>*</strong>', 'picture_width', 0),
        array(
            'M������ ������� ��� ��� ����������� ��� �������� (KB)', 'max_upl_size', 0),
        array(
            'M������ ������ � ���� ��� ��� ����������� ��� �������� (�����)', 'max_upl_width_height', 0), 
        // 'User settings',
        '��������� �������',
        array(
            '���������� � ������� ���� ������', 'allow_user_registration', 1),
        array(
            '� ������� ���� ������ �� ������� ���������� email', 'reg_requires_valid_email', 1),
        array(
            '���������� ��� ������� �� ����� ����� ��������� email', 'allow_duplicate_emails_addr', 1),
        array(
            '�� ������� ������� �� ����� ��������� �������', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Custom ����� ��� ��������� ��� ����������� (������ ���� ��� ��� �� �� ���������������)',
        array(
            '����� 1�� ������', 'user_field1_name', 0),
        array(
            '����� 2�� ������', 'user_field2_name', 0),
        array(
            '����� 3�� ������', 'user_field3_name', 0),
        array(
            '����� 4�� ������', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        '�������������� ��������� ����������� ��� thumbnails',
        array(
            '�������� ���������� ��������� ������ ���� ���������', 'show_private', 1),
        array(
            '������������� ���������� �� ����� �������', 'forbiden_fname_char', 0),
        array(
            '������ ���������� ������� ��� ��� ������������� �����������', 'allowed_file_extensions', 0),
        array(
            'M������ ��� ������ �������� �����������', 'thumb_method', 2),
        array(
            '�������� ��� ��� �������� ImageMagick / netpbm \'convert\' (���������� /usr/bin/X11/)', 'impath', 0),
        array(
            '������ ����� ������� (���� ��� �� ImageMagick)', 'allowed_img_types', 0),
        array(
            '�������� ������� ������� ��� �� ImageMagick', 'im_options', 0),
        array(
            '�������� ����������� EXIF ��� JPEG ������', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            '��������� ������� <strong>*</strong>', 'fullpath', 0),

        array(
            '� ��������� ��� ��� ����������� ��� ������� <strong>*</strong>', 'userpics', 0),
        array(
            '������� ��� ���������� ����������� <strong>*</strong>', 'normal_pfx', 0),
        array(
            '������� ��� thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array(
            '����������������� ��������� ��� ����������', 'default_dir_mode', 0),
        array(
            '����������������� ��������� ��� �����������', 'default_file_mode', 0),
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
        '��������� ��� �� Cookies &amp; ��� ��� �������������� ����������',
        array(
            '����� ��� cookie ��� ������������ �� ���������', 'cookie_name', 0),
        array(
            '�������� ��� �� cookie ��� ������������ �� ���������', 'cookie_path', 0),
        array(
            '������������ ����������', 'charset', 4), 
        // 'Miscellaneous settings',
        '������ ���������',
        array(
            'E����������� ����������� ���������� �����', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) �� ����� �� * ��� ������ �� ��������� ��� ����� ��� ����������� ��� ������� ���.</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => '������ �� ������� �� ����� ��� ��� ������ ������',
        'com_added' => '�� ������ ��� ����������',
        'alb_need_title' => '������ �� ������ ������ ����� ��� �� ������� !',
        'no_udp_needed' => '��� ���������� ���������.',
        'alb_updated' => 'T� ������� �����������',
        'unknown_album' => '�� ���������� ������� ��� �������, � ��� ��� ���������� �� ���������� ����������� �� ����',
        'no_pic_uploaded' => '��� ���������� ���������� !<br /><br />��� ������ �������� ������ �� ����������, ������� �� � ����������� ��������� ���������...',
        'err_mkdir' => '�������� �� ������������ ��� �������� %s !',
        'dest_dir_ro' => '� ��������� %s ���� ����� ���������� �� �������, ��� ������ �� �������� ��� �� ��������� !',
        'err_move' => '��� ������� ������ � ���������� ��� ��� %s ���� %s !',
        'err_fsize_too_large' => 'T� ������� ��� ����������� ��� ��������� ����� ���� ������ (������� ������������ ����� %s x %s) !',
        'err_imgsize_too_large' => 'T� ������� ��� ������� ��� ��������� ����� ���� ������ (������� ������������ ����� %s KB) !',
        'err_invalid_img' => 'T� ������ ��� ���������, ��� ����� ������ ��� ����������!',
        'allowed_img_types' => '�������� �� ��������� ���� %s �����������.',
        'err_insert_pic' => '� ���������� \'%s\' ��� ������ �� ��������� ��� ������� ',
        'upload_success' => '� ���������� ��� ���������� ��������<br /><br />�� ����� ��������� ���� ��� ������� ��� �����������.',
        'info' => '�����������',
        'com_added' => '�� ������ ����������',
        'alb_updated' => '�� ������� ����������',
        'err_comment_empty' => '�� ������ ��� ��� ���� ����������� !',
        'err_invalid_fext' => '���� �� ������ �� ��� ��������� ���������� ������������ : <br /><br />%s.',
        'no_flood' => '������� ���� ����� ����� ��� ������ �� ��������� ������ ��� ����� ��� ����������<br /><br />������������ �� ������ ��� ������������ ��� ������ �� �� ��������',
        'redirect_msg' => '�������������...<br /><br /><br />������� \'CONTINUE\' ��� � ������ ��� ��������� ��������',
        'upl_success' => '� ���������� ��� ���������� ��������',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => '�������',
        'fs_pic' => '������ ������� ��������',
        'del_success' => '�������� ��������',
        'ns_pic' => '���������� ��������� ��������',
        'err_del' => '��� ������ �� ���������',
        'thumb_pic' => 'thumbnail',
        'comment' => '������',
        'im_in_alb' => '���������� �� �������',
        'alb_del_success' => 'A������ \'%s\' ���������',
        'alb_mgr' => '���������� A������',
        'err_invalid_data' => '�� ������ �������� ������������ ��� \'%s\'',
        'create_alb' => '���������� ������� \'%s\'',
        'update_alb' => '�������� ������� \'%s\' �� ����� \'%s\' ��� ��������� \'%s\'',
        'del_pic' => '�������� �����������',
        'del_alb' => '�������� �������',
        'del_user' => '�������� ������',
        'err_unknown_user' => '� ����������� ������� ��� ������� !',
        'comment_deleted' => '�� ������ ��������� ��������',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => '����� �������� ��� ������ �� ���������� ���� ��� ���������� ? \\n�� ������ ������ �� ����������.',
        'del_pic' => '�������� �����������',
        'size' => '%s x %s �����',
        'views' => '%s �����',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => '����� SLIDESHOW',
        'view_fs' => 'Click to view full size image',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );
    $lang_picinfo = array('title' => '����������� �����������',
        'Filename' => '����� �������',
        'Album name' => '����� �������',
        'Rating' => '���������� (%s �����)',
        'Keywords' => '������ �������',
        'File Size' => '������� �������',
        'Dimensions' => '����������',
        'Displayed' => '����������',
        'Camera' => '����������� ������',
        'Date taken' => '���������� �����',
        'Aperture' => '���������',
        'Exposure time' => '������ �������',
        'Focal length' => '������� ��������',
        'Comment' => '������',
        'addFav' => '�������� ��� ���������',
        'addFavPhrase' => '���������',
        'remFav' => '�������� ��� �� ���������',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => '��������� �������',
        'confirm_delete' => '����� �������� ��� ������ �� ���������� ���� �� ������ ?',
        'add_your_comment' => '�������� �������',
        'name' => '�����',
        'comment' => '������',
        'your_name' => '��������',
        );

    $lang_fullsize_popup = array('click_to_close' => '������� ���� ������ ��� �� �������� ���� �� ��������',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => '������� ��� ����������� �����',
        'invalid_email' => '<strong>�������������</strong> : � ��������� e-mail ��� ����� ������ !',
        'ecard_title' => '��� ����������� ����� ��� ��� %s ��� ����',
        'view_ecard' => '��� � ����������� ����� ��� ���������� �����, �������� ����� ��� ����������',
        'view_more_pics' => '�������� ���� ��� ���������� ��� �� ����� ������������ ����������� !',
        'send_success' => '� ����������� ��� ����� ���������',
        'send_failed' => '�������, ���� � ����������� ��� ������ �� ������� ��� ����������� ��� �����...',
        'from' => '���',
        'your_name' => '�� ����� ���',
        'your_email' => '� ��������� email ���',
        'to' => '����',
        'rcpt_name' => '����� ���������',
        'rcpt_email' => '��������� email ���������',
        'greetings' => '�� �������� ������������',
        'message' => '������',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => '�����������&nbsp;�����������',
        'album' => 'A������',
        'title' => 'T�����',
        'desc' => '���������',
        'keywords' => '������ �������',
        'pic_info_str' => '%sx%s - %sKB - %s ���������� - %s �����',
        'approve' => '������� �����������',
        'postpone_app' => '������ ��������',
        'del_pic' => '�������� �����������',
        'reset_view_count' => '���������� ������� ����������',
        'reset_votes' => '���������� �����',
        'del_comm' => '�������� �������',
        'upl_approval' => '������� ���������',
        'edit_pics' => '��������� �����������',
        'see_next' => '�������� �������� �����������',
        'see_prev' => '�������� ������������ �����������',
        'n_pic' => '%s �����������',
        'n_of_pic_to_disp' => '������� ����������� ���� ��������',
        'apply' => '�������� �������������'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => '����� ������',
        'disk_quota' => '���������� �����',
        'can_rate' => '������� �� ������������� �����������',
        'can_send_ecards' => '������� �� �������� ������������ ������',
        'can_post_com' => '������� �� ������������ ������',
        'can_upload' => '������� �� ���������� �����������',
        'can_have_gallery' => '������� �� ����� ��������� ���� �������',
        'apply' => '�������� �������������',
        'create_new_group' => '���������� ���� ������',
        'del_groups' => '�������� ����������� ������',
        'confirm_del' => '�������, ���� ���������� ��� �����, �� ������� ��� ������� �� ����� ��� ����� �� ����������� ���� ����� ��� \'������������\' !\n\n������ �� ���������� ?',
        'title' => '���������� ������ �������',
        'approval_1' => '�����. �����. ����� (1)',
        'approval_2' => '������. �����. ����� (2)',
        'note1' => '<strong>(1)</strong> ��������� �� ��� ������� ������� ������� ��� ������� ��� �����������',
        'note2' => '<strong>(2)</strong> ��������� �� ��� ��������� ������� ������� ��� ������� ��� �����������',
        'notes' => '����������'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => '����������� !'
        );

    $lang_album_admin_menu = array('confirm_delete' => '����� �������� ��� ������ �� ���������� ���� �� ������� ? \\n���� �� ����������� ��� �� ������ �� ������.',
        'delete' => '��������',
        'modify' => '�����������',
        'edit_pics' => '����������� �����������',
        );

    $lang_list_categories = array('home' => '������',
        'stat1' => '<strong>[pictures]</strong> ����������� �� <strong>[albums]</strong> ������� ��� <strong>[cat]</strong> ���������� �� <strong>[comments]</strong> ������, �� ������ ����� ���������� <strong>[views]</strong> �����',
        'stat2' => '<strong>[pictures]</strong> ����������� �� <strong>[albums]</strong> �������, �� ������ ����� ���������� <strong>[views]</strong> �����',
        'xx_s_gallery' => '%s\'s ���� �������',
        'stat3' => '<strong>[pictures]</strong> ����������� �� <strong>[albums]</strong> ������� �� <strong>[comments]</strong> ������, �� ������ ����� ���������� <strong>[views]</strong> �����'
        );

    $lang_list_users = array('user_list' => '��������� �������',
        'no_user_gal' => '��� �������� ������� ��� �� ���� ���������� �� ����� �������',
        'n_albums' => '%s �������',
        'n_pics' => '%s ����������(��)'
        );

    $lang_list_albums = array('n_pictures' => '%s �����������',
        'last_added' => ', � ��������� ���������� ���� %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => '��������� ������� %s',
        'general_settings' => '������� ���������',
        'alb_title' => '������ �������',
        'alb_cat' => '��������� �������',
        'alb_desc' => '��������� �������',
        'alb_thumb' => 'A������ thumbnail',
        'alb_perm' => '����������� ��� ���� �� �������',
        'can_view' => '�� ������� ������ �� ���������� �����',
        'can_upload' => '�� ���������� ������� �� ���������� �����������',
        'can_post_comments' => '�� ���������� ������� �� ������������ ������',
        'can_rate' => '�� ���������� ������� �� ������������� ��� �����������',
        'user_gal' => '���� ������� �������',
        'no_cat' => '* �� ����������������� *',
        'alb_empty' => '�� ������� ����� �����',
        'last_uploaded' => '��������� ��������',
        'public_alb' => '���� (������� �������)',
        'me_only' => 'M��� ���',
        'owner_only' => '� (%s) , ���������� ��� �������',
        'groupp_only' => '�� ���� ��� ������ \'%s\' ',
        'err_no_alb_to_modify' => '������ ������� ��� ����������� ���� ���� ���������.',
        'update' => '��������� �������'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => '������� ���� ����� ��� ������������ ���� ��� ����������',
        'rate_ok' => '� ����� ��� ����� �����',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
������ ��� �� ������������ ��� {SITE_NAME} �� ������������ �� ���������� � �� ������������� ���� ���������� ��������� �� ����������� ������, ����� ������� �� ���������� ���� ������������ ������. ��� ���� ���������� ��� ���� ������ ��� ������������ �� ���� �� site �������� ���� ��� ����� ��� ��� ����� ��� �������� ��� ��� ������� �����.<br />
<br />
�� �� �����, ���������� �� ��� ������������ ��������, ��������, ���������, �������, ���������� � ����� ������ ����������� ������ ��� ������������� ����� ��������� ������ ��� ���. ���������� ��� �� ������������ ��� {SITE_NAME} ����� �� �������� �� ���������� � �� ������������� ���� �� ���� ��� ����� ����. ��� ������� ���������� ��� ���� ���������� ��� ����� ������� �� ����������� ���� ���� ���������. ������ ��� ���� ���������� ��� �������� ������������, ��� ��� �� ����� ������� ����� ��� ����� ��� �� ������������ ��� ������� �� ��� ������������ �� ��������� ����������� hacking ��� ������ �� �������� �� ����� �����������.<br />
<br />
���� �� site ������������ cookies ��� �� ����������� ����������� ������ ���� ���������� ���. ���� �� cookies ����������� ���� ��� ����� ��� ����������� ���� ��� ��������� ���� �������. � ��������� email ��� ��� ������� ����� ���� ��� �� ������������ ��� ��� ������� ��� ��� ����������� ��� ��� ������ ���.<br />
<br />
����������� '�������' ��������, ���������� ������ ���� �����.
EOT;

    $lang_register_php = array('page_title' => '������� ������',
        'term_cond' => '���� ������',
        'i_agree' => '�������',
        'submit' => '�������� ��������',
        'err_user_exists' => '�� ����� ������ ��� �������� ������� ���, �������� �������� ������ ����',
        'err_password_mismatch' => '�� ��� ������� ��� ����� �����, �������� �������� ���� ����',
        'err_uname_short' => '�� ����� ������ ������ �� ����� ����������� 2 ����������',
        'err_password_short' => '� ������� ������ �� ����� ���������� 2 ����������',
        'err_uname_pass_diff' => '�� ����� ������ ��� � ������� ������ �� ����� �����������',
        'err_invalid_email' => '� ��������� email ��� ����� ������',
        'err_duplicate_email' => '������� ����� ������� ���� ��� �������� �� ��� ��������� email ��� ������',
        'enter_info' => '���������� ����������� ��������',
        'required_info' => '������������ �����������',
        'optional_info' => '������������ �����������',
        'username' => '����� ������',
        'password' => '�������',
        'password_again' => '��������� ��� ������',
        'email' => 'Email',
        'location' => '���������',
        'interests' => '������������',
        'website' => '��������� ������',
        'occupation' => '���������',
        'error' => '�����',
        'confirm_email_subject' => '%s - ����������� ��������',
        'information' => '�����������',
        'failed_sending_email' => '�� email ��� ��� ����������� �������� ��� ������ �� ��������� !',
        'thank_you' => '������������ ��� ��� ������� ���.<br /><br />��� email �� ����������� ��� �� ��� �� �������������� ��� ���������� ��� ��������� ���� ��������� email ��� ������.',
        'acct_created' => '� ����������� ��� ����� ������� ��� �������� �� ��������� ��������������� �� ����� ������ ��� ��� ������ ���',
        'acct_active' => '� ����������� ��� ����� ����� ������� ��� �������� �� ��������� �� �� ����� ������ ��� ��� ������ ���',
        'acct_already_act' => '� ����������� ��� ����� ��� ������� !',
        'acct_act_failed' => '����� � ����������� ��� ������ �� ������������� !',
        'err_unk_user' => '� ����������� ������� ��� ������� !',
        'x_s_profile' => '�� ������ ��� %s',
        'group' => '�����',
        'reg_date' => '��������',
        'disk_usage' => '����� �����',
        'change_pass' => '������ �������',
        'current_pass' => '����� �������',
        'new_pass' => 'N��� �������',
        'new_pass_again' => '����� ���� ��� ��� ������',
        'err_curr_pass' => '� ����� ������� ����� ����������',
        'apply_modif' => '�������� �������������',
        'change_pass' => '����� ��� ������� ���',
        'update_success' => '�� ������ ����������',
        'pass_chg_success' => '� ������� ��� ������',
        'pass_chg_error' => '� ������� ��� ��� ������',
        );

    $lang_register_confirm_email = <<<EOT
������������ ��� ����������� ��� {SITE_NAME}

�� ����� ������ ��� ����� : "{USER_NAME}"
� ������� ��� ����� : "{PASSWORD}"

��� �� �������������� ��� ���������� ���, ������ �� �������� ��� �������� ����������
� �� ��� ����������� ���� web browser ���.

{ACT_LINK}

�� �������� ������������,

�� ������������ ��� {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => '���������� �������',
        'no_comment' => '��� �������� ������ ��� ����������',
        'n_comm_del' => '%s ������(�) ����������(��)',
        'n_comm_disp' => '������� ������� ���� ��������',
        'see_prev' => '�������� ������������',
        'see_next' => '�������� ��������',
        'del_comm' => '�������� ����������� �������',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => '��������� ���� ������� �����������',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => '��������� ���� �����������',
        'select_dir' => '������� ���������',
        'select_dir_msg' => '���� � ���������� ��� ��������� �� ���������� ������ ����������� ��� ����� �������� ���� ���������� ��� ���� FTP.<br /><br />�������� ��� �������� ���� ��������� ��� ����������� ���',
        'no_pic_to_add' => '��� ������� ���������� ��� ��������',
        'need_one_album' => '���������� ���������� ��� ������� ��� �� ��������������� ���� ��� ����������',
        'warning' => '�������������',
        'change_perm' => '�� ��������� ��� ������ �� ������ �� ���� ��� ��������, ������ �� �������� ��� ��������� ��� ��������� (CHMOD) �� 755 � 777 ���� ������������ �� ���������� ����������� !',
        'target_album' => '<strong>�������� ����������� &quot;</strong>%s<strong>&quot; ��� </strong>%s',
        'folder' => '���������',
        'image' => '������',
        'album' => 'A������',
        'result' => '����������',
        'dir_ro' => '��� ������ �� ��������. ',
        'dir_cant_read' => '��� ������ �� ���������. ',
        'insert' => '������������ ���� ����������� ��� ���� �������',
        'list_new_pic' => '����� �����������',
        'insert_selected' => '�������� ����������� �����������',
        'no_pic_found' => '��� �������� ���� �����������',
        'be_patient' => '�������� �� ����� ������������, �� ��������� ��������� ���� ��� ��� �� ��������� ��� �����������...',
        'notes' => '<ul>' . '<li><strong>OK</strong> : �������� ��� � ���������� �������� ��������' . '<li><strong>DP</strong> : �������� ��� � ���������� ������� ��� ���� ���� ���������' . '<li><strong>PB</strong> : �������� ��� � ���������� ��� ������ �� ���������, ������� ��� ��������� ��� ��� �� ����� ����� �� ��������������� ���� ���������� ��� ���������� �� �����������' . '<li>��� �� OK, DP, PB \'signs\' ��� ������������, �������� ���� ���� �� ����������� ������ ���� �� ����� �� �������� ������������� ��� ��� ������ PHP' . '<li>��� ��������� � browser ��� timeout, ������������ ��� ������ �� reload' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => '�������� �����������',
        'max_fsize' => '�� ������� ������������ ������� ������� ����� %s KB',
        'album' => 'A������',
        'picture' => '����������',
        'pic_title' => '������ �����������',
        'description' => '��������� �����������',
        'keywords' => '������ ������� (������������� �� ����)',
        'err_no_alb_uploadables' => '�������, ��� ������� ������� ��� �� ��� ���������� � �������� �����������',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => '���������� �������',
        'name_a' => '�����, ������� �����',
        'name_d' => '�����, �������� �����',
        'group_a' => '�����, ������� �����',
        'group_d' => '�����, �������� �����',
        'reg_a' => '���������� ��������, ������� �����',
        'reg_d' => '���������� ��������, �������� �����',
        'pic_a' => '�������� �����������, ������� �����',
        'pic_d' => '�������� �����������, �������� �����',
        'disku_a' => '����� �����, ������� �����',
        'disku_d' => '����� �����, �������� �����',
        'sort_by' => '�������� ������� ������� ��',
        'err_no_users' => '� ������� ������� ����� ������ !',
        'err_edit_self' => '��� �������� �� ������������� �� ������ ���, �������������� ��� ���������� \'My profile\' ��� ����',
        'edit' => '�����������',
        'delete' => '��������',
        'name' => '����� ������',
        'group' => '�����',
        'inactive' => '���������',
        'operations' => '�����������',
        'pictures' => '�����������',
        'disk_space' => '����� �� ����� / ����������',
        'registered_on' => '��������� ����',
        'u_user_on_p_pages' => '%d ������� �� %d ������(��)',
        'confirm_del' => '����� �������� ��� ������ �� ���������� ����� ��� ������ ? \\n���� �� ����������� ��� �� ������� ��� �� ���������� ������.',
        'mail' => 'MAIL',
        'err_unknown_user' => '� ����������� ������� ��� ������� !',
        'modify_user' => '����������� ������',
        'notes' => '����������',
        'note_list' => '<li>��� ��� ������ �� �������� �� ����� ������ ���, ������ �� ����� "�������" ����',
        'password' => '�������',
        'user_active_cp' => '� ������� ����� �������',
        'user_group_cp' => '����� �������',
        'user_email' => '�mail ������',
        'user_web_site' => '��������� ������ ������',
        'create_new_user' => '���������� ���� ������',
        'user_from' => '��������� ������',
        'user_interests' => '������������ ������',
        'user_occ' => '��������� ������',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => '������ �������� �����������',
        'what_it_does' => '�� �����...',
        'what_update_titles' => '���������� ������� ��� ����� �������',
        'what_delete_title' => '��������� �������',
        'what_rebuild' => '������������ �� thumbnails ��� ��� ����������� ���������� ��������',
        'what_delete_originals' => '��������� ��� ����������� �� �� ������ �������, ��������������� ��� �� ��� ����� ���������� ��������',
        'file' => '������',
        'title_set_to' => '� ������ �� �����',
        'submit_form' => '�������',
        'updated_succesfully' => '����������� ��������',
        'error_create' => '���ϡ���� ��� ����������',
        'continue' => '�������� �� �������� ����',
        'main_success' => '�� ������ %s ��������������� �������� ��� � ������ ����������',
        'error_rename' => '����� ���� ��� ����������� ��� %s �� %s',
        'error_not_found' => '�� ������ %s ��� �������',
        'back' => '���� ���� ��������',
        'thumbs_wait' => '��������� ��� thumbnails �/��� ��� ����������� ���������� ��������, �������� ����������...',
        'thumbs_continue_wait' => '�������� �� ��� ��������� ��� thumbnails �/��� ��� ����������� ���������� ��������...',
        'titles_wait' => '��������� ������, �������� ����������...',
        'delete_wait' => '�������� ������, �������� ����������...',
        'replace_wait' => '�������� ���������� ��� ������������� �� ��� ����������� ���������� ��������, �������� ����������...',
        'instruction' => '�������� �������',
        'instruction_action' => '������� �����������',
        'instruction_parameter' => '������� ����������',
        'instruction_album' => '������� �������',
        'instruction_press' => '������� %s',
        'update' => '��������� thumbs �/��� ����������� ���������� ��������',
        'update_what' => '�� �� ������ �� ����������',
        'update_thumb' => '���� �� thumbnails',
        'update_pic' => '���� �� ����������� ���������� ��������',
        'update_both' => '��� �� thumbnails ��� �� ����������� ���������� ��������',
        'update_number' => '������ ����������� ��� �������������� ��� ����',
        'update_option' => '(������� ����� ��� ������� �� ������ ���������� �� ��� ��������� timeout )',
        'filename_title' => '����� ������� ? ������ �����������',
        'filename_how' => '��� �� ������ �� ���������� � ������ ��� �������',
        'filename_remove' => '�������� ��� ��������� .jpg ��� ������������� �� _ (���� �����) ��� ����',
        'filename_euro' => '������ 2003_11_23_13_20_20.jpg �� 23/11/2003 13:20',
        'filename_us' => '������ 2003_11_23_13_20_20.jpg �� 11/23/2003 13:20',
        'filename_time' => '������ 2003_11_23_13_20_20.jpg �� 13:20',
        'delete' => '�������� ������ ����������� � ����������� ������� ��������',
        'delete_title' => '�������� ������ �����������',
        'delete_original' => '�������� ����������� ������� ��������',
        'delete_replace' => '�������� ���������� ����������� �� ������������� ���� ��� ��� ����������� ���������� ��������',
        'select_album' => '������� �������',
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