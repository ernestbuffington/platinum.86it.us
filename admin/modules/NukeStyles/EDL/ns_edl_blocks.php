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

function ns_edl_blocks() {
global $prefix, $db, $admin_file;
ns_edl_top("blocks");
$result = $db->sql_query("SELECT ns_dl_show_block, ns_dl_show_all, ns_dl_show_num, ns_dl_left_block, ns_dl_right_block from ".$prefix."_ns_downloads_blocks");
list($ns_dl_show_block, $ns_dl_show_all, $ns_dl_show_num, $ns_dl_left_block, $ns_dl_right_block) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
echo "<center><font class=\"title\"><strong>"._NSDLBLOCKSETTINGS."</strong></font></center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><form action=".$admin_file.".php method='post' name=\"tabledesign\">";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWBOTBLOCKS.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_show_block == 1) {	
		echo "<input type='radio' name='ns_dl_show_block' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_block' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_show_block' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_block' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"tiny\">";
echo ""._NSDLDESIMAGE3."</font><br />";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLSHOWBLOCKSALL."</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">";
    if ($ns_dl_show_all == 1) {
		echo "<input type='radio' name='ns_dl_show_all' value='1' checked> "._NSDLMNALL." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_all' value='0'> "._NSDLMNMAIN."";
    } else {
		echo "<input type='radio' name='ns_dl_show_all' value='1'> "._NSDLMNALL." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_all' value='0' checked> "._NSDLMNMAIN."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWNUMBLOCKS.":</td>";
echo "<td align=\"left\" width=\"30%\">";
	if ($ns_dl_show_num == 5) {
		$sel1 = "selected";
		$sel2 = "";
		$sel3 = "";
	} elseif ($ns_dl_show_num == 10) {
		$sel1 = "";
		$sel2 = "selected";
		$sel3 = "";
	} elseif ($ns_dl_show_num == 15) {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "selected";
	}
echo "<select name=\"ns_dl_show_num\">";
echo "<option value=\"5\" $sel1> 5 </option>";
echo "<option value=\"10\" $sel2> 10 </option>";
echo "<option value=\"15\" $sel3> 15 </option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"></td></tr>";
echo "<tr><td colspan=\"2\">";
echo "<br /><table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLCHOOSEBLOCKS."</td></tr>";
echo "<tr><td align=\"center\"><u><strong>"._NSDLLEFTBLOCK."</strong></u></td>";
echo "<td align=\"center\"><strong><u>"._NSDLRIGHTBLOCK."</strong></u></td></tr>";
echo "<tr><td align=\"center\">";
	if ($ns_dl_left_block == 1) {
		$lnsel = "selected";
		$lpsel = "";
		$ltsel = "";
	} elseif ($ns_dl_left_block == 2) {
		$lnsel = "";
		$lpsel = "selected";
		$ltsel = "";
	} elseif ($ns_dl_left_block == 3) {
		$lnsel = "";
		$lpsel = "";
		$ltsel = "selected";
	}
echo "<select name=\"ns_dl_left_block\">";
echo "<option value=\"1\" $lnsel>"._NSDLNEWBLOCK."</option>";
echo "<option value=\"2\" $lpsel>"._NSDLPOPBLOCK."</option>";
echo "<option value=\"3\" $ltsel>"._NSDLTOPBLOCK."</option>";
echo "</select></td>";
echo "<td align=\"left\">";
	if ($ns_dl_right_block == 1) {
		$rnsel = "selected";
		$rpsel = "";
		$rtsel = "";
	} elseif ($ns_dl_right_block == 2) {
		$rnsel = "";
		$rpsel = "selected";
		$rtsel = "";
	} elseif ($ns_dl_right_block == 3) {
		$rnsel = "";
		$rpsel = "";
		$rtsel = "selected";
	}
echo "<select name=\"ns_dl_right_block\">";
echo "<option value=\"1\" $rnsel>"._NSDLNEWBLOCK."</option>";
echo "<option value=\"2\" $rpsel>"._NSDLPOPBLOCK."</option>";
echo "<option value=\"3\" $rtsel>"._NSDLTOPBLOCK."</option>";
echo "</select></td></tr></table>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"></td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type='hidden' name='op' value='ns_edl_blocks_save'>";
echo "<input type='submit' name=\"submit\" value='Save Changes'>";
echo "</td></tr>";
echo "</table><br />";
echo "</form>";
ns_dl_CloseTable();
ns_edl_bottom();
}

function ns_edl_blocks_save($ns_dl_show_block, $ns_dl_show_all, $ns_dl_show_num, $ns_dl_left_block, $ns_dl_right_block) {
global $prefix, $db, $admin_file;
$db->sql_query("update ".$prefix."_ns_downloads_blocks set ns_dl_show_block='$ns_dl_show_block', ns_dl_show_all='$ns_dl_show_all', ns_dl_show_num='$ns_dl_show_num', ns_dl_left_block='$ns_dl_left_block', ns_dl_right_block='$ns_dl_right_block'");
Header("Location: ".$admin_file.".php?op=ns_edl_blocks#blocks");
}

switch($op) {

    case "ns_edl_blocks":
    ns_edl_blocks();
    break;

    case "ns_edl_blocks_save":
    ns_edl_blocks_save($ns_dl_show_block, $ns_dl_show_all, $ns_dl_show_num, $ns_dl_left_block, $ns_dl_right_block);
    break;

}

} else {
echo "Access Denied";
}

?>