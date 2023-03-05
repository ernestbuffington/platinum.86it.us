<?php
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
if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}

global $admin_file;

if(empty($admin_file)){

  $admin_file="admin";

}

include_once('mainfile.php');

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = "- "._TUTMAINTUTMODULE."";

$tutconfigsql = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_config");

$tutconfig = $db->sql_fetchrow($tutconfigsql);

if($tutconfig['rightblocks'] == 1){

$index = 1;

}

include_once("modules/".$module_name."/include/menu.php");



function index(){

         global $db, $user, $admin, $prefix, $user_prefix, $module_name, $tutconfig;

         include_once('header.php');

         $main = 1;

         menu($main);

         echo "<br />";

         OpenTable();

         echo "<center><font class=\"title\"><strong>"._TUTMAINTUTORIALSMAINCAT."</strong></font></center><br />";

         echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";

         $sql = "SELECT tc_id, tc_title, tc_description FROM ".$prefix."_tutorials_categories WHERE parentid='0' ORDER BY tc_title";

         $result = $db->sql_query($sql);

         $count = 0;

         while ($row = $db->sql_fetchrow($result)) {

	       $tc_id = $row[tc_id];

	       $tc_title = $row[tc_title];

	       $tc_description = $row[tc_description];

	if ($tutconfig['show_links_num'] == 1) {

	    $cnumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id='$tc_id'"));

	    $cnumm = " ($cnumrows)";

	} else {

	    $cnumm = "";

	}

	       echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=$tc_id\">$tc_title</a>$cnumm</font>";

	       categorynewtutorialgraphic($tc_id);

               if ($tc_description) {

	          echo "<br /><font class=\"content\">$tc_description</font><br />";

	       } else {

	          echo "<br />";

	       }

	if ($count<1) {

	    echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";

	    $dum = 1;

	}

	$count++;

	if ($count==2) {

	    echo "</td></tr><tr>";

	    $count = 0;

	    $dum = 0;

	}

    }

    if ($dum == 1) {

	echo "</tr></table>";

    } elseif ($dum == 0) {

	echo "<td></td></tr></table>";

    }

    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials"));

    $catnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_categories"));

    echo "<center><font class=\"content\">"._TUTMAINTHEREARE." <strong>$numrows</strong> "._TUTMAINTUTORIALS." "._TUTMAINAND." <strong>$catnum</strong> "._TUTMAINTUTCATEGORIES." "._TUTMAININDB."</font></center>";

    CloseTable();

    include_once('footer.php');

}



function showtutorial($pid, $tpage=0) {

    global $prefix, $db, $sitename, $admin, $module_name, $locale, $user, $tutconfig, $user_prefix, $admin_file;

    include_once("include/bbstuff.php");

    include_once("header.php");

    $pid = intval($pid);

    $sql = "SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_id='$pid'";

    $result = $db->sql_query($sql);

    $mypage = $db->sql_fetchrow($result);

        if ($tpage < 1){

    	$db->sql_query("UPDATE ".$prefix."_tutorials_tutorials SET t_counter=t_counter+1 WHERE t_id='$pid'");

    	}

    menu(0, $mypage[t_title]);

    echo"<br />";

     OpenTable();

        echo"<table><tr><td width=\"80%\" valign=\"top\">";

        $tutorialsratingsummary = number_format($mypage[tutorialsratingsummary], $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($mypage[t_title]);

	$description = stripslashes($mypage[description]);

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $mypage[t_date], $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $mypage[version]<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$mypage[author_homepage]\">$mypage[author]</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels where sid='$mypage[level]'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $mypage[t_counter]<br />";

        if ($mypage[totalvotes] == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

        if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> $tutorialsratingsummary ($mypage[totalvotes] $votestring)<br />";

	}

	echo "</td><td width=\"20%\" valign=\"top\">";

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$mypage[t_id]\">"._TUTMAINFULLPROFILE."</a><br />";

        if (is_user($user)) {

	    echo "<a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$mypage[t_id]\">"._TUTMAINADDFAV."</a><br />";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$mypage[t_id]\">"._TUTMAINRATERESOURCE."</a><br />";

        /*if (is_user($user)) {

	    echo "<a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$mypage[t_id]\">"._TUTMAINMODIFYRESOURCE."</a><br />";

	} */

        if ($mypage[totalcomments] != 0) {

	    echo "<a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$mypage[t_id]\">"._TUTMAINVIEWCOMMENTS." ($mypage[totalcomments])</a><br />";

	}

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$mypage[t_id]\">"._TUTMAINMODIFYINADMIN."</a>";

	}

	echo "</td></tr></table>";

     CloseTable();

     echo "<br />";

     OpenTable();

	echo "<font class=\"title\">$mypage[t_title]</font><br /><br />";

        $mypage[t_text] = parse_bbcode($mypage[t_text], $mypage['bbcode_uid']);

	$contentpages = explode( "<!--pagebreak-->", $mypage[t_text] );

	$pageno = count($contentpages);

	if ( $tpage=="" || $tpage < 1 ){

	    $tpage = 1;

	}

	if ( $tpage > $pageno ){

	    $tpage = $pageno;

	}

	$arrayelement = (int)$tpage;

	$arrayelement --;

        $tutorialtext = parse_bbcode($contentpages[$arrayelement], $mypage['bbcode_uid']);

	echo "<p align=\"justify\">$tutorialtext</p>";

	if (($mypage['submitter'] != $mypage['author']) && ($mypage['submitter']!='')){

	$submitter1 = $mypage['submitter'];

    $usersql = $db->sql_query("SELECT user_website FROM ".$user_prefix."_users WHERE username='$submitter1'");

    $userweb = $db->sql_fetchrow($usersql);

    if(!empty($userweb['user_website']) && $userweb['user_website'] != 'http://'){

         $submitter = "<a href=\"".$userweb['user_website']."\">".$mypage['submitter']."</a>";

             }else{

         $submitter = $mypage['submitter'];

             }

	echo "<p align=\"right\"><i>"._TUTMAINSUBBY." ".$submitter."</i></p>";

        }

    if ($pageno > 1) {

        echo "<br /><br />";

      	echo ""._TUTMAINSELECTPAGE.": ";

     	if ($tpage>1) {

	    $previous_pagenumber = $tpage - 1;

    	    echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=showtutorial&pid=".$pid."&tpage=$previous_pagenumber\">";

    	    echo " &lt;&lt; "._TUTMAINPREVIOUS."</a> ]</strong>&nbsp;&nbsp;";

  	}

    	$counter = 1;

       	while ($counter<=$pageno ) {

      	    if ($counter == $tpage) {

		echo "<strong>$counter</strong>&nbsp";

	    } else {

                if ($tpage < $pageno){

	    $pagenumber = $counter;

	               }elseif($tpage>1){

	    $pagenumber = $counter;

	               }

		echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&pid=".$pid."&tpage=$pagenumber\">$counter</a> ";

	    }

       	    $counter++;

       	}

     	if ($tpage < $pageno) {

	    $next_pagenumber = $tpage + 1;

    		echo "&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=showtutorial&pid=".$pid."&tpage=$next_pagenumber\">";

    		echo " "._TUTMAINNEXT." &gt;&gt;</a> ]</strong> ";

     	}

    }

    CloseTable();

    include_once("footer.php");

}



function viewtutorial($tc_id, $min, $orderby, $show) {

    global $prefix, $db, $admin, $module_name, $user, $locale, $tutconfig, $admin_file;

    include_once("header.php");

    if (!isset($min)) $min=0;

    if (!isset($max)) $max=$min+$tutconfig['tutsperpage'];

    if(isset($orderby)) {

	$orderby = convertorderbyin($orderby);

    } else {

	$orderby = "t_date DESC";

    }

    if ($show!="") {

	$tutconfig['tutsperpage'] = $show;

    } else {

	$show=$tutconfig['tutsperpage'];

    }

    $caid = $tc_id;

    menu();

    echo "<br />";

    OpenTable();

    $result = $db->sql_query("SELECT tc_title, parentid FROM ".$prefix."_tutorials_categories WHERE tc_id='$tc_id'");

        list($tc_title, $parentid)= $db->sql_fetchrow($result);

	$title=getparentlink($parentid, $tc_title);

	$title="<a href=modules.php?name=$module_name>"._TUTMAINMAIN."</a>/".$title."";

    echo "<center><font class=\"option\"><strong>"._TUTMAINCATEGORY.": $title</strong></font></center><br />";

    echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";

    $result2 = $db->sql_query("SELECT tc_id, tc_title, tc_description FROM ".$prefix."_tutorials_categories WHERE parentid=$tc_id order by tc_title");

    $count = 0;

    while(list($cid2, $title2, $cdescription2) = $db->sql_fetchrow($result2)) {

        $cresult = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id=$cid2");

	if ($tutconfig['show_links_num'] == 1) {

        $cnumrows = "(".$db->sql_numrows($cresult).")";

        }else{

        $cnumrows = '';

        }

	echo "<td><font class=\"option\"><strong><big>·</big></strong> <a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=$cid2\">$title2</a> $cnumrows</font>";

	categorynewtutorialgraphic($cid2);

	if ($cdescription2) {

	    echo "<br /><font class=\"content\">$cdescription2</font><br />";

	} else {

	    echo "<br />";

	}

	$result3 = $db->sql_query("SELECT tc_id, tc_title FROM ".$prefix."_tutorials_categories WHERE parentid=$cid2 order by tc_title limit 0,3");

	$space = 0;

	while(list($cid3, $title3) = $db->sql_fetchrow($result3)) {

    	    if ($space>0) {

		echo ",&nbsp;";

	    }

            $cresult2 = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id=$cid3");

            $cnumrows2 = $db->sql_numrows($cresult2);

	    echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=$cid3\">$title3</a> ($cnumrows2)</font>";

	    $space++;

	}

	if ($count<1) {

	    echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";

	    $dum = 1;

	}

	$count++;

	if ($count==2) {

	    echo "</td></tr><tr>";

	    $count = 0;

	    $dum = 0;

	}

    }

    if ($dum == 1) {

	echo "</tr></table>";

    } elseif ($dum == 0) {

	echo "<td></td></tr></table>";

    }

    echo "<hr noshade size=\"1\">";

    $orderbyTrans = convertorderbytrans($orderby);

    echo "<center><font class=\"content\">"._TUTMAINSORTTUTORIALSBY.": "

        .""._TUTMAINTITLE." (<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=titleD\">D</a>) "

        .""._TUTMAINDATE." (<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=dateD\">D</a>) "

        .""._TUTMAINRATING." (<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=ratingD\">D</a>) "

        .""._TUTMAINPOPULARITY." (<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$tc_id."&amp;orderby=hitsD\">D</a>)"

	."<br /><strong>"._TUTMAINRESSORTED.": $orderbyTrans</strong></font></center><br /><br />";

    $result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id='$tc_id' order by $orderby limit $min,$tutconfig[tutsperpage]");

    $fullcountresult= $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id=$tc_id");

    $totalselectedtutorials = $db->sql_numrows($fullcountresult);

    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";

    $x=0;

    while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result)) {

        $tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$t_id\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";

	} else {

	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$t_id\">$t_title</a>";

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

	newtutorialgraphic($datetime, $t_date);

	popgraphic($hits);

	echo "<br />";

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $version<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$author_homepage\">$author</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $hits<br />";

        if ($totalvotes == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

        if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> $tutorialsratingsummary ($totalvotes $votestring)<br />";

	}

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$t_id\">"._TUTMAINFULLPROFILE."</a>";

        if (is_user($user)) {

        echo " | <a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$t_id\">"._TUTMAINADDFAV."</a>";

        }

        echo " | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$t_id\">"._TUTMAINRATERESOURCE."</a>";

        /*if (is_user($user)) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$t_id\">"._TUTMAINMODIFYRESOURCE."</a>";

	}*/

        if ($totalcomments != 0) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$t_id\">"._TUTMAINSCOMMENTS." ($totalcomments)</a>";

	}

	echo "<br /><br />";

	$x++;

    }

    echo "</font>";

    $orderby = convertorderbyout($orderby);

    $tutorialpagesint = ($totalselectedtutorials / $tutconfig['tutsperpage']);

    $tutorialpageremainder = ($totalselectedtutorials % $tutconfig['tutsperpage']);		

    if ($tutorialpageremainder != 0) {					 

    	$tutorialpages = ceil($tutorialpagesint);				

    	if ($totalselectedtutorials < $tutconfig['tutsperpage']) {

    		$tutorialpageremainder = 0;

    	}

    } else {

    	$tutorialpages = $tutorialpagesint;

    }

    if ($tutorialpages!=1 && $tutorialpages!=0) {

        echo "<br /><br />";

      	echo ""._TUTMAINSELECTPAGE.": ";

     	$prev=$min-$tutconfig['tutsperpage'];

     	if ($prev>=0) {

    	    echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$caid."&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">";

    	    echo " &lt;&lt; "._TUTMAINPREVIOUS."</a> ]</strong>&nbsp;&nbsp;";

  	}

    	$counter = 1;

 	$currentpage = ($max / $tutconfig['tutsperpage']);

       	while ($counter<=$tutorialpages ) {

      	    $cpage = $counter;

      	    $mintemp = ($tutconfig['tutsperpage'] * $counter) - $tutconfig['tutsperpage'];

      	    if ($counter == $currentpage) {

		echo "<strong>$counter</strong>&nbsp";

	    } else {

		echo "<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$caid."&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";

	    }

       	    $counter++;

       	}

     	$next=$min+$tutconfig['tutsperpage'];

     	if ($next<$tutorialpages) {

    		echo "&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=".$caid."&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";

    		echo " "._TUTMAINNEXT." &gt;&gt;</a> ]</strong> ";

     	}

    }

    echo "</td></tr></table>";

    CloseTable();

    include_once("footer.php");

}

function getparent($parentid,$tc_title) {

    global $prefix, $db;

    $sql = "SELECT tc_id, tc_title, parentid FROM ".$prefix."_tutorials_categories WHERE tc_id='$parentid'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $cid = $row[tc_id];

    $ptitle = $row[tc_title];

    $pparentid = $row[parentid];

    if ($ptitle!="") $tc_title=$ptitle."/".$tc_title;

    if ($pparentid!=0) {

	$tc_title=getparent($pparentid,$ptitle);

    }

    return $tc_title;

}



function getparentlink($parentid,$tc_title) {

    global $prefix, $db, $module_name;

    $sql = "SELECT tc_id, tc_title, parentid FROM ".$prefix."_tutorials_categories WHERE tc_id='$parentid'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $cid = $row[tc_id];

    $ptitle = $row[tc_title];

    $pparentid = $row[parentid];

    if ($ptitle!="") $tc_title="<a href=modules.php?name=$module_name&t_op=viewtutorial&tc_id=$cid>$ptitle</a>/".$tc_title;

    if ($pparentid!=0) {

    	$tc_title=getparentlink($pparentid,$ptitle);

    }

    return $tc_title;

}

function convertorderbyin($orderby) {

    if ($orderby == "titleA")	$orderby = "t_title ASC";

    if ($orderby == "dateA")	$orderby = "t_date ASC";

    if ($orderby == "hitsA")	$orderby = "t_counter ASC";

    if ($orderby == "ratingA")	$orderby = "tutorialsratingsummary ASC";

    if ($orderby == "titleD")	$orderby = "t_title DESC";

    if ($orderby == "dateD")	$orderby = "t_date DESC";

    if ($orderby == "hitsD")	$orderby = "t_counter DESC";

    if ($orderby == "ratingD")	$orderby = "tutorialsratingsummary DESC";

    return $orderby;

}



function convertorderbytrans($orderby) {

    if ($orderby == "t_counter ASC")			$orderbyTrans = ""._TUTMAINPOPULARITY1."";

    if ($orderby == "t_counter DESC")		        $orderbyTrans = ""._TUTMAINPOPULARITY2."";

    if ($orderby == "t_title ASC")		        $orderbyTrans = ""._TUTMAINTITLEAZ."";

    if ($orderby == "t_title DESC")		        $orderbyTrans = ""._TUTMAINTITLEZA."";

    if ($orderby == "t_date ASC")			$orderbyTrans = ""._TUTMAINDDATE1."";

    if ($orderby == "t_date DESC")		        $orderbyTrans = ""._TUTMAINDDATE2."";

    if ($orderby == "tutorialsratingsummary ASC")	$orderbyTrans = ""._TUTMAINRATING1."";

    if ($orderby == "tutorialsratingsummary DESC")	$orderbyTrans = ""._TUTMAINRATING2."";

    return $orderbyTrans;

}



function convertorderbyout($orderby) {

    if ($orderby == "t_title ASC")		        $orderby = "titleA";

    if ($orderby == "t_date ASC")			$orderby = "dateA";

    if ($orderby == "t_counter ASC")			$orderby = "hitsA";

    if ($orderby == "tutorialsratingsummary ASC")	$orderby = "ratingA";

    if ($orderby == "t_title DESC")		        $orderby = "titleD";

    if ($orderby == "t_date DESC")		        $orderby = "dateD";

    if ($orderby == "t_counter DESC")		        $orderby = "hitsD";

    if ($orderby == "tutorialsratingsummary DESC")	$orderby = "ratingD";

    return $orderby;

}

function ratetutorial($lid, $user) {

    global $prefix, $db, $cookie, $datetime, $module_name;

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    $lid = intval($lid);

    $sql = "SELECT t_title FROM ".$prefix."_tutorials_tutorials WHERE t_id='$lid'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $displaytitle = $row[t_title];

    $ip = $_SERVER["REMOTE_HOST"];

    if (empty($ip)) {

       $ip = $_SERVER["REMOTE_ADDR"];

    }

    echo "<strong>$displaytitle</strong>"

	."<ul><font class=\"content\">"

	."<li>"._TUTMAINRATENOTE1.""

	."<li>"._TUTMAINRATENOTE2.""

	."<li>"._TUTMAINRATENOTE3.""

	."<li>"._TUTMAINDRATENOTE4.""

	."<li>"._TUTMAINRATENOTE5."";

    if(is_user($user)) {

    	$user2 = base64_decode($user);

   	$cookie = explode(":", $user2);

	echo "<li>"._TUTMAINYOUAREREGGED.""

	    ."<li>"._TUTMAINFEELFREE2ADD."";

	cookiedecode($user);

	$auth_name = $cookie[1];

    } else {

	echo "<li>"._TUTMAINYOUARENOTREGGED.""

	    ."<li>"._TUTMAINIFYOUWEREREG."";

	$auth_name = "Anonymous";

    }

    echo "</ul>"

    	."<form method=\"post\" action=\"modules.php?name=$module_name\">"

        ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">"

        ."<tr><td width=\"25\" nowrap></td>"

        ."<tr><td width=\"25\" nowrap></td><td width=\"550\">"

        ."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"

        ."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"

        ."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">"

        ."<input type=\"hidden\"  name=\"t_op\" value=\"addrating\">"

        ."<font class=content>"._TUTMAINRATERESOURCE.""

        ."<select name=\"rating\">"

        ."<option>--</option>"

        ."<option>10</option>"

        ."<option>9</option>"

	."<option>8</option>"

        ."<option>7</option>"

        ."<option>6</option>"

        ."<option>5</option>"

        ."<option>4</option>"

        ."<option>3</option>"

        ."<option>2</option>"

        ."<option>1</option>"

        ."</select></font>"

	."<font class=\"content\"><input type=\"submit\" value=\""._TUTMAINRATERESOURCE."\"></font>"

        ."<br /><br />";

    if(is_user($user)) {

	echo "<strong>"._TUTMAINSCOMMENTS.":</strong><br /><textarea wrap=\"virtual\" cols=\"50\" rows=\"10\" name=\"ratingcomments\"></textarea>"

 	    ."<br /><br /><br />"

     	    ."</font></td>";

    } else {

	echo"<input type=\"hidden\" name=\"ratingcomments\" value=\"\">";

    }

    echo "</tr></table></form>";

    CloseTable();

    include_once("footer.php");

}

function tutorialfooter($lid) {

    global $module_name;

    echo "<font class=\"content\">[ <a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$lid\">"._TUTMAINVIEWTUTORIAL."</a> | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$lid\">"._TUTMAINRATERESOURCE."</a> ]</font><br /><br />";

}

function completevoteheader(){

    menu();

    echo "<br />";

    OpenTable();

}



function completevotefooter($lid, $ratinguser) {

    global $prefix, $db, $module_name, $sitename;

    echo "<font class=\"content\">"._TUTMAINTHANKSTOTAKETIME." $sitename. "._TUTMAINDLETSDECIDE."</font><br /><br /><br />";

    echo "<center>";

    tutorialinfomenu($lid);

    echo "</center>";

    CloseTable();

}

function tutorialinfomenu($lid) {

    global $module_name, $user;

    echo "<br /><font class=\"content\">[ "

	."<a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$lid\">"._TUTMAINTUTORIALCOMMENTS."</a>"

	." | <a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$lid\">"._TUTMAINVIEWTUTORIAL."</a>";

        /*if (is_user($user)){

	echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$lid\">"._TUTMAINMODIFYRESOURCE."</a>";

        }*/

    echo " ]</font>";

}

function completevote($error) {

    global $module_name, $tutconfig;

    if ($error == "none") echo "<center><font class=\"content\"><strong>"._TUTMAINCOMPLETEVOTE1."</strong></font></center>";

    if ($error == "anonflood") echo "<center><font class=\"option\"><strong>"._TUTMAINCOMPLETEVOTE2."</strong></font></center><br />";

    if ($error == "regflood") echo "<center><font class=\"option\"><strong>"._TUTMAINCOMPLETEVOTE3."</strong></font></center><br />";

    if ($error == "postervote") echo "<center><font class=\"option\"><strong>"._TUTMAINCOMPLETEVOTE4."</strong></font></center><br />";

    if ($error == "nullerror") echo "<center><font class=\"option\"><strong>"._TUTMAINCOMPLETEVOTE5."</strong></font></center><br />";

}

function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) {

    global $prefix, $db, $cookie, $user, $module_name, $anonymous, $tutconfig;

    $passtest = "yes";

    include_once("header.php");

    menu();

    OpenTable();

    if(is_user($user)) {

	$user2 = base64_decode($user);

   	$cookie = explode(":", $user2);

	cookiedecode($user);

	$ratinguser = $cookie[1];

    } else {

	$ratinguser = "Anonymous";

    }

    $results3 = $db->sql_query("SELECT t_title FROM ".$prefix."_tutorials_tutorials WHERE t_id=$ratinglid");

    while(list($title)=$db->sql_fetchrow($results3)) $ttitle = $title;

    /* Make sure only 1 anonymous from an IP in a single day. */

    $ip = $_SERVER["REMOTE_HOST"];

    if (empty($ip)) {

       $ip = $_SERVER["REMOTE_ADDR"];

    }

    /* Check if Rating is Null */

    if ($rating=="--") {

	$error = "nullerror";

        completevote($error);

	$passtest = "no";

    }

    /* Check if tutorial POSTER is voting (UNLESS Anonymous users allowed to post) */

    if ($ratinguser != "Anonymous") {

    	$result=$db->sql_query("SELECT author FROM ".$prefix."_tutorials_tutorials WHERE t_id=$ratinglid");

    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {

    	    if ($ratinguserDB==$ratinguser) {

    		$error = "postervote";

    	        completevote($error);

		$passtest = "no";

    	    }

   	}

    }

    /* Check if REG user is trying to vote twice. */

    if ($ratinguser!="Anonymous") {

    	$result=$db->sql_query("SELECT ratinguser FROM ".$prefix."_tutorials_votedata WHERE ratinglid=$ratinglid");

    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {

    	    if ($ratinguserDB==$ratinguser) {

    	        $error = "regflood";

                completevote($error);

		$passtest = "no";

	    }

        }

    }

    /* Check if ANONYMOUS user is trying to vote more than once per day. */

    if ($ratinguser=="Anonymous"){

    	$yesterdaytimestamp = (time()-(86400 * $tutconfig['anonwaitdays']));

    	$ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);

    	$result=$db->sql_query("SELECT * FROM ".$prefix."_tutorials_votedata WHERE ratinglid=$ratinglid AND ratinguser='Anonymous' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < $tutconfig[anonwaitdays]");

        $anonvotecount = $db->sql_numrows($result);

    	if ($anonvotecount >= 1) {

    	    $error = "anonflood";

            completevote($error);

    	    $passtest = "no";

    	}

    }

    /* Passed Tests */

    if ($passtest == "yes") {

    	$comment = stripslashes(FixQuotes($comment));

    	/* All is well.  Add to Line Item Rate to DB. */

	 $db->sql_query("INSERT into ".$prefix."_tutorials_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip', '$ratingcomments', now())");

	/* All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB. */

	/* NOTE: If weight is modified, ALL tutorials need to be refreshed with new weight. */

	/*	 Running a SQL statement with your modded calc for ALL tutorials will accomplish this. */

        $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_tutorials_votedata WHERE ratinglid = $ratinglid");

	$totalvotesDB = $db->sql_numrows($voteresult);

	include_once("include/voteinclude.php");

        $db->sql_query("UPDATE ".$prefix."_tutorials_tutorials SET tutorialsratingsummary=$finalrating,totalvotes=$totalvotesDB,totalcomments=$truecomments WHERE t_id = $ratinglid");

        $error = "none";

        completevote($error);

    }

    completevotefooter($ratinglid, $ratinguser);

    include_once("footer.php");

}

function viewtutorialcomments($lid) {

    global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file;

    include_once("header.php");

    $lid = intval($lid);

    $sql = "SELECT t_title FROM ".$prefix."_tutorials_tutorials WHERE t_id='$lid'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $displaytitle = $row[t_title];

    menu();

    echo "<br />";

    $result=$db->sql_query("SELECT ratinguser, rating, ratingcomments, ratingtimestamp FROM ".$prefix."_tutorials_votedata WHERE ratinglid = $lid AND ratingcomments != '' ORDER BY ratingtimestamp DESC");

    $totalcomments = $db->sql_numrows($result);

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINTUTORIALPROFILE.": $displaytitle</strong></font><br /><br />";

    tutorialinfomenu($lid); 

    echo "<br /><br /><br />"._TUTMAINTOTALOF." $totalcomments "._TUTMAINSCOMMENTS."</font></center><br />"

	."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"450\">";

    $x=0;

    while(list($ratinguser, $rating, $ratingcomments, $ratingtimestamp)=$db->sql_fetchrow($result)) {

    	$ratingcomments = stripslashes($ratingcomments);

    	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);

	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));

	$date_array = explode("-", $ratingtime); 

	$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]); 

        $formatted_date = date("F j, Y", $timestamp); 

	/* Individual user information */

	$result2=$db->sql_query("SELECT rating FROM ".$prefix."_tutorials_votedata WHERE ratinguser = '$ratinguser'");

        $usertotalcomments = $db->sql_numrows($result2);

        $useravgrating = 0;

        while(list($rating2)=$db->sql_fetchrow($result2))	$useravgrating = $useravgrating + $rating2;

        $useravgrating = $useravgrating / $usertotalcomments;

        $useravgrating = number_format($useravgrating, 1);

    	echo "<tr><td bgcolor=\"$bgcolor2\">"

    	    ."<font class=\"content\"><strong> "._TUTMAINUSER.": </strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$ratinguser\">$ratinguser</a></font>"

	    ."</td>"

	    ."<td bgcolor=\"$bgcolor2\">"

	    ."<font class=\"content\"><strong>"._TUTMAINRATING.": </strong>$rating</font>"

	    ."</td>"

	    ."<td bgcolor=\"$bgcolor2\" align=\"right\">"

    	    ."<font class=\"content\">$formatted_date</font>"

	    ."</td>"

	    ."</tr>"

	    ."<tr>"

	    ."<td valign=\"top\">"

	    ."<font class=\"tiny\">"._TUTMAINUSERAVGRATING.": $useravgrating</font>"

	    ."</td>"

	    ."<td valign=\"top\" colspan=\"2\">"

	    ."<font class=\"tiny\">"._TUTMAINNUMRATINGS.": $usertotalcomments</font>"

	    ."</td>"

	    ."</tr>"

    	    ."<tr>"

	    ."<td colspan=\"3\">"

	    ."<font class=\"content\">";

	    if (is_admin($admin)) {

		echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$lid\"><img src=\"modules/$module_name/images/editicon.gif\" border=\"0\" alt=\""._EDITTHISTUTORIAL."\"></a>";

	    }	

	echo " $ratingcomments</font>"

	    ."<br /><br /><br /></td></tr>";        

	$x++;

    }

    echo "</table><br /><br /><center>";

    tutorialfooter($lid);

    echo "</center>";

    CloseTable();

    include_once("footer.php");

}

function PopularTutorials($ratenum, $ratetype) {

    global $prefix, $db, $admin, $module_name, $user, $locale, $tutconfig, $admin_file;

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    $mostpoptutorialspercentrigger = 0; 

    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";

    if ($ratenum != "" && $ratetype != "") {

    	$tutconfig['mostpoptutorials'] = $ratenum;

    	if ($ratetype == "percent") $mostpoptutorialspercentrigger = 1;

    }

    if ($mostpoptutorialspercentrigger == 1) {

    	$toptutorialspercent = $tutconfig['mostpoptutorials'];

    	$result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials");

    	$totalmostpoptutorials = $db->sql_numrows($result);

    	$tutconfig['mostpoptutorials'] = $tutconfig['mostpoptutorials'] / 100;

    	$tutconfig['mostpoptutorials'] = $totalmostpoptutorials * $tutconfig['mostpoptutorials'];

    	$tutconfig['mostpoptutorials'] = round($tutconfig['mostpoptutorials']);

    }

    if ($mostpoptutorialspercentrigger == 1) {

	echo "<center><font class=\"option\"><strong>"._TUTMAINMOSTPOPULAR." $toptutorialspercent% ("._TUTMAINOFALL." $totalmostpoptutorials "._TUTORIALS.")</strong></font></center>";

    } else {

	echo "<center><font class=\"option\"><strong>"._TUTMAINMOSTPOPULAR." ".$tutconfig['mostpoptutorials']."</strong></font></center>";

    }

    echo "<tr><td><center>"._TUTMAINSHOWTOP.": [ <a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=10&amp;ratetype=num\">10</a> - "

	."<a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=25&amp;ratetype=num\">25</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=50&amp;ratetype=num\">50</a> | "

    	."<a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=PopularTutorials&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br /><br /></td></tr>";

    $result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials order by t_counter DESC limit 0,$tutconfig[mostpoptutorials]");

    echo "<tr><td>";

    while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result)) {

	$tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$t_id\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";

	} else {

	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$t_id\">$t_title</a>";

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

	newtutorialgraphic($datetime, $t_date);

	popgraphic($hits);

	echo "<br />";

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $version<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$author_homepage\">$author</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $hits<br />";

	/* voting & comments stats */

        if ($totalvotes == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

	if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> $tutorialsratingsummary ($totalvotes $votestring)<br />";

	}

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$t_id\">"._TUTMAINFULLPROFILE."</a>";

        if (is_user($user)) {

        echo " | <a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$t_id\">"._TUTMAINADDFAV."</a>";

        }

        echo" | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$t_id\">"._TUTMAINRATERESOURCE."</a>";

        /*if (is_user($user)) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$t_id\">"._TUTMAINMODIFYRESOURCE."</a>";

	}*/

	if ($totalcomments != 0) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$t_id\">"._TUTMAINSCOMMENTS." ($totalcomments)</a>";

	}

	echo "<br />";

	$result2 = $db->sql_query("SELECT tc_title, parentid FROM ".$prefix."_tutorials_categories WHERE tc_id=$tc_id");

	list($ctitle, $parentid) = $db->sql_fetchrow($result2);

	if ($parentid>0) $ctitle = getparentlink($tc_id,$ctitle);

	echo ""._TUTMAINCATEGORY.": $ctitle";

	echo "<br /><br />";

    }

    echo "</td></tr></table>";

    CloseTable();

    include_once("footer.php");

}

function popgraphic($hits) {

    global $module_name, $tutconfig;

    if ($hits>=$tutconfig['hitsforpopular']) {

	echo "&nbsp;<img src=\"modules/$module_name/images/popular.gif\" alt=\""._TUTMAINPOPULAR."\">";

    }

}

function newtutorialgraphic($datetime, $time) {

    global $module_name, $locale;

    echo "&nbsp;";

    $startdate = time();

    $count = 0;

    while ($count <= 6) {

	$daysold = date("d F Y", $startdate);

        if ($daysold == $datetime) {

    	    if ($count<1) {

		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._TUTMAINNEWTODAY."\">";

	    }

            if ($count<3 && $count>=1) {

		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._TUTMAINNEWLAST3DAYS."\">";

	    }

            if ($count<=6 && $count>=3) {

		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._TUTMAINNEWTHISWEEK."\">";

	    }

	}

        $count++;

        $startdate = (time()-(86400 * $count));

    }

}



function categorynewtutorialgraphic($cat) {

    global $prefix, $db, $module_name, $locale;

    $newresult = $db->sql_query("SELECT t_date FROM ".$prefix."_tutorials_tutorials WHERE tc_id=$cat order by t_date desc limit 1");

    list($time)= $db->sql_fetchrow($newresult);

    echo "&nbsp;";

    setlocale (LC_TIME, $locale);

    preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

    $startdate = time();

    $count = 0;

    while ($count <= 7) {

	$daysold = date("d F Y", $startdate);

        if ($daysold == $datetime) {

    	    if ($count<1) {

		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._TUTMAINCATNEWTODAY."\">";

	    }

            if ($count<3 && $count>=1) {

		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._TUTMAINCATLAST3DAYS."\">";

	    }

            if ($count<=7 && $count>=3) {

		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._TUTMAINCATTHISWEEK."\">";

	    }

	}

        $count++;

        $startdate = (time()-(86400 * $count));

    }

}

function TopTutorials($ratenum, $ratetype) {

    global $prefix, $db, $admin, $module_name, $user, $locale, $tutconfig, $admin_file;

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    $toptutorialspercentrigger = 0;

    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";

    if ($ratenum != "" && $ratetype != "") {

    	$tutconfig['toptutorials'] = $ratenum;

    	if ($ratetype == "percent") {

	    $toptutorialspercentrigger = 1;

	}

    }

    if ($toptutorialspercentrigger == 1) {

    	$toptutorialspercent = $tutconfig['toptutorials'];

    	$totalratedtutorials = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tutorialsratingsummary != 0"));

    	$tutconfig['toptutorials'] = $tutconfig['toptutorials'] / 100;

    	$tutconfig['toptutorials'] = $totalratedtutorials * $tutconfig['toptutorials'];

    	$tutconfig['toptutorials'] = round($tutconfig['toptutorials']);

    }

    if ($toptutorialspercentrigger == 1) {

	echo "<center><font class=\"option\"><strong>"._TUTMAINBESTRATED." $toptutorialspercent% ("._TUTMAINOF." $totalratedtutorials "._TUTMAINRATEDTUTORIALS.")</strong></font></center><br />";

    } else {

	echo "<center><font class=\"option\"><strong>"._TUTMAINBESTRATED." ".$tutconfig['toptutorials']." </strong></font></center><br />";

    }

    echo "</td></tr>"

	."<tr><td><center>"._TUTMAINNOTE." ".$tutconfig['tutorialvotemin']." "._TUTMAINVOTESREQ."<br />"

	.""._TUTMAINSHOWTOP.":  [ <a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=10&amp;ratetype=num\">10</a> - "

	."<a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=25&amp;ratetype=num\">25</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=50&amp;ratetype=num\">50</a> | "

    	."<a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "

    	."<a href=\"modules.php?name=$module_name&t_op=TopTutorials&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br /><br /></td></tr>";

    $result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tutorialsratingsummary != 0 AND totalvotes >= $tutconfig[tutorialvotemin] ORDER BY tutorialsratingsummary DESC LIMIT 0,$tutconfig[toptutorials]");

    echo "<tr><td>";

    while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result)) {

	$tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$t_id\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";

	} else {

	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$t_id\">$t_title</a>";

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

        newtutorialgraphic($datetime, $t_date);

	popgraphic($hits);

	echo "<br />";

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $version<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$author_homepage\">$author</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $hits<br />";

	/* voting & comments stats */

        if ($totalvotes == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

	if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> <strong>$tutorialsratingsummary</strong> ($totalvotes $votestring)<br />";

	}

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$t_id\">"._TUTMAINFULLPROFILE."</a>";

        if (is_user($user)) {

        echo " | <a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$t_id\">"._TUTMAINADDFAV."</a>";

        }

        echo" | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$t_id\">"._TUTMAINRATERESOURCE."</a>";

        /*if (is_user($user)) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$t_id\">"._TUTMAINMODIFYRESOURCE."</a>";

	}*/

	if ($totalcomments != 0) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$t_id\">"._TUTMAINSCOMMENTS." ($totalcomments)</a>";

	}

	echo "<br />";

	$result2 = $db->sql_query("SELECT tc_title FROM ".$prefix."_tutorials_categories WHERE tc_id=$tc_id");

	list($ctitle, $parentid) = $db->sql_fetchrow($result2);

	if ($parentid>0) $ctitle = getparentlink($tc_id,$ctitle);

	echo ""._TUTMAINCATEGORY.": $ctitle";

	echo "<br /><br />";

    }

    echo "</font></td></tr></table>";

    CloseTable();

    include_once("footer.php");

}

function NewTutorials($newtutorialshowdays) {

    global $prefix, $db, $module_name;

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINNEWTUTORIALS."</strong></font></center><br />";

    $counter = 0;

    $allweektutorials = 0;

    while ($counter <= 7-1){

	$newtutorialdayRaw = (time()-(86400 * $counter));

	$newtutorialday = date("d-M-Y", $newtutorialdayRaw);

	$newtutorialView = date("F d, Y", $newtutorialdayRaw);

	$newtutorialDB = Date("Y-m-d", $newtutorialdayRaw);

	$totaltutorials = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_date LIKE '%$newtutorialDB%'"));

	$counter++;

	$allweektutorials = $allweektutorials + $totaltutorials;

    }

    $counter = 0;

    while ($counter <=30-1){

        $newtutorialdayRaw = (time()-(86400 * $counter));

        $newtutorialDB = Date("Y-m-d", $newtutorialdayRaw);

        $totaltutorials = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_date LIKE '%$newtutorialDB%'"));

        $allmonthtutorials = $allmonthtutorials + $totaltutorials;

        $counter++;

    }

    echo "<center><strong>"._TUTMAINTOTALNEWTUTORIALS.":</strong> "._TUTMAINLASTWEEK." - $allweektutorials \ "._TUTMAINLAST30DAYS." - $allmonthtutorials<br />"

	.""._TUTMAINSHOW.": <a href=\"modules.php?name=$module_name&t_op=NewTutorials&amp;newtutorialshowdays=7\">"._TUTMAIN1WEEK."</a> - <a href=\"modules.php?name=$module_name&t_op=NewTutorials&amp;newtutorialshowdays=14\">"._TUTMAIN2WEEKS."</a> - <a href=\"modules.php?name=$module_name&t_op=NewTutorials&amp;newtutorialshowdays=30\">"._TUTMAIN30DAYS."</a>"

	."</center><br />";

    /* List Last VARIABLE Days of tutorials */

    if (!isset($newtutorialshowdays)) {

	$newtutorialshowdays = 7;

    }

    echo "<br /><center><strong>"._TUTMAINTOTALFORLAST." $newtutorialshowdays "._TUTMAINDAYS.":</strong><br /><br />";

    $counter = 0;

    $allweektutorials = 0;

    while ($counter <= $newtutorialshowdays-1) {

	$newtutorialdayRaw = (time()-(86400 * $counter));

	$newtutorialday = date("d-M-Y", $newtutorialdayRaw);

	$newtutorialView = date("F d, Y", $newtutorialdayRaw);

	$newtutorialDB = Date("Y-m-d", $newtutorialdayRaw);

	$totaltutorials = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_date LIKE '%$newtutorialDB%'"));

	$counter++;

	$allweektutorials = $allweektutorials + $totaltutorials;

	echo "<strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&t_op=NewTutorialsDate&amp;selectdate=$newtutorialdayRaw\">$newtutorialView</a>&nbsp($totaltutorials)<br />";

    }

    $counter = 0;

    $allmonthtutorials = 0;

    echo "</center>";

    CloseTable();

    include_once("footer.php");

}



function NewTutorialsDate($selectdate) {

    global $prefix, $db, $module_name, $admin, $user, $locale, $tutconfig, $admin_file;

    $dateDB = (date("d-M-Y", $selectdate));

    $dateView = (date("F d, Y", $selectdate));

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    $newtutorialDB = Date("Y-m-d", $selectdate);

    $totaltutorials = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_date LIKE '%$newtutorialDB%'"));

    echo "<font class=\"option\"><strong>$dateView - $totaltutorials "._TUTMAINNEWTUTORIALS."</strong></font>"

	."<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";

    $result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_date LIKE '%$newtutorialDB%' ORDER BY t_title ASC");

    while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result)) {

	$tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$t_id\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";

	} else {

	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$t_id\">$t_title</a>";

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

	newtutorialgraphic($datetime, $t_date);

	popgraphic($hits);

	echo "<br />";

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $version<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$author_homepage\">$author</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $hits<br />";

	/* voting & comments stats */

        if ($totalvotes == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

	if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> $tutorialsratingsummary ($totalvotes $votestring)<br />";

	}

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$t_id\">"._TUTMAINFULLPROFILE."</a>";

        if (is_user($user)) {

        echo " | <a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$t_id\">"._TUTMAINADDFAV."</a>";

        }

        echo" | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$t_id\">"._TUTMAINRATERESOURCE."</a>";

        /*if (is_user($user)) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$t_id\">"._TUTMAINMODIFYRESOURCE."</a>";

	}*/

	if ($totalcomments != 0) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$t_id\">"._TUTMAINSCOMMENTS." ($totalcomments)</a>";

	}

	echo "<br />";

		$result3 = $db->sql_query("SELECT tc_id,tc_title,parentid FROM ".$prefix."_tutorials_categories WHERE tc_id=$tc_id");

		list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);

		if ($parentid3>0) $title3 = getparentlink($parentid3,$title3);

		echo ""._TUTMAINCATEGORY.": $title3<br /><br />";

    }

    echo "</font></td></tr></table>";

    CloseTable();

    include_once("footer.php");

}

function search($query, $min, $orderby, $show) {

    global $prefix, $db, $admin, $bgcolor2, $module_name, $locale, $user, $tutconfig, $admin_file;

    include_once("header.php");

    if (!isset($min)) $min=0;

    if (!isset($max)) $max=$min+$tutconfig['searchtutorials'];

    if(isset($orderby)) {

	$orderby = convertorderbyin($orderby);

    } else {

	$orderby = "t_date DESC";

    }

    if ($show!="") {

	$tutconfig['searchtutorials'] = $show;

    } else {

	$show=$tutconfig['searchtutorials'];

    }

    $query = check_html($query, nohtml);

    $query = addslashes($query);

    $result= $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_title LIKE '%$query%' OR t_text LIKE '%$query%' OR description LIKE '%$query%' ORDER BY $orderby limit $min,$tutconfig[searchtutorials]");

    $fullcountresult= $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_title LIKE '%$query%' OR t_text LIKE '%$query%' OR description LIKE '%$query%'");

    $totalselectedtutorials = $db->sql_numrows($fullcountresult);

    $nrows = $db->sql_numrows($result);

    $x=0;

    $the_query = stripslashes($query);

    $the_query = str_replace("\'", "'", $the_query);

    menu();

    echo "<br />";

    OpenTable();

    if ($query != "") {

    	if ($nrows>0) {

	    echo "<font class=\"option\">"._TUTMAINSEARCHRESULTS4.": <strong>$the_query</strong></font><br /><br />"

	        ."<table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><strong>"._TUTMAINUSUBCATEGORIES."</strong></font></td></tr></table>";

            $result2= $db->sql_query("SELECT tc_id, tc_title FROM ".$prefix."_tutorials_categories WHERE tc_title LIKE '%$query%' ORDER BY tc_title DESC");

            while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {

	        $res = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE tc_id=$cid");

	        $numrows = $db->sql_numrows($res);

    	        $result3 = $db->sql_query("SELECT tc_id,tc_title,parentid FROM ".$prefix."_tutorials_categories WHERE tc_id=$cid");

    	        list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);

    	        if ($parentid3>0) $title4 = getparentlink($parentid3,$title27);

    	        $title3 = str_replace ($query, "<strong>$query</strong>", $title3);

                if ($parentid3>0){

    	        echo "<strong><big>·</big></strong>&nbsp;$title4<a href=\"modules.php?name=$module_name&t_op=viewtutorial&amp;tc_id=$cid\">$title3</a> ($numrows)<br />";

                }else{

                echo "<strong><big>·</big></strong>&nbsp;$title4 ($numrows)<br />";

                }

                }

	    echo "<br /><table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><strong>"._TUTMAINTUTORIALS."</strong></font></td></tr></table>";

    	    $orderbyTrans = convertorderbytrans($orderby);

    	    echo "<center><font class=\"content\">"._TUTMAINSORTTUTORIALSBY.": "

    		.""._TUTMAINTITLE." (<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=titleD\">D</a>) "

    		.""._TUTMAINDATE." (<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=dateD\">D</a>) "

    		.""._TUTMAINRATING." (<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=ratingD\">D</a>) "

    		.""._TUTMAINPOPULARITY." (<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;orderby=hitsD\">D</a>)"

    		."<br />"._TUTMAINRESSORTED.": $orderbyTrans</center><br /><br /><br />";

    $result= $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_title LIKE '%$query%' OR t_text LIKE '%$query%' OR description LIKE '%$query%' ORDER BY $orderby limit $min,$tutconfig[searchtutorials]");

    $fullcountresult= $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_title LIKE '%$query%' OR t_text LIKE '%$query%' OR description LIKE '%$query%'");

    $totalselectedtutorials = $db->sql_numrows($fullcountresult);

            while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result)) {

        $tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	if (is_admin($admin)) {

	    echo "<a href=\"".$admin_file.".php?op=modtutorial&t_id=$t_id\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";

	} else {

	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";

	}

        echo "<a href=\"modules.php?name=$module_name&t_op=showtutorial&amp;pid=$t_id\">$t_title</a>";

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

	newtutorialgraphic($datetime, $t_date);

	popgraphic($hits);

	echo "<br />";

	echo "<strong>"._TUTMAINDESCRIPTION.":</strong> $description<br />";

	echo "<strong>"._TUTMAINVERSION.":</strong> $version<br />";

	echo "<strong>"._TUTMAINADDEDON.":</strong> $datetime<br />";

	echo "<strong>"._TUTMAINAUTHOR.":</strong> <a href=\"$author_homepage\">$author</a><br />";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

	echo "<strong>"._TUTMAINLEVEL.":</strong> $level<br />";

	echo "<strong>"._TUTMAINVIEWS.":</strong> $hits<br />";

	/* voting & comments stats */

        if ($totalvotes == 1) {

	    $votestring = _TUTMAINVOTE;

        } else {

	    $votestring = _TUTMAINVOTES;

	}

	if ($tutorialsratingsummary!="0" || $tutorialsratingsummary!="0.0") {

	    echo " <strong>"._TUTMAINRATING.":</strong> $tutorialsratingsummary ($totalvotes $votestring)<br />";

	}

	echo "<a href=\"modules.php?name=$module_name&t_op=FullProfile&amp;t_id=$t_id\">"._TUTMAINFULLPROFILE."</a>";

        if (is_user($user)) {

        echo " | <a href=\"modules.php?name=$module_name&t_op=AddList&amp;t_id=$t_id\">"._TUTMAINADDFAV."</a>";

        }

        echo" | <a href=\"modules.php?name=$module_name&t_op=ratetutorial&amp;lid=$t_id\">"._TUTMAINRATERESOURCE."</a>";

        /*if (is_user($user)) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=modifytutorialrequest&amp;lid=$t_id\">"._TUTMAINMODIFYRESOURCE."</a>";

	}*/

	if ($totalcomments != 0) {

	    echo " | <a href=\"modules.php?name=$module_name&t_op=viewtutorialcomments&amp;lid=$t_id\">"._TUTMAINSCOMMENTS." ($totalcomments)</a>";

	}

	echo "<br />";

		$result3 = $db->sql_query("SELECT tc_id,tc_title,parentid FROM ".$prefix."_tutorials_categories WHERE tc_id=$tc_id");

		list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);

		if ($parentid3>0) $title3 = getparentlink($parentid3,$title3);

		echo ""._TUTMAINCATEGORY.": $title3<br /><br />";

		$x++;

	    }

	    echo "</font>";

    	    $orderby = convertorderbyout($orderby);

	} else {

	    echo "<br /><br /><center><font class=\"option\"><strong>"._TUTMAINNOMATCHES."</strong></font><br /><br />"._GOBACK."<br /></center>";

	}

    /* Calculates how many pages exist.  Which page one should be on, etc... */

    $orderby = convertorderbyout($orderby);

    $tutorialpagesint = ($totalselectedtutorials / $tutconfig['searchtutorials']);

    $tutorialpageremainder = ($totalselectedtutorials % $tutconfig['searchtutorials']);		

    if ($tutorialpageremainder != 0) {					 

    	$tutorialpages = ceil($tutorialpagesint);				

    	if ($totalselectedtutorials < $tutconfig['searchtutorials']) {

    		$tutorialpageremainder = 0;

    	}

    } else {

    	$tutorialpages = $tutorialpagesint;

    }

    /* Page Numbering */

    if ($tutorialpages!=1 && $tutorialpages!=0) {

        echo "<br /><br />";

      	echo ""._TUTMAINSELECTPAGE.": ";

     	$prev=$min-$tutconfig['searchtutorials'];

     	if ($prev>=0) {

    	    echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">";

    	    echo " &lt;&lt; "._TUTMAINPREVIOUS."</a> ]</strong>&nbsp;&nbsp;";

  	}	    	

    	$counter = 1;

 	$currentpage = ($max / $tutconfig['searchtutorials']);

       	while ($counter<=$tutorialpages ) {

      	    $cpage = $counter;

      	    $mintemp = ($tutconfig['searchtutorials'] * $counter) - $tutconfig['searchtutorials'];

      	    if ($counter == $currentpage) {

		echo "<strong>$counter</strong>&nbsp";

	    } else {

		echo "<a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";

	    }

       	    $counter++;

       	}

     	$next=$min+$tutconfig['searchtutorials'];

     	if ($next<$tutorialpages) {

    		echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&t_op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";

    		echo " "._TUTMAINNEXT." &gt;&gt;</a> ]</strong> ";

     	}

        }

    } else {

	echo "<center><font class=\"option\"><strong>"._TUTMAINNOMATCHES."</strong></font></center><br /><br />";

    }

    CloseTable();

    include_once("footer.php");

}

function FullProfile($t_id) {

    global $prefix, $db, $admin, $admin_file, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $module_name, $locale, $tutconfig, $user_prefix;

    include_once("header.php");

    menu();

    $t_id = intval($t_id);

    $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_tutorials_votedata WHERE ratinglid = $t_id");

    $totalvotesDB = $db->sql_numrows($voteresult);

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

    while(list($ratingDB, $ratinguserDB, $ratingcommentsDB)=$db->sql_fetchrow($voteresult)) {

 	if ($ratingcommentsDB=="") $truecomments--;

        if ($ratinguserDB=="Anonymous") {

	    $anonvotes++;

	    $anonvoteval += $ratingDB;

	}

	if ($ratinguserDB!="Anonymous") {

	    $regvoteval += $ratingDB;

	}

	if ($ratinguserDB!="Anonymous") {

	    if ($ratingDB > $topreg) $topreg = $ratingDB;

	    if ($ratingDB < $bottomreg) $bottomreg = $ratingDB;

	    for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $rvv[$rcounter]++;	

	}

	if ($ratinguserDB=="Anonymous") {

	    if ($ratingDB > $topanon) $topanon = $ratingDB;

	    if ($ratingDB < $bottomanon) $bottomanon = $ratingDB;

	    for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $avv[$rcounter]++;	

	}

    }

    $regvotes = $totalvotesDB - $anonvotes;

    if ($totalvotesDB == 0) {

	$finalrating = 0;

    } else if ($regvotes == 0) {

 	/* Figure Anon Only Vote */

	$finalrating = $anonvoteval / $anonvotes;	     	 	

	$finalrating = number_format($finalrating, $tutconfig['detailvotedecimal']); 

	$avgAU = $anonvoteval / $totalvotesDB;

	$avgAU = number_format($avgAU, $tutconfig['detailvotedecimal']);	     	 	

    } else if ($anonvotes == 0) {

	/* Figure Reg Only Vote */

	$finalrating = $regvoteval / $regvotes;	     	 	

	$finalrating = number_format($finalrating, $tutconfig['detailvotedecimal']); 

	$avgRU = $regvoteval / $totalvotesDB;

	$avgRU = number_format($avgRU, $tutconfig['detailvotedecimal']);

    } else {

     	/* REG User vs. Anonymous vs. Outside User Weight Calutions */

     	$impact = $tutconfig['anonweight'];

     	$outsideimpact = $outsideweight;

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

	$impactRU = $regvotes;

	$impactAU = $anonvotes / $impact;

	$finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU)) / ($impactRU + $impactAU);

	$finalrating = number_format($finalrating, $tutconfig['detailvotedecimal']); 

    }

    if ($avgRU == 0 || $avgRU == "") {

	$avgRU = "";

    } else {

	$avgRU = number_format($avgRU, $tutconfig['detailvotedecimal']);

    }

    if ($avgAU == 0 || $avgAU == "") {

	$avgAU = "";

    } else {

	$avgAU = number_format($avgAU, $tutconfig['detailvotedecimal']);

    }

    if ($topanon == 0) $topanon = "";

    if ($bottomanon == 11) $bottomanon = "";

    if ($topreg == 0) $topreg = "";

    if ($bottomreg == 11) $bottomreg = "";

    $totalchartheight = 70;

    $chartunits = $totalchartheight / 10;

    $avvper		= array(0,0,0,0,0,0,0,0,0,0,0);

    $rvvper 		= array(0,0,0,0,0,0,0,0,0,0,0);

    $avvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);

    $rvvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);

    $avvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);

    $rvvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);

    $avvmultiplier = 0;

    $rvvmultiplier = 0;

    $ovvmultiplier = 0;

    for ($rcounter=1; $rcounter<11; $rcounter++) {

    	if ($anonvotes != 0) $avvper[$rcounter] = $avv[$rcounter] / $anonvotes;

    	if ($regvotes != 0) $rvvper[$rcounter] = $rvv[$rcounter] / $regvotes;

    	$avvpercent[$rcounter] = number_format($avvper[$rcounter] * 100, 1);

    	$rvvpercent[$rcounter] = number_format($rvvper[$rcounter] * 100, 1);

    	if ($avv[$rcounter] > $avvmultiplier) $avvmultiplier = $avv[$rcounter];

    	if ($rvv[$rcounter] > $rvvmultiplier) $rvvmultiplier = $rvv[$rcounter];

    }

    if ($avvmultiplier != 0) $avvmultiplier = 10 / $avvmultiplier;

    if ($rvvmultiplier != 0) $rvvmultiplier = 10 / $rvvmultiplier;

    for ($rcounter=1; $rcounter<11; $rcounter++) {

        $avvchartheight[$rcounter] = ($avv[$rcounter] * $avvmultiplier) * $chartunits;

    	$rvvchartheight[$rcounter] = ($rvv[$rcounter] * $rvvmultiplier) * $chartunits;

        if ($avvchartheight[$rcounter]==0) $avvchartheight[$rcounter]=1;

    	if ($rvvchartheight[$rcounter]==0) $rvvchartheight[$rcounter]=1;

    }

    $res = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_id='$t_id'");

    while(list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($res)) {

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINTUTORIALPROFILE.": $t_title</strong></font><br /><br />";

    tutorialinfomenu($t_id);

        $tutorialsratingsummary = number_format($tutorialsratingsummary, $tutconfig['mainvotedecimal']);

	$t_title = stripslashes($t_title);

	$description = stripslashes($description);

	setlocale (LC_TIME, $locale);

	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_date, $datetime);

	$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	$datetime = ucfirst($datetime);

	$datetime = str_replace ("-", " ", $datetime);

    echo "<br /><br /><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";

    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

    echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>"._TUTMAINTUTORIALRATINGDET."</u></strong></td></tr>";

    echo "<tr><td align=\"right\"><strong>"._TUTMAINTOTALVOTES."</strong></td>";

    echo "<td align=\"left\">$totalvotesDB</td></tr>";

    echo "<tr><td align=\"right\"><strong>"._TUTMAINOVERALLRATING."</strong></td>";

    echo "<td align=\"left\">$finalrating</td></tr>";

    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

    echo "<tr><td align=\"center\" colspan=\"2\"><strong><u>"._TUTMAINADDITIONALDET."</u></strong></td></tr>";

    echo "<tr><td align=\"right\" width=\"50%\"><strong>"._TUTMAINDESCRIPTION.":</strong></td>";

    echo "<td align=\"left\">$description</td></tr>";

    echo "<tr><td align=\"right\" width=\"50%\"><strong>"._TUTMAINAUTHOR.":</strong></td>";

    echo "<td align=\"left\"><a href=\"$author_homepage\">$author</a></td></tr>";

    if (($submitter != $author) && ($submitter!='')){

    $usersql = $db->sql_query("SELECT user_website FROM ".$user_prefix."_users WHERE username='$submitter'");

    $userweb = $db->sql_fetchrow($usersql);

    if(!empty($userweb['user_website']) && $userweb['user_website'] != 'http://'){

    $submitter2 = "<a href=\"".$userweb['user_website']."\">".$submitter."</a>";

    }else{

    $submitter2 = $submitter;

    }

    echo "<tr><td align=\"right\" width=\"50%\"><strong>"._TUTMAINSUBBY.":</strong></td>";

    echo "<td align=\"left\">$submitter2</td></tr>";

    }

    echo "<tr><td align=\"right\"><strong>"._TUTMAINVERSION.":</strong></td><td align=\"left\">$version</td></tr>";

    echo "<tr><td align=\"right\"><strong>"._TUTMAINADDEDON.":</strong>";

    echo "</td><td align=\"left\">$datetime</td></tr>";

$result3=$db->sql_query("select title from ".$prefix."_tutorials_levels Where sid='$level'");

$levelrow = $db->sql_fetchrow($result3);

$level = $levelrow['title'];

    echo "<tr><td align=\"right\"><strong>"._TUTMAINLEVEL.":</strong>";

    echo "</td><td align=\"left\">$level</td></tr>";

    echo "<tr><td align=\"right\"><strong>"._TUTMAINVIEWS.":</strong></td>";

    echo "<td align=\"left\">$hits</td></tr>";

    echo "</table>";

    echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"455\">"

	."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\">"

	."<font class=\"content\"><strong>"._TUTMAINREGISTEREDUSERS."</strong></font>"

	."</td></tr>"

	."<tr>"

	."<td bgcolor=\"$bgcolor1\">"

        ."<font class=\"content\">"._TUTMAINNUMBEROFRATINGS.": $regvotes</font>"

	."</td>"

	."<td rowspan=\"5\" width=\"200\">";

    if ($regvotes==0) {

	echo "<center><font class=\"content\">"._TUTMAINNOREGUSERSVOTES."</font></center>";

    } else { 

       	echo "<table border=\"1\" width=\"200\">"

    	    ."<tr>"

	    ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINBREAKDOWNBYVAL."</font></td>"

	    ."</tr>"

	    ."<tr>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[1] "._TUTMAINLVOTES." ($rvvpercent[1]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[1]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[2] "._TUTMAINLVOTES." ($rvvpercent[2]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[2]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[3] "._TUTMAINLVOTES." ($rvvpercent[3]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[3]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[4] "._TUTMAINLVOTES." ($rvvpercent[4]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[4]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[5] "._TUTMAINLVOTES." ($rvvpercent[5]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[5]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[6] "._TUTMAINLVOTES." ($rvvpercent[6]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[6]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[7] "._TUTMAINLVOTES." ($rvvpercent[7]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[7]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[8] "._TUTMAINLVOTES." ($rvvpercent[8]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[8]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[9] "._TUTMAINLVOTES." ($rvvpercent[9]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[9]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[10] "._TUTMAINLVOTES." ($rvvpercent[10]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[10]\"></td>"

	    ."</tr>"

	    ."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"

	    ."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">1</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">2</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">3</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">4</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">5</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">6</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">7</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">8</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">9</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">10</font></td>"

	    ."</tr></table>"

	    ."</td></tr></table>";

    }

    echo "</td>"

	."</tr>"

	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINTUTORIALRATING.": $avgRU</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._TUTMAINHIGHRATING.": $topreg</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINLOWRATING.": $bottomreg</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._TUTMAINNUMOFCOMMENTS.": $truecomments</font></td></tr>"

	."<tr><td></td></tr>"

	."<tr><td valign=\"top\" colspan=\"2\"><font class=\"tiny\"><br /><br />"._TUTMAINWEIGHNOTE." ".$tutconfig['anonweight']." "._TUTMAINTO." 1.</font></td></tr>"

        ."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\"><font class=\"content\"><strong>"._TUTMAINUNREGISTEREDUSERS."</strong></font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._TUTMAINNUMBEROFRATINGS.": $anonvotes</font></td>"

	."<td rowspan=\"5\" width=\"200\">";

    if ($anonvotes==0) {

	echo "<center><font class=\"content\">"._TUTMAINNOUNREGUSERSVOTES."</font></center>";

    } else { 

        echo "<table border=\"1\" width=\"200\">"

    	    ."<tr>"

	    ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINBREAKDOWNBYVAL."</font></td>"

	    ."</tr>"

	    ."<tr>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[1] "._TUTMAINLVOTES." ($avvpercent[1]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[1]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[2] "._TUTMAINLVOTES." ($avvpercent[2]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[2]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[3] "._TUTMAINLVOTES." ($avvpercent[3]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[3]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[4] "._TUTMAINLVOTES." ($avvpercent[4]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[4]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[5] "._TUTMAINLVOTES." ($avvpercent[5]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[5]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[6] "._TUTMAINLVOTES." ($avvpercent[6]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[6]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[7] "._TUTMAINLVOTES." ($avvpercent[7]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[7]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[8] "._TUTMAINLVOTES." ($avvpercent[8]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[8]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[9] "._TUTMAINLVOTES." ($avvpercent[9]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[9]\"></td>"

	    ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[10] "._TUTMAINLVOTES." ($avvpercent[10]% "._TUTMAINLTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[10]\"></td>"

	    ."</tr>"

	    ."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"

	    ."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">1</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">2</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">3</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">4</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">5</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">6</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">7</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">8</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">9</font></td>"

	    ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">10</font></td>"

	    ."</tr></table>"

	    ."</td></tr></table>";

    }

    echo "</td>"

	."</tr>"

	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINTUTORIALRATING.": $avgAU</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._TUTMAINHIGHRATING.": $topanon</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._TUTMAINLOWRATING.": $bottomanon</font></td></tr>"

	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">&nbsp;</font></td></tr>";

    echo "</table><br /><br /><center>";

    tutorialfooter($t_id);

 }

    echo "</center>";

    CloseTable();

    include_once("footer.php");

}



function FavoriteTutorials(){

    global $prefix, $db, $module_name, $user, $cookie, $bgcolor2;

    if (is_user($user)){

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font></center><br />";

echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\">

  <tr>

    <th width=\"40%\" align=\"center\">&nbsp;"._TUTMAINTUTORIALTITLE."&nbsp;</th>

    <th width=\"50%\" align=\"center\">&nbsp;"._TUTMAINFAVREMOVE."&nbsp;&&nbsp;"._TUTMAINFAVTOP5."</th>

    <th width=\"10%\" align=\"center\">&nbsp;"._TUTMAINVIEWS."&nbsp;</th>

    </tr>";

$sql = "SELECT " . $prefix . "_tutorials_favorites.*, " . $prefix . "_tutorials_tutorials.*

    FROM " . $prefix . "_tutorials_favorites LEFT JOIN " . $prefix . "_tutorials_tutorials

    ON " . $prefix . "_tutorials_favorites.t_id = " . $prefix . "_tutorials_tutorials.t_id

    WHERE " . $prefix . "_tutorials_favorites.user_id = '" . $cookie[0] . "'";

$result = $db->sql_query($sql);

while ( $row = $db->sql_fetchrow($result) ) {

echo"<tr>

    <td width=\"40%\" bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"modules.php?name=".$module_name."&t_op=showtutorial&pid=".$row[t_id]."\">".$row['t_title']."</td>

    <td width=\"50%\" bgcolor=\"$bgcolor2\" align=\"center\" valign=\"middle\">

    <form action='modules.php?name=$module_name' method='post'>

    <input type='hidden' name='fav_id' value='$row[fav_id]'>

    <select name='t_op'>";

    $sel ='';

    if ($row[showlist] == '1'){

    echo "<option value=\"RemoveTop5\" $sel>"._TUTMAINREMOVETOP5."</option>";

    }else{

    echo "<option value=\"AddTop5\" $sel>"._TUTMAINADDTOP5."</option>";

    }

    echo "<option value=\"RemoveList\" $sel>"._TUTMAINFAVREMOVE2."</option>";

    echo "</select><input type='submit' value='"._TUTMAINGO."'>

    </td></form>

    <td width=\"10%\" bgcolor=\"$bgcolor2\" align=\"center\">".$row['t_counter']."</td>

     </tr>";

     }

echo"</table>";

    CloseTable();

    include_once('footer.php');

    }else{

    Header("Location: modules.php?name=Your_Account");

    }

}

function AddList($t_id){

global $prefix, $db, $module_name, $user, $cookie, $bgcolor2, $tutconfig;

$t_id = intval($t_id);

if (is_user($user)){

    cookiedecode($user);

    $uid = $cookie[0];

    $total_list= $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_favorites WHERE user_id='$uid'"));

    if($total_list < $tutconfig['maxfavs']){

    $exist= $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_favorites WHERE t_id='$t_id' AND user_id='$cookie[0]'"));

    if ($exist == 0){

    $uid = $cookie['0'];

    $db->sql_query("insert into ".$prefix."_tutorials_favorites values ('', '$uid', '$t_id', '0')");

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<META HTTP-EQUIV='refresh' content='2;URL=modules.php?name=".$module_name."&t_op=FavoriteTutorials'>\n";

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINSUCADDED."</center></br>";

    CloseTable();

    include_once('footer.php');

    }else{

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINALREADYINFAVS."<br /><br />"._GOBACK."</center></br>";

    CloseTable();

    include_once('footer.php');

    }

    }else{

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINALREADYMAX1." (".$tutconfig['maxfavs'].") "._TUTMAINALREADYMAX2."<br /><br />"._GOBACK."</center></br>";

    CloseTable();

    include_once('footer.php');

    }

  }

}

function AddTop5($fav_id){

global $prefix, $db, $module_name, $user, $cookie, $bgcolor2;

$fav_id = intval($fav_id);

if (is_user($user)){

    cookiedecode($user);

    $uid = $cookie[0];

    $total_toplist = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_tutorials_favorites WHERE showlist='1' AND user_id='$uid'"));

    if($total_toplist<5){

    $db->sql_query("UPDATE ".$prefix."_tutorials_favorites SET showlist=1 WHERE fav_id='$fav_id'");

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<META HTTP-EQUIV='refresh' content='2;URL=modules.php?name=".$module_name."&t_op=FavoriteTutorials'>\n";

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINSUCADDEDT5."</center></br>";

    CloseTable();

    include_once('footer.php');

    }else{

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINALREADY5."<br /><br />"._GOBACK."</center></br>";

    CloseTable();

    include_once('footer.php');

    }

}else{

    Header("Location: modules.php?name=Your_Account");

    }

}

function RemoveTop5($fav_id, $ok=0){

global $prefix, $db, $module_name, $user, $cookie, $bgcolor2;

$fav_id = intval($fav_id);

if (is_user($user)){

if ($ok==1){

$db->sql_query("UPDATE ".$prefix."_tutorials_favorites SET showlist=0 WHERE fav_id='$fav_id'");

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<META HTTP-EQUIV='refresh' content='2;URL=modules.php?name=".$module_name."&t_op=FavoriteTutorials'>\n";

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINSUCREMOVEDT5."</center></br>";

    CloseTable();

    include_once('footer.php');

}else{

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

	echo "<center>";

	echo "<font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font>";

	echo "<br /><br />";

	echo ""._TUTMAINSUREREMOVEFAV." ".$fav_id." "._TUTMAINFROMTOP5."??<br /><br />";

        echo "<a href=\"modules.php?name=".$module_name."&t_op=RemoveTop5&fav_id=".$fav_id."&ok=1\">"._TUTADMINYES."</a> | <a href=\"javascript:history.go(-1)\">"._TUTADMINNO."</a>";

	echo "</center><br />";

    CloseTable();

    include_once('footer.php');

}

}else{

    Header("Location: modules.php?name=Your_Account");

    }

}



function RemoveList($fav_id, $ok=0){

global $prefix, $db, $module_name, $user, $cookie, $bgcolor2;

$fav_id = intval($fav_id);

if (is_user($user)){

if ($ok==1){

$db->sql_query("DELETE FROM ".$prefix."_tutorials_favorites WHERE fav_id='$fav_id'");

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

    echo "<META HTTP-EQUIV='refresh' content='2;URL=modules.php?name=".$module_name."&t_op=FavoriteTutorials'>\n";

    echo "<center><font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font><br /><br />";

    echo ""._TUTMAINSUCREMOVED."</center></br>";

    CloseTable();

    include_once('footer.php');

}else{

    include_once("header.php");

    menu();

    echo "<br />";

    OpenTable();

	echo "<center>";

	echo "<font class=\"option\"><strong>"._TUTMAINFAVORITE."</strong></font>";

	echo "<br /><br />";

	echo ""._TUTMAINSUREREMOVEFAV." ".$fav_id."??<br /><br />";

        echo "<a href=\"modules.php?name=".$module_name."&t_op=RemoveList&fav_id=".$fav_id."&ok=1\">"._TUTADMINYES."</a> | <a href=\"javascript:history.go(-1)\">"._TUTADMINNO."</a>";

	echo "</center><br />";

    CloseTable();

    include_once('footer.php');

}

}else{

    Header("Location: modules.php?name=Your_Account");

    }

}

switch ($t_op){

	

    default:

    index();

    break;



    case "search":

    search($query, $min, $orderby, $show);

    break;



    case "viewtutorial":

    viewtutorial($tc_id, $min, $orderby, $show);

    break;



    case "showtutorial":

    showtutorial($pid, $tpage);

    break;

    

    case "ratetutorial":

    ratetutorial($lid, $user);

    break;



    case "addrating":

    addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments, $user);

    break;



    case "viewtutorialcomments":

    viewtutorialcomments($lid);

    break;



    case "PopularTutorials":

    PopularTutorials($ratenum, $ratetype);

    break;

    

    case "TopTutorials":

    TopTutorials($ratenum, $ratetype);

    break;



    case "NewTutorials":

    NewTutorials($newtutorialshowdays);

    break;



    case "NewTutorialsDate":

    NewTutorialsDate($selectdate);

    break;



    case "FullProfile":

    FullProfile($t_id);

    break;



    case "FavoriteTutorials":

    FavoriteTutorials();

    break;

    

    case "RemoveList":

    RemoveList($fav_id, $ok);

    break;



    case "AddList":

    AddList($t_id);

    break;



    case "AddTop5":

    AddTop5($fav_id, $ok);

    break;



    case "RemoveTop5":

    RemoveTop5($fav_id, $ok);

    break;

    }



?>

