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

function NukeCAdsDuration($nod,$msgid) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	echo "<b >Ads Durations</strong>";
	echo "<br /><br />[ <a href=\"admin.php?op=NukeC30AdsDurationAdd\">Add Duration</a> ]";
	if ((isset($msgid)) && ($msgid != "")) {
		echo "<br /><br /><center>";
		switch ($msgid) {
			case "DurAdded": echo "New Ads Duration Added";break;
			case "DurUpdated": echo "Selected Ads Duration Updated";break;
			case "DurDeleted": echo "Selected Ads Duration Deleted";break;
		}
		echo "</center>";
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingduration();
	CloseTable();
	include_once("footer.php");
}

function  NukeCAdsDurationAdd() {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<script>\n"
		."<!--\n"
		."  function ValidateAddDuration() {\n"
		."	var d_value = document.AdsDuration.d_value.value;\n"
		."	var d_alias = document.AdsDuration.d_alias.value;\n"
		."  if ((d_value == \"\") || (d_alias == \"\")) {\n"
		." 		alert('Error : \\n\\nBoth Duration value and Duration Alias are required');\n"
		."		return false;"
		."	} else return true;\n"
		."	}\n"
		."//-->\n"
		."</script>\n";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	echo "<strong>Add Ads Duration</strong>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingduration();
	echo "<br />";
	echo "<table cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor5."\">";
	echo "<strong>Add New Ads Duration</strong></td></tr>"
		."<form name=\"AdsDuration\" action=\"admin.php?op=NukeC30AdsDurationSave\" method=\"post\" onsubmit=\"return ValidateAddDuration();\">"
		."<tr><td bgcolor=\"".$adsbgcolor4."\" width=\"25%\" nowrap=\"nowrap\">Ads Duration value (day)\n"
		."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"d_value\" size=\"5\" maxlength=\"4\" /></td></tr>"
		."<tr><td valign=\"top\" bgcolor=\"".$adsbgcolor4."\">Duration Alias\n"
		."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"d_alias\" size=\"20\" maxlength=\"60\" /></td></tr>";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\" align=\"center\"><input type=\"submit\" value=\"Submit\" /></td></tr>"
		."</form>";
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function NukeCAdsDurationSave($d_value,$d_alias) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$res = $db->sql_query("insert into ".$nukecprefix."_ads_duration values ('','$d_value','$d_alias')");
	if (!$res) {
		die(mysql_error());
	}
	header("Location:admin.php?op=NukeC30AdsDuration&msgid=DurAdded");
}

function NukeCAdsDurationEdit($nod) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />\n";
	echo "<script>\n"
		."<!--\n"
		."function UpdateAdsDuration() {\n"
		."	var DurValue = document.AdsDurationEdit.xd_value.value;\n"
		."	var DurAlias = document.AdsDurationEdit.xd_alias.value;\n"
		."  	if ((DurValue == '') || (DurAlias == '')) {\n"
		." 			alert('Error : \\n\\nBoth Duration value and Duration Alias are required');\n"
		."			return false;\n"
		."		} else { \n"
		."			return true;\n"
		."		}\n"
		."}\n"
		."//-->\n"
		."</script>";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	echo "<strong>Edit Ads Duration</strong>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	listingduration();
	$re = $db->sql_query("select duration_value, duration_alias from ".$nukecprefix."_ads_duration where id_duration='$nod'");
	list ($duration_value, $duration_alias) = $db->sql_fetchrow($re);
	echo "<br />";
	echo "<table cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td align=\"center\" bgcolor=\"".$adsbgcolor5."\" colspan=\"2\">";
	echo "<strong>Edit Ads Duration</strong></td></tr>";
	echo "<form name=\"AdsDurationEdit\" onsubmit=\"return UpdateAdsDuration();\" action=\"admin.php?op=NukeC30AdsDurationUpdate\" method=\"post\">"
		."<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor4."\" nowrap=\"nowrap\">Ads Duration value (day)\n"
		."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xd_value\" size=\"5\" maxlength=\"4\" value=\"$duration_value\" />  (0 = unlimited)</td></tr>"
		."<tr><td valign=\"top\"  bgcolor=\"".$adsbgcolor4."\">Duration Alias\n"
		."</td><td  bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"xd_alias\" size=\"20\" maxlength=\"25\" value=\"$duration_alias\" /></td></tr>"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Update\" /></td></tr>"
		."<input type=\"hidden\" name=\"xno\" value=\"$nod\" />"
		."</form>";
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function NukeCAdsDurationUpdate($xno,$xd_value,$xd_alias) {
	global $nukecprefix,$db;
	$sqlupdate = "update ".$nukecprefix."_ads_duration set duration_value='$xd_value', duration_alias='$xd_alias' where id_duration='$xno'";
	$db->sql_query($sqlupdate);
	header("Location:admin.php?op=NukeC30AdsDuration&msgid=DurUpdated");
}

function NukeCAdsDurationDelete($nod) {
	global $nukecprefix,$db;
	$db->sql_query("delete from ".$nukecprefix."_ads_duration where id_duration='".$nod."'");
	header("Location:admin.php?op=NukeC30AdsDuration&msgid=DurDeleted");
}

function listingduration() {
	global $nukecprefix,$db, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$re = $db->sql_query("select id_duration, duration_value, duration_alias from ".$nukecprefix."_ads_duration order by duration_value");
	if ($db->sql_numrows($re) > 0) {
		echo "<br /><table  cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr bgcolor=\"".$adsbgcolor5."\"><td><strong>Ads Duration (Days)</strong></td><td width=\"125\"><strong>Duration Alias</strong></td>\n"
			."<td width=\"110\">&nbsp;</td></tr>\n";
		
		while (list ($no,$duration_v,$duration_al) = $db->sql_fetchrow($re)) {
			echo "<tr bgcolor=\"".$adsbgcolor2."\"><td>$duration_v</td><td>$duration_al</td>\n"
				."<td align=\"center\">\n"
				."[ <a href=\"admin.php?op=NukeC30AdsDurationEdit&nod=$no\">"._NUKECEDIT."</a> | \n"
				."<a href=\"admin.php?op=NukeC30AdsDurationDelete&nod=$no\" onclick=\"return confirm('"._NUKECONFIRMDELDISC."')\">"._NUKECDELETE."</a> ]</td>\n"
				." </tr>\n";
		}
		echo "</table>";
		echo "</td></tr></table>";
	} else {
		echo "<center>No Ads Duration Initialized</center>";
	}
}

switch($op) {
	case "NukeC30AdsDuration" : NukeCAdsDuration($nod,$msgid);break;
	case "NukeC30AdsDurationAdd":NukeCAdsDurationAdd();break;
	case "NukeC30AdsDurationSave":  NukeCAdsDurationSave($d_value,$d_alias);break;
	case "NukeC30AdsDurationEdit" : NukeCAdsDurationEdit($nod);break;
	case "NukeC30AdsDurationUpdate":NukeCAdsDurationUpdate($xno,$xd_value,$xd_alias);break;
	case "NukeC30AdsDurationDelete" : NukeCAdsDurationDelete($nod,$msgid);break;
	}
} else {
    echo "Access Denied";
}

?>
