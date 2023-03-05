<?php
/***************************************************************************
 *                                 db.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: db.php,v 1.10.2.3 2005/10/30 15:17:14 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
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
/**
 * @copyright 2011 by RavenNuke(tm)
 * @link http://www.ravennuke.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

if (defined('NUKE_BASE_DIR')) {
	define('DB_PATH', NUKE_BASE_DIR . '/db/');
} else {
	define('DB_PATH', dirname(__FILE__) . '/');
}

switch($dbtype) {
	default:
	case 'MySQLI':
		include_once DB_PATH . 'mysqli.php';
		break;
}

$db = new sql_db($dbhost, $dbuname, $dbpass, $dbname, false);

if ($db->connectionError || $db->dbError || $db->errorConfigTableMissing || $db->dbVersionCompare) {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
		, '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
		, '<html>'
		, '<head>'
		, '<title>Platinum Nuke Pro - PHP CMS Applications.</title>'
		, '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
		, '<style type="text/css">'
		, '/*<![CDATA[*/'
		, 'div.c1 {text-align: center; font-weight: bold; color: red; border: dotted red; border-width: 2px; padding: 2em; border-collapse: collapse;}'
		, 'div.c2 {text-align: center;}'
		, 'p.d1 {font-weight: bold;}'
		, 'p.d2,span.d2 {text-decoration: none; text-align: center; font-weight: bold; color: red;}'
		, '/*]]>*/'
		, '</style>'
		, '</head>'
		, '<body>'
		, '<br /><br />'
		, '<div class="c2">'
		, '<img src="images/logo.gif" alt="MySQL Error" />';

	if ($db->connectionError) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem connecting to the server.</p>'
			, '<div class="c1"><p class="d2">';
		if ($display_errors) {
			echo $db->connectionError , '<br /><br />';
		}
		echo 'Check with the System Administrator for the server status.</p>'
			, '</div>';
	}

	if ($db->dbError) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem connecting to the database.</p>'
			, '<div class="c1">'
			, '<p class="d2">Check with the System Administrator for the server status, or if you are the System Administrator and installing this for the first time,<br />'
			, 'did you remember to create your database first?</p>'
			, '</div>';
	}

	if ($db->errorConfigTableMissing) {
		echo '<p>&nbsp;</p><p class="d1">There seems to be a problem with the System Configuration Table - it\'s missing.</p>'
			, '<div class="c1">'
			, 'If you are the System Administrator and installing this for the first time,<br />did you remember to run the '
			, 'INSTALLATION?'
			, '</div>';
	}

	if ($db->dbVersionCompare) {
		echo $db->dbVersionCompare;
	}

	echo '<p>&nbsp;</p><p class="d1">If you are not the System Administrator, please report this to the Administrator and/or Web Master ASAP.</p>'
		, '<p class="d1">We will be back as soon as possible.</p>'
		, '</div>'
		, '</body></html>';
	exit();
}

?>