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
wradmin_menu();
echo "<br />\n";
$wr_config = wrget_configs();
title(_WR_REQUESTCONFIG);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WRRequestConfigUpdate'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WR_ADMINEMAIL.":</strong></td>\n";
echo "<td><input type='text' name='admin_request_email' value=\"".$wr_config['admin_request_email']."\" size='30'></td></tr>\n";
if($wr_config['notify_request_admin'] == 1) { $notify_a = " selected"; $notify_b = ""; } else { $notify_a = ""; $notify_b = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WR_NOTIFYADMIN.":</strong></td>\n";
echo "<td><select name='notify_request_admin'><option value='1'$notify_a>"._WR_YES."</option>\n";
echo "<option value='0'$notify_b>"._WR_NO."</option></select></td></tr>\n";
if($wr_config['notify_request_submitter'] == 1) { $notify_a = " selected"; $notify_b = ""; } else { $notify_a = ""; $notify_b = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WR_NOTIFYSUBMITTER.":</strong></td>\n";
echo "<td><select name='notify_request_submitter'><option value='1'$notify_a>"._WR_YES."</option>\n";
echo "<option value='0'$notify_b>"._WR_NO."</option></select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WR_NEWREQUESTSTATUS.":</strong></td>\n";
echo "<td><select name='new_request_status'>\n";
$status = $db->sql_query("select status_id, status_name from ".$prefix."_nsnwr_requests_status order by status_name");
while (list($status_id, $status_name) = $db->sql_fetchrow($status)) {
    if ($wr_config['new_request_status'] == $status_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$status_id' $sel>$status_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._WR_NEWREQUESTTYPE.":</strong></td>\n";
echo "<td><select name='new_request_type'>\n";
$type = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwr_requests_types order by type_name");
while (list($type_id, $type_name) = $db->sql_fetchrow($type)) {
    if ($wr_config['new_request_type'] == $type_id) { $sel = " selected"; } else { $sel = ""; }
    echo "<option value='$type_id' $sel>$type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._WR_DATEFORMAT.":</strong></td>\n";
echo "<td><input type='text' name='request_date_format' value=\"".$wr_config['request_date_format']."\" size='30'><br />("._WR_DATENOTE.")</td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WR_CONFIGUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>