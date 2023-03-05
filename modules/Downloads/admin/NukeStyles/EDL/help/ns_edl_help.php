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


function ns_edl_help($htext, $hpage, $hwidth, $hheight, $id) {
global $admin_file;
    echo "<script type=\"text/javascript\">\n";
    echo "function help(page) {\n";
    echo "OpenWin = this.open(page, \"CtrlWindow\", \"toolbar=no,menubar=no,";
    echo "location=no,scrollbars=yes,resize=yes,width=$hwidth,";
    echo "height=$hheight,screenX=600,screenY=600,top=150,left=325\");\n";
    echo "}\n";
    echo "</script>\n";
    echo "&nbsp;<a href=\"javascript:help('".$admin_file.".php?op=ns_help_edl";
    echo "&amp;id=$id&amp;hpage=$hpage')\">";
    echo "<span style=\"vertical-align=-30%\">";
    echo "<img src=\"images/NukeStyles/EDL/common/question.gif\" border=\"0\" ";
    echo "title=\"$htext "._NSDLHELP."\">";
    echo "</a></span>";
}


switch($op) {

    case "ns_help_edl":
    if ($hpage == "tb_add") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/tb_add.php");
    } else if ($hpage == "tb_color") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/tb_color.php");
    } else if ($hpage == "tb_status") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/tb_status.php");
    } else if ($hpage == "tb_structure") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/tb_structure.php");
    } else if ($hpage == "tb_html") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/tb_html.php");
    } else if ($hpage == "th_install") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/th_install.php");
    } else if ($hpage == "th_uninstall") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/th_uninstall.php");
    } else if ($hpage == "th_edit") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/th_edit.php");
    } else if ($hpage == "th_mode") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/th_mode.php");
    } else if ($hpage == "th_main") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/th_main.php");
    } else if ($hpage == "gn_img") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/gn_img.php");
    } else if ($hpage == "fld_perm") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/fld_perm.php");
    } else if ($hpage == "fld_new") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/fld_new.php");
    } else if ($hpage == "ad_col") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/ad_col.php");
    } else if ($hpage == "up_dir") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/up_dir.php");
    } else if ($hpage == "up_res") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/up_res.php");
    } else if ($hpage == "fetch_help") {
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/fetch_help.php");
    }
    break;
    
}




} else {
    echo "Access Denied";
}


?>
