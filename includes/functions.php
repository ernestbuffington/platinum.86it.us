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
if ( !defined('IN_PHPBB') )
{
        die("Hacking attempt");
        exit;
}
   // Added by Attached Forums MOD
function check_unread($forum_id)
{
global $new_topic_data, $tracking_topics, $tracking_forums, $_COOKIE, $board_config;
   if ( !empty($new_topic_data[$forum_id]) )
   {
      $forum_last_post_time = 0;
      while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
      {
         if ( empty($tracking_topics[$check_topic_id]) )
         {
            $unread_topics = true;
            $forum_last_post_time = max($check_post_time, $forum_last_post_time);
         }
         else
         {
            if ( $tracking_topics[$check_topic_id] < $check_post_time )
            {
               $unread_topics = true;
               $forum_last_post_time = max($check_post_time, $forum_last_post_time);
            }
         }
      }
      if ( !empty($tracking_forums[$forum_id]) )
      {
         if ( $tracking_forums[$forum_id] > $forum_last_post_time )
         {
            $unread_topics = false;
         }
      }
      if ( isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
      {
         if ( $_COOKIE[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
         {
            $unread_topics = false;
         }
      }
   }
return $unread_topics;
}
   // END Added by Attached Forums MOD
function get_db_stat($mode)
{
	global $db;
	switch( $mode )
	{
		case 'usercount':
			$sql = "SELECT COUNT(user_id) AS total
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS;
			break;
		case 'newestuser':
			$sql = "SELECT user_id, username
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS . "
				ORDER BY user_id DESC
				LIMIT 1";
			break;
		case 'postcount':
		case 'topiccount':
			$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
				FROM " . FORUMS_TABLE;
			break;
	}
	if ( !($result = $db->sql_query($sql)) )
	{
		return false;
	}
	$row = $db->sql_fetchrow($result);
	switch ( $mode )
	{
		case 'usercount':
			return $row['total'];
			break;
		case 'newestuser':
			return $row;
			break;
		case 'postcount':
			return $row['post_total'];
			break;
		case 'topiccount':
			return $row['topic_total'];
			break;
	}
	return false;
}
// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username)
{
	$username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
	$username = phpbb_rtrim($username, "\\");	
	$username = str_replace("'", "\'", $username);
	return $username;
}
/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return ltrim($str);
	}
	$php_version = explode('.', PHP_VERSION);
	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{0} == $charlist)
		{
			$str = substr($str, 1);
		}
	}
	else
	{
		$str = ltrim($str, $charlist);
	}
	return $str;
}
/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand()
{
	global $db, $board_config, $dss_seeded;
	$val = $board_config['rand_seed'] . microtime();
	$val = md5($val);
	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');
	if($dss_seeded !== true)
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
		}
		$dss_seeded = true;
	}
	return substr($val, 4, 16);
}
// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return rtrim($str);
	}
	$php_version = explode('.', PHP_VERSION);
	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{strlen($str)-1} == $charlist)
		{
			$str = substr($str, 0, strlen($str)-1);
		}
	}
	else
	{
		$str = rtrim($str, $charlist);
	}
	return $str;
}
//
// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
//
function get_userdata($user, $force_str = false)
{
	global $db;
	if (!is_numeric($user) || $force_str)
	{
		$user = phpbb_clean_username($user);
	}
	else
	{
		$user = intval($user);
	}
	$sql = "SELECT *
                FROM " . USERS_TABLE . "
		WHERE ";
	$sql .= ( ( is_integer($user) ) ? "user_id = $user" : "username = '" .  str_replace("\'", "''", $user) . "'" ) . " AND user_id <> " . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
	}
	return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}
function make_jumpbox($action, $match_forum_id = 0)
{
	global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID, $userdata;
        global $parent_lookup;
//	$is_auth = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
	$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
		FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
		WHERE f.cat_id = c.cat_id
		".(($userdata['user_level'] == ADMIN)? "" : "AND c.cat_title<>'global_announcement'" )."
		GROUP BY c.cat_id, c.cat_title, c.cat_order
		ORDER BY c.cat_order";
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain category list.", "", __LINE__, __FILE__, $sql);
	}
	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$category_rows[] = $row;
	}
	if ( $total_categories = count($category_rows) )
	{
		$sql = "SELECT *
			FROM " . FORUMS_TABLE . "
			ORDER BY cat_id, forum_order";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}
		$boxstring = '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"><option value="-1">' . $lang['Select_forum'] . '</option>';
		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_rows[] = $row;
		}
		if ( $total_forums = count($forum_rows) )
		{
			for($i = 0; $i < $total_categories; $i++)
			{
				$boxstring_forums = '';
				for($j = 0; $j < $total_forums; $j++)
				{
						if ($parent_lookup==$forum_rows[$j]['forum_id'] && !$assigned)
						{
							$template->assign_block_vars('switch_parent_link', array() );
							$template->assign_vars(array(
								'PARENT_NAME' => $forum_rows[$j]['forum_name'],
								'PARENT_URL'=>append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id'])
								));
							$assigned=TRUE;
						}
					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG )
					{
//					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth[$forum_rows[$j]['forum_id']]['auth_view'] )
//					{
						$selected = ( $forum_rows[$j]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
						$boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';
						//
						// Add an array to $nav_links for the Mozilla navigation bar.
						// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
						//
						$nav_links['chapter forum'][$forum_rows[$j]['forum_id']] = array (
							'url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id']),
							'title' => $forum_rows[$j]['forum_name']
						);
					}
				}
				if ( $boxstring_forums != '' )
				{
					$boxstring .= '<option value="-1">&nbsp;</option>';
					$boxstring .= '<option value="-1">' . $category_rows[$i]['cat_title'] . '</option>';
					$boxstring .= '<option value="-1">----------------</option>';
					$boxstring .= $boxstring_forums;
				}
			}
		}
		$boxstring .= '</select>';
	}
	else
	{
		$boxstring .= '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"></select>';
	}
	// Let the jumpbox work again in sites having additional session id checks.
//	if ( !empty($SID) )
//	{
		$boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//	}
	$template->set_filenames(array(
		'jumpbox' => 'jumpbox.tpl')
	);
	$template->assign_vars(array(
		'L_GO' => $lang['Go'],
		'L_JUMP_TO' => $lang['Jump_to'],
		'L_SELECT_FORUM' => $lang['Select_forum'],
		'S_JUMPBOX_SELECT' => $boxstring,
		'S_JUMPBOX_ACTION' => append_sid($action))
	);
	$template->assign_var_from_handle('JUMPBOX', 'jumpbox');
	return;
}
//
// Initialise user settings on page load
function init_userprefs($userdata)
{
	global $board_config, $theme, $images;
	global $template, $lang, $phpEx, $phpbb_root_path, $db;
	global $nav_links;
	if ( $userdata['user_id'] != ANONYMOUS )
	{
		if ( !empty($userdata['user_lang']))
		{
                  $default_lang = phpbb_ltrim(basename(phpbb_rtrim($userdata['user_lang'])), "'");
		}
		if ( !empty($userdata['user_dateformat']) )
		{
			$board_config['default_dateformat'] = $userdata['user_dateformat'];
		}
		if ( isset($userdata['user_timezone']) )
		{
			$board_config['board_timezone'] = $userdata['user_timezone'];
		}
	}
	else
	{
		$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
	}
	if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
	{
		if ( $userdata['user_id'] != ANONYMOUS )
		{
			// For logged in users, try the board default language next
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
		}
		else
		{
			// For guests it means the default language is not present, try english
			// This is a long shot since it means serious errors in the setup to reach here,
			// but english is part of a new install so it's worth us trying
			$default_lang = 'english';
		}
		if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
		{
			message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
		}
	}
	// If we've had to change the value in any way then let's write it back to the database
	// before we go any further since it means there is something wrong with it
	if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_lang = '" . $default_lang . "'
			WHERE user_lang = '" . $userdata['user_lang'] . "'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}
		$userdata['user_lang'] = $default_lang;
	}
	elseif ( $userdata['user_id'] == ANONYMOUS && $board_config['default_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "
			SET config_value = '" . $default_lang . "'
			WHERE config_name = 'default_lang'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}
	}
	$board_config['default_lang'] = $default_lang;
	include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);
	if ( defined('IN_CASHMOD') )
	{
		if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cash.'.$phpEx)) )
		{
			include_once($phpbb_root_path . 'language/lang_english/lang_cash.' . $phpEx);
		}
		else
		{
			include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cash.' . $phpEx);
		}
	}
	if ( defined('IN_ADMIN') )
	{
		if( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx)) )
		{
			$board_config['default_lang'] = 'english';
		}
		include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
	}
include_attach_lang();
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
//-- mod : language settings ---------------------------------------------------
//-- add
	include($phpbb_root_path . 'includes/lang_extend_mac.' . $phpEx);
//-- fin mod : language settings -----------------------------------------------
                //
                // Set up style
                //
                if ( !$board_config['override_user_style'] )
                {
                        if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
                        {
                                if ( $theme = setup_style($userdata['user_style']) )
                                {
                                        return;
                                }
                        }
                }
                $theme = setup_style($board_config['default_style']);
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
	//
	// Mozilla navigation bar
	// Default items that should be valid on all pages.
	// Defined here to correctly assign the Language Variables
	// and be able to change the variables within code.
	//
        $nav_links['top'] = array (
		'url' => append_sid($phpbb_root_path . 'index.' . $phpEx),
		'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
	);
        $nav_links['search'] = array (
		'url' => append_sid($phpbb_root_path . 'search.' . $phpEx),
		'title' => $lang['Search']
	);
        $nav_links['help'] = array (
		'url' => append_sid($phpbb_root_path . 'faq.' . $phpEx),
		'title' => $lang['FAQ']
	);
        $nav_links['author'] = array (
		'url' => append_sid($phpbb_root_path . 'memberlist.' . $phpEx),
		'title' => $lang['Memberlist']
	);
	return;
}
function setup_style($style)
{
	global $db, $prefix, $board_config, $template, $images, $phpbb_root_path, $name;
        if($name == "Forums"){
                cookiedecode($user);
            $info=$db->sql_query("select * from ".$prefix."_bbconfig where config_name='default_style'");
            $get_info=$db->sql_fetchrow($info);
            $default_style=$get_info[config_value];
            if($cookie[1] == "" AND $style != "$default_style") {
                $style = "$default_style";
            }
        }
	$sql = 'SELECT *
		FROM ' . THEMES_TABLE . '
		WHERE themes_id = ' . (int) $style;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query database for theme info');
	}
	if ( !($row = $db->sql_fetchrow($result)) )
	{
		// We are trying to setup a style which does not exist in the database
		// Try to fallback to the board default (if the user had a custom style)
		// and then any users using this style to the default if it succeeds
		if ( $style != $board_config['default_style'])
		{
			$sql = 'SELECT *
				FROM ' . THEMES_TABLE . '
				WHERE themes_id = ' . (int) $board_config['default_style'];
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, 'Could not query database for theme info');
			}
			if ( $row = $db->sql_fetchrow($result) )
			{
				$db->sql_freeresult($result);
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_style = ' . (int) $board_config['default_style'] . "
					WHERE user_style = $style";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, 'Could not update user theme info');
				}
			}
			else
			{
				message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
			}
		}
		else
		{
			message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
		}
	}
        $ThemeSel = get_theme();
        if (file_exists("themes/$ThemeSel/forums/index_body.tpl")) {
                $template_path = "themes/$ThemeSel/";
            $template_name = "forums";
            $template = new Template($template_path . $template_name, $board_config, $db);
        } else {
	$template_path = 'templates/' ;
	$template_name = $row['template_name'] ;
            $template = new Template($phpbb_root_path . $template_path . $template_name, $board_config, $db);
        }
	if ( $template )
	{
		$current_template_path = $template_path . $template_name;
                $ThemeSel = get_theme();
                if (file_exists("themes/$ThemeSel/$template_name/index_body.tpl")) {
                    include_once($template_path . $template_name . '/' . $template_name . '.cfg');
                } else {
		include_once($phpbb_root_path . $template_path . $template_name . '/' . $template_name . '.cfg');
                }
		if ( !defined('TEMPLATE_CONFIG') )
		{
			message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
		}
		$img_lang = ( file_exists(@phpbb_realpath($phpbb_root_path . $current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';
		while( list($key, $value) = @each($images) )
		{
			if ( !is_array($value) )
			{
				$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
			}
		}
	}
	return $row;
}
function encode_ip($dotquad_ip)
{
	$ip_sep = explode('.', $dotquad_ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}
function decode_ip($int_ip)
{
	$hexipbang = explode('.', chunk_split($int_ip, 2, '.'));
	return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}
//
// Create date/time from format and timezone
//
function create_date($format, $gmepoch, $tz)
{
	global $board_config, $lang;
	static $translate;
	if ( empty($translate) && $board_config['default_lang'] != 'english' )
	{
		@reset($lang['datetime']);
		while ( list($match, $replace) = @each($lang['datetime']) )
		{
			$translate[$match] = $replace;
		}
	}
	return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
}
//
// Pagination routine, generates
// page number sequence
//
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE)
{
	global $lang;
	$total_pages = ceil($num_items/$per_page);
	if ( $total_pages == 1 )
	{
		return '';
	}
	$on_page = floor($start_item / $per_page) + 1;
	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <  $init_page_max )
			{
				$page_string .= ", ";
			}
		}
		if ( $total_pages > 3 )
		{
			if ( $on_page > 1  && $on_page < $total_pages )
			{
				$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
				$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
				$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;
				for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
				{
                    
					$page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
					if ( $i <  $init_page_max + 1 )
					{
						$page_string .= ', ';
					}
				}
				$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
			}
			else
			{
				$page_string .= ' ... ';
			}
			for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
			{
				$page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>'  : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
				if( $i <  $total_pages )
				{
					$page_string .= ", ";
				}
			}
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <  $total_pages )
			{
				$page_string .= ', ';
			}
		}
	}
	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
		{
			$page_string = ' <a href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
		}
		if ( $on_page < $total_pages )
		{
			$page_string .= '&nbsp;&nbsp;<a href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
		}
	}
	$page_string = $lang['Goto_page'] . ' ' . $page_string;
	return $page_string;
}
//
// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
//
function phpbb_preg_quote($str, $delimiter)
{
	$text = preg_quote($str);
	$text = str_replace($delimiter, '\\' . $delimiter, $text);
	return $text;
}
//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word)
{
	global $db;
	//
	// Define censored word matches
	//
/*****************************************************/
/* Forum - IntelliCencor v.1.0.0               START */
/*****************************************************/
//	$sql = "SELECT word, replacement
//		FROM  " . WORDS_TABLE;
$sql = "SELECT word, replacement
                FROM  " . WORDS_TABLE . " ORDER BY length(word) DESC";
/*****************************************************/
/* Forum - IntelliCencor v.1.0.0                 END */
/*****************************************************/
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
	}
	if ( $row = $db->sql_fetchrow($result) )
	{
                do
		{
/*****************************************************/
/* Forum - IntelliCencor v.1.0.0               START */
/*****************************************************/
//			$orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
//			$replacement_word[] = $row['replacement'];
$ic_word = ''; $ic_first = 0;
$ic_chars = preg_split('//', $row['word'], -1, PREG_SPLIT_NO_EMPTY);
foreach ($ic_chars as $char) {
if (($ic_first == 1) && ($char != "*")) { $ic_word .= "_"; }
   $ic_word .= $char; $ic_first = 1;
}
$ic_search = array('\*','s','a','b','l','i','o','p','_');
$ic_replace = array('\w*?','(?:s|\$)','(?:a|\@)','(?:b|8|3)','(?:l|1|i|\!)','(?:i|1|l|\!)','(?:o|0)','(?:p|\?)','(?:_|\W)*');
$orig_word[] = '#(?<=^|\W)(' . str_replace($ic_search, $ic_replace, phpbb_preg_quote($ic_word, '#')) . ')(?=\W|$)#i';
$replacement_word[] = $row['replacement'];
/*****************************************************/
/* Forum - IntelliCencor v.1.0.0                 END */
/*****************************************************/
		}
		while ( $row = $db->sql_fetchrow($result) );
	}
	return true;
}
//
// This is general replacement for die(), allows templated
// output in users (or default) language, etc.
//
// $msg_code can be one of these constants:
//
// GENERAL_MESSAGE : Use for any simple text message, eg. results
// of an operation, authorisation failures, etc.
//
// GENERAL ERROR : Use for any error which occurs _AFTER_ the
// common.php include_once and session code, ie. most errors in
// pages/functions
//
// CRITICAL_MESSAGE : Used when basic config data is available but
// a session may not exist, eg. banned users
//
// CRITICAL_ERROR : Used when config data cannot be obtained, eg
// no database connection. Should _not_ be used in 99.5% of cases
//
function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
	global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images;
	global $userdata, $user_ip, $session_length;
	global $starttime;
	if(defined('HAS_DIED'))
	{
		die("message_die() was called multiple times. This isn't supposed to happen. Was message_die() used in page_tail.php?");
	}
	define('HAS_DIED', 1);
	$sql_store = $sql;
	//
        // Get SQL error if we are debugging. Do this as soon as possible to prevent
	// subsequent queries from overwriting the status of sql_error()
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		$sql_error = $db->sql_error();
		$debug_text = '';
		if ( $sql_error['message'] != '' )
		{
			$debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
		}
		if ( $sql_store != '' )
		{
			$debug_text .= "<br /><br />$sql_store";
		}
		if ( $err_line != '' && $err_file != '' )
		{
			$debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename($err_file);
		}
	}
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) )
        {
                $userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
                init_userprefs($userdata);
        }
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
	//
	// If the header hasn't been output then do it
	//
	if ( !defined('HEADER_INC') && $msg_code != CRITICAL_ERROR )
	{
		if ( empty($lang) )
		{
			if ( !empty($board_config['default_lang']) )
			{
				include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);
			}
			else
			{
				include_once($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
			}
        include_once("includes/lang_extend_mac.php");
		}
		if ( empty($template) )
		{
                        $ThemeSel = get_theme();
                        if (file_exists("themes/$ThemeSel/forums/".$board_config['board_template']."/index_body.tpl")) {
                            $template = new Template("themes/$ThemeSel/forums/".$board_config['board_template']."");
                        } else {
                            $template = new Template($phpbb_root_path . 'templates/' . $board_config['board_template']);
                        }
		}
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
               if ( empty($theme) )
                        {
                                $theme = setup_style($board_config['default_style']);
                        }
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
		//
		// Load the Page Header
		//
		if ( !defined('IN_ADMIN') )
		{
                        include_once("includes/page_header.php");
		}
		else
		{
			include_once($phpbb_root_path . 'admin/page_header_admin.'.$phpEx);
		}
	}
	switch($msg_code)
	{
		case GENERAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Information'];
			}
			break;
		case CRITICAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Critical_Information'];
			}
			break;
		case GENERAL_ERROR:
			if ( $msg_text == '' )
			{
				$msg_text = $lang['An_error_occured'];
			}
			if ( $msg_title == '' )
			{
				$msg_title = $lang['General_Error'];
			}
			break;
		case CRITICAL_ERROR:
			//
			// Critical errors mean we cannot rely on _ANY_ DB information being
			// available so we're going to dump out a simple echo'd statement
			//
			include_once($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
			if ( $msg_text == '' )
			{
				$msg_text = $lang['A_critical_error'];
			}
			if ( $msg_title == '' )
			{
				$msg_title = 'phpBB : <strong>' . $lang['Critical_Error'] . '</strong>';
			}
			break;
	}
	//
	// Add on DEBUG info if we've enabled debug mode and this is an error. This
	// prevents debug info being output for general messages should DEBUG be
	// set TRUE by accident (preventing confusion for the end user!)
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		if ( $debug_text != '' )
		{
			$msg_text = $msg_text . '<br /><br /><strong><u>DEBUG MODE</u></strong>' . $debug_text;
		}
	}
	if ( $msg_code != CRITICAL_ERROR )
	{
		if ( !empty($lang[$msg_text]) )
		{
			$msg_text = $lang[$msg_text];
		}
		if ( !defined('IN_ADMIN') )
		{
			$template->set_filenames(array(
				'message_body' => 'message_body.tpl')
			);
		}
		else
		{
			$template->set_filenames(array(
				'message_body' => 'admin/admin_message_body.tpl')
			);
		}
		$template->assign_vars(array(
			'MESSAGE_TITLE' => $msg_title,
			'MESSAGE_TEXT' => $msg_text)
		);
		$template->pparse('message_body');
		if ( !defined('IN_ADMIN') )
		{
                        include_once("includes/page_tail.php");
		}
		else
		{
			include_once($phpbb_root_path . 'admin/page_footer_admin.'.$phpEx);
		}
	}
	else
	{
		echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
	}
	exit;
}
//
// This function is for compatibility with PHP 4.x's realpath()
// function.  In later versions of PHP, it needs to be called
// to do checks with some functions.  Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path)
{
	global $phpbb_root_path, $phpEx;
	return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
}
function redirect($url)
{
	global $db, $board_config;
	if (!empty($db))
	{
		$db->sql_close();
	}
	if (strstr(urldecode($url), "\n") || strstr(urldecode($url), "\r") || strstr(urldecode($url), ';url'))
	{
		message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
	}
	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));
	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) {
        if(!stristr($url, "modules.php")) {
		    header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
        } else {
            header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $url);
        }
		echo '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">HERE</a> to be redirected</div></body></html>';
		exit;
	}
	// Behave as per HTTP/1.1 spec for others
    if(!stristr($url, "modules.php")) {
        header('Location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
    } else {
        header('Location: ' . $server_protocol . $server_name . $server_port . $url);
    }
	exit;
}
function bblogin($nukeuser, $session_id) {
        global $nukeuser, $userdata, $user_ip, $session_length, $session_id, $db, $nuke_file_path;
        define("IN_LOGIN", true);
        $cookie = explode(":", $nukeuser);
        $nuid = $cookie[0];
        $sql = "SELECT s.*
                FROM " . SESSIONS_TABLE . " s
                WHERE s.session_id = '$session_id'
                AND s.session_ip = '$user_ip'";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch : session_pagestar');
        }
        $logindata = $db->sql_fetchrow($result);
        if( $nuid != $logindata['session_user_id'] ) {
            $nusername = $cookie[1];
            $sql = "SELECT user_id, username, user_password, user_active, user_level
                    FROM ".USERS_TABLE."
                    WHERE username = '" . str_replace("\'", "''", $nusername) . "'";
            $result = $db->sql_query($sql);
            if(!$result) {
                message_die(GENERAL_ERROR, "Error in obtaining userdata : login", "", __LINE__, __FILE__, $sql);
            }
            $rowresult = $db->sql_fetchrow($result);
            $password = $cookie[2];
            if(count($rowresult) ) {
                if( $rowresult['user_level'] != ADMIN && $board_config['board_disable'] ) {
                    header("Location: " . append_sid("index.php", true));
                } else {
                    if( $password == $rowresult['user_password'] && $rowresult['user_active'] ) {
                        $autologin = 0;
                        $userdata = session_begin($rowresult['user_id'], $user_ip, PAGE_INDEX, $session_length, FALSE, $autologin);
                        $session_id = $userdata['session_id'];
                        if(!$session_id ) {
                            message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
                        } else {
                        }
                    } else {
                        $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a href=\"" . append_sid("modules.php?name=Forums&file=login&$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a> ");
                        message_die(GENERAL_MESSAGE, $message);
                    }
                }
            } else {
                $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a href=\"" . append_sid("modules.php?name=Forums&file=login&$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.php") . "\">", "</a> ");
                message_die(GENERAL_MESSAGE, $message);
            }
        }
}
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
	function CheckUsernameColor($color, $username)
		{
		if (strlen($color) < 6)
			$username = $username;
		elseif (strlen($color) == 6)
			$username = '<span style="color:#'. $color .'" class="gensmall"><strong>'. $username .'</strong></span>';	
		else
			$username = $username;
		return $username;		
		}
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
function resize_avatar($avatar_url) {
	global $board_config;
	list($avatar_width, $avatar_height) = @getimagesize($avatar_url);
	if($avatar_width > $board_config['avatar_max_width'] && $avatar_height <= $board_config['avatar_max_height']) {
		$cons_width = $board_config['avatar_max_width'];
		$cons_height = round((($board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
	}
	elseif($avatar_width <= $board_config['avatar_max_width'] && $avatar_height > $board_config['avatar_max_height']) {
		$cons_width = round((($board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
		$cons_height = $board_config['avatar_max_height'];
	}
	elseif($avatar_width > $board_config['avatar_max_width'] && $avatar_height > $board_config['avatar_max_height']) {
		if($avatar_width >= $avatar_height) {
			$cons_width = $board_config['avatar_max_width'];
			$cons_height = round((($board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
		}
		elseif($avatar_width < $avatar_height) {
			$cons_width = round((($board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
			$cons_height = $board_config['avatar_max_height'];
		}
	}
	else {
		$cons_width = $avatar_width;
		$cons_height = $avatar_height;
	}
	return ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $avatar_url . '" width="' . $cons_width . '" height="' . $cons_height . '" alt="" border="0" />' : '';
}
//
// END MOD
// Add function mkrealdate for Birthday MOD
// the originate php "mktime()", does not work proberly on all OS, especially when going back in time
// before year 1970 (year 0), this function "mkrealtime()", has a mutch larger valid date range,
// from 1901 - 2099. it returns a "like" UNIX timestamp divided by 86400, so
// calculation from the originate php date and mktime is easy.
// mkrealdate, returns the number of day (with sign) from 1.1.1970.
function mkrealdate($day,$month,$birth_year)
{
	// range check months
	if ($month<1 || $month>12) return "error";
	// range check days
	switch ($month)
	{
		case 1: if ($day>31) return "error";break;
		case 2: if ($day>29) return "error";
			$epoch=$epoch+31;break;
		case 3: if ($day>31) return "error";
			$epoch=$epoch+59;break;
		case 4: if ($day>30) return "error" ;
			$epoch=$epoch+90;break;
		case 5: if ($day>31) return "error";
			$epoch=$epoch+120;break;
		case 6: if ($day>30) return "error";
			$epoch=$epoch+151;break;
		case 7: if ($day>31) return "error";
			$epoch=$epoch+181;break;
		case 8: if ($day>31) return "error";
			$epoch=$epoch+212;break;
		case 9: if ($day>30) return "error";
			$epoch=$epoch+243;break;
		case 10: if ($day>31) return "error";
			$epoch=$epoch+273;break;
		case 11: if ($day>30) return "error";
			$epoch=$epoch+304;break;
		case 12: if ($day>31) return "error";
			$epoch=$epoch+334;break;
	}
	$epoch=$epoch+$day;
	$epoch_Y=sqrt(($birth_year-1970)*($birth_year-1970));
	$leapyear=round((($epoch_Y+2) / 4)-.5);
	if (($epoch_Y+2)%4==0)
	{// curent year is leapyear
		$leapyear--;
		if ($birth_year >1970 && $month>=3) $epoch=$epoch+1;
		if ($birth_year <1970 && $month<3) $epoch=$epoch-1;
	} else if ($month==2 && $day>28) return "error";//only 28 days in feb.
	//year
	if ($birth_year>1970)
		$epoch=$epoch+$epoch_Y*365-1+$leapyear;
	else
		$epoch=$epoch-$epoch_Y*365-1-$leapyear;
	return $epoch;
}
// Add function realdate for Birthday MOD
// the originate php "date()", does not work proberly on all OS, especially when going back in time
// before year 1970 (year 0), this function "realdate()", has a mutch larger valid date range,
// from 1901 - 2099. 
//it returns a "like" UNIX date format (only date, related letters may be used, due to the fact that
// the given date value should already be divided by 86400 - leaving no time information left)
// a input like a UNIX timestamp divided by 86400 is expected, so
// calculation from the originate php date and mktime is easy.
// e.g. realdate ("m d Y", 3) returns the string "1 3 1970"
// UNIX users should replace this function with the below code, since this should be faster
//
//function realdate($date_syntax="Ymd",$date=0) 
//{ return create_date($date_syntax,$date*86400+1,0); }
function realdate($date_syntax="Ymd",$date=0)
{
	global $lang;
	$i=2;
	if ($date>=0)
	{
	 	return create_date($date_syntax,$date*86400+1,0);
	} else
	{
		$year= -(date%1461);
		$days = $date + $year*1461;
		while ($days<0)
		{
			$year--;
			$days+=365;
			if ($i++==3)
			{
				$i=0;
				$days++;
			}
		}
	}
	$leap_year = ($i==0) ? TRUE : FALSE;
	$months_array = ($i==0) ?
		array (0,31,60,91,121,152,182,213,244,274,305,335,366) :
		array (0,31,59,90,120,151,181,212,243,273,304,334,365);
	for ($month=1;$month<12;$month++)
	{
		if ($days<$months_array[$month]) break;
	}
	$day=$days-$months_array[$month-1]+1;
	//you may gain speed performance by remove som of the below entry's if they are not needed/used
	return strtr ($date_syntax, array(
		'a' => '',
		'A' => '',
		'\\d' => 'd',
		'd' => ($day>9) ? $day : '0'.$day,
		'\\D' => 'D',
		'D' => $lang['day_short'][($date-3)%7],
		'\\F' => 'F',
		'F' => $lang['month_long'][$month-1],
		'g' => '',
		'G' => '',
		'H' => '',
		'h' => '',
		'i' => '',
		'I' => '',
		'\\j' => 'j',
		'j' => $day,
		'\\l' => 'l',
		'l' => $lang['day_long'][($date-3)%7],
		'\\L' => 'L',
		'L' => $leap_year,
		'\\m' => 'm',
		'm' => ($month>9) ? $month : '0'.$month,
		'\\M' => 'M',
		'M' => $lang['month_short'][$month-1],
		'\\n' => 'n',
		'n' => $month,
		'O' => '',
		's' => '',
		'S' => '',
		'\\t' => 't',
		't' => $months_array[$month]-$months_array[$month-1],
		'w' => '',
		'\\y' => 'y',
		'y' => ($year>29) ? $year-30 : $year+70,
		'\\Y' => 'Y',
		'Y' => $year+1970,
		'\\z' => 'z',
		'z' => $days,
		'\\W' => '',
		'W' => '') );
}
// End add - Birthday MOD
//====================================================================== |
//====  Profile ===================================== |
//==== v1.1.3 ========================================================== |
//====
function get_forum_most_active($user)
{
	global $db, $userdata;
	if ( intval($user) == 0 )
	{
		$user = trim(htmlspecialchars($user));
		$user = substr(str_replace("\\'", "'", $user), 0, 25);
		$user = str_replace("'", "\\'", $user);
	}
	else
	{
		$user = intval($user);
	}
	$sql_forum = "SELECT forum_id, forum_name FROM " . FORUMS_TABLE . "
		ORDER BY forum_id";
	if ( !($result = $db->sql_query($sql_forum)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain forums list', '', __LINE__, __FILE__, $sql_forum);
	}
	$most_active_id = array();
	while ( $line = $db->sql_fetchrow($result) ) 
	{
		$most_active_id[] = $line['forum_id'];
		$most_active_name[$line['forum_id']] = $line['forum_name']; 
	}
	$db->sql_freeresult($result);
	$count_most_active_id = count($most_active_id);
	$most_active_posts = 0;
	$num_result = 0;
	foreach ( $most_active_id as $i )
	{
		$is_auth = auth(AUTH_VIEW, $i, $userdata);
		if ( $is_auth['auth_view'] == 1 )
		{
			$sql_most = "SELECT *
				FROM " . POSTS_TABLE . " 
				WHERE forum_id = $i AND poster_id = $user";
			if ( !($result = $db->sql_query($sql_most)) )
			{
				message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql_most);
			}
			if ( $db->sql_numrows($result) > $most_active_posts )
			{
				$most_active_posts = $db->sql_numrows($result);
				$most_active_foren_id = $i;
				$most_active_forum_name = $most_active_name[$i];
			}
		}
	}
	return array('forum_id' => $most_active_foren_id, 'forum_name' => $most_active_forum_name, 'posts' => $most_active_posts);
}
//====
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |
/*****[BEGIN]******************************************/
/** Mod:    DHTML Collapsible Forum Index MOD v1.1.1 **/
/******************************************************/
function get_cfi_cookie_name()
{
	global $board_config, $_GET;
	$k = $board_config['cookie_name'].'_CFI_cats';
	if( isset($board_config['sub_forum']) )
	{
		$k .= '_'.isset($board_config['sub_forum']);
		if( isset($_GET['c']) )
		{
			$k .= '_'.$_GET['c'];
		}
	}
	return $k;
}
function is_category_collapsed($cat_id)
{
	global $board_config, $_COOKIE;
	static $collapsed_cats = false;
	if( intval($board_config['sub_forum']) == 2 )
	{
		return false;
	}
	if( !is_array($collapsed_cats) )
	{
		if( isset($_COOKIE[get_cfi_cookie_name()]) )
		{
			$collapsed_cats = explode(':', $_COOKIE[get_cfi_cookie_name()]);
		}
		else
		{
			$collapsed_cats = array();
		}
	}
	return in_array($cat_id, $collapsed_cats) ? true : false;
}
/*****[END]**********************************************/
/**** Mod:   DHTML Collapsible Forum Index MOD  v1.1.1**/
/*******************************************************/
?>