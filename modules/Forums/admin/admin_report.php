<?php

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Reports']['Configuration'] = $filename;

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
include_once('./../../../includes/bbcode.' . $phpEx);
include_once('../../../includes/functions_report.php');

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
$return_links['catadmin'] = '<br /><br />' . sprintf($lang['Click_return_catadmin'], '<a href="' . append_sid("admin_report.$phpEx") . '">', '</a>');

$template->assign_vars(array(
	'S_ACTION' => append_sid("admin_report.$phpEx"),

	'L_REPORTS_TITLE' => $lang['Report_Admin_title'],
	'L_REPORTS_EXPLAIN' => $lang['Report_Admin_explain'],

	'L_CAT' => $lang['Category'],
	'L_DELETE' => $lang['Delete'],
	'L_EDIT' => $lang['Edit'],
	'L_CREATE' => $lang['Create_category'],
	'L_COUNT' => $lang['Report_count'],
	'L_EXPLAIN' => $lang['Description'],
	'L_AUTH' => $lang['Authorisation'],
	'L_TYPE' => $lang['Type'],
	'L_TYPE_NORMAL' => $lang['Report_Type_normal'],
	'L_TYPE_EXT' => $lang['Report_Type_extension'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],

	'L_CONFIG' => $lang['Configuration'],
	'L_COLOR_NOT_CLEARED' => $lang['Report_color_not_cleared'],
	'L_COLOR_IN_PROCESS' => $lang['Report_color_in_process'],
	'L_COLOR_CLEARED' => $lang['Report_color_cleared'],
	'L_REPORT_LIST' => $lang['Reportlist_type'],
	'L_LIST_ACP' => $lang['Reportlist_type_admin'],
	'L_LIST_EXT' => $lang['Reportlist_type_external'],
	'L_NOTIFY' => $lang['Report_notify'],
	'L_NOTIFY_OFF' => $lang['OFF'],
	'L_ADMINS_MODS' => $lang['Administrators_moderators'],
	'L_ADMINS' => $lang['Only_administrators'])
);

if ($mode == 'create' && isset($_POST['submit']) && !empty($_POST['name']))
{
	insert_report_cat(stripslashes($_POST['name']), stripslashes($_POST['explain']), $_POST['type'], $_POST['auth']);
	message_die(GENERAL_MESSAGE, $lang['Category_created'] . $return_links['catadmin'] . $return_links['index']);
}
else if ($mode == 'create')
{
	$template->set_filenames(array(
		'body' => 'admin/report_cat_edit_body.tpl')
	);

	// Error-Messages
	if (isset($_POST['submit']))
	{
		$error_msg = array();
		if (empty($_POST['name']))
		{
			$error_msg[] = $lang['No_name_entered'];
		}
		if ($msg = report_prepare_errors($error_msg))
		{
			$template->assign_block_vars('switch_error_msg', array(
				'ERROR_MSG' => $msg)
			);
		}
	}

	$hidden_fields = '<input type="hidden" name="mode" value="create" />';

	$cat = array(
		'cat_name' => (isset($_POST['name'])) ? htmlspecialchars(stripslashes($_POST['name'])) : '',
		'cat_explain' => (isset($_POST['explain'])) ? htmlspecialchars(stripslashes($_POST['explain'])) : '',
		'cat_type' => (isset($_POST['type'])) ? intval($_POST['type']) : REPORT_NORMAL,
		'cat_auth' => (isset($_POST['auth'])) ? intval($_POST['auth']) : 0
	);

	$template->assign_vars(array(
		'NAME' => $cat['cat_name'],
		'EXPLAIN' => $cat['cat_explain'],
		'TYPE_NORMAL' => ($cat['cat_type'] == REPORT_NORMAL) ? ' checked="checked"' : '',
		'TYPE_EXT' => ($cat['cat_type'] == REPORT_EXT) ? ' checked="checked"' : '',
		'AUTH_ADMINS_MODS' => ($cat['cat_auth'] == 0) ? ' checked="checked"' : '',
		'AUTH_ADMINS' => ($cat['cat_auth'] == 1) ? ' checked="checked"' : '',
		'L_EDIT_CREATE' => $lang['Create_category'],
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);
}
else if ($mode == 'edit' && is_numeric($id) && isset($_POST['submit']) && !empty($_POST['name']))
{
	update_report_cat($id, stripslashes($_POST['name']), stripslashes($_POST['explain']), $_POST['type'], $_POST['auth']);
	message_die(GENERAL_MESSAGE, $lang['Category_edited'] . $return_links['catadmin'] . $return_links['index']);
}
else if ($mode == 'edit' && is_numeric($id))
{
	$template->set_filenames(array(
		'body' => 'admin/report_cat_edit_body.tpl')
	);

	// Error-Messages
	if (isset($_POST['submit']))
	{
		$error_msg = array();
		if (empty($_POST['name']))
		{
			$error_msg[] = $lang['No_name_entered'];
		}
		if ($msg = report_prepare_errors($error_msg))
		{
			$template->assign_block_vars('switch_error_msg', array(
				'ERROR_MSG' => $msg)
			);
		}
	}

	$hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="id" value="' . $id . '" />';

	$cat = obtain_report_cats('cat', $id);
	$cat = array(
		'cat_name' => (isset($_POST['name'])) ? htmlspecialchars(stripslashes($_POST['name'])) : $cat['cat_name'],
		'cat_explain' => (isset($_POST['explain'])) ? htmlspecialchars(stripslashes($_POST['explain'])) : $cat['cat_explain'],
		'cat_type' => (isset($_POST['type'])) ? intval($_POST['type']) : $cat['cat_type'],
		'cat_auth' => (isset($_POST['auth'])) ? intval($_POST['auth']) : $cat['cat_auth']
	);

	$template->assign_vars(array(
		'NAME' => $cat['cat_name'],
		'EXPLAIN' => $cat['cat_explain'],
		'TYPE_NORMAL' => ($cat['cat_type'] == REPORT_NORMAL) ? ' checked="checked"' : '',
		'TYPE_EXT' => ($cat['cat_type'] == REPORT_EXT) ? ' checked="checked"' : '',
		'AUTH_ADMINS_MODS' => ($cat['cat_auth'] == 0) ? ' checked="checked"' : '',
		'AUTH_ADMINS' => ($cat['cat_auth'] == 1) ? ' checked="checked"' : '',
		'L_EDIT_CREATE' => $lang['Edit_Category'],
		'S_HIDDEN_FIELDS' => $hidden_fields)
	);
}
else if ($mode == 'delete' && is_numeric($id))
{
	if (isset($_POST['confirm']))
	{
		if (isset($_POST['moveto']) && $_POST['moveto'] > -1)
		{
			delete_report_cat('move', $id, $_POST['moveto']);
		}
		else
		{
			delete_report_cat('delete', $id);
		}

		message_die(GENERAL_MESSAGE, $lang['Category_deleted'] . $return_links['catadmin'] . $return_links['index']);
	}
	else if (isset($_POST['cancel']))
	{
		redirect(append_sid("admin/admin_report.$phpEx", true));
	}
	else
	{
		$template->set_filenames(array(
			'body' => 'admin/report_cat_delete_body.tpl')
		);

		$hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $id . '" />';

		// Build Cat Select
		$msg = $lang['Confirm_delete_category'];
		if ($cats = obtain_report_cats('all', $id))
		{
			$cat_select = '<select name="moveto"><option value="-1">' . $lang['Reports_delete'] . '</option>';
			foreach ($cats as $this_cat)
			{
				$title = sprintf($lang['Reports_move'], $this_cat['cat_name']);
				$cat_select .= '<option value="' . $this_cat['cat_id'] . '">' . $title . '</option>';
			}
			$cat_select .= '</select>';

			$template->assign_block_vars('switch_cat_select', array());
			$template->assign_var('CAT_SELECT', $cat_select);
		}
		else
		{
			$msg .= $lang['Confirm_delete_category_reportdel'];
		}

		$template->assign_vars(array(
		  'S_CONFIRM_ACTION' => append_sid("admin_report.$phpEx"),
		  'MESSAGE_TITLE' => $lang['Confirm'],
		  'MESSAGE_TEXT' => $msg,
		  'S_HIDDEN_FIELDS' => $hidden_fields,
		  'L_YES' => $lang['Yes'],
		  'L_NO' => $lang['No'])
		);

		include_once('./page_header_admin.'.$phpEx);
		$template->pparse('body');
		include_once('./page_footer_admin.'.$phpEx);
	}
}
else if (isset($_POST['submit']))
{
	$keys = array('report_color_not_cleared', 'report_color_in_process', 'report_color_cleared', 'report_list', 'report_notify');

	foreach ($keys as $key)
	{
		if (isset($_POST[$key]))
		{
			$sql = 'UPDATE ' . CONFIG_TABLE . " SET config_value = '" . str_replace("\'", "''", trim($_POST[$key])) . "'
				WHERE config_name = '$key'";
			if(!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not update report config', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	message_die(GENERAL_MESSAGE, $lang['Config_updated'] . $return_links['catadmin'] . $return_links['index']);
}
else
{
	$template->set_filenames(array(
		'body' => 'admin/report_body.tpl')
	);

	// List
	$cats = array();
	$count_cat = 0;
	$count_ext = 0;
	if ($cats = obtain_report_cats('all'))
	{
		foreach ($cats as $cat)
		{
			switch ($cat['cat_type'])
			{
				case REPORT_EXT:
					$row = 'extrow';
					$count_ext++;
					break;
				default:
					$row = 'catrow';
					$count_cat++;
					break;
			}
	
			$template->assign_block_vars($row, array(
				'ID' => $cat['cat_id'],
				'NAME' => $cat['cat_name'],
				'EXPLAIN' => $cat['cat_explain'],
				'COUNT' => $cat['report_count'],
				'U_EDIT' => append_sid("admin_report.$phpEx?mode=edit&amp;id=" . $cat['cat_id']),
				'U_DELETE' =>  append_sid("admin_report.$phpEx?mode=delete&amp;id=" . $cat['cat_id']))
			);
		}
	}

	$template->assign_vars(array(
		'L_CAT_STD' => ($count_cat == 0) ? $lang['No_standard_categories'] : $lang['Standard_categories'],
		'L_CAT_EXT' => ($count_ext == 0) ? $lang['No_extension_categories'] : $lang['Extension_categories'],
		'U_CREATE' => append_sid("admin_report.$phpEx?mode=create"),

		'LIST_ACP' => ($board_config['report_list'] == 1) ? ' checked="checked"' : '',
		'LIST_EXT' => ($board_config['report_list'] == 0) ? ' checked="checked"' : '',
		'COLOR_NOT_CLEARED' => $board_config['report_color_not_cleared'],
		'COLOR_IN_PROCESS' => $board_config['report_color_in_process'],
		'COLOR_CLEARED' => $board_config['report_color_cleared'],
		'NOTIFY_OFF' => ($board_config['report_notify'] == 0) ? ' checked="checked"' : '',
		'NOTIFY_ADMINS_MODS' => ($board_config['report_notify'] == 1) ? ' checked="checked"' : '',
		'NOTIFY_ADMINS' => ($board_config['report_notify'] == 2) ? ' checked="checked"' : '')
	);
}

include_once('./page_header_admin.' . $phpEx);
$template->pparse('body');
include_once('./page_footer_admin.' . $phpEx);

?>
