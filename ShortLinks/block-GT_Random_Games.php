<?php
/************************************************************************/
/* PHP-NUKE: Center Random Block										*/
/* ================================										*/
/*																		*/
/* Copyright (c) 2004 by Barcrest										*/
/* http://baja.ods.org/													*/
/*																		*/
/* And																	*/
/*																		*/
/* Copyright (c) 2004 by Phantomk										*/
/* http://www.5thlegion.com												*/
/*																		*/
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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Random_Games.php")) {
    Header("Location: ../index.html");
    die();
}

define("_TOPGAMERS", "The Top Players");
define("_VICTOIRES", "Number Of Wins :");

global $prefix, $db;

$sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$prefix."_users u WHERE u.user_id = g.game_highuser ORDER BY rand()";

$result = $db->sql_query($sql); 

$row = $db->sql_fetchrow($result);

$lastScore = $row['game_highscore'];
$lastGame = $row['game_name'];
$lastUser = $row['username'];

$lastgameid = $row['game_id'];
$lastgamepic = $row['game_pic'];
$lastuserid = $row['game_highuser'];

$content .= "<center><strong>$lastGame</strong><br><a href=\"forums-arcade-game-$lastgameid.html\">";
$content .= "<img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\"></a><br> ";
$content .= "High Score set by <br><strong>";
$content .= "<a href=\"forums-arcade-stat-user-$lastuserid.html\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
$content .= "<a href=\"forum-userprofile-$lastuserid.html\">$lastUser</a> ";
$content .= "</strong><br>with <strong>$lastScore</strong></center>";

?>