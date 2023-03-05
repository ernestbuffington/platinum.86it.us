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

function acronym_pass($message)
{
	static $orig, $repl;

	if( !isset($orig) )
	{
		global $db, $board_config;
		$orig = $repl = array();

		$sql = 'SELECT * FROM ' . ACRONYMS_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain acronyms data", "", __LINE__, __FILE__, $sql);
		}
		
		$acronyms = $db->sql_fetchrowset($result);

		if( count($acronyms) )
		{
			usort( $acronyms, 'acronym_sort' );
		}

		for ($i = 0; $i < count($acronyms); $i++)
		{
			$orig[] = '#\b(' . phpbb_preg_quote( $acronyms[$i]['acronym'], "/") . ')\b#';
			//$orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($acronyms[$i]['acronym'], "/") . "(?=.\W|\W.|\W$)/";
			$repl[] = '<acronym title="' . $acronyms[$i]['description'] . '">' . $acronyms[$i]['acronym'] . '</acronym>'; ;
		}
	}
	
	if( count( $orig ) )
	{
        
		$segments = preg_split( '#(<acronym.+?>.+?</acronym>|<.+?>)#s' , $message, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

		$message = '';

		foreach( $segments as $seg )
		{
			if( $seg[0] != '<' && $seg[0] != '[' )
			{
				$message .= str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$orig, \$repl, '\\0')", '>' . $seg . '<'), 1, -1));
			}
			else
			{
				$message .= $seg;
			}
		}
	}
	
	return $message;
}
function acronym_sort($a, $b)
{
	if ( strlen($a['acronym']) == strlen($b['acronym']) )
	{
		return 0;
	}

	return ( strlen($a['acronym']) > strlen($b['acronym']) ) ? -1 : 1;
}

?>
