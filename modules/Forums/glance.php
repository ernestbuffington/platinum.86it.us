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
/* Copyright (c) 2014 by http://www.platinumnukepro.com          */
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

define('IN_GLANCE', true);

include_once(NUKE_BASE_DIR. 'modules/Forums/glance_config.php');
	//
	// GET USER LAST VISIT
	//
	$glance_last_visit = $userdata['user_lastvisit'];
	$glance_recent_offset = $_GET['glance_recent_offset'];
	//
	// MESSAGE TRACKING
	//
	if ( !isset($tracking_topics) && $glance_track ) $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : '';
	
	// CHECK FOR BAD WORDS
	//
	// Define censored word matches
	//
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

    // set the topic title sql depending on the character limit	set in glance_config
    $sql_title = ($glance_topic_length) ? ", LEFT(t.topic_title, " . $glance_topic_length . ") as topic_title" : ", t.topic_title";
    
	//
	// GET THE LATEST NEWS TOPIC
	//
	if ( $glance_num_news )
	{
		$news_data = $db->sql_fetchrow($result);
		$sql = "
            SELECT 
				f.forum_id, f.forum_name" . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status,
				p2.post_time, p2.poster_id, 
				u.username as last_username, u.user_color_gc as last_color, 
                                u2.username as author_username, u2.user_color_gc as author_color
			FROM " 
				. FORUMS_TABLE . " f, "
				. POSTS_TABLE . " p, " 
				. TOPICS_TABLE . " t, " 
				. POSTS_TABLE . " p2, " 
				. USERS_TABLE . " u, "
				. USERS_TABLE . " u2				
			WHERE 
				f.forum_id IN (" . $glance_news_forum_id . ") 
				AND t.forum_id = f.forum_id
				AND p.post_id = t.topic_first_post_id
				AND p2.post_id = t.topic_last_post_id
				AND t.topic_moved_id = 0
				AND p2.poster_id = u.user_id
				AND t.topic_poster = u2.user_id
			ORDER BY t.topic_last_post_id DESC";
		$sql .= ($glance_news_offset) ? " LIMIT " . $glance_news_offset . ", " . $glance_num_news : " LIMIT " . $glance_num_news;

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not query new news information", "", __LINE__, __FILE__, $sql);
		}
		$latest_news = array();
		while ( $topic_row = $db->sql_fetchrow($result) )
		{
			$topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
			$latest_news[] = $topic_row;
		}
		$db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our news topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id IN (" . $glance_news_forum_id . ")";
        if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
		}
    	$row = $db->sql_fetchrow($result);
		$overall_news_topics = $row['topic_total'];
		$db->sql_freeresult($result);
        // MOD NAV END
	}
	
	//
	// GET THE LAST 5 TOPICS
	//
	if ( $glance_num_recent )
	{
		$glance_auth_level = ( $glance_auth_read ) ? AUTH_VIEW : AUTH_ALL;
		$is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);
		
		$forumsignore = $glance_news_forum_id;
		if ( $num_forums = count($is_auth_ary) )
		{
			while ( list($forum_id, $auth_mod) = each($is_auth_ary) )
			{
				$unauthed = false;
				if ( !$auth_mod['auth_view'] )
				{
					$unauthed = true;
				}
				if ( !$glance_auth_read && !$auth_mod['auth_read'] )
				{
					$unauthed = true;
				}
				if ( $unauthed )
				{
					$forumsignore .= ($forumsignore) ? ',' . $forum_id : $forum_id;
				}
			}
		}
		
        $forumsignore .= ($forumsignore && $glance_recent_ignore) ? ',' : '';
		$sql = "
			SELECT 	
				f.forum_id, f.forum_name" . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type,
				p2.post_time, p2.poster_id, 
				u.username as last_username, u.user_color_gc as last_color, 
                                u2.username as author_username, u2.user_color_gc as author_color
			FROM " 
				. FORUMS_TABLE . " f, "
				. POSTS_TABLE . " p, " 
				. TOPICS_TABLE . " t, " 
				. POSTS_TABLE . " p2, " 
				. USERS_TABLE . " u, "
				. USERS_TABLE . " u2				
			WHERE 
				f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . ") 
				AND t.forum_id = f.forum_id
				AND p.post_id = t.topic_first_post_id
				AND p2.post_id = t.topic_last_post_id
				AND t.topic_moved_id = 0
				AND p2.poster_id = u.user_id
				AND t.topic_poster = u2.user_id
			ORDER BY t.topic_last_post_id DESC";
		$sql .= ($glance_recent_offset) ? " LIMIT " . $glance_recent_offset . ", " . $glance_num_recent : " LIMIT " . $glance_num_recent;
			
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not query latest topic information", "", __LINE__, __FILE__, $sql);
		}
		$latest_topics = array();
        $latest_anns = array();
        $latest_stickys = array();
		while ( $topic_row = $db->sql_fetchrow($result) )
		{
			$topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
            switch ($topic_row['topic_type'])
                {
                    case POST_ANNOUNCE:
            			$latest_anns[] = $topic_row;
                        break;
                    case POST_STICKY:
            			$latest_stickys[] = $topic_row;
                        break;
                    default:
                        $latest_topics[] = $topic_row;
                        break;
                }
		}
        $latest_topics = array_merge($latest_anns, $latest_stickys, $latest_topics);
		$db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our recent topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . $glance_news_forum_id . ")";
        if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
		}
    	$row = $db->sql_fetchrow($result);
		$overall_total_topics = $row['topic_total'];
		$db->sql_freeresult($result);
        // MOD NAV END
	}
	
	//
	// BEGIN OUTPUT
	//
	$template->set_filenames(array(
		'glance_output' => 'glance_body.tpl')
	);
	
	if ( $glance_num_news )
	{
		if ( !empty($latest_news) )
		{
			$bullet_pre = '<img src="';
			
			for ( $i = 0; $i < count($latest_news); $i++ )
			{
				if ( $userdata['session_logged_in'] )
				{
					$unread_topics = false;
					$topic_id = $latest_news[$i]['topic_id'];
					if ( $latest_news[$i]['post_time'] > $glance_last_visit )
					{
						$unread_topics = true;
						if( !empty($tracking_topics[$topic_id]) && $glance_track )
						{
							if( $tracking_topics[$topic_id] >= $latest_news[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}
					}
					$shownew = $unread_topics;
				}
				else
				{
					$unread_topics = false;
					$shownew = ($board_config['time_today'] < $latest_news[$i]['post_time']);
				}

				$bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ?  $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" />';

				$newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '' : '';
				
				$topic_link = $glance_forum_dir . 'viewtopic&t=' . $latest_news[$i]['topic_id'] . $newest_code;
				
				//
				// MOD TODAY AT BEGIN
				//
				//if ( $board_config['time_today'] < $latest_news[$i]['post_time'])
				//{ 
				//	$last_post_time = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $latest_news[$i]['post_time'], $board_config['board_timezone'])); 
				//}
				//else if ( $board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
				//{ 
				//	$last_post_time = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $latest_news[$i]['post_time'], $board_config['board_timezone'])); 
				//}
				// MOD TODAY AT END
				$last_poster = ($latest_news[$i]['poster_id'] == ANONYMOUS ) ? ( ($latest_news[$i]['last_username'] != '' ) ? $latest_news[$i]['last_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . '='  . $latest_news[$i]['poster_id']) . '">' . CheckUsernameColor($latest_news[$i]['last_color'], $latest_news[$i]['last_username']) . '</a> ';
                                $last_poster .= '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_news[$i]['topic_last_post_id']) . '#' . $latest_news[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
                                $topic_poster = ($latest_news[$i]['topic_poster'] == ANONYMOUS ) ? ( ($latest_news[$i]['author_username'] != '' ) ? $latest_news[$i]['author_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . '='  . $latest_news[$i]['topic_poster']) . '">' . CheckUsernameColor($latest_news[$i]['author_color'], $latest_news[$i]['author_username']) . '</a> ';
				$template->assign_block_vars('news', array(
					'BULLET' => $bullet_full,					
					'TOPIC_TITLE' => $latest_news[$i]['topic_title'],
					'TOPIC_LINK' => $topic_link,
					'TOPIC_TIME' => $last_post_time,

					'TOPIC_POSTER' => $topic_poster,
					'TOPIC_VIEWS' => $latest_news[$i]['topic_views'],
					'TOPIC_REPLIES' => $latest_news[$i]['topic_replies'],
					'LAST_POSTER' => $last_poster,
					'FORUM_TITLE' => $latest_news[$i]['forum_name'],
					'FORUM_LINK' => $glance_forum_dir . 'viewforum&f=' . $latest_news[$i]['forum_id'])

					);
			}
			// MOD NAV BEGIN
			if (($glance_news_offset > 0) or ($glance_news_offset+$glance_num_news < $overall_news_topics))
			{
				$new_url = '<a href="' . $glance_forum_dir . 'index&glance_news_offset=';
				if ($glance_news_offset > 0) 
				{ 
					// if we're not on the first record, we can always go backwards
					$prev_news_url = ($glance_recent_offset > 0) ? $new_url . ($glance_news_offset-$glance_num_news) . '&glance_recent_offset=' . $glance_recent_offset . '" class="th">&lt;&lt; Prev ' . $glance_num_news . '</a>' : $new_url . ($glance_news_offset-$glance_num_news).'" class="th">&lt;&lt; Prev ' . $glance_num_news . '</a>';
				}
				if ($glance_news_offset+$glance_num_news < $overall_total_topics)
				{
					// offset + limit gives us the maximum record number 
					// that we could have displayed on this page. if it's
					// less than the total number of entries, that means
					// there are more entries to see, and we can go forward
					$next_news_url = ($glance_recent_offset > 0) ? $new_url . ($glance_news_offset+$glance_num_news) . '&glance_recent_offset=' . $glance_recent_offset . '" class="th">Next ' . $glance_num_news . ' &gt;&gt;</a>' : $new_url . ($glance_news_offset+$glance_num_news).'" class="th">Next ' . $glance_num_news . ' &gt;&gt;</a>';
				}
			}
			// MOD NAV END
		}
		else
		{
			$template->assign_block_vars('news', array(
			'BULLET' => '<img src="' . $images['forum'] . '" border="0" />', $glance_recent_bullet_old,
					
			'TOPIC_TITLE' => 'None')
			);
		}
	}
	
	if ( $glance_num_recent )
	{
		$glance_info = 'counted recent';
		$bullet_pre = '<img src="';

		if ( !empty($latest_topics) )
		{
			for ( $i = 0; $i < count($latest_topics); $i++ )
			{
				if ( $userdata['session_logged_in'] )
				{
					$unread_topics = false;
					$topic_id = $latest_topics[$i]['topic_id'];
					if ( $latest_topics[$i]['post_time'] > $glance_last_visit )
					{
						$unread_topics = true;
						if( !empty($tracking_topics[$topic_id]) && $glance_track )
						{
							if( $tracking_topics[$topic_id] >= $latest_topics[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}
					}
					$shownew = $unread_topics;
				}
				else
				{
					$unread_topics = false;
					$shownew = ($board_config['time_today'] < $latest_topics[$i]['post_time']);
				}

                switch ($latest_topics[$i]['topic_type'])
                {
                    case POST_ANNOUNCE:
        				$bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" />';
                        break;
                    case POST_STICKY:
        				$bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_sticky_new'] :  $images['folder_sticky'] ) . '" border="0" />';
                        break;
                    default:
                        if ($latest_topics[$i]['topic_status'] == TOPIC_LOCKED)
                        {
            				$folder = $images['folder_locked'];
			            	$folder_new = $images['folder_locked_new'];
                        }
                        else if ($latest_topics[$i]['topic_replies'] >= $board_config['hot_threshold'])
        				{
        					$folder = $images['folder_hot'];
        					$folder_new = $images['folder_hot_new'];
        				}
        				else
        				{
        					$folder = $images['folder'];
        					$folder_new = $images['folder_new'];
        				}

        				$bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $folder_new :  $folder ) . '" border="0" />';
                        break;
                }
				$newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '' : '';

//				$topic_link = $glance_forum_dir . 'viewtopic&t=' . $latest_topics[$i]['topic_id'] . $newest_code;
// GO DIRECTLY TO LATEST POST OR TO TOP OF TOPIC - SET IN glance_config.php - sgtmudd
				if ($glance_direct_latest == 1)
				{
				$topic_link = $glance_forum_dir . 'viewtopic&t=' . $latest_topics[$i]['topic_id'] . $newest_code;
				} else {
				$topic_link = $glance_forum_dir . 'viewtopic&p=' . $latest_topics[$i]['topic_last_post_id'] . '#' . $latest_topics[$i]['topic_last_post_id'];  }
				//$topic_poster = ($latest_topics[$i]['topic_poster'] == ANONYMOUS ) ? ( ($latest_topics[$i]['author_username'] != '' ) ? $latest_topics[$i]['author_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['topic_poster']) . '">' . $latest_topics[$i]['author_username'] . '</a> ';

				//$last_post_time = create_date($board_config['default_dateformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']);
				//$last_poster = ($latest_topics[$i]['poster_id'] == ANONYMOUS ) ? ( ($latest_topics[$i]['last_username'] != '' ) ? $latest_topics[$i]['last_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['poster_id']) . '">' . $latest_topics[$i]['last_username'] . '</a> ';
				//$last_poster .= '<a href="' . append_sid("viewtopic&"  . POST_POST_URL . '=' . $latest_topics[$i]['topic_last_post_id']) . '#' . $latest_topics[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
				     
				$topic_poster = ($latest_topics[$i]['topic_poster'] == ANONYMOUS ) ? ( ($latest_topics[$i]['author_username'] != '' ) ? $latest_topics[$i]['author_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . '='  . $latest_topics[$i]['topic_poster']) . '">' . CheckUsernameColor($latest_topics[$i]['author_color'], $latest_topics[$i]['author_username']) . '</a> ';
                                
                                $last_post_time = create_date($board_config['default_dateformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']); 
                                $last_poster = ($latest_topics[$i]['poster_id'] == ANONYMOUS ) ? ( ($latest_topics[$i]['last_username'] != '' ) ? $latest_topics[$i]['last_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . '='  . $latest_topics[$i]['poster_id']) . '">' . CheckUsernameColor($latest_topics[$i]['last_color'], $latest_topics[$i]['last_username']) . '</a> '; 
                                $last_poster .= '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_topics[$i]['topic_last_post_id']) . '#' . $latest_topics[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';				


				//
				// MOD TODAY AT BEGIN
				//
				//if ( $board_config['time_today'] < $latest_topics[$i]['post_time'])
				//{
				//	$last_post_time = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']));
				//}
				//else if ( $board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
				//{
				//	$last_post_time = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']));
				//}
				// MOD TODAY AT END

				$template->assign_block_vars('recent', array(
					'BULLET' => $bullet_full,
					'TOPIC_LINK' => $topic_link,
					'TOPIC_TITLE' => $latest_topics[$i]['topic_title'],
					'TOPIC_POSTER' => $topic_poster,
					'TOPIC_VIEWS' => $latest_topics[$i]['topic_views'],
					'TOPIC_REPLIES' => $latest_topics[$i]['topic_replies'],
					'LAST_POST_TIME' => $last_post_time,
					'LAST_POSTER' => $last_poster,
					'FORUM_TITLE' => $latest_topics[$i]['forum_name'],
					'FORUM_LINK' => $glance_forum_dir . 'viewforum&f=' . $latest_topics[$i]['forum_id'])
				);
			}
			
			// MOD NAV BEGIN
			if (($glance_recent_offset > 0) or ($glance_recent_offset+$glance_num_recent < $overall_total_topics))
			{
				$new_url = '<a href="' . $glance_forum_dir . 'index&glance_recent_offset=';
				if ($glance_recent_offset > 0) 
				{ 
					// if we're not on the first record, we can always go backwards
					$prev_recent_url = ($glance_news_offset > 0) ? $new_url . ($glance_recent_offset-$glance_num_recent) . '&glance_news_offset=' . $glance_news_offset . '" class="th">&lt;&lt; Prev ' . $glance_num_recent . '</a>' : $new_url . ($glance_recent_offset-$glance_num_recent).'" class="th">&lt;&lt; Prev ' . $glance_num_recent . '</a>';
				}
				if ($glance_recent_offset+$glance_num_recent < $overall_total_topics)
				{
					// offset + limit gives us the maximum record number 
					// that we could have displayed on this page. if it's
					// less than the total number of entries, that means
					// there are more entries to see, and we can go forward
					$next_recent_url = ($glance_news_offset > 0) ? $new_url . ($glance_recent_offset+$glance_num_recent) . '&glance_news_offset=' . $glance_news_offset . '" class="th">Next ' . $glance_num_recent . ' &gt;&gt;</a>' : $new_url . ($glance_recent_offset+$glance_num_recent).'" class="th">Next ' . $glance_num_recent . ' &gt;&gt;</a>';
				}
			}
			// MOD NAV END
		}
		else
		{
			$template->assign_block_vars('recent', array(
			'BULLET' => '<img src="' . $images['forum'] . '" border="0" />', $glance_recent_bullet_old,
					
			'TOPIC_TITLE' => 'None')
			);
		}
	}
	
	if ( $glance_num_news )
	{
		$template->assign_block_vars('switch_glance_news', array(
			'NEXT_URL' => $next_news_url,
			'PREV_URL' => $prev_news_url)
        );

    	// MOD CAT ROLLOUT BEGIN
        //$news_on = !isset($_COOKIE['phpbbGlance_news']) || !empty($_COOKIE['phpbbGlance_news']) ? true : false;
        //if( $news_on )
        //{
        //   $template->assign_block_vars('switch_glance_news.switch_news_on', array());
        //}
        //else
        //{
        //    $template->assign_block_vars('switch_glance_news.switch_news_off', array());
        //}
        // MOD CAT ROLLOUT END
	}
	if ( $glance_num_recent )
	{
		$template->assign_block_vars('switch_glance_recent', array(
			'NEXT_URL' => $next_recent_url,
			'PREV_URL' => $prev_recent_url)
		);

    	// MOD CAT ROLLOUT BEGIN
        //$recent_on = !isset($_COOKIE['phpbbGlance_recent']) || !empty($_COOKIE['phpbbGlance_recent']) ? true : false;
        //if( $recent_on )
        //{
        //    $template->assign_block_vars('switch_glance_recent.switch_recent_on', array());
        //}
        //else
        //{
        //   $template->assign_block_vars('switch_glance_recent.switch_recent_off', array());
        //}
        // MOD CAT ROLLOUT END
	}

	$template->assign_vars(array(
		'GLANCE_TABLE_WIDTH' =>	$glance_table_width,
		'RECENT_HEADING' => $glance_recent_heading,
		'NEWS_HEADING' => $glance_news_heading,

		'L_TOPICS' => $lang['Topics'],
		'L_REPLIES' => $lang['Replies'],
		'L_VIEWS' => $lang['Views'],
		'L_LASTPOST' => $lang['Last_Post'], 
		'L_AUTHOR' => $lang['Author'])		
		);
		
	$template->assign_var_from_handle('GLANCE_OUTPUT', 'glance_output');
	
// THE END
?>
