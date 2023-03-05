<?php
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

if (preg_match("/ns_blocks_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");



function ns_dl_blocks() {
global $prefix, $db, $module_name;
$result = $db->sql_query("select ns_dl_left_block, ns_dl_right_block from ".$prefix."_ns_downloads_blocks");
list($ns_dl_left_block, $ns_dl_right_block) = $db->sql_fetchrow($result);
OpenTable();
echo "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" align=\"center\">";
echo "<tr><td>";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\">";
echo "<tr><td width=\"50%\" height=\"100%\" valign=\"top\">";
ns_dl_OpenTable();
	if ($ns_dl_left_block == 1) {
		ns_dl_blocks_new();
	} elseif ($ns_dl_left_block == 2) {
		ns_dl_blocks_pop();
	} elseif ($ns_dl_left_block == 3) {
		ns_dl_blocks_top();
	}
ns_dl_CloseTable();
echo "</td><td width=\"1\" background=\"#000000\">";
echo "<td width=\"50%\" height=\"100%\" valign=\"top\">";
ns_dl_OpenTable();
	if ($ns_dl_right_block == 1) {
		ns_dl_blocks_new();
	} elseif ($ns_dl_right_block == 2) {
		ns_dl_blocks_pop();
	} elseif ($ns_dl_right_block == 3) {
		ns_dl_blocks_top();
	}
ns_dl_CloseTable();
echo "</td></tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";
CloseTable();
}



function ns_dl_blocks_pop() {
global $prefix, $db, $module_name;
$result_num = $db->sql_query("select ns_dl_show_num from ".$prefix."_ns_downloads_blocks");
list($ns_dl_show_num) = $db->sql_fetchrow($result_num);
$ns_view_dis = ns_dl_admin_view(1);
$result = $db->sql_query("select lid, cid, title, hits from ".$prefix."_downloads_downloads $ns_view_dis order by hits desc limit 0, $ns_dl_show_num");
	if ($db->sql_numrows($result) > 0) {
		$ns_num = 1;
    	echo "<table border=\"0\" cellpadding=\"6\" cellspacing=\"0\" width=\"100%\" align=\"center\">";
    	echo "<tr><td align=\"center\" colspan=\"2\">";
    	echo "<u><strong>"._NSMOSTPOPULAR2."</strong></u><br /><br /></td></tr>";      
    	while(list($lid, $cid, $title, $hits) = $db->sql_fetchrow($result)) {
            $ttitle = preg_replace("/ /", "_", $title);
        	if($hits > 0) {
    			echo "<tr><td align=\"left\" valign=\"top\" width=\"95%\"><strong>$ns_num.</strong>&nbsp;";
    			echo "<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
				echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">$title</a></td>";
    			echo "<td align=\"center\" valign=\"top\" width=\"5%\">$hits</td></tr>";
        	}
		$ns_num++;
    	}
    	echo "</table>";
	}
}



function ns_dl_blocks_top() {
global $prefix, $db, $module_name;
$result_num = $db->sql_query("select ns_dl_show_num from ".$prefix."_ns_downloads_blocks");
list($ns_dl_show_num) = $db->sql_fetchrow($result_num);
$ns_view_dis = ns_dl_admin_view(1);
$result = $db->sql_query("select lid, cid, title, downloadratingsummary from ".$prefix."_downloads_downloads $ns_view_dis order by downloadratingsummary desc limit 0, $ns_dl_show_num");
	if ($db->sql_numrows($result) > 0) {
		$ns_num = 1;
    	echo "<table border=\"0\" cellpadding=\"6\" cellspacing=\"0\" width=\"100%\" align=\"center\">";
    	echo "<tr><td align=\"center\" colspan=\"2\">";
    	echo "<u><strong>"._NSDLBESTRATED2."</strong></u><br /><br /></td></tr>";      
    	while(list($lid, $cid, $title, $downloadratingsummary) = $db->sql_fetchrow($result)) {
            $ttitle = preg_replace("/ /", "_", $title);
        	if($downloadratingsummary > 0) {
    			echo "<tr><td align=\"left\" valign=\"top\" width=\"95%\"><strong>$ns_num.</strong>&nbsp;";
    			echo "<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
				echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">$title</a></td>";
    			echo "<td align=\"center\" valign=\"top\" width=\"5%\">$downloadratingsummary</td></tr>";
        	}
		$ns_num++;
    	}
    	echo "</table>";
	}
}



function ns_dl_blocks_new() {
global $prefix, $db, $module_name;
$result_num = $db->sql_query("select ns_dl_show_num from ".$prefix."_ns_downloads_blocks");
list($ns_dl_show_num) = $db->sql_fetchrow($result_num);
$ns_view_dis = ns_dl_admin_view(1);
$result = $db->sql_query("select lid, cid, title, hits from ".$prefix."_downloads_downloads $ns_view_dis order by date desc limit 0, $ns_dl_show_num");
	if ($db->sql_numrows($result) > 0) {
		$ns_num = 1;
    	echo "<table border=\"0\" cellpadding=\"6\" cellspacing=\"0\" width=\"100%\" align=\"center\">";
    	echo "<tr><td align=\"center\" colspan=\"2\">";
    	echo "<u><strong>"._NSDLNEWESTDOWNLOADS."</strong></u><br /><br /></td></tr>";      
    	while(list($lid, $cid, $title, $hits) = $db->sql_fetchrow($result)) {
            $ttitle = preg_replace("/ /", "_", $title);
        	if($lid > 0) {
    			echo "<tr><td align=\"left\" valign=\"top\" width=\"75%\"><strong>$ns_num.</strong>&nbsp;";
    			echo "<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
				echo "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">$title</a></td>";
    			echo "<td align=\"center\" valign=\"top\" width=\"25%\">$hits</td></tr>";
        	}
		$ns_num++;
    	}
    	echo "</table>";
	}
}




?>