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
$wp_config = wpget_configs();
$report = wpreport_info($report_id);
title(_WP_REPORTVIEW.": ".$report['report_name']);
$project = wpproject_info($report['project_id']);
$reportstatus = wpreportstatus_info($report['status_id']);
$reporttype = wpreporttype_info($report['type_id']);
if($reportstatus['status_name'] == ""){ $reportstatus['status_name'] = _WP_NA; }
if($reporttype['type_name'] == ""){ $reporttype['type_name'] = _WP_NA; }
OpenTable();
echo "<center><table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='4' width='100%'><nobr><strong>"._WP_PROJECTNAME."</strong></nobr></td></tr>\n";
$wpimage = wpimage("project.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr><a href='modules.php?name=$module_name&amp;op=WPViewProject&amp;project_id=".$project['project_id']."'>".$project['project_name']."</a></nobr></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' colspan='2' width='100%'><nobr><strong>"._WP_REPORTINFO."</strong></nobr></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><strong>"._WP_STATUS."</strong></td>\n";
echo "<td bgcolor='$bgcolor2' align='center'><strong>"._WP_TYPE."</strong></td></tr>\n";
$wpimage = wpimage("report.png");
echo "<tr><td align='center'><img src='$wpimage'></td><td width='100%'><nobr>".$report['report_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$reportstatus['status_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$reporttype['type_name']."</nobr></td></tr>\n";
if($report['report_description'] != ""){
    $wpimage = wpimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wpimage'></td>\n";
    echo "<td colspan='3' width='100%'>".nl2br($report['report_description'])."</td></tr>\n";
}
$wpimage = wpimage("reporter.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>"._WP_REPORTER.": <strong><a href='mailto:".wpencode_email($report['submitter_email'])."'>".$report['submitter_name']."</a></strong></nobr></td></tr>\n";
if($report['date_submitted'] != '0'){
    $submit_date = date($wp_config['report_date_format'], $report['date_submitted']);
} else {
    $submit_date = _WP_NA;
}
$wpimage = wpimage("date.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>"._WP_SUBMITTED.": <strong>$submit_date</strong></nobr></td></tr>\n";
if($report['date_modified'] != '0'){
    $modify_date = date($wp_config['report_date_format'], $report['date_modified']);    
} else {
    $modify_date = _WP_NA;    
}
$wpimage = wpimage("date.png");
echo "<tr><td align='center'><img src='$wpimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>"._WP_MODIFIED.": <strong>$modify_date</strong></nobr></td></tr>\n";
$memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwp_reports_members where report_id='$report_id' order by member_id");
$member_total = $db->sql_numrows($memberresult);
echo "<tr><td bgcolor='$bgcolor2' colspan='4' width='100%'><nobr><strong>"._WP_REPORTMEMBERS."</strong></nobr></td></tr>\n";
if($member_total != 0){
    while (list($member_id) = $db->sql_fetchrow($memberresult)) {
        $wpimage = wpimage("member.png");
        $member = wpmember_info($member_id);
        echo "<tr><td><img src='$wpimage'></td><td colspan='3' width='100%'><a href='mailto:".wpencode_email($member['member_email'])."'>".$member['member_name']."</a></td></tr>\n";
    }
} else {
    echo "<tr><td align='center' colspan='4' width='100%'><nobr>"._WP_NOREPORTMEMBERS."</nobr></td></tr>\n";
}
if (is_admin($admin)) {
    echo "<tr><td bgcolor='$bgcolor2' colspan='4' width='100%'><nobr><strong>"._WP_ADMINFUNCTIONS."</strong></nobr></td></tr>\n";
    $wpimage = wpimage("options.png");
    echo "<tr><td align='center'><img src='$wpimage'></td>\n";
    echo "<td colspan='3' width='100%'><nobr><a href='".$admin_file.".php?op=WPReportEdit&amp;report_id=$report_id'>"._WP_REPORTEDIT."</a>";
    echo ", <a href='".$admin_file.".php?op=WPReportRemove&amp;report_id=$report_id'>"._WP_REPORTDELETE."</a>";
    echo ", <a href='".$admin_file.".php?op=WPReportImport&amp;report_id=$report_id'>"._WP_IMPORT2TASK."</a>";
    echo ", <a href='".$admin_file.".php?op=WPReportPrint&amp;report_id=$report_id'>"._WP_REPORTPRINT."</a></nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
echo "<br />\n";
$commentresult = $db->sql_query("select comment_id from ".$prefix."_nsnwp_reports_comments where report_id='$report_id' order by date_commented asc");
$comment_total = $db->sql_numrows($commentresult);
OpenTable();
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td bgcolor='$bgcolor2' width='100%'><nobr><strong>"._WP_COMMENTS."</strong> <strong>(</strong> <a href='modules.php?name=$module_name&amp;op=WPReportCommentSubmit&amp;report_id=$report_id'>"._WP_COMMENTADD."</a> <strong>)</strong></nobr></td><tr>\n";
if($comment_total > 0){
    while (list($comment_id) = $db->sql_fetchrow($commentresult)) {
        $comment = wpreportcomment_info($comment_id);
        $comment_date = date($wp_config['report_date_format'], $comment['date_commented']);    
        echo "<tr><td bgcolor='$bgcolor2'><nobr><strong><a href='mailto:".wpencode_email($comment['commenter_email'])."'>".$comment['commenter_name']."</a> @ $comment_date</strong>";
        if(is_admin($admin)) {
            echo " - (<a href='".$admin_file.".php?op=WPReportCommentEdit&amp;comment_id=".$comment['comment_id']."'>"._WP_EDIT."</a>, <a href='".$admin_file.".php?op=WPReportCommentRemove&amp;comment_id=".$comment['comment_id']."'>"._WP_DELETE."</a>)";
        }
        echo "</nobr></td></tr>\n";
        echo "<tr><td>".nl2br($comment['comment_description'])."</td></tr>\n";
    }
} else {
    echo "<tr><td align='center'><nobr>"._WP_NOREPORTCOMMENTS."</nobr></td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>