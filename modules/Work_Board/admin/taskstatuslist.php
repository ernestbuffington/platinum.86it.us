<?php

/********************************************************/
/* NSN Work Board                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright ? 2000-2005 by NukeScripts Network         */
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

@include_once("header.php");
wbadmin_menu();
echo "<br />\n";
title(_WB_TASKSTATUSLIST);
$statusresult = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwb_tasks_status order by status_name");
$status_total = $db->sql_numrows($statusresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WB_TASKSTATUSOPTIONS."</strong></nobr></td></tr>\n";
$wbimage = wbimage("options.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=WBTaskStatusAdd'>"._WB_TASKSTATUSADD."</a></nobr></td></tr>\n";
$wbimage = wbimage("stats.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='2' width='100%'><nobr>"._WB_TOTALTASKSTATUSES.": <strong>$status_total</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WB_TASKSTATUSES."</strong></a></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_FUNCTIONS."</strong></td></tr>\n";
if($status_total != 0){
    while (list($status_id, $status_name) = $db->sql_fetchrow($statusresult)) {
        $wbimage = wbimage("task_status.png");
        echo "<tr><td><img src='$wbimage'></td><td width='100%'>$status_name</td>\n";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WBTaskStatusEdit&amp;status_id=$status_id'>"._WB_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WBTaskStatusRemove&amp;status_id=$status_id'>"._WB_DELETE."</a> ]</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td width='100%' colspan='3' align='center'>"._WB_NOTASKSTATUS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>