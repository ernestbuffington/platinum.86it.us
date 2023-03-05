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

if ($popup != "1") {
	$module_name = basename(dirname(__FILE__));
	require_once("modules/".$module_name."/nukebb.php");
} else {
	$phpbb_root_path = 'modules/Forums/';
}

$phpbbarcade = 1;

define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
//include_once($phpbb_root_path .'includes/functions_arcade.' . $phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_GAME, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

//
// Start auth check
//
if (!$userdata['session_logged_in']) {
		$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";
		header($header_location . append_sid("login.$phpEx?redirect=arcade_rate.$phpEx", true));
		exit;
}
//
// End of auth check
//
include_once("includes/page_header.php");
if (!empty($_POST['gid']) || !empty($_GET['gid'])) {
		$gid = (!empty($_POST['gid'])) ? intval($_POST['gid']) : intval($_GET['gid']);
} else {
		message_die(GENERAL_ERROR, "Such game doesnt exist");
}
if (!empty($_POST['ratevalue']) || !empty($_GET['ratevalue'])) {
		$ratevalue = intval((!empty($_POST['ratevalue'])) ? intval($_POST['ratevalue']) : intval($_GET['ratevalue']));
		if ($ratevalue<0 or $ratevalue>10) {
		    $ratevalue=5;
		}
} else {
		message_die(GENERAL_ERROR, "No rating value");
}

$sql="REPLACE INTO ".$prefix."_bbgames_rate (game_id,user_id,rate) VALUES($gid,".$userdata['user_id'].",$ratevalue) ";
$db->sql_query($sql) or message_die(GENERAL_ERROR, "Cannot insert new rating");
//echo $header_location . append_sid("games.$phpEx?gid=$gid", false);
$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";
header($header_location . append_sid("modules.php?name=Forums&file=games&gid=$gid", true));
?>
