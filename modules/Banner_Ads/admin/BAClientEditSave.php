<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$cid = intval($cid);
$chng_name = baclear_text($chng_name);
$chng_email = baclear_text($chng_email);
$chng_login = baclear_text($chng_login);
if ($chng_passwd != "") {
  $new_pass = md5($chng_passwd);
  $db->sql_query("UPDATE ".$prefix."_nsnba_clients SET name='$chng_name', email='$chng_email', login='$chng_login', passwd='$new_passwd' WHERE cid='$cid'");
} else {
  $db->sql_query("UPDATE ".$prefix."_nsnba_clients SET name='$chng_name', email='$chng_email', login='$chng_login' WHERE cid='$cid'");
}
header("Location: ".$admin_file.".php?op=BAClient");

?>