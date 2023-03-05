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
title(_WB_TASKLIST);
if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "project_id";
if(!$direction) $direction = "desc";
$taskrows = $db->sql_numrows($db->sql_query("select task_id from ".$prefix."_nsnwb_tasks"));
$total_pages = ($taskrows / $per_page);
$total_pages_quotient = ($taskrows % $per_page);
if($total_pages_quotient != 0){
    $total_pages = ceil($total_pages);
}
$start_list = ($per_page * ($page-1));
$end_list = $per_page;
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' bgcolor='$bgcolor2'><nobr><strong>"._WB_TASKOPTIONS."</strong></nobr></td></tr>\n";
if (is_admin($admin)) {
  $wbimage = wbimage("options.png");
  echo "<tr><td><img src='$wbimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=WBTaskAdd'>"._WB_TASKADD."</a></nobr></td></tr>\n";
}
$wbimage = wbimage("stats.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='2' width='100%'><nobr>"._WB_TOTALTASKS.": <strong>$taskrows</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._WB_TASKLIST."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_PRIORITY."</strong></td></tr>\n";
if($taskrows > 0){
    $reviewresult = $db->sql_query("select task_id, task_name, project_id, priority_id, status_id from ".$prefix."_nsnwb_tasks order by $column $direction limit $start_list, $end_list");
    while (list($task_id, $task_name, $project_id, $priority_id, $status_id) = $db->sql_fetchrow($reviewresult)){
        $taskstatus = wbtaskstatus_info($status_id);
        $project = wbproject_info($project_id);
        $taskpriority = wbtaskpriority_info($priority_id);
        $members = $db->sql_numrows($db->sql_query("select member_id from ".$prefix."_nsnwb_tasks_members where task_id='$task_id'"));
        $wbimage = wbimage("task.png");
        echo "<tr><td><img src='$wbimage'></td>";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WBViewTask&amp;task_id=$task_id'>$task_name</a></td>\n";
        echo "<td align='center'><nobr><a href='modules.php?name=Work_Board&op=WBViewProject&project_id=$project_id'>".$project['project_name']."</a></nobr></td>\n";
        if($taskstatus['status_name'] == ''){ $taskstatus['status_name'] = _WB_NA; }
        echo "<td align='center'><nobr>".$taskstatus['status_name']."</nobr></td>\n";
        if($taskpriority['priority_name'] == ""){ $taskpriority['priority_name'] = _WB_NA; }
        echo "<td align='center'><nobr>".$taskpriority['priority_name']."</nobr></td>\n";
    }
    echo "<tr>\n";
    echo "<form method='post' action='modules.php?name=$module_name'>\n";
    echo "<input type='hidden' name='op' value='WBViewTaskList'>\n";
    echo "<input type='hidden' name='column' value='$column'>\n";
    echo "<input type='hidden' name='direction' value='$direction'>\n";
    echo "<input type='hidden' name='per_page' value='$per_page'>\n";
    echo "<td colspan='5' width='100%' bgcolor='$bgcolor2'>\n";
    echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._WB_PAGE."</strong> <select name='page' onChange='submit()'>\n";
    for($i=1; $i<=$total_pages; $i++){
        if($i==$page){ $sel = "selected"; } else { $sel = ""; }
        echo "<option value='$i' $sel>$i</option>\n";
    }
    echo "</select> <strong>"._WB_OF." $total_pages</strong></td>\n";
    echo "</form>\n";
    echo "<form method='post' action='modules.php?name=$module_name'>\n";
    echo "<input type='hidden' name='op' value='WBViewTaskList'>\n";
    echo "<td align='right' bgcolor='$bgcolor2'><strong>"._WB_SORT.":</strong> ";
    echo "<select name='column'>\n";
    if($column == "task_id") $selcolumn1 = "selected";
    echo "<option value='task_id' $selcolumn1>"._WB_TASKID."</option>\n";
    if($column == "project_id") $selcolumn2 = "selected";
    echo "<option value='project_id' $selcolumn2>"._WB_PROJECTID."</option>\n";
    if($column == "status_id") $selcolumn3 = "selected";
    echo "<option value='status_id' $selcolumn3>"._WB_STATUSID."</option>\n";
    if($column == "priority_id") $selcolumn4 = "selected";
    echo "<option value='priority_id' $selcolumn4>"._WB_PRIORITYID."</option>\n";
    echo "</select> <select name='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<option value='asc' $seldirection1>"._WB_ASC."</option>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<option value='desc' $seldirection2>"._WB_DESC."</option>\n";
    echo "</select> <select name='per_page'>\n";
    if($per_page == 5) $selperpage1 = "selected";
    echo "<option value='5' $selperpage1>5</option>\n";
    if($per_page == 10) $selperpage2 = "selected";
    echo "<option value='10' $selperpage2>10</option>\n";
    if($per_page == 25) $selperpage3 = "selected";
    echo "<option value='25' $selperpage3>25</option>\n";
    if($per_page == 50) $selperpage4 = "selected";
    echo "<option value='50' $selperpage4>50</option>\n";
    if($per_page == 100) $selperpage5 = "selected";
    echo "<option value='100' $selperpage5>100</option>\n";
    if($per_page == 200) $selperpage6 = "selected";
    echo "<option value='200' $selperpage6>200</option>\n";
    echo "</select> <input type='submit' value='"._WB_SORT."'></td>\n";
    echo "</form>\n";
    echo "</tr></table>\n";
    echo "</td></tr>\n";
} else {
    echo "<tr><td colspan=5 width='100%' align='center'>"._WB_NOTASKS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>
