<?php
/********************************************************/
/* NSN GR Downloads                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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
if (stristr($_SERVER['SCRIPT_NAME'], "block-NSNGD_Hot.php")) {
    Header("Location: ../index.php");
    die();
}
global $prefix, $db;
$blkh = 20; // Number of lines high
$blkw = 20; // Number of characters wide 0 = unused
$scron = 0; // Turn scrolling on by setting to 1
$scrdr = up; // Scroll direction (up, down, left, or right)
$scrhg = 400; // Scroller height in pixels
$scrwd = 200; // Scroller width in pixels
$a = 1;
if ($scron == 1) {
    $content .= "<marquee behavior='scroll' direction='$scrdr' height='$scrhg' width='$scrwd' scrollamount='2' scrolldelay='100' onMouseOver='this.stop()' onMouseOut='this.start()'><br />";
}
$result = $db->sql_query("select lid, title from $prefix"._nsngd_downloads." order by hits DESC limit 0,$blkh");
while(list($lid, $title) = $db->sql_fetchrow($result)) {
    $title2 = preg_replace("/_/", " ", $title);
    $title = strtr($title, " ()", "_[]");
    if ($blkw > 0) { if (strlen($title2) > $blkw) { $title2 = substr($title2, 0, $blkw); } }
    if ($a < 10) { $content .= "0$a: "; } else { $content .= "$a: "; }
    $content .= "<a href='modules.php?name=PrivateDownloads&amp;op=getit&amp;lid=$lid'>$title2</a><br />";
    $a++;
}
if ($scron == 1) {
	$content .= "</marquee>";
}
?>
