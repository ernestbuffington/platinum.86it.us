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
global $prefix, $db, $admin, $user, $modlist, $dummy, $default_module;
$content = '';
$ThemeSel = get_theme();
$def_module = '';
if (file_exists('themes/'.$ThemeSel.'/module.php')) {
    include_once('themes/'.$ThemeSel.'/module.php');
    if (is_active($default_module) AND file_exists('modules/'.$default_module.'/index.php')) {
        $def_module = $default_module;
    } else {
        $def_module = '';
    }
}
$row = $db->sql_fetchrow($db->sql_query('SELECT main_module FROM '.$prefix.'_main'));
$main_module = $row['main_module'];
/* If the module doesn't exist, it will be removed from the database automaticaly */
$result2 = $db->sql_query('SELECT title FROM ' . $prefix . '_modules');
while ($row2 = $db->sql_fetchrow($result2)) {
    $title = stripslashes($row2['title']);
    $a = 0;
    $handle=opendir('modules');
    while ($file = readdir($handle)) {
        if ($file == $title) {
            $a = 1;
        }
    }
    closedir($handle);
    if ($a == 0) {
        $db->sql_query('DELETE FROM '.$prefix.'_modules WHERE title=\''.$title.'\'');
    }
}
/* Now we make the Modules block with the correspondent links */
$content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="index.php">'._HOME.'</a><br />';
$result3 = $db->sql_query('SELECT * FROM ' . $prefix . '_modules WHERE active=1 AND title!=\''.$def_module.'\' AND inmenu=1 ORDER BY custom_title ASC');
while ($row3 = $db->sql_fetchrow($result3)) {
    $groups = $row3['groups'];
    $m_title = stripslashes($row3['title']);
    $custom_title = $row3['custom_title'];
    $view = intval($row3['view']);
    $m_title2 = preg_replace('/_/', ' ', $m_title);
    if (!empty($custom_title)) {
        $m_title2 = $custom_title;
    }
    if ($m_title != $main_module) {
        if ($view == 0) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$m_title.'">'.$m_title2.'</a><br />';
        } elseif ($view == 1 AND ((is_user($user) AND is_group($user, $m_title)) OR is_admin($admin))) {  
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$m_title.'">'.$m_title2.'</a><br />';
        } elseif ($view == 2 AND is_admin($admin)) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$m_title.'">'.$m_title2.'</a><br />';
        } elseif ($view == 3 AND (paid() OR is_admin($admin))) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$m_title.'">'.$m_title2.'</a><br />';
        } elseif ($view > 3 AND in_groups($groups)) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$m_title.'">'.$m_title2.'</a><br />';
        }
    }
}
/* If you're Admin you and only you can see Inactive modules and test it */
/* If you copied a new module is the /modules/ directory, it will be added to the database */
if (is_admin($admin)) {
    $content .= '<br /><center><strong>'._INVISIBLEMODULES.'</strong><br />';
    $content .= '<span class="tiny">'._ACTIVEBUTNOTSEE.'</span></center><br />';
    $result5 = $db->sql_query('SELECT title, custom_title FROM '.$prefix.'_modules WHERE active=1 AND inmenu=0 ORDER BY title ASC');
    while ($row5 = $db->sql_fetchrow($result5)) {
        $mn_title = stripslashes($row5['title']);
        $custom_title = $row5['custom_title'];
        $mn_title2 = preg_replace('/_/', ' ', $mn_title);
        if (!empty($custom_title)) {
            $mn_title2 = $custom_title;
        }
        if (!empty($mn_title2)) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$mn_title.'">'.$mn_title2.'</a><br />';
            $dummy = 1;
        } else {
            $a = 1;
        }
    }
    if ($a == 1 AND $dummy != 1) {
        $content .= '<strong><big>&middot;</big></strong>&nbsp;<i>'._NONE.'</i><br />';
    }
    $content .= '<br /><center><strong>'._NOACTIVEMODULES.'</strong><br />';
    $content .= '<span class="tiny">'._FORADMINTESTS.'</span></center><br />';
    $result6 = $db->sql_query('SELECT title, custom_title FROM '.$prefix.'_modules WHERE active=0 ORDER BY title ASC');
    while ($row6 = $db->sql_fetchrow($result6)) {
        $mn_title = stripslashes($row6['title']);
        $custom_title = $row6['custom_title'];
        $mn_title2 = preg_replace('/_/', ' ', $mn_title);
        if (!empty($custom_title)) {
            $mn_title2 = $custom_title;
        }
        if (!empty($mn_title2)) {
            $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$mn_title.'">'.$mn_title2.'</a><br />';
            $dummy = 1;
        } else {
            $a = 1;
        }
    }
    if ($a == 1 AND $dummy != 1) {
        $content .= '<strong><big>&middot;</big></strong>&nbsp;<i>'._NONE.'</i><br />';
    }
}
?>
