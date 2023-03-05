<?php 
/****************************************************************************/
/* Coppermine Photo Gallery 1.3.1c by http:www.pcnuke.com                   */
/****************************************************************************/
/****************************************************************************/
/* Port Copyright (C) 2004 Coppermine for CMS Dev Team                      */
/* http://coppermine.findhere.org/                                          */
/* Based on coppermine 1.1d by Surf  http://www.surf4all.net/               */
/****************************************************************************/
/* Updated by the Coppermine Dev Team  2003                                 */
/* (http://coppermine.sf.net/team/)                                         */
/* see /docs/credits.html for details                                       */
/****************************************************************************/
/* Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               */
/* http://www.chezgreg.net/coppermine/                                      */
/* This program is free software; you can redistribute it and/or modify    */
/* it under the terms of the GNU General Public License as published by   */
/* the Free Software Foundation; either version 2 of the License, or        */
/* (at your option) any later version.                                      */
/****************************************************************************/
/*   $Id: functions.inc,v 1.3 2004/05/19 01:51:32 djmaze Exp $              */
/****************************************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
global $template;
global $_POST, $_GET, $_COOKIE, $_SERVER, $REFERER, $USER;
global $user, $admin, $cookie, $prefix, $user_prefix, $FAVPICS;
if (phpversion() <= '4.0.6') {
    $_GET = ($_GET);
}
if (phpversion() <= '4.0.6') {
    $_POST = ($_POST);
}
// Include functions file
if (!defined('CPG_FUNCTIONS')) require_once($CPG_M_DIR . "/include/functions.inc");
// NEW ADDED!
global $userinfo;
global $field_user_id, $field_user_pass, $field_user_name, $field_user_email, $HTML_SUBST;
if (is_user($user)) {
    getusrinfo($user);
} 
// ABOVE ADDED
// Report all errors except E_NOTICE
// This is the default value set in php.ini
// error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
// Check if magic_quotes_runtime is active
if(get_magic_quotes_runtime())
{
    // Deactivate
    set_magic_quotes_runtime(false);
}
//set_magic_quotes_runtime(0);
// used for timing purpose
$query_stats = array();
$time_start = get_mt();
// Do some cleanup in GET, POST and cookie data and un-register global vars
$HTML_SUBST = array('"' => '&quot;', '<' => '&lt;', '>' => '&gt;');
// Initialise the $CONFIG array and some other variables
$CONFIG = array();
$PHP_SELF = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['SCRIPT_NAME'];
$REFERER = urlencode($PHP_SELF . (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ''));
$CAT_LIST = array();
// Record User's IP address
$raw_ip = stripslashes($_SERVER['REMOTE_ADDR']);
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $hdr_ip = stripslashes($_SERVER['HTTP_CLIENT_IP']);
} else {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $hdr_ip = stripslashes($_SERVER['HTTP_X_FORWARDED_FOR']);
    } else {
        $hdr_ip = $raw_ip;
    } 
} 
// Define some constants
define('USER_GAL_CAT', 1);
define('FIRST_USER_CAT', 10000);
define('RANDPOS_MAX_PIC', 200);
// Constants used by the cpg_die function
define('INFORMATION', 1);
define('ERROR', 2);
define('CRITICAL_ERROR', 3);
$IMG_TYPES = array(
    1 => 'GIF',
    2 => 'JPG',
    3 => 'PNG',
    4 => 'SWF',
    5 => 'PSD',
    6 => 'BMP',
    7 => 'TIFF',
    8 => 'TIFF',
    9 => 'JPC',
    10 => 'JP2',
    11 => 'JPX',
    12 => 'JB2',
    13 => 'SWC',
    14 => 'IFF'
    );
$CONFIG['TABLE_PREFIX'] = $cpg_prefix;
$CONFIG['TABLE_PICTURES'] = $CONFIG['TABLE_PREFIX'] . "pictures";
$CONFIG['TABLE_ALBUMS'] = $CONFIG['TABLE_PREFIX'] . "albums";
$CONFIG['TABLE_COMMENTS'] = $CONFIG['TABLE_PREFIX'] . "comments";
$CONFIG['TABLE_CATEGORIES'] = $CONFIG['TABLE_PREFIX'] . "categories";
$CONFIG['TABLE_CONFIG'] = $CONFIG['TABLE_PREFIX'] . "config";
$CONFIG['TABLE_USERGROUPS'] = $CONFIG['TABLE_PREFIX'] . "usergroups";
$CONFIG['TABLE_VOTES'] = $CONFIG['TABLE_PREFIX'] . "votes";
$CONFIG['TABLE_USERS'] = $user_prefix . "_users"; //default nuke_
// Connect to database
// db_connect() || die("<strong>Coppermine critical error</strong>:<br />Unable to connect to database !<br /><br />MySQL said: <strong>".mysql_error()."</strong>");
// we are already connected thru phpNuke
// Retrieve DB stored configuration
$results = db_query("SELECT * FROM ". $CONFIG['TABLE_CONFIG']);
while ($row = mysql_fetch_array($results)) {
    $CONFIG[$row['name']] = $row['value'];
} // while
mysql_free_result($results);
// Set error logging level
if ($CONFIG['debug_mode'] && is_admin($admin)) {
    error_reporting (E_ALL ^ E_NOTICE);
} else {
    error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE);
} 
// Parse cookie stored user profile
user_get_profile();
if (defined('IN_POSTNUKE')) {
    if (isset($cookie[0])) $cookie_uid = (int)$cookie[0];
}
else {
    if(!is_array($user)) {
        $tmpuser = base64_decode($user);
        $tmpuser = explode(":", $tmpuser);
        $cookie_uid = $tmpuser[0];
        unset($tmpuser);
    } else $cookie_uid = $user[0];
}
$cookie_uid = $cookie_uid?$cookie_uid:1;
$sql = "SELECT * FROM {$CONFIG['TABLE_USERS']}, {$CONFIG['TABLE_USERGROUPS']} " .
       "WHERE user_group_cp = group_id " .
       "AND $field_user_id='$cookie_uid' " .
       "AND user_active_cp = 'YES'";
$results = db_query($sql);
if (mysql_num_rows($results)) {
    $USER_DATA = mysql_fetch_array($results);
    unset($USER_DATA['user_password']);
    define('USER_ID', (int)$USER_DATA[$field_user_id]);
    define('CPG_USERNAME', $USER_DATA[$field_user_name]);
    $user_group_list_cp = preg_split("#,#", $USER_DATA['user_group_list_cp']);
    foreach ($user_group_list_cp AS $group) {
        if (is_numeric($group)) {
            $grouplist .= ",".$group;
        }
    }
    define('USER_IN_GROUPS', $USER_DATA['user_group_cp'].$grouplist.",".(FIRST_USER_CAT+$cookie_uid));
    define('USER_CAN_CREATE_ALBUMS', (int)$USER_DATA['can_create_albums']);
    mysql_free_result($results);
} else {
    $results = db_query("SELECT * FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = 3");
    if (!mysql_num_rows($results)) die('<strong>Coppermine critical error</strong>:<br />The group table does not contain the Anonymous group !');
    $USER_DATA = mysql_fetch_array($results);
    define('USER_ID', 0);
    define('CPG_USERNAME', 'Anonymous');
    define('USER_IN_GROUPS', 3);
    define('USER_CAN_CREATE_ALBUMS', 0);
    mysql_free_result($results);
}
if (is_admin($admin)) {
    define('USER_IS_ADMIN', 1);
} else {
    define('USER_IS_ADMIN', (int)$USER_DATA['has_admin_access']);
}
define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
if (!defined('FUNC')) define('FUNC', '96a84d41d7c1d325b348935a82077461');
// Test if admin mode
$USER['am'] = isset($USER['am']) ? (int)$USER['am'] : 0;
define('GALLERY_ADMIN_MODE', USER_IS_ADMIN && $USER['am']);
define('USER_ADMIN_MODE', USER_ID && USER_CAN_CREATE_ALBUMS && $USER['am'] && !GALLERY_ADMIN_MODE);
if (GALLERY_ADMIN_MODE) define('VIS_GROUPS', 'visibility > -1');
else define('VIS_GROUPS', 'visibility IN (0,'.USER_IN_GROUPS.')');
// Load language, mod by sengsara
// Process language selection if present in URI or in user profile or try
// autodetection if default charset is utf-8
// load language from first install
global $currentlang, $language, $first_install_M_DIR;
/*
if (defined('IN_POSTNUKE')) {
      $currentlang = pnSessionGetVar('lang');
      $language = pnConfigGetVar('language');
}
*/
if (defined('IN_POSTNUKE')) {
      $currentlang =  pnUserGetLang();
      $language = pnConfigGetVar('language');
      $ThemeSel = pnUserGetTheme();
}
if (strtoupper(_CHARSET) == 'UTF-8'){
    if (file_exists($first_install_M_DIR . "/lang/$currentlang-utf-8.php")) {
        $USER['lang'] = $currentlang;
        require_once($first_install_M_DIR . "/lang/{$USER['lang']}-utf-8.php");
        require_once($first_install_M_DIR . "/language/lang-{$USER['lang']}-utf-8.php");
    } else {
        $USER['lang'] = $language;
        require_once($first_install_M_DIR . "/lang/{$USER['lang']}-utf-8.php");
        require_once($first_install_M_DIR . "/language/lang-{$USER['lang']}-utf-8.php");
    }
} else {
    if (file_exists($first_install_M_DIR . "/lang/$currentlang.php")) {
        $USER['lang'] = $currentlang;
        require_once($first_install_M_DIR . "/lang/{$USER['lang']}.php");
        require_once($first_install_M_DIR . "/language/lang-{$USER['lang']}.php");
    } else {
        $USER['lang'] = $language;
        require_once($first_install_M_DIR . "/lang/{$USER['lang']}.php");
        require_once($first_install_M_DIR . "/language/lang-{$USER['lang']}.php");
    }
}
// See if the fav cookie is set else set it
if (isset($_COOKIE[$CONFIG['cookie_name'] . '_fav'])) {
    $FAVPICS = @unserialize(@base64_decode($_COOKIE[$CONFIG['cookie_name'] . '_fav']));
} else {
    $FAVPICS = array();
}
if (is_numeric($album)) {
    $meta_link = '&amp;album='.$album;
} else {
    if (intval($cat) < 0)
        $meta_link = '&amp;cat='.(-intval($cat));
    else
        $meta_link = '&amp;cat='.intval($cat);
}
define('META_LNK', $meta_link);
if (!$cpg_block) {
    // Added nuke theme coppermine theme addition hack
    // Thanks to helius theme for coppermine and Sengsara
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/coppermine/theme.inc")) {
        $THEME_DIR = "themes/$ThemeSel/coppermine";
    } else {
        // Load theme
        if (!file_exists($CPG_M_DIR . "/themes/{$CONFIG['theme']}/theme.inc")) { $CONFIG['theme'] = 'default'; }
        $THEME_DIR = $CPG_M_DIR . "/themes/{$CONFIG['theme']}";
    }
    require_once("$THEME_DIR/theme.inc");
    // load the main template
    load_template();
    if (isset($home)) $index = $home;
    else $index = $CONFIG['right_blocks'];
}
?>
