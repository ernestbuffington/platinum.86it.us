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
define('ALBMGR_PHP', true);
require("modules/" . $name . "/include/load.inc");
if ($cat){
    if ($cat == USER_GAL_CAT) {
        $thisalbum = 'category > ' . FIRST_USER_CAT;
    } elseif (!is_numeric($album) && is_numeric($cat)) {
        $thisalbum = "category = '$cat'";
    } else if (is_numeric($album)) {
        $thisalbum= "a.aid = $album";
    } else {
        $thisalbum = "category >= '0'";//just something that is true
    }
}
if (!(GALLERY_ADMIN_MODE || USER_ADMIN_MODE)) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__, 0, 1);
function get_subcat_data($parent, $ident = '')
{
    global $CONFIG, $CAT_LIST;
    $result = db_query("SELECT cid, catname, description FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent' AND cid != 1 ORDER BY pos");
    if (mysql_num_rows($result) > 0) {
        $rowset = db_fetch_rowset($result);
        foreach ($rowset as $subcat) {
            $CAT_LIST[] = array($subcat['cid'], $ident . $subcat['catname']);
            get_subcat_data($subcat['cid'], $ident . '&nbsp;&nbsp;&nbsp;');
        } 
    } 
} 
if (($_GET['move'] == 'up' || $_GET['move'] == 'top') && intval($_GET['aid'])>0) {
    $result = db_query("SELECT pos, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".intval($_GET['aid']));
    $album = mysql_fetch_array($result);
    $cat = $album['category'];
    if ($album['pos'] > 0) {
        $newpos = ($_GET['move'] == 'top') ? 0 : ($album['pos']-1);
        db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET pos=pos+1 WHERE category = $cat AND pos < $album[pos] AND pos > $newpos-1");
        db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET pos=$newpos WHERE aid = $_GET[aid]");
    }
    header('Location: '.getlink("&file=albmgr&cat=$cat"));
    exit;
} else if (($_GET['move'] == 'down' || $_GET['move'] == 'bottom') && intval($_GET['aid'])>0) {
    $result = db_query("SELECT pos, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".intval($_GET['aid']));
    $album = mysql_fetch_array($result);
    $cat = $album['category'];
    $result = db_query("SELECT pos FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat ORDER BY pos DESC LIMIT 1");
    $last = mysql_fetch_array($result);
    if ($album['pos'] < $last['pos']) {
        $newpos = ($_GET['move'] == 'down') ? ($album['pos']+1) : $last['pos'];
        db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET pos=pos-1 WHERE category = $cat AND pos > $album[pos] AND pos < $newpos+1");
        db_query("UPDATE {$CONFIG['TABLE_ALBUMS']} SET pos=$newpos WHERE aid = $_GET[aid]");
    }
    header('Location: '.getlink("&file=albmgr&cat=$cat"));
    exit;
} else if ($_GET['mode'] == 'addalb' && isset($_POST['cat'])) {
    if (GALLERY_ADMIN_MODE) {
        $cat = intval($_POST['cat']);
    } else {
        $cat = FIRST_USER_CAT + USER_ID;
    }
    $result = db_query("SELECT pos FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat ORDER BY pos DESC LIMIT 1");
    list($last) = mysql_fetch_array($result);
    if ($last == '') $last = 0;
    else $last++;
    $title = (get_magic_quotes_gpc() ? $_POST['title'] : addslashes($_POST['title']));
    if ($title == '') cpg_die(ERROR, 'Album title can\'t be empty', __FILE__, __LINE__, 0, 1);
    db_query("INSERT INTO {$CONFIG['TABLE_ALBUMS']} (title, pos, category) VALUES ('$title', '$last', '$cat')");
    header('Location: '.getlink("&file=albmgr&cat=$cat"));
    exit;
} else if ($_GET['mode'] == 'delalb' && intval($_GET['aid']) > 0) {
    $message = 'Are you shure you want to delete the album and all containing pictures ?<br><br>
    <a href="'.getlink('&amp;file=delete&amp;id='.intval($_GET['aid']).'&amp;what=album').'">YES</a> / <a href="javascript:history.go(-1)">NO</a>';
    cpg_die('Delete album', $message, __FILE__, __LINE__, 0, 1);
}
pageheader($lang_albmgr_php['alb_mrg']);
starttable("100%", $lang_albmgr_php['alb_mrg'], 1);
echo '<tr>';
$cat = isset($_GET['cat']) ? ($_GET['cat']) : 0;
if ($cat == 1) $cat = 0;
if (GALLERY_ADMIN_MODE) {
    $result = db_query("SELECT aid, title, pos, description, thumb FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat ORDER BY pos ASC");
} elseif (USER_ADMIN_MODE) {
    $result = db_query("SELECT aid, title, pos, description, thumb FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = " . (USER_ID + FIRST_USER_CAT) . " ORDER BY pos ASC");
} else cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
$rowset = db_fetch_rowset($result);
echo '<td class="tableb" valign="top" align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
';
// Create category select dropdown
if (GALLERY_ADMIN_MODE) {
    $CAT_LIST = array();
    $CAT_LIST[] = array(FIRST_USER_CAT + USER_ID, $lang_albmgr_php['my_gallery']);
    $CAT_LIST[] = array(0, $lang_albmgr_php['no_category']);
    get_subcat_data(0, '');
    echo '<form name="album_menu" method="post" action="'.getlink('&amp;file=albmgr').'" enctype="multipart/form-data" accept-charset="'._CHARSET.'">';
    echo <<<EOT
        <tr>
            <td>
            <strong>{$lang_albmgr_php['select_category']}</strong>
            <select onChange="if(this.options[this.selectedIndex].value) window.location.href='$CPG_URL&amp;file=albmgr&amp;cat='+this.options[this.selectedIndex].value;"  name="cat" class="listbox">
EOT;
    foreach($CAT_LIST as $category) {
        echo '            <option value="' . $category[0] . '"' . ($cat == $category[0] ? ' selected': '') . ">" . $category[1] . "</option>\n";
    } 
    echo <<<EOT
                </select>
            <br /><br />
            </td>
        </tr>
        </form>
EOT;
}
?>        <tr>
            <td>
                <table width="100%" border="1">
<?php
// Now let's create the list of albums that belong to the choosen category
if (count($rowset) > 0) {
    $result = db_query("SELECT pos FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = $cat ORDER BY pos DESC LIMIT 0,1");
    list($last) = mysql_fetch_array($result);
    foreach ($rowset as $album) {
    $img = '<img src="'.$CPG_M_DIR.'/images/nopic.jpg" alt="" />';
    if ($album['thumb'] > 0) {
        $result = db_query("SELECT filepath, filename, pwidth, pheight FROM {$CONFIG['TABLE_PICTURES']} WHERE pid='$album[thumb]'");
        $picture = mysql_fetch_array($result);
        $img = '<a onclick="window.open(\''.getlink('&file=displayimagepopup&pid='.$album['thumb'].'&fullsize=1').'\',\'preview\',\'resizable=yes,scrollbars=yes,width='.($picture['pwidth']+30).',height='.($picture['pheight']+40).',left=0,top=0\');return false" target="preview" href="'.getlink('&amp;file=displayimagepopup&amp;pid='.$album['thumb'].'&amp;fullsize=1').'"><img src="'.get_pic_url($picture, 'thumb').'" alt="" width="100" height="75" border="0" /></a>';
    }
    $result = db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE aid='$album[aid]'");
    list($count) = mysql_fetch_row($result);
    if ($count > 0) {
        $count .= '<br/><a href="'.getlink('&amp;file=editpics&amp;album='.$album['aid']).'">Edit pictures</a>';
    }
    echo '<tr><td rowspan="2" width="100">'.$img.'</td><td class="tableh1" colspan="5" height="18"><strong>'.$album['title'].'</strong></td></tr>
    <tr><td valign="top">'.$album['description'].'<br/></td><td width="100" align="center">'.$count.'</td><td width="50" align="center"><a href="'.getlink('&amp;file=modifyalb&amp;album='.$album['aid']).'">edit</a></td><td width="50" align="center"><a href="'.getlink('&amp;file=albmgr&amp;aid='.$album['aid'].'&amp;mode=delalb').'">delete</a></td><td width="120" align="center">';
    if ($album['pos'] > 0) {
        echo '<a href="'.getlink('&amp;file=albmgr&amp;aid='.$album['aid'].'&amp;move=top').'">Move to top</a><br/><a href="'.getlink('&amp;file=albmgr&amp;aid='.$album['aid'].'&amp;move=up').'">Move up</a><br/>';
    }
    if ($album['pos'] < $last) {
        echo '<a href="'.getlink('&amp;file=albmgr&amp;aid='.$album['aid'].'&amp;move=down').'">Move down</a><br/><a href="'.getlink('&amp;file=albmgr&amp;aid='.$album['aid'].'&amp;move=bottom').'">Move to bottom</a>';
    }
    echo "</td></tr>\n\n";
    }
} else {
    echo '<tr><td align="center" height="75"><strong>No albums in this category</strong></td></tr>';
}
echo '</table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <form name="new_album" method="post" action="'.getlink('&amp;file=albmgr&amp;mode=addalb').'" enctype="multipart/form-data" accept-charset="'._CHARSET.'">
    <input type="hidden" name="cat" value="'.$cat.'">
    <tr>
        <td colspan="2" class="tablef">
        <input type="text" name="title" size="27" maxlength="80"> <input type="submit" value="Add new album">
        </td>
    </tr>
    </form>';
endtable();
pagefooter();
?>
