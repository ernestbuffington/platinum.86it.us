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
$module_name = basename(dirname(__FILE__));
require_once("modules/Forums/nukebb.php");
define('IN_PHPBB', true);
$phpbb_root_path = 'modules/Forums/';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once('includes/functions_admin.'.$phpEx);

// function block
function get_topic_id($topic)
{
	global $db;
	$topic_id = 0;

	// is this a direct value ?
	$num_topic = intval($topic);
	if ($topic == "$num_topic")
	{
		$topic_id = intval($topic);
	}

	// is it an url with topic id or post id ?
	else
	{
		$name = explode('?', $topic);
		$parms = ( isset($name[1]) ) ? $name[1] : $name[0];
		parse_str($parms, $parm);
		$found = false;
		$topic_id = 0;
		while ((list($key, $val) = each($parm)) && !$found)
		{
			$vals = explode('#', $val);
			$val = $vals[0];
			if (empty($val)) $val = 0;
			switch($key)
			{
				case POST_POST_URL:
					$sql = "SELECT topic_id FROM " . POSTS_TABLE . " WHERE post_id=$val";
					if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get post informations', '', __LINE__, __FILE__, $sql);
					if ($row = $db->sql_fetchrow($result))
					{
						$val = $row['topic_id'];
						$found = true;
					}
					break;
				case POST_TOPIC_URL:
					$found = true;
					break;
			}
			if ($found)
			{
				$topic_id = intval($val);
			}
		}
	}

	return $topic_id;
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

// check if user is a moderator or an admin
if (($userdata['user_level'] != MOD) && ($userdata['user_level'] != ADMIN))
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}

// from topic
$from_topic = isset($_POST['from_topic']) ? strtolower(trim(htmlspecialchars($_POST['from_topic']))) : '';
if (empty($from_topic) && (isset($_GET[POST_TOPIC_URL]) || isset($_GET[POST_POST_URL])))
{
	$from_topic = (isset($_GET[POST_TOPIC_URL])) ? intval($_GET[POST_TOPIC_URL]) : POST_POST_URL . '=' . intval($_GET[POST_POST_URL]);
}
$from_topic_id = get_topic_id($from_topic);

// to topic
$to_topic = isset($_POST['to_topic']) ? strtolower(trim(htmlspecialchars($_POST['to_topic']))) : '';
$to_topic_id =  get_topic_id($to_topic);

// topic title
$topic_title = '';
if (isset($_POST['topic_title'])) $topic_title = htmlspecialchars(trim(stripslashes($_POST['topic_title'])));

// start
if (isset($_POST['start'])) $start = intval($start);

// buttons
$submit = isset($_POST['submit']);
$confirm = isset($_POST['confirm']);
$cancel = isset($_POST['cancel']);
$shadow = isset($_POST['shadow']);
if ($cancel) $submit = false;
$select_from = isset($_POST['select_from']);
$select_to = isset($_POST['select_to']);
$page_prec = isset($_POST['page_prec']);
$page_next = isset($_POST['page_next']);

// check if a selection has been made
$topic_selected = 0;
if (isset($_POST['topic_selected']))
{
	$topic_selected = intval($_POST['topic_selected']);
}

if ($submit && !empty($topic_selected))
{
	$submit = false;
	if ($select_from)
	{
		$from_topic = $topic_selected;
		$from_topic_id = $topic_selected;
	}
	if ($select_to)
	{
		$to_topic = $topic_selected;
		$to_topic_id = $topic_selected;
	}
	$select_from = false;
	$select_to = false;
}

// session id
$sid = '';
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}

// titles
$from_title = '';
if (!empty($from_topic_id))
{
	$sql = "SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get from-topic informations', '', __LINE__, __FILE__, $sql);
	if ($row = $db->sql_fetchrow($result))
	{
		$from_title = $row['topic_title'];
	}
}
$to_title = '';
if (!empty($to_topic_id))
{
	$sql = "SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$to_topic_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get to-topic informations', '', __LINE__, __FILE__, $sql);
	if ($row = $db->sql_fetchrow($result))
	{
		$to_title = $row['topic_title'];
	}
}

// forum_id
$forum_id = 0;
if (isset($_POST[POST_FORUM_URL]) || isset($_GET[POST_FORUM_URL]))
{
	$forum_id = (isset($_POST[POST_FORUM_URL])) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]);
}

// selection
if (($select_from || $select_to) && (!$cancel))
{
	// get the list of forums
	if (function_exists(selectbox))
	{
		$list_forums = select_box(POST_FORUM_URL, false, $forum_id);
	}
	else
	{
		$list_forums = make_forum_select(POST_FORUM_URL, false, $forum_id);
	}

	// how many record in the forum
	$nbpages = 0;
	$per_page = intval($board_config['topics_per_page']);
	if (!empty($forum_id))
	{
		$sql = "SELECT COUNT(*) as number FROM " . TOPICS_TABLE . " WHERE forum_id=$forum_id AND topic_status <> " . TOPIC_MOVED;
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get topics informations', '', __LINE__, __FILE__, $sql);
		$num_items = $db->sql_fetchrow($result);
		$nbpages = ceil($num_items['number'] / $per_page) - 1;
		if ($nbpages < 0) $nbpages = 0;
	}

	// change current page
	if ($page_prec && ($start > 0)) $start--;
	if ($page_next && ($start < $nbpages)) $start++;

	$pagination = '';
	if ($nbpage > 1)
	{
		if ($start > 0) $pagination .= '<input type="submit" name="page_prec" value="«" class="liteoption" />&nbsp;';
		$pagination .= sprintf($lang['Page_of'], ($start+1), ($nbpages+1)) . '&nbsp;';
		if ($start < $nbpage) $pagination .= '<input type="submit" name="page_next" value="»" class="liteoption" />';
	}

	// set the page title and include_once the page header
	$page_title = $lang['Merge_topics'];
	include_once ('includes/page_header.'.$phpEx);

	// template name
	$template->set_filenames(array(
		'body' => 'merge_select_body.tpl')
	);
	// header
	$template->assign_vars(array(
		'L_SELECT'		=> $lang['Select'],
		'L_TITLE'		=> ($select_from) ? $lang['Merge_topic_from'] : $lang['Merge_topic_to'],
		'L_REPLIES'		=> $lang['Replies'],
		'L_AUTHOR'		=> $lang['Author'],
		'L_VIEWS'		=> $lang['Views'],
		'L_LASTPOST'	=> $lang['Last_Post'],

		'L_GO'			=> $lang['Go'],
		'L_SELECT'		=> $lang['Select'],
		'L_CANCEL'		=> $lang['Cancel'],
		'S_LIST_FORUMS'	=> $list_forums,
		'PAGINATION'	=> $pagination,
		'L_NO_TOPICS'	=> $lang['No_search_match'],
		)
	);

	// read the forum
	$start_topic = $start * $per_page;
	$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time 
		FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
		WHERE t.forum_id = $forum_id
			AND t.topic_poster = u.user_id
			AND p.post_id = t.topic_first_post_id
			AND p2.post_id = t.topic_last_post_id
			AND u2.user_id = p2.poster_id 
		ORDER BY t.topic_type DESC, t.topic_last_post_id DESC 
		LIMIT $start_topic, $per_page";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get topics informations', '', __LINE__, __FILE__, $sql);
	$topics_data = array();
	while ($row = $db->sql_fetchrow($result)) $topic_rowset[] = $row;

	// values
	for ($i=0; $i < count($topic_rowset); $i++)
	{
		// topic type
		$folder = $images['folder'];
		if($topic_rowset['topic_replies'] >= $board_config['hot_threshold'])
		{
			$folder = $images['folder_hot'];
		}
		if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
		{
			$folder = $images['folder_locked'];
		}
		$l_type = '';
		switch( $topic_rowset[$i]['topic_type'] )
		{
			case POST_ANNOUNCE:
				$l_type = $lang['Topic_Announcement'];
				$folder = $images['folder_announce'];
				break;
			case POST_STICKY:
				$l_type = $lang['Topic_Sticky'];
				$folder = $images['folder_sticky'];
				break;
		}

		// topic author
		$topic_author  = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );
		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
		$last_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);
		$last_post_author = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';

		$template->assign_block_vars('topicrow', array(
			'TOPIC_ID'			=> $topic_rowset[$i]['topic_id'],
			'TOPIC_FOLDER_IMG'	=> $folder,
			'TOPIC_TYPE'		=> ($l_type != '') ? $l_type . '&nbsp;' : '',
			'TOPIC_TITLE'		=> $topic_rowset[$i]['topic_title'],
			'REPLIES'			=> $topic_rowset[$i]['topic_replies'],
			'TOPIC_AUTHOR'		=> $topic_author,
			'VIEWS'				=> $topic_rowset[$i]['topic_views'],
			'LAST_POST_TIME'	=> $last_post_time,
			'LAST_POST_AUTHOR'	=> $last_post_author,
			'U_VIEW_TOPIC'		=> append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_rowset[$i]['topic_id']),
			)
		);
	}
	if (count($topic_rowset) == 0) $template->assign_block_vars('no_topics', array());

	// system
	$s_hidden_fields  = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	$s_hidden_fields .= '<input type="hidden" name="topic_title" value="' . addslashes($topic_title) . '" />';
	$s_hidden_fields .= '<input type="hidden" name="from_topic" value="' . $from_topic . '" />';
	$s_hidden_fields .= '<input type="hidden" name="to_topic" value="' . $to_topic . '" />';
	$s_hidden_fields .= '<input type="hidden" name="submit" value="1" />';
	if ($shadow) $s_hidden_fields .= '<input type="hidden" name="shadow" value="1" />';
	if ($select_from) $s_hidden_fields .= '<input type="hidden" name="select_from" value="1" />';
	if ($select_to) $s_hidden_fields .= '<input type="hidden" name="select_to" value="1" />';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("merge.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
	// footer
	$template->pparse('body');
	include_once('includes/page_tail.'.$phpEx);
	exit;
}

// submission
if ($submit)
{
	// check session id
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		message_die(GENERAL_ERROR, 'Invalid_session');
	}

	// init
	$error = false;
	$error_msg = '';
	$message = '';

	// check if the from topic exists and get the forum_id
	$found = false;
	$from_forum_id = 0;
	$from_poll = false;
	if (!empty($from_topic_id))
	{
		$sql = "SELECT forum_id, topic_vote FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get topic informations', '', __LINE__, __FILE__, $sql);
		if ($row = $db->sql_fetchrow($result))
		{
			$from_forum_id = $row['forum_id'];
			$from_poll = $row['topic_vote'];
			$found = true;
		}
	}
	if (!$found)
	{
		$error = true;
		$error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_from_not_found'];
	}

	// check if the from topic exists and get the forum_id
	$found = false;
	$to_forum_id = 0;
	$to_poll = false;
	if (!empty($to_topic_id))
	{
		$sql = "SELECT forum_id, topic_vote FROM " . TOPICS_TABLE . " WHERE topic_id=$to_topic_id";
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get topic informations', '', __LINE__, __FILE__, $sql);
		if ($row = $db->sql_fetchrow($result))
		{
			$to_forum_id = $row['forum_id'];
			$to_poll = $row['topic_vote'];
			$found = true;
		}
	}
	if (!$found)
	{
		$error = true;
		$error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_to_not_found'];
	}

	// verify the topics are not the same
	if (!$error)
	{
		if ($from_topic_id == $to_topic_id)
		{
			$error = true;
			$error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_topics_equals'];
		}
	}

	// check authorizations
	if (!empty($from_forum_id))
	{
		$is_auth = auth(AUTH_ALL, $from_forum_id, $userdata);
		if ( !$is_auth['auth_mod'] )
		{
			$error = true;
			$error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_from_not_authorized'];
		}
	}
	if (!empty($to_forum_id))
	{
		$is_auth = auth(AUTH_ALL, $to_forum_id, $userdata);
		if ( !$is_auth['auth_mod'] )
		{
			$error = true;
			$error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Merge_to_not_authorized'];
		}
	}

	//
	// warnings
	//
	// add here warnings regarding ie mycalendar

	// does from topic has a poll ?
	if ($from_poll)
	{
		if ($to_poll)
		{
			$message .= (($message != '') ? '<br />' : '') . $lang['Merge_poll_from_and_to'];
		}
		else
		{
			$message .= (($message != '') ? '<br />' : '') . $lang['Merge_poll_from'];
		}
	}

	// error found
	if ($error)
	{
		message_die(GENERAL_ERROR, $error_msg);
	}

	// ask for confirmation or process
	if ($confirm)
	{
		// process poll
		if ($from_poll)
		{
			if ($to_poll)
			{
				// delete the vote
				$vote_id = 0;
				$sql = "SELECT vote_id FROM " . VOTE_DESC_TABLE . " WHERE topic_id=$from_topic_id";
				if ( !$result=$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not read vote description', '', __LINE__, __FILE__, $sql);
				if ($row=$db->sql_fetchrow($result)) $vote_id = $row['vote_id'];
				if (!empty($vote_id))
				{
					// delete voters
					$sql = "DELETE FROM " . VOTE_USERS_TABLE . " WHERE vote_id=$vote_id";
					if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not delete votes', '', __LINE__, __FILE__, $sql);
					// delete results
					$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " WHERE vote_id=$vote_id";
					if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);
					// delete description
					$sql = "DELETE FROM " . VOTE_DESC_TABLE . " WHERE vote_id=$vote_id";
					if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not delete vote description', '', __LINE__, __FILE__, $sql);
				}
			}
			else
			{
				// grab the poll to the new topic
				$sql = "UPDATE " . VOTE_DESC_TABLE . "
							SET topic_id=$to_topic_id
							WHERE topic_id=$from_topic_id";
				if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update vote desc information', '', __LINE__, __FILE__, $sql);
			}
		}

		// here you can add the process of ie mycalendar dates

		// check if the destination is already watched
		$sql = "SELECT * FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id=$to_topic_id";
		if ( !$result=$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not read topics watch informations', '', __LINE__, __FILE__, $sql);
		$user_ids = array();
		while ($row = $db->sql_fetchrow($result)) $user_ids[] = $row['user_id'];
		$sql_user = '';
		if (!empty($user_ids))
		{
			$sql_user = " AND user_id NOT IN (" . implode(', ', $user_ids) . ")";
		}
		// grab the topics watch to the new topic
		$sql = "UPDATE " . TOPICS_WATCH_TABLE . " SET topic_id=$to_topic_id WHERE topic_id=$from_topic_id" . $sql_user;
		if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);
		// clean up the old topics watch
		$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE topic_id=$from_topic_id";
		if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not delete topics watch table', '', __LINE__, __FILE__, $sql);

		// process the posts
		$sql = "UPDATE " . POSTS_TABLE . " SET forum_id=$to_forum_id, topic_id=$to_topic_id WHERE topic_id=$from_topic_id";
		if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update posts information', '', __LINE__, __FILE__, $sql);

		// get the old topic data for a shadow
		$sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
		if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not read from-topic informations', '', __LINE__, __FILE__, $sql);
		$topic_data = $db->sql_fetchrow($result);

		if ($shadow)
		{
			// transform the merged topic in a shadow
			$sql = "UPDATE " . TOPICS_TABLE . " 
					SET topic_status=" . TOPIC_MOVED . ", topic_type=" . POST_NORMAL . ", topic_moved_id=$to_topic_id
					WHERE topic_id=$from_topic_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not set shadow topic', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			// delete the old topic
			$sql = "DELETE FROM " . TOPICS_TABLE . " WHERE topic_id=$from_topic_id";
			if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update delete topic merged', '', __LINE__, __FILE__, $sql);
		}

		// update the topic title
		if (!empty($topic_title))
		{
			$sql = "UPDATE " . TOPICS_TABLE . " SET topic_title='" . str_replace("\'", "''", $topic_title) . "' WHERE topic_id=$to_topic_id";
			if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update topic title', '', __LINE__, __FILE__, $sql);
		}

		// synchronise the destination topic, and the both forums
		sync('topic', $to_topic_id);
		if ($from_forum_id != $to_forum_id) sync('forum', $from_forum_id);
		sync('forum', $to_forum_id);
		
		// send end message
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$to_topic_id") . '">')
		);
		message_die(GENERAL_MESSAGE, $lang['Merge_topic_done'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$to_topic_id") . '" class="gen">', '</a>')  . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '" class="gen">', '</a>'));
		exit;
	}
	else
	{
		// ask for confirmation
		$message .= (($message != '') ? '<br />' : '') . sprintf($lang['Merge_confirm_process'], $from_title, $to_title);

		$page_title = $lang['Merge_topics'];
		include_once ('includes/page_header.'.$phpEx);
		$template->set_filenames(array(
			'body' => 'confirm_body.tpl')
		);

		$s_hidden_fields  = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
		$s_hidden_fields .= '<input type="hidden" name="topic_title" value="' . addslashes($topic_title) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="from_topic" value="' . $from_topic . '" />';
		$s_hidden_fields .= '<input type="hidden" name="to_topic" value="' . $to_topic . '" />';
		$s_hidden_fields .= '<input type="hidden" name="submit" value="1" />';
		if ($shadow) $s_hidden_fields .= '<input type="hidden" name="shadow" value="1" />';

		// header
		$template->assign_vars(array(
			'MESSAGE_TITLE'		=> $page_title,
			'MESSAGE_TEXT'		=> $message,
			'L_YES'				=> $lang['Yes'],
			'L_NO'				=> $lang['No'],
			'S_CONFIRM_ACTION'	=> append_sid("merge.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
		// footer
		$template->pparse('body');
		include_once('includes/page_tail.'.$phpEx);
		exit;
	}
}

//
// set the page title and include_once the page header
//
$page_title = $lang['Merge_topics'];
include_once ('includes/page_header.'.$phpEx);
//
// template name
//
$template->set_filenames(array(
	'body' => 'merge_body.tpl')
);
//
// header
//
$template->assign_vars(array(
	'L_TITLE'				=> $page_title,
	'L_TOPIC_TITLE'			=> $lang['Merge_title'],
	'L_TOPIC_TITLE_EXPLAIN'	=> $lang['Merge_title_explain'],
	'L_FROM_TOPIC'			=> $lang['Merge_topic_from'],
	'L_FROM_TOPIC_EXPLAIN'	=> $lang['Merge_topic_from_explain'],
	'L_TO_TOPIC'			=> $lang['Merge_topic_to'],
	'L_TO_TOPIC_EXPLAIN'	=> $lang['Merge_topic_to_explain'],
	'L_SHADOW'				=> $lang['Leave_shadow_topic'],
	'L_SUBMIT'				=> $lang['Submit'],
	'L_CANCEL'				=> $lang['Cancel'],
	'L_REFRESH'				=> $lang['Refresh'],
	'L_SEARCH'				=> $lang['Select'],
	)
);
if (!empty($to_title) && empty($topic_title))
{
	$topic_title = $to_title;
}
// values
$template->assign_vars(array(
	'TOPIC_TITLE'	=> $topic_title,
	'FROM_TOPIC'	=> $from_topic,
	'TO_TOPIC'		=> $to_topic,
	'SHADOW'		=> ($shadow) ? 'checked="checked"' : '',
	)
);

// system
$s_hidden_fields  = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
$template->assign_vars(array(
	'S_ACTION'			=> append_sid("merge.$phpEx"),
	'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
	)
);
//
// footer
//
$template->pparse('body');
include_once('includes/page_tail.'.$phpEx);

?>
