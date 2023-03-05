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

include_once($phpbb_root_path .'extension.inc');

include_once($phpbb_root_path . 'common.'.$phpEx);

require_once('includes/bbcode.' . $phpEx);



//

// Start session management

//

$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);

init_userprefs($userdata);

//

// End session management

//

include_once('includes/functions_arcade.' . $phpEx);



$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";



if ( !$userdata['session_logged_in'] )

{

	header($header_location . append_sid("login.$phpEx?redirect=comments_list.$phpEx", true));

	exit;

}

//

// End of auth check

//



include_once("includes/page_header.php");



	$comments_sql = "SELECT * FROM " . COMMENTS_TABLE . " WHERE comments_value <> '' "; 



	if ( !($result_count = $db->sql_query($comments_sql)) ) 

      { 

         // Error if it fails... 

         message_die(GENERAL_ERROR, "Couldn't obtain comment count.", "", __LINE__, __FILE__, $sql); 

      }

	

	$count_rows = $db->sql_fetchrowset($result_count);

	$comments_total= count($count_rows);



	$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

	$comments_perpage = 15;





$template->set_filenames(array( 

   'body' => 'comments_list_body.tpl'));



			$template->assign_vars(array(

                        'L_ARCADE_COMMENTS_FULL' => $lang['arcade_comments_full'],

                        'L_ARCADE_COMMENTS' => $lang['arcade_comments'],

                        'L_GAME' => $lang['game'],

                        'L_COMMENTS' => $lang['comments'],

                        'L_ARCADE_USER' => $lang['arcade_user'],

                        'L_SCORE' => $lang['boardscore'],

			'NAV_DESC' => '<a class="nav" href="' . append_sid("arcade.$phpEx") . '">' . $lang['arcade'] . '</a> ' , 

			));

	

	

$sql = "SELECT g.*, c.*, u.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id LEFT JOIN " . USERS_TABLE ." u  ON g.game_highuser=u.user_id WHERE comments_value <> '' ORDER BY game_name ASC LIMIT $start, $comments_perpage";

			if( !($result = $db->sql_query($sql)) )

			{

			message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql); 

			}

	

//

// Define censored word matches

//

$orig_word = array();

$replacement_word = array();

obtain_word_list($orig_word, $replacement_word);



while ( $row = $db->sql_fetchrow($result))

			{



			if ( count($orig_word) )

                        {

                             $row['comments_value'] = preg_replace($orig_word, $replacement_word, $row['comments_value']);

                        }

                        $row['username'] = CheckUsernameColor($row['user_color_gc'], $row['username']);

			$template->assign_block_vars('commentrow', array(

			'GAME_NAME' => '<a href="' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 

			'COMMENTS_VALUE' =>  smilies_pass($row['comments_value']),

			'USERNAME' => '<a href="' . append_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ',

            	        'HIGHSCORE' =>  number_format($row['game_highscore']),

         		)); 



			}



$template->assign_vars(array(

		    'MANAGE_COMMENTS' => '<nobr><a class="cattitle" href="' . append_sid("comments.$phpEx") . '">' . $lang['manage_comments'] . '</a></nobr> ',

                'PAGINATION' => generate_pagination("comments_list.$phpEx?", $comments_total, $comments_perpage, $start),

                'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $comments_perpage) + 1 ), ceil( $comments_total / $comments_perpage )),

                'L_GOTO_PAGE' => $lang['Goto_page'])

        );



//

// Generate the page end

//



$template->pparse('body');

include_once("includes/page_tail.php");



?>

