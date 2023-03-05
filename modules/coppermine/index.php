<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.1D for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
/**********************************/
/*  Module Configuration          */
/* (right side on) v3.1           */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
define('INDEX_FILE', true);
$index = 1;
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('INDEX_PHP', true);
if ($mode == 'smilies') {
    require("includes/nbbcode.php");
    echo smilies_table("window", $field, $form);
    exit;
}
require("modules/" . $name . "/include/load.inc");
//  Local functions definition  //
function html_albummenu($id)
{
    global $template_album_admin_menu, $lang_album_admin_menu;
    static $template = '';
// Altered security issue by Pc-Nuke! 12.23.05 -- start //
    //if ($template == '') {
        //$params = array('{CONFIRM_DELETE}' => $lang_album_admin_menu['confirm_delete'],
           // '{DELETE}' => $lang_album_admin_menu['delete'],
            //'{MODIFY}' => $lang_album_admin_menu['modify'],
            //'{EDIT_PICS}' => $lang_album_admin_menu['edit_pics'],
           // );
       // $template = template_eval($template_album_admin_menu, $params);
    //} 
// Altered security issue by Pc-Nuke! 12.23.05 -- end //
    $params = array('{ALBUM_ID}' => $id,);
    return template_eval($template, $params);
} 
function get_subcat_data($parent, &$cat_data, &$album_set_array, $level, $ident = '')
{
    global $CONFIG, $HIDE_USER_CAT, $CPG_M_DIR, $CPG_M_URL;
    $result = db_query("SELECT cid, catname, description FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent' ORDER BY pos");
    if (mysql_num_rows($result) > 0) {
        $rowset = db_fetch_rowset($result);
        foreach ($rowset as $subcat) {
            if ($subcat['cid'] == USER_GAL_CAT) {
                $result = db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category >= " . FIRST_USER_CAT);
                $album_count = mysql_num_rows($result);
                while ($row = mysql_fetch_array($result)) {
                    $album_set_array[] = $row['aid'];
                } // while
                mysql_free_result($result);
                $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND category >= " . FIRST_USER_CAT);
                $nbEnr = mysql_fetch_array($result);
                $pic_count = $nbEnr[0];
                $subcat['description'] = preg_replace("/<br.*?>[\r\n]*/i", '<br />' . $ident , bb_decode($subcat['description']));
                $link = $ident . "<a href=$CPG_M_URL&cat={$subcat['cid']}>{$subcat['catname']}</a>";
                if ($album_count) {
                    $cat_data[] = array($link, $ident . $subcat['description'], $album_count, $pic_count);
                    $HIDE_USER_CAT = 0;
                } else {
                    $HIDE_USER_CAT = 1;
                } 
            } else {
                $result = db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = {$subcat['cid']}");
                $album_count = mysql_num_rows($result);
                while ($row = mysql_fetch_array($result)) {
                    $album_set_array[] = $row['aid'];
                } // while
                mysql_free_result($result);
                $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND category = {$subcat['cid']}");
                $nbEnr = mysql_fetch_array($result);
                mysql_free_result($result);
                $pic_count = $nbEnr[0];
                $subcat['catname'] = $subcat['catname'];
                $subcat['description'] = preg_replace("/<br.*?>[\r\n]*/i", '<br />' . $ident , bb_decode($subcat['description']));
                $link = $ident . "<a href=\"$CPG_M_URL&cat={$subcat['cid']}\">{$subcat['catname']}</a>";
                if ($pic_count == 0 && $album_count == 0) {
                    $cat_data[] = array($link, $ident . $subcat['description']);
                }
                else {
                    // Check if you need to show subcat_level
                    if ($level == $CONFIG['subcat_level']) $cat_albums = list_cat_albums($subcat['cid']);
                    else $cat_albums = '';
                    $cat_data[] = array($link, $ident . $subcat['description'], $album_count, $pic_count, 'cat_albums' => $cat_albums);
                } 
            } 
            if ($level > 1) get_subcat_data($subcat['cid'], $cat_data, $album_set_array, $level -1, $ident . "<img src=\"" . $CPG_M_DIR . "/images/spacer.gif\" width=\"20\" height=\"1\">");
        } 
    } 
} 
// List all categories
function get_cat_list(&$cat_data, &$statistics)
{
    global $CONFIG, $BREADCRUMB_TEXT, $STATS_IN_ALB_LIST;
    global $HIDE_USER_CAT;
    global $cat;
    global $lang_list_categories, $lang_errors; 
    // Build the category list
    $cat_data = array();
    $album_set_array = array();
    get_subcat_data($cat, $cat_data, $album_set_array, $CONFIG['subcat_level']);
    // Add the albums in the current category to the album set
    if ($cat) {
        if ($cat == USER_GAL_CAT) {
            $result = db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category >= " . FIRST_USER_CAT);
        }
        else {
            $result = db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = '$cat'");
        }
        while ($row = mysql_fetch_array($result)) {
            $album_set_array[] = $row['aid'];
        } // while
        mysql_free_result($result);
    }
    if (count($album_set_array) && $cat) {
        $set = '';
        foreach ($album_set_array as $album) $set .= $album . ',';
        $set = substr($set, 0, -1);
        $current_album_set = "AND aid IN ($set) ";
    } elseif ($cat) {
        $current_album_set = "AND aid IN (-1) ";
    }
    // Gather gallery statistics
    if ($cat == 0) {
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_ALBUMS']} WHERE 1");
        $nbEnr = mysql_fetch_array($result);
        $album_count = $nbEnr[0];
        mysql_free_result($result);
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1");
        $nbEnr = mysql_fetch_array($result);
        $picture_count = $nbEnr[0];
        mysql_free_result($result);
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_COMMENTS']} WHERE 1");
        $nbEnr = mysql_fetch_array($result);
        $comment_count = $nbEnr[0];
        mysql_free_result($result);
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_CATEGORIES']} WHERE 1");
        $nbEnr = mysql_fetch_array($result);
        $cat_count = $nbEnr[0] - $HIDE_USER_CAT;
        mysql_free_result($result);
        $result = db_query("SELECT sum(hits) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1");
        $nbEnr = mysql_fetch_array($result);
        $hit_count = (int)$nbEnr[0];
        mysql_free_result($result);
        if (count($cat_data)) {
            $statistics = strtr($lang_list_categories['stat1'], array('[pictures]' => $picture_count,
                    '[albums]' => $album_count,
                    '[cat]' => $cat_count,
                    '[comments]' => $comment_count,
                    '[views]' => $hit_count));
        } else {
            $STATS_IN_ALB_LIST = true;
            $statistics = strtr($lang_list_categories['stat3'], array('[pictures]' => $picture_count,
                    '[albums]' => $album_count,
                    '[comments]' => $comment_count,
                    '[views]' => $hit_count));
        } 
    } elseif ($cat >= FIRST_USER_CAT && $current_album_set) {
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_ALBUMS']} WHERE 1 $current_album_set");
        $nbEnr = mysql_fetch_array($result);
        $album_count = $nbEnr[0];
        mysql_free_result($result);
        $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1 $current_album_set");
        $nbEnr = mysql_fetch_array($result);
        $picture_count = $nbEnr[0];
        mysql_free_result($result);
        $result = db_query("SELECT sum(hits) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1 $current_album_set");
        $nbEnr = mysql_fetch_array($result);
        $hit_count = (int)$nbEnr[0];
        mysql_free_result($result);
        $statistics = strtr($lang_list_categories['stat2'], array('[pictures]' => $picture_count,
                '[albums]' => $album_count,
                '[views]' => $hit_count));
    } else {
        $statistics = '';
    } 
} 
function list_users()
{
    global $CONFIG, $PAGE, $CPG_M_DIR, $CPG_M_URL;
    global $lang_list_users, $lang_errors, $template_user_list_info_box;
    global $field_user_id, $field_user_name, $field_user_avatar;
    $sql = "SELECT $field_user_id, " .
           "$field_user_name, $field_user_avatar as avatar, " .
           "COUNT(DISTINCT a.aid) as alb_count, " .
           "COUNT(DISTINCT pid) as pic_count, " .
           "MAX(pid) as thumb_pid " .
           "FROM {$CONFIG['TABLE_USERS']} AS u " .
           "INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON (category = " . FIRST_USER_CAT . " + $field_user_id " . " AND ".VIS_GROUPS.")".
           "LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p ON (p.aid = a.aid AND approved = 'YES') " .
           "GROUP BY $field_user_id ORDER BY $field_user_name";
    $result = db_query($sql);
    $user_count = mysql_num_rows($result);
    if (!$user_count) {
        msg_box($lang_list_users['user_list'], $lang_list_users['no_user_gal'], '', '', '100%');
        mysql_free_result($result);
        return;
    } 
    $user_per_page = $CONFIG['thumbcols'] * $CONFIG['thumbrows'];
    $totalPages = ceil($user_count / $user_per_page);
    if ($PAGE > $totalPages) $PAGE = 1;
    $lower_limit = ($PAGE-1) * $user_per_page;
    $upper_limit = min($user_count, $PAGE * $user_per_page);
    $row_count = $upper_limit - $lower_limit;
    $rowset = array();
    $i = 0;
    mysql_data_seek($result, $lower_limit);
    while (($row = mysql_fetch_array($result)) && ($i++ < $row_count)) $rowset[] = $row;
    mysql_free_result($result);
    $user_list = array();
    for ($i = 0; $i < $row_count; $i++) {
        $user = &$rowset[$i];
        $user_thumb = '<img src="' . $CPG_M_DIR . '/images/nopic.jpg" alt="'.$lang_errors[no_img_to_display].'" class="image" border="0">';
        $user_pic_count = $user['pic_count'];
        $user_thumb_pid = $user['thumb_pid'];
        $user_album_count = $user['alb_count'];
        // NEW gtroll add as config opt
        $avatar = $user['avatar'];
        if (!preg_match("/blank.gif/", $avatar) && strlen($avatar) > 3 && $CONFIG['avatar_private_album']) {
            if (preg_match("/(http)/", $avatar)) {
                $user_thumb = "<img src=\"$avatar\">";
            } else if (file_exists("images/avatars/$avatar")) {
                $user_thumb = "<img src=\"images/avatars/$avatar\">";
            } else {
                $user_thumb = "<img src=\"modules/Forums/images/avatars/$avatar\">";
            }
        // END NEW gtroll
        } else if ($user_pic_count) {
            $sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " .
                   "FROM {$CONFIG['TABLE_PICTURES']} " .
                   "WHERE pid='$user_thumb_pid'";
            $result = db_query($sql);
            if (mysql_num_rows($result)) {
                $picture = mysql_fetch_array($result);
                mysql_free_result($result);
                $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['thumb_width']);
                $user_thumb = "<img src=\"" . get_pic_url($picture, 'thumb') . "\" {$image_size['geom']} alt=\"".$user[$field_user_name]."\" border=\"0\" class=\"image\">"; // $user[$field_user_name]
            }
        } 
        $albums_txt = sprintf($lang_list_users['n_albums'], $user_album_count);
        $pictures_txt = sprintf($lang_list_users['n_pics'], $user_pic_count);
        $params = array('{username}' => $user[$field_user_name],
            '{USER_ID}' => $user[$field_user_id],
            '{ALBUMS}' => $albums_txt,
            '{PICTURES}' => $pictures_txt,
        );
        $caption = template_eval($template_user_list_info_box, $params);
        $user_list[] = array('cat' => FIRST_USER_CAT + $user[$field_user_id],
            'image' => $user_thumb,
            'caption' => $caption,
            'url' => "$CPG_M_URL&cat=".(FIRST_USER_CAT + $user[$field_user_id]),
        );
    } 
    $page_link = $CPG_M_URL.'&amp;cat=1&amp;page=%d';
    theme_display_thumbnails($user_list, $user_count, '', $page_link, $PAGE, $totalPages, false, true, 'user');
} 
// List (category) albums
// Redone for a cleaner approach: DJMaze
function list_cat_albums($cat = 0, $buffer = true)
{
    global $CONFIG, $USER, $PAGE, $lastup_date_fmt, $USER_DATA, $CPG_M_DIR;
    global $lang_list_albums, $lang_errors;
    if ($cat == 0 && $buffer) return '';
    if ($cat == "") $cat = 0;
    $alb_per_page = $CONFIG['albums_per_page'];
    $maxTab = $CONFIG['max_tabs'];
    if (!USER_IS_ADMIN && !$CONFIG['show_private']){
        $visible = "AND ".VIS_GROUPS;// NEW gtroll
    }
    $result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat $visible");
    $nbEnr = mysql_fetch_array($result);
    $nbAlb = $nbEnr[0];
    mysql_free_result($result);
    if ($nbAlb == 0) return '';
    $totalPages = ceil($nbAlb / $alb_per_page);
    if (isset($_GET['page'])) $PAGE = max((int)$_GET['page'], 1);
    if ($PAGE > $totalPages || $cat != $_GET['cat']) $PAGE = 1;
    $lower_limit = ($PAGE-1) * $alb_per_page;
    $upper_limit = min($nbAlb, $PAGE * $alb_per_page);
    $sql = "SELECT a.aid, a.title, a.description, visibility, filepath, " .
           "filename, url_prefix, pwidth, pheight " .
           "FROM {$CONFIG['TABLE_ALBUMS']} as a " .
           "LEFT JOIN {$CONFIG['TABLE_PICTURES']} as p ON thumb=pid " .
           "WHERE category = '$cat' $visible ORDER BY pos " .
           "LIMIT " . $lower_limit . "," . ($upper_limit - $lower_limit);
    $alb_thumbs_q = db_query($sql);
    $alb_thumbs = db_fetch_rowset($alb_thumbs_q);
    mysql_free_result($alb_thumbs_q);
    $disp_album_count = count($alb_thumbs);
    $album_set = '';
    foreach($alb_thumbs as $value) {
        $album_set .= $value['aid'] . ', ';
    } 
    $album_set = '(' . substr($album_set, 0, -2) . ')';
    $sql = "SELECT aid, count(pid) as pic_count, max(pid) as last_pid, max(ctime) as last_upload " .
           "FROM {$CONFIG['TABLE_PICTURES']} " .
           "WHERE aid IN $album_set AND approved = 'YES' " .
           "GROUP BY aid";
    $alb_stats_q = db_query($sql);
    $alb_stats = db_fetch_rowset($alb_stats_q);
    mysql_free_result($alb_stats_q);
    foreach($alb_stats as $key => $value) {
        $cross_ref[$value['aid']] = &$alb_stats[$key];
    }
    for ($alb_idx = 0; $alb_idx < $disp_album_count; $alb_idx++) {
        $alb_thumb = &$alb_thumbs[$alb_idx];
        $aid = $alb_thumb['aid'];
        if (isset($cross_ref[$aid])) {
            $alb_stat = $cross_ref[$aid];
            $count = $alb_stat['pic_count'];
        } else {
            $alb_stat = array();
            $count = 0;
        } 
        // Inserts a thumbnail if the album contains 1 or more images
        $visibility = $alb_thumb['visibility'];
        if ($visibility == '0' || $visibility == (FIRST_USER_CAT + USER_ID) || $visibility == $USER_DATA['group_id'] || USER_IS_ADMIN) {
            if ($count > 0) { // Inserts a thumbnail if the album contains 1 or more images
                if ($alb_thumb['filename']) {
                    $picture = &$alb_thumb;
                } else {
                    $sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='{$alb_stat['last_pid']}'";
                    $result = db_query($sql);
                    $picture = mysql_fetch_array($result);
                    mysql_free_result($result);
                } 
                $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size']);
                $alb_list[$alb_idx]['thumb_pic'] = "<img src=\"" . get_pic_url($picture, 'thumb') . "\" {$image_size['geom']} alt=\"".$alb_thumb['title']."\" border=\"0\" class=\"image\">";
            } else { // Inserts an empty thumbnail if the album contains 0 images
                $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
                $alb_list[$alb_idx]['thumb_pic'] = "<img src=\"$CPG_M_DIR/images/nopic.jpg\" {$image_size['geom']} alt=\"".$lang_errors[no_img_to_display]."\" title=\"".$lang_errors[no_img_to_display]."\" border=\"0\" class=\"image\">";
            } 
        } elseif ($CONFIG['show_private']) {
            $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
            $alb_list[$alb_idx]['thumb_pic'] = "<img src=\"$CPG_M_DIR/images/private.jpg\" {$image_size['geom']} alt=\"".$lang_errors['members_only']."\" title=\"".$lang_errors['members_only']."\" border=\"0\" class=\"image\">";
        } 
        // Prepare everything
        $last_upload_date = $count ? localised_date($alb_stat['last_upload'], $lastup_date_fmt) : '';
        $alb_list[$alb_idx]['aid'] = $alb_thumb['aid'];
        $alb_list[$alb_idx]['album_title'] = $alb_thumb['title'];
        $alb_list[$alb_idx]['album_desc'] = bb_decode($alb_thumb['description']);
        $alb_list[$alb_idx]['pic_count'] = $count;
        $alb_list[$alb_idx]['last_upl'] = $last_upload_date;
        $alb_list[$alb_idx]['album_info'] = sprintf($lang_list_albums['n_pictures'], $count) . ($count ? sprintf($lang_list_albums['last_added'], $last_upload_date) : "");
        $alb_list[$alb_idx]['album_adm_menu'] = (GALLERY_ADMIN_MODE || (USER_ADMIN_MODE && $cat == USER_ID + FIRST_USER_CAT)) ? html_albummenu($alb_thumb['aid']) : '';
    }
    if ($buffer) {
        ob_start();
        theme_display_album_list_cat($alb_list, $nbAlb, $cat, $PAGE, $totalPages);
        $cat_albums = ob_get_contents();
        ob_end_clean();
        return $cat_albums;
    }
    else{
        theme_display_album_list($alb_list, $nbAlb, $cat, $PAGE, $totalPages);
       }
}
/**
 * Main code
 */
if (isset($_GET['page'])) $PAGE = max((int)$_GET['page'], 1);
else $PAGE = 1;
if (isset($_GET['cat'])) $cat = (int)$_GET['cat'];
// Gather data for categories
$cat_data = array();
$statistics = '';
$STATS_IN_ALB_LIST = false;
get_cat_list($cat_data, $statistics);
global $BREADCRUMB_TEXT, $thisalbum ;
//limit meta blocks to the current album or category
// NEW
$thisalbum = "category >= 0";
if ($cat < 0) { //  && $cat<0 Meta albums, we need to restrict the albums to the current category
        $actual_album = -$cat;
        $thisalbum .= $CONFIG['TABLE_ALBUMS'].'.aid = '.$actual_album;
} else if ($cat){
    if ($cat == USER_GAL_CAT) {
        $thisalbum = 'category > ' . FIRST_USER_CAT;
    } elseif (is_numeric($cat)) {
        $thisalbum = "category = '$cat'";
    }
}
// NEW
/*if ((is_numeric($cat))&&(!$album)){ //cat list
    $thisalbum = "category =  $cat";
}else if ((is_numeric($cat))||(is_numeric($album))){ // numeric album
    $thisalbum = "aid = $album";
}elseif ((!is_numeric($cat))&&(!$album)){ //home page
    $thisalbum = "category =  0";
}
*/
//non-numeric album don't need this value as there is no meta blocks
pageheader($BREADCRUMB_TEXT ? $BREADCRUMB_TEXT : $lang_index_php['welcome']);
$elements = preg_split("|/|", $CONFIG['main_page_layout'], -1, PREG_SPLIT_NO_EMPTY);
foreach ($elements as $element) {
    if (preg_match("/(\w+),*(\d+)*/", $element, $matches))
        switch ($matches[1]) {
            case 'breadcrumb': 
                // Added breadcrumb as a separate listable block from config
                if ($breadcrumb != '' || count($cat_data) > 0) set_breadcrumb();//theme_display_breadcrumb($breadcrumb, $cat_data);
                break;
            case 'catlist':
                if (count($cat_data) > 0) theme_display_cat_list($breadcrumb, $cat_data, $statistics);
                if (isset($cat) && $cat == USER_GAL_CAT) list_users();
                break;
            case 'alblist':
                list_cat_albums($cat, false);
                break;
            case 'random':
                if ($cat != 1) display_thumbnails('random', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                break;
            case 'lastup':
                if ($cat != 1) display_thumbnails('lastup', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                break;
            case 'lastupby':
                if ($cat != 1 && USER_ID > 1) display_thumbnails('lastupby', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                break;
            case 'lastalb':
               if ($cat != 1) display_thumbnails('lastalb', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
               break;
            case 'topn':
                if ($cat != 1) display_thumbnails('topn', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                break;
              case 'toprated':
                  if ($cat != 1) display_thumbnails('toprated', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                  break;
              case 'lastcom':
                  if ($cat != 1)display_thumbnails('lastcom', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                  break;
            case 'lastcomby':
                if ($cat != 1 && USER_ID > 1) display_thumbnails('lastcomby', '', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                break;
            case 'anycontent':
                    include_once("$CPG_M_DIR/anycontent.php");
                break;
        } 
}
pagefooter();
?>
