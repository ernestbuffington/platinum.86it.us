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

function ns_edl_author() {
global $prefix, $db, $admin_file;
ns_edl_top("auth");
$result = $db->sql_query("select ns_dl_auth_list, ns_dl_auth_lim, ns_dl_auth_pp from ".$prefix."_ns_downloads_auth");
list($ns_dl_auth_list, $ns_dl_auth_lim, $ns_dl_auth_pp) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
echo "<center><font class=\"title\"><strong>"._NSDLAUTHORSETTINGS."</strong></font>";
//ns_edl_help(""._NSDLAUTHORSETTINGS."", "fetch_help", "300", "400", "$id");
echo "</center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><form action=".$admin_file.".php method='post' name=\"tabledesign\">";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWUSERSUB.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_auth_list == 1) {	
		echo "<input type='radio' name='ns_dl_auth_list' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_auth_list' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_auth_list' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_auth_list' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"tiny\">";
echo ""._NSDLDESIMAGE3."</font><br />";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td align=\"right\">"._NSDLAUTHPERLIST.":</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_auth_lim' value='$ns_dl_auth_lim' ";
echo "size='2' maxlength='2'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLAUTHPERPAGE.":</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_auth_pp' value='$ns_dl_auth_pp' ";
echo "size='2' maxlength='2'>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type='hidden' name='op' value='ns_edl_author_save'>";
echo "<input type='submit' name=\"submit\" value='Save Changes'>";
echo "</td></tr>";
echo "</table><br />";
echo "</form>";
ns_dl_CloseTable();
ns_edl_bottom(); 
}

function ns_edl_author_save($ns_dl_auth_list, $ns_dl_auth_lim, $ns_dl_auth_pp) {
global $prefix, $db, $admin_file;
$db->sql_query("update ".$prefix."_ns_downloads_auth set ns_dl_auth_list='$ns_dl_auth_list', ns_dl_auth_lim='$ns_dl_auth_lim', ns_dl_auth_pp='$ns_dl_auth_pp'");
Header("Location: ".$admin_file.".php?op=ns_edl_author#auth");
}

switch($op) {

    case "ns_edl_author":
    ns_edl_author();
    break;

    case "ns_edl_author_save":
    ns_edl_author_save($ns_dl_auth_list, $ns_dl_auth_lim, $ns_dl_auth_pp);
    break;

}

} else {	
echo "Access Denied";
}

?>