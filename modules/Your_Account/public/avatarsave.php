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
include_once 'header.php';
title(_YA_AVATARSUCCESS);
OpenTable();
nav();
CloseTable();
echo '<br />';
OpenTable();
// montego - adjusted code to eliminate wasted SQL calls
$resultbc = $db->sql_query('SELECT config_value FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_gallery_path\'');
list($direktori) = $db->sql_fetchrow($resultbc);
// montego - added security checks to user provided fields
$category = check_html($category,'nohtml');
$avatar = check_html($avatar, 'nohtml');
if (preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $avatar) && !preg_match('/[.]/', $category) && file_exists('modules/Forums/images/avatars/' . $category . '/' . $avatar)) {
	$newavatar = $category . '/' . $avatar;
	$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_avatar=\'' . $newavatar . '\', user_avatar_type=\'3\' WHERE username=\'' . $cookie[1] . '\'');
	echo '<p class="content" align="center">' . _YA_AVATARFOR . ' ' . $cookie[1] . ' ' . _YA_SAVED . '<br />';
	if (preg_match('/(http)/', $newavatar)) {
		echo _YA_NEWAVATAR . ':<br /><br /><img alt="" src="' . $newavatar . '" /><br /><br />';
		echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
	} elseif ($newavatar) {
		echo _YA_NEWAVATAR . ':<br /><br /><img alt="" src="' . $direktori . '/' . $newavatar . '" /><br /><br />';
		echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
	}
} else {
	echo '<center>' . _AVATAR_SAVE_ERROR . ' ' ._AVATAR_FORMAT . '<br />' ._GOBACK . '</center>';
}
echo '</p>';
CloseTable();
include_once 'footer.php';
?>