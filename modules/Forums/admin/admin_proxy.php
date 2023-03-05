<?php
/***************************************************************************
 *                              admin_proxy.php
 *                            -------------------
 *   begin                : Tuesday, Jul 5, 2005
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Platinum MODs']['proxy_name'] = $file;

	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
$no_page_header = true;
require_once('./pagestart.' . $phpEx);

//
// Set mode
//
if( isset( $_POST['mode'] ) || isset( $_GET['mode'] ) )
{
	$mode = ( isset( $_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = '';
}

switch ( $mode )
{
	case 'test':
		if( isset( $_GET['address']) || isset( $_POST['address']) )
		{
			$decoded_ip = ( isset( $_POST['address']) ) ? $_POST['address'] : $_GET['address'];
			$encoded_ip = encode_ip($decoded_ip);
		}
		else
		{
			message_die(GENERAL_ERROR,'No IP address specified');
		}

		list($usec, $sec) = explode(' ', microtime());
		$timer_start = ((float) $usec + (float) $sec);
		mt_srand($timer_start);

		$sql = "SELECT * FROM " . PROXY_TABLE . "
			WHERE ip_address = '$encoded_ip'";
		if ( !($db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Unable to load proxy list', '', __LINE__, __FILE__, $sql);
		}

		if ( !$db->sql_numrows() )
		{
			$sql = "INSERT INTO " . PROXY_TABLE . " (ip_address, last_checked)
				VALUES ('$encoded_ip', " . time() . ")";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Unable to insert data into proxy list', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			$sql = "UPDATE " . PROXY_TABLE . " 
				SET status = 0, last_checked = " . time() . " 
				WHERE ip_address = '$encoded_ip'";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Unable to update data in proxy list', '', __LINE__, __FILE__, $sql);
			}
		}

		$ports = array_map('hexdec',explode(',', substr(chunk_split($board_config['proxy_ports'], 4, ','),0,-1)));
		$num_ports = count($ports);

		$temp = mt_rand(0,$num_ports-1);

		// swap the last port with the port that we've randomly decided to display info. about
		$last_port = $ports[$temp];
		$ports[$temp] = $ports[$num_ports-1];
		$ports[$num_ports-1] = $last_port;

		$proxy['status'] = 0;

		$script_name = preg_replace('#^/?(.*?)/?$#', '\1', trim($board_config['script_path']));
		$script_name = ( $script_name != '' ) ? $script_name . '/proxy' : 'proxy';
		$server_name = trim($board_config['server_name']);
		$server_ip = gethostbyname($server_name);
		$server_port = trim($board_config['server_port']);

		$http_request = "GET /$script_name/connect.$phpEx?address=".$decoded_ip."&port=%s HTTP/1.0\r\n";
		$http_request .= "Host: $server_name\r\n";
		$http_request .= "User-Agent: ".stripcslashes($board_config['proxy_user_agent'])."\r\n";
		$http_request .= "Connection: close\r\n\r\n";

		$output_beg = '<strong>'.$lang['proxy_sample_http_1'].':</strong><br /><blockquote>'.sprintf(str_replace("\r\n",'<br />',rtrim($http_request)),$last_port).'</blockquote>';
		$output_end = '<strong>'.$lang['proxy_sample_sql'].':</strong><blockquote>';

		foreach ($ports as $port)
		{
			$fsock = fsockopen("tcp://$server_ip", $server_port, $errno, $errstr, $board_config['proxy_delay']);
			if (!$fsock)
			{
				$output_end = sprintf($lang['proxy_connect_error'],"$server_ip:$server_port",$errno,$errstr);
				$proxy['status'] = PROXY_ERROR;
				break;
			}

			if ($port == $last_port)
			{
				fputs($fsock,sprintf($http_request,"$port&debug=1"));

				$temp = '';

				while (!feof($fsock) && fgets($fsock, 1024) != "\r\n");
				while (!feof($fsock))
				{
					$temp .= fread($fsock, 1024);
				}
				$temp = explode("\r\n\r\n",$temp);
				$output_beg .= '<strong>'.$lang['proxy_sample_http_2'].':</strong><br /><blockquote>'.str_replace("\r\n",'<br />',htmlspecialchars($temp[0])).'</blockquote>';
				$output_end .= htmlspecialchars($temp[1]).'<br /></blockquote>';
			}
			else
			{
				fputs($fsock,sprintf($http_request,$port));
			}
			fclose($fsock);
		}

		$timeout = ini_get('max_execution_time');
		for ($num=0;$num < $timeout && $proxy['status'] < $num_ports;$num++)
		{
			sleep(1);
			$sql = "SELECT * FROM " . PROXY_TABLE . " 
				WHERE ip_address = '$encoded_ip'";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR,'Unable to load up-to-date proxy list',__FILE__,__LINE__,$sql);
			}
			$proxy = $db->sql_fetchrow($result);
		}
		if ($num == $timeout)
		{
			$output_end .= $lang['proxy_timeout'].'<br />';
		}

		$test_results = sprintf($lang['proxy_testing'],htmlspecialchars($decoded_ip)).'<br />';
		$test_results .= sprintf($lang['proxy_hostname'],gethostbyaddr($decoded_ip)).'</strong><br /> <br />';

		if ( $board_config['proxy_block'] && $proxy['status'] != PROXY_ERROR && $proxy['status'] > $num_ports )
		{
			$sql = "SELECT * FROM " . BANLIST_TABLE . " 
				WHERE ban_ip = '$encoded_ip'";
			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Unable to obtain banlist information', '', __LINE__, __FILE__, $sql);
			}
			if ( $board_config['proxy_ban'] && !$db->sql_numrows() )
			{
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
				$sql = "DELETE FROM " . SESSIONS_TABLE . " 
					WHERE session_ip = '$encoded_ip'";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR,'Unable to delete banned sessions from database',__FILE__,__LINE__,$sql);
				}
			}
			else if ($board_config['proxy_ban'])
			{
				$sql = "DELETE FROM " . PROXY_TABLE . " 
					WHERE ip_address = '$encoded_ip'";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR,'Unable to delete from proxy list',__FILE__,__LINE__,$sql);
				}
			}
			$test_results .= sprintf($lang['proxy_detected'],$lang['proxy_t'.($proxy['status']-PROXY_TRANSPARE)],hexdec($proxy['port']));
		}
		else
		{
			$test_results .= $lang['proxy_none'];
		}

		list($usec, $sec) = explode(' ', microtime());
		$timer_end = ((float) $usec + (float) $sec);
		$output_end .= '<strong>'.$lang['proxy_exec_time'].':</strong> '.sprintf('%.2Fms',$timer_end - $timer_start);

		$template->set_filenames(array(
			"body" => "admin/proxy_test_body.tpl")
		);

		$template->assign_vars(array(
			"L_TITLE" => $lang['proxy_title'], 
			"L_DESC" => $lang['proxy_desc'], 
			"L_TEST" => $lang['proxy_test'],
			"L_DEBUG" => $lang['proxy_debug'],
			// granted, not everyone may have a legit referer header in the HTTP requests they send out, but if they don't, then
			// the only real problem is that they won't necessarily be directed back to the page they came from.  ie. it's not a big
			// problem.
			"L_RETURN" => sprintf($lang['proxy_return'],"<a href=\"" . str_replace('&amp;','&',htmlspecialchars($_SERVER['HTTP_REFERER'])) . "\">","</a>"),

			"TEST" => $test_results,
			"DEBUG" => $output_beg.$output_end)
		);
		break;
	case 'delete':
		if( isset( $_GET['address']) || isset( $_POST['address']) )
		{
			$decoded_ip = ( isset( $_POST['address']) ) ? $_POST['address'] : $_GET['address'];
			$encoded_ip = encode_ip($decoded_ip);
		}
		else
		{
			message_die(GENERAL_ERROR,'No IP address specified');
		}

		$sql = "DELETE FROM " . PROXY_TABLE . " 
			WHERE ip_address = '$encoded_ip'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Unable to delete from proxy list', '', __LINE__, __FILE__, $sql);
		}

		$message = sprintf($lang['proxy_deleted'], $decoded_ip) . "<br /><br />" . sprintf($lang['proxy_return'],"<a href=\"" . append_sid("admin_proxy.php") . "\">","</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	case 'download':
		$sql = "SELECT * FROM " . PROXY_TABLE . "  
			WHERE status >= " . PROXY_TRANSPARE . " AND status <> " . PROXY_ERROR . " 
			ORDER BY last_checked DESC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,'Unable to load recently used proxies',__FILE__,__LINE__,$sql);
		}
		header("Pragma: no-cache");
		header("Content-Type: text/x-delimtext; name=\"addresses.txt\"");
		header("Content-disposition: attachment; filename=addresses.txt");
		if ( $row = $db->sql_fetchrow($result) )
		{
			do
			{
				echo decode_ip($row['ip_address']).':'.hexdec($row['port'])."\r\n";
			} while ( $row = $db->sql_fetchrow($result) );
		}
		exit;
	case 'list':
		// get starting position
		$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

		// get show amount
		if ( isset($_GET['show']) || isset($_POST['show']) )
		{
			$show = ( isset($_POST['show']) ) ? intval($_POST['show']) : intval($_GET['show']);
		}
		else
		{
			$show = $board_config['posts_per_page'];
		}

		list($temp_sort, $temp_sort_order) = explode(',',$board_config['proxy_sort']);

		// sort method
		if ( isset($_GET['sort']) || isset($_POST['sort']) )
		{
			$sort = ( isset($_POST['sort']) ) ? htmlspecialchars($_POST['sort']) : htmlspecialchars($_GET['sort']);
			$sort = str_replace("\'", "''", $sort);
		}
		else
		{
			$sort = $temp_sort;
		}

		// sort order
		if( isset($_POST['order']) )
		{
			$sort_order = ( $_POST['order'] == 'ASC' ) ? 'ASC' : 'DESC';
		}
		else if( isset($_GET['order']) )
		{
			$sort_order = ( $_GET['order'] == 'ASC' ) ? 'ASC' : 'DESC';
		}
		else
		{
			$sort_order = $temp_sort_order;
		}

		if ( $board_config['proxy_sort'] != "$sort,$sort_order" )
		{
			$sql = "UPDATE " . CONFIG_TABLE . " 
				SET config_value = '$sort,$sort_order' 
				WHERE config_name = 'proxy_sort'";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR,'Unable to update proxy sort options');
			}
		}

		$sql = "SELECT * 
			FROM " . PROXY_TABLE . " 
			ORDER BY $sort $sort_order
			LIMIT $start, $show";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,'Unable to load recently used proxies',__FILE__,__LINE__,$sql);
		}
		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				$ip_address = decode_ip($row['ip_address']);
				$template->assign_block_vars('proxyrow', array(
					'ROW_NUMBER' => $i + ($start + 1),
					'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
					'IP_ADDRESS' => $ip_address,
					'PORT' => hexdec($row['port']),
					'DATE' => create_date($board_config['default_dateformat'], $row['last_checked'], $board_config['board_timezone']),
					'TYPE' => $lang['proxy_t'.($row['status']-PROXY_TRANSPARE)],

					'U_CHECKPROXY' => append_sid("admin_proxy.$phpEx?mode=test&amp;address=$ip_address"),
					'U_DELPROXY' => append_sid("admin_proxy.$phpEx?mode=delete&amp;address=$ip_address"))
				);
				$i++;
			} while ( $row = $db->sql_fetchrow($result) );
		}

		$template->set_filenames(array(
			"body" => "admin/proxy_list_body.tpl")
		);

		$template->assign_vars(array(
			"S_LIST_ACTION" => append_sid("admin_proxy.$phpEx?mode=list"),
			"S_DOWNLOAD_ACTION" => append_sid("admin_proxy.$phpEx?mode=download"),

			'S_SHOW' => $show,
			'S_'.strtoupper($sort) => ' selected="selected"',
			'S_'.strtoupper($sort_order) => ' selected="selected"',

			"L_RETURN" => sprintf($lang['proxy_return'],"<a href=\"" . str_replace('&amp;','&',htmlspecialchars($_SERVER['HTTP_REFERER'])) . "\">","</a>"),
			"L_TITLE" => $lang['proxy_title'],
			"L_DESC" => $lang['proxy_desc'],
			'L_SORT_BY' => $lang['Sort_by'],
			'L_ASCENDING' => $lang['Sort_Ascending'],
			'L_DESCENDING' => $lang['Sort_Descending'],
			'L_SHOW' => $lang['proxy_show'],
			'S_SORT' => $lang['Sort'],
			"L_IP" => $lang['proxy_ip'],
			"L_CHECK" => $lang['proxy_check'],
			"L_DELETE" => $lang['Delete'],
			"L_DOWNLOAD" => $lang['proxy_download'],
			"L_VIEW_LIST" => $lang['proxy_view_list'],
			"L_PORT" => $lang['proxy_port'],
			"L_TYPE" => $lang['proxy_type'],
			"L_LAST_CHECKED" => $lang['proxy_last_checked'])
		);

		$count_sql = "SELECT count(ip_address) AS total 
			FROM " . PROXY_TABLE;

		if ( !($count_result = $db->sql_query($count_sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting totals from proxy list', '', __LINE__, __FILE__, $sql);
		}

		if ( $total = $db->sql_fetchrow($count_result) )
		{
			$total_addresses = $total['total'];

			$pagination = generate_pagination("admin_proxy.$phpEx?mode=list&amp;sort=$sort&amp;order=$sort_order&amp;show=$show", $total_addresses, $show, $start);
		}

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $show ) + 1 ), ceil( $total_addresses / $show )))
		);

		break;
	default:
		//
		// Pull all config data
		//
		$sql = "SELECT *
			FROM " . CONFIG_TABLE . " 
			WHERE config_name LIKE 'proxy_%'";

		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, "Could not query config information in admin_proxy", "", __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$config_name = $row['config_name'];
			$config_value = $row['config_value'];
			$default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;

			$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

			if ( isset($_POST['submit']) && $mode == 'settings' )
			{
				switch ($config_name)
				{
					case 'proxy_ports':
						// could use array_map with create_function...
						$temp = explode(',',preg_replace('/\s+/','',$new['proxy_ports']));
						$new['proxy_ports'] = '';
						for ($num=0;$num<count($temp);$num++)
						{
							$new['proxy_ports'] .= sprintf('%04x',$temp[$num]);
						}
						break;
					case 'proxy_cache_time':
						$new['proxy_cache_time'] = floor($new['proxy_cache_time']) * $_POST['proxy_cache_unit'];
						break;
					// could do this (and then remove a bunch of stripcslashes elsewhere), but then we'd have to use addcslashes, which is something I'd rather not do...
					//case 'proxy_user_agent':
					//	$new['proxy_user_agent'] = str_replace("\'","''",addslashes(stripcslashes($new['proxy_user_agent'])));
				}

				$sql = "UPDATE " . CONFIG_TABLE . " SET
					config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
					WHERE config_name = '$config_name'";
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
				}
			}
		}

		if( isset($_POST['submit']) && $mode == 'settings' )
		{
			$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['proxy_return'], "<a href=\"" . append_sid("admin_proxy.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}

		$enable_yes = ( $new['proxy_enable'] ) ? "checked=\"checked\"" : "";
		$enable_no = ( !$new['proxy_enable'] ) ? "checked=\"checked\"" : "";
		$ban_yes = ( $new['proxy_ban'] ) ? "checked=\"checked\"" : "";
		$ban_no = ( !$new['proxy_ban'] ) ? "checked=\"checked\"" : "";
		$log_enable_yes = ( $new['proxy_log_enable'] ) ? "checked=\"checked\"" : "";
		$log_enable_no = ( !$new['proxy_log_enable'] ) ? "checked=\"checked\"" : "";
		$block_yes = ( $new['proxy_block'] ) ? "checked=\"checked\"" : "";
		$block_no = ( !$new['proxy_block'] ) ? "checked=\"checked\"" : "";

		// could use the definition of $ports, as defined later, to define this, along with an extra implode, but this should be faster...
		$temp = '';
		do
		{
			$temp .= hexdec(substr($new['proxy_ports'],0,4)) . ', ';
			$new['proxy_ports'] = substr($new['proxy_ports'],4);
		}
		while (strlen($new['proxy_ports']) > 0);
		$new['proxy_ports'] = substr($temp,0,-2);

		$unit_secs = array(1,60,3600,86400,604800,2592000,315360000);
		$unit_names = array($lang['proxy_seconds'],$lang['proxy_minutes'],$lang['proxy_hours'],$lang['proxy_days'],$lang['proxy_weeks'],$lang['proxy_months'],$lang['proxy_years']);

		for ($selected = count($unit_secs) - 1; $selected >= 0 && $new['proxy_cache_time'] % $unit_secs[$selected] != 0; $selected--);
		$select_unit = '<select name="proxy_cache_unit">';
		for ($i = 0; $i < count($unit_secs); $i++)
		{
			$temp = ($i == $selected) ? ' selected="selected"' : '';
			$select_unit .= '<option value="' . $unit_secs[$i] . '"' . $temp . '>' . $unit_names[$i] . '</option>';
		}
		$select_unit .= '</select>';

		$sql = "SELECT * FROM " . PROXY_TABLE . "  
			WHERE status >= " . PROXY_TRANSPARE . " AND status <> " . PROXY_ERROR . " 
			ORDER BY last_checked DESC LIMIT 3";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,'Unable to load recently used proxies',__FILE__,__LINE__,$sql);
		}
		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				$ip_address = decode_ip($row['ip_address']);
				$template->assign_block_vars('proxyrow', array(
					'ROW_NUMBER' => $i + ($start + 1),
					'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
					'IP_ADDRESS' => $ip_address,
					'PORT' => hexdec($row['port']),
					'DATE' => create_date($board_config['default_dateformat'], $row['last_checked'], $board_config['board_timezone']),
					'TYPE' => $lang['proxy_t'.($row['status']-PROXY_TRANSPARE)],

					'U_CHECKPROXY' => append_sid("admin_proxy.$phpEx?mode=test&amp;address=$ip_address"),
					'U_DELPROXY' => append_sid("admin_proxy.$phpEx?mode=delete&amp;address=$ip_address"))
				);
				$i++;
			} while ( $row = $db->sql_fetchrow($result) );
		}

		$template->set_filenames(array(
			"body" => "admin/proxy_main_body.tpl")
		);

		$template->assign_vars(array(
			"S_CONFIG_ACTION" => append_sid("admin_proxy.$phpEx?mode=settings"), 
			"S_TEST_ACTION" => append_sid("admin_proxy.$phpEx?mode=test"), 
			"S_LIST_ACTION" => append_sid("admin_proxy.$phpEx?mode=list"),

			"L_YES" => $lang['Yes'],
			"L_NO" => $lang['No'],
			"L_TITLE" => $lang['proxy_title'],
			"L_DESC" => $lang['proxy_desc'],
			"L_TEST" => $lang['proxy_test'],
			"L_TEST_DESC" => $lang['proxy_test_desc'],
			"L_IP" => $lang['proxy_ip'],
			"L_PROXY_ENABLE" => $lang['proxy_enable'],
			"L_BAN" => $lang['proxy_ban'],
			"L_BAN_EXPLAIN" => $lang['proxy_ban_explain'],
			"L_TIMEOUT" => $lang['proxy_timeout'],
			"L_TIMEOUT_EXPLAIN" => $lang['proxy_timeout_explain'],
			"L_SECONDS" => $lang['proxy_seconds'],
			"L_PORTS" => $lang['proxy_ports'],
			"L_PORTS_EXPLAIN" => $lang['proxy_ports_explain'],
			"L_CACHE_TIME" => $lang['proxy_cache_time'],
			"L_CACHE_TIME_EXPLAIN" => $lang['proxy_cache_time_explain'],
			"L_USER_AGENT" => $lang['proxy_user_agent'],
			"L_USER_AGENT_EXPLAIN" => $lang['proxy_user_agent_explain'],
			"L_SETTINGS" => $lang['proxy_settings'],
			"L_CHECK" => $lang['proxy_check'],
			"L_DELETE" => $lang['Delete'],
			"L_VIEW_LIST" => $lang['proxy_view_list'],
			"L_PORT" => $lang['proxy_port'],
			"L_TYPE" => $lang['proxy_type'],
			"L_LAST_CHECKED" => $lang['proxy_last_checked'],
			"L_LIST_DESC" => $lang['proxy_list_desc'],

			"L_ENABLED" => $lang['Enabled'],
			"L_DISABLED" => $lang['Disabled'],
			"L_SUBMIT" => $lang['Submit'],
			"L_RESET" => $lang['Reset'],
	
			"ENABLE" => $enable_yes,
			"DISABLE" => $enable_no,
			"BAN_YES" => $ban_yes,
			"BAN_NO" => $ban_no,
			"LOG_ENABLE_YES" => $log_enable_yes, 
			"LOG_DISABLE" => $log_enable_no, 
			"BLOCK_YES" => $block_yes, 
			"BLOCK_NO" => $block_no, 
			"CACHE_TIME" => $new['proxy_cache_time'] / $unit_secs[$selected],
			"TIMEOUT" => $new['proxy_delay'], 
			"PORTS" => $new['proxy_ports'],
			"USER_AGENT" => $new['proxy_user_agent'],
			"SELECT_UNIT" => $select_unit,

			"U_IP" => decode_ip($user_ip))
		);
}

include_once('./page_header_admin.'.$phpEx);

$template->pparse("body");

include_once('./page_footer_admin.'.$phpEx);

?>
