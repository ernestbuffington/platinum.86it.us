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
if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require_once("modules/".$module_name."/nukebb.php");
    }
    else
    {
    $phpbb_root_path = 'modules/Forums/';
}
define('IN_PHPBB', true);
define('IN_CASHMOD', true);
define('CM_POSTING', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once("includes/bbcode.php");
include_once("includes/functions_post.php");
// Log actions MOD Start
include_once("includes/functions_log.php");
// Log actions MOD End
/*****************************quick title edition************************/
include_once(INCLUDE_PATH.'includes/classes/class_attributes.'.$phpEx);
/*****************************quick title edition************************/
/*****************************************************/
/* Forum - Statistics v.2.1.0                  START */
/*****************************************************/
function top_smilies($message)
{
	global $db, $board_config;
	$sql = "SELECT code, smilies_id, smile_stat
	FROM " . SMILIES_TABLE;
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
	}
	$smile = $db->sql_fetchrowset($result);
	for ($i = 0; $i < count($smile); $i++)
	{
		if ($count_smile = preg_match_all ("/(?<=.\\W|\\W.|^\\W)" . phpbb_preg_quote($smile[$i]['code'], "/") . "(?=.\\W|\\W.|\\W$)/", ' ' . $message . ' ', $tmp_smile))
		{
			$smilie_usage = $smile[$i]['smile_stat'] + $count_smile;
			$sql = "UPDATE " . SMILIES_TABLE . "
			SET smile_stat = $smilie_usage
			WHERE smilies_id = " . $smile[$i]['smilies_id'];
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update smilies data", "", __LINE__, __FILE__, $sql);
			}
		}
	}
}
/*****************************************************/
/* Forum - Statistics v.2.1.0                    END */
/*****************************************************/

//
// Check and set various parameters
//
$params = array('submit' => 'post', 'preview' => 'preview', 'delete' => 'delete', 'poll_delete' => 'poll_delete', 'poll_add' => 'add_poll_option', 'poll_edit' => 'edit_poll_option', 'mode' => 'mode');
while( list($var, $param) = @each($params) )
{
        if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
        {
                $$var = ( !empty($_POST[$param]) ) ? $_POST[$param] : $_GET[$param];
        }
        else
        {
                $$var = '';
        }
}
$confirm = isset($_POST['confirm']) ? true : false;
$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;
$params = array('forum_id' => POST_FORUM_URL, 'topic_id' => POST_TOPIC_URL, 'post_id' => POST_POST_URL);
while( list($var, $param) = @each($params) )
{
        if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
        {
                $$var = ( !empty($_POST[$param]) ) ? intval($_POST[$param]) : intval($_GET[$param]);
        }
        else
        {
                $$var = '';
        }
}
$refresh = $preview || $poll_add || $poll_edit || $poll_delete;
//
// Set topic type
//
$topic_type = ( !empty($_POST['topictype']) ) ? intval($_POST['topictype']) : POST_NORMAL;
//
// If the mode is set to topic review then output
// that review ...
//
if ( $mode == 'topicreview' )
{
        require_once("includes/topic_review.php");
        topic_review($topic_id, false);
        exit;
}
else if ( $mode == 'smilies' )
{
        generate_smilies('window', PAGE_POSTING);
        exit;
}
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_POSTING, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD )
{
   if ( $mode == 'reply' )
   {
      $sql=" SELECT user_id, kicker FROM " . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id";
      if (!$result= $db->sql_query($sql))
      {
         message_die(GENERAL_ERROR, 'Error in getting thread kicker data', '', __LINE__, __FILE__, $sql);
      }
      $row = $db->sql_fetchrow($result);
      $tk_kicker_id=$row['kicker'];
      $tk_postid=$row['post_id'];
      if ( $row['user_id'] == $userdata['user_id'] )
      {
         $sql_a=" SELECT username FROM " . USERS_TABLE . "
         WHERE user_id='$tk_kicker_id'";
         if (!$result_a= $db->sql_query($sql_a))
         {
            message_die(GENERAL_ERROR, 'Error in getting kicker username', '', __LINE__, __FILE__, $sql_a);
         }
         $row_a = $db->sql_fetchrow($result_a);
         $kicker_username=$row_a['username'];
         include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_thread_kicker.' . $phpEx);
         $forum_redirect = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?t=$topic_id") . '">';
         $message=$lang['tk_userkicked_topic'] . '<a href="' . append_sid("privmsg.$phpEx?mode=post&u=$tk_kicker_id") . '">' . $kicker_username . '</a>' . $lang['tk_userkicked_contact'] . $forum_redirect;
         message_die(GENERAL_MESSAGE, $message);
      }
   }
}
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/
//
// Was cancel pressed? If so then redirect to the appropriate
// page, no point in continuing with any further checks
//
if ( isset($_POST['cancel']) )
{
        if ( $post_id )
        {
                $redirect = "viewtopic.$phpEx?" . POST_POST_URL . "=$post_id";
                $post_append = "#$post_id";
        }
        else if ( $topic_id )
        {
                $redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id";
                $post_append = '';
        }
        else if ( $forum_id )
        {
                $redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id";
                $post_append = '';
        }
        else
        {
                $redirect = "index.$phpEx";
                $post_append = '';
        }
        $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
        header($header_location . append_sid($redirect, true) . $post_append);
        exit;
}
//
// What auth type do we need to check?
//
$is_auth = array();
switch( $mode )
{
        case 'newtopic':
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
                if ( $topic_type == POST_GLOBAL_ANNOUNCE ) 
                {
                        $is_auth_type = 'auth_globalannounce'; 
                }
                else 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
                if ( $topic_type == POST_ANNOUNCE )
                {
                        $is_auth_type = 'auth_announce';
                }
                else if ( $topic_type == POST_STICKY )
                {
                        $is_auth_type = 'auth_sticky';
                }
                else
                {
                        $is_auth_type = 'auth_post';
                }
                break;
        case 'reply':
        case 'quote':
                $is_auth_type = 'auth_reply';
                break;
        case 'editpost':
                $is_auth_type = 'auth_edit';
                break;
        case 'delete':
        case 'poll_delete':
			if ($error_msg != '')
			{
				message_die(GENERAL_MESSAGE, $error_msg);
			}
                $is_auth_type = 'auth_delete';
                break;
        case 'vote':
                $is_auth_type = 'auth_vote';
                break;
        case 'topicreview':
                $is_auth_type = 'auth_read';
                break;
        default:
                message_die(GENERAL_MESSAGE, $lang['No_post_mode']);
                break;
}
//
// Here we do various lookups to find topic_id, forum_id, post_id etc.
// Doing it here prevents spoofing (eg. faking forum_id, topic_id or post_id
//
$error_msg = '';
$post_data = array();
switch ( $mode )
{
        case 'newtopic':
                if ( empty($forum_id) )
                {
                        message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);
                }
                $sql = "SELECT *
                        FROM " . FORUMS_TABLE . "
                        WHERE forum_id = '$forum_id'";
                break;
        case 'reply':
        case 'vote':
                if ( empty( $topic_id) )
                {
                        message_die(GENERAL_MESSAGE, $lang['No_topic_id']);
                }
                $sql = "SELECT f.*, t.topic_status, t.topic_title, t.topic_poster
                        FROM " . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t
                        WHERE t.topic_id = '$topic_id'
                                AND f.forum_id = t.forum_id";
                break;
        case 'quote':
        case 'editpost':
        case 'delete':
        case 'poll_delete':
                if ( empty($post_id) )
                {
                        message_die(GENERAL_MESSAGE, $lang['No_post_id']);
                }
/*****************************************************/
/* Forum - Disallow Edit Admin Posts v.0.0.2   START */
/*****************************************************/
		if( $userdata['user_level'] != ADMIN && ($mode == 'editpost' || $mode == 'delete' || $mode == 'poll_delete') )
		{
			$sql = "SELECT u.user_level
					FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u
					WHERE p.post_id = $post_id
						AND p.poster_id = u.user_id
						AND u.user_level = " . ADMIN;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not retrieve post information', '', __LINE__, __FILE__, $sql);
			}
			if( $row = $db->sql_fetchrow($result) )
			{
				message_die(GENERAL_MESSAGE, $lang['Not_auth_edit_delete_admin']);
			}
		}
/*****************************************************/
/* Forum - Disallow Edit Admin Posts v.0.0.2     END */
/*****************************************************/
		$temp = $submit;
		$submit = !(!$submit || ( isset($board_config['cash_disable']) && !$board_config['cash_disable'] && (($mode == 'editpost') || ($mode == 'delete'))));
                $select_sql = ( !$submit ) ? ", t.topic_title, p.enable_bbcode, p.enable_html, p.enable_smilies, p.enable_sig, p.post_username, pt.post_subject, pt.post_text, pt.bbcode_uid, u.username, u.user_id, u.user_sig" : '';
                $from_sql = ( !$submit ) ? ", " . POSTS_TEXT_TABLE . " pt, " . USERS_TABLE . " u" : '';
                $where_sql = ( !$submit ) ? "AND pt.post_id = p.post_id AND u.user_id = p.poster_id" : '';
		$submit = $temp;
		unset($temp);
                $sql = "SELECT f.*, t.topic_id, t.topic_status, t.topic_type, t.topic_first_post_id, t.topic_last_post_id, t.topic_vote, p.post_id, p.poster_id" . $select_sql . "
                        FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $from_sql . "
                        WHERE p.post_id = '$post_id'
                                AND t.topic_id = p.topic_id
                                AND f.forum_id = p.forum_id
                                $where_sql";
/*****************************quick title edition************************/
		$sql = str_replace('SELECT ', 'SELECT t.topic_attribute, ', $sql);
/*****************************quick title edition************************/	
                break;
        default:
                message_die(GENERAL_MESSAGE, $lang['No_valid_mode']);
}

if ( ($result = $db->sql_query($sql)) && ($post_info = $db->sql_fetchrow($result)) )
{
	$db->sql_freeresult($result);
	
        $forum_id = $post_info['forum_id'];
        $forum_name = $post_info['forum_name'];
        $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $post_info);
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1       START */
/*****************************************************/
	$lock = ( isset($_POST['lock']) ) ? TRUE : FALSE;
	$unlock = ( isset($_POST['unlock']) ) ? TRUE : FALSE;
	if ( ($submit || $confirm) && ($lock || $unlock) && ($is_auth['auth_mod']) && ($mode != 'newtopic') && (!$refresh) )
	{
		$t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];
		if ( $unlock ) 
		{
			$sql = "UPDATE " . TOPICS_TABLE . " 
			SET topic_status = " . TOPIC_UNLOCKED . " 
			WHERE topic_id = " . $t_id . " 
			AND topic_moved_id = 0";
		}
		else if ($lock)
		{
			$sql = "UPDATE " . TOPICS_TABLE . " 
			SET topic_status = " . TOPIC_LOCKED . " 
			WHERE topic_id = " . $t_id . " 
			AND topic_moved_id = 0";
		}
		if ($lock || $unlock)
		{
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
			}
		}
	}
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1         END */
/*****************************************************/
        if ( $post_info['forum_status'] == FORUM_LOCKED && !$is_auth['auth_mod'])
        {
           message_die(GENERAL_MESSAGE, $lang['Forum_locked']);
        }
        else if ( $mode != 'newtopic' && $post_info['topic_status'] == TOPIC_LOCKED && !$is_auth['auth_mod'])
        {
           message_die(GENERAL_MESSAGE, $lang['Topic_locked']);
        }
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD )
{
   if ( $mode == 'quote' || $mode == 'editpost' )
   {
      $topic_id = $post_info['topic_id'];
      $sql=" SELECT user_id, kicker FROM " . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id AND user_id=" . $userdata['user_id'];
      if (!$result= $db->sql_query($sql))
      {
         message_die(GENERAL_ERROR, 'Error in getting thread kicker data', '', __LINE__, __FILE__, $sql);
      }
      $row = $db->sql_fetchrow($result);
      $tk_kicker_id=$row['kicker'];
      if ( $row['user_id'] == $userdata['user_id'] )
      {
         $sql_a=" SELECT username FROM " . USERS_TABLE . "
         WHERE user_id='$tk_kicker_id'";
         if (!$result_a= $db->sql_query($sql_a))
         {
            message_die(GENERAL_ERROR, 'Error in getting kicker username', '', __LINE__, __FILE__, $sql_a);
         }
         $row_a = $db->sql_fetchrow($result_a);
         $kicker_username=$row_a['username'];
         include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_thread_kicker.' . $phpEx);
         $forum_redirect = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?t=$topic_id") . '">';
         $message=$lang['tk_userkicked_topic'] . '<a href="' . append_sid("privmsg.$phpEx?mode=post&u=$tk_kicker_id") . '">' . $kicker_username . '</a>' . $lang['tk_userkicked_contact'] . $forum_redirect;
         message_die(GENERAL_MESSAGE, $message);
      }
   }
}
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/
        if ( $mode == 'editpost' || $mode == 'delete' || $mode == 'poll_delete' )
        {
                $topic_id = $post_info['topic_id'];
		$post_data['post_text'] = ( ($mode == 'editpost') || ($mode == 'delete') ) ? $post_info['post_text'] : '';
		$post_data['bbcode_uid'] = ( ($mode == 'editpost') || ($mode == 'delete') ) ? $post_info['bbcode_uid'] : '';
                $post_data['poster_post'] = ( $post_info['poster_id'] == $userdata['user_id'] ) ? true : false;
                $post_data['first_post'] = ( $post_info['topic_first_post_id'] == $post_id ) ? true : false;
                $post_data['last_post'] = ( $post_info['topic_last_post_id'] == $post_id ) ? true : false;
                $post_data['last_topic'] = ( $post_info['forum_last_post_id'] == $post_id ) ? true : false;
                $post_data['has_poll'] = ( $post_info['topic_vote'] ) ? true : false;
                $post_data['topic_type'] = $post_info['topic_type'];
                $post_data['poster_id'] = $post_info['poster_id'];
                if ( $post_data['first_post'] && $post_data['has_poll'] )
                {
                        $sql = "SELECT *
                                FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
                                WHERE vd.topic_id = '$topic_id'
                                        AND vr.vote_id = vd.vote_id
                                ORDER BY vr.vote_option_id";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);
                        }
			$db->sql_freeresult($result);
                        $poll_options = array();
                        $poll_results_sum = 0;
                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                $poll_title = $row['vote_text'];
                                $poll_id = $row['vote_id'];
                                $poll_length = $row['vote_length'] / 86400;
                                do
                                {
                                        $poll_options[$row['vote_option_id']] = $row['vote_option_text'];
                                        $poll_results_sum += $row['vote_result'];
                                }
                                while ( $row = $db->sql_fetchrow($result) );
                        }
			$db->sql_freeresult($result);
                        $post_data['edit_poll'] = ( ( !$poll_results_sum || $is_auth['auth_mod'] ) && $post_data['first_post'] ) ? true : 0;
                }
                else
                {
                        $post_data['edit_poll'] = ($post_data['first_post'] && $is_auth['auth_pollcreate']) ? true : false;
                }
                //
                // Can this user edit/delete the post/poll?
                //
                if ( $post_info['poster_id'] != $userdata['user_id'] && !$is_auth['auth_mod'] )
                {
                        $message = ( $delete || $mode == 'delete' ) ? $lang['Delete_own_posts'] : $lang['Edit_own_posts'];
                        $message .= '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
                        message_die(GENERAL_MESSAGE, $message);
                }
                else if ( !$post_data['last_post'] && !$is_auth['auth_mod'] && ( $mode == 'delete' || $delete ) )
                {
                        message_die(GENERAL_MESSAGE, $lang['Cannot_delete_replied']);
                }
                else if ( !$post_data['edit_poll'] && !$is_auth['auth_mod'] && ( $mode == 'poll_delete' || $poll_delete ) )
                {
                        message_die(GENERAL_MESSAGE, $lang['Cannot_delete_poll']);
                }
        }
        else
        {
                if ( $mode == 'quote' )
                {
                        $topic_id = $post_info['topic_id'];
                }
                $post_data['topic_poster'] = ( $mode == 'reply' ) ? $post_info['topic_poster'] : 0;
                $post_data['first_post'] = ( $mode == 'newtopic' ) ? true : 0;
                $post_data['last_post'] = false;
                $post_data['has_poll'] = false;
                $post_data['edit_poll'] = false;
        }
}
else
{
        message_die(GENERAL_MESSAGE, $lang['No_such_post']);
}
//
// The user is not authed, if they're not logged in then redirect
// them, else show them an error message
//
if ( !$is_auth[$is_auth_type] )
{
        if ( $userdata['session_logged_in'] )
        {
                message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $is_auth_type], $is_auth[$is_auth_type . "_type"]));
        }
        switch( $mode )
        {
                case 'newtopic':
                        $redirect = "mode=newtopic&" . POST_FORUM_URL . "=" . $forum_id;
                        break;
                case 'reply':
                case 'topicreview':
                        $redirect = "mode=reply&" . POST_TOPIC_URL . "=" . $topic_id;
                        break;
                case 'quote':
                case 'editpost':
                        $redirect = "mode=quote&" . POST_POST_URL ."=" . $post_id;
                        break;
        }
        $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
        header($header_location . append_sid("login.$phpEx?redirect=posting.$phpEx&" . $redirect, true));
        exit;
}
//
// Set toggles for various options
//
if ( !$board_config['allow_html'] )
{
        $html_on = 0;
}
else
{
        $html_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}
if ( !$board_config['allow_bbcode'] )
{
        $bbcode_on = 0;
}
else
{
        $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}
if ( !$board_config['allow_smilies'] )
{
        $smilies_on = 0;
}
else
{
        $smilies_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}
if ( ($submit || $refresh) && $is_auth['auth_read'])
{
        $notify_user = ( !empty($_POST['notify']) ) ? TRUE : 0;
}
else
{
        if ( $mode != 'newtopic' && $userdata['session_logged_in'] && $is_auth['auth_read'] )
        {
                $sql = "SELECT topic_id
                        FROM " . TOPICS_WATCH_TABLE . "
                        WHERE topic_id = '$topic_id'
                                AND user_id = " . $userdata['user_id'];
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
                }
                $notify_user = ( $db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];
		$db->sql_freeresult($result);
        }
        else
        {
                $notify_user = ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
        }
}
$attach_sig = ( $submit || $refresh ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );
execute_posting_attachment_handling();
// --------------------
//  What shall we do?
//
if ( ( $delete || $poll_delete || $mode == 'delete' ) && !$confirm )
{
        //
        // Confirm deletion
        //
        $s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
        $s_hidden_fields .= ( $delete || $mode == "delete" ) ? '<input type="hidden" name="mode" value="delete" />' : '<input type="hidden" name="mode" value="poll_delete" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        $l_confirm = ( $delete || $mode == 'delete' ) ? $lang['Confirm_delete'] : $lang['Confirm_delete_poll'];
        //
        // Output confirmation page
        //
        include_once("includes/page_header.php");
        $template->set_filenames(array(
                'confirm_body' => 'confirm_body.tpl')
        );
        $template->assign_vars(array(
                'MESSAGE_TITLE' => $lang['Information'],
                'MESSAGE_TEXT' => $l_confirm,
                'L_YES' => $lang['Yes'],
                'L_NO' => $lang['No'],
                'S_CONFIRM_ACTION' => append_sid("posting.$phpEx"),
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );
        $template->pparse('confirm_body');
        include_once("includes/page_tail.php");
}
else if ( $mode == 'vote' )
{
        //
        // Vote in a poll
        //
        if ( !empty($_POST['vote_id']) )
        {
                $vote_option_id = intval($_POST['vote_id']);
                $sql = "SELECT vd.vote_id
                        FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
                        WHERE vd.topic_id = '$topic_id'
                                AND vr.vote_id = vd.vote_id
                                AND vr.vote_option_id = '$vote_option_id'
                        GROUP BY vd.vote_id";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);
                }
                if ( $vote_info = $db->sql_fetchrow($result) )
                {
                        $vote_id = $vote_info['vote_id'];
                        $sql = "SELECT *
                                FROM " . VOTE_USERS_TABLE . "
                                WHERE vote_id = '$vote_id'
                                        AND vote_user_id = " . $userdata['user_id'];
			if ( !($result2 = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);
                        }
                        if ( !($row = $db->sql_fetchrow($result)) )
                        {
                                $sql = "UPDATE " . VOTE_RESULTS_TABLE . "
                                        SET vote_result = vote_result + 1
                                        WHERE vote_id = '$vote_id'
                                                AND vote_option_id = '$vote_option_id'";
                                if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not update poll result', '', __LINE__, __FILE__, $sql);
                                }
/*****************************************************/
/* Forum - Admin Voting 1.1.8                  START */
/*****************************************************/
                                $sql = "INSERT INTO " . VOTE_USERS_TABLE . " (vote_id, vote_user_id, vote_user_ip, vote_cast)
                                        VALUES ('$vote_id', " . $userdata['user_id'] . ", '$user_ip', '$vote_option_id')";
/*****************************************************/
/* Forum - Admin Voting 1.1.8                    END */
/*****************************************************/
                                if ( !$db->sql_query($sql, END_TRANSACTION) )
                                {
                                        message_die(GENERAL_ERROR, "Could not insert user_id for poll", "", __LINE__, __FILE__, $sql);
                                }
                                $message = $lang['Vote_cast'];
                        }
                        else
                        {
                                $message = $lang['Already_voted'];
                        }
			$db->sql_freeresult($result2);
                }
                else
                {
                        $message = $lang['No_vote_option'];
                }
		$db->sql_freeresult($result);
                $template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')
                );
                $message .=  '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
        }
        else
        {
                redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
        }
}
else if ( $submit || $confirm )
{
        //
        // Submit post/vote (newtopic, edit, reply, etc.)
        //
        $return_message = '';
        $return_meta = '';
/*	// session id check
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Session_invalid'] : $lang['Session_invalid'];
	}*/
        switch ( $mode )
        {
                case 'editpost':
// Log Actions Start
                    $username = ( !empty($_POST['username']) ) ? $_POST['username'] : '';
                    $subject = ( !empty($_POST['subject']) ) ? trim($_POST['subject']) : '';
                    $message = ( !empty($_POST['message']) ) ? $_POST['message'] : '';
                    $poll_title = ( isset($_POST['poll_title']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_title'] : '';
                    $poll_options = ( isset($_POST['poll_option_text']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_option_text'] : '';
                    $poll_length = ( isset($_POST['poll_length']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_length'] : '';
/*****************************quick title edition************************/
			$attribute_id = request_var('attribute_id', TYPE_INT);
/*****************************quick title edition************************/					
                    $bbcode_uid = '';
                    prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length);
                    if ( $error_msg == '' )
                    {
	            $topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce'] ) ? $post_data['topic_type'] : $topic_type;
$username2 = str_replace("\'", "''", $username); 
$subject2 = str_replace("\'", "''", $subject); 
$message2 = str_replace("\'", "''", $message); 
$poll_title2 = str_replace("\'", "''", $poll_title); 
//-- mod : quick title edition -------------------------------------------------
// here we added
//	, $attribute_id
//-- modify
submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, $username2, $subject2, $message2, $poll_title2, $poll_options, $poll_length, $attribute_id);
// Log actions MOD Start
	           if ( $is_auth['auth_mod'] )
	           {
		   log_action('edit', $topic_id, $userdata['user_id'], $userdata['username']);
	           }
// Log actions MOD End
                   }
                   break;
// Log Action End
                case 'newtopic':
                case 'reply':
                        $username = ( !empty($_POST['username']) ) ? $_POST['username'] : '';
                        $subject = ( !empty($_POST['subject']) ) ? trim($_POST['subject']) : '';
                        $message = ( !empty($_POST['message']) ) ? $_POST['message'] : '';
	/*****************************quick title edition************************/
	$topic_attribute = request_var('attribute_id', TYPE_INT);
/*****************************quick title edition************************/					
                        $poll_title = ( isset($_POST['poll_title']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_title'] : '';
                        $poll_options = ( isset($_POST['poll_option_text']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_option_text'] : '';
                        $poll_length = ( isset($_POST['poll_length']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_length'] : '';
                        $bbcode_uid = '';
                        prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length);
                        if ( $error_msg == '' )
                        {
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
                                $topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce']  && !$is_auth['auth_globalannounce'] ) ? $post_data['topic_type'] : $topic_type;
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
$username2 = str_replace("\'", "''", $username); 
$subject2 = str_replace("\'", "''", $subject); 
$message2 = str_replace("\'", "''", $message); 
$poll_title2 = str_replace("\'", "''", $poll_title);
submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, $username2, $subject2, $message2, $poll_title2, $poll_options, $poll_length, $attribute_id);
                        }
                        break;
                case 'delete':
                case 'poll_delete':
// Log actions MOD Start
                        if ( $is_auth['auth_mod'] )
                        {
	                log_action('delete', $topic_id, $userdata['user_id'], $userdata['username']);
                        }
// Log actions MOD End
                        delete_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id);
                        break;
        }
        if ( $error_msg == '' )
        {
                if ( $mode != 'editpost' )
                {
                        $user_id = ( $mode == 'reply' || $mode == 'newtopic' ) ? $userdata['user_id'] : $post_data['poster_id'];
                        update_post_stats($mode, $post_data, $forum_id, $topic_id, $post_id, $user_id);
						top_smilies($message);
                }
                        $attachment_mod['posting']->insert_attachment($post_id);
                if ($error_msg == '' && $mode != 'poll_delete')
                {
/*****************************************************/
/* Forum - Topic Notify Posted Message v.1.0.1 START */
/*****************************************************/
			// forum notification mod
			$post_data['subject'] = $subject;
			$post_data['username'] = ( $userdata['user_id'] == ANONYMOUS ) ? $username : $userdata['username'];
			$post_data['message'] = $message;
			if ( $post_data['first_post'] )
			{
				// fetch topic title
				$sql = "SELECT topic_title, topic_id 
					FROM " . TOPICS_TABLE . " 
					WHERE topic_id = $topic_id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain topic title for notification', '', __LINE__, __FILE__, $sql);
				}
				if ( $topic_info = $db->sql_fetchrow($result) )
				{
					user_notification('newtopic', $post_data, $topic_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
				}
			}
			else
			{
			// forum notification mod
			$post_data['subject'] = $subject;
			$post_data['username'] = ( $userdata['user_id'] == ANONYMOUS ) ? $username : $userdata['username'];
			$post_data['message'] = $message;
			if ( $post_data['first_post'] )
			{
				// fetch topic title
				$sql = "SELECT topic_title, topic_id 
					FROM " . TOPICS_TABLE . " 
					WHERE topic_id = $topic_id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain topic title for notification', '', __LINE__, __FILE__, $sql);
				}
				if ( $topic_info = $db->sql_fetchrow($result) )
				{
					user_notification('newtopic', $post_data, $topic_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
				}
			}
			else
			{
				user_notification($mode, $post_data, $post_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
			}
			}
/*****************************************************/
/* Forum - Topic Notify Posted Message v.1.0.1   END */
/*****************************************************/
                }
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1       START */
/*****************************************************/
			if ( ( $error_msg == '' ) && ( $lock ) && ( $mode == 'newtopic' ) )
			{
				$sql = "UPDATE " . TOPICS_TABLE . " 
				SET topic_status = " . TOPIC_LOCKED . " 
				WHERE topic_id = " . $topic_id . " 
				AND topic_moved_id = 0";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
				}
			}
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1         END */
/*****************************************************/
                if ( $mode == 'newtopic' || $mode == 'reply' )
                {
                        $tracking_topics = ( !empty($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();
                        $tracking_forums = ( !empty($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();
                        if ( count($tracking_topics) + count($tracking_forums) == 100 && empty($tracking_topics[$topic_id]) )
                        {
                                asort($tracking_topics);
                                unset($tracking_topics[key($tracking_topics)]);
                        }
                        $tracking_topics[$topic_id] = time();
                        setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
                }
                $template->assign_vars(array(
                        'META' => $return_meta)
                );
                message_die(GENERAL_MESSAGE, $return_message);
        }
}
if( $refresh || isset($_POST['del_poll_option']) || $error_msg != '' )
{
        $username = ( !empty($_POST['username']) ) ? htmlspecialchars(trim(stripslashes($_POST['username']))) : '';
        $subject = ( !empty($_POST['subject']) ) ? htmlspecialchars(trim(stripslashes($_POST['subject']))) : '';
        $message = ( !empty($_POST['message']) ) ? htmlspecialchars(trim(stripslashes($_POST['message']))) : '';
        $poll_title = ( !empty($_POST['poll_title']) ) ? htmlspecialchars(trim(stripslashes($_POST['poll_title']))) : '';
        $poll_length = ( isset($_POST['poll_length']) ) ? max(0, intval($_POST['poll_length'])) : 0;
        $poll_options = array();
        if ( !empty($_POST['poll_option_text']) )
        {
                while( list($option_id, $option_text) = @each($_POST['poll_option_text']) )
                {
                        if( isset($_POST['del_poll_option'][$option_id]) )
                        {
                                unset($poll_options[$option_id]);
                        }
                        else if ( !empty($option_text) )
                        {
                                $poll_options[intval($option_id)] = htmlspecialchars(trim(stripslashes($option_text)));
                        }
                }
        }
        if ( isset($poll_add) && !empty($_POST['add_poll_option_text']) )
        {
                $poll_options[] = htmlspecialchars(trim(stripslashes($_POST['add_poll_option_text'])));
        }
        if ( $mode == 'newtopic' || $mode == 'reply')
        {
                $user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
        }
        else if ( $mode == 'editpost' )
        {
                $user_sig = ( $post_info['user_sig'] != '' && $board_config['allow_sig'] ) ? $post_info['user_sig'] : '';
        }
        if( $preview )
        {
                $orig_word = array();
                $replacement_word = array();
                obtain_word_list($orig_word, $replacement_word);
                $bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
                $preview_message = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
                $preview_subject = $subject;
                $preview_username = $username;
                //
                // Finalise processing as per viewtopic
                //
                if( !$html_on )
                {
                        if( $user_sig != '' || !$userdata['user_allowhtml'] )
                        {
                                $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $user_sig);
                        }
                }
		$valid = FALSE;
		if( $userdata['session_logged_in'] ) {
		$sql = "SELECT p.poster_id, p.topic_id
		FROM " . POSTS_TABLE . " p
		WHERE p.topic_id = $topic_id
		AND p.poster_id = " . $userdata['user_id'];
		$resultat = $db->sql_query($sql);
		$valid = $db->sql_numrows($resultat) ? TRUE : FALSE;}
		if( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] )
		{
				$user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
				$user_sig = bbencode_third_pass($user_sig, $userdata['user_sig_bbcode_uid'], $valid);
		}
		if( $bbcode_on )
		{
				$preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
				$preview_message = bbencode_third_pass($preview_message, $bbcode_uid, $valid);
		}
                if( !empty($orig_word) )
                {
                        $preview_username = ( !empty($username) ) ? preg_replace($orig_word, $replacement_word, $preview_username) : '';
                        $preview_subject = ( !empty($subject) ) ? preg_replace($orig_word, $replacement_word, $preview_subject) : '';
                        $preview_message = ( !empty($preview_message) ) ? preg_replace($orig_word, $replacement_word, $preview_message) : '';
                }
                if( $user_sig != '' )
                {
                        $user_sig = make_clickable($user_sig);
                }
                $preview_message = make_clickable($preview_message);
                if( $smilies_on )
                {
                        if( $userdata['user_allowsmile'] && $user_sig != '' )
                        {
                                $user_sig = smilies_pass($user_sig);
                        }
                        $preview_message = smilies_pass($preview_message);
                }
                if( $attach_sig && $user_sig != '' )
                {
                        $preview_message = $preview_message . '<br /><br />_________________<br />' . $user_sig;
                }
                $preview_message = str_replace("\n", '<br />', $preview_message);
/*****************************************************/
/* Forum - Force Word Wrapping v.1.0.12        START */
/*****************************************************/
                $preview_message = word_wrap_pass($preview_message);
/*****************************************************/
/* Forum - Force Word Wrapping v.1.0.12          END */
/*****************************************************/
                $template->set_filenames(array(
                        'preview' => 'posting_preview.tpl')
                );
                $attachment_mod['posting']->preview_attachments();
/*****************************quick title edition************************/
/*-MOD
		$template->assign_vars(array(
			'TOPIC_TITLE' => $preview_subject,
MOD-*/
		$attribute = ($topic_attribute . ',' . $userdata['user_id'] . ',' . time());

		$template->assign_vars(array(
			'TOPIC_TITLE' => $qte->attr($preview_subject, $attribute),
/*****************************quick title edition************************/
                        'POST_SUBJECT' => $preview_subject,
                        'POSTER_NAME' => $preview_username,
                        'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
                        'MESSAGE' => $preview_message,
                        'L_POST_SUBJECT' => $lang['Post_subject'],
                        'L_PREVIEW' => $lang['Preview'],
                        'L_POSTED' => $lang['Posted'],
                        'L_POST' => $lang['Post'])
                );
                $template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
        }
        else if( $error_msg != '' )
        {
                $template->set_filenames(array(
                        'reg_header' => 'error_body.tpl')
                );
                $template->assign_vars(array(
                        'ERROR_MESSAGE' => $error_msg)
                );
                $template->assign_var_from_handle('ERROR_BOX', 'reg_header');
        }
}
else
{
        //
        // User default entry point
        //
        if ( $mode == 'newtopic' )
        {
                $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';
                $username = ($userdata['session_logged_in']) ? $userdata['username'] : '';
                $poll_title = '';
                $poll_length = '';
                $subject = '';
                $message = '';
        }
        else if ( $mode == 'reply' )
        {
                $user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';
                $username = ( $userdata['session_logged_in'] ) ? $userdata['username'] : '';
                $subject = '';
                $message = '';
        }
        else if ( $mode == 'quote' || $mode == 'editpost' )
        {
                $subject = ( $post_data['first_post'] ) ? $post_info['topic_title'] : $post_info['post_subject'];
                $message = $post_info['post_text'];
                if ( $mode == 'editpost' )
                {
                        $attach_sig = ( $post_info['enable_sig'] && $post_info['user_sig'] != '' ) ? TRUE : 0;
                        $user_sig = $post_info['user_sig'];
                        $html_on = ( $post_info['enable_html'] ) ? true : false;
                        $bbcode_on = ( $post_info['enable_bbcode'] ) ? true : false;
                        $smilies_on = ( $post_info['enable_smilies'] ) ? true : false;
                }
                else
                {
                        $attach_sig = ( $userdata['user_attachsig'] ) ? TRUE : 0;
                        $user_sig = $userdata['user_sig'];
                }
                if ( $post_info['bbcode_uid'] != '' )
                {
                        $message = preg_replace('/\:(([a-z0-9]:)?)' . $post_info['bbcode_uid'] . '/s', '', $message);
                }
                $message = str_replace('<', '&lt;', $message);
                $message = str_replace('>', '&gt;', $message);
                $message = str_replace('<br />', "\n", $message);
                if ( $mode == 'quote' )
                {
                        $orig_word = array();
                        $replacement_word = array();
                        obtain_word_list($orig_word, $replace_word);
                        $msg_date =  create_date($board_config['default_dateformat'], $postrow['post_time'], $board_config['board_timezone']);
                        // Use trim to get rid of spaces placed there by MS-SQL 2000
                        $quote_username = ( trim($post_info['post_username']) != '' ) ? $post_info['post_username'] : $post_info['username'];
                        $message = '[quote="' . $quote_username . '"]' . $message . '[/quote]';
                        if ( !empty($orig_word) )
                        {
                                $subject = ( !empty($subject) ) ? preg_replace($orig_word, $replace_word, $subject) : '';
                                $message = ( !empty($message) ) ? preg_replace($orig_word, $replace_word, $message) : '';
                        }
                        if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0 )
                        {
                                $subject = 'Re: ' . $subject;
                        }
			if( !$userdata['session_logged_in'] ) {$message = hide_in_quote($message);}
			else { $sql = "SELECT p.poster_id, p.topic_id
			FROM " . POSTS_TABLE . " p
			WHERE p.topic_id = $topic_id
			AND p.poster_id = " . $userdata['user_id'];
			$resultat = $db->sql_query($sql);
			if(!$db->sql_numrows($resultat)) {$message = hide_in_quote($message);}
			}
                        $mode = 'reply';
                }
                else
                {
                        $username = ( $post_info['user_id'] == ANONYMOUS && !empty($post_info['post_username']) ) ? $post_info['post_username'] : '';
                }
        }
}
//
// Signature toggle selection
//
if( $user_sig != '' )
{
        $template->assign_block_vars('switch_signature_checkbox', array());
}
//
// HTML toggle selection
//
if ( $board_config['allow_html'] )
{
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_html_checkbox', array());
}
else
{
        $html_status = $lang['HTML_is_OFF'];
}
//
// BBCode toggle selection
//
if ( $board_config['allow_bbcode'] )
{
        $bbcode_status = $lang['BBCode_is_ON'];
        $template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
        $bbcode_status = $lang['BBCode_is_OFF'];
}
//
// Smilies toggle selection
//
if ( $board_config['allow_smilies'] )
{
        $smilies_status = $lang['Smilies_are_ON'];
        $template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
        $smilies_status = $lang['Smilies_are_OFF'];
}
if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
        $template->assign_block_vars('switch_username_select', array());
}
//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
{
        if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
        {
                $template->assign_block_vars('switch_notify_checkbox', array());
        }
}
//
// Delete selection
//
if ( $mode == 'editpost' && ( ( $is_auth['auth_delete'] && $post_data['last_post'] && ( !$post_data['has_poll'] || $post_data['edit_poll'] ) ) || $is_auth['auth_mod'] ) )
{
        $template->assign_block_vars('switch_delete_checkbox', array());
}
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1       START */
/*****************************************************/
if ( ( $mode == 'editpost' || $mode == 'reply' || $mode == 'quote' || $mode == 'newtopic' ) && ( $is_auth['auth_mod'] ) )
{
	if ( $post_info['topic_status'] == TOPIC_LOCKED )
	{
		$template->assign_block_vars('switch_unlock_topic', array());
		$template->assign_vars(array(
			'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
			'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '')
		);
	}
	else if ( $post_info['topic_status'] == TOPIC_UNLOCKED )
	{
		$template->assign_block_vars('switch_lock_topic', array());
		$template->assign_vars(array(
			'L_LOCK_TOPIC' => $lang['Lock_topic'],
			'S_LOCK_CHECKED' => ( $lock ) ? 'checked="checked"' : '')
		);
	}
}
/*****************************************************/
/* Forum - Topic Lock After Post v.1.0.1         END */
/*****************************************************/
//
// Topic type selection
//
$topic_type_toggle = '';
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) )
{
        $template->assign_block_vars('switch_type_toggle', array());
        if( $is_auth['auth_sticky'] )
        {
                $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_STICKY . '"';
                if ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY )
                {
                        $topic_type_toggle .= ' checked="checked"';
                }
                $topic_type_toggle .= ' /> ' . $lang['Post_Sticky'] . '&nbsp;&nbsp;';
        }
        if( $is_auth['auth_announce'] )
        {
                $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_ANNOUNCE . '"';
                if ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE )
                {
                        $topic_type_toggle .= ' checked="checked"';
                }
                $topic_type_toggle .= ' /> ' . $lang['Post_Announcement'] . '&nbsp;&nbsp;';
        }
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
        if( $is_auth['auth_globalannounce'] ) 
        { 
              $topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_GLOBAL_ANNOUNCE . '"'; 
              if ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE ) 
              { 
                        $topic_type_toggle .= ' checked="checked"'; 
              } 
   $topic_type_toggle .= ' /> ' . $lang['Post_global_announcement'] . '&nbsp;&nbsp;'; 
        } 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
        if ( $topic_type_toggle != '' )
        {
                $topic_type_toggle = $lang['Post_topic_as'] . ': <input type="radio" name="topictype" value="' . POST_NORMAL .'"' . ( ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' checked="checked"' : '' ) . ' /> ' . $lang['Post_Normal'] . '&nbsp;&nbsp;' . $topic_type_toggle;
        }
}
/*****************************quick title edition************************/
if ( $userdata['session_logged_in'] && $post_data['first_post'] )
{
	if ( $mode == 'newtopic' || $mode == 'editpost' )
	{
		$get->assign_switch('switch_attribute', true);
	}
}
/*****************************quick title edition************************/
$hidden_form_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
switch( $mode )
{
        case 'newtopic':
                $page_title = $lang['Post_a_new_topic'];
                $hidden_form_fields .= '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
                break;
        case 'reply':
                $page_title = $lang['Post_a_reply'];
                $hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
                break;
        case 'editpost':
                $page_title = $lang['Edit_Post'];
                $hidden_form_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
                break;
}
// Generate smilies listing for page output
generate_smilies('inline', PAGE_POSTING);
//
// Include page header
//
include_once("includes/page_header.php");
$template->set_filenames(array(
        'body' => 'posting_body.tpl',
        'pollbody' => 'posting_poll_body.tpl',
        'reviewbody' => 'posting_topic_review.tpl')
);
if ($post_info[attached_forum_id]>0)
{
	$parent_lookup=$post_info[attached_forum_id];
}
make_jumpbox('viewforum.'.$phpEx);
$template->assign_vars(array(
        'FORUM_NAME' => $forum_name,
        'L_POST_A' => $page_title,
        'L_POST_SUBJECT' => $lang['Post_subject'],
        'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
);
//
// This enables the forum/topic title to be output for posting
// but not for privmsg (where it makes no sense)
//
$template->assign_block_vars('switch_not_privmsg', array());
//
// Output the data to the template
//
$template->assign_vars(array(
        'USERNAME' => $username,
        'SUBJECT' => $subject,
        'MESSAGE' => $message,
        'HTML_STATUS' => $html_status,
        'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
        'SMILIES_STATUS' => $smilies_status,
        'BB_BG' => $images['bbcode_bg'],
        'L_SUBJECT' => $lang['Subject'],
        'L_MESSAGE_BODY' => $lang['Message_body'],
        'L_OPTIONS' => $lang['Options'],
        'L_PREVIEW' => $lang['Preview'],
        'L_SPELLCHECK' => $lang['Spellcheck'],
        'L_SUBMIT' => $lang['Submit'],
        'L_CANCEL' => $lang['Cancel'],
        'L_CONFIRM_DELETE' => $lang['Confirm_delete'],
        'L_DISABLE_HTML' => $lang['Disable_HTML_post'],
        'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'],
        'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
        'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],
        'L_NOTIFY_ON_REPLY' => $lang['Notify'],
        'L_DELETE_POST' => $lang['Delete_post'],
        'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
        'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
        'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
        'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
        'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
        'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
        'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
        'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
        'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
        'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
        'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
        'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
        'L_EMPTY_MESSAGE' => $lang['Empty_message'],
        'L_FONT_COLOR' => $lang['Font_color'],
        'L_COLOR_DEFAULT' => $lang['color_default'],
        'L_COLOR_DARK_RED' => $lang['color_dark_red'],
        'L_COLOR_RED' => $lang['color_red'],
        'L_COLOR_ORANGE' => $lang['color_orange'],
        'L_COLOR_BROWN' => $lang['color_brown'],
        'L_COLOR_YELLOW' => $lang['color_yellow'],
        'L_COLOR_GREEN' => $lang['color_green'],
        'L_COLOR_OLIVE' => $lang['color_olive'],
        'L_COLOR_CYAN' => $lang['color_cyan'],
        'L_COLOR_BLUE' => $lang['color_blue'],
        'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
        'L_COLOR_INDIGO' => $lang['color_indigo'],
        'L_COLOR_VIOLET' => $lang['color_violet'],
        'L_COLOR_WHITE' => $lang['color_white'],
        'L_COLOR_BLACK' => $lang['color_black'],
        'L_FONT_SIZE' => $lang['Font_size'],
        'L_FONT_TINY' => $lang['font_tiny'],
        'L_FONT_SMALL' => $lang['font_small'],
        'L_FONT_NORMAL' => $lang['font_normal'],
        'L_FONT_LARGE' => $lang['font_large'],
        'L_FONT_HUGE' => $lang['font_huge'],
        'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
        'L_STYLES_TIP' => $lang['Styles_tip'],
/*****************************quick title edition************************/
	'L_ATTRIBUTE' => $lang['Attribute'],
	'S_ATTRIBUTE_SELECTOR' => $qte->combo(isset($topic_attribute) ? $topic_attribute : $post_info['topic_attribute'] . ',' . $user_id, $userdata['user_id']),
/*****************************quick title edition************************/		
        'U_VIEWTOPIC' => ( $mode == 'reply' ) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postorder=desc") : '',
        'U_REVIEW_TOPIC' => ( $mode == 'reply' ) ? append_sid("posting.$phpEx?mode=topicreview&amp;" . POST_TOPIC_URL . "=$topic_id&popup=1") : '',
        'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
        'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
        'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
        'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
        'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '',
        'S_TYPE_TOGGLE' => $topic_type_toggle,
        'S_TOPIC_ID' => $topic_id,
        'S_POST_ACTION' => append_sid("posting.$phpEx"),
        'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);
//
// Poll entry switch/output
//
if( ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['edit_poll']) ) && $is_auth['auth_pollcreate'] )
{
        $template->assign_vars(array(
                'L_ADD_A_POLL' => $lang['Add_poll'],
                'L_ADD_POLL_EXPLAIN' => $lang['Add_poll_explain'],
                'L_POLL_QUESTION' => $lang['Poll_question'],
                'L_POLL_OPTION' => $lang['Poll_option'],
                'L_ADD_OPTION' => $lang['Add_option'],
                'L_UPDATE_OPTION' => $lang['Update'],
                'L_DELETE_OPTION' => $lang['Delete'],
                'L_POLL_LENGTH' => $lang['Poll_for'],
                'L_DAYS' => $lang['Days'],
                'L_POLL_LENGTH_EXPLAIN' => $lang['Poll_for_explain'],
                'L_POLL_DELETE' => $lang['Delete_poll'],
                'POLL_TITLE' => $poll_title,
                'POLL_LENGTH' => $poll_length)
        );
        if( $mode == 'editpost' && $post_data['edit_poll'] && $post_data['has_poll'])
        {
                $template->assign_block_vars('switch_poll_delete_toggle', array());
        }
        if( !empty($poll_options) )
        {
                while( list($option_id, $option_text) = each($poll_options) )
                {
                        $template->assign_block_vars('poll_option_rows', array(
                                'POLL_OPTION' => str_replace('"', '&quot;', $option_text),
                                'S_POLL_OPTION_NUM' => $option_id)
                        );
                }
        }
        $template->assign_var_from_handle('POLLBOX', 'pollbody');
}
//
// Topic review
//
if( $mode == 'reply' && $is_auth['auth_read'] )
{
        require_once("includes/topic_review.php");
        topic_review($topic_id, true);
        $template->assign_block_vars('switch_inline_mode', array());
        $template->assign_var_from_handle('TOPIC_REVIEW_BOX', 'reviewbody');
}
$template->pparse('body');
include_once("includes/page_tail.php");
?>
