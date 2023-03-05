<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$new_name = baclear_text($new_name);
$new_email = baclear_text($new_email);
$new_login = baclear_text($new_login);
$new_pass = md5($new_passwd);
$db->sql_query("INSERT INTO ".$prefix."_nsnba_clients VALUES (NULL, '$new_name', '$new_email', '$new_login', '$new_pass')");
header("Location: ".$admin_file.".php?op=BAImageAdd");

?>