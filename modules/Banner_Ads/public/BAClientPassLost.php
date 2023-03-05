<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_CLTPASLOST;
if (!is_baclient($baclient)) {
  @include_once("header.php");
  title(_BA_CLTPASLOST);
  OpenTable();
  echo "<b>"._BA_LOSTPASS."</b><br><br>\n";
  echo _BA_SENDCODE."<br><br>\n";
  echo "<center><table border='0'>\n";
  echo "<form action='modules.php?name=$module_name' method='post'>\n";
  echo "<input type='hidden' name='op' value='BAClientPassMail'>\n";
  echo "<tr><td>"._BA_CLTID.":</td><td><input type='text' name='cname' size='15' maxlength='25'></td></tr>\n";
  echo "<tr><td>"._BA_CONFCODE.":</td><td><input type='text' name='code' size='11' maxlength='10'></td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
  echo "</form>\n</table>\n</center><br>\n";
  echo "<center>[ <a href='modules.php?name=$module_name'>"._BA_CLTLOG."</a> |";
  echo " <a href='modules.php?name=$module_name&amp;op=BAClientNew'>"._BA_CLTREG."</a> ]</center>\n";
  CloseTable();
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>