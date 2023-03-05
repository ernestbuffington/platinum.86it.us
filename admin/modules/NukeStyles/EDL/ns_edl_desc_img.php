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

function ns_edl_desc_img() {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_top("descimg");
$result = $db->sql_query("SELECT ns_dl_des_img, ns_dl_des_img_pos, ns_dl_des_img_width, ns_dl_des_img_height, ns_dl_pop_win, ns_dl_pop_win_width, ns_dl_pop_win_height, ns_dl_pop_conform, ns_dl_use_standard from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_win_width, $ns_dl_pop_win_height, $ns_dl_pop_conform, $ns_dl_use_standard) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLDESCRPTIMGSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action=".$admin_file.".php method='post'>";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    if ($ns_dl_des_img == 1) {
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLDESIMAGE2."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_des_img == 1) {
echo "<input type='radio' name='ns_dl_des_img' value='1' checked> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_des_img' value='0'> "._NSOFF."";
    } else {
echo "<input type='radio' name='ns_dl_des_img' value='1'> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_des_img' value='0' checked> "._NSOFF."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
    if ($ns_dl_des_img_pos == "l") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
    } elseif ($ns_dl_des_img_pos == "cu") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
    } elseif ($ns_dl_des_img_pos == "cd") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
    } elseif ($ns_dl_des_img_pos == "r") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
    }
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLDESIMGPOSITION.":</td>";
echo "<td align=\"left\" width=\"50%\"><select name=\"ns_dl_des_img_pos\">";
echo "<option name=\"ns_dl_des_img_pos\" value=\"l\" $sel1>"._NSDLLEFT."</option>";   
//echo "<option name=\"ns_dl_des_img_pos\" value=\"cu\" $sel2>"._NSDLCENTERUP."</option>";
//echo "<option name=\"ns_dl_des_img_pos\" value=\"cd\" $sel3>"._NSDLCENTERDOWN."</option>";
echo "<option name=\"ns_dl_des_img_pos\" value=\"r\" $sel4>"._NDSLRIGHT."</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
$result_up = $db->sql_query("SELECT ns_dl_use_resize from ".$prefix."_ns_downloads_upload");
list($ns_dl_use_resize) = $db->sql_fetchrow($result_up);
	version();
	$var = gd_info();
	$npbmdir = "includes/netpbm/";
	if (@is_dir($npbmdir)) {
		if (@file_exists($npbmdir.'jpegtopnm')) {
		    $res_ok = 1;
		}
	}
	if($var["GD Version"] != "") {
	    $res_ok = 1;
	}
    if (($ns_dl_use_resize == 1) AND ($res_ok == 1)) {
    echo "<tr><td align=\"right\" width=\"60%\">"._NSDLUSERESIZE.":</td>";
    echo "<td align=\"left\" width=\"40%\">";
	if ($ns_dl_use_standard == 1) {
    echo "<input type='radio' name='ns_dl_use_standard' value='1' checked>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_use_standard' value='0'>"._NSNO."";
	} else {
    echo "<input type='radio' name='ns_dl_use_standard' value='1'>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_use_standard' value='0' checked>"._NSNO."";
	}
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"tiny\">"._NSDLUSERESIZE2."</font>";
    echo "</td></tr>";
    } 
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLDESIMAGEWID.":</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_des_img_width' value='$ns_dl_des_img_width' ";
echo "size='5' maxlength='3'>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLDESIMAGEHEI.":</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_des_img_height' value='$ns_dl_des_img_height' ";
echo "size='5' maxlength='3'>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
echo "<td align=\"right\" width=\"50%\">"._NSDLPOPWIN."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_pop_win == 1) {
echo "<input type='radio' name='ns_dl_pop_win' value='1' checked> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_pop_win' value='0'> "._NSOFF."";
    } else {
echo "<input type='radio' name='ns_dl_pop_win' value='1'> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_pop_win' value='0' checked> "._NSOFF."";
    }
echo "</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"tiny\">";
echo ""._NSDLDESIMAGE3."</font><br />";
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">"._NSDLDESIMAGE4."<br /></td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">";
    if ($ns_dl_pop_conform == 1) {
echo "<input type='radio' name='ns_dl_pop_conform' value='1' checked> "._NSDLCONFORM."<br />";
echo "<input type='radio' name='ns_dl_pop_conform' value='0'> "._NSDLSETWIDHEI."";
    } else {
echo "<input type='radio' name='ns_dl_pop_conform' value='1'> "._NSDLCONFORM."<br />";
echo "<input type='radio' name='ns_dl_pop_conform' value='0' checked> "._NSDLSETWIDHEI."";
    }   
echo "</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">"._NSDLDESIMAGE5."<br /></td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPWINWID.":</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_pop_win_width' value='$ns_dl_pop_win_width' ";
echo "size='5' maxlength='4'>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPWINHEI.":</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_pop_win_height' value='$ns_dl_pop_win_height' ";
echo "size='5' maxlength='4'>";
echo "</td></tr>";
} else {	
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLDESIMAGE2."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_des_img == 1) {
echo "<input type='radio' name='ns_dl_des_img' value='1' checked> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_des_img' value='0'> "._NSOFF."";
    } else {
echo "<input type='radio' name='ns_dl_des_img' value='1'> "._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_des_img' value='0' checked> "._NSOFF."";
    }
echo "</td></tr>";
echo "<input type=\"hidden\" name=\"ns_dl_des_img_pos\" value=\"$ns_dl_des_img_pos\">";
echo "<input type=\"hidden\" name=\"ns_dl_des_img_width\" value=\"$ns_dl_des_img_width\">";
echo "<input type=\"hidden\" name=\"ns_dl_des_img_height\" value=\"$ns_dl_des_img_height\">";
echo "<input type=\"hidden\" name=\"ns_dl_pop_win\" value=\"$ns_dl_pop_win\">";
echo "<input type=\"hidden\" name=\"ns_dl_pop_win_width\" value=\"$ns_dl_pop_win_width\">";
echo "<input type=\"hidden\" name=\"ns_dl_pop_win_height\" value=\"$ns_dl_pop_win_height\">";
echo "<input type=\"hidden\" name=\"ns_dl_pop_conform\" value=\"$ns_dl_pop_conform\">";
}
echo "</table><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><input type='hidden' name='op' value='ns_edl_desc_save'>";
echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
echo "<br />";
ns_dl_CloseTable();
echo "</form>";
ns_edl_bottom(); 
}

function ns_edl_desc_save($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_win_width, $ns_dl_pop_win_height, $ns_dl_pop_conform, $ns_dl_use_standard) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_desc_img set ns_dl_des_img='$ns_dl_des_img', ns_dl_des_img_pos='$ns_dl_des_img_pos', ns_dl_des_img_width='$ns_dl_des_img_width', ns_dl_des_img_height='$ns_dl_des_img_height', ns_dl_pop_win='$ns_dl_pop_win', ns_dl_pop_win_width='$ns_dl_pop_win_width', ns_dl_pop_win_height='$ns_dl_pop_win_height', ns_dl_pop_conform='$ns_dl_pop_conform', ns_dl_use_standard='$ns_dl_use_standard'");
Header("Location: ".$admin_file.".php?op=ns_edl_desc_img#descimg");
}

switch($op) {

    case "ns_edl_desc_img":
    ns_edl_desc_img();
    break;

    case "ns_edl_desc_save":
    ns_edl_desc_save($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_win_width, $ns_dl_pop_win_height,$ns_dl_pop_conform, $ns_dl_use_standard);
    break;

}

} else {
echo "Access Denied";
}

?>