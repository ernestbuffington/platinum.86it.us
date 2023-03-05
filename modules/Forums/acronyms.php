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

/*
* Addon for the Acronym mod from CodeMonkeyX
* Originally made for PHP-Nuke 6.5 by Mighty_Y <http://www.portedmods.com>
* but then also made for phpBB standalone as an act of respect for CodeMonkeyX
*/

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require_once("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
}
define('IN_PHPBB', 1);

$phpbb_root_path = 'modules/Forums/';

include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
$page_title = $lang['Acronyms'];

include_once('includes/page_header.'.$phpEx);

$template->set_filenames(array(
	"body" => "acronym_body.tpl")
);
	
$sql = "SELECT * FROM " . ACRONYMS_TABLE . "
		ORDER BY acronym ASC";

if( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not obtain acronym data", "", __LINE__, __FILE__, $sql);
}

$i=0;

while( $acronym_row = $db->sql_fetchrow($result) )
{	
	$acronym = $acronym_row['acronym'];
	$description = $acronym_row['description'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	$template->assign_block_vars("acronym_row", array(
		"ROW_CLASS" => $row_class,
		"ACRONYM" => $acronym,
		"DESCRIPTION" => $description,
			)
	);	
	$i++;
}

$template->assign_vars(array(
    'L_ACRONYM' => $lang['Acronym'],
    'L_DESCRIPTION' => $lang['Description'],
)
);

$template->pparse("body");

include_once('includes/page_tail.'.$phpEx);

?>
