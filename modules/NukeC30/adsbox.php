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
include_once("modules/".$module_name."/config.php");
include_once("modules/".$module_name."/functions.php");
#$index = 0;
define('INDEX_FILE', true);
if (is_user($user)) {

	function Index() {
		global $nukecprefix,$db,$user,$cookie,$module_name;
		global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
		global $Date_Format_code, $EditPostedAds, $DeletePostedAds;
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
	    OpenTable();
		$curr_uid = $cookie[0];

		$NowUnixTime = GetUnixTimeNow();
		AdsBoxHeader($curr_uid);

		echo "<br />";
		echo "<center><strong>.:: "._NUKECYOURPOSTEDADS." ::.</strong></center><br />";
		$sqlposted = "select id_ads,title,dateposted,validuntil from ".$nukecprefix."_ads_ads ";
		$sqlposted .= "where validuntil > '".$NowUnixTime."' and submitter='$curr_uid' and active = '1'";
		$sqlposted .= " order by id_ads DESC";

		$resposted = $db->sql_query($sqlposted);

		if ($db->sql_numrows($resposted) > 0) {
			 OpenTableNukeC();

			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";
			echo "<tr bgcolor=\"$adsbgcolor5\">\n"
				."<td width=\"50%\"><strong>"._NUKECADSTITLE."</strong></td>\n"
				."<td width=\"15%\"><strong>"._NUKECPOSTEDON."</strong></td><td width=\"15%\"><strong>"._NUKECEXPDON."</strong></td>\n"
				."<td><strong>"._NUKECDAYSREMAIN."</strong></td>";
			if ($DeletePostedAds or $DeletePostedAds)	{
				echo "<td width=10>&nbsp;</td>\n";
				}
			echo "</tr>";
			$i = 0;
			while (list($id_ads,$title,$dateposted,$validuntil) = $db->sql_fetchrow($resposted)) {
				$i++;
				if ($i % 2 == 0) {
					$bgc = $adsbgcolor2;
					$i = 0;
				} else {
					$bgc = $adsbgcolor4;
				}
				$daysremain = countremaindays($validuntil);
				echo "<tr bgcolor=\"$bgc\">\n"
					."<td><a href=\"modules.php?name=$module_name&op=ViewDetail&id_ads=$id_ads\">$title</a></td>\n"
					."<td>".FormatDateAds($dateposted,$Date_Format_code)."</td><td>".FormatDateAds($validuntil,$Date_Format_code)."</td><td>$daysremain "._NUKECADSDAYS."</td>\n"

					."";
				if ($DeletePostedAds or $DeletePostedAds)	{
				echo "<td align=\"center\">";
				if ($EditPostedAds) {
					echo "<a href=\"modules.php?name=".$module_name."&amp;file=manage&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/view.gif\" width=\"14\" height=\"18\" alt=\""._NUKECEDIT1."\" /></a>";
				}

				if ($DeletePostedAds) {
					echo " <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteads&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/delete.gif\" width=\"15\" height=\"18\" alt=\""._NUKECDELETE."\" /></a>\n";
				}
				echo "</td></tr>";
				}
			}
			echo "</table>";
			CloseTableNukeC();
			echo "<br /><br />";
		} else {
			echo "<center>"._NUKECUHVNOADSPOSTED."</center>";
			echo "<br /><br />";
		}
		$db->sql_freeresult($resposted);
		$sqlexp = "select id_ads,title,dateposted,validuntil from ".$nukecprefix."_ads_ads ";
		$sqlexp .= "where validuntil <= '".$NowUnixTime."' and submitter='$curr_uid' and active = '1'";
		$sqlexp .= " order by id_ads";
		$resexp = $db->sql_query($sqlexp);
		echo "<center><strong>.:: "._NUKECYOUREXPADS." ::.</strong></center><br />";
		if ($db->sql_numrows($resexp) > 0) {
			 OpenTableNukeC();
			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\" >";
			echo "<tr  bgcolor=\"$adsbgcolor5\">\n"
				."<td width=\"50%\"><strong>"._NUKECADSTITLE."</strong></td>\n"
				."<td><strong>"._NUKECPOSTEDON."</strong></td><td><strong>"._NUKECEXPDON."</strong></td>\n"
				."<td width=\"10%\">&nbsp;</td>"
				."</tr>";
			$i = 0;
			while (list($id_ads,$title,$dateposted,$validuntil) = $db->sql_fetchrow($resexp)) {
				$i++;
				if ($i % 2 == 0) {
					$bgc = $adsbgcolor2;
					$i = 0;
				} else {
					$bgc = $adsbgcolor4;
				}
				echo "<tr bgcolor=\"$bgc\">\n"
					."<td>$title</td>\n"
					."<td nowrap=\"nowrap\">".FormatDateAds($dateposted,$Date_Format_code)."</td><td nowrap=\"nowrap\">".FormatDateAds($validuntil,$Date_Format_code)."</td>\n"
					."<td align=\"center\"><a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=repostads&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/repost.gif\" width=\"14\" height=\"18\" alt=\""._NUKECREPOST."\" /></a>"
					." <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteads&amp;id_ads=$id_ads\">\n"
					."<img border=\"0\" src=\"modules/".$module_name."/images/delete.gif\" width=\"15\" height=\"18\" alt=\""._NUKECDELETE."\" /></a></td>\n"
					."</tr>";
			}
			echo "</table>";
			CloseTableNukeC();
			echo "<br /><br />";

		} else {
			echo "<center>"._NUKECUHVNOADSEXP."</center>";
			echo "<br /><br />";
		}
		$db->sql_freeresult($resexp);
		$sqlsaved = "select id_save,title,dateposted,submiter from ".$nukecprefix."_ads_box ";
		$sqlsaved .= "where owner='$curr_uid'";
		$sqlsaved .= " order by id_save DESC";
		$ressaved = $db->sql_query($sqlsaved);
		echo "<center><strong>.:: "._NUKECHOTADSBOX." ::.</strong></center><br />";
		if ($db->sql_numrows($ressaved) > 0) {
			OpenTableNukeC();

			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";
			echo "<tr bgcolor=\"$adsbgcolor5\">\n"
				."<td width=\"60%\"><strong>"._NUKECADSTITLE."</strong></td>\n"
				."<td width=\"17%\"><strong>"._NUKECPOSTEDON."</strong></td><td width=\"13%\" align=\"center\"><strong>"._NUKECSUBMITBY."</strong></td>\n"
				."<td width=\"10%\">&nbsp;</td>"
				."</tr>";
			$i = 0;
			while (list($id_ads,$title,$dateposted,$submitter) = $db->sql_fetchrow($ressaved)) {
				$i++;
				if ($i % 2 == 0) {
					$bgc = $adsbgcolor2;
					$i = 0;
				} else {
					$bgc = $adsbgcolor4;
				}
				$memberinfo = MemberInfo($submitter);
				echo "<tr bgcolor=\"$bgc\">\n"
					."<td>$title</td>\n"
					."<td nowrap=\"nowrap\">".FormatDateAds($dateposted,$Date_Format_code)."</td><td align=\"center\" nowrap=\"nowrap\"><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$submitter\"><strong>$memberinfo[username]</strong></a></td>\n"
					."<td align=\"center\"> <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=viewadsbox&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/viewsv.gif\" width=\"14\" height=\"18\" alt=\""._NUKECVIEW."\" /></a>"
					." <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteadsbox&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/delete.gif\" width=\"15\" height=\"18\" alt=\""._NUKECDELETE."\" /></a></td>\n"
					."</tr>";
			}
			echo "</table>";
			CloseTableNukeC();
			echo "<br /><br />";
		} else {
			echo "<center>"._NUKECUHVNOADSINBOX."</center>";
		}
		$db->sql_freeresult($ressaved);
		/* validuntil <= '".$NowUnixTime."'  */
		$sqlexp = "select id_ads,title,dateposted,validuntil from ".$nukecprefix."_ads_ads ";
		$sqlexp .= "where submitter='$curr_uid' and active = '0'";
		$sqlexp .= " order by id_ads";
		$resexp = $db->sql_query($sqlexp);
		echo "<br /><center><strong>"._NUKECPADS."</strong></center><br />";
		if ($db->sql_numrows($resexp) > 0) {
			 OpenTableNukeC();
			echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\" >";
			echo "<tr  bgcolor=\"$adsbgcolor5\">\n"
				."<td width=\"50%\"><strong>"._NUKECADSTITLE."</strong></td>\n"
				."<td><strong>"._NUKECPOSTEDON."</strong></td><td><strong>"._NUKECEXPDON."</strong></td>\n"
				."<td width=\"5%\">&nbsp;</td>"
				."<td width=\"10%\">&nbsp;</td>"
				."</tr>";
			$i = 0;
			while (list($id_ads,$title,$dateposted,$validuntil) = $db->sql_fetchrow($resexp)) {
				$i++;
				if ($i % 2 == 0) {
					$bgc = $adsbgcolor2;
					$i = 0;
				} else {
					$bgc = $adsbgcolor4;
				}
				echo "<tr bgcolor=\"$bgc\">\n"
					."<td>$title</td>\n"
					."<td nowrap=\"nowrap\">".FormatDateAds($dateposted,$Date_Format_code)."</td><td nowrap=\"nowrap\">".FormatDateAds($validuntil,$Date_Format_code)."</td>\n"
					."<td align=\"center\">";
				if ($validuntil <=  $NowUnixTime) {
					/* expired */
					$repostadsstatus = 1;
					$imgstatus = "expired.gif";
					$altmsg = "Your ads had expired";
				} else {
					$repostadsstatus = 0;
					$imgstatus = "pending.gif";
					$altmsg = "Waiting to be reviewed";
				}
				echo "<img src=\"modules/".$module_name."/images/".$imgstatus."\" width=\"19\" height=\"18\" alt=\"".$altmsg."\" />";
				echo "</td>"
					."<td align=\"center\"><a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=repostads&amp;id_ads=$id_ads\"><img border=\"0\" src=\"modules/".$module_name."/images/repost.gif\" width=\"14\" height=\"18\" alt=\""._NUKECREPOST."\" /></a>"
					." <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteads&amp;id_ads=$id_ads\">\n"
					."<img border=\"0\" src=\"modules/".$module_name."/images/delete.gif\" width=\"15\" height=\"18\" alt=\""._NUKECDELETE."\" /></a></td>\n"
					."</tr>";
			}
			echo "</table>";
			CloseTableNukeC();
			echo "<br /><br />";
		} else {
			echo "<center>"._NUKECNOPADS."</center>";
			echo "<br /><br />";
		}
		$db->sql_freeresult($resexp);

		CloseTable();
		include_once("footer.php");
	}

	function SaveAds($id_ads) {
		global $nukecprefix,$db,$cookie,$module_name;
		include_once("header.php");
		$sql = "select id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,validuntil from ".$nukecprefix."_ads_ads where id_ads='$id_ads'";
		$res = $db->sql_query($sql);
		if ($db->sql_numrows($res) != 0) {
			$sqls = "select id_ads from ".$nukecprefix."_ads_box where id_ads='$id_ads'";
			$resbox = $db->sql_query($sqls);
			if ($db->sql_numrows($resbox) > 0) {
				MenuNukeC(1);
				echo "<br />";
				OpenTable();
				echo "<center><font class=\"title\">"._NUKECADSALREADYSAVED."</font>\n"
					."<br /><br />[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox\">"._NUKECBACKTOADSBOX."</a> ] "
					."</center><br />\n";
				CloseTable();
			} else {
				list($id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$validuntil) = $db->sql_fetchrow($res);
				$title = addslashes($title);
				$ads_desc = addslashes($ads_desc);
				$sqlinsert = "insert into ".$nukecprefix."_ads_box values(NULL,'$id_ads','$cookie[0]','".$id_catg."','$title','$ads_desc','$imageads','$curr','$price','$submitter','$email','$website','$city','$state','$country','$dateposted','$validuntil')";
				$res = $db->sql_query($sqlinsert);
				if (!$res) {
					die (mysql_error());
				}
				header("Location:modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=adsSaved");

			}
		} else {
			MenuNukeC(1);
			echo "<br />";
			OpenTable();
			echo "<center><font class=\"title\">"._NUKECERRORSAVEADS."</font>\n"
				."<br /><br />[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox\">"._NUKECBACKTOADSBOX."</a> ] "
				."</center><br />\n";
			CloseTable();
		}
		include_once("footer.php");
	}



	function DoUpdateAds($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$AdsCurr) {
		global $nukecprefix,$db,$module_name,$multilingual,$currentlang,$MemberorNot,$UploadPath;
		global $cookie,$user,$UploadImage,$anonymous,$DescLength,$DurationAds,$PriceField,$UploadImage,$TitleLength,$UploadImageSize,$UploadImagewidth,$UploadImageHeight,$UploadImageType;
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
				echo "<br />"._NUKECERRORMAXSIZEALLOWED." $UploadImageSize "._NUKECKB." <br />";
			}
			if ($errorImageDimension) {
				echo "<br />"._NUKECERRORMAXDIMENSION." $UploadImageHeight x $UploadImagewidth "._NUKECPIXEL." <br />";
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
			$ads_title = FixQuotes(filter_text($title_chng, "nohtml"));
			$ads_content = FixQuotes(nl2br(filter_text($cdesc_chng)));
			if ($price_chng != "") {
				$price_chng = FixQuotes(filter_text($price_chng, "nohtml"));
				$AdsCurrx = $AdsCurr;
			} else {
				$AdsCurrx = "";
			}
			$sqlupdate .= " set title='$title_chng', ads_desc='$ads_content', ";
			$sqlupdate .= " id_catg='$catgforprocess_chng', price='$price_chng', website='$website_chng', city='$city_chng', state='$state_chng', country='$country_chng', ";
			$sqlupdate .= " email='$email_chng' ";
			if (!$setemptyimg) {
				if ($fileupload_chng != "") {
					$type = basename($fileupload_chng_type);
					$filename = $UploadPath."$id_ads_chng.".$type;
    				copy ($fileupload_chng, $filename);
					$imguploadname = $id_ads_chng.".".$type;
					$sqlupdate .= ", imageads='$imguploadname' ";
				}
			}
			if ($setemptyimg) {
				$sqlupdate .= ",imageads='' ";
			}
			if ($multilingual) {
				$sqlupdate .= ", language='$adslanguage_chng' ";
			}
			$sqlupdate .= " where id_ads='$id_ads_chng' and submitter='$submitteruid_chng'";
			$res = $db->sql_query($sqlupdate);
			header("Location:modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=AdsUpdated");
		}
	}

	function repostads ($id_ads){
		global $admin, $module_name,$nukecprefix,$db,$multilingual,$currentlang,$MemberorNot,$bgcolor1,$bgcolor2,$bgcolor3;
		global $cookie,$user,$UploadImage,$anonymous,$DescLength,$DurationAds,$PriceField,$UploadImage,$TitleLength, $RepostExpiredAds;
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECREPOSTPOSTED."</font></center><br />";
		$adsinfo = AdsInfo($id_ads);
		themeads ($adsinfo[id_ads],$adsinfo[id_catg],$adsinfo[title],$adsinfo[ads_desc],$adsinfo[imageads],$adsinfo[curr],$adsinfo[price],$adsinfo[submitter],$adsinfo[email],$adsinfo[website],$adsinfo[city],$adsinfo[state],$adsinfo[country],$adsinfo[dateposted],$adsinfo[hits]);
		$validuntil = $adsinfo[validuntil];
		$NowUnixTime = GetUnixTimeNow();
		if (($validuntil <=  $NowUnixTime) && ($RepostExpiredAds) || (is_admin($admin))) {
			echo "<br /><table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" align=\"center\" bgcolor=\"$bgcolor2\">"
			."<form action=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=DoRepost\" method=\"post\"><tr bgcolor=\"$bgcolor3\"><TD>\n";
		echo "<input type=\"hidden\" name=\"id_ads_chng\" value=\"$id_ads\" />\n";
		echo "<input type=\"hidden\" name=\"submitteruid_chng\" value=\"$adsinfo[submitter]\" />\n";
		echo _NUKECREPOSTFOR.": \n"
			."<select name=\"postfor_chng\">\n";
		buildduration($sel="");
		echo "</select>\n"
			."<input type=\"submit\" value=\""._NUKECREPOST1."\" />"
			."</td></tr></form></table>";
		}
		CloseTable();
		include_once("footer.php");
	}

	function DoRepost($id_ads_chng,$submitteruid_chng,$postfor_chng) {
		global $nukecprefix,$db,$module_name;
		$nowdatetmp = date("H i s m d Y");
		$datearraytmp = explode (" ", $nowdatetmp);
		$NewAdsExpUnixTime = GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,$postfor_chng,0);

		$sqlupdate = "update ".$nukecprefix."_ads_ads set validuntil='".$NewAdsExpUnixTime."'";
		$sqlupdate .= "where id_ads='$id_ads_chng' and submitter='$submitteruid_chng'";

		$res = $db->sql_query($sqlupdate);
		header("Location:modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=AdsReposted");
	}

	function viewadsbox($id_save) {
		global $cookie,$nukecprefix,$db,$module_name,$AnonyComment,$user,$anonymous,$admin;
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		$db->sql_query("update ".$nukecprefix."_ads_ads set hits=hits+1 where id_ads='$id_ads'");
		$sql = "select id_ads,owner,id_catg,title,ads_desc,imageads,curr,price,submiter,email,url,city,state,country,dateposted,validuntil from ".$nukecprefix."_ads_box where id_save='$id_save'";
		$res = $db->sql_query($sql);
		list($id_ads,$owner,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$email,$submitter,$website,$city,$state,$country,$dateposted,$validuntil) = $db->sql_fetchrow($res);

		echo "<center><font class=\"title\">"._NUKECSAVEDADSDETAIL."</font>\n"
			."<br /><br />[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox\">"._NUKECBACKTOADSBOX."</a> | \n"
			." <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteadsbox&amp;id_ads=$id_save\">"._NUKECDELETE."</a> ]"
			."</center><br />\n";
		savedadsdetail($id_save,$id_ads,$owner,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$email,$submitter,$website,$city,$state,$country,$dateposted,$validuntil);
		echo "<center>\n"
			."<br />[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox\">"._NUKECBACKTOADSBOX."</a> | \n"
			." <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=deleteadsbox&amp;id_ads=$id_save\">"._NUKECDELETE."</a> ]"
			."</center><br />\n";
		CloseTable();
		include_once("footer.php");
	}

	function SendToFriend($xid_ads){
		global $cookie,$user;
		global $nukecprefix,$db,$module_name,$multilingual,$currentlang,$MemberorNot,$perpage,$user_prefix;
		include_once("header.php");
		$nowdate = date("Y-m-d");
		MenuNukeC(0);
		echo "<br />";
   		OpenTable();
   		$sqlFriendAds = "select title from ".$nukecprefix."_ads_box where id_save='$xid_ads'";
		$resultFriendAds = $db->sql_query($sqlFriendAds);

		if (!$resultFriendAds) echo mysql_error();
		list ($title) = $db->sql_fetchrow($resultFriendAds);
		echo "<center><font class=\"content\"><strong>"._NUKECFRIEND."</strong></font></center><br /><br />"
			.""._NUKECYOUSENDADS." <strong>$title</strong> "._NUKECTOAFRIEND."<br /><br />"
			."<form action=\"modules.php?name=".$module_name."&amp;file=adsbox\" method=\"post\">"
			."<input type=\"hidden\" name=\"id_ads\" value=\"$xid_ads\" />";
   		 if (is_user($user)) {
			$result=$db->sql_query("select name, user_email from ".$user_prefix."_users where username='$cookie[1]'");
			list($yn, $ye) = $db->sql_fetchrow($result);
   		 }
   		 echo "<strong>"._NUKECFYOURNAME." </strong> <input type=\"text\" name=\"yname\" value=\"$yn\" size=\"25\" /><br /><br />\n"
			."<strong>"._NUKECFYOUREMAIL." </strong> <input type=\"text\" name=\"ymail\" value=\"$ye\"size=\"35\" /><br /><br /><br>\n"
			."<strong>"._NUKECFFRIENDNAME." </strong> <input type=\"text\" name=\"fname\" size=\"25\" /><br><br>\n"
			."<strong>"._NUKECFFRIENDEMAIL." </strong> <input type=\"text\" name=\"fmail\" size=\"35\" /><br /><br />\n"
			."<input type=\"hidden\" name=\"op\" value=\"DoSendAds\" />\n"
			."<input type=\"submit\" value="._NUKECSEND." />\n"
			."</form>\n";
		CloseTable();
		include_once("footer.php");
	}

	function DoSendAds($id, $yname, $ymail, $fname, $fmail) {
    	global $sitename, $nukeurl, $nukecprefix, $db, $module_name;
		global $Date_Format_code;
		$res = $db->sql_query("select id_ads,title,id_catg,dateposted from ".$nukecprefix."_ads_box where id_save='$id'");

		list($id_ads,$title,$id_catg,$dateposted) = $db->sql_fetchrow($res);
		$adsinfo = AdsInfo($id_ads);
		$subject = ""._NUKECINTERESTING." $sitename";
		$headers = "From: $yname <$ymail>\r\n";

		$message = ""._NUKECHELLO." ".$fname.": <br /><br />"._NUKECYOURFRIEND." $yname "._NUKECCONSIDERED."<br />";
		$message .= "<br />$adsinfo[title]<br />("._NUKECFDATE." ".FormatDateAds($adsinfo[dateposted],$Date_Format_code).")<br />"._NUKECFTOPIC." ".getcategoryname($adsinfo[id_catg])."<br />";
		$adsURL = "".$nukeurl."/modules.php?name=".$module_name."&amp;op=ViewDetail&amp;id_ads=".$id_ads."";
		$adsURL .= "<a href=\"$adsURL\">".$adsURL."</a>\n";
		$message .= "<br />"._NUKECURL.": <br /><br />"._NUKECYOUCANREAD." $sitename<br /><br />$nukeurl";

   		mail($fmail, $subject, $message, $headers);
		$fname = urlencode($fname);
		$id = urlencode($id);
   		header("Location: modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=MsgSent&id=$id&fname=$fname");
   		die();
	}

	function Done($msgid) {
		global $nukecprefix,$db,$module_name,$id,$fname,$to;
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		echo "<br /><center><font class=\"content\"><strong>";
		switch($msgid){
			case "adsSaved" : echo _NUKECSAVEADSSUCCESS; break;
			case "AdsUpdated" : echo _NUKECUPDATEADSSUCCESS; break;
			case "AdsReposted": echo _NUKECREPOSTADSDONE;break;
			case "SavedAdsDeleted":echo _NUKECSAVESADSDELETEDSUCC; break;
			case "AdsDeleted": echo _NUKECADSDELETEDSUCC;break;
			case "MailSent": echo ""._NUKECMAILSENT." <strong>$to</strong><br /><br /><strong>"._NUKECTHANKS."</strong>";break;
			case "MsgSent": {
					$fname = urldecode($fname);
					$id = urldecode($id);
    				$res = $db->sql_query("select title from ".$nukecprefix."_ads_box where id_save='$id'");
					list ($title) = $db->sql_fetchrow($res);
					echo ""._NUKECADS." $title "._NUKECHASSENT." $fname... <br /><br />"._NUKECTHANKS."";
  				} break;
		}

		echo "</strong></font></center><br />\n";
		echo "<center>[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox\">"._NUKECVIEWADSBOX."</a> ] </center>";
		CloseTable();
		include_once("footer.php");
	}

	function deleteadsbox($id_save) {
		global $module_name,$nukecprefix,$db,$cookie;
		include_once("header.php");
		MenuNukeC(1);
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"title\">"._NUKECDELETEADSBOXCONFIRM."</font>\n"
			."<br /><br />"._NUKECDELETESAVEDADSCONFIRM1.""
			." [ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=DoDeleteAdsBox&amp;id_ads=".$id_save."&amp;uid=$cookie[0]\" onClick=\"return confirm('"._NUKECDELETESAVEDADSCONFIRM2."');\">"._NUKECYES."</a> \n"
			."| <a href=\"javascript:history.go(-1);\">"._NUKECNO."</a> ]</center><br />";
		CloseTable();
		include_once("footer.php");
	}

	function DoDeleteAdsBox($id_save,$uid) {
		global $nukecprefix,$db,$module_name;
		$db->sql_query("delete from ".$nukecprefix."_ads_box where id_save ='$id_save' and owner='$uid'");
		header("Location:modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=SavedAdsDeleted");
	}

	function deleteads($id_ads) {
		global $admin, $module_name,$nukecprefix,$db,$multilingual,$currentlang,$MemberorNot,$bgcolor1,$bgcolor2,$bgcolor3;
		global $cookie,$user,$UploadImage,$anonymous,$DescLength,$DurationAds,$PriceField,$UploadImage,$TitleLength, $DeletePostedAds;
		if ($DeletePostedAds) {
			include_once("header.php");
			MenuNukeC(1);
			echo "<br />";
			OpenTable();
		echo "<center><font class=\"title\">"._NUKECDELETECONFIRM."</font>\n"
			."<br /><br />"._NUKECDELETEADSCONFIRM1.""
			." [ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=DoDeleteAds&amp;id_ads=$id_ads&amp;uid=$cookie[0]\" onclick=\"return confirm('"._NUKECDELETEADSCONFIRM2."');\">"._NUKECYES."</a> \n"
			."| <a href=\"javascript:history.go(-1);\">"._NUKECNO."</a> ]</center><br />";
		$adsinfo = AdsInfo($id_ads);
		themeads ($adsinfo[id_ads],$adsinfo[id_catg],$adsinfo[title],$adsinfo[ads_desc],$adsinfo[imageads],$adsinfo[curr],$adsinfo[price],$adsinfo[submitter],$adsinfo[email],$adsinfo[website],$adsinfo[city],$adsinfo[state],$adsinfo[country],$adsinfo[dateposted],$adsinfo[hits]);
		
		CloseTable();
		include_once("footer.php");
		} else {
			header("Location:index.php");
		}
	}

	function DoDeleteAds ($id_ads,$uid) {
		global $nukecprefix,$db,$module_name;
		$db->sql_query("delete from ".$nukecprefix."_ads_ads where id_ads ='$id_ads' and submitter='$uid'");
		header("Location:modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=AdsDeleted");
	}

	function Contact($xid_save){
		global $nukecprefix,$db,$module_name,$cookie,$user;
		global $nukecprefix,$db,$module_name,$multilingual,$currentlang,$MemberorNot,$perpage,$user_prefix;
		include_once("header.php");
		$nowdate = date("Y-m-d");
		MenuNukeC(0);
		echo "<br />";
   		OpenTable();
		$res = $db->sql_query("select title,email from ".$nukecprefix."_ads_box where id_save='$xid_save'");
		list ($title,$email) = $db->sql_fetchrow($res);

		echo "<center><font class=\"content\"><strong>"._NUKECCONTACTTITLE."</strong></font></center><br /><br />"
			." "._NUKECCONTACT1." <strong>$email</strong> "._NUKECCONTACT2." <strong>$title</strong> <br /><br />"
			."<form action=\"modules.php?name=".$module_name."&amp;file=adsbox\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"tomail\" value=\"$email\" />";
	    if (is_user($user)) {
			$result=$db->sql_query("select name, user_email from ".$user_prefix."_users where username='$cookie[1]'");
			list($yn, $ye) = $db->sql_fetchrow($result);
	    }
	    echo "<strong>"._NUKECFYOURNAME." </strong> <br /><input type=\"text\" name=\"yname\" value=\"$yn\" size=\"25\" /><br /><br />\n"
			."<strong>"._NUKECFYOUREMAIL." </strong> <br /><input type=\"text\" name=\"ymail\" value=\"$ye\" size=\"35\" /><br /><br />\n"
			."<strong>"._NUKECSUBJECT." : </strong> <br /><input type=\"text\" name=\"subjek\" size=\"55\" /><br /><br />\n"

			."<strong>"._NUKECYOURMSG." : </strong> <br />"
			."<textarea name=\"pesan\" cols=\"65\" rows=\"7\"></textarea><br /><br />"
			."<input type=\"hidden\"name=\"op\" value=\"SendContact\" />\n"
			."<input type=\"submit\" value="._NUKECSEND." />\n"
			."</form>\n";
		CloseTable();
		include_once("footer.php");
	}

	function SendContact($tomail,$yname, $ymail, $pesan,$subjek) {
	    global $sitename, $nukeurl, $nukecprefix, $db, $module_name,$slogan;
		$msg = "$sitename - $slogan \n $nukeurl \n\n";
		$msg .= ""._NUKECSENDERNAME.": $yname\n";
		$msg .= ""._NUKECSENDEREMAIL.": $ymail\n";
		$msg .= ""._NUKECMESSAGE.": $pesan\n\n";
		$subject= $subjek;
		$to = $tomail;
		$mailheaders = "From: $yname <$ymail>\n";
		$mailheaders .= "Reply-To: $ymail\n\n";
		mail($to, $subject, $msg, $mailheaders);
		$to = urlencode($tomail);
	    header("Location: modules.php?name=".$module_name."&file=adsbox&op=Done&msgid=MailSent&to=$to");
	}

	function AdsBoxHeader($curr_uid) {
		global $nukecprefix,$db,$module_name,$adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5,$MaxAllowedAds;
		echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\"><tr>\n"
			."<td><img src=\"modules/".$module_name."/images/adsbox.gif\" width=\"58\" height=\"63\" alt=\"\" /><br /><font class=\"title\">"._NUKECYOURADSBOX."</font></td>\n"
			."<td width=\"35%\">";
		$CountActiveAds = AdsPostedByUser($curr_uid,$countactiveads=1,$countexpiredads=0,$countpendingads=0);
		$CountExpAds = AdsPostedByUser($curr_uid,$countactiveads=0,$countexpiredads=1,$countpendingads=0);
		$CountPendingAds = AdsPostedByUser($curr_uid,$countactiveads=0,$countexpiredads=0,$countpendingads=1);
		$JmlTotalAds = $CountActiveAds + $CountExpAds + $CountPendingAds;
		OpenTableNukeC();
		echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">";
		echo "<tr bgcolor=\"$adsbgcolor5\"><td align=\"center\"><strong>"._NUKECADBOXSUM."</strong></td></tr>\n";
		echo "<tr bgcolor=\"$adsbgcolor2\"><td>"._NUKECTADS." : <strong>".$JmlTotalAds."</strong></td></tr>\n";
		echo "<tr bgcolor=\"$adsbgcolor4\"><td>"._NUKECACADS." : <strong>".$CountActiveAds."</strong></td></tr>\n";
		echo "<tr bgcolor=\"$adsbgcolor2\"><td>"._NUKECEXADS." : <strong>".$CountExpAds."</strong></td></tr>\n";
		echo "<tr bgcolor=\"$adsbgcolor4\"><td>"._NUKECPENADS." : <strong>".$CountPendingAds."</strong></td></tr>\n";
		echo "<tr bgcolor=\"$adsbgcolor2\"><td>"._NUKECURUSING." <strong>".$JmlTotalAds."</strong> "._NUKECOUTOF." <strong>".$MaxAllowedAds."</strong> "._NUKECUTOTAL."</td></tr>\n";
		echo "</table>";
		CloseTableNukeC();

		echo "</td>"
			."</tr></table>";
	}
global $id_ads;
	switch($op) {	
		case "DoDeleteAds": DoDeleteAds ($id_ads,$uid);break;
		case "DoDeleteAdsBox": DoDeleteAdsBox($id_ads,$uid);break;
		case "DoRepost":DoRepost($id_ads_chng,$submitteruid_chng,$postfor_chng);break;
		case "DoUpdateAds" : DoUpdateAds($id_ads_chng,$submitteruid_chng,$title_chng,$cdesc_chng,$catgforprocess_chng,$price_chng,$website_chng,$email_chng,$city_chng,$state_chng,$country_chng,$setemptyimg,$fileupload_chng,$fileupload_chng_name,$fileupload_chng_type,$fileupload_chng_size,$adslanguage_chng,$AdsCurr);break;
		case "deleteadsbox" : deleteadsbox($id_ads);break;
		case "viewadsbox" : viewadsbox($id_ads);break;
		case "editposted" : editposted($id_ads);break;
		case "repostads" : repostads ($id_ads);break;
		case "deleteads" : deleteads($id_ads);break;
		case "SaveAds": SaveAds($id_ads);break;
		case "SendToFriend" : SendToFriend($id_ads);break;
		case "DoSendAds": DoSendAds($id_ads, $yname, $ymail, $fname, $fmail);break;
		case "Contact": Contact($id_ads);break;
		case "SendContact":SendContact($tomail,$yname, $ymail, $pesan,$subjek);break;
		case "Done":Done($msgid);break;
		default : Index(); break;
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