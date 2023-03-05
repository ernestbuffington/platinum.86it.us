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
$modulename = basename(dirname(__FILE__));
get_lang($modulename);
@require_once("modules/$modulename/settings.php");

function FriendSend($sid) {
	global $prefix, $db, $mainprefix, $modulename;
if (!isset($sid)) {
	die("Not Allowed");
}	
	// JavaScript Error Checking
echo "<script language=\"JavaScript\">\n";
echo "\n";
echo "<!--\n";
echo "                        function checkData (){\n";
echo "                                if (document.signup.uname.value == \"\") {\n";
echo "                                        alert(\""._CHECKYNAME.".\")\n";
echo "                                        document.signup.uname.focus()\n";
echo "                                        return false}\n";
echo "                                if (document.signup.yemail.value == \"\") {\n";
echo "                                        alert(\""._CHECKYEMAIL.".\")\n";
echo "                                        document.signup.yemail.focus()\n";
echo "                                        return false}\n";
echo "                                if (document.signup.fname.value == \"\") {\n";
echo "                                        alert(\""._CHECKFNAME.".\")\n";
echo "                                        document.signup.fname.focus()\n";
echo "                                        return false}\n";
echo "                                if (document.signup.femail.value == \"\") {\n";
echo "                                        alert(\""._CHECKFEMAIL."\")\n";
echo "                                        document.signup.femail.focus();\n";
echo "                                        return false;\n";
echo "\n";
echo "                                }\n";
echo "                          \n";
echo "                        }\n";
echo "// -->\n";
echo "\n";
echo "</script>\n";
// end error checking
			echo "<title>"._FRIENDTITLE."</title>";
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=friend\" enctype=\"multipart/form-data\" name=\"signup\" onsubmit=\"return checkData()\">\n";
			echo "  <table border=\"0\" cellspacing=\"1\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\"><i><strong>"._FMTITLE.":</strong></i></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._FITEMID.":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
			echo "      <input type=\"text\" name=\"fid\" value=\"$sid\" readOnly size=\"20\"></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._YOURNAME.":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
			echo "      <input type=\"text\" name=\"uname\" size=\"20\"></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._YOUREMAIL.":&nbsp;&nbsp;&nbsp;&nbsp;\n";
			echo "      <input type=\"text\" name=\"yemail\" size=\"20\"></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._FRIENDNAME.":&nbsp;\n";
			echo "      <input type=\"text\" name=\"fname\" size=\"20\"></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._FRIENDEMAIL.":\n";
			echo "      <input type=\"text\" name=\"femail\" size=\"20\"></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._TYPEMESS." <br />\n";
			echo "      <textarea rows=\"6\" name=\"smess\" cols=\"29\"></textarea></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._FRIENDNOTE."\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\"><input type=\"submit\" value=\""._SEND."\">\n";
			echo "      <input type=\"button\" value=\""._CANCEL."\" onclick=\"javascript:parent.close()\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			//echo "	<input type=\"hidden\" name=\"fid\" value\"$sid\">\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"sendfemail\">\n";
			echo "</form>\n";
}

function sendfemail($fid, $uname, $yemail, $fname, $femail, $smess) {
    global $sitename, $nukeurl, $prefix, $db, $modulename, $mainprefix;
    $result2=$db->sql_query("select id, parentid, title from ".$prefix."_".$mainprefix."_items where id = '$fid'");
    list($id, $parentid, $title) = $db->sql_fetchrow($result2);
    $title = stripslashes($title);
	$cattitlequery = $db->sql_query("select parentid, title from ".$prefix."_".$mainprefix."_categories where id=$parentid");
	list($parentid2,$title2)= $db->sql_fetchrow($cattitlequery);
	$title2=getparentlink($parentid2,$title2);    
	//echo "1:$fid, 2:$uname, 3:$yemail, 4:$fname, 5:$femail, 6:$title, 7:$smess, 8:$title2"; // For Debugging
	if ($smess) {
		$smess2 = ""._SHORTMESSAGE.":\n\n$smess";
	} else {
		$smess = "";
	}
	$to = "$fname <$femail>";
    $subject = ""._INTERESTING." $sitename";
    $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $uname "._CONSIDERED."\n\n$title\n"._VBCAT.": $title2\n\n"._LINKMESS."\n"._URL.": $nukeurl/modules.php?name=$modulename&op=ViewItems&vid=$id\n\n"._YOUCANREAD." $sitename\n$nukeurl/modules.php?name=$modulename\n\n$smess2";
    mail($to, $subject, $message, "From: \"$uname\" <$yemail>\nX-Mailer: PHP/" . phpversion());
    Header("Location: modules.php?name=$modulename&file=friend&op=mailsent&fname=$fname&femail=$femail");
}

function mailsent($fname, $femail) {
	echo "<p>"._MAILSENT1." <br />";
	echo ""._MAILSENT2.":</p>";
	echo "<p>$fname at $femail</p>";
	echo "<p><input type=\"button\" value=\""._CLOSE."\" onclick=\"javascript:parent.close()\"></p>";
}

function getparentlink($parentid2,$title2) {
    global $prefix, $db, $modulename, $mainprefix;
    $parentid2 = intval($parentid2);
    $result2=$db->sql_query("select id, parentid, title from ".$prefix."_".$mainprefix."_categories where id=$parentid2");
    list($cid2, $pparentid2, $ptitle2) = $db->sql_fetchrow($result2);
    if ($ptitle2!="") $title2="<a href=modules.php?name=$modulename&op=CatIndex&cid=$cid2>$ptitle2</a>/".$title2;
    if ($pparentid2!=0) {
    	$title2=getparentlink($pparentid2,$title2);
    }
    return $title2;
}

switch ($op) {
	
	case "FriendSend":
	FriendSend($sid);
	break;
	
	case "sendfemail":
	sendfemail($fid, $uname, $yemail, $fname, $femail, $smess);
	break;
	
	case "mailsent":
	mailsent($fname, $femail);
	break;
	
}

?>
