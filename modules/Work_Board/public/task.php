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
$taskresult = $db->sql_query("SELECT task_id, project_id, status_id FROM ".$prefix."_nsnwb_tasks where task_id='$task_id'");
list($task_id, $project_id, $status_id) = $db->sql_fetchrow($taskresult);
$task = wbtask_info($task_id);
$project = wbproject_info2($project_id);
$taskstatus = wbtaskstatus_info($status_id);
$taskpriority = wbtaskpriority_info($task['priority_id']);
title(_WB_VIEWTASK.": ".$task['task_name']);
OpenTable();
echo "<table align='center' width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='5'><nobr><strong>"._WB_PROJECTNAME."</strong></nobr></td></tr>\n";
$wbimage = wbimage("project.png");
echo "<tr><td align='center'><img src='$wbimage'></td>\n";
echo "<td width='100%' colspan='4'><nobr><a href='modules.php?name=$module_name&amp;op=WBViewProject&amp;project_id=$project_id'>".$project['project_name']."</a></nobr></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._WB_TASKNAME." / "._WB_TASKDETAILS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PRIORITY."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td></tr>\n";
$wbimage = wbimage("task.png");
echo "<tr><td align='center'><img src='$wbimage'></td><td width='100%'><nobr>".$task['task_name']."</nobr></td>\n";
if($taskstatus['status_name'] == ""){ $taskstatus['status_name'] = _WB_NA; }
echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
if($taskpriority['priority_name'] == ""){ $taskpriority['priority_name'] = _WB_NA; }
echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
$wbprogress = wbprogress($task['task_percent']);
echo "<td align='center'><nobr>$wbprogress</nobr></td></tr>\n";
if($task['task_description'] != ""){
    $wbimage = wbimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wbimage'></td>";
    echo "<td width='100%' colspan='4'>".nl2br($task['task_description'])."</td></tr>";
}
if($task['date_started'] > 0){
    $start_date = date($wb_config['task_date_format'], $task['date_started']);
    $wbimage = wbimage("date.png");
    echo "<tr><td align='center'><img src='$wbimage'></td>\n";
    echo "<td width='100%' colspan='4'><nobr>"._WB_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
}
if($task['date_finished'] > 0){
    $finish_date = date($wb_config['task_date_format'], $task['date_finished']);
    $wbimage = wbimage("date.png");
    echo "<tr><td align='center'><img src='$wbimage'></td>\n";
    echo "<td width='100%' colspan='4'><nobr>"._WB_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
}
echo "<tr><td bgcolor='$bgcolor2' colspan='3'><nobr><strong>"._WB_TASKMEMBERS."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center' colspan='2'><nobr><strong>"._WB_POSITION."</strong></nobr></td></tr>\n";
$memberresult = $db->sql_query("select member_id, position_id from ".$prefix."_nsnwb_tasks_members where task_id='$task_id' order by member_id");
$member_total = $db->sql_numrows($memberresult);
if($member_total != 0){
    while (list($member_id, $position_id) = $db->sql_fetchrow($memberresult)) {
        $member = wbmember_info($member_id);
        $position = wbmemberposition_info($position_id);
        $wbimage = wbimage("member.png");
        echo "<tr><td><img src='$wbimage'></td><td width='100%' colspan='2'><a href='mailto:".wbencode_email($member['member_email'])."'>".$member['member_name']."</a></td>\n";
        if($position['position_name'] == ""){ $position['position_name'] = "----------"; }
        echo "<td align='center' colspan='2'><nobr>".$position['position_name']."</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td colspan='5'>"._WB_NOTASKMEMBERS."</td></tr>\n";
}
if (is_admin($admin)) {
    echo "<tr><td bgcolor='$bgcolor2' colspan='5' width='100%'><nobr><strong>"._WB_ADMINFUNCTIONS."</strong></nobr></td></tr>\n";
    $wbimage = wbimage("options.png");
    echo "<tr><td align='center'><img src='$wbimage'></td>\n";
    echo "<td colspan='4' width='100%'><nobr><a href='".$admin_file.".php?op=WBTaskEdit&amp;task_id=$task_id'>"._WB_EDITTASK."</a>";
    echo ", <a href='".$admin_file.".php?op=WBTaskRemove&amp;task_id=$task_id'>"._WB_DELETETASK."</a></nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>