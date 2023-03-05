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
/********************************************************
/* NSN GR Downloads Modified to work with Platinum Nuke Pro Private Downloads
/* By: NukeScripts Network (webmaster@nukescripts.net)
/* http://www.nukescripts.net
/* Copyright © 2000-2004 by NukeScripts Network
/********************************************************/
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db;
$blkh = 10; // Number of lines high
$blkw = 20; // Number of characters wide 0 = unused
$scron = 1; // Turn scrolling on by setting to 1
$scrdr = up; // Scroll direction (up, down, left, or right)
$scrhg = 200; // Scroller height in pixels
$scrwd = 170; // Scroller width in pixels
$speed = 2; // Speed Of Scroll
$most = "Top Downloads";
$latest = "Newest Downloads";
$totalfiles = "Total Files";
$totalcategories = "Total Categories";
$totaldownloads = "Total Downloads";
$totalserved = "Total Served";
// Total Files
$result = $db->sql_query("select * from ".$prefix."_nsngd_downloads");
$files = sql_num_rows($result);
// Total Categories
$result = $db->sql_query("select * from ".$prefix."_nsngd_categories");
$cats = sql_num_rows($result);
// Total Downloads
$result = $db->sql_query("select hits from ".$prefix."_nsngd_downloads");
$a = 1;
while(list($hits) = $db->sql_fetchrow($result)) {
	  $total_hits = $total_hits + $hits;
		$a++;
}
$result=sql_query("select lid, hits from $prefix"._nsngd_downloads." order by lid");
$dresult=0;
while(list($lid, $hits) = $db->sql_fetchrow($result)) {
	$dresult = $dresult + $hits;
}
$result = $db->sql_query("select * from $prefix"._nsngd_downloads."");
$numrows = sql_num_rows($result);
$result = $db->sql_query("select sum(filesize*hits) as serv from $prefix"._nsngd_downloads."");
while(list($serv) = $db->sql_fetchrow($result)) {
	$served = $serv;
}
$tb = 1024*1024*1024*1024;
$gb = 1024*1024*1024;
$mb = 1024*1024;
$kb = 1024;
if ($served >= $tb){
	$mysizes = sprintf ("%01.2f",$served/$tb) . " TB ";
} elseif ($served >= $gb) {
	$mysizes = sprintf ("%01.2f",$served/$mb) . " GB ";
} elseif ($served >= $mb) {
	$mysizes = sprintf ("%01.2f",$served/$mb) . " MB ";
} elseif ($served >= $kb) {
	$mysizes = sprintf ("%01.2f",$served/$kb) . " KB ";
} else{
	$mysizes = $served . " B ";
}
$content .= "$totalfiles: $files<br>$totalcategories: $cats<br> $totaldownloads: $total_hits<br> $totalserved: $mysizes<br>";
if ($scron == 1) {
    $content .= "<marquee behavior='scroll' direction='$scrdr' height='$scrhg' width='$scrwd' scrollamount='$speed' scrolldelay='100' onMouseOver='this.stop()' onMouseOut='this.start()'><br>";
}
//Latest Downloads
$content .= "<strong>".$latest."</strong><br>";
$a = 1;
$result = $db->sql_query("select lid, title, hits from $prefix"._nsngd_downloads." order by date DESC limit 0,$blkh");
while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
    $title2 = preg_replace("/_/", " ", $title);
    $title = strtr($title, " ()", "_[]");
    if ($blkw > 0) { if (strlen($title2) > $blkw) { $title2 = substr($title2, 0, $blkw); } }
    if ($a < 10) { $content .= "0$a: "; } else { $content .= "$a: "; }
    $content .= "<a href='modules.php?name=PrivateDownloads&amp;op=getit&amp;lid=$lid'>$title2</a><br>[Hits:&nbsp;$hits]<br>";
    $a++;
}
//Top Downloads
$content .= "<br><strong>".$most."</strong><br>";
$a = 1;
$result = $db->sql_query("select lid, title, hits from $prefix"._nsngd_downloads." order by hits DESC limit 0,$blkh");
while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
    $title2 = preg_replace("/_/", " ", $title);
    $title = strtr($title, " ()", "_[]");
    if ($blkw > 0) { if (strlen($title2) > $blkw) { $title2 = substr($title2, 0, $blkw); } }
    if ($a < 10) { $content .= "0$a: "; } else { $content .= "$a: "; }
    $content .= "<a href='modules.php?name=PrivateDownloads&amp;op=getit&amp;lid=$lid'>$title2</a><br>[Hits:&nbsp;$hits]<br>";
    $a++;
}
if ($scron == 1) {
	$content .= "</marquee>";
}
?>
