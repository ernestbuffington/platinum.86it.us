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
if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._ACTIVETOPICS.'';
include_once('header.php');
title(_ACTIVETOPICS);
echo '<div class="content">';
OpenTable();

$sql = 'SELECT topicid, topicname, topicimage, topictext FROM '.$prefix.'_topics ORDER BY topictext';
$result = $db->sql_query($sql);
if ($db->sql_numrows($result) > 0) {
    $r_options = '';
    if (isset($cookie[4])) { $r_options .= '&amp;mode='.$cookie[4]; }
    if (isset($cookie[5])) { $r_options .= '&amp;order='.$cookie[5]; }
    if (isset($cookie[6])) { $r_options .= '&amp;thold='.$cookie[6]; }
    echo '<center><p><strong>'._CLICK2LIST.'</strong></p>'
        .'<form action="modules.php?name=Search" method="post">'
        .'<input type="text" name="query" size="30" />&nbsp;&nbsp;'
        .'<input type="submit" value="'._SEARCH.'" />'
        .'</form></center>';
    while ($row = $db->sql_fetchrow($result)) {
        $topicid = intval($row['topicid']);
        $topicname = stripslashes($row['topicname']);
        $topicimage = stripslashes($row['topicimage']);
        $topictext = stripslashes(check_html($row['topictext'], 'nohtml'));
        $ThemeSel = get_theme();
        if (@file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
            $t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
        } else {
            $t_image = $tipath.$topicimage;
        }
        $sql = 'SELECT counter FROM '.$prefix.'_stories WHERE topic=\''.$topicid.'\'';
        $res = $db->sql_query($sql);
        $numrows = $db->sql_numrows($res);
        $reads = 0;
        while ($counting = $db->sql_fetchrow($res)) {
            $reads = $reads+$counting['counter'];
        }

        //The following code has modifications for the bettertopics module!
        OpenTable();
        echo '<table border="0" width="100%" align="center" cellpadding="2">'
            .'<tr><td valign="top"><a href="modules.php?name=News&amp;new_topic='.$topicid.'">'
            .'<img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'" />'
            .'</a></td><td valign="top" width="100%">'
            .'<center><p><span class="title"><a href="modules.php?name=News&amp;new_topic='.$topicid.'">'.$topictext.'</a></span>&nbsp;'
            .'<big><strong>&middot;</strong></big>&nbsp;<strong>'._TOTNEWS.':</strong> '.$numrows.'&nbsp;'
            .'<big><strong>&middot;</strong></big>&nbsp;<strong>'._TOTREADS.':</strong> '.$reads.'</p></center>'
            .'</td></tr>'
            .'</table>';
        echo '<table border="0" width="100%" align="center" cellpadding="2">'
            .'<tr><td valign="top" align="left">'
            .'<p><strong>'._TOPICS_ARTICLES.'</strong></p><p>';

        $sql = 'SELECT sid, catid, title, informant FROM '.$prefix.'_stories WHERE topic=\''.$topicid.'\' ORDER BY sid DESC LIMIT 0,10';
        $result2 = $db->sql_query($sql);
        $num = $db->sql_numrows($result2);
        if ($num != 0) {
            while ($row2 = $db->sql_fetchrow($result2)) {
                $sid = intval($row2['sid']);
                $catid = intval($row2['catid']);
                $title = stripslashes(check_html($row2['title'], 'nohtml'));
                $informant = stripslashes(check_html($row2['informant'], 'nohtml'));
                $row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_stories_cat WHERE catid=\''.$catid.'\''));
                $rtitle = stripslashes(check_html($row3['title'], 'nohtml'));
                if ($catid == 0) {
                    $cat_link = '';
                } else {
                    $cat_link = '<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'"><strong>'.$rtitle.'</strong></a>: ';
                }
                echo '<a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'
                    .'<img src="modules/'.$module_name.'/images/article.gif" border="0" alt="'._TOPICS_READTHISART.'" title="'._TOPICS_READTHISART.'" /></a>'
                    .'<a href="modules.php?name=News&amp;file=print&amp;sid='.$sid.'">'
                    .'<img src="modules/'.$module_name.'/images/print.gif" border="0" alt="'._TOPICS_PRINTERREADY.'" title="'._TOPICS_PRINTERREADY.'" /></a>'
                    .'<a href="modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'">'
                    .'<img src="modules/'.$module_name.'/images/email.gif" border="0" alt="'._TOPICS_EMAILFRIEND.'" title="'._TOPICS_EMAILFRIEND.'" /></a>'
                    .'&nbsp;&nbsp;'.$cat_link.'<a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.$r_options.'">'.$title.'</a> ('.$informant.')<br />';
            }
            if ($num == 10) {
                echo '<big><strong>&middot;</strong></big>&nbsp;<a href="modules.php?name=News&amp;new_topic='.$topicid.'"><strong>'._MORE.' --></strong></a>';
            }
        } else {
            echo '<i>'._NONEWSYET.'</i>';
        }
        echo '</p></td><td width="50%" valign="top">';

        //This code prints out the preview of the most recent article
        if ($num >= 1) {

           $sql2 = 'SELECT sid, catid, title, hometext, time, informant  FROM '.$prefix.'_stories WHERE topic=\''.$topicid.'\' ORDER BY sid DESC LIMIT 0,1';
           $result2 = $db->sql_query($sql2);
           $row2 = $db->sql_fetchrow($result2);
            $s_sid = $row2['sid'];
            $title = $row2['title'];
            $hometext = $row2['hometext'];
            $date = $row2['time'];
           $informant =$row2['informant'];
            echo '<center><p><strong>'._TOPICS_MOSTRECENTART.'</strong></p></center>';
            echo '<p><strong><a href="modules.php?name=News&amp;file=article&amp;sid='.$s_sid.'">'.$title.'</a></strong><br />'._TOPICS_BY.' '
                .'<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a><br />'.$date
                .'</p><div>'.$hometext.'</div>'
                .'<p align="right"><a href="modules.php?name=News&amp;file=article&amp;sid='.$s_sid.'">'._TOPICS_READMORE.'</a></p>';
        }

        echo '</td></tr></table>';
        CloseTable();
    }
}
CloseTable();
echo '</div>';
include_once('footer.php');

?>
