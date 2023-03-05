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
$bidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid'"));
$cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients WHERE cid='".$bidinfo['cid']."'"));
if ($bidinfo['dateend'] == "0000-00-00") { $dateend = ""._BA_NOTSET.""; } else { $dateend = $bidinfo['dateend']; }
if ($bidinfo['active'] == -1) { $activated = ""._BA_PEN.""; } elseif ($bidinfo['active'] == 0) { $activated = ""._BA_INA.""; } elseif ($bidinfo['active'] == 1) { $activated = ""._BA_ACT.""; }
if ($bidinfo['imptotal'] == 0) { $imptotal = ""._BA_NOTSET.""; }
if ($bidinfo['pid'] == 1) { $bantype = _BA_HEAD; } elseif ($bidinfo['pid'] == 2) { $bantype = _BA_FOOT; } elseif ($bidinfo['pid'] == 3) { $bantype = _BA_LEFT; } elseif ($bidinfo['pid'] == 4) { $bantype = _BA_RIGHT; }
echo "<center><table border='0' cellpadding='0' cellspacing='0'>\n";
echo "<tr><td>\n";
echo "<table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td>\n";
if ($bidinfo['flash'] == 1 AND $bidinfo['code'] == 0) {
  echo "<center>";
  echo " <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='".$bidinfo['width']."' height='".$bidinfo['height']."'>";
  echo " <param name=movie value='".$bidinfo['imageurl']."'>";
  echo " <param name=quality value=high>";
  echo " <embed src='".$bidinfo['imageurl']."' quality=high pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='".$bidinfo['width']."' height='".$bidinfo['height']."'>";
  echo " </embed> ";
  echo " </object>";
  echo "</center>\n";
} elseif ($bidinfo['flash'] == 0 AND $bidinfo['code'] == 1) {
  $fp = fopen ("$imageurl", "rb");
  $contents = fread ($fp, filesize ($bidinfo['imageurl']));
  fclose ($fp);
  echo "<center>$contents</center>";
} else {
  echo "<center><img src='".$bidinfo['imageurl']."' border='1' alt='".$bidinfo['alttext']."' width='".$bidinfo['width']."' height='".$bidinfo['height']."'></center><br>\n";
}
echo "</td></tr>\n";
echo "</table></center>\n";
if ($bidinfo['height'] > $bidinfo['width']) {
  echo "</td>\n<td valign='top'>\n";
} else {
  echo "</td></tr>\n<tr><td>\n";
}
echo "<table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td align='right'>"._BA_CLTID.":</td><td>".$cidinfo['login']."</td></tr>\n";
echo "<tr><td align='right'>"._BA_IMPTOT.":</td><td>".$bidinfo['imptotal']."</td></tr>\n";
echo "<tr><td align='right'>"._BA_ENDDTE.":</td><td>$dateend</td></tr>\n";
echo "<tr><td align='right'>"._BA_IMGSRC.":</td><td>".$bidinfo['imageurl']."</td></tr>\n";
if ($bidinfo['code'] == 0 AND $bidinfo['flash'] == 0) {
  echo "<tr><td align='right'>"._BA_CLKU.":</td><td>$clickurl</td></tr>\n";
  echo "<tr><td align='right'>"._BA_ALTTXT.":</td><td>$alttext</td></tr>\n";
  echo "<tr><td align='right'>"._BA_FLH.":</td><td>"._BA_NO."</td></tr>\n";
  echo "<tr><td align='right'>"._BA_CDE.":</td><td>"._BA_NO."</td></tr>\n";
  echo "<tr><td align='right''>"._BA_HEI.":</td><td>".$bidinfo['height']."</td></tr>\n";
  echo "<tr><td align='right'>"._BA_WID.":</td><td>".$bidinfo['width']."</td></tr>\n";
} else {
  echo "<tr><td align='right'>"._BA_FLH.":</td><td>";
  if ($bidinfo['flash'] == 0) { echo ""._BA_NO.""; } else { echo ""._BA_YES.""; }
  echo "</td></tr>\n";
  echo "<tr><td align='right'>"._BA_CDE.":</td><td>";
  if ($bidinfo['code'] == 0) { echo ""._BA_NO.""; } else { echo ""._BA_YES.""; }
  echo "</td></tr>\n";
}
echo "<tr><td align='right'>"._BA_PLCM.":</td><td>$bantype</td></tr>\n";
echo "<tr><td align='right'>"._BA_STAT.":</td><td>$activated</td></tr>\n";
echo "</table>\n";
echo "</td></tr>\n";
echo "</table></center>\n";
echo "</body>\n";
echo "</html>";

?>