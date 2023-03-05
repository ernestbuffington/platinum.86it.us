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
title(_WP_REPORTLIST);
$reportresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports");
$report_total = $db->sql_numrows($reportresult);
if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "report_id";
if(!$direction) $direction = "desc";
if($per_page != "ALL"){
    $total_pages = ($report_total / $per_page);
    $total_pages_quotient = ($report_total % $per_page);
    if($total_pages_quotient != 0){
        $total_pages = ceil($total_pages);
    }
    $start_list = ($per_page * ($page-1));
    $end_list = $per_page;
}
if($per_page == "ALL"){ $limit = ""; } else { $limit = "limit $start_list, $end_list"; }
OpenTable();
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr>\n";
echo "<td' bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WP_REPORTLIST."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_TYPE."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_STATUS."</strong></td>\n";
echo "</tr>\n";
if($report_total > 0){
    $reportresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports order by $column $direction $limit");
    while (list($report_id) = $db->sql_fetchrow($reportresult)){
        $report = wpreport_info($report_id);
        $reportstatus = wpreportstatus_info($report['status_id']);
        $project = wpproject_info($report['project_id']);
        $reporttype = wpreporttype_info($report['type_id']);
        if($report['report_name'] == "") { $report['report_name'] = "----------"; }
        if($reportstatus['status_name'] == "") { $reportstatus['status_name'] = _WP_NA; }
        if($reporttype['type_name'] == "") { $reporttype['type_name'] = _WP_NA; }
        $wpimage = wpimage("report.png");
        echo "<tr><td><img src='$wpimage'></td>\n";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WPViewReport&amp;report_id=$report_id'>".$report['report_name']."</a></td>\n";
        echo "<td align=center><nobr><a href='modules.php?name=$module_name&amp;op=WPViewProject&amp;project_id=".$project['project_id']."'>".$project['project_name']."</a></nobr></td>\n";
        echo "<td align=center><nobr>".$reporttype['type_name']."</nobr></td>\n";
        echo "<td align=center><nobr>".$reportstatus['status_name']."</nobr></td></tr>\n";
    }
    echo "<tr><form action='modules.php?name=$module_name' method='post'>\n";
    echo "<input type='hidden' name='op' value='WPViewReportList'>\n";
    echo "<input type='hidden' name='column' value='$column'>\n";
    echo "<input type='hidden' name='direction' value='$direction'>\n";
    echo "<input type='hidden' name='per_page' value='$per_page'>\n";
    echo "<td bgcolor='$bgcolor2' colspan='5' width='100%'>\n";
    echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._WP_PAGE."</strong> <select name='page' onChange='submit()'>";
    for($i=1; $i<=$total_pages; $i++){
        if($i==$page){ $sel = "selected"; } else { $sel = ""; }
        echo "<option value='$i' $sel>$i</option>";
    }
    echo "</select> <strong>"._WP_OF." $total_pages</strong></td>\n";
    echo "</form>\n";
    echo "<form action='modules.php?name=$module_name' method='post'>\n";
    echo "<input type='hidden' name='op' value='WPViewReportList'>\n";
    echo "<input type='hidden' name='type_id' value='$type_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2'><strong>"._WP_SORT.":</strong> <select name='column'>\n";
    if($column == "report_id") $selcolumn1 = "selected";
    echo "<option value='report_id' $selcolumn1>"._WP_REPORTID."</option>\n";
    if($column == "project_id") $selcolumn2 = "selected";
    echo "<option value='project_id' $selcolumn2>"._WP_PROJECTID."</option>\n";
    if($column == "type_id") $selcolumn3 = "selected";
    echo "<option value='type_id' $selcolumn3>"._WP_TYPEID."</option>\n";
    if($column == "status_id") $selcolumn4 = "selected";
    echo "<option value='status_id' $selcolumn4>"._WP_STATUSID."</option>\n";
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
    if($per_page == "ALL") $selperpage6 = "selected";
    echo "<option value='ALL' $selperpage6>"._WP_ALL."</option>\n";
    echo "</select> <input type='submit' value='"._WP_SORT."'></td>\n";
    echo "</form>\n";
    echo "</tr></table>\n";
    echo "</td></tr>\n";
} else {
    echo "<tr><td align='center' colspan='5' width='100%'>"._WP_NOREPORTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>