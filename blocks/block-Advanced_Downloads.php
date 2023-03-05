<?php
/************************************************************************/
/* Advanced Downloads Block                                             */
/* ===========================                                          */
/*                                                                      */
/* This is basically just an edit of the original block by Francisco.   */
/* Even though this is heavly edited, I think he deserves credit, so:   */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
/*                                                                      */
/* Copyright © 2002 by Michael Bacoz                                    */
/* http://www.fatal-instinct.com                                        */
/*                                                                      */
/* For more information read the readme.txt file in this package.       */
/*                                                                      */
/* Tweaked further for use with NukeStyles EDL V1.4 - V1.6              */
/* (c)Copyright Shawn Archer - NukeStyles.com                           */
/*                                                                      */
/* Modified for EDL 2.1 by Robert Hamberger                             */
/* http://prian.dyndns.org                                              */
/************************************************************************/
/************************/
/*      Variables       */
/************************/
// Number of downloads shown in the block
$downloadstoshow = 10;
// Should the list in the block scroll?
// 1 = yes, 0 = no
$usemarquee = 0;
// Scroll direction of the list (only if $usemarquee = 1)
// Options: up, down, left, right
$scrolldirection = "up";
// Use images or only text for "Recently Added", ...?
// 1 = yes, 0 = no
$useimages = 0;
// Color Setting (only if $useimages = 1)
// Options: grey, black, blue
$image_color = "blue"; 
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
/************************/
/*     End Variables    */
/************************/
// Make sure people don't try and access it directly
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $dbi, $useflags, $currentlang;
// Total Files
$result = sql_query("select * from ".$prefix."_downloads_downloads", $dbi);
$files = sql_num_rows($result, $dbi);
// Total Categories
$result = sql_query("select * from ".$prefix."_downloads_categories", $dbi);
$cats = sql_num_rows($result, $dbi);
// Total Downloads
$result = sql_query("select lid, title, hits from ".$prefix."_downloads_downloads", $dbi);
while(list($lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
   $title2 = preg_replace("/_/", " ", $title);
$a = 1;
$total_hits = $total_hits + $hits;
$a++;
}
$result=sql_query("select * from $prefix"._downloads_downloads."", $dbi);
    $numrows = sql_num_rows($result, $dbi);
    $result=sql_query("select sum(filesize*hits) as serv from $prefix"._downloads_downloads."", $dbi);
    while(list($serv) = sql_fetch_row($result, $dbi)) {
        $served = $serv;
    }
    $gb = 1024*1024*1024;
    $mb = 1024*1024;
    $kb = 1024;
    if ($served >= $gb){
        $mysizes = sprintf ("%01.2f",$served/$gb) . " Gb ";
    } elseif ($served >= $mb) {
        $mysizes = sprintf ("%01.2f",$served/$mb) . " Mb ";
    } elseif ($served >= $kb) {
        $mysizes = sprintf ("%01.2f",$served/$kb) . " Kb ";
    } else{
        $mysizes = $served . " B ";
    }
// Latest
// not yet implemented
// Most
// not yet implemented
if ($useimages == 1) {
// no image available
}
else {
$content .= "<br /><center><u><strong>$summary</strong></u></center>";
}
$content .= "<br />&nbsp;$totalfiles: <strong>$files</strong><br />&nbsp;$totalcategories: <strong>$cats</strong><br />&nbsp;$totaldownloads: <strong>$total_hits</strong><br />&nbsp;"._NSSENT.":&nbsp;<strong>$mysizes</strong><br /><br />";
if ($usemarquee == 1) {
	$content .= "<marquee behavior='scroll' direction='$scrolldirection' scrollamount='2' scrolldelay='100' onmouseover='this.stop()' onmouseout='this.start()'><br />";
}
// Featured Downloads
$a = 1;
$result_num = sql_query("select fdid from ".$prefix."_ns_downloads_nfeatured", $dbi);
$num_feat = sql_num_rows($result_num, $dbi);
if ($num_feat > 0) {
        $result_fl = sql_query("select fdid, lid from ".$prefix."_ns_downloads_nfeatured order by lid", $dbi);
        while(list($fdid, $lid) = sql_fetch_row( $result_fl, $dbi)) {
// we have to look that the featured download is not disabled
                $result_dl = sql_query("select cid, title from ".$prefix."_downloads_downloads where lid='$lid' and ns_disable='0'", $dbi);
// only the first loop will write the title ;-)
                if ($a == 1) {
                  if ($useimages == 1) {
                    $content .= "<center><br><img src=\"images/$image_color/featured1.gif\"><br></center><br>";
                  }
                  else {
                    $content .= "<br><center><u><strong>$featured</strong></u></center><br>";
                  }
		}
// add one to the variable
                $a++;
                list($cid, $title) = sql_fetch_row($result_dl, $dbi);
// if $cid <> "" then we found a featured download that is not disabled, so it will be displayed
                if ($cid <> "") {
   	          $ftitle = preg_replace("/ /", "_", $title);
                  $content .= "&nbsp;$bullet&nbsp;<a href=\"modules.php?name=Downloads";
                  $content .= "&amp;d_op=viewdownloaddetails&amp;cid=$cid&amp;lid=$lid&amp;ttitle=$ftitle#dldetails\">";
                  $content .= "$title</a><br /><br />";
                }
        }
}
// Latest added
if ($useimages == 1) {
  $content .= "<center><br /><img src=\"images/$image_color/newest1.gif\"><br /></center><br />";
}
else {
  $content .= "<br /><center><u><strong>$recent</strong></u></center><br />";
}
$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by date DESC limit 0,$downloadstoshow", $dbi);
while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
		$title2 = preg_replace("/_/", " ", $title);
	  $content .= "$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;cid=$cid&amp;lid=$lid&amp;title=$title#dldetails\">$title2</a><br />[$hitstext: $hits]<br />";
		$a++;
}
// Most downloaded
if ($useimages == 1) {
  $content .= "<center><br /><img src=\"images/$image_color/popular1.gif\"><br /></center><br />";
}
else {
  $content .= "<br /><center><u><strong>$popular</strong></u></center><br />";
}
$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by hits DESC limit 0,$downloadstoshow", $dbi);
while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
    $title2 = preg_replace("/_/", " ", $title);
    $content .= "$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;cid=$cid&amp;lid=$lid&amp;title=$title#dldetails\">$title2</a><br />[$hitstext: $hits]<br />";
    $a++;
}
?>
