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
$get_id = intval($_GET['id']);
$check_num = check_html($_GET['check_num'], 'nohtml');
$newmail = check_html($_GET['mail'], 'nohtml');
getusrinfo($user);
include_once 'header.php';
title(_CHANGEMAILTITLE);
opentable();
ya_mailCheck($newmail);
list($get_username, $tuemail) = $db->sql_fetchrow($db->sql_query('SELECT username, user_email FROM ' . $user_prefix . '_users WHERE user_id = \'' . $get_id . '\''));
cookiedecode($user);
getusrinfo($user);
$datekey = date('F Y');
$check_num2 = substr(md5(hexdec($datekey) * hexdec($userinfo[user_password]) * hexdec($sitekey) * hexdec($newmail) * hexdec($tuemail)) , 2, 10);
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	if ($stop == '') {
		if ((strtolower($userinfo['username']) == strtolower($get_username)) AND ($check_num2 == $check_num)) {
			$result = $db->sql_query('UPDATE ' . $user_prefix . '_users SET user_email=\'' . addslashes($newmail) . '\' WHERE user_id=\'' . $get_id . '\'');
			if ($result) echo _CHANGEMAILOK;
			else echo _CHANGEMAILNOT;
		} else {
			echo _CHANGEMAILNOT;
		}
	} else {
		echo $stop;
	}
} else echo _CHANGEMAILNOTUSER;
closetable();
include_once 'footer.php';
?>