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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db, $bgcolor2;
$modname = "Work_Board";
get_lang($modname);
require_once("modules/$modname/includes/functions.php");
$content = "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
$content .= "<tr>\n";
$content .= "<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._WB_PROJECTNAME."</strong></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WB_REPORTS."</strong></nobr></td>\n";
if (is_active("Work_Probe")) {
    $content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WB_REQUESTS."</strong></nobr></td>\n";
}
if (is_active("Work_Request")) {
    $content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WB_TASKS."</strong></nobr></td>\n";
}
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WB_STATUS."</strong></nobr></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WB_PROGRESSBAR."</strong></nobr></td>\n";
$content .= "</tr>\n";
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects WHERE featured='1' ORDER BY weight");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wbproject_info2($project_id);
    $projectstatus = wbprojectstatus_info($project['status_id']);
    $wbimage = wbimage2("project.png", $modname);
    $content .= "<tr><td align='center'><img src='$wbimage'></td>\n";
    $content .= "<td width='100%'>".$project['project_name']."</td>\n";
    if (is_active("Work_Probe")) {
        $numreports = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnwp_reports WHERE project_id='$project_id'"));
        if (!$numreports) { $numreports = 0; }
        $content .= "<td align='center' width='100%'><a href='modules.php?name=Work_Probe&amp;op=WPViewProject&amp;project_id=$project_id'>$numreports</a></td>\n";
    }
    if (is_active("Work_Request")) {
        $numrequests = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests WHERE project_id='$project_id'"));
        if (!$numrequests) { $numrequests = 0; }
        $content .= "<td align='center' width='100%'><a href='modules.php?name=Work_Request&amp;op=WRViewProject&amp;project_id=$project_id'>$numrequests</a></td>\n";
    }
    $numtasks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnwb_tasks WHERE project_id='$project_id'"));
    if (!$numtasks) { $numtasks = 0; }
    $content .= "<td align='center' width='100%'><a href='modules.php?name=$modname&amp;op=WBViewProject&amp;project_id=$project_id'>$numtasks</a></td>\n";
    if($projectstatus['status_name'] == ""){ $projectstatus['status_name'] = _WB_NA; }
    $content .= "<td align='center'>".$projectstatus['status_name']."</td>\n";
    $wbimage = wbimage2("bar_left.png", $modname);
    $content .= "<td><nobr><img src='$wbimage' height='7' width='1'>";
    if($project['project_percent'] == 0){
        $wbimage = wbimage2("bar_center_red.png", $modname);
        $content .= "<img src='$wbimage' height='7' width='100' alt='0"._WB_PERCENT." "._WB_COMPLETED."' title='0"._WB_PERCENT." "._WB_COMPLETED."'>";
    } else {
        if($project['project_percent'] > 100){ $project_percent = 100; } else { $project_percent = $project['project_percent']; }
        $wbimage = wbimage2("bar_center_grn.png", $modname);
        $content .= "<img src='$wbimage' height='7' width='".$project_percent."' alt='".$project_percent.""._WB_PERCENT." "._WB_COMPLETED."' title='".$project_percent.""._WB_PERCENT." "._WB_COMPLETED."'>";
        if($project_percent < 100){
            $percent_incomplete = 100 - $project_percent;
            $wbimage = wbimage2("bar_center_red.png", $modname);
            $content .= "<img src='$wbimage' height='7' width='".$percent_incomplete."' alt='".$project_percent.""._WB_PERCENT." "._WB_COMPLETED."' title='".$project_percent.""._WB_PERCENT." "._WB_COMPLETED."'>";
        }
    }
    $wbimage = wbimage2("bar_right.png", $modname);
    $content .= "<img src='$wbimage' height='7' width='1'></nobr></td>\n";
    $content .= "</tr>\n";
}
$content .=  "</table>\n";
?>
