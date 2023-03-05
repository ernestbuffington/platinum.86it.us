<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */ 
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/
if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
global $admin_file;
$result = $db->sql_query("SELECT radminsuper FROM $prefix"._authors." WHERE aid='$aid'");
list($radminsuper) = $db->sql_fetchrow($result);
if ($radminsuper==1) {
/*********************************************************/
/* Center Blocks Functions                               */
/*********************************************************/
function CBSample($set) {
    global $db, $prefix;
    $cbinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsncb_config WHERE cgid='$set'"));
    if ($cbinfo['height'] <> "0") { $cheight = "height='".$cbinfo['height']."' "; } else { $cheight = ""; }
    OpenTable();
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='0' bgcolor='$bgcolor2'><tr><td valign='top'>\n";
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='4' bgcolor='$bgcolor1'><tr>";
    $result3 = $db->sql_query("SELECT * FROM ".$prefix."_nsncb_blocks WHERE cgid='$set' ORDER BY cbid");
    while($cbidinfo = $db->sql_fetchrow($result3)) {
        if ($cbidinfo['cbid'] <= $cbinfo['count']) {
            if ($cbidinfo['wtype'] == '0') {
                echo "<td width='".$cbidinfo['width']."' valign='top' align='center'>\n";
            } else {
                echo "<td width='".$cbidinfo['width']."%' valign='top' align='center'>\n";
            }
            cb_blocks($cbidinfo['rid']);
            echo "</td>\n";
        }
    }
    echo "</tr></table>\n";
    echo "</td></tr></table>\n";
    CloseTable();
    echo "<br />";
}
function CBMenu() {
    global $admin_file;
    OpenTable();
    echo "<center>";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet1'>"._CB_CONFIG1."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet2'>"._CB_CONFIG2."</a><br />\n";
    echo "</center>";
    CloseTable();
}
switch($op) {
    case "CenterBlocksAdmin":
        include_once("header.php");
        title(_CB_ADMIN);
        CBMenu();
        include_once("footer.php");
    break;
    case "CenterBlocksSet1":
        include_once("header.php");
        title(_CB_ADMIN1);
        CBMenu();
        echo"<br />\n";
        CBSample(1);
        OpenTable();
        title(_CB_CONFIG1);
        $cbinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsncb_config WHERE cgid='1'"));
        echo "<center><table border='0'><tr><form action='".$admin_file.".php' method='post'>\n";
        echo "<td>"._CB_ACTIVE.": <select name='xenabled'>\n";
        if ($cbinfo['enabled'] == 0) { $se0 = " selected"; } else { $se1 = " selected"; }
        echo "<option value='0'".$se0.">"._NO."</option>\n";
        echo "<option value='1'".$se1.">"._YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td>"._CB_NUMBER.": <select name='xcount'>\n";
        if ($cbinfo['count'] == 1) { $sc1 = " selected";} elseif ($cbinfo['count'] == 2) { $sc2 = " selected";} elseif ($cbinfo['count'] == 3) { $sc3 = " selected";} elseif ($cbinfo['count'] == 4) { $sc4 = " selected";}
        echo "<option value='1'".$sc1.">1</option>\n<option value='2'".$sc2.">2</option>\n";
        echo "<option value='3'".$sc3.">3</option>\n<option value='4'".$sc4.">4</option>\n</select></td></tr>\n";
        echo "<tr><td>"._CB_HEIGHT.": <input size='4' type='text' name='xheight' value='".$cbinfo['height']."'></td>";
        echo "</tr></table></center><br /><br /><br />\n";
        title(_CB_LIST1);
        $cblocksdir = dir("blocks");
        while($func=$cblocksdir->read()) {
            if(substr($func, 0, 6) == "block-") {
                $cblockslist .= "$func ";
            }
        }
        closedir($cblocksdir->handle);
        $cblockslist = explode(" ", $cblockslist);
        sort($cblockslist);
        $result2 = $db->sql_query("SELECT * FROM $prefix"._nsncb_blocks." WHERE cgid='1' ORDER BY cbid");
        echo "<table border='1' width='100%'><tr bgcolor='$bgcolor2'>";
        echo "<td align='center'><strong>"._CB_BLOCK."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_TITLE."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_FILENAME."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_CONTENT."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_SPEC."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_WID."</strong></td>\n";
        echo "</tr>\n";
        while($cbidinfo = $db->sql_fetchrow($result2)) {
            echo "<tr>\n";
            echo "<td align='center' valign='top'>".$cbidinfo['cbid']."</td>\n";
            echo "<td align='center' valign='top'><input type='text' name='x".$cbidinfo['cbid']."title' value='".$cbidinfo['title']."'></td>\n";
            echo "<td align='center' valign='top'><select name='x".$cbidinfo['cbid']."name'>";
            echo "<option ";
            if ($cbidinfo['filename']=="") { echo "selected "; }
            echo "value=''>"._CB_NONE."</option>\n";
            for ($i=0; $i < sizeof($cblockslist); $i++) {
                if($cblockslist[$i]!="") {
                    $bl = preg_replace("/block-/","",$cblockslist[$i]);
                    $bl = preg_replace("/.php/","",$bl);
                    $bl = preg_replace("/_/"," ",$bl);
                    echo "<option ";
                    if ($cblockslist[$i]==$cbidinfo['filename']) { echo "selected "; }
                    echo "value='$cblockslist[$i]'>$bl</option>\n";
                }
            }
            echo "</select></td>\n";
            echo "<td align='center' valign='top'><textarea name='x".$cbidinfo['cbid']."content' cols='30' wrap='virtual'>".$cbidinfo['content']."</textarea></td>\n";
            echo "<td align='center' valign='top'><select name='x".$cbidinfo['cbid']."wtype'>";
            if ($cbidinfo['wtype'] == 0) { $w1t0 = " selected"; } else { $w1t1 = " selected"; }
            echo "<option value='0'".$w1t0.">"._CB_PIX."</option>\n";
            echo "<option value='1'".$w1t1.">"._CB_PER."</option>\n";
            echo "</select></td>\n";
            echo "<td align='center' valign='top'><input size='4' type='text' name='x".$cbidinfo['cbid']."width' value='".$cbidinfo['width']."'></td>\n</tr>\n";
        }
        echo "</table><br /><br /><br /><input type='hidden' name='op' value='CenterBlocksSave1'>";
        echo "<center><input type='submit' value='"._CB_SAVE."'></center></form>";
        CloseTable();
        include_once("footer.php");
    break;
    case "CenterBlocksSet2":
        include_once("header.php");
        title(_CB_ADMIN2);
        CBMenu();
        echo"<br />\n";
        CBSample(2);
        OpenTable();
        title(_CB_CONFIG2);
        $cbinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsncb_config WHERE cgid='2'"));
        echo "<center><table border='0'><tr><form action='".$admin_file.".php' method='post'>\n";
        echo "<td>"._CB_ACTIVE.": <select name='xenabled'>\n";
        if ($cbinfo['enabled'] == 0) { $se0 = " selected"; } else { $se1 = " selected"; }
        echo "<option value='0'".$se0.">"._NO."</option>\n";
        echo "<option value='1'".$se1.">"._YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td>"._CB_NUMBER.": <select name='xcount'>\n";
        if ($cbinfo['count'] == 1) { $sc1 = " selected";} elseif ($cbinfo['count'] == 2) { $sc2 = " selected";} elseif ($cbinfo['count'] == 3) { $sc3 = " selected";} elseif ($cbinfo['count'] == 4) { $sc4 = " selected";}
        echo "<option value='1'".$sc1.">1</option>\n<option value='2'".$sc2.">2</option>\n";
        echo "<option value='3'".$sc3.">3</option>\n<option value='4'".$sc4.">4</option>\n</select></td></tr>\n";
        echo "<tr><td>"._CB_HEIGHT.": <input size='4' type='text' name='xheight' value='".$cbinfo['height']."'></td>";
        echo "</tr></table></center><br /><br /><br />\n";
        title(_CB_LIST2);
        $cblocksdir = dir("blocks");
        while($func=$cblocksdir->read()) {
            if(substr($func, 0, 6) == "block-") {
                $cblockslist .= "$func ";
            }
        }
        closedir($cblocksdir->handle);
        $cblockslist = explode(" ", $cblockslist);
        sort($cblockslist);
        $result2 = $db->sql_query("SELECT * FROM $prefix"._nsncb_blocks." WHERE cgid='2' ORDER BY cbid");
        echo "<table border='1' width='100%'><tr bgcolor='$bgcolor2'>";
        echo "<td align='center'><strong>"._CB_BLOCK."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_TITLE."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_FILENAME."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_CONTENT."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_SPEC."</strong></td>\n";
        echo "<td align='center'><strong>"._CB_WID."</strong></td>\n";
        echo "</tr>\n";
        while($cbidinfo = $db->sql_fetchrow($result2)) {
            echo "<tr>\n";
            echo "<td align='center' valign='top'>".$cbidinfo['cbid']."</td>\n";
            echo "<td align='center' valign='top'><input type='text' name='x".$cbidinfo['cbid']."title' value='".$cbidinfo['title']."'></td>\n";
            echo "<td align='center' valign='top'><select name='x".$cbidinfo['cbid']."name'>";
            echo "<option ";
            if ($cbidinfo['filename']=="") { echo "selected "; }
            echo "value=''>"._CB_NONE."</option>\n";
            for ($i=0; $i < sizeof($cblockslist); $i++) {
                if($cblockslist[$i]!="") {
                    $bl = preg_replace("/block-/","",$cblockslist[$i]);
                    $bl = preg_replace("/.php/","",$bl);
                    $bl = preg_replace("/_/"," ",$bl);
                    echo "<option ";
                    if ($cblockslist[$i]==$cbidinfo['filename']) { echo "selected "; }
                    echo "value='$cblockslist[$i]'>$bl</option>\n";
                }
            }
            echo "</select></td>\n";
            echo "<td align='center' valign='top'><textarea name='x".$cbidinfo['cbid']."content' cols='30' wrap='virtual'>".$cbidinfo['content']."</textarea></td>\n";
            echo "<td align='center' valign='top'><select name='x".$cbidinfo['cbid']."wtype'>";
            if ($cbidinfo['wtype'] == 0) { $w1t0 = " selected"; } else { $w1t1 = " selected"; }
            echo "<option value='0'".$w1t0.">"._CB_PIX."</option>\n";
            echo "<option value='1'".$w1t1.">"._CB_PER."</option>\n";
            echo "</select></td>\n";
            echo "<td align='center' valign='top'><input size='4' type='text' name='x".$cbidinfo['cbid']."width' value='".$cbidinfo['width']."'></td>\n</tr>\n";
        }
        echo "</table><br /><br /><br /><input type='hidden' name='op' value='CenterBlocksSave2'>";
        echo "<center><input type='submit' value='"._CB_SAVE."'></center></form>";
        CloseTable();
        include_once("footer.php");
    break;
    case "CenterBlocksSave1":
        $x1content = stripslashes(FixQuotes($x1content));
        $x2content = stripslashes(FixQuotes($x2content));
        $x3content = stripslashes(FixQuotes($x3content));
        $x4content = stripslashes(FixQuotes($x4content));
        if ($x1name > "") { $x1content = ""; }
        if ($x2name > "") { $x2content = ""; }
        if ($x3name > "") { $x3content = ""; }
        if ($x4name > "") { $x4content = ""; }
        $x1title = stripslashes(FixQuotes($x1title));
        $x2title = stripslashes(FixQuotes($x2title));
        $x3title = stripslashes(FixQuotes($x3title));
        $x4title = stripslashes(FixQuotes($x4title));
        $result = $db->sql_query("UPDATE ".$prefix."_nsncb_config SET enabled='$xenabled', count='$xcount', height='$xheight' WHERE cgid='1'");
        $result1 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x1content', filename='$x1name', title='$x1title', wtype='$x1wtype', width='$x1width' WHERE cbid='1' AND cgid='1'");
        $result2 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x2content', filename='$x2name', title='$x2title', wtype='$x2wtype', width='$x2width' WHERE cbid='2' AND cgid='1'");
        $result3 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x3content', filename='$x3name', title='$x3title', wtype='$x3wtype', width='$x3width' WHERE cbid='3' AND cgid='1'");
        $result4 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x4content', filename='$x4name', title='$x4title', wtype='$x4wtype', width='$x4width' WHERE cbid='4' AND cgid='1'");
        Header("Location: ".$admin_file.".php?op=CenterBlocksAdmin");
    break;
    case "CenterBlocksSave2":
        $x1content = stripslashes(FixQuotes($x1content));
        $x2content = stripslashes(FixQuotes($x2content));
        $x3content = stripslashes(FixQuotes($x3content));
        $x4content = stripslashes(FixQuotes($x4content));
        if ($x1name > "") { $x1content = ""; }
        if ($x2name > "") { $x2content = ""; }
        if ($x3name > "") { $x3content = ""; }
        if ($x4name > "") { $x4content = ""; }
        $x1title = stripslashes(FixQuotes($x1title));
        $x2title = stripslashes(FixQuotes($x2title));
        $x3title = stripslashes(FixQuotes($x3title));
        $x4title = stripslashes(FixQuotes($x4title));
        $result = $db->sql_query("UPDATE ".$prefix."_nsncb_config SET enabled='$xenabled', count='$xcount', height='$xheight' WHERE cgid='2'");
        $result1 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x1content', filename='$x1name', title='$x1title', wtype='$x1wtype', width='$x1width' WHERE cbid='1' AND cgid='2'");
        $result2 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x2content', filename='$x2name', title='$x2title', wtype='$x2wtype', width='$x2width' WHERE cbid='2' AND cgid='2'");
        $result3 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x3content', filename='$x3name', title='$x3title', wtype='$x3wtype', width='$x3width' WHERE cbid='3' AND cgid='2'");
        $result4 = $db->sql_query("UPDATE ".$prefix."_nsncb_blocks SET content='$x4content', filename='$x4name', title='$x4title', wtype='$x4wtype', width='$x4width' WHERE cbid='4' AND cgid='2'");
        Header("Location: ".$admin_file.".php?op=CenterBlocksAdmin");
    break;
}
} else {
    echo "Access Denied";
}
?>
