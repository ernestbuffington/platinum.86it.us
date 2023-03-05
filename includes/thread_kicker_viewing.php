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

if (!defined('IN_PHPBB')) {
	die("Hacking attempt");
}

if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD && $board_config['kicker_setting'] != 2 ) {
	$message = $lang['tk_not_permitted'] . $index_redirect;
	message_die(GENERAL_MESSAGE, $message);
}

if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD && $board_config['kicker_setting'] == 2 ) {
	$sql=" SELECT topic_poster FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id ";

	if (!$result= $db->sql_query($sql)) {
		message_die(GENERAL_ERROR, 'Error in getting thread starter info', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	if ( $row['topic_poster'] != $userdata['user_id'] ) {
		$message = $lang['tk_not_permitted'] . $index_redirect;
		message_die(GENERAL_MESSAGE, $message);
	}
}

if ( $userdata['user_level'] == MOD ) {
	$sql=" SELECT forum_id FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

	if (!$result= $db->sql_query($sql)) {
		message_die(GENERAL_ERROR, 'Error in getting forum id', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$forum_id=$row['forum_id'];
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
		if ( $board_config['kicker_setting'] != 2 ) {
			$message = $lang['tk_not_mod_thisforum'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}

		$sql=" SELECT topic_poster FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id ";

		if (!$result= $db->sql_query($sql)) {
			message_die(GENERAL_ERROR, 'Error in getting thread starter info', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		if ( $row['topic_poster'] != $userdata['user_id'] ) {
			$message = $lang['tk_not_mod_thisforum'] . $index_redirect;
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

$redirect_overrule='<meta http-equiv="refresh" content="5;url=' . append_sid("thread_kicker.$phpEx?mode=kickview&thread_tag=$topic_id") . '">';
$pagination = '';
$total_pag_items = 1;
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

$mode_types_text = array( $lang['tk_date'], $lang['tk_kicked'], $lang['tk_kicked_by']);
$mode_types = array('date', 'kicked', 'kicked_by');
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
		$order_by = "kicked_username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'kicked_by':
		$order_by = "kicker_username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	default:
		$order_by = "kick_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}


$sql_d=" SELECT topic_title FROM " . TOPICS_TABLE . " WHERE topic_id=$topic_id";

if ( !($result_d = $db->sql_query($sql_d)) ) {
	message_die(GENERAL_ERROR, 'Error in retrieving username', '', __LINE__, __FILE__, $sql_d);
}

$row_d = $db->sql_fetchrow($result_d);
$topic_title = $row_d['topic_title'];
$thread='<a href="' . append_sid("viewtopic.$phpEx?t=$topic_id") . '" class="nav">' . $topic_title . '</a>';
$sql = "SELECT * FROM " . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id ORDER BY $order_by";

if ( !($result = $db->sql_query($sql)) ) {
	message_die(GENERAL_ERROR, 'Error in building list of kicked users', '', __LINE__, __FILE__, $sql);
}

$x=1;

while ( $row = $db->sql_fetchrow($result) ) {
	$tk_kick_id=$row['kick_id'];
	$kicker_status=$row['kicker_status'];
	$submit=$_POST['unkick_marked'];

	if ( $submit ) {
		$check=$_POST[$tk_kick_id];

		if ( $check == 1 ) {
			$kicking_now_status=$userdata['user_level'];

			if ( $kicking_now_status == USER && $kicker_status < 3 ) {
				$message = $lang['tk_no_overrule'] . $redirect_overrule;
				message_die(GENERAL_MESSAGE, $message);
			}

			if ( $kicking_now_status != ADMIN && $kicker_status == 1 ) {
				$message = $lang['tk_no_overrule_admin'] . $redirect_overrule;
				message_die(GENERAL_MESSAGE, $message);
			}

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
			'KICKED' => '<a href="' . $phpbb_root_path . append_sid("profile.$phpEx?mode=viewprofile&u=$tk_user_id") . '" target="_blank">' . $kicked_username . '</a>',
			'KICKED_BY' => '<a href="' . $phpbb_root_path . append_sid("profile.$phpEx?mode=viewprofile&u=$tk_kicker") . '" target="_blank">' . $kicker_username . '</a>',
			'DATE' => $kick_time,
			'CHECKBOX' => $tk_mark)
		);

		$x++;
	}
}

$sql = 'SELECT count(*) AS total FROM ' . THREAD_KICKER_TABLE . " WHERE topic_id=$topic_id ORDER BY kick_time DESC";

if ( !($result = $db->sql_query($sql)) ) {
	message_die(GENERAL_ERROR, 'Error getting total for pagination', '', __LINE__, __FILE__, $sql);
}

if ( $total = $db->sql_fetchrow($result) ) {
	$total_pag_items = $total['total'];

	if ( !empty($total_pag_items) ) {
		$pagination = generate_pagination("thread_kicker.php?mode=$mode&amp;order=$sort_order", $total_pag_items, $board_config['topics_per_page'], $start). '';
		$page_number = sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_pag_items / $board_config['topics_per_page'] ));
	}
}

$template->set_filenames(array('body' => 'thread_kicker_viewing.tpl'));

?>
