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
	$pagetitle = ": "._USERADMIN." - "._USERUPDATE;
	include_once 'header.php';
	title(_USERADMIN." - "._USERUPDATE);
	amain();
	echo '<br />';
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE user_id=\''.$chng_uid.'\' OR username=\''.$chng_uid.'\'');
	if($db->sql_numrows($result) > 0) {
		$chnginfo = $db->sql_fetchrow($result);
		$result = $db->sql_query('SELECT * FROM '.$user_prefix.'_users_fields');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			list($value) = $db->sql_fetchrow( $db->sql_query('SELECT value FROM '.$user_prefix.'_users_field_values WHERE fid =\''.$sqlvalue['fid'].'\' AND uid = \''.$chnginfo['user_id'].'\''));
			$chnginfo[$sqlvalue['name']] = $value;
		}
		OpenTable();
		echo '<form action="'.$admin_file.'.php" method="post">';
		echo '<center><table border="0">';
		echo '<tr><td>'._USERID.':</td><td><strong>'.$chnginfo['user_id'].'</strong></td></tr>';
		echo '<tr><td>'._NICKNAME.':</td><td><input type="text" name="chng_uname" value="'.$chnginfo['username'].'" size="20" /><br /><strong>'._YA_CHNGRISK.'</strong></td></tr>';
		if ($ya_config['userealname'] >= '0') echo '<tr><td>'._UREALNAME.':</td><td><input type="text" name="chng_name" value="'.$chnginfo['name'].'" size="45" maxlength="60" /></td></tr>';
		echo '<tr><td>'._EMAIL.':</td><td><input type="text" name="chng_email" value="'.$chnginfo['user_email'].'" size="45" maxlength="60" /> <font class="tiny">'._REQUIRED.'</font></td></tr>';
		if ($ya_config['usefakeemail'] >= '0') echo '<tr><td>'._FAKEEMAIL.':</td><td><input type="text" name="chng_femail" value="'.$chnginfo['femail'].'" size="45" maxlength="60" /></td></tr>';
		if ($ya_config['usewebsite'] >= '0') echo '<tr><td>'._URL.':</td><td><input type="text" name="chng_url" value="'.$chnginfo['user_website'].'" size="45" maxlength="60" /></td></tr>';
		$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" ORDER BY pos');
		while ($sqlvalue = $db->sql_fetchrow($result)) {
			$t = (int)$sqlvalue['fid'];
			list($value) = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_field_values WHERE fid =\'' . $t . '\' AND uid = \'' . $userinfo['user_id'] . '\''));
			$value2 = explode('::', $sqlvalue['value']);
			if (substr($sqlvalue['name'], 0, 1) == '_') @eval('$name_exit = '.$sqlvalue['name'].';');
			else $name_exit = $sqlvalue['name'];
			if (count($value2) == 1) {
				$size = 60;
				if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
				echo '<tr><td>' . $name_exit . '</td><td><input type="text" name="nfield[' . $t . ']" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" value="' . htmlspecialchars($value) . '" /></td></tr>';
			} else {
				echo '<tr><td>' . $name_exit . '</td><td>';
				echo '<select name="nfield[' . $t . ']">';
				$j = count($value2);
				for ($i = 0;$i < $j;++$i) {
					if (trim($value) == trim($value2[$i])) $sel = ' selected="selected"';
					else $sel = '';
					echo '<option value="' . trim($value2[$i]) . '"' . $sel . '>' . $value2[$i] . '</option>';
				}
				echo '</select>';
				echo '</td></tr>';
			}
		}
		if ($ya_config['useinstantmessaim'] >= '0') echo '<tr><td>'._AIM.':</td><td><input type="text" name="chng_user_aim" value="' . $chnginfo['user_aim'] . '" size="20" maxlength="20" /></td></tr>';
		if ($ya_config['useinstantmessicq'] >= '0') echo '<tr><td>'._ICQ.':</td><td><input type="text" name="chng_user_icq" value="' . $chnginfo['user_icq'] . '" size="20" maxlength="20" /></td></tr>';
		if ($ya_config['useinstantmessmsn'] >= '0') echo '<tr><td>'._MSNM.':</td><td><input type="text" name="chng_user_msnm" value="' . $chnginfo['user_msnm'] . '" size="20" maxlength="20" /></td></tr>';
		if ($ya_config['useinstantmessyim'] >= '0') echo '<tr><td>'._YIM.':</td><td><input type="text" name="chng_user_yim" value="' . $chnginfo['user_yim'] . '" size="20" maxlength="20" /></td></tr>';
		if ($ya_config['uselocation'] >= '0') echo '<tr><td>'._LOCATION.':</td><td><input type="text" name="chng_user_from" value="' . $chnginfo['user_from'] . '" size="25" maxlength="60" /></td></tr>';
		if ($ya_config['useoccupation'] >= '0') echo '<tr><td>'._OCCUPATION.':</td><td><input type="text" name="chng_user_occ" value="' . $chnginfo['user_occ'] . '" size="25" maxlength="60" /></td></tr>';
		if ($ya_config['useinterests'] >= '0') echo '<tr><td>'._INTERESTS.':</td><td><input type="text" name="chng_user_interests" value="' . $chnginfo['user_interests'] . '" size="25" maxlength="255" /></td></tr>';
		$cnl = $cnl2 = '';
		if ($chnginfo['newsletter'] == 1) $cnl = 'checked="checked"';
		else $cnl2 = 'checked="checked"';
		if ($ya_config['usenewsletter'] >= '1') echo '<tr><td>' . _NEWSLETTER . ': </td><td><input type="radio" name="chng_newsletter" value="1" ' . $cnl . ' /> '._YES.' <input type="radio" name="chng_newsletter" value="0" ' . $cnl2 . ' /> '._NO.'</td></tr>';
		$cuv = $cuv2 = '';
		if ($chnginfo['user_viewemail'] == 1) $cuv = 'checked="checked"';
		else $cuv2 = 'checked="checked"';
		if ($ya_config['useviewemail'] >= '1') echo '<tr><td>' . _ALLOWUSERS . ':</td><td><input type="radio" name="chng_user_viewemail" value="1" ' . $cuv . ' /> '._YES.' <input type="radio" name="chng_user_viewemail" value="0" ' . $cuv2 . ' /> '._NO.'</td></tr>';
		$yacontent = '';
/*
        $subnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_subscriptions WHERE userid='$chng_uid'"));
        if ($subnum == 0) {
            $yacontent .= "<tr><td>"._SUBUSERASK.":</td><td><input type='radio' name='subscription' value='1' /> "._YES."&nbsp;&nbsp;&nbsp;<input type='radio' name='subscription' value='0' checked='checked' /> "._NO."</td></tr>";
            $yacontent .= "<tr><td>"._SUBPERIOD.":</td><td><select name='subscription_expire'>";
            $yacontent .= "<option value='0' selected='selected'>"._NONE."</option>";
            $yacontent .= "<option value='1'>1 "._YEAR."</option>";
            $yacontent .= "<option value='2'>2 "._YEARS."</option>";
            $yacontent .= "<option value='3'>3 "._YEARS."</option>";
            $yacontent .= "<option value='4'>4 "._YEARS."</option>";
            $yacontent .= "<option value='5'>5 "._YEARS."</option>";
            $yacontent .= "<option value='6'>6 "._YEARS."</option>";
            $yacontent .= "<option value='7'>7 "._YEARS."</option>";
            $yacontent .= "<option value='8'>8 "._YEARS."</option>";
            $yacontent .= "<option value='9'>9 "._YEARS."</option>";
            $yacontent .= "<option value='10'>10 "._YEARS."</option>";
            $yacontent .= "</select><input type='hidden' name='reason' value='0' /></td></tr>";
        } elseif ($subnum == 1) {
            $yacontent .= "<tr><td>"._UNSUBUSER.":</td><td><input type='radio' name='subscription' value='0' /> "._YES."&nbsp;&nbsp;&nbsp;<input type='radio' name='subscription' value='1' checked='checked' /> "._NO."</td></tr>";
            $yacontent .= "<tr><td>"._ADDSUBPERIOD.":</td><td><select name='subscription_expire'>";
            $yacontent .= "<option value='0' selected='selected'>"._NONE."</option>";
            $yacontent .= "<option value='1'>1 "._YEAR."</option>";
            $yacontent .= "<option value='2'>2 "._YEARS."</option>";
            $yacontent .= "<option value='3'>3 "._YEARS."</option>";
            $yacontent .= "<option value='4'>4 "._YEARS."</option>";
            $yacontent .= "<option value='5'>5 "._YEARS."</option>";
            $yacontent .= "<option value='6'>6 "._YEARS."</option>";
            $yacontent .= "<option value='7'>7 "._YEARS."</option>";
            $yacontent .= "<option value='8'>8 "._YEARS."</option>";
            $yacontent .= "<option value='9'>9 "._YEARS."</option>";
            $yacontent .= "<option value='10'>10 "._YEARS."</option>";
            $yacontent .= "</select></td></tr>";
            $yacontent .= "<tr><td>"._ADMSUBEXPIREIN."</td><td>";
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_subscriptions WHERE userid='$chng_uid'"));
            $diff = $row['subscription_expire']-time();
            $yearDiff = floor($diff/60/60/24/365);
            $diff -= $yearDiff*60*60*24*365;
            if ($yearDiff < 1) {
                $diff = $row['subscription_expire']-time();
            }
            $daysDiff = floor($diff/60/60/24);
            $diff -= $daysDiff*60*60*24;
            $hrsDiff = floor($diff/60/60);
            $diff -= $hrsDiff*60*60;
            $minsDiff = floor($diff/60);
            $diff -= $minsDiff*60;
            $secsDiff = $diff;
            if ($yearDiff < 1) {
                $rest = "$daysDiff "._SBDAYS.", $hrsDiff "._SBHOURS.", $minsDiff "._SBMINUTES.", $secsDiff "._SBSECONDS."";
            } elseif ($yearDiff == 1) {
                $rest = "$yearDiff "._SBYEAR.", $daysDiff "._SBDAYS.", $hrsDiff "._SBHOURS.", $minsDiff "._SBMINUTES.", $secsDiff "._SBSECONDS."";
            } elseif ($yearDiff > 1) {
                $rest = "$yearDiff "._SBYEARS.", $daysDiff "._SBDAYS.", $hrsDiff "._SBHOURS.", $minsDiff "._SBMINUTES.", $secsDiff "._SBSECONDS."";
            }
            $yacontent .= "<font color='#FF0000'>$rest</font></td></tr>";
            $yacontent .= "<tr><td valign='top'>"._SUBREASON."</td><td><textarea name='reason' cols='60' rows='10'></textarea></td></tr>";
        }
		echo $yacontent;
*/
		if ($ya_config['usesignature'] >= '0') echo '<tr><td valign="top">' . _SIGNATURE . ':</td><td><textarea name="chng_user_sig" rows="6" cols="45">' . $chnginfo['user_sig'] . '</textarea></td></tr>';
		if ($ya_config['usepoints'] >= '0') echo '<tr><td>' . _YA_POINTS . ':</td><td><input type="text" name="chng_points" value="' . $chnginfo['points'] . '" /></td></tr>';
		echo '<tr><td>' . _PASSWORD . ':</td><td><input type="password" name="chng_pass" size="12" maxlength="12" /></td></tr>';
		echo '<tr><td>' . _RETYPEPASSWD . ':</td><td><input type="password" name="chng_pass2" size="12" maxlength="12" /> <font class="tiny">' . _FORCHANGES . '</font></td></tr>';
		echo '<tr><td align="center" colspan="2"><input type="submit" value="' . _SAVECHANGES . '" />';
		echo '<input type="hidden" name="chng_avatar" value="' . $chnginfo['user_avatar'] . '" />';
		echo '<input type="hidden" name="chng_uid" value="' . $chng_uid . '" />';
		echo '<input type="hidden" name="old_uname" value="' . $chnginfo['username'] . '" />';
		echo '<input type="hidden" name="old_email" value="' . $chnginfo['user_email'] . '" />';
		echo '<input type="hidden" name="op" value="yaModifyUserConf" />';
		if (isset($query)) echo '<input type="hidden" name="query" value="' . $query . '" />';
		if (isset($min)) echo '<input type="hidden" name="min" value="' . $min . '" />';
		if (isset($xop)) echo '<input type="hidden" name="xop" value="' . $xop . '" />';
		echo '</td></tr></table></center>';
		echo '</form>';
		echo '<form action="#" method="post">';
		echo '<center><input type="button" value="' . _CANCEL . '" onclick="history.go(-1)" /></center>';
		echo '</form>';
		CloseTable();
	} else {
		OpenTable();
		echo '<center><strong>' . _USERNOEXIST . '</strong></center>';
		CloseTable();
	}
	include_once 'footer.php';
}
?>