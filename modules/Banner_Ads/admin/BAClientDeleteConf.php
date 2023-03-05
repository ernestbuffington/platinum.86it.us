<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$cid = intval($cid);
$db->sql_query("DELETE FROM ".$prefix."_nsnba_banners WHERE cid='$cid'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnba_banners");
$db->sql_query("DELETE FROM ".$prefix."_nsnba_clients WHERE cid='$cid'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnba_clients");
header("Location: ".$admin_file.".php?op=BAClient");

?>