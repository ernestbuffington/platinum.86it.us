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
wbadmin_menu();
echo "<br />\n";
title(_WB_PROJECTLIST);
$projectresult = $db->sql_query("SELECT project_id, project_name, weight, featured, status_id, priority_id FROM ".$prefix."_nsnwb_projects ORDER BY weight");
$project_total = $db->sql_numrows($projectresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WB_PROJECTOPTIONS."</strong></nobr></td></tr>\n";
$wbimage = wbimage("options.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=WBProjectAdd'>"._WB_PROJECTADD."</a></nobr></td></tr>\n";
$wbimage = wbimage("stats.png");
echo "<tr><td><img src='$wbimage'></td><td colspan='3' width='100%'><nobr>"._WB_TOTALPROJECTS.": <strong>$project_total</strong></nobr></td></tr>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WB_PROJECTS."</strong></a></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_WEIGHT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_PRIORITY."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_TASKS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WB_FUNCTIONS."</strong></td></tr>\n";
if($project_total != 0){
    while (list($project_id, $project_name, $weight, $featured, $status_id, $priority_id) = $db->sql_fetchrow($projectresult)) {
        $tasksresult = $db->sql_query("select task_id from ".$prefix."_nsnwb_tasks where project_id='$project_id'");
        $tasks = $db->sql_numrows($tasksresult);
        $projectstatus = wbprojectstatus_info($status_id);
        $projectpriority = wbprojectpriority_info($priority_id);
            $weight1 = $weight - 1;
            $weight3 = $weight + 1;
            $res = $db->sql_query("select project_id from ".$prefix."_nsnwb_projects where weight='$weight1'");
            list ($pid1) = $db->sql_fetchrow($res);
            $con1 = "$pid1";
            $res2 = $db->sql_query("select project_id from ".$prefix."_nsnwb_projects where weight='$weight3'");
            list ($pid2) = $db->sql_fetchrow($res2);
            $con2 = "$pid2";
        if($featured > 0) { $project_name = "<strong>$project_name</strong>"; }
        $wbimage = wbimage("project.png");
        echo "<tr><td><img src='$wbimage'></td><td width='100%'>$project_name</td>\n";
        echo "<td align='center'><nobr>";
            if ($con1) {
                echo"<a href='".$admin_file.".php?op=WBProjectOrder&amp;weight=$weight&amp;pid=$project_id&amp;weightrep=$weight1&amp;pidrep=$con1'><img src='modules/$module_name/images/weight_up.png' border='0' hspace='3'></a>";
            }
            if ($con2) {
                echo "<a href='".$admin_file.".php?op=WBProjectOrder&amp;weight=$weight&amp;pid=$project_id&amp;weightrep=$weight3&amp;pidrep=$con2'><img src='modules/$module_name/images/weight_dn.png' border='0' hspace='3'></a>";
            }
        echo"</nobr></td>\n";
        if($projectstatus['status_name'] == "") { $projectstatus['status_name'] = _WB_NA; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WBProjectStatusList'>".$projectstatus['status_name']."</a></td>\n";
        if($projectpriority['priority_name'] == "") { $projectpriority['priority_name'] = _WB_NA; }
        echo "<td align='center'><a href='".$admin_file.".php?op=WBProjectPriorityList'>".$projectpriority['priority_name']."</a></td>\n";
        echo "<td align='center'><a href='".$admin_file.".php?op=WBProjectTasks&amp;project_id=$project_id'>$tasks</a></td>\n";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WBProjectEdit&amp;project_id=$project_id'>"._WB_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WBProjectRemove&amp;project_id=$project_id'>"._WB_DELETE."</a> ]</nobr></td></tr>\n";
    }
} else {
    echo "<tr><td width='100%' colspan='4' align='center'>"._WB_NOPROJECTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>