<?php

/******************************************************/
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* THIS MODULE IS NOT RELEASED UNDER THE GPL/GNU      */
/* LICENSE.                                           */
/*                                                    */
/* You can modifiy all files, EXCEPT the copyright    */
/* file to your liking. But you CANNOT redistribute   */
/* this module for any purpose, without the EXPRESS   */
/* WRITTEN CONSENT from Shawn Archer.                 */
/*                                                    */
/* Also, Francisco Burzi & the Nuke credits MUST      */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
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
if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $prefix, $db, $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;	
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	
	
include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_functions.php");
include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_language.php");    
 
 
function ns_edl_theme() {
    global $prefix, $db, $user, $userinfo, $Default_Theme, $admin_file;
    ns_edl_top("theme");
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<br />";
    echo "<div align=\"center\"><font class=\"title\">"._NSDLTHNOTE."</font>";
    ns_edl_help(""._NSDLTHNOTE."", "th_main", "450", "500", "$id");
    echo "</div><br /><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\">";
    echo "<strong>"._NSINSTALLTHM.":</strong><br /><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<select name=\"name\">";
    echo "<option value=\"\">"._NSDLCHTHM."\n";
    echo "<option value=\"\">-------------------------\n";
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
	if ( (!preg_match("/[.]/",$file)) ) {
		$themelist .= "$file ";
	}
    }
    closedir($handle);
    $themelist = explode(" ", $themelist);
    sort($themelist);
    for ($i = 0; $i < sizeof($themelist); $i++) {
	if($themelist[$i] != "") {
        $result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where name='$themelist[$i]'");
        list($name) = $db->sql_fetchrow($result);
	    if ($themelist[$i] != $name) {
	        echo "<option value=\"$themelist[$i]\">$themelist[$i]\n";
	    }    
	}	
    }
    echo "<option value=\"\">-------------------------\n";
    echo "</select><br /><br />";
    echo "<br /><input type=\"hidden\" name=\"op\" value=\"ns_edl_theme_install\">";
    echo "<center><input type=\"submit\" value=\""._NSBINSTALL."\"></center>";
    echo "</form>";
    echo "</td>";
    echo "<td width=\"60\">&nbsp;</td>"; 
    echo "<td align=\"center\">";
    echo "<strong>"._NSEDITTB.":</strong><br /><br />";
    echo "<form action=\"".$admin_file.".php#mode\" method=\"post\">";
    echo "<select name=\"id\">";
    echo "<option value=\"\">"._NSDLCHTHM."\n";
    echo "<option value=\"\">-------------------------\n";
    $result = $db->sql_query("select id, name from ".$prefix."_ns_downloads_theme");
    while(list($id, $name) = $db->sql_fetchrow($result)) {
	echo "<option value=\"$id\">$name\n";
    }
    echo "<option value=\"\">-------------------------\n";
    echo "</select><br /><br />";
    echo "<input type=\"hidden\" value=\"$id\">";
    echo "<input type=\"hidden\" value=\"$name\">";
    echo "<br /><input type=\"hidden\" name=\"op\" value=\"ns_edl_theme_mode\">";
    echo "<center><input type=\"submit\" value=\""._NSBEDIT."\"></center>";
    echo "</form>";    
    echo "</td>";
    echo "<td width=\"60\">&nbsp;</td>"; 
    echo "<td align=\"center\">";
    echo "<strong>"._NSDLUNINSTTH.":</strong><br /><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<select name=\"id\">";
    echo "<option value=\"\">"._NSDLCHTHM."\n";
    echo "<option value=\"\">-------------------------\n";
    $result = $db->sql_query("select id, name from ".$prefix."_ns_downloads_theme");
    while(list($id, $name) = $db->sql_fetchrow($result)) {
	echo "<option value=\"$id\">$name\n";
    }
    echo "<option value=\"\">-------------------------\n";
    echo "</select><br /><br /><br />";
    echo "<input type=\"hidden\" value=\"$id\">";
    echo "<input type=\"hidden\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_theme_uninstall\">";
    echo "<center><input type=\"submit\" value=\""._NSDLBUNINSTTH."\"></center>";
    echo "</form>";    
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br />";
    ns_dl_CloseTable();
    ns_edl_linkbar("table", "$id");
    ns_edl_bottom();    
}
    


function ns_edl_theme_install($name) {
    global $prefix, $db, $admin_file;
    if ($name != "") {
    $db->sql_query("insert into ".$prefix."_ns_downloads_theme values (NULL,'$name')");
    Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    } else {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    }
}



function ns_edl_theme_mode($id, $mchange = 0) {
    global $prefix, $db, $admin_file;
    if ($id == "") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    }
    $result_m = $db->sql_query("select mode, mset from ".$prefix."_ns_downloads_theme_mode where id='$id'");
    list($mode, $mset) = $db->sql_numrows($result_m);
    $result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
    list($name) = $db->sql_numrows($result);    
if ($mset == 0 || $mode == 1 || $mchange == 1) {		
    ns_edl_top("mode");  
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<br /><br />";
    echo "<center><strong>"._NSDLTBSETFOR." <font color=\"#CC0000\">$name</font></strong>";
    ns_edl_help(""._NSDLTBMODE."", "th_mode", "520", "500", "$id");
    echo "</center><br /><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    if ($mset == 1) {
        if ($mode == 1) {
            $chk1 = "checked";
	    $chk2 = "";
	    $chk3 = "";
            $mode1 = "<strong>"._NSDLUSETBCF.":</strong>";
	    $mode2 = ""._NSDLUSEDESIGN.":";
	    $mode3 = ""._NSDLUSEHTML.":";
	} elseif ($mode == 2) {
            $chk1 = "";
	    $chk2 = "checked";
	    $chk3 = "";
            $mode1 = ""._NSDLUSETBCF.":";
	    $mode2 = "<strong>"._NSDLUSEDESIGN.":</strong>";
	    $mode3 = ""._NSDLUSEHTML.":";
	} elseif ($mode == 3) {
            $chk1 = "";
	    $chk2 = "";
	    $chk3 = "checked";
            $mode1 = ""._NSDLUSETBCF.":";
	    $mode2 = ""._NSDLUSEDESIGN.":";
	    $mode3 = "<strong>"._NSDLUSEHTML.":</strong>";
	}
    echo "<tr><td align=\"right\" width=\"50%\">$mode1</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"1\" $chk1>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">$mode2</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"2\" $chk2>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">$mode3</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"3\" $chk3>";
    echo "</td></tr>";
    } else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLUSETBCF.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLUSEDESIGN.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"2\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLUSEHTML.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"mode\" value=\"3\">";
    echo "</td></tr>";    
    }
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    if ($mset == 1) {
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
	echo "<input type=\"hidden\" name=\"mset\" value=\"1\">";    	
	echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_theme_update\">";
        echo "<input type=\"submit\" value=\""._NSDLBSETUPDATE."\">";
    } else {
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
	echo "<input type=\"hidden\" name=\"mset\" value=\"1\">";
	echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_theme_save\">";
        echo "<input type=\"submit\" value=\""._NSDLBSET."\">";	
    }
    echo "</td></tr>";
    echo "</table></form><br />";
    ns_dl_CloseTable();
    ns_edl_linkbar("table", "$id");
    ns_edl_bottom();
} elseif ($mset == 1 && $mode == 2 || $mode == 3) {
    Header("Location: ".$admin_file.".php?op=ns_edl_table_list&id=$id&name=$name&mset=1&mode=$mode#list");	
    }
}
    
    

function ns_edl_table_list($id, $name, $mset, $mode) {
    global $prefix, $db, $admin_file;
    if ($id == "") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    } else {
    ns_edl_top("list");
    $result_th = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
    list($name) = $db->sql_numrows($result_th);
if ($mset == 1 && $mode == 2) {
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    $mode_name = ""._NSDLTBMNAME2."";
    echo "<br /><center><strong>"._NSDLTBCURRENT." <font color=\"#CC0000\">$name</font></strong><br /><br />";
    $result_act = $db->sql_query("SELECT * from ".$prefix."_ns_downloads_table_form where id='$id' && act='1'");
    $active = $db->sql_numrows($result_act);
        if (!$active) {
        echo "<font color=\"#CC0000\"><strong>"._NSDLTBNOACTIVE."</strong></font>";
	}
    echo "<br /><br /></center>";	
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr>";
    echo "<td align=\"center\" width=\"15%\">";
    echo "<strong><u>"._NSDLTBNAME."</u></strong></td>";
    echo "<td align=\"center\" width=\"30%\">";
    echo "<strong><u>"._NSDLTBMODE."</u></strong></td>";
    echo "<td align=\"center\" width=\"30%\">";
    echo "<strong><u>"._NSDLTBFUNC."</u></strong></td>";
    echo "<td align=\"center\" width=\"25%\">";
        if (!$active) {
        echo "<font color=\"#CC0000\"><strong><u>"._NSDLTBACTIVE."</u></strong></font>";
	} else {
        echo "<strong><u>"._NSDLTBACTIVE."</u></strong>";
	}
    ns_edl_help(""._NSDLTBACTIVE."", "tb_status", "350", "365", "$id");
    echo "</td></tr>";
        $nstb = 1;
	$result_fm = $db->sql_query("SELECT tid, width, cpad, cspace, align, bdr, bdrclr, trclr, tdclr, bgclr, bgimg, act from ".$prefix."_ns_downloads_table_form where id='$id'");
        while(list($tid, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $act) = $db->sql_fetchrow($result_fm)) {	
	if ($act == 0) {
	echo "<tr><td align=\"center\">"._NSDLTBNAME." $nstb</td>";
	echo "<td align=\"center\">$mode_name</td>";
	} elseif ($act == 1) {
	echo "<tr><td align=\"center\"><strong>"._NSDLTBNAME." $nstb</strong></td>";
	echo "<td align=\"center\"><strong>$mode_name</strong></td>";
	}
    echo "<td align=\"center\">";
    echo "<script type=\"text/javascript\">\n";
    echo "function view_table(page) {\n";
    echo "OpenWin = this.open(page, \"CtrlWindow\", \"toolbar=no,menubar=no,";
    echo "location=no,scrollbars=no,resize=yes,width=500,height=400,";
    echo "screenX=500,screenY=500,top=25,left=200\");\n";
    echo "}\n";
    echo "</script>\n";
    echo "<a href=\"javascript:view_table('".$admin_file.".php?op=ns_edl_table_view&amp;tid=$tid&amp;id=$id";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act')\">";
    echo ""._NSDLTVIEW."</a> - ";
    echo "<a href=\"".$admin_file.".php?op=ns_edl_table_edit&amp;id=$id&amp;tid=$tid";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act#edit\">";
    echo ""._NSDLTEDIT."</a> - ";
    echo "<a href=\"".$admin_file.".php?op=ns_edl_table_delete&amp;id=$id&amp;tid=$tid";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act#delete\">";
    echo ""._NSDLTDELETE."</a></td>";
    echo "<td align=\"center\">";
	    if ($act == 0) {
            echo "<a href=\"".$admin_file.".php?op=ns_edl_table_activate&amp;id=$id&amp;tid=$tid";
            echo "&amp;name=$name&amp;mode=$mode&amp;act=1\">";
	    echo ""._NSDLTBACTIVATE."</a>";
	    } elseif ($act == 1) {
            echo "<a href=\"".$admin_file.".php?op=ns_edl_table_deactivate&amp;id=$id&amp;tid=$tid";
            echo "&amp;name=$name&amp;mode=$mode&amp;act=0\">";
	    echo ""._NSDLTBDEACTIVATE."</a>";
	    }
    echo "</td>";
    echo "</tr>";
        $nstb++;
        }
    echo "</table><br /><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" ";
    echo "border=\"0\"><tr><td>&nbsp;</td></tr>";
    echo "<tr><td align=\"center\">";
    echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSDLBADDTB."\" onClick=\"window.location = ";
    echo "'".$admin_file.".php?op=ns_edl_table_add&amp;id=$id&amp;name=$name&amp;mode=$mode#add'\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
    echo "</td></tr>";
    echo "</table><br /><br />";
    ns_dl_CloseTable();
    ns_edl_linkbar("table", "$id");
} elseif ($mset == 1 && $mode == 3) {
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    $mode_name = ""._NSDLTBMNAME3."";
    echo "<br /><center><strong>"._NSDLTBCURRENT." <font color=\"#CC0000\">$name</font></strong><br /><br />";
    $result_act2 = $db->sql_query("SELECT * from ".$prefix."_ns_downloads_table_html where id='$id' && act='1'");
    $active = $db->sql_numrows($result_act2);
        if (!$active) {
        echo "<font color=\"#CC0000\"><strong>"._NSDLTBNOACTIVE."</strong></font>";
	}
    echo "<br /><br /></center>";	
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr>";
    echo "<td align=\"center\" width=\"15%\">";
    echo "<strong><u>"._NSDLTBNAME."</u></strong></td>";
    echo "<td align=\"center\" width=\"30%\">";
    echo "<strong><u>"._NSDLTBMODE."</u></strong></td>";
    echo "<td align=\"center\" width=\"30%\">";
    echo "<strong><u>"._NSDLTBFUNC."</u></strong></td>";
    echo "<td align=\"center\" width=\"25%\">";
        if (!$active) {
        echo "<font color=\"#CC0000\"><strong><u>"._NSDLTBACTIVE."</u></strong></font>";
	} else {
        echo "<strong><u>"._NSDLTBACTIVE."</u></strong>";
	}
    ns_edl_help(""._NSDLTBACTIVE."", "tb_status", "350", "365", "$id");
    echo "</td></tr>";
    $nshtml = 1;
	$result_ht = $db->sql_query("SELECT thid, html_open, html_close, act from ".$prefix."_ns_downloads_table_html where id='$id'");
        while(list($thid, $html_open, $html_close, $act) = $db->sql_fetchrow($result_ht)) {
	if ($act == 0) {
	echo "<tr><td align=\"center\">"._NSDLTBNAME." $nshtml</td>";
	echo "<td align=\"center\">$mode_name</td>";
	} elseif ($act == 1) {
	echo "<tr><td align=\"center\"><strong>"._NSDLTBNAME." $nstb</strong></td>";
	echo "<td align=\"center\"><strong>$mode_name</strong></td>";
	}
    echo "<td align=\"center\">";
    echo "<script type=\"text/javascript\">\n";
    echo "function view_table(page) {\n";
    echo "OpenWin = this.open(page, \"CtrlWindow\", \"toolbar=no,menubar=no,location=no,";
    echo "scrollbars=no,resize=yes,width=600,height=550,screenX=500,";
    echo "screenY=500,top=25,left=200\");\n";
    echo "}\n";
    echo "</script>\n";
    echo "<a href=\"javascript:view_table('".$admin_file.".php?op=ns_edl_table_view&amp;thid=$thid&amp;id=$id";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act')\">";
    echo ""._NSDLTVIEW."</a> - ";
    echo "<a href=\"".$admin_file.".php?op=ns_edl_table_edit&amp;id=$id&amp;thid=$thid";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act#edit\">";
    echo ""._NSDLTEDIT."</a> - ";   
    echo "<a href=\"".$admin_file.".php?op=ns_edl_table_delete&amp;id=$id&amp;thid=$thid";
    echo "&amp;name=$name&amp;mode=$mode&amp;act=$act#delete\">";
    echo ""._NSDLTDELETE."</a></td>";
    echo "<td align=\"center\">";
	    if ($act == 0) {
            echo "<a href=\"".$admin_file.".php?op=ns_edl_table_activate&amp;id=$id&amp;thid=$thid";
            echo "&amp;name=$name&amp;mode=$mode&amp;act=1\">";	
	    echo ""._NSDLTBACTIVATE."</a>";
	    } elseif ($act == 1) {
            echo "<a href=\"".$admin_file.".php?op=ns_edl_table_deactivate&amp;id=$id&amp;thid=$thid";
            echo "&amp;name=$name&amp;mode=$mode&amp;act=0\">";
	    echo ""._NSDLTBDEACTIVATE."</a>";
	    }
    echo "</td>";
    echo "</tr>";
	$nshtml++;
	}
    echo "</table><br /><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td>&nbsp;</td></tr>";
    echo "<tr><td align=\"center\">";
    echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSDLBADDTB."\" onClick=\"window.location = ";
    echo "'".$admin_file.".php?op=ns_edl_table_add&amp;id=$id&amp;name=$name&amp;mode=$mode#add'\">";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";    
    echo "</td></tr>";
    echo "</table><br /><br /><br />";    
    ns_dl_CloseTable();
    ns_edl_linkbar("table", "$id");    
}
    ns_edl_bottom();
    }
}



function ns_edl_theme_save($id, $mode, $mset) {
global $prefix, $db, $admin_file;
$db->sql_query("insert into ".$prefix."_ns_downloads_theme_mode values ('$id','$mode', '$mset')");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
}



function ns_edl_theme_update($id, $mode, $mset) {
global $prefix, $db, $admin_file;
$db->sql_query("update ".$prefix."_ns_downloads_theme_mode set mode='$mode', mset='$mset' where id='$id'");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
}



function ns_edl_table($id) {
global $prefix, $db, $admin_file;
$db->sql_query("insert into ".$prefix."_ns_downloads_theme_mode values ('$id','$mode', '$mset')");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
}



function ns_edl_table_add($id, $mode) {
    global $prefix, $db, $admin_file;
    ns_edl_top("add");
if ($mode == 2) {
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    $result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
    list($name) = $db->sql_numrows($result);
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php\" name=\"tabledesign\" method=\"post\">";    
    echo "<br /><center><font class=\"title\">"._NSDLADDTBTHEME.": $name</font>";
    echo "</center><br /><br />";
    echo "<table align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
    echo "<tr><td align=\"center\" valign=\"top\">";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\" valign=\"top\">";
    echo "<strong>"._NSDLTBCUSTOM."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_structure", "300", "400", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBWIDTH.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<select name=\"width\">";
    echo "<option value=\"10\">10%</option>";
    echo "<option value=\"20\">20%</option>";
    echo "<option value=\"30\">30%</option>";
    echo "<option value=\"40\">40%</option>";
    echo "<option value=\"50\">50%</option>";
    echo "<option value=\"60\">60%</option>";
    echo "<option value=\"70\">70%</option>";
    echo "<option value=\"80\">80%</option>";
    echo "<option value=\"90\">90%</option>";
    echo "<option value=\"100\" selected>100%</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLPADD.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cpad\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"0\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLSPACE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cspace\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"0\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBALIGN.": </td>";
    echo "<td align=\"left\" width=\"50%\"><select name=\"align\">";
    echo "<option value=\"1\">"._NSDLTBALIGNL."</option>";
    echo "<option value=\"2\" selected>"._NSDLTBALIGNC."</option>";
    echo "<option value=\"3\">"._NSDLTBALIGNR."</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBBORDER.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"bdr\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"0\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td><td width=\"60%\" valign=\"top\">";
    echo "<table width=\"100%\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<strong>"._NSDLTBCOLORSET."</strong>";
    ns_edl_help(""._NSDLTBCOLORSET."", "tb_color", "300", "350", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    echo "<script language=\"JavaScript\">\n";
    echo "function newWindow(file,window) {\n";
    echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
    echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
    echo "}\n";
    echo "</script>\n";    
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBORDERCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bdrclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bdrclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTRCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"trclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=trclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTDCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"tdclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tdclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bgclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGIMG.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgimg\" ";
    echo "size=\"20\" maxlength=\"100\" value=\"\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"list\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_preview\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_save\">"._NSDLBADDTB."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";    
    ns_dl_CloseTable();
} elseif ($mode == 3) {
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    $result = $db->sql_query("select name from ".$prefix."_ns_downloads_theme where id='$id'");
    list($name) = $db->sql_numrows($result);
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php\" method=\"post\"><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">"; 
    echo "<tr><td align=\"center\" colspan=\"2\"><strong>"._NSDLTBCUSTHTML."</strong>";
    ns_edl_help(""._NSDLTBCUSTHTML."", "tb_html", "350", "450", "$id");
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLOPEN."</strong>";
    echo "</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_open\" cols=\"120\" rows=\"30\"></textarea><br />";
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLCLOSE."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_close\" cols=\"120\" rows=\"30\"></textarea><br />";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";  
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td><td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"3\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"list\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_preview\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_save\">"._NSDLBADDTB."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";    
    ns_dl_CloseTable();
}
    ns_edl_linkbar("table", "$id");    
    ns_edl_bottom();
}



function ns_edl_table_delete($tid, $thid, $id, $mode, $confirm = 0) {
    global $prefix, $db, $admin_file;
    if ($mode == 2 && $confirm == 1) {
    $db->sql_query("delete from ".$prefix."_ns_downloads_table_form where tid='$tid' && id='$id'");
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    } elseif ($mode == 3 && $confirm == 1) {
    $db->sql_query("delete from ".$prefix."_ns_downloads_table_html where thid='$thid' && id='$id'");
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");	
    } else {
    	if ($id == "") {
        Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    	} else {
        ns_edl_top("delete");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
	echo "<center><br /><br />";
	echo "<strong>"._NSDLSUREREMTB."</strong><br />";	
	echo "<br /><br />";
    if ($mode == 2 && $confirm == 0) {
        echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_table_delete";
        echo "&amp;id=$id&amp;tid=$tid&amp;mode=$mode&amp;confirm=1'\">&nbsp;&nbsp;";
        echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_cancel";
        echo "&amp;where=list&amp;id=$id'\">";
	echo "</center><br /><br />";
    } elseif ($mode == 3 && $confirm == 0) {
        echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_table_delete&amp;id=$id";
        echo "&amp;thid=$thid&amp;mode=$mode&amp;confirm=1'\">&nbsp;&nbsp;";
        echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_cancel";
        echo "&amp;where=list&amp;id=$id'\">";
	echo "</center><br /><br />";
    }	
	ns_dl_CloseTable();
	ns_edl_linkbar("table", "$id");
        ns_edl_bottom();
	}
    }
}



function ns_edl_theme_uninstall($id, $name, $confirm = 0) {
    global $prefix, $db, $admin_file;
    if ($confirm == 1) {
	$db->$db->sql_query("delete from ".$prefix."_ns_downloads_theme where id='$id'");
	$db->$db->sql_query("delete from ".$prefix."_ns_downloads_theme_mode where id='$id'");
	$db->$db->sql_query("delete from ".$prefix."_ns_downloads_table_form where id='$id'");
	$db->$db->sql_query("delete from ".$prefix."_ns_downloads_table_html where id='$id'");
	Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    } else {
        $result = $db->sql_query("select id, name from ".$prefix."_ns_downloads_theme where id='$id'");
	list($id, $name) = $db->sql_numrows($result);
    	if ($id == "") {
        Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    	} else {
        ns_edl_top("uninstall");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
	echo "<center><br /><br />";
	echo "<strong>"._NSDLSUREREMTH." <font color=\"#CC0000\">$name</font>?</strong><br />";
	echo "<br />"._NSDLSUREREMTH2."<br />";	
	echo "<br /><br />";
        echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_theme_uninstall";
        echo "&amp;id=$id&amp;confirm=1'\">&nbsp;&nbsp;";
        echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
        echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_cancel";
        echo "&amp;where=theme&amp;id=$id'\">";
	echo "</center><br /><br />";
	ns_dl_CloseTable();
        ns_edl_linkbar("table", "$id");
	ns_edl_bottom();
	}
    }
}



function ns_edl_table_activate($tid, $thid, $id, $act, $mode) {
global $prefix, $db, $admin_file;
    if ($mode == 2) {
$result = $db->sql_query("update ".$prefix."_ns_downloads_table_form set act='0' where act='1' && id='$id'");	
$result2 = $db->sql_query("update ".$prefix."_ns_downloads_table_form set act='1' where tid='$tid' && id='$id'");
ns_debug("result");
ns_debug("result2");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    } elseif ($mode == 3) {
$result3 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set act='0' where act='1' && id='$id'");	
$result4 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set act='1' where thid='$thid' && id='$id'");
ns_debug("result3");
ns_debug("result4");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    }
}



function ns_edl_table_deactivate($tid, $thid, $id, $act, $mode) {
global $prefix, $db, $admin_file;
    if ($mode == 2) {
$result = $db->sql_query("update ".$prefix."_ns_downloads_table_form set act='0' where tid='$tid' && id='$id'");
ns_debug("result");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    } elseif ($mode == 3) {
$result2 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set act='0' where thid='$thid' && id='$id'");
ns_debug("result2");
Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    }
}



function ns_edl_table_save($id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $act, $html_open, $html_close, $mode) {
global $prefix, $db, $admin_file;
    if ($mode == 2) {
    	if ($bdrclr != "") {
    	    $bdrclr = stripslashes(FixQuotes($bdrclr));
            if (substr($bdrclr,0,1) != "#") { 
    	        $bdrclr = "#" . $bdrclr;
            }    	    
    	}
    	if ($trclr != "") {
    	    $trclr = stripslashes(FixQuotes($trclr));
            if (substr($trclr,0,1) != "#") { 
    	        $trclr = "#" . $trclr;
            }
    	}
    	if ($tdclr != "") {
    	    $tdclr = stripslashes(FixQuotes($tdclr));
            if (substr($tdclr,0,1) != "#") { 
    	        $tdclr = "#" . $tdclr;
            }
    	}
    	if ($bgclr != "") {
    	    $bgclr = stripslashes(FixQuotes($bgclr));
            if (substr($bgclr,0,1) != "#") { 
    	        $bgclr = "#" . $bgclr;
            }
    	}
    	if ($bgimg != "") {
    	    $bgimg = stripslashes(FixQuotes($bgimg));
    	}
    if ($act == 1) {
    $result = $db->sql_query("update ".$prefix."_ns_downloads_table_form set act='0' where act='1' && id='$id'");
    ns_debug("result");    	
    }	
    $result2 = $db->sql_query("insert into ".$prefix."_ns_downloads_table_form values (NULL,'$id', '$width', '$cpad', '$cspace', '$align', '$bdr', '$bdrclr', '$trclr', '$tdclr', '$bgclr', '$bgimg', '$act')");
    ns_debug("result2");
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#list");
    } elseif ($mode == 3) {
    $html_open = addslashes($html_open);
    $html_close = addslashes($html_close);
    if ($act == 1) {
    $result3 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set act='0' where act='1' && id='$id'");
    ns_debug("result3");    	
    }
    $result4 = $db->sql_query("insert into ".$prefix."_ns_downloads_table_html values (NULL,'$id', '$html_open', '$html_close', '$act')");
    ns_debug("result4");
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#list");
    }	
}



function ns_edl_cancel($where, $id) {
global $prefix, $db, $admin_file;
    if ($where == "edit") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    }
    if ($where == "delete") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    }
    if ($where == "theme") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme#theme");
    }
    if ($where == "list") {
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#mode");
    }
}



function ns_edl_table_edit($tid, $thid, $id, $name, $mode, $act) {
    global $prefix, $db, $admin_file;
    ns_edl_top("edit");
if ($mode == 2) { 
    $result2 = $db->sql_query("select width, cpad, cspace, align, bdr, bdrclr, trclr, tdclr, bgclr, bgimg from ".$prefix."_ns_downloads_table_form where tid='$tid' AND id='$id'");
    list($width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg) = $db->sql_numrows($result2);   	 
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php\" name=\"tabledesign\" method=\"post\"><br />";    
    echo "<table align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
    echo "<tr><td align=\"center\" valign=\"top\">";
    echo "<table widht=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTOM."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_structure", "300", "400", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    if ($width == "10") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "20") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "30") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "40") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "50") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "60") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "selected";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "70") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "selected";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "80") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "selected";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "90") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "selected";
	$sel10 = "";
    } elseif ($width == "100") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "selected";
    } 
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBWIDTH.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<select name=\"width\">";
    echo "<option value=\"10\" $sel1>10%</option>";
    echo "<option value=\"20\" $sel2>20%</option>";
    echo "<option value=\"30\" $sel3>30%</option>";
    echo "<option value=\"40\" $sel4>40%</option>";
    echo "<option value=\"50\" $sel5>50%</option>";
    echo "<option value=\"60\" $sel6>60%</option>";
    echo "<option value=\"70\" $sel7>70%</option>";
    echo "<option value=\"80\" $sel8>80%</option>";
    echo "<option value=\"90\" $sel9>90%</option>";
    echo "<option value=\"100\" $sel10>100%</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLPADD.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cpad\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cpad\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLSPACE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cspace\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cspace\">";
    echo "</td></tr>";
 if ($align == "1") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
    } elseif ($align == "2") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
    } elseif ($align == "3") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
    }
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBALIGN.": </td>";
    echo "<td align=\"left\" width=\"50%\"><select name=\"align\">";
    echo "<option value=\"1\" $sel1>"._NSDLTBALIGNL."</option>";
    echo "<option value=\"2\" $sel2>"._NSDLTBALIGNC."</option>";
    echo "<option value=\"3\" $sel3>"._NSDLTBALIGNR."</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBBORDER.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"bdr\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$bdr\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td><td width=\"60%\" valign=\"top\">";
    echo "<table width=\"100%\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<strong>"._NSDLTBCOLORSET."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_color", "300", "350", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    	if ($bdrclr != "") {
            if (substr($bdrclr,0,1) == "#") { 
            $bdrclr = substr($bdrclr,1);
            } 		
        }
    	if ($trclr != "") {
            if (substr($trclr,0,1) == "#") { 
            $trclr = substr($trclr,1);
            } 		
        }
    	if ($tdclr != "") {
            if (substr($tdclr,0,1) == "#") { 
            $tdclr = substr($tdclr,1);
            } 		
        }
    	if ($bgclr != "") {
            if (substr($bgclr,0,1) == "#") { 
            $bgclr = substr($bgclr,1);
            } 		
        }
    echo "<script language=\"JavaScript\">\n";
    echo "function newWindow(file,window) {\n";
    echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
    echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
    echo "}\n";
    echo "</script>\n";    
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBORDERCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bdrclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bdrclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bdrclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTRCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"trclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$trclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=trclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTDCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"tdclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$tdclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tdclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bgclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bgclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGIMG.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgimg\" ";
    echo "size=\"20\" maxlength=\"100\" value=\"$bgimg\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";
	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"list\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_premodify\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_modify\">"._NSDLBEDIT."</option>";
    echo "<option value=\"ns_edl_table_delete\">"._NSDLBDELETE."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();
} elseif ($mode == 3) {
    $result3 = $db->sql_query("select html_open, html_close, act from ".$prefix."_ns_downloads_table_html where thid='$thid' AND id='$id'");
    list($html_open, $html_close, $act) = $db->sql_numrows($result3);
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php\" method=\"post\"><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\"><strong>"._NSDLTBCUSTHTML."</strong>";
    ns_edl_help(""._NSDLTBCUSTHTML."", "tb_html", "350", "450", "$id");
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLOPEN."</strong>";
    echo "</td></tr>";  
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_open\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_open)."";
    echo "</textarea>";
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLCLOSE."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_close\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_close)."";
    echo "</textarea>";
    echo "<br /></td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>"; 
  	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {	
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>"; 
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"thid\" value=\"$thid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"3\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"edit\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_premodify\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_modify\">"._NSDLBEDIT."</option>";
    echo "<option value=\"ns_edl_table_delete\">"._NSDLBDELETE."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();    
}
    ns_edl_linkbar("table", "$id");    
    ns_edl_bottom();
}



function ns_edl_table_preview($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode, $act) {
    global $prefix, $db, $admin_file;
    ns_edl_top("preview");
if ($mode == 2) {	
    echo "<script language=\"JavaScript\">\n";
    echo "function previewtable(){\n";
    echo "window.open(\"".$admin_file.".php?op=ns_edl_table_preview_view";
    echo "&amp;width=$width&amp;cpad=$cpad&amp;cspace=$cspace";
    echo "&amp;align=$align&amp;bdr=$bdr&amp;bdrclr=$bdrclr";
    echo "&amp;trclr=$trclr&amp;tdclr=$tdclr&amp;bgclr=$bgclr";
    echo "&amp;bgimg=$bgimg&amp;mode=$mode&amp;name=$name\",\"\",\"height=400,";
    echo "width=550,location=no,menubar=no,resizable=no,scrollbars=no,";
    echo "status=no,titlebar=yes,toolbar=no,directories=no\");\n";
    echo "}\n";
    echo "previewtable();\n";
    echo "</script>\n";
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php#preview\" name=\"tabledesign\" method=\"post\"><br />";    
    echo "<table align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
    echo "<tr><td align=\"center\" valign=\"top\">";
    echo "<table widht=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTOM."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_structure", "300", "400", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    if ($width == "10") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "20") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "30") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "40") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "50") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "60") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "selected";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "70") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "selected";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "80") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "selected";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "90") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "selected";
	$sel10 = "";
    } elseif ($width == "100") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "selected";
    } 
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBWIDTH.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<select name=\"width\">";
    echo "<option value=\"10\" $sel1>10%</option>";
    echo "<option value=\"20\" $sel2>20%</option>";
    echo "<option value=\"30\" $sel3>30%</option>";
    echo "<option value=\"40\" $sel4>40%</option>";
    echo "<option value=\"50\" $sel5>50%</option>";
    echo "<option value=\"60\" $sel6>60%</option>";
    echo "<option value=\"70\" $sel7>70%</option>";
    echo "<option value=\"80\" $sel8>80%</option>";
    echo "<option value=\"90\" $sel9>90%</option>";
    echo "<option value=\"100\" $sel10>100%</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLPADD.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cpad\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cpad\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLSPACE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cspace\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cspace\">";
    echo "</td></tr>";
    if ($align == "1") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
    } elseif ($align == "2") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
    } elseif ($align == "3") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
    }
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBALIGN.": </td>";
    echo "<td align=\"left\" width=\"50%\"><select name=\"align\">";
    echo "<option value=\"1\" $sel1>"._NSDLTBALIGNL."</option>";
    echo "<option value=\"2\" $sel2>"._NSDLTBALIGNC."</option>";
    echo "<option value=\"3\" $sel3>"._NSDLTBALIGNR."</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBBORDER.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"bdr\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$bdr\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td><td width=\"60%\" valign=\"top\">";
    echo "<table width=\"100%\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<strong>"._NSDLTBCOLORSET."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_color", "300", "350", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    	if ($bdrclr != "") {
            if (substr($bdrclr,0,1) == "#") { 
            $bdrclr = substr($bdrclr,1);
            } 		
        }
    	if ($trclr != "") {
            if (substr($trclr,0,1) == "#") { 
            $trclr = substr($trclr,1);
            } 		
        }
    	if ($tdclr != "") {
            if (substr($tdclr,0,1) == "#") { 
            $tdclr = substr($tdclr,1);
            } 		
        }
    	if ($bgclr != "") {
            if (substr($bgclr,0,1) == "#") { 
            $bgclr = substr($bgclr,1);
            } 		
        }
    echo "<script language=\"JavaScript\">\n";
    echo "function newWindow(file,window) {\n";
    echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
    echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
    echo "}\n";
    echo "</script>\n";    
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBORDERCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bdrclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bdrclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bdrclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTRCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"trclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$trclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=trclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTDCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"tdclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$tdclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tdclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bgclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bgclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGIMG.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgimg\" ";
    echo "size=\"20\" maxlength=\"100\" value=\"$bgimg\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";
	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"list\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_preview\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_save\">"._NSDLBADDTB."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();
    
    
     
} elseif ($mode == 3) {


//$html_open = htmlspecialchars(stripslashes($html_open), ENT_QUOTES);
//$html_close = htmlspecialchars(stripslashes($html_close), ENT_QUOTES);

//$html_open = str_replace(" ", "+", $html_open);
//$html_close = str_replace(" ", "+", $html_close);



    $html_open = urlencode($html_open);
    $html_close = urlencode($html_close);   


    echo "<script language=\"JavaScript\">\n";
    echo "function previewtable2(){\n";
    echo "window.open(\"".$admin_file.".php?op=ns_edl_table_preview_view";
    echo "&amp;html_open=$html_open&amp;html_close=$html_close";
    echo "&amp;mode=$mode&amp;name=$name\",\"\",\"height=400,";
    echo "width=550,location=no,menubar=no,resizable=no,scrollbars=no,";
    echo "status=no,titlebar=yes,toolbar=no,directories=no\");\n";
    echo "}\n";
    echo "previewtable2();\n";
    echo "</script>\n";


    $html_open = urldecode($html_open);
    $html_close = urldecode($html_close);


    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php#preview\" method=\"post\"><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\"><strong>"._NSDLTBCUSTHTML."</strong>";
    ns_edl_help(""._NSDLTBCUSTHTML."", "tb_html", "350", "450", "$id");
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLOPEN."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_open\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_open)."";
    echo "</textarea><br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLCLOSE."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_close\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_close)."";
    echo "</textarea><br /></td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";  
  	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"thid\" value=\"$thid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"3\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"edit\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_preview\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_save\">"._NSDLBADDTB."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();        
}
    ns_edl_linkbar("table", "$id");    
    ns_edl_bottom();
}






function ns_edl_table_preview_view($width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode) {
global $prefix, $db, $nukeurl;
if ($mode == 2) {
	if ($cpad == "") {
	    $cpad = " cellpadding=\"0\"";
	} else {
	    $cpad = " cellpadding=\"$cpad\"";
	}	
	if ($cspace == "") { 
	    $cspace = " cellspacing=\"0\"";
	} else { 
	    $cspace = " cellspacing=\"$cspace\""; 
	}
	if ($align == "1") {
	    $palign = "left";
	} elseif ($align == "2") {
	    $palign = "center";
	} elseif ($align == "3") {
	    $palign = "right";
	} 
	if ($bdr != "") { 
	    $bdr = " border=\"$bdr\"";
	} else { 
	    $bdr = ""; 
	}
	if ($bdrclr != "") { 
	    $bdrclr = " bordercolor=\"$bdrclr\"";
	} else { 
	    $bdrclr = ""; 
	}
	if ($trclr != "") { 
	    $trclr = " bgcolor=\"$trclr\"";
	} else { 
	    $trclr = ""; 
	}
	if ($tdclr != "") { 
	    $tdclr = " bgcolor=\"$tdclr\"";
	} else { 
	    $tdclr = ""; 
	}
	if ($bgclr != "") { 
	    $bgclr = " bgcolor=\"$bgclr\"";
	} else { 
	    $bgclr = ""; 
	}
	if ($bgimg != "") { 
	    $bgimg = " background=\"themes/$name/images/$bgimg\"";
	} else { 
	    $bgimg = ""; 
	}
    echo "<html>";
    echo "<head>";
    echo "<title>"._NSDLTABLETITLE."</title>";
    echo "<link rel=\"stylesheet\" href=\"$nukeurl/themes/$name/style/style.css\" ";
    echo "type=\"text/css\">";
    echo "</head>";
    echo "<body>";
    echo "<table width=\"90%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td height=\"300\" valign=\"top\">";
    echo "<table align=\"$palign\" width=\"$width%\" $cpad$cspace$bdr$bdrclr$bgclr$bgimg>"; 
    echo "<tr$trclr><td$tdclr>";
    ns_edl_test_content();
    echo "</td></tr>";
    echo "</table><br />";
    echo "</td></tr><tr><td valign=\"top\">";
    echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" valign=\"baseline\">\n";
    echo "<input type=\"button\" value=\""._NSDLCLOSEVIEW."\" onclick=\"window.close()\">";
    echo "</td></tr></table>";
    echo "</td></tr></table>";
    echo "</body></html>";
    
    
} elseif ($mode == 3) {

    $html_open = urldecode($html_open);
    $html_close = urldecode($html_close);

    $html_open = stripslashes($html_open);
    $html_close = stripslashes($html_close);

    echo "<html>";
    echo "<head>";
    echo "<title>"._NSDLTABLETITLE."</title>";
    echo "<link rel=\"stylesheet\" href=\"$nukeurl/themes/$name/style/style.css\" ";
    echo "type=\"text/css\">";
    echo "</head>";
    echo "<body>";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td height=\"300\" valign=\"top\">";
    echo "$html_open";
    ns_edl_test_content();
    echo "$html_close";
    echo "</td></tr><tr><td valign=\"bottom\">";
    echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" valign=\"baseline\">\n";
    echo "<input type=\"button\" value=\""._NSDLCLOSEVIEW."\" onclick=\"window.close()\">";
    echo "</td></tr></table>";
    echo "</td></tr></table>";
    echo "</body></html>";
    }
}



function ns_edl_table_premodify($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode, $act) {
    global $prefix, $db, $admin_file;
    ns_edl_top("premodify");
if ($mode == 2) {
    echo "<script language=\"JavaScript\">\n";
    echo "function previewtable(){\n";
    echo "window.open(\"".$admin_file.".php?op=ns_edl_table_preview_view";
    echo "&amp;width=$width&amp;cpad=$cpad&amp;cspace=$cspace";
    echo "&amp;align=$align&amp;bdr=$bdr&amp;bdrclr=$bdrclr";
    echo "&amp;trclr=$trclr&amp;tdclr=$tdclr&amp;bgclr=$bgclr";
    echo "&amp;bgimg=$bgimg&amp;name=$name&amp;mode=$mode\",\"\",\"height=400,";
    echo "width=550,location=no,menubar=no,resizable=no,scrollbars=no,";
    echo "status=no,titlebar=yes,toolbar=no,directories=no\");\n";
    echo "}\n";
    echo "previewtable();\n";
    echo "</script>\n";
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php#premodify\" name=\"tabledesign\" method=\"post\"><br />";    
    echo "<table align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
    echo "<tr><td align=\"center\" valign=\"top\">";
    echo "<table widht=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTOM."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_structure", "300", "400", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    if ($width == "10") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "20") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "30") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "40") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "50") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "60") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "selected";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "70") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "selected";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "80") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "selected";
	$sel9 = "";
	$sel10 = "";
    } elseif ($width == "90") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "selected";
	$sel10 = "";
    } elseif ($width == "100") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
	$sel9 = "";
	$sel10 = "selected";
    } 
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBWIDTH.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<select name=\"width\">";
    echo "<option value=\"10\" $sel1>10%</option>";
    echo "<option value=\"20\" $sel2>20%</option>";
    echo "<option value=\"30\" $sel3>30%</option>";
    echo "<option value=\"40\" $sel4>40%</option>";
    echo "<option value=\"50\" $sel5>50%</option>";
    echo "<option value=\"60\" $sel6>60%</option>";
    echo "<option value=\"70\" $sel7>70%</option>";
    echo "<option value=\"80\" $sel8>80%</option>";
    echo "<option value=\"90\" $sel9>90%</option>";
    echo "<option value=\"100\" $sel10>100%</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLPADD.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cpad\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cpad\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBCELLSPACE.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"cspace\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$cspace\">";
    echo "</td></tr>";
    if ($align == "1") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
    } elseif ($align == "2") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
    } elseif ($align == "3") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
    }
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBALIGN.": </td>";
    echo "<td align=\"left\" width=\"50%\"><select name=\"align\">";
    echo "<option value=\"1\" $sel1>"._NSDLTBALIGNL."</option>";
    echo "<option value=\"2\" $sel2>"._NSDLTBALIGNC."</option>";
    echo "<option value=\"3\" $sel3>"._NSDLTBALIGNR."</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSDLTBBORDER.": </td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"text\" name=\"bdr\" ";
    echo "size=\"3\" maxlength=\"2\" value=\"$bdr\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td><td width=\"60%\" valign=\"top\">";
    echo "<table width=\"100%\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<strong>"._NSDLTBCOLORSET."</strong>";
    ns_edl_help(""._NSDLTBACTIVE."", "tb_color", "300", "350", "$id");
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
    	if ($bdrclr != "") {
            if (substr($bdrclr,0,1) == "#") { 
            $bdrclr = substr($bdrclr,1);
            } 		
        }
    	if ($trclr != "") {
            if (substr($trclr,0,1) == "#") { 
            $trclr = substr($trclr,1);
            } 		
        }
    	if ($tdclr != "") {
            if (substr($tdclr,0,1) == "#") { 
            $tdclr = substr($tdclr,1);
            } 		
        }
    	if ($bgclr != "") {
            if (substr($bgclr,0,1) == "#") { 
            $bgclr = substr($bgclr,1);
            } 		
        }
    echo "<script language=\"JavaScript\">\n";
    echo "function newWindow(file,window) {\n";
    echo "msgWindow=open(file,window,'resizable=no,width=250,height=500,top=100,left=400');\n";
    echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
    echo "}\n";
    echo "</script>\n";    
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBORDERCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bdrclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bdrclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bdrclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTRCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"trclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$trclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=trclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBTDCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"tdclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$tdclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=tdclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGCLR.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgclr\" ";
    echo "size=\"7\" maxlength=\"6\" value=\"$bgclr\">&nbsp;";
    echo "<input type=\"button\" value=\" C \" onClick=\"newWindow";
    echo "('".$admin_file.".php?op=ns_edl_load_color&amp;field=bgclr','window2')\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"30%\">"._NSDLTBBGIMG.": </td>";
    echo "<td align=\"left\" width=\"70%\">";
    echo "<input type=\"text\" name=\"bgimg\" ";
    echo "size=\"20\" maxlength=\"100\" value=\"$bgimg\">";
    echo "</td></tr>";
    echo "</table>";
    echo "</td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";
	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"tid\" value=\"$tid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"name\" value=\"$name\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"list\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_premodify\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_modify\">"._NSDLBEDIT."</option>";
    echo "<option value=\"ns_edl_table_delete\">"._NSDLBDELETE."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();
} elseif ($mode == 3) {
    $html_open = stripslashes($html_open);
    $html_close = stripslashes($html_close);
    ns_dl_OpenTable();
    echo "<br /><center><font class=\"title\">"._NSDLTBPREVIEWTABLE."</font>";
    ns_edl_help(""._NSDLTBPREVIEWTABLE2."", "tb_preview", "300", "200", "$id");
    echo "</center><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\" ";
    echo "border=\"0\">";
    echo "<tr><td valign=\"top\" bgcolor=\"#FFFFFF\"><br /><br />";
    echo "$html_open<br />";
    ns_edl_test_content();
    echo "$html_close";
    echo "<br /><br /></td></tr></table><br /><br />";
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLTABLESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=\"".$admin_file.".php#premodify\" method=\"post\"><br />";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" colspan=\"2\"><strong>"._NSDLTBCUSTHTML."</strong>";
    ns_edl_help(""._NSDLTBCUSTHTML."", "tb_html", "350", "450", "$id");
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLOPEN."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_open\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_open)."";
    echo "</textarea>";
    echo "<br /><br /></td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<strong>"._NSDLTBCUSTHTMLCLOSE."</strong>";
    echo "</td></tr>";
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<textarea name=\"html_close\" cols=\"120\" rows=\"30\">";
    echo "".stripslashes($html_close)."";
    echo "</textarea>";
    echo "<br /></td></tr>";
    echo "<tr><td colspan=\"2\"><br /><br /></td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<font class=\"title\">"._NSDLACTTABLE."</font>";
    echo "</td></tr>";  
  	if ($act == 1) {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\" checked>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\">";
    echo "</td></tr>";
	} else {
    echo "<tr><td align=\"right\" width=\"50%\">"._NSYES.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"1\">";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"50%\">"._NSNO.":</td>";
    echo "<td align=\"left\" width=\"50%\">";
    echo "<input type=\"radio\" name=\"act\" value=\"0\" checked>";
    echo "</td></tr>";
	}
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";    
    echo "<tr><td align=\"center\" colspan=\"2\">";
    echo "<input type=\"hidden\" name=\"thid\" value=\"$thid\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
    echo "<input type=\"hidden\" name=\"mode\" value=\"3\">";
    echo "<input type=\"hidden\" name=\"where\" value=\"edit\">";
    echo "<select name=\"op\">";
    echo "<option value=\"ns_edl_table_premodify\" selected>"._NSDLPREVTB."</option>";
    echo "<option value=\"ns_edl_table_modify\">"._NSDLBEDIT."</option>";
    echo "<option value=\"ns_edl_table_delete\">"._NSDLBDELETE."</option>";
    echo "<option value=\"ns_edl_cancel\">"._NSDLCANCEL."</option>";
    echo "</select>&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"submit\" value=\""._NSDLBGO."\">";
    echo "</td></tr>";
    echo "</table><br />";
    echo "</form>";
    ns_dl_CloseTable();        
}
    ns_edl_linkbar("table", "$id");    
    ns_edl_bottom();
}



function ns_edl_table_view($tid, $thid, $id, $name, $mode, $act) {
    global $prefix, $db, $nukeurl, $admin_file;
if ($mode == 2) {
    $result2 = $db->sql_query("select width, cpad, cspace, align, bdr, bdrclr, trclr, tdclr, bgclr, bgimg from ".$prefix."_ns_downloads_table_form where tid='$tid' AND id='$id'");
    list($width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg) = $db->sql_numrows($result2);
	if ($cpad == "") {
	    $cpad = " cellpadding=\"0\"";
	} else {
	    $cpad = " cellpadding=\"$cpad\"";
	}	
	if ($cspace == "") { 
	    $cspace = " cellspacing=\"0\"";
	} else { 
	    $cspace = " cellspacing=\"$cspace\""; 
	}
	if ($align == "1") {
	    $align = "left";
	} elseif ($align == "2") {
	    $align = "center";
	} elseif ($align == "3") {
	    $align = "right";
	} 
	if ($bdr != "") { 
	    $bdr = " border=\"$bdr\"";
	} else { 
	    $bdr = ""; 
	}
	if ($bdrclr != "") { 
	    $bdrclr = " bordercolor=\"$bdrclr\"";
	} else { 
	    $bdrclr = ""; 
	}
	if ($trclr != "") { 
	    $trclr = " bgcolor=\"$trclr\"";
	} else { 
	    $trclr = ""; 
	}
	if ($tdclr != "") { 
	    $tdclr = " bgcolor=\"$tdclr\"";
	} else { 
	    $tdclr = ""; 
	}
	if ($bgclr != "") { 
	    $bgclr = " bgcolor=\"$bgclr\"";
	} else { 
	    $bgclr = ""; 
	}
	if ($bgimg != "") { 
	    $bgimg = " background=\"themes/$name/images/$bgimg\"";
	} else { 
	    $bgimg = ""; 
	}
    echo "<html>";
    echo "<head>";
    echo "<title>"._NSDLTABLETITLE."</title>";
    echo "<link rel=\"stylesheet\" href=\"$nukeurl/themes/$name/style/style.css\" ";
    echo "type=\"text/css\">";
    echo "</head>";
    echo "<body>";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td height=\"300\" valign=\"top\">";
    
    
  //  ns_dl_OpenTable();
    
    echo "<table align=\"$align\" width=\"$width%\" $cpad$cspace$bdr$bdrclr$bgclr$bgimg>"; 
    echo "<tr$trclr><td$tdclr>";
    ns_edl_test_content();
    echo "</td></tr>";
    echo "</table><br />";
    
   // ns_dl_CloseTable();
    
    echo "</td></tr></table>";
    
    
    //<tr><td valign=\"top\">";
    
        
    echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" valign=\"baseline\">\n";
    echo "<script Language=\"javascript\">\n";
    echo "function editClose()\n";
    echo "{\n";
    echo "opener.location.href=\"".$admin_file.".php?op=ns_edl_table_edit&amp;id=$id";
    echo "&amp;tid=$tid&amp;name=$name&amp;mode=$mode&amp;act=$act#edit\";\n";
    echo "window.close()\n";
    echo "}\n";
    echo "</script>\n";
    echo "<input type=\"button\" value=\""._NSDLTBEDIT."\" onClick=\"javascript:editClose()\">";
    echo "&nbsp;&nbsp;&nbsp;\n";
    echo "<script Language=\"javascript\">\n";
    echo "function deleteClose()\n";
    echo "{\n";
    echo "opener.location.href=\"".$admin_file.".php?op=ns_edl_table_delete&amp;id=$id";
    echo "&amp;tid=$tid&amp;name=$name&amp;mode=$mode&amp;act=$act#delete\";\n";
    echo "window.close()\n";
    echo "}\n";
    echo "</script>\n";
    echo "<input type=\"button\" value=\""._NSDLTBDELETE."\" onClick=\"javascript:deleteClose()\">";
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSDLCLOSEVIEW."\" onclick=\"window.close()\">";
    echo "</td></tr></table>";
    
    
//    echo "</td></tr></table>";
    echo "</body></html>"; 
    
    
       
} elseif ($mode == 3) {
    $result3 = $db->sql_query("select html_open, html_close from ".$prefix."_ns_downloads_table_html where thid='$thid' AND id='$id'");
    list($html_open, $html_close) = $db->sql_numrows($result3);
    $html_open = stripslashes($html_open);
    $html_close = stripslashes($html_close);
    echo "<html>";
    echo "<head>";
    echo "<title>"._NSDLTABLETITLE."</title>";
    echo "<link rel=\"stylesheet\" href=\"$nukeurl/themes/$name/style/style.css\" ";
    echo "type=\"text/css\">";
    echo "</head>";
    echo "<body>";
    echo "<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td height=\"300\" valign=\"top\">";
    echo "$html_open";
    ns_edl_test_content();
    echo "$html_close";    
    echo "</td></tr><tr><td valign=\"bottom\">"; 
    echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"center\" valign=\"baseline\">\n";
    echo "<script Language=\"javascript\">\n";
    echo "function editClose()\n";
    echo "{\n";
    echo "opener.location.href=\"".$admin_file.".php?op=ns_edl_table_edit&amp;id=$id";
    echo "&amp;tid=$tid&amp;name=$name&amp;mode=$mode&amp;act=$act#edit\";\n";
    echo "window.close()\n";
    echo "}\n";
    echo "</script>\n";
    echo "<input type=\"button\" value=\""._NSDLTBEDIT."\" onClick=\"javascript:editClose()\">";
    echo "&nbsp;&nbsp;&nbsp;\n";
    echo "<script Language=\"javascript\">\n";
    echo "function deleteClose()\n";
    echo "{\n";
    echo "opener.location.href=\"".$admin_file.".php?op=ns_edl_table_delete&amp;id=$id";
    echo "&amp;tid=$tid&amp;name=$name&amp;mode=$mode&amp;act=$act#delete\";\n";
    echo "window.close()\n";
    echo "}\n";
    echo "</script>\n";
    echo "<input type=\"button\" value=\""._NSDLTBDELETE."\" onClick=\"javascript:deleteClose()\">";
    echo "&nbsp;&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSDLCLOSEVIEW."\" onclick=\"window.close()\">";
    echo "</td></tr></table>";
    echo "</td></tr></table>";
    echo "</body></html>";
    }
}



function ns_edl_table_modify($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $act, $html_open, $html_close, $mode) {
global $prefix, $db, $admin_file;
    if ($mode == 2) {
    	if ($bdrclr != "") {
    	    $bdrclr = stripslashes(FixQuotes($bdrclr));
            if (substr($bdrclr,0,1) != "#") { 
    	        $bdrclr = "#" . $bdrclr;
            }    	    
    	}
    	if ($trclr != "") {
    	    $trclr = stripslashes(FixQuotes($trclr));
            if (substr($trclr,0,1) != "#") { 
    	        $trclr = "#" . $trclr;
            }
    	}
    	if ($tdclr != "") {
    	    $tdclr = stripslashes(FixQuotes($tdclr));
            if (substr($tdclr,0,1) != "#") { 
    	        $tdclr = "#" . $tdclr;
            }
    	}
    	if ($bgclr != "") {
    	    $bgclr = stripslashes(FixQuotes($bgclr));
            if (substr($bgclr,0,1) != "#") { 
    	        $bgclr = "#" . $bgclr;
            }
    	}
    	if ($bgimg != "") {
    	    $bgimg = stripslashes(FixQuotes($bgimg));
    	}
    if ($act == 1) {
    $result = $db->sql_query("update ".$prefix."_ns_downloads_table_form set act='0' where act='1' && id='$id'");
    ns_debug("result");    	
    }
    $result = $db->sql_query("update ".$prefix."_ns_downloads_table_form set width='$width', cpad='$cpad', cspace='$cspace', align='$align', bdr='$bdr', bdrclr='$bdrclr', trclr='$trclr', tdclr='$tdclr', bgclr='$bgclr', bgimg='$bgimg', act='$act' where tid='$tid' && id='$id'");
    ns_debug($result);
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#table");
    } elseif ($mode == 3) {
    if ($act == 1) {
    $result3 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set act='0' where act='1' && id='$id'");
    ns_debug("result3");    	
    }
    $html_open = addslashes($html_open);
    $html_close = addslashes($html_close);
    $result4 = $db->sql_query("update ".$prefix."_ns_downloads_table_html set html_open='$html_open', html_close='$html_close', act='$act' where thid='$thid' && id='$id'");
    ns_debug($result4);
    Header("Location: ".$admin_file.".php?op=ns_edl_theme_mode&id=$id#table");
    }	
}



switch($op) {

    case "ns_edl_table":
    ns_edl_table($id);
    break;

    case "ns_edl_table_activate":
    ns_edl_table_activate($tid, $thid, $id, $act, $mode);
    break;
    
    case "ns_edl_table_add":
    ns_edl_table_add($id, $mode);
    break;

    case "ns_edl_table_deactivate":
    ns_edl_table_deactivate($tid, $thid, $id, $act, $mode);
    break;

    case "ns_edl_table_delete":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#delete\">";
    ns_edl_table_delete($tid, $thid, $id, $mode, $confirm);
    break;

    case "ns_edl_table_edit":
    ns_edl_table_edit($tid, $thid, $id, $name, $mode, $act);
    break;

    case "ns_edl_table_list":
    ns_edl_table_list($id, $name, $mset, $mode);
    break;

    case "ns_edl_table_loaded":
    ns_edl_table_loaded();
    break;
    
    case "ns_edl_table_modify":
    ns_edl_table_modify($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $act, $html_open, $html_close, $mode);
    break;

    case "ns_edl_table_preview":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#preview\">";
    ns_edl_table_preview($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode, $act);
    break;
    
    case "ns_edl_table_preview_view":
    ns_edl_table_preview_view($width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode);
    break;
    
    case "ns_edl_table_premodify":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#premodify\">";
    ns_edl_table_premodify($tid, $thid, $id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $html_open, $html_close, $name, $mode, $act);
    break;
 
    case "ns_edl_table_save":        
    ns_edl_table_save($id, $width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg, $act, $html_open, $html_close, $mode);
    break;    

    case "ns_edl_table_view":
    ns_edl_table_view($tid, $thid, $id, $name, $mode, $act);
    break;
    
    case "ns_edl_theme":
    ns_edl_theme();
    break;    
    
    case "ns_edl_theme_install":
    ns_edl_theme_install($name);
    break;
    
    case "ns_edl_theme_load":
    ns_edl_theme_load($id);
    break;
    
    case "ns_edl_theme_mode":
    ns_edl_theme_mode($id, $mchange);
    break;    
    
    case "ns_edl_theme_save":
    ns_edl_theme_save($id, $mode, $mset);
    break;

    case "ns_edl_theme_uninstall":
    echo "<meta http-equiv=\"refresh\" content=\"0;url=#uninstall\">";
    ns_edl_theme_uninstall($id, $name, $confirm);
    break;
    
    case "ns_edl_theme_update":
    ns_edl_theme_update($id, $mode, $mset);
    break;
    
    case "ns_edl_cancel":
    ns_edl_cancel($where, $id);
    break;

    case "ns_edl_popup":
    ns_edl_popup($page);
    break;
    
    case "ns_edl_help":
    break;

    case "ns_edl_load_color":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_colorpick.php");
    break;

}



} else {
    echo "Access Denied";
}





?>