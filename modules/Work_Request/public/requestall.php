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
title(_WR_REQUESTLIST);
$requestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests");
$request_total = $db->sql_numrows($requestresult);
if(!$page) $page = 1;
if(!$per_page) $per_page = 25;
if(!$column) $column = "request_id";
if(!$direction) $direction = "desc";
if($per_page != "ALL"){
    $total_pages = ($request_total / $per_page);
    $total_pages_quotient = ($request_total % $per_page);
    if($total_pages_quotient != 0){
        $total_pages = ceil($total_pages);
    }
    $start_list = ($per_page * ($page-1));
    $end_list = $per_page;
}
if($per_page == "ALL"){ $limit = ""; } else { $limit = "limit $start_list, $end_list"; }
OpenTable();
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr>\n";
echo "<td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WR_REQUESTLIST."</strong></nobr></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_PROJECT."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_TYPE."</strong></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_STATUS."</strong></td>\n";
echo "</tr>\n";
if($request_total > 0){
    $requestresult = $db->sql_query("select request_id from ".$prefix."_nsnwr_requests order by $column $direction $limit");
    while (list($request_id) = $db->sql_fetchrow($requestresult)){
        $request = wrrequest_info($request_id);
        $requeststatus = wrrequeststatus_info($request['status_id']);
        $project = wrproject_info($request['project_id']);
        $requesttype = wrrequesttype_info($request['type_id']);
        if($request['request_name'] == "") { $request['request_name'] = "----------"; }
        if($requeststatus['status_name'] == "") { $requeststatus['status_name'] = _WR_NA; }
        if($requesttype['type_name'] == "") { $requesttype['type_name'] = _WR_NA; }
        $wrimage = wrimage("request.png");
        echo "<tr><td><img src='$wrimage'></td>\n";
        echo "<td width='100%'><a href='modules.php?name=$module_name&amp;op=WRViewRequest&amp;request_id=$request_id'>".$request['request_name']."</a></td>\n";
        echo "<td align='center'><nobr><a href='modules.php?name=$module_name&amp;op=WRViewProject&amp;project_id=".$project['project_id']."'>".$project['project_name']."</a></nobr></td>\n";
        echo "<td align='center'><nobr>".$requesttype['type_name']."</nobr></td>\n";
        echo "<td align='center'><nobr>".$requeststatus['status_name']."</nobr></td></tr>\n";
    }
    echo "<tr><form action='modules.php?name=$module_name' method='post'>\n";
    echo "<input type='hidden' name='op' value='WRViewRequestList'>\n";
    echo "<input type='hidden' name='column' value='$column'>\n";
    echo "<input type='hidden' name='direction' value='$direction'>\n";
    echo "<input type='hidden' name='per_page' value='$per_page'>\n";
    echo "<td bgcolor='$bgcolor2' colspan='5' width='100%'>\n";
    echo "<table width='100%'><tr><td bgcolor='$bgcolor2'><strong>"._WR_PAGE."</strong> <select NAME='page' onChange='submit()'>\n";
    for($i=1; $i<=$total_pages; $i++){
        if($i==$page){ $sel = "selected"; } else { $sel = ""; }
        echo "<option value='$i' $sel>$i</option>\n";
    }
    echo "</select> <strong>"._WR_OF." $total_pages</strong></td></form>\n";
    echo "<form action='modules.php?name=$module_name' method='post'>\n";
    echo "<input type='hidden' name='op' value='WRViewRequestList'>\n";
    echo "<input type='hidden' name='type_id' value='$type_id'>\n";
    echo "<td align='right' bgcolor='$bgcolor2'><strong>"._WR_SORT.":</strong> <select NAME='column'>\n";
    if($column == "request_id") $selcolumn1 = "selected";
    echo "<option value='request_id' $selcolumn1>"._WR_REQUESTID."</option>\n";
    if($column == "project_id") $selcolumn2 = "selected";
    echo "<option value='project_id' $selcolumn2>"._WR_PROJECTID."</option>\n";
    if($column == "type_id") $selcolumn3 = "selected";
    echo "<option value='type_id' $selcolumn3>"._WR_TYPEID."</option>\n";
    if($column == "status_id") $selcolumn4 = "selected";
    echo "<option value='status_id' $selcolumn4>"._WR_STATUSID."</option>\n";
    echo "</select> <select NAME='direction'>\n";
    if($direction == "asc") $seldirection1 = "selected";
    echo "<option value='asc' $seldirection1>"._WR_ASC."</option>\n";
    if($direction == "desc") $seldirection2 = "selected";
    echo "<option value='desc' $seldirection2>"._WR_DESC."</option>\n";
    echo "</select> <select NAME='per_page'>\n";
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
    if($per_page == "ALL") $selperpage6 = "selected";
    echo "<option value='ALL' $selperpage6>"._WR_ALL."</option>\n";
    echo "</select> <input type='submit' value='"._WR_SORT."'></td>\n";
    echo "</form>\n";
    echo "</tr></table>\n";
    echo "</td></tr>\n";
} else {
    echo "<tr><td align='center' colspan='5' width='100%'>"._WR_NOREQUESTS."</td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>