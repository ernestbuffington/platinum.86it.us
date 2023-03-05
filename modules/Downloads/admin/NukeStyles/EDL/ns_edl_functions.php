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

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $prefix, $db, $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;	
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	

include_once("modules/Downloads/admin/NukeStyles/EDL/help/ns_edl_help.php");
include_once("modules/Downloads/ns_downloads_file.php");


function ns_edl_top($anchor) {
global $prefix, $db, $admin_file;
include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=ns_edl_general'>Downloads Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//GraphicAdmin();
echo "<a name=\"$anchor\">";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr><td valign=\"top\" align=\"center\">";
ns_dl_OpenTable();
echo "<br /><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr><td align=\"center\">";
echo "<a href=\"".$admin_file.".php?op=downloads_add#adddl\">";
echo "<img src=\"images/NukeStyles/EDL/admin/edl_title.gif\" border=\"0\"></a>";
$result=$db->sql_query("select * from ".$prefix."_downloads_downloads");
$numrows = $db->sql_numrows($result);
$result_d = $db->sql_query("select lid from ".$prefix."_downloads_downloads where ns_disable='1'");
$numda = $db->sql_numrows($result_d);
	if ($numda < 1) {
		$numda = 0;
	}
echo "<br /><br /><font class=\"content\">"._THEREARE." <strong>$numrows</strong> ";
echo ""._DOWNLOADSINDB."<br /><br />"._THEREARE." <strong>$numda</strong> "._NSDLDISABLEDDLS."</font>";
echo "</td></tr></table><br />";
ns_dl_CloseTable();
}



function ns_edl_bottom() {
echo "<td width=\"8\">&nbsp;</td><td valign=\"top\" width=\"140\">";
ns_ndl_block();
echo "<br />";
ns_edl_block();
echo "</td></tr></table>";
include_once("footer.php");
}



function ns_edl_linkbar($link_bar, $id) {
global $prefix, $db, $admin_file;
ns_dl_OpenTable();
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">";
echo "<tr><td align=\"center\">";
echo "[ <a href=\"javascript:history.go(-1)\">"._NSDLLB1."</a> ] - ";
    if ($link_bar == "table") {	
		$result = $db->sql_query("select mode from ".$prefix."_ns_downloads_theme_mode where id='$id'");
		list($mode) = $db->sql_numrows($result);
		$result2 = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
		list($name) = $db->sql_numrows($result2);	
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_theme#theme\">"._NSDLLB2."</a> ] - ";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_theme_mode&amp;id=$id";
		echo "&amp;mchange=1#mode\">"._NSDLLB3."</a> ] - ";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_table_add&amp;id=$id&amp;name=$name";
		echo "&amp;mode=$mode#add\">"._NSDLLB4."</a> ]";
    }	
echo "</td></tr></table>";
ns_dl_CloseTable();
}



function ns_ndl_block() {
global $prefix, $db, $admin_file;
$admintitle  = "<center>Nuke Admin Links</center>";
$adminblock .= "<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
$newdownloads = $db->sql_numrows($db->sql_query("select * from ".$prefix."_downloads_newdownload"));
	if ($newdownloads < 1) {
		$newdownloads = 0;
	}
$result = $db->sql_query("select * from ".$prefix."_downloads_modrequest where brokendownload='1'");
$totalbrokendownloads = $db->sql_numrows($result);
	if ($totalbrokendownloads < 1) {
		$totalbrokendownloads = 0;
	}
$result2 = $db->sql_query("select * from ".$prefix."_downloads_modrequest where brokendownload='0'");
$totalmodrequests = $db->sql_numrows($result2);
	if ($totalmodrequests < 1) {
		$totalmodrequests = 0;
	}
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads#start\">";
$adminblock .= ""._NSDLNEWDLS."</a> - <strong>$newdownloads</strong>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=DownloadsListBrokenDownloads#broken\">";
$adminblock .= ""._NSBROKENDLS."</a> - <strong>$totalbrokendownloads</strong>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=DownloadsListModRequests#start\">";
$adminblock .= ""._NSDLMODREQUEST."</a> - <strong>$totalmodrequests</strong>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_add#adddl\">";
$adminblock .= ""._NSDLADDDOWNL."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_add_cat#addcat\">";
$adminblock .= ""._NSDLADDCAT."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_add_subcat#addsub\">";
$adminblock .= ""._NSDLADDSUBCAT."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_modify#moddl\">";
$adminblock .= ""._NSDLMODDOWNL."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_modify_cat#modcat\">";
$adminblock .= ""._NSDLMODIFYCAT."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_transfer#transfer\">";
$adminblock .= ""._NSDLTRANSFER."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=DownloadsDownloadCheck#validate\">";
$adminblock .= ""._NSDLVALIDATEDB."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=DownloadsCleanVotes#clean\">";
$adminblock .= ""._NSDLCLEAN."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=downloads_disabled#dis\">";
$adminblock .= ""._NSDLDISABLEDDLS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "</table>";
themesidebox($admintitle, $adminblock);
}



function ns_edl_block() {
global $prefix, $db, $admin_file;
$admintitle  = "<center>EDL Admin Links</center>";
$adminblock .= "<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_general#general\">";
$adminblock .= ""._NSDLGENERALSET."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_fetch#fetch\">";
$adminblock .= ""._NSDLFETCHSETTINGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_theme#theme\">";
$adminblock .= ""._NSDLDESIGNTBS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_upload#up\">";
$adminblock .= ""._NSDLUPLOADSET."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_desc_img#descimg\">";
$adminblock .= ""._NSDLDESCRIPTIONIMGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_manage#manage\">";
$adminblock .= ""._NSDLIMGFILEMANG."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_addmodify#addmod\">";
$adminblock .= ""._NSDLADDMODSET."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_list_featured#featured\">";
$adminblock .= ""._NSDLFEATUREDLINKS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_rating#rate\">";
$adminblock .= ""._NSDLRATECONFIG."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_newpop#newpop\">";
$adminblock .= ""._NSDLNEWPOPSET."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_field#field\">";
$adminblock .= ""._NSDLFIELDSETTINGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_recom#recom\">";
$adminblock .= ""._NSDLRECOMASETTINGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_author#auth\">";
$adminblock .= ""._NSDLAUTHORSETTINGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_blocks#blocks\">";
$adminblock .= ""._NSDLBLOCKSETTINGS."</a>";
$adminblock .= "</td></tr>";
/*
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_batch#start\">";
$adminblock .= ""._NSDLBATCHPROC."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_group#group\">";
$adminblock .= ""._NSDLGROUPSETTINGS."</a>";
$adminblock .= "</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=ns_edl_optimize#default\">";
$adminblock .= ""._NSDLOPTIMIZETBS."</a>";
$adminblock .= "</td></tr>";
*/

$adminblock .= "<tr><td>&nbsp;</td></tr>";
$adminblock .= "<tr><td>";
$adminblock .= "<strong>&#8226;</strong> <a href=\"http://www.platinumnukepro.com/modules.php?name=Forums\" target=\"_blank\">";
$adminblock .= "Platinum Support Forum</a>";
$adminblock .= "</td></tr>";
$adminblock .= "</table>";
themesidebox($admintitle, $adminblock);
}



function ns_edl_test_content() {
echo "<br />";
echo "<a href=\"modules.php?name=Downloads\">Test Enhanced Downloads Module V2.0</a>";
echo "&nbsp;<br /><br />";
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">";
echo "<tr><td valign=\"top\"><div align=\"justify\">Description Test</div></td></tr>";
echo "</table><br /><br /><center><img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\"Download Now\" title=\"Download Now!\" ";
echo "onClick=\"window.location = 'modules.php?name=Downloads'\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\"></center>";
echo "<br /><strong>Version:</strong> 1.0<br /><strong>Compatibility:</strong> <br /><strong>Filesize:</strong> ";
echo "378.66 Kb<br /><strong>Added on:</strong> May-15-2003<br /><strong>Downloads:</strong> 4532<br />";
echo "<strong>Rating:</strong> 10.00 (200 Votes)<br /><br />[ <a href=\"modules.php?name=Downloads\">";
echo "Rate</a> ] - [ <a href=\"modules.php?name=Downloads\">Broken</a> ] - ";
echo "[ <a href=\"modules.php?name=Downloads\">Details</a> ] - ";
echo "[ <a href=\"modules.php?name=Downloads\">1 Comment</a> ]";
echo "<br /><br />";
}



function ns_edl_colorpick($hpage, $id) {
global $admin_file;
echo "<script type=\"text/javascript\">\n";
echo "function help(page) {\n";
echo "OpenWin = this.open(page, \"CtrlWindow\", \"toolbar=no,menubar=no,";
echo "location=no,scrollbars=no,resize=yes,width=400,";
echo "height=400,screenX=600,screenY=600,top=150,left=325\");\n";
echo "}\n";
echo "</script>\n";
echo "&nbsp;<a href=\"javascript:help('".$admin_file.".php?op=ns_help_edl";
echo "&amp;id=$id&amp;hpage=$hpage')\">";
echo "<span style=\"vertical-align=-30%\">";
echo "<img src=\"images/NukeStyles/EDL/admin/colorpick.gif\" border=\"0\" ";
echo "title=\""._NSDLCHOOSECOLOR."\">";
echo "</a></span>";
}



function version() {
	$code = 'function gd_info() {
		 $array = Array(
						  "GD Version" => "",
						  "FreeType Support" => 0,
						  "FreeType Linkage" => "",
						  "T1Lib Support" => 0,
						  "GIF Read Support" => 0,
						"GIF Create Support" => 0,
						"JPG Support" => 0,
						  "PNG Support" => 0,
						  "WBMP Support" => 0,
						  "XBM Support" => 0
					   );
		   $gif_support = 0;

		  ob_start();
		   eval("phpinfo();");
		   $info = ob_get_contents();
		   ob_end_clean();
		 
		  foreach(explode("\n", $info) as $line) {
			  if(strpos($line, "GD Version")!==false)
				  $array["GD Version"] = trim(str_replace("GD Version", "", strip_tags($line)));
			   if(strpos($line, "FreeType Support")!==false)
				  $array["FreeType Support"] = trim(str_replace("FreeType Support", "", strip_tags($line)));
			  if(strpos($line, "FreeType Linkage")!==false)
				  $array["FreeType Linkage"] = trim(str_replace("FreeType Linkage", "", strip_tags($line)));
			  if(strpos($line, "T1Lib Support")!==false)
				  $array["T1Lib Support"] = trim(str_replace("T1Lib Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Read Support")!==false)
				  $array["GIF Read Support"] = trim(str_replace("GIF Read Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Create Support")!==false)
				  $array["GIF Create Support"] = trim(str_replace("GIF Create Support", "", strip_tags($line)));
			  if(strpos($line, "GIF Support")!==false)
				  $gif_support = trim(str_replace("GIF Support", "", strip_tags($line)));
			   if(strpos($line, "JPG Support")!==false)
				   $array["JPG Support"] = trim(str_replace("JPG Support", "", strip_tags($line)));
			   if(strpos($line, "PNG Support")!==false)
				   $array["PNG Support"] = trim(str_replace("PNG Support", "", strip_tags($line)));
			   if(strpos($line, "WBMP Support")!==false)
				   $array["WBMP Support"] = trim(str_replace("WBMP Support", "", strip_tags($line)));
			   if(strpos($line, "XBM Support")!==false)
				   $array["XBM Support"] = trim(str_replace("XBM Support", "", strip_tags($line)));
		   }
		   
		  if($gif_support==="enabled") {
			   $array["GIF Read Support"]   = 1;
			   $array["GIF Create Support"] = 1;
		   }

		   if($array["FreeType Support"]==="enabled"){
			   $array["FreeType Support"] = 1;    }

		   if($array["T1Lib Support"]==="enabled")
			   $array["T1Lib Support"] = 1;     
		  
		   if($array["GIF Read Support"]==="enabled"){
			   $array["GIF Read Support"] = 1;    }

		   if($array["GIF Create Support"]==="enabled")
			   $array["GIF Create Support"] = 1;     

		   if($array["JPG Support"]==="enabled")
			   $array["JPG Support"] = 1;
			   
		   if($array["PNG Support"]==="enabled")
			   $array["PNG Support"] = 1;
			   
		   if($array["WBMP Support"]==="enabled")
			   $array["WBMP Support"] = 1;
			   
		   if($array["XBM Support"]==="enabled")
			   $array["XBM Support"] = 1;
		   
		   return $array;
	  }';

	if(!function_exists("gd_info")){
		eval($code);
	}
}





function ns_debug($wresult) {
global $prefix, $db;
$ns_debug = 1;  
// ADD DB CALL
    if ($ns_debug == 1) {
		if(!$wresult) {
    	    echo ""._ERROR."<br />";
    	    print mysql_error();
	    	die();
		}
    }	
}



} else {
    echo "Access Denied";
}


?>