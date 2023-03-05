<?php
/********************************************************/
/* Site Credits Module for PHP-Nuke                     */
/* Version 1.0.1         4-03-04                        */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2004 by Codezwiz                    */
/********************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
$sql = "SELECT * FROM ".$prefix."_credits";
if(!$db->sql_query($sql)) header("location: ".$admin_file.".php?op=sitecredits_install");
/*********************************************************/
/* Index                                                 */
/*********************************************************/
function credits() {
    global $admin, $bgcolor2, $prefix, $db, $admin_file;
    $credit_id = intval($credit_id); 
    include_once("header.php");
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
	."<tr bgcolor=\"$bgcolor2\"><td width='15%'>"._MOD_NAME."</td><td width='55%'>"._MOD_DESCRIPTION."</td><td width='15%'>"._MOD_AUTHOR."</td><td width='15%'>"._MOD_ACTION."</td></tr>";
    $sql = "SELECT * FROM ".$prefix."_credits ORDER BY credit_id ASC";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$credit_id = $row[credit_id];
	$credit_name = $row[credit_name];
	$credit_description = $row[credit_description];
	$credit_author = $row[credit_author];
      $credit_link = $row[credit_link]; 
	echo"<tr><td colspan=4><hr></td></tr><tr><td><strong>$credit_name</strong></td>"
	    ."<td><strong>$credit_description</strong></td>"
          ."<td><strong><a href='$credit_link'>$credit_author</a></strong></td>" 
          ."</td>";
      echo "<td>[ <a href=\"".$admin_file.".php?op=creditsedit&amp;credit_id=$credit_id\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=creditsdel&amp;credit_id=$credit_id&amp;ok=0\">"._DELETE."</a> ]</td></tr>";
   }
    echo "<tr><td colspan=4><hr>";
    echo "</td></tr></table>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><font class=\"option\"><strong>"._ADDCREDITS."</strong></font></center>"
	."<form action=\"".$admin_file.".php\" method=\"post\">"
	."<table border=\"0\" width=\"100%\"><tr><td>"
	.""._MOD_NAME2."</td><td><input type=\"text\" name=\"credit_name\" size=\"31\"></td></tr><tr><td>"
	.""._MOD_DESCRIPTION2."</td><td><textarea name=\"credit_description\" cols=60 rows=5></textarea>"
	."</td></tr><tr><td>"
	.""._MOD_AUTHOR2."</td><td><input type=\"text\" name=\"credit_author\" size=\"31\"></td></tr><tr>"
      ."<td>"
	.""._MOD_LINK2."</td><td><input type=\"text\" name=\"credit_link\" size=\"31\" value=\"http://\"></td>"                          
      ."</tr></table><br />"                                                                                                                                               
	."<input type=\"hidden\" name=\"op\" value=\"creditsadd\">"
	."<input type=\"submit\" value="._ADDCREDIT.">"
	."</form>";
    CloseTable();
    Showcreditscc();
    include_once("footer.php");
}
function creditsedit($credit_id) {
    global $admin, $bgcolor2, $prefix, $db, $admin_file;
    $credit_id = intval($credit_id); 
    include_once("header.php");
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
    CloseTable();
    echo "<br />";
    $sql = "SELECT * FROM ".$prefix."_credits where credit_id='$credit_id'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$credit_id = $row[credit_id];
	$credit_name = $row[credit_name];
	$credit_description = $row[credit_description];
	$credit_author = $row[credit_author];
    $credit_link = $row[credit_link];
    OpenTable();
    echo "<center><font class=\"option\"><strong>"._CREDITSEDIT."</strong></font></center>"
	."<form action=\"".$admin_file.".php\" method=\"post\">"
	."<input type=\"hidden\" name=\"credit_id\" value=\"$credit_id\">"
	."<table border=\"0\" width=\"100%\"><tr><td>"
	.""._MOD_NAME2."</td><td><input type=\"text\" name=\"credit_name\" size=\"31\" value=\"$credit_name\"></td></tr><tr><td>"
	.""._MOD_DESCRIPTION2."</td><td><textarea name=\"credit_description\" cols=60 rows=5>$credit_description</textarea>"
	."</td></tr><tr><td>"
	.""._MOD_AUTHOR2."</td><td><input type=\"text\" name=\"credit_author\" size=\"31\" value=\"$credit_author\"></td></tr><tr>"
      ."<td>"
	.""._MOD_LINK2."</td><td><input type=\"text\" name=\"credit_link\" size=\"31\" value=\"$credit_link\"></td>"                          
      ."</tr></table><br />"                                                                                                                                               
	."<input type=\"hidden\" name=\"op\" value=\"creditsave\">"
	."<input type=\"submit\" value="._UPDATECREDIT."> "._GOBACK.""
	."</form>";
    CloseTable();
    Showcreditscc();
    include_once("footer.php");
 }
}
function creditsave($credit_id, $credit_name, $credit_description, $credit_author, $credit_link) {
    global $prefix, $dbi, $admin_file;
    sql_query("update ".$prefix."_credits set credit_name='$credit_name', credit_description='$credit_description', credit_author='$credit_author', credit_link='$credit_link' where credit_id='$credit_id'", $dbi);
    Header("Location: ".$admin_file.".php?op=credits");
}
function creditsdel($credit_id, $ok=0) {
    global $prefix, $dbi, $admin_file;
    $credit_id = intval($credit_id);
    if($ok==1) {
	sql_query("delete from ".$prefix."_credits where credit_id='$credit_id'", $dbi);
	Header("Location: ".$admin_file.".php?op=credits");
    } else {
	include_once("header.php");
//	//GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<br /><center><strong>"._CREDITSDELWARNING."</strong><br /><br />";
    }
	echo "[ <a href=\"".$admin_file.".php?op=creditsdel&amp;credit_id=$credit_id&amp;ok=1\">"._YES."</a> | <a href=\"".$admin_file.".php?op=credits\">"._NO."</a> ]</center><br /><br />";
	CloseTable(); 
      Showcreditscc(); 
	include_once("footer.php");
}
function sitecredits_install()
    {
    global $prefix, $db, $admin_file;
	include_once("header.php");
	title("Site Credits Auto Installer");
	opentable();
	echo "<strong>Here are the results of the installation:</strong><br /><br /><pre>\n";
	$sql = "DROP TABLE IF EXISTS ".$prefix."_credits";
	if($db->sql_query($sql)) echo "Drop table is Complete\n";
	else echo "There was a problem with dropping the table try dropping it with phpmyadmin";
	$sql = "CREATE TABLE ".$prefix."_credits (
      credit_id int(11) NOT NULL auto_increment,
      credit_name varchar(60) default NULL,
      credit_author varchar(20) default NULL,
      credit_link varchar(30) default NULL,
      credit_description text,
      PRIMARY KEY  (`credit_id`)
      ) TYPE=MyISAM";
	if($db->sql_query($sql)) echo "Site Credits table where installed\n";
	else echo "There was an error installing the site credits table\n";
	$sql = "INSERT INTO `".$prefix."_credits` (`credit_id`, `credit_name`, `credit_author`, `credit_link`, `credit_description`) VALUES (1, 'Site Credits', 'Telli', 'http://codezwiz.com', 'Site Credits version 1.0. Add all your site credits in one spot. Give credit to the people who work to give you great add-on\'s and support for them. ');";
	if($db->sql_query($sql)) echo "Inserted all information correctly\n";
	else echo "There was an error inserting the information\n";
	echo "</pre><strong>Site Credits has been successfully installed!<br /><center> [ <a href=\"".$admin_file.".php?op=credits\">Go Back </a> ]</center></strong>";
	closetable();
	include_once("footer.php");
    }
// Dont mess with my work please
function Showcreditscc() {
echo "<br />";
Opentable();
echo"<div align=\"right\">Credits © Telli <a href='http://codezwiz.com/'>Codezwiz</a></div>";
Closetable();
}
switch($op) {
    case "creditsdel":
    creditsdel($credit_id, $ok);
    break;
    case "creditsedit":
    creditsedit($credit_id);
    break; 
    case "creditsave":
    creditsave($credit_id, $credit_name, $credit_description, $credit_author, $credit_link);
    break;
    case "creditsadd":
    if ($credit_name=="") {
	include_once("header.php");
//	//GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._ERRORNONAME."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
      Showcreditscc();
	include_once("footer.php");
    }
    if ($credit_description=="") {
	include_once("header.php");
//	//GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._ERRORNODESCRIPTION."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
      Showcreditscc();
	include_once("footer.php");
    }
    if ($credit_author=="") {
	include_once("header.php");
//	//GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._ERRORNOAUTHOR."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
      Showcreditscc();
	include_once("footer.php");
    }
    if ($credit_link=="") {
	include_once("header.php");
//	//GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>"._CREDITS."</strong></font></center>";
	echo "<center><a href=\"".$admin_file.".php\">["._ADMLINK."]</a></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._ERRORNOURL."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
      Showcreditscc();
	include_once("footer.php");
    }
    $credit_name = stripslashes(FixQuotes($credit_name));
    $credit_description = stripslashes(FixQuotes($credit_description));
    $credit_author = stripslashes(FixQuotes($credit_author));
    $credit_link = stripslashes(FixQuotes($credit_link));
    $sql = "insert into ".$prefix."_credits ";
    $sql .=
    "(credit_id,credit_name,credit_description,credit_author,credit_link)";
    $sql .= "values 
    (NULL,'$credit_name','$credit_description','$credit_author','$credit_link')";
    $result = sql_query($sql, $dbi);
    Header("Location: ".$admin_file.".php?op=credits");
    break;
    case "sitecredits_install":
    SiteCredits_install();
    break;
    case "credits":
    credits();
    break;
  }
} else {
    echo "Access Denied!!";
}
?>