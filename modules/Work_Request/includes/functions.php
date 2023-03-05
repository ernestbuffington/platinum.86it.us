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

function wrimage($imgfile) {
    global $module_name;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/$module_name/$imgfile")) {
        $wrimage = "themes/$ThemeSel/images/$module_name/$imgfile";
    } else {
        $wrimage = "modules/$module_name/images/$imgfile";
    }
    return($wrimage);
}

function wrimage2($imgfile, $modname) {
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/$modname/$imgfile")) {
        $wrimage = "themes/$ThemeSel/images/$modname/$imgfile";
    } else {
        $wrimage = "modules/$modname/images/$imgfile";
    }
    return($wrimage);
}

function wradmin_menu(){
    global $prefix, $db, $module_name, $admin_file;
    title(_WR_ADMINMENU);
    OpenTable();
    echo "<table border='0' align='center' width='100%' cellpadding='0' cellspacing='0'>\n";
    echo "<tr>\n<td align='center' valign='top' width='33%'>";
    echo "<a href='".$admin_file.".php?op=WRIndex'>"._WR_TITLEWR."</a><br />";
    if (file_exists("modules/Work_Board/admin/index.php")) { echo "<a href='".$admin_file.".php?op=WBIndex'>"._WR_TITLEWB."</a><br />\n"; }
    if (file_exists("modules/Work_Probe/admin/index.php")) { echo "<a href='".$admin_file.".php?op=WPIndex'>"._WR_TITLEWP."</a><br />\n"; }
    echo "</td>\n";
    echo "<td align='center' valign='top' width='34%'>";
    echo "<a href='".$admin_file.".php?op=WRProjectList'>"._WR_PROJECTLIST."</a><br />";
    echo "<a href='".$admin_file.".php?op=WRMemberList'>"._WR_MEMBERLIST."</a><br />";
    echo "<a href='".$admin_file.".php?op=WRRequestList'>"._WR_REQUESTLIST."</a><br />";
    echo "</td>\n";
    echo "<td align='center' valign='top' width='33%'>";
    echo "<a href='".$admin_file.".php?op=WRRequestConfig'>"._WR_CONFIG."</a><br />";
    echo "<a href='".$admin_file.".php?op=WRRequestStatusList'>"._WR_STATUSLIST."</a><br />";
    echo "<a href='".$admin_file.".php?op=WRRequestTypeList'>"._WR_TYPELIST."</a><br />";
    echo "</td>\n</tr>\n";
    echo "</table>\n";
    CloseTable();
}

function wrtitle($text) {
    OpenTable();
    echo "<center><font class=\"title\"><strong>$text</strong></font></center>";
    CloseTable();
}

function wrproject_info($project_id){
    global $prefix, $db;
    $project_id = intval($project_id);
    $projectresults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwb_projects WHERE project_id='$project_id'");
    $project = $db->sql_fetchrow($projectresults);
    return $project;
}

function wrmember_info($member_id){
    global $prefix, $db;
    $member_id = intval($member_id);
    $memberresults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwb_members WHERE member_id='$member_id'");
    $member = $db->sql_fetchrow($memberresults);
    return $member;
}

function wrrequest_info($request_id){
    global $prefix, $db;
    $request_id = intval($request_id);
    $requestresults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests WHERE request_id='$request_id'");
    $request = $db->sql_fetchrow($requestresults);
    return $request;
}

function wrrequestcomment_info($comment_id){
    global $prefix, $db;
    $comment_id = intval($comment_id);
    $requestcommentresults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests_comments WHERE comment_id='$comment_id'");
    $requestcomment = $db->sql_fetchrow($requestcommentresults);
    return $requestcomment;
}

function wrrequeststatus_info($status_id){
    global $prefix, $db;
    $status_id = intval($status_id);
    $requeststatusresults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests_status WHERE status_id='$status_id'");
    $requeststatus = $db->sql_fetchrow($requeststatusresults);
    return $requeststatus;
}

function wrrequesttype_info($type_id){
    global $prefix, $db;
    $type_id = intval($type_id);
    $requesttyperesults = $db->sql_query("SELECT * FROM ".$prefix."_nsnwr_requests_types WHERE type_id='$type_id'");
    $requesttype = $db->sql_fetchrow($requesttyperesults);
    return $requesttype;
}

function wrencode_email($email_address){
    $encoded = bin2hex("$email_address");
    $encoded = chunk_split($encoded, 2, '%');
    $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
    return $encoded;
}

function wrsave_config($config_name, $config_value){
    global $prefix, $db;
    $db->sql_query("UPDATE ".$prefix."_nsnwr_config SET config_value='$config_value' WHERE config_name='$config_name'");
    $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwr_config");
}

function wrget_config($config_name){
    global $prefix, $db;
    $configresult = $db->sql_query("SELECT config_value FROM ".$prefix."_nsnwr_config WHERE config_name='$config_name'");
    list($config_value) = $db->sql_fetchrow($configresult);
    return $config_value;
}

function wrget_configs(){
    global $prefix, $db;
    $configresult = $db->sql_query("SELECT config_name, config_value FROM ".$prefix."_nsnwr_config");
    while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $config[$config_name] = $config_value;
    }
    return $config;
}

function wrunhtmlentities($string) {
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}

?>