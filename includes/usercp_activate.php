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



if ( !defined('IN_PHPBB') )

{

        die('Hacking attempt');

        exit;

}



$sql = "SELECT user_active, user_id, username, user_email, user_newpasswd, user_lang, user_actkey

        FROM " . USERS_TABLE . "

        WHERE user_id = " . intval($_GET[POST_USERS_URL]);

if ( !($result = $db->sql_query($sql)) )

{

        message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);

}



if ( $row = $db->sql_fetchrow($result) )

{

        if ( $row['user_active'] && trim($row['user_actkey']) == '' )

        {

                $template->assign_vars(array(

                        'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')

                );



                message_die(GENERAL_MESSAGE, $lang['Already_activated']);

        }

	else if ((trim($row['user_actkey']) == trim($_GET['act_key'])) && (trim($row['user_actkey']) != ''))

	{

		if (intval($board_config['require_once_activation']) == USER_ACTIVATION_ADMIN && $row['user_newpasswd'] == '')

		{

			if (!$userdata['session_logged_in'])

			{

				redirect(append_sid('login.' . $phpEx . '?redirect=profile.' . $phpEx . '&mode=activate&' . POST_USERS_URL . '=' . $row['user_id'] . '&act_key=' . trim($_GET['act_key'])));

			}

			else if ($userdata['user_level'] != ADMIN)

      { 

         message_die(GENERAL_MESSAGE, $lang['Not_Authorised']); 

      }

      }

                $sql_update_pass = ( $row['user_newpasswd'] != '' ) ? ", user_password = '" . str_replace("\'", "''", $row['user_newpasswd']) . "', user_newpasswd = ''" : '';



                $sql = "UPDATE " . USERS_TABLE . "

                        SET user_active = 1, user_actkey = ''" . $sql_update_pass . "

                        WHERE user_id = " . $row['user_id'];

                if ( !($result = $db->sql_query($sql)) )

                {

                        message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql_update);

                } 



                if ( intval($board_config['require_once_activation']) == USER_ACTIVATION_ADMIN && $sql_update_pass == '' )

                {

                        include_once("includes/emailer.php");

                        $emailer = new emailer($board_config['smtp_delivery']);



                        $emailer->from($board_config['board_email']);

                        $emailer->replyto($board_config['board_email']);



                        $emailer->use_template('admin_welcome_activated', $row['user_lang']);

                        $emailer->email_address($row['user_email']);

                        $emailer->set_subject($lang['Account_activated_subject']);



                        $emailer->assign_vars(array(

                                'SITENAME' => $board_config['sitename'],

                                'USERNAME' => $row['username'],

                                'PASSWORD' => $password_confirm,

                                'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '')

                        );

                        $emailer->send();

                        $emailer->reset();



                        $template->assign_vars(array(

                                

                                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')

                        );



                        message_die(GENERAL_MESSAGE, $lang['Account_active_admin']);

                }

                else

                {

                        $template->assign_vars(array(

                                'META' => '<meta http-equiv="refresh" content="10;url=' . append_sid("index.$phpEx") . '">')

                        );



                        $message = ( $sql_update_pass == '' ) ? $lang['Account_active'] : $lang['Password_activated'];

                        message_die(GENERAL_MESSAGE, $message);

                }

        }

        else

        {

                message_die(GENERAL_MESSAGE, $lang['Wrong_activation']);

        }

}

else

{

        message_die(GENERAL_MESSAGE, $lang['No_such_user']);

}



?>