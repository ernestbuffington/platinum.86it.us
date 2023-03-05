<?php
/********************************************************/
/* Forum Messages v1.0.0                                */
/* By: Telli (telli@codezwiz.com)                       */
/* http://www.codezwiz.com                              */
/* Copyright © 2002-2004 by Codezwiz.com                */
/********************************************************/
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
if (preg_match("/fmessagebox.php/",$_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
function fmessage_box() {
    global $bgcolor1, $bgcolor2, $user, $admin, $cookie, $textcolor2, $prefix, $multilingual, $currentlang, $db;
    if ($multilingual == 1) {
		$querylang = "AND (mlanguage='$currentlang' OR mlanguage='')";
    } else {
		$querylang = "";
    }
    $result = $db->sql_query("SELECT mid, title, content, date, expire, view FROM ".$prefix."_forum_message WHERE active='1' $querylang");
    if ($numrows = $db->sql_numrows($result) == 0) {
		return;
    } else {
	while ($row = $db->sql_fetchrow($result)) {
	    $mid = intval($row['mid']);
	    $title = $row['title'];
	    $content = $row['content'];
	    $mdate = $row['date'];
	    $expire = intval($row['expire']);
	    $view = intval($row['view']);
	if ($title != "" && $content != "") {
	    if ($expire == 0) {
		$remain = _UNLIMITED;
	    } else {
		$etime = (($mdate+$expire)-time())/3600;
		$etime = (int)$etime;
		if ($etime < 1) {
		    $remain = _EXPIRELESSHOUR;
		} else {
		    $remain = ""._EXPIREIN." $etime "._HOURS."";
		}
	    }
	    if ($view == 5 AND paid()) {
            OpenTable();
            echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    	."<font class=\"content\">$content</font>";
			if (is_admin($admin)) {
		    	echo "<br /><br /><center><font class=\"content\">[ "._MVIEWSUBUSERS." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
			}
    		CloseTable();
			echo "<br />";
	    } elseif ($view == 4 AND is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>"
		    ."<br /><br /><center><font class=\"content\">[ "._MVIEWADMIN." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		CloseTable();
		echo "<br />";
	    } elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWUSERS." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
    		CloseTable();
		echo "<br />";
	    } elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWANON." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br />";
	    } elseif ($view == 1) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWALL." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br />";
	    }
	    if ($expire != 0) {
	    	$past = time()-$expire;
		if ($mdate < $past) {
		    $db->sql_query("UPDATE ".$prefix."_forum_message SET active='0' WHERE mid='$mid'");
		}
          }
	  }
	}
    }
  }
fmessage_box();
?>
