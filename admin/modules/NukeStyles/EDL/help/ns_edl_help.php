<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
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
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

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
    include_once("admin/modules/NukeStyles/EDL/help/tb_add.php");
    } else if ($hpage == "tb_color") {
    include_once("admin/modules/NukeStyles/EDL/help/tb_color.php");
    } else if ($hpage == "tb_status") {
    include_once("admin/modules/NukeStyles/EDL/help/tb_status.php");
    } else if ($hpage == "tb_structure") {
    include_once("admin/modules/NukeStyles/EDL/help/tb_structure.php");
    } else if ($hpage == "tb_html") {
    include_once("admin/modules/NukeStyles/EDL/help/tb_html.php");
    } else if ($hpage == "th_install") {
    include_once("admin/modules/NukeStyles/EDL/help/th_install.php");
    } else if ($hpage == "th_uninstall") {
    include_once("admin/modules/NukeStyles/EDL/help/th_uninstall.php");
    } else if ($hpage == "th_edit") {
    include_once("admin/modules/NukeStyles/EDL/help/th_edit.php");
    } else if ($hpage == "th_mode") {
    include_once("admin/modules/NukeStyles/EDL/help/th_mode.php");
    } else if ($hpage == "th_main") {
    include_once("admin/modules/NukeStyles/EDL/help/th_main.php");
    } else if ($hpage == "gn_img") {
    include_once("admin/modules/NukeStyles/EDL/help/gn_img.php");
    } else if ($hpage == "fld_perm") {
    include_once("admin/modules/NukeStyles/EDL/help/fld_perm.php");
    } else if ($hpage == "fld_new") {
    include_once("admin/modules/NukeStyles/EDL/help/fld_new.php");
    } else if ($hpage == "ad_col") {
    include_once("admin/modules/NukeStyles/EDL/help/ad_col.php");
    } else if ($hpage == "up_dir") {
    include_once("admin/modules/NukeStyles/EDL/help/up_dir.php");
    } else if ($hpage == "up_res") {
    include_once("admin/modules/NukeStyles/EDL/help/up_res.php");
    } else if ($hpage == "fetch_help") {
    include_once("admin/modules/NukeStyles/EDL/help/fetch_help.php");
    }
    break;
    
}

} else {
    echo "Access Denied";
}

?>