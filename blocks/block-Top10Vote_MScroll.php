<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
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
$index = 1;
global $user, $gallerypath, $imagepath, $prefix, $db, $bgcolor1;
include 'modules/My_eGallery/admin/config.php';
//Note: Change this to match your bgcolor//
$scrollerbgcolor="$bgcolor1";
$sql= "SELECT p.pid, p.img, p.name, p.description, p.votes, p.rate, p.counter, p.submitter, c.galloc, c.visible FROM $prefix"._gallery_pictures." AS p, $prefix"._gallery_categories." AS c WHERE (c.gallid=p.gid) AND (p.votes > 0)  AND ( visible >0) ORDER BY votes DESC, rate DESC, pid ASC LIMIT 0, 10";
$result = $db->sql_query($sql);
//echo $sql . "<br /><br />" .mysql_error();
$messages = "";
$i = 1;
while ($pic = $db->sql_fetchrow($result)) {
	$pic['description'] = substr($pic['description'],0,255);
	if (strlen($pic['name']) > 15 ) {
		$pic['name'] = substr($pic['name'],0,14).".";
	}
	$galloc = $pic['galloc'];
	$img = $pic['img'];
	$ext = substr($img, (strrpos($img,'.') +  1));
	if (file_exists("$gallerypath/$galloc/thumb/$img")) {
		$thumb = "<img src='$gallerypath/$galloc/thumb/$img' border='0' width='118' alt='$pic[description]'>";
	} else {
		$row = $db->sql_fetchrow($db->sql_query("SELECT thumbnail from $prefix"._gallery_media_types." where extension='$ext'"));
		$thumb = "<img src='$imagepath/$row[thumbnail]' border='0' alt='$pic[description]'>";
	}
	if ($pic['visible'] == 1) {
	    if (is_user($user)) {
		$messages .= "<center><strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br /><a href='$baseurl&amp;do=showpic&amp;pid=$pic[pid]'>$thumb</a><br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'><br /></center>\n";
	    } else {
		$messages .= "<center><strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br />$thumb<br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'><br /></center>\n";
	    }
	} else {
		$messages .= "<center><strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br /><a href='$baseurl&amp;do=showpic&amp;pid=$pic[pid]'>$thumb</a><br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'><br /></center>\n";
	}
	$i++;
}
 if($messages== "") {
	$messages = "<br /><br /><br /><br /><br /><strong>None<br />Voted<br />Pictures</strong>\"\n";
 }
$content = "<table width=\"100%\"><tr><td align=\"center\"><div align=\"center\">";
$content .= "<marquee Behavior=\"Scroll\" Direction=\"Up\" Height=\"250\" ScrollAmount=\"2\" ScrollDelay=\"120\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\">\n".$messages."</marquee></div></td></tr></table>";
?>
