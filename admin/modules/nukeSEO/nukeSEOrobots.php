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

$pagetitle = _SEO_NUKESEO.": "._SEO_MENU;
include_once("header.php");
title($pagetitle);
OpenTable();
//OpenMenu();
nukeSEOmenu();
//CloseMenu();
global $nukeurl;
  $fp = fopen("robots.txt", "r");
  $buf = "";
  if (!$fp) 
  {	
	  echo "Error opening robots.txt \n";
  }
  else
  {
  	$readsize = filesize("robots.txt");
	$buf .= fread($fp, $readsize); // Reads all in one chunk
	fclose($fp);
	$buf = preg_replace("#\n#i", "<br />", $buf);
	echo "<table border=\"0\" align=\"center\"><tr><td align=\"center\">robots.txt<br /><br /></td></tr><tr><td>$buf</td></tr></table><br />";
  }

CloseTable();
include_once("footer.php");
?>