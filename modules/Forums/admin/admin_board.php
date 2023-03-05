<?php
/***************************************************************************
 *                              admin_board.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_board.php,v 1.51.2.9 2004/11/18 17:49:33 acydburn Exp
 *
 *
 ***************************************************************************/
/***************************************************************************
 * Platinum Nuke Pro: Expect to be impressed                      COPYRIGHT
 *
 * Copyright (c) 2004 - 2006 by http://www.techgfx.com
 *     Techgfx - Graeme Allan                       (goose@techgfx.com)
 *
 * Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de
 *     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de)
 *
 * Refer to TechGFX.com for detailed information on Platinum Nuke Pro
 *
 * TechGFX: Your dreams, our imagination
 ***************************************************************************/
define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
        $module['General']['Configuration'] = $file;
	return;
}
//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
include_once("../../../includes/functions_selects.php");
//
// Pull all config data
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];
		if ($config_name == 'cookie_name')
		{
			$new['cookie_name'] = str_replace('.', '_', $new['cookie_name']);
		}
		// Attempt to prevent a common mistake with this value,
		// http:// is the protocol and not part of the server name
		if ($config_name == 'server_name')
		{
			$new['server_name'] = str_replace('http://', '', $new['server_name']);
		}
		// Attempt to prevent a mistake with this value.
		if ($config_name == 'avatar_path')
		{
			$new['avatar_path'] = trim($new['avatar_path']);
			if (strstr($new['avatar_path'], "\0") || !is_dir($phpbb_root_path . $new['avatar_path']) || !is_writable($phpbb_root_path . $new['avatar_path']))
			{
				$new['avatar_path'] = $default_config['avatar_path'];
			}
		}
		if( isset($_POST['submit']) )
		{
			$sql = "UPDATE " . CONFIG_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}
	if( isset($_POST['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
	}
}
$style_select = style_select($new['default_style'], 'default_style', "../templates");
$lang_select = language_select($new['default_lang'], 'default_lang', "../language");
$timezone_select = tz_select($new['board_timezone'], 'board_timezone');
$disable_board_yes = ( $new['board_disable'] ) ? "checked=\"checked\"" : "";
$disable_board_no = ( !$new['board_disable'] ) ? "checked=\"checked\"" : "";
$cookie_secure_yes = ( $new['cookie_secure'] ) ? "checked=\"checked\"" : "";
$cookie_secure_no = ( !$new['cookie_secure'] ) ? "checked=\"checked\"" : "";
$html_tags = $new['allow_html_tags'];
$override_user_style_yes = ( $new['override_user_style'] ) ? "checked=\"checked\"" : "";
$override_user_style_no = ( !$new['override_user_style'] ) ? "checked=\"checked\"" : "";
$html_yes = ( $new['allow_html'] ) ? "checked=\"checked\"" : "";
$html_no = ( !$new['allow_html'] ) ? "checked=\"checked\"" : "";
$bbcode_yes = ( $new['allow_bbcode'] ) ? "checked=\"checked\"" : "";
$bbcode_no = ( !$new['allow_bbcode'] ) ? "checked=\"checked\"" : "";
$activation_none = ( $new['require_activation'] == USER_ACTIVATION_NONE ) ? "checked=\"checked\"" : "";
$activation_user = ( $new['require_activation'] == USER_ACTIVATION_SELF ) ? "checked=\"checked\"" : "";
$activation_admin = ( $new['require_activation'] == USER_ACTIVATION_ADMIN ) ? "checked=\"checked\"" : "";
$confirm_yes = ($new['enable_confirm']) ? 'checked="checked"' : '';
$confirm_no = (!$new['enable_confirm']) ? 'checked="checked"' : '';
$board_email_form_yes = ( $new['board_email_form'] ) ? "checked=\"checked\"" : "";
$board_email_form_no = ( !$new['board_email_form'] ) ? "checked=\"checked\"" : "";
// Hide Links start
$mods_priority_yes = ( $new['mods_priority'] ) ? "checked=\"checked\"" : "";
$mods_priority_no = ( !$new['mods_priority'] ) ? "checked=\"checked\"" : "";
// Hide Links end
$allow_autologin_yes = ($new['allow_autologin']) ? 'checked="checked"' : '';
$allow_autologin_no = (!$new['allow_autologin']) ? 'checked="checked"' : '';
$gzip_yes = ( $new['gzip_compress'] ) ? "checked=\"checked\"" : "";
$gzip_no = ( !$new['gzip_compress'] ) ? "checked=\"checked\"" : "";
$privmsg_on = ( !$new['privmsg_disable'] ) ? "checked=\"checked\"" : "";
$privmsg_off = ( $new['privmsg_disable'] ) ? "checked=\"checked\"" : "";
$prune_yes = ( $new['prune_enable'] ) ? "checked=\"checked\"" : "";
$prune_no = ( !$new['prune_enable'] ) ? "checked=\"checked\"" : "";
// Start add - Birthday MOD
$birthday_greeting_yes = ( $new['birthday_greeting'] ) ? "checked=\"checked\"" : "";
$birthday_greeting_no = ( !$new['birthday_greeting'] ) ? "checked=\"checked\"" : "";
$birthday_required_yes = ( $new['birthday_required'] ) ? "checked=\"checked\"" : "";
$birthday_required_no = ( !$new['birthday_required'] ) ? "checked=\"checked\"" : "";
// End add - Birthday MOD
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5              START */
/*****************************************************/
$ropm_quick_reply_yes = ( $new['ropm_quick_reply'] ) ? "checked=\"checked\"" : "";
$ropm_quick_reply_no = ( !$new['ropm_quick_reply'] ) ? "checked=\"checked\"" : "";
$ropm_quick_reply_bbc_yes = ( $new['ropm_quick_reply_bbc'] ) ? "checked=\"checked\"" : "";
$ropm_quick_reply_bbc_no = ( !$new['ropm_quick_reply_bbc'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5                END */
/*****************************************************/
$smile_yes = ( $new['allow_smilies'] ) ? "checked=\"checked\"" : "";
$smile_no = ( !$new['allow_smilies'] ) ? "checked=\"checked\"" : "";
$sig_yes = ( $new['allow_sig'] ) ? "checked=\"checked\"" : "";
$sig_no = ( !$new['allow_sig'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
$sig_perpage_yes = ( $new['sig_perpage'] ) ? "checked=\"checked\"" : "";
$sig_perpage_no = ( !$new['sig_perpage'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
$namechange_yes = ( $new['allow_namechange'] ) ? "checked=\"checked\"" : "";
$namechange_no = ( !$new['allow_namechange'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0  START */
/*****************************************************/
$guests_need_name_yes = ( $new['guests_need_name'] ) ? "checked=\"checked\"" : "";
$guests_need_name_no = ( !$new['guests_need_name'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0    END */
/*****************************************************/
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                 START */
/*****************************************************/
$quickreply_yes = ( $new['allow_quickreply'] ) ? "checked=\"checked\"" : "";
$quickreply_no = ( !$new['allow_quickreply'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                  END  */
/*****************************************************/
$avatars_local_yes = ( $new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_local_no = ( !$new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_remote_yes = ( $new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_remote_no = ( !$new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_upload_yes = ( $new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
$avatars_upload_no = ( !$new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
$smtp_yes = ( $new['smtp_delivery'] ) ? "checked=\"checked\"" : "";
$smtp_no = ( !$new['smtp_delivery'] ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2          START */
/*****************************************************/
$move_when_locked_off = ( $new['move_when_locked_stat'] == -1 ) ? "checked=\"checked\"" : "";
$move_when_locked_on = ( $new['move_when_locked_stat'] == 1 ) ? "checked=\"checked\"" : "";
$leave_special_topic_no = ($new['leave_special_topic_stat'] == -1 ) ? "checked=\"checked\"" : "";
$leave_special_topic_anno = ($new['leave_special_topic_stat'] == 1 ) ? "checked=\"checked\"" : "";
$leave_special_topic_both = ($new['leave_special_topic_stat'] == 2 ) ? "checked=\"checked\"" : "";
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2            END */
/*****************************************************/
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
$split_announce_yes = ( $new['split_announce'] ) ? "checked=\"checked\"" : "";
$split_announce_no  = (!$new['split_announce'] ) ? "checked=\"checked\"" : "";
$split_sticky_yes   = ( $new['split_sticky'] )   ? "checked=\"checked\"" : "";
$split_sticky_no    = (!$new['split_sticky'] )   ? "checked=\"checked\"" : "";
if ( isset($lang['Post_global_announcement']) )
{
    $split_global_announce_yes = ( $new['split_global_announce'] ) ? "checked=\"checked\"" : "";
    $split_global_announce_no  = (!$new['split_global_announce'] ) ? "checked=\"checked\"" : "";
}
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
$template->set_filenames(array(
	"body" => "admin/board_config_body.tpl")
);
//
// Escape any quotes in the site description for proper display in the text
// box on the admin page
//
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1  START */
/*****************************************************/
$new['sig_line'] = str_replace('"', '&quot;', $new['sig_line']);
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1    END */
/*****************************************************/
$template->assign_vars(array(
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
	"L_ANNOUNCEMENT_SETTINGS" => $lang['Announce_settings'],
	"L_SPLIT_ANNOUNCE"        => $lang['split_announce'],
	"SPLIT_ANNOUNCE_YES"      => $split_announce_yes,
	"SPLIT_ANNOUNCE_NO"       => $split_announce_no,
	"L_SPLIT_STICKY"          => $lang['split_sticky'],
	"SPLIT_STICKY_YES"        => $split_sticky_yes,
	"SPLIT_STICKY_NO"         => $split_sticky_no,
	"L_SPLIT_GLOBAL_ANNOUNCE" => $lang['split_global_announce'],
	"SPLIT_GLOBAL_ANNOUNCE_YES" => $split_global_announce_yes,
	"SPLIT_GLOBAL_ANNOUNCE_NO" => $split_global_announce_no,
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
	"S_CONFIG_ACTION" => append_sid("admin_board.$phpEx"),
	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_CONFIGURATION_TITLE" => $lang['General_Config'],
	"L_CONFIGURATION_EXPLAIN" => $lang['Config_explain'],
	"L_GENERAL_SETTINGS" => $lang['General_settings'],
        "L_SERVER_NAME" => $lang['Server_name'],
        "L_SERVER_NAME_EXPLAIN" => $lang['Server_name_explain'],
        "L_SERVER_PORT" => $lang['Server_port'],
        "L_SERVER_PORT_EXPLAIN" => $lang['Server_port_explain'],
        "L_SCRIPT_PATH" => $lang['Script_path'],
        "L_SCRIPT_PATH_EXPLAIN" => $lang['Script_path_explain'],
	"L_SITE_NAME" => $lang['Site_name'],
	"L_SITE_DESCRIPTION" => $lang['Site_desc'],
        "L_DISABLE_BOARD" => $lang['Board_disable'],
        "L_DISABLE_BOARD_EXPLAIN" => $lang['Board_disable_explain'],
        "L_ACCT_ACTIVATION" => $lang['Acct_activation'],
        "L_NONE" => $lang['Acc_None'],
        "L_USER" => $lang['Acc_User'],
        "L_ADMIN" => $lang['Acc_Admin'],
	"L_VISUAL_CONFIRM" => $lang['Visual_confirm'],
	"L_VISUAL_CONFIRM_EXPLAIN" => $lang['Visual_confirm_explain'],
   "L_ALLOW_AUTOLOGIN" => $lang['Allow_autologin'],
   "L_ALLOW_AUTOLOGIN_EXPLAIN" => $lang['Allow_autologin_explain'],
   "L_AUTOLOGIN_TIME" => $lang['Autologin_time'],
   "L_AUTOLOGIN_TIME_EXPLAIN" => $lang['Autologin_time_explain'],
        "L_COOKIE_SETTINGS" => $lang['Cookie_settings'],
        "L_COOKIE_SETTINGS_EXPLAIN" => $lang['Cookie_settings_explain'],
	"L_COOKIE_DOMAIN" => $lang['Cookie_domain'],
        "L_COOKIE_NAME" => $lang['Cookie_name'],
        "L_COOKIE_PATH" => $lang['Cookie_path'],
        "L_COOKIE_SECURE" => $lang['Cookie_secure'],
        "L_COOKIE_SECURE_EXPLAIN" => $lang['Cookie_secure_explain'],
        "L_SESSION_LENGTH" => $lang['Session_length'],
        "L_PRIVATE_MESSAGING" => $lang['Private_Messaging'],
        "L_INBOX_LIMIT" => $lang['Inbox_limits'],
        "L_SENTBOX_LIMIT" => $lang['Sentbox_limits'],
        "L_SAVEBOX_LIMIT" => $lang['Savebox_limits'],
        "L_DISABLE_PRIVATE_MESSAGING" => $lang['Disable_privmsg'],
        "L_ENABLED" => $lang['Enabled'],
        "L_DISABLED" => $lang['Disabled'],
	"L_ABILITIES_SETTINGS" => $lang['Abilities_settings'],
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2          START */
/*****************************************************/
	"L_WHO_IS_ONLINE_TIME" => $lang['who_is_online_time'],
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2            END */
/*****************************************************/
	"L_MAX_POLL_OPTIONS" => $lang['Max_poll_options'],
	"L_FLOOD_INTERVAL" => $lang['Flood_Interval'],
        "L_FLOOD_INTERVAL_EXPLAIN" => $lang['Flood_Interval_explain'],
//  2.0.20 update begin
	"L_SEARCH_FLOOD_INTERVAL" => $lang['Search_Flood_Interval'],
	"L_SEARCH_FLOOD_INTERVAL_EXPLAIN" => $lang['Search_Flood_Interval_explain'],
//  2.0.20 update end
//  2.0.19 update begin
        'L_MAX_LOGIN_ATTEMPTS'         => $lang['Max_login_attempts'],
        'L_MAX_LOGIN_ATTEMPTS_EXPLAIN'   => $lang['Max_login_attempts_explain'],
        'L_LOGIN_RESET_TIME'         => $lang['Login_reset_time'],
        'L_LOGIN_RESET_TIME_EXPLAIN'   => $lang['Login_reset_time_explain'],
        'MAX_LOGIN_ATTEMPTS'         => $new['max_login_attempts'],
        'LOGIN_RESET_TIME'            => $new['login_reset_time'],
// 2.0.19 END
        "L_BOARD_EMAIL_FORM" => $lang['Board_email_form'],
        "L_BOARD_EMAIL_FORM_EXPLAIN" => $lang['Board_email_form_explain'],
	"L_TOPICS_PER_PAGE" => $lang['Topics_per_page'],
	"L_POSTS_PER_PAGE" => $lang['Posts_per_page'],
	"L_HOT_THRESHOLD" => $lang['Hot_threshold'],
	// Hide Links Start
	"L_NECESSARY_POST_NUMBER" => $lang['Necessary_Post_Number'],
	"L_MODS_PRIORITY" => $lang['Mods_Priority'],
	"L_MODS_PRIORITY_EXPLAIN" => $lang['Mods_Priority_Explain'],
	// Hide Links End
	"L_DEFAULT_STYLE" => $lang['Default_style'],
	"L_OVERRIDE_STYLE" => $lang['Override_style'],
	"L_OVERRIDE_STYLE_EXPLAIN" => $lang['Override_style_explain'],
	"L_DEFAULT_LANGUAGE" => $lang['Default_language'],
	"L_DATE_FORMAT" => $lang['Date_format'],
	"L_SYSTEM_TIMEZONE" => $lang['System_timezone'],
	"L_ENABLE_GZIP" => $lang['Enable_gzip'],
	"L_ENABLE_PRUNE" => $lang['Enable_prune'],
// Start add - Birthday MOD
	"L_BIRTHDAY_REQUIRED" => $lang['Birthday_required'],
	"L_ENABLE_BIRTHDAY_GREETING" => $lang['Enable_birthday_greeting'],
	"L_BIRTHDAY_GREETING_EXPLAIN" => $lang['Birthday_greeting_expain'],
	"L_MAX_USER_AGE" => $lang['Max_user_age'],
	"L_MIN_USER_AGE" => $lang['Min_user_age'],
	"L_MIN_USER_AGE_EXPLAIN" => $lang['Min_user_age_explain'],
	"L_BIRTHDAY_LOOKFORWARD" => $lang['Birthday_lookforward'],
	"L_BIRTHDAY_LOOKFORWARD_EXPLAIN" => $lang['Birthday_lookforward_explain'],
// End add - Birthday MOD
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5              START */
/*****************************************************/
	"L_ENABLE_ROPM_QUICK_REPLY" => $lang['enable_ropm_quick_reply'],    // ENABLE ROPM QUICK REPLY
	"L_ROPM_QUICK_REPLY" => $lang['ropm_quick_reply'],                  // ROPM QUICK REPLY
	"L_ROPM_QUICK_REPLY_BBC" => $lang['ropm_quick_reply_bbc'],   // ENABLE BBCODE FOR ROPMQR
	"L_ROPM_QUICK_REPLY_SMILIES" => $lang['ropm_quick_reply_smilies'],  // How many smilies? ROPMQR
	"L_ROPM_QUICK_REPLY_SMILIES_INFO" => $lang['ropm_quick_reply_smilies_info'], // How many smilies? ROPMQR
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5                END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1  START */
/*****************************************************/
	"L_SIG_TITLE" => $lang['sig_title'],
	"L_SIG_EXPLAIN" => $lang['sig_explain'],
	"L_SIG_INPUT" => $lang['sig_divider'],
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1    END */
/*****************************************************/
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2          START */
/*****************************************************/
	"L_MT_HEADER" => $lang['MT_header'],
	"L_MT_ACTIVE" => $lang['MT_move'],
	"L_MT_MOVE_ID" => $lang['MT_move_to'],
	"L_MT_MOVE_DESC" => $lang['MT_move_to_desc'],
	"L_MT_LEAVE_SPECIAL" => $lang['MT_special'],
	"L_MT_LEAVE_SPECIAL_DESC" => $lang['MT_special_desc'],
	"L_MT_ANNO_ONLY" => $lang['MT_only_anno'],
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2            END */
/*****************************************************/
	"L_ALLOW_HTML" => $lang['Allow_HTML'],
	"L_ALLOW_BBCODE" => $lang['Allow_BBCode'],
	"L_ALLOWED_TAGS" => $lang['Allowed_tags'],
	"L_ALLOWED_TAGS_EXPLAIN" => $lang['Allowed_tags_explain'],
	"L_ALLOW_SMILIES" => $lang['Allow_smilies'],
	"L_SMILIES_PATH" => $lang['Smilies_path'],
	"L_SMILIES_PATH_EXPLAIN" => $lang['Smilies_path_explain'],
	"L_ALLOW_SIG" => $lang['Allow_sig'],
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0     START */
/*****************************************************/
	"L_SMILIE_TABLE_COLUMNS" => $lang['Smilie_table_columns'],
	"L_SMILIE_TABLE_ROWS" => $lang['Smilie_table_rows'],
	"L_SMILIE_WINDOW_COLUMNS" => $lang['Smilie_window_columns'],
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0       END */
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
	"L_SIG_PERPAGE" => $lang['Sig_perpage'],
	"L_SIG_PERPAGE_EXPLAIN" => $lang['Sig_perpage_explain'],
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
	"L_MAX_SIG_LENGTH" => $lang['Max_sig_length'],
	"L_MAX_SIG_LENGTH_EXPLAIN" => $lang['Max_sig_length_explain'],
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6           START */
/*****************************************************/
	"L_MAX_IMG_WIDTH" => $lang['Max_img_width'],
	"L_MAX_IMG_WIDTH_EXPLAIN" => $lang['Max_img_width_explain'],
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6             END */
/*****************************************************/
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1         START */
/*****************************************************/
	"L_MAX_SIG_IMAGES_LIMIT" => $lang['Max_sig_images_limit'],
	"L_MAX_SIG_IMAGES_SIZE" => $lang['Max_sig_images_size'],
	"L_MAX_SIG_IMAGES_SIZE_EXPLAIN" => $lang['Max_sig_images_explain'],
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1           END */
/*****************************************************/
	"L_ALLOW_NAME_CHANGE" => $lang['Allow_name_change'],
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0  START */
/*****************************************************/
	"L_GUESTS_NEED_NAME" => $lang['guests_need_name'],
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0    END */
/*****************************************************/
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                 START */
/*****************************************************/
	"L_ALLOW_QUICK_REPLY" => $lang['Allow_quick_reply'],
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                  END  */
/*****************************************************/
    "L_AVATAR_SETTINGS" => $lang['Avatar_settings'],
	"L_ALLOW_LOCAL" => $lang['Allow_local'],
	"L_ALLOW_REMOTE" => $lang['Allow_remote'],
	"L_ALLOW_REMOTE_EXPLAIN" => $lang['Allow_remote_explain'],
	"L_ALLOW_UPLOAD" => $lang['Allow_upload'],
	"L_MAX_FILESIZE" => $lang['Max_filesize'],
	"L_MAX_FILESIZE_EXPLAIN" => $lang['Max_filesize_explain'],
	"L_MAX_AVATAR_SIZE" => $lang['Max_avatar_size'],
	"L_MAX_AVATAR_SIZE_EXPLAIN" => $lang['Max_avatar_size_explain'],
	"L_AVATAR_STORAGE_PATH" => $lang['Avatar_storage_path'],
	"L_AVATAR_STORAGE_PATH_EXPLAIN" => $lang['Avatar_storage_path_explain'],
	"L_AVATAR_GALLERY_PATH" => $lang['Avatar_gallery_path'],
	"L_AVATAR_GALLERY_PATH_EXPLAIN" => $lang['Avatar_gallery_path_explain'],
	"L_COPPA_SETTINGS" => $lang['COPPA_settings'],
	"L_COPPA_FAX" => $lang['COPPA_fax'],
	"L_COPPA_MAIL" => $lang['COPPA_mail'],
	"L_COPPA_MAIL_EXPLAIN" => $lang['COPPA_mail_explain'],
	"L_EMAIL_SETTINGS" => $lang['Email_settings'],
	"L_ADMIN_EMAIL" => $lang['Admin_email'],
	"L_EMAIL_SIG" => $lang['Email_sig'],
	"L_EMAIL_SIG_EXPLAIN" => $lang['Email_sig_explain'],
	"L_USE_SMTP" => $lang['Use_SMTP'],
	"L_USE_SMTP_EXPLAIN" => $lang['Use_SMTP_explain'],
        "L_SMTP_SERVER" => $lang['SMTP_server'],
        "L_SMTP_USERNAME" => $lang['SMTP_username'],
        "L_SMTP_USERNAME_EXPLAIN" => $lang['SMTP_username_explain'],
        "L_SMTP_PASSWORD" => $lang['SMTP_password'],
        "L_SMTP_PASSWORD_EXPLAIN" => $lang['SMTP_password_explain'],
        "L_SUBMIT" => $lang['Submit'],
        "L_RESET" => $lang['Reset'],
        "SERVER_NAME" => $new['server_name'],
        "SCRIPT_PATH" => $new['script_path'],
        "SERVER_PORT" => $new['server_port'],
	"SITENAME" => $new['sitename'],
        "SITE_DESCRIPTION" => $new['site_desc'],
	"S_DISABLE_BOARD_YES" => $disable_board_yes,
	"S_DISABLE_BOARD_NO" => $disable_board_no,
        "ACTIVATION_NONE" => USER_ACTIVATION_NONE,
	   'ALLOW_AUTOLOGIN_YES' => $allow_autologin_yes,
	   'ALLOW_AUTOLOGIN_NO' => $allow_autologin_no,
   'AUTOLOGIN_TIME' => (int) $new['max_autologin_time'],
        "ACTIVATION_USER" => USER_ACTIVATION_SELF,
	"ACTIVATION_USER_CHECKED" => $activation_user,
        "ACTIVATION_ADMIN" => USER_ACTIVATION_ADMIN,
        "ACTIVATION_ADMIN_CHECKED" => $activation_admin,
	"CONFIRM_ENABLE" => $confirm_yes,
	"CONFIRM_DISABLE" => $confirm_no,
	"ACTIVATION_NONE_CHECKED" => $activation_none,
        "BOARD_EMAIL_FORM_ENABLE" => $board_email_form_yes,
        "BOARD_EMAIL_FORM_DISABLE" => $board_email_form_no,
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2          START */
/*****************************************************/
	"WHO_IS_ONLINE_TIME" => $new['who_is_online_time'],
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2            END */
/*****************************************************/
        "MAX_POLL_OPTIONS" => $new['max_poll_options'],
	"FLOOD_INTERVAL" => $new['flood_interval'],
	"SEARCH_FLOOD_INTERVAL" => $new['search_flood_interval'],
	"TOPICS_PER_PAGE" => $new['topics_per_page'],
	"POSTS_PER_PAGE" => $new['posts_per_page'],
	"HOT_TOPIC" => $new['hot_threshold'],
	// Hide Links Start
	"NECESSARY_POST_NUMBER" => $new['necessary_post_number'],
	"MODS_PRIORITY_YES" => $mods_priority_yes,
	"MODS_PRIORITY_NO" => $mods_priority_no,
	// Hide Links End
	"STYLE_SELECT" => $style_select,
	"OVERRIDE_STYLE_YES" => $override_user_style_yes,
	"OVERRIDE_STYLE_NO" => $override_user_style_no,
	"LANG_SELECT" => $lang_select,
	"L_DATE_FORMAT_EXPLAIN" => $lang['Date_format_explain'],
	"DEFAULT_DATEFORMAT" => $new['default_dateformat'],
	"TIMEZONE_SELECT" => $timezone_select,
        "S_PRIVMSG_ENABLED" => $privmsg_on,
        "S_PRIVMSG_DISABLED" => $privmsg_off,
        "INBOX_LIMIT" => $new['max_inbox_privmsgs'],
	"SENTBOX_LIMIT" => $new['max_sentbox_privmsgs'],
	"SAVEBOX_LIMIT" => $new['max_savebox_privmsgs'],
        "COOKIE_DOMAIN" => $new['cookie_domain'],
        "COOKIE_NAME" => $new['cookie_name'],
        "COOKIE_PATH" => $new['cookie_path'],
        "SESSION_LENGTH" => $new['session_length'],
        "S_COOKIE_SECURE_ENABLED" => $cookie_secure_yes,
        "S_COOKIE_SECURE_DISABLED" => $cookie_secure_no,
	"GZIP_YES" => $gzip_yes,
	"GZIP_NO" => $gzip_no,
	"PRUNE_YES" => $prune_yes,
        "PRUNE_NO" => $prune_no,
// Start add - Birthday MOD
	"BIRTHDAY_GREETING_YES" => $birthday_greeting_yes,
	"BIRTHDAY_GREETING_NO" => $birthday_greeting_no,
	"BIRTHDAY_REQUIRED_YES" => $birthday_required_yes,
	"BIRTHDAY_REQUIRED_NO" => $birthday_required_no, 
	"MAX_USER_AGE" => $new['max_user_age'],
	"MIN_USER_AGE" => $new['min_user_age'],
	"BIRTHDAY_LOOKFORWARD" => $new['birthday_check_day'],
// End add - Birthday MOD
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5              START */
/*****************************************************/
	"ROPM_QUICK_REPLY_YES" => $ropm_quick_reply_yes,
	"ROPM_QUICK_REPLY_NO" => $ropm_quick_reply_no,
	"ROPM_QUICK_REPLY_BBC_YES" => $ropm_quick_reply_bbc_yes,
	"ROPM_QUICK_REPLY_BBC_NO" => $ropm_quick_reply_bbc_no,
	"ROPM_QUICK_REPLY_SMILIES" => $new['ropm_quick_reply_smilies'],
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5                END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1  START */
/*****************************************************/
	"SIG_DIVIDERS" => $new['sig_line'],
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1    END */
/*****************************************************/
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2          START */
/*****************************************************/
	"MOVE_WHEN_LOCKED_FID" => $new['move_when_locked_id'],
	"MOVE_WHEN_LOCKED_ACTIVE" => $move_when_locked_on,
	"MOVE_WHEN_LOCKED_INACTIVE" => $move_when_locked_off,
	"LEAVE_ANNOUNCEMENTS" => $leave_special_topic_anno,
	"LEAVE_NOTHING" => $leave_special_topic_no,
	"LEAVE_BOTH" => $leave_special_topic_both,
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2            END */
/*****************************************************/
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2       START */
/*****************************************************/
	"MAX_SMILIES" => $new['max_smilies'],
	"L_MAX_SMILIES" => $lang['Max_smilies'],
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2         END */
/*****************************************************/
        "HTML_TAGS" => $html_tags,
	"HTML_YES" => $html_yes,
	"HTML_NO" => $html_no,
	"BBCODE_YES" => $bbcode_yes,
	"BBCODE_NO" => $bbcode_no,
	"SMILE_YES" => $smile_yes,
	"SMILE_NO" => $smile_no,
	"SIG_YES" => $sig_yes,
	"SIG_NO" => $sig_no,
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
	"SIG_PERPAGE_YES" => $sig_perpage_yes,
	"SIG_PERPAGE_NO" => $sig_perpage_no,
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
    "SIG_SIZE" => $new['max_sig_chars'],
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6           START */
/*****************************************************/
    "MAX_IMG_WIDTH" => $new['max_img_width'],
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6             END */
/*****************************************************/
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1         START */
/*****************************************************/
	"SIG_IMAGES_MAX_LIMIT" => $new['sig_images_max_limit'],
	"SIG_IMAGES_MAX_HEIGHT" => $new['sig_images_max_height'],
	"SIG_IMAGES_MAX_WIDTH" => $new['sig_images_max_width'],
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1           END */
/*****************************************************/
	"NAMECHANGE_YES" => $namechange_yes,
	"NAMECHANGE_NO" => $namechange_no,
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0  START */
/*****************************************************/
	"GUESTS_NEED_NAME_YES" => $guests_need_name_yes,
	"GUESTS_NEED_NAME_NO" => $guests_need_name_no,
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0    END */
/*****************************************************/
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                 START */
/*****************************************************/
	"QUICKREPLY_YES" => $quickreply_yes,
	"QUICKREPLY_NO" => $quickreply_no,
/*****************************************************/
/* Forum - Quick Reply v.1.0.2                  END  */
/*****************************************************/
	"AVATARS_LOCAL_YES" => $avatars_local_yes,
	"AVATARS_LOCAL_NO" => $avatars_local_no,
	"AVATARS_REMOTE_YES" => $avatars_remote_yes,
	"AVATARS_REMOTE_NO" => $avatars_remote_no,
	"AVATARS_UPLOAD_YES" => $avatars_upload_yes,
	"AVATARS_UPLOAD_NO" => $avatars_upload_no,
	"AVATAR_FILESIZE" => $new['avatar_filesize'],
	"AVATAR_MAX_HEIGHT" => $new['avatar_max_height'],
	"AVATAR_MAX_WIDTH" => $new['avatar_max_width'],
    "AVATAR_PATH" => $new['avatar_path'],
    "AVATAR_GALLERY_PATH" => $new['avatar_gallery_path'],
    "SMILIES_PATH" => $new['smilies_path'],
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0     START */
/*****************************************************/
	"SMILIE_COLUMNS" => $new['smilie_columns'],
	"SMILIE_ROWS" => $new['smilie_rows'],
	"SMILIE_WINDOW_COLUMNS" => $new['smilie_window_columns'],
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0       END */
/*****************************************************/
    "INBOX_PRIVMSGS" => $new['max_inbox_privmsgs'],
    "SENTBOX_PRIVMSGS" => $new['max_sentbox_privmsgs'],
    "SAVEBOX_PRIVMSGS" => $new['max_savebox_privmsgs'],
	"EMAIL_FROM" => $new['board_email'],
	"EMAIL_SIG" => $new['board_email_sig'],
	"SMTP_YES" => $smtp_yes,
	"SMTP_NO" => $smtp_no,
	"SMTP_HOST" => $new['smtp_host'],
	"SMTP_USERNAME" => $new['smtp_username'],
	"SMTP_PASSWORD" => $new['smtp_password'],
	"COPPA_MAIL" => $new['coppa_mail'],
	"COPPA_FAX" => $new['coppa_fax'])
);
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
if ( isset($lang['Post_global_announcement']) )$template->assign_block_vars('switch_global_announce', array());
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
$template->pparse("body");
include_once('./page_footer_admin.'.$phpEx);
?>