<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSUSERSADD;
include_once("header.php");
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$grconfig['perpage'];
if(!isset($gid)) { $gid = 0; }  
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
if($gid > 0) {
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$user_prefix."_users` WHERE `user_level`>'0'"));
  grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
  echo "<center><table border='0' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2'>\n";
  echo "<form method='post' action='".$admin_file.".php?op=NSNGroupsUsersAddSave'>\n";
  echo "<input type='hidden' name='gid' value='$gid'>\n";
  echo "<input type='hidden' name='min' value='$min'>\n";
  list($grpName) = $db->sql_fetchrow($db->sql_query("SELECT `gname` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
  echo "<tr><td align='center' colspan='2' bgcolor='$bgcolor2'>"._GR_ADDUSRTO." <a href='".$admin_file.".php?op=NSNGroupsUsersView&amp;gid=$gid'><strong>$grpName</strong></a></td></tr>";
  $result3 = $db->sql_query("SELECT `user_id`, `username` FROM `".$user_prefix."_users` WHERE `user_level`>'0' ORDER BY `username` LIMIT $min,".$grconfig['perpage']."");
  while(list($thisUID, $thisUNAME) = $db->sql_fetchrow($result3)) {
    echo "<tr bgcolor='$bgcolor1' onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\">\n";
    echo "<td>$thisUNAME</td>\n";
    if(!is_ingroup($thisUID,$gid)) {
      echo "<td align='center'><input name='add_uid[]' type='checkbox' value='$thisUID'></td>\n";
    } else {
      echo "<td align='center'><input name='add_uid[]' type='checkbox' value='$thisUID' disabled></td>\n";
    }
    echo "</tr>";
  }
  echo "<tr><td align='center' colspan='2'><nobr>"._GR_EXPIRES.": <select name='newmonth'>\n<option value='00'>--</option>\n";
  for($i = 1; $i <= 12; $i++){
    if($i == $fmon){ $sel = "SELECTed"; } else { $sel = ""; }
    if($i < 10) { $r = "0".$i; } else { $r = $i; }
    echo "<option value='$r' $sel>$i</option>\n";
  }
  echo "</select><strong>/</strong><select name='newday'>\n<option value='00'>--</option>\n";
  for($i = 1; $i <= 31; $i++){
    if($i == $fday){ $sel = "SELECTed"; } else { $sel = ""; }
    if($i < 10) { $r = "0".$i; } else { $r = $i; }
    echo "<option value='$r' $sel>$i</option>\n";
  }
  echo "</select><strong>/</strong><select name='newyear'>\n<option value='0000'>----</option>\n";
  for($i = date("Y"); $i <= date("Y")+5; $i++){
    if($i == $fyear){ $sel = "SELECTed"; } else { $sel = ""; }
    if($i < 10) { $r = "0".$i; } else { $r = $i; }
    echo "<option value='$r' $sel>$i</option>\n";
  }
  echo "</select> <select name='newhour'>\n<option value='00'>--</option>\n";
  for($i = 0; $i <= 23; $i++){
    if($i == $fhour AND $fhour > 0){ $sel = "SELECTed"; } else { $sel = ""; }
    if($i < 10) { $r = "0".$i; } else { $r = $i; }
    echo "<option value='$r' $sel>$i</option>\n";
  }
  echo "</select><strong>:</strong><select name='newmin'>\n<option value='00'>--</option>\n";
  for($i = 0; $i <= 59; $i++){
    if($i == $fmin AND $fmin > 0){ $sel = "SELECTed"; } else { $sel = ""; }
    if($i < 10) { $r = "0".$i; } else { $r = $i; }
    echo "<option value='$r' $sel>$i</option>\n";
  }
  echo "</select><strong>:00</strong></nobr><br />"._GR_EXPIRENOTE."</td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._GR_ADDUSR."'></td></tr>\n";
  echo "</form>\n";
  echo "</table></center>\n";
  grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
} else {
  $field_r = "\"gid\"";
  $field_d = "\""._GR_ADDUSRTO."\"";
  grformcheck($field_r, $field_d);
  echo "<center><table border='0' cellpadding='0' cellspacing='2'>\n";
  echo "<form method='post' action='".$admin_file.".php?op=NSNGroupsUsersAdd' onsubmit='return formCheck(this);'>\n";
  echo "<tr>\n";
  echo "<td align='center'>"._GR_ADDUSRTO."<br />";
  echo "<SELECT NAME='gid' size='5'>\n";
  $result3 = $db->sql_query("SELECT `gid`, `gname` FROM `".$prefix."_nsngr_groups` ORDER BY `gname`");
  while(list($thisGID, $thisGNAME) = $db->sql_fetchrow($result3)) { echo "<option value='$thisGID'>$thisGNAME</option><br />\n"; }
  echo "</SELECT><br /><input type='submit' value='"._GR_SELECTGRP."'></td>\n";
  echo "</tr>\n";
  echo "</form>\n";
  echo "</table></center>\n";
}
CloseTable();
include_once("footer.php");

?>
