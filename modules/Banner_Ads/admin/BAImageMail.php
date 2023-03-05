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
$bidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid'"));
$cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients WHERE cid='".$bidinfo['cid']."'"));
if ($cidinfo['email'] == "") {
  echo "<center><b>"._BA_STATNOTSENT."</b></center>\n";
} else {
  if($bidinfo['impmade'] == 0) {
    $percent = 0;
  } else {
    $percent = substr(100 * ($bidinfo['clicks'] / $bidinfo['impmade']), 0, 5);
  }
  if($bidinfo['imptotal'] == 0) {
    $left = _BA_NOTSET;
    $imptotal = _BA_NOTSET;
  } else {
    $left = $bidinfo['imptotal'] - $bidinfo['impmade'];
  }
  if($bidinfo['dateend'] == "0000-00-00") { $remaining = _BA_NOTSET; } else { $remaining = $bidinfo['dateend']; }
  $fecha = date("F jS Y, h:iA.");
  $subject  = _BA_BANSTATAT." $sitename";
  $message  = _BA_COMPSTAT." $sitename:\n";
  $message .= "----------------------------------------\n";
  $message .= _BA_CONNME.": ".$cidinfo['name']."\n";
  $message .= _BA_BANNUM.": $bid\n";
  $message .= _BA_IMGSRC.": ".$bidinfo['imageurl']."\n";
  $message .= _BA_CLKU.": ".$bidinfo['clickurl']."\n";
  $message .= _BA_IMPPUR.": ".$bidinfo['imptotal']."\n";
  $message .= _BA_IMPMAD.": ".$bidinfo['impmade']."\n";
  $message .= _BA_IMPLFT.": $left\n";
  $message .= _BA_CLKS.": ".$bidinfo['clicks']."\n";
  $message .= _BA_CLKP.": $percent%\n";
  $message .= _BA_STRDTE.": ".$bidinfo['datestr']."\n";
  $message .= _BA_ENDDTE.": $remaining\n";
  $message .= _BA_REPORTON.": $fecha";
  $from = "$sitename <$adminmail>";
  mail($cidinfo['email'], $subject, $message, "From: $from\n");
  echo "<center><b>"._BA_STATSENT."</b></center>\n";
}
echo "</body>\n";
echo "</html>";

?>