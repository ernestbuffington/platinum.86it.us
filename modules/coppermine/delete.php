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
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('DELETE_PHP', true);
require("modules/" . $name . "/include/load.inc");
/**
 * Local functions definition
 */
$header_printed = false;
$need_caption = false;
function output_table_header()
{
    global $header_printed, $need_caption;
    $header_printed = true;
    $need_caption = true;
    ?><tr>
<td class="tableh2"><strong>Picture</strong></td>
<td class="tableh2" align="center"><strong>F</strong></td>
<td class="tableh2" align="center"><strong>N</strong></td>
<td class="tableh2" align="center"><strong>T</strong></td>
<td class="tableh2" align="center"><strong>C</strong></td>
<td class="tableh2" align="center"><strong>D</strong></td>
</tr>
<?php
} 
function output_caption()
{
    global $lang_delete_php, $CPG_M_DIR;
    ?><tr><td colspan="6" class="tableb">&nbsp;</td></tr>
<tr><td colspan="6" class="tableh2"><strong><?php echo $lang_delete_php['caption'] ?></strong></tr>
<tr><td colspan="6" class="tableb">
<table cellpadding="1" cellspacing="0">
<tr><td><strong>F</strong></td><td>:</td><td><?php echo $lang_delete_php['fs_pic'] ?></td><td width="20">&nbsp;</td><td><img src="<?php echo $CPG_M_DIR;
    ?>/images/green.gif" border="0" width="12" height="12" align="absmiddle"></td><td>:</td><td><?php echo $lang_delete_php['del_success'] ?></td></tr>
<tr><td><strong>N</strong></td><td>:</td><td><?php echo $lang_delete_php['ns_pic'] ?></td><td width="20">&nbsp;</td><td><img src="<?php echo $CPG_M_DIR;
    ?>/images/red.gif" border="0" width="12" height="12" align="absmiddle"></td><td>:</td><td><?php echo $lang_delete_php['err_del'] ?></td></tr>
<tr><td><strong>T</strong></td><td>:</td><td><?php echo $lang_delete_php['thumb_pic'] ?></td></tr>
<tr><td><strong>C</strong></td><td>:</td><td><?php echo $lang_delete_php['comment'] ?></td></tr>
<tr><td><strong>D</strong></td><td>:</td><td><?php echo $lang_delete_php['im_in_alb'] ?></td></tr>
</table>
</td>
</tr>
<?php
} 
function delete_picture($pid)
{
    global $CONFIG, $header_printed, $lang_errors, $CPG_M_DIR;
    if (!$header_printed)
        output_table_header();
    $green = "<img src=\"" . $CPG_M_DIR . "/images/green.gif\" border=\"0\" width=\"12\" height=\"12\"><br />";
    $red = "<img src=\"" . $CPG_M_DIR . "/images/red.gif\" border=\"0\" width=\"12\" height=\"12\"><br />";
    if (GALLERY_ADMIN_MODE) {
        $query = "SELECT aid, filepath, filename FROM {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid'";
        $result = db_query($query);
        if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        $pic = mysql_fetch_array($result);
    } else {
        $query = "SELECT {$CONFIG['TABLE_PICTURES']}.aid as aid, category, filepath, filename FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND pid='$pid'";
        $result = db_query($query);
        if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        $pic = mysql_fetch_array($result);
        if ($pic['category'] != FIRST_USER_CAT + USER_ID) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
    } 
    $aid = $pic['aid'];
    $dir = $pic['filepath'];
    $file = $pic['filename'];
    if (!is_writable($dir)) cpg_die(CRITICAL_ERROR, sprintf($lang_errors['directory_ro'], htmlspecialchars($dir)), __FILE__, __LINE__);
    echo "<td class=\"tableb\">" . htmlspecialchars($file) . "</td>";
    $files = array($dir . $file, $dir . $CONFIG['normal_pfx'] . $file, $dir . $CONFIG['thumb_pfx'] . $file);
    foreach ($files as $currFile) {
        echo "<td class=\"tableb\" align=\"center\">";
        if (is_file($currFile)) {
            if (@unlink($currFile))
                echo $green;
            else
                echo $red;
        } else
            echo "&nbsp;";
        echo "</td>";
    } 
    $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid'";
    $result = db_query($query);
    echo "<td class=\"tableb\" align=\"center\">";
    if (mysql_affected_rows() > 0)
        echo $green;
    else
        echo "&nbsp;";
    echo "</td>";
    $query = "DELETE FROM {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' LIMIT 1";
    $result = db_query($query);
    echo "<td class=\"tableb\" align=\"center\">";
    if (mysql_affected_rows() > 0)
        echo $green;
    else
        echo $red;
    echo "</td>";
    echo "</tr>\n";
    return $aid;
} 
function delete_album($aid)
{
    global $CONFIG, $lang_errors, $lang_delete_php;
    $query = "SELECT title, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid ='$aid'";
    $result = db_query($query);
    if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $album_data = mysql_fetch_array($result);
    if (!GALLERY_ADMIN_MODE) {
        if ($album_data['category'] != FIRST_USER_CAT + USER_ID) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
    } 
    $query = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE aid='$aid'";
    $result = db_query($query); 
    // Delete all files
    while ($pic = mysql_fetch_array($result)) {
        delete_picture($pic['pid']);
    } 
    speedup_pictures();
    // Delete album
    $query = "DELETE from {$CONFIG['TABLE_ALBUMS']} WHERE aid='$aid'";
    $result = db_query($query);
    if (mysql_affected_rows() > 0)
        echo "<tr><td colspan=\"6\" class=\"tableb\">" . sprintf($lang_delete_php['alb_del_success'], $album_data['title']) . "</td></tr>\n";
} 
/**
 * Album manager functions
 */
function parse_select_option($value)
{
    global $HTML_SUBST;
    if (!preg_match("/.+?no=(\d+),album_nm='(.+?)',album_sort=(\d+),action=(\d)/", $value, $matches))
        return false;
    return array('album_no' => (int)$matches[1],
        'album_nm' => get_magic_quotes_gpc() ? strtr(stripslashes($matches[2]), $HTML_SUBST) : strtr($matches[2], $HTML_SUBST),
        'album_sort' => (int)$matches[3],
        'action' => (int)$matches[4]
    );
} 
function parse_orig_sort_order($value)
{
    if (!preg_match("/(\d+)@(\d+)/", $value, $matches))
        return false;
    return array('aid' => (int)$matches[1],
        'pos' => (int)$matches[2],
        );
} 
function parse_list($value)
{
    return preg_split("/,/", $value, -1, PREG_SPLIT_NO_EMPTY);
} 
/**
 * Main code starts here
 */
$what = isset($_GET['what']) ? $_GET['what'] : $_POST['what'];
switch ($what) {
    // Album manager (don't necessarily delete something ;-)
    case 'albmgr':
        if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        if (!GALLERY_ADMIN_MODE) {
            $restrict = "AND category = '" . (FIRST_USER_CAT + USER_ID) . "'";
        } else {
            $restrict = '';
        } 
        pageheader($lang_delete_php['alb_mgr']);
        starttable("100%", $lang_delete_php['alb_mgr'], 6);
        $orig_sort_order = parse_list($_POST['sort_order']);
        foreach ($orig_sort_order as $album) {
            $op = parse_orig_sort_order($album);
            if (count ($op) == 2) {
                $query = "UPDATE $CONFIG[TABLE_ALBUMS] SET pos='{$op['pos']}' WHERE aid='{$op['aid']}' $restrict LIMIT 1";
                db_query($query);
            } else {
                cpg_die (sprintf(CRITICAL_ERROR, $lang_delete_php['err_invalid_data'], $_POST['sort_order']), __FILE__, __LINE__);
            } 
        } 
        $to_delete = parse_list($_POST['delete_album']);
        foreach ($to_delete as $album_id) {
            delete_album($album_id);
        } 
        if (isset($_POST['to'])) foreach ($_POST['to'] as $option_value) {
            $op = parse_select_option(stripslashes($option_value));
            switch ($op['action']) {
                case '0':
                    break;
                case '1':
                    if (GALLERY_ADMIN_MODE) {
                        $category = (int)$_POST['cat'];
                    } else {
                        $category = FIRST_USER_CAT + USER_ID;
                    } 
                    echo "<tr><td colspan=\"6\" class=\"tableb\">" . sprintf($lang_delete_php['create_alb'], $op['album_nm']) . "</td></tr>\n";
                    $query = "INSERT INTO {$CONFIG['TABLE_ALBUMS']} (category, title, uploads, pos) VALUES ('$category', '" . addslashes($op['album_nm']) . "', 'NO',  '{$op['album_sort']}')";
                    db_query($query);
                    break;
                case '2':
                    echo "<tr><td colspan=\"6\" class=\"tableb\">" . sprintf($lang_delete_php['update_alb'], $op['album_no'], $op['album_nm'], $op['album_sort']) . "</td></tr>\n";
                    $query = "UPDATE $CONFIG[TABLE_ALBUMS] SET title='" . addslashes($op['album_nm']) . "', pos='{$op['album_sort']}' WHERE aid='{$op['album_no']}' $restrict LIMIT 1";
                    db_query($query);
                    break;
                default:
                    cpg_die (CRITICAL_ERROR, $lang_delete_php['err_invalid_data'], __FILE__, __LINE__);
            } 
        } 
        if ($need_caption) output_caption();
        echo "<tr><td colspan=\"6\" class=\"tablef\" align=\"center\">\n";
        echo "<div class=\"admin_menu_thumb\"><a href=\"" . $CPG_URL . "&amp;file=albmgr\"  class=\"adm_menu\">$lang_continue</a></div>\n";
        echo "</td></tr>";
        endtable();
        pagefooter();
        break;
    // Comment
    case 'comment':
        $msg_id = (int)$_GET['msg_id'];
        $result = db_query("SELECT pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id'");
        if (!mysql_num_rows($result)) {
            cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_comment'], __FILE__, __LINE__);
        } else {
            $comment_data = mysql_fetch_array($result);
        } 
        if (GALLERY_ADMIN_MODE) {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id'";
        } elseif (USER_ID) {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id' AND author_id ='" . USER_ID . "' LIMIT 1";
        } else {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id' AND author_md5_id ='{$USER['ID']}' AND author_id = '0' LIMIT 1";
        } 
        $result = mysql_query($query);
        $header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 0; URL=' : 'Location: ';
        $redirect = $CPG_URL . "&file=displayimage&pos=" . ( $comment_data['pid']);
        header($header_location . $redirect);
        pageheader($lang_info, "<META http-equiv=\"refresh\" content=\"1;url=$redirect\">");
        msg_box($lang_info, $lang_delete_php['comment_deleted'], $lang_continue, $redirect);
        pagefooter();
        break;
    // Picture
    case 'picture':
        if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        $pid = (int)$_GET['id'];
        pageheader($lang_delete_php['del_pic']);
        starttable("100%", $lang_delete_php['del_pic'], 6);
        output_table_header();
        $aid = delete_picture($pid);
        speedup_pictures();
        output_caption();
        echo "<tr><td colspan=\"6\" class=\"tablef\" align=\"center\">\n";
        echo "<div class=\"admin_menu_thumb\"><a href=\"" . $CPG_URL . "&amp;file=thumbnails&amp;album=$aid\"  class=\"adm_menu\">$lang_continue</a></div>\n";
        echo "</td></tr>\n";
        endtable();
        pagefooter();
        break;
    // Album
    case 'album':
        if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        $aid = intval($_GET['id']);
        $result = db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".$aid);
        list($cat) = mysql_fetch_row($result);
        pageheader($lang_delete_php['del_alb']);
        starttable("100%", $lang_delete_php['del_alb'], 6);
        delete_album($aid);
        if ($need_caption) output_caption();
        echo "<tr><td colspan=\"6\" class=\"tablef\" align=\"center\">\n";
        echo "<div class=\"admin_menu_thumb\"><a href=\"" . $CPG_URL . "&amp;file=albmgr&amp;cat=$cat\"  class=\"adm_menu\">$lang_continue</a></div>\n";
        echo "</td></tr>";
        endtable();
        pagefooter();
        break;
    // User
    case 'user':
        $user_id = (int)$_GET['id'];
        if (!(GALLERY_ADMIN_MODE) || $user_id == USER_ID) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
        $result = db_query("SELECT $field_user_name FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = '$user_id'");
        if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_delete_php['err_unknown_user'], __FILE__, __LINE__);
        $user_data = mysql_fetch_array($result);
        mysql_free_result($result);
        pageheader($lang_delete_php['del_user']);
        starttable("100%", $lang_delete_php['del_user'] . ' - ' . $user_data[$field_user_name], 6); 
        // First delete the albums
        $result = db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = '" . (FIRST_USER_CAT + $user_id) . "'");
        while ($album = mysql_fetch_array($result)) {
            delete_album($album['aid']);
        } // while
        mysql_free_result($result);
        if ($need_caption) output_caption(); 
        // Then anonymize comments posted by the user
        db_query("UPDATE {$CONFIG['TABLE_COMMENTS']} SET  author_id = '0' WHERE  author_id = '$user_id'"); 
        // Do the same for pictures uploaded in public albums
        db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET  owner_id = '0' WHERE  owner_id = '$user_id'"); 
        // Finally delete the user
        db_query("DELETE FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = '$user_id'");
        echo "<tr><td colspan=\"6\" class=\"tablef\" align=\"center\">\n";
        echo "<div class=\"admin_menu_thumb\"><a href=\"" . $CPG_URL . "&amp;file=usermgr\"  class=\"adm_menu\">$lang_continue</a></div>\n";
        echo "</td></tr>";
        endtable();
        pagefooter();
        break;
} 
?>
