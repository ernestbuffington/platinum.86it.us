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
/***************************************************************************
 *                            functions_mg_ranks.php
 *                            ---------------------
 *   begin                : 2005/08/31
 *   copyright            : Mighty Gorgon (Luca Libralato)
 *   website              : http://www.mightygorgon.com
 *   email                : mightygorgon@mightygorgon.com
 *   version              : 1.1.0
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
 ***************************************************************************/


function query_ranks()
{
	global $db;

	$sql = "SELECT ban_userid
		FROM " . BANLIST_TABLE . "
		ORDER BY ban_userid ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain banned users information.", '', __LINE__, __FILE__, $sql);
	}
	
		$ranks_sql = array();
	/*
	while ($row = $db->sql_fetchrow($result) )
	{
		$ranks_sql['bannedrow'][] = $row;
	}
	*/
	//$ranks_sql['bannedrow'][] = $db->sql->fetchrowset($result);
	$ranks_sql['bannedrow'][] = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	$sql = "SELECT *
		FROM " . RANKS_TABLE . "
		ORDER BY rank_special ASC, rank_min ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
	}

	while ($row = $db->sql_fetchrow($result) )
	{
		$ranks_sql['ranksrow'][] = $row;
	}
	//$ranks_sql['ranksrow'][] = $db->sql->fetchrowset($result);
	$db->sql_freeresult($result);

	return $ranks_sql;
}


function generate_ranks($user_row, $ranks_sql)
{
	$user_fields_array = array(
		'user_rank',
		'user_rank2',
		'user_rank3',
		'user_rank4',
		'user_rank5'
	);
	$user_ranks_array = array(
		'rank_01', 'rank_01_img',
		'rank_02', 'rank_02_img',
		'rank_03', 'rank_03_img',
		'rank_04', 'rank_04_img',
		'rank_05', 'rank_05_img',
	);
	$user_ranks = array();
	
	$is_banned = false;
	$is_guest = false;
	$rank_sw = false;

	for($j = 0; $j < count($user_ranks_array); $j++)
	{
		$user_ranks[$user_ranks_array[$j]] = '';
	}

	if ( $user_row['user_id'] == '-1' )
	{
		$is_guest = true;
	}

	if ($is_guest == false)
	{
		for($j = 0; $j < count($ranks_sql['bannedrow']); $j++)
		{
			if ( $ranks_sql['bannedrow'][$j]['ban_userid'] == $user_row['user_id'] )
			{
				$is_banned = true;
			}
		}
	}

	for($j = 0; $j < count($ranks_sql['ranksrow']); $j++)
	{
		$rank_tmp = $ranks_sql['ranksrow'][$j]['rank_title'];
		$rank_img_tmp = ( $ranks_sql['ranksrow'][$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranks_sql['ranksrow'][$j]['rank_image'] . '" alt="' . $rank_tmp . '" title="' . $rank_tmp . '" border="0" />' : '';
		if ($is_guest == true)
		{
			if ($ranks_sql['ranksrow'][$j]['rank_special'] == '2')
			{
				$user_ranks['rank_01'] = $rank_tmp;
				$user_ranks['rank_01_img'] = $rank_img_tmp;
			}
		}
		elseif ($is_banned == true)
		{
			if ($ranks_sql['ranksrow'][$j]['rank_special'] == '3')
			{
				$user_ranks['rank_01'] = $rank_tmp;
				$user_ranks['rank_01_img'] = $rank_img_tmp;
			}
		}
		else
		{
			$day_diff = intval( (time() - $user_row['user_regdate']) / 86400 );

			for($k = 0; $k < count($user_fields_array); $k++)
			{
				switch ($ranks_sql['ranksrow'][$j]['rank_special'])
				{
					case '1':
						if ($user_row[$user_fields_array[$k]] == $ranks_sql['ranksrow'][$j]['rank_id'])
						{
							$rank_sw = true;
						}
						break;
					case '0':
						if (($user_row[$user_fields_array[$k]] == '0') && ($user_row['user_posts'] >= $ranks_sql['ranksrow'][$j]['rank_min']))
						{
							$rank_sw = true;
						}
						break;
					case '-1':
						if (($user_row[$user_fields_array[$k]] == '-1') && ($day_diff >= $ranks_sql['ranksrow'][$j]['rank_min']))
						{
							$rank_sw = true;
						}
						break;
					default:
						break;
				}

				if ($rank_sw == true)
				{
					$user_ranks[$user_ranks_array[(($k + 1) * 2) - 2]] = $rank_tmp;
					$user_ranks[$user_ranks_array[(($k + 1) * 2) - 1]] = $rank_img_tmp;
					$rank_sw = false;
				}
			}

		}
	}

	return $user_ranks;
}

?>