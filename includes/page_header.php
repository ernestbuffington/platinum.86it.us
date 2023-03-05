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
}
define('HEADER_INC', TRUE);

global $name, $sitename, $is_inline_review, $prefix, $db;

$sql = "SELECT custom_title from ".$prefix."_modules where title='$name'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
if ($row[custom_title] == "") {
    $mod_name = preg_replace("/_/", " ", $name);
} else {
    $mod_name = $row[custom_title];
}
//if (!$is_inline_review & $mod_name != "Private Messages") {
//    title("$sitename: $mod_name");
//}
    OpenTable();

// 
// gzip_compression 
// 
$do_gzip_compress = FALSE; 
if($board_config['gzip_compress'])
{ 
   $phpver = phpversion(); 

   if($phpver >= "4.0.4pl1") 
      { 
         if(extension_loaded("zlib")) 
      { 
   if (headers_sent() != TRUE) 
      { 
         $gz_possible = isset($_SERVER["HTTP_ACCEPT_ENCODING"]) && preg_match("/gzip, deflate/",$_SERVER["HTTP_ACCEPT_ENCODING"]); 
         if ($gz_possible && (ob_get_contents() != FALSE));
		 //if ($gz_possible) ob_start("ob_gzhandler"); 
      } 
   } 
      } 
         else if($phpver > "4.0") 
      { 
         if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
         { 
            if(extension_loaded("zlib")) 
         { 
            $do_gzip_compress = TRUE; 
            ob_start(); 
            ob_implicit_flush(0); 

            header("Content-Encoding: gzip"); 
         } 
      } 
   } 
}  

//
// Parse and show the overall header.
//
$template->set_filenames(array(
        'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

//
// Generate logged in/logged out status
//
if ( $userdata['session_logged_in'] )
{
        $u_login_logout = 'modules.php?name=Your_Account&op=logout&redirect=Forums';
        $l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
        $u_login_logout = 'modules.php?name=Your_Account&redirect=index';
        $l_login_logout = $lang['Login'];
}

$s_last_visit = ( $userdata['session_logged_in'] ) ? create_date($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']) : '';

//
// Get basic (usernames + totals) online
// situation
//
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';
if (defined('SHOW_ONLINE'))
{

/*****************************************************/
/* Forum - Who is Online Time v.1.0.2          START */
/*****************************************************/
	$whoisonlinetime = ($board_config['who_is_online_time'] * 60);
        $user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
        $sql = "SELECT u.username, u.user_color_gc, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
                FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
                WHERE u.user_id = s.session_user_id
                        AND s.session_time >= ".( time() - $whoisonlinetime ) . "
                        $user_forum_sql
                ORDER BY u.username ASC, s.session_ip ASC";
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2            END */
/*****************************************************/
        if( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
        }

        $userlist_ary = array();
        $userlist_visible = array();

        $prev_user_id = 0;
        $prev_user_ip = $prev_session_ip = '';

        while( $row = $db->sql_fetchrow($result) )
        {
                // User is logged in and therefor not a guest
                if ( $row['session_logged_in'] )
                {
                        // Skip multiple sessions for one user
                        if ( $row['user_id'] != $prev_user_id )
                        {
                                $style_color = '';
                                if ( $row['user_level'] == ADMIN )
                                {
                                        $row['username'] = '<strong>' . $row['username'] . '</strong>';
                                        $style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
                                }
                                else if ( $row['user_level'] == MOD )
                                {
                                        $row['username'] = '<strong>' . $row['username'] . '</strong>';
                                        $style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
                                }
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
                                $row['username'] = CheckUsernameColor($row['user_color_gc'], $row['username']);
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
                                if ( $row['user_allow_viewonline'] )
                                {
                                        $user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';
                                        $logged_visible_online++;
                                }
                                else
                                {
                                        $user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'><i>' . $row['username'] . '</i></a>';
                                        $logged_hidden_online++;
                                }

                                if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
                                {
                                        $online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
                                }
                        }

                        $prev_user_id = $row['user_id'];
                }
                else
                {
                        // Skip multiple sessions for one user
                        if ( $row['session_ip'] != $prev_session_ip )
                        {
                                $guests_online++;
                        }
                }

                $prev_session_ip = $row['session_ip'];
        }
        $db->sql_freeresult($result);

        if ( empty($online_userlist) )
        {
                $online_userlist = $lang['None'];
        }
        $online_userlist = ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Registered_users'] ) . ' ' . $online_userlist;

        $total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

        if ( $total_online_users > $board_config['record_online_users'])
        {
                $board_config['record_online_users'] = $total_online_users;
                $board_config['record_online_date'] = time();

                $sql = "UPDATE " . CONFIG_TABLE . "
                        SET config_value = '$total_online_users'
                        WHERE config_name = 'record_online_users'";
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . CONFIG_TABLE . "
                        SET config_value = '" . $board_config['record_online_date'] . "'
                        WHERE config_name = 'record_online_date'";
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
                }
        }

        
        if ( $total_online_users == 0 )
        {
                $l_t_user_s = $lang['Online_users_zero_total'];
        }
        else if ( $total_online_users == 1 )
        {
                $l_t_user_s = $lang['Online_user_total'];
        }
        else
        {
                $l_t_user_s = $lang['Online_users_total'];
        }

        if ( $logged_visible_online == 0 )
        {
                $l_r_user_s = $lang['Reg_users_zero_total'];
        }
        else if ( $logged_visible_online == 1 )
        {
                $l_r_user_s = $lang['Reg_user_total'];
        }
        else
        {
                $l_r_user_s = $lang['Reg_users_total'];
        }

        if ( $logged_hidden_online == 0 )
        {
                $l_h_user_s = $lang['Hidden_users_zero_total'];
        }
        else if ( $logged_hidden_online == 1 )
        {
                $l_h_user_s = $lang['Hidden_user_total'];
        }
        else
        {
                $l_h_user_s = $lang['Hidden_users_total'];
        }

        if ( $guests_online == 0 )
        {
                $l_g_user_s = $lang['Guest_users_zero_total'];
        }
        else if ( $guests_online == 1 )
        {
                $l_g_user_s = $lang['Guest_user_total'];
        }
        else
        {
                $l_g_user_s = $lang['Guest_users_total'];
        }

        $l_online_users = sprintf($l_t_user_s, $total_online_users);
        $l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
        $l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
        $l_online_users .= sprintf($l_g_user_s, $guests_online);
}
//
// Users of the day MOD
//

// ############ Edit below ############
// #
$display_not_day_userlist = 0;	// change to 1 here if you also want the list of the users who didn't visit to be displayed
$users_list_delay = 24;		// change here to the number of hours wanted for the list
// #
// ############ Edit above ############

$sql = "SELECT user_id, username, user_color_gc, user_allow_viewonline, user_level, user_session_time
	FROM ".USERS_TABLE."
	WHERE user_id > 0
	ORDER BY IF(user_level=1,3,user_level) DESC, username ASC";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain user/day information', '', __LINE__, __FILE__, $sql);
}

$day_userlist = '';
$day_users = 0;
$not_day_userlist = '';
$not_day_users = 0;

while( $row = $db->sql_fetchrow($result) )
{
	$style_color = '';
	if ( $row['user_level'] == ADMIN )
	{
		$row['username'] = '<strong>' . $row['username'] . '</strong>';
		$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
	}
	else if ( $row['user_level'] == MOD )
	{
		$row['username'] = '<strong>' . $row['username'] . '</strong>';
		$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
	}
	        $row['username'] = CheckUsernameColor($row['user_color_gc'], $row['username']);

	if ( $row['user_allow_viewonline'] )
	{
		$user_day_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';
	}
	else
	{
		$user_day_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'><i>' . $row['username'] . '</i></a>';
	}
	if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
	{
		if ( $row['user_session_time'] >= ( time() - $users_list_delay * 3600 ) )
		{
			$day_userlist .= ( $day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
			$day_users++;
		}
		else
		{
			$not_day_userlist .= ( $not_day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
			$not_day_users++;
		}
	}
}

$day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Day_users'], $day_users, $users_list_delay) ) . ' ' . $day_userlist;

$not_day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Not_day_users'], $not_day_users, $users_list_delay) ) . ' ' . $not_day_userlist;

if ( $display_not_day_userlist )
{
	$day_userlist .= '<br />' . $not_day_userlist;
}

//
// End of MOD
//

//
// Obtain number of new private messages
// if user is logged in
//
if ( ($userdata['session_logged_in']) && (empty($gen_simple_header)) )
{
// Start add - Birthday MOD
// see if user has or have had birthday, also see if greeting are enabled
	if ( $userdata['user_birthday']!=999999 && $board_config['birthday_greeting'] && create_date('Ymd', time(), $board_config['board_timezone'])  >= $userdata['user_next_birthday_greeting'].realdate ('md',$userdata['user_birthday'] ) )
	{
		$sql = "UPDATE " . USERS_TABLE . "
			SET user_next_birthday_greeting = " . (create_date('Y', time(), $board_config['board_timezone'])+1) . "
			WHERE user_id = " . $userdata['user_id'];
		if( !$status = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not update next_birthday_greeting for user.", "", __LINE__, __FILE__, $sql);
		}
		$template->assign_var("GREETING_POPUP",
			"<script language=\"Javascript\" type=\"text/javascript\"><!--
			window.open('".append_sid('birthday_popup.'.$phpEx)."', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');
			//-->
			</script>");
	} //Sorry user shall not have a greeting this year
// End add - Birthday MOD
        if ( $userdata['user_new_privmsg'] )
        {
                $l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['New_pm'] : $lang['New_pms'];
                $l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

                if ( $userdata['user_last_privmsg'] > $userdata['user_lastvisit'] )
                {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
                                WHERE user_id = " . $userdata['user_id'];
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
                        }

                        $s_privmsg_new = 1;
                        $icon_pm = $images['pm_new_msg'];
                }
                else
                {
                        $s_privmsg_new = 0;
                        $icon_pm = $images['pm_new_msg'];
                }
        }
        else
        {
                $l_privmsgs_text = $lang['No_new_pm'];

                $s_privmsg_new = 0;
                $icon_pm = $images['pm_no_new_msg'];
        }

        if ( $userdata['user_unread_privmsg'] )
        {
                $l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $lang['Unread_pm'] : $lang['Unread_pms'];
                $l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
        }
        else
        {
                $l_privmsgs_text_unread = $lang['No_unread_pm'];
        }
}
else
{
        $icon_pm = $images['pm_no_new_msg'];
        $l_privmsgs_text = $lang['Login_check_pm'];
        $l_privmsgs_text_unread = '';
        $s_privmsg_new = 0;
}

/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
// BEGIN Advanced_Report_Hack
$report_info = '';
if (($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD) && $board_config['report_list'] == 0 && empty($gen_simple_header))
{
	include_once('functions_report.php');
	$report_count = report_count('notcleared');

	switch ($report_count)
	{
		case 0:
			$report_info = $lang['No_new_reports'];
			break;
		case 1:
			$report_info = $lang['New_report'];
			break;
		default:
			$report_info = sprintf($lang['New_reports'], $report_count);
	}
	$report_info = '<a href="' . append_sid('modules.php?name=Forums&file=report') . '" class="mainmenu">' . $report_info . '</a>';
}
else if ($userdata['user_id'] != ANONYMOUS)
{
	$report_info = '<a href="' . append_sid('modules.php?name=Forums&file=report&amp;mode=report') . '" class="mainmenu">' . $lang['Write_report'] . '</a>';
}
// END Advanced_Report_Hack
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

//
// Generate HTML require_onced for Mozilla Navigation bar
//
if (!isset($nav_links))
{
        $nav_links = array();
}

$nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
while( list($nav_item, $nav_array) = @each($nav_links) )
{
        if ( !empty($nav_array['url']) )
        {
                $nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
        }
        else
        {
                // We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
                while( list(,$nested_array) = each($nav_array) )
                {
                        $nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
                }
        }
}

/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
$online_color = ' style="color:#' . $theme['online_color'] . '"';
$offline_color = ' style="color:#' . $theme['offline_color'] . '"';
$hidden_color = ' style="color:#' . $theme['hidden_color'] . '"';
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];
//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
	define('COLORS', $prefix .'_bbadvanced_username_color');
	$q = "SELECT *
		  FROM ". COLORS ."
		  WHERE group_id > '0'
		  ORDER BY group_weight ASC";
	$r			= $db->sql_query($q);
	$coloring	= $db->sql_fetchrowset($r);
	
	for ($a = 0; $a < count($coloring); $a++)
		{
		if ($coloring[$a]['group_id'])
			{
		$template->assign_block_vars('colors', array(
			'GROUPS'	=> '&nbsp;[&nbsp;<a href="'. append_sid('auc_listing.'. $phpEx .'?id='. $coloring[$a]['group_id']) .'"><span class="genmed" style="color:#'. $coloring[$a]['group_color'] .'">'. $coloring[$a]['group_name'] .'</span></a>&nbsp;]&nbsp;')
				);
			}
		else
			break;
		}
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
$template->assign_vars(array(
        'SITENAME' => $board_config['sitename'],
        'SITE_DESCRIPTION' => $board_config['site_desc'],
        'PAGE_TITLE' => $page_title,
	'SHOP' => 'Shop',
        'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
        'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
        'TOTAL_USERS_ONLINE' => $l_online_users,
        'LOGGED_IN_USER_LIST' => $online_userlist,
        'USERS_OF_THE_DAY_LIST' => $day_userlist,
        'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
        'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
        'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
        'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
        'REPORT_INFO' => $report_info,
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

        'PRIVMSG_IMG' => $icon_pm,

/*****************************************************/
/* Forum - Resize Posted Image v.1.1.0         START */
/*****************************************************/
        'L_RESIZED_IMAGE_TITLE' => $lang['Resized_image_title'],
/*****************************************************/
/* Forum - Resize Posted Image v.1.1.0           END */
/*****************************************************/
        'L_USERNAME' => $lang['Username'],
        'L_PASSWORD' => $lang['Password'],
        'L_LOGIN_LOGOUT' => $l_login_logout,
        'L_LOGIN' => $lang['Login'],
        'L_LOG_ME_IN' => $lang['Log_me_in'],
        'L_AUTO_LOGIN' => $lang['Log_me_in'],
        'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
        'L_REGISTER' => $lang['Register'],
        'L_PROFILE' => $lang['Profile'],
        'L_SEARCH' => $lang['Search'],
        'L_PRIVATEMSGS' => $lang['Private_Messages'],
        'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
        'L_MEMBERLIST' => $lang['Memberlist'],
        'L_FAQ' => $lang['FAQ'],
/*****************************************************/
/* Forum - Statistics v.2.1.0                  START */
/*****************************************************/
        'L_STATISTICS' => $lang ['Statistics'],
/*****************************************************/
/* Forum - Statistics v.2.1.0                    END */
/*****************************************************/
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
        'L_BUDDYLIST' => $lang['Buddy_list'],
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
        'L_USERGROUPS' => $lang['Usergroups'],
        'L_SEARCH_NEW' => $lang['Search_new'],
        'L_SEARCH_UNANSWERED' => $lang['Search_unanswered'],
        'L_SEARCH_SELF' => $lang['Search_your_posts'],
        'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
        'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
        'L_FAV' => $lang['favorites'],
        'L_WATCHED_TOPICS' => $lang['Watched_Topics'],
/*****************************************************/
/* Forum - Topics User Started v.1.0.1         START */
/*****************************************************/
        'L_SEARCH_STARTEDTOPICS' => $lang['topics_created'],
        'U_SEARCH_STARTEDTOPICS' => append_sid('search.'.$phpEx.'?search_id=startedtopics'),
/*****************************************************/
/* Forum - Topics User Started v.1.0.1           END */
/*****************************************************/
        'U_SEARCH_UNANSWERED' => append_sid('search.'.$phpEx.'?search_id=unanswered'),
        'U_SEARCH_SELF' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
        'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=newposts'),
        'U_INDEX' => append_sid('index.'.$phpEx),
        'U_REGISTER' => append_sid('profile.'.$phpEx.'?mode=register'),
        'U_PROFILE' => append_sid('profile.'.$phpEx.'?mode=editprofile'),
        'U_PRIVATEMSGS' => append_sid('privmsg.'.$phpEx.'?folder=inbox'),
        'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=newpm&popup=1'),
        'U_SEARCH' => append_sid('search.'.$phpEx),
        'U_MEMBERLIST' => append_sid('memberlist.'.$phpEx),
        'U_MODCP' => append_sid('modcp.'.$phpEx),
        'U_FAQ' => append_sid('faq.'.$phpEx),
	'U_SHOP' => append_sid('shop.'.$phpEx),
/*****************************************************/
/* Forum - Statistics v.2.1.0                  START */
/*****************************************************/
        'U_STATISTICS' => append_sid('statistics.'.$phpEx), 
/*****************************************************/
/* Forum - Statistics v.2.1.0                    END */
/*****************************************************/
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
        'U_BUDDYLIST' => append_sid('buddylist.'.$phpEx),
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
        'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
        'U_LOGIN_LOGOUT' => append_sid($u_login_logout),

        'U_GROUP_CP' => append_sid('groupcp.'.$phpEx),
        'U_FAV' => append_sid('favorites.'.$phpEx),
        'U_WATCHED_TOPICS' => append_sid($phpbb_root_path . 'watched_topics.' . $phpEx),
		
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3         START */
/*****************************************************/
	// Mighty Gorgon - Multiple Ranks - BEGIN
	'L_RANKS' => $lang['Rank_Header'],
	'L_STAFF' => $lang['Staff'],
	'U_RANKS' => append_sid('ranks.' . $phpEx),
	'U_STAFF' => append_sid('memberlist.' . $phpEx . '?mode=staff'),
	// Mighty Gorgon - Multiple Ranks - END
 //       'U_STAFF' => append_sid('staff.'.$phpEx),
 //       'L_STAFF' => $lang['Staff'],
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3           END */
/*****************************************************/

        'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
        'S_CONTENT_ENCODING' => $lang['ENCODING'],
        'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
        'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
        'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),
        'S_LOGIN_ACTION' => append_sid('login.'.$phpEx),

        'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
        /*
        'T_BODY_BACKGROUND' => $theme['body_background'],
        'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
        'T_BODY_TEXT' => '#'.$theme['body_text'],
        'T_BODY_LINK' => '#'.$theme['body_link'],
        'T_BODY_VLINK' => '#'.$theme['body_vlink'],
        'T_BODY_ALINK' => '#'.$theme['body_alink'],
        'T_BODY_HLINK' => '#'.$theme['body_hlink'],
        */
        'T_TR_COLOR1' => '#'.$theme['tr_color1'],
        'T_TR_COLOR2' => '#'.$theme['tr_color2'],
        'T_TR_COLOR3' => '#'.$theme['tr_color3'],
        'T_TR_CLASS1' => $theme['tr_class1'],
        'T_TR_CLASS2' => $theme['tr_class2'],
        'T_TR_CLASS3' => $theme['tr_class3'],
        'T_TH_COLOR1' => '#'.$theme['th_color1'],
        'T_TH_COLOR2' => '#'.$theme['th_color2'],
        'T_TH_COLOR3' => '#'.$theme['th_color3'],
        'T_TH_CLASS1' => $theme['th_class1'],
        'T_TH_CLASS2' => $theme['th_class2'],
        'T_TH_CLASS3' => $theme['th_class3'],
        'T_TD_COLOR1' => '#'.$theme['td_color1'],
        'T_TD_COLOR2' => '#'.$theme['td_color2'],
        'T_TD_COLOR3' => '#'.$theme['td_color3'],
        'T_TD_CLASS1' => $theme['td_class1'],
        'T_TD_CLASS2' => $theme['td_class2'],
        'T_TD_CLASS3' => $theme['td_class3'],
        'T_FONTFACE1' => $theme['fontface1'],
        'T_FONTFACE2' => $theme['fontface2'],
        'T_FONTFACE3' => $theme['fontface3'],
        'T_FONTSIZE1' => $theme['fontsize1'],
        'T_FONTSIZE2' => $theme['fontsize2'],
        'T_FONTSIZE3' => $theme['fontsize3'],
        'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
        'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
        'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
        'T_SPAN_CLASS1' => $theme['span_class1'],
        'T_SPAN_CLASS2' => $theme['span_class2'],
        'T_SPAN_CLASS3' => $theme['span_class3'],
/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
        'T_ONLINE_COLOR' => '#' . $theme['online_color'],
        'T_OFFLINE_COLOR' => '#' . $theme['offline_color'],
        'T_HIDDEN_COLOR' => '#' . $theme['hidden_color'],
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/

        'NAV_LINKS' => $nav_links_html)
);

//
// Login box?
//
if ( !$userdata['session_logged_in'] )
{
        $template->assign_block_vars('switch_user_logged_out', array());
	//
	// Allow autologin?
	//
	if (!isset($board_config['allow_autologin']) || $board_config['allow_autologin'] )
	{
		$template->assign_block_vars('switch_allow_autologin', array());
		$template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
	}

}
else
{
        $template->assign_block_vars('switch_user_logged_in', array());

        if ( !empty($userdata['user_popup_pm']) )
        {
                $template->assign_block_vars('switch_enable_pm_popup', array());
        }
}

// Add no-cache control for cookies if they are set
//$c_no_cache = (isset($_COOKIE[$board_config['cookie_name'] . '_sid']) || isset($_COOKIE[$board_config['cookie_name'] . '_data'])) ? 'no-cache="set-cookie", ' : '';

// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'Apache/2'))
{
        header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
        header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
header ('Expires: 0');
header ('Pragma: no-cache');

/*****************************************************/
/* Forum - Rank List Advanced v.1.0.0          START */
/*****************************************************/
$template->assign_vars(array(
    'U_RANKS' => append_sid("ranks.$phpEx"),
    'L_RANKS' => $lang['Ranks'],
    )
);
/*****************************************************/
/* Forum - Rank List Advanced v.1.0.0            END */
/*****************************************************/

/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
$switch_split_announce = true;
if ( !isset( $board_config['split_announce'] ) )
{
	$sqlw = "insert into ".CONFIG_TABLE." (config_name,config_value) VALUES('split_announce','" . $switch_split_announce . "')";
	if ( !($resultw = $db->sql_query($sqlw)) ) message_die(GENERAL_ERROR, 'Could not add key split_annonce in config table', '', __LINE__, __FILE__, $sql);
	$board_config['split_announce'] = $switch_split_announce;
}
if ( isset( $board_config['split_announce'] ) )
{
	$switch_split_announce = $board_config['split_announce'];
}

// split global announce
$switch_split_global_announce = isset($lang['Post_global_announcement']);
if ( isset($lang['Post_global_announcement']) && !isset( $board_config['split_global_announce'] ) )
{
	$sqlw = "insert into ".CONFIG_TABLE." (config_name,config_value) VALUES('split_global_announce','" . $switch_split_global_announce . "')";
	if ( !($resultw = $db->sql_query($sqlw)) ) message_die(GENERAL_ERROR, 'Could not add key split_annonce in config table', '', __LINE__, __FILE__, $sql);
	$board_config['split_global_announce'] = $switch_split_global_announce;
}
if ( isset($lang['Post_global_announcement']) && isset( $board_config['split_global_announce'] ) )
{
	$switch_split_global_announce = $board_config['split_global_announce'];
}

// split sticky
$switch_split_sticky = true;
if ( !isset( $board_config['split_sticky'] ) )
{
	$sqlw = "insert into ".CONFIG_TABLE." (config_name,config_value) VALUES('split_sticky','" . $switch_split_sticky . "')";
	if ( !($resultw = $db->sql_query($sqlw)) ) message_die(GENERAL_ERROR, 'Could not add key split_sticky in config table', '', __LINE__, __FILE__, $sql);
	$board_config['split_sticky'] = $switch_split_sticky;
}
if ( isset( $board_config['split_sticky'] ) )
{
	$switch_split_sticky = $board_config['split_sticky'];
}
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/

$template->pparse('overall_header');
if (preg_match('/googlebot/', $_SERVER['HTTP_USER_AGENT']))
{
	$url = 'http://' .$_SERVER['SERVER_NAME'] .$_SERVER['PHP_SELF'] . (($_SERVER['QUERY_STRING'] != '') ? '?' .$_SERVER['QUERY_STRING'] : '');
	$now = time();

	$sql = "INSERT INTO " .GOOGLE_BOT_DETECTOR_TABLE."(detect_time, detect_url) VALUES($now, '$url')";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not update detect information', '', __LINE__, __FILE__, $sql);
	}
}
?>
<script language="JavaScript" src="includes/javascript/gitme.js"></script>