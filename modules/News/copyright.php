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
// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
/************************raven************************************************/

$author_name = 'Nuken';
$author_user_email = '';
$author_homepage = 'http://trickedoutnews.com';
$license = 'GNU/GPL';
$download_location = 'http://trickedoutnews.com';
$module_version = '2.5a';
$module_description = 'This is a mod of the original Platinum Nuke news module so as to act and look more like a blog';
$pnauthor_name = 'DocHaVoC';
$pnauthor_user_email = '';
$pnauthor_homepage = 'http://www.havocst.net';
$pndownload_location = 'http://www.havocst.net';
$pnmodule_description = 'This is a heavily modified version of Tricked Out News2.4 that was created originally for RavenNuke(tm) by Nuken at http://trickedoutnews.com and has been converted to Platinum Nuke using the original Platinum Nuke news module, to act and look more like a blog.';

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
	global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $pnauthor_name, $pnauthor_email, $pnauthor_homepage, $pndownload_location, $pnmodule_version, $pnmodule_description;
	if ($author_name == '') {
		$author_name = 'N/A';
	}
	if ($author_email == '') {
		$author_email = 'N/A';
	}
	if ($author_homepage == '') {
		$author_homepage = 'N/A';
	}
	if ($license == '') {
		$license = 'N/A';
	}
	if ($download_location == '') {
		$download_location = 'N/A';
	}
	if ($module_version == '') {
		$module_version = 'N/A';
	}
	if ($module_description == '') {
		$module_description = 'N/A';
	}
	if ($pnauthor_name == '') {
		$pnauthor_name = 'N/A';
	}
	if ($pnauthor_email == '') {
		$pnauthor_email = 'N/A';
	}
	if ($pnauthor_homepage == '') {
		$pnauthor_homepage = 'N/A';
	}
	if ($pndownload_location == '') {
		$pndownload_location = 'N/A';
	}
	if ($pnmodule_description == '') {
		$pnmodule_description = 'N/A';
	}
	$module_name = 'Tricked Out News';
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
		. 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>'
		. '<html xmlns="http://www.w3.org/1999/xhtml">'
		. '<head><title>' . $module_name . ': Copyright Information</title></head>'
		. '<body bgcolor="#F6F6EB" link="#363636" alink="#363636" vlink="#363636">'
		. '<center>'
		. '<font size="2" color="#363636" face="Verdana, Helvetica">'
		. '<strong>Module Copyright &copy; Information</strong><br />'
		. $module_name . ' for <a href="http://phpnuke.org" target="_blank">Platinum Nuke Pro</a><br />'
		. ' Converted from Tricked Out News for RavenNuke(tm) 2.30.xx<br /><br />'
		. '</font>'
		. '</center>'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Module\'s Name:</strong> ' . $module_name . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Module\'s Version:</strong> ' . $module_version . '<br />'
//		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Module\'s Description:</strong> ' . $module_description . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>License:</strong> ' . $license . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Orginal Author\'s Name:</strong> ' . $author_name . '<br />'
//		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Author\'s Email:</strong> ' . $author_email . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Platinum Nuke Author\'s Name:</strong> ' . $pnauthor_name . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Platinum Nuke Author\'s Email:</strong> ' . $pnauthor_email . '<br />'
		. '<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<strong>Module\'s Description:</strong> ' . $pnmodule_description . '<br /><br />'		
		. '<center>'
		. '<font size="2" color="#363636" face="Verdana, Helvetica">'
		. ' <a href="' . $pnauthor_homepage . '" target="_blank">Platinum Nuke Author\'s HomePage</a> | '
		.'<a href="'.$pndownload_location.'" target="_blank">Platinum Nuke Module\'s Download</a><br /> '
		. ' <a href="' . $author_homepage . '" target="_blank">TON Author\'s HomePage</a> | '		
		.'<a href="'.$download_location.'" target="_blank">RavenNuke Module\'s Download</a><br /> '
	        . '<a href="javascript:void(0)" onClick=javascript:self.close()>Close</a> '
		. '</font>'
		. '</center>'
		. '</body>'
		. '</html>';
}
show_copyright();
?>
