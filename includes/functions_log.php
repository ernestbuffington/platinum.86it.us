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


if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

function log_action($action, $topic_id, $user_id, $username)
{
	global $db;

	$sql = "SELECT session_ip
		FROM " . SESSIONS_TABLE . "
		WHERE session_user_id = $user_id ";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not select session_ip', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$user_ip = $row['session_ip'];

	$username = addslashes($username);

	$time = time();

	$sql = "INSERT INTO " . LOGS_TABLE . " (mode, topic_id, user_id, username, user_ip, time)
		VALUES ('$action', '$topic_id', '$user_id', '$username', '$user_ip', '$time')";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not insert data into logs table', '', __LINE__, __FILE__, $sql);
	}
}


function prune_logs($prune_days)
{
	global $db;

	$prune = time() - ( $prune_days * 86400 );

	$sql = "SELECT id_log
		FROM " . LOGS_TABLE . "
		WHERE time < $prune ";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain list of logs to prune', '', __LINE__, __FILE__, $sql);
	}

	$logs = '';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$logs .= ( ( $logs != '' ) ? ', ' : '' ) . $row['id_log'];
	}
	$db->sql_freeresult($result);

	if ( $logs != '' )
	{
		$sql = "DELETE FROM " . LOGS_TABLE . "
			WHERE id_log IN ($logs)";
	
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not delete logs', '', __LINE__, __FILE__, $sql);
		}

		return TRUE;
	}
}


function auto_prune_logs()
{
	global $db;

	// To do
}

?>
