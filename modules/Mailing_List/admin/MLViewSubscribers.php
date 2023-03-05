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
title(_ML_VIEWSUBSCRIBERS);
ML_Admin();
echo "<br />\n";
OpenTable();
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE active>'0' ORDER BY email");
$num = $db->sql_numrows($result);
if($num) {
  echo "<table border='0' width='100%' align='center' bgcolor='$bgcolor2'>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td><strong>"._ML_EMAIL."</strong></td>\n";
  echo "<td align='center'><strong>"._ML_TYPE."</strong></td>\n";
  echo "<td align='center'><strong>"._ML_ISSUES."</strong></td>\n";
  echo "<td align='center'><strong>"._ML_JOINED."</strong></td>\n";
  echo "<td align='center'><strong>"._ML_STATUS."</strong></td>\n";
  echo "<td align='center'><strong>"._ML_LISTNAME."</strong></td>\n";
  echo "</tr>\n";
  while($user_info = $db->sql_fetchrow($result)) {
    echo "<tr bgcolor='$bgcolor1'>\n";
    echo "<td>".$user_info['email']."</td><td align='center'>";
    if ($user_info['type'] == '1') { echo _ML_TYPEHTML; } else { echo _ML_TYPETEXT; }
    echo "</td>\n";
    $issues = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_tracked WHERE mid='".$user_info['mid']."'"));
    echo "<td align='center'><a href='".$admin_file.".php?op=MLViewSent&amp;mid=".$user_info['mid']."'>".$issues."</a></td>\n";
    echo "<td align='center'>".date($ml_config['date_format'], $user_info['joined'])."</td><td align='center'>";
    if ($user_info['active'] == '1') { echo _ML_ACTIVATED; } else { echo _ML_PENDING; }
    echo "</td>\n";
    $list_info = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnml_lists WHERE lid='".$user_info['lid']."'"));
    echo "<td align='center'><a href='".$admin_file.".php?op=MLViewListSubscribers&amp;lid=".$user_info['lid']."'>".$list_info['title']."</a></td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
} else {
  echo "<center><strong>"._ML_NOSUBSCRIBERS."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>";
}
CloseTable();
@include_once("footer.php");

?>