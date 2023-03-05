<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to configure the main options for NukeC30 Addon
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                    */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                     */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('ADMIN_FILE') )

{

	die ("Access Denied");

}


global $prefix, $db, $admin_file;

$aid = substr("$aid", 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));

if ($row['radminsuper'] == 1) {

$NukeCAddonName = "NukeC30";
include_once("modules/".$NukeCAddonName."/functions.php");
include_once("modules/".$NukeCAddonName."/language/lang-".$currentlang.".php");

function NukeCSetting(){ /* Start Function NukeCSetting */
	global $nukecprefix,$db;
	global $NukeCAddonName, $ModuleTitle, $AdsTitleLength, $AdsContentLength, $Waiting, $PerPage, $UseImgCatg, $PostInMainCatg, $MemberRequired, $AdsComment, $PopAds, $UploadImg, $MaxImgSize, $MaxImgHeight, $MaxImgWidth, $ThumbToHeight, $ThumbToWidth, $ThumbHeight, $ThumbWidth, $UploadPath, $UploadPathRev, $CatgPath, $CatgPathRev, $MaxAllowedAds, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$admintitle = _NUKECADMINTITLE." - "._NUKECSETTING;
	include_once("header.php");
	
	GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
	echo "<form action=\"admin.php?op=NukeC30SaveSetting\" name=\"PrefForm\" method=\"post\">";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\" align=\"center\"><strong>".$admintitle."</strong></td></tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">NukeC30 Tables prefix</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xnukecprefix\" size=\"15\" value=\"".$nukecprefix."\" maxlength=\"25\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">NukeC30 Module Folder Name</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xfolder_name\" size=\"25\" value=\"".$NukeCAddonName."\" maxlength=\"25\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">NukeC30 Module Page Title</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xModuleTitle\" size=\"40\" value=\"".$ModuleTitle."\" maxlength=\"140\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Maximal ads allowed</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xMaxAllowedAds\" size=\"5\" value=\"".$MaxAllowedAds."\" maxlength=\"4\" /></td>\n"
		."</tr>";
		
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Title Max Chars</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xAdsTitleLength\" size=\"6\" value=\"".$AdsTitleLength."\" maxlength=\"7\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Content Max Chars</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xAdsContentLength\" size=\"6\" value=\"".$AdsContentLength."\" maxlength=\"7\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Status Submitted Ads</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xWaiting",$valueradio = "$Waiting",$JScript="",$Text1="Pending for process",$Text2="Automatically Posted");
	echo "</td>\n"
		."</tr>";
		
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Views Perpage</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xPerPage\" size=\"5\" value=\"".$PerPage."\" maxlength=\"4\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Use Image Category</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xUseImgCatg",$valueradio = "$UseImgCatg",$JScript="",$Text1="Yes",$Text2="No");
	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Post in main category</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xPostInMainCatg",$valueradio = "$PostInMainCatg");
	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Member Required</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xMemberRequired",$valueradio = "$MemberRequired",$JScript="",$Text1="Yes",$Text2="No");
	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Comments</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xAdsComment",$valueradio = "$AdsComment");
	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads in popular page</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xPopAds\" size=\"5\" value=\"".$PopAds."\" maxlength=\"4\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Upload Image Ads</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	echo buildOptionSelectAllow($selectname = "xUploadImg",$valueradio = "$UploadImg");
	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Max image ads size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xMaxImgSize\" size=\"6\" value=\"".$MaxImgSize."\" maxlength=\"5\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Max image height</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xMaxImgHeight\" size=\"6\" value=\"".$MaxImgHeight."\" maxlength=\"5\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Max image width</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xMaxImgWidth\" size=\"6\" value=\"".$MaxImgWidth."\" maxlength=\"5\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Thumbnail to </td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">";
	/*
	xThumbTo = 1; Thumb To Width 
	xThumbTo = 0; Thumb To Height
	*/
	
	if ($ThumbToWidth) {
		$TH = "<input type=\"radio\" name=\"xThumbTo\" value=\"0\" />";
		$TW = "<input type=\"radio\" name=\"xThumbTo\" value=\"1\" checked=\"checked\" />";
	} else {
		$TH = "<input type=\"radio\" name=\"xThumbTo\" value=\"0\" checked=\"checked\" />";
		$TW = "<input type=\"radio\" name=\"xThumbTo\" value=\"1\">";
	}
	echo $TH."Thumb to Height ".$TW."Thumb to Width";
 	echo "</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Thumbnail height size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xThumbHeight\" size=\"6\" value=\"".$ThumbHeight."\" maxlength=\"5\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Thumbnail width size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xThumbWidth\" size=\"6\" value=\"".$ThumbWidth."\" maxlength=\"5\" /></td>\n"
		."</tr>";
		
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Image upload full path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xUploadPath\" size=\"55\" value=\"".$UploadPath."\" maxlength=\"140\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Image path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xUploadPathRev\" size=\"55\" value=\"".$UploadPathRev."\" maxlength=\"140\" /></td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Category Image upload path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xCatgPath\" size=\"55\" value=\"".$CatgPath."\" maxlength=\"140\" /></td>\n"
		."</tr>";

	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\">Ads Category Image path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xCatgPathRev\" size=\"55\" value=\"".$CatgPathRev."\" maxlength=\"140\" /></td>\n"
		."</tr>";
		
	
	echo "<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Save Setting\" /></td></tr>";
	echo "</form></table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}/* END Function NukeCSetting */


/* Start Function NukeCSaveSetting */
function NukeCSaveSetting($xnukecprefix, $xfolder_name, $xModuleTitle, $xAdsTitleLength, $xAdsContentLength, $xWaiting, $xPerPage, $xUseImgCatg, $xPostInMainCatg, $xMemberRequired, $xAdsComment, $xPopAds, $xUploadImg, $xMaxImgSize, $xMaxImgHeight, $xMaxImgWidth, $xThumbTo, $xThumbHeight, $xThumbWidth, $xUploadPath, $xUploadPathRev, $xCatgPath, $xCatgPathRev, $xMaxAllowedAds){
	global $nukecprefix,$db;
	$xnukecprefix = FixQuotes($xnukecprefix);  
	$xfolder_name = FixQuotes($xfolder_name);
	$xModuleTitle = FixQuotes($xModuleTitle);
    $xAdsTitleLength = FixQuotes($xAdsTitleLength);
	$xAdsContentLength = FixQuotes($xAdsContentLength);
    $xWaiting = FixQuotes($xWaiting);
   	$xPerPage = FixQuotes($xPerPage);
    $xUseImgCatg = FixQuotes($xUseImgCatg);
	$xPostInMainCatg = FixQuotes($xPostInMainCatg);
	$xMemberRequired = FixQuotes($xMemberRequired);
	$xAdsComment = FixQuotes($xAdsComment);
	$xPopAds = FixQuotes($xPopAds);
	$xUploadImg = FixQuotes($xUploadImg);
	$xMaxImgSize = FixQuotes($xMaxImgSize);
	$xMaxImgHeight = FixQuotes($xMaxImgHeight);
	$xMaxImgWidth = FixQuotes($xMaxImgWidth);
	$xThumbTo = FixQuotes($xThumbTo);
	$xThumbHeight = FixQuotes($xThumbHeight);
	$xThumbWidth = FixQuotes($xThumbWidth);
	$xMaxAllowedAds = FixQuotes($xMaxAllowedAds);
		
	$sqlupdate = "update ".$nukecprefix."_ads_config set ";
	$sqlupdate .= "nukecprefix ='".$xnukecprefix."',";
	$sqlupdate .= "folder_name ='".$xfolder_name."',";
	$sqlupdate .= "ModuleTitle ='".$xModuleTitle."',";
	$sqlupdate .= "AdsTitleLength ='". $xAdsTitleLength."',";
	$sqlupdate .= "AdsContentLength ='".$xAdsContentLength."',";
	$sqlupdate .= "Waiting ='".$xWaiting."', ";
	$sqlupdate .= "PerPage ='".$xPerPage."', ";
	$sqlupdate .= "UseImgCatg ='".$xUseImgCatg."', ";
	$sqlupdate .= "PostInMainCatg ='".$xPostInMainCatg."', ";
	$sqlupdate .= "MemberRequired ='".$xMemberRequired."', AdsComment ='".$xAdsComment."', ";
	$sqlupdate .= "PopAds ='".$xPopAds."', ";
	$sqlupdate .= "UploadImg ='".$xUploadImg."',";
	$sqlupdate .= "MaxImgSize ='".$xMaxImgSize."',";
	$sqlupdate .= "MaxImgHeight ='".$xMaxImgHeight."', ";
	$sqlupdate .= "MaxImgWidth ='".$xMaxImgWidth."', ";
	if ($xThumbTo == 0) {
		$xThumbToHeight = 1;
		$xThumbToWidth = 0;
	} else {
		$xThumbToHeight = 0;
		$xThumbToWidth = 1;
	}
	$sqlupdate .= "ThumbToHeight ='".$xThumbToHeight."', ";
	$sqlupdate .= "ThumbToWidth ='".$xThumbToWidth."', "; 
	$sqlupdate .= "ThumbHeight ='".$xThumbHeight."', ";
	$sqlupdate .= "ThumbWidth ='".$xThumbWidth."', ";
	$sqlupdate .= "UploadPath ='".$xUploadPath."', ";
	$sqlupdate .= "UploadPathRev ='".$xUploadPathRev."', ";
	$sqlupdate .= "CatgPath ='".$xCatgPath."', ";
	$sqlupdate .= "CatgPathRev ='".$xCatgPathRev."', ";
	
	$sqlupdate .= "MaxAllowedAds ='".$xMaxAllowedAds."' ";
	
	$re = $db->sql_query($sqlupdate);
	if (!$re) {
		die (mysql_error());
	}
	
	Header("Location: admin.php?op=NukeC30AdminDone&msgid=PreferencesSaved");
}/* End Function NukeCSaveSetting */


switch($op) {
	case "NukeC30Setting": NukeCSetting();break;
	case "NukeC30SaveSetting": NukeCSaveSetting($xnukecprefix, $xfolder_name, $xModuleTitle, $xAdsTitleLength, $xAdsContentLength, $xWaiting, $xPerPage, $xUseImgCatg, $xPostInMainCatg, $xMemberRequired, $xAdsComment, $xPopAds, $xUploadImg, $xMaxImgSize, $xMaxImgHeight, $xMaxImgWidth, $xThumbTo, $xThumbHeight, $xThumbWidth, $xUploadPath, $xUploadPathRev, $xCatgPath, $xCatgPathRev, $xMaxAllowedAds);break;
}

} else {
    echo "Access Denied";
}

?>
