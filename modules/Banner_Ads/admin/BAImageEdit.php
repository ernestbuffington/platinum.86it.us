<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$bid = intval($bid);
$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_EDITBANN;
@include_once("header.php");
title(_BA_EDITBANN);
BAAdmin();
echo "<br>\n";
OpenTable();
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE bid='$bid'");
$bidinfo = $db->sql_fetchrow($result);
if ($bidinfo['imptotal'] == 0) { $impressions = ""._BA_UNLIMT.""; } else { $impressions = $bidinfo['imptotal']; }
if ($bidinfo['active'] == -1) { $sels1 = "selected"; } elseif ($bidinfo['active'] == 0) { $sels2 = "selected"; } elseif ($bidinfo['active'] == 1) { $sels3 = "selected"; }
if ($bidinfo['flash'] == 0) { $self1 = "selected"; } elseif ($bidinfo['flash'] == 1) { $self2 = "selected"; }
if ($bidinfo['code'] == 0) { $selc1 = "selected"; } elseif ($bidinfo['code'] == 1) { $selc2 = "selected"; }
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='BAImageEditSave'>\n";
echo "<input type='hidden' name='bid' value='".$bidinfo['bid']."'>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTID.":</b></td><td><select name='chng_cid'>\n";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients ORDER BY login");
while ($cidinfo = $db->sql_fetchrow($result)) {
  if ($bidinfo['cid'] != $cidinfo['cid']) { echo "<option value='".$cidinfo['cid']."'>".$cidinfo['login']."</option>"; } else { echo "<option value='".$cidinfo['cid']."' selected>".$cidinfo['login']."</option>"; }
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_NEWSRC.":</b></td><td><input type='text' name='chng_imageurl' value='".$bidinfo['imageurl']."' size='40'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLKU.":</b></td><td><input type='text' name='chng_clickurl' size='50' maxlength='200' value='".$bidinfo['clickurl']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_ALTTXT.":</b></td><td><input type='text' name='chng_alttext' size='50' maxlength='255' value='".$bidinfo['alttext']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_HEI.":</b></td><td><input type='text' name='chng_height' size='5' maxlength='4' value='".$bidinfo['height']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_WID.":</b></td><td><input type='text' name='chng_width' size='5' maxlength='4' value='".$bidinfo['width']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_FLH.":</b></td><td><select name='chng_flash'><option value='0' $self1>"._BA_NO."</option><option value='1' $self2>"._BA_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CDE.":</b></td><td><select name='chng_code'><option value='0' $selc1>"._BA_NO."</option><option value='1' $selc2>"._BA_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_STRDTE.":</b></td><td><input type='text' name='strdate' size='15' maxlength='15' value='".$bidinfo['datestr']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_ENDDTE.":</b></td><td><input type='text' name='enddate' size='15' maxlength='15' value='".$bidinfo['dateend']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_ADDIMP.":</b></td><td><select name='chng_imptotal'>\n";
$i = 0;
while ($i <= 12) { $j = $i * $ba_config['impamnt']; echo "<option value='$j'>$j "._BA_IMPS."</option>"; $i++; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PLCM.":</b></td><td><select name='chng_pid'>\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if ($bidinfo['pid'] == 1) { $sel1 = " selected"; } else if ($bidinfo['pid'] == 2) { $sel2 = " selected"; } else if ($bidinfo['pid'] == 3) { $sel3 = " selected"; } else if ($bidinfo['pid'] == 4) { $sel4 = " selected"; }
echo "<option value='1'$sel1>"._BA_HEAD."</option>\n";
echo "<option value='2'$sel2>"._BA_FOOT."</option>\n";
echo "<option value='3'$sel3>"._BA_LEFT."</option>\n";
echo "<option value='4'$sel4>"._BA_RIGHT."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_STAT.":</b></td><td><select name='chng_status'>\n";
echo "<option value='-1' $sels1>"._BA_PEN."</option>\n";
echo "<option value='0' $sels2>"._BA_INA."</option>\n";
echo "<option value='1' $sels3>"._BA_ACT."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
echo "</form>\n";
echo "</table></center>\n";
CloseTable();
@include_once("footer.php");

?>