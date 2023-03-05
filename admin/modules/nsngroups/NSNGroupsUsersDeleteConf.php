<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

list($phpBB) = $db->sql_fetchrow($db->sql_query("SELECT `phpBB` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
$db->sql_query("DELETE FROM `".$prefix."_nsngr_users` WHERE `gid`='$gid' AND `uid`='$uid'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsngr_users`");
$db->sql_query("DELETE FROM `".$prefix."_bbuser_group` WHERE `group_id`='$phpBB' AND `user_id`='$uid'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_bbuser_group`");
Header("Location: ".$admin_file.".php?op=NSNGroupsUsersView&gid=$gid");

?>