<?php
/********************************************************/
/* NSN GR Downloads                                     */
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
if (stristr($_SERVER['SCRIPT_NAME'], "block-NSNGD_Access.php")) {
    Header("Location: ../index.php");
    die();
}
$modname = "PrivateDownloads";
get_lang($modname);
global $prefix, $user_prefix, $db;
$content .= "<img src='images/blocks/uploads.png' height='16' width='16'> <strong>"._DL_UP.":</strong><br />\n";
$result = $db->sql_query("SELECT username, uploads FROM ".$prefix."_nsngd_accesses WHERE uploads>0 ORDER BY uploads DESC LIMIT 0,5");
$a = 1;
while(list($uname, $uloads) = $db->sql_fetchrow($result)) {
    $content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>$uname</a> ($uloads) "._DL_FILES."<br />";
    $a++;
}
$content .= "<hr>\n";
$content .= "<img src='images/blocks/downloads.png' height='16' width='16'> <strong>"._DL_DN.":</strong><br />\n";
$result = $db->sql_query("SELECT username, downloads FROM ".$prefix."_nsngd_accesses WHERE downloads>0 ORDER BY downloads DESC LIMIT 0,5");
$a = 1;
while(list($uname, $dloads) = sql_fetch_row($result, $dbi)) {
    $unum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$uname'"));
    if ($unum==0) { $uname = "Anonymous"; }
    $content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>$uname</a> ($dloads) "._DL_FILES."<br />";
    $a++;
}
$content .= "<hr>\n";
$result = $db->sql_query("select hits from ".$prefix."_nsngd_downloads WHERE active='1'");
$totdld = $db->sql_numrows($result);
while(list($hits) = sql_fetch_row($result, $dbi)) {
    $total_hits = $total_hits + $hits;
}
$content .= "<img src='images/blocks/totals.png' height='16' width='16'> <strong>"._DL_TDN.":</strong><br />\n";
$content .= "$totdld "._DL_FILESDL." $total_hits "._DL_TIMES."<br />";
?>
