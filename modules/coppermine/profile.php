<?php
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1c for CMS     2007.09.05                   //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>              //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.pcnuke.com                                                    //
// Website for Port Upgrades from 1.3.0 and up...                           //
// ------------------------------------------------------------------------ //
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
if (preg_match("#modules/#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
define('PROFILE_PHP', true);
require("modules/" . $name . "/include/load.inc");
$edit_profile_form_param = array(
    array('text', 'username', $lang_register_php['username']),
    array('text', 'group', $lang_register_php['group']),
    array('text', 'disk_usage', $lang_register_php['disk_usage'])
    );
$display_profile_form_param = array(
    array('text', 'username', $lang_register_php['username']),
    array('text', 'group', $lang_register_php['group'])
    );
$change_password_form_param = array(
    array('password', 'current_pass', $lang_register_php['current_pass'], 25),
    array('password', 'new_pass', $lang_register_php['new_pass'], 25),
    array('password', 'new_pass_again', $lang_register_php['new_pass_again'], 25),
    );
function make_form($form_param, $form_data)
{
    global $CONFIG, $PHP_SELF, $_POST;
    global $lang_register_php;
    foreach ($form_param as $element) switch ($element[0]) {
        case 'label' :
            echo <<<EOT
        <tr>
            <td colspan="2" class="tableh2">
                        <strong>{$element[1]}<strong>
        </td>
        </tr>
EOT;
            break;
        case 'text' :
            echo <<<EOT
        <tr>
            <td width="40%" class="tableb" height="25">
                        {$element[2]}
        </td>
        <td width="60%" class="tableb">
                        {$form_data[$element[1]]}
        </td>
        </tr>
EOT;
            break;
        case 'input' :
            $value = $form_data[$element[1]];
            echo <<<EOT
        <tr>
            <td width="40%" class="tableb"  height="25">
                        {$element[2]}
        </td>
        <td width="60%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="$value" class="textinput">
                </td>
        </tr>
EOT;
            break;
        case 'password' :
            echo <<<EOT
        <tr>
            <td width="40%" class="tableb">
                        {$element[2]}
        </td>
        <td width="60%" class="tableb" valign="top">
                <input type="password" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="" class="textinput">
                </td>
        </tr>
EOT;
            break;
        default:
            cpg_die(CRITICAL_ERROR, 'Invalid action for form creation ' . $element[0], __FILE__, __LINE__);
    } 
} 
function get_post_var($var)
{
    global $_POST, $lang_errors,$field_user_name;
    if (!isset($_POST[$var])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ($var)", __FILE__, __LINE__);
    return addslashes(trim($_POST[$var]));
} 
$op = isset($_GET['op']) ? $_GET['op'] : '';
$uid = isset($_GET['uid']) ? (int)$_GET['uid'] : -1;
if (isset($_POST['change_pass'])) $op = 'change_pass';
if (isset($_POST['change_profile']) && USER_ID) {
    $location = get_post_var('location');
    $interests = get_post_var('interests');
    $website = get_post_var('website');
    $occupation = get_post_var('occupation');
    $sql = "UPDATE {$CONFIG['TABLE_USERS']} SET " . "$field_user_from = '$location', " . "user_interests = '$interests', " . "user_website = '$website', " . "user_occ = '$occupation' " . "WHERE user_id = '" . USER_ID . "'";
    $result = db_query($sql);
    $title = sprintf($lang_register_php['x_s_profile'], CPG_USERNAME);
    $redirect = "index.php";
    pageheader($title, "<META http-equiv=\"refresh\" content=\"3;url=$redirect\">");
    msg_box($lang_info, $lang_register_php['update_success'], $lang_continue, $redirect);
    pagefooter();
}
if (isset($_POST['change_password']) && USER_ID) {
    $current_pass = get_post_var('current_pass');
    $new_pass = get_post_var('new_pass');
    $new_pass_again = get_post_var('new_pass_again');
    if (strlen($new_pass) < 2) cpg_die(ERROR, $lang_register_php['err_password_short'], __FILE__, __LINE__);
    if ($new_pass != $new_pass_again) cpg_die(ERROR, $lang_register_php['err_password_mismatch'], __FILE__, __LINE__);
    $sql = "UPDATE {$CONFIG['TABLE_USERS']} SET " . "user_password = '$new_pass' " . "WHERE user_id = '" . USER_ID . "' AND BINARY user_password = '$current_pass'";
    $result = db_query($sql);
    if (!mysql_affected_rows()) cpg_die(ERROR, $lang_register_php['pass_chg_error'], __FILE__, __LINE__);
    setcookie($CONFIG['cookie_name'] . '_pass', md5($_POST['new_pass']), time() + 86400, $CONFIG['cookie_path']);
    $title = sprintf($lang_register_php['x_s_profile'], CPG_USERNAME);
    $redirect = $PHP_SELF . "?op=edit_profile";
    pageheader($title, "<META http-equiv=\"refresh\" content=\"3;url=$redirect\">");
    msg_box($lang_info, $lang_register_php['pass_chg_success'], $lang_continue, $redirect);
    pagefooter();
}
switch ($op) {
    case 'edit_profile' :
        if (!USER_ID) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        $sql = "SELECT $field_user_name, $field_user_email, UNIX_TIMESTAMP($field_user_regdate) as user_regdate_cp, group_name, " . "$field_user_from, user_interests, user_website, user_occ, "
              ."COUNT(pid) as pic_count, ROUND(SUM(total_filesize)/1024) as disk_usage, group_quota "
              ."FROM {$CONFIG['TABLE_USERS']} AS u "
              ."INNER JOIN {$CONFIG['TABLE_USERGROUPS']} AS g ON user_group_cp = group_id "
              ."LEFT JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON category = " . FIRST_USER_CAT . " + user_id "
              ."LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p ON p.aid = a.aid "
              ."WHERE user_id ='" . USER_ID . "' "
              ."GROUP BY user_id ";
        $result = db_query($sql);
        if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_register_php['err_unk_user'], __FILE__, __LINE__);
        $user_data = mysql_fetch_array($result);
        mysql_free_result($result);
        $form_data = array('username' => $user_data[$field_user_name],
            'reg_date' => localised_date($user_data['user_regdate_cp'], $register_date_fmt),
            'group' => $user_data['group_name'],
            'email' => $user_data[$field_user_email],
            'disk_usage' => $user_data['disk_usage'] .
            ($user_data['group_quota'] ? '/' . $user_data['group_quota'] : '') . ' ' . $lang_byte_units[1],
            'location' => $user_data[$field_user_from],
            'interests' => $user_data['user_interests'],
            'website' => $user_data['user_website'],
            'occupation' => $user_data['user_occ'],
            );
        $title = sprintf($lang_register_php['x_s_profile'], CPG_USERNAME);
        pageheader($title);
        starttable(-1, $title, 2);
        $chset = _CHARSET;
        echo <<<EOT
        <form method="post" action="$PHP_SELF" enctype="multipart/form-data" accept-charset="$chset">
EOT;
        make_form($edit_profile_form_param, $form_data);
        echo <<<EOT
        </form>
EOT;
        endtable();
        pagefooter();
        break;
    case 'change_pass' :
        if (!USER_ID) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        $title = $lang_register_php['change_pass'];
        pageheader($title);
        starttable(-1, $title, 2);
        $chset =_CHARSET;
        echo <<<EOT
        <form method="post" action="$PHP_SELF" enctype="multipart/form-data" accept-charset="$chset">
EOT;
        make_form($change_password_form_param, '');
        echo <<<EOT
        <tr>
                <td colspan="2" align="center" class="tablef">
                        <input type="submit" name="change_password" value="$title" class="button">
                </td>
        </tr>
        </form>
EOT;
        endtable();
        pagefooter();
        break;
    default :
        $sql = "SELECT $field_user_name, $field_user_email, UNIX_TIMESTAMP($field_user_regdate) as user_regdate_cp, group_name, " . "$field_user_from, user_interests, user_website, user_occ " . "FROM {$CONFIG['TABLE_USERS']} AS u " . "INNER JOIN {$CONFIG['TABLE_USERGROUPS']} AS g ON user_group_cp = group_id " . "WHERE user_id ='$uid'";
        $result = db_query($sql);
        if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_register_php['err_unk_user'], __FILE__, __LINE__);
        $user_data = mysql_fetch_array($result);
        mysql_free_result($result);
        $form_data = array('username' => $user_data[$field_user_name],
            'reg_date' => localised_date($user_data['user_regdate_cp'], $register_date_fmt),
            'group' => $user_data['group_name'],
            'location' => $user_data[$field_user_from],
            'interests' => $user_data['user_interests'],
            'website' => cpg_make_clickable($user_data['user_website']),
            'occupation' => $user_data['user_occ'],
            );
        $title = sprintf($lang_register_php['x_s_profile'], $user_data['username']);
        pageheader($title);
        starttable(-1, $title, 2);
        make_form($display_profile_form_param, $form_data);
        endtable();
        pagefooter();
        break;
} 
?>
