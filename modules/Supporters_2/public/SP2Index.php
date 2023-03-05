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

$pagetitle = _SP2_SUPPORTERS;
include_once("header.php");
title(_SP2_SUPPORTERS);
OpenTable();
echo "<center>";
if(is_admin($admin)) { echo "[ <a href='".$admin_file.".php?op=SP2Main'>"._SP2_GOTOADMIN."</a> ]\n"; }
if($sp_config['require_user'] == 0 || is_user($user)) { echo "[ <a href='modules.php?name=$module_name&amp;op=SP2Submit'>"._SP2_BESUPPORTER."</a> ]\n"; }
echo "</center>";
echo "<br />";
$a = 0;
$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_url`, `site_image`, `site_date`, `site_description`, `site_hits` FROM `".$prefix."_nsnsp_2_sites` WHERE `site_status`='1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while(list($site_id, $site_name, $site_url, $site_image, $site_date, $site_description, $site_hits) = $db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
    list($width, $height, $type, $attr) = getimagesize($site_image);
    if($width > $sp_config['max_width']) { $width = $sp_config['max_width']; }
    if($height > $sp_config['max_height']) { $height = $sp_config['max_height']; }
    echo "<a href='modules.php?name=$module_name&op=SP2Go&site_id=$site_id' target='_blank'><img src='$site_image' border='0' alt='$site_name' title='$site_name' height='$height' width='$width'></a>";
    if(is_admin($admin)) {
      echo " <a href='".$admin_file.".php?op=SP2Deactivate&amp;site_id=".$site_id."'><img src='modules/".$module_name."/images/deactivate.png' border='0' alt='"._SP2_DEACTIVATE."' title='"._SP2_DEACTIVATE."'></a>"; 
      echo " <a href='".$admin_file.".php?op=SP2Edit&amp;site_id=".$site_id."'><img src='modules/".$module_name."/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>"; 
      echo " <a href='".$admin_file.".php?op=SP2Delete&amp;site_id=".$site_id."'><img src='modules/".$module_name."/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    }
    echo "</td>\n<td width='75%' valign='top'><strong>"._SP2_ADDED.":</strong> $site_date</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP2_DESCRIPTION."</strong>: $site_description</td></tr>";
    echo "<tr><td valign='top'><strong>"._SP2_VISITS."</strong>: $site_hits</td></tr>";
    echo "</table>";
    CloseTable();
    echo "</td>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
}
CloseTable();
include_once("footer.php");

?>