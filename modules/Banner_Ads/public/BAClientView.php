<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

echo "<html>\n";
echo "<head><title>"._BA_VIEWCLNT.": $bacookie[1]</title></head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
if (is_baclient($baclient)) {
  $result = $db->sql_query("SELECT name, email FROM ".$prefix."_nsnba_clients WHERE login='$bacookie[1]'");
  list ($cname, $email) = $db->sql_fetchrow($result);
  echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<tr><td align='right'>"._BA_CLTID.":</td><td>$bacookie[1]</td></tr>\n";
  echo "<tr><td align='right'>"._BA_CONNME.":</td><td>$cname</td></tr>\n";
  echo "<tr><td align='right'>"._BA_CONEML.":</td><td>$email</td></tr>\n";
  echo "</table></center>\n";
} else {
  echo "<center><b>"._BA_HCKATP."</b></center>\n";
}
echo "</body>\n";
echo "</html>";

?>