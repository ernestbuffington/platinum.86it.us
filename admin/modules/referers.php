<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */ 
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

/*********************************************************/
/* Referer Functions to know who links us                */
/*********************************************************/

function hreferer() {
    global $bgcolor2, $prefix, $db, $admin_file;
    include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=hreferer'>Referrers Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><strong>" . _HTTPREFERERS . "</strong></font></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>" . _WHOLINKS . "</strong></center><br /><br />"
	."<table border=\"0\" width=\"100%\">";
    $result = $db->sql_query("SELECT rid, url from " . $prefix . "_referer");
    while ($row = $db->sql_fetchrow($result)) {
	$rid = intval($row['rid']);
	$url = $row['url'];
	echo "<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">$rid</td>"
        
	    ."<td bgcolor=\"$bgcolor2\"><font class=\"content\"><a href=\"$url\" target=\"_blank\">$url</a></td></tr>";
    }
    echo "</table>"
	."<form action=\"".$admin_file.".php\" method=\"post\">"
	."<input type=\"hidden\" name=\"op\" value=\"delreferer\">"
	."<center><input type=\"submit\" value=\"" . _DELETEREFERERS . "\"></center>";
    CloseTable();
    include_once("footer.php");
}

function delreferer() {
    global $prefix, $db, $admin_file;
    $db->sql_query("TRUNCATE TABLE ".$prefix."_referer");
    Header("Location: ".$admin_file.".php?op=hreferer");
}

switch($op) {

    case "hreferer":
    hreferer();
    break;

    case "delreferer":
    delreferer();
    break;

}

} else {
    echo "Access Denied";
}
?>

