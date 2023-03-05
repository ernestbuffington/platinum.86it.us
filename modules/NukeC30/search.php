<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This file is to process searching in NukeC30 modules
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
$pagetitle = "- ". $PageTitleNukeC;
//$index = $IndexOnSearchPage;
define('INDEX_FILE', true);  # To enable right block remove comment. Anh Tran

function Index($qtext) {
	global $nukecprefix,$db,$module_name,$cookie,$user,$PerPage,$page;
	global $nukecprefix,$db,$module_name,$multilingual,$currentlang,$MemberorNot,$PerPage,$user_prefix;
	include_once("header.php");
	MenuNukeC(0);
	echo "<br />";
    OpenTable();
	if ($qtext == "") {
		echo "<center>";
		echo "<strong>"._NUKECKEYWORDEMPTY."</strong>";
		echo "<br /><br /><A href=\"javascript:history.go(-1);\">"._NUKECGOBACK."</a>";
		echo "</center>";
	} else {
		if (!isset($page) || ($page == "")) {
			$page = 1;
		}
		$sqlsearch = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,hits";
		$sqlsearch .= " from ".$nukecprefix."_ads_ads where (title LIKE '%".$qtext."%' or ads_desc LIKE '%".$qtext."%') ";
		$applylanguage = sqlapplylanguage();
		$sqlsearch .= "and".$applylanguage;
		
		$sqlsearch .= " and active='1' order by id_ads DESC";
		$start = ($page-1)*$PerPage;
		$sqliklan = $sqlsearch." limit ".$start.",".$PerPage."";
		
		$resulttotaliklan = $db->sql_query($sqlsearch);
		$totaliklan = $db->sql_numrows($resulttotaliklan);
		$jmlhalaman = ceil($totaliklan/$PerPage);
		$resultiklan = $db->sql_query($sqliklan);
	
		if ($jmlhalaman > 1) {
			echo "<center>[ ";
			if ($page > 1) {
				$previouspage =$page-1;
				echo "<a href=\"modules.php?name=".$module_name."&amp;file=search&amp;searchads=".$qtext;
				echo "&amp;page=".$previouspage."\"  class=\"redlink\">"._NUKECPREVIOUS."</a> | ";
			}
			for ($hlm = 1;$hlm <= $jmlhalaman;$hlm++) {
				if ($hlm == $page) {
					echo "<strong>".$hlm."</strong>";
				} else {
					echo "<a href=\"modules.php?name=".$module_name."&amp;file=search&amp;searchads=".$qtext;
				echo "&amp;page=".$hlm."\"  class=\"redlink\">".$hlm."</a> ";
				}
				if ($hlm != $jmlhalaman) {	
					echo " | ";
				}
			}
		if ($page+1 <= $jmlhalaman) {
			$nextpage = $page +1;
			echo " | <a href=\"modules.php?name=".$module_name."&amp;file=search&amp;searchads=".$qtext;
			echo "&amp;page=".$nextpage."\" class=\"redlink\">"._NUKECNEXT."</a>";
		}
		echo " ]<br />";
		}
		echo "</center>";
	if ($totaliklan == 0) {
		echo "<center>"._NUKECNOADSIN." "._NUKECADSSEARCHED;
	} else {
		$pre = (($page-1) * $PerPage) + 1;
		if ($pre < 0) {
			$pre = 1;
		}
		$suf = ($pre-1) + $PerPage;
		if ($suf >= $totaliklan) {
			$suf = $totaliklan;
		}
		echo _NUKECVIEWING." <strong>".$pre."</strong> - <strong>".$suf."</strong> ("._NUKECSEARCHFROM." <strong>".$totaliklan."</strong> "._NUKECADSSEARCHTOTALFOUND.")</strong><br /><br />";
		while (list($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xvaliduntil,$xhits) = $db->sql_fetchrow($resultiklan)) {
			$xads_desc = str_replace("$qtext","<strong>$qtext</strong>",$xads_desc);
			themeads ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xhits);
			echo "<br />";
		}
	}
	}
	CloseTable();
	include_once("footer.php");
}

function adv_search() {
	global $nukecprefix,$db, $multilingual,$module_name,$currentlang;
	include_once("header.php");
	MenuNukeC(0);
	echo "<br />";
	OpenTable();
	echo "<script>\n"
		."function CheckDateForm() {\n"
		."	if (document.SearchAds.s_with_date[0].checked) {\n"
		."		document.SearchAds.s_start_date.disabled = true;\n"
		."		document.SearchAds.s_start_month.disabled = true;\n"
		."		document.SearchAds.s_start_year.disabled = true;\n"
		."		document.SearchAds.s_end_date.disabled = true;\n"
		."		document.SearchAds.s_end_month.disabled = true;\n"
		."		document.SearchAds.s_end_year.disabled = true;\n"
		."	}\n"
		."	if (document.SearchAds.s_with_date[1].checked) {\n"
		."		document.SearchAds.s_start_date.disabled = false;\n"
		."		document.SearchAds.s_start_month.disabled = false;\n"
		."		document.SearchAds.s_start_year.disabled = false;\n"
		."		document.SearchAds.s_end_date.disabled = false;\n"
		."		document.SearchAds.s_end_month.disabled = false;\n"
		."		document.SearchAds.s_end_year.disabled = false;\n"
		."	}\n"
		."}\n"
		."</script>";
	echo "<center><font class=\"title\">"._NUKECADVSEARCH."</font></center><br /><br />";
	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\">"
		."<form name=\"SearchAds\" action=\"modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do\" method=\"post\">"
		."<tr><td><strong>"._NUKECSEARCHADSTITLE." : </strong></td><td><input type=\"text\" name=\"s_title\" size=\"40\"></td></tr>"
		."<tr><td><strong>"._NUKECSEARCHDESC." : </strong></td><td><input type=\"text\" name=\"s_desc\" size=\"40\" /></td></tr>"
		."<tr><td><strong>"._NUKECSEARCHCITY." : </strong></td><td><input type=\"text\" name=\"s_desc\" size=\"25\" /></td></tr>"
		."<tr><td><strong>"._NUKECSEARCHSTATE." : </strong></td><td><input type=\"text\" name=\"s_desc\" size=\"25\" /></td></tr>"
		."<tr><td><strong>"._NUKECSEARCHCOUNTRY." : </strong></td><td><input type=\"text\" name=\"s_desc\" size=\"25\" /></td></tr>"
		."<tr><td><strong>"._NUKECADSCATG." : </strong></td><td>";
	
	echo "<select name=\"s_catg\">";
		echo "<option value=\"any\">"._NUKECANYCATG."</option>\n";
		$applylanguage = sqlapplylanguage();
		$sql = "select id_catg,catg,parentid from ".$nukecprefix."_ads_catg ";
		$sql .= "where ".$applylanguage;
		
		$sql .= " order by parentid,catg";
 		$result2=$db->sql_query($sql);
    	$i = 0;
		while(list($id_catg2, $ccatg2, $parentid2) = $db->sql_fetchrow($result2)) {
    		if ($parentid2!=0) $ccatg2=getparent($parentid2,$ccatg2);
 			if ($postinmaincatg) {
				echo "<option value=\"".$id_catg2."\" ";
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
					echo ">".$ccatg2."</option>\n";
			} else {
				if ($parentid2 != 0) {
					echo "<option value=\"".$id_catg2."\" ";
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
					echo ">".$ccatg2."</option>\n";
    			}
			}
				
		}
		echo "</select>\n";
	
	echo "</td></tr>"
		."<tr><td colspan=\"2\">";
	echo "<table cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td width=\"100\"><strong>"._NUKECCURRENCY."</strong></td><td width=\"10\">&nbsp;</td>\n"
		."<td width=\"100\"><strong>"._NUKECSEARCHSTARTPRICE."</strong></td><td width=\"10\">&nbsp;</td>\n"
		."<td width=\"100\"><strong>"._NUKECSEARCHENDPRICE."</strong></td></tr>";
	echo "<tr><td width=\"100\">";
	echo "<select name=\"s_curr\">";
	echo "<option value=\"any\">"._NUKECSEARCHANYCURR."</option>";
		buildcurrency($sel = "");
			echo "</select>";
	echo "</td><td width=\"10\">&nbsp;</td>\n"
		."<td width=\"100\"><input type=\"text\" name=\"s_price_start\" size=\"15\"></td>\n"
		."<td width=\"10\">&nbsp;</td>\n"
		."<td width=\"100\"><input type=\"text\" name=\"s_price_end\" size=\"15\"></td></tr>";
	
	echo "</table>";
	echo "</td></tr>"
		."<tr><td><strong>"._NUKECSEARCHWITHDATE."</strong></td><td><input type=\"radio\" name=\"s_with_date\" value=\"0\" onclick=\"CheckDateForm();\" /> No date &nbsp;&nbsp;<input type=\"radio\" name=\"s_with_date\" value=\"1\"  onclick=\"CheckDateForm();\" checked /> Define Start date and End date</td></tr>"
		."<tr><td colspan=\"2\">";
	echo "<table cellspacing=\"1\" cellpadding=\"0\">";
	echo "<tr><td width=\"240\"><strong>"._NUKECSTARTDATE." : </strong> &nbsp;";
	$nowdatetmp = date("m d Y");
	$datearraytmp = explode (" ", $nowdatetmp);
	
	echo "<select name=\"s_start_date\">";
	for ($i=1;$i<=31;$i++) {
		echo "<option value=\"$i\" ";
		if ($i == $datearraytmp[1]) {
			echo "selected";
		}
		echo ">";
		if ($i < 10) {
			echo "0".$i;
		} else {
			echo $i;
		}
		echo "</option>\n";
	}
	
	echo "</select> <select name=\"s_start_month\">";
	for ($i=1;$i<=12;$i++) {
		echo "<option value=\"$i\"";
		if ($i == $datearraytmp[0]-3) {
			echo " selected";
		}
		echo ">";
		echo FormatStrMonthShort($i);
		echo "</option>\n";
	}
	echo "</select> ";
	echo "<input type=\"text\" name=\"s_start_year\" size=\"6\" maxlength=\"4\" value=\"".$datearraytmp[2]."\" />";
	echo "</td><td width=\"250\">"
		."<strong>"._NUKECENDDATE." : </strong> ";
		echo "<select name=\"s_end_date\">";
	for ($i=1;$i<=31;$i++) {
		echo "<option value=\"$i\"";
		if ($i == $datearraytmp[1]) {
			echo " selected";
		}
		echo ">";
		if ($i < 10) {
			echo "0".$i;
		} else {
			echo $i;
		}
		echo "</option>\n";
	}
	echo "</select> <select name=\"s_end_month\">";
	for ($i=1;$i<=12;$i++) {
		echo "<option value=\"$i\"";
		if ($i == $datearraytmp[0]) {
			echo " selected";
		}
		echo ">";
		echo FormatStrMonthShort($i);
		echo "</option>\n";
	}
	echo "</select> ";
	echo "<input type=\"text\" name=\"s_end_year\" size=\"6\" maxlength=\"4\" value=\"".$datearraytmp[2]."\" />";
	
	echo "</td></tr>";
	
	if ($multilingual) {
		echo "<tr><td>"._NUKECLANGUAGE."</td><td>";
		echo "<select name=\"s_language\">\n";
			$handle=opendir('language');
			while ($file = readdir($handle)) {
			    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
		    	    $langFound = $matches[1];
			        $languageslist .= $langFound." ";
			    }
			}
			closedir($handle);
			$languageslist = explode(" ", $languageslist);
			sort($languageslist);
			for ($i=0; $i < sizeof($languageslist); $i++) {
			    if($languageslist[$i]!="") {
					echo "<option value=\"".$languageslist[$i]."\" ";
		    		if($languageslist[$i]==$currentlang) echo "selected";
						echo ">".ucfirst($languageslist[$i])."</option>\n";
	   		 		}
				}
			echo "</select>";
		echo "</td></tr>";
	} else {
		echo "<input type=\"hidden\" name=\"s_language\" value=\"\" />";
	}

	echo "</table>";
	echo "</td></tr>"
		."<tr><td colspan=\"2\"><input type=\"submit\" value=\""._NUKECSEARCH."\" /></td></tr>"
		."</form>"
		."</table>";
	CloseTable();
	include_once("footer.php");
}

function adv_search_do($s_title, $s_desc, $s_catg, $s_curr, $s_price_start, $s_price_end, $s_with_date, $s_start_date, $s_start_month, $s_start_year, $s_end_date, $s_end_month, $s_end_year) {
	global $nukecprefix,$db,$multilingual,$currentlang,$page,$PerPage,$module_name;
	if (!isset($page) || (!$page) || ($page == "")) {
		$page = 1;
	}
	$sql1 = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,hits ";
	$from = " from ".$nukecprefix."_ads_ads ";
	$where = "where";
	$countwhere = 0;
	$searchlink = "modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do&amp;title=".$s_title."&amp;s_desc=".$s_desc."";
	if ($s_title) {
		$wheretitle = " (title LIKE '%".$s_title."%') and ";
		$searchlink .= "&amp;title=".$s_title."";
		$where .= $wheretitle;
	}
	
	if ($s_desc) {
		$wheredesc = " (ads_desc LIKE '%".$s_desc."%') and ";
		$where .= $wheredesc;
		$searchlink .= "&amp;s_desc=".$s_desc."";
	}
	if ($s_catg != "any") {
		$catglist = getchildcategories($s_catg);
		if ($catglist) {
			$catglist .= $s_catg;
			$catg_array =  explode("_",$catglist);
			$jmlcatg_result = sizeof($catg_array);
			$p = 1;
			for ($i = 0;$i< $jmlcatg_result;$i++) {
				$id_catg_query .= "id_catg = '".$catg_array[$i]."'";
				$p++;
				if ($p <= $jmlcatg_result) {
					$id_catg_query .= " or ";
				}
			}
		} else {
			$id_catg_query = " id_catg ='".$s_catg."'";
		}
		$wherecatg = " (".$id_catg_query.") and ";
		$where .= $wherecatg;
	}
	$searchlink = "modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do&amp;title=".$s_title."&amp;s_desc=".$s_desc."&amp;s_catg=".$s_catg."&amp;s_curr=".$s_curr."";
	$searchlink .= "&amp;s_catg=".$s_catg;
	$searchlink .= "&amp;s_curr=".$s_curr;
	if (($s_price_start) and ($s_price_end)) {
		if ($s_curr != "any") {
			$whereprice = " (curr = '".$s_curr."') and ";
		}
		$useprice  = 1;
		$whereprice .= " (price > '".$s_price_start."' or price < '".$s_price_end."') and ";
		$where .= $whereprice;
		$searchlink .= "&amp;s_price_start=".$s_price_start."&amp;s_price_end=".$s_price_end;
	} else {
		$useprice = 0;
	}
	$searchlink = "modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do&amp;title=".$s_title."&amp;s_desc=".$s_desc."&amp;s_catg=".$s_catg."&amp;s_curr=".$s_curr."&amp;s_price_start=".$s_price_start."&amp;s_price_end=".$s_price_end."";
	if (($s_price_start == "") and ($s_price_end)) {
		$whereprice = " (price < '".$s_price_end."') and ";
		$where .= $whereprice;
		$searchlink .= "&amp;s_price_end=".$s_price_end;
	}
	if (($s_price_start) and ($s_price_end == "")) {
		$whereprice = " (price > '".$s_price_start."') and ";
		$where .= $whereprice;
		$searchlink .= "&amp;s_price_start=".$s_price_start;
	}
	
	if (($s_with_date == 1) and ($s_start_year != "") and ($s_end_year != "")) {
		$nowdate = date("d m Y");
		$nowdatearray = explode (" ",$nowdate);
		if (($s_start_year > $nowdatearray[2]) or ($s_end_year > $nowdatearray[2])) {
			$s_start_year = $nowdatearray[2];
			$s_end_year = $nowdatearray[2];
		}
		//$s_start_date, $s_start_year, $s_end_date, $s_end_month, $s_end_year;
		if (($s_start_month == 2) and ($s_start_date >= 29 )) {
			if ($s_start_year % 4 != 0) {
				$s_start_date = 28;
			}
		}
		if (($s_end_month == 2) and ($s_end_date >= 29 )) {
			if ($s_end_year % 4 != 0) {
				$s_end_date = 28;
			}
		}
		$startUnixTime = GetTimeUnix(0, 0, 0,$s_start_month, $s_start_date, $s_start_year, 0, 0 ,0);
		$endUnixTime = GetTimeUnix(59, 59 , 59,$s_end_month, $s_end_date, $s_end_year, 0, 0 ,0);
		$wheredate = " (dateposted > '".$startUnixTime."' or dateposted > '".$endUnixTime."') and ";
		$where .= $wheredate;
	}
	//$s_title, $s_desc, $s_catg, $s_curr, $s_price_start, $s_price_end, $s_with_date
	
	if ($multilingual) {
		$wherelanguage = " language = '".$currentlang."' ";
	} else {
		$wherelanguage = " language = '' ";
	}
	$NowUnixTime = GetUnixTimeNow();
	$where .= $wherelanguage ." and active='1' and (validuntil > '".$NowUnixTime."') ";
	
	$order = " order by dateposted";
	$start = ($page-1)*$PerPage;
	
	$limit = " limit ".$start.",".$PerPage;
	include_once("header.php");
	MenuNukeC(0);
	echo "<BR>";
    OpenTable();
	$sqlsearch2querytotal = $sql1.$from.$where.$order;
	$resultsearchtotal = $db->sql_query($sqlsearch2querytotal);
	
	
	
	$sqlsearch2query = $sql1.$from.$where.$order.$limit;
	$resultsearch = $db->sql_query($sqlsearch2query);
	if (!$resultsearch) {
		echo mysql_error();
	}
	$jmlresult_searchtotal = $db->sql_numrows($resultsearchtotal);
	$jmlresult_search = $db->sql_numrows($resultsearch);
	$start_range_search = $start + 1;
	$end_range_search = $PerPage * $page;
	if ($jmlresult_searchtotal < $end_range_search) {
		$end_range_search = $jmlresult_searchtotal;
	}
	echo "<font class=\"title\">"._NUKECSEARCHRESULT." : </font>";
	if ($jmlresult_search > 0) {
	echo "<BR><BR>"._NUKECSEARCHFOUNDTOTAL." ".$jmlresult_searchtotal." "._NUKECSEARCHFOUNDTOTAL2."";
	$searchlink = "modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do&amp;title=".$s_title."&amp;s_desc=".$s_desc."&amp;s_catg=".$s_catg."&amp;s_curr=".$s_curr."&amp;s_price_start=".$s_price_start."&amp;s_price_end=".$s_price_end."";
	if ($jmlresult_searchtotal > $PerPage) {
			echo ", Viewing ".$start_range_search." - ".$end_range_search;
			$jmlhalaman = ceil($jmlresult_searchtotal/$PerPage);
			if ($jmlhalaman > 1) {
				echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"1\" border=\"0\">\n";
				echo "<form action=\"modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do\" method=\"post\">\n";
				echo "<input type=\"hidden\" name=\"s_title\" value=\"".$s_title."\" />\n";
				echo "<input type=\"hidden\" name=\"s_desc\" value=\"".$s_desc."\" />\n";
				echo "<input type=\"hidden\" name=\"s_catg\" value=\"".$s_catg."\" />\n";
				echo "<input type=\"hidden\" name=\"s_curr\" value=\"".$s_curr."\" />\n";
				echo "<input type=\"hidden\" name=\"s_price_start\" value=\"".$s_price_start."\" />\n";
				echo "<input type=\"hidden\" name=\"s_price_end\" value=\"".$s_price_end."\" />\n";
				echo "<input type=\"hidden\" name=\"s_with_date\" value=\"".$s_with_date."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_date\" value=\"".$s_start_date."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_month\" value=\"".$s_start_month."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_year\" value=\"".$s_start_year."\" />\n";
				echo "<input type=\"hidden\" name=\"s_end_date\" value=\"".$s_end_date."\" />\n";	
				echo "<input type=\"hidden\" name=\"s_end_month\" value=\"".$s_end_month."\" />\n";
				echo "<input type=\"hidden\" name=\"s_end_year\" value=\"".$s_end_year."\" />\n";
				echo "<tr><td align=\"right\">\n"	
					.""._NUKECGOTOPAGE." : ";
				echo "<select name=\"page\" onchange=\"this.form.submit()\">\n";
				for ($i = 1 ;$i<= $jmlhalaman;$i++) {
					echo "<option value=\"".$i."\" ";
					if ($i == $page) {
						echo "selected";
					}
					echo ">".$i."</option>\n";
				}
				echo "</select>";
				echo "</td></tr>";
				echo "</form>";
				echo "</table>";
			}
		
			while (list($xid_ads, $xid_catg, $xtitle, $xads_desc, $ximageads, $xcurr, $xprice, $xsubmitter, $xemail, $xwebsite, $xcity,$xstate,$xcountry, $xdateposted, $xhits) =  $db->sql_fetchrow($resultsearch)) {
				themeads ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xhits);
				echo "<br />";
			}
			if ($jmlhalaman > 1) {
				echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"1\" border=\"0\">\n";
				echo "<form action=\"modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search_do\" method=\"post\">\n";
				echo "<input type=\"hidden\" name=\"s_title\" value=\"".$s_title."\" />\n";
				echo "<input type=\"hidden\" name=\"s_desc\" value=\"".$s_desc."\" />\n";
				echo "<input type=\"hidden\" name=\"s_catg\" value=\"".$s_catg."\" />\n";
				echo "<input type=\"hidden\" name=\"s_curr\" value=\"".$s_curr."\" />\n";
				echo "<input type=\"hidden\" name=\"s_price_start\" value=\"".$s_price_start."\" />\n";
				echo "<input type=\"hidden\" name=\"s_price_end\" value=\"".$s_price_end."\" />\n";
				echo "<input type=\"hidden\" name=\"s_with_date\" value=\"".$s_with_date."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_date\" value=\"".$s_start_date."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_month\" value=\"".$s_start_month."\" />\n";
				echo "<input type=\"hidden\" name=\"s_start_year\" value=\"".$s_start_year."\" />\n";
				echo "<input type=\"hidden\" name=\"s_end_date\" value=\"".$s_end_date."\" />\n";
				echo "<input type=\"hidden\" name=\"s_end_month\" value=\"".$s_end_month."\" />\n";
				echo "<input type=\"hidden\" name=\"s_end_year\" value=\"".$s_end_year."\" />\n";
				echo "<tr><td align=\"right\">\n"	
					.""._NUKECGOTOPAGE." : ";
				echo "<select name=\"page\" onchange=\"this.form.submit()\">\n";
				for ($i = 1 ;$i<= $jmlhalaman;$i++) {
					echo "<option value=\"".$i."\" ";
					if ($i == $page) {
						echo "selected";
					}
					echo ">".$i."</option>\n";
				}
				echo "</select>";
				echo "</td></tr>";
				echo "</form>";
				echo "</table>";
			}
		} else {
			while (list($xid_ads, $xid_catg, $xtitle, $xads_desc, $ximageads, $xcurr, $xprice, $xsubmitter, $xemail, $xwebsite, $xcity,$xstate,$xcountry, $xdateposted, $xhits) =  $db->sql_fetchrow($resultsearch)) {
				themeads ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xhits);
				echo "<br />";
			}
		}
	} else {
		echo "<br /><br /> "._NUKECSEARCHNORESULT;
		echo "<br /><br /><a href=\"modules.php?name=".$module_name."&amp;file=search&amp;op=adv_search\">"._NUKECSEARCHAGAIN."</a>";
	}
	
	
	CloseTable();
	include_once("footer.php");
}


switch($op) {
	default : Index($searchads); break;
	case "adv_search" : adv_search(); break;
	case "adv_search_do" : adv_search_do($s_title, $s_desc, $s_catg, $s_curr, $s_price_start, $s_price_end, $s_with_date, $s_start_date, $s_start_month, $s_start_year, $s_end_date, $s_end_month, $s_end_year);break;
}

?>
