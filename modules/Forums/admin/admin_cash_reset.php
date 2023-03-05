<?php
/***************************************************************************
 *                              cash_reset.php
 *                            -------------------
 *   begin                : Thursday, Sep 26, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_events.php,v 1.0.0.0 2003/09/26 01:21:54 Xore $
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
	$phpbb['Cash/Shop Mod']['Cash_Reset'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
//Begin PNphpBB2 Module
//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
include_once("../../../includes/functions_selects.php");
//End PNphpBB2 Module

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;
	include_once($phpbb_root_path . 'admin/admin_cash.' . $phpEx);

}

if ( !$cash->currency_count() )
{
	message_die(GENERAL_MESSAGE, $lang['Insufficient_currencies']);
}

$mode = isset($_POST['mode'])?$_POST['mode']:"main";

switch ( $mode )
{
	case "reset":
		if ( isset($_POST['confirm']) && isset($_POST['cash_amount']) && is_array($_POST['cash_amount']) && isset($_POST['cids']) )
		{
			$cids = explode(",",$_POST['cids']);
			$cash_check = array();
			for ( $i = 0; $i < count($cids);$i++ )
			{
				if ( isset($_POST['cash_amount'][$cids[$i]]) )
				{
					$cash_check[$cids[$i]] = cash_floatval($_POST['cash_amount'][$cids[$i]]);
				}
			}
			$update_clause = array();
			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				if ( isset($cash_check[$c_cur->id()]) )
				{
					$update_clause[] = $c_cur->db() . ' = ' . $cash_check[$c_cur->id()];
				}
			}
			if ( count($update_clause) )
			{
				$sql = "UPDATE " . USERS_TABLE . "
						SET " . implode(", ", $update_clause);
				if ( !($db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, "Could not reset user Cash information", "", __LINE__, __FILE__, $sql);
				}
				message_die(GENERAL_MESSAGE, "<br />" . $lang['Update_successful'] . "<br /><br />" .  sprintf($lang['Click_return_cash_reset'], "<a href=\"" . append_sid("admin_cash_reset.$phpEx") . "\">", "</a>") . "<br /><br />");
			}
		}
		break;
	case "submitted":
		if ( isset($_POST['submit']) && isset($_POST['cash_check']) && is_array($_POST['cash_check']) )
		{
			switch($_POST['submit'])
			{
				case $lang['Set_checked']:
					if ( isset($_POST['cash_amount']) && is_array($_POST['cash_amount']) )
					{
						$s_hidden_fields = '';
						$c_ids = array();

						while ( $c_cur = &$cash->currency_next($cm_i) )
						{
							if ( isset($_POST['cash_check'][$c_cur->id()]) && isset($_POST['cash_amount'][$c_cur->id()]) )
							{
								$c_ids[] = $c_cur->id();
								$s_hidden_fields .= '<input type="hidden" name="cash_amount[' . $c_cur->id() . ']" value="' . cash_floatval($_POST['cash_amount'][$c_cur->id()]) . '" />';
							}
						}
						if ( count($c_ids) )
						{
							$s_hidden_fields .= '<input type="hidden" name="cids" value="' . implode(',',$c_ids) . '" />';
							$s_hidden_fields .= '<input type="hidden" name="mode" value="reset" />';
							$l_confirm = $lang['Cash_confirm_reset'];
							$template->set_filenames(array(
								'confirm_body' => 'confirm_body.tpl')
							);
							$template->assign_vars(array(
								'MESSAGE_TITLE' => $lang['Information'],
								'MESSAGE_TEXT' => $l_confirm,
								'L_YES' => $lang['Yes'],
								'L_NO' => $lang['No'],
								'S_CONFIRM_ACTION' => append_sid("admin_cash_reset.$phpEx"),
								'S_HIDDEN_FIELDS' => $s_hidden_fields)
							);
							$template->pparse('confirm_body');
							//include_once('includes/page_tail.'.$phpEx);
							die();
						}
					}
					break;
				case $lang['Recount_checked']:
					$c_ids = array();
					while ( $c_cur = &$cash->currency_next($cm_i) )
					{
						if ( isset($_POST['cash_check'][$c_cur->id()]) )
						{
							$c_ids[] = $c_cur->id();
						}
					}
					if ( count($c_ids) )
					{
						$s_hidden_fields = '<input type="hidden" name="cids" value="' . implode(',',$c_ids) . '" />';
						$l_confirm = sprintf($lang['Cash_confirm_recount'],'<a href="' . append_sid("admin_board.$phpEx") . '">','</a>');
						$template->set_filenames(array(
							'confirm_body' => 'confirm_body.tpl')
						);
						$template->assign_vars(array(
							'MESSAGE_TITLE' => $lang['Information'],
							'MESSAGE_TEXT' => $l_confirm,
							'L_YES' => $lang['Yes'],
							'L_NO' => $lang['No'],
							'S_CONFIRM_ACTION' => append_sid("admin_cash_recount.$phpEx"),
							'S_HIDDEN_FIELDS' => $s_hidden_fields)
						);
						$template->pparse('confirm_body');
						//include_once('includes/page_tail.'.$phpEx);
						die();
					}
					break;
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, "<br />" .  sprintf($lang['Click_return_cash_reset'], "<a href=\"" . append_sid("admin_cash_reset.$phpEx") . "\">", "</a>") . "<br /><br />");

		}
		break;
	default:

		if( isset($board_config['cash_resetting']) )
		{
			$template->set_filenames(array(
				"body" => "admin/cash_resetting.tpl")
			);

			$strings = explode(",",$board_config['cash_resetting']);

			$template->assign_vars(array(
				"L_CASH_RESETTING" => $lang['Cash_resetting'],
				"L_USER" => sprintf($lang['User_of'],$strings[0],$strings[1]))
			);
		}
		else
		{
			$template->set_filenames(array(
				"body" => "admin/cash_reset.tpl")
			);
			$hidden_fields = '<input type="hidden" name="mode" value="submitted" />';

			$template->assign_vars(array(
				"S_RESET_ACTION" => append_sid("admin_cash_reset.$phpEx"),
				"S_HIDDEN_FIELDS" => $hidden_fields,

				"L_CASH_RESET_TITLE" => $lang['Cash_reset_title'],
				"L_CASH_RESET_EXPLAIN" => $lang['Cash_reset_explain'],
				
				"L_SET_CHECKED" => $lang['Set_checked'],
				"L_RECOUNT_CHECKED" => $lang['Recount_checked'],
				"L_RESET" => $lang['Reset'])
			);

			$i = 0;
			while( $c_cur = &$cash->currency_next($cm_i) )
			{
				$i++;
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars("cashrow",array(	"ID" => $c_cur->id(),
																"NAME" => $c_cur->name(),
																"DEFAULT" => $c_cur->data('cash_default'),

																"ROW_CLASS" => $row_class,
																"ROW_COLOR" => $row_color)
											 );
			}
		}

		$template->pparse("body");


include_once('page_footer_admin.' . $phpEx);


		break;
}

?>
