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
global $prefix, $db;
$content .="<center>";
$content .="[ <a href=\"modules.php?name=Top_Sites\">TopSites</a> ] ";
$content .="[ <a href=\"modules.php?name=Top_Sites&op=AddLink\" >Ajouter</a> ]";
$content .="</center>";
$a = 1;
$result = $db->sql_query("select lid, title,url,urlban,hits,totalvotes  from ".$prefix."_top_sites where validation='Y' order by totalvotes DESC limit 0,5");
while(list($lid, $title_1,$url,$urlban,$hits,$totalvotes) = $db->sql_fetchrow($result)) {
	$lid =intval($lid);
	$title_1 =stripslashes($title_1);
	$url =stripslashes($url);
	$urlban =stripslashes($urlban);
	$hits =intval($hits);
	$totalvotes =intval($totalvotes);
	$title2 = preg_replace("/_/", " ", $title_1);
	if ($a==1) {$ab="<img src=\"modules/Top_Sites/images/n1.gif\" width=\"15\" border=\"0\">";}
    
	if ($a==2) {$ab="<img src=\"modules/Top_Sites/images/n2.gif\" width=\"15\" border=\"0\">";}
	if ($a==3) {$ab="<img src=\"modules/Top_Sites/images/n3.gif\" width=\"15\" border=\"0\">";}
	if ($a==4) {$ab="<img src=\"modules/Top_Sites/images/n4.gif\" width=\"15\" border=\"0\">";}
	if ($a==5) {$ab="<img src=\"modules/Top_Sites/images/n5.gif\" width=\"15\" border=\"0\">";}
    $content .= "$ab <a href=\"modules.php?name=Top_Sites&amp;op=visit&amp;lid=$lid&amp;ttitle=$title_1\">$title2</a><br />";
    if ($urlban !="") {
	$content .="<center><a href=\"modules.php?name=Top_Sites&amp;op=visit&amp;lid=$lid&amp;ttitle=$title_1\" target=\"_blank\" ><img src=\"$urlban\" width=\"88\" height=\"31\" border=\"0\"></a></center>";
    }
	$clicks=$hits + $totalvotes;
	$content .="[clicks : $clicks ] [<a href=\"modules.php?name=Top_Sites&op=ratelink&amp;lid=$lid\">Voter</a>]<br /><br />";
	$a++;
}
?>
