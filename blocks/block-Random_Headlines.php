<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $multilingual, $currentlang, $db, $tipath, $user, $cookie, $userinfo;
getusrinfo($user);
// Quake - start
if (!isset($mode) OR empty($mode)) {
    if(isset($userinfo['umode'])) {
        $mode = $userinfo['umode'];
    } else {
        $mode = 'thread';
    }
}
if (!isset($order) OR empty($order)) {
    if(isset($userinfo['uorder'])) {
        $order = $userinfo['uorder'];
    } else {
        $order = 0;
    }
}
if (!isset($thold) OR empty($thold)) {
    if(isset($userinfo['thold'])) {
        $thold = $userinfo['thold'];
    } else {
        $thold = 0;
    }
}
$r_options = '';
$r_options .= '&amp;mode='.$mode;
$r_options .= '&amp;order='.$order;
$r_options .= '&amp;thold='.$thold;
// Quake - end
if ($multilingual == 1) {
    $querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
} else {
    $querylang = '';
}
$sql = 'SELECT * FROM '.$prefix.'_topics';
$query = $db->sql_query($sql);
$numrows = $db->sql_numrows($query);
$topic_array = ''; 
if ($numrows > 1) {
    $sql = 'SELECT topicid FROM '.$prefix.'_topics';
    $result = $db->sql_query($sql);
    while (list($topicid) = $db->sql_fetchrow($result)) {
        $topicid = intval($topicid);
        $topic_array .= $topicid.'-';
    }
    $r_topic = explode('-',$topic_array);
    mt_srand((double)microtime()*1000000);
    $numrows = $numrows-1;
    $topic = mt_rand(0, $numrows);
    $topic = $r_topic[$topic];
} else {
    $topic = 1;
}
$sql2 = 'SELECT topicimage, topictext FROM '.$prefix.'_topics WHERE topicid=\''.$topic.'\'';
$query2 = $db->sql_query($sql2);
list($topicimage, $topictext) = $db->sql_fetchrow($query2);
$content = '<br /><center><a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$tipath.$topicimage.'" border="0" alt="'.$topictext.'" title="'.$topictext.'" /></a><br />[ <a href="modules.php?name=Search&amp;topic='.$topic.'">'.$topictext.'</a> ]</center><br />';
$content .= '<table border="0" width="100%"><tr><td valign="top">';
$sql3 = 'SELECT sid, title FROM '.$prefix.'_stories WHERE topic=\''.$topic.'\' '.$querylang.' ORDER BY sid DESC LIMIT 0,9';
$result3 = $db->sql_query($sql3);
while (list($sid, $title) = $db->sql_fetchrow($result3)) {
    $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.$r_options.'">'.$title.'</a><br />';
}
$content .= '</td></tr></table>';
?>
