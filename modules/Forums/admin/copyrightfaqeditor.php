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
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on Platinum Nuke Pro   */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

// To have the Copyright window work in your module just fill the following
// require_onced information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)

$author_name = "Verteron";
$author_homepage = "";
$author_user_email = "verteron@verteron.net";
$porter = "Mighty_Y";
$porters_website = "http://www.anorscorner.com";
$porter_email = "webmaster@mighty-y.nl.eu.org";
$license = "GNU/GPL";
$download_location = "http://www.anorscorner.com/modules.php?name=Downloads";
$module = "Admin FAQ Editor Mod";
$module_version = "0.8.6";
$module_description = "This mod let you edit your FAQpage on your board";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $module, $porter_email, $porters_website, $porter, $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    if ($porter == "") { $porter = "N/A"; }
    if ($porters_website == "") { $porters_website = "N/A"; }
    if ($porter_email == "") { $porter_email = "N/A"; }
    if ($module == "") { $module = "N/A"; }
    echo "<html>\n"
	."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
	."<title>$module: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
	."<center><strong>Module Copyright &copy; Information</strong><br>"
	."$module module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br><br></center>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Homepage:</strong> $author_homepage<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email Address:</strong> $author_user_email<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>BBtoNuke Porter:</strong> $porter<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Porter Email Address:</strong> $porter_email<br>\n"
	."<img src=\"../../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br>\n"
	."<center>[ <a href=\"$porters_website\" target=\"new\">Porter's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>