<?php 
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1 for CMS     7.11.05                       //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.max.pcnuke.com  -  http://www.pcnuke.com                      //
// Website for Port Upgrades from 1.3.0 and up...      7.11.05              //
// ------------------------------------------------------------------------ //
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
if (preg_match("#block-CPG#", $_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
define('NO_HEADER', true);
global $prefix, $db, $CONFIG, $Version_Num, $cpg_dir;
global $ALBUM_SET;
$cpg_dir = "coppermine";
$cpg_block = true;
require("modules/".$cpg_dir."/include/load.inc");
$cpg_block = false;
// $length=$CONFIG['thumbcols']; //number of thumbs
$length=10; //number of thumbs
$title_length = 20; // maximum length of title under pictures, 20 is default
// marquee info at http://www.faqs.org/docs/htmltut/_MARQUEE.html
$content='<p align="center"><a name="scroller"></a><MARQUEE loop="0" behavior="SCROLL" direction="up" height="150" scrollamount="1" scrolldelay="1" onmouseover=\'this.stop()\' onmouseout=\'this.start()\'><center>';
// END USER DEFINABLES
// modified by DJMaze
$result = $db->sql_query("SELECT pid, filepath, filename, p.aid, p.title FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE approved='YES' GROUP BY pid ORDER BY pid DESC LIMIT $length");
$pic = 0;
while ($row = $db->sql_fetchrow($result)) {
    if ($CONFIG['seo_alts'] == 0) {
        $thumb_title = $row['filename'];
    } else {
        if ($row['title'] != '') {
            $thumb_title = $row['title'];
        } else {
            $thumb_title = substr($row['filename'], 0, -4);
        }
    }
    stripslashes($thumb_title);
    $content .= '<a href="'. $CPG_M_URL . '&amp;file=displayimage&amp;meta=lastup&amp;cat=0&amp;pid=' . $row["pid"] . '"><img src="'.get_pic_url($row, 'thumb') .'" border="0" alt="'.$thumb_title.'" title="'.$thumb_title.'"><br />' . truncate_stringblocks($thumb_title,$title_length) . '</a><br /><br />';
    $pic++;
}
$content .= '</MARQUEE></p><p align="center"><a href="'. $CPG_M_URL . '">'.$lang_pagetitle_php["photogallery"].'</a></p>';
?>
