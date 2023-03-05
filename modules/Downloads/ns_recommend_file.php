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
if (preg_match("/ns_recommend_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");



function ns_dl_rec_head($cid) {
include_once("header.php");
menu(1);
echo "<a name=\"recom\">";
ns_mod_title3("recom_download",""._NSDLRECDOWNLOAD."");
OpenTable();
ns_dl_OpenTable();
ns_dl_cat_jump($cid);
ns_dl_CloseTable();
ns_dl_OpenTable();
}



function ns_dl_rec_foot() {
ns_dl_CloseTable();
CloseTable();
ns_dl_link_bar($maindownload = 1);
}



function ns_dl_rec_dl($cid, $lid, $ttitle, $dref) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $user, $user_prefix, $cookie, $module_name, $sitename, $ns_details, $ns_editorial, $ns_comments, $ns_recommend;
$result_rc = $db->sql_query("select ns_dl_rec_num, ns_dl_rec_msg from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec_num, $ns_dl_rec_msg) = $db->sql_fetchrow($result_rc);
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 0;
$ttitle = stripslashes($ttitle);
$transfertitle = preg_replace ("/_/", " ", $ttitle);
$rip = ns_dl_getuser_ip();
$dref = ns_dl_get_referrer();
ns_dl_rec_head($cid);
echo "<br /><center><font class=\"content\"><strong>$transfertitle</strong></font><br />";
downloadinfomenu($cid, $lid, $ttitle);
echo "</center><br /><br />";
echo "<div align=\"justify\">"._NSDLRECDOWNLOADNOTE." ";
	if (is_user($user)) {
		echo ""._NSDLRECDOWNLOADNOTEU2." ";
	} else {
		echo ""._NSDLRECDOWNLOADNOTEV2." ";
	}
	if ($ns_dl_rec_num > 1) {
		echo ""._NSDLRECDOWNLOADNOTE3." $ns_dl_rec_num "._NSDLRECDOWNLOADNOTE4." ";
	}
	if ($ns_dl_rec_msg > 0) {
		echo ""._NSDLRECDOWNLOADNOTEPM." ";
	}
echo "</div><br /><br />";
echo "<form action=\"modules.php?name=$module_name&d_op=ns_dl_send_rec#recom\" method=\"post\">";
	if (is_user($user)) {
		$ns_version = ns_dl_get_version();
		if ($ns_version <= "6.0") {
			$result_vd = $db->sql_query("select name, uname, email from ".$user_prefix."_users where uname='$cookie[1]'");
			list($vdname, $vduname, $vdemail) = $db->sql_fetchrow($result_vd);
			if ($vdname != "") { 
				$ns_rec_yname = $vdname; 
			} else { 
				$ns_rec_yname = $vduname; 
			}
			$ns_rec_yemail = $vdemail; 
		} elseif ($ns_version >= "6.5") {
			$result_vu = $db->sql_query("select name, username, user_email from ".$user_prefix."_users where username='$cookie[1]'");
			list($vuname, $vuusername, $vuuser_email) = $db->sql_fetchrow($result_vu);
			if ($vuname != "") { 
				$ns_rec_yname = $vuname; 
			} else { 
				$ns_rec_yname = $vuusername; 
			}
			$ns_rec_yemail = $vuuser_email;
		}
	}
echo "<br /><table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\" width=\"90%\">";
echo "<tr><td align=\"right\"><strong>"._NSDLYOURNAME.":</strong></td>";
echo "<td><input type=\"text\" name=\"ns_rec_yname\" value=\"$ns_rec_yname\" size=\"40\">";
echo " "._NSDLREQUIRED."</td></tr>";
echo "<tr><td align=\"right\"><strong>"._NSDLYOUREMAIL.":</strong></td>";
echo "<td><input type=\"text\" name=\"ns_rec_yemail\" value=\"$ns_rec_yemail\" size=\"40\">";
echo " "._NSDLREQUIRED."</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	if ($ns_dl_rec_num > 1) {
		$fn = 1;
	} else {
		$fn = "";
	}
	for($i = 1; $i <= $ns_dl_rec_num; $i++) {
		echo "<tr><td align=\"right\"><strong>"._NSDLFNAME." $fn:</strong></td>";
		echo "<td align=\"left\"><input type=\"text\" name=\"ns_friend_name[]\" size=\"40\">";
			if ($fn <= 1) {
				echo " "._NSDLREQUIRED."</td></tr>";
			}
		echo "<tr><td align=\"right\"><strong>"._NSDLFEMAIL." $fn:</strong></td>";
		echo "<td align=\"left\"><input type=\"text\" name=\"ns_friend_email[]\" size=\"40\">";
			if ($fn <= 1) {
				echo " "._NSDLREQUIRED."</td></tr>";
			}
    	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
		$fn++;
	}
	if ($ns_dl_rec_msg == 1) {
		echo "<tr><td colspan=\"2\" align=\"center\"><strong>"._NSDLRECMESSAGE.":</strong></td></tr>";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo "<textarea name=\"ns_rec_send_msg\" cols=\"60\" rows=\"10\"></textarea>";
		echo "</td></tr>";
		echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	} else {
		echo "<input type=\"hidden\" name=\"ns_rec_send_msg\" value=\"\">";
	}
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type=\"hidden\" name=\"dref\" value=\"$dref\">";
echo "<input type=\"hidden\" name=\"rip\" value=\"$rip\">";
echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"ttitle\" value=\"$ttitle\">";
echo "<input type=\"submit\" name=\"submit\" value=\""._NSDLBSEND."\" title=\""._NSDLBSEND."\">";
echo "&nbsp;&nbsp;<input type=\"reset\" value=\""._NSBCLEAR."\" title=\""._NSBCLEAR."\">";
echo "</td></tr></table></form><br /><br />";
ns_dl_rec_foot();
}



function ns_dl_send_rec($dref, $rip, $cid, $lid, $ttitle, $ns_rec_yname, $ns_rec_yemail, $ns_friend_name, $ns_friend_email, $ns_rec_send_msg) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $sitename, $slogan, $nukeurl, $module_name, $ns_details, $ns_editorial, $ns_comments, $ns_recommend;
$ns_details = 1;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 0;
$transfertitle = preg_replace ("/_/", " ", $ttitle);
$result_rc = $db->sql_query("select ns_dl_rec_num, ns_dl_rec_email, ns_dl_rec_subject from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec_num, $ns_dl_rec_email, $ns_dl_rec_subject) = $db->sql_fetchrow($result_rc);
$ns_rec_ok = 1;
    if ($ns_rec_yname == "") {
		$ns_rec_ok = 0;
		ns_dl_rec_head($cid);
		echo "<br /><br /><center><strong>"._NSDLRECNONAME."</strong><br /><br /><br />";
		echo ""._NSDLBACK."</center><br /><br />";
		ns_dl_rec_foot();
		die();
    } else if ($ns_rec_yemail == "") {
		$ns_rec_ok = 0;
		ns_dl_rec_head($cid);
		echo "<br /><br /><center><strong>"._NSDLRECNOEMAIL."</strong><br /><br /><br />";
		echo ""._NSDLBACK."</center><br /><br />";
		ns_dl_rec_foot();
		die();
    } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-z]{2,6}$/",$ns_rec_yemail)) {
		$ns_rec_ok = 0;
		ns_dl_rec_head($cid);
		echo "<br /><br /><center><strong>"._NSDLRECNOVALEMAIL."</strong><br /><br /><br />";
		echo ""._NSDLBACK."</center><br /><br />";
		ns_dl_rec_foot();
		die();
    }
	if ($ns_dl_rec_num > 0) {
		$fn = 1;
	} else {
		$fn = "";
	}
	for ($i = 0; $i < $ns_dl_rec_num; $i++) {
		if ($ns_friend_name[0] == "") {
			$ns_rec_ok = 0;
			ns_dl_rec_head($cid);
			echo "<br /><br /><center><strong>"._NSDLRECNOFNAME." $fn</strong><br />";
			echo "<br />"._NSDLBACK."</center><br /><br />";
			ns_dl_rec_foot();
			die();
		} else if ($ns_friend_email[0] == "") {
			$ns_rec_ok = 0;
			ns_dl_rec_head($cid);
			echo "<br /><br /><center><strong>"._NSDLRECNOFEMAIL." $fn</strong><br /><br /><br />";
			echo ""._NSDLBACK."</center><br /><br />";
			ns_dl_rec_foot();
			die();
    	} else if (($fn > 1) && ($ns_friend_name[$i] != "")) {
			if ($ns_friend_email[$i] == "") {
				$ns_rec_ok = 0;
				ns_dl_rec_head($cid);
				echo "<br /><br /><center><strong>"._NSDLRECNOFEMAIL." $fn</strong><br />";
				echo "<br />"._NSDLBACK."</center><br /><br />";
				ns_dl_rec_foot();
				die();
			}
		} else if (($fn > 1) && ($ns_friend_email[$i] != "")) {
			if ($ns_friend_name[$i] == "") {
				$ns_rec_ok = 0;
				ns_dl_rec_head($cid);
				echo "<br /><br /><center><strong>"._NSDLRECNOFNAME." $fn</strong><br />";
				echo "<br />"._NSDLBACK."</center><br /><br />";
				ns_dl_rec_foot();
				die();
			}
		} else if ($ns_friend_email[$i] != "") {
			if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-z]{2,6}$/",$ns_friend_email[$i])) {
				ns_dl_rec_head($cid);
				echo "<br /><br /><center><strong>"._NSDLRECNOVALFEMAIL." $fn</strong><br /><br /><br />";
				echo ""._NSDLBACK."</center><br /><br />";
				ns_dl_rec_foot();
				die();
    		}
		}
		$fn++;
	}
	if ($ns_rec_ok == 1) {
		$ns_rec_send_msg = stripslashes(strip_tags(trim($ns_rec_send_msg)));
		$ns_dl_rec_email = stripslashes(strip_tags(trim($ns_dl_rec_email)));
		$ns_dl_rec_subject = stripslashes(trim($ns_dl_rec_subject));
     	$subject  = $ns_dl_rec_subject;
		$ns_dl_rec_link = $dref;
     	$ns_name = $ns_rec_yname;
     	$ns_email = $ns_rec_yemail;
			for ($i = 0; $i < $ns_dl_rec_num; $i++) {
				if ($ns_friend_name[$i] == "") {
					unset($ns_friend_name[$i]);
				}
			}
			for ($i = 0; $i < $ns_dl_rec_num; $i++) {
				if ($ns_friend_email[$i] == "") {
					unset($ns_friend_email[$i]);
				}
			}
			for ($i = 0; $i < count($ns_friend_email); $i++) {
				$message = "$ns_friend_name[$i],\r\n\r\n";
					if ($ns_rec_send_msg != "") {
						$message .= "$ns_rec_send_msg\r\n\r\n";
					} else {
						$message .= "$ns_dl_rec_email\r\n\r\n";
					}
     			$message .= "$ns_dl_rec_link\r\n\r\n";
     			$message .= "$ns_name\r\n\r\n";
     			$message .= "=============================================================\r\n\r\n";
     			$message .= "$sitename\r\n$slogan\r\n$nukeurl\r\n\r\n";
     			$message .= "=============================================================\r\n\r\n";
				mail($ns_friend_email[$i], $subject, $message, "From: $ns_name <$ns_email>");
				ns_dl_rec_astats($dref, $rip, $cid, $lid, $ns_rec_yname, $ns_rec_yemail);
			}
			if (mail) {
				ns_dl_rec_head($cid);
				echo "<br /><br /><table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\">";
				echo "<tr><td align=\"center\"><strong>"._NSDLRECSUCCESS."</strong></td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLRECDETAILS."</strong></td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLRECTITLE.":</strong> $transfertitle</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLRECLINK.":</strong> $dref</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLYOURNAME.":</strong> $ns_rec_yname</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLYOUREMAIL.":</strong> $ns_rec_yemail</td></tr>";
				echo "<tr><td align=\"left\"><strong>"._NSDLYOURIPADD.":</strong> $rip</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
					if ($ns_dl_rec_num > 0) {
						$fn = 1;
					} else {
						$fn = "";
					}
					for ($i = 0; $i < $ns_dl_rec_num; $i++) {
						if (($ns_friend_name[$i] != "") || ($ns_friend_email[$i] != "")) {
							echo "<tr><td align=\"left\"><strong>"._NSDLFNAME." $fn:</strong> ";
							echo "$ns_friend_name[$i]</td></tr>";
							echo "<tr><td align=\"left\"><strong>"._NSDLFEMAIL." $fn:</strong> ";
							echo "$ns_friend_email[$i]</td></tr>";
							$fn++;
						}
					}
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"center\">[ <a href=\"$dref#details\">"._NSDLRECBACKDL."";
				echo "</a> ]</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "</table>";
			} else {
				echo "<br /><br /><table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\">";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"center\"><strong>"._NSDLRECNOSUCCESS."</strong></td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "<tr><td align=\"center\">"._NSDLRECERRBACKDL."</td></tr>";
				echo "<tr><td>&nbsp;</td></tr>";
				echo "</table>";
			}
	ns_dl_rec_foot();
	}
}



function ns_dl_rec_astats($dref, $rip, $cid, $lid, $ns_rec_yname, $ns_rec_yemail) {
global $prefix, $db;
$result = $db->sql_query("select ns_dl_rec_stats from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec_stats) = $db->sql_fetchrow($result);
$result_dt = $db->sql_query("select title from ".$prefix."_downloads_downloads where lid='$lid'");
list($title) = $db->sql_fetchrow($result_dt);
    if ($ns_dl_rec_stats == 1) {
		$result2 = $db->sql_query("select rdid from ".$prefix."_ns_downloads_recom_dlstats where lid='$lid'");
		list($rdid) = $db->sql_fetchrow($result2);
		if ($rdid) {
			sql_query("update ".$prefix."_ns_downloads_recom_dlstats set ns_dl_rec_num=ns_dl_rec_num+1 where lid='$lid'");
			$result_usr = $db->sql_query("select rduid from ".$prefix."_ns_downloads_recom_usrstats where ns_dl_rec_rname='$ns_rec_yname'");
			list($rduid) = $db->sql_fetchrow($result_usr);
			if ($rduid) {
				sql_query("update ".$prefix."_ns_downloads_recom_usrstats set ns_dl_rec_rnum=ns_dl_rec_rnum+1 where rduid='$rduid'");
			} else {
				sql_query("insert into ".$prefix."_ns_downloads_recom_usrstats values (NULL, '$rdid', '$lid', '$ns_rec_yname', '$ns_rec_yemail', '$rip', '1')");
			}
		} else {
			sql_query("insert into ".$prefix."_ns_downloads_recom_dlstats values (NULL, '$lid', '$title', '1')");
			$result_usr2 = $db->sql_query("select rduid from ".$prefix."_ns_downloads_recom_usrstats where ns_dl_rec_rname='$ns_rec_yname'");
			list($rduid) = $db->sql_fetchrow($result_usr2);
			if ($rduid) {
				sql_query("update ".$prefix."_ns_downloads_recom_usrstats set ns_dl_rec_rnum=ns_dl_rec_rnum+1 where rduid='$rduid'");
			} else {
				sql_query("insert into ".$prefix."_ns_downloads_recom_usrstats values (NULL, '$rdid', '$lid', '$ns_rec_yname', '$ns_rec_yemail', '$rip', '1')");
			}
		}
	}
}



function ns_dl_rec_stats_view() {
global $prefix, $db;
ns_dl_rec_head($cid);

echo "<br /><br /><table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\">";

echo "<tr><td align=\"center\"><strong>"._NSDLRECNOSUCCESS."</strong></td></tr>";

echo "<tr><td>&nbsp;</td></tr>";

echo "</table>";

ns_dl_rec_foot();

}





?>