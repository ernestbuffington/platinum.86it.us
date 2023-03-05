<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSUSERSEXPIRE;
include_once("header.php");
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='$chng_uid'"));
list($gname) = $db->sql_fetchrow($db->sql_query("SELECT `gname` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='NSNGroupsUsersExpireDone'>\n";
echo "<input type='hidden' name='gid' value='$gid'>\n";
echo "<input type='hidden' name='uid' value='$chng_uid'>\n";
echo "<td align='center'>"._GR_EXPUSER." #$chng_uid ($uname) "._GR_FROM." $gname?</td>\n";
echo "</tr><tr>\n";
echo "<td align='center'><input type='submit' value='"._GR_EXPIRE." &quot;$uname&quot;'></td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
echo "<center>"._GOBACK."</center>\n";
CloseTable();
include_once("footer.php");

?>
