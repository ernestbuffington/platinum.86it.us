<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSVIEW;
include_once("header.php");
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$grconfig['perpage'];
if(!isset($gid)) { $gid = 0; }
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsngr_groups`"));
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
echo "<center><table border='0' cellpadding='2' cellspacing='2' bgcolor='$bgcolor2'>\n";
echo "<tr bgcolor='$bgcolor2'>\n";
echo "<td align='center' width='200'><strong>"._GR_GRPNAME."</strong></td>\n";
echo "<td align='center' width='70'><strong>"._GR_NUMUSERS."</strong></td>\n";
echo "<td align='center' width='70'><strong>"._GR_TYPE."</strong></td>\n";
echo "<td align='center' width='70'><strong>"._GR_LIMIT."</strong></td>\n";
echo "<td align='center' width='100'><strong>"._FUNCTIONS."</strong></td>\n";
echo "</tr>\n";
$result = $db->sql_query("SELECT `gid`, `gname`, `gpublic`, `glimit` FROM `".$prefix."_nsngr_groups` ORDER BY `gname` LIMIT $min,".$grconfig['perpage']."");
if($db->sql_numrows($result) > 0) {
  while(list($gid, $gname, $gpublic, $glimit) = $db->sql_fetchrow($result)) {
    echo "<tr bgcolor='$bgcolor1' onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\">\n";
    echo "<td align='center'><a href='".$admin_file.".php?op=NSNGroupsUsersView&amp;gid=$gid'>$gname</a> ($gid)</td>\n";
    $numusers = $db->sql_numrows($db->sql_query("SELECT `uid` FROM `".$prefix."_nsngr_users` WHERE `gid`='$gid'"));
    echo "<td align='center'>$numusers</td>\n";
    if($gpublic == 1) { $grtype = _GR_PUBLIC; } else { $grtype = _GR_PRIVATE; }
    echo "<td align='center'>$grtype</td>\n";
    if($glimit == 0) { $grlimit = _GR_NOLIMIT; } else { $grlimit = $glimit; }
    echo "<td align='center'>$grlimit</td>\n";
    echo "<td align='center'>\n";
    echo "<a href='".$admin_file.".php?op=NSNGroupsUsersAdd&amp;gid=$gid'><img src='images/groups/add.png' height='16' width='16' border='0' alt='"._GR_ADDUSR."' title='"._GR_ADDUSR."'></a>\n";
    echo "<a href='".$admin_file.".php?op=NSNGroupsEdit&amp;gid=$gid'><img src='images/groups/edit.png' height='16' width='16' border='0' alt='"._GR_EDIT."' title='"._GR_EDIT."'></a>\n";
    echo "<a href='".$admin_file.".php?op=NSNGroupsDelete&amp;gid=$gid'><img src='images/groups/delete.png' height='16' width='16' border='0' alt='"._GR_DELETE."' title='"._GR_DELETE."'></a>\n";
    echo "<a href='".$admin_file.".php?op=NSNGroupsEmpty&amp;gid=$gid'><img src='images/groups/empty.png' height='16' width='16' border='0' alt='"._GR_EMPTY."' title='"._GR_EMPTY."'></a>\n";
    echo "</td>\n";
    echo "</tr>\n";
  }
} else {
  echo "<tr bgcolor='$bgcolor1'><td align='center' colspan='5'>"._GR_NOGROUPS."</td></tr>\n";
}
echo "</table></center>\n";
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
CloseTable();
include_once("footer.php");

?>
