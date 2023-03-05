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


function ns_edl_fetch() {
global $prefix, $db, $admin_file;
ns_edl_top("fetch");
$result = $db->sql_query("select ns_getit, ns_getit_image, ns_getit_color, ns_getit_msg from ".$prefix."_ns_downloads_fetch");
list($ns_getit, $ns_getit_image, $ns_getit_color, $ns_getit_msg) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
echo "<center><font class=\"title\"><strong>"._NSDLFETCHSETTINGS."</strong></font>";
ns_edl_help(""._NSDLFETCHSETTINGS."", "fetch_help", "400", "450", "$id");
echo "</center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"tabledesign\">";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"60%\">"._NSDLUSEFETCH."</td>";
echo "<td align=\"left\" width=\"40%\">";
	if ($ns_getit == 1) {
		echo "<input type='radio' name='ns_getit' value='1' checked> ";
		echo ""._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_getit' value='0'> ";
		echo ""._NSNO."";
	} else {
		echo "<input type='radio' name='ns_getit' value='1'> ";
		echo ""._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_getit' value='0' checked> ";
		echo ""._NSNO."";
	}
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br><hr width=\"80%\"><br></td></tr>";
echo "<tr><td align=\"right\" width=\"60%\">"._NSDLUSEFETCHIMG."</td>";
echo "<td align=\"left\" width=\"40%\">";
	if ($ns_getit_image == 1) {
		echo "<input type='radio' name='ns_getit_image' value='1' checked> ";
		echo ""._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_getit_image' value='0'> ";
		echo ""._NSNO."";
	} else {
		echo "<input type='radio' name='ns_getit_image' value='1'> ";
		echo ""._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_getit_image' value='0' checked> ";
		echo ""._NSNO."";
	}
echo "</td></tr>";

echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLSECIMGPROB."</td></tr>";

echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<script language=\"JavaScript\">\n";
echo "function newWindow(file,window) {\n";
echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
echo "}\n";
echo "</script>\n";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLFETCHPASSCLR.": </td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type=\"text\" name=\"ns_getit_color\" ";
echo "size=\"7\" maxlength=\"7\" value=\"$ns_getit_color\">&nbsp;";
echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=ns_getit_color','window2')\">";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br><hr width=\"80%\"><br></td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLFETCHMSG.":</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<textarea name=\"ns_getit_msg\" cols=\"70\" rows=\"12\">";
echo "".stripslashes($ns_getit_msg)."</textarea>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_fetch_save\">";
echo "<input type='submit' name=\"submit\" value='Save Changes'>";
echo "</td></tr>";
echo "</table><br>";
echo "</form>";
ns_dl_CloseTable();
ns_edl_bottom(); 
}



function ns_edl_fetch_save($ns_getit, $ns_getit_image, $ns_getit_color, $ns_getit_msg) {
global $prefix, $db, $admin_file;
$ns_getit_msg = stripslashes($ns_getit_msg);
$db->sql_query("UPDATE ".$prefix."_ns_downloads_fetch set ns_getit='$ns_getit', ns_getit_image='$ns_getit_image', ns_getit_color='$ns_getit_color', ns_getit_msg='$ns_getit_msg'");
Header("Location: ".$admin_file.".php?op=ns_edl_fetch#fetch");
}



switch($op) {

    case "ns_edl_fetch":
    ns_edl_fetch();
    break;

    case "ns_edl_fetch_save":
    ns_edl_fetch_save($ns_getit, $ns_getit_image, $ns_getit_color, $ns_getit_msg);
    break;

}



} else {	
echo "Access Denied";
}



?>