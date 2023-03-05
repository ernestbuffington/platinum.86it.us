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
	die("Illegal Block File Access");
}
global $prefix;
$totaltoshow  = 5;
$query="SELECT username, theme, user_avatar, user_from, user_website, user_regdate, user_id from $prefix"._users." ORDER BY user_id DESC LIMIT $totaltoshow"; 
	$result=mysql_query($query);
	while(list($user_name, $theme, $user_avatar, $user_from, $user_website, $user_regdate, $uid) = mysql_fetch_row($result)) {
   if ($user_website == "") {
	$user_website = "Not available";
			}
      $ShowLatestMembers .="<center><font class=\"content\">&nbsp;<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$uid\"><strong>$user_name</strong></a><br />&nbsp;Joined:&nbsp;$user_regdate&nbsp;</font><br /><hr></center>";
}
$content .= "<center>$ShowLatestMembers";
?>
