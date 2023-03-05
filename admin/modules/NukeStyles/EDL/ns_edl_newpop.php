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

function ns_edl_newpop() {
global $prefix, $db, $admin_file;
ns_edl_top("newpop");
$result = $db->sql_query("SELECT ns_dl_num_new_one, ns_dl_num_new_two, ns_dl_num_new_three, ns_dl_newimage_on, ns_dl_new_one, ns_dl_new_two, ns_dl_new_three, ns_dl_num_top, ns_dl_num_top_num, ns_dl_num_top_per, ns_dl_num_pop, ns_dl_num_pop_num, ns_dl_num_pop_per, ns_dl_popimage_on, ns_dl_num_pop_image, ns_dl_new_image1, ns_dl_new_image2, ns_dl_new_image3 from ".$prefix."_ns_downloads_new_pop");
list($ns_dl_num_new_one, $ns_dl_num_new_two, $ns_dl_num_new_three, $ns_dl_newimage_on, $ns_dl_new_one, $ns_dl_new_two, $ns_dl_new_three, $ns_dl_num_top, $ns_dl_num_top_num, $ns_dl_num_top_per, $ns_dl_num_pop, $ns_dl_num_pop_num, $ns_dl_num_pop_per, $ns_dl_popimage_on, $ns_dl_num_pop_image, $ns_dl_new_image1, $ns_dl_new_image2, $ns_dl_new_image3) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLNEWPOPTOPSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<form action=".$admin_file.".php method='post'>";
echo "<br /><div align=\"center\"><font class=\"title\">"._NSDLNEW."</font></div><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWPERPAGE1."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_num_new_one' value='$ns_dl_num_new_one' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 7</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWPERPAGE2."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_num_new_two' value='$ns_dl_num_new_two' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 14</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWPERPAGE3."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_num_new_three' value='$ns_dl_num_new_three' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 30</font>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWIMAGE1."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_new_one' value='$ns_dl_new_one' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 1</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWIMAGE2."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_new_two' value='$ns_dl_new_two' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 3</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWIMAGE3."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_new_three' value='$ns_dl_new_three' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 7</font>";
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLNEWIMAGEON."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_newimage_on == 1) {
echo "<input type='radio' name='ns_dl_newimage_on' value='1' checked>"._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_newimage_on' value='0'>"._NSOFF."";
    } else {
echo "<input type='radio' name='ns_dl_newimage_on' value='1'>"._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_newimage_on' value='0' checked>"._NSOFF."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"40%\">"._NSDLNEWIMAGENAME1.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_dl_new_image1' value='$ns_dl_new_image1' ";
echo "size='25' maxlength='100'>";
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"40%\">"._NSDLNEWIMAGENAME2.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_dl_new_image2' value='$ns_dl_new_image2' ";
echo "size='25' maxlength='100'>";
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"40%\">"._NSDLNEWIMAGENAME3.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_dl_new_image3' value='$ns_dl_new_image3' ";
echo "size='25' maxlength='100'>";
echo "</td></tr>";
echo "<tr>";
echo "<td width=\"40%\">&nbsp;</td><td align=\"left\" width=\"60%\">";
echo "<font class=\"tiny\">"._NSDLPOPIMAGE2."</font></td></tr>";
echo "</table><br /><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br />";
echo "<div align=\"center\"><font class=\"title\">"._NSDLPOPPERPAGE."</font></div>";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPPERPAGE1."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_num_pop' value='$ns_dl_num_pop' ";
echo "size='4' maxlength='4'> <font class='tiny'>"._DEFAULTIS." 200</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPPERPAGE2."</td>";
echo "<td align=\"left\" width=\"50%\">";
echo "<input type='text' name='ns_dl_num_pop_num' value='$ns_dl_num_pop_num' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 10</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPPERPAGE3."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_num_pop_per == 1) {
echo "<input type='radio' name='ns_dl_num_pop_per' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_num_pop_per' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_num_pop_per' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_num_pop_per' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"50%\">"._NSDLPOPIMAGEON."</td>";
echo "<td align=\"left\" width=\"50%\">";
    if ($ns_dl_popimage_on == 1) {
echo "<input type='radio' name='ns_dl_popimage_on' value='1' checked>"._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_popimage_on' value='0'>"._NSOFF."";
    } else {
echo "<input type='radio' name='ns_dl_popimage_on' value='1'>"._NSON." &nbsp;";
echo "<input type='radio' name='ns_dl_popimage_on' value='0' checked>"._NSOFF."";
    }
echo "</td></tr>";
echo "<tr>";
echo "<td align=\"right\" width=\"40%\">"._NSDLPOPIMAGE.":</td>";
echo "<td align=\"left\" width=\"60%\">";
echo "<input type='text' name='ns_dl_num_pop_image' value='$ns_dl_num_pop_image' ";
echo "size='25' maxlength='100'>";
echo "</td></tr>";
echo "<tr>";
echo "<td width=\"40%\">&nbsp;</td><td align=\"left\" width=\"60%\">";
echo "<font class=\"tiny\">"._NSDLPOPIMAGE2."</font></td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br />";
echo "<div align=\"center\"><font class=\"title\">"._NSDLTOPPERPAGE."</font></div>";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"right\" width=\"60%\">"._NSDLTOPPERPAGE1."</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_num_top' value='$ns_dl_num_top' ";
echo "size='4' maxlength='4'> <font class='tiny'>"._DEFAULTIS." 25</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"60%\">"._NSDLTOPPERPAGE2."</td>";
echo "<td align=\"left\" width=\"40%\">";
echo "<input type='text' name='ns_dl_num_top_num' value='$ns_dl_num_top_num' ";
echo "size='3' maxlength='2'> <font class='tiny'>"._DEFAULTIS." 10</font>";
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"60%\">"._NSDLTOPPERPAGE3."</td>";
echo "<td align=\"left\" width=\"40%\">";
    if ($ns_dl_num_top_per == 1) {
echo "<input type='radio' name='ns_dl_num_top_per' value='1' checked>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_num_top_per' value='0'>"._NSNO."";
    } else {
echo "<input type='radio' name='ns_dl_num_top_per' value='1'>"._NSYES." &nbsp;";
echo "<input type='radio' name='ns_dl_num_top_per' value='0' checked>"._NSNO."";
    }
echo "</td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><input type='hidden' name='op' value='ns_edl_newpopsave'>";
echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
echo "<br />";
ns_dl_CloseTable();
echo "</form>";
ns_edl_bottom(); 
}

function ns_edl_newpopsave($ns_dl_num_new_one, $ns_dl_num_new_two, $ns_dl_num_new_three, $ns_dl_newimage_on, $ns_dl_new_one, $ns_dl_new_two, $ns_dl_new_three, $ns_dl_num_top, $ns_dl_num_top_num, $ns_dl_num_top_per, $ns_dl_num_pop, $ns_dl_num_pop_num, $ns_dl_num_pop_per, $ns_dl_popimage_on, $ns_dl_num_pop_image, $ns_dl_new_image1, $ns_dl_new_image2, $ns_dl_new_image3) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_new_pop set ns_dl_num_new_one='$ns_dl_num_new_one', ns_dl_num_new_two='$ns_dl_num_new_two', ns_dl_num_new_three='$ns_dl_num_new_three', ns_dl_newimage_on='$ns_dl_newimage_on', ns_dl_new_one='$ns_dl_new_one', ns_dl_new_two='$ns_dl_new_two', ns_dl_new_three='$ns_dl_new_three', ns_dl_num_top='$ns_dl_num_top', ns_dl_num_top_num='$ns_dl_num_top_num', ns_dl_num_top_per='$ns_dl_num_top_per', ns_dl_num_pop='$ns_dl_num_pop', ns_dl_num_pop_num='$ns_dl_num_pop_num', ns_dl_num_pop_per='$ns_dl_num_pop_per', ns_dl_popimage_on='$ns_dl_popimage_on', ns_dl_num_pop_image='$ns_dl_num_pop_image', ns_dl_new_image1='$ns_dl_new_image1', ns_dl_new_image2='$ns_dl_new_image2', ns_dl_new_image3='$ns_dl_new_image3'");
Header("Location: ".$admin_file.".php?op=ns_edl_newpop#newpop");
}

switch($op) {

    case "ns_edl_newpop":
    ns_edl_newpop();
    break;

    case "ns_edl_newpopsave":
    ns_edl_newpopsave($ns_dl_num_new_one, $ns_dl_num_new_two, $ns_dl_num_new_three, $ns_dl_newimage_on, $ns_dl_new_one, $ns_dl_new_two, $ns_dl_new_three, $ns_dl_num_top, $ns_dl_num_top_num, $ns_dl_num_top_per, $ns_dl_num_pop, $ns_dl_num_pop_num, $ns_dl_num_pop_per, $ns_dl_popimage_on, $ns_dl_num_pop_image, $ns_dl_new_image1, $ns_dl_new_image2, $ns_dl_new_image3);
    break;

}

} else {
echo "Access Denied";
}

?>