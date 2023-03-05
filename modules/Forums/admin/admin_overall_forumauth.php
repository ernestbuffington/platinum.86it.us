<?php
/***************************************************************************
 *                         admin_overall_forumauth.php
 *                            -------------------
 *   begin                : Friday, July 12, 2002
 *   copyright            : (C) 2002 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: admin_overall_forumauth.php,v 1.0.2 2002/8/08, 19:41:51 hnt Exp $
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

$forum_id = 2; // You could change this value unless forum ID 3 did not exist in your board

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Forums']['Overall Permissions']   = $filename . '?' . POST_FORUM_URL . "=$forum_id";

	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

//
// Start program - define vars
//
//                View      Read      Post      Reply     Edit     Delete    Sticky   Announce    Vote      Poll
$simple_auth_ary = array(
	0  => array(AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG),
	1  => array(AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG),
	2  => array(AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG),
	3  => array(AUTH_ALL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL),
	4  => array(AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL),
	5  => array(AUTH_ALL, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
	6  => array(AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
);

$simple_auth_types = array($lang['Public'], $lang['Registered'], $lang['Registered'] . ' [' . $lang['Hidden'] . ']', $lang['Private'], $lang['Private'] . ' [' . $lang['Hidden'] . ']', $lang['Moderators'], $lang['Moderators'] . ' [' . $lang['Hidden'] . ']');

$forum_auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate');

$field_names = array(
	'auth_view' => $lang['View'],
	'auth_read' => $lang['Read'],
	'auth_post' => $lang['Post'],
	'auth_reply' => $lang['Reply'],
	'auth_edit' => $lang['Edit'],
	'auth_delete' => $lang['Delete'],
	'auth_sticky' => $lang['Sticky'],
	'auth_announce' => $lang['Announce'], 
	'auth_vote' => $lang['Vote'], 
	'auth_pollcreate' => $lang['Pollcreate']);

$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);
/*****************************************************/
/* Forum - Overall Permission v.1.0.2          START */
/*****************************************************/
attach_setup_forum_auth($simple_auth_ary, $forum_auth_fields, $field_names);
/*****************************************************/
/* Forum - Overall Permission v.1.0.2            END */
/*****************************************************/

if( isset($_GET['adv']) )
{
	$adv = intval($_GET['adv']);
}
else
{
	unset($adv);
}

//
// Start program proper
//
if( isset($_POST['submit']) )
{
	$sql = '';

	if(!empty($forum_id))
	{
		if(isset($_POST['simpleauth']))
		{
			$simple_ary = $simple_auth_ary[$_POST['simpleauth']];

			for($i = 0; $i < count($simple_ary); $i++)
			{
				$sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_fields[$i] . ' = ' . $simple_ary[$i];
			}

			$sql = "UPDATE " . FORUMS_TABLE . " SET $sql";
		}
		else
		{
			for($i = 0; $i < count($forum_auth_fields); $i++)
			{
				$value = $_POST[$forum_auth_fields[$i]];

				if ( $forum_auth_fields[$i] == 'auth_vote' )
				{
					if ( $_POST['auth_vote'] == AUTH_ALL )
					{
						$value = AUTH_REG;
					}
				}

				$sql .= ( ( $sql != '' ) ? ', ' : '' ) .$forum_auth_fields[$i] . ' = ' . $value;
			}

			$sql = "UPDATE " . FORUMS_TABLE . " SET $sql";
		}

		if ( $sql != '' )
		{
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
			}
		}

		$forum_sql = '';
		$adv = 0;
	}

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("admin_overall_forumauth.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
	);
	$message = $lang['Forum_auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumauth'],  '<a href="' . append_sid("admin_overall_forumauth.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', "</a>");
	message_die(GENERAL_MESSAGE, $message);

} // End of submit

//
// Get require_onced information, either all forums if
// no id was specified or just the requsted if it
// was
//
$sql = "SELECT f.*
	FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
	WHERE c.cat_id = f.cat_id
	AND forum_id = $forum_id
	ORDER BY c.cat_order ASC, f.forum_order ASC";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Couldn't obtain forum list", "", __LINE__, __FILE__, $sql);
}

$forum_rows = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

if( empty($forum_id) )
{
	// Nothing... hehehehe - Smartor
}
else
{
	//
	// Output the authorisation details if an id was
	// specified
	//
	$template->set_filenames(array(
		'body' => 'admin/auth_forum_body.tpl')
	);

	$forum_name = 'Overall';

	@reset($simple_auth_ary);
	while( list($key, $auth_levels) = each($simple_auth_ary))
	{
		$matched = 1;
		for($k = 0; $k < count($auth_levels); $k++)
		{
			$matched_type = $key;

			if ( $forum_rows[0][$forum_auth_fields[$k]] != $auth_levels[$k] )
			{
				$matched = 0;
			}
		}

		if ( $matched )
		{
			break;
		}
	}

	//
	// If we didn't get a match above then we
	// automatically switch into 'advanced' mode
	//
	if ( !isset($adv) && !$matched )
	{
		$adv = 1;
	}

	$s_column_span == 0;

	if ( empty($adv) )
	{
		$simple_auth = '<select name="simpleauth">';

		for($j = 0; $j < count($simple_auth_types); $j++)
		{
			$selected = ( $matched_type == $j ) ? ' selected="selected"' : '';
			$simple_auth .= '<option value="' . $j . '"' . $selected . '>' . $simple_auth_types[$j] . '</option>';
		}

		$simple_auth .= '</select>';

		$template->assign_block_vars('forum_auth_titles', array(
			'CELL_TITLE' => $lang['Simple_mode'])
		);
		$template->assign_block_vars('forum_auth_data', array(
			'S_AUTH_LEVELS_SELECT' => $simple_auth)
		);

		$s_column_span++;
	}
	else
	{
		//
		// Output values of individual
		// fields
		//
		for($j = 0; $j < count($forum_auth_fields); $j++)
		{
			$custom_auth[$j] = '&nbsp;<select name="' . $forum_auth_fields[$j] . '">';

			for($k = 0; $k < count($forum_auth_levels); $k++)
			{
				$selected = ( $forum_rows[0][$forum_auth_fields[$j]] == $forum_auth_const[$k] ) ? ' selected="selected"' : '';
				$custom_auth[$j] .= '<option value="' . $forum_auth_const[$k] . '"' . $selected . '>' . $lang['Forum_' . $forum_auth_levels[$k]] . '</option>';
			}
			$custom_auth[$j] .= '</select>&nbsp;';

			$cell_title = $field_names[$forum_auth_fields[$j]];

			$template->assign_block_vars('forum_auth_titles', array(
				'CELL_TITLE' => $cell_title)
			);
			$template->assign_block_vars('forum_auth_data', array(
				'S_AUTH_LEVELS_SELECT' => $custom_auth[$j])
			);

			$s_column_span++;
		}
	}

	$adv_mode = ( empty($adv) ) ? '1' : '0';
	$switch_mode = append_sid("admin_overall_forumauth.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&adv=". $adv_mode);
	$switch_mode_text = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
	$u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';

	$s_hidden_fields = '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '">';

	$template->assign_vars(array(
		'FORUM_NAME' => $forum_name,

		'L_FORUM' => $lang['Forum'], 
		'L_AUTH_TITLE' => $lang['Auth_Control_Forum'],
		'L_AUTH_EXPLAIN' => $lang['Forum_auth_explain'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],

		'U_SWITCH_MODE' => $u_switch_mode,

		'S_FORUMAUTH_ACTION' => append_sid("admin_overall_forumauth.$phpEx"),
		'S_COLUMN_SPAN' => $s_column_span,
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);

}

include_once('./page_header_admin.'.$phpEx);

$template->pparse('body');

include_once('./page_footer_admin.'.$phpEx);

?>