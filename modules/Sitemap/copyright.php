<?php
#########################################################################
# nukeSEO Copyright (c) 2005 Kevin Guske              http://nukeSEO.com
# Meta Tag function developed by Jens Hauge           http://visayas.dk
# Sitemap object approach from mSearch by David Karn  http://webdever.net
# Submit Sitemap from phpSitemapNG by Tobias Kluge    http://enarion.net
# Results originally developed by Curve2 Design       http://curve2.com
#########################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
#########################################################################

$author_name = "Kevin Guske";
$author_user_email = "kguske@nukeseo.com";
$author_homepage = "http://www.nukeseo.com";
$license = "GNU/GPL";
$download_location = "http://www.nukeseo.com/modules.php?name=Downloads";
$module_version = "1.0 BETA";
$module_description = "Sitemap module, part of nukeSEO - search engine optimization for PHP-Nuke<br/>"
	. "Meta Tag function developed by Jens Hauge           http://visayas.dk<br/>"
	. "Sitemap object approach from mSearch by David Karn  http://webdever.net<br/>"
	. "Submit Sitemap from phpSitemapNG by Tobias Kluge    http://enarion.net<br/>"
	. "Results originally developed by Curve2 Design       http://curve2.com<br/>";

# DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
# MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
# FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
# YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
# AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
# YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
#    $module_name = basename(dirname(__FILE__));
#    $module_name = preg_replace("#_#i", " ", $module_name);
    $module_name = "nukeSEO Sitemap";
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
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_user_email<br><br>\n"
        ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
        ."</font>\n"
        ."</body>\n"
        ."</html>";
}

show_copyright();

?>
