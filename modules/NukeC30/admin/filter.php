<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to maintains disclaimers in NukeC30 Addon
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                    */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*	                                                                     */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('ADMIN_FILE') )

{

	die ("Access Denied");

}



global $prefix, $db, $admin_file;

$aid = substr("$aid", 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));

if ($row['radminsuper'] == 1) {

$NukeCAddonName = "NukeC30";
include_once("modules/".$NukeCAddonName."/functions.php");
include_once("modules/".$NukeCAddonName."/language/lang-".$currentlang.".php");

function NukeCAdsWordFilter($nod,$msgid) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<strong>Ads Word Filter</strong>";
	echo "<br /><br />[ <a href=\"admin.php?op=NukeC30AdsWordFilterAdd\">Add Word Filter</a> ]";
	if ((isset($msgid)) && ($msgid != "")) {
		echo "<br /><br /><center>";
		switch ($msgid) {
			case "BadAdded": echo "New Word Filter Added";break;
			case "BadUpdated": echo "Selected Word Filter Updated";break;
			case "BadDeleted": echo "Selected Word Filter Deleted";break;
		}
		echo "</center>";
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingfilter();
	CloseTable();
	include_once("footer.php");
}

function  NukeCAdsWordFilterAdd() {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<script>\n"
		."<!--\n"
		."  function ValidateWordFilter() {\n"
		."	var bad_word = document.WordFilter.bad_word.value;\n"
		."	var rep_word = document.WordFilter.rep_word.value;\n"
		."  if ((bad_word == \"\") || (rep_word == \"\")) {\n"
		." 		alert('Error : \\n\\nBoth Bad Word and Replacement are required');\n"
		."		return false;"
		."	} else return true;\n"
		."	}\n"
		."//-->\n"
		."</script>\n";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<strong>Add Ads Duration</strong>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingfilter();
	echo "<br />";
	echo "<table cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor5."\">";
	echo "<strong>Add New Word Filter</strong></td></tr>"
		."<form name=\"WordFilter\" action=\"admin.php?op=NukeC30AdsWordFilterSave\" method=\"post\" onsubmit=\"return ValidateWordFilter();\">"
		."<tr><td bgcolor=\"$adsbgcolor4\" width=\"25%\" nowrap=\"nowrap\">Bad Word\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"bad_word\" size=\"25\" maxlength=\"49\" /></td></tr>"
		."<tr><td valign=\"top\" bgcolor=\"$adsbgcolor4\">Replacement\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"rep_word\" size=\"25\" maxlength=\"49\" /></td></tr>";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\" align=\"center\"><input type=\"submit\" value=\"Submit\" /></td></tr>"
		."</form>";
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function NukeCAdsWordFilterSave($bad_word,$rep_word) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$res = $db->sql_query("insert into ".$nukecprefix."_ads_filter values ('','$bad_word','$rep_word')");
	if (!$res) {
		die(mysql_error());
	}
	header("Location:admin.php?op=NukeC30AdsWordFilter&msgid=BadAdded");
}

function NukeCAdsWordFilterEdit($nod) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />\n";
	echo "<script>\n"
		."<!--\n"
		."function UpdateWF() {\n"
		."	var BadWord = document.AdsWordFilterEdit.xbad_word.value;\n"
		."	var RepWord = document.AdsWordFilterEdit.xrep_word.value;\n"
		."  	if ((BadWord == '') || (RepWord == '')) {\n"
		." 			alert('Error : \\n\\nBoth Bad Word and Replacement are required');\n"
		."			return false;\n"
		."		} else { \n"
		."			return true;\n"
		."		}\n"
		."}\n"
		."//-->\n"
		."</script>";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<strong>Edit Ads Duration</strong>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingfilter();
	$re = $db->sql_query("select bad_word, rep_word from ".$nukecprefix."_ads_filter where word_id='$nod'");
	list ($bad_word, $rep_word) = $db->sql_fetchrow($re);
	echo "<br />";
	echo "<table cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td align=\"center\" bgcolor=\"".$adsbgcolor5."\" colspan=\"2\">";
	echo "<strong>Edit Word Filter</strong></td></tr>";
	echo "<form name=\"AdsWordFilterEdit\" onsubmit=\"return UpdateWF();\" action=\"admin.php?op=NukeC30AdsWordFilterUpdate\" method=\"post\">"
		."<tr><td width=\"25%\" bgcolor=\"$adsbgcolor4\" nowrap=\"nowrap\">Bad Word\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"xbad_word\" size=\"25\" maxlength=\"49\" value=\"$bad_word\" /></td></tr>"
		."<tr><td valign=\"top\"  bgcolor=\"$adsbgcolor4\">Replacement\n"
		."</td><td  bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"xrep_word\" size=\"25\" maxlength=\"49\" value=\"$rep_word\"></td></tr>"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Update\" /></td></tr>"
		."<input type=\"hidden\" name=\"xno\" value=\"$nod\" />"
		."</form>";
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function NukeCAdsWordFilterUpdate($xno,$xbad_word,$xrep_word) {
	global $nukecprefix,$db;
	$sqlupdate = "update ".$nukecprefix."_ads_filter set bad_word='$xbad_word', rep_word='$xrep_word' where word_id='$xno'";
	$db->sql_query($sqlupdate);
	header("Location:admin.php?op=NukeC30AdsWordFilter&msgid=BadUpdated");
}

function NukeCAdsWordFilterDelete($nod) {
	global $nukecprefix,$db;
	$db->sql_query("delete from ".$nukecprefix."_ads_filter where word_id ='".$nod."'");
	header("Location:admin.php?op=NukeC30AdsWordFilter&msgid=BadDeleted");
}

function listingfilter() {
	global $nukecprefix,$db, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$re = $db->sql_query("select word_id, bad_word, rep_word from ".$nukecprefix."_ads_filter order by bad_word");
	if ($db->sql_numrows($re) > 0) {
		echo "<br /><table  cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr bgcolor=\"".$adsbgcolor5."\"><td><strong>Bad Words</strong></td><td ><strong>Word Replacements</strong></td>\n"
			."<td width=\"110\">&nbsp;</td></tr>\n";
		
		while (list ($no,$duration_v,$duration_al) = $db->sql_fetchrow($re)) {
			echo "<tr bgcolor=\"$adsbgcolor2\"><td>$duration_v</td><td>$duration_al</td>\n"
				."<td align=\"center\">\n"
				."[ <a href=\"admin.php?op=NukeC30AdsWordFilterEdit&nod=$no\">"._NUKECEDIT."</a> | \n"
				."<a href=\"admin.php?op=NukeC30AdsWordFilterDelete&nod=$no\" onclick=\"return confirm('Are you sure to delete this Word Filter')\">"._NUKECDELETE."</a> ]</td>\n"
				." </tr>\n";
		}
		echo "</table>";
		echo "</td></tr></table>";
	} else {
		echo "<center>No Word Filter Initialized</center>";
	}
}
global $nod,$msgid;
switch($op) {
	case "NukeC30AdsWordFilter" : NukeCAdsWordFilter($nod,$msgid);break;
	case "NukeC30AdsWordFilterAdd": NukeCAdsWordFilterAdd();break;
	case "NukeC30AdsWordFilterSave":  NukeCAdsWordFilterSave($bad_word,$rep_word);break;
	case "NukeC30AdsWordFilterEdit" : NukeCAdsWordFilterEdit($nod);break;
	case "NukeC30AdsWordFilterUpdate":NukeCAdsWordFilterUpdate($xno,$xbad_word,$xrep_word);break;
	case "NukeC30AdsWordFilterDelete" : NukeCAdsWordFilterDelete($nod);break;
	}
} else {
    echo "Access Denied";
}

?>
