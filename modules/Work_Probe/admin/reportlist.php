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

if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "project_id";
if(!$direction) $direction = "desc";
include_once("header.php");
wpadmin_menu();
echo "<br />\n";
title(_WP_REPORTLIST);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' bgcolor='$bgcolor2'><nobr><strong>"._WP_REPORTOPTIONS."</strong></nobr></td></tr>\n";
$reportrows = $db->sql_numrows($db->sql_query("select report_id from ".$prefix."_nsnwp_reports"));
$wpimage = wpimage("stats.png");
echo "<tr><td><img src='$wpimage'></td><td colspan='2' width='100%'><nobr>"._WP_TOTALREPORTS.": <strong>$reportrows</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
$total_pages = ($reportrows / $per_page);
$total_pages_quotient = ($reportrows % $per_page);
if($total_pages_quotient != 0){
    $total_pages = ceil($total_pages);
}
$start_list = ($per_page * ($page-1));
$end_list = $per_page;
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._WP_REPORTLIST."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_TYPE."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_FUNCTIONS."</strong></td></tr>\n";
if($reportrows > 0){
    $reviewresult = $db->sql_query("select report_id, report_name, project_id, type_id, status_id from ".$prefix."_nsnwp_reports order by $column $direction limit $start_list, $end_list");
    while (list($report_id, $report_name, $project_id, $type_id, $status_id) = $db->sql_fetchrow($reviewresult)){
	$status = wpreportstatus_info($status_id);
	$project = wpproject_info($project_id);
	$type = wpreporttype_info($type_id);
	$members = $db->sql_numrows($db->sql_query("select member_id from ".$prefix."_nsnwp_reports_members where report_id='$report_id'"));
	$wpimage = wpimage("report.png");
	if ($report_name == "") { $report_name = "----------"; }
	echo "<tr><td><img src='$wpimage'></td><td width='100%'>$report_name</td>\n";
        echo "<td align='center'><nobr><a href='".$admin_file.".php?op=WPProjectList>".$project['project_name']."</a></nobr></td>\n";
	if($status['status_name'] == ""){ $status['status_name'] = _WP_NA; }
	echo "<td align=center><a href='".$admin_file.".php?op=WPReportStatusList'>".$status['status_name']."</a></td>\n";
	if($type['type_name'] == ""){ $type['type_name'] = _WP_NA; }
	echo "<td align=center><nobr><a href='".$admin_file.".php?op=WPReportTypeList'>".$type['type_name']."</a></td>\n";
	echo "<td align=center><nobr>[ <a href='".$admin_file.".php?op=WPReportEdit&report_id=$report_id'>"._WP_EDIT."</a>";
	echo " | <a href='".$admin_file.".php?op=WPReportRemove&report_id=$report_id'>"._WP_DELETE."</a> ]</td></tr>\n";
    }
    echo "<form method='post' action='".$admin_file.".php'>\n";
    echo "<input type='hidden' name='op' value='WPReportList'>\n";
    echo "<input type='hidden' name='column' value='$column'>\n";
    echo "<input type='hidden' name='direction' value='$direction'>\n";
    echo "<input type='hidden' name='per_page' value='$per_page'>\n";
    echo "<tr><td colspan='6' width='100%' bgcolor='$bgcolor2'>";

    echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._WP_PAGE."</strong> <select name='page' onChange='submit()'>\n";
    for($i=1; $i<=$total_pages; $i++){
	if($i==$page){ $sel = "selected"; } else { $sel = ""; }
	echo "<option value='$i' $sel>$i</option>\n";
    }
    echo "</select> <strong>"._WP_OF." $total_pages</strong></td>\n";
    echo "</form>\n";

    echo "<form method='post' action='".$admin_file.".php'>\n";
    echo "<input type='hidden' name='op' value='WPReportList'>\n";
    echo "<td align='right' bgcolor='$bgcolor2'><strong>"._WP_SORT.":</strong> <select name='column'>\n";
    if($column == "report_id") $selcolumn1 = "selected";
    echo "<option value='report_id' $selcolumn1>"._WP_REPORTID."</option>\n";
    if($column == "project_id") $selcolumn2 = "selected";
    echo "<option value='project_id' $selcolumn2>"._WP_PROJECTID."</option>\n";
    if($column == "status_id") $selcolumn3 = "selected";
    echo "<option value='status_id' $selcolumn3>"._WP_STATUSID."</option>\n";
    if($column == "priority_id") $selcolumn4 = "selected";
    echo "<option value='type_id' $selcolumn4>"._WP_TYPEID."</option>\n";
    echo "</select> <select name='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<option value='asc' $seldirection1>"._WP_ASC."</option>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<option value='desc' $seldirection2>"._WP_DESC."</option>\n";
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
    echo "</select> <input type='submit' value='"._WP_SORT."'></td>\n";
    echo "</form>\n";
    echo "</tr></table>\n";

    echo "</td></tr>\n";
} else {
    echo "<tr><td colspan='6' width='100%' align='center'>"._WP_NOPROJECTREPORTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>