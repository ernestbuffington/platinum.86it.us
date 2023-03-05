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
####################################################################### 
# Block for PHP-Nuke 
#------------------------- 
# HTTP Video Stream Latest 10
#------------------------- 
#
# Version 1.0
# Copyright (c) 2005 by:
# Brady
# http://www.scottswebsite.co.uk
#
#  
# Shows Latest 10 videos posted to the module HTTP_Video_Stream
#
######################################################################
if (preg_match("/block-HTTP_Video_Stream.php/",$_SERVER['PHP_SELF'])) { 
    Header("Location: ../index.php"); 
    die();
}
global $db, $prefix, $currentlang;
if ($currentlang) {
	if (file_exists("modules/Video_Stream/lang-block/lang-$currentlang.php")) { 
		include_once("modules/Video_Stream/lang-block/lang-$currentlang.php");
	} else {
		include_once("modules/Video_Stream/lang-block/lang-english.php");
	}
} else {
	include_once("modules/Video_Stream/lang-block/lang-english.php");
}
$settings = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$srow = $db->sql_fetchrow($settings);
$ratingshow = $srow['ratingV'];
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY id DESC LIMIT 0,10");
$content = "<marquee behavior='scroll' direction='up' height='200'scrollamount='2' scrolldelay='20' onmouseover='this.stop()' onmouseout='this.start()'>";
while($row = $db->sql_fetchrow($result)) {
$content .= "<strong><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."\">".$row['vidname']."</a></strong><br>";
$content .= "<p>"._BBY.": ".$row['user']."<br>";
$date = $row['date'];
$date = substr($date, 9);
$content .= ""._BBON.": ".$date."<br>";
$content .= ""._BVIEWS.": ".$row['views']."";
if ($ratingshow = 1) {
$content .= "<br>"._BRATING.": ".@number_format(($row['rating'] / $row['rates']), 2)." "._BTVOTES.": ".$row['rates']."";
}
$content .= "<br><hr>";
$content .= "</p>";
}
$content .= "</marquee>";
?>
