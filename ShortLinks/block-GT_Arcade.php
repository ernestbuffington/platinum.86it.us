<?php
/************************************************************************/
/* PHP-NUKE: Arcade Block																								*/
/* ================================																			*/
/*																																			*/
/* Copyright (c) 2004 by Barcrest																				*/
/* http://baja.ods.org/																									*/
/*																																		  */
/* And																																	*/
/*																																			*/
/* Copyright (c) 2004 by Phantomk																				*/
/* http://www.5thlegion.com																							*/
/*																																		  */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation                                         */
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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Arcade.php")) {
    Header("Location: ../index.html");
    die();
}

define("_TOPGAMERS", "The Top Players");
define("_VICTOIRES", "Number Of Wins :");

global $prefix, $db;

$sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$prefix."_users u WHERE g.game_highuser = u.user_id ORDER BY game_highdate DESC LIMIT 0,1 " ;

if(!($result = $db->sql_query($sql))) 
{ 
		die("Could not query games user information");
}

$row = $db->sql_fetchrow($result);

$lastScore = $row['game_highscore'];
$lastGame = $row['game_name'];
$lastUser = $row['username'];

$lastgameid = $row['game_id'];
$lastgamepic = $row['game_pic'];
$lastuserid = $row['game_highuser'];

$count = 1;
$content = "<center><a href=\"forums-arcade.html\"><img src=\"images/arcadelogo.gif\" border= \"0\"></a></center><br>";
$content .="<MARQUEE behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"160\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>";

$content .= "<center><a href=\"forums-arcade-game-$lastgameid.html\">";
$content .= "<img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\"></a><br> ";
$content .= "Latest High Score set by <br><strong>";
$content .= "<a href=\"forums-arcade-stat-user-$lastuserid.html\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
$content .= "<a href=\"forum-userprofile-$lastuserid.html\">$lastUser</a> ";
$content .= "</strong><br>with <strong>$lastScore</strong> on <strong>$lastGame</strong>";

$content .= "<br>";
$content .= "--------";
$content .= "<br>";
$content .= "<font color=\"#666666\"><strong>"._TOPGAMERS."</strong><br>";

$content .= "<br>";

$sql = "SELECT COUNT(*) AS nbvictoires, g.game_highuser, u.user_id, u.username, u.user_level FROM ".$prefix."_bbgames g, ".$prefix."_users u WHERE g.game_highuser = u.user_id AND g.game_highuser <> 0 GROUP BY g.game_highuser ORDER BY nbvictoires DESC";
if(!($result = $db->sql_query($sql)))
{
		die("Could not query games information");
}

$place=0;
$nbvictprec=0;
while ($row = $db->sql_fetchrow($result)) {
		if ($nbvictprec <> $row['nbvictoires'])
		{
				$nbvictprec = $row['nbvictoires'];
		}

		$place++;

		$content .= "<strong>$place - </strong>";
		$content .= "<a href=\"forums-arcade-stat-user-".$row['user_id'].".html\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
        //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
		$content .= "<a href=\"forum-userprofile-".$row['user_id'].".html\"><strong>".$row['username']."</strong></a> ";
		$content .= "<br> "._VICTOIRES." $nbvictprec<br><br>";
		$count = $count + 1;
}

$content .= "</font></center></marquee>"

?>