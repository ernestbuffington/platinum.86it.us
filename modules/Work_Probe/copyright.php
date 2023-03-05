<?php

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/************************************************************************/
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
$mod_name = "NSN Work Probe";
$author_email = "";
$author_homepage = "http://www.nukescripts.net";
$author_homepage2 = "http://www.burnwave.com";
$author_name = "<a href='$author_homepage' target='new'>NukeScripts Network</a> & <a href='$author_homepage2' target='new'>Burnwave Ltd.</a>";
$license = "Copyright &copy; 2000-2005 NukeScripts Network & Burnwave Ltd.";
$download_location = "";
$module_version = "";
$release_date = "";
$module_description = "Advanced project bug tracking system.";
$mod_cost = "";

echo "<html>\n";
echo "<head>\n";
echo "<title>$mod_name: Copyright Information</title>\n";
echo "<style type=\"text/css\">\n";
echo "<!--\n";
echo "body{\n";
echo "font-family:verdana,helvetica; font-size:11px;\n";
echo "scrollbar-3dlight-color:#000000;\n";
echo "scrollbar-arrow-color:#e7e7e7;\n";
echo "scrollbar-face-color:#414141;\n";
echo "scrollbar-darkshadow-color:#000000;\n";
echo "scrollbar-highlight-color:#9d9d9d;\n";
echo "scrollbar-shadow-color:#9d9d9d;\n";
echo "scrollbar-track-color:#e7e7e7;\n";
echo "}\n";
echo "-->\n";
echo "</style>\n";
echo "</head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
echo "<center><strong>Module Copyright &copy; Information</strong><br />";
echo "$mod_name module / <a href=\"http://www.techgfx.com\" target=\"_blank\">Platinum Nuke Pro</a></center>\n<hr>\n";
echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $mod_name<br />\n";
if ($module_version != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />\n"; }
if ($release_date != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Release Date:</strong> $release_date<br />\n"; }
if ($mod_cost != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Cost:</strong> $mod_cost<br />\n"; }
if ($license != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>License:</strong> $license<br />\n"; }
if ($author_name != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"; }
if ($author_email != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_email<br />\n"; }
if ($module_description != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br />\n"; }
if ($download_location != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Download:</strong> <a href=\"$download_location\" target=\"new\">Download</a><br />\n"; }
echo "<hr>\n";
echo "<center>[<a href=\"#\" onClick=javascript:self.close()>Close Window</a>]</center>\n";
echo "</body>\n";
echo "</html>";

?>
