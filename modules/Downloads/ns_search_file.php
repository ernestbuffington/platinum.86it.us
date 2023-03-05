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
if (preg_match("/ns_view_download_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");


function search($query, $min, $orderby, $show) {
global $prefix, $db, $admin, $prbgcolor2, $module_name, $prbgcolor1, $tttextcolor, $ns_theme, $mod_title, $mod_title_directory;
$result_gen = $db->sql_query("select ns_dl_num_results, ns_dl_sort_order from ".$prefix."_ns_downloads_general");
list($ns_dl_num_results, $ns_dl_sort_order) = $db->sql_fetchrow($result_gen);
$result_sr = $db->sql_query("select ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_main_dec) = $db->sql_fetchrow($result_sr);
include_once("header.php");    
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$ns_dl_num_results;
    if(isset($orderby)) {
		$orderby = convertorderbyin($orderby);
    } else {
		$orderby = ns_dl_sort_order($orderby, $ns_dl_sort_order);	
    }
    if ($show!="") {
		$ns_dl_num_results = $show;
    } else {
		$show=$ns_dl_num_results;     
    }
$query = check_html($query, nohtml);
$query = addslashes($query);
$result = $db->sql_query("select lid, cid, title, url, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img FROM ".$prefix."_downloads_downloads where ns_disable='0' && title LIKE '%$query%' OR description LIKE '%$query%' ORDER BY $orderby LIMIT $min,$ns_dl_num_results");
$nrows = $db->sql_numrows($result);
$fullcountresult = $db->sql_query("select lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments FROM ".$prefix."_downloads_downloads WHERE title LIKE '%$query%' OR description LIKE '%$query%' ");
$download_num = $db->sql_numrows($fullcountresult);
$x=0;
$the_query = stripslashes($query);
$the_query = str_replace("\'", "'", $the_query);
menu(1);
echo "<a name=\"searchresults\">";
ns_mod_title3("search_results",""._SEARCHRESULTS."");
OpenTable();
    if ($query != "") {
    	if ($nrows > 0) {
		ns_dl_OpenTable();
		echo "<center><strong><font class=\"title\">"._SEARCHRESULTS4.":</font> ";
		echo "<font color=\"#CC0000\">$the_query</font></strong></center>";
		ns_dl_CloseTable();
		$result2 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories where title LIKE '%$query%' ORDER BY title DESC");
		$scat_num = $db->sql_numrows($result2);
		if ($scat_num > 0) {
			ns_dl_OpenTable();
			echo "<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
			echo "<tr><td><font class=\"title\"><strong>"._USUBCATEGORIES."</strong></font></td></tr></table>";
			ns_dl_CloseTable();
			ns_dl_OpenTable();
			while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {
            	$cid = intval($cid);
		    	$res = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid' && ns_disable='0'");
		    	$numrows = $db->sql_numrows($res);
    			$result3 = $db->sql_query("select cid,title,parentid from ".$prefix."_downloads_categories where cid=$cid");
    	    	list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);
            	$cid3 = intval($cid3);
    				if ($parentid3 > 0) $title3 = getparent($parentid3,$title3);
    			$title3 = preg_replace('#'.$query.'#', "<strong>$query</strong>", $title3);
		    	ns_dl_image($lid, $title);
					if ($numrows < 1) {
						$nomcats = "";
					} else {
						$nomcats = " - <strong>($numrows)</strong>";
					}
    			echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid\">";
				echo "$title3</a>$nomcats<br />";
			}
			if ($numrows < 1) {
				echo "<center><font class=\"title\"><strong>"._NOSUBCATEGORIES."</strong></font></center>";
			}
			ns_dl_CloseTable();
		}
		ns_dl_OpenTable();
		echo "<table width=\"100%\" bgcolor=\"$prbgcolor1\"><tr><td><font color=\"$tttextcolor\"><strong>"._UDOWNLOADS."</strong></font></td></tr></table>";
		ns_dl_CloseTable();
		ns_dl_OpenTable();
	    $orderbyTrans = convertorderbytrans($orderby);
		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">";
		echo "<tr><td width=\"100%\" align=\"center\">";
		if (($mod_title == 1) AND (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/sortdownloads.gif"))) {
			echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name/sortdownloads.gif\" ";
			echo "border=\"0\" title=\""._SORTDOWNLOADS."\">";
		} else {
			echo "<font class=\"title\"><strong>"._SORTDOWNLOADS."</strong></font>";
		}
echo "</td></tr>
<tr><td width=\"100%\" align=\"center\"><strong>[ "._TITLE."</strong> <a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=titleA#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._TITLEAZ."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=titleD#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._TITLEZA."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._DATE."</strong> <a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=dateD#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._DATE2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=dateA#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._DATE1."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._RATING."</strong> <a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=ratingD#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._RATING2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=ratingA#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._RATING1."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._POPULARITY."</strong> <a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=hitsD#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._POPULARITY2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=search&amp;query=$the_query&amp;orderby=hitsA#searchresults\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._POPULARITY1."\"></span></a> <strong>]</strong><br /><br /><strong>"._DSITESSORTED.":</strong> $orderbyTrans</font></center></td></tr></table>";
ns_dl_CloseTable();
ns_download_image();
    while(list($lid, $cid, $title, $url, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img) = $db->sql_fetchrow($result)) {
        $cid = intval($cid);
        $lid = intval($lid);
        $hits = intval($hits);
        $totalvotes = intval($totalvotes);
        $totalcomments = intval($totalcomments);
	    ns_dl_OpenTable();
	    $downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
	    $title = stripslashes($title);
        $description = stripslashes($description);
		$description = preg_replace('#'.$query.'#', "<font color=\"#CC0000\"><strong>$query</strong></font>", $description);
	    $transfertitle = str_replace (" ", "_", $title);
	    $title = preg_replace('#'.$query.'#', "<strong>$query</strong>", $title);
        global $prefix, $db, $admin;
	    echo "<br />";        
	    ns_dl_image($lid, $title);
	    echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
	    newdownloadgraphic($datetime, $time);      
    	popgraphic($hits);
	    ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
	    $result3 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid='$cid'");
	    list($cid3, $title3, $parentid3) = $db->sql_fetchrow($result3);
        $cid3 = intval($cid3);
	    if ($parentid3 > 0) $title3 = getparent($parentid3, $title3);
		echo "<strong>"._CATEGORY.":</strong> <a href=modules.php?name=$module_name&d_op=viewdownload&cid=$cid#cat>$title3</a><br />";
		mktime ("LC_TIME", "$locale");
		preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);	    
    	ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
		detecteditorial($cid, $lid, $transfertitle, 1);
    	ns_dl_admin($lid, $admin);
		ns_dl_CloseTable();
	    $x++;
	}
    $orderby = convertorderbyout($orderby);	
    } else {
    	ns_dl_no_search();
    }
	ns_dl_pagination($type="search", $the_query, $cid, $download_num, $orderby, $min, $max, $show, $x);
    $result_se = $db->sql_query("SELECT ns_dl_show_engines from ".$prefix."_ns_downloads_general");
    list($ns_dl_show_engines) = $db->sql_fetchrow($result_se);
    if ($ns_dl_show_engines == 1) {
    ns_dl_OpenTable();
    echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr>";
    echo "<td align=\"center\"><br /><br /><font class=\"content\">"
	.""._TRY2SEARCH." \"$the_query\" "._INOTHERSENGINES."<br />"
	."<a target=\"_blank\" href=\"http://www.altavista.com/cgi-bin/query?pg=q&amp;sc=on&amp;hl=on&amp;act=2006&amp;par=0&amp;q=$the_query&amp;kl=XX&amp;stype=stext\">Alta Vista</a> - "
	."<a target=\"_blank\" href=\"http://www.hotbot.com/?MT=$the_query&amp;DU=days&amp;SW=web\">HotBot</a> - "
	."<a target=\"_blank\" href=\"http://www.infoseek.com/Titles?qt=$the_query\">Infoseek</a> - "
	."<a target=\"_blank\" href=\"http://www.dejanews.com/dnquery.xp?QRY=$the_query\">Deja News</a> - "
	."<a target=\"_blank\" href=\"http://www.lycos.com/cgi-bin/pursuit?query=$the_query&amp;maxhits=20\">Lycos</a> - "
	."<a target=\"_blank\" href=\"http://search.yahoo.com/bin/search?p=$the_query\">Yahoo</a>"
	."<br />"
	."<a target=\"_blank\" href=\"http://es.linuxstart.com/cgi-bin/sqlsearch.cgi?pos=1&amp;query=$the_query&amp;language=&amp;advanced=&amp;urlonly=&amp;withid=\">LinuxStart</a> - "
	."<a target=\"_blank\" href=\"http://search.1stlinuxsearch.com/compass?scope=$the_query&amp;ui=sr\">1stLinuxSearch</a> - "
	."<a target=\"_blank\" href=\"http://www.google.com/search?q=$the_query\">Google</a> - "
	."<a target=\"_blank\" href=\"http://www.linuxdownloads.com/cgi-bin/search.cgi?query=$the_query&amp;engine=Downloads\">LinuxDownloads</a> - "
	."<a target=\"_blank\" href=\"http://www.freshmeat.net/modules.php?name=Search&amp;query=$the_query\">Freshmeat</a> - "
	."<a target=\"_blank\" href=\"http://www.justlinux.com/bin/search.pl?key=$the_query\">JustLinux</a>"
	."</font><br /><br /></td>";
    echo "</tr></table><br />";
	ns_dl_CloseTable();
	}
} else {
    ns_dl_no_search();
}
CloseTable();
ns_dl_link_bar($maindownload = 1);
}








?>