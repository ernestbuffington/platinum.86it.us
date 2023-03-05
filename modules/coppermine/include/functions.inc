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
/**
 * Function for managing cookie saved user profile
 */
global $THEME_DIR, $template, $block_name, $template_cpg_die, $template_msg_box;
define('CPG_FUNCTIONS', 1);
function get_mt()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} 
// Decode the user profile contained in a cookie
function user_get_profile()
{
    global $CONFIG, $USER, $_COOKIE;
    if (isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
        $USER = @unserialize(@base64_decode($_COOKIE[$CONFIG['cookie_name'] . '_data']));
    } 
    if (!isset($USER['ID']) || strlen($USER['ID']) != 32) {
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        srand($seed);
        $USER = array('ID' => md5(uniqid(rand(), 1)));
    } else {
        $USER['ID'] = addslashes($USER['ID']);
    } 
    if (!isset($USER['am'])) $USER['am'] = 1;
} 
// Save the user profile in a cookie
function user_save_profile()
{
    global $CONFIG, $USER, $_SERVER;
    $data = base64_encode(serialize($USER));
    setcookie($CONFIG['cookie_name'] . '_data', $data, time() + 86400 * 30, $CONFIG['cookie_path']);
} 
// check if user is member of group
function user_ingroup($group_id, &$usergroups) {
    if (!is_array($usergroups)) $usergroups = split(',', $usergroups);
    foreach($usergroups as $group) {
        if ($group == $group_id) return true;
    }
    return false;
}
/**
 * Database functions
 */
// Perform a database query
function db_query($query, $link_id = 0)
{
    global $CONFIG, $query_stats, $queries;
    $query_start = get_mt();
    if (($link_id)) {
        $result = mysql_query($query, $link_id);
    } else {
        $result = mysql_query($query);
    } 
    $query_end = get_mt();
    if (isset($CONFIG['debug_mode']) && ($CONFIG['debug_mode'] == 1)) {
        $query_stats[] = $query_end - $query_start;
        $queries[] = $query;
    } 
    if (!$result) db_error("While executing query \"$query\" on $link_id");
    return $result;
} 
// Error message if a query failed
function db_error($the_error)
{
    global $CONFIG, $admin;
    if (!$CONFIG['debug_mode'] && !is_admin($admin)) {
        cpg_die(CRITICAL_ERROR, 'There was an error while processing a database query', __FILE__, __LINE__);
    } else {
        $the_error .= "\n\nmySQL error: " . mysql_error() . "\n";
        $out = "<br />There was an error while processing a database query.<br /><br/>
                    <form name='mysql'><textarea rows=\"8\" cols=\"60\">" . htmlspecialchars($the_error) . "</textarea></form>";
        cpg_die(CRITICAL_ERROR, $out, __FILE__, __LINE__);
    } 
} 
// Fetch all rows in an array
function db_fetch_rowset($result)
{
    $rowset = array();
    while ($row = mysql_fetch_array($result)) $rowset[] = $row;
    return $rowset;
} 
// get a table count
// cpg_tablecount("cpg_pictures", "count(*)")
// cpg_tablecount("cpg_pictures", "sum(hits)")
function cpg_tablecount($table, $type)
{
/*
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (a.aid = $album AND ".VIS_GROUPS.") WHERE p.aid='$album' AND approved='YES'");
    "SELECT COUNT(*) FROM {$CONFIG['TABLE_COMMENTS']} AS c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) GROUP BY p.pid ORDER BY msg_date DESC $limit");
    "SELECT COUNT(*) FROM {$CONFIG['TABLE_COMMENTS']} AS c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE author_id = " .USER_ID. " GROUP BY p.pid ORDER BY msg_date DESC $limit");
    "SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' GROUP BY p.pid ORDER BY p.pid DESC $limit");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (".VIS_GROUPS.") WHERE approved='YES' AND owner_id = '$uid' GROUP BY p.pid ORDER BY p.pid DESC $limit");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND hits > 0 GROUP BY p.pid");
    "SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND p.votes >= {$CONFIG['min_votes_for_rating']}");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' GROUP BY p.pid");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum GROUP BY p.pid");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum");
    "SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND pid IN ($favs) GROUP BY pid");
    "SELECT count(*) from {$CONFIG['TABLE_COMMENTS']} where pid=$pid and msg_id!=$skip");
    "SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1");
*/
    $result = db_query("SELECT $type FROM $table");
    if ($result) {
        $count = mysql_fetch_row($result);
        mysql_free_result($result);
        return $count[0];
    } else {
    return 0;
    }
/*
    global $db;
    $result = $db->sql_query("SELECT $type FROM $table");
    if ($result) {
        $count = $db->sql_fetchrow($result);
        return $count[0];
    } else return 0
*/
} 
/**
 * Utilities functions
 */
// Remplacement for the die function
function cpg_die($msg_code, $msg_text, $error_file, $error_line, $output_buffer = false, $header=false)
{
    global $CONFIG, $lang_cpg_die, $template_cpg_die;
    global $template; 
    // Simple output if theme file is not loaded
    if (!function_exists('starttable')) {
        echo 'Fatal error :<br />' . $msg_text;
        exit;
    } 
    $template_cpg_die = eval_tmplfile($template_cpg_die);
    if (!$CONFIG['debug_mode']) template_extract_block($template_cpg_die, 'file_line');
    if (!$output_buffer && !$CONFIG['debug_mode']) template_extract_block($template_cpg_die, 'output_buffer');
    $params = array('{MESSAGE}' => $msg_text,
        '{FILE_TXT}' => $lang_cpg_die['file'],
        '{FILE}' => $error_file,
        '{LINE_TXT}' => $lang_cpg_die['line'],
        '{LINE}' => $error_line,
        '{OUTPUT_BUFFER}' => "",
        );
    if ($header) {
        pageheader($lang_cpg_die[$msg_code]);
    }
    global $CONFIG;
    global $template_header;
    require_once("header.php");
//    OpenTable();
    starttable(-1, $lang_cpg_die[$msg_code]);
    echo template_eval($template_cpg_die, $params);
    endtable();
    pagefooter();
}
// Function for writing a pageheader
function pageheader($section, $meta = '')
{
    global $CONFIG, $CPG_VERSION, $CPG_M_DIR, $template_header;
//    header('P3P: CP="CAO DSP COR CURa ADMa DEVa OUR IND PHY ONL UNI COM NAV INT DEM PRE"');
    user_save_profile();
    $TMPCONFIG = $CONFIG;
    require_once("header.php");
    $CONFIG = $TMPCONFIG;
    OpenTable();
    $template_vars = array(
            '{LANG_DIR}' => CPG_TEXT_DIR,
            '{TITLE}' => $CONFIG['gallery_name'].' - '.$section,
            '{CHARSET}' => $CONFIG['charset'] == 'language file' ? _CHARSET : $CONFIG['charset'],
            '{META}' => $meta,
            '{GAL_NAME}' => $CONFIG['gallery_name'],
            '{GAL_DESCRIPTION}' => $CONFIG['gallery_description'],
            '{MAIN_MENU}' => theme_main_menu(),
            '{ADMIN_MENU}' => theme_admin_mode_menu()
    );
    // Pc-Nuke! added config var...
    if ((GALLERY_ADMIN_MODE) && ($CONFIG['showupdate']==1)){
        $vers = file('http://www.pcnuke.com/ver/version.php?ver='.$CPG_VERSION);
        $img = "<img src=\"$CPG_M_DIR/images/";
        if ($vers[0] == '0') $img .= 'green.gif" alt="ok" title="Your are using the latest coppermine for php-nuke release';
        elseif ($vers[0] == '1') $img .= 'yellow.gif" alt="update" title="There\'s a new coppermine for php-nuke release';
        else $img .= 'red.gif" alt="critical" title="Important coppermine for php-nuke release available!';
        $template_vars['{ADMIN_MENU}'] .= $img.'">';
    }
    echo template_eval($template_header, $template_vars);
}
// Function for writing a pagefooter
function pagefooter()
{
    global $CPG_VERSION, $template_footer;
    $template_footer = "<br><center>Powered by <a href=\"http://www.pcnuke.com\"> Coppermine for Php-Nuke</a> $CPG_VERSION<br>&nbsp;&nbsp;&nbsp;<a href=\"http://www.pcnuke.com\"> A Nuke Community Team Project</a></center>";
    echo $template_footer;
    CloseTable();
    print_debug();
    include_once("footer.php");
    exit;
}
// Display a localised date
function localised_date($timestamp = -1, $datefmt)
{
    global $lang_month, $lang_day_of_week, $CONFIG, $db, $field_user_id;
    if ($timestamp == -1) $timestamp = time() - (86400 * 365); // no date so just place 1 year back.
    $usergmt = 0;
    $result = $db->sql_query("SELECT user_timezone FROM " . $CONFIG['TABLE_USERS'] . " WHERE $field_user_id = " . USER_ID);
    if ($row = $db->sql_fetchrow($result)) $usergmt = $row[0];
    $timestamp = $timestamp - date("Z") + (3600 * $usergmt);
    $date = preg_replace('/%[aA]/', $lang_day_of_week[(int)strftime('%w', $timestamp)], $datefmt);
    $date = preg_replace('/%[bB]/', $lang_month[(int)strftime('%m', $timestamp)-1], $date);
    return strftime($date, $timestamp);
} 
// Function to create correct URLs for image name with space or exotic characters
function path2url($path)
{
    return str_replace("%2F", "/", rawurlencode($path));
} 
// Display a 'message box like' table
function msg_box($title, $msg_text, $button_text = "", $button_link = "", $width = "-1")
{
    global $template_msg_box;
    if (!$button_text) {
        template_extract_block($template_msg_box, 'button');
    } 
    $params = array('{MESSAGE}' => $msg_text,
        '{LINK}' => $button_link,
        '{TEXT}' => $button_text
        );
    starttable($width, $title);
    echo template_eval($template_msg_box, $params);
    endtable();
} 
function create_tabs($items, $curr_page, $total_pages, $template)
{
    global $CONFIG;
    if (function_exists('theme_create_tabs')) {
        theme_create_tabs($items, $curr_page, $total_pages, $template);
        return;
    } 
    $maxTab = $CONFIG['max_tabs'];
    $tabs = sprintf($template['left_text'], $items, $total_pages);
    if (($total_pages == 1)) return $tabs;
    $tabs .= $template['tab_header'];
    if ($curr_page == 1) {
        $tabs .= sprintf($template['active_tab'], 1);
    } else {
        $tabs .= sprintf($template['inactive_tab'], 1, 1);
    } 
    if ($total_pages > $maxTab) {
        $start = max(2, $curr_page - floor(($maxTab -2) / 2));
        $start = min($start, $total_pages - $maxTab + 2);
        $end = $start + $maxTab -3;
    } else {
        $start = 2;
        $end = $total_pages-1;
    } 
    for ($page = $start ; $page <= $end; $page++) {
        if ($page == $curr_page) {
            $tabs .= sprintf($template['active_tab'], $page);
        } else {
            $tabs .= sprintf($template['inactive_tab'], $page, $page);
        } 
    } 
    if ($total_pages > 1) {
        if ($curr_page == $total_pages) {
            $tabs .= sprintf($template['active_tab'], $total_pages);
        } else {
            $tabs .= sprintf($template['inactive_tab'], $total_pages, $total_pages);
        } 
    } 
    return $tabs . $template['tab_trailer'];
} 
/**
 * Rewritten by Nathan Codding - Feb 6, 2001. Taken from phpBB code
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *               to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *               to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *                      to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 * 
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function cpg_make_clickable($text)
{
    $ret = " " . $text;
    $ret = preg_replace("#([\n ])([a-z]+?)://([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)#i", "\\1<a href=\"\\2://\\3\" target=\"_blank\">\\2://\\3</a>", $ret);
    $ret = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]*)?)#i", "\\1<a href=\"http://www.\\2.\\3\\4\" target=\"_blank\">www.\\2.\\3\\4</a>", $ret);
    $ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
    $ret = substr($ret, 1);
    return($ret);
} 
// Allow the use of a limited set of phpBB bb codes in albums and image descriptions
// Taken from phpBB code
define ('LOC', 'YToyOntzOjE6ImwiO3M6OToie0dBTExFUll9IjtzOjE6InMiO3M6Mjk1OiI8ZGl2IGNsYXNzPSJmb290ZXIiIGFsaWduPSJjZW50ZXIiIHN0eWxlPSJwYWRkaW5nLXRvcDogMTBweDsiPlBvd2VyZWQgYnkgPGEgaHJlZj0iaHR0cDovL2NvcHBlcm1pbmUuc2YubmV0LyIgdGFyZ2V0PSJfYmxhbmsiPkNvcHBlcm1pbmUgUGhvdG8gR2FsbGVyeTwvYT4gdkNQR19WRVJTSU9OLU51a2U8YnI+Zm9yIHBocE51a2UgYW5kIHBvc3ROdWtlIGJ5IDxhIGhyZWY9Imh0dHA6Ly9jb3BwZXJtaW5lLmZpbmRoZXJlLm9yZy8iIHRhcmdldD0iX2JsYW5rIj5Db3BwZXJtaW5lIE51a2UgRGV2IFRlYW08L2E+PC9kaXY+Ijt9');
function bb_decode($text)
{
    $text = nl2br($text);
    static $bbcode_tpl = array();
    static $patterns = array();
    static $replacements = array(); 
    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if ((strpos($text, "[") === false || strpos($text, "]") === false)) {
        return $text;
    } 
    // [b] and [/b] for bolding text.
    $text = str_replace("[b]", '<strong>', $text);
    $text = str_replace("[/b]", '</strong>', $text); 
    // [u] and [/u] for underlining text.
    $text = str_replace("[u]", '<u>', $text);
    $text = str_replace("[/u]", '</u>', $text); 
    // [i] and [/i] for italicizing text.
    $text = str_replace("[i]", '<i>', $text);
    $text = str_replace("[/i]", '</i>', $text);
    if (!count($bbcode_tpl)) {
        // We do URLs in several different ways..
        $bbcode_tpl['url'] = '<span class="bblink"><a href="{URL}" target="_blank">{DESCRIPTION}</a></span>';
        $bbcode_tpl['email'] = '<span class="bblink"><a href="mailto:{EMAIL}">{EMAIL}</a></span>';
        $bbcode_tpl['url1'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
        $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1\\2', $bbcode_tpl['url1']);
        $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);
        $bbcode_tpl['url3'] = str_replace('{URL}', '\\1\\2', $bbcode_tpl['url']);
        $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url3']);
        $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url4']);
        $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']); 
        // [url]xxxx://www.phpbb.com[/url] code..
        $patterns[1] = "#\[url\]([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
        $replacements[1] = $bbcode_tpl['url1']; 
        // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
        $patterns[2] = "#\[url\]([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\[/url\]#si";
        $replacements[2] = $bbcode_tpl['url2']; 
        // [url=xxxx://www.phpbb.com]phpBB[/url] code..
        $patterns[3] = "#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
        $replacements[3] = $bbcode_tpl['url3']; 
        // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
        $patterns[4] = "#\[url=([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#si";
        $replacements[4] = $bbcode_tpl['url4']; 
        // [email]user@domain.tld[/email] code..
        $patterns[5] = "#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
        $replacements[5] = $bbcode_tpl['email'];
    } 
    $text = preg_replace($patterns, $replacements, $text);
    return $text;
} 
// function added for blocks takes a string and shortens it for display
// use: truncate_stringblocks($var,int)
function truncate_stringblocks($str, $maxlength = 20)
{
    if (strlen($str) > $maxlength) {
        return substr($str, 0, $maxlength) . " ...";
    } else {
        return $str;
    } 
} 
/**
 * Template functions
 */
function eval_tmplfile($file, $load = true)
{
    global $THEME_DIR, $CPG_M_DIR, $CPG_URL;
    if ($load)
        $thefile = implode("", file($THEME_DIR . '/' . $file));
    else
        $thefile = $file;
    $thefile = addslashes($thefile);
    $thefile = "\$var=\"" . $thefile . "\";";
    eval($thefile);
    $var = stripslashes($var);
    return $var;
} 
// Load and parse the template.html file
function load_template()
{
    global $THEME_DIR, $CONFIG, $template_header, $template_footer, $CPG_VERSION;
    $tmpl_loc = array();
    $tmpl_loc = unserialize(base64_decode(LOC));
    if (file_exists('template.html')) {
        $template_file = 'template.html';
    } elseif (file_exists($THEME_DIR . '/template.html')) {
        $template_file = $THEME_DIR . '/template.html';
    } 
    /// This is the engine that shows the version change in the include/load.inc file 
    if (!isset($template_file) || md5($tmpl_loc['s']) != FUNC) {
        $tmpl_loc['s'] = preg_replace('/CPG_VERSION/', $CPG_VERSION, $tmpl_loc['s']);
        die("<strong>Coppermine critical error</strong>:<br />Unable to load template file $THEME_DIR/template.html!</strong><p>".$tmpl_loc['s']);
    } else $tmpl_loc['s'] = preg_replace('/CPG_VERSION/', $CPG_VERSION, $tmpl_loc['s']);
    $template = eval_tmplfile('template.html');
    $gallery_pos = strpos($template, $tmpl_loc['l']);
    $template = str_replace($tmpl_loc['l'], $tmpl_loc['s'] , $template);
    $template_header = substr($template, 0, $gallery_pos);
    $template_footer = substr($template, $gallery_pos);
}
// Eval a template (substitute vars with values)
function template_eval(&$template, &$vars)
{
    return strtr($template, $vars);
} 
// Extract and return block '$block_name' from the template, the block is replaced by $subst
function template_extract_block(&$template, $block_name, $subst = '')
{
    $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
    if (!preg_match($pattern, $template, $matches)) {
        die('<strong>Template error<strong><br />Failed to find block \'' . $block_name . '\'(' . htmlspecialchars($pattern) . ') in :<br /><pre>' . htmlspecialchars($template) . '</pre>');
    } 
    $template = str_replace($matches[1] . $matches[2] . $matches[3], $subst, $template);
    return $matches[2];
} 
/**
 * Functions for album/picture management
 */
function get_cat_content(&$list, $cat, $title)
{
    if (!GALLERY_ADMIN_MODE) $upload = "AND uploads = 'YES'";
    global $CONFIG;
    $albums = db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = " . $cat . " $upload ORDER BY title");
    while ($album = mysql_fetch_array($albums)) {
        $rowset['aid'] = $album['aid'];
        $rowset['title'] = $title . $album['title'];
        $list[] = $rowset;
    }
    mysql_free_result($albums);
    $cats = db_query("SELECT cid, catname FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent=".$cat." ORDER BY catname");
    while ($subcat = mysql_fetch_array($cats)) {
        $tmptitle = $title . $subcat['catname'] . " > ";
        get_cat_content($list, $subcat['cid'], $tmptitle);
    }
    mysql_free_result($cats);
}
// get a full list of albums to use
function get_albumlist($user_id=0)
{
    if (!GALLERY_ADMIN_MODE) $upload = "AND uploads = 'YES'";
    global $CONFIG, $field_user_name, $field_user_id;
    $select = array();
    get_cat_content($select, 0, '');
    if (GALLERY_ADMIN_MODE)
        $sql = "SELECT aid, CONCAT('(', $field_user_name, ') ', title) AS title FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "INNER JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + $field_user_id) " . "ORDER BY title";
    else
        $sql = "SELECT aid, CONCAT('* ', title) AS title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category='" . (FIRST_USER_CAT + $user_id) . "' ORDER BY title";
    $result = db_query($sql);
    while ($row = mysql_fetch_array($result)) $select[] = $row;
    mysql_free_result($result);
    return $select;
}
// Retrieve the data for a picture or a set of picture
function get_pic_data($meta, $album, &$count, &$album_name, $limit1 = -1, $limit2 = -1, $set_caption = true)
{
    global $USER, $CONFIG, $_GET, $HTML_SUBST, $THEME_DIR, $FAVPICS;
    global $album_date_fmt, $lastcom_date_fmt, $lastup_date_fmt, $lasthit_date_fmt, $thisalbum, $cat;
    global $lang_get_pic_data, $lang_meta_album_names, $lang_errors, $CPG_M_DIR, $CPG_PROFILE_URL;
    global $db;
    $sort_array = array('na' => 'filename ASC', 'nd' => 'filename DESC', 'ta' => 'title ASC', 'td' => 'title DESC', 'da' => 'pid ASC', 'dd' => 'pid DESC', 'ra' => 'pic_rating ASC', 'rd' => 'pic_rating DESC', 'sd' => 'max(pwidth,pheight) DESC', 'sa' => 'max(pwidth,pheight) ASC'); //'sa' => 'max(pwidth,pheight) DESC'
    $sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
    $sort_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];
    $cat = is_numeric($cat)  ?  $cat  :  0;
    $limit = ($limit1 != -1) ? ' LIMIT ' . $limit1 : '';
    $limit .= ($limit2 != -1) ? ' ,' . $limit2 : '';
    if ($limit2 == 1) {
        $select_columns = 'p.*';
    } else {
        $select_columns = 'pid, filepath, filename, p.title, keywords, url_prefix, filesize, pwidth, pheight, ctime, p.aid';
    }
    // Regular albums
    if (is_numeric($album) && $meta == '') {
        $album_name = get_album_name($album);
        $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} as p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (a.aid = $album AND ".VIS_GROUPS.") WHERE p.aid='$album' AND approved='YES'");
        $nbEnr = mysql_fetch_row($result);
        $count = $nbEnr[0];
        mysql_free_result($result);
        if ($select_columns != '*') {
            $select_columns .= ', p.title, caption, hits, description';
        }
        $result = db_query("SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} as p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (a.aid = $album AND ".VIS_GROUPS.") WHERE p.aid='$album' AND approved='YES' ORDER BY $sort_order $limit");
        $rowset = db_fetch_rowset($result);
        mysql_free_result($result);
        // Set picture caption
        if ($set_caption) foreach ($rowset as $key => $row) {
            $caption = ($rowset[$key]['title'] || $rowset[$key]['hits']) ? "<span class=\"thumb_title\">" . $rowset[$key]['title'] . (($rowset[$key]['title'])?"-":"") . sprintf($lang_get_pic_data['n_views'], $rowset[$key]['hits']) . "</span>" : '';
            if ($CONFIG['caption_in_thumbview']) {
                $caption .= $rowset[$key]['caption'] ? "<span class=\"thumb_caption\">" . bb_decode($rowset[$key]['caption']) . "</span>" : '';
            }
            if ($CONFIG['display_comment_count']) {
                $comments_nr = count_pic_comments($row['pid']);
                if ($comments_nr > 0) $caption .= "<span class=\"thumb_num_comments\">" . sprintf($lang_get_pic_data['n_comments'], $comments_nr) . "</span>";
            }
            $rowset[$key]['caption_text'] = $caption;
        }
        return $rowset;
    }
    // Meta albums
    $album_name = $lang_meta_album_names[$meta];
    // Limits pictures to the amount shown
    switch ($meta) {
        // Last comments
        case 'lastcom': 
            if ($select_columns == '*') {
                $select_columns = 'p.*';
            } else {
                $select_columns = str_replace('pid', 'p.pid', $select_columns) . ', msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, p.aid';
            }
            $result = db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_COMMENTS']} as c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) ORDER BY msg_date DESC");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_COMMENTS']} as c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) ORDER BY msg_date DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                // FIX PostNuke
                if ($row['author_id']) {
                    $user_link = '<a href ="'.$CPG_PROFILE_URL.'' . (defined('IN_POSTNUKE')?$row['msg_author']:$row['author_id']) . '">' . $row['msg_author'] . '</a>';
                } else {
                    $user_link = $row['msg_author'];
                } 
                $msg_body = strlen($row['msg_body']) > 50 ? @substr($row['msg_body'], 0, 50) . "...": $row['msg_body']; 
                // if ($CONFIG['enable_smilies']) $msg_body = process_smilies($msg_body);
                $caption = '<span class="thumb_title">' . $user_link . '</span>' . '<span class="thumb_caption">' . localised_date($row['msg_date'], $lastcom_date_fmt) . '</span>' . '<span class="thumb_caption">' . $msg_body . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Last comments by a specific user
        case 'lastcomby':
            $result = db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_COMMENTS']} as c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE author_id = " .USER_ID. " GROUP BY p.pid ORDER BY msg_date DESC");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns == '*') {
                $select_columns = 'p.*';
            } else {
                $select_columns = str_replace('pid', 'c.pid', $select_columns) . ', msg_id, author_id, msg_author, UNIX_TIMESTAMP(msg_date) as msg_date, msg_body, p.aid';
            } 
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_COMMENTS']} as c INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.pid = c.pid AND approved='YES') INNER JOIN {$CONFIG['TABLE_ALBUMS']} as a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE author_id = " .USER_ID. " GROUP BY p.pid ORDER BY msg_date DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                $comment_body = cpg_make_clickable($row['msg_body']);
                $user_link = $row['msg_author'];
                $caption = '<span class="thumb_title">' . $user_link . '</span>' . '<span class="thumb_caption">' . localised_date($row['msg_date'], $lastcom_date_fmt) . '</span>' . '<span class="thumb_caption">' . $comment_body . '</span>';
                $rowset[$key]['caption_text'] = $caption;
                } 
            return $rowset;
            break; // END Last comments
        // Last uploads
        case 'lastup': 
            $result = db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' ORDER BY p.pid DESC");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns == '*') {
                $select_columns = 'p.*';
            } else {
                $select_columns = str_replace('pid', 'p.pid', $select_columns) . ', owner_id, owner_name';
            }
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' ORDER BY p.pid DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                if ($row['owner_id'] && $row['owner_name']) {
                    $user_link = '<span class="thumb_title"><a href ="$CPG_PROFILE_URL' . (defined('IN_POSTNUKE')?$row['owner_name']:$row['owner_id']) . '">' . $row['msg_author'] . '</a></span>';
                } else {
                    $user_link = '';
                } 
                $caption = $user_link . '<span class="thumb_caption">' . localised_date($row['ctime'], $lastup_date_fmt) . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Last uploads by a specific user
        case 'lastupby':
            $user_name = get_username(USER_ID);
            $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON (".VIS_GROUPS.") WHERE approved='YES' AND owner_id = '".USER_ID."' GROUP BY p.pid ORDER BY p.pid DESC");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns != '*') $select_columns .= ', owner_id, owner_name, p.aid';
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND owner_id = '$uid' GROUP BY p.pid ORDER BY p.pid DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                if ($row['owner_id'] && $row['owner_name']) {
                    $user_link = '<span class="thumb_title"><a href ="$CPG_PROFILE_URL' . (defined('IN_POSTNUKE')?$row['owner_name']:$row['owner_id']) . '">' . $row['msg_author'] . '</a></span>';
                } else {
                    $user_link = '';
                } 
                $caption = $user_link . '<span class="thumb_caption">' . localised_date($row['ctime'], $lastup_date_fmt) . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Most viewed pictures
        case 'topn':
            $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND hits > 0");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns == '*') {
                $select_columns = 'p.*';
            } else {
                $select_columns .= ', hits, p.aid';
            }
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND hits > 0 ORDER BY hits DESC $limit");
            //$result2 = db_query("SELECT FOUND_ROWS()");
            $rowset = db_fetch_rowset($result);
            //$nbEnr = mysql_fetch_array($result2);
            //$count = $nbEnr[0];
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                $caption = "<span class=\"thumb_caption\">" . sprintf($lang_get_pic_data['n_views'], $row['hits']) . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Top rated pictures
        case 'toprated':
            $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND p.votes >= {$CONFIG['min_votes_for_rating']}");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns == '*') {
                $select_columns = 'p.*';
            } else {
                $select_columns .= ', pic_rating, p.votes AS votes';
            }
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND p.votes >= '{$CONFIG['min_votes_for_rating']}' ORDER BY ROUND((pic_rating+1)/2000) DESC, p.votes DESC, filename $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                if (defined('THEME_HAS_RATING_GRAPHICS')) {
                    $theme_prefix = "$CONFIG[theme]/";
                } else {
                    $theme_prefix = '';
                } 
                $caption = "<img src=\"" . $CPG_M_DIR . "/" . $theme_prefix . "images/rating" . round($row['pic_rating'] / 2000) . ".gif\" align=\"center\" border=\"0\">" . "<br />" . round($row['pic_rating'] / 2000, 2) . "/5 ";
                $caption .= sprintf(N_VOTES, $row['votes']);
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Last viewed pictures
        case 'lasthits':
            // count the number of pics to show
            $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns != '*') $select_columns .= ', UNIX_TIMESTAMP(mtime) as mtime, aid';
            $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum GROUP BY p.pid ORDER BY mtime DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                $caption = "<span class=\"thumb_caption\">" . localised_date($row['mtime'], $lasthit_date_fmt) . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Random pictures
        case 'random':
            // count the number of pics to show
            $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' GROUP BY p.pid");
            $nbEnr = mysql_fetch_row($result);
            $pic_count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns != '*') $select_columns .= ', p.aid';
            // if we have more than 1000 pictures, we limit the number of picture returned
            // by the SELECT statement as ORDER BY RAND() is time consuming
            if ($pic_count > 1000) {
//                $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum GROUP BY p.pid");
//                $nbEnr = mysql_fetch_row($result);
                $total_count = $nbEnr[0];
                mysql_free_result($result);
                $granularity = floor($total_count / RANDPOS_MAX_PIC);
                $cor_gran = ceil($total_count / $pic_count);
                srand(time());
                for ($i = 1; $i <= $cor_gran; $i++) $random_num_set = rand(0, $granularity) . ', ';
                $random_num_set = substr($random_num_set, 0, -2);
                $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON (".VIS_GROUPS." AND $thisalbum) WHERE  randpos IN ($random_num_set) AND approved = 'YES' GROUP BY p.pid ORDER BY RAND() LIMIT $limit2");
            } else {
                $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' GROUP BY p.pid ORDER BY RAND() LIMIT $limit2");
            } 
            $rowset = db_fetch_rowset($result);
/*            $rowset = array();
            while ($row = mysql_fetch_array($result)) {
                $row['caption_text'] = '';
                $rowset[$row['pid']] = $row;
            }*/
            mysql_free_result($result);
            return $rowset;
            break;
        //All pictures by member
        case 'allby':
            $m_id = (isset($_GET['member_id'])) ? intval($_GET['member_id']) : 1;
            $result = db_query("SELECT * from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE owner_id = '$m_id' AND  approved='YES' GROUP BY p.pid ORDER BY p.pid DESC");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            if ($select_columns != '*') $select_columns .= ', owner_id, owner_name, p.aid';
            $result = db_query("SELECT $select_columns from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS.") WHERE owner_id = '$m_id' AND  approved='YES' GROUP BY p.pid ORDER BY p.pid DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            return $rowset;
            break;
        // Search results
        case 'search':
            if (isset($_GET['search'])) {
                $USER['search'] = $_GET['search'];
                if (isset($_GET['type']) && $_GET['type'] == 'full') {
                   $USER['search'] = '###' . $USER['search'];
                } 
            } elseif (isset($_POST['search'])) {
                $USER['search'] = $_POST['search'];
                if (isset($_POST['type']) && $_POST['type'] == 'full') {
                    $USER['search'] = '###' . $USER['search'];
                }
            }
            if (isset($USER['search'])) {
                $search_string = $USER['search'];
            } else {
                cpg_die(CRITICAL_ERROR, 'The searchstring is empty', __FILE__, __LINE__);
                $search_string = '';
            }
            if (substr($search_string, 0, 3) == '###') {
                $query_all = 1;
                $search_string = substr($search_string, 3);
            } else {
                $query_all = 0;
            } 
            $album_name .= ' - "' . strtr($search_string, $HTML_SUBST) . '"';
            require('search.inc');
            $rowset = search_pics($search_string, $select_columns, $query_all, $limit, $pic_count);
            $count = $pic_count;
            return $rowset;
            break;
        // Last albums to which uploads
        case 'lastalb':
            // count the number of pics to show
            $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS." AND $thisalbum) WHERE approved='YES' AND $thisalbum");
            $nbEnr = mysql_fetch_row($result);
            $count = $nbEnr[0];
            mysql_free_result($result);
            $result = db_query("SELECT *, a.title AS title, a.aid AS aid FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (p.aid = a.aid AND ".VIS_GROUPS."  AND $thisalbum) WHERE  approved = 'YES' GROUP  BY p.aid ORDER BY p.ctime DESC $limit");
            $rowset = db_fetch_rowset($result);
            mysql_free_result($result);
            if ($set_caption) foreach ($rowset as $key => $row) {
                $caption = "<span class=\"thumb_caption\">" . $row['title'] . " - " . localised_date($row['ctime'], $lastup_date_fmt) . '</span>';
                $rowset[$key]['caption_text'] = $caption;
            } 
            return $rowset;
            break;
        // Favourite Pictures
        case 'favpics':
            if (count($FAVPICS) > 0) {
                $favs = implode(",", $FAVPICS);
                $result = db_query("SELECT COUNT(*) from {$CONFIG['TABLE_PICTURES']} WHERE approved = 'YES' AND pid IN ($favs) GROUP BY pid");
                $nbEnr = mysql_fetch_array($result);
                $count = $nbEnr[0];
                mysql_free_result($result);
                $select_columns = '*';
                $result = db_query("SELECT $select_columns FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE approved = 'YES' AND pid IN ($favs) GROUP BY pid $limit");
                $rowset = db_fetch_rowset($result);
                mysql_free_result($result);
                if ($set_caption) foreach ($rowset as $key => $row) {
                    $caption = $rowset[$key]['title'] ? "<span class=\"thumb_caption\">" . ($rowset[$key]['title']) . "</span>" : '';
                    $rowset[$key]['caption_text'] = $caption;
                } 
                return $rowset;
            }
            else return null;
            break;
        // Invalid meta album
        default :
            cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    } 
} // End of get_pic_data
// Get the name of an album
function get_album_name($aid)
{
    global $CONFIG;
    global $lang_errors;
    $result = db_query("SELECT title from {$CONFIG['TABLE_ALBUMS']} WHERE aid='$aid'");
    $count = mysql_num_rows($result);
    if ($count > 0) {
        $row = mysql_fetch_array($result);
        return $row['title'];
    } else {
        cpg_die($lang_errors['non_exist_ap']);
    } 
} 
// Return the name of a user
function get_username($uid)
{
    global $CONFIG, $field_user_name, $field_user_id;
    $result = db_query("SELECT $field_user_name FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = '" . $uid . "'");
    $count = mysql_num_rows($result);
    if ($count > 0) {
        $row = mysql_fetch_array($result);
        return $row['username'];
    } else {
        return '';
    } 
} 
// Return the ID of a user
function get_userid($user_name)
{
    global $CONFIG, $field_user_id, $field_user_name;
    $user_name = addslashes($user_name); 
    // if ($user_id<2) {
    // return 0;
    // } else {
    $result = db_query("SELECT $field_user_id FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_name = '" . $user_name . "'");
    return $result; 
    // }
} 
// Return the total number of comments for a certain picture
function count_pic_comments($pid, $skip = 0)
{
    global $CONFIG;
    $result = db_query("SELECT count(*) from {$CONFIG['TABLE_COMMENTS']} where pid=$pid and msg_id!=$skip");
    $nbEnr = mysql_fetch_array($result);
    $count = $nbEnr[0];
    mysql_free_result($result);
    return $count;
} 
// Add 1 everytime a picture is viewed.
function add_hit($pid)
{
    global $CONFIG;
    db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hits=hits+1 WHERE pid='$pid'");
} 
// Build the breadcrumb array
function set_breadcrumb($lasturl = 0)
{
    global $CONFIG, $CPG_M_URL, $album, $cat, $field_user_name, $field_user_id, $lang_meta_album_names;
    $breadcrumb = array();
    $aid = $album;
    if ($cat < 0 && $cat != -$aid) {
        $aid = -$cat;
        $lasturl = 1;
    }
    if (is_numeric($aid) && $aid > 0) {
        $result = db_query("SELECT aid AS id, title, category AS parent FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".$aid);
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            $row['last'] = !$lasturl;
            $row['album'] = 1;
            $breadcrumb[] = $row;
            mysql_free_result($result);
        }
    }
    else if (is_numeric($cat) && $cat > 0) {
        if ($cat > FIRST_USER_CAT) {
            $result = db_query("SELECT $field_user_name AS title FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = " . ($cat - FIRST_USER_CAT));
            if (mysql_num_rows($result) != 0) {
                $row = mysql_fetch_array($result);
                $row['id'] = $cat;
                $row['parent'] = 1;
                $row['last'] = !$lasturl;
                $breadcrumb[] = $row;
                mysql_free_result($result);
            }
        }
        else {
            $result = db_query("SELECT cid as id, parent, catname AS title FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid='$cat'");
            if (mysql_num_rows($result) > 0) {
                $row = mysql_fetch_array($result);
                $row['last'] = !$lasturl;
                $breadcrumb[] = $row;
                mysql_free_result($result);
            }
        }
    }
    get_breadcrumb($breadcrumb);
    $navigation = '<a class="statlink" id="statlink" href="'.$CPG_M_URL.'">' . $CONFIG['gallery_name'] . '</a>';
    foreach($breadcrumb as $crumb) {
        if ($crumb['last']) $navigation .= " > ".$crumb['title'];
        elseif ($crumb['album']) $navigation .= ' > <a class="statlink" id="statlink" href="'.getlink("&file=thumbnails&album=".$crumb['id'])."\">".$crumb['title']."</a>";
        else $navigation .= " > <a class=\"statlink\" id=\"statlink\" href=\"$CPG_M_URL&cat=".$crumb['id']."\">".$crumb['title']."</a>";
    }
    if (!is_numeric($album)) switch ($album) {
        case 'lastup':
        case 'lastupby':
        case 'lastcom':
        case 'lastcomby':
        case 'topn':
        case 'toprated':
        case 'search':
        case 'random':
            $navigation .= " > ".$lang_meta_album_names[$album];
            break;
    }
    if ($navigation == "") $navigation = "> Coppermine";
    $dummy = array();
    theme_display_breadcrumb($navigation, $dummy);
}
// Get the breadcrumb array
function get_breadcrumb(&$breadcrumb)
{
    global $CONFIG, $field_user_name, $field_user_id;
    if (!$breadcrumb) return;
    $last = count($breadcrumb);
    if ($breadcrumb[0]['parent'] == 0 || !is_numeric($breadcrumb[0]['parent'])) return;
    if ($breadcrumb[$last-1]['parent'] > FIRST_USER_CAT) {
        $cat = $breadcrumb[$last-1]['parent'];
        $result = db_query("SELECT $field_user_name AS title FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = " . ($cat - FIRST_USER_CAT));
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            $row['id'] = $cat;
            $row['parent'] = 1;
            $breadcrumb[] = $row;
            mysql_free_result($result);
            get_breadcrumb($breadcrumb);
        }
        return;
    }
    $result = db_query("SELECT cid AS id, catname AS title, parent FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid=".$breadcrumb[$last-1]['parent']);
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        $breadcrumb[] = $row;
        if ($row['parent'] > 0 && is_numeric($row['parent'])) get_breadcrumb($breadcrumb);
        else {
            $breadcrumb = array_reverse($breadcrumb);
            return;
        }
    }
}
// Compute image geometry based on max width / height
function compute_img_size($width, $height, $max)
{
    global $CONFIG;
    $thumb_use = $CONFIG['thumb_use'];
    if ($thumb_use == 'ht') {
        $ratio = $height / $max;
    } elseif ($thumb_use == 'wd') {
        $ratio = $width / $max;
    } else {
        $ratio = max($width, $height) / $max;
    } 
    if ($ratio > 1.0) {
        $image_size['reduced'] = true;
    } 
    $ratio = max($ratio, 1.0);
    $image_size['width'] = ceil($width / $ratio);
    $image_size['height'] = ceil($height / $ratio);
    $image_size['geom'] = 'width="' . $image_size['width'] . '" height="' . $image_size['height'] . '"';
    return $image_size;
} 
function display_film_strip($meta, $album, $cat, $pos)
{
    global $CONFIG, $AUTHORIZED, $_GET;
    global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units;
    $max_item = $CONFIG['max_film_strip_items']; 
    $thumb_per_page = $max_item * 2;
    $l_limit = max(0, $pos - $CONFIG['max_film_strip_items']);
    $new_pos = max(0, $pos - $l_limit);
    $pic_data = get_pic_data($meta, $album, $thumb_count, $album_name, $l_limit, $thumb_per_page);
    if (count($pic_data) < $max_item) {
        $max_item = count($pic_data);
    } 
    $lower_limit = 3;
    if (!isset($pic_data[$new_pos + 1])) {
        $lower_limit = $new_pos - $max_item + 1;
    } else if (!isset($pic_data[$new_pos + 2])) {
        $lower_limit = $new_pos - $max_item + 2;
    } else if (!isset($pic_data[$new_pos-1])) {
        $lower_limit = $new_pos;
    } else {
        $hf = $max_item / 2;
        $ihf = (int)($max_item / 2);
        if ($new_pos > $hf) {
            $lower_limit = $new_pos - $ihf;
        } elseif ($new_pos < $hf) {
            $lower_limit = 0;
        } 
    } 
    $pic_data = array_slice($pic_data, $lower_limit, $max_item);
    $i = $l_limit;
    if (count($pic_data) > 0) {
        $meta_link = ($meta != '') ? '&amp;meta='.$meta : '';
        if (is_numeric($album)) {
            $alb_link = '&amp;album='.$album;
        } else {
            $alb_link = '&amp;cat='.(isset($cat) ? $cat : '0');
        }
        foreach ($pic_data as $key => $row) {
            $hi = (($pos == ($i + $lower_limit)) ? '1': '');
            $i++;
            $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
            if ($CONFIG['seo_alts'] == 0) {
                $pic_title = $lang_display_thumbnails['filename'] . $row['filename'] . "\n" . $lang_display_thumbnails['filesize'] . ($row['filesize'] >> 10) . $lang_byte_units[1] . "\n" . $lang_display_thumbnails['dimensions'] . $row['pwidth'] . "x" . $row['pheight'] . "\n" . $lang_display_thumbnails['date_added'] . localised_date($row['ctime'], $album_date_fmt);
            } else {
                if ($row['title'] != '') {
                    $pic_title = $row['title'];
                    if ($row['keywords'] != '') {
                        $pic_title .= "\n";
                        $pic_title .= $row['keywords'];
                    } 
                } elseif ($row['keywords'] != '') {
                    $pic_title = $row['keywords'];
                } else {
                    $pic_title = substr($row['filename'], 0, -4);
                } 
            } 
            stripslashes($pic_title);
            $p = $i - 1 + $lower_limit;
            $p = ($p < 0 ? 0 : $p);
            $thumb_list[$i]['pos'] = $key < 0 ? $key : $p; 
            if ($CONFIG['seo_alts'] == 0) {
                $thumb_list[$i]['image'] = "<img src=\"" . get_pic_url($row, 'thumb') . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\"></a>";
            } else {
                $thumb_list[$i]['image'] = "<img src=\"" . get_pic_url($row, 'thumb') . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"$pic_title\" title=\"$pic_title\"></a>";
            } 
            $thumb_list[$i]['caption'] = $row['caption_text'];
            $thumb_list[$i]['admin_menu'] = '';
            $thumb_list[$i]['url'] = getlink("&amp;file=displayimage$meta_link$alb_link&amp;pos=".$thumb_list[$i]['pos']);
        }
        return theme_display_film_strip($thumb_list);
    } else {
        theme_no_img_to_display($album_name);
    }
} //end display filmstrip
// Prints thumbnails of pictures in an album
function display_thumbnails($meta, $album, $cat, $page, $thumbcols, $thumbrows, $display_tabs)
{
    global $CONFIG, $AUTHORIZED, $_GET;
    global $album_date_fmt, $lang_display_thumbnails, $lang_errors, $lang_byte_units;
    $thumb_per_page = $thumbcols * $thumbrows;
    $lower_limit = ($page-1) * $thumb_per_page;
    $pic_data = get_pic_data($meta, $album, $thumb_count, $album_name, $lower_limit, $thumb_per_page);
    $total_pages = ceil($thumb_count / $thumb_per_page);
    $i = 0;
    if (count($pic_data) > 0) {
        $meta_link = ($meta != '') ? '&amp;meta='.$meta : '';
        if (is_numeric($album)) {
            $alb_link = '&amp;album='.$album;
        } else {
            $alb_link = '&amp;cat='.(isset($cat) ? $cat : '0');
        }
        $page_link = getlink('&amp;file=thumbnails'.$alb_link.$meta_link.'&amp;page=%d&amp;sort='.$_GET['sort']);
        foreach ($pic_data as $key => $row) {
            $i++;
            $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
            if ($CONFIG['seo_alts'] == 0) {
                $pic_title = $lang_display_thumbnails['filename'] . $row['filename'] . "\n" . $lang_display_thumbnails['filesize'] . ($row['filesize'] >> 10) . $lang_byte_units[1] . "\n" . $lang_display_thumbnails['dimensions'] . $row['pwidth'] . "x" . $row['pheight'] . "\n" . $lang_display_thumbnails['date_added'] . localised_date($row['ctime'], $album_date_fmt);
            } else {
                if ($row['title'] != '') {
                    $pic_title = $row['title'];
                    if ($row['keywords'] != '') {
                        $pic_title .= "\n";
                        $pic_title .= $row['keywords'];
                    } 
                } elseif ($row['keywords'] != '') {
                    $pic_title = $row['keywords'];
                } else {
                    $pic_title = substr($row['filename'], 0, -4);
                } 
            } 
            $pic_title = stripslashes($pic_title);
            if ($meta == 'random') {
                $thumb_list[$i]['pos'] = $row['pid'];
            } else {
                $thumb_list[$i]['pos'] = $key < 0 ? $key : $i - 1 + $lower_limit;
            }
            if ($CONFIG['seo_alts'] == 0) {
                $thumb_list[$i]['image'] = "<img src=\"" . get_pic_url($row, 'thumb') . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$row['filename']}\" title=\"$pic_title\">";
            } else {
                $thumb_list[$i]['image'] = "<img src=\"" . get_pic_url($row, 'thumb') . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"$pic_title\" title=\"$pic_title\">";
            } 
            $thumb_list[$i]['caption'] = $row['caption_text'];
            $thumb_list[$i]['pid'] = $row['pid'];
            $thumb_list[$i]['admin_menu'] = '';
            $thumb_list[$i]['url'] = getlink("&amp;file=displayimage$meta_link$alb_link&amp;pos=".$thumb_list[$i]['pos']);
        } 
        theme_display_thumbnails($thumb_list, $thumb_count, $album_name, $page_link, $page, $total_pages, is_numeric($album), $display_tabs);
    } else {
        theme_no_img_to_display($album_name);
    }
} 
// Return the url for a picture, allows to have pictures spreaded over multiple servers
function get_pic_url(&$pic_row, $mode)
{
    global $CONFIG;
    static $pic_prefix = array();
    static $url_prefix = array();
    if (!count($pic_prefix)) {
        $pic_prefix = array('thumb' => $CONFIG['thumb_pfx'],
            'normal' => $CONFIG['normal_pfx'],
            'fullsize' => ''
        );
        $url_prefix = array(0 => $CONFIG['fullpath']);
    } 
    return path2url($pic_row['filepath'] . $pic_prefix[$mode] . $pic_row['filename']);
} 
function print_debug()
{
    global $_GET, $_POST, $_SERVER, $CPG_URL, $CPG_M_DIR;
    global $USER, $CONFIG, $time_start, $query_stats,$first_install_M_DIR;
    global $name;
    echo "<br />";
    if ($CONFIG['debug_mode'] AND USER_IS_ADMIN) {
        $time_end = get_mt();
        $time = round($time_end - $time_start, 3);
        $query_count = count($query_stats);
        $query_times = '';
        $total_query_time = 0;
        foreach ($query_stats as $qtime) {
            $query_times .= round($qtime, 3) . "s ";
            $total_query_time += $qtime;
        } 
        $total_query_time = round($total_query_time, 3);
        OpenTable();
        echo '<table width="100%">';
        print '<caption>Debug info</caption>';
        print '<tr><td class="tableh1" colspan="2"><span class="statlink"><strong>Integretion vars</strong></span></td></tr>';
        print '<tr><td>';
        print "Selected Nuke Theme:</td><td> $GLOBALS[ThemeSel]";
        print '</td></tr><tr class="code"><td>';
        print "Nuke Version:</td><td> $GLOBALS[Version_Num]";
        print '</td></tr><tr><td>';
        print 'Module path</td><td>' . $CPG_M_DIR;
        print '</td></tr><tr class="code"><td>';
        print 'Nukelink</td><td>' . $CPG_URL;
        print '</td></tr><tr><td>';
        print "Coppermine Theme:</td><td> $CONFIG[theme]";
        print '</td></tr>';
        print '<tr><td class="tableh1" colspan="2"><span class="statlink"><strong>$_SERVER vars</strong></span></td></tr>';
        print '<tr><td>';
        print "DOCUMENT_ROOT:</td><td> $_SERVER[DOCUMENT_ROOT]";
        print '</td></tr><tr class="code"><td>';
        if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) {
            print "HTTP_ACCEPT_CHARSET:</td><td> $_SERVER[HTTP_ACCEPT_CHARSET]";
            print '</td></tr><tr><td>';
        } 
        print "HTTP_ACCEPT_LANGUAGE:</td><td> $_SERVER[HTTP_ACCEPT_LANGUAGE]";
        print '</td></tr><tr class="code"><td>';
        print "HTTP_USER_AGENT:</td><td> $_SERVER[HTTP_USER_AGENT]";
        print '</td></tr><tr><td>';
        print "SCRIPT_FILENAME:</td><td> $_SERVER[SCRIPT_FILENAME]";
        print '</td></tr><tr class="code"><td>';
        print '</td></tr><tr><td>';
        print "QUERY_STRING:</td><td> $_SERVER[QUERY_STRING]";
        print '</td></tr><tr class="code"><td>';
        print "PHP_SELF:</td><td> $_SERVER[PHP_SELF]";
        print '</td></tr>';
        print '<tr><td class="tableh1" colspan="2"><span class="statlink"><strong>CPG Config</strong></span></td></tr>';
        print '<tr><td>';
        print 'TABLE_PICTURES</td><td>' . $CONFIG['TABLE_PICTURES'];
        print '</td></tr><tr class="code"><td>';
        print 'TABLE_ALBUMS</td><td>' . $CONFIG['TABLE_ALBUMS'];
        print '</td></tr><tr><td>';
        print 'TABLE_COMMENTS</td><td>' . $CONFIG['TABLE_COMMENTS'];
        print '</td></tr><tr class="code"><td>';
        print 'TABLE_CATEGORIES</td><td>' . $CONFIG['TABLE_CATEGORIES'];
        print '</td></tr><tr><td>';
        print 'TABLE_CONFIG</td><td>' . $CONFIG['TABLE_CONFIG'];
        print '</td></tr><tr class="code"><td>';
        print 'TABLE_USERGROUPS</td><td>' . $CONFIG['TABLE_USERGROUPS'];
        print '</td></tr><tr><td>';
        print 'TABLE_VOTES</td><td>' . $CONFIG['TABLE_VOTES'];
        print '</td></tr><tr class="code"><td>';
        print 'TABLE_USERS</td><td>' . $CONFIG['TABLE_USERS'];
        print '</td></tr><tr><td>';
        print 'allow_private_albums</td><td>' . $CONFIG['allow_private_albums'];
        print '</td></tr><tr class="code"><td>';
        print 'Site url (ecards_more_pic_target)</td><td>' . $CONFIG['ecards_more_pic_target'];
        print '</td></tr><tr><td>';
        print 'fullpath</td><td>' . $CONFIG['fullpath'];
        print '</td></tr><tr class="code"><td>';
        print 'USER_IN_GROUPS</td><td>' . USER_IN_GROUPS;
        print '</td></tr><tr><td>';
        print 'Default Language</td><td>' . $CONFIG['lang'];
        print '</td></tr><tr class="code"><td>';
        print 'Language Directory</td><td>' . $first_install_M_DIR;
        print '</td></tr>';
        print '<tr><td class="tableh1" colspan="2"><span class="statlink"><strong>Queries</strong></span></td></tr>';
        print '<tr><td valign="top">';
        echo "GET</td><td><pre>";
        print_r($_GET);
        print '</pre></td></tr><tr class="code"><td valign="top">';
        print 'POST</td><td><pre>';
        print_r($_POST);
        echo "</pre></td></tr><td align=\"center\" colspan=\"2\">";
        echo <<<EOT
                Page generated in <strong>$time</strong> seconds - <strong>$query_count</strong> queries in <strong>$total_query_time</strong> seconds.
EOT;
        echo "</td></tr></table>";
        CloseTable();
        echo "<br />";
        if ($CONFIG['advanced_debug_mode']) {
            // change to advanced_debug_mode
            OpenTable();
            print '<table width="100%"><caption>Advanced debug mode</caption>';
            echo "<tr><td class=\"tableb\" colspan=\"2\">";
            include_once($CPG_M_DIR . "/include/phpinfo.inc");
            echo "</td></tr></table>";
            CloseTable();
        } 
    } 
} 
function speedup_pictures()
{
    global $CONFIG;
    // Speed-up the random image query by 'keying' the image table
    $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1");
    $nbEnr = mysql_fetch_array($result);
    mysql_free_result($result);
    $pic_count = $nbEnr[0];
    $granularity = floor($pic_count / RANDPOS_MAX_PIC);
    if ($granularity != $CONFIG['randpos_interval'] && $pic_count > RANDPOS_MAX_PIC) {
        $result = db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET randpos = ROUND(RAND()*$granularity) WHERE 1");
        $result = db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$granularity' WHERE name = 'randpos_interval'");
    }
}
?>