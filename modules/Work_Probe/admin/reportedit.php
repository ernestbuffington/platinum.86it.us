<?php

/********************************************************/
/* NSN Work Probe                                       */
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
$report = wpreport_info($report_id);
$report['report_name'] = wpunhtmlentities($report['report_name']);
$report['report_description'] = wpunhtmlentities($report['report_description']);
$report['submitter_name'] = wpunhtmlentities($report['submitter_name']);
wpadmin_menu();
echo "<br />\n";
title(_WP_REPORTEDIT);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPReportUpdate'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_PROJECT.":</td>\n";
echo "<td><select name='project_id'>\n";
$projectlist = $db->sql_query("select project_id, project_name from ".$prefix."_nsnwb_projects order by project_name");
while(list($p_project_id, $p_project_name) = $db->sql_fetchrow($projectlist)){
    if($p_project_id == $report['project_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$p_project_id' $sel>$p_project_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_TYPE.":</td>\n";
echo "<td><select name='type_id'>\n";
$typelist = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwp_reports_types order by type_name");
while(list($t_type_id, $t_type_name) = $db->sql_fetchrow($typelist)){
    if($t_type_id == $report['type_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$t_type_id' $sel>$t_type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
$statuslist = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwp_reports_status order by status_name");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    if($s_status_id == $report['status_id']){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$s_status_id' $sel>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_NAME.":</td>\n";
echo "<td><input type='text' name='submitter_name' size='30' value=\"".$report['submitter_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_EMAILADDRESS.":</td>\n";
echo "<td><input type='text' name='submitter_email' size='30' value=\"".$report['submitter_email']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_SUMMARY.":</td>\n";
echo "<td><input type='text' name='report_name' size='30' value=\"".$report['report_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_DESCRIPTION.":</td>\n";
echo "<td><textarea name='report_description' cols='60' rows='10' wrap='virtual'>".$report['report_description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db->sql_query("select member_id, member_name from ".$prefix."_nsnwb_members order by member_name");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    $memberexresult = $db->sql_query("SELECT member_id FROM ".$prefix."_nsnwp_reports_members WHERE member_id='$member_id' AND report_id='$report_id'");
    $numrows = $db->sql_numrows($memberexresult);
    if($numrows < 1){ echo "<option value='$member_id'>$member_name</option>\n"; }
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WP_REPORTUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
echo "<br />\n";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPReportMembers'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<tr>\n";
echo "<td bgcolor='$bgcolor2' width='100%' colspan='2'><strong>"._WP_REPORTMEMBERS."</strong></a></td>\n";
echo "<td align='center' bgcolor='$bgcolor2'><strong>"._WP_DELETE."</strong></td>\n";
echo "</tr>\n";
$membersresult = $db->sql_query("select member_id from ".$prefix."_nsnwp_reports_members where report_id='$report_id' order by member_id");
$numrows = $db->sql_numrows($membersresult);
if($numrows > 0){
    while (list($member_id, $position_id) = $db->sql_fetchrow($membersresult)){
        $member = wpmember_info($member_id);
        $wpimage = wpimage("member.png");
        echo "<input type='hidden' name='member_ids[]' value='$member_id'>\n";
        echo "<tr><td><img src='$wpimage'></td><td width='100%'>".$member['member_name']."</td>\n";
        echo "<td align='center'><nobr><input name='delete_member_ids[]' type='checkbox' value='$member_id'></td></tr>\n";
    }
    echo "<tr><td colspan='3' width='100%' align='right' bgcolor='$bgcolor2'><input type='submit' value='"._WP_DELETE."'></td></tr>\n";
} else {
    echo "<tr><td colspan='3' width='100%' align='center'>"._WP_NOREPORTMEMBERS."</td></tr>\n";
}
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>