<?php
/***************************************************************************
 *                                admin_arcade_comments.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://arcade.portedmods.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

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

define('IN_PHPBB', 1); 

if( !empty($setmodules) ) 
{ 
   $file = basename(__FILE__); 
   $module['Arcade_Admin']['Manage_comments'] = "$file";
   return; 
} 

// 
// Let's set the root dir for phpBB 
// 
$phpbb_root_path = "./../"; 
require_once($phpbb_root_path . 'extension.inc'); 
require_once('./pagestart.' . $phpEx);
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

$mode = $_GET['mode'];

	if($mode == "update")
	{
	$game_id = intval($_POST['comment_id']);
	$comment_text = str_replace("\'","''",$_POST['comments']);
	$comment_text = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$comment_text);
		
	//Enters Comment into the DB
	$sql = "UPDATE " . COMMENTS_TABLE . " SET comments_value = '$comment_text' WHERE game_id = $game_id";				
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't insert row in comments table", "", __LINE__, __FILE__, $sql);
	}
		
	//Comment Updated/Added Successfully
	$message = "Comment sucessfully updated."; 
      $message .= "<br /><br />Click <a href=\"admin_arcade_comments.php\">here</a> to return to comments configuration."; 
	$message .= "<META HTTP-EQUIV=\"refresh\" content=\"5;URL=admin_arcade_comments.php\">";
      message_die(GENERAL_MESSAGE, $message); 

	}
	

	if($mode == "edit")
	{

	$gid = $_GET['gid'];

	$template->set_filenames(array( 
	   'body' => 'admin/admin_edit_comments_body.tpl')); 

	
	//Gets comments from database
	$sql = "SELECT g.game_id, g.game_name, c.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id WHERE g.game_id = $gid";
	if( !($result = $db->sql_query($sql)) )
			{
			message_die(GENERAL_ERROR, "Error retrieving comment list", '', __LINE__, __FILE__, $sql); 
			}

	$row = $db->sql_fetchrow($result);

	$template->assign_vars(array(
			'GAME_ID' => $row['game_id'],
			'GAME_NAME' => '<a href="../../../' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 
			'COMMENTS' => $row['comments_value'],
			'S_ACTION' => append_sid('admin_arcade_comments.' . $phpEx . '?mode=update'), 
			));

	$template->pparse('body'); 

	include_once('./page_footer_admin.'.$phpEx);

	}
 
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
   'body' => 'admin/admin_arcade_comments_body.tpl')); 

				
$sql = "SELECT g.*, c.*, u.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id LEFT JOIN " . USERS_TABLE ." u  ON g.game_highuser=u.user_id WHERE comments_value <> '' ORDER BY game_name ASC LIMIT $start, $comments_perpage";
			if( !($result = $db->sql_query($sql)) )
			{
			message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql); 
			}
	
	

while ( $row = $db->sql_fetchrow($result))
			{
			
			$template->assign_block_vars('commentrow', array(  
			'GAME_NAME' => '<a href="../../../' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 
			'COMMENTS_VALUE' => $row['comments_value'],
			'USERNAME' => '<a href="../../../' . append_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . $row['username'] . '</a> ',
         		'EDIT_COMMENTS' => '<a href="' . append_sid("admin_arcade_comments.$phpEx?mode=edit&gid=" . $row['game_id']) . '">Edit Comment</a>',
			)); 

			}

$template->assign_vars(array(
                'PAGINATION' => generate_pagination("admin_arcade_comments.$phpEx?", $comments_total, $comments_perpage, $start),
                'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $comments_perpage) + 1 ), ceil( $comments_total / $comments_perpage )),
                'L_GOTO_PAGE' => $lang['Goto_page'])
        );

//
// Generate the page end
//

$template->pparse('body');
include_once('./page_footer_admin.'.$phpEx);

?>
