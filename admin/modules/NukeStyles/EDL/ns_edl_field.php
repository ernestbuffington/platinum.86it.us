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
	
include_once("admin/modules/NukeStyles/EDL/ns_edl_functions.php");
include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

function ns_edl_field() {
global $prefix, $db, $admin_file;
ns_edl_top("field");
$result = $db->sql_query("SELECT ns_dl_field_vers, ns_dl_field_comp, ns_dl_field_file, ns_dl_field_date, ns_dl_field_hits, ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\"><strong>"._NSDLFIELDSSETTINGS."</strong></font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><form action=".$admin_file.".php method='post'>";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<font class=\"title\">"._NSDLCURPERMFIELDS."</font>";
ns_edl_help(""._NSDLCURPERMFIELDS."", "fld_perm", "250", "300", "$id");
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLVERSION."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_vers == 1) {
echo "<input type='radio' name='ns_dl_field_vers' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_vers' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_vers' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_vers' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLCOMPAT."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_comp == 1) {
echo "<input type='radio' name='ns_dl_field_comp' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_comp' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_comp' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_comp' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLFFILESIZE."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_file == 1) {
echo "<input type='radio' name='ns_dl_field_file' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_file' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_file' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_file' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDEDON."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_date == 1) {
echo "<input type='radio' name='ns_dl_field_date' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_date' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_date' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_date' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLHITS."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_hits == 1) {
echo "<input type='radio' name='ns_dl_field_hits' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_hits' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_hits' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_hits' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLRATING."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_rate == 1) {
echo "<input type='radio' name='ns_dl_field_rate' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_rate' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_rate' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_rate' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type='hidden' name='op' value='ns_edl_field_save'>";
echo "<input type='submit' name=\"submit\" value='Save Changes'>";
echo "</td></tr>";
echo "</table><br />";
echo "</form>";
ns_dl_CloseTable();

ns_dl_OpenTable();
echo "";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td width=\"90%\">";
echo "<div align=\"justify\">"._NSDLFLCOMING."</div>";
echo "</td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
//ns_edl_field_new();
ns_edl_bottom(); 
}

function ns_edl_field_save($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_field_perm set ns_dl_field_vers='$ns_dl_field_vers', ns_dl_field_comp='$ns_dl_field_comp', ns_dl_field_file='$ns_dl_field_file', ns_dl_field_date='$ns_dl_field_date', ns_dl_field_hits='$ns_dl_field_hits', ns_dl_field_rate='$ns_dl_field_rate'");
Header("Location: ".$admin_file.".php?op=ns_edl_field#field");
}

switch($op) {

    case "ns_edl_field":
    ns_edl_field();
    break;

    case "ns_edl_field_save":
    ns_edl_field_save($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate);
    break;

    case "ns_edl_field_add":
    ns_edl_field_add();
    break;

    case "ns_edl_field_add_save":
    ns_edl_field_add_save($fname);
    break;

    case "ns_edl_field_edit":
    ns_edl_field_edit($fid);
    break;

    case "ns_edl_field_edit_save":
    ns_edl_field_edit_save($fid, $fname_new, $fname_old);
    break;

    case "ns_edl_field_delete":
    ns_edl_field_delete($fid, $fname, $confirm);
    break;

}

} else {
	
echo "Access Denied";

}

?>