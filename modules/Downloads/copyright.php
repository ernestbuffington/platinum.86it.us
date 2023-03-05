<?php

/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
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



$author_name = "Original 2.1 Version creator : Shawn Archer";
$versionthree = "Scott Partee";
$author_email = "loki@nukeplanet.com";
$author_homepage = "http://www.platinumnukepro.com";
$license = "GNU/GPL";
$download_location = "http://www.platinumnukepro.com";
$module_version = "2.3";
$module_description = "Enhanced Downloads Mod Version 2.3 by <a href=\"http://www.platinumnukepro.com\" target=\"new\" onClick = \"window.close()\">platinumnukepro.com</a>, gives you complete control over your module. Options include: Upload of Files & Images, Description Images (With thumbnail enhancements), Featured Downloads, Enable/Disable Downloads, Mirror Links, Custom Title Images, Custom Table Creation, and tons more. Admin section is totally redone for ease, with help files throughout.  This version was updated and fixed by Loki.  It is only available as a prepackaged mod for Platinum Nuke Pro +";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $versionthree, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $stylesheet;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($versionthree == "") { $versionthree = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/", " ", $module_name);
    echo "<html><head></head>"
	."<body bgcolor=\"#000000\" link=\"#13A3EE\" alink=\"#13A3EE\" vlink=\"#13A3EE\">"
	."<title>Enhanced Downloads V2.3: Copyright Information</title>"
	."<font size=\"2\" color=\"#13A3EE\" face=\"Arial, Verdana, Helvetica\">"
	."<center><strong>Module Copyright &copy; Information</strong><br />"
	."Enhanced Downloads V2.3 for <a href=\"http://www.platinumnukepro.com\" target=\"new\" onClick = \"window.close()\">Platinum Nuke Pro</a><br /><br /></center>"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> Enhanced Downloads Module<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />"
	."<div align=\"justify\"><img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description</div><br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Updated and Fixed by:</strong> $versionthree<br />"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_email<br /><br /><br />"
	."<center>[ <a href=\"$author_homepage\" target=\"new\" onClick = \"window.close()\">Author's HomePage</a> ] - [ <a href=\"$download_location\" target=\"new\" onClick = \"window.close()\">Module's Download</a> ] - [ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>"
	."</font>"
	."</body>"
	."</html>";
}

show_copyright();

?>
