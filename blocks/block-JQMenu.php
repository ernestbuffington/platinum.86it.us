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
global $prefix, $db, $admin, $user;
$catid = '';
$content = '';
function get_subs($catid) {
    global $prefix, $db;
	$content = '';
    $catid = (int) $catid;
	$sql = $db->sql_query('SELECT m.title, m.weight FROM '.$prefix.'_menu m LEFT JOIN '.$prefix.'_menu_cat c ON c.cid = m.cid WHERE c.cid=\''.$catid.'\' ORDER BY m.weight DESC');
  while ($row = $db->sql_fetchrow($sql)) {
    $title = stripslashes(check_html($row['title'], 'nohtml'));
	$DisplayTitle = str_replace('_', ' ', $title);
   $content .= '<li><a href="modules.php?name='.$title.'">'.$DisplayTitle.'</a></li>' . "\n";
   } 
   return $content;
} 
$content .= '<div id="sidetree">' . "\n";
$content .= '<div id="sidetreecontrol">' . "\n";
$content .= '<a href="#">Collapse All</a> | <a href="#">Expand All</a>' . "\n";
$content .= '</div>' . "\n";
$content .= '<ul id="tree">' . "\n";
$content .= '<li><strong>Main</strong>' . "\n";
$content .= '<ul><a href="index.php">Home</a></ul></li>' . "\n";
$sql2 = $db->sql_query('SELECT * FROM '.$prefix.'_menu_cat ORDER BY weight ASC');
while ($row2 = $db->sql_fetchrow($sql2)) {
$catid = (int) $row2['cid'];
$cat = check_html($row2['cat'], 'nohtml');
$weight = (int) $row2['weight'];
$content .= '<li><strong>'.$cat.'</strong>' . "\n";
$content .= '<ul>' . "\n";
$content .= get_subs($catid);
$content .= '</ul></li>' . "\n";
 }
$content .= '</ul></div>' . "\n";
?>
