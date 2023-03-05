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



$index = 1;

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = "- Top Sites";



function menu() {

    global $module_name,$prefix, $db,$catid,$user,$userinfo;

	$result_config = $db->sql_query("SELECT categorie_option,latest from ".$prefix."_top_sites_config");

    list($categorie_option,$latest) = $db->sql_fetchrow($result_config);

	$categorie_option =intval($categorie_option);

	$latest =intval($latest);

	getusrinfo($user);

	$result_edit=$db->sql_query("select * from ".$prefix."_top_sites where submitter='$userinfo[username]' and validation='Y'");

    $numrows_edit = $db->sql_numrows($result_edit);

	OpenTable();

	echo"<center><br>";

    if ($categorie_option==1){ ListCat($catid,$catname); }

	echo"<center><br>"

	."<font class=\"content\">[ "

    ."<a href=\"modules.php?name=$module_name\">"._LINKSMAIN."</a> | "

    ."<a href=\"modules.php?name=$module_name&op=AddLink\">"._ADDLINK."</a>";

    if ($numrows_edit > 0) {echo" | <a href=\"modules.php?name=$module_name&op=Editlink\">"._EDITLINK."</a>"; }

	echo" | <a href=\"modules.php?name=$module_name&op=LastLinks\">"._THE." $latest "._LATEST."</a>"

    ." | <a href=\"modules.php?name=$module_name&op=Searching\">"._SEARCH."</a>"

	." | <a href=\"modules.php?name=$module_name&op=rules\">"._HELPANDRULES."</a> ";

	$result=$db->sql_query("select * from ".$prefix."_top_sites where validation='Y' ");

    $numrows = $db->sql_numrows($result);

    echo " | <strong>$numrows "._LINKS."</strong>"

	." ]"

	."</font>";

    CloseTable();

}



function ListCat($catid,$catname) {

    global $module_name,$prefix, $db;

    $result=$db->sql_query("select * from ".$prefix."_top_sites_categories order by catname");

	$numrows = $db->sql_numrows($result);

	if ($numrows!==0) { 

        echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"

        ."<select name=\"catid\" onChange=\"submit()\">";

	    $catid=0;

        if ($catid==0){

           print"<option value=\"modules.php?name=$module_name&amp;op=index&amp;catid='0'\" selected>";

           print(""._ALL."");

           print("</option>");

        }

	    $i=0;

        WHILE ($i < $numrows){

	       $row = $db->sql_fetchrow($result);

           $catid = intval($row['catid']);

	       $catname = $row['catname'];

	       if($catid==$catid2) {$selecetd="selected";}

	       print("<option value=\"$catid\" $selected");

           print(">$catname</option>");

	      $i++;

         }

         echo "</select><input type=\"hidden\" name=\"op\" value=\"index\"></form>";

      } else {}

}   



function writeOptionList( $table, $id ) {

    global $db;

    $orderby="order by catname";

	$result=$db->sql_query( "SELECT * FROM $table $orderby");

	if (!$result) {

       print "Failed To open Table";

	   return false;

    }

	while ($a_row=$db->sql_fetchrow( $result ) ) {

		print "<option value='$a_row[0]'";

		if ( $id == $a_row[0] ) print "selected";

		print ">$a_row[1]\n";

	}

}



function SearchForm() {

    global $module_name;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

    echo "<form action=\"modules.php?name=$module_name&op=search&query=$query\" method=\"post\">"

	."<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">"

	."<tr><td><font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></td></tr>"

	."</table>"

	."</form>";

	include_once("footer.php");

}



function bannerflash ($urlban,$lid,$width,$height) {

    global $prefix, $db;

    echo "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"\n"

    ."codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\"\n"

    ."width=\"$width\" height=\"$height\">\n"

    ." <param name=\"movie\" value=\"$urlban\">\n"

    ." <param name=\"quality\" value=\"high\">\n"

    ." <embed src=\"$urlban\" quality=\"high\" bgcolor=\"#FFFFFF\"\n"

    ."   type=\"application/x-shockwave-flash\"\n"

    ."   pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\">\n"

    ." </embed>\n"

   ."</object>\n"

    ."</a></center>";

}



function rules() {

    global $prefix, $db,$module_name,$admin, $min,$catid;

    $result_config = $db->sql_query("SELECT autovalidation,evaluation,perpage,maxaffichage,categorie_option,resizeimage,maxwidth,maxheight,delafterxdays,delxdays,nextdatedeletevote,flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($autovalidation,$evaluation,$perpage,$maxaffichage,$categorie_option,$resizeimage,$maxwidth,$maxheight,$delafterxdays,$delxdays,$nextdatedeletevote,$flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

    echo "<br>";

    OpenTable();

    echo"<center>"._HELPANDRULES."</center><br><br>";

	echo""._RULES0."<br><br>";

    if ($delafterxdays==1) {

	    echo"<strong>"._RULES1."</strong><br>";

       echo""._RULES2." $delxdays "._DAYS.".<br>"

       .""._RULES3." $nextdatedeletevote.<br><br>";

    }

	if ($autovalidation==1) {

        echo"<strong>"._RULES5."</strong><br>"._RULES6."<br><br>";

     }

	 if ($evaluation==1) { echo""._RULES7."<br><br>";} else { echo""._RULES8."<br><br>"; }

     if ($flashbanoption==1) { echo"<strong>"._RULES9."</strong><br><br>";} else { echo"<strong>"._RULES10."</strong><br><br>"; }

	 if ($weblinkoption==1) echo"<strong>"._RULES11."</strong><br><br>";

	  echo"<strong>"._ADMINRATE2."</strong><br>"

	  ."<img src=\"modules/$module_name/images/stars-1.gif\" border=\"0\"> (1/5)-->"

	  ."<img src=\"modules/$module_name/images/stars-5.gif\" border=\"0\"> (5/5   the best)<br>";

	 CloseTable();

    include_once("footer.php"); 

}	



function getparent($parentid,$title) {

    global $prefix, $db;

	$parentid = intval(trim($parentid));

    $result = $db->sql_query("select cid, title, parentid from ".$prefix."_links_categories where cid='$parentid'");

    $row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from ".$prefix."_links_categories where cid='$parentid'"));

    $cid = intval($row['cid']);

    $ptitle = stripslashes($row['title']);

    $pparentid = intval($row['parentid']);

    if ($ptitle!="") $title=$ptitle."/".$title;

    if ($pparentid!=0) {

	$title=getparent($pparentid,$ptitle);

    }

    return $title;

}



function index() {

    global $prefix, $db, $admin, $min, $catid, $module_name, $orderby, $admin_file;

    $result_config = $db->sql_query("SELECT evaluation,perpage,maxaffichage,categorie_option,resizeimage,maxwidth,maxheight,delafterxdays,delxdays,nextdatedeletevote,flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($evaluation,$perpage,$maxaffichage,$categorie_option,$resizeimage,$maxwidth,$maxheight,$delafterxdays,$delxdays,$nextdatedeletevote,$flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$evaluation = intval($evaluation);

	$perpage = intval($perpage);

	$maxaffichage = intval($maxaffichage);

	$categorie_option = intval($categorie_option);

	$resizeimage = intval($resizeimage);

	$maxwidth = intval($maxwidth);

	$maxheight = intval($maxheight);

	$delafterxdays = intval($delafterxdays);

	$delxdays = intval($delxdays);

	$flashbanoption = intval($flashbanoption);

	$weblinkoption = intval($weblinkoption);	

	$admin = base64_decode($admin);

	$admin = explode(":", $admin);

    $aid = "$admin[0]";

    $row = $db->sql_fetchrow($db->sql_query("SELECT radminlink,radminsuper from ".$prefix."_authors where aid='$aid'"));

	$radminlink = $row['radminlink'];

	$radminsuper = $row['radminsuper'];

    if ($delafterxdays==1) {

	   $typedateto=2;

	   $from_date=date( "Y-m-d H:i:s" );

	   $to_date=$nextdatedeletevote;

	   $temp=elapsedTime($from_date,$to_date,$typedateto);

	   if ($temp<=0){

		  cleanvotes();

		  $nextdatedeletevote_1=time()+$delxdays*24*60*60;

		  $nextdatedeletevote = strftime("%Y-%m-%d",$nextdatedeletevote_1);

		  $db->sql_query("UPDATE ".$prefix."_top_sites_config SET nextdatedeletevote='$nextdatedeletevote'");

        } 

	}

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    if (!isset($min)) $min=0;

	$min2=$min;

	

    if (!isset($max)) $max=$min+$perpage;

	$orderby_title_D = "title DESC";

	$orderby_title_A = "title ASC";

	$orderby_vote_D = "totalvotes DESC";

	$orderby_vote_A = "totalvotes ASC";

	$orderby_hits_D = "hits DESC";

	$orderby_hits_A = "hits ASC";

	$orderby_linkratingsummary_D = "linkratingsummary DESC";

	$orderby_linkratingsummary_A = "linkratingsummary ASC";	

	if (!$orderby) {$orderby = htmlspecialchars($orderby_vote_D);}

	 

    if ($show!="") {$perpage = $show; } else {$show=$perpage;}

    menu();

    echo "<br>";

    OpenTable();

	if ($catid==0){

        $result=$db->sql_query("select lid, catid,title,urlban,imagewidth,imageheight,description,date,hits,linkratingsummary,totalvotes,adminrate  from ".$prefix."_top_sites where validation='Y'order by $orderby limit $min,$perpage");

        $fullcountresult=$db->sql_query("select * from ".$prefix."_top_sites where validation='Y' ");

        $totalselectedlinks = $db->sql_numrows($fullcountresult);

	    if ($categorie_option==1){

			if ($totalselectedlinks >0){echo"<center><strong>"._ALLCATEGORIES."</strong></enter><br><br>";							

			} else{ echo"<center>"._NOYETSITE."";}

        $catid2=$catid;

		$catid2=intval($catid2);

		}

	 } else {

	        $result=$db->sql_query("select lid, catid,title,urlban,imagewidth,imageheight,description, date, hits, linkratingsummary, totalvotes,adminrate  from ".$prefix."_top_sites where catid='$catid' and validation='Y'order by $orderby limit $min,$perpage");

            $fullcountresult=$db->sql_query("select * from ".$prefix."_top_sites where catid='$catid' and validation='Y' ");

            $result2=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid=$catid");

            $row = $db->sql_fetchrow($result2);

            $catname = stripslashes($row['catname']);

 	        $totalselectedlinks = $db->sql_numrows($fullcountresult);

	        if ($categorie_option==1){

                if ($totalselectedlinks >0){ echo"<center><strong>$totalselectedlinks "._LINKS." "._INCATEGORY." $catname</strong><br><br>";

				} else{ echo"<center>"._NOYETSITEINTHISCAT."";}

            }

			$catid2=$catid;

			$catid2=intval($catid2);

       }

if ($totalselectedlinks >0){

			$asc_title="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_title_A\">";

			$desc_title="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_title_D\">";

			$asc_vote="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_vote_A\">";

			$desc_vote="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_vote_D\">";

			$asc_hits="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_hits_A\">";

			$desc_hits="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_hits_D\">";

			$asc_linkratingsummary="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_linkratingsummary_A\">";

			$desc_linkratingsummary="<a href=\"modules.php?name=$module_name&amp;orderby=$orderby_linkratingsummary_D\">";

			

       echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"1\"><font class=\"content\">"

       ."<tr>"

       ."<td width=\"70%\"><div align=\"center\">"        

	   ."$asc_title<img src=\"modules/$module_name/images/up.gif\" border=\"0\"></a>"

	   ." "._TITLE." "

	   ."$desc_title<img src=\"modules/$module_name/images/down.gif\" border=\"0\"></a>"

	   ."</div></td>"

       ."<td width=\"10%\"><div align=\"center\">"

	   ."$asc_vote<img src=\"modules/$module_name/images/up.gif\" border=\"0\"></a>"

	   ." In "

	   ."$desc_vote<img src=\"modules/$module_name/images/down.gif\" border=\"0\"></a>"

	   ."</div></td>"

       ."<td width=\"10%\"> <div align=\"center\">"

	   ."$asc_hits<img src=\"modules/$module_name/images/up.gif\" border=\"0\"></a>"

	   ." Out "

	  ."$desc_hits<img src=\"modules/$module_name/images/down.gif\" border=\"0\"></a>"

	   ."</div></td>";

	   if ($evaluation==1) {

	       echo"<td width=\"10%\"><div align=\"center\">"

		 ."$asc_linkratingsummary<img src=\"modules/$module_name/images/up.gif\" border=\"0\"></a>"  

		 ." "._NOTES." "  

		."$desc_linkratingsummary<img src=\"modules/$module_name/images/down.gif\" border=\"0\"></a>"

	   ."</div></td>";

        }

       echo"</tr>";

	  

	   $x=0;

	   $rank=0;

	   while($row2 = $db->sql_fetchrow($result)) {

			$lid = intval($row2['lid']);

			$catid = intval($row2['catid']);

			$title = stripslashes($row2['title']);

			$urlban = stripslashes($row2['urlban']);

			$imagewidth = intval($row2['imagewidth']);

			$imageheight= intval($row2['imageheight']);			

			$description = stripslashes($row2['description']);

			$time = $row2['date'];

			$hits = intval($row2['hits']);

			$linkratingsummary = $row2['linkratingsummary'];

			$totalvotes = intval($row2['totalvotes']);

			$adminrate = stripslashes($row2['adminrate']);			

			

			$rank=1+$min;

			$result_1=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid='$catid'");

            $row3 = $db->sql_fetchrow($result_1);

            $catname = stripslashes($row3['catname']);

            echo"<tr><td width=\"70%\">"

	        ."<br>"

            ."$rank - <a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\" target=\"new\"><strong>$title</strong></a>";

        	if ($rank <=$maxaffichage) {

	           if ($urlban !="") {

			          if ($resizeimage==1){

	                     if ($imagewidth > $maxwidth){$width=$maxwidth;

                         } else { $width = $imagewidth;}

                         if ($imageheight>$maxheight){$height=$maxheight;

                         } else {$height = $imageheight;}

					   } else {

					      $width = $imagewidth;

						  $height = $imageheight;

						}  

                     echo"<br><br><a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\"  target=\"new\" >";

		             if (strpos($urlban,"swf")==TRUE) {

					   

					   $image_size_flash = getimagesize("$urlban");

                       $width=$image_size_flash[0];

                       $height=$image_size_flash[1];

					   

					   bannerflash ($urlban,$lid,$width,$height);

			         } else  { echo"<img src=$urlban width=$width height=$height border=\"0\"><a/>";

                     }

			         echo"<br>";

                }

	          }

	          echo "<br>"

	         ."<em>"._DESCRIPTION."</em>: $description<br>"

			 ."<em>"._CATEGORY."</em>: <a href=\"modules.php?name=$module_name&amp;op=index&amp;catid=$catid\">$catname</a><br>";

	        setlocale (LC_TIME, '$locale');

	         preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);

             $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	         $datetime = ucfirst($datetime);

	         echo "<em>"._ADDEDON."</em>: $datetime";

			 $result_lastrating=$db->sql_query("select rating from ".$prefix."_top_sites_votedata where ratinglid='$lid' order by ratingtimestamp  desc limit 5");

             $totallastrating = $db->sql_numrows($result_lastrating);

			 if ($totallastrating > 0) {

			 	echo"<br>"._LASTRATING." :";

			 	while ($row4 = $db->sql_fetchrow($result_lastrating)) {

					$rating = intval($row4['rating']);

					if ($rating <= 2) { echo" <img src=\"modules/$module_name/images/votejs/note1.gif\" alt=\"Vote : $rating\">"; }

					elseif ($rating > 2 AND $rating <= 6) { echo" <img src=\"modules/$module_name/images/votejs/note2.gif\" alt=\"Vote : $rating\">"; }

			 		elseif ($rating > 6 AND $rating <= 8) { echo" <img src=\"modules/$module_name/images/votejs/note3.gif\" alt=\"Vote : $rating\">"; }

			 		else { echo" <img src=\"modules/$module_name/images/votejs/note4.gif\" alt=\"Vote : $rating\">"; }

				}

			  }			 

	         echo"<br>";

             if ($radminsuper==1 || $radminlink==1) {

    	        echo "<a href=\"".$admin_file.".php?op=topsitesmodifylink&amp;lid=$lid\">"._EDIT."</a> | ";

   	         }

	         echo "<a href=\"modules.php?name=$module_name&op=ratelink&amp;lid=$lid\">"._RATESITE."</a> | "

             . "<a href=\"modules.php?name=$module_name&op=outsidelinksetup&amp;lid=$lid\">"._ALLOWTORATE."</a>";

	         if ($adminrate !="" OR $adminrate !=0) { echo" | <img src=\"modules/$module_name/images/$adminrate\" border=\"0\">"; }

             echo"</td>"

	         ."<td width=\"10%\"><div align=\"center\">"

	         ." $totalvotes "

	         ."</div></td>"

             ."<td width=\"10%\"><div align=\"center\">"

	         ." $hits"

	         ."</div></td>";

             if ($evaluation==1) {

	             echo"<td width=\"10%\"><div align=\"center\">"

	             ." $linkratingsummary"

	             ."</div></td>";

	          }

	          $x++;

	          $min++;

	          echo"</tr>";

         }

         echo "</font></table>";

         $linkpagesint = ($totalselectedlinks / $perpage);

         $linkpageremainder = ($totalselectedlinks % $perpage);

         if ($linkpageremainder != 0) {

            $linkpages = ceil($linkpagesint);

            if ($totalselectedlinks < $perpage) {$linkpageremainder = 0;}

         } else {$linkpages = $linkpagesint;}

    	 // Page Numbering

        if ($linkpages!=1 && $linkpages!=0) {

           echo "<br><br>"

      	   .""._SELECTPAGE.": ";

     	   $prev=$min-$perpage;

    	   $counter = 1;

    	   $currentpage = ($max / $perpage);

       	   while ($counter<=$linkpages ) {

      	       $cpage = $counter;

      	       $mintemp = ($perpage * $counter) - $perpage;

      	       if ($counter == $currentpage) {echo "<strong>$counter</strong>&nbsp";

	           } else {

		             if ($catid2==0) {echo "<a href=\"modules.php?name=$module_name&op=index&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> "; }

	                 else {echo "<a href=\"modules.php?name=$module_name&op=index&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show&amp;catid=$catid2\">$counter</a> ";

                     }

                }

       	       $counter++;

          	}

     	    $next=$min+$perpage;

          }

} else {}

          CloseTable();

          include_once("footer.php");

}



function AddLink() {

    global $prefix, $db, $module_name,$user,$userinfo;

	$result_config = $db->sql_query("SELECT weblinkoption from ".$prefix."_top_sites_config");

    list($weblinkoption) = $db->sql_fetchrow($result_config);

	$weblinkoption = intval($weblinkoption);

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

	getusrinfo($user);

    echo "<br>";

    OpenTable();

    echo "<center><font class=\"title\"><strong>"._ADDALINK."</strong></font></center><br><br>";

    if (is_user($user)) {      

  	        echo"<form method=\"post\" action=\"modules.php?name=$module_name&op=Add\">"

	        ."<table border=\"0\"><tr><td>"

    	    .""._PAGETITLE.":</td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\">"

			."</td></tr><tr><td>"

    	    .""._PAGEURL.":</td><td><input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\">"

           ."</td></tr><tr><td>"

		    .""._URLBAN.":</td><td><input type=\"text\" name=\"urlban\" size=\"50\" maxlength=\"100\" >"

            ."</td></tr><tr><td>"

			.""._CATEGORY.":</td><td><select name='catid'>";	

	       	writeOptionList( "".$prefix."_top_sites_categories", $catid );

			echo "</select><br>"

			."</td></tr><tr><td>"

			.""._LDESCRIPTION.":</td><td><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br>"

    	    ."</td></tr><tr><td>";

    		// make a linkto web_links modules

		    $modpath .= "modules/Web_Links/index.php";

	        if ($weblinkoption == 1 && file_exists($modpath)) {

		  	    echo""._MAKEWEBLINK."</td><td>";

			    if ($makeweblink==1) {

	                echo "<input type='radio' name='makeweblink' value='1' checked>"._YES." &nbsp;

	                <input type='radio' name='makeweblink' value='0'>"._NO."";

                 } else {

	                echo "<input type='radio' name='makeweblink' value='1'>"._YES." &nbsp;

	                <input type='radio' name='makeweblink' value='0' checked>"._NO."";

                 }

                 echo"</td></tr><tr><td>"

		         .""._CATEGORY2.":</td><td>"

			     ."<select name=\"weblinkcat\">";

           	     $result2=$db->sql_query("select cid, title, parentid from ".$prefix."_links_categories order by parentid,title");

            	  while ($row = $db->sql_fetchrow($result2)) {

	    				$cid2 = intval($row['cid']);

	    				$ctitle2 = stripslashes($row['title']);

	    				$parentid2 = intval($row['parentid']);

				  	 if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);

    	             echo "<option value=\"$cid2\">$ctitle2</option>";

       	         }

		         echo "</select>"

			     ."</td></tr><tr><td>";

		     } else {

		   	      $makeweblink=0;

			     $weblinkcat="";

		    }

           	echo""._YOURNAME.":</td><td>"

			."$userinfo[username]"

			."</td></tr><tr><td>"

    	    .""._YOUREMAIL.":</td><td>"

			."$userinfo[user_email]"

			."</td></tr><tr><td></td><td>"

			."<input type=\"hidden\" name=\"submitter\" value=\"$userinfo[username]\">"

		   ."<input type=\"hidden\" name=\"email\" value=\"$userinfo[user_email]\">"

		    ."<input type=\"hidden\" name=\"op\" value=\"Add\">"

    	    ."<br><input type=\"submit\" value=\""._ADDURL."\"> "._GOBACK."<br>"

			."</td></tr></table>"

    	    ."</form>";

      } else {

	  echo "<center>"._LINKSNOTUSER1."<br>"

	        .""._LINKSNOTUSER2."<br><br>"

           .""._LINKSNOTUSER3."";

	  }	 

	CloseTable();

    include_once("footer.php");

}



function Add($title, $catid,$url, $urlban,$imagewidth,$imageheight,$auth_name, $description, $email,$makeweblink,$weblinkcat) {

    global $prefix, $db, $module_name,$user,$lid,$parentid2,$nukeurl, $sitename,$adminmail;

	$result_config = $db->sql_query("SELECT autovalidation,receivemail,flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($autovalidation,$receivemail,$flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$autovalidation =intval($autovalidation);

	$receivemail =intval($receivemail);

	$flashbanoption =intval($flashbanoption);

	$weblinkoption =intval($weblinkoption);

	$result = $db->sql_query("select url from ".$prefix."_top_sites where url='$url'");

    $numrows = $db->sql_numrows($result);

    if ($numrows>0) {

	   include_once("header.php");

       title("$sitename: "._TOPSINDEX."");

	   menu();

	   echo "<br>";

	  OpenTable();

	  echo "<META HTTP-EQUIV=\"refresh\" content=\"4;URL=javascript:history.go(-1)\">"

	  ."<center><strong>"._LINKALREADYEXT."</strong><br><br>";

	  CloseTable();

	  include_once("footer.php");

    } else {

	if(is_user($user)) {

	    $user2 = base64_decode($user);

	    $cookie = explode(":", $user2);

	    cookiedecode($user);

	    $submitter = $cookie[1];

    }

    if ($title=="" OR $description=="" OR $url=="") {

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"4;URL=javascript:history.go(-1)\">"

	."<center><strong>"._FIELDNOEMPTY."</strong><br><br>";

	CloseTable();

	include_once("footer.php");

    }

	if ($flashbanoption==0 && strpos($urlban,"swf")==TRUE) {

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._NOFLASHBANACCEPTED."</strong><br><br>";

	CloseTable();

	include_once("footer.php");

	}

	

	if ($urlban) {

	$image_size_flash = getimagesize("$urlban");

    $imagewidth=$image_size_flash[0];

    $imageheight=$image_size_flash[1];

	}

	

    //$cat = explode("-", $cat);

    //if ($cat[1]=="") {$cat[1] = 0;}

    $title = htmlspecialchars(stripslashes(FixQuotes($title)));

    $url = htmlspecialchars(stripslashes(FixQuotes($url)));

	$urlban = htmlspecialchars(stripslashes(FixQuotes($urlban)));

    $description = htmlspecialchars(stripslashes(FixQuotes($description)));

    $auth_name = htmlspecialchars(stripslashes(FixQuotes($auth_name)));

    $email = htmlspecialchars(stripslashes(FixQuotes($email)));

	

	if ($autovalidation==0) {

	   $db->sql_query("insert into ".$prefix."_top_sites values (NULL,'$catid','$title' ,'$url', '$urlban','$imagewidth','$imageheight','$description', now(), '$email', '0','$submitter',0,0,'N',0,'','$makeweblink','$weblinkcat')");

	} else {

	  if ($makeweblink==1) {

	     $result_weblink = $db->sql_query("select url from ".$prefix."_links_links where url='$url'");

         $numrows_weblink = $db->sql_numrows($result_weblink);

         if ($numrows_weblink>0) {

		    $messageweblink= ""._YOURLINKTOWEBLINK1."";

		    $makeweblink=4;

		 } else {

		    $messageweblink= ""._YOURLINKTOWEBLINK2."";

		    $db->sql_query("insert into ".$prefix."_links_links values (NULL, '$weblinkcat', '$parentid2', '$title', '$url', '$description', now(), '$submitter', '$email', '0','$submitter',0,0,0)");

            $makeweblink=4;

	     }		  

	   }

	

	$db->sql_query("insert into ".$prefix."_top_sites values (NULL,'$catid','$title' ,'$url', '$urlban','$imagewidth','$imageheight','$description', now(), '$email', '0','$submitter',0,0,'Y',1,'','$makeweblink','$weblinkcat')");

	$result = $db->sql_query("select lid from ".$prefix."_top_sites where url='$url'");

    $row = $db->sql_fetchrow($result);

    $lid = intval($row['lid']);

	if (strpos($urlban,"swf")==TRUE) {$messageflash= ""._LINKFLASH." :$nukeurl/modules.php?name=$module_name&op=visit&amp;lid=$lid"; }

	$subject = ""._YOURLINKAT." $sitename";

	$message .= ""._HELLO." $name:\n\n"._LINKAPPROVEDMSG."\n";

	$message .=""._LINKTITLE.": $title\n";

	$message .=""._URL.": $url\n";

	$message .=""._DESCRIPTION.": $description\n";

	$message .=""._YOURRATELINK." : $nukeurl/modules.php?name=$module_name&op=outsidelinksetup&lid=$lid\n";

	$message .="$messageflash\n";

	$message .="$messageweblink\n";

	$message .=""._THANKS4YOURSUBMISSION."\n";

	$message .=""._TEAM." $sitename\n";

	$from = "$sitename";

	 mail($email, $subject, $message, "From: $adminmail");

	}

	if ($receivemail==1) {

	$subjectadmin = ""._NEWSITE."";

	$messageadmin = ""._HELLO."\n\n"._NEWSITE."\n\n"._LINKTITLE.": $title\n"._URL.": $url\n"._DESCRIPTION.": $description\n\n\n\n";

	$from = "$sitename";

	mail($adminmail, $subjectadmin, $messageadmin, "From: $adminmail");

	}

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

    echo "<br>";

    OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"5;URL=modules.php?name=$module_name\">";

	echo "<center><strong>"._LINKRECEIVED."</strong><br>";

	if ($autovalidation==0) {echo ""._EMAILWHENADD."<br>"; }

	else { echo ""._LINKAUTOADDED."<br>$messageweblink"; }

	echo "<br>";

	CloseTable();

    include_once("footer.php");

    }

}



function Editink() {

    global $prefix, $db, $module_name,$user, $userinfo;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

	getusrinfo($user);

    echo "<br>";

    OpenTable();

    echo "<center><font class=\"title\"><strong>"._MODALINK."</strong></font></center><br><br>";

    if (is_user($user)) {  

    echo"<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"100%\">"

    ."<tr>"

    ."<td width=\"10%\">"._NUMSITE."</td>"

    ."<td width=\"60%\">"._TITLE."</td>"

    ."<td width=\"10%\">"._MODIFY."</td>"

    ."<td width=\"10%\">"._DEL."</td>"

    ."<td width=\"10%\">Code</td>"

    ."</tr>"; 

	$result=$db->sql_query("select * from ".$prefix."_top_sites where submitter='$userinfo[username]' and validation='Y'");

    while ($row = $db->sql_fetchrow($result))

        {

        $lid = intval($row['lid']);

        $title = stripslashes($row['title']);

		$submitter = stripslashes($row['submitter']);

	    echo"<tr>"

        ."<td width=\"10%\">$lid</td>"

        ."<td width=\"60%\"><a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\" target=\"new\"><strong>$title</strong></a></td>"

        ."<td><center><width=\"15%\"><a href=\"modules.php?name=$module_name&op=modifylink&amp;lid=$lid\"><u><IMG SRC=\"modules/$module_name/images/editicon.gif\" BORDER=0></u></a></center></td>"

        ."<td><center><width=\"15%\"><a href=\"modules.php?name=$module_name&op=dellink&amp;lid=$lid\"><u><IMG SRC=\"modules/$module_name/images/delete.gif\" BORDER=0></u></a></center></td>"

        ."<td><center><width=\"15%\"><a href=\"modules.php?name=$module_name&op=outsidelinksetup&amp;lid=$lid\"><u><IMG SRC=\"modules/$module_name/images/star.gif\" BORDER=0></u></a></center></td>"

        ."</tr>";	

     } 

	 echo"</table>";

     }else {

      	echo "<center>"._LINKSNOTUSER1."<br>"

	     .""._LINKSNOTUSER2."<br><br>"

         .""._LINKSNOTUSER3."";

      }

	CloseTable();

    include_once("footer.php");

}



function modifylink($lid,$submitter) {

    global $prefix, $db,$module_name,$user,$userinfo;

	$result_config = $db->sql_query("SELECT autovalidation,receivemail,flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($autovalidation,$receivemail,$flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$autovalidation =intval($autovalidation);

	$receivemail =intval($receivemail);

	$flashbanoption =intval($flashbanoption);

	$weblinkoption =intval($weblinkoption);

	$result = $db->sql_query("select url from ".$prefix."_top_sites where url='$url'");

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

   	menu();

	getusrinfo($user);

	$submitter="$userinfo[username]";

 	echo "<br>";

    OpenTable();

	if (is_user($user)) {

       $result3 = $db->sql_query("select title, catid,url, urlban,imagewidth,imageheight,description, email, totalvotes,hits,linkratingsummary,adminrate,makeweblink,weblinkcat from ".$prefix."_top_sites where lid='$lid' and submitter='$submitter'");

	   echo "<center><font class=\"option\"><strong>"._MODALINK."</strong></font></center><br><br>";

       while($row3 = $db->sql_fetchrow($result3)) {

			$catid = intval($row3['catid']);

			$title = stripslashes($row3['title']);

			$url = stripslashes($row3['url']);

			$urlban = stripslashes($row3['urlban']);

			$email = stripslashes($row3['email']);			

			$description = stripslashes($row3['description']);

			$hits = intval($row3['hits']);

			$linkratingsummary = $row3['linkratingsummary'];

			$totalvotes = intval($row3['totalvotes']);

			$adminrate = stripslashes($row3['adminrate']);

			$makeweblink = intval($row3['makeweblink']);

			$weblinkcat = intval($row3['weblinkcat']);

			$imagewidth =intval($row3['imagewidth']);

			$imageheight =intval($row3['imageheight']);			

			

    	    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"

		    ."<table border=\"0\"><tr><td>"

	       .""._LINKID.":</td><td><strong>$lid</strong>"

		   ."</td></tr><tr><td>"

	       .""._PAGETITLE.":</td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\">"

	       ."</td></tr><tr><td>"

		   .""._PAGEURL.":</td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">"

	       ."</td></tr><tr><td>"

	       .""._URLBAN.":</td><td><input type=\"text\" name=\"urlban\" value=\"$urlban\" size=\"50\" maxlength=\"100\">"

	       ."</td></tr><tr><td>";

           if ($urlban !="") {

		      echo ""._PREVIEWBAN.":</td><td>";

              if ($resizeimage==1){

	             	if ($imagewidth>$maxwidth){$width=$maxwidth; } else {$width = $imagewidth;}

                	if ($imageheight>$maxheight){$height=$maxheight;} else {$height = $imageheight;}

                echo"<br><br><a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\"  target=\"new\" >";

                if (strpos($urlban,"swf")==TRUE) {

		            bannerflash ($urlban,$lid,$width,$height);

		        } else  {

		            echo"<img src=$urlban width=$width height=$height border=\"0\"><a/>";

                }

			    echo"<br>";

              }  else {

               echo"<br><br><a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\"  target=\"new\" >";

		       if (strpos($urlban,"swf")==TRUE) {

		          $image_size_flash = getimagesize("$urlban");

                  $width=$image_size_flash[0];

                  $height=$image_size_flash[1];

		          bannerflash ($urlban,$lid,$width,$height);

			    } else  {

		           echo"<img src=$urlban border=\"0\"><a/>";

                }

	            echo"<br>";

	          }

	          echo"</td></tr><tr><td>";

            }

	        echo""._CATEGORY.":</td><td><select name='catid'>";

	        writeOptionList( "".$prefix."_top_sites_categories", $catid );

		    echo "</select><br>"

		   ."</td></tr><tr><td>"

	       .""._DESCRIPTION.":</td><td><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea>"

	       ."</td></tr><tr><td>";

    		$modpath .= "modules/Web_Links/index.php";

            

		    if ($weblinkoption == 1 && file_exists($modpath)) {

		      if ($makeweblink==3) {

			    echo""._MAKEWEBLINK2.":</td><td>";

			    echo""._MAKEWEBLINKREFUSED."";

				$makeweblink=3;

				echo"</td></tr>";

			   } else if ($makeweblink==4) {

			     echo""._MAKEWEBLINK2.":</td><td>";

			     echo""._MAKEWEBLINKAPPROVED."";

			     $makeweblink=4;

				 echo"</td></tr>";

			   } else {

			     echo"<input type=\"hidden\" name=\"makeweblink\" value=\"$makeweblink\">";

			   }	 

            } else {

			  echo"<input type=\"hidden\" name=\"makeweblink\" value=\"$makeweblink\">";

			}

		echo"</td></tr>"; 		

		echo"<tr><td>"   

    	."<input type=\"hidden\" name=\"lid\" value=\"$lid\">"

		."<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">"

		."<input type=\"hidden\" name=\"email\" value=\"$email\">"

		."<input type=\"hidden\" name=\"hits\" value=\"$hits\">"

		."<input type=\"hidden\" name=\"totalvotes\" value=\"$totalvotes\">"

		."<input type=\"hidden\" name=\"linkratingsummary\" value=\"$linkratingsummary\">"

		."<input type=\"hidden\" name=\"adminrate\" value=\"$adminrate\">"

		."<input type=\"hidden\" name=\"mailsent\" value=\"$mailsent\">"

		."<input type=\"hidden\" name=\"weblinkcat\" value=\"$weblinkcat\">"

	   ."<input type=\"hidden\" name=\"op\" value=\"modifylinks\">"

	    ."<input type=\"submit\" value=\""._MODIFY."\"><br>"

		."</td></tr></table>"

		."</form><br>";

    }

   CloseTable();

    echo "<br>"; 

   } else {

    	echo "<center>"._LINKSNOTUSER1."<br>"

	    .""._LINKSNOTUSER2."<br><br>"

        .""._LINKSNOTUSER3."";

		CloseTable();

      echo "<br>";

   }

	 include_once("footer.php");

}



function modifylinks($lid, $title, $catid,$url, $urlban,$imagewidth,$imageheight,$description,$email, $hits,$totalvotes,$submitter,$linkratingsummary,$adminrate,$makeweblink,$weblinkcat) {

    global $prefix, $db,$module_name,$user;

	$result_config = $db->sql_query("SELECT flashbanoption from ".$prefix."_top_sites_config");

    list($flashbanoption) = $db->sql_fetchrow($result_config);

	$flashbanoption =intval($flashbanoption);

	$result = $db->sql_query("select url from ".$prefix."_top_sites where url='$url' and lid<>'$lid' and validation='Y'");

    $numrows = $db->sql_numrows($result);

    if ($numrows>0) {

	   include_once("header.php");

       title("$sitename: "._TOPSINDEX."");

	   menu();

	   echo "<br>";

	   OpenTable();

	   echo "<META HTTP-EQUIV=\"refresh\" content=\"4;URL=javascript:history.go(-1)\">"

	   ."<center><strong>"._LINKALREADYEXT."</strong><br><br>";

	   CloseTable();

	   include_once("footer.php");

    } else {

	if ($title=="" OR $description=="" OR $url=="") {

	       include_once("header.php");

           title("$sitename: "._TOPSINDEX."");

	      menu();

	     echo "<br>";

	     OpenTable();

	     echo "<META HTTP-EQUIV=\"refresh\" content=\"4;URL=javascript:history.go(-1)\">"

	    ."<center><strong>"._FIELDNOEMPTY."</strong><br><br>";

	    CloseTable();

	     include_once("footer.php");

    }

	if ($flashbanoption==0 && strpos($urlban,"swf")==TRUE) {

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._NOFLASHBANACCEPTED."</strong><br><br>";

	CloseTable();

	include_once("footer.php");

	} 

	

	if ($urlban) {

	$image_size = getimagesize("$urlban");

    $imagewidth=$image_size[0];

    $imageheight=$image_size[1];

	}

       $title = htmlspecialchars(stripslashes(FixQuotes($title)));

       $url = htmlspecialchars(stripslashes(FixQuotes($url)));

	   $urlban = htmlspecialchars(stripslashes(FixQuotes($urlban)));

       $description = htmlspecialchars(stripslashes(FixQuotes($description)));

	   $db->sql_query("update ".$prefix."_top_sites set lid='$lid',title='$title', catid='$catid', url='$url', urlban='$urlban',imagewidth='$imagewidth', imageheight='$imageheight',description='$description', email='$email', hits='$hits',totalvotes='$totalvotes', submitter='$submitter',linkratingsummary='$linkratingsummary',adminrate='$adminrate',makeweblink='$makeweblink',weblinkcat='$weblinkcat' where lid=$lid");

	  Header("Location: modules.php?name=$module_name");

	}

}



function dellink($lid,$ok=0) {

    global $prefix, $db, $module_name,$user,$userinfo;

	$lid =intval($lid);

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

	echo "<br>";

    OpenTable();

	if (is_user($user) ) {

	   getusrinfo($user);

	   $submitter="$userinfo[username]";

	   if($ok) {

	       $db->sql_query("delete from ".$prefix."_top_sites where lid='$lid' and submitter='$submitter'");

           echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=modules.php?name=$module_name\">"

	       ."<center><strong>"._LINKDELETED."</strong><br><br>";       

    	} else {

		    echo "<center>"._REMOVELINK."";

	        echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"modules.php?name=Top_Sites&op=dellink&amp;lid=$lid&amp;ok=1\">"._YES."</a> ]</center>";

        }

    } else {

       echo "<center>"._LINKSNOTUSER1."<br>"

	   .""._LINKSNOTUSER2."<br><br>"

       .""._LINKSNOTUSER3."";

    }

	Closetable();

      include_once("footer.php");

}



function LastLinks() {

    global $prefix, $db,$module_name;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    $result_config = $db->sql_query("SELECT latest,altbgcolor1,altbgcolor2 from ".$prefix."_top_sites_config");

    list($latest,$altbgcolor1,$altbgcolor2) = $db->sql_fetchrow($result_config);

	$latest =intval($latest);

    menu();

    echo "<br>";

    OpenTable();

	$color = $altbgcolor1;

    echo "<center><font class=\"option\"><strong>"._THE." $latest "._LATEST2."</strong></font></center><br>"

	. "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><font class=\"content\">"

    ."<tr bgcolor=$color>"

    ."<td width=\"41%\">"._TITLE."</td>"

	."<td width=\"23%\">"._CATEGORY."</td>"

    ."<td width=\"15%\"><div align=\"center\">"._ADDED."</div></td>"

	."<td width=\"21%\"><div align=\"center\"><img src=\"modules/$module_name/images/stats.gif\" border=\"0\"></div></td>"

    ."</tr>";

	$result4=$db->sql_query("select lid, title, catid,urlban,description, date, hits, linkratingsummary, totalvotes, validation from ".$prefix."_top_sites where validation='Y' order by lid desc limit $latest");

   while($row4 = $db->sql_fetchrow($result4)) {

			$lid = intval($row4['lid']);

			$catid = intval($row4['catid']);

			$title = stripslashes($row4['title']);

			$urlban = stripslashes($row4['urlban']);			

			$description = stripslashes($row4['description']);

			$time = $row4['date'];

			$hits = intval($row4['hits']);

			$linkratingsummary = $row4['linkratingsummary'];

			$totalvotes = intval($row4['totalvotes']);

			$validation = stripslashes($row4['validation']);

		

		$result2=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid='$catid'");

        $row5 = $db->sql_fetchrow($result2);

        $catname = $row5['catname'];

  	    if ($color == $altbgcolor1) { $color = $altbgcolor2; }

        else if ($color== $altbgcolor2) { $color = $altbgcolor1; }

	    echo"<tr bgcolor=$color>"

        ."<td><img src=\"modules/$module_name/images/urlgo.gif\" border=\"0\"> <a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\" target=\"new\">$title</a></td>"

	    ."<td>$catname</a></td>";

    	setlocale (LC_TIME, '$locale');

	    preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);

	    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	    $datetime = ucfirst($datetime);

	   echo"<td><div align=\"center\">$datetime</div></td>";

	   if ($totalvotes == 0 OR $totalvotes == 1) { $votestring = _VOTE;}

	   else { $votestring = _VOTES; 	}

       echo "<td>( $totalvotes $votestring - $hits "._HITS.")</td>"

	   ."</tr>";

    }

    echo "</table>";

    CloseTable();

    include_once("footer.php");

}

	

function visit($lid) {

    global $prefix, $db;

	$lid=intval($lid);

    $db->sql_query("update ".$prefix."_top_sites set hits=hits+1 where lid='$lid'");

    $result = $db->sql_query("select url from ".$prefix."_top_sites where lid='$lid'");

    list($url) = $db->sql_fetchrow($result);

    Header("Location:  $url");

}



function Searching () {

global $module_name;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    menu();

   echo "<br>";

   OpenTable();

   echo "<center><form action=\"modules.php?name=$module_name&op=search&amp;query=$query\" method=\"post\">"

   ."<font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></font>"

   ."</form></center>";

   CloseTable();

   include_once("footer.php");

}



function search($query, $min, $orderby, $show) {

    global $prefix, $db, $module_name,$admin, $bgcolor2;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

	$result_config = $db->sql_query("SELECT perpage,linksresults from ".$prefix."_top_sites_config");

    list($perpage,$linksresults) = $db->sql_fetchrow($result_config);

	$perpage =intval($perpages);

	$linksresults =intval($linksresults);

	if (!isset($min)) $min=0;

    if (!isset($max)) $max=$min+$linksresults;

	$orderby = "title ASC";

    if ($show!="") {

	   $linksresults = $show;

    } else {

	   $show=$linksresults;

    }

    $query = addslashes($query);

    $result6 = $db->sql_query("select lid,catid,title, catid,url,urlban,description, date, hits, linkratingsummary, totalvotes,validation,adminrate from ".$prefix."_top_sites where  title LIKE '%$query%' OR description LIKE '%$query%' AND validation='Y' ORDER BY $orderby LIMIT $min,$linksresults");

    $fullcountresult=$db->sql_query("select * from ".$prefix."_top_sites where title LIKE '%$query%' OR description LIKE '%$query%' AND validation='Y'");

    $totalselectedlinks = $db->sql_numrows($fullcountresult);

    $nrows  = $db->sql_numrows($result6);

    $x=0;

    $the_query = htmlspecialchars(stripslashes($query));

    $the_query = str_replace("\'", "'", $the_query);

    menu(1);

    echo "<br>";

    OpenTable();

    if ($query != "") {

    	if ($nrows>0) {

		   echo "<font class=\"option\">"._SEARCHRESULTS4.": <strong>$the_query</strong></font><br><br>";

    	   while($row6 = $db->sql_fetchrow($result6)) {

			$lid = intval($row6['lid']);

			$catid = intval($row6['catid']);

			$title = stripslashes($row6['title']);

			$url = stripslashes($row6['url']);

			$urlban = stripslashes($row6['urlban']);			

			$description = stripslashes($row6['description']);

			$time = $row6['date'];

			$hits = intval($row6['hits']);

			$linkratingsummary = $row6['linkratingsummary'];

			$totalvotes = intval($row6['totalvotes']);

			$validation = stripslashes($row6['validation']);

			$adminrate = stripslashes($row6['adminrate']);

		   

		   $result_1=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid=$catid");

            $row = $db->sql_fetchrow($result_1);

            $catname = $row['catname'];

	       $title = preg_replace('#'.$query.'#', "$query", $title);

	       echo "<img src=\"modules/$module_name/images/urlgo.gif\" border=\"0\"> <a href=\"modules.php?name=$module_name&op=visit&amp;lid=$lid\" target=\"new\">$title</a>"

	       ." ( <img src=\"modules/$module_name/images/stats.gif\" border=\"0\"> ";

	       if ($totalvotes == 0 OR $totalvotes == 1) {

	          $votestring = _VOTE;

           } else {

	          $votestring = _VOTES;

           }

           echo " $totalvotes $votestring"

	       ." - $hits "._HITS." )"

		   ."<br>";

	       $description = preg_replace('#'.$query.'#', "<strong>$query</strong>", $description);

	       echo ""._DESCRIPTION.": $description<br>";

	       echo ""._CATEGORY.": $catname<br>";

		   setlocale (LC_TIME, '$locale');

	       preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);

	       $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

	       $datetime = ucfirst($datetime);

	       echo ""._ADDEDON.": $datetime "

           ."<br>"

           ."<a href=\"modules.php?name=$module_name&op=ratelink&amp;lid=$lid\">"._RATESITE."</a> | "

    	   . "<a href=\"modules.php?name=$module_name&op=outsidelinksetup&amp;lid=$lid\">"._ALLOWTORATE."</a>";

		    if ($adminrate !="" OR $adminrate !=0) { echo" | <img src=\"modules/$module_name/images/$adminrate\" border=\"0\">"; }

            echo"<br><br>";

	       $x++;

	       }

	     echo "</font>";

    } else {

	echo "<br><br><center><font class=\"option\"><strong>"._NOMATCHES."</strong></font><br><br>"._GOBACK."<br></center>";

    }

    /* Calculates how many pages exist.  Which page one should be on, etc... */

    $linkpagesint = ($totalselectedlinks / $linksresults);

    $linkpageremainder = ($totalselectedlinks % $linksresults);

    if ($linkpageremainder != 0) {

    	$linkpages = ceil($linkpagesint);

        if ($totalselectedlinks < $linksresults) {

    	    $linkpageremainder = 0;

	    }

    } else {

    	$linkpages = $linkpagesint;

    }

    /* Page Numbering */

    if ($linkpages!=1 && $linkpages!=0) {

	   echo "<br><br>"

	   .""._SELECTPAGE.": ";

	   $prev=$min-$linksresults;

	   if ($prev>=0) {

    	  echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">"

  		  ." &lt;&lt; "._PREVIOUS."</a> ]</strong> ";

   	   }

	   $counter = 1;

       $currentpage = ($max / $linksresults);

       while ($counter<=$linkpages ) {

    	    $cpage = $counter;

            $mintemp = ($perpage * $counter) - $linksresults;

            if ($counter == $currentpage) {

		       echo "<strong>$counter</strong> ";

	        } else {

		     echo "<a href=\"modules.php?name=$module_name&op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";

	        }

            $counter++;

        }

        $next=$min+$linksresults;

        if ($x>=$perpage) {

    	    echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">"

    		." "._NEXT." &gt;&gt;</a> ]</strong>";

        }

    }

    echo "<br><br><center><font class=\"content\">"

	.""._TRY2SEARCH." \"$the_query\" "._INOTHERSENGINES."<br>"

	."<a target=\"_blank\" href=\"http://www.lycos.com/cgi-bin/pursuit?query=$the_query&amp;maxhits=20\">Lycos</a> - "

	."<a target=\"_blank\" href=\"http://search.yahoo.com/bin/search?p=$the_query\">Yahoo</a>"

	."<a target=\"_blank\" href=\"http://es.linuxstart.com/cgi-bin/sqlsearch.cgi?pos=1&amp;query=$the_query&amp;language=&amp;advanced=&amp;urlonly=&amp;withid=\">LinuxStart</a> - "

	."<a target=\"_blank\" href=\"http://www.google.com/search?q=$the_query\">Google</a> - "

	."<a target=\"_blank\" href=\"http://www.linuxlinks.com/cgi-bin/search.cgi?query=$the_query&amp;engine=Links\">LinuxLinks</a> - "

	."</font>";

    } else {

	echo "<center><font class=\"option\"><strong>"._NOMATCHES."</strong></font></center><br><br>";

    }

	CloseTable();

    include_once("footer.php");

}



function outsidelinksetup($lid) {

    global $prefix,$db,$module_name,$nukeurl;

    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    $result_config = $db->sql_query("SELECT evaluation,notebyjava from ".$prefix."_top_sites_config");

    list($evaluation,$notebyjava) = $db->sql_fetchrow($result_config);

	$evaluation =intval($evaluation);

	$notebyjava =intval($notebyjava);

    menu();

    echo "<br>";

    OpenTable();

    echo "<center><font class=\"option\"><strong>"._PROMOTEYOURSITE."</strong></font></center><br><br>

    "._PROMOTE01."<br><br>

    <strong>1) "._TEXTLINK."</strong><br><br>

    "._PROMOTE02."<br><br>

    <center><a href=\"$nukeurl/modules.php?name=$module_name&op=ratelink&amp;lid=$lid\">"._RATETHISSITE." @ $sitename</a></center><br><br>

    <center>"._HTMLCODE1."</center><br>

    <center><i>&lt;a href=\"$nukeurl/modules.php?name=$module_name&op=ratelink&lid=$lid\"&gt;"._RATETHISSITE."&lt;/a&gt;</i></center>

    <br><br>

    "._THENUMBER." \"$lid\" "._IDREFER."<br><br>

    <strong>2) "._BUTTONLINK."</strong><br><br>

    "._PROMOTE03."<br><br>

    <center>

    <form action=\"$nukeurl/modules.php?name=$module_name\" method=\"post\">\n

	<input type=\"hidden\" name=\"lid\" value=\"$lid\">\n

	<input type=\"hidden\" name=\"op\" value=\"ratelink\">\n

	 <input type=\"image\" src=\"$nukeurl/modules/$module_name/images/image.gif\" border=\"0\" name=\"S'identifier\">\n

	</form>\n

    </center>



    <center>"._HTMLCODE2."</center><br><br>

    <table border=\"0\" align=\"center\"><tr><td align=\"left\"><i>

    &lt;form action=\"$nukeurl/modules.php?name=$module_name\" method=\"post\"&gt;<br>\n

    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"lid\" value=\"$lid\"&gt;<br>\n

    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"op\" value=\"ratelink\"&gt;<br>\n

    &nbsp;&nbsp;&lt;input type=\"image\" src=\"$nukeurl/modules/$module_name/images/image.gif\"&gt;<br>\n

    &lt;/form&gt;\n

    </i></td></tr></table>

    <br><br>";



   if ($evaluation==1) {

	echo"<strong>3) "._REMOTEFORM."</strong><br><br>

    "._PROMOTE04."

    <center>

    <form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\">

    <table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\">

    <tr><td align=\"center\"><strong>"._VOTE4THISSITE."</strong></a></td></tr>

    <tr><td>

    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">

    <tr><td valign=\"top\">

    <select name=\"rating\">

    <option selected>--</option>

	<option>10</option>

	<option>9</option>

	<option>8</option>

	<option>7</option>

	<option>6</option>

	<option>5</option>

	<option>4</option>

	<option>3</option>

	<option>2</option>

	<option>1</option>

	</select>

    </td><td valign=\"top\">

	<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">

    <input type=\"hidden\" name=\"ratinguser\" value=\"outside\">

    <input type=\"hidden\" name=\"op value=\"addrating\">

	<input type=\"submit\" value=\""._LINKVOTE."\">

    </td></tr></table>

    </td></tr></table></form>



    <br>"._HTMLCODE3."<br><br></center>



    <blockquote><i>

       &lt;form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\"&gt;<br>

    	&lt;table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\"&gt;<br>

	    &lt;tr&gt;&lt;td align=\"center\"&gt;&lt;b&gt;"._VOTE4THISSITE."&lt;/b&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;<br>

	    &lt;tr&gt;&lt;td&gt;<br>

	    &lt;table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"&gt;<br>

		&lt;tr&gt;&lt;td valign=\"top\"&gt;<br>

   		&lt;select name=\"rating\"&gt;<br>

   		&lt;option selected&gt;--&lt;/option&gt;<br>

		&lt;option&gt;10&lt;/option&gt;<br>

		&lt;option&gt;9&lt;/option&gt;<br>

		&lt;option&gt;8&lt;/option&gt;<br>

		&lt;option&gt;7&lt;/option&gt;<br>

		&lt;option&gt;6&lt;/option&gt;<br>

		&lt;option&gt;5&lt;/option&gt;<br>

		&lt;option&gt;4&lt;/option&gt;<br>

		&lt;option&gt;3&lt;/option&gt;<br>

		&lt;option&gt;2&lt;/option&gt;<br>

		&lt;option&gt;1&lt;/option&gt;<br>

		&lt;/select&gt;<br>

	    &lt;/td&gt;&lt;td valign=\"top\"&gt;<br>

		&lt;input type=\"hidden\" name=\"ratinglid\" value=\"$lid\"&gt;<br>

   		&lt;input type=\"hidden\" name=\"ratinguser\" value=\"outside\"&gt;<br>

   		&lt;input type=\"hidden\" name=\"op\" value=\"addrating\"&gt;<br>

		&lt;input type=\"submit\" value=\""._LINKVOTE."\"&gt;<br>

	    &lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br>

    	&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br>

       &lt;/form&gt;<br>

    </i></blockquote>"; 

	

    if ($notebyjava==1) {



	include_once("modules/$module_name/votebyjs.php");

	

	echo"<strong>4) "._REMOTEFORM2."</strong><br><br>"._PROMOTEVOTEBYJS.""	

	."<CENTER>"

	."<FORM name=\"notation\" action=\"modules.php?name=$module_name&op=addrating\" method=\"post\">"

	."<B>"._GIVEANOTE."<br></B><br>"

	."<SCRIPT language=\"javascript\">\n"

	."note.Affiche();\n"

	."</SCRIPT>\n"

	."&nbsp;<IMG id=\"imgnote\" name=\"imgnote\" src=\"modules/Top_Sites/images/votejs/note3.gif\" alt=\"note :\" border=\"0\" width=\"15\" height=\"15\">&nbsp;&nbsp;"

	."<A href=\"javascript:NoteScript()\" onmouseover=\"document.images['okvote'].src='modules/Top_Sites/images/votejs/btnokon.gif'\" onmouseout=\"document.images['okvote'].src='modules/Top_Sites/images/votejs/btnokoff.gif'\"><IMG id=\"okvote\" name=\"okvote\""

	."src=\"modules/Top_Sites/images/votejs/btnokoff.gif\" alt=\"Noter ce site\" border=\"0\"  width=\"18\" height=\"18\"></A>"

	."<BR>1 "._CHOOSEANOTE."<BR> 2 "._CLICKONOK.".<BR>"

	."<INPUT type=hidden name=rating size=3>"	

 	."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"

    ."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"

    ."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">"

	."</FORM>"

	."</CENTER>";

	

	

        echo"<center>

		<a href=\"modules.php?name=$module_name&op=outsidelinksetup_js&amp;lid=$lid\"><strong>"._CODEVOTEBYJSHERE."</strong></a>

		</center>";

    }

}

    

    echo"<br><br><center>

    "._PROMOTE05."<br><br>

    $sitename "._STAFF."

    <br><br></center>";

	CloseTable();

    include_once("footer.php");

}



function outsidelinksetup_js($lid) {

    global $prefix,$db,$module_name,$nukeurl;

    include_once("header.php");

    $result_config = $db->sql_query("SELECT evaluation from ".$prefix."_top_sites_config");

    list($evaluation) = $db->sql_fetchrow($result_config);

	$evaluation =intval($evaluation);

    menu();

    echo "<br>";

    OpenTable();

	if ($evaluation==1) {

    	echo "<center><font class=\"option\"><strong>"._PROMOTEYOURSITE." (javascript)</strong></font></center><br><br>";

		

		echo"

		<blockquote><i>

		&lt;SCRIPT LANGUAGE=\"JavaScript\"&gt;<br><br>

        // Script créé par et pour Tout JavaScript.com http://www.toutjavascript.com<br>

       // Utilisation gratuite à condition de laisser les commentaires d'origine<br>

      // CreerCurseur(nom,min,max,pas,largeur,hauteur,gifon,gifoff,gifmoins,gifplus,delai)<br><br>

      var notebis=new CreerCurseurbis(\"notebis\",0,10,1,5,9,\"$nukeurl/modules/Top_Sites/images/votejs/curson.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/cursoff.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/moins.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/plus.gif\",200);<br><br>



    function CreerCurseurbis(nom,min,max,pas,largeur,hauteur,gifon,gifoff,gifmoins,gifplus,delai) {<br>

	this.nom=nom; this.valeur=Math.round((max-min)/2+2); this.action=0; this.delai=delai;<br>

	this.min=min; this.max=max; this.pas=pas;<br>

	this.largeur=largeur; this.hauteur=hauteur;<br>

	this.gifon=gifon; this.gifoff=gifoff; this.gifmoins=gifmoins; this.gifplus=gifplus;<br>

    this.Plus=PlusCurseurbis; this.Moins=MoinsCurseurbis; this.Affecte=AffecteCurseurbis;<br>

	this.Affiche=AffCurseurbis;<br>

	this.Update=UpdateCurseurbis;<br><br>

}



       // Cette fonction est appelée par le bouton OK pour valider la note<br>

       function NoteScriptbis() {<br>

		document.forms[\"notationbis\"].elements[\"rating\"].value=notebis.valeur;<br>

		// faire le submit si vous voulez envoyer la note au serveur<br>

		document.forms[\"notationbis\"].submit();<br>

       }<br><br>



    function AffCurseurbis() {<br>

	 var Z=\"&lt;A onmouseover='javascript:eval(&#92;\"\"+this.nom+\".action=-1&#92;\");eval(&#92;\"\"+this.nom+\".Moins()&#92;\")' onmouseout='javascript:eval(&#92;\"\"+this.nom+\".action=0&#92;\")'&gt;&lt;IMG src='\"+this.gifmoins+\"' border=0 height=\"+this.hauteur+\" alt='MOINS  !'&gt;&lt;/A&gt;&nbsp;\";<br>

	 for (var i=this.min;i&lt;this.max;i++) {<br>

      if (i&lt;this.valeur) {gif=this.gifon;} else {gif=this.gifoff;}<br>

	  Z+=\"&lt;A onmouseover='javascript:eval(&#92;\"\"+this.nom+\".Affecte(\"+((i+1)*this.pas)+\")&#92;\")'&gt;\";<br> 

	  Z+=\"&lt;IMG name=\"+this.nom+i+\" src='\"+gif+\"' width=\"+this.largeur+\" height=\"+this.hauteur+\" border=0 alt='\"+this.nom+\" : \"+(this.pas*(i+1))+\"'&gt;\";<br>

	  Z+=\"&lt;/A&gt;\";<br>

	}<br>

	Z+=\"&nbsp;&lt;A onmouseover='javascript:eval(&#92;\"\"+this.nom+\".action=1&#92;\");eval(&#92;\"\"+this.nom+\".Plus()&#92;\")' onmouseout='javascript:eval(&#92;\"\"+this.nom+\".action=0&#92;\")'&gt;&lt;IMG src='\"+this.gifplus+\"' border=0 height=\"+this.hauteur+\" alt='PLUS !'&gt;&lt;/A&gt;\";<br>

	document.write(Z);<br>

    }<br><br>

	

    function PlusCurseurbis() {<br>

	this.valeur+=this.pas;<br>

	if (this.valeur&gt;this.max) {this.valeur=this.max}<br>

	this.Update();<br>

	if (this.action==1) {setTimeout(this.nom+\".Plus()\",this.delai);}<br>

    }<br><br><br>

	

    function MoinsCurseurbis() {<br>

	this.valeur-=this.pas;<br>

	if (this.valeur&lt;this.min) {this.valeur=this.min}<br>

	this.Update();<br>

	if (this.action==-1) {setTimeout(this.nom+\".Moins()\",this.delai);}<br>

    }<br><br>

	

    function AffecteCurseurbis(val) {<br>

	this.valeur=val;<br>

	this.Update();<br>

    }<br><br>

	

    function UpdateCurseurbis() {<br>

	for (var i=this.min;i&lt;this.max;i++) {<br>

      if (i&lt;this.valeur) {gif=this.gifon;} else {gif=this.gifoff;}<br>

	  document.images[this.nom+i+\"\"].src=gif;<br>

	}<br>

	Updatebis(\"imgnote\",this.valeur,this.max);<br>

    }<br><br>

	

    function Updatebis(img,val,max) {<br>

	if (val&lt;=max) {src='$nukeurl/modules/Top_Sites/images/votejs/note4.gif'}<br>

	if (val&lt;Math.floor(max*0.8)) {src='$nukeurl/modules/Top_Sites/images/votejs/note3.gif'}<br>

	if (val&lt;Math.floor(max*0.6)) {src='$nukeurl/modules/Top_Sites/images/votejs/note2.gif'}<br>

	if (val&lt;Math.floor(max*0.3)) {src='$nukeurl/modules/Top_Sites/images/votejs/note1.gif'}<br>

	document.images[img].src=src;<br>

    }<br><br>



    function loadbis() {<br>

	if (document.images) {<br>

		this.length=load.arguments.length;<br>

		for (var i=0;i&lt;this.length;i++) {<br>

			this[i+1]=new Image();<br>

			this[i+1].src=load.arguments[i];<br>

		}<br>

	}<br>

}<br><br>



    function preloadbis() {<br>

	var temp=new loadbis(\"$nukeurl/modules/Top_Sites/images/votejs/note1.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/note2.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/note3.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/note4.gif\",\"$nukeurl/modules/Top_Sites/images/votejs/btnokon.gif\");<br>

  }<br><br>

&lt;/SCRIPT&gt;

<br><br>



	&lt;CENTER&gt;<br>

	&lt;FORM name=\"notationbis\" action=\"$nukeurl/modules.php?name=$module_name&op=addrating\" method=\"post\"&gt;<br>

	&lt;B&gt;"._GIVEANOTE."&lt;br&gt;&lt;/B&gt;&lt;br&gt;<br>

	&lt;SCRIPT language=\"javascript\"&gt;<br>

	notebis.Affiche();<br>

	&lt;/SCRIPT&gt;<br>

	&nbsp;&lt;IMG id=\"imgnote\" name=\"imgnote\" src=\"$nukeurl/modules/Top_Sites/images/votejs/note3.gif\" alt=\"note :\" border=\"0\" width=\"15\" height=\"15\"&gt;&nbsp;&nbsp;<br>

	&lt;A href=\"javascript:NoteScriptbis()\" onmouseover=\"document.images['okvote'].src='$nukeurl/modules/Top_Sites/images/votejs/btnokon.gif'\" onmouseout=\"document.images['okvote'].src='$nukeurl/modules/Top_Sites/images/votejs/btnokoff.gif'\"&gt;&lt;IMG id=\"okvote\" name=\"okvote\"<br>

	src=\"$nukeurl/modules/Top_Sites/images/votejs/btnokoff.gif\" alt=\"Noter ce site\" border=\"0\"  width=\"18\" height=\"18\"&gt;&lt;/A&gt;<br>

	&lt;BR&gt;1 "._CHOOSEANOTE."&lt;BR&gt; 2 "._CLICKONOK.".&lt;BR&gt;<br>

	&lt;INPUT type=hidden name=rating size=3&gt;<br>	

 	&lt;input type=\"hidden\" name=\"ratinglid\" value=\"$lid\"&gt;<br>

	&lt;/FORM&gt;<br>

	&lt;/CENTER&gt;<br>

	<br>

    </i></blockquote>"; 	  

	}

	

	echo"<br><br><center>

    "._PROMOTE05."<br><br>

    $sitename "._STAFF."

    <br><br></center>";

	CloseTable();

    include_once("footer.php");

}



function ratelink($lid, $user, $ttitle) {

    global $prefix, $db,$module_name, $cookie, $datetime,$admin,$nukeurl;

	$lid =intval($lid);

   	$result_config = $db->sql_query("SELECT evaluation,anonwaitdays,outsidewaitdays,useoutsidevoting,notebyjava from ".$prefix."_top_sites_config");

    list($evaluation,$anonwaitdays,$outsidewaitdays,$useoutsidevoting,$notebyjava) = $db->sql_fetchrow($result_config);

	$evaluation =intval($evaluation);

	$anonwaitdays =intval($anonwaitdays);

	$outsidewaitdays =intval($outsidewaitdays);

	$useoutsidevoting =intval($useoutsidevoting);

	$notebyjava =intval($notebyjava);

    if ($evaluation==1) {

	    include_once("header.php");

        title("$sitename: "._TOPSINDEX."");

        menu();

       echo "<br>";

       OpenTable();

	}

    $ip = getenv("REMOTE_HOST");

    if (empty($ip)) { $ip = getenv("REMOTE_ADDR"); }

    echo"<ul><font class=\"content\">";

    if(is_user($user)) {

   	   $user2 = base64_decode($user);

   	   $cookie = explode(":", $user2);

	   echo "<li>"._YOUAREREGGED."";

   	   cookiedecode($user);

	   $auth_name = $cookie[1];

    } else {

	   echo "<li>"._YOUARENOTREGGED."";

	   $auth_name = "$anonymous";

    }

if ($evaluation==1) {

	

	if ($notebyjava==1) {

	include_once("modules/$module_name/votebyjs.php");

	echo"<CENTER>"

	."<FORM name=\"notation\" action=\"modules.php?name=$module_name&op=addrating\" method=\"post\">"

	."<B>"._GIVEANOTE."<br></B><br>"

	."<SCRIPT language=\"javascript\">\n"

	."note.Affiche();\n"

	."</SCRIPT>\n"

	."&nbsp;<IMG id=\"imgnote\" name=\"imgnote\" src=\"modules/Top_Sites/images/votejs/note3.gif\" alt=\"note :\" border=\"0\" width=\"15\" height=\"15\">&nbsp;&nbsp;"

	."<A href=\"javascript:NoteScript()\" onmouseover=\"document.images['okvote'].src='modules/Top_Sites/images/votejs/btnokon.gif'\" onmouseout=\"document.images['okvote'].src='modules/Top_Sites/images/votejs/btnokoff.gif'\"><IMG id=\"okvote\" name=\"okvote\""

	."src=\"modules/Top_Sites/images/votejs/btnokoff.gif\" alt=\"Noter ce site\" border=\"0\"  width=\"18\" height=\"18\"></A>"

	."<BR>1 "._CHOOSEANOTE."<BR> 2 "._CLICKONOK.".<BR>"

	."<INPUT type=hidden name=rating size=3>"	

 	."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"

    ."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"

    ."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">"

	."</FORM>"

	."</CENTER>";

} else {

		echo "</ul>"

    	."<form method=\"post\" action=\"modules.php?name=$module_name\">"

        ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">"

        ."<tr><td width=\"25\" nowrap></td>"

        ."<tr><td width=\"25\" nowrap></td><td width=\"550\">"

        ."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"

        ."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"

        ."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">";

		

        echo"<font class=content>"._RATETHISSITE.""

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

	   ."<font class=\"content\"><input type=\"submit\" value=\""._RATETHISSITE."\"></font>"

        ."<br><br>"

        . "</tr></table></form>";

     }

	} else {

	    $rating="0";

	     $ratinglid=$lid;

	   $ratinguser=$auth_name;

	    $ratinghost_name=$ip;

	    addrating($ratinglid, $ratinguser, $rating, $ratinghost_name);

	}	    

        echo "<center>"

       ."</center>";

	   if ($evaluation==1) {

	      CloseTable();

	      include_once("footer.php");

	   }

}



function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name) {

    global $prefix, $db, $module_name,$cookie, $user;

    $passtest = "yes";

	$ratinglid = intval($ratinglid);

	$rating = intval($rating);

	

	if ($rating==0) {

	include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"4;URL=javascript:history.go(-1)\">"

	."<center><strong>"._RATINGNONULL."</strong><br><br>";

	CloseTable();

	include_once("footer.php");

    }



    include_once("header.php");

    title("$sitename: "._TOPSINDEX."");

    $result_config = $db->sql_query("SELECT evaluation,anonwaitdays,outsidewaitdays,useoutsidevoting,notebyjava from ".$prefix."_top_sites_config");

    list($evaluation,$anonwaitdays,$outsidewaitdays,$useoutsidevoting,$notebyjava) = $db->sql_fetchrow($result_config);

	$evaluation =intval($evaluation);

	$anonwaitdays =intval($anonwaitdays);

	$outsidewaitdays =intval($outsidewaitdays);

	$useoutsidevoting =intval($useoutsidevoting);

	$notebyjava =intval($notebyjava);

	

    completevoteheader();

    if(is_user($user)) {

	   $user2 = base64_decode($user);

   	   $cookie = explode(":", $user2);

	   cookiedecode($user);

	   $ratinguser = $cookie[1];

    } else if ($ratinguser=="outside") {

	    $ratinguser = "outside";

    } else {

	    $ratinguser = "$anonymous";

    }

    $results = $db->sql_query("SELECT title FROM ".$prefix."_top_sites WHERE lid='$ratinglid'");

    while ($row = $db->sql_fetchrow($results)) {

	$title = $row['title'];

         $ttitle = $title;

        /* Make sure only 1 anonymous from an IP in a single day. */

        $ip = getenv("REMOTE_HOST");

        if (empty($ip)) { $ip = getenv("REMOTE_ADDR"); }

        /* Check if Rating is Null */

        if ($rating=="--") {

	       $error = "nullerror";

            completevote($error,$ratingtimestamp);

	        $passtest = "no";

         }

        /* Check if Link POSTER is voting (UNLESS Anonymous users allowed to post) */

        if ($ratinguser != $anonymous && $ratinguser != "outside") {

    	    $result2=$db->sql_query("select submitter from ".$prefix."_top_sites where lid='$ratinglid'");

    	    while ($row2 = $db->sql_fetchrow($result2)) {

	             $ratinguserDB = $row2['submitter'];

    	         if ($ratinguserDB==$ratinguser) {

    		        $error = "postervote";

    	            completevote($error,$ratingtimestamp);

		            $passtest = "no";

    	         }

   	         }

          }

         /* Check if REG user is trying to vote twice. */

         if ($ratinguser!=$anonymous && $ratinguser != "outside") {

    	     $result3=$db->sql_query("select ratinguser from ".$prefix."_top_sites_votedata where ratinglid='$ratinglid'");

    	     while ($row3 = $db->sql_fetchrow($result3)) {

					$ratinguserDB = $row3['ratinguser'];

    	          if ($ratinguserDB==$ratinguser) {

    	             $error = "regflood";

                      completevote($error,$ratingtimestamp);

		              $passtest = "no";

	               }

              }

         }

         /* Check if ANONYMOUS user is trying to vote more than once per day. */

        if ($ratinguser==$anonymous){

       	    $result4=$db->sql_query("select * FROM ".$prefix."_top_sites_votedata WHERE ratinglid='$ratinglid' AND ratinguser='$anonymous' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$anonwaitdays'");

		    $result_4=$db->sql_query("select ratingtimestamp FROM ".$prefix."_top_sites_votedata where ratinglid=$ratinglid AND ratinguser='$anonymous' AND ratinghostname = '$ip'");

		    $anonvotecount = $db->sql_numrows($result4);

    	    if ($anonvotecount >= 1) {

    	       $error = "anonflood";

		       while ($row=$db->sql_fetchrow( $result_4 ) ) {

		             $ratingtimestamp=$row['ratingtimestamp'];

		        }

		        completevote($error,$ratingtimestamp);

                $passtest = "no";

    	     }

          }

         /* Check if OUTSIDE user is trying to vote more than once per day. */

         if ($ratinguser=="outside"){

       	     $result5=$db->sql_query("select * FROM ".$prefix."_top_sites_votedata WHERE ratinglid='$ratinglid' AND ratinguser='outside' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$outsidewaitdays'");

             $result_5=$db->sql_query("select ratingtimestamp FROM ".$prefix."_top_sites_votedata where ratinglid=$ratinglid AND ratinguser='outside' AND ratinghostname = '$ip'");

		     $outsidevotecount = $db->sql_numrows($result5);

    	     if ($outsidevotecount >= 1) {

    	        $error = "outsideflood";

		        while ($row=$db->sql_fetchrow( $result_5 ) ) {

		              $ratingtimestamp=$row['ratingtimestamp'];

		         }

                 completevote($error,$ratingtimestamp);

                $passtest = "no";

    	      }

           }

          if ($passtest == "yes") {

		  		$ratinglid = intval($ratinglid);

        		$rating = intval($rating);

	           $db->sql_query("INSERT into ".$prefix."_top_sites_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip',  now())");

	           $voteresult = $db->sql_query("select rating, ratinguser FROM ".$prefix."_top_sites_votedata WHERE ratinglid = '$ratinglid'");

	           $totalvotesDB = $db->sql_numrows($voteresult);

	           include_once("modules/$module_name/voteinclude.php");

               $db->sql_query("UPDATE ".$prefix."_top_sites SET linkratingsummary=$finalrating,totalvotes=$totalvotesDB WHERE lid = '$ratinglid'");

               $error = "none";

               completevote($error,$ratingtimestamp);

           }

		 }

           completevotefooter($ratinglid, $ttitle, $ratinguser);

           include_once("footer.php");

}



function completevoteheader(){

    menu();

    echo "<br>";

    OpenTable();

}



function completevotefooter($lid, $ttitle, $ratinguser) {

    global $prefix, $db;

    CloseTable();

}



function completevote($error,$ratingtimestamp) {

    global $prefix,$db,$module_name;

    $result_config = $db->sql_query("SELECT anonwaitdays,outsidewaitdays,useoutsidevoting,notebyjava from ".$prefix."_top_sites_config");

    list($anonwaitdays,$outsidewaitdays,$useoutsidevoting,$notebyjava) = $db->sql_fetchrow($result_config);

	$evaluation =intval($evaluation);

	$anonwaitdays =intval($anonwaitdays);

	$outsidewaitdays =intval($outsidewaitdays);

	$useoutsidevoting =intval($useoutsidevoting);

	$notebyjava =intval($notebyjava);

   	$from_date=$ratingtimestamp;

    $typedateto=1;

	$temp=elapsedTime($from_date , $to_date,$typedateto);

	$temp = floor(($temp)/((60*60*24)));

    $revote=$anonwaitdays-$temp;

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=modules.php?name=$module_name\">";

    if ($error == "none") echo "<center><font class=\"content\"><strong>"._COMPLETEVOTE1."</strong></font></center>";

	if ($error == "anonflood") echo "<center><font class=\"option\"><strong>"._COMPLETEVOTE2."<br>"._YOUCANVOTE." $revote "._DAYS."</strong></font></center><br>";

    if ($error == "regflood") echo "<center><font class=\"option\"><strong>"._COMPLETEVOTE3."</strong></font></center><br>";

    if ($error == "postervote") echo "<center><font class=\"option\"><strong>"._COMPLETEVOTE4."</strong></font></center><br>";

    if ($error == "nullerror") echo "<center><font class=\"option\"><strong>"._COMPLETEVOTE5."</strong></font></center><br>";

    if ($error == "outsideflood") echo "<center><font class=\"option\"><strong>"._COMPLETEVOTE6."<br>"._YOUCANVOTE." $revote "._DAYS."</strong></font></center><br>";

}



// function calcalate the number of days betwenn two dates

// format of dates :  YYYY-MM-DD hh:mm:ss  

function elapsedTime($from_date , $to_date,$typedateto){

 $tyear = substr($from_date, 0, 4); 

 $tmonth = substr($from_date, 5, 2); 

 $tday = substr($from_date, 8, 2); 

 $thour = substr($from_date, 11, 2); 

 $tminute = substr($from_date, 14, 2); 

 $tsecond = substr($from_date, 17, 2); 

 $from_date = mktime($thour, $tminute, $tsecond, $tmonth, $tday, $tyear);



 if ($typedateto ==1){ $to_date=time();}

 else {

 //$to_date="2003-02-25 13:52:45"; // if another day;

 $tyear = substr($to_date, 0, 4); 

 $tmonth = substr($to_date, 5, 2); 

 $tday = substr($to_date, 8, 2); 

 $thour = substr($to_date, 11, 2); 

 $tminute = substr($to_date, 14, 2); 

 $tsecond = substr($to_date, 17, 2); 

 $to_date = mktime($thour, $tminute, $tsecond, $tmonth, $tday, $tyear); 

 }

  $temp=$to_date-$from_date;

 return $temp;

 }

 

function cleanvotes() {

    global $prefix, $db,$module_name;

	$db->sql_query("delete from ".$prefix."_top_sites_votedata ");

	$db->sql_query("UPDATE ".$prefix."_top_sites SET linkratingsummary='0',totalvotes='0',hits='0'");

    echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=modules.php?name=$module_name\">";

    echo "<center><strong>"._VOTECLENED."</strong><br>";

} 





if (isset($ratinglid) && isset ($ratinguser) && isset ($rating)) {

    $ret = addrating($ratinglid, $ratinguser, $rating, $ratinghost_name);

}



switch($op) {



    case "menu":

    menu();

    break;

    

	case "rules":

    rules();

    break;

	

	case "ListCat":

    ListCat($catid,$catname);

    break;

		

	case "topcat":

	topcat();

	 break;

	 

    case "AddLink":

    AddLink();

    break;

	

	case "Add":

    Add($title, $catid,$url,$urlban,$imagewidth,$imageheight,$auth_name, $description, $email,$makeweblink,$weblinkcat);

    break;

	

	case "Editlink":

    Editink();

    break;



    case "modifylink":

    modifylink($lid,$submitter);

    break;

	

	case "modifylinks":

    modifylinks($lid,$title, $catid,$url, $urlban,$imagewidth,$imageheight,$description, $email, $hits,$totalvotes,$submitter,$linkratingsummary,$adminrate,$makeweblink,$weblinkcat);

    break;

	

	 case "dellink":

    dellink($lid,$ok);

    break;

	

	case "LastLinks":

    LastLinks();

    break;

	

	case "NewLinks":

    NewLinks($newlinkshowdays);

    break;



    case "NewLinksDate":

    NewLinksDate($selectdate);

    break;



   case "visit":

    visit($lid);

    break;



    case "search":

    search($query, $min, $orderby, $show);

    break;

	

	 case "Searching":

    Searching();

    break;

    

    case "ratelink":

    ratelink($lid, $user, $ttitle);

    break;



    case "addrating":

    addrating($ratinglid, $ratinguser, $rating, $ratinghost_name);

    break;

    

    case "outsidelinksetup":

    outsidelinksetup($lid);

    break;

	

	case "outsidelinksetup_js":

    outsidelinksetup_js($lid);

    break;

		    

    default:

    index();

    break;

}



?>

