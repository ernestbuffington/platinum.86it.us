<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke Language Pack 0.9                  //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
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
define('PIC_VIEWS', 'مشاهدات');
define('PIC_VOTES', 'تصويت');
define('PIC_COMMENTS', 'ملاحظات');

$lang_translation_info = array('lang_name_english' => 'Arabic',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'عربي', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'ar', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Waheed Alsayer', //the name of the translator - can be a nickname
'trans_email' => 'waheed@shamayel.com', //translator's email address (optional)
'trans_website' => 'http://www.shamayel.com/', //translator's website (optional)
'trans_date' => '2003-10-02', //the date the translation was created / last modified
);

$lang_charset = 'UTF-8';
$lang_text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('بايت', 'ك.ب', 'م.ب');
// Day of weeks and months
$lang_day_of_week = array('احد', 'اثنين', 'ثلاثاء', 'اربعاء', 'خميس', 'جمعة', 'سبت');
$lang_month = array('يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر');
// Some common strings
$lang_yes = 'نعم';
$lang_no  = 'لا';
$lang_back = 'رجوع';
$lang_continue = 'استمر';
$lang_info = 'معلومات';
$lang_error = 'خطأ';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
        'random' => 'صور عشوائيـــة',
	'lastup' => 'آخــر اضافــات',
    'lastupby' => 'اضافاتي الأخيرة', // new 1.2.2
        'lastalb'=> 'آخر ألبومات تم تحديثها',
	'lastcom' => 'آخر ملاحظــات',
    'lastcomby' => 'تعليقاتي الأخيرة', // new 1.2.2
	'topn' => 'اكثرها مشاهدة',
	'toprated' => 'اعلاها تقييما',
	'lasthits' => 'آخر ما شوهد',
	'search' => 'نتائج البحـث',
    'favpics' => 'صور مفضلة' // changed in cpg1.2.0nuke
);

$lang_errors = array('access_denied' => 'ليـس لديك الصلاحية لدخول هذه الصفحة.',
	'perm_denied' => 'ليس لديك الصلاحية للقيام بتلك الصلاحية.',
	'param_missing' => 'لقد نودي البرنامج بدون متغيرات.',
	'non_exist_ap' => 'الألبوم أو الصورة المختارة غير موجودة!',
	'quota_exceeded' => 'تخطيت حدود التخزين<br /><br />المساحة المسموحة لك [quota]K, صورك تحتل مساحة [space]K, وبإضافة هذه الصورة سوف تتخطى حدود التخزين المسموحة لك.',
	'gd_file_type_err' => 'عند استعمال مكتبة GD للبرامج لا يسمح إلا بـملفات  JPEG و PNG.',
	'invalid_image' => 'الصورة المحملة غير صالحة او لم تعالج بمكتبة GD',
	'resize_failed' => 'لم استطع تكوين اختصار الصورة او تصغيرها.',
	'no_img_to_display' => 'لا توجد صورة للعرض',
	'non_exist_cat' => 'التصنيف المختار غير موجود',
	'orphan_cat' => 'تصنيف ليس له تصنيف رئيسي, شغل مدير التصنيفات لعلاج المشكلة.',
	'directory_ro' => 'الدليل \'%s\' غير قابل للكتابة, لا استطيع الغاء الصورة',
	'non_exist_comment' => 'التعليق المختار غير موجود.',
	'pic_in_invalid_album' => 'الصورة غير موجودة في الالبوم (%s)!?',
        'banned' => 'انت ممنوع من استعمال الموقع حاليا.',
        'not_with_udb' => 'هذه الميزة معطلة في Coppermine لأنها مدموجة مع المنتدى. اما ما تود القيام به غير مدعوم, أو ان برنامج المنتدى يقوم بنفس المهمة.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'انتقل الى قائمة الالبومات',
	'alb_list_lnk' => 'قائمة الالبومات',
	'my_gal_title' => 'انتقل الى البومي الخاص',
	'my_gal_lnk' => 'البومي الخاص',
	'my_prof_lnk' => 'تعريفي',
	'adm_mode_title' => 'تحويل الى واجهة الادارة',
	'adm_mode_lnk' => 'حالة الادارة',
	'usr_mode_title' => 'تحويل الى واجهة الاستعمال',
	'usr_mode_lnk' => 'حالة المستخدم',
	'upload_pic_title' => 'تحميل الصورة في الالبوم',
	'upload_pic_lnk' => 'تحميل الصورة',
	'register_title' => 'تكوين حساب',
	'register_lnk' => 'تسجيل',
	'login_lnk' => 'دخول',
	'logout_lnk' => 'خروج',
	'lastup_lnk' => 'آخر تحميل',
	'lastcom_lnk' => 'آخر تعليقات',
	'topn_lnk' => 'اكثر الصور مطالعة',
	'toprated_lnk' => 'اعلى الصور تقييما',
	'search_lnk' => 'ابحث',
                'fav_lnk' => 'المفضلة',
);

$lang_gallery_admin_menu = array('upl_app_lnk' => 'الموافقة على التحميل',
	'config_lnk' => 'تعيير',
	'albums_lnk' => 'الالبومات',
	'categories_lnk' => 'التصنيفات',
	'users_lnk' => 'المستخدمين',
	'groups_lnk' => 'مجموعات',
	'comments_lnk' => 'تعليقات',
	'searchnew_lnk' => 'اضف مجموعة من الصور',
        'util_lnk' => 'تغيير قياسات الصور',
        'ban_lnk' => 'منع المستخدمين',
);

$lang_user_admin_menu = array('albmgr_lnk' => 'اخلق / افرز البوماتي',
	'modifyalb_lnk' => 'تعديل البوماتي',
	'my_prof_lnk' => 'الملف الشخصي',
);

$lang_cat_list = array('category' => 'التصنيف',
	'albums' => 'الالبومات',
	'pictures' => 'الصور',
);

$lang_album_list = array(
	'album_on_page' => '%d البوم في %d صفحة'
);

$lang_thumb_view = array('date' => 'التاريخ',
	'name' => 'اسم الملف',
        'title' => 'العنوان',
	'sort_da' => 'ترتيب تصاعدي حسب التاريخ',
	'sort_dd' => 'ترتيب تنازلي للتاريخ',
	'sort_na' => 'ترتيب تصاعدي للاسم',
	'sort_nd' => 'ترتيب تنازلي للاسم',
        'sort_ta' => 'ترتيب العنوان تصاعدي',
        'sort_td' => 'ترتيب العنوان تنازلي',
	'pic_on_page' => '%d صورة في %d صفحة/صفحات',
	'user_on_page' => '%d مستخدم في %d صفحة',
    'sort_ra' => 'ترتيب التقييم تصاعديا', // new in cpg1.2.0nuke
    'sort_rd' => 'ترتيب التقييم تنازليا', // new in cpg1.2.0nuke
    'rating' => 'التقييم', // new in cpg1.2.0nuke
    'sort_title' => 'ترتيب الصور حسب:', // new in cpg1.2.0nuke
);

$lang_img_nav_bar = array('thumb_title' => 'الرجوع الى المختصرات',
	'pic_info_title' => 'اظهر/اخفي معلومات الصور',
	'slideshow_title' => 'عرض آلي',
    'slideshow_disabled' => 'البطاقات الالكترونية معطلة', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
	'ecard_title' => 'ارسل الصورة كبريد',
	'ecard_disabled' => 'الصور البريدة معطلة',
	'ecard_disabled_msg' => 'ليس لديك الصلاحية لارسال صور بريدية',
	'prev_title' => 'الصورة السابقة',
	'next_title' => 'الصورة التي تليهـا',
	'pic_pos' => 'صـوره %s/%s',
    'no_more_images' => 'لا توجد صور اضافية في المعرض', // new in cpg1.2.0nuke
    'no_less_images' => 'هذه هي اول صورة في المعرض', // new in cpg1.2.0nuke
);

$lang_rate_pic = array('rate_this_pic' => 'قيـم هذه الصورة',
	'no_votes' => '(لا يوجد تصويت)',
	'rating' => '(التصويت الحالي: %s / 5 من %s تصويت)',
	'rubbish' => 'سيـئة',
	'poor' => 'غير مقبولة',
	'fair' => 'مقبولة',
	'good' => 'جيـدة',
	'excellent' => 'ممتـازة',
	'great' => 'مذهلـة',
);
// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //
$lang_cpg_die = array(INFORMATION => $lang_info,
    ERROR => $lang_error,
	CRITICAL_ERROR => 'خطأ خطير',
	'file' => 'ملف: ',
	'line' => 'السطر: ',
);

$lang_display_thumbnails = array('filename' => 'اسم الملف : ',
	'filesize' => 'الحجم : ',
	'dimensions' => 'الابعاد : ',
	'date_added' => 'اضيف في : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s تعليق',
	'n_views' => '%s مشاهدة',
	'n_votes' => '(%s تصويت)'
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
	'Exclamation' => 'تعجب',
	'Question' => 'استفهام',
	'Very Happy' => 'سعيد جدا',
	'Smile' => 'ابتسامة',
	'Sad' => 'حزين',
	'Surprised' => 'تعجب',
	'Shocked' => 'مدهوش',
	'Confused' => 'مرتبك',
	'Cool' => 'عجيب',
	'Laughing' => 'يضحك',
	'Mad' => 'غاضب',
        'Razz' => 'Razz',
	'Embarassed' => 'محرج',
	'Crying or Very sad' => 'يبكي أو حزين جدا',
	'Evil or Very Mad' => 'شيطاني أو غاضب جدا',
        'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'عيون حائرة',
	'Wink' => 'يغمز',
	'Idea' => 'فكرة',
	'Arrow' => 'سهم',
	'Neutral' => 'عادي',
        'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'انت الآن تترك حالة الادارة...',
	1 => 'انت الآن تدخل حالة الادارة...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'الألبوم بحاجة الى إسـم !',
	'confirm_modifs' => 'هل أنت متأكّد أنّك تريد عمل هذه التّعديلات  ?',
	'no_change' => 'لم تقم بأي تغيير !',
	'new_album' => 'البـوم جديد',
	'confirm_delete1' => 'هل أنت متأكد للأغاء هذا الألبوم ?',
	'confirm_delete2' => '\nسوف يتم حذف الصور و الملاحظات !',
	'select_first' => 'ادخل اسم الألبوم أولاً',
	'alb_mrg' => 'التحكم بالألبوم',
	'my_gallery' => '* معرضـي *',
	'no_category' => '* المعرض غير موجود *',
	'delete' => 'الغـاء',
	'new' => 'جديد',
	'apply_modifs' => 'استعمل التّعديلات ',
	'select_category' => 'الصّنف المختار ',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'المعلومات المطلوبة للعملية \'%s\'لم تعطى !',
	'unknown_cat' => 'التصنيف المختار غير معروف',
	'usergal_cat_ro' => 'لايسمح بالغاء تصنيف المستخدمين !',
	'manage_cat' => 'ادارة التصنيفات',
	'confirm_delete' => 'هل انت متأكد من الغاء هذا التصنيف',
	'category' => 'التصنيف',
	'operations' => 'العمليات',
	'move_into' => 'انقل الى',
	'update_create' => 'تحديث أو تكوين تصنيف',
	'parent_cat' => 'التصنيف الأب',
	'cat_title' => 'عنوان التصنيف',
	'cat_desc' => 'شرح التصنيف'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'الإعـــدادت',
	'restore_cfg' => 'تجاهـل التغييرات',
	'save_cfg' => 'لحفـظ الإعدادات',
	'notes' => 'ملاحظــات',
	'info' => 'المعـلومـات',
	'upd_success' => 'لقد تم تحديث الإعـدادت',
	'restore_success' => 'تم ارجاع الاعدادات الاصلية',
	'name_a' => 'تصاعدي على الاسم',
	'name_d' => 'تنازلي على الاسم',
	'title_a' => 'تصاعدي على العنوان',
	'title_d' => 'تنازلي على العنوان',
        'date_a' => 'تاريخ تصاعدي',
        'date_d' => 'تاريخ تنازلي',
        'rating_a' => 'التقييم تصاعديا', // new in cpg1.2.0nuke
        'rating_d' => 'التقييم تنازليا', // new in cpg1.2.0nuke
        'th_any' => 'اكبر قياس',
        'th_ht' => 'الارتفاع',
        'th_wd' => 'العرض',
);
// start left side interpretation
if (defined('CONFIG_PHP')) $lang_config_data = array('اعدادات عامة',
	array('اسم المعرض', 'gallery_name', 0),
	array('شرح المعرض', 'gallery_description', 0),
	array('البريد الالكتروني لمدير المعرض', 'gallery_admin_email', 0),
	array('العنوان الهدف لوصلة \'رؤية المزيد من الصور\' في الكروت', 'ecards_more_pic_target', 0),
	array('اللغة', 'lang', 5),
// for postnuke change
	array('السمة', 'theme', 6),
        array('عناوين محددة للصفحات بدلا من >Coppermine', 'nice_titles', 1),
	'رؤية الالبوم كقائمة',
	array('عرض الجدول الرئيسي لعرض الصور (بالنقاط أو بالنسبة)', 'main_table_width', 0),
	array('عدد مستويات التصنيف التي تعرض', 'subcat_level', 0),
	array('عدد الالبومات التي تعرض', 'albums_per_page', 0),
	array('عدد الاعمدة لعرض الالبوم', 'album_list_cols', 0),
	array('قياس الاختصار بالنقاط', 'alb_list_thumb_size', 0),
	array('محتويات الصفحة الرئيسية', 'main_page_layout', 0),
            array('اعرض مختصرات البوم المستوى الاول في التصنيفات ','first_level',1),
	'عرض المختصرات',
	array('عدد الاعمدة في صفحة مختصرات الصور', 'thumbcols', 0),
	array('عدد الاسطر في صفحة مختصرات الصور', 'thumbrows', 0),
	array('اكبر عدد للصفحات التي ستعرض', 'max_tabs', 0),
	array('عرض عنوان الصور اسفل الصورة', 'caption_in_thumbview', 1),
	array('اظهر عدد التعليقات اسفل الصورة', 'display_comment_count', 1),
	array('الترتيب التقليدي للصور', 'default_sort_order', 3),
	array('اقل عدد من التصويتات لظهور الصورة في قائمة  \'اعلى تقييم\'', 'min_votes_for_rating', 0),
        array('Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
	'اعدادات منظر الصور والتعليقات',
	array('عرض الجدول لعرض الصور (بالنقاط أو بالنسبة)', 'picture_table_width', 0),
	array('معلومات الصور ترى تلقائيا', 'display_pic_info', 1),
	array('تصفية الكلمات السيئة في التعليقات (عليك تخزين تلك الكلمات في البرنامج اولا)', 'filter_bad_words', 1),
	array('السماح بالوجوه الضاحكة في التعليقات', 'enable_smilies', 1),
        array('Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array('Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
	array('اكبر طول لوصف الصورة', 'max_img_desc_length', 0),
	array('اكبر عدد من الحروف في الكلمة', 'max_com_wlength', 0),
	array('اكبر عدد من الاسطر في التعليق', 'max_com_lines', 0),
	array('اكبر طول للتعليق', 'max_com_size', 0),
        array('اظهر شريط الفلم', 'display_film_strip', 1),
        array('عدد الصور في شريط الفلم', 'max_film_strip_items', 0),
        array('Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
	'اعدادات الصور ومختصرات',
	array('وضوح صورة جي بيج', 'jpeg_qual', 0),
        array('اكبر قياس لمختصر الصورة <strong>*</strong>', 'thumb_width', 0),
        array('استعمل القياسات (عرض او ارتفاع أو اكبر تباعد لمختصر الصور )<strong>*</strong>', 'thumb_use', 7),
	array('كون صور وسيطة','make_intermediate',1),
	array('اكبر عرض او ارتفاع لصورة وسطية <strong>*</strong>', 'picture_width', 0),
	array('اكبر حجم لصورة محملة (بالكيلو بايت)', 'max_upl_size', 0),
	array('اكبر عرض او ارتفاع لصورة محملة بالنقاط', 'max_upl_width_height', 0),
	'اعدادات المستخدم',
	array('السماح لمستخدم جديد بالتسجيل', 'allow_user_registration', 1),
	array('تسجيل المستخدم يحتاج التأكيد بالبريد الالكتروني', 'reg_requires_valid_email', 1),
	array('السماح لمستخدمين اثنين ان يكون لهم نفس البريد الالكتروني', 'allow_duplicate_emails_addr', 1),
	array('يمكن للمستخدمين ان يكون لهم البوم خاص', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
	'بيانات اضافية لشرح الصور (اتركه فارغا ان كنت لا تريد استعماله)',
	array('اسم الحقل الاول', 'user_field1_name', 0),
	array('اسم الحقل الثاني', 'user_field2_name', 0),
	array('اسم الحقل الثالث', 'user_field3_name', 0),
	array('اسم الحقل الرابع', 'user_field4_name', 0),
	'اعدادات الصور ومختصرات الصور المتقدمة',
        array('اظهر رمز البوم خاص للمستخدم المجهول','show_private',1),
	array('الحروف الممنوعة في اسماء الملفات', 'forbiden_fname_char',0),
	array('الامتدادات المسموح بها في الملفات المرسلة', 'allowed_file_extensions',0),
	array('طريقة اعادة قياص الصورة','thumb_method',2),
	array('الدليل الى اداة ImageMagick / netpbm \'للتحويل\'  (مثال /usr/bin/X11/)', 'impath', 0),
	array('انواع الصور المسموح بها (يستعمل فقط لـ ImageMagick)', 'allowed_img_types',0),
	array('اوامر البرنامج ImageMagick', 'im_options', 0),
	array('اقرء بيانات EXIF في ملفات JPEG', 'read_exif_data', 1),
        array('Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
	array('دليل الالبوم <strong>*</strong>', 'fullpath', 0),
	array('دليل صور المستخدمين <strong>*</strong>', 'userpics', 0),
	array('الحروف الاولى للصور الوسيطة(يجب ان تكون انجليزية <strong>*</strong>', 'normal_pfx', 0),
	array('الحروف الاولى لمختصرات الصور <strong>*</strong>', 'thumb_pfx', 0),
	array('الوضع الاعتيادي للمجلدات', 'default_dir_mode', 0),
	array('الوضع الاعتيادي للصور', 'default_file_mode', 0),
        array('Picinfo display filename', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array('Picinfo display album name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_file_size', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_dimensions', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array('Picinfo display URL as bookmark link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array('Picinfo display fav album link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
	'اعدادات الكوكيز ونوع الحروف',
	array('اسم الكوكي المستعمل في البرنامج', 'cookie_name', 0),
	array('دليل الكوكيز المستعمل في البرنامج', 'cookie_path', 0),
	array('نوع الحروف المستعملة', 'charset', 4),
	'اعدادات اخرى',
	array('تمكين وضع التتبع', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2

        '<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
);
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'يجب ان تكتب اسمك وتعليقك',
	'com_added' => 'تم اضافة التعليق',
	'alb_need_title' => 'يجب ان تحدد عنوان للالبوم !',
	'no_udp_needed' => 'لا حاجة للتحديث.',
	'alb_updated' => 'تم تحديث الالبوم',
	'unknown_album' => 'الالبوم المختار غير موجود او ليس لك الصلاحية للتحميل في هذا الالبوم',
	'no_pic_uploaded' => 'لا توجد صور محملة !<br /><br />اذا كنت فعلا اخترت صور للتحميل, تأكد من ان خادم الصفحات يسمح بالتحميل...',
	'err_mkdir' => 'لم استطع تكوين المجلد %s !',
	'dest_dir_ro' => 'وجهة الملف %s غير قابل للكتابة !',
	'err_move' => 'من المستحيل نقل %s الى %s !',
	'err_fsize_too_large' => 'الصور التي تريد تحميلها كبيرة جدا (اكبر حجم للصورة هو %s x %s) !',
	'err_imgsize_too_large' => 'الصور التي تريد تحميلها كبيرة جدا (اكبر حجم للصورة هو %s KB) !',
	'err_invalid_img' => 'الصورة التي تم تحميلها غير صالحة !',
	'allowed_img_types' => 'تستطيع تحميل %s صورة.',
	'err_insert_pic' => 'الصورة \'%s\' لا يمكن تخزيها في الالبوم ',
	'upload_success' => 'تمم تحميل الصورة بنجاح<br /><br />سوف تراها بعد موافقة المدير.',
	'info' => 'معلومات',
	'com_added' => 'تم اضافة التعليق',
	'alb_updated' => 'تم تحديث الالبوم',
	'err_comment_empty' => 'لم تكتب التعليق !',
	'err_invalid_fext' => 'سوف يسمح بالملفات التي تنتهي بـ : <br /><br />%s.',
	'no_flood' => 'نأسف لكنك انت كنت آخر معلق على هذه الصورة<br /><br />تستطيع تغيير تعليقك على الصورة',
	'redirect_msg' => 'سيتم تحوليك الى صفحة اخرى.<br /><br /><br />اضغط على  \'استمــر\' ان لم يتم اعادة تنشيط الصفحة تلقائيا',
	'upl_success' => 'تم تحميل الصورة بنجاح',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'العنوان',
	'fs_pic' => 'صورة بالحجم الطبيعي',
	'del_success' => 'تم الغاءها بنجاح',
	'ns_pic' => 'صورة بالحجم الطبيعي',
	'err_del' => 'لا يمكن الغاءه',
	'thumb_pic' => 'مختصر',
	'comment' => 'تعليق',
	'im_in_alb' => 'صورة في الالبوم',
	'alb_del_success' => 'الالبوم \'%s\' تم الغاءه',
	'alb_mgr' => 'مدير الالبوم',
	'err_invalid_data' => 'بيانات غير صالحة تم استقبالها في \'%s\'',
	'create_alb' => 'جاري تكوين الالبوم \'%s\'',
	'update_alb' => 'جاري تحديث الالبوم \'%s\' بالعنوان \'%s\' والفهرس \'%s\'',
	'del_pic' => 'الغاء الصورة',
	'del_alb' => 'الغي الالبوم',
	'del_user' => 'الغي المستخدم',
	'err_unknown_user' => 'المستخدم المختار غير موجود !',
	'comment_deleted' => 'تم الغاء التعليق بنجاح',
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
	'confirm_del' => 'هل أنت متأكد لإلغاء الصورة ? \\nسيتم الغاء التعليقات ايضا.',
	'del_pic' => 'أضغط لمسـح هذه الصورة',
	'size' => '%s في %s نقطة',
	'views' => '%s مـرات',
	'slideshow' => 'عرض الشرائح',
	'stop_slideshow' => 'لتوقيف عرض الشرائح',
	'view_fs' => 'اضغط لتكبيـر الصورة',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
);

$lang_picinfo = array(
	'title' =>'معلومات عن الصورة',
	'Filename' => 'اسم الملف',
	'Album name' => 'اسم الألبوم',
	'Rating' => 'تقييم (%s تصويت)',
	'Keywords' => 'الكلمات الرّئيسيّة ',
	'File Size' => 'حجم الملف',
	'Dimensions' => 'الأبعاد ',
	'Displayed' => 'عدد مرات الإضهار',
	'Camera' => 'آلة التصوير',
	'Date taken' => 'تاريخ التقاط الصورة',
	'Aperture' => 'العدسة ',
	'Exposure time' => 'وقت التّعرّض ',
	'Focal length' => 'البعد البؤريّ ',
	'Comment' => 'ملاحظات',
        'addFav'=>'اضف الى المفضلة',
        'addFavPhrase'=>'المفضلة',
        'remFav'=>'الغ من المفضلة',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
);

$lang_display_comments = array(
	'OK' => 'حسنـا',
	'edit_title' => 'لتحـرير الملاحظات',
	'confirm_delete' => 'هل أنت متأكـد لحـذف هذه الملاحظات ?',
	'add_your_comment' => 'أدخـل ملاحظاتك',
        'name'=>'الاسم',
        'comment'=>'تعليق',
        'your_name' => 'مجهول',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'اضغط على الصورة لاغلاق النافذة',
);
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'ارسال كرت معايدة',
	'invalid_email' => '<strong>تنبـيه</strong> : البريد الالكتروني خطأ !',
	'ecard_title' => 'كرت من  %s لك',
	'view_ecard' => 'ان لم يظهر الكرت بالصورة الصحيحة, اضغط هنا',
	'view_more_pics' => 'اضغط هنا لرؤية المزيد من الصور !',
	'send_success' => 'تم ارسال كرتك',
	'send_failed' => 'نأسف لكن الخادم لا يستطيع ارسال الكرت...',
	'from' => 'من',
	'your_name' => 'اسمك',
	'your_email' => 'البريد الألكتروني',
	'to' => 'الى',
	'rcpt_name' => 'اسم المرسل اليه',
	'rcpt_email' => 'بريد المرسل اليه الالكتروني',
	'greetings' => 'التحية',
	'message' => 'الرسالة',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'معلومات الصورة',
	'album' => 'البوم',
	'title' => 'عنوان الصورة',
	'desc' => 'بيان عن الصورة',
	'keywords' => 'الكلمات الرّئيسيّة ',
	'pic_info_str' => '%sx%s - %sكيلوبايت - %s مشاهدة - %s تصويتات',
	'approve' => 'اعتمد الصورة',
	'postpone_app' => 'تأجيل الموافقة',
	'del_pic' => 'الغاء الصورة',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
	'reset_view_count' => 'مسح العداد',
	'reset_votes' => 'الغاء التصويت',
	'del_comm' => 'مسح الملاحظات',
	'upl_approval' => 'موافقة التحميل',
	'edit_pics' => 'تحـرير الصور',
	'see_next' => 'الصور التاليـة',
	'see_prev' => 'الصور السابقة',
	'n_pic' => '%s الصـور',
	'n_of_pic_to_disp' => 'عدد الصور المعروضة',
	'apply' => 'تطبيق التعديل'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'اسم المجموعة',
	'disk_quota' => 'مساحة التخزين المسموحة',
	'can_rate' => 'لا استطيع تقييم الصور',
	'can_send_ecards' => 'يستطيع ارسال الصورة كبريد',
	'can_post_com' => 'يستطيع اضافة تعليقات',
	'can_upload' => 'يستطيع تحميل الصور',
	'can_have_gallery' => 'يستطيع الحصول على معرض شخصي',
	'apply' => 'تخزين التعديلات',
	'create_new_group' => 'تكوين مجموعة مستخدمين جديدة',
	'del_groups' => 'الغاء المجموعات المختارة',
	'confirm_del' => 'تحذير, عندما تمسح مجموعة, سيتم نقل المستخدمين في هذه المجموعة الى قائمة \'المسجلين\' !\n\nهل تود استكمال العملية  ?',
	'title' => 'ادارة مجموعات المستخدمين',
	'approval_1' => 'موافقة تحميل عامة (1)',
	'approval_2' => 'موافقة تحميل عامة (2)',
	'note1' => '<strong>(1)</strong> التحميل في الالبوم العام يحتاج موافقة المدير',
	'note2' => '<strong>(2)</strong> التحميلات التي يمكلها المستخدم تحتاج موافقة المدير',
	'notes' => 'ملاحظات'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){
$lang_index_php = array(
	'welcome' => 'أهـلاً وسـهلاً بك يـا',
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'هل أنت متأكد لألغاء هذه الصورة ? \\nAll pictures and comments will also be deleted.',
	'delete' => 'الغاء الصورة',
	'modify' => 'تحديث الألبوم',
	'edit_pics' => 'تحرير الصورة',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<strong>[pictures]</strong> صورة في <strong>[albums]</strong> البوم و <strong>[cat]</strong> تصنيفات مع <strong>[comments]</strong> تعليقات شوهدت <strong>[views]</strong> مرة',
	'stat2' => '<strong>[pictures]</strong> صورة في <strong>[albums]</strong> البوم وشوهدت <strong>[views]</strong> مرة',
	'xx_s_gallery' => 'معرض %s',
	'stat3' => '<strong>[pictures]</strong> صورة في <strong>[albums]</strong> البوم مع <strong>[comments]</strong> تعليقات شوهدت <strong>[views]</strong> مرة'
);

$lang_list_users = array(
	'user_list' => 'قائمة المستخدمين',
	'no_user_gal' => 'لا يوجد مستخدمين يمكن ان يكون لهم البومات',
	'n_albums' => '%s البوم',
	'n_pics' => '%s صورة/صور'
);

$lang_list_albums = array(
	'n_pictures' => '%s صورة',
	'last_added' => ', آخر صورة اضيفت في %s'
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
	'upd_alb_n' => 'تحديث الالبوم %s',
	'general_settings' => 'اعدادات عامة',
	'alb_title' => 'عنوان الالبوم',
	'alb_cat' => 'تصنيف الالبوم',
	'alb_desc' => 'شرح الالبوم',
	'alb_thumb' => 'نبذة الالبوم',
	'alb_perm' => 'صلاحيات الالبوم',
	'can_view' => 'مشاهدين الالبوم هم',
	'can_upload' => 'الزوار يستطيعون تحميل صور',
	'can_post_comments' => 'الزوار يستطيعون تسجيل تعليقات',
	'can_rate' => 'الزوار يستطيعون التقييم',
	'user_gal' => 'البوم المستخدمين',
	'no_cat' => '* غير مصنف *',
	'alb_empty' => 'الالبوم فارغ',
	'last_uploaded' => 'آخر تحميل',
	'public_alb' => 'للجميع (البوم عام)',
	'me_only' => 'لي فقط',
	'owner_only' => 'مالك الالبوم (%s) فقط',
	'groupp_only' => 'اعضاء المجموعة \'%s\'',
	'err_no_alb_to_modify' => 'لا يوجد البوم تستطيع تعديله في قاعدة البيانات.',
	'update' => 'تحديث الالبوم'
);
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'نأسف لكن كنت قد قيمت هذه الصورة مسبقا',
	'rate_ok' => 'تم قبول تقييمك',
);
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
$lang_register_disclamer = <<<EOT
حيث ان مدراء الموقع {SITE_NAME} سيقومون بتعديل او الغاء الصور الغير مرغوب فيها, فمن الصعب مراجعة جميع الصور. لذا يجب عليك العلم ان الصور تمثل اصحابها فقط وليس لها علاقة بالمدراء أو مسؤولين الصفحة (الى اذا قامو هم بذلك) وبالتالي لن يتحملو مسؤولية تلك الصور.<br />
<br />
انت توافق انك لن تقوم بتحميل اي صور مرفوضة, وقحة, خارجة عن اللياقة العامة, تقذف الغير, كراهية, تهدد الغير, جنسية أو اي صور خارجة عن نطاق القانون. انت توافق ان مسؤول الصفحة, المدير والمشرفين في الموقع {SITE_NAME} لهم الحق في تعديل وازالة اي محتوى في اي وقت يرونه مناسبا. وكما توافق ان تكون البيانات التي تدخلها سوف تخزن في قاعدة بيانات. وحيث ان هذه المعلومات لن تعلن لشخص ثالث دون مواققتك لن يتحمل المسؤول او مدير الموقع اي دخول تخريبي على الموقع يتم به معرفة هذه المعلومات.<br />
<br />
هذا الموقع يستعمل الكوكيز لتخزين المعلومات على جهازك. هذه الكوكيز تحسن من اطلاعك على الصور فقط. ويستعمل البريد الالكتروني لتأكيد عملية تسجيلك وكلمة السر.<br />
<br />
بالضغط على زر 'اوافق' ان توافق وتلزم بهذه الشروط.
EOT;

$lang_register_php = array(
	'page_title' => 'تسجيل المستخدم',
	'term_cond' => 'الشروط والقواعد',
	'i_agree' => 'اوافق',
	'submit' => 'تسجيل الطلب',
	'err_user_exists' => 'الاسم الذي ادخلته موجود مسبقا, الرجاء استخدام اسم آخر',
	'err_password_mismatch' => 'كلمتي السر لا ينطبقان، عليك ادخالهما مرة اخرى',
	'err_uname_short' => 'يجب ان تكون الكنية على الاقل حرفين',
	'err_password_short' => 'يجب ان تكون كلمة السر على الاقل حرفين',
	'err_uname_pass_diff' => 'يجب ان تكون الكنية مختلفة عن كلمة السر',
	'err_invalid_email' => 'البريد الالكتروني الذي كتبته لا يعمل',
	'err_duplicate_email' => 'مستخدم آخر مسجل له نفص البريد الالكتروني',
	'enter_info' => 'ادخل بيانات التسجيل',
	'required_info' => 'معلومات مطلوبة',
	'optional_info' => 'معلومات اضافية',
	'username' => 'الكنية',
	'password' => 'كلمة السر',
	'password_again' => 'اعد ادخال كلمة السر',
	'email' => 'البريد الالكتروني',
	'location' => 'المكان',
	'interests' => 'الاهتمامات',
	'website' => 'صفحتك',
	'occupation' => 'الوظيفة',
	'error' => 'خطأ',
	'confirm_email_subject' => '%s - تأكيد التسجيل',
	'information' => 'بيانات',
	'failed_sending_email' => 'لم استطيع ارسال رسالة تأكيد التسجيل !',
	'thank_you' => 'شكرا على التسجيل.<br /><br />تم ارسال بريد يوضح كيفية تفعيل الاشتراك.',
	'acct_created' => 'تم تكوين اشتراكك وتستطيع الدخول بكنيتك وكلمة السر',
	'acct_active' => 'اشتراكك فعال الآن وتستطيع الدخول بكنيتك وكلمة السر',
	'acct_already_act' => 'اشتراكك فعال مسبقا !',
	'acct_act_failed' => 'لا يمكن تفعيل هذا الحساب !',
	'err_unk_user' => 'المستخدم المختار غير موجود !',
	'x_s_profile' => 'بيانات %s',
	'group' => 'المجموعة',
	'reg_date' => 'مشارك',
	'disk_usage' => 'استهلاك التخزين',
	'change_pass' => 'تغيير كلمة السر',
	'current_pass' => 'كلمة السر الحالية',
	'new_pass' => 'كلمة سر جديدة',
	'new_pass_again' => 'كلمة السر الجديدة مرة اخرى',
	'err_curr_pass' => 'كلمة السر الحالية غير صحيحة',
	'apply_modif' => 'تطبيق التغييرات',
	'change_pass' => 'غير كلمة السر',
	'update_success' => 'تم تحديث بياناتك',
	'pass_chg_success' => 'تم تغيير كلمة السر',
	'pass_chg_error' => 'لم تتغير كلمة السر',
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

لتفعيل الحساب عليك الضغط على الوصلة بالاسفل
او انسخ والصق الوصلة في متصفح الانترنت لديك.

{ACT_LINK}

Regards,

The management of {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'مراجعة التعليقات',
	'no_comment' => 'لا تعليقات للمراجعة',
	'n_comm_del' => '%s تعليق الغي',
	'n_comm_disp' => 'عدد التعليقات المعروضة',
	'see_prev' => 'السابق',
	'see_next' => 'التالي',
	'del_comm' => 'الغاء التعليقات المختارة',
);
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ابحث مجموعة الصور',
);
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'ابحث الصور الجديدة',
	'select_dir' => 'اختر مجلد',
	'select_dir_msg' => 'هذه العملية تمكنك من اضافة كمية من الصور تم تحميلها بواسطة FTP الى خادم الصفحات لديك.<br /><br />اختر الدليل حيث قمت بعملية التحميل مسبقا',
	'no_pic_to_add' => 'لا توجد صورة اضيفها',
	'need_one_album' => 'تحتاج على الاقل البوما واحدا لهذه العملية',
	'warning' => 'تحذير',
	'change_perm' => 'لا يستطيع البرنامج التخزين في هذا الدليل, تحتاج تغيير صلاحيات الدليل الى 755 او 777 قبل اضافة الصور !',
	'target_album' => '<strong>ضع صور &quot;</strong>%s<strong>&quot; في </strong>%s',
	'folder' => 'مجلد',
	'image' => 'صورة',
	'album' => 'البوم',
	'result' => 'نتيجة',
	'dir_ro' => 'غير قابل للتخزين. ',
	'dir_cant_read' => 'غير قابل للقراءة. ',
	'insert' => 'اضافة صور جديدة للمعرض',
	'list_new_pic' => 'قائمة الصور الجديدة',
	'insert_selected' => 'تخزين الصور المختارة',
	'no_pic_found' => 'لا توجد صور جديدة',
	'be_patient' => 'الرجاء الصبر، حيث يحتاج البرنامج لبعض من الوقت لاضافة الصور',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : يعني انه تم اضافة الصور بنجاح'.
				'<li><strong>DP</strong> : يعني ان الصورة مكررة في قاعدة البيانات وهي موجودة فعلا'.
				'<li><strong>PB</strong> : تعني انني لم اتمكن من اضافة الصورة, تأكد من الاعدادات ومن صلاحياتك في تخزين الصورة في هذا المجلد'.
				'<li>اذا كان الرمز OK, DP, PB لا يظهر اضغط على الوصلة المكسورة لمعرفة سبب عدم ظهورها PHP'.
				'<li>ان لم يرد على المتصفح بعد وقت كاف, اضغط على زر اعادة تحميل الصفحة'.
				'</ul>',
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

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'تحميل صورة',
	'max_fsize' => 'اكبر حجم لملف الصورة هو %s كيلو بايت',
	'album' => 'البوم',
	'picture' => 'صورة',
	'pic_title' => 'عنوان صورة',
	'description' => 'شرح الصورة',
	'keywords' => 'كلمات بحث (افصل بينهما بمسافة)',
	'err_no_alb_uploadables' => 'نأسف لكن لا يوجد البوم تستطيع تحميل الصور اليه',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ادارة المستخدمين',
	'name_a' => 'تصاعدي حسب الاسم',
	'name_d' => 'تنازلي حسب الاسم',
	'group_a' => 'تصاعدي حسب المجموعة',
	'group_d' => 'تنازلي حسب المجموعة',
	'reg_a' => 'تصاعدي حسب تاريخ التسجيل',
	'reg_d' => 'تنازلي حسب تاريخ التسجيل',
	'pic_a' => 'تصاعدي حسب عد الصور',
	'pic_d' => 'تنازلي حسب عد الصور',
	'disku_a' => 'تصاعدي حسب مساحة التخزين',
	'disku_d' => 'تنازلي حسب مساحة التخزين',
	'sort_by' => 'رتب المستخدمين حسب',
	'err_no_users' => 'جدول المستخدم فارغ !',
	'err_edit_self' => 'لا تستطيع تعديل بياناتك الخاصة, استعمل زر \'بياناتي\' لذلك',
	'edit' => 'تعديل',
	'delete' => 'الغاء',
	'name' => 'اسم المستخدم',
	'group' => 'المجموعة',
	'inactive' => 'معطل',
	'operations' => 'العمليات',
	'pictures' => 'الصور',
	'disk_space' => 'مساحة التخزين المسموحة / كوتا',
	'registered_on' => 'تم تسجيله في',
	'u_user_on_p_pages' => '%d مستخدم في %d صفحة/صفحات',
	'confirm_del' => 'هل انت متأكد من الغاء هذا المستخدم ? \\nكل صوره والبوماته سوف تلغى.',
	'mail' => 'بريد',
	'err_unknown_user' => 'المستخدم المختار غير موجود !',
	'modify_user' => 'تغيير المستخدم',
	'notes' => 'ملاحظات',
	'note_list' => '<li>ان لم تريد تغيير كلمة السر, اترك مربع كلمة السر فارغا',
	'password' => 'كلمة السر',
	'user_active_cp' => 'المستخدم معطل',
	'user_group_cp' => 'مجموعة المستخدمين',
	'user_email' => 'بريد المستخدم',
	'user_web_site' => 'صفحة المستخدم',
	'create_new_user' => 'تكوين مستخدم جديد',
	'user_from' => 'موقع المستخدم',
	'user_interests' => 'اهتمامات المتسخدم',
	'user_occ' => 'وظيفة المستخدم',
);
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'تغيير قياص الصورة',
        'what_it_does' => 'ماذا تعمل',
        'what_update_titles' => 'تحديث العناوين من اسماء الملفات',
        'what_delete_title' => 'الغاء العناوين',
        'what_rebuild' => 'يعبد بناء مختصرات الصور ويعيد قياس الصور',
        'what_delete_originals' => 'يلغي الصور المعاد قياسها الاصلية و يستبدلهم بصور معاد قياسها',
        'file' => 'ملف',
        'title_set_to' => 'العنوان محدد الى',
        'submit_form' => 'سجل',
        'updated_succesfully' => 'تم تحديثه بنجاح',
        'error_create' => 'خطأ في تكوين',
        'continue' => 'معالجة المزيد من الصور',
        'main_success' => 'الملف %s تم استعماله كالصورة الرئيسية',
        'error_rename' => 'خطأ في تغيير الاسم %s الى %s',
        'error_not_found' => 'الملف %s غير موجود',
        'back' => 'الرجوع الى الرئيسية',
        'thumbs_wait' => 'تحديث مختصرات الصور و/او الصور المعاد قياسها, الرجاء الانتظار...',
        'thumbs_continue_wait' => 'مستمر في تحديث مختصرات الصور او/و الصور المعاد قياسها...',
        'titles_wait' => 'تحديث العناوين, الرجاء الانتظار...',
        'delete_wait' => 'الغاء العناوين, الرجاء الانتظار...',
        'replace_wait' => 'يتم الغاء الصور الاصلية ويتم استبداله باخرى معاد قياسها, الرجاء الانتظار..',
        'instruction' => 'تعليمات سريعة',
        'instruction_action' => 'اختار عملية',
        'instruction_parameter' => 'تحديد المتغيرات',
        'instruction_album' => 'اختر الالبوم',
        'instruction_press' => 'اضغط على %s',
        'update' => 'تحديث المختصرات و/أو اعادة تقييس الصور',
        'update_what' => 'ماذا يجب تحديثه',
        'update_thumb' => 'مختصرات الصور فقط',
        'update_pic' => 'الصور المعاد قياسها فقط',
        'update_both' => 'الصور المختصرة والمعاد قياسها معا',
        'update_number' => 'عدد الصور المعالجة بالضغطة',
        'update_option' => '(حال التقليل من هذا الاعداد ان واجهت مشاكل انتهاء الوقت)',
        'filename_title' => 'اسم الملف &rArr; عنوان الصورة',
        'filename_how' => 'كيفية تغيير اسم الملف',
        'filename_remove' => 'ازالة نهاية .jpg و استبدال _ (شرطة سفلية) بالمسافات',
        'filename_euro' => 'غير 2003_11_23_13_20_20.jpg الى 23/11/2003 13:20',
        'filename_us' => 'يغير  2003_11_23_13_20_20.jpg الى  11/23/2003 13:20',
        'filename_time' => 'يغير  2003_11_23_13_20_20.jpg الى 13:20',
        'delete' => 'يلغي عناوين الصور او صور القياس الاصلية',
        'delete_title' => 'الغي عناوين الصور',
        'delete_original' => 'الغي صور القياس الاصلية',
        'delete_replace' => 'يلغي الصور الاصلية ويستبدلهم باخرى بقياس مختلف',
        'select_album' => 'اختار الالبوم',
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