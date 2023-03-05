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

include_once('header.php');

if ($multilingual == 1) {
    $queryalang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* top stories */
    $querya1lang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\') AND'; /* top stories */
    $queryslang = 'WHERE slanguage=\''.$currentlang.'\' '; /* top section articles */
    $queryplang = 'WHERE planguage=\''.$currentlang.'\' '; /* top polls */
    $queryrlang = 'WHERE rlanguage=\''.$currentlang.'\' '; /* top reviews */
} else {
    $queryalang = '';
    $querya1lang = 'WHERE';
    $queryslang = '';
    $queryplang = '';
    $queryrlang = '';
}

title(_TOPWELCOME.' '.$sitename.'!');
OpenTable();
echo '<div class="content">';
/* Top 10 read stories */
global $prefix, $db, $top;
$result = $db->sql_query('SELECT sid, title, counter FROM '.$prefix.'_stories '.$queryalang.' ORDER BY counter DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._READSTORIES.'</strong></font><br /><br />';
    $lugar=1;
    while ($row = $db->sql_fetchrow($result)) {
        $sid = intval($row['sid']);
        $title = stripslashes(check_html($row['title'], 'nohtml'));
        $counter = intval($row['counter']);
            if($counter>0) {
                echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ('.$counter.' '._READS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 most voted stories */

$result2 = $db->sql_query('SELECT sid, title, ratings FROM '.$prefix.'_stories '.$querya1lang.' score!=\'0\' ORDER BY ratings DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result2) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._MOSTVOTEDSTORIES.'</strong></font><br /><br />';
    $lugar=1;
    while ($row2 = $db->sql_fetchrow($result2)) {
        $sid = intval($row2['sid']);
        $title = stripslashes(check_html($row2['title'], 'nohtml'));
        $ratings = intval($row2['ratings']);
            if($ratings>0) {
                echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ('.$ratings.' '._LVOTES.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 best rated stories */

$result3 = $db->sql_query('SELECT sid, title, score, ratings FROM '.$prefix.'_stories '.$querya1lang.' score!=\'0\' ORDER BY ratings+score DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result3) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._BESTRATEDSTORIES.'</strong></font><br /><br />';
    $lugar=1;
    while ($row3 = $db->sql_fetchrow($result3)) {
        $sid = intval($row3['sid']);
        $title = stripslashes(check_html($row3['title'], 'nohtml'));
        $score = intval($row3['score']);
        $ratings = intval($row3['ratings']);
            if($score>0) {
            $rate = substr($score / $ratings, 0, 4);
                echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ('.$rate.' '._POINTS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 commented stories */

if ($articlecomm == 1) {
    $result4 = $db->sql_query('SELECT sid, title, comments FROM '.$prefix.'_stories '.$queryalang.' ORDER BY comments DESC LIMIT 0,'.$top);
    if ($db->sql_numrows($result4) > 0) {
        echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
            .'<font class="option"><strong>'.$top.' '._COMMENTEDSTORIES.'</strong></font><br /><br />';
        $lugar=1;
        while ($row4 = $db->sql_fetchrow($result4)) {
            $sid = intval($row4['sid']);
            $title = stripslashes(check_html($row4['title'], 'nohtml'));
            $comments = intval($row4['comments']);
            if($comments>0) {
                echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ('.$comments.' '._COMMENTS.')<br />';
                $lugar++;
            }
        }
        echo '</td></tr></table><br />';
    }
}

/* Top 10 categories */

$result5 = $db->sql_query('SELECT catid, title, counter FROM '.$prefix.'_stories_cat ORDER BY counter DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result5) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._ACTIVECAT.'</strong></font><br /><br />';
    $lugar=1;
    while ($row5 = $db->sql_fetchrow($result5)) {
        $catid = intval($row5['catid']);
        $title = stripslashes(check_html($row5['title'], 'nohtml'));
        $counter = intval($row5['counter']);
        if($counter>0) {
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'">'.$title.'</a> - ('.$counter.' '._HITS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 users submitters */

$result7 = $db->sql_query('SELECT username, counter FROM '.$user_prefix.'_users WHERE counter > \'0\' ORDER BY counter DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result7) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._NEWSSUBMITTERS.'</strong></font><br /><br />';
    $lugar=1;
    while ($row7 = $db->sql_fetchrow($result7)) {
        $uname = stripslashes($row7['username']);
        $counter = intval($row7['counter']);
        if($counter>0) {
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname.'">'.$uname.'</a> - ('.$counter.' '._NEWSSENT.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 Polls */

$result8 = $db->sql_query('select * from '.$prefix.'_poll_desc '.$queryplang.'');
if ($db->sql_numrows($result8)>0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._VOTEDPOLLS.'</strong></font><br /><br />';
    $lugar = 1;
    $result9 = $db->sql_query('SELECT pollID, pollTitle, timeStamp, voters FROM '.$prefix.'_poll_desc '.$queryplang.' order by voters DESC limit 0,'.$top);
    $counter = 0;
    while($row9 = $db->sql_fetchrow($result9)) {
        $resultArray[$counter] = array($row9['pollID'], $row9['pollTitle'], $row9['timeStamp'], $row9['voters']);
        $counter++;
    }
    for ($count = 0; $count < count($resultArray); $count++) {
        $id = $resultArray[$count][0];
        $pollTitle = $resultArray[$count][1];
        $voters = $resultArray[$count][3];
        $sum = '';
        for($i = 0; $i < 12; $i++) {
            $result10 = $db->sql_query('SELECT optionCount FROM '.$prefix.'_poll_data WHERE (pollID=\''.$id.'\') AND (voteID=\''.$i.'\')');
            $row10 = $db->sql_fetchrow($result10);
            $optionCount = $row10['optionCount'];
            $sum = (int)$sum+$optionCount;
        }
        echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Surveys&amp;pollID='.$id.'">'.$pollTitle.'</a> - ('.$sum.' '._LVOTES.')<br />';
        $lugar++;
        $sum = 0;
    }
    echo '</td></tr></table><br />';
}

/* Top 10 authors */

$result11 = $db->sql_query('SELECT aid, counter FROM '.$prefix.'_authors ORDER BY counter DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result11) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._MOSTACTIVEAUTHORS.'</strong></font><br /><br />';
    $lugar=1;
    while ($row11 = $db->sql_fetchrow($result11)) {
        $aid = stripslashes($row11['aid']);
        $counter = intval($row11['counter']);
        if($counter>0) {
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Search&amp;query=&amp;author='.$aid.'">'.$aid.'</a> - ('.$counter.' '._NEWSPUBLISHED.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 reviews */

$result12 = $db->sql_query('SELECT id, title, hits FROM '.$prefix.'_reviews '.$queryrlang.' ORDER BY hits DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result12) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._READREVIEWS.'</strong></font><br /><br />';
    $lugar=1;
    while ($row12 = $db->sql_fetchrow($result12)) {
        $id = intval($row12['id']);
        $title = stripslashes(check_html($row12['title'], 'nohtml'));
        $hits = intval($row12['hits']);
        if($hits>0) {
                //RN0000248: Montego fixed incorrect link variable name
            //echo '<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href="modules.php?name=Reviews&amp;op=showcontent&amp;id=$id">$title</a> - ($hits '._READS.')<br />';
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id='.$id.'">'.$title.'</a> - ('.$hits.' '._READS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table><br />';
}

/* Top 10 downloads */

$result13 = $db->sql_query('SELECT lid, cid, title, hits FROM '.$prefix.'_downloads_downloads ORDER BY hits DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result13) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._DOWNLOADEDFILES.'</strong></font><br /><br />';
    $lugar=1;
    while ($row13 = $db->sql_fetchrow($result13)) {
        $lid = intval($row13['lid']);
        $cid = intval($row13['cid']);
        $title = stripslashes(check_html($row13['title'], 'nohtml'));
        $hits = intval($row13['hits']);
        if($hits>0) {
            $row_res = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_downloads_categories WHERE cid=\''.$cid.'\''));
            $ctitle = stripslashes(check_html($row_res['title'], 'nohtml'));
            $utitle = preg_replace('/ /', '/_/', $title);
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid='.$lid.'&amp;ttitle='.$utitle.'">'.$title.'</a> ('._CATEGORY.': '.$ctitle.') - ('.$hits.' '._LDOWNLOADS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table>';
}

/* Top 10 Pages in Content */

$result14 = $db->sql_query('SELECT pid, title, counter FROM '.$prefix.'_pages WHERE active=\'1\' ORDER BY counter DESC LIMIT 0,'.$top);
if ($db->sql_numrows($result14) > 0) {
    echo '<table border="0" cellpadding="10" width="100%"><tr><td align="left">'
        .'<font class="option"><strong>'.$top.' '._MOSTREADPAGES.'</strong></font><br /><br />';
    $lugar=1;
    while ($row14 = $db->sql_fetchrow($result14)) {
        $pid = intval($row14['pid']);
        $title = stripslashes(check_html($row14['title'], 'nohtml'));
        $counter = intval($row14['counter']);
        if($counter>0) {
            echo '<strong><big>&middot;</big></strong>&nbsp;'.$lugar.': <a href="modules.php?name=Content&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> ('.$counter.' '._READS.')<br />';
            $lugar++;
        }
    }
    echo '</td></tr></table>';
}
echo '</div>';
CloseTable();
include_once('footer.php');

?>
