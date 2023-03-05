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
/* Block to fit perfectly in the center of the site, remember that not all
   blocks looks good on Center, just try and see yourself what fits your needs */
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $multilingual, $currentlang, $db;
if ($multilingual == 1) {
    $querylang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
} else {
    $querylang = '';
}
$content = '';
$sql = 'SELECT sid, title, comments, counter FROM '.$prefix.'_stories '.$querylang.' ORDER BY sid DESC LIMIT 0,5';
$result = $db->sql_query($sql);
if ($db->sql_numrows($result)) {
    $content .= '<table width="100%" border="0">';
    while (list($sid, $title, $comments, $counter) = $db->sql_fetchrow($result)) {
        $title = stripslashes($title);
        $sid = intval($sid);
        $comtotal = intval($comments);  //RN0000547
        $counter = intval($counter);
        $content .= '<tr><td align="left">';
        $content .= '<strong><big>&middot;</big></strong>';
        $content .= ' <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$title.'</a>';
        $content .= '</td><td align="right">';
        $content .= '[ '.$comtotal.' '._COMMENTS.' - '.$counter.' '._READS.' ]';
        $content .= '</td></tr>';
    }
    $content .= '</table>';
}
$content .= '<br /><center>[ <a href="modules.php?name=News">'._MORENEWS.'</a> ]</center>';
?>
