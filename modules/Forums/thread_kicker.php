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
} else {
    $phpbb_root_path = 'modules/Forums/';
}

define('IN_PHPBB', 1);

$phpbb_root_path = 'modules/Forums/';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_THREAD_KICKER, $nukeuser);
init_userprefs($userdata);
$page_title = 'Thread Kicker';
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_thread_kicker.' . $phpEx);

$user_id = $userdata['user_id'];

if (!$userdata['session_logged_in'] && $user_id == ANONYMOUS) {
	$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
	header($header_location . append_sid("login.$phpEx?redirect=thread_kicker.$phpEx", true));
	exit;
}

include_once('includes/page_header.'.$phpEx);

$template->set_filenames(array('body' => 'thread_kicker.tpl'));

$mode=$_GET['mode'];
$this_user_id=$userdata['user_id'];
$this_user_level=$userdata['user_level'];
$topic_id=$_GET['thread_tag'];
$kicked=$_GET['kicked'];
$kicker=$_GET['kicker'];
$unkicked=$_GET['unkicked'];
$unkicker=$_GET['unkicker'];
$mstatus=$_GET['mstatus'];
$post_id=$_GET['post_id'];
$index_redirect = '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx?") . '">';
$forum_redirect = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?p=$post_id#$post_id") . '">';
$default_link= '<br />' . $lang['tk_default_link'] . '<a href="' . append_sid("viewtopic.$phpEx?p=$post_id#$post_id") . '">' . $lang['tk_here'] . '</a>.';
$forum_redirect_overrule = '<meta http-equiv="refresh" content="10;url=' . append_sid("viewtopic.$phpEx?p=$post_id#$post_id") . '"><br />';
$default_link_overrule = '<br />' . $lang['tk_default_link_overrule'] . '<a href="' . append_sid("viewtopic.$phpEx?p=$post_id#$post_id") . '">' . $lang['tk_here'] . '</a>.';

if ( !$topic_id ) {
	$message = $lang['tk_nodata'] . $index_redirect;
	message_die(GENERAL_MESSAGE, $message);
}

if ( $userdata['kick_ban'] == 1 ) {
	$message = $lang['tk_banned'] . $index_redirect;
	message_die(GENERAL_MESSAGE, $message);
}

if ( $mode != 'kickview' ) {

	if ( !$kicked && !$kicker ) {
		if ( !$unkicked && !$unkicker ) {
			$message = $lang['tk_nodata'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}
	}

	if ( $post_id<1 ) {
		$message = $lang['tk_nodata'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( !$kicked && !$unkicked ) {
		$message = $lang['tk_nohotlink'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( !$kicker && !$unkicker ) {
		$message = $lang['tk_nohotlink'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( !$kicked && !$unkicker ) {
		$message = $lang['tk_nohotlink'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( !$kicker && !$unkicked ) {
		$message = $lang['tk_nohotlink'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}

	$sql=" SELECT forum_id FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

	if (!$result= $db->sql_query($sql)) {
		message_die(GENERAL_ERROR, 'Error in getting forum id', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$forum_id=$row['forum_id'];

	if ( $this_user_level != ADMIN ) {
		if ($this_user_id != $kicker && $this_user_id != $unkicker) {
			$message = $lang['tk_nohotlink'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		if ( $board_config['kicker_setting'] != 2 && !$mstatus ) {
			$message = $lang['tk_not_permitted'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		$sql=" SELECT topic_poster FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting topic starter for thread kick mod', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$thread_starter=$row['topic_poster'];

		if ( $board_config['kicker_setting'] == 2 && !$mstatus && $this_user_id != $thread_starter ) {
			$message = $lang['tk_not_permitted'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		if ( $mstatus == 1 ) {
			if ( $this_user_level != MOD ) {
				$message = $lang['tk_not_mod'] . $index_redirect;
				message_die(GENERAL_MESSAGE, $message);
			}

			$sql=" SELECT group_id FROM " . AUTH_ACCESS_TABLE . " WHERE forum_id=$forum_id AND auth_mod=1 ";
			if (!$result= $db->sql_query($sql)) {
				message_die(GENERAL_ERROR, 'Error in getting auth details', '', __LINE__, __FILE__, $sql);
			}

			$check=1;

			while ( $row = $db->sql_fetchrow($result) ) {
				$group_id=$row['group_id'];
				$sql_a=" SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE group_id=$group_id ";

				if (!$result_a= $db->sql_query($sql_a)) {
					message_die(GENERAL_ERROR, 'Error in getting auth details', '', __LINE__, __FILE__, $sql);
				}

				while ( $row_a = $db->sql_fetchrow($result_a) ) {
					$check_user_id=$row_a['user_id'];

					if ( $check_user_id == $this_user_id ) {
						$check=5;
					}
				}
			}

			if ( $check !=5 ) {
				$message = $lang['tk_not_mod_thisforum'] . $index_redirect;
				message_die(GENERAL_MESSAGE, $message);
			}
		}
	}

	if ( $kicker != 0 ) {
		$sql=" SELECT user_id FROM " . THREAD_KICKER_TABLE . " WHERE user_id=$kicked AND topic_id=$topic_id";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting kicked info', '', __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) ) {
			$message = $lang['tk_kicked_already'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		$kick_time=time();
		$kicker_status=3;

		if ( $userdata['user_level'] == ADMIN ) {
			$kicker_status=1;
		}

		if ( $mstatus == 1 && $userdata['user_level'] != ADMIN ) {
			$kicker_status=2;
		}

		$sql=" SELECT username FROM " . USERS_TABLE . " WHERE user_id=$kicked";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting kicked username', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$kicked_username=addslashes($row['username']);
		$kicker_username=addslashes($userdata['username']);
		$sql=" SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting kicked username', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$topic_title=addslashes($row['topic_title']);
		$sql = "INSERT INTO " . THREAD_KICKER_TABLE . " (user_id, topic_id, kicker, post_id, kick_time, kicker_status, kicker_username, kicked_username, topic_title) VALUES ($kicked,$topic_id,$kicker, $post_id, $kick_time, $kicker_status, '$kicker_username', '$kicked_username', '$topic_title')";

		if (!$db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in placing kicked user in to database', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['tk_kick_success'] . $forum_redirect . $default_link;
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( $unkicker != 0 ) {
		$sql=" SELECT * FROM " . THREAD_KICKER_TABLE . " WHERE user_id=$unkicked AND topic_id=$topic_id";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting kicked info', '', __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) ) {
			$user_exist=5;
			$kicker_status=$row['kicker_status'];
		}

		if ( $user_exist !=5 ) {
			$message = $lang['tk_unkicked_already'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		$kicking_now_status=$userdata['user_level'];

		if ( $kicking_now_status == USER && $kicker_status < 3 ) {
			$message = $lang['tk_no_overrule'] . $forum_redirect_overrule . $default_link_overrule;
			message_die(GENERAL_MESSAGE, $message);
		}

		if ( $kicking_now_status != ADMIN && $kicker_status == 1 ) {
			$message = $lang['tk_no_overrule_admin'] . $forum_redirect_overrule . $default_link_overrule;
			message_die(GENERAL_MESSAGE, $message);
		}

		$sql = "DELETE FROM " . THREAD_KICKER_TABLE . " WHERE user_id=$unkicked AND topic_id=$topic_id";

		if (!$db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in placing kicked user in to database', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['tk_unkick_success'] . $forum_redirect . $default_link;
		message_die(GENERAL_MESSAGE, $message);
	}
}

if ( $mode == 'kickview' ) {
	include_once('includes/thread_kicker_viewing.' . $phpEx);
}

$template->assign_vars(array(
	'KICKER_HEADER' => $lang['tk_kicker_heading'],
	'KICKER_TABLE' => $lang['tk_kicker_table'] . $thread,
	'UNKICK' => $lang['tk_unkick'],
	'KICKED' => $lang['tk_kicked'],
	'THREAD' => $lang['tk_thread'],
	'DATE' => $lang['tk_date'],
	'KICKED_BY' => $lang['tk_kicked_by'],
	'KICK_MARKED' => $lang['tk_kick_marked'],
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => $page_number,
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'S_MODE_SELECT' => $select_sort_mode,
	'L_ORDER' => $lang['Order'],
	'S_ORDER_SELECT' => $select_sort_order,
	'L_SUBMIT' => $lang['Sort'])
);

$template->pparse('body');

include_once('includes/page_tail.'.$phpEx);

?>
