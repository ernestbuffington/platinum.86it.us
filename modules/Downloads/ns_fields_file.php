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
if (preg_match("/ns_fields_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");


function ns_dl_list_pfields($version, $ns_compat, $filesize, $datetime, $hits, $title, $transfertitle, $totalvotes, $votestring, $downloadratingsummary) {
global $prefix, $db, $module_name;
$result_perm = $db->sql_query("SELECT ns_dl_field_vers, ns_dl_field_comp, ns_dl_field_file, ns_dl_field_date, ns_dl_field_hits, ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file, $ns_dl_field_date, $ns_dl_field_hits, $ns_dl_field_rate) = $db->sql_fetchrow($result_perm);
    if ($ns_dl_field_vers == 1 && $version != "") {
    echo "<strong>"._VERSION.":</strong> $version<br />";
    }
    if ($ns_dl_field_comp == 1 && $ns_compat != "") {
    echo "<strong>"._NSCOMPAT.":</strong> $ns_compat<br />";
    }
    if ($ns_dl_field_file == 1 && $filesize != "" && $filesize != 0) {
    echo "<strong>"._FILESIZE.":</strong> ".CoolSize($filesize)."<br />";
    }
    if ($ns_dl_field_date == 1 && $datetime != "") {
    echo "<strong>"._ADDEDON.":</strong> $datetime<br />";
    }
    if ($ns_dl_field_hits == 1 && $hits != "") {
    echo "<strong>"._UDOWNLOADS.":</strong> $hits<br />";
    }
    $transfertitle = str_replace (" ", "_", $title);
        if ($totalvotes == 1) {
            $votestring = _VOTE;
        } else {
    	    $votestring = _VOTES;
        }
    if ($ns_dl_field_rate == 1) {
        if ($downloadratingsummary != "0" || $downloadratingsummary != "0.0") {
            echo " <strong>"._RATING.":</strong> $downloadratingsummary ($totalvotes $votestring)<br />";
        }
    }
}



function ns_dl_list_nfields($lid) {
global $prefix, $db, $module_name;
$result_new = $db->sql_query("select * from ".$prefix."_ns_downloads_field");
    while(list($fid, $fname) = $db->sql_fetchrow($result_new)) {
	$result_value = $db->sql_query("select ".$fname."_value from ".$prefix."_ns_downloads_field_new_".$fname." where lid='$lid'");
	list($fname_value) = $db->sql_fetchrow($result_value);
	$fname = preg_replace("/_/"," ",$fname);
	if ($fname_value != "") {
	echo "<strong>$fname:</strong> $fname_value<br />";
	}
    }
}



function ns_dl_add_pfields($ns_dl_add_filesize, $ns_dl_add_compat) {
global $prefix, $db;
$result_perm = $db->sql_query("SELECT ns_dl_field_vers, ns_dl_field_comp, ns_dl_field_file from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_vers, $ns_dl_field_comp, $ns_dl_field_file) = $db->sql_fetchrow($result_perm);
    if ($ns_dl_field_comp == 1) {
        echo "<tr><td align=\"left\"><strong>"._NSCOMPAT.":</strong> ";
	    if ($ns_dl_add_compat == 1) {
	        echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
	    }
        echo "<br /><input type=\"text\" name=\"ns_compat\" size=\"30\" maxlength=\"50\"></td></tr>";
    } else {
        echo "<input type=\"hidden\" name=\"ns_compat\" value=\"\">";	
    }
    if ($ns_dl_field_file == 1) {
        echo "<tr><td align=\"left\"><strong>"._FILESIZE.":</strong> ";
	    if ($ns_dl_add_filesize == 1) {
	        echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font> ";
	    }
        echo "<br /><input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\">";
        echo "<span style=\"vertical-align=30%\">";
        echo "<font class=\"tiny\">("._INBYTES.")</font></span></td></tr>";
    } else {
        echo "<input type=\"hidden\" name=\"filesize\" value=\"\">";	
    }
    if ($ns_dl_field_vers == 1) {
        echo "<tr><td align=\"left\"><strong>"._VERSION.":</strong><br />";
        echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\"></td></tr>";
    } else {
        echo "<input type=\"hidden\" name=\"version\" value=\"\">";	
    }
}


/*
function ns_dl_add_nfields() {
global $prefix, $db, $module_name;
$result_new = $db->sql_query("select * from ".$prefix."_ns_downloads_field");


    while(list($fid, $fname) = $db->sql_fetchrow($result_new)) {
    	
    	
	$result_value = $db->sql_query("select ".$fname."_value from ".$prefix."_ns_downloads_field_new_".$fname."");
	
	
	list($fname_value) = $db->sql_fetchrow($result_value);
	
	
	$fname = preg_replace("/_/"," ",$fname);
	$stufftopass[] = array ("Field1", "Value1");

	
        echo "<tr><td align=\"left\"><strong>$fname:</strong><br />";
        
        echo "<input type=\"text\" name=\"$fname_value\" size=\"30\" ";
        echo "maxlength=\"255\"></td></tr>";
        
        
        
    }
}


*/

?>