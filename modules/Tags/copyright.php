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

$author_name = "lgnuke.org";
$author_user_email = "info@lgnuke.org";
$author_homepage = "http://www.lgnuke.org";
$license = "GNU/GPL";
$download_location = "http://www.lgnuke.org";
$module_version = "1.0";
$module_description = "Tags Cloud per Php-Nuke";
$rnauthor_name = "trickedoutnews.com";
$rndownload_location = "http://www.trickedoutnews.com";
function show_copyright() {
    global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description, $rnauthor_name, $rndownload_location;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/i", " ", $module_name);
    echo "<html>\n"
        ."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
        ."<title>$module_name: Copyright Information</title>\n"
        ."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
        ."<center><strong>Module Copyright &copy; Information</strong><br>"
        ."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br><br></center>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>RavenNuke Author's Name:</strong> $rnauthor_name<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_user_email<br><br>\n"
        ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"$rndownload_location\" target=\"new\">RavenNuke Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
        ."</font>\n"
        ."</body>\n"
        ."</html>";
}

show_copyright();

?>