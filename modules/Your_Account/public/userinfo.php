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

/**************************************
  Applied rules:
 * LongArrayToShortArrayRector
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring)
 * StrStartsWithRector (https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions)
 * NullToStrictStringFuncCallArgRector
 **************************************/

if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}

if (!isset($bypass)) $bypass = '';
// montego - modified to not just go get the whole phpBB bbconfig table - only get what we need
$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_path\' OR config_name = \'avatar_gallery_path\'');
while ($rowbc = $db->sql_fetchrow($resultbc)) {
	$board_config[$rowbc['config_name']] = $rowbc['config_value'];
}
$username = check_html($username, 'nohtml');
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . addslashes((string) $username) . '\'');
$num = $db->sql_numrows($result);
$usrinfo = $db->sql_fetchrow($result);
include_once 'header.php';
// START - Request fill in birthday - sgtmudd
	function completeUserInfo($usrinfo) {
		GLOBAL $db, $user_prefix;
		if (($usrinfo['user_birthday'] == '0') OR ($usrinfo['user_birthday'] == '999999')) {
			echo '<a href="modules.php?name=Forums&file=profile&mode=editprofile"><u><h1>'. _UPDATEBIRTH .'</h1></u></a><br /><br />';
		} else {
		}
	}
// END - Request fill in birthday - sgtmudd
if ($num == 1) {
	if ($usrinfo['user_level'] > 0) {
		/*
		 * Determine if the logged in user is the same as the user being viewed
		 */
		if (isset($cookie[1]) && isset($cookie[2]) && (strtolower((string) $usrinfo['username']) == strtolower((string) $cookie[1])) && ($usrinfo['user_password'] == $cookie[2])) {
			define('LOGGEDIN_SAME_USER', true);
		}
		$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			[$value] = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_field_values WHERE fid =\'' . intval($sqlvalue['fid']) . '\' AND uid = \'' . intval($usrinfo['user_id']) . '\''));
			$usrinfo[$sqlvalue['name']] = $value;
		}
		OpenTable();
		echo '<div align="center" class="content">';
		/*
		 * montego - Compliance fix when a field is empty/null from the db (producing empty <strong></strong> or <strong></strong> tags)
		 */
		$usrURI = ['user_website', 'user_avatar'];  // Don't override empty URI fields with blank
		foreach($usrinfo as $key => $value) {
			$value = trim((string) $value);
			if ($value == '' and !in_array($key, $usrURI)) $usrinfo[$key] = '&nbsp;';
		}
		/*
		 * General User Info
		 */
		if (defined('LOGGEDIN_SAME_USER')) {
			echo '<p class="option">' . $username . ', ' . _WELCOMETO . ' ' . $sitename . '!</p>';
			echo '<p class="content">' . _THISISYOURPAGE . '</p>';
// START - Request fill in birthday - sgtmudd
			completeUserInfo($usrinfo);
// END - Request fill in birthday - sgtmudd
			//nav(1);
		} else {
			echo '<p class="title">' . _PERSONALINFO . '</p>';
		}
		echo '<table border="0" cellpadding="2" cellspacing="1" width="60%">' ;
		echo '<tr><td align="center" class="title" colspan="2" width="100%">';
		if ($usrinfo['user_avatar_type'] == 1) { // Type 1
			$user_avatar = $board_config['avatar_path'] . '/' . $usrinfo['user_avatar'];
		} elseif ($usrinfo['user_avatar_type'] == 2) { // Type 2
			echo '<img src="' . $usrinfo['user_avatar'] . '" alt="" />';
		} elseif ($usrinfo['user_avatar'] == '') { // Type 3
			echo '<img src="' . $board_config['avatar_gallery_path'] . '/gallery/blank.gif" alt="" />';
		} else {
			echo '<img src="' . $board_config['avatar_gallery_path'] . '/' . $usrinfo['user_avatar'] . '" alt="" />';
		}
		echo '</td></tr>' ;
		if (is_admin($admin) || $usrinfo['user_viewemail'] == 1) {
			$user_email = '<a href="mailto:' . $usrinfo['user_email'] . '">' . $usrinfo['user_email'] . '</a>';
		} else {
			$user_email = _YA_NA;
		}
		echo '<tr><td width="30%" align="left">' . _USERNAME . '</td><td width="70%" align="left"><strong>' . $usrinfo['username'] . '</strong></td></tr>' ;
		if ($ya_config['userealname'] >= '1') {
			echo '<tr><td width="30%" align="left">' . _UREALNAME . '</td><td width="70%" align="left"><strong>' . $usrinfo['name'] . '&nbsp;</strong></td></tr>' ;
		}
		if (is_admin($admin) OR is_user($user) AND $usrinfo['username'] == $username) {
			if ($ya_config['useviewemail'] >= '1') {
				echo '<tr><td width="30%" align="left">' . _EMAIL . '</td><td width="70%" align="left"><strong>' . $user_email . '</strong></td></tr>';
			}
		}
		if ($ya_config['usefakeemail'] >= '1') echo '<tr><td width="30%" align="left">' . _UFAKEMAIL . '</td><td width="70%" align="left"><strong>' . $usrinfo['femail'] . '</strong></td></tr>';
		if ($ya_config['usewebsite'] >= '1') {
			if ($usrinfo['user_website'] == '') {
				$userwebsite = _YA_NA;
			} else {
				$usrinfo['user_website'] = strtolower((string) $usrinfo['user_website']);
				$usrinfo['user_website'] = str_replace('http://', '', $usrinfo['user_website']);
				$userwebsite = '<a href="http://' . $usrinfo['user_website'] . '" target="new">' . $usrinfo['user_website'] . '</a>';
			}
			echo '<tr><td width="30%" align="left">' . _WEBSITE . '</td><td width="70%" align="left"><strong>' . $userwebsite . '</strong></td></tr>';
		}
		/*
		 * Get Custom Fields and display them in desired order
		 */
		if (is_admin($admin) OR is_user($user) AND $usrinfo['username'] == $username) {
			$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" ORDER BY pos');
		} else {
			$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" AND public="1" ORDER BY pos');
		}
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			if (str_starts_with((string) $sqlvalue['name'], '_')) @eval('$name_exit = ' . $sqlvalue['name'] . ';');
			else $name_exit = $sqlvalue['name'];
			echo '<tr><td width="30%" align="left">' . $name_exit . '</td><td width="70%" align="left">' . $usrinfo[$sqlvalue['name']] . '</td></tr>' ;
		}
		/*
		 * Display rest of default fields if they are active
		 */
		if ($ya_config['useinstantmessaim'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			if ($usrinfo['user_aim'] == '') $usrinfo['user_aim'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _AIM . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_aim'] . '</strong></td></tr>' ;
		}
		if ($ya_config['useinstantmessicq'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			if ($usrinfo['user_icq'] == '') $usrinfo['user_icq'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _ICQ . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_icq'] . '</strong></td></tr>' ;
		}
		if ($ya_config['useinstantmessmsn'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			if ($usrinfo['user_msnm'] == '') $usrinfo['user_msnm'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _MSNM . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_msnm'] . '</strong></td></tr>' ;
		}
		if ($ya_config['useinstantmessyim'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			if ($usrinfo['user_yim'] == '') $usrinfo['user_yim'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _YIM . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_yim'] . '</strong></td></tr>' ;
		}
		if ($ya_config['uselocation'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			if ($usrinfo['user_from'] == '') $usrinfo['user_from'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _LOCATION . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_from'] . '</strong></td></tr>' ;
		}
		if ($ya_config['useoccupation'] >= '1') {
			if ($usrinfo['user_occ'] == '') $usrinfo['user_occ'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _OCCUPATION . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_occ'] . '</strong></td></tr>' ;
		}
		if ($ya_config['useinterests'] >= '1') {
			if ($usrinfo['user_interests'] == '') $usrinfo['user_interests'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _INTERESTS . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_interests'] . '</strong></td></tr>' ;
		}
		if ($ya_config['usenewsletter'] >= '1' AND (is_user($user) AND $username == $cookie[1] OR is_admin($admin))) {
			echo '<tr><td width="30%" align="left">' . _NEWSLETTER . '</td><td width="70%" align="left"><strong>';
			if (($usrinfo['newsletter'] == 1)) echo _SUBSCRIBED;
			else echo _NOTSUBSCRIBED;
			echo '</strong></td></tr>' ;
		}
		if ($ya_config['usesignature'] >= '1') {
			// Start - Added to allow bbcode & smilies to be displayed - RN v2.40.00
			$signature = $usrinfo['user_sig'];
			$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path"');
			while ($rowbc = $db->sql_fetchrow($resultbc)) {
				$board_config[$rowbc['config_name']] = $rowbc['config_value'];
			}

			define('IN_PHPBB', TRUE);
			include_once('./includes/constants.php');
			include_once('./includes/bbcode.php');
			include_once('./modules/' . $module_name . '/includes/phpbb_bbinfo.php');

			if ($signature != '') {
				if ( !$board_config['allow_html'] || !$userinfo['user_allowhtml']) {
					$signature = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", (string) $signature);
				}

				if ($usrinfo['user_sig_bbcode_uid'] != '') {
					$signature = ($board_config['allow_bbcode'] && $userinfo['user_allowbbcode']) ? parse_bbcode($signature, $usrinfo['user_sig_bbcode_uid']) : preg_replace("/\:".$usrinfo['user_sig_bbcode_uid']."/si", '', (string) $signature);
				}

				$signature = make_clickable($signature);

				if ($board_config['allow_smilies']) {
					if ($userinfo['user_allowsmile']) {
						$signature = smilies_pass($signature);
					}
				}

				$signature = str_replace("\n", "\n<br />\n", (string) $signature);
			}
			// End
			if ($usrinfo['user_sig'] == '') $signature = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _SIGNATURE . '</td><td width="70%" align="left"><strong>' . $signature . '</strong></td></tr>' ;
		}
/*		if ($ya_config['useextrainfo'] >= '1') {
			$usrinfo['bio'] = nl2br($usrinfo['bio']);
			if ($usrinfo['bio'] == '') $usrinfo['bio'] = _YA_NA;
			echo '<tr><td width="30%" align="left">' . _EXTRAINFO . '</td><td width="70%" align="left"><strong>' . $usrinfo['bio'] . '</strong></td></tr>' ;
		}
		*/
		if ($ya_config['usepoints'] >= '1' AND (is_user($user) AND $cookie[1] == $username OR is_admin($admin))) {
			echo '<tr><td width="30%" align="left">' . _YA_POINTS . '</td><td width="70%" align="left"><strong>' . $usrinfo['points'] . '</strong></td></tr>' ;
		}
		/*
		 * Continue with additional extra fields
		 */
		echo '<tr><td width="30%" align="left">' . _REGDATE . '</td><td width="70%" align="left"><strong>' . $usrinfo['user_regdate'] . '</strong></td></tr>' ;
		$usrinfo['lastsitevisit'] = date('d F Y H:i', $usrinfo['lastsitevisit']);
		if ($usrinfo['lastsitevisit'] == '') $usrinfo['lastsitevisit'] = _YA_NA;
		echo '<tr><td width="30%" align="left">' . _YA_LASTVISIT . '</td><td width="70%" align="left"><strong>' . $usrinfo['lastsitevisit'] . '</strong></td></tr>' ;
		/*
		 * Determine if the user is currently on-line or not
		 */
		$sql2 = 'SELECT uname FROM ' . $prefix . '_session WHERE uname=\'' . addslashes((string) $username) . '\'';
		$result2 = $db->sql_query($sql2);
		if ($db->sql_numrows($result2) > 0) {
			$online = _ONLINE;
		} else {
			$online = _OFFLINE;
		}
		echo '<tr><td width="30%" align="left">' . _USERSTATUS . '</td><td width="70%" align="left"><strong>' . $online . '</strong></td></tr>';
		echo '</table><br />';
		if (is_active('Journal') && defined('LOGGEDIN_SAME_USER')) {
			$sql3 = 'SELECT jid FROM ' . $prefix . '_journal WHERE aid=\'' . addslashes((string) $username) . '\' AND status=\'yes\' ORDER BY pdate,jid DESC LIMIT 0,1';
			$result3 = $db->sql_query($sql3);
			$row3 = $db->sql_fetchrow($result3);
			$jid = $row3['jid'];
			if (isset($jid) && $jid != '') {
				echo '<p>[ <a href="modules.php?name=Journal&amp;file=search&amp;bywhat=aid&amp;forwhat=' . $username . '">' . _READMYJOURNAL . '</a> ]</p>';
			}
		}
		if (is_admin($admin)) {
			if ($usrinfo['last_ip'] != 0) {
				echo '<p>' . _LASTIP . ' <strong>' . $usrinfo['last_ip'] . '</strong><br />';
				echo '[ <a href="' . $admin_file . '.php?op=ABBlockedIPAdd&amp;tip=' . $usrinfo['last_ip'] . '">' . _BANTHIS . '</a> ]</p>';
			}
			echo '<p>[ <a href="' . $admin_file . '.php?op=modifyUser&amp;chng_uid=' . $usrinfo['user_id'] . '">' . _EDITUSER . '</a> ] ';
			echo '[ <a href="' . $admin_file . '.php?op=yaSuspendUser&amp;chng_uid=' . $usrinfo['user_id'] . '">' . _SUSPENDUSER . '</a> ] ';
			echo '[ <a href="' . $admin_file . '.php?op=yaDeleteUser&amp;chng_uid=' . $usrinfo['user_id'] . '">' . _DELETEUSER . '</a> ]</p>';
		}
		if (((is_user($user) AND $cookie[1] != $username) OR is_admin($admin)) AND is_active('Private_Messages')) {
			echo '<p>[ <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $usrinfo['user_id'] . '">' . _USENDPRIVATEMSG . ' ' . $usrinfo['username'] . '</a> ]</p>' ;
		}
		echo '</div>';
		CloseTable();
		$incsdir = dir('modules/' . $module_name . '/includes');
		$incslist = '';
		while ($func = $incsdir->read()) {
			if (str_starts_with($func, 'ui-')) {
				$incslist .= $func . ' ';
			}
		}
		closedir($incsdir->handle);
		$incslist = explode(' ', $incslist);
		sort($incslist);
		$j = sizeof($incslist);
		for ($i = 0;$i < $j;++$i) {
			if ($incslist[$i] != '') {
				$counter = 0;
				include_once($incsdir->path . '/' . $incslist[$i]);
			}
		}
	} else {
		OpenTable();
		echo '<center><strong>' . _NOINFOFOR . ' <i>' . $usrinfo['username'] . '</i></strong></center>';
		if ($usrinfo['user_level'] == 0) {
			echo '<br /><center><strong>' . _ACCSUSPENDED . '</strong></center>';
		}
		if ($usrinfo['user_level'] == -1) {
			echo '<br /><center><strong>' . _ACCDELETED . '</strong></center>';
		}
		CloseTable();
	}
} else {
	OpenTable();
	echo '<center><strong>' . _NOINFOFOR . ' <i>' . $usrinfo['username'] . '</i></strong></center>';
	echo '<br /><center><strong>' . _YA_ACCNOFIND . '</strong></center>';
	CloseTable();
}
include_once 'footer.php';
?>