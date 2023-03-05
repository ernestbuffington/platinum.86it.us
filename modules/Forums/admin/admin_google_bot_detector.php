<?php

define('IN_PHPBB', true);

if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Platinum MODs']['Google Bot Detector'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('pagestart.' . $phpEx);

if (isset($_POST['clear']))
{
	$sql = "DELETE FROM " .GOOGLE_BOT_DETECTOR_TABLE;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
	}
	$message = $lang['Detector_Cleared'] . "<br /><br />" . sprintf($lang['Click_Return_Detector'], "<a href=\"" . append_sid("admin_google_bot_detector.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}

$start = (isset($_GET['start'])) ? intval($_GET['start']) : 0;

$template->set_filenames(array(
	"body" => "admin/google_bot_detector_body.tpl")
);

$sql = "SELECT * FROM " .GOOGLE_BOT_DETECTOR_TABLE ." ORDER BY detect_time DESC";

if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, 'Could not obtain detect information', '', __LINE__, __FILE__, $sql);
	unset($total_row);
}
else
{
	$total_row = $db->sql_numrows($result);
}

if (isset($total_row))
{
	$pagination = generate_pagination(append_sid("admin_google_bot_detector.$phpEx"), $total_row, $board_config['posts_per_page'], $start).'&nbsp;';
}

$db->sql_freeresult($result);

$sql .= " LIMIT " .$start .", " .$board_config['posts_per_page'];
if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, 'Could not obtain detect information', '', __LINE__, __FILE__, $sql);
}

if ($row = $db->sql_fetchrow($result))
{
	$i = $start;
	do
	{
		$i++;
		$template->assign_block_vars('detector', array(
			"ID" => $i,
			"TIME" => sprintf(create_date($board_config['default_dateformat'], $row['detect_time'], $board_config['board_timezone'])),
			"URL" => $row['detect_url'],
		));
	}
	while ($row = $db->sql_fetchrow($result));

	$template->assign_block_vars('page', array(
		'PAGINATION' => $pagination,
		'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $board_config['posts_per_page']) + 1), ceil($total_row / $board_config['posts_per_page']))
	));
}
else
{
	$template->assign_block_vars('nobot', array(
		"L_EXPLAIN" => $lang['Detector_No_Bot'],
	));
}

$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];

$template->assign_vars(array(
	"S_ACTION" => append_sid("admin_google_bot_detector.$phpEx"),

	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],

	"L_CLEAR" => $lang['Detector_Clear'], 
	"L_DETECTOR_TITLE" => $lang['Detector'],
	"L_DETECTOR_EXPLAIN" => $lang['Detector_Explain'] .sprintf($lang['All_times'], $l_timezone),
	"L_DETECTOR_ID" => $lang['Detector_ID'],
	"L_DETECTOR_TIME" => $lang['Detector_Time'],
	"L_DETECTOR_URL" => $lang['Detector_Url'],
));

$template->pparse("body");

include_once('./page_footer_admin.'.$phpEx);

?>
