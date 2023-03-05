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

$mid = intval($mid);
$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_SENTISSUES);
ML_Admin();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' width='70%' bgcolor='$bgcolor2'>\n";
echo "<tr bgcolor='$bgcolor2'>\n";
echo "<td width='70%'><strong>"._ML_SUBJECT."</strong></td>\n";
echo "<td align='center' width='30%'><strong>"._ML_DATE."</strong></td>\n";
echo "</tr>\n";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_tracked WHERE mid='$mid' ORDER BY sent");
while($track_info = $db->sql_fetchrow($result)) {
  echo "<tr bgcolor='$bgcolor1'>\n";
  $issue_info = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnml_issues WHERE nid='".$track_info['nid']."'"));
  echo "<td><a href='".$admin_file.".php?op=MLViewIssue&amp;nid=".$issue_info['nid']."'>".$issue_info['subject']."</a></td>\n";
  echo "<td align='center'>".date($ml_config['date_format'], $issue_info['sent'])."</td>\n";
  echo "</tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");  

?>