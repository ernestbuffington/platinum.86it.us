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
if (!defined('YA_ADMIN')){
	header('Location: ../../../index.php');
	die ();
}
if (($radminsuper==1) OR ($radminuser==1)) {
	if ($add_email != $add_email2) {
		include_once 'header.php';
		OpenTable();
		echo '<center><font class="title"><strong>'._ERRORREG.'</strong></font><br /><br />';
		echo '<font class="content">'._EMAILDIFFERENT.'<br /><br />'._GOBACK.'</font></center>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	if ($ya_config['userealname'] == '0') $add_name = '';
	if ($ya_config['usefakeemail'] == '0') $add_femail = '';
	if ($ya_config['usewebsite'] == '0') $add_url = '';
	if ($ya_config['useinstantmessaim'] == '0') $add_user_aim = '';
	if ($ya_config['useinstantmessicq'] == '0') $add_user_icq = '';
	if ($ya_config['useinstantmessmsn'] == '0') $add_user_msnm = '';
	if ($ya_config['useinstantmessyim'] == '0') $add_user_yim = '';
	if ($ya_config['uselocation'] == '0') $add_user_from = '';
	if ($ya_config['useoccupation'] == '0') $add_user_occ = '';
	if ($ya_config['useinterests'] == '0') $add_user_interest = '';
	if ($ya_config['usenewsletter'] == '0') $add_newsletter = '0';
	if ($ya_config['useviewemail'] == '0') $add_user_viewemail = '0';
	if ($ya_config['usesignature'] == '0') $add_user_sig = '';
	if ($ya_config['usepoints'] == '0' ) $add_points = '0';
	$add_email = strtolower($add_email);
	ya_userCheck($add_uname);
	ya_mailCheck($add_email);
	ya_passCheck($add_pass, $add_pass2);
	$add_name = ya_fixtext($add_name);
	if($add_name == '') { $add_name = $add_uname; }
	$add_femail = ya_fixtext($add_femail);
	$add_url = check_html($add_url);
	if (!preg_match('#http://#i', $add_url) AND $add_url != '') { $add_url = 'http://'.$add_url; }
	$add_user_sig = str_replace('<br>', "\r\n", $add_user_sig);
	$add_user_sig = str_replace('<br />', "\r\n", $add_user_sig);
	$add_user_sig = ya_fixtext($add_user_sig);
	$add_user_icq = ya_fixtext($add_user_icq);
	$add_user_aim = ya_fixtext($add_user_aim);
	$add_user_yim = ya_fixtext($add_user_yim);
	$add_user_msnm = ya_fixtext($add_user_msnm);
	$add_user_from = ya_fixtext($add_user_from);
	$add_user_occ = ya_fixtext($add_user_occ);
	$add_user_interest = ya_fixtext($add_user_interest);
	if (isset($add_user_viewemail)) $add_user_viewemail = 1;
	else $add_user_viewemail = 0;
	if (isset($add_newsletter)) $add_newsletter = 1;
	else $add_newsletter = 0;
	$user_points = intval($user_points);
	if ($stop == '') {
		$user_password = $add_pass;
		$add_pass = md5($add_pass);
		$user_regdate = date('M d, Y');
		list($newest_uid) = $db->sql_fetchrow($db->sql_query('SELECT max(user_id) AS newest_uid FROM '.$user_prefix.'_users'));
		if ($newest_uid == '-1') $new_uid = 1;
		else $new_uid = $newest_uid+1;
		$sql = 'INSERT INTO ' . $user_prefix . '_users ';
		$sql .= '(user_id, name, username, user_email, femail, user_website, user_regdate, user_icq, user_aim, user_yim, user_msnm, user_from, user_occ, user_interests, user_viewemail, user_avatar, user_avatar_type, user_sig, user_password, newsletter, broadcast, popmeson';
		$sql .= ', points';
		$sql .= ', agreedtos) ';
		$sql .= 'VALUES (\''.$new_uid.'\', \''.$add_name.'\', \''.$add_uname.'\', \''.$add_email.'\', \''.$add_femail.'\', \''.$add_url.'\', \''.$user_regdate.'\', \''.$add_user_icq.'\', \''.$add_user_aim.'\', \''.$add_user_yim.'\', \''.$add_user_msnm.'\', \''.$add_user_from.'\', \''.$add_user_occ.'\', \''.$add_user_intrest.'\', \''.$add_user_viewemail.'\', \'gallery/blank.gif\', \'3\', \''.$add_user_sig.'\', \''.$add_pass.'\', \''.$add_newsletter.'\', \'1\', \'0\'';
		$sql .= ', \''.$add_points.'\'';
		$sql .= ',\'1\')';
		$result = $db->sql_query($sql);
		if (isset($nfield) && count($nfield) > 0) {
			foreach ($nfield as $key => $var) {
				$nfield[$key] = ya_fixtext($nfield[$key]);
				if (($db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.'_users_field_values WHERE fid=\''.$key.'\' AND uid = \''.$new_uid.'\''))) == 0) {
					$sql = 'INSERT INTO '.$user_prefix.'_users_field_values (uid, fid, value) VALUES (\''.$new_uid.'\', \''.$key.'\',\''.$nfield[$key].'\')';
					$db->sql_query($sql);
				} else {
					$db->sql_query('UPDATE '.$user_prefix.'_users_field_values SET value=\''.$nfield[$key].'\' WHERE fid=\''.$key.'\' AND uid = \''.$new_uid.'\'');
				}
			}
		}
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
		if (!$result) {
			$pagetitle = ': '._USERADMIN;
			include_once 'header.php';
			title(_USERADMIN);
			OpenTable();
			echo '<center><strong>'._ERRORSQL.'</strong></center>';
			CloseTable();
			include_once 'footer.php';
			return;
		} else {
			if ($ya_config['servermail'] == 1) {
				$message = _WELCOMETO." $sitename!\r\n\r\n";
				$message .= _YOUUSEDEMAIL." ($add_email) "._TOREGISTER." $sitename.\r\n\r\n";
				$message .= _FOLLOWINGMEM."\r\n"._UNICKNAME." $add_uname\r\n"._UPASSWORD." $user_password";
				$subject = _ACCOUNTCREATED;
				// We need to send this mail
#				ya_mail($user_email, $subject, $message, '');
			}
			if (isset($min)) $xmin = '&min='.$min;
			if (isset($xop)) $xxop = '&op='.$xop;
			Header('Location: '.$admin_file.'.php?op=yaUsers'.$xxop.$xmin);
		}
	} else {
		$pagetitle = ': '._USERADMIN;
		include_once 'header.php';
		title(_USERADMIN);
		amain();
		echo '<br />';
		OpenTable();
		echo '<strong>'.$stop.'</strong>';
		CloseTable();
		include_once 'footer.php';
		return;
	}
}
?>