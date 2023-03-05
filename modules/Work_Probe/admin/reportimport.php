<?php

/********************************************************/
/* NSN Work Probe                                       */
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

include_once("header.php");
$report = wpreport_info($report_id);
$report['report_name'] = wpunhtmlentities($report['report_name']);
$report['report_description'] = wpunhtmlentities($report['report_description']);
$project = wpproject_info($report['project_id']);
wpadmin_menu();
echo "<br />\n";
title(_WP_IMPORTASTASK);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPReportImportInsert'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<input type='hidden' name='project_id' value='".$report['project_id']."'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_PROJECT.":</td>\n";
echo "<td><select name='project_id'>\n";
$projectlist = $db->sql_query("select project_id, project_name from ".$prefix."_nsnwb_projects order by project_name");
while(list($s_project_id, $s_project_name) = $db->sql_fetchrow($projectlist)){
    if($s_project_id == $report['project_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_project_id' $sel>$s_project_name</option>\n";
}
echo "</select></td></tr>\n";        
echo "<tr><td bgcolor='$bgcolor2'>"._WP_TASKNAME.":</td>\n";
echo "<td><input type='text' name='task_name' size='30' value=\"".$report['report_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_DESCRIPTION.":</td>\n";
echo "<td><textarea name='task_description' cols='60' rows='10' wrap='virtual'>".$report['report_description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'><option value='0'>---------</option>\n";
$prioritylist = $db->sql_query("select priority_id, priority_name from ".$prefix."_nsnwb_tasks_priorities order by priority_weight");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
    echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='task_percent' size='4' value='0'>%</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_STATUS.":</td>\n";
echo "<td><select name='status_id'><option value='0'>---------</option>\n";
$statuslist = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwb_tasks_status order by status_name");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    echo "<option value='$s_status_id'>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_STARTDATE.":</td>\n";
echo "<td><select name='task_start_month'><option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    if($i == date("m")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='task_start_day'><option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    if($i == date("d")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='task_start_year' value='".date("Y")."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_FINISHDATE.":</td>\n";
echo "<td><select name='task_finish_month'><option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><select name='task_finish_day'><option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><input type=text name='task_finish_year' value='0000' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db->sql_query("select member_id, member_name from ".$prefix."_nsnwb_members order by member_name");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    echo "<option value='$member_id'>$member_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WP_TASKADD."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>