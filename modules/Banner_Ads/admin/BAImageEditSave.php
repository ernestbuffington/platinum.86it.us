<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
$chng_imageurl = baclear_text($chng_imageurl);
$chng_clickurl = baclear_text($chng_clickurl);
$chng_alttext = baclear_text($chng_alttext);
$imgurl = baclear_text($chng_imageurl);
$imptotal = $imptotal + $chng_imptotal;
$db->sql_query("UPDATE ".$prefix."_nsnba_banners SET cid='$chng_cid', imptotal='$imptotal', imageurl='$imgurl', clickurl='$chng_clickurl', alttext='$chng_alttext', code='$chng_code', flash='$chng_flash', height='$chng_height', width='$chng_width', datestr='$strdate', dateend='$enddate', pid='$chng_pid', active='$chng_status' WHERE bid='$bid'");
header("Location: ".$admin_file.".php?op=BAImage&active=$chng_status");

?>