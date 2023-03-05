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

if (!file_exists("modules/$name/settings.php")) {
	echo "Oops, you forgot to run the installation script";
	die();
}

require_once("modules/$name/settings.php");

$index = getconfigvar("rightblocks"); 

$modtitle = getconfigvar("modtitle");
$pagetitle = "- $modtitle";
require_once("mainfile.php");
$modulename = basename( dirname( __FILE__ ) );
get_lang($modulename);
require_once("modules/$name/includes/headers.php");

function index() {
	global $prefix, $db, $modulename, $adminmail, $mainprefix, $bgcolor2, $textcolor1, $admin, $currentlang;
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php");
	require_once("modules/$modulename/includes/bbstuff.php");
	$mainindex = 0;
    	mainheader($mainindex);
	$result6 = $db->sql_query("select id from ".$prefix."_".$mainprefix."_categories");
	$waiting2 = $db->sql_numrows($result6);
	if ($waiting2==0) {
	   $encoded = bin2hex("$adminmail");
       $encoded = chunk_split($encoded, 2, '%');
       $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
  	   $adminmail = str_replace("@", "(at)", $adminmail);
  	   $adminmail = str_replace(".", "(dot)", $adminmail);       
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
		    ."<tr>"
    		."<td width=\"100%\">"
    		."<h2 align=\"center\">"._NOMAINCAT.".</h2>"
    		."<p align=\"center\">"._CONTACTWEB.".<br />"
    		."<a href=\"mailto:$encoded?subject="._NOCATMESS."\">$adminmail</a></td>"
  			."</tr>"
			."</table>";
		CloseTable();
	} else {
    	OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"8\" width=\"100%\">"
			."<tr>"
    		."<td width=\"79%\" valign=\"top\">";
		OpenTable();
			echo "<center><font class=\"title\"><strong>$pagetitle - "._MAINCATEGORY." -</strong></font></center><br />"; 
			echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    $result = $db->sql_query("select id, parentid, title, description from ".$prefix."_".$mainprefix."_categories where parentid=0 order by title");
	while(list($id, $parentid, $title, $cdescription) = $db->sql_fetchrow($result)) {
       $cresult = $db->sql_query("select id from ".$prefix."_".$mainprefix."_items where parentid=$id and active = '1'");
       $cnumrows = $db->sql_numrows($cresult);
			echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$id\"><strong>$title</strong></a> ($cnumrows)</font>";
	categorynewdownloadgraphic($id);
	if ($cdescription) {
		    echo "<br /><font class=\"content\">$cdescription</font><br />";
	} else {
	    	echo "<br />";
	}
	$result2 = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories where parentid=$id order by title limit 0,".getconfigvar("maxcatlimit")."");
	$space = 0;
	while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {
	   $cresult2 = $db->sql_query("select id from ".$prefix."_".$mainprefix."_items where parentid=$cid and active = '1'");
       $cnumrows2 = $db->sql_numrows($cresult2);
    	    if ($space>0) {
			echo ",&nbsp;";
	    }
	    	echo "<font class=\"content\"><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid\">$stitle</a> ($cnumrows2)</font>";
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
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}    
	$result3 = $db->sql_query("select id from ".$prefix."_".$mainprefix."_items where language = '$unilang'  and active = '1'");
	$numrows = $db->sql_numrows($result3);
			echo "<br /><br /><center><font class=\"content\">"._THEREAREMAIN." <strong>$numrows</strong> "._ITEMS." "._AND." <strong>$waiting2</strong> "._CATEGORIES2." "._INDATABASE." </font></center>";
		CloseTable();
		$mostpopblock = getconfigvar("mostpopblock");
		$newblock = getconfigvar("newblock");
			echo "</td>";
		if ($mostpopblock == 1 OR $newblock == 1) {
    		echo "<td width=\"25%\" valign=\"top\">";
		}
		if ($newblock == 1) {
    	include_once("modules/$modulename/blocks/block-Universal_New.php");
    				$universalnewtitle = "5 Newests $simtitle";
			themesidebox($universalnewtitle, $uninewcontent);
		}
		if ($mostpopblock == 1) {
		include_once("modules/$modulename/blocks/block-Universal_Pop.php");
					$universalpoptitle = "5 Most Popular $simtitle";
			themesidebox($universalpoptitle, $unipopcontent);
		}
    		echo "</td>"
    		."</tr>"
			."</table>";
    CloseTable();
// Quick Pull
	if (getconfigvar("quickview") == 1) {
		if (getconfigvar("randomquick") == 1) {
			$quickviewnum2 = getconfigvar("quickviewnum");	
		} else {
			$quickviewnum2 = 1;
		}
		for ($i = 1; $i <= $quickviewnum2; $i++) {
		
			// Random Item Number
			if (getconfigvar("randomquick") == 1) {
		$result = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1'");
		$id_cache = array();
			while($row = $db->sql_fetchrow($result)) {
 				 $id_cache[] = $row['id'];
			}
		mt_srand((double) microtime() * 1000000);
		$random = $id_cache[rand(0,count($id_cache))];
		unset($id_cache);
			}
		$quickviewnum = getconfigvar("quickviewnum");
		$qvacharlimit = getconfigvar("qvacharlimit");
			// End Random Grab
 		if (getconfigvar("randomquick") == 1) {
 			$sqlquery = $db->sql_query("SELECT id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where id = '$random' AND language = '$unilang'  and active = '1'");
 		} else {
 			$sqlquery = $db->sql_query("SELECT id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1' order by id DESC limit 0,$quickviewnum");
 		}
 			while (list($vid, $parentid, $author, $title, $description, $votes, $rating, $comments, $content, $submitter, $date, $lastdate, $views, $bbcode_uid) = $db->sql_fetchrow($sqlquery)) {
				if ($lastdate) {
    				$overalldate = $lastdate;
    			} else {
    				$overalldate = $date;
    			}
    			if ($votes == 0) {
					$averagerating = 0;
				} else {
					$averagerating = substr($rating / $votes, 0, 4);
				}
    		$overalldate2 = FormatDate($overalldate);
    		$formatteddate = FormatDate($date);
    		$title = stripslashes($title);
    if (getconfigvar("qvarticle") == 1) {
		    $content = stripslashes($content);
    		$content2 = substr($content,0,$qvacharlimit);
			$content2 = parse_bbcode($content2,$bbcode_uid);	    		
    } else {
    		$content = stripslashes($description);
    		$content = nl2br($description);	
    		$content2 = $content;
    }
    $cattitlequery = $db->sql_query("select parentid, title from ".$prefix."_".$mainprefix."_categories where id=$parentid");
	list($parentid2,$title2)= $db->sql_fetchrow($cattitlequery);
	$title2=getparentlink($parentid2,$title2);
    		    if ($comments == 0) {
    				$comm = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">comments?</a>";
    			} else {
    				$comm = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">comments($comments)</a>";
    			}
    		//$friendlink = "<img src=\"modules/$modulename/images/friend.gif\" border=\"0\" alt=\""._FRIEND."\" title=\""._FRIEND."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a href=\"javascript:friendwindow()\">"._FRIEND."</a>";
    		$printpage = "<img src=\"modules/$modulename/images/print.gif\" border=\"0\" alt=\""._PRINTER."\" title=\""._PRINTER."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a target=\"_blank\" href=\"modules.php?name=$modulename&amp;file=print&amp;sid=$vid\">"._PRINTER."</a>";
    		$posted = "Posted by $submitter on $formatteddate ($views reads)";
    		$morelink = "($comm | $printpage $friendlink | Score: $averagerating)";
    		$popgraphic = popgraphic($views);
		$newgraphic = newdownloadgraphic($date, $time);
		$title1 = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">$title</a> $popgraphic $newgraphic";	
		$title = "$title2: $title1";
    		// Import Template
    		$ThemeSel = get_theme();
    		if (file_exists("modules/$modulename/templates/$ThemeSel-cat.html")) {
    	$tmpl_file = "modules/$modulename/templates/$ThemeSel-cat.html";
    	$thefile = implode("", file($tmpl_file));
    	$thefile = addslashes($thefile);
    	$thefile = "\$r_file=\"".$thefile."\";";
    	eval($thefile);
    	print $r_file;
 			} else {
		$tmpl_file = "modules/$modulename/templates/nuke-cat.html";
    	$thefile = implode("", file($tmpl_file));
    	$thefile = addslashes($thefile);
    	$thefile = "\$r_file=\"".$thefile."\";";
    	eval($thefile);
    	print $r_file;	
 			}
	}
		}
	} else {

	}
	// End Quick Pull
    $queuequery = $db->sql_query("select id from ".$prefix."_".$mainprefix."_queue where language = '$unilang'");
	$waiting = $db->sql_numrows($queuequery);
    if (getconfigvar("showqueue")==1) {
	OpenTable();
 	if (is_admin($admin)) {
			echo ""._WAIT1." <a href=modules.php?name=$modulename&file=admin&op=ItemQueue>$waiting</a> "._WAIT2."";
	} else {
			echo ""._WAIT1." $waiting "._WAIT2."";
	}
	CloseTable();    
	}
	}
	include_once("modules/$modulename/includes/credit-line.php");
	include_once("footer.php");
}

function CatIndex($cid, $orderby, $sortletter, $page) {
	global $prefix, $db, $modulename, $admin, $sitename, $textcolor1, $bgcolor2, $bgcolor1, $mainprefix, $start, $currentlang;
	if (isset($page)) $page = intval($page);
	if (isset($start)) $start = intval($start);
	$cid = intval($cid);
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php"); 
	require_once("modules/$modulename/includes/pagenumbering.php");
	require_once("modules/$modulename/includes/bbstuff.php");
	$perpage = getconfigvar("perpage");
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}    	
	$mainindex = 1;
    	mainheader($mainindex);
		if(isset($sortletter)) {
				$letter = "yes";
				$sortletter = $sortletter;
    		} else {
				$letter = "no";
    	}
    	if(isset($orderby)) {
			$orderby = convertorderbyin($orderby);
    	} else {
			$orderby = "title ASC";
    	}
    	$orderby2 = convertorderbyout($orderby);
		if (isset($start)) {
			$start = $start;
		} else {
			$start = 0;
		}
	if (getconfigvar("phpbb_pages") == 0) {
		list ($offset, $pages, $page, $mwpages) = generate_pagination_pages("and where parentid=$cid"); 
	}
	if (getconfigvar("nosubcats") == 1) {
		// Do nothing
	} else {		
    			OpenTable();
		$subcatcount = $db->sql_query("select * from ".$prefix."_".$mainprefix."_categories where parentid=$cid order by title");
		$subcatnum = $db->sql_numrows($subcatcount);
		if ($subcatnum==0) {
			echo "<table border=\"0\" width=\"100%\">"
			."<tr>"
		    ."<td width=\"100%\">"
		    ."<p align=\"center\"><font size=\"4\"><strong>"._NOSUBCAT.".</strong></font></td>"
			."</tr>"
			."</table>";  
		} else {
			 echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
	$subcatquery = $db->sql_query("select id, parentid, title, description from ".$prefix."_".$mainprefix."_categories where parentid=$cid order by title");
	$count = 0;
	while(list($id5, $parentid5, $title5, $cdescription5) = $db->sql_fetchrow($subcatquery)) {
       $cresult = $db->sql_query("select * from ".$prefix."_".$mainprefix."_items where parentid=$id5 and active = '1'");
       $cnumrows = $db->sql_numrows($cresult);
			echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$id5\"><strong>$title5</strong></a> ($cnumrows)</font>";
	 categorynewdownloadgraphic($id5);
	 if ($cdescription) {
		    echo "<br /><font class=\"content\">$cdescription5</font><br />";
		} else {
		    echo "<br />";
	}
	$subcatquery2 = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories where parentid=$id5 order by title limit 0,3");
	$space = 0;
	while(list($cidi, $stitlei) = $db->sql_fetchrow($subcatquery2)) {
		$cresult7 = $db->sql_query("select id from ".$prefix."_".$mainprefix."_items where parentid=$cidi AND language = '$unilang' and active = '1'");
    	$cnumrows7 = $db->sql_numrows($cresult7);
    	if ($space>0) {
			echo ",&nbsp;";
	    }
	    	echo "<font class=\"content\"><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cidi\">$stitlei</a> ($cnumrows7)</font>";
	    $space++;
		}
	if ($count<1) {
		    echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	    $dum = 1;
		}
		$count++;
	if ($count==4) {
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
	}
	CloseTable();
	}
	OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
			."<tr>"
    		."<td width=\"100%\" colspan=\"2\">";
    $cattitlequery = $db->sql_query("select parentid, title from ".$prefix."_".$mainprefix."_categories where id=$cid");
	list($parentid2,$title2)= $db->sql_fetchrow($cattitlequery);
	$title2=getparentlink($parentid2,$title2);
    $title2="<a href=modules.php?name=$modulename>"._MAIN."</a>/$title2";
    		echo "<center><font class=\"option\"><strong>"._CATEGORY.": $title2</strong></font></center>";
			echo "</td>";
			echo "</tr>";
	if (getconfigvar("sortbytype") == 1) {
  		include_once("modules/$modulename/includes/drop-down.php");
  	} else {
  		include_once("modules/$modulename/includes/links.php");
  	}
			echo "<tr>";
			echo "<td width=\"100%\" colspan=\"2\">";
			echo "<table border=\"0\" style=\"color:$textcolor1; border-collapse:collapse\" bordercolor=\"#FFFFFF\" width=\"100%\" height=\"1\" bgcolor=\"$bgcolor2\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "  <tr>";
			echo "    <td width=\"50%\" height=\"1\">"._CIITEMSFOR." $sitename</td>";
			echo "    <td width=\"50%\" height=\"1\">";
			echo "    <form method=\"POST\" action=\"modules.php\">";
			echo "      <p align=\"right\">"._CIVIEWONLY.":<br />";
			echo "      <select size=\"1\" name=\"view\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
			echo "      <option>-</option>";
				alpha($sortletter, $cid, $orderby2);
			echo "      </select></p>";
			echo "    </td>";
			echo "        </form>";
			echo "  </tr>";
			echo "  </table></center></td></tr>";
	if ($letter == "no") {
		if (getconfigvar("phpbb_pages") == 1) {
			$mainindexquery = $db->sql_query("select id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where parentid=$cid AND language = '$unilang' and active = '1' order by $orderby limit $start,$perpage");
		} else {
			$mainindexquery = $db->sql_query("select id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where parentid=$cid AND language = '$unilang' and active = '1' order by $orderby limit $offset,$perpage");		
		}
	} else {
		if (getconfigvar("phpbb_pages") == 1) {
			$mainindexquery = $db->sql_query("select id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where parentid=$cid and UPPER(title) LIKE '$sortletter%'  AND language = '$unilang' and active = '1' order by $orderby limit $start,$perpage");
	} else {
			$mainindexquery = $db->sql_query("select id, parentid, author, title, description, votes, rating, comments, content, submitter, date, lastdate, views, bbcode_uid from ".$prefix."_".$mainprefix."_items where parentid=$cid and UPPER(title) LIKE '$sortletter%'  AND language = '$unilang' and active = '1' order by $orderby limit $offset,$perpage");
	}
	}
	$mainindexqueryr = $db->sql_numrows($mainindexquery);
	if ($mainindexqueryr > 0) {
			echo "<tr>";
    		echo "<td width=\"100%\" valign=\"top\" colspan=\"2\"><font class=\"content\">\n";
 			while (list($vid, $parentid, $author, $title, $description, $votes, $rating, $comments, $content, $submitter, $date, $lastdate, $views, $bbcode_uid) = $db->sql_fetchrow($mainindexquery)) {
				if ($lastdate) {
    				$overalldate = $lastdate;
    			} else {
    				$overalldate = $date;
    			}
    			if ($votes == 0) {
					$averagerating = 0;
				} else {
					$averagerating = substr($rating / $votes, 0, 4);
				}
    		$overalldate2 = FormatDate($overalldate);
    		$formatteddate = FormatDate($date);
    		$title = stripslashes($title);
    		
    		$qvacharlimit = getconfigvar("qvacharlimit");
    if (getconfigvar("usedescript") == 0) {
		    $content = stripslashes($content);
			$content2 = parse_bbcode($content2,$bbcode_uid);	  
    } else {
		    $content = stripslashes($description);
    		$content2 = nl2br($content);
    }
    		
    		    if ($comments == 0) {
    				$comm = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">comments?</a>";
    			} else {
    				$comm = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">comments($comments)</a>";
    			}
    		//$friendlink = "<img src=\"modules/$modulename/images/friend.gif\" border=\"0\" alt=\""._FRIEND."\" title=\""._FRIEND."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a href=\"javascript:friendwindow()\">"._FRIEND."</a>";
    		$printpage = "<img src=\"modules/$modulename/images/print.gif\" border=\"0\" alt=\""._PRINTER."\" title=\""._PRINTER."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a target=\"_blank\" href=\"modules.php?name=$modulename&amp;file=print&amp;sid=$vid\">"._PRINTER."</a>";
    		$posted = "Posted by $submitter on $formatteddate ($views reads)";
    		$morelink = "($comm | $printpage $friendlink | Score: $averagerating)";	
    		$popgraphic = popgraphic($views);
			$newgraphic = newdownloadgraphic($date, $time);
			$title = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">$title</a> $popgraphic $newgraphic";
    		// Import Template
    		$ThemeSel = get_theme();
    		if (file_exists("modules/$modulename/templates/$ThemeSel-cat.html")) {
    	$tmpl_file = "modules/$modulename/templates/$ThemeSel-cat.html";
    	$thefile = implode("", file($tmpl_file));
    	$thefile = addslashes($thefile);
    	$thefile = "\$r_file=\"".$thefile."\";";
    	eval($thefile);
    	print $r_file;
 			} else {
		$tmpl_file = "modules/$modulename/templates/nuke-cat.html";
    	$thefile = implode("", file($tmpl_file));
    	$thefile = addslashes($thefile);
    	$thefile = "\$r_file=\"".$thefile."\";";
    	eval($thefile);
    	print $r_file;	
 			}
	}
    		echo "</td>\n";
			echo "</tr>"
			."<tr>"
    		."<td width=\"50%\" valign=\"top\">&nbsp;</td>"
    		."<td width=\"50%\" valign=\"top\">&nbsp;</td>"
  			."</tr>"; 
		} else {
   			echo "<tr>"
    		."<td width=\"100%\">"
    		."<p align=\"center\"><strong>"._NOITEMS.".</strong></td>"
  			."</tr>";
 		}
			echo "</table>";
	if (getconfigvar("phpbb_pages") == 0) {
	   generate_pagination_old_catindex($page, $pages, $modulename, $letter, $sortletter);
	}
    	CloseTable();	
	if (getconfigvar("phpbb_pages") == 1) {	
		
			$per_page = $perpage;
			if ($sortletter) {
				$topics_count = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_".$mainprefix."_items where parentid = '$cid' and UPPER(title) LIKE '$sortletter%' and language = '$unilang' and active = '1'"));
			} else {
				$topics_count = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_".$mainprefix."_items where parentid = '$cid' and language = '$unilang' and active = '1'"));				
			}
			if ($letter == "no") {
				$page_string = generate_pagination_phpbb("modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2", $topics_count, $per_page, $start);	
			} else {
					$page_string = generate_pagination_phpbb("modules.php?name=$modulename&op=CatIndex&cid=$cid&sortletter=$sortletter&amp;orderby=$orderby2", $topics_count, $per_page, $start);					
			}
			if ($page_string) {
				OpenTable();
					echo "<div align=\"center\">$page_string</div>";
				CloseTable();
			}
		}
	include_once("modules/$modulename/includes/credit-line.php");
	include_once("footer.php");
}

function Random() {
	global $prefix, $db, $modulename, $mainprefix, $currentlang;	
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}     	
		$result = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1'");
		$id_cache = array();
			while($row = $db->sql_fetchrow($result)) {
 				 $id_cache[] = $row['id'];
			}
		mt_srand((double) microtime() * 1000000);
		$random = $id_cache[rand(0,count($id_cache))];
		unset($id_cache);
		Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$random");		
}

function search($query) {
	global $admin, $prefix, $db, $modulename, $mainprefix, $currentlang;
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php"); 
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}    	
	$mainindex = 1;
    	mainheader($mainindex);
	OpenTable();
	$searchresults = getconfigvar("searchresults");
	$result = $db->sql_query("select id, parentid, author, website, title, description, submitter, date, lastdate, views from ".$prefix."_".$mainprefix."_items where title LIKE '%$query%' or description LIKE '%$query%' AND language = '$unilang' and active = '1' order by title LIMIT 0,$searchresults");
	$numrow = $db->sql_numrows($result);
	if ($numrow > 0) {
			echo "<table border=\"0\" width=\"100%\">"
  			."<tr>"
  			."<td width=\"100%\" height=\"25\">"._RESULTSFOR.": $query<hr></td>"
  			."</tr>"
  			."<tr>"
    		."<td width=\"100%\" height=\"19\">"._THEREAREIS." $numrow "._QUERYRESULTS.".</td>"
  			."</tr>"
  			."<tr>"
  			."<td width=\"100%\" height=\"19\">&nbsp;</td>"
  			."</tr>"
			."<tr>";
	while(list($id, $parentid, $author, $website, $title, $description, $submitter, $date, $lastdate, $views) = $db->sql_fetchrow($result)) {
    if ($lastdate) {
    $overalldate = $lastdate;
    } else {
    $overalldate = $date;
    }
    $overalldate2 = FormatDate($overalldate);
    $formatteddate = FormatDate($date);
    $title = stripslashes($title);
    $description = stripslashes($description);
			echo "<td width=\"100%\" height=\"19\">"._TITLE.": <a href=\"modules.php?name=$modulename&op=ViewItems&vid=$id\">$title</a><br />"
    		.""._DESCRIPTION.": $description<br />"
    		.""._VIEWS.": $views<br />"
    		.""._SUBMITBY.": $submitter "._ON." $formatteddate<br />"
    		.""._LASTMOD." "._ON.": $overalldate2<br />"
    		."[ ";
    if (is_admin($admin)) {
    		echo "<a href=\"modules.php?name=$modulename&file=admin&op=modifyitem&id=$id\">"._EDIT."</a> |";
	}
    		echo "<a href=\"$website\"> "._HOMEPAGE."</a> ]<br />"
			."&nbsp;<hr>"
    		."</td>"
	 		."</tr>";
	 	}
			echo "</table>";   
	} else {
			echo "<table border=\"0\" width=\"100%\">"
			."<tr>"
    		."<td width=\"100%\">"._RESULTSFOR.": $query<hr></td>"
  			."</tr>"
  			."<tr>"
    		."<td width=\"100%\">"
    		."<p align=\"center\"><br />"
    		."<font size=\"4\"><strong>"._NORESULTSFOR." \"$query\"<br />"
    		.""._PLEASETRY.".</strong></font></td>"
  			."</tr>"
			."</table>";
		}
	CloseTable();
	include_once("modules/$modulename/includes/credit-line.php");
	include_once("footer.php");
}	

function ViewItems($vid, $page) {
	global $prefix, $db, $modulename, $bgcolor1, $bgcolor2, $textcolor1, $admin, $cookie, $user, $mainprefix, $user_prefix, $currentlang, $viewed;
	$vid = intval($vid);
	if (isset($viewed)) $viewed = intval($viewed);
	if (isset($page)) $page = intval($page);
	$vid2 = $vid;
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php");
	require_once("modules/$modulename/includes/bbstuff.php");
	$mainindex = 1;
    	mainheader($mainindex);
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}        	
   	if(isset($viewed)) {
		$viewed = 1;
    	} else {
		$viewed = 0;
    	}
    if ($viewed == 0) {
    	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET views = views + 1 WHERE id = $vid2");
    }
    $datapull = $db->sql_query("select * from ".$prefix."_".$mainprefix."_items where id = '$vid2'  and active = '1'");
	while(list($id, $parentid, $author, $website, $title, $description, $votes, $rating, $comments, $content, $submitter, $date, $lastdate, $views, $youremail, $bbcode_uid) = $db->sql_fetchrow($datapull)) {
	if ($lastdate) {
    	$overalldate = $lastdate;
    } else {
    	$overalldate = $date;
    }
    $overalldate2 = FormatDate($overalldate);
    $formatteddate = FormatDate($date);
    $usercheck = $db->sql_query("select username from ".$user_prefix."_users where username = '$submitter'");
    $isuser = $db->sql_numrows($usercheck);
    if ($isuser == 1) {
	 	$contactemail = $youremail;
	 	$submitterq = "<a href=modules.php?name=Your_Account&op=userinfo&username=$submitter>".stripslashes($submitter)."</a>";
    } else {
    	$contactemail = $youremail;
    	$submitterq = stripslashes($submitter);
    }
    // Multiple Pages Start
    $formattedcontent =  explode( "<!--pagebreak-->", $content );
    $pageno = count($formattedcontent);
    if ( $page=="" || $page < 1 )
	    $page = 1;
	if ( $page > $pageno )
	    $page = $pageno;
	$arrayelement = (int)$page;
	$arrayelement --;
	// End
	
	// Build the the left/right selections
	include_once("modules/$modulename/includes/vilinks.php");
		if ($vid2 == $first_id) {
        
		$titleheader1 = "<img border=\"0\" src=\"modules/$modulename/images/left-no.gif\" width=\"14\" height=\"11\">";
		} else {
		$titleheader1 = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$prev_id\"><img border=\"0\" src=\"modules/$modulename/images/left.gif\" width=\"14\" height=\"11\"></a>";
		}
	if (!$next_id == 0) {
		$titleheader2 = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$next_id\"><img border=\"0\" src=\"modules/$modulename/images/right.gif\" width=\"14\" height=\"11\"></a>";
	} else {
		$titleheader2 = "<img border=\"0\" src=\"modules/$modulename/images/right-no.gif\" width=\"14\" height=\"11\"></a>";
	}
	// End
	
	if ($votes == 0) {
		$averagerating = 0;
	} else {
		$averagerating = substr($rating / $votes, 0, 4);
	}
	$formattedcontent[$arrayelement] = stripslashes($formattedcontent[$arrayelement]);
	$title = stripslashes($title);
	$description = stripslashes($description);
	$cattitlequery = $db->sql_query("select parentid, title from ".$prefix."_".$mainprefix."_categories where id=$parentid");
	list($parentid2,$title2)= $db->sql_fetchrow($cattitlequery);
	$title2=getparentlink($parentid2,$title2);
	$title2 = stripslashes($title2);
	OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"1\">";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"2\" height=\"20\" valign=\"top\">";
			echo "    <div align=\"center\">$titleheader1 - $title - $titleheader2<br />"._CATEGORY.": $title2</div></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"2\" height=\"0\" valign=\"top\"><hr></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"28%\" height=\"19\" valign=\"top\">";
			echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"134\">";
			echo "      <tr>";
			echo "        <td width=\"100%\" height=\"109\" valign=\top\">";
			echo "        <table border=\"0\" cellspacing=\"0\" width=\"100%\" cellpadding=\"0\">";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBFROM.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$submitterq</font></td>";
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._AUTHOR.":</font></td>";
	if ($author and $website) {
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\"><a href=$website>".stripslashes($author)."</a></font></td>";
	} else {
			echo "			<td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">"._VBUNKNOWN."</font></td>";	
	}
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBEMAIL.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">";
	if ($contactemail) {
	   $encoded = bin2hex("$contactemail");
       $encoded = chunk_split($encoded, 2, '%');
       $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
			echo "            <a href=\"mailto:$encoded\">"._VBEMAIL2."</a></font></td>";
	} else {
			echo "			 "._VBNOEMAIL."</font></td>";	
	}
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBADDED.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$formatteddate</font></td>";
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBMODIFIED.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">";
			echo "            $overalldate2</font></td>";
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBVIEWS.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$views "; popgraphic($views);
			echo "			</font></td>";
			echo "          </tr>";
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBVOTES.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$votes</font></td>";
			echo "          </tr>";			
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._VBRATING.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$averagerating</font></td>";
			echo "          </tr>";
	if ($pageno > 1) {
			echo "          <tr>";
			echo "            <td width=\"29%\" bgcolor=\"$bgcolor2\"><font color=\"$textcolor1\">"._PAGE.":</font></td>";
			echo "            <td width=\"71%\" bgcolor=\"$bgcolor1\"><font color=\"$textcolor1\">$page/$pageno</font></td>";
			echo "          </tr>";
	}
			echo "        </table>";
			echo "        </td>";
			echo "      </tr>";
		if (getconfigvar("allowratings") == 1) {
			echo "      <tr>";
			echo "        <td width=\"100%\" height=\"19\"> </td>";
			echo "      </tr>";
			echo "      <tr>";
			echo "        <td width=\"100%\" height=\"23\">";
			echo "        <form method=\"POST\" action=\"modules.php?name=$modulename\">";
			echo "          <p align=\"center\"><select size=\"1\" name=\"ratingchoice\">";
			echo "          <option value=\"1\">1</option>";
			echo "          <option value=\"2\">2</option>";
			echo "          <option value=\"3\">3</option>";
			echo "          <option value=\"4\">4</option>";
			echo "          <option value=\"5\">5</option>";
			echo "          <option value=\"6\">6</option>";
			echo "          <option value=\"7\">7</option>";
			echo "          <option value=\"8\">8</option>";
			echo "          <option value=\"9\">9</option>";
			echo "          <option selected value=\"10\">10</option>";
			echo "          </select>";
			echo "          <input border=\"0\" src=\"modules/$modulename/images/rate.jpg\" name=\"I2\" width=\"35\" height=\"15\" type=\"image\"></p>";
			echo "          <input type=\"hidden\" name=\"rid\" value=\"$vid\">";
			echo "          <input type=\"hidden\" name=\"op\" value=\"dorating\">";
			echo "        </form>";
			echo "        </td>";
			echo "      </tr>";
		}
			echo "      <tr>";
			echo "        <td width=\"100%\" height=\"1\" valign=\"top\"></td>";
			echo "      </tr>";
			echo "      <tr>";
			echo "        <td width=\"100%\" height=\"1\" valign=\"top\"><center>";
		include_once("modules/$modulename/blocks/block-Related_Links.php");
		themesidebox($boxtitle, $boxstuff);
		$optiontitle = ""._OPTIONS."";
		include_once("modules/$modulename/blocks/blocks-Universal_Options.php");
		themesidebox($optiontitle, $optionbox);
			echo "		</center></td>";
			echo "      </tr>";
			echo "    </table>";
			echo "    </td>";
			echo "    <td width=\"72%\" height=\"19\" valign=\"top\">";
			echo "    <table border=\"0\" cellspacing=\"1\" width=\"100%\">";
			echo "      <tr>";
			echo "        <td width=\"100%\" valign=\"top\">";
			echo "        <p align=\"center\">"._ITEMSFOR." $title:<br />";
			echo "        ".stripslashes($description)."<br />";
			echo "        </td>";
			echo "      </tr>";
			echo "      <tr>";
			echo "        <td width=\"100%\" valign=\"top\"><hr></td>";
			echo "      </tr>";
			echo "      <tr>";
	$parse_content = parse_bbcode($formattedcontent[$arrayelement], $bbcode_uid);		
			echo "        <td width=\"100%\" valign=\"top\">".stripslashes($parse_content)."</td>";
			echo "      </tr>";
			echo "		<tr>";
			echo "		  <td width=\"100%\" valign=\"top\">";
	if($page >= $pageno) {
	    $next_page = "";
	} else {
	    $next_pagenumber = $page + 1;
	    if ($page != 1) {
		$next_page .= "- ";
	    }
	    $next_page .= "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1&page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1&page=$next_pagenumber\"><img src=\"modules/$modulename/images/right.gif\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\"></a>";
	}
	if($page <= 1) {
	    $previous_page = "";
	} else {
	    $previous_pagenumber = $page - 1;
	    $previous_page = "<a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1&page=$previous_pagenumber\"><img src=\"modules/$modulename/images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1&page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
	}
	echo "<br /><br /><br /><center>$previous_page $next_page</center><br /><br />";
	echo "</td></tr>";
			
			echo "    </table>";
			echo "    </td>";
			echo "  </tr>";
			echo "</table>";
	CloseTable();
    }
    if (getconfigvar("allowcomments") == 1) {
    $username1 = $cookie[1];
    if ($username1 == "") {
        $username1 = "Anonymous";
    }
	if (getconfigvar("restrictcomments") == 1) {
		if (is_user($user)) {
			    OpenTable();
			echo "<table border=\"0\" cellspacing=\"1\" width=\"100%\">";
			echo "  <tr>";
			echo "    <td width=\"100%\" bgcolor=\"$bgcolor2\">";
			echo "    <p align=\"center\"><font class=\"tiny\" color=\"$textcolor1\">"._CPWM."";
			echo "    </font></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\">";
    		echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=comments\">";
    		echo "  <p align=\"left\"><textarea rows=\"2\" name=\"commentext\" cols=\"50\"></textarea>";
    		echo "  <input type=\"submit\" value=\""._SUBMITCOMM."\"></p>";
    		echo "  <input type=\"hidden\" name=\"op\" value=\"PostComment\">";
    		echo "  <input type=\"hidden\" name=\"pid\" value=\"$vid\">";
    		echo "  <input type=\"hidden\" name=\"commtname\" value=\"$username1\">";
    		echo "</form>";
    		echo "</td>";
  			echo "</tr>";
			echo "</table>";
	CloseTable();
	OpenTable();
	include_once("modules/$modulename/comments.php");
	CloseTable();
		} else {
			OpenTable();
			echo ""._COMMREG." <a href=\"modules.php?name=Your_Account\">"._LOGIN."</a>";
			CloseTable();
		}
	} else {
		OpenTable();
			echo "<table border=\"0\" cellspacing=\"1\" width=\"100%\">";
			echo "  <tr>";
			echo "    <td width=\"100%\" bgcolor=\"$bgcolor2\">";
			echo "    <p align=\"center\"><font class=\"tiny\" color=\"$textcolor1\">"._CPWM."";
			echo "    </font></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\">";
    		echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=comments\">";
    		echo "  <p align=\"left\"><textarea rows=\"2\" name=\"commentext\" cols=\"50\"></textarea>";
    		echo "  <input type=\"submit\" value=\""._SUBMITCOMM."\"></p>";
    		echo "  <input type=\"hidden\" name=\"op\" value=\"PostComment\">";
    		echo "  <input type=\"hidden\" name=\"pid\" value=\"$vid\">";
    		echo "  <input type=\"hidden\" name=\"commtname\" value=\"$username1\">";
    		echo "</form>";
    		echo "</td>";
  			echo "</tr>";
			echo "</table>";
		CloseTable();
		OpenTable();
		include_once("modules/$modulename/comments.php");
		CloseTable();
	}	
    } else {
    	OpenTable();
			echo ""._COMMNOTMESS."";
			CloseTable();
    }
	include_once("modules/$modulename/includes/credit-line.php");
	include_once("footer.php");
}

function TopRated() {
	global $prefix, $db, $modulename, $bgcolor1, $bgcolor2, $textcolor1, $mainprefix, $currentlang;
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php");
	if (getconfigvar("multilinguel") == 1) {
		$unilang = $currentlang;
	} else {
		$unilang = "english";
	}    	
	$mainindex = 1;
    	mainheader($mainindex);
    OpenTable();
    		echo "<br/>";
    		echo "<center>";
			echo "<table border=\"0\" cellspacing=\"0\" style=\"color: $textcolor1\" width=\"76%\" bgcolor=\"$bgcolor1\">";
			echo "  <tr>";
			echo "    <td width=\"100%\" bgcolor=\"$bgcolor2\" align=\"center\" colspan=\"3\">";
			echo "    <strong>"._TOPTOP." $toprated";
			echo "    ("._TOPBYHITS.")</strong></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"3\"> </td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"17%\" align=\"center\">";
			echo "    "._TOPPOS."</td>";
			echo "    <td width=\"20%\" align=\"center\">";
			echo "    <span style=\"font-weight: 700\">";
			echo "    "._VBVIEWS."</span></td>";
			echo "    <td width=\"63%\" align=\"center\">";
			echo "    <p align=\"left\">";
			echo "    "._TOPITEM."</td>";
			echo "  </tr>";
			$toprated = getconfigvar("toprated");
		$topviewed = $db->sql_query("select id, title, views from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1' order by views DESC limit 0, $toprated");
		while (list($cid, $vitemitle, $views) = $db->sql_fetchrow($topviewed)) {
			$vitemitle = stripslashes($vitemitle); 
		$vpos += 1;
			echo "  <tr>";
			echo "    <td width=\"17%\">";
			echo "    <p align=\"center\">$vpos</td>";
			echo "    <td width=\"20%\">";
			echo "    <p align=\"center\">$views</td>";
			echo "    <td width=\"63%\"><a href=\"modules.php?name=$modulename&op=ViewItems&vid=$cid\">$vitemitle</a></td>";
			echo "  </tr>";
		}
			echo "</table>";
			echo "<br/><br/>";
			echo "<table border=\"0\" cellspacing=\"0\" style=\"color: $textcolor1\" width=\"76%\" bgcolor=\"$bgcolor1\" height=\"99\">";
			echo "  <tr>";
			echo "    <td width=\"100%\" bgcolor=\"$bgcolor2\" align=\"center\" colspan=\"4\" height=\"36\">";
			echo "    <strong>"._TOPTOP." $toprated";
			echo "    ("._TOPBYRAT.")</strong></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"4\" height=\"19\">";
			echo "    <p align=\"center\"> </td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"17%\" align=\"center\" height=\"18\">";
			echo "    "._TOPPOS."</td>";
			echo "    <td width=\"20%\" align=\"center\" height=\"18\">";
			echo "    <span style=\"font-weight: 700\">";
			echo "    "._CTSCORE."</span></td>";
			echo "    <td width=\"18%\" align=\"center\" height=\"18\">";
			echo "    # "._VBVOTES."</td>";
			echo "    <td width=\"45%\" align=\"center\" height=\"18\">";
			echo "    <p align=\"left\">";
			echo "    "._TOPITEM."</td>";
			echo "  </tr>";
		$topratedquery = $db->sql_query("select id, title, votes, rating from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1' order by votes DESC limit 0, $toprated");
		while (list($vid, $ritemitle, $votes, $rating) = $db->sql_fetchrow($topratedquery)) {
	if ($votes == 0) {
		$score = 0;
	} else {
		$score = substr($rating / $votes, 0, 4);
	}
		$rpos += 1;
		$ritemitle = stripslashes($ritemitle);
			echo "  <tr>";
			echo "    <td width=\"17%\" align=\"center\" height=\"18\">";
			echo "    $rpos</td>";
			echo "    <td width=\"20%\" align=\"center\" height=\"18\">";
			echo "    $score</td>";
			echo "    <td width=\"18%\" align=\"center\" height=\"18\">";
			echo "    $votes</td>";
			echo "    <td width=\"45%\" align=\"center\" height=\"18\">";
			echo "    <p align=\"left\"><a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid\">$ritemitle</a></td>";
			echo "  </tr>";
	}
			echo "  </table>";
			echo "</center><br/>";
	CloseTable();
	include_once("modules/$modulename/includes/credit-line.php");
	include_once("footer.php");
}

function dorating($rid, $ratingchoice) {
	global $prefix, $db, $modulename, $mainprefix;
	$rid = intval($rid);
	$ratingchoice = intval($ratingchoice);
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET votes = votes + 1 WHERE id = $rid");
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET rating = rating + $ratingchoice WHERE id = $rid");
	Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$rid&viewed=1");
}


function FormatDate($strDate){
		preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $strDate, $Adob);
        $newdob = $Adob[3];
        if ($Adob[2] == 1)$month = _JANUARY;
        if ($Adob[2] == 2)$month = _FEBRUARY;
        if ($Adob[2] == 3)$month = _MARCH;
        if ($Adob[2] == 4)$month = _APRIL;
        if ($Adob[2] == 5)$month = _MAY;
        if ($Adob[2] == 6)$month = _JUNE;
        if ($Adob[2] == 7)$month = _JULY;
        if ($Adob[2] == 8)$month = _AUGUST;
        if ($Adob[2] == 9)$month = _SEPTEMBER;
        if ($Adob[2] == 10)$month = _OCTOBER;
        if ($Adob[2] == 11)$month = _NOVEMBER;
        if ($Adob[2] == 12)$month = _DECEMBER;
        $newdob = "$month"." ".$newdob.", ".$Adob[1];
        return $newdob;
}
    
function convertorderbyin($orderby) {
    if ($orderby == "titleA")	$orderby = "title ASC"; 
    if ($orderby == "dateA")	$orderby = "date ASC";
    if ($orderby == "hitsA")	$orderby = "views ASC";
    if ($orderby == "ratingA")	$orderby = "ratings ASC";
    if ($orderby == "titleD")	$orderby = "title DESC"; 
    if ($orderby == "dateD")	$orderby = "date DESC";
    if ($orderby == "hitsD")	$orderby = "views DESC";
    if ($orderby == "ratingD")	$orderby = "ratings DESC";
    return $orderby;
}

function convertorderbytrans($orderby) {
    if ($orderby == "views ASC")			$orderbyTrans = ""._POPULARITY1."";
    if ($orderby == "views DESC")		$orderbyTrans = ""._POPULARITY2."";
    if ($orderby == "title ASC")		$orderbyTrans = ""._TITLEAZ."";
    if ($orderby == "title DESC")		$orderbyTrans = ""._TITLEZA."";
    if ($orderby == "date ASC")			$orderbyTrans = ""._DDATE1."";
    if ($orderby == "date DESC")		$orderbyTrans = ""._DDATE2."";
    if ($orderby == "rating ASC")	$orderbyTrans = ""._RATING1."";
    if ($orderby == "rating DESC")	$orderbyTrans = ""._RATING2."";
    return $orderbyTrans;
}

function convertorderbyout($orderby) {
    if ($orderby == "title ASC")		$orderby = "titleA";
    if ($orderby == "date ASC")			$orderby = "dateA";
    if ($orderby == "hits ASC")			$orderby = "hitsA";
    if ($orderby == "downloadratingsummary ASC")	$orderby = "ratingA";
    if ($orderby == "title DESC")		$orderby = "titleD";
    if ($orderby == "date DESC")		$orderby = "dateD";
    if ($orderby == "hits DESC")		$orderby = "hitsD";
    if ($orderby == "downloadratingsummary DESC")	$orderby = "ratingD";
    return $orderby;
}

function popgraphic($views) {
	global $modulename;
	$popular = getconfigvar("popular");
	$views = intval($views);
    if ($views>=$popular) {
			$pop = "&nbsp;<img src=\"modules/$modulename/images/popular.gif\" alt=\""._POPULARIMAGE."\">";
    }
    return $pop;
}

function alpha($sortletter, $cid, $orderby2) {
	global $modulename;
	$cid = intval($cid);
			echo "      <option value=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2\">"._CIALL."";
			echo "      </option>";
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
    	if ($ltr==$sortletter) { $sel = " selected"; }
			echo "      <option$sel value=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2&sortletter=$ltr\">$ltr\n";
			echo "      </option>\n";
        $counter++;
        $sel = '';
    }	
}

function getparentlink($parentid2,$title2) {
    global $prefix, $db, $modulename, $mainprefix;
    $parentid2 = intval($parentid2);
    $result2=$db->sql_query("select id, parentid, title from ".$prefix."_".$mainprefix."_categories where id=$parentid2");
    list($cid2, $pparentid2, $ptitle2) = $db->sql_fetchrow($result2);
    if ($ptitle2!="") $title2="<a href=modules.php?name=$modulename&op=CatIndex&cid=$cid2>$ptitle2</a>/".$title2;
    if ($pparentid2!=0) {
    	$title2=getparentlink($pparentid2,$title2);
    }
    return $title2;
}

function newdownloadgraphic($date, $time) {
    global $modulename;
    		echo "&nbsp;";
    setlocale (LC_TIME, "$locale");
    preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);  
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);		   
    $startdate = time();
    $count = 0;
    while ($count <= 7) {
	$daysold = date("d-M-Y", $startdate);
    if ("$daysold" == "$datetime") {
    	if ($count<=1) {
			$newitem = "&nbsp;<img src=\"modules/$modulename/images/new_1.gif\" alt=\""._NEWTODAY."\">";
	    }
       	if ($count<=3 && $count>1) {
		$newitem =  "&nbsp;<img src=\"modules/$modulename/images/new_3.gif\" alt=\""._NEWLAST3DAYS."\">";
	    }
        if ($count<=7 && $count>3) {
			$newitem = "&nbsp;<img src=\"modules/$modulename/images/new_7.gif\" alt=\""._NEWTHISWEEK."\">";
	    }
	}
    $count++;
    $startdate = (time()-(86400 * $count));
    }
    return $newitem;
}

function categorynewdownloadgraphic($cat) {
    global $prefix, $db, $modulename, $mainprefix;
    $cat = intval($cat);
    $newresult = $db->sql_query("select date from ".$prefix."_".$mainprefix."_items where parentid=$cat order by date desc limit 1");
    list($time)=$db->sql_fetchrow($newresult);
			echo "&nbsp;";
    setlocale (LC_TIME, "$locale");
    preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $time, $datetime);  
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);		   
    $startdate = time();
    $count = 0;
    while ($count <= 7) {
	$daysold = date("d-M-Y", $startdate);
    if ("$daysold" == "$datetime") {
        if ($count<=1) {
			echo "<img src=\"modules/$modulename/images/new_1.gif\" alt=\""._DCATNEWTODAY."\">";
	    }
        if ($count<=3 && $count>1) {
			echo "<img src=\"modules/$modulename/images/new_3.gif\" alt=\""._DCATLAST3DAYS."\">";
	    }
        if ($count<=7 && $count>3) {
			echo "<img src=\"modules/$modulename/images/new_7.gif\" alt=\""._DCATTHISWEEK."\">";
	    }
	}
    $count++;
    $startdate = (time()-(86400 * $count));
    }
}

function MostWanted($page) {
	global $prefix, $mainprefix, $db, $modulename, $bgcolor2, $textcolor1;
	$page = intval($page);
	if (getconfigvar("mostwanted") == 1) {
	include_once("header.php");
	include_once("modules/$modulename/includes/js.php");
	$mainindex = 1;
    	mainheader($mainindex);
    // Calculate Page Numbering
	$mwpages = getconfigvar("mwpages");
    	$result = $db->sql_query("SELECT count(*) FROM ".$prefix."_".$mainprefix."_requests where approved='1'");
		list($total) =  $db->sql_fetchrow($result);
		if ($total>$mwpages) {
    			$pages=ceil($total/$mwpages);
    	if ($page > $pages) { $page = $pages; }
    	if (!$page) { $page=1; }
    			$offset=($page-1)*$mwpages;
			} else {
    		$offset=0;
    		$pages=1;
    		$page=1;
		}
	// End Page Numbering
    	OpenTable();
    		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._ITEMSREQUESTED.":\n";
			echo "	  <br />"._REQUESTMESS."<br />"._REQUESTMESS2."&nbsp;<a href=\"modules.php?name=$modulename&file=add&op=request\">"._REQUESTFORM."</a>\n";
			echo "</td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
			echo "<hr>\n";
	$sqlcheck = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_requests");
	$sqlnum = $db->sql_numrows($sqlcheck);
	if ($sqlnum >= 1) {
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "      <tr>\n";
			echo "        <td width=\"53%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>\n";
			echo "        <font color=\"$textcolor1\">"._ITEMNAME."</font></strong></td>\n";
			echo "        <td width=\"24%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>\n";
			echo "        <font color=\"$textcolor1\">"._REQUESTEDBY."</font></strong></td>\n";
			echo "        <td width=\"23%\" bgcolor=\"$bgcolor2\" align=\"center\"><strong>\n";
			echo "        <font color=\"$textcolor1\">"._REQUESTDATE."</font></strong></td>\n";
			echo "      </tr>\n";
			$mwpages = getconfigvar("mwpages");
	$datapull = $db->sql_query("SELECT itemtitle, submitter, date from ".$prefix."_".$mainprefix."_requests where approved='1' order by date DESC limit $offset,$mwpages");
	while (list($itemname, $submitter, $date) = $db->sql_fetchrow($datapull)) {
		$formatteddate = FormatDate($date);
		$itemname = stripslashes($itemname);
			echo "      <tr>\n";
			echo "        <td width=\"53%\">$itemname</td>\n";
			echo "        <td width=\"24%\">$submitter</td>\n";
			echo "        <td width=\"23%\">$formatteddate</td>\n";
			echo "      </tr>\n";
	}
			echo "    </table>\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
	} else {
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\"><strong>"._NOREQUESTED.".</strong></td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
	}
    if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&op=MostWanted&amp=page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&op=MostWanted&amp=page=$pcnt\">$pcnt</a> ]</strong> ";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&op=MostWanted&amp=page=$pcnt\">$pcnt</a> ]</strong>";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&op=MostWanted&amp=page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />";
	}
    	CloseTable();
    include_once("modules/$modulename/includes/credit-line.php");
    include_once("footer.php");
	} else {
		Header("Location: modules.php?name=$modulename");
	}
}
	
switch($op) {
	
	case "index":
	index();
	break;
	
	case "CatIndex":
	CatIndex($cid, $orderby, $sortletter, $page);
	break;
	
	case "search":
	search($query);
	break;
	
	case "ViewItems":
	ViewItems($vid, $page);
	break;
	
	case "dorating":
	dorating($rid, $ratingchoice);
	break;
	
	case "Random":
	Random();
	break;
	
	case "TopRated":
	TopRated();
	break;
	
	case "MostWanted":
	MostWanted($page);
	break;
	
	default:
	index();
	break;
	
}

?>
