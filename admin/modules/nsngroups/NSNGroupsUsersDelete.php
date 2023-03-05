<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN." ".$grconfig['version_number'].": "._GR_GROUPSUSERSDELETE;
include_once("header.php");
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
list($gname) = $db->sql_fetchrow($db->sql_query("SELECT `gname` FROM `".$prefix."_nsngr_groups` WHERE `gid`='$gid'"));
echo "<center>"._GR_DELUSER." $chng_uid "._GR_FROM." #".$gid." (".$gname.")?</center><br />";
echo "<center>[ <a href='".$admin_file.".php?op=NSNGroupsUsersDeleteConf&amp;gid=$gid&amp;uid=$chng_uid'>"._GR_YES."</a> | <a href='".$admin_file.".php?op=NSNGroupsView&amp;gid=$gid'>"._GR_NO."</a> ]</center>";
CloseTable();
include_once("footer.php");

?>
