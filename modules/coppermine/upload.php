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
if (preg_match("#modules/#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
define('UPLOAD_PHP', true);
require("modules/" . $name . "/include/load.inc");
if (!USER_CAN_UPLOAD_PICTURES){
    cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
}
// Type 0 => input
// 1 => file input
// 2 => album list
$data = array(
                sprintf($lang_upload_php['max_fsize'], $CONFIG['max_upl_size']),
                 array($lang_upload_php['album'], 'album', 2),
                 array($lang_upload_php['picture'], 'userpicture', 1),
                 array($lang_upload_php['pic_title'], 'title', 0, 255),
                 array($lang_upload_php['description'], 'caption', 3, $CONFIG['max_img_desc_length']),
                 array($lang_upload_php['keywords'], 'keywords', 0, 255),
                 array($CONFIG['user_field1_name'], 'user1', 0, 255),
                 array($CONFIG['user_field2_name'], 'user2', 0, 255),
                 array($CONFIG['user_field3_name'], 'user3', 0, 255),
                 array($CONFIG['user_field4_name'], 'user4', 0, 255)
                );
function form_label($text)
{
                 echo <<<EOT
        <tr>
                <td class="tableh2" colspan="2">
                        <strong>$text</strong>
                </td>
        </tr>
EOT;
                }
function form_input($text, $name, $max_length)
{
                 if ($text == ''){
                                 echo "        <input type=\"hidden\" name=\"$name\" value=\"\">\n";
                                 return;
                                 }
                 echo <<<EOT
        <tr>
            <td width="40%" class="tableb">
                        $text
        </td>
        <td width="60%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="$name" maxlength="$max_length" value="" class="textinput">
                </td>
        </tr>
EOT;
                }
function form_file_input($text, $name)
{
                 global $CONFIG;
                 $max_file_size = $CONFIG['max_upl_size'] << 10;
                 echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <input type="hidden" name="MAX_FILE_SIZE" value="$max_file_size">
                        <input type="file" name="$name" size="40" class="listbox">
                </td>
        </tr>
EOT;
                }
function form_alb_list_box($text, $name)
{
                 global $CONFIG;
                 global $user_albums_list, $public_albums_list;
                 $sel_album = isset($_GET['album']) ? $_GET['album'] : 0;
                 echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                <select name="$name" class="listbox">
EOT;
                 foreach($user_albums_list as $album){
                                 echo '                        <option value="' . $album['aid'] . '"' . ($album['aid'] == $sel_album ? ' selected' : '') . '>* ' . $album['title'] . "</option>\n";
                                 }
                 foreach($public_albums_list as $album){
                                 echo '                        <option value="' . $album['aid'] . '"' . ($album['aid'] == $sel_album ? ' selected' : '') . '>' . $album['title'] . "</option>\n";
                                 }
                 echo <<<EOT
                        </select>
                </td>
        </tr>
EOT;
                }
function form_textarea($text, $name, $max_length)
{
                 global $ALBUM_DATA;
                 $value = $ALBUM_DATA[$name];
                 echo <<<EOT
        <tr>
                <td class="tableb" valign="top">
                        $text
                </td>
                <td class="tableb" valign="top">
                        <textarea name="$name" rows="5" cols="40" wrap="virtual"  class="textinput" style="width: 100%;" onKeyDown="textCounter(this, $max_length);" onKeyUp="textCounter(this, $max_length);"></textarea>
                </td>
        </tr>
EOT;
                }
function create_form(& $data)
{
                 foreach($data as $element){
                                 if ((is_array($element))){
                                                 switch ($element[2]){
                                                 case 0 :
                                                                 form_input($element[0], $element[1], $element[3]);
                                                                 break;
                                                 case 1 :
                                                                 form_file_input($element[0], $element[1]);
                                                                 break;
                                                 case 2 :
                                                                 form_alb_list_box($element[0], $element[1]);
                                                                 break;
                                                 case 3 :
                                                                 form_textarea($element[0], $element[1], $element[3]);
                                                                 break;
                                                 default:
                                                                 cpg_die(ERROR, 'Invalid action for form creation', __FILE__, __LINE__);
                                                                 } // switch
                                                 }else{
                                                 form_label($element);
                                                 }
                                 }
                }
$public_albums_list = get_albumlist(USER_ID);
$user_albums_list = array();
if (!count($public_albums_list) && !count($user_albums_list)){
                 cpg_die (ERROR, $lang_upload_php['err_no_alb_uploadables'], __FILE__, __LINE__);
                }
pageheader($lang_upload_php['title']);
starttable("100%", $lang_upload_php['title'], 2);
if (defined('IN_POSTNUKE')) {
$pn='        <input type="hidden" name="op" value="modload">';
        } else {
$pn='';
}
echo '
<script language="Javascript">
function textCounter(field, maxlimit) {
        if (field.value.length > maxlimit) // if too long...trim it!
        field.value = field.value.substring(0, maxlimit);
}
</script>
<script type="text/javascript" language="Javascript"><!--
var submitted = false;
function SubmitTheForm() {
if(submitted == true) { return; }
document.dbinputform.submit();
document.dbinputform.mybutton.value = \'UPLOADING, PLEASE WAIT\';
document.dbinputform.mybutton.disabled = true;
submitted = true;
}
//--></script>
<form name="dbinputform" method="post" action="'.getlink('&amp;file=db_input').'" ENCTYPE="multipart/form-data">
<input type="hidden" name="event" value="picture">
';
create_form($data);
echo <<<EOT
        <tr>
                <td colspan="2" align="center" class="tablef">
                $pn
<script type="text/javascript" language="Javascript"><!--
document.write('<input type="button" class="button" name="mybutton" value="{$lang_upload_php['title']}" onclick="return SubmitTheForm();">');
//--></script><noscript>
                        <input type="submit" value="{$lang_upload_php['title']}" class="button">
                        </noscript>
                </td>
                </form>
        </tr>
EOT;
endtable();
pagefooter();
?>
