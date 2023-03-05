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

if (!defined('IN_PHPBB')) {

		die("Hacking attempt");

}

$index = 1;

if (!function_exists('get_arcade_categories')) {

	include_once('includes/functions_arcade.' . $phpEx);

}



$template->set_filenames(array(

		'whoisplaying' => 'whoisplaying_body.tpl')

);



$template->assign_vars(array(

		"L_WHOISPLAYING" => $lang['whoisplaying'])

);



if (!isset($liste_cat_auth)) {

		$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');



		if ($liste_cat_auth == '') {

				$liste_cat_auth = "''";

		}

}



$sql = "SELECT u.username, u.user_id, u.user_level, u.user_color_gc, user_allow_viewonline, g.game_name, g.game_id FROM " . GAMEHASH_TABLE . " gh LEFT JOIN " . SESSIONS_TABLE . " s ON gh.user_id = s.session_user_id LEFT JOIN " . USERS_TABLE . " u ON gh.user_id = u.user_id LEFT JOIN " . GAMES_TABLE . " g ON gh.game_id = g.game_id WHERE gh.hash_date >= s.session_time AND (" . time() . "- gh.hash_date <= 300) AND g.arcade_catid IN ($liste_cat_auth) ORDER BY gh.hash_date DESC";



if (!($result = $db->sql_query($sql))) {

		message_die(CRITICAL_ERROR, "Could not query games information", "", __LINE__, __FILE__, $sql);

}



while ($row = $db->sql_fetchrow($result)) {

		$players[] = $row;

}



$last_game = '';

$list_player = '';

$prev_user_id = '';

$class = '';



$nbplayers = count($players);

$listeid = array();

$games_players = array();

$games_names = array();



for($i=0 ; $i<$nbplayers ; $i++) {

		if (!isset($listeid[ $players[$i]['user_id'] ])) {

				$listeid[ $players[$i]['user_id'] ] = true ;

				$style_color = '';

                                /*

				if ($players[$i]['user_level'] == ADMIN) {

						$players[$i]['username'] = '<strong>' . $players[$i]['username'] . '</strong>';

						$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';

				} else if ($players[$i]['user_level'] == MOD) {

						$players[$i]['username'] = '<strong>' . $players[$i]['username'] . '</strong>';

						$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';

				}*/

				$players[$i]['username'] = CheckUsernameColor($players[$i]['user_color_gc'], $players[$i]['username']);



				if ($players[$i]['user_allow_viewonline']) {

						$player_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $players[$i]['user_id']) . '"' . $style_color .'>' . $players[$i]['username'] . '</a>';

				} else {

						$player_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $players[$i]['user_id']) . '"' . $style_color .'><i>' . $players[$i]['username'] . '</i></a>';

				}



				if ($players[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN) {

						if (!isset($games_names[ $players[$i]['game_id'] ])) {

								$games_names[ $players[$i]['game_id'] ] = $players[$i]['game_name'] ;

								$games_players[ $players[$i]['game_id'] ] = $player_link ;

						} else {

								$games_players[ $players[$i]['game_id'] ] .=  ', ' . $player_link ;

						}

				}

		}

}





foreach($games_names AS $key => $val) {

		if ($games_players[$key]!='') {

				$class = ($class == 'row1') ? 'row2' : 'row1';



				$template->assign_block_vars('whoisplaying_row', array(

						'CLASS' => $class,

						'GAME' => '<a href="' . append_sid("games.$phpEx?gid=" . $key) . '">' . $val . '</a>',

						'PLAYER_LIST' => $games_players[$key])

				);

		}

}



$template->assign_var_from_handle('WHOISPLAYING', 'whoisplaying');



?>

