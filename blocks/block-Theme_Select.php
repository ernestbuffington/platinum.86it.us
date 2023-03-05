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
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $user, $userinfo, $Default_Theme, $cookie;

getusrinfo($user);
$content .="<center>";
$content .="<br />";
$content .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">";
$content .= "<select name=\"theme\" onchange=submit();>";
$handle=opendir('themes');
while ($file = readdir($handle)) {
if ( (!preg_match("#[.]#",$file)) ) {
$themelist .= "$file ";
}
}
closedir($handle);
$themelist = explode(" ", $themelist);
sort($themelist);
for ($i=0; $i < sizeof($themelist); $i++) {
if($themelist[$i]!="") {
$content .= "<option value=\"$themelist[$i]\" ";
if((($userinfo[theme]=="") && ($themelist[$i]=="$Default_Theme")) || ($userinfo[theme]==$themelist[$i])) $content .= "selected";
$content .= ">$themelist[$i]";
}
}
$content .= "</select>";
$content .= "<input type=\"hidden\" name=\"storynum\" value=\"$userinfo[storynum]\">";
$content .= "<input type=\"hidden\" name=\"ublockon\" value=\"$userinfo[ublockon]\">";
$content .= "<input type=\"hidden\" name=\"ublock\" value=\"$userinfo[ublock]\">";
$content .= "<input type=\"hidden\" name=\"uname\" value=\"$userinfo[uname]\">";
$content .= "<input type=\"hidden\" name=\"user_id\" value=\"$userinfo[user_id]\">";
$content .= "<input type=\"hidden\" name=\"op\" value=\"savetheme\">";
$content .= "</form>";
$content .= "</center>";
?>
