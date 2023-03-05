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
    require_once("modules/Forums/nukebb.php");
} else {
    $phpbb_root_path = 'modules/Forums/';
    $nuke_file_path = 'modules.php?name=Forums&file=';
}
define('IN_PHPBB', true);
define('PAGE_BUDDIES', '-135');
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);


//
// Parameters
//
$who = (isset ($_GET['who'])) ? TRUE : 0;
$cancel = (isset ($_POST['cancel'])) ? TRUE : 0;
$confirm = (isset ($_POST['confirm'])) ? TRUE : 0;
$add = (isset ($_POST['add'])) ? TRUE : 0;
$remove = (isset ($_POST['remove'])) ? TRUE : 0;
$remove_all = (isset ($_POST['removeall'])) ? TRUE : 0;
$username = (isset ($_POST['username'])) ? $_POST['username'] : '';

$mark_list = (!empty ($_POST['mark'])) ? $_POST['mark'] : 0;


//
// Session ID check
//
if (isset ($_POST['sid']) || isset ($_GET['sid'])) {
        $sid = (isset ($_POST['sid'])) ? $_POST['sid'] : ((isset ($_GET['sid'])) ? $_GET['sid'] : '');
        }
else {
        $sid = '';
        }


//
// Start session management
//
$userdata = session_pagestart ($user_ip, PAGE_BUDDIES, $nukeuser);
init_userprefs ($userdata);
//
// End session management
//


if (!$userdata['session_logged_in']) {
        $header_location = (@preg_match ('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
        header ($header_location . append_sid ("login.$phpEx?redirect=buddylist.$phpEx", true));
        exit;
        }


//
// Cancel
//
if ($cancel) {
        $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
        header ($header_location . append_sid ("buddylist.$phpEx", true));
        exit;
        }


//
// Remove buddies
//
if (($remove && $mark_list) || $remove_all) {
        if (isset ($mark_list) && !is_array ($mark_list)) {
                $mark_list = array ();
                }

        if (!$confirm) {
                $s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
                $s_hidden_fields .= (isset($_POST['remove'])) ? '<input type="hidden" name="remove" value="true" />' : '<input type="hidden" name="removeall" value="true" />';

                for($i = 0; $i < count($mark_list); $i++) {
                        $s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . $mark_list[$i] . '" />';
                        }

                //
                // Output confirmation page
                //
                include_once("includes/page_header.php");

                $template->set_filenames (
                        array (
                                'confirm_body' => 'confirm_body.tpl'
                                )
                        );
                $template->assign_vars (
                        array (
                                'MESSAGE_TITLE' => $lang['Information'],
                                'MESSAGE_TEXT' => (count($mark_list) == 1) ? $lang['Confirm_remove_buddy'] : $lang['Confirm_remove_buddies'],

                                'L_YES' => $lang['Yes'],
                                'L_NO' => $lang['No'],

                                'S_CONFIRM_ACTION' => append_sid ("buddylist.$phpEx"),
                                'S_HIDDEN_FIELDS' => $s_hidden_fields
                                )
                        );

                $template->pparse ('confirm_body');
                include_once("includes/page_tail.php");
                exit;
                }

        else if ($confirm) {
                //
                // Only enable in 2.0.4!
                //
                if ($sid != $userdata['session_id']) {
                        message_die(GENERAL_MESSAGE, 'Invalid session');
                        }

                if ($remove_all) {
                        $sql = "DELETE FROM " . BUDDIES_TABLE . " WHERE user_id = " . $userdata['user_id'];
                        }

                if (count($mark_list)) {
                        $delete_sql_id = implode (', ', $mark_list);
                        $sql = "DELETE FROM " . BUDDIES_TABLE . " WHERE buddy_id IN ($delete_sql_id) AND user_id = " . $userdata['user_id'];
                        }

                if (!$db->sql_query ($sql)) {
                        message_die (GENERAL_ERROR, 'Could not remove the buddies from the list', '', __LINE__, __FILE__, $sql);
                        }

                $template->assign_vars (
                        array (
                                'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid ("buddylist.$phpEx") . '">'
                                )
                        );

                $message = (count($mark_list) == 1) ? $lang['Buddy_removed'] : $lang['Buddies_removed'];
                $message .= '<br /><br />' . sprintf ($lang['Click_return_buddy_list'], '<a href="' . append_sid ("buddylist.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf ($lang['Click_return_index'], '<a href="' . append_sid ("index.$phpEx") . '">', '</a>');
                message_die (GENERAL_MESSAGE, $message);
                }
        }


//
// Add buddies
//
if ($add) {
        $sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE username = '$username'";
        if (!$result = $db->sql_query($sql)) {
                message_die (GENERAL_ERROR, 'Could not query user information', '', __LINE__, __FILE__, $sql);
                }
        if (!$row = $db->sql_fetchrow($result)) {
                message_die (GENERAL_MESSAGE, 'User does not exist');
                }

        $buddy_id = $row['user_id'];

        if ($buddy_id == $userdata['user_id']) {
                message_die (GENERAL_MESSAGE, 'You cannot add yourself to the buddylist');
                }


        $sql = "SELECT * FROM " . BUDDIES_TABLE . " WHERE user_id = " . $userdata['user_id'] . " AND buddy_id = $buddy_id";
        if (!$result = $db->sql_query($sql)) {
                message_die (GENERAL_ERROR, 'Could not query buddylist information', '', __LINE__, __FILE__, $sql);
                }
        if ($row = $db->sql_fetchrow($result)) {
                message_die (GENERAL_MESSAGE, 'User is already in your buddylist');
                }


        $sql = "INSERT INTO " . BUDDIES_TABLE . " (user_id, buddy_id) VALUES (" . $userdata['user_id'] . ", $buddy_id)";
        if (!($result = $db->sql_query($sql))) {
                message_die (GENERAL_ERROR, 'Could not add the user to your buddylist', '', __LINE__, __FILE__, $sql);
                }

        $template->assign_vars (
                array (
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid ("buddylist.$phpEx") . '">'
                        )
                );

        $message = $lang['Buddy_added'] . '<br /><br />' . sprintf ($lang['Click_return_buddy_list'], '<a href="' . append_sid ("buddylist.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf ($lang['Click_return_index'], '<a href="' . append_sid ("index.$phpEx") . '">', '</a>');
        message_die (GENERAL_MESSAGE, $message);
        }

///////////////////////////////////////////
// Who Am I A Buddy Of?  --  *INSERT START*
///////////////////////////////////////////
if ($who) {

$page_title = $lang['Buddy_who_me'];

include_once ('includes/page_header.'.$phpEx);
$template->set_filenames (
        array (
                'body' => 'buddylist_who-me_body.tpl'
                )
        );
make_jumpbox ('viewforum.'.$phpEx);

//
// General SQL to obtain buddies
//
$sql_buds = "SELECT b.user_id, u.username AS buddy_name, u.user_email AS buddy_email, u.user_viewemail
                                FROM " . BUDDIES_TABLE . " b, " . USERS_TABLE . " u
                                WHERE b.buddy_id = " . $userdata['user_id'] . "
                                AND u.user_id = b.user_id
                                ORDER BY u.username";

if (!($result = $db->sql_query ($sql_buds))) {
        message_die (GENERAL_ERROR, 'Could not query online buddies', '', __LINE__, __FILE__, $sql);
        }
$mybuddies = array ();
while ($row = $db->sql_fetchrow ($result)) {
        $mybuddies[] = $row;
        }
$db->sql_freeresult ($result);

//
// Dump vars to template
//
$template->assign_vars (
        array (
                'L_USERNAME' => $lang['Username'],
                'L_BUDDY_LISTED_YOU' => $lang['Buddy_listed_you'],
                'L_PM' => $lang['Private_Messaging'],
                'L_EMAIL' => $lang['Email'],
           'L_BUDDY_LIST' =>  $lang['Buddy_list'],
                'U_BUDDY_LIST' => append_sid('buddylist.'.$phpEx)
                )
        );

//
// Okay, let's build the buddies list
//
if (count($mybuddies) == 0) {
        $template->assign_block_vars ("switch_no_buddies", array ());
        }
else {
        for ($i = 0; $i < count($mybuddies); $i++) {
                $buddy_id = $mybuddies[$i]['user_id'];
                $buddy_name = $mybuddies[$i]['buddy_name'];
                $buddy_email = $mybuddies[$i]['buddy_email'];
                $buddy_profile = append_sid ("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $buddy_id);
                $buddy_url = '<a href="' . $buddy_profile . '">' . $buddy_name . '</a>';

                $buddy_temp_url = append_sid ("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $buddy_id);
                $buddy_pm_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
                $buddy_pm = '<a href="' . $buddy_temp_url . '">' . $lang['Send_private_message'] . '</a>';

                if (!empty ($row['user_viewemail']) || ($userdata['user_level'] == ADMIN)) {
                        $buddy_email_uri = ($board_config['board_email_form']) ? append_sid ("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $buddy_id) : 'mailto:' . $buddy_email;
                        $buddy_email_img = '<a href="' . $buddy_email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
                        $buddy_email = '<a href="' . $buddy_email_uri . '">' . $lang['Send_email'] . '</a>';
                        }
                else {
                        $buddy_email_img = '&nbsp;';
                        $buddy_email = '&nbsp;';
                        }

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars ('listrow_buddies',
                        array (
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'BUDDY_URL' => $buddy_url,
                                'PM_IMG' => $buddy_pm_img,
                                'PM' => $buddy_pm,
                                'EMAIL_IMG' => $buddy_email_img,
                                'EMAIL' => $buddy_email
                          )
                        );

                }
        }

$template->pparse ('body');
include_once ('includes/page_tail.'.$phpEx);
exit;
}
///////////////////////////////////////////
// Who Am I A Buddy Of?  -- *END OF INSERT*
///////////////////////////////////////////
//
// Default page
//
$page_title = $lang['Buddy_list'];
include_once("includes/page_header.php");

$template->set_filenames (
        array (
                'body' => 'buddylist_body.tpl'
                )
        );
make_jumpbox ('viewforum.'.$phpEx);


//
// General SQL to obtain buddies
//
$current_time = time ();
$session_time = 300;
$end_session = $current_time - $session_time;

$sql = "SELECT b.buddy_id, u.username AS buddy_name, u.user_email AS buddy_email, u.user_viewemail, u.user_allow_viewonline, u.user_session_time
                FROM " . BUDDIES_TABLE . " b, " . USERS_TABLE . " u
                WHERE b.user_id = " . $userdata['user_id'] . "
                        AND u.user_id = b.buddy_id
                ORDER BY u.username ASC";
if (!$result = $db->sql_query ($sql)) {
        message_die (GENERAL_ERROR, 'Could not query buddies', '', __LINE__, __FILE__, $sql);
        }

$buddies_online = array ();
$buddies_offline = array ();
while ($row = $db->sql_fetchrow ($result)) {
        if (($row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN) && ($row['user_session_time'] >= $end_session)) {
                $buddies_online[] = $row;
                }
        else {
                $buddies_offline[] = $row;
                }
        }


//
// Dump vars to template
//
$template->assign_vars (
        array (
                'L_NO_BUDDIES_ONLINE' => $lang['No_buddies_online'],
                'L_NO_BUDDIES_OFFLINE' => $lang['No_buddies_offline'],
                'L_ONLINE' => $lang['Online'],
                'L_OFFLINE' => $lang['Offline'],
                'L_BUDDY_WHO_ME' => $lang['Buddy_who_me'],
                'L_BUDDY' => $lang['Username'],
                'L_PM' => $lang['Private_Messaging'],
                'L_EMAIL' => $lang['Email'],

                'L_MARK' => $lang['Mark'],
                'L_MARK_ALL' => $lang['Mark_all'],
                'L_UNMARK_ALL' => $lang['Unmark_all'],
                'L_REMOVE_MARKED' => $lang['Remove_marked'],
                'L_REMOVE_ALL' => $lang['Remove_all'],

                'L_ADD_MEMBER' => $lang['Add_member'],
                'L_FIND_USERNAME' => $lang['Find_username'],
                'U_BUDDY_WHO_ME' => append_sid("buddylist.$phpEx?who="),
                'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&popup=1"),
                'S_BUDDYLIST_ACTION' => append_sid ("buddylist.$phpEx"),
                'S_HIDDEN_FIELDS' => ''
                )
        );


//
// Okay, let's build the online buddies list
//
if (count($buddies_online) == 0) {
        $template->assign_block_vars ("switch_no_buddies_online", array ());
        }
else {
        for ($i = 0; $i < count($buddies_online); $i++) {
                $buddy_id = $buddies_online[$i]['buddy_id'];
                $buddy_name = $buddies_online[$i]['buddy_name'];
                $buddy_email = $buddies_online[$i]['buddy_email'];
                $buddy_profile = append_sid ("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_url = '<a href="' . $buddy_profile . '">' . $buddy_name . '</a>';

                $buddy_temp_url = append_sid ("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_pm_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
                $buddy_pm = '<a href="' . $buddy_temp_url . '">' . $lang['Send_private_message'] . '</a>';

                if ($row['user_viewemail'] || ($userdata['user_level'] == ADMIN)) {
                        $buddy_email_uri = ($board_config['board_email_form']) ? append_sid ("profile.$phpEx?mode=email&amp;" . POST_USERS_URL . "=$buddy_id") : 'mailto:' . $buddy_email;
                        $buddy_email_img = '<a href="' . $buddy_email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
                        $buddy_email = '<a href="' . $buddy_email_uri . '">' . $lang['Send_email'] . '</a>';
                        }
                else {
                        $buddy_email_img = '&nbsp;';
                        $buddy_email = '&nbsp;';
                        }

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars ('listrow_online',
                        array (
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'BUDDY_URL' => $buddy_url,
                                'PM_IMG' => $buddy_pm_img,
                                'PM' => $buddy_pm,
                                'EMAIL_IMG' => $buddy_email_img,
                                'EMAIL' => $buddy_email,

                                'S_MARK_ID' => $buddy_id
                                )
                        );
                }
        }


//
// Okay, let's build the offline buddies list
//
if (count($buddies_offline) == 0) {
        $template->assign_block_vars ("switch_no_buddies_offline", array ());
        }
else {
        for ($i = 0; $i < count($buddies_offline); $i++) {
                $buddy_id = $buddies_offline[$i]['buddy_id'];
                $buddy_name = $buddies_offline[$i]['buddy_name'];
                $buddy_email = $buddies_offline[$i]['buddy_email'];
                $buddy_profile = append_sid ("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_url = '<a href="' . $buddy_profile . '">' . $buddy_name . '</a>';

                $buddy_temp_url = append_sid ("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_pm_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
                $buddy_pm = '<a href="' . $buddy_temp_url . '">' . $lang['Send_private_message'] . '</a>';

                if ($row['user_viewemail'] || ($userdata['user_level'] == ADMIN)) {
                        $buddy_email_uri = ($board_config['board_email_form']) ? append_sid ("profile.$phpEx?mode=email&amp;" . POST_USERS_URL . "=$buddy_id") : 'mailto:' . $buddy_email;
                        $buddy_email_img = '<a href="' . $buddy_email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
                        $buddy_email = '<a href="' . $buddy_email_uri . '">' . $lang['Send_email'] . '</a>';
                        }
                else {
                        $buddy_email_img = '&nbsp;';
                        $buddy_email = '&nbsp;';
                        }

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars ('listrow_offline',
                        array (
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'BUDDY_URL' => $buddy_url,
                                'PM_IMG' => $buddy_pm_img,
                                'PM' => $buddy_pm,
                                'EMAIL_IMG' => $buddy_email_img,
                                'EMAIL' => $buddy_email,

                                'S_MARK_ID' => $buddy_id
                                )
                        );
                }
        }

$template->pparse('body');

include_once("includes/page_tail.php");

?>
