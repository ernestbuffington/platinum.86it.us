<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

list($phpBB, $muid) = $db->sql_fetchrow($db->sql_query("SELECT `phpBB`, `muid` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
// $db->sql_query("DELETE FROM `".$prefix."_nsngr_users` WHERE `gid`='$gid' AND `muid`!='$muid'");
$db->sql_query("DELETE FROM `".$prefix."_nsngr_users` WHERE `gid`='$gid' AND `uid`!='$muid'"); // Per B.M. 10/28/2006
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsngr_users`");
$db->sql_query("DELETE FROM `".$prefix."_bbuser_group` WHERE `group_id`='$phpBB' AND `user_id`!='$muid'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_bbuser_group`");
Header("Location: ".$admin_file.".php?op=NSNGroupsView");

?>
