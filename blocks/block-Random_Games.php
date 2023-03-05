<?php
/************************************************************************/
/* PHP-NUKE: Center Random Block										*/
/* ================================										*
/*																		*/
/* Copyright (c) 2004 by Barcrest										*/
/* http://baja.ods.org/													*/
/*																		*/
/* And																	*/
/*																		*/
/* Copyright (c) 2004 by Phantomk										*/
/* http://www.5thlegion.com												*/
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
define("_TOPGAMERS", "The Top Players");
define("_VICTOIRES", "Number Of Wins :");
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $user_prefix, $db;
$sql = "SELECT g.* , u.username FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE u.user_id = g.game_highuser ORDER BY rand()";
$result = $db->sql_query($sql); 
$row = $db->sql_fetchrow($result);
$lastScore = $row['game_highscore'];
$lastGame = $row['game_name'];
$lastUser = $row['username'];
$lastgameid = $row['game_id'];
$lastgamepic = $row['game_pic'];
$lastuserid = $row['game_highuser'];
$content .= "<center><strong>$lastGame</strong><br /><a href=\"modules.php?name=Forums&file=games&gid=$lastgameid\">";
$content .= "<img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\"></a><br /> ";
$content .= "High Score set by <br /><strong>";
$content .= "<a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=$lastuserid\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
$content .= "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$lastuserid\">$lastUser</a> ";
$content .= "</strong><br />with <strong>$lastScore</strong></center>";
?>
