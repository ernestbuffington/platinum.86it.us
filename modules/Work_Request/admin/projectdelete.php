<?php

/********************************************************/
/* NSN Work Request                                     */
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

$db->sql_query("DELETE FROM ".$prefix."_nsnwb_projects WHERE project_id='$project_id'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_projects");
$db->sql_query("DELETE FROM ".$prefix."_nsnwb_projects_members WHERE project_id='$project_id'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_projects_members");
$taskresult = $db->sql_query("select task_id from ".$prefix."_nsnwb_tasks where project_id='$project_id'");
while (list($task_id) = $db->sql_fetchrow($taskresult)) {
    $db->sql_query("DELETE FROM ".$prefix."_nsnwb_tasks WHERE task_id='$task_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_tasks");
    $db->sql_query("DELETE FROM ".$prefix."_nsnwb_tasks_members WHERE task_id='$task_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_tasks_members");
}
$reportresult = $db->sql_query("select report_id from ".$prefix."_nsnwp_reports where project_id='$project_id'");
while (list($report_id) = $db->sql_fetchrow($reportresult)) {
    $db->sql_query("DELETE FROM ".$prefix."_nsnwp_reports WHERE report_id='$report_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwp_reports");
    $db->sql_query("DELETE FROM ".$prefix."_nsnwp_reports_members WHERE report_id='$report_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwp_reports_members");
    $db->sql_query("DELETE FROM ".$prefix."_nsnwp_reports_comments WHERE report_id='$report_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwp_reports_comments");
}
$requestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests where project_id='$project_id'");
while (list($request_id) = $db->sql_fetchrow($requestresult)) {
    $db->sql_query("DELETE FROM ".$prefix."_nsnwr_requests WHERE request_id='$request_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwr_requests");
    $db->sql_query("DELETE FROM ".$prefix."_nsnwr_requests_members WHERE request_id='$request_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwr_requests_members");
    $db->sql_query("DELETE FROM ".$prefix."_nsnwr_requests_comments WHERE request_id='$request_id'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwr_requests_comments");
}
header("Location: ".$admin_file.".php?op=WRProjectList");

?>