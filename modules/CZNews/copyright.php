<?php
/*
  Copyright (c) 2002-2005 Codezwiz Network, LLC.
  ****************************************************
  A highly modified version of PHP-Nuke 6.5 which is 
  Copyright (c) 2002 by Francisco Burzi
  http://phpnuke.org

  Under the GNU General Public License version 2
*/

$author_name = "Telli";
$author_user_email = "telli@codezwiz.com";
$author_homepage = "http://www.codezwiz.com";
$license = "Standard License";
$download_location = "http://www.codezwiz.com/scripts.html";
$module_version = "2.0.0";
$module_description = "Advanced News Module";


function show_copyright() {
    global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = preg_replace("/_/i", " ", $module_name);
    echo "<html>\n"
        ."<body bgcolor=\"#dedede\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n"
        ."<title>$module_name: Copyright Information</title>\n"
        ."<font size=\"1\" color=\"#000000\" face=\"Verdana, Helvetica\">\n"
        ."<center><strong>Module Copyright &copy; Information</strong><br />"
        ."<br /><br /></center>\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $module_name<br />\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br />\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br />\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>License:</strong> $license<br />\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"
        ."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_user_email<br /><br />\n"
        ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | ";
  if ($download_location != "")  { 
    echo "<a href=\"$download_location\" target=\"new\">Module's Download</a> | ";
  }
    echo "<a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
        ."</font>\n"
        ."</body>\n"
        ."</html>";

}

show_copyright();

?>