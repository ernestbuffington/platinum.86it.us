<?php

/*
+=============================================================================+
|                                                                             |
|  Site Navigator for PHP-Nuke                                                |
|  Copyright (c) 2004 Devaz Network, All Rights Reserved                      |
|  http://devaz.uni.cc                                                        |
|                                                                             |
|  Core Script                                                                |
|  Creation date    : August 10th, 2004                                       |
|  Last revised     : -                                                       |
|  Revision history : -                                                       |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com or     |
|  http://tc-net.info (but download at http://montecitogaming.com             |
|                                                                             |
+-----------------------------------------------------------------------------+
|                                                                             |
|  This program is free software; you can redistribute it and/or modify it    |
|  under the terms of the GNU General Public License as published by the      |
|  Free Software Foundation; either version 2 of the License, or (at your     |
|  option) any later version. (http://www.gnu.org/copyleft/gpl.html)          |
|                                                                             |
|  This program is distributed in the hope that it will be useful, but        |
|  WITHOUT ANY WARRANTY; without even the implied warranty of                 |
|  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General   |
|  Public License for more details.                                           |
|                                                                             |
|  You should have received a copy of the GNU General Public License along    |
|  with this program; if not, write to the Free Software Foundation, Inc.,    |
|  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                    |
|                                                                             |
|  You run this program at your sole risk. Author cannot be held liable of    |
|  uses and misuses of this program. It advised to test this program under    |
|  a development environment. Be sure to make any backups before implement    |
|  and running this program within a production environment.                  |
|                                                                             |
|  Installing and running this program also means you agree to the terms of   |
|  usages and conditions to this program. All codes that released here are    |
|  considered as sample code only. It may be fully functional, but you use    |
|  at your own risk. No warranty is given or implied. All original header     |
|  code and copyright messages will be maintained to give credit where        |
|  credit is due. If you modify this program, the only requirement is that    |
|  you also maintain all original copyright messages.                         |
|                                                                             |
+=============================================================================+
*/

global $_SERVER, $_GET, $_POST, $_COOKIE;

define('SNAVI_VERSION', '1.0 rc3');
define('SNAVI_PLATFORM', 'PlatinumNuke');

if (file_exists('includes/snavi/snavi_config.php'))
{
	require('includes/snavi/snavi_config.php');
}else{
	die('<h2>Site Navigator Fatal Error</h2><br><div><i>Configuration file, <strong> snavi_config.php</strong> is missing.</i></div>');
}

if ($display_bar == '1'){
if (defined('SNAVI_IS_ACTIVE'))
{

require_once('includes/snavi/snavi_bar.inc.php');

$snavi_lang_user = (isset($_COOKIE['lang']) && preg_match('/^[a-z0-9_-]+$/i', $_COOKIE['lang'])) ? strtolower($_COOKIE['lang']) : 'english';
$snavi_lang_file = 'lang-english.php';
$snavi_menu_file = 'layout-english.txt';

if (file_exists('includes/snavi/languages/lang-' . $snavi_lang_user . '.php') && file_exists('includes/snavi/layouts/layout-' . $snavi_lang_user . '.txt'))
{
	$snavi_lang_file = 'lang-' . $snavi_lang_user . '.php';
	$snavi_menu_file = 'layout-' . $snavi_lang_user . '.txt';
  
  $snavi_network_file ='networklinks.txt';
}

if (file_exists('includes/snavi/languages/' . $snavi_lang_file))
{
	global $snavi_lang, $snavi_image;
	$snavi_lang  = array();
	$snavi_image = array();

	include_once('includes/snavi/languages/' . $snavi_lang_file);
}
else
{
	die('<h2>Site Navigator Fatal Error</h2><br><div><i>Language file, <strong>' . $snavi_lang_file . '</strong> is missing.</i></div>');
}


global $snavi_layout_buffer, $snavi_network_buffer;

$snavi_layout_buffer = '';
$snavi_network_buffer = '';

if (file_exists('includes/snavi/layouts/' . $snavi_menu_file))
{
	if ($snavi_layout_handle = fopen('includes/snavi/layouts/' . $snavi_menu_file, 'r'))
	{
		$snavi_layout_buffer = fread($snavi_layout_handle, filesize('includes/snavi/layouts/' . $snavi_menu_file));
		fclose($snavi_layout_handle);
		unset($snavi_layout_handle);
	}
}
else
{
	die('<h2>Site Navigator Fatal Error</h2><br><div><i>Menu layout file, <strong>' . $snavi_menu_file . '</strong> is missing.</i></div>');
}

if (file_exists('includes/snavi/layouts/' . $snavi_network_file))
{

	if ($snavi_network_handle = fopen('includes/snavi/layouts/' . $snavi_network_file, 'r'))

	{

		$snavi_network_buffer = fread($snavi_network_handle, filesize('includes/snavi/layouts/' . $snavi_network_file));
		fclose($snavi_network_handle);
		unset($snavi_network_handle);
	}
}
else
{

	die('<h2>Site Navigator Fatal Error</h2><br><div><i>Menu layout file, <strong>' . $snavi_network_file . '</strong> is missing.</i></div>');
}

global $snavi_portal_index, $snavi_portal_module, $snavi_portal_admin;
$snavi_portal_index    = 'index.php';
$snavi_portal_module   = 'modules.php';
$snavi_portal_admin    = 'admin.php';

global $prefix, $user_prefix, $db, $sitekey, $gfx_chk, $admin, $user, $anonymous, $theme_name;

if (!isset($anonymous) || ($anonymous == '')) $anonymous = 'Anonymous';

/*
 * admin authentification
 */

if ($display_admin =='1'){
global $snavi_admin_aut;
$snavi_admin_aut = false;
$snavi_admin_aid = '';

if (isset($admin) && !empty($admin) && is_admin($admin))
{
	if(!is_array($admin))
	{
		$snavi_array_admin = explode(":", base64_decode($admin));
		$snavi_admin_aid   = "$snavi_array_admin[0]";
		$snavi_admin_pwd   = "$snavi_array_admin[1]";
	}
	else
	{
		$snavi_admin_aid = "$admin[0]";
		$snavi_admin_pwd = "$admin[1]";
	}

	$snavi_admin_aut = (preg_match('/^[a-zA-Z0-9_-]+$/', $snavi_admin_aid) && preg_match('/^[a-fA-F0-9]{32}$/', $snavi_admin_pwd)) ? true : false;
	$snavi_admin_aid = ($snavi_admin_aut) ? $snavi_admin_aid : '';

	unset($snavi_array_admin);
	unset($snavi_admin_pwd);
	}
}

/*
 * user authentification
 */

global $snavi_user_aut;
$snavi_user_aut = false;
$snavi_user_uid = '1';
$snavi_user_nic = $anonymous;

if (isset($user) && !empty($user) && is_user($user))
{
	if(!is_array($user))
	{
		$snavi_array_user = explode(":", base64_decode($user));
		$snavi_user_uid   = "$snavi_array_user[0]";
		$snavi_user_nic   = "$snavi_array_user[1]";
		$snavi_user_pwd   = "$snavi_array_user[2]";
	}
	else
	{
		$snavi_user_uid = "$user[0]";
		$snavi_user_nic = "$user[1]";
		$snavi_user_pwd = "$user[2]";
	}

	$snavi_user_aut = (preg_match('/^[a-zA-Z0-9_-]+$/', $snavi_user_nic) && preg_match('/^[a-fA-F0-9]{32}$/', $snavi_user_pwd)) ? true : false;
	$snavi_user_uid = ($snavi_user_aut) ? $snavi_user_uid : '1';
	$snavi_user_nic = ($snavi_user_aut) ? $snavi_user_nic : $anonymous;

	unset($snavi_array_user);
	unset($snavi_user_pwd);
}

/*
 * theme authentification
 */

if (!isset($theme_name) || !preg_match('/^[a-zA-Z0-9_-]+$/', $theme_name))
{
	if (function_exists('get_theme'))
	{
		$theme_name = get_theme();
	}
	else
	{
		$theme_name = '';
	}
}

global $snavi_root, $snavi_ppic;
$snavi_root = ($theme_name != '') ? 'themes/'.$theme_name : 'snavi';
$snavi_ppic = ($theme_name != '' && is_dir('themes/'.$theme_name.'/images/snavi')) ? 'themes/'.$theme_name.'/images/snavi' : 'includes/snavi/images';

/*
 * build module info
 */

global $snavi_mod;
$snavi_mod = array();

$result = $db->sql_query("SELECT title, custom_title, view, inmenu, active FROM ".$prefix."_modules ORDER BY custom_title ASC");
if ($result)
{
	while ($row = $db->sql_fetchrow($result))
	{
		$snavi_modname = $row['title'];
		$snavi_mod[$snavi_modname]['modname']  = $snavi_modname;
		$snavi_mod[$snavi_modname]['realname'] = ucwords(strtolower(str_replace('_', ' ', $snavi_modname)));
		$snavi_mod[$snavi_modname]['title']    = $row['custom_title'];
		$snavi_mod[$snavi_modname]['viewmode'] = $row['view'];
		$snavi_mod[$snavi_modname]['showing']  = $row['inmenu'];
		$snavi_mod[$snavi_modname]['active']   = $row['active'];
	}
	$db->sql_freeresult($result);
}

/*
 * build menu items for "home"
 */

$snavi_menu_home = '';

if (count($snavi_mod) > 0)
{
	if (strlen($snavi_layout_buffer) > 0)
	{
		$snavi_layout_home_module_cat  = snavi_fetch_buffer($snavi_layout_buffer, 'home_module_cat');
		$snavi_layout_home_module_item = snavi_fetch_buffer($snavi_layout_buffer, 'home_module_item');
		$snavi_layout_home_custom_cat  = snavi_fetch_buffer($snavi_layout_buffer, 'home_custom_cat');
		$snavi_layout_home_custom_item = snavi_fetch_buffer($snavi_layout_buffer, 'home_custom_item');
	}
	else
	{
		$snavi_layout_home_module_cat  = array();
		$snavi_layout_home_module_item = array();
		$snavi_layout_home_custom_cat  = array();
		$snavi_layout_home_custom_item = array();
	}

	$snavi_menu_home_cat            = array();
	$snavi_menu_home_customcat      = array();

	$snavi_menu_home_root_cat       = array();
	$snavi_menu_home_root_customcat = array();

	$snavi_menu_home_listed         = array();
	$snavi_menu_home_inactive       = array();
	$snavi_menu_home_unlisted       = array();

	if (count($snavi_layout_home_module_item) > 0)
	{
		if (count($snavi_layout_home_module_cat) > 0)
		{
			reset($snavi_layout_home_module_cat);
			foreach($snavi_layout_home_module_cat as $snavi_catmenu)
			{
				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));
				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);

				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))
				{
					$snavi_menu_home_cat[$snavi_catid]['menu'] = $snavi_catmenu;
					$snavi_menu_home_cat[$snavi_catid]['item'] = array();
				}
			}
		}

		reset($snavi_layout_home_module_item);
		foreach($snavi_layout_home_module_item as $snavi_itemmenu)
		{
			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));
			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);
			$snavi_modname  = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));

			if (preg_match('/^(null|#[a-z]#)$/i', $snavi_modname)) $snavi_modname = '';

			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))
			{
				if (isset($snavi_menu_home_cat[$snavi_category]))
				{
					$snavi_menu_home_cat[$snavi_category]['item'][] = $snavi_itemmenu;
					if (strlen($snavi_modname) > 0) $snavi_menu_home_listed[$snavi_modname] = true;
				}
				else
				{
					if (strlen($snavi_modname) > 0) $snavi_menu_home_unlisted[$snavi_modname] = $snavi_itemmenu;
				}
			}
			else
			{
				$snavi_menu_home_root_cat[] = $snavi_itemmenu;
			}
		}
	}
	else
	{
		reset($snavi_mod);
		foreach($snavi_mod as $snavi_modname => $snavi_modinfo)
		{
			$snavi_enable = false;

			if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))
			{
				if ($snavi_admin_aut)
				{
					$snavi_enable = true;
				}
				else if ($snavi_user_aut && ($snavi_modinfo['viewmode'] < 2))
				{
					$snavi_enable = true;
				}
				else if ($snavi_modinfo['viewmode'] < 1)
				{
					$snavi_enable = true;
				}
			}

			if ($snavi_enable)
			$snavi_menu_home_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";
		}
	}

	reset($snavi_mod);
	foreach($snavi_mod as $snavi_modname => $snavi_modinfo)
	{
		if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))
		{
			if (!isset($snavi_menu_home_listed[$snavi_modname]))
			{
				$snavi_menu_home_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";
			}
		}
		else if ($snavi_admin_aut)
		{
			$snavi_menu_home_inactive[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_inactive]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";
		}
	}
	unset($snavi_menu_home_listed);

	if (count($snavi_layout_home_custom_item) > 0)
	{
		if (count($snavi_layout_home_custom_cat) > 0)
		{
			reset($snavi_layout_home_custom_cat);
			foreach($snavi_layout_home_custom_cat as $snavi_catmenu)
			{
				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));
				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);

				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))
				{
					$snavi_menu_home_customcat[$snavi_catid]['menu'] = $snavi_catmenu;
					$snavi_menu_home_customcat[$snavi_catid]['item'] = array();
				}
			}
		}

		reset($snavi_layout_home_custom_item);
		foreach($snavi_layout_home_custom_item as $snavi_itemmenu)
		{
			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));
			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);

			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))
			{
				if (isset($snavi_menu_home_customcat[$snavi_category]))
				{
					$snavi_menu_home_customcat[$snavi_category]['item'][] = $snavi_itemmenu;
				}
			}
			else
			{
				$snavi_menu_home_root_customcat[] = $snavi_itemmenu;
			}
		}
	}

	if ((count($snavi_menu_home_cat) > 0) || (count($snavi_menu_home_inactive) > 0) || (count($snavi_menu_home_unlisted) > 0))
	{
		$snavi_menu_home_top = 'null|>|null|>|#IMG=' . $snavi_image['menu_home'] . '#|>|' . $snavi_lang['home_desc'] . '|>|#INDEX#|>|null|>|null';
		$snavi_menu_home_sub = array();

		if (!empty($snavi_menu_home_cat))
		{
			reset($snavi_menu_home_cat);
			foreach($snavi_menu_home_cat as $snavi_menu_home_subcat)
			{
				if (!empty($snavi_menu_home_subcat['item']))
				{
					$snavi_menu_home_sub[] = $snavi_menu_home_subcat;
				}
			}
		}
		unset($snavi_menu_home_cat);

		if (!empty($snavi_menu_home_unlisted))
		{
			ksort($snavi_menu_home_unlisted);
			$snavi_menu_home_sub[] = array(
				'menu' => "null|>|$snavi_image[icon_unlisted]|>|$snavi_lang[other_mods]|>|null|>|null|>|null|>|null",
				'item' => $snavi_menu_home_unlisted
			);
		}
		unset($snavi_menu_home_unlisted);

		if (!empty($snavi_menu_home_inactive))
		{
			ksort($snavi_menu_home_inactive);
			$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';
			$snavi_menu_home_sub[] = array(
				'menu' => "#isadmin#|>|$snavi_image[icon_inactive]|>|$snavi_lang[inactive_mods]|>|null|>|null|>|null|>|null",
				'item' => $snavi_menu_home_inactive
			);
		}
		unset($snavi_menu_home_inactive);

		if (!empty($snavi_menu_home_customcat))
		{
			$snavi_menu_home_customsubcat = array();

			reset($snavi_menu_home_customcat);
			foreach($snavi_menu_home_customcat as $snavi_menu_home_subcat)
			{
				if (!empty($snavi_menu_home_subcat['item']))
				{
					$snavi_menu_home_customsubcat[] = $snavi_menu_home_subcat;
				}
			}

			if (!empty($snavi_menu_home_customsubcat))
			{
				$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';

				reset($snavi_menu_home_customsubcat);
				foreach($snavi_menu_home_customsubcat as $snavi_menu_home_subcat)
				{
					$snavi_menu_home_sub[] = $snavi_menu_home_subcat;
				}
			}
			unset($snavi_menu_home_customsubcat);
		}
		unset($snavi_menu_home_customcat);

		if (!empty($snavi_menu_home_root_cat))
		{
			$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';
			reset($snavi_menu_home_root_cat);
			foreach($snavi_menu_home_root_cat as $snavi_menu_home_root_subcat)
			{
				$snavi_menu_home_sub[] = $snavi_menu_home_root_subcat;
			}
		}
		unset($snavi_menu_home_root_cat);

		if (!empty($snavi_menu_home_root_customcat))
		{
			$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';
			reset($snavi_menu_home_root_customcat);
			foreach($snavi_menu_home_root_customcat as $snavi_menu_home_root_subcat)
			{
				$snavi_menu_home_sub[] = $snavi_menu_home_root_subcat;
			}
		}
		unset($snavi_menu_home_root_customcat);

		$snavi_menu_home_sub[] = "null|>|null|>|-|>|Separator|>|null|>|null|>|null";
		$snavi_menu_home_sub[] = "null|>|$snavi_image[menu_home_about]|>|$snavi_lang[about]|>|$snavi_lang[about_desc]|>|snavi/snavi.php?snavi_op=about|>|snabout|>|null";

		$snavi_menu_home = snavi_generate_menu($snavi_menu_home_top, $snavi_menu_home_sub);

		unset($snavi_menu_home_top);
		unset($snavi_menu_home_sub);
	}

	unset($snavi_layout_home_module_cat);
	unset($snavi_layout_home_module_item);

	unset($snavi_layout_home_custom_cat);
	unset($snavi_layout_home_custom_item);

}


/*

 * build menu items for "Network"

 */
$snavi_menu_network = '';



if (count($snavi_mod) > 0)

{

	if (strlen($snavi_network_buffer) > 0)

	{

		$snavi_layout_network_module_cat  = snavi_fetch_buffer($snavi_network_buffer, 'network_module_cat');

		$snavi_layout_network_module_item = snavi_fetch_buffer($snavi_network_buffer, 'network_module_item');

		$snavi_layout_network_custom_cat  = snavi_fetch_buffer($snavi_network_buffer, 'network_custom_cat');

		$snavi_layout_network_custom_item = snavi_fetch_buffer($snavi_network_buffer, 'network_custom_item');

	}

	else

	{

		$snavi_layout_network_module_cat  = array();

		$snavi_layout_network_module_item = array();

		$snavi_layout_network_custom_cat  = array();

		$snavi_layout_network_custom_item = array();

	}



	$snavi_menu_network_cat            = array();

	$snavi_menu_network_customcat      = array();



	$snavi_menu_network_root_cat       = array();

	$snavi_menu_network_root_customcat = array();



	$snavi_menu_network_listed         = array();

	$snavi_menu_network_inactive       = array();

	$snavi_menu_network_unlisted       = array();



	if (count($snavi_layout_network_module_item) > 0)

	{

		if (count($snavi_layout_network_module_cat) > 0)

		{

			reset($snavi_layout_network_module_cat);

			foreach($snavi_layout_network_module_cat as $snavi_catmenu)

			{

				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));

				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);



				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))

				{

					$snavi_menu_network_cat[$snavi_catid]['menu'] = $snavi_catmenu;

					$snavi_menu_network_cat[$snavi_catid]['item'] = array();

				}

			}

		}



		reset($snavi_layout_network_module_item);

		foreach($snavi_layout_network_module_item as $snavi_itemmenu)

		{

			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));

			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);

			$snavi_modname  = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));



			if (preg_match('/^(null|#[a-z]#)$/i', $snavi_modname)) $snavi_modname = '';



			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))

			{

				if (isset($snavi_menu_network_cat[$snavi_category]))

				{

					$snavi_menu_network_cat[$snavi_category]['item'][] = $snavi_itemmenu;

					if (strlen($snavi_modname) > 0) $snavi_menu_network_listed[$snavi_modname] = true;

				}

				else

				{

					if (strlen($snavi_modname) > 0) $snavi_menu_network_unlisted[$snavi_modname] = $snavi_itemmenu;

				}

			}

			else

			{

				$snavi_menu_home_root_cat[] = $snavi_itemmenu;

			}

		}

	}

	else

	{

		reset($snavi_mod);

		foreach($snavi_mod as $snavi_modname => $snavi_modinfo)

		{

			$snavi_enable = false;



			if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))

			{

				if ($snavi_admin_aut)

				{

					$snavi_enable = true;

				}

				else if ($snavi_user_aut && ($snavi_modinfo['viewmode'] < 2))

				{

					$snavi_enable = true;

				}

				else if ($snavi_modinfo['viewmode'] < 1)

				{

					$snavi_enable = true;

				}

			}



			if ($snavi_enable)

			$snavi_menu_network_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

		}

	}



	reset($snavi_mod);

	foreach($snavi_mod as $snavi_modname => $snavi_modinfo)

	{

		if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))

		{

			if (!isset($snavi_menu_network_listed[$snavi_modname]))

			{

				$snavi_menu_network_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

			}

		}

		else if ($snavi_admin_aut)

		{

			$snavi_menu_network_inactive[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_inactive]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

		}

	}

	unset($snavi_menu_network_listed);



	if (count($snavi_layout_network_custom_item) > 0)

	{

		if (count($snavi_layout_network_custom_cat) > 0)

		{

			reset($snavi_layout_home_custom_cat);

			foreach($snavi_layout_home_custom_cat as $snavi_catmenu)

			{

				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));

				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);



				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))

				{

					$snavi_menu_network_customcat[$snavi_catid]['menu'] = $snavi_catmenu;

					$snavi_menu_network_customcat[$snavi_catid]['item'] = array();

				}

			}

		}



		reset($snavi_layout_network_custom_item);

		foreach($snavi_layout_network_custom_item as $snavi_itemmenu)

		{

			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));

			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);



			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))

			{

				if (isset($snavi_menu_network_customcat[$snavi_category]))

				{

					$snavi_menu_network_customcat[$snavi_category]['item'][] = $snavi_itemmenu;

				}

			}

			else

			{

				$snavi_menu_network_root_customcat[] = $snavi_itemmenu;

			}

		}

	}



	if ((count($snavi_menu_network_cat) > 0) || (count($snavi_menu_network_inactive) > 0) || (count($snavi_menu_network_unlisted) > 0))

	{

    $snavi_menu_network_top = 'null|>|null|>|#IMG=' . $snavi_image['menu_network'] . '#|>|' . $snavi_lang['network_desc'] . '|>|#INDEX#|>|null|>|null';

		$snavi_menu_network_sub = array();



		if (!empty($snavi_menu_network_cat))

		{

			reset($snavi_menu_network_cat);

			foreach($snavi_menu_network_cat as $snavi_menu_network_subcat)

			{

				if (!empty($snavi_menu_network_subcat['item']))

				{

					$snavi_menu_network_sub[] = $snavi_menu_network_subcat;

				}

			}

		}

		unset($snavi_menu_network_cat);



		if (!empty($snavi_menu_network_customcat))

		{

			$snavi_menu_network_customsubcat = array();



			reset($snavi_menu_network_customcat);

			foreach($snavi_menu_network_customcat as $snavi_menu_home_subcat)

			{

				if (!empty($snavi_menu_network_subcat['item']))

				{

					$snavi_menu_network_customsubcat[] = $snavi_menu_home_subcat;

				}

			}



			if (!empty($snavi_menu_network_customsubcat))

			{

				$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';



				reset($snavi_menu_network_customsubcat);

				foreach($snavi_menu_network_customsubcat as $snavi_menu_home_subcat)

				{

					$snavi_menu_home_sub[] = $snavi_menu_home_subcat;

				}

			}

			unset($snavi_menu_network_customsubcat);

		}

		unset($snavi_menu_network_customcat);



		if (!empty($snavi_menu_network_root_cat))

		{

			$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';

			reset($snavi_menu_network_root_cat);

			foreach($snavi_menu_network_root_cat as $snavi_menu_network_root_subcat)

			{

				$snavi_menu_network_sub[] = $snavi_menu_network_root_subcat;

			}

		}

		unset($snavi_menu_network_root_cat);



		if (!empty($snavi_menu_network_root_customcat))

		{

			$snavi_menu_network_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';

			reset($snavi_menu_network_root_customcat);

			foreach($snavi_menu_network_root_customcat as $snavi_menu_network_root_subcat)

			{

				$snavi_menu_network_sub[] = $snavi_menu_network_root_subcat;

			}

		}

		unset($snavi_menu_network_root_customcat);



/*		$snavi_menu_network_sub[] = "null|>|null|>|-|>|Separator|>|null|>|null|>|null";
		$snavi_menu_network_sub[] = "null|>|$snavi_image[menu_network_about]|>|$snavi_lang[join]|>|$snavi_lang[join_desc]|>|http://www.evolution-xtreme.com|>|_blank|>|null";*/



		$snavi_menu_network = snavi_generate_menu($snavi_menu_network_top, $snavi_menu_network_sub);



		unset($snavi_menu_network_top);

		unset($snavi_menu_network_sub);

	}



	unset($snavi_layout_network_module_cat);

	unset($snavi_layout_network_module_item);



	unset($snavi_layout_network_custom_cat);

	unset($snavi_layout_network_custom_item);

}


/*

 * build menu items for "Clans"

 */
$snavi_menu_clan = '';



if (count($snavi_mod) > 0)

{

	if (strlen($snavi_network_buffer) > 0)

	{

		$snavi_layout_clan_module_cat  = snavi_fetch_buffer($snavi_network_buffer, 'clan_module_cat');

		$snavi_layout_clan_module_item = snavi_fetch_buffer($snavi_network_buffer, 'clan_module_item');

		$snavi_layout_clan_custom_cat  = snavi_fetch_buffer($snavi_network_buffer, 'clan_custom_cat');

		$snavi_layout_clan_custom_item = snavi_fetch_buffer($snavi_network_buffer, 'clan_custom_item');

	}

	else

	{

		$snavi_layout_clan_module_cat  = array();

		$snavi_layout_clan_module_item = array();

		$snavi_layout_clan_custom_cat  = array();

		$snavi_layout_clan_custom_item = array();

	}



	$snavi_menu_clan_cat            = array();

	$snavi_menu_clan_customcat      = array();



	$snavi_menu_clan_root_cat       = array();

	$snavi_menu_clan_root_customcat = array();



	$snavi_menu_clan_listed         = array();

	$snavi_menu_clan_inactive       = array();

	$snavi_menu_clan_unlisted       = array();



	if (count($snavi_layout_clan_module_item) > 0)

	{

		if (count($snavi_layout_clan_module_cat) > 0)

		{

			reset($snavi_layout_clan_module_cat);

			foreach($snavi_layout_clan_module_cat as $snavi_catmenu)

			{

				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));

				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);



				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))

				{

					$snavi_menu_clan_cat[$snavi_catid]['menu'] = $snavi_catmenu;

					$snavi_menu_clan_cat[$snavi_catid]['item'] = array();

				}

			}

		}



		reset($snavi_layout_clan_module_item);

		foreach($snavi_layout_clan_module_item as $snavi_itemmenu)

		{

			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));

			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);

			$snavi_modname  = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));



			if (preg_match('/^(null|#[a-z]#)$/i', $snavi_modname)) $snavi_modname = '';



			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))

			{

				if (isset($snavi_menu_clan_cat[$snavi_category]))

				{

					$snavi_menu_clan_cat[$snavi_category]['item'][] = $snavi_itemmenu;

					if (strlen($snavi_modname) > 0) $snavi_menu_clan_listed[$snavi_modname] = true;

				}

				else

				{

					if (strlen($snavi_modname) > 0) $snavi_menu_clan_unlisted[$snavi_modname] = $snavi_itemmenu;

				}

			}

			else

			{

				$snavi_menu_clan_root_cat[] = $snavi_itemmenu;

			}

		}

	}

	else

	{

		reset($snavi_mod);

		foreach($snavi_mod as $snavi_modname => $snavi_modinfo)

		{

			$snavi_enable = false;



			if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))

			{

				if ($snavi_admin_aut)

				{

					$snavi_enable = true;

				}

				else if ($snavi_user_aut && ($snavi_modinfo['viewmode'] < 2))

				{

					$snavi_enable = true;

				}

				else if ($snavi_modinfo['viewmode'] < 1)

				{

					$snavi_enable = true;

				}

			}



			if ($snavi_enable)

			$snavi_menu_clan_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

		}

	}



	reset($snavi_mod);

	foreach($snavi_mod as $snavi_modname => $snavi_modinfo)

	{

		if (($snavi_modinfo['showing'] != 0) && ($snavi_modinfo['active'] != 0))

		{

			if (!isset($snavi_menu_clan_listed[$snavi_modname]))

			{

				$snavi_menu_clan_unlisted[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_unlisted]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

			}

		}

		else if ($snavi_admin_aut)

		{

			$snavi_menu_clan_inactive[$snavi_modname] = "$snavi_modname|>|$snavi_image[icon_inactive]|>|$snavi_modinfo[title]|>|$snavi_modinfo[title]|>|#MODULE#?name=$snavi_modname|>|null|>|null";

		}

	}

	unset($snavi_menu_clan_listed);



	if (count($snavi_layout_clan_custom_item) > 0)

	{

		if (count($snavi_layout_clan_custom_cat) > 0)

		{

			reset($snavi_layout_clancustom_cat);

			foreach($snavi_layout_clan_custom_cat as $snavi_catmenu)

			{

				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));

				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);



				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))

				{

					$snavi_menu_clan_customcat[$snavi_catid]['menu'] = $snavi_catmenu;

					$snavi_menu_clan_customcat[$snavi_catid]['item'] = array();

				}

			}

		}



		reset($snavi_layout_clan_custom_item);

		foreach($snavi_layout_clan_custom_item as $snavi_itemmenu)

		{

			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));

			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);



			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))

			{

				if (isset($snavi_menu_clan_customcat[$snavi_category]))

				{

					$snavi_menu_clan_customcat[$snavi_category]['item'][] = $snavi_itemmenu;

				}

			}

			else

			{

				$snavi_menu_clan_root_customcat[] = $snavi_itemmenu;

			}

		}

	}



	if ((count($snavi_menu_clan_cat) > 0) || (count($snavi_menu_clan_inactive) > 0) || (count($snavi_menu_clan_unlisted) > 0))

	{

    $snavi_menu_clan_top = 'null|>|null|>|#IMG=' . $snavi_image['menu_clan'] . '#|>|' . $snavi_lang['clan_desc'] . '|>|#INDEX#|>|null|>|null';

		$snavi_menu_clan_sub = array();



		if (!empty($snavi_menu_clan_cat))

		{

			reset($snavi_menu_clan_cat);

			foreach($snavi_menu_clan_cat as $snavi_menu_clan_subcat)

			{

				if (!empty($snavi_menu_clan_subcat['item']))

				{

					$snavi_menu_clan_sub[] = $snavi_menu_clan_subcat;

				}

			}

		}

		unset($snavi_menu_clan_cat);



		if (!empty($snavi_menu_clan_customcat))

		{

			$snavi_menu_clan_customsubcat = array();



			reset($snavi_menu_clan_customcat);

			foreach($snavi_menu_clan_customcat as $snavi_menu_clan_subcat)

			{

				if (!empty($snavi_menu_clan_subcat['item']))

				{

					$snavi_menu_clan_customsubcat[] = $snavi_menu_clan_subcat;

				}

			}



			if (!empty($snavi_menu_clan_customsubcat))

			{

				$snavi_menu_clan_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';



				reset($snavi_menu_clan_customsubcat);

				foreach($snavi_menu_clan_customsubcat as $snavi_menu_clan_subcat)

				{

					$snavi_menu_clan_sub[] = $snavi_menu_clan_subcat;

				}

			}

			unset($snavi_menu_clan_customsubcat);

		}

		unset($snavi_menu_clan_customcat);



		if (!empty($snavi_menu_clan_root_cat))

		{

			$snavi_menu_clan_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';

			reset($snavi_menu_clan_root_cat);

			foreach($snavi_menu_clan_root_cat as $snavi_menu_clan_root_subcat)

			{

				$snavi_menu_clan_sub[] = $snavi_menu_clan_root_subcat;

			}

		}

		unset($snavi_menu_clan_root_cat);



		if (!empty($snavi_menu_clan_root_customcat))

		{

			$snavi_menu_clan_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';

			reset($snavi_menu_clan_root_customcat);

			foreach($snavi_menu_clan_root_customcat as $snavi_menu_clan_root_subcat)

			{

				$snavi_menu_clan_sub[] = $snavi_menu_clan_root_subcat;

			}

		}

		unset($snavi_menu_clan_root_customcat);

/*		$snavi_menu_clan_sub[] = "null|>|null|>|-|>|Separator|>|null|>|null|>|null";
		$snavi_menu_clan_sub[] = "null|>|$snavi_image[menu_join_clan]|>|$snavi_lang[joinclan]|>|$snavi_lang[joinclan_desc]|>|http://evolutionclans.com/modules.php?name=Member_Application&appno=1|>|_blank|>|null";
        $snavi_menu_clan_sub[] = "null|>|$snavi_image[menu_report_clan]|>|Report Clan|>|$snavi_lang[joinclan_desc]|>|http://evolutionclans.com/modules.php?name=Member_Application&appno=1|>|_blank|>|null";*/

		$snavi_menu_clan = snavi_generate_menu($snavi_menu_clan_top, $snavi_menu_clan_sub);

		unset($snavi_menu_clan_top);
		unset($snavi_menu_clan_sub);
	}

		unset($snavi_layout_clan_module_cat);
		unset($snavi_layout_clan_module_item);
		unset($snavi_layout_clan_custom_cat);
		unset($snavi_layout_clan_custom_item);

}

/*
 * build menu items for "admin"
 */

$snavi_menu_admin = '';

if ($snavi_admin_aut)
{
	if (strlen($snavi_layout_buffer) > 0)
	{
		$snavi_layout_admin_cat  = snavi_fetch_buffer($snavi_layout_buffer, 'admin_cat');
		$snavi_layout_admin_item = snavi_fetch_buffer($snavi_layout_buffer, 'admin_item');
	}
	else
	{
		$snavi_layout_admin_cat  = array();
		$snavi_layout_admin_item = array();
	}

	if (count($snavi_layout_admin_item) > 0)
	{
		$result = $db->sql_query("SELECT * FROM ".$prefix."_authors WHERE aid='$snavi_admin_aid'");
		if ($result)
		{
			$snavi_admin_rights = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		}
		else
		{
			$snavi_admin_rights = array();
		}

		$snavi_menu_admin_cat      = array();
		$snavi_menu_admin_root_cat = array();

		if (count($snavi_layout_admin_cat) > 0)
		{
			reset($snavi_layout_admin_cat);
			foreach($snavi_layout_admin_cat as $snavi_catmenu)
			{
				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));
				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);

				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))
				{
					$snavi_menu_admin_cat[$snavi_catid]['menu'] = $snavi_catmenu;
					$snavi_menu_admin_cat[$snavi_catid]['item'] = array();
				}
			}
		}

		reset($snavi_layout_admin_item);
		foreach($snavi_layout_admin_item as $snavi_itemmenu)
		{
			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));
			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);

			$snavi_modname  = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));
			$snavi_modname  = ((strlen($snavi_modname) > 0) && ($snavi_modname != 'null')) ? $snavi_modname . ',radminsuper' : 'radminsuper';

			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);
			$snavi_itemmenu = 'null|>|' . $snavi_itemmenu;

			$snavi_enable   = false;
			$snavi_modname  = explode(',', $snavi_modname);

			if (count($snavi_modname) > 0)
			{
				reset($snavi_modname);
				foreach($snavi_modname as $snavi_modlevel)
				{
					$snavi_modlevel = trim($snavi_modlevel);
					if (!preg_match('/^radmin[a-z]+$/', $snavi_modlevel)) continue;
					if (!isset($snavi_admin_rights[$snavi_modlevel])) continue;
					if (intval($snavi_admin_rights[$snavi_modlevel]) != 1) continue;

					$snavi_enable = true;
					break;
				}
			}

			if ($snavi_enable)
			{
				if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))
				{
					if (isset($snavi_menu_admin_cat[$snavi_category]))
					{
						$snavi_menu_admin_cat[$snavi_category]['item'][] = $snavi_itemmenu;
					}
				}
				else
				{
					$snavi_menu_admin_root_cat[] = $snavi_itemmenu;
				}
			}
		}

		if ((count($snavi_menu_admin_cat) > 0) || (count($snavi_menu_admin_root_cat) > 0))
		{
			$snavi_menu_admin_top = 'null|>|null|>|#IMG=' . $snavi_image['menu_admin'] . '#|>|' . $snavi_lang['admin_desc'] . '|>|#ADMIN#|>|null|>|null';
			$snavi_menu_admin_sub = array();

			if (!empty($snavi_menu_admin_cat))
			{
				reset($snavi_menu_admin_cat);
				foreach($snavi_menu_admin_cat as $snavi_menu_admin_subcat)
				{
					if (!empty($snavi_menu_admin_subcat['item']))
					{
						$snavi_menu_admin_sub[] = $snavi_menu_admin_subcat;
					}
				}
			}
			unset($snavi_menu_admin_cat);

			if (!empty($snavi_menu_admin_root_cat))
			{
				if (!empty($snavi_menu_admin_cat))
				{
					$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';
				}

				reset($snavi_menu_admin_root_cat);
				foreach($snavi_menu_admin_root_cat as $snavi_menu_admin_root_subcat)
				{
					$snavi_menu_admin_sub[] = $snavi_menu_admin_root_subcat;
				}
			}
			unset($snavi_menu_admin_root_cat);

			$snavi_menu_admin = snavi_generate_menu($snavi_menu_admin_top, $snavi_menu_admin_sub);

			unset($snavi_menu_admin_top);
			unset($snavi_menu_admin_sub);
		}

		unset($snavi_admin_rights);
	}

	unset($snavi_layout_admin_cat);
	unset($snavi_layout_admin_item);
}

/*
 * build menu items for "account"
 */

$snavi_menu_account = '';

if ($snavi_user_aut)
{
	if (strlen($snavi_layout_buffer) > 0)
	{
		$snavi_layout_account_cat  = snavi_fetch_buffer($snavi_layout_buffer, 'account_cat');
		$snavi_layout_account_item = snavi_fetch_buffer($snavi_layout_buffer, 'account_item');
	}
	else
	if (strlen($snavi_layout_buffer) > 0)
	{
		$snavi_layout_account_cat  = array();
		$snavi_layout_account_item = array();
	}

	if (count($snavi_layout_account_item) > 0)
	{
		$snavi_menu_account_cat      = array();
		$snavi_menu_account_root_cat = array();

		if (count($snavi_layout_account_cat) > 0)
		{
			reset($snavi_layout_account_cat);
			foreach($snavi_layout_account_cat as $snavi_catmenu)
			{
				$snavi_catid   = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_catmenu));
				$snavi_catmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_catmenu);

				if ((strlen($snavi_catid) > 0) && ($snavi_catid != 'null'))
				{
					$snavi_menu_account_cat[$snavi_catid]['menu'] = $snavi_catmenu;
					$snavi_menu_account_cat[$snavi_catid]['item'] = array();
				}
			}
		}

		reset($snavi_layout_account_item);
		foreach($snavi_layout_account_item as $snavi_itemmenu)
		{
			$snavi_category = trim(preg_replace('#^([^(\|\>\|)]+)\|\>\|.*$#', '\1', $snavi_itemmenu));
			$snavi_itemmenu = preg_replace('#^[^(\|\>\|)]+\|\>\|(.+)$#', '\1', $snavi_itemmenu);

			if ((strlen($snavi_category) > 0) && ($snavi_category != 'null'))
			{
				if (isset($snavi_menu_account_cat[$snavi_category]))
				{
					$snavi_menu_account_cat[$snavi_category]['item'][] = $snavi_itemmenu;
				}
			}
			else
			{
				$snavi_menu_account_root_cat[] = $snavi_itemmenu;
			}
		}

		if ((count($snavi_menu_account_cat) > 0) || (count($snavi_menu_account_root_cat) > 0))
		{
			$snavi_menu_account_top = 'null|>|null|>|#IMG=' . $snavi_image['menu_account'] . '#|>|' . $snavi_lang['account_desc'] . '|>|#MODULE#?name=Your_Account|>|null|>|null';
			$snavi_menu_account_sub = array();

			if (!empty($snavi_menu_account_cat))
			{
				reset($snavi_menu_account_cat);
				foreach($snavi_menu_account_cat as $snavi_menu_account_subcat)
				{
					if (!empty($snavi_menu_account_subcat['item']))
					{
						$snavi_menu_account_sub[] = $snavi_menu_account_subcat;
					}
				}
			}
			unset($snavi_menu_account_cat);

			if (!empty($snavi_menu_account_root_cat))
			{
				if (!empty($snavi_menu_account_cat))
				{
					$snavi_menu_home_sub[] = 'null|>|null|>|-|>|Separator|>|null|>|null|>|null';
				}

				reset($snavi_menu_account_root_cat);
				foreach($snavi_menu_account_root_cat as $snavi_menu_account_root_subcat)
				{
					$snavi_menu_account_sub[] = $snavi_menu_account_root_subcat;
				}
			}
			unset($snavi_menu_account_root_cat);

			$snavi_menu_account = snavi_generate_menu($snavi_menu_account_top, $snavi_menu_account_sub);

			unset($snavi_menu_account_top);
			unset($snavi_menu_account_sub);
		}
	}

	unset($snavi_layout_account_cat);
	unset($snavi_layout_account_item);
}

/*
 * build menu items for "files"
 */

$snavi_menu_download = '';

if ($snavi_user_aut && isset($snavi_mod['Downloads']) && ($snavi_mod['Downloads']['active'] != 0))
{
	$snavi_download_toplevel = array();
	$result = $db->sql_query("SELECT cid, title FROM ".$prefix."_downloads_categories WHERE parentid='0' ORDER BY title ASC");
	if ($result)
	{
		while(list($snavi_download_cid, $snavi_download_title) = $db->sql_fetchrow($result))
		{
			$snavi_download_toplevel[$snavi_download_cid] = str_replace('_',' ',$snavi_download_title);
		}
		$db->sql_freeresult($result);
	}

	if (count($snavi_download_toplevel) > 0)
	{
		$snavi_download_top = "null|>|null|>|#IMG=$snavi_image[menu_file]#|>|$snavi_lang[files_desc]|>|#MODULE#?name=Downloads|>|null|>|null";
		$snavi_download_sub = array();

		reset($snavi_download_toplevel);
		foreach($snavi_download_toplevel as $snavi_download_cid => $snavi_download_title)
		{
			$snavi_download_cat_top = "null|>|$snavi_image[menu_filecat]|>|$snavi_download_title|>|" . sprintf($snavi_lang['files_sect'], $snavi_download_title) . "|>|#MODULE#?name=Downloads&cid=$snavi_download_cid|>|null|>|null";
			$snavi_download_cat_sub = array();

			$snavi_download_subitems = array();
			$result = $db->sql_query("SELECT cid, title FROM ".$prefix."_downloads_categories WHERE parentid='$snavi_download_cid' ORDER BY title ASC");

			if ($result)
			{
				while(list($snavi_download_subid, $snavi_download_subtitle) = $db->sql_fetchrow($result))
				{
					$snavi_download_subitems[$snavi_download_subid] = str_replace('_',' ', $snavi_download_subtitle);
				}
				$db->sql_freeresult($result);
			}

			if (count($snavi_download_subitems) > 0)
			{
				reset($snavi_download_subitems);
				foreach($snavi_download_subitems as $snavi_download_subid => $snavi_download_subtitle)
				{
					$snavi_download_cat_sub[] = "null|>|$snavi_image[menu_filesub]|>|$snavi_download_subtitle|>|" . sprintf($snavi_lang['files_sect'], $snavi_download_subtitle) . "|>|#MODULE#?name=Downloads&cid=$snavi_download_subid|>|null|>|null";
				}
			}

			unset($snavi_download_subitems);

			$snavi_download_sub[] = array(
				'menu' => $snavi_download_cat_top,
				'item' => $snavi_download_cat_sub
			);

			unset($snavi_download_cat_top);
			unset($snavi_download_cat_sub);
		}

		$snavi_menu_download = snavi_generate_menu($snavi_download_top, $snavi_download_sub);

		unset($snavi_download_top);
		unset($snavi_download_sub);
	}
	unset($snavi_download_toplevel);
}

/*
 * build menu items for "forums"
 */

$snavi_menu_forum = '';

if ($snavi_user_aut && isset($snavi_mod['Forums']) && ($snavi_mod['Forums']['active'] != 0))
{
	$snavi_forum_toplevel = array();
	$result = $db->sql_query("SELECT cat_id, cat_title FROM ".$prefix."_bbcategories ORDER BY cat_order ASC");
	if ($result)
	{
		while(list($snavi_forum_cid, $snavi_forum_title) = $db->sql_fetchrow($result))
		{
			$snavi_forum_toplevel[$snavi_forum_cid] = str_replace('_',' ',$snavi_forum_title);
		}
		$db->sql_freeresult($result);
	}

	if (count($snavi_forum_toplevel) > 0)
	{
		$snavi_forum_top = "null|>|null|>|#IMG=$snavi_image[menu_forum]#|>|$snavi_lang[forums_desc]|>|#MODULE#?name=Forums|>|null|>|null";
		$snavi_forum_sub = array();

		reset($snavi_forum_toplevel);
		foreach($snavi_forum_toplevel as $snavi_forum_cid => $snavi_forum_title)
		{
			$snavi_forum_cat_top = "null|>|$snavi_image[menu_forumcat]|>|$snavi_forum_title|>|" . sprintf($snavi_lang['forums_cat'], $snavi_forum_title) . "|>|#MODULE#?name=Forums&file=index&c=$snavi_forum_cid|>|null|>|null";
			$snavi_forum_cat_sub = array();

			$snavi_forum_subitems = array();
			$result = $db->sql_query("SELECT forum_id, forum_name FROM ".$prefix."_bbforums WHERE cat_id='$snavi_forum_cid' ORDER BY forum_order ASC");
			if ($result)
			{
				while(list($snavi_forum_subid, $snavi_forum_subtitle) = $db->sql_fetchrow($result))
				{
					$snavi_forum_subitems[$snavi_forum_subid] = str_replace('_',' ',$snavi_forum_subtitle);
				}
				$db->sql_freeresult($result);
			}

			if (count($snavi_forum_subitems) > 0)
			{
				reset($snavi_forum_subitems);
				foreach($snavi_forum_subitems as $snavi_forum_subid => $snavi_forum_subtitle)
				{
					$snavi_forum_cat_sub[] = "null|>|$snavi_image[menu_forumsub]|>|$snavi_forum_subtitle|>|" . sprintf($snavi_lang['forums_sect'], $snavi_forum_subtitle) . "|>|#MODULE#?name=Forums&file=viewforum&f=$snavi_forum_subid|>|null|>|null";
				}
			}

			unset($snavi_forum_subitems);

			$snavi_forum_sub[] = array(
				'menu' => $snavi_forum_cat_top,
				'item' => $snavi_forum_cat_sub
			);

			unset($snavi_forum_cat_top);
			unset($snavi_forum_cat_sub);
		}

		$snavi_menu_forum = snavi_generate_menu($snavi_forum_top, $snavi_forum_sub);

		unset($snavi_forum_top);
		unset($snavi_forum_sub);
	}
	unset($snavi_forum_toplevel);
}

/*
 * collect staffs online
 */

$snavi_online_staffs = '';

if ($snavi_user_aut)
{
	$result = $db->sql_query("SELECT u.username, u.user_id FROM ".$user_prefix."_users u, ".$prefix."_session s WHERE u.username = s.uname AND s.time >= ".( time() - 300 ) . " AND s.guest = 0 AND (u.user_rank > 0 OR u.user_level > 1) ORDER BY u.username ASC");
	if ($result)
	{

		$snavi_staffs_top = "null|>|null|>|&nbsp;&nbsp;#IMG=$snavi_image[icon_staff]#|>|$snavi_lang[staffs_desc]|>|null|>|null|>|null";
		$snavi_staffs_sub = array();
		while(list($snavi_staffs_username, $snavi_staffs_uid) = $db->sql_fetchrow($result))
		{
			$snavi_staffs_cat_top = "null|>|$snavi_image[icon_staffcat]|>|$snavi_staffs_username|>|" . sprintf($snavi_lang['staffs_info'], $snavi_staffs_username) . "|>|#MODULE#?name=Your_Account&op=userinfo&username=$snavi_staffs_username|>|null|>|null";
			$snavi_staffs_cat_sub = array();

			if ($snavi_staffs_uid != $snavi_user_uid)
			{
				$snavi_staffs_cat_sub[] = "Private_Messages|>|$snavi_image[icon_staffpm]|>|" . sprintf($snavi_lang['staffs_pm'], $snavi_staffs_username) . "|>|null|>|#MODULE#?name=Private_Messages&mode=post&u=$snavi_staffs_uid|>|null|>|null";
			}

			$snavi_online_target = ($snavi_staffs_uid == $snavi_user_uid) ? "#MODULE#?name=Forums&file=profile&mode=editprofile" : "#MODULE#?name=Forums&file=profile&mode=viewprofile&u=$snavi_staffs_uid";

			$snavi_staffs_cat_sub[] = "Forums|>|$snavi_image[icon_staffprofile]|>|" . sprintf($snavi_lang['staffs_profile'], $snavi_staffs_username) . "|>|null|>|$snavi_online_target|>|null|>|null";
			$snavi_staffs_cat_sub[] = "Forums|>|$snavi_image[icon_staffpost]|>|" . sprintf($snavi_lang['staffs_post'], $snavi_staffs_username) . "|>|null|>|#MODULE#?name=Forums&file=search&search_author=$snavi_staffs_username|>|null|>|null";

			$snavi_staffs_sub[] = array(
				'menu' => $snavi_staffs_cat_top,
				'item' => $snavi_staffs_cat_sub
			);

			unset($snavi_staffs_cat_top);
			unset($snavi_staffs_cat_sub);
		}

		$db->sql_freeresult($result);

		$snavi_online_staffs = snavi_generate_menu($snavi_staffs_top, $snavi_staffs_sub);

		unset($snavi_staffs_top);
		unset($snavi_staffs_sub);
	}
}

/*
 * collect members online
 */

$snavi_online_members = '';

if ($snavi_user_aut)
{
	$result = $db->sql_query("SELECT u.username, u.user_id FROM ".$user_prefix."_users u, ".$prefix."_session s WHERE u.username = s.uname AND s.time >= ".( time() - 300 ) . " AND s.guest = 0 AND (u.user_rank = 0 OR u.user_level = 1) ORDER BY u.username ASC");
	if ($result)
	{
		$snavi_members_top = "null|>|null|>|#IMG=$snavi_image[icon_member]#|>|$snavi_lang[members_desc]|>|null|>|null|>|null";
		$snavi_members_sub = array();

		while(list($snavi_members_username, $snavi_members_uid) = $db->sql_fetchrow($result))
		{
			$snavi_members_cat_top = "null|>|$snavi_image[icon_membercat]|>|$snavi_members_username|>|" . sprintf($snavi_lang['members_info'], $snavi_members_username) . "|>|#MODULE#?name=Your_Account&op=userinfo&username=$snavi_members_username|>|null|>|null";
			$snavi_members_cat_sub = array();

			if ($snavi_members_uid != $snavi_user_uid)
			{
				$snavi_members_cat_sub[] = "Private_Messages|>|$snavi_image[icon_memberpm]|>|" . sprintf($snavi_lang['members_pm'], $snavi_members_username) . "|>|null|>|#MODULE#?name=Private_Messages&mode=post&u=$snavi_members_uid|>|null|>|null";
			}

			$snavi_online_target = ($snavi_members_uid == $snavi_user_uid) ? "#MODULE#?name=Forums&file=profile&mode=editprofile" : "#MODULE#?name=Forums&file=profile&mode=viewprofile&u=$snavi_members_uid";

			$snavi_members_cat_sub[] = "Forums|>|$snavi_image[icon_memberprofile]|>|" . sprintf($snavi_lang['members_profile'], $snavi_members_username) . "|>|null|>|$snavi_online_target|>|null|>|null";
			$snavi_members_cat_sub[] = "Forums|>|$snavi_image[icon_memberpost]|>|" . sprintf($snavi_lang['members_post'], $snavi_members_username) . "|>|null|>|#MODULE#?name=Forums&file=search&search_author=$snavi_members_username|>|null|>|null";

			$snavi_members_sub[] = array(
				'menu' => $snavi_members_cat_top,
				'item' => $snavi_members_cat_sub
			);

			unset($snavi_members_cat_top);
			unset($snavi_members_cat_sub);
		}

		$db->sql_freeresult($result);

		$snavi_online_members = snavi_generate_menu($snavi_members_top, $snavi_members_sub);

		unset($snavi_members_top);
		unset($snavi_members_sub);
	}
}

/*
 * collect new private messages
 */

$snavi_new_pm = '';

if ($snavi_user_aut && isset($snavi_mod['Private_Messages']) && ($snavi_mod['Private_Messages']['active'] != 0))
{
	$result = $db->sql_query("SELECT pm.privmsgs_id, pm.privmsgs_date, pm.privmsgs_subject, u.user_id, u.username FROM ".$prefix."_bbprivmsgs pm, ".$user_prefix."_users u WHERE pm.privmsgs_to_userid = '$snavi_user_uid' AND u.user_id = pm.privmsgs_from_userid AND (pm.privmsgs_type = 1 OR pm.privmsgs_type = 5) ORDER BY pm.privmsgs_date DESC");
	if ($result)
	{
		$snavi_new_inbox = array();
		while(list($snavi_pm_id, $snavi_pm_date, $snavi_pm_subject, $snavi_from_uid, $snavi_from_name) = $db->sql_fetchrow($result))
		{
			$snavi_inbox_item = array($snavi_pm_id, $snavi_pm_date, $snavi_pm_subject, $snavi_from_uid, $snavi_from_name);
			$snavi_inbox_ukey = 'id_' . $snavi_from_uid;

			$snavi_new_inbox[$snavi_inbox_ukey][] = $snavi_inbox_item;
			unset($snavi_inbox_item);
		}

		$db->sql_freeresult($result);

		if (count($snavi_new_inbox) > 0)
		{
			$snavi_inbox_top = "null|>|null|>|#IMG=$snavi_image[icon_newpm]#|>|$snavi_lang[newpm_desc]|>|null|>|null|>|null";
			$snavi_inbox_sub = array();

			reset($snavi_new_inbox);
			foreach($snavi_new_inbox as $snavi_inbox_items)
			{
				reset($snavi_inbox_items);

				$snavi_inbox_fuid = $snavi_inbox_items[0][3];
				$snavi_inbox_fnam = $snavi_inbox_items[0][4];

				$snavi_inbox_cat_top = "null|>|$snavi_image[icon_newpmcat]|>|" . sprintf($snavi_lang['newpm_from'], $snavi_inbox_fnam) . "|>|null|>|#MODULE#?name=Forums&file=profile&mode=viewprofile&u=$snavi_inbox_fuid|>|null|>|null";
				$snavi_inbox_cat_sub = array();

				foreach($snavi_inbox_items as $snavi_inbox_item)
				{
					$snavi_pm_id      = $snavi_inbox_item[0];
					$snavi_pm_date    = date("d-M-Y H:i", $snavi_inbox_item[1]);
					$snavi_pm_subject = (empty($snavi_inbox_item[2])) ? 'No Subject' : ( (strlen($snavi_inbox_item[2]) > 40) ? substr($snavi_inbox_item[2], 0, 36).' ...' : $snavi_inbox_item[2] );

					$snavi_inbox_cat_sub[] = "null|>|$snavi_image[icon_newpmmail]|>|" . sprintf($snavi_lang['newpm_subject'], $snavi_pm_subject) . "|>|null|>|#MODULE#?name=Private_Messages&folder=inbox&mode=read&p=$snavi_pm_id|>|null|>|null";
					unset($snavi_inbox_item);
				}

				unset($snavi_inbox_items);

				$snavi_inbox_sub[] = array(
					'menu' => $snavi_inbox_cat_top,
					'item' => $snavi_inbox_cat_sub
				);

				unset($snavi_inbox_cat_top);
				unset($snavi_inbox_cat_sub);
			}

			$snavi_new_pm = snavi_generate_menu($snavi_inbox_top, $snavi_inbox_sub);

			unset($snavi_inbox_top);
			unset($snavi_inbox_sub);
		}
		unset($snavi_new_inbox);
	}
}

/*
 * collect new forum posts
 */

$snavi_new_post = '';

if ($snavi_user_aut && isset($snavi_mod['Forums']) && ($snavi_mod['Forums']['active'] != 0))
{
	$result = $db->sql_query("SELECT user_lastvisit FROM ".$user_prefix."_users where user_id='$snavi_user_uid'");
	if ($result)
	{
		list($snavi_new_post_lastvisit) = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		$snavi_new_post_lastvisit = intval($snavi_new_post_lastvisit);
	}
	else
	{
		$snavi_new_post_lastvisit = time()-259200;
	}

	$result = $db->sql_query("SELECT config_value FROM ".$prefix."_bbconfig where config_name='cookie_name'");
	if ($result)
	{
		list($snavi_new_post_cookiename) = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}
	else
	{
		$snavi_new_post_cookiename = 'phpbb2mysql';
	}

	$snavi_new_post_track_topics = ( isset($_COOKIE[$snavi_new_post_cookiename . '_t']) )     ? unserialize($_COOKIE[$snavi_new_post_cookiename . '_t']) : array();
	$snavi_new_post_track_forums = ( isset($_COOKIE[$snavi_new_post_cookiename . '_f']) )     ? unserialize($_COOKIE[$snavi_new_post_cookiename . '_f']) : array();
	$snavi_new_post_track_f_all  = ( isset($_COOKIE[$snavi_new_post_cookiename . '_f_all']) ) ? intval($_COOKIE[$snavi_new_post_cookiename . '_f_all'])  : 0;

	$sql  = "SELECT t.forum_id, f.forum_name, t.topic_last_post_id, t.topic_title, p.post_time ";
	$sql .= "FROM ".$prefix."_bbtopics t, ".$prefix."_bbforums f, ".$prefix."_bbposts p ";
	$sql .= "WHERE p.post_id = t.topic_last_post_id ";
	$sql .= "AND p.post_time >= $snavi_new_post_lastvisit ";
	$sql .= "AND f.forum_id = t.forum_id ";
	$sql .= "ORDER BY t.topic_last_post_id DESC ";
	$sql .= "LIMIT 0,50 ";

	$result = $db->sql_query($sql);
	if ($result)
	{
		$snavi_new_post_topics = array();
		while(list($snavi_new_post_fid, $snavi_new_post_fname, $snavi_new_post_tid, $snavi_new_post_tname, $snavi_new_post_time) = $db->sql_fetchrow($result))
		{
			$snavi_new_post_item = array($snavi_new_post_fid, $snavi_new_post_fname, $snavi_new_post_tid, $snavi_new_post_tname, $snavi_new_post_time);
			$snavi_new_post_ukey = "id_".$snavi_new_post_fid;

			$snavi_new_post_topics[$snavi_new_post_ukey][] = $snavi_new_post_item;
			unset($snavi_new_post_item);
		}
		$db->sql_freeresult($result);

		if (count($snavi_new_post_topics) > 0)
		{
			$snavi_newpost_top = "null|>|null|>|#IMG=$snavi_image[icon_newpost]#|>|$snavi_lang[newposts_desc]|>|null|>|null|>|null";
			$snavi_newpost_sub = array();

			reset($snavi_new_post_topics);
			foreach($snavi_new_post_topics as $snavi_new_post_items)
			{
				reset($snavi_new_post_items);

				$snavi_new_post_fid   = intval($snavi_new_post_items[0][0]);
				$snavi_new_post_fname = $snavi_new_post_items[0][1];

				$snavi_newpost_cat_top = "null|>|$snavi_image[icon_newpostcat]|>|" . sprintf($snavi_lang['newposts_forum'], $snavi_new_post_fname) . "|>|null|>|#MODULE#?name=Forums&file=viewforum&f=$snavi_new_post_fid|>|null|>|null";
				$snavi_newpost_cat_sub = array();

				foreach($snavi_new_post_items as $snavi_new_post_item)
				{
					$snavi_new_post_tid    = intval($snavi_new_post_item[2]);
					$snavi_new_post_tname  = (empty($snavi_new_post_item[3])) ? 'No Subject' : ( (strlen($snavi_new_post_item[3]) > 40) ? substr($snavi_new_post_item[3], 0, 36).' ...' : $snavi_new_post_item[3] );
					$snavi_new_post_time   = intval($snavi_new_post_item[4]);
					$snavi_new_post_unread = true;

					if ( !empty($snavi_new_post_track_topics[$snavi_new_post_tid]) && ($snavi_new_post_track_topics[$snavi_new_post_tid] >= $snavi_new_post_time) ) $snavi_new_post_unread = false;
					if ( !empty($snavi_new_post_track_forums[$snavi_new_post_fid]) && ($snavi_new_post_track_forums[$snavi_new_post_fid] >= $snavi_new_post_time) ) $snavi_new_post_unread = false;
					if ( ($snavi_new_post_track_f_all != 0) && ($snavi_new_post_track_f_all >= $snavi_new_post_time) ) $snavi_new_post_unread = false;

					if ($snavi_new_post_unread)
					{
						$snavi_newpost_cat_sub[] = "null|>|$snavi_image[icon_newposttopic]|>|" . sprintf($snavi_lang['newposts_topic'], $snavi_new_post_tname) . "|>|null|>|#MODULE#?name=Forums&file=viewtopic&p=$snavi_new_post_tid#$snavi_new_post_tid|>|null|>|null";
					}
					unset($snavi_new_post_item);
				}

				unset($snavi_new_post_items);

				$snavi_newpost_sub[] = array(
					'menu' => $snavi_newpost_cat_top,
					'item' => $snavi_newpost_cat_sub
				);

				unset($snavi_newpost_cat_top);
				unset($snavi_newpost_cat_sub);
			}

			$snavi_new_post = snavi_generate_menu($snavi_newpost_top, $snavi_newpost_sub);

			unset($snavi_newpost_top);
			unset($snavi_newpost_sub);
		}
		unset($snavi_new_post_topics);
	}
}

/*
 * collect all ticker's components
 */

if ($display_news == '1'){
$snavi_text_ticker = '';

if ($snavi_user_aut)
{

	/* latest registered members */

	$snavi_latest_members      = '';
	$snavi_latest_member_max   = 5;

	if (isset($snavi_mod['Your_Account']) && ($snavi_mod['Your_Account']['active'] != 0))
	{
		$result = $db->sql_query("SELECT user_id, username, user_regdate FROM ".$user_prefix."_users WHERE user_id!=1 ORDER BY user_id DESC LIMIT $snavi_latest_member_max");
		if ($result)
		{
			$snavi_latest_member_count = 0;
			while(list($snavi_latest_member_id, $snavi_latest_member_name, $snavi_latest_member_date) = $db->sql_fetchrow($result))
			{
				if (strlen($snavi_latest_members) > 0) $snavi_latest_members .= ', ';

				$snavi_latest_member_link = '<a class="ThemeMenu_Link" href="' . $snavi_portal_module . '?name=Your_Account&amp;op=userinfo&amp;username=' . $snavi_latest_member_name . '"><strong>' . $snavi_latest_member_name . '</strong></a>';



				$snavi_latest_member_item = $snavi_lang['ticker_reguseritem'];
				$snavi_latest_member_item = str_replace('{REGUSERID}',   $snavi_latest_member_id, $snavi_latest_member_item);
				$snavi_latest_member_item = str_replace('{REGUSERNAME}', $snavi_latest_member_name, $snavi_latest_member_item);
				$snavi_latest_member_item = str_replace('{REGUSERDATE}', $snavi_latest_member_date, $snavi_latest_member_item);
				$snavi_latest_member_item = str_replace('{REGUSERLINK}', $snavi_latest_member_link, $snavi_latest_member_item);

				$snavi_latest_members .= $snavi_latest_member_item;
				$snavi_latest_member_count++;
				unset($snavi_latest_member_item);
			}
			$db->sql_freeresult($result);
		}

		if (($snavi_latest_members != '') && ($snavi_latest_member_count > 0))
		{
			$snavi_latest_member_list = $snavi_lang['ticker_reguserlist'];
			$snavi_latest_member_list = str_replace('{REGUSERCOUNT}', $snavi_latest_member_count, $snavi_latest_member_list);
			$snavi_latest_member_list = str_replace('{REGUSERITEMS}', $snavi_latest_members, $snavi_latest_member_list);

			$snavi_latest_members = $snavi_latest_member_list;
			unset($snavi_latest_member_list);
		}

		$snavi_latest_member_nums = 0;
		$snavi_latest_member_many  = '';
		$result = $db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE user_id!=1");
		if ($result)
		{
			$snavi_latest_member_nums = $db->sql_numrows($result);
			$db->sql_freeresult($result);
			$snavi_latest_member_many = ($snavi_latest_member_nums > 1) ? 's' : '';
		}

		$snavi_latest_member_total = $snavi_lang['ticker_regusertotal'];
		$snavi_latest_member_total = str_replace('{REGUSERTOTAL}', $snavi_latest_member_nums, $snavi_latest_member_total);
		$snavi_latest_member_total = str_replace('{USER_S}', $snavi_latest_member_many, $snavi_latest_member_total);

		$snavi_latest_members .= ' '. $snavi_latest_member_total . ' ';
		unset($snavi_latest_member_total);
	}

	/* latest file downloads */

	$snavi_latest_files      = '';
	$snavi_latest_file_max   = 5;

	if (isset($snavi_mod['Downloads']) && ($snavi_mod['Downloads']['active'] != 0))
	{
		$result = $db->sql_query("SELECT lid, title, date, filesize FROM ".$prefix."_downloads_downloads ORDER BY date DESC LIMIT $snavi_latest_file_max");
		if ($result)
		{
			$snavi_latest_file_count = 0;
			while(list($snavi_latest_file_id, $snavi_latest_file_name, $snavi_latest_file_date, $snavi_latest_file_size) = $db->sql_fetchrow($result))
			{
				if (strlen($snavi_latest_files) > 0) $snavi_latest_files .= ', ';
				preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $snavi_latest_file_date, $snavi_datetime);

				$snavi_latest_file_title = str_replace(' ', '_', $snavi_latest_file_name);
				$snavi_latest_file_date  = date("M, d Y", mktime($snavi_datetime[4],$snavi_datetime[5],$snavi_datetime[6],$snavi_datetime[2],$snavi_datetime[3],$snavi_datetime[1]));
				$snavi_latest_file_size  = (intval($snavi_latest_file_size) > 0) ? snavi_filesize_str(intval($snavi_latest_file_size)) : $snavi_lang['ticker_filenosize'];
				$snavi_latest_file_link  = '<a class="ThemeMenu_Link" href="' . $snavi_portal_module . '?name=Downloads&d_op=viewdownloaddetails&amp;lid=' . $snavi_latest_file_id . '&amp;ttitle=' . $snavi_latest_file_title . '"><strong>' . $snavi_latest_file_name . '</strong></a>';

				$snavi_latest_file_item  = $snavi_lang['ticker_fileitem'];
				$snavi_latest_file_item  = str_replace('{FILEID}',   $snavi_latest_file_id,    $snavi_latest_file_item);
				$snavi_latest_file_item  = str_replace('{FILENAME}', $snavi_latest_file_title, $snavi_latest_file_item);
				$snavi_latest_file_item  = str_replace('{FILEDATE}', $snavi_latest_file_date,  $snavi_latest_file_item);
				$snavi_latest_file_item  = str_replace('{FILESIZE}', $snavi_latest_file_size,  $snavi_latest_file_item);
				$snavi_latest_file_item  = str_replace('{FILELINK}', $snavi_latest_file_link,  $snavi_latest_file_item);

				$snavi_latest_files .= $snavi_latest_file_item;
				$snavi_latest_file_count++;
				unset($snavi_latest_file_item);
			}
			$db->sql_freeresult($result);
		}

		if (($snavi_latest_files != '') && ($snavi_latest_file_count > 0))
		{
			$snavi_latest_file_list = $snavi_lang['ticker_filelist'];
			$snavi_latest_file_list = str_replace('{FILECOUNT}', $snavi_latest_file_count, $snavi_latest_file_list);
			$snavi_latest_file_list = str_replace('{FILEITEMS}', $snavi_latest_files, $snavi_latest_file_list);

			$snavi_latest_files = $snavi_latest_file_list;
			unset($snavi_latest_file_list);
		}

		$snavi_latest_file_nums = 0;
		$snavi_latest_file_many = '';
		$result = $db->sql_query("SELECT lid FROM ".$prefix."_downloads_downloads");
		if ($result) {
			$snavi_latest_file_nums = strval($db->sql_numrows($result));
			$db->sql_freeresult($result);
			$snavi_latest_file_many = ($snavi_latest_file_nums > 1) ? 's' : '';
		}

		$snavi_latest_file_cnums = 0;
		$snavi_latest_file_cmany = '';
		$result = $db->sql_query("SELECT cid FROM ".$prefix."_downloads_categories");
		if ($result) {
			$snavi_latest_file_cnums = strval($db->sql_numrows($result));
			$db->sql_freeresult($result);
			$snavi_latest_file_cmany = ($snavi_latest_file_cnums > 1) ? 's' : '';
		}

		$snavi_latest_file_total = $snavi_lang['ticker_filetotal'];
		$snavi_latest_file_total = str_replace('{FILETOTAL}', $snavi_latest_file_nums, $snavi_latest_file_total);
		$snavi_latest_file_total = str_replace('{FILE_S}', $snavi_latest_file_many, $snavi_latest_file_total);
		$snavi_latest_file_total = str_replace('{FILECATTOTAL}', $snavi_latest_file_cnums, $snavi_latest_file_total);
		$snavi_latest_file_total = str_replace('{FILECAT_S}', $snavi_latest_file_cmany, $snavi_latest_file_total);

		$snavi_latest_files .= ' '. $snavi_latest_file_total . ' ';
		unset($snavi_latest_file_total);
	}

	/* latest forums info */

	$snavi_latest_forums = '';

	if (isset($snavi_mod['Forums']) && ($snavi_mod['Forums']['active'] != 0))
	{
		$snavi_forums_post_nums = 0;
		$snavi_forums_post_many = '';
		$result = $db->sql_query("SELECT post_id FROM ".$prefix."_bbposts_text");
		if ($result) {
			$snavi_forums_post_nums = strval($db->sql_numrows($result));
			$db->sql_freeresult($result);
			$snavi_forums_post_many = ($snavi_forums_post_nums > 1) ? 's' : '';
		}

		$snavi_forums_topic_nums = 0;
		$snavi_forums_topic_many = '';
		$result = $db->sql_query("SELECT topic_id FROM ".$prefix."_bbtopics");
		if ($result) {
			$snavi_forums_topic_nums = strval($db->sql_numrows($result));
			$db->sql_freeresult($result);
			$snavi_forums_topic_many = ($snavi_forums_topic_nums > 1) ? 's' : '';
		}

		$snavi_forums_section_nums = 0;
		$snavi_forums_section_many = '';
		$result = $db->sql_query("SELECT forum_id FROM ".$prefix."_bbforums");
		if ($result) {
			$snavi_forums_section_nums = strval($db->sql_numrows($result));
			$db->sql_freeresult($result);
			$snavi_forums_section_many = ($snavi_forums_section_nums > 1) ? 's' : '';
		}

		$snavi_latest_forums = sprintf($snavi_lang['ticker_foruminfo'], '<a class="ThemeMenu_Link" href="' . $snavi_portal_module . '?name=Forums">', '</a>');
		$snavi_latest_forums = str_replace('{FORUMS}',  $snavi_forums_section_nums, $snavi_latest_forums);
		$snavi_latest_forums = str_replace('{FORUM_S}', $snavi_forums_section_many, $snavi_latest_forums);
		$snavi_latest_forums = str_replace('{TOPICS}',  $snavi_forums_topic_nums,   $snavi_latest_forums);
		$snavi_latest_forums = str_replace('{TOPIC_S}', $snavi_forums_topic_many,   $snavi_latest_forums);
		$snavi_latest_forums = str_replace('{POSTS}',   $snavi_forums_post_nums,    $snavi_latest_forums);
		$snavi_latest_forums = str_replace('{POST_S}',  $snavi_forums_post_many,    $snavi_latest_forums);

		$snavi_latest_forums = ' ' . $snavi_latest_forums . ' ';
	}

	/* combine them all */

	$snavi_text_ticker = $snavi_latest_members . $snavi_latest_files . $snavi_latest_forums;

	unset($snavi_latest_members);
	unset($snavi_latest_files);
	unset($snavi_latest_forums);
}
else
{
	$snavi_text_ticker = $snavi_lang['ticker_missing'];
	if (isset($snavi_mod['Your_Account']) && ($snavi_mod['Your_Account']['active'] != 0))
	{
		$snavi_text_ticker .= ' ' . sprintf($snavi_lang['ticker_register'], '<a class="ThemeMenu_Link" href="' . $snavi_portal_module . '?name=Your_Account&amp;op=new_user"><strong>', '</strong></a>');
	}
	$snavi_text_ticker .= ' ' . $snavi_lang['ticker_regfeats'];
}
}
if ($display_news =='2'){
$snavi_text_news_home = ''; 
      $scrollnews.="";
    $news = array();
    $networkData = eval(@file_get_contents("snavi/layouts/networknews.txt"));
//    foreach ($news[] as $news){
    for($i=0;$i < count($news);$i++){
//      for($i=0,$maxi=count($news);$i<$maxi;$i++) {
      $newz = explode('|', $news[$i]);
      $title = $newz[0];
      $url = $newz[1];
      $scrollnews.=" <strong></strong> <a href=\"" . $url . "\">" . $title . "</a> &nbsp; &nbsp; &nbsp;";
    }
      $scrollnews.="";
$snavi_text_news_home = $scrollnews;
}

/*
 * output the script
 * ok babe, let's rock 'n roll... MUSIC!
 */

?>
<script language="JavaScript" type="text/javascript"><!--
var cmThemeMenu =
{
mainFolderLeft: '',
mainFolderRight: '',
mainItemLeft: '',
mainItemRight: '',
folderLeft: '<img alt="" src="<?php echo $snavi_ppic; ?>/sys_spacer.png">',
folderRight: '<img alt="" src="<?php echo $snavi_ppic; ?>/sys_arrow.png">',
itemLeft: '<img alt="" src="<?php echo $snavi_ppic; ?>/sys_spacer.png">',
itemRight: '<img alt="" src="<?php echo $snavi_ppic; ?>/sys_blank.png">',
mainSpacing: 0,
subSpacing: 0,
delay: 250
};
var cmThemeMenu_HSplit = [_cmNoAction, '<td class="ThemeMenu_MenuItemLeft"></td><td colspan="2"><div class="ThemeMenu_MenuSplit"></div></td>'];
var cmThemeMenu_MainHSplit = [_cmNoAction, '<td class="ThemeMenu_MainItemLeft"></td><td colspan="2"><div class="ThemeMenu_MenuSplit"></div></td>'];
var cmThemeMenu_MainVSplit = [_cmNoAction, '&nbsp;'];

var cmThemeMenuItems =
[
<?php
if ($display_home =='1'){
	echo $snavi_menu_home;
	unset($snavi_menu_home);
	}
if ($display_clans =='1'){
	echo "_cmSplit,\n";
	echo $snavi_menu_clan;
	unset($snavi_menu_clan);
}	
if ($display_dfgnetwork =='1'){
  echo "_cmSplit,\n";
	echo $snavi_menu_network;
	unset($snavi_menu_network);
}

if ($display_admin =='1'){
	if ($snavi_menu_admin != '')
	{
		echo "_cmSplit,\n";
		echo $snavi_menu_admin;
	}
	unset($snavi_menu_admin);
}

if ($display_account =='1'){
	if ($snavi_menu_account != '')
	{
		echo "_cmSplit,\n";
		echo $snavi_menu_account;
	}
	unset($snavi_menu_account);
}

if ($display_files =='1'){
	if ($snavi_menu_download != '')
	{
		echo "_cmSplit,\n";
		echo $snavi_menu_download;
	}
	unset($snavi_menu_download);
}

if ($display_forums =='1'){
	if ($snavi_menu_forum != '')
	{
		echo "_cmSplit,\n";
		echo $snavi_menu_forum;
	}
	unset($snavi_menu_forum);
}
?>
];
<?php
/* begin - construct notification menu for registered users */
if ($snavi_user_aut)
{
?>
var cmThemeMenuUserNav =
[
<?php
	$snavi_split_count = 0;

if ($display_staff =='1'){
	if ($snavi_online_staffs != '')
	{
		if ($snavi_split_count > 0) echo "_cmSplit,\n";
		echo $snavi_online_staffs;
		$snavi_split_count++;
	}
	unset($snavi_online_staffs);
}

if ($display_users =='1'){
	if ($snavi_online_members != '')
	{
		if ($snavi_split_count > 0) echo "_cmSplit,\n";
		echo $snavi_online_members;
		$snavi_split_count++;
	}
	unset($snavi_online_members);
}

if ($display_pm =='1'){
	if ($snavi_new_pm != '')
	{
		if ($snavi_split_count > 0) echo "_cmSplit,\n";
		echo $snavi_new_pm;
		$snavi_split_count++;
	}
	unset($snavi_new_pm);
}

if ($display_newforumpost =='1'){
	if ($snavi_new_post != '')
	{
		if ($snavi_split_count > 0) echo "_cmSplit,\n";
		echo $snavi_new_post;
		$snavi_split_count++;
	}
	unset($snavi_new_post);
}
?>
];
<?php
}
/* end - construct notification menu for registered users */
?>
//--></script>

<table width="100%" height="28" border="0" cellpadding="0" cellspacing="0"><tr>
<!-- SNAVI LOGO IMAGE-->
<!--<td width="148" nowrap><img border="0" src="snavi/images/bar_main.gif"></td>-->
<td class="ThemeMenu_Body" nowrap>
<table class="ThemeMenu_MainTable" border="0" cellpadding="0" cellspacing="0"><tr>
<td>
<div id="ThemeMenuBarID"> </div>
<script language="JavaScript" type="text/javascript"><!--
cmDraw('ThemeMenuBarID', cmThemeMenuItems, 'hbr', cmThemeMenu, 'ThemeMenu_');
//--></script>
</td>
</tr></table>
</td>
<?php
/* begin - show notification menu for registered users */
if ($snavi_user_aut && ($snavi_split_count > 0))
{
?>
<td class="ThemeMenu_Splitter" width="8" nowrap>&nbsp;</td>
<td class="ThemeMenu_Body" nowrap>
<table class="ThemeMenu_MainTable" border="0" cellpadding="0" cellspacing="0"><tr>
<td>
<div id="ThemeMenuUserNavID"> </div>
<script language="JavaScript" type="text/javascript"><!--
cmDraw('ThemeMenuUserNavID', cmThemeMenuUserNav, 'hbr', cmThemeMenu, 'ThemeMenu_');
//--></script>
</td>
</tr></table>
</td>
<?php
}
if ($display_news =='1'){
/* end - show notification menu for registered users */
?>
<td class="ThemeMenu_Splitter" width="8" nowrap>&nbsp;</td>
<td class="ThemeMenu_Body">
<marquee behavior="scroll" direction="left" width="100%" scrollamount="3" scrolldelay="50" onmouseover="this.stop()" onmouseout="this.start()">
<span class="ThemeMenu_GenMed"><?php echo $snavi_text_ticker; ?></span>
</marquee>
</td>

<?php
}
if ($display_news =='2'){
?>
<td class="ThemeMenu_Splitter" width="8" nowrap>&nbsp;</td>
<td class="ThemeMenu_Body">
<marquee behavior="scroll" direction="left" width="100%" scrollamount="1" scrolldelay="50" onmouseover="this.stop()" onmouseout="this.start()">
<span class="ThemeMenu_GenMed"><?php echo $snavi_text_news_home; ?></span>
</marquee>
</td>

<?php
}
/* begin - show login form for anonymous users */

if ($display_anonymous_login =='1'){
if (!$snavi_user_aut)
{
?>
<td class="ThemeMenu_Splitter" width="8" nowrap>&nbsp;</td>
<td class="ThemeMenu_Body">
<?php
mt_srand( (double)microtime()*1000000 );
$maxran = 1000000;
$random_num = mt_rand(0, $maxran);
$datekey = date("F j");
$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 10);
?>
<form class="ThemeMenu_Form" action="<?php echo $snavi_portal_module; ?>?name=Your_Account" method="post">
<table class="ThemeMenu_MainTable" border="0" cellpadding="0" cellspacing="0"><tr>
<td><span class="ThemeMenu_GenMed">&nbsp;<?php echo $snavi_lang['login_username']; ?></span></td>
<td><input class="ThemeMenu_InputText" type="text" name="username" size="5" maxlength="25"></td>
<td><span class="ThemeMenu_GenMed">&nbsp;<?php echo $snavi_lang['login_password']; ?></span></td>
<td><input class="ThemeMenu_InputText" type="password" name="user_password" size="5" maxlength="20"></td>
<?php
if (extension_loaded("gd") && ($gfx_chk == 2 || $gfx_chk == 4 || $gfx_chk == 5 || $gfx_chk == 7))
{
?>
<td><span class="ThemeMenu_GenMed">&nbsp;<?php echo $snavi_lang['login_seccode']; ?></span></td>
<td><img border="0" width="70" height="30" alt="<?php echo $snavi_lang['login_altseccode']; ?>" hspace="0" vspace="0" src="snavi/snavi.php?snavi_op=gfx&amp;random_num=<?php echo $random_num; ?>&amp;theme_name=<?php echo $theme_name; ?>"/></td>
<td><input class="ThemeMenu_InputText" type="text" name="gfx_check" size="5" maxlength="6"></td>
<td>
<input type="hidden" name="random_num" value="<?php echo $random_num; ?>">
<?php
}
else
{
?>
<td>
<input type="hidden" name="random_num" value="<?php echo $random_num; ?>">
<input type="hidden" name="gfx_check" value="<?php echo $code; ?>">
<?php
}
?>
<input type="hidden" name="op" value="login">
<input class="ThemeMenu_Button" type="submit" value="<?php echo $snavi_lang['login_submit']; ?>">
</td>
</tr></table>
</form>
</td>
<?php
}
}
/* end - show login form for anonymous users */
?>
<td class="ThemeMenu_Splitter" width="8" nowrap></td>
<td class="ThemeMenu_Body">
<span class="ThemeMenu_Date" style="margin:0px 0px 0px 0px;"><strong>
<?php
if ($display_date =='1'){
?>
<script language="JavaScript" type="text/javascript"><!--
var strDate, date = new Date();
var strMonth = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
var strDayOfWeek = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
strDate = strDayOfWeek[date.getDay()] + ',&nbsp;' + strMonth[date.getMonth()] + '&nbsp;' + date.getDate() +  ',&nbsp;' + date.getFullYear();
document.write(strDate);
//--></script>
<?php
}
?>
</strong></span>
</td>
</tr></table>
<?php

/*
 * freed layout buffer since we don't need them any longer
 */

unset($snavi_network_buffer);
unset($snavi_layout_buffer);

/*
 * freed language specific variables
 */

unset($snavi_lang);
unset($snavi_image);
}
else
{
	if (preg_match('/snavi\/snavi\.php$/', $_SERVER['PHP_SELF']))
	{
		define('SNAVI_REQUEST', true);
		require_once('includes/snavi/snavi_req.inc.php');

		$snavi_op = (isset($_GET['snavi_op']) && preg_match('/^[a-zA-Z0-9_]+$/', $_GET['snavi_op'])) ? $_GET['snavi_op'] : '';
		switch ($snavi_op)
		{
			default:
				header("HTTP/1.0 404 Not Found");
				break;

			case "gfx":
				snavi_gfx();
				break;

			case "about":
				snavi_about();
				break;
		}

		die();
	}
}
}

?>