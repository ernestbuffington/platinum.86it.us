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
$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');
$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');
//
// This function will prepare a posted message for
// entry into the database.
//
function prepare_message($message, $html_on, $bbcode_on, $smile_on, $bbcode_uid = 0)
{
        global $board_config, $html_entities_match, $html_entities_replace;
        //
        // Clean up the message
        //
        $message = trim($message);
        $message = str_replace("(eval","bad_tag",$message);
        $message = str_replace("document.cookie","bad_tag",$message);
        if ($html_on)
        {
                $allowed_html_tags = split(',', $board_config['allow_html_tags']);
                $end_html = 0;
                $start_html = 1;
                $tmp_message = '';
                $message = ' ' . $message . ' ';
                while ($start_html = strpos($message, '<', $start_html))
                {
                        $tmp_message .= preg_replace($html_entities_match, $html_entities_replace, substr($message, $end_html + 1, ($start_html - $end_html - 1)));
                        if ($end_html = strpos($message, '>', $start_html))
                        {
                                $length = $end_html - $start_html + 1;
                                $hold_string = substr($message, $start_html, $length);
                                if (($unclosed_open = strrpos(' ' . $hold_string, '<')) != 1)
                                {
                                        $tmp_message .= preg_replace($html_entities_match, $html_entities_replace, substr($hold_string, 0, $unclosed_open - 1));
                                        $hold_string = substr($hold_string, $unclosed_open - 1);
                                }
                                $tagallowed = false;
                                for ($i = 0; $i < sizeof($allowed_html_tags); $i++)
                                {
                                        $match_tag = trim($allowed_html_tags[$i]);
                                        if (preg_match('#^<\/?' . $match_tag . '[> ]#i', $hold_string))
                                        {
						$tagallowed = (preg_match('#^<\/?' . $match_tag . ' .*?(style[\t ]*?=|on[\w]+[\t ]*?=)#i', $hold_string)) ? false : true;
                                        }
                                }
                                $tmp_message .= ($length && !$tagallowed) ? preg_replace($html_entities_match, $html_entities_replace, $hold_string) : $hold_string;
                                $start_html += $length;
                        }
                        else
                        {
                                $tmp_message .= preg_replace($html_entities_match, $html_entities_replace, substr($message, $start_html, strlen($message)));
                                $start_html = strlen($message);
                                $end_html = $start_html;
                        }
                }
		if (!$end_html || ($end_html != strlen($message) && $tmp_message != ''))
                {
                        $tmp_message .= preg_replace($html_entities_match, $html_entities_replace, substr($message, $end_html + 1));
                }
                $message = ($tmp_message != '') ? trim($tmp_message) : trim($message);
        }
        else
        {
                $message = preg_replace($html_entities_match, $html_entities_replace, $message);
        }
        if($bbcode_on && $bbcode_uid != '')
        {
                $message = bbencode_first_pass($message, $bbcode_uid);
        }
        return $message;
}
function unprepare_message($message)
{
        global $unhtml_specialchars_match, $unhtml_specialchars_replace;
        return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}
//
// Prepare a message for posting
//
function prepare_post(&$mode, &$post_data, &$bbcode_on, &$html_on, &$smilies_on, &$error_msg, &$username, &$bbcode_uid, &$subject, &$message, &$poll_title, &$poll_options, &$poll_length)
{
        global $board_config, $userdata, $lang, $phpEx, $phpbb_root_path;
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0  START */
/*****************************************************/
		// Check username
		if ($board_config['guests_need_name'] && empty($username) && !$userdata['session_logged_in']) {
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Username_needed'] : $lang['Username_needed'];
		} else if (!empty($username)) {
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0    END */
/*****************************************************/
		$username = phpbb_clean_username($username);
                if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))
                {
                        include_once("includes/functions_validate.php");
                        $result = validate_username($username);
                        if ($result['error'])
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
                        }
                }
                else
                {
                        $username = '';
                }
        }
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2       START */
/*****************************************************/
	if (substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) > $board_config['max_smilies'] )
	{
		$to_much_smilies = substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) - $board_config['max_smilies'];
		$to_many_smilies = sprintf($lang['Max_smilies_per_post'], $board_config['max_smilies'], $to_much_smilies);
		$error_msg .= ( !empty($error_msg) ) ? '<br />' . $to_many_smilies : $to_many_smilies;
	}
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2         END */
/*****************************************************/
        // Check subject
        if (!empty($subject))
        {
                $subject = htmlspecialchars(trim($subject));
        }
        else if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
        }
        // Check message
        if (!empty($message))
        {
                $bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
                $message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
        }
        else if ($mode != 'delete' && $mode != 'poll_delete')
        {
                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
        }
        //
        // Handle poll stuff
        //
        if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {
                $poll_length = (isset($poll_length)) ? max(0, intval($poll_length)) : 0;
                if (!empty($poll_title))
                {
                        $poll_title = htmlspecialchars(trim($poll_title));
                }
                if(!empty($poll_options))
                {
                        $temp_option_text = array();
                        while(list($option_id, $option_text) = @each($poll_options))
                        {
                                $option_text = trim($option_text);
                                if (!empty($option_text))
                                {
                                        $temp_option_text[intval($option_id)] = htmlspecialchars($option_text);
                                }
                        }
                        $option_text = $temp_option_text;
                        if (count($poll_options) < 2)
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_few_poll_options'] : $lang['To_few_poll_options'];
                        }
                        else if (count($poll_options) > $board_config['max_poll_options'])
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_many_poll_options'] : $lang['To_many_poll_options'];
                        }
                        else if ($poll_title == '')
                        {
                                $error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_poll_title'] : $lang['Empty_poll_title'];
                        }
                }
        }
        return;
}
//
// Post a new topic/reply/poll or edit existing post/poll
//-- mod : quick title edition -------------------------------------------------
// here we added
//	, $attribute_id
//-- modify
function submit_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id, &$topic_type, &$bbcode_on, &$html_on, &$smilies_on, &$attach_sig, &$bbcode_uid, &$post_username, &$post_subject, &$post_message, &$poll_title, &$poll_options, &$poll_length, $attribute_id)
{
/*****************************quick title edition************************/
        global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
        global $userdata, $user_ip;
        $GLOBALS['cm_posting']->update_delete($mode, $post_data, $forum_id, $topic_id, $post_id);
        include_once("includes/functions_search.php");
        $current_time = time();
        if ($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost')
        {
                //
                // Flood control
                //
                $where_sql = ($userdata['user_id'] == ANONYMOUS) ? "poster_ip = '$user_ip'" : 'poster_id = ' . $userdata['user_id'];
                $sql = "SELECT MAX(post_time) AS last_post_time
                        FROM " . POSTS_TABLE . "
                        WHERE $where_sql";
                if ($result = $db->sql_query($sql))
                {
                        if ($row = $db->sql_fetchrow($result))
                        {
                                if (intval($row['last_post_time']) > 0 && ($current_time - intval($row['last_post_time'])) < intval($board_config['flood_interval']))
                                {
                                        message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
                                }
                        }
                }
/*****************************************************/
/* Forum - Double Post Control v.1.1.0         START */
/*****************************************************/
		$lastposttime = intval($row['last_post_time']);
		if($mode != 'editpost')
		{
			$sql = "SELECT pt.post_text, pt.bbcode_uid
				FROM " . POSTS_TABLE . " p, " . POSTS_TEXT_TABLE . " pt
				WHERE $where_sql AND p.post_time = $lastposttime AND pt.post_id = p.post_id
				LIMIT 1";
			if ($result = $db->sql_query($sql))
			{
				if ($row = $db->sql_fetchrow($result))
				{
					// Update BBCode to current UID
					$row['post_text'] = str_replace(":" . $row['bbcode_uid'] . "]", ":" . $bbcode_uid . "]", $row['post_text']);
					if ($row['post_text'] == $post_message)
					{
						message_die(GENERAL_MESSAGE, $lang['Double_Post_Error']);
					}
				}
				$db->sql_freeresult($result);
			}
		}
/************* Quote fix ***************/
$post_subject = addslashes($post_subject);
$post_message = addslashes($post_message);
/************* Quote fix ***************/
/*****************************************************/
/* Forum - Double Post Control v.1.1.0           END */
/*****************************************************/
        }
        if ($mode == 'editpost')
        {
                remove_search_post($post_id);
        }
        if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
        {
                $topic_vote = (!empty($poll_title) && count($poll_options) >= 2) ? 1 : 0;
/*****************************quick title edition************************/
		$attribute = ($attribute_id > -1) ? implode(',', array($attribute_id, $userdata['user_id'], time())) : '';
/*****************************quick title edition************************/
                $sql  = ($mode != "editpost") ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type, topic_vote) VALUES ('$post_subject', " . $userdata['user_id'] . ", '$current_time', '$forum_id', " . TOPIC_UNLOCKED . ", '$topic_type', '$topic_vote')" : "UPDATE " . TOPICS_TABLE . " SET topic_title = '$post_subject', topic_type = $topic_type " . (($post_data['edit_vote'] || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = '$topic_id'";
/*****************************quick title edition************************/
				if ( $mode != 'editpost' )
				{
					$sql = str_replace('INSERT INTO ' . TOPICS_TABLE . ' (', 'INSERT INTO ' . TOPICS_TABLE . ' (topic_attribute, ', $sql);
					$sql = str_replace('VALUES (', 'VALUES (\'' . $attribute . '\', ', $sql);
				}
				else
				{
					$sql = str_replace('SET ', 'SET topic_attribute = \'' . $attribute . '\', ', $sql);
				}
/*****************************quick title edition************************/
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
                if ($mode == 'newtopic')
                {
                        $topic_id = $db->sql_nextid();
                        update_points(10);
                }
        }
/*****************************************************/
/* Forum - Log Actions v.1.1.6                 START */
/*****************************************************/
if ($mode == 'newtopic')
           if ( $topic_type == POST_GLOBAL_ANNOUNCE )
           log_action('Global Announcement', $topic_id, $userdata['user_id'], $userdata['username']);
           if ( $topic_type == POST_ANNOUNCE )
           log_action('Announcement', $topic_id, $userdata['user_id'], $userdata['username']);
           else if ( $topic_type == POST_STICKY )
           log_action('Sticky', $topic_id, $userdata['user_id'], $userdata['username']);
/*****************************************************/
/* Forum - Log Actions v.1.1.6                   END */
/*****************************************************/
        $edited_sql = ($mode == 'editpost' && !$post_data['last_post'] && $post_data['poster_post']) ? ", post_edit_time = $current_time, post_edit_count = post_edit_count + 1 " : "";
        $sql = ($mode != "editpost") ? "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip, enable_bbcode, enable_html, enable_smilies, enable_sig) VALUES ('$topic_id', '$forum_id', " . $userdata['user_id'] . ", '$post_username', '$current_time', '$user_ip', '$bbcode_on', '$html_on', '$smilies_on', '$attach_sig')" : "UPDATE " . POSTS_TABLE . " SET post_username = '$post_username', enable_bbcode = '$bbcode_on', enable_html = '$html_on', enable_smilies = '$smilies_on', enable_sig = '$attach_sig'" . $edited_sql . " WHERE post_id = '$post_id'";
        if (!$db->sql_query($sql, BEGIN_TRANSACTION))
        {
                message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
        if ($mode != 'editpost')
        {
                $post_id = $db->sql_nextid();
        }
        $sql = ($mode != 'editpost') ? "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, bbcode_uid, post_text) VALUES ('$post_id', '$post_subject', '$bbcode_uid', '$post_message')" : "UPDATE " . POSTS_TEXT_TABLE . " SET post_text = '$post_message',  bbcode_uid = '$bbcode_uid', post_subject = '$post_subject' WHERE post_id = '$post_id'";
        if (!$db->sql_query($sql))
        {
                message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
        add_search_words('single', $post_id, stripslashes($post_message), stripslashes($post_subject));
        //
        // Add poll
        //
        if (($mode == 'newtopic' || ($mode == 'editpost' && $post_data['edit_poll'])) && !empty($poll_title) && count($poll_options) >= 2)
        {
                $sql = (!$post_data['has_poll']) ? "INSERT INTO " . VOTE_DESC_TABLE . " (topic_id, vote_text, vote_start, vote_length) VALUES ('$topic_id', '$poll_title', '$current_time', " . ($poll_length * 86400) . ")" : "UPDATE " . VOTE_DESC_TABLE . " SET vote_text = '$poll_title', vote_length = " . ($poll_length * 86400) . " WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
                $delete_option_sql = '';
                $old_poll_result = array();
                if ($mode == 'editpost' && $post_data['has_poll'])
                {
                        $sql = "SELECT vote_option_id, vote_result
                                FROM " . VOTE_RESULTS_TABLE . "
                                WHERE vote_id = '$poll_id'
                                ORDER BY vote_option_id ASC";
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain vote data results for this topic', '', __LINE__, __FILE__, $sql);
                        }
                        while ($row = $db->sql_fetchrow($result))
                        {
                                $old_poll_result[$row['vote_option_id']] = $row['vote_result'];
                                if (!isset($poll_options[$row['vote_option_id']]))
                                {
                                        $delete_option_sql .= ($delete_option_sql != '') ? ', ' . $row['vote_option_id'] : $row['vote_option_id'];
                                }
                        }
                }
                else
                {
                        $poll_id = $db->sql_nextid();
                }
                @reset($poll_options);
                $poll_option_id = 1;
                while (list($option_id, $option_text) = each($poll_options))
                {
                        if (!empty($option_text))
                        {
                                $option_text = str_replace("\'", "''", htmlspecialchars($option_text));
                                $poll_result = ($mode == "editpost" && isset($old_poll_result[$option_id])) ? $old_poll_result[$option_id] : 0;
                                $sql = ($mode != "editpost" || !isset($old_poll_result[$option_id])) ? "INSERT INTO " . VOTE_RESULTS_TABLE . " (vote_id, vote_option_id, vote_option_text, vote_result) VALUES ('$poll_id', '$poll_option_id', '$option_text', '$poll_result')" : "UPDATE " . VOTE_RESULTS_TABLE . " SET vote_option_text = '$option_text', vote_result = '$poll_result' WHERE vote_option_id = '$option_id' AND vote_id = '$poll_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                                }
                                $poll_option_id++;
                        }
                }
                if ($delete_option_sql != '')
                {
                        $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                                WHERE vote_option_id IN ($delete_option_sql)
                                        AND vote_id = '$poll_id'";
                        if (!$db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, 'Error deleting pruned poll options', '', __LINE__, __FILE__, $sql);
                        }
                }
        }
$cash_message = $GLOBALS['cm_posting']->update_post($mode, $post_data, $forum_id, $topic_id, $post_id, $topic_type, $bbcode_uid, $post_username, $post_message);
        $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">';
        $message = $lang['Stored'] . '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
        return false;
}
//
// Update post stats and details
//
function update_post_stats(&$mode, &$post_data, &$forum_id, &$topic_id, &$post_id, &$user_id)
{
        global $db;
        $sign = ($mode == 'delete') ? '- 1' : '+ 1';
        $forum_update_sql = "forum_posts = forum_posts $sign";
        $topic_update_sql = '';
        if ($mode == 'delete')
        {
                if ($post_data['last_post'])
                {
                        if ($post_data['first_post'])
                        {
                                $forum_update_sql .= ', forum_topics = forum_topics - 1';
                        }
                        else
                        {
                                $topic_update_sql .= 'topic_replies = topic_replies - 1';
                                $sql = "SELECT MAX(post_id) AS last_post_id
                                        FROM " . POSTS_TABLE . "
                                        WHERE topic_id = '$topic_id'";
                                if (!($result = $db->sql_query($sql)))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
                                if ($row = $db->sql_fetchrow($result))
                                {
                                        $topic_update_sql .= ', topic_last_post_id = ' . $row['last_post_id'];
                                }
                        }
                        if ($post_data['last_topic'])
                        {
                                $sql = "SELECT MAX(post_id) AS last_post_id
                                        FROM " . POSTS_TABLE . "
                                        WHERE forum_id = '$forum_id'";
                                if (!($result = $db->sql_query($sql)))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
                                if ($row = $db->sql_fetchrow($result))
                                {
                                        $forum_update_sql .= ($row['last_post_id']) ? ', forum_last_post_id = ' . $row['last_post_id'] : ', forum_last_post_id = 0';
                                }
                        }
                }
                else if ($post_data['first_post'])
                {
                        $sql = "SELECT MIN(post_id) AS first_post_id
                                FROM " . POSTS_TABLE . "
                                WHERE topic_id = '$topic_id'";
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                        }
                        if ($row = $db->sql_fetchrow($result))
                        {
                                $topic_update_sql .= 'topic_replies = topic_replies - 1, topic_first_post_id = ' . $row['first_post_id'];
                        }
                }
                else
                {
                        $topic_update_sql .= 'topic_replies = topic_replies - 1';
                }
        }
        else if ($mode != 'poll_delete')
        {
                $forum_update_sql .= ", forum_last_post_id = $post_id" . (($mode == 'newtopic') ? ", forum_topics = forum_topics $sign" : "");
                $topic_update_sql = "topic_last_post_id = $post_id" . (($mode == 'reply') ? ", topic_replies = topic_replies $sign" : ", topic_first_post_id = $post_id");
        }
        else
        {
                $topic_update_sql .= 'topic_vote = 0';
        }
	  if ($mode != 'poll_delete')
	  {
		  $sql = "UPDATE " . FORUMS_TABLE . " SET
			  $forum_update_sql 
			  WHERE forum_id = $forum_id";
		  if (!$db->sql_query($sql))
		  {
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		  }
	  }
        if ($topic_update_sql != '')
        {
                $sql = "UPDATE " . TOPICS_TABLE . " SET
                        $topic_update_sql
                        WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
        }
        if ($mode != 'poll_delete')
        {
                $sql = "UPDATE " . USERS_TABLE . "
                        SET user_posts = user_posts $sign
                        WHERE user_id = '$user_id'";
                if (!$db->sql_query($sql, END_TRANSACTION))
                {
                        message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
                }
        }
        return;
}
//
// Delete a post/poll
//
function delete_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id)
{
        global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
        global $userdata, $user_ip;
        if ($mode != 'poll_delete')
        {
        include_once("includes/functions_search.php");
                $sql = "DELETE FROM " . POSTS_TABLE . "
                        WHERE post_id = '$post_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . POSTS_TEXT_TABLE . "
                        WHERE post_id = '$post_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                }
                if ($post_data['last_post'])
                {
                        if ($post_data['first_post'])
                        {
                                $forum_update_sql .= ', forum_topics = forum_topics - 1';
                                $sql = "DELETE FROM " . TOPICS_TABLE . "
                                        WHERE topic_id = '$topic_id'
                                                OR topic_moved_id = '$topic_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
                                $sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
                                        WHERE topic_id = '$topic_id'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
                                }
                        }
                }
                remove_search_post($post_id);
        }
        if ($mode == 'poll_delete' || ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) && $post_data['has_poll'] && $post_data['edit_poll'])
        {
                $sql = "DELETE FROM " . VOTE_DESC_TABLE . "
                        WHERE topic_id = '$topic_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "
                        WHERE vote_id = '$poll_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }
                $sql = "DELETE FROM " . VOTE_USERS_TABLE . "
                        WHERE vote_id = '$poll_id'";
                if (!$db->sql_query($sql))
                {
                        message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
                }
        }
        if ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post'])
        {
                $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_id) . '">';
                $message = $lang['Deleted'];
        }
        else
        {
                $meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '">';
                $message = (($mode == 'poll_delete') ? $lang['Poll_delete'] : $lang['Deleted']) . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
        }
        $message .=  '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
        return;
}
//
// Handle user notification on new post (including forum notification)
//
function user_notification($mode, &$post_data, &$topic_title, &$forum_id, &$topic_id, &$post_id, &$notify_user)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;
	$current_time = time();
	if ($mode == 'delete')
	{
		$delete_sql = (!$post_data['first_post'] && !$post_data['last_post']) ? " AND user_id = " . $userdata['user_id'] : '';
		$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id = $topic_id" . $delete_sql;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not change topic notify data', '', __LINE__, __FILE__, $sql);
		}
	}
	else 
	{
		if ($mode == 'reply')
		{
			$sql = "SELECT ban_userid 
				FROM " . BANLIST_TABLE;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain banlist', '', __LINE__, __FILE__, $sql);
			}
			$user_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($row['ban_userid']) && !empty($row['ban_userid']))
				{
					$user_id_sql .= ', ' . $row['ban_userid'];
				}
			}
			$sql = "SELECT u.user_id, u.user_email, u.user_lang, u.username, f.forum_name 
				FROM " . TOPICS_WATCH_TABLE . " tw, " . USERS_TABLE . " u, " . FORUMS_TABLE . " f 
				WHERE tw.topic_id = $topic_id 
					AND tw.user_id NOT IN (" . $userdata['user_id'] . ", " . ANONYMOUS . $user_id_sql . ") 
					AND tw.notify_status = " . TOPIC_WATCH_UN_NOTIFIED . " 
					AND f.forum_id = $forum_id 
					AND u.user_id = tw.user_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain list of topic watchers', '', __LINE__, __FILE__, $sql);
			}
			$update_watched_sql = '';
			$bcc_list_ary = array();
			$users_ary = array();
			if ($row = $db->sql_fetchrow($result))
			{
				// Sixty second limit
				@set_time_limit(60);
				do
				{
					if ($row['user_email'] != '')
					{
						$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
						$users_ary[$row['user_email']] = $row['username'];
					}
					$forum_name = $row['forum_name'];
					$update_watched_sql .= ($update_watched_sql != '') ? ', ' . $row['user_id'] : $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result));
				//
				// Let's do some checking to make sure that mass mail functions
				// are working in win32 versions of php.
				//
				if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
				{
					$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';
					// We are running on windows, force delivery to use our smtp functions
					// since php's are broken by default
					$board_config['smtp_delivery'] = 1;
					$board_config['smtp_host'] = @$ini_val('SMTP');
				}
				if (sizeof($bcc_list_ary))
				{
					include_once('includes/emailer.php');
					$emailer = new emailer($board_config['smtp_delivery']);
					$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
					$script_name = 'modules.php?name=Forums&file=viewtopic';
					$server_name = trim($board_config['server_name']);
					$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
					$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
					$orig_word = array();
					$replacement_word = array();
					obtain_word_list($orig_word, $replacement_word);
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);
					$topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);
					$post_text = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($post_data['message'])) : unprepare_message($post_data['message']);
					@reset($bcc_list_ary);
					while (list($user_lang, $bcc_list) = each($bcc_list_ary))
					{
						$emailer->use_template('topic_notify', $user_lang);
						for ($i = 0; $i < count($bcc_list); $i++)
						{
							$emailer->bcc($bcc_list[$i]);
						}
						// The Topic_reply_notification lang string below will be used
						// if for some reason the mail template subject cannot be read 
						// ... note it will not necessarily be in the posters own language!
						$emailer->set_subject($lang['Topic_reply_notification']); 
						// This is a nasty kludge to remove the username var ... till (if?)
						// translators update their templates
						// $emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);
						$emailer->assign_vars(array(
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
							'SITENAME' => $board_config['sitename'],
							'USERNAME' => $users_ary[$bcc_list['0']],
							'TOPIC_TITLE' => $topic_title, 
							'POST_TEXT' => $post_text, 
							'POSTERNAME' => $post_data['username'], 
							'FORUM_NAME' => $forum_name, 
							'U_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_POST_URL . "=$post_id#$post_id",
							'U_STOP_WATCHING_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_TOPIC_URL . "=$topic_id&unwatch=topic")
						);
						$emailer->send();
						$emailer->reset();
					}
				}
			}
			$already_mailed = ( trim($update_watched_sql) == '' ) ? "" : "$update_watched_sql, ";
			$db->sql_freeresult($result);
			// start of reply forum notification
			$sql = "SELECT u.user_id, u.user_email, u.user_lang, f.forum_name
				FROM " . USERS_TABLE . " u, " . FORUMS_WATCH_TABLE . " fw, " . FORUMS_TABLE . " f 
				WHERE fw.forum_id = $forum_id 
					AND fw.user_id NOT IN (" . $already_mailed . $userdata['user_id'] . ", " . ANONYMOUS . $user_id_sql . " ) 
					AND f.forum_id = $forum_id
					AND f.forum_notify = '1' 
					AND u.user_id = fw.user_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain list of topic watchers', '', __LINE__, __FILE__, $sql);
			}
			$bcc_list_ary = array();
			$users_ary = array();
			if ($row = $db->sql_fetchrow($result))
			{
				// Sixty second limit
				@set_time_limit(60);
				do
				{
					if ($row['user_email'] != '')
					{
						$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
						$users_ary[$row['user_email']] = $row['username'];
					}
					$forum_name = $row['forum_name'];
				}
				while ($row = $db->sql_fetchrow($result));
				//
				// Let's do some checking to make sure that mass mail functions
				// are working in win32 versions of php.
				//
				if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
				{
					$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';
					// We are running on windows, force delivery to use our smtp functions
					// since php's are broken by default
					$board_config['smtp_delivery'] = 1;
					$board_config['smtp_host'] = @$ini_val('SMTP');
				}
				if (sizeof($bcc_list_ary))
				{
					include_once('includes/emailer.php');
					$emailer = new emailer($board_config['smtp_delivery']);
					$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
					$script_name_forum = ($script_name != '') ? $script_name . '/viewforum.'.$phpEx : 'viewforum.'.$phpEx;
					$script_name = 'modules.php?name=Forums&file=viewtopic';
					$server_name = trim($board_config['server_name']);
					$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
					$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
					$orig_word = array();
					$replacement_word = array();
					obtain_word_list($orig_word, $replacement_word);
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);
					$topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);
					$post_text = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($post_data['message'])) : unprepare_message($post_data['message']);
					$temp_is_auth = array();
					@reset($bcc_list_ary);
					while (list($user_lang, $bcc_list) = each($bcc_list_ary))
					{
						$temp_userdata = get_userdata($row['user_id']);
						$temp_is_auth = auth(AUTH_ALL, $forum_id, $temp_userdata, -1);
						// another security check (i.e. the forum might have become private and 
						// there are still users who have notification activated)
						if( $temp_is_auth['auth_read'] && $temp_is_auth['auth_view'] )
						{
							$emailer->use_template('forum_notify', $user_lang);
							for ($i = 0; $i < count($bcc_list); $i++)
							{
								$emailer->bcc($bcc_list[$i]);
							}
							// The Topic_reply_notification lang string below will be used
							// if for some reason the mail template subject cannot be read 
							// ... note it will not necessarily be in the posters own language!
							$emailer->set_subject($lang['Topic_reply_notification']); 
							// This is a nasty kludge to remove the username var ... till (if?)
							// translators update their templates
							// $emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);
							$emailer->assign_vars(array(
								'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
								'SITENAME' => $board_config['sitename'],
								'USERNAME' => $users_ary[$bcc_list['0']],
								'TOPIC_TITLE' => $topic_title, 
								'POST_TEXT' => $post_text, 
								'POSTERNAME' => $post_data['username'], 
								'FORUM_NAME' => $forum_name, 
								'U_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_POST_URL . "=$post_id#$post_id",
								'U_STOP_WATCHING_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_TOPIC_URL . "=$topic_id&unwatch=topic")
							);
							$emailer->send();
							$emailer->reset();
						}
					}
				}
			}
			// end of forum notification on reply
			$db->sql_freeresult($result);
			if ($update_watched_sql != '')
			{
				$sql = "UPDATE " . TOPICS_WATCH_TABLE . "
					SET notify_status = " . TOPIC_WATCH_NOTIFIED . "
					WHERE topic_id = $topic_id
						AND user_id IN ($update_watched_sql)";
				$db->sql_query($sql);
			}
		}
		//
		// code for newtopic forum notification
		//
		if ($mode == 'newtopic')
		{
			$sql = "SELECT ban_userid 
				FROM " . BANLIST_TABLE;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain banlist', '', __LINE__, __FILE__, $sql);
			}
			$user_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($row['ban_userid']) && !empty($row['ban_userid']))
				{
					$user_id_sql .= ', ' . $row['ban_userid'];
				}
			}
			$sql = "SELECT u.user_id, u.username, u.user_email, u.user_lang, f.forum_name 
				FROM " . FORUMS_WATCH_TABLE . " fw, " . USERS_TABLE . " u, " . FORUMS_TABLE . " f 
				WHERE fw.forum_id = $forum_id 
					AND fw.user_id NOT IN (" . $userdata['user_id'] . ", " . ANONYMOUS . $user_id_sql . ") 
					AND f.forum_id = $forum_id 
					AND f.forum_notify = '1'  
					AND u.user_id = fw.user_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain list of forum watchers', '', __LINE__, __FILE__, $sql);
			}
			$bcc_list_ary = array();
			$users_ary = array();
			if ($row = $db->sql_fetchrow($result))
			{
				// Sixty second limit
				@set_time_limit(60);
				unset($forum_name);
				do
				{
					if ($row['user_email'] != '')
					{
						$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
						$users_ary[$row['user_email']] = $row['username'];
					}
					$forum_name = $row['forum_name'];
				}
				while ($row = $db->sql_fetchrow($result));
				//
				// Let's do some checking to make sure that mass mail functions
				// are working in win32 versions of php.
				//
				if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
				{
					$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';
					// We are running on windows, force delivery to use our smtp functions
					// since php's are broken by default
					$board_config['smtp_delivery'] = 1;
					$board_config['smtp_host'] = @$ini_val('SMTP');
				}
				if (sizeof($bcc_list_ary))
				{
					include_once('includes/emailer.php');
					$emailer = new emailer($board_config['smtp_delivery']);
					$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
					$script_name_forum = ($script_name != '') ? $script_name . '/viewforum.'.$phpEx : 'viewforum.'.$phpEx;
					$script_name = 'modules.php?name=Forums&file=viewtopic';
					$server_name = trim($board_config['server_name']);
					$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
					$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
					$orig_word = array();
					$replacement_word = array();
					obtain_word_list($orig_word, $replacement_word);
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);
					$topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);
					$post_text = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($post_data['message'])) : unprepare_message($post_data['message']);
					$temp_is_auth = array();
					@reset($bcc_list_ary);
					while (list($user_lang, $bcc_list) = each($bcc_list_ary))
					{
						$temp_userdata = get_userdata($row['user_id']);
						$temp_is_auth = auth(AUTH_ALL, $forum_id, $temp_userdata, -1);
						// another security check (i.e. the forum might have become private and 
						// there are still users who have notification activated)
						if( $temp_is_auth['auth_read'] && $temp_is_auth['auth_view'] )
						{
							$emailer->use_template('newtopic_notify', $user_lang);
							for ($i = 0; $i < count($bcc_list); $i++)
							{
								$emailer->bcc($bcc_list[$i]);
							}
							// The Topic_reply_notification lang string below will be used
							// if for some reason the mail template subject cannot be read 
							// ... note it will not necessarily be in the posters own language!
							$emailer->set_subject($lang['Topic_reply_notification']); 
							// This is a nasty kludge to remove the username var ... till (if?)
							// translators update their templates
							// $emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);
							$emailer->assign_vars(array(
								'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
								'SITENAME' => $board_config['sitename'],
								'USERNAME' => $users_ary[$bcc_list['0']],
								'TOPIC_TITLE' => $topic_title, 
								'POST_TEXT' => $post_text, 
								'POSTERNAME' => $post_data['username'], 
								'FORUM_NAME' => $forum_name, 
								'U_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_POST_URL . "=$post_id#$post_id",
								'U_STOP_WATCHING_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '&' . POST_TOPIC_URL . "=$topic_id&unwatch=topic")
							);
							$emailer->send();
							$emailer->reset();
						}
					}
				}
			}
			$db->sql_freeresult($result);
		}
		$sql = "SELECT topic_id 
			FROM " . TOPICS_WATCH_TABLE . "
			WHERE topic_id = $topic_id
				AND user_id = " . $userdata['user_id'];
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);
		if (!$notify_user && !empty($row['topic_id']))
		{
			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
				WHERE topic_id = $topic_id
					AND user_id = " . $userdata['user_id'];
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
		else if ($notify_user && empty($row['topic_id']))
		{
			$sql = "INSERT INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
				VALUES (" . $userdata['user_id'] . ", $topic_id, 0)";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not insert topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
	}
}
//
// Fill smiley templates (or just the variables) with smileys
// Either in a window or inline
//
function generate_smilies($mode, $page_id)
{
        global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
        global $user_ip, $session_length, $starttime;
        global $userdata;
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0     START */
/*****************************************************/
        $inline_columns = $board_config['smilie_columns'];
        $inline_rows = $board_config['smilie_rows'];
        $window_columns = $board_config['smilie_window_columns'];
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0       END */
/*****************************************************/
        if ($mode == 'window')
        {
                $userdata = session_pagestart($user_ip, $page_id, $nukeuser);
                init_userprefs($userdata);
                $gen_simple_header = TRUE;
                $page_title = $lang['Emoticons'] . " - $topic_title";
		if ( defined('IN_ADMIN') )
		{
			include_once('./page_header_admin.'.$phpEx);
		}
		else
		{
                include_once("includes/page_header_review.php");
		}
                $template->set_filenames(array(
                        'smiliesbody' => 'posting_smilies.tpl')
                );
        }
        $sql = "SELECT emoticon, code, smile_url
                FROM " . SMILIES_TABLE . "
                ORDER BY smilies_id";
        if ($result = $db->sql_query($sql))
        {
                $num_smilies = 0;
                $rowset = array();
                while ($row = $db->sql_fetchrow($result))
                {
                        if (empty($rowset[$row['smile_url']]))
                        {
                                $rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
                                $rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
                                $num_smilies++;
                        }
                }
                if ($num_smilies)
                {
                        $smilies_count = ( $mode == 'inline' ) ? min( (($inline_columns * $inline_rows) - 1), $num_smilies) : $num_smilies;
                        $smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;
                        $s_colspan = 0;
                        $row = 0;
                        $col = 0;
                        while (list($smile_url, $data) = @each($rowset))
                        {
                                if (!$col)
                                {
                                        $template->assign_block_vars('smilies_row', array());
                                }
                                $template->assign_block_vars('smilies_row.smilies_col', array(
                                        'SMILEY_CODE' => $data['code'],
                                        'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
                                        'SMILEY_DESC' => $data['emoticon'])
                                );
                                $s_colspan = max($s_colspan, $col + 1);
                                if ($col == $smilies_split_row)
                                {
                                        if ($mode == 'inline' && $row == $inline_rows - 1)
                                        {
                                                break;
                                        }
                                        $col = 0;
                                        $row++;
                                }
                                else
                                {
                                        $col++;
                                }
                        }
                        if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns)
                        {
                                $template->assign_block_vars('switch_smilies_extra', array());
                                $template->assign_vars(array(
                                        'L_MORE_SMILIES' => $lang['More_emoticons'],
                                        'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies&popup=1"))
                                );
                        }
                        $template->assign_vars(array(
                                'L_EMOTICONS' => $lang['Emoticons'],
                                'L_CLOSE_WINDOW' => $lang['Close_window'],
                                'S_SMILIES_COLSPAN' => $s_colspan)
                        );
                }
        }
        if ($mode == 'window')
        {
                $template->pparse('smiliesbody');
                include_once("includes/page_tail_review.php");
        }
}
/**
* Called from within prepare_message to clean include_onced HTML tags if HTML is
* turned on for that post
* @param array $tag Matching text from the message to parse
*/
function clean_html($tag)
{
	global $board_config;
	if (empty($tag[0]))
	{
		return '';
	}
	$allowed_html_tags = preg_split('/, */', strtolower($board_config['allow_html_tags']));
	$disallowed_attributes = '/^(?:style|on)/i';
	// Check if this is an end tag
	preg_match('/<[^\w\/]*\/[\W]*(\w+)/', $tag[0], $matches);
	if (sizeof($matches))
	{
		if (in_array(strtolower($matches[1]), $allowed_html_tags))
		{
			return  '</' . $matches[1] . '>';
		}
		else
		{
			return  htmlspecialchars('</' . $matches[1] . '>');
		}
	}
	// Check if this is an allowed tag
	if (in_array(strtolower($tag[1]), $allowed_html_tags))
	{
		$attributes = '';
		if (!empty($tag[2]))
		{
			preg_match_all('/[\W]*?(\w+)[\W]*?=[\W]*?(["\'])((?:(?!\2).)*)\2/', $tag[2], $test);
			for ($i = 0; $i < sizeof($test[0]); $i++)
			{
				if (preg_match($disallowed_attributes, $test[1][$i]))
				{
					continue;
				}
				$attributes .= ' ' . $test[1][$i] . '=' . $test[2][$i] . str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlspecialchars($test[3][$i])) . $test[2][$i];
			}
		}
		if (in_array(strtolower($tag[1]), $allowed_html_tags))
		{
			return '<' . $tag[1] . $attributes . '>';
		}
		else
		{
			return htmlspecialchars('<' . $tag[1] . $attributes . '>');
		}
	}
	// Finally, this is not an allowed tag so strip all the attibutes and escape it
	else
	{
		return htmlspecialchars('<' .   $tag[1] . '>');
	}
}
?>