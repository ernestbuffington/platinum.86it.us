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
getusrinfo($user);
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once 'header.php';
	title(_PERSONALINFO);
	OpenTable();
	nav();
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form name="Register" action="modules.php?name=' . $module_name . '" method="post">';
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td><strong>' . _USRNICKNAME . '</strong>:</td><td><strong>' . $userinfo['username'] . '</strong></td></tr>';
	if ($ya_config['userealname'] >= '1') {
		echo '<tr><td><strong>' . _UREALNAME . '</strong>:';
		if ($ya_config['userealname'] == '3') echo '<br />' . _REQUIRED;
		echo '</td><td>';
		echo '<input type="text" name="realname" value="' . $userinfo['name'] . '" size="50" maxlength="60" /></td></tr>';
	}
	echo '<tr><td><strong>' . _UREALEMAIL . ':</strong><br />' . _REQUIRED . '</td><td>';
	if ($ya_config['allowmailchange'] == 1) {
		echo '<input type="text" name="user_email" value="' . $userinfo['user_email'] . '" size="50" maxlength="255" /><br />' . _EMAILNOTPUBLIC;
	} else {
		echo $userinfo['user_email'] . '<input type="hidden" name="user_email" value="' . $userinfo['user_email'] . '" />';
	}
	echo '</td></tr>';
	if ($ya_config['usefakeemail'] >= '1') {
		echo '<tr><td><strong>' . _UFAKEMAIL . ':</strong></td>';
	echo '<td><input type="text" name="femail" value="' . $userinfo['femail'] . '" size="50" maxlength="255" /><br />' . _EMAILPUBLIC . '</td></tr>';
	}
	if ($ya_config['usewebsite'] >= '1') {
		if (!preg_match('#^http[s]?:\/\/#i', $userinfo['user_website'])) {
			$userinfo['user_website'] = 'http://' . $userinfo['user_website'];
		}
		if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $userinfo['user_website'])) {
			$userinfo['user_website'] = '';
		}
		echo '<tr><td><strong>' . _YOURHOMEPAGE . ':</strong>';
		if ($ya_config['usewebsite'] == '3') echo '<br />' . _REQUIRED;
		echo '</td><td>';
		echo '<input type="text" name="user_website" value="' . $userinfo['user_website'] . '" size="50" maxlength="255" /></td></tr>';
	}
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" ORDER BY pos');
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = (int)$sqlvalue['fid'];
		list($value) = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_field_values WHERE fid =\'' . $t . '\' AND uid = \'' . $userinfo['user_id'] . '\''));
		$value2 = explode('::', $sqlvalue['value']);
		if (substr($sqlvalue['name'], 0, 1) == '_') @eval('$name_exit = ' . $sqlvalue['name'] . ';');
		else $name_exit = $sqlvalue['name'];
		echo '<tr><td><strong>' . $name_exit . '</strong>';
		if (($sqlvalue['need']) == 3) echo '<br />' . _REQUIRED;
		echo '</td><td>';
		if (count($value2) == 1) {
			$size = 60;
			if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
			echo '<input type="text" name="nfield[' . $t . ']" value="' . htmlspecialchars($value) . '" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" />';
		} else {
			echo '<select name="nfield[' . $t . ']">';
			$j = count($value2);
			for ($i = 0;$i < $j;++$i) {
				if (trim($value) == trim($value2[$i])) $sel = ' selected="selected"';
				else $sel = '';
				echo '<option value="' . trim($value2[$i]) . '"' . $sel . '>' . $value2[$i] . '</option>';
			}
			echo '</select>';
		}
		echo '</td></tr>';
	}
	if ($ya_config['useinstantmessaim'] >= '1') {
		echo '<tr><td><strong>' . _YAIM . ':</strong></td>';
		echo '<td><input type="text" name="user_aim" value="' . $userinfo['user_aim'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useinstantmessicq'] >= '1') {
		if (!preg_match('/^[0-9]+$/', $userinfo['user_icq'])) { $userinfo['user_icq'] = ''; }
		echo '<tr><td><strong>' . _YICQ . ':</strong></td>';
		echo '<td><input type="text" name="user_icq" value="' . $userinfo['user_icq'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useinstantmessmsn'] >= '1') {
		echo '<tr><td><strong>' . _YMSNM . ':</strong></td>';
		echo '<td><input type="text" name="user_msnm" value="' . $userinfo['user_msnm'] . '" size="30" maxlength="100"/></td></tr>';
	}
	if ($ya_config['useinstantmessyim'] >= '1') {
		echo '<tr><td><strong>' . _YYIM . ':</strong></td>';
		echo '<td><input type="text" name="user_yim" value="' . $userinfo['user_yim'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['uselocation'] >= '1') {
		echo '<tr><td><strong>' . _YLOCATION . ':</strong></td>';
		echo '<td><input type="text" name="user_from" value="' . $userinfo['user_from'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useoccupation'] >= '1') {
		echo '<tr><td><strong>' . _YOCCUPATION . ':</strong></td>';
		echo '<td><input type="text" name="user_occ" value="' . $userinfo['user_occ'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useinterests'] >= '1') {
		echo '<tr><td><strong>' . _YINTERESTS . ':</strong></td>';
		echo '<td><input type="text" name="user_interests" value="' . $userinfo['user_interests'] . '" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['usenewsletter'] >= '1') {
		echo '<tr><td><strong>' . _RECEIVENEWSLETTER . '</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['newsletter'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="newsletter"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	if ($ya_config['useviewemail'] >= '1') {
		echo '<tr><td><strong>' . _ALLOWUSERS . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_viewemail'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_viewemail"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	if ($ya_config['usehideonline'] >= '1') {
		echo '<tr><td><strong>' . _HIDEONLINE . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_allow_viewonline'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_allow_viewonline"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td><strong>' . _REPLYNOTIFY . ':</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _REPLYNOTIFYMSG . '</td></tr>';
	echo '<tr><td><strong>' . _PMNOTIFY . ':</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify_pm'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _POPPM . ':</strong></td><td>';
	if ($userinfo['user_popup_pm'] == 1) {
		$ck1 = ' selected="selected"';
		$ck2 = '';
	} else {
		$ck1 = '';
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_popup_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _POPPMMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td><strong>' . _ATTACHSIG . ':</strong></td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_attachsig'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_attachsig"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td><strong>' . _ALLOWBBCODE . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowbbcode'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowbbcode"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _ALLOWHTMLCODE . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowhtml'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowhtml"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _ALLOWSMILIES . '</strong></td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowsmile'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowsmile"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td><strong>' . _FORUMSTIME . '</strong></td><td>';
	echo '<select name="user_timezone">';
	for ($i = -12;$i < 13;$i++) {
		if ($i == 0) {
			$dummy = 'GMT';
		} else {
			if (!preg_match('/-/', $i)) {
				$i = '+' . $i;
			}
			$dummy = 'GMT ' . $i . ' ' . _HOURS;
		}
		if ($userinfo['user_timezone'] == $i) {
			echo '<option value="' . $i . '" selected="selected">' . $dummy . '</option>';
		} else {
			echo '<option value="' . $i . '">' . $dummy . '</option>';
		}
	}
	echo '</select>';
	echo '</td></tr>';
	echo '<tr><td><strong>' . _FORUMSDATE . ':</strong></td><td>';
	echo '<input size="15" maxlength="14" type="text" name="user_dateformat" value="' . $userinfo['user_dateformat'] . '" />';
	echo '<br />' . _FORUMSDATEMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td><strong>' . _SIGNATURE . ':</strong><br /></td>';
		echo '<td><textarea cols="50" rows="5" name="user_sig">' . htmlspecialchars($userinfo['user_sig']) . '</textarea><br />' . _255CHARMAX . '</td></tr>';
	}
	if ($ya_config['useextrainfo'] >= '1') {
		echo '<tr><td><strong>' . _EXTRAINFO . ':</strong><br /></td>';
		echo '<td><textarea cols="50" rows="5" name="bio">' . htmlspecialchars($userinfo['bio']) . '</textarea><br />' . _CANKNOWABOUT . '</td></tr>';
	}
	echo '<tr><td><strong>' . _PASSWORD . '</strong>:</td>';
	echo '<td><input type="password" name="user_password" size="22" maxlength="' . $ya_config['pass_max'] . '" />&nbsp;&nbsp;&nbsp;<input type="password" name="vpass" size="22" maxlength="' . $ya_config['pass_max'] . '" /><br />' . _TYPENEWPASSWORD . '</td></tr>';
	echo '<tr><td colspan="2" align="center">';
	echo '<input type="hidden" name="username" value="' . $userinfo['username'] . '" />';
	echo '<input type="hidden" name="user_id" value="' . $userinfo['user_id'] . '" />';
	echo '<input type="hidden" name="op" value="saveuser" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" />';
	echo '</td></tr></table></form>';
	$avatar_category = (!empty($_POST['avatarcategory'])) ? $_POST['avatarcategory'] : '';
	//menelaos@hetnet.nl
	$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig');
	while ($rowbc = $db->sql_fetchrow($resultbc)) {
		$board_config[$rowbc['config_name']] = $rowbc['config_value'];
	}
	$direktori = $board_config['avatar_gallery_path'];
	$dir = @opendir($direktori);
	$avatar_images = array();
	while ($file = @readdir($dir)) {
		if ($file != '.' && $file != '..' && !is_file($direktori . '/' . $file) && !is_link($direktori . '/' . $file)) {
			$sub_dir = @opendir($direktori . '/' . $file);
			$avatar_row_count = 0;
			$avatar_col_count = 0;
			while ($sub_file = @readdir($sub_dir)) {
				if (preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $sub_file)) {
					$avatar_images[$file][$avatar_row_count][$avatar_col_count] = $file . '/' . $sub_file;
					$avatar_name[$file][$avatar_row_count][$avatar_col_count] = ucfirst(str_replace('_', ' ', preg_replace('/^(.*)\..*$/', '\1', $sub_file)));
					$avatar_col_count++;
					if ($avatar_col_count == 5) {
						$avatar_row_count++;
						$avatar_col_count = 0;
					}
				}
			}
		}
	}
	@closedir($dir);
	@ksort($avatar_images);
	@reset($avatar_images);
	if (empty($category)) {
		list($category,) = each($avatar_images);
	}
	@reset($avatar_images);
	$s_categories = '<select name="avatarcategory">';
	while (list($key) = each($avatar_images)) {
		$selected = ($key == $category) ? ' selected="selected"' : '';
		if (count($avatar_images[$key])) {
			$s_categories.='<option value="' . $key . '"' . $selected . '>' . ucfirst($key) . '</option>';
		}
	}
	$s_categories.='</select>';
	if ($userinfo['user_avatar_type'] == 1) {
		$user_avatar = $board_config['avatar_path'] . '/' . $userinfo['user_avatar'];
	} elseif ($userinfo['user_avatar_type'] == 2) {
		$user_avatar = $userinfo['user_avatar'];
	} else {
		$user_avatar = $board_config['avatar_gallery_path'] . '/' . $userinfo['user_avatar'];
	}
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td colspan="2" align="center">';
	echo '<font class="title">' . _YA_AVCP . '</font><br /></td></tr>';
	echo '<tr><td>' . _YA_AVINF1 . ' ' . $board_config['avatar_max_width'] . ' ' . _YA_AVINF2 . ' ' . $board_config['avatar_max_height'] . ' ' . _YA_AVINF3 . ' ' . YA_CoolSize($board_config['avatar_filesize']) . '.</td>';
	if (preg_match('/http/', $userinfo['user_avatar'])) {
		//avatarfix by menelaos dot hetnet dot nl
		echo '<td align="center">' . _YA_CURRAV . '<br /><img alt="" src="' . $direktori/$userinfo['user_avatar'] . '" width="40" height="50" /></td></tr>';
	} elseif ($userinfo['user_avatar']) {
		echo '<td align="center">' . _YA_CURRAV . '<br /><img alt="" src="' . $direktori . '/' . $userinfo['user_avatar'] . '" width="40" height="50" /></td></tr>';
	}
	//echo '<br />';
	if ($board_config['allow_avatar_local']) {
		echo '<tr><td><strong>' . _YA_SELAVGALL . ':</strong></td>';
		echo '<td><form action="modules.php?name=Your_Account&amp;op=avatarlist" method="post">' . $s_categories . '&nbsp;<img src="images/right.gif" align="middle" alt="" />&nbsp;<input class="button" type="submit" value="' . _YA_SHOWGALL . '" /></form></td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_SELAVGALL.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	if ($board_config['allow_avatar_upload']) {
		echo '<tr><td><strong>' . _YA_UPLOADAV . ':</strong></td>';
		echo '<td><a href="modules.php?name=Forums&amp;file=profile&amp;mode=editprofile"><strong>' . _YA_UPLOADFORUM . '</strong></a></td></tr>';
		echo '<tr><td><strong>' . _YA_UPLOADURL . ':</strong><br /><span class="gensmall">' . _YA_AVCOPIED . '</span></td>';
		echo '<td><a href="modules.php?name=Forums&amp;file=profile&amp;mode=editprofile"><strong>' . _YA_UPLOADFORUM . '</strong></a></td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_UPLOADURL.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';
		//echo '<tr><td><strong>'._YA_UPLOADAV.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	if ($board_config['allow_avatar_remote']) {
		echo '<tr><td><strong>' . _YA_OFFSITE . ':</strong><br /><span class="gensmall">' . _YA_SUBMITBUTTON . '</span></td>';
		echo '<td><form action="modules.php?name=Your_Account&amp;op=avatarlinksave" method="post">';
		if ($userinfo['user_avatar_type'] == 2) {
			echo '<input class="post" style="width: 150px" size="25" name="avatar" value="' . $userinfo['user_avatar'] . '\ /> &nbsp;&nbsp;<input class="mainoption" type="submit" value="Submit">';
		} else {
			echo '<input class="post" style="width: 150px" size="25" name="avatar" value="http://" /> &nbsp;&nbsp;<input class="mainoption" type="submit" value="Submit" />';
		}
		echo '</form></td></tr>';
		echo '<tr><td colspan="2" align="center">&nbsp;</td></tr>';
	//} else {
		//echo '<tr><td><strong>'._YA_OFFSITE.':</strong></td>';
		//echo '<td><strong>'._YA_DISABLED.'</strong></td></tr>';

	}
	echo '</table>';
	CloseTable();
	include_once 'footer.php';
} else {
	mmain($user);
}
?>