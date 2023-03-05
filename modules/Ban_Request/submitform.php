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

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

// junk
@require_once("mainfile.php");
$index = 1;
$uname = $_POST['uname'];
$why = $_POST['reason'];
$staffn = $_POST['staffname'];
// Content

@include_once("header.php");
OpenTable();

echo "<p align=\"center\"><font size=\"6\"><u><strong>"._BR_THANKS."</strong></u></font></p>";

CloseTable();
OpenTable();

echo "<p align=\"left\">"._BR_THANKYOU."</p>";
echo "<p>"._BR_INFOSUB.":</p>";

$date1 = date('F jS Y');
$date2 = date('H:i A');
$date = date('F jS Y, H:i');

echo ''._BR_SUBON.' '.$date1.' at '.$date2.'.<br />';
echo ''._BR_PERSON.': '.$uname.'<br />';
echo ''._BR_REASONFOR.':<br />'.$why.'<br />';
echo ''._BR_YOURNAME.': '.$staffn.'.';
$db->sql_query("INSERT INTO ".$prefix."_banreq ( id , user_name , reason , active ) VALUES('', '".$uname."', '".$why."', 'No')");
CloseTable();
@include_once("footer.php");

?>