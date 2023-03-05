<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$cid = intval($cid);
$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_DELCLNT;
@include_once("header.php");
title(_BA_DELCLNT);
BAAdmin();
echo "<br>\n";
OpenTable();
echo "<center><b>"._BA_DELCLT."</b></center><br>";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='BAClientDeleteConf'>\n";
echo "<input type='hidden' name='cid' value='$cid'>\n";
echo "<td><input type='submit' value='  "._BA_YES."  '></td>\n";
echo "</form>\n";
echo "</tr></table></center><br>\n";
$numrows = $db->sql_numrows($db->sql_query("SELECT imageurl FROM ".$prefix."_nsnba_banners WHERE cid='$cid'"));
if ($numrows==0) {
  echo "<center>"._BA_CLTNOBAN."</center>\n";
} else {
  echo "<center>"._BA_CLTBANDEL."</center>\n";
}
CloseTable();
@include_once("footer.php");

?>