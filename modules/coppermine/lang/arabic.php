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
define('PIC_VIEWS', 'ãÔÇåÏÇÊ');
define('PIC_VOTES', 'ÊÕæíÊ');
define('PIC_COMMENTS', 'ãáÇÍÙÇÊ');

$lang_translation_info = array('lang_name_english' => 'Arabic',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'ÚÑÈí', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'ar', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Waheed Alsayer', //the name of the translator - can be a nickname
'trans_email' => 'waheed@shamayel.com', //translator's email address (optional)
'trans_website' => 'http://www.shamayel.com/', //translator's website (optional)
'trans_date' => '2003-10-02', //the date the translation was created / last modified
);

$lang_charset = 'windows-1256';
$lang_text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('ÈÇíÊ', 'ß.È', 'ã.È');
// Day of weeks and months
$lang_day_of_week = array('ÇÍÏ', 'ÇËäíä', 'ËáÇËÇÁ', 'ÇÑÈÚÇÁ', 'ÎãíÓ', 'ÌãÚÉ', 'ÓÈÊ');
$lang_month = array('íäÇíÑ', 'İÈÑÇíÑ', 'ãÇÑÓ', 'ÇÈÑíá', 'ãÇíæ', 'íæäíæ', 'íæáíæ', 'ÇÛÓØÓ', 'ÓÈÊãÈÑ', 'ÇßÊæÈÑ', 'äæİãÈÑ', 'ÏíÓãÈÑ');
// Some common strings
$lang_yes = 'äÚã';
$lang_no  = 'áÇ';
$lang_back = 'ÑÌæÚ';
$lang_continue = 'ÇÓÊãÑ';
$lang_info = 'ãÚáæãÇÊ';
$lang_error = 'ÎØÃ';
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
        'random' => 'ÕæÑ ÚÔæÇÆíÜÜÜÉ',
	'lastup' => 'ÂÎÜÜÑ ÇÖÇİÜÜÇÊ',
    'lastupby' => 'ÇÖÇİÇÊí ÇáÃÎíÑÉ', // new 1.2.2
        'lastalb'=> 'ÂÎÑ ÃáÈæãÇÊ Êã ÊÍÏíËåÇ',
	'lastcom' => 'ÂÎÑ ãáÇÍÙÜÜÇÊ',
    'lastcomby' => 'ÊÚáíŞÇÊí ÇáÃÎíÑÉ', // new 1.2.2
	'topn' => 'ÇßËÑåÇ ãÔÇåÏÉ',
	'toprated' => 'ÇÚáÇåÇ ÊŞííãÇ',
	'lasthits' => 'ÂÎÑ ãÇ ÔæåÏ',
	'search' => 'äÊÇÆÌ ÇáÈÍÜË',
    'favpics' => 'ÕæÑ ãİÖáÉ' // changed in cpg1.2.0nuke
);

$lang_errors = array('access_denied' => 'áíÜÓ áÏíß ÇáÕáÇÍíÉ áÏÎæá åĞå ÇáÕİÍÉ.',
	'perm_denied' => 'áíÓ áÏíß ÇáÕáÇÍíÉ ááŞíÇã ÈÊáß ÇáÕáÇÍíÉ.',
	'param_missing' => 'áŞÏ äæÏí ÇáÈÑäÇãÌ ÈÏæä ãÊÛíÑÇÊ.',
	'non_exist_ap' => 'ÇáÃáÈæã Ãæ ÇáÕæÑÉ ÇáãÎÊÇÑÉ ÛíÑ ãæÌæÏÉ!',
	'quota_exceeded' => 'ÊÎØíÊ ÍÏæÏ ÇáÊÎÒíä<br /><br />ÇáãÓÇÍÉ ÇáãÓãæÍÉ áß [quota]K, ÕæÑß ÊÍÊá ãÓÇÍÉ [space]K, æÈÅÖÇİÉ åĞå ÇáÕæÑÉ Óæİ ÊÊÎØì ÍÏæÏ ÇáÊÎÒíä ÇáãÓãæÍÉ áß.',
	'gd_file_type_err' => 'ÚäÏ ÇÓÊÚãÇá ãßÊÈÉ GD ááÈÑÇãÌ áÇ íÓãÍ ÅáÇ ÈÜãáİÇÊ  JPEG æ PNG.',
	'invalid_image' => 'ÇáÕæÑÉ ÇáãÍãáÉ ÛíÑ ÕÇáÍÉ Çæ áã ÊÚÇáÌ ÈãßÊÈÉ GD',
	'resize_failed' => 'áã ÇÓÊØÚ Êßæíä ÇÎÊÕÇÑ ÇáÕæÑÉ Çæ ÊÕÛíÑåÇ.',
	'no_img_to_display' => 'áÇ ÊæÌÏ ÕæÑÉ ááÚÑÖ',
	'non_exist_cat' => 'ÇáÊÕäíİ ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ',
	'orphan_cat' => 'ÊÕäíİ áíÓ áå ÊÕäíİ ÑÆíÓí, ÔÛá ãÏíÑ ÇáÊÕäíİÇÊ áÚáÇÌ ÇáãÔßáÉ.',
	'directory_ro' => 'ÇáÏáíá \'%s\' ÛíÑ ŞÇÈá ááßÊÇÈÉ, áÇ ÇÓÊØíÚ ÇáÛÇÁ ÇáÕæÑÉ',
	'non_exist_comment' => 'ÇáÊÚáíŞ ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ.',
	'pic_in_invalid_album' => 'ÇáÕæÑÉ ÛíÑ ãæÌæÏÉ İí ÇáÇáÈæã (%s)!?',
        'banned' => 'ÇäÊ ããäæÚ ãä ÇÓÊÚãÇá ÇáãæŞÚ ÍÇáíÇ.',
        'not_with_udb' => 'åĞå ÇáãíÒÉ ãÚØáÉ İí Coppermine áÃäåÇ ãÏãæÌÉ ãÚ ÇáãäÊÏì. ÇãÇ ãÇ ÊæÏ ÇáŞíÇã Èå ÛíÑ ãÏÚæã, Ãæ Çä ÈÑäÇãÌ ÇáãäÊÏì íŞæã ÈäİÓ ÇáãåãÉ.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'ÇäÊŞá Çáì ŞÇÆãÉ ÇáÇáÈæãÇÊ',
	'alb_list_lnk' => 'ŞÇÆãÉ ÇáÇáÈæãÇÊ',
	'my_gal_title' => 'ÇäÊŞá Çáì ÇáÈæãí ÇáÎÇÕ',
	'my_gal_lnk' => 'ÇáÈæãí ÇáÎÇÕ',
	'my_prof_lnk' => 'ÊÚÑíİí',
	'adm_mode_title' => 'ÊÍæíá Çáì æÇÌåÉ ÇáÇÏÇÑÉ',
	'adm_mode_lnk' => 'ÍÇáÉ ÇáÇÏÇÑÉ',
	'usr_mode_title' => 'ÊÍæíá Çáì æÇÌåÉ ÇáÇÓÊÚãÇá',
	'usr_mode_lnk' => 'ÍÇáÉ ÇáãÓÊÎÏã',
	'upload_pic_title' => 'ÊÍãíá ÇáÕæÑÉ İí ÇáÇáÈæã',
	'upload_pic_lnk' => 'ÊÍãíá ÇáÕæÑÉ',
	'register_title' => 'Êßæíä ÍÓÇÈ',
	'register_lnk' => 'ÊÓÌíá',
	'login_lnk' => 'ÏÎæá',
	'logout_lnk' => 'ÎÑæÌ',
	'lastup_lnk' => 'ÂÎÑ ÊÍãíá',
	'lastcom_lnk' => 'ÂÎÑ ÊÚáíŞÇÊ',
	'topn_lnk' => 'ÇßËÑ ÇáÕæÑ ãØÇáÚÉ',
	'toprated_lnk' => 'ÇÚáì ÇáÕæÑ ÊŞííãÇ',
	'search_lnk' => 'ÇÈÍË',
                'fav_lnk' => 'ÇáãİÖáÉ',
);

$lang_gallery_admin_menu = array('upl_app_lnk' => 'ÇáãæÇİŞÉ Úáì ÇáÊÍãíá',
	'config_lnk' => 'ÊÚííÑ',
	'albums_lnk' => 'ÇáÇáÈæãÇÊ',
	'categories_lnk' => 'ÇáÊÕäíİÇÊ',
	'users_lnk' => 'ÇáãÓÊÎÏãíä',
	'groups_lnk' => 'ãÌãæÚÇÊ',
	'comments_lnk' => 'ÊÚáíŞÇÊ',
	'searchnew_lnk' => 'ÇÖİ ãÌãæÚÉ ãä ÇáÕæÑ',
        'util_lnk' => 'ÊÛííÑ ŞíÇÓÇÊ ÇáÕæÑ',
        'ban_lnk' => 'ãäÚ ÇáãÓÊÎÏãíä',
);

$lang_user_admin_menu = array('albmgr_lnk' => 'ÇÎáŞ / ÇİÑÒ ÇáÈæãÇÊí',
	'modifyalb_lnk' => 'ÊÚÏíá ÇáÈæãÇÊí',
	'my_prof_lnk' => 'Çáãáİ ÇáÔÎÕí',
);

$lang_cat_list = array('category' => 'ÇáÊÕäíİ',
	'albums' => 'ÇáÇáÈæãÇÊ',
	'pictures' => 'ÇáÕæÑ',
);

$lang_album_list = array(
	'album_on_page' => '%d ÇáÈæã İí %d ÕİÍÉ'
);

$lang_thumb_view = array('date' => 'ÇáÊÇÑíÎ',
	'name' => 'ÇÓã Çáãáİ',
        'title' => 'ÇáÚäæÇä',
	'sort_da' => 'ÊÑÊíÈ ÊÕÇÚÏí ÍÓÈ ÇáÊÇÑíÎ',
	'sort_dd' => 'ÊÑÊíÈ ÊäÇÒáí ááÊÇÑíÎ',
	'sort_na' => 'ÊÑÊíÈ ÊÕÇÚÏí ááÇÓã',
	'sort_nd' => 'ÊÑÊíÈ ÊäÇÒáí ááÇÓã',
        'sort_ta' => 'ÊÑÊíÈ ÇáÚäæÇä ÊÕÇÚÏí',
        'sort_td' => 'ÊÑÊíÈ ÇáÚäæÇä ÊäÇÒáí',
	'pic_on_page' => '%d ÕæÑÉ İí %d ÕİÍÉ/ÕİÍÇÊ',
	'user_on_page' => '%d ãÓÊÎÏã İí %d ÕİÍÉ',
    'sort_ra' => 'ÊÑÊíÈ ÇáÊŞííã ÊÕÇÚÏíÇ', // new in cpg1.2.0nuke
    'sort_rd' => 'ÊÑÊíÈ ÇáÊŞííã ÊäÇÒáíÇ', // new in cpg1.2.0nuke
    'rating' => 'ÇáÊŞííã', // new in cpg1.2.0nuke
    'sort_title' => 'ÊÑÊíÈ ÇáÕæÑ ÍÓÈ:', // new in cpg1.2.0nuke
);

$lang_img_nav_bar = array('thumb_title' => 'ÇáÑÌæÚ Çáì ÇáãÎÊÕÑÇÊ',
	'pic_info_title' => 'ÇÙåÑ/ÇÎİí ãÚáæãÇÊ ÇáÕæÑ',
	'slideshow_title' => 'ÚÑÖ Âáí',
    'slideshow_disabled' => 'ÇáÈØÇŞÇÊ ÇáÇáßÊÑæäíÉ ãÚØáÉ', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
	'ecard_title' => 'ÇÑÓá ÇáÕæÑÉ ßÈÑíÏ',
	'ecard_disabled' => 'ÇáÕæÑ ÇáÈÑíÏÉ ãÚØáÉ',
	'ecard_disabled_msg' => 'áíÓ áÏíß ÇáÕáÇÍíÉ áÇÑÓÇá ÕæÑ ÈÑíÏíÉ',
	'prev_title' => 'ÇáÕæÑÉ ÇáÓÇÈŞÉ',
	'next_title' => 'ÇáÕæÑÉ ÇáÊí ÊáíåÜÇ',
	'pic_pos' => 'ÕÜæÑå %s/%s',
    'no_more_images' => 'áÇ ÊæÌÏ ÕæÑ ÇÖÇİíÉ İí ÇáãÚÑÖ', // new in cpg1.2.0nuke
    'no_less_images' => 'åĞå åí Çæá ÕæÑÉ İí ÇáãÚÑÖ', // new in cpg1.2.0nuke
);

$lang_rate_pic = array('rate_this_pic' => 'ŞíÜã åĞå ÇáÕæÑÉ',
	'no_votes' => '(áÇ íæÌÏ ÊÕæíÊ)',
	'rating' => '(ÇáÊÕæíÊ ÇáÍÇáí: %s / 5 ãä %s ÊÕæíÊ)',
	'rubbish' => 'ÓíÜÆÉ',
	'poor' => 'ÛíÑ ãŞÈæáÉ',
	'fair' => 'ãŞÈæáÉ',
	'good' => 'ÌíÜÏÉ',
	'excellent' => 'ããÊÜÇÒÉ',
	'great' => 'ãĞåáÜÉ',
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
	CRITICAL_ERROR => 'ÎØÃ ÎØíÑ',
	'file' => 'ãáİ: ',
	'line' => 'ÇáÓØÑ: ',
);

$lang_display_thumbnails = array('filename' => 'ÇÓã Çáãáİ : ',
	'filesize' => 'ÇáÍÌã : ',
	'dimensions' => 'ÇáÇÈÚÇÏ : ',
	'date_added' => 'ÇÖíİ İí : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s ÊÚáíŞ',
	'n_views' => '%s ãÔÇåÏÉ',
	'n_votes' => '(%s ÊÕæíÊ)'
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
	'Exclamation' => 'ÊÚÌÈ',
	'Question' => 'ÇÓÊİåÇã',
	'Very Happy' => 'ÓÚíÏ ÌÏÇ',
	'Smile' => 'ÇÈÊÓÇãÉ',
	'Sad' => 'ÍÒíä',
	'Surprised' => 'ÊÚÌÈ',
	'Shocked' => 'ãÏåæÔ',
	'Confused' => 'ãÑÊÈß',
	'Cool' => 'ÚÌíÈ',
	'Laughing' => 'íÖÍß',
	'Mad' => 'ÛÇÖÈ',
        'Razz' => 'Razz',
	'Embarassed' => 'ãÍÑÌ',
	'Crying or Very sad' => 'íÈßí Ãæ ÍÒíä ÌÏÇ',
	'Evil or Very Mad' => 'ÔíØÇäí Ãæ ÛÇÖÈ ÌÏÇ',
        'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Úíæä ÍÇÆÑÉ',
	'Wink' => 'íÛãÒ',
	'Idea' => 'İßÑÉ',
	'Arrow' => 'Óåã',
	'Neutral' => 'ÚÇÏí',
        'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'ÇäÊ ÇáÂä ÊÊÑß ÍÇáÉ ÇáÇÏÇÑÉ...',
	1 => 'ÇäÊ ÇáÂä ÊÏÎá ÍÇáÉ ÇáÇÏÇÑÉ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'ÇáÃáÈæã ÈÍÇÌÉ Çáì ÅÓÜã !',
	'confirm_modifs' => 'åá ÃäÊ ãÊÃßøÏ Ãäøß ÊÑíÏ Úãá åĞå ÇáÊøÚÏíáÇÊ  ?',
	'no_change' => 'áã ÊŞã ÈÃí ÊÛííÑ !',
	'new_album' => 'ÇáÈÜæã ÌÏíÏ',
	'confirm_delete1' => 'åá ÃäÊ ãÊÃßÏ ááÃÛÇÁ åĞÇ ÇáÃáÈæã ?',
	'confirm_delete2' => '\nÓæİ íÊã ÍĞİ ÇáÕæÑ æ ÇáãáÇÍÙÇÊ !',
	'select_first' => 'ÇÏÎá ÇÓã ÇáÃáÈæã ÃæáÇğ',
	'alb_mrg' => 'ÇáÊÍßã ÈÇáÃáÈæã',
	'my_gallery' => '* ãÚÑÖÜí *',
	'no_category' => '* ÇáãÚÑÖ ÛíÑ ãæÌæÏ *',
	'delete' => 'ÇáÛÜÇÁ',
	'new' => 'ÌÏíÏ',
	'apply_modifs' => 'ÇÓÊÚãá ÇáÊøÚÏíáÇÊ ',
	'select_category' => 'ÇáÕøäİ ÇáãÎÊÇÑ ',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'ÇáãÚáæãÇÊ ÇáãØáæÈÉ ááÚãáíÉ \'%s\'áã ÊÚØì !',
	'unknown_cat' => 'ÇáÊÕäíİ ÇáãÎÊÇÑ ÛíÑ ãÚÑæİ',
	'usergal_cat_ro' => 'áÇíÓãÍ ÈÇáÛÇÁ ÊÕäíİ ÇáãÓÊÎÏãíä !',
	'manage_cat' => 'ÇÏÇÑÉ ÇáÊÕäíİÇÊ',
	'confirm_delete' => 'åá ÇäÊ ãÊÃßÏ ãä ÇáÛÇÁ åĞÇ ÇáÊÕäíİ',
	'category' => 'ÇáÊÕäíİ',
	'operations' => 'ÇáÚãáíÇÊ',
	'move_into' => 'ÇäŞá Çáì',
	'update_create' => 'ÊÍÏíË Ãæ Êßæíä ÊÕäíİ',
	'parent_cat' => 'ÇáÊÕäíİ ÇáÃÈ',
	'cat_title' => 'ÚäæÇä ÇáÊÕäíİ',
	'cat_desc' => 'ÔÑÍ ÇáÊÕäíİ'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'ÇáÅÚÜÜÜÏÇÏÊ',
	'restore_cfg' => 'ÊÌÇåÜá ÇáÊÛííÑÇÊ',
	'save_cfg' => 'áÍİÜÙ ÇáÅÚÏÇÏÇÊ',
	'notes' => 'ãáÇÍÙÜÜÇÊ',
	'info' => 'ÇáãÚÜáæãÜÇÊ',
	'upd_success' => 'áŞÏ Êã ÊÍÏíË ÇáÅÚÜÏÇÏÊ',
	'restore_success' => 'Êã ÇÑÌÇÚ ÇáÇÚÏÇÏÇÊ ÇáÇÕáíÉ',
	'name_a' => 'ÊÕÇÚÏí Úáì ÇáÇÓã',
	'name_d' => 'ÊäÇÒáí Úáì ÇáÇÓã',
	'title_a' => 'ÊÕÇÚÏí Úáì ÇáÚäæÇä',
	'title_d' => 'ÊäÇÒáí Úáì ÇáÚäæÇä',
        'date_a' => 'ÊÇÑíÎ ÊÕÇÚÏí',
        'date_d' => 'ÊÇÑíÎ ÊäÇÒáí',
        'rating_a' => 'ÇáÊŞííã ÊÕÇÚÏíÇ', // new in cpg1.2.0nuke
        'rating_d' => 'ÇáÊŞííã ÊäÇÒáíÇ', // new in cpg1.2.0nuke
        'th_any' => 'ÇßÈÑ ŞíÇÓ',
        'th_ht' => 'ÇáÇÑÊİÇÚ',
        'th_wd' => 'ÇáÚÑÖ',
);
// start left side interpretation
if (defined('CONFIG_PHP')) $lang_config_data = array('ÇÚÏÇÏÇÊ ÚÇãÉ',
	array('ÇÓã ÇáãÚÑÖ', 'gallery_name', 0),
	array('ÔÑÍ ÇáãÚÑÖ', 'gallery_description', 0),
	array('ÇáÈÑíÏ ÇáÇáßÊÑæäí áãÏíÑ ÇáãÚÑÖ', 'gallery_admin_email', 0),
	array('ÇáÚäæÇä ÇáåÏİ áæÕáÉ \'ÑÄíÉ ÇáãÒíÏ ãä ÇáÕæÑ\' İí ÇáßÑæÊ', 'ecards_more_pic_target', 0),
	array('ÇááÛÉ', 'lang', 5),
// for postnuke change
	array('ÇáÓãÉ', 'theme', 6),
        array('ÚäÇæíä ãÍÏÏÉ ááÕİÍÇÊ ÈÏáÇ ãä >Coppermine', 'nice_titles', 1),
	'ÑÄíÉ ÇáÇáÈæã ßŞÇÆãÉ',
	array('ÚÑÖ ÇáÌÏæá ÇáÑÆíÓí áÚÑÖ ÇáÕæÑ (ÈÇáäŞÇØ Ãæ ÈÇáäÓÈÉ)', 'main_table_width', 0),
	array('ÚÏÏ ãÓÊæíÇÊ ÇáÊÕäíİ ÇáÊí ÊÚÑÖ', 'subcat_level', 0),
	array('ÚÏÏ ÇáÇáÈæãÇÊ ÇáÊí ÊÚÑÖ', 'albums_per_page', 0),
	array('ÚÏÏ ÇáÇÚãÏÉ áÚÑÖ ÇáÇáÈæã', 'album_list_cols', 0),
	array('ŞíÇÓ ÇáÇÎÊÕÇÑ ÈÇáäŞÇØ', 'alb_list_thumb_size', 0),
	array('ãÍÊæíÇÊ ÇáÕİÍÉ ÇáÑÆíÓíÉ', 'main_page_layout', 0),
            array('ÇÚÑÖ ãÎÊÕÑÇÊ ÇáÈæã ÇáãÓÊæì ÇáÇæá İí ÇáÊÕäíİÇÊ ','first_level',1),
	'ÚÑÖ ÇáãÎÊÕÑÇÊ',
	array('ÚÏÏ ÇáÇÚãÏÉ İí ÕİÍÉ ãÎÊÕÑÇÊ ÇáÕæÑ', 'thumbcols', 0),
	array('ÚÏÏ ÇáÇÓØÑ İí ÕİÍÉ ãÎÊÕÑÇÊ ÇáÕæÑ', 'thumbrows', 0),
	array('ÇßÈÑ ÚÏÏ ááÕİÍÇÊ ÇáÊí ÓÊÚÑÖ', 'max_tabs', 0),
	array('ÚÑÖ ÚäæÇä ÇáÕæÑ ÇÓİá ÇáÕæÑÉ', 'caption_in_thumbview', 1),
	array('ÇÙåÑ ÚÏÏ ÇáÊÚáíŞÇÊ ÇÓİá ÇáÕæÑÉ', 'display_comment_count', 1),
	array('ÇáÊÑÊíÈ ÇáÊŞáíÏí ááÕæÑ', 'default_sort_order', 3),
	array('ÇŞá ÚÏÏ ãä ÇáÊÕæíÊÇÊ áÙåæÑ ÇáÕæÑÉ İí ŞÇÆãÉ  \'ÇÚáì ÊŞííã\'', 'min_votes_for_rating', 0),
        array('Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
	'ÇÚÏÇÏÇÊ ãäÙÑ ÇáÕæÑ æÇáÊÚáíŞÇÊ',
	array('ÚÑÖ ÇáÌÏæá áÚÑÖ ÇáÕæÑ (ÈÇáäŞÇØ Ãæ ÈÇáäÓÈÉ)', 'picture_table_width', 0),
	array('ãÚáæãÇÊ ÇáÕæÑ ÊÑì ÊáŞÇÆíÇ', 'display_pic_info', 1),
	array('ÊÕİíÉ ÇáßáãÇÊ ÇáÓíÆÉ İí ÇáÊÚáíŞÇÊ (Úáíß ÊÎÒíä Êáß ÇáßáãÇÊ İí ÇáÈÑäÇãÌ ÇæáÇ)', 'filter_bad_words', 1),
	array('ÇáÓãÇÍ ÈÇáæÌæå ÇáÖÇÍßÉ İí ÇáÊÚáíŞÇÊ', 'enable_smilies', 1),
        array('Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array('Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
	array('ÇßÈÑ Øæá áæÕİ ÇáÕæÑÉ', 'max_img_desc_length', 0),
	array('ÇßÈÑ ÚÏÏ ãä ÇáÍÑæİ İí ÇáßáãÉ', 'max_com_wlength', 0),
	array('ÇßÈÑ ÚÏÏ ãä ÇáÇÓØÑ İí ÇáÊÚáíŞ', 'max_com_lines', 0),
	array('ÇßÈÑ Øæá ááÊÚáíŞ', 'max_com_size', 0),
        array('ÇÙåÑ ÔÑíØ Çáİáã', 'display_film_strip', 1),
        array('ÚÏÏ ÇáÕæÑ İí ÔÑíØ Çáİáã', 'max_film_strip_items', 0),
        array('Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
	'ÇÚÏÇÏÇÊ ÇáÕæÑ æãÎÊÕÑÇÊ',
	array('æÖæÍ ÕæÑÉ Ìí ÈíÌ', 'jpeg_qual', 0),
        array('ÇßÈÑ ŞíÇÓ áãÎÊÕÑ ÇáÕæÑÉ <strong>*</strong>', 'thumb_width', 0),
        array('ÇÓÊÚãá ÇáŞíÇÓÇÊ (ÚÑÖ Çæ ÇÑÊİÇÚ Ãæ ÇßÈÑ ÊÈÇÚÏ áãÎÊÕÑ ÇáÕæÑ )<strong>*</strong>', 'thumb_use', 7),
	array('ßæä ÕæÑ æÓíØÉ','make_intermediate',1),
	array('ÇßÈÑ ÚÑÖ Çæ ÇÑÊİÇÚ áÕæÑÉ æÓØíÉ <strong>*</strong>', 'picture_width', 0),
	array('ÇßÈÑ ÍÌã áÕæÑÉ ãÍãáÉ (ÈÇáßíáæ ÈÇíÊ)', 'max_upl_size', 0),
	array('ÇßÈÑ ÚÑÖ Çæ ÇÑÊİÇÚ áÕæÑÉ ãÍãáÉ ÈÇáäŞÇØ', 'max_upl_width_height', 0),
	'ÇÚÏÇÏÇÊ ÇáãÓÊÎÏã',
	array('ÇáÓãÇÍ áãÓÊÎÏã ÌÏíÏ ÈÇáÊÓÌíá', 'allow_user_registration', 1),
	array('ÊÓÌíá ÇáãÓÊÎÏã íÍÊÇÌ ÇáÊÃßíÏ ÈÇáÈÑíÏ ÇáÇáßÊÑæäí', 'reg_requires_valid_email', 1),
	array('ÇáÓãÇÍ áãÓÊÎÏãíä ÇËäíä Çä íßæä áåã äİÓ ÇáÈÑíÏ ÇáÇáßÊÑæäí', 'allow_duplicate_emails_addr', 1),
	array('íãßä ááãÓÊÎÏãíä Çä íßæä áåã ÇáÈæã ÎÇÕ', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
	'ÈíÇäÇÊ ÇÖÇİíÉ áÔÑÍ ÇáÕæÑ (ÇÊÑßå İÇÑÛÇ Çä ßäÊ áÇ ÊÑíÏ ÇÓÊÚãÇáå)',
	array('ÇÓã ÇáÍŞá ÇáÇæá', 'user_field1_name', 0),
	array('ÇÓã ÇáÍŞá ÇáËÇäí', 'user_field2_name', 0),
	array('ÇÓã ÇáÍŞá ÇáËÇáË', 'user_field3_name', 0),
	array('ÇÓã ÇáÍŞá ÇáÑÇÈÚ', 'user_field4_name', 0),
	'ÇÚÏÇÏÇÊ ÇáÕæÑ æãÎÊÕÑÇÊ ÇáÕæÑ ÇáãÊŞÏãÉ',
        array('ÇÙåÑ ÑãÒ ÇáÈæã ÎÇÕ ááãÓÊÎÏã ÇáãÌåæá','show_private',1),
	array('ÇáÍÑæİ ÇáããäæÚÉ İí ÇÓãÇÁ ÇáãáİÇÊ', 'forbiden_fname_char',0),
	array('ÇáÇãÊÏÇÏÇÊ ÇáãÓãæÍ ÈåÇ İí ÇáãáİÇÊ ÇáãÑÓáÉ', 'allowed_file_extensions',0),
	array('ØÑíŞÉ ÇÚÇÏÉ ŞíÇÕ ÇáÕæÑÉ','thumb_method',2),
	array('ÇáÏáíá Çáì ÇÏÇÉ ImageMagick / netpbm \'ááÊÍæíá\'  (ãËÇá /usr/bin/X11/)', 'impath', 0),
	array('ÇäæÇÚ ÇáÕæÑ ÇáãÓãæÍ ÈåÇ (íÓÊÚãá İŞØ áÜ ImageMagick)', 'allowed_img_types',0),
	array('ÇæÇãÑ ÇáÈÑäÇãÌ ImageMagick', 'im_options', 0),
	array('ÇŞÑÁ ÈíÇäÇÊ EXIF İí ãáİÇÊ JPEG', 'read_exif_data', 1),
        array('Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
	array('Ïáíá ÇáÇáÈæã <strong>*</strong>', 'fullpath', 0),
	array('Ïáíá ÕæÑ ÇáãÓÊÎÏãíä <strong>*</strong>', 'userpics', 0),
	array('ÇáÍÑæİ ÇáÇæáì ááÕæÑ ÇáæÓíØÉ(íÌÈ Çä Êßæä ÇäÌáíÒíÉ <strong>*</strong>', 'normal_pfx', 0),
	array('ÇáÍÑæİ ÇáÇæáì áãÎÊÕÑÇÊ ÇáÕæÑ <strong>*</strong>', 'thumb_pfx', 0),
	array('ÇáæÖÚ ÇáÇÚÊíÇÏí ááãÌáÏÇÊ', 'default_dir_mode', 0),
	array('ÇáæÖÚ ÇáÇÚÊíÇÏí ááÕæÑ', 'default_file_mode', 0),
        array('Picinfo display filename', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array('Picinfo display album name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_file_size', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_dimensions', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array('Picinfo display_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array('Picinfo display URL as bookmark link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array('Picinfo display fav album link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
	'ÇÚÏÇÏÇÊ ÇáßæßíÒ æäæÚ ÇáÍÑæİ',
	array('ÇÓã Çáßæßí ÇáãÓÊÚãá İí ÇáÈÑäÇãÌ', 'cookie_name', 0),
	array('Ïáíá ÇáßæßíÒ ÇáãÓÊÚãá İí ÇáÈÑäÇãÌ', 'cookie_path', 0),
	array('äæÚ ÇáÍÑæİ ÇáãÓÊÚãáÉ', 'charset', 4),
	'ÇÚÏÇÏÇÊ ÇÎÑì',
	array('Êãßíä æÖÚ ÇáÊÊÈÚ', 'debug_mode', 1),
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

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'íÌÈ Çä ÊßÊÈ ÇÓãß æÊÚáíŞß',
	'com_added' => 'Êã ÇÖÇİÉ ÇáÊÚáíŞ',
	'alb_need_title' => 'íÌÈ Çä ÊÍÏÏ ÚäæÇä ááÇáÈæã !',
	'no_udp_needed' => 'áÇ ÍÇÌÉ ááÊÍÏíË.',
	'alb_updated' => 'Êã ÊÍÏíË ÇáÇáÈæã',
	'unknown_album' => 'ÇáÇáÈæã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ Çæ áíÓ áß ÇáÕáÇÍíÉ ááÊÍãíá İí åĞÇ ÇáÇáÈæã',
	'no_pic_uploaded' => 'áÇ ÊæÌÏ ÕæÑ ãÍãáÉ !<br /><br />ÇĞÇ ßäÊ İÚáÇ ÇÎÊÑÊ ÕæÑ ááÊÍãíá, ÊÃßÏ ãä Çä ÎÇÏã ÇáÕİÍÇÊ íÓãÍ ÈÇáÊÍãíá...',
	'err_mkdir' => 'áã ÇÓÊØÚ Êßæíä ÇáãÌáÏ %s !',
	'dest_dir_ro' => 'æÌåÉ Çáãáİ %s ÛíÑ ŞÇÈá ááßÊÇÈÉ !',
	'err_move' => 'ãä ÇáãÓÊÍíá äŞá %s Çáì %s !',
	'err_fsize_too_large' => 'ÇáÕæÑ ÇáÊí ÊÑíÏ ÊÍãíáåÇ ßÈíÑÉ ÌÏÇ (ÇßÈÑ ÍÌã ááÕæÑÉ åæ %s x %s) !',
	'err_imgsize_too_large' => 'ÇáÕæÑ ÇáÊí ÊÑíÏ ÊÍãíáåÇ ßÈíÑÉ ÌÏÇ (ÇßÈÑ ÍÌã ááÕæÑÉ åæ %s KB) !',
	'err_invalid_img' => 'ÇáÕæÑÉ ÇáÊí Êã ÊÍãíáåÇ ÛíÑ ÕÇáÍÉ !',
	'allowed_img_types' => 'ÊÓÊØíÚ ÊÍãíá %s ÕæÑÉ.',
	'err_insert_pic' => 'ÇáÕæÑÉ \'%s\' áÇ íãßä ÊÎÒíåÇ İí ÇáÇáÈæã ',
	'upload_success' => 'Êãã ÊÍãíá ÇáÕæÑÉ ÈäÌÇÍ<br /><br />Óæİ ÊÑÇåÇ ÈÚÏ ãæÇİŞÉ ÇáãÏíÑ.',
	'info' => 'ãÚáæãÇÊ',
	'com_added' => 'Êã ÇÖÇİÉ ÇáÊÚáíŞ',
	'alb_updated' => 'Êã ÊÍÏíË ÇáÇáÈæã',
	'err_comment_empty' => 'áã ÊßÊÈ ÇáÊÚáíŞ !',
	'err_invalid_fext' => 'Óæİ íÓãÍ ÈÇáãáİÇÊ ÇáÊí ÊäÊåí ÈÜ : <br /><br />%s.',
	'no_flood' => 'äÃÓİ áßäß ÇäÊ ßäÊ ÂÎÑ ãÚáŞ Úáì åĞå ÇáÕæÑÉ<br /><br />ÊÓÊØíÚ ÊÛííÑ ÊÚáíŞß Úáì ÇáÕæÑÉ',
	'redirect_msg' => 'ÓíÊã ÊÍæáíß Çáì ÕİÍÉ ÇÎÑì.<br /><br /><br />ÇÖÛØ Úáì  \'ÇÓÊãÜÜÑ\' Çä áã íÊã ÇÚÇÏÉ ÊäÔíØ ÇáÕİÍÉ ÊáŞÇÆíÇ',
	'upl_success' => 'Êã ÊÍãíá ÇáÕæÑÉ ÈäÌÇÍ',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'ÇáÚäæÇä',
	'fs_pic' => 'ÕæÑÉ ÈÇáÍÌã ÇáØÈíÚí',
	'del_success' => 'Êã ÇáÛÇÁåÇ ÈäÌÇÍ',
	'ns_pic' => 'ÕæÑÉ ÈÇáÍÌã ÇáØÈíÚí',
	'err_del' => 'áÇ íãßä ÇáÛÇÁå',
	'thumb_pic' => 'ãÎÊÕÑ',
	'comment' => 'ÊÚáíŞ',
	'im_in_alb' => 'ÕæÑÉ İí ÇáÇáÈæã',
	'alb_del_success' => 'ÇáÇáÈæã \'%s\' Êã ÇáÛÇÁå',
	'alb_mgr' => 'ãÏíÑ ÇáÇáÈæã',
	'err_invalid_data' => 'ÈíÇäÇÊ ÛíÑ ÕÇáÍÉ Êã ÇÓÊŞÈÇáåÇ İí \'%s\'',
	'create_alb' => 'ÌÇÑí Êßæíä ÇáÇáÈæã \'%s\'',
	'update_alb' => 'ÌÇÑí ÊÍÏíË ÇáÇáÈæã \'%s\' ÈÇáÚäæÇä \'%s\' æÇáİåÑÓ \'%s\'',
	'del_pic' => 'ÇáÛÇÁ ÇáÕæÑÉ',
	'del_alb' => 'ÇáÛí ÇáÇáÈæã',
	'del_user' => 'ÇáÛí ÇáãÓÊÎÏã',
	'err_unknown_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'comment_deleted' => 'Êã ÇáÛÇÁ ÇáÊÚáíŞ ÈäÌÇÍ',
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
	'confirm_del' => 'åá ÃäÊ ãÊÃßÏ áÅáÛÇÁ ÇáÕæÑÉ ? \\nÓíÊã ÇáÛÇÁ ÇáÊÚáíŞÇÊ ÇíÖÇ.',
	'del_pic' => 'ÃÖÛØ áãÓÜÍ åĞå ÇáÕæÑÉ',
	'size' => '%s İí %s äŞØÉ',
	'views' => '%s ãÜÑÇÊ',
	'slideshow' => 'ÚÑÖ ÇáÔÑÇÆÍ',
	'stop_slideshow' => 'áÊæŞíİ ÚÑÖ ÇáÔÑÇÆÍ',
	'view_fs' => 'ÇÖÛØ áÊßÈíÜÑ ÇáÕæÑÉ',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
);

$lang_picinfo = array(
	'title' =>'ãÚáæãÇÊ Úä ÇáÕæÑÉ',
	'Filename' => 'ÇÓã Çáãáİ',
	'Album name' => 'ÇÓã ÇáÃáÈæã',
	'Rating' => 'ÊŞííã (%s ÊÕæíÊ)',
	'Keywords' => 'ÇáßáãÇÊ ÇáÑøÆíÓíøÉ ',
	'File Size' => 'ÍÌã Çáãáİ',
	'Dimensions' => 'ÇáÃÈÚÇÏ ',
	'Displayed' => 'ÚÏÏ ãÑÇÊ ÇáÅÖåÇÑ',
	'Camera' => 'ÂáÉ ÇáÊÕæíÑ',
	'Date taken' => 'ÊÇÑíÎ ÇáÊŞÇØ ÇáÕæÑÉ',
	'Aperture' => 'ÇáÚÏÓÉ ',
	'Exposure time' => 'æŞÊ ÇáÊøÚÑøÖ ',
	'Focal length' => 'ÇáÈÚÏ ÇáÈÄÑíø ',
	'Comment' => 'ãáÇÍÙÇÊ',
        'addFav'=>'ÇÖİ Çáì ÇáãİÖáÉ',
        'addFavPhrase'=>'ÇáãİÖáÉ',
        'remFav'=>'ÇáÛ ãä ÇáãİÖáÉ',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
);

$lang_display_comments = array(
	'OK' => 'ÍÓäÜÇ',
	'edit_title' => 'áÊÍÜÑíÑ ÇáãáÇÍÙÇÊ',
	'confirm_delete' => 'åá ÃäÊ ãÊÃßÜÏ áÍÜĞİ åĞå ÇáãáÇÍÙÇÊ ?',
	'add_your_comment' => 'ÃÏÎÜá ãáÇÍÙÇÊß',
        'name'=>'ÇáÇÓã',
        'comment'=>'ÊÚáíŞ',
        'your_name' => 'ãÌåæá',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'ÇÖÛØ Úáì ÇáÕæÑÉ áÇÛáÇŞ ÇáäÇİĞÉ',
);
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'ÇÑÓÇá ßÑÊ ãÚÇíÏÉ',
	'invalid_email' => '<strong>ÊäÈÜíå</strong> : ÇáÈÑíÏ ÇáÇáßÊÑæäí ÎØÃ !',
	'ecard_title' => 'ßÑÊ ãä  %s áß',
	'view_ecard' => 'Çä áã íÙåÑ ÇáßÑÊ ÈÇáÕæÑÉ ÇáÕÍíÍÉ, ÇÖÛØ åäÇ',
	'view_more_pics' => 'ÇÖÛØ åäÇ áÑÄíÉ ÇáãÒíÏ ãä ÇáÕæÑ !',
	'send_success' => 'Êã ÇÑÓÇá ßÑÊß',
	'send_failed' => 'äÃÓİ áßä ÇáÎÇÏã áÇ íÓÊØíÚ ÇÑÓÇá ÇáßÑÊ...',
	'from' => 'ãä',
	'your_name' => 'ÇÓãß',
	'your_email' => 'ÇáÈÑíÏ ÇáÃáßÊÑæäí',
	'to' => 'Çáì',
	'rcpt_name' => 'ÇÓã ÇáãÑÓá Çáíå',
	'rcpt_email' => 'ÈÑíÏ ÇáãÑÓá Çáíå ÇáÇáßÊÑæäí',
	'greetings' => 'ÇáÊÍíÉ',
	'message' => 'ÇáÑÓÇáÉ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'ãÚáæãÇÊ ÇáÕæÑÉ',
	'album' => 'ÇáÈæã',
	'title' => 'ÚäæÇä ÇáÕæÑÉ',
	'desc' => 'ÈíÇä Úä ÇáÕæÑÉ',
	'keywords' => 'ÇáßáãÇÊ ÇáÑøÆíÓíøÉ ',
	'pic_info_str' => '%sx%s - %sßíáæÈÇíÊ - %s ãÔÇåÏÉ - %s ÊÕæíÊÇÊ',
	'approve' => 'ÇÚÊãÏ ÇáÕæÑÉ',
	'postpone_app' => 'ÊÃÌíá ÇáãæÇİŞÉ',
	'del_pic' => 'ÇáÛÇÁ ÇáÕæÑÉ',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
	'reset_view_count' => 'ãÓÍ ÇáÚÏÇÏ',
	'reset_votes' => 'ÇáÛÇÁ ÇáÊÕæíÊ',
	'del_comm' => 'ãÓÍ ÇáãáÇÍÙÇÊ',
	'upl_approval' => 'ãæÇİŞÉ ÇáÊÍãíá',
	'edit_pics' => 'ÊÍÜÑíÑ ÇáÕæÑ',
	'see_next' => 'ÇáÕæÑ ÇáÊÇáíÜÉ',
	'see_prev' => 'ÇáÕæÑ ÇáÓÇÈŞÉ',
	'n_pic' => '%s ÇáÕÜæÑ',
	'n_of_pic_to_disp' => 'ÚÏÏ ÇáÕæÑ ÇáãÚÑæÖÉ',
	'apply' => 'ÊØÈíŞ ÇáÊÚÏíá'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'ÇÓã ÇáãÌãæÚÉ',
	'disk_quota' => 'ãÓÇÍÉ ÇáÊÎÒíä ÇáãÓãæÍÉ',
	'can_rate' => 'áÇ ÇÓÊØíÚ ÊŞííã ÇáÕæÑ',
	'can_send_ecards' => 'íÓÊØíÚ ÇÑÓÇá ÇáÕæÑÉ ßÈÑíÏ',
	'can_post_com' => 'íÓÊØíÚ ÇÖÇİÉ ÊÚáíŞÇÊ',
	'can_upload' => 'íÓÊØíÚ ÊÍãíá ÇáÕæÑ',
	'can_have_gallery' => 'íÓÊØíÚ ÇáÍÕæá Úáì ãÚÑÖ ÔÎÕí',
	'apply' => 'ÊÎÒíä ÇáÊÚÏíáÇÊ',
	'create_new_group' => 'Êßæíä ãÌãæÚÉ ãÓÊÎÏãíä ÌÏíÏÉ',
	'del_groups' => 'ÇáÛÇÁ ÇáãÌãæÚÇÊ ÇáãÎÊÇÑÉ',
	'confirm_del' => 'ÊÍĞíÑ, ÚäÏãÇ ÊãÓÍ ãÌãæÚÉ, ÓíÊã äŞá ÇáãÓÊÎÏãíä İí åĞå ÇáãÌãæÚÉ Çáì ŞÇÆãÉ \'ÇáãÓÌáíä\' !\n\nåá ÊæÏ ÇÓÊßãÇá ÇáÚãáíÉ  ?',
	'title' => 'ÇÏÇÑÉ ãÌãæÚÇÊ ÇáãÓÊÎÏãíä',
	'approval_1' => 'ãæÇİŞÉ ÊÍãíá ÚÇãÉ (1)',
	'approval_2' => 'ãæÇİŞÉ ÊÍãíá ÚÇãÉ (2)',
	'note1' => '<strong>(1)</strong> ÇáÊÍãíá İí ÇáÇáÈæã ÇáÚÇã íÍÊÇÌ ãæÇİŞÉ ÇáãÏíÑ',
	'note2' => '<strong>(2)</strong> ÇáÊÍãíáÇÊ ÇáÊí íãßáåÇ ÇáãÓÊÎÏã ÊÍÊÇÌ ãæÇİŞÉ ÇáãÏíÑ',
	'notes' => 'ãáÇÍÙÇÊ'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){
$lang_index_php = array(
	'welcome' => 'ÃåÜáÇğ æÓÜåáÇğ Èß íÜÇ',
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'åá ÃäÊ ãÊÃßÏ áÃáÛÇÁ åĞå ÇáÕæÑÉ ? \\nAll pictures and comments will also be deleted.',
	'delete' => 'ÇáÛÇÁ ÇáÕæÑÉ',
	'modify' => 'ÊÍÏíË ÇáÃáÈæã',
	'edit_pics' => 'ÊÍÑíÑ ÇáÕæÑÉ',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<strong>[pictures]</strong> ÕæÑÉ İí <strong>[albums]</strong> ÇáÈæã æ <strong>[cat]</strong> ÊÕäíİÇÊ ãÚ <strong>[comments]</strong> ÊÚáíŞÇÊ ÔæåÏÊ <strong>[views]</strong> ãÑÉ',
	'stat2' => '<strong>[pictures]</strong> ÕæÑÉ İí <strong>[albums]</strong> ÇáÈæã æÔæåÏÊ <strong>[views]</strong> ãÑÉ',
	'xx_s_gallery' => 'ãÚÑÖ %s',
	'stat3' => '<strong>[pictures]</strong> ÕæÑÉ İí <strong>[albums]</strong> ÇáÈæã ãÚ <strong>[comments]</strong> ÊÚáíŞÇÊ ÔæåÏÊ <strong>[views]</strong> ãÑÉ'
);

$lang_list_users = array(
	'user_list' => 'ŞÇÆãÉ ÇáãÓÊÎÏãíä',
	'no_user_gal' => 'áÇ íæÌÏ ãÓÊÎÏãíä íãßä Çä íßæä áåã ÇáÈæãÇÊ',
	'n_albums' => '%s ÇáÈæã',
	'n_pics' => '%s ÕæÑÉ/ÕæÑ'
);

$lang_list_albums = array(
	'n_pictures' => '%s ÕæÑÉ',
	'last_added' => ', ÂÎÑ ÕæÑÉ ÇÖíİÊ İí %s'
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
	'upd_alb_n' => 'ÊÍÏíË ÇáÇáÈæã %s',
	'general_settings' => 'ÇÚÏÇÏÇÊ ÚÇãÉ',
	'alb_title' => 'ÚäæÇä ÇáÇáÈæã',
	'alb_cat' => 'ÊÕäíİ ÇáÇáÈæã',
	'alb_desc' => 'ÔÑÍ ÇáÇáÈæã',
	'alb_thumb' => 'äÈĞÉ ÇáÇáÈæã',
	'alb_perm' => 'ÕáÇÍíÇÊ ÇáÇáÈæã',
	'can_view' => 'ãÔÇåÏíä ÇáÇáÈæã åã',
	'can_upload' => 'ÇáÒæÇÑ íÓÊØíÚæä ÊÍãíá ÕæÑ',
	'can_post_comments' => 'ÇáÒæÇÑ íÓÊØíÚæä ÊÓÌíá ÊÚáíŞÇÊ',
	'can_rate' => 'ÇáÒæÇÑ íÓÊØíÚæä ÇáÊŞííã',
	'user_gal' => 'ÇáÈæã ÇáãÓÊÎÏãíä',
	'no_cat' => '* ÛíÑ ãÕäİ *',
	'alb_empty' => 'ÇáÇáÈæã İÇÑÛ',
	'last_uploaded' => 'ÂÎÑ ÊÍãíá',
	'public_alb' => 'ááÌãíÚ (ÇáÈæã ÚÇã)',
	'me_only' => 'áí İŞØ',
	'owner_only' => 'ãÇáß ÇáÇáÈæã (%s) İŞØ',
	'groupp_only' => 'ÇÚÖÇÁ ÇáãÌãæÚÉ \'%s\'',
	'err_no_alb_to_modify' => 'áÇ íæÌÏ ÇáÈæã ÊÓÊØíÚ ÊÚÏíáå İí ŞÇÚÏÉ ÇáÈíÇäÇÊ.',
	'update' => 'ÊÍÏíË ÇáÇáÈæã'
);
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'äÃÓİ áßä ßäÊ ŞÏ ŞíãÊ åĞå ÇáÕæÑÉ ãÓÈŞÇ',
	'rate_ok' => 'Êã ŞÈæá ÊŞííãß',
);
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
$lang_register_disclamer = <<<EOT
ÍíË Çä ãÏÑÇÁ ÇáãæŞÚ {SITE_NAME} ÓíŞæãæä ÈÊÚÏíá Çæ ÇáÛÇÁ ÇáÕæÑ ÇáÛíÑ ãÑÛæÈ İíåÇ, İãä ÇáÕÚÈ ãÑÇÌÚÉ ÌãíÚ ÇáÕæÑ. áĞÇ íÌÈ Úáíß ÇáÚáã Çä ÇáÕæÑ ÊãËá ÇÕÍÇÈåÇ İŞØ æáíÓ áåÇ ÚáÇŞÉ ÈÇáãÏÑÇÁ Ãæ ãÓÄæáíä ÇáÕİÍÉ (Çáì ÇĞÇ ŞÇãæ åã ÈĞáß) æÈÇáÊÇáí áä íÊÍãáæ ãÓÄæáíÉ Êáß ÇáÕæÑ.<br />
<br />
ÇäÊ ÊæÇİŞ Çäß áä ÊŞæã ÈÊÍãíá Çí ÕæÑ ãÑİæÖÉ, æŞÍÉ, ÎÇÑÌÉ Úä ÇááíÇŞÉ ÇáÚÇãÉ, ÊŞĞİ ÇáÛíÑ, ßÑÇåíÉ, ÊåÏÏ ÇáÛíÑ, ÌäÓíÉ Ãæ Çí ÕæÑ ÎÇÑÌÉ Úä äØÇŞ ÇáŞÇäæä. ÇäÊ ÊæÇİŞ Çä ãÓÄæá ÇáÕİÍÉ, ÇáãÏíÑ æÇáãÔÑİíä İí ÇáãæŞÚ {SITE_NAME} áåã ÇáÍŞ İí ÊÚÏíá æÇÒÇáÉ Çí ãÍÊæì İí Çí æŞÊ íÑæäå ãäÇÓÈÇ. æßãÇ ÊæÇİŞ Çä Êßæä ÇáÈíÇäÇÊ ÇáÊí ÊÏÎáåÇ Óæİ ÊÎÒä İí ŞÇÚÏÉ ÈíÇäÇÊ. æÍíË Çä åĞå ÇáãÚáæãÇÊ áä ÊÚáä áÔÎÕ ËÇáË Ïæä ãæÇŞŞÊß áä íÊÍãá ÇáãÓÄæá Çæ ãÏíÑ ÇáãæŞÚ Çí ÏÎæá ÊÎÑíÈí Úáì ÇáãæŞÚ íÊã Èå ãÚÑİÉ åĞå ÇáãÚáæãÇÊ.<br />
<br />
åĞÇ ÇáãæŞÚ íÓÊÚãá ÇáßæßíÒ áÊÎÒíä ÇáãÚáæãÇÊ Úáì ÌåÇÒß. åĞå ÇáßæßíÒ ÊÍÓä ãä ÇØáÇÚß Úáì ÇáÕæÑ İŞØ. æíÓÊÚãá ÇáÈÑíÏ ÇáÇáßÊÑæäí áÊÃßíÏ ÚãáíÉ ÊÓÌíáß æßáãÉ ÇáÓÑ.<br />
<br />
ÈÇáÖÛØ Úáì ÒÑ 'ÇæÇİŞ' Çä ÊæÇİŞ æÊáÒã ÈåĞå ÇáÔÑæØ.
EOT;

$lang_register_php = array(
	'page_title' => 'ÊÓÌíá ÇáãÓÊÎÏã',
	'term_cond' => 'ÇáÔÑæØ æÇáŞæÇÚÏ',
	'i_agree' => 'ÇæÇİŞ',
	'submit' => 'ÊÓÌíá ÇáØáÈ',
	'err_user_exists' => 'ÇáÇÓã ÇáĞí ÇÏÎáÊå ãæÌæÏ ãÓÈŞÇ, ÇáÑÌÇÁ ÇÓÊÎÏÇã ÇÓã ÂÎÑ',
	'err_password_mismatch' => 'ßáãÊí ÇáÓÑ áÇ íäØÈŞÇä¡ Úáíß ÇÏÎÇáåãÇ ãÑÉ ÇÎÑì',
	'err_uname_short' => 'íÌÈ Çä Êßæä ÇáßäíÉ Úáì ÇáÇŞá ÍÑİíä',
	'err_password_short' => 'íÌÈ Çä Êßæä ßáãÉ ÇáÓÑ Úáì ÇáÇŞá ÍÑİíä',
	'err_uname_pass_diff' => 'íÌÈ Çä Êßæä ÇáßäíÉ ãÎÊáİÉ Úä ßáãÉ ÇáÓÑ',
	'err_invalid_email' => 'ÇáÈÑíÏ ÇáÇáßÊÑæäí ÇáĞí ßÊÈÊå áÇ íÚãá',
	'err_duplicate_email' => 'ãÓÊÎÏã ÂÎÑ ãÓÌá áå äİÕ ÇáÈÑíÏ ÇáÇáßÊÑæäí',
	'enter_info' => 'ÇÏÎá ÈíÇäÇÊ ÇáÊÓÌíá',
	'required_info' => 'ãÚáæãÇÊ ãØáæÈÉ',
	'optional_info' => 'ãÚáæãÇÊ ÇÖÇİíÉ',
	'username' => 'ÇáßäíÉ',
	'password' => 'ßáãÉ ÇáÓÑ',
	'password_again' => 'ÇÚÏ ÇÏÎÇá ßáãÉ ÇáÓÑ',
	'email' => 'ÇáÈÑíÏ ÇáÇáßÊÑæäí',
	'location' => 'ÇáãßÇä',
	'interests' => 'ÇáÇåÊãÇãÇÊ',
	'website' => 'ÕİÍÊß',
	'occupation' => 'ÇáæÙíİÉ',
	'error' => 'ÎØÃ',
	'confirm_email_subject' => '%s - ÊÃßíÏ ÇáÊÓÌíá',
	'information' => 'ÈíÇäÇÊ',
	'failed_sending_email' => 'áã ÇÓÊØíÚ ÇÑÓÇá ÑÓÇáÉ ÊÃßíÏ ÇáÊÓÌíá !',
	'thank_you' => 'ÔßÑÇ Úáì ÇáÊÓÌíá.<br /><br />Êã ÇÑÓÇá ÈÑíÏ íæÖÍ ßíİíÉ ÊİÚíá ÇáÇÔÊÑÇß.',
	'acct_created' => 'Êã Êßæíä ÇÔÊÑÇßß æÊÓÊØíÚ ÇáÏÎæá ÈßäíÊß æßáãÉ ÇáÓÑ',
	'acct_active' => 'ÇÔÊÑÇßß İÚÇá ÇáÂä æÊÓÊØíÚ ÇáÏÎæá ÈßäíÊß æßáãÉ ÇáÓÑ',
	'acct_already_act' => 'ÇÔÊÑÇßß İÚÇá ãÓÈŞÇ !',
	'acct_act_failed' => 'áÇ íãßä ÊİÚíá åĞÇ ÇáÍÓÇÈ !',
	'err_unk_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'x_s_profile' => 'ÈíÇäÇÊ %s',
	'group' => 'ÇáãÌãæÚÉ',
	'reg_date' => 'ãÔÇÑß',
	'disk_usage' => 'ÇÓÊåáÇß ÇáÊÎÒíä',
	'change_pass' => 'ÊÛííÑ ßáãÉ ÇáÓÑ',
	'current_pass' => 'ßáãÉ ÇáÓÑ ÇáÍÇáíÉ',
	'new_pass' => 'ßáãÉ ÓÑ ÌÏíÏÉ',
	'new_pass_again' => 'ßáãÉ ÇáÓÑ ÇáÌÏíÏÉ ãÑÉ ÇÎÑì',
	'err_curr_pass' => 'ßáãÉ ÇáÓÑ ÇáÍÇáíÉ ÛíÑ ÕÍíÍÉ',
	'apply_modif' => 'ÊØÈíŞ ÇáÊÛííÑÇÊ',
	'change_pass' => 'ÛíÑ ßáãÉ ÇáÓÑ',
	'update_success' => 'Êã ÊÍÏíË ÈíÇäÇÊß',
	'pass_chg_success' => 'Êã ÊÛííÑ ßáãÉ ÇáÓÑ',
	'pass_chg_error' => 'áã ÊÊÛíÑ ßáãÉ ÇáÓÑ',
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

áÊİÚíá ÇáÍÓÇÈ Úáíß ÇáÖÛØ Úáì ÇáæÕáÉ ÈÇáÇÓİá
Çæ ÇäÓÎ æÇáÕŞ ÇáæÕáÉ İí ãÊÕİÍ ÇáÇäÊÑäÊ áÏíß.

{ACT_LINK}

Regards,

The management of {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'ãÑÇÌÚÉ ÇáÊÚáíŞÇÊ',
	'no_comment' => 'áÇ ÊÚáíŞÇÊ ááãÑÇÌÚÉ',
	'n_comm_del' => '%s ÊÚáíŞ ÇáÛí',
	'n_comm_disp' => 'ÚÏÏ ÇáÊÚáíŞÇÊ ÇáãÚÑæÖÉ',
	'see_prev' => 'ÇáÓÇÈŞ',
	'see_next' => 'ÇáÊÇáí',
	'del_comm' => 'ÇáÛÇÁ ÇáÊÚáíŞÇÊ ÇáãÎÊÇÑÉ',
);
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ÇÈÍË ãÌãæÚÉ ÇáÕæÑ',
);
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'ÇÈÍË ÇáÕæÑ ÇáÌÏíÏÉ',
	'select_dir' => 'ÇÎÊÑ ãÌáÏ',
	'select_dir_msg' => 'åĞå ÇáÚãáíÉ Êãßäß ãä ÇÖÇİÉ ßãíÉ ãä ÇáÕæÑ Êã ÊÍãíáåÇ ÈæÇÓØÉ FTP Çáì ÎÇÏã ÇáÕİÍÇÊ áÏíß.<br /><br />ÇÎÊÑ ÇáÏáíá ÍíË ŞãÊ ÈÚãáíÉ ÇáÊÍãíá ãÓÈŞÇ',
	'no_pic_to_add' => 'áÇ ÊæÌÏ ÕæÑÉ ÇÖíİåÇ',
	'need_one_album' => 'ÊÍÊÇÌ Úáì ÇáÇŞá ÇáÈæãÇ æÇÍÏÇ áåĞå ÇáÚãáíÉ',
	'warning' => 'ÊÍĞíÑ',
	'change_perm' => 'áÇ íÓÊØíÚ ÇáÈÑäÇãÌ ÇáÊÎÒíä İí åĞÇ ÇáÏáíá, ÊÍÊÇÌ ÊÛííÑ ÕáÇÍíÇÊ ÇáÏáíá Çáì 755 Çæ 777 ŞÈá ÇÖÇİÉ ÇáÕæÑ !',
	'target_album' => '<strong>ÖÚ ÕæÑ &quot;</strong>%s<strong>&quot; İí </strong>%s',
	'folder' => 'ãÌáÏ',
	'image' => 'ÕæÑÉ',
	'album' => 'ÇáÈæã',
	'result' => 'äÊíÌÉ',
	'dir_ro' => 'ÛíÑ ŞÇÈá ááÊÎÒíä. ',
	'dir_cant_read' => 'ÛíÑ ŞÇÈá ááŞÑÇÁÉ. ',
	'insert' => 'ÇÖÇİÉ ÕæÑ ÌÏíÏÉ ááãÚÑÖ',
	'list_new_pic' => 'ŞÇÆãÉ ÇáÕæÑ ÇáÌÏíÏÉ',
	'insert_selected' => 'ÊÎÒíä ÇáÕæÑ ÇáãÎÊÇÑÉ',
	'no_pic_found' => 'áÇ ÊæÌÏ ÕæÑ ÌÏíÏÉ',
	'be_patient' => 'ÇáÑÌÇÁ ÇáÕÈÑ¡ ÍíË íÍÊÇÌ ÇáÈÑäÇãÌ áÈÚÖ ãä ÇáæŞÊ áÇÖÇİÉ ÇáÕæÑ',
	'notes' =>  '<ul>'.
				'<li><strong>OK</strong> : íÚäí Çäå Êã ÇÖÇİÉ ÇáÕæÑ ÈäÌÇÍ'.
				'<li><strong>DP</strong> : íÚäí Çä ÇáÕæÑÉ ãßÑÑÉ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ æåí ãæÌæÏÉ İÚáÇ'.
				'<li><strong>PB</strong> : ÊÚäí Çääí áã ÇÊãßä ãä ÇÖÇİÉ ÇáÕæÑÉ, ÊÃßÏ ãä ÇáÇÚÏÇÏÇÊ æãä ÕáÇÍíÇÊß İí ÊÎÒíä ÇáÕæÑÉ İí åĞÇ ÇáãÌáÏ'.
				'<li>ÇĞÇ ßÇä ÇáÑãÒ OK, DP, PB áÇ íÙåÑ ÇÖÛØ Úáì ÇáæÕáÉ ÇáãßÓæÑÉ áãÚÑİÉ ÓÈÈ ÚÏã ÙåæÑåÇ PHP'.
				'<li>Çä áã íÑÏ Úáì ÇáãÊÕİÍ ÈÚÏ æŞÊ ßÇİ, ÇÖÛØ Úáì ÒÑ ÇÚÇÏÉ ÊÍãíá ÇáÕİÍÉ'.
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
	'title' => 'ÊÍãíá ÕæÑÉ',
	'max_fsize' => 'ÇßÈÑ ÍÌã áãáİ ÇáÕæÑÉ åæ %s ßíáæ ÈÇíÊ',
	'album' => 'ÇáÈæã',
	'picture' => 'ÕæÑÉ',
	'pic_title' => 'ÚäæÇä ÕæÑÉ',
	'description' => 'ÔÑÍ ÇáÕæÑÉ',
	'keywords' => 'ßáãÇÊ ÈÍË (ÇİÕá ÈíäåãÇ ÈãÓÇİÉ)',
	'err_no_alb_uploadables' => 'äÃÓİ áßä áÇ íæÌÏ ÇáÈæã ÊÓÊØíÚ ÊÍãíá ÇáÕæÑ Çáíå',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ÇÏÇÑÉ ÇáãÓÊÎÏãíä',
	'name_a' => 'ÊÕÇÚÏí ÍÓÈ ÇáÇÓã',
	'name_d' => 'ÊäÇÒáí ÍÓÈ ÇáÇÓã',
	'group_a' => 'ÊÕÇÚÏí ÍÓÈ ÇáãÌãæÚÉ',
	'group_d' => 'ÊäÇÒáí ÍÓÈ ÇáãÌãæÚÉ',
	'reg_a' => 'ÊÕÇÚÏí ÍÓÈ ÊÇÑíÎ ÇáÊÓÌíá',
	'reg_d' => 'ÊäÇÒáí ÍÓÈ ÊÇÑíÎ ÇáÊÓÌíá',
	'pic_a' => 'ÊÕÇÚÏí ÍÓÈ ÚÏ ÇáÕæÑ',
	'pic_d' => 'ÊäÇÒáí ÍÓÈ ÚÏ ÇáÕæÑ',
	'disku_a' => 'ÊÕÇÚÏí ÍÓÈ ãÓÇÍÉ ÇáÊÎÒíä',
	'disku_d' => 'ÊäÇÒáí ÍÓÈ ãÓÇÍÉ ÇáÊÎÒíä',
	'sort_by' => 'ÑÊÈ ÇáãÓÊÎÏãíä ÍÓÈ',
	'err_no_users' => 'ÌÏæá ÇáãÓÊÎÏã İÇÑÛ !',
	'err_edit_self' => 'áÇ ÊÓÊØíÚ ÊÚÏíá ÈíÇäÇÊß ÇáÎÇÕÉ, ÇÓÊÚãá ÒÑ \'ÈíÇäÇÊí\' áĞáß',
	'edit' => 'ÊÚÏíá',
	'delete' => 'ÇáÛÇÁ',
	'name' => 'ÇÓã ÇáãÓÊÎÏã',
	'group' => 'ÇáãÌãæÚÉ',
	'inactive' => 'ãÚØá',
	'operations' => 'ÇáÚãáíÇÊ',
	'pictures' => 'ÇáÕæÑ',
	'disk_space' => 'ãÓÇÍÉ ÇáÊÎÒíä ÇáãÓãæÍÉ / ßæÊÇ',
	'registered_on' => 'Êã ÊÓÌíáå İí',
	'u_user_on_p_pages' => '%d ãÓÊÎÏã İí %d ÕİÍÉ/ÕİÍÇÊ',
	'confirm_del' => 'åá ÇäÊ ãÊÃßÏ ãä ÇáÛÇÁ åĞÇ ÇáãÓÊÎÏã ? \\nßá ÕæÑå æÇáÈæãÇÊå Óæİ ÊáÛì.',
	'mail' => 'ÈÑíÏ',
	'err_unknown_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'modify_user' => 'ÊÛííÑ ÇáãÓÊÎÏã',
	'notes' => 'ãáÇÍÙÇÊ',
	'note_list' => '<li>Çä áã ÊÑíÏ ÊÛííÑ ßáãÉ ÇáÓÑ, ÇÊÑß ãÑÈÚ ßáãÉ ÇáÓÑ İÇÑÛÇ',
	'password' => 'ßáãÉ ÇáÓÑ',
	'user_active_cp' => 'ÇáãÓÊÎÏã ãÚØá',
	'user_group_cp' => 'ãÌãæÚÉ ÇáãÓÊÎÏãíä',
	'user_email' => 'ÈÑíÏ ÇáãÓÊÎÏã',
	'user_web_site' => 'ÕİÍÉ ÇáãÓÊÎÏã',
	'create_new_user' => 'Êßæíä ãÓÊÎÏã ÌÏíÏ',
	'user_from' => 'ãæŞÚ ÇáãÓÊÎÏã',
	'user_interests' => 'ÇåÊãÇãÇÊ ÇáãÊÓÎÏã',
	'user_occ' => 'æÙíİÉ ÇáãÓÊÎÏã',
);
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'ÊÛííÑ ŞíÇÕ ÇáÕæÑÉ',
        'what_it_does' => 'ãÇĞÇ ÊÚãá',
        'what_update_titles' => 'ÊÍÏíË ÇáÚäÇæíä ãä ÇÓãÇÁ ÇáãáİÇÊ',
        'what_delete_title' => 'ÇáÛÇÁ ÇáÚäÇæíä',
        'what_rebuild' => 'íÚÈÏ ÈäÇÁ ãÎÊÕÑÇÊ ÇáÕæÑ æíÚíÏ ŞíÇÓ ÇáÕæÑ',
        'what_delete_originals' => 'íáÛí ÇáÕæÑ ÇáãÚÇÏ ŞíÇÓåÇ ÇáÇÕáíÉ æ íÓÊÈÏáåã ÈÕæÑ ãÚÇÏ ŞíÇÓåÇ',
        'file' => 'ãáİ',
        'title_set_to' => 'ÇáÚäæÇä ãÍÏÏ Çáì',
        'submit_form' => 'ÓÌá',
        'updated_succesfully' => 'Êã ÊÍÏíËå ÈäÌÇÍ',
        'error_create' => 'ÎØÃ İí Êßæíä',
        'continue' => 'ãÚÇáÌÉ ÇáãÒíÏ ãä ÇáÕæÑ',
        'main_success' => 'Çáãáİ %s Êã ÇÓÊÚãÇáå ßÇáÕæÑÉ ÇáÑÆíÓíÉ',
        'error_rename' => 'ÎØÃ İí ÊÛííÑ ÇáÇÓã %s Çáì %s',
        'error_not_found' => 'Çáãáİ %s ÛíÑ ãæÌæÏ',
        'back' => 'ÇáÑÌæÚ Çáì ÇáÑÆíÓíÉ',
        'thumbs_wait' => 'ÊÍÏíË ãÎÊÕÑÇÊ ÇáÕæÑ æ/Çæ ÇáÕæÑ ÇáãÚÇÏ ŞíÇÓåÇ, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'thumbs_continue_wait' => 'ãÓÊãÑ İí ÊÍÏíË ãÎÊÕÑÇÊ ÇáÕæÑ Çæ/æ ÇáÕæÑ ÇáãÚÇÏ ŞíÇÓåÇ...',
        'titles_wait' => 'ÊÍÏíË ÇáÚäÇæíä, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'delete_wait' => 'ÇáÛÇÁ ÇáÚäÇæíä, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'replace_wait' => 'íÊã ÇáÛÇÁ ÇáÕæÑ ÇáÇÕáíÉ æíÊã ÇÓÊÈÏÇáå ÈÇÎÑì ãÚÇÏ ŞíÇÓåÇ, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ..',
        'instruction' => 'ÊÚáíãÇÊ ÓÑíÚÉ',
        'instruction_action' => 'ÇÎÊÇÑ ÚãáíÉ',
        'instruction_parameter' => 'ÊÍÏíÏ ÇáãÊÛíÑÇÊ',
        'instruction_album' => 'ÇÎÊÑ ÇáÇáÈæã',
        'instruction_press' => 'ÇÖÛØ Úáì %s',
        'update' => 'ÊÍÏíË ÇáãÎÊÕÑÇÊ æ/Ãæ ÇÚÇÏÉ ÊŞííÓ ÇáÕæÑ',
        'update_what' => 'ãÇĞÇ íÌÈ ÊÍÏíËå',
        'update_thumb' => 'ãÎÊÕÑÇÊ ÇáÕæÑ İŞØ',
        'update_pic' => 'ÇáÕæÑ ÇáãÚÇÏ ŞíÇÓåÇ İŞØ',
        'update_both' => 'ÇáÕæÑ ÇáãÎÊÕÑÉ æÇáãÚÇÏ ŞíÇÓåÇ ãÚÇ',
        'update_number' => 'ÚÏÏ ÇáÕæÑ ÇáãÚÇáÌÉ ÈÇáÖÛØÉ',
        'update_option' => '(ÍÇá ÇáÊŞáíá ãä åĞÇ ÇáÇÚÏÇÏ Çä æÇÌåÊ ãÔÇßá ÇäÊåÇÁ ÇáæŞÊ)',
        'filename_title' => 'ÇÓã Çáãáİ &rArr; ÚäæÇä ÇáÕæÑÉ',
        'filename_how' => 'ßíİíÉ ÊÛííÑ ÇÓã Çáãáİ',
        'filename_remove' => 'ÇÒÇáÉ äåÇíÉ .jpg æ ÇÓÊÈÏÇá _ (ÔÑØÉ ÓİáíÉ) ÈÇáãÓÇİÇÊ',
        'filename_euro' => 'ÛíÑ 2003_11_23_13_20_20.jpg Çáì 23/11/2003 13:20',
        'filename_us' => 'íÛíÑ  2003_11_23_13_20_20.jpg Çáì  11/23/2003 13:20',
        'filename_time' => 'íÛíÑ  2003_11_23_13_20_20.jpg Çáì 13:20',
        'delete' => 'íáÛí ÚäÇæíä ÇáÕæÑ Çæ ÕæÑ ÇáŞíÇÓ ÇáÇÕáíÉ',
        'delete_title' => 'ÇáÛí ÚäÇæíä ÇáÕæÑ',
        'delete_original' => 'ÇáÛí ÕæÑ ÇáŞíÇÓ ÇáÇÕáíÉ',
        'delete_replace' => 'íáÛí ÇáÕæÑ ÇáÇÕáíÉ æíÓÊÈÏáåã ÈÇÎÑì ÈŞíÇÓ ãÎÊáİ',
        'select_album' => 'ÇÎÊÇÑ ÇáÇáÈæã',
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