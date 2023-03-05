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
global $locale, $oldnum, $storynum, $storyhome, $cookie, $categories, $cat, $prefix, $multilingual, $currentlang, $db, $new_topic, $user_news, $userinfo, $user;
if (!isset($see)) {$see = ''; }
if (!isset($dummy)) { $dummy = ''; }
if (!isset($articlecomm)) { $articlecomm = ''; }
if (!isset($time2)) { $time2 = ''; }
$content = '';
getusrinfo($user);
if ($multilingual == 1) {
    if ($categories == 1) {
        $querylang = 'where catid=\''.intval($cat).'\' AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
    } else {
        $querylang = 'where (alanguage=\''.$currentlang.'\' OR alanguage=\'\')';
        if ($new_topic != 0) {
            $querylang .= ' AND topic=\''.intval($new_topic).'\'';
        }
    }
} else {
    if ($categories == 1) {
        $querylang = 'where catid=\''.intval($cat).'\'';
    } else {
        $querylang = '';
        if ($new_topic != 0) {
            $querylang = 'WHERE topic=\''.intval($new_topic).'\'';
        }
    }
}
if (isset($userinfo['storynum']) AND $user_news == 1) {
    $storynum = $userinfo['storynum'];
} else {
    $storynum = $storyhome;
}
$boxstuff = '<table border="0" width="100%">';
$boxTitle = _PASTARTICLES;
$sql = 'SELECT sid, title, time, comments FROM '.$prefix.'_stories '.$querylang.' ORDER BY time DESC LIMIT '.$storynum.', '.$oldnum;
$result = $db->sql_query($sql);
$vari = 0;
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
while (list($sid, $title, $time, $comments) = $db->sql_fetchrow($result)) {
    $sid = intval($sid);
    $title = stripslashes($title);
    $see = 1;
    setlocale(LC_TIME, $locale);
    preg_match ('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime2);
    $datetime2 = strftime(_DATESTRING2, mktime($datetime2[4],$datetime2[5],$datetime2[6],$datetime2[2],$datetime2[3],$datetime2[1]));
    $datetime2 = ucfirst($datetime2);
    if ($articlecomm == 1) {
        $comments = '('.$comments.')';
    } else {
        $comments = '';
    }
    if($time2==$datetime2) {
        $boxstuff .= '<tr><td valign="top"><strong><big>&middot;</big></strong></td><td> <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.$r_options.'">'.$title.'</a> '.$comments.'</td></tr>';
    } else {
        if(empty($a)) {
            $boxstuff .= '<tr><td colspan="2"><strong>'.$datetime2.'</strong></td></tr><tr><td valign="top"><strong><big>&middot;</big></strong></td><td> <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.$r_options.'">'.$title.'</a> '.$comments.'</td></tr>';
            $time2 = $datetime2;
            $a = 1;
        } else {
            $boxstuff .= '<tr><td colspan="2"><strong>'.$datetime2.'</strong></td></tr><tr><td valign="top"><strong><big>&middot;</big></strong></td><td> <a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.$r_options.'">'.$title.'</a> '.$comments.'</td></tr>';
            $time2 = $datetime2;
        }
    }
    $vari++;
    if ($vari==$oldnum) {
        if (isset($userinfo['storyhome'])) {
            $storynum = $userinfo['storyhome'];
        } else {
            $storynum = $storyhome;
        }
        $min = $oldnum + $storynum;
        $dummy = 1;
    }
}
if ($dummy == 1 AND is_active('Stories_Archive')) {
    $boxstuff .= '</table><br /><a href="modules.php?name=Stories_Archive"><strong>'._OLDERARTICLES.'</strong></a>';
} else {
    $boxstuff .= '</table>';
}
if ($see == 1) {
    $content = $boxstuff;
}
?>
