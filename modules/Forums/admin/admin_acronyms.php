<?php
/***************************************************************************
 *                              admin_words.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_words.php,v 1.10.2.2 2002/05/12 15:57:45 psotfx Exp $
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

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Acronyms'] = "$file";
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

if( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ($_GET['mode']) ? $_GET['mode'] : $_POST['mode'];
}
else 
{
	//
	// These could be entered via a form button
	//
	if( isset($_POST['add']) )
	{
		$mode = "add";
	}
	else if( isset($_POST['save']) )
	{
		$mode = "save";
	}
	else
	{
		$mode = "";
	}
}

if( $mode != "" )
{
	if( $mode == "edit" || $mode == "add" )
	{
		$acronym_id = ( isset($_GET['id']) ) ? $_GET['id'] : 0;

		$template->set_filenames(array(
			"body" => "admin/acronyms_edit_body.tpl")
		);

		$s_hidden_fields = '';

		if( $mode == "edit" )
		{
			if( $acronym_id )
			{
				$sql = "SELECT * 
					FROM " . ACRONYMS_TABLE . "
					WHERE acronym_id = $acronym_id";
				if(!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, "Could not query acronym table", "Error", __LINE__, __FILE__, $sql);
				}

				$acronym_info = $db->sql_fetchrow($result);
				$s_hidden_fields .= '<input type="hidden" name="id" value="' . $acronym_id . '" />';
			}
			else
			{
				message_die(GENERAL_MESSAGE, $lang['No_acronym_selected']);
			}
		}

		$template->assign_vars(array(
			'ACRONYM' => $acronym_info['acronym'],
			'DESCRIPTION' => $acronym_info['description'],

			'L_ACRONYMS_TITLE' => $lang['Acronyms_title'],
			'L_ACRONYMS_TEXT' => $lang['Acronyms_explain'],
			'L_ACRONYM_EDIT' => $lang['Edit_acronym'],
			'L_ACRONYM' => $lang['Acronym'],
			'L_DESCRIPTION' => $lang['Description'],
			'L_SUBMIT' => $lang['Submit'],

			'S_ACRONYMS_ACTION' => append_sid("admin_acronyms.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse("body");

		include_once('./page_footer_admin.'.$phpEx);
	}
	else if( $mode == "save" )
	{
		$acronym_id = ( isset($_POST['id']) ) ? $_POST['id'] : 0;
		$acronym = ( isset($_POST['acronym']) ) ? trim($_POST['acronym']) : "";
		$description = ( isset($_POST['description']) ) ? trim($_POST['description']) : "";

		if($acronym == "" || $description == "")
		{
			message_die(GENERAL_MESSAGE, $lang['Must_enter_acronym']);
		}

		if( $acronym_id )
		{
			$sql = "UPDATE " . ACRONYMS_TABLE . "
				SET acronym = '" . str_replace("\'", "''", $acronym) . "', description = '" . str_replace("\'", "''", $description) . "'
				WHERE acronym_id = $acronym_id";
			$message = $lang['Acronym_updated'];
		}
		else
		{
			$sql = "INSERT INTO " . ACRONYMS_TABLE . " (acronym, description)
				VALUES ('" . str_replace("\'", "''", $acronym) . "', '" . str_replace("\'", "''", $description) . "')";
			$message = $lang['Acronym_added'];
		}

		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not insert data into words table", $lang['Error'], __LINE__, __FILE__, $sql);
		}

		$message .= "<br /><br />" . sprintf($lang['Click_return_acronymadmin'], "<a href=\"" . append_sid("admin_acronyms.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if( $mode == "delete" )
	{
		if( isset($_POST['id']) ||  isset($_GET['id']) )
		{
			$acronym_id = ( isset($_POST['id']) ) ? $_POST['id'] : $_GET['id'];
		}
		else
		{
			$acronym_id = 0;
		}

		if( $acronym_id )
		{
			$sql = "DELETE FROM " . ACRONYMS_TABLE . "
				WHERE acronym_id = $acronym_id";

			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Could not remove data from words table", $lang['Error'], __LINE__, __FILE__, $sql);
			}

			$message = $lang['Acronym_removed'] . "<br /><br />" . sprintf($lang['Click_return_acronymadmin'], "<a href=\"" . append_sid("admin_acronyms.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_acronym_selected']);
		}
	}
}
else
{
	$template->set_filenames(array(
		"body" => "admin/acronyms_list_body.tpl")
	);

	$sql = "SELECT *
		FROM " . ACRONYMS_TABLE . "
		ORDER BY acronym";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not query words table", $lang['Error'], __LINE__, __FILE__, $sql);
	}

	$word_rows = $db->sql_fetchrowset($result);
	$word_count = count($word_rows);

	$template->assign_vars(array(
		'L_ACRONYMS_TITLE' => $lang['Acronyms_title'],
		'L_ACRONYMS_TEXT' => $lang['Acronyms_explain'],
		'L_ACRONYM' => $lang['Acronym'],
		'L_DESCRIPTION' => $lang['Description'],
		'L_EDIT' => $lang['Edit'],
		'L_DELETE' => $lang['Delete'],
		'L_ADD_ACRONYM' => $lang['Add_new_acronym'],
		'L_ACTION' => $lang['Action'],

		'S_ACRONYM_ACTION' => append_sid("admin_acronyms.$phpEx"),
		'S_HIDDEN_FIELDS' => '')
	);

	for($i = 0; $i < $word_count; $i++)
	{
		$acronym = $word_rows[$i]['acronym'];
		$description = $word_rows[$i]['description'];
		$acronym_id = $word_rows[$i]['acronym_id'];

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('acronyms', array(
			'ROW_COLOR' => "#" . $row_color,
			'ROW_CLASS' => $row_class,
			'ACRONYM' => $acronym,
			'DESCRIPTION' => $description,

			'U_ACRONYM_EDIT' => append_sid("admin_acronyms.$phpEx?mode=edit&amp;id=$acronym_id"),
			'U_ACRONYM_DELETE' => append_sid("admin_acronyms.$phpEx?mode=delete&amp;id=$acronym_id"))
		);
	}
}

$template->pparse("body");

include_once('./page_footer_admin.'.$phpEx);

?>