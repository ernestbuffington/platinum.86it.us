<?php
/***************************************************************************
 *                              cash_events.php
 *                            -------------------
 *   begin                : Thursday, Sep 18, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_events.php,v 1.0.2.0 2003/10/07 22:37:54 Xore $
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
	$phpbb['Cash/Shop Mod']['Cash_Events'] = $file;
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
// ================= Add event (no data) ================================
//
	case "add":
		if ( isset($_POST['new_event_name']) )
		{
			$sql = "INSERT INTO " . CASH_EVENTS_TABLE . " (event_name, event_data) VALUES ('" . str_replace("\'","''",$_POST['new_event_name']) . "', '')";
			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Could add event", "", __LINE__, __FILE__, $sql);
			}
			message_die(GENERAL_MESSAGE, $lang['Cash_events_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_events'], "<a href=\"" . append_sid("admin_cash_events.$phpEx") . "\">", "</a>") . "<br /><br />");
		}
		break;
//
// ================= Update board mode ( submitted form ) ================================
//
	case "update":
		if ( isset($_POST['event_name']) && isset($_POST['cash']) && is_array($_POST['cash']) )
		{
			$event_name = $_POST['event_name'];
			$updates = array();
			$updated_data = '';
			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				if ( isset($_POST['cash'][$c_cur->id()]) )
				{
					$entry = cash_floatval($_POST['cash'][$c_cur->id()]);
					if( $entry != 0 )
					{
						$updates[] = $c_cur->id() . CASH_EVENT_DELIM2 . $entry;
					}
				}
			}
			if ( count($updates) )
			{
				$updated_data = implode(CASH_EVENT_DELIM1,$updates);
			}
			$sql = "UPDATE " . CASH_EVENTS_TABLE . "
					SET event_data = '" . $updated_data . "'
					WHERE event_name = '" . str_replace("\'","''",$event_name) . "'";
			if ( !($db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, "Could not update event", "", __LINE__, __FILE__, $sql);
			}
			message_die(GENERAL_MESSAGE, $lang['Cash_events_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_events'], "<a href=\"" . append_sid("admin_cash_events.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>"));
		}
		break;
//
// ================= Edit board mode ( or delete ) ================================
//
	case "edit":
		if ( isset($_POST['event_name']) )
		{
			$event_name = $_POST['event_name'];
			if ( isset($_POST['delete']) )
			{
				$sql = "DELETE FROM " . CASH_EVENTS_TABLE . " WHERE event_name = '" . str_replace("\'","''",$event_name) . "'";
				if ( !($db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, "Could not delete event", "", __LINE__, __FILE__, $sql);
				}
				message_die(GENERAL_MESSAGE, $lang['Cash_events_updated'] . "<br /><br />" . sprintf($lang['Click_return_cash_events'], "<a href=\"" . append_sid("admin_cash_events.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>"));
			}
			$sql = "SELECT *
					FROM " . CASH_EVENTS_TABLE . "
					WHERE event_name = '" . str_replace("\'","''",$event_name) . "'";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, "Could not query events information", "", __LINE__, __FILE__, $sql);
			}
			if ( !($row = $db->sql_fetchrow($result)) )
			{
				message_die(CRITICAL_ERROR, "Event does not exist", "", __LINE__, __FILE__, $sql);
			}
			
			$cash_amounts = cash_event_unpack($row['event_data']);

			$template->set_filenames(array(
				"body" => "admin/cash_event.tpl")
			);

			$hidden_fields = '<input type="hidden" name="event_name" value="' . $event_name . '" /><input type="hidden" name="mode" value="update" />';
			$template->assign_vars(array(
				"S_CASH_EVENTS_ACTION" => append_sid("admin_cash_events.$phpEx"),
				"S_HIDDEN_FIELDS" => $hidden_fields,

				"L_CASH_EVENTS_TITLE" => $lang['Cash_events'],
				"L_CASH_EVENTS_EXPLAIN" => $lang['Cash_events_explain'],

				"EVENT_NAME" => $event_name,

				"L_SUBMIT" => $lang['Submit'],
				"L_RESET" => $lang['Reset'])
			);

			$i = 0;
			while ( $c_cur = &$cash->currency_next($cm_i) )
			{
				$i++;
				$template->assign_block_vars('cashrow',array(	"CLASS" => (( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2']),
																"CASH_NAME" => $c_cur->name(),
																"S_CASH_FIELD" => 'cash[' . $c_cur->id() . ']',
																"AMOUNT" => isset($cash_amounts[$c_cur->id()]) ? $cash_amounts[$c_cur->id()] : 0 )
				);
			}
			
			$template->pparse("body");

			include_once('./page_footer_admin.'.$phpEx);

		}
		break;
//
// ================= Default board mode (listing) ================================
//
	default:
		$sql = "SELECT *
				FROM " . CASH_EVENTS_TABLE;
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, "Could not query events information", "", __LINE__, __FILE__, $sql);
		}
		$events = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$events[] = $row;
		}

		$template->set_filenames(array(
			"body" => "admin/cash_events.tpl")
		);

		$template->assign_vars(array(
			"S_CASH_GROUPS_ACTION" => append_sid("admin_cash_events.$phpEx"),

			"L_CASH_EVENTS_TITLE" => $lang['Cash_events'],
			"L_CASH_EVENTS_EXPLAIN" => $lang['Cash_events_explain'],

			"L_EXISTING_EVENTS" => $lang['Existing_events'],
			"L_ADD_AN_EVENT" => $lang['Add_an_event'],

			"L_EDIT" => $lang['Edit'],
			"L_DELETE" => $lang['Delete'],
			"L_ADD" => $lang['Add'],
			"L_NO_EVENTS" => $lang['No_events'])
		);

		for ( $i = 0; $i < count($events); $i++ )
		{
			$template->assign_block_vars('eventrow',array(	"NAME" => $events[$i]['event_name'] ) );
		}
		if ( !count($events) )
		{
			$template->assign_block_vars('switch_noevents',array() );
		}

		$template->pparse("body");


include_once('./page_footer_admin.' . $phpEx);


		break;
}

?>
