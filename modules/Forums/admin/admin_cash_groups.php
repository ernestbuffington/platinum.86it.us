<?php
/***************************************************************************
 *                              cash_groups.php
 *                            -------------------
 *   begin                : Sunday, Jul 20, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_groups.php,v 2.0.0.0 2003/09/18 23:00:10 Xore $
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
	$phpbb['Cash/Shop Mod']['Cash_Groups'] = $file;
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

if ( !$cash->currency_count() )
{
	message_die(GENERAL_MESSAGE, $lang['Insufficient_currencies']);
}

$mode = isset($_POST['mode'])?$_POST['mode']:"main";

switch ( $mode )
{

//
// ================= Update board mode ( group add/remove/set ) ================================
//
	case "set":
		if ( isset($_POST['group_type']) &&
			 isset($_POST['group_id']) &&
			 is_numeric($_POST['group_type']) &&
			 is_numeric($_POST['group_id']) &&
			 isset($_POST['update_type']) &&
			 isset($_POST['update_amount']) &&
			 is_array($_POST['update_type']) &&
			 is_array($_POST['update_amount']) )
		{
			$update_clause = array();
			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				if ( isset($_POST['update_type'][$c_cur->id()]) )
				{
					$type = intval($_POST['update_type'][$c_cur->id()]);
					$amount = intval($_POST['update_amount'][$c_cur->id()]);
					if ( ($amount < 0) && (($type == 1) || ($type == 2)) )
					{
						$amount = -$amount;
						$type = 3 - $type;
					}
					switch ( $type )
					{
						case 1:
							$update_clause[] = $c_cur->db() . ' = ' . $c_cur->db() . ' + ' . $amount;
							break;
						case 2:
							$update_clause[] = $c_cur->db() . ' = ' . $c_cur->db() . ' - ' . $amount;
							break;
						case 3:
							$update_clause[] = $c_cur->db() . ' = ' . $amount;
							break;
						default:
							break;
					}
				}
			}
			if ( count($update_clause) )
			{
				$group_type = intval($_POST['group_type']);
				$group_id = intval($_POST['group_id']);
				$where_clause = array();
				switch ( $group_type )
				{
					case CASH_GROUPS_LEVEL:
						if ( $group_id == ADMIN )
						{
							$where_clause[] = 'WHERE user_level = ' . ADMIN;
						}
						else if ( $group_id == MOD )
						{
							$where_clause[] = 'WHERE user_level = ' . MOD;
						}
						break;
					case CASH_GROUPS_RANK:
						$sql = "SELECT rank_min
								FROM " . RANKS_TABLE . "
								WHERE rank_id = " . $group_id . " AND rank_special = 0";
						if ( !($result = $db->sql_query($sql)) )
						{
							message_die(GENERAL_ERROR, "Could not query rank information", "", __LINE__, __FILE__, $sql);
						}
						if ( !($row = $db->sql_fetchrow($result)) )
						{
							message_die(GENERAL_ERROR, "Rank does not exist", "", __LINE__, __FILE__, $sql);
						}
						$where_clause[] = 'WHERE user_posts >= ' . $row['rank_min'];
						break;
					case CASH_GROUPS_USEGROUP:
						$sql = "SELECT user_id
								FROM " . USER_GROUP_TABLE . "
								WHERE group_id = " . $group_id . "AND user_pending = 0";
						if ( !($result = $db->sql_query($sql)) )
						{
							message_die(GENERAL_ERROR, "Could not query usergroup information", "", __LINE__, __FILE__, $sql);
						}
						$users = array();
						while ( $row = $db->sql_fetchrow($result) )
						{
							$users[] = $row['user_id'];
						}
						if ( count($users) > 20 )
						{
							$group = cash_array_chunk($users,15);
							for ( $i = 0; $i < count($group); $i++ )
							{
								$where_clause[] = 'WHERE user_id = ' . implode(' OR user_id = ',$group[$i]);
							}
						}
						else if ( count($users) )
						{
							$where_clause[] = 'WHERE user_id = ' . implode(' OR user_id = ',$users);
						}
						break;
					default:
						break;
				}
				if ( count($where_clause) )
				{
					$clause = "UPDATE " . USERS_TABLE . "
								SET " . implode(',',$update_clause) . " ";
					for ( $i = 0; $i < count($where_clause); $i++ )
					{
						$sql = $clause . $where_clause[$i];
						if ( !($db->sql_query($sql)) )
						{
							message_die(GENERAL_ERROR, "Could not update user information", "", __LINE__, __FILE__, $sql);
						}
					}
				}
			}
			message_die(GENERAL_MESSAGE, $lang['Cash_groups_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_groups'], "<a href=\"" . append_sid("admin_cash_groups.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>"));
		}
		break;
//
// ================= Update board mode ( submitted form ) ================================
//
	case "update":
		if ( isset($_POST['group_type']) &&
			 isset($_POST['group_id']) &&
			 is_numeric($_POST['group_type']) &&
			 is_numeric($_POST['group_id']) )
		{
			$group_type = intval($_POST['group_type']);
			$group_id = intval($_POST['group_id']);

			$group = new cash_forumgroup($group_type,$group_id,$group_name,$group_description);

			$cm_groups->load(true,true);
			$group->load();

			$update_set = array('cash_perpost' => 'float',	'cash_postbonus' => 'float',		'cash_perreply' => 'float',
								'cash_perchar' => 'float',	'cash_maxearn' => 'float',			'cash_perpm' => 'float',
								'cash_allowance' => 'int',	'cash_allowanceamount' => 'float',	'cash_allowancetime' => 'int');
			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				$delete_this = true;
				$varname = 'cash_' . $c_cur->id();
				if ( isset($_POST['submit']) &&
					 isset($_POST[$varname]) &&
					 is_array($_POST[$varname]) )
				{
					$updates = array();
					while ( list($key,$type) = each ( $update_set ) )
					{
						if ( isset($_POST[$varname][$key]) )
						{
							$data = $_POST[$varname][$key];
							switch ( $type )
							{
								case 'int':
									if ( is_numeric($data) )
									{
										$updates[] = $key . ' = ' . intval($data);
										if ( (intval($data) != 0) && ($key != 'cash_allowancetime') )
										{
											$delete_this = false;
										}
									}
									break;
								case 'float':
									if ( is_numeric($data) )
									{
										$updates[] = $key . ' = ' . $c_cur->attribute_pack($key,$data);
										if ( $c_cur->attribute_pack($key,$data) != 0 )
										{
											$delete_this = false;
										}
									}
									break;
							}
						}
					}
					reset ( $update_set );
					if ( count($updates) > 0 )
					{
						if ( $delete_this )
						{
							$sql = "DELETE FROM " . CASH_GROUPS_TABLE . " WHERE group_type = $group_type AND group_id = $group_id AND cash_id = " . $c_cur->id();
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, "Failed to remove a Cash Mod group setting", "", __LINE__, __FILE__, $sql);
							}
						}
						else
						{
							if ( !isset($group->currency_settings[$c_cur->id()]) )
							{
								$sql = "INSERT INTO " . CASH_GROUPS_TABLE . " (group_type, group_id, cash_id) VALUES ($group_type,$group_id," . $c_cur->id() . ")";
								if ( !$db->sql_query($sql) )
								{
									message_die(GENERAL_ERROR, "Failed to create Cash Mod group settings", "", __LINE__, __FILE__, $sql);
								}
							}
							$sql = "UPDATE " . CASH_GROUPS_TABLE . "
									SET " . implode(", ",$updates) . "
									WHERE group_type = $group_type AND group_id = $group_id AND cash_id = " . $c_cur->id();
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, "Failed to update Cash Mod group settings", "", __LINE__, __FILE__, $sql);
							}
						}
					}
				}
			}

			message_die(GENERAL_MESSAGE, $lang['Cash_groups_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_groups'], "<a href=\"" . append_sid("admin_cash_groups.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>"));
		}

		break;
//
// ================= Edit board mode ( change form ) ================================
//
	case "edit":
		if ( isset($_POST['group_type']) &&
			 isset($_POST['group_id']) &&
			 is_numeric($_POST['group_type']) &&
			 is_numeric($_POST['group_id']) &&
			 isset($_POST['group_name']) &&
			 isset($_POST['group_description']))
		{
			// so we're editing one of the cash groups at a specific currency.
			$group_type = intval($_POST['group_type']);
			$group_id = intval($_POST['group_id']);
			$group_name = stripslashes($_POST['group_name']);
			$group_description = stripslashes($_POST['group_description']);

			$group = new cash_forumgroup($group_type,$group_id,$group_name,$group_description);

			$cm_groups->load(true,true);
			$group->load();

			$template->set_filenames(array(
				"body" => "admin/cash_group.tpl")
			);

			$hidden_fields = '<input type="hidden" name="mode" value="update" />';
			$hidden_fields .= '<input type="hidden" name="group_type" value="' . $group_type . '" />';
			$hidden_fields .= '<input type="hidden" name="group_id" value="' . $group_id . '" />';

			$template->assign_vars(array(
				"S_CASH_GROUP_ACTION" => append_sid("admin_cash_groups.$phpEx"),

				"S_HIDDEN_FIELDS" => $hidden_fields,

				"NUM_COLUMNS" => ($cash->currency_count() + 1),

				"L_DISPLAY" => $lang['Display'],
				"L_IMPLEMENTATION" => $lang['Implementation'],
				"L_ALLOWANCES" => $lang['Allowances'],
				"L_ALLOWANCES_EXPLAIN" => $lang['Allowances_explain'],

				"L_YES" => $lang['Yes'],
				"L_NO" => $lang['No'],
				"L_CASH_GROUP_TITLE" => $lang['Cash_groups'] . ': ' . $group_name,
				"L_CASH_GROUP_EXPLAIN" => $lang['Cash_groups_explain'],

				"L_CASH_CURRENCY" => $lang['Cash_custom_currency'],

				"L_CASH_AMOUNT_PER_POST" => $lang['Cash_amount_per_post'],
				"L_CASH_AMOUNT_POST_BONUS" => $lang['Cash_amount_post_bonus'],
				"L_CASH_AMOUNT_PER_REPLY" => $lang['Cash_amount_per_reply'],
				"L_CASH_AMOUNT_PER_CHARACTER" => $lang['Cash_amount_per_character'],
				"L_CASH_MAXEARN" => $lang['Cash_maxearn'],
				"L_CASH_AMOUNT_PER_PM" => $lang['Cash_amount_per_pm'],

				"L_CASH_ALLOWANCE_ENABLED" => $lang['Cash_allowance_enabled'],
				"L_CASH_ALLOWANCE_AMOUNT" => $lang['Cash_allowance_amount'],
				"L_CASH_ALLOWANCE_FREQUNECY" => $lang['Cash_allownace_frequency'],
				"L_CASH_ALLOWANCE_FREQUNECIES_DAY" => $lang['Cash_allownace_frequencies'][CASH_ALLOW_DAY],
				"L_CASH_ALLOWANCE_FREQUNECIES_WEEK" => $lang['Cash_allownace_frequencies'][CASH_ALLOW_WEEK],
				"L_CASH_ALLOWANCE_FREQUNECIES_MONTH" => $lang['Cash_allownace_frequencies'][CASH_ALLOW_MONTH],
				"L_CASH_ALLOWANCE_FREQUNECIES_YEAR" => $lang['Cash_allownace_frequencies'][CASH_ALLOW_YEAR],
				"L_CASH_ALLOWANCE_NEXT" => $lang['Cash_allowance_next'],

				"L_SUBMIT" => $lang['Submit'], 
				"L_RESET" => $lang['Reset'])
			);

			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				if ( isset($group->currency_settings[$c_cur->id()]) )
				{
					$g_cur = &$group->currency_settings[$c_cur->id()];

					$allowances_enabled_yes = (( !defined(CASH_ALLOWANCES_ENABLED) ) ? "disabled=\"disabled\" " : "") . (( $g_cur->data('cash_allowance') ) ? "checked=\"checked\"" : "");
					$allowances_enabled_no = ( !$g_cur->data('cash_allowance') ) ? "checked=\"checked\"" : "";

					$allowances_freq_day   = ( $g_cur->data('cash_allowancetime') == CASH_ALLOW_DAY   ) ? "checked=\"checked\"" : "";
					$allowances_freq_week  = ( $g_cur->data('cash_allowancetime') == CASH_ALLOW_WEEK  ) ? "checked=\"checked\"" : "";
					$allowances_freq_month = ( $g_cur->data('cash_allowancetime') == CASH_ALLOW_MONTH ) ? "checked=\"checked\"" : "";
					$allowances_freq_year  = ( $g_cur->data('cash_allowancetime') == CASH_ALLOW_YEAR  ) ? "checked=\"checked\"" : "";

					$allowances_next = $g_cur->data('cash_allowancenext');

					$template->assign_block_vars("cashrow",array(	"CASH_INDEX" => $c_cur->id(),
																	"CURRENCY" => $c_cur->name(),
																	"AMOUNT_PER_POST" => $g_cur->perpost(),
																	"AMOUNT_POST_BONUS" => $g_cur->postbonus(),
																	"AMOUNT_PER_REPLY" => $g_cur->perreply(),
																	"AMOUNT_PER_CHAR" => $g_cur->perchar(),
																	"MAXEARN" => $g_cur->maxearn(),
																	"AMOUNT_PER_PM" => $g_cur->perpm(),
																	"ALLOWANCES_ENABLED_YES" => $allowances_enabled_yes,
																	"ALLOWANCES_ENABLED_NO" => $allowances_enabled_no,
																	"ALLOWANCE_AMOUNT" => $g_cur->allowanceamount(),
																	"ALLOWANCES_FREQ_DAY" => $allowances_freq_day,
																	"ALLOWANCES_FREQ_WEEK" => $allowances_freq_week,
																	"ALLOWANCES_FREQ_MONTH" => $allowances_freq_month,
																	"ALLOWANCES_FREQ_YEAR" => $allowances_freq_year,
																	"ALLOWANCE_NEXT" => $allowances_next
					));
				}
				else
				{
					$allowances_enabled_yes = (( !defined(CASH_ALLOWANCES_ENABLED) ) ? "disabled=\"disabled\" " : "");
					$allowances_enabled_no = "checked=\"checked\"";

					$template->assign_block_vars("cashrow",array(	"CASH_INDEX" => $c_cur->id(),
																	"CURRENCY" => $c_cur->name(),
																	"AMOUNT_PER_POST" => 0,
																	"AMOUNT_POST_BONUS" => 0,
																	"AMOUNT_PER_REPLY" => 0,
																	"AMOUNT_PER_CHAR" => 0,
																	"MAXEARN" => 0,
																	"AMOUNT_PER_PM" => 0,
																	"ALLOWANCES_ENABLED_YES" => $allowances_enabled_yes,
																	"ALLOWANCES_ENABLED_NO" => $allowances_enabled_no,
																	"ALLOWANCE_AMOUNT" => 0,
																	"ALLOWANCES_FREQ_DAY" => "",
																	"ALLOWANCES_FREQ_WEEK" => "checked=\"checked\"",
																	"ALLOWANCES_FREQ_MONTH" => "",
																	"ALLOWANCES_FREQ_YEAR" => "",
																	"ALLOWANCE_NEXT" => 0
					));
				}


			}

			$template->pparse("body");

			include_once('./page_footer_admin.'.$phpEx);

		}
		break;
//
// ================= Default board mode (listing) ================================
//
	default:
		$cm_groups->load(true,true);
		$groups = array();
		//
		// Levels
		//
		$groups[] = new cash_forumgroup(CASH_GROUPS_LEVEL,ADMIN,$lang['Administrators'],$lang['Administrators']);
		$groups[] = new cash_forumgroup(CASH_GROUPS_LEVEL,MOD,$lang['Moderators'],$lang['Moderators']);
		//
		// Ranks
		//
		$sql = "SELECT rank_id, rank_title, rank_min FROM " . RANKS_TABLE . "
				WHERE rank_special = 0
				ORDER BY rank_min DESC";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, "Could not query ranks information", "", __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$groups[] = new cash_forumgroup(CASH_GROUPS_RANK,intval($row['rank_id']),$row['rank_title'],$row['rank_min'] . " " . $lang['Posts']);
		}
		//
		// Usergroups
		//
		$sql = "SELECT group_id, group_name, group_description FROM " . GROUPS_TABLE . "
				WHERE group_single_user = 0
				ORDER BY group_id DESC";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, "Could not query usergroup information", "", __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$groups[] = new cash_forumgroup(CASH_GROUPS_USERGROUP,intval($row['group_id']),$row['group_name'],$row['group_description']);
		}
		//
		// load up info for each group
		//
		for( $i = 0; $i < count($groups); $i++ )
		{
			$groups[$i]->load();
		}
		//
		// Don't use this function when programming unless you know what you're doing with it.
		// (this is actually the only place it should ever appear)
		//
		$cm_groups->cleanup();

		$cash_indices = array();
		while ( $c_cur = &$cash->currency_next($cm_i) )
		{
			$cash_indices[] = $c_cur->id();
			$cash_names[] = $c_cur->name();
		}

		$template->set_filenames(array(
			"body" => "admin/cash_groups.tpl")
		);

		$template->assign_vars(array(
			"S_CASH_GROUPS_ACTION" => append_sid("admin_cash_groups.$phpEx"),

			"L_CASH_GROUPS_TITLE" => $lang['Cash_groups'],
			"L_CASH_GROUPS_EXPLAIN" => $lang['Cash_groups_explain'],

			"L_EDIT" => $lang['Edit'],
			"L_UPDATE" => $lang['Update'],
			"L_OMIT" => $lang['Omit'],
			"L_ADD" => $lang['Add'],
			"L_REMOVE" => $lang['Remove'],
			"L_SET" => $lang['Set'],

			"NUM_COLUMNS" => (count($cash_indices) + 2),
			"NUM_CURRENCIES" => count($cash_indices))
		);

		for ( $i = 0; $i < count($groups); $i++ )
		{
			$hidden_fields = '<input type="hidden" name="group_type" value="' . $groups[$i]->group_type . '" />';
			$hidden_fields .= '<input type="hidden" name="group_id" value="' . $groups[$i]->group_id . '" />';
			$hidden_fields .= '<input type="hidden" name="group_name" value="' . $groups[$i]->group_name . '" />';
			$hidden_fields .= '<input type="hidden" name="group_description" value="' . $groups[$i]->group_description . '" />';
			$cell_width = floor(100/(count($cash_indices)+1));
			$remainder_width = 100 - ($cell_width * count($cash_indices));
			$merge_width = 100 - $remainder_width;
			$template->assign_block_vars('entryrow',array(	"NAME" => $groups[$i]->group_name,
															"DESCRIPTION" => $groups[$i]->group_description,
															"TYPE" => $groups[$i]->group_type,
															"ID" => $groups[$i]->group_id,
															"CELLWIDTH" => $cell_width,
															"MERGEWIDTH" => $merge_width,
															"REMAINDERWIDTH" => $remainder_width,
															"S_HIDDEN_FIELDS1" => $hidden_fields . '<input type="hidden" name="mode" value="edit" />',
															"S_HIDDEN_FIELDS2" => $hidden_fields . '<input type="hidden" name="mode" value="set" />'));
			$has_entries = $groups[$i]->has_entries();
			if ( $has_entries )
			{
				$template->assign_block_vars('entryrow.switch_displayon',array());
			}
			else
			{
				$template->assign_block_vars('entryrow.switch_displayoff',array());
			}

			for ( $j = 0; $j < count($cash_indices); $j++ )
			{
				$template->assign_block_vars('entryrow.cashrow',array(	"NAME" => $cash_names[$j],
																		"S_TYPE_FIELD" => 'update_type[' . $cash_indices[$j] . ']',
																		"S_AMOUNT_FIELD" => 'update_amount[' . $cash_indices[$j] . ']'));
				if ( $has_entries && isset($groups[$i]->currency_settings[$cash_indices[$j]]) )
				{
					$template->assign_block_vars('entryrow.switch_displayon.cashrow',array("ENTRY" => $lang['Set']));
				}
				else if ( $has_entries )
				{
					$template->assign_block_vars('entryrow.switch_displayon.cashrow',array("ENTRY" => '<hr width="95%" style="border: #000000;" />'));
				}
			}
		}
		$template->pparse("body");


include_once('page_footer_admin.' . $phpEx);

		break;
}

?>
