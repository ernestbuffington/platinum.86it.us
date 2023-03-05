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

$module_name = basename(dirname(__FILE__));

require_once("modules/".$module_name."/nukebb.php");



//

// Allow people to reach login page if

// board is shut down

//

define("IN_LOGIN", true);



define('IN_PHPBB', true);

include_once($phpbb_root_path . 'extension.inc');

include_once($phpbb_root_path . 'common.'.$phpEx);



//

// Set page ID for session management

//

$userdata = session_pagestart($user_ip, PAGE_LOGIN, $nukeuser);

init_userprefs($userdata);

//

// End session management

//



// session id check

if (!empty($_POST['sid']) || !empty($_GET['sid']))

{

	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];

}

else

{

	$sid = '';

}



if( isset($_POST['login']) || isset($_GET['login']) || isset($_POST['logout']) || isset($_GET['logout']) )

{

	if( ( isset($_POST['login']) || isset($_GET['login']) ) && (!$userdata['session_logged_in'] || isset($_POST['admin'])) )

	{

		$username = isset($_POST['username']) ? phpbb_clean_username($_POST['username']) : '';

		$password = isset($_POST['password']) ? $_POST['password'] : '';



		$sql = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try

			FROM " . USERS_TABLE . "

			WHERE username = '" . str_replace("\\'", "''", $username) . "'";

		if ( !($result = $db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);

		}



		if( $row = $db->sql_fetchrow($result) )

		{

			if( $row['user_level'] != ADMIN && $board_config['board_disable'] )

			{

				redirect(append_sid("index.$phpEx", true));

			}

			else

			{

				// If the last login is more than x minutes ago, then reset the login tries/time

				if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))

				{

					$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);

					$row['user_last_login_try'] = $row['user_login_tries'] = 0;

				}

				

				// Check to see if user is allowed to login again... if his tries are exceeded

				if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && 

					$row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)

				{

					message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));

				}



				if( md5($password) == $row['user_password'] && $row['user_active'] )

				{

					$autologin = ( isset($_POST['autologin']) ) ? TRUE : 0;



					$admin = (isset($_POST['admin'])) ? 1 : 0;

					$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);



					// Reset login tries

					$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);



					if( $session_id )

					{

						$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "index.$phpEx";

						redirect(append_sid($url, true));

					}

					else

					{

						message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);

					}

				}

				// Only store a failed login attempt for an active user - inactive users can't login even with a correct password

				elseif( $row['user_active'] )

				{

					// Save login tries and last login

					if ($row['user_id'] != ANONYMOUS)

					{

						$sql = 'UPDATE ' . USERS_TABLE . '

							SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '

							WHERE user_id = ' . $row['user_id'];

						$db->sql_query($sql);

					}



					$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : '';

					$redirect = str_replace('?', '&', $redirect);



					if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))

					{

						message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');

					}



					$template->assign_vars(array(

						'META' => '<meta http-equiv=\"refresh\" content=\"3;url=' . append_sid("login.$phpEx?redirect=$redirect") . '\">')

					);



					$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href=\"' . append_sid("login.$phpEx?redirect=$redirect") . '\">', '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');



					message_die(GENERAL_MESSAGE, $message);

				}

			}

		}

		else

		{

			$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "";

			$redirect = str_replace("?", "&", $redirect);



			if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))

			{

				message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');

			}



			$template->assign_vars(array(

				'META' => '<meta http-equiv=\"refresh\" content=\"3;url=' . append_sid("login.$phpEx?redirect=$redirect") . '\">')

			);



                        $message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href=\"' . append_sid("login.$phpEx?redirect=$redirect") . '\">', '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');



			message_die(GENERAL_MESSAGE, $message);

		}

	}

	else if( ( isset($_GET['logout']) || isset($_POST['logout']) ) && $userdata['session_logged_in'] )

	{

		// session id check

		if ($sid == '' || $sid != $userdata['session_id'])

		{

			message_die(GENERAL_ERROR, 'Invalid_session');

		}



		if( $userdata['session_logged_in'] )

		{

			session_end($userdata['session_id'], $userdata['user_id']);

		}



		if (!empty($_POST['redirect']) || !empty($_GET['redirect']))

		{

			$url = (!empty($_POST['redirect'])) ? htmlspecialchars($_POST['redirect']) : htmlspecialchars($_GET['redirect']);

			$url = str_replace('&amp;', '&', $url);

			redirect(append_sid($url, true));

		}

		else

		{

			redirect(append_sid("index.$phpEx", true));

		}

	}

	else

	{

		$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "index.$phpEx";

		redirect(append_sid($url, true));

	}

}

else

{

	//

	// Do a full login page dohickey if

	// user not already logged in

	//

	if( !$userdata['session_logged_in'] || (isset($_GET['admin']) && $userdata['session_logged_in'] && $userdata['user_level'] == ADMIN))

	{

		$page_title = $lang['Login'];

                include_once("includes/page_header.php");



		$template->set_filenames(array(

			'body' => 'login_body.tpl')

		);



		$forward_page = '';



		if( isset($_POST['redirect']) || isset($_GET['redirect']) )

		{

			$forward_to = $_SERVER['QUERY_STRING'];



			if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )

			{

				$forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];

				$forward_match = explode('&', $forward_to);



				if(count($forward_match) > 1)

				{

					for($i = 1; $i < count($forward_match); $i++)

					{

						if( !preg_match("/sid=/", $forward_match[$i]) )

						{

							if( $forward_page != '' )

							{

								$forward_page .= '&';

							}

							$forward_page .= $forward_match[$i];

						}

					}

					$forward_page = $forward_match[0] . '?' . $forward_page;

				}

				else

				{

					$forward_page = $forward_match[0];

				}

			}

		}



                Header("Location: modules.php?name=Your_Account&redirect=$forward_page");

		$username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';



		$s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';

		$s_hidden_fields .= (isset($_GET['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';



		make_jumpbox('viewforum.'.$phpEx);

		$template->assign_vars(array(

			'USERNAME' => $username,



			'L_ENTER_PASSWORD' => (isset($_GET['admin'])) ? $lang['Admin_reauthenticate'] : $lang['Enter_password'],

			'L_SEND_PASSWORD' => $lang['Forgotten_password'],



			'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),



			'S_HIDDEN_FIELDS' => $s_hidden_fields)

		);



		$template->pparse('body');



                include_once("includes/page_tail.php");

	}

	else

	{

		redirect(append_sid("index.$phpEx", true));

	}



}



?>

