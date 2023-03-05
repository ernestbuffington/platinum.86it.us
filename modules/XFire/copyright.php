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

$author_name = "http://www.majorplaying.net";
$author_email = "mp@majorplaying.net";
$author_homepage = "http://majorplaying.net";
$license = "GNU/GPL";
$download_location = "http://www.RaveNuke.com";
$module_version = "2.0.1";
$module_description = "MPG-Xfire is a module that shows your members Xfire profiles, to be used on your site.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

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
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html>\n"
  ."<body bgcolor=\"#F6F6EB\" link=\"#0000ff\" alink=\"#0000ff\" vlink=\"#0000ff\">\n"
  ."<title>$module_name: Copyright Information</title>\n"
  ."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
  ."<center><b>Module Copyright &copy; Information</b><br />"
  ."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br /><br /></center>\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Name:</b> $module_name<br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Version:</b> $module_version<br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Description:</b> $module_description<br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>License:</b> $license<br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Author's Homepage:</b><a href=\"$author_name\" target=\"blank\"> $author_name</a><br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Author's Email:</b><A HREF=\"mailto:$author_email?subject=Feedback/Question for XFire Module\"> $author_email</A><br />\n"
  ."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Download Location:</b><a href=\"$download_location\" target=\"blank\"> $download_location</a><br /><br />\n"
  ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Download This Module</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
  ."</font>\n"
  ."</body>\n"
  ."</html>";
}

show_copyright();

?>
