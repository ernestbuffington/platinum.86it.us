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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}

include_once('header.php');
include_once('modules/Video_Stream/javascript.php');
echo "<link href=\"modules/Video_Stream/css.css\" rel=\"stylesheet\" type=\"text/css\">\n";
vsnavtop();
OpenTable();
sortandsearch();
echo "<br /><hr><br />\n";

if (($d == "") || ($d == 0)) {
	$d = 1;
}
$sqld = $d - 1;
$sqld *= $limit;
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream ".$sortby2." ".$sortby1." LIMIT $sqld,$limit");
$rowvid = $db->sql_numrows($result);
$result2 = $db->sql_query("SELECT * FROM ".$prefix."_video_stream ".$sortby2." ".$sortby1."");
$rowvid2 = $db->sql_numrows($result2);

// If videos are in the DB then they are displayed.
if ($rowvid != "0") {

	while($row = $db->sql_fetchrow($result)) {
		$userav = $row['user'];
		if ($row['rating'] == "") {$rating = "0";} else {$rating = $row['rating'];}
		$id = $row['id'];
		$image = $row['imgurl'];
		$plugin = $row['flash'];
		$vidname = $row['vidname'];
		echo "<table width=\"100%\"  border=\"0\" cellspacing=\"5\" cellpadding=\"5\">\n";
		echo "  <tr>\n";
		echo "    <td>\n";
		avatars($userav);	
		echo "    </td>\n";
		echo "    <td width=\"100%\"><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."&amp;d=".$d."\">".$row['vidname']."</a><br /><strong>".$row['date']."</strong><br />".$row['user']." <a href=\"modules.php?name=Video_Stream&amp;page=search&amp;search=user:".$row['user']."\">["._MOREFROMUSER."]</a></td>\n";
		echo "  </tr>\n";
		echo "</table>\n";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"5\" cellpadding=\"5\">\n";
		echo "  <tr>\n";
		echo "    <td width=\"100%\" valign=\"top\">".$row['description']."</td>\n";
		echo "    <td align=\"center\" valign=\"top\">\n";
		category($id);
		echo "    </td>\n";
		echo "  </tr>\n";
		echo "</table>\n";
		echo "<table width=\"100%\"  border=\"0\" cellspacing=\"5\" cellpadding=\"5\">\n";
		echo "  <tr>\n";
		echo "    <td>\n";
		echo "      <table border=\"4\" cellspacing=\"0\" cellpadding=\"0\">\n";
		echo "        <tr>\n";
		videoimageplugin($id, $image, $plugin, $d, $vidname);
		echo "        </tr>\n";
		echo "      </table>\n";
		echo "    </td>\n";
		echo "    <td width=\"100%\"><strong>"._VIEWS.":</strong> ".$row['views']."</td>\n";
		echo "  </tr>\n";
		echo "</table><br /><hr><br />\n";
	}

	$pages   = ceil($rowvid2 / $limit);
	
	echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "  <tr>\n";
	echo "    <td width=\"30%\">\n";
	
	if ($d > 1) {
		$p = $d - 1;
		echo "      <div align=\"left\"><a href=\"modules.php?name=Video_Stream&amp;d=".$p."\">"._PREVIOUS."</a></div>\n";
	} else {
		echo "      &nbsp;\n";
	}

	echo "    </td>\n";
	echo "    <td width=\"40%\"><div align=\"center\">\n";
	pagesnav($d, $pages);
	echo "      <br />"._PAGE." ".$d."/".$pages."</div>\n";
	echo "    </td>\n";
	echo "    <td width=\"30%\">\n";

	if ($d < $pages) {
		$d += 1;
		echo "      <div align=\"right\"><a href=\"modules.php?name=Video_Stream&amp;d=".$d."\">"._NEXT."</a></div>\n";
	} else {
		echo "      &nbsp;\n";
	}

	
	echo "    </td>\n";
	echo "  </tr>\n";
	echo "</table>\n";
	
} else {

	// If no videos have been added then user is told no videos
	echo "<center>"._NOVIDSINDB."</center>\n";
}

CloseTable();
echo "<br />\n";
stats();

echo "<br />\n";
OpenTable();
echo "HTTP Video Stream Module<br />By <a href=\"http://phpnukedownloads.com\" title=\"PHP-Nuke\">phpNuke</a>\n";
CloseTable();
// END OF COPYRIGHT

include_once('footer.php');
?>