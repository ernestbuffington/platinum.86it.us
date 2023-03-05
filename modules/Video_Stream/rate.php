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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}

if(($ratingV == 1) && ($looker == "Anonymous")) {
	echo ""._REGRATE."";
} else {
	$rate = $_GET['rate'];
	$id = $_GET['id'];
	$vsratingcookie = $_COOKIE["video_stream_rating"];
	$vsratingcookie = explode(':', $vsratingcookie);
	if($rate != "1" && $rate != "2" && $rate != "3" && $rate != "4" && $rate != "5") {
		echo "Error in voting!!";
	} else {
		if(array_search($id, $vsratingcookie) !== false) {
			echo "You have already voted for this video";
		} else {
			$result = $db->sql_query("SELECT rates, rating FROM ".$prefix."_video_stream WHERE id='$id'");
			$row = $db->sql_fetchrow($result);
			$rates = $row['rates'];
			$rating = $row['rating'];
			
			$rates++;
			$rating += $rate;
	
			userpointsVS(5);
			$result = $db->sql_query("UPDATE ".$prefix."_video_stream SET rates='$rates', rating='$rating' WHERE id='$id'");
			$vsratingcookie = implode(':', $vsratingcookie);
			$vsratingcookie = $vsratingcookie.":".$id;
			setcookie("video_stream_rating", $vsratingcookie, time()+(60*60*24*356));
			echo _TYRATE;
		}
	}
}
?>