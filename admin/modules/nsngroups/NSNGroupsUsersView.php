<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSUSERSVIEW;
include_once("header.php");
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$grconfig['perpage'];
if(!isset($gid)) { $gid = 0; }  
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php?op=NSNGroupsUsersView'>\n";
echo "<tr>\n<td align='center'><SELECT NAME='gid'>\n";
echo "<option value='0'";
if($gid == 0) { echo " selected"; }
echo ">"._GR_ALLGROUP."</option><br />\n";
$result3 = $db->sql_query("SELECT `gid`, `gname` FROM `".$prefix."_nsngr_groups` ORDER BY `gname`");
while(list($thisGID, $thisGNAME) = $db->sql_fetchrow($result3)) {
  echo "<option value='$thisGID'";
  if($gid == $thisGID) { echo " selected"; }
  echo ">$thisGNAME</option><br />\n";
}
echo "</SELECT> <input type='submit' value='"._GR_SELECTGRP."'></td>\n</tr>\n";
echo "</form>\n";
echo "</table></center>\n";
if($gid > 0) { echo "<center><a href='".$admin_file.".php?op=NSNGroupsUsersAdd&amp;gid=$gid'>"._GR_ADDUSRS."</a></center>"; }
echo "<br />\n";
if($gid == 0) {
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsngr_users` ORDER BY `uname`,`gid`"));
} else {
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsngr_users` WHERE `gid`=$gid ORDER BY `uname`"));
}
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
echo "<center><table border='0' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2'>\n";
echo "<form method='post' action='".$admin_file.".php?op=NSNGroupsUsersExpireSave'>\n";
if($gid > 0) { echo "<input name='gid' type='hidden' value='$gid'>\n"; }
echo "<tr>\n";
echo "<td align='center'><strong>"._GR_USERNAME."</strong></td>\n";
echo "<td align='center'><strong>"._GR_GROUP."</strong></td>\n";
echo "<td align='center'><strong>"._GR_START."</strong></td>\n";
echo "<td align='center'><strong>"._GR_EXPIRES."</strong></td>\n";
if($gid > 0) { echo "<td align='center'><strong>"._GR_EXPUSR."</strong></td>\n"; }
echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n";
echo "</tr>\n";
if($gid == 0) {
  $result = $db->sql_query("SELECT `gid`, `uid`, `uname`, `sdate`, `edate` FROM `".$prefix."_nsngr_users` ORDER BY `uname`,`gid` LIMIT $min,".$grconfig['perpage']."");
} else {
  $result = $db->sql_query("SELECT `gid`, `uid`, `uname`, `sdate`, `edate` FROM `".$prefix."_nsngr_users` WHERE `gid`=$gid ORDER BY `uname` LIMIT $min,".$grconfig['perpage']."");
}
if($db->sql_numrows($result) > 0) {
  while(list($thisGroup, $thisUser, $thisName, $sDate, $eDate) = $db->sql_fetchrow($result)) {
    list($grpName, $grpMod) = $db->sql_fetchrow($db->sql_query("SELECT `gname`, `muid` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$thisGroup'"));
    $thisDate = time();
    if($eDate=="0") {
      $eDate = "<i>"._GR_NOLIMIT."</i>";
    } elseif($eDate < $thisDate) {
      $eDate = "<strong>"._GR_EXPIRED."</strong>";
    } else {
      $eDate = date("Y-m-d",$eDate);
    }
    echo "<tr bgcolor='$bgcolor1' onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\">\n";
    echo "<td align='center'>&nbsp;$thisName&nbsp;</td>\n";
    echo "<td align='center'>&nbsp;$grpName&nbsp;</td>\n";
    echo "<td align='center'>&nbsp;".date("Y-m-d",$sDate)."&nbsp;</td>\n";
    echo "<td align='center'>&nbsp;$eDate&nbsp;</td>\n";
    if($gid > 0) {
      echo "<td align='center'>";
      if($thisUser == $grpMod) {
        echo _GR_MODERATOR;
      } else {
        echo "<input name='exp_uid[]' type='checkbox' value='$thisUser'>";
      }
      echo "</td>\n";
    }
    echo "<td align='center'>&nbsp;\n";
    if($thisUser <> $grpMod) {
      echo "<a href='".$admin_file.".php?op=NSNGroupsUsersMove&amp;chng_uid=$thisUser&amp;gid=$thisGroup'><img src='images/groups/move.png' height='16' width='16' border='0' alt='"._GR_MOVE."' title='"._GR_MOVE."'></a>\n";
      if($gid == 0) { echo "<a href='".$admin_file.".php?op=NSNGroupsUsersExpire&amp;chng_uid=$thisUser&amp;gid=$thisGroup'><img src='images/groups/expire.png' height='16' width='16' border='0' alt='"._GR_EXPIRE."' title='"._GR_EXPIRE."'></a>\n"; }
      echo "<a href='".$admin_file.".php?op=NSNGroupsUsersUpdate&amp;chng_uid=$thisUser&amp;gid=$thisGroup'><img src='images/groups/edit.png' height='16' width='16' border='0' alt='"._GR_UPDATE."' title='"._GR_UPDATE."'></a>\n";
      if($gid == 0) { echo "<a href='".$admin_file.".php?op=NSNGroupsUsersDelete&amp;chng_uid=$thisUser&amp;gid=$thisGroup'><img src='images/groups/delete.png' height='16' width='16' border='0' alt='"._GR_DELETE."' title='"._GR_DELETE."'></a>\n"; }
    }
    echo "&nbsp;</td>\n";
    echo "</tr>\n";
  }
  if($gid > 0) {
    echo "<tr bgcolor='$bgcolor2'><td align='center' colspan='4'>&nbsp;</td>";
    echo "<td align='center'><input type='submit' value='"._GR_EXPUSR."'></td>";
    echo "<td>&nbsp;</td></tr>\n";
  }
} else {
  echo "<tr bgcolor='$bgcolor1'><td align='center' ";
  if($gid > 0) { echo "colspan='6'>"; } else { echo "colspan='5'>"; }
  if($gid == 0) { echo _GR_NOUSERS; } else { echo _GR_NOUSER; }
  echo "</td></tr>\n";
}
echo "</form>\n";
echo "</table></center>\n";
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
CloseTable();
include_once("footer.php");

?>
