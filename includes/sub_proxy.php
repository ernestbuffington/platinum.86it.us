<?php
/***************************************************************************
 *                               sub_proxy.php
 *                            -------------------
 *   begin                : Saturday, June 18, 2005
 *   copyright            : (C) MMV TerraFrost
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

if ( !isset($check_conditions) )
{
	message_die(GENERAL_ERROR, '$check_conditions is undefined');
}

if ( !isset($start_conditions) )
{
	$start_conditions = $check_conditions;
}

if ( $start_conditions && $board_config['proxy_enable'] )
{
	$ports = array_map('hexdec',explode(',', substr(chunk_split($board_config['proxy_ports'], 4, ','),0,-1)));
	$num_ports = count($ports);

	// Delete old entries
	if ( $board_config['proxy_cache_time'] != 0 )
	{
		$age_limit = time() - $board_config['proxy_cache_time'];
		$sql = "DELETE FROM " . PROXY_TABLE . "
			WHERE last_checked < $age_limit";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Unable to clear proxy list', '', __LINE__, __FILE__, $sql);
		}
	}

	// Get the status (if it exists) of the current IP address
	$sql = "SELECT * FROM " . PROXY_TABLE . "
		WHERE ip_address = '$user_ip'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Unable to load proxy list', '', __LINE__, __FILE__, $sql);
	}

	if ( !$db->sql_numrows() )
	{
		$sql = "INSERT INTO " . PROXY_TABLE . " (ip_address, last_checked)
			VALUES ('$user_ip', " . time() . ")";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Unable to insert data into proxy list', '', __LINE__, __FILE__, $sql);
		}

		$script_name = preg_replace('#^/?(.*?)/?$#', '\1', trim($board_config['script_path']));
		$script_name = ( $script_name != '' ) ? $script_name . '/proxy' : 'proxy';
		$server_name = trim($board_config['server_name']);
		$server_ip = @gethostbyname($server_name);
		$server_port = trim($board_config['server_port']);

		foreach ($ports as $port)
		{
			$fsock = @fsockopen("tcp://$server_ip", $server_port, $errno, $errstr, $board_config['proxy_timeout']);
			if (!$fsock)
			{
				message_die(GENERAL_ERROR, 'Unable to open socket connection');
			}
			@fputs($fsock,"GET /$script_name/connect.$phpEx?address=".decode_ip($user_ip)."&port=$port HTTP/1.0\r\n");
			@fputs($fsock,"Host: $server_name\r\n");
			@fputs($fsock,"User-Agent: ".stripcslashes($board_config['proxy_user_agent'])."\r\n");
			@fputs($fsock,"Connection: close\r\n\r\n");
			@fclose($fsock);
		}

		$proxy['status'] = 0;
	}
	else
	{
		$proxy = $db->sql_fetchrow($result);
	}

	if ( $check_conditions && $board_config['proxy_block'] && $proxy['status'] < $num_ports )
	{
		$timeout = @ini_get('max_execution_time');
		for ($num=0;$num < $timeout && $proxy['status'] < $num_ports;$num++)
		{
			@sleep(1);
			$sql = "SELECT * FROM " . PROXY_TABLE . " 
				WHERE ip_address = '$user_ip'";
			$result = $db->sql_query($sql);
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR,'Unable to load up-to-date proxy list (timeout)',__FILE__,__LINE__,$sql);
			}
			$proxy = $db->sql_fetchrow($result);
		}
		if ($num == $timeout)
		{
			message_die(GENERAL_ERROR, 'Error loading up-to-date proxy list', '', __LINE__, __FILE__, $sql);
		}
	}

	// Prevent the registration attempt if it needs preventing.  Should error messages be displayed if the table is unable to be updated?
	if ( $board_config['proxy_block'] && $proxy['status'] != PROXY_ERROR && $proxy['status'] > $num_ports )
	{
		if ( $board_config['proxy_ban'] )
		{
			// If the user can get this far, he hasn't already been banned (and thus, isn't already in the database)
			$sql = "INSERT INTO " . BANLIST_TABLE . " (ban_ip) 
				VALUES ('$encoded_ip')";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR,'Unable to to insert ban_userip info into database',__FILE__,__LINE__,$sql);
			}
			$sql = "DELETE FROM " . PROXY_TABLE . " 
				WHERE ip_address = '$encoded_ip'";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR,'Unable to delete from proxy list',__FILE__,__LINE__,$sql);
			}
			session_end($userdata['session_id'], $userdata['user_id']);
		}
		message_die(GENERAL_MESSAGE,sprintf($lang['proxy_detected'],$lang['proxy_t'.($proxy['status']-PROXY_TRANSPARE)],hexdec($proxy['port'])).'<br /> <br />'.$lang['proxy_blocked']);
	}
}
?>