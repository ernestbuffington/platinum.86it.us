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
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('GROUPMGR_PHP', true);
require("modules/" . $name . "/include/load.inc");
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
function display_group_list()
{
    global $CONFIG;
    global $lang_byte_units, $lang_yes, $lang_no;
    $result = db_query("SELECT * FROM {$CONFIG['TABLE_USERGROUPS']} WHERE 1 ORDER BY group_id");
    if (!mysql_num_rows($result)) {
        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} VALUES (1, 'Administrators', 0, 1, 1, 1, 1, 1, 1)");
        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} VALUES (2, 'Registered', 1024, 0, 1, 1, 1, 1, 1)");
        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} VALUES (3, 'Anonymous', 0, 0, 0, 0, 1, 0, 0)");
        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} VALUES (4, 'Banned', 0, 0, 0, 0, 0, 0, 0);");
        cpg_die(CRITICAL_ERROR, 'Group table was empty !<br /><br />Default groups created, please reload this page', __FILE__, __LINE__);
    } 
    $field_list = array('can_rate_pictures', 'can_send_ecards', 'can_post_comments', 'can_upload_pictures', 'pub_upl_need_approval', 'can_create_albums', 'priv_upl_need_approval');
    while ($group = mysql_fetch_array($result)) {
        $group['group_name'] = $group['group_name'];
        if ($group['group_id'] > 4) {
            echo <<< EOT
        <tr>
                <td class="tableb" style="padding-left: 1px; padding-right: 1px">
                        <input type="checkbox" name="delete_group[]" value="{$group['group_id']}" class="checkbox">
                </td>
EOT;
        } else {
            echo <<< EOT
        <tr>
                <td class="tableb">
                        &nbsp;
                </td>
EOT;
        } 
        echo <<< EOT
                <td class="tableb">
                        <input type="hidden" name="group_id[]" value="{$group['group_id']}">
                        <input type="text" name="group_name_{$group['group_id']}" value="{$group['group_name']}" class="textinput">
                </td>
                <td class="tableb" style="white-space: nowrap;">
                        <input type="text" name="group_quota_{$group['group_id']}" value="{$group['group_quota']}" size="10" class="textinput"> {$lang_byte_units[1]}
                </td>
EOT;
        foreach ($field_list as $field_name) {
            $value = $group[$field_name];
            $yes_selected = ($value == 1) ? 'selected' : '';
            $no_selected = ($value == 0) ? 'selected' : '';
            echo <<< EOT
                <td class="tableb" align="center">
                        <select name="{$field_name}_{$group['group_id']}" class="listbox">
                                <option value="1" $yes_selected>$lang_yes</option>
                                <option value="0" $no_selected>$lang_no</option>
                        </select>
                </td>
EOT;
        } 
        echo <<< EOT
        </tr>
EOT;
    } // while
    mysql_free_result($result);
} 
function get_post_var($var)
{
    global $lang_errors;
    if (!isset($_POST[$var])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ($var)", __FILE__, __LINE__);
    return $_POST[$var];
} 
function process_post_data()
{
    global $CONFIG;
    $field_list = array('group_name', 'group_quota', 'can_rate_pictures', 'can_send_ecards', 'can_post_comments', 'can_upload_pictures', 'pub_upl_need_approval', 'can_create_albums', 'priv_upl_need_approval');
    $group_id_array = get_post_var('group_id');
    foreach ($group_id_array as $key => $group_id) {
        $set_statment = '';
        foreach ($field_list as $field) {
            if (!isset($_POST[$field . '_' . $group_id])) cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'] . " ({$field}_{$group_id})", __FILE__, __LINE__);
            if ($field == 'group_name') {
                $set_statment .= $field . "='" . $_POST[$field . '_' . $group_id] . "',";
            } else {
                $set_statment .= $field . "='" . (int)$_POST[$field . '_' . $group_id] . "',";
            } 
        } 
        $set_statment = substr($set_statment, 0, -1);
        db_query("UPDATE {$CONFIG['TABLE_USERGROUPS']} SET $set_statment WHERE group_id = '$group_id' LIMIT 1");
    } 
} 
if (isset($_POST) && count($_POST)) {
    if (isset($_POST['del_sel']) && isset($_POST['delete_group']) && is_array($_POST['delete_group'])) {
        foreach($_POST['delete_group'] as $group_id) {
            db_query("DELETE FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = '" . (int)$group_id . "' LIMIT 1");
            db_query("UPDATE {$CONFIG['TABLE_USERS']} SET user_group_cp = '2' WHERE user_group_cp = '" . (int)$group_id . "'");
        } 
    } elseif (isset($_POST['new_group'])) {
        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} (group_name) VALUES ('')");
    } elseif (isset($_POST['apply_modifs'])) {
        process_post_data();
    } 
} 
pageheader($lang_groupmgr_php['title']);
echo <<<EOT
<script language="javascript">
function confirmDel()
{
    return confirm("{$lang_groupmgr_php['confirm_del']}");
}
</script>
EOT;
starttable('100%');
$chset =_CHARSET;
echo <<<EOT
        <tr>
                <td class="tableh1" colspan="2"><strong><span class="statlink">{$lang_groupmgr_php['group_name']}</span></strong></td>
                <td class="tableh1"><strong><span class="statlink">{$lang_groupmgr_php['disk_quota']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['can_rate']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['can_send_ecards']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['can_post_com']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['can_upload']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['approval_1']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['can_have_gallery']}</span></strong></td>
                <td class="tableh1" align="center"><strong><span class="statlink">{$lang_groupmgr_php['approval_2']}</span></strong></td>
        </tr>
        <form method="post" action="$CPG_URL&amp;file=groupmgr" enctype="multipart/form-data" accept-charset="$chset">
EOT;
display_group_list();
echo <<<EOT
        <tr>
            <td colspan="10" class="tableh2">
                <strong>{$lang_groupmgr_php['notes']}</strong>
                </td>
        </tr>
        <tr>
            <td colspan="10" class="tableb">
                {$lang_groupmgr_php['note1']}
                </td>
        </tr>
        <tr>
            <td colspan="10" class="tableb">
                {$lang_groupmgr_php['note2']}
                </td>
        </tr>
        <tr>
            <td colspan="10" align="center" class="tablef">
                        <input type="submit" name="apply_modifs" value="{$lang_groupmgr_php['apply']}" class="button">&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="new_group" value="{$lang_groupmgr_php['create_new_group']}" class="button">&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="del_sel" value="{$lang_groupmgr_php['del_groups']}" onClick="return confirmDel()" class="button">
                </td>
        </form>
        </tr>
EOT;
endtable();
pagefooter();
?>
