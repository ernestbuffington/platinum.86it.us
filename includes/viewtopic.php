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

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

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
define('IN_CASHMOD', true);
define('CM_VIEWTOPIC', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once("includes/bbcode.php");

/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   START */
/*****************************************************/
include_once('includes/functions_post.'.$phpEx);
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   END   */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_report.' . $phpEx);
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

//
// Start initial var setup
//
$topic_id = $post_id = 0;
if ( isset($_GET[POST_TOPIC_URL]) )
{
        $topic_id = intval($_GET[POST_TOPIC_URL]);
}
else if ( isset($_GET['topic']) )
{
        $topic_id = intval($_GET['topic']);
}

if ( isset($_GET[POST_POST_URL]))
{
        $post_id = intval($_GET[POST_POST_URL]);
}

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

if ( !isset($topic_id) && !isset($post_id) )
{
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

//
// Find topic id if user requested a newer
// or older topic
//

if ( isset($_GET['view']) && empty($_GET[POST_POST_URL]) )
{
	if ( $_GET['view'] == 'newest' )
	{
		if ( isset($_COOKIE[$board_config['cookie_name'] . '_sid']) || isset($_GET['sid']) )
		{
			$session_id = isset($_COOKIE[$board_config['cookie_name'] . '_sid']) ? $_COOKIE[$board_config['cookie_name'] . '_sid'] : $_GET['sid'];

			if (!preg_match('/^[A-Za-z0-9]*$/', $session_id)) 
			{
				$session_id = '';
			}

			if ( $session_id )
			{
				$sql = "SELECT p.post_id
					FROM " . POSTS_TABLE . " p, " . SESSIONS_TABLE . " s,  " . USERS_TABLE . " u
					WHERE s.session_id = '$session_id'
						AND u.user_id = s.session_user_id
                                                AND p.topic_id = '$topic_id'
						AND p.post_time >= u.user_lastvisit
					ORDER BY p.post_time ASC
					LIMIT 1";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
				}

				$post_id = $row['post_id'];

				if (isset($_GET['sid']))
				{
                    redirect(append_sid("viewtopic.$phpEx?sid=$session_id&" . POST_POST_URL . "=$post_id#$post_id", true)); 
				}
				else
				{
                    redirect(append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id", true)); 
				}
			}
		}
        redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true)); 
	}
	else if ( $_GET['view'] == 'next' || $_GET['view'] == 'previous' )
	{
		$sql_condition = ( $_GET['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $_GET['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = "SELECT t.topic_id
			FROM " . TOPICS_TABLE . " t, " . TOPICS_TABLE . " t2
			WHERE
				t2.topic_id = '$topic_id'
				AND t.forum_id = t2.forum_id
				AND t.topic_last_post_id $sql_condition t2.topic_last_post_id
			ORDER BY t.topic_last_post_id $sql_ordering
			LIMIT 1";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$topic_id = intval($row['topic_id']);
		}
		else
		{
			$message = ( $_GET['view'] == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

//
// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
//
$join_sql_table = ( empty($post_id) ) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = ( empty($post_id) ) ? "t.topic_id = '$topic_id'" : "p.post_id = '$post_id' AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= '$post_id'";
$count_sql = ( empty($post_id) ) ? '' : ", COUNT(p2.post_id) AS prev_posts";

$order_sql = ( empty($post_id) ) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC";

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . "
        FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
        WHERE $join_sql
                AND f.forum_id = t.forum_id
                $order_sql";
attach_setup_viewtopic_auth($order_sql, $sql);

if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
        message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
$buddy_id = ( isset($_GET['b']) ) ? $_GET['b'] : 0;
$buddy_action = ( isset($_GET['buddy_action']) ) ? ( ($_GET['buddy_action'] == 'add') ? 'add' : ( ($_GET['buddy_action'] == 'remove') ? 'remove' : '') ) : '';
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

/*****************************************************/
/* Forum - Thread Kicker v.1.0.3               START */
/*****************************************************/
if ( $board_config['kicker_view_setting'] == 2 ) {
	if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD ) {
		$sql=" SELECT user_id, kicker FROM " . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id AND user_id=" . $userdata['user_id'];
		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting thread kicker data', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);
		$tk_kicker_id=$row['kicker'];
		$tk_postid=$row['post_id'];
		if ( $row['user_id'] == $userdata['user_id'] ) {
			$sql_a=" SELECT username FROM " . USERS_TABLE . " WHERE user_id='$tk_kicker_id'";
			if (!$result_a= $db->sql_query($sql_a)) {
				message_die(GENERAL_ERROR, 'Error in getting kicker username', '', __LINE__, __FILE__, $sql_a);
			}
			$row_a = $db->sql_fetchrow($result_a);
			$kicker_username=$row_a['username'];
			include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_thread_kicker.' . $phpEx);
			$index_redirect = '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx?") . '">';
			$message=$lang['tk_userkicked_topic_noview'] . '<a href="' . append_sid("privmsg.$phpEx?mode=post&u=$tk_kicker_id") . '">' . $kicker_username . '</a>' . $lang['tk_userkicked_contact'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}
/*****************************************************/
/* Forum - Thread Kicker v.1.0.3                 END */
/*****************************************************/

//
// Start auth check
//
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE'])) ? 'Refresh: 0; URL=' : 'Location: ';
		$redirect = ( isset($post_id) ) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
		$redirect .= ( isset($start) ) ? "&start=$start" : '';
		header($header_location . append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true));
	}

	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
//
// End auth check
//

$forum_name = $forum_topic_data['forum_name'];
$topic_title = $forum_topic_data['topic_title'];
$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];

if ( !empty($post_id) )
{
        $start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
if ( $buddy_id )
{
	$redirect = ( isset($post_id) ) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
	$redirect .= ( isset($start) && !isset($post_id) ) ? "&start=$start" : '';

	if( !$userdata['session_logged_in'] )
	{
		$redirect .= ( isset($buddy_id) ) ? '&b=$buddy_id' : '';
		$redirect .= ( isset($buddy_action) ) ? '&buddy_action=$buddy_action' : '';
		$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
		header($header_location . append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true));
		exit;
	}
	$viewtopic_url = append_sid("viewtopic.$phpEx?$redirect");
	$viewtopic_url .= ( isset($post_id) ) ? '#' . $post_id : '';

	//
	// Do not perform actions with yourself now...
	//
	if ( $buddy_id == $userdata['user_id'] )
	{
		message_die(GENERAL_MESSAGE, 'You cannot add/remove yourself to/from your buddylist');
	}

	//
	// Check if the user exists
	//
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = $buddy_id";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query user information', '', __LINE__, __FILE__, $sql);
	}
	if ( !$row = $db->sql_fetchrow($result) )
	{
		message_die(GENERAL_MESSAGE, 'User does not exist');
	}

	//
	// See if user is already/not in the buddylist already
	//
	$sql = "SELECT * FROM " . BUDDIES_TABLE . "
			WHERE user_id = " . $userdata['user_id'] . "
				AND buddy_id = $buddy_id";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query buddylist information', '', __LINE__, __FILE__, $sql);
	}

	if( ($buddy_action == 'add') && ($row = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_MESSAGE, 'User is already in your buddylist');
	}
	else if( ($buddy_action == 'remove') && (!$row = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_MESSAGE, 'User is not in your buddylist');
	}

	//
	// Perform add & remove now
	//
	if ( $buddy_action == 'add' )
	{
		$sql = "INSERT INTO " . BUDDIES_TABLE . " (user_id, buddy_id) VALUES (" . $userdata['user_id'] . ", " . $buddy_id . ")";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not add the user to your buddylist', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Buddy_added'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . $viewtopic_url . '">', '</a>');
	}

	if ( $buddy_action == 'remove' )
	{
		$sql = "DELETE FROM " . BUDDIES_TABLE . "
				WHERE user_id = " . $userdata['user_id'] . "
					AND buddy_id = $buddy_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not remove the user from your buddylist', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Buddy_removed'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . $viewtopic_url . '">', '</a>');
	}

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . $viewtopic_url . '">')
		);

	message_die(GENERAL_MESSAGE, $message);
}
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

//
// Is user watching this thread?
//
if( $userdata['session_logged_in'] )
{
        $can_watch_topic = TRUE;

        $sql = "SELECT notify_status
                FROM " . TOPICS_WATCH_TABLE . "
                WHERE topic_id = '$topic_id'
                        AND user_id = " . $userdata['user_id'];
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Could not obtain topic watch information", '', __LINE__, __FILE__, $sql);
        }

        if ( $row = $db->sql_fetchrow($result) )
        {
                if ( isset($_GET['unwatch']) )
                {
                        if ( $_GET['unwatch'] == 'topic' )
                        {
                                $is_watching_topic = 0;

                                $sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
                                $sql = "DELETE $sql_priority FROM " . TOPICS_WATCH_TABLE . "
                                        WHERE topic_id = '$topic_id'
                                                AND user_id = " . $userdata['user_id'];
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, "Could not delete topic watch information", '', __LINE__, __FILE__, $sql);
                                }
                        }

                        $template->assign_vars(array(
                                'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
                        );

                        $message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
                        message_die(GENERAL_MESSAGE, $message);
                }
                else
                {
                        $is_watching_topic = TRUE;

                        if ( $row['notify_status'] )
                        {
                                $sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
                                $sql = "UPDATE $sql_priority " . TOPICS_WATCH_TABLE . "
                                        SET notify_status = '0'
                                        WHERE topic_id = '$topic_id'
                                                AND user_id = " . $userdata['user_id'];
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, "Could not update topic watch information", '', __LINE__, __FILE__, $sql);
                                }
                        }
                }
        }
        else
        {
                if ( isset($_GET['watch']) )
                {
                        if ( $_GET['watch'] == 'topic' )
                        {
                                $is_watching_topic = TRUE;

                                $sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
                                $sql = "INSERT $sql_priority INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
                                        VALUES (" . $userdata['user_id'] . ", '$topic_id', '0')";
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, "Could not insert topic watch information", '', __LINE__, __FILE__, $sql);
                                }
                        }

                        $template->assign_vars(array(
                                'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
                        );

                        $message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
                        message_die(GENERAL_MESSAGE, $message);
                }
                else
                {
                        $is_watching_topic = 0;
                }
        }
}
else
{
	$header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE'])) ? 'Refresh: 0; URL=' : 'Location: ';

	if ( isset($_GET['unwatch']) )
	{
		if ( $_GET['unwatch'] == 'topic' )
		{
			header($header_location . append_sid("login.$phpEx?redirect=viewtopic.$phpEx&" . POST_TOPIC_URL . "=$topic_id&unwatch=topic", true));
		}
	}
	else
	{
		$can_watch_topic = 0;
		$is_watching_topic = 0;
	}
}

//
// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( !empty($_POST['postdays']) || !empty($_GET['postdays']) )
{
        $post_days = ( !empty($_POST['postdays']) ) ? intval($_POST['postdays']) : intval($_GET['postdays']);
        $min_post_time = time() - (intval($post_days) * 86400);

        $sql = "SELECT COUNT(p.post_id) AS num_posts
                FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
                WHERE t.topic_id = '$topic_id'
                        AND p.topic_id = t.topic_id
                        AND p.post_time >= '$min_post_time'";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Could not obtain limited topics count information", '', __LINE__, __FILE__, $sql);
        }

        $total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;

        $limit_posts_time = "AND p.post_time >= $min_post_time ";

        if ( !empty($_POST['postdays']))
        {
                $start = 0;
        }
}
else
{
        $total_replies = intval($forum_topic_data['topic_replies']) + 1;

        $limit_posts_time = '';
        $post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++)
{
        $selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
        $select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

//
// Decide how to order the post display
//
if ( !empty($_POST['postorder']) || !empty($_GET['postorder']) )
{
	$post_order = (!empty($_POST['postorder'])) ? htmlspecialchars($_POST['postorder']) : htmlspecialchars($_GET['postorder']);
if (!preg_match("/^((asc)|(desc))$/",$post_order) )
{
        message_die(GENERAL_ERROR, 'Selected post order is not valid');
}
        $post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
}
else
{
        $post_order = 'asc';
        $post_time_order = 'ASC';
}

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' )
{
        $select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
}
else
{
        $select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

//
// Go ahead and pull all data for this topic
//
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
$sql = "SELECT u.username, u.user_color_gc, u.user_id, u.user_posts, u.user_from, u.user_from_flag, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, u.user_allow_viewonline, u.user_session_time, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
        FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
        WHERE p.topic_id = '$topic_id'
                $limit_posts_time
                AND pt.post_id = p.post_id
                AND u.user_id = p.poster_id
        ORDER BY p.post_time $post_time_order
        LIMIT $start, ".$board_config['posts_per_page'];
        $cm_viewtopic->generate_columns($template,$forum_id,$sql);
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
}

$postrow = array();
if ($row = $db->sql_fetchrow($result))
{
        do
        {
                $postrow[] = $row;
        }
        while ($row = $db->sql_fetchrow($result));
        $db->sql_freeresult($result);

        $total_posts = count($postrow);
}
else
{
   include_once("includes/functions_admin.php");
   sync('topic', $topic_id);

   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
}

$resync = FALSE;
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow))
{
   $resync = TRUE;
}
elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies'])
{
   $row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']);
   if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies'])
   {
      $resync = TRUE;
   }
}
elseif (count($postrow) < $board_config['posts_per_page'])
{
   $resync = TRUE;
}

if ($resync)
{
   include_once("includes/functions_admin.php");
   sync('topic', $topic_id);

   $result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id);
   $row = $db->sql_fetchrow($result);
   $total_replies = $row['total'];
}

$sql = "SELECT *
        FROM " . RANKS_TABLE . "
        ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
        $ranksrow[] = $row;
}
$db->sql_freeresult($result);

/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
if ( $userdata['session_logged_in'] )
{
	$sql = "SELECT buddy_id FROM " . BUDDIES_TABLE . " WHERE user_id = " . $userdata['user_id'];
}
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain buddies information', '', __LINE__, __FILE__, $sql);
}

$buddiesrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$buddiesrow[] = $row;
}
$db->sql_freeresult($result);
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Censor topic title
//
if ( count($orig_word) )
{
        $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

//
// Was a highlight request part of the URI?
//
$highlight_match = $highlight = '';
if (isset($_GET['highlight']))
{
        // Split words and phrases
	$words = explode(' ', trim(htmlspecialchars($_GET['highlight'])));

        for($i = 0; $i < sizeof($words); $i++)
        {
                if (trim($words[$i]) != '')
                {
                        $highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', phpbb_preg_quote($words[$i], '#'));
                }
        }
        unset($words);

        $highlight = urlencode($_GET['highlight']);
        $highlight_match = phpbb_rtrim($highlight_match, "\\");
}

//
// Post, reply and other URL generation for
// templating vars
//
$new_topic_url = append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id");
$reply_topic_url = append_sid("posting.$phpEx?mode=reply&amp;" . POST_TOPIC_URL . "=$topic_id");
$view_forum_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id");
$view_prev_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=previous");
$view_next_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=next");

//
// Mozilla navigation bar
//
$nav_links['prev'] = array(
        'url' => $view_prev_topic_url,
        'title' => $lang['View_previous_topic']
);
$nav_links['next'] = array(
        'url' => $view_next_topic_url,
        'title' => $lang['View_next_topic']
);
$nav_links['up'] = array(
        'url' => $view_forum_url,
        'title' => $forum_name
);

$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['Reply_to_topic'];
$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];

//
// Set a cookie for this topic
//
if ( $userdata['session_logged_in'] )
{
        $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();
        $tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();

        if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) )
        {
                $topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
        }
        else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) )
        {
                $topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
        }
        else
        {
                $topic_last_read = $userdata['user_lastvisit'];
        }

        if ( count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]) )
        {
                asort($tracking_topics);
                unset($tracking_topics[key($tracking_topics)]);
        }

        $tracking_topics[$topic_id] = time();

        setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}

//
// Load templates
//
$template->set_filenames(array(
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   START */
/*****************************************************/
        'body' => 'viewtopic_body.tpl',
	'qrbody' => 'viewtopic_quickreply.tpl'
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   END   */
/*****************************************************/
        )
);
make_jumpbox('viewforum.'.$phpEx, $forum_id);

//
// Output page header
//
$page_title = $lang['View_topic'] .' - ' . $topic_title;
include_once("includes/page_header.php");

/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0     START */
/*****************************************************/
$topic_title = smilies_pass($topic_title);
/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0       END */
/*****************************************************/

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
attach_build_auth_levels($is_auth, $s_auth_can);

$topic_mod = '';

if ( $is_auth['auth_mod'] )
{
        $s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

        $topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete") . '"><img src="' . $images['topic_mod_delete'] . '" alt="' . $lang['Delete_topic'] . '" title="' . $lang['Delete_topic'] . '" border="0" /></a>&nbsp;';

        $topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move"). '"><img src="' . $images['topic_mod_move'] . '" alt="' . $lang['Move_topic'] . '" title="' . $lang['Move_topic'] . '" border="0" /></a>&nbsp;';

        $topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock") . '"><img src="' . $images['topic_mod_lock'] . '" alt="' . $lang['Lock_topic'] . '" title="' . $lang['Lock_topic'] . '" border="0" /></a>&nbsp;' : '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock") . '"><img src="' . $images['topic_mod_unlock'] . '" alt="' . $lang['Unlock_topic'] . '" title="' . $lang['Unlock_topic'] . '" border="0" /></a>&nbsp;';

        $topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split") . '"><img src="' . $images['topic_mod_split'] . '" alt="' . $lang['Split_topic'] . '" title="' . $lang['Split_topic'] . '" border="0" /></a>&nbsp;';

        $topic_mod .= '<a href="' . append_sid("merge.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '"><img src="' . $images['topic_mod_merge'] . '" alt="' . $lang['Merge_topics'] . '" title="' . $lang['Merge_topics'] . '" border="0" /></a>&nbsp;';
}

//
// Topic watch information
//
$s_watching_topic = '';
if ( $can_watch_topic )
{
        if ( $is_watching_topic )
        {
                $s_watching_topic = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start") . '">' . $lang['Stop_watching_topic'] . '</a>';
                $s_watching_topic_img = ( isset($images['Topic_un_watch']) ) ? '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start") . '"><img src="' . $images['Topic_un_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Stop_watching_topic'] . '" border="0"></a>' : '';
        }
        else
        {
                $s_watching_topic = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start") . '">' . $lang['Start_watching_topic'] . '</a>';
                $s_watching_topic_img = ( isset($images['Topic_watch']) ) ? '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start") . '"><img src="' . $images['Topic_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Start_watching_topic'] . '" border="0"></a>' : '';
        }
}

//
// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
//
$pagination = ( $highlight != '' ) ? generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight", $total_replies, $board_config['posts_per_page'], $start) : generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order", $total_replies, $board_config['posts_per_page'], $start);


//
// Send vars to template
//
$template->assign_vars(array(
        'FORUM_ID' => $forum_id,
    'FORUM_NAME' => $forum_name,
    'TOPIC_ID' => $topic_id,
    'TOPIC_TITLE' => $topic_title,
        'PAGINATION' => $pagination,
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / intval($board_config['posts_per_page']) ) + 1 ), ceil( $total_replies / intval($board_config['posts_per_page']) )),

        'POST_IMG' => $post_img,
        'REPLY_IMG' => $reply_img,
/*****************************************************/
/* Forum - Printable Page v.1.0.0              START */
/*****************************************************/
        'L_PRINT' => ($lang['Print_View']) ? $lang['Print_View'] : 'Printable&nbsp;Version', 
        'U_PRINT' => append_sid("printview.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start"), 
/*****************************************************/
/* Forum - Printable Page v.1.0.0                END */
/*****************************************************/

        'L_AUTHOR' => $lang['Author'],
        'L_MESSAGE' => $lang['Message'],
        'L_POSTED' => $lang['Posted'],
        'L_POST_SUBJECT' => $lang['Post_subject'],
        'L_VIEW_NEXT_TOPIC' => $lang['View_next_topic'],
        'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
        'L_POST_NEW_TOPIC' => $post_alt,
        'L_POST_REPLY_TOPIC' => $reply_alt,
        'L_BACK_TO_TOP' => $lang['Back_to_top'],
        'L_DISPLAY_POSTS' => $lang['Display_posts'],
        'L_LOCK_TOPIC' => $lang['Lock_topic'],
        'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
        'L_MOVE_TOPIC' => $lang['Move_topic'],
        'L_SPLIT_TOPIC' => $lang['Split_topic'],
        'L_DELETE_TOPIC' => $lang['Delete_topic'],
        'L_GOTO_PAGE' => $lang['Goto_page'],

        'S_TOPIC_LINK' => POST_TOPIC_URL,
        'S_SELECT_POST_DAYS' => $select_post_days,
        'S_SELECT_POST_ORDER' => $select_post_order,
        'S_POST_DAYS_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id . "&amp;start=$start"),
        'S_AUTH_LIST' => $s_auth_can,
        'S_TOPIC_ADMIN' => $topic_mod,
        'S_WATCH_TOPIC' => $s_watching_topic,
        'S_WATCH_TOPIC_IMG' => $s_watching_topic_img,

        'U_VIEW_TOPIC' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight"),
        'U_VIEW_FORUM' => $view_forum_url,
        'U_VIEW_OLDER_TOPIC' => $view_prev_topic_url,
        'U_VIEW_NEWER_TOPIC' => $view_next_topic_url,
        'U_POST_NEW_TOPIC' => $new_topic_url,
        'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) )
{
        $s_hidden_fields = '';

        $sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
                FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
                WHERE vd.topic_id = '$topic_id'
                        AND vr.vote_id = vd.vote_id
                ORDER BY vr.vote_option_id ASC";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
        }

        if ( $vote_info = $db->sql_fetchrowset($result) )
        {
                $db->sql_freeresult($result);
                $vote_options = count($vote_info);

                $vote_id = $vote_info[0]['vote_id'];
                $vote_title = $vote_info[0]['vote_text'];

                $sql = "SELECT vote_id
                        FROM " . VOTE_USERS_TABLE . "
                        WHERE vote_id = '$vote_id'
                                AND vote_user_id = " . intval($userdata['user_id']);
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, "Could not obtain user vote data for this topic", '', __LINE__, __FILE__, $sql);
                }

                $user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
                $db->sql_freeresult($result);

                if ( isset($_GET['vote']) || isset($_POST['vote']) )
                {
                        $view_result = ( ( ( isset($_GET['vote']) ) ? $_GET['vote'] : $_POST['vote'] ) == 'viewresult' ) ? TRUE : 0;
                }
                else
                {
                        $view_result = 0;
                }

                $poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

                if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED )
                {
                        $template->set_filenames(array(
                                'pollbox' => 'viewtopic_poll_result.tpl')
                        );

                        $vote_results_sum = 0;

                        for($i = 0; $i < $vote_options; $i++)
                        {
                                $vote_results_sum += $vote_info[$i]['vote_result'];
                        }

                        $vote_graphic = 0;
                        $vote_graphic_max = count($images['voting_graphic']);

                        for($i = 0; $i < $vote_options; $i++)
                        {
                                $vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
                                $vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

                                $vote_graphic_img = $images['voting_graphic'][$vote_graphic];
                                $vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

                                if ( count($orig_word) )
                                {
                                        $vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
                                }

                                $template->assign_block_vars("poll_option", array(
                                        'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
                                        'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
                                        'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

                                        'POLL_OPTION_IMG' => $vote_graphic_img,
                                        'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
                                );
                        }

                        $template->assign_vars(array(
                                'L_TOTAL_VOTES' => $lang['Total_votes'],
                                'TOTAL_VOTES' => $vote_results_sum)
                        );

                }
                else
                {
                        $template->set_filenames(array(
                                'pollbox' => 'viewtopic_poll_ballot.tpl')
                        );

                        for($i = 0; $i < $vote_options; $i++)
                        {
                                if ( count($orig_word) )
                                {
                                        $vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
                                }

                                $template->assign_block_vars("poll_option", array(
                                        'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
                                        'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
                                );
                        }

                        $template->assign_vars(array(
                                'L_SUBMIT_VOTE' => $lang['Submit_vote'],
                                'L_VIEW_RESULTS' => $lang['View_results'],

                                'U_VIEW_RESULTS' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
                        );

                        $s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
                }

                if ( count($orig_word) )
                {
                        $vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
                }

                $s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

                $template->assign_vars(array(
                        'POLL_QUESTION' => $vote_title,

                        'S_HIDDEN_FIELDS' => $s_hidden_fields,
                        'S_POLL_ACTION' => append_sid("posting.$phpEx?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
                );

                $template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
        }
}

init_display_post_attachments($forum_topic_data['topic_attachment']);

//
// Update the topic view counter
//
$sql = "UPDATE " . TOPICS_TABLE . "
        SET topic_views = topic_views + 1
        WHERE topic_id = '$topic_id'";
if ( !$db->sql_query($sql) )
{
        message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
}
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   START */
/*****************************************************/
//
// Quick Reply
//
if ($board_config['allow_quickreply'] && $userdata['user_quickreply'] && $is_auth['auth_reply'] && ($forum_topic_data['forum_status'] != FORUM_LOCKED) && ($forum_topic_data['topic_status'] != TOPIC_LOCKED) )
{
	$show_qr_form =	true;
}
else
{
	$show_qr_form =	false;
}
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   END   */
/*****************************************************/

/*****************************************************/
/* Forum - Thread Kicker v.1.0.3               START */
/*****************************************************/
$viewer_kicked=0;
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_thread_kicker.' . $phpEx);
$sql=" SELECT user_id FROM " . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id";

if (!$result= $db->sql_query($sql)) {
	message_die(GENERAL_ERROR, 'Error in getting data for thread kick mod', '', __LINE__, __FILE__, $sql);
}

$tk_x=1;

while ( $row = $db->sql_fetchrow($result) ) {
	if( $row['user_id'] == $userdata['user_id'] ) {
		$viewer_kicked=5;
	}

	$kicked_user[$tk_x]=$row['user_id'];
	$tk_x++;
}

if ( $userdata['user_level'] == ADMIN || $is_auth['auth_mod'] ) {
	if ( $tk_x != 1 ) {
		if ( $userdata['kick_ban'] != 1 ) {
			$s_view_kicked='<br /><a href="' . append_sid("thread_kicker.$phpEx?mode=kickview&thread_tag=$topic_id") . '"><img src="' . $images['topic_kick'] . '" border="0" alt="' . $lang['tk_kickview'] . '" title="' . $lang['tk_kickview'] . '"></a>';
			$template->assign_vars(array('S_VIEW_KICKED' => $s_view_kicked));
		}
	}
}

$tk_posterid =-5;

if ( $viewer_kicked !=5 ) {
	if ( $board_config['kicker_setting'] == 2 ) {
		if ( $userdata['kick_ban'] != 1 ) {
			$sql=" SELECT topic_poster FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

			if (!$result= $db->sql_query($sql)) {
				message_die(GENERAL_ERROR, 'Error in getting topic starter for thread kick mod', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);
			$tk_posterid=$row['topic_poster'];

			if ( $tk_posterid == $userdata['user_id'] ) {
				if ( $tk_x != 1 ) {
					$s_view_kicked='<br /><a href="' . append_sid("thread_kicker.$phpEx?mode=kickview&thread_tag=$topic_id") . '"><img src="' . $images['topic_kick'] . '" border="0" alt="' . $lang['tk_kickview'] . '" title="' . $lang['tk_kickview'] . '"></a>';
					$template->assign_vars(array('S_VIEW_KICKED' => $s_view_kicked));
				}
			}
		}
	}
}
/*****************************************************/
/* Forum - Thread Kicker v.1.0.3                 END */
/*****************************************************/

//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
for($i = 0; $i < $total_posts; $i++)
{
        $poster_id = $postrow[$i]['user_id'];
        $poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];

        $post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);

        $poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';

        $poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';
	// Country/Location Flags
	$poster_from_flag = ( $postrow[$i]['user_from_flag'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? '<br /><img src="images/flags/' . $postrow[$i]['user_from_flag'] . '" alt="' . $postrow[$i]['user_from_flag'] . '" /><br />' : '';		
        $poster_from = preg_replace("/.gif/", "", $poster_from);
        $poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . $postrow[$i]['user_regdate'] : '';

	$poster_avatar = '';
	if ( $postrow[$i]['user_avatar_type'] && $poster_id != ANONYMOUS && $postrow[$i]['user_allowavatar'] )
	{
		switch( $postrow[$i]['user_avatar_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
		}
	}
        $images['default_avatar'] = "modules/Forums/images/avatars/gallery/blank.gif";
        $images['guest_avatar'] = "modules/Forums/images/avatars/gallery/blank.gif";

        //
        // Default Avatar MOD - Begin
        //
        if ( empty($poster_avatar) && $poster_id != ANONYMOUS)
        {
                $poster_avatar = '<img src="'.  $images['default_avatar'] .'" alt="" border="0" />';
        }
        if ( $poster_id == ANONYMOUS )
        {
                $poster_avatar = '<img src="'.  $images['guest_avatar'] .'" alt="" border="0" />';
        }
        //
        // Default Avatar MOD - End
        //
        //
        // Define the little post icon
        //
        if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read )
        {
                $mini_post_img = $images['icon_minipost_new'];
                $mini_post_alt = $lang['New_post'];
        }
        else
        {
                $mini_post_img = $images['icon_minipost'];
                $mini_post_alt = $lang['Post'];
        }

        $mini_post_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];

        //
        // Generate ranks, set them to empty string initially.
        //
        $poster_rank = '';
        $rank_image = '';
        if ( $postrow[$i]['user_id'] == ANONYMOUS )
        {
        }
        else if ( $postrow[$i]['user_rank'] )
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $postrow[$i]['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
                        {
                                $poster_rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                        }
                }
        }
        else
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $postrow[$i]['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
                        {
                                $poster_rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
                        }
                }
        }

/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
	$buddy_img = '';
	$buddy = '';
	if ( $postrow[$i]['user_id'] == ANONYMOUS )
	{
	}
	else
	{
		if ( $userdata['session_logged_in'] && ( $userdata['user_id'] != $postrow[$i]['user_id'] ) )
		{
         $redirect = ( isset($post_id) ) ? POST_POST_URL . "=" . $postrow[$i]['post_id'] : POST_TOPIC_URL . "=$topic_id"; 
         $redirect .= ( isset($start) && !isset($post_id) ) ? "&start=$start" : ''; 
         $redirect .= '&amp;b=' . $postrow[$i]['user_id']; 
		 
			for($j = 0; $j < count($buddiesrow); $j++)
			{
				if ( $postrow[$i]['user_id'] == $buddiesrow[$j]['buddy_id'] )
				{
					$buddy_img = '<a href="' . append_sid("viewtopic.$phpEx?$redirect&amp;buddy_action=remove") . '"><img src="' . $images['icon_buddy_remove'] . '" alt="' . $lang['Remove_buddy_list'] . '" border="0"></a>';
					$buddy = '<a href="' . append_sid("viewtopic.$phpEx?$redirect&amp;buddy_action=remove") . '">' . $lang['Remove_buddy_list'] . '</a>';
				}
			}

			$buddy_img = ( !$buddy_img) ? '<a href="' . append_sid("viewtopic.$phpEx?$redirect&amp;buddy_action=add") . '"><img src="' . $images['icon_buddy'] . '" alt="' . $lang['Add_buddy_list'] . '" border="0"></a>' : $buddy_img;
			$buddy = ( !$buddy ) ? '<a href="' . append_sid("viewtopic.$phpEx?$redirect&amp;buddy_action=add") . '">' . $lang['Add_buddy_list'] . '</a>' : $buddy;
		}
	}
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

        //
        // Handle anon users posting with usernames
        //
        if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
        {
                $poster = $postrow[$i]['post_username'];
                $poster_rank = $lang['Guest'];
        }

        $temp_url = '';

        if ( $poster_id != ANONYMOUS )
        {
                $temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
                $profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
                $profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

                $temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$poster_id");
                if (is_active("Private_Messages")) {
                $pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
                $pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';
                }

                if ( !empty($postrow[$i]['user_viewemail']) || $is_auth['auth_mod'] )
                {
                        $email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $poster_id) : 'mailto:' . $postrow[$i]['user_email'];

                        $email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
                        $email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
                }
                else
                {
                        $email_img = '';
                        $email = '';
                }
                if (( $postrow[$i]['user_website'] == "http:///") || ( $postrow[$i]['user_website'] == "http://")){
                    $postrow[$i]['user_website'] =  "";
                }
                if (($postrow[$i]['user_website'] != "" ) && (substr($postrow[$i]['user_website'],0, 7) != "http://")) {
                    $postrow[$i]['user_website'] = "http://".$postrow[$i]['user_website'];
                }

                $www_img = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
                $www = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

                if ( !empty($postrow[$i]['user_icq']) )
                {
                        $icq_status_img = '<a href="http://wwp.icq.com/' . $postrow[$i]['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow[$i]['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
                        $icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
                        $icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '">' . $lang['ICQ'] . '</a>';
                }
                else
                {
                        $icq_status_img = '';
                        $icq_img = '';
                        $icq = '';
                }

                $aim_img = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
                $aim = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

                $temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
                $msn_img = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
                $msn = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

                $yim_img = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
                $yim = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
        }
        else
        {
                $profile_img = '';
                $profile = '';
                $pm_img = '';
                $pm = '';
                $email_img = '';
                $email = '';
                $www_img = '';
                $www = '';
                $icq_status_img = '';
                $icq_img = '';
                $icq = '';
                $aim_img = '';
                $aim = '';
                $msn_img = '';
                $msn = '';
                $yim_img = '';
                $yim = '';
        }

        $temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
        $quote_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
        $quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';

        $temp_url = append_sid("search.$phpEx?search_author=" . urlencode($postrow[$i]['username']) . "&amp;showresults=posts");
        $search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . $lang['Search_user_posts'] . '" title="' . $lang['Search_user_posts'] . '" border="0" /></a>';
        $search = '<a href="' . $temp_url . '">' . $lang['Search_user_posts'] . '</a>';

        if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] ) || $is_auth['auth_mod'] )
        {
                $temp_url = append_sid("posting.$phpEx?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
                $edit_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
                $edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
        }
        else
        {
                $edit_img = '';
                $edit = '';
        }

        if ( $is_auth['auth_mod'] )
        {
                $temp_url = append_sid("modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id);
                $ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
                $ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

                $temp_url = append_sid("posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
                $delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
                $delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
        }
        else
        {
                $ip_img = '';
                $ip = '';

                if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] )
                {
                        $temp_url = append_sid("posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
                        $delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
                        $delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
                }
                else
                {
                        $delpost_img = '';
                        $delpost = '';
                }
        }

/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
    if ( $userdata['user_id'] != ANONYMOUS )
    {
        $reportimg = '<a href="modules.php?name=Forums&file=report&mode=reportpost&post=' . $postrow[$i]['post_id'] . '"><img src="' . $images['icon_reportpost'] . '" alt="' . $lang['report_Report_post'] . '" title="' . $lang['report_Report_post'] . '" border="0" /></a>';
        $sql = "SELECT * FROM " . REPORTS . " WHERE report_type = 1 AND report_status = 0 AND report_info = " . $postrow[$i]['post_id'];
        if( !($result = $db->sql_query($sql)) )
        {
	       message_die(GENERAL_ERROR, 'Could not query report', '', __LINE__, __FILE__, $sql);
        }
        if ( $report = $db->sql_fetchrow($result) )
        {
            if ( $userdata['user_level'] != 0 )
            {
                $reportimg = '<a href="modules.php?name=Forums&file=report&mode=finish&post=' . $report['report_info'] . '"><img src="' . $images['icon_reportpost2'] . '" alt="' . $lang['report_Report_post'] . '" title="' . $lang['report_Report_post'] . '" border="0" /></a>';
            }
        }
    }
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

        $post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : '';

        $message = $postrow[$i]['post_text'];
        $bbcode_uid = $postrow[$i]['bbcode_uid'];

/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
        $user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] && !$signature[$poster_id]) ? $postrow[$i]['user_sig'] : ''; 
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
        $user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];

        //
        // Note! The order used for parsing the message _is_ important, moving things around could break any
        // output
        //

        //
        // If the board has HTML off but the post has HTML
        // on then we process it, else leave it alone
        //
        if ( !$board_config['allow_html'] )
        {
                if ( $user_sig != '' && $userdata['user_allowhtml'] )
                {
                        $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
                }

                if ( $postrow[$i]['enable_html'] )
                {
                        $message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
                }
        }

        //
        // Parse message and/or sig for BBCode if reqd
        //
        if ( $board_config['allow_bbcode'] )
        {
                if ( $user_sig != '' && $user_sig_bbcode_uid != '' )
                {
                        $user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
                }

                if ( $bbcode_uid != '' )
                {
                        $message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
                }
        }

        if ( $user_sig != '' )
        {
                $user_sig = make_clickable($user_sig);
        }
        $message = make_clickable($message);

        //
        // Parse smilies
        //
        if ( $board_config['allow_smilies'] )
        {
                if ( $postrow[$i]['user_allowsmile'] && $user_sig != '' )
                {
                        $user_sig = smilies_pass($user_sig);
                }

                if ( $postrow[$i]['enable_smilies'] )
                {
                        $message = smilies_pass($message);
                }
        }

        //
        // Highlight active words (primarily for search)
        //
        if ($highlight_match)
        {
                // This was shamelessly 'borrowed' from volker at multiartstudio dot de
                // via php.net's annotated manual
                $message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace('#\b(" . $highlight_match . ")\b#i', '<span style=\"color:#" . $theme['fontcolor3'] . "\"><strong>\\\\1</strong></span>', '\\0')", '>' . $message . '<'), 1, -1));
        }

        //
        // Replace naughty words
        //
        if (count($orig_word))
        {
                $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

                if ($user_sig != '')
                {
                        $user_sig = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
                }

                $message = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
        }

        //
        // Replace newlines (we use this rather than nl2br because
        // till recently it wasn't XHTML compliant)
        //
        if ( $user_sig != '' )
        {
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1  START */
/*****************************************************/
                // $user_sig = '<br />_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
                $user_sig = '<br />'.$board_config['sig_line'].'<br />' . str_replace("\n", "\n<br />\n", $user_sig);
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1    END */
/*****************************************************/
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
                $signature[$poster_id] = $board_config['sig_perpage'];
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
        }

/*****************************************************/
/* Forum - Acronym v.0.9.5                     START */
/*****************************************************/
        $message = acronym_pass( $message );
/*****************************************************/
/* Forum - Acronym v.0.9.5                       END */
/*****************************************************/
        $message = str_replace("\n", "\n<br />\n", $message);

/*****************************************************/
/* Forum - Force Word Wrapping v.1.0.12        START */
/*****************************************************/
        $message = word_wrap_pass($message);
/*****************************************************/
/* Forum - Force Word Wrapping v.1.0.12          END */
/*****************************************************/

        //
        // Editing information
        //
        if ( $postrow[$i]['post_edit_count'] )
        {
                $l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

                $l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
        }
        else
        {
                $l_edited_by = '';
        }

/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
	$online_status = '';

	if ( $poster_id != ANONYMOUS )
	{
		if ( $postrow[$i]['user_session_time'] >= (time()-60) )
		{
			if ( $postrow[$i]['user_allow_viewonline'] )
			{
				$online_status = '<br />' . $lang['Online_status'] . ': <strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $poster) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
			}
			else if ( $is_auth['auth_mod'] || ( $userdata['user_id'] == $poster_id ) )
			{
				$online_status = '<br />' . $lang['Online_status'] . ': <strong><i><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $poster) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></i></strong>';
			}
			else
			{
				$online_status = '<br />' . $lang['Online_status'] . ': <strong><span title="' . sprintf($lang['is_offline'], $poster) . '"' . $offline_color . '>' . $lang['Offline'] . '</span></strong>';
			}
		}
		else
		{
			$online_status = '<br />' . $lang['Online_status'] . ': <strong><span title="' . sprintf($lang['is_offline'], $poster) . '"' . $offline_color . '>' . $lang['Offline'] . '</span></strong>';
		}
	}
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   START */
/*****************************************************/
	//
	// Quick Reply
	//
	if ( $show_qr_form )
	{
		$poster = '<a href="javascript:pn(\''.$poster.'\');">'.$poster.'</a>';
	}
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   END   */
/*****************************************************/

/*****************************************************/
/* Forum - Thread Kicker v.1.0.3               START */
/*****************************************************/
		if ( $viewer_kicked !=5 ) {
			if ( $userdata['kick_ban'] !=1 ) {
				$tk_post_id=$postrow[$i]['post_id'];
				$thread_kick_img[$i] ='';
				$kicker=$userdata['user_id'];
				$thisthread_modstatus = $is_auth['auth_mod'];

				if ( $userdata['user_level'] == ADMIN || $tk_posterid == $userdata['user_id'] && $poster_id != $userdata['user_id'] || $is_auth['auth_mod'] ) {
					$sql=" SELECT user_level FROM " . USERS_TABLE . " WHERE user_id=$poster_id";

					if (!$result= $db->sql_query($sql)) {
						message_die(GENERAL_ERROR, 'Error in getting poster user level for thread kick mod', '', __LINE__, __FILE__, $sql);
					}

					$row = $db->sql_fetchrow($result);
					$this_poster_tk=$row['user_level'];

					if ( $this_poster_tk != ADMIN && $this_poster_tk != MOD ) {
						$thread_kick_img[$i] = '<a href="' . append_sid("thread_kicker.$phpEx?thread_tag=$topic_id&kicked=$poster_id&kicker=$kicker&mstatus=$thisthread_modstatus&post_id=$tk_post_id") . '"><img src="' . $images['icon_kick'] . '" title="' . $lang['tkick_kickbutton'] . '" alt="' . $lang['tkick_kickbutton'] . '" hspace="3" border="0"></a>';

						if ( $kicked_user ) {
							$tk_y=1;

							while ( $tk_y == $tk_x || $tk_y < $tk_x ) {
								if ( $kicked_user[$tk_y] == $poster_id ) {
									$thread_kick_img[$i] = '<a href="' . append_sid("thread_kicker.$phpEx?thread_tag=$topic_id&unkicked=$poster_id&unkicker=$kicker&mstatus=$thisthread_modstatus&post_id=$tk_post_id") . '"><img src="' . $images['icon_unkick'] . '" title="' . $lang['tkick_unkickbutton'] . '" alt="' . $lang['tkick_unkickbutton'] . '" hspace="3" border="0"></a>';
								}

								$tk_y++;
							}
						}
					}
				}
			}
		}
/*****************************************************/
/* Forum - Thread Kicker v.1.0.3                 END */
/*****************************************************/

        //
        // Again this will be handled by the templating
        // code at some point
        //
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

/*****************************************************/
/* Forum - Topic Jump v.1.0.0                  START */
/*****************************************************/
	$seite = sprintf(( floor( $start / intval($board_config['posts_per_page']) ) + 1 ), ceil( $total_replies / intval($board_config['posts_per_page']) ));
	$seiten = floor ( $total_replies / 15 ) + 1;
	//Topicnavi
	$nummer = (($seite - 1) * 15)+$anzahl+1;
	$anzahl++;
	if ($total_replies <= 15)
	{
	$limit = $total_replies;
	}
	if ($total_replies > 15)
	{
	$limit = $total_replies-(15*($seite-1));
	}
	$prev=$anzahl-1;
	$next=$anzahl+1;

	if ($anzahl !== $limit)
	{

	if ($anzahl == ($limit-1))
	{
	$nextpic='<a href="#botpost"><img src="'.$images['icon_next_post'].'" alt="'.$lang['next_post'].'" title="'.$lang['next_post'].'" border="0" class="jumpimg" ></a>';
	}
	else
	{
	$nextpic='<a href="#pid'.$next.'"><img src="'.$images['icon_next_post'].'" alt="'.$lang['next_post'].'" title="'.$lang['next_post'].'" border="0" class="jumpimg" ></a>';
	}

	$botpic='<a href="#botpost"><img src="'.$images['icon_bottom'].'" border="0" alt="'.$lang['goto_bottom'].'" title="'.$lang['goto_bottom'].'" border="0" class="jumpimg" ></a>';
	$rowtit='<a name="pid'.$anzahl.'"></a>';
	}
	else

	{
	$nextpic='';
	$botpic='';
	$rowtit='<a name="botpost"></a>';
	}

	if ($anzahl !== 1)
	{
	$prevpic='<a href="#pid'.$prev.'"><img src="'.$images['icon_previous_post'].'" alt="'.$lang['prev_post'].'" title="'.$lang['prev_post'].'" border="0" class="jumpimg" ></a>';
	$topppic='<a href="#top"><img src="'.$images['icon_top'].'" border="0" alt="'.$lang['goto_top'].'" title="'.$lang['goto_top'].'" border="0" class="jumpimg" ></a>';
	}
	else
	{
	$prevpic='';
	}
	$topicjump = $topppic.$prevpic.$nextpic.$botpic;
/*****************************************************/
/* Forum - Topic Jump v.1.0.0                    END */
/*****************************************************/

        $template->assign_block_vars('postrow', array(
                'ROW_COLOR' => '#' . $row_color,
                'ROW_CLASS' => $row_class,

/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
                'POSTER_NAME' => CheckUsernameColor($postrow[$i]['user_color_gc'], $postrow[$i]['username']),
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
                'POSTER_RANK' => $poster_rank,
                'RANK_IMAGE' => $rank_image,
                'POSTER_JOINED' => $poster_joined,
                'POSTER_POSTS' => $poster_posts,
                'POSTER_FROM' => $poster_from . $poster_from_flag,
                'POSTER_AVATAR' => $poster_avatar,
/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
                'POSTER_ONLINE_STATUS' => $online_status,
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/
                'POST_DATE' => $post_date,
                'POST_SUBJECT' => $post_subject,
                'MESSAGE' => $message,
                'SIGNATURE' => $user_sig,
                'EDITED_MESSAGE' => $l_edited_by,

                'MINI_POST_IMG' => $mini_post_img,
                'PROFILE_IMG' => $profile_img,
                'PROFILE' => $profile,
                'SEARCH_IMG' => $search_img,
                'SEARCH' => $search,
                'PM_IMG' => $pm_img,
                'PM' => $pm,
                'EMAIL_IMG' => $email_img,
                'EMAIL' => $email,
                'WWW_IMG' => $www_img,
                'WWW' => $www,
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
                'BUDDY_IMG' => $buddy_img,
                'BUDDY' => $buddy,
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
                'ICQ_STATUS_IMG' => $icq_status_img,
                'ICQ_IMG' => $icq_img,
                'ICQ' => $icq,
                'AIM_IMG' => $aim_img,
                'AIM' => $aim,
                'MSN_IMG' => $msn_img,
                'MSN' => $msn,
                'YIM_IMG' => $yim_img,
                'YIM' => $yim,
                'EDIT_IMG' => $edit_img,
                'EDIT' => $edit,
                'QUOTE_IMG' => $quote_img,
                'QUOTE' => $quote,
                'IP_IMG' => $ip_img,
/*****************************************************/
/* Forum - Thread Kicker v.1.0.3               START */
/*****************************************************/
                'THREAD_KICK_IMG' => $thread_kick_img[$i],
/*****************************************************/
/* Forum - Thread Kicker v.1.0.3                 END */
/*****************************************************/
                'IP' => $ip,
                'DELETE_IMG' => $delpost_img,
                'DELETE' => $delpost,
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
                'REPORT_IMG' => $reportimg,
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

                'L_MINI_POST_ALT' => $mini_post_alt,

                'U_MINI_POST' => $mini_post_url,
/*****************************************************/
/* Forum - Topic Jump v.1.0.0                  START */
/*****************************************************/
                'topicjump' => $topicjump,
                'rowtit' =>$rowtit,
/*****************************************************/
/* Forum - Topic Jump v.1.0.0                    END */
/*****************************************************/

/*****************************************************/
/* Forum - Post Search v.1.0.0                 START */
/*****************************************************/
                'U_SEARCH_USER_POSTS' => append_sid("search.$phpEx?search_author=" . urlencode($postrow[$i]['username']) . "&amp;showresults=posts"),
/*****************************************************/
/* Forum - Post Search v.1.0.0                   END */
/*****************************************************/
                'U_POST_ID' => $postrow[$i]['post_id'])
	);

	$cm_viewtopic->post_vars($postrow[$i],$userdata,$forum_id
        );

	display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);
		
}
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                 START */
/*****************************************************/
if ( $show_qr_form )
{
	$template->assign_block_vars('switch_quick_reply', array());
	include_once('includes/viewtopic_quickreply.'.$phpEx);
}
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                   END */
/*****************************************************/

/*****************************************************/
/* Forum - Related Topics v.0.1.1              START */
/*****************************************************/
include_once('includes/functions_related.'.$phpEx);
get_related_topics($topic_id);
/*****************************************************/
/* Forum - Related Topics v.0.1.1                END */
/*****************************************************/

$template->pparse('body');

include_once("includes/page_tail.php");

?>
