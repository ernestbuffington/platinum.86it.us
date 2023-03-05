<?php

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Reports']['List'] = $filename;

	return;
}

define('IN_PHPBB', true);

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
require_once("../../../includes/bbcode.php");
include_once("../../../includes/functions_report.php");

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

$return_links['index'] = '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

$opened_cat = (isset($_GET[POST_CAT_URL])) ? '?' . POST_CAT_URL . '=' . $_GET[POST_CAT_URL] : '';
$list_link = "admin_report_list.$phpEx{$opened_cat}";
$return_links['list'] = '<br /><br />' . sprintf($lang['Click_return_reportlist'], '<a href="' . append_sid($list_link) . '">', '</a>');

if (($mode == 'clear' || $mode == 'process' || $mode == 'unclear') && is_numeric($id))
{
	change_report_status($mode, $id);
	redirect(append_sid("admin/$list_link", true));
}
else if (($mode == 'delete' || $mode == 'deleteall') && is_numeric($id))
{
	if (isset($_POST['confirm']))
	{
		$del_mode = ($mode == 'deleteall') ? 'cat' : 'report';
		delete_report($del_mode, $id);

		$msg = ($mode == 'deleteall') ? $lang['Reports_deleted'] : $lang['Report_deleted'];
		message_die(GENERAL_MESSAGE, $msg . $return_links['list'] . $return_links['index']);
	}
	else if (isset($_POST['cancel']))
	{
		redirect(append_sid("admin/$list_link", true));
	}
	else
	{
		// if you don't have admin/confirm_body.tpl (it was added in phpBB 2.0.20),
		// just delete "admin/" in the following code
		$template->set_filenames(array(
			'body' => 'admin/confirm_body.tpl')
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

		include_once('./page_header_admin.' . $phpEx);
		$template->pparse('body');
		include_once('./page_footer_admin.' . $phpEx);
	}
}
else
{
	$opened_cat = (isset($_GET[POST_CAT_URL])) ? '&amp;' . POST_CAT_URL . '=' . $_GET[POST_CAT_URL] : '';

	$template->set_filenames(array(
		'body' => 'admin/report_list_body.tpl')
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
		'LINK' => append_sid("admin_report_list.$phpEx"),
		'COUNT' => $count_output,
		'COUNT_NOT_CLEARED' => $all_reports['report_count'][REPORT_NOT_CLEARED],
		'COUNT_IN_PROCESS' => $all_reports['report_count'][REPORT_IN_PROCESS],
		'COUNT_CLEARED' => $all_reports['report_count'][REPORT_CLEARED])
	);

	foreach ($report_data['cats'] as $this_cat)
	{
		// Category link
		$link = append_sid("admin_report_list.$phpEx?" . POST_CAT_URL . '=' . $this_cat['cat_id']);

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
			$u_delete_all = append_sid("admin_report_list.$phpEx?mode=deleteall&amp;id=" . $this_cat['cat_id'] . $opened_cat);

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
					$temp_url = append_sid("admin_report_list.$phpEx?mode=unclear&amp;id=" . $this_report['report_id'] . $opened_cat);
					$report_status_not_cleared = '<a href="' . $temp_url . '" class="genmed" style="' . $style . '">' . $lang['Report_status_not_cleared'] . '</a>';

					$style = 'color: ' . $board_config['report_color_in_process'] . (($this_report['report_status'] == REPORT_IN_PROCESS) ? '; font-weight: bold' : '');
					$temp_url = append_sid("admin_report_list.$phpEx?mode=process&amp;id=" . $this_report['report_id'] . $opened_cat);
					$report_status_in_process = '<a href="' . $temp_url . '" class="genmed" style="' . $style . '">' . $lang['Report_status_in_process'] . '</a>';

					$style = 'color: ' . $board_config['report_color_cleared'] . (($this_report['report_status'] == REPORT_CLEARED) ? '; font-weight: bold' : '');
					$temp_url = append_sid("admin_report_list.$phpEx?mode=clear&amp;id=" . $this_report['report_id'] . $opened_cat);
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
						$report_info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $this_report['topic_title'] . '</a>';
					}
					else if ($this_cat['cat_id'] == REPORT_TOPIC_ID && $this_report['topic_title'])
					{
						$temp_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $this_report['report_info']);
						$report_info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $this_report['topic_title'] . '</a>';
					}
					else if ($this_cat['cat_id'] == REPORT_USER_ID && $this_report['username'])
					{
						$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $this_report['report_info']);
						$report_info = '<a href="' . $temp_url . '" class="genmed" target="_blank">' . $this_report['username'] . '</a>';
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
						'U_DELETE' => append_sid("admin_report_list.$phpEx?mode=delete&amp;id=" . $this_report['report_id'] . $opened_cat),
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

	include_once('./page_header_admin.' . $phpEx);
	$template->pparse('body');
	include_once('./page_footer_admin.' . $phpEx);
}

?>
