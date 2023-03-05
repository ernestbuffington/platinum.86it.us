<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module handled all process in AdsBox
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

if (!preg_match("#modules.php#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once("modules/".$module_name."/functions.php");
define('INDEX_FILE', true);

if (is_user($user) || is_admin($admin)) {

function Index($id_ads) {
		global $EditPostedAds,$AdsTitleLength, $AdsContentLength;
		global $admin,$module_name,$nukecprefix,$db,$multilingual,$currentlang;
		global $cookie,$user,$UploadImg,$anonymous,$DurationAds,$PriceField,$UploadImage;
		global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
        global $languageslist;
		include_once("header.php");
		echo "<script>\n";
		echo "<!--\n";
		echo "function cekchx() {\n";
  		   	echo "if (document.editads.setemptyimg.checked) {\n";
				echo "document.editads.fileupload_chng.disabled  = true;\n";

      		echo "} else {\n";
   				echo "document.editads.fileupload_chng.disabled  = false;\n";

    		echo "}\n";
		echo "}\n";
		echo "//-->\n";
		echo "</script>\n";
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECEDITPOSTED."</font></center><br />";
		$adsinfo = AdsInfo($id_ads);
$AllowedToEditThisAds = "";
		if (($EditPostedAds == 1) && (is_user($user))) {
			if ($cookie[0] == $adsinfo['submitter']) {
				$AllowedToEditThisAds = 1;
			}
		} else {
			$AllowedToEditThisAds = 0;

		}

		if (is_admin($admin) || ($AllowedToEditThisAds == 1)) {
		themeads ($adsinfo['id_ads'],$adsinfo['id_catg'],$adsinfo['title'],$adsinfo['ads_desc'],$adsinfo['imageads'],$adsinfo['curr'],$adsinfo['price'],$adsinfo['submitter'],$adsinfo['email'],$adsinfo['website'],$adsinfo['city'],$adsinfo['state'],$adsinfo['country'],$adsinfo['dateposted'],$adsinfo['hits']);


	echo "<br /><table width=\"95%\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\" align=\"center\" bgcolor=\"$adsbgcolor1\">";
	echo "<form name=\"editads\" enctype=\"multipart/form-data\" action=\"modules.php?name=".$module_name."&file=manage&op=UpdateAdsChange\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"id_ads_chng\" value=\"$id_ads\" />\n";
	echo "<input type=\"hidden\" name=\"submitteruid_chng\" value=\"".$adsinfo['submitter']."\" />\n";
	echo "<tr><td bgcolor=\"$adsbgcolor3\">";


	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";

	echo "<tr bgcolor=\"$adsbgcolor5\"><td align=\"center\" colspan=\"2\">\n";
	echo "<font><strong>"._NUKECEDITWAITINGADS."</strong></font>";
	echo "</td></tr>";


	echo "<tr><td width=\"25%\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSTITLE." (".$AdsTitleLength." "._NUKECADSMAXCHARS.")<font class=\"redtext\">*</font></strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"title_chng\" size=\"40\" maxlength=\"200\" value=\"$adsinfo[title]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSDESC ." <font class=\"redtext\">*</font> \n"
."<br />(".$AdsContentLength." "._NUKECADSMAXCHARS.")</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\">";
wysiwyg_textarea("cdesc_chng", "$adsinfo[ads_desc]", "NukeUser", "60", "8");
		//."<br />(".$AdsContentLength." "._NUKECADSMAXCHARS.")</strong></td>\n"
		//."<td bgcolor=\"$adsbgcolor4\"><textarea name=\"cdesc_chng\" cols=\"60\" rows=\"8\">".check_html($adsinfo['ads_desc'],"nohtml")."</textarea></td></tr>\n";
echo "</td></tr>";
	echo "<tr><td width=\"25%\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSCATG." </strong></td><td bgcolor=\"$adsbgcolor4\">\n"
		."<select name=\"catgforprocess_chng\">\n";
	$sql = "select id_catg,catg,parentid from ".$nukecprefix."_ads_catg";
	$sql .= " order by parentid,catg";
		$result2=$db->sql_query($sql);
   	$i = 0;
	while(list($id_catg2, $ccatg2, $parentid2) = $db->sql_fetchrow($result2)) {
   		if ($parentid2!=0) $ccatg2=getparent($parentid2,$ccatg2);
   	    if ($parentid2 != 0) {
			echo "<option value=\"$id_catg2\" ";
			if ($id_catg2 == $adsinfo['id_catg']) {
				echo " selected";
			}
				echo ">$ccatg2</option>\n";
   		}
	}

	echo "</select>\n"
		."</td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSPRICE."</strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\">";
	echo "<select name=\"AdsCurr_chng\">";
	buildcurrency($sel = "$adsinfo[curr]");
	echo "</select>";
	echo "<input type=\"text\" name=\"price_chng\" size=\"15\"  value=\"$adsinfo[price]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSURL." </strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"website_chng\" size=\"30\"  value=\"$adsinfo[website]\" /> <i>"._NUKECEGURL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSEMAIL."</strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"email_chng\" size=\"25\" value=\"$adsinfo[email]\" /> <i>"._NUKECEGEMAIL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKEC_CITY."</strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"city_chng\" size=\"25\" value=\"$adsinfo[city]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKEC_STATE."</strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"state_chng\" size=\"25\" value=\"$adsinfo[state]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKEC_COUNTRY."</strong></td>\n"
		."<td bgcolor=\"$adsbgcolor4\"><input type=\"text\" name=\"country_chng\" size=\"25\" value=\"$adsinfo[country]\" /></td></tr>\n";

	if ($adsinfo['imageads'] || $UploadImg) {
		if ($adsinfo['imageads'] != "") {
			list($widthimg,$heightimg) = @getimagesize("modules/".$module_name."/imageads/$adsinfo[imageads]");
			echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSUPLOADEDIMG."</strong></td>\n"
				."<td bgcolor=\"$adsbgcolor4\"><img src=\"modules/".$module_name."/imageads/$adsinfo[imageads]\" width=\"$widthimg\" height=\"$heightimg\" alt=\"\" /></td></tr>\n";
			echo "<tr><td width=\"25%\" colspan=\"2\" bgcolor=\"$adsbgcolor2\"><input type=\"checkbox\" name=\"setemptyimg\" value=\"1\" onclick=\"cekchx();\" /> "._NUKECDELETEIMG."</td></tr>\n";
			echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSCHANGEIMAGE."</strong></td>\n"
				."<td bgcolor=\"$adsbgcolor4\"><input type=\"file\" name=\"fileupload_chng\" size=\"40\" /><br /><i>"._NUKECCHANGEIMAGEADSNOTE."</i></td></tr>\n";
		} else {
			echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"$adsbgcolor2\"><strong>"._NUKECADSUPLOAD."</strong></td>\n"
				."<td bgcolor=\"$adsbgcolor4\"><input type=\"file\" name=\"fileupload_chng\" size=\"40\" /></td></tr>\n";

		} //* end if $adsinfo*/
	}



	echo "<tr><td bgcolor=\"$adsbgcolor2\"><strong>"._NUKECLANGUAGE."</strong></td><td bgcolor=\"$adsbgcolor4\">\n";
   		echo "<select name=\"adslanguage_chng\">\n";
		echo "<option value=\"\"";
		if ($adsinfo['language'] == "") {
			echo " selected";
		}
		echo ">All</option>";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
		    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	    	    $langFound = $matches[1];
		        $languageslist .= $langFound.' ';
		    }
		}
		closedir($handle);
		$languageslist = explode(' ', $languageslist);
		sort($languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
		    if($languageslist[$i]!="") {
				echo "<option value=\"$languageslist[$i]\" ";
	    		if($languageslist[$i]==$adsinfo['language']) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
   		 		}
			}
		echo "</select></td></tr>\n";

	if (is_admin($admin)) {
	$zduration = datesub($adsinfo['validuntil'],$adsinfo['dateposted']);
	echo "<tr><td bgcolor=\"$adsbgcolor2\"><strong>"._NUKEADSPOSTFOR."</strong></td><td bgcolor=\"$adsbgcolor4\">";
	echo "<select name=\"postfor_chng\">\n";
	buildduration($sel="$zduration");
	echo "</select></td></tr>";
	} else {
		echo '<input type="hidden" name="postfor_chng" value="NP" />';
	}
	echo "<tr><td colspan=\"2\"  bgcolor=\"$adsbgcolor4\">\n";

	echo " <input type=\"submit\" value=\"Update ads\" /> &nbsp;&nbsp;\n"
		."<a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteads&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/delete.gif\" alt=\""._NUKECDELETE."\" title=\""._NUKECDELETE."\" /></a>"
		."<br /><font class=\"redtext\"><strong>*</strong> -> <strong>"._NUKECREQUIRED."</strong></font>\n"
		."</td></tr>\n";
	echo "<tr><td colspan=\"2\" bgcolor=\"$adsbgcolor4\"><strong>"._NUKECNOTE." : </strong>";
	if ($adsinfo['imageads']) {
		if ($adsinfo['imageads'] != "") {
			echo "<br /><strong><big><strong>&middot;</strong></big> &nbsp;</strong>"._NUKECNOTE1."\n";
		}
	}

	echo "<br /><strong><big><strong>&middot;</strong></big> &nbsp;</strong>Updated Ads by member will have the ads set to inactive and need admin to review and reactivate it\n";
	echo "</td></tr>";
	echo "</table>";
	echo "</td></tr></form></table>";
	}
		CloseTable();
		include_once("footer.php");
	}


function UpdateAdsChange($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$AdsCurr_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$adslanguage_chng,$postfor_chng) {
	global $nukecprefix,$db,$folder_name, $module_name, $multilingual, $currentlang;
	global $AdsTitleLength, $AdsContentLength, $MemberRequired, $PostInMainCatg, $cookie, $user, $Waiting,$postfor_chng;
	global $anonymous;
	global $UploadPath,$cookie,$user,$DescLength;
        global $errorTitle,$errorCdesc,$errorPrice,$erroremailanony,$errorEmail;
	global $UploadImg,$fileupload_chng,$setemptyimg,$errorImageSize,$errorImageType,$errorImageDimension;
	global $MaxImgHeight,$MaxImgWidth,$fileupload_chng_type,$fileupload_size_chng,$fileupload_chng_name,$UploadImageSize;
$fileupload_size_chng = $fileupload_chng['size'];
$fileupload_chng_type = $fileupload_chng['type'];
$fileupload_chng_name = $fileupload_chng['name'];
$fileupload_chng = $fileupload_chng['tmp_name'];
	if ((!$title_chng) || ($title_chng == "") || (strlen($title_chng) > $AdsTitleLength)) $errorTitle = 1;
	if ((!$cdesc_chng) || ($cdesc_chng == "") || (strlen($cdesc_chng) > $AdsContentLength)) $errorCdesc = 1;
	if ($email_chng != ""){
		if (!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$email_chng)) $errorEmail = 1;
	}
	if (!$setemptyimg) {
			if ($UploadImg && ($fileupload_chng != "") && ($fileupload_chng != "none")) {
			//$imageadstype = basename($fileupload_chng_type);
			$imageadstype = substr( strstr($fileupload_chng_type, "/"), 1);
			$UploadImageType = getImgType();

if (!in_array($imageadstype,$UploadImageType)) $errorImageType = 1;
if ( $imageadstype != "jpeg" ) {
$imgsize = @getimagesize($fileupload_chng);
if ($imgsize) {

if ($imgsize[0] > $MaxImgWidth) {
$ErrorUkuranImage = 1;
$ErrorUkuranImageWidth = 1;
}
if ($imgsize[1] > $MaxImgHeight) {
$ErrorUkuranImage = 1;
$ErrorUkuranImageHeight = 1;
}
} else {
$ErrorUkuranImage = 1;
}
}
}
		//if ($UploadImg && ($fileupload_chng != "") && ($fileupload_chng != "none")) {
		//	if ($fileupload_size_chng > ($UploadImageSize * 1024)) {
		//		$errorImageSize = 1;
		//	}
			//$imageadstype = basename($fileupload_chng_type);
         //   $imageadstype = substr( strstr($fileupload_chng_type, "/"), 1);
		//	$UploadImageType = getImgType();

		//	if (!in_array($imageadstype,$UploadImageType)) $errorImageType = 1;
		//	if ( $imageadstype != "jpeg" ) {
		//		$imgsize = @getimagesize($fileupload_chng);
		//		$imgwidth = $imgsize[0];
		//		$imgheight = $imgsize[1];
		//		if (($imgwidth > $MaxImgWidth) || ($imgheight > $MaxImgHeight)) {
		//			$errorImageDimension = 1;
		//		}
		//	}
		//}
	}

	if ($ErrorUkuranImage || $errorTitle || $errorCdesc || $errorPrice || $erroremailanony || $errorEmail || $errorImageSize || $errorImageDimension || $errorImageType) {
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECUPDATEERROR."</font></center><br />";
		echo "<center>";
$j="";
		if ($errorTitle) {
			if ($title == "") {
				echo "<br />"._NUKECERRORTITLE."<br />";
			}
			if (($title != "") && (strlen($title) > $TitleLength)) {
				echo "<br />"._NUKECERRORCTITLEMAX." $TitleLength "._NUKECCHARS."<br />";
			}
		}
		if ($errorCdesc) {
			if ($cdesc_chng == "") {
				echo "<br />"._NUKECERRORCDESCEMPTY."<br />";
			}
			if (($cdesc_chng != "") && (strlen($cdesc_chng) > $DescLength)) {
				echo "<br />"._NUKECERRORCDESCMAX." $DescLength "._NUKECCHARS."<br />";
			}
		}
		if ($erroremailanony) {
			echo "<br />"._NUKECANONYEMAILREQ."<br />";
		}
		if ($errorEmail) {
			echo "<br />"._NUKECERROREMAIL."<br />";
		}
		if ($errorImageSize) {
			echo "<br />"._NUKECERRORMAXSIZEALLOWED." $UploadImageSize "._NUKECKB." <br />";
		}
		if ($ErrorUkuranImage) {
				echo "<br />"._NUKECERRORMAXDIMENSION." $MaxImgHeight x $MaxImgWidth "._NUKECPIXEL." <br />";
			}
		if ($errorImageType) {
			echo "<br />"._NUKECALLOWEDFILETYPE.": ";
			for ($i = 0;$i<= sizeof($UploadImageType)-1;$i++) {
				echo "<strong>'.".$UploadImageType[$i]."'</strong>";
				if ($j != sizeof($UploadImageType)-1) {
					echo ", ";
				}
				$j++;
			}
			echo "<br />";
		}
		echo "<br /><br />"._NUKECPLEASEGOBACK."";
		echo "<br /><a href=\"javascript:history.go(-1);\"><< <strong>"._NUKECGOBACK."</strong></a>";
		echo "</center>";
		CloseTable();
		include_once("footer.php");
	} else {
		$sqlupdate = "update ".$nukecprefix."_ads_ads";
		if ($price_chng != "") {
			$price_chng = FixQuotes(filter_text($price_chng, "nohtml"));
			$AdsCurrx = $AdsCurr_chng;
		} else {
			$AdsCurrx = "";
		}
		$ads_title = check_html($title_chng,"nohtml");
		$ads_content = FixQuotes(nl2br(filter_text($cdesc_chng)));

		$sqlupdate .= " set title='$title_chng', ads_desc='$ads_content', ";
		$sqlupdate .= " id_catg='$catgforprocess_chng', curr='$AdsCurr_chng',price='$price_chng', website='$website_chng', city='$city_chng', state='$state_chng', country='$country_chng',";
		$sqlupdate .= " email='$email_chng',";
		if ($postfor_chng != "NP") {
			$nowdatetmp = date("H i s m d Y");
			$datearraytmp = explode (" ", $nowdatetmp);
			$NewAdsNowUnixTime = GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,0,0);
			$NewAdsExpUnixTime = GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,$postfor_chng,0);
			$sqlupdate .= " dateposted='$NewAdsNowUnixTime', validuntil='$NewAdsExpUnixTime', ";
		}

		if (!$setemptyimg) {
			if ($fileupload_chng != "") {
			$type = basename($fileupload_chng_type);
			if (($type == "jpeg") || ($type == "jpg") || ($type == "pjpeg")) {
				$type= "jpeg";
			}
			if ($type == "x-png") {
				$type = "png";
			}
			$filename = $UploadPath.$id_ads_chng.".".$type;
			$filename_thumb = $UploadPath.$id_ads_chng."_thumb.".$type;
			copy ($fileupload_chng, $filename);
			copy ($fileupload_chng, $filename_thumb);
			$imguploadname = $id_ads_chng.".".$type;

			$imgsize = @getimagesize($fileupload_chng);
			$imgwidth = $imgsize[0];
			$imgheight = $imgsize[1];


			include_once("modules/".$module_name."/resize.php");
			global $ThumbToHeight,$ThumbToWidth,$ThumbHeight,$ThumbWidth,$MaxImgHeight,$MaxImgWidth;
			if ($ThumbToHeight) {
				if ($imgheight <= $ThumbHeight) {
					$HeightToThumb = $imgheight;
					$LargeHeight = $imgheight;
					copy($imageupload, $filenamecopy_thumb);
				} else {
					$HeightToThumb = $ThumbHeight;
					if ($imgheight <= $MaxImgHeight) {
						$LargeHeight = $imgheight;
					} else {
						$LargeHeight = $MaxImgHeight;
						$thumb2 = new thumbnail($filename);
						$thumb2 -> size_height($MaxImgHeight);
						$thumb2->jpeg_quality(75);
						$thumb2->save($filename);
					}
					$thumb = new thumbnail($filename_thumb);
					$thumb->size_height($HeightToThumb);
					$thumb->jpeg_quality(75);
					$thumb->save($filename_thumb);
				}
			} else {
				if ($imgwidth <= $ThumbWidth) {
					$WidthToThumb = $imgwidth;
					$LargeWidth = $imqwidth;
					copy($imageupload, $filename_thumb);
				} else {
					$WidthToThumb = $ThumbWidth;
					if ($imgwidth <= $MaxImgWidth) {
						$LargeWidth = $imgwidth;
					} else {
						$LargeWidth = $MaxImgWidth;
						$thumb2 = new thumbnail($filename);
						$thumb2 -> size_width($LargeWidth);
						$thumb2->jpeg_quality(75);
						$thumb2->save($filename);
					}
					$thumb = new thumbnail($filename_thumb);
					$thumb->size_width($WidthToThumb);
					$thumb->jpeg_quality(75);
					$thumb->save($filename_thumb);
				}
			}
			$sqlupdate .= " imageads='$imguploadname', ";
			}
		} else {
			$sqlupdate .= " imageads='', ";
		}



		$sqlupdate .= " language='$adslanguage_chng' ";
		$sqlupdate .= " where id_ads='$id_ads_chng' and submitter='$submitteruid_chng'";
		$res = $db->sql_query($sqlupdate);
		if (!$res) {
			die($sqlupdate."<br />".mysql_error());
		}

		header("Location:modules.php?name=$module_name&file=manage&op=updated&id_ads=$id_ads_chng");
		die();
	}
}

function AdsUpdated($id_ads) {
	global $module_name;
	include_once("header.php");
	OpenTable();
	echo "<center>Your ads has been updated, <a href=\"modules.php?name=$module_name&amp;op=ViewDetail&amp;id_ads=".$id_ads."\">Click here to view your ads</a></center>";
	CloseTable();
	include_once("footer.php");
}

global $setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$id_ads;
	switch($op) {
		case "UpdateAdsChange":UpdateAdsChange($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$AdsCurr_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$postfor_chng);break;
		case "updated": AdsUpdated($id_ads);break;
		default : Index($id_ads); break;
	}

} else {
	include_once("header.php");
	MenuNukeC(1);
	echo "<br />";
	OpenTable();
	echo "<center><font class=\"title\">"._NUKECYOURADSBOX."</font></center><br />\n";
	printnotallowforanonymouse();
	CloseTable();
	include_once("footer.php");
}
?>
