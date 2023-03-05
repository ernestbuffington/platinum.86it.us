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

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

if ($popup != "1")
    {
	$module_name = basename(dirname(__FILE__));
	require_once("modules/".$module_name."/nukebb.php");
    }
    else
    {
	$phpbb_root_path = 'modules/Forums/';
    }
	
define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX - 2262002, $board_config['session_length'], $nukeuser);
init_userprefs($userdata);
//
// End session management
//

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);

$template->assign_vars(array(
"L_IMAGE" => $lang['smiley_url'],
"L_CODE" => $lang['smiley_code'],
"CLASS_1" => $theme['td_class1'],
"CLASS_2" => $theme['td_class2'],
"PAGE_NAME" => $page_title)
);

$template->set_filenames(array(
"body" => "smilies_list.tpl")
);

//
// Obtain Smilies
//
$sql = "SELECT code, smile_url, emoticon
FROM " . SMILIES_TABLE;

if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Couldn't retrieve Smilie data", "", __LINE__, __FILE__, $sql);
}

//
// Sort into 2-D array indexed by image
//
while( $smilie_data = $db->sql_fetchrow($result) )
{
	$smilie_url_array[$smilie_data['smile_url']]['emoticon'] = $smilie_data['emoticon'];
	$smilie_url_array[$smilie_data['smile_url']]['code'] = ( !isset($smilie_url_array[$smilie_data['smile_url']]['code']) ) ? $smilie_data['code'] : $smilie_url_array[$smilie_data['smile_url']]['code'] . " or " . $smilie_data['code'];
}

$db->sql_freeresult($result);

//
// Assign template block vars and live happily ever after
//

$count = 0;
while ( list($key) = each($smilie_url_array) )
{
	$count++;

	$template->assign_block_vars("smilies", array(
	"URL" => '<img src="'. $board_config['smilies_path'] . '/' . $key . '" alt="' . $smilie_url_array[$key]['emoticon'] . '" border="0">',
	"EMOTICON" => $smilie_url_array[$key]['emoticon'],
	"START" => ( ($count % 2) ) ? "<tr>" : "",
	"END" => ( !($count % 2) ) ? "</tr>" : "",
	"CODE" => $smilie_url_array[$key]['code'])
	);
}

$page_title = $lang['Smilies'];
include_once('includes/page_header.'.$phpEx);

$template->pparse("body");

include_once('includes/page_tail.'.$phpEx);

?>
