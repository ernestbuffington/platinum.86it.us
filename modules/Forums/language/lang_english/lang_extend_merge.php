<?php
/***************************************************************************
 *						lang_extend_merge.php [English]
 *						-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 21/10/2003
 *
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
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
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_merge'] = 'Simply Merge Threads';
}
$lang['Refresh'] = 'Refresh';
$lang['Merge_topics'] = 'Merge topics';
$lang['Merge_title'] = 'New topic title';
$lang['Merge_title_explain'] = 'This will be the new title of the final topic. Let it blank if you want the system to use the title of the destination topic';
$lang['Merge_topic_from'] = 'Topic to merge';
$lang['Merge_topic_from_explain'] = 'This topic will be merge to the other topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$lang['Merge_topic_to'] = 'Destination topic';
$lang['Merge_topic_to_explain'] = 'This topic will get all the posts of the precedent topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$lang['Merge_from_not_found'] = 'The topic to merge hasn\'t been found';
$lang['Merge_to_not_found'] = 'The destination topic hasn\'t been found';
$lang['Merge_topics_equals'] = 'You can\'t merge a topic with itself';
$lang['Merge_from_not_authorized'] = 'You are not a authorized to moderate topics coming from the forum of the topic to merge';
$lang['Merge_to_not_authorized'] =  'You are not a authorized to moderate topics coming from the forum of the destination topic';
$lang['Merge_poll_from'] = 'There is a poll on the topic to merge. It will be copied to the destination topic';
$lang['Merge_poll_from_and_to'] = 'The destination topic already has got a poll. The poll of the topic to merge will be deleted';
$lang['Merge_confirm_process'] = 'Are you sure you want to merge <br />"<strong>%s</strong>"<br />to<br />"<strong>%s</strong>"';
$lang['Merge_topic_done'] = 'The topics have been successfully merged.';
?>
