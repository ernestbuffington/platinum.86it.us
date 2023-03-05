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
if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

$index = 1;

if ($popup != "1")
    {
        $module_name = basename(dirname(__FILE__));
        require_once("modules/".$module_name."/nukebb.php");
    }
    else
    {
        $phpbb_root_path = 'modules/Forums/';
    }
define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.php');
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
$viewcat = ( !empty($_GET[POST_CAT_URL]) ) ? $_GET[POST_CAT_URL] : -1;
if( isset($_GET['mark']) || isset($_POST['mark']) )
{
        $mark_read = ( isset($_POST['mark']) ) ? $_POST['mark'] : $_GET['mark'];
}
else
{
        $mark_read = '';
}
//
// Handle marking posts
//
if( $mark_read == 'forums' )
{
        if( $userdata['session_logged_in'] )
        {
                setcookie($board_config['cookie_name'] . '_f_all', time(), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
        }
        $template->assign_vars(array(
                "META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.$phpEx") . '">')
        );
        $message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a> ');
        message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//
$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_t"]) : array();
$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_f"]) : array();
//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$newest_userdata = get_db_stat('newestuser');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];
if( $total_posts == 0 )
{
        $l_total_post_s = $lang['Posted_articles_zero_total'];
}
else if( $total_posts == 1 )
{
        $l_total_post_s = $lang['Posted_article_total'];
}
else
{
        $l_total_post_s = $lang['Posted_articles_total'];
}
if( $total_users == 0 )
{
        $l_total_user_s = $lang['Registered_users_zero_total'];
}
else if( $total_users == 1 )
{
        $l_total_user_s = $lang['Registered_user_total'];
}
else
{
        $l_total_user_s = $lang['Registered_users_total'];
}
//
// Start page proper
//
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
        FROM " . CATEGORIES_TABLE . " c
        ".(($userdata['user_level']!=ADMIN)? "WHERE c.cat_title<>\"global_announcement\"" :"" )."
        ORDER BY c.cat_order";
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
if( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}
$category_rows = array();
while ($row = $db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$db->sql_freeresult($result);
if( ( $total_categories = count($category_rows) ) )
{
        //
        // Define appropriate SQL
        //
        switch(SQL_LAYER)
        {
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
                case 'postgresql':
                        $sql = "SELECT f.*, p.post_time, p.post_username, p.topic_id, u.username, u.user_color_gc, u.user_id
                                FROM " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p, " . USERS_TABLE . " u
                                WHERE p.post_id = f.forum_last_post_id
                                        AND u.user_id = p.poster_id
                                        UNION (
                                                SELECT f.*, NULL, NULL, NULL, NULL
                                                FROM " . FORUMS_TABLE . " f
                                                WHERE NOT EXISTS (
                                                        SELECT p.post_time
                                                        FROM " . POSTS_TABLE . " p
                                                        WHERE p.post_id = f.forum_last_post_id
                                                )
                                        )
                                        ORDER BY cat_id, forum_order";
                        break;
                case 'oracle':
   // Modified by Attached Forums MOD
			$sql = "SELECT f.*, p.post_time, p.post_username,  u.username, u.user_id, u.user_color_gc, t.topic_id, t.topic_title
				FROM ((( " . FORUMS_TABLE . " f
				LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
				LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
				LEFT JOIN " . TOPICS_TABLE . " t ON t.topic_last_post_id = f.forum_last_post_id)
				GROUP BY f.forum_id ORDER BY f.cat_id, f.forum_order";
   // END Modified by Attached Forums MOD
                        break;
                default:
   // Modified by Attached Forums MOD
			$sql = "SELECT f.*, p.post_time, p.post_username,  u.username, u.user_id, u.user_color_gc, t.topic_id, t.topic_title
				FROM ((( " . FORUMS_TABLE . " f
				LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
				LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
				LEFT JOIN " . TOPICS_TABLE . " t ON t.topic_last_post_id = f.forum_last_post_id)
				GROUP BY f.forum_id ORDER BY f.cat_id, f.forum_order";
   // END Modified by Attached Forums MOD
                        break;
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
        }
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
        }
        $forum_data = array();
        while( $row = $db->sql_fetchrow($result) )
        {
                $forum_data[] = $row;
        }
   // Added by Attached Forums MOD
	$attach=$forum_data;
   // END Added by Attached Forums MOD
	$db->sql_freeresult($result);
        if ( !($total_forums = count($forum_data)) )
        {
                message_die(GENERAL_MESSAGE, $lang['No_forums']);
        }
        //
        // Obtain a list of topic ids which contain
        // posts made since user last visited
        //
        if ( $userdata['session_logged_in'] )
        {
		// 60 days limit
		if ($userdata['user_lastvisit'] < (time() - 5184000))
		{
			$userdata['user_lastvisit'] = time() - 5184000;
		}
                $sql = "SELECT t.forum_id, t.topic_id, p.post_time
                        FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
                        WHERE p.post_id = t.topic_last_post_id
                                AND p.post_time > " . $userdata['user_lastvisit'] . "
                                AND t.topic_moved_id = 0";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
                }
                $new_topic_data = array();
                while( $topic_data = $db->sql_fetchrow($result) )
                {
                        $new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
                }
		$db->sql_freeresult($result);
        }
        //
        // Obtain list of moderators of each forum
        // First users, then groups ... broken into two queries
        //
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
        $sql = "SELECT aa.forum_id, u.user_id, u.username, u.user_color_gc
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
                WHERE aa.auth_mod = " . TRUE . "
                        AND g.group_single_user = 1
                        AND ug.group_id = aa.group_id
                        AND g.group_id = aa.group_id
                        AND u.user_id = ug.user_id
                GROUP BY u.user_id, u.username, aa.forum_id
                ORDER BY aa.forum_id, u.user_id";
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }
        $forum_moderators = array();
        while( $row = $db->sql_fetchrow($result) )
        {
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
                $forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . CheckUsernameColor($row['user_color_gc'], $row['username']) . '</a>';
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
        }
	$db->sql_freeresult($result);
        $sql = "SELECT aa.forum_id, g.group_id, g.group_name
                FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
                WHERE aa.auth_mod = " . TRUE . "
                        AND g.group_single_user = 0
                        AND g.group_type <> " . GROUP_HIDDEN . "
                        AND ug.group_id = aa.group_id
                        AND g.group_id = aa.group_id
                GROUP BY g.group_id, g.group_name, aa.forum_id
                ORDER BY aa.forum_id, g.group_id";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
        }
        while( $row = $db->sql_fetchrow($result) )
        {
                $forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
        }
	$db->sql_freeresult($result);
        //
        // Find which forums are visible for this user
        //
        $is_auth_ary = array();
        $is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);
	$itemarray = explode('ß', str_replace("Þ", "", $userdata['user_items']));
        global $prefix;
	$sql = "select name, accessforum from ".$prefix."_shopitems where accessforum != '0' and accessforum > '0'";
	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, "Database Connection Error!".mysql_error()); }
	$num_rows = $db->sql_numrows($result);
	$itemformaccess = array();
	$itemcataccess = array();
	for ($x = 0; $x < $num_rows; $x++)
	{
		$row = $db->$sql_fetchrow($result);
		if (in_array($row['name'], $itemarray))
		{
			$itemformaccess[] = $row['accessforum'];
			$sql = "select cat_id from " . FORUMS_TABLE . " where forum_id = '{$row['accessforum']}'";
			if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, "Database Connection Error: ".mysql_error()); }
			$row2 = $db->$sql_fetchrow($result);
			$itemcataccess[] = $row2['cat_id'];
		}
	}
// Birthday Mod, Show users with birthday
$sql = ($board_config['birthday_check_day']) ? "SELECT user_id, username, user_birthday,user_level FROM " . USERS_TABLE. " WHERE user_birthday!=999999 ORDER BY username" :"";
if($result = $db->sql_query($sql)) 
{ 
	if (!empty($result)) 
	{ 
		$time_now = time();
		$this_year = create_date('Y', $time_now, $board_config['board_timezone']);
		$date_today = create_date('Ymd', $time_now, $board_config['board_timezone']);
		$date_forward = create_date('Ymd', $time_now+($board_config['birthday_check_day']*86400), $board_config['board_timezone']);
	      while ($birthdayrow = $db->sql_fetchrow($result))
		{ 
		      $user_birthday2 = $this_year.($user_birthday = realdate("md",$birthdayrow['user_birthday'] )); 
      		if ( $user_birthday2 < $date_today ) $user_birthday2 += 10000;
			if ( $user_birthday2 > $date_today  && $user_birthday2 <= $date_forward ) 
			{ 
				// user are having birthday within the next days
				$user_age = ( $this_year.$user_birthday < $date_today ) ? $this_year - realdate ('Y',$birthdayrow['user_birthday'])+1 : $this_year- realdate ('Y',$birthdayrow['user_birthday']); 
				switch ($birthdayrow['user_level'])
				{
					case ADMIN :
		      			$birthdayrow['username'] = '<strong>' . $birthdayrow['username'] . '</strong>';
      					$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
						break;
					case MOD :
		      			$birthdayrow['username'] = '<strong>' . $birthdayrow['username'] . '</strong>'; 
      					$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
						break;
					default: $style_color = '';
				}
				$birthday_week_list .= ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $birthdayrow['user_id']) . '"' . $style_color .'>' . $birthdayrow['username'] . ' ('.$user_age.')</a>,'; 
			} else if ( $user_birthday2 == $date_today ) 
      		{ 
				//user have birthday today 
				$user_age = $this_year - realdate ( 'Y',$birthdayrow['user_birthday'] ); 
				switch ($birthdayrow['user_level'])
				{
					case ADMIN :
		      			$birthdayrow['username'] = '<strong>' . $birthdayrow['username'] . '</strong>'; 
      					$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
						break;
					case MOD :
			      		$birthdayrow['username'] = '<strong>' . $birthdayrow['username'] . '</strong>'; 
      					$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
						break;
					default: $style_color = '';
				}
				$birthday_today_list .= ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $birthdayrow['user_id']) . '"' . $style_color .'>' . $birthdayrow['username'] . ' ('.$user_age.')</a>,'; 
		      }
		}
		if ($birthday_today_list) $birthday_today_list[ strlen( $birthday_today_list)-1] = ' ';
		if ($birthday_week_list) $birthday_week_list[ strlen( $birthday_week_list)-1] = ' ';
	} 
	$db->sql_freeresult($result);
}
        //
        // Start output of page
        //
        define('SHOW_ONLINE', true);
        $page_title = $lang['Index'];
        include_once("includes/page_header.php");
        $template->set_filenames(array(
                'body' => 'index_body.tpl')
        );
        $template->assign_vars(array(
                'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
                'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
                'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
//+MOD: DHTML Collapsible Forum Index MOD
		'U_CFI_JSLIB'			=> 'includes/javascript/collapsible_forum_index.js',
		'CFI_COOKIE_NAME'		=> get_cfi_cookie_name(),
		'COOKIE_PATH'			=> $board_config['cookie_path'],
		'COOKIE_DOMAIN'			=> $board_config['cookie_domain'],
		'COOKIE_SECURE'			=> $board_config['cookie_secure'],
		'L_CFI_OPTIONS'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_options']),
		'L_CFI_OPTIONS_EX'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_options_ex']),
		'L_CFI_CLOSE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_close']),
		'L_CFI_DELETE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_delete']),
		'L_CFI_RESTORE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_restore']),
		'L_CFI_SAVE'			=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_save']),
		'L_CFI_EXPAND_ALL'		=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_Expand_all']),
		'L_CFI_COLLAPSE_ALL'	=> str_replace(array("'",' '), array("\'",'&nbsp;'), $lang['CFI_Collapse_all']),
		'IMG_UP_ARROW'			=> $images['up_arrow'],
		'IMG_DW_ARROW'			=> $images['down_arrow'],
		'IMG_PLUS'				=> $images['icon_sign_plus'],
		'IMG_MINUS'				=> $images['icon_sign_minus'],
		'SPACER'				=> $phpbb_root_path . 'images/spacer.gif',
//-MOD: DHTML Collapsible Forum Index MOD
                'FORUM_IMG' => $images['forum'],
                'FORUM_NEW_IMG' => $images['forum_new'],
                'FORUM_LOCKED_IMG' => $images['forum_locked'],
// Start add - Birthday MOD
		'L_WHOSBIRTHDAY_WEEK' => ($board_config['birthday_check_day'] > 1) ? sprintf( (($birthday_week_list) ? $lang['Birthday_week'] : $lang['Nobirthday_week']), $board_config['birthday_check_day']).$birthday_week_list : '',
		'L_WHOSBIRTHDAY_TODAY' => ($board_config['birthday_check_day']) ? ($birthday_today_list) ? $lang['Birthday_today'].$birthday_today_list : $lang['Nobirthday_today'] : '',
// End add - Birthday MOD
                'L_FORUM' => $lang['Forum'],
                'L_TOPICS' => $lang['Topics'],
                'L_REPLIES' => $lang['Replies'],
                'L_VIEWS' => $lang['Views'],
                'L_POSTS' => $lang['Posts'],
                'L_LASTPOST' => $lang['Last_Post'],
                'L_NO_NEW_POSTS' => $lang['No_new_posts'],
                'L_NEW_POSTS' => $lang['New_posts'],
                'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
                'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
                'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
                'L_MODERATOR' => $lang['Moderators'],
                'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
                'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'],
                'U_MARK_READ' => append_sid("index.$phpEx?mark=forums"))
        );
        //
	// Let's decide which categories we should display
	//
	$display_categories = array();
	for ($i = 0; $i < $total_forums; $i++ )
	{
		if ($is_auth_ary[$forum_data[$i]['forum_id']]['auth_view'])
		{
			$display_categories[$forum_data[$i]['cat_id']] = true;
		}
	}
	//
	// Okay, let's build the index
	//
	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];
		//
		// Yes, we should, so first dump out the category
		// title, then, if appropriate the forum list
		//
		if (isset($display_categories[$cat_id]) && $display_categories[$cat_id])
                {
                        $template->assign_block_vars('catrow', array(
//+MOD: DHTML Collapsible Forum Index MOD
				'DISPLAY' => (is_category_collapsed($cat_id) ? '' : 'none'),
//-MOD: DHTML Collapsible Forum Index MOD
                                'CAT_ID' => $cat_id,
                                'CAT_DESC' => $category_rows[$i]['cat_title'],
                                'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
                        );
                        if ( $viewcat == $cat_id || $viewcat == -1 )
                        {
                                for($j = 0; $j < $total_forums; $j++)
                                {
                                        if ( $forum_data[$j]['cat_id'] == $cat_id )
                                        {
                                                $forum_id = $forum_data[$j]['forum_id'];
   // Added by Attached Forums MOD
   $attached_id = $forum_data[$j]['attached_forum_id'];
						if ( $is_auth_ary[$forum_id]['auth_view'] && $attached_id == -1 )
						{
							$attached_forums = array();
							foreach ($attach as $key => $value)
							{
								$sub_forum_id = $value['forum_id'];
								if ($value['attached_forum_id']==$forum_id && $is_auth_ary[$sub_forum_id]['auth_view'])
								{
									//combining topic and post count for forum and subforums
									$forum_data[$j]['forum_posts']=$forum_data[$j]['forum_posts']+$value['forum_posts'];
									$forum_data[$j]['forum_topics']=$forum_data[$j]['forum_topics']+$value['forum_topics'];
									//END combining topic and post count
									//Last post link - check if any of subforums have newest posts and link to them instead
									if ($value['post_time']>$forum_data[$j]['post_time'])
									{
										$forum_data[$j]['user_id'] = $value['user_id'];
										$forum_data[$j]['post_username'] = $value['post_username'];
										$forum_data[$j]['forum_last_post_id'] = $value['forum_last_post_id'];
										$forum_data[$j]['post_time'] = $value['post_time'];
										$forum_data[$j]['username'] = $value['username'];
										$forum_data[$j]['topic_title'] = $value['topic_title'];
									}
									// END last post check
									$unread_topics = false;
									if ( $userdata['session_logged_in'] )
									{
										if (check_unread($value['forum_id']))
										{
											$attach_img = $images['icon_minipost_new'];
											$l_attach_img = $lang['New_posts'];
										}
										else
										{
											$attach_img = $images['icon_minipost'];
											$l_attach_img = $lang['No_new_posts'];
										}
									}
									else
									{
										$attach_img = $images['icon_minipost'];
										$l_attach_img = $lang['No_new_posts'];
									}
									$attached_forums[] = array(
										'sub_img'=>$attach_img,
										'sub_alt'=>$l_attach_img,
										'sub_name'=>$value['forum_name'],
										'sub_url'=>append_sid ('viewforum.php?f=' . $value['forum_id'] )
										);
								}
							}
// END Added by Attached Forums MOD
                                                if ( $is_auth_ary[$forum_id]['auth_view'] || in_array($forum_id, $itemformaccess))
                                                {
                                                        if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
                                                        {
                                                                $folder_image = $images['forum_locked'];
                                                                $folder_alt = $lang['Forum_locked'];
                                                        }
                                                        else
                                                        {
                                                                $unread_topics = false;
                                                                if ( $userdata['session_logged_in'] )
                                                                {
   // Added by Attached Forums MOD
$unread_topics=check_unread($forum_id);
   // END Added by Attached Forums MOD
                                                                }
                                                                $folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
                                                                $folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
                                                        }
                                                        $posts = $forum_data[$j]['forum_posts'];
                                                        $topics = $forum_data[$j]['forum_topics'];
                                                        if ( $forum_data[$j]['forum_last_post_id'] )
                                                        {
   // Modified by Attached Forums MOD
								if (strlen($forum_data[$j]['topic_title'])>=25)
								{
									$forum_data[$j]['topic_title']=substr($forum_data[$j]['topic_title'],0,25). "...";
								}
								$last_post_time = create_date($board_config['default_dateformat'], $forum_data[$j]['post_time'], $board_config['board_timezone']);
								$last_post = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '">'.$forum_data[$j]['topic_title'].' <img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
								$last_post .= '<br /> '; 
								$last_post .= ' '.$last_post_time;
								$last_post .= '<br /> ';
								$last_post .= ( $forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($forum_data[$j]['post_username'] != '' ) ? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $forum_data[$j]['user_id']) . '">' . CheckUsernameColor($forum_data[$j]['user_color_gc'], $forum_data[$j]['username']) . '</a> ';
   // END Modified by Attached Forums MOD
                                                        }
                                                        else
                                                        {
                                                                $last_post = $lang['No_Posts'];
                                                        }
                                                        if ( count($forum_moderators[$forum_id]) > 0 )
                                                        {
                                                                $l_moderators = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
                                                                $moderator_list = implode(', ', $forum_moderators[$forum_id]);
                                                        }
                                                        else
                                                        {
   // Modified by Attached Forums MOD
								$l_moderators = '';
								$moderator_list = '';
   // END Modified by Attached Forums MOD
                                                        }
                                                        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                                                        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
                                                        $template->assign_block_vars('catrow.forumrow',        array(
//+MOD: DHTML Collapsible Forum Index MOD
								'FORUM_ID' => $forum_id,
								'DISPLAY' => (is_category_collapsed($cat_id) ? 'none' : ''),
//-MOD: DHTML Collapsible Forum Index MOD
                                                                'ROW_COLOR' => '#' . $row_color,
                                                                'ROW_CLASS' => $row_class,
                                                                'FORUM_EDIT_IMG'	=> (($userdata['user_level'] == ADMIN) ? '&nbsp;&nbsp;<a href="#" onclick="window.open(\'modules/Forums/admin/admin_forums.'. $phpEx .'?mode=editforum&in_from=index&'. POST_FORUM_URL .'='. $forum_id .'&sid='. $userdata['session_id'] .'\',\'popup\',\'width=650,height=600,scrollbars=yes,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no\'); return false;"><img src="modules/Forums/templates/subSilver/images/forum_edit.gif" border="0"></a>' : ''),
                                                                'FORUM_FOLDER_IMG' => $folder_image,
                                                                'FORUM_NAME' => $forum_data[$j]['forum_name'],
                                                                'FORUM_DESC' => $forum_data[$j]['forum_desc'],
                                                                'POSTS' => $forum_data[$j]['forum_posts'],
                                                                'TOPICS' => $forum_data[$j]['forum_topics'],
                                                                'LAST_POST' => $last_post,
                                                                'MODERATORS' => $moderator_list,
                                                                'L_MODERATOR' => $l_moderators,
                                                                'L_FORUM_FOLDER_ALT' => $folder_alt,
                                                                'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
                                                        );
                               // Added by Attached Forums MOD
                     $attached_forum_count = count($attached_forums);
                     if($attached_forum_count)
                     {
					   $template->assign_block_vars('catrow.forumrow.switch_attached_forums', array(
                        'L_ATTACHED_FORUMS' => ($attached_forum_count ==1)? $lang['Attached_forum']: $lang['Attached_forums']
						));
						if (count($forum_moderators[$forum_id]) > 0 )
						{
						   $template->assign_block_vars('catrow.forumrow.switch_attached_forums.br', array());
						}
                        for($k = 0; $k < $attached_forum_count; $k++)
                        {
                           $template->assign_block_vars('catrow.forumrow.switch_attached_forums.attached_forums', array(
                              'FORUM_IMAGE' => $attached_forums[$k]['sub_img'],
                              'FORUM_NAME' => $attached_forums[$k]['sub_name'],
                              'L_FORUM_IMAGE' => $attached_forums[$k]['sub_alt'],
                              'U_VIEWFORUM' => $attached_forums[$k]['sub_url']
                           ));
                        }
                     }
   // END added by Attached Forums MOD
                                                }
                                        }
                                }
                        }
                }
        } // for ... categories
           }
}// if ... total_categories
else
{
        message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

/*****Glance Enable v.2.0.0 updated(01232014) DocHavoc***Start***/
$row = $db->sql_fetchrow($db->sql_query("SELECT glance_enable FROM ".$prefix."_fga_config"));
$glance_enable = $row['glance_enable'];
if (!$sql) {
    die('Could not query Glance Enable:' . mysql_error());
}
if( $glance_enable == 1) {
/*****************************************************/
/* Forum - At A Glance v.2.0.0                 START */
/*****************************************************/
        include_once($phpbb_root_path . 'glance.php');
/*****************************************************/
/* Forum - At A Glance v.2.0.0                   END */
/*****************************************************/	
/*****Glance Enable v.2.0.0 updated(01232014) DocHavoc***End***/
}  
//
// Generate the page
//
$template->pparse('body');
include_once("includes/page_tail.php");
?>