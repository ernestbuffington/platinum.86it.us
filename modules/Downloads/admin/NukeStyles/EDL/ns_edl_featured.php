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

	
include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_functions.php");
include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_language.php");



function ns_edl_add_featured($lid) {
global $prefix, $db, $admin_file;
ns_edl_top("feat");
ns_edl_featured_top();
ns_dl_OpenTable();

$result_cf = $db->sql_query("select fdid from ".$prefix."_ns_downloads_nfeatured where lid='$lid'");
list($fdid) = $db->sql_fetchrow($result_cf);
$result_di = $db->sql_query("select title, ns_des_img from ".$prefix."_downloads_downloads where lid='$lid'");
list($title, $ns_des_img) = $db->sql_fetchrow($result_di);
	if ($fdid) {
		echo "<br /><br /><center><strong><font class=\"content\">$title</font></strong><br /><br />";
		echo "<br />"._NSDLALREADYFEATURED."<br /><br /><br />";
    	echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" title=\""._NSBFEDIT."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_set_featured";
    	echo "&amp;fdid=$fdid#set'\">&nbsp;&nbsp;";
    	echo "<input type=\"button\" value=\""._NSDLFTREMOVE."\" title=\""._NSDLFTREMOVE2."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_remove_featured";
    	echo "&amp;fdid=$fdid#remove'\">";
		echo "</center><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		die();
	}
echo "<center><br /><br /><strong><font class=\"title\">"._NSDLADDFEATURED."</font>";
echo "<br /><br /><font class=\"content\">$title</font></strong></center><br /><br />";
echo "<form action=\"".$admin_file.".php\" method=\"post\">";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\" colspan=\"2\">";
echo "<strong>"._NSDLFEATUREDDETAILS."</strong>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"radio\" name=\"ns_dl_feat_det\" value=\"1\" checked></td>";
echo "<td align=\"left\">";
echo ""._NSDLDIRECT."";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"radio\" name=\"ns_dl_feat_det\" value=\"0\"></td>";
echo "<td align=\"left\">";
echo ""._NSDLDETAILS."";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">";
echo "<strong>"._NSDLTRUNDESCRIPT."</strong><br />"._NSDLTRUNDESCRIPT2."";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"text\" name=\"ns_dl_feat_dlength\" size=\"10\" ";
echo "value=\"$ns_dl_feat_dlength\"></td>";
echo "<td align=\"left\">";
echo ""._NSDLDESCLENGTH."";
echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLDESCLENGTH2."</td></tr>";
if ($ns_des_img != "") {
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td align=\"center\" colspan=\"2\">";
	echo "<strong>"._NSDLFEATUREDDESIMG."</strong>";
	echo "</td></tr>";
	echo "<tr><td align=\"right\" width=\"50%\">";
	echo "<input type=\"radio\" name=\"ns_dl_feat_dimg\" value=\"1\" checked></td>";
	echo "<td align=\"left\">";
	echo ""._NSBYES."";
	echo "</td></tr>";
	echo "<tr><td align=\"right\" width=\"50%\">";
	echo "<input type=\"radio\" name=\"ns_dl_feat_dimg\" value=\"0\"></td>";
	echo "<td align=\"left\">";
	echo ""._NSBNO."";
    echo "</td></tr>";
} else {
	echo "<input type=\"hidden\" name=\"ns_dl_feat_dimg\" value=\"0\">";
}
echo "</table><br /><br /><br /><center>";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_add_featured_save\">";
echo "<input type=\"submit\" name=\"submit\" value=\""._NSDLBADD."\" ";
echo "title=\""._NSDLBADD."\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLCANCEL."\" title=\""._NSDLCANCEL."\" ";
echo "onClick=\"window.location='javascript:history.go(-1)'\">";
echo "</form></center><br /><br />";    
ns_dl_CloseTable();
ns_edl_bottom();
}



function ns_edl_featured_top() {
OpenTable2();
ns_dl_OpenTable();
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" ";
echo "align=\"center\">";
echo "<tr><td width=\"100%\" align=\"center\">";
echo "<font class=\"title\"><strong>"._NSDLFEATDOWNLOADS."</strong></font>";
echo "</td></tr></table>";
CloseTable2();
ns_dl_CloseTable();
}



function ns_edl_add_featured_save($lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg) {
global $prefix, $db, $admin_file;
$db->sql_query("insert into ".$prefix."_ns_downloads_nfeatured values (NULL, '$lid','$ns_dl_feat_det', '$ns_dl_feat_dlength', '$ns_dl_feat_dimg')");
Header("Location: ".$admin_file.".php?op=ns_edl_list_featured#featured");
}



function ns_edl_remove_featured($fdid, $confirm = 0) {
global $prefix, $db, $admin_file;
	if ($confirm == 1) {	
		$db->$db->sql_query("delete from ".$prefix."_ns_downloads_nfeatured where fdid='$fdid'");
		Header("Location: ".$admin_file.".php?op=ns_edl_list_featured#featured");
	} else {
		ns_edl_top("remove");
		ns_edl_featured_top();
	    ns_dl_OpenTable();   
		echo "<center><br /><br />";
		echo "<strong>"._NSDLSUREDELETEFEATDL."</strong><br />";	
		echo "<br /><br />";
        echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_remove_featured";
        echo "&amp;fdid=$fdid&amp;confirm=1'\">&nbsp;&nbsp;";
        echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
        echo "onClick=\"window.location='javascript:history.go(-1)'\">";
		echo "</center><br /><br />";    
	    ns_dl_CloseTable();
		ns_edl_bottom();
	}
}



function ns_edl_list_featured() {
global $prefix, $db, $module_name, $admin_file;
ns_edl_top("featured");
ns_edl_featured_top();
ns_download_image();
$result_fl = $db->sql_query("select fdid, lid, ns_dl_feat_det, ns_dl_feat_dlength, ns_dl_feat_dimg from ".$prefix."_ns_downloads_nfeatured");
$result_num = $db->sql_query("select fdid from ".$prefix."_ns_downloads_nfeatured");
$num_feat = $db->sql_numrows($result_num);
	if ($num_feat > 0) {
		while(list($fdid, $lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg) = $db->sql_fetchrow($result_fl)) {
		$result_tl = $db->sql_query("select title, description, ns_des_img from ".$prefix."_downloads_downloads where lid='$lid'");
		list($title, $description, $ns_des_img) = $db->sql_fetchrow($result_tl);
		ns_dl_OpenTable();
		echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" ";
		echo "align=\"center\">";
		echo "<tr><td width=\"100%\"><br />";
		ns_dl_featured_image();
		echo "<strong>$title</strong>";
		echo "</td></tr></table><br />";
$ttitle = preg_replace ("/ /", "_", $title);
$result_di = $db->sql_query("SELECT ns_dl_des_img, ns_dl_des_img_pos, ns_dl_des_img_width, ns_dl_des_img_height, ns_dl_pop_win, ns_dl_pop_conform from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_conform) = $db->sql_fetchrow($result_di);
$result = $db->sql_query("select ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result);
$desc_max = $ns_dl_feat_dlength;
$desc_space=" ";
if(($ns_dl_feat_dlength != "") && (strlen($description) > $desc_max )) {
	$description = substr(trim($description),0,$desc_max); 
    $description = substr($description,0,strlen($description)-strpos(strrev($description),$desc_space));
    $description = $description."...";
    $description .="<br /><br />[ <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
	$description .= "&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">Read Full...</a> ]";
} else {
	$description = $description;
}
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">";
echo "<tr><td valign=\"top\"><div align=\"justify\">";
	if ($ns_dl_feat_dimg == 1 && $ns_dl_des_img == 1) {
		    if ($ns_dl_des_img_pos == "l") {
			$pos = "left";
		    } elseif ($ns_dl_des_img_pos == "r") {
			$pos = "right";
		    }
		    $thumb = end(explode("/",$ns_des_img));
		    $ns_directory = "modules/Downloads/".$ns_dl_image_dir;
		    if(file_exists($ns_directory.'/thumb/'.$thumb)) {
			$ns_des_img_thumb = $ns_directory.'/thumb/'.$thumb;
		    } else {
			$ns_des_img_thumb = $ns_des_img;
		    }
	$result_st = $db->sql_query("SELECT ns_dl_use_standard from ".$prefix."_ns_downloads_desc_img");
	list($ns_dl_use_standard) = $db->sql_fetchrow($result_st);
	if ($ns_dl_use_standard == 1) {
	    $widhgt = "";
	} elseif ($ns_dl_use_standard == 0) {
	    $widhgt = "width=\"$ns_dl_des_img_width\" height=\"$ns_dl_des_img_height\"";
	}
if (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 1) AND ($ns_des_img != "")) {
	echo "<center><a href=\"javascript:popImage('$ns_des_img','$title')\">";
	echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
	echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
	echo "alt=\""._NSCLICKVIEW."\"></a></center>";
} elseif (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 0) AND ($ns_des_img != "")) {
	echo "<center><a href=\"javascript:pop('$ns_des_img')\">";
	echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
	echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
	echo "alt=\""._NSCLICKVIEW."\"></a></center>";
} elseif ($ns_des_img != "") {
	echo "<center><img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
	echo "hspace=\"10\" title=\"$title "._NSDLIMAGEVIEW."\"></center>";
}
		echo "$description";
	} else {
		echo "$description";
	}
		echo "<br /><br /><br /><center>";
    	echo "<input type=\"button\" value=\""._NSDLFTSET."\" title=\""._NSDLFTSET2."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_set_featured";
    	echo "&amp;fdid=$fdid#set'\">&nbsp;&nbsp;";
    	echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" title=\""._NSBFEDIT."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=DownloadsModDownload";
    	echo "&amp;lid=$lid'\">&nbsp;&nbsp;";
    	echo "<input type=\"button\" value=\""._NSDLFTREMOVE."\" title=\""._NSDLFTREMOVE2."\" ";
    	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_remove_featured";
    	echo "&amp;fdid=$fdid#remove'\">&nbsp;&nbsp;";
		echo "</center><br /><br />";
    	echo "</div></td></tr></table><br /><br />";
		ns_dl_CloseTable();
		}
	} else {
	ns_dl_OpenTable();
	echo "<br /><br /><center>"._NSDLNOFEATDLS."</center><br /><br />";
	ns_dl_CloseTable();
	}
ns_edl_bottom();
}




function ns_edl_set_featured($fdid) {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_top("set");
ns_edl_featured_top();
$result_sf = $db->sql_query("select lid, ns_dl_feat_det, ns_dl_feat_dlength, ns_dl_feat_dimg from ".$prefix."_ns_downloads_nfeatured where fdid='$fdid'");
list($lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg) = $db->sql_fetchrow($result_sf);
$result_di = $db->sql_query("select title, ns_des_img from ".$prefix."_downloads_downloads where lid='$lid'");
list($title, $ns_des_img) = $db->sql_fetchrow($result_di);
ns_dl_OpenTable();
echo "<form action=\"".$admin_file.".php\" method=\"post\">";
echo "<br /><br /><center><strong><font class=\"content\">$title</font></strong></center><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";


// Option to Attach to Specific Category
// Or, option to show on main or all DL pages.



echo "<tr><td align=\"center\" colspan=\"2\">";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<strong>"._NSDLFEATUREDDETAILS."</strong>";
echo "</td></tr>";
if ($ns_dl_feat_det == 1) {
	$checked = "checked";
	$checked2 = "";
} else {
	$checked = "";
	$checked2 = "checked";
}
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"radio\" name=\"ns_dl_feat_det\" value=\"1\" $checked></td>";
echo "<td align=\"left\">";
echo ""._NSDLDIRECT."";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"radio\" name=\"ns_dl_feat_det\" value=\"0\" $checked2></td>";
echo "<td align=\"left\">";
echo ""._NSDLDETAILS."";
echo "</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<strong>"._NSDLTRUNDESCRIPT."</strong><br />"._NSDLTRUNDESCRIPT2."";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"text\" name=\"ns_dl_feat_dlength\" size=\"10\" ";
echo "value=\"$ns_dl_feat_dlength\"></td>";
echo "<td align=\"left\">";
echo ""._NSDLDESCLENGTH."";
echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLDESCLENGTH2."</td></tr>";
if ($ns_dl_feat_dimg == 1) {
	$checked3 = "checked";
	$checked4 = "";
} else {
	$checked3 = "";
	$checked4 = "checked";
}
if ($ns_des_img != "") {
	echo "<tr><td align=\"center\" colspan=\"2\">";
	echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
	echo "<strong>"._NSDLFEATUREDDESIMG."</strong>";
	echo "</td></tr>";
	echo "<tr><td align=\"right\" width=\"50%\">";
	echo "<input type=\"radio\" name=\"ns_dl_feat_dimg\" value=\"1\" $checked3></td>";
	echo "<td align=\"left\">";
	echo ""._NSBYES."";
	echo "</td></tr>";
	echo "<tr><td align=\"right\" width=\"50%\">";
	echo "<input type=\"radio\" name=\"ns_dl_feat_dimg\" value=\"0\" $checked4></td>";
	echo "<td align=\"left\">";
	echo ""._NSBNO."";
    echo "</td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
} else {
	echo "<tr><td align=\"center\" colspan=\"2\">";
	echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
	echo ""._NSDLNOFEATUREDDESIMG." <a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\">";
	echo ""._EDIT."</a> "._NSDLNOFEATUREDDESIMG2."";
	echo "</td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
}
echo "</table><center>";
echo "<hr color=\"$bgcolor2\" width=\"80%\"><br /><br />";
echo "<input type=\"hidden\" name=\"fdid\" value=\"$fdid\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_set_featured_save\">";
echo "<input type=\"submit\" name=\"submit\" value=\""._NSDLBSAVE."\" ";
echo "title=\""._NSDLBSAVE."\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLCANCEL."\" title=\""._NSDLCANCEL."\" ";
echo "onClick=\"window.location='javascript:history.go(-1)'\">";
echo "</form></center><br />";    
ns_dl_CloseTable();
ns_edl_bottom(); 
}



function ns_edl_set_featured_save($fdid, $lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg) {
global $prefix, $db, $admin_file;
$db->sql_query("update ".$prefix."_ns_downloads_nfeatured set ns_dl_feat_det='$ns_dl_feat_det', ns_dl_feat_dlength='$ns_dl_feat_dlength', ns_dl_feat_dimg='$ns_dl_feat_dimg' where fdid='$fdid' && lid='$lid'");
Header("Location: ".$admin_file.".php?op=ns_edl_list_featured#featured");
}



switch($op) {

    case "ns_edl_add_featured":
    ns_edl_add_featured($lid);
    break;

    case "ns_edl_add_featured_save":
    ns_edl_add_featured_save($lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg);
    break;

    case "ns_edl_list_featured":
    ns_edl_list_featured();
    break;

    case "ns_edl_remove_featured":
    ns_edl_remove_featured($fdid, $confirm);
    break;

    case "ns_edl_set_featured":
    ns_edl_set_featured($fdid);
    break;

    case "ns_edl_set_featured_save";
	ns_edl_set_featured_save($fdid, $lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg);
    break;

}



} else {
echo "Access Denied";
}



?>











