<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_ADDBAN;
@include_once("header.php");
title(_BA_ADDBAN);
BAAdmin();
echo "<br>\n";
$cnumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients"));
if ($cnumrows > 0) {
  OpenTable();
  echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<form action='".$admin_file.".php' method='post'>\n";
  echo "<input type='hidden' name='op' value='BAImageAddSave'>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTID.":</b></td><td><select name='cid'>\n";
  $result = $db->sql_query("SELECT cid, login FROM ".$prefix."_nsnba_clients ORDER BY login");
  while (list ($cid, $login) = $db->sql_fetchrow($result)) { echo "<option value='$cid'>$login</option>"; }
  echo "</select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_IMGSRC.":</b></td><td><input type='text' name='imageurl' size='40'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLKU.":</b></td><td><input type='text' name='clickurl' size='50' maxlength='200'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_ALTTXT.":</b></td><td><input type='text' name='alttext' size='50' maxlength='255'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_HEI.":</b></td><td><input type='text' name='height' size='5' maxlength='4' value='60'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_WID.":</b></td><td><input type='text' name='width' size='5' maxlength='4' value='468'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_FLH.":</b></td><td><select name='flash'><option value='0' selected>"._BA_NO."</option><option value='1'>"._BA_YES."</option></select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CDE.":</b></td><td><select name='code'><option value='0' selected>"._BA_NO."</option><option value='1'>"._BA_YES."</option></select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_STRDTE.":</b></td><td><input type='text' name='strdate' size='15' maxlength='15' value='".date("Y-m-d", strtotime("+1 week"))."'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_ENDDTE.":</b></td><td><input type='text' name='enddate' size='15' maxlength='15' value='".date("Y-m-d", strtotime("+1 week +1 month"))."'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_IMPPUR.":</b></td><td><select name='imptotal'>\n";
  $i = 0;
  while ($i <= 12) { $j = $i * $ba_config['impamnt']; echo "<option value='$j'>$j "._BA_IMPS."</option>"; $i++; }
  echo "</select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PLCM.":</b></td><td><select name='pid'>\n";
  echo "<option value='1'>"._BA_HEAD."</option>\n";
  echo "<option value='2'>"._BA_FOOT."</option>\n";
  echo "<option value='3'>"._BA_LEFT."</option>\n";
  echo "<option value='4'>"._BA_RIGHT."</option>\n";
  echo "</select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_STAT.":</b></td><td><select name='active'>\n";
  echo "<option value='-1'>"._BA_PEN."</option>\n";
  echo "<option value='0'>"._BA_INA."</option>\n";
  echo "<option value='1'>"._BA_ACT."</option></td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
  echo "</form>\n";
  echo "</table></center>\n";
  CloseTable();
} else {
  OpenTable();
  echo "<center><b>"._BA_NOCLTNOBAN."</b></center>\n";
  CloseTable();
}
@include_once("footer.php");

?>