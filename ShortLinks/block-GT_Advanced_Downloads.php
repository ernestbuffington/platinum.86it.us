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
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Advanced_Downloads.php")) {
    Header("Location: index.html");
    die();
}

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
if (eregi("block-Advanced_Downloads.php",$PHP_SELF)) {
    Header("Location: ../modules/Downloads/index.php");
    die();
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
   $title2 = ereg_replace("_", " ", $title);
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
$content .= "<br><center><u><strong>$summary</strong></u></center>";
}

$content .= "<br> $totalfiles: <strong>$files</strong><br> $totalcategories: <strong>$cats</strong><br> $totaldownloads: <strong>$total_hits</strong><br> "._NSSENT.": <strong>$mysizes</strong><br><br>";
  
if ($usemarquee == 1) {
	$content .= "<marquee behavior='scroll' direction='$scrolldirection' scrollamount='2' scrolldelay='100' onmouseover='this.stop()' onmouseout='this.start()'><br>";

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
   	          $ftitle = ereg_replace(" ", "_", $title);
                  $content .= " $bullet <a href=\"downloads.html";
                  $content .= "&d_op=viewdownloaddetails&cid=$cid&lid=$lid&ttitle=$ftitle#dldetails\">";
                  $content .= "$title</a><br><br>";
                }
        }
}


// Latest added
if ($useimages == 1) {
  $content .= "<center><br><img src=\"images/$image_color/newest1.gif\"><br></center><br>";
}
else {
  $content .= "<br><center><u><strong>$recent</strong></u></center><br>";
}
$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by date DESC limit 0,$downloadstoshow", $dbi);

while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
		$title2 = ereg_replace("_", " ", $title);
	  //$content .= "$a: <a href=\"modules.php?name=Downloads&d_op=viewdownloaddetails&cid=$cid&lid=$lid&title=$title#dldetails\">$title2</a><br>[$hitstext: $hits]<br>";
	  $content .= "$a: <a href=\"downloaddetails-$cid-$lid-$title.html#dldetails\">$title2</a><br>[$hitstext: $hits]<br>";
		$a++;
}

// Most downloaded
if ($useimages == 1) {
  $content .= "<center><br><img src=\"images/$image_color/popular1.gif\"><br></center><br>";
}
else {
  $content .= "<br><center><u><strong>$popular</strong></u></center><br>";
}

$a = 1;
$result = sql_query("select cid, lid, title, hits from ".$prefix."_downloads_downloads where ns_disable='0' order by hits DESC limit 0,$downloadstoshow", $dbi);

while(list($cid, $lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
    $title2 = ereg_replace("_", " ", $title);
    //$content .= "$a: <a href=\"modules.php?name=Downloads&d_op=viewdownloaddetails&cid=$cid&lid=$lid&title=$title#dldetails\">$title2</a><br>[$hitstext: $hits]<br>";
    $content .= "$a: <a href=\"downloaddetails-$cid-$lid-$title.html#dldetails\">$title2</a><br>[$hitstext: $hits]<br>";
    $a++;
}

?>