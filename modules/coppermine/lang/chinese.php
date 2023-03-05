<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  New Port by GoldenTroll                                                  //
//  http://coppermine.findhere.org/                                          //
//  Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //                                                                                   
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

$lang_charset = 'Big5';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('�P����', '�P���@', '�P���G', '�P���T', '�P���|', '�P����', '�P����');
$lang_month = array('�@��', '�G��', '�T��', '�|��', '����', '����', '�C��', '�K��', '�E��', '�Q��', '�Q�@��', '�Q�G��');

// Some common strings
$lang_yes = '�O';
$lang_no  = '�_';
$lang_back = '��^';
$lang_continue = '�~��';
$lang_info = '�T��';
$lang_error = '���~';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => '�H���Ϥ�',
	'lastup' => '�̪�[�J�Ϥ�',
	'lastcom' => '�̪񪺵��׷N��',
	'topn' => '�����Ϥ�',
	'toprated' => '�����벼',
	'lasthits' => '�̪��[��',
	'search' => '�j�M���G'
);

$lang_errors = array(
	'access_denied' => '�A�S���ϥΥ������v��.',
	'perm_denied' => '�A�S���v�����榹�ʧ@.',
	'param_missing' => '�{���I�s����ݭn���Ѽ�.',
	'non_exist_ap' => '�ҿ�ܪ� �ۥ�/�Ϥ� ���s�b!',
	'quota_exceeded' => '�ϺШϥζW�L<br><br>�z�i�H�ϥΪ��Ŷ��� [quota]K, �ثe�ϥΤF [space]K, �[�J���Ϥ��i��W�L�z�i�H�ϥΪ��Ŷ��j�p.',
	'gd_file_type_err' => '��ϥ� GD �ϧε{���w�h�i�ϥΪ��Ϥ����A�� JPEG �M PNG.',
	'invalid_image' => '�z�W�Ǫ��Ϥ��w�g���_�εL�k�Q GD �{���w����',
	'resize_failed' => '�L�k�إ��Y�ϩβ��;A��������.',
	'no_img_to_display' => '�|�����Ϥ��i�H���',
	'non_exist_cat' => '�ҿ�ܪ����O�ä��s�b',
	'orphan_cat' => '�o�Ӥl���O�s��@�Ӥ��s�b�������O, �Х������O�޲z�ץ��o�Ӱ��D.',
	'directory_ro' => '�ؿ� \'%s\' �L�k�g�J, �ɭP�Ϥ��L�k�R��',
	'non_exist_comment' => '�ҿ�ܪ��N���ä��s�b.',
	'pic_in_invalid_album' => '���Ϥ��s�󤣦s�b���Ϯw�� (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '��^�Ϯw���D��',
	'alb_list_lnk' => '�Ϯw���D��',
	'my_gal_title' => '��^�ӤH��ï',
	'my_gal_lnk' => '�ӤH��ï',
	'my_prof_lnk' => '�ڪ��ӤH���',
	'adm_mode_title' => '����޲z�Ҧ�',
	'adm_mode_lnk' => '�޲z�Ҧ�',
	'usr_mode_title' => '����ϥΪ̼Ҧ�',
	'usr_mode_lnk' => '�ϥΪ̼Ҧ�',
	'upload_pic_title' => '�W�ǹϤ��ܬ�ï',
	'upload_pic_lnk' => '�W�ǹϤ�',
	'register_title' => '�إ߱b��',
	'register_lnk' => '���U',
	'login_lnk' => '�n�J',
	'logout_lnk' => '�n�X',
	'lastup_lnk' => '�̪�W��',
	'lastcom_lnk' => '�̪񪺵���',
	'topn_lnk' => '�����Ϥ�',
	'toprated_lnk' => '�����벼',
	'search_lnk' => '�j�M',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '�֭�W��',
	'config_lnk' => '�պA',
	'albums_lnk' => '�Ϯw��',
	'categories_lnk' => '���O',
	'users_lnk' => '�ϥΪ�',
	'groups_lnk' => '�s��',
	'comments_lnk' => '���׷N��',
	'searchnew_lnk' => '���פJ�Ϥ�',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '�إ� / ���� �Ϯw��',
	'modifyalb_lnk' => '�s��ڪ��ۥ�',
	'my_prof_lnk' => '�ӤH���',
);

$lang_cat_list = array(
	'category' => '���O',
	'albums' => '�ۥ�',
	'pictures' => '�Ϥ�',
);

$lang_album_list = array(
	'album_on_page' => '%d �Ӭۥ��� %d ��'
);

$lang_thumb_view = array(
	'date' => '���',
	'name' => '�W��',
	'sort_da' => '�ɦ��ƧǨ̤��',
	'sort_dd' => '�����ƧǨ̤��',
	'sort_na' => '�ɦ��ƧǨ̦W��',
	'sort_nd' => '�����ƧǨ̦W��',
	'pic_on_page' => '%d �i�Ϥ��� %d ��',
	'user_on_page' => '%d ��ϥΪ̩� %d ��'
);

$lang_img_nav_bar = array(
	'thumb_title' => '��^�Y�ϭ�',
	'pic_info_title' => '���/���� �Ϥ���T',
	'slideshow_title' => '�s�򼽩�',
	'ecard_title' => '�H�e e-card',
	'ecard_disabled' => 'e-cards �Ȥ��i��',
	'ecard_disabled_msg' => '�z�S���ϥ��v',
	'prev_title' => '�[�ݫe�@�i�Ϥ�',
	'next_title' => '�[�ݤU�@�i�Ϥ�',
	'pic_pos' => '�Ϥ� %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '�벼 ',
	'no_votes' => '(�|�����벼)',
	'rating' => '(�ثe�o�� : %s / 5 �� %s �ӧ벼)',
	'rubbish' => '���n',
	'poor' => '�t',
	'fair' => '�����F',
	'good' => '����',
	'excellent' => '���Ϊ�',
	'great' => '�ӴΤF',
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
	CRITICAL_ERROR => '���~',
	'file' => '�ɮ�: ',
	'line' => '���: ',
);

$lang_display_thumbnails = array(
	'filename' => '�ɦW : ',
	'filesize' => '�ɮפj�p : ',
	'dimensions' => '���� : ',
	'date_added' => '�s�W��� : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s �ӷN��',
	'n_views' => '%s ���[��',
	'n_votes' => '(%s �ӧ벼)'
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
	0 => '�����}�޲z�Ҧ�...',
	1 => '���i�J�޲z�Ҧ�...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '�z�ݭn���Ϯw���@�ӦW�� !',
	'confirm_modifs' => '�T�w�n���o�ǭק�� ?',
	'no_change' => '�z�S����������� !',
	'new_album' => '�s�Ϯw��',
	'confirm_delete1' => '�T�w�n�R�����Ϯw���� ?',
	'confirm_delete2' => '\n���򦹹Ϯw�������Ҧ��Ϥ��ηN�����|�R�� !',
	'select_first' => '�Х���ܤ@�ӹϮw��',
	'alb_mrg' => '�Ϯw���޲z',
	'my_gallery' => '* �ڪ��ۥ� *',
	'no_category' => '* �S�����O *',
	'delete' => '�R��',
	'new' => '�s�W',
	'apply_modifs' => '�����ק�',
	'select_category' => '������O',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\'�ʧ@�һݭn���Ѽƨå��Q���Ѩϥ�!',
	'unknown_cat' => '�ҿ�ܪ����O�ä��s�b',
	'usergal_cat_ro' => '�ϥΪ̬ۥ����O�L�k�R�� !',
	'manage_cat' => '���O�޲z',
	'confirm_delete' => '�T�w�n�R�������O��',
	'category' => '���O',
	'operations' => '�ާ@',
	'move_into' => '�h����',
	'update_create' => '��s/�إ� ���O',
	'parent_cat' => '�����O',
	'cat_title' => '���O�W��',
	'cat_desc' => '���O�y�z'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '�պA�]�w',
	'restore_cfg' => '�^�_�w�]�պA',
	'save_cfg' => '�x�s�s�]�w',
	'notes' => '�`�N',
	'info' => '�T��',
	'upd_success' => '�պA�]�w�w��s',
	'restore_success' => '�w�]�պA�w�^�_',
	'name_a' => '�W�٤ɦ��Ƨ�',
	'name_d' => '�W�٭����Ƨ�',
	'date_a' => '����ɦ��Ƨ�',
	'date_d' => '��������Ƨ�'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'�򥻳]�w',
	array('��ï�W��', 'gallery_name', 0),
	array('��ï�y�z', 'gallery_description', 0),
	array('��ï�޲z�H email', 'gallery_admin_email', 0),
	array('�b�H�e��e-cards������[�ݧ�h�Ϥ����s�����}', 'ecards_more_pic_target', 0),
	array('�y��', 'lang', 5),
	array('�G��', 'theme', 6),

	'�Ϯw����ܳ]�w',
	array('�D�n���e�� (pixels or %)', 'main_table_width', 0),
	array('�P�@���O���l���O��ܴX��', 'subcat_level', 0),
	array('�Ϯw����ܭӼ�', 'albums_per_page', 0),
	array('�Ϯw�����', 'album_list_cols', 0),
	array('����Y�Ϫ��j�p(pixels)', 'alb_list_thumb_size', 0),
	array('�D�������e', 'main_page_layout', 0),

	'�Y�ϳ]�w',
	array('�Y�ϭ����', 'thumbcols', 0),
	array('�Y�ϭ��C��', 'thumbrows', 0),
	array('�s�i�Ϥ�������ܴX��', 'max_tabs', 0),
	array('��ܹϤ����D (���[�����D) ���Y�ϤU��', 'caption_in_thumbview', 1),
	array('��ܷN���Ʃ��Y�ϤU��', 'display_comment_count', 1),
	array('�Ϥ����ƧǦ���', 'default_sort_order', 3),
	array('�n��ܦb \'�����벼\' �����Ϥ��ֻ̤ݧ�X��', 'min_votes_for_rating', 0),

	'�[�ݹϤ� &amp; ���׷N���]�w',
	array('�Ϥ���ܪ����e�� (pixels or %)', 'picture_table_width', 0),
	array('�Ϥ���T�̹w�]�����', 'display_pic_info', 1),
	array('�L�o���}�r����׷N��', 'filter_bad_words', 1),
	array('���׷N���i�H�ϥί��y�ϥ�', 'enable_smilies', 1),
	array('�Ϥ��y�z���e���̤j����', 'max_img_desc_length', 0),
	array('�y�z���e���̤j�r����', 'max_com_wlength', 0),
	array('�C��N����r���̤j��', 'max_com_lines', 0),
	array('���׷N�����e���̤j����', 'max_com_size', 0),

	'�Ϥ����Y�ϳ]�w',
	array('JPEG �榡�~��', 'jpeg_qual', 0),
	array('�Y�Ϫ��̤j�e�פΰ��� <strong>*</strong>', 'thumb_width', 0),
	array('�إ߾A���j�p�Ϥ�','make_intermediate',1),
	array('�A���j�p�Ϥ����e�שΰ��� <strong>*</strong>', 'picture_width', 0),
	array('�W�ǹ��ɪ��̤j���� (KB)', 'max_upl_size', 0),
	array('�W�ǹϤ����e�שΰ��׳̤j���� (pixels)', 'max_upl_width_height', 0),

	'�ϥΪ̳]�w',
	array('���\�s�ϥΪ̵��U', 'allow_user_registration', 1),
	array('�s���U�̻ݭn email ����', 'reg_requires_valid_email', 1),
	array('���\���P�ϥΪ̨ϥΦP�@�� email', 'allow_duplicate_emails_addr', 1),
	array('�ϥΪ̥i�H���p�H����ï', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

	'�X�ȨϥιϤ��y�z����� (�p�G���ϥνЯd�U�ť�)',
	array('�Ϥ��y�z1', 'user_field1_name', 0),
	array('�Ϥ��y�z2', 'user_field2_name', 0),
	array('�Ϥ��y�z3', 'user_field3_name', 0),
	array('�Ϥ��y�z4', 'user_field4_name', 0),

	'�Ϥ��M�Y�Ϫ��i���]�w',
	array('�ɮצW�ٱƥ����r��', 'forbiden_fname_char',0),
	array('�W�ǹϤ��i���������ɦW', 'allowed_file_extensions',0),
	array('�إ��Y�Ϫ���k','thumb_method',2),
	array('ImageMagick / netpbm \'convert\' �{�������| (�Ҧp /usr/bin/X11/)', 'impath', 0),
	array('���\�Ϥ����A (�u�� ImageMagick ����)', 'allowed_img_types',0),
	array('ImageMagick ���R�O�C�ﶵ', 'im_options', 0),
	array('�iŪEXIF ��Ʃ� JPEG �ɮ�', 'read_exif_data', 1),
	array('�Ϯw���ؿ� <strong>*</strong>', 'fullpath', 0),
	array('�ϥΪ̹Ϥ��ؿ� <strong>*</strong>', 'userpics', 0),
	array('���;A�����ɪ��e�m�r�� <strong>*</strong>', 'normal_pfx', 0),
	array('�����Y���ɪ��e�m�r�� <strong>*</strong>', 'thumb_pfx', 0),
	array('��m���ɥؿ����w�]CHMOD', 'default_dir_mode', 0),
	array('�W�ǹϤ����w�]CHMOD', 'default_file_mode', 0),

	'Cookies &amp; Charset �]�w',
	array('���{���ҨϥΪ� cookie �W��', 'cookie_name', 0),
	array('���{���ҨϥΪ� cookie ���|', 'cookie_path', 0),
	array('�s�X�]�w', 'charset', 4),

	'Miscellaneous settings',
	array('�Ұʰ����Ҧ�', 'debug_mode', 1),

	'<br><div align="center">(*) ��줺�Хܦ� * �Ÿ���ܥ��ݵ��ݭn�ק�A�]�N�O���@�w�n��g</div><br>'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '�п�J�j�W�M���׷N��',
	'com_added' => '�z���Ѫ����׷N���w�g�[�J',
	'alb_need_title' => '�z���ݬ��Ϯw�����Ѥ@�Ӽ��D !',
	'no_udp_needed' => '�S����s�����n.',
	'alb_updated' => '�Ϯw���w�g��s',
	'unknown_album' => '�ҿ�ܪ��Ϯw���ä��s�b�αz�S���v���W�ǹϤ��즹�Ϯw��',
	'no_pic_uploaded' => '�S���Ϥ��Q�W�� !<br><br>�p�G�z�T�w����ܹϤ��W��, ���ˬd���A���O�Τ��\�W���ɮ�...',
	'err_mkdir' => '�L�k�إߥؿ� %s !',
	'dest_dir_ro' => '�ت��ؿ� %s �L�k�g�J !',
	'err_move' => '�L�k�h�� %s �� %s !',
	'err_fsize_too_large' => '�z�W�Ǫ��Ϥ��Ӥj (����W�L %s x %s) !',
	'err_imgsize_too_large' => '�z�W�Ǫ����ɤӤj (����W�L %s KB) !',
	'err_invalid_img' => '�W�Ǫ��ɮרä��O���T���Ϥ��榡 !',
	'allowed_img_types' => '�z�u�i�H�W�� %s �i�Ϥ�.',
	'err_insert_pic' => '�Ϥ� \'%s\' �L�k�[�J���Ϯw�� ',
	'upload_success' => '�Ϥ��W�ǧ���<br><br>��޲z�̮֭��z�N�i�H�ݨ�Ϥ��F.',
	'info' => '�T��',
	'com_added' => '���׷N���w�[�J',
	'alb_updated' => '�Ϯw���w��s',
	'err_comment_empty' => '���׷N���O�Ū� !',
	'err_invalid_fext' => '�u���U�C�����ɦW�~�i�H�� : <br><br>%s.',
	'no_flood' => '��p�A�z�w�g�O�̫�@�Ӭ����Ϥ����ѷN��<br><br>�z�i�H�ק�z�i�K�L���N��',
	'redirect_msg' => '�z�w����.<br><br><br>�� \'�~��\' �p�G�����S���۰ʨ�s',
	'upl_success' => '�z���Ϥ��w�[�J����',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '���D',
	'fs_pic' => '��ڤj�p�Ϥ�',
	'del_success' => '�����R��',
	'ns_pic' => '�зǤj�p�Ϥ�',
	'err_del' => '�L�k�R��',
	'thumb_pic' => '�Y��',
	'comment' => '���׷N��',
	'im_in_alb' => '�Ϥ���Ϯw��',
	'alb_del_success' => '�Ϯw�� \'%s\' �w�R��',
	'alb_mgr' => '�Ϯw���޲z',
	'err_invalid_data' => '�����줣���T����Ʃ� \'%s\'',
	'create_alb' => '�إ߹Ϯw�� \'%s\'',
	'update_alb' => '��s�Ϯw�� \'%s\' ���D�� \'%s\' ���ޭȬ� \'%s\'',
	'del_pic' => '�R���Ϥ�',
	'del_alb' => '�R���Ϯw��',
	'del_user' => '�R���ϥΪ�',
	'err_unknown_user' => '�ҿ�ܪ��ϥΪ̨ä��s�b !',
	'comment_deleted' => '���׷N���w�g�R��',
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
	'confirm_del' => '�T�w�n�R�������� ? \\n�s�P�N���]�|�Q�R��.',
	'del_pic' => '�R�����Ϥ�',
	'size' => '%s x %s pixels',
	'views' => '%s ��',
	'slideshow' => '�s�򼽩�',
	'stop_slideshow' => '����s�򼽩�',
	'view_fs' => '���@�U�[�ݾ�i�Ϥ�',
);

$lang_picinfo = array(
	'title' =>'�Ϥ���T',
	'Filename' => '�ɮצW��',
	'Album name' => '�Ϯw���W��',
	'Rating' => '���� (%s ���벼)',
	'Keywords' => '����r',
	'File Size' => '�ɮפj�p',
	'Dimensions' => '����',
	'Displayed' => '���',
	'Camera' => '�Ϥ�',
	'Date taken' => '���o���',
	'Aperture' => '���e',
	'Exposure time' => '�ɶ�',
	'Focal length' => '�j�p',
	'Comment' => '�N��'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '�s�覹���׷N��',
	'confirm_delete' => '�T�w�n�R�����N���� ?',
	'add_your_comment' => '���ѧA���N��',
	'your_name' => '�z���j�W',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '�H�e e-card',
	'invalid_email' => '<strong>ĵ�i</strong> : �����T�� email !',
	'ecard_title' => '�@�i e-card �� %s �H�ӵ��A',
	'view_ecard' => '�p�G e-card �L�k���T���, �Ы��o�ӳs��',
	'view_more_pics' => '���o�̬ݧ�h�Ϥ� !',
	'send_success' => '�z���d���w�g�e�X',
	'send_failed' => '��p,�����A���L�k���A�H�e e-card...',
	'from' => '�Ӧ�',
	'your_name' => '�A���j�W',
	'your_email' => '�A�� email',
	'to' => '��',
	'rcpt_name' => '����̩m�W',
	'rcpt_email' => '����� email',
	'greetings' => '���ֻy',
	'message' => '�T�����e',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '�Ϥ�&nbsp;��T',
	'album' => '�Ϯw��',
	'title' => '���D',
	'desc' => '�y�z',
	'keywords' => '����r',
	'pic_info_str' => '%sx%s - %sKB - %s ���[�� - %s ���벼',
	'approve' => '�֭�Ϥ�',
	'postpone_app' => 'Postpone approval',
	'del_pic' => '�R���Ϥ�',
	'reset_view_count' => '���]�[�ݼƭp�ƾ�',
	'reset_votes' => '���]�벼',
	'del_comm' => '�R�����׷N��',
	'upl_approval' => '�֭�W��',
	'edit_pics' => '�s��Ϥ�',
	'see_next' => '�[�ݤU�@�i�Ϥ�',
	'see_prev' => '�[�ݤW�@�i�Ϥ�',
	'n_pic' => '%s �i�Ϥ�',
	'n_of_pic_to_disp' => '�Ϥ���ܼƶq',
	'apply' => '�����ק�'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '�s�զW��',
	'disk_quota' => '�ϺЮe�q',
	'can_rate' => '�i�H���Ϥ�����',
	'can_send_ecards' => '�i�H�H�e ecards',
	'can_post_com' => '�i�H�i�K���׷N��',
	'can_upload' => '�i�H�W�ǹϤ�',
	'can_have_gallery' => '�i�H�ϥέӤH�Ƭ�ï',
	'apply' => '�����ק�',
	'create_new_group' => '�إ߷s�s��',
	'del_groups' => '�R���ҿ�ܪ��s��',
	'confirm_del' => 'ĵ�i, ��R���F�@�Ӹs��, �ݩ�Ӹs�ժ��ϥΪ̱N�Q�ಾ�� \'Registered\' �s�դ� !�]�N�O���A�L�̱N���h�����v��\n\n�T�w�n�R���� ?',
	'title' => '�޲z�ϥΪ̸s��',
	'approval_1' => '���ιϮw���W�Ǯ֭� (1)',
	'approval_2' => '�p�H�Ϯw���W�Ǯ֭� (2)',
	'note1' => '<strong>(1)</strong> �W�ǹϤ��ܤ��Ϊ���ï�ݺ޲z�̮֭�',
	'note2' => '<strong>(2)</strong> �W�ǹϤ��ܦۤv����ï�ݺ޲z�̮֭�',
	'notes' => '�`�N'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '�w�� !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '�T�w�n�R���o�ӹϮw���� ? \\n�ӹϮw�����Ҧ��Ϥ��M�N���N�|�P�ɳQ�R��.',
	'delete' => '�R��',
	'modify' => '�ݩ�',
	'edit_pics' => '�s��Ϥ�',
);

$lang_list_categories = array(
	'home' => '�D��',
	'stat1' => '<strong>[pictures]</strong> �i�Ϥ��� <strong>[albums]</strong> �ӹϮw���A <strong>[cat]</strong> �����O�A<strong>[comments]</strong> �ӵ��׷N���A �[�� <strong>[views]</strong> ��',
	'stat2' => '<strong>[pictures]</strong> �i�Ϥ��� <strong>[albums]</strong> �ӹϮw���A �[�� <strong>[views]</strong> ��',
	'xx_s_gallery' => '%s ����ï',
	'stat3' => '<strong>[pictures]</strong> �i�Ϥ��� <strong>[albums]</strong> �ӹϮw���A <strong>[comments]</strong> �ӵ��׷N���A�[�� <strong>[views]</strong> ��'
);

$lang_list_users = array(
	'user_list' => '�ϥΪ̦C��',
	'no_user_gal' => '�|�����ϥΪ̳Q���\�ϥιϮw��',
	'n_albums' => '%s �ӹϮw��',
	'n_pics' => '%s �i�Ϥ�'
);

$lang_list_albums = array(
	'n_pictures' => '%s �i�Ϥ�',
	'last_added' => ', �̪�s�W�� %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '�n�J',
	'enter_login_pswd' => '��J�ϥΪ̦W�٩M�K�X',
	'username' => '�ϥΪ̦W��',
	'password' => '�K�X',
	'remember_me' => '�O��K�X',
	'welcome' => '�w�� %s ...',
	'err_login' => '*** �L�k�n�J. �Э��� ***',
	'err_already_logged_in' => '�z�w�g�n�J !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '�n�X',
	'bye' => '�A���F %s ...',
	'err_not_loged_in' => '�z�|���n�J !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '��s�Ϯw�� %s',
	'general_settings' => '�@��]�w',
	'alb_title' => '�Ϯw�����D',
	'alb_cat' => '�Ϯw�����O',
	'alb_desc' => '�Ϯw���y�z',
	'alb_thumb' => '�Ϯw���Y��',
	'alb_perm' => '�ӹϮw���s���D��',
	'can_view' => '�Ϯw���i�[�ݨ�',
	'can_upload' => '�X�ȥi�H�W�ǹϤ�',
	'can_post_comments' => '�X�ȥi�H�i�K���׷N��',
	'can_rate' => '�X�ȥi�H���Ϥ�����',
	'user_gal' => '�ϥΪ̬�ï',
	'no_cat' => '* �S�����O *',
	'alb_empty' => '�Ϯw���O�Ū�',
	'last_uploaded' => '�̪�W��',
	'public_alb' => '����H (���ιϮw��)',
	'me_only' => '�u����',
	'owner_only' => '�u���Ϯw���֦��H (%s)',
	'groupp_only' => '�u���s�շ|�� \'%s\'',
	'err_no_alb_to_modify' => '��Ʈw���|�����z�i�H�s�ת��Ϯw��.',
	'update' => '��s�Ϯw��'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '��p,�z�w�g�����Ϥ����L���F',
	'rate_ok' => '�z���벼�w�g�Q����',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
��޲z�̩� {SITE_NAME} �|���־�z�z�����,���ڭ̤��i���H�ɸԲ��[�ݨC�@���i���. �]���z���ݦP�N���������v�Q�b����ɭ԰��A���վ�z�i�K�����,�H�O���������~��.<br>
<br>
�z���ݦP�N���i�i�K����ⱡ, �ɤO, ���}, ������, �����d, ���`��a�w��, �Ψ�L�D������o���. {SITE_NAME} �b����ɭԳ����v�Q�L�o�ýs��z�i�K�����e,�æ��v�ק�A�d�b�����������. ���Щ��,�ڭ̤��|�N�z������൹��L�H�ϥ�.�������~,�z�b�����i�K�����e�����������z�t����d��.<br>
<br>
�����ϥ�COOKIES���x�s�z���q���W��T. �o�ˬO��K�z��ֳt�\Ū������T. �z�� email �u�O���ڭ̻{�z����ƦӤw,���̤��|�~��.<br>
<br>
���U '�ڦP�N' �~��.
EOT;

$lang_register_php = array(
	'page_title' => '���U�ϥΪ�',
	'term_cond' => '����P�W�h',
	'i_agree' => '�ڦP�N',
	'submit' => '�e�X���U',
	'err_user_exists' => '�z�Ҷ�g���ϥΪ̦W�٤w�Q�H�ϥ�, �Э���@��',
	'err_password_mismatch' => '�⦸�K�X���X, �Э���@��',
	'err_uname_short' => '�ϥΪ̦W�٦ܤֻ� 2 �Ӧr��',
	'err_password_short' => '�K�X�ܤֻ� 2 �Ӧr��',
	'err_uname_pass_diff' => '�ϥΪ̦W�٩M�K�X���i�H�ۦP',
	'err_invalid_email' => 'Email �����T',
	'err_duplicate_email' => '�o�� email �w�g�Q��L�H�ϥιL�F',
	'enter_info' => '�[�J���U�̸��',
	'required_info' => '���n�����',
	'optional_info' => '�D���n�����',
	'username' => '�ϥΪ̦W��',
	'password' => '�K�X',
	'password_again' => '�T�{�K�X',
	'email' => 'Email',
	'location' => '��m',
	'interests' => '����',
	'website' => '����',
	'occupation' => '¾�~',
	'error' => '���~',
	'confirm_email_subject' => '%s - ���U�޲z�]�w',
	'information' => '�T��',
	'failed_sending_email' => '�ҵ��U�� email �L�k�e�X !',
	'thank_you' => '�P�±z�����U.<br><br>�@�� email ���t���p��ҥαb������T�N�Q�e��z�Ҵ��Ѫ��H�c.',
	'acct_created' => '�z���b���w�g�إߡA�{�b�z�i�H�n�J�޲z',
	'acct_active' => '�z���b���w�g�ҥΡA�{�b�z�i�H�n�J�޲z�ӤH���',
	'acct_already_act' => '�z���b���w�g�ҥ� !',
	'acct_act_failed' => '���b���L�k�ҥ� !',
	'err_unk_user' => '�ҿ�ܪ��ϥΪ̨ä��s�b !',
	'x_s_profile' => '%s\' ���ӤH���',
	'group' => '�s��',
	'reg_date' => '�[�J',
	'disk_usage' => '�ϺШϥζq',
	'change_pass' => '�ק�K�X',
	'current_pass' => '�±K�X',
	'new_pass' => '�s�K�X',
	'new_pass_again' => '�T�{�K�X',
	'err_curr_pass' => '�±K�X�����T',
	'apply_modif' => '�����ק�',
	'change_pass' => '�ק�ڪ��K�X',
	'update_success' => '�A���ӤH��Ƥw�g��s',
	'pass_chg_success' => '�A���K�X�w�g�ק�',
	'pass_chg_error' => '�A���K�X�S���ק�',
);

$lang_register_confirm_email = <<<EOT
�P�±z���U�� {SITE_NAME}

�z���b�� : "{USER_NAME}"
�z���K�X : "{PASSWORD}"

���F��K�Ұʱz���b��,�z���ݫ��@�U�U�����s��
�Ϊ̥��N�o�ӳs���s�_��.

{ACT_LINK}

���ֱz,

 {SITE_NAME} �q�W

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '�[�ݷN��',
	'no_comment' => '�|�����N���i�H�[��',
	'n_comm_del' => '%s �ӷN���w�R��',
	'n_comm_disp' => '�n��ܪ��N���ƶq',
	'see_prev' => '�ݫe�@��',
	'see_next' => '�ݤU�@��',
	'del_comm' => '�R���ҿ諸�N��',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '��M�Ϥ����e',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '�M��s�Ϥ�',
	'select_dir' => '��ܥؿ�',
	'select_dir_msg' => '���\��i�H���A���פJ�A�� FTP �W�Ǫ��Ϥ�.<br><br>�п�ܧA�ҤW�Ǫ��Ϥ��ؿ�',
	'no_pic_to_add' => '�S���Ϥ��i�H�[�J',
	'need_one_album' => '�n�ϥΦ��\�ॲ�ݤ֭n���@�ӹϮw��',
	'warning' => 'ĵ�i',
	'change_perm' => '�{���L�k�g�J�o�ӥؿ�, �Эק�CHMOD �� 755 �� 777 ��A�դ@��!',
	'target_album' => '<strong>�[�J�Ϥ� &quot;</strong>%s<strong>&quot; �� </strong>%s',
	'folder' => '��Ƨ�',
	'image' => '�Ϥ�',
	'album' => '�Ϯw��',
	'result' => '���G',
	'dir_ro' => '�L�k�g�J. ',
	'dir_cant_read' => '�L�kŪ��. ',
	'insert' => '�s�W�Ϥ��ܬ�ï',
	'list_new_pic' => '�C�X�s�Ϥ�',
	'insert_selected' => '�[�J�ҿ�ܪ��Ϥ�',
	'no_pic_found' => '�S�����s�Ϥ�',
	'be_patient' => '�Э@�ߵ���, �{���ݭn�@�I�ɶ��ӥ[�J�ҿ�Ϥ�',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : ��ܹϤ��w���\�Q�[�J'.
				'<li><strong>DP</strong> : ��ܹϤ����ЩΤw�s�b��Ʈw'.
				'<li><strong>PB</strong> : ��ܹϤ��L�k�[�J, ���ˬd�պA�]�w�ιϤ��s��ؿ����ϥ��v��'.
				'<li>�p�G OK, DP, PB \'�Ÿ�\' �S����ܽЫ��a�����Ϥ��ݬ� PHP ��ܪ����~�T��'.
				'<li>�p�G�s��������, �Ы����s��z'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '�W�ǹϤ�',
	'max_fsize' => '�i���\���ɮ׳̤j�� %s KB',
	'album' => '�Ϯw��',
	'picture' => '�Ϥ�',
	'pic_title' => '�Ϥ����D',
	'description' => '�Ϥ��y�z',
	'keywords' => '����r (�ХH�Ů�Ϲj)',
	'err_no_alb_uploadables' => '�ثe�|�����Ϯw���i�H�ѱz�W�ǹϤ�',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '�ϥΪ̺޲z',
	'name_a' => '�W�٤ɦ��Ƨ�',
	'name_d' => '�W�٭����Ƨ�',
	'group_a' => '�s�դɦ��Ƨ�',
	'group_d' => '�s�խ����Ƨ�',
	'reg_a' => '���U����ɦ��Ƨ�',
	'reg_d' => '���U��������Ƨ�',
	'pic_a' => '�Ϥ��Ƥɦ��Ƨ�',
	'pic_d' => '�Ϥ��ƭ����Ƨ�',
	'disku_a' => '�ϥζq�ɦ��Ƨ�',
	'disku_d' => '�ϥζq�����Ƨ�',
	'sort_by' => '�ϥΪ̱ƧǨ�',
	'err_no_users' => '�ϥΪ̸�ƪ�O�Ū� !',
	'err_edit_self' => '�z�L�k�s��ӤH���, �ЧQ�� \'�ڪ��ӤH���\' �ӽs��',
	'edit' => '�s��',
	'delete' => '�R��',
	'name' => '�ϥΪ̦W��',
	'group' => '�s��',
	'inactive' => '���Ұ�',
	'operations' => '�ʧ@',
	'pictures' => '�Ϥ�',
	'disk_space' => '�Ŷ� �ϥζq / �`�q',
	'registered_on' => '���U��',
	'u_user_on_p_pages' => '%d �ӨϥΪ̩� %d ��',
	'confirm_del' => '�T�w�n�R���o�ӨϥΪ̶� ? \\n�s�P�L���Ϯw���ιϤ����|�Q�R��.',
	'mail' => 'MAIL',
	'err_unknown_user' => '�ҿ�ܪ��ϥΪ̨ä��s�b !',
	'modify_user' => '�s��ϥΪ�',
	'notes' => '�`�N',
	'note_list' => '<li>�p�G�A���Q���ܥثe���K�X, �бN "�K�X" ��d�U�ť�',
	'password' => '�K�X',
	'user_active_cp' => '�ϥΪ̱Ұʤ�',
	'user_group_cp' => '�ϥΪ̸s��',
	'user_email' => '�ϥΪ� email',
	'user_web_site' => '�ϥΪ̭���',
	'create_new_user' => '�إ߷s�ϥΪ�',
	'user_from' => '�ϥΪ̦�m',
	'user_interests' => '�ϥΪ̿���',
	'user_occ' => '�ϥΪ�¾�~',
);
?>