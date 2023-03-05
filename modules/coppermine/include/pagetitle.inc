<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke RC3                               //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
// file by gtroll and sensara                                               //
// ------------------------------------------------------------------------- //
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
/**
 * moved to english.php customized in your language file if you wish
 * $lang_pagetitle_php = array(
 * 'viewing' => 'Viewing Photo',
 * 'usr' => "'s Photo Gallery",
 * 'photogallery' => 'Photo Gallery',
 * );
 * END of moved
 */
// customize if you wish
define('divider' , '>');
/**
 * END OF USER DEFINED VARIABLES
 */
global $user_prefix, $cpg_prefix, $CPG_M_DIR;
// Process language selection
global $lang_pagetitle_php, $currentlang, $language;
if (file_exists($CPG_M_DIR . "/lang/$currentlang.php")) {
    $USER['lang'] = $currentlang;
} else {
    $USER['lang'] = $language;
} 
if (!file_exists($CPG_M_DIR . "/lang/{$USER['lang']}.php")) {
    if (!file_exists($CPG_M_DIR . "/lang/{$CONFIG['lang']}.php")) {
        $CONFIG['lang'] = 'english';
    } 
} else {
    $CONFIG['lang'] = $USER['lang'];
} 
include $CPG_M_DIR . "/lang/{$CONFIG['lang']}.php"; //sengsara
// define variables
$pos = isset($pos) ? (int)$pos : 0;
$humanpos = $pos + 1;
$cat = isset($cat) ? (int)$cat : 0;
$album = isset($album) ? $album : '';
$file = isset($file) ? $file : '';
switch ($album) {
    case 'lastup':
    case 'lastcom':
    case 'topn':
    case 'toprated':
    case 'search':
    case 'random':
        $ttrail = " " . divider . " $lang_meta_album_names[$album] ";
        break;
    default:
        $ttrail = '';
        break;
} //end sorted galleries
switch ($file) {
    case 'thumbnails': // filename thumbnail
        if (is_numeric($album)) {
            $sql = "SELECT title FROM ".$cpg_prefix."albums WHERE aid='$album'";
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
            $albumname = $row['title'];
            $pagetitle = "$lang_pagetitle_php[photogallery]  " . divider . " $albumname $ttrail"; //regular album
        } else { // meta album
            if (isset($cat) && $cat != 0) { // have category
                if ($cat < 0) {
                    $sql = "SELECT title FROM ".$cpg_prefix."albums WHERE aid='" . (- $cat) . "'";
                    $result = $db->sql_query($sql);
                    $row = $db->sql_fetchrow($result);
                    $albumname = $row['title'];
                } elseif ($cat < 10000) {
                    $sql = "SELECT owner_id FROM ".$cpg_prefix."categories WHERE cid='$cat'";
                    $result = $db->sql_query($sql);
                    $row = $db->sql_fetchrow($result);
                    $albumname = $row['owner_id'];
                } else {
                    $sql = "SELECT $field_user_name FROM $CONFIG[TABLE_USERS] WHERE $field_user_id='" . ($cat-10000) . "'";
                    $result = $db->sql_query($sql);
                    $row = $db->sql_fetchrow($result);
                    $albumname = $row[$field_user_name];
                    $albumname = "$albumname$lang_pagetitle_php[usr]";
                } 
            } else {
                $pagetitle = "$lang_cat_list[pictures] $ttrail";
                if ($search) $pagetitle = "$lang_cat_list[pictures] $ttrail: $search";
            } 
        } // end album selection
        break;
    case 'displayimage': // filename displayimage
        if (is_numeric($album)) { // regular album
            $sql = "SELECT title FROM ".$cpg_prefix."albums WHERE aid='$album'";
            $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
            $albumname = $row[title];
            if ($slideshow) {
                $pagetitle = "$albumname $lang_pagetitle_php[photogallery] Slideshow";
            } else { // Viewing Normal Picture
                $sql = "SELECT filename, title FROM ".$cpg_prefix."pictures WHERE pid=$pid";
                $result = $db->sql_query($sql);
                $row = $db->sql_fetchrow($result);
                $pictitle = $row[title];
                if ($pictitle == '') {
                    $pictitle = $row[filename];
                    if ($pictitle == '') $pos + 1;
                }
                $pagetitle = "$albumname  " . divider . " $lang_pagetitle_php[viewing]  " . divider . " $pictitle $ttrail";
/*
                $picname = $row[filename];
                $humanpos = $pos + 1;
                if ($pictitle != '') {
                    $pagetitle = "$albumname  " . divider . " $lang_pagetitle_php[viewing]  " . divider . " $pictitle $ttrail";
                } elseif ($picname != '') {
                    $pagetitle = "$albumname  " . divider . " $lang_pagetitle_php[viewing]  " . divider . " $picname $ttrail";
                } else {
                    $pagetitle = "$albumname " . divider . " $lang_pagetitle_php[viewing] " . divider . " $humanpos $ttrail";
                } 
*/
            } 
        } else { // meta album
            if ($pos < 0) { // neg pos
                $sql = "SELECT aid, filename, title, caption FROM ".$cpg_prefix."pictures WHERE pid='" . (- $pos) . "'";
                $result = $db->sql_query($sql);
                $row = $db->sql_fetchrow($result);
                $sql2 = "SELECT title WHERE aid='" . $row['aid'] . "'";
                $result2 = $db->sql_query($sql);
                $row2 = $db->sql_fetchrow($result);
                $albumname = $row2['title'];
                $pictitle = $row['title'];
                if ($pictitle == '') {
                    $pictitle = $row['caption'];
                    if ($pictitle == '') $pos + 1;
                }
                $pagetitle = "$albumname  " . divider . " $lang_pagetitle_php[viewing]  " . divider . " $pictitle $ttrail";
/*
                $picfilename = $row['filename'];
                $picname = $row['caption'];
                $humanpos = $pos + 1;
                if ($pictitle != '') {
                    $pagetitle = "$albumname " . divider . " $lang_pagetitle_php[viewing] " . divider . " $pictitle $ttrail";
                } elseif ($picname != '') {
                    $pagetitle = "$albumname " . divider . " $lang_pagetitle_php[viewing] " . divider . " $picname $ttrail";
                } else {
                    $pagetitle = "$albumname " . divider . " $lang_pagetitle_php[viewing] " . divider . " $humanpos $ttrail";
                } //end neg pos 
*/
            } else { // positive pos
                if ($cat) {
                    if ($cat < 0) { // if less 0
                        $sql = "SELECT title FROM ".$cpg_prefix."albums WHERE aid='" . (- $cat) . "'";
                        $result = $db->sql_query($sql);
                        $row = $db->sql_fetchrow($result);
                        $albumname = $row[title];
                        $pagetitle = "$albumname $ttrail " . divider . " $lang_pagetitle_php[viewing] $humanpos $ttrail";
                    } 
                } else {
                    $pagetitle = "$lang_pagetitle_php[photogallery] $ttrail " . divider . " $lang_pagetitle_php[viewing] $humanpos $ttrail";
                } 
            } // end positive pos
        } //end meta album 
        break;
    case 'search':
        $pagetitle = "$lang_pagetitle_php[photogallery] " . divider . " $lang_search_php[0]";
        break;
    case 'upload' :
        $pagetitle = "$lang_pagetitle_php[photogallery] " . divider . " $lang_main_menu[upload_pic_lnk]";
        break;
    case 'displayimagepopup' :
        $pagetitle = "$lang_pagetitle_php[photogallery] " . divider . " $lang_main_menu[upload_pic_lnk]";
        break;
    case 'ecard' :
        $pagetitle = "$lang_pagetitle_php[photogallery] " . divider . " $lang_ecard_php[title]";
        break;
    case 'editpics' :
        $pagetitle = "$lang_editpics_php[edit_pics]";
        break;
    case 'groupmgr' :
        $pagetitle = "$lang_groupmgr_php[title]";
        break;
    case 'reviewcom' :
        $pagetitle = "$lang_reviewcom_php[title]";
        break;
    case 'searchnew' :
        $pagetitle = "$lang_search_new_php[page_title]";
        break;
    case 'upload' :
        $pagetitle = "$lang_upload_php[title]";
        break;
    default:
        $pagetitle = "$lang_pagetitle_php[photogallery] ";
        break;
} //end switch 
switch ($cat) { // have category
    case ($cat < 0):
        $sql = "SELECT title FROM ".$cpg_prefix."albums WHERE aid='" . (- $cat) . "'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $albumname = $row['title'];
        break;
    case (($cat > 0) && ($cat < 10000)) :
        $sql = "SELECT catname FROM ".$cpg_prefix."categories WHERE cid='$cat'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $albumname = $row[catname];
        break;
    case ($cat > 10000) :// cat is between 1 and 9999 user gallery
        $sql = "SELECT $field_user_name FROM " . $user_prefix . "_users WHERE $field_user_id = '" . ($cat-10000) . "'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $albumname = $row[$field_user_name];
        $albumname = "$albumname$lang_pagetitle_php[usr]";
        break;
} //end category switch cases         
if ($cat != 0)$pagetitle = "$lang_pagetitle_php[photogallery] " . divider . " $albumname $ttrail";
?>
