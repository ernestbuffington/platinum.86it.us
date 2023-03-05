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

if (!defined ('IN_PHPBB')) {
        die ('Hacking attempt');
        }


//
// Default page
//
$template->set_filenames (
        array (
                'buddy_list_output' => 'buddylist_mini.tpl'
                )
        );

$template->assign_block_vars ('buddy_list', array ());


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
                'L_BUDDY_WHO_MINI' => $lang['Buddy_who_mini'],
          'U_BUDDY_WHO_ME' => append_sid("buddylist.$phpEx?who="),
                'L_ONLINE' => $lang['Online'],
                'L_OFFLINE' => $lang['Offline']
                )
        );


//
// Okay, let's build the online buddies list
//
if (count($buddies_online) == 0) {
        $template->assign_block_vars ('buddy_list.switch_no_buddies_online', array());
        }
else {
        for ($i = 0; $i < count($buddies_online); $i++) {
                $buddy_id = $buddies_online[$i]['buddy_id'];
                $buddy_name = $buddies_online[$i]['buddy_name'];
                $buddy_profile = append_sid ("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_url = '<a href="' . $buddy_profile . '">' . $buddy_name . '</a>';

                $buddy_temp_url = append_sid ("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$buddy_id");
                $buddy_pm_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
                $buddy_pm = '<a href="' . $buddy_temp_url . '">' . $lang['Send_private_message'] . '</a>';

                
                $buddy_temp_url = append_sid ("privmsg.$phpEx?buddy_action=remove&amp;b=$buddy_id");
                $buddy_remove_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete'] . '" title="' . $lang['Delete'] . '" border="0" /></a>';
                $buddy_remove = '<a href="' . $buddy_temp_url . '">' . $lang['Delete'] . '</a>';

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars ('buddy_list.listrow_online',
                        array (
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'BUDDY_URL' => $buddy_url,
                                'PM_IMG' => $buddy_pm_img,
                                'PM' => $buddy_pm,
                                'REMOVE_IMG' => $buddy_remove_img,
                                'REMOVE' => $buddy_remove
                                )
                        );
                }
        }


//
// Okay, let's build the offline buddies list
//
if (count($buddies_offline) == 0) {
        $template->assign_block_vars ('buddy_list.switch_no_buddies_offline', array());
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

                $buddy_temp_url = append_sid ("privmsg.$phpEx?buddy_action=remove&amp;b=$buddy_id");
                $buddy_remove_img = '<a href="' . $buddy_temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete'] . '" title="' . $lang['Delete'] . '" border="0" /></a>';
                $buddy_remove = '<a href="' . $buddy_temp_url . '">' . $lang['Delete'] . '</a>';

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars ('buddy_list.listrow_offline',
                        array (
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'BUDDY_URL' => $buddy_url,
                                'PM_IMG' => $buddy_pm_img,
                                'PM' => $buddy_pm,
                                'REMOVE_IMG' => $buddy_remove_img,
                                'REMOVE' => $buddy_remove
                                )
                        );
                }
        }

$template->assign_var_from_handle ('BUDDY_LIST', 'buddy_list_output');
?>
