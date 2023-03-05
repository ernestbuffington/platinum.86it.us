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

include_once("includes/counter.php");
$wr_config = wrget_configs();
$request = wrrequest_info($request_id);
$Theme_Sel = get_theme();
    echo "<html>\n";
    echo "<head>\n";
    echo "<title>"._WR_REQUESTVIEW.": ".$request['request_name']."</title>\n";
    echo "</head>\n";
    echo "<body>\n";
require("themes/$Theme_Sel/theme.php");
echo "<center><h3>"._WR_REQUESTVIEW.": ".$request['request_name']."</h3></center>\n";
echo "<br />\n";
$project = wrproject_info($request['project_id']);
$requeststatus = wrrequeststatus_info($request['status_id']);
$requesttype = wrrequesttype_info($request['type_id']);
if($requeststatus['status_name'] == ""){ $requeststatus['status_name'] = _WR_NA; }
if($requesttype['type_name'] == ""){ $requesttype['type_name'] = _WR_NA; }
echo "<center><table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='4' width='100%'><nobr><strong>"._WR_PROJECTNAME."</strong></nobr></td></tr>\n";
$wrimage = wrimage("project.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr><a href='modules.php?name=$module_name&amp;op=WRViewProject&amp;project_id=".$project['project_id']."'>".$project['project_name']."</a></nobr></td></tr>\n";
echo "<tr><td colspan='2' width='100%'><nobr><strong>"._WR_REQUESTINFO."</strong></nobr></td>\n";
echo "<td align='center'><strong>"._WR_STATUS."</strong></td>\n";
echo "<td align='center'><strong>"._WR_TYPE."</strong></td></tr>\n";
$wrimage = wrimage("request.png");
echo "<tr><td align='center'><img src='$wrimage'></td><td width='100%'><nobr>".$request['request_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$requeststatus['status_name']."</nobr></td>\n";
echo "<td align='center'><nobr>".$requesttype['type_name']."</nobr></td></tr>\n";
if($request['request_description'] != ""){
    $wrimage = wrimage("description.png");
    echo "<tr><td align='center' valign='top'><img src='$wrimage'></td>\n";
    echo "<td colspan='3' width='100%'>".nl2br($request['request_description'])."</td></tr>";
}
$wrimage = wrimage("requester.png");
echo "<tr><td align='center'><img src='$wrimage'></td>\n";
echo "<td colspan='3' width='100%'><nobr>"._WR_REQUESTER.": <strong>".$request['submitter_email']."</strong></nobr></td></tr>\n";
if($request['date_submitted'] != '0'){
    $submit_date = date($wr_config['request_date_format'], $request['date_submitted']);
    $wrimage = wrimage("date.png");
    echo "<tr><td align='center'><img src='$wrimage'></td>\n";
    echo "<td colspan='3' width=100%><nobr>"._WR_SUBMITTED.": <strong>$submit_date</strong></nobr></td></tr>\n";
}
if($request['date_modified'] != '0'){
    $modify_date = date($wr_config['request_date_format'], $request['date_modified']);    
    $wrimage = wrimage("date.png");
    echo "<tr><td align='center'><img src='$wrimage'></td>\n";
    echo "<td colspan='3' width='100%'><nobr>"._WR_MODIFIED.": <strong>$modify_date</strong></nobr></td></tr>\n";
}
$memberresult = $db->sql_query("select member_id from ".$prefix."_nsnwr_requests_members where request_id='$request_id' order by member_id");
$member_total = $db->sql_numrows($memberresult);
echo "<tr><td colspan='4' width='100%'><nobr><strong>"._WR_REQUESTMEMBERS."</strong></nobr></td></tr>\n";
if($member_total != 0){
    while (list($member_id) = $db->sql_fetchrow($memberresult)) {
        $wrimage = wrimage("member.png");
        $member = wrmember_info($member_id);
        echo "<tr><td><img src='$wrimage'></td><td colspan='3' width='100%'><a href='mailto:".wrencode_email($member['member_email'])."'>".$member['member_name']."</a></td></tr>\n";
    }
} else {
    echo "<tr><td align='center' colspan='4' width='100%'><nobr>"._WR_NOREQUESTMEMBERS."</nobr></td></tr>\n";
}
echo "</table>\n";
echo "<br />\n";
$commentresult = $db->sql_query("select comment_id from ".$prefix."_nsnwr_requests_comments where request_id='$request_id' order by date_commented asc");
$comment_total = $db->sql_numrows($commentresult);
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>\n";
echo "<tr><td width='100%'><nobr><strong>"._WR_COMMENTS."</strong> <strong>(</strong> <a href='modules.php?name=$module_name&amp;op=WRRequestCommentSubmit&amp;request_id=$request_id'>"._WR_COMMENTADD."</a> <strong>)</strong></nobr></td><tr>\n";
if($comment_total > 0){
    while (list($comment_id) = $db->sql_fetchrow($commentresult)) {
        $comment = wrrequestcomment_info($comment_id);
        $comment_date = date($wr_config['request_date_format'], $comment_date);    
        echo "<tr><td><nobr><strong>".$comment['commenter_email']." @ $comment_date</strong>";
        if(is_admin($admin)) {
            echo " - (<a href='".$admin_file.".php?op=WRRequestCommentEdit&amp;comment_id=".$comment['commenter_id']."'>"._WR_EDIT."</a>, <a href='".$admin_file.".php?op=WRRequestCommentRemove&amp;comment_id=".$comment['commenter_id']."'>"._WR_DELETE."</a>)";
        }
        echo "</nobr></td></tr>\n";
        echo "<tr><td>".nl2br($comment['comment_description'])."</td></tr>\n";
    }
} else {
    echo "<tr><td align='center'><nobr>"._WR_NOREQUESTCOMMENTS."</nobr></td></tr>\n";
}
echo "</table>\n";
    echo "</body>\n";
    echo "</html>\n";

?>