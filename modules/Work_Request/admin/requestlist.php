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

if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "project_id";
if(!$direction) $direction = "desc";
include_once("header.php");
wradmin_menu();
echo "<br />\n";
title(_WR_REQUESTLIST);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' bgcolor='$bgcolor2'><nobr><strong>"._WR_REQUESTOPTIONS."</strong></nobr></td></tr>\n";
$requestrows = $db->sql_numrows($db->sql_query("select request_id from ".$prefix."_nsnwr_requests"));
$wrimage = wrimage("stats.png");
echo "<tr><td><img src='$wrimage'></td><td colspan='2' width='100%'><nobr>"._WR_TOTALREQUESTS.": <strong>$requestrows</strong></nobr></td></tr>\n";
echo "</table>";
CloseTable();
echo "<br />\n";
$total_pages = ($requestrows / $per_page);
$total_pages_quotient = ($requestrows % $per_page);
if($total_pages_quotient != 0){
    $total_pages = ceil($total_pages);
}
$start_list = ($per_page * ($page-1));
$end_list = $per_page;
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%' colspan='2'><nobr><strong>"._WR_REQUESTLIST."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_STATUS."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_TYPE."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_FUNCTIONS."</strong></td></tr>\n";
if($requestrows > 0){
    $reviewresult = $db->sql_query("select request_id, request_name, project_id, type_id, status_id from ".$prefix."_nsnwr_requests order by $column $direction limit $start_list, $end_list");
    while (list($request_id, $request_name, $project_id, $type_id, $status_id) = $db->sql_fetchrow($reviewresult)){
	$status = wrrequeststatus_info($status_id);
	$project = wrproject_info($project_id);
	$type = wrrequesttype_info($type_id);
	$members = $db->sql_numrows($db->sql_query("select member_id from ".$prefix."_nsnwr_requests_members where request_id='$request_id'"));
	$wrimage = wrimage("request.png");
	if ($request_name == "") { $request_name = "----------"; }
	echo "<tr><td><img src='$wrimage'></td><td width='100%'>$request_name</td>\n";
	if($status['status_name'] == ""){ $status['status_name'] = _WR_NA; }
        echo "<td align='center'><nobr><a href='".$admin_file.".php?op=WRProjectList'>".$project['project_name']."</a></nobr></td>\n";
	echo "<td align=center><a href='".$admin_file.".php?op=WRRequestStatusList'>".$status['status_name']."</a></td>\n";
	if($type['type_name'] == ""){ $type['type_name'] = _WR_NA; }
	echo "<td align=center><nobr><a href='".$admin_file.".php?op=WRRequestTypeList'>".$type['type_name']."</a></td>\n";
	echo "<td align=center><nobr>[ <a href='".$admin_file.".php?op=WRRequestEdit&request_id=$request_id'>"._WR_EDIT."</a>";
	echo " | <a href='".$admin_file.".php?op=WRRequestRemove&request_id=$request_id'>"._WR_DELETE."</a> ]</td></tr>\n";
    }
    echo "<form method='post' action='".$admin_file.".php'>\n";
    echo "<input type='hidden' name='op' value='WRRequestList'>\n";
    echo "<input type='hidden' name='column' value='$column'>\n";
    echo "<input type='hidden' name='direction' value='$direction'>\n";
    echo "<input type='hidden' name='per_page' value='$per_page'>\n";
    echo "<tr><td colspan='6' width='100%' bgcolor='$bgcolor2'>\n";

    echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._WR_PAGE."</strong> <select name='page' onChange='submit()'>\n";
    for($i=1; $i<=$total_pages; $i++){
	if($i==$page){ $sel = "selected"; } else { $sel = ""; }
	echo "<option value='$i' $sel>$i</option>\n";
    }
    echo "</select> <strong>"._WR_OF." $total_pages</strong></td>\n";
    echo "</form>\n";

    echo "<form method='post' action='".$admin_file.".php'>\n";
    echo "<input type='hidden' name='op' value='WRRequestList'>\n";
    echo "<td align='right' bgcolor='$bgcolor2'><strong>"._WR_SORT.":</strong> <select name='column'>\n";
    if($column == "request_id") $selcolumn1 = "selected";
    echo "<option value='request_id' $selcolumn1>"._WR_REQUESTID."</option>\n";
    if($column == "project_id") $selcolumn2 = "selected";
    echo "<option value='project_id' $selcolumn2>"._WR_PROJECTID."</option>\n";
    if($column == "status_id") $selcolumn3 = "selected";
    echo "<option value='status_id' $selcolumn3>"._WR_STATUSID."</option>\n";
    if($column == "priority_id") $selcolumn4 = "selected";
    echo "<option value='type_id' $selcolumn4>"._WR_TYPEID."</option>\n";
    echo "</select> <select name='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<option value='asc' $seldirection1>"._WR_ASC."</option>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<option value='desc' $seldirection2>"._WR_DESC."</option>\n";
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
    echo "</select> <input type='submit' value='"._WR_SORT."'></td></tr>\n";
    echo "</form>\n";
    echo "</tr></table>\n";

    echo "</td></tr>\n";
} else {
    echo "<tr><td colspan=6 width='100%' align='center'>"._WR_NOPROJECTREQUESTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>