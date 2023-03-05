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
if (!defined('YA_ADMIN')) {
	header('Location: ../../../index.php');
	die ();
}
if (($radminsuper==1) OR ($radminuser==1)) {
	list($uname, $realname, $email, $upass, $ureg) = $db->sql_fetchrow($db->sql_query('SELECT username, name, user_email, user_password, user_regdate FROM ' . $user_prefix . '_users_temp WHERE user_id=\'' . $act_uid . '\''));
	if ($ya_config['servermail'] == 1) {
		$message = _SORRYTO .' ' . $sitename . ' ' . _HASAPPROVE;
		$subject = _SORRYTO .' ' . $sitename . ' ' . _HASAPPROVE;
		ya_mail($email, $subject, $message, '');
	}
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id=\'' . $act_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp');
	list($newest_uid) = $db->sql_fetchrow($db->sql_query('SELECT max(user_id) AS newest_uid FROM ' . $user_prefix . '_users'));
	if ($newest_uid == '-1') $new_uid = 1; 
	else $new_uid = $newest_uid+1;
	$db->sql_query('INSERT INTO ' . $user_prefix . '_users (user_id, name, username, user_email, user_regdate, user_password, user_level, user_active, user_avatar, user_avatar_type, user_from, agreedtos) VALUES (\'' . $new_uid . '\', \'' . $realname . '\', \'' . $uname . '\', \'' . $email . '\', \'' . $ureg . '\', \'' . $upass . '\', 1, 1, \'gallery/blank.gif\', 3, \'\', \'1\')');
	$res = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $act_uid . '\'');
	while ($sqlvalue = $db->sql_fetchrow($res)) {
		$db->sql_query('INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $new_uid . '\', \'' . $sqlvalue[fid] . '\',\'' . $sqlvalue[value] . '\')');
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
	$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid=\'' . $act_uid . '\'');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp_field_values');
	$pagetitle = ': ' . _USERADMIN . ' - ' . _YA_ACTIVATED;
	include_once 'header.php';
	amain();
	echo '<br />';
	OpenTable();
	echo '<form action="' . $admin_file . '.php?op=yaUsers" method="post">';
	if (isset($query)) { echo '<input type="hidden" name="query" value="' . $query . '" />'; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="' . $min . '" />'; }
//    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
	echo '<center><table align="center" border="0" cellpadding="2" cellspacing="2">';
	echo '<tr><td align="center"><strong>'._YA_ACTIVATED.'</strong></td></tr>';
	echo '<tr><td align="center"><input type="submit" value="'._RETURN2.'" /></td></tr>';
	echo '</table></center>';
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
}
?>