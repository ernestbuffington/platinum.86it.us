<?php
/***************************************************************************
 *                            functions_delete.php
 *                            -------------------
 *   begin                : Sat, Jul 20, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: functions_delete.php,v 1.14 2004/11/30 17:56:11 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
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

//
// All Attachment Functions processing the Deletion Process
//

//
// Delete Attachment(s) from post(s) (intern)
//
function delete_attachment($post_id_array = 0, $attach_id_array = 0, $page = 0, $user_id = 0)
{
	global $db;

	//
	// Generate Array, if it's not an array
	//
	if ($post_id_array === 0 && $attach_id_array === 0 && $page === 0)
	{
		return;
	}

	if ($post_id_array === 0 && $attach_id_array !== 0)
	{
		$post_id_array = array();

		if (!is_array($attach_id_array))
		{
			if (strstr($attach_id_array, ', '))
			{
				$attach_id_array = explode(', ', $attach_id_array);
			}
			else if (strstr($attach_id_array, ','))
			{
				$attach_id_array = explode(',', $attach_id_array);
			}
			else
			{
				$attach_id = intval($attach_id_array);
				$attach_id_array = array();
				$attach_id_array[] = $attach_id;
			}
		}
	
		// Get the post_ids to fill the array
		if ($page == PAGE_PRIVMSGS)
		{
			$p_id = 'privmsgs_id';
		}
		else
		{
			$p_id = 'post_id';
		}

		$sql = "SELECT $p_id 
			FROM " . ATTACHMENTS_TABLE . '
				WHERE attach_id IN (' . implode(', ', $attach_id_array) . ")
			GROUP BY $p_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not select ids', '', __LINE__, __FILE__, $sql);
		}

		$num_post_list = $db->sql_numrows($result);

		if ($num_post_list == 0)
		{
			return;
		}

		while ($row = $db->sql_fetchrow($result))
		{
			$post_id_array[] = intval($row[$p_id]);
		}
		$db->sql_freeresult($result);
	}
		
	if (!is_array($post_id_array))
	{
		if (trim($post_id_array) == '')
		{
			return;
		}

		if (strstr($post_id_array, ', '))
		{
			$post_id_array = explode(', ', $post_id_array);
		}
		else if (strstr($post_id_array, ','))
		{
			$post_id_array = explode(',', $post_id_array);
		}
		else
		{
			$post_id = intval($post_id_array);

			$post_id_array = array();
			$post_id_array[] = $post_id;
		}
	}
		
	if (!sizeof($post_id_array))
	{
		return;
	}

	//
	// First of all, determine the post id and attach_id
	//
	if ($attach_id_array === 0)
	{
		$attach_id_array = array();

		// Get the attach_ids to fill the array
		if ($page == PAGE_PRIVMSGS)
		{
			$whereclause = 'WHERE privmsgs_id IN (' . implode(', ', $post_id_array) . ')';
		}
		else
		{
			$whereclause = 'WHERE post_id IN (' . implode(', ', $post_id_array) . ')';
		}
			
		$sql = 'SELECT attach_id 
			FROM ' . ATTACHMENTS_TABLE . " $whereclause 
			GROUP BY attach_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not select Attachment Ids', '', __LINE__, __FILE__, $sql);
		}

		$num_attach_list = $db->sql_numrows($result);

		if ($num_attach_list == 0)
		{
			return;
		}

		while ($row = $db->sql_fetchrow($result))
		{
			$attach_id_array[] = (int) $row['attach_id'];
		}
		$db->sql_freeresult($result);
	}
	
	if (!is_array($attach_id_array))
	{
		if (strstr($attach_id_array, ', '))
		{
			$attach_id_array = explode(', ', $attach_id_array);
		}
		else if (strstr($attach_id_array, ','))
		{
			$attach_id_array = explode(',', $attach_id_array);
		}
		else
		{
			$attach_id = intval($attach_id_array);

			$attach_id_array = array();
			$attach_id_array[] = $attach_id;
		}
	}

	if (!sizeof($attach_id_array))
	{
		return;
	}

	if ($page == PAGE_PRIVMSGS)
	{
		$sql_id = 'privmsgs_id';
		if ($user_id)
		{
			$post_id_array_2 = array();

			$sql = 'SELECT privmsgs_id, privmsgs_type, privmsgs_to_userid, privmsgs_from_userid
				FROM ' . PRIVMSGS_TABLE . '
				WHERE privmsgs_id IN (' . implode(', ', $post_id_array) . ')';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t get Privmsgs Type', '', __LINE__, __FILE__, $sql);
			}

			while ($row = $db->sql_fetchrow($result))
			{
				$privmsgs_type = $row['privmsgs_type'];
								
				if ($privmsgs_type == PRIVMSGS_READ_MAIL || $privmsgs_type == PRIVMSGS_NEW_MAIL || $privmsgs_type == PRIVMSGS_UNREAD_MAIL)
				{
					if ($row['privmsgs_to_userid'] == $user_id)
					{
						$post_id_array_2[] = $row['privmsgs_id'];
					}
				}
				else if ($privmsgs_type == PRIVMSGS_SENT_MAIL)
				{
					if ($row['privmsgs_from_userid'] == $user_id)
					{
						$post_id_array_2[] = $row['privmsgs_id'];
					}
				}
				else if ($privmsgs_type == PRIVMSGS_SAVED_OUT_MAIL)
				{
					if ($row['privmsgs_from_userid'] == $user_id)
					{
						$post_id_array_2[] = $row['privmsgs_id'];
					}
				}
				else if ($privmsgs_type == PRIVMSGS_SAVED_IN_MAIL)
				{
					if ($row['privmsgs_to_userid'] == $user_id)
					{
						$post_id_array_2[] = $row['privmsgs_id'];
					}
				}
			}
			$db->sql_freeresult($result);
			$post_id_array = $post_id_array_2;
		}
	}
	else
	{
		$sql_id = 'post_id';
	}

	$sql = 'DELETE FROM ' . ATTACHMENTS_TABLE . ' 
		WHERE attach_id IN (' . implode(', ', $attach_id_array) . ") 
			AND $sql_id IN (" . implode(', ', $post_id_array) . ')';

	if ( !($db->sql_query($sql)) )   
	{
		message_die(GENERAL_ERROR, $lang['Error_deleted_attachments'], '', __LINE__, __FILE__, $sql);   
	} 
	
	for ($i = 0; $i < sizeof($attach_id_array); $i++)
	{
		$sql = 'SELECT attach_id 
			FROM ' . ATTACHMENTS_TABLE . ' 
				WHERE attach_id = ' . $attach_id_array[$i];
			
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not select Attachment Ids', '', __LINE__, __FILE__, $sql);
		}

		if ($db->sql_numrows($result) == 0)
		{
			$sql = 'SELECT attach_id, physical_filename, thumbnail
				FROM ' . ATTACHMENTS_DESC_TABLE . '
				WHERE attach_id = ' . $attach_id_array[$i];
	
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t query attach description table', '', __LINE__, __FILE__, $sql);
			}
		
			if ( $db->sql_numrows($result) != 0)
			{
				$attachments = $db->sql_fetchrowset($result);
				$num_attach = $db->sql_numrows($result);

				//
				// delete attachments
				//
				for ($j = 0; $j < $num_attach; $j++)
				{
					unlink_attach($attachments[$j]['physical_filename']);
					if (intval($attachments[$j]['thumbnail']) == 1)
					{
						unlink_attach($attachments[$j]['physical_filename'], MODE_THUMBNAIL);
					}
					
					$sql = 'DELETE FROM ' . ATTACHMENTS_DESC_TABLE . '
						WHERE attach_id = ' . $attachments[$j]['attach_id'];

					if ( !($db->sql_query($sql)) )
					{
						message_die(GENERAL_ERROR, $lang['Error_deleted_attachments'], '', __LINE__, __FILE__, $sql);
					}
				}
			}
		}
	}
	
	//
	// Now Sync the Topic/PM
	//
	if ($page == PAGE_PRIVMSGS)
	{
		for ($i = 0; $i < sizeof($post_id_array); $i++)
		{
			$sql = 'SELECT attach_id 
				FROM ' . ATTACHMENTS_TABLE . ' 
				WHERE privmsgs_id = ' . $post_id_array[$i];

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t query Attachments Table', '', __LINE__, __FILE__, $sql);
			}

			if ($db->sql_numrows($result) == 0)
			{
				$sql = 'UPDATE ' . PRIVMSGS_TABLE . ' SET privmsgs_attachment = 0 
					WHERE privmsgs_id = ' . $post_id_array[$i];

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t update Private Message Attachment Switch', '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	else
	{
		$sql = 'SELECT topic_id 
			FROM ' . POSTS_TABLE . ' 
			WHERE post_id IN (' . implode(', ', $post_id_array) . ') 
			GROUP BY topic_id';
		
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t select Topic ID', '', __LINE__, __FILE__, $sql);
		}
	
		while ($row = $db->sql_fetchrow($result))
		{
			attachment_sync_topic($row['topic_id']);
		}
		$db->sql_freeresult($result);
	}
}

?>