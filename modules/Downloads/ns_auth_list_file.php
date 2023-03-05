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
if (preg_match("/ns_auth_list_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");


function ns_dl_auth_list($lid) {
global $prefix, $db, $module_name;
$result = $db->sql_query("select prbgcolor2 from ".$prefix."_ns_downloads_general");
list($prbgcolor2) = $db->sql_fetchrow($result);
$result2 = $db->sql_query("select ns_dl_auth_lim from ".$prefix."_ns_downloads_auth");
list($ns_dl_auth_lim) = $db->sql_fetchrow($result2);
$tlid = $lid;
$result_name = $db->sql_query("select name from ".$prefix."_downloads_downloads where lid='$lid'");
list($author) = $db->sql_fetchrow($result_name);
$ns_view_dis = ns_dl_admin_view(2);
$result_list = $db->sql_query("select cid, lid, title from ".$prefix."_downloads_downloads where name='$author' && lid!='$tlid' $ns_view_dis order by title asc limit 0, $ns_dl_auth_lim");
	if ($db->sql_numrows($result_list) > 0) {
    	echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\">";
		echo "<tr><td><br /><hr color=\"$prbgcolor2\" width=\"80%\"><br /></td></tr>";
    	echo "<tr><td><font class=\"content\"><strong>"._NSDLAUTHLIST." $author ...</strong></font></td></tr>";
    	echo "<tr><td>&nbsp;</td></tr>";
		while(list($ucid, $ulid, $title) = $db->sql_fetchrow($result_list)) {
			$ttitle = preg_replace ("/ /", "_", $title);
			$auth_name = preg_replace ("/ /", "_", $author);
    		echo "<tr><td align=\"left\">&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> ";
    		echo "<a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails";
			echo "&amp;cid=$ucid&amp;lid=$ulid&amp;ttitle=$ttitle#dldetails\">";
			echo "$title</a></td></tr>";
		}
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "<tr><td align=\"center\">[ ";
    	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_auth_full_list";
		echo "&amp;author=$auth_name#auth\">";
			if ($db->sql_numrows($result_list) >= $ns_dl_auth_lim) {
				echo ""._NSDLAUTHLISTFULL."";
			} else {
				echo ""._NSDLAUTHLISTDETAILED."";
			}
		echo "</a> ]</td></tr>";
		echo "<tr><td><br /><hr color=\"$prbgcolor2\" width=\"80%\"></td></tr>";
    	echo "</table>";
	}
}



function ns_dl_auth_full_list($author) {
global $prefix, $db, $admin, $module_name;
$result_ds = $db->sql_query("select ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_main_dec) = $db->sql_fetchrow($result_ds);
$ns_view_dis = ns_dl_admin_view(2);
$auth_name = preg_replace ("/_/", " ", $author);
include_once("header.php");
menu(1);
echo "<a name=\"auth\">";
ns_mod_title3("auth_list",""._NSDLBYAUTHOR.": <strong>$auth_name</strong>");
OpenTable();
$result = $db->sql_query("select cid, lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where name='$auth_name' $ns_view_dis order by title");
$result_rec = $db->sql_query("select ns_dl_rec from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec) = $db->sql_fetchrow($result_rec);
ns_download_image();
echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr><td><font class=\"content\">";
while(list($cid, $lid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note)=$db->sql_fetchrow($result)) {
    $cid = intval($cid);
    $lid = intval($lid);
    $hits = intval($hits);
    $totalvotes = intval($totalvotes);
    $totalcomments = intval($totalcomments);
	$transfertitle = preg_replace ("/ /", "_", $title); 
    echo "<a name=\"$lid\">";
    ns_dl_OpenTable();
    $downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
    $title = stripslashes($title);
    $description = stripslashes($description);
    echo "<br />";        
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	echo "<tr><td align=\"left\" valign=\"top\">";
	ns_dl_image($lid, $title);
	echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	echo "</td>";
		if ($ns_dl_rec == 1) {
			echo "<td align=\"right\" valign=\"top\">";
			echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
			echo "&amp;lid=$lid&amp;ttitle=$transfertitle#recom\" title=\""._NSDLRECDOWNLOAD."\">";
			echo "<span style=\"vertical-align=-2\">";
			echo "<img src=\"images/NukeStyles/EDL/mod/friend.gif\" border=\"0\" ";
			echo "title=\""._NSDLRECDOWNLOAD."\"></span>&nbsp;&nbsp;"._NSDLFOOTREC."</a>&nbsp;&nbsp;";
			echo "</td>";
		}
	echo "</tr></table>";
    ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
	ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two);
	$result3 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid='$cid'");
	list($cid3, $title3, $parentid3) = $db->sql_fetchrow($result3);
    $cid3 = intval($cid3);
	if ($parentid3 > 0) $title3 = getparent($parentid3, $title3);
	echo "<strong>"._CATEGORY.":</strong> ";
	echo "<a href=modules.php?name=$module_name&d_op=viewdownload&cid=$cid#cat>$title3</a><br />";
    mktime ("LC_TIME", "$locale");
    preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
    ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);
    ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
    detecteditorial($cid, $lid, $transfertitle, 1);
    ns_dl_admin($lid, $admin);
    ns_dl_CloseTable();
    }
    echo "</font>";
    echo "</td></tr></table>";
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}




?>