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
    Header('Location: ../index.php');
    die();
}
	global $db, $prefix, $dim;
	$content = "<div align='justify'>";
		$result = $db->sql_query("SELECT tag,COUNT(tag) AS tot FROM ".$prefix."_tags GROUP BY tag ORDER BY RAND() LIMIT 50");
		while ($row = $db->sql_fetchrow($result)) {
			$tag = addslashes(check_words(check_html($row['tag'], "nohtml")));
			$num = intval($row['tot']);
			if ($num<=1) { $dim = "class1"; }
			else if ($num<=5) { $dim = "class2"; }
			else if ($num<=20) { $dim = "class3"; }
			else if ($num<=50) { $dim = "class4"; }
			else { $dim = "class5"; }
			$content .= "<span style='padding: 0 2px;' class='$dim'><a href='modules.php?name=Tags&amp;op=list&amp;tag=".urlencode($tag)."' class='$dim' title='$tag'>$tag</a></span>\n";
		}
	$content .= "</div>";
?>
