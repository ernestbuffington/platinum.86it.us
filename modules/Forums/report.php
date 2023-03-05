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

if ($popup != "1")
    {
        $module_name = basename(dirname(__FILE__));
        require_once("modules/".$module_name."/nukebb.php");
    }
    else
    {
        $phpbb_root_path = NUKE_FORUMS_DIR;
    }
define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once("includes/functions_report.php");
// standard session management
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
// standard page header 
include_once('includes/page_header.php');
if (isset($_GET['mode']) || isset($_POST['mode']))
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = '';
}

if (isset($_GET['id']) || isset($_POST['id']))
{
	$id = (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];
}
else
{
	$id = '';
}

$user_params = array('report', 'reportpost', 'reporttopic', 'reportuser');

if (!$userdata['session_logged_in'])
{
	$redirect = (!empty($mode)) ? '&mode=' . $mode : '';
	$redirect .= (!empty($id)) ? '&id=' . $id : '';
	redirect("login.$phpEx?redirect=report.$phpEx{$redirect}");
}

$return_links['index'] = '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

$opened_cat = (isset($_GET[POST_CAT_URL])) ? '?' . POST_CAT_URL . '=' . $_GET[POST_CAT_URL] : '';
$list_link = "report.$phpEx{$opened_cat}";
$return_links['list'] = '<br /><br />' . sprintf($lang['Click_return_reportlist'], '<a href="' . append_sid($list_link) . '">', '</a>');

$post_link = "viewtopic.$phpEx?" . POST_POST_URL . "=$id";
$return_links['post'] = (!empty($id)) ? '<br /><br />' . sprintf($lang['Click_return_post'], '<a href="' . append_sid($post_link) . '#' . $id . '">', '</a>') : '';
$post_link .= "#$id";

$topic_link = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$id";
$return_links['topic'] = (!empty($id)) ? '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid($topic_link) . '">', '</a>') : '';

$profile_link = "profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$id";
$return_links['user'] = (!empty($id)) ? '<br /><br />' . sprintf($lang['Click_return_profile'], '<a href="' . append_sid(htmlspecialchars($profile_link)) . '">', '</a>') : '';

// auth message
if (($board_config['report_list'] != 0 || (!($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD))) && !in_array($mode, $user_params))
{
	message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['index']);
}

if ($mode == 'report' && isset($_POST['submit']) && $_POST[POST_CAT_URL] > 0 && !empty($_POST['text']))
{
	insert_report($_POST[POST_CAT_URL], stripslashes($_POST['info']), stripslashes($_POST['text']));
	report_notify($_POST[POST_CAT_URL], stripslashes($_POST['info']), stripslashes($_POST['text']));
	message_die(GENERAL_MESSAGE, $lang['Report_sent'] . $return_links['index']);
}
else if ($mode == 'report')
{
	if (isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]))
	{
		$cat = (isset($_POST[POST_CAT_URL])) ? $_POST[POST_CAT_URL] : $_GET[POST_CAT_URL];
	}
	else
	{
		$cat = 0;
	}

	// error messages
	if (isset($_POST['submit']))
	{
		$error_msg = array();
		if ($cat <= 0)
		{
			$error_msg[] = $lang['No_category_selected'];
		}
		if (empty($_POST['text']))
		{
			$error_msg[] = $lang['No_text_entered'];
		}
		if ($msg = report_prepare_errors($error_msg))
		{
			$template->assign_block_vars('switch_error_msg', array(
				'ERROR_MSG' => $msg)
			);
		}
	}

	$template->set_filenames(array(
		'body' => 'report_body.tpl')
	);

	// make category select
	if (!$cats = obtain_report_cats('normal'))
	{
		message_die(GENERAL_MESSAGE, $lang['No_categories'] . $return_links['index']);
	}
	$cat_explain = '';
	$cat_select = '<select name="' . POST_CAT_URL . '">';
	$cat_select .= (empty($cat) || $cat < 0) ? '<option value="-1">&nbsp;</option>' : '';
	foreach ($cats as $this_cat)
	{
		if ($cat == $this_cat['cat_id'])
		{
			$selected = ' selected="selected"';
			$cat_explain = $this_cat['cat_explain'];
			$template->assign_block_vars('switch_cat_explain', array());
		}
		else
		{
			$selected = '';
		}
		$cat_select .= '<option value="' . $this_cat['cat_id'] . '"' . $selected . '>' . $this_cat['cat_name'] . '</option>';
	}
	$cat_select .= '</select> &nbsp;<input type="submit" class="liteoption" name="submit_cat" value="' . $lang['Go'] . '" />';

	// validate form data
	$info = (isset($_POST['info'])) ? htmlspecialchars(stripslashes($_POST['info'])) : '';
	$text = (isset($_POST['text'])) ? htmlspecialchars(stripslashes($_POST['text'])) : '';	

	$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';

	$template->assign_vars(array(
		'L_WRITE_REPORT' => $lang['Write_report'],
		'L_CAT_SELECT' => (empty($cat) || $cat < 0) ? $lang['Select_category'] : $lang['Change_category'],
		'L_CAT_EXPLAIN' => $lang['Category_description'],
		'L_INFO' => $lang['Report_subject'],
		'L_TEXT' => $lang['Report_text'],
		'L_SUBMIT' => $lang['Submit'],

		'S_CAT_SELECT' => $cat_select,
		'S_INFO' => $info,
		'S_CAT_EXPLAIN' => $cat_explain,
		'S_TEXT' => $text,
		'S_ACTION' => append_sid("report.$phpEx"),
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);

	$template->assign_block_vars('switch_no_special_cat', array());

	$page_title = $lang['Write_report'];
	//include_once('includes/page_header.' . $phpEx);
	$template->pparse('body');
	//include_once('includes/page_tail.' . $phpEx);
}
else if ($mode == 'reportpost' && isset($_POST['submit']) && is_numeric($id))
{
	// check if post has already been reported
	if (get_report_status('post', $id) == 0)
	{
		message_die(GENERAL_MESSAGE, $lang['Post_already_reported'] . $return_links['post'] . $return_links['index']);
	}

	insert_report(REPORT_POST_ID, $id, stripslashes($_POST['text']));
	report_notify(REPORT_POST_ID, $id, stripslashes($_POST['text']));
	message_die(GENERAL_MESSAGE, $lang['Report_sent'] . $return_links['post'] . $return_links['index']);
}
else if ($mode == 'reportpost' && is_numeric($id))
{
	$template->set_filenames(array(
		'body' => 'report_body.tpl')
	);

	// check if post has already been reported
	if (get_report_status('post', $id) == 0)
	{
		message_die(GENERAL_MESSAGE, $lang['Post_already_reported'] . $return_links['post'] . $return_links['index']);
	}

	// get report post category
	if (!$cat = obtain_report_cats('cat', REPORT_POST_ID))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['post'] . $return_links['index']);
	}
	$template->assign_block_vars('switch_cat_explain', array());

	// get topic title
	if (!$topic_title = get_topic_title('post', $id))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['post'] . $return_links['index']);
	}

	$temp_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$id#$id");
	$info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $topic_title . '</a>';
	
	$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="id" value="' . $id . '" />';

	$template->assign_vars(array(
		'L_WRITE_REPORT' => $lang['Report_post'],
		'L_CAT_SELECT' => $lang['Category'],
		'L_CAT_EXPLAIN' => $lang['Category_description'],
		'L_INFO' => $lang['Report_subject'],
		'L_TEXT' => $lang['Report_text'],
		'L_SUBMIT' => $lang['Submit'],

		'S_CAT_SELECT' => $cat['cat_name'],
		'S_INFO' => $info,
		'S_CAT_EXPLAIN' => $cat['cat_explain'],
		'S_TEXT' => '',
		'S_ACTION' => append_sid("report.$phpEx"),
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);

	$template->assign_block_vars('switch_special_cat', array());

	$page_title = $lang['Write_report'];
	//include_once('includes/page_header.' . $phpEx);
	$template->pparse('body');
	//include_once('includes/page_tail.' . $phpEx);
}
else if ($mode == 'reporttopic' && isset($_POST['submit']) && is_numeric($id))
{
	// check if topic has already been reported
	if (get_report_status('topic', $id) == 0)
	{
		message_die(GENERAL_MESSAGE, $lang['Topic_already_reported'] . $return_links['topic'] . $return_links['index']);
	}

	insert_report(REPORT_TOPIC_ID, $id, stripslashes($_POST['text']));
	report_notify(REPORT_TOPIC_ID, $id, stripslashes($_POST['text']));
	message_die(GENERAL_MESSAGE, $lang['Report_sent'] . $return_links['topic'] . $return_links['index']);
}
else if ($mode == 'reporttopic' && is_numeric($id))
{
	$template->set_filenames(array(
		'body' => 'report_body.tpl')
	);

	// check if topic has already been reported
	if (get_report_status('topic', $id) == 0)
	{
		message_die(GENERAL_MESSAGE, $lang['Topic_already_reported'] . $return_links['topic'] . $return_links['index']);
	}

	// get report topic category
	if (!$cat = obtain_report_cats('cat', REPORT_TOPIC_ID))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['topic'] . $return_links['index']);
	}
	$template->assign_block_vars('switch_cat_explain', array());

	// get topic title
	if (!$topic_title = get_topic_title('topic', $id))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['topic'] . $return_links['index']);
	}

	$temp_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$id");
	$info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $topic_title . '</a>';

	$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="id" value="' . $id . '" />';

	$template->assign_vars(array(
		'L_WRITE_REPORT' => $lang['Report_topic'],
		'L_CAT_SELECT' => $lang['Category'],
		'L_CAT_EXPLAIN' => $lang['Category_description'],
		'L_INFO' => $lang['Report_subject'],
		'L_TEXT' => $lang['Report_text'],
		'L_SUBMIT' => $lang['Submit'],

		'S_CAT_SELECT' => $cat['cat_name'],
		'S_INFO' => $info,
		'S_CAT_EXPLAIN' => $cat['cat_explain'],
		'S_TEXT' => '',
		'S_ACTION' => append_sid("report.$phpEx"),
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);
	
	$template->assign_block_vars('switch_special_cat', array());

	$page_title = $lang['Write_report'];
	//include_once('includes/page_header.' . $phpEx);
	$template->pparse('body');
	//include_once('includes/page_tail.' . $phpEx);
}
else if ($mode == 'reportuser' && isset($_POST['submit']) && is_numeric($id) && !empty($_POST['text']))
{
	insert_report(REPORT_USER_ID, $id, stripslashes($_POST['text']));
	report_notify(REPORT_USER_ID, $id, stripslashes($_POST['text']));
	message_die(GENERAL_MESSAGE, $lang['Report_sent'] . $return_links['user'] . $return_links['index']);
}
else if ($mode == 'reportuser' && is_numeric($id) && $id > 0)
{
	// error messages
	if (isset($_POST['submit']))
	{
		$error_msg = array();
		if (empty($_POST['text']))
		{
			$error_msg[] = $lang['No_text_entered'];
		}
		if ($msg = report_prepare_errors($error_msg))
		{
			$template->assign_block_vars('switch_error_msg', array(
				'ERROR_MSG' => $msg)
			);
		}
	}

	$template->set_filenames(array(
		'body' => 'report_body.tpl')
	);

	// get report user category
	if (!$cat = obtain_report_cats('cat', REPORT_USER_ID))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['user'] . $return_links['index']);
	}
	$template->assign_block_vars('switch_cat_explain',array());

	// get username
	if (!$username = get_username($id))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['user'] . $return_links['index']);
	}

	$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$id");
	$info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $username . '</a>';

	$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="id" value="' . $id . '" />';

	// validate form data
	$text = (isset($_POST['text'])) ? htmlspecialchars(stripslashes($_POST['text'])) : '';

	$template->assign_vars(array(
		'L_WRITE_REPORT' => $lang['Report_user'],
		'L_CAT_SELECT' => $lang['Category'],
		'L_CAT_EXPLAIN' => $lang['Category_description'],
		'L_INFO' => $lang['Report_subject'],
		'L_TEXT' => $lang['Report_text'],
		'L_SUBMIT' => $lang['Submit'],

		'S_CAT_SELECT' => $cat['cat_name'],
		'S_INFO' => $info,
		'S_CAT_EXPLAIN' => $cat['cat_explain'],
		'S_TEXT' => $text,
		'S_ACTION' => append_sid("report.$phpEx"),
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);

	$template->assign_block_vars('switch_special_cat', array());

	$page_title = $lang['Write_report'];
	//include_once('includes/page_header.' . $phpEx);
	$template->pparse('body');
	//include_once('includes/page_tail.' . $phpEx);
}
else if (($mode == 'clear' || $mode == 'clearpost' || $mode == 'cleartopic' || $mode == 'process' || $mode == 'unclear') && is_numeric($id))
{
	// check authorisation
	switch ($mode)
	{
		case 'clearpost':
			if (!report_auth('post', $id))
			{
				message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['post'] . $return_links['index']);
			}
			$return_link = $post_link;			
			break;
		case 'cleartopic':
			if (!report_auth('topic', $id))
			{
				message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['topic'] . $return_links['index']);
			}
			$return_link = $topic_link;
			break;
		default:
			if (!report_auth('report', $id))
			{
				message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['list'] . $return_links['index']);
			}
			$return_link = $list_link;
			break;
	}

	change_report_status($mode, $id);
	redirect(append_sid($return_link, true));
}
else if (($mode == 'delete' || $mode == 'deleteall') && is_numeric($id))
{
	$del_mode = ($mode == 'deleteall') ? 'cat' : 'report';
	if (!report_auth($del_mode, $id))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_not_authorised'] . $return_links['list'] . $return_links['index']);
	}

	if (isset($_POST['confirm']))
	{
		delete_report($del_mode, $id);

		$msg = ($mode == 'deleteall') ? $lang['Reports_deleted'] : $lang['Report_deleted'];
		message_die(GENERAL_MESSAGE, $msg . $return_links['list'] . $return_links['index']);
	}
	else if (isset($_POST['cancel']))
	{
		redirect(append_sid($list_link, true));
	}
	else
	{
		$template->set_filenames(array(
			'body' => 'confirm_body.tpl')
		);

		$msg_text = ($mode == 'deleteall') ? $lang['Confirm_delete_reports'] : $lang['Confirm_delete_report'];
		$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="id" value="' . $id . '" />';

		$template->assign_vars(array(
		  'S_CONFIRM_ACTION' => append_sid($list_link),
		  'MESSAGE_TITLE' => $lang['Confirm'],
		  'MESSAGE_TEXT' => $msg_text,
		  'S_HIDDEN_FIELDS' => $hidden_fields,
		  'L_YES' => $lang['Yes'],
		  'L_NO' => $lang['No'])
		);

		//include_once('includes/page_header.' . $phpEx);
		$template->pparse('body');
		//include_once('includes/page_tail.' . $phpEx);
	}
}
else
{
	$opened_cat = (isset($_GET[POST_CAT_URL])) ? '&amp;' . POST_CAT_URL . '=' . $_GET[POST_CAT_URL] : '';

	$template->set_filenames(array(
		'body' => 'report_list_body.tpl')
	);

	// Obtain reports
	if (!$report_data = obtain_reports('all', true))
	{
		message_die(GENERAL_MESSAGE, $lang['No_categories']);
	}

	$all_reports = $report_data['all'];
	switch ($all_reports['report_count'][-1])
	{
		case 0:
			$count_output = $lang['Report_count_0'];
			break;
		case 1:
			$count_output = $lang['Report_count_1'];
			break;
		default:
			$count_output = sprintf($lang['Report_count_2'], $all_reports['report_count'][-1]);
			break;
	}

	$template->assign_block_vars('menu', array(
		'ROW_CLASS' => (isset($_GET[POST_CAT_URL]) && is_numeric($_GET[POST_CAT_URL])) ? $theme['td_class1'] : $theme['td_class2'],
		'NAME' => $lang['Show_all_categories'],
		'LINK' => append_sid("report.$phpEx"),
		'COUNT' => $count_output,
		'COUNT_NOT_CLEARED' => $all_reports['report_count'][REPORT_NOT_CLEARED],
		'COUNT_IN_PROCESS' => $all_reports['report_count'][REPORT_IN_PROCESS],
		'COUNT_CLEARED' => $all_reports['report_count'][REPORT_CLEARED])
	);

	foreach ($report_data['cats'] as $this_cat)
	{
		// Category link
		$link = append_sid("report.$phpEx?" . POST_CAT_URL . '=' . $this_cat['cat_id']);

		// Report count
		$count = $this_cat['report_count'][-1];
		switch ($count)
		{
			case 0:
				$count_output = $lang['Report_count_0'];
				break;
			case 1:
				$count_output = $lang['Report_count_1'];
				break;
			default:
				$count_output = sprintf($lang['Report_count_2'], $count);
				break;
		}

		$template->assign_block_vars('menu', array(
			'ROW_CLASS' => (isset($_GET[POST_CAT_URL]) && $_GET[POST_CAT_URL] == $this_cat['cat_id']) ? $theme['td_class2'] : $theme['td_class1'],
			'NAME' => $this_cat['cat_name'],
			'LINK' => $link,
			'COUNT' => $count_output,
			'COUNT_NOT_CLEARED' => $this_cat['report_count'][REPORT_NOT_CLEARED],
			'COUNT_IN_PROCESS' => $this_cat['report_count'][REPORT_IN_PROCESS],
			'COUNT_CLEARED' => $this_cat['report_count'][REPORT_CLEARED])
		);

		if (!isset($_GET[POST_CAT_URL]) || $_GET[POST_CAT_URL] == $this_cat['cat_id'])
		{
			// Delete all link
			$u_delete_all = append_sid("report.$phpEx?mode=deleteall&amp;id=" . $this_cat['cat_id'] . $opened_cat);

			$template->assign_block_vars('catrow', array(
				'ID' => $this_cat['cat_id'],
				'NAME' => $this_cat['cat_name'],
				'LINK' => $link,
				'COUNT' => $count_output,
				'U_DELETE_ALL' => $u_delete_all,
				'EXPLAIN' => $this_cat['cat_explain'])
			);

			if (!$count)
			{
				$template->assign_block_vars('catrow.switch_no_result', array());
			}
			else
			{
				$show_id = 0;
				foreach ($this_cat['reports'] as $this_report)
				{
					$show_id++;

					// Status output
					$style = 'color: ' . $board_config['report_color_not_cleared'] . (($this_report['report_status'] == REPORT_NOT_CLEARED) ? '; font-weight: bold' : '');
					$temp_url = append_sid("report.$phpEx?mode=unclear&amp;id=" . $this_report['report_id'] . $opened_cat);
					$report_status_not_cleared = '<a href="' . $temp_url . '" class="genmed" style="' . $style . '">' . $lang['Report_status_not_cleared'] . '</a>';

					$style = 'color: ' . $board_config['report_color_in_process'] . (($this_report['report_status'] == REPORT_IN_PROCESS) ? '; font-weight: bold' : '');
					$temp_url = append_sid("report.$phpEx?mode=process&amp;id=" . $this_report['report_id'] . $opened_cat);
					$report_status_in_process = '<a href="' . $temp_url . '" class="genmed" style="' . $style . '">' . $lang['Report_status_in_process'] . '</a>';

					$style = 'color: ' . $board_config['report_color_cleared'] . (($this_report['report_status'] == REPORT_CLEARED) ? '; font-weight: bold' : '');
					$temp_url = append_sid("report.$phpEx?mode=clear&amp;id=" . $this_report['report_id'] . $opened_cat);
					$report_status_cleared = '<a href="' . $temp_url . '" class="genmed" style="' . $style . '">' . $lang['Report_status_cleared'] . '</a>';

					// Last changed info
					if (!empty($this_report['report_update_user']))
					{
						$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $this_report['report_update_user']);
						$last_changed_user = '<a href="' . $temp_url . '" class="genmed">' . $this_report['report_update_username'] . '</a>';
						$last_changed_time = create_date($board_config['default_dateformat'], $this_report['report_update_time'], $board_config['board_timezone']);
						$report_last_changed = sprintf($lang['Report_last_changed'], $last_changed_user, $last_changed_time);
					}
					else
					{
						$report_last_changed = '';
					}

					// Report info
					if ($this_cat['cat_id'] == REPORT_POST_ID && $this_report['topic_title'])
					{
						$temp_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $this_report['report_info'] . '#' . $this_report['report_info']);
						$report_info = '<a href="' . $temp_url . '" class="genmed">' . $this_report['topic_title'] . '</a>';
					}
					else if ($this_cat['cat_id'] == REPORT_TOPIC_ID && $this_report['topic_title'])
					{
						$temp_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $this_report['report_info']);
						$report_info = '<a href="' . $temp_url . '" class="genmed">' . $this_report['topic_title'] . '</a>';
					}
					else if ($this_cat['cat_id'] == REPORT_USER_ID && $this_report['username'])
					{
						$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $this_report['report_info']);
						$report_info = '<a href="' . $temp_url . '" class="genmed">' . $this_report['username'] . '</a>';
					}
					else
					{
						$report_info = $this_report['report_info'];
					}

					$template->assign_block_vars('catrow.reportrow', array(
						'SHOW_ID' => $show_id,
						'STATUS_NOT_CLEARED' => $report_status_not_cleared,
						'STATUS_IN_PROCESS' => $report_status_in_process,
						'STATUS_CLEARED' => $report_status_cleared,
						'LAST_CHANGED' => $report_last_changed,
						'DATE' => create_date($board_config['default_dateformat'], $this_report['report_date'], $board_config['board_timezone']),
						'U_USER' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $this_report['report_user_id']),
						'USER' => $this_report['report_username'],
						'INFO' => $report_info,
						'TEXT' => $this_report['report_text'],
						'U_DELETE' => append_sid("report.$phpEx?mode=delete&amp;id=" . $this_report['report_id'] . $opened_cat),
						'U_PRIVMSG' => append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . '=' . $this_report['report_user_id']))
					);

					if ($show_id > 1)
					{
						$template->assign_block_vars('catrow.reportrow.switch_spacer', array());
					}
				}
			}
		}
	}

	$template->assign_vars(array(
		'L_REPORT_LIST_TITLE' => $lang['Reportlist_title'],
		'L_REPORT_LIST_EXPLAIN' => $lang['Reportlist_explain'],
		'L_CATEGORIES' => $lang['Categories'],
		'L_DATE' => $lang['Date'],
		'L_STATUS' => $lang['Status'],
		'L_USERNAME' => $lang['Username'],
		'L_INFO' => $lang['Report_subject'],
		'L_DELETE' => $lang['Delete'],
		'L_PRIVMSG' => $lang['Private_Message'],
		'L_NO_RESULT' => $lang['No_reports'],
		'L_DELETE_ALL' => $lang['Delete_all'],

		'T_NOT_CLEARED' => $board_config['report_color_not_cleared'],
		'T_IN_PROCESS' => $board_config['report_color_in_process'],
		'T_CLEARED' => $board_config['report_color_cleared'])
	);

	$page_title = $lang['Reportlist_title'];
	//include_once('includes/page_header.' . $phpEx);
	$template->pparse('body');
	include_once('includes/page_tail.' . $phpEx);
}

?>
