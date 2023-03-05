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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
$index = 1;

global $currentlang, $db, $prefix;

if ($currentlang) {
	if (file_exists("modules/Video_Stream/lang-module/lang-$currentlang.php")) { 
		include_once("modules/Video_Stream/lang-module/lang-$currentlang.php");
	} else {
		include_once("modules/Video_Stream/lang-module/lang-english.php");
	}
} else {
	include_once("modules/Video_Stream/lang-module/lang-english.php");
}

include_once('modules/Video_Stream/functions.php');
switch($page) {

	case "vidpop":
	include_once('modules/Video_Stream/popup.php');
	break;
	
	case "comment":
	if($commentEDDD == 1) {
		include_once('modules/Video_Stream/comment.php');
	}
	break;
	
	case "friend":
	if($sendED == 1) {
		include_once('modules/Video_Stream/friend.php');
	}
	break;
	
	case "watch":
	include_once('modules/Video_Stream/watch.php');
	break;
	
	case "search":
	include_once('modules/Video_Stream/search.php');
	break;
	
	case "rate":
	if($ratingED == 1) {
		include_once('modules/Video_Stream/rate.php');
	}
	break;
	
	case "vidadd":
	if($submitED == 1) {
		include_once('modules/Video_Stream/add_video.php');
	}
	break;
	
	case "broken":
	if($brokenED == 1) {
		include_once('modules/Video_Stream/broken.php');
	}
	break;
	
	case "send":
	if($sendED == 1) {
		include_once('modules/Video_Stream/send.php');
	}
	break;
	
	case "disclaimer":
	include_once('modules/Video_Stream/disclaimer.php');
	break;
	
	default:
	include_once('modules/Video_Stream/layout.php');
	break;
}
?>