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
//******************************************************************
//* PHP-NUKE Blocks: Last Referers 1.2                             *
//* Initial block Copyright (c) 2004 by VinDSL                     *
//*  perfect.pecker@lycos.co.uk                                    *
//*                                                                *
//* http://www.Lenon.com                                           *
//* http://www.Disipal.net                                         *
//* http://www.NukeCops.com                                        *
//* http://www.maniaxdream.com                                     *
//*                                                                *
//* This block is a hack of the PHP-Nuke 'Last Referers' block.    *
//* You can choose the number of items to display, and whether or  *
//* not you wish them to scroll or be static.                      *
//*                                                                *
//* Added Tech0crat's code to remove your site from the referers   *
//* http://www.www.techn0crat.com                                  *
//*                                                                *
//* Two Flavours: Center and side block.                           *
//* Cooked up by Lqd                                               *
//* http://maniaxdream.com                                         *
//*                                                                *
//* Release date: 10-Feb-2002                                      *
//******************************************************************
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db, $admin, $user;
//Read carefully and follow instructions.
//
//Modify the following to your personal taste
//
$ref = 50;                      //Change the ammount of referers you wawnt to display.
$usemarquee = true;             //True for scrolling block, False for static.
//
//
$a = 1;
//
//
//
//Find: [YOURSITE] in the line below and replace with: %nukecops% for example. 
//The domein which is entered here does not apprear in the referers.
$result = $db->sql_query("SELECT rid, url from " . $prefix . "_referer WHERE url NOT LIKE '%YOURSITE%'"); 
//End of editing.
//
//
//Do not change the code below this point unless you know what you are doing.
//
if ($usemarquee == true)
$content .= "<marquee behavior=\"scroll\" direction=\"up\" height=\"150\" scrollamount=\"2\" scrolldelay=\"100\" onmouseover='this.stop()' onmouseout='this.start()'>\n";
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
$content  .= "<img border=\"0\" src=\"/images/ref.gif\" width=\"80\" height=\"15\"><br><br>";
while ($row = $db -> sql_fetchrow($result)){
$rid = intval($row['rid']);
$url = $row['url'];
$url2 = preg_replace("/_/", " ", $url);
if(strlen($url2) > 18){
$url2 = substr($url, 0, 20);
$url2 .= "..";
}
$content .= "<tr><td valign=\"top\">$a:&nbsp;<a href=\"$url\" target=\"new\">$url2</a></td></tr>\n";
$a++;
}
if (is_admin($admin)){
    $total = $db -> sql_numrows($db -> sql_query("SELECT * FROM " . $prefix . "_referer"));
    $content .= "<tr><td align=\"left\" valign=\"top\">·<a href=\"admin.php?op=delreferer\">" . _DELETE . "</a>·</td></tr>\n";
    }
$content .= "</table>\n";
if ($usemarquee == true)
$content .= "</marquee>\n";
// This link will be display only for anonymous users...
// If you would like to see future works, let it remain.
// It's a copyright.  Don't remove it!
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
if (!isset($user)){
$content .= "<tr><td align=\"right\"><a href=\"http://www.lenon.com/modules.php?name=Docs&file=terms\"><font style=\"font:9px,Arial\">&copy;&nbsp;VinDSL,&nbsp;</font>&nbsp;&nbsp;</a></td></tr>\n";
$content .= "<tr><td align=\"right\"><a href=\"http://www.techn0crat.com\"><font style=\"font:9px,Arial\">&nbsp;Techn0crat &&nbsp;</font>&nbsp;&nbsp;</a></td></tr>\n";
$content .= "<tr><td align=\"right\"><a href=\"http://www.maniaxdream.com\"><font style=\"font:9px,Arial\">&nbsp;Maniaxdream.&nbsp;</font>&nbsp;&nbsp;</a></td></tr>\n";
    }
$content .= "</table>\n";
?>
