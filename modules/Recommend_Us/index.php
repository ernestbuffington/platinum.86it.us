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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

define('INDEX_FILE', true);
$index = 1;

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._RECOMMEND."";

function RecommendSite() {
    global $user, $cookie, $prefix, $db, $user_prefix, $module_name;
    include_once("header.php");
    title("$sitename: "._RECOMMEND."");
    OpenTable();
    echo "<center><font class=\"content\"><strong>"._RECOMMEND."</strong></font></center><br /><br />"
		."<form action=\"modules.php?name=$module_name\" method=\"post\">"
		."<input type=\"hidden\" name=\"op\" value=\"SendSite\">";
    if (is_user($user)) {
		// fix for SQL injection - sgtmudd
    	//$row = $db->sql_fetchrow($db->sql_query("SELECT username, user_email from ".$user_prefix."_users where username='$cookie[1]'"));
		$row = $db->sql_fetchrow($db->sql_query("SELECT username, user_email FROM ".$user_prefix."_users WHERE user_id = '".intval($cookie[0])."'")); 
		$yn = stripslashes($row['username']);
		$ye = stripslashes($row['user_email']);
    }
    echo "<strong>"._FYOURNAME." </strong> <input type=\"text\" name=\"yname\" value=\"$yn\"><br /><br />\n"
		."<strong>"._FYOUREMAIL." </strong> <input type=\"text\" name=\"ymail\" value=\"$ye\"><br /><br /><br />\n"
		."<strong>"._FFRIENDNAME." </strong> <input type=\"text\" name=\"fname\"><br /><br />\n"
		."<strong>"._FFRIENDEMAIL." </strong> <input type=\"text\" name=\"fmail\"><br /><br />\n"
		."<input type=submit value="._SEND.">\n"
		."</form>\n";
    CloseTable();
    include_once('footer.php');
}

function SendSite($yname, $ymail, $fname, $fmail) {
    global $sitename, $slogan, $nukeurl, $module_name;
    $fname = stripslashes(FixQuotes(check_html(removecrlf($fname))));
    $fmail = stripslashes(FixQuotes(check_html(removecrlf($fmail))));
    $yname = stripslashes(FixQuotes(check_html(removecrlf($yname))));
    $ymail = stripslashes(FixQuotes(check_html(removecrlf($ymail))));
    $subject = ""._INTSITE." $sitename";
    $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._OURSITE." $sitename "._INTSENT."\n\n\n"._FSITENAME." $sitename\n$slogan\n"._FSITEURL." $nukeurl\n";
    if ($fname == "" || $fmail == "" || $yname == "" || $ymail == "") {
    Header("Location: modules.php?name=$module_name");
    } else {
    mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
    update_points(3);
    
    Header("Location: modules.php?name=$module_name&op=SiteSent&fname=$fname");
   }
}

function SiteSent($fname) {
    include_once('header.php');
    title("$sitename: "._RECOMMEND."");
    $fname = stripslashes(FixQuotes(check_html(removecrlf($fname))));
    OpenTable();
    echo "<center><font class=\"content\">"._FREFERENCE." $fname...<br /><br />"._THANKSREC."</font></center>";
    CloseTable();
    include_once('footer.php');
}


switch($op) {

    case "SendSite":
    SendSite($yname, $ymail, $fname, $fmail);
    break;
	
    case "SiteSent":
    SiteSent($fname);
    break;

    default:
    RecommendSite();
    break;

}

?>
