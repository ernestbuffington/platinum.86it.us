<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
$module_name = 'Your_Account';
if (!defined('MODULE_FILE')) {
	header('Location: ../../index.php');
	die();
}
require_once 'mainfile.php';
require_once 'modules/' . $module_name . '/includes/constants.php';
include_once 'modules/' . $module_name . '/includes/functions.php';
if (!isset($ya_config)) $ya_config = ya_get_configs();
get_lang($module_name);
$userpage = 1;
include_once 'modules/' . $module_name . '/navbar.php';
include_once 'modules/' . $module_name . '/includes/cookiecheck.php';
// set some vars to prevent notice errors
if (!isset($random_num)) $random_num = '';
if (!isset($redirect)) $redirect = '';
if (!isset($op)) $op = '';
cookiedecode($user);
switch ($op) {
	default:
		mmain($user);
		break;
	case 'activate':
	case 'changemail':
	case 'editcomm':
	case 'edithome':
	case 'edituser':
	case 'mailpasswd':
	case 'pass_lost':
	case 'saveactivate':
	case 'userinfo':
		include_once 'modules/' . $module_name . '/public/' . $op . '.php';
		break;
	case 'avatarlist':
	case 'avatarsave':
	case 'avatarlinksave':
	case 'savecomm':
	case 'savehome':
	case 'saveuser':
		if (is_user($user)) {
			include_once 'modules/' . $module_name . '/public/' . $op . '.php';
		} else {
			notuser();
		}
		break;
	case 'broadcast':
		if ($broadcast_msg == 1) {
			include_once 'modules/' . $module_name . '/public/' . $op . '.php';
		} else {
			disabled();
		}
		break;
	case 'delete':
	case 'deleteconfirm':
		if (is_user($user)) {
			if ($ya_config['allowuserdelete'] == 1) {
				include_once 'modules/' . $module_name . '/public/' . $op . '.php';
			} else {
				disabled();
			}
		} else {
			notuser();
		}
		break;
	case 'chgtheme':
	case 'savetheme':
		if (is_user($user)) {
			if ($ya_config['allowusertheme'] == 1) {
				include_once 'modules/' . $module_name . '/public/' . $op . '.php';
			} else {
				disabled();
			}
		} else {
			notuser();
		}
		break;
	case 'gfxadminimage':
		// menelaos: dynamically insert the version number in the admin config panel image Copyright (c) 2004 :-)
		$icon = 'images/admin/users.png';
		$image = @imagecreatefrompng($icon);
		$text_color = imagecolorallocate($image, 0, 0, 0);
		Header('Content-type: image/x-png');
		imagestring($image, 1, 7, 42, $yaversion, $text_color);
		imagepng($image);
		imagedestroy($image);
		break;
	case 'tos':
		// menelaos: check of the member agreed with the TOS and update the database field
		$setinfo = getusrinfo($user);
		if (!isset($setinfo) || empty($setinfo) || !is_array($setinfo)) Header('Location: ../../index.php');
		if (isset($_POST['tos_yes'])) {
			if (($ya_config['tos'] == 1) AND ($_POST['tos_yes'] == 1)) {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET agreedtos=\'1\' WHERE username=\'' . $setinfo['username'] . '\'');
				$forward = preg_replace('/redirect=/', '', $redirect);
				if ($redirect > '') Header('Location: ' . $redirect);
				else Header('Location: modules.php?name=Your_Account&op=userinfo&bypass=1&username=' . $setinfo['username']);
				die();
			}
		}
		if (($ya_config['tos'] == 1) AND ($ya_config['tosall'] == 1) AND ($setinfo['agreedtos'] != 1)) {
			if (!isset($_POST['tos_yes']) or $_POST['tos_yes'] != 1) {
				$nextop = 'tos';
				include_once 'modules/' . $module_name . '/public/ya_tos.php';
				exit;
			}
		} else Header('Location: ../../index.php');
		break;
	case 'login':
		global $nsnst_const;
		if (!isset($gfx_check)) $gfx_check = '';
		$username = check_html(trim($username) , 'nohtml'); // RN0001003
		$user_password = htmlspecialchars(stripslashes($user_password));
		$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . addslashes($username) . '\'');
		$ya_numUser = $db->sql_numrows($result);
		$setinfo = $db->sql_fetchrow($result);
		// menelaos: check of the member agreed with the TOS and update the database field
		if (isset($_POST['tos_yes'])) {
			if (($ya_config['tos'] == 1) AND ($_POST['tos_yes'] == 1)) {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET agreedtos=\'1\' WHERE username=\'' . addslashes($username) . '\'');
			}
		}
		$forward = preg_replace('/redirect=/', '', $redirect);
		if (preg_match('/privmsg/', $forward)) $pm_login = 'active';
		else $pm_login = '';
		if ($ya_numUser == 0) {
			include_once 'header.php';
			Show_YA_menu();
			OpenTable();
			echo '<center><span class="title">' . _SORRYNOUSERINFO . '</span></center>';
			CloseTable();
			include_once 'footer.php';
		} elseif ($ya_numUser == 1 AND $setinfo['user_id'] != 1 AND $setinfo['user_password'] != '' AND $setinfo['user_active'] > 0 AND $setinfo['user_level'] > 0) {
			/*
			* Check user against database - montego: I do not like the following code, why do we always
			* want to update the users password even if it hadn't changed?  I am leaving this here for now
			* as time for 2.3.0 is short. We should also consider changing the encryption algorithm with a
			* better salt too, but it would force a ton of problems with existing sites.
			*/
			$dbpass = $setinfo['user_password'];
			$non_crypt_pass = $user_password;
			$old_crypt_pass = crypt($user_password, substr($dbpass, 0, 2));
			$new_pass = md5($user_password);
			if (($dbpass == $non_crypt_pass) OR ($dbpass == $old_crypt_pass)) {
				$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_password=\'' . $new_pass . '\'	WHERE username=\'' . addslashes($username) . '\'');
				$result = $db->sql_query('SELECT user_password FROM ' . $user_prefix . '_users	WHERE username=\'' . addslashes($username) . '\'');
				list($dbpass) = $db->sql_fetchrow($result);
			}
			if ($dbpass != $new_pass) {
				Header('Location: modules.php?name=' . $module_name . '&stop=1');
				die();
			}
			// menelaos: show a member the current TOS if he has not agreed yet
			//if (($ya_config['tos'] == 1) AND ($ya_config['tosall'] == 1) AND ($setinfo['agreedtos'] != 1)) {
			//	if (!isset($_POST['tos_yes']) or $_POST['tos_yes'] != 1) {
			//		include_once 'modules/' . $module_name . '/public/ya_tos.php';
			//		exit;
			//	}
			//}
			$datekey = date('F j');
			$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
			$code = substr($rcode, 2, $ya_config['codesize']);
			if (!security_code_check($gfx_check, array(2, 4, 5, 7))) {
				include_once 'header.php';
				OpenTable();
				echo '<center><strong>' . _SECCODEINCOR . '</strong><br /><br />';
				echo '[ <a href="modules.php?name=' . $module_name . '">' . _GOBACK2 . '</a> ]</center>';
				CloseTable();
				include_once 'footer.php';
				die();
			}
			if (extension_loaded('gd') AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 2 OR $ya_config['usegfxcheck'] == 3)) {
				Header('Location: modules.php?name=' . $module_name . '&stop=1');
				die();
			} else {
				// menelaos: show a member the current TOS if he has not agreed yet
				yacookie($setinfo['user_id'], $setinfo['username'], $new_pass, $setinfo['storynum'], $setinfo['umode'], $setinfo['uorder'], $setinfo['thold'], $setinfo['noscore'], $setinfo['ublockon'], $setinfo['theme'], $setinfo['commentmax']);
				if (!defined('NUKESENTINEL_IS_LOADED')) {
					$uname = $_SERVER['REMOTE_ADDR'];
				} else {
					$uname = $nsnst_const['remote_ip'];
				}
				if (!preg_match('#^([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})$#', $uname)) $uname = '127.0.0.1'; // RN0001003
				$db->sql_query('DELETE FROM ' . $prefix . '_session WHERE uname=\'' . $uname . '\' AND guest=\'1\'');
				//		if ($Version_Num >= 7.4)
				$db->sql_query('UPDATE ' . $prefix . '_users SET last_ip=\'' . $uname . '\' WHERE username=\'' . addslashes($username) . '\'');
			}
			// menelaos: the cookiecheck is run here
			if ($ya_config['cookiecheck'] == 1) {
				$cookiecheck = yacookiecheckresults();
			}
			if (isset($pm_login) && $pm_login != '') {
				Header('Location: modules.php?name=Private_Messages&file=index&folder=inbox');
			} else if ($redirect == '') {
				Header('Location: modules.php?name=Your_Account&op=userinfo&bypass=1&username=' . $username);
			} else if ($mode == '') {
				Header('Location: modules.php?name=Forums&file=' . $forward);
			} else if ($t != '') {
				Header('Location: modules.php?name=Forums&file=' . $forward . '&mode=' . $mode . '&t=' . $t);
			} else {
				Header('Location: modules.php?name=Forums&file=' . $forward . '&mode=' . $mode . '&f=' . $f);
			}
		} elseif ($ya_numUser == 1 AND ($setinfo['user_level'] < 1 OR $setinfo['user_active'] < 1)) {
			include_once 'header.php';
			Show_YA_menu();
			OpenTable();
			if ($setinfo['user_level'] == 0) {
				echo '<br /><center><span class="title"><strong>' . _ACCSUSPENDED . '</strong></span></center><br />';
			} elseif ($setinfo['user_level'] == -1) {
				echo '<br /><center><span class="title"><strong>' . _ACCDELETED . '</strong></span></center><br />';
			} else {
				echo '<br /><center><span class="title"><strong>' . _SORRYNOUSERINFO . '</strong></span></center><br />';
			}
			CloseTable();
			include_once 'footer.php';
		} else {
			Header('Location: modules.php?name=' . $module_name . '&stop=1');
		}
		break;
	case 'logout':
		$r_uid = $cookie[0];
		$r_username = $cookie[1];
		setcookie('user');
		if (trim($ya_config['cookiepath']) != '') setcookie('user', 'expired', time() -604800, $ya_config['cookiepath']); //correct the problem of path change
		$db->sql_query('DELETE FROM ' . $prefix . '_session WHERE uname=\'' . $r_username . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_session');
		$db->sql_query('DELETE FROM ' . $prefix . '_bbsessions WHERE session_user_id=\'' . $r_uid . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbsessions');
		$user = '';
		include_once 'header.php';
		if ($redirect != '') {
			echo '<META HTTP-EQUIV="refresh" content="2;URL=modules.php?name=' . $redirect . '">';
		} else {
			echo '<META HTTP-EQUIV="refresh" content="2;URL=index.php">';
		}
		title(_YOUARELOGGEDOUT);
		include_once 'footer.php';
		break;
	case 'new_user':
		if (is_user($user)) {
			mmain($user);
		} else {
			if ($ya_config['allowuserreg'] == 1) {
				if ($ya_config['coppa'] == 1) {
					if (!isset($_POST['coppa_yes']) or $_POST['coppa_yes'] != 1) {
						include_once 'modules/' . $module_name . '/public/ya_coppa.php';
						exit;
					}
				}
				if ($ya_config['tos'] == 1) {
					if (!isset($_POST['tos_yes'])) $_POST['tos_yes'] = '';
					if ($_POST['tos_yes'] != 1) {
						$nextop = 'login';
						include_once 'modules/' . $module_name . '/public/ya_tos.php';
						exit;
					}
				}
				if ($ya_config['coppa'] != 1 OR $ya_config['coppa'] == 1 AND $_POST['coppa_yes'] == 1) {
					if ($ya_config['tos'] != 1 OR $ya_config['tos'] == 1 AND $_POST['tos_yes'] == 1) {
						if ($ya_config['requireadmin'] == 1) {
							include_once 'modules/' . $module_name . '/public/new_user.php';
						} elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) {
							include_once 'modules/' . $module_name . '/public/new_user.php';
						} elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
							include_once 'modules/' . $module_name . '/public/new_user.php';
						}
					}
				}
			} else {
				disabled();
			}
		}
		break;
	case 'new_confirm':
	case 'new_finish':
		if (is_user($user)) {
			mmain($user);
		} else {
			if ($ya_config['allowuserreg'] == 1) {
				include_once 'modules/' . $module_name . '/public/' . $op . '.php';
			} else {
				disabled();
			}
		}
		break;
	case 'ShowCookiesRedirect':
		ShowCookiesRedirect();
		break;
	case 'ShowCookies':
		ShowCookies();
		break;
	case 'DeleteCookies':
		DeleteCookies();
		break;
	}
?>