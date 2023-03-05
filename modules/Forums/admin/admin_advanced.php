<?php

define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Advanced ACP'][$lang[aacp_mod1]] = $filename."?panel=aacp";
	$module['Advanced ACP'][$lang[aacp_class]] = "index.".$phpEx."?pane=right";
	$module['Advanced ACP'][$lang[aacp_who]] = $filename."?panel=whois";
	$module['Advanced ACP'][$lang[aacp_stat]] = $filename."?panel=stat";
	$module['Advanced ACP'][$lang[aacp_phpinfo]] = $filename."?panel=phpinfo";
	return;
}
$no_page_header = TRUE;
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
global $admin_file;
// ---------------
// Begin functions (taken from original phpBB Index File!)
//
function inarray1($needle, $haystack)
{
	for($i = 0; $i < sizeof($haystack); $i++ )
	{
		if( $haystack[$i] == $needle )
		{
			return true;
		}
	}
	return false;
}
//
// End functions
// -------------



  if ($_GET[panel] == 'aacp')
    {

		$template->set_filenames(array(
			'body' => 'admin/admin_advanced.tpl'
			)
		);
  	  include_once('./page_header_admin.'.$phpEx);
      $aacphead = $lang['aacp_header1'];
      $aacphead2 = '';
      $aacpfoot = $lang['aacp_body1'];
  	 $template->assign_vars(array(
  		'IMG_AACP_K1' => $images['aacp_k1'],
  		'IMG_AACP_K2' => $images['aacp_k2'],
  		'IMG_AACP_K3' => $images['aacp_k3'],
  		'IMG_AACP_K4' => $images['aacp_k4'],
  		'L_AACP_KAT1' => $lang['aacp_kat1'],
  		'L_AACP_KAT2' => $lang['aacp_kat2'],
  		'L_AACP_KAT3' => $lang['aacp_kat3'],
  		'L_AACP_KAT4' => $lang['aacp_kat4'],
  		'L_AACP_KAT1_N1' => $lang['aacp_kat1_n1'],
  		'L_AACP_KAT1_N2' => $lang['aacp_kat1_n2'],
  		'L_AACP_KAT1_N3' => $lang['aacp_kat1_n3'],
  		'L_AACP_KAT1_N4' => $lang['aacp_kat1_n4'],
  		'L_AACP_KAT1_N5' => $lang['aacp_kat1_n5'],
  		'L_AACP_KAT1_N6' => $lang['aacp_kat1_n6'],
  		'L_AACP_KAT1_N7' => $lang['aacp_kat1_n7'],
  		'L_AACP_KAT1_N8' => $lang['aacp_kat1_n8'],
  		'L_AACP_KAT2_N1' => $lang['aacp_kat2_n1'],
  		'L_AACP_KAT2_N2' => $lang['aacp_kat2_n2'],
  		'L_AACP_KAT2_N3' => $lang['aacp_kat2_n3'],
  		'L_AACP_KAT2_N4' => $lang['aacp_kat2_n4'],
  		'L_AACP_KAT2_N5' => $lang['aacp_kat2_n5'],
  		'L_AACP_KAT2_N6' => $lang['aacp_kat2_n6'],
  		'L_AACP_KAT2_N7' => $lang['aacp_kat2_n7'],
  		'L_AACP_KAT3_N1' => $lang['aacp_kat3_n1'],
  		'L_AACP_KAT3_N2' => $lang['aacp_kat3_n2'],
  		'L_AACP_KAT3_N3' => $lang['aacp_kat3_n3'],
  		'L_AACP_KAT3_N4' => $lang['aacp_kat3_n4'],
  		'L_AACP_KAT4_N1' => $lang['aacp_kat4_n1'],
  		'L_AACP_KAT4_N2' => $lang['aacp_kat4_n2'],
  		'L_AACP_KAT4_N3' => $lang['aacp_kat4_n3'],
  		'L_AACP_KAT4_N4' => $lang['aacp_kat4_n4'],
  		'L_AACP_KAT4_N5' => $lang['aacp_kat4_n5'],
  		'U_AACP_KAT1_N1' => append_sid("admin_user_ban.$phpEx"),
  		'U_AACP_KAT1_N2' => append_sid("admin_ug_auth.$phpEx?mode=user"),
  		'U_AACP_KAT1_N3' => append_sid("admin_users.$phpEx"),
  		'U_AACP_KAT1_N4' => append_sid("admin_groups.$phpEx"),
  		'U_AACP_KAT1_N5' => append_sid("admin_ug_auth.$phpEx?mode=group"),
  		'U_AACP_KAT1_N6' => append_sid("admin_userlist.$phpEx"),
  		'U_AACP_KAT1_N7' => append_sid("admin_advanced_username_color.$phpEx"),
  		'U_AACP_KAT1_N8' => append_sid("admin_advanced_username_color_m.$phpEx"),
  		'U_AACP_KAT2_N1' => append_sid("admin_board.$phpEx"),
  		'U_AACP_KAT2_N2' => append_sid("admin_forums.$phpEx"),
  		'U_AACP_KAT2_N3' => append_sid("admin_forumauth.$phpEx"),
  		'U_AACP_KAT2_N4' => append_sid("admin_attachments.$phpEx?mode=manage"),
  		'U_AACP_KAT2_N5' => append_sid("admin_arcade.$phpEx"),
  		'U_AACP_KAT2_N6' => append_sid("admin_theme_reset.$phpEx"),
  		'U_AACP_KAT2_N7' => append_sid("admin_session_repair.$phpEx"),
  		'U_AACP_KAT3_N1' => append_sid("admin_ranks.$phpEx"),
  		'U_AACP_KAT3_N2' => append_sid("admin_smilies.$phpEx"),
  		'U_AACP_KAT3_N3' => append_sid("admin_proxy.$phpEx"),
  		'U_AACP_KAT3_N4' => append_sid("admin_priv_msgs.$phpEx"),
  		'U_AACP_KAT4_N1' => append_sid("admin_Platinummyadmin.$phpEx"),
  		'U_AACP_KAT4_N2' => append_sid("admin_advanced.$phpEx?panel=whois"),
  		'U_AACP_KAT4_N3' => append_sid("admin_advanced.$phpEx?panel=stat"),
  		'U_AACP_KAT4_N4' => append_sid("admin_advanced.$phpEx?panel=phpinfo"),
  		'U_AACP_KAT4_N5' => ("../../../".$admin_file.".php?op=backup"),
  		'AACP_HEADER' => $aacphead,
		'AACP_HEAD2' => $aacphead2,
		'AACP_AUSGABE' => $ausgabe,
		'AACP_INFO_TEXT' => $aacpfoot));

    }
  else if ($_GET[panel] == 'whois')
    {
		$template->set_filenames(array(
			'body' => 'admin/admin_adv_whois.tpl'
			)
		);
  	  include_once('./page_header_admin.'.$phpEx);
	  $aacphead = $lang['aacp_header3'];
	  $aacphead2 = $lang['who_is_online'];
	  $aacpfoot = $lang['aacp_body3'];
	//
	// Get users online information. (Taken from Original phpBB Index File!)
	//
	$sql = "SELECT u.user_id, u.username, u.user_session_time, u.user_session_page, s.session_logged_in, s.session_ip, s.session_start
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
		WHERE s.session_logged_in = " . TRUE . "
			AND u.user_id = s.session_user_id
			AND u.user_id <> " . ANONYMOUS . "
			AND s.session_time >= " . ( time() - 300 ) . "
		ORDER BY u.user_session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain regd user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_reg = $db->sql_fetchrowset($result);

	$sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start
		FROM " . SESSIONS_TABLE . "
		WHERE session_logged_in = 0
			AND session_time >= " . ( time() - 300 ) . "
		ORDER BY session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain guest user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_guest = $db->sql_fetchrowset($result);

	$sql = "SELECT forum_name, forum_id
		FROM " . FORUMS_TABLE;
	if($forums_result = $db->sql_query($sql))
	{
		while($forumsrow = $db->sql_fetchrow($forums_result))
		{
			$forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, "Couldn't obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
	}

	$reg_userid_ary = array();

	if( count($onlinerow_reg) )
	{
		$registered_users = 0;

		for($i = 0; $i < count($onlinerow_reg); $i++)
		{
			if( !inarray1($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
			{
				$reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

				$username = $onlinerow_reg[$i]['username'];

				if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$registered_users++;
					$hidden = FALSE;
				}
				else
				{
					$hidden_users++;
					$hidden = TRUE;
				}

				if( $onlinerow_reg[$i]['user_session_page'] < 1 )
				{
					switch($onlinerow_reg[$i]['user_session_page'])
					{
						case PAGE_INDEX:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_POSTING:
							$location = $lang['Posting_message'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_LOGIN:
							$location = $lang['Logging_on'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_SEARCH:
							$location = $lang['Searching_forums'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PROFILE:
							$location = $lang['Viewing_profile'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWONLINE:
							$location = $lang['Viewing_online'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWMEMBERS:
							$location = $lang['Viewing_member_list'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PRIVMSGS:
							$location = $lang['Viewing_priv_msgs'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_FAQ:
							$location = $lang['Viewing_FAQ'];
							$location_url = "index.$phpEx?pane=right";
							break;
						default:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
					}
				}
				else
				{
					$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
					$location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
				}

				$row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

				$reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

				$template->assign_block_vars("reg_user_row", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,
					"USERNAME" => $username,
					"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']),
					"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
					"FORUM_LOCATION" => $location,
					"IP_ADDRESS" => $reg_ip,

					"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$reg_ip",
					"U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
					"U_FORUM_LOCATION" => append_sid($location_url))
				);
			}
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	//
	// Guest users
	//
	if( count($onlinerow_guest) )
	{
		$guest_users = 0;

		for($i = 0; $i < count($onlinerow_guest); $i++)
		{
			$guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
			$guest_users++;

			if( $onlinerow_guest[$i]['session_page'] < 1 )
			{
				switch( $onlinerow_guest[$i]['session_page'] )
				{
					case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "index.$phpEx?pane=right";
						break;
					default:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
				}
			}
			else
			{
				$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
				$location = $forum_data[$onlinerow_guest[$i]['session_page']];
			}

			$row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

			$guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

			$template->assign_block_vars("guest_user_row", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"USERNAME" => $lang['Guest'],
				"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']),
				"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
				"FORUM_LOCATION" => $location,
				"IP_ADDRESS" => $guest_ip,

				"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$guest_ip",
				"U_FORUM_LOCATION" => append_sid($location_url))
			);
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_GUESTS_BROWSING" => $lang['No_users_browsing'])
		);
    }
         // Template Variablen hinzufügen
  	 $template->assign_vars(array(
		"NUMBER_OF_POSTS" => $total_posts,
		"GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'],
		"NUMBER_OF_TOPICS" => $total_topics,
		"NUMBER_OF_USERS" => $total_users,
		"START_DATE" => $start_date,
		"POSTS_PER_DAY" => $posts_per_day,
		"TOPICS_PER_DAY" => $topics_per_day,
		"USERS_PER_DAY" => $users_per_day,
		"AVATAR_DIR_SIZE" => $avatar_dir_size,
		"DB_SIZE" => $dbsize,
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_FORUM_STATS" => $lang['Forum_stats'],
		"L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_STATISTIC" => $lang['Statistic'],
		"L_VALUE" => $lang['Value'],
		"L_NUMBER_POSTS" => $lang['Number_posts'],
		"L_POSTS_PER_DAY" => $lang['Posts_per_day'],
		"L_NUMBER_TOPICS" => $lang['Number_topics'],
		"L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
		"L_NUMBER_USERS" => $lang['Number_users'],
		"L_USERS_PER_DAY" => $lang['Users_per_day'],
		"L_BOARD_STARTED" => $lang['Board_started'],
		"L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
		"L_DB_SIZE" => $lang['Database_size'],
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'],
		"L_GZIP_COMPRESSION" => $lang['Gzip_compression'],
  		"AACP_HEADER" => $aacphead,
		"AACP_HEAD2" => $aacphead2,
		"AACP_AUSGABE" => $ausgabe,
		"AACP_INFO_TEXT" => $aacpfoot));
    }
  else if ($_GET[panel] == 'stat')
    {
		$template->set_filenames(array(
			'body' => 'admin/admin_adv_stat.tpl'
			)
		);
  	  include_once('./page_header_admin.'.$phpEx);
	  $aacphead = $lang['aacp_header4'];
	  $aacphead2 = '';
	  $aacpfoot = $lang['aacp_body4'];

     // Template Variablen hinzufügen
  	 $template->assign_vars(array(
		"NUMBER_OF_POSTS" => $total_posts,
		"GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'],
		"NUMBER_OF_TOPICS" => $total_topics,
		"NUMBER_OF_USERS" => $total_users,
		"START_DATE" => $start_date,
		"POSTS_PER_DAY" => $posts_per_day,
		"TOPICS_PER_DAY" => $topics_per_day,
		"USERS_PER_DAY" => $users_per_day,
		"AVATAR_DIR_SIZE" => $avatar_dir_size,
		"DB_SIZE" => $dbsize,
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_FORUM_STATS" => $lang['Forum_stats'],
		"L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_STATISTIC" => $lang['Statistic'],
		"L_VALUE" => $lang['Value'],
		"L_NUMBER_POSTS" => $lang['Number_posts'],
		"L_POSTS_PER_DAY" => $lang['Posts_per_day'],
		"L_NUMBER_TOPICS" => $lang['Number_topics'],
		"L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
		"L_NUMBER_USERS" => $lang['Number_users'],
		"L_USERS_PER_DAY" => $lang['Users_per_day'],
		"L_BOARD_STARTED" => $lang['Board_started'],
		"L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
		"L_DB_SIZE" => $lang['Database_size'],
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'],
		"L_GZIP_COMPRESSION" => $lang['Gzip_compression'],
  		"AACP_HEADER" => $aacphead,
		"AACP_HEAD2" => $aacphead2,
		"AACP_AUSGABE" => $ausgabe,
		"AACP_INFO_TEXT" => $aacpfoot));
 
        //
        // Get forum statistics
        //
        $total_posts = get_db_stat('postcount');
        $total_users = get_db_stat('usercount');
        $total_topics = get_db_stat('topiccount');

        $start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

        $boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

        $posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
        $topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
        $users_per_day = sprintf("%.2f", $total_users / $boarddays);

        $avatar_dir_size = 0;

        if ($avatar_dir = @opendir($phpbb_root_path . $board_config['avatar_path']))
        {
                while( $file = @readdir($avatar_dir) )
                {
                        if( $file != "." && $file != ".." )
                        {
                                $avatar_dir_size += @filesize($phpbb_root_path . $board_config['avatar_path'] . "/" . $file);
                        }
                }
                @closedir($avatar_dir);

                //
                // This bit of code translates the avatar directory size into human readable format
                // Borrowed the code from the PHP.net annoted manual, origanally written by:
                // Jesse (jesse@jess.on.ca)
                //
                if($avatar_dir_size >= 1048576)
                {
                        $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
                }
                else if($avatar_dir_size >= 1024)
                {
                        $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
                }
                else
                {
                        $avatar_dir_size = $avatar_dir_size . " Bytes";
                }

        }
        else
        {
                // Couldn't open Avatar dir.
                $avatar_dir_size = $lang['Not_available'];
        }

        if($posts_per_day > $total_posts)
        {
                $posts_per_day = $total_posts;
        }

        if($topics_per_day > $total_topics)
        {
                $topics_per_day = $total_topics;
        }

        if($users_per_day > $total_users)
        {
                $users_per_day = $total_users;
        }

        //
        // DB size ... MySQL only
        //
        // This code is heavily influenced by a similar routine
        // in phpMyAdmin 2.2.0
        //
        if( preg_match("/^mysql/", SQL_LAYER) )
        {
                $sql = "SELECT VERSION() AS mysql_version";
                if($result = $db->sql_query($sql))
                {
                        $row = $db->sql_fetchrow($result);
                        $version = $row['mysql_version'];

                        if( preg_match("/^(3\.23|4\.)/", $version) )
                        {
                                $db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)/", $version) ) ? "`$dbname`" : $dbname;

                                $sql = "SHOW TABLE STATUS
                                        FROM " . $db_name;
                                if($result = $db->sql_query($sql))
                                {
                                        $tabledata_ary = $db->sql_fetchrowset($result);

                                        $dbsize = 0;
                                        for($i = 0; $i < count($tabledata_ary); $i++)
                                        {
                                                if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
                                                {
                                                        if( $table_prefix != "" )
                                                        {
                                                                if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
                                                                {
                                                                        $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                                                                }
                                                        }
                                                        else
                                                        {
                                                                $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                                                        }
                                                }
                                        }
                                } // Else we couldn't get the table status.
                        }
                        else
                        {
                                $dbsize = $lang['Not_available'];
                        }
                }
                else
                {
                        $dbsize = $lang['Not_available'];
                }
        }
        else if( preg_match("/^mssql/", SQL_LAYER) )
        {
                $sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize
                        FROM sysfiles";
                if( $result = $db->sql_query($sql) )
                {
                        $dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
                }
                else
                {
                        $dbsize = $lang['Not_available'];
                }
        }
        else
        {
                $dbsize = $lang['Not_available'];
        }

        if ( is_integer($dbsize) )
        {
                if( $dbsize >= 1048576 )
                {
                        $dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
                }
                else if( $dbsize >= 1024 )
                {
                        $dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
                }
                else
                {
                        $dbsize = sprintf("%.2f Bytes", $dbsize);
                }
        }

        $template->assign_vars(array(
                "NUMBER_OF_POSTS" => $total_posts,
                "NUMBER_OF_TOPICS" => $total_topics,
                "NUMBER_OF_USERS" => $total_users,
                "START_DATE" => $start_date,
                "POSTS_PER_DAY" => $posts_per_day,
                "TOPICS_PER_DAY" => $topics_per_day,
                "USERS_PER_DAY" => $users_per_day,
                "AVATAR_DIR_SIZE" => $avatar_dir_size,
                "DB_SIZE" => $dbsize,
                "GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
        );
        //
        // End forum statistics
        //

    }
  else if ($_GET[panel] == 'phpinfo')
    {
      // PHP Info Generieren und Formatieren
      $aacphead = $lang['aacp_header5'];
   	  ob_start();
   	  phpinfo();
   	  $php_info .= ob_get_contents();
   	  ob_end_clean();
   	  $aacphead2 = $lang['aacp_header5'];
	  preg_match_all('#<body[^>]*>(.*)</body>#siU', $php_info, $ausgabe);
	  $ausgabe = preg_replace('#<table#', '<table class="bg"', $ausgabe[1][0]);
	  $ausgabe = preg_replace('# bgcolor="\#(\w){6}"#', '', $ausgabe);
	  $ausgabe = preg_replace('#(\w),(\w)#', '\1, \2', $ausgabe);
	  $ausgabe = preg_replace('#border="0" cellpadding="3" cellspacing="1" width="600"#', 'border="0" cellspacing="1" cellpadding="4" width="95%"', $ausgabe);
	  $ausgabe = preg_replace('#<tr valign="top"><td align="left">(.*?<a .*?</a>)(.*?)</td></tr>#s', '<tr class="row1"><td style="{background-color: #9999cc;}"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td style="{background-color: #9999cc;}">\2</td><td style="{background-color: #9999cc;}">\1</td></tr></table></td></tr>', $ausgabe);
	  $ausgabe = preg_replace('#<tr valign="baseline"><td[ ]{0,1}><strong>(.*?)</strong>#', '<tr><td class="row1" nowrap="nowrap">\1', $ausgabe);
	  $ausgabe = preg_replace('#<td align="(center|left)">#', '<td class="row2">', $ausgabe);
	  $ausgabe = preg_replace('#<td>#', '<td class="row2">', $ausgabe);
	  $ausgabe = preg_replace('#valign="middle"#', '', $ausgabe);
	  $ausgabe = preg_replace('#<tr >#', '<tr>', $ausgabe);
	  $ausgabe = preg_replace('#<hr(.*?)>#', '', $ausgabe);
	  $ausgabe = preg_replace('#<h1 align="center">#i', '<h1>', $ausgabe);
	  $ausgabe = preg_replace('#<h2 align="center">#i', '<h2>', $ausgabe);
   	  $ausgabe = "<td class=row3>".$php_info."</td>";
   	  $aacpfoot = $lang['aacp_body5'];
   	  $template->set_filenames(array(
		'body' => 'admin/admin_adv_pinfo.tpl'
		)
	  );
  	  include_once('./page_header_admin.'.$phpEx);
     // Template Variablen hinzufügen
  	 $template->assign_vars(array(
  		'AACP_HEADER' => $aacphead,
		'AACP_HEAD2' => $aacphead2,
		'AACP_AUSGABE' => $ausgabe,
		'AACP_INFO_TEXT' => $aacpfoot));
    }

  // Seite erzeugen
  $template->pparse('body');
  include_once('./page_footer_admin.'.$phpEx);
?>