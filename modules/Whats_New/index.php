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


/************************************************/
/* What's New Module For PHP-Nuke		*/
/* Written by: Jonathan Estrella			*/
/* http://metalrebelde.metropoliglobal.com	*/
/* Copyright (c) 2004-2006 Jonathan Estrella	*/
/************************************************/

define('IN_WNM', true);

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/wnconfig.php");
get_lang($module_name);



include_once("header.php");



OpenTable();

echo "<div style=\"text-align: center;\"><img border=\"0\" src=\"modules/$module_name/images/whats_new.png\" alt=\"\"><br />\n";
echo "[&nbsp;";
if (is_active("$newsmod")) { echo "<a href=\"#$newsmod\">"._NEWS."</a>\n"; }
if (is_active("$reviewsmod")) { echo "&nbsp;| <a href=\"#$reviewsmod\">"._REVIEWS."</a>\n"; }
if (is_active("$contentmod")) { echo "&nbsp;| <a href=\"#$contentmod\">"._CONTENT."</a>\n"; }
if (is_active("$downloadsmod")) { echo "&nbsp;| <a href=\"#$downloadsmod\">"._DOWNLOADS."</a>\n"; }
if (is_active("$weblinksmod")) { echo "&nbsp;| <a href=\"#$weblinksmod\">"._WEBLINKS."</a>\n"; }
if (is_active("$topmusicmod")) { echo "&nbsp;| <a href=\"#$topmusicmod\">"._TOPMUSIC."</a>\n"; }
if (is_active("$youraccountmod")) { echo "&nbsp;| <a href=\"#"._USERS."\">"._USERS."</a>\n"; }
echo "&nbsp;]</div>";

CloseTable();

OpenTable();



/* Latest Headlines */
if (is_active("$newsmod")) {

	global $prefix, $db;

	$result = $db->sql_query("SELECT sid, title, counter FROM ".$prefix."_stories  ORDER BY time DESC LIMIT 0, $ipb");

	if ($db->sql_numrows($result) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$newsmod\">"._LATESTSTORIES."</a></span></font><br /><font class=\"content\">\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row = $db->sql_fetchrow($result)) {

			$sid = intval($row['sid']);

			$title = stripslashes(check_html($row['title'], "nohtml"));

			$counter = intval($row['counter']);
			$nsnlink = "modules.php?name=$newsmod&amp;op=NEArticle&amp;sid=$sid";
			$normallink = "modules.php?name=$newsmod&amp;file=article&amp;sid=$sid";
			if ($nsnnews) {$dlink=$nsnlink;} else {$dlink=$normallink;}

			if($counter>0) {

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"$dlink\">$title</a></font></td>"

				."<td align=\"right\" width=\"25%\">($counter "._READS.")\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br />\n";

	}
}



/* Latest Reviews */
if (is_active("$reviewsmod")) {

	$result2 = $db->sql_query("SELECT id, title, hits FROM ".$prefix."_reviews ORDER BY date DESC LIMIT 0,$ipb");

	if ($db->sql_numrows($result2) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$reviewsmod\">"._LATESTREVIEWS."</a></span></font><br /><font class=\"content\">\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row2 = $db->sql_fetchrow($result2)) {

			$id = intval($row2['id']);

			$title = stripslashes($row2['title']);

			$hits = intval($row2['hits']);

			if($hits>0) {

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"modules.php?name=$reviewsmod&amp;rop=showcontent&amp;id=$id\">$title</a></font></td>"

				."<td align=\"right\" width=\"25%\">($hits "._READS.")\n"
				."</td></tr>\n";

				$lugar++;			

			}

		}
		echo "</table><br /><br />\n";
	}
}



/* Latest Downloads */

if (is_active("$downloadsmod")) {
	if ($nsngd) {
		$dsql = "SELECT lid, cid, title, hits FROM ".$prefix."_nsngd_downloads ORDER BY date DESC LIMIT 0,$ipb";
	} else {
		$dsql = "SELECT lid, cid, title, hits FROM ".$prefix."_downloads_downloads ORDER BY date DESC LIMIT 0,$ipb";
	}
	$result3 = $db->sql_query($dsql);

	if ($db->sql_numrows($result3) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=$bgcolor3><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$downloadsmod\">"._LATESTDOWNLOADS."</a></span></font><br /><font class=\"content\">\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row3 = $db->sql_fetchrow($result3)) {

			$lid = intval($row3['lid']);

			$cid = intval($row3['cid']);

			$title = stripslashes(check_html($row3['title'], "nohtml"));

			$hits = intval($row3['hits']);

			if($hits>0) {
				if ($nsngd) {
					$rsql = "SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='$cid'";
				} else {
					$rsql = "SELECT title FROM ".$prefix."_downloads_categories WHERE cid='$cid'";
				}

				$row_res = $db->sql_fetchrow($db->sql_query($rsql));

				$ctitle = stripslashes($row_res['title']);

				$utitle = preg_replace("/ /", "/_/", $title);

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"modules.php?name=$downloadsmod&amp;d_op=viewdownloaddetails&amp;lid=$lid&amp;ttitle=$utitle\">$title</a> ("._CATEGORY.": $ctitle)</font></td>\n"

				."<td align=\"right\" width=\"25%\">($hits "._LDOWNLOADS.")\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br /><br />\n";

	}
}



/* Latest Content Pages */

if (is_active("$contentmod")) {
	$result4 = $db->sql_query("SELECT pid, cid, title, counter FROM ".$prefix."_pages WHERE active='1' ORDER BY date DESC LIMIT 0,$ipb");

	if ($db->sql_numrows($result4) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$contentmod\">"._LATESTPAGES."</a></span></font><br /><font class=\"content\">\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row4 = $db->sql_fetchrow($result4)) {

			$pid = intval($row4['pid']);

			$cid = intval($row4['cid']);

			$title = stripslashes(check_html($row4['title'], "nohtml"));

			$counter = intval($row4['counter']);

			if($counter>0) {

				$row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_pages_categories WHERE cid='$cid'"));

				$ptitle = stripslashes($row_res['title']);

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"modules.php?name=$contentmod&amp;pa=showpage&amp;pid=$pid\">$title</a> ("._CATEGORY.": $ptitle)</font></td>"

				."<td align=\"right\" width=\"25%\">($counter "._READS.")<br />\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br /><br />\n";

	}
}



/* Latest Web Links */

if (is_active("$weblinksmod")) {
	$result5 = $db->sql_query("SELECT lid, cid, title, url, hits, date FROM ".$prefix."_links_links ORDER BY date desc limit 0,$ipb");

	if ($db->sql_numrows($result5) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$weblinksmod\">"._LATESTLINKS."</a></span></font><br /><font class=\"content\">\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row5 = $db->sql_fetchrow($result5)) {

			$hits = intval($row5['hits']);

			$lid = intval($row5['lid']);

			$cid = intval($row5['cid']);

			$title = stripslashes($row5['title']);

			$url = stripslashes($row5['url']);

			if($counter>0) {

				$row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_categories WHERE cid='$cid'"));

				$ltitle = stripslashes($row_res['title']);		

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a target=\"blank\" href=\"modules.php?name=$weblinksmod&amp;l_op=visit&amp;lid=$lid\">$title</a> ("._CATEGORY.": $ltitle)</font></td>"

				."<td align=\"right\" width=\"25%\">($hits "._LHITS.")<br />\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br /><br />\n";

	}
}



/* Latest Artists in topMusic */

if (is_active("$topmusicmod")) {
	$result6 = $db->sql_query("SELECT idartist, idgenre, name, views FROM ".$prefix."_topmusic_artist ORDER BY idartist DESC LIMIT 0,$ipb");

	if ($db->sql_numrows($result6) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\"$topmusicmod\">"._LATESTBANDS."</a></span></font><br />\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row6 = $db->sql_fetchrow($result6)) {

			$idartist = intval($row6['idartist']);

			$idgenre = intval($row6['idgenre']);

			$artist = stripslashes($row6['name']);

			$views = intval($row6['views']);

			if($counter>0) {

				$row_res = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_topmusic_genre_lang WHERE idgenre='$idgenre'"));

				$gtitle = stripslashes($row_res['name']);

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"modules.php?name=$topmusicmod&amp;op=artist&amp;idartist=$idartist\">$artist</a> ("._TMGENRE.": $gtitle)</font></td>"

				."<td align=\"right\" width=\"25%\">($views "._LHITS.")<br />\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br /><br />\n";

	}
}



/* Latest Users */

if (is_active("$youraccountmod")) {
	$result7 = $db->sql_query("SELECT user_id, username, points, user_regdate FROM ".$user_prefix."_users ORDER BY user_id desc limit 0,$ipb");

	if ($db->sql_numrows($result7) > 0) {

		echo "<table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n"
		."<tr bgcolor=\"$bgcolor3\"><td colspan=\"2\" align=\"center\">\n"

		."<font class=\"option\"><span style=\"font-weight: bold;\">$ipb <a name=\""._USERS."\">"._LATESTUSERS."</a></span></font><br />\n"
		."</td></tr>\n";

		$lugar=1;

		while ($row7 = $db->sql_fetchrow($result7)) {

			$title = stripslashes(check_html($row7['username'], "nohtml"));

			$points = intval($row7['points']);

			if($counter>0) {

				echo "<tr bgcolor=\"$bgcolor4\"><td width=\"75%\">\n"
				."<font class=\"content\"><span style=\"font-weight: bold;\"><big>&middot;</big></span>&nbsp;$lugar: <a href=\"modules.php?name=$youraccountmod&op=userinfo&username=$title\">$title</a></font></td>\n"

				."<td align=\"right\" width=\"25%\">($points "._POINTS.")<br />\n"
				."</td></tr>\n";

				$lugar++;

			}

		}

		echo "</table><br /><br /><br />\n";

	}
}

echo "<div style=\"text-align: center;\">\n"
."[ <a href=\"#\"><span style=\"font-weight: bold;\">"._BACK2TOP."</span></a> ]<br /><br /></div>\n";



CloseTable();

include_once("footer.php");



?>
