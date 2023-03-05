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
$wb_config = wbget_configs();
$project = wbproject_info2($project_id);
$projectstatus = wbprojectstatus_info($project['status_id']);
$memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwb_projects_members where project_id='$project_id' order by member_id");
$member_total = $db->sql_numrows($memberresult);
$projecttaskresult = $db->sql_query("select task_id from ".$prefix."_nsnwb_tasks where project_id='$project_id'");
$project_tasks = $db->sql_numrows($projecttaskresult);
$projectpriority = wbprojectpriority_info($project['priority_id']);
title(_WB_VIEWPROJECT.": ".$project['project_name']);
OpenTable();
echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._WB_PROJECTNAME."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PRIORITY."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_MEMBERS."</strong></nobr></td></tr>\n";
    if($project['featured'] > 0) { $project['project_name'] = "<strong>".$project['project_name']."</strong>"; }
$wbimage = wbimage("project.png");
echo "<tr><td align='center'><img src='$wbimage'></td>\n";
echo "<td width='100%'><nobr>".$project['project_name']."</nobr></td>\n";
if($projectstatus['status_name'] == ""){ $projectstatus['status_name'] = _WB_NA; }
echo "<td align='center'><nobr>".$projectstatus['status_name']."</nobr></td>\n";
if($projectpriority['priority_name'] == ""){ $projectpriority['priority_name'] = _WB_NA; }
echo "<td align='center'><nobr>".$projectpriority['priority_name']."</nobr></td>\n";
$wbprogress = wbprogress($project['project_percent']);
echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
echo "<td align='center'><nobr>$member_total</nobr></td></tr>\n";
if($project['project_description'] != ""){
    $wbimage = wbimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wbimage'></td>";
    echo "<td width='100%' colspan='5'>".nl2br($project['project_description'])."</td></tr>";
}
$wbimage = wbimage("stats.png");
echo "<tr><td align='center'><img src='$wbimage'></td><td width='100%' colspan='5'><nobr>"._WB_TASKS.": <strong>$project_tasks</strong></nobr></td></tr>";
if($project['date_started'] > 0){
    $start_date = date($wb_config['project_date_format'], $project['date_started']);
} else {
    $start_date = _WB_NA;
}
$wbimage = wbimage("date.png");
echo "<tr><td align='center'><img src='$wbimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WB_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
if($project['date_finished'] > 0){
    $finish_date = date($wb_config['project_date_format'], $project['date_finished']);
} else {
    $finish_date = _WB_NA;
}
$wbimage = wbimage("date.png");
echo "<tr><td align='center'><img src='$wbimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WB_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='4'><nobr><strong>"._WB_PROJECTMEMBERS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center' colspan='2'><nobr><strong>"._WB_POSITION."</strong></nobr></td></tr>\n";
$memberresult = $db->sql_query("select member_id, position_id from ".$prefix."_nsnwb_projects_members where project_id='$project_id' order by member_id");
$member_total = $db->sql_numrows($memberresult);
if($member_total != 0){
    while (list($member_id, $position_id) = $db->sql_fetchrow($memberresult)) {
        $member = wbmember_info($member_id);
        $position = wbmemberposition_info($position_id);
        $wbimage = wbimage("member.png");
        echo "<tr><td><img src='$wbimage'></td><td width='100%' colspan='3'><a href='mailto:".wbencode_email($member['member_email'])."'>".$member['member_name']."</a></td>\n";
        if($position['position_name'] == ""){ $position['position_name'] = "----------"; }
        echo "<td align='center' colspan='2'><nobr>".$position['position_name']."</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td colspan='3'><center><nobr>"._WB_NOPROJECTMEMBERS."</nobr></center></td></tr>\n";
}
if (is_admin($admin)) {
    echo "<tr><td bgcolor='$bgcolor2' colspan='6' width='100%'><nobr><strong>"._WB_ADMINFUNCTIONS."</strong></nobr></td></tr>\n";
    $wbimage = wbimage("options.png");
    echo "<tr><td align='center'><img src='$wbimage'></td>\n";
    echo "<td colspan='5' width='100%'><nobr><a href='".$admin_file.".php?op=WBProjectEdit&amp;project_id=$project_id'>"._WB_EDITPROJECT."</a>";
    echo ", <a href='".$admin_file.".php?op=WBProjectRemove&amp;project_id=$project_id'>"._WB_DELETEPROJECT."</a></nobr></td></tr>\n";
}
echo "</table>\n";
echo "<br />\n";
if(!$column) $column = "task_name";
if(!$direction) $direction = "asc";
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr>\n";
echo "<td colspan='2' bgcolor='$bgcolor2' width='100%'><nobr><strong>"._WB_TASKS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PRIORITY."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_MEMBERS."</strong></nobr></td>\n";
echo "</tr>\n";
$taskresult = $db->sql_query("select task_id, task_name, task_percent, priority_id, status_id from ".$prefix."_nsnwb_tasks where project_id='$project_id' order by $column $direction");
$task_total = $db->sql_numrows($taskresult);
if($task_total != 0){
    while (list($task_id, $task_name, $task_percent, $priority_id, $status_id) = $db->sql_fetchrow($taskresult)) {
        $taskstatus = wbtaskstatus_info($status_id);
        $memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwb_tasks_members where task_id='$task_id' order by member_id");
        $member_total = $db->sql_numrows($memberresult);
        $taskpriority = wbtaskpriority_info($priority_id);
        echo "<tr>\n";
        $wbimage = wbimage("task.png");
        echo "<td><img src='$wbimage'></td>\n";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WBViewTask&amp;task_id=$task_id'>$task_name</a></td>\n";
        if($taskstatus['status_name'] == ""){ $taskstatus['status_name'] = _WB_NA; }
        echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
        if($taskpriority['priority_name'] == ""){ $taskpriority['priority_name'] = _WB_NA; }
        echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
        $wbprogress = wbprogress($task_percent);
        echo "<td align='center'><nobr>$wbprogress</nobr></td>\n";
        echo "<td align='center'><nobr>$member_total</nobr></td>\n";
        echo "</tr>\n";
    }
    echo "<tr>\n";
    echo "<form method='post' action='modules.php'>\n";
    echo "<input type='hidden' name='name' value='$module_name'>\n";
    echo "<input type='hidden' name='op' value='WBViewProject'>\n";
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
    echo "<input type='submit' value='"._WB_SORT."'>\n";
    echo "</td></form></tr>\n";
    echo "<tr>\n";
} else {
    echo "<tr><td width='100%' colspan='6' align='center'><nobr>"._WB_NOPROJECTTASKS."</nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>