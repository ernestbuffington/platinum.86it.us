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
addJSToHead('/includes/ckeditor/ckeditor.js','file'); 

function ns_edl_addmodify() {
global $prefix, $db, $admin_file;
ns_edl_top("addmod");
$result = $db->sql_query("SELECT ns_dl_add, ns_dl_anon_add, ns_dl_auto_add, ns_dl_add_compat, ns_dl_add_email, ns_dl_add_filesize, ns_dl_allow_html, ns_dl_affiliate_links, ns_dl_mod, ns_dl_mod_anon, ns_dl_owner_mod from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_add, $ns_dl_anon_add, $ns_dl_auto_add, $ns_dl_add_compat, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_mod, $ns_dl_mod_anon, $ns_dl_owner_mod) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLADDMODSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action='".$admin_file.".php' method='post'>";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLADDDOWNLOAD.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_add == 1) {
echo "<input type='radio' name='ns_dl_add' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_add' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLANONADDDOWNLOAD.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if (($ns_dl_add == 1) AND ($ns_dl_anon_add == 1)) {
echo "<input type='radio' name='ns_dl_anon_add' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_anon_add' value='0'>"._NSNO."";
    } elseif (($ns_dl_add == 0) AND ($ns_dl_anon_add == 1)) {
echo "<input type='radio' name='ns_dl_anon_add' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_anon_add' value='0' checked>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_anon_add' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_anon_add' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLAUTOADDDOWNLOAD.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_auto_add == 1) {
echo "<input type='radio' name='ns_dl_auto_add' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_auto_add' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_auto_add' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_auto_add' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLADDDOWNLOADEMAIL.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_add_email == 1) {
echo "<input type='radio' name='ns_dl_add_email' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_email' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_add_email' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_email' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLADDDOWNLOADCOMPAT.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_add_compat == 1) {
echo "<input type='radio' name='ns_dl_add_compat' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_compat' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_add_compat' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_compat' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLADDDOWNLOADFILE.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_add_filesize == 1) {
echo "<input type='radio' name='ns_dl_add_filesize' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_filesize' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_add_filesize' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_add_filesize' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLALLOWHTML.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_allow_html == 1) {
echo "<input type='radio' name='ns_dl_allow_html' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_allow_html' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_allow_html' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_allow_html' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"65%\">"._NSDLAFFILIATELINKS.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_affiliate_links == 1) {
echo "<input type='radio' name='ns_dl_affiliate_links' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_affiliate_links' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_affiliate_links' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_affiliate_links' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\"><div align=\"justify\">"._NSDLOWNERMODDL."</div></td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLOWNERMODDL2.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_owner_mod == 1) {
echo "<input type='radio' name='ns_dl_owner_mod' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_owner_mod' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_owner_mod' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_owner_mod' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";

echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"tiny\">";
echo ""._NSDLOWNERMODDL3."</font><br />";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLMODDOWNLOAD.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_mod == 1) {
echo "<input type='radio' name='ns_dl_mod' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_mod' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_mod' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_mod' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"65%\">"._NSDLANONMODDOWNLOAD.":</td>";
echo "<td align=\"left\" width=\"35%\">";
    if ($ns_dl_mod_anon == 1) {
echo "<input type='radio' name='ns_dl_mod_anon' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_mod_anon' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_mod_anon' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_mod_anon' value='0' checked>"._NSNO."";
    }
echo "</td></tr></table><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><input type='hidden' name='op' value='ns_edl_addmodsave'>";
echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
echo "<br />";
ns_dl_CloseTable();
echo "</form>";
ns_edl_bottom(); 
}



function ns_edl_addmodsave($ns_dl_add, $ns_dl_anon_add, $ns_dl_auto_add, $ns_dl_add_compat, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_mod, $ns_dl_mod_anon, $ns_dl_owner_mod) {
global $prefix, $db, $admin_file;
if ($ns_dl_owner_mod == 1) {
$ns_dl_mod = 0;
$ns_dl_mod_anon = 0;
}
$db->sql_query("UPDATE ".$prefix."_ns_downloads_add_modify set ns_dl_add='$ns_dl_add', ns_dl_anon_add='$ns_dl_anon_add', ns_dl_auto_add='$ns_dl_auto_add', ns_dl_add_compat='$ns_dl_add_compat', ns_dl_add_email='$ns_dl_add_email', ns_dl_add_filesize='$ns_dl_add_filesize', ns_dl_allow_html='$ns_dl_allow_html', ns_dl_affiliate_links='$ns_dl_affiliate_links', ns_dl_mod='$ns_dl_mod', ns_dl_mod_anon='$ns_dl_mod_anon', ns_dl_owner_mod='$ns_dl_owner_mod'");
Header("Location: ".$admin_file.".php?op=ns_edl_addmodify#addmod");
}


switch($op) {

    case "ns_edl_addmodify":
    ns_edl_addmodify();
    break;

    case "ns_edl_addmodsave":
    ns_edl_addmodsave($ns_dl_add, $ns_dl_anon_add, $ns_dl_auto_add, $ns_dl_add_compat, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_mod, $ns_dl_mod_anon, $ns_dl_owner_mod);
    break;

}



} else {
echo "Access Denied";
}



?>