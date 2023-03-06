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

/*****************************************
Applied rules:
 * ReplaceHttpServerVarsByServerRector (https://blog.tigertech.net/posts/php-5-3-http-server-vars/)
 * LongArrayToShortArrayRector
 * WrapVariableVariableNameInCurlyBracesRector (https://www.php.net/manual/en/language.variables.variable.php)
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring)
 * WhileEachToForeachRector (https://wiki.php.net/rfc/deprecations_php_7_2#each)
 *****************************************/
 
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
//
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
//set_magic_quotes_runtime(0); // Disable magic_quotes_runtime
// The following code (unsetting globals)
// Thanks to Matt Kavanagh and Stefan Esser for providing feedback as well as patch files
// PHP5 with register_long_arrays off?
if (phpversion() >= '5.0.0' && (!ini_get('register_long_arrays') || ini_get('register_long_arrays') == '0' || strtolower(ini_get('register_long_arrays')) == 'off'))
{
	$_POST = $_POST;
	$_GET = $_GET;
	$_SERVER = $_SERVER;
	$_COOKIE = $_COOKIE;
	$_ENV = $_ENV;
	$_FILES = $_FILES;
	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$_SESSION = $_SESSION;
	}
}
// Protect against GLOBALS tricks
if (isset($_POST['GLOBALS']) || isset($_FILES['GLOBALS']) || isset($_GET['GLOBALS']) || isset($_COOKIE['GLOBALS']))
{
	die("Hacking attempt");
}
// Protect against HTTP_SESSION_VARS tricks
if (isset($_SESSION) && !is_array($_SESSION))
{
	die("Hacking attempt");
}
if (ini_get('register_globals') == '1' || strtolower(ini_get('register_globals')) == 'on')
{
	// PHP4+ path
	$not_unset = ['HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path', 'name', 'admin', 'nukeuser', 'user', 'no_page_header', 'cookie', 'db', 'prefix'];
	// Not only will array_merge give a warning if a parameter
	// is not an array, it will actually fail. So we check if
	// HTTP_SESSION_VARS has been initialised.
	if (!isset($_SESSION) || !is_array($_SESSION))
	{
		$_SESSION = [];
	}
	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_SESSION, $_ENV, $_FILES);
	unset($input['input']);
	unset($input['not_unset']);
	while ([$var, ] = each($input))
	{
		if (!in_array($var, $not_unset))
		{
			unset(${$var});
		}
	}
	unset($input);
}
//
// addslashes to vars if magic_quotes_gpc is off
// this is a security precaution to prevent someone
// trying to break out of a SQL statement.
//
	if( is_array($_GET) )
	{
		foreach ($_GET as $k => $v) {
      if( is_array($_GET[$k]) )
   			{
   				foreach ($_GET[$k] as $k2 => $v2) {
           $_GET[$k][$k2] = addslashes($v2);
       }
   				reset($_GET[$k]);
   			}
   			else
   			{
   				$_GET[$k] = addslashes($v);
   			}
	reset($_GET);
	}
	if( is_array($_POST) )
	{
		foreach ($_POST as $k => $v) {
      if( is_array($_POST[$k]) )
   			{
   				foreach ($_POST[$k] as $k2 => $v2) {
           $_POST[$k][$k2] = addslashes($v2);
       }
   				reset($_POST[$k]);
   			}
   			else
   			{
   				$_POST[$k] = addslashes($v);
   			}
  }
		reset($_POST);
	}
	if( is_array($_COOKIE) )
	{
		foreach ($_COOKIE as $k => $v) {
      if( is_array($_COOKIE[$k]) )
   			{
   				foreach ($_COOKIE[$k] as $k2 => $v2) {
           $_COOKIE[$k][$k2] = addslashes($v2);
       }
   				@reset($_COOKIE[$k]);
   			}
   			else
   			{
   				$_COOKIE[$k] = addslashes($v);
   			}
  }
		reset($_COOKIE);
	}
}
//
// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
//
$board_config = [];
$userdata = [];
$theme = [];
$images = [];
$lang = [];
$nav_links = [];
$gen_simple_header = FALSE;
$dss_seeded = false;
include_once($phpbb_root_path . 'config.'.$phpEx);
if( !defined("PHPBB_INSTALLED") )
{
        header("Location: modules.php?name=Forums&file=install");
	exit;
}
global $forum_admin;
if (defined('FORUM_ADMIN')) {
    include_once("../../../db/db.php");
    include_once("../../../includes/constants.php");
    include_once("../../../includes/classes/class_common.php");
	include_once("../../../includes/template.php");
    include_once("../../../includes/sessions.php");
    include_once("../../../includes/auth.php");
    include_once("../../../includes/functions.php");
    if ( defined('IN_CASHMOD') )
    {
	include_once('../../../includes/functions_cash.'.$phpEx);
    }
} else {
    include_once("includes/constants.php");
    include_once("includes/classes/class_common.php");
    include_once("includes/template.php");
    include_once("includes/sessions.php");
    include_once("includes/auth.php");
    include_once("includes/functions.php");
    include_once("db/db.php");
    if ( defined('IN_CASHMOD') )
    {
	include_once('includes/functions_cash.'.$phpEx);
    }
}
// We do not need this any longer, unset for safety purposes
unset($dbpasswd);
//
// Obtain and encode users IP
//
// I'm removing HTTP_X_FORWARDED_FOR ... this may well cause other problems such as
// private range IP's appearing instead of the guilty routable IP, tough, don't
// even bother complaining ... go scream and shout at the idiots out there who feel
// "clever" is doing harm rather than good ... karma is a great thing ... :)
//
$client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
$user_ip = encode_ip($client_ip);
//
// Setup forum wide options, if this fails
// then we output a CRITICAL_ERROR since
// basic forum information is not available
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}
while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['config_name']] = $row['config_value'];
}
include_once($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx);
//
// Show 'Board is disabled' message if needed.
//
if( $board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN") )
{
	message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
}
