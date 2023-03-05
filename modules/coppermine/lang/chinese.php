<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery v1.1 Beta 2                                     //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr嶲ory DEMAR <gdemar@wanadoo.fr>               //
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
$lang_day_of_week = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$lang_month = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');

// Some common strings
$lang_yes = '是';
$lang_no  = '否';
$lang_back = '返回';
$lang_continue = '繼續';
$lang_info = '訊息';
$lang_error = '錯誤';

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
	'random' => '隨機圖片',
	'lastup' => '最近加入圖片',
	'lastcom' => '最近的評論意見',
	'topn' => '熱門圖片',
	'toprated' => '熱門投票',
	'lasthits' => '最近觀看',
	'search' => '搜尋結果'
);

$lang_errors = array(
	'access_denied' => '你沒有使用本頁的權限.',
	'perm_denied' => '你沒有權限執行此動作.',
	'param_missing' => '程式呼叫不到需要的參數.',
	'non_exist_ap' => '所選擇的 相本/圖片 不存在!',
	'quota_exceeded' => '磁碟使用超過<br><br>您可以使用的空間有 [quota]K, 目前使用了 [space]K, 加入此圖片可能超過您可以使用的空間大小.',
	'gd_file_type_err' => '當使用 GD 圖形程式庫則可使用的圖片型態為 JPEG 和 PNG.',
	'invalid_image' => '您上傳的圖片已經中斷或無法被 GD 程式庫控制',
	'resize_failed' => '無法建立縮圖或產生適中的圖檔.',
	'no_img_to_display' => '尚未有圖片可以顯示',
	'non_exist_cat' => '所選擇的類別並不存在',
	'orphan_cat' => '這個子類別存於一個不存在的父類別, 請先至類別管理修正這個問題.',
	'directory_ro' => '目錄 \'%s\' 無法寫入, 導致圖片無法刪除',
	'non_exist_comment' => '所選擇的意見並不存在.',
	'pic_in_invalid_album' => '此圖片存於不存在的圖庫夾 (%s)!?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => '返回圖庫夾主頁',
	'alb_list_lnk' => '圖庫夾主頁',
	'my_gal_title' => '返回個人相簿',
	'my_gal_lnk' => '個人相簿',
	'my_prof_lnk' => '我的個人資料',
	'adm_mode_title' => '執行管理模式',
	'adm_mode_lnk' => '管理模式',
	'usr_mode_title' => '執行使用者模式',
	'usr_mode_lnk' => '使用者模式',
	'upload_pic_title' => '上傳圖片至相簿',
	'upload_pic_lnk' => '上傳圖片',
	'register_title' => '建立帳號',
	'register_lnk' => '註冊',
	'login_lnk' => '登入',
	'logout_lnk' => '登出',
	'lastup_lnk' => '最近上傳',
	'lastcom_lnk' => '最近的評論',
	'topn_lnk' => '熱門圖片',
	'toprated_lnk' => '熱門投票',
	'search_lnk' => '搜尋',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => '核准上傳',
	'config_lnk' => '組態',
	'albums_lnk' => '圖庫夾',
	'categories_lnk' => '類別',
	'users_lnk' => '使用者',
	'groups_lnk' => '群組',
	'comments_lnk' => '評論意見',
	'searchnew_lnk' => '整批匯入圖片',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => '建立 / 重整 圖庫夾',
	'modifyalb_lnk' => '編輯我的相本',
	'my_prof_lnk' => '個人資料',
);

$lang_cat_list = array(
	'category' => '類別',
	'albums' => '相本',
	'pictures' => '圖片',
);

$lang_album_list = array(
	'album_on_page' => '%d 個相本於 %d 頁'
);

$lang_thumb_view = array(
	'date' => '日期',
	'name' => '名稱',
	'sort_da' => '升次排序依日期',
	'sort_dd' => '降次排序依日期',
	'sort_na' => '升次排序依名稱',
	'sort_nd' => '降次排序依名稱',
	'pic_on_page' => '%d 張圖片於 %d 頁',
	'user_on_page' => '%d 位使用者於 %d 頁'
);

$lang_img_nav_bar = array(
	'thumb_title' => '返回縮圖頁',
	'pic_info_title' => '顯示/隱藏 圖片資訊',
	'slideshow_title' => '連續播放',
	'ecard_title' => '寄送 e-card',
	'ecard_disabled' => 'e-cards 暫不可用',
	'ecard_disabled_msg' => '您沒有使用權',
	'prev_title' => '觀看前一張圖片',
	'next_title' => '觀看下一張圖片',
	'pic_pos' => '圖片 %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => '投票 ',
	'no_votes' => '(尚未有投票)',
	'rating' => '(目前得分 : %s / 5 於 %s 個投票)',
	'rubbish' => '不好',
	'poor' => '差',
	'fair' => '遜弊了',
	'good' => '不錯',
	'excellent' => '極佳的',
	'great' => '太棒了',
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
	CRITICAL_ERROR => '錯誤',
	'file' => '檔案: ',
	'line' => '行數: ',
);

$lang_display_thumbnails = array(
	'filename' => '檔名 : ',
	'filesize' => '檔案大小 : ',
	'dimensions' => '維度 : ',
	'date_added' => '新增日期 : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s 個意見',
	'n_views' => '%s 次觀看',
	'n_votes' => '(%s 個投票)'
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
	0 => '正離開管理模式...',
	1 => '正進入管理模式...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => '您需要給圖庫夾一個名稱 !',
	'confirm_modifs' => '確定要做這些修改嗎 ?',
	'no_change' => '您沒有做任何改變 !',
	'new_album' => '新圖庫夾',
	'confirm_delete1' => '確定要刪除此圖庫夾嗎 ?',
	'confirm_delete2' => '\n那麼此圖庫夾內的所有圖片及意見都會刪除 !',
	'select_first' => '請先選擇一個圖庫夾',
	'alb_mrg' => '圖庫夾管理',
	'my_gallery' => '* 我的相本 *',
	'no_category' => '* 沒有類別 *',
	'delete' => '刪除',
	'new' => '新增',
	'apply_modifs' => '提報修改',
	'select_category' => '選擇類別',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '\'%s\'動作所需要的參數並未被提供使用!',
	'unknown_cat' => '所選擇的類別並不存在',
	'usergal_cat_ro' => '使用者相本類別無法刪除 !',
	'manage_cat' => '類別管理',
	'confirm_delete' => '確定要刪除此類別嗎',
	'category' => '類別',
	'operations' => '操作',
	'move_into' => '搬移至',
	'update_create' => '更新/建立 類別',
	'parent_cat' => '父類別',
	'cat_title' => '類別名稱',
	'cat_desc' => '類別描述'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '組態設定',
	'restore_cfg' => '回復預設組態',
	'save_cfg' => '儲存新設定',
	'notes' => '注意',
	'info' => '訊息',
	'upd_success' => '組態設定已更新',
	'restore_success' => '預設組態已回復',
	'name_a' => '名稱升次排序',
	'name_d' => '名稱降次排序',
	'date_a' => '日期升次排序',
	'date_d' => '日期降次排序'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'基本設定',
	array('相簿名稱', 'gallery_name', 0),
	array('相簿描述', 'gallery_description', 0),
	array('相簿管理人 email', 'gallery_admin_email', 0),
	array('在寄送的e-cards內顯示觀看更多圖片的連結網址', 'ecards_more_pic_target', 0),
	array('語言', 'lang', 5),
	array('佈景', 'theme', 6),

	'圖庫夾顯示設定',
	array('主要表格寬度 (pixels or %)', 'main_table_width', 0),
	array('同一類別的子類別顯示幾個', 'subcat_level', 0),
	array('圖庫夾顯示個數', 'albums_per_page', 0),
	array('圖庫夾欄數', 'album_list_cols', 0),
	array('顯示縮圖的大小(pixels)', 'alb_list_thumb_size', 0),
	array('主頁的內容', 'main_page_layout', 0),

	'縮圖設定',
	array('縮圖頁欄數', 'thumbcols', 0),
	array('縮圖頁列數', 'thumbrows', 0),
	array('新進圖片紀錄顯示幾個', 'max_tabs', 0),
	array('顯示圖片標題 (附加的標題) 於縮圖下方', 'caption_in_thumbview', 1),
	array('顯示意見數於縮圖下方', 'display_comment_count', 1),
	array('圖片的排序次序', 'default_sort_order', 3),
	array('要顯示在 \'熱門投票\' 內的圖片最少需投幾票', 'min_votes_for_rating', 0),

	'觀看圖片 &amp; 評論意見設定',
	array('圖片顯示的表格寬度 (pixels or %)', 'picture_table_width', 0),
	array('圖片資訊依預設值顯示', 'display_pic_info', 1),
	array('過濾不良字於評論意見', 'filter_bad_words', 1),
	array('評論意見可以使用笑臉圖示', 'enable_smilies', 1),
	array('圖片描述內容的最大長度', 'max_img_desc_length', 0),
	array('描述內容的最大字元數', 'max_com_wlength', 0),
	array('每行意見文字的最大數', 'max_com_lines', 0),
	array('評論意見內容的最大長度', 'max_com_size', 0),

	'圖片及縮圖設定',
	array('JPEG 格式品質', 'jpeg_qual', 0),
	array('縮圖的最大寬度及高度 <strong>*</strong>', 'thumb_width', 0),
	array('建立適中大小圖片','make_intermediate',1),
	array('適中大小圖片的寬度或高度 <strong>*</strong>', 'picture_width', 0),
	array('上傳圖檔的最大限制 (KB)', 'max_upl_size', 0),
	array('上傳圖片的寬度或高度最大限制 (pixels)', 'max_upl_width_height', 0),

	'使用者設定',
	array('允許新使用者註冊', 'allow_user_registration', 1),
	array('新註冊者需要 email 驗證', 'reg_requires_valid_email', 1),
	array('允許不同使用者使用同一個 email', 'allow_duplicate_emails_addr', 1),
	array('使用者可以有私人的相簿', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

	'訪客使用圖片描述的欄位 (如果不使用請留下空白)',
	array('圖片描述1', 'user_field1_name', 0),
	array('圖片描述2', 'user_field2_name', 0),
	array('圖片描述3', 'user_field3_name', 0),
	array('圖片描述4', 'user_field4_name', 0),

	'圖片和縮圖的進階設定',
	array('檔案名稱排斥的字元', 'forbiden_fname_char',0),
	array('上傳圖片可接受的副檔名', 'allowed_file_extensions',0),
	array('建立縮圖的方法','thumb_method',2),
	array('ImageMagick / netpbm \'convert\' 程式的路徑 (例如 /usr/bin/X11/)', 'impath', 0),
	array('允許圖片型態 (只對 ImageMagick 有效)', 'allowed_img_types',0),
	array('ImageMagick 的命令列選項', 'im_options', 0),
	array('可讀EXIF 資料於 JPEG 檔案', 'read_exif_data', 1),
	array('圖庫夾目錄 <strong>*</strong>', 'fullpath', 0),
	array('使用者圖片目錄 <strong>*</strong>', 'userpics', 0),
	array('產生適中圖檔的前置字元 <strong>*</strong>', 'normal_pfx', 0),
	array('產生縮圖檔的前置字元 <strong>*</strong>', 'thumb_pfx', 0),
	array('放置圖檔目錄的預設CHMOD', 'default_dir_mode', 0),
	array('上傳圖片的預設CHMOD', 'default_file_mode', 0),

	'Cookies &amp; Charset 設定',
	array('本程式所使用的 cookie 名稱', 'cookie_name', 0),
	array('本程式所使用的 cookie 路徑', 'cookie_path', 0),
	array('編碼設定', 'charset', 4),

	'Miscellaneous settings',
	array('啟動除錯模式', 'debug_mode', 1),

	'<br><div align="center">(*) 欄位內標示有 * 符號表示必需視需要修改，也就是說一定要填寫</div><br>'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => '請輸入大名和評論意見',
	'com_added' => '您提供的評論意見已經加入',
	'alb_need_title' => '您必需為圖庫夾提供一個標題 !',
	'no_udp_needed' => '沒有更新的必要.',
	'alb_updated' => '圖庫夾已經更新',
	'unknown_album' => '所選擇的圖庫夾並不存在或您沒有權限上傳圖片到此圖庫夾',
	'no_pic_uploaded' => '沒有圖片被上傳 !<br><br>如果您確定有選擇圖片上傳, 請檢查伺服器是或允許上傳檔案...',
	'err_mkdir' => '無法建立目錄 %s !',
	'dest_dir_ro' => '目的目錄 %s 無法寫入 !',
	'err_move' => '無法搬移 %s 到 %s !',
	'err_fsize_too_large' => '您上傳的圖片太大 (不能超過 %s x %s) !',
	'err_imgsize_too_large' => '您上傳的圖檔太大 (不能超過 %s KB) !',
	'err_invalid_img' => '上傳的檔案並不是正確的圖片格式 !',
	'allowed_img_types' => '您只可以上傳 %s 張圖片.',
	'err_insert_pic' => '圖片 \'%s\' 無法加入此圖庫夾 ',
	'upload_success' => '圖片上傳完成<br><br>當管理者核准後您就可以看到圖片了.',
	'info' => '訊息',
	'com_added' => '評論意見已加入',
	'alb_updated' => '圖庫夾已更新',
	'err_comment_empty' => '評論意見是空的 !',
	'err_invalid_fext' => '只有下列的副檔名才可以用 : <br><br>%s.',
	'no_flood' => '抱歉，您已經是最後一個為此圖片提供意見<br><br>您可以修改您張貼過的意見',
	'redirect_msg' => '您已重整.<br><br><br>按 \'繼續\' 如果頁面沒有自動刷新',
	'upl_success' => '您的圖片已加入完成',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => '標題',
	'fs_pic' => '實際大小圖片',
	'del_success' => '完成刪除',
	'ns_pic' => '標準大小圖片',
	'err_del' => '無法刪除',
	'thumb_pic' => '縮圖',
	'comment' => '評論意見',
	'im_in_alb' => '圖片於圖庫夾',
	'alb_del_success' => '圖庫夾 \'%s\' 已刪除',
	'alb_mgr' => '圖庫夾管理',
	'err_invalid_data' => '接收到不正確的資料於 \'%s\'',
	'create_alb' => '建立圖庫夾 \'%s\'',
	'update_alb' => '更新圖庫夾 \'%s\' 標題為 \'%s\' 索引值為 \'%s\'',
	'del_pic' => '刪除圖片',
	'del_alb' => '刪除圖庫夾',
	'del_user' => '刪除使用者',
	'err_unknown_user' => '所選擇的使用者並不存在 !',
	'comment_deleted' => '評論意見已經刪除',
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
	'confirm_del' => '確定要刪除此片嗎 ? \\n連同意見也會被刪除.',
	'del_pic' => '刪除此圖片',
	'size' => '%s x %s pixels',
	'views' => '%s 次',
	'slideshow' => '連續播放',
	'stop_slideshow' => '停止連續播放',
	'view_fs' => '按一下觀看整張圖片',
);

$lang_picinfo = array(
	'title' =>'圖片資訊',
	'Filename' => '檔案名稱',
	'Album name' => '圖庫夾名稱',
	'Rating' => '評分 (%s 次投票)',
	'Keywords' => '關鍵字',
	'File Size' => '檔案大小',
	'Dimensions' => '維度',
	'Displayed' => '顯示',
	'Camera' => '圖片',
	'Date taken' => '取得日期',
	'Aperture' => '內容',
	'Exposure time' => '時間',
	'Focal length' => '大小',
	'Comment' => '意見'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => '編輯此評論意見',
	'confirm_delete' => '確定要刪除此意見嗎 ?',
	'add_your_comment' => '提供你的意見',
	'your_name' => '您的大名',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => '寄送 e-card',
	'invalid_email' => '<strong>警告</strong> : 不正確的 email !',
	'ecard_title' => '一張 e-card 由 %s 寄來給你',
	'view_ecard' => '如果 e-card 無法正確顯示, 請按這個連結',
	'view_more_pics' => '按這裡看更多圖片 !',
	'send_success' => '您的卡片已經送出',
	'send_failed' => '抱歉,本伺服器無法為你寄送 e-card...',
	'from' => '來自',
	'your_name' => '你的大名',
	'your_email' => '你的 email',
	'to' => '到',
	'rcpt_name' => '收件者姓名',
	'rcpt_email' => '收件者 email',
	'greetings' => '祝福語',
	'message' => '訊息內容',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '圖片&nbsp;資訊',
	'album' => '圖庫夾',
	'title' => '標題',
	'desc' => '描述',
	'keywords' => '關鍵字',
	'pic_info_str' => '%sx%s - %sKB - %s 次觀看 - %s 次投票',
	'approve' => '核准圖片',
	'postpone_app' => 'Postpone approval',
	'del_pic' => '刪除圖片',
	'reset_view_count' => '重設觀看數計數器',
	'reset_votes' => '重設投票',
	'del_comm' => '刪除評論意見',
	'upl_approval' => '核准上傳',
	'edit_pics' => '編輯圖片',
	'see_next' => '觀看下一張圖片',
	'see_prev' => '觀看上一張圖片',
	'n_pic' => '%s 張圖片',
	'n_of_pic_to_disp' => '圖片顯示數量',
	'apply' => '提報修改'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => '群組名稱',
	'disk_quota' => '使碟容量',
	'can_rate' => '可以為圖片評分',
	'can_send_ecards' => '可以寄送 ecards',
	'can_post_com' => '可以張貼評論意見',
	'can_upload' => '可以上傳圖片',
	'can_have_gallery' => '可以使用個人化相簿',
	'apply' => '提報修改',
	'create_new_group' => '建立新群組',
	'del_groups' => '刪除所選擇的群組',
	'confirm_del' => '警告, 當刪除了一個群組, 屬於該群組的使用者將被轉移至 \'Registered\' 群組中 !也就是說，他們將失去部份權限\n\n確定要刪除嗎 ?',
	'title' => '管理使用者群組',
	'approval_1' => '公用圖庫夾上傳核准 (1)',
	'approval_2' => '私人圖庫夾上傳核准 (2)',
	'note1' => '<strong>(1)</strong> 上傳圖片至公用的相簿需管理者核准',
	'note2' => '<strong>(2)</strong> 上傳圖片至自己的相簿需管理者核准',
	'notes' => '注意'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => '歡迎 !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '確定要刪除這個圖庫夾嗎 ? \\n該圖庫夾內所有圖片和意見將會同時被刪除.',
	'delete' => '刪除',
	'modify' => '屬性',
	'edit_pics' => '編輯圖片',
);

$lang_list_categories = array(
	'home' => '主頁',
	'stat1' => '<strong>[pictures]</strong> 張圖片於 <strong>[albums]</strong> 個圖庫夾， <strong>[cat]</strong> 個類別，<strong>[comments]</strong> 個評論意見， 觀看 <strong>[views]</strong> 次',
	'stat2' => '<strong>[pictures]</strong> 張圖片於 <strong>[albums]</strong> 個圖庫夾， 觀看 <strong>[views]</strong> 次',
	'xx_s_gallery' => '%s 的相簿',
	'stat3' => '<strong>[pictures]</strong> 張圖片於 <strong>[albums]</strong> 個圖庫夾， <strong>[comments]</strong> 個評論意見，觀看 <strong>[views]</strong> 次'
);

$lang_list_users = array(
	'user_list' => '使用者列表',
	'no_user_gal' => '尚未有使用者被允許使用圖庫夾',
	'n_albums' => '%s 個圖庫夾',
	'n_pics' => '%s 張圖片'
);

$lang_list_albums = array(
	'n_pictures' => '%s 張圖片',
	'last_added' => ', 最近新增於 %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => '登入',
	'enter_login_pswd' => '輸入使用者名稱和密碼',
	'username' => '使用者名稱',
	'password' => '密碼',
	'remember_me' => '記住密碼',
	'welcome' => '歡迎 %s ...',
	'err_login' => '*** 無法登入. 請重試 ***',
	'err_already_logged_in' => '您已經登入 !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => '登出',
	'bye' => '再見了 %s ...',
	'err_not_loged_in' => '您尚未登入 !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => '更新圖庫夾 %s',
	'general_settings' => '一般設定',
	'alb_title' => '圖庫夾標題',
	'alb_cat' => '圖庫夾類別',
	'alb_desc' => '圖庫夾描述',
	'alb_thumb' => '圖庫夾縮圖',
	'alb_perm' => '該圖庫夾存取遭拒',
	'can_view' => '圖庫夾可觀看依',
	'can_upload' => '訪客可以上傳圖片',
	'can_post_comments' => '訪客可以張貼評論意見',
	'can_rate' => '訪客可以為圖片評分',
	'user_gal' => '使用者相簿',
	'no_cat' => '* 沒有類別 *',
	'alb_empty' => '圖庫夾是空的',
	'last_uploaded' => '最近上傳',
	'public_alb' => '任何人 (公用圖庫夾)',
	'me_only' => '只有我',
	'owner_only' => '只有圖庫夾擁有人 (%s)',
	'groupp_only' => '只有群組會員 \'%s\'',
	'err_no_alb_to_modify' => '資料庫內尚未有您可以編修的圖庫夾.',
	'update' => '更新圖庫夾'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '抱歉,您已經為此圖片評過分了',
	'rate_ok' => '您的投票已經被接受',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
當管理者於 {SITE_NAME} 會儘快整理您的資料,但我們不可能隨時詳細觀看每一份張文件. 因此您必需同意讓本站有權利在任何時候做適當的調整您張貼的文件,以保持本站的品質.<br>
<br>
您必需同意不可張貼任何色情, 暴力, 不良, 不正當, 不健康, 妨害國家安全, 或其他非正當取得文件. {SITE_NAME} 在任何時候都有權利過濾並編輯您張貼的內容,並有權修改你留在本站內的資料. 但請放心,我們不會將您的資料轉給其他人使用.除此之外,您在本站張貼的內容本站都不為您負任何責任.<br>
<br>
本站使用COOKIES來儲存您的電腦上資訊. 這樣是方便您更快速閱讀本站資訊. 您的 email 只是讓我們認您的資料而已,失們不會外洩.<br>
<br>
按下 '我同意' 繼續.
EOT;

$lang_register_php = array(
	'page_title' => '註冊使用者',
	'term_cond' => '條件與規則',
	'i_agree' => '我同意',
	'submit' => '送出註冊',
	'err_user_exists' => '您所填寫的使用者名稱已被人使用, 請重填一個',
	'err_password_mismatch' => '兩次密碼不合, 請重填一次',
	'err_uname_short' => '使用者名稱至少需 2 個字元',
	'err_password_short' => '密碼至少需 2 個字元',
	'err_uname_pass_diff' => '使用者名稱和密碼不可以相同',
	'err_invalid_email' => 'Email 不正確',
	'err_duplicate_email' => '這個 email 已經被其他人使用過了',
	'enter_info' => '加入註冊者資料',
	'required_info' => '必要的資料',
	'optional_info' => '非必要的資料',
	'username' => '使用者名稱',
	'password' => '密碼',
	'password_again' => '確認密碼',
	'email' => 'Email',
	'location' => '位置',
	'interests' => '興趣',
	'website' => '首頁',
	'occupation' => '職業',
	'error' => '錯誤',
	'confirm_email_subject' => '%s - 註冊管理設定',
	'information' => '訊息',
	'failed_sending_email' => '所註冊的 email 無法送出 !',
	'thank_you' => '感謝您的註冊.<br><br>一封 email 內含有如何啟用帳號的資訊將被送到您所提供的信箱.',
	'acct_created' => '您的帳號已經建立，現在您可以登入管理',
	'acct_active' => '您的帳號已經啟用，現在您可以登入管理個人資料',
	'acct_already_act' => '您的帳號已經啟用 !',
	'acct_act_failed' => '此帳號無法啟用 !',
	'err_unk_user' => '所選擇的使用者並不存在 !',
	'x_s_profile' => '%s\' 的個人資料',
	'group' => '群組',
	'reg_date' => '加入',
	'disk_usage' => '磁碟使用量',
	'change_pass' => '修改密碼',
	'current_pass' => '舊密碼',
	'new_pass' => '新密碼',
	'new_pass_again' => '確認密碼',
	'err_curr_pass' => '舊密碼不正確',
	'apply_modif' => '提報修改',
	'change_pass' => '修改我的密碼',
	'update_success' => '你的個人資料已經更新',
	'pass_chg_success' => '你的密碼已經修改',
	'pass_chg_error' => '你的密碼沒有修改',
);

$lang_register_confirm_email = <<<EOT
感謝您註冊於 {SITE_NAME}

您的帳號 : "{USER_NAME}"
您的密碼 : "{PASSWORD}"

為了方便啟動您的帳號,您必需按一下下面的連結
或者先將這個連結存起來.

{ACT_LINK}

祝福您,

 {SITE_NAME} 敬上

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => '觀看意見',
	'no_comment' => '尚未有意見可以觀看',
	'n_comm_del' => '%s 個意見已刪除',
	'n_comm_disp' => '要顯示的意見數量',
	'see_prev' => '看前一個',
	'see_next' => '看下一個',
	'del_comm' => '刪除所選的意見',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '投尋圖片內容',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '尋找新圖片',
	'select_dir' => '選擇目錄',
	'select_dir_msg' => '本功能可以讓你整批匯入你用 FTP 上傳的圖片.<br><br>請選擇你所上傳的圖片目錄',
	'no_pic_to_add' => '沒有圖片可以加入',
	'need_one_album' => '要使用此功能必需少要有一個圖庫夾',
	'warning' => '警告',
	'change_perm' => '程式無法寫入這個目錄, 請修改CHMOD 為 755 或 777 後再試一次!',
	'target_album' => '<strong>加入圖片 &quot;</strong>%s<strong>&quot; 到 </strong>%s',
	'folder' => '資料夾',
	'image' => '圖片',
	'album' => '圖庫夾',
	'result' => '結果',
	'dir_ro' => '無法寫入. ',
	'dir_cant_read' => '無法讀取. ',
	'insert' => '新增圖片至相簿',
	'list_new_pic' => '列出新圖片',
	'insert_selected' => '加入所選擇的圖片',
	'no_pic_found' => '沒有找到新圖片',
	'be_patient' => '請耐心等候, 程式需要一點時間來加入所選圖片',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : 表示圖片已成功被加入'.
				'<li><strong>DP</strong> : 表示圖片重覆或已存在資料庫'.
				'<li><strong>PB</strong> : 表示圖片無法加入, 請檢查組態設定或圖片存放目錄的使用權限'.
				'<li>如果 OK, DP, PB \'符號\' 沒有顯示請按壞掉的圖片看看 PHP 顯示的錯誤訊息'.
				'<li>如果瀏覽器延遲, 請按重新整理'.
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
	'title' => '上傳圖片',
	'max_fsize' => '可允許的檔案最大為 %s KB',
	'album' => '圖庫夾',
	'picture' => '圖片',
	'pic_title' => '圖片標題',
	'description' => '圖片描述',
	'keywords' => '關鍵字 (請以空格區隔)',
	'err_no_alb_uploadables' => '目前尚未有圖庫夾可以供您上傳圖片',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => '使用者管理',
	'name_a' => '名稱升次排序',
	'name_d' => '名稱降次排序',
	'group_a' => '群組升次排序',
	'group_d' => '群組降次排序',
	'reg_a' => '註冊日期升次排序',
	'reg_d' => '註冊日期降次排序',
	'pic_a' => '圖片數升次排序',
	'pic_d' => '圖片數降次排序',
	'disku_a' => '使用量升次排序',
	'disku_d' => '使用量降次排序',
	'sort_by' => '使用者排序依',
	'err_no_users' => '使用者資料表是空的 !',
	'err_edit_self' => '您無法編輯個人資料, 請利用 \'我的個人資料\' 來編輯',
	'edit' => '編輯',
	'delete' => '刪除',
	'name' => '使用者名稱',
	'group' => '群組',
	'inactive' => '不啟動',
	'operations' => '動作',
	'pictures' => '圖片',
	'disk_space' => '空間 使用量 / 總量',
	'registered_on' => '註冊日',
	'u_user_on_p_pages' => '%d 個使用者於 %d 頁',
	'confirm_del' => '確定要刪除這個使用者嗎 ? \\n連同他的圖庫夾及圖片都會被刪除.',
	'mail' => 'MAIL',
	'err_unknown_user' => '所選擇的使用者並不存在 !',
	'modify_user' => '編輯使用者',
	'notes' => '注意',
	'note_list' => '<li>如果你不想改變目前的密碼, 請將 "密碼" 位留下空白',
	'password' => '密碼',
	'user_active_cp' => '使用者啟動中',
	'user_group_cp' => '使用者群組',
	'user_email' => '使用者 email',
	'user_web_site' => '使用者首頁',
	'create_new_user' => '建立新使用者',
	'user_from' => '使用者位置',
	'user_interests' => '使用者興趣',
	'user_occ' => '使用者職業',
);
?>