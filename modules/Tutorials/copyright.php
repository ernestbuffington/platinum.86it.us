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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

$author_name = "Mighty_Y - Yannick Reekmans";
$author_email = "";
$author_homepage = "http://www.portedmods.com";
$dev_name = "TechGFX - Graeme Allan";
$dev_email = "";
$dev_homepage = "http://www.techgfx.com";
$module_version = "1.1.2";
$module_description = "Tutorials Module with a lot of features (see for yourself :D )";
function show_copyright() {
    global $author_name, $author_email, $author_homepage,$dev_name, $dev_email, $dev_homepage, $module_version, $module_description;
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/i", " ", $module_name);
    echo "<html>\n"
	."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
	."<title>PMT Tutorials Module: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
	."<center><strong>Module Copyright &copy; Information</strong><br />"
	."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br /><br /></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> PMT Tutorials Module<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's HomePage:</strong> <a href=\"$author_homepage\" target=\"new\">$author_homepage</a><br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Graphics & Ideas:</strong> $dev_name<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>TechGFX's HomePage:</strong> <a href=\"$dev_homepage\" target=\"new\">$dev_homepage</a><br /><br />\n"
        ."<center>[ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>
