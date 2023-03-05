<?php
/***************************************************************************
 *                                connect.php
 *                            -------------------
 *   begin                : Wednesday, Mar 3, 2005
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

define('IN_PHPBB', true);
$phpbb_root_path = '../';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

$server_name = trim($board_config['server_name']);

if ( $_SERVER['REMOTE_ADDR'] != gethostbyname($server_name) && $_SERVER['REMOTE_ADDR'] != '127.0.0.1' )
{
	die('IP mismatch.');
}

$type = 0;
if (($fsock = @fsockopen('tcp://'.$_GET['address'],$_GET['port'],$errno,$errstr,$board_config['proxy_delay'])) && $_GET['address'] != '127.0.0.1')
{
	if ( phpversion() >= '4.3.0' )
	{
		stream_set_timeout($fsock, $board_config['proxy_delay']);
		stream_set_blocking($fsock, false);
	}

	$script_name = preg_replace('#^/?(.*?)/?$#', '\1', trim($board_config['script_path']));
	$script_name = ( $script_name != '' ) ? $script_name . '/proxy/serve.'.$phpEx : 'proxy/serve.'.$phpEx;
	$server_port = ( $board_config['server_port'] != 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

	$server_url = 'http://' . $server_name . $server_port . $script_name;

	$query = "GET $server_url HTTP/1.0\r\n";
	$query .= "Host: $server_name\r\n";
	$query .= "User-Agent: ".stripcslashes($board_config['proxy_user_agent'])."\r\n";
	$query .= "Connection: close\r\n\r\n";

	if (!empty($_GET['debug']))
	{
		echo $query;
	}

	fputs($fsock,$query);

	$type = 0;
	while (!feof($fsock) && fgets($fsock, 1024) != "\r\n");
	while (!feof($fsock))
	{
		$temp = fread($fsock, 1024);
		if (preg_match('#transpare|anonymous|high_anon#s',$temp,$type))
		{
			$type = $type[0];
			switch ($type)
			{
				case 'transpare':
					$type = PROXY_TRANSPARE;
					break;
				case 'anonymous':
					$type = PROXY_ANONYMOUS;
					break;
				case 'high_anon':
					$type = PROXY_HIGH_ANON;
			}
			break;
		}
		else
		{
			$type = 0;
		}
	}
	fclose($fsock);
}
else if (!empty($_GET['debug']))
{
	$script_name = preg_replace('#^/?(.*?)/?$#', '\1', trim($board_config['script_path']));
	$script_name = ( $script_name != '' ) ? $script_name . '/proxy/serve.'.$phpEx : 'proxy/serve.'.$phpEx;
	$server_port = ( $board_config['server_port'] != 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

	$server_url = 'http://' . $server_name . $server_port . $script_name;

	echo "GET $server_url HTTP/1.0\r\n";
	echo "Host: $server_name\r\n";
	echo "User-Agent: ".stripcslashes($board_config['proxy_user_agent'])."\r\n";
	echo "Connection: close\r\n\r\n";
}

if ($type == 0)
{
	$sql = "UPDATE " . PROXY_TABLE . " 
		SET status = status + 1 
		WHERE ip_address = '" . encode_ip($_GET['address']) . "' 
			AND status < " . PROXY_TRANSPARE;
}
else
{
	$sql = "UPDATE " . PROXY_TABLE . " 
		SET status = " . $type . ", port = '" . dechex($_GET['port']) . "' 
		WHERE ip_address = '" . encode_ip($_GET['address']) . "'";
}
$db->sql_query($sql);
echo $sql;
?>