<?php

/********************************************************/
/* Ban Request Addin                                    */
/* By: Chiefbutz (chiefbutz@hotmail.com)                */
/* http://chiefbutz.rules.it                            */
/* Copyright © 2000-2004 by Chiefbutz                   */
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
/*                                                                      */
/* Multilanguage modifications by:                                      */
/*                                                                      */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/************************************************************************/

@require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if ( !defined('MODULE_FILE') ) {
	header("Location: modules.php?name=$module_name");
	die ();
}

$index=1;
if(is_admin($admin)) {
	if(!is_array($admin)) {
		$adm = base64_decode($admin);
		$adm = explode(":", $adm);
		$aname = "$adm[0]";
	} else {
		$aname = "$admin[0]";
	}
}

$aname = substr("$aname", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Ban_Request'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aname'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	// Header
	@include_once("header.php");
	// Show admin header
	OpenTable();
	echo "<p align='center'><strong>"._BR_BANREQ."</strong></p>";
	CloseTable();
	// End Admin header

	// Menu
	OpenTable();
    
	echo "<table width=\"100%\">";
	echo "  <tr align='left'>";
	echo "		<td width='100%'><a href='modules.php?name=".$module_name."&file=view'>"._BR_VIEWBANS."</a></td>";
	echo "  </tr>";
	echo "  <tr align='left'>";
	echo "		<td width='100%'><a href='modules.php?name=".$module_name."&file=appr'>"._BR_APPROVEREQ."</a></td>";
	echo "  </tr>";
	echo "  <tr align='left'>";
	echo "		<td width='100%'><a href='modules.php?name=".$module_name."&file=edit'>"._BR_EDITBANS."</a></td>";
	echo "  </tr>";
	echo "</table>";
	CloseTable();
	// End Menu
	// Footer
	@include_once('footer.php');
} else {
	@include_once("header.php");
	OpenTable();
	echo "<center><strong>"._ERROR."</strong><br /><br />"._BR_NOADMIN." $module_name</center>";
	CloseTable();
	@include_once("footer.php");
}

?>