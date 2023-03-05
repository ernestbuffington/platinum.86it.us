<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$datenew = $newyear."-".$newmonth."-".$newday." ".$newhour.":".$newmin.":00";
if($datenew == "0000-00-00 00:00:00") { $newdate = "0"; } else { $newdate = strtotime($datenew); }
$db->sql_query("UPDATE `".$prefix."_nsngr_users` SET `edate`='$newdate', `notice`='0' WHERE `gid`='$gid' AND `uid`='$chng_uid'");
Header("Location: ".$admin_file.".php?op=NSNGroupsUsersView&gid=$gid");

?>