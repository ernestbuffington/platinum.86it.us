<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-Classifeds_Latest.php")) {
    Header("Location: ../index.php");
    die();
}

global $db, $user_prefix, $prefix;
/** Block Settings **/
$NumberAdsBlock = 5;
$BlockTitleBgColor = "#9CC3F8";
$BlockContentBgColor = "#F7FAF3";

/** Block Settings **/


$nowdatetmpblck = date("H i s m d Y");
$datearraytmpblck = explode (" ", $nowdatetmpblck);
$mktimeUnixblock = mktime($datearraytmpblck[0],$datearraytmpblck[1],$datearraytmpblck[2],$datearraytmpblck[3],$datearraytmpblck[4],$datearraytmpblck[5]);


$sqllatest = "select id_ads,title, ads_desc, imageads, submitter, curr, price from ".$prefix."_nukec30_ads_ads where active = '1' and validuntil > '".$mktimeUnixblock."' order by dateposted DESC limit 0,".$NumberAdsBlock;

$resultlatest = $db->sql_query($sqllatest);
if ($db->sql_numrows($resultlatest) > 0) {
	$content = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	while (list ($id_ads, $title, $ads_descB, $imageads, $submitter, $currencycodeB, $valuepriceB) = $db->sql_fetchrow($resultlatest)) {
		$sqlBlock = "select username from ".$user_prefix."_users where user_id='$submitter'";
		$resBlock = $db->sql_query($sqlBlock);
		
		list($submitter_username) = $db->sql_fetchrow($resBlock);
		$content .= "<TR><TD>";
		$content .= "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";
		$content .= "<TR><TD colspan=\"2\" bgcolor=\"$BlockTitleBgColor\" height=\"15\"><strong>".$title."</strong></td></tr>";
		
		if ($imageads != "") {
			$imageadsexploded = explode(".",$imageads);
			$imageads_thumb = $imageadsexploded[0]."_thumb.".$imageadsexploded[1];
			$fileLocation = "modules/Classifieds/imageads/$imageads_thumb";
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
			
			$content .= "<TR ><TD valign=\"top\" bgcolor=\"$BlockContentBgColor\"><img alt=\"$title\" src=\"modules/Classifieds/imageads/$imageads_thumb\" width=\"$new_wp\" height=\"$new_height\"></td>";
			}
		}
		$content .= "<TD width=\"100%\" bgcolor=\"$BlockContentBgColor\">By <strong>$submitter_username</strong><BR>";
		$resultcurrB = $db->sql_query("select curr from ".$prefix."_nukec30_ads_currency where no='$currencycodeB'");
		list($currencynameB) = $db->sql_fetchrow($resultcurrB);
		$content .= $currencynameB." ".number_format($valuepriceB,2)."<BR>";
		$DescBlock = substr($ads_descB,0,50);
		$content .= $DescBlock."...";
        //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
		$content .= " <a href=\"advert-view-details-$id_ads.html\">details &raquo;&raquo; </a>";
		$content .= "</td>";
		$content .= "</tr>";
		
		$content .= "</table>";
		
	}
	$content .= "<TR><TD align=\"right\"><a href=\"adverts.html\">More ads like this &raquo;&raquo;</a></td></tr>";
	$content .= "</table><BR>";
	sql_free_result($resultlatest);
} else {
	$content = "No Ads submitted yet";
}

?>
