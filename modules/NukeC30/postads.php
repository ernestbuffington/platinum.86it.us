<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to process ads postings
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
include_once("modules/".$module_name."/config.php");
include_once("modules/".$module_name."/functions.php");
$pagetitle = "- Free Classifieds, Free Local Ads ";

//$index = 0;
define('INDEX_FILE', true);	# Anh Tran
//define('NO_EDITOR', true);	# WYSIWYG editor is disabled. Anh Tran 03-31-06

function Index($id_catg="") {
	global $nukecprefix,$db,$folder_name, $module_name, $multilingual, $currentlang;
	global $AdsTitleLength, $AdsContentLength, $MemberRequired, $PostInMainCatg, $cookie,$user, $UploadImg, $MaxAllowedAds;
	
	include_once("header.php");
	MenuNukeC(1);
	echo "<br />";
    OpenTable();
	
	
   	if (is_user($user) || ($MemberRequired == 0)) {
		
		if (is_user($user)) {
			$submitter = "<a href=\"modules.php?name=Your_Account\">".$cookie[1]."</a>";
			$submitteruid = $cookie[0];
			$jmladsposted = AdsPostedByUser($submitteruid,0,0,0);
			if ($jmladsposted >= $MaxAllowedAds) {
				$NotAllowedByJml = 1;
			} else {
				$NotAllowedByJml = 0;
			}
		} else {
			$submitter = $anonymous." [ <a href=\"modules.php?name=Your_Account\">"._NUKECNEWUSER."</a> ]";
			$submitteruid = 1;
		}
		
		if ($NotAllowedByJml) {
			printnotallowlimitreached();
		} else {
		
		
		echo "<center><font class=\"title\"><strong>"._NUKECPOSTNEWADS."</strong></font><br />"
			."<font class=\"graytext\"><strong><a href=\"modules.php?name=$module_name\">"._NUKECMAIN."</a>/"._NUKECPOSTNEWADS."</strong></font></center><br />\n";
		echo "<form enctype=\"multipart/form-data\" action=\"modules.php?name=".$module_name."&amp;file=postads\" method=\"post\">\n";
		
		echo "<input type=\"hidden\" name=\"submitteruid\" value=\"$submitteruid\" />";
		echo "<font class=\"redtext\"><strong>*</strong><strong>"._NUKECREQUIRED."</strong></font>";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKECYOURNAME."</strong></td><td width=\"5\">:</td><td><strong>";

		echo "$submitter</strong></td></tr>\n";
		echo "<tr><td width=\"25%\"><strong>"._NUKECADSTITLE." (".$AdsTitleLength." "._NUKECADSMAXCHARS.")<font class=\"redtext\">*</font></strong></td>"
			."<td width=\"5\">:</td><td><input type=\"text\" name=\"title\" size=\"40\" maxlength=\"200\" /></td></tr>\n";
		echo "<tr><td><strong>"._NUKECADSDESC ." <font class=\"redtext\">*</font></strong></td><td width=\"5\" valign=\"top\">:</td><td>\n";
                            wysiwyg_textarea("cdesc", "", "NukeUser", "60", "8");
			//."<br />(".$AdsContentLength." "._NUKECADSMAXCHARS.")</strong></td><td width=\"5\" valign=\"top\">:</td>\n"
			//."<td><textarea name=\"cdesc\" cols=\"60\" rows=\"8\"></textarea></td></tr>\n";
                       echo "</td></tr>";
                         echo "<tr><td width=\"25%\"><strong>"._NUKECADSCATG." </strong></td><td width=\"5\">:</td><td>\n"
			."<select name=\"catgforprocess\">";
		$applylanguage = sqlapplylanguage();
		$sql = "select id_catg,catg,parentid from ".$nukecprefix."_ads_catg ";
		$sql .= "where ".$applylanguage;
	
		$sql .= " order by parentid,catg";
 		$result2=$db->sql_query($sql);
    	$i = 0;
		while(list($id_catg2, $ccatg2, $parentid2) = $db->sql_fetchrow($result2)) {
    		if ($parentid2!=0) $ccatg2=getparent($parentid2,$ccatg2);
 			if ($postinmaincatg) {
				echo "<option value=\"$id_catg2\" ";
					if (($id_catg == $id_catg2) or ($id_catg == $parentid2)) {
						if ($id_catg == $id_catg2) {
							echo "selected";
						}
						if ($id_catg == $parentid2) {
							if ($i == 0) {
								echo "selected";
							}
							$i++;
						}
					}
					echo ">$ccatg2</option>\n";
			} else {
				if ($parentid2 != 0) {
					echo "<option value=\"$id_catg2\" ";
					if (($id_catg == $id_catg2) or ($id_catg == $parentid2)) {
						if ($id_catg == $id_catg2) {
							echo "selected";
						}
						if ($id_catg == $parentid2) {
							if ($i == 0) {
								echo "selected";
							}
							$i++;
						}
					}
					echo ">$ccatg2</option>\n";
    			}
			}
				
		}
		echo "</select>\n"
			."</td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKECADSPRICE."</strong></td><td width=\"5\">:</td>\n"
				."<td>"
				."<select name=\"AdsCurr\">";
		buildcurrency($sel = "");
			echo "</select>"
				."<input type=\"text\" name=\"price\" size=\"15\" /> "._NUKECCURRSAMPLE."</td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKECADSURL." </strong></td><td width=\"5\">:</td><td><input type=\"text\" name=\"website\" size=\"30\" /> <i>"._NUKECEGURL."</i></td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKECADSEMAIL." <font class=\"redtext\">*</font></strong></td><td width=\"5\">:</td><td><input type=\"text\" name=\"email\" size=\"25\" /> <i>"._NUKECEGEMAIL."</i></td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKEC_CITY."</strong></td><td width=\"5\">:</td><td><input type=\"text\" name=\"city\" size=\"25\" /></td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKEC_STATE."</strong></td><td width=\"5\">:</td><td><input type=\"text\" name=\"state\" size=\"25\" /></td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKEC_COUNTRY."</strong></td><td width=\"5\">:</td><td><input type=\"text\" name=\"country\" size=\"25\" /></td></tr>\n";
		echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKEADSPOSTFOR." </strong></td><td width=\"5\">:</td><td>\n"
			."<select name=\"postfor\">\n";
		buildduration($sel="");
		echo "</select></td></tr>\n";
		if ($UploadImg) {
			echo "<tr><td width=\"25%\" valign=\"top\"><strong>"._NUKECADSUPLOAD."</strong></td><td width=\"5\">:</td>\n"
				."<td><input type=\"file\" name=\"fileupload\" size=\"40\" /></td></tr>\n";
		} else {
			echo "<input type=\"hidden\" name=\"fileupload\" value=\"\" />";
		}
		if ($multilingual) {
			echo "<tr><td><strong>"._NUKECLANGUAGE."</strong></td><td><strong>:</strong></td><td>";
    		echo "<select name=\"adslanguage\">\n";
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
		    		if($languageslist[$i]==$currentlang) echo "selected";
						echo ">".ucfirst($languageslist[$i])."</option>\n";
	   		 		}
				}
			echo "</select></td></tr>";
		} else {
			echo "<tr><td><input type=\"hidden\" name=\"adslanguage\" value=\"\" /></td></tr>\n";
		}
		echo "<tr><td colspan=\"3\"><input type=\"submit\" value=\""._NUKECSUBMIT."\" /></td></tr>";
		echo "<tr><td><input type=\"hidden\" name=\"op\" value=\"SubmitAds\" /></td></tr>";
		echo "</table>";
               echo "</form>";
		}
	} else {
		echo "<center><font class=\"title\">"._NUKECPOSTNEWADS."</font></center><br />\n";
		printnotallowforanonymouse();
	}
	CloseTable();
	include_once("footer.php");
}

function SubmitAds($submitteruid,$title, $cdesc, $catgforprocess, $AdsCurr, $price, $website, $email, $city, $state, $country, $postfor, $fileupload, $adslanguage, $fileupload, $fileupload_name, $fileupload_type, $fileupload_size) {
	global $nukecprefix,$db,$folder_name, $module_name, $multilingual, $currentlang;
	global $AdsTitleLength, $AdsContentLength, $MemberRequired, $PostInMainCatg, $cookie, $user, $UploadImg,$Waiting;
	global $anonymous,$errorTitle,$errorCdesc,$erroremailanony,$errorEmail,$errorImageSize,$errorEmail1;
	global $UploadPath,$cookie,$user,$DescLength,$UploadImg, $MaxImgSize, $MaxImgHeight, $MaxImgWidth,$MaxAllowedAds;
$fileupload_size = $fileupload['size'];
$fileupload_type = $fileupload['type'];
$fileupload_name = $fileupload['name'];
$fileupload = $fileupload['tmp_name'];
$j = "";
	if ($submitteruid != 1) {
		$jmladsposted = AdsPostedByUser($submitteruid,0,0,0);
		if ($jmladsposted >= $MaxAllowedAds) {
			$NotAllowedByJml = 1;
		} else {
			$NotAllowedByJml = 0;
		}
		if ($NotAllowedByJml == 1) {
			header("Location:modules.php?name=".$module_name."&amp;file=postads&id_catg=$catgforprocess");
			die();
		}
	}
	
	if (is_user($user) || ($MemberRequired == 0)) {
		
		if ((!$title) || ($title == "") || (strlen($title) > $AdsTitleLength)) $errorTitle = 1;
		if ((!$cdesc) || ($cdesc == "") || (strlen($cdesc) > $AdsContentLength)) $errorCdesc = 1;
		if ((!$email) || ($email == "") || (strlen($email) == "")) $errorEmail1 = 1;
		if ($submitteruid == 1) {
			if ($email == "") {
				$erroremailanony = 1;
			}
		}
		if ($email != ""){
			if (!preg_match("#^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$#i",$email)) $errorEmail = 1;
		}
		if ($UploadImg && ($fileupload != "") && ($fileupload != "none")) {
			//$imageadstype = basename($fileupload_type);
			$imageadstype = substr( strstr($fileupload_type, "/"), 1);
			$UploadImageType = getImgType();

if (!in_array($imageadstype,$UploadImageType)) $errorImageType = 1;
if ( $imageadstype != "jpeg" ) {
$ImageUkuran = @getimagesize($fileupload);
if ($ImageUkuran) {

if ($ImageUkuran[0] > $MaxImgWidth) {
$ErrorUkuranImage = 1;
$ErrorUkuranImageWidth = 1;
}
if ($ImageUkuran[1] > $MaxImgHeight) {
$ErrorUkuranImage = 1;
$ErrorUkuranImageHeight = 1;
}
} else {
$ErrorUkuranImage = 1;
}
}
}

		if ($ErrorUkuranImage || $errorTitle || $errorCdesc || $errorPrice || $erroremailanony || $errorEmail1 || $errorEmail || $errorImageSize || $errorImageDimension || $errorImageType) {
			include_once("header.php");
			MenuNukeC(1);
			echo "<br />";
			OpenTable();
			echo "<center><font class=\"title\">"._NUKECSUBMITERROR."</font></center><br />";
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
				if ($cdesc == "") {
					echo "<br />"._NUKECERRORCDESCEMPTY."<br />";
				}
				if (($cdesc != "") && (strlen($cdesc) > $DescLength)) {
					echo "<br />"._NUKECERRORCDESCMAX." $DescLength "._NUKECCHARS."<br />";
				}
			}
			if ($errorEmail1) {
				if ($email == "") {
					echo "<br />"._NUKECERROREMAIL1."<br />";
				}
				if (($email != "") && (strlen($email) == "")) {
					echo "<br />".__NUKECERROREMAIL1."<br />";
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
				echo "<br /><strong>$imageadstype</strong>"._NUKECALLOWEDFILETYPE.": ";
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
			echo "<br /><a href=\"javascript:window.history.back();\"><< <strong>"._NUKECGOBACK."</strong></a>";
			echo "</center>";
			CloseTable();
			include_once("footer.php");
		} else {
			$ads_title = FixQuotes(filter_text($title, "nohtml"));
			$ads_content = FixQuotes(nl2br(filter_text($cdesc)));
			$nowdate = date("H i s m d Y");
			$datearray = explode(" ",$nowdate);
			$currhour = $datearray[0];
			$currminute = $datearray[1];
			$currsecond = $datearray[2];
			$currmonth = $datearray[3];
			$currday = $datearray[4];
			$curryear = $datearray[5];
			$posted_on = GetTimeUnix($currhour, $currminute, $currsecond, $currmonth, $currday, $curryear, $chgmonth=0, $chgday=0 , $chgyear=0);
			if ($postfor == 0) {
				$validuntil = 0;
			} else {
				$validuntil = GetTimeUnix($currhour, $currminute, $currsecond, $currmonth, $currday, $curryear, $chgmonth=0, $chgday+$postfor , $chgyear=0);
			}
			$price = FixQuotes(filter_text($price, "nohtml"));
                        $price =str_replace(',', '', $price);
			$resultnextidads = $db->sql_query("select max(id_ads) as maxnumber from ".$nukecprefix."_ads_ads");
			list ($nextidads) = $db->sql_fetchrow($resultnextidads);
			$nextidads++;
			if ($fileupload != "") {
				$type = basename($fileupload_type);
				if (($type == "jpeg") || ($type == "jpg") || ($type == "pjpeg")) {
					$type= "jpeg";
				}
				if ($type == "png") {
					$type = "png";
				}
				$filename = $UploadPath."$nextidads.".$type;
				$filename_thumb = $UploadPath.$nextidads."_thumb.".$type;
				copy ($fileupload, $filename);
				copy ($fileupload, $filename_thumb);
				$imguploadname = $nextidads.".".$type;
				
				$imgsize = @getimagesize($fileupload);
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
				
			} else {
				$imguploadname = "";
			}
    		if ($website != "") {
				$website = str_replace("http://","",$website);
			}
			if ($Waiting) {
				$active = 0;
			} else {
				$active = 1;
			}
			echo $sql = "insert into ".$nukecprefix."_ads_ads values"
				."('','$catgforprocess','$ads_title','$ads_content','$imguploadname','$AdsCurr','$price','$submitteruid','$email','$website','$city','$state','$country','$posted_on','$validuntil','0','$adslanguage','$active')";
			$res = $db->sql_query($sql);
			header("Location:modules.php?name=".$module_name."&file=postads&op=Done&id_catg=$catgforprocess");
		}
	} else {
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
	    OpenTable();
		echo "<center><font class=\"title\">"._NUKECPOSTNEWADS."</font></center><br />\n";
		printnotallowforanonymouse();
		CloseTable();
		include_once("footer.php");
	}
}

/************************************************
If want to use custom message, like payment and
other stuff change "_NUKECADSWAITINGMSG" to
"_NUKECADSWAITINGMSG3" on line 440. Anh Tran.
*************************************************/

function Done($id_catg) {
	global $Waiting,$module_name,$nukecprefix,$db;
	include_once("header.php");
	MenuNukeC(1);
	echo "<br />";
	OpenTable();
	echo "<center><font class=\"title\">";
	if ($Waiting == 1) {
		echo _NUKECADSWAITINGRECEIVED."";
	} else {
		echo _NUKECADSPOSTED;
	}
	echo "</font><br />\n";
	echo "<br /><strong>"._NUKECADSTHX."</strong>";
	echo "<br /><br />";
	if ($Waiting == 1) {
		$res = $db->sql_query("select count(*) as ttl from ".$nukecprefix."_ads_ads where active = 0");
		list ($jmlwaiting) = $db->sql_fetchrow($res);
		echo _NUKECADSWAITINGMSG."<br />"._NUKECADSWAITINGMSG1." $jmlwaiting "._NUKECADSWAITINGMSG2;
	} else {
		echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&id_catg=$id_catg\">"._NUKECADSCLICKHERE."</a>";
	}
	echo "</center>";
	CloseTable();
	include_once("footer.php");
}
global $id_catg,$fileupload_name, $fileupload_type, $fileupload_size;
switch($op) {
	case "Done":Done($id_catg);break;
	case "SubmitAds": SubmitAds($submitteruid, $title, $cdesc, $catgforprocess, $AdsCurr, $price, $website, $email, $city, $state, $country, $postfor, $fileupload, $adslanguage, $fileupload, $fileupload_name, $fileupload_type, $fileupload_size);break;
	default : Index($id_catg); break;
}

?>