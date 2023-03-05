<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$gcontent = stripslashes($gcontent);
$headers  = "MIME-Version: 1.0\n";
if($etype < 1) {
  $headers .= "Content-Type: text/plain; charset=iso-8859-1\n";
  $gcontent .= "\n--------------------\n"._GR_THANK.";\n$aname <$amail>";
} else {
  $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
  $gcontent .= "<hr />"._GR_THANK.";<br /><a href='mailto:$amail'>$aname</a>";
}
$headers .= "From: $aname <$amail>\r\n";
$headers .= "Return-Path: $amail\r\n";
$headers .= "Reply-To: $amail\r\n";
$headers .= "X-Mailer: NSN Groups";
if($gid == 0) {
  $gsubject = "[$sitename "._GR_GLET."]: ".stripslashes($gsubject)."";
  $result = $db->sql_query("SELECT `uid` FROM `".$user_prefix."_nsngr_users`");
  while(list($guid) = $db->sql_fetchrow($result)) {
    list($email) = $db->sql_fetchrow($db->sql_query("SELECT `user_email` FROM `".$user_prefix."_users` WHERE `user_id`='$guid'"));
    $to = ""._GR_GLET." <$email>";
    mail($email, $gsubject, $gcontent, $headers);
  }
  Header("Location: ".$admin_file.".php?op=NSNGroups");
} else {
  list($gname) = $db->sql_fetchrow($db->sql_query("SELECT `gname` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
  $gsubject = "[$gname "._GR_GLET."]: ".stripslashes($gsubject)."";
  $result = $db->sql_query("SELECT `uid` FROM `".$prefix."_nsngr_users` WHERE `gid`='$gid'");
  while(list($guid) = $db->sql_fetchrow($result)) {
    list($email) = $db->sql_fetchrow($db->sql_query("SELECT `user_email` FROM `".$user_prefix."_users` WHERE `user_id`='$guid'"));
    $to = "$gname <$email>";
    mail($email, $gsubject, $gcontent, $headers);
  }
  Header("Location: ".$admin_file.".php?op=NSNGroups");
}

?>
