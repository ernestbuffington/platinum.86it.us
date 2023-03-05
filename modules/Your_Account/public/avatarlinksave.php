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
// montego - was going to adjust the code to eliminate wasted SQL calls, but reviewing
// what follows, there isn't even a need for getting the path!
//$resultbc = $db->sql_query('SELECT config_value FROM ' . $prefix . '_bbconfig WHERE config_name = \'avatar_gallery_path\'');
//list($direktori) = $db->sql_fetchrow($resultbc);
if (!preg_match('#^http[s]?:\/\/#i', $avatar)) {
	$avatar = 'http://' . $avatar;
}
// montego - added check for valid avatar extension - simply add additional extensions if you wish to allow
// Note, however, that remote avatars can be dangerous as PHP script can be run even if an extension is valid!
if (!preg_match('/(\.gif|\.png|\.jpg|\.jpeg)$/is', $avatar)) {
	$avatar = '';
}
$db->sql_query('UPDATE ' . $user_prefix . '_users SET user_avatar=\'' . addslashes($avatar) . '\', user_avatar_type=\'2\' WHERE username=\'' . $cookie[1] . '\'');
echo '<p class="content" align="center">' . _YA_AVATARFOR . ' ' . $cookie[1] . ' ' . _YA_SAVED . '<br />';
// montego - given that the above IF forces 'http' to be in the $avatar variable, the following IF statement
// makes no sense.
//if (ereg('(http)', $avatar)) {
	echo _YA_NEWAVATAR . ':<br /><img alt="" src="' . $avatar . '" /><br />';
	echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
//} elseif ($avatar) {
//	echo _YA_NEWAVATAR . ':<br /><img alt="" src="' . $direktori . '/' . $avatar . '" /><br />';
//	echo '[ <a href="modules.php?name=' . $module_name . '&amp;op=edituser">' . _YA_BACKPROFILE . '</a> | <a href="modules.php?name=' . $module_name . '">' . _YA_DONE . '</a> ]';
//}
echo '</p>';
CloseTable();
include_once 'footer.php';
?>