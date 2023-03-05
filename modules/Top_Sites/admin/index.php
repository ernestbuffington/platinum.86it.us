<?php



/************************************************************************/

/* PHP-NUKE: Web Portal System                                          */

/* ===========================                                          */

/*                                                                      */

/* Top Sites V1.4                                                       */

/* Copyright (c) 2003-2004 by Sid                                       */

/* http://nuke.xanys.com                                                */

/* sid@xanys.com                                                        */

/*                                                                      */

/* Based on Web Links Hack                                              */

//* Copyright (c) 2002 by Francisco Burzi                               */

/* http://phpnuke.org                                                   */

/*                                                                      */

/* This program is free software. You can redistribute it and/or modify */

/* it under the terms of the GNU General Public License as published by */

/* the Free Software Foundation; either version 2 of the License.       */

/*                                                                      */

/************************************************************************/

/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */

/*                                                                      */

/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */

/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */

/*                                                                      */

/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */

/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */

/*                                                                      */

/* Refer to TechGFX.com for detailed information on Platinum Nuke Pro   */

/*                                                                      */

/* Platinum Nuke Pro: Expect to be impressed                                */

/************************************************************************/



if ( !defined('ADMIN_FILE') ) {

	die("Illegal Admin File Access");

}



global $prefix, $db, $admin_file;



$aid = substr("$aid", 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Top_Sites'"));

$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));

$admins = explode(",", $row['admins']);

$auth_user = 0;

for ($i=0; $i < sizeof($admins); $i++) {

	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {

		$auth_user = 1;

	}

}



if ($row2['radminsuper'] == 1 || $auth_user == 1) {

$module_name = "topsites";



function menu() {

    global $module_name, $prefix, $db, $admin_file;

    OpenTable();

	echo "<br><center><a href=\"".$admin_file.".php?op=topsites\">Administration Top Sites</a><br><br>"

    ."<font class=\"content\">[ "

	."<a href=\"".$admin_file.".php?op=topsites\">Menu</a> | "

	."<a href=\"".$admin_file.".php?op=topsitesnotvalidelink\">"._LINKNOTVALIDATE."</a> | "

    . "<a href=\"".$admin_file.".php?op=topsitesvalidelink\">"._LINKVALIDATE."</a>"

	 . " | <a href=\"".$admin_file.".php?op=topsitesaddlink\">"._ADDLINK."</a>"

	." | <a href=\"".$admin_file.".php?op=topsitescleanvotes\">"._CLEANVOTES."</a>"

	." | <a href=\"".$admin_file.".php?op=topsitescleanallsites\">"._CLEANALLSITES."</a>"

	." ]"

	."<br><br>"

	."[ "

	."<a href=\"".$admin_file.".php?op=topsitesaddcat\">"._ADDCAT."</a> | "

	."<a href=\"".$admin_file.".php?op=topsitesmodifycat\">"._MODIFYCAT."</a> | "

	."<a href=\"".$admin_file.".php?op=topsitesletter\">"._NEWSLETTER."</a> | "

	."<a href=\"".$admin_file.".php?op=topsitesconfigure\">"._PARAMETERS."</a> | "

	."<a href=\"modules.php?name=Top_Sites\">Top Sites</a> "

	." ]"

	."<br>"

	."</font>";

    CloseTable();

}



function writeOptionList( $table, $id,$orderby) {

    global $db;

    $result=$db->sql_query( "SELECT * FROM $table $orderby");

	if (!$result) { 	print "Failed To open Table";

	return false; 	}

	while ($a_row=$db->sql_fetchrow( $result ) ) {

		print "<option value='$a_row[0]'";

		if ( $id == $a_row[0] ) print "SELECTED";

		print ">$a_row[1]\n";

	}

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



function getparent($parentid,$title) {

    global $prefix,$db;

    $parentid = intval($parentid);

    $row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories where cid='$parentid'"));

	$cid = intval($row['cid']);

	$ptitle = $row['title'];

	$pparentid = intval($row['parentid']);

    $db->sql_freeresult($result);

    if ($ptitle!="") $title=$ptitle."/".$title;

    if ($pparentid!=0) {

	$title=getparent($pparentid,$title);

    }

    return $title;

}



function topsites() {

    global $prefix, $db, $admin_file;

	$orderby = "totalvotes DESC"; 

    @include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	echo"<center><strong>"._GLOBALBILAN."</strong><br></center><br>";

	$result_1=$db->sql_query("select * from ".$prefix."_top_sites where validation='Y' ");

    $numrows_1 = $db->sql_numrows($result_1);

	$result_2=$db->sql_query("select * from ".$prefix."_top_sites where validation='N' ");

    $numrows_2 = $db->sql_numrows($result_2);

	$result=$db->sql_query("select * from ".$prefix."_top_sites_categories order by catname");

	$numrows = $db->sql_numrows($result);

	if ($numrows == 0) {

	   echo "<br><strong>$numrows_1 "._LINKVALIDATE."</strong> "._AND." "

	   . "<strong>$numrows_2 "._LINKNOTVALIDATE."</strong><br>";

    } else {

	   echo "<br><strong>$numrows_1 "._LINKVALIDATE."</strong> "._AND." "

	   . "<strong>$numrows_2 "._LINKNOTVALIDATE."</strong><br>";

	   $result_config = $db->sql_query("SELECT categorie_option from ".$prefix."_top_sites_config");

       list($categorie_option) = $db->sql_fetchrow($result_config);

	   $categorie_option =intval($categorie_option);

       if ($categorie_option ==1) {

			echo"<br><br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><font class=\"content\">"

			."<tr>"

			."<td width=\"44%\">"._CATEGORY."</td>"

			."<td width=\"24%\"><div align=\"center\"><img src=\"modules/Top_Sites/images/stats.gif\" border=\"0\"></div></td>"

			."<td width=\"13%\"><div align=\"center\">"._LINKVALIDATE."</div></td>"

			."<td width=\"19%\"><div align=\"center\">"._LINKNOTVALIDATE."</div></td>"

			."</tr>";

	      	while ($row = $db->sql_fetchrow($result)) {

	             $catid = intval($row['catid']);

                 $catname = stripslashes($row['catname']);$result2 =$db->sql_query( "SELECT totalvotes,hits FROM ".$prefix."_top_sites where catid='$catid' and validation='Y'");

	             $numrows2 = $db->sql_numrows($result2);

				 $result3 =$db->sql_query( "SELECT * FROM ".$prefix."_top_sites where catid='$catid' and validation='N'");

	             $numrows3 = $db->sql_numrows($result3);

	             $vote1 = 0;

		         $vote2 = 0;

	             while ($row2 = $db->sql_fetchrow($result2)) {

	                    $vote1 = $vote1+$row2['totalvotes'];

		                $vote2 = $vote2+$row2['hits'];

	            }

				if ($numrows2 !=0) {

					$linkvalidate="$numrows2 <a href=\"".$admin_file.".php?op=topsitesvalidelink&amp;catid=$catid\"><u><IMG SRC=\"modules/Top_Sites/images/loupe.jpg\" width=\"15\" BORDER=\"0\" align=\"absmiddle\"></u></a>";

				} else {$linkvalidate="$numrows2"; }

				if ($numrows3 !=0) {

					$linknotvalidate="$numrows3 <a href=\"".$admin_file.".php?op=topsitesnotvalidelink&amp;catid=$catid\"><u><IMG SRC=\"modules/Top_Sites/images/loupe.jpg\" width=\"15\" BORDER=\"0\" align=\"absmiddle\"></u></a>";

				} else {$linknotvalidate="$numrows3"; }

				

				 echo"<tr>"

				."<td><img src=\"modules/Top_Sites/images/urlgo.gif\" border=\"0\"><strong> $catname</strong>"

				."<td><div align=\"center\">[ $vote1 Vote(s) "._AND." $vote2 hits ]</div></td>"

				."<td><div align=\"center\">$linkvalidate</div></td>"

				."<td><div align=\"center\">$linknotvalidate</div></td>"

				."</tr>";

    		}

			echo "</table>";

	    } else {}

	}

	

	echo"<br><br>";

	$result4=$db->sql_query("select lid, title, catid, date, validation from ".$prefix."_top_sites where validation='N' order by lid desc limit 10");

    $numrows4 = $db->sql_numrows($result4);

	if ($numrows4 > 0) {

		echo "<center><font class=\"option\"><strong>"._LATEST3."</strong></font></center><br>"

		. "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><font class=\"content\">"

		."<tr>"

		."<td width=\"40%\">"._TITLE."</td>"

		."<td width=\"25%\">"._CATEGORY."</td>"

		."<td width=\"15%\"><div align=\"center\">"._ADDED."</div></td>"

		."<td width=\"20%\"><div align=\"center\">"._MODIFY." / "._VALIDATE."</div></td>"

		."</tr>";

		while($row4 = $db->sql_fetchrow($result4)) {

			$lid = intval($row4['lid']);

			$catid = intval($row4['catid']);

			$title = stripslashes($row4['title']);

			$time = $row4['date'];

			if ($catid ==0) {$catname="";}

			else {					

				$result5=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid='$catid'");

				$row5 = $db->sql_fetchrow($result5);

				$catname = $row5['catname'];

			}			

			echo"<tr>"

			."<td><img src=\"modules/Top_Sites/images/urlgo.gif\" border=\"0\"> <a href=\"".$admin_file.".php?op=topsitesvisit&amp;lid=$lid\" target=\"new\">$title</a></td>"

			."<td>$catname</a></td>";

			setlocale (LC_TIME, '$locale');

			preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);

			$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));

			$datetime = ucfirst($datetime);

		   echo"<td><div align=\"center\">$datetime</div></td>";

		   echo"<td><div align=\"center\">"

		   ."<a href=\"".$admin_file.".php?op=topsitesmodifylink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/editicon.gif\" BORDER=0 alt=\""._EDITLINK."/"._MODIFY."\"></u></a>"

			."  <a href=\"".$admin_file.".php?op=topsitesdellink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/delete.gif\" BORDER=0 alt=\""._DEL."\"></u></a>"

			."</div></td>"

		   ."</tr>";

    	}

		echo "</table>";

	} else { echo"<center>"._NOLINKTOVALIDATE."</centr>";}

	

    CloseTable();

    @include_once("footer.php");

}



function topsitesnotvalidelink() {

    global $prefix, $db, $catid, $admin_file;

	$result_config = $db->sql_query("SELECT categorie_option from ".$prefix."_top_sites_config");

    list($categorie_option) = $db->sql_fetchrow($result_config);

	$categorie_option =intval($categorie_option);

    if ($categorie_option ==0 OR !$catid) { $catid="0";}

    @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

	if ($catid==0){ $result3=$db->sql_query("select * from ".$prefix."_top_sites where validation='N' order by lid"); 

	} else { $result3=$db->sql_query("select * from ".$prefix."_top_sites where validation='N' AND catid='$catid' order by lid");

	}

    $numrows3 = $db->sql_numrows($result3);

	echo "<center><font class=\"title\"><strong>"._LINKNOTVALIDATE."</strong></font></center><br><br>";

	if ($numrows3==0) {echo"<center>"._NOLINKTOVALIDATE."</centr>";}

	else {

         echo"<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"100%\">"

         ."<tr>"

         ."<td width=\"8%\">"._NUMSITE."</td>"

         ."<td width=\"72%\">"._TITLE."</td>"

         ."<td width=\"12%\">"._MODIFY." / "._VALIDATE."</td>"

         ."<td width=\"8%\">"._DEL."</td>"

         ."</tr>"; 

         while ($row = $db->sql_fetchrow($result3)) {

               $lid = intval($row['lid']);

               $title = stripslashes($row['title']);

               echo"<tr>"

               ."<td width=\"8%\">$lid</td>"

               ."<td width=\"72%\"><a href=\"".$admin_file.".php?op=topsitesvisit&amp;lid=$lid\" target=\"new\"><strong>$title</strong></a></td>"

               ."<td><center><width=\"12%\"><a href=\"".$admin_file.".php?op=topsitesmodifylink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/editicon.gif\" BORDER=0></u></a></center></td>"

               ."<td><center><width=\"8%\"><a href=\"".$admin_file.".php?op=topsitesdellink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/delete.gif\" BORDER=0></u></a></center></td>"

              ."</tr>"; 	

         } 

         echo"</table>"; 

    }		 

    CloseTable();

    @include_once("footer.php");

}



function topsitesvalidelink() {

    global $prefix, $db, $catid, $admin_file;

	$result_config = $db->sql_query("SELECT categorie_option from ".$prefix."_top_sites_config");

    list($categorie_option) = $db->sql_fetchrow($result_config);

	$categorie_option =intval($categorie_option);

    if ($categorie_option ==0) { $catid="0";}

    @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

	if ($catid==0){ $result3=$db->sql_query("select lid, catid,title from ".$prefix."_top_sites where validation='Y'  order by lid"); 

	} 	else { 	$result3=$db->sql_query("select * from ".$prefix."_top_sites where validation='Y'  AND catid='$catid'  order by lid");	}

	$numrows3 = $db->sql_numrows($result3);

   echo "<center><font class=\"title\"><strong>"._LINKVALIDATE."</strong></font></center><br><br>";

   if ($numrows3==0) {echo"<center>"._NOLINKTOVALIDATE."</centr>";}

	else {

	echo"<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"100%\">"

   ."<tr>"

   ."<td width=\"8%\">"._NUMSITE."</td>"

   ."<td width=\"72%\">"._TITLE."</td>"

   ."<td width=\"12%\">"._MODIFY."/ "._VALIDATE."</td>"

   ."<td width=\"8%\">"._DEL."</td>"

   ."</tr>"; 

   while ($row = $db->sql_fetchrow($result3)) {

        $lid = intval($row['lid']);

        $title = stripslashes($row['title']);

        echo"<tr>"

        ."<td width=\"8%\">$lid</td>"

        ."<td width=\"72%\"><a href=\"".$admin_file.".php?op=topsitesvisit&amp;lid=$lid\" target=\"new\"><strong>$title</strong></a></td>"

       ."<td><center><width=\"12%\"><a href=\"".$admin_file.".php?op=topsitesmodifylink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/editicon.gif\" BORDER=0></u></a></center></td>"

        ."<td><center><width=\"8%\"><a href=\"".$admin_file.".php?op=topsitesdellink&amp;lid=$lid\"><u><IMG SRC=\"modules/Top_Sites/images/delete.gif\" BORDER=0></u></a></center></td>"

         ."</tr>"; 	

     } 

    echo"</table>";

}  	 

    CloseTable();

    @include_once("footer.php");

}



function topsitesaddlink() {

    global $prefix, $db, $aid, $adminmail, $admin_file;

	$result_config = $db->sql_query("SELECT weblinkoption from ".$prefix."_top_sites_config");

    list($weblinkoption) = $db->sql_fetchrow($result_config);

	$weblinkoption = intval($weblinkoption);

	@include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

    

    echo "<center><font class=\"title\"><strong>"._ADDALINK."</strong></font></center><br><br>"

   	."<form method=\"post\" action=\"".$admin_file.".php?op=topsitesadd\">"

	."<table border=\"0\"><tr><td>"

    .""._PAGETITLE.":</td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\">"

    ."</td></tr><tr><td>"

	.""._PAGEURL.":</td><td><input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\">"

    ."</td></tr><tr><td>"

    .""._URLBAN.":</td><td><input type=\"text\" name=\"urlban\" size=\"50\" maxlength=\"100\" >"

    ."</td></tr><tr><td>"	

     .""._CATEGORY."</td><td><select name='catid'>";

	 $orderby ="order by catname";

     writeOptionList( "".$prefix."_top_sites_categories", $catid,$orderby );

    echo "</select><br>"

    ."</td></tr><tr><td>"

    .""._LDESCRIPTION.":</td><td><br><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea>"

	."</td></tr><tr><td>"

	.""._ADMINRATE.":</td><td>"

	."<select name=\"adminrate\">"

    ."<option value=\"\"></option>"

    ."<option value=\"stars-1.gif\">1</option>"

    ."<option value=\"stars-2.gif\">2</option>"

    ."<option value=\"stars-3.gif\">3</option>"

    ."<option value=\"stars-4.gif\">4</option>"

    ."<option value=\"stars-5.gif\">5</option>"

    ."</select>"

	."</td></tr><tr><td>";

  // make a linkto web_links modules

	$modpath .= "modules/Web_Links/index.php";

	 if ($weblinkoption == 1 && file_exists($modpath)) {

		echo""._MAKEWEBLINK."</td><td>";

		if ($makeweblink==4) {

	        echo "<input type='radio' name='makeweblink' value='4' checked>"._YES." &nbsp;

	              <input type='radio' name='makeweblink' value='0'>"._NO."";

         } else {

	       echo "<input type='radio' name='makeweblink' value='4'>"._YES." &nbsp;

	             <input type='radio' name='makeweblink' value='0' checked>"._NO."";

         }

         echo"</td></tr><tr><td>"

		 .""._CATEGORY2."</td><td>"

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

	echo""._YOURNAME.":</td><td><input type=\"text\" name=\"auth_name\" size=\"30\" maxlength=\"60\" value=\"$aid\"><br>"

    ."</td></tr><tr><td>"

	.""._YOUREMAIL.":</td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\" value=\"$adminmail\"><br><br>"

     ."</td></tr><tr><td></td><td>"

	."<input type=\"hidden\" name=\"op\" value=\"topsitesadd\">"

    ."<input type=\"submit\" value=\""._ADDURL."\"> "._GOBACK."<br><br>"

    ."</td></tr></table>"

	."</form>";

    CloseTable();

    @include_once("footer.php");

}



function topsitesadd($title, $catid,$url, $urlban,$imagewidth,$imageheight,$auth_name, $description, $email,$adminrate,$makeweblink,$weblinkcat) {

    global $prefix, $db, $user,$lid,$parentid2,$adminmail;

	$result_config = $db->sql_query("SELECT flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$flashbanoption =intval($flashbanoption);

	$weblinkoption =intval($weblinkoption);

    $result = $db->sql_query("select url from ".$prefix."_top_sites where url='$url'");

	$url=stripslashes($url);	

    $numrows = $db->sql_numrows($result);

    if ($numrows>0) {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	. "<center><strong>"._LINKALREADYEXT."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

    } else {

	if(is_user($user)) {

	    $user2 = base64_decode($user);

	    $cookie = explode(":", $user2);

	    cookiedecode($user);

	    $submitter = $cookie[1];

    }

    if ($title=="" OR $description=="" OR $url=="") {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._FIELDNOEMPTY."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

    }

	if ($flashbanoption==0 && strpos($urlban,"swf")==TRUE) {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._NOFLASHBANACCEPTED."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

	}

	

	if ($urlban) {

	$image_size_flash = getimagesize("$urlban");

    $imagewidth=$image_size_flash[0];

     $imageheight=$image_size_flash[1];

	}



    $title = htmlspecialchars(stripslashes(FixQuotes($title)));

    $url = htmlspecialchars(stripslashes(FixQuotes($url)));

	$urlban = htmlspecialchars(stripslashes(FixQuotes($urlban)));

    $description = htmlspecialchars(stripslashes(FixQuotes($description)));

    $auth_name = htmlspecialchars(stripslashes(FixQuotes($auth_name)));

    $email = htmlspecialchars(stripslashes(FixQuotes($email)));

	

	if ($makeweblink==1) {

	      $result_weblink = $db->sql_query("select url from ".$prefix."_links_links where url='$url'");

          $numrows_weblink = $db->sql_numrows($result_weblink);

          if ($numrows_weblink>0) {

		      $makeweblink="4";

		  } else {

		      $db->sql_query("insert into ".$prefix."_links_links values (NULL, '$weblinkcat', '$parentid2', '$title', '$url', '$description', now(), '$submitter', '$email', '0','$submitter',0,0,0)");

              $makeweblink=4;

	       }		  

	   }

	

	$db->sql_query("insert into ".$prefix."_top_sites values (NULL,'$catid','$title' ,'$url', '$urlban','$imagewidth','$imageheight','$description', now(), '$email', '0','$auth_name',0,0,'Y',1,'$adminrate','$makeweblink','$weblinkcat')");

	

	@include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

    echo "<center><strong>"._LINKRECEIVED."</strong><br>";

	echo "<br>";

    CloseTable();

    @include_once("footer.php");

    }

}



function topsitesmodifylink($lid) {

    global $prefix, $db, $user, $userinfo, $admin_file;

	$result_config = $db->sql_query("SELECT resizeimage,maxwidth,maxheight,flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($resizeimage,$maxwidth,$maxheight,$flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$resizeimage = intval($resizeimage);

	$maxwidth = intval($maxwidth);

	$maxheight = intval($maxheight);

	$flashbanoption = intval($flashbanoption);

	$weblinkoption = intval($weblinkoption);	

    @include_once("header.php");

	menu();

	echo "<br>";

    OpenTable();

	$result = $db->sql_query("select title,catid, url, urlban,imagewidth,imageheight,description, email, submitter ,totalvotes,hits,linkratingsummary,validation,mailsent,adminrate,makeweblink,weblinkcat from ".$prefix."_top_sites where lid=$lid");

     echo "<center><font class=\"option\"><strong>"._MODALINK."</strong></font></center><br><br>";

     while($row3 = $db->sql_fetchrow($result)) {

			$catid = intval($row3['catid']);

			$title = stripslashes($row3['title']);

			$url = stripslashes($row3['url']);

			$urlban = stripslashes($row3['urlban']);

			$email = stripslashes($row3['email']);

			$submitter = stripslashes($row3['submitter']);			

			$description = stripslashes($row3['description']);

			$hits = intval($row3['hits']);

			$linkratingsummary = $row3['linkratingsummary'];

			$totalvotes = intval($row3['totalvotes']);

			$adminrate = stripslashes($row3['adminrate']);

			$makeweblink = intval($row3['makeweblink']);

			$weblinkcat = intval($row3['weblinkcat']);

			$mailsent = intval($row3['mailsent']);

			$validation = stripslashes($row3['validation']);

			$imagewidth =intval($row3['imagewidth']);

			$imageheight =intval($row3['imageheight']);

		

    	echo "<form action=\"".$admin_file.".php?op=topsites\" method=\"post\">"

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

         echo"<br><br><a href=\"modules.php?name=Top_Sites&op=visit&amp;lid=$lid\"  target=\"new\" >";

           if (strpos($urlban,"swf")==TRUE) {

		   bannerflash ($urlban,$lid,$width,$height);

		  } else  {

		     echo"<img src=$urlban width=$width height=$height border=\"0\"><a/>";

            }

			echo"<br>";

        }  else {

         echo"<br><br><a href=\"modules.php?name=Top_Sites&op=visit&amp;lid=$lid\"  target=\"new\" >";

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

		$orderby ="order by catname";

	    writeOptionList( "".$prefix."_top_sites_categories", $catid,$orderby );

		 echo "</select><br>"

         ."</td></tr><tr><td>"

        .""._DESCRIPTION.":</td><td><br><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea>"

	     ."</td></tr><tr><td>"

		 .""._ADMINRATE.":</td><td>"

	."<select name=\"adminrate\">";

	if ($adminrate == "") { $sel = "selected"; }

	if ($adminrate == "stars-1.gif") { $sel1 = "selected"; }

    if ($adminrate== "stars-2.gif") { $sel2 = "selected"; }

    if ($adminrate == "stars-3.gif") { $sel3 = "selected"; }

    if ($adminrate == "stars-4.gif") { $sel4 = "selected"; }

    if ($adminrate == "stars-5.gif") { $sel5 = "selected"; }

    echo"<option value=\"\" $sel> </option>"

    ."<option value=\"stars-1.gif\" $sel1 >1</option>"

    ."<option value=\"stars-2.gif\" $sel2>2</option>"

    ."<option value=\"stars-3.gif\" $sel3>3</option>"

    ."<option value=\"stars-4.gif\" $sel4>4</option>"

    ."<option value=\"stars-5.gif\" $sel5>5</option>"

    ."</select>"

	."</td></tr><tr><td>";

		 

		if ($makeweblink>0) {

		   	echo""._MAKEWEBLINK."</td><td>";

			 if ($makeweblink==1 OR $makeweblink==3) {

	           echo "<input type='radio' name='makeweblink' value='3' checked>"._MAKEWEBLINKREFUSED2." &nbsp;

	                 <input type='radio' name='makeweblink' value='4'>"._MAKEWEBLINKAPPROVED2."";

				echo"</td></tr><tr><td>"

		        .""._CATEGORY2.":</td><td>"

			    ."<select name=\"weblinkcat\">";

           	     $result2=$db->sql_query("select cid, title, parentid from ".$prefix."_links_categories order by parentid,title");

             while ($row = $db->sql_fetchrow($result2)) {

	    				$cid2 = intval($row['cid']);

	    				$ctitle2 = stripslashes($row['title']);

	    				$parentid2 = intval($row['parentid']);

		         	if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);

    	           echo "<option value=\"$cid2\"";

				   if ($cid2==$weblinkcat) echo "SELECTED";

				   echo" >$ctitle2";

             	}

		      echo "</select>"

			  ."</td></tr><tr><td>";	 

            } else if ($makeweblink==4) {

	        echo""._MAKEWEBLINKAPPROVED.""

			."</td></tr><tr><td>"

		    .""._CATEGORY2.":</td><td>"

			."<input type=\"hidden\" name=\"makeweblink\" value=\"$makeweblink\">"

			."<input type=\"hidden\" name=\"weblinkcat\" value=\"$weblinkcat\">";

			$result2=$db->sql_query("select title, parentid from ".$prefix."_links_categories where cid=$weblinkcat");

            list($ctitle2, $parentid2) = $db->sql_fetchrow($result2);  

			echo"$ctitle2"

			."</td></tr><tr><td>";  

            } 

			

		 } else {

		   	 $makeweblink=0;

			 $weblinkcat="";

		}

	     echo"Login:</td><td><input type=\"text\" name=\"submitter\" value=\"$submitter\" size=\"50\" maxlength=\"100\"><br>"

         ."</td></tr><tr><td>"

		 ."Email:</td><td><input type=\"text\" name=\"email\" value=\"$email\" size=\"50\" maxlength=\"100\"><br><br>"

         ."</td></tr><tr><td>"

	     ."Nbr Votes:</td><td>$totalvotes  <a href=\"".$admin_file.".php?op=topsitesdelvote&amp;lid=$lid\">"._DEL."</a>"

         ."</td></tr><tr><td>"

		 ."Rate:</td><td>$linkratingsummary"

         ."</td></tr><tr><td>"

		 ."Hits:</td><td>$hits <a href=\"".$admin_file.".php?op=topsitesdelhits&amp;lid=$lid\">"._DEL."</a>"

	     ."</td></tr><tr><td>"

		 .""._VALIDATE.":</td><td>";

	if ($validation=="Y") {

	echo "<input type='radio' name='validation' value='Y' checked>"._YES." &nbsp;

	<input type='radio' name='validation' value='N'>"._NO."";

    } else {

	echo "<input type='radio' name='validation' value='Y'>"._YES." &nbsp;

	<input type='radio' name='validation' value='N' checked>"._NO."";

    }

	echo"</td></tr><tr><td>"

		 ."<input type=\"hidden\" name=\"lid\" value=\"$lid\">"

       	 . "<input type=\"hidden\" name=\"totalvotes\" value=\"$totalvotes\">"

		 . "<input type=\"hidden\" name=\"hits\" value=\"$hits\">"

		 . "<input type=\"hidden\" name=\"linkratingsummary\" value=\"$linkratingsummary\">"

		 . "<input type=\"hidden\" name=\"mailsent\" value=\"$mailsent\">"

	   	."<br>"

	   ."<input type=\"hidden\" name=\"op\" value=\"topsitesmodifylinks\">"

	    ."<input type=\"submit\" value=\""._MODIFY."\">"

		."<a href=\"".$admin_file.".php?op=topsitesdellink&amp;lid=$lid\">"._DELETE."</a></center></td>"

		."</td></tr></table>"

		."</form><br>";

   }

	CloseTable();

   @include_once("footer.php"); 

}



function topsitesmodifylinks($lid, $catid,$title, $url, $urlban,$imagewidth,$imageheight,$description, $email, $hits,$totalvotes,$submitter,$linkratingsummary,$validation,$mailsent,$adminrate,$makeweblink,$weblinkcat) {

    global $prefix, $db, $user, $nukeurl, $sitename, $adminmail, $parentid2, $admin_file;

	$result_config = $db->sql_query("SELECT flashbanoption,weblinkoption from ".$prefix."_top_sites_config");

    list($flashbanoption,$weblinkoption) = $db->sql_fetchrow($result_config);

	$flashbanoption =intval($flashbanoption);

	$weblinkoption =intval($weblinkoption);

    $result = $db->sql_query("select url from ".$prefix."_top_sites where url='$url'  and lid<>$lid and validation='Y'");

    $numrows = $db->sql_numrows($result);

    if ($numrows>0) {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	. "<center><strong>"._LINKALREADYEXT."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

    } else {

	 if ($title=="" OR $description=="" OR $url=="") {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._FIELDNOEMPTY."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

    }

	if ($flashbanoption==0 && strpos($urlban,"swf")==TRUE) {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=javascript:history.go(-1)\">"

	."<center><strong>"._NOFLASHBANACCEPTED."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

	} 

	

	if ($urlban) {

	$image_size = getimagesize("$urlban");

    $imagewidth=$image_size[0];

     $imageheight=$image_size[1];

	}

	

    $title = stripslashes(FixQuotes($title));

    $url = stripslashes(FixQuotes($url));

	$urlban = stripslashes(FixQuotes($urlban));

    $description = stripslashes(FixQuotes($description));

	

	if ($makeweblink==4) {

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

	   } else  if ($makeweblink==3) {

	      $messageweblink= ""._MAKEWEBLINKREFUSED."";

		  $makeweblink=3;

	  } else { $makeweblink=$makeweblink;

	  }

	

	if ($validation =="Y" and $mailsent==0)

	{

	if (strpos($urlban,"swf")==TRUE) {$messageflash= ""._LINKFLASH." $nukeurl/modules.php?name=Top_Sites&op=visit&amp;lid=$lid"; }

	$subject = ""._YOURLINKAT." $sitename";

	$message .= ""._HELLO." $name:\n\n"._LINKAPPROVEDMSG."\n";

	$message .=""._LINKTITLE.": $title\n";

	$message .=""._URL.": $url\n";

	$message .=""._DESCRIPTION.": $description\n";

	$message .=""._YOURRATELINK." : $nukeurl/modules.php?name=Top_Sites&op=outsidelinksetup&lid=$lid\n";

	$message .="$messageflash\n";

	$message .="$messageweblink\n";

	$message .=""._THANKS4YOURSUBMISSION."\n";

	$message .=""._TEAM." $sitename\n";

	$from = "$sitename";

	 mail($email, $subject, $message, "From: $adminmail");

    $db->sql_query("update ".$prefix."_top_sites set  mailsent='1' where lid=$lid");

    }

    $db->sql_query("update ".$prefix."_top_sites set lid='$lid',catid='$catid',title='$title', url='$url', urlban='$urlban',imagewidth='$imagewidth',imageheight='$imageheight',description='$description', email='$email', hits='$hits',totalvotes='$totalvotes', submitter='$submitter', linkratingsummary='$linkratingsummary', validation='$validation',adminrate='$adminrate',makeweblink='$makeweblink',weblinkcat='$weblinkcat'  where lid='$lid'");

	Header("Location: ".$admin_file.".php?op=topsites");

	}

}



function topsitesdellink($lid,$ok=0) {

    global $prefix, $db, $user, $admin_file;

	$lid=intval($lid);

	@include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	if($ok) {

	       $db->sql_query("delete from ".$prefix."_top_sites where lid='$lid'");

           echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=".$admin_file.".php?op=topsites\">"

	       ."<center><strong>"._LINKDELETED."</strong><br><br>";       

    	} else {

		    echo "<center>"._REMOVELINK."";

	        echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=topsitesdellink&amp;lid=$lid&amp;ok=1\">"._YES."</a> ]</center>";

        }

    Closetable();

   @include_once("footer.php");

}



function topsitesvisit($lid) {

    global $prefix, $db;

	$lid=intval($lid);

    $db->sql_query("update ".$prefix."_top_sites set hits=hits+1 where lid='$lid'");

    $result = $db->sql_query("select url from ".$prefix."_top_sites where lid='$lid'");

    list($url) = $db->sql_fetchrow($result);

	$url=stripslashes($url);

    Header("Location:  $url");

}



function topsitesaddcat() {

  global $admin_file;

  @include_once("header.php");

  menu();

  echo "<br>";

  OpenTable();

    echo "<form method=\"post\" action=\"".$admin_file.".php\">"

	."<center><font class=\"option\"><strong>"._ADDCAT."</strong></font></center><br>"

    ."<table border=\"0\"><tr><td>"

	.""._CATEGORYEXIST."</td><td><select name='catid'>";

	$orderby ="order by catname";

	writeOptionList( "".$prefix."_top_sites_categories", $catid,$orderby );

	echo "</select><br>"

	."</td></tr><tr><td>"

 	.""._NAME.":</td><td><input type=\"text\" name=\"catname\" size=\"30\" maxlength=\"100\">"

	."</td></tr><tr><td>"

	."<input type=\"hidden\" name=\"op\" value=\"topsitesaddcats\">"

	."<input type=\"submit\" value=\""._ADD."\"><br>"

	."</table>"

	."</form>";

    CloseTable();

   @include_once("footer.php");

   }

    

function topsitesaddcats($catname) {

    global $prefix, $db;

    $result = $db->sql_query("select catid from ".$prefix."_top_sites_categories where catname='$catname'");

    $numrows = $db->sql_numrows($result);

 	if ($numrows>0) {

	@include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

 	echo "<br><center><font class=\"option\">"

	."<strong>"._ERRORTHECATEGORY." $catname "._ALREADYEXIST."</strong><br><br>"

	.""._GOBACK."<br><br>";

	CloseTable();

	@include_once("footer.php");

	} else {

	if ($catname=="") {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<center><strong>"._NOCATEGORYNAME."</strong><br><br>"

	.""._GOBACK."";

	CloseTable();

	@include_once("footer.php");

    }

	 @include_once("header.php");

    menu();

    echo "<br>";

	OpenTable();

	$db->sql_query("insert into ".$prefix."_top_sites_categories values (NULL, '$catname')");

    echo"<center><font class=\"option\">"._THECATEGORY." $catname "._ADDED2."</font></center><br>";

    CloseTable();

	@include_once("footer.php");

	}

 }

 

function topsitesmodifycat() {

    global $prefix, $db, $admin_file;

    $result = $db->sql_query("select * from ".$prefix."_top_sites_categories");

    $numrows = $db->sql_numrows($result);

     @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

    if ($numrows>0) {

	echo "<form method=\"post\" action=\"".$admin_file.".php\">"

	."<center><font class=\"option\"><strong>"._MODIFYCAT."</strong></font></center><br><br>";

	$result2=$db->sql_query("select catid,catname from ".$prefix."Top_Sites_categories order by catname");

	echo ""._CATEGORY.": <select name=\"catid\">";

	$orderby ="order by catname";

	writeOptionList( "".$prefix."_top_sites_categories", $catid,$orderby );

	echo "</select>"

	."<input type=\"hidden\" name=\"op\" value=\"topsitesmodifycats\">"

	."<input type=\"submit\" value=\""._MODIFY."\">"

	."</form>";

	CloseTable();

    @include_once("footer.php");

    } else {

    }

}



function topsitesmodifycats($catid) {

    global $prefix, $db, $catid, $admin_file;

   @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

	 $result=$db->sql_query("select catname from ".$prefix."_top_sites_categories where catid=$catid");

	echo"<center><font class=\"option\"><strong>"._MODIFYCAT."</strong></font></center><br><br>";

	while(list($catname) = $db->sql_fetchrow($result)) {

	    echo"<form action=\"".$admin_file.".php\" method=\"post\">"

	    .""._NAME.": <input type=\"text\" name=\"catname\" value=\"$catname\" size=\"51\" maxlength=\"50\"><br>"

	     ."<input type=\"hidden\" name=\"catid\" value=\"$catid\">"

		 

	    ."<input type=\"hidden\" name=\"op\" value=\"topsitesmodifycats_bis\">"

	    ."<table border=\"0\"><tr><td>"

	    ."<input type=\"submit\" value=\""._MODIFY."\"></form></td><td>"

	    ."<form action=\"".$admin_file.".php\" method=\"post\">"

	    ."<input type=\"hidden\" name=\"catid\" value=\"$catid\">"

		."<input type=\"hidden\" name=\"catname\" value=\"$catname\">"

	    ."<input type=\"hidden\" name=\"op\" value=\"topsitesdelcat\">"

	    ."<input type=\"submit\" value=\""._DELETE."\"></form></td></tr></table>";

		}

CloseTable();

	@include_once("footer.php");

}



function topsitesmodifycats_bis($catid,$catname) {

    global $prefix, $db;

	 @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

   $db->sql_query("update ".$prefix."_top_sites_categories set catname='$catname' where catid=$catid");

   echo"<center><font class=\"option\">"._THECATEGORY." $catname "._MODIFIED."</font></center><br>";

    CloseTable();

	@include_once("footer.php");

 }



function topsitesdelcat($catname) {

    global $prefix, $db,$catid;

	 @include_once("header.php");

    menu();

    echo "<br>";

    OpenTable();

    $db->sql_query("delete from ".$prefix."_top_sites_categories where catid='$catid'");

   echo"<center><font class=\"option\">"._THECATEGORY." $catname "._DELETED."</font></center><br>";

    CloseTable();

	@include_once("footer.php");

}



function topsitesdelvote($lid,$ok) {

    global $prefix, $db, $admin_file;

	@include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	if($ok) {

       $db->sql_query("delete from ".$prefix."_top_sites_votedata where ratinglid=$lid");

       $db->sql_query("UPDATE ".$prefix."_top_sites SET linkratingsummary=0,totalvotes=0 WHERE lid = $lid");

	   echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=".$admin_file.".php?op=topsites\">"

	   ."<center><strong>"._VOTEDELETED."</strong><br><br>";       

	 } else {

	   echo "<center>"._REMOVEVOTE."";

	   echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=topsitesdelvote&amp;lid=$lid&amp;ok=1\">"._YES."</a> ]</center>";

     }

	  Closetable();

   @include_once("footer.php");    

}



function topsitesdelhits($lid,$ok) {

    global $prefix, $db, $admin_file;

	@include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	if($ok) {

    $db->sql_query("UPDATE ".$prefix."_top_sites SET hits=0 WHERE lid = $lid");

   echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=".$admin_file.".php?op=topsites\">"

	   ."<center><strong>"._HITSDELETED."</strong><br><br>";       

	 } else {

	   echo "<center>"._REMOVEHITS."";

	   echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=topsitesdelhits&amp;lid=$lid&amp;ok=1\">"._YES."</a> ]</center>";

     }

	  Closetable();

   @include_once("footer.php");    

}



function topsitescleanvotes($ok) {

    global $prefix, $db, $admin_file;

	@include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	if($ok) {

	$db->sql_query("delete from ".$prefix."_top_sites_votedata ");

	$db->sql_query("UPDATE ".$prefix."_top_sites SET linkratingsummary='0',totalvotes='0',hits='0'");

    echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=".$admin_file.".php?op=topsites\">"

	   ."<center><strong>"._VOTEDELETED."</strong><br><br>";       

	 } else {

	   echo "<center>"._REMOVEVOTE."";

	   echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=topsitescleanvotes&amp;ok=1\">"._YES."</a> ]</center>";

     }

	  Closetable();

   @include_once("footer.php");    

}



function topsitescleanallsites($ok) {

    global $prefix, $db, $admin_file;

	@include_once("header.php");

    menu();

	echo "<br>";

    OpenTable();

	if($ok) {

	$db->sql_query("delete from ".$prefix."_top_sites_votedata ");

	$db->sql_query("delete from ".$prefix."_top_sites");

    echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=".$admin_file.".php?op=topsites\">"

	   ."<center><strong>"._CLEANSITES."</strong><br><br>";       

	 } else {

	   echo "<center>"._REMOVESITES."";

	   echo "<br><br>[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=topsitescleanallsites&amp;ok=1\">"._YES."</a> ]</center>";

     }

	  Closetable();

   @include_once("footer.php");    

}



function topsitesconfigure() {

 global $prefix, $db, $admin_file;

 @include_once("header.php");

 menu();

 $result_config = $db->sql_query("SELECT autovalidation,evaluation,perpage,linksresults,anonwaitdays,outsidewaitdays,useoutsidevoting,

              maxaffichage,categorie_option,receivemail,delafterxdays,delxdays,nextdatedeletevote,latest,

	         resizeimage,maxwidth,maxheight,altbgcolor1,altbgcolor2,flashbanoption,weblinkoption,notebyjava from ".$prefix."_top_sites_config");

 list($autovalidation,$evaluation,$perpage,$linksresults,$anonwaitdays,$outsidewaitdays,$useoutsidevoting,

         $maxaffichage,$categorie_option,$receivemail,$delafterxdays,$delxdays,$nextdatedeletevote,$latest,

	    $resizeimage,$maxwidth,$maxheight,$altbgcolor1,$altbgcolor2,$flashbanoption,$weblinkoption,$notebyjava) = $db->sql_fetchrow($result_config);

   echo "<br>";

  OpenTable();

  echo "<center><font class=\"title\"><strong>"._PARAMETERCONFIG."</strong></font></center>"

   	."<form action=\"".$admin_file.".php\" method=\"post\">"

	."<table border=\"0\"><tr><td>"

	

	.""._AUTOVALIDATION.":</td><td>";

	if ($autovalidation==1) {

	echo "<input type='radio' name='xautovalidation' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xautovalidation' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xautovalidation' value='1'>"._YES." &nbsp;

	<input type='radio' name='xautovalidation' value='0' checked>"._NO."";

    }

	echo"<br>"._AUTOVALIDATION2."<br>"

	."</td></tr><tr><td>"

	

	.""._EVALUATIONORNOT.":</td><td>";

	if ($evaluation==1) {

	echo "<input type='radio' name='xevaluation' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xevaluation' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xevaluation' value='1'>"._YES." &nbsp;

	<input type='radio' name='xevaluation' value='0' checked>"._NO."";

    }

	echo"<br>"._EVALUATIONORNOT2."<br>"

	."</td></tr><tr><td>"

	

	.""._PERPAGE.":</td><td><input type=\"text\" name=\"xperpage\" value=\"$perpage\" size=\"40\" maxlength=\"2\">"

	."<br>"._PERPAGE2."<br>"

	."</td></tr><tr><td>"

	.""._LINKSRESULT.":</td><td><input type=\"text\" name=\"xlinksresults\" value=\"$linksresults\" size=\"40\" maxlength=\"2\">"

	."<br>"._LINKSRESULT2."<br>"

	."</td></tr><tr><td>"

	.""._ANONWAITDAYS.":</td><td><input type=\"text\" name=\"xanonwaitdays\" value=\"$anonwaitdays\" size=\"40\" maxlength=\"3\">"

	."<br>"._ANONWAITDAYS2."<br>"

	."</td></tr><tr><td>"

	.""._OUTSIDEWAITDAYS.":</td><td><input type=\"text\" name=\"xoutsidewaitdays\" value=\"$outsidewaitdays\" size=\"40\" maxlength=\"3\">"

    ."<br>"._OUTSIDEWAITDAYS2."<br>"

	."</td></tr><tr><td>"

	

	.""._USEOUTSIDEVOTING.":</td><td>";

	if ($useoutsidevoting==1) {

	echo "<input type='radio' name='xuseoutsidevoting' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xuseoutsidevoting' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xuseoutsidevoting' value='1'>"._YES." &nbsp;

	<input type='radio' name='xuseoutsidevoting' value='0' checked>"._NO."";

    }

	echo"<br>"._USEOUTSIDEVOTING2."<br>"

	."</td></tr><tr><td>"

	

	.""._CATEGORYOPTION.":</td><td>";

	if ($categorie_option==1) {

	echo "<input type='radio' name='xcategorie_option' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xcategorie_option' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xcategorie_option' value='1'>"._YES." &nbsp;

	<input type='radio' name='xcategorie_option' value='0' checked>"._NO."";

    }

	echo"<br>"._CATEGORYOPTION2."<br>"

	."</td></tr><tr><td>"

	

	.""._MAXAFFICHAGE.":</td><td><input type=\"text\" name=\"xmaxaffichage\" value=\"$maxaffichage\" size=\"40\" maxlength=\"2\">"

    ."<br>"._MAXAFFICHAGE2."<br>"

	."</td></tr><tr><td>"

	

	.""._RECEIVEMAIL.":</td><td>";

	if ($receivemail==1) {

	echo "<input type='radio' name='xreceivemail' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xreceivemail' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xreceivemail' value='1'>"._YES." &nbsp;

	<input type='radio' name='xreceivemail' value='0' checked>"._NO."";

    }

	echo"<br>"._RECEIVEMAIL2."<br>"

	."</td></tr><tr><td>"

	

	.""._DELAFTERXDAYS.":</td><td>";

	if ($delafterxdays==1) {

	echo "<input type='radio' name='xdelafterxdays' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xdelafterxdays' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xdelafterxdays' value='1'>"._YES." &nbsp;

	<input type='radio' name='xdelafterxdays' value='0' checked>"._NO."";

    }

	echo"<br>"._DELAFTERXDAYS2."<br>"

	."</td></tr><tr><td>"

	

	.""._DELXDAYS.":</td><td><input type=\"text\" name=\"xdelxdays\" value=\"$delxdays\" size=\"40\" maxlength=\"3\">"

    ."<br>"._DELXDAYS2."<br>"

	."</td></tr><tr><td>"

	

	.""._DATEDELETE.":</td><td><input type=\"text\" name=\"xnextdatedeletevote\" value=\"$nextdatedeletevote\" size=\"40\" maxlength=\"30\">"

    ."<br>"._DATEDELETE2."<br>"

	."</td></tr><tr><td>"

	

	.""._NUMLATEST.":</td><td><input type=\"text\" name=\"xlatest\" value=\"$latest\" size=\"40\" maxlength=\"3\">"

    ."<br>"._NUMLATEST2."<br>"

	."</td></tr><tr><td>"

	

	.""._RESIZEIMAGE.":</td><td>";

	if ($resizeimage==1) {

	echo "<input type='radio' name='xresizeimage' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xresizeimage' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xresizeimage' value='1'>"._YES." &nbsp;

	<input type='radio' name='xresizeimage' value='0' checked>"._NO."";

    }

	echo"<br>"._RESIZEIMAGE2."<br>"

	."</td></tr><tr><td>"

	

     .""._MAXIMAGEWIDTHSIZE.":</td><td><input type=\"text\" name=\"xmaxwidth\" value=\"$maxwidth\" size=\"40\" maxlength=\"3\">"

    ."<br>"._MAXIMAGEWIDTHSIZE2."<br>"

	."</td></tr><tr><td>"

	.""._MAXIMAGEHEIGHTSIZE.":</td><td><input type=\"text\" name=\"xmaxheight\" value=\"$maxheight\" size=\"40\" maxlength=\"3\">"

    ."<br>"._MAXIMAGEHEIGHTSIZE2."<br>"

	."</td></tr><tr><td>"

	.""._ALTERNATAVECOLOR1.":</td><td><input type=\"text\" name=\"xaltbgcolor1\" value=\"$altbgcolor1\" size=\"40\" maxlength=\"7\">"

    ."<br>"._ALTERNATAVECOLOR1_2."<br>"

	."</td></tr><tr><td>"

	.""._ALTERNATAVECOLOR2.":</td><td><input type=\"text\" name=\"xaltbgcolor2\" value=\"$altbgcolor2\" size=\"40\" maxlength=\"7\">"

    ."<br>"._ALTERNATAVECOLOR2_2."<br>"

	."</td></tr><tr><td>"

	

	.""._FLASHOPTION.":</td><td>";

	if ($flashbanoption==1) {

	echo "<input type='radio' name='xflashbanoption' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xflashbanoption' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xflashbanoption' value='1'>"._YES." &nbsp;

	<input type='radio' name='xflashbanoption' value='0' checked>"._NO."";

    }

	echo"<br>"._FLASHOPTION2."<br>"

	."</td></tr><tr><td>"

	

	.""._WEBLINKOPTION.":</td><td>";

	if ($weblinkoption==1) {

	echo "<input type='radio' name='xweblinkoption' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xweblinkoption' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xweblinkoption' value='1'>"._YES." &nbsp;

	<input type='radio' name='xweblinkoption' value='0' checked>"._NO."";

    }

	echo"<br>"._WEBLINKOPTION2."<br>"

	."</td></tr><tr><td>"

	

	.""._NOTEBYJAVA.":</td><td>";

	if ($notebyjava==1) {

	echo "<input type='radio' name='xnotebyjava' value='1' checked>"._YES." &nbsp;

	<input type='radio' name='xnotebyjava' value='0'>"._NO."";

    } else {

	echo "<input type='radio' name='xnotebyjava' value='1'>"._YES." &nbsp;

	<input type='radio' name='xnotebyjava' value='0' checked>"._NO."";

    }

	echo"<br>"._NOTEBYJAVA2."<br>"

	."</td></tr>"

	

	."</table><br><br>"

	."<input type=\"hidden\" name=\"op\" value=\"topsitesconfiguresave\">"

	."<center><input type=\"submit\" value=\""._SAVECHANGES."\"></center>"

	."</form>";

    CloseTable();

    @include_once("footer.php");

}



function topsitesconfiguresave($xautovalidation,$xevaluation,$xperpage, $xlinksresults, $xanonwaitdays, $xoutsidewaitdays, $xuseoutsidevoting,$xmaxaffichage, $xcategorie_option,$xreceivemail,$xdelafterxdays,$xdelxdays,$xnextdatedeletevote,$xlatest,$xresizeimage,$xmaxwidth,$xmaxheight,$xaltbgcolor1,$xaltbgcolor2,$xflashbanoption,$xweblinkoption,$xnotebyjava) {

 global $prefix, $db, $admin_file;

 

 if ($xperpage==0 OR $xlinksresults==0 OR $xlatest==0 OR $xmaxwidth==0 OR $xmaxheight==0) {

	@include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"5;URL=javascript:history.go(-1)\">"

	."<center><strong>"._FIELDNONULL."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

    }

 // format of dates :  YYYY-MM-DD hh:mm:ss  

 $tyear = substr($xnextdatedeletevote, 0, 4); 

 $tmonth = substr($xnextdatedeletevote, 5, 2); 

 $tday = substr($xnextdatedeletevote, 8, 2); 

 $thour = substr($xnextdatedeletevote, 11, 2); 

 $tminute = substr($xnextdatedeletevote, 14, 2); 

 $tsecond = substr($xnextdatedeletevote, 17, 2); 

 $xnextdatedeletevote_1 = mktime($thour, $tminute, $tsecond, $tmonth, $tday, $tyear);

 if ($xnextdatedeletevote_1 <= time() OR $xnextdatedeletevote =="" ) {

 $xnextdatedeletevote_1=time()+$xdelxdays*24*60*60;

  $xnextdatedeletevote = strftime("%Y-%m-%d", $xnextdatedeletevote_1);

  }

 

 $db->sql_query("UPDATE ".$prefix."_top_sites_config SET autovalidation='$xautovalidation', evaluation='$xevaluation',perpage='$xperpage', linksresults='$xlinksresults',

 anonwaitdays='$xanonwaitdays', outsidewaitdays='$xoutsidewaitdays', useoutsidevoting='$xuseoutsidevoting', maxaffichage='$xmaxaffichage',

 categorie_option='$xcategorie_option', receivemail='$xreceivemail', delafterxdays='$xdelafterxdays', delxdays='$xdelxdays', nextdatedeletevote='$xnextdatedeletevote',

 latest='$xlatest',resizeimage='$xresizeimage', maxwidth='$xmaxwidth', maxheight='$xmaxheight', altbgcolor1='$xaltbgcolor1', 

 altbgcolor2='$xaltbgcolor2',flashbanoption='$xflashbanoption',weblinkoption='$xweblinkoption',notebyjava='$xnotebyjava'");

Header("Location: ".$admin_file.".php?op=topsitesconfigure");

}



function topsitesletter() {

  global $prefix, $db, $nukeurl, $sitename, $adminmail, $admin_file;

  @include_once("header.php");

  menu();			

  echo "<br>";

  OpenTable();

  echo "<center><font class=\"title\"><strong>"._NEWSLETTER1."</strong></font></center>"

   	."<form action=\"".$admin_file.".php\" method=\"post\">"

	."<table border=\"0\"><tr><td>"

	."<strong>From:</strong> $sitename"

	."</td></tr><tr><td>"

	.""._SUBJECT.":</td><td><input type=\"text\" name=\"subject\" size=\"40\" maxlength=\"80\">"

	."</td></tr><tr><td>"

	.""._NEWSLETTER2.":</td><td><textarea name=\"letter\" cols=\"60\" rows=\"5\"></textarea><br>"

    ."</td></tr><tr><td>"

	.""._NEWSLETTER3.":</td><td>"

	."<input type=\"radio\" name=\"sendrate\" value=\"1\" checked> "._YES."  "

	."<input type=\"radio\" name=\"sendrate\" value=\"0\"> "._NO.""

    ."</td></tr><tr><td>"

	.""._NEWSLETTER3.":</td><td><input type=\"text\" name=\"xemail\" value=\"$adminmail\" size=\"40\" maxlength=\"40\">"

	."</td></tr><tr><td></td><td>"

    ."<input type=\"hidden\" name=\"op\" value=\"topsitesendletter\">"

    ."<br><input type=\"submit\" value=\""._NEWSLETTER4."\"><br>"

	."</td></tr></table>"

    ."</form>";

   CloseTable();

  @include_once("footer.php");

}



function topsitesendletter($subject, $letter,$sendrate) {

    global $prefix, $sitename, $db, $nukeurl, $adminmail, $admin_file;

	$result_config = $db->sql_query("SELECT evaluation from ".$prefix."_top_sites_config");

   list($evaluation) = $db->sql_fetchrow($result_config);

   $evaluation=intval($evaluation);

   $result = $db->sql_query("select submitter,email,title,url,totalvotes,linkratingsummary,hits from ".$prefix."_top_sites where validation='Y' ");

	$from = $adminmail;

    $subject = "[$sitename Newsletter]: ".stripslashes($subject)."";

    $letter = stripslashes($letter);

	while($row3 = $db->sql_fetchrow($result)) {

			$title = stripslashes($row3['title']);

			$url = stripslashes($row3['url']);

			$email = stripslashes($row3['email']);

			$submitter = stripslashes($row3['submitter']);

			$hits = intval($row3['hits']);

			$linkratingsummary = $row3['linkratingsummary'];

			$totalvotes = intval($row3['totalvotes']);

		

	     if ($sendrate==1) {

	         $message1 ="Your Stats : \nNbr votes(IN) : $totalvotes";

	         $message2 ="Hits (OUT) : $hits";

			 if ($evaluation==1) $message3 ="Rate : $linkratingsummary";

	     }

	     $message = "Hi $submitter !\nYour site title : $title  ($url)\n\n$letter\n\n$message1\n$message2\n$message3\n\n$sitename Team\n";

		 mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());

    }

    @include_once("header.php");

	menu();

	echo "<br>";

	OpenTable();

	echo "<META HTTP-EQUIV=\"refresh\" content=\"5;URL=".$admin_file.".php?op=topsitesletter\">"

	."<center><strong>"._NEWSLETTER5."</strong><br><br>";

	CloseTable();

	@include_once("footer.php");

}  

  

switch($op) {



    case "menu":

    menu();

    break;

	

	case "topsitesvalidelink":

   topsitesvalidelink();

    break;

	

	case "topsitesnotvalidelink":

   topsitesnotvalidelink();

    break;

	

	case "topsitesvalidatelink":

	topsitesvalidatelink($lid,$validatio,$mailsentn);

	break;

	

	case "topsitesaddlink":

    topsitesaddlink();

    break;

	

	case "topsitesadd":

    topsitesadd($title, $catid,$url, $urlban,$imagewidth,$imageheight,$auth_name, $description, $email,$adminrate,$makeweblink,$weblinkcat);

    break;

	

	case "topsitesdellink":

    topsitesdellink($lid,$ok);

    break;

	

	case "topsitesvisit":

    topsitesvisit($lid);

    break;

	

	case "topsitesmodifylink":

    topsitesmodifylink($lid);

    break;

	

	case "topsitesmodifylinks":

    topsitesmodifylinks($lid,$catid,$title, $url, $urlban,$imagewidth,$imageheight,$description, $email, $hits,$totalvotes,$submitter,$linkratingsummary,$validation,$mailsent,$adminrate,$makeweblink,$weblinkcat);

    break;

	

	case "topsitescleanallsites":

    topsitescleanallsites($ok);

    break;

	

	case "topsitescleanvotes":

    topsitescleanvotes($ok);

    break;

	

	 case "topsitesdelvote":

    topsitesdelvote($lid,$ok);

    break;



	case "topsitesdelhits":

    topsitesdelhits($lid,$ok);

    break;

	

	case "topsitesconfigure":

    topsitesconfigure($lid);

    break;

	

	case "topsitesconfiguresave":

	topsitesconfiguresave($xautovalidation,$xevaluation,$xperpage, $xlinksresults, $xanonwaitdays, $xoutsidewaitdays, $xuseoutsidevoting,$xmaxaffichage, $xcategorie_option,$xreceivemail,$xdelafterxdays,$xdelxdays,$xnextdatedeletevote,$xlatest,$xresizeimage,$xmaxwidth,$xmaxheight,$xaltbgcolor1,$xaltbgcolor2,$xflashbanoption,$xweblinkoption,$xnotebyjava);

	break;

	

	case "topsitesaddcat":

    topsitesaddcat ();

    break;

	

	case "topsitesaddcats":

    topsitesaddcats($catname);

    break;

	

	case "topsitesmodifycat":

    topsitesmodifycat ();

    break;

	

	case "topsitesmodifycats":

    topsitesmodifycats ($catid);

    break;

	

	case "topsitesmodifycats_bis":

    topsitesmodifycats_bis ($catid,$catname);

    break;

	

	case "topsitesdelcat":

    topsitesdelcat($catname);

    break;

	

	case "topsitesletter":

    topsitesletter();

    break;

	

	case "topsitesendletter":

    topsitesendletter($subject, $letter,$sendrate);

    break;

	

	default:

    topsites();

    break;



}



} else {

	@include_once("header.php");

	//GraphicAdmin();

	OpenTable();

	echo "<center><strong>"._ERROR."</strong><br><br>You do not have administration permission for module Top Sites</center>";

	CloseTable();

	@include_once("footer.php");

}



?>