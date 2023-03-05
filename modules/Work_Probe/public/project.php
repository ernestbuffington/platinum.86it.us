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
$wp_config = wpget_configs();
$project = wpproject_info($project_id);
title(_WP_PROJECTVIEW.": ".$project['project_name']);
$projectreportresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports where project_id='$project_id'");
$project_reports = $db->sql_numrows($projectreportresult);
OpenTable();
echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WP_PROJECTNAME."</strong></nobr></td></tr>\n";
$wpimage = wpimage("project.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td width='100%'><nobr>".$project['project_name']."</nobr></td></tr>\n";
if($project['project_description'] != ""){
    $wpimage = wpimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wpimage'></td>\n";
    echo "<td width='100%'>".$project['project_description']."</td></tr>\n";
}
$wpimage = wpimage("stats.png");
echo "<tr><td align='center'><img src='$wpimage'></td><td width='100%'><nobr>"._WP_REPORTS.": <strong>$project_reports</strong></nobr></td></tr>\n";
if($project['date_started'] != '0'){
    $start_date = date($wp_config['report_date_format'], $project['date_started']);
} else {
    $start_date = _WP_NA;
}
$wpimage = wpimage("date.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WP_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
if($project['date_finished'] != '0'){
    $finish_date = date($wp_config['report_date_format'], $project['date_finished']);
} else {
    $finish_date = _WP_NA;
}
$wpimage = wpimage("date.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WP_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
$wpimage = wpimage("options.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td width='100%'><nobr><a href='modules.php?name=$module_name&amp;op=WPReportSubmit&amp;project_id=".$project['project_id']."'>"._WP_SUBMITAREPORT."</a></nobr></td></tr>\n";
echo "</table>\n";
echo "<br />\n";
if(!$column) $column = "report_name";
if(!$direction) $direction = "asc";
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WP_REPORTS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_TYPE."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_STATUS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_SUBMITTED."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_COMMENTS."</strong></nobr></td></tr>\n";
$reportresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports where project_id='$project_id' order by $column $direction");
$report_total = $db->sql_numrows($reportresult);
if($report_total != 0){
    while (list($report_id) = $db->sql_fetchrow($reportresult)) {
        $report = wpreport_info($report_id);
        $reporttype = wpreporttype_info($report['type_id']);
        $reportstatus = wpreportstatus_info($report['status_id']);
        if ($report['report_name'] == "") { $report['report_name'] = "----------"; }
        if ($reporttype['type_name'] == "") { $reporttype['type_name'] = _WP_NA; }
        if ($reportstatus['status_name'] == "") { $reportstatus['status_name'] = _WP_NA; }
        $last_date = date($wp_config['report_date_format'], $report['date_submitted']);    
        $comments = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnwp_reports_comments WHERE report_id='$report_id'"));
        $wpimage = wpimage("report.png");
        echo "<tr><td><img src='$wpimage'></td>\n";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WPViewReport&amp;report_id=$report_id'>".$report['report_name']."</a></td>\n";
        echo "<td align='center'><nobr>".$reporttype['type_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>".$reportstatus['status_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>$last_date</nobr></td>\n";
        echo "<td align='center'><nobr>$comments</nobr></td></tr>\n";
    }
    echo "<form method='post' action='modules.php'>\n";
    echo "<input type='hidden' name='name' value='$module_name'>\n";
    echo "<input type='hidden' name='op' value='WPViewProject'>\n";
    echo "<input type='hidden' name='project_id' value='$project_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._WP_SORT.":</strong> ";
    echo "<select name='column'>\n";
    if($column == "report_name") $selcolumn1 = "selected";
    echo "<option value='report_name' $selcolumn1>"._WP_REPORTNAME."</option>\n";
    if($column == "status_id") $selcolumn2 = "selected";
    echo "<option value='status_id' $selcolumn2>"._WP_STATUS."</option>\n";
    if($column == "type_id") $selcolumn3 = "selected";
    echo "<option value='type_id' $selcolumn3>"._WP_TYPE."</option>\n";
    if($column == "date_submitted") $selcolumn4 = "selected";
    echo "<option value='date_submitted' $selcolumn4>"._WP_SUBMITTED."</option>\n";
    echo "</select> ";
    echo "<select name='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<option value='asc' $seldirection1>"._WP_ASC."</option>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<option value='desc' $seldirection2>"._WP_DESC."</option>\n";
    echo "</select> ";
    echo "<input type='submit' value='"._WP_SORT."'>\n";
    echo "</td></form></tr>\n";
    echo "<tr>\n";
} else {
    echo "<tr><td align='center' colspan='6' width='100%'><nobr>"._WP_NOPROJECTREPORTS."</nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>