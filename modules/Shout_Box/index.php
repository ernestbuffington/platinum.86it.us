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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}



$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = "- "._SHOUTHISTORY."";

$index = 1;



include_once("config.php");

global $db, $user, $cookie, $prefix, $username;

cookiedecode($user);

$username = $cookie[1];

if ($username == "") { $username = "Anonymous"; }

$sql = "select * from ".$prefix."_shoutbox_conf";

$result = $db->sql_query($sql);

$conf = $db->sql_fetchrow($result);



//do IP test then ban if on list

$uip = $_SERVER['REMOTE_ADDR'];

if($conf['ipblock'] == "yes") {

	$sql = "select * from ".$prefix."_shoutbox_ipblock";

	$ipresult = $db->sql_query($sql);

	while ($badips = $db->sql_fetchrow($ipresult)) {

		if (preg_match("/\*/", $badips['name'])) { // Allow for Subnet bans like 123.456.*

			$badipsArray = explode(".",$badips['name']);

			$uipArray = explode(".",$uip);

			$i = 0;

			foreach($badipsArray as $badipsPart) {

				if ($badipsPart == "*") { $Action = "UserBanned"; break; }

				if ($badipsPart != $uipArray[$i] AND $badipsPart != "*") { break; }

				$i++;

			}

		} else {

			if($uip == $badips['name']) { $Action = "UserBanned"; break; }

		}

	}

}



//do name test then ban if on list (only applies to registered users)

if($conf['nameblock'] == "yes" AND $Action != "UserBanned") {

	$sql = "select * from ".$prefix."_shoutbox_nameblock";

	$nameresult = $db->sql_query($sql);

	while ($badname = $db->sql_fetchrow($nameresult)) {

		if($username == $badname['name']) { $Action = "UserBanned"; break; }

	}

}



function searchHistory($where, $sbsearchtext, $results, $style, $timeframe, $order) {

	include_once("config.php");

	global $db, $user, $cookie, $prefix, $username, $AvatarFound;

	include_once("header.php");

	cookiedecode($user);

	$username = $cookie[1];

	if ($username == "") {

		$username = "Anonymous";

	}



	if (is_user($user)) {

		$username = $cookie[1];

		if ($username != '') {

			$sqlF = "SELECT user_timezone, user_dateformat from ".$prefix."_users WHERE username='$username'";

			$resultF = $db->sql_query($sqlF);

			$userSetup = $db->sql_fetchrow($resultF);

		}

	}

	$sql = "select * from ".$prefix."_shoutbox_date";

	$resultD = $db->sql_query($sql);

	$rowD = $db->sql_fetchrow($resultD);



	// search form

	OpenTable();

	showSearchBox($sbsearchtext, $where, $style, $results, $timeframe, $order);

	echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";

	echo "<tr><td align=\"center\"><a href=\"modules.php?name=Shout_Box&amp;page=1\">"._SHOUTHISTORY."</a></td></tr></table>";

	CloseTable();

	echo "<br />";

	// show results

	OpenTable();

	if ($results > 50) { $results = 50; }

	if ($results < 10) { $results = 10; }



	echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";

	echo "<tr><td align=\"center\"><span class=\"title\">"._SEARCHRESULTS."</span></td></tr>\n";

	//echo "<tr><td><table cellpadding=\"0\" width=\"100%\" cellspacing=\"0\" border=\"0\"><tr><td width=\"50%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/history.gif\" alt=\"\" /></td><td width=\"50%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SEARCHRESULTS."</span></td></tr></table></td></tr>\n";

	// build SQL query based on user choices

	//$sql = "select * from ".$prefix."_shoutbox_shouts WHERE name='$sbsearchtext' ORDER BY id desc LIMIT $results";

	// search by Nicknames only

	if ($where == 'Nicknames') {

		$SearchArray = explode(" ",$sbsearchtext);

		$c = count($SearchArray);

		$d = 0;

		$sql = "select * from ".$prefix."_shoutbox_shouts WHERE name";

		foreach($SearchArray as $SearchPart) {

			$d++;

			if ($style == 'Exact') {

				$sql .= "='".$SearchPart."'";

			} else {

				$sql .= " LIKE '%".$SearchPart."%'";

			}

			if ($d < $c) { $sql .= " OR name"; }

		}

	} elseif ($where == 'Both') {

	// search by Nicknames and Shouts

		if ($style == 'Exact') {

			$sql = "select * from ".$prefix."_shoutbox_shouts WHERE name='$sbsearchtext' OR comment='$sbsearchtext'";

		} else {

			$SearchArray = explode(" ",$sbsearchtext);

			$c = count($SearchArray);

			$d = 0;

			$sql = "select * from ".$prefix."_shoutbox_shouts WHERE name";

			foreach($SearchArray as $SearchPart) {

				$d++;

				$sql .= " LIKE '%".$SearchPart."%' OR comment LIKE '%".$SearchPart."%'";

				if ($d < $c) { $sql .= " OR name"; }

			}

		}

	} else {

	// search by Shouts only

		if ($style == 'Exact') {

			$sql = "select * from ".$prefix."_shoutbox_shouts WHERE comment LIKE '%".$sbsearchtext."%'";

		} else {

			$SearchArray = explode(" ",$sbsearchtext);

			$c = count($SearchArray);

			$d = 0;

			$sql = "select * from ".$prefix."_shoutbox_shouts WHERE comment";

			foreach($SearchArray as $SearchPart) {

				$d++;

				$sql .= " LIKE '%".$SearchPart."%'";

				if ($d < $c) { $sql .= " AND comment"; }

			}

		}

	}

	if (($order == '') OR ($order == 'newest')) { $sql .= " ORDER BY id desc"; }

	else { $sql .= " ORDER BY id asc"; }

	$sql .= " LIMIT $results";

	// end building SQL query

	$result = $db->sql_query($sql);

	$numrows = $db->sql_numrows($result);

	if ($numrows > 0) {

		$sqlz = "select * from ".$prefix."_shoutbox_conf";

		$resultz = $db->sql_query($sqlz);

		$conf = $db->sql_fetchrow($resultz);

		$post = 0;

		$loop = 0;

		$flag = 1;



		$ThemeSel = get_theme();

		$sql = "select * from ".$prefix."_shoutbox_themes WHERE themeName='$ThemeSel'";

		$resultT = $db->sql_query($sql);

		$rowColor = $db->sql_fetchrow($resultT);



		while ($row = $db->sql_fetchrow($result)) {

			if ($flag == 1) { $bgcolor = $rowColor['menuColor1']; }

			if ($flag == 2) { $bgcolor = $rowColor['menuColor2']; }

			$comment = str_replace('src=', 'src="', $row['comment']);

			$comment = str_replace('.gif>', '.gif" alt="" />', $comment);

			$comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);

			$comment = str_replace('.png>', '.png" alt="" />', $comment);

			$comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);



			// BB code [b]word[/b] [i]word[/i] [u]word[/u]

			if ((preg_match("/[b]/", $comment)) AND (preg_match("/[/b]/", $comment)) AND (substr_count("$comment","[b]") == substr_count("$comment","[/b]"))) {

				$comment = preg_replace("/\[b\]/","<span style=\"font-weight: bold\">","$comment");

				$comment = preg_replace("/\[\/b\]/","</span>","$comment");

			}

			if ((preg_match("/[i]/", $comment)) AND (preg_match("/[/i]/", $comment)) AND (substr_count("$comment","[i]") == substr_count("$comment","[/i]"))) {

				$comment = preg_replace("/\[i\]/","<span style=\"font-style: italic\">","$comment");

				$comment = preg_replace("/\[\/i\]/","</span>","$comment");

			}

			if ((preg_match("/[u]/", $comment)) AND (preg_match("/[/u]/", $comment)) AND (substr_count("$comment","[u]") == substr_count("$comment","[/u]"))) {

				$comment = preg_replace("/\[u\]/","<span style=\"text-decoration: underline\">","$comment");

				$comment = preg_replace("/\[\/u\]/","</span>","$comment");

			}



			$sqlN = "SELECT * FROM ".$prefix."_users WHERE username='$row[name]'";

			$nameresultN = $db->sql_query($sqlN);

			$rowN = $db->sql_fetchrow($nameresultN);



			// Disallow Anonymous users from seeing links to users' accounts

			if ($username == "Anonymous") {

				if (($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {

					echo "<tr><td style=\"background-color: $bgcolor;\">";

					echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";

					echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";

					$row_avatar = $rowN['user_avatar'];

					$av_found = findAvatar($row_avatar);

					echo "$av_found";

					echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\">";

					echo "<strong>$row[name]:</strong> $comment";

					if ($conf['date'] == "yes") {

						if ($row['timestamp'] != '') {

							// reads unix timestamp and formats it to the viewer's timezone

							if (is_user($user)) {

								// time adjustment for following user's timezone

								$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

								$displayTime = $displayTime * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

								echo "<br />$unixTime";

							} else {

								// adjustmet for timezone offset

								$displayTime = $conf['timeOffset'] * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixDay = date("$rowD[date]", $newTimestamp);

								$unixTime = date("$rowD[time]", $newTimestamp);

								echo "<br />$unixDay&nbsp;$unixTime";

							}

						} else {

							echo "<br />$row[date]&nbsp;$row[time]";

						}

					}

					echo "</td></tr></table>";

					echo "</td></tr>\n";

				} else {

					echo "<tr><td style=\"background-color: $bgcolor;\">";

					echo "<strong>$row[name]:</strong> $comment";

					if ($conf['date'] == "yes") {

						if ($row['timestamp'] != '') {

							// reads unix timestamp and formats it to the viewer's timezone

							if (is_user($user)) {

								// time adjustment for following user's timezone

								$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

								$displayTime = $displayTime * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

								echo "<br />$unixTime";

							} else {

								// adjustmet for timezone offset

								$displayTime = $conf['timeOffset'] * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixDay = date("$rowD[date]", $newTimestamp);

								$unixTime = date("$rowD[time]", $newTimestamp);

								echo "<br />$unixDay&nbsp;$unixTime";

							}

						} else {

							echo "<br />$row[date]&nbsp;$row[time]";

						}

					}

					echo "</td></tr>\n";

				}

			} else {

				// check to see if nickname is a user in the DB and not Anonymous

				if (($rowN) && ($rowN['username'] != "Anonymous")) {

					if (($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {

						echo "<tr><td style=\"background-color: $bgcolor;\">";

						echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";

						echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";

						$row_avatar = $rowN['user_avatar'];

						$av_found = findAvatar($row_avatar);

						echo "$av_found";

						echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\"><strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\"><font color=$color>$row[name]</a>:</strong></font> $comment<br />"; // UsernameColor Addon

						if ($conf['date'] == "yes") {

							if ($row['timestamp'] != '') {

								// reads unix timestamp and formats it to the viewer's timezone

								if (is_user($user)) {

									// time adjustment for following user's timezone

									$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

									$displayTime = $displayTime * 3600;

									$newTimestamp = $row['timestamp'] + $displayTime;

									$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

									echo "$unixTime";

								} else {

									// adjustmet for timezone offset

									$displayTime = $conf['timeOffset'] * 3600;

									$newTimestamp = $row['timestamp'] + $displayTime;

									$unixDay = date("$rowD[date]", $newTimestamp);

									$unixTime = date("$rowD[time]", $newTimestamp);

									echo "$unixDay&nbsp;$unixTime";

								}

							} else {

								echo "$row[date]&nbsp;$row[time]";

							}

						}

						// registered users edit/delete posts

						if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {

							echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=$row[id]&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=$row[id]&amp;page=$page\">"._DELETE."</a> &#93;";

						}

						echo "</td></tr></table>";

						echo "</td></tr>\n";

					} else {

						echo "<tr><td style=\"background-color: $bgcolor;\">";

						echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\"><font color=$color><strong>$row[name]:</strong></font></a> $comment<br />"; // UsernameColor Addon

						if ($conf['date'] == "yes") {

							if ($row['timestamp'] != '') {

								// reads unix timestamp and formats it to the viewer's timezone

								if (is_user($user)) {

									// time adjustment for following user's timezone

									$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

									$displayTime = $displayTime * 3600;

									$newTimestamp = $row['timestamp'] + $displayTime;

									$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

									echo "$unixTime";

								} else {

									// adjustmet for timezone offset

									$displayTime = $conf['timeOffset'] * 3600;

									$newTimestamp = $row['timestamp'] + $displayTime;

									$unixDay = date("$rowD[date]", $newTimestamp);

									$unixTime = date("$rowD[time]", $newTimestamp);

									echo "$unixDay&nbsp;$unixTime";

								}

							} else {

								echo "$row[date]&nbsp;$row[time]";

							}

						}

						// registered users edit/delete posts

						if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {

							echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=$row[id]&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=$row[id]&amp;page=$page\">"._DELETE."</a> &#93;";

						}

						echo "</td></tr>\n";

					}

				} else {

					echo "<tr><td style=\"background-color: $bgcolor;\">";

					echo "<strong>$row[name]:</strong> $comment";

					if ($conf['date'] == "yes") {

						if ($row['timestamp'] != '') {

							// reads unix timestamp and formats it to the viewer's timezone

							if (is_user($user)) {

								// time adjustment for following user's timezone

								$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

								$displayTime = $displayTime * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

								echo "<br />$unixTime";

							} else {

								// adjustmet for timezone offset

								$displayTime = $conf['timeOffset'] * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixDay = date("$rowD[date]", $newTimestamp);

								$unixTime = date("$rowD[time]", $newTimestamp);

								echo "<br />$unixDay&nbsp;$unixTime";

							}

						} else {

							echo "<br />$row[date]&nbsp;$row[time]";

						}

					}

					echo "</td></tr>\n";

				}

			}

			if ($flag == 1) { $flag = 2; }

			elseif ($flag == 2) { $flag =1; }

		}

	} else {

		echo "<tr><td><table cellpadding=\"3\" cellspacing=\"0\" border=\"1\" align=\"center\">\n";

		echo "<tr><td align=\"center\">"._NORESULTS."</td></tr></table></td></tr>";

	}

	echo "</table>";

	CloseTable();

	include_once("footer.php");

}



function showSearchBox($sbsearchtext, $where, $style, $results, $timeframe, $order) {

	echo "<form name=\"shoutform3\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";

	echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"95%\" border=\"0\" align=\"center\">\n";

	echo "<tr><td align=\"center\"><span class=\"title\">"._SEARCHBOX."</span></td></tr>\n";

	//echo "<tr><td width=\"50%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/search.jpg\" alt=\"\" /></td><td width=\"50%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SEARCHBOX."</span></td></tr>\n";

	echo "<tr><td colspan=\"2\" align=\"center\" nowrap=\"nowrap\" valign=\"middle\">";



	if (($where == 'Shouts') OR ($where == '')) { $wSEL1 = " selected=\"selected\""; } else { $wSEL1 = ""; }

	if ($where == 'Nicknames') { $wSEL2 = " selected=\"selected\""; } else { $wSEL2 = ""; }

	if ($where == 'Both') { $wSEL3 = " selected=\"selected\""; } else { $wSEL3 = ""; }

	echo "<select name=\"where\">

	<option value=\"Shouts\"$wSEL1>"._SHOUTS."</option>

	<option value=\"Nicknames\"$wSEL2>"._SBNICKNAMES."</option>

	<option value=\"Both\"$wSEL3>"._SBBOTH."</option></select>&nbsp;&nbsp;";



	if (($style == 'Exact') OR ($style == '')) { $sSEL1 = " selected=\"selected\""; } else { $sSEL1 = ""; }

	if ($style == 'Any') { $sSEL2 = " selected=\"selected\""; } else { $sSEL2 = ""; }

	echo "<select name=\"style\">

	<option value=\"Exact\"$sSEL1>"._EXACTPHRASE."</option>

	<option value=\"Any\"$sSEL2>"._FUZZY."</option>

	</select>&nbsp;&nbsp;";



	if (($results == 10) OR ($results == '')) { $rSEL10 = " selected=\"selected\""; } else { $rSEL10 = ""; }

	if ($results == 20) { $rSEL20 = " selected=\"selected\""; } else { $rSEL20 = ""; }

	if ($results == 30) { $rSEL30 = " selected=\"selected\""; } else { $rSEL30 = ""; }

	if ($results == 50) { $rSEL50 = " selected=\"selected\""; } else { $rSEL50 = ""; }

	echo "<select name=\"results\">

	<option value=\"10\"$rSEL10>10 "._SBRESULTS."</option>

	<option value=\"20\"$rSEL20>20 "._SBRESULTS."</option>

	<option value=\"30\"$rSEL30>30 "._SBRESULTS."</option>

	<option value=\"50\"$rSEL50>50 "._SBRESULTS."</option></select>&nbsp;&nbsp;";



//	Search by time frame:

// 	if (($timeframe == 0) OR ($timeframe == '')) { $tfSEL0 = " selected=\"selected\""; } else { $tfSEL0 = ""; }

// 	if ($timeframe == 3) { $tfSEL3 = " selected=\"selected\""; } else { $tfSEL3 = ""; }

// 	if ($timeframe == 6) { $tfSEL6 = " selected=\"selected\""; } else { $tfSEL6 = ""; }

// 	if ($timeframe == 12) { $tfSEL12 = " selected=\"selected\""; } else { $tfSEL12 = ""; }

// 	echo "<select name=\"timeframe\">

// 	<option value=\"0\"$tfSEL0>"._ANYTIME."</option>

// 	<option value=\"3\"$tfSEL3>"._PAST3MO."</option>

// 	<option value=\"6\"$tfSEL6>"._PAST6MO."</option>

// 	<option value=\"12\"$tfSEL12>"._PASTYEAR."</option></select>";



	if (($order == 'newest') OR ($order == '')) { $oSEL1 = " selected=\"selected\""; } else { $oSEL1 = ""; }

	if ($order == 'oldest') { $oSEL2 = " selected=\"selected\""; } else { $oSEL2 = ""; }

	echo "<select name=\"order\">

	<option value=\"newest\"$oSEL1>"._NEWESTFIRST."</option>

	<option value=\"oldest\"$oSEL2>"._OLDESTFIRST."</option></select>";



	echo "</td></tr><tr><td colspan=\"2\" align=\"center\" nowrap=\"nowrap\" valign=\"middle\">";

	echo "<input type=\"text\" name=\"sbsearchtext\" value=\"$sbsearchtext\" size=\"53\" maxlength=\"100\" />&nbsp;&nbsp;";

	echo "<input type=\"hidden\" name=\"Action\" value=\"Search\" /><input type=\"submit\" name=\"button\" value=\""._SBSEARCH."\" /></td></tr>";

	echo "</table></form>";

}



function shoutDelete($page, $shoutID) {

	global $db, $user, $cookie, $prefix;

	$sql = "select * from ".$prefix."_shoutbox_conf";

	$result = $db->sql_query($sql);

	$conf = $db->sql_fetchrow($result);

	if ($conf['delyourlastpost'] == "yes") {

		$sql = "select * from ".$prefix."_shoutbox_shouts where id='$shoutID'";

		$nameresult = $db->sql_query($sql);

		$row = $db->sql_fetchrow($nameresult);

		include_once("config.php");

		cookiedecode($user);

		$username = $cookie[1];

		if ($row['name'] == $username) {

			$sqlD = "DELETE FROM ".$prefix."_shoutbox_shouts WHERE id='$shoutID'";

			$db->sql_query($sqlD);

		}

	}

	Header("Location: modules.php?name=Shout_Box&page=$page");

	exit;

}



function shoutEdit($page, $shoutID, $ShoutError) {

	include_once("config.php");

	global $db, $user, $cookie, $prefix;

	include_once("header.php");

	$sql = "select * from ".$prefix."_shoutbox_conf";

	$result = $db->sql_query($sql);

	$conf = $db->sql_fetchrow($result);

	OpenTable();

	if ($conf['delyourlastpost'] == "yes") {

		$sql = "select * from ".$prefix."_shoutbox_shouts where id='$shoutID'";

		$nameresult = $db->sql_query($sql);

		$row = $db->sql_fetchrow($nameresult);

		cookiedecode($user);

		$username = $cookie[1];

		if ($row['name'] == $username) {

			// strip out link code here (added back in later if saved)

			$ShoutComment = $row['comment'];

			$ShoutComment = preg_replace("~&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"~", "",$ShoutComment);

			$ShoutComment = preg_replace("~&#91;<a rel=\"nofollow\" href=\"~", "",$ShoutComment);

			$ShoutComment = preg_replace("~&#91;<a target=\"_blank\" href=\"~", "",$ShoutComment);

			$ShoutComment = preg_replace("~&#91;<a href=\"~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">URL</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">FTP</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">IRC</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">TeamSpeak</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">AIM</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">Gopher</a>&#93;~", "",$ShoutComment);

			$ShoutComment = preg_replace("~\">E-Mail</a>&#93;~", "",$ShoutComment);



			$i = 0;

			$ShoutNew = '';

			$ShoutArray = explode(" ",$ShoutComment);

			foreach($ShoutArray as $ShoutPart) {

				if (preg_match("/mailto:/", $ShoutPart)) { // find mailto:

					$ShoutPart = preg_replace("/mailto:/", "",$ShoutPart); // strip out mailto:

					$ShoutPart = preg_replace("/%/", " ",$ShoutPart);

					$ShoutPart = trim($ShoutPart);

					// decode address to ascii

					$c = 0;

					$AddyArray = explode(" ",$ShoutPart);

					foreach($AddyArray as $AddyPart) {

						$AddyNew[$c] = chr(hexdec($AddyPart));

						$c++;

					}

					$ShoutPart = implode("",$AddyNew);

					$ShoutNew[$i] = "mailto:$ShoutPart"; // add mailto: back in

				} else { $ShoutNew[$i] = $ShoutPart; }

				$i++;

			}

			$ShoutComment = implode(" ",$ShoutNew);



			// strip smilies code here (added back in later if saved)

			$sql = "select * from ".$prefix."_shoutbox_emoticons";

			$eresult = $db->sql_query($sql);

			while ($emoticons = $db->sql_fetchrow($eresult)) {

				$ShoutComment = str_replace($emoticons['image'],$emoticons['text'],$ShoutComment);

			}



			echo "<form name=\"shoutedit\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";

			echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";

			echo "<tr><td align=\"center\"><span class=\"title\">"._SHOUTBOXEDIT."<br /><br /></span></td></tr>\n";

			if (($ShoutError) && ($ShoutError != 'none')) {

				echo "<tr><td style=\"background: #FF3333;\"><strong>"._SB_NOTE.":</strong> $ShoutError</td></tr>";

			}

			echo "<tr><td align=\"center\"><input type=\"hidden\" name=\"shoutID\" value=\"$shoutID\" /><input type=\"text\" name=\"ShoutComment\" size=\"70\" value=\"$ShoutComment\" maxlength=\"2500\" />";

			echo "<input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"hidden\" name=\"Action\" value=\"Save\" />&nbsp;&nbsp;<input type=\"submit\" name=\"button\" value=\""._UPDATE."\" /></td></tr>";

			echo "<tr><td align=\"center\"><a href=\"modules.php?name=Shout_Box&amp;page=$page\">"._SHOUTHISTORY."</a></td></tr>";

			echo "</table></form>";

		} else {

			echo ""._EDITINGOTHERSDISALLOWED."";

		}

	} else {

		echo ""._EDITINGDISABLEDBYADMIN."";

	}

	CloseTable();

	include_once("footer.php");

}



function shoutSave($page, $shoutID, $ShoutComment) {

	include_once("config.php");

	global $db, $user, $cookie, $prefix;

	$sql = "select * from ".$prefix."_shoutbox_conf";

	$result = $db->sql_query($sql);

	$conf = $db->sql_fetchrow($result);

	if ($conf['delyourlastpost'] == "yes") {

		$sql = "select * from ".$prefix."_shoutbox_shouts where id='$shoutID'";

		$nameresult = $db->sql_query($sql);

		$row = $db->sql_fetchrow($nameresult);

		include_once("config.php");

		cookiedecode($user);

		$username = $cookie[1];

		if ($row['name'] == $username) {

			$ShoutComment = trim($ShoutComment); // remove whitespace off ends of shout

			$ShoutComment = preg_replace('/\s+/', ' ', $ShoutComment); // convert double spaces in middle of shout to single space

			$num = strlen($ShoutComment);

			if ($num < 1) { $ShoutError = ""._SHOUTTOOSHORT.""; }

			if ($num > 2500) { $ShoutError = ""._SHOUTTOOLONG.""; }

			if (!$ShoutComment) { $ShoutError = ""._NOSHOUT.""; }

			if ($ShoutComment == ""._SB_MESSAGE."") { $ShoutError = ""._NOSHOUT.""; }

			$ShoutComment = preg_replace("/ [.] /", ".",$ShoutComment);

			if (preg_match("/.xxx/", $ShoutComment) AND $conf['blockxxx'] == "yes") {

				$ShoutError = ""._XXXBLOCKED."";

				$ShoutComment = "";

			}

			if (preg_match("/javascript:(.*)/", $ShoutComment)) {

				$ShoutError = ""._JSINSHOUT."";

				$ShoutComment = "";

			}



			$ShoutComment = htmlspecialchars($ShoutComment, ENT_QUOTES);

			$ShoutComment = preg_replace("/&amp;amp;/", "&amp;",$ShoutComment);



			// Scan for links in the shout. If there is, replace it with [URL] or block it if disallowed

			$i = 0;

			$ShoutNew = '';

			$ShoutArray = explode(" ",$ShoutComment);

			foreach($ShoutArray as $ShoutPart) {

				if (is_array($ShoutPart) == TRUE) { $ShoutPart = $ShoutPart[0]; }

				if (preg_match("/http:\/\//", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					// fix for users adding text to the beginning of links: HACKhttp://www.website.com

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"http://");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";

				} elseif (preg_match("/ftp:\/\//", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"ftp://");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">FTP</a>&#93;";

				} elseif (preg_match("/irc:\/\//", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"irc://");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">IRC</a>&#93;";

				} elseif (preg_match("/teamspeak:\/\//", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"teamspeak://");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">TeamSpeak</a>&#93;";

				} elseif (preg_match("/aim:goim/", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"aim:goim");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">AIM</a>&#93;";

				} elseif (preg_match("/gopher:\/\//", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"gopher://");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">Gopher</a>&#93;";

				} elseif (preg_match("/mailto:/", $ShoutPart)) {

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"mailto:");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					// email encoding to stop harvesters

					$ShoutPart = bin2hex($ShoutPart);

					$ShoutPart = chunk_split($ShoutPart, 2, '%');

					$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);

					$ShoutNew[$i] = "&#91;<a href=\"$ShoutPart\">E-Mail</a>&#93;";

				} elseif (preg_match("/www\./", $ShoutPart)) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPartL = strtolower($ShoutPart);

					$spot = strpos($ShoutPartL,"www.");

					if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }

					$ShoutPart = "http://" . $ShoutPart;

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";

				} elseif (preg_match('/@/', $ShoutPart) AND preg_match('/\./', $ShoutPart)) {

					//     \b[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}\b



					// email encoding to stop harvesters

					$ShoutPart = bin2hex($ShoutPart);

					$ShoutPart = chunk_split($ShoutPart, 2, '%');

					$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);

					$ShoutNew[$i] = "&#91;<a href=\"mailto:$ShoutPart\">E-Mail</a>&#93;";

				} elseif ((preg_match("/\.(us|tv|cc|ws|ca|de|jp|ro|be|fm|ms|tc|ph|dk|st|ac|gs|vg|sh|kz|as|lt|to)/", substr("$ShoutPart", -3,3))) OR (preg_match("/\.(com|net|org|mil|gov|biz|pro|xxx)/", substr("$ShoutPart", -4,4))) OR (preg_match("/\.(info|name|mobi)/", substr("$ShoutPart", -5,5))) OR (preg_match("/\.(co\.uk|co\.za|co\.nz|co\.il)/", substr("$ShoutPart", -6,6)))) {

					if ($conf['urlonoff'] == "no") { $ShoutError = ""._URLNOTALLOWED.""; break; }

					$ShoutPart = "http://" . $ShoutPart;

					$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";

				} elseif (strlen(html_entity_decode($ShoutPart, ENT_QUOTES)) > 21) {

					$ShoutNew[$i] = htmlspecialchars(wordwrap(html_entity_decode($ShoutPart, ENT_QUOTES), 21, " ", 1), ENT_QUOTES);

					$ShoutNew[$i] = str_replace("[ b]", " [b]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[b ]", " [b]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[ /b]", "[/b] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/ b]", "[/b] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/b ]", "[/b] ",$ShoutNew[$i]);



					$ShoutNew[$i] = str_replace("[ i]", " [i]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[i ]", " [i]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[ /i]", "[/i] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/ i]", "[/i] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/i ]", "[/i] ",$ShoutNew[$i]);



					$ShoutNew[$i] = str_replace("[ u]", " [u]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[u ]", " [u]",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[ /u]", "[/u] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/ u]", "[/u] ",$ShoutNew[$i]);

					$ShoutNew[$i] = str_replace("[/u ]", "[/u] ",$ShoutNew[$i]);

				} else { $ShoutNew[$i] = $ShoutPart; }

				$i++;

			}

			if ($ShoutError == "") { $ShoutComment = implode(" ",$ShoutNew); }



			//Smilies from database

			$ShoutArrayReplace = explode(" ",$ShoutComment);

			$ShoutArrayScan = $ShoutArrayReplace;

			$sql = "select * from ".$prefix."_shoutbox_emoticons";

			$eresult = $db->sql_query($sql);

			while ($emoticons = $db->sql_fetchrow($eresult)) {

				$i = 0;

				foreach($ShoutArrayScan as $ShoutPart) {

					if ($ShoutPart == $emoticons['text']) { $ShoutArrayReplace[$i] = $emoticons['image']; }

					$i++;

				}

			}

			$ShoutComment = implode(" ",$ShoutArrayReplace);



			//look for bad words, then censor them.

			if($conf['censor'] == "yes") {

				$ShoutArrayReplace = explode(" ",$ShoutComment);

				$ShoutArrayScan = $ShoutArrayReplace;

				$sql = "select * from ".$prefix."_shoutbox_censor";

				$cresult = $db->sql_query($sql);

				while ($censor = $db->sql_fetchrow($cresult)) {

					$i = 0;

					foreach($ShoutArrayScan as $ShoutPart) {

						$ShoutPart = strtolower($ShoutPart);

						$censor['text'] = strtolower($censor['text']);

						if ($ShoutPart == $censor['text']) { $ShoutArrayReplace[$i] = $censor['replacement']; }

						$i++;

					}

				}

				$ShoutComment = implode(" ",$ShoutArrayReplace);



				/*

				// Phrase censor - Needs work before implementing

				$sql = "select * from ".$prefix."_shoutbox_emoticons";

				$eresult = $db->sql_query($sql);

				while ($emoticons = $db->sql_fetchrow($eresult)) {

					$ShoutComment = str_replace($emoticons[1],$emoticons[2],$ShoutComment);

				}

				*/

			}



			if (!$ShoutError) {

				$sqlU = "UPDATE ".$prefix."_shoutbox_shouts set comment='$ShoutComment' WHERE id='$shoutID'";

				$db->sql_query($sqlU);

			} else {

				Header("Location: modules.php?name=Shout_Box&Action=Edit&shoutID=$shoutID&page=$page&ShoutError=$ShoutError");

				exit;

			}

		}

	}

	Header("Location: modules.php?name=Shout_Box&page=$page");

	exit;

}



function findAvatar($row_avatar) {

	global $db, $prefix;

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

		$AvatarFound = "<img src=\"$row_avatar\" alt=\"\" /></td>";

	} else {

		$agp = "$avatar_gallery_path[config_value]/$row_avatar";

		$ap = "$avatar_path[config_value]/$row_avatar";

		if (file_exists($agp) == TRUE) {

			$AvatarFound = "<img src=\"$avatar_gallery_path[config_value]/$row_avatar\" alt=\"\" /></td>";

		} elseif (file_exists($ap) == TRUE) {

			$AvatarFound = "<img src=\"$avatar_path[config_value]/$row_avatar\" alt=\"\" /></td>";

		} else {

			$AvatarFound = "<img src=\"$avatar_path[config_value]/blank.gif\" alt=\"\" /></td>";

		}

	}

	return $AvatarFound;

}



function showHistory($page) {

	include_once("config.php");

	global $db, $user, $cookie, $prefix, $username, $AvatarFound;

	include_once("header.php");

	cookiedecode($user);

	$username = $cookie[1];

	if ($username == "") {

		$username = "Anonymous";

	}

	$sql = "select * from ".$prefix."_shoutbox_conf";

	$result = $db->sql_query($sql);

	$conf = $db->sql_fetchrow($result);



	if (is_user($user)) {

		$username = $cookie[1];

		if ($username != '') {

			$sqlF = "SELECT user_timezone, user_dateformat from ".$prefix."_users WHERE username='$username'";

			$resultF = $db->sql_query($sqlF);

			$userSetup = $db->sql_fetchrow($resultF);

		}

	}

	$sql = "select * from ".$prefix."_shoutbox_date";

	$resultD = $db->sql_query($sql);

	$rowD = $db->sql_fetchrow($resultD);



	// count number of shouts in DB

	$sql = "SELECT id FROM ".$prefix."_shoutbox_shouts";

	$result = $db->sql_query($sql);

	$numrows = $db->sql_numrows($result);

	$shout_pages = 1;

	$shoutsViewed = $conf['shoutsperpage'];

	while ($numrows >= $shoutsViewed) {

		$shout_pages++;

		$numrows = ($numrows - $shoutsViewed);

	}

	if ($shout_pages == 0) { $shout_pages = 1; }

	if (!$page) { $page = 1; }

	if ($page < 1) { $page = 1; }

	if ($page > $shout_pages) { $page = $shout_pages; }

	if ($page > 1) {

		$offset = ($page * $shoutsViewed);

		$offset1 = ($offset - $shoutsViewed);

	} else { $offset1 = 0; }



	// search form

	OpenTable();

	$sbsearchtext = '';

	$where = '';

	$style = '';

	$results = '';

	$timeframe = '';

	$order = '';

	showSearchBox($sbsearchtext, $where, $style, $results, $timeframe, $order);

	CloseTable();

	echo "<br />";

	OpenTable();

	$post = 0;

	$loop = 0;

	$flag = 1;



	$ThemeSel = get_theme();

	$sql = "select * from ".$prefix."_shoutbox_themes WHERE themeName='$ThemeSel'";

	$result = $db->sql_query($sql);

	$rowColor = $db->sql_fetchrow($result);



	echo "<form name=\"shoutform2\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";

	echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";

	echo "<tr><td align=\"center\"><span class=\"title\">"._SHOUTBOXHISTORY."</span></td></tr>\n";

	//echo "<tr><td><table cellpadding=\"0\" width=\"100%\" cellspacing=\"0\" border=\"0\"><tr><td width=\"45%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/history.gif\" alt=\"\" /></td><td width=\"55%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SHOUTBOXHISTORY."</span></td></tr></table></td></tr>\n";

	$sql = "SELECT * FROM ".$prefix."_shoutbox_shouts ORDER BY id desc LIMIT ".$offset1.",$shoutsViewed";

	$resultt = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($resultt)) {

		if ($flag == 1) { $bgcolor = $rowColor['menuColor1']; }

		if ($flag == 2) { $bgcolor = $rowColor['menuColor2']; }

		$comment = str_replace('src=', 'src="', $row['comment']);

		$comment = str_replace('.gif>', '.gif" alt="" />', $comment);

		$comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);

		$comment = str_replace('.png>', '.png" alt="" />', $comment);

		$comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);



		// BB code [b]word[/b] [i]word[/i] [u]word[/u]

		if ((preg_match("/[b]/", $comment)) AND (preg_match("#[/b]#", $comment)) AND (substr_count("$comment","[b]") == substr_count("$comment","[/b]"))) {

			$comment = preg_replace("/\[b\]/","<span style=\"font-weight: bold\">","$comment");

			$comment = preg_replace("/\[\/b\]/","</span>","$comment");

		}

		if ((preg_match("/[i]/", $comment)) AND (preg_match("#[/i]#", $comment)) AND (substr_count("$comment","[i]") == substr_count("$comment","[/i]"))) {

			$comment = preg_replace("/\[i\]/","<span style=\"font-style: italic\">","$comment");

			$comment = preg_replace("/\[\/i\]/","</span>","$comment");

		}

		if ((preg_match("/[u]/", $comment)) AND (preg_match("#[/u]#", $comment)) AND (substr_count("$comment","[u]") == substr_count("$comment","[/u]"))) {

			$comment = preg_replace("/\[u\]/","<span style=\"text-decoration: underline\">","$comment");

			$comment = preg_replace("#\[\/u\]#","</span>","$comment");

		}



		$sqlN = "SELECT * FROM ".$prefix."_users WHERE username='$row[name]'";

		$nameresultN = $db->sql_query($sqlN);

		$rowN = $db->sql_fetchrow($nameresultN);

		$color = $rowN['user_color_gc']; // UsernameColor Addon



		// Disallow Anonymous users from seeing links to users' accounts

		if ($username == "Anonymous") {

			if (($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {

				echo "<tr><td style=\"background-color: $bgcolor;\">";

				echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";

				echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";

				$row_avatar = $rowN['user_avatar'];

				$av_found = findAvatar($row_avatar);

				echo "$av_found";

				echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\">";

				echo "<font color=$color><strong>$row[name]:</strong></font> $comment"; // UsernameColor Addon

				if ($conf['date'] == "yes") {

					if ($row['timestamp'] != '') {

						// reads unix timestamp and formats it to the viewer's timezone

						if (is_user($user)) {

							// time adjustment for following user's timezone

							$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

							$displayTime = $displayTime * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

							echo "<br />$unixTime";

						} else {

							// adjustmet for timezone offset

							$displayTime = $conf['timeOffset'] * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixDay = date("$rowD[date]", $newTimestamp);

							$unixTime = date("$rowD[time]", $newTimestamp);

							echo "<br />$unixDay&nbsp;$unixTime";

						}

					} else {

						echo "<br />$row[date]&nbsp;$row[time]";

					}

				}

				echo "</td></tr></table>";

				echo "</td></tr>\n";

			} else {

				echo "<tr><td style=\"background-color: $bgcolor;\">";

				echo "<font color=$color><strong>$row[name]:</strong></font> $comment"; // UsernameColor Addon

				if ($conf['date'] == "yes") {

					if ($row['timestamp'] != '') {

						// reads unix timestamp and formats it to the viewer's timezone

						if (is_user($user)) {

							// time adjustment for following user's timezone

							$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

							$displayTime = $displayTime * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

							echo "<br />$unixTime";

						} else {

							// adjustmet for timezone offset

							$displayTime = $conf['timeOffset'] * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixDay = date("$rowD[date]", $newTimestamp);

							$unixTime = date("$rowD[time]", $newTimestamp);

							echo "<br />$unixDay&nbsp;$unixTime";

						}

					} else {

						echo "<br />$row[date]&nbsp;$row[time]";

					}

				}

				echo "</td></tr>\n";

			}

		} else {

			// check to see if nickname is a user in the DB and not Anonymous

			if (($rowN) && ($rowN['username'] != "Anonymous")) {

				if (($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {

					echo "<tr><td style=\"background-color: $bgcolor;\">";

					echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";

					echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";

					$row_avatar = $rowN['user_avatar'];

					$av_found = findAvatar($row_avatar);

					echo "$av_found";

					echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\"><strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\"><font color=$color>$row[name]</a>:</strong></font> $comment<br />"; // UsernameColor Addon

					if ($conf['date'] == "yes") {

						if ($row['timestamp'] != '') {

							// reads unix timestamp and formats it to the viewer's timezone

							if (is_user($user)) {

								// time adjustment for following user's timezone

								$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

								$displayTime = $displayTime * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

								echo "$unixTime";

							} else {

								// adjustmet for timezone offset

								$displayTime = $conf['timeOffset'] * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixDay = date("$rowD[date]", $newTimestamp);

								$unixTime = date("$rowD[time]", $newTimestamp);

								echo "$unixDay&nbsp;$unixTime";

							}

						} else {

							echo "$row[date]&nbsp;$row[time]";

						}

					}

					// registered users edit/delete posts

					if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {

						echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=$row[id]&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=$row[id]&amp;page=$page\">"._DELETE."</a> &#93;";

					}

					echo "</td></tr></table>";

					echo "</td></tr>\n";

				} else {

					echo "<tr><td style=\"background-color: $bgcolor;\">";

					echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\"><font color=$color><strong>$row[name]:</strong></font></a> $comment<br />"; // UsernameColor Addon

					if ($conf['date'] == "yes") {

						if ($row['timestamp'] != '') {

							// reads unix timestamp and formats it to the viewer's timezone

							if (is_user($user)) {

								// time adjustment for following user's timezone

								$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

								$displayTime = $displayTime * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

								echo "$unixTime";

							} else {

								// adjustmet for timezone offset

								$displayTime = $conf['timeOffset'] * 3600;

								$newTimestamp = $row['timestamp'] + $displayTime;

								$unixDay = date("$rowD[date]", $newTimestamp);

								$unixTime = date("$rowD[time]", $newTimestamp);

								echo "$unixDay&nbsp;$unixTime";

							}

						} else {

							echo "$row[date]&nbsp;$row[time]";

						}

					}

					// registered users edit/delete posts

					if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {

						echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=$row[id]&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=$row[id]&amp;page=$page\">"._DELETE."</a> &#93;";

					}

					echo "</td></tr>\n";

				}

			} else {

				echo "<tr><td style=\"background-color: $bgcolor;\">";

				echo "<strong>$row[name]:</strong> $comment";

				if ($conf['date'] == "yes") {

					if ($row['timestamp'] != '') {

						// reads unix timestamp and formats it to the viewer's timezone

						if (is_user($user)) {

							// time adjustment for following user's timezone

							$displayTime = $userSetup['user_timezone'] - $conf['serverTimezone'];

							$displayTime = $displayTime * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixTime = date("$userSetup[user_dateformat]", $newTimestamp);

							echo "<br />$unixTime";

						} else {

							// adjustmet for timezone offset

							$displayTime = $conf['timeOffset'] * 3600;

							$newTimestamp = $row['timestamp'] + $displayTime;

							$unixDay = date("$rowD[date]", $newTimestamp);

							$unixTime = date("$rowD[time]", $newTimestamp);

							echo "<br />$unixDay&nbsp;$unixTime";

						}

					} else {

						echo "<br />$row[date]&nbsp;$row[time]";

					}

				}

				echo "</td></tr>\n";

			}

		}

		if ($flag == 1) { $flag = 2; }

		elseif ($flag == 2) { $flag =1; }

	}

	echo "<tr><td align=\"center\">";

	$num1 = ($page-4);

	if ($num1 < 1) { $num1 = 1; }

	$num2 = ($num1+8);

	if ($num2 > $shout_pages) { $num2 = $shout_pages; }

	$num5 = ($num2-8);

	if ($num5 < $num1) {

		$num1 = $num5;

		if ($num1 < 1) { $num1 = 1; }

	}

	$num3 = ($page-1);

	$num4 = ($page+1);

	$menuLinks = "";



	$count = $num1;

	while ($count <= $shout_pages AND $count <= $num2) {

		if ($count == $page) {

			$menuLinks .= "<strong>$count</strong>";

		} else {

			$menuLinks .= "<a href=\"modules.php?name=Shout_Box&amp;page=$count\">$count</a>";

		}

		if ($count < $num2) { $menuLinks .= "&nbsp;&nbsp;"; }

		$count++;

	}



	$menuLinks .= "<br /><br />";

	if ($page > 1) {

		$menuLinks .= "<a href=\"modules.php?name=Shout_Box&amp;page=$num3\">"._PREVIOUS."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";

	}

	if ($page != $shout_pages) {

		$menuLinks .= ""._PAGE." $page / <a href=\"modules.php?name=Shout_Box&amp;page=$shout_pages\">$shout_pages</a>\n";

	} else {

		$menuLinks .= ""._PAGE." $page / $shout_pages\n";

	}

	if ($page < $shout_pages) {

		$menuLinks .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=Shout_Box&amp;page=$num4\">"._NEXT."</a>\n";

	}

	echo "$menuLinks";

	echo "</td></tr></table></form>";

	// End menu build

	CloseTable();

	include_once("footer.php");

}



function showBanned() {

	include_once("config.php");

	include_once("header.php");

	OpenTable();

	echo "<br /><p class=\"title\" align=\"center\"><strong>"._YOUAREBANNEDM."</strong></p><br />";

	CloseTable();

	include_once("footer.php");

}



switch($Action) {



		case "UserBanned":

		showBanned();

		break;



		case "Search":

		searchHistory($where, $sbsearchtext, $results, $style, $timeframe, $order);

		break;



		case "Delete":

		shoutDelete($page, $shoutID);

		break;



		case "Edit":

		if ($ShoutError == '') { $ShoutError = 'none'; }

		shoutEdit($page, $shoutID, $ShoutError);

		break;



		case "Save":

		shoutSave($page, $shoutID, $ShoutComment);

		break;



		default:

		showHistory($page);

		break;



}



?>

