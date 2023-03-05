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

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

$submit = $refresh = FALSE;
//
// Set toggles for various options
//
if ( !$board_config['allow_html'] )
{
	$html_on = 0;
}
else
{
	$html_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}

if ( !$board_config['allow_bbcode'] )
{
	$bbcode_on = 0;
}
else
{
	$bbcode_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}

if ( !$board_config['allow_smilies'] )
{
	$smilies_on = 0;
}
else
{
	$smilies_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}
if ( ($submit || $refresh) && $is_auth['auth_read'])
{
	$notify_user = ( !empty($_POST['notify']) ) ? TRUE : 0;
}
else
{
	if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
	{
		$sql = "SELECT topic_id
			FROM " . TOPICS_WATCH_TABLE . "
			WHERE topic_id = $topic_id
				AND user_id = " . $userdata['user_id'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
		}

		$notify_user = ( $db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];
		$db->sql_freeresult($result);
	}
	else
	{
		$notify_user = ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
	}
}

$attach_sig = ( $submit || $refresh ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );

$user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';
//$user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

//
// Signature toggle selection
//
if( $user_sig != '' )
{
	$template->assign_block_vars('switch_signature_checkbox', array());
}

//
// HTML toggle selection
//
if ( $board_config['allow_html'] )
{
	$html_status = $lang['HTML_is_ON'];
	$template->assign_block_vars('switch_html_checkbox', array());
}
else
{
	$html_status = $lang['HTML_is_OFF'];
}

//
// BBCode toggle selection
//
if ( $board_config['allow_bbcode'] )
{
	$bbcode_status = $lang['BBCode_is_ON'];
	$template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
	$bbcode_status = $lang['BBCode_is_OFF'];
}

//
// Smilies toggle selection
//
if ( $board_config['allow_smilies'] )
{
	$smilies_status = $lang['Smilies_are_ON'];
    
	$template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
	$smilies_status = $lang['Smilies_are_OFF'];
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
	$template->assign_block_vars('switch_username_select', array());
}

//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
{
	if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
	{
		$template->assign_block_vars('switch_notify_checkbox', array());
	}
}


$hidden_form_fields = '<input type="hidden" name="mode" value="reply" />';
$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';

// Generate smilies listing for page output
generate_smilies('inline', PAGE_POSTING);

//
// Output the data to the template
//
$template->assign_vars(array(
	'HTML_STATUS' => $html_status,
	'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
	'SMILIES_STATUS' => $smilies_status,

	'L_QUICK_REPLY' => $lang['Quick_Reply'],
	'L_SUBJECT' => $lang['Subject'],
	'L_USERNAME' => $lang['Username'],
	'L_MESSAGE_BODY' => $lang['Message_body'],

	'L_OPTIONS' => $lang['Options'],
	'L_PREVIEW' => $lang['Preview'],
	'L_SUBMIT' => $lang['Submit'],
	'L_DISABLE_HTML' => $lang['Disable_HTML_post'],
	'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'],
	'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
	'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],
	'L_NOTIFY_ON_REPLY' => $lang['Notify'],

	// javascript
	'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
	'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
	'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
	'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'],
	'L_BBCODE_C_HELP' => $lang['bbcode_c_help'],
	'L_BBCODE_L_HELP' => $lang['bbcode_l_help'],
	'L_BBCODE_O_HELP' => $lang['bbcode_o_help'],
	'L_BBCODE_P_HELP' => $lang['bbcode_p_help'],
	'L_BBCODE_W_HELP' => $lang['bbcode_w_help'],
	'L_BBCODE_A_HELP' => $lang['bbcode_a_help'],
	'L_BBCODE_S_HELP' => $lang['bbcode_s_help'],
	'L_BBCODE_F_HELP' => $lang['bbcode_f_help'],
	'L_EMPTY_MESSAGE' => $lang['Empty_message'],

	'L_FONT_COLOR' => $lang['Font_color'],
	'L_COLOR_DEFAULT' => $lang['color_default'],
	'L_COLOR_DARK_RED' => $lang['color_dark_red'],
	'L_COLOR_RED' => $lang['color_red'],
	'L_COLOR_ORANGE' => $lang['color_orange'],
	'L_COLOR_BROWN' => $lang['color_brown'],
	'L_COLOR_YELLOW' => $lang['color_yellow'],
	'L_COLOR_GREEN' => $lang['color_green'],
	'L_COLOR_OLIVE' => $lang['color_olive'],
	'L_COLOR_CYAN' => $lang['color_cyan'],
	'L_COLOR_BLUE' => $lang['color_blue'],
	'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
	'L_COLOR_INDIGO' => $lang['color_indigo'],
	'L_COLOR_VIOLET' => $lang['color_violet'],
	'L_COLOR_WHITE' => $lang['color_white'],
	'L_COLOR_BLACK' => $lang['color_black'],

	'L_FONT_SIZE' => $lang['Font_size'],
	'L_FONT_TINY' => $lang['font_tiny'],
	'L_FONT_SMALL' => $lang['font_small'],
	'L_FONT_NORMAL' => $lang['font_normal'],
	'L_FONT_LARGE' => $lang['font_large'],
	'L_FONT_HUGE' => $lang['font_huge'],

	'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'],
	'L_STYLES_TIP' => $lang['Styles_tip'],

	'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
	'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
	'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
	'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
	'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '',
	'S_POST_ACTION' => append_sid("posting.$phpEx"),
	'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);

$template->assign_var_from_handle('QRBODY', 'qrbody');

?>
