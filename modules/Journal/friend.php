<?php

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
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/
    /* Journal 2.0 Enhanced and Debugged 2004                               */
    /* by sixonetonoffun -- http://www.netflake.com --                      */
    /* Images Created by GanjaUK -- http://www.GanjaUK.com                  */
    /************************************************************************/
if ( !defined('MODULE_FILE') )
{
	die("You can't access this file directly...");
}
    require_once("mainfile.php");
    $module_name = basename(dirname(__FILE__));
    get_lang($module_name);
	if (!isset($jid) OR !is_numeric($jid)) { die("No journal specified."); }
    $pagetitle = "- "._USERSJOURNAL."";
    include_once("header.php");
    include_once("modules/$module_name/functions.php");
    if (is_user($user)) {
        cookiedecode($user);
        $username = $cookie[1];
        $user = check_html($user, "nohtml");
        $username = check_html($username, "nohtml");
        $sitename = check_html($sitename, "nohtml");
        $debug = check_html($debug, "nohtml");
        if ($debug == "true") :
        echo ("UserName:$username<br />SiteName: $sitename");
        endif;
        startjournal($sitename, $user);
        $jid = intval($jid);
$sql = "select title from ".$prefix."_journal where jid='$jid'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $jtitle = $row['title'];
        $send = intval($send);
        $sent = intval($sent);
        if ($send == 1) {
            $fname = removecrlf($fname);
            $fmail = validate_mail(removecrlf($fmail));
            $yname = removecrlf($yname);
            $ymail = validate_mail(removecrlf($ymail));
            $subject = ""._INTERESTING." $sitename";
            $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._CONSIDERED."\n\n\n$jtitle\n"._URL.": $nukeurl/modules.php?name=$module_name&file=display&jid=$jid\n\n\n"._AREMORE."\n\n---\n$sitename\n$nukeurl";
            mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
            $title = urlencode($jtitle);
            $fname = urlencode($fname);
            $sent = 1;
        }
        if ($sent == 1) {
            echo "<br />";
            title(""._SENDJFRIEND."");
            OpenTable();
            echo "<center>"._FSENT."<br /><br />[ <a href=\"modules.php?name=$module_name&file=display&jid=$jid\">"._RETURNJOURNAL2."</a> ]</center>";
            CloseTable();
            journalfoot();
            die();
        }
        echo "<br />";
        title(""._SENDJFRIEND."");
        OpenTable();
        echo "<table align=center border=0><tr><td>" ."<center><strong>$jtitle</strong><br />"._YOUSENDJOURNAL."</center><br /><br />" ."<form action=\"modules.php?name=$module_name&file=friend\" method=\"post\">" ."<input type=\"hidden\" name=\"send\" value=\"1\">" ."<input type=\"hidden\" name=\"jid\" value=\"$jid\">";
        if (is_user($user)) {
            $sql = "select name, username, user_email from ".$user_prefix."_users where user_id = '".intval($cookie[0])."'";
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
            $yn = check_html($row['name'], "nohtml");
            $yun = check_html($row['username'], "nohtml");
            $ye = check_html($row['user_email'], "nohtml");
        }
        if (empty($yn)) {
            $yn = $yun;
        }
        echo "<strong>"._FYOURNAME." </strong> <input type=\"text\" name=\"yname\" value=\"$yn\"><br /><br />\n" ."<strong>"._FYOUREMAIL." </strong> <input type=\"text\" name=\"ymail\" value=\"$ye\"><br /><br /><br />\n" ."<strong>"._FFRIENDNAME." </strong> <input type=\"text\" name=\"fname\"><br /><br />\n" ."<strong>"._FFRIENDEMAIL." </strong> <input type=\"text\" name=\"fmail\"><br /><br />\n" ."<input type=\"hidden\" name=\"op\" value=\"SendStory\">\n" ."<input type=\"submit\" value="._SEND.">\n" ."</form></td></tr></table>\n";
        CloseTable();
        journalfoot();
    } else {
        echo ("<br />");
        openTable();
        echo ("<div align=center>"._YOUMUSTBEMEMBER."<br /></div>");
        closeTable();
        journalfoot();
        die();
    }

?>