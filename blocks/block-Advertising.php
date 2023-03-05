<?php
/************************************************************************/
/* Note: If you need more than one banner block, just copy this file    */
/*       with another name                                              */
/*                                                                      */
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
global $prefix, $db;
$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE type='1' AND active='1'"));
if ($numrows>1) {
    $numrows = $numrows-1;
    mt_srand((double)microtime()*1000000);
    $bannum = mt_rand(0, $numrows);
} else {
    $bannum = 0;
}
$row = $db->sql_fetchrow($db->sql_query("SELECT bid, imageurl, alttext FROM ".$prefix."_banner WHERE type='1' AND active='1' LIMIT $bannum,1"));
    $bid = intval($row['bid']);
    $imageurl = $row['imageurl'];
    $alttext = $row['alttext'];
if (!is_admin($admin)) {
    $db->sql_query("UPDATE ".$prefix."_banner SET impmade=impmade+1 WHERE bid='$bid'");
}
if($numrows>0) {
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, imptotal, impmade, clicks, date FROM ".$prefix."_banner WHERE bid='$bid'"));
    $cid = intval($row2['cid']);
    $imptotal = intval($row2['imptotal']);
    $impmade = intval($row2['impmade']);
    $clicks = intval($row2['clicks']);
    $date = $row2['date'];
/* Check if this impression is the last one and print the banner */
    if (($imptotal <= $impmade) AND ($imptotal != 0)) {
    
	$db->sql_query("UPDATE ".$prefix."_banner SET active='0' WHERE bid='$bid'");
    }
    $content = "<center><br /><a href=\"banners.php?op=click&amp;bid=$bid\" target=\"_blank\"><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\"></a><br /><br /></center>";
}
?>
