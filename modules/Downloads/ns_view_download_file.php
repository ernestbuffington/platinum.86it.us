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
if (preg_match("/ns_view_download_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");




function viewdownload($cid, $min, $orderby, $show) {
$cid = intval($cid);
global $prefix, $db, $admin, $module_name, $ns_theme, $mod_title, $mod_title_directory;
$result_ds = $db->sql_query("SELECT ns_dl_main_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_main_dec) = $db->sql_fetchrow($result_ds);
$result_gen = $db->sql_query("SELECT ns_dl_show_sub_cats, ns_dl_show_num, ns_dl_num_per_page, ns_dl_sort_order from ".$prefix."_ns_downloads_general");
list($ns_dl_show_sub_cats, $ns_dl_show_num, $ns_dl_num_per_page, $ns_dl_sort_order) = $db->sql_fetchrow($result_gen);
$result_sc = $db->sql_query("select ns_dl_empty_cat from ".$prefix."_ns_downloads_general");
list($ns_dl_empty_cat) = $db->sql_fetchrow($result_sc);
    include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$ns_dl_num_per_page;
    if(isset($orderby)) {
		$orderby = convertorderbyin($orderby);
    } else {
		$orderby = ns_dl_sort_order($orderby, $ns_dl_sort_order);
    }
    if ($show != "") {
		$ns_dl_num_per_page = $show;
    } else {
		$show = $ns_dl_num_per_page;
    }
    menu(1);
    echo "<a name=\"cat\">";
    ns_mod_title3("categories_links",""._CATEGORYLINKS."");    
    OpenTable();
	ns_dl_OpenTable();
	ns_dl_cat_jump($cid);
	$result_sub = $db->sql_query("select * from ".$prefix."_downloads_categories where parentid=$cid");
	$subcat = $db->sql_numrows($result_sub);


if ($subcat > 0) {
    echo "<table width=\"80%\" border=\"0\" cellspacing=\"8\" cellpadding=\"0\" align=\"center\">";
    echo "<tr>";
    $result2 = $db->sql_query("select cid, title, cdescription from ".$prefix."_downloads_categories where parentid=$cid order by title");
    $count = 0;
    while(list($cid2, $title2, $cdescription2) = $db->sql_fetchrow($result2)) {
                $cid2 = intval($cid2);
		$cnumm = "";
	if ($ns_dl_show_num == 1) {
        $cresult = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid2' && ns_disable='0'");
	    $cnumrows = $db->sql_numrows($cresult);
            if ($cnumrows < 1) {
            $cnumrows = 0;
            }
			if ($cnumrows>0){
	    		$cnumm = "&nbsp;<font class=\"content\"><strong>($cnumrows)</strong></font>";
			}
	    } else {
	    $cnumm = "";
	    }
	echo "<td width=\"50%\" valign=\"top\">";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td align=\"right\" valign=\"top\">";
	ns_dl_cat_image();
	echo "</td><td align=\"left\">";
	echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
	echo "&amp;cid=$cid2#cat\">$title2</a>$cnumm";
	categorynewdownloadgraphic($cid2);
	echo "</td></tr>";
	if ($cdescription2) {
	    echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    echo "<div align=\"justify\"><font class=\"content\">$cdescription2</font></div>";
	    echo "</td></tr>";
	} else {
	    echo "";
	}
	echo "</table>";	
	if ($ns_dl_show_sub_cats == 1) {
	$result3 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories where parentid=$cid2 order by title limit 0,5");
	$space = 0;
	while(list($cid3, $title3) = $db->sql_fetchrow($result3)) {	
                $cid3 = intval($cid3);
		$cnumm2 = "";
	if ($space == 0) {
	    echo "";
	}
    	    if ($space>0) {
		echo "";
	    }
	if ($ns_dl_show_num == 1) {
            $cresult2 = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid3' && ns_disable='0'");
	    $cnumrows2 = $db->sql_numrows($cresult2);
            if ($cnumrows2 < 1) {
            $cnumrows2 = 0;
            }
			if ($cnumrows2 > 0) {
	    		$cnumm2 = "&nbsp;<font class=\"content\"><strong>($cnumrows2)</strong></font>";
			}
	} else {
	    $cnumm2 = "";
	}
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
	ns_dl_subcat_image();
	echo "</td><td align=\"left\">";
	echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
	echo "&amp;cid=$cid3#cat\">$title3</a> $cnumm2";
	echo "</td></tr></table>";
	    $space++;
	    }
        }
	if ($count<1) {
	    echo "</td><td>&nbsp;&nbsp;</td>";
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
	echo "<td>&nbsp;</td></tr></table>";
    }
    echo "<br />"; 
}


/*

	if ($subcat > 0) {


    echo "<table width=\"80%\" border=\"0\" cellspacing=\"8\" cellpadding=\"0\" align=\"center\">";
    echo "<tr>";
	echo "<td width=\"50%\" valign=\"top\">";


    $result2 = $db->sql_query("select cid, title, cdescription from ".$prefix."_downloads_categories where parentid=$cid order by title");
    $count = 0;
    while(list($cid2, $title2, $cdescription2) = $db->sql_fetchrow($result2)) {
    $cid2 = intval($cid2);
	$cnumm = "";
	if ($ns_dl_show_num == 1) {
        $cresult = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid2' && ns_disable='0'");
	    $cnumrows = $db->sql_numrows($cresult);
            if ($cnumrows < 1) {
            	$cnumrows = 0;
            }
			if ($cnumrows>0){
	    		$cnumm = "&nbsp;<font class=\"content\"><strong>($cnumrows)</strong></font>";
			}
	    } else {
	    	$cnumm = "";
	    }


			if ($ns_dl_empty_cat == 1) {

				echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><td align=\"right\" valign=\"top\">";
				ns_dl_cat_image();
				echo "</td><td align=\"left\">";
				echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
				echo "&amp;cid=$cid2#cat\">$title2</a>$cnumm";
				categorynewdownloadgraphic($cid2);
				echo "</td></tr>";
				if ($cdescription2) {
	    			echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    			echo "<div align=\"justify\"><font class=\"content\">$cdescription2</font></div>";
	    			echo "</td></tr>";
				} else {
	    			echo "";
				}
				echo "</table>";


			} else if ($cnumrows > 0) {


				echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><td align=\"right\" valign=\"top\">";
				ns_dl_cat_image();
				echo "</td><td align=\"left\">";
				echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
				echo "&amp;cid=$cid2#cat\">$title2</a>$cnumm";
				categorynewdownloadgraphic($cid2);
				echo "</td></tr>";
				if ($cdescription2) {
	    			echo "<tr><td align=\"right\">&nbsp;</td><td>";		
	    			echo "<div align=\"justify\"><font class=\"content\">$cdescription2</font></div>";
	    			echo "</td></tr>";
				} else {
	    			echo "";
				}

				echo "</table>";

			}

/*
	if ($ns_dl_show_sub_cats == 1) {
	$result3 = $db->sql_query("select cid, title from ".$prefix."_downloads_categories where parentid=$cid2 order by title limit 0,5");
	$space = 0;
		while(list($cid3, $title3) = $db->sql_fetchrow($result3)) {	
        $cid3 = intval($cid3);
		$cnumm2 = "";
			if ($space == 0) {
	   		 	echo "";
			}
    	    if ($space>0) {
				echo "";
	    	}
			if ($ns_dl_show_num == 1) {
            	$cresult2 = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid3' $ns_view_dis");
	    		$cnumrows2 = $db->sql_numrows($cresult2);
            	if ($cnumrows2 < 1) {
            		$cnumrows2 = 0;
            	}
				if ($cnumrows2 > 0) {
	    			$cnumm2 = "&nbsp;<font class=\"content\"><strong>($cnumrows2)</strong></font>";
				}
			} else {
	    		$cnumm2 = "";
			}


			if ($ns_dl_empty_cat == 1) {

				echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
				ns_dl_subcat_image();
				echo "</td><td align=\"left\">";
				echo "<a href=\"modules.php?name=$module_name";
				echo "&d_op=viewdownload&amp;cid=$cid3#cat\">$title3</a> $cnumm2";
				echo "</td></tr></table>";

			} else {

				if ($cnumrows2 > 0) {

					echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
					echo "<tr><td align=\"right\" valign=\"top\">&nbsp;&nbsp;&nbsp;";
					ns_dl_subcat_image();
					echo "</td><td align=\"left\">";
					echo "<a href=\"modules.php?name=$module_name";
					echo "&d_op=viewdownload&amp;cid=$cid3#cat\">$title3</a> $cnumm2";
					echo "</td></tr></table>";
				}

			}

	    $space++;
	    }
    }



	if ($count<1) {
	    echo "</td><td>&nbsp;&nbsp;</td>";
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
		echo "<td>&nbsp;</td></tr></table>";
    }

    echo "<br />"; 
}
*/

$result_cn = $db->sql_query("select ns_cat_note from ".$prefix."_downloads_categories where cid=$cid");
list($ns_cat_note) = $db->sql_fetchrow($result_cn);
$ns_cat_note = stripslashes($ns_cat_note);
if ($ns_cat_note != "") {
	echo "<br /><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	echo "<tr><td><div align=\"justify\"><font class=\"content\">";
	echo "<strong>"._NSDLCATNOTE."</strong> $ns_cat_note</font></div>";
	echo "</td></tr></table><br />";
}
ns_dl_CloseTable();
$result_dl = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid'");
$ns_num_dl = $db->sql_numrows($result_dl);
if ($ns_num_dl > 0) {	   
ns_dl_OpenTable();
$orderbyTrans = convertorderbytrans($orderby);
echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">";
echo "<tr><td width=\"100%\" align=\"center\">";
    if (($mod_title == 1) && (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/sortdownloads.gif"))) {
		echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name/sortdownloads.gif\" ";
		echo "border=\"0\" title=\""._SORTDOWNLOADS."\">";
    } else {
		echo "<font class=\"title\">"._SORTDOWNLOADS."</font>";
    }
echo "<br /><br /></td></tr><tr><td width=\"100%\" align=\"center\"><strong>[ "._TITLE."</strong> <a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=titleA#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._TITLEAZ."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=titleD#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._TITLEZA."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._DATE."</strong> <a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=dateD#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._DATE2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=dateA#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._DATE1."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._RATING."</strong> <a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=ratingD#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._RATING2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=ratingA#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._RATING1."\"></span></a> <strong>]&nbsp;-&nbsp;</strong><strong>[ "._POPULARITY."</strong> <a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=hitsD#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_up.gif\" border=\"0\" title=\""._POPULARITY2."\"></span></a>&nbsp;<a href=\"modules.php?name=$module_name&d_op=viewdownload&amp;cid=$cid&amp;orderby=hitsA#cat\"><span style=\"vertical-align=-20%\"><img src=\"images/NukeStyles/EDL/mod/arrow_down.gif\" border=\"0\" title=\""._POPULARITY1."\"></span></a> <strong>]</strong><br /><br />"._DSITESSORTED.": <strong>$orderbyTrans</strong></font></center></td></tr></table>";
ns_dl_CloseTable();
$ns_view_dis = ns_dl_admin_view(2);
$result = $db->sql_query("select lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage, ns_compat, ns_des_img, ns_mirror_one, ns_mirror_two, ns_dl_down_note from ".$prefix."_downloads_downloads where cid='$cid' $ns_view_dis order by $orderby limit $min, $ns_dl_num_per_page");
$fullcountresult = $db->sql_query("select lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments from ".$prefix."_downloads_downloads where cid='$cid'");
$download_num = $db->sql_numrows($fullcountresult);
$result_rec = $db->sql_query("select ns_dl_rec from ".$prefix."_ns_downloads_recommend");
list($ns_dl_rec) = $db->sql_fetchrow($result_rec);
$x = 0;
ns_download_image();
echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr><td><font class=\"content\">";
while(list($lid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two, $ns_dl_down_note)=$db->sql_fetchrow($result)) {
    $lid = intval($lid);
    $hits = intval($hits);
    $totalvotes = intval($totalvotes);
    $totalcomments = intval($totalcomments);
	$transfertitle = preg_replace ("/ /", "_", $title); 
    echo "<a name=\"$lid\">";
    ns_dl_OpenTable();
    $downloadratingsummary = number_format($downloadratingsummary, $ns_dl_main_dec);
    $title = stripslashes($title);
    $description = stripslashes($description);
    echo "<br />";        
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
	echo "<tr><td align=\"left\" valign=\"top\">";
	ns_dl_image($lid, $title);
	echo "<a href=\"modules.php?name=$module_name&d_op=getit&amp;lid=$lid#dl\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	echo "</td>";
		if ($ns_dl_rec == 1) {
			echo "<td align=\"right\" valign=\"top\">";
			echo "<a href=\"modules.php?name=$module_name&amp;d_op=ns_dl_rec_dl&amp;cid=$cid";
			echo "&amp;lid=$lid&amp;ttitle=$title#recom\" title=\""._NSDLRECDOWNLOAD."\">";
			echo "<span style=\"vertical-align=-2\">";
			echo "<img src=\"images/NukeStyles/EDL/mod/friend.gif\" border=\"0\" ";
			echo "title=\""._NSDLRECDOWNLOAD."\"></span>&nbsp;&nbsp;"._NSDLFOOTREC."</a>&nbsp;&nbsp;";
			echo "</td>";
		}
	echo "</tr></table>";
    ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note);
    mktime (LC_TIME, $locale);
    preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
	ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two);
    ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary);
    ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments);
    detecteditorial($cid, $lid, $transfertitle, 1);
    ns_dl_admin($lid, $admin);
    ns_dl_CloseTable();
	$x++;
    }
    echo "</font>";
    $orderby = convertorderbyout($orderby);
	// Insert Pagination Codes
	ns_dl_pagination($type="view", $the_query, $cid, $download_num, $orderby, $min, $max, $show, $x);
    echo "</td></tr></table>";
    CloseTable();
    ns_dl_link_bar($maindownload = 1);
    } else {
    	ns_dl_OpenTable();
    	echo "<br /><br /><center>";    
    	echo "<font class=\"content\"><strong>"._NSDLNODOWNLOADSCAT."</strong></font>";
    	echo "</center><br /><br />";
    	ns_dl_CloseTable();
    	CloseTable();
    	ns_dl_link_bar($maindownload = 1);   
		}
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>So you don't want to give me credit eh?<br /><br />";
	echo "I didn't detect the copyright.php file again.</strong></center><br />";
    CloseTable();
    die();
    }
}





/*
    $downloadpagesint = ($download_num / $ns_dl_num_per_page);			
    $downloadpageremainder = ($download_num % $ns_dl_num_per_page);
    if ($downloadpageremainder != 0) {
    	$downloadpages = ceil($downloadpagesint);
    	if ($download_num < $ns_dl_num_per_page) {
    		$downloadpageremainder = 0;
    	}
    } else {
    	$downloadpages = $downloadpagesint;
    }
    if ($downloadpages != 1 && $downloadpages != 0) {
    	ns_dl_OpenTable();
		echo "<center>";
		if (($mod_title == 1) && (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/selectpage.gif"))) {
			echo "<br /><br />";
			echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name/selectpage.gif\" ";
			echo "border=\"0\" title=\""._SELECTPAGE."\"><br /><br />";
		} else {
        	echo "<br /><br /><strong>"._SELECTPAGE."</strong><br /><br />";
		}
	echo "</center>";

    echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr>";
    $prev = $min-$ns_dl_num_per_page;
    if ($prev >= 0) {
    	echo "<td valign=\"middle\"><a href=\"modules.php?name=$module_name";
		echo "&d_op=viewdownload&amp;cid=$cid&amp;min=$prev&amp;orderby=$orderby";
		echo "&amp;show=$show#cat\">";
    	echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\" title=\""._PREVIOUS."\">";
		echo "</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
  	}
    $counter = 1;
 	$currentpage = ($max / $ns_dl_num_per_page);
    while ($counter <= $downloadpages ) {
      	$cpage = $counter;
      	$mintemp = ($ns_dl_num_per_page * $counter) - $ns_dl_num_per_page;
      	if ($counter == $currentpage) {
			echo "<td valign=\"top\"><span style=\"vertical-align=-23%\">";
			echo "&nbsp;&nbsp;<strong>$counter</strong>&nbsp;&nbsp;</span></td>";
	    } else {
			echo "<td valign=\"top\">&nbsp;&nbsp;<span style=\"vertical-align=-23%\">";
			echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
			echo "&amp;cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show#cat\"> ";
			echo "$counter</a></span>&nbsp;&nbsp;</td>";
	    }
       	$counter++;
    }
    $next = $min + $ns_dl_num_per_page;
    if ($next >= $ns_dl_num_per_page) {
    	echo "<td valign=\"middle\">&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href=\"modules.php?name=$module_name&d_op=viewdownload";
		echo "&amp;cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show#cat\">";
    	echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\" title=\""._NEXT."\">";
		echo "</a></td>";
    }
	echo "</tr></table><br /><br /><br />";
	ns_dl_CloseTable();
    }

*/





?>
