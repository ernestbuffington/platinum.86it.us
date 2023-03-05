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
/* About Us v1.0 by sgtmudd (sgtmudd@mach-hosting.com)                         */
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/
if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

// Set alignment - Avalable settings are: left | center | right
$align = 'center';
// END alignment

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once("header.php");
define('INDEX_FILE', true);

// DB call to get About Us info from database
	$sql_au = "SELECT * FROM ".$prefix."_about_us LIMIT 1";
	if (!$sql_au) { die('Could not query:' . mysql_error());
	}
	$result_au = $db->sql_query($sql_au);
	$num = $db->sql_numrows($result_au);
		while($row_au = $db->sql_fetchrow($result_au)){
		$about_data = $row_au[about_data];
		}

OpenTable();
	echo"<center><h1>"._AU_ABOUTUS."</h1></center><hr>";
	echo "<div align=$align>".$about_data."</div>";
	echo "<hr>";
CloseTable();
include_once("footer.php");

?>