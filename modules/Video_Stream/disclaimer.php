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

if ($_POST['disclaimer'] == _VS_ACCEPT) {
	setcookie("vs_disclaimer", "1", time()+604800);
	$rurl = base64_decode($_GET['rurl']);
	header("Location: modules.php?".$rurl."");
	die();
}
if ($_POST['disclaimer'] == _VS_REJECT) {
	setcookie("vs_disclaimer", "", time()-604800);
	header("Location: modules.php?name=Video_Stream");
	die();
}

include_once('header.php');
vsnavtop();
$tmpl_file = "modules/Video_Stream/disclaimer.html";
$thefile = implode("", file($tmpl_file));
$thefile = addslashes($thefile);
$thefile = "\$r_file=\"".$thefile."\";";
eval($thefile);
OpenTable();
print $r_file;
echo "<form name=\"form1\" method=\"post\" action=\"\">\n";
echo "  &nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"disclaimer\" value=\""._VS_ACCEPT."\">&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"disclaimer\" value=\""._VS_REJECT."\">\n";
echo "</form>";
CloseTable();

//***************************************************************
// IF YOU WANT TO LEGALY REMOVE ANY COPYRIGHT NOTICES PLAY FAIR AND CHECK: http://phpnuke-downloads.com/modules.php?name=Commercial_License
// COPYRIGHT NOTICES ARE GPL SECTION 2(c) COMPLIANT AND CAN'T BE REMOVED WITHOUT PHPNuke-Downloads' AUTHOR WRITTEN AUTHORIZATION
// YOU'RE NOT AUTHORIZED TO CHANGE THE CODE UNTIL YOU ACQUIRE A COMMERCIAL LICENSE
// (http://phpnuke-downloads.com/modules.php?name=Commercial_License)
//***************************************************************
echo "<br />\n";
OpenTable();
echo "HTTP Video Stream Module<br />By <a href=\"http://phpnuke-downloads.com\" title=\"PHP-Nuke\">phpNuke</a>\n";
CloseTable();
// END OF COPYRIGHT

CloseTable();
include_once('footer.php');
?>