<?php
########################################################################
# PHP-Nuke Block: Total Hits v0.1                                      #
#                                                                      #
# Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  #
#                                                                      #
########################################################################
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
########################################################################
#         Additional security & Abstraction layer conversion           #
#                           2003 chatserv                              #
#      http://www.nukefixes.com -- http://www.nukeresources.com        #
########################################################################
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}
global $user, $cookie, $prefix, $db, $user_prefix;
cookiedecode($user);
if (isset($_SERVER['REMOTE_ADDR'])) { $ip = $_SERVER['REMOTE_ADDR']; }
if (is_user($user))
{
	$uname = $cookie[1];
	$guest = 0;
}
else
{
	if (!empty($ip)) {
		$uname = $ip;
	} else {
		$uname = '';
	}
	$guest = 1;
}
$guest_online_sql = 'SELECT * FROM '.$prefix.'_session WHERE guest=1';
$guest_online_query = $db->sql_query($guest_online_sql);
$guest_online_num = $db->sql_numrows($guest_online_query);
$member_online_sql = 'SELECT * FROM '.$prefix.'_session WHERE guest=0';
$member_online_query = $db->sql_query($member_online_sql);
$member_online_num = $db->sql_numrows($member_online_query);
$who_online_num = $guest_online_num + $member_online_num;
$who_online = '<div align="middle"><span class="content">'._CURRENTLY.' '.$guest_online_num.' '._GUESTS.' '.$member_online_num.' '._MEMBERS.'<br />';
$content = $who_online;
if (is_user($user)) {
	if (is_active('Private_Messages')) {
		$sql = 'SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$uname.'\'';
		$query = $db->sql_query($sql);
		list($user_id) = $db->sql_fetchrow($query);
		$uid = intval($user_id);
		$sql = 'SELECT * FROM '.$prefix.'_bbprivmsgs WHERE privmsgs_to_userid='.$uid.' AND privmsgs_type IN(1,5)';
		$query = $db->sql_query($sql);
		$newpm = $db->sql_numrows($query);
	}
}
$sql2 = 'SELECT title FROM '.$prefix.'_blocks WHERE bkey=\'online\'';
$query2 = $db->sql_query($sql2);
list($title) = $db->sql_fetchrow($query2);
if (is_user($user)) {
	$content .= '<br />'._YOUARELOGGED.' <strong>'.$uname.'</strong>.<br />';
	if (is_active('Private_Messages')) {
		$sql = 'SELECT user_id FROM '.$user_prefix.'_users WHERE username=\''.$uname.'\'';
		$query = $db->sql_query($sql);
		list($user_id) = $db->sql_fetchrow($query);
		$uid = intval($user_id);
		$sql = 'SELECT privmsgs_to_userid FROM '.$prefix.'_bbprivmsgs WHERE privmsgs_to_userid='.$uid.' AND privmsgs_type IN(0,1,5)';
		$query = $db->sql_query($sql);
		$numrow = $db->sql_numrows($query);
		$content .= _YOUHAVE.' <a href="modules.php?name=Private_Messages"><strong>'.$numrow.'</strong></a> '._PRIVATEMSG;
	}
	$content .= '</span></div>';
} else {
	$content .= '<br />'._YOUAREANON.'</span></div>';
}
?>
