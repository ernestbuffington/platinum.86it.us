<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

if (stristr($_SERVER['SCRIPT_NAME'], "links.php")) {
	die("Illegal Desolate File Access");
}

	if ($sortletter) {
		$sortlink = "&amp;sortletter=$sortletter";
	}
	
	if (getconfigvar("phpbb_pages") == 1) {
			if (!$start == 0) {
				$pagelink = "&amp;start=$start";	
			} else {
				$pagelink = "";
			}
		} else {
			if (!$page == 1) {
				$pagelink = "&amp;page=$page";	
			} else {
				$pagelink = "";
			}
	}

  echo "<tr>"
    ."<td width=\"100%\" valign=\"top\" colspan=\"2\"><font class=\"content\"><center><hr>"
    .""._SITEMS.": "._TITLE." (<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=titleA$sortlink$pagelink\">A</a>\<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=titleD$sortlink$pagelink\">D</a>) "._DATE." (<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=dateA$sortlink$pagelink\">A</a>\<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=dateD$sortlink$pagelink\">D</a>) "._RATINGS." (<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=ratingA$sortlink$pagelink\">A</a>\<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=ratingD$sortlink$pagelink\">D</a>) "._POP." (<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=hitsA$sortlink$pagelink\">A</a>\<a href=\"modules.php?name=$modulename&amp;op=CatIndex&amp;cid=$cid&amp;orderby=hitsD$sortlink$pagelink\">D</a>)<br />";
    $orderbyTrans = convertorderbytrans($orderby);
	echo "<strong>"._SORTBY.": $orderbyTrans</strong>"
    ."<hr></center></font></td>"
  ."</tr>";
  
?>