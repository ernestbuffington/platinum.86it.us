<?php
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1c for CMS     2007.09.05                   //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>              //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.pcnuke.com                                                    //
// Website for Port Upgrades from 1.3.0 and up...                           //
// ------------------------------------------------------------------------ //
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
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('DB_INPUT_PHP', true);
require("modules/" . $name . "/include/load.inc");
require($CPG_M_DIR . '/include/picmgmt.inc');
//require($CPG_M_DIR . '/include/mailer.inc.php');
global $username, $gifsupport;
// Check for GIF create support >= GD v2.0.28
$gifsupport = 0;
if ($CONFIG['thumb_method'] == 'gd2') {
    $gdinfo = gd_info();
    $gifsupport = $gdinfo["GIF Create Support"];
}
function check_comment(&$str)
{
    global $CONFIG, $lang_bad_words, $queries;
    $ercp = array('/\S{' . ($CONFIG['max_com_wlength'] + 1) . ',}/i');
    if ($CONFIG['filter_bad_words']) foreach($lang_bad_words as $word) {
        $ercp[] = '/' . ($word[0] == '*' ? '': '\b') . str_replace('*', '', $word) . ($word[(strlen($word)-1)] == '*' ? '': '\b') . '/i';
    } 
    if (strlen($str) > $CONFIG['max_com_size']) $str = substr($str, 0, ($CONFIG['max_com_size'] -3)) . '...';
    $str = preg_replace($ercp, '(...)', $str);
} 
if (!isset($_GET['event']) && !isset($_POST['event'])) {
    cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
} 
$event = isset($_POST['event']) ? $_POST['event'] : $_GET['event'];
switch ($event) {
    // Comment update
    case 'comment_update':
        if (!(USER_CAN_POST_COMMENTS)) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        check_comment($_POST['msg_body']);
        check_comment($_POST['msg_author']);
        $msg_body = trim($_POST['msg_body']);
        $msg_author = trim($_POST['msg_author']);
//        $msg_body = addslashes(trim($_POST['msg_body']));
//        $msg_author = addslashes(trim($_POST['msg_author']));
        $msg_body = (get_magic_quotes_gpc() ? $msg_body : addslashes($msg_body));
        $msg_author  = (get_magic_quotes_gpc() ? $msg_author  : addslashes($msg_author));
        $msg_id = (int)$_POST['msg_id'];
        if ($msg_body == '') cpg_die(ERROR, $lang_db_input_php['err_comment_empty'], __FILE__, __LINE__);
        if (GALLERY_ADMIN_MODE) {
            $update = db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET msg_body='$msg_body', msg_author='$msg_author' WHERE msg_id='$msg_id'");
        } elseif (USER_ID) {
            $update = db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET msg_body='$msg_body', msg_author='$msg_author' WHERE msg_id='$msg_id' AND author_id ='" . USER_ID . "' LIMIT 1");
        } else {
            $update = db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET msg_body='$msg_body', msg_author='$msg_author' WHERE msg_id='$msg_id' AND author_md5_id ='{$USER['ID']}' AND author_id = '0' LIMIT 1");
        } 
        $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
        $result = db_query("SELECT pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id'");
        if (!mysql_num_rows($result)) {
            mysql_free_result($result);
            $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . $CPG_M_URL);
            pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
            msg_box($lang_info, $lang_db_input_php['redirect_msg'], $lang_db_input_php['continue'], $redirect);
            pagefooter();
        } else {
            $comment_data = mysql_fetch_array($result);
            mysql_free_result($result);
            $redirect = $CPG_URL . "&file=displayimage&pos=" . (- $comment_data['pid']);
            header($header_location . $redirect);
            pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
            msg_box($lang_info, $lang_db_input_php['redirect_msg'], $lang_db_input_php['continue'], $redirect);
            pagefooter();
        }
        break;
    // Comment
    case 'comment':
        if (!(USER_CAN_POST_COMMENTS)) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        check_comment($_POST['msg_body']);
        $msg_author = trim($_POST['msg_author']);
        $msg_body = trim($_POST['msg_body']);
//        $msg_author = addslashes(trim($_POST['msg_author']));
//        $msg_body = addslashes(trim($_POST['msg_body']));
        $msg_body = (get_magic_quotes_gpc() ? $msg_body : addslashes($msg_body));
        if (USER_ID == 1) {
        $msg_author  = (get_magic_quotes_gpc() ? '*A*'.$msg_author  : addslashes('*A*'.$msg_author));
        }else{
        $msg_author  = (get_magic_quotes_gpc() ? $msg_author  : addslashes($msg_author));
        }
		$pid = (int)$_POST['pid'];
        if ($msg_author == '' || $msg_body == '') cpg_die(ERROR, $lang_db_input_php['empty_name_or_com'], __FILE__, __LINE__);
        $result = db_query("SELECT comments FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND pid='$pid'");
        if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        $album_data = mysql_fetch_array($result);
        mysql_free_result($result);
        if ($album_data['comments'] != 'YES') cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        $result = db_query("SELECT author_md5_id, author_id FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid = '$pid' ORDER BY msg_id DESC LIMIT 1");
        if (mysql_num_rows($result)) {
            $last_com_data = mysql_fetch_array($result);
            if ((USER_ID && $last_com_data['author_id'] == USER_ID) || (!USER_ID && $last_com_data['author_md5_id'] == $USER['ID'])) {
                if (!$CONFIG['disable_flood_protection']) {
                    cpg_die(ERROR, $lang_db_input_php['no_flood'], __FILE__, __LINE__);
                } 
            } 
        } 
        if (USER_ID == 1) { // Anonymous users, we need to use META refresh to save the cookie
            $insert = db_query("INSERT INTO {$CONFIG['TABLE_COMMENTS']} (pid, msg_author, msg_body, msg_date, author_md5_id, author_id, msg_raw_ip, msg_hdr_ip) VALUES ('$pid', '$msg_author', '$msg_body', NOW(), '{$USER['ID']}', '0', '$raw_ip', '$hdr_ip')");
            $USER['name'] = $_POST['msg_author'];
            $redirect = $CPG_URL . "&file=displayimage&pos=" . (- $pid);
            if ($CONFIG['comment_email_notification']) {
                $mail_body = $msg_body . "\n\r See it at http://" . $_SERVER["SERVER_NAME"] . "/" . $redirect;
                cpg_mail($CONFIG['gallery_admin_email'], $lang_db_input_php['email_comment_subject'], $mail_body);
            } 
            pageheader($lang_db_input_php['com_added'], "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
            msg_box($lang_db_input_php['info'], $lang_db_input_php['com_added'], $lang_continue, $redirect);
            pagefooter();
        } else { // Registered users, we can use Location to redirect
            $insert = db_query("INSERT INTO {$CONFIG['TABLE_COMMENTS']} (pid, msg_author, msg_body, msg_date, author_md5_id, author_id, msg_raw_ip, msg_hdr_ip) VALUES ('$pid', '" . addslashes(CPG_USERNAME) . "', '$msg_body', NOW(), '', '" . USER_ID . "', '$raw_ip', '$hdr_ip')");
            $redirect = $CPG_URL . "&file=displayimage&pos=" . (- $pid);
            if ($CONFIG['comment_email_notification']) {
                $mail_body = $msg_body . "\n\r See it at http://" . $_SERVER["SERVER_NAME"] . "/" . $redirect;
                require("includes/class.phpmailer.php");
                            $mail = new PHPMailer();
                            $mail->SetLanguage();
                            $mail->From     = $CONFIG['gallery_admin_email'];
                            $mail->AddAddress($CONFIG['gallery_admin_email']);
                            $mail->Priority = 3;
                            $mail->Encoding = "8bit";
                            $mail->CharSet = CHARSET;
                            $mail->Subject = $lang_db_input_php['email_comment_subject'];
                            $mail->Body    = $mail_body;
                            $mail->IsMail();
                            if (!$mail->Send()) {
                                cpg_die(ERROR, $mailer_mesage, __FILE__, __LINE__);
                            }
                                //cpg_mail($CONFIG['gallery_admin_email'], $lang_db_input_php['email_comment_subject'], $mail_body);
            } 
            $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . $redirect);
            pageheader($lang_db_input_php['com_added'], "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
            msg_box($lang_db_input_php['info'], $lang_db_input_php['com_added'], $lang_continue, $redirect);
            pagefooter();
        }
        break;
    // Update album
    case 'album_update':
        if (!(USER_ADMIN_MODE || GALLERY_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        //$aid = (int)$_POST['aid'];
        $aid = intval($_POST['aid']);
        $title = trim($_POST['title']);
//        $title = addslashes(trim($_POST['title']));
        $category = (int)$_POST['category'];
        $category = intval($_POST['category']);
        $description = trim($_POST['description']);
//        $description = addslashes(trim($_POST['description']));
        //$thumb = (int)$_POST['thumb'];
        //$visibility = (int)$_POST['visibility'];
        $thumb = intval($_POST['thumb']);
        $visibility = intval($_POST['visibility']);
        $uploads = $_POST['uploads'] == 'YES' ? 'YES' : 'NO';
        $comments = $_POST['comments'] == 'YES' ? 'YES' : 'NO';
        $votes = $_POST['votes'] == 'YES' ? 'YES' : 'NO';
        if (!$title) cpg_die(ERROR, $lang_db_input_php['alb_need_title'], __FILE__, __LINE__);
        if (GALLERY_ADMIN_MODE) {
            $query = "UPDATE {$CONFIG['TABLE_ALBUMS']} SET title='$title', description='$description', category='$category', thumb='$thumb', uploads='$uploads', comments='$comments', votes='$votes', visibility='$visibility' WHERE aid='$aid' LIMIT 1";
        } else {
            $category = FIRST_USER_CAT + USER_ID;
            if ($visibility != $category && $visibility != $USER_DATA['group_id']) $visibility = 0; //not in 1.2.0
            $query = "UPDATE {$CONFIG['TABLE_ALBUMS']} SET title='$title', description='$description', thumb='$thumb',  comments='$comments', votes='$votes', visibility='$visibility' WHERE aid='$aid' AND category='$category' LIMIT 1";
        } 
        $update = db_query($query);
        if (isset($CONFIG['debug_mode']) && ($CONFIG['debug_mode'] == 1)) {
            $queries[] = $query;
        } 
        if (!mysql_affected_rows()) cpg_die(INFORMATION, $lang_db_input_php['no_udp_needed'], __FILE__, __LINE__);
//        if ($CONFIG['debug_mode'] == 0) {
            pageheader($lang_db_input_php['alb_updated'], "<META http-equiv=\"refresh\" content=\"1;url=" . $CPG_URL . "&amp;file=modifyalb&amp;album=$aid\">");
//        }
        msg_box($lang_db_input_php['info'], $lang_db_input_php['alb_updated'], $lang_continue, $CPG_URL . "&amp;file=modifyalb&amp;album=$aid");
        pagefooter();
        break;
    // Picture upload
    case 'picture':
        if (!USER_CAN_UPLOAD_PICTURES) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        $album = intval($_POST['album']);
        if( ! get_magic_quotes_gpc())
        {
        	$title = addslashes($title);
        	$caption = addslashes($caption);
        	$keywords = addslashes($keywords);
        	$user1 = addslashes($user1);
        	$user2 = addslashes($user2);
        	$user3 = addslashes($user3);
        	$user4 = addslashes($user4);
        }
        // Check if the album id provided is valid
        if (!GALLERY_ADMIN_MODE) {
            $result = db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album' and (uploads = 'YES' OR category = '" . (USER_ID + FIRST_USER_CAT) . "')");
            if (mysql_num_rows($result) == 0)cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
            $row = mysql_fetch_array($result);
            mysql_free_result($result);
            $category = $row['category'];
        } else {
            $result = db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
            if (mysql_num_rows($result) == 0)cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
            $row = mysql_fetch_array($result);
            mysql_free_result($result);
            $category = $row['category'];
        } 
        // Test if the filename of the temporary uploaded picture is empty
        if ($HTTP_POST_FILES['userpicture']['tmp_name'] == '') cpg_die(ERROR, $lang_db_input_php['no_pic_uploaded'], __FILE__, __LINE__); 
        // Pictures are moved in a directory named 10000 + USER_ID
        if (USER_ID && !defined('SILLY_SAFE_MODE')) {
            $filepath = $CONFIG['userpics'] . (USER_ID + FIRST_USER_CAT); 
            // $dest_dir = $CONFIG['fullpath'].$filepath;
            $dest_dir = $filepath;
            if (!is_dir($dest_dir)) {
                mkdir($dest_dir, octdec($CONFIG['default_dir_mode']));
                if (!is_dir($dest_dir)) cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_mkdir'], $dest_dir), __FILE__, __LINE__, true);
                chmod($dest_dir, octdec($CONFIG['default_dir_mode']));
                $fp = fopen($dest_dir . '/index.html', 'w');
                fwrite($fp, ' ');
                fclose($fp);
            } 
            $dest_dir .= '/';
            $filepath .= '/';
        } else {
            $filepath = $CONFIG['userpics'];
            $dest_dir = $filepath;
        } 
        // Check that target dir is writable
        if (!is_writable($dest_dir)) cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['dest_dir_ro'], $dest_dir), __FILE__, __LINE__, true); 
        // Replace forbidden chars with underscores
        $matches = array();
        $forbidden_chars = strtr($CONFIG['forbiden_fname_char'], array('&amp;' => '&', '&quot;' => '"', '&lt;' => '<', '&gt;' => '>')); 
        // Check that the file uploaded has a valid extension
        if (get_magic_quotes_gpc()) $HTTP_POST_FILES['userpicture']['name'] = stripslashes($HTTP_POST_FILES['userpicture']['name']);
        $picture_name = strtr($HTTP_POST_FILES['userpicture']['name'], $forbidden_chars, str_repeat('_', strlen($CONFIG['forbiden_fname_char'])));
        if (!preg_match("/(.+)\.(.*?)\Z/", $picture_name, $matches)) {
            $matches[1] = 'invalid_fname';
            $matches[2] = 'xxx';
        } 
        if ($matches[2] == '' || !stristr($CONFIG['allowed_file_extensions'], $matches[2])) {
            cpg_die(ERROR, sprintf($lang_db_input_php['err_invalid_fext'], $CONFIG['allowed_file_extensions']), __FILE__, __LINE__);
        } 
        // Create a unique name for the uploaded file
        $nr = 0;
        $picture_name = $matches[1] . '.' . $matches[2];
        while (file_exists($dest_dir . $picture_name)) {
            $picture_name = $matches[1] . '~' . $nr++ . '.' . $matches[2];
        } 
        $uploaded_pic = $dest_dir . $picture_name; 
        // Move the picture into its final location
        if (!move_uploaded_file($HTTP_POST_FILES['userpicture']['tmp_name'], $uploaded_pic))
            cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_move'], $picture_name, $dest_dir), __FILE__, __LINE__, true);
        // Change file permission
        chmod($uploaded_pic, octdec($CONFIG['default_file_mode']));
        // Get picture information
        if(($imginfo = @getimagesize($uploaded_pic)) == null)
        {
            @unlink($uploaded_pic);
            cpg_die(ERROR, $lang_db_input_php['err_invalid_img'], __FILE__, __LINE__);
        }
        // Check that picture size (in pixels) is lower than the maximum allowed
        if (max($imginfo[0], $imginfo[1]) > $CONFIG['max_upl_width_height']) {
            $max = intval($CONFIG['max_upl_width_height']);
            // Check we have enough memory to resize - diegocr
            $php_memory_limit = (intval(ini_get('memory_limit'))<<20);
            $php_memory_room = (2<<20);
            $php_used_memory = memory_get_usage();
            $required_memory = $imginfo[0] * $imginfo[1] * ($imginfo[bits] / 8) * $imginfo[channels];
            $free_memory = $php_memory_limit - $php_used_memory - $php_memory_room;
            if( $free_memory > $required_memory )
            	$can_resize = true;
            else
            	$can_resize = false;
            if( $can_resize == true )
            {
            	/**
            	 * Me (diegocr) with help from TCBnc at www.pcnuke.com discovered
            	 * some kind of BUG at ** PHP 5.2.5 ** where "big" images cannot 
            	 * be resized using GD, even when enough free memory is found!
            	 * 
            	 * eg: to resize a 2048x1536 (24 Bits) JPEG Image the requiered 
            	 *     memory is around 9MB - under PHP 5.2.5 it will fail always
            	 *     even when you have eg 40MB for memory_limit !
            	 * 
            	 *  Could someone out there let us know where the real bug is?..
            	 * 
            	 * $Id: php5workaround,v 0.1 2008/03/22 21:24:48 diegocr Exp $
            	 */
   ////
   // Please tell us if you noticed this issue on a PHP Version other
   // than 5.2.5 !! write to diegocr [at] users.sf.net or post a msg at 
   // www.pcnuke.com - Thanks!
   ////
            	if(( $max > 2047 ) AND ( phpversion() == '5.2.5'))
            		$can_resize = false;
            }
            // die if unable to resize - diegocr
            if( $can_resize == false )
            {
            	@unlink($uploaded_pic);
            	cpg_die(ERROR, sprintf($lang_db_input_php['err_fsize_too_large'], $CONFIG['max_upl_width_height'], $CONFIG['max_upl_width_height']), __FILE__, __LINE__);
            }
            // Check that picture file size is lower than the maximum allowed
        } else {
            //$max = max($imginfo[0], $imginfo[1]);
            /// Resizing isn't required! (and you save EXIF data of original image) - diegocr
        }
        $max = intval($max);
        if(($max > 0) AND ($can_resize == true))
        { /// resize_image() modified (at picmgmt.inc) to save TWO getimagesize() calls - diegocr
           if (!resize_image($uploaded_pic, $uploaded_pic, $max, $CONFIG['thumb_method'], '', $imginfo, false)) {
              @unlink($uploaded_pic);
              cpg_die(ERROR, "This is not a image or image has errors", __FILE__, __LINE__);
           }
        }
        if (filesize($uploaded_pic) > ($CONFIG['max_upl_size'] << 10)) {
            @unlink($uploaded_pic);
            cpg_die(ERROR, sprintf($lang_db_input_php['err_imgsize_too_large'], $CONFIG['max_upl_size']), __FILE__, __LINE__); 
            // getimagesize does not recognize the file as a picture
        } elseif (($imginfo = getimagesize($uploaded_pic)) == null) {
            @unlink($uploaded_pic);
            cpg_die(ERROR, $lang_db_input_php['err_invalid_img'], __FILE__, __LINE__, true); 
            // JPEG and PNG only are allowed with GD
            // implement gd_info GIF Read Support here
        } elseif ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && ($CONFIG['thumb_method'] == 'gd1' || ($CONFIG['thumb_method'] == 'gd2' && !$gifsupport))) {
            @unlink($uploaded_pic);
            cpg_die(ERROR, $lang_errors['gd_file_type_err'], __FILE__, __LINE__, true); 
            // Check image type is among those allowed for ImageMagick
        } elseif ($CONFIG['thumb_method'] == 'im' && !stristr($CONFIG['allowed_img_types'], $IMG_TYPES[$imginfo[2]])) {
            @unlink($uploaded_pic);
            cpg_die(ERROR, sprintf($lang_db_input_php['allowed_img_types'], $CONFIG['allowed_img_types']), __FILE__, __LINE__);
        } else {
            // Create thumbnail and intermediate image and add the image into the DB
            $result = add_picture($album, $filepath, $picture_name, $title, $caption, $keywords, $user1, $user2, $user3, $user4, $category);
            if (!$result) {
                @unlink($uploaded_pic);
                cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_insert_pic'], $uploaded_pic) . '<br /><br />' . $ERROR, __FILE__, __LINE__, true);
            } elseif ($PIC_NEED_APPROVAL) {
                pageheader($lang_info);
                msg_box($lang_info, $lang_db_input_php['upload_success'], $lang_continue, $CPG_M_URL);
                pagefooter();
            } else {
                $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
                $redirect = $CPG_URL . "&file=displayimage&pos=" . (- mysql_insert_id());
                header($header_location . $redirect);
                pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
                msg_box($lang_info, $lang_db_input_php['upl_success'], $lang_continue, $redirect);
                pagefooter();
            }
        } 
        break;
    // Unknown event
    default:
        cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
} 
?>
