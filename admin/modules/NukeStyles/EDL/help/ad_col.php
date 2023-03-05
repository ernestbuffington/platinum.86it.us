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

include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

$result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
list($name) = $db->sql_fetchrow($result);

if (!$name) {
    $name = $Default_Theme;
}

global $Default_Theme;

echo "<html>";
echo "<head>";
echo "<title>"._NSDLHLPTITLE."</title>";
echo "<link rel=\"stylesheet\" href=\"themes/$name/style/style.css\" type=\"text/css\">";
echo "</head>";
echo "<body>";
echo "<font class=\"content\"><center><strong>"._NSDLHLPADDCOLOR."</strong></center><br /><br />";
echo "<div align=\"justify\">";
echo "<strong>&#8226; "._NSDLHLPADDCOLOR."</strong><br />";
echo ""._NSDLHLPADDCOLOR2."<br /><br />";
echo "</div><br />";
echo "<center><input type=\"button\" value=\"Close Window\" onclick=\"window.close()\">";
echo "</center></font>";
echo "</body>";
echo "</html>";

} else {
    echo "Access Denied";
}

?>