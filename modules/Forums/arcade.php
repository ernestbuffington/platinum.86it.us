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

$phpbb_root_path = 'modules/Forums/';

include_once($phpbb_root_path . 'extension.inc');

include_once($phpbb_root_path . 'common.'.$phpEx);

require_once($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx );

include_once('includes/constants.'. $phpEx);



//

// Start session management

//

$userdata = session_pagestart($user_ip, PAGE_ARCADES, $nukeuser);

init_userprefs($userdata);

//

// End session management

//

include_once('includes/functions_arcade.' . $phpEx);

//

// Start auth check

//

if (!$userdata['session_logged_in']) {

		$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";

		header($header_location . append_sid("login.$phpEx?redirect=arcade.$phpEx", true));

		exit;

}

//

// End of auth check

//



$arcade_catid = get_var_gf(array('name'=>'cid', 'intval'=>true ));

$start = get_var_gf(array('name'=>'start', 'intval'=>true ));



$arcade_config = array();

$arcade_config = read_arcade_config();



$liste_cat_auth = get_arcade_categories($userdata['user_id'], $userdata['user_level'],'view');



if( $liste_cat_auth == '' ) {

		$liste_cat_auth = "''";

}



$order_by = '';

switch ( $arcade_config['game_order']) {

		case 'Alpha':

			$order_by = ' game_name ASC ';

			break;



		case 'Popular':

			$order_by = ' game_set DESC ';

			break;



		case 'Fixed':

			$order_by = ' game_order ASC ';

			break;



		case 'Random':

			$order_by = ' RAND() ';

			break;



		case 'News':

			$order_by = ' game_id DESC ';

			break;



		default :

			$order_by = ' game_order ASC ';

			break;

}



$favori = $_GET['favori'];

$delfavori = $_GET['delfavori'];



if ($actfav=$favori+$delfavori)

	{

	$sql = "SELECT COUNT(*) AS nbfav from ".ARCADE_FAV_TABLE." where user_id= ".$userdata['user_id']." AND game_id= ".$actfav;

	if( !($result = $db->sql_query($sql)) )

		{

			message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql); 

		}

	$row = $db->sql_fetchrow($result); 

	$nbfav = $row['nbfav']; 

	

	if (!$nbfav && $favori)

		{

			$sql = "INSERT INTO ". ARCADE_FAV_TABLE ." VALUES ('','".$userdata['user_id']."','$favori')"; 

			if( !($result = $db->sql_query($sql)) )

				{

					message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);

				}

		}

	 		

	elseif($delfavori)

		{

			$sql = "DELETE FROM ". ARCADE_FAV_TABLE ." where user_id= ".$userdata['user_id']." AND game_id= ".$delfavori; 

			if( !($result = $db->sql_query($sql)) )

				{

					message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql);

				}

		}				

	};



$games_par_categorie = $arcade_config['category_preview_games'];



if (( $arcade_catid == 0 ) and ( $arcade_config['use_category_mod'] )) {

		$template->set_filenames(array(

		 		'body' => 'arcade_cat_body.tpl')

		);



		$template->assign_vars(array(

				'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',

				'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',	

				'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=$gid") . '">' . $lang['scoreboard'] . '</a></nobr> ',

				'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_sid("comments_list.$phpEx") . '">' . $lang['comments'] . '</a></nobr> ',

				'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,

				'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,

				'FAV' => $lang['fav'],

				'L_GAME' => $lang['games'],

				'L_HIGHSCORE' => $lang['highscore'],

				'L_YOURSCORE' => $lang['yourbestscore'],

				'L_DESC' => $lang['desc_game'],

				'L_ARCADE' => $lang['lib_arcade'])

		);



	if($arcade_config['use_fav_category'])

		{

			$sql = "SELECT g.*, u.username, u.user_id, u.user_color_gc, s.score_game, s.score_date, f.* FROM "

			. GAMES_TABLE." g left join " 

			. USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " 

			. SCORES_TABLE . " s on s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " LEFT JOIN "

			. ARCADE_FAV_TABLE . " f on f.game_id = g.game_id WHERE f.user_id=".$userdata['user_id'] ;

			

			if( !($result = $db->sql_query($sql)) )

			{

				message_die(GENERAL_ERROR, "Could not read the favorites game table", '', __LINE__, __FILE__, $sql); 

			}

			if ($db->sql_numrows($result))

			{

				$template->assign_block_vars('favrow',array()) ;

				$frow['username'] = CheckUsernameColor($frow['user_color_gc'], $frow['username']);

				while( $frow = $db->sql_fetchrow($result))

				{

				$template->assign_block_vars('favrow.fav_row',array(

				'GAMENAMEF' => $frow[game_name],

				'DELFAVORI' => '<a href="' . append_sid("arcade.$phpEx?delfavori=" . $frow['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/delfavs.gif" border=0 alt="'.$lang['del_fav'].'"></a>',

				'GAMELINKF' => '<nobr><a href="' . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">' . $frow['game_name'] . '</a></nobr> ',

				'GAMEPOPUPLINKF' => "<a href='javascript:Arcade_Popup(\"".append_sid("gamespopup.$phpEx?gid=".$frow['game_id'] )."\", \"New_Window\",\"".$frow['game_width']."\",\"".$frow['game_height']."\", \"no\")'>New Window</a>",

                                'GAMEPICF' => ( $frow['game_pic'] != '' ) ? "<a href='" . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) . "'><img src='" . "modules/Forums/games/pics/" . $frow['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $frow['game_name'] . "' ></a>" : '' ,

				'GAMESETF' => ( $frow['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $frow['game_set'] : '',

				'HIGHSCOREF' => number_format($frow['game_highscore']),

				'CLICKPLAY' => '<a href="' . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">Click to Play!</a>',

				'YOURHIGHSCOREF' => number_format($frow['score_game']),

				'NORECORDF' => ( $frow['game_highscore'] == 0 ) ? $lang['no_record'] : '',

				'HIGHUSERF' => ( $frow['game_highuser'] != 0 ) ? '(' . $frow['username'] . ')' : '' ,

				'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=" . $frow['game_id'] ) . '">' . "<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $frow['game_name'] . "'>" . '</a></nobr> ',

				'GAMEIDF' => $frow['game_id'],

				'DATEHIGHF' => "<nobr>" . create_date( $board_config['default_dateformat'] , $frow['game_highdate'] , $board_config['board_timezone'] ) . "</nobr>",

				'YOURDATEHIGHF' => "<nobr>" . create_date( $board_config['default_dateformat'] , $frow['score_date'] , $board_config['board_timezone'] ) . "</nobr>",

				'IMGFIRSTF' => ( $frow['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,

				'GAMEDESCF' => $frow['game_desc']

				));

				

				if ( $frow['game_highscore'] !=0 )

						{

							$template->assign_block_vars('favrow.fav_row.recordrow',array()) ;

						}	

				if ( $frow['score_game'] !=0 )

						{

							$template->assign_block_vars('favrow.fav_row.yourrecordrow',array()) ;

						}

				else		{

							$template->assign_block_vars('favrow.fav_row.playrecordrow',array()) ;

						}

				}

			}

		}





		$liste_jeux = array();		

		$sql = "SELECT g.*, u.username, u.user_id, u.user_color_gc, s.score_game, s.score_date FROM " . GAMES_TABLE . " g LEFT JOIN " . USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " . SCORES_TABLE . " s on s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " WHERE g.arcade_catid IN ($liste_cat_auth) ORDER BY g.arcade_catid, $order_by";





		if( !($result = $db->sql_query($sql)) ) {

				message_die(GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql);

		}



		while( $row = $db->sql_fetchrow($result)) {

				$liste_jeux[$row['arcade_catid']][] = $row;

		}



		$sql = "SELECT arcade_catid, arcade_cattitle, arcade_nbelmt, arcade_catauth FROM " . ARCADE_CATEGORIES_TABLE . " WHERE arcade_catid IN ($liste_cat_auth) ORDER BY arcade_catorder";



		if( !($result = $db->sql_query($sql)) ) {

				message_die(GENERAL_ERROR, "Could not read arcade categories", '', __LINE__, __FILE__, $sql);

		}



		while( $row = $db->sql_fetchrow($result)) {

				$nbjeux = sizeof($liste_jeux[$row['arcade_catid']]);



				if ($nbjeux > 0) {

						$template->assign_block_vars('cat_row',array(

								'U_ARCADE' => append_sid("arcade.$phpEx?cid=" . $row['arcade_catid'] ),

								'LINKCAT_ALIGN' => ( $arcade_config['linkcat_align'] == '0' ) ? 'left' : ( ( $arcade_config['linkcat_align'] == '1' ) ? 'center' : 'right'),

								'L_ARCADE' => sprintf($lang['Other_games'],$row['arcade_nbelmt']),

								'CATTITLE' => $row['arcade_cattitle'])

						);



						$nbjeux = ( $nbjeux < $games_par_categorie ) ? $nbjeux : $games_par_categorie;



						for ($i=0; $i<$nbjeux; $i++) {

						                $liste_jeux[$row['arcade_catid']][$i]['username'] = CheckUsernameColor($liste_jeux[$row['arcade_catid']][$i]['user_color_gc'], $liste_jeux[$row['arcade_catid']][$i]['username']);

								$template->assign_block_vars('cat_row.game_row',array(

										'GAMENAME' => $liste_jeux[$row['arcade_catid']][$i]['game_name'],

										'GAMELINK' => '<nobr><a href="' . append_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">' . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . '</a></nobr> ',

										'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_sid("gamespopup.$phpEx?gid=".$liste_jeux[$row['arcade_catid']][$i]['game_id'] )."\", \"New_Window\",\"".$liste_jeux[$row['arcade_catid']][$i]['game_width']."\",\"".$liste_jeux[$row['arcade_catid']][$i]['game_height']."\", \"no\")'>New Window</a>",

                                                                                'GAMEPIC' => ( $liste_jeux[$row['arcade_catid']][$i]['game_pic'] != '' ) ? "<a href='" . append_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . "'><img src='".$phpbb_root_path ."games/pics/" . $liste_jeux[$row['arcade_catid']][$i]['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . "' ></a>" : '' ,

										'GAMESET' => ( $liste_jeux[$row['arcade_catid']][$i]['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $liste_jeux[$row['arcade_catid']][$i]['game_set'] : '',

										'HIGHSCORE' => number_format($liste_jeux[$row['arcade_catid']][$i]['game_highscore']),

										'YOURHIGHSCORE' => number_format($liste_jeux[$row['arcade_catid']][$i]['score_game']),

										'CLICKPLAY' => '<a href="' . append_sid("games.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">Click to Play!</a>',

										'NORECORD' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highscore'] == 0 ) ? $lang['no_record'] : '',

										'HIGHUSER' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highuser'] != 0 ) ? '(' . $liste_jeux[$row['arcade_catid']][$i]['username'] . ')' : '' ,

										'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) . '">' . "<img src='".$phpbb_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $liste_jeux[$row['arcade_catid']][$i]['game_name'] . "'>" . '</a></nobr> ',

										'GAMEID' => $liste_jeux[$row['arcade_catid']][$i]['game_id'],

										'DATEHIGH' => "<nobr>" . create_date( $board_config['default_dateformat'] , $liste_jeux[$row['arcade_catid']][$i]['game_highdate'] , $board_config['board_timezone'] ) . "</nobr>",

										'YOURDATEHIGH' => "<nobr>" . create_date( $board_config['default_dateformat'] , $liste_jeux[$row['arcade_catid']][$i]['score_date'] , $board_config['board_timezone'] ) . "</nobr>",

										'IMGFIRST' => ( $liste_jeux[$row['arcade_catid']][$i]['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,

										'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_sid("arcade.$phpEx?favori=" . $liste_jeux[$row['arcade_catid']][$i]['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$lang['add_fav'].'"></a></td>':'',

										'GAMEDESC' => $liste_jeux[$row['arcade_catid']][$i]['game_desc'])

								);



								if ( $liste_jeux[$row['arcade_catid']][$i]['game_highscore'] !=0 ) {

										$template->assign_block_vars('cat_row.game_row.recordrow',array());

								}

	

								if ( $liste_jeux[$row['arcade_catid']][$i]['score_game'] !=0 ) {

										$template->assign_block_vars('cat_row.game_row.yourrecordrow',array());

								}

								else

								{

										$template->assign_block_vars('cat_row.game_row.playrecordrow',array()) ;

								}		

						}

				}

		}





		include_once($phpbb_root_path . 'whoisplaying.'.$phpEx);



		//

		// Output page header

		include_once($phpbb_root_path . 'headingarcade.'.$phpEx);

		$page_title = $lang['arcade'];

		include_once('includes/page_header.'.$phpEx);	

		$template->pparse('body');

		include_once('includes/page_tail.'.$phpEx);

		exit;

}



$games_par_page = $arcade_config['games_par_page'];

$sql_where = '';

$limit = " LIMIT $start,$games_par_page ";



$total_games = 0;



if ( $arcade_config['use_category_mod']) {

		$sql_where = " WHERE arcade_catid = $arcade_catid AND arcade_catid IN ($liste_cat_auth)";

		$sql = "SELECT arcade_cattitle, arcade_nbelmt AS nbgames FROM " . ARCADE_CATEGORIES_TABLE . " $sql_where";



		if( !($result = $db->sql_query($sql)) ) {

				message_die(GENERAL_ERROR, "Could not read the arcade categories table", '', __LINE__, __FILE__, $sql);

		}



		if ( $row = $db->sql_fetchrow($result)) {

				$total_games = $row['nbgames'];

		} else {

				message_die(GENERAL_MESSAGE,$lang['no_arcade_cat']);

		}



		$template->assign_block_vars('use_category_mod', array());

} else {

		$sql = "SELECT COUNT(*) AS nbgames FROM " . GAMES_TABLE;



		if( !($result = $db->sql_query($sql)) ) {

				message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);

		}



		if ( $row = $db->sql_fetchrow($result)) {

				$total_games = $row['nbgames'];

		}

}



//chargement du template

$template->set_filenames(array(

		'body' => 'arcade_body.tpl')

);



$template->assign_vars(array(

		'URL_ARCADE' => '<nobr><a class="cattitle" href="' . append_sid("arcade.$phpEx") . '">' . $lang['lib_arcade'] . '</a></nobr> ',

		'URL_BESTSCORES' => '<nobr><a class="cattitle" href="' . append_sid("toparcade.$phpEx") . '">' . $lang['best_scores'] . '</a></nobr> ',	

		'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=$gid") . '">' . $lang['scoreboard'] . '</a></nobr> ',

		'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_sid("comments_list.$phpEx") . '">' . $lang['comments'] . '</a></nobr> ',	

		'CATTITLE' => $row['arcade_cattitle'],

		'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ' ,

		'L_GAME' => $lang['games'],

		'PAGINATION' => generate_pagination(append_sid("arcade.$phpEx?cid=$arcade_catid"), $total_games, $games_par_page, $start),

		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $games_par_page ) + 1 ), ceil( $total_games / $games_par_page )),

		'ARCADE_COL' => ($arcade_config['use_fav_category'])? 6:5,

		'ARCADE_COL1' => ($arcade_config['use_fav_category'])? 2:1,

		'FAV' => $lang['fav'],

		'L_HIGHSCORE' => $lang['highscore'],

		'L_YOURSCORE' => $lang['yourbestscore'],

		'L_DESC' => $lang['desc_game'],

		'L_ARCADE' => $lang['lib_arcade'])

);

	if(($arcade_config['use_fav_category'])&&(!$arcade_config['use_category_mod']))

		{

			$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date, f.* FROM "

			. GAMES_TABLE." g left join " 

			. USERS_TABLE . " u ON g.game_highuser = u.user_id LEFT JOIN " 

			. SCORES_TABLE . " s on s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " LEFT JOIN "

			. ARCADE_FAV_TABLE . " f on f.game_id = g.game_id WHERE f.user_id=".$userdata['user_id'] ;

			

			if( !($result = $db->sql_query($sql)) )

			{

				message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);

			}

			if ($db->sql_numrows($result))

			{

				$template->assign_block_vars('favrow',array()) ;

				

				while( $frow = $db->sql_fetchrow($result))

				{

				$template->assign_block_vars('favrow.fav_row',array(

				'GAMENAMEF' => $frow[game_name],

				'DELFAVORI' => '<a href="' . append_sid("arcade.$phpEx?delfavori=" . $frow['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/delfavs.gif" border=0 alt="'.$lang['del_fav'].'"></a>',

				'GAMELINKF' => '<nobr><a href="' . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) . '">' . $frow['game_name'] . '</a></nobr> ',

				'GAMEPOPUPLINKF' => "<a href='javascript:Arcade_Popup(\"".append_sid("gamespopup.$phpEx?gid=".$frow['game_id'] )."\", \"New_Window\",\"".$frow['game_width']."\",\"".$frow['game_height']."\", \"no\")'>New Window</a>",

                                'GAMEPICF' => ( $frow['game_pic'] != '' ) ? "<a href='" . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) . "'><img src='" . "modules/Forums/games/pics/" . $frow['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' vspace='2' hspace='2' alt='" . $frow['game_name'] . "' ></a>" : '' ,

				'GAMESETF' => ( $frow['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $frow['game_set'] : '',

				'HIGHSCOREF' => number_format($frow['game_highscore']),

				'CLICKPLAY' => '<a href="' . append_sid("games.$phpEx?gid=" . $frow['game_id'] ) .'">Click to Play!</a>',

				'YOURHIGHSCOREF' => number_format($frow['score_game']),

				'NORECORDF' => ( $frow['game_highscore'] == 0 ) ? $lang['no_record'] : '',

				'HIGHUSERF' => ( $frow['game_highuser'] != 0 ) ? '(' . $frow['username'] . ')' : '' ,

				'URL_SCOREBOARDF' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=" . $frow['game_id'] ) . '">' . "<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $frow['game_name'] . "'>" . '</a></nobr> ',

				'GAMEIDF' => $frow['game_id'],

				'DATEHIGHF' => "<nobr>" . create_date( $board_config['default_dateformat'] , $frow['game_highdate'] , $board_config['board_timezone'] ) . "</nobr>",

				'YOURDATEHIGHF' => "<nobr>" . create_date( $board_config['default_dateformat'] , $frow['score_date'] , $board_config['board_timezone'] ) . "</nobr>",

				'IMGFIRSTF' => ( $frow['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='modules/Forums/templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,

				'GAMEDESCF' => $frow['game_desc']

				));

				

				if ( $frow['game_highscore'] !=0 )

						{

							$template->assign_block_vars('favrow.fav_row.recordrow',array()) ;

						}	

				if ( $frow['score_game'] !=0 )

						{

							$template->assign_block_vars('favrow.fav_row.yourrecordrow',array()) ;

						}

						else

						{

							$template->assign_block_vars('favrow.fav_row.playrecordrow',array()) ;

						}

				}

			}

		}



$sql = "SELECT g.*, u.username, u.user_id, s.score_game, s.score_date FROM " . GAMES_TABLE . " g left join " . USERS_TABLE . " u on g.game_highuser = u.user_id left join " . SCORES_TABLE . " s on s.game_id = g.game_id and s.user_id = " . $userdata['user_id'] . " $sql_where ORDER BY $order_by $limit";



if( !($result = $db->sql_query($sql)) ) {

		message_die(GENERAL_ERROR, "Could not read games table", '', __LINE__, __FILE__, $sql);

}



while( $row = $db->sql_fetchrow($result) ) {

		$template->assign_block_vars('gamerow', array(

				'GAMENAME' => $row['game_name'],

				'GAMEPIC' => ( $row['game_pic'] != '' ) ? "<a href='" . append_sid("games.$phpEx?gid=" . $row['game_id'] ) . "'><img src='".$phpbb_root_path ."games/pics/" . $row['game_pic'] . "' align='absmiddle' border='0' width='30' height='30' alt='" . $row['game_name'] . "' ></a>" : '' ,

				'GAMESET' => ( $row['game_set'] != 0  ) ? $lang['game_actual_nbset'] . $row['game_set'] : '',

				'GAMEDESC' => $row['game_desc'],

				'HIGHSCORE' => number_format($row['game_highscore']),

				'YOURHIGHSCORE' => number_format($row['score_game']),

				'CLICKPLAY' => '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">Click to Play!</a>',

				'NORECORD' => ( $row['game_highscore'] == 0 ) ? $lang['no_record'] : '',

				'HIGHUSER' => ( $row['game_highuser'] != 0 ) ? '(' . $row['username'] . ')' : '' ,

				'URL_SCOREBOARD' => '<nobr><a class="cattitle" href="' . append_sid("scoreboard.$phpEx?gid=" . $row['game_id'] ) . '">' . "<img src='".$phpbb_root_path ."templates/" . $theme['template_name'] . "/images/scoreboard.gif' align='absmiddle' border='0' alt='" . $lang['scoreboard'] . " " . $row['game_name'] . "'>" . '</a></nobr> ',	

				'GAMEID' => $row['game_id'],

				'DATEHIGH' => "<nobr>" . create_date( $board_config['default_dateformat'] , $row['game_highdate'] , $board_config['board_timezone'] ) . "</nobr>",

				'YOURDATEHIGH' => "<nobr>" . create_date( $board_config['default_dateformat'] , $row['score_date'] , $board_config['board_timezone'] ) . "</nobr>",

				'IMGFIRST' => ( $row['game_highuser'] == $userdata['user_id'] ) ? "&nbsp;&nbsp;<img src='".$phpbb_root_path ."templates/" . $theme['template_name'] . "/images/couronne.gif' align='absmiddle'>" : "" ,

				'ADD_FAV' => ($arcade_config['use_fav_category'])?'<td class="row1" width="25" align="center" valign="center"><a href="' . append_sid("arcade.$phpEx?favori=" . $row['game_id'] ) .'"><img src="modules/Forums/templates/subSilver/images/favs.gif" border=0 alt="'.$lang['add_fav'].'"></a></td>':'',

				'GAMELINK' => '<nobr><a href="' . append_sid("games.$phpEx?gid=" . $row['game_id'] ) . '">' . $row['game_name'] . '</a></nobr> ' ,

		                'GAMEPOPUPLINK' => "<a href='javascript:Arcade_Popup(\"".append_sid("gamespopup.$phpEx?gid=".$row['game_id'] )."\", \"New_Window\",\"".$row['game_width']."\",\"".$row['game_height']."\", \"no\")'>New Window</a>")

                );



		if ( $row['game_highscore'] !=0 ) {

				$template->assign_block_vars('gamerow.recordrow',array());

		}



		if ( $row['score_game'] !=0 ) {

				$template->assign_block_vars('gamerow.yourrecordrow',array());

		}

		else

		{

			$template->assign_block_vars('gamerow.playrecordrow',array()) ;

		}			

}



include_once($phpbb_root_path . 'whoisplaying.'.$phpEx);



//

// Output page header

include_once($phpbb_root_path . 'headingarcade.'.$phpEx);

$page_title = $lang['arcade'];

include_once('includes/page_header.'.$phpEx);	

$template->pparse('body');

include_once('includes/page_tail.'.$phpEx);



?>

