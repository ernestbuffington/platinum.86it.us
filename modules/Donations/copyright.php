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
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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

$author_name = "Dave Lawrence";
$author_user_email = "thrash@fragnastika.com";
$author_homepage = "http://nuketreasury.sourceforge.net/";
$license = "GNU/GPL";
$download_location = "https://sourceforge.net/project/showfiles.php?group_id=99669";
$module_version = "2.0";
$module_upgrade = "Upgraded From 1.0 by Telli";
$module_upgrade1 = "Additional update by Guardian";
$module_upgrade2 = "2017 Upgrade by SgtMudd";
$module_upgrade_web = "http://codezwiz.com/";
$module_upgrade_web1 = "#http://www.code-authors.com"; 
$module_upgrade_web2 = "http://www.platinumnukepro.com";
$module_description = "Adds PayPal donations and basic financial management to Platinum Nuke Pro";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.
 
function show_copyright() {
    global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description, $module_upgrade_web, $module_upgrade_web1, $module_upgrade_web2, $module_upgrade, $module_upgrade1, $module_upgrade2;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
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
        ."<center><b>Module Copyright &copy; Information</b><br>"
        ."$module_name module for <a href=\"http://platinumnukepro.com\" target=\"new\">Platinum Nuke Pro</a><br><br></center>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Name:</b> $module_name<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Version:</b> $module_version<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module Upgrade:</b> $module_upgrade<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module Upgrade:</b> $module_upgrade1<br>\n"
		."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module Upgrade:</b> $module_upgrade2<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Description:</b> $module_description<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>License:</b> $license<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Original Author's Name:</b> $author_name<br>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Original Author's Email:</b> $author_user_email<br><br>\n"
        ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"$module_upgrade_web\" target=\"new\">Upgraded Version</a> | <a href=\"$module_upgrade_web1\" target=\"new\">Upgraded Version 1.1.1</a> | <a href=\"$module_upgrade_web2\" target=\"new\">PNP Version 2.0</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
        ."</font>\n"
        ."</body>\n"
        ."</html>";
}

show_copyright();

?>