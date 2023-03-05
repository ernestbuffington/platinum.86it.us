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
	$pagetitle = ': '._USERADMIN.' - '._DETUSER;
	include_once 'header.php';
	title(_USERADMIN.' - '._DETUSER.': <i>'.$chng_uid.'</i>');
	amain();
	echo '<br />';
	$sql = 'SELECT * FROM '.$user_prefix.'_users WHERE user_id=\''.$chng_uid.'\'';
	if ($db->sql_numrows($db->sql_query($sql)) > 0) {
		$chnginfo = $db->sql_fetchrow($db->sql_query($sql));
		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			list($value) = $db->sql_fetchrow( $db->sql_query('SELECT value FROM '.$user_prefix.'_users_field_values WHERE fid =\''.$sqlvalue['fid'].'\' AND uid = \''.$chnginfo['user_id'].'\''));
			$chnginfo[$sqlvalue['name']] = $value;
		}
		OpenTable();
		echo '<center><table border="0">';
		echo '<tr><td>' . _USERID . ':</td><td><strong>'.$chnginfo['user_id'].'&nbsp;</strong></td></tr>';
		echo '<tr><td>' . _NICKNAME . ':</td><td><strong>'.$chnginfo['username'].'&nbsp;</strong></td></tr>';
		if ($ya_config['userealname'] >= '1') echo '<tr><td>'._UREALNAME.':</td><td><strong>'.$chnginfo['name'].'&nbsp;</strong></td></tr>';
		echo '<tr><td>' . _EMAIL . ':</td><td><strong><a href="mailto:'.$chnginfo['user_email'].'">'.$chnginfo['user_email'].'</a></strong></td></tr>';
		if ($ya_config['usefakeemail'] >= '1') echo '<tr><td>' . _FAKEEMAIL . ':</td><td><strong>'.$chnginfo['femail'].'&nbsp;</strong></td></tr>';
		$chnginfo['user_website'] = strtolower($chnginfo['user_website']);
		$chnginfo['user_website'] = str_replace('http://', '', $chnginfo['user_website']);
		if ($chnginfo['user_website'] == '') $userwebsite = _YA_NA;
		else $userwebsite = '<a href="http://'.$chnginfo['user_website'].'" target="_blank">'.$chnginfo['user_website'].'</a>';
		if ($ya_config['usewebsite'] >= '1') echo '<tr><td>'._WEBSITE.'</td><td><strong>'.$userwebsite.'&nbsp;</strong></td></tr>';
		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			if (substr($sqlvalue['name'],0,1)=='_') @eval('$name_exit = '.$sqlvalue['name'].';'); else $name_exit = $sqlvalue['name'];
			echo '<tr><td>'.$name_exit.'</td><td><strong>'.$chnginfo[$sqlvalue['name']].'&nbsp;</strong></td></tr>';
		}
		if ($ya_config['useinstantmessaim'] >= '1') echo '<tr><td>'._AIM.':</td><td><strong>'.$chnginfo['user_aim'].'&nbsp;</strong></td></tr>';
		if ($ya_config['useinstantmessicq'] >= '1') echo '<tr><td>'._ICQ.':</td><td><strong>'.$chnginfo['user_icq'].'&nbsp;</strong></td></tr>';
		if ($ya_config['useinstantmessmsn'] >= '1') echo '<tr><td>'._MSNM.':</td><td><strong>'.$chnginfo['user_msnm'].'&nbsp;</strong></td></tr>';
		if ($ya_config['useinstantmessyim'] >= '1') echo '<tr><td>'._YIM.':</td><td><strong>'.$chnginfo['user_yim'].'&nbsp;</strong></td></tr>';
		if ($ya_config['uselocation'] >= '1') echo '<tr><td>'._LOCATION.':</td><td><strong>'.$chnginfo['user_from'].'&nbsp;</strong></td></tr>';
		if ($ya_config['useoccupation'] >= '1') echo '<tr><td>'._OCCUPATION.':</td><td><strong>'.$chnginfo['user_occ'].'&nbsp;</strong></td></tr>';
		if ($ya_config['useinterests'] >= '1') echo '<tr><td>'._INTERESTS.':</td><td><strong>'.$chnginfo['user_interests'].'&nbsp;</strong></td></tr>';
		if ($ya_config['usenewsletter'] >= '1') {
			if ($chnginfo['newsletter'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
			echo '<tr><td>'._NEWSLETTER.':</td><td><strong>'.$cnl.'</strong></td></tr>';
		}
		if ($ya_config['useviewemail'] >= '1') {
			if ($chnginfo['user_viewemail'] ==1) { $cuv = _YES; } else { $cuv = _NO; }
			echo '<tr><td>'._SHOWMAIL.':</td><td><strong>'.$cuv.'</strong></td></tr>';
		}
		$chnginfo['user_sig'] = preg_replace("#\r\n#i", "<br />", $chnginfo['user_sig']);
		if ($ya_config['usesignature'] >= '1') echo '<tr><td valign="top">'._SIGNATURE.':</td><td><pre>'.$chnginfo['user_sig'].'&nbsp;</pre></td></tr>';
		if ($ya_config['useextrainfo'] >= '1') echo '<tr><td>'._EXTRAINFO.'</td><td><strong>'.$chnginfo['bio'].'&nbsp;</strong></td></tr>';
		if ($ya_config['usepoints'] >= '1' ) echo '<tr><td>'._YA_POINTS.'</td><td><strong>'.$chnginfo['points'].'&nbsp;</strong></td></tr>';
		echo '<tr><td>'._REGDATE.':</td><td><strong>'.$chnginfo['user_regdate'].'&nbsp;</strong></td></tr>';
		$chnginfo['lastsitevisit'] = date("d F Y H:i", $chnginfo['lastsitevisit']);
		echo '<tr><td>'._YA_LASTVISIT.'</td><td><strong>'.$chnginfo['lastsitevisit'].'</strong></td></tr>';
		$sql2 = 'SELECT uname FROM '.$prefix.'_session WHERE uname=\''.$chnginfo['username'].'\'';
		$result2 = $db->sql_query($sql2);
		$row2 = $db->sql_fetchrow($result2);
		$username_pm = $chnginfo['username'];
		$active_username = $row2['uname'];
		if ($active_username == '') $online = _OFFLINE;
		else $online = _ONLINE;
		echo '<tr><td>'._USERSTATUS.'</td><td><strong>'.$online.'</strong></td></tr>';
		echo '</table></center>';
		echo '<form action="'.$admin_file.'.php" method="post">';
		if (isset($min)) echo '<input type="hidden" name="min" value="'.$min.'" />';
		if (isset($xop)) echo '<input type="hidden" name="op" value="'.$xop.'" />';
		echo '<input type="hidden" name="op" value="modifyUser" />';
		echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />';
		echo '<center><input type="submit" value="'._MODIFY.'" /></center>';
		echo '</form>';
		echo '<form action="#" method="post">';
		echo '<center><input type="button" value="'._RETURN.'" onclick="history.go(-1)" /></center>';
		echo '</form>';
		CloseTable();
	} else {
		OpenTable();
		echo '<center><strong>'._USERNOEXIST.'</strong></center>';
		CloseTable();
	}
	include 'footer.php';
}
?>