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
define('IN_PHPBB', true);
require_once("mainfile.php");

if (isset($_POST['game_name']) ){
$gamename = str_replace("\'","''",$_POST['game_name']);
$gamename = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamename);
//Get Game ID
$row = $db->sql_fetchrow($db->sql_query("SELECT game_id from ".$prefix."_bbgames WHERE game_scorevar='$gamename'"));
$gid = intval($row['game_id']);

}
elseif (isset($_POST['arcade_hash']) ) { 
 $gamehash = str_replace("\'","''",$_POST['arcade_hash']); 
 $gamehash= preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamehash); 

 $result=$db->sql_query("SELECT game_id from ".$prefix."_bbgamehash WHERE gamehash_id='$gamehash'  LIMIT 1");
 if (!$result) {
 	die($prefix."_bbgamehash : pas de result: $gamehash");
 }
 $row=$db->sql_fetchrow($result);
 $gid=$row["game_id"];
 }else {
header($header_location . "modules.php?name=Forums&file=arcade");
exit;
}

if (isset($_POST['score'])){
$gamescore = intval($_POST['score']);
}

$ThemeSel = get_theme();
echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
echo "<form method='post' name='ibpro_score' action='modules.php?name=Forums&file=proarcade&valid=X&gpaver=GFARV2'>";
echo "<input type=hidden name='vscore' value='$gamescore'>";
echo "<input type=hidden name='gid' value='$gid'>";
echo "</form>";

echo "<script type=\"text/javascript\">";
echo "window.onload = function(){document.forms[\"ibpro_score\"].submit()}";
echo "</script>";

exit;
?>
