<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$xdate = time();
$datenew = $newyear."-".$newmonth."-".$newday." ".$newhour.":".$newmin.":00";
if($datenew == "0000-00-00 00:00:00") { $ydate = "0"; } else { $ydate = strtotime($datenew); }
$j = count($add_uid);
for($i=0; $i < $j; $i++) {
  if(!is_ingroup($add_uid[$i],$gid)) {
    list($phpBB) = $db->sql_fetchrow($db->sql_query("SELECT `phpBB` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
    list($u_name) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='$add_uid[$i]'"));
    $db->sql_query("INSERT INTO `".$prefix."_nsngr_users` (`gid`, `uid`, `uname`, `sdate`, `edate`) VALUES ('$gid', '$add_uid[$i]', '$u_name', '$xdate', '$ydate')");
    $db->sql_query("INSERT INTO `".$prefix."_bbuser_group` (`group_id`, `user_id`, `user_pending`) VALUES ('$phpBB', '$add_uid[$i]', '0')");
  }
}
Header("Location: ".$admin_file.".php?op=NSNGroupsUsersAdd&gid=$gid&min=$min");

?>