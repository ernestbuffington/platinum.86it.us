<?php

/********************************************************/
/* NSN Work Board                                       */
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

@include_once("header.php");
title(_WB_PROJECTLIST);
OpenTable();
echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._WB_PROJECTNAME."</strong></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_TASKS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PRIORITY."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_MEMBERS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td>\n";
echo "</tr>\n";
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects ORDER BY weight");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wbproject_info2($project_id);
    $projectstatus = wbprojectstatus_info($project['status_id']);
    $projectpriority = wbprojectpriority_info($project['priority_id']);
    $memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwb_projects_members where project_id='$project_id' order by member_id");
    $member_total = $db->sql_numrows($memberresult);
    $taskresult = $db->sql_query("SELECT task_id, status_id FROM ".$prefix."_nsnwb_tasks where project_id='$project_id' order by task_name");
    $taskrows = $db->sql_numrows($taskresult);
    if($project['featured'] > 0) { $project['project_name'] = "<strong>".$project['project_name']."</strong>"; }
    echo "<tr>\n";
    $wbimage = wbimage("project.png");
    echo "<td align='center'><img src='$wbimage'></td><td width='100%'>".$project['project_name']."</td>\n";
    echo "<td align='center'><a href='modules.php?name=$module_name&amp;op=WBViewProject&amp;project_id=$project_id'>$taskrows</a></td>\n";
    if($projectstatus['status_name'] == ""){ $projectstatus['status_name'] = _WB_NA; }
    echo "<td align='center'>".$projectstatus['status_name']."</td>\n";
    if($projectpriority['priority_name'] == ""){ $projectpriority['priority_name'] = _WB_NA; }
    echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
    echo "<td align='center'><nobr>$member_total</nobr></td>\n";
    $wbprogress = wbprogress($project['project_percent']);
    echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
    echo "</tr>\n";
}
echo "<tr><td bgcolor='$bgcolor2' colspan='7' align='right'>";
echo "<table width='100%'><tr><td><a href='modules.php?name=$module_name&amp;op=WBViewTaskList'><strong>"._WB_TASKLIST."</strong></a></td>";
echo "<td align='right'><a href='modules.php?name=$module_name&amp;op=WBTaskMap'><strong>"._WB_TASKMAP."</strong></a></td></tr></table>";
echo "</td></tr>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>