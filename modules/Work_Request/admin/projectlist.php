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

include_once("header.php");
wradmin_menu();
echo "<br />\n";
title(_WR_PROJECTLIST);
$projectresult = $db->sql_query("select project_id, project_name, status_id, priority_id from ".$prefix."_nsnwb_projects order by project_name");
$project_total = $db->sql_numrows($projectresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WR_PROJECTOPTIONS."</strong></nobr></td></tr>";
$wrimage = wrimage("options.png");
echo "<tr><td><img src='$wrimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=WRProjectAdd'>"._WR_PROJECTADD."</a></nobr></td></tr>";
$wrimage = wrimage("stats.png");
echo "<tr><td><img src='$wrimage'></td><td colspan='3' width='100%'><nobr>"._WR_TOTALPROJECTS.": <strong>$project_total</strong></nobr></td></tr>";
echo "</table>";
CloseTable();
echo "<br />";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WR_PROJECTLIST."</strong></a></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_REQUESTS."</strong></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_FUNCTIONS."</strong></td></tr>";
if($project_total != 0){
    while (list($project_id, $project_name) = $db->sql_fetchrow($projectresult)) {
        $requestsresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests where project_id='$project_id'");
        $requests = $db->sql_numrows($requestsresult);
        $wrimage = wrimage("project.png");
        echo "<tr><td><img src='$wrimage'></td><td width='100%'>$project_name</td>";
        echo "<td align='center'><a href='".$admin_file.".php?op=WRProjectRequests&amp;project_id=$project_id'>$requests</a></td>";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WRProjectEdit&amp;project_id=$project_id'>"._WR_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WRProjectRemove&amp;project_id=$project_id'>"._WR_DELETE."</a> ]</nobr></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td width='100%' colspan='4' align='center'>"._WR_NOPROJECTS."</td></tr>";
}
echo "</table>";
CloseTable();
include_once("footer.php");

?>