<?php

/************************************************************************/
/* Journal &#167 ZX                                                     */
/* ================                                                     */
/*                                                                      */
/* Original work done by Joseph Howard known as Member's Journal, which */
/* was based on Trevor Scott's vision of Atomic Journal.                */
/*                                                                      */
/* Modified on 25 May 2002 by Paul Laudanski (paul@computercops.biz)    */
/* Copyright (c) 2002 Modifications by Computer Cops.                   */
/* http://computercops.biz                                              */
/*                                                                      */
/* Required: PHPNuke 5.5 ( http://www.phpnuke.org/ ) and phpbb2         */
/* ( http://bbtonuke.sourceforge.net/ ) forums port.                    */
/*                                                                      */
/* Member's Journal did not work on a PHPNuke 5.5 portal which had      */
/* phpbb2 port integrated.  Thus was Journal &#167 ZX created with the  */
/* Member's Journal author's blessings.                                 */
/*                                                                      */
/* To install, backup everything first and then FTP the Journal package */
/* files into your site's module directory.  Also run the tables.sql    */
/* script so the proper tables and fields can be created and used.  The */
/* default table prefix is "nuke" which is hard-coded throughout the    */
/* entire system as a left-over from Member's Journal.  If a demand     */
/* exists, that can be changed for a future release.                    */
/*                                                                      */
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
    $module_name = ("Journal");
get_lang($module_name);

$pagetitle = "- "._USERSJOURNAL."";

include_once("header.php");
include_once("modules/Journal/functions.php");
   // include_once("modules/Journal/kses.php");
    if (is_user($user)) {
        cookiedecode($user);
        $username = $cookie[1];
        $user = check_html($user, "nohtml");
        $username = check_html($username, "nohtml");
        $sitename = check_html($sitename, "nohtml");
        if (isset($title)) { $title = check_html($title, "nohtml");
        $title = addslashes($title); }
		else { $title = ""; }
        if (isset($jbodytext)) { $jbodytext = kses(ADVT_stripslashes($jbodytext), $allowed);
        $jbodytext = addslashes($jbodytext); }
		else { $jbodytext = ""; }
        if (isset($mood)) { $mood = check_html($mood, "nohtml"); }
		else { $mood = ""; }
        if (isset($status)) { $status = check_html($status, "nohtml"); }
		else { $status = ""; }
        if (isset($jid)) { $jid = intval($jid); }
		else { $jid = ""; }
        if (isset($edit) AND ($edit == intval(1))) {
    $htime = date("h");
    $mtime = date("i");
    $ntime = date("a");
    $mtime = "$htime:$mtime $ntime";
    $mdate = date("m");
    $ddate = date("d");
    $ydate = date("Y");
    $ndate = "$mdate-$ddate-$ydate";
    $pdate = $ndate;
    $ptime = $mtime;
    $micro = microtime();
	$sql = "SELECT * FROM ".$prefix."_journal WHERE jid = '$jid'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
            	if (!is_admin($admin)):
	if ($username != $row['aid']):
    	    echo ("<br />");
	    openTable();
	    echo ("<div align=center>".NOTYOURS."</div>");
	    closeTable();
	    journalfoot();
                die();
                endif;
                endif;
            }
            echo ("<div align=center><strong>"._UPDATEOK."</strong></div><br />");
            $sql = "UPDATE ".$prefix."_journal SET title='$title', bodytext='$jbodytext', mood='$mood', status='$status', mdate='$ndate', mtime='$mtime' WHERE jid='$jid'";
            $db->sql_query($sql);
            $edited = "<br /><br /><center><strong>"._UPDATED."</strong></center>";
        } else {
            $edited = "";
        }
        if ($debug == "true") :
        echo ("UserName:$username<br />SiteName: $sitename");
        endif;
        startjournal($sitename, $user);
        echo "<br />";
        OpenTable();
        echo ("<div align=center class=title>"._JOURNALFOR." $username</div><br />");
        echo ("<div align=center> [ <a href=\"modules.php?name=Journal&file=add\">"._ADDENTRY."</a> | <a href=\"modules.php?name=Journal&file=edit&disp=last\">"._YOURLAST20."</a> | <a href=\"modules.php?name=Journal&file=edit&disp=all\">"._LISTALLENTRIES."</a> ]</div>");
        echo "$edited";
        CloseTable();
        echo "<br />";
        function list20($username, $bgcolor1, $bgcolor2, $bgcolor3) {
	global $prefix, $user_prefix, $db, $module_name;
            openTable();
            echo ("<div align=\"center\" class=title>"._LAST20FOR." $username</div><br />");
            echo ("<table align=center border=1 width=\"90%\">");
            echo ("<tr>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._DATE."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._TIME."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1><strong>"._TITLE."</strong> "._CLICKTOVIEW."</td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._PUBLIC."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._EDIT."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._DELETE."</div></strong></td>");
            echo ("</tr>");
	$sql = "SELECT jid, aid, title, pdate, ptime, mdate, mtime, status, mood FROM ".$prefix."_journal WHERE aid='$username' order by 'jid' DESC";
            $result = $db->sql_query($sql);
            $dcount = 1;
            while ($row = $db->sql_fetchrow($result)) {
                if ($dcount >= 21) :
                echo ("</tr></table>");
                closeTable();
                echo ("<br />");
                journalfoot();
                die();
                else :
                $dcount = $dcount + 1;
                print ("<tr>");
                $jid = intval($row['jid']);
                $title = check_html($row['title'], "nohtml");
                $jaid = check_html($row['aid'], "nohtml");
                $pdate = check_html($row['pdate'], "nohtml");
                $ptime = check_html($row['ptime'], "nohtml");
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $pdate);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $ptime);
                printf ("<td align=left bgcolor=$bgcolor2>&nbsp;<a href=\"modules.php?name=Journal&file=display&jid=%s\">%s</a>", $jid, $title);
                $sqlscnd = "SELECT cid from ".$prefix."_journal_comments where rid='$jaid'";
                $rstscnd = $db->sql_query($sqlscnd);
                $scndcount = 0;
                while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
                    $scndcount = $scndcount + 1;
                }
                if ($scndcount == 1) {
                    printf (" &#151;&#151; $scndcount "._COMMENT."</td>");
                } else {
                    printf (" &#151;&#151; $scndcount "._COMMENTS."</td>");
                }
                if ($row['status'] == "yes") {
                    $row['status'] = _YES;
                } else {
                    $row['status'] = _NO;
                }
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['status']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=modify&jid=%s\"><img src='modules/Journal/images/edit.gif' border='0' alt=\""._EDIT."\" title=\""._EDIT."\"></a></div></td>", $jid, $title);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=delete&jid=%s\"><img src='modules/Journal/images/trash.gif' border='0' alt=\""._DELETE."\" title=\""._DELETE."\"></a></div></td>", $jid, $title);
                print ("</tr>");
                endif;
            }
            echo ("</table>");
            closeTable();
        }
        function listall($username, $bgcolor1, $bgcolor2, $bgcolor3, $sitename) {
            global $prefix, $user_prefix, $db, $module_name;
            openTable();
            echo ("<div align=\"center\" class=title>"._COMPLETELIST." $username</div><br />");
            echo ("<table align=center border=1 width=\"90%\">");
            echo ("<tr>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._DATE."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._TIME."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1><strong>"._TITLE."</strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._PUBLIC."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._EDIT."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._DELETE."</div></strong></td>");
            echo ("</tr>");
			$sql = "SELECT jid, aid, title, pdate, ptime, mdate, mtime, status, mood FROM ".$prefix."_journal WHERE aid='$username' order by 'jid' DESC";
            $result = $db->sql_query($sql);
			$dcount = 0;
			$pubcount = 0;
			$prvcount = 0;
            while ($row = $db->sql_fetchrow($result)) {
                $jid = intval($row['jid']);
                $title = check_html($row['title'], "nohtml");
                $jaid = check_html($row['aid'], "nohtml");
                $pdate = check_html($row['pdate'], "nohtml");
                $ptime = check_html($row['ptime'], "nohtml");
                $dcount = $dcount + 1;
                if ($row['status'] == "yes"):
                    $pubcount = $pubcount +1;
                $row['status'] = _YES;
                else:
                    $prvcount = $prvcount + 1;
                $row['status'] = _NO;
                endif;
                print ("<tr>");
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['pdate']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['ptime']);
                printf ("<td align=left bgcolor=$bgcolor2><a href=\"modules.php?name=Journal&file=display&jid=%s\">%s</a>", $jid, $title);
		$sqlscnd = "SELECT cid from ".$prefix."_journal_comments where rid='".intval($row['jid'])."'";
                $rstscnd = $db->sql_query($sqlscnd);
                $scndcount = 0;
                while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
                    $scndcount = $scndcount + 1;
                }
                if ($scndcount == 1) {
                    printf (" &#151;&#151; $scndcount "._COMMENT."</td>");
                } else {
                    printf (" &#151;&#151; $scndcount "._COMMENTS."</td>");
                }
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['status']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=modify&jid=%s\"><img src='modules/Journal/images/edit.gif' border='0' alt='"._EDIT."'></a></div></td>", $row['jid']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=delete&jid=%s\"><img src='modules/Journal/images/trash.gif' border='0' alt='"._DELETE."'></a></div></td>", $row['jid']);
                print ("</tr>");
            }
            echo ("</table>");
            if ($prvcount == "") {
                $prvcount = 0;
            }
            if ($pubcount == "") {
                $pubcount = 0;
            }
            if ($dcount == "") {
                $dcount = 0;
            }
            echo "<br /><div align=center>$pubcount "._PUBLICENTRIES." - " ."$prvcount "._PRIVATEENTRIES." - " ."$dcount "._TOTALENTRIES."</div>";
            closeTable();
        }
		if (!isset($disp)) { $disp = ""; }
        switch($disp) {
            case "last":
            list20($username, $bgcolor1, $bgcolor2, $bgcolor3);
            break;
            case "all":
            listall($username, $bgcolor1, $bgcolor2, $bgcolor3, $sitename);
            break;
            default:
            list20($username, $bgcolor1, $bgcolor2, $bgcolor3);
            break;
        }
        journalfoot();
    }
    if (is_admin($admin)) {
        $username = check_html($username, "nohtml");
        $sitename = check_html($sitename, "nohtml");
        $jbodytext = kses(ADVT_stripslashes($jbodytext), $allowed);
        $jbodytext = addslashes($jbodytext);
        $jid = intval($jid);
        if ($edit == intval(1)) {
            $htime = date(h);
            $mtime = date(i);
            $ntime = date(a);
            $mtime = "$htime:$mtime $ntime";
            $mdate = date(m);
            $ddate = date(d);
            $ydate = date(Y);
            $ndate = "$mdate-$ddate-$ydate";
            $pdate = $ndate;
            $ptime = $mtime;
            $micro = microtime();
            $sql = "SELECT * FROM ".$prefix."_journal WHERE jid = '$jid'";
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
            }
            echo ("<div align=center><strong>"._UPDATEOK."</strong></div><br />");
            $sql = "UPDATE ".$user_prefix."_journal SET title='$title', bodytext='$jbodytext', mood='$mood', status='$status', mdate='$ndate', mtime='$mtime' WHERE jid='$jid'";
            $db->sql_query($sql);
            $edited = "<br /><br /><center><strong>"._UPDATED."</strong></center>";
        } else {
            $edited = "";
        }
        if ($debug == "true") :
        echo ("UserName:$username<br />SiteName: $sitename");
        endif;
        startjournal($sitename, $user);
        echo "<br />";
        OpenTable();
        echo ("<div align=center class=title>"._JOURNALFOR." $username</div><br />");
        echo ("<div align=center> [ <a href=\"modules.php?name=Journal&file=add\">"._ADDENTRY."</a> | <a href=\"modules.php?name=Journal&file=edit&disp=last\">"._YOURLAST20."</a> | <a href=\"modules.php?name=Journal&file=edit&disp=all\">"._LISTALLENTRIES."</a> ]</div>");
        echo "$edited";
        CloseTable();
        echo "<br />";
        function list20($username, $bgcolor1, $bgcolor2, $bgcolor3) {
            global $prefix, $user_prefix, $db, $module_name;
            openTable();
            echo ("<div align=\"center\" class=title>"._LAST20FOR." $username</div><br />");
            echo ("<table align=center border=1 width=\"90%\">");
            echo ("<tr>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._DATE."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._TIME."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1><strong>"._TITLE."</strong> "._CLICKTOVIEW."</td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._PUBLIC."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._EDIT."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._DELETE."</div></strong></td>");
            echo ("</tr>");
            $sql = "SELECT jid, aid, title, pdate, ptime, mdate, mtime, status, mood FROM ".$prefix."_journal WHERE aid='$username' order by 'jid' DESC";
            $result = $db->sql_query($sql);
            $dcount = 1;
            while ($row = $db->sql_fetchrow($result)) {
                if ($dcount >= 21) :
                echo ("</tr></table>");
                closeTable();
                echo ("<br />");
                journalfoot();
                die();
                else :
                $dcount = $dcount + 1;
                print ("<tr>");
                $jid = intval($row['jid']);
                $title = check_html($row['title'], "nohtml");
                $jaid = check_html($row['aid'], "nohtml");
                $pdate = check_html($row['pdate'], "nohtml");
                $ptime = check_html($row['ptime'], "nohtml");
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $pdate);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $ptime);
                printf ("<td align=left bgcolor=$bgcolor2>&nbsp;<a href=\"modules.php?name=Journal&file=display&jid=%s\">%s</a>", $jid, $title);
                $sqlscnd = "SELECT cid from ".$prefix."_journal_comments where rid='$jaid'";
                $rstscnd = $db->sql_query($sqlscnd);
                $scndcount = 0;
                while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
                    $scndcount = $scndcount + 1;
                }
                if ($scndcount == 1) {
                    printf (" &#151;&#151; $scndcount "._COMMENT."</td>");
                } else {
                    printf (" &#151;&#151; $scndcount "._COMMENTS."</td>");
                }
                if ($row['status'] == "yes") {
                    $row['status'] = _YES;
                } else {
                    $row['status'] = _NO;
                }
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['status']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=modify&jid=%s\"><img src='modules/Journal/images/edit.gif' border='0' alt=\""._EDIT."\" title=\""._EDIT."\"></a></div></td>", $jid, $title);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=delete&jid=%s\"><img src='modules/Journal/images/trash.gif' border='0' alt=\""._DELETE."\" title=\""._DELETE."\"></a></div></td>", $jid, $title);
                print ("</tr>");
                endif;
            }
            echo ("</table>");
            closeTable();
        }
        function listall($username, $bgcolor1, $bgcolor2, $bgcolor3, $sitename) {
            global $prefix, $user_prefix, $db, $module_name;
            openTable();
            echo ("<div align=\"center\" class=title>"._COMPLETELIST." $username</div><br />");
            echo ("<table align=center border=1 width=\"90%\">");
            echo ("<tr>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._DATE."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=70><strong><div align=\"center\">"._TIME."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1><strong>"._TITLE."</strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._PUBLIC."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._EDIT."</div></strong></td>");
            echo ("<td align=center bgcolor=$bgcolor1 width=\"5%\"><strong><div align=\"center\">"._DELETE."</div></strong></td>");
            echo ("</tr>");
            $sql = "SELECT jid, aid, title, pdate, ptime, mdate, mtime, status, mood FROM ".$prefix."_journal WHERE aid='$username' order by 'jid' DESC";
            $result = $db->sql_query($sql);
			$dcount = 0;
			$pubcount = 0;
			$prvcount = 0;
            while ($row = $db->sql_fetchrow($result)) {
                $jid = intval($row['jid']);
                $title = check_html($row['title'], "nohtml");
                $jaid = check_html($row['aid'], "nohtml");
                $pdate = check_html($row['pdate'], "nohtml");
                $ptime = check_html($row['ptime'], "nohtml");
                $dcount = $dcount + 1;
                if ($row['status'] == "yes"):
                    $pubcount = $pubcount +1;
                $row['status'] = _YES;
                else:
                    $prvcount = $prvcount + 1;
                $row['status'] = _NO;
                endif;
                print ("<tr>");
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['pdate']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['ptime']);
                printf ("<td align=left bgcolor=$bgcolor2><a href=\"modules.php?name=Journal&file=display&jid=%s\">%s</a>", $jid, $title);
                $sqlscnd = "SELECT cid from ".$user_prefix."_journal_comments where rid=".intval($row['jid']);
                $rstscnd = $db->sql_query($sqlscnd);
                $scndcount = 0;
                while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
                    $scndcount = $scndcount + 1;
                }
                if ($scndcount == 1) {
                    printf (" &#151;&#151; $scndcount "._COMMENT."</td>");
                } else {
                    printf (" &#151;&#151; $scndcount "._COMMENTS."</td>");
                }
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\">%s</div></td>", $row['status']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=modify&jid=%s\"><img src='modules/Journal/images/edit.gif' border='0' alt='"._EDIT."'></a></div></td>", $row['jid']);
                printf ("<td align=center bgcolor=$bgcolor2><div align=\"center\"><a href=\"modules.php?name=Journal&file=delete&jid=%s\"><img src='modules/Journal/images/trash.gif' border='0' alt='"._DELETE."'></a></div></td>", $row['jid']);
                print ("</tr>");
            }
            echo ("</table>");
            if ($prvcount == "") {
                $prvcount = 0;
            }
            if ($pubcount == "") {
                $pubcount = 0;
            }
            if ($dcount == "") {
                $dcount = 0;
            }
            echo "<br /><div align=center>$pubcount "._PUBLICENTRIES." - " ."$prvcount "._PRIVATEENTRIES." - " ."$dcount "._TOTALENTRIES."</div>";
            closeTable();
        }
		if (!isset($disp)) { $disp = ""; }
        switch($disp) {
            case "last":
            list20($username, $bgcolor1, $bgcolor2, $bgcolor3);
            break;
            case "all":
            listall($username, $bgcolor1, $bgcolor2, $bgcolor3, $sitename);
            break;
            default:
            list20($username, $bgcolor1, $bgcolor2, $bgcolor3);
            break;
        }
        journalfoot();
    } else {
        $pagetitle = "- "._YOUMUSTBEMEMBER."";
        $pagetitle = check_html($pagetitle, "nohtml");
        OpenTable();
        echo "<center><strong>"._YOUMUSTBEMEMBER."</strong></center>";
        CloseTable();
        include_once("footer.php");
        die();
    }

?>
