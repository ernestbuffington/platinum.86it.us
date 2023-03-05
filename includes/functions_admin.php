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

//
// Simple version of jumpbox, just lists authed forums
//

if (!defined('IN_PHPBB')) {
	die();
}

function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
        global $db, $userdata, $lang;

        $is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT f.forum_id, f.forum_name
		FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
		WHERE f.cat_id = c.cat_id
		ORDER BY c.cat_order, f.forum_order';
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
        }

        $forum_list = '';
        while( $row = $db->sql_fetchrow($result) )
        {
                if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
                {
                        $selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
                        $forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
                }
        }

        $forum_list = ( $forum_list == '' ) ? $lang['No_forums'] : '<select name="' . $box_name . '">' . $forum_list . '</select>';

        return $forum_list;
}

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false)
{
        global $db;

        switch($type)
        {
                case 'all forums':
                        $sql = "SELECT forum_id
                                FROM " . FORUMS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
                        }

                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('forum', $row['forum_id']);
                        }
                           break;

                case 'all topics':
                        $sql = "SELECT topic_id
                                FROM " . TOPICS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
                        }

                        
                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('topic', $row['topic_id']);
                        }
                        break;

                  case 'forum':
                        $sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total
                                FROM " . POSTS_TABLE . "
                                WHERE forum_id = $id";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                $last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
                                $total_posts = ($row['total']) ? $row['total'] : 0;
                        }
                        else
                        {
                                $last_post = 0;
                                $total_posts = 0;
                        }

                        $sql = "SELECT COUNT(topic_id) AS total
                                FROM " . TOPICS_TABLE . "
                                WHERE forum_id = $id";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
                        }

                        $total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;

                        $sql = "UPDATE " . FORUMS_TABLE . "
				SET forum_last_post_id = $last_post, forum_posts = $total_posts, forum_topics = $total_topics
				WHERE forum_id = $id";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
                        }
                        break;

                case 'topic':
                        $sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
                                FROM " . POSTS_TABLE . "
                                WHERE topic_id = $id";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                				if ($row['total_posts'])
				{
					// Correct the details of this topic
					$sql = 'UPDATE ' . TOPICS_TABLE . ' 
						SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . "
						WHERE topic_id = $id";
                                if ( !$db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
          					}
				}
				else
				{
					// There are no replies to this topic
					// Check if it is a move stub
					$sql = 'SELECT topic_moved_id 
						FROM ' . TOPICS_TABLE . " 
						WHERE topic_id = $id";

					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
					}

					if ($row = $db->sql_fetchrow($result))
					{
						if (!$row['topic_moved_id'])
						{
							$sql = 'DELETE FROM ' . TOPICS_TABLE . " WHERE topic_id = $id";
			
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
							}
						}
					}

					$db->sql_freeresult($result);
                                }
                        }

                        attachment_sync_topic($id);
						
                        break;
        }

        return true;
}

?>
