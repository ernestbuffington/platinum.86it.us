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
/* Edited by sgtmudd for Forums Glance Admin module-http://platinumnukepro.com */
/* Forums Glance  ***** Glance Enable v.2.0.0 updated(01232014) DocHavoc  ******/
/*******************************************************************************/

global $prefix, $db;
/* Forums Glance*****Glance Enable v.2.0.0 updated(01232014) DocHavoc***Start***/
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fga_config"));
$glance_enable = $row['glance_enable'];
$glance_news_forum_id =$row['glance_news_forum_id'];
$glance_num_news = $row['glance_num_news'];
$glance_num_recent = $row['glance_num_recent'];
$glance_recent_ignore = $row['glance_recent_ignore'];
$glance_news_heading = $row['glance_news_heading'];
$glance_recent_heading = $row['glance_recent_heading'];
$glance_show_new_bullets = $row['glance_show_new_bullets'];
$glance_track = $row['glance_track'];
$glance_auth_read = $row['glance_auth_read'];
$glance_topic_length = $row['glance_topic_length'];
$glance_direct_latest = $row['glance_direct_latest'];
$glance_version = $row['glance_version'];
$glance_forum_dir = 'modules.php?name=Forums&amp;file=';
// TABLE WIDTH
$glance_table_width = '100%';
if (!$sql) {
    die('Could not query:' . mysql_error());
}
/* Forums Glance*****Glance Enable v.2.0.0 updated(01232014) DocHavoc***End***/
	
?>