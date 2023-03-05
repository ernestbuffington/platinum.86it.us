<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

@require_once("mainfile.php");
$bid=intval($bid);
global $prefix, $db;
list($clickurl) = $db->sql_fetchrow($db->sql_query("SELECT clickurl FROM ".$prefix."_nsnba_banners WHERE bid='$bid'"));
$db->sql_query("UPDATE ".$prefix."_nsnba_banners SET clicks=clicks+1 WHERE bid='$bid'");
Header("Location: $clickurl");

?>
