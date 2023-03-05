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

$lang_charset = 'windows-1251';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('������', '����������', '�������', '�����', '��������', '�����', '������');
$lang_month = array('���', '���', '���', '���', '��', '���', '���', '���', '���', '���', '���', '���');

// Some common strings
$lang_yes = '��';
$lang_no  = '��';
$lang_back = '�����';
$lang_continue = '��������';
$lang_info = '��������ȣ�';
$lang_error = '������';

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
	'random' => '������� �����',
	'lastup' => '�������� ��������',
	
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Last updated albums',
	'lastcom' => '�������� ���������',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => '���������',
	'toprated' => '������ ���������',
	'lasthits' => '�������� ������',
	'search' => '��������� �� �������������',
     'favpics'=> '������� �����', //new in cpg1.2.0
);

$lang_errors = array(
'access_denied' => '����� ������� �� ���� ��������.',
	'perm_denied' => '�� �� � ��������� �� �� ������� ��� ��������.',
	'param_missing' => '��������� � �������� ��� ���������� ���������.',
	'non_exist_ap' => '��������� �����/ ����� ����� �� ������ !',
	'quota_exceeded' => '���� ������� � ����������<�� /><�� />����� ��������� ����� �� [quota]K, ������ ����� ��������� [space]K, �� ������� �� ���� ����� �� ��������� ����������� �����.',
	'gd_file_type_err' => '��� ��������� �� �������� ������� ��������� ����� �� ���� ��� � ���.',
	'invalid_image' => '������ ��� �� ������������ � ������� ��� �� ��������� �� ���� �� �� ��������',
	'resize_failed' => '���� ������� �� �� ������� ���� ��������.',
	'no_img_to_display' => '���� ����� �� ������',
	'non_exist_cat' => '��������� ��������� �� ������',
	'orphan_cat' => '����������� �� ������, ��������� �� ������������� �� ����������� �� �� �� ���� ���������.',
	'directory_ro' => '�� ������������� \'%s\' �� � ������� �������� writable, ������� ������� �� ����� ���������',
	'non_exist_comment' => '��������� �������� �� ������.',
	'pic_in_invalid_album' => '������� � �� ������������� ����� (%s)!?',
        'banned' => '���������� �� � ��������� �� �� ��������� ��� ���.',  //new in cpg1.2.0
        'not_with_udb' => '���� ������� � ����������� �� Coppermine ���弝� � ����������� �� ����� ���������. ����� ��� � �� �� ��������� �� ��������� �� � �������� �� ��� ������������, ��� ��������� �� ���� �������� �� ����� ���������.',  //new in cpg1.2.0
'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array(
	'alb_list_title' => '��� �� ������� �� �������',
	'alb_list_lnk' => '����� �� �������',
	'my_gal_title' => '��� �� ����� ����� �� �������',
	'my_gal_lnk' => '��� �������',
	'my_prof_lnk' => '�� ������',
	'adm_mode_title' => '������� �� ����� ���',
	'adm_mode_lnk' => '����� ���',
	'usr_mode_title' => '������� �� ���������� ���',
	'usr_mode_lnk' => '���������� ���',
	'upload_pic_title' => '��������� �� ������� �� �������,',
	'upload_pic_lnk' => '��������� �����',
	'register_title' => '������ �������',
	'register_lnk' => '�����������',
	'login_lnk' => '����',
	'logout_lnk' => '�����',
	'lastup_lnk' => '�������� ��������',
	'lastcom_lnk' => '�������� ���������',
	'topn_lnk' => '���������',
	'toprated_lnk' => '������ ���������',
	'search_lnk' => '�����������',
     'fav_lnk' => '��� �������', //new in cpg1.2.0
    );

$lang_gallery_admin_menu = array(	
     'upl_app_lnk' => '������� �� �����������',
	'config_lnk' => '������������',
	'albums_lnk' => '������',
	'categories_lnk' => '���������',
	'users_lnk' => '���������',
	'groups_lnk' => '�����',
	'comments_lnk' => '���������',
	'searchnew_lnk' => '�����������',
        'util_lnk' => '�������� �� �������� �� �����',  //new in cpg1.2.0
        'ban_lnk' => '��������� ���������',  //new in cpg1.2.0
    );

$lang_user_admin_menu = array(
	'albmgr_lnk' => '������/������ �� ����� ������',
	'modifyalb_lnk' => '�������� �� ����� ������',
	'my_prof_lnk' => '�� ������',
    );

$lang_cat_list = array(
	'category' => '���������',
	'albums' => '������',
	'pictures' => '�����',
    );

$lang_album_list = array(
	'album_on_page' => '%d ����� �� %d ��������'
    );

$lang_thumb_view = array(
    'date' => '�����',
    'name' => '���', //new in cpg1.2.0
    'title' => '������', //new in cpg1.2.0'sort_da' => 'Sort by date ascending',
	'sort_da' => '��������� �� ������ �� ����',
	'sort_dd' => '��������� �� ������� �� ����',
	'sort_na' => '��������� �� ������ �� ���',
	'sort_nd' => '��������� �� ������� �� ���',
        'sort_ta' => '��������� �� ��������� ������',  //new in cpg1.2.0
        'sort_td' => '��������� �� ���������� ������',  //new in cpg1.2.0
	'pic_on_page' => '%d �����(�) �� %d ��������',
	'user_on_page' => '%d ��������� �� %d ��������',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
	'thumb_title' => '�������� �� ����������',
	'pic_info_title' => '������/����� ���� �� ������������',
	'slideshow_title' => 'Slideshow',
     'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
	'ecard_title' => '������� �� ���� ����� ���� �����������',
	'ecard_disabled' => '������������� � ���������',
	'ecard_disabled_msg' => '�� �� � ��������� �� �� �������� �������������',
	'prev_title' => '��������� �� ����������� �����',
	'next_title' => '��������� �������� �����',
	'pic_pos' => '�����(�) %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array(
     'rate_this_pic' => '����� �� ���� �����',
	'no_votes' => '(���� ���� ������)',
	'rating' => '(���������� ������ : %s / 5 �� %s �������)',
	'rubbish' => '��� �����',
	'poor' => '�����',
	'fair' => '���� �� ������',
	'good' => '�����',
	'excellent' => '�������',
	'great' => '�����������',
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
	CRITICAL_ERROR => '�������� ������',
	'file' => 'Datoteka: ',
	'line' => 'Linija: ',
    );

$lang_display_thumbnails = array(
	'filename' => '��� �� ��������: ',
	'filesize' => '��������: ',
	'dimensions' => '��������: ',
	'date_added' => '��������: '
    );

$lang_get_pic_data = array(
	'n_comments' => '%s ���������',
	'n_views' => '%s ��������',
	'n_votes' => '(%s �������)'
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
	'Exclamation' => '�����',
	'Question' => '�������',
	'Very Happy' => '����� �����',
	'Smile' => '��������',
	'Sad' => '�����',
	'Surprised' => '���������',
	'Shocked' => '�������',
	'Confused' => '������',
	'Cool' => '����',
	'Laughing' => '�����',
	'Mad' => '�����',
	'Razz' => '�����',
	'Embarassed' => '����������',
	'Crying or Very sad' => '����� �����',
	'Evil or Very Mad' => '���',
	'Twisted Evil' => '�����',
	'Rolling Eyes' => '��������� ���',
	'Wink' => '������',
	'Idea' => '����',
	'Arrow' => '�������',
	'Neutral' => '���������',
	'Mr. Green' => '�. �����',
);       
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => '��������� �� ������������������ ��� ...',
	1 => '���� �� ����������������� ��� ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '����� �� �� ������ ����� �� ������� !',
	'confirm_modifs' => '���� ��� ������� �� �������� �� ��������� ������� ?',
	'no_change' => '�� ��� ��������� ������� ������� !',
	'new_album' => '��� �����',
	'confirm_delete1' => '���� ��� ������� �� �������� �� �� ��������� ��� ����� ?',
	'confirm_delete2' => '\����� ����� � ��������� ��� �� ���� �� ����� ��������� !',
	'select_first' => '���� �������� �����',
	'alb_mrg' => '����������� �� �������',
	'my_gallery' => '* ��� ������� *',
	'no_category' => '* ���� ��������� *',
	'delete' => '�������',
	'new' => '����',
	'apply_modifs' => '������� �������',
	'select_category' => '������ ���������',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '�������� ��������� �� \'%s\'��������� �� � �������� !',
	'unknown_cat' => '��������� ��������� �� ������ �� ������ �� ��������',
	'usergal_cat_ro' => '������������ ��������� ������ �� ���� ��������� !',
	'manage_cat' => '���������� �� �����������',
	'confirm_delete' => '���� ��� ������� �� ������� �� �� ��������� ���� ���������',
	'category' => '���������',
	'operations' => '��������',
	'move_into' => '������� ��',
	'update_create' => '������/������� ���������',
	'parent_cat' => '������� ���������',
	'cat_title' => '��� �� ���������',
	'cat_desc' => '���� �� ���������'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '������������',
	'restore_cfg' => '����� �� ��������� ������������',
	'save_cfg' => '����� ���� ������������',
	'notes' => '��������',
	'info' => '����������',
	'upd_success' => '�������������� � ��������',
	'restore_success' => '�������� �� �������������� � �������',
	'name_a' => '��� �� ������',
	'name_d' => '��� �� �������',
        'title_a' => '������ ������',  //new in cpg1.2.0
        'title_d' => '������� ������',  //new in cpg1.2.0
	'date_a' => '���� �� ������',
	'date_d' => '���� �� �������',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => '���� �����',
        'th_ht' => '������',
        'th_wd' => '������',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
	'������� ����������',
	array('��� �� �������', 'gallery_name', 0),
	array('���� �� �������', 'gallery_description', 0),
	array('����� �� ��������������� �� ���������', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
	array('�����', 'lang', 5),
	// for postnuke change
        array('����', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Album list view',
	array('������ �� �������� ������ (������� ��� %)', 'main_table_width', 0),
	array('��� �� ����� �� ��������� �� �����������', 'subcat_level', 0),
	array('��� ������ �� �����������', 'albums_per_page', 0),
	array('��� ������ �� ������� �� �������', 'album_list_cols', 0),
	array('�������� �� ���������� �� �������', 'alb_list_thumb_size', 0),
	array('�������� �� ���������� ��������', 'main_page_layout', 0),
        array('������ �� ������ ���� �� ����� ���������� �� ���������','first_level',1),  //new in cpg1.2.0
        // 'Thumbnail view',
        'Thumbnail view',
	array('��� �� ������ �� �������� �� ����������', 'thumbcols', 0),
	array('��� �� ������ �� �������� �� ����������', 'thumbrows', 0),
	array('���������� ��� �� ������ �� �����������', 'max_tabs', 0),
	array('����������� �� ������� ���� ������ �� ������ (�� �������� �� �������) ���� �� ����������', 'caption_in_thumbview', 1),
	array('������ �� ����� �� ��������� ���� �� ����������', 'display_comment_count', 1),
	array('�������� �� ��� ��� �� �������', 'default_sort_order', 3),
	array('������� ��� �� ������� �� ����� ���������� �� \'top-rated\' list', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Image view &amp; Comment settings',
        array(
		'������ �� ������ �� ����������� �� �������(������� ��� %)', 'picture_table_width', 0),

	array(
		'���������� �� ������� �� ��������� �� ���������', 'display_pic_info', 1),
	array(
		'������ �� ���� ������� � ���������', 'filter_bad_words', 1),
	array(
		'����� ������� �� ���������', 'enable_smilies', 1),
	 array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
	array(
		'���������� ������� �� ���� �� ������������', 'max_img_desc_length', 0),
	array(
		'���������� ��� �� ��������� �� ������', 'max_com_wlength', 0),
	array(
		'���������� ��� �� ����� �� ��������', 'max_com_lines', 0),
	array(
		'���������� ������� �� ��������', 'max_com_size', 0),
        array(
        	'������  ���� �����', 'display_film_strip', 1),  //new in cpg1.2.0
        array(
        	'��� �� ������ �� ���� �����', 'max_film_strip_items', 0), 
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Pictures and thumbnails settings',
	array('�������� �� ���� ������', 'jpeg_qual', 0),
        array('���������� �������� �� �������� <strong>*</strong>', 'thumb_width', 0),  //new in cpg1.2.0
        array('��������� �������� ( ������ ��� ������ ��� ���������� ������ �� �������� )<strong>*</strong>', 'thumb_use', 7),  //new in cpg1.2.0
	array('�������� �� �������� �����','make_intermediate',1),
	array('���������� ������ ��� ������ �� �������� ����� <strong>*</strong>', 'picture_width', 0),
	array('���������� �������� �� ����������� ����� (KB)', 'max_upl_size', 0),
	array('���������� ������ � ������ �� ����������� �����  (�������)', 'max_upl_width_height', 0),
       // 'User settings',
        '��������� ����������',
        	array('���� �������� �� �����������', 'allow_user_registration', 1),
	array('����������� �� ���������� �������� ����� �����������', 'reg_requires_valid_email', 1),
	array('���� ����� ��������� ����� ���� ����� ������', 'allow_duplicate_emails_addr', 1),
	array('����������� ����� �� ����� �������� ������', 'allow_private_albums', 1),
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Custom fields for image description (leave blank if unused)',
	array('���� 1 ���', 'user_field1_name', 0),
	array('���� 2 ���', 'user_field2_name', 0),
	array('���� 3 ���', 'user_field3_name', 0),
	array('���� 4 ���', 'user_field4_name', 0),
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
	'empty_name_or_com' => '�������� � �� �� ������� ������ ��� � ��������',
	'com_added' => '������ �������� � �������',
	'alb_need_title' => '������ �� �� ������� ����� �� ������� !',
	'no_udp_needed' => '�� � �������� ����������.',
	'alb_updated' => '������� � �������',
	'unknown_album' => '��������� ����� �� ������ ��� ������ ������� �� ����������� �� ��� �����',
	'no_pic_uploaded' => '������� �� � �������� !<br /><br />��� ��������� �� �������� ������� �� �����������,����� � ���������� ������...',
	'err_mkdir' => '�� � ����� �� �� ������� ����������� %s !',
	'dest_dir_ro' => '���������� �� ������������� %s �� � ������� �� ������� !',
	'err_move' => '�� � ����� �� �� �������� %s u %s !',
	'err_fsize_too_large' => '���������� �� ������� ��� �� ������������ � ��������� (���������� ��������� �  %s x %s) !',
	'err_imgsize_too_large' => '���������� ��� �� ������������ � ��������� (���������� ��������� � %s KB) !',
	'err_invalid_img' => '���������� ��� �� ����������� �� � �������� ������ �� ������� !',
	'allowed_img_types' => '������ �� ����������� ���� %s �����(�).',
	'err_insert_pic' => '�����(�) \'%s\' (��)���� �� ���� ������� �� �����',
	'upload_success' => '������ ����� � ����������� �������<br /><br />������� �� ���� ������� ����� ������������������ �������.',
	'info' => '����������',
	'com_added' => '������� ��������',
	'alb_updated' => '������� �����',
	'err_comment_empty' => '������ �������� � ������ !',
	'err_invalid_fext' => '���� ���������� �� �������� ��������� �� ���������� : <br /><br />%s.',
	'no_flood' => '��� �� � ��� ��� ��� ����� �� ���������� �������� ������ �� ���� �����<br /><br />���������� �� ���������� �� �� ���������� ��� ������ �� �� ������� ���������� �� �������',
	'redirect_msg' => '�� ������ ���������� ���������.<br /><br /><br />Klinki \'CONTINUE\' ��� ���������� �� �� ������ ����������',
	'upl_success' => '������� � ������� �������',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '���',
	'fs_pic' => '���� �������� �� �������',
	'del_success' => '�������',
	'ns_pic' => '�������� �������� �� �������',
	'err_del' => '�� ���� �� �� �������',
	'thumb_pic' => '��������',
	'comment' => '��������',
	'im_in_alb' => '����� �� ����������',
	'alb_del_success' => '����� \'%s\' ��������',
	'alb_mgr' => '����������� �� �������',
	'err_invalid_data' => '���������� �������� ������� �� \'%s\'',
	'create_alb' => '�������� �� �����\'%s\'',
	'update_alb' => '���������� �� ����� \'%s\' �� ���� \'%s\' � ������ \'%s\'',
	'del_pic' => '������� �����',
	'del_alb' => '������� �����',
	'del_user' => '������� �� ����������',
	'err_unknown_user' => '��������� �������� �� ������ !',
	'comment_deleted' => '���������� � ������� ��������',
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
    		'confirm_del' => '���� ������� ������ �� �� ��������� ���� ����� ? \\� ��������� �������� �� ����� ���������.',
	'del_pic' => '������� �� ���� �����',
	'size' => '%s x %s �������',
	'views' => '%s ����',
	'slideshow' => '���� ���',
	'stop_slideshow' => '������� �� ����������',
	'view_fs' => '������ �� �� ����� �� ������� ��������',
        );
$lang_picinfo = array(
	'title' =>'���������� �� �������',
	'Filename' => '��� �� ����������',
	'Album name' => '��� �� �������',
	'Rating' => '������(%s �������)',
	'Keywords' => '������ �������',
	'File Size' => '�������� �� ����������',
	'Dimensions' => '��������',
	'Displayed' => '���������',
	'Camera' => '������',
	'Date taken' => '���� �� ������',
	'Aperture' => '�����',
	'Exposure time' => '����� �� ��������',
	'Focal length' => '��������� �� ������',
	'Comment' => '��������',
        'addFav' => '���������� �� �������',  //new in cpg1.2.0
        'addFavPhrase' => '�������',  //new in cpg1.2.0
        'remFav'=>'������������ �� �������',  //new in cpg1.2.0
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

$lang_display_comments = array(
	'OK' => '��',
	'edit_title' => '�������� �� ��� ��������',
	'confirm_delete' => '���� ��� ������� �� �������� �� �� ��������� ��� �������� ?',
	'add_your_comment' => '�������� ��� ��������',
        'name'=>'���',  //new in cpg1.2.0
        'comment'=>'��������',  //new in cpg1.2.0
	'your_name' => '���� ���',
        );
$lang_fullsize_popup = array(
        'click_to_close' => '������ �� ����� �� �� �� ������� ��� ��������',  //new in cpg1.2.0
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array(
	'title' => '������� �-����',
	'invalid_email' => '<strong>Ops</strong> : ���������� ����� ������!',
	'ecard_title' => '����������� �� %s �� ����',
	'view_ecard' => '��� ������������� �� � �������� ���������,�������� �� ��� ����',
	'view_more_pics' => '�������� �� ��� ���� �� �� ������ ����� �����!',
	'send_success' => '������ ����������� � ���������',
	'send_failed' => '��� �� �, �� �������� �� ���� �� �� ������� ������ ����������� ...',
	'from' => '��',
	'your_name' => '���� ���',
	'your_email' => '���� ����� ������',
	'to' => '��',
	'rcpt_name' => '���� �� ��������',
	'rcpt_email' => '����� ������ �� ��������',
	'greetings' => '������',
	'message' => '������',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '�����&nbsp;info',
	'album' => '�����',
	'title' => '������',
	'desc' => '����',
	'keywords' => '������ �������',
	'pic_info_str' => '%sx%s - %sKB - %s �������� - %s �������',
	'approve' => '������ �� �������',
	'postpone_app' => '������ �� ������������',
	'del_pic' => '������� �� �������',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
	'reset_view_count' => '�������� �� ����� �� ��������',
	'reset_votes' => '�������� �� ���������',
	'del_comm' => '������� �� �����������',
	'upl_approval' => '������ �����������',
	'edit_pics' => '�������� �� �������',
	'see_next' => '�������� �� �������� �����',
	'see_prev' => '�������� �� ����������� �����',
	'n_pic' => '%s �����',
	'n_of_pic_to_disp' => '��� �� ����� �� �����������',
	'apply' => '������� �������'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '��� �� �������',
	'disk_quota' => '����� �� ������',
	'can_rate' => '���� �� �� ����� �������',
	'can_send_ecards' => '���� �� �� ������� �������������',
	'can_post_com' => '���� �� �� ���������',
	'can_upload' => '���� �� �� ��������� �������',
	'can_have_gallery' => '���� �� �� ��� ����� �������',
	'apply' => '������� �������',
	'create_new_group' => '������ ���� �����',
	'del_groups' => '������� �� ��������� �����',
	'confirm_del' => '��������,���� �������� �����, ��������� ��� ��������� �� ������� �� ����� ��������� �� \'������������\' �����!\�\����� ����� �� ���������?',
	'title' => '���������� ���������� �����',
        'approval_1' => 'Pub. Upl. approval (1)',
        'approval_2' => 'Priv. Upl. approval (2)',
	'note1' => '<strong>(1)</strong> �� ����������� �� ����� ����� �������� � ������� �� ���������������',
	'note2' => '<strong>(2)</strong> �� ����������� �� ����� �� ������� �� ���������� �������� � ������� �� ���������������',
	'notes' => '��������'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array(
	'welcome' => '����� �������!'
        );
$lang_album_admin_menu = array(
	'confirm_delete' => '���� ��� ������� �� �������� �� �� ��������� ��� �����? \\����� ����� � ��������� �� ����� �������� ���������.',
	'delete' => '�������',
	'modify' => '��������������',
	'edit_pics' => '��������',
);

$lang_list_categories = array(
	'home' => '�������',
	'stat1' => '<strong>[pictures]</strong> ����� �� <strong>[albums]</strong> ����� � <strong>[cat]</strong> ��������� �� <strong>[comments]</strong> ���������� ��������� <strong>[views]</strong> ����',
	'stat2' => '<strong>[pictures]</strong> ����(�) �� <strong>[albums]</strong> ������ ���������� <strong>[views]</strong> ����',
	'xx_s_gallery' => '%s\'s �������',
	'stat3' => '<strong>[pictures]</strong> ����� �� <strong>[albums]</strong> ����� �� <strong>[comments]</strong> ��������� ���������� <strong>[views]</strong> ����'
);
$lang_list_users = array(
	'user_list' => '����� �� ���������',
	'no_user_gal' => '���� ���������� �������',
	'n_albums' => '%s �����(�)',
	'n_pics' => '%s �����(�)'
);

    $lang_list_albums = array(
	'n_pictures' => '%s �����(�)',
	'last_added' => ', �������� �������� %s'
);
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '������ �� ������� %s',
	'general_settings' => '������� �������',
	'alb_title' => '������ �� �������',
	'alb_cat' => '��������� �� �������',
	'alb_desc' => '���� �� �������',
	'alb_thumb' => '�������� �� �������',
	'alb_perm' => '������� �� ��� �����',
	'can_view' => '������� ���� �� ���� ������',
	'can_upload' => '������������ ����� �� �� ����������� �����',
	'can_post_comments' => '������������ ����� �� �������� ���������',
	'can_rate' => '������������ ����� �� �� ��������� �������',
	'user_gal' => '������� �� ����������',
	'no_cat' => '* ���� ��������� *',
	'alb_empty' => '������� � ������',
	'last_uploaded' => '�������� �����������',
	'public_alb' => '����(����� �����)',
	'me_only' => '���� ���',
	'owner_only' => '���������� �� ����� (%s) ����',
	'groupp_only' => '������� ��\'%s\' �����',
	'err_no_alb_to_modify' => '�� ������ �� �������� ���� ����� �� ������ �� �� ����������.',
	'update' => '������ �����'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '��� �� � ��� �� �������� �������',
	'rate_ok' => '������ ����',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Za postavljanje vlastitih fotografija u galeriju potrebno je registrovati se. Prilikom registracije obavezno morate upisati va�u ispravnu, postoje�u email adresu, na koju �e vam biti poslan email sa linkom kojim �ete potvrditi va�u registraciju.<br />
<br />
Sla�em se da ne�u postavljati bilo kakve uznemiruju�e, pornografske, vulgarne fotografije kao i fotografije koje poti�u na bilo kakav oblik mr�nje. Sla�em se tako�e da Administrator ovog dijela Administrator ima pravo da izbri�e sve fotografije koje nisu prihvatljive, odnosno nabrojane kategorije fotografija. Sla�em se da Administrator mo�e izbrisati svaki moj komentar ukoliko ocijeni da nije prikladan. Kao korisnik ovoe foto galerije sla�em se da svi moji podaci koje upi�em u registracijsku formu budu pohranjeni u bazu podataka. Ukoliko na bilo kakav na�in uznemiravam foto galeriju sla�em se da administator banuje moju IP adresu, odnosno da mi do daljnjeg zabrani pristup ovoim stranicama. I tako dalje, nadamo se da �ete po�tovati ova pravila.<br />
<br />
Ova stranica koristi cookies za pohranu podataka na va�em ra�unaru. Email adresa se koristi samo za potvrdu va�e registracije.<br />
<br />
Klikom na 'Sla�em se' prihvatate uslove kori�tenja i nadamo se da ih ne�ete prekr�iti.
EOT;

$lang_register_php = array(
	'page_title' => '�����������',
	'term_cond' => '������� � ������',
	'i_agree' => '�� ��������',
	'submit' => '������� �� �������������',
	'err_user_exists' => '��������� ���������� ��� ��� � ������������, ������� ����� �����',
	'err_password_mismatch' => '����������� ��� �����, �������� �������',
	'err_uname_short' => '������������ ��� ���� �� ��� ������� 2 �����',
	'err_password_short' => '������� ���� �� ��� ������� 2 �����',
	'err_uname_pass_diff' => '������������ ��� � ������� �� ����� �� ����� ���� ���',
	'err_invalid_email' => '���������� ����� ������',
	'err_duplicate_email' => '��� � ���� ����������� �� ���� ����� ������ �� ��� �� ��������',
	'enter_info' => '������� �� ���������� �� �����������',
	'required_info' => '�������� ��������',
	'optional_info' => '������������ ��������',
	'username' => '���������� ���',
	'password' => '�����',
	'password_again' => '�������� �����',
	'email' => '�����',
	'location' => '�������',
	'interests' => '��������',
	'website' => '��� ��������',
	'occupation' => '��������',
	'error' => '������',
	'confirm_email_subject' => '%s - ��������� �� �������������',
	'information' => '����������',
	'failed_sending_email' => '��������������� ���������� �� ���� �� �� ������� !',
	'thank_you' => '�� ����������� �� �������������.<br /><br />����� �� ���������� ���� �� ���������� ���� ���������� ������ � �������� �� ����� ������ ��� �� �������� ��� �����������.',
	'acct_created' => '������ ���������� ������ � �������� � ������ �� ������������ ���������� �� ������ ���������� ��� � �����',
	'acct_active' => '������ ���������� ������ �� ���� � ������� � ������ �� ���������� �� ���������� �� ������ ���������� ��� � �����',
	'acct_already_act' => '������ ���������� ������ � ��� �������!',
	'acct_act_failed' => '���� ���������� ������ �� ���� �� ���� �������!',
	'err_unk_user' => '��������� �������� �� ������!',
	'x_s_profile' => '%s\'s ������',
	'group' => '�����',
	'reg_date' => '�����������(�)',
	'disk_usage' => '������������� �� ���� ���������',
	'change_pass' => '������� �� �������',
	'current_pass' => '���������� �����',
	'new_pass' => '���� �����',
	'new_pass_again' => '���� ����� ��������',
	'err_curr_pass' => '������������ ����� �� � ��������',
	'apply_modif' => '������ �������',
	'change_pass' => '������� �� ����� �����',
	'update_success' => '������ ������ � �������',
	'pass_chg_success' => '������ ����� � ���������',
	'pass_chg_error' => '������ ����� �� � ���������',
);

$lang_register_confirm_email = <<<EOT
Hvala na registraciji na {SITE_NAME}

Va�e korisni�ko ime : "{USER_NAME}"
Va�a �ifra : "{PASSWORD}"

Da bi aktivirali va� korisni�ki ra�un potrebno je da kliknete na link ispod ili ako �elite kopirajte link i nalijepite u va� web browser.

{ACT_LINK}

Pozdrav,

Team {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '��������� �� �����������',
	'no_comment' => '���� ��������� �� ������',
	'n_comm_del' => '%s ����������� �� ���������',
	'n_comm_disp' => '��� ��������� �� �����������',
	'see_prev' => '������� ���������',
	'see_next' => '������� �� ��������',
	'del_comm' => '������� �� ��������� ���������',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '��������� �� ���������� �� �����',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '��������� ���� �����',
	'select_dir' => '����� �����������',
	'select_dir_msg' => '���� ������� ��������� �� ��������� ��� �� ������� ��� �� ����� �� ����� ������.<br /><br />�������� ����������� ���� �� ������������ ������ �����',
	'no_pic_to_add' => '���� ����� �� ��������',
	'need_one_album' => '������ �� ����� ������� ���� ����� �� �� �� ��������� ���� �������',
	'warning' => '��������������',
	'change_perm' => '��������� �� ���� �� �� ����� �� ��� �����������, ������ �� �� ������� ����� �� 755 ili 777 ���� �� �������� �����!',
	'target_album' => '<strong>������� �� ������� �� &quot;</strong>%s<strong>&quot; u </strong>%s',
	'folder' => '������',
	'image' => '�����',
	'album' => '�����',
	'result' => '��������',
	'dir_ro' => '�� � �������. ',
	'dir_cant_read' => '�� � �������. ',
	'insert' => '�������� �� ���� ����� �� �������',
	'list_new_pic' => '����� �� ���� �����',
	'insert_selected' => '����� �� ��������� �����',
	'no_pic_found' => '�� � ��������� ���� �����',
	'be_patient' => '�� ������ ������ ��������, �� ��������� � ����� ����� �� �� ������ �������',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : zna�i da je slika uspje�no dodana'.
				'<li><strong>DP</strong> : zna�i da je slika duplikat i da je ve� u bazi podataka'.
				'<li><strong>PB</strong> : zna�i da sliku nije mogu�e dodati, provjerite vlastitu konfiguraciju i dozvolu direktorija gdje su slike locirane'.
				'<li>Ako OK, DP, PB \'signs\' se ne pojave klikni na puknutu sliku da vidi� koju je gre�ku napravio PHP'.
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
	'title' => '��������� �����',
	'max_fsize' => '���������� ��������� �������� � %s KB',
	'album' => '�����',
	'picture' => '�����',
	'pic_title' => '������ �� �������',
	'description' => '���� �� �����',
	'keywords' => '������ ������� (������ ������ �����)',
	'err_no_alb_uploadables' => '��� �� � ���� ���� ������ ���� ���� �� ������� �����.',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '���������� �� �����������',
	'name_a' => '��� �� ����������',
	'name_d' => '��� �� ����������',
	'group_a' => '����� �� ����������',
	'group_d' => '����� �� ����������',
	'reg_a' => '����� �� ����������� �� ����������',
	'reg_d' => '����� �� ����������� �� ����������',
	'pic_a' => '��� �� �������� �����',
	'pic_d' => '��� �� �������� �����',
	'disku_a' => '������������� �� ���������� ����',
	'disku_d' => '������������� �� ���������� ����',
	'sort_by' => '������ �� ����������� ��',
	'err_no_users' => '������������ ����� � ������!',
	'err_edit_self' => '�� ������ �� �� �������� ����� ������, ��������� \'My profile\' ����� �� ���',
	'edit' => '�������',
	'delete' => '�������',
	'name' => '���������� ���',
	'group' => '�����',
	'inactive' => '���������',
	'operations' => '��������',
	'pictures' => '�����',
	'disk_space' => '���������� ������� / �����',
	'registered_on' => '�����������',
	'u_user_on_p_pages' => '%d ��������� ��%d ������',
	'confirm_del' => '���� ��� ������� �� �������� �� �� ��������� ����������? \\����� ������ ����� � ������ �� ����� ���������.',
	'mail' => '����',
	'err_unknown_user' => '��������� �������� �� ������!',
	'modify_user' => '���������� �� �����������',
	'notes' => '���������',
	'note_list' => '<li>��� �� ������ �� �� ��������� ������������ �����,�������� �� ������ �� "�����" ������',
	'password' => '�����',
	'user_active' => '���������� � �������',
	'user_group' => '�����',
	'user_email' => '�����',
	'user_web_site' => '��� ��������',
	'create_new_user' => '������ ��� ��������',
        'user_from' => '�������', // different var in cpg1.2.0nuke
        'user_interests' => '��������',
        'user_occ' => '��������', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => '������� �� ���������� �� �������', 
        'what_it_does' => '��� � ���', 
        'what_update_titles' => '������� �� ��������� �� ��� ������', 
        'what_delete_title' => '������� �������', 
        'what_rebuild' => '�������� ������� �� ���������� � �������� ���������� �� ������������', 
        'what_delete_originals' => '������� �� ������������ �������� �� ������������ �������� �� �� ����������� ��������', 
        'file' => '���', 
        'title_set_to' => '������ �� ��������', 
        'submit_form' => '���������', 
        'updated_succesfully' => '������� �������', 
        'error_create' => '�������� � ������', 
        'continue' => '������� ����� ����������', 
        'main_success' => '����� %s ���� ������� ���������� ���� ������ �����', 
        'error_rename' => '������ �� ����������� %s �� %s', 
        'error_not_found' => '����� %s �� ���� �����', 
        'back' => '����� �� ��������', 
        'thumbs_wait' => '��������� �������� �/��� �������� �� ���������� �� ������������, �� ������ ��������� ...', 
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
        'titles_wait' => '��������� �� �������, �� ������ ���������...', 
        'delete_wait' => '������ �� �������, �� ������ ��������...', 
        'replace_wait' => '������ �� ��������� � ������������ �� ������ �� �������� �� ���������� �� ������������, �� ������ ��������..', 
        'instruction' => '���� ����������', 
        'instruction_action' => '����������� �����', 
        'instruction_parameter' => '������ ���������', 
        'instruction_album' => '��������� �����', 
        'instruction_press' => '�������� %s', 
        'update' => '������� �� ���������� �/��� �������� ���������� �� ������������', 
        'update_what' => '��� �� ���� ���������', 
        'update_thumb' => '���� ��������', 
        'update_pic' => '���� ���������� �����', 
        'update_both' => '� �������� � �������� �����', 
        'update_number' => '��� �� ����������� ���������� �� ����������', 
        'update_option' => '(����� �� �� �� ������� ���� ����� ������ ������� ��� �������� �� �������)', 
        'filename_title' => '��� �� ��� ? ������ �� �����', 
        'filename_how' => '����� �� ������ �� �� ���������� ����� �� �����', 
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces',
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20',
        'delete' => '������� �� �������� �� ������� ��� ������������ �������� �� ������������', 
        'delete_title' => '������� �� �������� �� �������', 
        'delete_original' => '������� �� ������������ �������� �� ������������', 
        'delete_replace' => '������� ���������� ���������� � �������� �� ��� �� ����������� ��������', 
        'select_album' => '��������� �����', 
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