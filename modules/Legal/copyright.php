<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
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

/**
 * RavenNuke(tm) Legal Module
 *
 * The Legal module from DaDaNuke was re-written to allow for additional documents
 * to be added as well as different translations for each document (i.e., multilingual).
 * Original module copyrights are still retained below.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/************************************************************************/
/* Legal Module V1 for PHP-Nuke                                         */
/* Copyright (c) 2006 by DaDaNuke                                       */
/* http://www.dadanuke.org                                              */
/************************************************************************/

$author_name = 'RavenNuke(tm)';
$license = 'GNU/GPL';
$author_homepage = 'http://ravenphpscripts.com';
$module_name = 'Legal Documents';
$module_version = '1.0.0';
$module_description = 'Legal Documents was completely re-coded by montego'
	. ' for the RavenNuke(tm) system to allow for any number of documents'
	. ' to be added as well as translatable without having to use language'
	. ' definitions.';

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
	global $author_name, $author_email, $author_homepage, $license, $download_location, $module_name, $module_version, $module_description;
	if ($author_name == '') { $author_name = 'N/A'; }
	if ($author_email == '') { $author_email = 'N/A'; }
	if ($author_homepage == '') { $author_homepage = 'N/A'; }
	if ($license == '') { $license = 'N/A'; }
	if ($download_location == '') { $download_location = 'N/A'; }
	if ($module_version == '') { $module_version = 'N/A'; }
	if ($module_description == '') { $module_description = 'N/A'; }
	echo '<html>'
		.'<body bgcolor="#FFFFFF" link="#363636" alink="#363636" vlink="#363636">'
		.'<title>'.$module_name.': Copyright Information</title>'
		.'<font size="2" color="#363636" face="Verdana, Helvetica">'
		.'<center><strong>Module Copyright &copy; Information</strong><br />'
		.$module_name.' Module for <a href="http://ravenphpscripts.com" target="new">RavenNuke(tm)</a><br /><br /></center>'
		.'<img src="../../images/arrow.gif" border="0">&nbsp;<strong>Module&#39;s Name:</strong> '.$module_name.'<br />'
		.'<img src="../../images/arrow.gif" border="0">&nbsp;<strong>Module&#39;s Version:</strong> '.$module_version.'<br />'
		.'<img src="../../images/arrow.gif" border="0">&nbsp;<strong>Module&#39;s Description:</strong> '.$module_description.'<br />'
		.'<img src="../../images/arrow.gif" border="0">&nbsp;<strong>License:</strong> '.$license.'<br />'
		.'<img src="../../images/arrow.gif" border="0">&nbsp;<strong>Author&#39;s Name:</strong> '.$author_name.'<br /><br />'
		.'<center>[ <a href="'.$author_homepage.'" target="new">Author&#39;s HomePage</a> | <a href="javascript:void(0)" onclick=javascript:self.close()>Close</a> ]</center>'
		.'</font>'
		.'</body>'
		.'</html>';
}

show_copyright();

?>