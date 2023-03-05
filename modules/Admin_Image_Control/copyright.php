<?php

/************************************************************************/
/* Contact Plus V2.2b for Nuke 6.5 - 7.2                                */
/* Copyright (c) 2002 by Shawn Archer                                   */
/* http://www.NukeStyles.com                                            */
/*                                                                      */
/* Modifications and security fixes by prian                            */
/* http://prian.dyndns.org                                              */
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

// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
// NOTE: in $download_location PLEASE give the direct download link to the file!!!

$author_name = "sgtmudd";
$author_email = "sgtmudd@mach-hosting.com";
$author_homepage = "http://www.PlatinumNukePro.com";
$license = "GNU/GPL";
$download_location = "http://www.PlatinumNukePro.com/modules.php?name=Downloads";
$module_version = "1.0";
$module_description = "This is a small module built for Platinum Nuke Pro to allow the site owner to upload and easily edit images to be used throughout the site.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $stylesheet;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/i", " ", $module_name);
    echo "<html><head></head>"
	."<body bgcolor=\"#ffffff\">"
	."<title>$module_name: Copyright Information</title>"
	."<font size=\"2\" color=\"#000000\" face=\"Arial, Verdana, Helvetica\">"
	."<center><strong>Module Copyright &copy; Information</strong><br />"
	."$module_name Module for <a href=\"http://www.platinumnukepro.com\" target=\"_blank\">Platinum Nuke Pro</a><br /><br /></center>"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />"
	."<div align=\"justify\"><img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description</div><br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> <a href=\"mailto:$author_email\">$author_email</a><br /><br /><br />"
	."<center>[ <a href=\"$author_homepage\" target=\"new\" onClick = \"window.close()\">Author's HomePage</a> ] - [ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>"
	."</font>"
	."</body>"
	."</html>";
}

show_copyright();

?>
