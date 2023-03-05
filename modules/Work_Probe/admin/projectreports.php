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
$projectresult = $db->sql_query("select project_name, project_description from ".$prefix."_nsnwb_projects where project_id='$project_id'");
list($project_name, $project_description) = $db->sql_fetchrow($projectresult);
wpadmin_menu();
echo "<br />\n";
title(_WP_PROJECTREPORTLIST);
$reportresult = $db->sql_query("select report_id, report_name, type_id, status_id from ".$prefix."_nsnwp_reports where project_id='$project_id' order by report_name");
$report_total = $db->sql_numrows($reportresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><nobr><strong>"._WP_PROJECT."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_FUNCTIONS."</strong></td></tr>\n";
$wpimage = wpimage("project.png");
echo "<tr><td><img src='$wpimage'></td>\n";
echo "<td width='100%'><a href='".$admin_file.".php?op=WPProjectList'>"._WP_PROJECTS."</a> / <strong>$project_name</strong></td>\n";
echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WPProjectEdit&amp;project_id=$project_id'>"._WP_EDIT."</a> | <a href='".$admin_file.".php?op=WPProjectRemove&amp;project_id=$project_id'>"._WP_DELETE."</a> ]</nobr></td></tr>\n";
echo "<tr><td colspan='5' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WP_PROJECTOPTIONS."</strong></nobr></td></tr>\n";
$wpimage = wpimage("stats.png");
echo "<tr><td><img src='$wpimage'></td><td colspan='4' width='100%'><nobr>"._WP_TOTALREPORTS.": <strong>$report_total</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WP_PROJECTREPORTS."</strong></a></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_TYPE."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_FUNCTIONS."</strong></td></tr>\n";
if($report_total != 0){
    while (list($report_id, $report_name, $type_id, $status_id) = $db->sql_fetchrow($reportresult)) {
        echo "<tr><td><img src='$wpimage'></td>\n";
        echo "<td width='100%'>$report_name</td>\n";
        $status = wpreportstatus_info($status_id);
        if($status['status_name'] == "") { $status['status_name'] = "<i>N/A</i>"; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WPReportStatusList'>".$status['status_name']."</a></td>\n";
        $type = wpreporttype_info($type_id);
        if($type['type_name'] == "") { $type['type_name'] = "<i>N/A</i>"; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WPReportTypeList'>".$type['type_name']."</a></td>\n";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WPReportEdit&amp;report_id=$report_id'>"._WP_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WPReportRemove&amp;report_id=$report_id'>"._WP_DELETE."</a> ]</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td width='100%' colspan='4' align='center'>"._WP_NOPROJECTREPORTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>