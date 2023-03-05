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
	include_once('header.php');
	title('"'._USERADMIN.' - '._DETUSER.': <i>'.$chng_uid.'</i>');
	amain();
	echo '<br />'."\n";
	$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_temp WHERE user_id=\''.$chng_uid.'\'');
	if($db->sql_numrows($result) > 0) {
		$chnginfo = $db->sql_fetchrow($result);
		OpenTable();
		echo '<center><table border="0">'."\n";
		echo '<tr><td>'._USERID.':</td><td><strong><input type="text" value="'.$chnginfo['user_id'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></strong></td></tr>'."\n";
		echo '<tr><td>'._NICKNAME.':</td><td><strong><input type="text" value="'.$chnginfo['username'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></strong></td></tr>'."\n";
		echo '<tr><td>'._UREALNAME.':</td><td><strong><input type="text" value="'.$chnginfo['name'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></strong></td></tr>'."\n";
		echo '<tr><td>'._EMAIL.':</td><td><strong><a href="mailto:'.$chnginfo['user_email'].'"><input type="text" value="'.$chnginfo['user_email'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></a></strong></td></tr>'."\n";

		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields WHERE need <> \'0\' ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			$t = $sqlvalue['fid'];
			$result1 = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_temp_field_values WHERE uid=\''.$chng_uid.'\' AND fid=\''.$t.'\'');
			while ($tmpsqlvalue = $db->sql_fetchrow($result1)) {
				$tmp_value=$tmpsqlvalue[value];
				if (substr($sqlvalue['name'],0,1)=='_') @eval('$name_exit = '.$sqlvalue['name'].';'); else $name_exit = $sqlvalue['name'];
				echo '<tr><td>'.$name_exit.'</td><td><strong><input type="text" value="'.$tmp_value.'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></strong></td></tr>'."\n";
			}
		}
	echo '<tr><td>'._REGDATE.':</td><td><input type="text" value="'.$chnginfo['user_regdate'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>'."\n";
	$chnginfo['time'] = date("D M j H:i T Y", $chnginfo['time']);
	echo '<tr><td>'._YA_APPROVE2.':</td><td><input type="text" value="'.$chnginfo['time'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /> </td></tr>'."\n";
	echo '<tr><td>'._CHECKNUM.':</td><td><input type="text" value="'.$chnginfo['check_num'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>';"\n";
	echo '<tr><td colspan="2" align="left"><br />'."\n";
	echo '<table cellspacing="0" cellpadding="0" border="0"><tr><td>';"\n";
	echo '<form action="#" method="post">';"\n";
#    echo '<form action="'.$admin_file.'.php" method="post">';
#    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
#		echo "<input type='submit' value='"._RETURN."' /></form></td>\n";
	echo '<input type="button" value="'._RETURN.'" onclick="history.go(-1)" /></form></td>'."\n";
	echo '<td width="3">&nbsp;</td>'."\n";
	echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
	if (isset($xop)) { echo '<input type="hidden" name="op" value="'.$xop.'" />'."\n"; }
	echo '<input type="hidden" name="op" value="yaModifyTemp" />'."\n";
	echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />'."\n";
	echo '<input type="submit" value="'._MODIFY.'" /></form></td>'."\n";
	echo '<td width="3"></td>'."\n";
	echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
	if (isset($xop)) { echo '<input type="hidden" name="op" value="'.$xop.'" />'."\n"; }
	echo '<input type="hidden" name="op" value="yaDenyUser" />'."\n";
	echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />'."\n";
	echo '<input type="submit" value="'._DENY.'" /></form></td>'."\n";
	echo '<td width="3"></td>'."\n";
	if ($ya_config['useactivate'] == 1) {
		echo '<td valign="top"><form action="'.$admin_file.'.php" method="post">'."\n";
		if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
		if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
		echo '<input type="hidden" name="op" value="yaApproveUserConf" />'."\n";
		echo '<input type="hidden" name="apr_uid" value="'.$chnginfo['user_id'].'" />'."\n";
		echo '<input type="submit" value="'._YA_APPROVE.'" /></form></td>'."\n";
	 } else {
		echo '<td><form action="'.$admin_file.'.php" method="post">'."\n";
		if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
		if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
		echo '<input type="hidden" name="op" value="yaActivateUser" />'."\n";
		echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'" />'."\n";
		echo '<input type="submit" value="'._YA_ACTIVATE.'"></form></td>'."\n";
	}
	echo '</tr></table>'."\n";

	echo '</td></tr><tr><td colspan="2"><strong>'._NOTE.'</strong>'."\n";
	echo '</td></tr><tr><td colspan="2"><strong>'._YA_APPROVENOTE.'</strong>'."\n";
	echo '</td></tr><tr><td colspan="2"><strong>'._YA_ACTIVATENOTE.'</strong>'."\n";
	echo '</td></tr></table></center>'."\n";
	echo '<br />'."\n";
	CloseTable();
	} else {
		OpenTable();
		echo '<center><strong>'._USERNOEXIST.'</strong></center>'."\n";
		CloseTable();
	}
include_once('footer.php');
}
?>