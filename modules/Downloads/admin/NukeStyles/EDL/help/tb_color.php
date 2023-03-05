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


include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_language.php");


//$result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
//list($name) = $db->sql_numrows($result);


$result2 = $db->sql_query("select Default_Theme from ".$prefix."_config");
list($Default_Theme) = $db->sql_numrows($result2);
echo "<html>";
echo "<head>";
echo "<title>"._NSDLHLPTITLE."</title>";
echo "<link rel=\"stylesheet\" href=\"themes/$Default_Theme/style/style.css\" type=\"text/css\">";
echo "</head>";
echo "<body>";
echo "<font class=\"content\"><center><strong>"._NSDLTBFORMCOLOR."</strong></center><br><br>";
echo "<div align=\"justify\">";
echo "<strong>&#8226; "._NSDLTBFORMCOLOR."</strong><br>";
echo ""._NSDLTBFORMCOLOR2."<br><br>";
echo "</div><br>";
echo "<center><input type=\"button\" value=\"Close Window\" onclick=\"window.close()\">";
echo "</center></font>";
echo "</body>";
echo "</html>";



} else {
    echo "Access Denied";
}



?>