<?php
/***************************************************************************
 *							   attachment_mod.php
 *                            -------------------
 *   begin                : Monday, Jan 07, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: attachment_mod.php,v 1.20 2004/07/31 15:15:53 acydburn Exp $
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

@include_once($phpbb_root_path . 'attach_mod/includes/constants.'.$phpEx);
@include_once($phpbb_root_path . 'attach_mod/includes/functions_includes.'.$phpEx);
@include_once($phpbb_root_path . 'attach_mod/includes/functions_attach.'.$phpEx);
@include_once($phpbb_root_path . 'attach_mod/includes/functions_delete.'.$phpEx);
@include_once($phpbb_root_path . 'attach_mod/includes/functions_thumbs.'.$phpEx);
@include_once($phpbb_root_path . 'attach_mod/includes/functions_filetypes.'.$phpEx);

if (defined('ATTACH_INSTALL'))
{
	return;
}

function include_attach_lang()
{
	global $phpbb_root_path, $phpEx, $lang, $board_config, $attach_config;
	
	//
	// Include Language
	//
	$language = $board_config['default_lang'];

	if (!file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_main_attach.'.$phpEx))
	{
		$language = $attach_config['board_lang'];
	}

	@include_once($phpbb_root_path . 'language/lang_' . $language . '/lang_main_attach.' . $phpEx);

	if (defined('IN_ADMIN'))
	{
		if (!file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.'.$phpEx))
		{
			$language = $attach_config['board_lang'];
		}

		@include_once($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.' . $phpEx);
	}

}

function get_config()
{
	global $db, $board_config;

	$attach_config = array();

	$sql = 'SELECT *
		FROM ' . ATTACH_CONFIG_TABLE;
	 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query attachment information', '', __LINE__, __FILE__, $sql);
	}

	while ($row = $db->sql_fetchrow($result))
	{
		$attach_config[$row['config_name']] = trim($row['config_value']);
	}

	$attach_config['board_lang'] = trim($board_config['default_lang']);

	return $attach_config;
}

//
// Get Attachment Config
//
$cache_dir = $phpbb_root_path . '/cache';
$cache_file = $cache_dir . '/attach_config.php';
$attach_config = array();

if (file_exists($cache_dir) && is_dir($cache_dir) && is_writable($cache_dir))
{
	if (file_exists($cache_file))
	{
		@include_once($cache_file);
	}
	else
	{
		$attach_config = get_config();
		$fp = @fopen($cache_file, 'wt+');
		if ($fp)
		{
			@reset($attach_config);
			fwrite($fp, "<?php\n");
			while (list($key, $value) = @each($attach_config) )
			{
				fwrite($fp, '$attach_config[\'' . $key . '\'] = \'' . trim($value) . '\';' . "\n");
			}
			fwrite($fp, '?>');
			fclose($fp);
		}
	}
}
else
{
	$attach_config = get_config();
}

// Please do not change the include-order, it is valuable for proper execution.
// Functions for displaying Attachment Things
@include_once($phpbb_root_path . 'attach_mod/displaying.'.$phpEx);
// Posting Attachments Class (HAVE TO BE BEFORE PM)
@include_once($phpbb_root_path . 'attach_mod/posting_attachments.'.$phpEx);
// PM Attachments Class
@include_once($phpbb_root_path . 'attach_mod/pm_attachments.'.$phpEx);

if (!intval($attach_config['allow_ftp_upload']))
{
	$upload_dir = $attach_config['upload_dir'];
}
else
{
	$upload_dir = $attach_config['download_path'];
}

?>
