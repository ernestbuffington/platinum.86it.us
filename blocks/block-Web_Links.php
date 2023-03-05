<?php
// ######################################################################
// # PHP-Nuke                                                           #
// #====================================================================#
// #  Copyright (c) 2003 - Francisco Burzi                              #
// #  http://phpnuke.org/                                               #
// #====================================================================#
// # Paladin's block-Links_Info for PHP-Nuke 6.5                        #
// #====================================================================#
// #  Copyright (c) 2003 - Darren Poulton (paladin@intaleather.com.au)  #
// #  http://paladin.intaleather.com.au/                                #
// #====================================================================#
// #  Use of this program is goverened by the terms of the GNU General  #
// #     Public License (GPL - version 1 or 2) as published by the      #
// #           Free Software Foundation (http://www.gnu.org/)           #
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
// ######################################################################
// CONFIG - START
// ######################################################################
$latest = "LATEST";
$top = "TOP";
$links = "WEB LINKS";
$moreLink = "More Web Links";
$subLY = 1;		// <= Submit Link On?  1=Yes :: 0=No
$submitLink = "Submit Web Link";
$limit = 10;
// ######################################################################
// CONFIG - END - You shouldn't need to edit anything below this line
// ######################################################################
global $bgcolor1, $bgcolor2, $bgcolor3, $db, $prefix, $admin;
$content = "<table border=\"0\"  cellpadding=\"0\"  cellspacing=\"2\" width=\"100%\"><tr><td width=\"50%\" align=\"center\" valign=\"top\" bgcolor=\"$bgcolor2\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\">";
$content .= "<tr><td colspan=2 width=\"100%\" bgcolor=\"$bgcolor1\" align=\"center\" class=\"title\">$latest $links</td></tr><tr><td bgcolor=\"$bgcolor1\" valign=\"top\" align=\"center\" width=\"100%\">";
$content .= "<table border=\"0\" width=\"100%\">";
$color = $bgcolor3;
$sql = "SELECT lid, title, hits FROM ".$prefix."_links_links ORDER BY date DESC LIMIT 0, $limit";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
   	$title2 = preg_replace("/_/", " ", $row[title]);
    if ($color == $bgcolor3) { $color = $bgcolor1; } else { $color = $bgcolor3; }
   	$content .= "<tr><td bgcolor=\"$color\" align=\"left\"><a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$row[lid]&amp;ttitle=$row[title]\">$title2</a></td>";
   	$content .= "<td bgcolor=\"$color\" align=\"center\" width=\"20\">$row[hits]</td></tr>";
}
$content .= "</table></td></tr></table></td><td width=\"50%\" align=\"center\" valign=\"top\" bgcolor=\"$bgcolor2\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\">";

$content .= "<tr><td colspan=\"2\" width=\"100%\" bgcolor=\"$bgcolor1\" align=\"center\" class=\"title\">$top $limit $links</td></tr><tr><td bgcolor=\"$bgcolor1\" valign=\"top\" align=\"center\" width=\"100%\">";
$content .= "<table border=\"0\" width=\"100%\">";
$color = $bgcolor3;
$sql = "SELECT lid, title, hits FROM ".$prefix."_links_links ORDER BY hits DESC LIMIT 0, $limit";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
   	$title2 = preg_replace("/_/", " ", $row[title]);
    if ($color == $bgcolor3) { $color = $bgcolor1; } else { $color = $bgcolor3; }
   	$content .= "<tr><td bgcolor=\"$color\" align=\"left\"><a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$row[lid]&amp;ttitle=$row[title]\">$title2</a></td>";
   	$content .= "<td bgcolor=\"$color\" align=\"center\" width=\"20\">$row[hits]</td></tr>";
}
$content .= "</table></td></tr></table></td></tr></table>";
$content .= "<center>|[ <a href=\"modules.php?name=Web_Links\">$moreLink</a> ]";
if ($subLY == 1) { $content .= "|[ <a href=\"modules.php?name=Web_Links&amp;l_op=AddLink\">$submitLink</a> ]"; }
$content .= "|</center>";
?>
