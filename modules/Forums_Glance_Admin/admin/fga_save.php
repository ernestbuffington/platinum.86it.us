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
/* Forums Glance Admin v1.1 by sgtmudd (sgtmudd@mach-hosting.com)              */
/* Forums Glance Admin updated(01022014) DocHavoc*/
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/
if ( !defined('MODULE_FILE') )
{
	die ('Access Denied');
}

$url  =  $_SERVER['HTTP_REFERER'];
echo '<meta http-equiv = "refresh" content = "0;URL = ' . $url . '">';

global $prefix, $db, $admin_file, $currentlang;

include_once(NUKE_BASE_DIR. 'header.php');
include_once(NUKE_BASE_DIR. 'modules/Forums_Glance_Admin/admin/language/lang-'.$currentlang.'.php');

OpenTable();
echo "<center><strong>" . _FGACONFSAVED . "</strong></center>";

$fga_result = $db->sql_query("SELECT `glance_enable`, `glance_news_forum_id`, `glance_num_news`, `glance_num_recent`, `glance_recent_ignore`, `glance_news_heading`, `glance_recent_heading`, `glance_show_new_bullets`, `glance_track`, `glance_auth_read`, `glance_topic_length`, `glance_direct_latest`, `glance_version` FROM `" . $prefix . "_fga_config`");
if (!$fga_result) {
    die('Could not query:' . mysqli_error());
}
  
$glance_enable = $db->sql_escape_string($_POST['glance_enable']);
$glance_news_forum_id = $db->sql_escape_string($_POST['glance_news_forum_id']);
$glance_num_news = $db->sql_escape_string($_POST['glance_num_news']);
$glance_num_recent = $db->sql_escape_string($_POST['glance_num_recent']);
$glance_recent_ignore = $db->sql_escape_string($_POST['glance_recent_ignore']);
$glance_news_heading = $db->sql_escape_string($_POST['glance_news_heading']);
$glance_recent_heading = $db->sql_escape_string($_POST['glance_recent_heading']);
$glance_show_new_bullets = $db->sql_escape_string($_POST['glance_show_new_bullets']);
$glance_track = $db->sql_escape_string($_POST['glance_track']);
$glance_auth_read = $db->sql_escape_string($_POST['glance_auth_read']);
$glance_topic_length = $db->sql_escape_string($_POST['glance_topic_length']);
$glance_direct_latest = $db->sql_escape_string($_POST['glance_direct_latest']);

$sql = ("UPDATE " . $prefix . "_fga_config SET glance_enable = '$glance_enable', glance_news_forum_id = '$glance_news_forum_id', glance_num_news = '$glance_num_news', glance_num_recent = '$glance_num_recent', glance_recent_ignore = '$glance_recent_ignore', glance_news_heading = '$glance_news_heading', glance_recent_heading = '$glance_recent_heading', glance_show_new_bullets = '$glance_show_new_bullets', glance_track = '$glance_track', glance_auth_read = '$glance_auth_read', glance_topic_length = '$glance_topic_length', glance_direct_latest = '$glance_direct_latest'");

$result = $db->sql_query($sql);
if (!$result) {
    die('Could not query:' . mysqli_error());
}
CloseTable();

include_once(NUKE_BASE_DIR. 'footer.php');
?>