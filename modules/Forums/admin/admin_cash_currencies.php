<?php
/***************************************************************************
 *                              cash_currencies.php
 *                            -------------------
 *   begin                : Thursday, Apr 18, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_currencies.php,v 2.1.0.0 2003/09/18 23:02:15 Xore $
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
	$phpbb['Cash/Shop Mod']['Cash_Currencies'] = "$file";
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

if ( isset($_POST['submit']) )
{
	switch($_POST['submit'])
	{
		case $lang['Update']:
			$_POST['set'] = 'updatecurrency';
			break;
		case $lang['Delete']:
			$_POST['set'] = 'deletecurrency';
			break;
	}
}

$num_currencies = 0;
$good_order = true;
//
// Pull all config data
//
if ( isset($_POST['set']) )
{
	switch ( $_POST['set'] )
	{
		case 'updatecurrency': // Change Currency Name
			if ( isset($_POST['cid']) && is_numeric($_POST['cid']) && $cash->currency_exists(intval($_POST['cid'])) )
			{
				/*
					This update works on several levels. If it's just a name change, it's simple... update the value in the Cash Table.
					However, if there's a default value update require_onced, then we need to update the default value for the user table column.
					Also, if there's a change in decimals, we need to update that for the user column, if applicable.
					(by default, we want to _not_ run redundant updates on the system)
					Note: if the DBMS doesn't use a decimal-specific float field, we don't need to update it.
				*/
				$c_cur = $cash->currency(intval($_POST['cid']));
				$newname = $_POST['rename_value'];
				$newdefault = intval($_POST['default_value']);
				$newdecimal = intval($_POST['decimal_value']);
				$update_name = ($c_cur->data('cash_name') != $newname);
				$update_default = ($c_cur->data('cash_default') != $newdefault);
				$update_decimal = ($c_cur->data('cash_decimal') != $newdecimal);
				//
				// If it's points, update the config points variable (retro- Points System. bleh)
				//
				if ( $c_cur->db() == "points" )
				{
					$sql = "UPDATE " . CONFIG_TABLE . "
							SET config_value = '" . str_replace("\'", "''", $new_name) . "'
							WHERE config_name = 'points_name'";
					if ( !($db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, "Could not update cash name", "", __LINE__, __FILE__, $sql);
					}
				}
				$sql = array();
				switch ( SQL_LAYER )
				{
					case 'postgresql':
						if ( $update_default )
						{
							$sql[] = "ALTER TABLE " . USERS_TABLE . " ALTER COLUMN " . $c_cur->db() . " SET DEFAULT '$newdefault'";
						}
						break;
					case 'mssql':
					case 'mssql-odbc':
						if ( $update_default )
						{
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP CONSTRAINT df_" . $c_cur->db();
							$sql[] = "ALTER TABLE " . USERS_TABLE . " ADD CONSTRAINT [df_" . $c_cur->db() . "] DEFAULT ($newdefault) FOR [" . $c_cur->db() . "]";
						}
						break;
					case 'mysql':
					case 'mysql4':
						if ( $update_default || $update_decimal )
						{
							$sql[] = "ALTER TABLE " . USERS_TABLE . " MODIFY " . $c_cur->db() . " DECIMAL( 11, $newdecimal ) DEFAULT '$newdefault' NOT NULL";
						}
						break; 
					case 'msaccess':
					case 'oracle': 
					default:
						break;
				}
				//
				// Update the Cash Table
				//
				$sql[] = "UPDATE " . CASH_TABLE . "
						SET cash_name = '" . str_replace("\'", "''", $newname) . "', cash_default = '" . $newdefault . "', cash_decimals = '" . $newdecimal . "'
						WHERE cash_id = " . $c_cur->id();
				for( $i = 0; $i < count($sql); $i++ )
				{
					if ( !($db->sql_query($sql[$i])) )
					{
						message_die(CRITICAL_ERROR, "Could not update currency", "", __LINE__, __FILE__, $sql);
					}
				}
				//
				// Log the action
				//
				// [admin/mod id][admin/mod name][copied currency name][copied over currency name]

				$action = array($userdata['user_id'],
								$userdata['username'],
								$c_cur->name(true),
								$newname
					);
				cash_create_log( CASH_LOG_ADMIN_RENAME_CURRENCY , $action );
			}
			break;
		case 'deletecurrency': // Delete Currency
			if ( isset($_POST['cid']) && !isset($_POST['cancel']) && is_numeric($_POST['cid']) && $cash->currency_exists(intval($_POST['cid'])) )
			{
				$c_cur = $cash->currency(intval($_POST['cid']));
				if ( !isset($_POST['confirm']) )
				{
					$s_hidden_fields = '<input type="hidden" name="set" value="deletecurrency" />';
					$s_hidden_fields .= '<input type="hidden" name="cid" value="' . $c_cur->id() . '" />';
					$l_confirm = sprintf($lang['Cash_confirm_delete'],$c_cur->name(true));
					$template->set_filenames(array(
						'confirm_body' => 'confirm_body.tpl')
					);
					$template->assign_vars(array(
						'MESSAGE_TITLE' => $lang['Information'],
						'MESSAGE_TEXT' => $l_confirm,
						'L_YES' => $lang['Yes'],
						'L_NO' => $lang['No'],
						'S_CONFIRM_ACTION' => append_sid("admin_cash_currencies.$phpEx"),
						'S_HIDDEN_FIELDS' => $s_hidden_fields)
					);
					$template->pparse('confirm_body');
					//include_once('/includes/page_tail.'.$phpEx);
					die();
				}
				else
				{
					//
					// Delete the field
					//
					$sql = array();
					switch ( SQL_LAYER )
					{
						case 'msaccess':
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP " . $c_cur->db();
							break;
						// No drop column option available before Oracle8i v8.1 
						case 'oracle': 
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP " . $c_cur->db();
							break; 
						case 'postgresql':
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP COLUMN " . $c_cur->db();
							break;
						case 'mssql':
						case 'mssql-odbc':
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP CONSTRAINT df_" . $c_cur->db();
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP COLUMN " . $c_cur->db();
							break;
						case 'mysql':
						case 'mysql4':
						default:
							$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP " . $c_cur->db();
							break;
					}
					for ($i = 0; $i < count($sql); $i++ )
					{
						if ( !$db->sql_query($sql[$i]) )
						{
							message_die(CRITICAL_ERROR, "Could not update user table", "", __LINE__, __FILE__, $sql);
						}
					}
					//
					// Delete the cash table entry
					//
					$sql = "DELETE FROM " . CASH_TABLE . "
							WHERE cash_id = " . $c_cur->id();
					if ( !($db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, "Unable to remove cash table entry, It is recommended you remove it manually as soon as possible", "", __LINE__, __FILE__, $sql);
					}
					//
					// Delete exchange table entries
					//
					$sql = "DELETE FROM " . CASH_EXCHANGE_TABLE . "
							WHERE ex_cash_id1 = " . $c_cur->id() . " OR ex_cash_id2 = " . $c_cur->id();
					if ( !($db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, "Unable to remove exchange table entries.", "", __LINE__, __FILE__, $sql);
					}
					//
					// Log the action
					//
					// [admin/mod id][admin/mod name][currency name]
					$action = array($userdata['user_id'],
									$userdata['username'],
									$c_cur->name(true)
						);
					cash_create_log( CASH_LOG_ADMIN_DELETE_CURRENCY , $action );
					$_POST['submit'] = true;
				}
			}
			break;
		case 'copycurrency': // Copy Currency
			if ( !isset($_POST['cancel']) &&
				isset($_POST['cid1']) &&
				is_numeric($_POST['cid1']) &&
				$cash->currency_exists(intval($_POST['cid1'])) &&
				isset($_POST['cid2']) &&
				is_numeric($_POST['cid2']) &&
				$cash->currency_exists(intval($_POST['cid2'])) &&
				(intval($_POST['cid1']) != intval($_POST['cid2'])) )
			{
				$c_cur1 = $cash->currency(intval($_POST['cid1']));
				$c_cur2 = $cash->currency(intval($_POST['cid2']));
				if ( !isset($_POST['confirm']) )
				{
					$s_hidden_fields = '<input type="hidden" name="set" value="copycurrency" />';
					$s_hidden_fields .= '<input type="hidden" name="cid1" value="' . $c_cur1->id() . '" />';
					$s_hidden_fields .= '<input type="hidden" name="cid2" value="' . $c_cur2->id() . '" />';
					$l_confirm = sprintf($lang['Cash_confirm_copy'],$c_cur1->name(true),$c_cur2->name(true));
					$template->set_filenames(array(
						'confirm_body' => 'confirm_body.tpl')
					);
					$template->assign_vars(array(
						'MESSAGE_TITLE' => $lang['Information'],
						'MESSAGE_TEXT' => $l_confirm,
						'L_YES' => $lang['Yes'],
						'L_NO' => $lang['No'],
						'S_CONFIRM_ACTION' => append_sid("admin_cash_currencies.$phpEx"),
						'S_HIDDEN_FIELDS' => $s_hidden_fields)
					);
					$template->pparse('confirm_body');
					//include_once('/includes/page_tail.'.$phpEx);
					die();
				}
				else
				{
					//
					// Copy the data
					//
					$sql = "UPDATE " . USERS_TABLE . " SET " . $c_cur2->db() . " = " . $c_cur1->db();
					if ( !$db->sql_query($sql) )
					{
						message_die(CRITICAL_ERROR, "Could not update user table", "", __LINE__, __FILE__, $sql);
					}
					//
					// Log the action
					//
					// [admin/mod id][admin/mod name][copied currency name][copied over currency name]
					$action = array($userdata['user_id'],
									$userdata['username'],
									$c_cur1->name(true),
									$c_cur2->name(true)
						);
					cash_create_log( CASH_LOG_ADMIN_COPY_CURRENCY , $action );
				}
			}
			break;
		case 'newcurrency': // Create Currency
			if ( isset($_POST['currency_name']) &&
			     isset($_POST['currency_dbfield']) &&
			     isset($_POST['currency_decimals']) &&
			     isset($_POST['currency_default']) &&
			     is_numeric($_POST['currency_decimals']) &&
			     is_numeric($_POST['currency_default']) )
			{
				$regex = "/^user_[a-z]+$/";
				$new_name = stripslashes($_POST['currency_name']);
				$new_field = stripslashes($_POST['currency_dbfield']);
				$new_decimals = intval(max(0,intval($_POST['currency_decimals'])));
				$factor = pow(10,$new_decimals);
				$new_default = ( $new_decimals > 0 ) ? (intval($_POST['currency_default'] * $factor) / $factor) : intval($_POST['currency_default']);
				$new_order = $cash->currency_count() + 1;
				//
				// Make sure it matches a valid database field... "user_word"
				//
				if ( !(preg_match( $regex, $new_field)) )
				{
					message_die(GENERAL_ERROR, sprintf($lang['Bad_dbfield'],'$regex = \'/^user_[a-z]+$/\';'));
				}

				//
				// Built insert query
				//
				$sql = "";
				switch ( SQL_LAYER )
				{
					case 'msaccess':
						$sql = "ALTER TABLE " . USERS_TABLE . " ADD COLUMN $new_field float NOT NULL";
						break;
					case 'oracle': 
						$sql = "ALTER TABLE " . USERS_TABLE . " ADD ($new_field NUMBER(11,$new_decimals) DEFAULT $new_default NOT NULL)";
						break;
					case 'postgresql':
						$sql = "ALTER TABLE " . USERS_TABLE . " ADD COLUMN $new_field float8 NOT NULL DEFAULT '$new_default'";
						break;
					case 'mssql':
					case 'mssql-odbc':
						$sql = "ALTER TABLE " . USERS_TABLE . " ADD $new_field float NOT NULL CONSTRAINT df_$new_field DEFAULT '$new_default'";
						break;
					case 'mysql':
					case 'mysql4':
					default:
						$sql = "ALTER TABLE " . USERS_TABLE . " ADD $new_field DECIMAL(11,$new_decimals) NOT NULL DEFAULT '$new_default'";
						break;
				}
				if ( !$db->sql_query($sql) )
				{
					$flag = false;
					while ( $c_cur = &$cash->currency_next($cm_i) )
					{
						if ( $c_cur->db() == $new_field )
						{
							$flag = true;
						}
					}
					if ( $flag || (($new_field != 'points') && ($new_field != 'user_cash') && ($new_field != 'user_money')) )
					{
						message_die(CRITICAL_ERROR, "Could not update user table (possibly duplicate cash db field)", "", __LINE__, __FILE__, $sql);
					}
				}
				//
				// If it's points, update the config points variable (retro- Points System. bleh)
				//
				if ( $new_field == "points" )
				{
					$sql = "UPDATE " . CONFIG_TABLE . "
							SET config_value = '" . str_replace("\'", "''", $new_name) . "'
							WHERE config_name = 'points_name'";
					if ( !($db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, "Could not update points_name", "", __LINE__, __FILE__, $sql);
					}
				}
				//
				// Insert new entry into the cash table
				//
				$sql = "INSERT INTO " . CASH_TABLE . "
						(cash_name, cash_dbfield, cash_order, cash_decimals,cash_default) 
VALUES ('" . str_replace("\'", "''", $new_name) . "','" . $new_field . "'," . $new_order . "," . $new_decimals . "," . $new_default . ")";
				if ( !$db->sql_query($sql) )
				{
					message_die(CRITICAL_ERROR, "Unable to insert new record into cash table", "", __LINE__, __FILE__, $sql);
				}
				$cid = $db->sql_nextid();
				$sql = "UPDATE " . CASH_TABLE . "
						SET cash_perpost = cash_perpost * $factor,
							cash_postbonus = cash_postbonus * $factor,
							cash_perreply = cash_perreply * $factor,
							cash_maxearn = cash_maxearn * $factor,
							cash_perpm = cash_perpm * $factor,
							cash_perchar = cash_perchar * $factor,
							cash_allowanceamount = cash_allowanceamount * $factor
						WHERE cash_dbfield = '$new_field'";
				if ( !$db->sql_query($sql) )
				{
					message_die(CRITICAL_ERROR, "Unable to insert new record into cash table", "", __LINE__, __FILE__, $sql);
				}
				$cid = $db->sql_nextid();
				//
				// Log the action
				//
				// [admin/mod id][admin/mod name][currency name]
				$action = array($userdata['user_id'],
								$userdata['username'],
								$new_name
					);
				cash_create_log( CASH_LOG_ADMIN_CREATE_CURRENCY , $action );
			}
			break;
	}
}

if ( isset($_POST['submit']) )
{
	$message = $lang['Cash_currencies_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_currencies'], "<a href=\"" . append_sid("admin_cash_currencies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}

if ( isset($_GET['set']) && isset($_GET['cord']) && is_numeric($_GET['cord']) )
{
	$cord = intval($_GET['cord']);
	$old = $new = 0;
	switch ( $_GET['set'] )
	{
		case "up":
			$old = $cord;
			$new = $cord - 1;
			break;
		case "down":
			$old = $cord;
			$new = $cord + 1;
			break;
		default:
			$old = $cord;
			$new = $cord;
			break;
	}
	$focal = $old + $new;
	//
	// Update the order by flipping the entry we want to change, and it's replacement, over their common focal point
	// ie, switch 6 and 7, set 6 to 13 - 6 = 7, and set 7 to 13 - 7 = 6.
	// thus swapping the two values
	// If we're swapping with a null entry, the re-orderer will catch it on the way out
	//
	$sql = "UPDATE " . CASH_TABLE . "
			SET cash_order = $focal - cash_order
			WHERE cash_order = $old OR cash_order = $new";
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Failed to fix Cash Mod order", "", __LINE__, __FILE__, $sql);
	}
	$cash->refresh_table();
}

$cash->reorder();
	
$template->set_filenames(array(
	"body" => "admin/cash_currencies.tpl")
);

$template->assign_vars(array(
	"S_CASH_CURRENCY_ACTION" => append_sid("cash_currency.$phpEx"),

	"L_CASH_CURRENCIES_TITLE" => $lang['Cash_currencies'],
	"L_CASH_CURRENCIES_EXPLAIN" => $lang['Cash_currencies_explain'],

	"L_NEW_CURRENCY" => $lang['Cash_new_currency'],
	"L_COPY_CURRENCY" => $lang['Cash_copy_currency'],
	"L_FIELD" => $lang['Cash_field'],
	"L_CURRENCY" => $lang['Name_of_currency'],
	"L_DEFAULT" => $lang['Default'],
	"L_DECIMALS" => $lang['Decimals'],
	"L_UPDATE" => $lang['Update'],
	"L_ORDER" => $lang['Cash_order'],
	"L_DELETE_CURRENCY" => $lang['Cash_delete'],
	"L_MOVE_UP" => $lang['Move_up'],
	"L_MOVE_DOWN" => $lang['Move_down'],
	"L_CURRENCY_DBFIELD" => $lang['Cash_currency_dbfield'],
	"L_CURRENCY_DECIMALS" => $lang['Cash_currency_decimals'],
	"L_CURRENCY_DEFAULT" => $lang['Cash_currency_default'],
	"L_SET" => $lang['Set'],
	"L_DELETE" => $lang['Delete'],
	"L_FROM" => ucwords($lang['From']),
	"L_TO" => ucwords($lang['To']),
	"L_SELECT_ONE" => $lang['Select_one'],

	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'])
);

$c_cur = 0;
while ( $c_cur = &$cash->currency_next($cm_i) )
{
	$template->assign_block_vars("cashrow",array(	"U_MOVE_UP" => append_sid("admin_cash_currencies.$phpEx?set=up&cord=" . $c_cur->data('cash_order')),
													"U_MOVE_DOWN" => append_sid("admin_cash_currencies.$phpEx?set=down&cord=" . $c_cur->data('cash_order')),
													
													"CASH_INDEX" => $c_cur->id(),
													"DBFIELD" => $c_cur->db(),
													"DEFAULT" => $c_cur->data('cash_default'),
													"DECIMALS" => $c_cur->data('cash_decimals'),
													"CURRENCY" => $c_cur->name(true,'"'),
													"NAME" => $c_cur->name(true)
	));

}

$template->pparse("body");


include_once('./page_footer_admin.' . $phpEx);


?>
