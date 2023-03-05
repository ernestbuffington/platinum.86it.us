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
define('IN_PHPBB', true);
$phpbb_root_path = 'modules/Forums/';
include_once($phpbb_root_path . 'extension.inc');
include_once('mainfile.'.$phpEx);
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once('includes/functions_arcade.' . $phpEx);
require( $phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx );
include_once('includes/constants.php');
$userdata = session_pagestart($user_ip, PAGE_GAME, $nukeuser);
$sessdo = get_var_gf(array('name'=>'sessdo', 'method'=>'POST', 'default'=>''));
if ($sessdo != '')
{
  $gamename = get_var_gf(array('name'=>'gamename', 'method'=>'POST', 'default'=>''));
  $microone = get_var_gf(array('name'=>'microone', 'method'=>'POST', 'default'=>''));
  $id = get_var_gf(array('name'=>'id', 'method'=>'POST', 'default'=>''));
  $score = get_var_gf(array('name'=>'score', 'method'=>'POST', 'default'=>''));
  $fakekey = get_var_gf(array('name'=>'fakekey', 'method'=>'POST', 'default'=>''));
  $gametime = get_var_gf(array('name'=>'gametime', 'method'=>'POST', 'default'=>''));
  $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
  switch($sessdo)
  {
	case 'sessionstart' :
		//Récupération de l'id du jeu.
		$sql = "SELECT game_id FROM " . GAMES_TABLE . " WHERE game_scorevar = '$gamename'" ;		
		if( !($result = $db->sql_query($sql)) )
		{
	   		$connStatus = 0;
	   		echo "&connStatus=$connStatus";
			message_die(GENERAL_ERROR, "Impossible to update the highscore", '', __LINE__, __FILE__, $sql);
			exit;
		}
		if( !$row = $db->sql_fetchrow($result))
		{
	   		$connStatus = 0;
	   		echo "&connStatus=$connStatus";
			message_die(GENERAL_ERROR, "No highscore corresponds to the variable score : $gamename");
			exit;
		}
		$gamehash_id = md5(uniqid($user_ip)) ;
		$sql = "INSERT INTO " . GAMEHASH_TABLE . " ( gamehash_id , game_id , user_id , hash_date ) VALUES ( '$gamehash_id' , '" . $row['game_id'] . "' , '" . $userdata['user_id'] . "' , '" . time() . "')" ;
		if( !($db->sql_query($sql)) )
		{
	   		$connStatus = 0;
	   		echo "&connStatus=$connStatus";
			message_die(GENERAL_ERROR, "Impossible to update the hash game table", '', __LINE__, __FILE__, $sql);
			exit;
		}
   		$connStatus = 1;
   		$gametime = time();
   		$initbar = $gamename . '|' . $gamehash_id;
   		$lastid = $row['game_id'];
   		echo "&connStatus=$connStatus&gametime=$gametime&initbar=$initbar&lastid=$lastid&val=x";
		exit;
	 break;
	case 'permrequest' :
  		$validate = 1 ;
  		$microone = $score . '|'. $fakekey;
  		echo "&validate=$validate&microone=$microone&val=x";
		exit;
	 break;
	case 'burn' :
   		$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
		$tbinfos = explode('|',$microone);
		$newhash = substr( $tbinfos[2] , 24 , 8 ) . substr( $tbinfos[2] , 0 , 24 ) ;
		header($header_location . "modules.php?name=Forums&file=proarcade&" . $tbinfos[1] . "=" . $tbinfos[0] . "&gid=$id&newhash=$newhash&hashoffset=8&settime=$gametime&gpaver=GFARV2");
		exit;
	}
}
?>
