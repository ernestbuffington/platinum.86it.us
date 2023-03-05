<?php
/***************************************************************************
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: admin_topic_shadow.php,v 1.1 2003/05/18 21:16:28 nivisec Exp $
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

define('IN_PHPBB', TRUE);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Forums']['Topic_Shadow'] = $filename;
	
	return;
}

$phpbb_root_path = '../';
require_once($phpbb_root_path . 'extension.inc');
(file_exists('pagestart.' . $phpEx)) ? require_once('pagestart.' . $phpEx) : require_once('pagestart.inc');

require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_topic_shadow.' . $phpEx);

/****************************************************************************
/** Constants and Main Vars.
/***************************************************************************/
$mode_types = array('topic_time', 'topic_title');
$order_types = array('DESC', 'ASC');
$page_title = $lang['Topic_Shadow'];
$status_message = '';

/****************************************************************************
/** Functions
/***************************************************************************/
function ts_make_mode_drop_box()
{
	global $mode_types, $lang, $mode;
	
	$rval = '<select name="mode">';
	foreach($mode_types as $val)
	{
		$selected = ($mode == $val) ? 'selected="selected"' : '';
		$rval .= "<option value=\"$val\" $selected>" . $lang[$val] . '</option>';
	}
	$rval .= '</select>';
	
	return $rval;
}

function ts_make_order_drop_box()
{
	global $order_types, $lang, $order;
	
	$rval = '<select name="order">';
	foreach($order_types as $val)
	{
		$selected = ($order == $val) ? 'selected="selected"' : '';
		$rval .= "<option value=\"$val\" $selected>" . $lang[$val] . '</option>';
	}
	$rval .= '</select>';
	
	return $rval;
}

function ts_id_2_name($id, $mode = 'user')
{
	global $db;
	
	if ($id == '')
	{
		return '?';
	}
	
	switch($mode)
	{
		case 'user':
		{
			$sql = 'SELECT username FROM ' . USERS_TABLE . "
	   			WHERE user_id = $id";
			
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Err', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			return $row['username'];
			break;
		}
		case 'forum':
		{
			$sql = 'SELECT f.forum_name FROM ' . FORUMS_TABLE . ' f, ' . TOPICS_TABLE . " t
	   		   WHERE t.topic_id = $id
			   AND t.forum_id = f.forum_id";
			
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Err', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			return $row['forum_name'];
			break;
		}
		default:
		break;
	}
}

/*******************************************************************************************
/** Get parameters.  'var_name' => 'default_value'
/******************************************************************************************/
$params = array('start' => 0, 'order' => 'DESC', 'mode' => 'topic_time', 'delete_all_before_date' => 0,
'del_month' => 1, 'del_day' => 1, 'del_year' => 1970);

foreach($params as $var => $default)
{
	$$var = $default;
	if( isset($_POST[$var]) || isset($_GET[$var]) )
	{
		$$var = ( isset($_POST[$var]) ) ? $_POST[$var] : $_GET[$var];
	}
}

/*******************************************************************************************
/** Check for deletion items
/******************************************************************************************/
if ($delete_all_before_date)
{
	/* Error Checking */
	$error_message = '';
	if ($del_month < 1 || $del_month > 12)
	{
		$error_message .= $lang['Error_Month'];
	}
	if ($del_day < 1 || $del_day > 31)
	{
		$error_message .= $lang['Error_Day'];
	}
	if ($del_year < 1970 || $del_year > 2038)
	{
		$error_message .= $lang['Error_Year'];
	}
	if ($error_message != '')
	{
		message_die(GENERAL_ERROR, $error_message, '', __LINE__, __FILE__);
	}
	/* END Error Checking */
	
	$set_time = mktime(0, 0, 0, $del_month, $del_day, $del_year);
	$sql = 'DELETE FROM ' . TOPICS_TABLE . '
	   WHERE topic_status = ' . TOPIC_MOVED . "
	   AND topic_time < $set_time";
	
	if(!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, $lang['Error_Topics_Table'], '', __LINE__, __FILE__, $sql);
	}
	else
	{
		$status_message .= sprintf($lang['Del_Before_Date'], date("M-d-Y", $set_time));
		$status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysql4') ? sprintf($lang['Affected_Rows'], $db->sql_affectedrows()) : '';
	}
}

foreach($_POST as $key => $val)
{
	if (substr_count($key, 'delete_id_'))
	{
		$topic_id = substr($key, 10);
		$sql = 'DELETE FROM ' . TOPICS_TABLE . '
		   WHERE topic_status = ' . TOPIC_MOVED . "
		   AND topic_id = $topic_id";
		if(!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $lang['Error_Topics_Table'], '', __LINE__, __FILE__, $sql);
		}
		else
		{
			$status_message .= sprintf($lang['Deleted_Topic'], $topic_id);
		}
	}
}

/*******************************************************************************************
/** Main Page
/******************************************************************************************/

$template->set_filenames(array(
'body' => 'admin/admin_topic_shadow.tpl')
);

if ($status_message != '')
{
	$template->assign_block_vars('statusrow', array());
}

$template->assign_vars(array(
'L_DELETE_FROM_EXPLAN' => $lang['Delete_From_Date'],
'L_DELETE_BEFORE' => $lang['Delete_Before_Date_Button'],
'L_MONTH' => $lang['Month'],
'L_DAY' => $lang['Day'],
'L_YEAR' => $lang['Year'],
'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
'L_TITLE' => $lang['Title'],
'L_TIME' => $lang['Time'],
'L_POSTER' => $lang['Poster'],
'L_MOVED_TO' => $lang['Moved_To'],
'L_PAGE_NAME' => $page_title,
'L_ORDER' => $lang['Order'],
'L_SORT' => $lang['Sort'],
'L_DELETE' => $lang['Delete'],
'L_NO_TOPICS_FOUND' => $lang['No_Shadow_Topics'],
'L_STATUS' => $lang['Status'],
'L_PAGE_DESC' => $lang['TS_Desc'],
'L_CLEAR' => $lang['Clear'],
'L_MOVED_FROM' => $lang['Moved_From'],

'I_STATUS_MESSAGE' => $status_message,

'S_MONTH' => date("m"),
'S_DAY' => date("d"),
'S_YEAR' => date("Y"),
'S_MODE' => $mode,
'S_ORDER' => $order,
'S_MODE_SELECT' => ts_make_mode_drop_box(),
'S_ORDER_SELECT' => ts_make_order_drop_box(),
'S_MODE_ACTION' => append_sid($_SERVER['PHP_SELF']))
);

/* See if we actually have any shadow topics */
$sql = 'SELECT COUNT(topic_status) as count FROM ' . TOPICS_TABLE . '
   WHERE topic_status = ' . TOPIC_MOVED;

if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, $lang['Error_Topics_Table'], '', __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
if ($row['count'] <= 0)
{
	$template->assign_block_vars('emptyrow', array());
}
else
{
	
	$sql = 'SELECT * FROM ' . TOPICS_TABLE . '
   WHERE topic_status = ' . TOPIC_MOVED . "
   ORDER BY $mode $order";
	
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, $lang['Error_Topics_Table'], '', __LINE__, __FILE__, $sql);
	}
	
	$i = 0;
	while ($messages = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('topicrow', array(
		'ROW_CLASS' => (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'],
		'TITLE' => $messages['topic_title'],
		'MOVED_TO' => ts_id_2_name($messages['topic_moved_id'], 'forum'),
		'MOVED_FROM' => ts_id_2_name($messages['topic_id'], 'forum'),
		'POSTER' => ts_id_2_name($messages['topic_poster']),
		'TIME' => create_date($lang['DATE_FORMAT'], $messages['topic_time'], $board_config['board_timezone']),
		'TOPIC_ID' => $messages['topic_id'])
		);
		$i++;
	}
}
$template->pparse('body');
include_once('page_footer_admin.'.$phpEx);

?>