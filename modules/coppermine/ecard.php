<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.1D for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('ECARDS_PHP', true);
require("modules/" . $name . "/include/load.inc");
if (!USER_CAN_SEND_ECARDS) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
// ecard security fix
// $max_anon_ecards = (!isset($_COOKIE['ecard'])?1:($_COOKIE['ecard']);
$max_anon_ecards = 1;
// if (!isset($_COOKIE['ecard'])){
if (($_COOKIE['ecard'] != 0) && (USER_ID != 1)) {
    setcookie('ecard', $max_anon_ecards); //,time()+60*60*24,'/'
} 
// }
require("includes/nbbcode.php");
//require($CPG_M_DIR . "/include/mailer.inc.php");
/*
function get_post_var($name, $default = '')
{
    global $_POST;
    return isset($_POST[$name]) ? $_POST[$name] : $default;
} 
*/
$pid = intval($_GET['pid']);
$album = $_GET['album'];
$pos = intval($_GET['pos']);
$thisalbum= "a.aid = $album";
//$sender_name = get_post_var('sender_name', USER_ID ? CPG_USERNAME : (isset($USER['name']) ? $USER['name'] : ''));
//$sender_email = get_post_var('sender_email', USER_ID ? $USER_DATA[$field_user_email] : (isset($USER['email']) ? $USER['email'] : ''));
$sender_name = $_POST['sender_name'] ? $_POST['sender_name'] : (isset($USER['name']) ? $USER['name'] : '');
$sender_email = $_POST['sender_email']? $_POST['sender_email'] : (isset($USER['email']) ? $USER['email'] : '');
$recipient_name = $_POST['recipient_name'];
$recipient_email = $_POST['recipient_email'];
$greetings = $_POST['greetings'];
$message = $_POST['message'];
$sender_email_warning = '';
$recipient_email_warning = '';
$result = mysql_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON visibility IN (0,".USER_IN_GROUPS.") WHERE pid='$pid' GROUP BY pid");
if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_errors['non_exist_ap']);
$row = mysql_fetch_array($result);
$thumb_pic_url = get_pic_url($row, 'thumb');
// Check supplied email address
$valid_email_pattern = "^[_\.0-9a-z\-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$";
$valid_sender_email = preg_match('#'.preg_quote($valid_email_pattern).'#i', $sender_email);
$valid_recipient_email = preg_match('#'.preg_quote($valid_email_pattern).'#i', $recipient_email);
$invalid_email = '<font size="1">' . $lang_ecard_php['invalid_email'] . '</font>';
if (!$valid_sender_email && count($_POST) > 0) $sender_email_warning = $invalid_email;
if (!$valid_recipient_email && count($_POST) > 0) $recipient_email_warning = $invalid_email;
// Create and send the e-card
if (count($_POST) > 0 && $valid_sender_email && $valid_recipient_email) {
    global $nukeurl, $CONFIG;
// mailer
    require("includes/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->SetLanguage();
    $mail->From     = $sender_email;
    $mail->FromName = $sender_name;
    $mail->AddAddress("$recipient_name <$recipient_email>");
    $mail->Priority = 3;
    $mail->Encoding = "8bit";
    $mail->CharSet = CHARSET;
    $mail->Subject = sprintf($lang_ecard_php['ecard_title'], $sender_name);
    $gallery_dir = strtr(dirname($PHP_SELF), '\\', '/');
//'
    $gallery_url_prefix = $CONFIG['ecards_more_pic_target'];
    if ($CONFIG['make_intermediate'] && max($row['pwidth'], $row['pheight']) > $CONFIG['picture_width']) {
        $n_picname = get_pic_url($row, 'normal');
        $image = $row['filepath'].$CONFIG['normal_pfx'].$row['filename'];
    } else {
        $n_picname = get_pic_url($row, 'fullsize');
        $image = $row['filepath'].$row['filename'];
    }
    if (!stristr($n_picname, 'http:')) $n_picname = $CONFIG['ecards_more_pic_target'] . "$n_picname";
    $data = array(
        'rn' => $_POST['recipient_name'],
        'sn' => $_POST['sender_name'],
        'se' => $_POST['sender_email'],
        'p' => $n_picname,
        'g' => $greetings,
        'm' => $message,
    );
    $encoded_data = urlencode(base64_encode(serialize($data)));
    $params = array('{LANG_DIR}' => CPG_TEXT_DIR,
        '{TITLE}' => sprintf($lang_ecard_php['ecard_title'], $sender_name),
        '{CHARSET}' => $CONFIG['charset'] == 'language file' ? _CHARSET : $CONFIG['charset'],
        '{VIEW_ECARD_TGT}' => $CONFIG['ecards_more_pic_target'] . getlink("&file=displayecard&data=$encoded_data"),
        '{VIEW_ECARD_LNK}' => $lang_ecard_php['view_ecard'],
        '{PIC_URL}' => 'cid:the-image',
        '{URL_PREFIX}' => $gallery_url_prefix,
        '{GREETINGS}' => $greetings,
        '{MESSAGE}' => nl2br(set_smilies($message, $nukeurl)),
        '{SENDER_EMAIL}' => $sender_email,
        '{SENDER_NAME}' => $sender_name,
        '{VIEW_MORE_TGT}' => $CONFIG['ecards_more_pic_target'] . $CPG_M_URL,
        '{VIEW_MORE_LNK}' => $lang_ecard_php['view_more_pics'],
    );
    $message = template_eval($template_ecard, $params);
    $mail->IsHTML(true);
    $mail->AltBody = strip_tags($message);
    $mail->Body    = $message;
    $ext = strtolower(substr($row['filename'],-3));
    if ($ext == "gif") {
        $type = "image/gif";
    } else if ($ext == "png") {
        $type = "image/png";
    } else {
        $type = "image/jpeg";
    }
    if (!$mail->AddEmbeddedImage($image, "the-image", "ecard.$ext", "base64", $type)) {
        cpg_die(ERROR, $mail->ErrorInfo, __FILE__, __LINE__);
    }
    if (!$mail->Send()) {
        cpg_die(ERROR, $lang_ecard_php['send_failed'], __FILE__, __LINE__);
    }
    pageheader($lang_ecard_php['title'], "<META http-equiv=\"refresh\" content=\"3;url=" . getlink("&file=displayimage&album=$album&pos=$pos").'">');
    msg_box($lang_cpg_die[INFORMATION], $lang_ecard_php['send_success'], $lang_continue, getlink("&file=displayimage&album=$album&pos=$pos"));
    pagefooter();
}
pageheader($lang_ecard_php['title']);
starttable("100%");
$chset =_CHARSET;
echo <<<EOT
        <tr>
                <td colspan="3" class="tableh1"><h2>{$lang_ecard_php['title']}</h2></td>
        </tr>
        <tr>
                <td class="tableh2" colspan="2"><strong>{$lang_ecard_php['from']}</strong></td>
                <td rowspan="6" align="center" valign="top" class="tableb">
                        <img src="$thumb_pic_url" alt="" vspace="8" border="0" class="image"><br />
                </td>
        </tr>
        <tr>
                <td class="tableb" valign="top" width="40%">
                        <form method="post" name="post" action="$CPG_URL&amp;file=ecard&amp;album=$album&amp;pid=$pid&amp;pos=$pos" enctype="multipart/form-data" accept-charset="$chset">
                        {$lang_ecard_php['your_name']}<br />
                </td>
                <td valign="top" class="tableb" width="60%">
                        <input type="text" class="textinput" name="sender_name"  value="$sender_name" style="WIDTH: 100%;"><br />
                </td>
        </tr>
        <tr>
                <td class="tableb" valign="top" width="40%">
                        {$lang_ecard_php['your_email']}<br />
                </td>
                <td valign="top" class="tableb" width="60%">
                        <input type="text" class="textinput" name="sender_email"  value="$sender_email" style="WIDTH: 100%;"><br />
                        $sender_email_warning
                </td>
        </tr>
        <tr>
                <td class="tableh2" colspan="2"><strong>{$lang_ecard_php['to']}</strong></td>
        </tr>
        <tr>
                <td class="tableb" valign="top" width="40%">
                        {$lang_ecard_php['rcpt_name']}<br />
                </td>
                <td valign="top" class="tableb" width="60%">
                        <input type="text" class="textinput" name="recipient_name"  value="$recipient_name" style="WIDTH: 100%;"><br />
                </td>
        </tr>
        <tr>
                <td class="tableb" valign="top" width="40%">
                        {$lang_ecard_php['rcpt_email']}<br />
                </td>
                <td valign="top" class="tableb" width="60%">
                        <input type="text" class="textinput" name="recipient_email"  value="$recipient_email" style="WIDTH: 100%;"><br />
                        $recipient_email_warning
                </td>
        </tr>
        <tr>
                <td class="tableh2" colspan="3"><strong>{$lang_ecard_php['greetings']}</strong></td>
        </tr>
        <tr>
                <td class="tableb" colspan="3">
                        <input type="text" class="textinput" name="greetings"  value="$greetings" style="WIDTH: 100%;"><br />
                </td>
        </tr>
        <tr>
                <td class="tableh2" colspan="3"><strong>{$lang_ecard_php['message']}</strong></td>
        </tr>
        <tr>
                <td class="tableb" colspan="3" valign="top"><br />
                        <textarea name="message" class="textinput" ROWS="8" COLS="40" WRAP="virtual" onselect="storeCaret_post(this);" onclick="storeCaret_post(this);" onkeyup="storeCaret_post(this);" STYLE="WIDTH: 100%;">$message</textarea><br /><br />
                </td>
        </tr>
        <tr>
                <td class="tableb" colspan="3" valign="top">
EOT;
echo smilies_table('onerow', 'message', 'post');
//echo generate_smilies();
echo <<<EOT
                </td>
        </tr>
        <tr>
                <td colspan="3" align="center" class="tablef">
                        <input type="submit" class="button" value="{$lang_ecard_php['title']}">
                        </form>
                </td>
        </tr>
EOT;
endtable();
pagefooter();
?>
