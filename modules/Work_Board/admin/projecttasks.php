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
$projectresult = $db->sql_query("select project_name, project_description, status_id, priority_id from ".$prefix."_nsnwb_projects where project_id='$project_id'");
list($project_name, $project_description, $status_id, $priority_id) = $db->sql_fetchrow($projectresult);
wbadmin_menu();
echo "<br />\n";
title(_WB_PROJECTTASKLIST);
$taskresult = $db->sql_query("select task_id, task_name, priority_id, status_id from ".$prefix."_nsnwb_tasks where project_id='$project_id' order by task_name");
$task_total = $db->sql_numrows($taskresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><nobr><strong>"._WB_PROJECT."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_PRIORITY."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_FUNCTIONS."</strong></td></tr>\n";
$wbimage = wbimage("project.png");
echo "<tr><td><img src='$wbimage'></td>\n";
echo "<td width='100%'><a href='".$admin_file.".php?op=WBProjectList'>"._WB_PROJECTS."</a> / <strong>$project_name</strong></td>\n";
$projectstatus = wbprojectstatus_info($status_id);
if($projectstatus['status_name'] == "") { $projectstatus['status_name'] = _WB_NA; }
echo "<td align='center'><a href='".$admin_file.".php?op=WBProjectStatusList'>".$projectstatus['status_name']."</a></td>\n";
$projectpriority = wbprojectpriority_info($priority_id);
if($projectpriority['priority_name'] == "") { $projectpriority['priority_name'] = _WB_NA; }
echo "<td align='center'><a href='".$admin_file.".php?op=WBProjectPriorityList'>".$projectpriority['priority_name']."</a></td>\n";
echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WBProjectEdit&amp;project_id=$project_id'>"._WB_EDIT."</a> |";
echo " <a href='".$admin_file.".php?op=WBProjectRemove&amp;project_id=$project_id'>"._WB_DELETE."</a> ]</nobr></td></tr>\n";
echo "<tr><td colspan='5' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WB_PROJECTOPTIONS."</strong></nobr></td></tr>\n";
$wbimage = wbimage("options.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='4' width='100%'><nobr><a href='".$admin_file.".php?op=WBTaskAdd&amp;project_id=$project_id'>"._WB_TASKADD."</a></nobr></td></tr>\n";
$wbimage = wbimage("stats.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='4' width='100%'><nobr>"._WB_TOTALTASKS.": <strong>$task_total</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WB_PROJECTTASKS."</strong></a></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_STATUS."</strong></td><td align='center' bgcolor='$bgcolor2'><strong>"._WB_PRIORITY."</strong></td><td align='center' bgcolor='$bgcolor2'><strong>"._WB_FUNCTIONS."</strong></td></tr>\n";
if($task_total != 0){
    while (list($task_id, $task_name, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
        $wbimage = wbimage("task.png");
        echo "<tr><td><img src='$wbimage'></td><td width='100%'>$task_name</td>\n";
        $taskstatus = wbtaskstatus_info($status_id);
        if($taskstatus['status_name'] == "") { $taskstatus['status_name'] = _WB_NA; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WBTaskStatusList'>".$taskstatus['status_name']."</a></td>\n";
        $taskpriority = wbtaskpriority_info($priority_id);
        if($taskpriority['priority_name'] == "") { $taskpriority['priority_name'] = _WB_NA; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WBTaskPriorityList'>".$taskpriority['priority_name']."</a></td>\n";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WBTaskEdit&amp;task_id=$task_id'>"._WB_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WBTaskRemove&amp;task_id=$task_id'>"._WB_DELETE."</a> ]</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td width='100%' colspan='4' align='center'>"._WB_NOPROJECTTASKS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>