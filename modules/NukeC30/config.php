<?php
######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                     */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


/* Start Temporary Setting */
/* These settings below are temporary for this version. They will moved to database and will manageable through web-based on Next version.*/
$Price_Format_code = 0;  /* Change your desired price format with following format codes*/
	/* Price Format : */
	/*	0 ->  e.g : US$ 1,234.56 */
	/*	1 ->  e.g : 1,234.56 US$ */
	/*	2 ->  e.g : US$ 1 234,56 */
	/*	3 ->  e.g : US$ 1,234.56 */
	/*	4 ->  e.g : US$ 1 234.56 */
	/*	5 ->  e.g : 1 234.56 US */

$Date_Format_code = 0; /* Change your desired Date format with following format codes*/
/* Price Format : */
	/* 0 -> sample : Jan 12, 2003 */
	/* 1 -> sample : HH:MM:SS Jan 12, 2003 */
	/* 2 -> sample : January 12, 2003 */
	/* 3 -> sample : HH:MM:SS January 12, 2003 */
	/* 4 -> sample : mm/dd/yyyy */
	/* 5 -> sample : HH:MM:SS mm/dd/yyyy */

$RepostExpiredAds = 1;
/* 1 = ads owner and admin allowed to Repost */
/* 0 = admin only allowed to Repost */

$EditPostedAds = 1;
/* 1 = ads owner and admin allowed to edit */
/* 0 = admin only allowed to edit */

$DeletePostedAds = 1;
/* 1 = ads owner and admin allowed to delete */
/* 0 = admin only allowed to delete */


$IndexOnMainPage = 1;
$IndexOnSearchPage = 1;
$ListImgLocation = "RIGHT"; /* UP or DOWN or LEFT or RIGHT */
$DetailsImglocation = "DOWN"; /* UP or "DOWN" */


$NukeCEmailFrom = "GCC Ads<info@trickedoutnews.com>";
/* End Temporary Setting*/



$sqlconfig = "select nukecprefix, folder_name, ModuleTitle, AdsTitleLength, AdsContentLength, Waiting, PerPage, UseImgCatg, PostInMainCatg, MemberRequired, AdsComment, PopAds, UploadImg, MaxImgSize, MaxImgHeight, MaxImgWidth, ThumbToHeight, ThumbToWidth, ThumbHeight, ThumbWidth, UploadPath, UploadPathRev, CatgPathRev, CatgPath, MaxAllowedAds from nukec30_ads_config";
$resultconfig = $db->sql_query($sqlconfig);
list ($nukecprefix, $folder_name, $ModuleTitle, $AdsTitleLength, $AdsContentLength, $Waiting, $PerPage, $UseImgCatg, $PostInMainCatg, $MemberRequired, $AdsComment, $PopAds, $UploadImg, $MaxImgSize, $MaxImgHeight, $MaxImgWidth, $ThumbToHeight, $ThumbToWidth, $ThumbHeight, $ThumbWidth, $UploadPath, $UploadPathRev, $CatgPathRev, $CatgPath, $MaxAllowedAds) = $db->sql_fetchrow($resultconfig);

if (preg_match("#config.php#i", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
global $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
$adsbgcolor1 = $bgcolor2;
$adsbgcolor2 = $bgcolor1;
$adsbgcolor3 = $bgcolor2;
$adsbgcolor4 = $bgcolor1;
$adsbgcolor5 = $bgcolor2;

?>