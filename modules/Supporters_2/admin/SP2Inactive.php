<?php
/********************************************************/
/* NSN Supporters_2(TM) Universal                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/
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

$pagetitle = ": "._SP2_MAINTITLE." "._SP2_ADMINMAIN." ".$sp_config['version_number']." - "._SP2_INACTIVESITES;
include_once("header.php");
title(_SP2_MAINTITLE." "._SP2_ADMINMAIN." ".$sp_config['version_number']." - "._SP2_INACTIVESITES);
sp2menu();
echo "<br />\n";
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnsp_2_sites` WHERE `site_status`='-1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while($site_row = $db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable();
    list($width, $height, $type, $attr) = getimagesize($site_row['site_image']);
    if($width > $sp_config['max_width']) { $width = $sp_config['max_width']; }
    if($height > $sp_config['max_height']) { $height = $sp_config['max_height']; }
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
    echo "<a href='modules.php?name=Supporters_2&op=SP2Go&site_id=".$site_row['site_id']."' target='_blank'><img src='".$site_row['site_image']."' border='0' alt='".$site_row['site_name']."' title='".$site_row['site_name']."' height='$height' width='$width'></a>";
    echo " <a href='".$admin_file.".php?op=SP2Activate&amp;site_id=".$site_row['site_id']."'><img src='modules/Supporters_2/images/activate.png' border='0' alt='"._SP2_ACTIVATE."' title='"._SP2_ACTIVATE."'></a>";
    echo " <a href='".$admin_file.".php?op=SP2Edit&amp;site_id=".$site_row['site_id']."'><img src='modules/Supporters_2/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>";
    echo " <a href='".$admin_file.".php?op=SP2Delete&amp;site_id=".$site_row['site_id']."'><img src='modules/Supporters_2/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    echo "</td>\n<td width='75%' valign='top'><strong>"._SP2_ADDED.":</strong> ".$site_row['site_date']."</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP2_DESCRIPTION."</strong>: ".$site_row['site_description']."</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP2_VISITS."</strong>: ".$site_row['site_hits']."</td></tr>";
    echo "</table>";
    CloseTable();
    echo "</td>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
} else {
  echo "<center class='title'>"._SP2_NOINACTIVESITES."</center>\n";
}
CloseTable();
include_once("footer.php");

?>
