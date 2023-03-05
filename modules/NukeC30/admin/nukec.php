<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.cjb.net
#
# This module is the main file of NukeC30 Addon Administration
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

//define('NO_EDITOR', true);	# WYSIWYG editor is disabled. Anh Tran 03-31-06

include_once("modules/".$NukeCAddonName."/functions.php");
include_once("modules/".$NukeCAddonName."/language/lang-".$currentlang.".php");

function NukeC30() {
	global $nukecprefix,$db,$PerPage;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	FileNukeCheaderAdmin();
	echo "<center>
			<form action=\"admin.php?op=NukeC30EditAds\" method=\"post\">
			Enter Ads ID to edit/delete  : 
			<input type=\"text\" name=\"id_ads\" size=\"6\" />
			<input type=\"submit\" value=\" GO \" />
			</form>
			</center>";
	CloseTable();
	include_once("footer.php");
}

function  NukeCAdminWaiting($howmany) {
	global $nukecprefix,$db;
	if (($howmany == "") || (!isset($howmany))) {
		header("Location:admin.php?op=NukeC30");
		exit();
	} else {
		global $nukecprefix,$db,$PerPage,$bgcolor3,$bgcolor2,$othercolor;
		global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
		include_once("header.php");
		$start = $PerPage*$howmany+1;
		$end = $PerPage*($howmany+1);
		//GraphicAdmin();
		OpenTable();
		NukeCAdminMenu();
		FileNukeCheaderAdmin();
		echo "<center><strong>";
		$sqlwaiting = "select id_ads,title,language,dateposted from ".$nukecprefix."_ads_ads where active=0";
		$res = $db->sql_query($sqlwaiting);
		$waitingAds = $db->sql_numrows($res);
		if ($waitingAds > 0) {
			echo "<br /><table width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">\n";
			echo "<tr bgcolor=\"".$adsbgcolor2."\"><td align=\"center\">";
			echo _NUKECWAITINGTITLE1." $start - $end ( "._NUKECFROMTOTAL." $waitingAds "._NUKECWAITINGADS.")";
			echo "</td></tr></table></td></tr></table>";
			$sqlwaiting .= " order by id_ads,dateposted DESC limit ";
			$sqlwaiting .= $start-1;
			$sqlwaiting .= ",";
			$sqlwaiting .= $PerPage;
			$reslist = $db->sql_query($sqlwaiting);
			echo "<br /><table width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">\n"
				."<tr bgcolor=\"".$adsbgcolor5."\"><td width=\"3%\"><strong>No.</strong></td>\n"
				."<td width=\"53%\"><strong>"._NUKECADSTITLE."</strong></td>\n"
				."<td width=\"15%\" align=\"center\"><strong>"._NUKECLANGUAGE."</strong></td>\n"
				."<td width=\"17%\" align=\"center\"><strong>"._NUKECDATE."</strong></td>\n"
				."<td>&nbsp;</td>\n"
				."</tr>\n";
			$i = 0;
			while (list($id_ads,$title,$language,$dateposted) = $db->sql_fetchrow($reslist)) {
				$no = $start + $i;
				if ($i % 2 == 0) {
					$bcolor = $adsbgcolor2;
				} else {
					$bcolor = $adsbgcolor3;
				}
				if ($language == "") {
					$adslanguage="All ";
				} else {
					$adslanguage = $language;
				}
				echo "<tr bgcolor=\"$bcolor\"><td>$no</td>\n"
					."<td><a href=\"admin.php?op=NukeC30EditWaiting&idWait=$id_ads\">$title</a></td>\n"
					."<td align=\"center\">".ucfirst($adslanguage)."</td>\n"
					."<td align=\"center\">".FormatDateAds($dateposted,$Date_Format_code)."</td>\n"
					."<td align=\"center\">[ <a href=\"admin.php?op=NukeC30DeleteWaiting&id_ads_chng=$id_ads\">"._NUKECDELETE."</a> ]</td>\n"
					."</tr>\n";
				$i++;
			}
			echo "</table>\n";
			echo "</td></tr></table>";


			CloseTable();

		} else {
			header("Location:admin.php?op=NukeC30");
		}
		CloseTable();
		include_once("footer.php");
	}
}

function NukeCEditWaiting($idWait){
	global $module_name,$nukecprefix,$db,$multilingual,$currentlang,$MemberorNot,$NukeCAddonName;
	global $cookie,$user,$UploadImage,$anonymous,$DurationAds,$PriceField,$UploadImage,$TitleLength;
	global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
	global $AdsTitleLength, $AdsContentLength;
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

	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	FileNukeCheaderAdmin();
	$resultinfo = $db->sql_query("select * from $nukecprefix"."_ads_ads where id_ads='".$idWait."'");

	$adsinfo = $db->sql_fetchrow($resultinfo);


	echo "<br /><table width=\"95%\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\" align=\"center\" bgcolor=\"".$adsbgcolor1."\">";
	echo "<form name=\"editads\" enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
	$subUnixTime = $adsinfo[validuntil] - $adsinfo[dateposted];
	$postfor_calc = date("d",$subUnixTime);
	echo "<input type=\"hidden\" name=\"postfor_calc\" value=\"$postfor_calc\" />";
	echo "<input type=\"hidden\" name=\"id_ads_chng\" value=\"$idWait\" />\n";
	echo "<input type=\"hidden\" name=\"submitteruid_chng\" value=\"$adsinfo[submitter]\" />\n";
	echo "<tr><td bgcolor=\"$adsbgcolor3\">";


	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";

	echo "<tr bgcolor=\"".$adsbgcolor5."\"><td align=\"center\" colspan=\"2\">\n";
	echo "<font><strong>"._NUKECEDITWAITINGADS."</strong></font>";
	echo "</td></tr>";
	echo "<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSTITLE." (".$AdsTitleLength." "._NUKECADSMAXCHARS.")<font class=\"redtext\">*</font></strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"title_chng\" size=\"40\" maxlength=\"200\" value=\"$adsinfo[title]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSDESC ." <font class=\"redtext\">*</font> \n"
		."<br />(".$AdsContentLength." "._NUKECADSMAXCHARS.")</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\">";
wysiwyg_textarea('cdesc_chng', "$adsinfo[ads_desc]", 'PHPNukeAdmin', 60, 8);
//<textarea name=\"cdesc_chng\" cols=\"60\" rows=\"8\">".check_html($adsinfo[ads_desc],"nohtml")."</textarea>
echo "</td></tr>\n";

	echo "<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSCATG." </strong></td><td bgcolor=\"".$adsbgcolor4."\">\n"
		."<select name=\"catgforprocess_chng\">\n";
	$sql = "select id_catg,catg,parentid from $nukecprefix"."_ads_catg";
	$sql .= " order by parentid,catg";
		$result2=$db->sql_query($sql);
   	$i = 0;
	while(list($id_catg2, $ccatg2, $parentid2) = $db->sql_fetchrow($result2)) {
   		if ($parentid2!=0) $ccatg2=getparent($parentid2,$ccatg2);
   	    if ($parentid2 != 0) {
			echo "<option value=\"$id_catg2\" ";
			if ($id_catg2 == $adsinfo[id_catg]) {
				echo " selected";
			}
				echo ">$ccatg2</option>\n";
   		}
	}
	echo "</select>\n"
		."</td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSPRICE."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\">";
	echo "<select name=\"AdsCurr_chng\">";
	buildcurrency($sel = $adsinfo[curr]);
	echo "</select>";
	echo "<input type=\"text\" name=\"price_chng\" size=\"15\"  value=\"$adsinfo[price]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSURL." </strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"website_chng\" size=\"30\"  value=\"$adsinfo[website]\" /> <i>"._NUKECEGURL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSEMAIL."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"email_chng\" size=\"25\" value=\"$adsinfo[email]\" /> <i>"._NUKECEGEMAIL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_CITY."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"city_chng\" size=\"25\" value=\"$adsinfo[city]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_STATE."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"state_chng\" size=\"25\" value=\"$adsinfo[state]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_COUNTRY."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"country_chng\" size=\"25\" value=\"$adsinfo[country]\" /></td></tr>\n";

	if ($adsinfo[imageads]) {
		if ($adsinfo[imageads] != "") {
			list($widthimg,$heightimg) = getimagesize("modules/$module_name/imageads/$adsinfo[imageads]");
			echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSUPLOADEDIMG."</strong></td>\n"
				."<td bgcolor=\"".$adsbgcolor4."\"><img src=\"modules/$module_name/imageads/$adsinfo[imageads]\" width=\"$widthimg\" height=\"$heightimg\" alt=\"\" /></td></tr>\n";
}
}
			
if ($multilingual) {
		echo "<tr><td bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECLANGUAGE."</strong></td><td bgcolor=\"".$adsbgcolor4."\">\n";
   		echo "<select name=\"adslanguage_chng\">\n";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
		    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	    	    $langFound = $matches[1];
		        $languageslist .= "$langFound ";
		    }
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		sort($languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
		    if($languageslist[$i]!="") {
				echo "<option value=\"$languageslist[$i]\" ";
	    		if(($languageslist[$i]==$adsinfo[language]) or ($languageslist[$i]==$currentlang) ) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
   		 		}
			}
		echo "</select></td></tr>\n";
	}

	$zduration = datesub($adsinfo[validuntil],$adsinfo[dateposted]);
	echo "<tr><td bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEADSPOSTFOR."</strong></td><td bgcolor=\"".$adsbgcolor4."\">";
	echo "<select name=\"postfor_chng\">\n";
	buildduration($sel="$zduration");
	echo "</select></td></tr>";

	echo "<tr><td colspan=\"2\"  bgcolor=\"".$adsbgcolor4."\">\n"
		."<select name=\"op\">\n"
		."<option value=\"NukeC30DeleteWaiting\">"._NUKECDELETEADS."</option>\n"
		."<option value=\"NukeC30PostWaiting\" selected>"._NUKECPOSTADS."</option>\n"
		."</select>\n"
		." <input type=\"submit\" value=\""._NUKECGO."\" /> <font class=\"redtext\"><strong>*</strong> -> <strong>"._NUKECREQUIRED."</strong></font>\n"
		."</td></tr>\n";

	
	echo "</table>";
	echo "</td></tr></form></table>";

	CloseTable();
	include_once("footer.php");
}

function NukeCPostWaiting($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$postfor_chng,$AdsCurr_chng) {
	global $nukecprefix,$db,$NukeCAddonName, $module_name, $multilingual, $currentlang;
	global $AdsTitleLength, $AdsContentLength, $MemberRequired, $PostInMainCatg, $cookie, $user, $UploadImg,$Waiting;
	global $anonymous;
	global $UploadPath,$cookie,$user,$DescLength,$UploadImage, $MaxImgSize, $MaxImgHeight, $MaxImgWidth,$MaxAllowedAds;



//	include_once("modules/".$NukeCAddonName."/config.php");

	if ((!$title_chng) || ($title_chng == "") || (strlen($title_chng) > $AdsTitleLength)) $errorTitle = 1;
	if ((!$cdesc_chng) || ($cdesc_chng == "") || (strlen($cdesc_chng) > $AdsContentLength)) $errorCdesc = 1;
	if ($email_chng != ""){
		if (!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$email_chng)) $errorEmail = 1;
	}
	if (!$setemptyimg) {
		if ($UploadImage && ($fileupload_chng != "") && ($fileupload_chng != "none")) {
			if ($fileupload_size_chng > ($UploadImageSize * 1024)) {
				$errorImageSize = 1;if ($adsinfo[imageads]) {
		if ($adsinfo[imageads] != "") {
			echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor4."\"><strong>"._NUKECNOTE."</strong> : <br /><strong><big><strong>&middot;</strong></big> &nbsp;</strong>"._NUKECNOTE1."</td></tr>\n";
		}
	}
			}
			$imageadstype = basename($fileupload_chng_type);
			if (in_array($imageadstype,$UploadImageType)) {
				$imgsize = getimagesize($fileupload_chng);
				$imgwidth = $imgsize[0];
				$imgheight = $imgsize[1];
				if (($imgwidth > $UploadImagewidth) || ($imgheight > $UploadImageHeight)) {
					$errorImageDimension = 1;
				}
			} else {
				$errorImageType = 1;
			}
		}
	}

	if ($errorTitle || $errorCdesc || $errorPrice || $erroremailanony || $errorEmail || $errorImageSize || $errorImageDimension || $errorImageType) {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECUPDATEERROR."</font></center><br />";
		echo "<center>";
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
			echo "<br />"._NUKECERRORMAXSIZEALLOWED." $UploadImageSize "._NUKECKB."<br />";
		}
		if ($errorImageDimension) {
			echo "<br />"._NUKECERRORMAXDIMENSION." $UploadImageHeight x $UploadImagewidth "._NUKECPIXEL."<br />";
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
		$nowdatetmp = date("H i s m d Y");
		$datearraytmp = explode (" ", $nowdatetmp);
		$NewAdsNowUnixTime = GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,0,0);
		$NewAdsExpUnixTime = GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,$postfor_chng,0);

		$sqlupdate = "update $nukecprefix"."_ads_ads";

		if ($price_chng != "") {
			$price_chng = FixQuotes(filter_text($price_chng, "nohtml"));
			$AdsCurrx = $AdsCurr_chng;
		} else {
			$AdsCurrx = "";
		}
		$ads_title = check_html($title_chng,"nohtml");
		$ads_content = FixQuotes(nl2br(filter_text($cdesc_chng)));
//orginal line above, ANH TRAN: $ads_content = FixQuotes(nl2br(filter_text($cdesc_chng)));

		$sqlupdate .= " set title='$title_chng', ads_desc='$ads_content', ";
		$sqlupdate .= " id_catg='$catgforprocess_chng', curr='$AdsCurr_chng',price='$price_chng', website='$website_chng', ";
		$sqlupdate .= " email='$email_chng', city='$city_chng', state='$state_chng', country='$country_chng', dateposted='$NewAdsNowUnixTime', validuntil='$NewAdsExpUnixTime', ";
		if (!$setemptyimg) {
			if ($fileupload_chng != "") {
				$type = basename($fileupload_chng_type);
				$filename = "modules/".$module_name."/imageads/$id_ads_chng.".$type;
   				copy ($fileupload_chng, $filename);
				$imguploadname = $id_ads_chng.".".$type;
				$sqlupdate .= "imageads='$imguploadname', ";
			}
		}
		if ($setemptyimg) {
			$sqlupdate .= " imageads='', ";
		}
		if ($multilingual) {
			$sqlupdate .= " language='$adslanguage_chng', ";
		}
		$sqlupdate .= " active=1 where id_ads='$id_ads_chng' and submitter='$submitteruid_chng'";
		$res = $db->sql_query($sqlupdate);
		if (!$res) {
			echo mysql_error();
		}
		header("Location:admin.php?op=NukeC30AdminDone&msgid=WaitingAdsPosted");
	}
}

function NukeCDeleteWaiting($id_ads_chng,$confirm=0) {
	global $nukecprefix,$db;
	if ($confirm == 1) {
		$res = $db->sql_query("delete from $nukecprefix"."_ads_ads where id_ads='$id_ads_chng' and active=0");
		if (!$res) {
			return;
		}
		header("Location:admin.php?op=NukeC30AdminDone&msgid=WaitingAdsDeleted");
	} else {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		echo "<center>\n"
			."<font class=\"title\">"._NUKECDELETEWAITINGADSCONFIRMTITLE."</font>\n"
			."<br /><br />"
			.""._NUKECDELETEWAITINGADSCONFIRMALERT."<br /><br />"
			."[ <a href=\"admin.php?op=NukeC30DeleteWaiting&id_ads_chng=$id_ads_chng&confirm=1\"><strong>"._NUKECYES."</strong></a>\n"
			." | \n"
			."<a href=\"admin.php?op=NukeC30EditWaiting&id=$id_ads_chng\"><strong>"._NUKECNO."</a></strong> ]"
			."</center>";
		CloseTable();
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECADSPREVIEW."</font></center><br />";
		$adsinfo = AdsInfo($id_ads_chng);
		themeads ($adsinfo[id_ads],$adsinfo[id_catg],$adsinfo[title],$adsinfo[ads_desc],$adsinfo[imageads],$adsinfo[curr],$adsinfo[price],$adsinfo[submitter],$adsinfo[email],$adsinfo[website],$adsinfo[city],$adsinfo[state],$adsinfo[country],$adsinfo[dateposted],$adsinfo[hits]);
		CloseTable();
		include_once("footer.php");
	}
}

function NukeCDeleteAds($xid_ads,$confirm="") {
	global $NukeCAddonName;
	if ($confirm != 1) {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECDELETECONFIRM."</font>\n"
			."<br /><br />"._NUKECDELETEADSCONFIRM1.""
			." [ <a href=\"admin.php?op=NukeC30DeleteAds&id_ads=$xid_ads&confirm=1\" onclick=\"return confirm('"._NUKECDELETEADSCONFIRM2."');\">"._NUKECYES."</a> \n"
			."| <a href=\"javascript:history.go(-1);\">"._NUKECNO."</a> ]</center><br />";
		$adsinfo = AdsInfo($xid_ads);
		themeads ($adsinfo[id_ads],$adsinfo[id_catg],$adsinfo[title],$adsinfo[ads_desc],$adsinfo[imageads],$adsinfo[curr],$adsinfo[price],$adsinfo[submitter],$adsinfo[email],$adsinfo[website],$adsinfo[city],$adsinfo[state],$adsinfo[country],$adsinfo[dateposted],$adsinfo[hits]);
		CloseTable();
		include_once("footer.php");
	} else {
		global $nukecprefix,$db,$module_name;
		$db->sql_query("delete from $nukecprefix"."_ads_ads where id_ads ='$xid_ads'");
		header("Location:admin.php?op=NukeC30AdminDone&msgid=AdsDeleted");
	}
}

function NukeCEditAds($xid_ads) {
	global $module_name,$nukecprefix,$db,$multilingual,$currentlang,$MemberorNot,$NukeCAddonName;
	global $cookie,$user,$UploadImage,$anonymous,$DurationAds,$PriceField,$UploadImage,$TitleLength;
	global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
	global $AdsTitleLength, $AdsContentLength;
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

	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	FileNukeCheaderAdmin();
	$resultMakeSure = $db->sql_query("select * from ".$nukecprefix."_ads_ads where id_ads='".$xid_ads."'");

	if ($db->sql_numrows($resultMakeSure) > 0) {



	$adsinfo = AdsInfo($xid_ads);
	echo "<br /><table width=\"95%\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\" align=\"center\" bgcolor=\"".$adsbgcolor1."\">";
	echo "<form name=\"editads\" enctype=\"multipart/form-data\" action=\"admin.php\" method=\"post\">\n";
	$subUnixTime = $adsinfo['validuntil'] - $adsinfo['dateposted'];
	$postfor_calc = date("d",$subUnixTime);
	echo "<input type=\"hidden\" name=\"postfor_calc\" value=\"$postfor_calc\" />";
	echo "<input type=\"hidden\" name=\"id_ads_chng\" value=\"".$xid_ads."\" />\n";
	echo "<input type=\"hidden\" name=\"submitteruid_chng\" value=\"$adsinfo[submitter]\" />\n";
	echo "<tr><td bgcolor=\"$adsbgcolor3\">";


	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";

	echo "<tr bgcolor=\"".$adsbgcolor5."\"><td align=\"center\" colspan=\"2\">\n";
	echo "<font><strong>Edit Ads</strong></font>";
	echo "</td></tr>";
	echo "<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSTITLE." (".$AdsTitleLength." "._NUKECADSMAXCHARS.")<font class=\"redtext\">*</font></strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"title_chng\" size=\"40\" maxlength=\"200\" value=\"$adsinfo[title]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSDESC ." <font class=\"redtext\">*</font> \n"
		."<br />(".$AdsContentLength." "._NUKECADSMAXCHARS.")</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\">";
wysiwyg_textarea('cdesc_chng', "$adsinfo[ads_desc]", 'PHPNukeAdmin', 60, 8);
//<textarea name=\"cdesc_chng\" cols=\"60\" rows=\"8\">".check_html($adsinfo[ads_desc],"nohtml")."</textarea>
echo "</td></tr>\n";

	echo "<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSCATG." </strong></td><td bgcolor=\"".$adsbgcolor4."\">\n"
		."<select name=\"catgforprocess_chng\">\n";
	$sql = "select id_catg,catg,parentid from $nukecprefix"."_ads_catg";
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

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSPRICE."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\">";
	echo "<select name=\"AdsCurr_chng\">";
	buildcurrency($sel = $adsinfo[curr]);
	echo "</select>";
	echo "<input type=\"text\" name=\"price_chng\" size=\"15\"  value=\"$adsinfo[price]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSURL." </strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"website_chng\" size=\"30\"  value=\"$adsinfo[website]\" /> <i>"._NUKECEGURL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSEMAIL."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"email_chng\" size=\"25\" value=\"$adsinfo[email]\" /> <i>"._NUKECEGEMAIL."</i></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_CITY."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"city_chng\" size=\"25\" value=\"$adsinfo[city]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_STATE."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"state_chng\" size=\"25\" value=\"$adsinfo[state]\" /></td></tr>\n";

	echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEC_COUNTRY."</strong></td>\n"
		."<td bgcolor=\"".$adsbgcolor4."\"><input type=\"text\" name=\"country_chng\" size=\"25\" value=\"$adsinfo[country]\" /></td></tr>\n";

	if ($adsinfo['imageads']) {
		if ($adsinfo['imageads'] != "") {
			list($widthimg,$heightimg) = @getimagesize("modules/$module_name/imageads/$adsinfo[imageads]");
			echo "<tr><td width=\"25%\" valign=\"top\" bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECADSUPLOADEDIMG."</strong></td>\n"
				."<td bgcolor=\"".$adsbgcolor4."\"><img src=\"modules/$module_name/imageads/$adsinfo[imageads]\" width=\"$widthimg\" height=\"$heightimg\" alt=\"\" /></td></tr>\n";
}
}
			
if ($multilingual) {
		echo "<tr><td bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKECLANGUAGE."</strong></td><TD bgcolor=\"".$adsbgcolor4."\">\n";
   		echo "<select name=\"adslanguage_chng\">\n";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
		    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	    	    $langFound = $matches[1];
		        $languageslist .= "$langFound ";
		    }
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		sort($languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
		    if($languageslist[$i]!="") {
				echo "<option value=\"$languageslist[$i]\" ";
	    		if(($languageslist[$i]==$adsinfo[language]) or ($languageslist[$i]==$currentlang) ) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
   		 		}
			}
		echo "</select></td></tr>\n";
	}

	$zduration = datesub($adsinfo['validuntil'],$adsinfo['dateposted']);
	echo "<tr><td bgcolor=\"".$adsbgcolor2."\"><strong>"._NUKEADSPOSTFOR."</strong></td><td bgcolor=\"".$adsbgcolor4."\">";
	echo "<select name=\"postfor_chng\">\n";
	buildduration($sel="$zduration");
	echo "</select></td></tr>";

	echo "<tr><td colspan=\"2\"  bgcolor=\"".$adsbgcolor4."\">\n"
		."<select name=\"op\">\n"
		."<option value=\"NukeC30DeleteWaiting\">"._NUKECDELETEADS."</option>\n"
		."<option value=\"NukeC30PostWaiting\" selected>"._NUKECPOSTADS."</option>\n"
		."</select>\n"
		." <input type=\"submit\" value=\""._NUKECGO."\" /> <font class=\"redtext\"><strong>*</strong> -> <strong>"._NUKECREQUIRED."</strong></font>\n"
		."</td></tr>\n";

	
	echo "</table>";
	echo "</td></tr></form></table>";
	} else {
		echo "<br /><center><strong>Ads with ID $xid_ads not exist</strong></center>";
	}
	CloseTable();
	include_once("footer.php");
}

function NukeCDoEditAds($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$action,$postfor_chng,$AdsCurr_chng){
	if ($action == 1) {
		header("Location:admin.php?op=NukeC30DeleteAds&id_ads=$id_ads_chng");
	} else {
		global $nukecprefix,$db,$multilingual,$currentlang,$MemberorNot,$NukeCAddonName;
		global $cookie,$user,$UploadImage,$anonymous,$DescLength,$DurationAds,$PriceField,$UploadImage,$TitleLength,$UploadImageSize,$UploadImagewidth,$UploadImageHeight,$UploadImageType;
		include_once("modules/".$NukeCAddonName."/config.php");
		if ((!$title_chng) || ($title_chng == "") || (strlen($title_chng) > $TitleLength)) $errorTitle = 1;
		if ((!$cdesc_chng) || ($cdesc_chng == "") || (strlen($cdesc_chng) > $DescLength)) $errorCdesc = 1;
		if ($email_chng != ""){
			if (!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$email_chng)) $errorEmail = 1;
		}
		if (!$setemptyimg) {
			if ($UploadImage && ($fileupload_chng != "") && ($fileupload_chng != "none")) {
				if ($fileupload_size_chng > ($UploadImageSize * 1024)) {
					$errorImageSize = 1;
				}
				$imageadstype = basename($fileupload_chng_type);
				if (in_array($imageadstype,$UploadImageType)) {
					$imgsize = getimagesize($fileupload_chng);
					$imgwidth = $imgsize[0];
					$imgheight = $imgsize[1];
					if (($imgwidth > $UploadImagewidth) || ($imgheight > $UploadImageHeight)) {
						$errorImageDimension = 1;
					}
				} else {
					$errorImageType = 1;
				}
			}
		}
		if ($errorTitle || $errorCdesc || $errorPrice || $erroremailanony || $errorEmail || $errorImageSize || $errorImageDimension || $errorImageType) {
			include_once("header.php");
			MenuNukeC(1);
			echo "<br />";
			OpenTable();
			echo "<center><font class=\"title\">"._NUKECUPDATEERROR."</font></center><br />";
			echo "<center>";
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
				echo "<br />"._NUKECERRORMAXSIZEALLOWED." $UploadImageSize "._NUKECKB."<br />";
			}
			if ($errorImageDimension) {
				echo "<br />"._NUKECERRORMAXDIMENSION." $UploadImageHeight x $UploadImagewidth "._NUKECPIXEL."<br />";
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
			$nowdate = date("Y-m-d");
			$sqlupdate = "update $nukecprefix"."_ads_ads";
			$resultvalid = $db->sql_query("select date_add('$nowdate', interval $postfor_chng day)");
			list ($validuntil_chng) = $db->sql_fetchrow($resultvalid);
			if ($price_chng != "") {
				$price_chng = FixQuotes(filter_text($price_chng, "nohtml"));
				$AdsCurrx = $AdsCurr_chng;
			} else {
				$AdsCurrx = "";
			}
			$ads_title = FixQuotes(filter_text($title_chng, "nohtml"));
//			$ads_content = FixQuotes(nl2br(filter_text($cdesc_chng)));
$ads_content = FixQuotes(filter_text($cdesc_chng));	//original line above, ANH TRAN: 

			$sqlupdate = "update $nukecprefix"."_ads_ads";
		$sqlupdate .= " set title='$title_chng', ads_desc='$cdesc_chng', ";  // original value: $ads_content
			$sqlupdate .= " id_catg='$catgforprocess_chng', curr='$AdsCurrx',price='$price_chng', website='$website_chng', ";
			$sqlupdate .= " email='$email_chng', city='$city_chng', state='$state_chng', country='$country_chng', dateposted='$nowdate', validuntil='$validuntil_chng', ";
			if (!$setemptyimg) {
				if ($fileupload_chng != "") {
					$type = basename($fileupload_chng_type);
					$filename = $UploadPath."$id_ads_chng.".$type;
    				copy ($fileupload_chng, $filename);
					$imguploadname = $id_ads_chng.".".$type;
					$sqlupdate .= "imageads='$imguploadname', ";
				}
			}
			if ($setemptyimg) {
				$sqlupdate .= " imageads='', ";
			}
			if ($action == 2) {
				$sqlupdate .= " active ='1' ";
			} elseif ($action == 3) {
				$sqlupdate .= " active ='0' ";
			}
			if ($multilingual) {
				if (($action == 2) || ($action == 3)) {
					$sqlupdate .= " , ";
				}
				$sqlupdate .= " language='$adslanguage_chng' ";
			}

			$sqlupdate .= " where id_ads='$id_ads_chng' and submitter='$submitteruid_chng'";
			$db->sql_query($sqlupdate);
			header("Location:admin.php?op=NukeC30AdminDone&msgid=EditDone");
		}
	}
}

function NukeCDeleteComment($commentid) {
	global $nukecprefix,$db;
	$db->sql_query("delete from $nukecprefix"."_ads_comments where no_comment='$commentid'");
	header("Location:admin.php?op=NukeC30AdminDone&msgid=CommentDeleted");
}

function FileNukeCheaderAdmin() {
	global $nukecprefix,$db, $PerPage, $msg_id,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\">\n"
		."<tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr>";
	echo "<form action=\"admin.php?op=NukeC30AdminWaiting\" method=\"post\">";
	echo "<td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	echo "<b class=\"title\">Maintenance submitted Ads</strong><br /><br />";

	$sqlwaiting = "select count(*) as waitingAds from $nukecprefix"."_ads_ads where active=0";
	$res = $db->sql_query($sqlwaiting);
	list($waitingAds) = $db->sql_fetchrow($res);
	if ($waitingAds > 0) {
		echo _NUKECTHEREARE." "." $waitingAds "._NUKECADSWAITINGMSG2."\n";
		echo " , "._NUKECVIEW." : ";

		echo "<select name=\"howmuch\">";
		$jmlloop = ceil($waitingAds/$PerPage);
		for ($i=0;$i<$jmlloop;$i++) {
			$start = $PerPage*$i+1;
			$end = $PerPage*($i+1);
			echo "<option value=\"$i\">$start - $end</option>\n";
		}
		echo "</select> <input type=\"submit\" value=\""._NUKECVIEW."\" />";
		echo "";
	} else {
		echo _NUKECNOWAITING;
	}
	echo "</strong></center>";


	if ((isset($msg_id)) && ($msg_id != "")) {
		echo "<br /><br /><center>";
		switch ($msg_id) {
			case "CPadded": echo "New Custom Content Added";break;
			case "CustomContentActivated": echo "Selected custom content activated";break;
			case "CustomContentDeActivated": echo "Selected custom content deactivated";break;
		}
		echo "</center>";
	}
	echo "</td></tr></form></table>";
	echo "</td></tr></table>";
}



switch($op) {
   
	case "NukeC30": NukeC30();break;	
	case "NukeC30AdminReport": NukeCAdminReport();break;
	case "NukeC30AdminWaiting": NukeCAdminWaiting($howmuch);break;
	case "NukeC30EditWaiting":NukeCEditWaiting($idWait);break;
	case "NukeC30PostWaiting":NukeCPostWaiting($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$postfor_chng,$AdsCurr_chng);break;
	case "NukeC30DeleteComment" : NukeCDeleteComment($commentid);break;
	case "NukeC30DeleteWaiting":NukeCDeleteWaiting($id_ads_chng,$confirm);break;
	case "NukeC30AdminAds": NukeCAdminAds();break;
	case "NukeC30ViewStats": NukeCViewStats();break;
	case "NukeC30AdminDone": NukeCAdminDone($msgid);break;
	case "NukeC30DeleteAds":NukeCDeleteAds($id_ads,$confirm);break;	
	case "NukeC30EditAds":NukeCEditAds($id_ads);break;
	case "NukeC30DoEditAds" : NukeCDoEditAds($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$action,$postfor_chng,$AdsCurr_chng);break;
}

} else {
    echo "Access Denied";
}

?>
