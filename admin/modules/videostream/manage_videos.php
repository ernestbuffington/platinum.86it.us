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
LinkAdmin();
VideoStreamMenu();

// Set vids per page limit
if($_POST['saveset']) {
	$limit = "".$_POST['limitvids']."";
	$result = $db->sql_query("UPDATE ".$prefix."_video_stream_settings SET limitvids=$limit WHERE id=1");
}
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$row = $db->sql_fetchrow($result);
$limit = $row['limitvids'];

if ($d == "") {
	$d = 0;
}
OpenTable();
$d *= $limit;
$getlimit = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY id DESC LIMIT $d,$limit");
$row10 = $db->sql_numrows($getlimit);
@$d /= $limit;
$getall = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0");
$rowall = $db->sql_numrows($getall);

// If videos are in the DB then they are displayed in a table.
if ($row10 != "0") {
	echo "<table width=\"100%\"  border=\"1\" cellspacing=\"0\" cellpadding=\"3\"><tr><td width=\"100%\"><strong>"._TITLE."</strong></td><td nowrap><strong>"._POSTEDON."</strong></td><td nowrap><strong>"._POSTEDBY."</strong></td><td nowrap><strong>"._VIEWS."</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
	while($row10 = $db->sql_fetchrow($getlimit)) {
		$deletevidloc = "".$admin_file.".php?op=video_stream&amp;Submit=deletevid&amp;id=".$row10['id']."&amp;d=$d&amp;loc=manage";
		echo "<tr>";
		echo "<td nowrap><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row10['id']."\">".$row10['vidname']."</a></td>";
		echo "<td nowrap>".$row10['date']."</td>";
		echo "<td nowrap>".$row10['user']."</td>";
		echo "<td nowrap>".$row10['views']."</td>";
		echo "<td nowrap><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row10['id']."\">"._VVIEW."</a></td>";
		echo "<td nowrap><a href=\"".$admin_file.".php?op=video_stream&amp;Submit=editvid&amp;id=".$row10['id']."\">"._EDIT."</a></td>";
		echo "<td nowrap><a href=\"javascript:disp_confirm('$deletevidloc', '"._DELETEVIDCOMFIRM."')\">"._DELETE."</a></td>";
		echo "</tr>";
	}
	echo "</table>";

	$pages   = ceil($rowall / $limit);
	$current = $d + 1;

echo "<br /><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"30%\">";

if ($d >= 1) {
	$p = $d - 1;
	echo "<div align=\"left\"><a href=\"".$admin_file.".php?op=video_stream&amp;d=".$p."\">"._PREVIOUS."</a></div>";
} else {
	echo "&nbsp;";
}

echo "</td><td width=\"40%\"><div align=\"center\">"._PAGE." ".$current."/".$pages."</div></tr><td width=\"30%\">";

if ($current < $pages) {
	$d += 1;
	echo "<div align=\"right\"><a href=\"".$admin_file.".php?op=video_stream&amp;d=".$d."\">"._NEXT."</a></div>";
} else {
	echo "&nbsp;";
}

echo "</td></tr></table>";
} else {
	// If no videos have been added then user is told no videos
	echo "<center>"._NOVIDSINDB."</center>";
}
echo "<br /><br /><center><strong>"._VIDSPERPAGE."</strong><form name=\"form1\" method=\"post\" action=\"\">
	  <input name=\"limitvids\" type=\"text\" size=\"3\" value=\"".$limit."\" />
	  <input type=\"submit\" name=\"saveset\" value=\""._CHANGE."\" />
	  </form></center>";

CloseTable();
echo "<br />";
// YOU MAY NOT REMOVE, EDIT, OR MARK OUT THE FOLLOWING PAYPAL CODE. IT IS PART OF OUR COPYRIGHT.
PayPalDonate();
// END OF COPYRIGHT.
echo "<br />";
VersionChecker();
?>