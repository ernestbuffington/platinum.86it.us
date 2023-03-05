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
/////////////////////////////////////////////////////////////////////
//                                                                 //
// block-Nuke_Blog.php for the RavenNuke content management //
// system                                                          //
//  You may redistribute this block                       //
//                                                                 //
/////////////////////////////////////////////////////////////////////
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $user_prefix, $multilingual, $currentlang, $db;
$content = "<br />";
$sql = "SELECT blog_id, user_id, blog_title, blog_date, blog_views FROM nuke_blog_blogs WHERE blog_status != '0' ORDER BY blog_id DESC LIMIT 0,5";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $blog_id = $row['blog_id'];
    $auth_id = $row['user_id'];
    $blog_title = $row[blog_title];
    $blog_date = $row[blog_date];
    $counter = $row[blog_views];
$sql2 = "SELECT username FROM " . $user_prefix . "_users WHERE user_id = '" .$auth_id . "'";
        $result2 = $db->sql_query($sql2);
        while ($row2 = $db->sql_fetchrow($result2)) {
            $username = $row2[username];
        } 
	$sql3 = "SELECT comm_id FROM " . $prefix . "_blog_comments WHERE blog_id = '" . $blog_id . "'";
       $result3 = $db->sql_query($sql3);	   
    $num_comms = $db->sql_numrows($result3);	
    $content .= '<a href="modules.php?name=NukeBlog&op=fetch_blog&blog_id=' .$blog_id . '">' . $blog_title . '</a><br />Author:&nbsp;<i>(' . $username . ')</i><br />Views:&nbsp;<i>(' . $counter . ')</i><br />Comments:&nbsp;<i>(' . $num_comms . ')</i><br />Posted On:&nbsp;<i>(' . $blog_date . ')</i><hr />';
}
$content .= '<br /><center>[ <a href="modules.php?name=NukeBlog">More Blogs</a> ]</center>';
?>
