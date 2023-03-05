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
if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));

$index = 1;

function index() {
	global $module_name, $admin, $user, $cookie, $prefix, $user_prefix, $db, $anonymous,$name,$lang;
    include_once("header.php");
    OpenTable();
echo "<center><strong>Who is Where</strong></center><br />";
   
//
// language system
//

define('_MIN','&#039; ');
define('_SEC','&quot;');

if ($lang=='french') {
	define("_MEMBRES","Membres ");
	define("_VISITEURS","Visiteurs ");
	define("_VISITEUR","Visiteur ");
} else if ($lang=='russian') {
	define("_MEMBRES","Члены");
	define("_VISITEURS","Посетители");
	define("_VISITEUR","Посетители");
} else if ($lang=='spanish') {
	define("_MEMBRES","Miembro");
	define("_VISITEURS","Visitante");
	define("_VISITEUR","Visitantes");
} else if ($lang=='italian') {
	define("_MEMBRES","Membri");
	define("_VISITEURS","Ospiti");
	define("_VISITEUR","Ospite");
} else if ($lang=='portuguese') {
	define("_MEMBRES","Miembro");
	define("_VISITEURS","Visitantes");
	define("_VISITEUR","Visitante");
} else {
	define("_MEMBRES","Members");
	define("_VISITEURS","Visitors");
	define("_VISITEUR","Visitor");
}

//
// Init
//

$who_online[0] = "";
$who_online[1] = "";
$num[0] = 1;
$num[1] = 1;

/**
 * function that displays 
 * int timeSec : time in seconds
 * @return String timeDisplay
 */
function displayTime2($sec) {
	$minutes = floor($sec / 60);
	$seconds = $sec % 60;
	if ($minutes == 0) {
		return $seconds . _SEC;
	}
	return $minutes . _MIN . $seconds . _SEC;
}

//
// Query
//

$result = $db->sql_query("select username, guest, module, url, UNIX_TIMESTAMP(now())-time AS time from ".$prefix."_whoiswhere order by username");
$member_online_num  = $db->sql_numrows($result);

//
// Display Section
//
while ($session = $db->sql_fetchrow($result)) {
	//--- guest can only be 0 or 1
	$guest = $session["guest"];
	if ($num[$guest] < 10) {
		$who_online[$guest] .= "0";
	}
	
	if ($guest == 0) {
		$title = "<A HREF=\"modules.php?name=Your_Account&op=userinfo&uname=$session[username]\" title=\"" . displayTime2($session[time]) . "\">$session[username]</a>";
	} else {
		//--- Anonymous user
		if (isset($admin)) {
			$title = '<A title="' . displayTime2($session[time]) . "\">$session[username]</a>";
		} else {
			$title = '<A title="' . displayTime2($session[time]) . '">' . _VISITEUR . '</a>';
		}
	}

	$who_online[$guest] .= "$num[$guest]:&nbsp;$title -&gt; <a href=\"$session[url]\" target=\"_blank\">$session[module]</a><br />\n";
	$num[$guest]++;
}

//--- Members
if ($who_online[0] != "") {
	$content = "<img src=\"images/Who-is-Where/members.gif\">&nbsp;<span class=\"content\"><strong>"._MEMBRES.":</strong></span><br />$who_online[0]<br />";
}

//--- Anonymous
if ($who_online[1] != "") {
	$content .= "<img src=\"images/Who-is-Where/visitors.gif\">&nbsp;<span class=\"content\"><strong>"._VISITEURS.":</strong></span><br />$who_online[1]";
}


    CloseTable();
    include_once("footer.php");

}


switch($func) {

    default:
    index();
    break;


}

?>