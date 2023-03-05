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

if(($brokenV == 1) && ($looker == "Anonymous")) {
	OpenTable();
	echo ""._REGBROKEN."";
	CloseTable();
} else {
	if($_POST['Submit']) {
		OpenTable();
		$usernameb = $_POST['username'];
		$user_emailb = $_POST['user_email'];
		$result = $db->sql_query("INSERT INTO ".$prefix."_video_stream_broken (username, email, brokenvidid) VALUES('$usernameb', '$user_emailb', '$id') ");
		echo "<div align=\"center\"><FONT class=title>".$sitename." "._VIDEOCOLECTION."</FONT></div><br />";
		echo ""._BROKENNOTICE."";
		echo " >><a href=\"modules.php?name=Video_Stream\">"._BACK."</a>";
		CloseTable();
	} else {
		$cookie[0] = intval($cookie[0]);
		if ($cookie[1] != "") {
			$row = $db->sql_fetchrow($db->sql_query("SELECT name, username, user_email FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
			if ($row['name'] != "") {
				$sender_name = $row['name'];
			} else {
				$sender_name = $row['username'];
			}
			$sender_email = $row['user_email'];
		}
			
		OpenTable();
		$vidname = str_replace('-', ' ', $vidname);
		echo "<div align=\"center\"><FONT class=title>".$sitename." "._VIDEOCOLECTION."</FONT></div><br />";
		echo ""._REPORTP1." ".$vidname." "._REPORTP2."";
		echo "<form name=\"form1\" method=\"post\" action=\"modules.php?name=Video_Stream&amp;page=broken&amp;id=".$id."\">";
		echo "<table width=\"144\" border=\"0\" align=\"center\"><tr><td><div align=\"left\">"._USERNAME.":</div></td>";
		echo "</tr><tr><td><div align=\"left\"><input name=\"username\" type=\"text\" value=\"".$sender_name."\"></div></td></tr><tr>";
		echo "<td><div align=\"left\">"._EMAIL.":</div></td></tr><tr><td><div align=\"left\"><input name=\"user_email\" type=\"text\" value=\"".$sender_email."\">";
		echo "</div></td></tr><tr><td><div align=\"left\"></div></td></tr><tr><td><div align=\"center\"><input type=\"submit\" name=\"Submit\" value=\""._SUBMIT."\">";
		echo "</div></td></tr></table></form>";
		CloseTable();	
	}
}
include_once('footer.php');
?>