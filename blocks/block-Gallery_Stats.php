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
global $prefix, $db, $CONFIG, $Version_Num, $cat, $cpg_dir;
$cpg_dir = "coppermine";
$cat = is_numeric($cat) ? $cat : 0;
$cpg_block = true;
require("modules/" . $cpg_dir . "/include/load.inc");
$cpg_block = false;
$content = "";
$result = $db->sql_query("SELECT dirname, prefix FROM ".$prefix."_cpg_installs");
while ($row = $db->sql_fetchrow($result)) {
    if ($content != "") $content .= "<hr />";
    $cpgdir = $row[0];
    $cpgprefix = $row[1];
    $cpgtitle = $db->sql_fetchrow($db->sql_query("SELECT custom_title FROM " . $prefix . "_modules WHERE title='$cpgdir'"));
    if ($cpgtitle[0] == '') $cpgtitle[0] = $cpgdir;
    $content .= "<center><strong>" . $cpgtitle[0] . "</strong></center>";
    $content .= "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;" . ALBUMS . ": " . cpg_tablecount($cpgprefix . "albums", "count(*)") . "<br />";
    $content .= "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;" . PICTURES . ": " . cpg_tablecount($cpgprefix . "pictures", "count(*)") . "<br />";
    $num = cpg_tablecount($cpgprefix . "pictures", "sum(hits)");
    if (!is_numeric($num)) $num = 0;
    $content .= "<strong><big>&nbsp;&nbsp;&middot;</big></strong>&nbsp;" . PIC_VIEWS . ": $num<br />";
    $num = cpg_tablecount($cpgprefix . "pictures", "sum(votes)");
    if (!is_numeric($num)) $num = 0;
    $content .= "<strong><big>&nbsp;&nbsp;&middot;</big></strong>&nbsp;" . PIC_VOTES . ": $num<br />";
    $content .= "<strong><big>&nbsp;&nbsp;&middot;</big></strong>&nbsp;" . PIC_COMMENTS . ": " . cpg_tablecount($cpgprefix . "comments", "count(*)") . "<br />";
    if (GALLERY_ADMIN_MODE) {
        $num = $db->sql_fetchrow($db->sql_query("SELECT count(*) FROM " . $cpgprefix . "pictures WHERE approved='NO'"));
        if ($name != $cpgdir) $cat = 0;
        $content .= "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=editpics&amp;mode=upload_approval").'">' . UPL_APP_LNK . "</a>: " . $num[0] . "<br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=searchnew").'">' . SEARCHNEW_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=reviewcom").'">' . COMMENTS_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=groupmgr").'">' . GROUPS_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=usermgr").'">' . USERS_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=albmgr&amp;cat=$cat").'">' . ALBUMS_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=catmgr").'">' . CATEGORIES_LNK . "</a><br />";
        if (is_admin($admin)) $content .= "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=config").'">' . CONFIG_LNK . "</a>";
    } else if (USER_ADMIN_MODE) {
        $content .= "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=albmgr").'">' . ALBMGR_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=modifyalb").'">' . MODIFYALB_LNK . "</a><br />" .
                    "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"".getlink("$cpgdir&amp;file=profile&amp;op=edit_profile").'">' . MY_PROF_LNK . "</a>";
    } 
} 
// $ob = ob_get_contents();
// ob_end_clean();
?>
