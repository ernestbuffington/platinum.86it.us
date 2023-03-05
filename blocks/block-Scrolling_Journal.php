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
/////////////////////////////////////////////////////////////////////
//                                                                 //
// block-Scrolling_Journal.php for the php-nuke content management //
// system                                                          //
// Copyright © 2005 by NukeCode.com                                //
// admin at nukecode.com                                           //
// You may redistribute this block as long as this message stays   //
// intact                                                          //
// Modified for 7.6.b.2 by Loki  http://www.nukeplanet.com         //
/////////////////////////////////////////////////////////////////////
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $multilingual, $currentlang, $db;
if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = "";
}
$content .= "<Marquee Behavior=\"Scroll\" Direction=\"Up\" Height=\"140\" ScrollAmount=\"2\" ScrollDelay=\"5\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\"><br />";
$sql = "SELECT jid, aid, title FROM ".$prefix."_journal $querylang ORDER BY jid DESC LIMIT 0,5";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $jid = $row['jid'];
    $aid = $row['aid'];
    $title = $row[title];
    $comtotal = $row[comments];
    $counter = $row[counter];
    $content .= "<a href=\"modules.php?name=Journal&file=display&jid=$jid\">$title</a><br />Author:&nbsp;<i>($aid)</i>";
}
$content .= "</marquee>";
$content .= "<br /><center>[ <a href=\"modules.php?name=Journal\">More Journals</a> ]</center>";
?>
