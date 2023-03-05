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
wbadmin_menu();
echo "<br />\n";
title(_WB_PROJECTADD);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBProjectInsert'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_PROJECTNAME.":</td>\n";
echo "<td><input type='text' name='project_name' size='30'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WB_PROJECTDESCRIPTION.":</td>\n";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'></textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0' selected>"._WB_NO."</option>\n";
echo "<option value='1'>"._WB_YES."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_PRIORITY.":</td>\n";
echo "<td><select name='priority_id'>\n";
echo "<option value='0'>---------</option>\n";
$prioritylist = $db->sql_query("select priority_id, priority_name from ".$prefix."_nsnwb_projects_priorities order by priority_weight");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
    echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STATUSPERCENT.":</td>\n";
echo "<td><input type='text' name='project_percent' size='4'>% "._WB_STATUSPERCENT_CALCULATE."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STATUS.":</td>\n";
echo "<td><select name='status_id'>\n";
echo "<option value='0'>---------</option>\n";
$statuslist = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwb_projects_status order by status_name");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
    echo "<option value='$s_status_id'>$s_status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_STARTDATE.":</td>\n";
echo "<td><select name='project_start_month'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    if($i == date("m")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><select name='project_start_day'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    if($i == date("d")){ $sel = "selected"; } else { $sel = ""; }
    echo "<option value='$i' $sel>$i</option>\n";
}
echo "</select><input type=text name='project_start_year' value='".date("Y")."' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_FINISHDATE.":</td>\n";
echo "<td><select name='project_finish_month'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 12; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><select name='project_finish_day'>\n";
echo "<option value='00'>--</option>\n";
for($i = 1; $i <= 31; $i++){
    echo "<option value='$i'>$i</option>\n";
}
echo "</select><input type=text name='project_finish_year' value='0000' size='4' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WB_ASSIGNMEMBERS.":</td>\n";
echo "<td><select name='member_ids[]' size='10' multiple>\n";
$memberlistresult = $db->sql_query("select member_id, member_name from ".$prefix."_nsnwb_members order by member_name");
while(list($member_id, $member_name) = $db->sql_fetchrow($memberlistresult)) {
    echo "<option value='$member_id'>$member_name</option\n>";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WB_PROJECTADD."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>