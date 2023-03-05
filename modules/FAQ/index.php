<?php
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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '.$module_name;

if (!isset($myfaq)) {
    global $currentlang, $multilingual;
    if ($multilingual == 1) {
        $querylang = 'WHERE flanguage=\''.$currentlang.'\'';
    } else {
        $querylang = '';
    }
    include_once('header.php');
    OpenTable();
    echo '<center><span class="option">'._FAQ2.'</span></center><br /><br />'
        .'<table width="100%" cellpadding="4" cellspacing="0" border="0">'
        .'<tr><td bgcolor="'.$bgcolor2.'"><span class="option"><strong>'._CATEGORIES.'</strong></span></td></tr><tr><td>';
    $result2 = $db->sql_query('SELECT id_cat, categories FROM '.$prefix.'_faqcategories '.$querylang);
    while ($row2 = $db->sql_fetchrow($result2)) {
        $id_cat = intval($row2['id_cat']);
        $categories = stripslashes(check_html($row2['categories'], 'nohtml'));
        $catname = urlencode($categories);
        echo'<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name='.$module_name.'&amp;myfaq=yes&amp;id_cat='.$id_cat.'&amp;categories='.$catname.'">'.$categories.'</a>';
        if (is_admin($admin)) {
            echo ' [ <a href="'.$admin_file.'.php?op=FaqCatEdit&amp;id_cat='.$id_cat.'">'._EDIT.'</a>'
                .' | <a href="'.$admin_file.'.php?op=FaqCatDel&amp;id_cat='.$id_cat.'&amp;ok=0">'._DELETE.'</a> ]';
        }
        echo '<br />';
    }
    echo '</td></tr></table>';
    CloseTable();
    include_once('footer.php');
} else {
    include_once('header.php');
    ShowFaq($id_cat, $categories);
    ShowFaqAll($id_cat);
    CloseTable();
    include_once('footer.php');
}
die();

//Only functions after this line

function ShowFaq($id_cat, $categories) {
    global $bgcolor2, $sitename, $prefix, $db, $module_name, $admin, $admin_file;
    $categories = htmlentities($categories);
    OpenTable();
    echo '<center><font class="content"><strong>'.$sitename.' '._FAQ2.'</strong></font></center><br /><br />'
        .'<a name="top"></a><br />' /* Bug fix : added missing closing hyperlink tag messes up display */
        ._CATEGORY.': <a href="modules.php?name='.$module_name.'">'._MAIN.'</a> -> '.$categories
        .'<br /><br />'
        .'<table width="100%" cellpadding="4" cellspacing="0" border="0">'
        .'<tr bgcolor="'.$bgcolor2.'"><td colspan="2"><font class="option"><strong>'
        ._QUESTION.'</strong></font></td></tr><tr><td colspan="2">';
    $id_cat = intval($id_cat);
    $result = $db->sql_query('SELECT id, id_cat, question, answer FROM '.$prefix.'_faqanswer WHERE id_cat=\''.$id_cat.'\'');
    while ($row = $db->sql_fetchrow($result)) {
        $id = intval($row['id']);
        $id_cat = intval($row['id_cat']);
        $question = stripslashes(check_html($row['question'], 'nohtml'));
        $answer = stripslashes($row['answer']);
        echo'<strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href="#'.$id.'">'.$question.'</a>';
        if (is_admin($admin)) {
            echo ' [ <a href="'.$admin_file.'.php?op=FaqCatGoEdit&amp;id='.$id.'">'._EDIT.'</a>'
                .' | <a href="'.$admin_file.'.php?op=FaqCatGoDel&amp;id='.$id.'&amp;ok=0">'._DELETE.'</a> ]';
        }
        echo '<br />';
    }
    echo '</td></tr></table><br />';
}

function ShowFaqAll($id_cat) {
    global $bgcolor2, $prefix, $db, $module_name;
    $id_cat = intval($id_cat);
    echo '<table width="100%" cellpadding="4" cellspacing="0" border="0">'
        .'<tr bgcolor="'.$bgcolor2.'"><td colspan="2"><font class="option"><strong>'._ANSWER.'</strong></font></td></tr>';
    $result = $db->sql_query('SELECT id, id_cat, question, answer FROM '.$prefix.'_faqanswer WHERE id_cat=\''.$id_cat.'\'');
    while ($row = $db->sql_fetchrow($result)) {
        $id = intval($row['id']);
        $id_cat = intval($row['id_cat']);
        $question = stripslashes(check_html($row['question'], 'nohtml'));
        $answer = stripslashes($row['answer']);
        echo'<tr><td><a name="'.$id.'"></a>'
            .'<strong><big>&middot;</big></strong>&nbsp;&nbsp;<strong>'.$question.'</strong>'
            .'<p align="justify">'.$answer.'</p>'
            .'[ <a href="#top">'._BACKTOTOP.'</a> ]'
            .'<br /><br />'
            .'</td></tr>';
    }
    echo '</table><br /><br />'
        .'<div align="center"><strong>[ <a href="modules.php?name='.$module_name.'">'._BACKTOFAQINDEX.'</a> ]</strong></div>';
}

?>
