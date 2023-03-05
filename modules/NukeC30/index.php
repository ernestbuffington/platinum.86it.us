<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is the main file of NukeC30 Module
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!preg_match("#modules.php#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
global $ModuleTitle,$op;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = "- Free Classifieds, Free Local Ads". $ModuleTitle;

#$index = $IndexOnMainPage;
define('INDEX_FILE', true); # Added by Anh Tran
include_once("modules/".$module_name."/functions.php");
function Index() {
        global $nukecprefix, $ModuleTitle, $db,$module_name,$multilingual,$currentlang,$MemberRequired,$PerPage,$UseImgCatg;
        include_once("header.php");
        $NowUnixTime = GetUnixTimeNow();
        MenuNukeC(0);
$count = "";
        echo "<br />";

        OpenTable();
    echo "<center><font class=\"title\"><strong>"._NUKECADSMAINCAT."</strong></font></center><br />";
        $sql = "select id_catg,catg,catg_desc,image from ".$nukecprefix."_ads_catg where parentid=0 ";
        $applylanguage = sqlapplylanguage();
        $sql .= "and".$applylanguage."order by catg";

        $resultcatg = $db->sql_query($sql);
        echo "<table align=\"center\" width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\"><tr>";
        while (list($id_catg,$catg,$cdesc,$imagecatg) = $db->sql_fetchrow($resultcatg)) {
                $i = 0;
                if ($count == 2) {
                    echo "<tr>\n";
                    $count = 0;
                }
                $listchild = "";
                echo "<td width=\"50%\" valign=\"top\">";
                echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"0\">";
                echo "<tr><td width=\"10\" valign=\"top\">";
                if ($UseImgCatg) {
                        if ($imagecatg == "") {
                                $imagecatgsrc= "noimage.gif";
                        } else {
                                $imagecatgsrc = $imagecatg;
                        }
                        $imgdimension = @getimagesize("modules/".$module_name."/imagecatg/".$imagecatgsrc);
                        if ($imgdimension) {
                                $imgcatgwidth = $imgdimension[0];
                                $imgcatgheight = $imgdimension[1];
                        }
                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catg."\" >";
                        echo "<img src=\"modules/".$module_name."/imagecatg/".$imagecatgsrc."\" width=\"".$imgcatgwidth."\" height=\"".$imgcatgheight."\" alt=\"".$catg."\" border=\"0\" /></a>";
                        echo "</a>";
                }
               echo "</td>";
                echo "<td>";
                echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catg."\"><strong>".$catg."";
                echo " (";
                $listchild = getchildcategories($id_catg);
                $listchild = $id_catg."_".$listchild;
                echo countads_incategory($listchild);
                echo ")";
                echo "</strong></a>";
                if ($cdesc != "") {
                        echo "<br />".$cdesc;
                }
                echo "<br />";
                echo "";
                $sql = "select id_catg,catg from ".$nukecprefix."_ads_catg where parentid='".$id_catg."' order by id_catg";
                $resultsub = $db->sql_query($sql);
                $jmlsub = $db->sql_numrows($resultsub);
                $sql .= " limit 0,10";
                $resultsublimit = $db->sql_query($sql);
                $jmlsublimit = $db->sql_numrows($resultsublimit);
                $i = 0;
                $bts = 3;
                while (list($id_catg2,$catg2) = $db->sql_fetchrow($resultsublimit)) {
                        $i++;
                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catg2."\" >";
                        echo $catg2." ";
                        echo " (";
                        $listchild2 = "";
                        $listchild2 = getchildcategories($id_catg2);
                        $listchild2 = "$id_catg2"."_".$listchild2;
                        echo countads_incategory($listchild2);
                        echo ")";
                        echo "</a> ";
                        if ($i != $jmlsublimit){
                                echo ", ";
                        }
                }
                if ($jmlsub > 10) {
                        echo ", <a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catg."\">"._NUKECMORE."</a>";
                }
                $db->sql_freeresult($resultsub);
                echo "</td></tr></table>";
            echo "</td>\n";
        /* Thanks to John Hoffmann from softlinux.org for the next 5 lines ;) */
                $count++;
                if ($count == 2) {
                            echo "</tr>\n";
                }
            }
            if ($count == 2) {
                        echo "</table>\n";
                    } else {
                        echo "</tr></table>\n";
                    }
        $sql = "select * from ".$nukecprefix."_ads_ads where";
        $applylanguage = sqlapplylanguage();
        $sql .= $applylanguage."and ";

        $sql .= " validuntil > '".$NowUnixTime."' and active='1'";
        $result = $db->sql_query($sql);
        $numrows = $db->sql_numrows($result);

        $sql = "select * from ".$nukecprefix."_ads_catg where";
        $sql .= $applylanguage;
        $result = $db->sql_query($sql);
    $catnum = $db->sql_numrows($result);

    echo "<br /><center><font class=\"content\">"._NUKECTHEREARE." <strong>".$numrows."</strong> "._NUKECADS." "._NUKECAND." <strong>".$catnum."</strong> "._NUKECCATEGORIES." "._NUKECINDB."</font></center>";
    CloseTable();
        echo "<br />";
        ShowCustomContent();
        OpenTable();

        $sql = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,hits from ".$nukecprefix."_ads_ads where";
        $applylanguage = sqlapplylanguage();

        $sql .= $applylanguage." and (validuntil > '".$NowUnixTime."') and active = '1' ";
        $sql .= "order by dateposted DESC limit 0,".$PerPage."";

        $res = $db->sql_query($sql);
        if (!$res) {
                die(mysql_error());
        }
        $jml = $db->sql_numrows($res);
        if ($jml > 0) {
                echo _NUKECTHEREARE;
                if ($jml >= $PerPage) {
                        echo "<strong> ".$PerPage." </strong>";
                } else {
                        echo "<strong> ".$jml." </strong>";
                }
                echo _NUKECLASTPOSTED."<br /><br />";
                while (list($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits) = $db->sql_fetchrow($res)) {
                        themeads($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits);

                        echo "<br />";
                }
                $db->sql_freeresult($res);
        } else {
                echo "<center>"._NUKECNOADS."</center>";
        }
        CloseTable();
        include_once("footer.php");
}


function ViewDetail($id_ads) {
        global $cookie,$nukecprefix,$db,$module_name,$AdsComment,$username,$AnonyComment,$user,$anonymous,$admin,$EditPostedAds,$adsinfo;
        global $Date_Format_code;
        include_once("header.php");
        MenuNukeC(1);
        echo "<br />";
        OpenTable();
        $NowUnixTime = GetUnixTimeNow();

        $sql = "select id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,validuntil,hits,active from ".$nukecprefix."_ads_ads where id_ads='".$id_ads."'";
        $res = $db->sql_query($sql);
        list($id_catg,$title,$ads_desc,$imageads,$curr,$price,$email,$submitter,$website,$city,$state,$country,$dateposted,$validuntil,$hits, $adsstatus) = $db->sql_fetchrow($res);
        if (($adsstatus == 1) or (is_admin($admin))) {

        if ($NowUnixTime > $validuntil) { /* Expired */
                echo "<center><font class=\"title\">"._NUKECADSEXPIRED1."</font><br /><br />";
                echo _NUKECADSEXPIRED2." ".FormatDateAds($validuntil,$Date_Format_code);
                echo "<br /><br /><a href=\"modules.php?name=".$module_name."\">"._NUKECBACK."</a>";
                echo "</center>";
        } else {

        $db->sql_query("update ".$nukecprefix."_ads_ads set hits=hits+1 where id_ads='".$id_ads."'");

 //if (is_user($user) && $EditPostedAds == 1 && $user == $submitter) {
  $adsinfo = AdsInfo($id_ads);

		if (($EditPostedAds == 1) && (is_user($user))) {
			if ($cookie[0] == $adsinfo['submitter']) {
				echo '<a href="modules.php?name='.$module_name.'&amp;file=manage&amp;id_ads='.$id_ads.'">['._NUKECEDIT.']</a>';
}
}

        if ($id_catg != "") {
                echo "<center>".pathcatg($id_catg)."</center>";
                echo "<br />\n";
        }
        echo "<center><font class=\"title\">"._NUKECADSDETAIL."</font></center><br />\n";
		
        themeadsdetail($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$email,$submitter,$website,$city,$state,$country,$dateposted,$validuntil,$hits);

        if ($AdsComment or (is_admin($admin))) {
        echo "<br />";
        OpenTable();
        if (is_user($user) || ($AnonyComment == 1)) {
                if (is_user($user)) {
                        $by = $cookie[0];
                } else {
                        $by = 1;
                }
                echo "<center><strong>.:: "._NUKECPOSTCOMMENT." ::.</strong></center><br />";
                echo "<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">\n"
                        ."<form action=\"modules.php?name=".$module_name."&amp;op=SubmitComment\" method=\"post\">"
                        ."<input type=\"hidden\" name=\"xid_ads\" value=\"".$id_ads."\" />\n"
                        ."<input type=\"hidden\" name=\"commentby\" value=\"".$by."\" />\n"
                        ."<tr><td width=\"25%\"><strong>"._NUKECYOURNAME."</strong></td><td width=\"5\">:</td>\n"
                        ."<td>";
                if (is_user($user)) {
                    cookiedecode($user);
                    echo "<a href=\"modules.php?name=Your_Account\">".$cookie[1]."</a> <font class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font>";
                } else {
                           echo "<font class=\"content\">".$anonymous."";
                    echo " [ <a href=\"modules.php?name=Your_Account\">"._NUKECNEWUSER."</a> ]";
                }
                echo "</td></tr>\n"
                        ."<tr><td><strong>"._NUKECCOMMENTSUBJECT."</strong></font></td><td width=\"5\">:</td>\n"
                        ."<td><input type=\"text\" name=\"commsubject\" size=\"35\" /></td></tr>"
                        ."<tr><td valign=\"top\"><strong>"._NUKECCOMMENTSDESC."</strong></td><td width=\"5\" valign=\"top\">:</td>\n"
                        ."<td>";
wysiwyg_textarea("commentdesc", "", "Basic", "50", "10");
//<textarea name=\"commentdesc\" cols=\"50\" rows=\"10\"></textarea>
echo "</td></tr>"
                        ."<tr><td colspan=\"3\"><input type=\"submit\" value=\""._NUKECSUBMITCOMM."\" /></td></tr>"
                        ."</form>"
                        ."</table>";
        } else {
                echo "<center>"._NUKECCOMMENTNOTALLOWED."</center>";
        }
        CloseTable();
        }

        }
        } else {
        	echo "<center>"._NUKEC_ADS_NOT_ACTIVEYET."</center>";
        }
        CloseTable();
        include_once("footer.php");
}

function SubmitComment($xid_ads,$commentby,$commsubject,$commentdesc) {
        global $nukecprefix,$db,$module_name;
        if (($commsubject == "") || ($commentdesc == "")) {
                include_once("header.php");
                MenuNukeC(1);
                echo "<br />";
                OpenTable();
                echo "<center><font class=\"title\">"._NUKECPOSTCOMMENTERROR."</font>";

                echo "<br /><br />"._NUKECCOMMENTALERT;
                echo "<br /><br /><a href=\"javascript:history.go(-1);\">"._NUKECGOBACK."</a>";
                echo "</center>";
                CloseTable();
                include_once("footer.php");
        } else {
                global $REMOTE_ADDR;
                $commsubject = FixQuotes(filter_text($commsubject, "nohtml"));
                $commentdesc = FixQuotes(nl2br(filter_text($commentdesc)));
//original line above, ANH TRAN: $commentdesc = FixQuotes(nl2br(filter_text($commentdesc)));
                $sqlinsert = $db->sql_query("insert into ".$nukecprefix."_ads_comments values(NULL,'".$xid_ads."','".$commentby."','".$commsubject."','".$commentdesc."','".$REMOTE_ADDR."',NOW())");
                header("Location:modules.php?name=".$module_name."&op=ViewDetail&id_ads=$xid_ads");
        }
}

function ViewCatg() {
        global $UseImgCatg,$page,$id_catg,$days,$module_name,$nukecprefix,$db,$currentlang,$PerPage,$multilingual;
        include_once("header.php");
        MenuNukeC(1);
        echo "<br />";
        $NowUnixTime = GetUnixTimeNow();


        OpenTable();
        if (!isset($page) || ($page == "")) {
                $page = 1;
        }
        echo "<center>";
        if ($id_catg != "") {
                echo pathcatg(mysqli_real_escape_string($db, strip_tags($id_catg)));
                echo "<br />\n";
                $resultdesccatg = $db->sql_query("select catg_desc from ".$nukecprefix."_ads_catg where id_catg='".$id_catg."'");
                list ($catg_desc) = $db->sql_fetchrow($resultdesccatg);
                if ($catg_desc != "") {
                        echo $catg_desc;
                        echo "<br />";
                }
        } else {
                $id_catg = 0;
        }

        $resultsubcatg = $db->sql_query("select id_catg,catg,image from ".$nukecprefix."_ads_catg where parentid='".$id_catg."'");
        $jmlcatg =$db->sql_numrows($resultsubcatg);
        $i = 0;
        if ($jmlcatg > 0) {
        if (!$UseImgCatg) {
        echo "[ ";
        } else {
                echo "<table border=\"0\" cellspacing=\"3\" cellpadding=\"2\"><tr>\n";
        }
        while (list($id_catgsub,$catgsub,$imagecatg) = $db->sql_fetchrow($resultsubcatg)) {
                $i++;
                if ($UseImgCatg) {
                        if ($imagecatg == "") {
                                $imgcatgsrc = "noimage.gif";
                        } else {
                                $imgcatgsrc = $imagecatg;

                        }
                        if (!file_exists("modules/".$module_name."/imagecatg/".$imgcatgsrc)) {
                                $imgcatgsrc = "noimage.gif";
                        }
                        $imgdimension = @getimagesize("modules/".$module_name."/imagecatg/".$imgcatgsrc."");
                        if ($imgdimension) {
                                $imgcatgwidth = $imgdimension[0];
                                $imgcatgheight = $imgdimension[1];
                        }
                        if ($count == 8) {
                            echo "<tr>\n";
                            $count = 0;
                        }
                        echo "<td align=\"center\" valign=\"bottom\">\n"
                            ."<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catgsub."\">\n"
                                ."<img src=\"modules/".$module_name."/imagecatg/".$imgcatgsrc."\" width=\"".$imgcatgwidth."\" height=\"".$imgcatgheight."\" alt=\"".$catgsub."\" border=\"0\" /></a><br />\n"
                            ."<font class=\"content\"><strong>".$catgsub."</strong></font>\n"
                            ."</td>\n";
                        $count++;
                        if ($count == 8) {
                            echo "</tr>\n";
                        }
                } else {
                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg&amp;id_catg=".$id_catgsub."\"  class=\"redlink\"><strong>".$catgsub."</strong></a> ";
                        if ($i != $jmlcatg) {
                                echo " | ";
                        }
                }
        }
        if (!$UseImgCatg) {
                echo " ]";
        } else {
                if ($count == 8) {
                        echo "</table>\n";
            } else {
                        echo "</tr></table>\n";
            }
        }
        }
        echo "</center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        $headermsg = "<center><font class=\"title\">";
        $headermsg .= " "._NUKECADSINCATG." <strong>".getcategoryname($id_catg)."</strong>";
        $headermsg .= "</font></center><br />";
        echo $headermsg;
        $sqltotal = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,validuntil,hits from ".$nukecprefix."_ads_ads where";
        if ($id_catg != "") {
                $categorystring = getchildcategories($id_catg);
                $categoryarray = explode("_",$categorystring);
                if (sizeof($categoryarray) - 1 > 0) {
                        $sqltotal .= " (";
                }
                for ($i = 0;$i<=sizeof($categoryarray)-2;$i++) {
                        $sqltotal .= " id_catg = '".$categoryarray[$i]."' ";
                        if ($i != sizeof($categoryarray)-2) {
                                $sqltotal .= " or ";
                        }
                }
                if (sizeof($categoryarray) - 1 > 0) {
                        $sqltotal .= " or id_catg='".$id_catg."') and ";
                } else {
                        $sqltotal .= " id_catg='".$id_catg."' and ";
                }
        }

        $sqltotal .= " validuntil > '".$NowUnixTime."' and";

        $applylanguage = sqlapplylanguage();
        $sqltotal .= $applylanguage."and";

        $sqltotal .= " active = 1 order by dateposted DESC";

        $start = ($page-1)*$PerPage;
        $sqliklan = $sqltotal." limit ".$start.",".$PerPage;
        $resulttotaliklan = $db->sql_query($sqltotal);
        $totaliklan = $db->sql_numrows($resulttotaliklan);
        $jmlhalaman = ceil($totaliklan/$PerPage);
        $resultiklan = $db->sql_query($sqliklan);
        if ($jmlhalaman > 1) {
        echo "<center>[ ";
        if ($page > 1) {
                $previouspage =$page-1;

                echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                if ($id_catg != "") {
                        echo "&amp;id_catg=".$id_catg."";
                }
                if ($days != "") {
                        echo "&amp;days=".$days;
                }
                echo "&amp;page=".$previouspage."\"  class=\"redlink\">"._NUKECPREVIOUS."</a> | ";
        }
        for ($hlm = 1;$hlm <= $jmlhalaman;$hlm++) {
                if ($hlm == $page) {
                        echo "<strong>".$hlm."</strong>";
                } else {
                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                        if ($id_catg  != "") {
                                echo "&amp;id_catg=".$id_catg."";
                        }
                        if ($days != "") {
                                echo "&amp;days=".$days;
                        }
                        echo "&amp;page=".$hlm."\"  class=\"redlink\">".$hlm."</a> ";
                }
                if ($hlm != $jmlhalaman) {
                        echo " | ";
                }

        }
        if ($page+1 <= $jmlhalaman) {
                $nextpage = $page +1;
                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                if ($id_catg != "") {
                        echo "&amp;id_catg=".$id_catg."";
                }
                if ($days != "") {
                        echo "&amp;days=".$days;
                }
                echo "&amp;page=".$nextpage."\" class=\"redlink\">"._NUKECNEXT."</a>";

        }
        echo " ]<br />";

        }
       //echo "</center>"; //XHTML compliance Nuken
        $catgname = getcategoryname($id_catg);
        if ($totaliklan == 0) {
                echo "<center>"._NUKECNOADSIN." ";
                if ($id_catg != "") echo _NUKECINCATG." ".$catgname."</center>";
        } else {
                echo "<br />";
                $listchild = "";
                $listchild = getchildcategories($id_catg);
                $listchild = $id_catg."_".$listchild;
                $jmladsin = countads_incategory($listchild);
                $pre = (($page-1) * $PerPage) + 1;
                if ($pre < 0) {
                        $pre = 1;
                }
                $suf = ($pre-1) + $PerPage;
                if ($suf >= $totaliklan) {
                        $suf = $totaliklan;
                }
                echo _NUKECVIEWING." <strong>".$pre."</strong> - <strong>".$suf."</strong> (<strong>".$totaliklan."</strong> "._NUKECTOTAL.") "._NUKECADSINCATG." <strong>".$catgname."</strong><br /><br />";
                while (list($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xvaliduntil,$xhits) = $db->sql_fetchrow($resultiklan)) {
                        themeads ($xid_ads,$xid_catg,$xtitle,$xads_desc,$ximageads,$xcurr,$xprice,$xsubmitter,$xemail,$xwebsite,$xcity,$xstate,$xcountry,$xdateposted,$xhits);
                        echo "<br />";
                }
        }

        if ($jmlhalaman > 1) {
        echo "<center>[ ";
        if ($page > 1) {
                $previouspage =$page-1;

                echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                if ($id_catg != "") {
                        echo "&amp;id_catg=".$id_catg."";
                }
                if ($days != "") {
                        echo "&amp;days=".$days;
                }
                echo "&amp;page=".$previouspage."\">"._NUKECPREVIOUS."</a> | ";
        }
        for ($hlm = 1;$hlm <= $jmlhalaman;$hlm++) {
                if ($hlm == $page) {
                        echo "<strong>".$hlm."</strong>";
                } else {
                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                        if ($id_catg  != "") {
                                echo "&amp;id_catg=".$id_catg."";
                        }
                        if ($days != "") {
                                echo "&amp;days=".$days;
                        }
                        echo "&amp;page=".$hlm."\"  class=\"redlink\">".$hlm."</a> ";
                }
                if ($hlm != $jmlhalaman) {
                        echo " | ";
                }

        }
        if ($page+1 <= $jmlhalaman) {
                $nextpage = $page +1;
                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=ViewCatg";
                if ($id_catg != "") {
                        echo "&amp;id_catg=".$id_catg."";
                }
                if ($days != "") {
                        echo "&amp;days=".$days;
                }
                echo "&amp;page=".$nextpage."\"  class=\"redlink\">"._NUKECNEXT."</a>";
        }
        echo " ]<br />";
        }
     //   echo "</center>";
        CloseTable();
        include_once("footer.php");
}


function viewads($days) {
        global $page,$id_catg,$module_name,$nukecprefix,$db,$currentlang,$PerPage,$multilingual;
        include_once("header.php");
        MenuNukeC(1);
        echo "<br />";
           OpenTable();
        if ((!$days) or ($days == "")) {
                $days = 1;
        }

        $nowdate = date("Y-m-d");

        $datetemp = date("H i s m d Y");
        $datearray = explode(" ",$datetemp);
        $HourtoFormat = $datearray[0];
        $MinutetoFormat = $datearray[1];
        $SecondtoFormat = $datearray[2];
        $MonthtoFormat = $datearray[3];
        $DaytoFormat = $datearray[4] - $days ;
        $YeartoFormat = $datearray[5];

        $UnixTimeNow = GetUnixTimeNow();
        if ($days == 1) {
                $DaytoFormat = $datearray[4];
        }
        $StartTimeUnix = GetTimeUnix(0, 0, 0, $MonthtoFormat, $DaytoFormat, $YeartoFormat, 0, 0 , 0);
        $sql_result = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,hits from ".$nukecprefix."_ads_ads";
        $sql_result .= " where (dateposted > '".$StartTimeUnix."' and dateposted < '".$UnixTimeNow."') ";


        $applylanguage = sqlapplylanguage();

        $sql_result .= "and".$applylanguage;
        $sql_result .= "and active='1' order by dateposted DESC";

                 $resulttotalads = $db->sql_query($sql_result);

        $totalads = $db->sql_numrows($resulttotalads);
        if ($totalads > 0) {
                $pre = (($page-1) * $PerPage) + 1;
                if ($pre < 0) {
                        $pre = 1;
                }
                $suf = ($pre-1) + $PerPage;
                if ($suf >= $totalads) {
                        $suf = $totalads;
                }
                echo "<center>\n"
                        ."<strong>".$totalads."</strong> "._NUKECADSFOUND." ";
                if (($days == 1) || ($days == 2)) {
                        echo "For ";
                        if ($days == 1) {
                                echo _TODAY;
                        } else {
                                echo _YESTERDAY;
                        }
                } else {
                        echo _NUKECFORLAST." <strong>".$days."</strong> "._NUKECADSDAYS." <br />( "._NUKECFROM." <strong>".FormatDateAds($StartTimeUnix,0)."</strong> - <strong>".FormatDateAds($UnixTimeNow,0)."</strong> )";
                }
                echo "<br />"._NUKECVIEWING." <strong>".$pre."</strong> - <strong>".$suf."</strong> (<strong>".$totalads."</strong> "._NUKECTOTAL.")</center>";
                $totalpages = ceil($totalads/$PerPage);
                if (!$page) {
                        $page = 1;
                }
                $start = ($page - 1) * $PerPage;
                $sql_result .= " limit ".$start.",".$PerPage;

                if ($totalpages >= 2) {
                        echo "<br /><center>";
                        echo "[ ";
                        $back = $page - 1;
                        if ($back >= 1 ) {
                                echo "<a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$back."\" class=\"content\"><< "._NUKECPREVIOUS."</a>&nbsp;| ";
                        }
                        for ($i = 1;$i <= $totalpages;$i++) {
                                if ($page == $i) {
                                        echo "<strong>".$page."</strong>";
                                } else {
                                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$i."\" class=\"content\">".$i."</a>";
                                }
                                if ($i != $totalpages) {
                                echo " | ";
                                }
                        }
                        $next = $page + 1;
                        if ($next <= $totalpages) {
                                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$next."\" class=\"content\">"._NUKECNEXT." >></a>";
                        }
                        echo " ]";
                        echo "</center>";
                }
                echo "<br />";
                $j = 0;
                $resultads = $db->sql_query($sql_result);
                while (list($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits) = $db->sql_fetchrow($resultads)) {
                        themeads ($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits);
                        echo "<br />";

                }
                $db->sql_freeresult($resultads);
                if ($totalpages >= 2) {
                        echo "<center>";
                        echo "[ ";
                        $back2 = $page - 1;
                        if ($back2 >= 1 ) {
                                echo "<a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$back2."\" class=\"content\"><< "._NUKECPREVIOUS."</a>&nbsp;";
                        }
                        for ($i = 1;$i <= $totalpages;$i++) {
                                if ($page == $i) {
                                        echo "<strong>".$page."</strong>";
                                } else {
                                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$i."\" class=\"content\">$i</a>";
                                }
                                if ($i != $totalpages) {
                                echo " | ";
                                }
                        }
                        $next = $page + 1;
                        if ($next <= $totalpages) {
                                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=viewads&amp;days=".$days."&amp;page=".$next."\" class=\"content\">"._NUKECNEXT." >></a> ]";
                        }
                        echo "</center>";
                }
        } else {
                echo "<center><strong>"._NUKECNOADSFOUND."</strong></center>";
        }
        CloseTable();
        include_once("footer.php");
}

function MostPop() {
        global $PopAds,$HitsPopular,$page,$id_catg,$module_name,$nukecprefix,$dbi,$currentlang,$PerPage,$multilingual,$totalpages;
        include_once("header.php");
        MenuNukeC(1);
        echo "<br />";
           OpenTable();
        if (($PerPage * $page) > $PopAds) {
                echo "<center><img src=\"modules/".$module_name."/images/getout.gif\" width=\"27\" height=\"27\" alt=\"\" /><br />\n"
                        ."<strong>"._NUKECOPS."</strong></center>";
        } else {
        $nowdate = date("Y-m-d");
        $sql_result = "select id_ads,id_catg,title,ads_desc,imageads,curr,price,submitter,email,website,city,state,country,dateposted,hits from ".$nukecprefix."_ads_ads";
        $sql_result .= " where active = '1' ";

        $applylanguage = sqlapplylanguage();
        $sql_result .= "and".$applylanguage;
        $sql_result .= " order by hits DESC";
        $resulttotalads = $db->sql_query($sql_result);
        if (!$resulttotalads) {
                echo mysql_error();
        }
        $totalads = $db->sql_numrows($resulttotalads);
        if ($totalads > 0) {
                $pre = (($page-1) * $PerPage) + 1;
                if ($pre <= $totalads) {
                        $pre = $totalads;
                }
                $suf = ($pre-1) + $PerPage;
                if ($suf >= $totalads) {
                        $suf = $totalads;
                }

                echo "<center><strong>.:: ".$PopAds." "._NUKECMOSTPOPTITLE." ::.</strong></center><br />";
                if ($totalads > $PerPage) {
                        $totalpages = ceil($PopAds/$PerPage);
                } else {
                        $totalpage = 1;
                }
                if (!$page) {
                        $page = 1;
                }
                $start = ($page - 1) * $PerPage;

                $sql_result .= " limit ".$start.",".$PerPage;

                if ($totalpages >= 2) {
                        echo "<br /><center>";
                        echo "[ ";
                        $back = $page - 1;
                        if ($back >= 1 ) {
                                echo "<a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$back."\" class=\"content\"><< "._NUKECPREVIOUS."</a>&nbsp;| ";
                        }
                        for ($i = 1;$i <= $totalpages;$i++) {
                                if ($page == $i) {
                                        echo "<strong>".$page."</strong>";
                                } else {
                                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$i."\" class=\"content\">".$i."</a>";
                                }
                                if ($i != $totalpages) {
                                echo " | ";
                                }
                        }
                        $next = $page + 1;
                        if ($next <= $totalpages) {
                                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$next."\" class=\"content\">"._NUKECNEXT." >></a>";
                        }
                        echo " ]";
                        echo "</center>";
                }
                echo "<br />";
                $j = 0;
                $resultads = $db->sql_query($sql_result);
                while (list($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits) = $db->sql_fetchrow($resultads)) {
                        themeads ($id_ads,$id_catg,$title,$ads_desc,$imageads,$curr,$price,$submitter,$email,$website,$city,$state,$country,$dateposted,$hits);
                        echo "<br />";

                }
                $db->sql_freeresult($resultads);
                if ($totalpages >= 2) {
                        echo "<center>";
                        echo "[ ";
                        $back2 = $page - 1;
                        if ($back2 >= 1 ) {
                                echo "<a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$back2."\" class=\"content\"><< "._NUKECPREVIOUS."</a>&nbsp;";
                        }
                        for ($i = 1;$i <= $totalpages;$i++) {
                                if ($page == $i) {
                                        echo "<strong>".$page."</strong>";
                                } else {
                                        echo "<a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$i."\" class=\"content\">".$i."</a>";
                                }
                                if ($i != $totalpages) {
                                echo " | ";
                                }
                        }
                        $next = $page + 1;
                        if ($next <= $totalpages) {
                                echo " | <a href=\"modules.php?name=".$module_name."&amp;op=mostpop&amp;page=".$next."\" class=\"content\">"._NUKECNEXT." >></a> ]";
                        }
                        echo "</center>";
                }
        } else {
                echo "<center><strong>"._NUKECNOADSFOUND."</strong></center>";
        }
        }
        CloseTable();
        include_once("footer.php");
}

function Disclaimer($no) {
        global $nukecprefix,$db;
        include_once("header.php");
        MenuNukeC(1);
        echo "<br />";
    OpenTable();

        $re = $db->sql_query("select title,content from ".$nukecprefix."_ads_disclaimer where no='".$no."'");
        list($title,$content) = $db->sql_fetchrow($re);

        echo "\n"
                ."<font class=\"title\">".$title."</font><br /><br />"
                ."<font class=\"content \">".$content."</font>"
                ."<br /><br /><a href=\"javascript:history.go(-1);\">"._NUKECGOBACK."</a>"
                ."";

        CloseTable();
        include_once("footer.php");
}



switch($op) {
        case "mostpop":MostPop();break;
        case "viewads": viewads($days);break;
        case "ViewCatg":ViewCatg();break;
        case "SubmitComment":SubmitComment($xid_ads,$commentby,$commsubject,$commentdesc);break;
        case "ViewDetail": ViewDetail($id_ads);break;
        case "Disclaimer":Disclaimer($no);break;
        default : Index(); break;
}

?>