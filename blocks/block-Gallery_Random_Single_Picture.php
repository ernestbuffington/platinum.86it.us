<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2c for CMS                                   //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
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
if (preg_match("#block-CPG#", $_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
} 
define('NO_HEADER', true);
global $prefix, $db, $CONFIG, $Version_Num, $cpg_dir;
//global $ALBUM_SET;
$cpg_dir = "coppermine";
$cpg_block = true;
require("modules/".$cpg_dir."/include/load.inc");
$cpg_block = false;
$numberpic = $CONFIG['thumbcols']; //number of thumbs
$numberpic=1; //number of thumbs
$limit = $numberpic;
$content = '<p align="center">';
function truncate_string_randpic($str)
{
    $maxlength = 15; // maximum lengtht of name in block 
    if (strlen($str) > $maxlength)
        return substr($str, 0, $maxlength) . " ...";
    else
        return $str;
} 
// modified by DJMaze
$result = $db->sql_query("SELECT COUNT(*) FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE approved='YES' GROUP BY pid");
$nbEnr = $db->sql_fetchrow($result);
$pic_count = $nbEnr[0];
// mysql_free_result($result); 
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
    // modified by DJMaze
    $result = $db->sql_query("SELECT pid, filepath, filename, p.aid, p.title FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE randpos IN ($random_num_set) AND approved='YES' GROUP BY pid ORDER BY RAND() DESC LIMIT $limit");
} else {
    // modified by DJMaze
    $result = $db->sql_query("SELECT pid, filepath, filename, p.aid, p.title FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE approved='YES' GROUP BY pid ORDER BY RAND() DESC LIMIT $limit");
} 
$rowset = array();
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
$content .= '<a href="' . $CPG_M_URL . '&amp;file=displayimage&amp;album='.$row['aid'].'&amp;pid=' . $row["pid"] . '"><img src="' . get_pic_url($row, 'thumb') . '" border="0"></a></p>';
} 
?>
