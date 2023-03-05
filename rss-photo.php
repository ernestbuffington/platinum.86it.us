<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com     By: TCB at pcnuke.com		            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
include_once("mainfile.php");
global $prefix, $db;
$length=10; //number of thumbs
$cpg_dir = "coppermine";
require("modules/" . $cpg_dir . "/include/load.inc");
$cpg_block = false;
$title_length = 15; // maximum length of title
$CPG_URL = "$nukeurl/modules.php?name=coppermine";
$cpg_prefix = $prefix."_cpg_";
$result = $db->sql_query("SELECT ctime FROM ".$cpg_prefix."pictures WHERE approved='YES' GROUP BY pid ORDER BY pid DESC LIMIT 1");
$row = $db->sql_fetchrow($result);
$last_date = date('D, d M Y H:i:s \G\M\T', $row['ctime']);
$result = $db->sql_query("SELECT pid, filepath, filename, p.aid, p.title, caption, ctime FROM ".$cpg_prefix."pictures AS p INNER JOIN ".$cpg_prefix."albums AS a ON (p.aid = a.aid AND visibility=0) WHERE approved='YES' GROUP BY pid ORDER BY pid DESC LIMIT $length");
$content .= '<br /><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><tr align="center">';
$pic = 0;
header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<rss version=\"0.91\">";
echo "<channel>";
echo "<title>".htmlspecialchars($sitename)." - ".LASTUP_TITLE."</title>";
echo "<link>".$CPG_URL."</link>";
echo "<description>".htmlspecialchars($sitename)." - ".LASTUP_TITLE."</description>";
echo "<language>'.$backend_language.'</language>";
echo "<pubDate>".$last_date."</pubDate>";
echo "<copyright>".htmlspecialchars($sitename)."</copyright>";
echo "<image>";
echo "<width>111</width>";
echo "<height>40</height>";
echo "<title>'.htmlspecialchars($sitename).'</title>";
echo "<link>".$CPG_URL."</link>";
echo "</image>";
while ($row = $db->sql_fetchrow($result)) {
   if ($row['title'] != '') {
      $thumb_title = $row['title'];
   } else {
      $thumb_title = substr($row['filename'], 0, -4);
   }
    stripslashes($thumb_title);
echo "<item>";
echo "<title>".htmlspecialchars($thumb_title)."</title>";
echo "<link>".$CPG_URL."&amp;file=displayimage&amp;meta=lastup&amp;cat=0&amp;pos=".$pic."</link>";
echo "<pubDate>".$last_date."</pubDate>";
echo "<description>";
	$description2 = "<p><a href=\"".$CPG_URL."&amp;file=displayimage&amp;meta=lastup&amp;cat=0&amp;pos=".$pic."\" alt=\"".$thumb_title."\" title=\"".$thumb_title."\"><img src=\"".$nukeurl."/".get_pic_url($row, 'thumb')."\" alt=\"".$thumb_title."\" style=\"border: 1px solid #000000;\" /></a></p>".$row['caption'];
	$description2 = htmlspecialchars($description2);
echo "$description2 </description>";
echo "</item>\n\n";
	$pic++;
}
echo "</channel>\n";
echo "</rss>";
?>
