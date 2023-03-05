<?php

/********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net)      */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$module_name = basename(dirname(__FILE__));
$mod_name = "NSN Banner Ads";
$author_email = "";
$author_homepage = "http://www.nukescripts.net";
$author_name = "<a href=\"$author_homepage\" target=\"new\">NukeScripts Network</a>";
$license = "Copyright &copy; 2000-2005 NukeScripts Network";
$download_location = "";
$module_version = "";
$release_date = "";
$module_description = "Enhanced Banner Management";
$mod_cost = "";
if ($mod_name == "") { $mod_name = preg_replace("/_/i", " ", $module_name); }

echo "<html>\n";
echo "<head>\n";
echo "<title>$mod_name: Copyright Information</title>\n";
echo "<style type=\"text/css\">\n";
echo "<!--\n";
echo "body{\n";
echo "FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;\n";
echo "SCROLLBAR-3DLIGHT-COLOR:#000000;\n";
echo "SCROLLBAR-ARROW-COLOR:#e7e7e7;\n";
echo "SCROLLBAR-FACE-COLOR:#414141;\n";
echo "SCROLLBAR-DARKSHADOW-COLOR:#000000;\n";
echo "SCROLLBAR-HIGHLIGHT-COLOR:#9d9d9d;\n";
echo "SCROLLBAR-SHADOW-COLOR:#9d9d9d;\n";
echo "SCROLLBAR-TRACK-COLOR:#e7e7e7;\n";
echo "}\n";
echo "-->\n";
echo "</style>\n";
echo "</head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
echo "<center><b>Module Copyright &copy; Information</b><br>";
echo "$mod_name module</center>\n<hr>\n";
echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Module's Name:</b> $mod_name<br>\n";
if ($module_version != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Module's Version:</b> $module_version<br>\n"; }
if ($release_date != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Release Date:</b> $release_date<br>\n"; }
if ($mod_cost != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Module's Cost:</b> $mod_cost<br>\n"; }
if ($license != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>License:</b> $license<br>\n"; }
if ($author_name != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Author's Name:</b> $author_name<br>\n"; }
if ($author_email != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Author's Email:</b> $author_email<br>\n"; }
if ($module_description != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Module's Description:</b> $module_description<br>\n"; }
if ($download_location != "") { echo "<img src=\"images/arrow.png\" border=\"0\">&nbsp;<b>Module's Download:</b> <a href=\"$download_location\" target=\"new\">Download</a><br>\n"; }
echo "<hr>\n";
echo "<center>[<a href=\"#\" onClick=javascript:self.close()>Close Window</a>]</center>\n";
echo "</body>\n";
echo "</html>";

?>