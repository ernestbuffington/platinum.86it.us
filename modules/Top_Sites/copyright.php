<?php



/************************************************************************/

/* PHP-NUKE: Web Portal System                                          */

/* ===========================                                          */

/*                                                                      */

/* Copyright (c) 2002 by Francisco Burzi                                */

/* http://phpnuke.org                                                   */

/*                                                                      */

/* This program is free software. You can redistribute it and/or modify */

/* it under the terms of the GNU General Public License as published by */

/* the Free Software Foundation; either version 2 of the License.       */

/************************************************************************/

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



$author_name = "Sid";

$author_email = "webmaster@xanys.com";

$author_homepage = "http://nuke.xanys.com";

$license = "GNU/GPL";

$download_location = "http://nuke.xanys.com/modules.php?name=Downloads";

$module_version = "V1.4";

$module_description = "Top sites system to manage list of sites.This module is based on Web_Links modules made by Francisco Burzi ";



function show_copyright() {

    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;

    if ($author_name == "") { $author_name = "N/A"; }

    if ($author_email == "") { $author_email = "N/A"; }

    if ($author_homepage == "") { $author_homepage = "N/A"; }

    if ($license == "") { $license = "N/A"; }

    if ($download_location == "") { $download_location = "N/A"; }

    if ($module_version == "") { $module_version = "N/A"; }

    if ($module_description == "") { $module_description = "N/A"; }

    $module_name = basename(dirname(__FILE__));

    $module_name = preg_replace("#_#i", " ", $module_name);

    echo "<html>\n"

	."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"

	."<title>$module_name: Copyright Information</title>\n"

	."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"

	."<center><strong>Module Copyright &copy; Information</strong><br>"

	."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a> / <a href=\"http://www.techgfx.com\" target=\"_blank\">Platinum Nuke Pro</a><br><br></center>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br>\n"

	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_email<br><br>\n"

	."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"

	."</font>\n"

	."</body>\n"

	."</html>";

}



show_copyright();



?>