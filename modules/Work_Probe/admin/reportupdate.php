<?php

/********************************************************/
/* NSN Work Probe                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright ? 2000-2005 by NukeScripts Network         */
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

$date = time();
$report_name = htmlentities($report_name, ENT_QUOTES);
$report_description = htmlentities($report_description, ENT_QUOTES);
$submitter_name = htmlentities($submitter_name, ENT_QUOTES);
$db->sql_query("UPDATE ".$prefix."_nsnwp_reports SET project_id='$project_id', type_id='$type_id', report_name='$report_name', report_description='$report_description', submitter_name='$submitter_name', submitter_email='$submitter_email', status_id='$status_id', date_modified='$date' WHERE report_id='$report_id'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwp_reports");
while(list($null, $member_id) = each($member_ids)) {
    $db->sql_query("INSERT INTO ".$prefix."_nsnwp_reports_members VALUES ('$report_id', '$member_id')");
}
list($submitter_email) = $db->sql_fetchrow($db->sql_query("SELECT submitter_email FROM ".$prefix."_nsnwp_reports WHERE report_id='$report_id'"));
$notify_admin = wpget_config('notify_report_admin');
$notify_submitter = wpget_config('notify_report_submitter');
if($notify_admin == 1){
    $admin_email = wpget_config('admin_report_email');
    $subject = _WP_NEWREPORTUPDATEDS;
    $message = _WP_NEWREPORTUPDATED.":\r\n$nukeurl/modules.php?name=$module_name&op=WPViewReport&report_id=$report_id";
    $from  = "From: $admin_email\r\n";
    $from .= "Reply-To: $admin_email\r\n";
    $from .= "Return-Path: $admin_email\r\n";
    mail($admin_email, $subject, $message, $from);
    if($notify_submitter == 1){
        mail($submitter_email, $subject, $message, $from);
    }
}
header("Location: modules.php?name=$module_name&op=WPViewReport&report_id=$report_id");

?>