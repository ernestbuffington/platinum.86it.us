<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$gdesc = html_entity_decode($gdesc, ENT_QUOTES);
$gname = stripslashes(strip_tags($gname, "<strong><i><u>"));
$gdesc = stripslashes(strip_tags($gdesc, "<br /><strong><i><u>"));
$mname = stripslashes(strip_tags($mname));
if($gname == "" || $mname == "") {
  include_once("header.php");
  OpenTable();
  echo "<center><strong>"._GR_MISSINGDATA."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once("footer.php");
}
if(!get_magic_quotes_runtime()) { $gname = addslashes($gname); $gdesc = addslashes($gdesc); $mname = addslashes($mname); }
list($muid) = $db->sql_fetchrow($db->sql_query("SELECT `user_id` FROM `".$user_prefix."_users` WHERE `username`='$mname'"));
$db->sql_query("INSERT INTO `".$prefix."_bbgroups` VALUES (NULL, '2', '$gname', '$gdesc', '$muid', '0')");
$phpBB = $db->sql_nextid();
$db->sql_query("INSERT INTO `".$prefix."_bbuser_group` VALUES ('$phpBB', '$muid', '0')");
list($phpBB) = $db->sql_fetchrow($db->sql_query("SELECT `group_id` FROM `".$prefix."_bbgroups` WHERE `group_name`='$gname'"));
$db->sql_query("INSERT INTO `".$prefix."_nsngr_groups` VALUES (NULL, '$gname', '$gdesc' , '$gpublic', '$glimit', '$phpBB', '$muid')");
$gid = $db->sql_nextid();
$stime = time();
$db->sql_query("INSERT INTO `".$prefix."_nsngr_users` VALUES ('$gid', '$muid', '$mname' , '0', '0', '$stime', '0')");
Header("Location: ".$admin_file.".php?op=NSNGroupsView");

?>
