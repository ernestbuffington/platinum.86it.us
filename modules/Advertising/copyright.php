<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2006                     */
/*    http://www.pcnuke.com -- http://www.max.pcnuke.com                */
/*    All Rights Reserved || 2003-2006 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/*  Pc-Nuke! Portal Systems are derrived from the following source:     */
/*  php-nuke by Francisco Burzi 2002 - http://phpnuke.org               */
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.max.pcnuke.com/modules.php?name=GNU_GPL                 */
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/
// To have the Copyright window work in your module just fill the 
// following required information and then copy the file "copyright.php" 
// into your module's directory. It's all, as easy as it sounds ;)

$module_name = basename(dirname(__FILE__));
$module_version = "v2.0";
$release_date = "06.10.26";
$license = "GNU/GPL";
$license_link = "http://www.max.pcnuke.com/modules.php?name=GNU_GPL";
$license_description = "";
$author_name = "PCN Systems";
$author_homepage = "http://www.pcnuke.com";
$author_email = "";
$download_location = "http://www.max.pcnuke.com";
$forum = "";
$mod_cost = "";
$author_original = "PCN Systems";
$author_original_homepage = "http://www.pcnuke.com";
$module_description = "Pc-Nuke! Advanced Advertising addon for Nuke type systems.";
$license_help = "";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

    global $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $author_original, $author_original_homepage, $license, $license_link, $license_description, $license_help, $download_location, $module_version, $module_description;
    if ($mod_name == "") { $mod_name = preg_replace("/_/", " ", $module_name); }
    echo "<html>\n";
    echo "<head><title>Copyright Information</title></head>\n";
    echo "<body bgcolor=\"#ffffe8\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n";
    echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\n<tr>\n";
    echo "<td width=\"35%\" align=\"center\"><img src=\"images/powered.gif\" border=\"0\"></td>\n";
    echo "<td width=\"55%\" align=\"center\"><font size=\"2\" face=\"Arial, Helvetica\"><strong>Module Copyright &copy; Information</strong><br />";
    echo "$mod_name Module <br /> for <a href=\"http://www.pcnuke.com\" target=\"new\">Pc-Nuke!</a> and <a href=\"http://www.phpnuke.org\" target=\"new\">PHP-Nuke</a></font></td>\n";
    echo "</tr>\n</table>\n<hr>\n";
    echo "<font size=\"2\" face=\"Arial, Helvetica\">";
    echo "<strong>Module's Name:</strong> $mod_name<br />\n";
    if ($module_version != "") { echo "<strong>Module's Version:</strong> $module_version<br />\n"; }
    if ($release_date != "") { echo "<strong>Release Date:</strong> $release_date<br />\n"; }
    if ($license_link != "") { echo "<strong>License:</strong> <a href=\"$license_link\" target='new'> $license </a><br />\n"; } 
    if ($license_description != "") { echo "<strong>License info is for:</strong> $license_description<br />\n"; }
    if ($mod_cost != "") { echo "<strong>Module's Cost:</strong> $mod_cost<br />\n"; }
    if ($author_name != "") { echo "<strong>Modding Author's:</strong> $author_name<br />\n"; }
    if ($author_email != "") { echo "<strong>Author's Email:</strong> $author_email<br />\n"; }
    if ($author_homepage != "") { echo "<strong>Author's HomePage:</strong> <a href=\"$author_homepage\" target=\"new\">HomePage</a><br />\n"; }
    if ($download_location != "") { echo "<strong>Module's Download:</strong> <a href=\"$download_location\" target=\"new\">Download</a><br />\n"; }
    if ($forum != "") { echo "<strong>Author's  Forum:</strong> <a href=\"$forum\" target=\"new\">Forum</a><br />\n"; }
    if ($author_original_homepage != "") { echo "<strong>Original Author:</strong> <a href=\"$author_original_homepage\" target=\"new\"> $author_original</a><br />\n"; } 
    if ($module_description != "") { echo "<strong>Module's Description:</strong> $module_description<br />\n"; }
    if ($license_help != "") { echo "<strong>License Help:</strong> $license_help</a><br />\n"; } 
    echo "<hr><center>[<a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close Window</a>]<br />\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
?>