<?php
/************************************************************************/
/* Pc-Nuke! Systems -  Advanced Content Management System               */
/* ==================================================================== */
/*    Php based web portal systems & more...                            */
/*    Put together by PcNuke.com                                        */
/*    http://www.pcnuke.com           pcnuke@pcnuke.com                 */
/*                                                                      */ 
/************************************************************************/
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
if (preg_match("/block-Forums.php/", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}
//include_once ('blocks/smileys.php');
global $prefix, $dbi, $sitename, $user, $cookie, $group_id;
$count = 1;
$amount = 5;
$content .="<center> <style=\"text-decoration: none\"><font color=\"#0461ae\"><strong>Last $amount Forum Messages</strong></center>";
$result1 = sql_query("SELECT topic_id, topic_last_post_id, topic_title FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC LIMIT $amount", $dbi);
$content .= "<br />";
while(list($topic_id, $topic_last_post_id, $topic_title) = sql_fetch_row($result1, $dbi)) {
$result2 = sql_query("SELECT topic_id, poster_id, FROM_UNIXTIME(post_time,'%b %d, %Y at %T') as post_time FROM ".$prefix."_bbposts where post_id='$topic_last_post_id'", $dbi);
list($topic_id, $poster_id, $post_time)=sql_fetch_row($result2, $dbi);
/***********************************/
/* AUC Listing - v 1.0.1     START */
/***********************************/
$result3 = sql_query("SELECT username, user_id, user_color_gc FROM ".$prefix."_users where user_id='$poster_id'", $dbi);
list($username, $user_id, $user_color_gc)=sql_fetch_row($result3, $dbi);
$username=UsernameColor($user_color_gc, $username);
/***********************************/
/* AUC Listing - v 1.0.1       END */
/***********************************/
//$topic_title = substr("$topic_title", 0,17);
//$topic_title=parseEmoticons($topic_title);
// Remove the comment below to add the counter
//$content .="<STYLE=\"text-decoration: none\"><font color=\"#666666\"><strong>Message: $count<br></strong>";
$content .= "<center><img src=\"modules/Forums/templates/subSilver/images/icon_mini_message.gif\" border=\"0\"alt=\"\"><a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"style=\"text-decoration: none\"><strong> $topic_title </strong></a><br /><font color=\"#0461ae\"><i>Last post by <a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$user_id\"style=\"text-decoration: none\"> $username </a> on $post_time</i></font><br /><br /></center>";
$count = $count + 1;
}
$content .= "<br /><center>[ <a href=\"modules.php?name=Forums\"style=\"text-decoration: none\">$sitename</a> ]</center>";
//$content .= "<center><img src=\"images/banners/fatalexception-logo-88x31.gif\" border=\"0\"></center>";
$content .= "</a>";
$content .="</center></center>\n";
$content.="<center>";
$content .= "<center><hr noshade width=\"85%\"></center>\n";
$content .= "<a href='modules.php?name=Forums'>Forums</a>      |     <a href='modules.php?name=Forums&file=search'>Search</a>      |     ";
$content .= "<a href='modules.php?name=Forums&file=statistics'>Stats</a>       |      <a href='modules.php?name=Forums&file=ranks'>Ranks</a>       |       <a href='modules.php?name=Forums&file=profile&mode=editprofile'>Profile</a>";
$content .= "<center><hr noshade width=\"85%\"></center>\n";
$content.="</center>";
?>
