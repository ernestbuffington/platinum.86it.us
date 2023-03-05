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
$wb_config = wbget_configs();
title(_WB_TASKCONFIG);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBTaskConfigUpdate'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WB_NEWTASKSTATUS.":</strong></td>\n";
echo "<td><select name='new_task_status'>\n";
$status = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwb_tasks_status order by status_name");
while (list($status_id, $status_name) = $db->sql_fetchrow($status)) {
    if ($wb_config['new_task_status'] == $status_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$status_id' $sel>$status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WB_NEWTASKPRIORITY.":</strong></td>\n";
echo "<td><select name='new_task_priority'>\n";
$priority = $db->sql_query("select priority_id, priority_name from ".$prefix."_nsnwb_tasks_priorities order by priority_weight");
while (list($priority_id, $priority_name) = $db->sql_fetchrow($priority)) {
    if ($wb_config['new_task_priority'] == $priority_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$priority_id' $sel>$priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._WB_DATEFORMAT.":</strong></td>\n";
echo "<td><input type='text' name='task_date_format' value=\"".$wb_config['task_date_format']."\" size='30'><br />("._WB_DATENOTE.")</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WB_NEWTASKPOSITION.":</strong></td>\n";
echo "<td><select name='new_task_position'>\n";
$position = $db->sql_query("select position_id, position_name from ".$prefix."_nsnwb_members_positions order by position_name");
while (list($position_id, $position_name) = $db->sql_fetchrow($position)) {
    if ($wb_config['new_task_position'] == $priority_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$position_id' $sel>$position_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WB_CONFIGUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>