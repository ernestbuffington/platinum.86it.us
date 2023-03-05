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
$a = 1;
$content .= "<A name= \"scrollingCode\"></A>";
$content .="<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"180\" scrollamount= \"1\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>";
/********************************/
/* AUC Listing v1.0.1     ADDED */
/********************************/
    global $user, $cookie, $sitename, $prefix, $user_prefix, $dbi, $admin, $module_name;
    $result=sql_query("SELECT user_id, username, user_color_gc, user_posts, user_avatar, points FROM ".$user_prefix."_users ORDER BY user_posts DESC LIMIT 0,10", $dbi);
    while(list($user_id, $username, $user_color_gc, $user_posts, $user_avatar, $points) = sql_fetch_row($result, $dbi)) {
	$username = UsernameColor($user_color_gc, $username);
	$points = intval($points);
$content .= "<div align=\"left\"><table class=\"outer\" cellpadding=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" cellspacing=\"1\" border=\"0\">";
$content .= "<tr class=\"even\" vAlign=\"middle\">";
$content .= "<td align=\"middle\">";
if (preg_match("#http://#", $user_avatar)) {
$content .= "&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img alt src=\"$user_avatar\" border =\"0\" width=\"32\"></a></td>";
}
else
$content .= "&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img alt src=\"modules/Forums/images/avatars/$user_avatar\" border =\"0\" width=\"32\"></a></td>";
$content .= "<td align=\"center\">&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><strong>$username</strong></a>&nbsp;<br />&nbsp;<a href=\"modules.php?name=Forums&amp;file=search&amp;search_author=$username\">Posts:</a>&nbsp;";
$content .= "&nbsp;<a href=\"modules.php?name=Forums&amp;file=search&amp;search_author=$username\">$user_posts</a><br />&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=Top_Users\"><strong>Points:</strong></a><a href=\"modules.php?name=Top_Users\"> $points&nbsp;</a></td>";
$content .= "</tr>";
$content .= "</table></div><hr noshade>";
}
?> 
