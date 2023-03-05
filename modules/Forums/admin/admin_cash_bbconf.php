<?php
/***************************************************************************
 *                              cash_config.php
 *                            -------------------
 *   begin                : Thursday, Apr 17, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_config.php,v 1.0.7.0 2003/09/09 23:33:01 Xore $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);
define('IN_CASHMOD', 1);

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$phpbb['Cash/Shop Mod']['Cash_Configuration'] = "$file?mode=bbconf";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
include_once("../../../includes/functions_selects.php");

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;

	include_once('admin_cash.' . $phpEx);

}
$new = array();
$new_cash = array();
$num_currencies = 0;
$good_order = true;
$reset_navbar = "";
//
// Pull all config data
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if ( !$result = $db->sql_query($sql) )
{
	message_die(CRITICAL_ERROR, "Could not query config information in cash_config", "", __LINE__, __FILE__, $sql);
}
$allowed_array = array( 'cash_disable' => true,
						'cash_adminbig' => true,
						'cash_adminnavbar' => true,
						'cash_display_after_posts' => true,
						'cash_post_message' => true,
						'cash_disable_spam_num' => true,
						'cash_disable_spam_time' => true,
						'cash_disable_spam_message' => true);
while ( $row = $db->sql_fetchrow($result) )
{
	$config_name = $row['config_name'];
	$config_value = $row['config_value'];
	$default_config[$config_name] = $config_value;
	
	$new[$config_name] = $default_config[$config_name];

	if ( $allowed_array[$config_name] &&
		 isset($_POST['submit']) &&
		 isset($_POST['set']) &&
		 ($_POST['set'] == "general") &&
		 isset($_POST[$config_name]) )
	{
		if ( ($config_name == "cash_adminbig") && ($new[$config_name] != stripslashes($_POST[$config_name])) )
		{
			$reset_navbar = "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\nparent.nav.location.reload();\n//-->\n</script>";
		}
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . str_replace("\'", "''", $_POST[$config_name]) . "'
			WHERE config_name = '$config_name'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Failed to update Cash Mod configuration for $config_name", "", __LINE__, __FILE__, $sql);
		}
	}
}
	
if ( isset($_POST['submit']) )
{
	$message = $lang['Cash_config_updated'] . $reset_navbar . "<br /><br />" . sprintf($lang['Click_return_cash_config'], "<a href=\"" . append_sid("admin_cash_bbconf.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}

$admin_big = ( $new['cash_adminbig'] ) ? "checked=\"checked\"" : "";
$admin_small = ( !$new['cash_adminbig'] ) ? "checked=\"checked\"" : "";

$adminnavbar_yes = ( $new['cash_adminnavbar'] ) ? "checked=\"checked\"" : "";
$adminnavbar_no = ( !$new['cash_adminnavbar'] ) ? "checked=\"checked\"" : "";

$disable_cash_yes = ( $new['cash_disable'] ) ? "checked=\"checked\"" : "";
$disable_cash_no = ( !$new['cash_disable'] ) ? "checked=\"checked\"" : "";

$display_after_posts_yes = ( $new['cash_display_after_posts'] ) ? "checked=\"checked\"" : "";
$display_after_posts_no = ( !$new['cash_display_after_posts'] ) ? "checked=\"checked\"" : "";

$template->set_filenames(array(
	"body" => "admin/cash_config.tpl")
);

$template->assign_vars(array(
	"S_CASH_CONFIG_ACTION" => append_sid("admin_cash_bbconf.$phpEx"),

	"L_CASH_SETTINGS" => $lang['Cash_settings'],
	"L_MESSAGES" => $lang['Messages'],
	"L_SPAM" => $lang['Spam'],

	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_CASH_CONFIGURATION_TITLE" => $lang['Cash_config'],
	"L_CASH_CONFIGURATION_EXPLAIN" => $lang['Cash_config_explain'],
	"L_CASH_DISABLED" => $lang['Cash_disabled'],

	"L_CASH_MESSAGE" => $lang['Cash_message'],
	"L_CASH_DISPLAY_MESSAGE" => $lang['Cash_display_message'],
	"L_CASH_DISPLAY_MESSAGE_EXPLAIN" => $lang['Cash_display_message_explain'],
	"L_CASH_SPAM_DISABLE_NUM" => $lang['Cash_spam_disable_num'],
	"L_CASH_SPAM_DISABLE_TIME" => $lang['Cash_spam_disable_time'],
	"L_CASH_SPAM_DISABLE_MESSAGE" => $lang['Cash_spam_disable_message'],

	"L_CASH_ADMINCP" => $lang['Cash_admincp'],
	"L_CASH_ADMINNAVBAR" => $lang['Cash_adminnavbar'],
	"L_SIDEBAR" => $lang['Sidebar'],
	"L_MENU" => $lang['Menu'],

	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'], 

	"DISABLE_CASH_YES" => $disable_cash_yes,
	"DISABLE_CASH_NO" => $disable_cash_no,
	"DISPLAY_AFTER_POSTS_YES" => $display_after_posts_yes,
	"DISPLAY_AFTER_POSTS_NO" => $display_after_posts_no,
	"POST_MESSAGE" => $new['cash_post_message'],
	"DISABLE_SPAM_NUM" => $new['cash_disable_spam_num'],
	"DISABLE_SPAM_TIME" => $new['cash_disable_spam_time'],
	"DISABLE_SPAM_MESSAGE" => $new['cash_disable_spam_message'],
	
	"ADMIN_BIG" => $admin_big,
	"ADMIN_SMALL" => $admin_small,
	"ADMINNAVBAR_YES" => $adminnavbar_yes,
	"ADMINNAVBAR_NO" => $adminnavbar_no)
	
);

$template->pparse("body");


include_once('./page_footer_admin.' . $phpEx);


?>
