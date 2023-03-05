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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}
$index=0;
$id = $_GET['id'];
$request = $_GET['request'];

if($id == "request") {
	// Gets the data of request video **FOR ADMIN**
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE id='$request'");
	$row = $db->sql_fetchrow($result);
} else {
	// Check if category is adult category and requires user to accept disclaimer or if required of the user to be registered
	adultcategory($id);
	// Add user point for veiwing video
	userpointsVS(1);
	// adds a view to the video
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE id='$id'");
	$row = $db->sql_fetchrow($result);
	$v = $row['views'];
	$v++;
	$result = $db->sql_query("UPDATE ".$prefix."_video_stream SET views='$v' WHERE id='$id'");
	// Gets the data of that video
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE id='$id'");
	$row = $db->sql_fetchrow($result);	
}
// Variable Setup
$plugin = $row['flash'];
$userav = $row['user'];
$id = $row['id'];
$vidname = str_replace(' ', '-', $row['vidname']);
$url = $row['url'];
$popwidth = $row['width'] + 20;
$popheight =  $row['height'] + 30;
$pagetitle = " - "._VS_VIDEOS." - ".$row['vidname'];
//***********************************


include_once('header.php');
include_once('modules/Video_Stream/javascript.php');
echo "<LINK REL=\"StyleSheet\" HREF=\"modules/Video_Stream/css.css\" TYPE=\"text/css\">";
echo "<script language=\"Javascript\" type=\"text/javascript\" src=\"modules/Video_Stream/ajrate.js\"></script>\n";
vsnavtop();
OpenTable();
echo "<a name=\"VStop\">";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td colspan=\"2\">\n";

echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"100%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellpadding=\"5\">\n";
echo "      <tr>\n";
echo "        <td align=\"center\" valign=\"top\" nowrap>\n";
avatars($userav);
echo "		  </td>\n";
echo "        <td width=\"100%\" valign=\"top\"><a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."\">".$row['vidname']."</a><br />".$row['user']."  <a href=\"modules.php?name=Video_Stream&amp;page=search&amp;search=user:".$row['user']."\">["._MOREFROMUSER."]</a></td>\n";
echo "      </tr>\n";
echo "      <tr>\n";
echo "        <td colspan=\"2\" valign=\"top\" width=\"100%\">".$row['description']."</td>\n";
echo "        </tr>\n";
echo "    </table></td>\n";
echo "    <td align=\"center\" valign=\"top\" nowrap>\n";
category($id);
echo "	  </td>\n";
echo "  </tr>\n";
echo "</table>\n";

echo "	  </td>\n";
echo "  </tr>\n";
if((($viewV == 1) && ($looker == "Anonymous")) || ($regcatanon == 1)) {
	echo "<tr><td><br /><center><strong>"._REGWATCH."</strong></center><br /></td></tr>";
} else {
	echo "  <tr>\n";
	echo "    <td valign=\"top\" nowrap>\n";
	
	$plugin_info = explode('::', $vs_plugins[$plugin]);
	include_once($plugin_info[1]);
	echo $embedcode;
	$embedcode = htmlentities($embedcode, ENT_QUOTES);
	$currenturlVS = $_SERVER['SERVER_NAME'];
	$checking = substr($currenturlVS, 0, 7); 
	if ($checking != "http://") { $currenturlVS = "http://".$currenturlVS; }
	$currenturlVS = $currenturlVS.$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING'];
	
	echo "    </td>\n";
	echo "    <td width=\"100%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">\n";
	echo "      <tr>\n";
	echo "        <td><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n";
	echo "          <tr>\n";
	echo "            <td colspan=\"2\" class=\"videostream\"><strong>"._VS_INFO.":</strong></td>\n";
	echo "            </tr>\n";
	echo "          <tr>\n";
	echo "            <td nowrap class=\"videostream\"><strong>"._POSTEDON.":</strong></td>\n";
	echo "            <td width=\"100%\">".$row['date']."</td>\n";
	echo "          </tr>\n";
	echo "          <tr>\n";
	echo "            <td nowrap class=\"videostream\"><strong>"._VIEWS.":</strong></td>\n";
	echo "            <td>".$row['views']."</td>\n";
	echo "          </tr>\n";
	// Show Broken link
	if($brokenED == 1) {
		echo "          <tr>\n";
		echo "            <td nowrap class=\"videostream\"><strong>"._BROKEN.":</strong></td>\n";
		echo "            <td><a href=\"modules.php?name=Video_Stream&amp;page=broken&amp;id=".$id."&amp;vidname=".$vidname."\">"._REPORTASBROKEN."</a></td>\n";
		echo "          </tr>\n";
	}
	// End Broken Link
	echo "          <tr>\n";
	echo "            <td colspan=\"2\" nowrap>&nbsp;</td>\n";
	echo "          </tr>\n";
	// Rating and Comment part
	if(($ratingED != 0) && ($commentEDDD != 0)) {
		echo "          <tr>\n";
		echo "            <td colspan=\"2\" nowrap class=\"videostream\"><strong>"._RATINGSANDREVIEWS.":</strong></td>\n";
		echo "          </tr>\n";
		// Rating if enabled	
		if($ratingED == 1) {
			if(($ratingED == 1) && !(($ratingV == 1) && ($looker == "Anonymous"))) {
				echo "          <tr>\n";
				echo "            <td nowrap class=\"videostream\"><strong>"._RATE.":</strong></td>\n";
				echo "            <td>\n";
				//Chech for Prev rating
				$vsratingcookie = $_COOKIE["video_stream_rating"];
				$vsratingcookie = explode(':', $vsratingcookie);
				if(array_search($id, $vsratingcookie) !== false) {
					echo "You have already voted for this video\n";
				} else {
					echo "              <div id=\"ajratediv\">\n";
					echo "                <a href=\"javascript:ajrate(1, ".$id.")\"><img src=\"modules/Video_Stream/images/star.gif\" alt=\"1\" border=\"0\" /></a>\n";
					echo "                <a href=\"javascript:ajrate(2, ".$id.")\"><img src=\"modules/Video_Stream/images/star.gif\" alt=\"2\" border=\"0\" /></a>\n";
					echo "                <a href=\"javascript:ajrate(3, ".$id.")\"><img src=\"modules/Video_Stream/images/star.gif\" alt=\"3\" border=\"0\" /></a>\n";
					echo "                <a href=\"javascript:ajrate(4, ".$id.")\"><img src=\"modules/Video_Stream/images/star.gif\" alt=\"4\" border=\"0\" /></a>\n";
					echo "                <a href=\"javascript:ajrate(5, ".$id.")\"><img src=\"modules/Video_Stream/images/star.gif\" alt=\"5\" border=\"0\" /></a>\n";
					echo "              </div>\n";
				}
				echo "            </td>\n";
				echo "          </tr>\n";
			}
			echo "          <tr>\n";
			echo "            <td nowrap class=\"videostream\"><strong>"._RATING.":</strong></td>\n";
			echo "            <td>"._RATING.": ".@number_format(($row['rating'] / $row['rates']), 2)." "._TVOTES.": ".$row['rates']."</td>\n";
			echo "          </tr>\n";
		}
		// END Rating if enabled
		if(($commentEDDD == 1) && !(($commentVVV == 1) && ($looker == "Anonymous"))) {
			echo "          <tr>\n";
			echo "            <td nowrap class=\"videostream\"><strong>"._VS_COMMENT.":</strong></td>\n";
			echo "            <td><a href=\"javascript:loadcomment(".$id.")\">"._ADDCOMMENTTOVID."</a></td>\n";
			echo "          </tr>\n";
		}
		echo "          <tr>\n";
		echo "            <td colspan=\"2\" nowrap>&nbsp;</td>\n";
		echo "          </tr>\n";
	}
	// End comment and ratingpart
	echo "          <tr>\n";
	echo "            <td colspan=\"2\" nowrap class=\"videostream\"><strong>"._TELLEVERYBOUTVID.": </strong></td>\n";
	echo "            </tr>\n";
	echo "          <tr>\n";
	echo "            <td nowrap class=\"videostream\"><strong>"._HTMLLINK.": </strong></td>\n";
	echo "            <td><input name=\"textfield\" type=\"text\" size=\"30\" value=\"&lt;a href=&quot;".$currenturlVS."&quot;&gt;Video - ".$row['vidname']."&lt;/a&gt; \" /></td>\n";
	echo "          </tr>\n";
	echo "          <tr>\n";
	echo "            <td nowrap class=\"videostream\"><strong>"._BBLINK.":</strong></td>\n";
	echo "            <td><input name=\"textfield\" type=\"text\" size=\"30\" value=\"[url=".$currenturlVS."]Video - ".$row['vidname']."[/url]\" /></td>\n";
	echo "          </tr>\n";
	if(($embededED == 1) && !(($embededV == 1) && ($looker == "Anonymous"))) {
		echo "          <tr>\n";
		echo "            <td nowrap class=\"videostream\"><strong>"._EMBEDEDHTML.":</strong></td>\n";
		echo "            <td><input name=\"textfield\" type=\"text\" size=\"30\" value=\"".$embedcode."\" /></td>\n";
		echo "          </tr>\n";
	}
	if($sendED == 1) {
		echo "          <tr>\n";
		echo "            <td nowrap class=\"videostream\"><strong>"._EMAILLINK.":</strong></td>\n";
		echo "            <td><a href=\"javascript:loadsend(".$id.")\">"._SENDTOAFRIEND."</a></td>\n";
		echo "          </tr>\n";
	}
	if(($downloadED == 1) && !(($downloadV == 1) && ($looker == "Anonymous"))) {
		echo "          <tr>\n";
		echo "            <td nowrap class=\"videostream\"><strong>"._DOWNLOAD.":</strong></td>\n";
		echo "            <td><a href=\"".$url."\" target=\"_blank\">"._DOWNLOADVID."</a></td>\n";
		echo "          </tr>\n";
	}
	echo "        </table><br /><center><a href=\"javascript:loadvidpop(".$id.", ".$popheight.", ".$popwidth.")\">"._PLAYINPOPUP."</a></center></td>\n";
	echo "      </tr>\n";
	echo "    </table>\n";
	echo "    </td>\n";
	echo "  </tr>\n";
}
echo "</table>\n";
// Ten Random Videos
tenrandvids($id);
// Comments layout at the bottom of video. No need to remove this.
include_once('modules/Video_Stream/commentlayout.php');

//***************************************************************
// IF YOU WANT TO LEGALY REMOVE ANY COPYRIGHT NOTICES PLAY FAIR AND CHECK: http://phpnuke-downloads.com/modules.php?name=Commercial_License
// COPYRIGHT NOTICES ARE GPL SECTION 2(c) COMPLIANT AND CAN'T BE REMOVED WITHOUT PHPNuke-Downloads' AUTHOR WRITTEN AUTHORIZATION
// YOU'RE NOT AUTHORIZED TO CHANGE THE CODE UNTIL YOU ACQUIRE A COMMERCIAL LICENSE
// (http://phpnuke-downloads.com/modules.php?name=Commercial_License)
//***************************************************************
echo "<br />\n";
OpenTable();
echo "HTTP Video Stream Module<br />By <a href=\"http://phpnuke-downloads.com\" title=\"PHP-Nuke\">phpNuke</a>\n";
CloseTable();
// END OF COPYRIGHT

//CloseTable();
include_once('footer.php');
?>