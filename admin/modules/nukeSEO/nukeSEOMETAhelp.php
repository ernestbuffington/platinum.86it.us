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

if(!defined('ADMIN_FILE')) { header("Location: ../../../index.php");  die(); }

require_once("mainfile.php");
global $admin_file, $currentlang;
if (file_exists("admin/language/nukeSEO/lang-$currentlang.php")) {
	include_once("admin/language/nukeSEO/lang-$currentlang.php");
} else {
	include_once("admin/language/nukeSEO/lang-english.php");
}

  echo "<html>\n"
  ."<head>\n"
  ."<title>$sitename - META tags"._HELP."</title>\n";
  include_once("includes/meta.php");
  include_once("includes/javascript.php");
  echo "</head>\n"
  
  ."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
  ."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n";
  echo "<div align=\"right\"><a href=\"javascript:void(0)\" onClick=javascript:self.close()>"._CLOSE."</a></div>\n";
  echo "<center><a href=\"$nukeurl\"><img src=\"images/logo.gif\" alt=\"$sitename\" title=\"$sitename\" border=\"0\"></a></center><br>";
  echo "<center><h4>$module_name - "._HELP."</h4><br></center>";
  if (file_exists("admin/language/nukeSEO/"._HELPFILE))  
  {
	  include_once("admin/language/nukeSEO/"._HELPFILE);
  } else {
    echo "could not open HelpFile: admin/language/nukeSEO/"._HELPFILE;
  }
  echo "</font>";
  
  include_once("includes/counter.php");
  echo "<center><a href=\"javascript:void(0)\" onClick=javascript:self.close()>"._CLOSE."</a></center>";
  echo "</body>"
  ."</html>";

?>