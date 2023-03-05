<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

list($latest_bid) = $db->sql_fetchrow($db->sql_query("SELECT max(bid) AS latest_bid FROM ".$prefix."_nsnba_banners"));
$latest_bid = $latest_bid + 1;
$imageurl = baclear_text($imageurl);
$clickurl = baclear_text($clickurl);
$alttext = baclear_text($alttext);
$db->sql_query("INSERT INTO ".$prefix."_nsnba_banners VALUES ($latest_bid, $cid, $pid, $imptotal, 0, 0, '$imageurl', '$clickurl', '$alttext', $code, $flash, $height, $width, '$strdate', '$enddate', $active)");
header("Location: ".$admin_file.".php?op=BAMain");

?>