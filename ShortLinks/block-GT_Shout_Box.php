<?php
// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2004 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// Copyright (c) 2002 by Quiecom
// http://www.Quiecom.com
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Shout_Box.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $ShoutSubmit, $ShoutComment, $db, $user, $cookie, $shoutuid, $top_content, $mid_content, $bottom_content, $ShoutMarqueewidth, $ShoutMarqueeheight, $currentlang;

function ShoutBox($ShoutSubmit, $prefix, $ShoutComment, $db, $user, $cookie, $shoutuid) {

	global $currentlang, $top_content, $mid_content, $bottom_content, $ShoutMarqueewidth, $ShoutMarqueeheight;

	if ($currentlang) {
		include_once("modules/Shout_Box/lang-block/lang-$currentlang.php");
	} else {
		include_once("modules/Shout_Box/lang-block/lang-english.php");
	}

	$PreviousShoutComment = $ShoutComment;

	include_once("config.php");

	cookiedecode($user);
	$username = $cookie[1];

	if ($username == "") { $username = "Anonymous"; }

	$sql = "select * from ".$prefix."_shoutbox_conf";
	$result = $db->sql_query($sql);
	$conf = $db->sql_fetchrow($result);

	// Check if block is in center position
	$sql = "select bposition from ".$prefix."_blocks where blockfile='block-Shout_Box.php'";
	$SBpos = $db->sql_query($sql);
	$SBpos = $db->sql_fetchrow($SBpos);
	if ($SBpos[0] == 'c' || $SBpos[0] == 'd') {
		$SBpos = 'center';
		$SBborder = 1;
	} else {
		$SBpos = 'side';
		$SBborder = 0;
	}

	// Find user's IP
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
		$uip = getenv("HTTP_CLIENT_IP");
	} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
		$uip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
		$uip = getenv("REMOTE_ADDR");
	} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
		$uip = $_SERVER['REMOTE_ADDR'];
	} else {
		$uip = "";
	}
	if ($uip == 'unknown') { $uip = $_SERVER['REMOTE_ADDR']; }
	if ($uip == "") { $uip = $_SERVER['REMOTE_ADDR']; }
	if ($uip == "") { $uip = "noip"; }
	if ($uip == 'unknown') { $uip = "noip"; }

	//do IP test then ban if on list
	if($conf[6] == "yes") {
		$sql = "select * from ".$prefix."_shoutbox_ipblock";
		$ipresult = $db->sql_query($sql);
		while ($badips = $db->sql_fetchrow($ipresult)){
			if($uip == $badips[1]) {
				$BannedShouter = "yes";
			}
		}
	}
	//do name test then ban if on list (only applies to registered users)
	if($conf[7] == "yes"){
		$sql = "select * from ".$prefix."_shoutbox_nameblock";
		$nameresult = $db->sql_query($sql);
		while ($badname = $db->sql_fetchrow($nameresult)){
			if($username == $badname[1]) {
				$BannedShouter = "yes";
			}
		}
	}
	if ($BannedShouter != "yes") {

	if ($ShoutSubmit == "ShoutPost") {

	if ($shoutuid) { $username = "$shoutuid"; }
	//shoutuid tests
	$username = trim($username); // remove whitespace off ends of nickname
	if($conf[11] == "yes" && $conf[12] == "yes") {
		$unum = strlen($username);
		if($unum < 2) { $ShoutError = ""._NICKTOOSHORT.""; }
		if($conf[11] == "yes" && !$username) { $ShoutError = ""._NONICK.""; }
		if($conf[11] == "yes" && $username == ""._NAME."") { $ShoutError = ""._NONICK.""; }
		if (eregi("javascript:(.*)", $username)) { $ShoutError = ""._JSINNICK.""; }
		//$username = ereg_replace("([^ ]{42})","\\1",$username);
		$username = htmlspecialchars($username, ENT_QUOTES);
		$username = ereg_replace("&amp;", "&",$username);
	}
	if (!is_user($user) && ($username) && $username != "Anonymous") {
		$username = ereg_replace(" ", "_",$username);
	}

	$ShoutComment = trim($ShoutComment); // remove whitespace off ends of shout
	$num = strlen($ShoutComment);
	if ($num < 1) { $ShoutError = ""._SHOUTTOOSHORT.""; }
	if ($num > 2500) { $ShoutError = ""._SHOUTTOOLONG.""; }
	if (!$ShoutComment) { $ShoutError = ""._NOSHOUT.""; }
	if ($ShoutComment == ""._SB_MESSAGE."") { $ShoutError = ""._NOSHOUT.""; }
	if (eregi("javascript:(.*)", $ShoutComment)) { $ShoutError = ""._JSINSHOUT.""; }

// 	$ShoutComment = ereg_replace("([^ ]{42})","\\1",$ShoutComment);
	$ShoutComment = htmlspecialchars($ShoutComment, ENT_QUOTES);
	$ShoutComment = ereg_replace("&amp;", "&",$ShoutComment);

	// Are URLs allowed in shouts?
	if($conf[10] == "no") {
		// Scan to see if theres a link in the shout
		$extensions = array('http:','ftp:','irc:','teamspeak:','aim:goim','gopher:','mailto:','www\.','\.com','\.net','\.org','\.mil','\.gov','\.info','\.us','\.biz','\.tv','\.cc','\.ws','\.name','\.pro','\.co\.uk','\.ca','\.de','\.jp','\.ro','\.be','\.fm','\.ms','\.tc','\.co\.za','\.co\.nz','\.ph','\.dk','\.st','\.ac','\.gs','\.vg','\.sh','\.kz','\.as','\.lt','\.to','\.co\.il');
		$extCount = count($extensions);
		for ($num = 0; $num < $extCount; $num++) {
			if (eregi("$extensions[$num]", $ShoutComment)) {
				$ShoutError = ""._URLNOTALLOWED."";
				break;
			}
		}
	}

	// Scan for links in the shout. If there is, replace it with [URL]
	$i = 0;
	$ShoutNew = '';
	$ShoutArray = explode(" ",$ShoutComment);
	foreach($ShoutArray as $ShoutPart) {
		if (eregi("http:\/\/", $ShoutPart)) {
			// fix for users adding text to the beginning of links: HACKhttp://www.website.com
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"http://");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a target=\"_blank\" href=\"$ShoutPart\">URL</a>]";
		} elseif (eregi("ftp:\/\/", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"ftp://");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a target=\"_blank\" href=\"$ShoutPart\">FTP</a>]";
		} elseif (eregi("irc:\/\/", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"irc://");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a href=\"$ShoutPart\">IRC</a>]";
		} elseif (eregi("teamspeak:\/\/", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"teamspeak://");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a href=\"$ShoutPart\">TeamSpeak</a>]";
		} elseif (eregi("aim:goim", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"aim:goim");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a href=\"$ShoutPart\">AIM</a>]";
		} elseif (eregi("gopher:\/\/", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"gopher://");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutNew[$i] = "[<a href=\"$ShoutPart\">Gopher</a>]";
		} elseif (eregi("mailto:", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"mailto:");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			// email encoding to stop harvesters
			$ShoutPart = bin2hex($ShoutPart);
			$ShoutPart = chunk_split($ShoutPart, 2, '%');
			$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
			$ShoutNew[$i] = "[<a href=\"$ShoutPart\">E-Mail</a>]";
		} elseif (eregi("www\.", $ShoutPart)) {
			$ShoutPartL = strtolower($ShoutPart);
			$spot = strpos($ShoutPartL,"www.");
			if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
			$ShoutPart = "http://" . $ShoutPart;
			$ShoutNew[$i] = "[<a target=\"_blank\" href=\"$ShoutPart\">URL</a>]";
		} elseif (eregi('@', $ShoutPart) AND eregi('\.', $ShoutPart)) {
			//     \b[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}\b

			// email encoding to stop harvesters
			$ShoutPart = bin2hex($ShoutPart);
			$ShoutPart = chunk_split($ShoutPart, 2, '%');
			$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
			$ShoutNew[$i] = "[<a href=\"mailto:$ShoutPart\">E-Mail</a>]";
	} elseif (eregi("\.(com|net|org|mil|gov|info|us|biz|tv|cc|ws|name|pro|co\.uk|ca|de|jp|ro|be|fm|ms|tc|co\.za|co\.nz|ph|dk|st|ac|gs|vg|sh|kz|as|lt|to|co\.il)", $ShoutPart)) {
			$ShoutPart = "http://" . $ShoutPart;
			$ShoutNew[$i] = "[<a target=\"_blank\" href=\"$ShoutPart\">URL</a>]";
		} elseif (strlen(html_entity_decode($ShoutPart, ENT_QUOTES)) > 21) {
			$ShoutNew[$i] = htmlspecialchars(wordwrap(html_entity_decode($ShoutPart, ENT_QUOTES), 21, " ", 1), ENT_QUOTES);
		} else { $ShoutNew[$i] = $ShoutPart; }
		$i++;
	}
	$ShoutComment = implode(" ",$ShoutNew);

	//Smilies from database
	$ShoutArrayReplace = explode(" ",$ShoutComment);
	$ShoutArrayScan = $ShoutArrayReplace;
	$sql = "select * from ".$prefix."_shoutbox_emoticons";
	$eresult = $db->sql_query($sql);
	while ($emoticons = $db->sql_fetchrow($eresult)) {
		$i = 0;
		foreach($ShoutArrayScan as $ShoutPart) {
			if ($ShoutPart == $emoticons[1]) { $ShoutArrayReplace[$i] = $emoticons[2]; }
			$i++;
		}
	}
	$ShoutComment = implode(" ",$ShoutArrayReplace);

	//do name test then error if on list
	if($conf[7] == "yes"){
		$sql = "select * from ".$prefix."_shoutbox_nameblock";
		$nameresult = $db->sql_query($sql);
		while ($badname = $db->sql_fetchrow($nameresult)){
			if($username == $badname[1]) {
				$ShoutError = ""._BANNEDNICK."";
			}
		}
	}

	// check for anonymous users cloning/ghosting registered users' nicknames
	cookiedecode($user);
	if (!is_user($user) && ($username) && $username != "Anonymous") {
		$sql = "select * from ".$prefix."_users where username = '$username'";
		$nameresult = $db->sql_query($sql);
		$row = $db->sql_fetchrow($nameresult);
		if ($row) {
			$ShoutError = ""._NOCLONINGNICKS."";
		}
	}

	//look for bad words, then censor them.
	if($conf[8] == "yes") {
		// start Anonymous nickname censor check here. If bad, replace bad nick with 'Anonymous'
		if (!is_user($user) && ($username) && $username != "Anonymous") {
			$sql = "select * from ".$prefix."_shoutbox_censor";
			$cresult = $db->sql_query($sql);
			while ($censor = $db->sql_fetchrow($cresult)) {
				if ($username != 'Anonymous') {
					$one = $censor[1];
					if (stristr($username, $one) !== false) {
						$username = "Anonymous";
					}
				}
			}
		}
		// Censor of posting text
		$ShoutArrayReplace = explode(" ",$ShoutComment);
		$ShoutArrayScan = $ShoutArrayReplace;
		$sql = "select * from ".$prefix."_shoutbox_censor";
		$cresult = $db->sql_query($sql);
		while ($censor = $db->sql_fetchrow($cresult)) {
			$i = 0;
			foreach($ShoutArrayScan as $ShoutPart) {
				if ($ShoutPart == $censor[1]) { $ShoutArrayReplace[$i] = $censor[2]; }
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

	// duplicate posting checker. stops repeated spam attacks
	$sql = "select * from ".$prefix."_shoutbox order by id DESC LIMIT 5";
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) { if ($row[2] == $ShoutComment) { $ShoutError = ""._DUPLICATESHOUT.""; } }

	if (!$ShoutError) {
		$sql = "select * from ".$prefix."_shoutbox_date";
		$resultD = $db->sql_query($sql);
		$rowD = $db->sql_fetchrow($resultD);

		// Special thanks to JRSweets for tipping me off to the timestamp option in date()
		if ($conf[19] == 0) {
			$day = date("$rowD[1]");
			$time = date("$rowD[2]");
		} elseif (strstr($conf[19], '+')) {
			$sbTimeMultiplier = str_replace('+', '', $conf[19]);
			$sbTimeOffset = $sbTimeMultiplier * 3600;
			$sbTimeTemp = time();
			$time = date("$rowD[2]", ($sbTimeTemp + $sbTimeOffset));
			$day = date("$rowD[1]", ($sbTimeTemp + $sbTimeOffset));
		} else {
			$sbTimeMultiplier = str_replace('-', '', $conf[19]);
			$sbTimeOffset = $sbTimeMultiplier * 3600;
			$sbTimeTemp = time();
			$time = date("$rowD[2]", ($sbTimeTemp - $sbTimeOffset));
			$day = date("$rowD[1]", ($sbTimeTemp - $sbTimeOffset));
		}

		$sql = "INSERT INTO ".$prefix."_shoutbox (id,name,comment,date,time,ip) VALUES ('0','$username ','$ShoutComment','$day','$time','$uip')";
		$db->sql_query($sql);
		$PreviousShoutComment = "";
		$PreviousComment = "";
	} else {
		if ($username != ""._NAME."") {
			$PreviousUsername = $username;
		}
		if ($PreviousShoutComment != ""._SB_MESSAGE."") {
			$PreviousComment = $PreviousShoutComment;
		}
	}

	}

	//Display Content From here on down

	if (!is_user($user) && ($username) && $username != "Anonymous") { $username = "Anonymous"; }

	$ThemeSel = get_theme();
	$sql = "select * from ".$prefix."_shoutbox_theme_images WHERE themeName='$ThemeSel'";
	$result = $db->sql_query($sql);
	$themeRow = $db->sql_fetchrow($result);

	if ($themeRow[3] != '' AND file_exists("modules/Shout_Box/images/background/$themeRow[3]")) {
		$showBackground = 'yes';
	} else {
		$showBackground = 'no';
	}

	if (file_exists("modules/Shout_Box/images/up/$themeRow[2]")) {
		$up_img = "modules/Shout_Box/images/up/$themeRow[2]";
	} else {
		$up_img = "modules/Shout_Box/images/up/Black.gif";
	}
	if (file_exists("modules/Shout_Box/images/down/$themeRow[2]")) {
		$down_img = "modules/Shout_Box/images/down/$themeRow[2]";
	} else {
		$down_img = "modules/Shout_Box/images/down/Black.gif";
	}
	if (file_exists("modules/Shout_Box/images/pause/$themeRow[2]")) {
		$pause_img = "modules/Shout_Box/images/pause/$themeRow[2]";
	} else {
		$pause_img = "modules/Shout_Box/images/pause/Black.gif";
	}

	$sql = "select * from ".$prefix."_shoutbox order by id DESC LIMIT $conf[5]";
	$result = $db->sql_query($sql);

	// Top half

	// shout error reporting
	$top_content = "";
	if ($ShoutError) {
		$top_content .= "<table style=\"cursor: text;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\"><tr><td style=\"background-color: #FF3333;\"><span class=\"content\"><strong>"._SB_NOTE.":</strong> $ShoutError</span></td></tr></table>";
	}

	// table that holds the scrolling area
	if ($showBackground == 'yes') {
		$top_content .= "<table style=\"cursor: text;\" width=\"100%\" border=\"$SBborder\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"background: url(modules/Shout_Box/images/background/$themeRow[3]);\" height=\"$conf[13]\">\n";
	} else {
		$top_content .= "<table style=\"cursor: wait;\" width=\"100%\" border=\"$SBborder\" cellspacing=\"0\" cellpadding=\"0\"><tr><td height=\"$conf[13]\">\n";
	}
	// end top content

	// table of the actual scrolling content
	if ($showBackground == 'yes') {
		$mid_content = "<table style=\"table-layout: fixed; width: 100%;\" border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"5\">";
	} else {
		$mid_content = "<table style=\"table-layout: fixed; width: 100%;\" border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"2\">";
	}
	$flag = 1;
	$ThemeSel = get_theme();
	$sql = "select * from ".$prefix."_shoutbox_themes WHERE themeName='$ThemeSel'";
	$resultT = $db->sql_query($sql);
	$rowColor = $db->sql_fetchrow($resultT);

	// Sticky shouts
	$sql = "select * from ".$prefix."_shoutbox_sticky where stickySlot=0";
	$stickyResult = $db->sql_query($sql);
	$stickyRow0 = $db->sql_fetchrow($stickyResult);
	$sql = "select * from ".$prefix."_shoutbox_sticky where stickySlot=1";
	$stickyResult = $db->sql_query($sql);
	$stickyRow1 = $db->sql_fetchrow($stickyResult);
	$sql = "select * from ".$prefix."_shoutbox_date";
	$resultD = $db->sql_query($sql);
	$rowD = $db->sql_fetchrow($resultD);
	if ($stickyRow0) {
		if ($showBackground == 'yes') {
			$mid_content .= "<tr><td>";
		} else {
			if ($flag == 1) { $flag = 2; }
			elseif ($flag == 2) { $flag = 1; }
			$mid_content .= "<tr><td style=\"background-color: $rowColor[2];\">";
		}
		$mid_content .= "<span class=\"content\"><strong>"._SB_ADMIN.":</strong> $stickyRow0[2]<br />";
		$unixDay = date("$rowD[1]", $stickyRow0[3]);
		$unixTime = date("$rowD[2]", $stickyRow0[3]);
		if ($conf[3] == "yes") { $mid_content .= "$unixDay "; }
		if ($conf[4] == "yes") { $mid_content .= "$unixTime"; }
		$mid_content .= "</span></td></tr>";
	}
	if ($stickyRow1) {
		if ($showBackground == 'yes') {
			$mid_content .= "<tr><td>";
		} else {
			if ($flag == 1) { $flag = 2; }
			elseif ($flag == 2) { $flag = 1; }
			$mid_content .= "<tr><td style=\"background-color: $rowColor[3];\">";
		}
		$mid_content .= "<span class=\"content\"><strong>"._SB_ADMIN.":</strong> $stickyRow1[2]<br />";
		$unixDay = date("$rowD[1]", $stickyRow1[3]);
		$unixTime = date("$rowD[2]", $stickyRow1[3]);
		if ($conf[3] == "yes") { $mid_content .= "$unixDay "; }
		if ($conf[4] == "yes") { $mid_content .= "$unixTime"; }
		$mid_content .= "</span></td></tr>";
	}
	// end sticky shouts

	$i = 0;
	while ($row = $db->sql_fetchrow($result)) {
		if ($flag == 1) { $bgcolor = $rowColor[2]; }
		if ($flag == 2) { $bgcolor = $rowColor[3]; }
		if ($showBackground == 'yes') {
			$tempContent[$i] = "<tr><td><span class=\"content\">";
		} else {
			$tempContent[$i] = "<tr><td style=\"background-color: $bgcolor;\"><span class=\"content\">";
		}
		$ShoutComment = str_replace('src=', 'src="', $row[2]);
		$ShoutComment = str_replace('.gif>', '.gif" alt="" />', $ShoutComment);
		$ShoutComment = str_replace('.jpg>', '.jpg" alt="" />', $ShoutComment);
		$ShoutComment = str_replace('.png>', '.png" alt="" />', $ShoutComment);
		$ShoutComment = str_replace('.bmp>', '.bmp" alt="" />', $ShoutComment);
		if ($username == "Anonymous") {
			$tempContent[$i] .= "<strong>$row[1]:</strong> $ShoutComment<br />";
		}
		else {
			// check to see if nickname is a user in the DB
			$sqlN = "select * from ".$prefix."_users where username='$row[1]'";
			$nameresultN = $db->sql_query($sqlN);
			$rowN = $db->sql_fetchrow($nameresultN);
			if (($rowN) AND ($row[1] != "Anonymous")) {
				$tempContent[$i] .= "<strong><a href=\"userinfo-$row[1].html\">$row[1]</a>:</strong> $ShoutComment<br />";
			} else {
				$tempContent[$i] .= "<strong>$row[1]:</strong> $ShoutComment<br />";
			}
		}
		if ($conf[3] == "yes") { $tempContent[$i] .= "$row[3] "; }
		if ($conf[4] == "yes") { $tempContent[$i] .= "$row[4]"; }
		$tempContent[$i] .= "</span></td></tr>";
		if ($flag == 1) { $flag = 2; }
		elseif ($flag == 2) { $flag = 1; }
		$i++;
	}
	// Reversing the posts
	if ($conf[18] == "no") {
		for ($j = 0; $j < $conf[5]; $j++) {
			$mid_content .= $tempContent[$j];
		}
	} else {
		for ($j = $conf[5]; $j >= 0; $j = $j - 1) {
			$mid_content .= $tempContent[$j];
		}
	}
	// You may not remove or edit this copyright!!! Doing so violates the GPL license.
	$mid_content .= "<tr><td align=\"right\"><a title=\"Free scripts!\" target=\"_blank\" href=\"http://www.ourscripts.net\">Shout Box ©</a></td></tr></table>";
	// end copyright.
	// end mid content
	// start bottom content $bottom_content

	if (eregi("Opera(.*)", $_SERVER['HTTP_USER_AGENT'])) {
		$browinfo = str_replace("Opera/","", $_SERVER['HTTP_USER_AGENT']);
	}
	$bottom_content = "</td></tr></table>\n";

	// bottom half

	if ($conf[12] == "no" && $username == "Anonymous") {
		$bottom_content .= "<div style=\"padding: 1px;\" align=\"center\" class=\"content\"><a href=\"shouthistory.html\">"._SHOUTHISTORY."</a>";
		$bottom_content .= " <span style=\"cursor: hand;\" onmouseover=\"SBspeed=4\" onmouseout=\"SBspeed=1\"><img src=\"$up_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= " <span style=\"cursor: hand;\" onmouseover=\"SBspeed=1-5\" onmouseout=\"SBspeed=1\"><img src=\"$down_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= " <span style=\"cursor: wait;\" onmouseover=\"SBspeed=0\" onmouseout=\"SBspeed=1\"><img src=\"$pause_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= "</div><div style=\"padding: 1px; text-align: center;\" class=\"content\"><br />"._ONLYREGISTERED." <a href=\"account.html\">"._SHOUTLOGIN."</a> "._OR." <a href=\"account-new_user.html\">"._CREATEANACCT."</a>.</div>";
	} else {
		$bottom_content .= "<form name=\"shoutform1\" method=\"post\" action=\"\" style=\"margin-bottom: 0px; margin-top: 0px\">";
		$bottom_content .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">";
		$bottom_content .= "<tr><td align=\"center\"><a href=\"shouthistory.html\">"._SHOUTHISTORY."</a>";
		$bottom_content .= " <span style=\"cursor: hand;\" onmouseover=\"SBspeed=4\" onmouseout=\"SBspeed=1\"><img src=\"$up_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= " <span style=\"cursor: hand;\" onmouseover=\"SBspeed=1-5\" onmouseout=\"SBspeed=1\"><img src=\"$down_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= " <span style=\"cursor: wait;\" onmouseover=\"SBspeed=0\" onmouseout=\"SBspeed=1\"><img src=\"$pause_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
		$bottom_content .= "</td></tr>\n";
		// Start smilie Drop-Down Code
		$messageDefinition = ""._SB_MESSAGE."";
		if (eregi("MSIE(.*)", $_SERVER['HTTP_USER_AGENT']) ||
		eregi("Konqueror/3(.*)", $_SERVER['HTTP_USER_AGENT']) ||
		(eregi("Opera(.*)", $_SERVER['HTTP_USER_AGENT'])) && $browinfo >= 7 ) {
			if ($conf[12] == "yes" && $username == "Anonymous") {
				if ($PreviousUsername) {
 					$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"shoutuid\" size=\"$conf[15]\" value=\"$PreviousUsername\" maxlength=\"25\" /></td></tr>\n";
				} else {
					$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"shoutuid\" size=\"$conf[15]\" value=\""._NAME."\" maxlength=\"25\" onclick=\"if ( this.value == '"._NAME."' ) { this.value=''; }\" /></td></tr>\n";
				}
			}
			if ($PreviousComment) {
 				$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"ShoutComment\" size=\"$conf[15]\" value=\"$PreviousComment\" maxlength=\"2500\" /></td></tr></table>\n";
			} else {
				$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"ShoutComment\" size=\"$conf[15]\" value=\""._SB_MESSAGE."\" maxlength=\"2500\" onclick=\"if ( this.value == '"._SB_MESSAGE."' ) { this.value=''; }\" /></td></tr></table>\n";
			}
			$bottom_content .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\"><tbody id=\"log1\" style=\"display: show;\">";
			$bottom_content .= "<tr>";
			$bottom_content .= "<td align=\"center\"><input type=\"hidden\" name=\"ShoutSubmit\" value=\"ShoutPost\" /><input type=\"submit\" name=\"button\" value=\""._SHOUT."\" /> ";
			$bottom_content .= "<span onclick=\"contract(log1);expand(log2);\"><input type=\"button\" value=\""._SMILIES."\" /></span></td>";
			$bottom_content .= "</tr>";
			$bottom_content .= "</tbody>\n<tbody id=\"log2\" style=\"display: none;\">";
			$bottom_content .= "<tr>";
			$bottom_content .= "<td align=\"center\"><input type=\"hidden\" name=\"ShoutSubmit\" value=\"ShoutPost\" /><input type=\"submit\" name=\"button\" value=\""._SHOUT."\" /> ";
			$bottom_content .= "<span onclick=\"contract(log2);expand(log1);\"><input type=\"button\" value=\""._SMILIES."\" /></span></td>";
			$bottom_content .= "</tr>\n";
			$bottom_content .= "<tr><td align=\"center\">";
			$sql = "select distinct image from ".$prefix."_shoutbox_emoticons";
			$nameresult1 = $db->sql_query($sql);
			$flag = 1;
			$second = 0;
			$bottom_content .="<br />";
			while ($return = $db->sql_fetchrow($nameresult1)){
				$sql = "select * from ".$prefix."_shoutbox_emoticons where image='$return[0]' limit 1";
				$nameresult = $db->sql_query($sql);
				while ($emoticons = $db->sql_fetchrow($nameresult)){
					$emoticons[3] = str_replace('>', '', $emoticons[2]);
					$emoticons[3] = str_replace('src=', 'src="', $emoticons[3]);
					$bottom_content .= "<span style=\"cursor: hand;\" onclick=\"DoSmilie(' $emoticons[1] ','$messageDefinition');\">$emoticons[3]\" border=\"0\" alt=\"\" /></span> ";
					if ($flag == $conf[17]) {
						$bottom_content .= "<br /><br />\n";
						$flag = 1;
						continue;
					}
					$flag++;
				}
			}
			$bottom_content .= "</td></tr></tbody>\n";
		} else {
			// Firefox, Mozilla, NS, and any others.
			$ShoutNameWidth = $conf[15] - 4;
			$ShoutTextWidth = $conf[15] - 9;
			if ($conf[12] == "yes" && $username == "Anonymous") {
				if ($PreviousUsername) {
 					$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"shoutuid\" size=\"$ShoutNameWidth\" value=\"$PreviousUsername\" maxlength=\"25\" /></td></tr>\n";
				} else {
					$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"shoutuid\" size=\"$ShoutNameWidth\" value=\""._NAME."\" maxlength=\"25\" onclick=\"if ( this.value == '"._NAME."' ) { this.value=''; }\" /></td></tr>\n";
				}
			}
			if ($PreviousComment) {
 				$bottom_content .= "<tr><td align=\"center\" nowrap=\"nowrap\"><input type=\"text\" name=\"ShoutComment\" size=\"$ShoutTextWidth\" value=\"$PreviousComment\" maxlength=\"2500\" />";
			} else {
				$bottom_content .= "<tr><td align=\"center\" nowrap=\"nowrap\"><input type=\"text\" name=\"ShoutComment\" size=\"$ShoutTextWidth\" value=\""._SB_MESSAGE."\" maxlength=\"2500\" onclick=\"if ( this.value == '"._SB_MESSAGE."' ) { this.value=''; }\" />";
			}
			$bottom_content .= "<input type=\"hidden\" name=\"ShoutSubmit\" value=\"ShoutPost\" /><input type=\"submit\" name=\"button\" value=\"+\" /></td></tr>\n";
			$bottom_content .= "<tr><td align=\"center\">";
			$sql = "select distinct image from ".$prefix."_shoutbox_emoticons";
			$nameresult1 = $db->sql_query($sql);
			$flag = 1;
			$second = 0;
			while ($return = $db->sql_fetchrow($nameresult1)){
				$sql = "select * from ".$prefix."_shoutbox_emoticons where image='$return[0]' limit 1";
				$nameresult = $db->sql_query($sql);
				while ($emoticons = $db->sql_fetchrow($nameresult)){
					$emoticons[3] = str_replace('>', '', $emoticons[2]);
					$emoticons[3] = str_replace('src=', 'src="', $emoticons[3]);
					$bottom_content .= "<span style=\"cursor: hand;\" onclick=\"DoSmilie(' $emoticons[1] ','$messageDefinition');\">$emoticons[3]\" border=\"0\" alt=\"\" /></span> ";
					if ($flag == $conf[17]) {
						$bottom_content .="<br /><br />\n";
						$flag = 1;
						continue;
					}
					$flag++;
				}
			}
			$bottom_content .= "</td></tr>\n";
		}
		$bottom_content .= "</table></form>\n";
	}

	} else {
		$top_content = "<p class=\"title\" align=\"center\"><strong>";
		$mid_content = ""._YOUAREBANNED."";
		$bottom_content = "</strong></p>";
	}

	$sql = "select * from ".$prefix."_shoutbox_conf";
	$resultsize = $db->sql_query($sql);
	$rowsize = $db->sql_fetchrow($resultsize);
	$ShoutMarqueeheight = $rowsize["height"];

}

switch($ShoutSubmit) {
	default:
	ShoutBox($ShoutSubmit, $prefix, $ShoutComment, $db, $user, $cookie, $shoutuid);
	break;
}

?>

<script type="text/javascript">
var SBheight = '<?php echo "$ShoutMarqueeheight"; ?>';
var SBcontent = new String('<?php echo "$mid_content"; ?>');
</script>

<script type="text/javascript" src="includes/shoutbox.js"></script>

<?php

$content = "$top_content\n";
$content .= "<div align=\"center\"><script type=\"text/javascript\">document.write(SBtxt);</script></div>\n";
$content .= "$bottom_content\n";

?>