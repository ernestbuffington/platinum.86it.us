<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
$db->sql_query("DELETE FROM ".$prefix."_nsnba_banners WHERE bid='$bid'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnba_banners");
header("Location: ".$admin_file.".php?op=BAImage&active=$status");

?>