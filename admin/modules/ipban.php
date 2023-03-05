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
function main_ban($ip=0) {
    global $prefix, $db, $bgcolor2, $admin_file;
    include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=ipban'>Ban Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._IPBANSYSTEM."</strong></font></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>"._BANNEWIP."</strong><br /><br />";
    echo "<form action='".$admin_file.".php' method='post'>";
    if ($ip != 0) {
        $ip = explode(".", $ip);
        echo "<input type='text' name='ip1' size='4' maxlength='3' value='$ip[0]'> . <input type='text' name='ip2' size='4' maxlength='3' value='$ip[1]'> . <input type='text' name='ip3' size='4' maxlength='3' value='$ip[2]'> . <input type='text' name='ip4' size='4' maxlength='3' value='$ip[3]'>";
    } else {
        echo "<input type='text' name='ip1' size='4' maxlength='3'> . <input type='text' name='ip2' size='4' maxlength='3'> . <input type='text' name='ip3' size='4' maxlength='3'> . <input type='text' name='ip4' size='4' maxlength='3'>";
    }
    echo "<br /><br /><strong>"._REASON."</strong><br /><input type='text' name='reason' size='50' maxlength='255'><br /><br /><input type='hidden' name='op' value='save_banned'><input type='submit' value='Ban this IP'></center>";
    echo "</form>";
    CloseTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_banned_ip"));
    if ($numrows != 0) {
	    echo "<br />";
	    OpenTable();
	    echo "<center><font class=\"title\"><strong>"._IPBANNED."</strong></font><br /><br /></center>"
			."<table border=\"0\" align='center'>"
			."<tr><td bgcolor=\"$bgcolor2\" align='left'>&nbsp;<strong><font class=\"content\">"._IPBANNED."</strong>&nbsp;</td>"
			."<td bgcolor=\"$bgcolor2\" align='left'>&nbsp;<strong><font class=\"content\">"._REASON."</strong>&nbsp;</td>"
			."<td bgcolor=\"$bgcolor2\" align='center'><font class=\"content\">&nbsp;<strong>"._BANDATE."</strong>&nbsp;</td>"
		    ."<td bgcolor=\"$bgcolor2\" align='center'><font class=\"content\">&nbsp;<strong>"._FUNCTIONS."</strong>&nbsp;</td></tr>";
	    $result = $db->sql_query("SELECT * from ".$prefix."_banned_ip ORDER by date DESC");
	    while ($row = $db->sql_fetchrow($result)) {
			echo "<tr><td bgcolor=\"$bgcolor2\" align='left'>&nbsp;<font class=\"content\">$row[ip_address]</td>"
				."<td bgcolor=\"$bgcolor2\" align='center'><font class=\"content\">&nbsp;$row[reason]&nbsp;</td>"
				."<td bgcolor=\"$bgcolor2\" align='center'><font class=\"content\">&nbsp;$row[date]&nbsp;</td>"
		    	."<td bgcolor=\"$bgcolor2\" align='center'><font class=\"content\"><a href=\"".$admin_file.".php?op=ipban_delete&id=$row[id]&ok=0\">"._UNBAN."</a></td></tr>";
	    }
	    echo "</table>";
	    CloseTable();
    }
	include_once("footer.php");
}
function save_banned($ip1, $ip2, $ip3, $ip4, $reason) {
	global $prefix, $db;
    include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=ipban'>Ban Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._IPBANSYSTEM."</strong></font></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
	if (substr($ip2, 0, 2) == 00) { $ip2 = preg_replace("/00/", "", $ip2); }
	if (substr($ip3, 0, 2) == 00) { $ip3 = preg_replace("/00/", "", $ip3); }
	if (substr($ip4, 0, 2) == 00) { $ip4 = preg_replace("/00/", "", $ip4); }
	$ip = "$ip1.$ip2.$ip3.$ip4";
	if ($ip1 == "" OR $ip2 == "" OR $ip3 == "" OR $ip4 == "") {
		echo "<center><strong>"._ERROR."</strong> "._IPOUTRANGE."<br /><br />"._IPENTERED." <strong>$ip1.$ip2.$ip3.$ip4</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();
	}
    if (!is_numeric($ip1) && !empty($ip1) OR !is_numeric($ip2) && !empty($ip2) OR !is_numeric($ip3) && !empty($ip3) OR !is_numeric($ip4) && !empty($ip4)) {
		echo "<center><strong>"._ERROR."</strong> "._IPNUMERIC."<br /><br />"._IPENTERED." <strong>$ip1.$ip2.$ip3.$ip4</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();
	}
	if ($ip1 > 255 OR $ip2 > 255 OR $ip3 > 255 OR $ip4 > 255) {
		echo "<center><strong>"._ERROR."</strong> "._IPOUTRANGE."<br /><br />"._IPENTERED." <strong>$ip1.$ip2.$ip3.$ip4</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();
	}
	if (substr($ip1, 0, 1) == 0) {
        
		echo "<center><strong>"._ERROR."</strong> "._IPSTARTZERO."<br /><br />"._IPENTERED." <strong>$ip1.$ip2.$ip3.$ip4</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();	
	}
	if ($ip == "127.0.0.1") {
		echo "<center><strong>"._ERROR."</strong> "._IPLOCALHOST."<br /><br />"._IPENTERED." <strong>127.0.0.1</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();	
	}
	$my_ip = $_SERVER["REMOTE_ADDR"];
	if ($ip == $my_ip) {
		echo "<center><strong>"._ERROR."</strong> "._IPYOURS."<br /><br />"._IPENTERED." <strong>$ip</strong><br /><br />"._GOBACK."</center>";
		CloseTable();
		include_once("footer.php");
		die();
	}
	$date = date("Y-m-d");
	$db->sql_query("INSERT INTO ".$prefix."_banned_ip VALUES (NULL, '$ip', '$reason', '$date')");
	echo "<center>"._SUCCESS."<br /><br />"._THEIP." <strong>$ip</strong> "._HASBEENBANNED."</center>";
	CloseTable();
	include_once("footer.php");
}
function ipban_delete($id, $ok) {
	global $prefix, $db, $admin_file;
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banned_ip WHERE id='$id'"));
	if ($ok == 0) {
	    include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=ipban'>Ban Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	    OpenTable();
	    echo "<center><font class=\"title\"><strong>"._IPBANSYSTEM."</strong></font></center>";
	    CloseTable();
	    echo "<br />";
	    OpenTable();
		echo "<center>"._SURETOBANIP." <strong>$row[ip_address]</strong><br /><br />[ <a href='".$admin_file.".php?op=ipban_delete&id=$id&ok=1'>"._YES."</a> | <a href='".$admin_file.".php?op=ipban'>"._NO."</a> ]";
		CloseTable();
		include_once("footer.php");
	} elseif ($ok == 1) {
		$db->sql_query("DELETE FROM ".$prefix."_banned_ip WHERE id='$id'");
		Header("Location: ".$admin_file.".php?op=ipban");	
	}
}
switch($op) {
	case "ipban":
	main_ban($ip);
	break;
    case "save_banned":
    save_banned($ip1, $ip2, $ip3, $ip4, $reason);
    break;
    case "ipban_delete":
    ipban_delete($id, $ok);
    break;
}
} else {
    echo "Access Denied";
}
?>
