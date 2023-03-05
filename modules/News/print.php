<?php
/************************************************************************/
/* Tricked Out News 2.4a                                                */ 
/* PHP-Platinum Nuke Pro: Expect to be impressed              COPYRIGHT */
/* Copyright (c) 2011 - 2017 by http://www.havocst.net                  */
/* DocHaVoC   (dochavoc(at)havocst(dot)net)                             */ 
/* This is a heavily modified version of the original Platinum Nuke     */ 
/* news module, to act and look more like a blog.                       */ 
/* Tricked Out News that was created originally for RavenNuke(tm)       */ 
/* by Nuken at http://trickedoutnews.com                                */ 
/* Converted to Platinum Nuke by DocHaVoC http://www.havocst.net        */
/************************************************************************/
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
    global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
    $sid = intval($sid);
    $row = $db->sql_fetchrow($db->sql_query('SELECT title, time, hometext, bodytext, topic, notes FROM '.$prefix.'_stories WHERE sid=\''.$sid.'\''));
    $title = stripslashes(check_html($row['title'], 'nohtml'));
    $time = $row['time'];
    $hometext = stripslashes($row['hometext']);
    $bodytext = stripslashes($row['bodytext']);
    $topic = intval($row['topic']);
    $notes = stripslashes($row['notes']);
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT topictext FROM '.$prefix.'_topics WHERE topicid=\''.$topic.'\''));
    $topictext = stripslashes(check_html($row2['topictext'], 'nohtml'));
    formatTimestamp($time);
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n".' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n"
        .'<html xmlns="http://www.w3.org/1999/xhtml">'."\n"
        .'<head><title>'.$sitename.' - '.$title.'</title>'
        .'<meta http-equiv="Content-Type" content="text/html; charset='._CHARSET.'" />'
        .'<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />'."\n".'</head>'
        .'<body bgcolor="#ffffff" text="#000000">'
        .'<table border="0" align="center"><tr><td>'
        .'<table border="0" width="640" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td>'
        .'<table border="0" width="640" cellpadding="20" cellspacing="1" bgcolor="#ffffff"><tr><td>'
        .'<center>'
        .'<img src="images/'.$site_logo.'" border="0" alt="" /><br /><br />'
        .'<span class="content">'
        .'<strong>'.$title.'</strong></span><br />'
        .'<span class="tiny"><strong>'._PDATE.'</strong> '.$datetime.'<br /><strong>'._PTOPIC.'</strong> '.$topictext.'</span><br /><br />'
        .'</center>'
        .'<div class="content">'
        .$hometext.'<br /><br />'
        .$bodytext.'<br /><br />'
        .$notes.'<br /><br />'
        .'</div>'
        .'</td></tr></table></td></tr></table>'
        .'<br /><br /><center>'
        .'<span class="content">'
        ._COMESFROM.' '.$sitename.'<br />'
        .'<a href="'.$nukeurl.'">'.$nukeurl.'</a><br /><br />'
        ._THEURL.'<br />'
        .'<a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;file=article&amp;sid='.$sid.'">'.$nukeurl.'/modules.php?name='.$module_name.'&amp;file=article&amp;sid='.$sid.'</a>'
        .'</span></center>'
        .'</td></tr></table>'
        .'</body>'
        .'</html>';
    die();
}

PrintPage($sid);

?>