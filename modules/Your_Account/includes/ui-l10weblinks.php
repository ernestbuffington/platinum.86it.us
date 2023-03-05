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
if (is_active('Web_Links')) {
	// Last 10 Weblinks Approved
	$result10 = $db->sql_query('SELECT lid, title, cid FROM ' . $prefix . '_links_links where submitter=\'' . addslashes($usrinfo['username']) . '\' order by date DESC limit 0,10');
	if (($db->sql_numrows($result10) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . $usrinfo['username'] . '\'s ' . _LAST10WEBLINK . ':</strong><ul>';
		while (list($lid, $title, $cid) = $db->sql_fetchrow($result10)) {
			echo '<li><a href="modules.php?op=modload&amp;name=Web_Links&amp;file=index&amp;l_op=viewlink&amp;cid=' . $cid . '">' . $title . '</a></li>';
		}
		echo '</ul>';
		CloseTable();
	}
}
?>