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
wptitle(_WP_REPORTMAP);
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects order by project_name");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wpproject_info($project_id);
    $reportresult = $db->sql_query("select report_id, report_name from ".$prefix."_nsnwp_reports where project_id='$project_id'");
    $report_total = $db->sql_numrows($reportresult);
    echo "<br />\n";
    OpenTable();
    echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
    echo "<tr>\n<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._WP_PROJECT."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_REPORTS."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_LASTSUBMISSION."</strong></nobr></td>\n</tr>\n";
    $wpimage = wpimage("project.png");
    echo "<tr>\n<td align='center'><img src='$wpimage'></td>\n";
    echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WPViewProject&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    echo "<td align='center'><nobr>$report_total</nobr></td>\n";
    if($report_total > 0){
        $lastsubmitresult = $db->sql_query("select date_submitted from ".$prefix."_nsnwp_reports where project_id='$project_id' order by date_submitted desc");
        list($last_date) = $db->sql_fetchrow($lastsubmitresult);
        $last_date = date($wp_config['report_date_format'], $last_date);    
    } else {
        $last_date = _WP_NA;
    }
    echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
    echo "<tr>\n<td bgcolor='$bgcolor2' colspan='2'><strong>"._WP_REPORTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_COMMENTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_LASTSUBMISSION."</strong></td>\n</tr>\n";
    if($report_total != 0){
        while (list($report_id, $report_name) = $db->sql_fetchrow($reportresult)) {
            $reportcommentresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports_comments where report_id='$report_id'");
            $reportcomment_total = $db->sql_numrows($reportcommentresult);
            if ($report_name == "") { $report_name = "----------"; }
            $wpimage = wpimage("report.png");
            echo "<tr>\n<td><img src='$wpimage'></td>\n";
            echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WPViewReport&amp;report_id=$report_id'>$report_name</a></td>\n";
            echo "<td align='center'><nobr>$reportcomment_total</nobr></td>\n";
            if($reportcomment_total > 0){
                $lastsubmitresult = $db->sql_query("select date_submitted from ".$prefix."_nsnwp_reports_comments where report_id='$report_id' order by date_submitted desc");
                list($last_date) = $db->sql_fetchrow($lastsubmitresult);
                $last_date = date($wp_config['report_date_format'], $last_date);    
            } else {
                $last_date = _WP_NA;
            }
            echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
        }
    } else {
        echo "<tr>\n<td align='center' colspan='4' width='100%'><nobr>"._WP_NOPROJECTREPORTS."</nobr></td>\n</tr>\n";
    }
    echo "</table>\n";
    echo "</center>\n";
    CloseTable();
}
include_once("footer.php");

?>