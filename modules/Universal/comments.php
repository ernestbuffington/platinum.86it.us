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

@require_once("mainfile.php");
$modulename = basename(dirname(__FILE__));
@require_once("modules/$modulename/settings.php");

function displaycomms() {
	global $prefix, $db, $vid, $bgcolor2, $textcolor1, $modulename, $mainprefix, $admin;
	$result = $db->sql_query("select * from ".$prefix."_".$mainprefix."_comments where vid = $vid");
	$resultnum = $db->sql_numrows($result);
	if ($resultnum) {
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
		while(list($cid, $vid, $commname, $comments) = $db->sql_fetchrow($result)) {
			$commname = stripslashes($commname);
			$comments = stripslashes($comments);
			echo "  <tr>";
			echo "    <td width=\"85%\" bgcolor=\"$bgcolor2\"> <font color=\"$textcolor1\">$commname ";
			echo "    "._COMMMESS.":</font></td>";
			echo "	  <td width=\"15%\" bgcolor=\"$bgcolor2\"> <font color=\"$textcolor1\">";
			if (is_admin($admin)) {
			echo "	  <div align=\"right\">[ <a href=\"modules.php?name=$modulename&file=admin&op=editcomment&cid=$cid&vid=$vid\">"._EDIT."</a> | ";
			echo "	  <a href=\"modules.php?name=$modulename&file=admin&op=deletecomment&cid=$cid&vid=$vid\">"._DELETE." ]";
			echo "	  </font></div>";
			}
			echo "</td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"2\">$comments</td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "    <td width=\"100%\" colspan=\"2\"><hr></td>";
			echo "  </tr>";
		}
			echo "</table>";
	} else {
			echo ""._NOCOMMS."";
	}
}

function PostComment($pid, $commtname, $commentext) {
	global $prefix, $db, $modulename, $mainprefix, $user;
	if (getconfigvar("allowcomments") == 1) {
		$commtname = addslashes($commtname);
		$commentext = addslashes($commentext);
		if (getconfigvar("restrictcomments") == 1) {
			if (is_user($user)) {
					if ($comment = "") {
						echo ""._ENTERCOMMENT." <a href=\"javascript:history.back\">"._GOBACK."</a>";
					} else {
					$db->sql_query("INSERT INTO ".$prefix."_".$mainprefix."_comments VALUES ('NULL', '$pid', '$commtname', '$commentext')"); 
					$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET comments = comments + 1 WHERE id = $pid");
    				Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$pid&viewed=1");
					}
			} else {
				echo ""._COMMREG." <a href=\"modules.php?name=Your_Account\">"._LOGIN."</a>";
			}
		} else {
		if ($comment = "") {
			echo ""._ENTERCOMMENT." <a href=\"javascript:history.back\">"._GOBACK."</a>";
		} else {
		$db->sql_query("INSERT INTO ".$prefix."_".$mainprefix."_comments VALUES ('NULL', '$pid', '$commtname', '$commentext')"); 
		$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET comments = comments + 1 WHERE id = $pid");
    	Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$pid&viewed=1");
		}
	}
	}
}


switch($op) {
	
	case "displaycomms":
	displaycomms();
	break;

	case "PostComment":
	PostComment($pid, $commtname, $commentext);
	break;

	default:
	displaycomms();
	break;
	
}

?>
