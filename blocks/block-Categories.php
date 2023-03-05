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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $cat, $language, $prefix, $multilingual, $currentlang, $db;
if ($multilingual == 1) {
    $querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = '';
}
$sql = 'SELECT catid, title FROM '.$prefix.'_stories_cat ORDER BY title';
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);
if ($numrows == 0) {
    return;
} else {
    $boxstuff = '<span class="content">';
    $a = 0; //RN0000546
    while (list($catid, $title) = $db->sql_fetchrow($result)) {
        $catid = intval($catid);
        $title = stripslashes($title);
        $numrows = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_stories WHERE catid='.$catid.' '.$querylang.' LIMIT 1'));
        if ($numrows > 0) {
            if ($cat == 0 AND !$a) {
                $boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<strong>'._ALLCATEGORIES.'</strong><br />';
                $a = 1;
            } elseif ($cat != 0 AND !$a) {
                $boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=News">'._ALLCATEGORIES.'</a><br />';
                $a = 1;
            }
            if ($cat == $catid) {
                $boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<strong>'.$title.'</strong><br />';
            } else {
                $boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'">'.$title.'</a><br />';
            }
        }
    }
    $boxstuff .= '</span>';
    $content = $boxstuff;
}
?>
