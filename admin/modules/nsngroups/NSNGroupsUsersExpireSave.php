<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$newDate = time() - 86400;
$j = count($exp_uid);
for($i=0; $i < $j; $i++) {
  $db->sql_query("UPDATE `".$prefix."_nsngr_users` SET `edate`='$newDate' WHERE `gid`='$gid' AND `uid`='$exp_uid[$i]'");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsngr_users`");
}
Header("Location: ".$admin_file.".php?op=NSNGroupsUsersView&gid=$gid");

?>