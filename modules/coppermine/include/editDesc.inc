<?php 
/****************************************************************************/
/* Coppermine Photo Gallery 1.2.3 for CMS                                   */
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
/* Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               */
/* http://www.chezgreg.net/coppermine/                                      */
/* This program is free software; you can redistribute it and/or modify     */
/* it under the terms of the GNU General Public License as published by     */
/* the Free Software Foundation; either version 2 of the License, or        */
/* (at your option) any later version.                                      */
/****************************************************************************/
/*   $Id: editDesc.inc,v 1.2 2004/05/17 18:35:11 djmaze Exp $          */
/****************************************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
function process_post_data()
{
    global $CONFIG, $_POST, $db;
    global $lang_errors;
    if (phpversion() <= '4.0.6') {
        $_POST = ($_POST);
    } 
    $pid = (int)$_POST['pid'];
    $aid = (int)$_POST['aid'];
    $title = isset($_POST['title'])?$_POST['title']:null;
    $caption = isset($_POST['caption'])?$_POST['caption']:null;
    $keywords = isset($_POST['keywords'])?$_POST['keywords']:null; // thanks hpx1
    $user1 = isset($_POST['user1'])?$_POST['user1']:null;
    $user2 = isset($_POST['user2'])?$_POST['user2']:null;
    $user3 = isset($_POST['user3'])?$_POST['user3']:null;
    $user4 = isset($_POST['user4'])?$_POST['user4']:null;
    $read_exif = isset($_POST['read_exif']);
    $reset_vcount = isset($_POST['reset_vcount']);
    $reset_votes = isset($_POST['reset_votes']);
    $del_comments = isset($_POST['del_comments']) || $delete;
    $query = "SELECT category, filepath, filename FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND pid='$pid'"; 
    // $result = db_query($query);
    // if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    // $pic = mysql_fetch_array($result);
    // mysql_free_result($result);
    if ($result = db_query($query)) {
        $pic = mysql_fetch_array($result);
    } else {
        cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    } 
    if (!GALLERY_ADMIN_MODE && !USER_ADMIN_MODE) {
        if ($pic['category'] != FIRST_USER_CAT + USER_ID) cpg_die(ERROR, $lang_errors['perm_denied'] . "<br />(picture category = {$pic['category']}/ $pid)", __FILE__, __LINE__);
        if (!isset($user_album_set[$aid])) cpg_die(ERROR, $lang_errors['perm_denied'] . "<br />(target album = $aid)", __FILE__, __LINE__);
    } 
        $update = "aid = '" . intval($aid) . "'";
	if (get_magic_quotes_gpc()) {
    	$update .= ", title = '" . $title . "'";
    	$update .= ", caption = '" . $caption . "'";
    	$update .= ", keywords = '" . $keywords . "'";
    	$update .= ", user1 = '" . $user1 . "'";
    	$update .= ", user2 = '" . $user2 . "'";
    	$update .= ", user3 = '" . $user3 . "'";
    	$update .= ", user4 = '" . $user4 . "'";
	} else {
		$update .= ", title = '" . addslashes($title) . "'";
    	$update .= ", caption = '" . addslashes($caption) . "'";
    	$update .= ", keywords = '" . addslashes($keywords) . "'";
    	$update .= ", user1 = '" . addslashes($user1) . "'";
    	$update .= ", user2 = '" . addslashes($user2) . "'";
    	$update .= ", user3 = '" . addslashes($user3) . "'";
    	$update .= ", user4 = '" . addslashes($user4) . "'";
    	  }
    if ($reset_vcount) $update .= ", hits = '0'";
    if ($reset_votes) $update .= ", pic_rating = '0', votes = '0'";
    if ($del_comments) {
        $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid'";
        $result = db_query($query);
    } else {
        $query = "UPDATE {$CONFIG['TABLE_PICTURES']} SET $update WHERE pid='$pid' LIMIT 1";
        $result = db_query($query);
    } 
    if (!$read_exif) {
        // redirect to image if there isn't asked for EXIF info
/*
        // pos is ordered by filename
        $result = $db->sql_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = '$aid' ORDER BY filename");
        $pos = 0;
        while ($row = $db->sql_fetchrow($result)) {
            if ($row['pid'] == $pid) {
                header('Location: '.getlink("&file=displayimage&album=$aid&pos=$pos"));
                exit();
            } 
            $pos++;
        } 
*/
    } 
} 
function get_user_albums($user_id)
{
    global $user_albums_list, $public_albums_list;
    $public_albums_list = get_albumlist($user_id);
    $user_albums_list = array();
}
function form_alb_list_box()
{
    global $CONFIG, $CURRENT_PIC;
    global $user_albums_list, $public_albums_list, $lang_editpics_php;
    $sel_album = $CURRENT_PIC['aid'];
    echo <<<EOT
        <tr>
            <td class="tableb" style="white-space: nowrap;">
                        {$lang_editpics_php['album']}
        </td>
        <td class="tableb" valign="top">
                <select name="aid" class="listbox">
EOT;
    foreach($public_albums_list as $album) {
        echo '                        <option value="' . $album['aid'] . '"' . ($album['aid'] == $sel_album ? ' selected' : '') . '>';
        echo $album['title'] . "</option>\n";
    } 
    foreach($user_albums_list as $album) {
        echo '                        <option value="' . $album['aid'] . '"' . ($album['aid'] == $sel_album ? ' selected' : '') . '>* ' . $album['cname'] . "-" . $album['title'] . "</option>\n";
    } 
    echo <<<EOT
                        </select>
                </td>
        </tr>
EOT;
} 
if (isset($_POST['submitDescription'])){
    process_post_data();
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: '.getlink("&file=displayimage&pid=$pid"));
    header('Connection: close');
}
$result = db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = '$pid'");
$CURRENT_PIC = mysql_fetch_array($result);
mysql_free_result($result);
$thumb_url = get_pic_url($CURRENT_PIC, 'thumb');
$thumb_link = getlink('&file=displayimage&pos='.$CURRENT_PIC['pid']);
$filename = htmlspecialchars($CURRENT_PIC['filename']);
$THUMB_ROWSPAN = 5;
if ($CONFIG['user_field1_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field2_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field3_name'] != '') $THUMB_ROWSPAN++;
if ($CONFIG['user_field4_name'] != '') $THUMB_ROWSPAN++;
get_user_albums(USER_ID);
starttable("100%", $title, 3);
// starttable("100%", $lang_editpics_php['desc'], 3);
$pic_info = sprintf($lang_editpics_php['pic_info_str'], $CURRENT_PIC['pwidth'], $CURRENT_PIC['pheight'], ($CURRENT_PIC['filesize'] >> 10), $CURRENT_PIC['hits'], $CURRENT_PIC['votes']);
include_once($THEME_DIR . '/' . $template_edit_one_pic);
/*
$thefile = implode("", file($THEME_DIR . '/' . $template_edit_one_pic));
$thefile = addslashes($thefile);
$thefile = "\$template=\"" . $thefile . "\";";
eval($thefile);
$template_edit_one_pic = stripslashes($template);
*/
$template_editonepic_userfield = template_extract_block($template_edit_one_pic, 'user_field');
$template_editonepic_main      = template_extract_block($template_edit_one_pic, 'main');
$template_editonepic_footer    = template_extract_block($template_edit_one_pic, 'footer');
echo $template_edit_one_pic;
form_alb_list_box();
echo $template_editonepic_main;
if ($CONFIG['user_field1_name'] != '') {
    $params = array('{FIELD_NAME}' => $CONFIG['user_field1_name'],
        '{USER_FIELD}' => 'user1',
        '{USER_PIC}' => $CURRENT_PIC['user1'],
        );
    echo template_eval($template_editonepic_userfield, $params);
} 
if ($CONFIG['user_field2_name'] != '') {
    $params = array('{FIELD_NAME}' => $CONFIG['user_field2_name'],
        '{USER_FIELD}' => 'user2',
        '{USER_PIC}' => $CURRENT_PIC['user2'],
        );
    echo template_eval($template_editonepic_userfield, $params);
} 
if ($CONFIG['user_field3_name'] != '') {
    $params = array('{FIELD_NAME}' => $CONFIG['user_field3_name'],
        '{USER_FIELD}' => 'user3',
        '{USER_PIC}' => $CURRENT_PIC['user3'],
        );
    echo template_eval($template_editonepic_userfield, $params);
} 
if ($CONFIG['user_field4_name'] != '') {
    $params = array('{FIELD_NAME}' => $CONFIG['user_field4_name'],
        '{USER_FIELD}' => 'user4',
        '{USER_PIC}' => $CURRENT_PIC['user4'],
        );
    echo template_eval($template_editonepic_userfield, $params);
} 
echo $template_editonepic_footer;
endtable();
?>
