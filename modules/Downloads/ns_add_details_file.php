<?php    

/******************************************************/
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2004                         */
/* Copyright (c) 2003-2004 by Shawn Archer            */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* THIS MODULE IS NOT RELEASED UNDER THE GPL/GNU      */
/* LICENSE.                                           */
/*                                                    */
/* You can modifiy all files, EXCEPT the copyright    */
/* file to your liking. But you CANNOT redistribute   */
/* this module for any purpose, without the EXPRESS   */
/* WRITTEN CONSENT from Shawn Archer.                 */
/*                                                    */
/* Also, Francisco Burzi & the Nuke credits MUST      */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if (preg_match("/ns_add_details_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");


function viewdownloaddetails($cid, $lid, $ttitle) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $admin, $module_name, $ns_details, $ns_editorial, $ns_comments, $ns_recommend;
$result_gin = $db->sql_query("SELECT ns_dl_outside_vote, ns_dl_anon_wait_days, ns_dl_outside_wait_days, ns_dl_anon_weight, ns_dl_outside_weight, ns_dl_main_dec, ns_dl_detail_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_outside_vote, $ns_dl_anon_wait_days, $ns_dl_outside_wait_days, $ns_dl_anon_weight, $ns_dl_outside_weight, $ns_dl_main_dec, $ns_dl_detail_dec) = $db->sql_fetchrow($result_gin);
$result_tc = $db->sql_query("select prbgcolor1, prbgcolor2, tttextcolor, tbtextcolor from ".$prefix."_ns_downloads_general");
list($prbgcolor1, $prbgcolor2, $tttextcolor, $tbtextcolor) = $db->sql_fetchrow($result_tc);
$ns_details = 0;
$ns_comments = 1;
$ns_editorial = 1;
$ns_recommend = 1;
include_once("header.php");
menu(1);
echo "<a name=\"dldetails\">";
ns_mod_title3("additional_details",""._NDDLDETAILS."");
$voteresult = $db->sql_query("select rating, ratinguser, ratingcomments FROM ".$prefix."_downloads_votedata WHERE ratinglid = $lid");
$totalvotesDB = $db->sql_numrows($voteresult);
$totalvotesDB = intval($totalvotesDB);
$anonvotes = 0;
$anonvoteval = 0;
$outsidevotes = 0;
$outsidevoteeval = 0;
$regvoteval = 0;
$topanon = 0;
$bottomanon = 11;
$topreg = 0;
$bottomreg = 11;
$topoutside = 0;
$bottomoutside = 11;
$avv = array(0,0,0,0,0,0,0,0,0,0,0);
$rvv = array(0,0,0,0,0,0,0,0,0,0,0);
$ovv = array(0,0,0,0,0,0,0,0,0,0,0);
$truecomments = $totalvotesDB;
$truecomments = intval($truecomments);
    while(list($ratingDB, $ratinguserDB, $ratingcommentsDB)=$db->sql_fetchrow($voteresult)) {
 	if ($ratingcommentsDB=="") $truecomments--;
        if ($ratinguserDB==$anonymous) {
	    	$anonvotes++;
	    	$anonvoteval += $ratingDB;
		}
	if ($ns_dl_outside_vote == 1) {
	    if ($ratinguserDB=='outside') {
			$outsidevotes++;
	        $outsidevoteval += $ratingDB;
	    }
	} else { 
	    $outsidevotes = 0;
	}
	if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") {
	    $regvoteval += $ratingDB;
	}
	if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") {
	    if ($ratingDB > $topreg) $topreg = $ratingDB;
	    if ($ratingDB < $bottomreg) $bottomreg = $ratingDB;
	    for ($rcounter = 1; $rcounter < 11; $rcounter++) if ($ratingDB==$rcounter) $rvv[$rcounter]++;	
	}
	if ($ratinguserDB==$anonymous) {
	    if ($ratingDB > $topanon) $topanon = $ratingDB;
	    if ($ratingDB < $bottomanon) $bottomanon = $ratingDB;
	    for ($rcounter = 1; $rcounter < 11; $rcounter++) if ($ratingDB==$rcounter) $avv[$rcounter]++;	
	}
	if ($ratinguserDB=="outside") {
	    if ($ratingDB > $topoutside) $topoutside = $ratingDB;
	    if ($ratingDB < $bottomoutside) $bottomoutside = $ratingDB;
	    for ($rcounter=1; $rcounter < 11; $rcounter++) if ($ratingDB==$rcounter) $ovv[$rcounter]++;	
	}	     	
    }
    $regvotes = $totalvotesDB - $anonvotes - $outsidevotes;	 
    if ($totalvotesDB == 0) {
	$finalrating = 0;
    } else if ($anonvotes == 0 && $regvotes == 0) {
	/* Figure Outside Only Vote */
	$finalrating = $outsidevoteval / $outsidevotes;
	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
	$avgOU = $outsidevoteval / $totalvotesDB;
	$avgOU = number_format($avgOU, $ns_dl_detail_dec);	     	 	
    } else if ($outsidevotes == 0 && $regvotes == 0) {
 	/* Figure Anon Only Vote */
	$finalrating = $anonvoteval / $anonvotes;	     	 	
	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
	$avgAU = $anonvoteval / $totalvotesDB;
	$avgAU = number_format($avgAU, $ns_dl_detail_dec);	     	 	
    } else if ($outsidevotes == 0 && $anonvotes == 0) {
	/* Figure Reg Only Vote */
	$finalrating = $regvoteval / $regvotes;	     	 	
	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
	$avgRU = $regvoteval / $totalvotesDB;
	$avgRU = number_format($avgRU, $ns_dl_detail_dec);	     	 	
    } else if ($regvotes == 0 && $ns_dl_outside_vote == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
 	/* Figure Reg and Anon Mix */
 	$avgAU = $anonvoteval / $anonvotes;
	$avgOU = $outsidevoteval / $outsidevotes;	 	 	
		if ($ns_dl_anon_weight > $ns_dl_outside_weight) {
	    /* Anon is 'standard weight' */
	    	$newimpact = $ns_dl_anon_weight / $ns_dl_outside_weight;
	    	$impactAU = $anonvotes;
	    	$impactOU = $outsidevotes / $newimpact;
	    	$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
	    	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
		} else {
	    /* Outside is 'standard weight' */
	    	$newimpact = $ns_dl_outside_weight / $ns_dl_anon_weight;
	    	$impactOU = $outsidevotes;
	    	$impactAU = $anonvotes / $newimpact;
	    	$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
	    	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
		}       		         	
    } else {
     	/* REG User vs. Anonymous vs. Outside User Weight Calutions */
     	$impact = $ns_dl_anon_weight;
     	$outsideimpact = $ns_dl_outside_weight;
     	if ($regvotes == 0) {
	    $avgRU = 0;
	} else {
	    $avgRU = $regvoteval / $regvotes;
	}
	if ($anonvotes == 0) {
	    $avgAU = 0;
	} else {
	    $avgAU = $anonvoteval / $anonvotes;
	}
	if ($outsidevotes == 0 ) {
	    $avgOU = 0;
	} else {
	    $avgOU = $outsidevoteval / $outsidevotes;
	}
	$impactRU = $regvotes;
	$impactAU = $anonvotes / $impact;
	$impactOU = $outsidevotes / $outsideimpact;
	$finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
	$finalrating = number_format($finalrating, $ns_dl_detail_dec); 
    }
    if ($avgOU == 0 || $avgOU == "") {
	$avgOU = "";
    } else {
	$avgOU = number_format($avgOU, $ns_dl_detail_dec);
    }
    if ($avgRU == 0 || $avgRU == "") {
	$avgRU = "";
    } else {
	$avgRU = number_format($avgRU, $ns_dl_detail_dec);
    }
    if ($avgAU == 0 || $avgAU == "") {
	$avgAU = "";
    } else {
	$avgAU = number_format($avgAU, $ns_dl_detail_dec);
    }
    if ($topanon == 0) $topanon = "";
    if ($bottomanon == 11) $bottomanon = "";
    if ($topreg == 0) $topreg = "";
    if ($bottomreg == 11) $bottomreg = "";
    if ($topoutside == 0) $topoutside = "";
    if ($bottomoutside == 11) $bottomoutside = "";    
    $totalchartheight = 70;
    $chartunits = $totalchartheight / 10;
    $avvper		= array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvper 		= array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvper 		= array(0,0,0,0,0,0,0,0,0,0,0);
    $avvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
    $avvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
    $avvmultiplier = 0;
    $rvvmultiplier = 0;
    $ovvmultiplier = 0;
    for ($rcounter=1; $rcounter<11; $rcounter++) {
    	if ($anonvotes != 0) $avvper[$rcounter] = $avv[$rcounter] / $anonvotes;
    	if ($regvotes != 0) $rvvper[$rcounter] = $rvv[$rcounter] / $regvotes;
    	if ($outsidevotes != 0) $ovvper[$rcounter] = $ovv[$rcounter] / $outsidevotes;
    	$avvpercent[$rcounter] = number_format($avvper[$rcounter] * 100, 1);
    	$rvvpercent[$rcounter] = number_format($rvvper[$rcounter] * 100, 1);
    	$ovvpercent[$rcounter] = number_format($ovvper[$rcounter] * 100, 1);
    	if ($avv[$rcounter] > $avvmultiplier) $avvmultiplier = $avv[$rcounter];
    	if ($rvv[$rcounter] > $rvvmultiplier) $rvvmultiplier = $rvv[$rcounter];
    	if ($ovv[$rcounter] > $ovvmultiplier) $ovvmultiplier = $ovv[$rcounter];
    }
    if ($avvmultiplier != 0) $avvmultiplier = 10 / $avvmultiplier;
    if ($rvvmultiplier != 0) $rvvmultiplier = 10 / $rvvmultiplier;
    if ($ovvmultiplier != 0) $ovvmultiplier = 10 / $ovvmultiplier;
    for ($rcounter=1; $rcounter<11; $rcounter++) {
        $avvchartheight[$rcounter] = ($avv[$rcounter] * $avvmultiplier) * $chartunits;
    	$rvvchartheight[$rcounter] = ($rvv[$rcounter] * $rvvmultiplier) * $chartunits;
    	$ovvchartheight[$rcounter] = ($ovv[$rcounter] * $ovvmultiplier) * $chartunits;	
        if ($avvchartheight[$rcounter]==0) $avvchartheight[$rcounter]=1;
    	if ($rvvchartheight[$rcounter]==0) $rvvchartheight[$rcounter]=1;
    	if ($ovvchartheight[$rcounter]==0) $ovvchartheight[$rcounter]=1;	
    }
$transfertitle = preg_replace ("/_/", " ", $ttitle);
$displaytitle = $transfertitle;
$res = $db->sql_query("select name, email, description, date, hits, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where lid='$lid'");
list($auth_name, $email, $description, $date, $hits, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note) = $db->sql_fetchrow($res);
$result_fld = $db->sql_query("SELECT ns_dl_field_vers, ns_dl_field_comp, ns_dl_field_file, ns_dl_field_date, ns_dl_field_hits, ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) = $db->sql_fetchrow($result_fld);
$hits = intval($hits);
    if ($totalvotesDB < 1) {
    	$totalvotesDB = 0;
    }
    OpenTable();
	ns_dl_OpenTable();
	ns_dl_cat_jump($cid);
    ns_dl_CloseTable();
    ns_dl_OpenTable();
	echo "<br /><center><font class=\"content\"><strong>$displaytitle</strong></font><br />";
	downloadinfomenu($cid, $lid, $ttitle);
	echo "</center><br />";
    echo "<br /><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    ns_download_image();
    ns_download_image_adpop($description, $ns_des_img, $ns_dl_down_note);
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    if ($ns_dl_field_rate == 1) {
    	echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>"._DOWNLOADRATINGDET."</u></strong></td></tr>";
    	echo "<tr><td align=\"right\"><strong>"._TOTALVOTES."</strong></td>";
    	echo "<td align=\"left\">$totalvotesDB</td></tr>";
    	echo "<tr><td align=\"right\"><strong>"._OVERALLRATING.":</strong></td>";
    	echo "<td align=\"left\">$finalrating</td></tr>";
    	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	}
    if ($auth_name == "") {
		$auth_name = ""._UNKNOWN."";
    } else {
		$auth_name = "$auth_name";
    }
    echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>"._ADDITIONALDET2."</u></strong></td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\"><strong>"._AUTHOR.":</strong></td>";
    echo "<td align=\"left\">$auth_name</td></tr>";
    if (($homepage == "") || ($homepage == "http://") || ($homepage == "http:///")) {
    	echo "";
    } else {
    	echo "<tr><td align=\"right\"><strong>"._HOMEPAGE.":</strong></td>";
    	echo "<td align=\"left\"><a href=\"$homepage\" target=\"_blank\">";
		echo ""._NSDLVISIT."</a></td></tr>";
    }
	if (($ns_dl_field_hits == 1) && ($hits != "")) {
    	echo "<tr><td align=\"right\"><strong>"._UDOWNLOADS.":</strong></td><td align=\"left\">$hits</td></tr>";
    } else {
    	echo "";
	}
	if (($version != "") && ($ns_dl_field_vers == 1)) {
    	echo "<tr><td align=\"right\"><strong>"._VERSION.":</strong></td><td align=\"left\">$version</td></tr>";
    } else {
    	echo "";
	}
	if (($ns_dl_field_comp == 1) && ($ns_compat != "")) {
    	echo "<tr><td align=\"right\"><strong>"._NSCOMPAT.":</strong>";
    	echo "</td><td align=\"left\">$ns_compat</td></tr>";
    } else {
    	echo "";
	}
	if (($ns_dl_field_file == 1) && ($filesize != "")) {
    	echo "<tr><td align=\"right\"><strong>"._FILESIZE.":</strong></td>";
    	echo "<td align=\"left\">".CoolSize($filesize)."</td></tr>";
    } else {
    	echo "";
	}
	if ($ns_dl_field_date == 1) {
    	mktime (LC_TIME, $locale);
    	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $date, $datetime);
    	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4], $datetime[5], $datetime[6], $datetime[2], $datetime[3], $datetime[1]));
    	$datetime = ucfirst($datetime);
    	echo "<tr><td align=\"right\"><strong>"._ADDEDON.":</strong>";
    	echo "</td><td align=\"left\">$datetime</td></tr>";
    } else {
    	echo "";
	}
    echo "</td></tr>";
    echo "</table>";
	$result_auth = $db->sql_query("select ns_dl_auth_list from ".$prefix."_ns_downloads_auth");
	list($ns_dl_auth_list) = $db->sql_fetchrow($result_auth);
		if ($ns_dl_auth_list == 1) {
			require_once("modules/$module_name/ns_auth_list_file.php");
			ns_dl_auth_list($lid);
		}
    ns_dl_admin($lid, $admin);
    ns_dl_CloseTable();
    downloadfooter($cid, $lid, $ttitle);
    ns_dl_OpenTable();
    echo "<br /><br />";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">";
    echo "<tr><td colspan=\"2\" bgcolor=\"$prbgcolor1\" align=\"center\">";
    echo "<font color=\"$tttextcolor\"><strong>"._REGISTEREDUSERS."</strong></font>";
    echo "</td></tr></table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\" width=\"455\">";
    echo "<tr><td bgcolor=\"$prbgcolor2\">";
    echo "<font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NUMBEROFRATINGS.": $regvotes</strong></font>";
    echo "</td>";
    echo "<td rowspan=\"5\" align=\"center\" width=\"250\">";
    if ($regvotes==0) {
       	echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"210\">"
	    ."<tr>"
	  	."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	  	."</tr><tr>"
		."<td width=\"200\" height=\"75\" colspan=\"10\" bgcolor=\"$prbgcolor2\">";
	    echo "<center><font color=\"$tbtextcolor\"><strong>"._NOREGUSERSVOTES."</strong></font></center>"
		."</td></tr>"
	    ."<tr bgcolor=\"$prbgcolor1\">"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>1</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>2</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>3</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>4</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>5</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>6</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>7</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>8</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>9</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>10</strong></font></td>"
	    ."</tr></table>";
    	} else { 
       	echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"200\">"
    	."<tr>"
	    ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	    ."</tr>"
	    ."<tr>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[1] "._LVOTES." ($rvvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[1]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[2] "._LVOTES." ($rvvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[2]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[3] "._LVOTES." ($rvvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[3]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[4] "._LVOTES." ($rvvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[4]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[5] "._LVOTES." ($rvvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[5]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[6] "._LVOTES." ($rvvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[6]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[7] "._LVOTES." ($rvvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[7]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[8] "._LVOTES." ($rvvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[8]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[9] "._LVOTES." ($rvvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[9]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[10] "._LVOTES." ($rvvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[10]\"></td>"
	    ."</tr><tr bgcolor=\"$prbgcolor1\">"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>1</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>2</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>3</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>4</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>5</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>6</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>7</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>8</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>9</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font  color=\"$tttextcolor\"><strong>10</strong></font></td>"
	    ."</tr></table>";    }
    echo "</td>"
	."</tr>"
	."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._DOWNLOADRATING.": $avgRU</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._HIGHRATING.": $topreg</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._LOWRATING.": $bottomreg</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NUMOFCOMMENTS.": $truecomments</strong></font></td></tr>"
	."</table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">"
	."<tr><td bgcolor=\"$prbgcolor1\" align=\"center\">&nbsp;</td></tr></table>";
    echo "<br /><br /><table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">"
	."<tr><td colspan=\"2\" bgcolor=\"$prbgcolor1\" align=\"center\">"
	."<font color=\"$tttextcolor\"><strong>"._UNREGISTEREDUSERS."</strong></font>"
	."</td></tr></table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\" width=\"455\">"
	."<tr>"
	."<td bgcolor=\"$prbgcolor2\">"
    ."<font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NUMBEROFRATINGS.": $anonvotes</strong></font>"
	."</td>"
	."<td rowspan=\"5\" align=\"center\" width=\"250\">";
    if ($anonvotes==0) {
       	echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"210\">"
	    ."<tr>"
	  	."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\">";
		echo "<font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	  	."</tr><tr>"
		."<td width=\"200\" height=\"75\" colspan=\"10\" bgcolor=\"$prbgcolor2\">";
	    echo "<center><font color=\"$tbtextcolor\"><strong>"._NOUNREGUSERSVOTES."</strong></font></center>"
		."</td></tr>"
	    ."<tr bgcolor=\"$prbgcolor1\">"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>1</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>2</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>3</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>4</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>5</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>6</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>7</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>8</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>9</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>10</strong></font></td>"
	        ."</tr></table>";
    		} else { 
       	echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"200\">"
    	    ."<tr>"
	    ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	    ."</tr><tr>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[1] "._LVOTES." ($avvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[1]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[2] "._LVOTES." ($avvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[2]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[3] "._LVOTES." ($avvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[3]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[4] "._LVOTES." ($avvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[4]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[5] "._LVOTES." ($avvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[5]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[6] "._LVOTES." ($avvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[6]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[7] "._LVOTES." ($avvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[7]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[8] "._LVOTES." ($avvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[8]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[9] "._LVOTES." ($avvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[9]\"></td>"
	    ."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[10] "._LVOTES." ($avvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[10]\"></td>"
	    ."</tr><tr bgcolor=\"$prbgcolor1\">"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>1</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>2</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>3</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>4</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>5</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>6</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>7</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>8</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>9</strong></font></td>"
	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>10</strong></font></td>"
	    ."</tr></table>";    }
    echo "</td>"
	."</tr>"
	."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._DOWNLOADRATING.": $avgAU</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._HIGHRATING.": $topanon</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._LOWRATING.": $bottomanon</strong></font></td></tr>"
	."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NSDLNOCOM."</strong></font></td></tr>"
	."</table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">"
	."<tr><td bgcolor=\"$prbgcolor1\" align=\"center\">"
	."<font color=\"$tttextcolor\">"._WEIGHNOTE." <strong>$ns_dl_anon_weight "._TO." 1</strong></font>"
	."</td></tr></table>";
    if ($ns_dl_outside_vote == 1) {
    echo "<br /><br /><table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">"
	."<tr><td colspan=\"2\" bgcolor=\"$prbgcolor1\" align=\"center\">"
	."<font color=\"$tttextcolor\"><strong>"._OUTSIDEVOTERS."</strong></font>"
	."</td></tr></table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\" width=\"455\">"
	."<td bgcolor=\"$prbgcolor2\">"
        ."<font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NUMBEROFRATINGS.": $outsidevotes</strong></font></td>"
	."<td rowspan=\"5\" align=\"center\" width=\"250\">";
    	if ($outsidevotes==0) {
       	    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"210\">"
	        ."<tr>"
	  	."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	  	."</tr><tr>"
		."<td width=\"200\" height=\"75\" colspan=\"10\" bgcolor=\"$prbgcolor2\">";
	    echo "<center><font color=\"$tbtextcolor\"><strong>"._NOOUTSIDEVOTES."</strong></font></center>"
		."</td></tr>"
	        ."<tr bgcolor=\"$prbgcolor1\">"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>1</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>2</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>3</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>4</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>5</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>6</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>7</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>8</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>9</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>10</strong></font></td>"
	        ."</tr></table>";
		} else { 
       	    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"200\">"
	        ."<tr>"
	  	."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>"._BREAKDOWNBYVAL."</strong></font></td>"
	  	."</tr><tr>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[1] "._LVOTES." ($ovvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[1]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[2] "._LVOTES." ($ovvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[2]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[3] "._LVOTES." ($ovvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[3]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[4] "._LVOTES." ($ovvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[4]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[5] "._LVOTES." ($ovvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[5]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[6] "._LVOTES." ($ovvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[6]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[7] "._LVOTES." ($ovvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[7]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[8] "._LVOTES." ($ovvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[8]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[9] "._LVOTES." ($ovvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[9]\"></td>"
	  	."<td bgcolor=\"$prbgcolor2\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[10] "._LVOTES." ($ovvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[10]\"></td>"
	    ."</tr><tr bgcolor=\"$prbgcolor1\">"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>1</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>2</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>3</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>4</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>5</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>6</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>7</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>8</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>9</strong></font></td>"
	  	."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font color=\"$tttextcolor\"><strong>10</strong></font></td>"
	    ."</tr></table>";
	}
    echo "</td></tr>"
		."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._DOWNLOADRATING.": $avgOU</strong></font></td></tr>"
		."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._HIGHRATING.": $topoutside</strong></font></td></tr>"
		."<tr><td bgcolor=\"$prbgcolor1\"><font color=\"$tttextcolor\"><strong>&nbsp;&nbsp;"._LOWRATING.": $bottomoutside</strong></font></td></tr>"
		."<tr><td bgcolor=\"$prbgcolor2\"><font color=\"$tbtextcolor\"><strong>&nbsp;&nbsp;"._NSDLNOCOM."</strong></font></td></tr>";
    echo "</table>";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\" width=\"455\">"
		."<tr><td bgcolor=\"$prbgcolor1\" align=\"center\">"
		."<font color=\"$tttextcolor\">"._WEIGHOUTNOTE." <strong>$ns_dl_outside_weight "._TO." 1</strong></font>"
		."</td></tr></table>";
	}
    echo "<br /><br />";
    ns_dl_CloseTable();
    downloadfooter($cid, $lid, $ttitle);
    downloadfooterchild($lid);
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
}




?>
