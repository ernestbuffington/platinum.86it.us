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
define('REVIEWCOM_PHP', true);
require("modules/" . $name . "/include/load.inc");
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
// Delete comments if form is posted
$nb_com_del = 0;
if (isset($_POST['cid_array'])) {
    $cid_array = $_POST['cid_array'];
    $cid_set = '';
    foreach ($cid_array as $cid)
        $cid_set .= ($cid_set == '') ? '(' . $cid : ', ' . $cid;
    $cid_set .= ')';
    db_query("DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id IN $cid_set");
    $nb_com_del = mysql_affected_rows();
}
$result = db_query("SELECT count(*) FROM {$CONFIG['TABLE_COMMENTS']} WHERE 1");
$nbEnr = mysql_fetch_array($result);
$comment_count = $nbEnr[0];
if (!$comment_count) cpg_die(INFORMATION , $lang_reviewcom_php['no_comment'], __FILE__, __LINE__);
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$count = isset($_GET['count']) ? $_GET['count'] : 25;
$next_target = $CPG_URL . '&file=reviewcom&start=' . ($start + $count) . '&count=' . $count;
$prev_target = $CPG_URL . '&file=reviewcom&start=' . max(0, $start - $count) . '&count=' . $count;
$s50 = $count == 50 ? 'selected' : '';
$s75 = $count == 75 ? 'selected' : '';
$s100 = $count == 100 ? 'selected' : '';
if ($start + $count < $comment_count){
    $next_link = "<a href=\"$next_target\"><strong>{$lang_reviewcom_php['see_next']}</strong></a>&nbsp;&nbsp;-&nbsp;&nbsp;";
}else{
    $next_link = '';
}
if ($start > 0){
    $prev_link = "<a href=\"$prev_target\"><strong>{$lang_reviewcom_php['see_prev']}</strong></a>&nbsp;&nbsp;-&nbsp;&nbsp;";
}else{
    $prev_link = '';
}
pageheader($lang_reviewcom_php['title']);
starttable();
$chset =_CHARSET;
echo <<<EOT
        <tr>
            <form action="$CPG_URL&file=reviewcom&start=$start&count=$count" method="post" enctype="multipart/form-data" accept-charset="$chset">
                <td class="tableh1" colspan="3"><h2>{$lang_reviewcom_php['title']}</h2></td>
        </tr>
EOT;
if ($nb_com_del > 0){
                 $msg_txt = sprintf($lang_reviewcom_php['n_comm_del'], $nb_com_del);
                 echo <<<EOT
        <tr>
                <td class="tableh2" colspan="3" align="center">
                        <br /><strong>$msg_txt</strong><br /><br />
                </td>
        </tr>
EOT;
                }
echo <<<EOT
        <tr>
                <td class="tableb" colspan="3">
                        $prev_link
                        $next_link
                        <strong>{$lang_reviewcom_php['n_comm_disp']}</strong>
                        <select onChange="if(this.options[this.selectedIndex].value) window.location.href='$CPG_URL&file=reviewcom&start=$start&count='+this.options[this.selectedIndex].value;"  name="count" class="listbox">
                                <option value="25">25</option>
                                <option value="50" $s50>50</option>
                                <option value="75" $s75>75</option>
                                <option value="100" $s100>100</option>
                        </select>
                </td>
        </tr>
EOT;
$result = db_query("SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, {$CONFIG['TABLE_COMMENTS']}.pid as pid, aid, filepath, filename, url_prefix, pwidth, pheight FROM {$CONFIG['TABLE_COMMENTS']}, {$CONFIG['TABLE_PICTURES']} WHERE {$CONFIG['TABLE_COMMENTS']}.pid = {$CONFIG['TABLE_PICTURES']}.pid ORDER BY msg_id DESC LIMIT $start, $count");
while ($row = mysql_fetch_array($result)){
                 $thumb_url = get_pic_url($row, 'thumb');
                 $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['alb_list_thumb_size']);
                 $thumb_link = $CPG_URL . '&file=displayimage&pos=' . - $row['pid'];
                 $msg_date = localised_date($row['msg_date'], $comment_date_fmt);
                 echo <<<EOT
        <tr>
        <td colspan="2" class="tableh2" valign="top">
                <table cellpadding="0" cellspacing="0" border ="0">
                        <tr>
                        <td><input name="cid_array[]" type="checkbox" value="{$row['msg_id']}">
                        <td><img src="$CPG_URL/images/spacer.gif" width="5" height="1" /><br/></td>
                        <td><strong>{$row['msg_author']}</strong> - {$msg_date}</td>
                        </tr>
                </table>
                </td>
        </tr>
        <tr>
        <td class="tableb" valign="top" width="100%">
                        {$row['msg_body']}
                </td>
            <td class="tableb" align="center">
                        <a href="$thumb_link" target="_blank"><img src="$thumb_url" {$image_size['geom']} class="image" border="0"><br /></a>
        </td>
        </tr>
EOT;
                }
mysql_free_result($result);
echo <<<EOT
        <tr>
            <td colspan="3" align="center" class="tablef">
                        <input type="submit" value="{$lang_reviewcom_php['del_comm']}" class="button">
                </td>
        </form>
        </tr>
EOT;
endtable();
pagefooter();
?>
