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
wrtitle(_WR_REQUESTMAP);
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects order by project_name");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wrproject_info($project_id);
    $requestresult = $db->sql_query("select request_id, request_name from ".$prefix."_nsnwr_requests where project_id='$project_id'");
    $request_total = $db->sql_numrows($requestresult);
    echo "<br />\n";
    OpenTable();
    echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
    echo "<tr>\n<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._WR_PROJECT."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_REQUESTS."</strong></nobr></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_LASTSUBMISSION."</strong></nobr></td>\n</tr>\n";
    $wrimage = wrimage("project.png");
    echo "<tr>\n<td align='center'><img src='$wrimage'></td>\n";
    echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WRViewProject&amp;project_id=$project_id'>".$project['project_name']."</a></td>\n";
    echo "<td align='center'><nobr>$request_total</nobr></td>\n";
    if($request_total > 0){
        $lastsubmitresult = $db->sql_query("select date_submitted from ".$prefix."_nsnwr_requests where project_id='$project_id' order by date_submitted desc");
        list($last_date) = $db->sql_fetchrow($lastsubmitresult);
        $last_date = date($wr_config['request_date_format'], $last_date);    
    } else {
       $last_date = _WR_NA;
    }
    echo "<td align='center'><nobr>$last_date</nobr></td>\n</tr>\n";
    echo "<tr>\n<td bgcolor='$bgcolor2' colspan='2'><strong>"._WR_REQUESTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_COMMENTS."</strong></td>\n";
    echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_LASTSUBMISSION."</strong></td>\n</tr>\n";
    if($request_total != 0){
        while (list($request_id, $request_name) = $db->sql_fetchrow($requestresult)) {
            $requestcommentresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests_comments where request_id='$request_id'");
            $requestcomment_total = $db->sql_numrows($requestcommentresult);
            if ($request_name == "") { $request_name = "----------"; }
            $wrimage = wrimage("request.png");
            echo "<tr>\n<td><img src='$wrimage'></td>\n";
            echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WRViewRequest&amp;request_id=$request_id'>$request_name</a></td>\n";
            echo "<td align='center'><nobr>$requestcomment_total</nobr></td>\n";
            if($requestcomment_total > 0){
                $lastsubmitresult = $db->sql_query("select date_submitted from ".$prefix."_nsnwr_requests_comments where request_id='$request_id' order by date_submitted desc");
                list($last_date) = $db->sql_fetchrow($lastsubmitresult);
                $last_date = date($wr_config['request_date_format'], $last_date);    
            } else {
                $last_date = _WR_NA;
            }
            echo "<td align='center'><nobr>$f_last_date</nobr></td>\n</tr>\n";
        }
    } else {
        echo "<tr>\n<td align='center' colspan='4' width='100%'><nobr>"._WR_NOPROJECTREQUESTS."</nobr></td>\n</tr>\n";
    }
    echo "</table>\n";
    echo "</center>\n";
    CloseTable();
}
include_once("footer.php");

?>