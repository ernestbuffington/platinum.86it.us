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
global $prefix, $multilingual, $currentlang, $db, $boxTitle, $content, $pollcomm, $user, $cookie, $userinfo;
if ($multilingual == 1) {
	$querylang = 'WHERE planguage=\''.$currentlang.'\' AND artid=\'0\'';
} else {
	$querylang = 'WHERE artid=\'0\'';
}
list($pollID) = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc '.$querylang.' ORDER BY pollID DESC LIMIT 1'));
$pollID = intval($pollID);
if ($pollID == 0 || empty($pollID)) {
	$content = '';
} else {
	$content = '';
	if (!isset($url)) {
		$url = 'modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID;
	}
	$content .= '<form action="modules.php?name=Surveys" method="post">';
	$content .= '<input type="hidden" name="pollID" value="'.$pollID.'" />';
	$content .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
	list($pollTitle, $voters) = $db->sql_fetchrow($db->sql_query('SELECT pollTitle, voters FROM '.$prefix.'_poll_desc WHERE pollID=\''.$pollID.'\''));
	$pollTitle = check_html($pollTitle, 'nohtml');
	$voters = intval($voters);
	$boxTitle = _SURVEY;
	$content .= '<span class="content"><strong>'.$pollTitle.'</strong></span><br /><br />';
	$content .= '<table border="0" width="100%">';
	for($i = 1; $i <= 12; $i++) {
		$sql = 'SELECT pollID, optionText, optionCount, voteID FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'';
		$query = $db->sql_query($sql);
		list($pollID, $optionText, $optionCount, $voteID) = $db->sql_fetchrow($query);
		$pollID = intval($pollID);
		$voteID = intval($voteID);
		$optionCount = intval($optionCount);
		if (!empty($optionText)) {
			$content .= '<tr><td valign="top"><input type="radio" name="voteID" value="'.$i.'" /></td><td width="100%"><span class="content">'.$optionText.'</span></td></tr>';
		}
	}
	$content .= '</table><br /><center><span class="content"><input type="submit" value="'._VOTE.'" /></span><br />';
	if (is_user($user)) {
		cookiedecode($user);
		getusrinfo($user);
	}
	$sum = 0;
	for($i = 0; $i < 12; $i++) {
		$sql = 'SELECT optionCount FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'';
		$query = $db->sql_query($sql);
		list($optionCount) = $db->sql_fetchrow($query);
		$optionCount = intval($optionCount);
		$sum = (int)$sum+$optionCount;
	}
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
	$content .= '<br /><span class="content"><a href="modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID.$r_options.'"><strong>'
		._RESULTS.'</strong></a><br /><a href="modules.php?name=Surveys"><strong>'._POLLS.'</strong></a><br />';
	if ($pollcomm) {
		$sql = 'SELECT * FROM '.$prefix.'_pollcomments WHERE pollID=\''.$pollID.'\'';
		$query = $db->sql_query($sql);
		$numcom = $db->sql_numrows($query);
		$content .= '<br />'._VOTES.': <strong>'.intval($sum).'</strong> <br /> '._PCOMMENTS.' <strong>'.intval($numcom).'</strong>';
	} else {
		$content .= '<br />'._VOTES.' <strong>'.intval($sum).'</strong>';
	}
	$content .= '</span></center></form>';
}
?>
