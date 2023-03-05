<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$gid = intval($gid);
include_once('header.php');
$result = $db->sql_query('SELECT `glimit`, `gpublic`, `phpBB` FROM `'.$prefix.'_nsngr_groups` WHERE `gid`='.$gid);
list($glimit, $gpublic, $phpBB) = $db->sql_fetchrow($result);
$numusers = $db->sql_numrows($db->sql_query('SELECT `uid` FROM `'.$prefix.'_nsngr_users` WHERE `gid`='.$gid));
cookiedecode($user);
$uid = $cookie[0];
$uname = $cookie[1];
title(_GR_GROUPJOIN);
OpenTable();
if(is_ingroup($uid,$gid)) {
	echo '<center><strong>'._GR_INGROUP.'</strong></center><br />'."\n";
	echo '<center>'._GOBACK.'</center>'."\n";
} elseif($gpublic == 0) {
	echo '<center><strong>'._GR_NOTPUBLIC.'</strong></center><br />'."\n";
	echo '<center>'._GOBACK.'</center>'."\n";
} elseif($glimit <= $numusers AND $glimit != 0) {
	echo '<center><strong>'._GR_GROUPFILLED.'</strong></center><br />'."\n";
	echo '<center>'._GOBACK.'</center>'."\n";
} elseif($uid > 0) {
	$xdate = time();
	$db->sql_query('INSERT INTO `'.$prefix.'_nsngr_users` (`gid`, `uid`, `uname`, `sdate`) VALUES ('.$gid.', '.$uid.', \''.$uname.'\', \''.$xdate.'\')');
	$db->sql_query('INSERT INTO `'.$prefix.'_bbuser_group` (`group_id`, `user_id`) VALUES (\''.$phpBB.'\', \''.$uid.'\')');
	echo '<center><strong>'._GR_ADDGROUP.'</strong></center><br />'."\n";
	echo '<center>'._GOBACK.'</center>'."\n";
} else {
	echo '<center><strong>'._GR_MUSTBEUSER.'</strong></center><br />'."\n";
	echo '<center>'._GOBACK.'</center>'."\n";
}
CloseTable();
include_once('footer.php');

?>