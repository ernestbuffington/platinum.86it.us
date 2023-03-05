<?php 
// ------------------------------------------------------------------------- //
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
//----------------------------------------//
//
//Center Block by Dawg//
//Based on The Random video block by Q @ www.3c0x1.net //
//----------------------------------------//
//Center Block to show Latest Video, Highest Rated and Most Viewed//
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
global $prefix, $prefix, $db;
$limit = 1;
//Views
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY (views) DESC LIMIT $limit"); 
while ($row = $db->sql_fetchrow($result)) {
  $imsrc = $row['imgurl'];
        if ($row['vidname'] != '') {
            $thumb_title = $row['vidname'];
        } else {
            $thumb_title = substr($row['imgurl'], 0, -4);
        } 	
		$content .="<td>";
        $content .="<center>Most Viewed Video</center>\n";
		$content .="<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."><img src=".$row['imgurl']." border=\"0\" width=145 alt=".$row['vidname']."></a>\n";
		$content .= "<br /><center><a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id'].">".$row['vidname']."</a></center></td>";
} 
//Latest Added
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY id DESC LIMIT $limit"); 
while ($row = $db->sql_fetchrow($result)) {
  $imsrc = $row['imgurl'];
        if ($row['vidname'] != '') {
            $thumb_title = $row['vidname'];
        } else {
            $thumb_title = substr($row['imgurl'], 0, -4);
        } 
		$content .="<td>";
		$content .="<center>Latest Video</center>\n";
		$content .="<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."><img src=".$row['imgurl']." border=\"0\" width=145 alt=".$row['vidname']."></a>\n";
		$content .= "<br /><center><a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id'].">".$row['vidname']."</a></center></td>";
}
 //Rated
$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY (rating/rates) DESC LIMIT $limit");
while ($row = $db->sql_fetchrow($result)) {
  $imsrc = $row['imgurl'];
        if ($row['vidname'] != '') {
            $thumb_title = $row['vidname'];
        } else {
            $thumb_title = substr($row['imgurl'], 0, -4);
        } 
		$content .="<td>";
		$content .="<center>Highest Rated Video</center>\n";
		$content .="<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."><img src=".$row['imgurl']." border=\"0\" width=145 alt=".$row['vidname']."></a>\n";
		$content .= "<br /><center><a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id'].">".$row['vidname']."</a></center></td>";
}
?>
