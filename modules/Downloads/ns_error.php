<?php
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
if (preg_match("/ns_error.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");  
require_once("mainfile.php");




function ns_dl_add_error($title, $url, $cat, $description, $email, $ns_compat, $filesize, $blocknow) {
    global $prefix, $db;
    $result_ad = $db->sql_query("SELECT ns_dl_add_email, ns_dl_add_filesize, ns_dl_add_compat from ".$prefix."_ns_downloads_add_modify");
    list($ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_add_compat) = $db->sql_fetchrow($result_ad);

// Check if Title exist
    if ($title == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo "<br /><br /><center><strong>"._DOWNLOADNOTITLE."</strong><br /><br /><br />"
	    .""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
    }
    
// Check if URL exist
    if ($url == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo "<br /><br /><center><strong>"._DOWNLOADNOURL."</strong><br /><br /><br />"
	    .""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
    }

// Check if Category exist - NukeStyles
    if ($cat == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo "<br /><br /><center><strong>"._NSDLNOCAT."</strong><br /><br /><br />"
	    .""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
    }
    
// Check if Description exist
    if ($description == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo "<br /><br /><center><strong>"._DOWNLOADNODESC."</strong><br /><br /><br />"
	    .""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
    }

// Check if email exsists @ if exists, make sure it's valid - NukeStyles
    if ($ns_dl_add_email == 1) {
	if ($email == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo"<br /><br /><center><strong>"._NSENTEREMAIL."</strong><br /><br /><br />"; 
	echo""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
	} else if (($email != "") AND (!preg_match ("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$/", $email))) {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo"<br /><br /><center>"._NSEMAILNOVALID." <font color=\"#CC0000\"><strong>$email</strong></font> ";
	echo""._NSEMAILNOVALID2."<br /><br /><br />"; 
	echo""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
        }
    }

// Check if Compatibility exsists - NukeStyles
    if ($ns_dl_add_compat == 1) {
	if ($ns_compat == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo"<br /><br /><center><strong>"._NSENTERCOMPAT."</strong><br /><br /><br />";
	echo""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
	die();
	}
    }

// Check if FileSize exsists - NukeStyles
    if ($ns_dl_add_filesize == 1) {
	if ($filesize == "") {
        $blocknow = 1;
	include_once("header.php");
	menu(1);
	echo "<br />";
	echo "<a name=\"nssubmit\">";
	ns_mod_title3("download_error",""._NSDLERROR."");
	OpenTable();
	ns_dl_OpenTable();
	echo"<br /><br /><center><strong>"._NSENTERFILE."</strong><br /><br /><br />"; 
	echo""._NSDLBACK."</center><br /><br />";
	ns_dl_CloseTable();
	CloseTable();
	$maindownload = 1;
	ns_dl_link_bar($maindownload);
	}
    }
}


ns_dl_add_error($title, $url, $cat, $desc, $email, $ns_compat, $filesize, $blocknow);



?>
