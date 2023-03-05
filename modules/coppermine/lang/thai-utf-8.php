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
define('PIC_VIEWS', 'ครั้ง');
define('PIC_VOTES', 'โหวต');
define('PIC_COMMENTS', 'คำวิจารณ์');

$lang_translation_info = array('lang_name_english' => 'English', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Thai', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'th', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'CenturY', // the name of the translator - can be a nickname
    'trans_email' => 'century_100@hotmail.com', // translator's email address (optional)
    'trans_website' => 'http://mem9.dochost.net/', // translator's website (optional)
    'trans_date' => '2003-12-10', // the date the translation was created / last modified
    );

$lang_charset = 'UTF-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('ไบต์', 'กิโลไบต์', 'เมกกะไบต์');

// Day of weeks and months
$lang_day_of_week = array('อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.');
$lang_month = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');

// Some common strings
$lang_yes = 'ใช่';
$lang_no  = 'ไม่';
$lang_back = 'กลับ';
$lang_continue = 'ต่อไป';
$lang_info = 'รายละเอียด';
$lang_error = 'ผิดพลาด';

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
    'random' => 'ภาพแบบสุ่ม',
    'lastup' => 'ส่งภาพล่าสุด',
    'lastupby' => 'ภาพล่าสุดของฉัน', // new 1.2.2
    'lastalb' => 'อัลบั้มปรับปรุงล่าสุด',// new 1.2.2
    'lastcom' => 'วิจารณ์ล่าสุด',
    'lastcomby' => 'คำวิจารณ์ล่าสุดของฉัน', // new 1.2.2
    'topn' => 'เข้าชมมากสุด',
    'toprated' => 'อันดับสูงสุด',
    'lasthits' => 'เข้าชมล่าสุด',
    'search' => 'ผลการค้นหา',
    'favpics' => 'ภาพที่โปรดปราน', // changed in cpg1.2.0nuke
    );

$lang_errors = array(
    'access_denied' => 'คุณไม่ได้รับอนุญาตให้เข้ามายังส่วนนี้',
    'perm_denied' => 'คุณไม่สามารถกระทำการได้',
    'param_missing' => 'Script ทำงานโดยปราศจากตัวแปรที่จำเป็น',
    'non_exist_ap' => ' ไม่มี อัลบั้ม/ภาพ ที่ท่านเลือก !',
    'quota_exceeded' => 'ใช้พื้นที่เกินกำหนด<br /><br />คุณได้รับพื้นที่ [quota] กิโลไบต์  ขณะนี้คุณใช้พื้นที่ [space] กิโลไบต์, การเพิ่มรูปจะทำให้คุณใช้พื้นที่เกินกำหนด',
    'gd_file_type_err' => 'เมื่อใช้งาน GD image library สามารถใช้งานภาพในแบบ JPEG และ PNG เท่านั้น',
    'invalid_image' => 'ภาพที่คุณส่งขึ้นไปมีปัญหาหรือไม่สามารถจัดการด้วย GD library',
    'resize_failed' => 'ไม่สามารถสร้าง thumbnail หรือลดขนาดภาพได้',
    'no_img_to_display' => 'ไม่มีภาพที่จะแสดง',
    'non_exist_cat' => 'ไม่มีหมวดหมู่ที่เลือก',
    'orphan_cat' => 'หมวดหมู่มีปัญหา กรุณาจัดการผ่านระบบการจัดการภาพ',
    'directory_ro' => 'ไม่สามารถเขียน Directory \'%s\' ได้ ไม่สามารถลบภาพได้',
    'non_exist_comment' => 'ไม่มีคำวิจารณ์ที่เลือก',
    'pic_in_invalid_album' => 'ไม่มีภาพในอัลบั้ม (%s)!?',
    'banned' => 'คุณถูกห้ามเข้าชมเวบไซต์นี้',
    'not_with_udb' => 'ไม่สามารถใช้งานฟังก์ชันนี้ได้ใน coppermine เนื่องจากได้ถูกรวมกับระบบกระดานข่าว หรือค่าระบบไม่รองรับความสามารถนี้ หรือระบบกระดานข่าวไม่สามารถจัดการความสามารถนี้ได้',
    'members_only' => 'ความสามารถนี้ใช้ได้เฉพาะสมาชิกเท่านั้น กรุณาสมัครสมาชิกก่อน', // changed in cpg1.2.0nuke
    'mustbe_god' => 'ความสามารถนี้ใช้ได้เฉพาะผู้ดูแลเท่านั้น คุณจะต้องเข้าสู่ระบบในฐานะผู้ดูแล จึงจะสามารถใช้งานได้'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array(
    'alb_list_title' => 'ไปยังรายการอัลบั้ม',
    'alb_list_lnk' => 'รายการอัลบั้ม',
    'my_gal_title' => 'ไปยังแกลอรีส่วนตัว',
    'my_gal_lnk' => 'แกลอรีส่วนตัว',
    'my_prof_lnk' => 'ข้อมูลส่วนตัว',
    'adm_mode_title' => 'เปลี่ยนเป็นสถานะผู้ดูแล',
    'adm_mode_lnk' => 'สถานะผู้ดูแล',
    'usr_mode_title' => 'เปลี่ยนเป็นสถานะผู้ใช้งาน',
    'usr_mode_lnk' => 'สถานะผู้ใช้',
    'upload_pic_title' => 'ส่งภาพภาพสู่อัลบั้ม',
    'upload_pic_lnk' => 'ส่งภาพ',
    'register_title' => 'สร้างรายชื่อผู้ใช้',
    'register_lnk' => 'ลงทะเบียน',
    'login_lnk' => 'เข้าสู่ระบบ',
    'logout_lnk' => 'ออกจากระบบ',
    'lastup_lnk' => 'ส่งภาพล่าสุด',
    'lastcom_lnk' => 'วิจารณ์ล่าสุด',
    'topn_lnk' => 'เข้าชมมากสุด',
    'toprated_lnk' => 'อันดับสูงสุด',
    'search_lnk' => 'ค้นหา',
    'fav_lnk' => 'ภาพที่โปรดปราน',
    );

$lang_gallery_admin_menu = array(
    'upl_app_lnk' => 'ตรวจสอบการส่งภาพ ',
    'config_lnk' => 'กำหนดค่า',
    'albums_lnk' => 'อัลบั้ม',
    'categories_lnk' => 'หมวดหมู่',
    'users_lnk' => 'ผู้ใช้งาน',
    'groups_lnk' => 'กลุ่ม',
    'comments_lnk' => 'คำวิจารณ์',  // changed in cpg1.2.0nuke
    'searchnew_lnk' => 'เพิ่มภาพต่อเนื่อง',
    'util_lnk' => 'ปรับขนาดภาพ', //not used yet
    'ban_lnk' => 'ห้ามผู้ใช้',
    );

$lang_user_admin_menu = array(
    'albmgr_lnk' => 'สร้างอัลบั้ม',
    'modifyalb_lnk' => 'แก้ไขอัลบั้ม',
    'my_prof_lnk' => 'ข้อมูลส่วนตัว',
    );

$lang_cat_list = array(
    'category' => 'หมวดหมู่',
    'albums' => 'อัลบั้ม',
    'pictures' => 'ภาพ',
    );

$lang_album_list = array(
    'album_on_page' => '%d อัลบั้ม จำนวน %d หน้า'
    );

$lang_thumb_view = array(
    'date' => 'วันที่',
    'name' => 'ชื่อ',
    'sort_da' => 'เรียงตามวัน จากน้อยไปมาก',
    'sort_dd' => 'เรียงตามวัน จากมากไปน้อย',
    'sort_na' => 'เรียงตามชื่อ จากน้อยไปมาก',
    'sort_nd' => 'เรียงตามชื่อ จากมากไปน้อย',
    'sort_ta' => 'เรียงตามหัวเรื่อง จากน้อยไปมาก',
    'sort_td' => 'เรียงตามหัวเรื่อง จากมากไปน้อย',
    'pic_on_page' => '%d ภาพ จำนวน %d หน้า',
    'user_on_page' => '%d ผู้ใช้งาน จำนวน %d หน้า',
    'sort_ra' => 'เรียงตามอันดับ จากน้อยไปมาก', // new in cpg1.2.0nuke
    'sort_rd' => 'เรียงตามอันดับ จากมากไปน้อย', // new in cpg1.2.0nuke
    'rating' => 'จัดอันดับ', // new in cpg1.2.0nuke
    'sort_title' => 'เรียงภาพโดย:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array(
    'thumb_title' => 'กลับไปยังหน้าแสดงภาพย่อ ',
    'pic_info_title' => 'แสดง/ซ่อน รายละเอียดของภาพ',
    'slideshow_title' => 'แสดงสไลด์',
    'slideshow_disabled' => 'ไม่สามารถใช้งาน e-cards ได้', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'ส่งภาพแบบ e-card',
    'ecard_disabled' => 'ไม่สามารถใช้งาน e-cards ได้ ',
    'ecard_disabled_msg' => 'คุณไม่สามารถส่ง ecards ได้',
    'prev_title' => 'ภาพก่อนหน้า',
    'next_title' => 'ภาพถัดไป',
    'pic_pos' => 'ภาพ %s/%s',
    'no_more_images' => 'ไม่มีภาพเพิ่มเติมอีกแล้ว', // new in cpg1.2.0nuke
    'no_less_images' => 'ภาพนี้ เป็นภาพแรกในแกลอรี', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array(
    'rate_this_pic' => 'ให้คะแนน ',
    'no_votes' => '(ยังไม่มีการโหวต)',
    'rating' => '(คะแนน : %s / 5 จาก %s โหวต)',
    'rubbish' => 'แย่มาก',
    'poor' => 'แย่',
    'fair' => 'พอใช้',
    'good' => 'ดี',
    'excellent' => 'ดีมาก',
    'great' => 'วิเศษ!',
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
    CRITICAL_ERROR => 'ผิดพลาดร้ายแรง',
    'file' => 'ไฟล์ : ',
    'line' => 'บรรทัด : ',
    );

$lang_display_thumbnails = array(
    'filename' => 'ชื่อไฟล์ : ',
    'filesize' => 'ขนาดไฟล์ : ',
    'dimensions' => 'ขนาดภาพ : ',
    'date_added' => 'เพิ่มเมื่อวันที่ : '
    );

$lang_get_pic_data = array(
    'n_comments' => '%s คำวิจารณ์',
    'n_views' => '%s เข้าชม',
    'n_votes' => '(%s โหวต)'
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
    0 => 'ออกจากสถานะผู้ดูแล ...',
    1 => 'เข้าสู่สถานะผู้ดูแล ...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
    'alb_need_name' => 'กรุณาใส่ชื่ออัลบั้ม !',
    'confirm_modifs' => 'แน่ใจว่า จะเปลี่ยนแปลงค่านี้ ?',
    'no_change' => 'คุณยังไม่ได้เปลี่ยนแปลงอะไร !',
    'new_album' => 'อัลบั้มใหม่',
    'confirm_delete1' => 'แน่ใจว่า จะลบอัลบั้มนี้ ?',
    'confirm_delete2' => '\n ภาพและคำวิจารณ์ทั้งหมดจะถูกลบ !',
    'select_first' => 'กรุณาเลือกอัลบั้มก่อน',
    'alb_mrg' => 'ระบบจัดการอัลบั้ม',
    'my_gallery' => '*  แกลอรีส่วนตัว*',
    'no_category' => '* ไม่มีหมวดหมู่ *',
    'delete' => 'ลบ',
    'new' => 'สร้างใหม่',
    'apply_modifs' => 'บันทึกการเปลี่ยนแปลง',
    'select_category' => 'เลือกหมวดหมู่',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
    'miss_param' => 'ตัวแปรสำหรับ \'%s\'ไม่ถูกต้อง !',
    'unknown_cat' => 'ไม่มีหมวดหมู่ที่เลือก',
    'usergal_cat_ro' => 'ไม่สามารถลบแกลอรีได้ !',
    'manage_cat' => 'จัดการหมวดหมู่',
    'confirm_delete' => 'แน่ใจว่า จะลบหมวดหมู่นี้',
    'category' => 'หมวดหมู่',
    'operations' => 'กระทำ',
    'move_into' => 'ย้ายไปยัง',
    'update_create' => 'ปรับปรุง/สร้างหมวดหมู่',
    'parent_cat' => 'หมวดหมู่หลัก',
    'cat_title' => 'ชื่อหมวดหมู่',
    'cat_desc' => 'รายละเอียดหมวดหมู่'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array(
    'title' => 'กำหนดค่า',
    'restore_cfg' => 'กลับยังค่าเดิม',
    'save_cfg' => 'บันทึกค่าใหม่',
    'notes' => 'บันทึก',
    'info' => 'รายละเอียด',
    'upd_success' => 'ปรับปรุงค่าของ Coppermine แล้ว',
    'restore_success' => 'กลับไปใช้ค่าเดิมของ Coppermine แล้ว',
    'name_a' => 'ชื่อ จากน้อยไปมาก',
    'name_d' => 'ชื่อ จากมากไปน้อย',
    'title_a' => 'หัวเรื่อง จากน้อยไปมาก',
    'title_d' => 'หัวเรื่อง จากมากไปน้อย',
    'date_a' => 'วันที่ จากน้อยไปมาก',
    'date_d' => 'วันที่ จากมากไปน้อย',
    'rating_a' => 'อันดับ จากน้อยไปมาก', // new in cpg1.2.0nuke
    'rating_d' => 'อันดับ จากมากไปน้อย', // new in cpg1.2.0nuke
    'th_any' => 'ขนาดมากสุด',
    'th_ht' => 'สูง',
    'th_wd' => 'กว้าง',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
    'ตั้งค่าทั่วไป',
    array('ชื่อแกลอรี ', 'gallery_name', 0),
    array('รายละเอียดแกลอรี ', 'gallery_description', 0),
    array('E-mail ผู้ดูแลแกลอรี ', 'gallery_admin_email', 0),
    array('address สำหรับ links  \'ดูภาพอีก...\' ของ e-cards', 'ecards_more_pic_target', 0),
    array('ภาษา', 'lang', 5),
// for postnuke change
        array('ธีม', 'cpgtheme', 6),
        array('หัวเรื่องที่ระบุแทน >Coppermine', 'nice_titles', 1),
    array('แสดงเมนูทางด้านขวามือ', 'right_blocks', 1), // new 1.2.2
    'แสดงอัลบั้ม',
    array('ความกว้างตารางหลัก (pixels or %)', 'main_table_width', 0),
    array('จำนวนระดับของหมวดหมู่', 'subcat_level', 0),
    array('จำนวนอัลบั้ม', 'albums_per_page', 0),
    array('จำนวนสดมภ์ของอัลบั้ม', 'album_list_cols', 0),
    array('ขนาดของภาพแบบย่อ หน่วย pixels', 'alb_list_thumb_size', 0),
    array('เนื้อหาของหน้าจอหลัก', 'main_page_layout', 0),
    array('แสดงลำดับแรกของภาพขนาดย่อของอัลบั้มในหมวด', 'first_level', 1), 

    'แสดงภาพแบบย่อ',
    array('จำนวนสดมภ์ในหน้าภาพแบบย่อ', 'thumbcols', 0),
    array('จำนวนแถวในหน้าภาพแบบย่อ', 'thumbrows', 0),
    array('จำนวนแถบมากสุดที่จะแสดง', 'max_tabs', 0),
    array('แสดงข้อความจั่วหน้าภายใต้ภาพแบบย่อ', 'caption_in_thumbview', 1),
    array('แสดงจำนวนคำวิจารณ์ภายใต้ภาพแบบย่อ', 'display_comment_count', 1),
    array('การเรียงลำดับภาพโดยปริยาย', 'default_sort_order', 3),
    array('จำนวนน้อยที่สุดของการโหวตสำหรับภาพที่จะแสดงในรายการที่นิยมมากที่สุด', 'min_votes_for_rating', 0),
    array('หัวเรื่องของภาพขนาดย่อ และคำสำคัญแทนรายละเอียดภาพ', 'seo_alts', 1), // new in cpg1.2.0nuke

    'การตั้งค่าการวิจารณ์ของการแสดงภาพ',
    array('ความกว้างของตารางของการแสดงภาพ(pixels or %)', 'picture_table_width', 0),
    array('แสดงรายละเอียดของภาพโดยปริยาย', 'display_pic_info', 1),
    array('กรองคำหยาบในคำวิจารณ์', 'filter_bad_words', 1),
    array('ใช้รูปยิ้มในคำวิจารณ์ได้', 'enable_smilies', 1),
    array('ยอมให้ผู้ใช้คนเดียวกันวิจารณ์หลายครั้งติดต่อกันใน 1 ภาพ ', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
    array('Email ไปยังผู้ดูแล เมื่อมีคำวิจารณ์' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
    array('ความยาวมากสุดของคำจำกัดความของภาพ', 'max_img_desc_length', 0),
    array('จำนวนอักขระมากสุด', 'max_com_wlength', 0),
    array('จำนวนบรรทัดมากสุด', 'max_com_lines', 0),
    array('ความยาวมากสุดของคำวิจารณ์', 'max_com_size', 0),
    array('แสดงแถบฟิล์ม', 'display_film_strip', 1),
    array('จำนวนมากสุดของภาพแถบฟิล์ม', 'max_film_strip_items', 0),
    array('ยอมให้ผู้ไม่ประสงค์ออกนามดูภาพขนาดเต็ม ', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',		


    'การตั้งค่าภาพและภาพแบบย่อ',
    array('คุณภาพของไฟล์ JPEG ', 'jpeg_qual', 0),
    array('ความกว้างหรือความสูงมากสุดของภาพแบบย่อ <strong>*</strong>', 'thumb_width', 0),
    array('ใช้ขนาดภาพ ( ความกว้าง หรือความสูงของภาพแบบย่อ )<strong>*</strong>', 'thumb_use', 7),
    array('สร้างภาพในทันที','make_intermediate',1),
    array('ความกว้างหรือความสูงมากสุดของภาพที่แสดงในทันที <strong>*</strong>', 'picture_width', 0),
    array('ขนาดมากสุดของภาพที่ส่งเข้ามา (KB)', 'max_upl_size', 0),
    array('ความกว้างหรือความสูงมากสุดของภาพที่ส่งเข้ามา (pixels)', 'max_upl_width_height', 0),

    'ตั้งค่าผู้ใช้งาน',
    array('อนุญาตให้มีการลงทะเบียนผู้ใช้งานใหม่', 'allow_user_registration', 1),
    array('ต้องยืนยัน email สำหรับการลงทะเบียน', 'reg_requires_valid_email', 1),
    array('ยอมให้ผู้ใช้งาน 2 คน ใช้ email ซ้ำกัน', 'allow_duplicate_emails_addr', 1),
    array('ผู้ใช้งานสามารถมีอัลบั้มส่วนตัว', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

    'ฟิลด์ที่กำหนดเองสำหรับคำจำกัดความของภาพ (ปล่อยว่าง ถ้าไม่ต้องการใช้งาน)',
    array('ชื่อฟิลด์ 1', 'user_field1_name', 0),
    array('ชื่อฟิลด์ 2 ', 'user_field2_name', 0),
    array('ชื่อฟิลด์ 3 ', 'user_field3_name', 0),
    array('ชื่อฟิลด์ 4 ', 'user_field4_name', 0),

    'ตั้งค่าแบบก้าวหน้าของภาพและภาพแบบย่อ',
    array('แสดงสัญลักษณ์อัลบั้มส่วนตัว สำหรับผู้ใช้ที่ไม่ได้เข้าสู่ระบบ', 'show_private', 1),
    array('อักขระต้องห้ามในชื่อไฟล์', 'forbiden_fname_char',0),
    array('นามสกุลของภาพที่ยอมให้ส่งเข้ามา', 'allowed_file_extensions',0),
    array('วิธีการลดขนาดภาพ','thumb_method',2),
    array('ที่อยู่ของตัวแปลงภาพของ ImageMagick (เช่น /usr/bin/X11/)', 'impath', 0),
    array('ชนิดของภาพที่อนุญาต(ใช้สำหรับ ImageMagick เท่านั้น)', 'allowed_img_types',0),
    array('คำสั่งเพิ่มเติมสำหรับ ImageMagick', 'im_options', 0),
    array('อ่านข้อมูล EXIF ในไฟล์ JPEG ', 'read_exif_data', 1),
    array('อ่านข้อมูล IPTC ในไฟล์ JPEG ', 'read_iptc_data', 1), // new in cpg1.2.0nuke
    array('directory ของอัลบั้ม <strong>*</strong>', 'fullpath', 0),
    array('directory สำหรับอัลบั้มของผู้ใช้งาน <strong>*</strong>', 'userpics', 0),
    array('คำนำหน้าสำหรับภาพในทันที <strong>*</strong>', 'normal_pfx', 0),
    array('คำนำหน้าสำหรับภาพแบบย่อ <strong>*</strong>', 'thumb_pfx', 0),
    array('ค่าโดยปริยายของ directory', 'default_dir_mode', 0),
    array('ค่าโดยปริยายของภาพ', 'default_file_mode', 0),
    array('แสดงชื่อไฟล์', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
    array('แสดงชื่ออัลบั้ม', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
    array('แสดงขนาดไฟล์', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
    array('แสดงขนาดภาพ', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
    array('แสดงจำนวนนับ', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
    array('แสดง URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
    array('แสดง URL ในรูปแบบลิงค์ bookmark ', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
    array('แสดงลิงค์อัลบั้มที่โปรดปราน', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke

    'การตั้งค่า Cookies ',
    array('ชื่อของ cookie ที่ใช้งานโดย script', 'cookie_name', 0),
    array('ที่อยู่ของ cookie ที่ใช้งานโดย script', 'cookie_path', 0),
    array('รหัสอักขระ', 'charset', 4),

    'ตั้งค่าอื่นๆ',
    array('ใช้ debug mode', 'debug_mode', 1),
    array('เปิดใช้งาน debug mode แบบก้าวหน้า', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
    array('แสดงคำเตือนการปรับปรุง coppermine แก่ผู้ดูแลระบบ', 'showupdate', 1), // new 1.2.2
    '<br /><div align="center">(*) ช่องที่มี * จะต้องไม่มีการเปลี่ยนแปลง ถ้าหากคุณมีรูปอยู่ใน gallery แล้ว</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
    'empty_name_or_com' => 'กรุณาเติมชื่อและคำวิจารณ์',
    'com_added' => 'เพิ่มคำวิจารณ์แล้ว',
    'alb_need_title' => 'กรุณาใส่หัวเรื่องของอัลบั้ม !',
    'no_udp_needed' => 'ไม่จำเป็นต้องปรับปรุง',
    'alb_updated' => 'อัลบั้มได้รับการปรับปรุงแล้ว',
    'unknown_album' => 'ไม่มีอัลบั้มที่คุณเลือก หรือคุณไม่มีสิทธิ์ส่งภาพเข้าอัลบั้ม',
    'no_pic_uploaded' => 'ไม่มีการส่งภาพเข้ามา!<br /><br />ถ้าคุณเลือกภาพที่จะส่งแล้วกรุณาตรวจสอบการตั้งค่าอนุญาตสำหรับแม่ข่าย',
    'err_mkdir' => 'ไม่สามารถสร้าง directory %s !',
    'dest_dir_ro' => 'directory ปลายทาง %s ไม่สามารถเขียนได้ โดยscript !',
    'err_move' => 'ไม่สามารถเคลื่อนย้าย %s ไปยัง %s !',
    'err_fsize_too_large' => 'ขนาดของภาพที่คุณส่งเข้ามาใหญ่เกินไป (ขนาดมากสุดที่อนุญาต คือ %s x %s) !',
    'err_imgsize_too_large' => 'ขนาดของไฟล์ที่คุณส่งเข้ามาใหญ่เกินไป  (ขนาดมากสุดที่อนุญาต คือ %s กิโลไบต์) !',
    'err_invalid_img' => 'รูปแบบของไฟล์ที่คุณส่งเข้ามาไม่ถูกต้อง !',
    'allowed_img_types' => 'คุณสามารถส่งภาพเข้ามาเพียง %s ภาพ',
    'err_insert_pic' => 'ไม่สามารถส่งภาพ  \'%s\' เข้าอัลบั้มได้ ',
    'upload_success' => 'ส่งภาพเรียบร้อยแล้ว<br /><br />จะแสดงได้ เมื่อผู้ดูแลได้ตรวจสอบแล้ว',
    'info' => 'รายละเอียด',
    'com_added' => 'เพิ่มคำวิจารณ์แล้ว',
    'alb_updated' => 'ปรับปรุงอัลบั้มแล้ว',
    'err_comment_empty' => 'คำวิจารณ์ของคุณว่างเปล่า !',
    'err_invalid_fext' => 'ไฟล์ที่อนุญาตจะต้องมีนามสกุล : <br /><br />%s.',
    'no_flood' => 'เสียใจด้วย เนื่องจากคุณเป็นผู้เขียนคำวิจารณ์ล่าสุด<br /><br />คุณสามาถแก้ไขคำวิจารณ์ของคุณได้เท่านั้น',
    'redirect_msg' => 'คุณกำลังถูกส่งไปยัง<br /><br /><br />กดปุ่ม \'ต่อไป\' ถ้าหากยังไม่มีการเปลี่ยนหน้าจอ',
    'upl_success' => 'เพิ่มภาพของคุณเรียบร้อยแล้ว',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array(
    'caption' => 'ข้อความจั่วหน้า',
    'fs_pic' => 'ภาพขนาดเต็ม',
    'del_success' => 'ลบเรียบร้อยแล้ว',
    'ns_pic' => 'ขนาดภาพปกติ',
    'err_del' => 'ไม่สามารถลบได้',
    'thumb_pic' => 'ภาพแบบย่อ',
    'comment' => 'คำวิจารณ์',
    'im_in_alb' => 'ภาพในอัลบั้ม',
    'alb_del_success' => 'ลบอัลบั้ม  \'%s\' ',
    'alb_mgr' => 'ระบบจัดการอัลบั้ม',
    'err_invalid_data' => 'มีความผิดพลาดของข้อมูลใน \'%s\'',
    'create_alb' => 'สร้างอัลบั้ม \'%s\'',
    'update_alb' => 'ปรับปรุงอัลบั้ม \'%s\' ด้วยหัวเรื่อง  \'%s\' และดัชนี \'%s\'',
    'del_pic' => 'ลบภาพ',
    'del_alb' => 'ลบอัลบั้ม',
    'del_user' => 'ลบผู้ใช้งาน',
    'err_unknown_user' => 'ไม่มีผู้ใช้งานที่เลือก !',
    'comment_deleted' => 'ลบคำวิจารณ์เรียบร้อยแล้ว',
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
    'confirm_del' => 'คุณแน่ใจว่า จะลบภาพนี้ ? \\n คำวิจารณ์จะถูกลบไปด้วย',
    'del_pic' => 'ลบภาพ',
    'size' => '%s x %s pixels',
    'views' => '%s ครั้ง',
    'slideshow' => 'แสดงสไลด์',
    'stop_slideshow' => 'หยุดการแสดงสไลด์',
    'view_fs' => 'ดูภาพขนาดเต็ม',
    'edit_pic' => 'แก้ไขรายละเอียดของภาพ', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array(
    'title' =>'รายละเอียดของภาพ',
    'Filename' => 'ชื่อไฟล์',
    'Album name' => 'ชื่ออัลบั้ม',
    'Rating' => 'อันดับ (%s โหวต)',
    'Keywords' => 'คำสำคัญ',
    'File Size' => 'ขนาดไฟล์',
    'Dimensions' => 'ขนาดภาพ',
    'Displayed' => 'แสดงเกี่ยวกับ',
    'Camera' => 'กล้อง',
    'Date taken' => 'ถ่ายเมื่อวันที่',
    'Aperture' => 'รูรับแสง',
    'Exposure time' => 'ระยะเวลารับแสง',
    'Focal length' => 'ความยาวโฟกัส',
    'Comment' => 'คำวิจารณ์',
    'addFav' => 'เพิ่มไปยังอัลบั้มที่โปรดปราน',//different in 1.2.0nuke
    'addFavPhrase' => 'โปรดปราน', // new in cpg1.2.0different in 1.2.0nuke
    'remFav' => 'ลบออกจากอัลบั้มที่โปรดปราน',
    'iptcTitle' => 'หัวเรื่อง IPTC ', // new in cpg1.2.0nuke
    'iptcCopyright' => 'ลิขสิทธิ์ IPTC ', // new in cpg1.2.0nuke
    'iptcKeywords' => 'คำสำคัญ IPTC ', // new in cpg1.2.0nuke
    'iptcCategory' => 'หมวด IPTC ', // new in cpg1.2.0nuke
    'iptcSubCategories' => 'หมวดย่อย IPTC ', // new in cpg1.2.0nuke
    'bookmark_page' => 'Bookmark ภาพ ', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array(
    'OK' => 'ตกลง',
    'edit_title' => 'แก้ไขคำวิจารณ์',
    'confirm_delete' => 'คุณแน่ใจว่าจะลบคำวิจารณ์นี้ ?',
    'add_your_comment' => 'เพิ่มคำวิจารณ์',
    'name' => 'ชื่อ',
    'comment' => 'คำวิจารณ์',
    'your_name' => 'ชื่อของคุณ',
        );

    $lang_fullsize_popup = array('click_to_close' => 'กดที่ภาพ เพื่อปิดหน้าต่างนี้',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array(
    'title' => 'ส่งเป็น e-card',
    'invalid_email' => '<strong>คำเตือน</strong> : email ไม่ถูกต้อง !',
    'ecard_title' => ' e-card จาก %s ถึงคุณ',
    'view_ecard' => 'ถ้าหาก e-card แสดงผลไม่ถูกต้อง กรุณากด link นี้',
    'view_more_pics' => 'กด link นี้เพื่อดูภาพอื่นๆอีก !',
    'send_success' => 'ส่ง ecard เรียบร้อยแล้ว',
    'send_failed' => 'ขออภัย เครื่องแม่ข่ายไม่สามารถส่ง  e-card ของคุณได้',
    'from' => 'จาก',
    'your_name' => 'ชื่อของคุณ',
    'your_email' => 'email ของคุณ',
    'to' => 'ถึง',
    'rcpt_name' => 'นามผู้รับ',
    'rcpt_email' => 'email ผู้รับ',
    'greetings' => 'ขอแสดงความยินดี',
    'message' => 'ข้อความ',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
    'pic_info' => 'รายละเอียดภาพ',
    'album' => 'อัลบั้ม',
    'title' => 'หัวเรื่อง',
    'desc' => 'คำจำกัดความ',
    'keywords' => 'คำสำคัญ',
    'pic_info_str' => '%sx%s - %s กิโลไบต์ - เข้าชม %s ครั้ง - %s โหวต',
    'approve' => 'ภาพที่ยอมรับ',
    'postpone_app' => 'เลื่อนการยอมรับ',
    'del_pic' => 'ลบภาพ',
    'read_exif' => 'อ่านข้อมูล EXIF อีกครั้ง', // new in cpg1.2.0nuke
    'reset_view_count' => 'ตั้งค่าตัวนับการเข้าชมใหม่',
    'reset_votes' => 'ตั้งค่าโหวตใหม่',
    'del_comm' => 'ลบคำวิจารณ์',
    'upl_approval' => 'ตรวจสอบภาพที่ส่งเข้ามา',
    'edit_pics' => 'แก้ไขภาพ',
    'see_next' => 'ภาพต่อไป',
    'see_prev' => 'ภาพก่อนหน้า',
    'n_pic' => '%s ภาพ',
    'n_of_pic_to_disp' => 'จำนวนภาพที่แสดง',
    'apply' => 'บันทึกการเปลี่ยนแปลง'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
    'group_name' => 'ชื่อกลุ่ม',
    'disk_quota' => 'โควต้าพื้นที่',
    'can_rate' => 'สามารถจัดระดับภาพ (rate)ได้',
    'can_send_ecards' => 'สามารถส่ง ecards ได้',
    'can_post_com' => 'สามารถวิจารณ์ได้',
    'can_upload' => 'สามารถส่งภาพได้',
    'can_have_gallery' => 'สามารถมีแกลอรีส่วนตัวได้',
    'apply' => 'บันทึกการเปลี่ยนแปลง',
    'create_new_group' => 'สร้างกลุ่มใหม่',
    'del_groups' => 'ลบกลุ่มที่เลือก',
    'confirm_del' => 'คำเตือน !! เมื่อลบกลุ่มแล้ว สมาชิกในกลุ่มนั้นจะถูกย้ายไปยังกลุ่ม  \'ลงทะเบียน\' แทน!\n\nต้องการทำต่อหรือไม่ ?',
    'title' => 'จัดการกลุ่ม',
    'approval_1' => 'ตรวจสอบการส่งภาพสาธารณะ (1)',
    'approval_2' => 'ตรวจสอบการส่งภาพส่วนตัว (2)',
    'note1' => '<strong>(1)</strong> การส่งภาพสู่อัลบั้มสาธารณะ จะต้องได้รับการตรวจสอบจากผู้ดูแล',
    'note2' => '<strong>(2)</strong> การส่งภาพสู่อัลบั้มส่วนตัว จะต้องได้รับการตรวจสอบจากผู้ดูแล',
    'notes' => 'บันทึก'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array(
    'welcome' => 'ยินดีต้อนรับ !'
        );

    $lang_album_admin_menu = array(
    'confirm_delete' => 'คุณแน่ใจว่าจะลบอัลบั้มนี้ ? \\nภาพและคำวิจารณ์ทั้งหมดจะถูกลบไปด้วย',
    'delete' => 'ลบ',
    'modify' => 'คุณสมบัติ',
    'edit_pics' => 'แก้ไขภาพ',
        );

    $lang_list_categories = array(
    'home' => 'หน้าแรก',
    'stat1' => '<strong>[pictures]</strong> ภาพ  ใน <strong>[albums]</strong> อัลบั้ม และ <strong>[cat]</strong> หมวดหมู่  <strong>[comments]</strong> คำวิจารณ์  มีการเข้าชม<strong>[views]</strong> ครั้ง',
    'stat2' => '<strong>[pictures]</strong>ภาพ ใน <strong>[albums]</strong> อัลบั้ม มีการเข้าชม <strong>[views]</strong> ครั้ง',
    'xx_s_gallery' => '%s\'s แกลอรี',
    'stat3' => '<strong>[pictures]</strong> ภาพ ใน <strong>[albums]</strong> อัลบั้ม  <strong>[comments]</strong> คำวิจารณ์ มีการเข้าชม <strong>[views]</strong> ครั้ง'
        );

    $lang_list_users = array(
    'user_list' => 'รายชื่อผู้ใช้งาน',
    'no_user_gal' => 'ไม่มีผู้ใช้งานที่ได้รับอนุญาตให้มีอัลบั้ม ',
    'n_albums' => '%s อัลบั้ม',
    'n_pics' => '%s ภาพ'
        );

    $lang_list_albums = array(
    'n_pictures' => '%s ภาพ',
    'last_added' => ', เพิ่มล่าสุดเมื่อ %s'
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
    'upd_alb_n' => 'ปรับปรุงอัลบั้ม %s',
    'general_settings' => 'ตั้งค่าทั่วไป',
    'alb_title' => 'หัวเรื่องอัลบั้ม',
    'alb_cat' => 'หมวดหมู่อัลบั้ม',
    'alb_desc' => 'คำจำกัดความอัลบั้ม',
    'alb_thumb' => 'ภาพแบบย่อของอัลบั้ม',
    'alb_perm' => 'การอนุญาตสำหรับอัลบั้ม',
    'can_view' => 'อัลบั้ม สามารถดูได้โดย',
    'can_upload' => 'ผู้มาเยือนสามารถส่งภาพได้',
    'can_post_comments' => 'ผู้มาเยือนสามารถวิจารณ์ได้',
    'can_rate' => 'ผู้มาเยือนสามารถจัดระดับภาพได้',
    'user_gal' => 'แกลอรีของผู้ใช้งาน',
    'no_cat' => '* ไม่มีหมวดหมู่ *',
    'alb_empty' => 'ไม่มีอัลบั้ม',
    'last_uploaded' => 'ส่งภาพล่าสุด',
    'public_alb' => 'อัลบั้มสาธารณะ',
    'me_only' => 'อัลบั้มส่วนตัว',
    'owner_only' => 'เจ้าของอัลบั้ม (%s) เท่านั้น',
    'groupp_only' => 'สมาชิกกลุ่ม \'%s\' ',
    'err_no_alb_to_modify' => 'ไม่มีอัลบั้มที่คุณสามารถแก้ไข ในฐานข้อมูล',
    'update' => 'ปรับปรุงอัลบั้ม'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
    'already_rated' => 'ขออภัย คุณได้จัดระดับภาพนี้แล้ว',
    'rate_ok' => 'การโหวตของคุณได้รับการยอมรับ',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
ผู้ดูแลระบบของ {SITE_NAME} สามารถแก้ไขหรือลบภาพหรือข้อมูลใดๆ ออกได้ในทันที และเนื่องจากไม่สามารถตรวจสอบการแสดงความคิดเห็นได้ทั้งหมด ดังนั้นพึงระลึกเสมอว่า การแสดงความคิดเห็นต่างๆเป็นของผู้เขียน ไม่เกี่ยวข้องกับผู้ดูแลแต่อย่างใด (ยกเว้นเป็นการแสดงความคิดเห็นโดยผู้ดูแลเอง) และไม่ขอรับผิดชอบใดๆทั้งสิ้น<br />
<br />
คุณจะต้องไม่ส่งภาพหรือคำวิจารณ์ใดๆที่ไม่ถูกต้อง  ลามกอนาจาร ให้ร้ายผู้อื่น น่าเกลียดน่ากลัว คุกคามผู้อื่น เรื่องเกี่ยวกับเซ็กส์ หรือวัสดุอื่นใดที่อาจผิดกฎหมาย ผู้ดูและระบบของ {SITE_NAME} มีสิทธิ์ที่จะลบหรือแก้ไขรายละเอียดได้ตลอดเวลา  ในฐานะผู้ใช้งานคุณจะต้องยอมรับรายละเอียดทุกอย่างที่คุณส่งเข้ามาเก็บในฐานข้อมูล ซึ่งข้อมูลเหล่านี้ จะไม่มีการเปิดเผยต่อสาธารณะโดยปราศจากการยินยอมของคุณ และ ผู้ดูแลระบบจะไม่รับผิดชอบใดๆต่อการเสียหายของข้อมูล<br />
<br />
เวบไซต์นี้ มีการใช้ cookies ในการบันทึกข้อมูลที่เครื่องฝั่งลูกข่าย ซึ่ง cookies จะใช้เป็นข้อมูลเพื่อปรับปรุงบริการให้เกิดความพึงพอใจของคุณเท่านั้น email จะถูกใช้เพื่อยืนยันข้อมูลการลงทะเบียนเท่านั้น<br />
<br />
กรุณากดปุ่ม 'ยอมรับ' ถ้าหากคุณเห็นด้วย
EOT;

    $lang_register_php = array(
    'page_title' => 'ลงทะเบียนผู้ใช้งาน',
    'term_cond' => 'ข้อตกลงในการใช้งาน',
    'i_agree' => 'ยอมรับ',
    'submit' => 'ลงทะเบียน',
    'err_user_exists' => 'ชื่อที่คุณเลือกมีผู้ใช้แล้ว  กรุณาเลือกชื่ออื่น',
    'err_password_mismatch' => 'รหัสผ่าน 2 ครั้งไม่ตรงกัน กรุณากรอกใหม่',
    'err_uname_short' => 'ชื่อผู้ใช้ จะต้องมีความยาวไม่ต่ำกว่า 2 ตัวอักษร',
    'err_password_short' => 'รหัสผ่าน จะต้องมีความยาวไม่ต่ำกว่า 2 ตัวอักษร',
    'err_uname_pass_diff' => 'ชื่อผู้ใช้ กับ รหัสผ่าน จะต้องไม่เหมือนกัน',
    'err_invalid_email' => 'Email ไม่ถูกต้อง',
    'err_duplicate_email' => 'มีผู้ลงทะเบียนด้วย email นี้แล้ว',
    'enter_info' => 'รายละเอียดการลงทะเบียน',
    'required_info' => 'ข้อมูลจำเป็น',
    'optional_info' => 'ข้อมูลเพิ่มเติม',
    'username' => 'ชื่อผู้ใช้',
    'password' => 'รหัสผ่าน',
    'password_again' => 'ยืนยันรหัสผ่าน',
    'email' => 'Email',
    'location' => 'ที่อยู่',
    'interests' => 'ความสนใจ',
    'website' => 'Home page',
    'occupation' => 'อาชีพ',
    'error' => 'ผิดพลาด',
    'confirm_email_subject' => 'ยืนยันการลงทะเบียนของ %s ',
    'information' => 'รายละเอียด',
    'failed_sending_email' => 'ไม่สามารถส่ง email  ยืนยันการลงทะเบียนได้!',
    'thank_you' => 'ขอขอบคุณที่ลงทะเบียน<br /><br /> ข้อมูลการเปิดใช้งานบัญชีของคุณจะถูกส่งไปยัง email ที่คุณระบุไว้',
    'acct_created' => 'บัญชีผู้ใช้ของคุณถูกสร้างแล้ว  และคุณสามารถเข้าสู่ระบบด้วย ชื่อผู้ใช้และรหัสผ่านของคุณแล้ว',
    'acct_active' => 'บัญชีผู้ใช้ของคุณสามารถใช้งานได้แล้ว และคุณสามารถเข้าสู่ระบบด้วย ชื่อผู้ใช้และรหัสผ่านของคุณแล้ว',
    'acct_already_act' => 'บัญชีผู้ใช้ของคุณเปิดใช้งานแล้ว !',
    'acct_act_failed' => 'ไม่สามารถเปิดใช้งานบัญชีผู้ใช้ได้ !',
    'err_unk_user' => 'ไม่มีผู้ใช้งานที่คุณเลือก !',
    'x_s_profile' => 'ข้อมูลของ %s\'s ',
    'group' => 'กลุ่ม',
    'reg_date' => 'เข้าร่วมเมื่อ',
    'disk_usage' => 'พื้นที่ที่ใช้ไป',
    'change_pass' => 'เปลี่ยนรหัสผ่าน',
    'current_pass' => 'รหัสผ่านปัจจุบัน',
    'new_pass' => 'รหัสผ่านใหม่',
    'new_pass_again' => 'ยืนยันรหัสผ่านใหม่',
    'err_curr_pass' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง',
    'apply_modif' => 'บันทึกการเปลี่ยนแปลง',
    'change_pass' => 'เปลี่ยนรหัสผ่าน',
    'update_success' => 'ปรับปรุงข้อมูลแล้ว',
    'pass_chg_success' => 'เปลี่ยนรหัสผ่านแล้ว',
    'pass_chg_error' => 'รหัสผ่านไม่เปลี่ยนแปลง'
        );

    $lang_register_confirm_email = <<<EOT
ขอขอบคุณสำหรับการลงทะเบียนที่ {SITE_NAME}

ชื่อผู้ใช้ : "{USER_NAME}"
รหัสผ่าน : "{PASSWORD}"

ในการเปิดบัญชีผู้ใช้งาน คุณจะต้องกดที่ link ข้างล่างนี้
หรือ copy แล้ว paste ในบราวเซอร์

{ACT_LINK}

ขอแสดงความนับถือ,

ผู้ดูแลระบบ {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
    'title' => 'ทบทวนคำวิจารณ์',
    'no_comment' => 'ไม่มีคำวิจารณ์',
    'n_comm_del' => 'ลบ %s คำวิจารณ์ ',
    'n_comm_disp' => 'จำนวนคำวิจารณ์ที่จะแสดง',
    'see_prev' => 'ดูก่อนหน้า',
    'see_next' => 'ดูถัดไป',
    'del_comm' => 'ลบคำวิจารณ์ที่ถูกเลือก',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(
    0 => 'ค้นหาภาพ',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
    'page_title' => 'ค้นภาพใหม่',
    'select_dir' => 'เลือก directory',
    'select_dir_msg' => 'ด้วยคำสั่งนี้ คุณสามารถส่งภาพต่อเนื่องมายังเครื่องแม่ข่ายโดยผ่านทาง FTP<br /><br />กรุณาเลือก directory ที่ต้องการส่งภาพ',
    'no_pic_to_add' => 'ไม่มีภาพที่จะเพิ่ม',
    'need_one_album' => 'ในการใช้คำสั่งนี้ คุณจะต้องมีอย่างน้อย 1 อัลบั้ม',
    'warning' => 'คำเตือน',
    'change_perm' => 'ชุดคำสั่งไม่สามารถบันทึก directory นี้ได้ คุณจะต้องเปลี่ยน mode เป็น 755 หรือ 777 ก่อนที่จะทำการเพิ่มภาพ !',
    'target_album' => '<strong>เพิ่มภาพ &quot;</strong>%s<strong>&quot; ไปยัง </strong>%s',
    'folder' => 'โฟลเดอร์',
    'image' => 'ภาพ',
    'album' => 'อัลบั้ม',
    'result' => 'แสดงผล',
    'dir_ro' => 'ไม่สามารถบันทึกได้ ',
    'dir_cant_read' => 'ไม่สามารถอ่านได้. ',
    'insert' => 'เพิ่มภาพใหม่ในแกลอรี',
    'list_new_pic' => 'แสดงรายการภาพใหม่',
    'insert_selected' => 'เพิ่มภาพที่เลือก',
    'no_pic_found' => 'ไม่พบภาพใหม่',
    'be_patient' => 'กรุณารอซักครู่ เนื่องจากชุดคำสั่งต้องใช้เวลาในการเพิ่มภาพ',
    'notes' =>  '<ul>'.
                '<li><strong>OK</strong> : หมายถึง เพิ่มภาพสำเร็จ'.
                '<li><strong>DP</strong> : หมายถึง มีภาพซ้ำ หรือมีอยู่แล้วในฐานข้อมูล'.
                '<li><strong>PB</strong> : หมายถึง ไม่สามารถเพิ่มภาพได้ กรุณาตรวจสอบค่าติดตั้งและการอนุญาตของ directories ให้ถูกต้อง'.
                '<li>ถ้าหาก สัญลักษณ์ OK, DP, PB ไม่ปรากฏ  ให้กดบนภาพที่มีปัญหาเพื่อดูข้อผิดพลาดที่เกิดขึ้น'.
                '<li>ถ้าหากบราวเซอร์หมดเวลา กรุณากดปุ่ม Refresh '.
                '</ul>',
        'select_album' => 'เลือกอัลบั้ม', // new in nuke
        'no_album' => 'ยังไม่ได้เลือกอัลบั้ม กรุณากลับไปเลือกอัลบั้มที่ต้องการจะเพิ่มภาพ',
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
    'title' => 'ส่งภาพ',
    'max_fsize' => 'ขนาดไฟล์ใหญ่สุดที่อนุญาต คือ  %s KB',
    'album' => 'อัลบั้ม',
    'picture' => 'ภาพ',
    'pic_title' => 'หัวเรื่องภาพ',
    'description' => 'คำจำกัดความ',
    'keywords' => 'คำสำคัญ (แยกจากกันด้วยช่องว่าง)',
    'err_no_alb_uploadables' => 'ขออภัย ไม่มีอัลบั้มที่คุณสามารถส่งภาพได้',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
    'title' => 'จัดการผู้ใช้งาน',
    'name_a' => 'ชื่อ จากน้อยไปมาก',
    'name_d' => 'ชื่อ จากมากไปน้อย',
    'group_a' => 'กลุ่ม จากน้อยไปมาก',
    'group_d' => 'กลุ่ม จากมากไปน้อย',
    'reg_a' => 'วันที่ลงทะเบียน จากน้อยไปมาก',
    'reg_d' => 'วันที่ลงทะเบียน จากมากไปน้อย',
    'pic_a' => 'จำนวนภาพ จากน้อยไปมาก',
    'pic_d' => 'จำนวนภาพ จากมากไปน้อย',
    'disku_a' => 'การใช้พื้นที่ จากน้อยไปมาก',
    'disku_d' => 'การใช้พื้นที่ จากมากไปน้อย',
    'sort_by' => 'จัดเรียงผู้ใช้งานโดย',
    'err_no_users' => 'ตารางผู้ใช้งานว่างเปล่า !',
    'err_edit_self' => 'คุณไม่สามารถแก้ไขข้อมูลส่วนตัวได้  ให้ใช้ link  \'ข้อมูลส่วนตัว\' แทน',
    'edit' => 'แก้ไข',
    'delete' => 'ลบ',
    'name' => 'ชื่อผู้ใช้',
    'group' => 'กลุ่ม',
    'inactive' => 'ไม่ทำงาน',
    'operations' => 'การกระทำ',
    'pictures' => 'ภาพ',
    'disk_space' => 'พื้นที่ใช้ / พื้นที่กำหนด',
    'registered_on' => 'ลงทะเบียน เมื่อ',
    'u_user_on_p_pages' => '%d ผู้ใช้งาน จำนวน %d หน้า',
    'confirm_del' => 'คุณแน่ใจที่จะลบผู้ใช้งานคนนี้ ? \\nภาพและอัลบั้มทั้งหมดของเขาจะถูกลบไปด้วย',
    'mail' => 'เมล',
    'err_unknown_user' => 'ไม่มีผู้ใช้งานที่คุณเลือก !',
    'modify_user' => 'เปลี่ยนแปลงผู้ใช้งาน',
    'notes' => 'บันทึก',
    'note_list' => '<li>ถ้าคุณไม่ต้องการเปลี่ยนแปลงรหัสผ่านปัจจุบัน กรุณาปล่อยว่างฟิลด์ "รหัสผ่าน" ',
    'password' => 'รหัสผ่าน',
    'user_active_cp' => 'ผู้ใช้สามารถใช้งานได้', // different var in cpg1.2.0nuke
    'user_group_cp' => 'กลุ่มของผู้ใช้', // different var in cpg1.2.0nuke
    'user_email' => 'email',
    'user_web_site' => 'web site',
    'create_new_user' => 'สร้างผู้ใช้ใหม่',
   'user_from' => 'สถานที่อยู่', // different var in cpg1.2.0nuke
    'user_interests' => 'ความสนใจ',
    'user_occ' => 'อาชีพ', // different var in cpg1.2.0nuke
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'ปรับขนาดภาพ',
        'what_it_does' => 'ทำได้ยังไง',
        'what_update_titles' => 'ปรับปรุงหัวเรื่องจากชื่อไฟล์',
        'what_delete_title' => 'ลบหัวเรื่อง',
        'what_rebuild' => 'สร้างภาพขนาดย่อ และปรับขนาดภาพใหม่',
        'what_delete_originals' => 'ลบขนาดภาพต้นฉบับ และแทนที่ด้วยรุ่นที่ปรับขนาดใหม่',
        'file' => 'ไฟล์',
        'title_set_to' => 'ตั้งหัวเรื่องเป็น',
        'submit_form' => 'ตกลง',
        'updated_succesfully' => 'ปรับปรุงเรียบร้อยแล้ว',
        'error_create' => 'มีข้อผิดพลาดในการสร้าง',
        'continue' => 'ดำเนินการกับภาพอื่นๆอีก',
        'main_success' => 'ไฟล์ %s ถูกใช้เป็นภาพหลักแล้ว',
        'error_rename' => 'มีข้อผิดพลาดในการเปลี่ยนชื่อจาก  %s ไปเป็น %s',
        'error_not_found' => 'ไม่พบไฟล์ %s ',
        'back' => 'กลับไปยังหน้าจอหลัก',
        'thumbs_wait' => 'กำลังปรับปรุงภาพขนาดย่อ และ/หรือปรับขนาดภาพ  กรุณารอซักครู่...',
        'thumbs_continue_wait' => 'กำลังดำเนินการปรับปรุงภาพขนาดย่อ และ/หรือ ปรับขนาดภาพ...',
        'titles_wait' => 'กำลังปรับปรุงหัวเรื่อง  กรุณารอซักครู่...',
        'delete_wait' => 'กำลังลบหัวเรื่อง  กรุณารอซักครู่...',
        'replace_wait' => 'กำลังลบต้นฉบับ และแทนที่ด้วยภาพที่ปรับขนาดแล้ว กรุณารอซักครู่..',
        'instruction' => 'คำแนะนำแบบเร่งด่วน',
        'instruction_action' => 'เลือกรายการที่ต้องการ',
        'instruction_parameter' => 'ตั้งค่าต่างๆ',
        'instruction_album' => 'เลือกอัลบั้ม',
        'instruction_press' => 'กด %s',
        'update' => 'ปรับปรุงภาพขนาดย่อ และ/หรือปรับขนาดภาพ',
        'update_what' => 'จะทำการปรับปรุงอะไร',
        'update_thumb' => 'เฉพาะภาพขนาดย่อ',
        'update_pic' => 'เฉพาะปรับขนาดภาพ',
        'update_both' => 'ทั้งภาพขนาดย่อ และปรับขนาดภาพ',
        'update_number' => 'จำนวนภาพที่ดำเนินการต่อครั้ง',
        'update_option' => '(พยายามตั้งค่าให้ต่ำ ถ้าคุณเคยมีปัญหาเรื่องเวลาในการทำคำสั่งไม่เพียงพอ)',
        'filename_title' => 'ชื่อไฟล์ &rArr; หัวเรื่องภาพ',
        'filename_how' => 'จะแก้ไขชื่อไฟล์ได้อย่างไร',
        'filename_remove' => 'ลบ .jpg ที่อยู่ข้างหลังออก แล้วแทนที่ด้วย _ (underscore) พร้อมช่องว่าง',
        'filename_euro' => 'เปลี่ยนจาก 2003_11_23_13_20_20.jpg ไปเป็น 23/11/2003 13:20',
        'filename_us' => 'เปลี่ยนจาก 2003_11_23_13_20_20.jpg ไปเป็น 11/23/2003 13:20',
        'filename_time' => 'เปลี่ยนจาก 2003_11_23_13_20_20.jpg ไปเป็น 13:20',
        'delete' => 'ลบหัวเรื่องภาพ หรือภาพต้นฉบับ',
        'delete_title' => 'ลบหัวเรื่องภาพ',
        'delete_original' => 'ลบภาพต้นฉบับ',
        'delete_replace' => 'ลบภาพต้นฉบับ แล้วแทนที่ด้วยภาพที่ปรับขนาดแล้ว',
        'select_album' => 'เลือกอัลบั้ม',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'กำลังชมภาพ',
    'usr' => "'s Photo Gallery",
    'photogallery' => 'แกลอรีภาพ',
    );

?>