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
wpadmin_menu();
echo "<br />\n";
$wp_config = wpget_configs();
title(_WP_REPORTCONFIG);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPReportConfigUpdate'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WP_ADMINEMAIL.":</strong></td>\n";
echo "<td><input type='text' name='admin_report_email' value=\"".$wp_config['admin_report_email']."\" size='30'></td></tr>\n";
if($wp_config['notify_report_admin'] == 1) { $notify_a = " selected"; $notify_b = ""; } else { $notify_a = ""; $notify_b = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WP_NOTIFYADMIN.":</strong></td>\n";
echo "<td><select name='notify_report_admin'><option value='1'$notify_a>"._WP_YES."</option>\n";
echo "<option value='0'$notify_b>"._WP_NO."</option></select></td></tr>\n";
if($wp_config['notify_report_submitter'] == 1) { $notify_a = " selected"; $notify_b = ""; } else { $notify_a = ""; $notify_b = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WP_NOTIFYSUBMITTER.":</strong></td>\n";
echo "<td><select name='notify_report_submitter'><option value='1'$notify_a>"._WP_YES."</option>\n";
echo "<option value='0'$notify_b>"._WP_NO."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WP_NEWREPORTSTATUS.":</strong></td>\n";
echo "<td><select name='new_report_status'>\n";
$status = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwp_reports_status order by status_name");
while (list($status_id, $status_name) = $db->sql_fetchrow($status)) {
    if ($wp_config['new_report_status'] == $status_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$status_id' $sel>$status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WP_NEWREPORTTYPE.":</strong></td>\n";
echo "<td><select name='new_report_type'>\n";
$type = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwp_reports_types order by type_name");
while (list($type_id, $type_name) = $db->sql_fetchrow($type)) {
    if ($wp_config['new_report_type'] == $type_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$type_id' $sel>$type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._WP_DATEFORMAT.":</strong></td>\n";
echo "<td><input type='text' name='report_date_format' value=\"".$wp_config['report_date_format']."\" size='30'><br />("._WP_DATENOTE.")</td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WP_CONFIGUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>