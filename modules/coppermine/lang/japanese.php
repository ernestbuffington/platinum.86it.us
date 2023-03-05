<?php 
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
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// to all devs: stop overwriting this file!
// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Japanese', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Japanese', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'jp', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Mitsuhiro Yoshida', // the name of the translator - can be a nickname
    'trans_email' => 'mits@mitstek.com', // translator's email address (optional)
    'trans_website' => 'http://mitstek.com/', // translator's website (optional)
    'trans_date' => '2003-11-07', // the date the translation was created / last modified
    );

$lang_charset = 'EUC-JP';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('�Х���', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('��', '��', '��', '��', '��', '��', '��');
$lang_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
// Some common strings
$lang_yes = 'Yes';
$lang_no = 'No';
$lang_back = '���';
$lang_continue = '³����';
$lang_info = '����';
$lang_error = '���顼';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%Yǯ%B��%d��';
$lastcom_date_fmt = '%y/%m/%d/ %H:%M';
$lastup_date_fmt = '%Yǯ%B��%d��';
$register_date_fmt = '%Yǯ%B��%d��';
$lasthit_date_fmt = '%Yǯ%B��%d�� %I:%M %p';
$comment_date_fmt = '%Yǯ%B��%d�� %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => '������̿�',
    'lastup' => '����̿�',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => '�ǿ�����Х�',
    'lastcom' => '�ǿ�������',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => '��¿����',
    'toprated' => '�ȥåץ졼��',
    'lasthits' => '�ǽ�����',
    'search' => '�������',
    'favpics' => '����������'
    );

$lang_errors = array('access_denied' => '���Υڡ������Ф��륢��������������ޤ���',
    'perm_denied' => '��������Ԥ����¤�����ޤ���',
    'param_missing' => 'ɬ�פʥѥ�᡼��̵���ǥ�����ץȤ��¹Ԥ���ޤ�����',
    'non_exist_ap' => '���򤵤줿����Х�/�̿���¸�ߤ��ޤ��� !',
    'quota_exceeded' => '�ǥ����������̥����С�<br /><br />���ʤ������ѤǤ���ǥ��������̤� [quota]K�Ǥ������� [space]K����Ѥ��Ƥ��ޤ������μ̿����ɲä���ȥǥ��������̤������С����ޤ���',
    'gd_file_type_err' => 'GD���᡼���饤�֥�꡼����Ѥ����硢JPEG��PNG�����Υե�����Τ����Ѳ�ǽ�Ǥ���',
    'invalid_image' => '���ʤ������åץ��ɤ�����������»��������GD�饤�֥�꡼�ǽ������뤳�Ȥ�����ޤ���',
    'resize_failed' => '���������������������ᡢ����ͥ�����������ޤ���',
    'no_img_to_display' => 'ɽ����������Ϥ���ޤ���',
    'non_exist_cat' => '���򤷤����ƥ��꡼��¸�ߤ��ޤ���',
    'orphan_cat' => '¸�ߤ��ʤ��ƥ��ƥ��꡼����äƤ��ޤ������ƥ��꡼�ޥ͡����㡼��Ȥä�������褷�Ƥ���������',
    'directory_ro' => '�ǥ��쥯�ȥ� \'%s\' �˽���߸�������ޤ��󡣼̿��κ���Ͻ���ޤ���',
    'non_exist_comment' => '���򤷤������Ȥ�¸�ߤ��ޤ���',
    'pic_in_invalid_album' => '¸�ߤ��ʤ�����Х�(%s)��˼̿�������ޤ� !?',
    'banned' => '���ʤ��ϸ��ߤ��Υ����ȤؤΥ�����������ݤ���Ƥ��ޤ���',
    'not_with_udb' => '�ե�����ॽ�եȤ����礵�줿�١����ε�ǽ��Coppermine��̵���ˤ���Ƥ��ޤ����ե�����ॽ�եȤǴ��������١����ε�ǽ�˴ؤ�������ϡ������ǥ��ݡ��Ȥ���ޤ���',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'

    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => '����Х�ꥹ�Ȥذ�ư',
    'alb_list_lnk' => '����Х�ꥹ��',
    'my_gal_title' => '�ѡ����ʥ륮���꡼�ذ�ư',
    'my_gal_lnk' => '�ޥ������꡼',
    'my_prof_lnk' => '�ޥ��ץ�ե�����',
    'adm_mode_title' => '�����ԥ⡼�ɤ��ѹ�',
    'adm_mode_lnk' => '�����ԥ⡼��',
    'usr_mode_title' => '�桼���⡼�ɤ��ѹ�',
    'usr_mode_lnk' => '�桼���⡼��',
    'upload_pic_title' => '����Х�˼̿��򥢥åץ���',
    'upload_pic_lnk' => '�̿��Υ��åץ���',
    'register_title' => '��������Ȥκ���',
    'register_lnk' => '�桼����Ͽ',
    'login_lnk' => '������',
    'logout_lnk' => '��������',
    'lastup_lnk' => '�ǿ����åץ���',
    'lastcom_lnk' => '�ǿ�������',
    'topn_lnk' => '��¿����',
    'toprated_lnk' => '�ȥåץ졼��',
    'search_lnk' => '����',
    'fav_lnk' => '����������',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => '���åץ��ɾ�ǧ',
    'config_lnk' => '����',
    'albums_lnk' => '����Х�',
    'categories_lnk' => '���ƥ���',
    'users_lnk' => '�桼��',
    'groups_lnk' => '���롼��',
    'comments_lnk' => '������',
    'searchnew_lnk' => '�̿��ΰ����Ͽ',
    'util_lnk' => '�̿��Υꥵ����',
    'ban_lnk' => '���������ػߥ桼��',
    );

$lang_user_admin_menu = array('albmgr_lnk' => '�ޥ�����Х�κ��� / ����',
    'modifyalb_lnk' => '�ޥ�����Х�ν���',
    'my_prof_lnk' => '�ޥ��ץ�ե�����',
    );

$lang_cat_list = array('category' => '���ƥ���',
    'albums' => '����Х�',
    'pictures' => '�̿�',
    );

$lang_album_list = array('album_on_page' => '����Х�� %d / %d�ڡ�����'
    );

$lang_thumb_view = array('date' => '����', 
    // Sort by filename and title
    'name' => '�ե�����̾',
    'title' => '�����ȥ�',
    'sort_da' => '���դξ�����¤��ؤ�',
    'sort_dd' => '���դι߽���¤��ؤ�',
    'sort_na' => '�ե�����̾�ξ�����¤��ؤ�',
    'sort_nd' => '�ե�����̾�ι߽���¤��ؤ�',
    'sort_ta' => '�̿������ȥ�ξ�����¤��ؤ�',
    'sort_td' => '�̿������ȥ�ι߽���¤��ؤ�',
    'pic_on_page' => '�̿���� %d / %d�ڡ�����',
    'user_on_page' => '�桼���� %d / %d�ڡ�����'
    );

$lang_img_nav_bar = array('thumb_title' => '����ͥ���ڡ��������',
    'pic_info_title' => '�̿������ɽ��/��ɽ��',
    'slideshow_title' => '���饤�ɥ��硼',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => '���μ̿���e-�����ɤȤ�����������',
    'ecard_disabled' => 'e-�����ɤ���������ޤ���',
    'ecard_disabled_msg' => 'e-�����ɤ��������븢�¤�����ޤ���',
    'prev_title' => '����',
    'next_title' => '����',
    'pic_pos' => '�̿� %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => '���μ̿���ɾ������',
    'no_votes' => '(̤��ɼ)',
    'rating' => '(���ߤΥ졼�ƥ���: %s/5&nbsp;&nbsp;&nbsp;��ɼ�� %s��)',
    'rubbish' => '��',
    'poor' => '����',
    'fair' => '����',
    'good' => '�ɤ�',
    'excellent' => '�����餷��',
    'great' => '����',
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
    CRITICAL_ERROR => '��̿Ū�ʥ��顼',
    'file' => '�ե�����: ',
    'line' => '��: ',
    );

$lang_display_thumbnails = array('filename' => '�ե�����̾ : ',
    'filesize' => '�ե����륵���� : ',
    'dimensions' => '�礭�� : ',
    'date_added' => '��Ͽ�� : '
    );

$lang_get_pic_data = array('n_comments' => '�����ȿ� %s',
    'n_views' => '������� %s',
    'n_votes' => '(��ɼ�� %s)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => '�ӥå���',
        'Question' => '����',
        'Very Happy' => '�ȤƤ⹬��',
        'Smile' => '���ޥ���',
        'Sad' => '�ᤷ��',
        'Surprised' => '�ä�',
        'Shocked' => '����å�',
        'Confused' => '����',
        'Cool' => '������',
        'Laughing' => '�Ф�',
        'Mad' => '�ܤ�',
        'Razz' => '��Ф�',
        'Embarassed' => '�Ѥ�������',
        'Crying or Very sad' => '�㤯���ϤȤƤ��ᤷ��',
        'Evil or Very Mad' => '�������ϤȤƤ��ܤä�',
        'Twisted Evil' => '���ϰ���',
        'Rolling Eyes' => 'ž������',
        'Wink' => '������',
        'Idea' => '�����ǥ���',
        'Arrow' => '����',
        'Neutral' => '��Ω',
        'Mr. Green' => '�ߥ����������꡼��',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => '�����ԥ⡼�ɤ�λ�� ...',
        1 => '�����ԥ⡼�ɤ˰ܹ��� ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => '����Х�ˤϥ���Х�̾��ɬ�פǤ� !',
        'confirm_modifs' => '�����˹������Ƥ⵹�����Ǥ��� ?',
        'no_change' => '�����ѹ�����Ƥ��ޤ��� !',
        'new_album' => '����������Х�',
        'confirm_delete1' => '�����ˤ��Υ���Х�������Ƥ⵹�����Ǥ��� ?',
        'confirm_delete2' => '\n����Х�˴ޤޤ�����Ƥμ̿��ȥ����ȤϺ������ޤ� !',
        'select_first' => '�ǽ�˥���Х�����򤷤Ƥ���������',
        'alb_mrg' => '����Х����',
        'my_gallery' => '* �ޥ������꡼ *',
        'no_category' => '* ���ƥ���̵�� *',
        'delete' => '���',
        'new' => '��������',
        'apply_modifs' => '������Ŭ��',
        'select_category' => '���ƥ�������',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => '��%s�פ�����ɬ�פʥѥ�᡼�����Ϥ���Ƥ��ޤ��� !',
        'unknown_cat' => '���򤷤����ƥ���ϥǡ����١�����¸�ߤ��ޤ���',
        'usergal_cat_ro' => '�桼�������꡼�Υ��ƥ��꡼�Ϻ������ޤ��� !',
        'manage_cat' => '���ƥ���δ���',
        'confirm_delete' => '�����ˤ��Υ��ƥ���������Ƥ⵹�����Ǥ��� ?',
        'category' => '���ƥ���',
        'operations' => '���',
        'move_into' => '��ư��',
        'update_create' => '���ƥ���κ���/����',
        'parent_cat' => '�ƥ��ƥ���',
        'cat_title' => '���ƥ���̾',
        'cat_desc' => '���ƥ�������'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
        'title' => '����',
        'restore_cfg' => '���󥹥ȡ���ľ��ξ��֤��᤹',
        'save_cfg' => '�������������¸����',
        'notes' => 'Notes',
        'info' => '����',
        'upd_success' => 'Coppermine�����꤬��������ޤ�����',
        'restore_success' => 'Coppermine�ǥե���Ȥ�����˥ꥹ�ȥ�����ޤ�����',
        'name_a' => '�̿�̾�ξ���',
        'name_d' => '�̿�̾�ι߽�',
        'title_a' => '�����ȥ�ξ���',
        'title_d' => '�����ȥ�ι߽�',
        'date_a' => '���դξ���',
        'date_d' => '���դι߽�',
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
        '��������',
        array(
            '�����꡼̾', 'gallery_name', 0),
        array(
            '�����꡼������', 'gallery_description', 0),
        array(
            '�����ԤΥ᡼�륢�ɥ쥹', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            '����', 'lang', 5),
// for postnuke change
        array('�ơ���', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        '����Х�ꥹ��ɽ��',
        array(
            '�ᥤ��ơ��֥���� (�ԥ���������%)', 'main_table_width', 0),
        array(
            '���ƥ��곬�ؤ�ɽ����', 'subcat_level', 0),
        array(
            '����Х��ɽ����', 'albums_per_page', 0),
        array(
            '����Х�ꥹ�Ȥ����', 'album_list_cols', 0),
        array(
            '����ͥ���Υ����� (�ԥ�����)', 'alb_list_thumb_size', 0),
        array(
            '�ᥤ��ڡ����Υ���ƥ��', 'main_page_layout', 0),
        array(
            '���ƥ��������٥�Υ���ͥ����ɽ������', 'first_level', 1), 
        // 'Thumbnail view',
        '����ͥ���ɽ��',
        array(
            '����ͥ���ڡ��������', 'thumbcols', 0),
        array(
            '����ͥ���ڡ����ιԿ�', 'thumbrows', 0),
        array(
            '���֤κ���ɽ����', 'max_tabs', 0),
        array(
            '����ͥ���β��˼̿�������ɽ������ (�̿�̾���ɲ�)', 'caption_in_thumbview', 1),
        array(
            '����ͥ���β���ɽ�����륳���ȿ�', 'display_comment_count', 1),
        array(
            '�̿�ɽ����Υǥե����', 'default_sort_order', 3),
        array(
            '�֥ȥåץ졼�ȡץꥹ�Ȥ�ɽ�������̿��κ�����ɼ��', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        '���������ȥ���������',
        array(
            '�̿�ɽ���Υơ��֥��� (�ԥ���������%)', 'picture_table_width', 0),
        array(
            '�̿������ǥե���Ȥ�ɽ������', 'display_pic_info', 1),
        array(
            '��������ΰ������դ�����', 'filter_bad_words', 1),
        array(
            '�����ȤΥ��ޥ��꡼���Ѥ���Ĥ���', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            '�̿������κ���Ĺ', 'max_img_desc_length', 0),
        array(
            '1�줢����κ���ʸ���� (���: ���ܸ�ξ�硢�����Ȥκ���Ĺ��Ʊ��)', 'max_com_wlength', 0),
        array(
            '�����Ȥκ���Կ�', 'max_com_lines', 0),
        array(
            '�����Ȥκ���Ĺ (Ⱦ�Ѵ���)', 'max_com_size', 0),
        array(
            '�ե���ॹ�ȥ�åפ�ɽ������', 'display_film_strip', 1),
        array(
            '�ե���ॹ�ȥ�å���ι���ɽ����', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        '�̿��ȥ���ͥ�������',
        array(
            'JPEG�ե�����Υ�����ƥ���', 'jpeg_qual', 0),
        array(
            '����ͥ���κ��������Ϲ⤵ <strong>*</strong>', 'thumb_width', 0),
        array(
            '��ˡ����Ѥ��� ( �� �ޤ��� �⤵ �ޤ��� ����ͥ���κ��祵���� )<strong>*</strong>', 'thumb_use', 7),
        array(
            '��ּ̿����������', 'make_intermediate', 1),
        array(
            '��ּ̿��κ��������Ϲ⤵ <strong>*</strong>', 'picture_width', 0),
        array(
            '���åץ��ɼ̿��κ��祵���� (KB)', 'max_upl_size', 0),
        array(
            '���åץ��ɼ̿��κ��������Ϲ⤵ (�ԥ�����)', 'max_upl_width_height', 0), 
        // 'User settings',
        '�桼������',
        array(
            '�桼����Ͽ����Ĥ���', 'allow_user_registration', 1),
        array(
            '�桼����Ͽ�˥᡼�뾵ǧ��ɬ�פȤ���', 'reg_requires_valid_email', 1),
        array(
            '2�ͤΥ桼���ˤ��Ʊ��᡼�륢�ɥ쥹����Ͽ����Ĥ���', 'allow_duplicate_emails_addr', 1),
        array(
            '�桼�����ץ饤�١��ȥ���Х����������', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        '���������Τ���Υ�������ե������ (���Ѥ��ʤ����϶���)',
        array(
            '�ե������̾ 1', 'user_field1_name', 0),
        array(
            '�ե������̾ 2', 'user_field2_name', 0),
        array(
            '�ե������̾ 3', 'user_field3_name', 0),
        array(
            '�ե������̾ 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        '�̿��ȥ���ͥ���ι��٤�����',
        array(
            '�����Ȥ˥ץ饤�١��ȥ���Х�Υ��������ɽ������', 'show_private', 1),
        array(
            '�ե�����̾�λ��Ѷػ�ʸ��', 'forbiden_fname_char', 0),
        array(
            '�̿��Υ��åץ��ɤǻ��ѽ����ե�����γ�ĥ��', 'allowed_file_extensions', 0),
        array(
            '���᡼���ꥵ��������ˡ', 'thumb_method', 2),
        array(
            'ImageMagick convert�桼�ƥ���ƥ����Υѥ� (�� /usr/bin/X11/)', 'impath', 0),
        array(
            '���ѤǤ������������ (ImageMagick�Τߤ�ͭ��)', 'allowed_img_types', 0),
        array(
            'ImageMagick�Υ��ޥ�ɥ饤�󥪥ץ����', 'im_options', 0),
        array(
            'JPEG�ե������EXIF�ǡ������ɤ߼��', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            '����Х�ǥ��쥯�ȥ� <strong>*</strong>', 'fullpath', 0),
        array(
            '�桼���̿��Υǥ��쥯�ȥ� <strong>*</strong>', 'userpics', 0),
        array(
            '��ּ̿�����Ƭ�� <strong>*</strong>', 'normal_pfx', 0),
        array(
            '����ͥ������Ƭ�� <strong>*</strong>', 'thumb_pfx', 0),
        array(
            '�ǥ��쥯�ȥ�Υǥե���ȡ��ѡ��ߥå����⡼�ɥ⡼��', 'default_dir_mode', 0),
        array(
            '�̿��Υǥե���ȡ��ѡ��ߥå����⡼��', 'default_file_mode', 0),
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
        '���å����ȥ���饯�������å�����',
        array(
            '������ץȤǻ��Ѥ��륯�å���̾', 'cookie_name', 0),
        array(
            '������ץȤǻ��Ѥ��륯�å�������¸��', 'cookie_path', 0),
        array(
            '���󥳡���', 'charset', 4),

        '����¾������',
        array(
            '�ǥХå��⡼�ɤ���Ѥ���', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) ���˥����꡼�˼̿�����Ͽ����Ƥ����硢*�ޡ������դ��Ƥ���ե�����ɤ��ѹ����ʤ��Ǥ�������</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => '��̾���ȥ����Ȥ����Ϥ��Ƥ���������',
        'com_added' => '���ʤ��Υ����Ȥ��ɲä���ޤ�����',
        'alb_need_title' => '����Х�̾�����Ϥ��Ƥ������� !',
        'no_udp_needed' => '������ɬ�פ���ޤ���',
        'alb_updated' => '����Хब��������ޤ�����',
        'unknown_album' => '���򤷤�����Хब¸�ߤ��ʤ������Ϥ��Υ���Х�˥��åץ��ɤ��븢�¤�����ޤ���',
        'no_pic_uploaded' => '�̿��ϥ��åץ��ɤ���ޤ���Ǥ��� !<br /><br />���åץ��ɤ���̿������������򤷤���硢�����Ф�</br>�ե�����Υ��åץ��ɤ���Ĥ��Ƥ��뤫��ǧ���Ƥ������� ...',
        'err_mkdir' => '�ǥ��쥯�ȥ� %s �κ����˼��Ԥ��ޤ��� !',
        'dest_dir_ro' => '�оݥǥ��쥯�ȥ� %s �ϥ�����ץȤˤ�����ߤ�����ޤ��� !',
        'err_move' => '%s �� %s �˰�ư�Ǥ��ޤ��� !',
        'err_fsize_too_large' => '���ʤ������åץ��ɤ����̿��Υ��������礭�᤮�ޤ� (���祵������%sx%s�Ǥ�) !',
        'err_imgsize_too_large' => '���ʤ������åץ��ɤ����ե�����Υ��������礭�᤮�ޤ� (���祵������%sKB�Ǥ�) !',
        'err_invalid_img' => '���ʤ������åץ��ɤ����ե������ͭ���ʲ����ǤϤ���ޤ��� !',
        'allowed_img_types' => '%s �β����Τߥ��åץ��ɽ���ޤ���',
        'err_insert_pic' => '�̿���%s�פϥ���Х����Ͽ�Ǥ��ޤ��� ',
        'upload_success' => '���ʤ��μ̿�������˥��åץ��ɤ���ޤ���<br /><br />�����Ԥξ�ǧ���ɽ������ޤ���',
        'info' => '����',
        'com_added' => '�����Ȥ��ɲä���ޤ�����',
        'alb_updated' => '����Хब��������ޤ�����',
        'err_comment_empty' => '�����Ȥ�����Ǥ� !',
        'err_invalid_fext' => '���γ�ĥ�ҤΥե�����Τ߻��ѤǤ��ޤ�: <br /><br />%s.',
        'no_flood' => '�������������ޤ��󡢤��ʤ��ϴ��ˤ��μ̿��˺ǿ������Ȥ���Ƥ��Ƥ��ޤ�<br /><br />�������������ϡ������Ȥ��Խ����Ƥ���������',
        'redirect_msg' => '������쥯�Ȥ���ޤ�����<br /><br /><br />�ڡ�������ưŪ�˹�������ʤ����ϡ���³���פ򥯥�å����Ƥ���������',
        'upl_success' => '���ʤ��μ̿����������Ͽ����ޤ�����',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Caption',
        'fs_pic' => '�ե륵��������',
        'del_success' => '�������',
        'ns_pic' => '�Ρ��ޥ륵��������',
        'err_del' => '����Բ�',
        'thumb_pic' => '����ͥ���',
        'comment' => '������',
        'im_in_alb' => '����Х���β���',
        'alb_del_success' => '����Х��%s�פ��������ޤ�����',
        'alb_mgr' => '����Х�ޥ͡����㡼',
        'err_invalid_data' => '��%s�פ������ʥǡ�����ȯ�����ޤ�����',
        'create_alb' => '����Х��%s�פκ�����',
        'update_alb' => '����Х��%s�� ����Х�̾��%s�� ����ǥå�����%s\�פ򹹿����Ƥ��ޤ���',
        'del_pic' => '�̿��κ��',
        'del_alb' => '����Х�κ��',
        'del_user' => '�桼���κ��',
        'err_unknown_user' => '���򤷤��桼����¸�ߤ��ޤ��� !',
        'comment_deleted' => '�����Ȥ��������ޤ�����',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => '�����ˤ��μ̿��������Ƥ⵹�����Ǥ��� ? \\nƱ���˥����Ȥ�������ޤ���',
        'del_pic' => '���μ̿���������',
        'size' => '%s x %s �ԥ�����',
        'views' => '%s ��',
        'slideshow' => '���饤�ɥ��硼',
        'stop_slideshow' => '���饤�ɥ��硼�����',
        'view_fs' => '����å��ǥե륵�����β�����ɽ��',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => '�̿�����',
        'Filename' => '�ե�����̾',
        'Album name' => '����Х�̾',
        'Rating' => '�졼�ƥ��� (��ɼ�� %s��)',
        'Keywords' => '�������',
        'File Size' => '�ե����륵����',
        'Dimensions' => '�礭��',
        'Displayed' => 'ɽ��',
        'Camera' => '�����',
        'Date taken' => '������',
        'Aperture' => '���',
        'Exposure time' => 'Ϫ�л���',
        'Focal length' => '������Υ',
        'Comment' => '������',
        'addFav' => '������������ɲ�',
        'addFavPhrase' => '����������',
        'remFav' => '���������꤫����',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => '���Υ����Ȥ��Խ�����',
        'confirm_delete' => '�����ˤ��Υ����Ȥ������Ƥ⵹�����Ǥ��� ?',
        'add_your_comment' => '�����Ȥ��ɲä���',
        'name' => '̾��',
        'comment' => '������',
        'your_name' => '��̾��',
        );

    $lang_fullsize_popup = array('click_to_close' => '�����Υ���å��ǥ�����ɥ����Ĥ���',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'e-�����ɤ�����',
        'invalid_email' => '<strong>�ٹ�</strong> : �᡼�륢�ɥ쥹������������ޤ��� !',
        'ecard_title' => 'An e-card from %s for you',
        'view_ecard' => 'e-�����ɤ������ɽ������ʤ����ϡ����Υ�󥯤򥯥�å����Ƥ���������',
        'view_more_pics' => '��äȼ̿��򸫤���ϡ����Υ�󥯤򥯥�å����Ƥ������� !',
        'send_success' => 'e-�����ɤ���������ޤ�����',
        'send_failed' => '�������������ޤ���e-card����������ޤ���Ǥ��� ...',
        'from' => 'From',
        'your_name' => '��̾��',
        'your_email' => '�᡼�륢�ɥ쥹',
        'to' => 'To',
        'rcpt_name' => '����ͤΤ�̾��',
        'rcpt_email' => '����ͤΥ᡼�륢�ɥ쥹',
        'greetings' => '��������',
        'message' => '��å�����',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => '�̿�����',
        'album' => '����Х�',
        'title' => '�̿�̾',
        'desc' => '����',
        'keywords' => '�������',
        'pic_info_str' => '%s&times;%s - %sKB - ������� %s - ��ɼ�� %s',
        'approve' => '�̿��ξ�ǧ',
        'postpone_app' => '��ǧ�α��',
        'del_pic' => '�̿��κ��',
        'reset_view_count' => '���������󥿤Υꥻ�å�',
        'reset_votes' => '��ɼ�Υꥻ�å�',
        'del_comm' => '�����Ȥκ��',
        'upl_approval' => '���åץ��ɾ�ǧ',
        'edit_pics' => '�̿����Խ�',
        'see_next' => '����',
        'see_prev' => '����',
        'n_pic' => '�̿���� %s',
        'n_of_pic_to_disp' => '�̿�ɽ����',
        'apply' => '������Ŭ��'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => '���롼��̾',
        'disk_quota' => '�ǥ���������',
        'can_rate' => '�̿���ɾ����ǽ',
        'can_send_ecards' => 'e-�����ɤ�������ǽ',
        'can_post_com' => '�����Ȥ���Ʋ�ǽ',
        'can_upload' => '�̿��򥢥åץ��ɲ�ǽ',
        'can_have_gallery' => '�ѡ����ʥ륮���꡼�������ǽ',
        'apply' => '������Ŭ��',
        'create_new_group' => '�������롼�פκ���',
        'del_groups' => '���򤷤����롼�פκ��',
        'confirm_del' => '�ٹ𡢥��롼�פ���������硢���롼�פ�°���Ƥ����桼����\'Registered\'���롼�פ˰�ư����ޤ� !\n\n������³���ޤ��� ?',
        'title' => '�桼�����롼�פδ���',
        'approval_1' => '�ѥ֥�å����åץ��ɾ�ǧ (1)',
        'approval_2' => '�ץ饤�١��ȥ��åץ��ɾ�ǧ (2)',
        'note1' => '<strong>(1)</strong> �ѥ֥�å�����Х�إ��åץ��ɤ��줿�̿��ϴ����Ԥξ�ǧ��ɬ�פǤ���',
        'note2' => '<strong>(2)</strong> �桼���Υ���Х�إ��åץ��ɤ��줿�̿��ϴ����Ԥξ�ǧ��ɬ�פǤ���',
        'notes' => '���'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => '�褦���� !'
        );

    $lang_album_admin_menu = array('confirm_delete' => '�����ˤ��Υ���Х�������Ƥ⵹�����Ǥ��� ? \\nƱ�������Ƥμ̿��ȥ����ȤϺ������ޤ���',
        'delete' => '���',
        'modify' => '�ץ�ѥƥ�',
        'edit_pics' => '�̿����Խ�',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '���ƥ����:<strong>[cat]</strong>&nbsp;&nbsp;&nbsp;����Х��:<strong>[albums]</strong>&nbsp;&nbsp;&nbsp;�̿����:<strong>[pictures]</strong>&nbsp;&nbsp;&nbsp;�����ȿ�:<strong>[comments]</strong>&nbsp;&nbsp;&nbsp;�������:<strong>[views]</strong>',
        'stat2' => '����Х��:<strong>[albums]</strong>&nbsp;&nbsp;&nbsp;�̿����:<strong>[pictures]</strong>&nbsp;&nbsp;&nbsp;�������:<strong>[views]</strong>',
        'xx_s_gallery' => '%s�Υ����꡼',
        'stat3' => '����Х��:<strong>[albums]</strong>&nbsp;&nbsp;&nbsp;�̿����:<strong>[pictures]</strong>&nbsp;&nbsp;&nbsp;�����ȿ�:<strong>[comments]</strong>&nbsp;&nbsp;&nbsp;�������:<strong>[views]</strong>'
        );

    $lang_list_users = array('user_list' => '�桼���ꥹ��',
        'no_user_gal' => '�桼�������꡼�Ϥ���ޤ���',
        'n_albums' => '����Х�� %s',
        'n_pics' => '�̿���� %s'
        );

    $lang_list_albums = array('n_pictures' => '�̿���� %s',
        'last_added' => '���ǽ��ɲ���:%s'
        );
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => '����Х�ι��� %s',
        'general_settings' => '��������',
        'alb_title' => '����Х�̾',
        'alb_cat' => '���ƥ���',
        'alb_desc' => '����',
        'alb_thumb' => '����ͥ���',
        'alb_perm' => '���Υ���Х���Ф���ѡ��ߥå����',
        'can_view' => '����Х������ǽ',
        'can_upload' => '�ӥ������ϼ̿��򥢥åץ��ɽ����',
        'can_post_comments' => '�ӥ������ϥ����Ȥ���ƤǤ���',
        'can_rate' => '�ӥ������ϼ̿���ɾ�������',
        'user_gal' => '�桼�������꡼',
        'no_cat' => '* ���ƥ��꡼̵�� *',
        'alb_empty' => '����Х�ˤϲ������äƤ��ޤ���',
        'last_uploaded' => '�ǿ����åץ���',
        'public_alb' => '���� (�ѥ֥�å�����Х�)',
        'me_only' => '��Τ�',
        'owner_only' => '����Х�ν�ͭ�� (%s) �Τ�',
        'groupp_only' => '%s���롼�ץ��С��Τ�',
        'err_no_alb_to_modify' => '�����Ǥ��륢��Хब�ǡ����١����ˤ���ޤ���',
        'update' => '����Х�ι���'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => '�������������ޤ��󡢤��ʤ��ϴ��ˤ��μ̿���ɾ�����Ƥ��ޤ���',
        'rate_ok' => '���ʤ�����ɼ�ϼ�������ޤ�����',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
{SITE_NAME}�δ����Ԥϡ�����Ū�˹��ޤ����ʤ���Ƥ��������®�䤫�˺������褦��ߤޤ��������Ƥ���Ƥ�������뤳�Ȥ��Բ�ǽ�Ǥ������äơ����Υ����Ȥ��Ф�������Ƥθ�����ƼԤˤ���ΤǤ��ꡢ�����Ԥ䥦���֥ޥ������Τ�Τ�̵��(�����ο͡�����ƤϽ���)�������Ԥ䥦���֥ޥ���������Ƥ���Ǥ��̵�����Ȥ򤢤ʤ���ǧ��ޤ���
<br>
<br>
���ʤ��ϡ�������¯��ȿ������Ƥ䡢�Ŀͤؤ������������ơ���Ū����ơ�����¾ˡ��ȿ������Ƥ򤷤ʤ�����Ʊ�դ��ޤ���
���ʤ��ϡ�{SITE_NAME}�δ����ԡ������֥ޥ���������ǥ졼������ǡ���ʤ����������Ƥ��Խ���������븢����ͭ���뤳�Ȥ�Ʊ�դ��ޤ������ʤ��ϡ��桼���Ȥ��Ƥ��ʤ�����Ƥ������󤬥ǡ����١�������¸����뤳�Ȥ�Ʊ�դ��ޤ������ξ���ϡ����ʤ���Ʊ��̵���˴����ԡ������֥ޥ���������軰�Ԥ˳�������뤳�ȤϤ���ޤ��󤬡��ǡ�����ή�Ф��붲��Τ���ϥå������ι԰٤��Ф��ƴ����ԡ������֥ޥ���������Ǥ���餦���ȤϤ���ޤ���
<br>
<br>
���Υ����ȤǤϡ����ʤ��Υ���ԥ塼���˾������¸���뤿��˥��å�������Ѥ��ޤ������å����Ϥ��ʤ��α������Ŭ�ˤ���٤����˻��Ѥ���ޤ����᡼�륢�ɥ쥹�ϡ����ʤ�����Ͽ�˴ؤ���ܺٵڤӥѥ���ɤ�ǧ�ڤΰ٤����˻��Ѥ���ޤ��� 
<br>
<br>
��Ʊ�դ��ޤ��פ򥯥�å����뤳�Ȥǡ����ʤ��Ͼ嵭�����ѵ����Ʊ�դ��ޤ���
EOT;

    $lang_register_php = array('page_title' => '�桼����Ͽ',
        'term_cond' => '���ѵ���',
        'i_agree' => 'Ʊ�դ��ޤ�',
        'submit' => '��Ͽ�¹�',
        'err_user_exists' => '���Ϥ��줿�桼��̾�ϴ�����Ͽ����Ƥ��ޤ����̤Υ桼��̾�����Ϥ��Ƥ���������',
        'err_password_mismatch' => '�ѥ���ɤ����פ��ޤ��󡢺������Ϥ��Ƥ���������',
        'err_uname_short' => '�桼��̾��2ʸ���ʾ�ˤ��Ƥ���������',
        'err_password_short' => '�ѥ���ɤ�2ʸ���ʾ�ˤ��Ƥ���������',
        'err_uname_pass_diff' => '�桼��̾�ȥѥ���ɤϰۤʤ�ɬ�פ�����ޤ���',
        'err_invalid_email' => '�᡼�륢�ɥ쥹������������ޤ���',
        'err_duplicate_email' => '¾�Υ桼��������Ʊ���᡼�륢�ɥ쥹����Ͽ���Ƥ��ޤ���',
        'enter_info' => '��Ͽ��������Ϥ��Ƥ���������',
        'required_info' => 'ɬ�ܹ���',
        'optional_info' => 'Ǥ�չ���',
        'username' => '�桼��̾',
        'password' => '�ѥ����',
        'password_again' => '�ѥ���ɤ�⤦����',
        'email' => '�᡼�륢�ɥ쥹',
        'location' => '�ｻ��',
        'interests' => '��̣�Τ��뤳��',
        'website' => '�ۡ���ڡ���',
        'occupation' => '����',
        'error' => '���顼',
        'confirm_email_subject' => '%s - Registration confirmation',
        'information' => '����',
        'failed_sending_email' => '��Ͽ��ǧ�᡼�뤬�����Ǥ��ޤ��� !',
        'thank_you' => '����Ͽ���꤬�Ȥ��������ޤ���<br /><br />��������Ȥγ������˴ؤ��������Ͽ���줿�᡼�륢�ɥ쥹������������ޤ�����',
        'acct_created' => '���ʤ��Υ�������Ȥ���������ޤ������桼��̾�ȥѥ���ɤǥ��������ޤ���',
        'acct_active' => '���ʤ��Υ�������Ȥ�����������ޤ������桼��̾�ȥѥ���ɤǥ��������ޤ���',
        'acct_already_act' => '���ʤ��Υ�������Ȥϴ��˳���������Ƥ��ޤ� !',
        'acct_act_failed' => '���Υ�������Ȥϳ���������ޤ��� !',
        'err_unk_user' => '���򤷤��桼����¸�ߤ��ޤ��� !',
        'x_s_profile' => '%s �Υץ�ե�����',
        'group' => '���롼��',
        'reg_date' => '��Ͽǯ����',
        'disk_usage' => '�ǥ�����������',
        'change_pass' => '�ѥ���ɤ��ѹ�',
        'current_pass' => '���ߤΥѥ����',
        'new_pass' => '�������ѥ����',
        'new_pass_again' => '�������ѥ���ɤ�⤦����',
        'err_curr_pass' => '���ߤΥѥ���ɤ�����������ޤ���',
        'apply_modif' => '������Ŭ��',
        'change_pass' => '�ѥ���ɤ��ѹ�',
        'update_success' => '�ץ�ե����뤬��������ޤ�����',
        'pass_chg_success' => '�ѥ���ɤ��ѹ�����ޤ�����',
        'pass_chg_error' => '�ѥ���ɤ��ѹ�����ޤ���Ǥ�����',
        );

    $lang_register_confirm_email = <<<EOT
{SITE_NAME} �ؤΤ���Ͽ���꤬�Ȥ��������ޤ���

���ʤ��Υ桼��̾�� "{USER_NAME}" �Ǥ���
���ʤ��Υѥ���ɤ� "{PASSWORD}" �Ǥ���

��������Ȥγ������򤹤�ˤϲ����Υ�󥯤򥯥�å�����
�֥饦���Υ��ɥ쥹��˥��ԡ����Ƥ���������

{ACT_LINK}������

{SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => '�����ȤΥ�ӥ塼',
        'no_comment' => '��ӥ塼���륳���ȤϤ���ޤ���',
        'n_comm_del' => '%s��Υ����Ȥ��������ޤ�����',
        'n_comm_disp' => 'ɽ�����륳���ȿ�',
        'see_prev' => '����',
        'see_next' => '����',
        'del_comm' => '���򤷤������Ȥ���',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => '�̿��θ���',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => '�������̿��θ���',
        'select_dir' => '�ǥ��쥯�ȥ�����',
        'select_dir_msg' => '�����Ǥ�FTP�ˤ�ꥵ���Ф˥��åץ��ɤ����̿��򥢥�Х�˰����Ͽ���ޤ�<br /><br />�̿��򥢥åץ��ɤ����ǥ��쥯�ȥ�����򤷤Ƥ���������',
        'no_pic_to_add' => '�ɲä���̿��Ϥ���ޤ���',
        'need_one_album' => '���ε�ǽ��Ȥ�����ˤ�1�İʾ�Υ���Хबɬ�פǤ���',
        'warning' => '�ٹ�',
        'change_perm' => '������ץȤ����Υǥ��쥯�ȥ�˽����ޤ���Ǥ������̿����ɲä������˥ǥ��쥯�ȥ�Υѡ��ߥå����⡼�ɤ�755����777���ѹ�����ɬ�פ�����ޤ� !',
        'target_album' => '<strong>��</strong>%s<strong>����μ̿���</strong>%s<strong>���ɲä���</strong>',
        'folder' => '�ե����',
        'image' => '����',
        'album' => '����Х�',
        'result' => '���',
        'dir_ro' => '����߸�������ޤ���',
        'dir_cant_read' => '�ɼ�긢������ޤ���',
        'insert' => '�����̿��Υ����꡼�ؤ��ɲ�',
        'list_new_pic' => '�����̿�����',
        'insert_selected' => '���򤷤��̿����ɲ�',
        'no_pic_found' => '�������̿��ϸ��Ĥ���ޤ���Ǥ�����',
        'be_patient' => '�ä����Ԥ�����������������ץȤ��̿����ɲä���ˤϻ��֤�ɬ�פǤ���',
        'notes' => '<ul>' . '<li><strong>OK</strong> : ����˼̿����ɲä���ޤ�����' . '<li><strong>DP</strong> : �̿�����ʣ���ƴ��˥ǡ����١�������Ͽ����Ƥ��ޤ���' . '<li><strong>PB</strong> : �̿����ɲý���ޤ���Ǥ���������ڤӼ̿�����Ͽ�����ǥ��쥯�ȥ�Υѡ��ߥå������ǧ���Ƥ���������' . '<li>OK��DP��PB������Τ������ɽ������ʤ��ä����ϡ�PHP���顼��ɽ�����뤿�����»�����̿��򥯥�å����Ƥ���������' . '<li>�����ॢ���Ȥ�ȯ��������硢�֥饦���ι����ܥ���򥯥�å����Ƥ���������' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => '�̿��Υ��åץ���',
        'max_fsize' => '���åץ��ɲ�ǽ�ʺ���ե����륵������%sKB�Ǥ���',
        'album' => '����Х�',
        'picture' => '�̿�',
        'pic_title' => '�̿�̾',
        'description' => '�̿�������',
        'keywords' => '������� (Ⱦ�ѥ��ڡ����Ƕ��ڤ�)',
        'err_no_alb_uploadables' => '�̿��Υ��åץ��ɤ����Ĥ��줿����Х�Ϥ���ޤ���',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => '�桼���δ���',
        'name_a' => '�桼��̾�ξ���',
        'name_d' => '�桼��̾�ι߽�',
        'group_a' => '���롼��̾�ξ���',
        'group_d' => '���롼��̾�ι߽�',
        'reg_a' => '��Ͽ���ξ���',
        'reg_d' => '��Ͽ���ι߽�',
        'pic_a' => '�̿�����ξ���',
        'pic_d' => '�̿�����ι߽�',
        'disku_a' => '�ǥ����������̤ξ���',
        'disku_d' => '�ǥ����������̤ι߽�',
        'sort_by' => '�桼�����¤��ؤ�',
        'err_no_users' => '�桼���ơ��֥뤬���Ǥ� !',
        'err_edit_self' => '��ʬ���ȤΥץ�ե�������Խ��Ǥ��ޤ��󡣡֥ޥ��ץ�ե�����פ���Ѥ��Ƥ���������',
        'edit' => '�Խ�',
        'delete' => '���',
        'name' => '�桼��̾',
        'group' => '���롼��',
        'inactive' => '�����',
        'operations' => '���',
        'pictures' => '�̿�',
        'disk_space' => '���ѺѤ����� / ����',
        'registered_on' => '��Ͽǯ����',
        'u_user_on_p_pages' => '�桼���� %d / %d�ڡ�����',
        'confirm_del' => '�����ˤ��Υ桼���������Ƥ⵹�����Ǥ��� ? \\�桼����°�������Ƥμ̿��ȥ���Х�Ϻ������ޤ���',
        'mail' => '�᡼��',
        'err_unknown_user' => '���򤷤��桼����¸�ߤ��ޤ��� !',
        'modify_user' => '�桼�����ѹ�',
        'notes' => '���',
        'note_list' => '<li>���ߤΥѥ���ɤ��ѹ��������ʤ����ϡ��֥ѥ���ɡץե�����ɤ����ˤ��Ƥ���������',
        'password' => '�ѥ����',
        'user_active' => '�桼�������������',
        'user_group' => '���롼��',
        'user_email' => '�᡼�륢�ɥ쥹',
        'user_web_site' => '�ۡ���ڡ���',
        'create_new_user' => '�����桼���κ���',
        'user_from' => '�ｻ��',
        'user_interests' => '��̣�Τ��뤳��',
        'user_occ' => '����',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => '�̿��Υꥵ����',
        'what_it_does' => '��������',
        'what_update_titles' => '�����ȥ��ե�����̾�ǹ�������',
        'what_delete_title' => '�����ȥ�κ��',
        'what_rebuild' => '����ͥ���κƹ��۵ڤӼ̿��Υꥵ����',
        'what_delete_originals' => '���ꥸ�ʥ륵�����β����������ơ��������ѹ���β����������ؤ���',
        'file' => '�ե�����',
        'title_set_to' => '�����ȥ�����',
        'submit_form' => '����',
        'updated_succesfully' => '������λ',
        'error_create' => '������˥��顼��ȯ�����ޤ���',
        'continue' => '����˲������������',
        'main_success' => '�ե����� %s ���ᥤ��̿������ꤵ��ޤ���',
        'error_rename' => '%s �� %s �˥�͡�����˥��顼��ȯ�����ޤ���',
        'error_not_found' => '�ե����� %s �����Ĥ���ޤ���Ǥ���',
        'back' => '�ᥤ������',
        'thumbs_wait' => '����ͥ���ι��� �ڤ�/�ޤ��� �̿��Υꥵ������ԤäƤ��ޤ������Ԥ���������...',
        'thumbs_continue_wait' => '����ͥ���ι��� �ڤ�/�ޤ��� �̿��Υꥵ������ԤäƤ��ޤ�...',
        'titles_wait' => '�����ȥ�ι�����ԤäƤ��ޤ������Ԥ���������...',
        'delete_wait' => '�����ȥ�������Ƥ��ޤ������Ԥ���������...',
        'replace_wait' => '���ꥸ�ʥ륵�����β������������ѹ���β����������ؤ���ԤäƤ��ޤ������Ԥ���������..',
        'instruction' => '�����å����󥹥ȥ饯�����',
        'instruction_action' => '��������������',
        'instruction_parameter' => '�ѥ�᡼��������',
        'instruction_album' => '����Х������',
        'instruction_press' => '%s �򲡤�',
        'update' => '����ͥ���ι��� �ڤ�/�ޤ��� �̿��Υꥵ����',
        'update_what' => '�����о�',
        'update_thumb' => '����ͥ���κ����Τ�',
        'update_pic' => '�̿��Υꥵ�����Τ�',
        'update_both' => '����ͥ���κ����ڤӼ̿��Υꥵ����',
        'update_number' => '����å�������β���������',
        'update_option' => '(�����ॢ���Ȥ�����ϡ����ο��ͤ��������ꤷ�Ƥ�������)',
        'filename_title' => '�ե�����̾ &rArr; �̿������ȥ�',
        'filename_how' => '�ե�����̾���ѹ���ˡ',
        'filename_remove' => '.jpg������դ��� _ (�������������)���ѹ�����',
        'filename_euro' => '2003_11_23_13_20_20.jpg �� 23/11/2003 13:20 ���ѹ�����',
        'filename_us' => '2003_11_23_13_20_20.jpg �� 11/23/2003 13:20 ���ѹ�����',
        'filename_time' => '2003_11_23_13_20_20.jpg �� 13:20 ���ѹ�����',
        'delete' => '�̿������ȥ�ޤ��ϥ��ꥸ�ʥ륵�����μ̿���������',
        'delete_title' => '�̿��Υ����ȥ��������',
        'delete_original' => '���ꥸ�ʥ륵�����μ̿���������',
        'delete_replace' => '���ꥸ�ʥ륵�����β����������ơ��������ѹ���β����������ؤ���',
        'select_album' => '����Х������',
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