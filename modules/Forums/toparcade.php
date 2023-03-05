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



if ($popup != "1") {

	$module_name = basename(dirname(__FILE__));

	require_once("modules/".$module_name."/nukebb.php");

} else {

	$phpbb_root_path = 'modules/Forums/';

}



define('IN_PHPBB', true);

include_once($phpbb_root_path . 'extension.inc');

include_once($phpbb_root_path . 'common.'.$phpEx);

require_once($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);



$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";



//

// Start session management

//

$userdata = session_pagestart($user_ip, PAGE_TOPARCADES, $nukeuser);

init_userprefs($userdata);

//

// End session management

//

include_once('includes/functions_arcade.' . $phpEx);

//

// Start auth check

//

$header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE"))) ? "Refresh: 0; URL=" : "Location: ";



if (!$userdata['session_logged_in']) {

		header($header_location . append_sid("login.$phpEx?redirect=toparcade.$phpEx", true));

		exit;

}

//

// End of auth check

//



$template->set_filenames(array(

		'body' => 'toparcade_body.tpl')

);



$template->assign_vars(array(

                'L_TOPARCADE_FIVE' => $lang['toparcade_five'],

		'L_ARCADE' => $lang['toparcade_players'],

		'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> '

)

);



$nbcol = 3;

$games_par_page = 12;

$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');



if ($liste_cat_auth == '') {

		$liste_cat_auth = "''";

}



$sql = "SELECT COUNT(*) AS nbtot FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth)";



if (!($result = $db->sql_query($sql))) {

		message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);

}



if ($row=$db->sql_fetchrow($result)) {

		$total_games = $row['nbtot'];

} else {

		$total_games = 0;

}





$start = get_var_gf(array('name'=>'start', 'intval'=>true));

$limit_sql = " LIMIT $start," . $games_par_page;



$sql = "SELECT distinct game_id , game_name FROM " . GAMES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth) ORDER BY game_name ASC $limit_sql";



if (!($result = $db->sql_query($sql))) {

		message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql); 

}



$fini = false;



if (!$row = $db->sql_fetchrow($result)) {

		$fini=true;

}



while ((!$fini) ) {

		$template->assign_block_vars('blkligne', array());



		for ($cg = 1; $cg <= $nbcol; $cg++) {

				$template->assign_block_vars('blkligne.blkcolonne', array());



				if (!$fini) {

 						$template->assign_block_vars('blkligne.blkcolonne.blkgame', array(

								'GAMENAME' => '<nobr><a class="cattitle" href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a></nobr> ')

						);			

			

						$pos = 0;

						$posreelle = 0;

						$lastscore = 0;

						$sql2 = "SELECT s.* , u.username, u.user_color_gc FROM " . SCORES_TABLE . " s left join " . USERS_TABLE . " u on u.user_id = s.user_id WHERE s.game_id = " . $row['game_id'] . " order by s.score_game DESC, s.score_date ASC LIMIT 0,5 ";



						if (!($result2 = $db->sql_query($sql2))) {

								message_die(GENERAL_ERROR, "Could not read from the scores/users tables", '', __LINE__, __FILE__, $sql);

						}



						while($row2 = $db->sql_fetchrow($result2)) {

								$posreelle++;



								if ($lastscore != $row2['score_game']) { 

										$pos = $posreelle;

								}

								$lastscore = $row2['score_game'];

								$template->assign_block_vars('blkligne.blkcolonne.blkgame.blkscore', array(

										'SCORE' => number_format($row2['score_game']),

										'USERNAME' => CheckUsernameColor($row2['user_color_gc'], $row2['username']),

										'POS' => $pos)

								);				

						}     



						if (!($row = $db->sql_fetchrow($result))) {

								$fini = true;

						}

				}

		}

}



$template->assign_vars(array(

		'PAGINATION' => generate_pagination(append_sid("toparcade.$phpEx?uid=$uid"), $total_games, $games_par_page, $start),

		'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $games_par_page) + 1), ceil($total_games / $games_par_page)))

);





include_once($phpbb_root_path . 'hall_of_fame.'.$phpEx);

//

// Output page header

$page_title = $lang['toparcade'];

include_once('includes/page_header.'.$phpEx);	

$template->pparse('body');

include_once('includes/page_tail.'.$phpEx);



?>

