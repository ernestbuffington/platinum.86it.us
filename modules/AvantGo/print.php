<?php

/************************************************************************/

/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/*                                                                      */
/* W3C Compliant Fixes by ViRuS - (virus@wildghosts.net)                */
/*                                                                      */
/************************************************************************/

if ( !defined('MODULE_FILE') )
{
	die('You can\'t access this file directly...');
}
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if(!isset($sid)) {
    exit();
}

function PrintPage($sid) {
    global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $Default_Theme;
if (file_exists('themes/'."$Default_Theme".'/images/logo.jpg')) {
$avantgo_logo = 'themes/'."$Default_Theme".'/images/logo.jpg';
} elseif (file_exists('images/'."$site_logo")) {
$avantgo_logo = 'images/'."$site_logo";
} elseif (file_exists('images/logo.gif')) {
$avantgo_logo = 'images/logo.gif';
} else {
$avantgo_logo = '';
}
    $sid = intval(trim($sid));
    $row = $db->sql_fetchrow($db->sql_query('SELECT title, time, hometext, bodytext, topic, notes FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\''));
    $title = stripslashes($row['title']);
    $time = $row['time'];
    $hometext = stripslashes($row['hometext']);
    $bodytext = stripslashes($row['bodytext']);
    $topic = intval($row['topic']);
    $notes = stripslashes($row['notes']);
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT topictext FROM '.$prefix.'_topics WHERE topicid=\''.$topic.'\''));
    $topictext = stripslashes($row2['topictext']);
    formatTimestamp($time);
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n".' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
    echo '
    <head><title>'."$sitename - $title".'</title></head>
    <body bgcolor="#ffffff" text="#000000">
    <table border="0" align="center"><tr><td>
    <table border="0" width="640" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td>
    <table border="0" width="640" cellpadding="20" cellspacing="1" bgcolor="#ffffff"><tr><td>
    <center>
    <img src="'."$avantgo_logo".'" border="0" alt="" /><br /><br />
    <font class="content">
    <strong>'."$title".'</strong></font><br />
    <font class=tiny><strong>'._PDATE.'</strong> '."$datetime".'<br /><strong>'._PTOPIC.'</strong> '."$topictext".'</font><br /><br />
    </center>
    <font class="content">
    '."$hometext".'<br /><br />
    '."$bodytext".'<br /><br />
    '."$notes".'<br /><br />
    </font>
    </td></tr></table></td></tr></table>
    <br /><br /><center>
    <font class="content">
    '._COMESFROM." $sitename".'<br />
    <a href="'."$nukeurl".'">'."$nukeurl".'</a><br /><br />
    '._THEURL.'<br />
    <a href="'."$nukeurl".'/modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'."$nukeurl".'/modules.php?name=News&amp;file=article&amp;sid='.$sid.'</a>
    </font></center>
    </td></tr></table>
    </body>
    </html>
    ';
}

PrintPage($sid);

?>
