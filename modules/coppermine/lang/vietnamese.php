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
// to all devs: stop update just before committing this file!
// info about translators and translated language
define('PIC_VIEWS', 'lần xem');
define('PIC_VOTES', 'lần đánh giá)');
define('PIC_COMMENTS', 'nhận xét');

$lang_translation_info = array(
    'lang_name_english' => 'VietNamese', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'tiếng Việt', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'vn', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Hữu Từ', // the name of the translator - can be a nickname
    'trans_email' => 'cutu9@yahoo.com', // translator's email address (optional)
    'trans_website' => 'http://www.u2u.us', // translator's website (optional)
    'trans_date' => '2003-10-30', // the date the translation was created / last modified
    );

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7');
$lang_month = array('Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12');
// Some common strings
$lang_yes = 'Có';
$lang_no = 'Không';
$lang_back = 'TRỞ LẠI';
$lang_continue = 'TIẾP TỤC';
$lang_info = 'Thông tin';
$lang_error = 'Lỗi';
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

$lang_meta_album_names = array('random' => 'Hình ngẫu nhiên',
    'lastup' => 'Hình mới thêm vào',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Album vừa cập nhật',

    'lastcom' => 'Nhận xét cuối',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Xem nhiều',
    'toprated' => 'Đánh giá cao',
    'lasthits' => 'Xem lần cuối',
    'search' => 'Kết quả tìm thấy',

    'favpics' => 'Yêu thích'

    );

$lang_errors = array('access_denied' => 'Bạn không có quyền ở trang này',
    'perm_denied' => 'Bạn không có quyền để thực hiện',
    'param_missing' => 'Gọi không có thông số',
    'non_exist_ap' => 'Lựa chọn album/hình không có!',
    'quota_exceeded' => 'Hết dung lựơng<br /><br /Bạn chỉ có  [quota]K,hình của bạn đã chiếm  [space]K, thêm hình này vào sẽ vựơt khoảng trống cho phép.',
    'gd_file_type_err' => 'Khi dùng thư viện GD chỉ xử lý đựơc hình có đuôi là JPEG và PNG.',
    'invalid_image' => 'Hình bạn tải lên gặp trục trặc hoặc không thể đựơc  thư viện GD xử lý',
    'resize_failed' => 'Không thể tạo thumbnail hoặc thay đổi kích thứơc hình',
    'no_img_to_display' => 'Không có hình nào cả',
    'non_exist_cat' => 'Phân loại bạn chọn không tồn tại',
    'orphan_cat' => 'Phân loại bạn chọn không có Phân loại gôc, vào phần quản lý Phân loại để chỉnh lại.',
    'directory_ro' => 'Đừơng dẫn \'%s\' không thể thực thi, hình không thể xoá',
    'non_exist_comment' => 'Nhận xét bạn chọn không tồn tại.',
    'pic_in_invalid_album' => 'PHình nằm trong Album không tồn tại (%s)!?',

    'banned' => 'Bạn đang bị cấm tham gia site này.',

    'not_with_udb' => 'Chức năng này không đựơc phép sử dụng vì nó tương tác với forum. Bạn hãy cấu hình lại hoặc chỉnh trong chức năng của forum',

    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Danh sách Album',
    'alb_list_lnk' => 'những Album',
    'my_gal_title' => 'Hình cá nhân',
    'my_gal_lnk' => 'Hình của tôi',
    'my_prof_lnk' => 'Góc cá nhân',
    'adm_mode_title' => 'chuyển admin mode',
    'adm_mode_lnk' => 'Admin mode',
    'usr_mode_title' => 'Chuyển user mode',
    'usr_mode_lnk' => 'Chuyển qua giao diện ngừơi dùng',
    'upload_pic_title' => 'Tải hình vào Album',
    'upload_pic_lnk' => 'Tải  hình',
    'register_title' => 'Tạo tài khoản',
    'register_lnk' => 'Đăng ký',
    'login_lnk' => 'Đăng nhập',
    'logout_lnk' => 'Thoát',
    'lastup_lnk' => 'Mới tải lên',
    'lastcom_lnk' => 'Mới nhận xét',
    'topn_lnk' => 'Xem nhiều',
    'toprated_lnk' => 'Đánh giá cao',
    'search_lnk' => 'Tìm',
    'fav_lnk' => 'Yêu thích',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Luật khi upload',
    'config_lnk' => 'Cấu hình',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'Phân loại',
    'users_lnk' => 'Users',
    'groups_lnk' => 'Nhóm',
    'comments_lnk' => 'Nhận xét',
    'searchnew_lnk' => 'Đừơng dẫn và Hình',
    'util_lnk' => 'chỉnh kích cỡ',

    'ban_lnk' => 'Cấm tham gia',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Tạo, sắp xếp',
    'modifyalb_lnk' => 'Chỉnh Album của mình',
    'my_prof_lnk' => 'Cá nhân',
    );

$lang_cat_list = array('category' => 'Phân lọai',
    'albums' => 'Albums',
    'pictures' => 'Hình',
    );

$lang_album_list = array('album_on_page' => '%d album trên %d trang'
    );

$lang_thumb_view = array('date' => 'DATE',
    'name' => 'FILE NAME',

    'title' => 'TITLE',

    'sort_da' => 'Sắp xếp tăng dần',
    'sort_dd' => 'Sắp xếp giảm dần',
    'sort_na' => 'Sắp xếp tăng ',
    'sort_nd' => 'Sắp xếp giảm dần',
    'sort_ta' => 'Sắp xếp tăng dần',

    'sort_td' => 'Sắp xếp giảm dần',

    'pic_on_page' => '%d hình trên %d trang',
    'user_on_page' => '%d hình trên %d trang',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'trở lại trang thumbnail',
    'pic_info_title' => 'Hiện/Ẩn thông tin hình',
    'slideshow_title' => 'Lướt qua',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Gửi hình này làm thiệp tặng',
    'ecard_disabled' => 'e-cards không cho phép',
    'ecard_disabled_msg' => 'Bạn không có quyền để gửi hình',
    'prev_title' => 'Xem hình trứoc',
    'next_title' => 'Xem hình sau',
    'pic_pos' => 'HÌNH %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Đánh giá hình này ',
    'no_votes' => '(Chưa ai đánh giá)',
    'rating' => '(Mức đựơc đánh giá: %s / 5 với %s lần đánh giá)',
    'rubbish' => 'Tệ',
    'poor' => 'Xấu',
    'fair' => 'Đựơc',
    'good' => 'Tốt',
    'excellent' => 'Rất tốt',
    'great' => 'Tuyệt vời',
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
    CRITICAL_ERROR => 'Lỗi',
    'file' => 'File: ',
    'line' => 'Dòng: ',
    );

$lang_display_thumbnails = array('filename' => 'Tên file : ',
    'filesize' => 'Dung luợng file : ',
    'dimensions' => 'Định kích cỡ : ',
    'date_added' => 'Ngày đưa vào : '
    );

$lang_get_pic_data = array('n_comments' => '%s nhận xét',
    'n_views' => '%s lần xem',
    'n_votes' => '(%s lần đánh giá)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Thán phục',
        'Question' => 'Câu hỏi',
        'Very Happy' => 'Rất hạnh phúc',
        'Smile' => 'Cừơi',
        'Sad' => 'Buồn',
        'Surprised' => 'Ngạc nhiên',
        'Shocked' => 'Choáng',
        'Confused' => 'Lúng túng',
        'Cool' => 'Tuyệt',
        'Laughing' => 'Cừơi to',
        'Mad' => 'Khìn',
        'Razz' => 'Chế giễu',
        'Embarassed' => 'Ấn tựơng',
        'Crying or Very sad' => 'Buồn khóc',
        'Evil or Very Mad' => 'Rất khùng',
        'Twisted Evil' => 'Qủy',
        'Rolling Eyes' => 'Liếc mắt',
        'Wink' => 'Nháy mắt',
        'Idea' => 'Ý tửơng',
        'Arrow' => 'Mũi tên',
        'Neutral' => 'Trung lập',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Thoát khỏi giao diện Quản trị....',
        1 => 'Đăng nhập vào giao diện Quản trị ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Cần đặt tên cho Album',
        'confirm_modifs' => 'Chắc chắn là bạn muốn chỉnh sửa như thế chứ ?',
        'no_change' => 'Chưa chỉnh sửa gì cả !',
        'new_album' => 'Album mới',
        'confirm_delete1' => 'Chắc chắn xoá Album này đi chứ ?',
        'confirm_delete2' => '\n Tất cả hình trong này cũng sẽ bị xoá theo luôn',
        'select_first' => 'Trứơc tiên phải chọn Album',
        'alb_mrg' => 'Quản lý Album ',
        'my_gallery' => '* Hình của tôi*',
        'no_category' => '* Không phân loại *',
        'delete' => 'Xoá',
        'new' => 'Mới',
        'apply_modifs' => 'Cập nhật chỉnh sửa',
        'select_category' => 'Chọn phân loại',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parameters required for \'%s\'operation not supplied !',
        'unknown_cat' => 'Phân loại này không nằm trong cơ sở dữ liệu',
        'usergal_cat_ro' => 'Hình của User không thể bị xoá',
        'manage_cat' => 'Quản lý Phân loại',
        'confirm_delete' => 'Are you sure you want to DELETE this category',
        'category' => 'Phân loại',
        'operations' => 'Hoạt động',
        'move_into' => 'Chuyển vào',
        'update_create' => 'Cập nhật/Tạo Phân loại',
        'parent_cat' => 'Phân loại cha',
        'cat_title' => 'Tên Phân loại',
        'cat_desc' => 'Mô tả phân loại'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Cấu hình',
        'restore_cfg' => 'Quay lại mặc định',
        'save_cfg' => 'Chấp nhận cấu hình mới',
        'notes' => 'Ghi chú',
        'info' => 'Thông tin',
        'upd_success' => 'OK đã đựơc cập nhật!',
        'restore_success' => 'Đã trở lại mặc định !',
        'name_a' => 'Tên tăng dần',
        'name_d' => 'Tên giảm dần',
        'title_a' => 'Tựa đề tăng dần',

        'title_d' => 'Tựa đề giảm dần',

        'date_a' => 'Ngày tăng dần',
        'date_d' => 'Ngày giảm dầ',
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
            'Tên trang web', 'gallery_name', 0),
        array(
            'Lời mô tả', 'gallery_description', 0),
        array(
            'Mail của ngừơi quản trị', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Ngôn ngữ', 'lang', 5),
// for postnuke change
        array('Giao diện', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Xem danh sách Album',
        array(
            'Chiều ngang table chính (pixels hay %)', 'main_table_width', 0),
        array(
            'Số thứ tự phân loại sẽ hiển thị', 'subcat_level', 0),
        array(
            'Số của Album sẽ hiển thị', 'albums_per_page', 0),
        array(
            'Số cột của 1 Album', 'album_list_cols', 0),
        array(
            'Kích thứơc 1 ThumbNails', 'alb_list_thumb_size', 0),
        array(
            'Nội dung của trang chính', 'main_page_layout', 0),
        array(
            'Hiển thị Album đầu tiên dạng thumbnails trong Phân loại', 'first_level', 1), 
        // 'Thumbnail view',
        'Xem dạng Thumbnail',
        array(
            'Số cột Thumbnail 1 trang', 'thumbcols', 0),
        array(
            'Số dòng thumbnail 1 trang', 'thumbrows', 0),
        array(
            'Tối đa  tabs thể hiện', 'max_tabs', 0),
        array(
            'Hiển thị thông tin về tấm hình phía dứơi mỗi tấm hình', 'caption_in_thumbview', 1),
        array(
            'Hiển thị số lần nhận xét dưới mỗi tấm hình', 'display_comment_count', 1),
        array(
            'Sắp xếp theo thứ tự hay như mặc định', 'default_sort_order', 3),
        array(
            'Tối thiểu số lần đánh giá  1 tấm hình để đựơc xuất hiện trên danh sách đựơc đánh giá cao', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Xem hình &amp; Lời nhận xét',
        array(
            'Chiếu ngang cho 1 tấm hình hiển thị (pixels hay %)', 'picture_table_width', 0),
        array(
            'Thông tin hình hiển thị như mặc định', 'display_pic_info', 1),
        array(
            'Lọc từ ngữ trong phần nhận xét', 'filter_bad_words', 1),
        array(
            'Cho phép hiển thị Icon cừơi trong nhận xét ?', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Độ dài cho lời miêu tả tấm hình', 'max_img_desc_length', 0),
        array(
            'Tối đa ký tự trong 1 từ', 'max_com_wlength', 0),
        array(
            'Tối đa số dòng trong lời nhận xét', 'max_com_lines', 0),
        array(
            'Tối đa 1 lời nhận xét', 'max_com_size', 0),
        array(
            'Hiển thị như là hình 1 phim', 'display_film_strip', 1),

        array(
            'Số hình ', 'max_film_strip_items', 0),

        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Hình và Thumnail',
        array(
            'Chất lượng JPEG files', 'jpeg_qual', 0),
        array(
            'Kích thứơc cao nhất 1 thumnail <strong>*</strong>', 'thumb_width', 0),

        array(
            'Kích thứơc bề ngoài Thumnail<strong>*</strong>', 'thumb_use', 7),

        array(
            'Tạo hình trung gian', 'make_intermediate', 1),
        array(
            'Tối đa chiều rộng hay cao 1 hình trung gian<strong>*</strong>', 'picture_width', 0),
        array(
            'Dung lựơng tối đa 1 tấm hình đựơc tải lên(KB)', 'max_upl_size', 0),
        array(
            'Tối đa kích thứơc 1 tấm hình đựơc tải lên', 'max_upl_width_height', 0), 
        // 'User settings',
        'Ngừơi dùng',
        array(
            'Cho phép ngừơi dùng đăng ký', 'allow_user_registration', 1),
        array(
            'Khi đăng ký ngừơi dùng cần phải kích hoạt mail', 'reg_requires_valid_email', 1),
        array(
            'Cho phép trùng mail khi đăng ký', 'allow_duplicate_emails_addr', 1),
        array(
            'Ngừơi dùng đựơc tạo Album riêng', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Chỉnh sửa chỗ điền lời mô tả cho tấm (bỏ trắng nếu không thích)',
        array(
            'Phần 1 tên ', 'user_field1_name', 0),
        array(
            'Phần 2 tên', 'user_field2_name', 0),
        array(
            'Phần 3 tên', 'user_field3_name', 0),
        array(
            'Phần 4 tên', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Chỉnh sửa chi tiết hơn Hình và Thumnail',
        array(
            'Hiển thị Album riêng cho ngừơi chưa đăng nhập ?', 'show_private', 1),

        array(
            'Ký tự bị ngăn cấm', 'forbiden_fname_char', 0),
        array(
            'Chấp nhận cho file mở rộng khi tải hình lên?', 'allowed_file_extensions', 0),
        array(
            'Phương thức chỉnh sửa kích thứơc hình', 'thumb_method', 2),
        array(
            'Đừơng dẫn\'convert\' tiện ích(ví dụ như /usr/bin/X11/)', 'impath', 0),
        array(
            'Cho phép hình có đuôi dạng (chí có tác dụng khi dùng ImageMagick)', 'allowed_img_types', 0),
        array(
            'Dòng lệnh tùy chọn  cho  ImageMagick', 'im_options', 0),
        array(
            'Đọc EXIF dữ liệu trong JPEG files', 'read_exif_data', 1),
        array(
            'Đọc ITPC dữ liệu trong JPEG files', 'read_itpc_data', 1),
        array(
            'Đừơng dẫn Album <strong>*</strong>', 'fullpath', 0),
        array(
            'Đừơng dẫn đến nơi lưu giữ hình của User <strong>*</strong>', 'userpics', 0),
        array(
            'Ký tự phía trứơc tên của mỗi file hình mở rộng  <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Ký tự phía trứơc mỗi thumnail <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Chế độ mặc định cho đừơng dẫn', 'default_dir_mode', 0),
        array(
            'Chế độ mặc định cho hình ', 'default_file_mode', 0),
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
            'Tên của cookie', 'cookie_name', 0),
        array(
            'Đừơng dẫn của cookie', 'cookie_path', 0),
        array(
            'Kiểu mã hoá ký tự (charset)', 'charset', 4),

        'Linh tinh',
        array(
            'Cho phép chế độ báo lỗi', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Những dòng có * không đựơc thay đổi khi hình đã có trong Album rồi</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Bạn cần viết tên và lời nhận xét vào',
        'com_added' => 'Lời nhận xét đựơc chấp nhận !',
        'alb_need_title' => 'Bạn cần đặt tên cho Album!',
        'no_udp_needed' => 'Không cần sự cập nhật',
        'alb_updated' => 'Album đựơc cập nhật',
        'unknown_album' => 'Album vừa chọn không có hoặc là bạn không có quyền để tải hình lên ở album này rồi ',
        'no_pic_uploaded' => 'Không có hình nào đựơc tải lên cả!!<br /><br />Bạn coi lại xem tấm hình tải lên server này có hợp yêu cầu chưa ?',
        'err_mkdir' => 'Lỗi khi tạo đừơng dẫn %s !',
        'dest_dir_ro' => 'Đừơng dẫn đến %s không thể truy cập  !',
        'err_move' => 'Không thể di chuyển %s đến %s !',
        'err_fsize_too_large' => 'Kích thứơc của tấm hình bạn tải lên quá lớn so với qui định (tối đa là %s x %s) !',
        'err_imgsize_too_large' => 'Dung lượng file bạn tải lên quá lớn so với qui định (tối đa là %s KB) !',
        'err_invalid_img' => 'File bạn muốn tải lên đâu phải là hình ảnh !',
        'allowed_img_types' => 'Chỉ đựơc phép tải  hình %s ',
        'err_insert_pic' => 'Hình \'%s\' không thể đựơc chèn vào Album ',
        'upload_success' => 'Hình của bạn đã đựơc tải lên thành công !<br /><br />Nó sẽ đựơc hiển thị khi Ban Quản Trị ch phép',
        'info' => 'Thông tin',
        'com_added' => 'Lời nhận xét đựơc chấp nhận',
        'alb_updated' => 'Album đựơc cập nhật!',
        'err_comment_empty' => 'Nhận xét của bạn trống!',
        'err_invalid_fext' => 'Chỉ có các loại file với đuôi sau đây đựơc chấp nhận : <br /><br />%s.',
        'no_flood' => 'Xin lôi, bạn đã là tác giả của lời nhận xét hình nà rồi <br /><br />Sửa lại nhận xét này nếu bạn muốn !',
        'redirect_msg' => 'Chúng tôi sẽ chuyển bạn đến<br /><br /><br />Click \'CONTINUE\' nếu trang này không tự động',
        'upl_success' => 'Chúc mừng, hình của bạn đã đựơc tải lên thành công',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Mô tả',
        'fs_pic' => 'Kích thứơc hình',
        'del_success' => 'Xoá thành công!',
        'ns_pic' => 'kích thứơc hình bình thừơng',
        'err_del' => 'không thể xóa',
        'thumb_pic' => 'thumbnail',
        'comment' => 'nhận xét',
        'im_in_alb' => 'hình trong album',
        'alb_del_success' => 'Album \'%s\' đã bị xoá',
        'alb_mgr' => 'Quản lý Album ',
        'err_invalid_data' => 'Dữ liệu không đúng ở \'%s\'',
        'create_alb' => 'Đang tạo Album \'%s\'',
        'update_alb' => 'Đang cập nhật Album \'%s\' với tựa \'%s\' và chỉ mục \'%s\'',
        'del_pic' => 'Xoá hình',
        'del_alb' => 'Xoá Album',
        'del_user' => 'Xoá User',
        'err_unknown_user' => 'User này không tồn tại!',
        'comment_deleted' => 'Nhận xét đã bị xóa bỏ',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Có chắc chắn xóa hình này kô ? \\nNhận xét cũng sẽ bí xoá',
        'del_pic' => 'XOÁ HÌNH NÀY',
        'size' => '%s x %s pixels',
        'views' => '%s lần',
        'slideshow' => 'lứơt qua',
        'stop_slideshow' => 'Dừng lại',
        'view_fs' => 'Clik vào để xem hình to hơn',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'thông tin hình',
        'Filename' => 'Tên file',
        'Album name' => 'tên Album',
        'Rating' => 'Đánh giá (%s lần)',
        'Keywords' => 'Từ khoá',
        'File Size' => 'Dung lựơng file',
        'Dimensions' => 'Kích cỡ',
        'Displayed' => 'Đã hịiển thị',
        'Camera' => 'Camera',
        'Date taken' => 'Date taken',
        'Aperture' => 'Độ mở',
        'Exposure time' => 'Exposure time',
        'Focal length' => 'Focal length',
        'Comment' => 'Nhận xét',
        'addFav' => 'Thêm vào phần yêu thích',

        'addFavPhrase' => 'Yêu thích',

        'remFav' => 'Xoá khỏi phần yêu thích',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Sửa lời nhận xét này',
        'confirm_delete' => 'Có chắc là muốn xoá nhận xét này không  ?',
        'add_your_comment' => 'Thêm nhận xét vào',
        'name' => 'Tên',

        'comment' => 'Nhận xét',

        'your_name' => 'nặc danh',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Click vào hình để đóng cửa sổ này',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Gửi an e-card',
        'invalid_email' => '<strong>Cảnh báo</strong> : địa chỉ mail không hợp lý !',
        'ecard_title' => 'thiệp từ %s cho bạn',
        'view_ecard' => 'nếu tấm thiệp này không hiển thị đúng thì hãy click vào đây',
        'view_more_pics' => 'Click vào đây để có thể xem nhiều hình hơn',
        'send_success' => 'thiệp của bạn đã đựơc gửi',
        'send_failed' => 'Xin lỗi, server không thể gửi thiệp của bạn đi đựơc',
        'from' => 'Từ',
        'your_name' => 'Tên của bạn',
        'your_email' => 'Mail của bạn',
        'to' => 'Đến',
        'rcpt_name' => 'tên ngừơi nhận',
        'rcpt_email' => 'Mail của ngừơi nhận',
        'greetings' => 'lời chào',
        'message' => 'Nội dung chúc',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Hình&nbsp;thông tin',
        'album' => 'Album',
        'title' => 'Tựa đề',
        'desc' => 'Mô tả',
        'keywords' => 'Từ khoá',
        'pic_info_str' => '%sx%s - %sKB - %s lần xem - %s lần đánh giá',
        'approve' => 'chấp nhận hình',
        'postpone_app' => 'khoan chấp nhận',
        'del_pic' => 'Xoá hình',
        'reset_view_count' => 'trả lại số lần xem',
        'reset_votes' => 'trả lại số lần đánh giá',
        'del_comm' => 'Xóa nhận xét',
        'upl_approval' => 'cho phép tải lên',
        'edit_pics' => 'Sửa hình',
        'see_next' => 'Xem hình kế tiếp',
        'see_prev' => 'Xem hình trứơc',
        'n_pic' => '%s hình',
        'n_of_pic_to_disp' => 'Số hình đựơc hiển thị',
        'apply' => 'Cập nhật thay đổi này'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'tên nhóm',
        'disk_quota' => 'Dung lựơng đĩa',
        'can_rate' => 'Có thể đánh giá hình',
        'can_send_ecards' => 'Có thể gửi thiệp',
        'can_post_com' => 'Có thể viết nhận xét',
        'can_upload' => 'Có thể tải hình lên',
        'can_have_gallery' => 'Có góc cá nhân riêng',
        'apply' => 'Cập nhật thay đổi này',
        'create_new_group' => 'Tạo nhóm mới',
        'del_groups' => 'Xoá các nhóm đã chọn',
        'confirm_del' => 'Chú ý, khi xoá 1 nhóm thì các thành viên trong nhóm này sẽ đựơc chuyển đến nhóm \'Registered\' !\n\n Bạn có muốn tiến hành ?',
        'title' => 'Điều khiển nhóm',
        'approval_1' => 'Pub. Upl. chấp nhận (1)',
        'approval_2' => 'Priv. Upl. chấp nhận (2)',
        'note1' => '<strong>(1)</strong> đựơc tải hỉnh lên chỗ cần đựơc Ban Quản Trị đồng ý ',
        'note2' => '<strong>(2)</strong> đựơc upload lên nơi mà user cần Ban Quản Tri cho phép',
        'notes' => 'Ghi chú'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Chào mừng !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Có chắc là bạn muốn xóa Album này  ? \\n Tất cả hình và nhận xét cũng sẽ bị xoá.',
        'delete' => 'XÓA',
        'modify' => 'THUỘC TÍNH',
        'edit_pics' => 'SỬA HÌNH',
        );

    $lang_list_categories = array('home' => 'Trang chủ',
        'stat1' => '<strong>[pictures] </strong> hình trong <strong>[albums]</strong> album và <strong>[cat]</strong> Phân loại với <strong>[comments]</strong> nhận xét, xem <strong>[views]</strong> lần',
        'stat2' => '<strong>[pictures]</strong> hình trong <strong>[albums]</strong> album đựơc xem <strong>[views]</strong> lần',
        'xx_s_gallery' => 'hình của %s\ ',
        'stat3' => '<strong>[pictures]</strong> hình trong <strong>[albums]</strong> album với <strong>[comments]</strong> nhận xét, đựơc xem <strong>[views]</strong> lần'
        );

    $lang_list_users = array('user_list' => 'Danh sách ngừơi dùng',
        'no_user_gal' => 'Không có hình ngừơi dùng',
        'n_albums' => '%s album',
        'n_pics' => '%s hình'
        );

    $lang_list_albums = array('n_pictures' => '%s hình',
        'last_added' => ', lần cuối thêm vào: %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Cập nhật album %s',
        'general_settings' => 'Chung chung',
        'alb_title' => 'tựa đề Album',
        'alb_cat' => 'phân loại Album ',
        'alb_desc' => 'mô tả Album',
        'alb_thumb' => 'Album thumbnail',
        'alb_perm' => 'Quyền hạn cho Album này',
        'can_view' => 'Album này có thể đựơc xem bởi',
        'can_upload' => 'Khách có thể tải hình lên',
        'can_post_comments' => 'Khách có thể nhận xét',
        'can_rate' => 'Khách có thể đánh giá hình',
        'user_gal' => 'hình của ngừơi dùng',
        'no_cat' => '* Không có phân loại *',
        'alb_empty' => 'Album trống',
        'last_uploaded' => 'Cập nhật lần cuối',
        'public_alb' => 'Tất cả mọi người (album công cộng)',
        'me_only' => 'Chỉ riêng tôi',
        'owner_only' => 'chỉ chủ của Album (%s)',
        'groupp_only' => 'Thành vien nhóm \'%s\' ',
        'err_no_alb_to_modify' => 'không có album nào bạn có thể thay đổi trong dữ liệu.',
        'update' => 'Cập nhật album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Xin lỗi, bạn đã đánh giá hình này 1 lần rồi',
        'rate_ok' => 'Cám ơn bạn đã đánh giá',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Trong khi Ban Quản Trị của {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
Nếu đồng ý bạn vui lòng click vào  'I agree' dứơi đây.
EOT;

    $lang_register_php = array('page_title' => 'Đăng ký làm thành viên',
        'term_cond' => 'Nội qui',
        'i_agree' => 'tôi đồng ý',
        'submit' => 'Gửi thông tin đăng ký đi',
        'err_user_exists' => 'Tên bạn đăng ký đã có ngừơi sử dụng, vui lòng chọn 1 cái khac ',
        'err_password_mismatch' => 'Mật khuẩu bạn nhập 2 lần không trùng nhau, điền lại.',
        'err_uname_short' => 'Tên tối thiểu phải 2 ký tự trở lên',
        'err_password_short' => 'Mật khẩu phải trên 2 ký tự',
        'err_uname_pass_diff' => 'Tên và mật khẩu không đựơc giống nhau',
        'err_invalid_email' => 'Email không hợp lý',
        'err_duplicate_email' => 'Tài khoản khác đã xài Mail này rồi, bạn vui lòng dùng cai khác',
        'enter_info' => 'Điền thông tin đăng ký',
        'required_info' => 'Thông tin bắt buộc phải điền',
        'optional_info' => 'Thông tin thêm',
        'username' => 'Tên',
        'password' => 'Mật khẩu',
        'password_again' => 'Nhập lại mật khẩu',
        'email' => 'Email',
        'location' => 'Nơi đang sống',
        'interests' => 'Yêu thích',
        'website' => 'website riêng cua bạn',
        'occupation' => 'Công việc',
        'error' => 'LỖi',
        'confirm_email_subject' => '%s - Thông tin đăng ký',
        'information' => 'Thông tin',
        'failed_sending_email' => 'Không thể gửi bản đang ký này đến mail đựơc!',
        'thank_you' => 'Cám ơn bạn đã đăng ký.<br /><br />Một eMail với thông tin hứơng dẫn bạn kích hoạt tài khoản của bạn  đã đựoc gửi đến mail mà bạn đã cung cấp cho chúng tôi.',
        'acct_created' => 'OK, tài khoản của bạn đã đựơc kích hoạt, bây giờ bạn có thể đăng nhập với Tên và mật khẩu của bạn',
        'acct_active' => 'Hãy đăng nhập với Tên và mật khẩu của bạn',
        'acct_already_act' => 'Tài khoản đã đựơc kích hoạt!',
        'acct_act_failed' => 'Tài khoản này không thể đựơc kích hoạt!',
        'err_unk_user' => 'Tài khoản này không tồn tại!',
        'x_s_profile' => 'thông tin của %s ',
        'group' => 'nhóm',
        'reg_date' => 'tham gia từ',
        'disk_usage' => 'dung lựơng',
        'change_pass' => 'Đổi mật khẩu',
        'current_pass' => 'Mật khẩu hiện tại',
        'new_pass' => 'Mật khẩu mới',
        'new_pass_again' => 'Nhập lại mật khẩu mới 1 lần nữa',
        'err_curr_pass' => 'Mật khẩu hiện thời bạn nhập không chính xác',
        'apply_modif' => 'Cập nhật thay đổi',
        'change_pass' => 'Thay đổi mật khẩu',
        'update_success' => 'Thông tin của bạn đã đựơc chỉnh sửa',
        'pass_chg_success' => 'Mật khẩu đã đựơc thay đổi',
        'pass_chg_error' => 'Mật khẩu của bạn không đựơc thay đổi',
        );

    $lang_register_confirm_email = <<<EOT
Cám ơn bạn đã đăng ký với chúng tôi tại {SITE_NAME}

Tên tà khoản của bạn là : "{USER_NAME}" 
Mật khẩu là : "{PASSWORD}"

Để kích hoạt tài khoản, bạn cần click vào link sau .

{ACT_LINK}

thân,

ban quản trị {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'xem lại nhận xét',
        'no_comment' => 'Không có nhận xét nào để xem cả',
        'n_comm_del' => '%s nhận xét bị xoá',
        'n_comm_disp' => 'Số nhận xét đựơc hiển thị',
        'see_prev' => 'Xem nhận xét trứơc',
        'see_next' => 'Xem nhận xét sau',
        'del_comm' => 'Xóa nhận xét đã chọn',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Tìm kiếm hình tổng hợp',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Tìm hình mới',
        'select_dir' => 'Chọn đừơng dẫn',
        'select_dir_msg' => 'Chức năng này cho phép bạn thêm đừơng dẫn của hình mà đã đựơc tải lên  server bằng FTP.<br /><br />Chọn đừơng dẫn mà bạn muốn tải hình lên',
        'no_pic_to_add' => 'Không có hình để thêm vào',
        'need_one_album' => 'Bạn phải có ít nhất 1 album để xài chức năng này',
        'warning' => 'Cảnh báo',
        'change_perm' => 'tkhông thể chép vào thư mục này, cần phải Chmod là 755 hay 777 !',
        'target_album' => '<strong>Đặt hình của  &quot;</strong>%s<strong>&quot; vào </strong>%s',
        'folder' => 'Thư mục',
        'image' => 'Hình',
        'album' => 'Album',
        'result' => 'Kết quả',
        'dir_ro' => 'Không thể chỉnh sửa',
        'dir_cant_read' => 'Không thể xem',
        'insert' => 'Thêm hình vào',
        'list_new_pic' => 'Danh sách hình mới',
        'insert_selected' => 'Chèn hình đã chọn',
        'no_pic_found' => 'Không tìm thấy hình mơi nào cả',
        'be_patient' => 'Please be patient, the script needs time to add the pictures',
        'notes' => '<ul>' . '<li><strong>OK</strong> : hình đã đựơc thêm vào' . '<li><strong>DP</strong> : hình này trùng lặp và đã có trong cơ sở dữ liệu' . '<li><strong>PB</strong> : hình của bạn không thể đựơc thêm vào, kiểm tra lại cấu hình hoặc quyền.' . '<li>Nếu OK, DP, PB \'signs\' không xuất hiện thì click vào hình để PHP thông báo lỗi gặp phải' . '<li>Nếu web bị đứng, bấm F5 hoặc refresh' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Tải hình lên',
        'max_fsize' => 'Dung lựơng tối đa cho phép là %s KB',
        'album' => 'Album',
        'picture' => 'Hình',
        'pic_title' => 'Tựa đề hình',
        'description' => 'Mô tả hình',
        'keywords' => 'Từ khoá',
        'err_no_alb_uploadables' => 'Không có Album đó',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Quản lý ngừơi dùng',
        'name_a' => 'Tên tăng dần',
        'name_d' => 'Tên giảm dần',
        'group_a' => 'Nhóm tăng dần',
        'group_d' => 'Nhóm giảm dần',
        'reg_a' => 'Ngày tham gia tăng dần',
        'reg_d' => 'Ngày tham gia giảm dần',
        'pic_a' => 'Số hình tăng',
        'pic_d' => 'Số hình giảm',
        'disku_a' => 'Dung lựơng tăng',
        'disku_d' => 'Dung lương giảm',
        'sort_by' => 'Sắp xếp ngừơi dùng theo',
        'err_no_users' => 'Bảng quản lý ngừơi dùng trống !',
        'err_edit_self' => 'Bạn không thể tự mình thay đổi thông tin cá nhân, sử dụng  \'My profile\' để làm',
        'edit' => 'THAY ĐỔI',
        'delete' => 'XOÁ',
        'name' => 'tên tài khoản',
        'group' => 'Nhóm',
        'inactive' => 'không hoạt động',
        'operations' => 'Hệ điều hành',
        'pictures' => 'hình',
        'disk_space' => 'Dung lượng cho phép xài',
        'registered_on' => 'Đăng kí',
        'u_user_on_p_pages' => '%d ngừơi trên %d trang',
        'confirm_del' => 'Chắc chắn xoá tài khoản này chứ ? \\n Tất cả hình, nhận xét của họ cũng sẽ bị xoá.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Tài khoản này không tồn tại!',
        'modify_user' => 'Sửa đổi',
        'notes' => 'ghi chú',
        'note_list' => '<li>Nếu không muốn thay đổi mật khẩu thì để trống.',
        'password' => 'Mật khẩu',
        'user_active' => 'Tài khoản này đựơc kích hoạt',
        'user_group' => 'Nhóm',
        'user_email' => 'email',
        'user_web_site' => 'website ',
        'create_new_user' => 'Tạo tài khoản mới',
        'user_location' => 'Nơi cư ngụ',
        'user_interests' => 'Việc làm',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Chỉnh kích cỡ hình',

        'what_it_does' => 'Nó là cái gì',

        'what_update_titles' => 'Sửa tự đề từ tên file tải lên',

        'what_delete_title' => 'Xoá tựa đề',

        'what_rebuild' => 'Chỉnh lại thumbnail và kích cỡ hình',

        'what_delete_originals' => 'Xoá dung lựơng cũ và thay thế với dung lương mới ',

        'file' => 'File',

        'title_set_to' => 'đặt tên cho',

        'submit_form' => 'Gửi đi',

        'updated_succesfully' => 'Cập nhật thành công',

        'error_create' => 'LỖI !',

        'continue' => 'xử lý thêm hình',

        'main_success' => 'File %s đựơc dùng như hình chính',

        'error_rename' => 'Lỗi trong khoảng  %s đến %s',

        'error_not_found' => 'File %s không tìm thấy',

        'back' => 'Trở về trang chính',

        'thumbs_wait' => 'Đang chỉnh sửa, vui lòng chờ ...',

        'thumbs_continue_wait' => 'Tiếp tục chỉnh sửa ...',

        'titles_wait' => 'Sửa tên, vui lòng chờ ...',

        'delete_wait' => 'Xoá tên,  vui lòng chờ ...',

        'replace_wait' => 'Sửa, xoá dung lựơng cũ, thay với dung lương mới, vui lòng chờ ...',

        'instruction' => 'Tài liệu nhanh',

        'instruction_action' => 'Chọn hoạt động',

        'instruction_parameter' => 'Chọn thông số',

        'instruction_album' => 'chọn album',

        'instruction_press' => 'Nhấn %s',

        'update' => 'Đang xử lý',

        'update_what' => 'Cái gì cần cập nhật',

        'update_thumb' => 'Chỉthumbnails',

        'update_pic' => 'Chỉ chỉnh dung lượng hình',

        'update_both' => 'Cả thumbnails và dung lượng hình',

        'update_number' => 'Số lần thực thi sau mỗi lần click',

        'update_option' => '(giảm nó xuống nếu bạn gặp vấn đề về timeout)',

        'filename_title' => 'Tên file &rArr; Tựa đề hình',

        'filename_how' => 'Làm sao để đổi tên file',

        'filename_remove' => 'xoá file .jpg và thay thế  _ với  khoảng trống',

        'filename_euro' => 'Thay 2003_11_23_13_20_20.jpg bằng 23/11/2003 13:20',

        'filename_us' => 'Thay 2003_11_23_13_20_20.jpg bằng 11/23/2003 13:20',

        'filename_time' => 'Thay 2003_11_23_13_20_20.jpg thành 13:20',

        'delete' => 'Thay tên hình hoặc dung lượng của hình',

        'delete_title' => 'Xoá tên hình',

        'delete_original' => 'Xoá dung lượng hình',

        'delete_replace' => 'Xoá dung lượng cũ của hình và thay thế với cái mới',

        'select_album' => 'Chọn album',

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