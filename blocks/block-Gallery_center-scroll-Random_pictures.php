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
$cpg_dir = "coppermine";
$cpg_block = true;
require("modules/" . $cpg_dir . "/include/load.inc");
$cpg_block = false;
// $length=$CONFIG['thumbcols']; //number of thumbs
$limit = 25; //number of thumbs
$title_length = 12; // maximum length of title under pictures, 20 is default
// END USER DEFINABLES
$result = $db->sql_query("SELECT COUNT(*) FROM ".$cpg_prefix."pictures as p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE approved='YES' GROUP BY pid");
$nbEnr = $db->sql_fetchrow($result);
$pic_count = $nbEnr[0];
// if we have more than 1000 pictures, we limit the number of picture returned
// by the SELECT statement as ORDER BY RAND() is time consuming
if ($pic_count > 1000) {
    $result = $db->sql_query("SELECT COUNT(*) from " . $cpg_prefix . "pictures WHERE approved = 'YES'");
    $nbEnr = mysql_fetch_row($result);
    $total_count = $nbEnr[0]; 
    // mysql_free_result($result);
    $granularity = floor($total_count / 1000);
    $cor_gran = ceil($total_count / $pic_count);
    srand(time());
    for ($i = 1; $i <= $cor_gran; $i++) $random_num_set = rand(0, $granularity) . ', ';
    $random_num_set = substr($random_num_set, 0, -2);
    $result = $db->sql_query("SELECT pid, filepath, filename, p.aid FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE randpos IN ($random_num_set) AND approved='YES' GROUP BY pid ORDER BY RAND() DESC LIMIT $limit");
} else {
    $result = $db->sql_query("SELECT pid, filepath, filename, p.aid FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE approved='YES' GROUP BY pid ORDER BY RAND() DESC LIMIT $limit");
}
// marquee info at http://www.faqs.org/docs/htmltut/_MARQUEE.html
$content = '<p align="center"><center><a name="scroller"></a><MARQUEE loop="0" BEHAVIOR="SCROLL" direction="left" height="125" width="80%" scrollamount="2" scrolldelay="1" onmouseover=\'this.stop()\' onmouseout=\'this.start()\'>';
$content .= '<table width="100%" cols="' . $limit . '" border="0" cellpadding="0" cellspacing="7" align="center"><tr align="center">';
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
    $content .= '<td align="center" valign="baseline"><a href="' . $CPG_M_URL . '&amp;file=displayimage&amp;album='.$row['aid'].'&amp;pid=' . $row["pid"] . '"><img src="' . get_pic_url($row, 'thumb') . '" border="0" alt="' . $thumb_title . '" title="' . $thumb_title . '"><br />' . truncate_stringblocks($thumb_title, $title_length) . '</a>&nbsp;&nbsp;</td>';
} 
$content .= '</tr></table></MARQUEE></p><p align="center"><table width="100%"  border="0" cellpadding="0" cellspacing="0" align="center"><tr align="center"><td valign="baseline"><a href="' . $CPG_M_URL . '">' . $lang_pagetitle_php["photogallery"] . '</a><br /></center></td></tr></table></p>';
?>
