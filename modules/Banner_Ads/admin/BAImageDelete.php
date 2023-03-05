<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_DELBANN;
@include_once("header.php");
title(_BA_DELBANN);
BAAdmin();
echo "<br>\n";
OpenTable();
echo "<center><b>"._BA_DELBAN."</b></center><br>\n";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='BAImageDeleteConf'>\n";
echo "<input type='hidden' name='bid' value='$bid'>\n";
echo "<td><input type='submit' value='  "._BA_YES."  '></td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
CloseTable();
@include_once("footer.php");

?>