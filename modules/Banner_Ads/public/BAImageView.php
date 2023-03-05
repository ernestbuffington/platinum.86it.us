<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
echo "<html>\n";
echo "<head><title>"._BA_VIEWBANN.": $bid</title></head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
if (is_baclient($baclient)) {
  $baninfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid' AND cid='$bacookie[0]'"));
  list ($bantype) = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsnba_placements WHERE pid='".$baninfo['pid']."'"));
  echo "<center><table border='0' cellpadding='0' cellspacing='0'>\n";
  echo "<tr><td>\n";
  echo "<table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<tr><td>\n";
  if ($baninfo['flash']==1) {
    echo "<center>";
    echo " <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0' width='468' height='60'>";
    echo " <param name=movie value='".$baninfo['imageurl']."'>";
    echo " <param name=quality value=high>";
    echo " <embed src='".$baninfo['imageurl']."' quality=high pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='468' height='60'>";
    echo " </embed> ";
    echo " </object>";
    echo "</center>\n";
  } elseif ($baninfo['code']==1) {
    $fp = fopen ($baninfo['imageurl'], "rb");
    $contents = fread ($fp, filesize ($baninfo['imageurl']));
    fclose ($fp);
    echo "<center>$contents</center>\n";
  } else {
    echo "<center><img src='".$baninfo['imageurl']."' border='0' alt='".$baninfo['alttext']."'></center><br>\n";
  }
  if ($baninfo['impmade']==0) {
    $percent = 0;
  } else {
    $percent = substr(100 * $baninfo['clicks'] / $baninfo['impmade'], 0, 5);
  }
  $left = $baninfo['imptotal']-$baninfo['impmade'];
  echo "</td></tr>\n";
  echo "</table></center>\n";
  if ($baninfo['height'] > $baninfo['width']) {
    echo "</td>\n<td valign='top'>\n";
  } else {
    echo "</td></tr>\n<tr><td>\n";
  }
  echo "<table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<tr><td align='right'>"._BA_IMGSRC.":</td><td>".$baninfo['imageurl']."</td></tr>\n";
  if ($baninfo['clickurl'] != "") { echo "<tr><td align='right'>"._BA_CLKU.":</td><td>".$baninfo['clickurl']."</td></tr>\n"; }
  if ($baninfo['alttext'] != "") { echo "<tr><td align='right'>"._BA_ALTTXT.":</td><td>".$baninfo['alttext']."</td></tr>\n"; }
  echo "<tr><td align='right'>"._BA_PLCM.":</td><td>$bantype</td></tr>\n";
  if ($baninfo['imptotal'] == 0) {
    echo "<tr><td align='right'>"._BA_IMPMAD.":</td><td>".$baninfo['impmade']."</td></tr>\n";
  } else {
    echo "<tr><td align='right'>"._BA_IMPPUR.":</td><td>".$baninfo['imptotal']."</td></tr>\n";
    echo "<tr><td align='right'>"._BA_IMPMAD.":</td><td>".$baninfo['impmade']."</td></tr>\n";
    echo "<tr><td align='right'>"._BA_IMPLFT.":</td><td>$left</td></tr>\n";
  }
  if ($baninfo['dateend'] != "0000-00-00") {
    echo "<tr><td align='right''>"._BA_ENDDTE.":</td><td>".$baninfo['dateend']."</td></tr>\n";
  }
  echo "</table>\n";
  echo "</td></tr>\n";
  echo "</table></center>\n";
} else {
  echo "<center><b>"._BA_HCKATP."</b></center>\n";
}
echo "</body>\n";
echo "</html>";

?>