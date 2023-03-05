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

function NukeCDoc(){ /* Start Function NukeCSetting */
	global $nukecprefix,$db;
	global $NukeCAddonName, $ModuleTitle, $AdsTitleLength, $AdsContentLength, $Waiting, $PerPage, $UseImgCatg, $PostInMainCatg, $MemberRequired, $AdsComment, $PopAds, $UploadImg, $MaxImgSize, $MaxImgHeight, $MaxImgWidth, $ThumbToHeight, $ThumbToWidth, $ThumbHeight, $ThumbWidth, $UploadPath, $CatgPath, $MaxAllowedAds, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$admintitle = _NUKECADMINTITLE." - "._NUKECSETTING;
	include_once("header.php");
	
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\" align=\"center\"><strong>NukeC30 Setting Preferences Short Documentation</strong></td></tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">NukeC30 Module Folder Name</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">NukeC30 Module Folder Name, default is <strong>NukeC30</strong>. If you change(customize) its folder name ,you have to change it into the customize folder name</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">NukeC30 Module Page Title</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Web page title to be shown when visitor accessing NukeC30 module</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Maximal ads allowed</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Total of allowed ads for users/members to their active or expired ads. User/members also limited by this number setting to save ads into their AdsBox (E.g : At <strong>setting Max allowed ads = 10 </strong>then Joe only allowed have 6 active ads and 4 expired ads. And only allowed to save 10 ads into his AdsBox)</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Title Max Chars</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal characters allowed for users/members to write their ads Title, error will prompted for users if they input more than allowed characters</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Content Max Chars</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal characters allowed for users/members to write their ads content, error will prompted for users if they input more than allowed characters</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Status Submitted Ads</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">You could set Automatically Posted or Pending for process for submitted ads. <strong>Automatically Posted</strong>, submitted ads automatically can be viewed by site visitors. <strong>Pending for process</strong>, submitted ads will stored into ads Waiting box at admin side that will be reviewed/edited by site adminstrator</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Views Perpage</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">For set how many Ads will be viewed in one page.</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Use Image Category</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">If this state's status is Yes, then system will automatically load category images, If not, category will be text only.</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Post in main category</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Users will able to post their ads into Main/Parent category if this state set to Allowed, If not, users only able to post under child categories</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Member Required</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">If <strong>Member Required</strong> set to <strong>Yes</strong>, then only members allowed to post ads and ads comments. If set to <strong>No</strong>, then anonymous will able to post ads or ads comments</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Comments</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Ads comments, Features for users to post comments on ads.If set to Allowed, Ads comment feature will be activated, if set it denied, Ads comments feature won't viewed to users</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<TD width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads in popular page</td>\n"
		."<TD bgcolor=\"".$adsbgcolor2."\">Total number of most popular ads will be viewed at Popular Ads Page</td>\n"
		."</tr>";
	echo "<TR>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Upload Image Ads</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">If this setting set to Yes, users or members will able to upload their product image for their ads. The uploaded image will be stored at Upload Path</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Max image ads size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal file size of users' upload image</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Max image width</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal pixel of width dimention allowed for users' uploaded image</td>\n"
		."</tr>";
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Max image height</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal pixel of height dimention allowed for users' uploaded image</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Thumbnail to </td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\"><strong>Thumbnail to</strong> will resize user uploaded image to be viewed at site. You could set to Height or to Width (E.g : Assume Thumbnail to Height, and Thumbnail height size is 100. If user upload a image 200w x 250h, the image will resized to height 100 and width with calculated value). Original image size will be showed when users view ads details</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Thumbnail height size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal pixel of height dimention allowed for users' uploaded image</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Thumbnail width size</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">Maximal pixel of height dimention allowed for users' uploaded image</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Image upload path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">The Full path of your ads images location. This location is the destination of uploaded image also
			e.g : /var/html/location/of/to/upload/image/ads
			</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Image path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">The path of your ads images location. e.g. : modules/[folder_name]/imageads</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Category Image Upload path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">The Full path of your ads category images location. This location is your location in uploading ads category image at admin section
		e.g : /var/html/location/of/to/upload/category/ads
		</td>\n"
		."</tr>";
	
	echo "<tr>\n"
		."<td width=\"35%\" bgcolor=\"".$adsbgcolor4."\" valign=\"top\">Ads Category Image path</td>\n"
		."<td bgcolor=\"".$adsbgcolor2."\">The path of your ads category images location. e.g : modules/[folder_name]/imagecatg</td>\n"
		."</tr>";
	
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}/* END Function NukeCSetting */



switch($op) {
	case "NukeC30Doc": NukeCDoc();break;
}

} else {
    echo "Access Denied";
}

?>
