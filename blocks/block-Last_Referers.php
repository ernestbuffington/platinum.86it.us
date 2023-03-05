<?php
/************************************************************************/
/* Last referers block for phpNuke portal                               */
/* Copyright (c) 2001 by Jack Kozbial (jack@internetintl.com            */
/* http://www.InternetIntl.com                                          */
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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}
global $prefix, $db, $admin, $admin_file;
$content = '';
$ref = 10; // how many referers in block
$a = 1;
$sql = 'SELECT rid, url FROM '.$prefix.'_referer ORDER BY rid DESC LIMIT 0,'.$ref;
$result = $db->sql_query($sql);
while (list($rid, $url) = $db->sql_fetchrow($result)) {
	$rid = intval($rid);
	$url2 = str_replace('_', ' ', $url);
	if(strlen($url2) > 18) {
		$url2 = substr($url,0,20);
		$url2 .= '..';
	}
	$content .= $a.':&nbsp;<a href="'.$url.'" target="_blank">'.$url2.'</a><br />';
	$a++;
}
if (is_admin($admin)) {
	$sql = 'SELECT * FROM '.$prefix.'_referer';
	$query = $db->sql_query($sql);
	$total = $db->sql_numrows($query);
	$content .= '<br /><center>'.$total.' '._HTTPREFERERS.'<br />[ <a href="'.$admin_file.'.php?op=delreferer">'._DELETE.'</a> ]</center>';
}
?>
