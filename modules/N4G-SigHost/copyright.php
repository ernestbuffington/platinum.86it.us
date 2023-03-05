<?php



$author_name = "STALKER";
$author_email = "admin@nuke4gamers.com";
$author_homepage = "http://www.nuke4gamers.com";
$license = "GNU/GPL";
$module_version = "v1";

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $module_version;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html>\n"
	."<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n"
	."<title>$module_name: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#000000\" face=\"Verdana, Helvetica\">\n"
	."<center><b>Module Copyright &copy; Information</b><br>"
	."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\">PHP-Nuke</a><br><br></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Name:</b> $module_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Version:</b> $module_version<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>License:</b> $license<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Author's Name:</b> $author_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Author's Email:</b> $author_email<br><br>\n"
	."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"http://www.nuke4gamers.com/modules.php?name=Downloads&cid=1\" target=\"_Blank\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>