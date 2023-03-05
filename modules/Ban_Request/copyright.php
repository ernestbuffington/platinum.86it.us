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

$module_name = basename(dirname(__FILE__));
$mod_name = "Ban Request Addin";
$author_email = "";
$author_homepage = "http://chiefbutz.rules.it";
$author_name = "<a href=\"$author_homepage\">Chiefbutz's Homepage</a>";
$license = "Copyright &copy; 2000-2004 Chiefbutz";
$download_location = "";
$module_version = "3.0";
$release_date = "March 27 2004";
$module_description = "This module allows people to request a ban on a user/ip. I suggest using NSN Groups so only one group can access it.<br />Modified for multilanguage support by MrFluffy for Platinum Nuke Pro.";
$mod_cost = "Free!";

function show_copyright() {
    global $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($mod_name == "") { $mod_name = preg_replace("/_/i", " ", $module_name); }
    echo "<html>\n";
    echo "<head><title>$mod_name: Copyright Information</title></head>\n";
    echo "<body bgcolor='#FFFFFF' link='#000000' alink='#000000' vlink='#000000'>\n";
    echo "<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
    echo "<td width='100%' align='center'><font size='2' face='Arial, Helvetica'><strong>Module Copyright &copy; Information</strong><br />";
    echo "$mod_name module for <a href='http://phpnuke.org' target='new'>PHP-Nuke</a> / <a href=\"http://www.techgfx.com\" target=\"_blank\">Platinum Nuke Pro</a><br />[<a href='javascript:void(0)' onClick=javascript:self.close()>Close Window</a>]</font></td>\n";
    echo "</tr>\n</table>\n<hr>\n";
    echo "<font size='2' face='Arial, Helvetica'>";
    echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Module's Name:</strong> $mod_name<br />\n";
    if ($module_version != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Module's Version:</strong> $module_version<br />\n"; }
    if ($release_date != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Release Date:</strong> $release_date<br />\n"; }
    if ($mod_cost != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Module's Cost:</strong> $mod_cost<br />\n"; }
    if ($license != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>License:</strong> $license<br />\n"; }
    if ($author_name != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"; }
    if ($author_email != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Author's Email:</strong> $author_email<br />\n"; }
    if ($module_description != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Module's Description:</strong> $module_description<br />\n"; }
    if ($download_location != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<strong>Module's Download:</strong> <a href='$download_location' target='new'>Download</a><br />\n"; }
    echo "<hr>\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
}

show_copyright();

?>