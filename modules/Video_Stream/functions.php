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
// Settings
$settings = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$srow = $db->sql_fetchrow($settings);
$commentEDDD = $srow['commentED'];
$commentVVV = $srow['commentV'];
$sendED = $srow['sendED'];
$sendV = $srow['sendV'];
$brokenED = $srow['brokenED'];
$brokenV = $srow['brokenV'];
$submitED = $srow['submitED'];
$submitV = $srow['submitV'];
$submitC = $srow['submitC'];
$ratingED = $srow['ratingED'];
$ratingV = $srow['ratingV'];
$viewV = $srow['viewV'];
$downloadED = $srow['downloadED'];
$downloadV = $srow['downloadV'];
$embededED = $srow['embededED'];
$embededV = $srow['embededV'];
$limit = $srow['limitvids'];
$disclaimersigned = $_COOKIE["vs_disclaimer"];
// Plugins
include_once('modules/Video_Stream/plugins/index.php');

global $commentEDDD, $commentVVV, $sendED, $sendV, $brokenED, $brokenV, $downloadED, $submitED, $submitV, $submitC, $ratingED, $ratingV, $viewV, $downloadV, $limit, $sortby1, $sortby2, $word, $avmaxwidth, $avmaxheight, $vs_plugins, $disclaimersigned, $regcatanon, $embededED, $embededV, $page, $d, $searchtd;

// Users username
cookiedecode($user);
$looker = $cookie[1];
if ($looker == "") {
	$looker = "Anonymous";
}
global $looker;

// Check to see if they are admin
global $admin;
if (!is_array($admin)) {
	$admin2 = base64_decode($admin);
	$admin2 = explode(":", $admin2);
	$aid = "$admin2[0]";
} else {
	$aid = "$admin[0]";
}
$sql = "SELECT radminsuper FROM ".$prefix."_authors WHERE aid='$aid'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
if ($row['radminsuper'] == 1) {
	$isvidstreamadmin = 1;
} else {
	$isvidstreamadmin = 0;
}
// ******************************

function avatars($userav) {
	global $db, $prefix;
	
	$resultav = $db->sql_query("SELECT * FROM ".$prefix."_users WHERE username='$userav'");
	$rowav = $db->sql_fetchrow($resultav);
	$row_avatar = $rowav['user_avatar'];

	$sql = "SELECT * FROM ".$prefix."_video_stream_settings";
	$result = $db->sql_query($sql);
	$conf = $db->sql_fetchrow($result);

	// Find avatar path
	// modules/Forums/images/avatars/gallery
	$sql = "SELECT * FROM ".$prefix."_bbconfig WHERE config_name='avatar_gallery_path'";
	$result = $db->sql_query($sql);
	$avatar_gallery_path = $db->sql_fetchrow($result);
	// modules/Forums/images/avatars
	$sql = "SELECT * FROM ".$prefix."_bbconfig WHERE config_name='avatar_path'";
	$result = $db->sql_query($sql);
	$avatar_path = $db->sql_fetchrow($result);
	if (preg_match('#http://#',$row_avatar) == TRUE) {
		// offsite avatars
		$imageSize = @getimagesize("$row_avatar");
		// width check
		if ($imageSize[0] > $conf['avmaxwidth']) {
			$width = "width=\"".$conf['avmaxwidth']."px\"";
		} else {
			$width = "width=\"$imageSize[0]px\"";
		}
		// height check
		if ($imageSize[1] > $conf['avmaxheight']) {
			$height = "height=\"".$conf['avmaxheight']."px\"";
		} else {
			$height = "height=\"$imageSize[1]px\"";
		}
		$AvatarFound = "<img $width $height src=\"$row_avatar\" alt=\"\" />";
	} else {
		$agp = "$avatar_gallery_path[config_value]/$row_avatar";
		$ap = "$avatar_path[config_value]/$row_avatar";
		if (file_exists($agp) == TRUE) {
			$imageSize = getimagesize("$agp");
			// width check
			if ($imageSize[0] > $conf['avmaxwidth']) {
				$width = "width=\"".$conf['avmaxwidth']."px\"";
			} else {
				$width = "width=\"$imageSize[0]px\"";
			}
			// height check
			if ($imageSize[1] > $conf['avmaxheight']) {
				$height = "height=\"".$conf['avmaxheight']."px\"";
			} else {
				$height = "height=\"$imageSize[1]px\"";
			}
			$AvatarFound = "<img $width $height src=\"$avatar_gallery_path[config_value]/$row_avatar\" alt=\"\" />";
		} elseif (file_exists($ap) == TRUE) {
			$imageSize = getimagesize("$ap");
			// width check
			if ($imageSize[0] > $conf['avmaxwidth']) {
				$width = "width=\"".$conf['avmaxwidth']."px\"";
			} else {
				$width = "width=\"$imageSize[0]px\"";
			}
			// height check
			if ($imageSize[1] > $conf['avmaxheight']) {
				$height = "height=\"".$conf['avmaxheight']."px\"";
			} else {
				$height = "height=\"$imageSize[1]px\"";
			}
			$AvatarFound = "<img $width $height src=\"$avatar_path[config_value]/$row_avatar\" alt=\"\" />";
		} else {
			$imageSize = getimagesize("modules/Video_Stream/images/blank.gif");
			// width check
			if ($imageSize[0] > $conf['avmaxwidth']) {
				$width = "width=\"".$conf['avmaxwidth']."px\"";
			} else {
				$width = "width=\"$imageSize[0]px\"";
			}
			// height check
			if ($imageSize[1] > $conf['avmaxheight']) {
				$height = "height=\"".$conf['avmaxheight']."px\"";
			} else {
				$height = "height=\"$imageSize[1]px\"";
			}
			$AvatarFound = "<img $width $height src=\"modules/Video_Stream/images/blank.gif\" alt=\"\" />";
		}
	}
	echo $AvatarFound;
}

// Function to display top navigation
function vsnavtop() {
	global $sitename, $d, $submitED;
	OpenTable();
	echo "<center><FONT class=title>".$sitename." .::. "._VIDEOCOLECTION."</FONT></center><br />";
	echo "<center>[ ";
	echo "<a href=\"modules.php?name=Video_Stream\">Home</a> ";
	if($submitED == 1) {
	echo "| <a href=\"javascript:loadadd()\">Submit Video</a> ";
	}
	echo "| <a href=\"modules.php?name=Video_Stream&amp;page=search\">Search</a> ";
	echo "| <a href=\"modules.php?name=Feedback\">Feedback</a> ";
	echo "| <a href=\"modules.php?name=Recommend_Us\">Recommend</a> ";
	echo "]</center>";
	CloseTable();
	echo "<br />";
}

// Function to display catergory details
function category($id) {
	global $db, $prefix, $VSimgdata;
	
	//get category id
	$category = $db->sql_query("SELECT category FROM ".$prefix."_video_stream WHERE id=$id");
	$rowcat = $db->sql_fetchrow($category);
	$category = $rowcat['category'];
	//get category data
	$getcat = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id=$category");
	$catdata = $db->sql_fetchrow($getcat);
	$parentid = $catdata['parent'];
	if($parentid == 0) {
		findcatpic($category);
	} else {
		$fullcategory = "<a href=\"modules.php?name=Video_Stream&categoryby=".$category."\">".$catdata['name']."</a>";
	}
	
	// Do this untill we get to base category
	while ($parentid != 0) {
		$loopcat = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id=$parentid");
		$loopdata = $db->sql_fetchrow($loopcat);
		$parentid = $loopdata['parent'];
		$category = $loopdata['id'];
		if($parentid == 0) {
			findcatpic($category);
		} else {
			$fullcategory = "<a href=\"modules.php?name=Video_Stream&categoryby=".$category."\">".$loopdata['name']."</a><br />".$fullcategory."";
		}
	}
	echo "      "._CATEGORY.":<br />".$VSimgdata."".$fullcategory."\n";	
}

function findcatpic($id) {
	global $db, $prefix, $VSimgdata;
	
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id=$id");
	$row = $db->sql_fetchrow($result);
	
	if($row['imgurl'] == "") {
		$VSimgdata = "<a href=\"modules.php?name=Video_Stream&categoryby=".$id."\">".$row['name']."</a><br />";
	} else {
		$VSimgdata = "<a href=\"modules.php?name=Video_Stream&categoryby=".$id."\"><img src=\"".$row['imgurl']."\" alt=\"".$row['name']."\" border=\"0\" /></a><br />";
	}
}

function sortandsearch() {
	global $db, $prefix, $sortby1, $sortby2, $word, $searchtd, $page, $d;
	session_start();
	if($page == "") {
		$_SESSION['finalsearch'] = "";
		$_SESSION['search'] = "";
	}
// Search Types
	if (strstr($_GET['search'], 'user:') !== false) {
		$_SESSION['search'] = $_GET['search'];
		$type = 3;
	}
	if (strstr($_POST['search'], 'user:') !== false) {
		$_SESSION['search'] = $_POST['search'];
		$type = 3;
	}
	if (strstr($_POST['search'], 'title:') !== false) {
		$_SESSION['search'] = $_POST['search'];
		$type = 1;
	}
	if (strstr($_POST['search'], 'description:') !== false) {
		$_SESSION['search'] = $_POST['search'];
		$type = 2;
	}
	if (($type == "") && ($_POST['search'])) {
		$type = 1;
		$_SESSION['search'] = $_POST['search'];
	}
	if (strstr($_SESSION['search'], 'user:') !== false) {
		$type = 3;
	}
	if (strstr($_SESSION['search'], 'title:') !== false) {
		$type = 1;
	}
	if (strstr($_SESSION['search'], 'description:') !== false) {
		$type = 2;
	}	
// ***********
	
	// Get the final search word to be used
	if ($type == 3) {
		$_SESSION['finalsearch'] = str_replace('user:', '', $_SESSION['search']);
		$searchtd = "user";
	} elseif ($type == 1) {
		$_SESSION['finalsearch'] = str_replace('title:', '', $_SESSION['search']);
		$searchtd = "vidname";
	} else {
		$_SESSION['finalsearch'] = str_replace('description:', '', $_SESSION['search']);
		$searchtd = "description";
	}
	$word = $_SESSION['finalsearch'];
	// *************************************
	if($_POST['search']) {
		$d = 1;
	}
	if ($_GET['categoryby'] != "") {
		$_SESSION['categoryby'] = $_GET['categoryby'];
	}
	if ($_POST['sortvids']) {
		$d = 1;
		$_SESSION['orderby'] = $_POST['orderby'];
		$_SESSION['categoryby'] = $_POST['categoryby'];
	}
	if (($_SESSION['orderby'] == 0) || ($_SESSION['orderby'] == "")) {$sortby1 = "ORDER BY id DESC";}
	if ($_SESSION['orderby'] == 1) {$sortby1 = "ORDER BY id ASC";}
	if ($_SESSION['orderby'] == 2) {$sortby1 = "ORDER BY rating/rates DESC";}
	if ($_SESSION['orderby'] == 3) {$sortby1 = "ORDER BY views DESC";}
	if ($_SESSION['orderby'] == 4) {$sortby1 = "ORDER BY vidname ASC";}
	if (($_SESSION['categoryby'] == 0) || ($_SESSION['categoryby'] == "")) {$sortby2 = "WHERE request=0";}
	if (($_SESSION['categoryby'] != 0) && ($_SESSION['categoryby'] != "")) {$sortby2 = "WHERE request=0 AND category='".$_SESSION['categoryby']."'";}
	$selectby2 = $_SESSION['categoryby'];
	$selected1[$_SESSION['orderby']] = "selected";
	$selected2[$_SESSION['categoryby']] = "selected";
	$getcat = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories");
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\">\n";
	echo "  <tr valign=\"top\"><form name=\"order\" method=\"post\" action=\"\">\n";
	echo "    <td nowrap=\"nowrap\">\n";
	echo "      <strong>"._ORDERVIDS.":</strong><br />\n";
	echo "      <select name=\"orderby\">\n";
	echo "        <option value=\"0\" ".$selected1[0].">"._NEWEST."</option>\n";
	echo "        <option value=\"1\" ".$selected1[1].">"._OLDEST."</option>\n";
	echo "        <option value=\"2\" ".$selected1[2].">"._HIGHESTR."</option>\n";
	echo "        <option value=\"3\" ".$selected1[3].">"._MOSTVIEW."</option>\n";
	echo "        <option value=\"4\" ".$selected1[4].">"._ALPHABETICALLY."</option>\n";
	echo "      </select>\n";
	echo "    </td>\n";
	echo "    <td nowrap=\"nowrap\">\n";
	echo "      <strong>"._DISPLAYCATEGORY.":</strong><br />\n";
	echo "      <select name=\"categoryby\">\n";
	echo "        <option value=\"0\" ".$selected2[0].">"._ALL."</option>\n";
	$result9 = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories");
	while($row9 = $db->sql_fetchrow($result9)) {
		$cid2 = intval($row9['id']);
		$ctitle2 = $row9['name'];
		$parentid2 = intval($row9['parent']);
		if ($parentid2!=0) {
			$ctitle2 = getparent($parentid2,$ctitle2);
		}
		echo "        <option value=\"$cid2\" ".$selected2[$cid2].">$ctitle2</option>\n";
	}
	echo "      </select>\n";
	echo "    </td>\n";
	echo "    <td nowrap=\"nowrap\">\n";
	echo "      <br /><input type=\"submit\" name=\"sortvids\" value=\""._SORT."\">\n";
	echo "    </td></form><form name=\"search\" method=\"post\" action=\"modules.php?name=Video_Stream&amp;page=search\">\n";
	echo "    <td width=\"100%\" nowrap=\"nowrap\">&nbsp;</td>\n";
	echo "    <td nowrap=\"nowrap\">\n";
	echo "      <div align=\"center\"><strong>"._SEARCHVIDS."</strong> <img src=\"modules/Video_Stream/images/helpicon.png\" alt=\"\" border=\"0\" onMouseover=\"ddrivetip('"._HELPFORSEARCH."','#4F83D1', 300)\"; onMouseout=\"hideddrivetip()\"\" /><br />\n";
	echo "      <input name=\"search\" type=\"text\" size=\"35\" value=\"".$_SESSION['search']."\"></div>\n";
	echo "    </td>\n";
	echo "    <td nowrap=\"nowrap\">\n";
	echo "      <br /><input type=\"submit\" name=\"searchvid\" value=\""._SEARCH."\" />\n";
	echo "    </td>\n";
	echo "  </tr>\n";
	echo "</table>\n";
	unset($selected1);
	unset($selected2);
}

// Get 10 random vids 
function tenrandvids($id) {
	global $db, $prefix, $d;
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE id!='".$id."' AND request=0 ORDER BY RAND() LIMIT 10");
	if(($rows = $db->sql_numrows($result)) != 0) {
		echo "<br /><center>\n";
		echo "<table width=\"250\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">\n";
		echo "  <tr>\n";
		while($row = $db->sql_fetchrow($result)) {
			$image = $row['thumbimg'];
			echo "    <td>\n";
			echo "      <table border=\"2\" cellspacing=\"0\" cellpadding=\"0\">\n";
			echo "        <tr>\n";
			if($image == "") {
				echo "          <td><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."&amp;d=".$d."\"><img src=\"modules/Video_Stream/images/noimage_sm.gif\" border=\"0\" width=\"50\" height=\"50\" alt=\"".$row['vidname']."\"></a></td>";
			} else{
				echo "          <td><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."&amp;d=".$d."\"><img src=\"".$image."\" border=\"0\" width=\"50\" height=\"50\" alt=\"".$row['vidname']."\"></a></td>";
			}
			echo "        </tr>\n";
			echo "      </table>\n";
			echo "    </td>\n";
		}
		echo "  </tr>\n";
		echo "</table>\n";
		echo "</center>\n";
	}
}

//Stats Function
function stats() {
	global $db, $prefix, $sitename;
	OpenTable();
	echo "<div align=\"center\"><FONT class=title>".$sitename." "._VIDEOCOLECTION." "._STATISTICS."</FONT></div><br />\n";
	
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0");
	$totalvids = $db->sql_numrows($result);
	while ($row = $db->sql_fetchrow($result)) {
		$totalviews += $row['views'];
		$totalrates += $row['rates'];
		$totalrating += $row['rating'];
	}
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_comments");
	$totalcomments = $db->sql_numrows($result);
	
	@$averageviews = $totalviews / $totalvids;
	@$averagecomments = $totalcomments / $totalvids;
	@$averagerating = $totalrating / $totalrates;
	
	echo ""._WECURRENTHAVE." <strong>".$totalvids."</strong> "._VS_VIDEOS."<br />\n";
	echo ""._WITHALLVIDSHAD." <strong>".$totalviews."</strong> "._VS_VIEWS."<br />\n";
	echo ""._ONAVERAGE." <strong>".number_format($averageviews, 2)."</strong> "._VIEWSPERVID."<br />\n";
	echo ""._INTOTALHAVE." <strong>".$totalcomments."</strong> "._VS_COMMS."<br />\n";
	echo ""._ONAVERAGE." <strong>".number_format($averagecomments, 2)."</strong> "._COMMSPERVID."<br />\n";
	echo ""._ALLTOGETHERHAD." <strong>".$totalrates."</strong> "._VS_RATES."<br />\n";
	echo ""._AVERAGERATEPV." <strong>".number_format($averagerating, 2)."</strong><br />\n";
	CloseTable();
}

// Function for subcategories
function getparent($parentid,$title) {
	global $prefix, $db;
	$parentid = intval(trim($parentid));
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories where id='$parentid'"));
	$cid = intval($row['id']);
	$ptitle = $row['name'];
	$pparentid = $row['parent'];
	if ($ptitle=="$title") $title=$title;
	elseif ($ptitle!="") $title=$ptitle."/".$title;
	if ($pparentid!=0) {
		$title=getparent($pparentid,$title);
	}
	return $title;
}

// Function to handle updating user points
function userpointsVS($id) {
	global $prefix, $db, $looker;
	// Anon dont get points
	if($looker != "Anonymous") {
		// Get the current users points
		$result = $db->sql_query("SELECT points FROM ".$prefix."_users WHERE username='$looker'");
		$row = $db->sql_fetchrow($result);
		$points = $row['points'];
		// Get points to be given
		$result = $db->sql_query("SELECT points FROM ".$prefix."_video_stream_points WHERE id='$id'");
		$row = $db->sql_fetchrow($result);
		$pointstoadd = $row['points'];
		// Add points together and save to DB
		$points += $pointstoadd;
		$result = $db->sql_query("UPDATE ".$prefix."_users SET points='$points' WHERE username='$looker'");	
	}
}

// Function to handle the page number navigation
function pagesnav($d, $pages) {
	
	$pageB = $d;
	$pageF = $d;
	$countB = 0;
	$content = "";
	
	if ($_GET['page'] == "search") {
		$navlink = "modules.php?name=Video_Stream&page=search";
	} else {
		$navlink = "modules.php?name=Video_Stream";
	}
	
	while (($countB != 3) && ($pageB != 1)) {
		$countB += 1;
		$pageB -= 1;
		$content = "<a href=\"".$navlink."&amp;d=$pageB\">$pageB</a> ".$content."";
	}
	
	$content = "".$content." <a href=\"".$navlink."&amp;d=$d\">[$d]</a>";
	
	$count2 = 3;
	$remainder = 3 - $countB;
	$count2 += $remainder;
	$countF = 0;
	
	while (($countF != $count2) && ($pageF != $pages)) {
		$countF += 1;
		$pageF += 1;
		$content = "".$content." <a href=\"".$navlink."&amp;d=$pageF\">$pageF</a>";
	}
	echo "      ".$content."\n";
}

// Function for the video image plus plugin image
function videoimageplugin($id, $image, $plugin, $d, $vidname) {
	global $vs_plugins;
	
	// Video image find
	if(image == "") {
		$image = "<img style=\"position: absolute; top: 0; right: 0; z-index: 1\" src=\"modules/Video_Stream/images/noimage.gif\" border=\"0\" width=\"175\" height=\"150\" alt=\"".$vidname."\">";
	} else{
		$image = "<img style=\"position: absolute; top: 0; right: 0; z-index: 1\" src=\"".$image."\" border=\"0\" width=\"175\" height=\"150\" alt=\"".$vidname."\">";
	}
	// Plugin image find
	$plugin_info = explode('::', $vs_plugins[$plugin]);
	if($plugin_info[2] == "") {
		$plugin = "";
	} else {
		$plugin = "<img style=\"position: absolute; top: 0; right: 0; z-index: 2\" src=\"".$plugin_info[2]."\" border=\"0\" alt=\"".$plugin_info[0]."\">";
	}
	// Final Output
	echo "          <td><div style=\"position: relative; width: 175px; height: 150;\"><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$id."&amp;d=".$d."\">".$image . $plugin."</a></div></td>\n";
}

// Function for the adult discalimer system and registered only members
function adultcategory($id) {
	global $db, $prefix, $disclaimersigned, $looker, $regcatanon;
	$result = $db->sql_query("SELECT category FROM ".$prefix."_video_stream WHERE id='$id' LIMIT 1");
	$row = $db->sql_fetchrow($result);
	$category = $row['category'];
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id='$category' LIMIT 1");
	$row = $db->sql_fetchrow($result);
	$parent = $row['parent'];
	$adult = $row['adult'];
	$permission = $row['permission'];
	// Find parent category
	while ($parent != 0) {
		$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id='$parent' LIMIT 1");
		$row = $db->sql_fetchrow($result);
		$parent = $row['parent'];
		$adult = $row['adult'];
		$permission = $row['permission'];
	}
	// If adult = 1 then do checking
	if(($adult == 1) && ($disclaimersigned != 1)) {
		$returnurl = base64_encode($_SERVER['QUERY_STRING']);
		header("Location: modules.php?name=Video_Stream&page=disclaimer&rurl=".$returnurl."");
		die();
	}
	// If permission = 1 then do checking
	if(($permission == 1) && ($looker == "Anonymous")) {
		$regcatanon = 1;	
	}
}
?>