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
$project = wbproject_info($project_id);
$project['project_name'] = wbunhtmlentities($project['project_name']);
$project['project_description'] = wbunhtmlentities($project['project_description']);
wbadmin_menu();
echo "<br />\n";
title(_WB_EDITPROJECT);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBProjectUpdate'>\n";
echo "<input type='hidden' name='project_id' value='$project_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_PROJECTNAME.":</td>\n";
echo "<td><input type='text' name='project_name' size='30' value=\"".$project['project_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WB_PROJECTDESCRIPTION.":</td>\n";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'>".$project['project_description']."</textarea></td></tr>\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if($project['featured'] == 0) { $sel1 = " selected"; } else { $sel2 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._WB_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0'$sel1>"._WB_NO."</option>\n";
echo "<option value='1'$sel2>"._WB_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'>\n";
echo "<option value='0'>---------</option>\n";
$prioritylist = $db->sql_query("select priority_id, priority_name from ".$prefix."_nsnwb_projects_priorities order by priority_weight");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
    if($s_priority_id == $project['priority_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_priority_id' $sel>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='project_percent' size='4' value='".$project['project_percent']."'>% "._WB_STATUSPERCENT_CALCULATE."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
echo "<option value='0'>---------</option>\n";
$statuslist = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwb_projects_status order by status_name");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    if($s_status_id == $project['status_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
if ($project['date_started'] > 0) {
    $sday = date("j",$project['date_started']);
    $smon = date("n",$project['date_started']);
    $syear = date("Y",$project['date_started']);
} else {
    $sday = "00";
    $smon = "00";
    $syear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STARTDATE.":</td>\n";
echo "<td><select name='project_start_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    if($i == $smon){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_start_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    if($i == $sday){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_start_year' value='".$syear."' size=4 maxlength=4></td></tr>\n";
if ($project['date_finished'] > 0) {
    $fday = date("j",$project['date_finished']);
    $fmon = date("n",$project['date_finished']);
    $fyear = date("Y",$project['date_finished']);
} else {
    $fday = "00";
    $fmon = "00";
    $fyear = "0000";
}
echo "<tr><td bgcolor='$bgcolor2'>"._WB_FINISHDATE.":</td>\n";
echo "<td><select name='project_finish_month'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    if($i == $fmon){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_finish_day'>\n<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    if($i == $fday){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_finish_year' value='".$fyear."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WB_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db->sql_query("select member_id, member_name from ".$prefix."_nsnwb_members order by member_name");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    $memberexresult = $db->sql_query("SELECT member_id FROM ".$prefix."_nsnwb_projects_members WHERE member_id='$member_id' AND project_id='$project_id'");
    $numrows = $db->sql_numrows($memberexresult);
    if($numrows < 1){
        echo "<option value='$member_id'>$member_name</option>\n";
    }
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WB_UPDATEPROJECT."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();

echo "<br />";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='WBProjectMembers'>";
echo "<input type='hidden' name='project_id' VALUE='$project_id'>";
echo "<tr><td align='left' bgcolor='$bgcolor2' width='100%' colspan='2'><strong>";
echo ""._WB_PROJECTMEMBERS."";
echo "</strong></a></td><td bgcolor='$bgcolor2' align=center><strong>"._WB_POSITION."</strong></td><td align='center' bgcolor='$bgcolor2'><strong>"._WB_DELETE."</strong></td></tr>";
$membersresult = $db->sql_query("select member_id, position_id from ".$prefix."_nsnwb_projects_members where project_id='$project_id' order by member_id");
$numrows = $db->sql_numrows($membersresult);
if($numrows > 0){
    while (list($member_id, $position_id) = $db->sql_fetchrow($membersresult)){
        $member = wbmember_info($member_id);
        $position = wbmemberposition_info($position_id);
        echo "<tr>";
        $wbimage = wbimage("member.png");
        echo "<td><img src='$wbimage'></td><td width='100%'>".$member['member_name']."</td>";
        echo "<td><input type='hidden' name='member_ids[]' VALUE='$member_id'><select name='position_ids[]'>";
        $positionlistresult = $db->sql_query("select position_id, position_name from ".$prefix."_nsnwb_members_positions order by position_name");
        echo "<option value='0'>------</option>";
        while(list($l_position_id, $l_position_name) = $db->sql_fetchrow($positionlistresult)) {
            if($l_position_id == $position_id){ $sel = "selected"; } else { $sel = ""; }
            echo "<option value='$l_position_id' $sel>$l_position_name</option>";
        }
        echo "</select></td>";
        echo "<td align=center><nobr><input name='delete_member_ids[]' type='checkbox' value='$member_id'></td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4' width='100%' align=right bgcolor='$bgcolor2'><input type='submit' value='"._WB_UPDATE."'>";
    echo "<input type='submit' value='"._WB_DELETE."'></td></tr>";
} else {
    echo "<tr><td colspan='4' width='100%' align=center>"._WB_NOPROJECTMEMBERS."</td></tr>";
}
echo "</form></TABLE>";
CloseTable();

@include_once("footer.php");

?>