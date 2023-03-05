<?php

/********************************************************/
/* PHP-Nuke Tools v4.00 RC 1                            */
/* By: Disipal Network (http://disipal.net)	        */
/* http://www.disipal.net                               */
/* Copyright © 2003-2009 by Disipal Network             */
/********************************************************/

$author_name = "Disipal";
$author_email = "webmaster@disipal.net";
$author_homepage = "http://www.disipal.net";
$license = "Copyright © 2003 - 2009 Disipal Network";
$download_location = "http://www.disipal.net/";
$module_version = "V 4.00 RC1";

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/i", " ", $module_name);
    echo "<html>\n"
	."<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n"
	."<title>$module_name: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#000000\" face=\"Verdana, Helvetica\">\n"
	."<center><strong>Module Copyright &copy; Information</strong><br>"
	."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br><br></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"
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