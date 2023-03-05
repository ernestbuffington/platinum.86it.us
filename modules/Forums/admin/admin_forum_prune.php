<?php
/***************************************************************************
*                             admin_forum_prune.php
*                              -------------------
*     begin                : Mon Jul 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     $Id: admin_forum_prune.php,v 1.22.2.3 2002/12/18 14:14:07 psotfx Exp $
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
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

define('IN_PHPBB', true);

if ( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Forums']['Prune'] = $filename;

        return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
require_once("../../../includes/prune.php");
require_once("../../../includes/functions_admin.php");

//
// Get the forum ID for pruning
//
if( isset($_GET[POST_FORUM_URL]) || isset($_POST[POST_FORUM_URL]) )
{
        $forum_id = ( isset($_POST[POST_FORUM_URL]) ) ? $_POST[POST_FORUM_URL] : $_GET[POST_FORUM_URL];

        if( $forum_id == -1 )
        {
                $forum_sql = '';
        }
        else
        {
                $forum_id = intval($forum_id);
                $forum_sql = "AND forum_id = $forum_id";
        }
}
else
{
        $forum_id = '';
        $forum_sql = '';
}
//
// Get a list of forum's or the data for the forum that we are pruning.
//
$sql = "SELECT f.*
        FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
        WHERE c.cat_id = f.cat_id
        $forum_sql
        ORDER BY c.cat_order ASC, f.forum_order ASC";
if( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not obtain list of forums for pruning', '', __LINE__, __FILE__, $sql);
}

$forum_rows = array();
while( $row = $db->sql_fetchrow($result) )
{
        $forum_rows[] = $row;
}

//
// Check for submit to be equal to Prune. If so then proceed with the pruning.
//
if( isset($_POST['doprune']) )
{
        $prunedays = ( isset($_POST['prunedays']) ) ? intval($_POST['prunedays']) : 0;

        // Convert days to seconds for timestamp functions...
        $prunedate = time() - ( $prunedays * 86400 );

        $template->set_filenames(array(
                'body' => 'admin/forum_prune_result_body.tpl')
        );

        for($i = 0; $i < count($forum_rows); $i++)
        {
                $p_result = prune($forum_rows[$i]['forum_id'], $prunedate);
                sync('forum', $forum_rows[$i]['forum_id']);

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $template->assign_block_vars('prune_results', array(
                        'ROW_COLOR' => '#' . $row_color,
                        'ROW_CLASS' => $row_class,
                        'FORUM_NAME' => $forum_rows[$i]['forum_name'],
                        'FORUM_TOPICS' => $p_result['topics'],
                        'FORUM_POSTS' => $p_result['posts'])
                );
        }

        $template->assign_vars(array(
                'L_FORUM_PRUNE' => $lang['Forum_Prune'],
                'L_FORUM' => $lang['Forum'],
                'L_TOPICS_PRUNED' => $lang['Topics_pruned'],
                'L_POSTS_PRUNED' => $lang['Posts_pruned'],
                'L_PRUNE_RESULT' => $lang['Prune_success'])
        );
}
else
{
        //
        // If they haven't selected a forum for pruning yet then
        // display a select box to use for pruning.
        //
        if( empty($_POST[POST_FORUM_URL]) )
        {
                //
                // Output a selection table if no forum id has been specified.
                //
                $template->set_filenames(array(
                        'body' => 'admin/forum_prune_select_body.tpl')
                );

                $select_list = '<select name="' . POST_FORUM_URL . '">';
                $select_list .= '<option value="-1">' . $lang['All_Forums'] . '</option>';

                for($i = 0; $i < count($forum_rows); $i++)
                {
                        $select_list .= '<option value="' . $forum_rows[$i]['forum_id'] . '">' . $forum_rows[$i]['forum_name'] . '</option>';
                }
                $select_list .= '</select>';

                //
                // Assign the template variables.
                //
                $template->assign_vars(array(
                        'L_FORUM_PRUNE' => $lang['Forum_Prune'],
                        'L_SELECT_FORUM' => $lang['Select_a_Forum'],
                        'L_LOOK_UP' => $lang['Look_up_Forum'],

                        'S_FORUMPRUNE_ACTION' => append_sid("admin_forum_prune.$phpEx"),
                        'S_FORUMS_SELECT' => $select_list)
                );
        }
        else
        {
                $forum_id = intval($_POST[POST_FORUM_URL]);

                //
                // Output the form to retrieve Prune information.
                //
                $template->set_filenames(array(
                        'body' => 'admin/forum_prune_body.tpl')
                );

                $forum_name = ( $forum_id == -1 ) ? $lang['All_Forums'] : $forum_rows[0]['forum_name'];

                $prune_data = $lang['Prune_topics_not_posted'] . " ";
                $prune_data .= '<input class="post" type="text" name="prunedays" size="4"> ' . $lang['Days'];

                $hidden_input = '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '">';

                //
                // Assign the template variables.
                //
                $template->assign_vars(array(
                        'FORUM_NAME' => $forum_name,

                        'L_FORUM' => $lang['Forum'],
                        'L_FORUM_PRUNE' => $lang['Forum_Prune'],
                        'L_FORUM_PRUNE_EXPLAIN' => $lang['Forum_Prune_explain'],
                        'L_DO_PRUNE' => $lang['Do_Prune'],

                        'S_FORUMPRUNE_ACTION' => append_sid("admin_forum_prune.$phpEx"),
                        'S_PRUNE_DATA' => $prune_data,
                        'S_HIDDEN_VARS' => $hidden_input)
                );
        }
}
//
// Actually output the page here.
//
$template->pparse('body');

include_once('./page_footer_admin.'.$phpEx);

?>