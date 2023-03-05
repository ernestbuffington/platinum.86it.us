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
$wr_config = wrget_configs();
title(_WR_PROJECTLIST);
OpenTable();
echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr>\n";
echo "<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._WR_PROJECTS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_REQUESTS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_LASTSUBMISSION."</strong></nobr></td>\n";
echo "</tr>\n";
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects order by weight");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wrproject_info($project_id);
    $requestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests where project_id='$project_id'");
    $request_total = $db->sql_numrows($requestresult);
    $lastsubmitresult = $db->sql_query("select date_submitted from ".$prefix."_nsnwr_requests where project_id='$project_id' order by date_submitted desc");
    list($last_date) = $db->sql_fetchrow($lastsubmitresult);
    $wrimage = wrimage("project.png");
    echo "<tr><td align='center'><img src='$wrimage'></td><td width='100%'>".$project['project_name']."</td>\n";
    echo "<td align='center'><a href='modules.php?name=$module_name&amp;op=WRViewProject&amp;project_id=$project_id'>$request_total</a></td>\n";
    if($request_total > 0){
        $last_date = date($wr_config['request_date_format'], $last_date);    
    } else {
        $last_date = _WR_NA;
    }
    echo "<td align='center'><nobr>$last_date</nobr></td></tr>\n";
}
echo "<tr><td align='right' bgcolor='$bgcolor2' colspan='4'>\n";
echo "<table width='100%'><tr><td><a href='modules.php?name=$module_name&amp;op=WRViewRequestList'><strong>"._WR_REQUESTLISTVIEW."</strong></a></td>\n";
echo "<td align='right'><a href='modules.php?name=$module_name&amp;op=WRRequestMap'><strong>"._WR_VIEWALL."</strong></a></td></tr>\n";
echo "</table>\n";
echo "</td></tr>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>