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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}
global $cookie, $prefix, $multilingual, $currentlang, $db, $user, $userinfo;
if ($multilingual == 1) {
	$querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
	$querylang = '';
}
$today = getdate();
$day = $today['mday'];
if ($day < 10) {
	$day = '0'.$day;
}
$month = $today['mon'];
if ($month < 10) {
	$month = '0'.$month;
}
$year = $today['year'];
$tdate = $year.'-'.$month.'-'.$day;
$sql = 'SELECT sid, title FROM '.$prefix.'_stories WHERE (time LIKE \'%'.$tdate.'%\') '.$querylang.' ORDER BY counter DESC LIMIT 0,1';
$query = $db->sql_query($sql);
list($sid, $title) = $db->sql_fetchrow($query);
$fsid = intval($sid);
$ftitle = check_html($title, 'nohtml');
$content = '<span class="content">';
if ((!$fsid) AND (!$ftitle)) {
	$content .= _NOBIGSTORY.'</span>';
} else {
	$content .= _BIGSTORY.'<br /><br />';
	getusrinfo($user);
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
	$content .= '<a href="modules.php?name=News&amp;file=article&amp;sid='.$fsid.$r_options.'">'.$ftitle.'</a></span>';
}
?>
