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
/********************************************************/
/* Coded by Richard van Oosterhout, the Netherlands	  */
/* (menelaos dot hetnet dot nl)				  */
/* based on MyCookies Manager by A_Jelly_Doughnut       */
/* and work by Josh Pettit of UBB.Threads		  */
/********************************************************/
/*************************************************************************************/
// function yacookiecheck()
/*************************************************************************************/
function yacookiecheck() {
	global $ya_config;
	setcookie('RNYA_test1', 'value1');
	setcookie('RNYA_test2', 'value2', time() + 3600);
	setcookie('RNYA_test3', 'value3', time() + 3600, '/');
	setcookie('RNYA_test4', 'value4', time() + 3600, $ya_config['cookiepath']);
}
/*************************************************************************************/
// function yacookiecheckresults()
/*************************************************************************************/
function yacookiecheckresults() {
	global $ya_config, $module_name;
	$cookiedebug = '0'; // cookiedebug: set this to '1' if you want additional debug info
	if (($_COOKIE['RNYA_test3'] != 'value3') OR ($cookiedebug == '1')) {
		include_once 'header.php';
		Show_YA_menu();
		OpenTable();
	}
	$debugcookie = '<table width="100%" cellspacing="10" cellpadding="0" border="0" align="center">';
	if ($_COOKIE['RNYA_test1'] == 'value1') {
		$debugcookie .= '<tr><td>1: setcookie("RNYA_test1","value1";)';
		$debugcookie .= '</td><td><font color="#009933"><strong>' . _YA_COOKIEOK . '</strong></font></td></tr>';
	} else {
		$debugcookie .= '<tr><td>1: setcookie("RNYA_test1","value1";)';
		$debugcookie .= '</td><td><font color="#FF3333"><strong>' . _YA_COOKIEFAIL . '</strong></font></td></tr>';
	}
	if ($_COOKIE['RNYA_test2'] == 'value2') {
		$debugcookie .= '<tr><td>2: setcookie("RNYA_test2","value2",time()+120)';
		$debugcookie .= '</td><td><font color="#009933"><strong>' . _YA_COOKIEOK . '</strong></font></td></tr>';
	} else {
		$debugcookie .= '<tr><td>2: setcookie("RNYA_test2","value2",time()+120)';
		$debugcookie .= '</td><td><font color="#FF3333"><strong>' . _YA_COOKIEFAIL . '</strong></font></td></tr>';
	}
	if ($_COOKIE['RNYA_test3'] == 'value3') {
		$debugcookie .= '<tr><td>3: setcookie("RNYA_test3","value3",time()+120,"/")';
		$debugcookie .= '</td><td><font color="#009933"><strong>' . _YA_COOKIEOK . '</strong></font></td></tr>';
	} else {
		$debugcookie .= '<tr><td>3: setcookie("RNYA_test3","value3",time()+120,"/")';
		$debugcookie .= '</td><td><font color="#FF3333"><strong>' . _YA_COOKIEFAIL . '</strong></font></td></tr>';
	}
	if ($_COOKIE['RNYA_test4'] == 'value4') {
		$debugcookie .= '<tr><td>4: setcookie("RNYA_test4","value4",time()+120,"' . $ya_config['cookiepath'] . '\')';
		$debugcookie .= '</td><td><font color="#009933"><strong>' . _YA_COOKIEOK . '</strong></font></td></tr>';
	} else {
		$debugcookie .= '<tr><td>4: setcookie("RNYA_test4","value4",time()+120,"' . $ya_config['cookiepath'] . '\')';
		$debugcookie .= '</td><td><font color="#FF3333"><strong>' . _YA_COOKIEFAIL . '</strong></font></td></tr>';
	}
	$debugcookie .= '</td></tr></table>';
	if ($_COOKIE['RNYA_test3'] != 'value3') {
		echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr>';
		echo '<td colspan="2"><img src="modules/' . $module_name . '/images/warning.png" alt="" align="left" width="40" height="40" />';
		echo '<font color="#FF3333"><strong>' . _YA_COOKIENO . '</strong></font>';
		echo '</td></tr><tr><td valign="top">';
		if ($cookiedebug == '1') {
			OpenTable();
			echo $debugcookie;
			CloseTable();
		}
		// In a next development stage we will give users some tips on how to enable cookies in their browser
		// echo "We will give you some ideas on how to solve this.<br /><br />";
		// echo "If you use Internet Explorer, click here<br />";
		// echo "If you use Mozilla, click here<br />";
		// echo "If you use Opera, click here<br />";
		// echo "If you use Netscape, click here<br />";
		echo '</td></tr></table>';
	} elseif ($cookiedebug == '1') {
		echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr>';
		echo '<td colspan="2"><img src="modules/' . $module_name . '/images/warning.png" alt="" align="left" width="40" height="40" />';
		echo '<font color="#009933"><strong>' . _YA_COOKIEYES . '</strong></font>';
		echo '</td></tr><tr><td valign="top">';
		if ($cookiedebug == '1') {
			OpenTable();
			echo $debugcookie;
			CloseTable();
		}
		echo '</td><tr><form action="modules.php?name=' . $module_name . '" method="post">';
		echo '<td align="right"><input type="submit" name="submit" value="' . _YA_CONTINUE . '" /></td></form></tr></table>';
	}
	setcookie('RNYA_test1', 'expired1', time() - 604800, '');
	setcookie('RNYA_test2', 'expired2', time() - 604800, '');
	setcookie('RNYA_test3', 'expired3', time() - 604800, '/');
	setcookie('RNYA_test4', 'expired4', time() - 604800, $ya_config['cookiepath']);
	if (($_COOKIE['RNYA_test3'] != 'value3') OR ($cookiedebug == '1')) {
		CloseTable();
		echo '<br />';
		include_once 'footer.php';
	}
}
/*************************************************************************************/
// function ShowCookiesRedirect()
/*************************************************************************************/
function ShowCookiesRedirect() {
	global $ya_config, $module_name;
	setcookie('RNYA_test1', '1', time() - 604800, '');
	setcookie('RNYA_test2', '2', time() - 604800, '');
	setcookie('RNYA_test3', '3', time() - 604800, '/');
	setcookie('RNYA_test4', '4', time() - 604800, $ya_config['cookiepath']);
	Header('Location: modules.php?name=' . $module_name . '&op=ShowCookies');
}
/*************************************************************************************/
// function ShowCookies()
/*************************************************************************************/
function ShowCookies() {
	global $ya_config, $module_name;
	include_once 'header.php';
	Show_YA_menu();
	OpenTable();
	// $_COOKIE was deprecated by $_COOKIE in PHP 4.1.0
	//$CookieArray	= $_COOKIE;
	//if (!is_array($_COOKIE)) {
	$CookieArray = $_COOKIE;
	//}
	echo '<form action="modules.php?name=' . $module_name . '&amp;op=DeleteCookies" method="post">';
	echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr>';
	echo '<td colspan="2"><img src="modules/' . $module_name . '/images/warning.png" alt="" align="left" width="40" height="40" />';
	echo '<font class="content">' . _YA_DELCOOKIEINFO1 . '</font></td></tr><tr><td width="100%">';
	echo '<table cellspacing="0" cellpadding="5" border="1" align="left"><tr><td colspan="2">';
	echo '<font class="title">' . _YA_CURRENTCOOKIE . '</font></td></tr>';
	echo '<tr><td nowrap="nowrap"><strong>' . _YA_COOKIENAME . '</strong></td><td width="100%"><strong>' . _YA_COOKIEVAL . '</strong></td></tr>';
	if (is_array($CookieArray) && !empty($CookieArray)) {
		while (list($cName, $cValue) = each($CookieArray)) {
			$cName = str_replace(' ', '', $cName);
			if ($cValue == '') $cValue = '(empty)';
			$cMore = substr($cValue, 36, 1);
			if ($cMore != '') $cValue = substr($cValue, 0, 35) . ' ( . . . )';
			echo '<tr><td align="left" nowrap="nowrap">' . $cName . '</td><td width="100%" align="left">' . $cValue . '</td></tr>';
		}
		echo '</table></td><td valign="top"><input type="submit" name="submit" value="' . _YA_COOKIEDELTHESE . '" /></td></tr></table></form>';
	} else {
		echo '<tr><td colspan="2">' . _YA_COOKIENOCUR1 . '</td></tr></table>';
		echo '</td><td valign="top"><input type="submit" name="submit" value="' . _YA_COOKIEDELALL . '" /></td></tr></table></form>';
	}
	CloseTable();
	include_once 'footer.php';
	$CookieArray = '';
}
/*************************************************************************************/
// function DeleteCookies()
/*************************************************************************************/
function DeleteCookies() {
	global $ya_config, $module_name, $prefix, $user, $username, $CookieArray;
	include_once 'header.php';
	Show_YA_menu();
	OpenTable();
	cookiedecode($user);
	if (isset($cookie)) {
		$r_uid = $cookie[0];
		$r_username = $cookie[1];
		$db->sql_query('DELETE FROM ' . $prefix . '_session WHERE uname=\'' . $r_username . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_session');
		echo $r_username;
		echo $r_uid;
		$db->sql_query('DELETE FROM ' . $prefix . '_bbsessions WHERE session_user_id=\'' . $r_uid . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $prefix . '_bbsessions');
	}
	echo $username;
	//$CookieArray	= $_COOKIE;
	//if (!is_array($_COOKIE)) {
	$CookieArray = $_COOKIE;
	//}
	echo '<form action="modules.php?name=' . $module_name . '&amp;op=ShowCookies" method="post">';
	echo '<table width="100%" cellspacing="0" cellpadding="5" border="0"><tr>';
	echo '<td colspan="2"><img src="modules/' . $module_name . '/images/warning.png" alt="" align="left" width="40" height="40" />';
	echo '<font class="content">' . _YA_COOKIEDEL1 . '</font></td></tr><tr><td  width="100%">';
	echo '<table cellspacing="0" cellpadding="5" border="1" align="left"><tr><td colspan="2">';
	echo '<font class="title">' . _YA_CURRENTCOOKIE . '</font></td></tr>';
	echo '<tr><td nowrap="nowrap"><strong>' . _YA_COOKIENAME . '</strong></td><td width="100%"><strong>' . _YA_COOKIESTAT . '</strong></td></tr>';
	if (is_array($CookieArray) && !empty($CookieArray)) {
		while (list($cName, $cValue) = each($CookieArray)) {
			$cName = str_replace(' ', '', $cName);
			// Multiple cookie paths used to expire cookies that are no longer in use as well.
			setcookie($cName, '1', time() - 604800, ''); // Directory only path
			setcookie($cName, '2', time() - 604800, '/'); // Site wide path
			setcookie($cName, '3', time() - 604800, $ya_config['cookiepath']); // Configured path
			echo '<tr><td align="left" nowrap="nowrap">' . $cName . '</td><td width="100%" align="left">' . _YA_COOKIEDEL2 . '</td></tr>';
			unset($cName);
		}
		echo '</table></td><td valign="top"><input type="submit" name="submit" value="' . _YA_COOKIESHOWALL . '" /></td></tr></table></form>';
	} else {
		echo '<tr><td width="100%" colspan="2">' . _YA_COOKIENOCUR2 . '</td></tr></table>';
		echo '</td><td valign="top"><input type="submit" name="submit" value="' . _YA_COOKIESHOWALL . '" /></td></tr></table></form>';
	}
	// menelaos: these lines need some more study: which are useful, which are not
	unset($user);
	unset($cookie);
	$user = '';
	if (isset($_SESSION)) {
		@session_unset();
	}
	if (isset($_SESSION)) {
		@session_destroy();
	}
	if (isset($_COOKIE[session_name()])) unset($_COOKIE[session_name()]);
	// menelaos: these lines need some more study: which are useful, which are not
	CloseTable();
	include_once 'footer.php';
}
?>