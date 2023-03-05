<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.net	#
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

global $admin;
$modulename = basename( dirname( __FILE__ ) );

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

if (!file_exists("modules/$name/settings.php")) {
	echo "Oops, you forgot to run the installation script";
	die();
}

if(isset($_GET[admin])) {
	die("Illegal Access Attempt");
}

if(!is_array($admin)) {
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = explode(":", $admin);
	$aid = addslashes($admin[0]);
} else {
	$aid = addslashes($admin[0]);
}

$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Universal'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

@require_once("modules/$name/settings.php");
@require_once("modules/$name/includes/error_checking.php");
@require_once("modules/$name/includes/language.php");


if(file_exists("modules/$name/language/admin-".$currentlang.".php")) {
        @include_once("modules/$name/language/admin-".$currentlang.".php");
}
else {
        @include_once("modules/$name/language/admin-english.php");
}

$modtitle = getconfigvar("modtitle");
$pagetitle = "- $modtitle";
@require_once("mainfile.php");
get_lang($modulename);
@require_once("modules/$name/includes/headers.php");

function admin_index() {
	global $prefix, $db, $modulename, $mainprefix, $bgcolor2, $config_updated, $item_added;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
	// For Confirmation of completed actions
	if (isset($config_updated)) $action = ""._ADSETTINGSUPDATED.".";
	if (isset($item_added)) $action = ""._ITEMADDEDC."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();	
	}
	// End
		OpenTable();
		$numcat = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_categories"));
		$numitems = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items"));
		$numwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_queue"));
		$numrequests = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_requests where approved = '1'"));
		$numrequestwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_requests where approved = '0'"));
		$nummodrequestwaiting = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_modify"));
		$rlinksstored = $db->sql_numrows($db->sql_query("SELECT rid from ".$prefix."_".$mainprefix."_related"));
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\"><u><strong><i>"._ADSTATUS.":</i></strong></u></td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <div align=\"center\">\n";
			echo "      <center>\n";
			echo "      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"64%\">\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADTOTALCAT.":</td>\n";
			echo "          <td width=\"50%\">$numcat</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADTOTALITEMS.":</td>\n";
			echo "          <td width=\"50%\">$numitems</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADTOTALWAITING.":</td>\n";
			echo "          <td width=\"50%\">$numwaiting</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADTOTALREQUESTS.":</td>\n";
			echo "          <td width=\"50%\">$numrequests</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADTOTALREQUESTSW.":</td>\n";
			echo "          <td width=\"50%\">$numrequestwaiting</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADMODREQUESTSSW.":</td>\n";
			echo "          <td width=\"50%\">$nummodrequestwaiting</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"50%\">"._ADRLINKS.":</td>\n";
			echo "          <td width=\"50%\">$rlinksstored</td>\n";
			echo "        </tr>\n";
			echo "      </table>\n";
			echo "      </center>\n";
			echo "    </div>\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "</table>\n";		
		CloseTable();	
		OpenTable();
			echo ""._ADMESSAGE."";	
		CloseTable();
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function admin_block() {
	global $modulename;
	$title = "Admin Links";
	$content .= "		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	$content .= "			<tr>\n";
	$content .= "				<td>\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=configure\">"._ADCONFIG."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=censorlist\">"._ADCENSORLIST."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=usercontrol\">"._AUTOAPPROVE."</a>\n";
	$content .= "				<hr>\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=categories\">"._ADADDNEWCAT2."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=requestadmin\">"._ADREQUESTADMIN."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=relatedadmin\">"._ADRELATEDADMIN."</a>\n";
	$content .= "				<hr>\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=additem\">"._ADADDNEWITEM."</a><br />\n";	
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=item_list\">"._ADMODIFYITEM."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=item_list\">"._ADDELETEITEM."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=itemcontrol\">"._ACTIVEDEACTIVE."</a>\n";
	$content .= "				<hr>\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue\">"._ADITEMQUEUE."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods\">"._ADWAITINGMODS."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=admin&op=imageupload\">"._UPLOADIMAGE."</a></td>\n";
	$content .= "			</tr>\n";
	$content .= "		</table>\n";
	themesidebox($title, $content);
}

function module_block() {
	global $modulename;	
	$title = "Module Links";
	$content .= "		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	$content .= "			<tr>\n";
	$content .= "				<td>\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename\">"._ADMAININDEX."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&file=add\">"._ADSUBMITITEM."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&op=TopRated\">"._ADTOPRATED."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&op=Random\">"._ADRANDOMITEM."</a><br />\n";
	$content .= "				<strong>&#8226;</strong>&nbsp;<a href=\"modules.php?name=$modulename&op=MostWanted\">"._ADMOSTWANTED."</a><br />\n";
	$content .= "				</td>\n";
	$content .= "			</tr>\n";
	$content .= "		</table>\n";
	themesidebox($title, $content);	
}

function admin_header() {
	main_admin_header();
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
		echo "	<tr>\n";
		echo "		<td valign=\"top\">\n";	
}

function admin_footer() {
		echo "</td>\n";
		echo "		<td width=\"159\" valign=\"top\">\n";
	admin_block();	
	module_block();
		echo "		</td>\n";
		echo "	</tr>\n";
		echo "</table>\n";		
}

function configure() {
	global $prefix, $db, $modulename, $bgcolor2;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	$modtitle = getconfigvar("modtitle");
	$modtitle = stripslashes($modtitle);
	admin_header();
		OpenTable();
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" height=\"19\">\n";
			echo "      <p align=\"center\"><i><strong>"._MAINCMESS."</strong></i></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" height=\"19\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" height=\"19\">\n";
			echo "      <table border=\"0\" cellpadding=\"0\" width=\"100%\">\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._MODTITLE.":</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[modtitle]\" size=\"23\" value=\"$modtitle\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._RIGHTBLOCKS.":</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("rightblocks") == 1) {
			echo "          <input type=\"radio\" value=\"1\" name=\"settings[rightblocks]\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[rightblocks]\" value=\"0\">"._ADOFF."\n";
		} else {
			echo "          <input type=\"radio\" value=\"1\" name=\"settings[rightblocks]\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[rightblocks]\" value=\"0\" checked>"._ADOFF."\n";
		}
			echo "        </td></tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._LOGOIMAGE.":</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("imageon") == 1) {
			echo "          <input type=\"radio\" name=\"settings[imageon]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[imageon]\" value=\"0\">"._ADOFF."\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[imageon]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[imageon]\" value=\"0\" checked>"._ADOFF."\n";
		}
			echo "        </td></tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._ITEMSPERPAGE.":</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[perpage]\" size=\"6\" value=\"".getconfigvar("perpage")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._ALLOWUSERSUBMIT.":</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("allowusersubmit") == 1) {
			echo "          <input type=\"radio\" name=\"settings[allowusersubmit]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowusersubmit]\" value=\"0\">"._ADNO."\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[allowusersubmit]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowusersubmit]\" value=\"0\" checked>"._ADNO."\n";
		}
			echo "        </td></tr>\n";
			echo "        <tr>\n";	
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._ITEMSONPAGE."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[newpage]\" size=\"6\" value=\"".getconfigvar("newpage")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._VIEWSPOPULAR."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[popular]\" size=\"6\" value=\"".getconfigvar("popular")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._ONPOPULARPAGE."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[popularpage]\" size=\"6\" value=\"".getconfigvar("popularpage")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"22\" bgcolor=\"$bgcolor2\">"._MAXSEARCHRESULTS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"22\">\n";
			echo "          <input type=\"text\" name=\"settings[searchresults]\" size=\"6\" value=\"".getconfigvar("searchresults")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._SHOWITEMQUEUE."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("showqueue") == 1) {
			echo "          <input type=\"radio\" name=\"settings[showqueue]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[showqueue]\" value=\"0\">"._ADNO."\n";	
		} else {
			echo "          <input type=\"radio\" name=\"settings[showqueue]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[showqueue]\" value=\"0\" checked>"._ADNO."\n";	
		}
			echo "        </td></tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._ONLYREGUSERS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("onlyregusers") == 1) {
			echo "          <input type=\"radio\" name=\"settings[onlyregusers]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[onlyregusers]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[onlyregusers]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[onlyregusers]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._SUBMITMODIFYR."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("allowmodifyrequest") == 1) {
			echo "          <input type=\"radio\" name=\"settings[allowmodifyrequest]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowmodifyrequest]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[allowmodifyrequest]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowmodifyrequest]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"17\" bgcolor=\"$bgcolor2\">"._IMAGEUPLOADUSERS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"17\">\n";
		if (getconfigvar("allowimageupload") == 1) {
			echo "          <input type=\"radio\" name=\"settings[allowimageupload]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowimageupload]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[allowimageupload]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowimageupload]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"20\" bgcolor=\"$bgcolor2\">"._RESTRICTIMAGEUPLOAD."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"20\">\n";
		if (getconfigvar("restrictimageupload") == 1) {
			echo "          <input type=\"radio\" name=\"settings[restrictimageupload]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[restrictimageupload]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[restrictimageupload]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[restrictimageupload]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._ALLOWCOMMENTS.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("allowcomments") == 1) {
			echo "          <input type=\"radio\" name=\"settings[allowcomments]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowcomments]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[allowcomments]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowcomments]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._RESTRICTCOMMENTS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("restrictcomments") == 1) {
			echo "          <input type=\"radio\" name=\"settings[restrictcomments]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[restrictcomments]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[restrictcomments]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[restrictcomments]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._MAXTOPRATED."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
			echo "          <input type=\"text\" name=\"settings[toprated]\" size=\"6\" value=\"".getconfigvar("toprated")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"21\" bgcolor=\"$bgcolor2\">"._MOSTPOPBLOCK."\n";
			echo "         :</td>\n";
			echo "          <td width=\"32%\" height=\"21\">\n";
		if (getconfigvar("mostpopblock") == 1) {
			echo "          <input type=\"radio\" name=\"settings[mostpopblock]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[mostpopblock]\" value=\"0\">"._ADOFF."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[mostpopblock]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[mostpopblock]\" value=\"0\" checked>"._ADOFF."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._NEWBLOCK."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("newblock") == 1) {
			echo "          <input type=\"radio\" name=\"settings[newblock]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[newblock]\" value=\"0\">"._ADOFF."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[newblock]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[newblock]\" value=\"0\" checked>"._ADOFF."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._MAXSUBCATS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
			echo "          <input type=\"text\" name=\"settings[maxcatlimit]\" size=\"6\" value=\"".getconfigvar("maxcatlimit")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._ALLOWRATINGS."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("allowratings") == 1) {
			echo "          <input type=\"radio\" name=\"settings[allowratings]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowratings]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[allowratings]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[allowratings]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._MOSTWANTEDSYSTEM.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("mostwanted") == 1) {
			echo "          <input type=\"radio\" name=\"settings[mostwanted]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[mostwanted]\" value=\"0\">"._ADOFF."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[mostwanted]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[mostwanted]\" value=\"0\" checked>"._ADOFF."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._MWPOSTINGLEVEL."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("mwpostlevel") == 0) {
			echo "          <input type=\"radio\" name=\"settings[mwpostlevel]\" value=\"0\" checked>"._EVERYONE."\n";
			echo "          <input type=\"radio\" name=\"settings[mwpostlevel]\" value=\"1\">"._REGUSERS."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[mwpostlevel]\" value=\"0\">"._EVERYONE."\n";
			echo "          <input type=\"radio\" name=\"settings[mwpostlevel]\" value=\"1\" checked>"._REGUSERS."</td>\n";
		} 
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._SORTBYTYPE.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("sortbytype") == 1) {
			echo "          <input type=\"radio\" name=\"settings[sortbytype]\" value=\"1\" checked>"._DROPDOWNBOX."\n";
			echo "          <input type=\"radio\" name=\"settings[sortbytype]\" value=\"0\">"._TEXTLINKS."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[sortbytype]\" value=\"1\">"._DROPDOWNBOX."\n";
			echo "          <input type=\"radio\" name=\"settings[sortbytype]\" value=\"0\" checked>"._TEXTLINKS."</td>\n";
		}
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._MWPERPAGE."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
			echo "          <input type=\"text\" name=\"settings[mwpages]\" size=\"6\" value=\"".getconfigvar("mwpages")."\"></td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._QUICKVIEW.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("quickview") == 1) {
			echo "          <input type=\"radio\" name=\"settings[quickview]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[quickview]\" value=\"0\">"._ADOFF."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[quickview]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[quickview]\" value=\"0\" checked>"._ADOFF."</td>\n";
		}
			echo "        </tr>\n";		
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._QUICKVIEWNUM."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
			echo "          <input type=\"text\" name=\"settings[quickviewnum]\" size=\"6\" value=\"".getconfigvar("quickviewnum")."\"></td>\n";
			echo "        </tr>\n";		
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._RANDOMQUICK.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("randomquick") == 1) {
			echo "          <input type=\"radio\" name=\"settings[randomquick]\" value=\"1\" checked>"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[randomquick]\" value=\"0\">"._ADOFF."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[randomquick]\" value=\"1\">"._ADON."\n";
			echo "          <input type=\"radio\" name=\"settings[randomquick]\" value=\"0\" checked>"._ADOFF."</td>\n";
		}
			echo "        </tr>\n";		
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._QVARTICLE.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("qvarticle") == 1) {
			echo "          <input type=\"radio\" name=\"settings[qvarticle]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[qvarticle]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[qvarticle]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[qvarticle]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";	
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._QVACHARLIMIT."\n";
			echo "          :</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
			echo "          <input type=\"text\" name=\"settings[qvacharlimit]\" size=\"6\" value=\"".getconfigvar("qvacharlimit")."\"></td>\n";
			echo "        </tr>\n";		
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._CATUSEDESCRIP.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("usedescript") == 1) {
			echo "          <input type=\"radio\" name=\"settings[usedescript]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[usedescript]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[usedescript]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[usedescript]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";	
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._LIMITMODREQUESTS.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("limitmodrequests") == 1) {
			echo "          <input type=\"radio\" name=\"settings[limitmodrequests]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[limitmodrequests]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[limitmodrequests]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[limitmodrequests]\" value=\"0\" checked>"._ADNO."</td>\n";
		}
			echo "        </tr>\n";	
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._JSCHECKING.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";
		if (getconfigvar("jschecking") == 1) {
			echo "          <input type=\"radio\" name=\"settings[jschecking]\" value=\"0\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[jschecking]\" value=\"1\" checked>"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[jschecking]\" value=\"0\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[jschecking]\" value=\"1\">"._ADNO."</td>\n";
		}
			echo "        </tr>\n";	
			echo "        <tr>\n";	
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._USEPHPBBNUMBERING.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";	
		if (getconfigvar("phpbb_pages") == 1) {
			echo "          <input type=\"radio\" name=\"settings[phpbb_pages]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[phpbb_pages]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[phpbb_pages]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[phpbb_pages]\" value=\"0\" checked>"._ADNO."</td>\n";
		}		
			echo "		  </tr>\n";
			echo "        <tr>\n";	
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._USEMULTILINGUELFEATURE.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";			
		if (getconfigvar("multilinguel") == 1) {
			echo "          <input type=\"radio\" name=\"settings[multilinguel]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[multilinguel]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[multilinguel]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[multilinguel]\" value=\"0\" checked>"._ADNO."</td>\n";
		}				
			echo "        </tr>\n";	
			echo "        <tr>\n";	
			echo "          <td width=\"34%\" height=\"19\" bgcolor=\"$bgcolor2\">"._NOSUBCATS.":</td>\n";
			echo "          <td width=\"32%\" height=\"19\">\n";			
		if (getconfigvar("nosubcats") == 1) {
			echo "          <input type=\"radio\" name=\"settings[nosubcats]\" value=\"1\" checked>"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[nosubcats]\" value=\"0\">"._ADNO."</td>\n";
		} else {
			echo "          <input type=\"radio\" name=\"settings[nosubcats]\" value=\"1\">"._ADYES."\n";
			echo "          <input type=\"radio\" name=\"settings[nosubcats]\" value=\"0\" checked>"._ADNO."</td>\n";
		}				
			echo "        </tr>\n";				
			echo "        <tr>\n";
			echo "          <td width=\"34%\" height=\"19\">&nbsp;</td>\n";
			echo "          <td width=\"32%\" height=\"19\">&nbsp;</td>\n";
			echo "        </tr>\n";
			echo "        <tr>\n";
			echo "          <td width=\"66%\" height=\"19\" colspan=\"2\">\n";
			echo "          <p align=\"center\"><input type=\"submit\" value=\""._SAVESETTINGS."\"></td>\n";
			echo "        </tr>\n";
			echo "      </table>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"save_settings\">\n";
			echo "</form>\n";
		CloseTable();
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function save_settings($settings) {
	global $prefix, $db, $modulename, $mainprefix;
       foreach ($settings as $name => $value) {
       	if ($name == "modtitle") $name = addslashes($name);
       	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_cfg SET value='$value' where name='$name'");
       	$name = "";
       }
		Header("Location: modules.php?name=$modulename&file=admin&config_updated=1");
}

function censorlist() {
	global $prefix, $db, $modulename, $mainprefix, $added, $edited, $deleted;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
		if (isset($added)) $action = ""._ADADDEDCWORD."";
		if (isset($edited)) $action = ""._ADSAVEDCWORD."";
		if (isset($deleted)) $action = ""._ADDELETEDCWORD."";
		if (isset($action)) {
			OpenTable();
				echo "$action\n";
			CloseTable();
		}	
		OpenTable();
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"64%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"50%\" align=\"center\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <p align=\"center\"><strong>"._CLWORD."</strong></td>\n";
			echo "      <td width=\"50%\" align=\"center\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <strong>"._CLFUNCTIONS."</strong></td>\n";
			echo "    </tr>\n";
		$sql = $db->sql_query("SELECT id, word from ".$prefix."_".$mainprefix."_censorlist");
		while(list($id, $word) = $db->sql_fetchrow($sql)) {	
			$word = stripslashes($word);
			echo "    <tr>\n";
			echo "      <td width=\"50%\" align=\"center\">$word</td>\n";
			echo "      <td width=\"50%\" align=\"center\">[\n";
			echo "      <a href=\"modules.php?name=$modulename&file=admin&op=editcensorword&id=$id\">\n";
			echo "      "._CLEDIT."</a> |\n";
			echo "      <a href=\"modules.php?name=$modulename&file=admin&op=delcensorword&id=$id\">\n";
			echo "      "._CLDELETE." </a>]</td>\n";
			echo "    </tr>\n";
		}
			echo "  </table>\n";
			echo "  </center>\n";
			echo "</div>\n";		
		CloseTable();
		OpenTable();
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"64%\">\n";
			echo "    <tr>\n";
			echo "    <form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "      <td width=\"100%\">\n";
			echo "        <p>"._CLADDWORD.":</p>\n";
			echo "        <p><input type=\"text\" name=\"censorword\" size=\"24\">\n";
			echo "        <input type=\"submit\" value=\""._CLADDWORD2."\"></p>\n";
			echo "        <input type=\"hidden\" name=\"op\" value=\"addcensorword\">\n";
			echo "      </td>\n";
			echo "      </form>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  </center>\n";
			echo "</div>\n";		
		CloseTable();
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");						
}

function addcensorword($censorword) {
	global $db, $prefix, $mainprefix, $modulename;
	$censorword = addslashes($censorword);
	$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_censorlist VALUES ('NULL', '$censorword')");
	Header("Location: modules.php?name=$modulename&file=admin&op=censorlist&added=1");
}

function editcensorword($id) {
	global $db, $prefix, $mainprefix, $modulename, $textcolor1, $bgcolor2;
	$row = $db->sql_fetchrow($db->sql_query("SELECT id, word from ".$prefix."_".$mainprefix."_censorlist where id = '$id'"));
	$word = stripslashes($row[word]);
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
		OpenTable();
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"50%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <p align=\"center\"><strong>"._CLEDITINGWORD.":</strong> <i>$row[word]</i></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        <p align=\"center\">"._CLCENSORWORD.":\n";
			echo "        <input type=\"text\" name=\"censorword\" size=\"20\" value=\"$word\"></p>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        &nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        <p align=\"center\"><input type=\"submit\" value=\""._CLSAVECHANGES."\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "        <input type=\"hidden\" name=\"op\" value=\"savecensorword\">\n";
			echo "        <input type=\"hidden\" name=\"cid\" value=\"$row[id]\">\n";
			echo "  </form>\n";
			echo "  </center>\n";
			echo "</div>\n";		
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function savecensorword($cid, $censorword) {
	global $db, $prefix, $mainprefix, $modulename;
	$censorword = addslashes($censorword);
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_censorlist SET word = '$censorword' where id = '$cid'");
	Header("Location: modules.php?name=$modulename&file=admin&op=censorlist&edited=1");
}

function delcensorword($id) {
	global $prefix, $db, $mainprefix, $modulename, $textcolor1, $bgcolor2, $confirmed;
	if (isset($confirmed)) {
		$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_censorlist where id = '$id'");
		Header("Location: modules.php?name=$modulename&file=admin&op=censorlist&deleted=1");
	}	
	$row = $db->sql_fetchrow($db->sql_query("SELECT id, word from ".$prefix."_".$mainprefix."_censorlist where id = '$id'"));
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	$word = stripslashes($row[word]);
	admin_header();
		OpenTable();	
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"62%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <p align=\"center\"><strong>"._CLDELETINGWORD.":</strong> <i>$word</i></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._CLDELTEINGWORD2.": '$row[word]'<br />\n";
			echo "      "._BIGWARN.": "._CLACTIONUNDONE.".</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">[\n";
			echo "      <a href=\"modules.php?name=$modulename&file=admin&op=delcensorword&id=$row[id]&confirmed=1\">\n";
			echo "      "._RYES."</a> | <a href=\"modules.php?name=$modulename&file=admin&op=censorlist\">\n";
			echo "      "._RNO."</a> ]</td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  </center>\n";
			echo "</div>\n";		
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function usercontrol() {
	global $prefix, $db, $modulename, $mainprefix, $username, $usersearch, $user_prefix, $searchtype, $bgcolor2, $textcolor1, $delete;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
		if (isset($username)) {
			$usercheck = $db->sql_numrows($db->sql_query("SELECT user_id from ".$user_prefix."_users where username = '$username'"));
			if ($usercheck == 1) {
			$db->sql_query("INSERT INTO ".$prefix."_".$mainprefix."_autoapprove VALUES ('NULL', '$username')");
				OpenTable();
					echo ""._THEUSER.": <i>$username</i> "._USERADDED.".\n";
				CloseTable();
			} else {
				OpenTable();
					echo ""._THEUSER.": <i>$username</i> "._USERDOESNTEXITS.".\n";
				CloseTable();	
			}
		}
		if (isset($delete)) {
			$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_autoapprove where username = '$delete'");
				OpenTable();
					echo ""._THEUSER.": <i>$delete</i> "._HASBEENREMOVED.".\n";
				CloseTable();
		}
		if (isset($usersearch)) {
			if ($searchtype == 0) {
			$searchresult = $db->sql_query("SELECT username from ".$user_prefix."_users where username LIKE '$usersearch%'");
			} else {
			$searchresult = $db->sql_query("SELECT username from ".$user_prefix."_users where username LIKE '%$usersearch%'");	
			}
			$srnum = $db->sql_numrows($searchresult);
			if ($srnum) {
				OpenTable();
				echo "<div align=\"center\">\n";
				echo "	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"70%\">\n";
				echo "		<tr>\n";
				echo "		<form method=\"POST\" name=\"search\" action=\"modules.php?name=$modulename&file=admin\">\n";
				echo "			<td>"._USERSFOUND."\n";
				echo "			: <br />\n";
				echo "			<select size=\"1\" name=\"username\">\n";
			while(list($username) = $db->sql_fetchrow($searchresult)) {
				echo "			<option>$username</option>\n";
			}
				echo "			</select> <input type=\"submit\" value=\""._ADDUSERBUTTON."\"></td>\n";
				echo "			<input type=\"hidden\" name=\"op\" value=\"usercontrol\">\n";
				echo "			</form>\n";
				echo "		</tr>\n";
				echo "	</table>\n";
				echo "</div>\n";
				CloseTable();				
			} else {
				OpenTable();
				echo ""._NORESULTS.": <i>$usersearch</i>\n";
				CloseTable();
			}
		}	
		OpenTable();
			echo "<div align=\"center\">\n";
			echo "	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"70%\">\n";
			echo "		<tr>\n";
			echo "			<td>"._ADDANUSER.":</td>\n";
			echo "			<td>"._SEARCHFORUSER.":</td>\n";
			echo "		</tr>\n";
			echo "		<tr>\n";
			echo "		<form name=\"adduser\" method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "			<td width=\"47%\">\n";
			echo "				<p><input type=\"text\" name=\"username\" size=\"20\">\n";
			echo "				<input type=\"submit\" value=\""._ADDUSERBUTTON."\"></p>\n";		
			echo "			</td>\n";
			echo "			<input type=\"hidden\" name=\"op\" value=\"usercontrol\">\n";
			echo "			</form>\n";
			echo "			<form name=\"searchuser\" method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "			<td width=\"53%\">\n";
			echo "				<p><input type=\"text\" name=\"usersearch\" size=\"20\">\n";
			echo "				<input type=\"submit\" value=\"Search\"><br />\n";
			echo "<input type=\"radio\" value=\"0\" checked name=\"searchtype\"> "._SEARCHPMATCHES."\n";
			echo "			 <input type=\"radio\" name=\"searchtype\" value=\"1\"> "._SEARCHAMATCHES."\n";				
			echo "			</td>\n";
			echo "			<input type=\"hidden\" name=\"op\" value=\"usercontrol\">\n";
			echo "			</form>\n";
			echo "		</tr>\n";
			echo "	</table>\n";
			echo "</div>\n";		
		CloseTable();	
		OpenTable();
			echo "<div align=\"center\">\n";
			echo "	<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "		<tr>\n";
			echo "			<td align=\"center\" width=\"345\" bgcolor=\"$bgcolor2\" style=\"color: $textcolor1\">\n";
			echo "			"._UCUSERNAME."</td>\n";
			echo "			<td align=\"center\" width=\"345\" bgcolor=\"$bgcolor2\" style=\"color: $textcolor1\">\n";
			echo "			"._CLFUNCTIONS."</td>\n";
			echo "		</tr>\n";
		$userpull = $db->sql_query("SELECT id, username from ".$prefix."_".$mainprefix."_autoapprove order by username");
		while(list($id, $user) = $db->sql_fetchrow($userpull)) {	
			echo "		<tr>\n";
			echo "			<td width=\"345\" align=\"center\">$user</td>\n";
			echo "			<td width=\"345\" align=\"center\">[\n";
			echo "			<a href=\"modules.php?name=$modulename&file=admin&op=usercontrol&delete=$user\">\n";
			echo "			"._CLDELETE."</a> ]</td>\n";
			echo "		</tr>\n";
		}
			echo "	</table>\n";
			echo "</div>\n";		
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");		
}

function categories() {
	global $prefix, $db, $modulename, $mainprefix, $saved, $deleted, $subadded, $added;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();	
		if (isset($saved)) $action = ""._CATEGORYSAVED."";
		if (isset($deleted)) {
			if ($deleted == 1) { $action = ""._CATDELETE1.""; 
			} else { $action = ""._CATDELETE2.""; }}
		if (isset($added)) $action = ""._NEWCATADDED."";
		if (isset($subadded)) $action = "".SUBCATADDED."";
		if (isset($action)) {
			OpenTable();
				echo "$action\n";
			CloseTable();
		}	
		OpenTable();
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "	<tr>\n";
			echo "		<td colspan=\"3\">\n";
			echo "		<p align=\"center\"><strong>"._ADEDITCAT.":</strong></td>\n";
			echo "	</tr>\n";
			echo "	<tr>\n";
			echo "		<td colspan=\"3\">\n";
			echo "		&nbsp;</td>\n";
			echo "	</tr>\n";
			echo "	<tr>\n";
			echo "		<td width=\"193\" align=\"right\">"._ADCAT.":</td>\n";
			echo "		<td width=\"36\">\n";
			echo "			<select size=\"1\" name=\"category\">\n";
	$result3 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result7 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid3, $parentid3, $ctitle3) = $db->sql_fetchrow($result7)) {
		$ctitle3 = stripslashes($ctitle3);
    if ($parentid3!=0) $ctitle3=getparent($parentid3,$ctitle3);
			echo "<option value=\"$cid3\">$ctitle3</option>";
	 }
			echo "</select>\n";
			echo "		</td>\n";
			echo "		<td width=\"351\"><select size=\"1\" name=\"op\">\n";
			echo "		<option value=\"ModifyCat\">"._ADEDIT."</option>\n";
			echo "		<option value=\"DelCat\">"._ADDELETE."</option>\n";
			echo "		</select> <input type=\"submit\" value=\""._ADGOBUTTON."!\"></td>\n";
			echo "	</tr>\n";
			echo "</table>\n";
			echo "</form>\n";
		CloseTable();
		OpenTable();
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" align=\"center\"><strong>"._ADADDNEWCAT.":</strong></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" align=\"center\"><strong>"._ADTITLE.": <input size=\"32\" name=\"title\"><br />\n";
			echo "      "._ADDESCRIP.":<br />\n";
			echo "      <textarea name=\"description\" rows=\"4\" cols=\"32\"></textarea><br />\n";
			echo "      <br />\n";
			echo "      <input type=\"submit\" value=\""._ADADD."\"></strong></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"AddNewCat\">\n";
			echo "</form>\n";
		CloseTable();
		OpenTable();
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" align=\"center\"><strong>"._ADNEWSUBCAT.":</strong></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" align=\"center\"><strong>"._ADPCAT.":\n";
			echo "      <select size=\"1\" name=\"parentcategory\">\n";
	$result10 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result11 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid11, $parentid11, $ctitle11) = $db->sql_fetchrow($result11)) {
		$ctitle11 = stripslashes($ctitle11);
    if ($parentid11!=0) $ctitle11=getparent($parentid11,$ctitle11);
  			echo "<option value=\"$cid11\">$ctitle11</option>";
  	}
			echo "      </select><br />\n";
			echo "      "._ADTITLE.": <input size=\"32\" name=\"subtitle\"><br />\n";
			echo "      "._ADDESCRIP.":<br />\n";
			echo "      <textarea name=\"subdescription\" rows=\"4\" cols=\"32\"></textarea><br />\n";
			echo "      <br />\n";
			echo "      <input type=\"submit\" value=\""._ADADD."\"></strong></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"AddNewSubCat\">\n";
			echo "</form>\n";
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");		
}

function ModifyCat($category) {
	global $admin, $prefix, $db, $modulename, $mainprefix;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
		OpenTable();
  	$result = $db->sql_query("SELECT id, title, description FROM ".$prefix."_".$mainprefix."_categories  where id = $category");
	while(list($id, $title, $description) = $db->sql_fetchrow($result)) {
		$title = stripslashes($title);
		$description = stripslashes($description);
			echo "	<form method=\"POST\">\n"
  			."			<table border=\"0\" width=\"100%\">\n"
    		."				<tr>\n"
      		."					<td width=\"100%\"><strong>"._EDITACAT.":</strong></td>\n"
    		."				</tr>\n"
			."				<tr>\n"
      		."					<td width=\"100%\">"._ID.":&nbsp;&nbsp;&nbsp;\n"
      		."					<input type=\"text\" readOnly name=\"id\" size=\"4\" value=\"$id\"></td>\n"
    		."				</tr>\n"
    		."				<tr>\n"
      		."					<td width=\"100%\">"._NCATITLE.":\n"
      		."						<input type=\"text\" name=\"title\" size=\"25\" value=\"$title\"></td>\n"
    		."				</tr>\n"
    		."				<tr>\n"
      		."					<td width=\"100%\">"._NCADESCRIP.":</td>\n"
    		."				</tr>\n"
    		."				<tr>\n"
      		."					<td width=\"100%\"><textarea rows=\"4\" name=\"description\" cols=\"25\">$description</textarea></td>\n"
    		."				</tr>\n"
    		."				<tr>\n"
    	  	."					<td width=\"100%\"><br />\n"
        	."						<input type=\"hidden\" name=\"op\" value=\"ModifyCatSave\">\n"
      		."						<input type=\"submit\" value=\""._SAVECHANGES."\">\n"
      		."					</td>\n"
    		."				</tr>\n"
  			."			</table>\n"
			."		</form>\n";
	}
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ModifyCatSave($id, $title, $description) {
	global $prefix, $db, $id, $modulename, $mainprefix;
	$title = addslashes($title);
	$description = addslashes($description);
	$db->sql_query("update ".$prefix."_".$mainprefix."_categories SET id='$id', title='$title', description='$description' where id=$id");
	Header("Location: modules.php?name=$modulename&file=admin&op=categories&saved=1");
}

function DelCat($category) {
	global $prefix, $db, $id, $modulename, $mainprefix, $did, $parentid;
	$id = intval($category);
		if (isset($did)) {
			$db->sql_query("delete from ".$prefix."_".$mainprefix."_categories where id=$id");
			$delcode = 1;
				if ($parentid == 0) {
					$db->sql_query("delete from ".$prefix."_".$mainprefix."_categories where parentid='$id'");
					$delcode = 2;
				}
			Header("Location: modules.php?name=$modulename&file=admin&op=categories&deleted=$delcode");			
		}		
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
		OpenTable();
	$result = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories  where id = $id");
	while(list($id, $parentid, $title) = $db->sql_fetchrow($result)) {
		echo "	<table border=\"0\" width=\"100%\">\n"
  		."			<tr>\n"
    	."				<td width=\"100%\" align=\"center\"><strong>"._DELETE1.": </strong></td>\n"
  		."			</tr>\n"
  		."			<tr>\n"
    	."				<td width=\"100%\" align=\"center\">"._DELETECONFIRM.": <strong>\n"
    	."					$title</strong>\n";
    if ($parentid == 0) {
    	echo "				<br />"._NOTE2."\n";
    }
    	echo "			</td>\n"
  		."			</tr>\n"
  		."			<tr>\n"
    	."				<td width=\"100%\" align=\"center\"><strong>"._DELETEWARNBIG.": </strong>"._DELETE2."</td>\n"
  		."			</tr>\n"
  		."			<tr>\n"
    	."				<td width=\"100%\" align=\"center\">[ \n"
    	."					<a href=\"modules.php?name=$modulename&file=admin&op=DelCat&did=$id&parentid=$parentid\">"._YES."</a> | \n"
    	."					<a href=\"modules.php?name=$modulename&file=admin\">"._NO."</a> ]</td>\n"
  		."			</tr>\n"
		."		</table>\n";
	}
		CloseTable();
	admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function AddNewCat($title, $description) {
	global $prefix, $db, $modulename, $mainprefix;
	$title = addslashes($title);
	$description = addslashes($title);
	$result = $db->sql_query("INSERT INTO ".$prefix."_".$mainprefix."_categories VALUES (NULL, '0', '$title', '$description')");
	Header("Location: modules.php?name=$modulename&file=admin&op=categories&added=1");
}

function AddNewSubCat($parentcategory, $subtitle, $subdescription) {
	global $prefix, $db, $modulename, $mainprefix;
	$subtitle = addslashes($subtitle);
	$subdescription = addslashes($subdescription);
	$result = $db->sql_query("INSERT INTO ".$prefix."_".$mainprefix."_categories VALUES (NULL, '$parentcategory', '$subtitle', '$subdescription')");
	Header("Location: modules.php?name=$modulename&file=admin&op=categories&subadded=1");
}

function requestadmin() {
	global $prefix, $db, $mainprefix, $modulename, $bgcolor2, $deleted, $added;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();	
		if (isset($deleted)) $action = ""._REQUESTDELETED."";
		if (isset($added)) $action = ""._REQUESTADDED."";
		if (isset($action)) {
			OpenTable();
				echo "$action\n";
			CloseTable();	
		}
		OpenTable();
			echo "		<table border=\"0\" width=\"100%\">\n"
  			."				<tr>\n"
    		."					<td width=\"51%\"><strong>"._TITLE."</strong></td>\n"
   	 		."					<td width=\"25%\" align=\"center\"><strong>"._RSUBMIT."</strong></td>\n"
    		."					<td width=\"24%\" align=\"center\"><strong>"._FUNCTION."</strong></td>\n"
  			."				</tr>\n";
  	$result = $db->sql_query("SELECT id, itemtitle, submitter FROM ".$prefix."_".$mainprefix."_requests where approved='0'");
	while(list($id, $itemtitle, $submitter) = $db->sql_fetchrow($result)) {
	  		echo "			<tr>\n";
    		echo "				<td width=\"51%\">$itemtitle</td>\n";
    		echo "				<td width=\"25%\" align=\"center\">$submitter</td>\n";
    		echo "				<td width=\"24%\" align=\"center\">[ \n"
    		."						<a href=\"modules.php?name=$modulename&file=admin&op=requestcontrol&id=$id&mode=1\">"._DELETE."</a> ] [ <a href=\"modules.php?name=$modulename&file=admin&op=requestcontrol&id=$id&mode=2\">"._APPROVEREQUEST."</a> ]</td>\n";
			echo "			</tr>\n";
	}
			echo "		</table>\n";
		CloseTable();
		OpenTable();
			echo "		<table border=\"0\" width=\"100%\">\n"
  			."				<tr>\n"
    		."					<td width=\"51%\"><strong>"._TITLE."</strong></td>\n"
   	 		."					<td width=\"25%\" align=\"center\"><strong>"._RSUBMIT."</strong></td>\n"
    		."					<td width=\"24%\" align=\"center\"><strong>"._FUNCTION."</strong></td>\n"
  			."				</tr>\n";
  	$result2 = $db->sql_query("SELECT id, itemtitle, submitter FROM ".$prefix."_".$mainprefix."_requests where approved='1'");
	while(list($id, $itemtitle, $submitter) = $db->sql_fetchrow($result2)) {
	  		echo "			<tr>\n";
    		echo "				<td width=\"51%\">$itemtitle</td>\n";
    		echo "				<td width=\"25%\" align=\"center\">$submitter</td>\n";
    		echo "				<td width=\"24%\" align=\"center\">[ \n"
    		."						<a href=\"modules.php?name=$modulename&file=admin&op=requestcontrol&id=$id&mode=1\">"._DELETE."</a> ] </td>\n";
			echo "			</tr>\n";
	}
			echo "		</table>\n";
		CloseTable();
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function requestcontrol() {
	global $prefix, $db, $modulename, $mainprefix, $id, $mode, $confirmed;
	if ($mode == 1) {
		if ($confirmed == 1) {
			$db->sql_query("delete from ".$prefix."_".$mainprefix."_requests where id=$id");
			Header("Location: modules.php?name=$modulename&file=admin&op=requestadmin&deleted=1");			
		} else {
			@include_once("header.php");
			@include_once("modules/$modulename/includes/js.php");
			admin_header();
				OpenTable();				
			$result = $db->sql_query("SELECT itemtitle FROM ".$prefix."_".$mainprefix."_requests  where id = $id");
			while(list($title) = $db->sql_fetchrow($result)) {
				echo "		<table border=\"0\" width=\"100%\">\n"
				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\"><strong>"._DELETEITEMTOP."</strong></td>\n"
  				."				</tr>\n"
  				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  				."				</tr>\n"
  				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\">"._DELETEITEM.": \n"
    			."						$title\n"
    			."					</td>\n"
  				."				</tr>\n"
  				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\"><strong>"._DELETEWARNBIG.": </strong>"._DELETE2."</td>\n"
  				."				</tr>\n"
  				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  				."				</tr>\n"
  				."				<tr>\n"
    			."					<td width=\"100%\" align=\"center\">[\n"
    			."	 					<a href=\"modules.php?name=$modulename&file=admin&op=requestcontrol&id=$id&mode=1&confirmed=1\">"._YES."</a> | \n"
    			." 						<a href=\"modules.php?name=$modulename&file=admin&op=requestadmin\">"._NO."</a> ]</td>\n"
  				."				</tr>\n"
				."			</table>\n";
			}
				CloseTable();
			admin_footer();
			@include_once("modules/$modulename/includes/credit-line.php");
			@include_once("footer.php");			
		}	
	} else {
		$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_requests SET approved='1'");
		Header("Location: modules.php?name=$modulename&file=admin&op=requestadmin&added=1");		
	}
}

function relatedadmin() {
	global $prefix, $db, $mainprefix, $modulename, $bgcolor3, $catid, $added, $saved, $deleted;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	admin_header();
	if (isset($catid)) {
		$catid = $catid;
	} else {
		$catid = 0;
	}
	if (isset($added)) $action = ""._RELATEDLADDED."";
	if (isset($saved)) $action = ""._RELATEDLSAVED."";
	if (isset($deleted)) $action = ""._RELATEDLDELETED."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\"><strong><i>"._RLINKTITLE."</i></strong></td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "      <tr>\n";
			echo "        <td width=\"38%\" bgcolor=\"$bgcolor3\" align=\"center\">"._RLINK."</td>\n";
			echo "        <td width=\"35%\" bgcolor=\"$bgcolor3\" align=\"center\">"._RATTACHED.":</td>\n";
			echo "        <td width=\"27%\" bgcolor=\"$bgcolor3\" align=\"center\">"._RFUNCTIONS."</td>\n";
			echo "      </tr>\n";
	$sql = $db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_related");
	$total = $db->sql_numrows($sql);
		if ($total > 0) {
		while(list($rid, $tid, $linktitle, $url) = $db->sql_fetchrow($sql)) {
			$sql2 = $db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_items where id = '$tid'");
			$itemname = $db->sql_fetchrow($sql2);
			$itemname = stripslashes($itemname[title]);
			echo "      <tr>\n";
			echo "        <td width=\"38%\" align=\"center\">\n";
			echo "        <p align=\"left\"><a href=\"$url\">$linktitle</a></td>\n";
			echo "        <td width=\"35%\" align=\"center\">\n";
			echo "        <p align=\"left\">$itemname</td>\n";
			echo "        <td width=\"27%\" align=\"center\">[\n";
			echo "        <a href=\"modules.php?name=$modulename&file=admin&op=EditRelatedLink&id=$rid\">\n";
			echo "        Edit</a> ] [\n";
			echo "        <a href=\"modules.php?name=$modulename&file=admin&op=RelatedDel&id=$rid\">\n";
			echo "        Delete </a>]</td>\n";
			echo "      </tr>\n";
		}
	}
			echo "    </table>\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
		OpenTable();
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">"._ADDRELATED2."</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <div align=\"center\">\n";
			echo "        <center>\n";
			echo "        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"64%\">\n";			
			echo "			<tr>\n";
			echo "			  <td width=\"25%\">Category:</td>\n";
			echo "			  <td width=\"75%\"><select size\"1\" name\"xcat_id\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "				<option value=\"\">-- Please select a category -- </option>\n";
			echo "				<option value=\"\">-----------------------</option>\n";
	$result3 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result7 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid3, $parentid3, $ctitle3) = $db->sql_fetchrow($result7)) {
		$ctitle3 = stripslashes($ctitle3);
		if ($cid3 == $catid) $sel = " selected";
    if ($parentid3!=0) $ctitle3=getparent($parentid3,$ctitle3);
			echo "<option$sel value=\"modules.php?name=$modulename&file=admin&op=relatedadmin&catid=$cid3\">$ctitle3</option>";
			$sel = "";
	 }	
			echo "				</select></td>\n";
			echo "			</tr>\n";
	if (!$catid == 0)	{
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._RITEM.":</td>\n";
			echo "            <td width=\"75%\"><select size=\"1\" name=\"xitem_id\">\n";
	$sql = $db->sql_query("SELECT id, title from ".$prefix."_".$mainprefix."_items where parentid = '$catid'");
	while (list($item_id, $item_name) = $db->sql_fetchrow($sql)) {
		$item_name = stripslashes($item_name);
			echo "            <option value=\"$item_id\">$item_name</option>\n";
	}
			echo "            </select></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._LINKTITLE.":</td>\n";
			echo "            <td width=\"75%\"><input type=\"text\" name=\"xlinktitle\" size=\"26\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._LINKURL.":</td>\n";
			echo "            <td width=\"75%\"><input type=\"text\" name=\"xlinkurl\" size=\"26\"></td>\n";
			echo "          </tr>\n";	
	} else {
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._RITEM.":</td>\n";
			echo "            <td width=\"75%\">\n";
			echo "				"._SELECTCAT."...\n";
			echo "            </td>\n";
			echo "          </tr>\n";		
	}
			echo "          <tr>\n";
			echo "            <td width=\"25%\">&nbsp;</td>\n";
			echo "            <td width=\"75%\">&nbsp;</td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"100%\" colspan=\"2\">\n";
			echo "            <p align=\"center\"><input type=\"submit\" value=\""._ADDRELATED."\"></td>\n";
			echo "          </tr>\n";
			echo "        </table>\n";
			echo "        </center>\n";
			echo "      </div>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"addrelatedlink\">\n";
			echo "</form>\n";
		CloseTable();		
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function addrelatedlink($xlinktitle, $xlinkurl, $xitem_id) {
	global $prefix, $db, $mainprefix, $modulename;
	$xlinktitle2 = addslashes($xlinktitle);
	$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_related VALUES ('NULL', '$xitem_id', '$xlinktitle2', '$xlinkurl')");
	Header("Location: modules.php?name=$modulename&file=admin&op=relatedadmin&added=1");
}

function EditRelatedLink() {
	global $prefix, $db, $mainprefix, $modulename, $catid, $id;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();
	$sql = $db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_related where rid = '$id'");
	$row = $db->sql_fetchrow($sql);
	if (isset($catid)) {
		$catid = $catid;
	} else {
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT parentid from ".$prefix."_".$mainprefix."_items where id = '$row[tid]'"));
		$catid = $row2[parentid];
	}
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">"._EDITRLINK."</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">"._SWITCHWARNING."</td>\n";
			echo "    </tr>\n";			
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <div align=\"center\">\n";
			echo "        <center>\n";
			echo "        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"64%\">\n";
			echo "			<tr>\n";
			echo "			  <td width=\"25%\">Category:</td>\n";
			echo "			  <td width=\"75%\"><select size\"1\" name\"xcat_id\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "				<option value=\"\">-- Please select a category -- </option>\n";
			echo "				<option value=\"\">-----------------------</option>\n";
	$result3 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result7 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid3, $parentid3, $ctitle3) = $db->sql_fetchrow($result7)) {
		$ctitle3 = stripslashes($ctitle3);
		if ($cid3 == $catid) $sel = " selected";
    if ($parentid3!=0) $ctitle3=getparent($parentid3,$ctitle3);
			echo "<option$sel value=\"modules.php?name=$modulename&file=admin&op=EditRelatedLink&id=$id&catid=$cid3\">$ctitle3</option>";
			$sel = "";
	 }	
			echo "				</select></td>\n";
			echo "			</tr>\n";			
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._RITEM.":</td>\n";
			echo "            <td width=\"75%\"><select size=\"1\" name=\"xitem_id\">\n";
	$sql = $db->sql_query("SELECT id, title from ".$prefix."_".$mainprefix."_items where parentid = '$catid'");
	while (list($item_id, $item_name) = $db->sql_fetchrow($sql)) {
		$item_name = stripslashes($item_name);
		if ($row[tid] == $item_id) {
			$sel = "selected";
		}
			echo "            <option $sel value=\"$item_id\">$item_name</option>\n";
			$sel = "";
	}
			echo "            </select></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._LINKTITLE.":</td>\n";
			echo "            <td width=\"75%\"><input type=\"text\" name=\"xlinktitle\" size=\"26\" value=\"$row[name]\"></td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"25%\">"._LINKURL.":</td>\n";
			echo "            <td width=\"75%\"><input type=\"text\" name=\"xlinkurl\" size=\"26\" value=\"$row[url]\"></td>\n";
			echo "          </tr>\n";			
			echo "          <tr>\n";
			echo "            <td width=\"25%\">&nbsp;</td>\n";
			echo "            <td width=\"75%\">&nbsp;</td>\n";
			echo "          </tr>\n";
			echo "          <tr>\n";
			echo "            <td width=\"100%\" colspan=\"2\">\n";
			echo "            <p align=\"center\"><input type=\"submit\" value=\""._SAVERELATED."\"></td>\n";
			echo "          </tr>\n";
			echo "        </table>\n";
			echo "        </center>\n";
			echo "      </div>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  <input type=\"hidden\" name=\"xrid\" value=\"$row[rid]\">\n";
			echo "  <input type=\"hidden\" name=\"op\" value=\"saverelatedlink\">\n";
			echo "</form>\n";
		CloseTable();
	admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function saverelatedlink($xrid, $xlinktitle, $xlinkurl, $xitem_id) {
	global $prefix, $db, $mainprefix, $modulename;
	$xlinktitle2 = addslashes($xlinktitle);
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_related SET tid='$xitem_id', name='$xlinktitle2', url='$xlinkurl' where rid='$xrid'");
	Header("Location: modules.php?name=$modulename&file=admin&op=relatedadmin&saved=1");
}

function RelatedDel() {
	global $prefix, $db, $mainprefix, $modulename, $confirmed, $id;
	if (isset($confirmed)) {
		$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_related where rid = '$id'");
		Header("Location: modules.php?name=$modulename&file=admin&op=relatedadmin&deleted=1");
	}
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();
		$linktitle = $db->sql_fetchrow($db->sql_query("SELECT tid, name from ".$prefix."_".$mainprefix."_related where rid = '$id'"));
		$attacheditem = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_items where id = '$linktitle[tid]'"));
			echo "<table width=\"100%\" border=\"0\">\n";
			echo "  <tr>\n";
			echo "    <td align=\"middle\" width=\"100%\">"._DELRELATEDLINK."\n";
			echo "    : $linktitle[name]<br />\n";
			echo "    "._ATTACHEDITEM.": $attacheditem[title]</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td align=\"middle\" width=\"100%\"><strong>"._WARNINGBIG.": </strong>"._WARNMESS."\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td align=\"middle\" width=\"100%\">&nbsp;</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td align=\"middle\" width=\"100%\">[\n";
			echo "    <a href=\"modules.php?name=$modulename&file=admin&op=RelatedDel&id=$id&confirmed=1\">\n";
			echo "    "._RYES."</a> | <a href=\"modules.php?name=$modulename&file=admin\">"._RNO."</a> ]</td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function additem() {
	global $prefix, $db, $user, $cookie, $admin, $modulename, $mainprefix;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");
		admin_header();
		OpenTable();
?>
	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php

	// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
	// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}			
			echo "	<tr><td></td></tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	//$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    		echo "      <option value=\"$cid2\">$ctitle2</option>\n";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" onMouseOver=\"helpline('author')\" maxlength=\"100\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" onMouseOver=\"helpline('title')\" maxlength=\"120\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
	if (is_user($user)) {
	cookiedecode($user);
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" onMouseOver=\"helpline('username1')\" maxlength=\"100\" value=\"$cookie[1]\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
		$femailcheck = $db->sql_fetchrow($db->sql_query("SELECT femail from ".$prefix."_users where username = '$cookie[1]'"));
		if ($femailcheck) {
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" onMouseOver=\"helpline('femail1')\" size=\"27\" maxlength=\"120\" value=\"$femailcheck[femail]\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
		} else {
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" onMouseOver=\"helpline('femail2')\" size=\"27\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
		}
	} else {
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" onMouseOver=\"helpline('username2')\" maxlength=\"100\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" onMouseOver=\"helpline('femail2')\" size=\"27\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
	}
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" onMouseOver=\"helpline('descript')\" size=\"27\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";			
			echo "</td>\n";
			
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			
			echo "      <td width=\"80%\">\n";
			echo "<textarea rows=\"17\" name=\"content\" cols=100% wrap=\"virtual\" class=\"postnew\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\"></textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\"><option value=\"previewitemform\">"._NEWPREVIEW."</option>\n";
			echo "      <option value=\"postitemdata\">"._NEWPOST."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">\n";	
		}				
			echo "</form>\n";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function postitemdata($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
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
	$content2 = insert_bbcode_uid($content2, $bbcode_uid);
	$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_items VALUES ('NULL', '$newcategory', '$itemauthor2', '$itemwebsite', '$itemtitle2', '$descrip2', '0', '0', '0', '$content2', '$submitter2', '$datea', NULL, '0', '$email', '$bbcode_uid', '$itemlang', '1')");
	Header("Location: modules.php?name=$modulename&file=admin&item_added=1");
}

function previewitemform($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix, $user, $cookie;
	checktitle($itemtitle);
	checkbad($content);
	errors();
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");
		admin_header();
    $bbcode_uid = make_bbcode_uid();
    $content3 = insert_bbcode_uid($content, $bbcode_uid);
	$formattedcontent = parse_bbcode($content3,$bbcode_uid);		
		    	//$formattedcontent = nl2br($content3);
		OpenTable();
?>
	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			echo "		<table border=\"0\" width=\"100%\">\n"
			."				<tr>\n"
			."					<td width=\"100%\" valign=\"top\">\n"
			."						<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."				</tr>\n"
			."			</table>\n";
		CloseTable();
		OpenTable();
			echo "		<table border=\"0\" width=\"100%\">\n"
			."				<tr>\n"
			."					<td width=\"100%\">\n"
			."						<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."				</tr>\n"
			."				<tr>\n"
			."					<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."							<tr>\n"
			."								<td width=\"100%\">\n"
			."									$formattedcontent</td>\n"
			."							</tr>\n"
			."							</table>\n"
			."					</td>\n"
			."				</tr>\n"
			."				<tr>\n"
			."					<td width=\"100%\">\n"
			."						<p align=\"center\">&nbsp;"._PREVIEWREQUEST."</td>\n"
			."				</tr>\n"
			."			</table>\n";
		CloseTable();
		OpenTable();
		// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
		if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
		}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
	// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$newcategory) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($itemauthor)."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"$itemwebsite\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($itemtitle)."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($submitter)."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" onMouseOver=\"helpline('femail1')\" value=\"$email\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($descrip)."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
			$content2 = stripslashes($content);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content2</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\"><option value=\"previewitemform\">"._NEWPREVIEW."</option>\n";
			echo "      <option value=\"postitemdata\">"._NEWPOST."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">\n";	
		}				
			echo "</form>\n";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function item_list($page) {
	global $prefix, $db, $modulename, $mainprefix, $start, $cat_limit, $limit, $squery, $deleted, $saved;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/pagenumbering.php");
		admin_header();	
	if (isset($deleted)) $action = ""._ITEMDELETED."";
	if (isset($saved)) $action = ""._ITEMSAVED."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}	
		if (isset($start)) {
			$start = $start;
		} else {
			$start = 0;
		}
	if (isset($squery)) {
		$searchresult = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items where title LIKE '%$squery%'");	
		$sresults = $db->sql_numrows($searchresult);
		if ($sresults == 0) {
			$smessage = ""._SNORESULTS.".\n";
			$squery2 = "";	
		} else {
			$smessage = ""._SFRESULTS.": <i>$squery</i>\n";
			$squery2 = "and title LIKE '%$squery%'";	
			if (!isset($cat_limit) OR !isset($limit)) $query = "where title LIKE '%$squery%'";			
		}
	}			
		if (isset($cat_limit)) $query = "where parentid = '$cat_limit' $squery2";
		if (isset($cat_limit)) $nquery2 = "&amp;cat_limit=$cat_limit";
		if (isset($limit)) $query = "where UPPER(title) LIKE '$limit%'";
		if (isset($limit)) $lquery2 = "&amp;limit=$limit";
		if (isset($cat_limit) AND isset($limit)) $query = "where parentid = '$cat_limit' and UPPER(title) LIKE '$limit%'";
	if (getconfigvar("phpbb_pages") == 0) {
		list ($offset, $pages, $page, $mwpages) = generate_pagination_pages(); 
	}
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "	<tr>\n";
			echo "	<form name=\"squery\" method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "		<td width=\"229\">\n";
			echo "			<input type=\"text\" name=\"squery\" size=\"32\">\n";
			echo "			<input type=\"submit\" value=\""._SEARCHBUTTON."\">\n";
			echo "		<input type=\"hidden\" name=\"op\" value=\"item_list\">\n";
	if (isset($cat_limit))	echo "		<input type=\"hidden\" name=\"cat_limit\" value=\"$cat_limit\">\n";
	if (isset($limit))		echo "		<input type=\"hidden\" name=\"limit\" value=\"$limit\">\n";
			echo "		</td>\n";
			echo "		</form>\n";
			echo "		<td align=\"center\"><select size=\"1\" name=\"cat_id\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "      <option value=\"modules.php?name=$modulename&file=admin&op=item_list$lquery2\">-- Limit by Category --</option>\n";
	$result3 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result7 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid3, $parentid3, $ctitle3) = $db->sql_fetchrow($result7)) {
		$ctitle3 = stripslashes($ctitle3);
    if ($parentid3!=0) $ctitle3=getparent($parentid3,$ctitle3);
    	if ($cid3 == $cat_limit) $sel = "selected";
			echo "<option $sel value=\"modules.php?name=$modulename&file=admin&op=item_list&cat_limit=$cid3$lquery2\">$ctitle3</option>";
			$sel = "";
	 }			
			echo "		</select></td>\n";
			echo "		<td width=\"27\"><select size=\"1\" name=\"limit\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "      <option value=\"modules.php?name=$modulename&file=admin&op=item_list$nquery2\">"._CIALL."";
			echo "      </option>";
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
    	if ($ltr==$limit) { $sel = " selected"; }
			echo "      <option$sel value=\"modules.php?name=$modulename&file=admin&op=item_list$nquery2&limit=$ltr\">$ltr</option>\n";
        $counter++;
        $sel = '';
    }				
			echo "		</select></td>\n";
			echo "	</tr>\n";
			echo "</table>\n";
		CloseTable();	
		OpenTable();
			echo "		<table border=\"0\" width=\"100%\">\n";
	if (isset($smessage)) {
		echo "<tr>\n";
		echo "	<td width=\"51%\">\n";	
		echo "		$smessage";
		echo "	</td>\n";
		echo "</tr>\n";
	}
  			echo "				<tr>\n"
    		."					<td width=\"51%\"><strong>"._TITLE."</strong></td>\n"
   	 		."					<td width=\"25%\" align=\"center\"><strong>"._CATEGORY."</strong></td>\n"
    		."					<td width=\"24%\" align=\"center\"><strong>"._FUNCTION."</strong></td>\n"
  			."				</tr>\n";
  	if (getconfigvar("phpbb_pages") == 0) {
  		$result = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_items $query limit $offset,$mwpages");
  	} else {
 		$result = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_items $query limit $start,40"); 		
  	}
	while(list($id, $parentid, $title) = $db->sql_fetchrow($result)) {
		  $result2 = $db->sql_query("SELECT parentid, title FROM ".$prefix."_".$mainprefix."_categories where id = $parentid");
	  	  while(list($parentid2, $title2) = $db->sql_fetchrow($result2)) {
	  	  	if (!$parentid2 == 0) {
	  	  		$sql = $db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_categories where id = '$parentid2'");
	  	  		list($title2) = $db->sql_fetchrow($sql);
	  	  		$title2 = stripslashes($title2);
	  	  	}
	  	  	$title = stripslashes($title);
	  		echo "			<tr>\n";
    		echo "				<td width=\"51%\"><a href=\"modules.php?name=$modulename&file=admin&op=modifyitem&id=$id\">$title</a></td>\n";
    		echo "				<td width=\"25%\" align=\"center\">$title2</td>\n";
    		echo "				<td width=\"24%\" align=\"center\">[ \n"
    		."						<a href=\"modules.php?name=$modulename&file=admin&op=DelItem&id=$id\">"._DELETE."</a> ] [ <a href=\"modules.php?name=$modulename&file=admin&op=modifyitem&id=$id\">"._MODIFY."</a> ]</td>\n";
			echo "			</tr>\n";
		}
	}
			echo "		</table>\n";
	if (getconfigvar("phpbb_pages") == 0) {
	   generate_pagination_old($page, $pages, $modulename, $nquery2, $lquery2);
	}
		CloseTable();
	if (getconfigvar("phpbb_pages") == 1) {	
			$per_page = 40;
			$topics_count = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_".$mainprefix."_items $query"));		
	if ($topics_count > $per_page) {
		OpenTable();
			$page_string = generate_pagination_phpbb("modules.php?name=$modulename&file=admin&op=item_list$nquery2$lquery2", $topics_count, $per_page, $start);	
			echo "<div align=\"center\">$page_string</div>\n";
		CloseTable();
	}
		}
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function readimagedir() {
	global $modulename;
	echo "<br /><br /><select onClick=\"javascript:IMG()\" size=\"5\" name=\"image\" onMouseOver=\"helpline('imageinsert')\">\n";
	if ($dir = @opendir("modules/$modulename/images/uploaded")) { 
 		while (($file = readdir($dir)) !== false) { 
		if($file=="." or $file=="..") continue;
			echo "<option value=\"$file\">$file</option>\n";
 		}   
 	closedir($dir); 
 	echo "</select>\n";
}
} 	

function DelItem() {
	global $prefix, $db, $modulename, $mainprefix, $confirmed, $id;
	if (isset($confirmed)) {
		$db->sql_query("delete from ".$prefix."_".$mainprefix."_items where id=$id");
		Header("Location: modules.php?name=$modulename&file=admin&op=item_list&deleted=1");
	}
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();
	$result = $db->sql_query("SELECT parentid, title FROM ".$prefix."_".$mainprefix."_items  where id = $id");
	while(list($parentid, $title) = $db->sql_fetchrow($result)) {
		$cattitle = $db->sql_fetchrow($db->sql_query("SELECT parentid, title from ".$prefix."_".$mainprefix."_categories where id = '$parentid'"));
			if (!$cattitle[parentid] == 0) {
	  	  		$sql = $db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_categories where id = '$cattitle[parentid]'");
	  	  		list($title) = $db->sql_fetchrow($sql);
	  	  		$ctitle = stripslashes($title);
	  	  	} else {
	  	  		$ctitle = stripslashes($cattitle[title]);
	  	  	}
		$title = stripslashes($title);
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEITEMTOP."</strong></td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">"._DELETEITEM.": \n"
    		."$ctitle: $title</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEWARNBIG.": </strong>"._DELETE2."</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">[\n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=DelItem&id=$id&confirmed=1\">"._YES."</a> | \n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=item_list\">"._NO."</a> ]</td>\n"
  			."</tr>\n"
			."</table>\n";
	}
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function modifyitem() {
	global $prefix, $db, $mainprefix, $modulename, $id;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");
		admin_header();
	$row = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_items where id = '$id'"));
		$formattedcontent = parse_bbcode($row[content],$row[bbcode_uid]);
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."<p>&nbsp;</td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();

?>

	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$row[parentid]) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($row[author])."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($row[website])."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($row[title])."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($row[submitter])."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$row[youremail]\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($row[description])."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
		$content2 = ($row[bbcode_uid] != '') ? preg_replace("/:(([a-z0-9]+:)?)".$row[bbcode_uid]."(=|\])/si",'\\3',$row[content]) : $row[content];
		$content2 = stripslashes($row[content]);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content2</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"modifypreviewform\">"._NEWPREVIEW."</option>";
			echo "      <option value=\"modifyitemsave\">"._NEWPOST."</option>";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"olddate\" value=\"$row[date]\">\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$row[id]\">\n";
			echo "	<input type=\"hidden\" name=\"votes\" value=\"$row[votes]\">\n";
			echo "	<input type=\"hidden\" name=\"rating\" value=\"$row[rating]\">\n";
			echo "	<input type=\"hidden\" name=\"comments\" value=\"$row[comments]\">\n";
			echo "	<input type=\"hidden\" name=\"views\" value=\"$row[views]\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$row[bbcode_uid]\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function modifyitemsave($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
	@require_once("modules/$modulename/includes/bbstuff.php");
	$datea = date("Y-m-d H:i:s");
	$content2= addslashes($content);
	$descrip2= addslashes($descrip);
	$submitter2= addslashes($submitter);
	$itemtitle2= addslashes($itemtitle);
	$itemauthor2= addslashes($itemauthor);
	$content2 = insert_bbcode_uid($content2, $bbcode_uid);
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET parentid='$newcategory', author='$itemauthor2', website='$itemwebsite', title='$itemtitle2', description='$descrip2', votes='$votes', rating='$rating', comments='$comments', content='$content2', submitter='$submitter2', date='$olddate', lastdate='$datea', views='$views', youremail='$email', language = '$itemlang' where id='$id'");
	Header("Location: modules.php?name=$modulename&file=admin&op=item_list&saved=1");
}

function modifypreviewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang) {
	global $prefix, $db, $mainprefix, $modulename;
	checkbad($content);
	errors();
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");	
		admin_header();
		$formattedcontent = insert_bbcode_uid($content, $bbcode_uid);
		$formattedcontent = parse_bbcode($formattedcontent,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."</td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
?>

	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$newcategory) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($itemauthor)."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($itemwebsite)."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($itemtitle)."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($submitter)."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$email\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($descrip)."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
		$content2 = stripslashes($content);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content2</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"modifypreviewform\">"._NEWPREVIEW."</option>";
			echo "      <option value=\"modifyitemsave\">"._NEWPOST."</option>";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"olddate\" value=\"$olddate\">\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
			echo "	<input type=\"hidden\" name=\"votes\" value=\"$votes\">\n";
			echo "	<input type=\"hidden\" name=\"rating\" value=\"$rating\">\n";
			echo "	<input type=\"hidden\" name=\"comments\" value=\"$comments\">\n";
			echo "	<input type=\"hidden\" name=\"views\" value=\"$views\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$bbcode_uid\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");	
}

function itemcontrol() {
	global $prefix, $db, $modulename, $mainprefix, $start, $page, $cat_limit, $limit, $squery, $mode, $id;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/pagenumbering.php");
		admin_header();	
	if (isset($mode)) {
		if ($mode == "active") {
			$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET active = '1' where id = '$id'");
			$action = ""._ITEMACTIVATED."";	
		} else {
			$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET active = '0' where id = '$id'");
			$action = ""._ITEMDEACTIVATED."";
		}	
	}
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}
		if (isset($start)) {
			$start = $start;
		} else {
			$start = 0;
		}
	if (isset($squery)) {
		$searchresult = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items where title LIKE '%$squery%'");	
		$sresults = $db->sql_numrows($searchresult);
		if ($sresults == 0) {
			$smessage = ""._SNORESULTS.".\n";
			$squery2 = "";	
		} else {
			$smessage = ""._SFRESULTS.": <i>$squery</i>\n";
			$squery2 = "and title LIKE '%$squery%'";	
			if (!isset($cat_limit) OR !isset($limit)) $query = "where title LIKE '%$squery%'";			
		}
	}			
		if (isset($cat_limit)) $query = "where parentid = '$cat_limit' $squery2";
		if (isset($cat_limit)) $nquery2 = "&amp;cat_limit=$cat_limit";
		if (isset($limit)) $query = "where UPPER(title) LIKE '$limit%'";
		if (isset($limit)) $lquery2 = "&amp;limit=$limit";
		if (isset($cat_limit) AND isset($limit)) $query = "where parentid = '$cat_limit' and UPPER(title) LIKE '$limit%'";		
	if (getconfigvar("phpbb_pages") == 0) {
		list ($offset, $pages, $page, $mwpages) = generate_pagination_pages(); 
	}
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "	<tr>\n";
			echo "	<form name=\"squery\" method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "		<td width=\"229\">\n";
			echo "			<input type=\"text\" name=\"squery\" size=\"32\">\n";
			echo "			<input type=\"submit\" value=\""._SEARCHBUTTON."\">\n";
			echo "		<input type=\"hidden\" name=\"op\" value=\"item_list\">\n";
	if (isset($cat_limit))	echo "		<input type=\"hidden\" name=\"cat_limit\" value=\"$cat_limit\">\n";
	if (isset($limit))		echo "		<input type=\"hidden\" name=\"limit\" value=\"$limit\">\n";
			echo "		</td>\n";
			echo "		</form>\n";
			echo "		<td align=\"center\"><select size=\"1\" name=\"cat_id\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "      <option value=\"modules.php?name=$modulename&file=admin&op=item_list$lquery2\">-- Limit by Category --</option>\n";
	$result3 = $db->sql_query("SELECT id, title FROM ".$prefix."_".$mainprefix."_categories order by title");
	$result7 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid3, $parentid3, $ctitle3) = $db->sql_fetchrow($result7)) {
		$ctitle3 = stripslashes($ctitle3);
    if ($parentid3!=0) $ctitle3=getparent($parentid3,$ctitle3);
    	if ($cid3 == $cat_limit) $sel = "selected";
			echo "<option $sel value=\"modules.php?name=$modulename&file=admin&op=itemcontrol&cat_limit=$cid3$lquery2\">$ctitle3</option>";
			$sel = "";
	 }			
			echo "		</select></td>\n";
			echo "		<td width=\"27\"><select size=\"1\" name=\"limit\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
			echo "      <option value=\"modules.php?name=$modulename&file=admin&op=itemcontrol$nquery2\">"._CIALL."";
			echo "      </option>";
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
    	if ($ltr==$limit) { $sel = " selected"; }
			echo "      <option$sel value=\"modules.php?name=$modulename&file=admin&op=itemcontrol$nquery2&limit=$ltr\">$ltr</option>\n";
        $counter++;
        $sel = '';
    }				
			echo "		</select></td>\n";
			echo "	</tr>\n";
			echo "</table>\n";
		CloseTable();	
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n";
	if (isset($smessage)) {
		echo "<tr>\n";
		echo "	<td width=\"51%\">\n";	
		echo "		$smessage";
		echo "	</td>\n";
		echo "</tr>\n";
	}			
  		echo "<tr>\n"
    		."<td width=\"51%\"><strong>"._TITLE."</strong></td>\n"
   	 		."<td width=\"25%\" align=\"center\"><strong>"._CATEGORY."</strong></td>\n"
    		."<td width=\"24%\" align=\"center\"><strong>"._FUNCTION."</strong></td>\n"
  			."</tr>\n";
  	if (getconfigvar("phpbb_pages") == 0) {
  		$result = $db->sql_query("SELECT id, parentid, title, active FROM ".$prefix."_".$mainprefix."_items $query limit $offset,$mwpages");
  	} else {
 		$result = $db->sql_query("SELECT id, parentid, title, active FROM ".$prefix."_".$mainprefix."_items $query limit $start,40"); 		
  	}
	while(list($id, $parentid, $title, $active) = $db->sql_fetchrow($result)) {
		  $result2 = $db->sql_query("SELECT title FROM ".$prefix."_".$mainprefix."_categories where id = $parentid");
	  	  while(list($title2) = $db->sql_fetchrow($result2)) {
	  	  	if ($active == 0) {
	  	  		$adtext = ""._ITEMACTIVATE."";
	  	  		$mode = "activate";
	  	  	} else {
	  	  		$adtext = ""._ITEMDEACTIVEATE."";
	  	  		$mode = "deactivate";
	  	  	}
	  		echo  "<tr>\n";
    		echo "<td width=\"51%\"><a href=\"modules.php?name=$modulename&file=admin&op=modifyitem&id=$id\">".stripslashes($title)."</a></td>\n";
    		echo "<td width=\"25%\" align=\"center\">".stripslashes($title2)."</td>\n";
    		echo "<td width=\"24%\" align=\"center\">[ \n"
    		."<a href=\"modules.php?name=$modulename&file=admin&op=itemcontrol&mode=$mode&id=$id\">$adtext</a> ]</td>\n";
			echo "</tr>\n";
		}
	}
			echo "</table>\n";
	if (getconfigvar("phpbb_pages") == 0) {
		$function = "itemcontrol";
	   generate_pagination_old($page, $pages, $modulename, $function, $nquery2, $lquery2);
	}
		CloseTable();
	if (getconfigvar("phpbb_pages") == 1) {	
			$per_page = 40;
			$topics_count = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_".$mainprefix."_items $query"));
	if ($topics_count > $per_page) {
		OpenTable();	
			$page_string = generate_pagination_phpbb("modules.php?name=$modulename&file=admin&op=itemcontrol$nquery2$lquery2", $topics_count, $per_page, $start);	
			echo "<div align=\"center\">$page_string</div>";
		CloseTable();
	}
		}
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ItemQueue() {
	global $prefix, $db, $modulename, $mainprefix, $page, $inserted, $deleted;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
	if (isset($inserted)) $action = ""._ITEMAPPROVED."";
	if (isset($deleted)) $action = ""._ITEMQDELETED."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}
	// Calculate Page Numbering
	$mwpages=40;
    	$result = $db->sql_query("SELECT count(*) FROM ".$prefix."_".$mainprefix."_queue");
		list($total) =  $db->sql_fetchrow($result);
		if ($total>$mwpages) {
    			$pages=ceil($total/$mwpages);
    	if ($page > $pages) { $page = $pages; }
    	if (!$page) { $page=1; }
    			$offset=($page-1)*$mwpages;
			} else {
    		$offset=0;
    		$pages=1;
    		$page=1;
		}
	// End Page Numbering
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
  			."<tr>\n"
    		."<td width=\"51%\"><u><strong>"._TITLE."</strong></u></td>\n"
    		."<td width=\"22%\" align=\"center\"><u><strong>"._SUBMITTER."</strong></u></td>\n"
    		."<td width=\"27%\" colspan=\"2\">\n"
    		."<p align=\"center\"><u><strong>"._FUNCTION."</strong></u></td>\n"
  			."</tr>\n";
  	$result = $db->sql_query("SELECT id, title, submitter FROM ".$prefix."_".$mainprefix."_queue limit $offset,$mwpages");
	while(list($id, $title, $submitter) = $db->sql_fetchrow($result)) {
			echo "<tr>\n"
    		."<td width=\"51%\">$title</td>\n"
    		."<td width=\"22%\" align=\"center\">$submitter</td>\n"
    		."<td width=\"13%\" align=\"center\">\n"
    		."<a href=\"modules.php?name=$modulename&file=admin&op=ItemPreview&id=$id\">"._PREVIEW."</a></td>\n"
    		."<td width=\"14%\" align=\"center\">\n"
    		."<a href=\"modules.php?name=$modulename&file=admin&op=QueueDelete&id=$id\">"._DELETE."</a></td>\n";
  	}	
  			echo "</tr>\n"
			."</table>\n";
			
    if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>\n";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>\n";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue&amp=page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>\n";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>\n";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue&amp=page=$pcnt\">$pcnt</a> ]</strong> \n";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>\n";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue&amp=page=$pcnt\">$pcnt</a> ]</strong>\n";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue&amp=page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />\n";
	}
			
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ItemPreview($id) {
	global $prefix, $db, $modulename, $mainprefix;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");	
		admin_header();
	$previewquery = $db->sql_query("SELECT id, parentid, author, website, title, submitter, youremail, description, content from ".$prefix."_".$mainprefix."_queue where id = $id");
	list($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content) = $db->sql_fetchrow($previewquery);
	    $bbcode_uid = make_bbcode_uid();
    	$content2 = insert_bbcode_uid($content, $bbcode_uid);
 		$formattedcontent = parse_bbcode($content2,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."</td>\n"
			."</tr>\n"
         ."</table>\n"; 
      CloseTable(); 
      OpenTable(); 
?> 
	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$newcategory) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($itemauthor)."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($itemwebsite)."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($itemtitle)."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($submitter)."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$email\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($descrip)."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
		$content3 = stripslashes($content);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content3</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"ItemQueuePreview\">"._PREVIEW."</option>\n";
			echo "      <option value=\"ItemQueuePost\">"._NEWPOST."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$bbcode_uid\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();
		admin_footer();		
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ItemQueuePreview($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");	
	@require_once("modules/$modulename/includes/wysiwyg.php");	
		admin_header();
    	$content2 = insert_bbcode_uid($content, $bbcode_uid);
 		$formattedcontent = parse_bbcode($content2,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."</td>\n"
			."</tr>\n"
         ."</table>\n";
      CloseTable();
      OpenTable();
?>
	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$newcategory) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($itemauthor)."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($itemwebsite)."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($itemtitle)."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($submitter)."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$email\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($descrip)."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
		$content3 = stripslashes($content);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content3</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"ItemQueuePreview\">"._PREVIEW."</option>\n";
			echo "      <option value=\"ItemQueuePost\">"._NEWPOST."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$bbcode_uid\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();
		admin_footer();	
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ItemQueuePost($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
	@require_once("modules/$modulename/includes/bbstuff.php");
	$datea = date("Y-m-d H:i:s");
	$content2= addslashes($content);
	$descrip2= addslashes($descrip);
	$submitter2= addslashes($submitter);
	$itemtitle2= addslashes($itemtitle);
	$itemauthor2= addslashes($itemauthor);
	$content2 = insert_bbcode_uid($content2, $bbcode_uid);
	$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_items VALUES (NULL, '$newcategory', '$itemauthor2', '$itemwebsite2', '$itemtitle2', '$descrip2', '0', '0', '0', '$content2', '$submitter2', '$datea', NULL, '0', '$email', '$bbcode_uid', '$itemlang', '1')");
	$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_queue where id= '$id'");
	Header("Location: modules.php?name=$modulename&file=admin&op=ItemQueue&inserted=1");
}

function QueueDelete() {
	global $prefix, $db, $modulename, $mainprefix, $id, $confirmed;
	if ($isset($confirmed)) {
		$db->sql_query("delete from ".$prefix."_".$mainprefix."_queue where id=$id");
		Header("Location: modules.php?name=$modulename&file=admin&op=ItemQueue&deleted=1");
	}	
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();
	$result = $db->sql_query("SELECT  title FROM ".$prefix."_".$mainprefix."_queue  where id = $id");
	while(list($title) = $db->sql_fetchrow($result)) {
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEITEMTOP."</strong></td>\n"
  			."</tr>\n"
  			."<tr>\n"
   	 		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">"._DELETEITEM.": \n"
    		."$title</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEWARNBIG.": </strong>"._DELETE2."</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">[\n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=QueueDelete&confirmed=1&id=$id\">"._YES."</a> | \n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=ItemQueue\">"._NO."</a> ]</td>\n"
  			."</tr>\n"
			."</table>\n";
	}
		CloseTable();
		admin_footer();
    
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function WaitingMods() {
	global $prefix, $db, $modulename, $mainprefix, $page, $inserted, $deleted;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	if (isset($inserted)) $action = ""._ITEMRAPPROVED."";
	if (isset($deleted)) $action = ""._ITEMRDELETED."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}
		admin_header();
    // Calculate Page Numbering
    $mwpages=20;
    	$result = $db->sql_query("SELECT count(*) FROM ".$prefix."_".$mainprefix."_modify");
		list($total) =  $db->sql_fetchrow($result);
		if ($total>$mwpages) {
    			$pages=ceil($total/$mwpages);
    	if ($page > $pages) { $page = $pages; }
    	if (!$page) { $page=1; }
    			$offset=($page-1)*$mwpages;
			} else {
    		$offset=0;
    		$pages=1;
    		$page=1;
		}
	// End Page Numbering
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">"
  			."<tr>"
    		."<td width=\"51%\"><u><strong>"._TITLE."</strong></u></td>"
    		."<td width=\"22%\" align=\"center\"><u><strong>"._SUBMITTER."</strong></u></td>"
    		."<td width=\"27%\" colspan=\"2\">"
    		."<p align=\"center\"><u><strong>"._FUNCTION."</strong></u></td>"
  			."</tr>";
  	$result = $db->sql_query("SELECT id, title, submitter FROM ".$prefix."_".$mainprefix."_modify limit $offset,$mwpages");
	while(list($id, $title, $submitter) = $db->sql_fetchrow($result)) {
			echo "<tr>"
    		."<td width=\"51%\">$title</td>"
    		."<td width=\"22%\" align=\"center\">$submitter</td>"
    		."<td width=\"13%\" align=\"center\">"
    		."<a href=\"modules.php?name=$modulename&file=admin&op=ModifyReqPreview&id=$id\">"._PREVIEWAPPROVE."</a></td>"
    		."<td width=\"14%\" align=\"center\">"
    		."<a href=\"modules.php?name=$modulename&file=admin&op=ModifyReqDelete&id=$id\">"._DELETE."</a></td>";
  	}	
  			echo "</tr>"
			."</table>";
   if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods&amp=page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods&amp=page=$pcnt\">$pcnt</a> ]</strong> ";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods&amp=page=$pcnt\">$pcnt</a> ]</strong>";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods&amp=page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />";
	}
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ModifyReqPreview() { 
   global $prefix, $db, $mainprefix, $modulename, $id; 
   @include_once("header.php"); 
   @include_once("modules/$modulename/includes/js.php"); 
   @require_once("modules/$modulename/includes/bbstuff.php"); 
   @require_once("modules/$modulename/includes/wysiwyg.php"); 
	$row = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_modify where id = '$id'"));
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_items where id = '$id'"));
		admin_header();
		$bbcode_uid = make_bbcode_uid();
    	$content2 = insert_bbcode_uid($content, $bbcode_uid);
 		$formattedcontent = parse_bbcode($content2,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);		
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."</td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();	
		OpenTable();

?>

	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $row[itemlang]);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$row[parentid]) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($row[author])."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($row[website])."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($row[title])."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($row[submitter])."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$row[youremail]\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($row[description])."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
			$content2 = ($row[bbcode_uid] != '') ? preg_replace("/:(([a-z0-9]+:)?)".$row[bbcode_uid]."(=|\])/si",'\\3',$row[content]) : $row[content];
			$content2 = stripslashes($content2);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content2</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"requestpreviewform\">"._NEWPREVIEW."</option>";
			echo "      <option value=\"requestitemsave\">"._NEWPOST."</option>";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"olddate\" value=\"$row2[date]\">\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$row[id]\">\n";
			echo "	<input type=\"hidden\" name=\"votes\" value=\"$row2[votes]\">\n";
			echo "	<input type=\"hidden\" name=\"rating\" value=\"$row2[rating]\">\n";
			echo "	<input type=\"hidden\" name=\"comments\" value=\"$row2[comments]\">\n";
			echo "	<input type=\"hidden\" name=\"views\" value=\"$row2[views]\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$bbcode_uid\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();			
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function requestpreviewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang) { 
   global $prefix, $db, $mainprefix, $modulename; 
   checkbad($content); 
   errors(); 
   @include_once("header.php"); 
   @include_once("modules/$modulename/includes/js.php"); 
   @require_once("modules/$modulename/includes/bbstuff.php"); 
   @require_once("modules/$modulename/includes/wysiwyg.php"); 
		admin_header();
		$bbcode_uid = make_bbcode_uid();
    	$content2 = insert_bbcode_uid($content, $bbcode_uid);
 		$formattedcontent = parse_bbcode($content2,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);	
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\" valign=\"top\">\n"
			."<p align=\"center\"><strong>"._PREVIEWHEAD."</strong></td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWTITLE."</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">&nbsp;<table border=\"2\" bordercolor=\"#C0C0C0\" width=\"100%\">\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">$formattedcontent</td>\n"
			."</tr>\n"
			."</table>\n"
			."<p>&nbsp;</td>\n"
			."</tr>\n"
			."<tr>\n"
			."<td width=\"100%\">\n"
			."<p align=\"center\">&nbsp;"._PREVIEWREQUEST."</td>\n"
			."</tr>\n"
			."</table>\n";
		CloseTable();
		OpenTable();
?>

	<script language="JavaScript">
	<!-- 
		function pagebreak()
		{
			document.postnew.content.value += ("<!--pagebreak-->")
		}
	// -->
	</script>
	<script language="JavaScript">
	<!-- 
		function IMG()
		{
			document.postnew.content.value += ("<img src=modules/<?php echo "$modulename"; ?>/images/uploaded/" + document.postnew.image.value + ">\n")
	}
	// -->
	</script>
	<SCRIPT language="JavaScript">
	<!--
		 function viewuploaded() {
           window.open ("modules/<?php echo "$modulename"; ?>/viewimage.php?op=view&filename=" + document.postnew.image.value +"","ImagePreview","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300")
    		}
    // -->
	</script>

<?php
			// JavaScript Error Checking
			echo "<script language=\"JavaScript\">\n";
			echo "\n";
			echo "<!--\n";
			echo "                        function checkData (){\n";
			echo "                                if (document.postnew.newcategory.value == \"\") {\n";
			echo "                                        alert(\""._ECCAT.".\")\n";
			echo "                                        document.postnew.newcategory.focus()\n";
			echo "                                        return false}\n";
	if (getconfigvar("jschecking") == 1) {
			echo "                                if (document.postnew.itemauthor.value == \"\") {\n";
			echo "                                        alert(\""._ECAUTHOR.".\")\n";
			echo "                                        document.postnew.itemauthor.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.itemwebsite.value == \"\") {\n";
			echo "                                        alert(\""._ECWEBSITE.".\")\n";
			echo "                                        document.postnew.itemwebsite.focus()\n";
			echo "                                        return false}\n";
	}
			echo "                                if (document.postnew.itemtitle.value == \"\") {\n";
			echo "                                        alert(\""._ECTITLE.".\")\n";
			echo "                                        document.postnew.itemtitle.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.submitter.value == \"\") {\n";
			echo "                                        alert(\""._ECYOURNAME.".\")\n";
			echo "                                        document.postnew.submitter.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.email.value == \"\") {\n";
			echo "                                        alert(\""._ECYOUREMAIL.".\")\n";
			echo "                                        document.postnew.email.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.descrip.value == \"\") {\n";
			echo "                                        alert(\""._ECDESCRIP.".\")\n";
			echo "                                        document.postnew.descrip.focus()\n";
			echo "                                        return false}\n";
			echo "                                if (document.postnew.content.value == \"\") {\n";
			echo "                                        alert(\""._ECCONTENT."\")\n";
			echo "                                        document.postnew.content.focus();\n";
			echo "                                        return false;\n";
			echo "\n";
			echo "                                }\n";
			echo "                          \n";
			echo "                        }\n";
			echo "// -->\n";
			echo "\n";
			echo "</script>\n";
			// end error checking
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	if (getconfigvar("multilinguel") == 1) {		
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._CHOSELANG.":</td>\n";
			echo "      <td width=\"80%\">\n";
		readlangdir($modulename, $itemlang);
			echo "     <br /></td>\n";
			echo "    </tr>\n";		
	}				
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWCAT.":</td>\n";
			echo "      <td width=\"80%\"><select size=\"1\" name=\"newcategory\" onMouseOver=\"helpline('selectcat')\">\n";
			echo "      <option selected>-- "._NEWPLSONE." --</option>\n";
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
	$result2 = $db->sql_query("SELECT id, parentid, title FROM ".$prefix."_".$mainprefix."_categories order by parentid,title");
	while(list($cid2, $parentid2, $ctitle2) = $db->sql_fetchrow($result2)) {
    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    if ($cid2==$newcategory) { $sel = "selected "; }
    		echo "      <option $sel value=\"$cid2\">$ctitle2</option>\n";
    $sel = "";
	}
			echo "      </select></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWAUTHOR.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"".stripslashes($itemauthor)."\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"".stripslashes($itemwebsite)."\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"".stripslashes($itemtitle)."\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"".stripslashes($submitter)."\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$email\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"".stripslashes($descrip)."\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
		readimagedir();	
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:viewuploaded()\" onMouseOver=\"helpline('previewimage')\" value=\""._PREVIEWIMAGE."\"><br /><br /><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
			$content2 = ($bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)".$bbcode_uid."(=|\])/si",'\\3',$content) : $content;
			if ($bbcode_uid != '') $content2 = substr_replace ($content2, '', 0, 1);
			$content2 = stripslashes($content2);
			echo "<td width=\"80%\">\n";
	$form_name = "postnew";
	$entrybox = "content";
	wysiwyg_form($form_name, $entrybox);
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";			
			
			echo "      <td width=\"80%\"><textarea rows=\"17\" name=\"content\"  onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" cols=\"100%\">$content2</textarea></td>\n";
    		echo "</tr>\n";
    		echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\"> </td>\n";
			echo "      <td width=\"80%\"> </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" valign=\"top\" colspan=\"2\">\n";
  			echo "      <select size=\"1\" name=\"op\">";
  			echo "		<option value=\"requestpreviewform\">"._NEWPREVIEW."</option>";
			echo "      <option value=\"requestitemsave\">"._NEWPOST."</option>";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "	<input type=\"hidden\" name=\"olddate\" value=\"$olddate\">\n";
			echo "	<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
			echo "	<input type=\"hidden\" name=\"votes\" value=\"$votes\">\n";
			echo "	<input type=\"hidden\" name=\"rating\" value=\"$rating\">\n";
			echo "	<input type=\"hidden\" name=\"comments\" value=\"$comments\">\n";
			echo "	<input type=\"hidden\" name=\"views\" value=\"$views\">\n";
			echo "	<input type=\"hidden\" name=\"bbcode_uid\" value=\"$bbcode_uid\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">";	
		}				
			echo "</form>";
		CloseTable();		
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}		

function requestitemsave($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
	@require_once("modules/$modulename/includes/bbstuff.php");
	$datea = date("Y-m-d H:i:s");
	$content2= addslashes($content);
	$descrip2= addslashes($descrip);
	$submitter2= addslashes($submitter);
	$itemtitle2= addslashes($itemtitle);
	$itemauthor2= addslashes($itemauthor);
	$content2 = insert_bbcode_uid($content2, $bbcode_uid);
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_items SET parentid='$newcategory', author='$itemauthor2', website='$itemwebsite', title='$itemtitle2', description='$descrip2', votes='$votes', rating='$rating', comments='$comments', content='$content2', submitter='$submitter2', date='$olddate', lastdate='$datea', views='$views', youremail='$email', bbcode_uid='$bbcode_uid',language = '$itemlang' where id='$id'");
	$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_modify where id = '$id'");
	Header("Location: modules.php?name=$modulename&file=admin&op=WaitingMods&inserted=1");
}

function ModifyReqDelete() {
	global $prefix, $db, $modulename, $mainprefix, $id, $confirmed;
	if (isset($confirmed)) {
		$db->sql_query("delete from ".$prefix."_".$mainprefix."_requests where id=$id");
		Header("Location: modules.php?name=$modulename&file=admin&op=WaitingMods&deleted=1");		
	}
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();
	$result = $db->sql_query("SELECT itemtitle FROM ".$prefix."_".$mainprefix."_requests  where id = $id");
	while(list($title) = $db->sql_fetchrow($result)) {
		$title = stripslashes($title);
			echo "<table border=\"0\" width=\"100%\">\n"
			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEITEMTOP."</strong></td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">"._DELETEITEM.": \n"
    		."$title</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\"><strong>"._DELETEWARNBIG.": </strong>"._DELETE2."</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">&nbsp;</td>\n"
  			."</tr>\n"
  			."<tr>\n"
    		."<td width=\"100%\" align=\"center\">[\n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=requestdelete&confirmed=1&id=$id\">"._YES."</a> | \n"
    		." <a href=\"modules.php?name=$modulename&file=admin&op=WaitingMods\">"._NO."</a> ]</td>\n"
  			."</tr>\n"
			."</table>\n";
	}
		CloseTable();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function imageupload() {
	global $prefix, $db, $mainprefix, $modulename, $error, $uploaded;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	if (isset($uploaded)) $action = ""._IMAGEUPLOADC."";
	if (isset($error)) $action = ""._UPIERROR."";
	if (isset($action)) {
		OpenTable();
			echo "$action\n";
		CloseTable();
	}
		admin_header();
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" id=\"AutoNumber1\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._UPLOADANIMAGE."</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">&nbsp;</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SELECTIMAGE.":</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <form method=\"POST\" enctype=\"multipart/form-data\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "      <p align=\"center\"><input type=\"file\" name=\"image\" size=\"28\"><br />\n";
			echo "      <br />\n";
			echo "      <input type=\"submit\" value=\""._UPLOADIMAGE."\"></p>\n";
			echo "      <input type=\"hidden\" name=\"op\" value=\"uploadimage\">\n";
			echo "    </form>\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function uploadimage($image) {
	global $modulename;
	if (!isset($image)) {
		Header("Location: modules.php?name=$modulename&file=admin&op=imageupload&error=1");
	}
        $image_id = date("His-Ymd");
        //$oid = str_pad($image_id, 22, "0", STR_PAD_LEFT);
        $imageurl_name = $_FILES['image']['name'];
        $imageurl_temp = $_FILES['image']['tmp_name'];
        $oid = $image_id;
        $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
        if (move_uploaded_file($imageurl_temp, "modules/$modulename/images/uploaded/$oid$ext")) {
            chmod ("modules/$modulename/images/uploaded/$oid$ext", 0755);
            $imgurl = "modules/$modulename/images/uploaded/$oid$ext";
        }
    Header("Location: modules.php?name=$modulename&file=admin&op=imageupload&uploaded=1");
}

function editcomment() {
	global $prefix, $db, $mainprefix, $modulename, $textcolor1, $bgcolor2, $cid, $vid;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
		admin_header();
		OpenTable();	
		$row = $db->sql_fetchrow($db->sql_query("SELECT comment from ".$prefix."_".$mainprefix."_comments where cid='$cid'"));
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=admin\">\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"50%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <p align=\"center\"><strong>"._EDITINGCOMMENT.":</strong></i></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        <p align=\"center\">"._COMMENT.":\n";
			echo "        <textarea rows=\"2\" name=\"comment_text\" cols=\"50\">$row[comment]</textarea></p>\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        &nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "    	<td width=\"100%\">\n";
			echo "        <p align=\"center\"><input type=\"submit\" value=\""._EDITCOMMENT."\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "        <input type=\"hidden\" name=\"op\" value=\"savecomment\">\n";
			echo "        <input type=\"hidden\" name=\"cid\" value=\"$cid\">\n";
			echo "		  <input type=\"hidden\" name=\"vid\" value=\"$vid\">\n";
			echo "  </form>\n";
			echo "  </center>\n";
			echo "</div>\n";			
		CloseTable();
		admin_footer();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");		
}

function savecomment($cid, $vid, $comment_text) {
	global $prefix, $db, $modulename, $mainprefix;
	$db->sql_query("UPDATE ".$prefix."_".$mainprefix."_comments SET comment='$comment_text' where cid='$cid'");
	Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1");	
}

function deletecomment() {
	global $prefix, $db, $mainprefix, $modulename, $textcolor1, $bgcolor2, $cid, $vid, $confirmed;
	if (isset($confirmed)) {
		$db->sql_query("DELETE from ".$prefix."_".$mainprefix."_comments where cid='$cid'");
		Header("Location: modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1");
	}		
	$row = $db->sql_fetchrow($db->sql_query("SELECT comment from ".$prefix."_".$mainprefix."_comments where cid='$cid'"));
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	$mainindex=1;
		mainheader($mainindex);
		admin_header();
		OpenTable();	
			echo "<div align=\"center\">\n";
			echo "  <center>\n";
			echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"62%\">\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\" style=\"color: $textcolor1\" bgcolor=\"$bgcolor2\">\n";
			echo "      <p align=\"center\"><strong>"._DELETINGCOMMENT.":</strong></td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">"._COMAREYOUSURE.":<br /> '$row[comment]'<br /><br />\n";
			echo "      "._BIGWARN.": "._CLACTIONUNDONE.".</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">&nbsp;</td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"100%\">\n";
			echo "      <p align=\"center\">[\n";
			echo "      <a href=\"modules.php?name=$modulename&file=admin&op=delcomment&cid=$cid&vid=$vid&confirmed=1\">\n";
			echo "      "._RYES."</a> | <a href=\"modules.php?name=$modulename&op=ViewItems&vid=$vid&viewed=1\">\n";
			echo "      "._RNO."</a> ]</td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "  </center>\n";
			echo "</div>\n";		
		CloseTable();
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

switch($op) {
	
	default:
	admin_index();
	break;
	
	case "configure":
	configure();
	break;
	
	case "save_settings":
	save_settings($settings);
	break;	
	
	case "censorlist":
	censorlist();
	break;
	
	case "addcensorword":
	addcensorword($censorword);
	break;
	
	case "editcensorword":
	editcensorword($id);
	break;
	
	case "savecensorword":
	savecensorword($cid, $censorword);
	break;	
	
	case "delcensorword":
	delcensorword($id);
	break;
	
	case "usercontrol":
	usercontrol();
	break;
	
	case "categories":
	categories();
	break;
	
	case "ModifyCat":
	ModifyCat($category);
	break;
	
	case "ModifyCatSave":
	ModifyCatSave($id, $title, $description);
	break;
	
	case "DelCat":
	DelCat($category);
	break;
	
	case "AddNewCat":
	AddNewCat($title, $description);
	break;
	
	case "AddNewSubCat":
	AddNewSubCat($parentcategory, $subtitle, $subdescription);
	break;	
	
	case "requestadmin":
	requestadmin();
	break;
	
	case "requestcontrol":
	requestcontrol();
	break;
	
	case "relatedadmin":
	relatedadmin();
	break;
	
	case "addrelatedlink":
	addrelatedlink($xlinktitle, $xlinkurl, $xitem_id);
	break;
	
	case "EditRelatedLink":
	EditRelatedLink();
	break;
	
	case "saverelatedlink";
	saverelatedlink($xrid, $xlinktitle, $xlinkurl, $xitem_id);
	break;
	
	case "RelatedDel":
	RelatedDel();
	break;
	
	case "additem":
	additem();
	break;
	
	case "postitemdata":
	postitemdata($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang);
	break;
	
	case "previewitemform":
	previewitemform($newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $itemlang);
	break;
	
	case "item_list":
	item_list($page);
	break;
	
	case "DelItem":
	DelItem();
	break;
	
	case "modifyitem":
	modifyitem();
	break;
	
	case "modifyitemsave":
	modifyitemsave($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang);
	break;
	
	case "modifypreviewform":
	modifypreviewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang);
	break;
	
	case "itemcontrol":
	itemcontrol();
	break;
	
	case "ItemQueue":
	ItemQueue();
	break;
	
	case "ItemQueuePreview":
	ItemQueuePreview($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid, $itemlang);
	break;
	
	case "ItemQueuePost":
	ItemQueuePost($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid, $itemlang);
	break;
	
	case "ItemPreview":
	ItemPreview($id);
	break;
	
	case "QueueDelete":
	QueueDelete();
	break;
	
	case "WaitingMods":
	WaitingMods();
	break;
	
	case "ModifyReqPreview":
	ModifyReqPreview();
	break;
	
	case "requestpreviewform":
	requestpreviewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang);
	break;
	
	case "requestitemsave":
	requestitemsave($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $olddate, $votes, $rating, $comments, $views, $bbcode_uid, $itemlang);
	break;
	
	case "ModifyReqDelete":
	ModifyReqDelete();
	break;
	
	case "imageupload":
	imageupload();
	break;
	
	case "uploadimage":
	uploadimage($image);
	break;
	
	case "editcomment":
	editcomment();
	break;
	
	case "savecomment":
	savecomment($cid, $vid, $comment_text);
	break;
	
	case "deletecomment":
	deletecomment();
	break;
	
}

} else {
	@include_once("header.php");
	OpenTable();
	echo "<center><strong></strong><br /><br />You do not have administration permission for the Universal module</center>";
	CloseTable();
	@include_once("footer.php");
}

?>
