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
$project = wrproject_info($project_id);
title(_WR_PROJECTVIEW.": ".$project['project_name']);
$projectrequestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests where project_id='$project_id'");
$project_requests = $db->sql_numrows($projectrequestresult);
OpenTable();
echo "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WR_PROJECTNAME."</strong></nobr></td></tr>\n";
$wrimage = wrimage("project.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td width='100%'><nobr>".$project['project_name']."</nobr></td></tr>\n";
if($project['project_description'] != ""){
    $wrimage = wrimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wrimage'></td>\n";
    echo "<td width='100%'>".$project['project_description']."</td></tr>\n";
}
$wrimage = wrimage("stats.png");
echo "<tr><td align='center'><img src='$wrimage'></td><td width='100%'><nobr>"._WR_REQUESTS.": <strong>$project_requests</strong></nobr></td></tr>\n";
if($project['date_started'] != '0'){
    $start_date = date($wr_config['request_date_format'], $project['date_started']);
} else {
    $start_date = _WR_NA;
}
$wrimage = wrimage("date.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WR_STARTDATE.": <strong>$start_date</strong></nobr></td></tr>\n";
if($project['date_finished'] != '0'){
    $finish_date = date($wr_config['request_date_format'], $project['date_finished']);
} else {
    $finish_date = _WR_NA;
}
$wrimage = wrimage("date.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td width='100%' colspan='5'><nobr>"._WR_FINISHDATE.": <strong>$finish_date</strong></nobr></td></tr>\n";
$wrimage = wrimage("options.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td width='100%'><nobr><a href='modules.php?name=$module_name&amp;op=WRRequestSubmit&amp;project_id=".$project['project_id']."'>"._WR_SUBMITAREQUEST."</a></nobr></td></tr>\n";
echo "</table>\n";
echo "<br />\n";
if(!$column) $column = "request_name";
if(!$direction) $direction = "asc";
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WR_REQUESTS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_TYPE."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_STATUS."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_SUBMITTED."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WR_COMMENTS."</strong></nobr></td></tr>\n";
$requestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests where project_id='$project_id' order by $column $direction");
$request_total = $db->sql_numrows($requestresult);
if($request_total != 0){
    while (list($request_id) = $db->sql_fetchrow($requestresult)) {
        $request = wrrequest_info($request_id);
        $requesttype = wrrequesttype_info($request['type_id']);
        $requeststatus = wrrequeststatus_info($request['status_id']);
        if ($request['request_name'] == "") { $request['request_name'] = "----------"; }
        if ($requesttype['type_name'] == "") { $requesttype['type_name'] = _WR_NA; }
        if ($requeststatus['status_name'] == "") { $requeststatus['status_name'] = _WR_NA; }
        $last_date = date($wr_config['request_date_format'], $request['date_submitted']);    
        $comments = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests_comments WHERE request_id='$request_id'"));
        $wrimage = wrimage("request.png");
        echo "<tr><td><img src='$wrimage'></td>\n";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WRViewRequest&amp;request_id=$request_id'>".$request['request_name']."</a></td>\n";
        echo "<td align='center'><nobr>".$requesttype['type_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>".$requeststatus['status_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>$last_date</nobr></td>\n";
        echo "<td align='center'><nobr>$comments</nobr></td></tr>\n";
    }
    echo "<form method='post' action='modules.php'>\n";
    echo "<input type='hidden' name='name' value='$module_name'>\n";
    echo "<input type='hidden' name='op' value='WRViewProject'>\n";
    echo "<input type='hidden' name='project_id' value='$project_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2' width='100%' colspan='6'><strong>"._WR_SORT.":</strong> ";
    echo "<SELECT NAME='column'>\n";
    if($column == "request_name") $selcolumn1 = "selected";
    echo "<OPTION VALUE='request_name' $selcolumn1>"._WR_REQUESTNAME."</OPTION>\n";
    if($column == "status_id") $selcolumn2 = "selected";
    echo "<OPTION VALUE='status_id' $selcolumn2>"._WR_STATUS."</OPTION>\n";
    if($column == "type_id") $selcolumn3 = "selected";
    echo "<OPTION VALUE='type_id' $selcolumn3>"._WR_TYPE."</OPTION>\n";
    if($column == "date_submitted") $selcolumn4 = "selected";
    echo "<OPTION VALUE='date_submitted' $selcolumn4>"._WR_SUBMITTED."</OPTION>\n";
    echo "</SELECT> ";
    echo "<SELECT NAME='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<OPTION VALUE='asc' $seldirection1>"._WR_ASC."</OPTION>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<OPTION VALUE='desc' $seldirection2>"._WR_DESC."</OPTION>\n";
    echo "</SELECT> ";
    echo "<input type='submit' value='"._WR_SORT."'>\n";
    echo "</td></form></tr>\n";
    echo "<tr>\n";
} else {
    echo "<tr><td align='center' colspan='6' width='100%'><nobr>"._WR_NOPROJECTREQUESTS."</nobr></td></tr>\n";
}
echo "</table>";
CloseTable();
include_once("footer.php");

?>