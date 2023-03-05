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
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);

//
// special ranks
$spe_ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_id";
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read special ranks', '', __LINE__, __FILE__, $sql);
while ($row = $db->sql_fetchrow($result) ) $spe_ranks[] = $row;
for ($i=0; $i < count($spe_ranks); $i++ )
{
	$rank = $spe_ranks[$i]['rank_id'];
	$spe_ranks[$i]['users_list'] = '';
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND user_rank = $rank ORDER BY username";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
		$spe_ranks[$i]['users_list'] .= '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id'] ) . '" class="gensmall">' . CheckUsernameColor($row['user_color_gc'], $row['username']) . '</a>';
	}
}

//
// standard ranks
$ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special <> 1 ORDER BY rank_id";
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read standard ranks', '', __LINE__, __FILE__, $sql);
while ($row = $db->sql_fetchrow($result) ) $ranks[] = $row;

$rank_max = 99999999;
for ($i=count($ranks)-1; $i >=0; $i--)
{
	$ranks[$i]['rank_max'] = $rank_max;
	$rank_min = $ranks[$i]['rank_min'];
	
	// count users
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND user_rank = 0 AND user_posts >= $rank_min" . (($rank_max < 99999999)  ? " AND user_posts < $rank_max" : "" );
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
	$ranks[$i]['user_number'] = $db->sql_numrows($result);

	// store the next limit
	$rank_max = $ranks[$i]['rank_min'];
}

//
// set the page title and include_once the page header
//
$page_title = $lang['Ranks'];
include_once ('includes/page_header.'.$phpEx);
//
// template setting
//
$template->set_filenames(array(
	'body' => 'ranks_body.tpl')
);

// constants
$template->assign_vars(array(
	'L_SPECIAL_RANKS' => $lang['Special_ranks'],
	'L_USERS_LIST' => $lang['Memberlist'],
	'L_RANKS' => $lang['Ranks'],
	'L_MINI' => $lang['Rank_minimum'],
	'L_TOTAL_USERS' => $lang['Total_users'],
	'S_HIDDEN_FIELDS' => '',
	)
);

// special ranks
for ($i=0; $i < count($spe_ranks); $i++)
{
	$template->assign_block_vars('spe_ranks', array(
		'RANK_TITLE' => $spe_ranks[$i]['rank_title'],
		'RANK_IMAGE' => ($spe_ranks[$i]['rank_image'] == '') ? '' : '<img src="modules/Forums/' . $spe_ranks[$i]['rank_image'] . '" border=0 align="center">',
		'USERS_LIST' => $spe_ranks[$i]['users_list'],
		)
	);
}

// standard ranks
for ($i=0; $i < count($ranks); $i++)
{
	$template->assign_block_vars('ranks', array(
		'RANK_TITLE' => $ranks[$i]['rank_title'],
		'RANK_IMAGE' => ($ranks[$i]['rank_image'] == '') ? '' : '<img src="modules/Forums/' . $ranks[$i]['rank_image'] . '" border=0 align="center">',
		'RANK_MINI'  => $ranks[$i]['rank_min'],
		'RANK_TOTAL' => $ranks[$i]['user_number'],
		)
	);
}

//
// page footer
//
$template->pparse('body');
include_once('includes/page_tail.'.$phpEx);

?>
