<?php
/***************************************************************************
*                             cash_forums.php
*                            -------------------
*   begin                : Friday, Jun 27, 2003
*   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
*
*   $Id: cash_forums.php,v 2.1.0.0 2003/09/18 23:00:52 Xore $
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
	$phpbb['Cash/Shop Mod']['Cash_Forums'] = $file;
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
//Begin PNphpBB2 Module
	include_once($phpbb_root_path . 'admin/admin_cash.' . $phpEx);
//End PNphpBB2 Module
}

if ( !$cash->currency_count() )
{
	message_die(GENERAL_MESSAGE, $lang['Insufficient_currencies']);
}

//
// Mode setting
//
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = "";
}

//
// Begin program proper
//
if ( isset($_POST['submit']) )
{
	$cash_forums = array();
	$current_list = array();
	$sql = "SELECT forum_id FROM " . FORUMS_TABLE;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query forum information", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$cash_forums[] = $row['forum_id'];
	}
	while ( $c_cur = &$cash->currency_next($cm_i) )
	{
		$varname = 'cash_' . $c_cur->id();
		if ( isset($_POST[$varname]) &&
			 is_array($_POST[$varname]) )
		{
			$activated = array(array(),array());
			for ( $i = 0; $i < count($cash_forums); $i++ )
			{
				if ( isset($_POST[$varname][$cash_forums[$i]]) )
				{
					$activated[intval($_POST[$varname][$cash_forums[$i]])][] = $cash_forums[$i];
				}
			}
			$sql_list = "";
			$settings = $c_cur->data('cash_settings');
			if ( count($activated[0]) > count($activated[1]) )
			{
				$sql_list = implode(",",$activated[1]);
				$settings &= ~CURRENCY_FORUMLISTTYPE;
			}
			else
			{
				$sql_list = implode(",",$activated[0]);
				$settings |= CURRENCY_FORUMLISTTYPE;
			}
			$sql = "UPDATE " . CASH_TABLE . "
				SET cash_settings = $settings, cash_forumlist = '$sql_list'
				WHERE cash_id = " . $c_cur->id();
			if ( !$db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, "Failed to update", "", __LINE__, __FILE__, $sql);
			}
		}
	}
	$cash->refresh_table();
}

//
// Start page proper
//
$template->set_filenames(array(
	"body" => "admin/cash_forum.tpl")
);

$template->assign_vars(array(
	'S_FORUM_ACTION' => append_sid("admin_cash_forums.$phpEx"),
	'L_FORUM_SETTINGS_TITLE' => $lang['Forum_cm_settings'],
	'L_FORUM_SETTINGS_EXPLAIN' => $lang['Forum_cm_settings_explain'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],

	'NUM_ROWS' => ((2*$cash->currency_count()) + 3),

	'L_ON' => ucwords(strtolower($lang['ON'])),
	'L_OFF' => ucwords(strtolower($lang['OFF'])))
);

$boolean_forums = array();

while ( $c_cur = &$cash->currency_next($cm_i) )
{
	$template->assign_block_vars("cashrow", array(
		'CASH_NAME' => $c_cur->name())
	);
}

$sql = "SELECT cat_id, cat_title, cat_order
	FROM " . CATEGORIES_TABLE . "
	ORDER BY cat_order";
if ( !$q_categories = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}

if ( $total_categories = $db->sql_numrows($q_categories) )
{
	$category_rows = $db->sql_fetchrowset($q_categories);

	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		ORDER BY cat_id, forum_order";
	if ( !$q_forums = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
	}

	if ( $total_forums = $db->sql_numrows($q_forums) )
	{
		$forum_rows = $db->sql_fetchrowset($q_forums);
	}

	//
	// Okay, let's build the index
	//
	$gen_cat = array();

	for ( $i = 0; $i < $total_categories; $i++ )
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$template->assign_block_vars("catrow", array(
			'S_ADD_FORUM_SUBMIT' => "addforum[$cat_id]",
			'S_ADD_FORUM_NAME' => "forumname[$cat_id]",

			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],

			'U_VIEWCAT' => "../../../modules.php?name=Forums&file=index&" . POST_CAT_URL . "=$cat_id")
		);

		for ( $j = 0; $j < $total_forums; $j++ )
		{
			$forum_id = $forum_rows[$j]['forum_id'];
			
			if ( $forum_rows[$j]['cat_id'] == $cat_id )
			{
				$template->assign_block_vars("catrow.forumrow",	array(
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
					'FORUM_DESC' => $forum_rows[$j]['forum_desc'],
					'ROW_COLOR' => $row_color,
					'NUM_TOPICS' => $forum_rows[$j]['forum_topics'],
					'NUM_POSTS' => $forum_rows[$j]['forum_posts'],

					'U_VIEWFORUM' => "../../../modules.php?name=Forums&file=viewforum&" . POST_FORUM_URL . "=$forum_id")
				);

				while ( $c_cur = &$cash->currency_next($cm_i) )
				{
					$template->assign_block_vars("catrow.forumrow.cashrow", array(
						'S_ON' => (( $c_cur->forum_active($forum_id) )?' checked="checked"':''),
						'S_OFF' => (( $c_cur->forum_active($forum_id) )?'':' checked="checked"'),
						'S_NAME' => "cash_" . $c_cur->id() . "[" . $forum_id . "]")
					);
				}

			}// if ... forumid == catid
			
		} // for ... forums

	} // for ... categories

}// if ... total_categories

$template->pparse("body");


include_once('./page_footer_admin.' . $phpEx);


?> 
