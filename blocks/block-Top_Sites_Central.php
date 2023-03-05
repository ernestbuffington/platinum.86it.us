<?php
/************************************************************************/
/* Block Central Top Sites 6.5 and +                                    */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/*                                                                      */
/* Block central TopSites for PHPNuke 6.5  and +                        */
/* Simple Center Block for TopSites from http://nuke.xanys.com/ module. */   
/* Displays random TopSite and counts clicks, if no banner images link  */
/* is displayed.                                                        */
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
global $prefix, $db;
$content = "<A name= \"scrollingCode\"></A>";
$content .="<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"80\" scrollamount= \"2\" scrolldelay= \"50\" onmouseover='this.stop()' onmouseout='this.start()'>";
$a = 1;
$result4 = $db->sql_query("select lid, title,url,urlban from ".$prefix."_top_sites where urlban <>'' and validation='Y' order by totalvotes desc");
while(list($lid, $title,$url,$urlban) = $db->sql_fetchrow($result4)) {
	$lid =intval($lid);
	$title =stripslashes($title);
	$url =stripslashes($url);
	$urlban =stripslashes($urlban);
$title2 = preg_replace("/_/", " ", $title);
$content .= "<br /><center><a href=\"modules.php?name=Top_Sites&op=visit&amp;lid=$lid\" target=\"_blank\">";
		            if (strpos($urlban,"swf")==TRUE) {
		               $image_size_flash = getimagesize("$urlban");
                       
                       $width=$image_size_flash[0];
                       $height=$image_size_flash[1];
					   $content .= "<center><OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\"width=\"$width\" height=\"$height\"><param name=movie value=\"$urlban\"><param name=quality value=high><param name=bgcolor value=#000000><param name=menu value=false><embed src=\"$urlban\" quality=high bgcolor=#000000  width=400 height=250 type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" menu=\"false\"></embed></object>\n";
			        } else  {
                      $content .="<img src=\"$urlban\" border=\"0\" alt=\"$title\" title=\"$title\"></a>";
                    }
$content .="<br /><strong>$title</strong> [<a href=\"modules.php?name=Top_Sites&op=ratelink&amp;lid=$lid\">VOTE</a> ]</center><br /><br />";
$a++;
}
?>
