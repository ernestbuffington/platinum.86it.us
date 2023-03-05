<?php

/********************************************************/
/* NSN Mailing List                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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

$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_VIEWLISTS);
ML_Admin();
echo "<br />\n";
OpenTable();
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_lists");
$num = $db->sql_numrows($result);
if($num) {
  echo "<table border='0' width='100%' align='center' bgcolor='$bgcolor2'>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td width='30%'><strong>"._ML_LISTNAME."</strong></td>\n";
  echo "<td width='50%'><strong>"._ML_LISTDESCRIPTION."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._ML_SUBSCRIBERS."</strong></td>\n";
  echo "<td align='center' width='10%'><strong>"._ML_FUNCTIONS."</strong></td>\n";
  echo "</tr>\n";
  while($list_info = $db->sql_fetchrow($result)) {
    $numusers = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE lid='".$list_info['lid']."' and active=1"));
    if(!$numusers) { $numusers = 0; }
    echo "<tr bgcolor='$bgcolor1'>\n";
    echo "<td valign='top'>".$list_info['title']."</td>\n";
    echo "<td valign='top'>".$list_info['description']."</td>\n";
    echo "<td align='center' valign='top'><a href='".$admin_file.".php?op=MLViewListSubscribers&amp;lid=".$list_info['lid']."'>".$numusers."</a></td>\n";
    echo "<td align='center' valign='top'><a href='".$admin_file.".php?op=MLEditList&amp;lid=".$list_info['lid']."'><img src='modules/$module_name/images/edit.png' border='0' height='16' width='16' alt='"._EDIT."' title='"._EDIT."'></a>";
    echo "&nbsp;<a href='".$admin_file.".php?op=MLDeleteList&amp;lid=".$list_info['lid']."'><img src='modules/$module_name/images/delete.png' border='0' height='16' width='16' alt='"._DELETE."' title='"._DELETE."'></a></td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
} else {
  echo "<center><strong>"._ML_NOLISTS."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>";
}
CloseTable();
@include_once("footer.php");

?>