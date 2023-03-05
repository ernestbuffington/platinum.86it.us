<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

 // No alterations are to be made to this file.
 // If you do you are in violation of the license
 // and will be required to remove the script from your site.

global $modtitle;

$module_name = "Universal Module";
$mod_name = "Universal Module";
$author_name = "Barry Caplin";
$author_email = "B.Caplin (at) e-devstudio.com";
$author_homepage = "http://www.e-devstudio.com";
$license = "E-DevStudio Standard License";
$download_location = "http://download.e-devstudio.com/";
$module_version = "2.5 Final";
$release_date = "11 September 2004";
$module_description = "Universal Module for PHP-Nuke 6.5.<br />Orginally just a Cheats System, the idea to turn the system into a universal module came from <a href=mailto:santo@amusica.net>Santo</a>.";
$beta_forum = "http://forums.e-devstudio.com/index.php?act=SF&f=6";
$module_cost = "Free";

function show_copyright() {
    global $beta_forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $module_cost;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($release_date == "") { $release_date = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    if ($mod_name == "") { $mod_name = preg_replace("/_/", " ", $module_name); }
    if ($beta_forum == "") { $beta_forum = "N/A"; }
    echo "<html>\n";
    echo "<head><title>$module_name: Copyright Information</title></head>\n";
    echo "<body bgcolor=\"#FFFFFF\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n";
    echo "<font size=\"2\" face=\"Arial, Helvetica\">\n";
    echo "<center><strong>Module Copyright &copy; Information</strong><br />";
    echo "$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a></center><hr>\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Release Date:</strong> $release_date<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Cost:</strong> $module_cost<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_email<br />\n";
    echo "<img src=\"../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<hr>\n";
    if ($author_homepage != "N/A") { echo "<center>[<a href=\"$author_homepage\" target=\"new\">Author's HomePage</a>]</center>\n"; }
    if ($download_location != "N/A") { echo "<center>[<a href=\"$download_location\" target=\"new\">Module's Download</a>]</center>\n"; }
    if ($beta_forum != "N/A") { echo "<center>[<a href=\"$beta_forum\" target=\"new\">Forum</a>]</center>\n"; }
    echo "<center>[<a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close Window</a>]</center>\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
}

show_copyright();

?>