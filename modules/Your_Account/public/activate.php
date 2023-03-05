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
if ($ya_config['expiring'] != 0) {
	$past = time() - $ya_config['expiring'];
	$res = $db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users_temp WHERE time < \'' . $past . '\'');
	while (list($uid) = $db->sql_fetchrow($res)) {
		$uid = intval($uid);
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id = \'' . $uid . '\'');
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $uid . '\'');
	}
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp_field_values');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp');
}
$username = addslashes(trim(check_html($username, 'nohtml')));
$check_num = addslashes(trim(check_html($check_num, 'nohtml')));
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp WHERE username=\'' . $username . '\' AND check_num=\'' . $check_num . '\'');
if ($db->sql_numrows($result) == 1) {
	$row = $db->sql_fetchrow($result);
	$ya_username = $row['username'];
	$ya_realname = $row['name'];
	$ya_useremail = $row['user_email'];
	$ya_time = $row['time'];
	$lv = time();
	include_once 'header.php';
	title(_PERSONALINFO);
	OpenTable();
	echo '<form name="Register" action="modules.php?name=' . $module_name . '" method="post">';
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td align="center" colspan="2"><strong>' . _FORACTIVATION . '</strong>:</td></tr>';
	echo '<tr><td>' . _USRNICKNAME . ':</td><td>' . $ya_username . '</td></tr>';
	if ($ya_config['userealname']>1) {
	echo '<tr><td>' . _UREALNAME . ':';
	if ($ya_config['userealname']==3) echo '<br />' . _REQUIRED;
		echo '</td><td>';
		echo '<input type="text" name="realname" value="' . $ya_realname . '" size="50" maxlength="60" /></td></tr>';
	}
	echo '<tr><td>' . _UREALEMAIL . ':</td>';
	echo '<td>' . $ya_useremail . '</td></tr>';
	echo '<tr><td>' . _UFAKEMAIL . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="femail" value="" size="50" maxlength="255" /><br />' . _EMAILPUBLIC . '</td></tr>';
	echo '<tr><td>' . _YOURHOMEPAGE . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_website" value="" size="50" maxlength="255" /></td></tr>';
	echo '<tr><td>' . _YICQ . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_icq" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YAIM . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_aim" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YYIM . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_yim" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YMSNM . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_msnm" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YLOCATION . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_from" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YOCCUPATION . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_occ" value="" size="30" maxlength="100" /></td></tr>';
	echo '<tr><td>' . _YINTERESTS . ':<br />' . _OPTIONAL . '</td>';
	echo '<td><input type="text" name="user_interests" value="" size="30" maxlength="100" /></td></tr>';
// set user email hidden by default - sgtmudd
	echo '<input type="hidden" name="user_viewemail" value="0" />';
//	echo '<tr><td>' . _ALWAYSSHOWEMAIL . ':</td><td><select name="user_viewemail">';
//	echo '<option value="1">' . _YES . '</option><option value="0" selected="selected">' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _RECEIVENEWSLETTER . ':</td><td><select name="newsletter">';
	echo '<option value="1">' . _YES . '</option><option value="0" selected="selected">' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _HIDEONLINE . ':</td><td><select name="user_allow_viewonline">';
	echo '<option value="0">' . _YES . '</option><option value="1" selected="selected">' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _FORUMSTIME . '</td><td><select name="user_timezone">';
	$utz = date('Z');
	$utz = round($utz/3600);
	for ($i = -12;$i < 13;$i++) {
		if ($i == 0) {
			$dummy = 'GMT';
		} else {
			if (!preg_match('/-/', $i)) {
				$i = '+' . $i;
			}
			$dummy = 'GMT ' . $i . ' ' . _HOURS;
		}
		if ($utz == $i) {
			echo '<option value="' . $i . '" selected="selected">' . $dummy . '</option>';
		} else {
			echo '<option value="' . $i . '">' . $dummy . '</option>';
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td>' . _FORUMSDATE . ':<br />' . _FORUMSDATEMSG . '</td><td>';
	echo '<input type="text" name="user_dateformat" value="l d F Y H:i" size="15" maxlength="14" /></td></tr>';
	echo '<tr><td>' . _SIGNATURE . ':<br />' . _OPTIONAL . '<br />' . _NOHTML . '</td>';
	// montego - $userinfo array cannot possibly be valued at this point, so removed references to these below
	echo '<td><textarea cols="50" rows="5" name="user_sig"></textarea><br />' . _255CHARMAX . '</td></tr>';
	echo '<tr><td>' . _EXTRAINFO . ':<br />' . _OPTIONAL . '<br />' . _NOHTML . '</td>';
	echo '<td><textarea cols="50" rows="5" name="bio"></textarea><br />' . _CANKNOWABOUT . '</td></tr>';
	echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _SAVECHANGES . '" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" />';
	echo '<input type="hidden" name="check_num" value="' . $check_num . '" />';
	echo '<input type="hidden" name="ya_time" value="' . $ya_time . '" />';
	echo '<input type="hidden" name="op" value="saveactivate" />';
	echo '</form>';
	CloseTable();
	include_once 'footer.php';
	die();
} else {
	include_once 'header.php';
	title(_ACTIVATIONERROR);
	OpenTable();
	echo '<center>' . _ACTERROR . '</center>';
	CloseTable();
	include_once 'footer.php';
	die();
}
?>