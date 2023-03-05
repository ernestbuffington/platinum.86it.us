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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db, $query;
define("_ADDDOWNLOAD","Add Download");
define("_NEWEST","Newest");
define("_HOTTEST","Hottest");
$content = "<center><form action=\"modules.php?name=PrivateDownloads&amp;d_op=search&amp;query=$query\" method=\"post\" style=\"margin-bottom: 0px;\">";
$content .= "<font class=\"content\"><input type=\"text\" size=\"9\" name=\"query\" /> <input type=\"submit\" value=\""._SEARCH."\" /></font></form>";
$content .= "<strong>"._NEWEST.":</strong></center>";
$sql = "SELECT lid, title, date, hits FROM ".$prefix."_nsngd_downloads ORDER BY date DESC LIMIT 0,10";
$result = $db->sql_query($sql);
for ($a = 1; $row = $db->sql_fetchrow($result); $a++) {
    $title2 = preg_replace("/_/", " ", $row[title]);
    $content .= "<small>$a: </small><a href=\"modules.php?name=PrivateDownloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a><small>&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: #BBBBBB;\">[Hits: $row[hits]]</span></small><br />";
}
$content .= "<small>-> </small><a href=\"modules.php?name=PrivateDownloads&amp;d_op=AddDownload\">"._ADDDOWNLOAD."</a><br />";
$content .= "<br /><center><strong>"._HOTTEST.":</strong></center>";
$sql = "SELECT lid, title, hits FROM ".$prefix."_nsngd_downloads ORDER BY hits DESC LIMIT 0,10";
$result = $db->sql_query($sql);
for ($a = 1; $row = $db->sql_fetchrow($result); $a++) {
    $title2 = preg_replace("/_/", " ", $row[title]);
    $content .= "<small>$a: </small><a href=\"modules.php?name=PrivateDownloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a><small>&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: #BBBBBB;\">[Hits: $row[hits]]</span></small><br />";
}
?>
