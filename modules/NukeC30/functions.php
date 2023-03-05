<?php
######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This file contains functions commonly used in NukeC30 module
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (preg_match("#functions.php#",$_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}

$module_name = basename(dirname(__FILE__));

include_once("modules/".$module_name."/config.php");
function MenuNukeC($home=0) { /*1 = print link to home ; 0=  dont print homelink*/
	global $days,$user,$nukecprefix,$db,$module_name,$sitename,$bgcolor2,$bgcolor3,$bgcolor4,$MemberorNot;

	global $id_catg,$multilingual,$currentlang;
	OpenTable();

#######################################
# Original Logo disabled by Anh Tran
# You can add your own image here
# if you want.
#######################################

#	echo "<center><a href=\"modules.php?name=".$module_name."\"><img border=\"0\" src=\"modules/".$module_name."/images/logo.gif\" alt=\"".$sitename."-".$module_name."\" vspace=\"10\" /></a></center>";

	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"1\" border=\"0\">";
	echo "<tr >";
	if ($home == 1) {
		echo "<td align=\"center\">\n"
			."<a href=\"modules.php?name=".$module_name."\" class=\"bluelink\">\n"
			."<img src=\"modules/".$module_name."/images/adsmain.png\" alt=\""._NUKECHOME."\" title=\""._NUKECHOME."\" border=\"0\" /></a>\n"
			."</td>";
	}
	$postlink = "modules.php?name=".$module_name."&amp;file=postads";
	if ($id_catg != "") {
		$postlink .= "&amp;id_catg=".$id_catg;
	}
	echo "<td align=\"center\">"
		."<a href=\"$postlink\" class=\"bluelink\">\n"
		."<img src=\"modules/".$module_name."/images/postads.png\" alt=\""._NUKECPOSTNEWADS."\" title=\""._NUKECPOSTNEWADS."\" border=\"0\" /></a>\n"
		."</td>";
	echo "<td align=\"center\">\n"
		."<a href=\"modules.php?name=".$module_name."&amp;file=adsbox\" class=\"bluelink\">\n"
		."<img src=\"modules/".$module_name."/images/adsbox.png\" alt=\""._NUKECYOURADSBOX."\" title=\""._NUKECYOURADSBOX."\" border=\"0\" /></a>\n"
		."</td>";
echo "<td align=\"center\">\n"
		."<a href=\"nukecbackend.php\" class=\"bluelink\">\n"
		."<img src=\"modules/".$module_name."/images/rssbox.png\" alt=\"RSS Feed\" Title=\"RSS Feed\" border=\"0\" /></a>\n"
		."</td>";
	echo "<td align=\"center\">\n"
		."<a href=\"modules.php?name=".$module_name."&amp;op=mostpop\" class=\"bluelink\">\n"
		."<img src=\"modules/".$module_name."/images/mostpop.png\" alt=\""._NUKECMOSTPOP."\" title=\""._NUKECMOSTPOP."\" border=\"0\" /></a>\n"
		."</td>";

	echo "</tr>";
	echo "</table>";
	echo "<table align=\"center\" cellspacing=\"3\" cellpadding=\"1\" border=\"0\">";
	echo "";
	echo "<tr><td><form action=\"modules.php?name=".$module_name."&amp;op=viewads\" method=\"post\">";
	echo "<strong>"._NUKECVIEWADSFOR."</strong> <select name=\"days\" onchange=\"submit();\">\n"
		."<option value=\"1\" ";
		if ($days == 1) echo "selected";
	echo ">"._TODAY."</option>\n";
	echo "<option value=\"3\" ";
		if ($days == 3) echo "selected";

	echo ">"._LAST3DAYS."</option>\n"
		."<option value=\"5\" ";
		if ($days == 5) echo "selected";

	echo ">"._LAST5DAYS."</option>\n"
		."<option value=\"7\" ";
		if ($days == 7) echo "selected";
	echo ">"._LAST7DAYS."</option>\n"
		."<option value=\"9\" ";
		if ($days == 9) echo "selected";
	echo ">"._LAST9DAYS."</option>\n"
		."<option value=\"14\" ";
		if ($days == 14) echo "selected";

	echo ">"._LAST14DAYS."</option>\n"
		."</select> <input type=\"submit\" value=\""._NUKECVIEW."\" />";
	echo "</form></td></tr><tr>\n"
		."<td><form action=\"modules.php?name=".$module_name."&amp;file=search\" method=\"post\">\n"
		."<strong>"._NUKECSEARCHADS."</strong> <input type=\"text\" name=\"searchads\" size=\"20\" maxlength=\"100\" />"
		." <input type=\"submit\" value=\""._NUKECSEARCH."\" />  [ <a href=\"modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search\">"._NUKECADVSEARCH."</a> ]</form></td>"
		."</tr></table>";
			$sqldisc = "select no from ".$nukecprefix."_ads_disclaimer";
		if ($multilingual) {
			$sqldisc .= " where language='".$currentlang."'";
		} else {
			$sqldisc .= " where language=''";
		}
		$re = $db->sql_query($sqldisc);
		if ($db->sql_numrows($re) > 0) {
			list ($no) = $db->sql_fetchrow($re);
			echo "<br /><center>"._NUKECAGREE1."<a href=\"modules.php?name=".$module_name."&amp;op=Disclaimer&amp;no=".$no."\">"._NUKECAGREE2."</a></center>";
		}
	CloseTable();
}

function printnotallowforanonymouse() {
	echo "<center>"._NUKECNOTUSER1."<br />"
	    .""._NUKECNOTUSER2."<br /><br />"
	    .""._NUKECNOTUSER21."<br />"
	    .""._NUKECNOTUSER22."<br />"
	    .""._NUKECNOTUSER23."<br /><br /><br />"
        .""._NUKECNOTUSER3."<br />"
        .""._NUKECNOTUSER4."<br />"
        .""._NUKECNOTUSER5."<br />"
        .""._NUKECNOTUSER6."<br />"
        .""._NUKECNOTUSER7."<br /><br />"
        .""._NUKECNOTUSER8.""
		."</center>";
}

function printnotallowlimitreached() {
	global $MaxAllowedAds,$module_name;
	echo "<center>"
		."<font class=\"title\">"._NUKECADSBOXFULL."</font><br /><br />"
		._NUKECALLOWEDADS1." ".$MaxAllowedAds." "._NUKECALLOWEDADS2."<br />"
		._NUKECALLOWEDADS3." ".$MaxAllowedAds." "._NUKECALLOWEDADS4
		."<br /><br />"
		."<a href=\"modules.php?name=".$module_name."&file=adsbox\">"._NUKECGOTOADSBOX."</a>"
		."</center>";
}

function getparent($parentid,$title) {
    global $nukecprefix, $db;
    $result = $db->sql_query("select id_catg, catg, parentid from ".$nukecprefix."_ads_catg where id_catg='".$parentid."'");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    if ($ptitle!="") $title=$ptitle." ? ".$title;
    if ($pparentid!=0) {
		$title=getparent($pparentid,$title);
    }
    return $title;
}


function FormatDateAdsShort($strDate){
	$arrayfulldate = explode(" ",$strDate);

	$Adob = explode ("-",$arrayfulldate[0]);
	$newdob = $Adob[2];
	if ($Adob[1] == 1)$month = _JANUARYSHRT;
	if ($Adob[1] == 2)$month = _FEBRUARYSHRT;
	if ($Adob[1] == 3)$month = _MARCHSHRT;
	if ($Adob[1] == 4)$month = _APRILSHRT;
	if ($Adob[1] == 5)$month = _MAYSHRT;
	if ($Adob[1] == 6)$month = _JUNESHRT;
	if ($Adob[1] == 7)$month = _JULYSHRT;
	if ($Adob[1] == 8)$month = _AUGUSTSHRT;
	if ($Adob[1] == 9)$month = _SEPTEMBERSHRT;
	if ($Adob[1] == 10)$month = _OCTOBERSHRT;
	if ($Adob[1] == 11)$month = _NOVEMBERSHRT;
	if ($Adob[1] == 12)$month = _DECEMBERSHRT;
	$newdob = "$month"." ".$newdob.", ".$Adob[0];
	return $newdob." ".$arrayfulldate[1];
}

function getcategoryname($id_catgtemp){
	global $nukecprefix,$db;
	$resultcatgname = $db->sql_query("select catg from ".$nukecprefix."_ads_catg where id_catg='".$id_catgtemp."'");
	list($title) = $db->sql_fetchrow($resultcatgname);
	return $title;
}

function getcategoryimage($id_catg){
	global $module_name,$db,$nukecprefix,$currentlang;
 	$resultpic = $db->sql_query("select image from ".$nukecprefix."_ads_catg where id_catg='".$id_catg."'");
    list ($catgpic) = $db->sql_fetchrow($resultpic);
	return $catgpic;
}

function getchildcategories($id_catg) {
	global $module_name,$db,$nukecprefix,$currentlang;
 	$child_categories = $db->sql_query("select id_catg from ".$nukecprefix."_ads_catg where parentid = '".$id_catg."'");
      if ($db->sql_numrows($child_categories) > 0) {

        while ($child_categories_values = $db->sql_fetchrow($child_categories)) {
		  $childcatg = getchildcategories($child_categories_values['id_catg']).$child_categories_values['id_catg']."_".$childcatg;
        }
      } else {
	  	$childcatg = $child_categories_values['id_catg'];
	  }
	return $childcatg;
}

function countads_incategory($listchildx){
	global $module_name,$db,$nukecprefix,$currentlang,$multilingual;
	$NowUnixTime = GetUnixTimeNow();
	$catg_array = explode("_",$listchildx);
	$parent = $catg_array[0];
	$sql_ads = "select count(*) as total from ".$nukecprefix."_ads_ads where ";

	if ($multilingual) {
		$where .= " language='".$currentlang."' and ";
	}

	$jml = sizeof($catg_array) - 1;
$where = "";
	if ($jml > 1) {
		$where .= "(";
	}
	$where .= " id_catg='".$parent."' ";
	if ($jml > 1) {
		$where .= " or ";
	}
	if ($jml > 1) {
		$k = 0;
		for ($i = 1;$i<= $jml;$i++) {
			$where .= "id_catg='".$catg_array[$i]."' ";
			if ($i != $jml) {
				$where .= "or ";
			}
			if ($i == $jml) {
				$where .= ")";
			}
			$k++;
		}
	}
	$where .= " and validuntil > '".$NowUnixTime."' and active = '1'";
	$resultads = $db->sql_query($sql_ads.$where);
	if (!$resultads) {
		return "<br />".$sql_ads.$where."<br />".mysql_error();
	} else {
	$totalads = $db->sql_fetchrow($resultads);
	//return $sql_ads.$where;
	return $totalads['total'];
	}
}

function themeads ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$curr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xhits) {
	global $session_id,$module_name,$bgcolor1,$bgcolor2,$nukecprefix,$db,$UseImgCatg ,$UploadPathRev,$CatgPathRev,$adstitlecolor;
	global $Price_Format_code,$Date_Format_code,$ListImgLocation;
	$memberinfo = MemberInfo($xsubmitter);
$img = "";
	if ($ximageads != "") {
				$ximageads_thumb = getThumbName($ximageads);
				$gbrsize = @getimagesize($UploadPathRev.$ximageads_thumb);
				$gbr_width = $gbrsize[0];
				$gbr_height = $gbrsize[1];
				$img .= "<p style=\"padding:1px\"><a class=\"colorbox\" title=\"".$xtitle."\" href=\"".$UploadPathRev.$ximageads."\"><img src=\"".$UploadPathRev.$ximageads_thumb."\"";
				$img .= " alt=\"".$xtitle."\" title=\""._NUKECCLICKTOENLARGE."\"";
				if ($ListImgLocation == "LEFT") {
					$img .= " align=\"left\"";
				} elseif ($ListImgLocation == "RIGHT") {
					$img .= " align=\"right\"";
				}
				$img .= " /></a></p>";
					if (($ListImgLocation == "UP") or ($ListImgLocation == "DOWN")) {
					$img = "<center>".$img."</center>";
				}


			} elseif ($UseImgCatg) {
				$sql = "select catg,image from ".$nukecprefix."_ads_catg where id_catg='".$xid_catg."'";
				$rescatgimg = $db->sql_query($sql);

				list($catg,$imagecatgsrc) = $db->sql_fetchrow($rescatgimg);
				if ($imagecatgsrc != "") {
					$imgdimension = @getimagesize($CatgPathRev.$imagecatgsrc);
					if ($imgdimension) {
						$imgcatgwidth = $imgdimension[0];
						$imgcatgheight = $imgdimension[1];
					}
					$img = "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$xid_catg."\" >";
					$img .= "<img src=\"".$CatgPathRev.$imagecatgsrc."\" width=\"".$imgcatgwidth."\" height=\"".$imgcatgheight."\" alt=\"".$catg."\" border=\"0\" /></a>";
					$img .= "</a><br /><strong>".$catg."</strong>";
				} else {
					$img = "";
				}
		}

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"".$bgcolor2."\">\n";
  	echo "<tr > \n";
	echo "<td  height=\"8\" bgcolor=\"".$bgcolor2."\"> \n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
    echo "<tr><td> </td>\n"
		."<td><strong>".$xtitle."</strong><br />"._NUKECPOSTEDON." <strong>".FormatDateAds($xdateposted,$Date_Format_code)."</strong> "._NUKECBY." <strong>".$memberinfo['username']."</strong></td>\n"
		."<td>";
		$imagemenu = "<table cellspacing=\"2\" cellpadding=\"0\" border=\"0\">";
	$imagemenu .= "<tr>";
	if ($xsubmitter != 1) {
		$imagemenu .= "<td><a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=".$xsubmitter."\"><img src=\"modules/".$module_name."/images/contactbypv.gif\" alt=\""._NUKECALTSENDPV."\" title=\""._NUKECALTSENDPV."\" width=\"25\" height=\"25\" border=\"0\" /></a></td>";
	}
	if ($xemail != "") {
		$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=contact&amp;id_ads=".$xid_ads."\"><img src=\"modules/".$module_name."/images/contactbyemail.gif\" alt=\""._NUKECCONTACTBYMAIL."\" title=\""._NUKECCONTACTBYMAIL."\" width=\"24\" height=\"25\" border=\"0\" /></a></td>";
	}
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;op=ViewDetail&amp;id_ads=".$xid_ads."\"><img border=\"0\" src=\"modules/".$module_name."/images/comment.gif\" alt=\""._NUKECALTCOMMENT."\" title=\""._NUKECALTCOMMENT."\" width=\"25\" height=\"26\" /></a></td>";
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=SaveAds&amp;id_ads=".$xid_ads."\"><img border=\"0\" src=\"modules/".$module_name."/images/hotlist.gif\" alt=\""._NUKECALTPUTINHOTADSBOX."\" title=\""._NUKECALTPUTINHOTADSBOX."\" width=\"22\" height=\"25\" /></a></td>";
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=friend&amp;id_ads=".$xid_ads."\"><img src=\"modules/".$module_name."/images/friend.gif\" alt=\""._NUKECALTREFERTOFRIEND."\" title=\""._NUKECALTREFERTOFRIEND."\" width=\"34\" height=\"25\" border=\"0\" /></a></td>";
	$imagemenu .= "</tr>";
	$imagemenu .= "</table>";
	   echo "<div align=\"right\">".$imagemenu."</div>\n";
	echo "</td>"
		."</tr></table>";

    echo "</td>\n";
  echo "</tr>\n";
  echo "<tr> \n";
    echo "<td bgcolor=\"".$bgcolor1."\"> \n";
      echo "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">\n";
        echo "<tr valign=\"top\"> \n";

         echo " <td height=\"18\" width=\"93%\">";


         if ($ListImgLocation == "UP"){
         echo "$img ";
         }
			if (($ListImgLocation != "UP") and ($ListImgLocation != "DOWN")) {
			echo "$img";
			}
         echo $xads_desc."\n";
		 if ($ListImgLocation == "DOWN") {
		          echo "<br /> $img";
			}
		 if (($xprice != "") and ($xprice != 0)) {
		 	echo "<br /><strong>"._NUKECADSPRICE."</strong> : ".formatPrice($curr,$xprice,$Price_Format_code);
		 }
		 echo "</td>\n";


        echo "</tr>\n";
        echo "<tr> \n";
          echo "<td height=\"18\" colspan=\"2\"> \n";
		  $ads_detail = "<a href=\"modules.php?name=".$module_name."&amp;op=ViewDetail&amp;id_ads=".$xid_ads."\"><strong>"._NUKECVIEWDETAIL."</strong></a>";
            echo "<div align=\"center\">[ "._NUKECADSCATG." : <a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$xid_catg."\"><strong>".getcategoryname($xid_catg)."</strong></a> ";
			if ($xwebsite != "") {
				echo "| "._NUKECADSURL." : <a href=\"javascript:;\" onmouseover=\"window.status='http://".$xwebsite."';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"window.open('http://".$xwebsite."','','scrollbars=1,toolbar=1,location=1,statusbar=1,resizable=yes,width=500,height=500');\"><strong>".$xwebsite."</strong></a> ";
			}
			echo "| <font class=\"whitetext\">".$xhits." \n";
              echo ""._NUKECREAD."</font> | ".$ads_detail." ]</div>\n";
          echo "</td>\n";
        echo "</tr>\n";
      echo "</table>\n";
    echo "</td>\n";
  echo "</tr>\n";
echo "</table><hr />\n";

}


function themeadsdetail ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xvaliduntil,$xhits) {
	global $SID,$usecatgimg,$module_name,$bgcolor1,$bgcolor2,$nukecprefix,$db,$admin,$adm,$user,$cookie;
	global $UseImgCatg ,$UploadPathRev,$CatgPathRev,$user, $img;
	global $Price_Format_code,$Date_Format_code, $DetailsImglocation;
		$memberinfo = MemberInfo($xsubmitter);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"".$bgcolor2."\">\n";
  	echo "<tr bgcolor=\"".$bgcolor2."\"> \n";
    echo "<td> \n";


	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
    echo "<tr><td width=\"10\"> </td>\n"
		."<td><font class=\"content\"><strong>".$xtitle."</strong></font>";
		if (is_admin($admin)) {
		echo "<br />[ <a href=\"admin.php?op=NukeC30EditAds&id_ads=".$xid_ads."\">"._NUKECEDIT."</a> |
			<a href=\"admin.php?op=NukeC30DeleteAds&id_ads=".$xid_ads."\">"._NUKECDELETECOMM."</a> ]";
		}
		
echo "</td>\n"
		."<td>";
	$imagemenu = "<table cellspacing=\"2\" cellpadding=\"0\" border=\"0\">";
	$imagemenu .= "<tr><td>";
	if (($xsubmitter == 0) or ($xsubmitter == 1)) {
		$imagemenu .= _NUKECANONYMOUS;
	}
	if ($xsubmitter != 1) {
		$imagemenu .= "<a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=".$xsubmitter."\"><img src=\"modules/".$module_name."/images/contactbypv.gif\" alt=\""._NUKECALTSENDPV."\" title=\""._NUKECALTSENDPV."\" width=\"25\" height=\"25\" border=\"0\" /></a>";
	}
	$imagemenu .= "</td>";
	if ($xemail != "") {
		$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=contact&amp;id_ads=".$xid_ads."\"><img src=\"modules/".$module_name."/images/contactbyemail.gif\" alt=\""._NUKECCONTACTBYMAIL."\" title=\""._NUKECCONTACTBYMAIL."\" width=\"24\" height=\"25\" border=\"0\" /></a></td>";
	}
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=SaveAds&amp;id_ads=".$xid_ads."\"><img border=\"0\" src=\"modules/".$module_name."/images/hotlist.gif\" alt=\""._NUKECALTPUTINHOTADSBOX."\" title=\""._NUKECALTPUTINHOTADSBOX."\" width=\"22\" height=\"25\" /></a></td>";
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&amp;file=friend&amp;id_ads=$xid_ads\"><img src=\"modules/".$module_name."/images/friend.gif\" alt=\""._NUKECALTREFERTOFRIEND."\" title=\""._NUKECALTREFERTOFRIEND."\" width=\"34\" height=\"25\" border=\"0\" /></a></td>";
	$imagemenu .= "</tr>";
	$imagemenu .= "</table>";
	echo "<div align=\"right\">".$imagemenu."</div>\n";
	echo "</td>";

		echo"</tr>";			

		echo"</table>";


    echo "</td>\n";
  echo "</tr>\n";
  echo "<tr> \n";
    echo "<td bgcolor=\"".$bgcolor1."\"> \n";
      echo "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">\n";
	    		echo '<tr><td align="right"><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4aef7c0668c21aa3"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4aef7c0668c21aa3"></script></td></tr>';
        echo "<tr valign=\"top\"> \n";
         echo " <td height=\"18\" width=\"100%\">";
		 echo "<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">";
if ($ximageads != "") {
$ximageads_thumb = getThumbName($ximageads);
			$gbrsize = @getimagesize($UploadPathRev.$ximageads);
			$gbr_width = $gbrsize[0];
			$gbr_height = $gbrsize[1];
			$img = "";
			$img .= "<a class=\"colorbox\" title=\"".$xtitle."\" href=\"".$UploadPathRev.$ximageads."\"><img src=\"".$UploadPathRev.$ximageads_thumb."\" alt=\"".$xtitle."\" title=\""._NUKECCLICKTOENLARGE."\" /></a>";
			$img .= "";
           	} elseif ($UseImgCatg) {
			$sql = "select catg,image from ".$nukecprefix."_ads_catg where id_catg='".$xid_catg."'";
			$rescatgimg = $db->sql_query($sql);

			list($catg,$imagecatgsrc) = $db->sql_fetchrow($rescatgimg);
			if ($imagecatgsrc != "") {
				$imgdimension = @getimagesize($CatgPathRev.$imagecatgsrc);
				if ($imgdimension) {
					$imgcatgwidth = $imgdimension[0];
					$imgcatgheight = $imgdimension[1];
				}
				$img = "";
				$img .= "<img src=\"".$CatgPathRev.$imagecatgsrc."\" width=\"".$imgcatgwidth."\" height=\"".$imgcatgheight."\" alt=\"".$catg."\" border=\"0\" /></a>";
				$img .= "</a><br /><strong>".$catg."</strong>";
			} else {
				$img = "";
			}
		}
		if ($DetailsImglocation == "UP") echo "<tr><td align=\"center\">".$img."</td></tr>\n";
		 echo "<tr><td>".$xads_desc."</td></tr>";
		if ($DetailsImglocation == "DOWN") echo "<tr><td align=\"center\">".$img."</td></tr>\n";

		 echo "<tr><td><strong>"._NUKECBY." </strong>:  ".$memberinfo['username']."</td>";
			echo "</tr>\n";
			echo "<tr><td><strong>"._NUKEC_CITY." :</strong> ".$xcity."</td></tr>";
			echo "<tr><td><strong>"._NUKEC_STATE." :</strong> ".$xstate."</td></tr>";
			echo "<tr><td><strong>"._NUKEC_COUNTRY." :</strong> ".$xcountry."</td></tr>";
		 	echo "<tr><td><strong>"._NUKECPOSTEDON." : </strong>".FormatDateAds($xdateposted,$Date_Format_code)."</td></tr>";
			echo "<tr><td><strong>"._NUKECEXPDON." :</strong> ".FormatDateAds($xvaliduntil,$Date_Format_code)."</td></tr>";
			if (($xprice != "") and ($xprice != 0)) {
				echo "<tr><td><strong>"._NUKECADSPRICE." :</strong> ".formatPrice($xcurr,$xprice,$Price_Format_code)."</td></tr>";
		 	}
			$daysremain = countremaindays($xvaliduntil);
			echo "<tr><td><strong>"._NUKECDAYSREMAIN." :</strong> ".$daysremain." "._NUKECADSDAYS."</td></tr>";
			echo "<tr><td><strong>"._NUKECREAD." :</strong> ".$xhits." "._NUKECREAD."</td></tr>";
			echo "<tr><td><strong>"._NUKECADSCOMMENT." :</strong>\n";

			$rescomment = $db->sql_query("select no_comment,commentby,subject,comment,hostname,date from ".$nukecprefix."_ads_comments where id_ads='".$xid_ads."'");
			$jmlcomment = $db->sql_numrows($rescomment);
			if ($jmlcomment > 0) {
				$k = 0;
				if (is_admin($admin)) {
					$adm = 1;
				}
				while (list($xno_comment,$xcommentby,$xsubject,$xcomment,$xhostname,$xdate) = $db->sql_fetchrow($rescomment)) {
					$k++;
					$memberinfocomm = MemberInfo($xcommentby);
					echo "<table width=\"100%\" cellspacing=\"2\" cellpadding=\"1\" border=\"0\">\n"
						."<tr><td width=\"5\"> </td><td><hr />"._NUKECBY." <strong>".$memberinfocomm['username']."</strong> ";// "._NUKECON." //".FormatDateAds($xdate,$Date_Format_code)." ";
					echo "[ <a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=".$xsubmitter."\">"._NUKECUSERINFO."</a> | ";
					echo " <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=".$xsubmitter."\">"._NUKECSENDMSG."</a>] ";
					if ($adm == 1) {
						echo " [ <a href=\"admin.php?op=NukeC30DeleteComment&commentid=".$xno_comment."\" onclick=\"return confirm('"._NUKECDELETECOMMENTCONFIRM."');\">"._NUKECDELETECOMM."</a> ]";
					}
					echo "<br /></td></tr>"
						."<tr><td width=\"5\"> </td><td><strong>".$xsubject."</strong></td></tr>"
						."<tr><td width=\"5\"> </td><td>".$xcomment."</td></tr>"
						."</table>";
						if ($k != $jmlcomment) {
							echo "<br />";
						}
				}
				$db->sql_freeresult($rescomment);
			} else {
				echo "<br /> "._NUKECNOCOMMENT."";
			}
			echo "</td></tr>";

			echo "</table>";
		    echo "</td>\n";

        echo "</tr>\n";
        echo "<tr> \n";
          echo "<td height=\"18\" colspan=\"2\"> \n";
		  $ads_detail = "<a href=\"modules.php?name=".$module_name."&amp;op=ViewDetail&amp;id_ads=".$xid_ads."\"><strong>"._NUKECVIEWDETAIL."</strong></a>";
            echo "<div align=\"center\">[ "._NUKECADSCATG." : <a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$xid_catg."\"><strong>".getcategoryname($xid_catg)."</strong></a> ";
			if ($xwebsite != "") {
				echo "| "._NUKECADSURL." : <a href=\"javascript:;\" onmouseover=\"window.status='http://".$xwebsite."';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"window.open('http://".$xwebsite."','','scrollbars=1,toolbar=1,location=1,statusbar=1,resizable=yes,width=500,height=500');\"><strong>".$xwebsite."</strong></a> ";
			}
			echo " ]</div>\n";
          echo "</td>\n";
        echo "</tr>\n";
		echo "<tr><td align=\"center\" colspan=\"2\">";
		echo "[ <a href=\"modules.php?name=".$module_name."&amp;file=adsbox&amp;op=SaveAds&amp;id_ads=".$xid_ads."\">"._NUKECSAVE2ADSBOX."</a> ";
		if ($xsubmitter != 1) {
			echo  " | ".PrivMsgslink($xsubmitter);
		}
		if ($xemail != "") {
			echo " | <a href=\"modules.php?name=".$module_name."&amp;file=contact&amp;id_ads=".$xid_ads."\">"._NUKECCONTACTBYMAIL."</a>";
		}
		echo " | <a href=\"modules.php?name=".$module_name."&amp;file=friend&amp;id_ads=".$xid_ads."\">"._NUKEREFER2FRIEND."</a>";
		echo " ]";
		echo "<br />";
		echo "<br />";
		echo "</td></tr>";
      echo "</table>\n";
    echo "</td>\n";
  echo "</tr>\n";
echo "</table>\n";
}

function PrivMsgslink($MsgsDest) {
	$PrivmsgsLink = "<a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=".$MsgsDest."\">"._NUKECSENDMSG."</a>";
	return $PrivmsgsLink;
}


function savedadsdetail ($xid_save,$xid_ads,$xowner,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xvaliduntil) {
	global $module_name,$bgcolor1,$bgcolor2,$bgcolor3,$nukecprefix,$db,$admin;
	global $UseImgCatg ,$UploadPathRev,$CatgPathRev,$user;
	global $Price_Format_code,$Date_Format_code;
	$memberinfo = MemberInfo($xsubmitter);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"".$bgcolor2."\">\n";
  	echo "<tr bgcolor=\"".$bgcolor2."\"> \n";
    echo "<td  height=\"8\" width=\"76%\" nowrap=\"nowrap\"> \n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";

    echo "<tr> \n";
    echo "<td width=\"99%\" height=\"5\"><font class=\"whitetext\"><strong>".$xtitle."\n";
    echo "</font></td>\n";
	echo "</tr>\n";
    echo " </table>\n";
    echo "</td>\n";
    echo "<td height=\"8\" width=\"10%\"> \n";
	$imagemenu = "<table cellspacing=\"2\" cellpadding=\"0\">";
	$imagemenu .= "<tr>";
	if ($xsubmitter != 1) {
		$imagemenu .= "<td><a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=".$xsubmitter."\"><img src=\"modules/".$module_name."/images/contactbypv.gif\" alt=\""._NUKECALTSENDPV."\" title=\""._NUKECALTSENDPV."\" width=\"25\" height=\"25\" border=\"0\" /></a></td>";
	}
	if ($xemail != "") {
		$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&file=adsbox&op=Contact&id_ads=$xid_save\"><img src=\"modules/".$module_name."/images/contactbyemail.gif\" alt=\""._NUKECCONTACTBYMAIL."\" title=\""._NUKECCONTACTBYMAIL."\" width=\"24\" height=\"25\" border=\"0\" /></a></td>";
	}
	$imagemenu .= "<td><a href=\"modules.php?name=".$module_name."&file=adsbox&op=SendToFriend&id_ads=$xid_save\"><img src=\"modules/".$module_name."/images/friend.gif\" alt=\""._NUKECALTREFERTOFRIEND."\" title=\""._NUKECALTREFERTOFRIEND."\" width=\"34\" height=\"25\" border=\"0\" /></a></td>";
	$imagemenu .= "</tr>";
	$imagemenu .= "</table>";
      echo "<div align=\"right\">".$imagemenu."</div>\n";
    echo "</td>\n";
  echo "</tr>\n";
  echo "<tr> \n";
    echo "<td  colspan=\"2\" bgcolor=\"".$bgcolor1."\"> \n";
      echo "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">\n";
        echo "<tr valign=\"top\"> \n";
         echo " <td height=\"18\" width=\"100%\">";
		 echo "<table width=\"100%\" cellspacing=\"2\" cellpadding=\"1\" border=\"0\">";

		 echo "<tr><td>".$xads_desc."</td>";

		 if ($ximageads != "") {
			$gbrsize = getimagesize("modules/".$module_name."/imageads/".$ximageads);
			$gbr_width = $gbrsize[0];
			$gbr_height = $gbrsize[1];

		} elseif ($usecatgimg) {
			$sql = "select catg,image from ".$nukecprefix."_ads_catg where id_catg='".$xid_catg."'";
			$rescatgimg = $db->sql_query($sql);

			list($catg,$imagecatgsrc) = $db->sql_fetchrow($rescatgimg);
			if ($imagecatgsrc != "") {
				$imgdimension = @getimagesize("modules/".$module_name."/imagecatg/".$imagecatgsrc);
				if ($imgdimension) {
					$imgcatgwidth = $imgdimension[0];
					$imgcatgheight = $imgdimension[1];
				}
				$img = "<td rowspan=\"8\" width=\"10%\" valign=\"top\" align=\"center\"><a href=\"modules.php?name=".$module_name."&op=ViewCatg&id_catg=".$xid_catg."\" >";
				$img .= "<img src=\"modules/".$module_name."/imagecatg/".$imagecatgsrc."\" width=\"".$imgcatgwidth."\" height=\"".$imgcatgheight."\" alt=\"".$catg."\" border=\"0\" /></a>";
				$img .= "</a><br /><strong>".$catg."</strong></td>";
			} else {
				$img = "";
			}
		}
			echo $img;

		 echo "</tr>\n";
		 	echo "<tr><td><strong>"._NUKECBY." </strong>:  ".$memberinfo['uname']."</td></tr>\n";
			echo "<tr><td><strong>"._NUKEC_CITY." :</strong> ".$xcity."</td></tr>";
			echo "<tr><td><strong>"._NUKEC_STATE." :</strong> ".$xstate."</td></tr>";
			echo "<tr><td><strong>"._NUKEC_COUNTRY." :</strong> ".$xcountry."</td></tr>";
		 	echo "<tr><td><strong>"._NUKECPOSTEDON." : </strong>".FormatDateAds($xdateposted,$Date_Format_code)."</td></tr>";
			echo "<tr><td><strong>"._NUKECEXPDON." :</strong> ".FormatDateAds($xvaliduntil,$Date_Format_code)."</td></tr>";
			if (($xprice != "") and ($xprice != 0)) {
				echo "<tr><td><strong>"._NUKECADSPRICE." :</strong> ".formatPrice($xcurr,$xprice,$Price_Format_code)."</td></tr>";
		 	}
			echo "<tr><td><strong>"._NUKECADSCOMMENT." :</strong>\n";

			$rescomment = $db->sql_query("select no_comment,commentby,subject,comment,hostname,date from ".$nukecprefix."_ads_comments where id_ads='".$xid_ads."'");
			$jmlcomment = $db->sql_numrows($rescomment);
			if ($jmlcomment > 0) {
				$k = 0;
				if (is_admin($admin)) {
					$adm = 1;
				}
				while (list($xno_comment,$xcommentby,$xsubject,$xcomment,$xhostname,$xdate) = $db->sql_fetchrow($rescomment)) {
					$k++;
					$memberinfocomm = MemberInfo($xcommentby);
					echo "<table width=\"100%\" cellspacing=\"2\" cellpadding=\"1\" border=\"0\">\n"
						."<tr><td width=\"5\"> </td><td><hr />"._NUKECBY." <strong>".$memberinfocomm['uname']."</strong> ";// "._NUKECON." //".FormatDateAds($xdate,$Date_Format_code)." ";
					echo "[ <a href=\"modules.php?name=Your_Account&op=userinfo&uname=".$memberinfocomm['username']."\">"._NUKECUSERINFO."</a> | ";
					echo " <a href=\"modules.php?name=Private_Messages&file=reply&send=1&uname=".$memberinfocomm['uname']."\">"._NUKECSENDMSG."</a>] ";
					if ($adm == 1) {
						echo " [ <a href=\"admin.php?op=NukeC30DeleteComment&comment&id_ads=$xno_comment\" onclick=\"return confirm('"._NUKECDELETECOMMENTCONFIRM."');\">"._NUKECDELETECOMM."</a> ]";
					}
					echo "<br /></td></tr>"
						."<tr><td width=\"5\"> </td><td><strong>".$xsubject."</strong></td></tr>"
						."<tr><td width=\"5\"> </td><td>".$xcomment."</td></tr>"
						."</table>";
						if ($k != $jmlcomment) {
							echo "<br />";
						}
				}
				$db->sql_freeresult($rescomment);
			} else {
				echo "<br /> "._NUKECNOCOMMENT."";
			}
			echo "</td></tr>";

			echo "</table>";
		    echo "</td>\n";
		if ($ximageads != "") {
			$ads_img = "<img src=\"modules/".$module_name."/imageads/".$ximageads."\" width=\"".$gbr_width."\" height=\"".$gbr_height."\" alt=\"".$xtitle."\" />";
		}
          echo "<td height=\"18\" width=\"7%\">".$ads_img."</td>\n";
        echo "</tr>\n";
        echo "<tr> \n";
          echo "<td height=\"18\" colspan=\"2\"> \n";
		  $ads_detail = "<a href=\"modules.php?name=".$module_name."&op=ViewDetail&id_ads=".$xid_ads."\"><strong>"._NUKECVIEWDETAIL."</strong></a>";
            echo "<div align=\"center\">[ "._NUKECADSCATG." : <a href=\"modules.php?name=".$module_name."&op=ViewAds&id_catg=".$xid_catg."\"><strong>".getcategoryname($xid_catg)."</strong></a> ";
			if ($xwebsite != "") {
				echo "| "._NUKECADSURL." : <a href=\"javascript:;\" onmouseover=\"window.status='http://".$xwebsite."';return true;\" onmouseout=\"window.status='';return true;\" onclick=\"window.open('http://".$xwebsite."','','scrollbars=1,toolbar=1,location=1,statusbar=1,resizable=yes,width=500,height=500');\"><strong>".$xwebsite."</strong></a> ";
			}
			echo " ]</div>\n";
          echo "</td>\n";
        echo "</tr>\n";
		echo "<tr><td align=\"center\" colspan=\"2\">";
		echo "[ ";
		if ($xsubmitter != 1) {
			echo  "".PrivMsgslink($xsubmitter)." | ";
		}
		if ($xemail != "") {
			echo " <a href=\"modules.php?name=".$module_name."&file=adsbox&op=Contact&id_ads=".$xid_save."\">"._NUKECCONTACTBYMAIL."</a> | ";
		}
		echo " <a href=\"modules.php?name=".$module_name."&file=adsbox&op=SendToFriend&id_ads=".$xid_save."\">"._NUKEREFER2FRIEND."</a>";
		echo " ]";
		echo "<br />";
		echo "<br />";
		echo "</td></tr>";
      echo "</table>\n";
    echo "</td>\n";
  echo "</tr>\n";
echo "</table>\n";
}


function AdsInfo($xid_ads) {
	global $nukecprefix,$db,$user_prefix;
	$sql = "select * from ".$nukecprefix."_ads_ads where id_ads='".$xid_ads."'";
	$res = $db->sql_query($sql);
	return $AdsInfo = $db->sql_fetchrow($res);
}

function MemberInfo($xuid) {
	global $nukecprefix,$db,$user_prefix;
	$sql = "select name,username from ".$user_prefix."_users where user_id='".$xuid."'";
	$res = $db->sql_query($sql);
	if (!$res) {
		echo mysql_error();
	}
	return $memberinfo = $db->sql_fetchrow($res);
}

function pathcatg($id_catg){
	global $nukecprefix,$db,$module_name;
	if (($id_catg !=  "") || (isset($id_catg))) {
		$resultpath = $db->sql_query("select catg,parentid from ".$nukecprefix."_ads_catg where id_catg=".$id_catg."");
		list($catg, $parentid)=$db->sql_fetchrow($resultpath);
		$path=getparentlink($parentid,$catg);
		$path = "<a href=\"modules.php?name=".$module_name."\">"._NUKECMAIN."</a> ? ".$path;
		$path = "<strong>".$path."</strong>";
	} else {
		$path= "";
	}
	return $path;
}

function getparentlink($parentid,$title) {
    global $nukecprefix, $db,$module_name;
    $result=$db->sql_query("select id_catg, catg, parentid from ".$nukecprefix."_ads_catg where id_catg='".$parentid."'");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    if ($ptitle!="") $title="<a href='modules.php?name=".$module_name."&amp;file=index&amp;op=ViewCatg&amp;id_catg=".$cid."'>".$ptitle."</a> ? ".$title;
    if ($pparentid!=0) {
    	$title=getparentlink($pparentid,$title);
    }
    return $title;
}

function countremaindays($valid_until) {
	global $nukecprefix,$db;
	$nowdate = strtotime(date("Y-m-d"));
	$enddate = strtotime(date("Y-m-d",$valid_until));
	$sisa = ceil(($enddate-$nowdate)/86400);
	return $sisa;
}

function datesub($enddate,$begindate) {
	global $nukecprefix,$db;
	$sisa = ($enddate-$begindate)/86400;
	return $sisa;
}

function GetCurrency($currencycode){
	global $nukecprefix,$db;
	$resultcurr = $db->sql_query("select curr from ".$nukecprefix."_ads_currency where no='".$currencycode."'");
	list($currencyname) = $db->sql_fetchrow($resultcurr);
	return $currencyname;
}

function formatPrice($currency,$valueprice,$formatcode) {
	$currencyname = GetCurrency($currency);
	if ((!$formatcode ) or ($formatcode == "")) {
		$formatcode = 0;
	}
	if ($formatcode == 0) { /* e.g : US$ 1,234.56 */
		$FormattedPrice = $currencyname." ".number_format($valueprice,2);
	}
	if ($formatcode == 1) { /* e.g : 1,234.56 US$ */
		$FormattedPrice = number_format($valueprice,2)." ".$currencyname;
	}
	if ($formatcode == 2) { /* e.g : US$ 1 234,56*/
		$FormattedPrice = $currencyname." ".number_format($valueprice,2,',',' ');
	}
	if ($formatcode == 3) { /* e.g : 1 234,56 US$ */
		$FormattedPrice = number_format($valueprice,2,',',' ')." ".$currencyname;
	}
	if ($formatcode == 4) { /* e.g : US$ 1 234.56*/
		$FormattedPrice = $currencyname." ".number_format($valueprice,2,'.',' ');
	}
	if ($formatcode == 5) { /* e.g : 1 234.56 US$ */
		$FormattedPrice = number_format($valueprice,2,'.',' ')." ".$currencyname;
	}
	return $FormattedPrice;
}

function buildcurrency($sel = "") {
	global $nukecprefix,$db;
	$rescurr = $db->sql_query("select no,curr,country from ".$nukecprefix."_ads_currency");
	while (list($nocurr,$curr,$country) = $db->sql_fetchrow($rescurr)) {
		echo "<option value=\"".$nocurr."\"";
		if ($sel == $nocurr) {
			echo " selected";
		}
		echo ">(".$country.")".$curr ."</option>\n";
	}
	$db->sql_freeresult($res);
}

function buildduration($sel = "") {
	global $nukecprefix,$db;
	$resduration = $db->sql_query("select id_duration, duration_value, duration_alias from ".$nukecprefix."_ads_duration order by duration_value");
	while (list ($id_duration ,$duration_value, $duration_alias ) = $db->sql_fetchrow($resduration)) {
		echo "<option value=\"".$duration_value."\" ";
		if ($sel == $duration_value) {
			echo " selected";
		}
		echo ">".$duration_alias."</option>";
	}
	$db->sql_freeresult($resduration);
}

function NukeCAdminDone($msgid) {
	global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"".$adsbgcolor3."\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";

	echo "<center><font><strong>";
	switch($msgid) {
		case "PreferencesSaved": echo _NUKECMSGPREFSAVED; break;
		case "NewCatgDone": echo _NUKECMSGCATGADDED; break;
		case "WaitingAdsDeleted": echo _NUKECWAITINGADSDELETED;break;
		case "WaitingAdsPosted": echo _NUKECWAITINGADSPOSTED;break;
		case "AdsDeleted": echo _NUKECADSDELETEDSUCC;break;
		case "EditDone": echo _NUKECADSUPDATED;break;
		case "CommentDeleted": echo _NUKECCOMMENTDELETED;break;
	}
	echo "</strong></font></center>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}


function NukeCAdminMenu(){
	global  $adsbgcolor1, $adsbgcolor2, $adsbgcolor3,$adsbgcolor5;

	$a = "<strong><big><strong>&#8226;</strong></big></strong>";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"".$adsbgcolor3."\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td colspan=\"3\" bgcolor=\"".$adsbgcolor5."\" align=\"center\" >";
	echo "<font class=\"title\"><a href=\"admin.php?op=NukeC30\"><strong>"._NUKECADMINTITLE."</strong></a></font><br />\n";
	echo "</td></tr>";
	echo "<tr bgcolor=\"".$adsbgcolor2."\">
		<td>".$a." <a href=\"admin.php?op=NukeC30AdminCatg\"> "._NUKECADMINCATG."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30AdminWaiting\"> "._NUKECADMINMAINTENANCEADS."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30Setting\"> "._NUKECSETTING."</a></td>
		</tr>
		<tr bgcolor=\"".$adsbgcolor2."\">
		<td>".$a." <a href=\"admin.php?op=NukeC30currency\"> "._NUKECADMINCURR."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30Disclaimer\"> "._NUKECADMINDISCLAIM."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30Doc\"> "._NUKECDOCUMENTATION."</a></td>
		</tr>
		<tr bgcolor=\"".$adsbgcolor2."\">
		<td>".$a." <a href=\"admin.php?op=NukeC30AdsWordFilter\"> "._NUKECWORDFILTER."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30AdsDuration\"> "._NUKECADSDURATION."</a></td>
		<td>".$a." <a href=\"admin.php?op=NukeC30CustomContent\"> "._NUKECCUSTOMCONTENT."</a></td>
		</tr>";
	echo "</table>";
	echo "</td></tr></table>";

}

function buildOptionSelectAllow($selectname,$valueradio,$JScript="",$Text1="",$Text2="") {
	$selectopt = "<input ";
	if ($JScript != "") {
		$selectopt .= " ".$JScript;
	}
	$selectopt .= "type=\"radio\" value=\"1\" name=\"".$selectname."\"";
	if (($valueradio == "") or ($valueradio == 1)) {
		$selectopt .= " checked=\"checked\"";
	}

	$selectopt .= " />";
	if ($Text1 != "") {
		$selectopt .= $Text1." ";
	} else {
		$selectopt .= "Allowed ";
	}
	$selectopt .= "   <input ";
	if ($JScript != "") {
		$selectopt .= " ".$JScript;
	}
	$selectopt .= "type=\"radio\" value=\"0\" name=\"".$selectname."\"";
	if ($valueradio == 0) {
		$selectopt .= " checked=\"checked\"";
	}

	$selectopt .= " />";
	if ($Text2 != "") {
		$selectopt .= $Text2." ";
	} else {
		$selectopt .= "Denied";
	}
	return $selectopt;
}

function getImgType() {
	global $nukecprefix,$db;
	$sql = "select typeimg from ".$nukecprefix."_ads_imgtype where status='1'";
	$resultimgtype = $db->sql_query($sql);
	while (list ($typeimg) = $db->sql_fetchrow($resultimgtype)) {
		$AdsImgType[] = $typeimg;
	}
	return $AdsImgType;
}

function sqlapplylanguage() {
	global $multilingual,$currentlang;
	if ($multilingual) {
		$applylanguage = " language='".$currentlang."' ";
	} else {
		$applylanguage = " language='' ";
	}
	return $applylanguage;
}

function ShowCustomContent() {
	global $nukecprefix,$db;
	$sqlcustomcontent = "select custom_id, custom_title, content, weight, time from ".$nukecprefix."_ads_custom  where active='1'";
	$sqlapplylanguage = sqlapplylanguage();
	$sqlcustomcontent .= " and ".$sqlapplylanguage." order by weight";
	$resultcustomcontent = $db->sql_query($sqlcustomcontent);
	if (!$resultcustomcontent) {
		die(mysql_error());
	}
	$jmlcustomcontent = $db->sql_numrows($resultcustomcontent);
	if ($jmlcustomcontent > 0) {
	$i = 0;
	while (list($custom_id, $custom_title, $content, $weight, $time) = $db->sql_fetchrow($resultcustomcontent)) {
		themeCustomContent($custom_id, $custom_title, $content, $weight, $time);
		if ($i < $jmlcustomcontent - 1) {
			echo "<br />";
		}
		$i++;
	}
	$db->sql_freeresult($resultcustomcontent);
	echo "<br />";
	}
}

function themeCustomContent($custom_id, $custom_title, $content, $weight, $time) {
	global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
	OpenTable();
echo '<table width="100%" cellspacing="1" cellpadding="3">';
echo '<tr><td>'.$content.'</td></tr></table>';
						
CloseTable();
}


function AllowedForPosting() {
	global $nukecprefix,$db, $user,$MemberRequired, $MaxAllowedAds;
	if (is_user($user) || ($MemberRequired != 1)){
		return 1;
	} else {
		return 0;
	}
}

function GetTimeUnix($currhour, $currminute, $currsecond, $currmonth, $currday, $curryear, $chgmonth, $chgday , $chgyear){
	$mktimeUnix = mktime($currhour, $currminute, $currsecond, $currmonth + $chgmonth, $currday + $chgday, $curryear + $chgyear);
	return $mktimeUnix;
}

function GetUnixTimeNow() {
	$nowdatetmp = date("H i s m d Y");
	$datearraytmp = explode (" ", $nowdatetmp);
	return GetTimeUnix($datearraytmp[0],$datearraytmp[1],$datearraytmp[2],$datearraytmp[3],$datearraytmp[4],$datearraytmp[5],0,0,0);
}

function FormatStrMonthShort($monthvalue) {
	if ($monthvalue == 1)$month = _JANUARYSHRT;
	if ($monthvalue == 2)$month = _FEBRUARYSHRT;
	if ($monthvalue == 3)$month = _MARCHSHRT;
	if ($monthvalue == 4)$month = _APRILSHRT;
	if ($monthvalue == 5)$month = _MAYSHRT;
	if ($monthvalue == 6)$month = _JUNESHRT;
	if ($monthvalue == 7)$month = _JULYSHRT;
	if ($monthvalue == 8)$month = _AUGUSTSHRT;
	if ($monthvalue == 9)$month = _SEPTEMBERSHRT;
	if ($monthvalue == 10)$month = _OCTOBERSHRT;
	if ($monthvalue == 11)$month = _NOVEMBERSHRT;
	if ($monthvalue == 12)$month = _DECEMBERSHRT;
	return $month;
}

function FormatStrMonth($monthvalue) {
	if ($monthvalue == 1)$month = _JANUARY;
	if ($monthvalue == 2)$month = _FEBRUARY;
	if ($monthvalue == 3)$month = _MARCH;
	if ($monthvalue == 4)$month = _APRIL;
	if ($monthvalue == 5)$month = _MAY;
	if ($monthvalue == 6)$month = _JUNE;
	if ($monthvalue == 7)$month = _JULY;
	if ($monthvalue == 8)$month = _AUGUST;
	if ($monthvalue == 9)$month = _SEPTEMBER;
	if ($monthvalue == 10)$month = _OCTOBER;
	if ($monthvalue == 11)$month = _NOVEMBER;
	if ($monthvalue == 12)$month = _DECEMBER;
	return $month;
}

function FormatDateAds($datetoformat,$formatcode) {
	if ((!$formatcode) || ($formatcode == "")) {
		$formatcode = 0;
	}
	$datetemp = date("H i s m d Y",$datetoformat);
	$datearray = explode(" ",$datetemp);
	$HourtoFormat = $datearray[0];
	$MinutetoFormat = $datearray[1];
	$SecondtoFormat = $datearray[2];
	$MonthtoFormat = $datearray[3];
	$DaytoFormat = $datearray[4];
	$YeartoFormat = $datearray[5];

	switch($formatcode) {
		case 0 : return FormatDate0($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
		case 1 : return FormatDate1($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
		case 2 : return FormatDate2($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
		case 3 : return FormatDate3($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
		case 4 : return FormatDate4($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
		case 5 : return FormatDate5($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat);break;
	}
}

function FormatDate0($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : Jan 12, 2003 */
	$monthstr = FormatStrMonthShort($MonthtoFormat);
	return $monthstr." ". $DaytoFormat." ".$YeartoFormat;
}

function FormatDate1($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : HH:MM:SS Jan 12, 2003 */
	$monthstr = FormatStrMonthShort($MonthtoFormat);
	return $HourtoFormat.":".$MinutetoFormat.":".$SecondtoFormat." ".$monthstr." ". $DaytoFormat." ".$YeartoFormat;
}

function FormatDate2($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : January 12, 2003 */
	$monthstr = FormatStrMonth($MonthtoFormat);
	return $monthstr." ". $DaytoFormat." ".$YeartoFormat;
}

function FormatDate3($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : HH:MM:SS January 12, 2003 */
	$monthstr = FormatStrMonth($MonthtoFormat);
	return $HourtoFormat.":".$MinutetoFormat.":".$SecondtoFormat." ".$monthstr." ". $DaytoFormat." ".$YeartoFormat;
}

function FormatDate4($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : mm/dd/yyyy */
	return $MonthtoFormat."/". $DaytoFormat."/".$YeartoFormat;
}

function FormatDate5($HourtoFormat,$MinutetoFormat, $SecondtoFormat, $MonthtoFormat,$DaytoFormat, $YeartoFormat) {
	/* sample : HH:MM:SS mm/dd/yyyy */
	return $HourtoFormat.":".$MinutetoFormat.":".$SecondtoFormat." ".$MonthtoFormat."/". $DaytoFormat."/".$YeartoFormat;
}

function AdsPostedByUser($curr_uid,$countactiveads,$countexpiredads,$countpendingads) {
	global $nukecprefix,$db;
	$NowUnixTime = GetUnixTimeNow();

	$sql = "select *  from ".$nukecprefix."_ads_ads where submitter='".$curr_uid."'";
	if ($countpendingads == 1) {
		$sql .= " and active ='0'";
	}
	if ($countactiveads == 1) {
		$sql .= " and validuntil > '".$NowUnixTime."' and active ='1'";
	}
	if ($countexpiredads == 1) {
		$sql .= " and validuntil <= '".$NowUnixTime."' and active ='1'";
	}
	$resultadsposted = $db->sql_query($sql);
	$adsposted = $db->sql_numrows($resultadsposted);
	return $adsposted;

}

function OpenTableNukeC() {
	global $adsbgcolor3,$adsbgcolor1;
	echo "<table  width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$bgcolor3."\">\n"
				."<tr><td bgcolor=\"".$bgcolor1."\">";
}

function CloseTableNukeC() {
	echo "</td></tr></table>";
}


?>
