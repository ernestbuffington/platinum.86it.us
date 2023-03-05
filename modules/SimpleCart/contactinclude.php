<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* SimpleCart V0.81 for PHP-Nuke                                        */
/* Copyright (c) 2006 by Kevin Atwood                                   */
/* http://dadanuke.org                                                  */
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

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
include_once("modules/SimpleCart/language/lang-$language.php");
include_once("config.php");
include_once("header.php");
$result = $db->sql_query("SELECT scmail, scsubject, sccontact, sccontactsubject, scname from ".$prefix."_simplecart_config");
list($scmail, $scsubject, $sccontact, $sccontactsubject, $scname) = $db->sql_fetchrow($result);
global $sitename;

function themenu() {
	global $op;
	echo "<br />";
	OpenTable();
	echo "<center><strong>"._SCMENU."</strong><br /><br />[ <a href=\"modules.php?name=SimpleCart&op=SimpleCart\">"._SCMAINPAGEMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=products\">"._SCPRODUCTSMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=services\">"._SCSERVICESMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=specials\">"._SCSPECIALSMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=featured\">"._SCFEATUREMENU."</a> ] <br />[ <a href=\"modules.php?name=SimpleCart&op=referrals\">"._SCREFERRALSMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=policies\">"._SCPOLICIESMENU."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._SCCONTACTMENU."</a> ]</center>";
	CloseTable();
}

if ($sender == "" || $email == "" ||$comments == ""){
    OpenTable();
    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">"
    ."<tr>"
    ."<td><center>"
    ."<h5>"._KONTAKTPEALKIRI." </h5><br />"._KONTAKTTEADE."<br /><br />"
    ."<a href=\"javascript:history.go(-1)\">"._LIITUMISBACK."</a><br /><br />"
    ."</center>"
    ."</td>"
    ."</tr>"
    ."</table>";

}else{
    
	mail("$sccontact",
    "$sccontactsubject",
    "___________________________________________________________
    "._KONINFO." - $sitename
    "._KONSAATJA.": $sender
    "._KONEMAIL.": $email
    "._KONURL.": $url
    "._KONTELEFON.": $telefon
    "._KONHOSTIP.": $hostip
    "._KONHOST.": $host
    "._KONVIITATUD.": $referer
    ____________________________________________________________

    $comments",
    "From: $email\nReply-To: $email\nX-Mailer: PHP/".phpversion());
    OpenTable();
    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">"
    ."<tr>"
    ."<td><center>"
    ."<h5>"._KONTAKTEDASTATUD." </h5><br />"._KONTAKTTANUD."<br /><br />"
    ."<a href=\"javascript:history.go(-1)\">"._LIITUMISBACK."</a><br /><br />"
    ."</center>"
    ."</td>"
    ."</tr>"
    ."</table>";
}

    CloseTable();
    themenu();
    include_once("footer.php");

?>