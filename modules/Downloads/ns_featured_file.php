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
if (preg_match("/ns_featured_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");


function ns_dl_main_feat_list() {
global $prefix, $db, $module_name, $mod_title, $mod_title_directory, $ns_theme;
$result_fl = $db->sql_query("select fdid, lid, ns_dl_feat_det, ns_dl_feat_dlength, ns_dl_feat_dimg from ".$prefix."_ns_downloads_nfeatured order by lid");
$num_feat = $db->sql_numrows($result_fl);
if ($num_feat > 0) {
	OpenTable();
    ns_dl_OpenTable();
	if (($mod_title == 1) AND (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/featured_downloads.gif"))) {
    	echo "<center><img src=\"themes/$ns_theme/$mod_title_directory/$module_name/featured_downloads.gif\" title=\"$sitename - "._FEATUREDDOWNLOADS."\" border=\"0\"></a></center>";
	} else {
    	echo "<center><font class=\"title\">"._FEATUREDDOWNLOADS."</font></center>";
	}
    ns_dl_CloseTable();
    CloseTable();
	ns_download_image();
    OpenTable();
	while(list($fdid, $lid, $ns_dl_feat_det, $ns_dl_feat_dlength, $ns_dl_feat_dimg) = $db->sql_fetchrow($result_fl)) {
	$result_tl = $db->sql_query("select cid, title, description, ns_des_img from ".$prefix."_downloads_downloads where lid='$lid'");
	list($cid, $title, $description, $ns_des_img) = $db->sql_fetchrow($result_tl);
	$cid = intval($cid);
	$ttitle = preg_replace ("/ /", "_", $title);
	ns_dl_OpenTable();
	echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" ";
	echo "align=\"center\">";
	echo "<tr><td width=\"100%\"><br />";
	ns_dl_featured_image();
	if ($ns_dl_feat_det == 1) {
		$ftitle  = "<strong><a href=\"modules.php?name=$module_name&d_op=getit";
		$ftitle .= "&amp;lid=$lid#dl\">$title</a></strong>";
	} elseif ($ns_dl_feat_det == 0) {
		$ftitle  = "<strong><a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
		$ftitle .= "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">$title</a></strong>";
	} else {
		$ftitle  = "<strong><a href=\"modules.php?name=$module_name&d_op=getit";
		$ftitle .= "&amp;lid=$lid#dl\">$title</a></strong>";
	}
	echo "<strong>$ftitle</strong>";
	echo "</td></tr></table><br />";
	$result_di = $db->sql_query("SELECT ns_dl_des_img, ns_dl_des_img_pos, ns_dl_des_img_width, ns_dl_des_img_height, ns_dl_pop_win, ns_dl_pop_conform from ".$prefix."_ns_downloads_desc_img");
	list($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_conform) = $db->sql_fetchrow($result_di);
	$result = $db->sql_query("select ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
	list($ns_dl_image_dir) = $db->sql_fetchrow($result);
	$desc_max = $ns_dl_feat_dlength;
	$desc_space = " ";
	if(($ns_dl_feat_dlength != "") && (strlen($description) > $desc_max)) {
		$description = substr(trim($description), 0, $desc_max); 
    	$description = substr($description, 0, strlen($description)-strpos(strrev($description), $desc_space));
    	$description = $description."...";
    	$description .="<br /><br />[ <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails";
		$description .= "&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ttitle#dldetails\">Read Full...</a> ]";
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
		ns_dl_admin_feat($fdid, $lid);
    	echo "</div></td></tr></table><br />";
		ns_dl_CloseTable();
	}
    CloseTable();
	} 
}




function ns_dl_admin_feat($fdid, $lid) {
global $admin, $admin_file;
	if (is_admin($admin)) {
		echo "<br /><br />[ <a href=\"".$admin_file.".php?op=ns_edl_set_featured&amp;fdid=$fdid#set\">";
		echo ""._NSDLFTSET."</a> ] - ";
		echo "[ <a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\">";
		echo ""._NSDLTEDIT."</a> ] - ";
		echo "[ <a href=\"".$admin_file.".php?op=ns_edl_remove_featured&amp;fdid=$fdid#remove\">";
		echo ""._NSDLFTREMOVE."</a> ]";
	}
}




?>