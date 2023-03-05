<?php
/***************************************************************************
 *                            admin_disallow.php
 *                            -------------------
 *   begin                : Tuesday, Oct 05, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_disallow.php,v 1.9.2.2 2002/11/26 11:42:11 psotfx Exp $
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Users']['Disallow'] = $filename;

        return;
}

//
// Include require_onced files, get $phpEx and check permissions
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

if( isset($_POST['add_name']) )
{
        include_once("../../../includes/functions_validate.php");

        $disallowed_user = ( isset($_POST['disallowed_user']) ) ? trim($_POST['disallowed_user']) : trim($_GET['disallowed_user']);

        if ($disallowed_user == '')
        {
                message_die(GENERAL_MESSAGE, $lang['Fields_empty']);
        }
        if( !validate_username($disallowed_user) )
        {
                $message = $lang['Disallowed_already'];
        }
        else
        {
                $sql = "INSERT INTO " . DISALLOW_TABLE . " (disallow_username)
                        VALUES('" . str_replace("\'", "''", $disallowed_user) . "')";
                $result = $db->sql_query( $sql );
                if ( !$result )
                {
                        message_die(GENERAL_ERROR, "Could not add disallowed user.", "",__LINE__, __FILE__, $sql);
                }
                $message = $lang['Disallow_successful'];
        }

        $message .= "<br /><br />" . sprintf($lang['Click_return_disallowadmin'], "<a href=\"" . append_sid("admin_disallow.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);
}
else if( isset($_POST['delete_name']) )
{
        $disallowed_id = ( isset($_POST['disallowed_id']) ) ? intval( $_POST['disallowed_id'] ) : intval( $_GET['disallowed_id'] );

        $sql = "DELETE FROM " . DISALLOW_TABLE . "
                WHERE disallow_id = $disallowed_id";
        $result = $db->sql_query($sql);
        if( !$result )
        {
                message_die(GENERAL_ERROR, "Couldn't removed disallowed user.", "",__LINE__, __FILE__, $sql);
        }

        $message .= $lang['Disallowed_deleted'] . "<br /><br />" . sprintf($lang['Click_return_disallowadmin'], "<a href=\"" . append_sid("admin_disallow.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);

}

//
// Grab the current list of disallowed usernames...
//
$sql = "SELECT *
        FROM " . DISALLOW_TABLE;
$result = $db->sql_query($sql);
if( !$result )
{
        message_die(GENERAL_ERROR, "Couldn't get disallowed users.", "", __LINE__, __FILE__, $sql );
}

$disallowed = $db->sql_fetchrowset($result);

//
// Ok now generate the info for the template, which will be put out no matter
// what mode we are in.
//
$disallow_select = '<select name="disallowed_id">';

if( trim($disallowed) == '' )
{
        $disallow_select .= '<option value="">' . $lang['no_disallowed'] . '</option>';
}
else
{
        $user = array();
        for( $i = 0; $i < count($disallowed); $i++ )
        {
                $disallow_select .= '<option value="' . $disallowed[$i]['disallow_id'] . '">' . $disallowed[$i]['disallow_username'] . '</option>';
        }
}

$disallow_select .= '</select>';

$template->set_filenames(array(
        "body" => "admin/disallow_body.tpl")
);

$template->assign_vars(array(
        "S_DISALLOW_SELECT" => $disallow_select,
        "S_FORM_ACTION" => append_sid("admin_disallow.$phpEx"),

        "L_INFO" => $output_info,
        "L_DISALLOW_TITLE" => $lang['Disallow_control'],
        "L_DISALLOW_EXPLAIN" => $lang['Disallow_explain'],
        "L_DELETE" => $lang['Delete_disallow'],
        "L_DELETE_DISALLOW" => $lang['Delete_disallow_title'],
        "L_DELETE_EXPLAIN" => $lang['Delete_disallow_explain'],
        "L_ADD" => $lang['Add_disallow'],
        "L_ADD_DISALLOW" => $lang['Add_disallow_title'],
        "L_ADD_EXPLAIN" => $lang['Add_disallow_explain'],
        "L_USERNAME" => $lang['Username'])
);

$template->pparse("body");

include_once('./page_footer_admin.'.$phpEx);

?>
