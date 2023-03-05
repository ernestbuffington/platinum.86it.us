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
if (@file_exists("install"))
{
	header("Location: install/index.php");
}
@require_once("mainfile.php");
global $prefix, $db, $admin_file;
if (isset($op) AND ($op == 'ad_click') AND isset($bid)) {
    $bid = intval($bid);
    $sql = 'SELECT clickurl FROM '.$prefix.'_banner WHERE bid=\''.$bid.'\'';
    $result = $db->sql_query($sql);
    list($clickurl) = $db->sql_fetchrow($result);
    $db->sql_query('UPDATE '.$prefix.'_banner SET clicks=clicks+1 WHERE bid=\''.$bid.'\'');
    update_points(21);
    Header('Location: '.htmlentities($clickurl));
    die();
}
define('MODULE_FILE', true);
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
//Arcade MOD - IBProSupport
$arcade = $_GET['act'];
$newscore = $_GET['do'];
if($arcade == 'Arcade' && $newscore='newscore')
{
	$gamename = str_replace("\'","''",$_POST['gname']);
	$gamename = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamename);
	$gamescore = intval($_POST['gscore']);
	//Get Game ID
	$row = $db->sql_fetchrow($db->sql_query("SELECT game_id from ".$prefix."_bbgames WHERE game_scorevar='$gamename'"));
	$gid = intval($row['game_id']);
	$ThemeSel = get_theme();
	echo "<link rel=\"StyleSheet\" href=\"themes/$ThemeSel/style/style.css\" type=\"text/css\">\n\n\n";
	echo "<form method='post' name='ibpro_score' action='modules.php?name=Forums&amp;file=proarcade&amp;valid=X&amp;gpaver=GFARV2'>";
	echo "<input type=hidden name='vscore' value='$gamescore'>";
	echo "<input type=hidden name='gid' value='$gid'>";
	echo "</form>";
	echo "<script type=\"text/javascript\">";
	echo "window.onload = function(){document.forms[\"ibpro_score\"].submit()}";
	echo "</script>";
	exit;
}
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
$modpath = '';
$_SERVER['PHP_SELF'] = 'modules.php';
$_SERVER['SCRIPT_NAME'] = 'modules.php';
$row = $db->sql_fetchrow($db->sql_query('SELECT main_module from '.$prefix.'_main'));
$name = $row['main_module'];
$home = 1;
define('HOME_FILE', true);
if (isset($url) AND is_admin($admin)) {
    Header('Location: '.$url);
    die();
}
if ($httpref == 1) {
    $referer = '';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        $referer = check_html($referer, 'nohtml');
    }
    if (!empty($referer) && !stripos_clone($referer, 'unknown') && !stripos_clone($referer, 'bookmark') && !stripos_clone($referer, $_SERVER['HTTP_HOST'])) {
        $result = $db->sql_query('INSERT INTO '.$prefix.'_referer VALUES (NULL, \''.$referer.'\')');
    }
    $numrows = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_referer'));
    if($numrows>=$httprefmax) {
        $result2 = $db->sql_query('DELETE FROM '.$prefix.'_referer');
    }
}
if (!isset($mop)) { $mop = 'modload'; }
if (!isset($mod_file)) { $mod_file = 'index'; }
$name = trim($name);
if (isset($file)) { $file = trim($file); }
$mod_file = trim($mod_file);
$mop = trim($mop);
if (stripos_clone($name, '..') || (isset($file) && stripos_clone($file, '..')) || stripos_clone($mod_file, '..') || stripos_clone($mop, '..')) {
    die('You are so cool...');
} else {
    $ThemeSel = get_theme();
    if (file_exists('themes/'.$ThemeSel.'/module.php')) {
        $default_module = '';
        include_once('themes/'.$ThemeSel.'/module.php');
        if (is_active($default_module) AND file_exists('modules/'.$default_module.'/'.$mod_file.'.php')) {
            $name = $default_module;
        }
    }
    if (file_exists('themes/'.$ThemeSel.'/modules/'.$name.'/'.$mod_file.'.php')) {
        $modpath = 'themes/'.$ThemeSel.'/';
    }
    $modpath .= 'modules/'.$name.'/'.$mod_file.'.php';
    if (file_exists($modpath)) {
        include_once($modpath);
    } else {
        define('INDEX_FILE', true);
        include_once('header.php');
        OpenTable();
        if (is_admin($admin)) {
            echo '<center><strong>'._HOMEPROBLEM.'</strong><br /><br />[ <a href="'.$admin_file.'.php?op=modules">'._ADDAHOME.'</a> ]</center>';
        } else {
            echo '<center>'._HOMEPROBLEMUSER.'</center>';
        }
        CloseTable();
        include_once('footer.php');
    }
}
?>