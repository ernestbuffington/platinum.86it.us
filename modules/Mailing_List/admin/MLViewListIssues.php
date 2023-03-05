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

$lid = intval($lid);
$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_VIEWLISTISSUES);
ML_Admin();
echo "<br />\n";
OpenTable();
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_issues WHERE lid='$lid' ORDER BY sent");
$num = $db->sql_numrows($result);
if($num) {
  echo "<table align='center' border='0' width='100%' bgcolor='$bgcolor2'>";
  echo "<tr bgcolor='$bgcolor2'>";
  echo "<td width='50%'><strong>"._ML_SUBJECT."</strong></td>";
  echo "<td align='center' width='40%'><strong>"._ML_DATE."</strong></td>";
  echo "<td align='center' width='10%'><strong>"._ML_SUBSCRIBERS."</strong></td>";
  while ($issue_info = $db->sql_fetchrow($result)) {
    echo "<tr bgcolor='$bgcolor1'>";
    echo "<td><a href='".$admin_file.".php?op=MLViewIssue&amp;nid=".$issue_info['nid']."'>".$issue_info['subject']."</a></td>";
    echo "<td align='center'>".date($ml_config['date_format'], $issue_info['sent'])."</td>";
    $user_info = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE lid='".$issue_info['nid']."'"));
    echo "<td align='center'>".$user_info."</td>\n";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "<center><strong>"._ML_NOISSUES."</strong></center>\n";
}
CloseTable();
@include_once("footer.php");

?>