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

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !defined('LANG_EXTEND_DONE') )
{
	// check for admin part
	$lang_extend_admin = defined('IN_ADMIN');

	// get the english settings
	if ( $board_config['default_lang'] != 'english' )
	{
		$dir = @opendir($phpbb_root_path . 'language/lang_english');
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . 'language/lang_english/' . $file);
			}
		}
		// include_once the personalisations
		include_once($phpbb_root_path . 'language/lang_english/lang_extend.' . $phpEx);
		@closedir($dir);
	}

	// get the user settings
	if ( !empty($board_config['default_lang']) )
    
	{
		$dir = @opendir($phpbb_root_path . 'language/lang_' . $board_config['default_lang']);
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $file);
			}
		}
		// include_once the personalisations
		include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_extend.' . $phpEx);
		@closedir($dir);
	}
	define('LANG_EXTEND_DONE', true);
}

?>
