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
$request = wrrequest_info($request_id);
$request['request_name'] = wrunhtmlentities($request['request_name']);
$request['request_description'] = wrunhtmlentities($request['request_description']);
$request['submitter_name'] = wrunhtmlentities($request['submitter_name']);
wradmin_menu();
echo "<br />";
title(_WR_REQUESTEDIT);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='WRRequestUpdate'>";
echo "<input type='hidden' name='request_id' value='$request_id'>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_PROJECT.":</td>";
echo "<td><select name='project_id'>\n";
$projectlist = $db->sql_query("select project_id, project_name from ".$prefix."_nsnwb_projects order by project_name");
while(list($p_project_id, $p_project_name) = $db->sql_fetchrow($projectlist)){
    if($p_project_id == $request['project_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$p_project_id' $sel>$p_project_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_TYPE.":</td>";
echo "<td><select name='type_id'>";
$typelist = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwr_requests_types order by type_name");
while(list($t_type_id, $t_type_name) = $db->sql_fetchrow($typelist)){
    if($t_type_id == $request['type_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$t_type_id' $sel>$t_type_name</option>";
}
echo "</select></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_STATUS.":</td>";
echo "<td><select name='status_id'>";
$statuslist = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwr_requests_status order by status_name");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    if($s_status_id == $request['status_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_status_id' $sel>$s_status_name</option>";
}
echo "</select></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_NAME.":</td>";
echo "<td><input type='text' name='submitter_name' size='30' value=\"".$request['submitter_name']."\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_EMAILADDRESS.":</td>";
echo "<td><input type='text' name='submitter_email' size='30' value=\"".$request['submitter_email']."\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_SUMMARY.":</td>";
echo "<td><input type='text' name='request_name' size='30' value=\"".$request['request_name']."\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WR_DESCRIPTION.":</td>";
echo "<td><textarea name='request_description' cols='60' rows='10' wrap='virtual'>".$request['request_description']."</textarea></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WR_ASSIGNMEMBERS.":</td>";
echo "<td><select name='member_ids[]' size='10' multiple>";
$memberlistresult = $db->sql_query("select member_id, member_name from ".$prefix."_nsnwb_members order by member_name");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    $memberexresult = $db->sql_query("SELECT member_id FROM ".$prefix."_nsnwr_requests_members WHERE member_id='$member_id' AND request_id='$request_id'");
    $numrows = $db->sql_numrows($memberexresult);
    if($numrows < 1){
        echo "<option value='$member_id'>$member_name</option>";
    }
}
echo "</select></td></tr>";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WR_REQUESTUPDATE."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
echo "<br />";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='WRRequestMembers'>";
echo "<input type='hidden' name='request_id' value='$request_id'>";
echo "<tr>";
echo "<td bgcolor='$bgcolor2' width='100%' colspan='2'><strong>"._WR_REQUESTMEMBERS."</strong></a></td>";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WR_DELETE."</strong></td>";
echo "</tr>";
$membersresult = $db->sql_query("select member_id from ".$prefix."_nsnwr_requests_members where request_id='$request_id' order by member_id");
$numrows = $db->sql_numrows($membersresult);
if($numrows > 0){
    while (list($member_id, $position_id) = $db->sql_fetchrow($membersresult)){
        $member = wrmember_info($member_id);
        $wrimage = wrimage("member.png");
        echo "<tr><td><input type='hidden' name='member_ids[]' value='$member_id'><img src='$wrimage'></td><td width='100%'>".$member['member_name']."</td>";
        echo "<td align=center><nobr><input name='delete_member_ids[]' type='checkbox' value='$member_id'></td></tr>";
    }
    echo "<tr><td colspan='3' width='100%' align='right' bgcolor='$bgcolor2'><input type='submit' value='"._WR_DELETE."'></td></tr>";
} else {
    echo "<tr><td colspan='3' width='100%' align='center'>"._WR_NOREQUESTMEMBERS."</td></tr>";
}
echo "</form></TABLE>";
CloseTable();
include_once("footer.php");

?>