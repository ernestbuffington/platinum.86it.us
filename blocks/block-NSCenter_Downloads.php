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
//variables
// Number of downloads shown in the block
$downloadstoshow = 10;
$most            .= ""._NSMOST."";
$latest          .= ""._NSLATEST."";
$totalfiles      .= ""._NSTOTALFILES."";
$totalcategories .= ""._NSTOTALCATS."";
$totaldownloads  .= ""._NSTOTALDOWN."";
$hitstext        .= ""._NSHITS."";
$datasent        .= ""._NSSENT."";
$featured        .= ""._NSFEATURED."";
$recent		 .= ""._NSRECENT."";
$popular         .= ""._NSPOPULAR."";
$summary         .= ""._NSSUMMARY."";
//end of variables
// Make sure people don't try and access it directly
if (preg_match("/block-NSCenter_Downloads.php/",$PHP_SELF)) {
    Header("Location: ../modules/Downloads/index.php");
    die();
}
global $prefix, $dbi, $useflags, $currentlang;
$content .= "<br />&nbsp;$totalfiles: <strong>$files</strong><br />&nbsp;$totalcategories: <strong>$cats</strong><br />&nbsp;$totaldownloads: <strong>$total_hits</strong><br />&nbsp;"._NSSENT.":&nbsp;<strong>$mysizes</strong><br /><br />";
$content  =  "<table width=\"100%\"  border=\"0\" cellspacing=\"3\" cellpadding=\"0\">";
$content  .= "  <tr>";
$content  .= "    <td>";// Latest added
if ($useimages == 1) {
  $content .= "<center><br /><img src=\"images/$image_color/newest1.gif\"><br /></center><br />";
}
else {
  $content .= "<br /><left><u><strong>$recent:</strong></u></left><br />";
}
$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by date DESC limit 0,$downloadstoshow", $dbi);
while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
		$title2 = preg_replace("/_/", " ", $title);
	  $content .= "$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;cid=$cid&amp;lid=$lid&amp;title=$title#dldetails\">$title2</a>&nbsp;[$hitstext: $hits]<br />";
		$a++;
}
$content  .="</td>";
$content  .= "    <td>";// Most downloaded
if ($useimages == 1) {
  $content .= "<center><br /><img src=\"images/$image_color/popular1.gif\"><br /></center><br />";
}
else {
  $content .= "<br /><left><u><strong>$popular:</strong></u></left><br />";
}
$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by hits DESC limit 0,$downloadstoshow", $dbi);
while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
    $title2 = preg_replace("/_/", " ", $title);
    $content .= "$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;cid=$cid&amp;lid=$lid&amp;title=$title#dldetails\">$title2</a>&nbsp;[$hitstext: $hits]<br />";
    $a++;
}
$content  .="</td>";
$content  .= "  </tr>";
$content  .= "</table>";
?>
