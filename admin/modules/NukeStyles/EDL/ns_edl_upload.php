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

function ns_edl_upload() {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_top("up");
$result = $db->sql_query("SELECT ns_dl_file_dir, ns_dl_image_dir, ns_dl_allow_file, ns_dl_allow_img, ns_dl_file_size, ns_dl_image_size, ns_dl_file_ext, ns_dl_image_ext, ns_dl_use_resize, ns_dl_netpath from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir, $ns_dl_image_dir, $ns_dl_allow_file, $ns_dl_allow_img, $ns_dl_file_size, $ns_dl_image_size, $ns_dl_file_ext, $ns_dl_image_ext, $ns_dl_use_resize, $ns_dl_netpath) = $db->sql_fetchrow($result);
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLUPLOADSETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<br /><form action=".$admin_file.".php method='post'>";
    echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"title\">"._NSDLUPDIRECTORY."</font> ";
    ns_edl_help(""._NSDLUPDIRECTORY."", "up_dir", "325", "450", "$id");
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"40%\">"._NSDLFILEDIRECTORY.": </td>";
    echo "<td align=\"left\" width=\"60%\">";
    echo "<input type=\"text\" name=\"ns_dl_file_dir\" ";
    echo "size=\"40\" maxlength=\"150\" value=\"$ns_dl_file_dir\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"40%\">"._NSDLIMGDIRECTORY.": </td>";
    echo "<td align=\"left\" width=\"60%\">";
    echo "<input type=\"text\" name=\"ns_dl_image_dir\" ";
    echo "size=\"40\" maxlength=\"150\" value=\"$ns_dl_image_dir\">";
    echo "</td></tr>";
    echo "</table>";
    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\"><font class=\"title\">"._NSDLIMGRESIZE."</font> ";
    ns_edl_help(""._NSDLIMGRESIZE."", "up_res", "450", "520", "$id");
    echo "</td></tr>";
    echo "</table><br />";
    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLNETGDINFO.":</strong>";
    echo "</td></tr>";
    echo "</table><br />";
    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"40%\">";
    echo "<tr><td align=\"left\" colspan=\"2\">";
	version();
	$var = gd_info();
	$npbmdir = $ns_dl_netpath;
	if (@is_dir($npbmdir)) {
		if (@file_exists($npbmdir.'jpegtopnm')) {
		    $toecho = "<strong>&#8226; NetPBM Binaries</strong><br />";
		}
	}
	if($var["GD Version"] != "") {
	    $toecho .= '<strong>&#8226; GD '.$var["GD Version"].'</strong>';
	}
	if ($toecho != "") {
	    echo $toecho;
	} else {
	    echo "<strong>&#8226; "._NSDLNONENETGD."</strong>";
	}
    echo "</td></tr>";
    echo "</table><br />";
    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"right\" width=\"40%\">"._NSDLNETPBMDIRECTORY.": </td>";
    echo "<td align=\"left\" width=\"60%\">";
    echo "<input type=\"text\" name=\"ns_dl_netpath\" ";
    echo "size=\"30\" maxlength=\"150\" value=\"$ns_dl_netpath\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"60%\">"._NSDLUSENETGD.":</td>";
    echo "<td align=\"left\" width=\"40%\">";
	if (($ns_dl_use_resize == 1) AND ($toecho != "")) {
    echo "<input type='radio' name='ns_dl_use_resize' value='1' checked>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_use_resize' value='0'>"._NSNO."";
	} else {
    echo "<input type='radio' name='ns_dl_use_resize' value='1'>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_use_resize' value='0' checked>"._NSNO."";
	}
    echo "</td></tr>";
    if ($toecho == "") {
	echo "<tr><td align=\"center\" colspan=\"2\">";
	echo "<font class=\"tiny\">"._NSDLNONENETGD2."</font>";
	echo "</td></tr>";
    }
    echo "</table><br /><br />";
    echo "<hr color=\"$bgcolor2\" width=\"80%\">";    
    echo "<br /><table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";   
    echo "<tr><td align=\"right\" width=\"60%\">"._NSDLALLOWFILE.":</td>";
    echo "<td align=\"left\" width=\"40%\">";
	if ($ns_dl_allow_file == 1) {
    echo "<input type='radio' name='ns_dl_allow_file' value='1' checked>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_allow_file' value='0'>"._NSNO."";
	} else {
    echo "<input type='radio' name='ns_dl_allow_file' value='1'>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_allow_file' value='0' checked>"._NSNO."";
	}
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"60%\">"._NSDLALLOWIMG.":</td>";
    echo "<td align=\"left\" width=\"40%\">";
	if ($ns_dl_allow_img == 1) {
    echo "<input type='radio' name='ns_dl_allow_img' value='1' checked>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_allow_img' value='0'>"._NSNO."";
	} else {
    echo "<input type='radio' name='ns_dl_allow_img' value='1'>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_allow_img' value='0' checked>"._NSNO."";
	}
    echo "</td></tr>";
    echo "</table>";
    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLFILESIZE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"ns_dl_file_size\" ";
    echo "size=\"12\" maxlength=\"30\" value=\"$ns_dl_file_size\">";   
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLIMGSIZE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"ns_dl_image_size\" ";
    echo "size=\"12\" maxlength=\"30\" value=\"$ns_dl_image_size\">"; 
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><div align=\"justify\">"._NSDLUPSIZENOTE."</div></td></tr>";
    echo "</table><br />";
    echo "<hr color=\"$bgcolor2\" width=\"80%\">";
    echo "<br /><table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";   
    echo "<tr><td align=\"right\" width=\"35%\">"._NSDLFILEALLOWEXT.": </td>";
    echo "<td align=\"left\" width=\"65%\">";
    echo "<input type=\"text\" name=\"ns_dl_file_ext\" ";
    echo "size=\"40\" maxlength=\"255\" value=\"$ns_dl_file_ext\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"35%\">"._NSDLIMGALLOWEXT.": </td>";
    echo "<td align=\"left\" width=\"65%\">";
    echo "<input type=\"text\" name=\"ns_dl_image_ext\" ";
    echo "size=\"40\" maxlength=\"255\" value=\"$ns_dl_image_ext\">";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\">"._NSDLEXTNOTE."</td></tr>";
    echo "</table><br /><br />";
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<br /><input type='hidden' name='op' value='ns_edl_upsave'>";
    echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
    echo "<br />";
    ns_dl_CloseTable();
    echo "</form>";
    ns_edl_bottom(); 
}

function ns_edl_upsave($ns_dl_file_dir, $ns_dl_image_dir, $ns_dl_allow_file, $ns_dl_allow_img, $ns_dl_file_size, $ns_dl_image_size, $ns_dl_file_ext, $ns_dl_image_ext, $ns_dl_use_resize, $ns_dl_netpath) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_upload set ns_dl_file_dir='$ns_dl_file_dir', ns_dl_image_dir='$ns_dl_image_dir', ns_dl_allow_file='$ns_dl_allow_file', ns_dl_allow_img='$ns_dl_allow_img', ns_dl_file_size='$ns_dl_file_size', ns_dl_image_size='$ns_dl_image_size', ns_dl_file_ext='$ns_dl_file_ext', ns_dl_image_ext='$ns_dl_image_ext', ns_dl_use_resize='$ns_dl_use_resize', ns_dl_netpath='$ns_dl_netpath'");
Header("Location: ".$admin_file.".php?op=ns_edl_upload#up");
}

switch($op) {

    case "ns_edl_upload":
    ns_edl_upload();
    break;

    case "ns_edl_upsave":
    ns_edl_upsave($ns_dl_file_dir, $ns_dl_image_dir, $ns_dl_allow_file, $ns_dl_allow_img, $ns_dl_file_size, $ns_dl_image_size, $ns_dl_file_ext, $ns_dl_image_ext, $ns_dl_use_resize, $ns_dl_netpath);
    break;

}

} else {
echo "Access Denied";
}

?>