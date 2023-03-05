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
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
define('MODULE_FILE', true);
require_once('mainfile.php');
$module = 1;
if (!isset($name)) $name='';
$name = addslashes(check_html(trim($name), 'nohtml')); //Fixes SQL Injection
define('PN_MODULE_NAME', $name);
if(!isset($file)) { $file='index'; }
if(isset($name)) {
	if(preg_match('/http\:\/\//i', $name)) { die('Hi&nbsp;and&nbsp;Bye'); }
	if(preg_match('/http\:\/\//i', $file)) { die('Hi&nbsp;and&nbsp;Bye'); }
	$modstring = strtolower($_SERVER['QUERY_STRING']);
	if(stripos_clone($modstring,'&user=') AND ($name=='Private_Messages' || $name=='Forums' || $name=='Members_List')) header('Location: index.php');
	global $nukeuser, $db, $prefix;
	$nukeuser = base64_decode($user);
	$nukeuser = addslashes($nukeuser);
	$result = $db->sql_query('SELECT * FROM `'.$prefix.'_modules` WHERE `title`=\''.$name.'\'');
	$row = $db->sql_fetchrow($result);
	$mod_active = intval($row['active']);
	$view = intval($row['view']);
	$groups = $row['groups'];
	if(($mod_active == 1) OR (isset($admin) AND is_admin($admin))) {
		if(!isset($mop)) { $mop='modload'; }
		if(!isset($file)) { $file='index'; }
		if(preg_match('/\.\./',$name) || preg_match('/\.\./',$file) || preg_match('/\.\./',$mop)) {
			$pagetitle = '- '._SOCOOL;
			include_once('header.php');
			OpenTable();
			echo '<center><strong>'._SOCOOL.'</strong></center><br />';
			echo '<center>'._GOBACK.'</center>';
			CloseTable();
			include_once('footer.php');
			die();
		} else {
			$ThemeSel = get_theme();
			if(file_exists('themes/'.$ThemeSel.'/modules/'.$name.'/'.$file.'.php')) {
				$modpath = 'themes/'.$ThemeSel.'/';
			} else {
				$modpath = '';
			}
			$modpath .= 'modules/'.$name.'/'.$file.'.php';
			if(file_exists($modpath)) {
				if($view == 0) {
					include_once($modpath);
				} elseif($view == 1 AND ((isset($user) AND (is_user($user) OR is_group($user, $name))) OR (isset($admin) AND is_admin($admin)))) {
					include_once($modpath);
				} elseif($view == 2 AND isset($admin) AND is_admin($admin)) {
					include_once($modpath);
				} elseif($view == 3 AND paid()) {
					include_once($modpath);
				} elseif($view > 3 AND in_groups($groups)) {
					include_once($modpath);
				} else {
					$pagetitle = '- '._RESTRICTEDAREA;
					include_once('header.php');
					OpenTable();
					echo '<center><strong>'._RESTRICTEDAREA.'</strong></center><br />';
					echo '<center>'._GOBACK.'</center>';
					CloseTable();
					include_once('footer.php');
					die();
				}
			} else {
				$pagetitle = '- '._FILENOTFOUND;
				include_once('header.php');
				OpenTable();
				echo '<center><strong>'._FILENOTFOUND.'</strong></center><br />';
				echo '<center>'._GOBACK.'</center>';
				CloseTable();
				include_once('footer.php');
				die ();
			}
		}
	} else {
		$pagetitle = '- '._MODULENOTACTIVE;
		include_once('header.php');
		OpenTable();
		echo '<center>'._MODULENOTACTIVE.'</center><br />';
		echo '<center>'._GOBACK.'</center>';
		CloseTable();
		include_once('footer.php');
		die ();
	}
} else {
	$pagetitle = '- '._MODULENOTFOUND;
	include_once('header.php');
	OpenTable();
	echo '<center>'._MODULENOTFOUND.'</center><br />';
	echo '<center>'._GOBACK.'</center>';
	CloseTable();
	include_once('footer.php');
	die ();
}
if(!function_exists('stripos_clone')) {
	function stripos_clone($haystack, $needle, $offset=0) {
		return strpos(strtoupper($haystack), strtoupper($needle), $offset);
	}
}
?>
