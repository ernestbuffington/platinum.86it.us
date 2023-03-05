<?php

define('IN_PHPBB', 1);

// modules
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Reset_User_Level'] = $filename;
	
	return;
}

// declarations
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
include_once ($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_resetuser.'.$phpEx);


// verify username
if( isset($_POST['resetuser']) || isset($_GET['resetuser']) )
{
	$reset_username = ( isset($_POST['resetuser']) ) ? $_POST['resetuser'] : $_GET['resetuser'];

	// don't reset yourself
	if ( $reset_username == $userdata['username'] )
	{
		$msg = $lang['Reset_noself'];

		message_die(GENERAL_MESSAGE, $msg);
	}

	// make sure user exists
	if( !$this_userdata = get_userdata($reset_username) )
	{
		$msg = sprintf($lang['Reset_nouser'], $reset_username);

		message_die(GENERAL_MESSAGE, $msg);
	}

	if( $_POST['reset'] )
	{
		$sql = "UPDATE " . USERS_TABLE . " 
				SET user_level = " . USER . " 
				WHERE username = '" . $reset_username ."'";

		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to update the database", "Error", __LINE__, __FILE__, $sql);
		}

		$msg = sprintf($lang['Reset_success'], $reset_username);

		message_die(GENERAL_MESSAGE, $msg);

		$s_hidden_fields = '<input type="hidden" name="username" value="' . $reset_username . '" />';
	}
}
else
{
	$reset_username = '';
	$s_hidden_fields = '';
}

$template->set_filenames(array(
	'body' => 'admin/resetuser_body.tpl')
);

$template->assign_vars(array(
	'RESETUSER' => $reset_username,
	
	'L_RESETUSER_TITLE' => $lang['Reset_user_level'],
	'L_RESETUSER_EXPLAIN' => $lang['Reset_user_explain'],
	'L_RESETUSER_HEADER' => $lang['Reset_user_header'],
	'L_RESETUSER_NAME' => $lang['Reset_user_name'],
	'L_RESET' => $lang['Reset'],

	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'S_USER_ACTION' => append_sid("admin_resetuser.$phpEx"),
	'S_USER_SELECT' => $select_list)
);


$template->pparse('body');

include_once('./page_footer_admin.'.$phpEx);

?>
