<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

function LinkAdmin() {
	global $admin_file;
	if ($admin_file == '') { $admin_file = 'admin'; }
	OpenTable();
	echo "<center><a href=\"".$admin_file.".php\"><span class=\"title\">"._ADMINMENU."</span></a></center>";
	CloseTable();
	echo "<br />";
}

function VideoStreamMenu() {
	global $admin_file, $db, $prefix;
	if ($admin_file == '') { $admin_file = 'admin'; }
	$broken = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_broken");
	$request = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=1");
	$brokenrows = $db->sql_numrows($broken);
	$requestrows = $db->sql_numrows($request);
	OpenTable();
	echo "<div align=\"center\" class=\"title\">"._VIDEOADMIN."</div><br />";
	echo "<table cellpadding=\"0\" cellspacing=\"10\" border=\"0\" align=\"center\"><tr>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream\">"._MANAGEVIDS."</a></strong></td>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=addvid\">"._ADDVIDS."</a></strong></td>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=category\">"._MANAGECATEGORIES."</a></strong></td>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=Psettings\">"._PERMISSIONVIDS."</a></strong></td>";
	echo "</tr></table><table cellpadding=\"0\" cellspacing=\"10\" border=\"0\" align=\"center\"><tr>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=settings\">"._SETTINGSVIDS."</a></strong></td>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=broken\">".$brokenrows." "._BROKENVIDS."</a></strong></td>";
	echo "<td nowrap><strong><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=request\">".$requestrows." "._REQUESTSVIDS."</a></strong></td>";
	echo "</tr></table>";
	CloseTable();
	echo "<br />";
}

function VersionChecker() {
	global $db, $prefix;
	$version = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings");
	$ver = $db->sql_fetchrow($version);
	OpenTable();
	?>
	<script language="JavaScript" type="text/JavaScript">var loaded = false;</script>
	<script language="JavaScript" type="text/JavaScript" src="http://PHPNuke-Downloads.com/modules/Version_Checker/checker.php?script=VS&version=<?php echo "".$ver['version'].""; ?>"></script>
	<script language="JavaScript" type="text/JavaScript">
	if(!loaded) {
		document.write('<center><strong>Video Stream Version <?php echo "".$ver['version'].""; ?></strong><br /><br />Sorry but the version checker is offline</center>');
	}
	</script>
	<?php
	CloseTable();
}

function getparent($parentid,$title) {
	global $prefix, $db;
	$parentid = intval(trim($parentid));
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories where id='$parentid'"));
	$cid = intval($row['id']);
	$ptitle = $row['name'];
	$pparentid = $row['parent'];
	if ($ptitle == "$title") $title=$title;
	elseif ($ptitle != "") $title=$ptitle."/".$title;
	if ($pparentid != 0) {
		$title = getparent($pparentid,$title);
	}
	return $title;
}

// YOU MAY NOT REMOVE, EDIT, OR MARK OUT THE FOLLOWING PAYPAL CODE. IT IS PART OF OUR COPYRIGHT.
function PayPalDonate() {
	OpenTable();
	echo "<center><span class=\"title\">PHPNuke-Downloads needs your support!</span><br /><br />Open Source software costs money and time to develop.<br /><br />";
	echo "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">";
	echo "<input type=\"hidden\" name=\"business\" value=\"scottyhotty@supanet.com\">";
	echo "<input type=\"hidden\" name=\"item_name\" value=\"Donation\">";
	echo "<input type=\"hidden\" name=\"item_number\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"return\" value=\"http://PHPNuke-Downloads.com\">";
	echo "<input type=\"hidden\" name=\"no_note\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"currency_code\" value=\"USD\">";
	echo "<input type=\"hidden\" name=\"tax\" value=\"0\">";
	echo "<input type=\"hidden\" name=\"bn\" value=\"PP-DonationsBF\">";
	echo "<input type=\"image\" src=\"https://www.paypal.com/en_US/i/btn/x-click-but04.gif\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">";
	echo "</form>";
	echo "Our community appreciates your monitary support!";
	echo "<br /><br />Released under the GNU/GPL license and distributed by steezmatic-designs.com.<br />";
	echo "Copyright © 2005-2006 by PHPNuke-Downloads. All rights reserved.";
	CloseTable();
}
// END OF COPYRIGHT.
?>