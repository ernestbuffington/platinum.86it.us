<?
######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This file contains common functions used NukeC30 administration
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                    */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


foreach ($_GET as $secvalue) {
    if (preg_match("#<[^>]*script*\"?[^>]*>#i", $secvalue)) {
	die ("I don't like you...");
    }
}

if (preg_match("#functions.php#i",$PHP_SELF)) {
    Header("Location: admin.php");
    die();
}
$nukecprefix = "NukeC30";

function NukeCAdminDone($msgid) {
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	
	echo "<center><font class=\"title\">";
	switch($msgid) {
		case "PreferencesSaved": echo _NUKECMSGPREFSAVED; break;
		case "NewCatgDone": echo _NUKECMSGCATGADDED; break;
		case "WaitingAdsDeleted": echo _NUKECWAITINGADSDELETED;break;
		case "WaitingAdsPosted": echo _NUKECWAITINGADSPOSTED;break;
		case "AdsDeleted": echo _NUKECADSDELETEDSUCC;break;
		case "EditDone": echo _NUKECADSUPDATED;break;
		case "CommentDeleted": echo _NUKECCOMMENTDELETED;break;
	}
	echo "</font></center>";
	CloseTable();
	include_once("footer.php");
}


function NukeCAdminMenu(){
	OpenTable();
	$a = "<strong><big><strong>&middot;</strong></big></strong>";
	echo "<center><font class=\"title\"><a href=\"admin.php?op=NukeC30\"><strong>"._NUKECADMINTITLE."</strong></a></font></center><br />\n";
	echo "<table cellpadding=\"2\" cellspacing=\"2\" align=\"center\">
		<tr>
		<td >$a <a href=\"admin.php?op=NukeC30AdminCatg\"> "._NUKECADMINCATG."</a></td>
		<td>$a <a href=\"admin.php?op=NukeC30AdminWaiting\"> "._NUKECADMINWAITING."</a></td>
		<td>$a <a href=\"admin.php?op=NukeC30Setting\"> "._NUKECSETTING."</a></td>
		</tr>
		<tr>
		<td>$a <a href=\"admin.php?op=NukeC30currency\"> "._NUKECADMINCURR."</a></td>
		<td>$a <a href=\"admin.php?op=NukeC30Disclaimer\"> "._NUKECADMINDISCLAIM."</a></td>
		<td>$a <a href=\"admin.php?op=NukeC30CustomContent\"> Custom Content</a></td>
		</tr>
		
		</table>";
	CloseTable();
}




?>
