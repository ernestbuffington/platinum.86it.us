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

if (stristr($_SERVER['SCRIPT_NAME'], "error_checking.php")) {
	die("Illegal Desolate File Access");
}

$badfields = array ();

function checkbad($tempfield) {
	global $badfields, $db, $prefix, $mainprefix;
	$badwords = $db->sql_query("SELECT word from ".$prefix."_".$mainprefix."_censorlist");
	while(list($word) = $db->sql_fetchrow($badwords)) {
		if (preg_match("/$word/i", $tempfield)) {
			array_push($badfields, ""._ECUSEOFWORD." <u>$word</u> "._ECNOTPERMIT."<br />");
		}
	}	
}

function checktitle($temptitle) {
	global $prefix, $db, $badfields, $mainprefix;
	$temptitle2 = addslashes($temptitle);
	$result = $db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_items where title = '$temptitle2' limit 0,1");
	list($title) = $db->sql_fetchrow($result);
		if ($temptitle == $title) {
			array_push($badfields, ""._ECITEMNAME.": <i>$temptitle</i> "._ECPOSTERROR."<br />");
		}
}

function checkrequest($temptitle) {
	global $prefix, $db, $badfields, $mainprefix;
	$temptitle2 = addslashes($temptitle);
	$result = $db->sql_query("SELECT itemtitle from ".$prefix."_".$mainprefix."_requests where itemtitle = '$temptitle2' limit 0,1");
	list($title) = $db->sql_fetchrow($result);
		if ($temptitle == $title) {
			array_push($badfields, ""._ECITEMNAME2.": <i>$temptitle</i> "._ECPOSTERROR2."<br />");
		}
}


function errors() {
	global $fontname, $fontsize, $badfields, $modulename;
	$badcount = count($badfields);
	if ($badcount >= 1) {
		@include_once("header.php");
		@include_once("modules/$modulename/includes/js.php");
		$mainindex = 1;
    	mainheader($mainindex);
		OpenTable();
			echo "<div align=\"center\"> \n";
			echo "  <h2><font face=\"$fontname\" size=\"$fontsize\">"._ECSUBNOTACCEPT." \n";
			echo "    !</font></h2>\n";
			echo "  <p align=\"center\"><font face=\"$fontname\" size=\"$fontsize\"><br />\n";
			echo "    "._ECSUBNOTACCEPT2." <br />"._ECCLICKHERE."\n";
			echo "     \n";
			echo "    :</font></p>\n";
			echo "  <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
			echo "    <tr> \n";
			echo "      <td>\n";
			echo "        <ul>\n";

		foreach ( $badfields as $bad ) {
			echo "          <li><font face=\"$fontname\" size=\"$fontsize\"><strong>$bad</strong></font></li>\n";
		}

			echo "        </ul>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <p align=\"center\"><br />\n";
			echo "  </p>\n";
			echo "  <br />\n";
			echo "</div>\n";
		CloseTable();
		@include_once("footer.php");
		@include_once("modules/$modulename/includes/credit-line.php");
	exit;
	}
}

?>