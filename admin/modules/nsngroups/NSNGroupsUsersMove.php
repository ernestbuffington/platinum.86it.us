<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSUSERSMOVE;
include_once("header.php");
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
echo "<center><table border='0' cellpadding='0' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php?op=NSNGroupsUsersMoveSave'>\n";
echo "<input type='hidden' name='gid' value='$gid'>\n";
echo "<input type='hidden' name='uid' value='$chng_uid'>\n";
echo "<tr>\n";
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='$chng_uid'"));
echo "<td class='content' align='center'>"._GR_USRNAME.": $uname<br />\n";
list($gname) = $db->sql_fetchrow($db->sql_query("SELECT `gname` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
echo ""._GR_CURRGROUP.": $gname<br />\n";
echo ""._GR_NEWGROUP.": <SELECT NAME='new_gid'>\n";
$result3 = $db->sql_query("SELECT `gid`, `gname` FROM `".$prefix."_nsngr_groups` ORDER BY `gname`");
while(list($thisGID, $thisGNAME) = $db->sql_fetchrow($result3)) {
  if($thisGID != $gid) { echo "<option value='$thisGID'>$thisGNAME</option><br />\n"; }
}
echo "</select><br />\n";
echo "<input type='submit' value='"._GR_MOVEUSR."'></td>\n";
echo "</tr>\n";
echo "</form>\n";
echo "</table></center>\n";
CloseTable();
include_once("footer.php");

?>
