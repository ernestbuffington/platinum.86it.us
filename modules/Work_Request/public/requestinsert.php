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

$status_id = wrget_config('new_request_status');
$date = time();
$stop = "";
$submitter_ip = $_SERVER['REMOTE_ADDR'];
if ((!$submitter_name) || ($submitter_name=="")) $stop = "<center>"._WP_ERRORNONAME."</center><br />\n";
if ((!$submitter_email) || ($submitter_email=="")) $stop = "<center>"._WP_ERRORNOEMAIL."</center><br />\n";
if ((!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$submitter_email))) $stop = "<center>"._WP_ERRORINVEMAIL."</center><br />\n";
if ((!$request_name) || ($request_name == "")) $stop = "<center>"._WR_ERRORNOSUMM."</center><br />\n";
if ((!$request_description) || ($request_description == "")) $stop = "<center>"._WR_ERRORNODESC."</center><br />\n";
if ($stop == "") {
    $project_id = intval($project_id);
    $type_id = intval($type_id);
    $submitter_name = htmlentities($submitter_name, ENT_QUOTES);
    $request_name = htmlentities($request_name, ENT_QUOTES);
    $request_description = htmlentities($request_description, ENT_QUOTES);
    $db->sql_query("INSERT INTO ".$prefix."_nsnwr_requests VALUES (NULL, '$project_id', '$type_id', '$status_id', '$request_name', '$request_description', '$submitter_name', '$submitter_email', '$submitter_ip', '$date', '0', '0')");
    list($request_id) = $db->sql_fetchrow($db->sql_query("SELECT request_id FROM ".$prefix."_nsnwr_requests WHERE date_submitted='$date' AND project_id='$project_id' AND type_id='$type_id' AND status_id='$status_id' AND request_name='$request_name'"));
    $notify_admin = wrget_config('notify_request_admin');
    if($notify_admin == 1){
        $admin_email = wrget_config('admin_request_email');
        $subject = _WR_NEWREQUESTMESSAGES;
        $message = _WR_NEWREQUESTMESSAGE.":\r\n$nukeurl/modules.php?name=$module_name&op=WRViewRequest&request_id=$request_id";
        $from  = "From: $admin_email\r\n";
        $from .= "Reply-To: $admin_email\r\n";
        $from .= "Return-Path: $admin_email\r\n";
        mail($admin_email, $subject, $message, $from);
    }
    header("Location: modules.php?name=$module_name&op=WRViewRequest&request_id=$request_id");
} else {
    include_once("header.php");
    title(_WR_REQUESTADD.": ".$request['request_name']);
    OpenTable();
    echo _WR_ERRORREQUEST."<br />\n";
    echo "$stop<br />\n";
    echo _WR_RETURN;
    CloseTable();
    include_once("footer.php");
}

?>