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
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
include_once 'header.php';
$ya_username = check_html($ya_username, 'nohtml');
ya_userCheck($ya_username);
$ya_user_email = check_html($ya_user_email, 'nohtml');
$ya_user_email = strtolower($ya_user_email);
ya_mailCheck($ya_user_email);
$user_regdate = date('M d, Y');
if ($forceLowerCaseUserName) $ya_username = strtolower($ya_username); //Added by Raven 7/3/2005  Modified for RN v2.10.00
$gfx_check = (isset($gfx_check)) ? check_html(trim($gfx_check) , 'nohtml') : '';
if (!isset($stop)) {
	/*
	 * montego - usegfxcheck is not configurable for RN and only the RN captcha security
	 * code should be used.  Therefore, to avoid conflicts, following code is being commented out.
	 */
	//if (isset($gfx_chk)) {
		// START:f2g: gfx captcha check from rn index.php function finishNewUser
		if (!security_code_check($gfx_check, array(3,4,6,7))) {
			title(_NEWUSERERROR);
			OpenTable();
			echo '<center><strong>' . _SECCODEINCOR . '</strong><br /><br />';
			echo '[ <a href="javascript:history.go(-1)">' . _GOBACK2 . '</a> ]</center>';
			CloseTable();
			include_once 'footer.php';
			die();
		}
		// END:f2g:
		//$datekey = date('F j');
		//$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
		//$code = substr($rcode, 2, $ya_config['codesize']);
		//if (extension_loaded('gd') AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 1 OR $ya_config['usegfxcheck'] == 3)) {
		//	Header('Location: modules.php?name=' . $module_name);
		//	die();
		//}
	//}
	mt_srand((double)microtime() * 1000000);
	$maxran = 1000000;
	$check_num = mt_rand(0, $maxran);
	$check_num = md5($check_num);
	$time = time();
	$user_password = htmlspecialchars(stripslashes($user_password)); // from RN
	if ($ya_config['userealname'] > 1) $ya_realname = check_html($ya_realname, 'nohtml');
	else $ya_realname = '';
	if (defined('NUKESENTINEL_IS_LOADED')) {
		$ip = (isset($nsnst_const['remote_ip'])) ? $nsnst_const['remote_ip'] : 'none';
	} else {
		if (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
		elseif (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_X_FORWARDED')) $ip = getenv('HTTP_X_FORWARDED');
		elseif (getenv('HTTP_FORWARDED_FOR')) $ip = getenv('HTTP_FORWARDED_FOR');
		elseif (getenv('HTTP_FORWARDED')) $ip = getenv('HTTP_FORWARDED');
		else $ip = getenv('REMOTE_ADDR');
	}
	if (!preg_match('/^([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})\\.([0-9]{1,3})$/', $ip)) $ip = ''; // RN0001003
	$mx = '';
	//if (!isset($domain)) $domain='';
	//if (function_exists('checkdnsrr')) {
	//	if (checkdnsrr($domain, "MX")) {
	//		if (getmxrr($domain, $mxhosts)) $mx = 'Yes';
	//	}
	//}
	$server_port = (!preg_match('/^([0-9]{1,6})/', $_SERVER['REMOTE_PORT'])) ? '' : $_SERVER['REMOTE_PORT']; //RN0001003
	$requestor = $ip . ':' . $server_port . ' ' . $mx; //RN0001003
	if ($ya_config['requireadmin'] == 0 and $ya_config['useactivate'] == 0) {
		$femail = (isset($femail)) ? check_html($femail, 'nohtml') : '';
		$user_website = (isset($user_website)) ? check_html($user_website) : '';
		if (!preg_match('#^http[s]?:\/\/#i', $user_website)) { // From RN
			$user_website = 'http://' . $user_website;
		}
		if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $user_website)) {
			$user_website = '';
		}
		$bio = (isset($bio)) ? str_replace('<br />', "\r\n", $bio) : '';
		$bio = check_html($bio, 'nohtml');
		$user_sig = (isset($user_sig)) ? str_replace('<br />', "\r\n", $user_sig) : '';
		$user_sig = check_html($user_sig, '');
		if (isset($user_icq)) {
			if (function_exists('ctype_digit')) $user_icq = ctype_digit($user_icq) ? $user_icq : '';
			else {
				if (preg_match('/^[0-9]+$/', $user_icq)) $user_icq = intval($user_icq);
				else { $user_icq = ''; }
			} // fix by Raven to stop  '0' being stored in DB if field is empty
		} else {
			$user_icq = '';
		}
		$user_aim = (isset($user_aim)) ? check_html($user_aim, 'nohtml') : '';
		$user_yim = (isset($user_yim)) ? check_html($user_yim, 'nohtml') : '';
		$user_msnm = (isset($user_msnm)) ? check_html($user_msnm, 'nohtml') : '';
		$user_occ = (isset($user_occ)) ? check_html($user_occ, 'nohtml') : '';
		$user_from = (isset($user_from)) ? check_html($user_from, 'nohtml') : '';
		$user_interests = (isset($user_interests)) ? check_html($user_interests, 'nohtml') : '';
		$user_dateformat = (isset($user_dateformat)) ? check_html($user_dateformat, 'nohtml') : '';
		$newsletter = (isset($newsletter)) ? intval($newsletter) : 0;
		$user_viewemail = (isset($user_viewemail)) ? intval($user_viewemail) : 0;
		$user_allow_viewonline = (isset($user_allow_viewonline)) ? intval($user_allow_viewonline) : 1;
		$user_timezone = (isset($user_timezone)) ? intval($user_timezone) : 10;
		$lv = time();
		// montego - following code unnecessary for RN as it will always be "seeded" with an initial user.
		// Also re-organized the code similar to saveactivate.php for better performance and better readability.
		//list($newest_uid) = $db->sql_fetchrow($db->sql_query('SELECT max(user_id) AS newest_uid FROM ' . $user_prefix . '_users'));
		//if ($newest_uid == '-1') {
		//	$new_uid = 1;
		//} else {
		//	$new_uid = $newest_uid+1;
		//}
		$sql = 'INSERT INTO ' . $user_prefix . '_users '
			. '(user_id, user_avatar, user_avatar_type, user_lang, user_lastvisit, lastsitevisit, umode, '
			. 'username, name, user_email, femail, user_website, user_icq, user_aim, user_yim, '
			. 'user_msnm, user_from, user_occ, user_interests, newsletter, user_viewemail, '
			. 'user_allow_viewonline, user_timezone, user_dateformat, user_sig, bio, user_password, '
			. 'user_regdate, agreedtos) VALUES (NULL, \'gallery/blank.gif\', \'3\', \'' . addslashes($language) . '\', \'' . $lv . '\', \'' . $lv . '\', \'nested\', '
			. '\'' . addslashes($ya_username) . '\', \'' . addslashes($ya_realname) . '\', \'' . addslashes($ya_user_email) . '\', \'' . addslashes($femail) . '\', \''
			. addslashes($user_website) . '\', \'' . $user_icq . '\',\'' . $user_aim . '\', \'' . $user_yim . '\', \'' . $user_msnm . '\', \''
			. addslashes($user_from) . '\', \'' . addslashes($user_occ) . '\', \'' . addslashes($user_interests) . '\', \'' . $newsletter . '\', \''
			. $user_viewemail . '\', \'' . $user_allow_viewonline . '\', \'' . $user_timezone . '\', \'' . addslashes($user_dateformat) . '\', \''
			. addslashes($user_sig) . '\', \'' . addslashes($bio) . '\', \'' . addslashes($user_password) . '\', \'' . $user_regdate . '\', \'1\')';
		$result = $db->sql_query($sql);
		$new_uid = $db->sql_nextid();
		if (isset($nfield)) {
			if ((count($nfield) > 0) AND ($result)) {
				foreach($nfield as $key => $var) {
					$db->sql_query('INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $new_uid . '\', \'' . addslashes($key) . '\',\'' . addslashes($nfield[$key]) . '\')');
				}
			}
		}
// montego - end of code re-organization.
/*****[BEGIN]************** Initial Usergroup - sgtmudd ********************************/
				// get initial user group id
	            $result = $db->sql_query("SELECT config_value FROM ".$user_prefix."_bbconfig WHERE config_name='initial_group_id'");
                $row = $db->sql_fetchrow($result);
                $initialusergroup = $row[0];
				if ($initialusergroup == NULL)
         	   (
     	       		die("GENERAL_ERROR, 'Error getting initial group information. Are you SURE you have an initial user group defined?', '', __LINE__, __FILE__, $sql")
//     	       message_die(GENERAL_ERROR, 'Error getting initial group information. Are you SURE you have an initial user group defined?', '', __LINE__, __FILE__, $sql)
     	       );
                if ($initialusergroup != 0)
				// insert user into bbuser_group table
                $db->sql_query("INSERT INTO ".$user_prefix."_bbuser_group (group_id, user_id, user_pending) VALUES ('$initialusergroup', $new_uid, '0')");
/*****[END]**************** Initial Usergroup - sgtmudd ********************************/
/*****[BEGIN]*********** Personal User Usergroup - sgtmudd *****************************/
          { 
         $sql2 = "SELECT MAX(group_id) AS total 
            FROM ".$user_prefix."_bbgroups"; 
         if ( !($result2 = $db->sql_query($sql2)) ) 
         { 
            die('Could not obtain next group_id information'); 
         } 

         if ( !($row2 = $db->sql_fetchrow($result2)) ) 
         { 
            die('Could not obtain next group_id information'); 
         } 
         $group_id = $row2['total'] + 1; 

         $sql3 = "INSERT INTO ".$prefix."_bbgroups (group_id, group_name, group_description, group_single_user, group_moderator, user_id) 
            VALUES ($group_id, '', 'Personal User', 1, 2, $new_uid)"; 
         if ( !($result3 = $db->sql_query($sql3, BEGIN_TRANSACTION)) ) 
         { 
            die('Could not insert data into groups table'); 
         }

        $sql4 = "INSERT INTO ".$user_prefix."_bbuser_group (group_id, user_id, user_pending) 
            VALUES ($group_id, $new_uid, 0)"; 
         if( !($result4 = $db->sql_query($sql4, END_TRANSACTION)) ) 
         { 
            die('Could not insert data into user_group table'); 
         }
		 }
/*****[END]************* Personal User Usergroup - sgtmudd *****************************/
	} else {
		// montego - following code unnecessary for RN as it will always be "seeded" with an initial user.
		//list($newest_uid) = $db->sql_fetchrow($db->sql_query('SELECT max(user_id) AS newest_uid FROM ' . $user_prefix . '_users_temp'));
		//if ($newest_uid == '-1') {
		//	$new_uid = 1;
		//} else {
		//	$new_uid = $newest_uid+1;
		//}
		$sql = 'INSERT INTO ' . $user_prefix . '_users_temp (user_id, username, name, user_email, user_password, user_regdate, check_num, time, requestor) VALUES (NULL, \'' . addslashes($ya_username) . '\', \'' . addslashes($ya_realname) . '\', \'' . addslashes($ya_user_email) . '\', \'' . addslashes($user_password) . '\', \'' . $user_regdate . '\', \'' . $check_num . '\', \'' . $time . '\', \'' . $requestor . '\')';
		$result = $db->sql_query($sql);
		$new_uid = $db->sql_nextid();
		if (isset($nfield)) {
			if ((count($nfield) > 0) AND ($result)) {
				foreach($nfield as $key => $var) {
					$db->sql_query('INSERT INTO ' . $user_prefix . '_users_temp_field_values (uid, fid, value) VALUES (\'' . $new_uid . '\', \'' . $key . '\',\'' . addslashes($var) . '\')');
				}
			}
		}
	}
	if (!$result) {
		OpenTable();
		echo _ADDERROR . '<br />CODE: 00';
		if (!$result) {
    die(mysql_error());
}
		CloseTable();
	} else {
		if ($ya_config['servermail'] == 1) {
			$message = _WELCOMETO . ' ' . $sitename . ' (' . $nukeurl . ')!' . "\r\n\r\n";
			if ($ya_config['requireadmin'] == 1) {
				$subject = _APPLICATIONSUB;
				$message .= _YOUUSEDEMAIL . ' ' . $ya_user_email . ' ' . _TOAPPLY . ' ' . $sitename . ' (' . $nukeurl . ').' . "\r\n\r\n";
				$message .= _WAITAPPROVAL . "\r\n\r\n";
			} elseif ($ya_config['useactivate'] == 1) {
				$subject = _ACTIVATIONSUB;
				$message .= _YOUUSEDEMAIL . ' ' . $ya_user_email . ' ' . _TOREGISTER . ' ' . $sitename . "\r\n\r\n";
				$message .= _TOFINISHUSER . "\r\n\r\n" . $nukeurl . '/modules.php?name=' . $module_name . '&op=activate&username=' . $ya_username . '&check_num=' . $check_num . "\r\n\r\n";
			} elseif ($ya_config['useactivate'] == 0) {
				$subject = _REGISTRATIONSUB;
				$message .= _YOUUSEDEMAIL . ' ' . $ya_user_email . ' ' . _TOREGISTER . ' ' . $sitename . "\r\n\r\n";
			}
			$message .= _FOLLOWINGMEM . "\r\n" . _UNICKNAME . ' ' . $ya_username . "\r\n" . _UREALNAME . ' ' . $ya_realname . "\r\n" . _UPASSWORD . ' ' . $user_password;
			ya_mail($ya_user_email, $subject, $message, '');
		}
		$displayText = '<center>';
		if ($ya_config['requireadmin'] == 1) {
			$displayTitle = _USERAPPLOGIN;
			$displayText .= '<strong>' . _ACCOUNTRESERVED . '</strong><br /><br />';
			$displayText .= _YOUAREPENDING . '<br /><br />';
			$displayText .= _THANKSAPPL . ' ' . $sitename;
		} elseif ($ya_config['useactivate'] == 1) {
			$displayTitle = _USERREGLOGIN;
			$displayText .= '<strong>' . _ACCOUNTCREATED . '</strong><br /><br />';
			$displayText .= _YOUAREREGISTERED . '<br /><br />';
			$displayText .= _FINISHUSERCONF . '<br /><br />';
			$displayText .= _THANKSUSER . ' ' . $sitename;
		} elseif ($ya_config['useactivate'] == 0) {
			$displayTitle = _USERREGLOGIN;
			$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . $ya_username . '\' AND user_password=\'' . $user_password . '\'');
			if ($db->sql_numrows($result) == 1) {
				$userinfo = $db->sql_fetchrow($result);
				yacookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $userinfo['umode'], $userinfo['uorder'], $userinfo['thold'], $userinfo['noscore'], $userinfo['ublockon'], $userinfo['theme'], $userinfo['commentmax']);
				$displayText .= '' . _ACTMSG2;
			} else {
				$displayText .= _SOMETHINGWRONG;
			}
			$displayText .= '</center>';
		}
		title($displayTitle);
		OpenTable();
		echo $displayText;
		CloseTable();
		if ($ya_config['sendaddmail'] == 1 AND $ya_config['servermail'] == 0) {
			if ($ya_config['requireadmin'] == 1) {
				$subject = $sitename . ' - ' . _MEMAPL;
				$message = $ya_username . ' ' . _YA_APLTO . ' ' . $sitename . ' ' . _YA_FROM . ' ' . $ip . "\r\n";
			} elseif ($ya_config['useactivate'] == 1) {
				$subject = $sitename . ' - ' . _MEMACT;
				$message = $ya_username . ' ' . _YA_APLTO . ' ' . $sitename . ' ' . _YA_FROM . ' ' . $ip . "\r\n";
			} elseif ($ya_config['useactivate'] == 0) {
				$subject = $sitename . ' - ' . _MEMADD;
				$message = $ya_username . ' ' . _YA_ADDTO . ' ' . $sitename . ' ' . _YA_FROM . ' ' . $ip . "\r\n";
			}
			$message .= '-----------------------------------------------------------' . "\r\n";
			$message .= _YA_NOREPLY;
			ya_mail($adminmail, $subject, $message, $ya_user_email);
		}
	}
} else {
	echo $stop;
}
include_once 'footer.php';
?>