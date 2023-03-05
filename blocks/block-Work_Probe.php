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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db, $bgcolor2;
$modname = "Work_Probe";
get_lang($modname);
require_once("modules/$modname/includes/functions.php");
$wp_config = wpget_configs();
$content = "<table align='center' border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
$content .= "<tr>\n";
$content .= "<td bgcolor='$bgcolor2' colspan='2' width='100%'><strong>"._WP_PROJECTNAME."</strong></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_REPORTS."</strong></nobr></td>\n";
$content .= "<td align='center' bgcolor='$bgcolor2'><nobr><strong>"._WP_LASTSUBMISSION."</strong></nobr></td>\n";
$content .= "</tr>\n";
$projectresult = $db->sql_query("SELECT project_id FROM ".$prefix."_nsnwb_projects WHERE featured='1' ORDER BY project_name");
while (list($project_id) = $db->sql_fetchrow($projectresult)) {
    $project = wpproject_info($project_id);
    $wpimage = wpimage2("project.png", $modname);
    $content .= "<tr>\n<td align='center'><img src='$wpimage'></td>\n<td width='100%'>".$project['project_name']."</td>\n";
    $reportnumber = $db->sql_numrows($db->sql_query("SELECT report_id FROM ".$prefix."_nsnwp_reports WHERE project_id='$project_id'"));
    $content .= "<td align='center'><a href='modules.php?name=$modname&amp;op=WPViewProject&amp;project_id=$project_id'>$reportnumber</a></td>\n";
    $lastresult = $db->sql_query("SELECT date_submitted FROM ".$prefix."_nsnwp_reports WHERE project_id='$project_id' ORDER BY date_submitted DESC LIMIT 1");
    if($db->sql_numrows($lastresult) == 0){
        $date_submitted = _WP_NA;
    } else {
        list($date_submitted) = $db->sql_fetchrow($lastresult);
        $date_submitted = date($wp_config['report_date_format'], $date_submitted);
    }
    $content .= "<td align='center'><nobr>$date_submitted</nobr></td>\n</tr>\n";
}
$content .=  "</table>\n";
?>
