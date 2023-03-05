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

$date = time();
$stop = "";
$commenter_ip = $_SERVER['REMOTE_ADDR'];
if ((!$commenter_name) || ($commenter_name=="")) $stop = "<center>"._WP_ERRORNONAME."</center><br />\n";
if ((!$commenter_email) || ($commenter_email=="")) $stop = "<center>"._WP_ERRORNOEMAIL."</center><br />\n";
if ((!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$commenter_email))) $stop = "<center>"._WP_ERRORINVEMAIL."</center><br />\n";
if ((!$comment_description) || ($comment_description=="")) $stop = "<center>"._WR_ERRORNOCOMM."</center><br />\n";
if ($stop == "") {
    $request_id = intval($request_id);
    $commenter_name = htmlentities($commenter_name, ENT_QUOTES);
    $comment_description = htmlentities($comment_description, ENT_QUOTES);
    $db->sql_query("INSERT INTO ".$prefix."_nsnwr_requests_comments VALUES (NULL, '$request_id', '$commenter_name', '$commenter_email', '$commenter_ip', '$comment_description', '$date')");
    $db->sql_query("UPDATE ".$prefix."_nsnwr_requests SET date_commented='$date' WHERE request_id='$request_id'");
    list($submitter_email) = $db->sql_fetchrow($db->sql_query("SELECT submitter_email FROM ".$prefix."_nsnwr_requests WHERE request_id='$request_id'"));
    $notify_admin = wrget_config('notify_request_admin');
    $notify_submitter = wrget_config('notify_request_submitter');
    if($notify_admin == 1){
        $admin_email = wrget_config('admin_request_email');
        $subject = _WR_NEWREQUESTCOMMENTS;
        $message = _WR_NEWREQUESTCOMMENT.":\r\n$nukeurl/modules.php?name=$module_name&op=WRViewRequest&request_id=$request_id";
        $from  = "From: $admin_email\r\n";
        $from .= "Reply-To: $admin_email\r\n";
        $from .= "Return-Path: $admin_email\r\n";
        mail($admin_email, $subject, $message, $from);
        if ($notify_submitter == 1) {
            mail($submitter_email, $subject, $message, $from);
        }
    }
    header("Location: modules.php?name=$module_name&op=WRViewRequest&request_id=$request_id");
} else {
    include_once("header.php");
    title(_WR_COMMENTADD.": ".$request['request_name']);
    OpenTable();
    echo _WR_ERRORREQUESTCOMMENT."<br />\n";
    echo "$stop<br />\n";
    echo _WR_RETURN;
    CloseTable();
    include_once("footer.php");
}

?>