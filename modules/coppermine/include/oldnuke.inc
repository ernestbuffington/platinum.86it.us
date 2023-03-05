<?php 
// Coppermine Photo Gallery 1.2.2a for CMS                                   //
/**
 * oldnuke.php                                                           *
 * 
 * is a class simulator to use phpNuke 6.5+ modules in phpNuke 5.5 - 6.0 *
 * Be aware that not every new module will work because they want access *
 * to the BB tables or similar.                                          *
 *                                                                       *
 * ----------------------------------------------------------------------*
 *                                                                       *
 * Copyright (C) 2003   DJ Maze, www.mp3tunes.nl                         *
 * This file is created for the Coppermine Photo Gallery phpNuke version *
 *                   http://coppermine.sourceforge.net                   *
 *                                                                       *
 * This file may be freely distributed and altered for free use under    *
 * the GNU General Public License as published by the Free Software      *
 * Foundation; either version 2 of the License, or at your option) any   *
 * later version.                                                        *
 * You may not ask money or user information like email or address       *
 * before they can download this file.                                   *
 * This file, a modification or part may not be included in a commercial *
 * product, unless this full comment is included in the product license. *
 ************************************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
define('IN_OLDNUKE', true);
//define('BEGIN_TRANSACTION', 1);
define('END_TRANSACTION', 2);
$field_user_id = "uid";
$field_user_name = "uname";
$field_user_pass = "pass";
$field_user_email = "email";
$field_user_from = "user_from";
class sql_db {
    var $dbi;
    var $query_result;
    var $row = array();
    // Constructor
    function sql_db($dbindex)
    {
        $this->dbi = $dbindex;
    } 
    function sql_query($query = "", $transaction = false)
    { 
        // If the module uses $db-> properly you can uncomment these
        // $query = preg_replace('/user_id/', 'uid', $query);
        // $query = preg_replace('/username/', 'uname', $query);
        // $query = preg_replace('/user_email/', 'email', $query);
        // $query = preg_replace('/user_password/', 'pass', $query);
        // $query = preg_replace('/user_website/', 'url', $query);
        // $query = preg_replace('/user_interests/', 'user_intrest', $query);
        // Remove any pre-existing queries
        unset($this->query_result);
        if ($query != "") {
            $this->query_result = sql_query($query, $this->dbi);
        }
        if ($this->query_result) {
            unset($this->row[$this->query_result]);
            return $this->query_result;
        } else {
            return ($transaction == END_TRANSACTION) ? true : false;
        } 
    } 
    function sql_fetchrow($query_id = 0)
    {
        if (!$query_id) {
            $query_id = $this->query_result;
        } 
        if ($query_id) {
            $this->row[$query_id] = @mysql_fetch_array($query_id);
            return $this->row[$query_id];
//            $this->row[$query_id] = sql_fetch_row($query_id, 0);
//            return $this->row[$query_id];
        } else {
            return false;
        } 
    } 
}
$db = new sql_db($dbi);
?>
