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

// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
// NOTE: in $download_location PLEASE give the direct download link to the file!!!

$update_name = "Nuken";
$update_email = "";
$update_homepage = "http://trickedoutnews.com";
$update_download = "http://trickedoutnews.com/modules.php?name=Downloads";
$author_name = "Sudirman Angriawan";
$author_email = "nukecpower@yahoo.com";
$author_homepage = "http://nukec.org";
$license = "GNU/GPL";
$download_location = "http://trickedoutnews.com/modules.php?name=Downloads";
$module_version = "3.7.5p1";
$module_description = "NukeC30 - The Advanced Advertising System for RavenNuke(tm).<br />
NukeC30 Addon Module is addon module built for work on RavenNuke(tm) CMS, the great web portal system.
<br />
NukeC30 is an advertising system that allows website visitors or members to sell something by posting the information about the item that they want to sell.
With the admin sections, you could easily manage all of contents and preferences in NukeC30 Modules even though you are not a PHP programmer.
<br />
NukeC30 3.7.5p1 requires RavenNuke(tm) 2.40 and up";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $update_name, $update_email, $update_homepage, $update_download;
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
	."<center><strong>Module Copyright &copy; Information</strong><br />"
	."$module_name module for <a href=\"http://www.ravenphpscripts.com/\" target=\"new\">RavenNuke(tm)</a><br /><br /></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Original Author's Name:</strong> $author_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Original Author's Email:</strong> $author_email<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Update Author's Name:</strong> $update_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Update Author's Email:</strong> $update_email<br><br>\n"
	."<center>[ <a href=\"$author_homepage\" target=\"new\">Original Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"javascript:void(0)\" onclick=javascript:self.close()>Close</a> ]</center>\n"
	."<center>[ <a href=\"$update_homepage\" target=\"new\">Update HomePage</a> | <a href=\"$update_download\" target=\"new\">Update Download</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>
