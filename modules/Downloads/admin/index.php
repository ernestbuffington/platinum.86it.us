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
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
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


/*********************************************************/
/* Downloads Modified Web Downloads                      */
/*********************************************************/

function getparent($parentid,$title) {
    global $prefix, $db;
    $result=$db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories where cid='$parentid'");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    if ($ptitle!="") $title=$ptitle."/".$title;
    if ($pparentid!=0) {
	$title=getparent($pparentid,$title);
    }
    return $title;
}


 
function downloads() {
global $prefix, $db, $anonymous, $admin_file;
ns_edl_top("start");
$result = $db->sql_query("select lid, cid, sid, title, url, description, name, email, submitter, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two from ".$prefix."_downloads_newdownload order by lid");
$numrows = $db->sql_numrows($result);
$result_di = $db->sql_query("SELECT ns_dl_mirror_link from ".$prefix."_ns_downloads_general");
list($ns_dl_mirror_link) = $db->sql_fetchrow($result_di);
ns_dl_OpenTable();
if ($numrows > 0) {
	echo "<center><font class=\"content\"><strong>"._DOWNLOADSWAITINGVAL."</strong></font></center><br /><br />";
    while(list($lid, $cid, $sid, $title, $url, $desc, $name, $email, $submitter, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two) = $db->sql_fetchrow($result)) {
	if ($submitter == "") {
		$submitter = $anonymous;
	}
echo "<form action=\"".$admin_file.".php#adddl\" method=\"post\">";
echo ""._DOWNLOADID.": <strong>$lid</strong>";
echo "<br /><br />";
echo ""._SUBMITTER.": <strong>$submitter</strong>";
echo "<br /><br />";
echo ""._DOWNLOADNAME.":<br />";
echo "<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\">";
echo "<br /><br />";
echo ""._FILEURL.":<br />";
echo "<input type=\"text\" name=\"url\" value=\"$url\" size=\"85\" maxlength=\"255\">";
echo "&nbsp;[ <a target=\"_blank\" href=\"$url\">"._CHECK."</a> ]";
echo "<br /><br />";
if ($ns_dl_mirror_link == 1) {
	echo ""._NSMIRRORONE.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_one\" value=\"$ns_mirror_one\" ";
	echo "size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
	echo ""._NSMIRRORTWO.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_two\" value=\"$ns_mirror_two\" ";
	echo "size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
}
echo ""._CATEGORY.":<br /><select name=\"cat\">";
$result2=$db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by title");
    while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
	if ($cid2==$cid) {
	$sel = "selected";
	} else {
	$sel = "";
	}
	if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
    }
echo "</select><br /><br />";
echo ""._DESCRIPTION.":<br />";
wysiwyg_textarea("desc", "$desc", "PHPNukeAdminDL", "120", "25");
echo "<br /><br />";
echo ""._NSDOWNNOTE.":<br />";
wysiwyg_textarea("ns_dl_down_note", "", "PHPNukeAdminDL", "120", "15");
echo "<br /><br />";
echo ""._NSDESIMAGE.":<br />";
echo "<input type=\"text\" name=\"ns_des_img\" value=\"$ns_des_img\" size=\"50\" maxlength=\"100\">";
if ($ns_des_img != "") { 
	echo "[ <a target=\"_blank\" href=\"$ns_des_img\">"._CHECK."</a> ]"; 
}
echo "<br /><br />";
echo ""._AUTHORNAME.":<br />";
echo "<input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\">";
echo "<br /><br />";
echo ""._AUTHOREMAIL.":<br />";
echo "<input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\">";
echo "<br /><br />";
echo ""._NSCOMPAT.":<br />";
echo "<input type=\"text\" name=\"ns_compat\" size=\"20\" maxlength=\"20\" value=\"$ns_compat\">";
echo "<br /><br />";
echo ""._FILESIZE.":<br />";
echo "<input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\" value=\"$filesize\">";
echo "<br /><br />";
echo ""._VERSION.":<br />";
echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\">";
echo "<br /><br />";
echo ""._HOMEPAGE.":<br />";
echo "<input type=\"text\" name=\"homepage\" size=\"75\" maxlength=\"200\" value=\"$homepage\">";
if ($homepage != "") { 
	echo " [ <a href=\"$homepage\" target=\"_blank\">"._VISIT."</a> ]"; 
}
echo "<br /><br />";
echo ""._NSDLDOWNSTATUS.":<br />";
echo "<select name=\"ns_disable\">";
echo "<option value=\"0\" selected>"._NSDLENABLED."</option>";
echo "<option value=\"1\">"._NSDLDISABLED."</option>";
echo "</select>";
echo "<br /><br /><br /><br />";
echo "<input type=\"hidden\" name=\"new\" value=\"1\">";
echo "<input type=\"hidden\" name=\"hits\" value=\"0\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsAddDownload\">";
echo "<center>";
echo "<input type=\"submit\" value=\" "._ADD." \">&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._DELETE."\" title=\""._DELETE."\" ";
echo "onClick=\"window.location = '".$admin_file.".php?op=DownloadsDelNew&amp;lid=$lid'\">";
echo "</center></form><br /><hr><br />";
    }
} else {
	echo "<br /><center><font class=\"content\"><strong>"._NSDLNODOWNLOADSADDED."</strong></font></center><br />";
}
ns_dl_CloseTable();
ns_edl_bottom();
}



function ns_dl_admin_upload() {
global $prefix, $db;
echo "<script language=\"JavaScript\">\n";
echo "function newWindow(file,window) {\n";
echo "msgWindow=open(file,window,'resizable=no,width=450,height=350,top=25,left=200');\n";
echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
echo "}\n";
echo "</script>\n";
}



function downloads_add() {
global $prefix, $db, $admin_file;
$result = $db->sql_query("select cid, title from ".$prefix."_downloads_categories");
$numrows = $db->sql_numrows($result);
$result_di = $db->sql_query("SELECT ns_dl_des_img from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img) = $db->sql_fetchrow($result_di);
$result_di = $db->sql_query("SELECT ns_dl_mirror_link from ".$prefix."_ns_downloads_general");
list($ns_dl_mirror_link) = $db->sql_fetchrow($result_di);
ns_dl_admin_upload();
ns_edl_top("adddl");
ns_dl_OpenTable();    
if ($numrows > 0) {
echo "<br /><form method=\"post\" name=\"add_download\" action=\"".$admin_file.".php#adddl\">";
echo "<center><font class=\"content\"><strong>"._ADDNEWDOWNLOAD."</strong></center>";
echo "<br /><br />";
echo ""._DOWNLOADNAME.":<br />";
echo "<input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\">";
echo "<br /><br />";
echo ""._FILEURL.":<br />";
echo "<input type=\"text\" name=\"url\" size=\"85\" maxlength=\"255\" value=\"\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLUPLOAD."\" onClick=\"newWindow";
echo "('modules.php?name=Downloads&amp;file=ns_uploads_file&amp;type=file','window2')\">";
echo "<br /><br />";
if ($ns_dl_mirror_link == 1) {
	echo ""._NSMIRRORONE.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_one\" size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
	echo ""._NSMIRRORTWO.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_two\" size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
} else {
	echo "<input type=\"hidden\" name=\"ns_mirror_one\" value=\"\">";
	echo "<input type=\"hidden\" name=\"ns_mirror_two\" value=\"\">";
}
$result2=$db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
echo ""._CATEGORY.":<br /><select name=\"cat\">";
echo "<option value=\"\">----------------------------</option>";
    while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
	if ($parentid2 != 0) $ctitle2 = getparent($parentid2,$ctitle2);
	echo "<option value=\"$cid2\">$ctitle2</option>";
    }
echo "</select>";
echo "<br /><br />";
echo ""._DESCRIPTION.":<br />";
wysiwyg_textarea("desc", "", "PHPNukeAdminDL", "120", "25");
echo "<br /><br />";
echo ""._NSDOWNNOTE.":<br />";
wysiwyg_textarea("ns_dl_down_note", "", "PHPNukeAdminDL", "120", "15");
echo "<br /><br />";
if ($ns_dl_des_img == 1) {
	echo ""._NSDESIMAGE.":<br />";
	echo "<input type=\"text\" name=\"ns_des_img\" size=\"40\" maxlength=\"255\">&nbsp;&nbsp;";
	echo "<input type=\"button\" value=\""._NSDLUPLOAD."\" onClick=\"newWindow";
	echo "('modules.php?name=Downloads&amp;file=ns_uploads_file&amp;type=image','window2')\">";
	echo "<br /><br />";
} else {
	echo "<input type=\"hidden\" name=\"ns_des_img\" value=\"\">";
}
echo ""._AUTHORNAME.":<br />";
echo "<input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\">";
echo "<br /><br />";
echo ""._AUTHOREMAIL.":<br />";
echo "<input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\">";
echo "<br /><br />";
echo ""._NSCOMPAT.":<br />";
echo "<input type=\"text\" name=\"ns_compat\" size=\"30\" maxlength=\"50\">";
echo "<br /><br />";
echo ""._FILESIZE.":<br />";
echo "<input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\"> ("._INBYTES.")";
echo "<br /><br />";
echo ""._VERSION.":<br />";
echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\">";
echo "<br /><br />";
echo ""._HOMEPAGE.":<br />";
echo "<input type=\"text\" name=\"homepage\" size=\"90\" maxlength=\"200\">";
echo "<br /><br />";
echo ""._HITS.":<br />";
echo "<input type=\"text\" name=\"hits\" size=\"12\" maxlength=\"11\">";
echo "<br /><br />";
echo ""._NSDLDOWNSTATUS.":<br />";
echo "<select name=\"ns_disable\">";
echo "<option value=\"0\" selected>"._NSDLENABLED."</option>";
echo "<option value=\"1\">"._NSDLDISABLED."</option>";
echo "</select>";
echo "<br /><br /><br /><br /><center>";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsAddDownload\">";
echo "<input type=\"hidden\" name=\"new\" value=\"0\">";
echo "<input type=\"hidden\" name=\"lid\" value=\"0\">";
echo "<input type=\"submit\" value=\""._NSDLADDDOWNL."\"><br />";
echo "</form></center><br />";
} else {
echo "<br /><br /><center>"._NSDLUNEEDTOADDCAT3."</center><br /><br />";
}
ns_dl_CloseTable();    
ns_edl_bottom();
}



function downloads_modify() {
global $prefix, $db, $anonymous, $admin_file;	
$result = $db->sql_query("select * from ".$prefix."_downloads_downloads");
$numrows = $db->sql_numrows($result);
ns_edl_top("moddl");
ns_dl_OpenTable();
if ($numrows > 0) {
echo "<br /><center><form method=\"post\" action=\"".$admin_file.".php\">";
echo "<font class=\"content\"><strong>"._MODDOWNLOAD."</strong><br /><br /><br />";
echo "<select name=\"lid\">";
$result2 = $db->sql_query("select lid, title from ".$prefix."_downloads_downloads order by title");
while(list($lid, $title) = $db->sql_fetchrow($result2)) {
    echo "<option value=\"$lid\">$title</option>";
}
echo "</select><br /><br /><br />";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModDownload\">";
echo "<input type=\"submit\" value=\""._MODIFY."\">";
echo "</form></center><br />";
echo "<br /><br /><center><form method=\"post\" action=\"".$admin_file.".php\">";
echo "<font class=\"content\"><strong>"._MODDOWNLOAD2."</strong><br /><br /><br />";
echo ""._DOWNLOADID."#:<br /><br /><input type=\"text\" name=\"lid\" size=\"12\" maxlength=\"11\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModDownload\"><br /><br />";
echo "<input type=\"submit\" value=\""._MODIFY."\">";
echo "</form></center><br />";
} else {  	
echo "<br /><br /><center>"._NSDLMUSTADDDL."</center><br /><br />";
}   
ns_dl_CloseTable();
ns_edl_bottom();
}  



function downloads_add_cat($ns_catadded) {
global $prefix, $db, $anonymous, $admin_file;
ns_edl_top("addcat");
ns_dl_OpenTable();
echo "<br /><form method=\"post\" action=\"".$admin_file.".php\">";
if ($ns_catadded == 1) {
echo "<center><font class=\"title\"><strong>*** "._NSDLCATADDED." ***</strong></font></center><br /><br />";
}
echo "<center><font class=\"content\"><strong>"._ADDMAINCATEGORY."</strong></font></center><br /><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._NAME.":</strong></font><br />";
echo "<input type=\"text\" name=\"title\" size=\"45\" maxlength=\"100\">";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._DESCRIPTION.":</strong></font><br />";
wysiwyg_textarea("cdesc", "", "PHPNukeAdminDL", "120", "25");
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._NSDLCATNOTE.":</strong></font><br />";
wysiwyg_textarea("ns_cat_note", "", "PHPNukeAdminDL", "120", "15");
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsAddCat\">";
echo "<input type=\"submit\" value=\""._NSDLBADDCAT."\">";
echo "</td></tr></table>";
echo "</form>";
ns_dl_CloseTable();
ns_edl_bottom();
} 



function downloads_add_subcat($ns_catadded) {
global $prefix, $db, $anonymous, $admin_file;
$result = $db->sql_query("select * from ".$prefix."_downloads_categories");
$numrows = $db->sql_numrows($result);
ns_edl_top("addsub");    
ns_dl_OpenTable();
if ($numrows > 0) {	
echo "<br /><form method=\"post\" action=\"".$admin_file.".php\">";
if ($ns_catadded == 1) {
echo "<center><font class=\"title\"><strong>*** "._NSDLSUBCATADDED." ***</strong></font></center><br /><br />";
}
echo "<center><font class=\"content\"><strong>"._ADDSUBCATEGORY."</strong></font></center><br /><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._NAME.":</strong></font>";
echo "</td></tr>";
echo "<tr><td align=\"left\">";
echo "<input type=\"text\" name=\"title\" size=\"45\" maxlength=\"100\">";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._NSDLUNDERMAIN.":</strong></font>";
echo "</td></tr>";
echo "<tr><td align=\"left\">";
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
echo "<select name=\"cid\">";
    while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
	if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	echo "<option value=\"$cid2\">$ctitle2</option>";
    }
echo "</select>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._DESCRIPTION.":</strong></font>";
echo "</td></tr>";
echo "<tr><td align=\"left\">";
wysiwyg_textarea("cdesc", "", "PHPNukeAdminDL", "120", "25");
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"left\">";
echo "<font class=\"content\"><strong>"._NSDLCATNOTE."</strong></font><br />";
wysiwyg_textarea("ns_cat_note", "", "PHPNukeAdminDL", "120", "15");
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsAddSubCat\">";
echo "<input type=\"submit\" value=\""._NSDLBADDSUBCAT."\">";
echo "</td></tr></table>";
echo "</form>";
} else {
echo "<br /><br /><center>"._NSDLMUSTADDMAINCAT."</center><br /><br />";
}
ns_dl_CloseTable();
ns_edl_bottom();
}



function downloads_modify_cat() {
global $prefix, $db, $admin_file;
$result = $db->sql_query("select * from ".$prefix."_downloads_categories");
$numrows = $db->sql_numrows($result);
ns_edl_top("modcat");
ns_dl_OpenTable();   
if ($numrows > 0) {	
echo "<br /><form method=\"post\" action=\"".$admin_file.".php\">";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"content\"><strong>"._MODCATEGORY."</strong></font>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
echo "<tr><td align=\"left\">";
echo "<select name=\"cat\">";
while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    echo "<option value=\"$cid2\">$ctitle2</option>";
}
echo "</select>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModCat\">";
echo "<input type=\"submit\" value=\""._MODIFY."\">";
echo "</td></tr></table>";
echo "</form>";
} else {
echo "<br /><br /><center>"._NSDLUNEEDTOADDCAT2."</center><br /><br />";	
}
ns_dl_CloseTable();   
ns_edl_bottom();
}



function downloads_transfer() {
global $prefix, $db, $admin_file;
$result = $db->sql_query("select * from ".$prefix."_downloads_downloads");
$numrows = $db->sql_numrows($result);
ns_edl_top("transfer");
ns_dl_OpenTable();
if ($numrows > 0) {	
echo "<br /><form method=\"post\" action=\"".$admin_file.".php\">";
echo "<table align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"content\"><strong>"._EZTRANSFERDOWNLOADS."</strong></font>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<font class=\"content\"><strong>"._CATEGORY.":</strong></font>";
echo "</td></tr>";
echo "<tr><td align=\"center\">";
echo "<select name=\"cidfrom\">";
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    echo "<option value=\"$cid2\">$ctitle2</option>";
}
echo "</select>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<font class=\"content\"><strong>"._TO."&nbsp;"._CATEGORY.":</strong></font>";
echo "</td></tr>";
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
echo "<tr><td align=\"center\">";
echo "<select name=\"cidto\">";
while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    echo "<option value=\"$cid2\">$ctitle2</option>";
}
echo "</select>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsTransfer\">";
echo "<input type=\"submit\" value=\""._EZTRANSFER."\"><br />";
echo "</td></tr></table>";
echo "</form>";
} else {
echo "<br /><br /><center>"._NSDLUNEEDTOADDCAT."</center><br /><br />";
}
ns_dl_CloseTable(); 
ns_edl_bottom();
}



function downloads_disabled() {
global $prefix, $db, $bgcolor1, $bgcolor2, $admin_file;
$result_d = $db->sql_query("select lid, title, url from ".$prefix."_downloads_downloads where ns_disable='1' order by title");
$dnum = $db->sql_numrows($result_d);
ns_edl_top("dis");
ns_dl_OpenTable();
if ($dnum > 0) {
	echo "<br /><br />";	
	echo "<table width=\"100%\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
	echo "<tr><td align=\"center\" colspan=\"3\">";
	echo "<font class=\"content\"><strong>"._NSDLDISABLEDLIST."</strong></font>";
	echo "</td></tr>";
	echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
	$dlist = 1;
	$colorswitch = "$bgcolor1";
    while(list($lid, $title, $url) = $db->sql_fetchrow($result_d)) {
		echo "<tr bgcolor=\"$colorswitch\"><td align=\"center\" width=\"5%\">";
		echo "<strong>$dlist.</strong></td><td align=\"left\"><a href=\"$url\" target=\"_blank\">$title</a>";
		echo "</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"button\" value=\""._NSDLBENABLE."\" title=\""._NSDLBENABLE."\" ";
		echo "onClick=\"window.location = '".$admin_file.".php?op=downloads_enable&amp;lid=$lid'\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" title=\""._NSDLBDEDIT."\" ";
		echo "onClick=\"window.location = '".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid#moddl'\">";
		echo "</td></tr>";
		$dlist++;
    		if ($colorswitch == "$bgcolor1") {
    	    	$colorswitch = "$bgcolor2";
    		} else {
    	    	$colorswitch = "$bgcolor1";    	
        	}
    	}
		echo "</table><br /><br />";
	} else {
		echo "<br /><br /><center>"._NSDLNODISABLED."</center><br /><br />";	
	}
ns_dl_CloseTable();   
ns_edl_bottom();
}



function downloads_enable($lid) {
    global $prefix, $db, $admin_file;
    $db->sql_query("update ".$prefix."_downloads_downloads set ns_disable='0' where lid='$lid'");
    Header("Location: ".$admin_file.".php?op=downloads_disabled#dis");
}


function downloads_disable($lid) {
    global $prefix, $db, $admin_file;
    $db->sql_query("update ".$prefix."_downloads_downloads set ns_disable='1' where lid='$lid'");
    Header("Location: ".$admin_file.".php?op=downloads_disabled#dis");
}




function DownloadsTransfer($cidfrom,$cidto) {
    global $prefix, $db, $admin_file;
    $db->sql_query("update ".$prefix."_downloads_downloads set cid=$cidto where cid='$cidfrom'");
    Header("Location: ".$admin_file.".php?op=downloads_add#adddl");
}



function DownloadsModDownload($lid) {
global $prefix, $db, $anonymous, $bgcolor1, $bgcolor2, $admin_file;
ns_edl_top("moddl");
$result = $db->sql_query("select cid, sid, title, url, description, name, email, hits, submitter, filesize, version, homepage, ns_compat, ns_des_img, ns_disable, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where lid='$lid'");
$result_di = $db->sql_query("SELECT ns_dl_mirror_link from ".$prefix."_ns_downloads_general");
list($ns_dl_mirror_link) = $db->sql_fetchrow($result_di);
ns_dl_OpenTable();
echo "<center><font class=\"content\"><strong>"._MODDOWNLOAD."</strong></font></center><br /><br />";
while(list($cid, $sid, $title, $url, $desc, $name, $email, $hits, $submitter, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_disable, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) = $db->sql_fetchrow($result)) {
$title = stripslashes($title); 
$desc = stripslashes($desc);
if ($submitter == "") {
$submitter = $anonymous;
}
ns_dl_admin_upload();
echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"add_download\">";
echo ""._DOWNLOADID.": <strong>$lid</strong><br />";
echo "<br /><br />";
echo ""._SUBMITTER.": <strong>$submitter</strong><br />";
echo "<br /><br />";
echo ""._DOWNLOADNAME.":<br />";
echo "<input type=\"text\" name=\"title\" value=\"$title\" size=\"60\" maxlength=\"100\">";
echo "<br /><br />";
echo ""._FILEURL.":&nbsp;[ <a href=\"$url\" target=\"_blank\">"._CHECK."</a> ]<br />";
echo "<input type=\"text\" name=\"url\" value=\"$url\" size=\"80\" maxlength=\"255\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLUPLOAD."\" onClick=\"newWindow";
echo "('modules.php?name=Downloads&amp;file=ns_uploads_file&amp;type=file','window2')\">";
echo "<br /><br />";
if ($ns_dl_mirror_link == 1) {
	echo ""._NSMIRRORONE.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_one\"  value=\"$ns_mirror_one\" ";
	echo "size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
	echo ""._NSMIRRORTWO.":<br />";
	echo "<input type=\"text\" name=\"ns_mirror_two\"  value=\"$ns_mirror_two\" ";
	echo "size=\"60\" maxlength=\"255\">";
	echo "<br /><br />";
} else {
	echo "<input type=\"hidden\" name=\"ns_mirror_one\" value=\"$ns_mirror_one\">";
	echo "<input type=\"hidden\" name=\"ns_mirror_two\" value=\"$ns_mirror_two\">";
}
$result2 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories order by title");
echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
echo ""._CATEGORY.":<br />";
echo "<select name=\"cat\">";
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
    if ($cid2==$cid) {
    $sel = "selected";
    } else {
    $sel = "";
    }
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
}
echo "</select>";
echo "<br /><br />";
echo ""._DESCRIPTION.":<br />";
wysiwyg_textarea("desc", "$desc", "PHPNukeAdminDL", "120", "25");
echo "<br /><br />";
echo ""._NSDOWNNOTE.":<br />";
wysiwyg_textarea("ns_dl_down_note", "$ns_dl_down_note", "PHPNukeAdminDL", "120", "15");
echo "<br /><br />";
echo ""._NSDESIMAGE.":";
if ($ns_des_img != "") {
echo "&nbsp;[ <a href=\"$ns_des_img\" target=\"_blank\">"._CHECK."</a> ]";
}
echo "<br />";
echo "<input type=\"text\" name=\"ns_des_img\" size=\"60\" maxlength=\"100\" value=\"$ns_des_img\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLUPLOAD."\" onClick=\"newWindow";
echo "('modules.php?name=Downloads&amp;file=ns_uploads_file&amp;type=image','window2')\">";
echo "<br /><br />";
echo ""._AUTHORNAME.":<br />";
echo "<input type=\"text\" name=\"name\" size=\"60\" maxlength=\"100\" value=\"$name\">";
echo "<br /><br />";
echo ""._AUTHOREMAIL.":<br />";
echo "<input type=\"text\" name=\"email\" size=\"60\" maxlength=\"100\" value=\"$email\">";
echo "<br /><br />";
echo ""._NSCOMPAT.":<br />";
echo "<input type=\"text\" name=\"ns_compat\" size=\"30\" maxlength=\"30\" value=\"$ns_compat\">";
echo "<br /><br />";
echo ""._FILESIZE.":<br />";
echo "<input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\" value=\"$filesize\">";
echo "<br /><br />";
echo ""._VERSION.":<br />";
echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\">";
echo "<br /><br />";
echo ""._HOMEPAGE.":<br />";
echo "<input type=\"text\" name=\"homepage\" size=\"90\" maxlength=\"200\" value=\"$homepage\">";
if ($homepage != "") {
echo "&nbsp;[ <a href=\"$homepage\" target=\"_blank\">"._VISIT."</a> ]";
}
echo "<br /><br />";
echo ""._HITS.":<br />";
echo "<input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\">";
    if ($ns_disable == "0") {
	$sel1 = "selected";
	$sel2 = "";
    } elseif ($ns_disable == "1") {
	$sel1 = "";
	$sel2 = "selected";
    }
echo "<br /><br />";
echo ""._NSDLDOWNSTATUS.":<br />";
echo "<select name=\"ns_disable\">";
echo "<option value=\"0\" $sel1>"._NSDLENABLED."</option>";
echo "<option value=\"1\" $sel2>"._NSDLDISABLED."</option>";
echo "</select>";
echo "<br /><br /><br /><br /><center>";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModDownloadS\">";
echo "<input type=\"submit\" value=\""._MODIFY."\">&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._DELETE."\" title=\""._DELETE."\" onClick=\"";
echo "window.location = '".$admin_file.".php?op=DownloadsDelDownload&amp;lid=$lid#delete'\">";
echo "</form><br />";
ns_dl_CloseTable();

    
    /* Modify or Add Editorial */
        
        $resulted2 = $db->sql_query("select adminid, editorialtimestamp, editorialtext, editorialtitle from ".$prefix."_downloads_editorials where downloadid='$lid'");
        $recordexist = $db->sql_numrows($resulted2);
	ns_dl_OpenTable();
    /* if returns 'bad query' status 0 (add editorial) */
    	if ($recordexist == 0) {
    	    echo "<center><font class=\"content\"><strong>"._ADDEDITORIAL."</strong></font></center><br /><br />"
    		."<center><form action=\"".$admin_file.".php\" method=\"post\">"
    		."<input type=\"hidden\" name=\"downloadid\" value=\"$lid\">"
    		.""._EDITORIALTITLE.":<br /><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"65\" maxlength=\"100\"><br /><br />";
	       wysiwyg_textarea("editorialtext", "$editorialtext", "PHPNukeAdminDL", "80", "25");
	       echo "<br /><br />"
        	."</select><br /><input type=\"hidden\" name=\"op\" value=\"DownloadsAddEditorial\"><input type=\"submit\" value=\"  Add  \"></center><br />";
        } else {
    /* if returns 'cool' then status 1 (modify editorial) */
        	while(list($adminid, $editorialtimestamp, $editorialtext, $editorialtitle) = $db->sql_fetchrow($resulted2)) {
        	$editorialtitle = stripslashes($editorialtitle); $editorialtext = stripslashes($editorialtext);
    		preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $editorialtimestamp, $editorialtime);
		$editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
		$date_array = explode("-", $editorialtime); 
		$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
       		$formatted_date = date("F j, Y", $timestamp);         	
        	echo "<center><font class=\"content\"><strong>Modify Editorial</strong></font></center><br /><br />"
        	    ."<form action=\"".$admin_file.".php\" method=\"post\">"
        	    .""._AUTHOR.": $adminid<br />"
        	    .""._DATEWRITTEN.": $formatted_date<br /><br />"
        	    ."<input type=\"hidden\" name=\"downloadid\" value=\"$lid\">"
        	    .""._EDITORIALTITLE.":<br /><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\"><br />"
        	    .""._EDITORIALTEXT.":<br />";
              wysiwyg_textarea("editorialtext", "$editorialtext", "PHPNukeAdminDL", "60", "12");
          echo "<br />"
            	    ."</select><input type=\"hidden\" name=\"op\" value=\"DownloadsModEditorial\"><input type=\"submit\" value=\""._MODIFY."\"> [ <a href=\"".$admin_file.".php?op=DownloadsDelEditorial&amp;downloadid=$lid\">"._DELETE."</a> ]";
                }
    	} 
    ns_dl_CloseTable();
    ns_dl_OpenTable();

    /* Show Comments */

    $result5 = $db->sql_query("SELECT ratingdbid, ratinguser, ratingcomments, ratingtimestamp FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
    $totalcomments = $db->sql_numrows($result5);
    echo "<table valign=\"top\" width=\"100%\" cellpadding=\"4\" cellspacing=\"0\">";
    echo "<tr><td colspan=\"7\"><strong>Download Comments (total comments: $totalcomments)</strong><br /><br /></td></tr>";    
    echo "<tr><td width=\"20\" colspan=\"1\"><strong>User  </strong></td><td colspan=5><strong>Comment  </strong></td><td><strong><center>Delete</center></strong></td><br /></tr>";
    if ($totalcomments == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Comments<br /></font></center></td></tr>";
    $x=0;
    $colorswitch = $bgcolor1;
    while(list($ratingdbid, $ratinguser, $ratingcomments, $ratingtimestamp)=$db->sql_fetchrow($result5)) {
    	$ratingcomments = stripslashes($ratingcomments);
        preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
            $formatted_date = date("F j, Y", $timestamp);
            echo "<tr><td valign=top bgcolor=$colorswitch>$ratinguser</td><td valign=top colspan=5 bgcolor=$colorswitch>$ratingcomments</td><td bgcolor=$colorswitch><center><strong><a href=".$admin_file.".php?op=DownloadsDelComment&lid=$lid&rid=$ratingdbid>X</a></strong></center></td><br /></tr>";                       
    	$x++;
    	if ($colorswitch=="$bgcolor1") $colorswitch="$bgcolor2";
    		else $colorswitch="$bgcolor1";    	
        }    
    	    
    // Show Registered Users Votes

    $result5 = $db->sql_query("SELECT ratingdbid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid' AND ratinguser != 'outside' AND ratinguser != '$anonymous' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<tr><td colspan=7><br /><br /><strong>Registered User Votes (total votes: $totalvotes)</strong><br /><br /></td></tr>";
    echo "<tr><td><strong>User  </strong></td><td><strong>IP Address  </strong></td><td><strong>Rating  </strong></td><td><strong>User AVG Rating  </strong></td><td><strong>Total Ratings  </strong></td><td><strong>Date  </strong></td></font></strong><td><strong><center>Delete</center></strong></td><br /></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Registered User Votes<br /></font></center></td></tr>";
    $x=0;
    $colorswitch="$bgcolor1";
    while(list($ratingdbid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp)=$db->sql_fetchrow($result5)) {
        preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
            $formatted_date = date("F j, Y", $timestamp); 
    	
    	//Individual user information

    	$result2 = $db->sql_query("SELECT rating FROM ".$prefix."_downloads_votedata WHERE ratinguser = '$ratinguser'");
            $usertotalcomments = $db->sql_numrows($result2);
            $useravgrating = 0;
            while(list($rating2)=$db->sql_fetchrow($result2))	$useravgrating = $useravgrating + $rating2;
            $useravgrating = $useravgrating / $usertotalcomments;
            $useravgrating = number_format($useravgrating, 1);
            echo "<tr><td bgcolor=$colorswitch>$ratinguser</td><td bgcolor=$colorswitch>$ratinghostname</td><td bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$useravgrating</td><td bgcolor=$colorswitch>$usertotalcomments</td><td bgcolor=$colorswitch>$formatted_date  </font></strong></td><td bgcolor=$colorswitch><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></strong></center></td></tr><br />";
    	$x++;
    	if ($colorswitch=="$bgcolor1") $colorswitch="$bgcolor2";
    		else $colorswitch="$bgcolor1";    	
        }    
        
    // Show Unregistered Users Votes

    $result5 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid' AND ratinguser = '$anonymous' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<tr><td colspan=7><strong><br /><br />Unregistered User Votes (total votes: $totalvotes)</strong><br /><br /></td></tr>";
    echo "<tr><td colspan=2><strong>IP Address  </strong></td><td colspan=3><strong>Rating  </strong></td><td><strong>Date  </strong></font></td><td><strong><center>Delete</center></strong></td><br /></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Unregistered User Votes<br /></font></center></td></tr>";
    $x=0;
    $colorswitch="$bgcolor1";
    while(list($ratingdbid, $rating, $ratinghostname, $ratingtimestamp) = $db->sql_fetchrow($result5)) {
        preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
        $formatted_date = date("F j, Y", $timestamp); 
        echo "<td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></strong></td><td bgcolor=$colorswitch><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></strong></center></td></tr><br />";           
    	$x++;
    	if ($colorswitch=="$bgcolor1") $colorswitch="$bgcolor2";
    		else $colorswitch="$bgcolor1";    	
        }  
        
    // Show Outside Users Votes

    $result5 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid' AND ratinguser = 'outside' ORDER BY ratingtimestamp DESC");
    $totalvotes = $db->sql_numrows($result5);
    echo "<tr><td colspan=7><strong><br /><br />Outside User Votes (total votes: $totalvotes)</strong><br /><br /></td></tr>";
    echo "<tr><td colspan=2><strong>IP Address  </strong></td><td colspan=3><strong>Rating  </strong></td><td><strong>Date  </strong></td></font></strong><td><strong><center>Delete</center></strong></td><br /></tr>";
    if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Votes from Outside $sitename<br /></font></center></td></tr>";
    $x=0;
    $colorswitch="$bgcolor1"; 
    while(list($ratingdbid, $rating, $ratinghostname, $ratingtimestamp)=$db->sql_fetchrow($result5)) {
        preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
    	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
    	$date_array = explode("-", $ratingtime); 
    	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 
        $formatted_date = date("F j, Y", $timestamp); 
        echo "<tr><td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></strong></td><td bgcolor=$colorswitch><center><strong><a href=".$admin_file.".php?op=DownloadsDelVote&lid=$lid&rid=$ratingdbid>X</a></strong></center></td></tr><br />";   
    	$x++;
    	if ($colorswitch=="$bgcolor1") $colorswitch="$bgcolor2";
    		else $colorswitch="$bgcolor1";
        }            
    echo "<tr><td colspan=6><br /></td></tr>";	    
    echo "</table>";
    }
    echo "</form>";
    ns_dl_CloseTable();
    ns_edl_bottom();
}



function DownloadsDelComment($lid, $rid) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_downloads_votedata SET ratingcomments='' WHERE ratingdbid='$rid'");
$db->sql_query("UPDATE ".$prefix."_downloads_downloads SET totalcomments = (totalcomments - 1) WHERE lid='$lid'");
Header("Location: ".$admin_file.".php?op=DownloadsModDownload&lid=$lid");
}



function DownloadsDelVote($lid, $rid) {
global $prefix, $db, $admin_file;
$db->sql_query("delete from ".$prefix."_downloads_votedata where ratingdbid='$rid'");
$voteresult = $db->sql_query("select rating, ratinguser, ratingcomments FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid'");
$totalvotesDB = $db->sql_numrows($voteresult);
include_once("voteinclude.php");
$db->sql_query("UPDATE ".$prefix."_downloads_downloads SET downloadratingsummary=$finalrating,totalvotes=$totalvotesDB,totalcomments=$truecomments WHERE lid='$lid'");
Header("Location: ".$admin_file.".php?op=DownloadsModDownload&lid=$lid");
}



function DownloadsListBrokenDownloads() {
global $bgcolor1, $bgcolor2, $prefix, $user_prefix, $db, $admin_file, $anonymous;
ns_edl_top("broken");
ns_dl_OpenTable();
$result = $db->sql_query("select requestid, lid, modifysubmitter from ".$prefix."_downloads_modrequest where brokendownload='1' order by requestid");
$totalbrokendownloads = $db->sql_numrows($result);
if ($totalbrokendownloads == 0) {
    echo "<br /><br /><center><font class=\"content\"><strong>"._DNOREPORTEDBROKEN."</strong></font></center><br />";
} else {
	echo "<br /><center><font class=\"content\"><strong>"._DUSERREPBROKEN." ";
	echo "($totalbrokendownloads)</strong></font></center><br /><br /><br />";
	echo "&nbsp;&nbsp;<strong>&#8226;</strong>&nbsp;&nbsp;"._DIGNOREINFO."<br />";
	echo "&nbsp;&nbsp;<strong>&#8226;</strong>&nbsp;&nbsp;"._DDELETEINFO."<br /><br />";
	echo "<table align=\"center\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" border=\"1\"><tr>";
	echo "<td align=\"center\"><strong>"._DOWNLOAD."</strong></td>";
	echo "<td align=\"center\"><strong>"._NSDLDOWNLOADREPORTER."</strong></td>";
	echo "<td align=\"center\"><strong>"._NSDLDOWNLOADOWNER."</strong></td>";
	echo "<td align=\"center\"><strong>"._NSDLDOWNLOADAUTHOR."</strong></td>";
	echo "<td align=\"center\"><strong>"._IGNORE."</strong></td>";
	echo "<td align=\"center\"><strong>"._DELETE."</strong></td>";
	echo "<td align=\"center\"><strong>"._EDIT."</strong></td>";
	echo "</tr>";
    while(list($requestid, $lid, $modifysubmitter)=$db->sql_fetchrow($result)) {	
	$result2 = $db->sql_query("select title, url, name, email, submitter from ".$prefix."_downloads_downloads where lid='$lid'");
    list($title, $url, $name, $authoremail, $owner)=$db->sql_fetchrow($result2);
	$result_Ver = $db->sql_query("select Version_Num from ".$prefix."_config");
	list($Version_Num)=$db->sql_fetchrow($result_Ver);
		if ($Version_Num <= "6.0") {
    		if ($modifysubmitter != "$anonymous") {
    			$result3 = $db->sql_query("select email from ".$user_prefix."_users where uname='$modifysubmitter'");
    			list($email)=$db->sql_fetchrow($result3);
    		}
    		if ($owner != "$anonymous" || $owner != "") {
    			$result4 = $db->sql_query("select email from ".$user_prefix."_users where uname='$owner'");
    			list($owneremail)=$db->sql_fetchrow($result4);
    		}
		} elseif ($Version_Num >= "6.5") {
    		if ($modifysubmitter != "$anonymous") {	
    			$result5 = $db->sql_query("select user_email from ".$user_prefix."_users where username='$modifysubmitter'");
    			list($user_email)=$db->sql_fetchrow($result5);
   			}
    		if ($owner != "$anonymous" || $owner != "") {
    			$result6 = $db->sql_query("select user_email from ".$user_prefix."_users where username='$owner'");
    			list($owneremail)=$db->sql_fetchrow($result6);
    		}
		}
	echo "<tr>";
	echo "<td><a href=\"$url\" target=\"_blank\">$title</a></td>";
	echo "<td align=\"center\">";
		if ($Version_Num <= "6.0") {
    		if ($email == "") {
				echo "$modifysubmitter";
    		} else {
				echo "<a href=\"mailto:$email\">$modifysubmitter</a>";
    		}
		} elseif ($Version_Num >= "6.5") {  
    		if ($user_email == "") {
				echo "$modifysubmitter";
    		} else {
				echo "<a href=\"mailto:$user_email\">$modifysubmitter</a>";
    		}
		}
	echo "</td>";
	echo "<td align=\"center\">";
    	if ($owner == "") {
    		$owner = "Anonymous";
    	}
    	if ($name == "") {
    		$name = "Anonymous";
    	}
    	if ($owneremail == "") {
			echo "$owner";
    	} else {
			echo "<a href=\"mailto:$owneremail\">$owner</a>";
    	}
	echo "</td>";
	echo "<td align=\"center\">";
    	if ($name == "") {
			echo "$name";
    	} else {
			echo "<a href=\"mailto:$authoremail\">$name</a>";
    	}
	echo "</td>";
	echo "<td align=\"center\">";
    echo "<a href=\"".$admin_file.".php?op=DownloadsIgnoreBrokenDownloads&amp;lid=$lid\">";
	echo "<font color=\"#CC0000\">X</font></a>";
	echo "</td>";
	echo "<td align=\"center\">";
    echo "<a href=\"".$admin_file.".php?op=DownloadsDelBrokenDownloads&amp;lid=$lid\">";
	echo "<font color=\"#CC0000\">X</font></a>";
	echo "</td>";
	echo "<td align=\"center\">";
    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid#moddl\">";
	echo "<font color=\"#CC0000\">X</font></a>";
	echo "</td>";
	echo "</tr>";
    }
echo "</table><br /><br />";
}
ns_dl_CloseTable();
ns_edl_bottom();
}



function DownloadsDelBrokenDownloads($lid) {
global $prefix, $db, $admin_file;
$db->sql_query("delete from ".$prefix."_downloads_modrequest where lid='$lid'");
$db->sql_query("delete from ".$prefix."_downloads_downloads where lid='$lid'");
Header("Location: ".$admin_file.".php?op=DownloadsListBrokenDownloads#broken");
}



function DownloadsIgnoreBrokenDownloads($lid) {
global $prefix, $db, $admin_file;
$db->sql_query("delete from ".$prefix."_downloads_modrequest where lid='$lid' and brokendownload='1'");
Header("Location: ".$admin_file.".php?op=DownloadsListBrokenDownloads#broken");
}



function DownloadsListModRequests() {
global $bgcolor2, $prefix, $db;
ns_edl_top("start");
ns_dl_OpenTable();
$result_di = $db->sql_query("SELECT ns_dl_mirror_link from ".$prefix."_ns_downloads_general");
list($ns_dl_mirror_link) = $db->sql_fetchrow($result_di);
$result = $db->sql_query("select requestid, lid, cid, sid, title, url, description, modifysubmitter, name, email, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two from ".$prefix."_downloads_modrequest where brokendownload='0' order by requestid");
$totalmodrequests = $db->sql_numrows($result);
//echo "<center><font class=\"content\"><strong>"._DUSERMODREQUEST." ";
//echo "($totalmodrequests)</strong></font></center><br />";
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td>";
while(list($requestid, $lid, $cid, $sid, $title, $url, $desc, $modifysubmitter, $name, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two) = $db->sql_fetchrow($result)) {
$result2 = $db->sql_query("select cid, sid, title, url, description, name, email, submitter, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two from ".$prefix."_downloads_downloads where lid='$lid'");
list($origcid, $origsid, $origtitle, $origurl, $origdesc, $origname, $origemail, $owner, $origfilesize, $origversion, $orighomepage, $origns_compat, $origns_des_img, $origns_mirror_one, $origns_mirror_two)=$db->sql_fetchrow($result2);
$result3 = $db->sql_query("select title from ".$prefix."_downloads_categories where cid='$cid'");
$result5 = $db->sql_query("select title from ".$prefix."_downloads_categories where cid='$origcid'");
	
	
	########################
	# NEEDS FIXED IN V2.0  #
	########################
	
	/*
	
	if ($modifysubmitter != "$anonymous") {
	$result7 = $db->sql_query("select email from ".$prefix."_users where uname='$modifysubmitter'");
	list($modifysubmitteremail)=$db->sql_fetchrow($result7);	
	}
	
	
	$result8 = $db->sql_query("select email from ".$prefix."_users where uname='$owner'");
	list($owneremail)=$db->sql_fetchrow($result8);
	
	*/
	
	########################
	

	list($cidtitle)=$db->sql_fetchrow($result3);
	list($origcidtitle)=$db->sql_fetchrow($result5);
    $title = stripslashes($title);
    $desc = stripslashes($desc);
    if ($owner == "") {
	    $owner = "administration";
	}
    if ($origsidtitle == "") {
	    $origsidtitle = "-----";
	}
    if ($sidtitle == "") {
	    $sidtitle = "-----";
	}
    	echo "<table width=\"100%\" border=\"1\" bordercolor=\"black\" cellpadding=\"5\" ";
		echo "cellspacing=\"0\" align=\"center\"><tr><td>";
    	echo "<table bgcolor=\"$bgcolor2\" cellpadding=\"5\" cellspacing=\"0\" ";
		echo "align=\"center\" width=\"100%\">";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "<tr><td valign=\"top\" align=\"center\"><strong>"._ORIGINAL."</strong>";
		echo "</td></tr>";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origtitle == $title) {
    	echo ""._TITLE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._TITLE.":</font> ";
	}
    	echo "$origtitle</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origurl == $url) {
    	echo ""._URL.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._URL.":</font> ";
	}
    	echo "<a href=\"$origurl\" target=\"_blank\">$origurl</a></font></td></tr>";
if ($ns_dl_mirror_link == 1) {
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_mirror_one == $ns_mirror_one) {
    	echo ""._NSMIRRORONE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSMIRRORONE.":</font> ";
	}
    	echo "<a href=\"$origns_mirror_one\" target=\"_blank\">$origns_mirror_one</a></font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_mirror_two == $ns_mirror_two) {
    	echo ""._NSMIRRORTWO.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSMIRRORTWO.":</font> ";
	}
    	echo "<a href=\"$origns_mirror_two\" target=\"_blank\">$origns_mirror_two</a></font></td></tr>";
}
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origcidtitle == $cidtitle) {
    	echo ""._CATEGORY.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._CATEGORY.":</font> ";
	}
    	echo "$origcidtitle</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origsidtitle == $sidtitle) {
    	echo ""._SUBCATEGORY.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._SUBCATEGORY.":</font> ";
	}
    	echo "$origsidtitle</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origdesc == $desc) {
    	echo ""._DESCRIPTION.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._DESCRIPTION.":</font> ";
	}
    	echo "$origdesc</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_des_img == $ns_des_img) {
    	echo ""._NSDESIMAGE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSDESIMAGE.":</font> ";
	}
    	echo "<a href=\"$origns_des_img\" target=\"_blank\">$origns_des_img</a></font></td></tr>";
		echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origname == $name) {
    	echo ""._AUTHORNAME.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._AUTHORNAME.":</font> ";
	}
    	echo "$origname</font></td></tr>";
		echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origemail == $email) {
    	echo ""._AUTHOREMAIL.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._AUTHOREMAIL.":</font> ";
	}
    	echo "$origemail</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_compat == $ns_compat) {
    	echo ""._NSCOMPAT.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSCOMPAT.":</font> ";
	}
    	echo "$origns_compat</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origfilesize == $filesize) {
    	echo ""._FILESIZE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._FILESIZE.":</font> ";
	}
    	echo "$origfilesize</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origversion == $version) {
    	echo ""._VERSION.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._VERSION.":</font> ";
	}
    	echo "$origversion</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($orighomepage == $homepage) {
    	echo ""._HOMEPAGE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._HOMEPAGE.":</font> ";
	}
    	echo "<a href=\"$orighomepage\" target=\"_blank\">$orighomepage</a></font></td></tr>";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "</table>";
    	echo "</td></tr><tr><td>";
    	echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\">";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "<tr><td valign=\"top\" align=\"center\"><strong>"._PROPOSED."</strong></td></tr>";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origtitle == $title) {
    	echo ""._TITLE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._TITLE.":</font> ";
	}
    	echo "$title</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origurl == $url) {
    	echo ""._URL.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._URL.":</font> ";
	}
    	echo "<a href=\"$url\" target=\"_blank\">$url</a></font></td></tr>";
if ($ns_dl_mirror_link == 1) {
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_mirror_one == $ns_mirror_one) {
    	echo ""._NSMIRRORONE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSMIRRORONE.":</font> ";
	}
    	echo "<a href=\"$ns_mirror_one\" target=\"_blank\">$ns_mirror_one</a></font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_mirror_two == $ns_mirror_two) {
    	echo ""._NSMIRRORTWO.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSMIRRORTWO.":</font> ";
	}
    	echo "<a href=\"$ns_mirror_two\" target=\"_blank\">$ns_mirror_two</a></font></td></tr>";
}
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origcidtitle == $cidtitle) {
    	echo ""._CATEGORY.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._CATEGORY.":</font> ";
	}
    	echo "$cidtitle</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origsidtitle == $sidtitle) {
    	echo ""._SUBCATEGORY.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._SUBCATEGORY.":</font> ";
	}
    	echo "$sidtitle</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origdesc == $desc) {
    	echo ""._DESCRIPTION.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._DESCRIPTION.":</font> ";
	}
    	echo "$desc</font></td></tr>";
    	echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_des_img == $ns_des_img) {
    	echo ""._NSDESIMAGE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSDESIMAGE.":</font> ";
	}
    	echo "<a href=\"$ns_des_img\" target=\"_blank\">$ns_des_img</a></font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origname == $name) {
    	echo ""._AUTHORNAME.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._AUTHORNAME.":</font> ";
	}
    	echo "$name</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origemail == $email) {
    	echo ""._AUTHOREMAIL.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._AUTHOREMAIL.":</font> ";
	}
    	echo "$email</td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origns_compat == $ns_compat) {
    	echo ""._NSCOMPAT.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._NSCOMPAT.":</font> ";
	}
    	echo "$ns_compat</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origfilesize == $filesize) {
    	echo ""._FILESIZE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._FILESIZE.":</font> ";
	}
    	echo "$filesize</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($origversion == $version) {
    	echo ""._VERSION.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._VERSION.":</font> ";
	}
    	echo "$version</font></td></tr>";
	    echo "<tr><td valign=\"top\"><font class=\"tiny\">";
	if ($orighomepage == $homepage) {
    	echo ""._HOMEPAGE.": ";
	} else {
    	echo "<font color=\"#CC0000\">"._HOMEPAGE.":</font> ";
	}
    	echo "<a href=\"$homepage\" target=\"_blank\">$homepage</a></font></td></tr>";
    	echo "</td></tr>";
		echo "<tr><td>&nbsp;</td></tr>";
    	echo "</table></td></tr></table><br /><br />";
    	echo "<table align=\"center\" cellpadding=\"10\" cellspacing=\"0\" width=\"100%\">";
    	echo "<tr>";
    	if ($modifysubmitteremail=="") {
	    echo "<td align=\"left\"><font class=\"tiny\"><strong>"._SUBMITTER.":</strong> ";
		echo "$modifysubmitter</font></td>";
	} else {
	    echo "<td align=\"left\"><font class=\"tiny\"><strong>"._SUBMITTER.":</strong> ";
		echo "<a href=\"mailto:$modifysubmitteremail\">$modifysubmitter</a></font></td>";
	}
    	if ($owneremail=="") {
	    echo "<td align=\"right\"><font class=\"tiny\"><strong>"._OWNER.":</strong> ";
		echo "$owner</font></td>";
	} else {
	    echo "<td align=\"right\"><font class=\"tiny\"><strong>"._OWNER.":</strong> ";
		echo "<a href=\"mailto:$owneremail\">$owner</a></font></td>";
	}
    	echo "</tr>";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo "<input type=\"button\" value=\""._ACCEPT."\" title=\""._ACCEPT."\" ";
		echo "onClick=\"window.location = '".$admin_file.".php?op=DownloadsChangeModRequests";
		echo "&amp;requestid=$requestid'\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._IGNORE."\" title=\""._IGNORE."\" ";
		echo "onClick=\"window.location = '".$admin_file.".php?op=DownloadsChangeIgnoreRequests";
		echo "&amp;requestid=$requestid'\">";
		echo "</td></tr></table><br /><br />";
    }
    if ($totalmodrequests == 0) {
		echo "<br /><center><strong>"._NSNOMODREQUESTS."</strong></center><br />";
    }
    echo "</td></tr></table>";
    ns_dl_CloseTable();
    ns_edl_bottom();
}



function DownloadsChangeModRequests($requestid) {
    global $prefix,$admin_file, $db;
    $result = $db->sql_query("select requestid, lid, cid, sid, title, url, description, name, email, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two from ".$prefix."_downloads_modrequest where requestid='$requestid'");
    while(list($requestid, $lid, $cid, $sid, $title, $url, $desc, $name, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two)=$db->sql_fetchrow($result)) {
	$title = stripslashes($title);
    	$desc = stripslashes($desc);
    	$db->$db->sql_query("UPDATE ".$prefix."_downloads_downloads SET cid=$cid, sid=$sid, title='$title', url='$url', description='$desc', name='$name', email='$email', filesize='$filesize', version='$version', homepage='$homepage', ns_compat='$ns_compat', ns_des_img='$ns_des_img', ns_mirror_one='$ns_mirror_one', ns_mirror_two='$ns_mirror_two' where lid='$lid'");
	$db->$db->sql_query("delete from ".$prefix."_downloads_modrequest where requestid='$requestid'");
    }
    Header("Location: ".$admin_file.".php?op=DownloadsListModRequests#start");
}



function DownloadsChangeIgnoreRequests($requestid) {
global $prefix, $db, $admin_file;
$db->sql_query("delete from ".$prefix."_downloads_modrequest where requestid='$requestid'");
Header("Location: ".$admin_file.".php?op=DownloadsListModRequests#start");
}



function DownloadsCleanVotes($clean_votes = "no") {
global $prefix, $db, $admin_file;
if ($clean_votes == "yes") { 
    $totalvoteresult = $db->sql_query("select distinct ratinglid FROM ".$prefix."_downloads_votedata");
    while(list($lid)=$db->sql_fetchrow($totalvoteresult)) {
	$voteresult = $db->sql_query("select rating, ratinguser, ratingcomments FROM ".$prefix."_downloads_votedata WHERE ratinglid='$lid'");
	$totalvotesDB = $db->sql_numrows($voteresult);
	include_once("voteinclude.php");
        $db->sql_query("UPDATE ".$prefix."_downloads_downloads SET downloadratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid='$lid'");
    }
    Header("Location: ".$admin_file.".php?op=downloads_add#adddl");
}
    ns_edl_top("clean");
    ns_dl_OpenTable();   
	echo "<center><br /><br />";
	echo "<strong>"._NSDLSURECLEANVOTE."</strong><br />";	
	echo "<br /><br />";
    echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
    echo "onClick=\"window.location='".$admin_file.".php?op=DownloadsCleanVotes";
    echo "&amp;clean_votes=yes'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
    echo "onClick=\"window.location='javascript:history.go(-1)'\">";
	echo "</center><br /><br />";    
    ns_dl_CloseTable();
ns_edl_bottom();
}



function DownloadsModDownloadS($lid, $title, $url, $desc, $name, $email, $hits, $cat, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_disable, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) {
global $prefix, $db, $admin_file;
$cat = explode("-", $cat);
    if ($cat[1]=="") {
        $cat[1] = 0;
    }
$title = stripslashes(FixQuotes($title));
$url = stripslashes(FixQuotes($url));
$desc = stripslashes(FixQuotes($desc));
$ns_dl_down_note = stripslashes(FixQuotes($ns_dl_down_note));
$name = stripslashes(FixQuotes($name));
$email = stripslashes(FixQuotes($email));
    if (($homepage == "http://") OR ($homepage == "http:///")) {
    	$homepage = ""; 
    }
$db->sql_query("update ".$prefix."_downloads_downloads set cid='$cat[0]', sid='$cat[1]', title='$title', url='$url', description='$desc', name='$name', email='$email', hits='$hits', filesize='$filesize', version='$version', homepage='$homepage', ns_compat='$ns_compat', ns_des_img='$ns_des_img', ns_disable='$ns_disable', ns_mirror_one='$ns_mirror_one', ns_mirror_two='$ns_mirror_two', ns_dl_down_note='$ns_dl_down_note' where lid='$lid'");
Header("Location: ".$admin_file.".php?op=downloads_modify#moddl");
}



function DownloadsDelDownload($lid, $delfile, $delimg, $deldl = "no") {
global $prefix, $db, $admin_file;
if ($deldl == "yes") { 
	$result_dir = $db->sql_query("select ns_dl_file_dir, ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
	list($ns_dl_file_dir, $ns_dl_image_dir) = $db->sql_fetchrow($result_dir);
		if ($delfile == "yes") {  
			$fpath = "modules/Downloads/$ns_dl_file_dir";
			$fdir = opendir($fpath);
			while ($file = readdir($fdir)) {
    			if (!is_dir($file)) {
					if (preg_match("/[.]/",$file)) {
						$file = preg_replace("/ /","_",$file);
						$ffile = "$fpath/$file";			
						$result_dl = $db->sql_query("select url from ".$prefix."_downloads_downloads where url='$ffile' && lid='$lid'");
						list($url) = $db->sql_fetchrow($result_dl);
	    					if ($url == $ffile) {
    							if (!@chmod($ffile, 0777)) {
									ns_edl_top("filedel");
									ns_dl_OpenTable();
									OpenTable2();
									echo "<center><font class=\"title\">";
									echo ""._NSDLMANAGEFLIMG."</font></center>";
									CloseTable2();
									ns_dl_CloseTable();
									ns_dl_OpenTable();
									echo "<br /><br />";
									echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" ";
									echo "border=\"0\">";
									echo "<tr><td colspan=\"2\" align=\"center\">";
									echo ""._NSDLUNLINKFILECHM."<br /><br /><br /><strong>$file</strong>";
									echo "<br /><br /><br />"._NSDLUNLINKFILE2."";
									echo "<br /><br /><br />"._GOBACK."";
									echo "</td></tr>";
									echo "</table><br /><br />";
									ns_dl_CloseTable();
									ns_edl_bottom(); 
								}
								if (!@unlink($ffile)) {
									ns_edl_top("filedel");
									ns_dl_OpenTable();
									OpenTable2();
									echo "<center><font class=\"title\">";
									echo ""._NSDLMANAGEFLIMG."</font></center>";
									CloseTable2();
									ns_dl_CloseTable();
									ns_dl_OpenTable();
									echo "<br /><br />";
									echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" ";
									echo "border=\"0\">";
									echo "<tr><td colspan=\"2\" align=\"center\">";
									echo ""._NSDLUNLINKFILE."<br /><br /><br /><strong>$file</strong>";
									echo "<br /><br /><br />"._NSDLUNLINKFILE2."";
									echo "<br /><br /><br />"._GOBACK."";
									echo "</td></tr>";
									echo "</table><br /><br />";
									ns_dl_CloseTable();
									ns_edl_bottom();
								}
	    					}
						} 
    				}
				}
				closedir($fdir);
			}
		if ($delimg == "yes") {
			$ipath = "modules/Downloads/$ns_dl_image_dir";
			$idir = opendir($ipath);
			while ($file = readdir($idir)) {
    			if (!is_dir($file)) {
					if (preg_match("/[.]/",$file)) {	
						$ifile = "$ipath/$file";			
						$result_dli = $db->sql_query("select ns_des_img from ".$prefix."_downloads_downloads where ns_des_img='$ifile' && lid='$lid'");
						list($ns_des_img) = $db->sql_fetchrow($result_dli);
	    					if ($ns_des_img == $ifile) {
    							if (!@chmod($ifile, 0777)) {
									ns_edl_top("imgdel");
									ns_dl_OpenTable();
									OpenTable2();
									echo "<center><font class=\"title\">";
									echo ""._NSDLMANAGEFLIMG."</font></center>";
									CloseTable2();
									ns_dl_CloseTable();
									ns_dl_OpenTable();
									echo "<br /><br />";
									echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" ";
									echo "border=\"0\">";
									echo "<tr><td colspan=\"2\" align=\"center\">";
									echo ""._NSDLUNLINKIMGCHM."<br /><br />";
									echo "<br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKIMG2."";
									echo "<br /><br /><br />"._GOBACK."";
									echo "</td></tr>";
									echo "</table><br /><br />";
									ns_dl_CloseTable();
									ns_edl_bottom(); 
    							}
    							if (!@unlink($ifile)) {
									ns_edl_top("imgdel");
									ns_dl_OpenTable();
									OpenTable2();
									echo "<center><font class=\"title\">";
									echo ""._NSDLMANAGEFLIMG."</font></center>";
									CloseTable2();
									ns_dl_CloseTable();
									ns_dl_OpenTable();
									echo "<br /><br />";
									echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" ";
									echo "border=\"0\">";
									echo "<tr><td colspan=\"2\" align=\"center\">";
									echo ""._NSDLUNLINKIMG."<br /><br />";
									echo "<br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKIMG2."";
									echo "<br /><br /><br />"._GOBACK."";
									echo "</td></tr>";
									echo "</table><br /><br />";
									ns_dl_CloseTable();
									ns_edl_bottom();
    							}
	    					}
						} 
    				}
				}
				closedir($idir);
			}
			$db->$db->sql_query("delete from ".$prefix."_downloads_downloads where lid='$lid'");
			Header("Location: ".$admin_file.".php?op=downloads_modify#moddl");
		}
	ns_edl_top("delete");
	ns_dl_OpenTable(); 
	echo "<br /><br /><center><strong>"._NSDLSUREDELETEDL."</strong></center><br />";
	echo "<form method=\"post\" action=\"".$admin_file.".php\">";
	echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
	echo "<tr><td align=\"right\">";
	echo "<strong>"._NSDLDELFILE2.":</strong></td>";
	echo "<td align=\"left\">";
	echo "<input type=\"checkbox\" name=\"delfile\" value=\"yes\"> ";
	echo "</td></tr>";
	echo "<tr><td align=\"right\">";
	echo "<strong>"._NSDLDELIMG2.":</strong></td>";
	echo "<td align=\"left\">";
	echo "<input type=\"checkbox\" name=\"delimg\" value=\"yes\"> ";
	echo "</td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\">";
	echo "<input type=\"hidden\" name=\"deldl\" value=\"yes\">";
	echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
	echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsDelDownload\">";
	echo "<input type=\"submit\" value=\""._NSBYES."\" title=\""._NSYES."\">&nbsp;&nbsp;";
	echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
	echo "onClick=\"window.location='javascript:history.go(-1)'\">";
	echo "</td></tr></table>";
	echo "</form>";
	ns_dl_CloseTable();
	ns_edl_bottom();
}



function DownloadsModCat($cat) {
global $prefix, $db, $admin_file;
ns_edl_top("modcat");
$cat = explode("-", $cat);
    if ($cat[1]=="") {
        $cat[1] = 0;
    }
ns_dl_OpenTable();
echo "<br /><br /><center><font class=\"content\"><strong>"._MODCATEGORY."</strong></font></center><br /><br />";
if ($cat[1]==0) {
$result=$db->sql_query("select title, cdescription, ns_cat_note from ".$prefix."_downloads_categories where cid='$cat[0]'");
list($title, $cdesc, $ns_cat_note) = $db->sql_fetchrow($result);
$cdesc = stripslashes($cdesc);
$ns_cat_note = stripslashes($ns_cat_note);
echo "<table width=\"450\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\">";
echo "<form action=\"".$admin_file.".php\" method=\"get\">";
echo "<font class=\"content\"><strong>"._NAME.":</strong></font><br />";
echo "<input type=\"text\" name=\"title\" value=\"$title\" size=\"51\" maxlength=\"50\">";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\">";
echo "<font class=\"content\"><strong>"._DESCRIPTION.":</strong></font><br />";
wysiwyg_textarea("cdesc", "$cdesc", "PHPNukeAdminDL", "120", "25");
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"left\">";
echo "<font class=\"content\"><strong>"._NSDLCATNOTE."</strong></font><br />";
wysiwyg_textarea("ns_cat_note", "$ns_cat_note", "PHPNukeAdminDL", "120", "15");
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">";
echo "<input type=\"hidden\" name=\"sub\" value=\"0\">";
echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsModCatS\">";
echo "<input type=\"submit\" value=\""._NSDLBSAVE."\"></form></td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<form action=\"".$admin_file.".php#delcat\" method=\"get\">";
echo "<input type=\"hidden\" name=\"sub\" value=\"0\">";
echo "<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">";
echo "<input type=\"hidden\" name=\"op\" value=\"DownloadsDelCat\">";
echo "<input type=\"submit\" value=\""._DELETE."\"></form>";
echo "</td></tr></table><br /><br />";
    } 
    ns_dl_CloseTable();
    ns_edl_bottom();
}



function DownloadsModCatS($cid, $sid, $sub, $title, $cdescription, $ns_cat_note) {
    global $prefix, $db, $admin_file;
    if ($sub==0) {
    $db->sql_query("update ".$prefix."_downloads_categories set title='$title', cdescription='$cdescription', ns_cat_note='$ns_cat_note' where cid='$cid'");
    } 
    Header("Location: ".$admin_file.".php?op=downloads_modify_cat#modcat");
}



function DownloadsDelCat($cid, $sid, $sub, $ok = 0) {
global $prefix, $db, $admin_file;
if($ok == 1) {
	if ($sub > 0) {
    	$db->$db->sql_query("delete from ".$prefix."_downloads_categories where cid='$cid'");
		$db->$db->sql_query("delete from ".$prefix."_downloads_downloads where cid='$cid'");
	} else {
		$db->$db->sql_query("delete from ".$prefix."_downloads_downloads where cid='$cid'");
    	$result2 = $db->sql_query("select cid from ".$prefix."_downloads_categories where parentid='$cid'");
    	while(list($cid2) = $db->sql_fetchrow($result2)) {
		$db->$db->sql_query("delete from ".$prefix."_downloads_downloads where cid='$cid2'");
	}
		$db->$db->sql_query("delete from ".$prefix."_downloads_categories where parentid='$cid'");
		$db->$db->sql_query("delete from ".$prefix."_downloads_categories where cid='$cid'");
	}
		Header("Location: ".$admin_file.".php?op=downloads_modify_cat#modcat");    
} else {	
	$result = $db->sql_query("select * from ".$prefix."_downloads_categories where parentid='$cid'");
	$nbsubcat = $db->sql_numrows($result);
	$result2 = $db->sql_query("select cid from ".$prefix."_downloads_categories where parentid='$cid'");
	while(list($cid2) = $db->sql_fetchrow($result2)) {
	$result3 = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid2'");
	$nblink += $db->sql_numrows($result3);
	if ($nblink < 1) {
		$nblink = 0;
	}
}
	ns_edl_top("delcat");
	ns_dl_OpenTable();
	echo "<br /><center><font class=\"option\">";
	echo ""._EZTHEREIS." <strong>$nbsubcat</strong> "._EZSUBCAT." "._EZATTACHEDTOCAT."<br /><br />";
	echo ""._EZTHEREIS." <strong>$nblink</strong> "._DOWNLOADS." "._EZATTACHEDTOCAT."<br /><br />";
	echo "<strong>"._NSDELCATWARNING."</strong><br /><br />";
    }
	echo "[ <a href=\"".$admin_file.".php?op=DownloadsDelCat&amp;cid=$cid&amp;sid=$sid";
	echo "&amp;sub=$sub&amp;ok=1\">"._YES."</a> ] - ";
	echo "[ <a href=\"".$admin_file.".php?op=downloads_modify_cat#modcat\">"._NO."</a> ]<br /><br />";
	ns_dl_CloseTable();
	ns_edl_bottom();	
}



function DownloadsDelNew($lid) {
    global $prefix, $db, $admin_file;
    $db->sql_query("delete from ".$prefix."_downloads_newdownload where lid='$lid'");
    Header("Location: ".$admin_file.".php?op=downloads_add#adddl");
}



function DownloadsAddCat($title, $cdescription, $ns_cat_note) {
global $prefix, $db, $admin_file;
$result = $db->sql_query("select cid from ".$prefix."_downloads_categories where title='$title'");
$numrows = $db->sql_numrows($result);
    if ($title == "") {
		ns_edl_top("addcat");
		ns_dl_OpenTable();
		echo "<br /><center><font class=\"content\">";
		echo "<strong>"._NSDLNOCATTITLE."</strong></font><br /><br />";
		echo "<a href=\"".$admin_file.".php?op=downloads_add_cat#addcat\">"._NSDLNOBACK."</a></center><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		die();
    } elseif ($numrows > 0) {
		ns_edl_top("addcat");
		ns_dl_OpenTable();
		echo "<br /><center><font class=\"content\">";
		echo "<strong>"._ERRORTHECATEGORY."<br /><br /><font color=\"#CC0000\">$title</font>";
		echo "<br /><br />"._ALREADYEXIST."</strong></font>";
		echo "<br /><br /><a href=\"".$admin_file.".php?op=downloads_add_cat#addcat\">"._NSDLNOBACK."</a><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		die();
    } else { 	
		$db->$db->sql_query("insert into ".$prefix."_downloads_categories values (NULL, '$title', '$cdescription', '$parentid','$ns_cat_note')");
		Header("Location: ".$admin_file.".php?op=downloads_add_cat&ns_catadded=1#addcat");
    }
}



function DownloadsAddSubCat($cid, $title, $cdescription, $ns_cat_note) {
global $prefix, $db, $admin_file;
$result = $db->sql_query("select cid from ".$prefix."_downloads_categories where title='$title' AND cid='$cid'");
$numrows = $db->sql_numrows($result);
    if ($title == "") {
		ns_edl_top("addcat");
		ns_dl_OpenTable();
		echo "<br /><center><font class=\"content\">";
		echo "<strong>"._NSDLNOTITLE."</strong></font><br /><br />";
		echo "<a href=\"".$admin_file.".php?op=downloads_add_subcat#addsub\">";
		echo ""._NSDLNOBACK."</a></center><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		die();
    } elseif ($numrows > 0) {
		ns_edl_top("addsub");
		ns_dl_OpenTable();
		echo "<br /><center>";
		echo "<font class=\"content\">";
		echo "<strong>"._ERRORTHESUBCATEGORY."<br /><br /><font color=\"#CC0000\">$title</font>";
		echo "<br /><br />"._ALREADYEXIST."</strong></font>";
		echo "<br /><br /><a href=\"".$admin_file.".php?op=downloads_add_subcat#addsub\">";
		echo ""._NSDLNOBACK."</a>";
		echo "<br /><br />";
		ns_edl_bottom();
		die();
    } else {
		$db->$db->sql_query("insert into ".$prefix."_downloads_categories values (NULL, '$title', '$cdescription', '$cid', '$ns_cat_note')");
		Header("Location: ".$admin_file.".php?op=downloads_add_subcat&ns_catadded=1#addsub");
    }
}



function DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext) {
    global $aid, $prefix, $db, $admin_file;
    $editorialtext = stripslashes(FixQuotes($editorialtext));
    $db->sql_query("insert into ".$prefix."_downloads_editorials values ($downloadid, '$aid', now(), '$editorialtext', '$editorialtitle')");
    include_once("header.php");
    GraphicAdmin();
    ns_dl_OpenTable();
    echo "<center><br />"
	."<font class=option>"
	.""._EDITORIALADDED."<br /><br />"
	."[ <a href=\"".$admin_file.".php?op=downloads_add#adddl\">"._WEBDOWNLOADSADMIN."</a> ]<br /><br />";
    echo "$downloadid  $adminid, $editorialtitle, $editorialtext";
    ns_dl_CloseTable();
    include_once("footer.php");
}



function DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext) {
    global $prefix, $db, $admin_file;
    $editorialtext = stripslashes(FixQuotes($editorialtext));
    $db->sql_query("update ".$prefix."_downloads_editorials set editorialtext='$editorialtext', editorialtitle='$editorialtitle' where downloadid='$downloadid'");
    include_once("header.php");
    GraphicAdmin();
    ns_dl_OpenTable();
    echo "<br /><center>"
	."<font class=\"content\">"
	.""._EDITORIALMODIFIED."<br /><br />"
	."[ <a href=\"".$admin_file.".php?op=downloads_add#adddl\">"._WEBDOWNLOADSADMIN."</a> ]<br /><br />";
    ns_dl_CloseTable();
    include_once("footer.php");    
}



function DownloadsDelEditorial($downloadid) {
    global $prefix, $db, $admin_file;
    $db->sql_query("delete from ".$prefix."_downloads_editorials where downloadid='$downloadid'");
    include_once("header.php");
    GraphicAdmin();
    ns_dl_OpenTable();
    echo "<br /><center>"
	."<font class=\"content\">"
	.""._EDITORIALREMOVED."<br /><br />"
	."[ <a href=\"".$admin_file.".php?op=downloads_add#adddl\">"._WEBDOWNLOADSADMIN."</a> ]<br /><br />";
    ns_dl_CloseTable();
    include_once("footer.php");
}



function DownloadsDownloadCheck() {
global $prefix, $db, $admin_file;
ns_edl_top("validate");
ns_dl_OpenTable();
echo "<br /><center><font class=\"content\"><strong>"._DOWNLOADVALIDATION."</strong></font></center><br /><br />";
echo "<table align=\"center\"><tr><td colspan=\"2\" align=\"center\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSCHECKALL."\" title=\""._NSCHECKALL."\" ";
echo "onClick=\"window.location = ".$admin_file.".php?op=DownloadsValidate&amp;cid=0&amp;sid=0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";	
echo "<strong>"._CHECKCATEGORIES."</strong><br /><font class=\"tiny\">"._INCLUDESUBCATEGORIES."</font>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
$catnum = 1;
$result2 = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");    
while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
if ($parentid2 != 0) $ctitle2 = getparent($parentid2,$ctitle2);
$transfertitle = str_replace (" ", "_", $ctitle2);
echo "<tr><td align=\"left\"><strong>$catnum.</strong> ";
echo "<a href=\"".$admin_file.".php?op=DownloadsValidate&amp;cid=$cid2";
echo "&amp;sid=0&amp;ttitle=$transfertitle\">$ctitle2</a><br />";
echo "</td></tr>";
$catnum++;
}
echo "</table><br /><br />";
ns_dl_CloseTable();
ns_edl_bottom();
}



function DownloadsValidate($cid, $sid, $ttitle) {
global $bgcolor2, $prefix, $admin_file, $db;
ns_edl_top("validate");
ns_dl_OpenTable();
$transfertitle = str_replace ("_", "", $ttitle);
/* Check ALL Downloads */
echo "<br /><table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"1\">";
if ($cid==0 && $sid==0) {
    echo "<tr><td colspan=\"3\" align=\"center\">";
    echo "<strong>"._CHECKALLDOWNLOADS."</strong><br />"._BEPATIENT."<br /></td></tr>";
    $result = $db->sql_query("select lid, title, url, name, email, submitter from ".$prefix."_downloads_downloads order by title");
}
/* Check Categories & Subcategories */
if ($cid!=0 && $sid==0) {
    echo "<tr><td colspan=\"3\" align=\"center\">";
    echo "<strong>"._VALIDATINGCAT.": $transfertitle</strong><br />"._BEPATIENT."<br /></td></tr>";
    $result = $db->sql_query("select lid, title, url, name, email, submitter from ".$prefix."_downloads_downloads where cid='$cid' order by title");
}
/* Check Only Subcategory */
if ($cid==0 && $sid!=0) {
    echo "<tr><td colspan=\"3\" align=\"center\">";
    echo "<strong>"._VALIDATINGSUBCAT.": $transfertitle</strong><br />"._BEPATIENT."<br /></td></tr>";
$result = $db->sql_query("select lid, title, url, name, email, submitter from ".$prefix."_downloads_downloads where sid='$sid' order by title");
}
echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\" width=\"10%\">";
echo "<strong>"._STATUS."</strong></td><td bgcolor=\"$bgcolor2\" width=\"70%\">";
echo "<strong>"._DOWNLOADTITLE."</strong></td>";
echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._FUNCTIONS."</strong></td></tr>";
while(list($lid, $title, $url, $name, $email, $submitter) = $db->sql_fetchrow($result)) {

 //   $vurl = @parse_url($url);
 //   $fp = @fsockopen($vurl['host'], 80, $errno, $errstr, 15);

	$fp = @fopen($url,"r");
    if (!$fp){ 
    echo "<tr><td align=\"center\" width=\"10%\"><strong>"._FAILED."</strong></td>";
    echo "<td width=\"70%\"><a href=\"$url\" target=\"new\">$title</a></td>";
    echo "<td align=\"center\">";
    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\">"._EDIT."</a> ";
    echo "- <a href=\"".$admin_file.".php?op=DownloadsDelDownload&amp;lid=$lid\">"._DELETE."</a>";
    echo "</td></tr>";
    }
    if ($fp){ 
    echo "<tr><td align=\"center\" width=\"10%\">"._OK."</td>";
    echo "<td width=\"70%\"><a href=\"$url\" target=\"new\">$title</a></td>";
    echo "<td align=\"center\"><font class=\"content\">"._NONE."</font>";
    echo "</td></tr>";
    }
    @fclose($url, "r");
}
echo "</table>";
ns_dl_CloseTable();   	
ns_edl_bottom();
}



function DownloadsAddDownload($new, $lid, $title, $url, $cat, $desc, $name, $email, $submitter, $filesize, $version, $homepage, $hits, $ns_compat, $ns_des_img, $ns_disable, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) {
global $prefix, $admin_file, $db;
$result = $db->sql_query("select url from ".$prefix."_downloads_downloads where url='$url'");
$numrows = $db->sql_numrows($result);
    if ($numrows > 0) {
		ns_edl_top("adddl"); 
		ns_dl_OpenTable();
		echo "<br /><center>";
	    echo "<font class=\"content\">";
	    echo "<strong>"._ERRORURLEXIST."</strong><br /><br />";
	    echo ""._GOBACK."<br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    } else {

/* Check if Title exist */
    if ($title == "") {
		ns_edl_top("adddl"); 
		ns_dl_OpenTable();
		echo "<br /><center>";
	    echo "<font class=\"content\">";
	    echo "<strong>"._ERRORNOTITLE."</strong><br /><br />";
	    echo ""._GOBACK."<br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    }

/* Check if URL exist */
    if ($url == "") {
		ns_edl_top("adddl");
		ns_dl_OpenTable();
		echo "<br /><center>";
	    echo "<font class=\"content\">";
	    echo "<strong>"._ERRORNOURL."</strong><br /><br />";
	    echo ""._GOBACK."<br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    }
    
// Check if Category exist
    if ($cat == "") {
		ns_edl_top("adddl");
		ns_dl_OpenTable();
		echo "<br /><center>";
	    echo "<font class=\"content\">";
	    echo "<strong>"._ERRORNOCATSELECTED."</strong><br /><br />";
	    echo ""._GOBACK."<br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    }

// Check if Description exist
    if ($desc=="") {
		ns_edl_top("adddl");
		ns_dl_OpenTable();
		echo "<br /><center>";
	    echo "<font class=\"content\">";
	    echo "<strong>"._ERRORNODESCRIPTION."</strong><br /><br />";
	    echo ""._GOBACK."<br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    }
    $result_ad = $db->sql_query("SELECT ns_dl_add_email, ns_dl_add_compat, ns_dl_add_filesize from ".$prefix."_ns_downloads_add_modify");
    list($ns_dl_add_email, $ns_dl_add_compat, $ns_dl_add_filesize) = $db->sql_fetchrow($result_ad);

// Check if email exsists @ if exists, make sure it's valid - NukeStyles
    if ($ns_dl_add_email == 1) {
		if ($email == "") {
			ns_edl_top("adddl");
			ns_dl_OpenTable();
			echo"<br /><center><strong>"._NSENTEREMAIL."</strong><br /><br />"; 
			echo""._GOBACK."</center><br />";
			ns_dl_CloseTable();
			ns_edl_bottom();
		} else if (($email != "") AND (!preg_match ("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$/", $email))) {
			ns_edl_top("adddl");
			ns_dl_OpenTable();
			echo"<br /><center>"._NSEMAILNOVALID." <font color=\"#CC0000\"><strong>$email</strong></font> ";
			echo""._NSEMAILNOVALID2."<br /><br />"; 
			echo""._GOBACK."</center><br />";
			ns_dl_CloseTable();
			ns_edl_bottom();
        }
    }

// Check if Compatibility exsists - NukeStyles
    if ($ns_dl_add_compat == 1) {
		if ($ns_compat == "") {
		ns_edl_top("adddl");
		ns_dl_OpenTable();
		echo"<br /><br /><center><strong>"._NSERRORNOCOMPAT."</strong><br /><br /><br />";
		echo""._GOBACK."</center><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		}
    }

// Check if FileSize exsists - NukeStyles
    if ($ns_dl_add_filesize == 1) {
		if ($filesize == "") {
		ns_edl_top("adddl");
		ns_dl_OpenTable();
		echo"<br /><br /><center><strong>"._NSERRORNOFILE."</strong><br /><br /><br />";
		echo""._GOBACK."</center><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
		}
    }
    $cat = explode("-", $cat);
    if ($cat[1]=="") {
	$cat[1] = 0;
    }
    $title = stripslashes(FixQuotes($title));
    $url = stripslashes(FixQuotes($url));
    $desc = stripslashes(FixQuotes($desc));
	$ns_dl_down_note = stripslashes(FixQuotes($ns_dl_down_note));
    $name = stripslashes(FixQuotes($name));
    $email = stripslashes(FixQuotes($email));
    $homepage = stripslashes(FixQuotes($homepage));
    if (($homepage == "http://") OR ($homepage == "http:///")) {
    $homepage = "";
    }        
    // If no http:// is in front of Homepage URL, then it is auto added - NukeStyles
    if ($homepage != "") {
        if (strtolower(substr($homepage, 0, 7)) != "http://") { 
			$homepage = "http://".$homepage; 
        } 
    }
    $db->sql_query("insert into ".$prefix."_downloads_downloads values (NULL, '$cat[0]', '$cat[1]', '$title', '$url', '$desc', now(), '$name', '$email', '$hits','$submitter',0,0,0, '$filesize', '$version', '$homepage', '$ns_compat', '$ns_des_img', '$ns_disable', '$ns_mirror_one', '$ns_mirror_two', '$ns_dl_down_note')");
    global $nukeurl, $db, $admin_file, $sitename;
    ns_edl_top("adddl");
    ns_dl_OpenTable();
    echo "<br /><br /><center><font class=\"content\"><strong>"._NEWDOWNLOADADDED."</strong></center><br /><br />";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=".$admin_file.".php?op=downloads#start\">";
    ns_dl_CloseTable();
    if ($new == 1) {
		$db->$db->sql_query("delete from ".$prefix."_downloads_newdownload where lid='$lid'");
    }
    ns_edl_bottom();
    }
}


switch ($op) {
			
    case "downloads":
    downloads();
    break;
    
    case "downloads_add":
    downloads_add();
    break;
    
    case "downloads_modify":
    downloads_modify();
    break;
    
    case "downloads_add_cat":
    downloads_add_cat($ns_catadded);
    break;
    
    case "downloads_add_subcat":
    downloads_add_subcat($ns_catadded);
    break;
    
    case "downloads_modify_cat":
    downloads_modify_cat();
    break;
    
    case "downloads_transfer":
    downloads_transfer();
    break;


    case "downloads_disabled":
    downloads_disabled();
    break;

    case "downloads_enable":
    downloads_enable($lid);
    break;

    case "downloads_disable":
    downloads_disable($lid);
    break;

    case "DownloadsDelNew":
    DownloadsDelNew($lid);
    break;

    case "DownloadsAddCat":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#addcat\">";
    DownloadsAddCat($title, $cdesc, $ns_cat_note);
    break;

    case "DownloadsAddSubCat":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#addsub\">";
    DownloadsAddSubCat($cid, $title, $cdesc, $ns_cat_note);
    break;

    case "DownloadsAddDownload":
    DownloadsAddDownload($new, $lid, $title, $url, $cat, $desc, $name, $email, $submitter, $filesize, $version, $homepage, $hits, $ns_compat, $ns_des_img, $ns_disable, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note);
    break;
			
    case "DownloadsAddEditorial":
    DownloadsAddEditorial($downloadid, $editorialtitle, $editorialtext);
    break;			
			
    case "DownloadsModEditorial":
    DownloadsModEditorial($downloadid, $editorialtitle, $editorialtext);
    break;	
			
    case "DownloadsDownloadCheck":
    DownloadsDownloadCheck();
    break;	
		
    case "DownloadsValidate":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#validate\">";
    DownloadsValidate($cid, $sid, $ttitle);
    break;

    case "DownloadsDelEditorial":
    DownloadsDelEditorial($downloadid);
    break;						

    case "DownloadsCleanVotes":
    DownloadsCleanVotes($clean_votes);
    break;	
		
    case "DownloadsListBrokenDownloads":
    DownloadsListBrokenDownloads();
    break;

    case "DownloadsDelBrokenDownloads":
    DownloadsDelBrokenDownloads($lid);
    break;
			
    case "DownloadsIgnoreBrokenDownloads":
    DownloadsIgnoreBrokenDownloads($lid);
    break;			
			
    case "DownloadsListModRequests":
    DownloadsListModRequests();
    break;		
			
    case "DownloadsChangeModRequests":
    DownloadsChangeModRequests($requestid);
    break;	
			
    case "DownloadsChangeIgnoreRequests":
    DownloadsChangeIgnoreRequests($requestid);
    break;
			
    case "DownloadsDelCat":
    DownloadsDelCat($cid, $sid, $sub, $ok);
    break;

    case "DownloadsModCat":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#modcat\">";
    DownloadsModCat($cat);
    break;

    case "DownloadsModCatS":
    DownloadsModCatS($cid, $sid, $sub, $title, $cdesc, $ns_cat_note);
    break;

    case "DownloadsModDownload":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#moddl\">";
    DownloadsModDownload($lid);
    break;

    case "DownloadsModDownloadS":
    DownloadsModDownloadS($lid, $title, $url, $desc, $name, $email, $hits, $cat, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_disable, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note);
    break;

    case "DownloadsDelDownload":
    DownloadsDelDownload($lid, $delfile, $delimg, $deldl);
    break;

    case "DownloadsDelVote":
    DownloadsDelVote($lid, $rid);
    break;			

    case "DownloadsDelComment":
    DownloadsDelComment($lid, $rid);
    break;

    case "DownloadsTransfer":
    DownloadsTransfer($cidfrom,$cidto);
    break;

}
    
} else {
    echo "Access Denied";
}

?>