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
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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
/* Forums Glance Admin v1.0 by sgtmudd (sgtmudd@mach-hosting.com)              */
/* Copyright (c) 2012 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/

global $prefix, $db, $admin_file;

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
} 


$query = mysqli_query( $db,"SELECT `glance_enable`, `glance_news_forum_id`, `glance_num_news`, `glance_num_recent`, `glance_recent_ignore`, `glance_news_heading`, `glance_recent_heading`, `glance_show_new_bullets`, `glance_track`, `glance_auth_read`, `glance_topic_length`, `glance_direct_latest`, `glance_version` FROM `".$prefix."_fga_config`" );

if (!$query) {
    die('Could not query:' . mysqli_error());
	
	} else {

	if( $query ){
		while( $row = mysqli_fetch_assoc( $query ) ){
			$glance_enable = mysqli_result($query,$i,'glance_enable');
			$glance_news_forum_id = mysqli_result($query,$i,'glance_news_forum_id');
			$glance_num_news = mysqli_result($query,$i,'glance_num_news');
			$glance_num_recent = mysqli_result($query,$i,'glance_num_recent');
			$glance_recent_ignore = mysqli_result($query,$i,'glance_recent_ignore');
			$glance_news_heading = mysqli_result($query,$i,'glance_news_heading');
			$glance_recent_heading = mysqli_result($query,$i,'glance_recent_heading');
			$glance_show_new_bullets = mysqli_result($query,$i,'glance_show_new_bullets');
			$glance_track = mysqli_result($query,$i,'glance_track');
			$glance_auth_read = mysqli_result($query,$i,'glance_auth_read');
			$glance_topic_length = mysqli_result($query,$i,'glance_topic_length');
			$glance_direct_latest = mysqli_result($query,$i,'glance_direct_latest');
			$glance_version = mysqli_result($query,$i,'glance_version');
		}
	}
}

?>