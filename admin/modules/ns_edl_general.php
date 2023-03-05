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

function ns_edl_general() {
global $prefix, $db, $admin_file, $id;
ns_edl_top("general");
$result = $db->sql_query("SELECT ns_download_image, ns_download_image_pos, ns_dl_show_sub_cats, ns_dl_show_num, ns_dl_show_full, ns_dl_num_per_page, ns_dl_num_results, ns_dl_sort_order, ns_dl_down_button, ns_dl_foot_button, ns_dl_reg_down, ns_dl_right_blocks, ns_dl_link_bar, ns_dl_show_engines, ns_cat_image, ns_cat_image_pos, ns_subcat_image, ns_subcat_image_pos, ns_featured_image, ns_featured_image_pos, ns_dl_main_note, ns_dl_main_note_show, prbgcolor1, prbgcolor2, tttextcolor, tbtextcolor, ns_dl_open_new, ns_dl_mirror_link, ns_dl_view_dis, ns_dl_empty_cat from ".$prefix."_ns_downloads_general");
list($ns_download_image, $ns_download_image_pos, $ns_dl_show_sub_cats, $ns_dl_show_num, $ns_dl_show_full, $ns_dl_num_per_page, $ns_dl_num_results, $ns_dl_sort_order, $ns_dl_down_button, $ns_dl_foot_button, $ns_dl_reg_down, $ns_dl_right_blocks, $ns_dl_link_bar, $ns_dl_show_engines, $ns_cat_image, $ns_cat_image_pos, $ns_subcat_image, $ns_subcat_image_pos, $ns_featured_image, $ns_featured_image_pos, $ns_dl_main_note, $ns_dl_main_note_show, $prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor, $ns_dl_open_new, $ns_dl_mirror_link, $ns_dl_view_dis, $ns_dl_empty_cat) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
echo "<center><font class=\"title\"><strong>"._NSDLGENSETTINGS."</strong></font></center>";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action=".$admin_file.".php method='post' name=\"tabledesign\">";
echo "<br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\"><strong>"._NSDLFORCEREG.":</strong></td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_reg_down == 1) {	
		echo "<input type='radio' name='ns_dl_reg_down' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_reg_down' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_reg_down' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_reg_down' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWBLOCKS.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_right_blocks == 1) {	
		echo "<input type='radio' name='ns_dl_right_blocks' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_right_blocks' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_right_blocks' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_right_blocks' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLLINKBAR.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_link_bar == 1) {	
		echo "<input type='radio' name='ns_dl_link_bar' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_link_bar' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_link_bar' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_link_bar' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

/*
echo "<tr><td align=\"right\">"._NSDLOPENNEW.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_open_new == 1) {	
		echo "<input type='radio' name='ns_dl_open_new' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_open_new' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_open_new' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_open_new' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
*/

echo "<tr><td align=\"right\">"._NSDLMIRRORLINK.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_mirror_link == 1) {	
		echo "<input type='radio' name='ns_dl_mirror_link' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_mirror_link' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_mirror_link' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_mirror_link' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLVIEWEMPTYCATS.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_empty_cat == 1) {	
		echo "<input type='radio' name='ns_dl_empty_cat' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_empty_cat' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_empty_cat' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_empty_cat' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLVIEWDISABLE.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_view_dis == 1) {	
		echo "<input type='radio' name='ns_dl_view_dis' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_view_dis' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_view_dis' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_view_dis' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td align=\"right\">"._NSDLPERPAGE.":</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_num_per_page' value='$ns_dl_num_per_page' ";
echo "size='2' maxlength='2'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSEARCHPERPAGE.":</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_num_results' value='$ns_dl_num_results' ";
echo "size='2' maxlength='2'>";
echo "</td></tr>";
    if ($ns_dl_sort_order == "1") {
		$sel1 = "selected";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "2") {
		$sel1 = "";
		$sel2 = "selected";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "3") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "selected";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "4") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "selected";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "5") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "selected";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "6") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "selected";
		$sel7 = "";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "7") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "selected";
		$sel8 = "";
    } elseif ($ns_dl_sort_order == "8") {
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		$sel4 = "";
		$sel5 = "";
		$sel6 = "";
		$sel7 = "";
		$sel8 = "selected";
    }
echo "<tr><td align=\"right\">"._NSDLDEFAULTSORT.":</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<select name=\"ns_dl_sort_order\">";
echo "<option value=\"1\" $sel1>"._NSDLTITLEAZ."</option>";
echo "<option value=\"2\" $sel2>"._NSDLTITLEZA."</option>";
echo "<option value=\"\">------------------</option>";
echo "<option value=\"3\" $sel3>"._NSDLDDATE1."</option>";
echo "<option value=\"4\" $sel4>"._NSDLDDATE2."</option>";
echo "<option value=\"\">------------------</option>";
echo "<option value=\"5\" $sel5>"._NSDLPOPULARITY1."</option>";
echo "<option value=\"6\" $sel6>"._NSDLPOPULARITY2."</option>";
echo "<option value=\"\">------------------</option>";
echo "<option value=\"7\" $sel7>"._NSDLRATING1."</option>";
echo "<option value=\"8\" $sel8>"._NSDLRATING2."</option>";
echo "<option value=\"\">------------------</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWNUMFULLDL.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_show_full == 1) {	
		echo "<input type='radio' name='ns_dl_show_full' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_full' value='0'> "._NSNO."";
    } else {	
		echo "<input type='radio' name='ns_dl_show_full' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_full' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWSUBCATS.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_show_sub_cats == 1) {
		echo "<input type='radio' name='ns_dl_show_sub_cats' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_sub_cats' value='0'> "._NSNO."";
    } else {
		echo "<input type='radio' name='ns_dl_show_sub_cats' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_sub_cats' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWNUMDL.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_show_num == 1) {
		echo "<input type='radio' name='ns_dl_show_num' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_num' value='0'> "._NSNO."";
    } else {
		echo "<input type='radio' name='ns_dl_show_num' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_num' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSHOWENGINES.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_show_engines == 1) {
		echo "<input type='radio' name='ns_dl_show_engines' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_engines' value='0'> "._NSNO."";
    } else {
		echo "<input type='radio' name='ns_dl_show_engines' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_show_engines' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLDOWNBUTTON.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_down_button == 1) {
		echo "<input type='radio' name='ns_dl_down_button' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_down_button' value='0'> "._NSNO."";
    } else {
		echo "<input type='radio' name='ns_dl_down_button' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_down_button' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLFOOTBUTTON.":</td>";
echo "<td align=\"left\" width=\"30%\">";
    if ($ns_dl_foot_button == 1) {
		echo "<input type='radio' name='ns_dl_foot_button' value='1' checked> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_foot_button' value='0'> "._NSNO."";
    } else {
		echo "<input type='radio' name='ns_dl_foot_button' value='1'> "._NSYES." &nbsp;";
		echo "<input type='radio' name='ns_dl_foot_button' value='0' checked> "._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\"><br /><hr width=\"80%\"><br /></td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSMAINDLNOTE.":</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<textarea name=\"ns_dl_main_note\" cols=\"70\" rows=\"12\">";
echo "".stripslashes($ns_dl_main_note)."</textarea>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">"._NSMAINDLNOTE2."</td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\">";
    if ($ns_dl_main_note_show == 1) {
		echo "<input type='radio' name='ns_dl_main_note_show' value='1' checked> "._NSDLMNALL." &nbsp;";
		echo "<input type='radio' name='ns_dl_main_note_show' value='0'> "._NSDLMNMAIN."";
    } else {
		echo "<input type='radio' name='ns_dl_main_note_show' value='1'> "._NSDLMNALL." &nbsp;";
		echo "<input type='radio' name='ns_dl_main_note_show' value='0' checked> "._NSDLMNMAIN."";
    }
echo "</td></tr>";
echo "</table><br /><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "</br>";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<font class=\"content\"><strong>"._NSDLTITLELINKIMG."</strong></font>";
ns_edl_help(""._NSDLTITLELINKIMG."", "gn_img", "325", "450", "$id");
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\">"._NSDLFEATUREDIMAGE.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_featured_image' value='$ns_featured_image' ";
echo "size='30' maxlength='100'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLFEATUREDIMAGEPOS.":</td>";
echo "<td align=\"left\" width=\"60%\"><select name=\"ns_featured_image_pos\">";
echo "<option value=\"$ns_featured_image_pos\">$ns_featured_image_pos</option>";
echo "<option value=\"-20\">-20</option>";
echo "<option value=\"-19\">-19</option>";
echo "<option value=\"-18\">-18</option>";
echo "<option value=\"-17\">-17</option>";
echo "<option value=\"-16\">-16</option>"; 
echo "<option value=\"-15\">-15</option>";
echo "<option value=\"-14\">-14</option>";
echo "<option value=\"-13\">-13</option>";
echo "<option value=\"-12\">-12</option>";
echo "<option value=\"-11\">-11</option>";
echo "<option value=\"-10\">-10</option>";
echo "<option value=\"-9\">-9</option>";
echo "<option value=\"-8\">-8</option>";
echo "<option value=\"-7\">-7</option>";
echo "<option value=\"-6\">-6</option>";
echo "<option value=\"-5\">-5</option>";
echo "<option value=\"-4\">-4</option>";
echo "<option value=\"-3\">-3</option>";
echo "<option value=\"-2\">-2</option>";
echo "<option value=\"-1\">-1</option>";
echo "<option value=\"0\">0</option>";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "<option value=\"6\">6</option>";
echo "<option value=\"7\">7</option>";
echo "<option value=\"8\">8</option>";
echo "<option value=\"9\">9</option>";
echo "<option value=\"10\">10</option>";
echo "<option value=\"11\">11</option>";
echo "<option value=\"12\">12</option>";
echo "<option value=\"13\">13</option>";
echo "<option value=\"14\">14</option>";
echo "<option value=\"15\">15</option>";
echo "<option value=\"16\">16</option>";
echo "<option value=\"17\">17</option>";
echo "<option value=\"18\">18</option>";
echo "<option value=\"19\">19</option>";
echo "<option value=\"20\">20</option>";
echo "</select>";
echo "</td></tr>";
echo "</table><br /><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\">"._NSDLCATIMAGE.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_cat_image' value='$ns_cat_image' ";
echo "size='30' maxlength='100'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLCATIMAGEPOS.":</td>";
echo "<td align=\"left\" width=\"60%\"><select name=\"ns_cat_image_pos\">";
echo "<option value=\"$ns_cat_image_pos\">$ns_cat_image_pos</option>";
echo "<option value=\"-20\">-20</option>";
echo "<option value=\"-19\">-19</option>";
echo "<option value=\"-18\">-18</option>";
echo "<option value=\"-17\">-17</option>";
echo "<option value=\"-16\">-16</option>"; 
echo "<option value=\"-15\">-15</option>";
echo "<option value=\"-14\">-14</option>";
echo "<option value=\"-13\">-13</option>";
echo "<option value=\"-12\">-12</option>";
echo "<option value=\"-11\">-11</option>";
echo "<option value=\"-10\">-10</option>";
echo "<option value=\"-9\">-9</option>";
echo "<option value=\"-8\">-8</option>";
echo "<option value=\"-7\">-7</option>";
echo "<option value=\"-6\">-6</option>";
echo "<option value=\"-5\">-5</option>";
echo "<option value=\"-4\">-4</option>";
echo "<option value=\"-3\">-3</option>";
echo "<option value=\"-2\">-2</option>";
echo "<option value=\"-1\">-1</option>";
echo "<option value=\"0\">0</option>";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "<option value=\"6\">6</option>";
echo "<option value=\"7\">7</option>";
echo "<option value=\"8\">8</option>";
echo "<option value=\"9\">9</option>";
echo "<option value=\"10\">10</option>";
echo "<option value=\"11\">11</option>";
echo "<option value=\"12\">12</option>";
echo "<option value=\"13\">13</option>";
echo "<option value=\"14\">14</option>";
echo "<option value=\"15\">15</option>";
echo "<option value=\"16\">16</option>";
echo "<option value=\"17\">17</option>";
echo "<option value=\"18\">18</option>";
echo "<option value=\"19\">19</option>";
echo "<option value=\"20\">20</option>";
echo "</select>";
echo "</td></tr>";
echo "</table><br /><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\">"._NSDLSUBCATIMAGE.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_subcat_image' value='$ns_subcat_image' ";
echo "size='30' maxlength='100'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLSUBCATIMAGEPOS.":</td>";
echo "<td align=\"left\" width=\"60%\"><select name=\"ns_subcat_image_pos\">";
echo "<option value=\"$ns_subcat_image_pos\">$ns_subcat_image_pos</option>";
echo "<option value=\"-20\">-20</option>";
echo "<option value=\"-19\">-19</option>";
echo "<option value=\"-18\">-18</option>";
echo "<option value=\"-17\">-17</option>";
echo "<option value=\"-16\">-16</option>"; 
echo "<option value=\"-15\">-15</option>";
echo "<option value=\"-14\">-14</option>";
echo "<option value=\"-13\">-13</option>";
echo "<option value=\"-12\">-12</option>";
echo "<option value=\"-11\">-11</option>";
echo "<option value=\"-10\">-10</option>";
echo "<option value=\"-9\">-9</option>";
echo "<option value=\"-8\">-8</option>";
echo "<option value=\"-7\">-7</option>";
echo "<option value=\"-6\">-6</option>";
echo "<option value=\"-5\">-5</option>";
echo "<option value=\"-4\">-4</option>";
echo "<option value=\"-3\">-3</option>";
echo "<option value=\"-2\">-2</option>";
echo "<option value=\"-1\">-1</option>";
echo "<option value=\"0\">0</option>";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "<option value=\"6\">6</option>";
echo "<option value=\"7\">7</option>";
echo "<option value=\"8\">8</option>";
echo "<option value=\"9\">9</option>";
echo "<option value=\"10\">10</option>";
echo "<option value=\"11\">11</option>";
echo "<option value=\"12\">12</option>";
echo "<option value=\"13\">13</option>";
echo "<option value=\"14\">14</option>";
echo "<option value=\"15\">15</option>";
echo "<option value=\"16\">16</option>";
echo "<option value=\"17\">17</option>";
echo "<option value=\"18\">18</option>";
echo "<option value=\"19\">19</option>";
echo "<option value=\"20\">20</option>";
echo "</select>";
echo "</td></tr>";
echo "</table><br /><br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\">"._NSDLLINKIMAGE.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_download_image' value='$ns_download_image' ";
echo "size='30' maxlength='100'>";
echo "</td></tr>";
echo "<tr><td align=\"right\">"._NSDLLINKIMAGEPOS.":</td>";
echo "<td align=\"left\" width=\"60%\"><select name=\"ns_download_image_pos\">";
echo "<option value=\"$ns_download_image_pos\">$ns_download_image_pos</option>";
echo "<option value=\"-20\">-20</option>";
echo "<option value=\"-19\">-19</option>";
echo "<option value=\"-18\">-18</option>";
echo "<option value=\"-17\">-17</option>";
echo "<option value=\"-16\">-16</option>"; 
echo "<option value=\"-15\">-15</option>";
echo "<option value=\"-14\">-14</option>";
echo "<option value=\"-13\">-13</option>";
echo "<option value=\"-12\">-12</option>";
echo "<option value=\"-11\">-11</option>";
echo "<option value=\"-10\">-10</option>";
echo "<option value=\"-9\">-9</option>";
echo "<option value=\"-8\">-8</option>";
echo "<option value=\"-7\">-7</option>";
echo "<option value=\"-6\">-6</option>";
echo "<option value=\"-5\">-5</option>";
echo "<option value=\"-4\">-4</option>";
echo "<option value=\"-3\">-3</option>";
echo "<option value=\"-2\">-2</option>";
echo "<option value=\"-1\">-1</option>";
echo "<option value=\"0\">0</option>";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "<option value=\"6\">6</option>";
echo "<option value=\"7\">7</option>";
echo "<option value=\"8\">8</option>";
echo "<option value=\"9\">9</option>";
echo "<option value=\"10\">10</option>";
echo "<option value=\"11\">11</option>";
echo "<option value=\"12\">12</option>";
echo "<option value=\"13\">13</option>";
echo "<option value=\"14\">14</option>";
echo "<option value=\"15\">15</option>";
echo "<option value=\"16\">16</option>";
echo "<option value=\"17\">17</option>";
echo "<option value=\"18\">18</option>";
echo "<option value=\"19\">19</option>";
echo "<option value=\"20\">20</option>";
echo "</select>";
echo "</td></tr>";
echo "</table><br /><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br />";
echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<font class=\"content\"><strong>"._NSDLADDDETAILCOLOR."</strong></font>";
ns_edl_help(""._NSDLHLPADDCOLOR."", "ad_col", "400", "425", "$id");
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<script language=\"JavaScript\">\n";
echo "function newWindow(file,window) {\n";
echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
echo "}\n";
echo "</script>\n";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDDETTBTOP.": </td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type=\"text\" name=\"prbgcolor1\" ";
echo "size=\"7\" maxlength=\"7\" value=\"$prbgcolor1\">&nbsp;";
echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=prbgcolor1','window2')\">";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDDETTEXTTOP.": </td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type=\"text\" name=\"tttextcolor\" ";
echo "size=\"7\" maxlength=\"7\" value=\"$tttextcolor\">&nbsp;";
echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tttextcolor','window2')\">";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDDETTBBOT.": </td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type=\"text\" name=\"prbgcolor2\" ";
echo "size=\"7\" maxlength=\"7\" value=\"$prbgcolor2\">&nbsp;";
echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=prbgcolor2','window2')\">";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDDETTEXTBOT.": </td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type=\"text\" name=\"tbtextcolor\" ";
echo "size=\"7\" maxlength=\"7\" value=\"$tbtextcolor\">&nbsp;";
echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tbtextcolor','window2')\">";
echo "</td></tr>";
echo "</table><br /><br />";
    if (($prbgcolor1 != "") || ($prbgcolor2 != "") || ($tttextcolor != "") || ($tbtextcolor != "")) {
		echo "<table width=\"55%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		echo "<tr bgcolor=\"#$prbgcolor1\"><td align=\"center\"><font color=\"#$tttextcolor\">";
		echo "<strong>"._NSDLEXAMTEXTTBTOP."</strong></font></td></tr>";
		echo "<tr bgcolor=\"#$prbgcolor2\"><td align=\"center\"><font color=\"#$tbtextcolor\">";
		echo "<strong>"._NSDLEXAMTEXTTBBOT."</strong></font></td></tr>";
		echo "</table><br /><br />";
    }
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><input type='hidden' name='op' value='ns_edl_gensave'>";
echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
echo "<br />";
ns_dl_CloseTable();
echo "</form>";
ns_edl_bottom(); 
}

function ns_edl_gensave($ns_download_image, $ns_download_image_pos, $ns_dl_show_sub_cats, $ns_dl_show_num, $ns_dl_show_full, $ns_dl_num_per_page, $ns_dl_num_results, $ns_dl_sort_order, $ns_dl_down_button, $ns_dl_foot_button, $ns_dl_reg_down, $ns_dl_right_blocks, $ns_dl_link_bar, $ns_dl_show_engines, $ns_cat_image, $ns_cat_image_pos, $ns_subcat_image, $ns_subcat_image_pos, $ns_featured_image, $ns_featured_image_pos, $ns_dl_main_note, $ns_dl_main_note_show, $prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor, $ns_dl_open_new, $ns_dl_mirror_link, $ns_dl_view_dis, $ns_dl_empty_cat) {
global $prefix, $db, $admin_file;
$ns_dl_main_note = stripslashes($ns_dl_main_note);
$prbgcolor1 = stripslashes($prbgcolor1);
$prbgcolor2 = stripslashes($prbgcolor2);
$tttextcolor = stripslashes($tttextcolor);
$tbtextcolor = stripslashes($tbtextcolor);
$db->sql_query("update ".$prefix."_ns_downloads_general set ns_download_image='$ns_download_image', ns_download_image_pos='$ns_download_image_pos', ns_dl_show_sub_cats='$ns_dl_show_sub_cats', ns_dl_show_num='$ns_dl_show_num', ns_dl_show_full='$ns_dl_show_full', ns_dl_num_per_page='$ns_dl_num_per_page', ns_dl_num_results='$ns_dl_num_results', ns_dl_sort_order='$ns_dl_sort_order', ns_dl_down_button='$ns_dl_down_button', ns_dl_foot_button='$ns_dl_foot_button', ns_dl_reg_down='$ns_dl_reg_down', ns_dl_right_blocks='$ns_dl_right_blocks', ns_dl_link_bar='$ns_dl_link_bar', ns_dl_show_engines='$ns_dl_show_engines', ns_cat_image='$ns_cat_image', ns_cat_image_pos='$ns_cat_image_pos', ns_subcat_image='$ns_subcat_image', ns_subcat_image_pos='$ns_subcat_image_pos', ns_featured_image='$ns_featured_image', ns_featured_image_pos='$ns_featured_image_pos', ns_dl_main_note='$ns_dl_main_note', ns_dl_main_note_show='$ns_dl_main_note_show', prbgcolor1='$prbgcolor1', prbgcolor2='$prbgcolor2', tttextcolor='$tttextcolor', tbtextcolor='$tbtextcolor', ns_dl_open_new='$ns_dl_open_new', ns_dl_mirror_link='$ns_dl_mirror_link', ns_dl_view_dis='$ns_dl_view_dis', ns_dl_empty_cat='$ns_dl_empty_cat'");
Header("Location: ".$admin_file.".php?op=ns_edl_general#general");
}

switch($op) {

    case "ns_edl_general":
    ns_edl_general();
    break;

    case "ns_edl_gensave":
    ns_edl_gensave($ns_download_image, $ns_download_image_pos, $ns_dl_show_sub_cats, $ns_dl_show_num, $ns_dl_show_full, $ns_dl_num_per_page, $ns_dl_num_results, $ns_dl_sort_order, $ns_dl_down_button, $ns_dl_foot_button, $ns_dl_reg_down, $ns_dl_right_blocks, $ns_dl_link_bar, $ns_dl_show_engines, $ns_cat_image, $ns_cat_image_pos, $ns_subcat_image, $ns_subcat_image_pos, $ns_featured_image, $ns_featured_image_pos, $ns_dl_main_note, $ns_dl_main_note_show, $prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor, $ns_dl_open_new, $ns_dl_mirror_link, $ns_dl_view_dis, $ns_dl_empty_cat);
    break;

}

} else {
echo "Access Denied";
}

?>