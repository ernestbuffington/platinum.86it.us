<?php
/***************************************************************************
 *                            lang_thread_kicker.php [English]
 *                              -------------------
 *     begin                : Sun Oct 17 2004
 *     copyright            : (C) 2004 Majorflam
 *     email                : majorflam@blueyonder.co.uk
 *     Website              : http://majormod.com
 *
 *     $Id: lang_thread_kicker.php,v 1.0.0 
 *
 ****************************************************************************/
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
//
// Thread Kicker Mod Language Variables
//
// General Variables
$lang['tkick_kickbutton'] = 'Kick This User From This Thread';
$lang['tkick_unkickbutton'] = 'Allow This User Back Into This Thread';
$lang['tk_kick_success'] = 'User kicked successfully!';
$lang['tk_unkick_success'] = 'User can now post in this thread again!';
$lang['tk_default_link'] = 'Your browser will redirect you to the thread in 3 seconds. If you do not want to wait, click ';
$lang['tk_here'] = 'here';
$lang['tk_userkicked_topic'] = 'Your ability to post in this thread has been withdrawn by ';
$lang['tk_userkicked_topic_noview'] = 'Your ability to read or post in this thread has been withdrawn by ';
$lang['tk_userkicked_contact'] = '. You should contact this person for details.';
$lang['tk_default_link_overrule'] = 'Your browser will redirect you to the thread in 10 seconds. If you do not want to wait, click ';
$lang['tk_kickview'] = 'View list of kicked users for this topic';
// Error codes
$lang['tk_nodata'] = 'Insufficient data to process request';
$lang['tk_nohotlink'] = 'You must access this facility from the relevant link within the topic';
$lang['tk_not_permitted'] = 'You are not authorised to carry out this action';
$lang['tk_not_mod'] = 'Only Moderators may carry out this action in this way';
$lang['tk_not_mod_thisforum'] = 'Only Moderators of that Forum may carry out this action in this way';
$lang['tk_kicked_already'] = 'This user is already kicked from that thread!';
$lang['tk_unkicked_already'] = 'This user was not kicked from this thread to begin with!';
$lang['tk_no_overrule'] = 'This user was kicked from the thread by an Administrator or Moderator, and you do not have the authority to over-rule their decision. Please contact an Administrator if you want this user kicked from this thread.';
$lang['tk_no_overrule_admin'] = 'This user was kicked from the thread by an Administrator, and you do not have the authority to over-rule their decision. Please contact an Administrator if you want this user kicked from this thread.';
$lang['tk_banned'] = 'Your ability to kick other users from threads has been withdrawn. Please contact an Administrator for details.';
// for viewing kicked users
$lang['tk_kicker_heading'] = 'Thread Kicker - Administration';
$lang['tk_kicker_table'] = 'Current List Of Kicked Users For Thread :: ';
$lang['tk_unkick'] = 'Mark';
$lang['tk_kicked'] = 'Kicked User';
$lang['tk_date'] = 'Date User Was Kicked';
$lang['tk_kicked_by'] = 'User Kicked By';
$lang['tk_kick_marked'] = 'Un-Kick Marked';
$lang['unkick_all'] = 'Un-Kick All';
?>
