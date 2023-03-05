<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
echo "<html>\n";
echo "<head><title>"._BA_MAILBANNSTAT.": $bid</title></head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
if (is_baclient($baclient)) {
  list ($cname, $email) = $db->sql_fetchrow($db->sql_query("SELECT name, email FROM ".$prefix."_nsnba_clients WHERE cid='$bacookie[0]'"));
  if ($email=="") {
    echo "<center><b>"._BA_STATNOTSENT."</b></center><br>\n";
  } else {
    $bidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid' and cid='$bacookie[0]'"));
    if ($bidinfo['impmade']==0) {
      $percent = 0;
    } else {
      $percent = substr(100 * $bidinfo['clicks'] / $bidinfo['impmade'], 0, 5);
    }
    $remaining = $bidinfo['dateend'];
    $fecha = date("F jS Y, h:iA.");
    $subject  = _BA_BANSTATAT." $sitename";
    $message  = _BA_COMPSTAT." $sitename:\n\n";
    $message .= _BA_CONNME.": $cname\n";
    $message .= _BA_BANNUM.": $bid\n";
    $message .= _BA_IMGSRC." - ".$bidinfo['imageurl']."\n";
    $message .= _BA_CLKU." - ".$bidinfo['clickurl']."\n\n";
    $message .= _BA_IMPMAD." - ".$bidinfo['impmade']."\n";
    $message .= _BA_CLKS." - ".$bidinfo['clicks']."\n";
    $message .= _BA_CLKP." - ".$bidinfo['percent']."%\n";
    $message .= _BA_STRDTE." - ".$bidinfo['datestr']."\n";
    if ($bidinfo['dateend']!="0000-00-00") {
      $message .= _BA_ENDDTE." - ".$bidinfo['dateend']."\n";
    }
    $message .= _BA_REPORTON.": $fecha";
    $from = "$sitename";
    mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
    echo "<center><b>"._BA_STATSENT."</b></center>\n";
  }
} else {
  echo "<center><b>"._BA_HCKATP."</b></center>\n";
}
echo "</body>\n";
echo "</html>";

?>