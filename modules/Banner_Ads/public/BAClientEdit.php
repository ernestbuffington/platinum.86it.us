<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_EDITCLNT;
if (is_baclient($baclient)) {
  @include_once("header.php");
  title(_BA_EDITCLNT);
  BAMenu();
  echo "<br>\n";
  OpenTable();
  $result = $db->sql_query("SELECT name, email FROM ".$prefix."_nsnba_clients WHERE login='$bacookie[1]'");
  list ($cname, $email) = $db->sql_fetchrow($result);
  echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<form action='modules.php?name=$module_name' method='post'>\n";
  echo "<input type='hidden' name='op' value='BAClientEditSave'>\n";
  echo "<tr><td align='center' bgcolor='$bgcolor2' colspan='2'><b>"._BA_BANNED."</b></td></tr>\n";
  echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CLTID.":</td><td>$bacookie[1]</td></tr>\n";
  echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CONNME.":</td><td><input type='text' name='chng_name' size='40' maxlength='60' value='$cname'></td></tr>\n";
  echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CONEML.":</td><td><input type='text' name='chng_email' size='40' maxlength='60' value='$email'></td></tr>\n";
  echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_NEWPASS.":</td><td><input type='password' name='new_pass1' size='10' maxlength='20'></td></tr>\n";
  echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CNFPASS.":</td><td><input type='password' name='new_pass2' size='10' maxlength='20'></td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
  echo "</form>\n</table></center>\n";
  CloseTable();
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>