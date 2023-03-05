<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */ 
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/
if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
/*********************************************************/
/* Comments Delete Function                              */
/*********************************************************/
/* Thanks to Oleg [Dark Pastor] Martos from http://www.rolemancer.ru */
/* to code the comments childs deletion function!                    */
function removeSubComments($tid) {
    global $prefix, $db;
    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from " . $prefix . "_comments where pid='$tid'");
    $numrows = $db->sql_numrows($result);
    if($numrows>0) {
    while ($row = $db->sql_fetchrow($result)) {
	$stid = intval($row['tid']);
            removeSubComments($stid);
            $stid = intval($stid);
            $db->sql_query("delete from " . $prefix . "_comments where tid='$stid'");
        }
    }
    $db->sql_query("delete from " . $prefix . "_comments where tid='$tid'");
}
function removeComment ($tid, $sid, $ok=0) {
    global $ultramode, $prefix, $db, $admin_file;
    if($ok) {
        $tid = intval($tid);
        $result = $db->sql_query("SELECT date from " . $prefix . "_comments where pid='$tid'");
        $numresults = $db->sql_numrows($result);
        $sid = intval($sid);
        $db->sql_query("update " . $prefix . "_stories set comments=comments-1-'$numresults' where sid='$sid'");
    /* Call recursive delete function to delete the comment and all its childs */
        removeSubComments($tid);
        if ($ultramode) {
    	    ultramode();
        }
        Header("Location: modules.php?name=News&file=article&sid=$sid");
    } else {
	include_once("header.php");
        //GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>" . _REMOVECOMMENTS . "</strong></font></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
        echo "<center>" . _SURETODELCOMMENTS . "";
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=RemoveComment&tid=$tid&sid=$sid&ok=1\">" . _YES . "</a> ]</center>";
	CloseTable();
        include_once("footer.php");
    }
}
function removePollSubComments($tid) {
    global $prefix, $db;
    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from " . $prefix . "_pollcomments where pid='$tid'");
    $numrows = $db->sql_numrows($result);
    if($numrows>0) {
    while ($row = $db->sql_fetchrow($result)) {
	$stid = intval($row['tid']);
            removePollSubComments($stid);
            $db->sql_query("delete from " . $prefix . "_pollcomments where tid='$stid'");
        }
    }
    $db->sql_query("delete from " . $prefix . "_pollcomments where tid='$tid'");
}
function RemovePollComment ($tid, $pollID, $ok=0) {
	global $admin_file;
    if($ok) {
        removePollSubComments($tid);
        Header("Location: modules.php?name=Surveys&op=results&pollID=$pollID");
    } else {
	include_once("header.php");
        //GraphicAdmin();
	OpenTable();
	echo "<center><font class=\"title\"><strong>" . _REMOVECOMMENTS . "</strong></font></center>";
	CloseTable();
	echo "<br />";
	OpenTable();
        echo "<center>" . _SURETODELCOMMENTS . "";
        
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=RemovePollComment&tid=$tid&pollID=$pollID&ok=1\">" . _YES . "</a> ]</center>";
	CloseTable();
        include_once("footer.php");
    }
}
switch ($op) {
    case "RemoveComment":
    removeComment ($tid, $sid, $ok);
    break;
    case "removeSubComments":
    removeSubComments($tid);
    break;
    case "removePollSubComments":
    removePollSubComments($tid);
    break;
    case "RemovePollComment":
    RemovePollComment($tid, $pollID, $ok);
    break;
}
} else {
    echo "Access Denied";
}
?>
