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

function wbadmin_menu(){
    global $prefix, $db, $module_name, $admin_file;
    title(_WB_ADMINMENU);
    OpenTable();
    echo "<table border=0 align='center' width='100%' cellpadding='0' cellspacing='0'>\n";
    echo "<tr>\n";
    echo "<td align='center' valign='top' width='25%'>\n";
    echo "<a href='".$admin_file.".php?op=WBIndex'>"._WB_TITLE."</a><br />\n";
    if (file_exists("modules/Work_Probe/admin/index.php")) { echo "<a href='".$admin_file.".php?op=WPIndex'>"._WP_TITLE."</a><br />\n"; }
    if (file_exists("modules/Work_Request/admin/index.php")) { echo "<a href='".$admin_file.".php?op=WRIndex'>"._WR_TITLE."</a><br />\n"; }
    echo "</td>\n";
    echo "<td align='center' valign='top' width='25%'>\n";
    echo "<a href='".$admin_file.".php?op=WBProjectList'>"._WB_PROJECTLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBProjectPriorityList'>"._WB_PROJECTPRIORITYLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBProjectStatusList'>"._WB_PROJECTSTATUSLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBProjectConfig'>"._WB_PROJECTCONFIG."</a><br />\n";
    echo "</td>\n";
    echo "<td align='center' valign='top' width='25%'>\n";
    echo "<a href='".$admin_file.".php?op=WBTaskList'>"._WB_TASKLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBTaskPriorityList'>"._WB_TASKPRIORITYLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBTaskStatusList'>"._WB_TASKSTATUSLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBTaskConfig'>"._WB_TASKCONFIG."</a><br />\n";
    echo "</td>\n";
    echo "<td align='center' valign='top' width='25%'>\n";
    echo "<a href='".$admin_file.".php?op=WBMemberList'>"._WB_MEMBERLIST."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=WBMemberPositionList'>"._WB_POSITIONLIST."</a><br />\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    CloseTable();
}

function wbimage($imgfile) {
    global $module_name;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/$module_name/$imgfile")) {
        $wbimage = "themes/$ThemeSel/images/$module_name/$imgfile";
    } else {
        $wbimage = "modules/$module_name/images/$imgfile";
    }
    return($wbimage);
}

function wbimage2($imgfile, $modname) {
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/$modname/$imgfile")) {
        $wbimage = "themes/$ThemeSel/images/$modname/$imgfile";
    } else {
        $wbimage = "modules/$modname/images/$imgfile";
    }
    return($wbimage);
}

function wbprogress($percent) {
    $wbimage = wbimage("bar_left.png");
    $wbprogress  = "<img src='$wbimage' width='1' height='7'>";
    if($percent == 0){
        $wbimage = wbimage("bar_center_red.png");
        $wbprogress .= "<img src='$wbimage' width='100' height='7' alt='0"._WB_PERCENT." "._WB_COMPLETED."' title='0"._WB_PERCENT." "._WB_COMPLETED."'>";
    } else {
        if($percent > 100){ $progress = 100; } else { $progress = $percent; }
        $wbimage = wbimage("bar_center_grn.png");
        $wbprogress .= "<img src='$wbimage' width='".$progress."' height=7 alt='".$progress.""._WB_PERCENT." "._WB_COMPLETED."' title='".$progress.""._WB_PERCENT." "._WB_COMPLETED."'>";
        if($progress < 100){
            $incomplete = 100 - $progress;
            $wbimage = wbimage("bar_center_red.png");
            $wbprogress .= "<img src='$wbimage' width='".$incomplete."' height=7 alt='".$progress.""._WB_PERCENT." "._WB_COMPLETED."' title='".$progress.""._WB_PERCENT." "._WB_COMPLETED."'>";
        }
    }
    $wbimage = wbimage("bar_right.png");
    $wbprogress .= "<img src='$wbimage' width='1' height='7'>";
    return($wbprogress);
}

function wbmember_info($member_id){
    global $prefix, $db;
    $member_id = intval($member_id);
    $member = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_members WHERE member_id='$member_id'"));
    return $member;
}

function wbmemberposition_info($position_id){
    global $prefix, $db;
    $position_id = intval($position_id);
    $position = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_members_positions WHERE position_id='$position_id'"));
    return $position;
}

function wbproject_info($project_id){
    global $prefix, $db;
    $project_id = intval($project_id);
    $project = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_projects WHERE project_id='$project_id'"));
    return $project;
}

function wbprojectpriority_info($priority_id){
    global $prefix, $db;
    $priority_id = intval($priority_id);
    $priority = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_projects_priorities WHERE priority_id='$priority_id'"));
    return $priority;
}

function wbprojectstatus_info($status_id){
    global $prefix, $db;
    $status_id = intval($status_id);
    $status = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_projects_status WHERE status_id='$status_id'"));
    return $status;
}

function wbtask_info($task_id){
    global $prefix, $db;
    $task_id = intval($task_id);
    $task = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_tasks WHERE task_id='$task_id'"));
    return $task;
}

function wbtaskpriority_info($priority_id){
    global $prefix, $db;
    $priority_id = intval($priority_id);
    $priority = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_tasks_priorities WHERE priority_id='$priority_id'"));
    return $priority;
}

function wbtaskstatus_info($status_id){
    global $prefix, $db;
    $status_id = intval($status_id);
    $status = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_tasks_status WHERE status_id='$status_id'"));
    return $status;
}

function wbproject_info2($project_id){
    global $prefix, $db;
    $project_id = intval($project_id);
    $project = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_projects WHERE project_id='$project_id'"));
    $percentresult = $db->sql_query("select task_percent, priority_id from ".$prefix."_nsnwb_tasks where project_id='$project_id'");
    $percentnumber = $db->sql_numrows();
    if ($project['project_percent'] == 0 AND $percentnumber > 0) {
        $percentoverall = $percentfactor = 0;
        while(list($task_percent, $priority_id) = $db->sql_fetchrow($percentresult)) {
            $taskpriority = wbtaskpriority_info($priority_id);
            if ($taskpriority['priority_weight'] > 0) {
                $percentoverall = $percentoverall + ($task_percent * $taskpriority['priority_weight']);
                $percentfactor = $percentfactor + $taskpriority['priority_weight'];
            }
        }
        if ($percentnumber > 0 AND $percentfactor > 0) {
            $percenttotal = $percentoverall / $percentfactor;
            $project['project_percent'] = number_format($percenttotal, 0, '.', ',');
        }
    }
    return $project;
}

function wbencode_email($email_address){
    $encoded = bin2hex("$email_address");
    $encoded = chunk_split($encoded, 2, '%');
    $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
    return $encoded;
}

function wbsave_config($config_name, $config_value){
    global $prefix, $db;
    $db->sql_query("UPDATE ".$prefix."_nsnwb_config SET config_value='$config_value' WHERE config_name='$config_name'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_config");
}

function wbget_config($config_name){
    global $prefix, $db;
    $configresult = $db->sql_query("SELECT config_value FROM ".$prefix."_nsnwb_config WHERE config_name='$config_name'");
    list($config_value) = $db->sql_fetchrow($configresult);
    return $config_value;
}

function wbget_configs(){
    global $prefix, $db;
    $configresult = $db->sql_query("SELECT config_name, config_value FROM ".$prefix."_nsnwb_config");
    while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $config[$config_name] = $config_value;
    }
    return $config;
}

function wbunhtmlentities($string) {
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}

?>