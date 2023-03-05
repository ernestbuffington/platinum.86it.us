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

/********************************************
 Applied rules:
 * LongArrayToShortArrayRector
 * SetCookieRector (https://www.php.net/setcookie https://wiki.php.net/rfc/same-site-cookie)
 * CurlyToSquareBracketArrayStringRector (https://www.php.net/manual/en/migration74.deprecated.php)
 * ArraySpreadInsteadOfArrayMergeRector (https://wiki.php.net/rfc/spread_operator_for_array)
 * AddLiteralSeparatorToNumberRector (https://wiki.php.net/rfc/numeric_literal_separator)
 * StrStartsWithRector (https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions)
 * StrContainsRector (https://externals.io/message/108562 https://github.com/php/php-src/pull/5179)
 * NullToStrictStringFuncCallArgRector
 ********************************************/

//if(!defined('END_TRANSACTION')){ define('END_TRANSACTION', 2); }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Get PHP Version
*/
$phpver = phpversion();


#character set define XHTML1.0
define("_CHARSET","utf-8");
define("_LANG_DIRECTION","ltr");
define("_LANGCODE","en");
define("_MIME", "text/html"); 

# Define Titanium Engine Information
define('NUKE_PLATINUM', '3.0.0'); 
define('PLATINUM_EDITION', 'Network');
define('PLATINUM_VERSION', NUKE_PLATINUM . ' ' . PLATINUM_EDITION);

/**
 * convert superglobals - Modified by Raven 5/12/2006 - from http://www.php.net/manual/en/language.variables.predefined.php
*/
if (!isset($_SERVER))
{
	$_GET = &$_GET;
	$_POST = &$_POST;
	$_ENV = &$_ENV;
	$_SERVER = &$_SERVER;
	$_COOKIE = &$_COOKIE;
	$_REQUEST = [...$_GET, ...$_POST, ...$_COOKIE];
}
$PHP_SELF = $_SERVER['PHP_SELF'];

// Stupid handle to create REQUEST_URI for IIS 5 servers
if (preg_match('/IIS/', (string) $_SERVER['SERVER_SOFTWARE']) && isset($_SERVER['SCRIPT_NAME']))
{
    $requesturi = $_SERVER['SCRIPT_NAME'];
    if (isset($_SERVER['QUERY_STRING']))
	{
        $requesturi .= '?'.$_SERVER['QUERY_STRING'];
    }
    $_SERVER['REQUEST_URI'] = $requesturi;
}
/**
 * After doing those superglobals we can now use one and check if this file isnt being accessed directly
*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
{
	header('Location: index.php');
	exit('Access Denied');
}

if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && str_contains((string) $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && @extension_loaded('zlib') && !headers_sent())
{
	ob_start('ob_gzhandler');
	ob_implicit_flush(0);
}

if (@ini_get('date.timezone') == '')
{
	date_default_timezone_set("America/New_York");
}

if (!@ini_get('register_globals'))
{
	extract($_GET, EXTR_OVERWRITE);
	extract($_POST, EXTR_OVERWRITE);
	extract($_COOKIE, EXTR_OVERWRITE);
}


// This block of code makes sure $admin and $user are COOKIES
if((isset($admin) && $admin != $_COOKIE['admin']) OR (isset($user) && $user != $_COOKIE['user']))
{
  die("Illegal Operation");
}
	// We want to use the function stripos,
	// but thats only available since PHP5.
	// So we cloned the function...
	if(!function_exists('stripos'))
	{
		function stripos_clone($haystack, $needle, $offset=0)
		{
			$return = strpos(strtoupper((string) $haystack), strtoupper((string) $needle), $offset);
				if ($return === false)
				{
					return false;
				} else {
					return true;
				}
		}
	} else {
	// But when this is PHP5, we use the original function
	function stripos_clone($haystack, $needle, $offset=0)
	{
		$return = stripos((string) $haystack, (string) $needle, $offset=0);
		if ($return === false) {
			return false;
		} else {
			return true;
		}
	}
}
/*****[BEGIN]****[EVO-XTREME THEME COMPATABILITY]*******
 [ Base:    Visible Blocks Code                 v1.0.0 ]
 ******************************************************/
function blocks_visible($side)
{
    global $showblocks;

    $showblocks = ($showblocks == null) ? 3 : $showblocks;

    $side = strtolower((string) $side[0]);

    //If there are no blocks for this module && not admin file
    if (!$showblocks && !defined('ADMIN_FILE')) return false;

    //If in the admin show l blocks
    if (defined('ADMIN_FILE'))
	{
        return true;
    }

    //If set to 3 its all blocks
    if ($showblocks == 3) return true;

    //Count the blocks on the side
    $blocks = blocks($side);

    //If there are no blocks
    if (!$blocks)
	{
        return false;
    }

    //Check for blocks to show
    if (($showblocks == 1 && $side == 'l') || ($showblocks == 2 && $side == 'r'))
	{
        return true;
    }

    return false;
}
/*****[END]******[EVO-XTREME THEME COMPATABILITY]*******
 [ Base:    Visible Blocks Code                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
define('GDSUPPORT', extension_loaded('gd'));
if(function_exists('imagecreatetruecolor') && function_exists('imageftbbox'))
{
    define('VISUAL_CAPTCHA',true);
}
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
if(isset($admin) && $admin == $_COOKIE['admin'])
{
   $admin = base64_decode((string) $admin);
   $admin = addslashes($admin);
   $admin = base64_encode($admin);
}
if(isset($user) && $user == $_COOKIE['user'])
{
   $user = base64_decode((string) $user);
   $user = addslashes($user);
   $user = base64_encode($user);
}
// Die message for not allowed HTML tags
$htmltags = "<center><img src=\"images/logo.gif\"><br /><br /><strong>";
$htmltags .= "The html tags you attempted to use are not allowed</strong><br /><br />";
$htmltags .= "[ <a href=\"javascript:history.go(-1)\"><strong>Go Back</strong></a> ]</center>";
if(defined('FORUM_ADMIN')) {
	define('INCLUDE_PATH', '../../../');
} elseif(defined('INSIDE_MOD')) {
	define('INCLUDE_PATH', '../../');
} else {
	define('INCLUDE_PATH', './');
}
// Added by Raven for RavenNuke76(tm) installation in v2.02.02
// These settings MUST be set here (right before including config.php) to avoid code injection.
$bypassInstallationFolderCheck = FALSE;
$bypassNukeSentinelInvalidIPCheck = FALSE;

@require_once(INCLUDE_PATH."config.php");
require_once(INCLUDE_PATH."db/db.php");
require_once(NUKE_CLASSES_DIR.'class.identify.php');
global $agent;
$identify = new identify();
$agent = $identify->identify_agent();
require_once(INCLUDE_PATH."includes/nukesentinel.php");
// GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
if (isset($tnsl_bUseShortLinks) && $tnsl_bUseShortLinks && file_exists(INCLUDE_PATH.'includes/tegonuke/shortlinks/shortlinks.php'))
{
    define('TNSL_USE_SHORTLINKS', TRUE);
    @include_once(INCLUDE_PATH.'includes/tegonuke/shortlinks/shortlinks.php');
}
// NSN Groups
@include_once(INCLUDE_PATH.'includes/nsngr_func.php');
/* FOLLOWING TWO LINES ARE DEPRECATED BUT ARE HERE FOR OLD MODULES COMPATIBILITY */
/* PLEASE START USING THE NEW SQL ABSTRACTION LAYER. SEE MODULES DOC FOR DETAILS */
/*@require_once(INCLUDE_PATH."includes/sql_layer.php");
$dbi = sql_connect($dbhost, $dbuname, $dbpass, $dbname);
$result = $db->sql_query("SELECT * FROM ".$prefix."_config");*/
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_config` LIMIT 0,1");
$row = $db->sql_fetchrow($result);
@require_once(INCLUDE_PATH."includes/ipban.php");
if (file_exists(INCLUDE_PATH."includes/custom_files/custom_mainfile.php")) {
  @include_once(INCLUDE_PATH."includes/custom_files/custom_mainfile.php");
}
if (!defined('FORUM_ADMIN')) {
  if(empty($admin_file)) {
    die ("You must set a value for admin_file in config.php");
  } elseif (!empty($admin_file) && !file_exists($admin_file.".php")) {
    die ("The admin_file you defined in config.php does not exist");
  }
}
// Error reporting, to be set in config.php
error_reporting(E_ALL^E_NOTICE);
if($display_errors) {
  @ini_set('display_errors', 1);
} else {
  @ini_set('display_errors', 0);
}
$sitename = $row['sitename'];
$nukeurl = $row['nukeurl'];
$site_logo = $row['site_logo'];
$slogan = $row['slogan'];
$startdate = $row['startdate'];
$adminmail = stripslashes((string) $row['adminmail']);
$anonpost = $row['anonpost'];
$Default_Theme = $row['Default_Theme'];
$foot1 = $row['foot1'];
$foot2 = $row['foot2'];
$foot3 = $row['foot3'];
$commentlimit = intval($row['commentlimit']);
$anonymous = $row['anonymous'];
$minpass = intval($row['minpass']);
$pollcomm = intval($row['pollcomm']);
$articlecomm = intval($row['articlecomm']);
$broadcast_msg = intval($row['broadcast_msg']);
$my_headlines = intval($row['my_headlines']);
$top = intval($row['top']);
$storyhome = intval($row['storyhome']);
$user_news = intval($row['user_news']);
$oldnum = intval($row['oldnum']);
$ultramode = intval($row['ultramode']);
$banners = intval($row['banners']);
$backend_title = $row['backend_title'];
$backend_language = $row['backend_language'];
$language = $row['language'];
$locale = $row['locale'];
$multilingual = intval($row['multilingual']);
$useflags = intval($row['useflags']);
$notify = intval($row['notify']);
$notify_email = $row['notify_email'];
$notify_subject = $row['notify_subject'];
$notify_message = $row['notify_message'];
$notify_from = $row['notify_from'];
$moderate = intval($row['moderate']);
$admingraphic = intval($row['admingraphic']);
$httpref = intval($row['httpref']);
$httprefmax = intval($row['httprefmax']);
$CensorMode = intval($row['CensorMode']);
$CensorReplace = $row['CensorReplace'];
$copyright = $row['copyright'];
$Version_Num = htmlentities(strip_tags((string) $row['Version_Num']));
$login_bar = intval($row['login_bar']);
$domain = str_replace("http://", "", (string) $nukeurl);
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
include_once('includes/gfx_check.php');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
if (!defined('FORUM_ADMIN')) {
	$ThemeSel = get_theme();
	include_once 'themes/' . $ThemeSel . '/theme.php';
	if (($multilingual == 1) AND isset($newlang) AND !stristr((string) $newlang,'.')) {
		$newlang = check_html($newlang, 'nohtml');
		if (file_exists('language/lang-' . $newlang . '.php')) {
			setcookie('lang', (string) $newlang, ['expires' => time() + 31_536_000]);
			include_once 'language/lang-' . $newlang . '.php';
			$currentlang = $newlang;
		} else {
			setcookie('lang', (string) $language, ['expires' => time() + 31_536_000]);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} elseif (($multilingual == 1) AND isset($lang) AND !stristr((string) $lang, '.')) {
		$lang = check_html($lang, 'nohtml');
		if (file_exists('language/lang-' . $lang . '.php')) {
			setcookie('lang', (string) $lang, ['expires' => time() + 31_536_000]);
			include_once 'language/lang-' . $lang . '.php';
			$currentlang = $lang;
		} else {
			setcookie('lang', (string) $language, ['expires' => time() + 31_536_000]);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} else {
		setcookie('lang', (string) $language, ['expires' => time() + 31_536_000]);
		include_once 'language/lang-' . $language . '.php';
		$currentlang = $language;
	}
}
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
if (isset($gfx)){
    switch($gfx) {
    case "gfx":
        include_once('includes/gfx.php');
        break;
    }
}
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
 $lgl_legalMenu = '';
if (is_active('Legal')) {
	include_once NUKE_CLASSES_DIR . 'class.legal_doctypes.php';
	if ($multilingual == 1 && isset($currentlang)) {
		$lang = $currentlang;
	} else {
		$lang = '';
	}
	$objDocTypes = new Legal_DocTypes('', $lang);
	$objDocTypes->setShowContact();
	$lgl_legalMenu = '<div class="lgl_menu">' . $objDocTypes->html() . '</div>';
}
if (!defined('LGL_MENU_HTML')) define('LGL_MENU_HTML', $lgl_legalMenu);
function get_lang($module) {
    global $currentlang, $language;
    if ($module == 'admin' AND $module != 'Forums') {
        if (file_exists('admin/language/lang-'.$currentlang.'.php')) {
            include_once('admin/language/lang-'.$currentlang.'.php');
        } elseif (file_exists('admin/language/lang-'.$language.'.php')) {
            include_once('admin/language/lang-'.$language.'.php');
        }
    } else {
        if (file_exists('modules/'.$module.'/language/lang-'.$currentlang.'.php')) {
            include_once('modules/'.$module.'/language/lang-'.$currentlang.'.php');
        } elseif (file_exists('modules/'.$module.'/language/lang-'.$language.'.php')) {
            include_once('modules/'.$module.'/language/lang-'.$language.'.php');
        }
    }
}

/**
* @get microtime
* @version 1.0.0
* @Platinum
* @author TheGhost
*/
function get_microtime() 
{
    list($usec, $sec) = explode(' ', microtime());
    return ($usec + $sec);
}

/**
* @define once
* @version 1.0.0
* @Platinum
* @author TheGhost
*/
function define_once($constant, $value) 
{
    if(!defined($constant)): 
      define($constant, $value);
	endif;
}

function is_admin($admin) {
    static $adminSave; 
    if (!$admin) { return 0; }
    if (isset($adminSave)) return $adminSave;
    if (!is_array($admin)) {
        $admin = base64_decode((string) $admin);
        $admin = addslashes($admin);
        $admin = explode(':', $admin);
    }
    $aid = $admin[0];
    $pwd = $admin[1];
    $aid = substr(addslashes((string) $aid), 0, 25);
    if (!empty($aid) && !empty($pwd)) {
        global $prefix, $db;
        $sql = "SELECT pwd FROM ".$prefix."_authors WHERE aid='$aid'";
        $result = $db->sql_query($sql);
        $pass = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($pass[0] == $pwd && !empty($pass[0])) {
        	return $adminSave = 1;
        }
    }
    return $adminSave = 0;
}
function is_user($user) {
    if (!$user) { return 0; }
    static $userSave; 
    if (isset($userSave)) return $userSave;
    if (!is_array($user)) {
        $user = base64_decode((string) $user);
        $user = addslashes($user);
        $user = explode(":", $user);
    }
    $uid = $user[0];
    $pwd = $user[2];
    $uid = intval($uid);
    if (!empty($uid) AND !empty($pwd)) {
        global $db, $user_prefix;
        $sql = "SELECT user_password FROM ".$user_prefix."_users WHERE user_id='$uid'";
        $result = $db->sql_query($sql);
        [$row] = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($row == $pwd && !empty($row)) { 
        	return $userSave = 1;
        }
    }
    return $userSave = 0;
}
function is_group($user, $name) {
          global $prefix, $db, $user_prefix, $cookie, $user;
     if (is_user($user)) {
          if(!is_array($user)) {
          $cookie = cookiedecode($user);
          $uid = intval($cookie[0]);
          } else {
          $uid = intval($user[0]);
          }
          $result = $db->sql_query("SELECT points FROM ".$user_prefix."_users WHERE user_id='$uid'");
          $row = $db->sql_fetchrow($result);
          $points = intval($row['points']);
          $db->sql_freeresult($result);
          $result2 = $db->sql_query("SELECT mod_group FROM ".$prefix."_modules WHERE title='$name'");
          $row2 = $db->sql_fetchrow($result2);
          $mod_group = intval($row2['mod_group']);
          $db->sql_freeresult($result2);
          $result3 = $db->sql_query("SELECT points FROM ".$prefix."_groups WHERE id='$mod_group'");
          $row3 = $db->sql_fetchrow($result3);
          $grp = intval($row3['points']);
          $db->sql_freeresult($result3);
          if (($points >= 0 AND $points >= $grp) OR $mod_group == 0) {
        	return 1;
          }
     }
     return 0;
}
if (!defined('ADMIN_FILE') && !file_exists('includes/nukesentinel.php')) {
    $postString = '';
    foreach ($_POST as $postkey => $postvalue) {
        if ($postString > '') {
            $postString .= '&'.$postkey.'='.$postvalue;
        } else {
            $postString .= $postkey.'='.$postvalue;
        }
    }
    str_replace('%09', '%20', $postString);
    $postString_64 = base64_decode($postString);
    if ((!isset($admin) OR (isset($admin) AND !is_admin($admin))) AND (stristr($postString,'%20union%20') OR stristr($postString,'*/union/*') OR      stristr($postString,' union ') OR stristr($postString_64,'%20union%20') OR stristr($postString_64,'*/union/*') OR stristr($postString_64,' union ') OR stristr($postString_64,'+union+') OR stristr($postString,'http-equiv') OR stristr($postString_64,'http-equiv') OR stristr($postString,'alert(') OR stristr($postString_64,'alert(') OR stristr($postString,'javascript:') OR stristr($postString_64,'javascript:') OR stristr($postString,'document.cookie') OR stristr($postString_64,'document.cookie') OR stristr($postString,'onmouseover=') OR stristr($postString_64,'onmouseover=') OR stristr($postString,'document.location') OR stristr($postString_64,'document.location'))) {
        header('Location: index.php');
        die();
    }
}
function update_points($id) {
  global $user_prefix, $prefix, $db, $user;
  if (is_user($user)) {
    if(!is_array($user)) {
      $cookie = cookiedecode($user);
      $username = trim((string) $cookie[1]);
    } else {
      $username = trim((string) $user[1]);
    }
    if ($db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_groups")) > '0') {
      $id = intval($id);
      $result = $db->sql_query("SELECT points FROM ".$prefix."_groups_points WHERE id='$id'");
      [$points] = $db->sql_fetchrow($result);
	  $db->sql_freeresult($result);
      $rpoints = intval($points);
      $db->sql_query("UPDATE ".$user_prefix."_users SET points=points+".$rpoints." WHERE username='$username'");
    }
  }
}
function title($text) {
    OpenTable();
    echo "<center><span class=\"title\"><strong>$text</strong></span></center>";
    CloseTable();
    echo "<br />";
}
// E.g. genAdminPanel('ABMain', _LANGCONSTANT);
function genAdminPanel($ModuleText, $text) {
	global $admin_file;
    OpenTable();
	echo '<div align="center">';
    echo '<a href="' . $admin_file . '.php">' . _GENADMIN . '</a><br />';
	echo '<a href="' . $admin_file . '.php?op=' . $ModuleText . '">' . $text . '</a><br />';
	echo '</div>';
    CloseTable();
    echo '<br />';
}
function is_active($module) {
    global $prefix, $db;
    static $save;
    if (is_array($save)) {
        if (isset($save[$module])) return ($save[$module]);
        return 0;
    }
    $sql = "SELECT title FROM ".$prefix."_modules WHERE active=1";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $save[$row[0]] = 1;
    }
    $db->sql_freeresult($result);
    if (isset($save[$module])) return ($save[$module]);
    return 0;
}
function render_blocks($side, $blockfile, $title, $content, $bid, $url) {
    if(!defined('BLOCK_FILE')) {
      define('BLOCK_FILE', true);
    }
	
    if(!defined('CORE_FILE')) {
      define('CORE_FILE', true);
    }
	
    if (empty($url)) {
        if (empty($blockfile)) {
            // GT-NExtGEn 0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
            //Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
            global $tnsl_bAutoTapBlocks;
            if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
                $content = tnsl_fShortenBlockURLs('', $content);
            }
            //End of GT-NExtGEn / ShortURLs
            if ($side == 'c') {
                themecenterbox($title, $content);
            } elseif ($side == 'd') {
                themecenterbox($title, $content);
            } else {
                themesidebox($title, $content);
            }
        } else {
            if ($side == 'c') {
                blockfileinc($title, $blockfile, 1);
            } elseif ($side == 'd') {
                blockfileinc($title, $blockfile, 1);
            } else {
                blockfileinc($title, $blockfile);
            }
        }
    } else {
        if ($side == 'c' OR $side == 'd') {
            headlines($bid,1);
        } else {
            headlines($bid);
        }
    }
}
function blocks($side) {
$pos = null;
 /*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
	global $storynum, $prefix, $multilingual, $currentlang, $db, $admin, $user, $name, $file, $home;
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
    if ($multilingual == 1) {
    	$querylang = "AND (blanguage='$currentlang' OR blanguage='')";
    } else {
    	$querylang = "";
    }
    if (strtolower((string) $side[0]) == "l") {
		$pos = "l";
    } elseif (strtolower((string) $side[0]) == "r") {
		$pos = "r";
    }  elseif (strtolower((string) $side[0]) == "c") {
		$pos = "c";
    } elseif  (strtolower((string) $side[0]) == "d") {
		$pos = "d";
    }
    $side = $pos;
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
    $sql = "SELECT * FROM ".$prefix."_blocks WHERE bposition='$pos' AND active='1' $querylang ORDER BY weight ASC";
    $result = $db->sql_query($sql);
    while($row = $db->sql_fetchrow($result)) {
        $groups = $row['groups'];
	$bid = intval($row['bid']);
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	$title = stripslashes((string) check_html($row['title'], "nohtml"));
	$content = stripslashes((string) $row['content']);
	$url = stripslashes((string) $row['url']);
	$blockfile = $row['blockfile'];
	$view = intval($row['view']);
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
		$display = $row['display'];
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
	$expire = intval($row['expire']);
	$action = $row['action'];
        $action = substr("$action", 0,1);
	    $now = time();
	    $sub = intval($row['subscription']);
	    if ($sub == 0 OR ($sub == 1 AND !paid())) {
		    if ($expire != 0 AND $expire <= $now) {
		        if ($action == "d") {
		            $db->sql_query("UPDATE ".$prefix."_blocks SET active='0', expire='0' WHERE bid='$bid'");
		            return;
		        } elseif ($action == "r") {
		            $db->sql_query("DELETE FROM ".$prefix."_blocks WHERE bid='$bid'");
		            return;
		        }
		    }
			if ($row['bkey'] == "admin") {
			    adminblock();
			} elseif ($row['bkey'] == "userbox") {
			    userblock();
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
			} elseif (empty($row['bkey']) AND ($display == $name OR $display == "All") AND (($side != "c" AND $side != "d") OR (($side == "c" OR $side == "d") AND ($file == "index" OR $home == 1)))) {
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
			    if ($view == 0) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
			    } elseif ($view == 1 AND is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
			    } elseif ($view == 2 AND is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
	    } elseif ($view == 3 AND !is_user($user) || is_admin($admin)) {
		render_blocks($side, $blockfile, $title, $content, $bid, $url);
            } elseif ($view > 3 AND in_groups($groups)) {
                render_blocks($side, $blockfile, $title, $content, $bid, $url);
	    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
			}
	    }
    }
    $db->sql_freeresult($result);
}
function message_box() {
    global $bgcolor1, $bgcolor2, $user, $admin, $cookie, $textcolor2, $prefix, $multilingual, $currentlang, $db, $admin_file;
    if ($multilingual == 1) {
		$querylang = "AND (mlanguage='$currentlang' OR mlanguage='')";
    } else {
		$querylang = "";
    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
    $result = $db->sql_query("SELECT * FROM ".$prefix."_message WHERE active='1' $querylang");
    if ($numrows = $db->sql_numrows($result) == 0) {
		return;
    } else {
	while ($row = $db->sql_fetchrow($result)) {
            $groups = $row['groups'];
	    $mid = intval($row['mid']);
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	    $title = stripslashes((string) check_html($row['title'], "nohtml"));
	    $content = stripslashes((string) $row['content']);
	    $mdate = $row['date'];
	    $expire = intval($row['expire']);
	    $view = intval($row['view']);
	if (!empty($title) && !empty($content)) {
	    if ($expire == 0) {
		$remain = _UNLIMITED;
	    } else {
		$etime = (($mdate+$expire)-time())/3600;
		$etime = (int)$etime;
		if ($etime < 1) {
		    $remain = _EXPIRELESSHOUR;
		} else {
		    $remain = ""._EXPIREIN." $etime "._HOURS."";
		}
	    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
            if ($view > 5 AND in_groups($groups)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n";
                echo "<font class=\"content\">$content</font>\n";
                if (is_admin($admin)) {
                    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWGROUPS." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>\n";
                }
                CloseTable();
                echo "<br />\n";
            // Copyright (c) 2000-2004 by NukeScripts Network
            } elseif ($view == 5 AND paid()) {
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
            OpenTable();
            echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    	."<font class=\"content\">$content</font>";
			if (is_admin($admin)) {
		    	echo "<br /><br /><center><font class=\"content\">[ "._MVIEWSUBUSERS." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
			}
    		CloseTable();
			echo "<br />";
	    } elseif ($view == 4 AND is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>"
		    ."<br /><br /><center><font class=\"content\">[ "._MVIEWADMIN." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		CloseTable();
		echo "<br />";
	    } elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWUSERS." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
    		CloseTable();
		echo "<br />";
	    } elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWANON." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br />";
	    } elseif ($view == 1) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><strong>$title</strong></font></center><br />\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br /><br /><center><font class=\"content\">[ "._MVIEWALL." - $remain - <a href=\"".$admin_file.".php?op=editmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br />";
	    }
	    if ($expire != 0) {
	    	$past = time()-$expire;
		if ($mdate < $past) {
		    $db->sql_query("UPDATE ".$prefix."_message SET active='0' WHERE mid='$mid'");
		}
		}
	    }
	}
    }
}
function online() {
  global $nsnst_const, $user, $cookie, $prefix, $db, $userinfo, $name, $identify;
  	if(!file_exists('includes/nukesentinel.php')) {
	$ip = $identify->get_ip();
		} else {
    	$ip = $nsnst_const['remote_ip'];
  		}
    $url = $_SERVER['REQUEST_URI']; 
	$uname = $ip;
    $guest = 1;
	$user_agent = $identify->identify_agent();	
    if (is_user($user)) {
        $uname = $userinfo['username'];
        $guest = 0;
/*****[BEGIN]******************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
    } elseif($user_agent['engine'] == 'bot') {
        $uname = $user_agent['bot'];
        $guest = 3;
    }
/*****[END]********************************************
 [ Base:    Advanced Security Extension        v1.0.0 ]
 ******************************************************/
    $past = time()-300;
    $db->sql_query("DELETE FROM ".$prefix."_session WHERE time < '".$past."'");
    $result = $db->sql_query("SELECT time FROM ".$prefix."_session WHERE uname='$uname'");
    $ctime = time();
    $custom_title = addslashes((string) $name);
    $url = preg_replace("/&/", "/&/", (string) $url);
    if ($uname!="") {
    $uname = substr("$uname", 0,25);
    if ($row = $db->sql_fetchrow($result)) {
	$db->sql_query("UPDATE ".$prefix."_session SET uname='$uname', time='$ctime', host_addr='$ip', guest='$guest', module='$custom_title', url='$url' WHERE uname='$uname'");
    } else {
	$db->sql_query("INSERT INTO ".$prefix."_session (uname, time, host_addr, guest, module, url) VALUES ('$uname', '$ctime', '$ip', '$guest', '$custom_title', '$url')");
    }
  }
}
function blockfileinc($title, $blockfile, $side=0) {
    $blockfiletitle = $title;
    $file = file_exists('blocks/'.$blockfile);
    if (!$file) {
        $content = _BLOCKPROBLEM;
    } else {
        include_once('blocks/'.$blockfile);
    }
    if (empty($content)) {
        $content = _BLOCKPROBLEM2;
    } else { //Added by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
        global $tnsl_bAutoTapBlocks;
        if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
            $content = tnsl_fShortenBlockURLs($blockfile, $content);
        }
    }
    //End of TegoNuke(tm) ShortLinks
    if ($side == 1) {
        themecenterbox($blockfiletitle, $content);
    } elseif ($side == 2) {
        themecenterbox($blockfiletitle, $content);
    } else {
        themesidebox($blockfiletitle, $content);
    }
}
function selectlanguage() {
    $menulist = [];
    $languageslist = [];
    global $useflags, $currentlang;
    if ($useflags == 1) {
    $title = _SELECTLANGUAGE;
    $content = "<center><font class=\"content\">"._SELECTGUILANG."<br /><br />";
    $langdir = dir("language");
    while($func=$langdir->read()) {
	if(str_starts_with($func, "lang-")) {
    	    $menulist .= "$func ";
	}
    }
    closedir($langdir->handle);
    $menulist = explode(" ", (string) $menulist);
    sort($menulist);
    for ($i=0; $i < sizeof($menulist); $i++) {
        if($menulist[$i]!="") {
	    $tl = str_replace("lang-","",$menulist[$i]);
	    $tl = str_replace(".php","",$tl);
	    $altlang = ucfirst($tl);
	    $content .= "<a href=\"index.php?newlang=".$tl."\"><img src=\"images/language/flag-".$tl.".png\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\"></a> ";
	}
    }
    $content .= "</font></center>";
    themesidebox($title, $content);
	} else {
    $title = _SELECTLANGUAGE;
    $content = "<center><font class=\"content\">"._SELECTGUILANG."<br /><br /></font>";
    $content .= "<form action=\"index.php\" method=\"get\"><select name=\"newlanguage\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
	    $handle=opendir('language');
	    while ($file = readdir($handle)) {
		if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	            $langFound = $matches[1];
	            $languageslist .= "$langFound ";
	        }
	    }
	    closedir($handle);
	    $languageslist = explode(" ", (string) $languageslist);
	    sort($languageslist);
	    for ($i=0; $i < sizeof($languageslist); $i++) {
		if($languageslist[$i]!="") {
	$content .= "<option value=\"index.php?newlang=$languageslist[$i]\" ";
		if($languageslist[$i]==$currentlang) $content .= " selected";
	$content .= ">".ucfirst($languageslist[$i])."</option>\n";
		}
    }
    $content .= "</select></form></center>";
    themesidebox($title, $content);
	}
}
function ultramode() {
	global $prefix, $db;
	$ultra = "ultramode.txt";
	$file = fopen($ultra, "w");
	fwrite($file, "General purpose self-explanatory file with news headlines\n");
	$sql = "SELECT sid, aid, title, time, comments, topic FROM ".$prefix."_stories ORDER BY time DESC LIMIT 0,10";
	$result = $db->sql_query($sql);
	while ([$rsid, $raid, $rtitle, $rtime, $rcomments, $rtopic] = $db->sql_fetchrow($result)) {
		$rsid = intval($rsid);
		$rtitle = stripslashes((string) check_html($rtitle, "nohtml"));
		$rcomments = stripslashes((string) $rcomments);
		$rtopic = intval($rtopic);
		$sql = "select topictext, topicimage from ".$prefix."_topics where topicid='$rtopic'";
                $query = $db->sql_query($sql);
		[$topictext, $topicimage] = $db->sql_fetchrow($query);
		$topictext = stripslashes((string) check_html($topictext, "nohtml"));
		$content = "%%\n$rtitle\n/modules.php?name=News&file=article&sid=$rsid\n$rtime\n$raid\n$topictext\n$rcomments\n$topicimage\n";
		fwrite($file, $content);
	}
	fclose($file);
	$db->sql_freeresult($result);
}
function cookiedecode($user) {
    global $cookie, $db, $user_prefix;
    static $pass;
    if(!is_array($user)) {
        $user = base64_decode((string) $user);
        $user = addslashes($user);
        $cookie = explode(":", $user);
    } else {
        $cookie = $user;
    }
    if (!isset($pass)) {
       $sql = "SELECT user_password FROM ".$user_prefix."_users WHERE username='$cookie[1]'";
       $result = $db->sql_query($sql);
       [$pass] = $db->sql_fetchrow($result);
       $db->sql_freeresult($result);
    }
    if ($cookie[2] == $pass && !empty($pass)) { return $cookie; }
}
function getusrinfo($user) {
    global $user_prefix, $db, $userinfo, $cookie;
    if (!$user OR empty($user)) {
      return NULL;
    }
    cookiedecode($user);
    $user = $cookie;
    if (isset($userrow) AND is_array($userrow)) {
        if ($userrow['username'] == $user[1] && $userrow['user_password'] == $user[2]) {
            return $userrow;
        }
    }
    $sql = "SELECT * FROM ".$user_prefix."_users WHERE username='$user[1]' AND user_password='$user[2]'";
    $result = $db->sql_query($sql);
    if ($db->sql_numrows($result) == 1) {
        static $userrow;
        $userrow = $db->sql_fetchrow($result);
        return $userinfo = $userrow;
    }
    $db->sql_freeresult($result);
    unset($userinfo);
}
function FixQuotes ($what = "") {
	$what = str_replace("'","''",(string) $what);
	while (stripos_clone($what, "\\\\'")) {
		$what = str_replace("\\\\'","'",$what);
	}
	return $what;
}
/*********************************************************/
/* text filter                                           */
/*********************************************************/
function check_words($Message) {
    global $CensorMode, $CensorReplace, $EditedMessage, $CensorList;
    include_once("config.php");
    $EditedMessage = $Message;
    if ($CensorMode != 0) {
	if (is_array($CensorList)) {
	    $Replace = $CensorReplace;
	    if ($CensorMode == 1) {
		for ($i = 0; $i < count($CensorList); $i++) {
		    $EditedMessage = preg_replace("/$CensorList[$i]([^a-zA-Z0-9])/","$Replace\\1",(string) $EditedMessage);
		}
	    } elseif ($CensorMode == 2) {
		for ($i = 0; $i < count($CensorList); $i++) {
		    $EditedMessage = preg_replace("/(^|[^[:alnum:]])$CensorList[$i]/","\\1$Replace",(string) $EditedMessage);
		}
	    } elseif ($CensorMode == 3) {
		for ($i = 0; $i < count($CensorList); $i++) {
		    $EditedMessage = preg_replace("/$CensorList[$i]/","$Replace",(string) $EditedMessage);
		}
	    }
	}
    }
    return $EditedMessage;
}
function delQuotes($string){
    /* no recursive function to add quote to an HTML tag if needed */
    /* and delete duplicate spaces between attribs. */
    $tmp="";    # string buffer
    $result=""; # result string
    $i=0;
    $attrib=-1; # Are us in an HTML attrib ?   -1: no attrib   0: name of the attrib   1: value of the atrib
    $quote=0;   # Is a string quote delimited opened ? 0=no, 1=yes
    $len = strlen((string) $string);
    while ($i<$len) {
	switch($string[$i]) { # What car is it in the buffer ?
	    case "\"": #"       # a quote.
		if ($quote==0) {
		    $quote=1;
		} else {
		    $quote=0;
		    if (($attrib>0) && (!empty($tmp))) { $result .= "=\"$tmp\""; }
		    $tmp="";
		    $attrib=-1;
		}
		break;
	    case "=":           # an equal - attrib delimiter
		if ($quote==0) {  # Is it found in a string ?
		    $attrib=1;
		    if ($tmp!="") $result.=" $tmp";
		    $tmp="";
		} else $tmp .= '=';
		break;
	    case " ":           # a blank ?
		if ($attrib>0) {  # add it to the string, if one opened.
		    $tmp .= $string[$i];
		}
		break;
	    default:            # Other
		if ($attrib<0)    # If we weren't in an attrib, set attrib to 0
		$attrib=0;
		$tmp .= $string[$i];
		break;
	}
	$i++;
    }
    if (($quote!=0) && (!empty($tmp))) {
	if ($attrib==1) $result .= "=";
	/* If it is the value of an atrib, add the '=' */
	$result .= "\"$tmp\"";  /* Add quote if needed (the reason of the function ;-) */
    }
    return $result;
}
function check_html ($string, $allowed_html = "", $allowed_protocols = ['http', 'https', 'ftp', 'news', 'nntp', 'gopher', 'mailto'])
{ 
	$stop = FALSE;
	if(!function_exists('kses_no_null'))
	{
		include_once("includes/kses/kses.php");
	}
	//if (get_magic_quotes_gpc() == 1 )
	//{ 
	//	$string = stripslashes((string) $string ); 
	//} 
	$hotHtml = "nohtml"; 
	$Zstrip = stripos_clone($allowed_html, $hotHtml); 
	if ($Zstrip === false)
	{ 
		global $AllowableHTML;
		$allowed_html = $AllowableHTML; 
	} else { 
		$allowed_html = ['<null>']; 
	}
	$string = kses_no_null($string); 
	$string = kses_js_entities($string); 
	$string = kses_normalize_entities($string); 
	$string = kses_hook($string); 
	$allowed_html_fixed = kses_array_lc($allowed_html);
	return kses_split($string, $allowed_html_fixed, $allowed_protocols); 
} 
/*********************************************************/
/* wysigys text area START                               */
/*********************************************************/
/* CKEditor replaces FCKeditor- sgtmudd */ 	
function wysiwyg_textarea($name, $value, $config = "NukeUser", $cols = 50, $rows = 10)
{
   global $advanced_editor;
   # Don't waste bandwidth by loading WYSIWYG editor for crawlers
   if ($advanced_editor == 0 or !isset($_COOKIE))
   {
       echo "<textarea name=\"$name\" cols=\"$cols\" rows=\"$rows\">$value</textarea>";
   } else {
    @include_once("includes/ckeditor/ckeditor.php");
	@require_once("includes/ckfinder/ckfinder.php");
	$CKEditor = new CKEditor();
	$CKEditor->returnOutput = true;
	CKFinder::SetupCKEditor($CKEditor);
	$code = $CKEditor->editor($name,$value);
	echo $code;
   } 
}
function wysiwyg_textarea_html($name, $value, $config = "NukeUser", $cols = 50, $rows = 10)
{
   global $advanced_editor;
   # Don't waste bandwidth by loading WYSIWYG editor for crawlers
   if ($advanced_editor == 0 or !isset($_COOKIE))
   {
       echo "<textarea name=\"$name\" cols=\"$cols\" rows=\"$rows\">$value</textarea>";
   } else {
    @include_once("includes/ckeditor/ckeditor.php");
	@require_once("includes/ckfinder/ckfinder.php");
	$CKEditor = new CKEditor();
	$CKEditor->returnOutput = true;
	CKFinder::SetupCKEditor($CKEditor);
	$code = $CKEditor->editor($name,$value);
	echo $code;
   }
}
/*********************************************************/
/* wysigys text area END                                 */
/*********************************************************/
function filter_text($Message, $strip="") {
    global $EditedMessage;
    check_words($Message);
    $EditedMessage=check_html($EditedMessage, $strip);
    return $EditedMessage;
}
function filter($what, $strip="", $save="", $type="") {
    if ($strip == "nohtml") {
        $what = check_html($what, $strip);
        $what = htmlentities(trim((string) $what), ENT_QUOTES);
        // If the variable $what doesn't comes from a preview screen should be converted
        if ($type != "preview" AND $save != 1) {
            $what = html_entity_decode($what, ENT_QUOTES);
        }
    }
    if ($save == 1) {
        $what = check_words($what);
        $what = check_html($what, $strip);
        $what = addslashes((string) $what);
    } else {
        $what = stripslashes((string) FixQuotes($what));
        $what = check_words($what);
        $what = check_html($what, $strip);
    }
    return($what);
}
/*********************************************************/
/* formatting stories                                    */
/*********************************************************/
function formatTimestamp($time) {
    global $datetime, $locale;
    setlocale(LC_TIME, $locale);
    if (!is_numeric($time)) {
        preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', (string) $time, $datetime);
        $time = gmmktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
    }
    $time -= date("Z");
    $datetime = strftime(_DATESTRING, $time);
    $datetime = ucfirst($datetime);
    return $datetime;
}
function formatAidHeader($aid) {
global $prefix, $db;
    static $users;
    if (isset($users[$aid]) AND is_array($users[$aid])) {
        $row = $users[$aid];
    } else {
        $sql = "SELECT url, email FROM ".$prefix."_authors WHERE aid='$aid'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $users[$aid] = $row;
        $db->sql_freeresult($result);
    }
    $aidurl = stripslashes((string) $row['url']);
    $aidmail = encode_mail(stripslashes((string) $row['email']));
    if ((isset($aidurl)) && ($aidurl != "http://")) {
        $aid = "<a href=\"".$aidurl."\">$aid</a>";
    } elseif (isset($aidmail)) {
        $aid = "<a href=\"mailto:".$aidmail."\">$aid</a>";
    } else {
        $aid = $aid;
    }
    echo $aid;
}
function get_author($aid) {
global $prefix, $db;
    static $users;
    if (isset($users[$aid]) AND is_array($users[$aid])) {
        $row = $users[$aid];
    } else {
        $sql = "SELECT url, email FROM ".$prefix."_authors WHERE aid='$aid'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $users[$aid] = $row;
        $db->sql_freeresult($result);
    }
    $aidurl = stripslashes((string) $row['url']);
    $aidmail = encode_mail(stripslashes((string) $row['email']));
    if ((isset($aidurl)) && ($aidurl != "http://")) {
        $aid = "<a href=\"".$aidurl."\">$aid</a>";
    } elseif (isset($aidmail)) {
        $aid = "<a href=\"mailto:".$aidmail."\">$aid</a>";
    } else {
        $aid = $aid;
    }
    return $aid;
}
if(!defined('FORUM_ADMIN')) {
  $ThemeSel = get_theme();
  include_once("themes/$ThemeSel/theme.php");
}
if(!function_exists("themepreview")) {
  function themepreview($title, $hometext, $bodytext="", $notes="") {
    echo "<strong>$title</strong><br /><br />$hometext";
    if (!empty($bodytext)) {
		echo "<br /><br />$bodytext";
    }
    if (!empty($notes)) {
		echo "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>";
    }
  }
}
function adminblock() {
	global $admin, $prefix, $db, $admin_file;
	if (is_admin($admin)) {
	        $sql = "SELECT title, content FROM ".$prefix."_blocks WHERE bkey='admin'";
		$result = $db->sql_query($sql);
		while ([$title, $content] = $db->sql_fetchrow($result)) {
			$content = "<span class=\"content\">".$content."</span>";
			themesidebox($title, $content);
		}
		$title = _WAITINGCONT;
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_queue"));
		$content = "<span class=\"content\">";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=submissions\">"._SUBMISSIONS."</a>: $num<br />";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_reviews_add"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=reviews\">"._WREVIEWS."</a>: $num<br />";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_newlink"));
		$brokenl = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='1'"));
		$modreql = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='0'"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=Links\">"._WLINKS."</a>: $num<br />";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=LinksListModRequests\">"._MODREQLINKS."</a>: $modreql<br />";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">"._BROKENLINKS."</a>: $brokenl<br />";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_newdownload"));
		$brokend = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='1'"));
		$modreqd = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='0'"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=downloads\">"._UDOWNLOADS."</a>: $num<br />";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListModRequests\">"._MODREQDOWN."</a>: $modreqd<br />";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListBrokenDownloads\">"._BROKENDOWN."</a>: $brokend<br /></span>";
		themesidebox($title, $content);
	}
}
function loginbox($gfx_check) {
    global $user, $sitekey, $gfx_chk;
    mt_srand ((double)microtime()*1_000_000);
    $maxran = 1_000_000;
    $random_num = random_int(0, $maxran);
    $datekey = date('F j');
    $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    if (!is_user($user)) {
        $title = _LOGIN;
        $boxstuff = '<form action="modules.php?name=Your_Account" method="post">';
        $boxstuff .= '<center><font class="content">'._NICKNAME.'<br />';
        $boxstuff .= '<input type="text" name="username" size="8" maxlength="25" /><br />';
        $boxstuff .= _PASSWORD.'<br />';
        $boxstuff .= '<input type="password" name="user_password" size="8" maxlength="20" /><br />';
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        $boxstuff .= security_code([2, 4, 5, 7], 'stacked');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        $boxstuff .= '<input type="hidden" name="op" value="login" />';
        $boxstuff .= '<input type="submit" value="'._LOGIN.'" /></font></center></form>';
        $boxstuff .= '<center><font class="content">'._ASREGISTERED.'</font></center>';
        themesidebox($title, $boxstuff);
    }
}
function userblock() {
  global $user, $cookie, $db, $user_prefix, $userinfo;
  if(is_user($user)) {
    getusrinfo($user);
    if($userinfo['ublockon']) {
      $sql = "SELECT ublock FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'";
      $result = $db->sql_query($sql);
      [$ublock] = $db->sql_fetchrow($result);
      $title = _MENUFOR." ".$cookie[1];
      themesidebox($title, $ublock);
    }
  }
}
function getTopics($s_sid) {
	global $topicname, $topicimage, $topictext, $prefix, $db;
	$sid = intval($s_sid);
	$query = $db->sql_query("SELECT topic FROM ".$prefix."_stories WHERE sid='$sid'");
	[$rtopic] = $db->sql_fetchrow($query);
	$result2 = $db->sql_query("SELECT topicid, topicname, topicimage, topictext FROM ".$prefix."_topics WHERE topicid='$rtopic'");
	[$topicid, $topicname, $topicimage, $topictext] = $db->sql_fetchrow($result2);
	$topicid = intval($topicid);
	$topictext = stripslashes((string) check_html($topictext, "nohtml"));
}
function headlines($bid, $cenbox=0) {
    $cont = null;
    global $prefix, $db;
    $bid = intval($bid);
    $result = $db->sql_query("SELECT title, content, url, refresh, time FROM ".$prefix."_blocks WHERE bid='$bid'");
    [$title, $content, $url, $refresh, $otime] = $db->sql_fetchrow($result);
    $title = stripslashes((string) check_html($title, "nohtml"));
    $content = stripslashes((string) $content);
    $refresh = intval($refresh);
    $past = time()-$refresh;
    if ($otime < $past) {
	$btime = time();
	$rdf = parse_url((string) $url);
	$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
	if (!$fp) {
	    $content = "";
	    $db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
	    $cont = 0;
	    if ($cenbox == 0) {
		themesidebox($title, $content);
	    } else {
		themecenterbox($title, $content);
	    }
	    return;
	}
	if ($fp) {
	    if (!empty($rdf['query']))
	        $rdf['query'] = "?" . $rdf['query'];
	    fputs($fp, "GET " . $rdf['path'] . $rdf['query'] . " HTTP/1.0\r\n");
	    fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
	    $string	= "";
	    while(!feof($fp)) {
	    	$pagetext = fgets($fp,300);
	    	$string .= chop($pagetext);
	    }
	    fputs($fp,"Connection: close\r\n\r\n");
	    fclose($fp);
	    $items = explode("</item>",$string);
	    $content = "<font class=\"content\">";
	    for ($i=0;$i<10;$i++) {
		$link = preg_replace("/.*<link>/","",$items[$i]);
		$link = preg_replace("#</link>.*#","",$link);
		$title2 = preg_replace("/.*<title>/","",$items[$i]);
		$title2 = preg_replace("#</title>.*#","",$title2);
		$title2 = stripslashes($title2);
		if (empty($items[$i]) AND $cont != 1) {
		    $content = "";
		    $db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
		    $cont = 0;
		    if ($cenbox == 0) {
			themesidebox($title, $content);
		    } else {
			themecenterbox($title, $content);
		    }
		    return;
		} else {
		    if (strcmp($link,$title2) AND !empty($items[$i])) {
			$cont = 1;
			$content .= "<strong><big>&middot;</big></strong><a href=\"$link\" target=\"new\">$title2</a><br />\n";
		    }
		}
	    }
	}
	$db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
    }
    $siteurl = str_replace("http://","",(string) $url);
    $siteurl = explode("/",$siteurl);
    if (($cont == 1) OR (!empty($content))) {
	$content .= "<br /><a href=\"http://$siteurl[0]\" target=\"blank\"><strong>"._HREADMORE."</strong></a></font>";
    } elseif (($cont == 0) OR (empty($content))) {
	$content = "<font class=\"content\">"._RSSPROBLEM."</font>";
    }
    if ($cenbox == 0) {
	themesidebox($title, $content);
    } else {
	themecenterbox($title, $content);
    }
}
function automated_news() { 
   $tags = [];
   global $prefix, $multilingual, $currentlang, $db; 
   if ($multilingual == 1) { 
      $querylang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */ 
   } else { 
      $querylang = ''; 
   } 
   $today = getdate(); 
   $day = $today['mday']; 
   if ($day < 10) { 
      $day = '0'.$day; 
   } 
   $month = $today['mon']; 
   if ($month < 10) { 
      $month = '0'.$month; 
   } 
   $year = $today['year']; 
   $hour = $today['hours']; 
   $min = $today['minutes']; 
   $sec = '00'; 
   $result = $db->sql_query('SELECT anid, time FROM '.$prefix.'_autonews '.$querylang); 
   while ([$anid, $time] = $db->sql_fetchrow($result)) { 
      preg_match('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', (string) $time, $date); 
      if (($date[1] <= $year) AND ($date[2] <= $month) AND ($date[3] <= $day)) { 
         if (($date[4] < $hour) AND ($date[5] >= $min) OR ($date[4] <= $hour) AND ($date[5] <= $min)) { 
            $result2 = $db->sql_query('SELECT * FROM '.$prefix.'_autonews WHERE anid=\''.$anid.'\''); 
            while ($row2 = $db->sql_fetchrow($result2)) { 
               $title = stripslashes((string) FixQuotes(check_html($row2['title'], 'nohtml'))); 
               $hometext = stripslashes((string) FixQuotes($row2['hometext'])); 
               $bodytext = stripslashes((string) FixQuotes($row2['bodytext'])); 
               $notes = stripslashes((string) FixQuotes($row2['notes'])); 
               $catid2 = intval($row2['catid']); 
               $aid2 = $row2['aid']; 
               $time2 = $row2['time']; 
               $topic2 = $row2['topic']; 
               $informant2 = $row2['informant']; 
               $ihome2 = intval($row2['ihome']); 
               $alanguage2 = $row2['alanguage']; 
               $acomm2 = intval($row2['acomm']); 
               $associated2 = $row2['associated']; 
               $num = $db->sql_numrows($db->sql_query('SELECT sid FROM '.$prefix.'_stories WHERE title=\''.$title.'\'')); 
               if ($num == 0) { 
                  $db->sql_query('DELETE FROM '.$prefix.'_autonews WHERE anid=\''.$anid.'\''); 
                  $db->sql_query('INSERT INTO '.$prefix.'_stories VALUES (NULL, \''.$catid2.'\', \''.$aid2.'\', \''.$title.'\', \''.$time2.'\', \''.$hometext.'\', \''.$bodytext.'\', 0, 0, \''.$topic2.'\', \''.$informant2.'\', \''.$notes.'\', \''.$ihome2.'\', \''.$alanguage2.'\', \''.$acomm2.'\', 0, 0, 0, 0, \''.$associated2.'\')'); 
         //Start tags 
               $sql_tags_autonews = $db->sql_query("SELECT tag FROM " . $prefix . 
                            "_tags_temp WHERE whr=5 AND cid='$anid'"); 
                        if ($sql_tags_autonews) { 
                            $tags_autonews = $db->sql_fetchrow($db->sql_query("SELECT sid FROM " . $prefix . 
                                "_stories WHERE title='$title' LIMIT 1")); 
                            $lastid = intval($tags_autonews['sid']); 
                            while ($row = $db->sql_fetchrow($sql_tags_autonews)) { 
                                $tags[] = $row['tag']; 
                            } 
                            foreach ($tags as $tag) { 
                                $tag = addslashes((string) check_words(check_html($tag, "nohtml"))); 
                                $db->sql_query("INSERT INTO " . $prefix . "_tags (tag,cid,whr) VALUES ('" . trim 
                                    ($tag) . "', '$lastid', '3')"); 
                            } 
                            $db->sql_query("DELETE FROM " . $prefix . "_tags_temp WHERE cid='$anid' AND whr='5'"); 
                        } 
                        //End tags          
               } 
            } 
         } 
      } 
   } 
}
if(!defined('FORUM_ADMIN')) {
  $ThemeSel = get_theme();
  include_once("themes/$ThemeSel/theme.php");
}
if(!function_exists("themecenterbox")) {
  function themecenterbox($title, $content) {
    OpenTable();
    echo "<center><font class=\"option\"><strong>$title</strong></font></center><br />$content";
    CloseTable();
    echo "<br />";
  }
}
function public_message() {
    $t_off = null;
    $public_msg = null;
    global $prefix, $user_prefix, $db, $user, $admin, $p_msg, $cookie, $broadcast_msg;
    if ($broadcast_msg == 1) {
    if (is_user($user)) {
        cookiedecode($user);
        $result = $db->sql_query("SELECT broadcast FROM ".$user_prefix."_users WHERE username='$cookie[1]'");
	$row = $db->sql_fetchrow($result);
	$upref = $row['broadcast'];
	if ($upref == 1) {
	    $t_off = "<br /><p align=\"right\">[ <a href=\"modules.php?name=Your_Account&amp;op=edithome\">";
	    $t_off .= "<font size=\"2\">"._TURNOFFMSG."</font></a> ]";
	    $pm_show = 1;
	} else {
	    $pm_show = 0;
	}
    } else {
	$t_off = "";
    }
    if (!is_user($user) OR (is_user($user) AND ($pm_show == 1))) {
	$c_mid = base64_decode((string) $p_msg);
	$c_mid = addslashes($c_mid);
	$c_mid = intval($c_mid);
        $result2 = $db->sql_query("SELECT mid, content, date, who FROM ".$prefix."_public_messages WHERE mid > '$c_mid' ORDER BY date ASC LIMIT 1");
	$row2 = $db->sql_fetchrow($result2);
	$mid = intval($row2['mid']);
	$content = $row2['content'];
	$tdate = $row2['date'];
	$who = $row2['who'];
	if ((!isset($c_mid)) OR ($c_mid = $mid)) {
    	    $public_msg = "<br /><table width=\"90%\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\" bgcolor=\"FFFFFF\" align=\"center\"><tr><td>\n";
    	    $public_msg .= "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"FF0000\"><tr><td>\n";
    	    $public_msg .= "<font color=\"FFFFFF\" size=\"3\"><strong>"._BROADCASTFROM." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$who\"><font color=\"FFFFFF\" size=\"3\">$who</font></a>: \"$content\"</strong>";
	    $public_msg .= "$t_off";
	    $public_msg .= "</td></tr></table>";
    	    $public_msg .= "</td></tr></table>";
	    $ref_date = $tdate+600;
	    $actual_date = time();
	    if ($actual_date >= $ref_date) {
		$public_msg = "";
		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_public_messages"));
		if ($numrows == 1) {
		    $db->sql_query("DELETE FROM ".$prefix."_public_messages");
		    $mid = 0;
		} else {
		    $db->sql_query("DELETE FROM ".$prefix."_public_messages WHERE mid='$mid'");
		}
	    }
	    if ($mid == 0 OR empty($mid)) {
		setcookie("p_msg");
	    } else {
    		$mid = base64_encode($mid);
    		$mid = addslashes($mid);
		setcookie("p_msg",$mid,['expires' => time()+600]);
	    }
	}
    }
    } else {
		$public_msg = "";
    }
	return $public_msg;
}
function get_theme() {
global $user, $userinfo, $Default_Theme, $name, $op; 
    if(is_user($user) && ($name != "Your_Account" || $op != "logout")) { 
       if (isset($ThemeSelSave)) return $ThemeSelSave;
        getusrinfo($user);
        if(empty($userinfo['theme'])) $userinfo['theme']=$Default_Theme;
        if(file_exists("themes/".$userinfo['theme']."/theme.php")) {
            $ThemeSel = $userinfo['theme'];
        } else {
            $ThemeSel = $Default_Theme;
        }
    } else {
        $ThemeSel = $Default_Theme;
    }
    static $ThemeSelSave;
    $ThemeSelSave = $ThemeSel;
    return $ThemeSelSave;
}
function removecrlf($str) {
    // Function for Security Fix by Ulf Harnhammar, VSU Security 2002
    // Looks like I don't have so bad track record of security reports as Ulf believes
    // He decided to not contact me, but I'm always here, digging on the net
    return strtr($str, "\015\012", ' ');
}
function validate_mail($email) {
  if(strlen((string) $email) < 7 || !preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", (string) $email)) {
     //include_once("header.php");
     OpenTable();
     echo _ERRORINVEMAIL;
     CloseTable();
     //include_once("footer.php");
  }
  else {
     return $email;
  }
}
function encode_mail($email) {
  $finished = "";
  for($i=0; $i<strlen((string) $email); ++$i) {
    $n = random_int(0, 1);
    if($n) {
      $finished .= '&#x'.sprintf("%X",ord($email[$i])).';';
    }
    else {
      $finished .= '&#'.ord($email[$i]).';';
    }
  }
  return $finished;
}
function paid() {
	global $db, $user, $cookie, $adminmail, $sitename, $nukeurl, $subscription_url, $user_prefix, $prefix;
	if (is_user($user)) {
		if (!empty($subscription_url)) {
			$renew = ""._SUBRENEW." $subscription_url";
		} else {
			$renew = "";
		}
		cookiedecode($user);
		$sql = "SELECT * FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]'";
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		if ($numrows == 0) {
			return 0;
		} elseif ($numrows != 0) {
			$time = time();
			if ($row['subscription_expire'] <= $time) {
				$db->sql_query("DELETE FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]' AND id='".intval($row['id'])."'");
				$from = "$sitename <$adminmail>";
				$subject = "$sitename: "._SUBEXPIRED."";
				$body = ""._HELLO." $cookie[1]:\n\n"._SUBSCRIPTIONAT." $sitename "._HASEXPIRED."\n$renew\n\n"._HOPESERVED."\n\n$sitename "._TEAM."\n$nukeurl";
				$row = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE id='$cookie[0]' AND nickname='$cookie[1]' AND password='$cookie[2]'"));
				mail((string) $row['user_email'], $subject, $body, "From: $from\nX-Mailer: PHP/" . phpversion());
			}
			return 1;
		}
	} else {
		return 0;
	}
}
function platinum_technology() {
    $currenttime = null;
    global $db, $prefix, $mainprefix;
    $vcheck = $db->sql_fetchrow($db->sql_query("SELECT value from ".$prefix."_platinum_technology where name = 'versioncheck'"));
    $last_check = $db->sql_fetchrow($db->sql_query("SELECT value from ".$prefix."_platinum_technology where name = 'lastupdatecheck'"));
    if ($vcheck['value']) {
        $currentime = time();
        $newtime = $last_check['value'] * 86400;	
            if ($currentime == $newtime) {
                $data = @file_get_contents("http://www.platinumnukepro.com/check.php?ver=7.6.PNPv1.0.0");
                    if ($data) { $data = $data; } else { $data = ""._UNABLETOCHECK.""; } 
                    $db->sql_query("UPDATE ".$prefix."_platinum_technology SET value = '$data' where name = 'lastupdatecheck'");
                    $db->sql_query("UPDATE ".$prefix."_platinum_technology SET value = '$currenttime' where name = 'lastupdatecheck'");
                    return $data;				
            } else {
                return $vcheck['value'];	
            }
    } else {
    $data = @file_get_contents("http://www.platinumnukepro.com/check.php?ver=7.6.PNPv1.0.0");
    if ($data) { $data = $data; } else { $data = ""._UNABLETOCHECK.""; } 
        $db->sql_query("INSERT INTO ".$prefix."_platinum_technology VALUES ('versioncheck', '$data')");
        $time = time();
        $db->sql_query("INSERT INTO ".$prefix."_platinum_technology VALUES ('lastupdatecheck', '$time')");
        return $data;
    }
}
if (!function_exists("floatval")) 
{ 
function floatval($inputval) 
{ 
return (float)$inputval; 
} 
} 
if (isset($gfx)){
switch($gfx) {
    case "gfx":
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    $ThemeSel = get_theme();
    if (file_exists("themes/".$ThemeSel."/images/code_bg.jpg")) {
		$image = ImageCreateFromJPEG("themes/".$ThemeSel."/images/code_bg.jpg");
    } else {
    $image = ImageCreateFromJPEG("images/code_bg.jpg");
    }
    $text_color = ImageColorAllocate($image, 80, 80, 80);
    Header("Content-type: image/jpeg");
    ImageString ($image, 5, 12, 2, $code, $text_color);
    ImageJPEG($image, '', 75);
    ImageDestroy($image);
    die();
    break;
  }
}
/*****************************************************/
/* Module - Banner Ads v.1.1.0                 START */
/*****************************************************/
    if (defined('FORUM_ADMIN')) {
        include_once("../../../includes/nsnba_func.php");
    } elseif (defined('INSIDE_MOD')) {
        include_once("../../includes/nsnba_func.php");
    } else {
        include_once("includes/nsnba_func.php");
    }
/*****************************************************/
/* Module - Banner Ads v.1.1.0                   END */
/*****************************************************/
/*****************************************************/
/* Addon - Center Blocks v.2.1.1               START */
/*****************************************************/
function cb_blocks($rid) {
    global $prefix, $db, $admin, $user;
    $sql = "SELECT * FROM ".$prefix."_nsncb_blocks WHERE rid='$rid'";
    $result = $db->sql_query($sql);
    while($row = $db->sql_fetchrow($result)) {
        $title = $row['title'];
        $filename = $row['filename'];
        $content = $row['content'];
        if (empty($filename) AND $content > "") {
            themecenterbox($title, $content);
        } elseif ($filename > "" AND empty($content)) {
            $file = @file("blocks/$filename");
            if (!$file) {
                $content = _BLOCKPROBLEM;
            } else {
                include_once("blocks/$filename");
            }
            if (empty($content)) { $content = _BLOCKPROBLEM2; }
            themecenterbox($title, $content);
        } elseif (empty($filename) AND empty($content)) {
            $content = _BLOCKPROBLEM2;
            themecenterbox($title, $content);
        }
    }
}
/*****************************************************/
/* Addon - Center Blocks v.2.1.1                 END */
/*****************************************************/
if (defined('FORUM_ADMIN')) {
	@include_once("../../../modules/Your_Account/includes/mainfileend.php");
} elseif (defined('INSIDE_MOD')) {
	@include_once("../../modules/Your_Account/includes/mainfileend.php");
} else {
	@include_once("modules/Your_Account/includes/mainfileend.php");
}
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1     START */
/*****************************************************/
    function UsernameColor($color, $username)
        {
        if(strlen((string) $color) < 6)
            {
        $username = $username;
            }
        elseif(strlen((string) $color) == 6)
            {
        $username = "<font color='#". $color ."'><strong>". $username ."</strong></font>";
            }
        else
            {
        $username = $username;
            }
        return $username;
        }
/*****************************************************/
/* Forum - Advanced Username Color v.1.0.1       END */
/*****************************************************/
/***************************************************************
 Added for Advertizing module from v7.8
****************************************************************/
function makePass() {
    $con = [];
    $voc = [];
    $cons = "bcdfghjklmnpqrstvwxyz";
    $vocs = "aeiou";
    for ($x=0; $x < 6; $x++) {
        mt_srand ((double) microtime() * 1_000_000);
        $con[$x] = substr($cons, random_int(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, random_int(0, strlen($vocs)-1), 1);
    }
    mt_srand((double)microtime()*1_000_000);
    $num1 = random_int(0, 9);
    $num2 = random_int(0, 9);
    $makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
    return($makepass);
}
function ads($position) {
    global $prefix, $db, $admin, $sitename, $adminmail, $nukeurl;
    $position = intval($position);
    if (paid()) {
        return;
    }
    $numrows = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_banner WHERE position='.$position.' AND active=\'1\''));
    if ($numrows > 1) {
        $numrows = $numrows-1;
        mt_srand((double)microtime()*1_000_000);
        $bannum = random_int(0, $numrows);
    } else {
        $bannum = 0;
    }
    $sql = 'SELECT bid, impmade, imageurl, clickurl, alttext FROM '.$prefix.'_banner WHERE position='.$position.' AND active=1 LIMIT '.$bannum.',1';
    $result = $db->sql_query($sql);
    [$bid, $impmade, $imageurl, $clickurl, $alttext] = $db->sql_fetchrow($result);
    $bid = intval($bid);
    $imageurl = filter($imageurl, 'nohtml');
    $clickurl = filter($clickurl, 'nohtml');
    $alttext = filter($alttext, 'nohtml');
    $db->sql_query('UPDATE '.$prefix.'_banner SET impmade=impmade+1 WHERE bid=\''.$bid.'\'');
    if($numrows > 0) {
        $sql2 = 'SELECT cid, imptotal, impmade, clicks, date, ad_class, ad_code, ad_width, ad_height FROM '.$prefix.'_banner WHERE bid=\''.$bid.'\'';
        $result2 = $db->sql_query($sql2);
        [$cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height] = $db->sql_fetchrow($result2);
        $cid = intval($cid);
        $imptotal = intval($imptotal);
        $impmade = intval($impmade);
        $clicks = intval($clicks);
        $ad_class = filter($ad_class, 'nohtml');
        $ad_width = intval($ad_width);
        $ad_height = intval($ad_height);
        if (($imptotal <= $impmade) AND ($imptotal != 0)) {
            $db->sql_query('UPDATE '.$prefix.'_banner SET active=0 WHERE bid=\''.$bid.'\'');
            $sql3 = 'SELECT name, contact, email FROM '.$prefix.'_banner_clients WHERE cid=\''.$cid.'\'';
            $result3 = $db->sql_query($sql3);
            [$c_name, $c_contact, $c_email] = $db->sql_fetchrow($result3);
            $c_name = filter($c_name, 'nohtml');
            $c_contact = filter($c_contact, 'nohtml');
            $c_email = filter($c_email, 'nohtml');
            if (!empty($c_email)) {
                $from = "$sitename <$adminmail>";
                $to = "$c_contact <$c_email>";
                $message = _HELLO." $c_contact:\n\n";
                $message .= _THISISAUTOMATED."\n\n";
                $message .= _THERESULTS."\n\n";
                $message .= _TOTALIMPRESSIONS." $imptotal\n";
                $message .= _CLICKSRECEIVED." $clicks\n";
                $message .= _IMAGEURL." $imageurl\n";
                $message .= _CLICKURL." $clickurl\n";
                $message .= _ALTERNATETEXT." $alttext\n\n";
                $message .= _HOPEYOULIKED."\n\n";
                $message .= _THANKSUPPORT."\n\n";
                $message .= "- $sitename "._TEAM."\n";
                $message .= "$nukeurl";
                $subject = "$sitename: "._BANNERSFINNISHED;
                mail($to, $subject, $message, 'From: '."$from\r\n".'X-Mailer: PHP/'.phpversion());
            }
        }
        if ($ad_class == 'code') {
            $ad_code = stripslashes((string) FixQuotes($ad_code));
            $ads = '<center>'.$ad_code.'</center>';
        } elseif ($ad_class == 'flash') {
            $ads = '<center>
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
                width="'.$ad_width.'" height="'.$ad_height.'" id="'.$bid.'">
                <param name="movie" value="'.$imageurl.'">
                <param name="quality" value="high">
                <embed src="'.$imageurl.'" quality="high" width="'.$ad_width.'" height="'.$ad_height.'"
                name="'.$bid.'" align="" type="application/x-shockwave-flash"
                pluginspage="http://www.macromedia.com/go/getflashplayer">
                </embed>
                </object>
                </center>';
        } else {
            $ads = '<center><a href="index.php?op=ad_click&amp;bid='.$bid.'" target="_blank"><img src="'.$imageurl.'" border="0" alt="'.$alttext.'" title="'.$alttext.'" /></a></center>';
        }
    } else {
        $ads = '';
    }
    return $ads;
}
/*****************************************************/
/* Module - Mailing List(s) v.1.0.0            START */
/*****************************************************/
if (defined('FORUM_ADMIN')) {
    include_once("../../../includes/nsnml_func.php");
} elseif (defined('INSIDE_MOD')) {
    include_once("../../includes/nsnml_func.php");
} else {
    include_once("includes/nsnml_func.php");
}
/*****************************************************/
/* Module - Mailing List(s) v.1.0.0              END */
/*****************************************************/
$_SERVER['SCRIPT_NAME'] = $_SERVER['PHP_SELF'];
/*******[BEGIN]****************************************
	[Include:  Zip Class                             ]
******************************************************/
include_once(NUKE_CLASSES_DIR.'class.zip.php');
/*******[END]******************************************
	[Include:  Zip Class                             ]
******************************************************/
/******START************************************************************************************************/
/** functions added to support dynamic and ordered loading of CSS and JS in <HEAD> and before </BODY> ******/
/*****************************RN Compatibility Layer********************************************************/
/***********************************************************************************************************/
require_once NUKE_INCLUDE_DIR . 'csrf-magic.php';
function addCSSToHead($content, $type='file') {
	global $headCSS;
	$headCSS = [];
	// Duplicate external file?
	if (($type == 'file') && (count($headCSS) > 0) && (in_array([$type, $content], $headCSS))) return;
	$headCSS[] = [$type, $content];
	return;
}
function addJSToHead($content, $type='file') {
	global $headJS;
	$headJS = [];
	// Duplicate external file?
	if (($type == 'file') && (count($headJS) > 0) && (in_array([$type, $content], $headJS))) return;
	$headJS[] = [$type, $content];
	return;
}
function addJSToBody($content, $type='file') {
	global $bodyJS;
	$bodyJS = [];
	// Duplicate external file?
	if (($type == 'file') && (count($bodyJS) > 0) && (in_array([$type, $content], $bodyJS))) return;
	$bodyJS[] = [$type, $content];
	return;
}
function writeHEAD() {
	global $headCSS, $headJS;
	$headCSS = [];
	$headJS = [];
	if (is_array($headCSS) && count($headCSS) > 0) {
		foreach($headCSS AS $css) {
			if ($css[0]=='file') {
				echo '<link rel="StyleSheet" href="' . $css[1] . '" type="text/css" />' . "\n";
			} else {
				echo $css[1];
			}
		}
	}
	if (is_array($headJS) && count($headJS) > 0) {
		foreach($headJS AS $js) {
			if ($js[0] == 'file') {
				echo '<script type="text/javascript" language="JavaScript" src="' . $js[1] . '"></script>' . "\n";
			} else {
				echo $js[1];
			}
		}
	}
	return;
}
function writeBODYJS() {
	global $bodyJS;
	if (is_array($bodyJS) && count($bodyJS) > 0) {
		foreach($bodyJS AS $js) {
			if ($js[0] == 'file') {
				echo '<script type="text/javascript" language="JavaScript" src="' . $js[1] . '"></script>' . "\n";
			} else {
				echo $js[1];
			}
		}
	}
	return;
}
function readDIRtoArray($dir, $filter) {
	$files = [];
	$handle = opendir($dir);
	while (false !== ($file = readdir($handle))) {
		if (preg_match($filter, $file)) {
			$files[] = $file;
		}
	}
	closedir($handle);
	return $files;
}
/*******END*****************************************************************************************************/
/** functions added to support dynamic and ordered loading of CSS and JS in <HEAD> and before </BODY> *********/
/*****************************RN Compatibility Layer***********************************************************/
/**************************************************************************************************************/
?>