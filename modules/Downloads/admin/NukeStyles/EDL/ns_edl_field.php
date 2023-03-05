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


function ns_edl_field() {
global $prefix, $db, $admin_file;
ns_edl_top("field");
$result = $db->sql_query("SELECT ns_dl_field_vers, ns_dl_field_comp, ns_dl_field_file, ns_dl_field_date, ns_dl_field_hits, ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) = $db->sql_fetchrow($result);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\"><strong>"._NSDLFIELDSSETTINGS."</strong></font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><form action='".$admin_file.".php' method='post'>";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<font class=\"title\">"._NSDLCURPERMFIELDS."</font>";
ns_edl_help(""._NSDLCURPERMFIELDS."", "fld_perm", "250", "300", "$id");
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLVERSION."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_vers == 1) {
echo "<input type='radio' name='ns_dl_field_vers' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_vers' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_vers' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_vers' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLCOMPAT."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_comp == 1) {
echo "<input type='radio' name='ns_dl_field_comp' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_comp' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_comp' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_comp' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLFFILESIZE."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_file == 1) {
echo "<input type='radio' name='ns_dl_field_file' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_file' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_file' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_file' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLADDEDON."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_date == 1) {
echo "<input type='radio' name='ns_dl_field_date' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_date' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_date' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_date' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLHITS."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_hits == 1) {
echo "<input type='radio' name='ns_dl_field_hits' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_hits' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_hits' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_hits' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td align=\"right\" width=\"40%\">"._NSDLRATING."</td>";
echo "<td align=\"left\" width=\"60%\">";
	if ($ns_dl_field_rate == 1) {
echo "<input type='radio' name='ns_dl_field_rate' value='1' checked> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_rate' value='0'> ";
echo ""._NSDLDISABLED."";
	} else {
echo "<input type='radio' name='ns_dl_field_rate' value='1'> ";
echo ""._NSDLENABLED." &nbsp;";
echo "<input type='radio' name='ns_dl_field_rate' value='0' checked> ";
echo ""._NSDLDISABLED."";
	}
echo "</td></tr>";
echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<input type='hidden' name='op' value='ns_edl_field_save'>";
echo "<input type='submit' name=\"submit\" value='Save Changes'>";
echo "</td></tr>";
echo "</table><br />";
echo "</form>";
ns_dl_CloseTable();


ns_dl_OpenTable();
echo "";
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td width=\"90%\">";
echo "<div align=\"justify\">"._NSDLFLCOMING."</div>";
echo "</td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
//ns_edl_field_new();
ns_edl_bottom(); 
}


/*
function ns_edl_field_new() {
global $prefix, $db, $bgcolor2, $admin_file;	
echo "<a name=\"new\">";
ns_dl_OpenTable();
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"title\">"._NSDLCURNEWFIELDS."</font>";
ns_edl_help(""._NSDLCURNEWFIELDS."", "fld_new", "250", "300", "$id");
echo "</td></tr>";
echo "</table><br />";
$result = $db->sql_query("SELECT fid, fname from ".$prefix."_ns_downloads_field");
$num_fields = $db->sql_numrows($result);
echo "<table width=\"70%\" align=\"center\" cellpadding=\"7\" ";
echo "cellspacing=\"4\" border=\"0\">";
    if ($num_fields < 1) {
    echo "<tr><td align=\"center\">";
    echo "<br /><font class=\"content\"><strong>"._NSDLNONEWFIELDS."</strong></font><br />";
    echo "</td></tr>";
    } else {
	while(list($fid, $fname) = $db->sql_fetchrow($result)) {
        $nfname = preg_replace("/_/"," ",$fname);	
	echo "<tr bgcolor=\"$bgcolor2\"><td align=\"left\" width=\"80%\">";
	echo "<font class=\"content\"><strong>$nfname</strong></font>";
	echo "</td>";
	echo "<td align=\"center\">";
	echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" onClick=\"window.location ";
	echo "= '".$admin_file.".php?op=ns_edl_field_edit&amp;fid=$fid#edit'\">";
	echo "&nbsp;&nbsp;";
	echo "<input type=\"button\" value=\""._NSDLTDELETE."\" onClick=\"window.location ";
	echo "= '".$admin_file.".php?op=ns_edl_field_delete&amp;fid=$fid&amp;fname=$fname&amp;confirm=0#delete'\">";
	echo "</td></tr>";
	}
    }
echo "</table><br /><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLBADDFIELD."\" title=\""._NSDLBADDFIELD."\" ";
echo "onClick=\"window.location = '".$admin_file.".php?op=ns_edl_field_add#add'\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr>";
echo "</table><br /><br />";
ns_dl_CloseTable();
}



function ns_edl_field_add() {
global $prefix, $db, $admin_file;
ns_edl_top("add");
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLFIELDSSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><form action='".$admin_file.".php' method='post'>";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"title\">"._NSDLADDNEWFIELD."</font></td></tr>";
echo "<tr><td align=\"center\">&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"text\" name=\"fname\" size=\"40\" maxlength=\"150\">";
echo "</td></tr>";
echo "<tr><td align=\"center\">&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_field_add_save\">";
echo "<input type=\"submit\" value=\""._NSDLBADDFIELD."\" title=\""._NSDLBADDFIELD."\">";
echo "</td></tr>";
echo "</table></form><br /><br />";
ns_dl_CloseTable();
ns_edl_bottom();
}

*/

function ns_edl_field_save($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_field_perm set ns_dl_field_vers='$ns_dl_field_vers', ns_dl_field_comp='$ns_dl_field_comp', ns_dl_field_file='$ns_dl_field_file', ns_dl_field_date='$ns_dl_field_date', ns_dl_field_hits='$ns_dl_field_hits', ns_dl_field_rate='$ns_dl_field_rate'");
Header("Location: ".$admin_file.".php?op=ns_edl_field#field");
}


/*
function ns_edl_field_edit($fid) {
global $prefix, $db, $admin_file;
ns_edl_top("edit");
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLFIELDSSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
$result = $db->sql_query("select fname from ".$prefix."_ns_downloads_field where fid='$fid'");
list($fname) = $db->sql_numrows($result);
$nfname = preg_replace("/_/"," ",$fname);
echo "<br /><form action='".$admin_file.".php' method='post'>";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td align=\"center\">";
echo "<font class=\"title\">"._NSDLEDITFIELD."</font></td></tr>";
echo "<tr><td align=\"center\">&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"text\" name=\"fname_new\" value=\"$nfname\" size=\"40\" maxlength=\"150\">";
echo "</td></tr>";
echo "<tr><td align=\"center\">&nbsp;</td></tr>";
echo "<tr><td align=\"center\">";
echo "<input type=\"hidden\" name=\"fid\" value=\"$fid\">";
echo "<input type=\"hidden\" name=\"fname_old\" value=\"$fname\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_edl_field_edit_save\">";
echo "<input type=\"submit\" value=\""._NSDLTBBEDIT."\" title=\""._NSDLTBBEDIT."\">";
echo "</td></tr>";
echo "</table></form><br /><br />";
ns_dl_CloseTable();
ns_edl_bottom();
}



function ns_edl_field_edit_save($fid, $fname_new, $fname_old) {
global $prefix, $db, $admin_file;
$fname_new = stripslashes(FixQuotes($fname_new));
    if ($fname_new != "") {
    $fname_new = preg_replace("/ /","_",$fname_new);
    $db->sql_query("update ".$prefix."_ns_downloads_field set fname='$fname_new' where fid='$fid'");
    $result_alter = my$db->$db->sql_query("alter table ".$prefix."_ns_downloads_field_new_".$fname_old." rename ".$prefix."_ns_downloads_field_new_".$fname_new."");
    if (!$result_alter) {
    	    print mysql_error();
	    die();
    }
    $result_alter2 = my$db->$db->sql_query("alter table ".$prefix."_ns_downloads_field_new_".$fname_new." change $fname_old $fname_new  varchar(255) DEFAULT '' NOT NULL");    
    if (!$result_alter2) {
    	    print mysql_error();
	    die();
    }
    Header("Location: ".$admin_file.".php?op=ns_edl_field#new");
    } else {
    Header("Location: ".$admin_file.".php?op=ns_edl_field_edit&fid=$fid#edit");
    }
}



function ns_edl_field_add_save($fname) {
global $prefix, $db, $admin_file;
$fname = stripslashes(FixQuotes($fname));
    if ($fname != "") {	
    $fname = preg_replace("/ /","_",$fname);    		
    $db->sql_query("insert into ".$prefix."_ns_downloads_field values (NULL, '$fname')");
    $result_delete = my$db->$db->sql_query("drop table if exists ".$prefix."_ns_downloads_field_new_".$fname."");
    if (!$result_delete) {
    	    print mysql_error();
	    die();
    }
    $result_create = my$db->$db->sql_query("create table ".$prefix."_ns_downloads_field_new_".$fname." (
      lid int(13) NOT NULL default '',
      ".$fname."_value varchar(255) DEFAULT '' NOT NULL
    )");
    if (!$result_create) {
    	    print mysql_error();
	    die();
    }
    Header("Location: ".$admin_file.".php?op=ns_edl_field#new");
    } else {
    Header("Location: ".$admin_file.".php?op=ns_edl_field_add#add");
    }
}



function ns_edl_field_delete($fid, $fname, $confirm = 0) {
global $prefix, $db, $admin_file;
if ($confirm == 1) {
    $db->sql_query("delete from ".$prefix."_ns_downloads_field where fid='$fid'");
    $result_delete = my$db->$db->sql_query("drop table if exists ".$prefix."_ns_downloads_field_new_".$fname."");
    if (!$result_delete) {
    	    print mysql_error();
	    die();
    }
    Header("Location: ".$admin_file.".php?op=ns_edl_field#new");
} else {
ns_edl_top("delete");
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLFIELDSSETTINGS."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<center><br /><br />";
echo "<strong>"._NSDLDELETEFIELD."</strong><br /><br />";
echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_field_delete";
echo "&amp;fid=$fid&amp;fname=$fname&amp;confirm=1'\">";
echo "&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_field#new'\">";
echo "</center><br /><br />";
ns_dl_CloseTable();
ns_edl_bottom();
    }
}

*/

switch($op) {

    case "ns_edl_field":
    ns_edl_field();
    break;

    case "ns_edl_field_save":
    ns_edl_field_save($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate);
    break;

    case "ns_edl_field_add":
    ns_edl_field_add();
    break;

    case "ns_edl_field_add_save":
    ns_edl_field_add_save($fname);
    break;

    case "ns_edl_field_edit":
    ns_edl_field_edit($fid);
    break;

    case "ns_edl_field_edit_save":
    ns_edl_field_edit_save($fid, $fname_new, $fname_old);
    break;

    case "ns_edl_field_delete":
    ns_edl_field_delete($fid, $fname, $confirm);
    break;

}



} else {
	
echo "Access Denied";

}



?>











