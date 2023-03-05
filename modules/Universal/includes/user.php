<?php

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

// The core of these functions have been lifted from PHP-Nuke
// Modified for use in the Universal Module by Barry Caplin.

function user_login($redirect) {
	global $modulename, $stop, $mode, $t, $f, $gfx_chk, $op2, $file;
	$modulename2 = "Your_Account";
	if (isset($file)) { $file = $file; } else { $file = "add"; }
	if ($stop == 1) {
	    OpenTable();
		   echo "<center><font class=\"title\"><strong>"._LOGININCOR."</strong></font></center>\n";
	    CloseTable();
	}
	    OpenTable();
	    echo "<center><font class=\"title\"><strong>"._USERREGLOGIN."</strong><br />"._ONLYREGUSERS."</font></center>\n";
	    CloseTable();
	    OpenTable();
	    mt_srand ((double)microtime()*1000000);
	    $maxran = 1000000;
	    $random_num = mt_rand(0, $maxran);
	    echo "<form action=\"modules.php?name=$modulename&file=$file\" method=\"post\">\n"
		."<strong>"._USERLOGIN."</strong><br /><br />\n"
		."<table border=\"0\"><tr><td>\n"
		.""._NICKNAME.":</td><td><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\"></td></tr>\n"
		."<tr><td>"._PASSWORD.":</td><td><input type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\"></td></tr>\n";
	    if (extension_loaded("gd") AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
		echo "<tr><td colspan='2'>"._SECURITYCODE.": <img src='modules.php?name=$modulename&file=$file&op=gfx&random_num=$random_num&modulename=$modulename' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>\n"
		    ."<tr><td colspan='2'>"._TYPESECCODE.": <input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\"></td></tr>\n"
		    ."<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">\n";
	    }
	    echo "</table><input type=\"hidden\" name=\"redirect\" value=$redirect>\n"
		."<input type=\"hidden\" name=\"mode\" value=$mode>\n"
		."<input type=\"hidden\" name=\"f\" value=$f>\n"
		."<input type=\"hidden\" name=\"t\" value=$t>\n"
		."<input type=\"hidden\" name=\"modulename\" value=\"$modulename\">\n"
		."<input type=\"hidden\" name=\"file\" value=\"$file\">\n"
		."<input type=\"hidden\" name=\"op2\" value=\"$op2\">\n"
		."<input type=\"hidden\" name=\"op\" value=\"login\">\n"
		."<input type=\"submit\" value=\""._LOGIN."\"></form><br />\n\n"
		."<center><font class=\"content\">[ <a href=\"modules.php?name=$modulename2&amp;op=pass_lost\">"._PASSWORDLOST."</a> | <a href=\"modules.php?name=$modulename2&amp;op=new_user\">"._REGNEWUSER."</a> ]</font></center>\n";
	    CloseTable();	    		
}

function gfx($random_num) {
    global $prefix, $db, $modulename;
    @require("config.php");
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    $image = ImageCreateFromJPEG("modules/$modulename/images/code_bg.jpg");
    $text_color = ImageColorAllocate($image, 80, 80, 80);
    Header("Content-type: image/jpeg");
    ImageString ($image, 5, 12, 2, $code, $text_color);
    ImageJPEG($image, '', 75);
    ImageDestroy($image);
    die();
}

function docookie($setuid, $setusername, $setpass, $setstorynum, $setumode, $setuorder, $setthold, $setnoscore, $setublockon, $settheme, $setcommentmax) {
    $info = base64_encode("$setuid:$setusername:$setpass:$setstorynum:$setumode:$setuorder:$setthold:$setnoscore:$setublockon:$settheme:$setcommentmax");
    setcookie("user","$info",time()+2592000);
}

function login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check) {
    global $setinfo, $user_prefix, $db, $modulename, $pm_login, $prefix, $op2, $file;
    @include_once("config.php");
    if (isset($op2)) { $op2 = $op2; } else { $op2 = ""; }
    $sql = "SELECT user_password, user_id, storynum, umode, uorder, thold, noscore, ublockon, theme, commentmax FROM ".$user_prefix."_users WHERE username='$username'";
    $result = $db->sql_query($sql);
    $setinfo = $db->sql_fetchrow($result);
    $forward = preg_replace("/redirect=/", "", "$redirect");
    if (preg_match("/privmsg/", $forward)) {
        $pm_login = "active";
    }
    if (($db->sql_numrows($result)==1) AND ($setinfo[user_id] != 1) AND ($setinfo[user_password] != "")) {
	$dbpass=$setinfo[user_password];
	$non_crypt_pass = $user_password;
  	$old_crypt_pass = crypt($user_password,substr($dbpass,0,2));
	$new_pass = md5($user_password);
	if (($dbpass == $non_crypt_pass) OR ($dbpass == $old_crypt_pass)) {
	    $db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
	    $sql = "SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'";
	    $result = $db->sql_query($sql);
	    $row = $db->sql_fetchrow($result);
	    $dbpass = $row[user_password];
	}
	if ($dbpass != $new_pass) {
            Header("Location: modules.php?name=$modulename&file=$file$op2&stop=1");
    	    return;
	}
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 6);
	if (extension_loaded("gd") AND $code != $gfx_check AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
	    Header("Location: modules.php?name=$modulename&file=$file$op2&stop=1");
	    die();
	} else {
	    docookie($setinfo[user_id], $username, $new_pass, $setinfo[storynum], $setinfo[umode], $setinfo[uorder], $setinfo[thold], $setinfo[noscore], $setinfo[ublockon], $setinfo[theme], $setinfo[commentmax]);
	    $uname = $_SERVER["REMOTE_ADDR"];
	    $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$uname' AND guest='1'");
	}
		Header("Location: $redirect");
    } else {
	Header("Location: modules.php?name=$modulename&file=$file&stop=1");
    }
}

switch($op) {

	case "login":
	login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check);
	break;
	
	case "gfx":
	gfx($random_num);
	break;
}

?>