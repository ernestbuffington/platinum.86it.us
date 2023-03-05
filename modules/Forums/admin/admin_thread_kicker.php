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

define('IN_PHPBB', 1);

if( !empty($setmodules) ) {
	$filename = basename(__FILE__);
	$module['Thread Kicker']['Administration'] = $filename;
	return;
}

$no_page_header = TRUE;
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_thread_kicker.' . $phpEx);

$template->set_filenames(array('body' => 'admin/admin_thread_kicker.tpl'));

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

$pagination = '';
$total_pag_items = 1;

$submit_all=$_POST['unkick_all'];

if ( $submit_all ) {
	$sql=" DELETE FROM " . THREAD_KICKER_TABLE;

	if ( !($result = $db->sql_query($sql)) ) {
		message_die(GENERAL_ERROR, 'Error in unkicking all users', '', __LINE__, __FILE__, $sql_z);
	}
}

$change_kick=$_POST['kicker_set_change'];

if ( $change_kick ) {
	$set_now=$board_config['kicker_setting'];

	if ( $set_now == 0 ) {
		$sql=" UPDATE " . CONFIG_TABLE . " SET config_value=2 WHERE config_name='kicker_setting'";

		if ( !($result = $db->sql_query($sql)) ) {
			message_die(GENERAL_ERROR, 'Error in changing kicker setting', '', __LINE__, __FILE__, $sql);
		}

		$message = 'Thread starter can now kick users.<meta http-equiv="refresh" content="2;url=' . append_sid("admin_thread_kicker.$phpEx?") . '">';
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( $set_now == 2 ) {
		$sql=" UPDATE " . CONFIG_TABLE . " SET config_value=0 WHERE config_name='kicker_setting'";

		if ( !($result = $db->sql_query($sql)) ) {
			message_die(GENERAL_ERROR, 'Error in changing kicker setting', '', __LINE__, __FILE__, $sql);
		}

		$message = 'Thread starter is now prevented from kicking users.<meta http-equiv="refresh" content="2;url=' . append_sid("admin_thread_kicker.$phpEx?") . '">';
		message_die(GENERAL_MESSAGE, $message);
	}
}

$check_setting=$board_config['kicker_setting'];

if ( $check_setting == 0 ) {
	$current_setting='At the moment, thread starters <strong>cannot</strong> kick other users, unless they are Moderators or Administrators of that particular Forum.';
}

if ( $check_setting == 2 ) {
	$current_setting='At the moment, thread starters <strong>can</strong> kick other users from that thread';
}

$change_view=$_POST['view_set_change'];
if ( $change_view ) {
	$set_now=$board_config['kicker_view_setting'];

	if ( $set_now == 0 ) {
		$sql=" UPDATE " . CONFIG_TABLE . " SET config_value=2 WHERE config_name='kicker_view_setting'";

		if ( !($result = $db->sql_query($sql)) ) {
			message_die(GENERAL_ERROR, 'Error in changing viewing setting', '', __LINE__, __FILE__, $sql);
		}

		$message = 'Kicked users <strong>cannot</strong> view the thread anymore.<meta http-equiv="refresh" content="2;url=' . append_sid("admin_thread_kicker.$phpEx?") . '">';
		message_die(GENERAL_MESSAGE, $message);
	}

	if ( $set_now == 2 ){
		$sql=" UPDATE " . CONFIG_TABLE . " SET config_value=0 WHERE config_name='kicker_view_setting'";

		if ( !($result = $db->sql_query($sql)) ) {
			message_die(GENERAL_ERROR, 'Error in changing viewing setting', '', __LINE__, __FILE__, $sql);
		}

		$message = 'Kicked users <strong>can</strong> now view the thread.<meta http-equiv="refresh" content="2;url=' . append_sid("admin_thread_kicker.$phpEx?") . '">';
		message_die(GENERAL_MESSAGE, $message);
	}
}

$check_setting=$board_config['kicker_view_setting'];

if ( $check_setting == 0 ) {
	$current_view_setting='At the moment, kicked users <strong>can</strong> view the thread, but they <strong>cannot</strong> post or edit a post.';
}

if ( $check_setting == 2 ) {
	$current_view_setting='At the moment, kicked users <strong>cannot</strong> view the thread, and they <strong>cannot</strong> post, or edit a post.';
}

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

if ( isset($_GET['mode']) || isset($_POST['mode']) ) {
$mode = ( isset($_POST['mode']) ) ? htmlspecialchars($_POST['mode']) : htmlspecialchars($_GET['mode']);
} else {
$mode = 'date';
}

if(isset($_POST['order'])) {
	$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
} else if(isset($_GET['order'])) {
	$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
} else {
	$sort_order = 'DESC';
}

$mode_types_text = array( $lang['tk_date'], $lang['tk_thread'], $lang['tk_kicked'], $lang['tk_kicked_by']);
$mode_types = array('date', 'thread', 'kicked', 'kicked_by');
$select_sort_mode = '<select name="mode">';

for($i = 0; $i < count($mode_types_text); $i++) {
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}

$select_sort_mode .= '</select>';
$select_sort_order = '<select name="order">';

if($sort_order == 'ASC') {
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
} else {
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}

$select_sort_order .= '</select>';

switch( $mode ) {
	case 'date':
		$order_by = "kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'kicked':
		$order_by = "kicked_username, kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'thread':
		$order_by = "topic_title, kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'kicked_by':
		$order_by = "kicker_username, kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	default:
		$order_by = "kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}

$sql = "SELECT * FROM " . THREAD_KICKER_TABLE . " ORDER BY $order_by";

if ( !($result = $db->sql_query($sql)) ) {
	message_die(GENERAL_ERROR, 'Error in building list of kicked users', '', __LINE__, __FILE__, $sql);
}

$x=1;

while ( $row = $db->sql_fetchrow($result) ) {
	$tk_kick_id=$row['kick_id'];
	$submit=$_POST['unkick_marked'];

	if ( $submit ) {
		$check=$_POST[$tk_kick_id];

		if ( $check == 1 ) {
			$sql_z=" DELETE FROM " . THREAD_KICKER_TABLE . " WHERE kick_id=$tk_kick_id";

			if ( !($result_z = $db->sql_query($sql_z)) ) {
				message_die(GENERAL_ERROR, 'Error in unkicking user', '', __LINE__, __FILE__, $sql_z);
			}
		}
	}

	if ( $check != 1 ) {
		$tk_user_id=$row['user_id'];
		$tk_topic_id=$row['topic_id'];
		$tk_kicker=$row['kicker'];
		$tk_post_id=$row['post_id'];
		$tk_kick_time=$row['kick_time'];
		$tk_kicker_status=$row['kicker_status'];
		$sql_d=" SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$tk_topic_id";

		if ( !($result_d = $db->sql_query($sql_d)) ) {
			message_die(GENERAL_ERROR, 'Error in retrieving username', '', __LINE__, __FILE__, $sql_d);
		}

		$row_d = $db->sql_fetchrow($result_d);
		$topic_title = $row_d['topic_title'];
		$thread='<a href="../../../'.append_sid("viewtopic.$phpEx?t=$tk_topic_id") . '" target="_blank">' . $topic_title . '</a>';
		$kick_time = create_date( $board_config['default_dateformat'], $tk_kick_time, $board_config['board_timezone'] );
		$row_color = ( !($x % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($x % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$sql_a = "SELECT username FROM " . USERS_TABLE . " WHERE user_id=$tk_user_id";
	
		if ( !($result_a = $db->sql_query($sql_a)) ) {
			message_die(GENERAL_ERROR, 'Error in retrieving username', '', __LINE__, __FILE__, $sql_a);
		}

		$row_a = $db->sql_fetchrow($result_a);
		$kicked_username = $row_a['username'];
		$sql_b = "SELECT username FROM " . USERS_TABLE . " WHERE user_id=$tk_kicker";
	
		if ( !($result_b = $db->sql_query($sql_b)) ) {
			message_die(GENERAL_ERROR, 'Error in retrieving username', '', __LINE__, __FILE__, $sql_b);
		}

		$row_b = $db->sql_fetchrow($result_b);
		$kicker_username = $row_b['username'];
		$tk_mark = '<input type="checkbox" name="' . $tk_kick_id . '" value="1" />';

		$template->assign_block_vars('kicker', array(
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'KICK_ID' => $tk_kick_id,
			'KICKED' => '<a href="../../../'.append_sid("profile.$phpEx?mode=viewprofile&u=$tk_user_id") . '" target="_blank">' . $kicked_username . '</a>',
			'KICKED_BY' => '<a href="../../../'.append_sid("profile.$phpEx?mode=viewprofile&u=$tk_kicker") . '" target="_blank">' . $kicker_username . '</a>',
			'THREAD' => $thread,
			'DATE' => $kick_time,
			'CHECKBOX' => $tk_mark)
		);

		$x++;
	}
}
$sql = 'SELECT count(*) AS total FROM ' . THREAD_KICKER_TABLE . " ORDER BY kick_time DESC";

if ( !($result = $db->sql_query($sql)) ) {
	message_die(GENERAL_ERROR, 'Error getting total for pagination', '', __LINE__, __FILE__, $sql);
}

if ( $total = $db->sql_fetchrow($result) ) {
	$total_pag_items = $total['total'];

	if ( !empty($total_pag_items) ) {
		$pagination = generate_pagination("admin_thread_kicker.php?mode=$mode&amp;order=$sort_order", $total_pag_items, $board_config['topics_per_page'], $start). '';
		$page_number = sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_pag_items / $board_config['topics_per_page'] ));
	}
}

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'S_MODE_SELECT' => $select_sort_mode,
	'L_ORDER' => $lang['Order'],
	'S_ORDER_SELECT' => $select_sort_order,
	'L_SUBMIT' => $lang['Sort'],
	'KICKER_HEADER' => $lang['tk_kicker_heading'],
	'KICKER_TABLE' => $lang['tk_kicker_table'],
	'UNKICK' => $lang['tk_unkick'],
	'KICKED' => $lang['tk_kicked'],
	'THREAD' => $lang['tk_thread'],
	'DATE' => $lang['tk_date'],
	'KICKED_BY' => $lang['tk_kicked_by'],
	'KICKER_SET_HEAD' => $lang['tk_kicker_set_head'],
	'KICKER_SET_EXPLAIN' => $lang['tk_kicker_set_explain'],
	'KICK_MARKED' => $lang['tk_kick_marked'],
	'UNKICK_ALL' => $lang['tk_unkick_all'],
	'KICKER_SET_CURRENT' => $current_setting,
	'KICKER_SET_CHANGE_BUTTON' => $lang['tk_kicker_set_change'],
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => $page_number,
	'VIEW_SET_HEAD' => $lang['tk_view_set_head'],
	'VIEW_SET_EXPLAIN' => $lang['tk_view_set_explain'],
	'VIEW_SET_CHANGE_BUTTON' => $lang['tk_view_set_change_button'],
	'VIEW_SET_CURRENT' => $current_view_setting)
);

include_once('./page_header_admin.'.$phpEx);

$template->pparse('body');

include_once('./page_footer_admin.'.$phpEx);

?>
