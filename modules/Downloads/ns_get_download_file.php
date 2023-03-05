<?php

/******************************************************/
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* THIS MODULE IS NOT RELEASED UNDER THE GPL/GNU      */
/* LICENSE.                                           */
/*                                                    */
/* You can modifiy all files, EXCEPT the copyright    */
/* file to your liking. But you CANNOT redistribute   */
/* this module for any purpose, without the EXPRESS   */
/* WRITTEN CONSENT from Shawn Archer.                 */
/*                                                    */
/* Also, Francisco Burzi & the Nuke credits MUST      */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
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
if (preg_match("/ns_get_download_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");



function gfx($random_num) {
global $module_name;
    $image = ImageCreateFromJPEG("modules/Downloads/images/code_bg.jpg");
    $text_color = ImageColorAllocate($image, 80, 80, 80);
    Header("Content-type: image/jpeg");
	ImageString ($image, 5, 12, 2, $random_num, $text_color);
    ImageJPEG($image, '', 75);
    ImageDestroy($image);
    die();
}



function makePass2() {
$cons = "bcdfghjklmnpqrstvwxyz";
$vocs = "aeiou";
	for ($x=0; $x < 6; $x++) {
    	mt_srand ((double) microtime() * 1000000);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
$makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
return($makepass);
}



function ns_getit_form($cid, $lid, $ftid, $codepass, $makepass, $title, $dref) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $module_name;
$result = $db->sql_query("select ns_getit_image, ns_getit_color from ".$prefix."_ns_downloads_fetch");
list($ns_getit_image, $ns_getit_color) = $db->sql_fetchrow($result);
$makepass = makepass2();
    if ((extension_loaded("gd")) && ($ns_getit_image == 1)) {
		ns_dl_upload();
		$codepass = "<img src=\"modules.php?name=Downloads&d_op=gfx&random_num=$makepass\" ";
		$codepass .= "border=\"1\" alt=\"Security Code: $makepass\" width=\"77\" height=\"20\">";
		$codepass .= "&nbsp;&nbsp;[ <a href=\"javascript:newWindow('modules.php?name=$module_name";
		$codepass .= "&amp;d_op=ns_pass_help&amp;thepass=$makepass','window2')\">Help</a> ]";
    } else {
        $codepass = "<font color=\"#$ns_getit_color\"><strong>$makepass</strong></font>";
    }
echo "<form action=\"modules.php?name=$module_name#get\" method=\"post\">";
echo "<table border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"0\">";
echo "<tr><td align=\"right\"><strong>"._NSDLPASSWORD.":</strong></td>";
echo "<td align=\"left\">$codepass</td></tr>";
echo "<tr><td align=\"right\"><strong>"._NSDLPASSWORD2.":</strong></td>";
echo "<td align=\"left\"><input type=\"text\" size=\"20\" name=\"passcode\"></td></tr>";
echo "</table><br /><br />";
echo "<table border=\"0\" align=\"center\" cellpadding=\"8\" cellspacing=\"0\">";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"checkpass\" value=\"$makepass\">";
echo "<input type=\"hidden\" name=\"ftid\" value=\"$ftid\">";
echo "<input type=\"hidden\" name=\"title\" value=\"$title\">";
echo "<input type=\"hidden\" name=\"dref\" value=\"$dref\">";
echo "<input type=\"hidden\" name=\"d_op\" value=\"ns_get_download\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\"></td>";
echo "<td align=\"center\">";
echo "<input type=\"submit\" value=\""._DOWNLOADNOW."\" title=\""._DOWNLOADNOW."\"></td>";
echo "<td align=\"center\">";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\"></td>";
echo "</tr></table>";
echo "</form>";
}



function ns_getit($cid, $lid, $type) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $module_name, $ns_details, $ns_editorial, $ns_comments, $ns_recommend;
$result = $db->sql_query("select ns_getit_image, ns_getit_msg from ".$prefix."_ns_downloads_fetch");
list($ns_getit_image, $ns_getit_msg) = $db->sql_fetchrow($result);
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 1;
$dref = ns_dl_get_referrer();
	if ($type == "url") {
		$result = $db->sql_query("select title, url from ".$prefix."_downloads_downloads where lid='$lid'");
		list($title, $url) = $db->sql_fetchrow($result);
		$ftid = base64_encode($url);
	} elseif ($type == "mirror_one") {
		$result = $db->sql_query("select title, ns_mirror_one from ".$prefix."_downloads_downloads where lid='$lid'");
		list($title, $ns_mirror_one) = $db->sql_fetchrow($result);
		$ftid = base64_encode($ns_mirror_one);
	} elseif ($type == "mirror_two") {
		$result = $db->sql_query("select title, ns_mirror_two from ".$prefix."_downloads_downloads where lid='$lid'");
		list($title, $ns_mirror_two) = $db->sql_fetchrow($result);
		$ftid = base64_encode($ns_mirror_two);
	}
$ttitle = str_replace (" ", "_", $title);
ns_getit_head($cid);
echo "<br /><center><font class=\"content\"><strong>$title</strong></font><br />";
downloadinfomenu($cid, $lid, $ttitle);
echo "</center><br /><br /><div align=\"justify\">";
	if ($ns_getit_msg != "") {
		echo "$ns_getit_msg<br />";
	}
	if ($ns_getit_image == 1) {
		$ns_directions = ""._NSDLSECDIRECTIONS3."";
	} else {
		$ns_directions = ""._NSDLSECDIRECTIONS2."";
	}
echo "<br />"._NSDLSECDIRECTIONS." \"<strong>$title</strong>\", $ns_directions "._NSDLSECDIRECTIONS4."</div><br />";
ns_getit_form($cid, $lid, $ftid, $codepass, $makepass, $title, $dref);
ns_getit_foot();
}



function ns_get_download($cid, $lid, $ftid, $passcode, $checkpass, $title, $dref) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $user, $cookie, $module_name, $ns_details, $ns_editorial, $ns_comments, $ns_recommend;
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 1;
$ttitle = str_replace (" ", "_", $title);
	if ($ftid == "") {
        Header("Location: $dref");
		die();
	}
	if ($checkpass == $passcode) {
		$url = base64_decode($ftid);
		if (@fopen($url,"r")) {
            $db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
            Header("Location: $url");
            die();
        } else {
            cookiedecode($user);
            $username = $cookie[1];
            if ($username == "") {
                $busername = "";
            } else {
				$busername = "$username, ";
			}
            $db->sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, $lid, 0, 0, '', '', '', '"._NSDLAUTOREPORT."', 1, '$auth_name', '$email', '$filesize', '$version', '$homepage', '$ns_compat', '$ns_des_img', '$ns_mirror_one', '$ns_mirror_two')");
			ns_getit_head($cid);
			echo "<br /><center><font class=\"content\"><strong>$title</strong></font><br />";
			downloadinfomenu($cid, $lid, $ttitle);
			echo "</center><br />";
			echo "<div align=\"justify\">";
            echo "$busername<strong>$title</strong> "._NSDLAUTOREPORT2."</div><br /><br />";
            echo "<center>[ <a href=\"$dref#$lid\">"._NSDLRECBACKDL."</a> ]</center><br />";
			ns_getit_foot();
            die();
        }
	} else {
		ns_getit_head($cid);
		echo "<br /><center><font class=\"content\"><strong>$title</strong></font><br />";
		downloadinfomenu($cid, $lid, $ttitle);
        echo "<br /><br />"._NSDLPASSERROR."</center><br />";
		ns_getit_form($cid, $lid, $ftid, $codepass, $makepass, $title, $dref);
		ns_getit_foot();
        die();
	}
}



function ns_pass_help($thepass) {
global $module_name, $ns_theme;
echo "<html><head><title>Download Security</title>";
echo "<link rel=\"StyleSheet\" href=\"../../themes/$ns_theme/style/style.css\" type=\"text/css\">";
echo "</head><body bgcolor=\"FFFFFF\">";
echo "<table width=\"100%\" cellpadding=\"7\" cellspacing=\"1\"><tr>";
echo "<td align=\"center\"><font class=\"content\">Security Password</font></td>";
echo "</tr></table><br />";
echo "<table width=\"100%\" cellpadding=\"7\" cellspacing=\"1\"><tr><td>";
echo "<font class=\"content\">Since the password may be difficult for many to read, ";
echo "here you can view and copy the password.<br /><br />The password is: <strong>$thepass</strong></font></td></tr>";
echo "<tr><td>&nbsp;&nbsp;</td></tr>";
echo "<tr><td>&nbsp;&nbsp;</td></tr>";
echo "<tr><td align=\"center\">[ <a href=\"javascript:window.close()\">Close Window</a> ]</td>";
echo "</tr></table></body></html>";
}



function ns_getit_head($cid) {
$cid = intval($cid);
include_once("header.php");
menu(1);
echo "<a name=\"get\">";
ns_mod_title3("get_download",""._NSDLGETDOWNLOAD."");
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
}



function ns_getit_foot() {
ns_dl_CloseTable();
CloseTable();
OpenTable();
ns_dl_OpenTable();
echo "<div align=\"right\"><font class=\"tiny\">Original Fetch Hack by ";
echo "<a href=\"http://www.2thextreme.org\" target=\"_blank\">MGCJerry</a><br />";
echo "Modified for EDL V2.3 by ";
echo "<a href=\"http://www.nukestyles.com\" target=\"_blank\">Shawn Archer</a></div>";
ns_dl_CloseTable();
CloseTable();
include_once("footer.php");
}


?>
