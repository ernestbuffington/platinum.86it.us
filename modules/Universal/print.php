<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

@require_once("mainfile.php");
@require_once("modules/$name/settings.php");
$modulename = basename(dirname(__FILE__));
get_lang($modulename);

if(!isset($sid)) {
    exit();
}

function PrintPage($sid) {
	global $prefix, $db, $sitename, $siteurl, $mainprefix, $modulename;
	@require_once("modules/$modulename/includes/bbstuff.php");
	$datapull = $db->sql_query("select id, parentid, author, website, title, description, content, submitter, date, lastdate, youremail, bbcode_uid from ".$prefix."_".$mainprefix."_items where id = $sid");
	while(list($id, $parentid, $author, $website, $title, $description, $content, $submitter, $date, $lastdate, $youremail, $bbcode_uid) = $db->sql_fetchrow($datapull)) {
	$category = $db->sql_query("select title from ".$prefix."_".$mainprefix."_categories where id = $parentid");
	list($cattitle) = $db->sql_fetchrow($category);
	if ($lastdate) {
    	$overalldate = $lastdate;
    } else {
    	$overalldate = $date;
    }
    $overalldate2 = FormatDate($overalldate);
    $formatteddate = FormatDate($date);
    $submitemail1 = $db->sql_query("select username from ".$prefix."_users where username = '$submitter'");
    while(list($femail) = $db->sql_fetchrow($submitemail1)) {
    if ($submitemail1) {
	 	$contactemail = $youremail;
	 	$submitterq = "<a href=modules.php?name=Your_Account&op=userinfo&username=$submitter>$submitter</a>";
    } else {
    	$contactemail = $youremail;
    	$submitterq = $submitter;
    }
    }
    $formattedcontent = stripslashes($content);
    $formattedcontent = parse_bbcode($formattedcontent, $bbcode_uid);
    $title = stripslashes($title);
    		echo "<title>"._PITEMSFOR.": $title</title>";
			echo "<p align=\"center\"><strong><font size=\"5\">"._PITEMSFOR.": $title</font></strong></p>";
			echo "<p align=\"left\">$formattedcontent</p>";
			echo "<hr>";
			echo "<p align=\"left\">"._PITEMCAT.": $cattitle<br />";
			echo ""._PITEMAUTHOR.": $author [$website]<br />";
			echo ""._PITEMSUBMIT.": $submitterq [$youremail]<br />";
			echo ""._PITEMSUBON.": $formatteddate<br />";
			echo ""._PITEMLASTMOD.": $overalldate2</p>";
			echo "<p align=\"left\">"._PITEMPRINTED." <a href=\"$siteurl\">$sitename</a></p>";
			echo "<p align=\"left\"><br />";
			echo " </p>";	
	}
}

function FormatDate($strDate){
		preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $strDate, $Adob);
        $newdob = $Adob[3];
        if ($Adob[2] == 1)$month = _JANUARY;
        if ($Adob[2] == 2)$month = _FEBRUARY;
        if ($Adob[2] == 3)$month = _MARCH;
        if ($Adob[2] == 4)$month = _APRIL;
        if ($Adob[2] == 5)$month = _MAY;
        if ($Adob[2] == 6)$month = _JUNE;
        if ($Adob[2] == 7)$month = _JULY;
        if ($Adob[2] == 8)$month = _AUGUST;
        if ($Adob[2] == 9)$month = _SEPTEMBER;
        if ($Adob[2] == 10)$month = _OCTOBER;
        if ($Adob[2] == 11)$month = _NOVEMBER;
        if ($Adob[2] == 12)$month = _DECEMBER;
        $newdob = "$month"." ".$newdob.", ".$Adob[1];
        return $newdob;
}

switch ($op) {
	
	case "PrintPage":
	PrintPage($sid);
	break;
	
	default:
	PrintPage($sid);
	break;
	
}

?>