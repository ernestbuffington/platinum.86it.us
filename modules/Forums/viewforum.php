<?php
/***************************************************************************
 * PHP-Platinum Nuke Pro: Expect to be impressed                      COPYRIGHT
 * Copyright (c) 2010 - 2011 by http://www.platinumnukepro.com
 * Refer to platinumnukepro.com for detailed information on PHP-Platinum Nuke Pro
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

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

$index = 1;

if (!isset($popup)){
    $module_name = basename(dirname(__FILE__));
    require_once("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
	$phpbb_root_test = '';
}
define('IN_PHPBB', true);
//$phpbb_root_path = './';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_test . 'includes/bbcode.'.$phpEx);
/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0     START */
/*****************************************************/
//include_once('includes/bbcode.' .$phpEx);
/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0       END */
/*****************************************************/
/*****************************quick title edition************************/
include_once(INCLUDE_PATH.'includes/classes/class_attributes.'.$phpEx);
/*****************************quick title edition************************/

//
// Start initial var setup
//
if ( isset($_GET[POST_FORUM_URL]) || isset($_POST[POST_FORUM_URL]) )
{
        $forum_id = ( isset($_GET[POST_FORUM_URL]) ) ? intval($_GET[POST_FORUM_URL]) : intval($_POST[POST_FORUM_URL]);
}
else if ( isset($_GET['forum']))
{
        $forum_id = intval($_GET['forum']);
}
else
{
        $forum_id = '';
}

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;
if ( isset($_GET['mark']) || isset($_POST['mark']) )
{
        $mark_read = (isset($_POST['mark'])) ? $_POST['mark'] : $_GET['mark'];
}
else
{
        $mark_read = '';
}
//
// End initial var setup
//

//
// Check if the user has actually sent a forum ID with his/her request
// If not give them a nice error page.
//
if ( !empty($forum_id) )
{
   // Modified by Attached Forums MOD

	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		WHERE forum_id = $forum_id OR attached_forum_id =$forum_id
		ORDER BY attached_forum_id ASC";
   // END Modified by Attached Forums MOD
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
        }
}
else
{
        message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

//
// If the query doesn't return any rows this isn't a valid forum. Inform
// the user.
//
if ( !($forum_row = $db->sql_fetchrow($result)) )
{
        message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}
   // added by Attached Forums MOD
$attachments='';
if ($db->sql_numrows ($result) > 1)
{
	$attachments=TRUE;
}
   // END added by Attached Forums MOD
//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

//
// Start auth check
//
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] )
{
        if ( !$userdata['session_logged_in'] )
        {
                $redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&start=$start" : '' );
                $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", $_SERVER["SERVER_SOFTWARE"]) ) ? "Refresh: 0; URL=" : "Location: ";
                header($header_location . append_sid("login.$phpEx?redirect=viewforum.$phpEx&$redirect", true));
                exit;
        }
        //
        // The user is not authed to read this forum ...
        //
        $message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

        message_die(GENERAL_MESSAGE, $message);
}
//
// End of auth check
//

//
// Handle marking posts
//
if ( $mark_read == 'topics' )
{
        if ( $userdata['session_logged_in'] )
        {
                $sql = "SELECT MAX(post_time) AS last_post
                        FROM " . POSTS_TABLE . "
                        WHERE forum_id = '$forum_id'";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
                }

                if ( $row = $db->sql_fetchrow($result) )
                {
                        $tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();
                        $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();

                        if ( ( count($tracking_forums) + count($tracking_topics) ) >= 150 && empty($tracking_forums[$forum_id]) )
                        {
                                asort($tracking_forums);
                                unset($tracking_forums[key($tracking_forums)]);
                        }

                        if ( $row['last_post'] > $userdata['user_lastvisit'] )
                        {
                                $tracking_forums[$forum_id] = time();

                                setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
                        }
                }

                $template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
                );
        }

        $message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a> ');
        message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : '';
$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : '';

//
// Do the forum Prune
//
if ( $is_auth['auth_mod'] && $board_config['prune_enable'] )
{
        if ( $forum_row['prune_next'] < time() && $forum_row['prune_enable'] )

        {

                include_once("includes/prune.php");

                require_once("includes/functions_admin.php");
                auto_prune($forum_id);
        }
}
//
// End of forum prune
//

//
// Obtain list of moderators of each forum
// First users, then groups ... broken into two queries
//
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
$sql = "SELECT u.user_id, u.username, u.user_color_gc
        FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
        WHERE aa.forum_id = '$forum_id'
                AND aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '1'
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
                AND u.user_id = ug.user_id
        GROUP BY u.user_id, u.username
        ORDER BY u.user_id";
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

$moderators = array();
while( $row = $db->sql_fetchrow($result) )
{
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
        $moderators[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . CheckUsernameColor($row['user_color_gc'], $row['username']) . '</a>';
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
}

$sql = "SELECT g.group_id, g.group_name
        FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
        WHERE aa.forum_id = '$forum_id'
                AND aa.auth_mod = " . TRUE . "
                AND g.group_single_user = '0'
                AND g.group_type <> ". GROUP_HIDDEN ."
                AND ug.group_id = aa.group_id
                AND g.group_id = aa.group_id
        GROUP BY g.group_id, g.group_name
        ORDER BY g.group_id";
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

while( $row = $db->sql_fetchrow($result) )
{
        $moderators[] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
}

$l_moderators = ( count($moderators) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
$forum_moderators = ( count($moderators) ) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);
//
// Is user watching this forum? 
//
if( $userdata['session_logged_in'] )
{
        ( $forum_row['forum_notify'] == '1' ) ? $can_watch_forum = TRUE : $can_watch_forum = FALSE;
	
        $sql = "SELECT notify_status
		FROM " . FORUMS_WATCH_TABLE . "
		WHERE forum_id = $forum_id
			AND user_id = " . $userdata['user_id'];
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain forum watch information", "", __LINE__, __FILE__, $sql);
	}

	if( $row = $db->sql_fetchrow($result) )
	{
		if( isset($_GET['unwatch']) )
		{
			if( $_GET['unwatch'] == "forum" )
			{
				$is_watching_forum = 0;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : "";
				$sql = "DELETE $sql_priority FROM " . FORUMS_WATCH_TABLE . "
					WHERE forum_id = $forum_id
						AND user_id = " . $userdata['user_id'];
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't delete forum watch information", "", __LINE__, __FILE__, $sql);
				}
			}
			
			$template->assign_vars(array(
				"META" => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=$start") . '">')
			);

			$message = $lang['No_longer_watching_forum'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_forum = TRUE;

			if( $row['notify_status'] )
			{
				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : "";
				$sql = "UPDATE $sql_priority " . FORUMS_WATCH_TABLE . "
					SET notify_status = 0
					WHERE forum_id = $forum_id
						AND user_id = " . $userdata['user_id'];
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update forum watch information", "", __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	else
	{
		if( isset($_GET['watch']) )
		{
			if( $_GET['watch'] == "forum" )
			{
				$is_watching_forum = TRUE;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : "";
				$sql = "INSERT $sql_priority INTO " . FORUMS_WATCH_TABLE . " (user_id, forum_id, notify_status)
					VALUES (" . $userdata['user_id'] . ", $forum_id, 0)";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't insert forum watch information", "", __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				"META" => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=$start") . '">')
			);

			$message = $lang['You_are_watching_forum'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_forum = 0;
		}
	}
}
else
{
	if( isset($_GET['unwatch']) )
	{
		if( $_GET['unwatch'] == "forum" )
		{
			header("Location: " . append_sid("login.$phpEx?redirect=viewforum.$phpEx&" . POST_FORUM_URL . "=$forum_id&unwatch=forum", true));
		}
	}
	else
	{
		$can_watch_forum = 0;
		$is_watching_forum = 0;
	}
}
//
// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if ( !empty($_POST['topicdays']) || !empty($_GET['topicdays']) )
{
        $topic_days = ( !empty($_POST['topicdays']) ) ? intval($_POST['topicdays']) : intval($_GET['topicdays']);
        $min_topic_time = time() - ($topic_days * 86400);

        $sql = "SELECT COUNT(t.topic_id) AS forum_topics
                FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
                WHERE t.forum_id = '$forum_id'
                        AND p.post_id = t.topic_last_post_id
                        AND p.post_time >= '$min_topic_time'";

        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);

        $topics_count = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
        $limit_topics_time = "AND p.post_time >= $min_topic_time";

        if ( !empty($_POST['topicdays']) )
        {
                $start = 0;
        }
}
else
{
        $topics_count = ( $forum_row['forum_topics'] ) ? $forum_row['forum_topics'] : 1;

        $limit_topics_time = '';
        $topic_days = 0;
}

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++)
{
        $selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
        $select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';

/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
$sql = "SELECT t.*, u.username, u.user_color_gc, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
   FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2
   WHERE t.topic_poster = u.user_id 
      AND p.post_id = t.topic_last_post_id 
      AND p.poster_id = u2.user_id 
      AND t.topic_type = " . POST_GLOBAL_ANNOUNCE . " 
   ORDER BY t.topic_last_post_id DESC "; 
if( !$result = $db->sql_query($sql) ) 
{ 
   message_die(GENERAL_ERROR, "Couldn't obtain topic information", "", __LINE__, __FILE__, $sql); 
} 

$topic_rowset = array(); 
$total_announcements = 0; 
while( $row = $db->sql_fetchrow($result) ) 
{ 
   $topic_rowset[] = $row; 
   $total_announcements++; 
} 

$db->sql_freeresult($result); 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/

//
// All announcement data, this keeps announcements
// on each viewforum page ...
//
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
$sql = "SELECT t.*, u.username, u.user_color_gc, u.user_id, u2.username as user2, u2.user_color_gc as color2, u2.user_id as id2, p.post_time, p.post_username, pt.post_text, pt.bbcode_uid
        FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2, " . POSTS_TEXT_TABLE . " pt
        WHERE t.forum_id = '$forum_id'
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_last_post_id
				AND p.post_id = pt.post_id
                AND p.poster_id = u2.user_id
                AND t.topic_type = " . POST_ANNOUNCE . "
        ORDER BY t.topic_last_post_id DESC ";
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
// $topic_rowset = array();
// $total_announcements = 0;
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
while( $row = $db->sql_fetchrow($result) )
{
        $topic_rowset[] = $row;
        $total_announcements++;
}

$db->sql_freeresult($result);

//
// Grab all the basic data (all topics except announcements)
// for this forum
//
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
$sql = "SELECT t.*, u.username, u.user_color_gc, u.user_id, u2.username as user2, u2.user_color_gc as color2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time, pt.post_text, pt.bbcode_uid
        FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2, " . POSTS_TEXT_TABLE . " pt
        WHERE t.forum_id = '$forum_id'
                AND t.topic_poster = u.user_id
                AND p.post_id = t.topic_first_post_id
                AND p2.post_id = t.topic_last_post_id
                AND u2.user_id = p2.poster_id
				AND p2.post_id = pt.post_id
                AND t.topic_type <> " . POST_ANNOUNCE . "
                AND t.topic_type <> " . POST_GLOBAL_ANNOUNCE . " 
                $limit_topics_time
        ORDER BY t.topic_type DESC, t.topic_last_post_id DESC
        LIMIT $start, ".$board_config['topics_per_page'];
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
while( $row = $db->sql_fetchrow($result) )
{
        $topic_rowset[] = $row;
        $total_topics++;
}

$db->sql_freeresult($result);

//
// Total topics ...
//
$total_topics += $total_announcements;

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Post URL generation for templating vars
//
$template->assign_vars(array(
        'L_DISPLAY_TOPICS' => $lang['Display_topics'],

        'U_POST_NEW_TOPIC' => append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id"),

        'S_SELECT_TOPIC_DAYS' => $select_topic_days,
        'S_POST_DAYS_ACTION' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&amp;start=$start"))
);

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
attach_build_auth_levels($is_auth, $s_auth_can);

if ( $is_auth['auth_mod'] )
{
        $s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
}

//
// Mozilla navigation bar
//
$nav_links['up'] = array(
        'url' => append_sid('index.'.$phpEx),
        'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);
//
// Forum watch information
//
$s_watching_forum = "";

if( $can_watch_forum )
{
	if( $is_watching_forum )
	{
		$s_watching_forum = '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;unwatch=forum&amp;start=$start") . '">' . $lang['Stop_watching_forum'] . '</a>';
		$s_watching_forum_img = ( isset($images['Forum_un_watch']) ) ? '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;unwatch=forum&amp;start=$start") . '"><img src="' . $images['Forum_un_watch'] . '" alt="' . $lang['Stop_watching_forum'] . '" title="' . $lang['Stop_watching_forum'] . '" border="0"></a>' : '';
	}
	else
	{
		$s_watching_forum = '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;watch=forum&amp;start=$start") . '">' . $lang['Start_watching_forum'] . '</a>';
		$s_watching_forum_img = ( isset($images['Forum_watch']) ) ? '<a href="' . append_sid("viewforum.$phpEx?" . POST_TOPIC_URL . "=$forum_id&amp;watch=forum&amp;start=$start") . '"><img src="' . $images['Forum_watch'] . '" alt="' . $lang['Stop_watching_forum'] . '" title="' . $lang['Start_watching_forum'] . '" border="0"></a>' : '';
	}
}

//
// Dump out the page header and load viewforum template
//
define('SHOW_ONLINE', true);
$page_title = $lang['View_forum'] . ' - ' . $forum_row['forum_name'];
include_once("includes/page_header.php");

$template->set_filenames(array(
        'body' => 'viewforum_body.tpl')
);
   // Added by Attached Forums MOD

if ($forum_row[attached_forum_id]>0)
{
	$parent_lookup=$forum_row[attached_forum_id];
}
   // END Added by Attached Forums MOD
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
        'FORUM_ID' => $forum_id,
        'FORUM_NAME' => $forum_row['forum_name'],
        'MODERATORS' => $forum_moderators,
        'POST_IMG' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'],

        'FOLDER_IMG' => $images['folder'],
        'FOLDER_NEW_IMG' => $images['folder_new'],
        'FOLDER_HOT_IMG' => $images['folder_hot'],
        'FOLDER_HOT_NEW_IMG' => $images['folder_hot_new'],
        'FOLDER_LOCKED_IMG' => $images['folder_locked'],
        'FOLDER_LOCKED_NEW_IMG' => $images['folder_locked_new'],
        'FOLDER_STICKY_IMG' => $images['folder_sticky'],
        'FOLDER_STICKY_NEW_IMG' => $images['folder_sticky_new'],
        'FOLDER_ANNOUNCE_IMG' => $images['folder_announce'],
        'FOLDER_ANNOUNCE_NEW_IMG' => $images['folder_announce_new'],
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
        'FOLDER_GLOBAL_ANNOUNCE_IMG' => $images['folder_global_announce'],
        'FOLDER_GLOBAL_ANNOUNCE_NEW_IMG' => $images['folder_global_announce_new'],
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/

        'L_TOPICS' => $lang['Topics'],
        'L_REPLIES' => $lang['Replies'],
        'L_VIEWS' => $lang['Views'],
        'L_POSTS' => $lang['Posts'],
        'L_LASTPOST' => $lang['Last_Post'],
        'L_MODERATOR' => $l_moderators,
        'L_MARK_TOPICS_READ' => $lang['Mark_all_topics'],
        'L_POST_NEW_TOPIC' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'],
        'L_NO_NEW_POSTS' => $lang['No_new_posts'],
        'L_NEW_POSTS' => $lang['New_posts'],
        'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
        'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
        'L_NO_NEW_POSTS_HOT' => $lang['No_new_posts_hot'],
        'L_NEW_POSTS_HOT' => $lang['New_posts_hot'],
        'L_ANNOUNCEMENT' => $lang['Post_Announcement'],
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
        'L_GLOBAL_ANNOUNCEMENT' => $lang['Post_global_announcement'], 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
        'L_STICKY' => $lang['Post_Sticky'],
        'L_POSTED' => $lang['Posted'],
        'L_JOINED' => $lang['Joined'],
        'L_AUTHOR' => $lang['Author'],

        'S_AUTH_LIST' => $s_auth_can,
        'S_WATCH_FORUM' => $s_watching_forum,
        'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id"),

        'U_MARK_READ' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;mark=topics"))
);
//
// End header
//

/*****************************************************/
/* Forum - Search Form v.1.0.2                 START */
/*****************************************************/
$template->assign_vars(array(
	'L_SEARCH_FOR' => $lang['Search_for'],
	'L_SUBMIT_SEARCH' => $lang['Submit_search'])
);
/*****************************************************/
/* Forum - Search Form v.1.0.2                   END */
/*****************************************************/

//
// Okay, lets dump out the page ...
//
   // Added by Attached Forums MOD

if ($attachments)
{

		//
		// Obtain a list of topic ids which contain
		// posts made since user last visited
		//
		if ( $userdata['session_logged_in'] )
		{
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
		}

		$sql2 = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_color_gc, u.user_id, t.topic_id, t.topic_title
			FROM ((( " . FORUMS_TABLE . " f
			LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
			LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
			LEFT JOIN " . TOPICS_TABLE . " t ON t.topic_last_post_id = f.forum_last_post_id)
			WHERE attached_forum_id = " . $forum_id . "
			GROUP by f.forum_id ORDER BY f.forum_order";

		$result2 = $db->sql_query ($sql2);
		if (!$result2 )
		{
			message_die ('Could not gather attached forum info', __LINE__, __FILE__, $sql2);
		}

		if ($db->sql_numrows ($result2) != 0)
		{
			while( $row = $db->sql_fetchrow($result2) )
			{
				$forum_data[] = $row;
			}
			$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

			$x=0;
			foreach ($forum_data as $row2 => $value)
			{
				if ($is_auth_ary[$value['forum_id']]['auth_view'])
				{
					$x++;
					if ($x==1)
					{
						$template->assign_block_vars ('switch_attached_list',
								   array( 'L_ATTACHED_FORUM' => $lang['Attached_forums'],
										 'L_ATTACHED_TOPICS' => $lang['Topics'],
										 'L_ATTACHED_POSTS' => $lang['Posts'],
										 'L_LAST_POST'=>$lang['Last_Post']
									   )
									);

					}
					$attach_forum_link = append_sid('viewforum.php?f=' . $value['forum_id']);
					$attach_forum_name = '<a href="' . append_sid('viewforum.php?f=' . $value['forum_id']) . '">' . $value['forum_name'] . '</a>' ;
					$attach_forum_desc = $value['forum_desc'];
					$attach_forum_topics = $value['forum_topics'];
					$attach_forum_posts = $value['forum_posts'];
					$last_post_id = $value['forum_last_post_id'];

   					if ( $value['forum_status'] == FORUM_LOCKED )
					{
						$folder_image = $images['forum_locked'];
						$folder_alt = $lang['Forum_locked'];
					}
					else
					{
						$unread_topics = false;
						if ( $userdata['session_logged_in'] )
						{
							$unread_topics=check_unread($value['forum_id']);
						}

						$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
						$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
					}

					if ( $value['forum_last_post_id'] )
					{

						if (strlen($value['topic_title'])>=25)
						{
							$value['topic_title']=substr($value['topic_title'],0,25). "...";
						}

						$last_post_time = create_date($board_config['default_dateformat'], $value['post_time'], $board_config['board_timezone']);
						$last_post = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $value['forum_last_post_id']) . '#' . $value['forum_last_post_id'] . '">'.$value['topic_title'].' <img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';

						$last_post .= '<br /> '; 
						$last_post .= ' '.$last_post_time;	
						$last_post .= '<br /> '; 
						$last_post .= ( $value['user_id'] == ANONYMOUS ) ? ( ($value['post_username'] != '' ) ? $value['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $value['user_id']) . '">' . CheckUsernameColor($value['user_color_gc'],$value['username']) . '</a> ';
													


					}
					else
					{
						$last_post = $lang['No_Posts'];
					}




				 $template->assign_block_vars ('switch_attached_list.switch_attached_present',
										 array
										 (
											'FORUM_FOLDER_IMG' => $folder_image,
											'L_FORUM_FOLDER_ALT' => $folder_alt,
											'FORUM_NAME' => $attach_forum_name,
											'U_VIEWFORUM' => $attach_forum_link,
											'FORUM_DESC' => $attach_forum_desc,
											'TOPICS' => $attach_forum_topics,
											'POSTS' => $attach_forum_posts,
											'LAST_POST_ID' => $last_post,
										 ));
				}
		}

	}
	   $db->sql_freeresult ($result2);
}
   // END Added by Attached Forums MOD
if( $total_topics )
{
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
    $prec_topic_real_type = -1;
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
        for($i = 0; $i < $total_topics; $i++)
        {
                $topic_id = $topic_rowset[$i]['topic_id'];

                $topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];	
// Mouse hover topic boxover MOD - BEGIN
//
		$topic_content = $topic_rowset[$i]['post_text'];
		$bbcode_uid = $topic_rowset[$i]['bbcode_uid'];
		$topic_content = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($topic_content, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $topic_content);
		$topic_content = smilies_pass($topic_content);
		$topic_content = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $topic_content . '<'), 1, -1));
        $topic_content = str_replace("\n", "\n<br />\n", $topic_content);
		$topic_content = htmlspecialchars($topic_content);
		$topic_content = "cssbody=[boxbdy1] cssheader=[boxhdr1] header=[". $topic_title ."] body=[".$topic_content."] singleclickstop=[On] hideselects=[on] fade=[on]";
// Mouse hover topic boxover MOD - END
/*****************************quick title edition************************/
		$qte->attr($topic_title, $topic_rowset[$i]['topic_attribute']);
/*****************************quick title edition************************/	
/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0     START */
/*****************************************************/
//This is where you would put the code to disable certain smilies
                $topic_title = smilies_pass($topic_title);
/*****************************************************/
/* Forum - Smilies in Topic Titles v.1.1.0       END */
/*****************************************************/

                $replies = $topic_rowset[$i]['topic_replies'];

                $topic_type = $topic_rowset[$i]['topic_type'];

                if( $topic_type == POST_ANNOUNCE )
                {
                        $topic_type = $lang['Topic_Announcement'] . ' ';
                }
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
                else if( $topic_type == POST_GLOBAL_ANNOUNCE ) 
                { 
                        $topic_type = $lang['Topic_global_announcement'] . ' '; 
                } 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
                else if( $topic_type == POST_STICKY )
                {
                        $topic_type = $lang['Topic_Sticky'] . ' ';
                }
                else
                {
                        $topic_type = '';
                }

                if( $topic_rowset[$i]['topic_vote'] )
                {
                        $topic_type .= $lang['Topic_Poll'] . ' ';
                }

                if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
                {
                        $topic_type = $lang['Topic_Moved'] . ' ';
                        $topic_id = $topic_rowset[$i]['topic_moved_id'];

                        $folder_image =  $images['folder'];
                        $folder_alt = $lang['Topics_Moved'];
                        $newest_post_img = '';
                }
                else
                {
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
                        if( $topic_rowset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE ) 
                        { 
                                $folder = $images['folder_global_announce']; 
                                $folder_new = $images['folder_global_announce_new']; 
                        } 
                        else 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
                        if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE )
                        {
                                $folder = $images['folder_announce'];
                                $folder_new = $images['folder_announce_new'];
                        }
                        else if( $topic_rowset[$i]['topic_type'] == POST_STICKY )
                        {
                                $folder = $images['folder_sticky'];
                                $folder_new = $images['folder_sticky_new'];
                        }
                        else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
                        {
                                $folder = $images['folder_locked'];
                                $folder_new = $images['folder_locked_new'];
/*****************************************************/
/* Forum - Strike Locked Topic Title v.1.0.0   START */
/*****************************************************/
                                $topic_title = "<strike>" . $topic_title . "</strike>";
/*****************************************************/
/* Forum - Strike Locked Topic Title v.1.0.0     END */
/*****************************************************/
                        }
                        else
                        {
                                if($replies >= $board_config['hot_threshold'])
                                {
                                        $folder = $images['folder_hot'];
                                        $folder_new = $images['folder_hot_new'];
                                }
                                else
                                {
                                        $folder = $images['folder'];
                                        $folder_new = $images['folder_new'];
                                }
                        }

                        $newest_post_img = '';
                        if( $userdata['session_logged_in'] )
                        {
                                if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] )
                                {
                                        if( !empty($tracking_topics) || !empty($tracking_forums) || isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
                                        {
                                                $unread_topics = true;

                                                if( !empty($tracking_topics[$topic_id]) )
                                                {
                                                        if( $tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'] )
                                                        {
                                                                $unread_topics = false;
                                                        }
                                                }

                                                if( !empty($tracking_forums[$forum_id]) )
                                                {
                                                        if( $tracking_forums[$forum_id] >= $topic_rowset[$i]['post_time'] )
                                                        {
                                                                $unread_topics = false;
                                                        }
                                                }

                                                if( isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
                                                {
                                                        if( $_COOKIE[$board_config['cookie_name'] . '_f_all'] >= $topic_rowset[$i]['post_time'] )
                                                        {
                                                                $unread_topics = false;
                                                        }
                                                }

                                                if( $unread_topics )
                                                {
                                                        $folder_image = $folder_new;
                                                        $folder_alt = $lang['New_posts'];

                                                        $newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . '&' . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a>';
                                                }
                                                else
                                                {
                                                        $folder_image = $folder;
                                                        $folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

                                                        $newest_post_img = '';
                                                }
                                        }
                                        else
                                        {
                                                $folder_image = $folder_new;
                                                $folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];

                                                $newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . '&' . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a>';
                                        }
                                }
                                else
                                {
                                        $folder_image = $folder;
                                        $folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

                                        $newest_post_img = '';
                                }
                        }
                        else
                        {
                                $folder_image = $folder;
                                $folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

                                $newest_post_img = '';
                        }
                }

                if( ( $replies + 1 ) > $board_config['posts_per_page'] )
                {
                        $total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
                        $goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';

                        $times = 1;
                        for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page'])
                        {
                                $goto_page .= '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
                                if( $times == 1 && $total_pages > 4 )
                                {
                                        $goto_page .= ' ... ';
                                        $times = $total_pages - 3;
                                        $j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
                                }
                                else if ( $times < $total_pages )
                                {
                                        $goto_page .= ', ';
                                }
                                $times++;
                        }
                        $goto_page .= ' ] ';
                }
                else
                {
                        $goto_page = '';
                }

/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
                $topic_rowset[$i]['username'] 	= CheckUsernameColor($topic_rowset[$i]['user_color_gc'], $topic_rowset[$i]['username']);
                $topic_rowset[$i]['username2']	= CheckUsernameColor($topic_rowset[$i]['user_color_gc'], $topic_rowset[$i]['username2']);
                $topic_rowset[$i]['user2'] = CheckUsernameColor($topic_rowset[$i]['user_color_gc'], $topic_rowset[$i]['user2']);
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/

                $view_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

                $topic_author = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
                $topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );

                $topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';

                $first_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);

                $last_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);

                $last_post_author = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';

                $last_post_url = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_TOPIC_URL . "=" . $topic_id . '&' . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';

                $views = $topic_rowset[$i]['topic_views'];

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
  
                $template->assign_block_vars('topicrow', array(
                        'ROW_COLOR' => $row_color,
                        'ROW_CLASS' => $row_class,
                        'FORUM_ID' => $forum_id,
                        'TOPIC_ID' => $topic_id,
                        'TOPIC_FOLDER_IMG' => $folder_image,
                        'TOPIC_AUTHOR' => $topic_author,
                        'GOTO_PAGE' => $goto_page,
                        'REPLIES' => $replies,
                        'NEWEST_POST_IMG' => $newest_post_img,
                        'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($topic_rowset[$i]['topic_attachment']),
                        'TOPIC_TITLE' => $topic_title,
						'TOPIC_CONTENT' => $topic_content,
                        'TOPIC_TYPE' => $topic_type,
                        'VIEWS' => $views,
                        'FIRST_POST_TIME' => $first_post_time,
                        'LAST_POST_TIME' => $last_post_time,
                        'LAST_POST_AUTHOR' => $last_post_author,
                        'LAST_POST_IMG' => $last_post_url,

                        'L_TOPIC_FOLDER_ALT' => $folder_alt,

                        'U_VIEW_TOPIC' => $view_topic_url)
                );
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
        $topic_real_type = $topic_rowset[$i]['topic_type'];
        if (!$switch_split_announce) $topic_real_type = POST_NORMAL;
        if ( (!$switch_split_global_announce) && ($topic_real_type == POST_GLOBAL_ANNOUNCE) ) $topic_real_type = POST_ANNOUNCE;
        if ( (!$switch_split_sticky) && ($topic_real_type == POST_STICKY) ) $topic_real_type = POST_NORMAL;
        $is_rupt = false;
        if ($prec_topic_real_type != $topic_real_type)
        {
            if ($prec_topic_real_type == -1) $is_rupt = ( $topic_real_type != POST_NORMAL );

            if ($prec_topic_real_type != -1) $is_rupt = true;
        }
        if ( $is_rupt )
        {
            $title = '';
            switch ($topic_real_type)
            {
                case POST_GLOBAL_ANNOUNCE:
                    $title = $lang['Post_global_announcement']."s";
                    break;

                case POST_ANNOUNCE:
                    $title = $lang['Post_Announcement']."s";
                    break;

                case POST_STICKY:
                    $title = $lang['Post_Sticky'];
                    break;

                case POST_NORMAL:
                    $title = $lang['Topics'];
                    break;

                default:
                    $title = '???';
                    break;
            }

            $template->assign_block_vars('topicrow.topictype', array(
                'TITLE' => $title,
                )
            );
        }
        $prec_topic_real_type = $topic_real_type;
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
        }

        $topics_count -= $total_announcements;

        $template->assign_vars(array(
                'PAGINATION' => generate_pagination("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;topicdays=$topic_days", $topics_count, $board_config['topics_per_page'], $start),
                'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] )),

                'L_GOTO_PAGE' => $lang['Goto_page'])
        );
}
else
{
        //
        // No topics
        //
        $no_topics_msg = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
        $template->assign_vars(array(
                'L_NO_TOPICS' => $no_topics_msg)
        );

        $template->assign_block_vars('switch_no_topics', array() );

}

//
// Parse the page and print
//
$template->pparse('body');

//
// Page footer
//
include_once("includes/page_tail.php");

?>
