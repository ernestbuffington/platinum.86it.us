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
if (is_active('Forums')) {
	$uid = (int)$usrinfo['user_id'];
	// Last 10 Forum Topics
	$result8 = $db->sql_query('select t.topic_id, t.topic_title, f.forum_name, t.forum_id from ' . $prefix . '_bbtopics t, ' . $prefix . '_bbforums f where t.forum_id=f.forum_id and t.topic_poster=\'' . $uid . '\' order by t.topic_time DESC limit 0,10');
	if (($db->sql_numrows($result8) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . $usrinfo['username'] . '\'s ' . _LAST10BBTOPIC . ':</strong><ul>';
		while (list($topic_id, $topic_title, $forum_name, $forum_id) = $db->sql_fetchrow($result8)) {
			echo '<li><a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '">' . $forum_name . '</a> &#187; <a href="modules.php?name=Forums&amp;file=viewtopic&amp;t=' . $topic_id . '">' . $topic_title . '</a></li>';
		}
		echo '</ul>';
		CloseTable();
	}
	// Last 10 Forum Posts
	$result12 = $db->sql_query('select p.post_id, r.post_subject, f.forum_name, p.forum_id from ' . $prefix . '_bbposts p, ' . $prefix . '_bbposts_text r, ' . $prefix . '_bbforums f where p.forum_id=f.forum_id and r.post_id=p.post_id and p.poster_id=\'' . $uid . '\' order by p.post_time DESC limit 0,10');
	if (($db->sql_numrows($result12) > 0)) {
		echo '<br />';
		OpenTable();
		echo '<strong>' . $usrinfo['username'] . '\'s ' . _LAST10BBPOST . ':</strong><ul>';
		while (list($post_id, $post_subject, $forum_name, $forum_id) = $db->sql_fetchrow($result12)) {
			if ($post_subject == '') {
				$post_subject = _NOPOSTSUBJECT;
			}
			echo '<li><a href="modules.php?name=Forums&amp;file=viewforum&amp;f=' . $forum_id . '">' . $forum_name . '</a> &#187; <a href="modules.php?name=Forums&amp;file=viewtopic&amp;p=' . $post_id . '#' . $post_id . '">' . $post_subject . '</a></li>';
		}
		echo '</ul>';
		CloseTable();
	}
}
?>