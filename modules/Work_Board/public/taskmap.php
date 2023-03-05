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
title(_WB_TASKMAP);
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects order by weight");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wbproject_info2($project_id);
    $projectstatus = wbprojectstatus_info($project['status_id']);
    $projectpriority = wbprojectpriority_info($project['priority_id']);
    $memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwb_projects_members where project_id='$project_id' order by member_id");
    $member_total = $db->sql_numrows($membersresult);
    OpenTable();
    echo "<center>\n";
    echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
    echo "<tr>\n";
    echo "<td width='100%' bgcolor='$bgcolor2' colspan='2'><strong>"._WB_PROJECT."</strong></td>\n";
    echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
    echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PRIORITY."</strong></nobr></td>\n";
    echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td>\n";
    echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_MEMBERS."</strong></nobr></td>\n";
    echo "</tr>\n";
    $wbimage = wbimage("project.png");
    if($project['featured'] > 0) { $project['project_name'] = "<strong>".$project['project_name']."</strong>"; }
    echo "<tr><td align='center'><img src='$wbimage'></td>\n";
    echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WBViewProject&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    if($projectstatus['status_name'] == ""){ $projectstatus['status_name'] = _WB_NA; }
    echo "<td align='center'><nobr>".$projectstatus['status_name']."</nobr></td>\n";
    if($projectpriority['priority_name'] == ""){ $projectpriority['priority_name'] = _WB_NA; }
    echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
    $wbprogress = wbprogress($project['project_percent']);
    echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
    echo "<td align='center'><nobr>$member_total</nobr></td></tr>\n";
    echo "<tr><td width='100%' bgcolor='$bgcolor2' colspan='6'><strong>"._WB_PROJECTTASKS."</strong></td></tr>\n";
    if(!$column) $column = "task_name";
    if(!$direction) $direction = "asc";
    $taskresult = $db->sql_query("SELECT task_id, task_name, task_percent, priority_id, status_id FROM ".$prefix."_nsnwb_tasks where project_id='$project_id' order by $column $direction");
    $task_total = $db->sql_numrows($taskresult);
    if($task_total != 0){
        while (list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
            $taskstatus = wbtaskstatus_info($status_id);
            $memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwb_tasks_members where task_id='$task_id' order by member_id");
            $member_total = $db->sql_numrows($membersresult);
            $taskpriority = wbtaskpriority_info($priority_id);
            $wbimage = wbimage("task.png");
            echo "<tr><td><img src='$wbimage'></td>\n";
            echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WBViewTask&amp;task_id=$task_id'>$task_name</a></td>\n";
            if($taskstatus['status_name'] == ""){ $taskstatus['status_name'] = _WB_NA; }
            echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
            if($taskpriority['priority_name'] == ""){ $taskpriority['priority_name'] = _WB_NA; }
            echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
            $wbprogress = wbprogress($task_percent);
            echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
            echo "<td align='center'><nobr>$member_total</nobr></td></tr>\n";
        }
        echo "<tr>\n";
        echo "<form method='post' action='modules.php?name=$module_name'>\n";
        echo "<input type='hidden' name='op' value='WBTaskMap'>\n";
        echo "<input type='hidden' name='project_id' value='$project_id'>\n";
        echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._WB_SORT.":</strong> ";
        echo "<select name='column'>\n";
        if($column == "task_name") $selcolumn1 = "selected";
        echo "<option value='task_name' $selcolumn1>"._WB_TASKNAME."</option>\n";
        if($column == "status_id") $selcolumn2 = "selected";
        echo "<option value='status_id' $selcolumn2>"._WB_STATUS."</option>\n";
        if($column == "priority_id") $selcolumn3 = "selected";
        echo "<option value='priority_id' $selcolumn3>"._WB_PRIORITY."</option>\n";
        echo "</select> ";
        echo "<select name='direction'>\n";
        if($direction == "asc") $seldirection1 = "selected";
        echo "<option value='asc' $seldirection1>"._WB_ASC."</option>\n";
        if($direction == "desc") $seldirection2 = "selected";
        echo "<option value='desc' $seldirection2>"._WB_DESC."</option>\n";
        echo "</select> ";
        echo "<input type='submit' value='"._WB_SORT."'>";
        echo "</td></form></tr>\n";
        echo "<tr>\n";
    } else {
        echo "<tr>\n";
        echo "<td width='100%' colspan='6' align='center'><nobr>"._WB_NOTASKS."</nobr></td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
    echo "</center>\n";
    CloseTable();
    echo "<br />\n";
}
@include_once("footer.php");

?>