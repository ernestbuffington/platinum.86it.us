<?php

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = "NSN Work Board";
$author_email = "";
$author_homepage = "http://www.nukescripts.net";
$author_name = "<a href='$author_homepage' target='new'>NukeScripts Network</a>";
$license = "Copyright &copy; 2000-2005 NukeScripts Network";
$download_location = "";
$module_version = "";
$release_date = "";
$module_description = "Advanced project tracking system.";
$mod_cost = "";
if ($mod_name == "") { $mod_name = preg_replace("/_/i", " ", $module_name); }

echo "<html>\n";
echo "<head>\n";
echo "<title>$mod_name: Copyright Information</title>\n";
echo "<style type=\"text/css\">\n";
echo "<!--\n";
echo "body{\n";
echo "font-family:verdana,helvetica; font-size:11px;\n";
echo "scrollbar-3dlight-color:#000000;\n";
echo "scrollbar-arrow-color:#e7e7e7;\n";
echo "scrollbar-face-color:#414141;\n";
echo "scrollbar-darkshadow-color:#000000;\n";
echo "scrollbar-highlight-color:#9d9d9d;\n";
echo "scrollbar-shadow-color:#9d9d9d;\n";
echo "scrollbar-track-color:#e7e7e7;\n";
echo "}\n";
echo "-->\n";
echo "</style>\n";
echo "</head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
echo "<center><strong>Module Copyright &copy; Information</strong><br>";
echo "$mod_name module</center>\n<hr>\n";
echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Name:</strong> $mod_name<br>\n";
if ($module_version != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Version:</strong> $module_version<br>\n"; }
if ($release_date != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Release Date:</strong> $release_date<br>\n"; }
if ($mod_cost != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Cost:</strong> $mod_cost<br>\n"; }
if ($license != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>License:</strong> $license<br>\n"; }
if ($author_name != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Author's Name:</strong> $author_name<br>\n"; }
if ($author_email != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Author's Email:</strong> $author_email<br>\n"; }
if ($module_description != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Description:</strong> $module_description<br>\n"; }
if ($download_location != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<strong>Module's Download:</strong> <a href=\"$download_location\" target=\"new\">Download</a><br>\n"; }
echo "<hr>\n";
echo "<center>[<a href=\"#\" onClick=javascript:self.close()>Close Window</a>]</center>\n";
echo "</body>\n";
echo "</html>";

?>