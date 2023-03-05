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
	header('Location: ../../../../index.php');
	die();
}
if (is_active('Downloads')) {
	if (@file_exists('includes/nsngd_func.php')) {
		// Last 10 Download Links Approved for NSN GR Downloads
		$result9 = $db->sql_query('SELECT lid, title, date FROM ' . $prefix . '_nsngd_downloads where submitter=\'' . addslashes($usrinfo['username']) . '\' order by date DESC limit 0,10');
		if (($db->sql_numrows($result9) > 0)) {
			echo '<br />';
			OpenTable();
			echo '<strong>' . $usrinfo['username'] . '\'s ' . _LAST10DOWNLOAD . ':</strong><ul>';
			while (list($lid, $title, $date) = $db->sql_fetchrow($result9)) {
				echo '<li><a href="modules.php?name=Downloads&amp;op=getit&amp;lid=' . $lid . '">' . $title . '</a> (' . $lid . ') - ' . $date . '</li>';
			}
			echo '</ul>';
			CloseTable();
		}
	} else {
		// Last 10 Download Links Approved
		$result9 = $db->sql_query('SELECT lid, title FROM ' . $prefix . '_downloads_downloads where submitter=\'' . addslashes($usrinfo['username']) . '\' order by date DESC limit 0,10');
		if (($db->sql_numrows($result9) > 0)) {
			echo '<br />';
			OpenTable();
			echo '<strong>' . $usrinfo['username'] . '\'s ' . _LAST10DOWNLOAD . ':</strong><ul>';
			while (list($lid, $title) = $db->sql_fetchrow($result9)) {
				echo '<li><a href="modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=' . $lid . '">' . $title . '</a></li>';
			}
			echo '</ul>';
			CloseTable();
		}
	}
}
?>