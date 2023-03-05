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

@require_once("modules/$name/settings.php");
@require_once("modules/$name/includes/error_checking.php");
@require_once("modules/$name/includes/language.php");
@include_once("modules/$name/includes/user.php");

$index = getconfigvar("rightblocks"); 

if(file_exists("modules/$name/language/lang-".$currentlang.".php")) {
        @include_once("modules/$name/language/lang-".$currentlang.".php");
}
else {
        @include_once("modules/$name/language/lang-english.php");
}
$modtitle = getconfigvar("modtitle");
$pagetitle = "- $modtitle";
@require_once("mainfile.php");
$modulename = basename( dirname( __FILE__ ) );
@require_once("modules/$name/includes/headers.php");

function adddataentry() {
	global $prefix, $db, $modulename, $user, $stop;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/wysiwyg.php");
	if (isset($stop)) { $stop = $stop; } else { $stop = 0; }
	$mainindex = 1;
    	mainheader($mainindex);
	if (getconfigvar("allowusersubmit") == 1) {
	if (is_user($user)) {
	$isuser = 1;
	} else {
	$isuser = 0;
	}
	if ($isuser == 0 and getconfigvar("onlyregusers") == 1) {
		$redirect = "modules.php?name=$modulename&file=add";
		user_login($redirect, $stop, $modulename);
	} elseif ($isuser == 1 and getconfigvar("onlyregusers") == 1) {
		@include_once("modules/$modulename/includes/addform.php");
	} else {
		@include_once("modules/$modulename/includes/addform.php");
	}
	} else {
		OpenTable();
			echo ""._POSTDISABLED."";
		CloseTable();
	}
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function previewform($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang) {
	global $prefix, $db, $modulename;
	checktitle($itemtitle);
	checkbad($content);
	errors();
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");
	@require_once("modules/$modulename/includes/wysiwyg.php");
		$mainindex = 1;
    	mainheader($mainindex);
  	$bbcode_uid = make_bbcode_uid();
    $content3 = insert_bbcode_uid($content, $bbcode_uid);
	$formattedcontent = parse_bbcode($content3,$bbcode_uid);	
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
			."<tr>"
			."<td width=\"100%\" valign=\"top\">"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>"
			."</tr>"
			."</table>";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
			."<tr>"
			."<td width=\"100%\">"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>"
			."</tr>"
			."<tr>"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">"
			."<tr>"
			."<td width=\"100%\">"
			."$formattedcontent</td>"
			."</tr>"
			."</table>"
			."</td>"
			."</tr>"
			."<tr>"
			."<td width=\"100%\">"
			."<p align=\"center\">&nbsp;"._PREVIEWREQUEST."</td>"
			."</tr>"
			."</table>";
		CloseTable();
	@include_once("modules/$modulename/includes/modifyform.php");
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function postdata($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix, $cookie, $user;
	@require_once("modules/$modulename/includes/bbstuff.php");
	checktitle($itemtitle);
	checkbad($content);
	errors();
	$content2= addslashes($content);
	$descrip2= addslashes($descrip);
	$submitter2= addslashes($submitter);
	$itemtitle2= addslashes($itemtitle);
	$itemauthor2= addslashes($itemauthor);
	$datea = date("Y-m-d H:i:s");
	$bbcode_uid = make_bbcode_uid();
	
	if (is_user($user)) {
	cookiedecode($user);
	$userpull = $db->sql_numrows($db->sql_query("SELECT username from ".$prefix."_".$mainprefix."_autoapprove where username = '$cookie[1]'"));
	if ($userpull == 1) {
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_items VALUES ('NULL', '$newcategory', '$itemauthor2', '$itemwebsite', '$itemtitle2', '$descrip2', '0', '0', '0' '$content2', '$submitter2', '$datea', 'NULL', '0', '$email', '$bbcode_uid', '$itemlang', '1')");
		$posted = 1;
	} else {
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_queue VALUES ('NULL', '$newcategory', '$itemauthor2', '$itemwebsite', '$itemtitle2', '$descrip2', '$content2', '$submitter2', '$email', '$itemlang')");
		$posted = 0;		
	} } else {
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_queue VALUES ('NULL', '$newcategory', '$itemauthor2', '$itemwebsite', '$itemtitle2', '$descrip2', '$content2', '$submitter2', '$email', '$itemlang')");
		$posted = 0;		
	}

	$result = $db->sql_query("select id from ".$prefix."_".$mainprefix."_queue");
	$waiting = $db->sql_numrows($result);
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		$mainindex = 1;
    	mainheader($mainindex);
	if ($posted == 1) {
		OpenTable();
			echo ""._ADMINPOSTED."";
		CloseTable();
	} else {
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
 			."<tr>"
 			."<td width=\"100%\" align=\"center\">"._ADDPOSTHEADER.".</td>"
			."</tr>"
			."<tr>"
			."<td width=\"100%\" align=\"center\">"._ADDPOSTMESSAGE.".</td>"
			."</tr>"
			."<tr>"
			."<td width=\"100%\" align=\"center\">&nbsp;</td>"
			."</tr>"
			."<tr>"
			."<td width=\"100%\" align=\"center\">"._ADDPOSTPART1." $waiting "._ADDPOSTPART2.".</td>"
			."</tr>"
			."</table>";
		CloseTable();
	}
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function getparent($parentid,$title) {
    global $prefix, $db, $mainprefix;
    $result = $db->sql_query("select id, title, parentid from ".$prefix."_".$mainprefix."_categories where id=$parentid");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result);
    if ($ptitle!="") $title=$ptitle."/".$title;
    if ($pparentid!=0) {
	$title=getparent($pparentid,$title);
    }
    return $title;
}

function request() {
	global $modulename, $user, $admin, $stop;
	if (getconfigvar("mostwanted") == 1) {
		$mwpostlevel = getconfigvar("mwpostlevel");
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	if (isset($stop)) { $stop = $stop; } else { $stop = 0; }
	$mainindex=1;
		mainheader($mainindex);
	if ($mwpostlevel == 0) {
				OpenTable();
				// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.xitemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECMWTITLE.".\")\n";
			echo "                                        document.postnew.xitemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.xsubmitter.value == \"\") {\n";
			echo "                                        alert(\""._ECMWNAME."\")\n";
			echo "                                        document.postnew.xsubmitter.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
				// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=add\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">"._SUBMITREQUEST.":<br />\n";
			echo "      "._ADMINAPPROVE.".</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <div align=\"center\">\n";
			echo "        <center>\n";
			echo "        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"57%\">\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">"._ITEMTITLE.":</td>\n";
			echo "            <td width=\"72%\"><input type=\"text\" name=\"xitemtitle\" size=\"28\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">"._YOURNAME.":</td>\n";
			echo "            <td width=\"72%\"><input type=\"text\" name=\"xsubmitter\" size=\"28\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">&nbsp;</td>\n";
			echo "            <td width=\"72%\">&nbsp;</td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"100%\" colspan=\"2\">\n";
			echo "            <p align=\"center\">\n";
			echo "            <input type=\"submit\" value=\""._SUBMITREQUEST."\" name=\"B1\"></td>\n";
			echo "          </tr>\n";
			echo "        </table>\n";
			echo "        </center>\n";
			echo "      </div>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"addrequest\">\n";
			echo "</form>\n";
		CloseTable();
	} elseif ($mwpostlevel == 1) {
		if (is_user($user)) {
					OpenTable();
				// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.xitemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECMWTITLE.".\")\n";
			echo "                                        document.postnew.xitemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.xsubmitter.value == \"\") {\n";
			echo "                                        alert(\""._ECMWNAME."\")\n";
			echo "                                        document.postnew.xsubmitter.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
				// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=add\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">"._SUBMITREQUEST.":<br />\n";
			echo "      "._ADMINAPPROVE.".</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <div align=\"center\">\n";
			echo "        <center>\n";
			echo "        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"57%\">\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">"._ITEMTITLE.":</td>\n";
			echo "            <td width=\"72%\"><input type=\"text\" name=\"xitemtitle\" size=\"28\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">"._YOURNAME.":</td>\n";
			echo "            <td width=\"72%\"><input type=\"text\" name=\"xsubmitter\" size=\"28\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"28%\">&nbsp;</td>\n";
			echo "            <td width=\"72%\">&nbsp;</td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"100%\" colspan=\"2\">\n";
			echo "            <p align=\"center\">\n";
			echo "            <input type=\"submit\" value=\""._SUBMITREQUEST."\" name=\"B1\"></td>\n";
			echo "          </tr>\n";
			echo "        </table>\n";
			echo "        </center>\n";
			echo "      </div>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"addrequest\">\n";
			echo "</form>\n";
		CloseTable();
		} else {
			$redirect = "modules.php?name=$modulename&file=add&op=request";
			$op2 = "&op=request";
			user_login($redirect, $stop, $modulename, $op2);	
		}
	} else {
		Header("Location: modules.php?name=$modulename");
	}
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
	} else {
		Header("Location: modules.php?name=$modulename");
	} 
}

function addrequest($xitemtitle, $xsubmitter) {
	global $prefix, $db, $modulename, $mainprefix, $user, $admin;
	if (getconfigvar("mostwanted") == 1) {
		$mwpostlevel = getconfigvar("mwpostlevel");
	checkrequest($xitemtitle);
	errors();
	$datea = date("Y-m-d H:i:s");
	$xitemtitle = addslashes($xitemtitle);
	if ($mwpostlevel == 0) {
		$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_requests VALUES ('NULL', '$xitemtitle', '$xsubmitter', '$datea', '0')");
	} elseif ($mwpostlevel == 1) {
		if (is_user($user)) {
			$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_requests VALUES ('NULL', '$xitemtitle', '$xsubmitter', '$datea', '0')");
		} else {
			Header("Location: modules.php?name=$modulename");	
		} 
	} else {
		Header("Location: modules.php?name=$modulename");
	}
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	$mainindex=1;
		mainheader($mainindex);
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._REQUESTPOSTED.".<br />\n";
			echo "    "._ADMINMUSTAPPROVE.".</td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
	} else {
		Header("Location: modules.php?name=$modulename");
	}
}


switch ($op) {
	
	case "addentry":
	adddataentry();
	break;
	
	case "postdata":
	postdata($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang);
	break;
	
	case "previewform":
	previewform($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang);
	break;
	
	case "request":
	request();
	break;
	
	case "addrequest":
	addrequest($xitemtitle, $xsubmitter);
	break;
	
	default:
	adddataentry();
	break;
	
}

?>
