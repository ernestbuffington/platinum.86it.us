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
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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
if (preg_match("/block-NukeC30Latest.php/", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
global $db, $user_prefix, $bgcolor1, $bgcolor2;
/** Block Settings **/
$nukecprefix = "nukec30";
$NumberAdsBlock = 6;
$BlockTitleBgColor = "$bgcolor1";
$BlockContentBgColor = "$bgcolor2";
$Chars2Break = 100;
/** Block Settings **/
$nowdatetmpblck = date("H i s m d Y");
$datearraytmpblck = explode (" ", $nowdatetmpblck);
$mktimeUnixblock = mktime($datearraytmpblck[0],$datearraytmpblck[1],$datearraytmpblck[2],$datearraytmpblck[3],$datearraytmpblck[4],$datearraytmpblck[5]);
$sqllatest = "select id_ads,title, ads_desc, imageads, submitter, curr, price from ".$nukecprefix."_ads_ads where active = '1' and validuntil > '".$mktimeUnixblock."' order by dateposted DESC limit 0,".$NumberAdsBlock;
$resultlatest = $db->sql_query($sqllatest);
if ($db->sql_numrows($resultlatest) > 0) {
	$content = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	while (list ($id_ads, $title, $ads_descB, $imageads, $submitter, $currencycodeB, $valuepriceB) =$db->sql_fetchrow($resultlatest)) {
		$sqlBlock = "select username from $user_prefix"."_users where user_id='$submitter'";
		$resBlock = $db->sql_query($sqlBlock);
		list($submitter_username) = $db->sql_fetchrow($resBlock);
		$content .= "<tr><td>";
		$content .= "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";
		$content .= "<tr><td bgcolor=\"$BlockTitleBgColor\" height=\"15\"><b>".$title."</b></td></tr>";
		$content .= "<tr><td valign=\"top\" bgcolor=\"$BlockContentBgColor\">";
		if ($imageads != "") {
			$imageadsexploded = explode(".",$imageads);
			$imageads_thumb = $imageadsexploded[0]."_thumb.".$imageadsexploded[1];
			$fileLocation = "modules/NukeC30/imageads/$imageads_thumb";
			if (file_exists($fileLocation)) {
			$ImgSizeBlock = getimagesize($fileLocation);
			$ImgwidthB = $ImgSizeBlock[0];
			$ImgheightB = $ImgSizeBlock[1];
			if ($ImgwidthB > 75) {
				$new_wp     = (100 * 75) / $ImgwidthB;
				$new_height = ($ImgheightB * $new_wp) / 100;
			} else {
				$new_wp = $ImgwidthB;
				$new_height = $ImgheightB;
			}
			$content .= "<img alt=\"$title\" src=\"modules/NukeC30/imageads/$imageads_thumb\" width=\"$new_wp\" height=\"$new_height\" align=\"left\" />";
			}
		}
		$content .= "By <b>$submitter_username</b><br />";
		if (($valuepriceB != "") and ($valuepriceB != 0)) {
			$resultcurrB = $db->sql_query("select curr from ".$nukecprefix."_ads_currency where no='$currencycodeB'");
			list($currencynameB) = $db->sql_fetchrow($resultcurrB);
			$content .= $currencynameB." ".number_format($valuepriceB,2)."<br />";
		}
		$its_url = "<a title=\"Chi ti&#7871;t\" href=\"modules.php?name=NukeC30&op=ViewDetail&id_ads=".$id_ads."\">Details</a>";
		$ads_descBroke = strip_tags(BreakQuoteatLatest ($ads_descB, $Chars2Break, $its_url));
		$content .= "$ads_descBroke</td>";
		$content .= "</tr>";
		$content .= "</table>";
	}
	$content .= "<tr><td align=\"right\"><a title=\"Qu&#7843;ng cáo trang chính\" href=\"modules.php?name=NukeC30\">More ads like this &raquo;&raquo;</a></td></tr>";
	$content .= "</table><br />";
	$db->sql_freeresult($resultlatest);
} else {
	$content = "No Ads submitted yet";
}
function BreakQuoteatLatest ($string_to_break, $CharsLimit, $its_url) {
	$Chars_LIMIT = $CharsLimit;
	if(strlen($string_to_break) >  $Chars_LIMIT) {
		$string = substr($string_to_break,0,$Chars_LIMIT-1);
		if($string != " ") {
			$last_space = strrpos($string, " ");
			$string = substr($string_to_break,0,$last_space);
			$QuoteReturn = $string."...";
		} else {
			$QuoteReturn = $string."...";
		}
		$QuoteReturn .= "<br />$its_url";
	} else {
		$QuoteReturn = $string_to_break;
	}
	return $QuoteReturn;
}
?>
