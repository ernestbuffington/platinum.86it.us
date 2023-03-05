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

function NukeCDisclaimer($nod,$msgid) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<b >"._NUKECADMINDISCLAIM."</strong>";
	echo "<br /><br />[ <a href=\"admin.php?op=NukeC30AddDisclaimer\">"._NUKECADDDISCLAIM."</a> ]";
	if ((isset($msgid)) && ($msgid != "")) {
		echo "<br /><br /><center>";
		switch ($msgid) {
			case "DiscAdded": echo _NEWDISCADDED;break;
			case "DiscUpdated": echo _DISCUPDATED;break;
			case "DiscDeleted": echo _DISCDELETED;break;
			
		}
		echo "</center>";
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	
	listingdisc();
	
	CloseTable();
	if ((isset($nod)) && ($nod != "")) {
		echo "<br />";
		OpenTable();
		echo "<strong>"._NUKECPREVIEWDISC."</strong><br /><br />";
		$re = $db->sql_query("select no,title, content from $nukecprefix"."_ads_disclaimer where no='$nod'");
		list ($no,$title,$content) = $db->sql_fetchrow($re);
		echo "<font class=\"title\">$title</font><br /><br />";
		echo "$content";
		echo "<br /><br />[ <a href=\"admin.php?op=NukeC30EditDisclaimer&nod=$no\">"._NUKECEDIT."</a> | \n"
			."<a href=\"admin.php?op=NukeC30DeleteDisclaimer&nod=$no\" onclick=\"return confirm('"._NUKECONFIRMDELDISC."')\">"._NUKECDELETE."</a> ]\n";
		CloseTable();
	}
	include_once("footer.php");
}

function NukeCAddDisclaimer() {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<b >"._NUKECADMINDISCLAIM."</strong>";
	echo "<br /><br />[ <a href=\"admin.php?op=NukeC30AddDisclaimer\">"._NUKECADDDISCLAIM."</a> ]";
	if ((isset($msgid)) && ($msgid != "")) {
		echo "<br /><center>";
		switch ($msgid) {
			case "DiscAdded": echo _NEWDISCADDED;break;
			case "DiscUpdated": echo _DISCUPDATED;break;
			case "DiscDeleted": echo _DISCDELETED;break;
			
		}
		echo "</center><br /><br />";
	}
	
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	
	listingdisc();
	
	echo "<br />";
	
	
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor5."\">";
	echo "<strong>"._NUKECADDDISCLAIM."</strong></td></tr>"
		."<form action=\"admin.php?op=NukeC30SaveDisclaimer\" method=\"post\">"
		."<tr><td bgcolor=\"$adsbgcolor4\" width=\"25%\"><strong>"._NUKECDISCTITLE."</strong>\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"254\"></td></tr>"
		."<tr><td valign=\"top\" bgcolor=\"$adsbgcolor4\"><strong>"._NUKECDISCCONTENT."</strong>\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><textarea name=\"content\" cols=\"60\" rows=\"25\"></textarea></td></tr>";
	
	if ($multilingual) {
	echo "<tr><td bgcolor=\"$adsbgcolor4\">"._NUKECLANGUAGE."</td><td bgcolor=\"$adsbgcolor2\">";
	echo "<select name=\"disclanguage\">";
	$handle=opendir('language');
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
		$languageslist .= "$langFound ";
	    }
	}
	closedir($handle);
	$languageslist = explode(" ", $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
	        echo "<option value=\"$languageslist[$i]\" ";
	        if($languageslist[$i]==$language) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	echo "<option value=\"\">"._NUKECALL."</option>\n";
	echo "</select>";
	echo "</td></tr>";
	} else {
		echo "<input type=\"hidden\" name=\"disclanguage\" value=\"\" />";
	}
	
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\" align=\"center\"><input type=\"submit\" value=\"Submit\" /></td></tr>"
		."</form>";
		
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}

function NukeCSaveDisclaimer($title,$content,$disclanguage) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	if (($title == "") or ($content == "")) {
		$errormsg = _NUKECDISCERROR3;
	}
	$re = $db->sql_query("select * from $nukecprefix"."_ads_disclaimer where language='$disclanguage'");
	if ($db->sql_numrows($re) > 0) {
		global $nukecprefix,$db,$bgcolor1,$bgcolor2;
		include_once("header.php");
		//GraphicAdmin();
		OpenTable();
		NukeCAdminMenu();
		echo "<br /><table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\" ><tr><td bgcolor=\"$adsbgcolor2\">\n";
	
		if ($disclanguage == "") {
			$slclang = _NUKECALL;
		} else {
			$slclang = $disclanguage;
		}
		echo "<center>";
		echo "<font><strong>"._NUKECDISCERRORTITLE."</strong></font><br /><br />";
		echo "$errormsg";
		echo _NUKECDISCERROR1."\"<strong>$slclang</strong>\""._NUKECDISCERROR2."";
		echo "<br /><br /><a href=\"javascript:history.go(-1);\">"._NUKECGOBACK."</a>";
		echo "</center>";
		echo "</td></tr></table>";
		echo "</td></tr></table>";
		
		CloseTable();
		include_once("footer.php");
	} else {
		$db->sql_query("insert into $nukecprefix"."_ads_disclaimer values ('','$title','$content','$disclanguage')");
		header("Location:admin.php?op=NukeC30Disclaimer&msgid=DiscAdded");
	}
}

function NukeCEditDisclaimer($nod) {
	global $nukecprefix,$db,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$multilingual;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\">";
	echo "<b >"._NUKECADMINDISCLAIM."</strong>";
	echo "<br /><br />[ <a href=\"admin.php?op=NukeC30AddDisclaimer\">"._NUKECADDDISCLAIM."</a> ]";
	if ((isset($msgid)) && ($msgid != "")) {
		echo "<br /><br /><center>";
		switch ($msgid) {
			case "DiscAdded": echo _NEWDISCADDED;break;
			case "DiscUpdated": echo _DISCUPDATED;break;
			case "DiscDeleted": echo _DISCDELETED;break;
			
		}
		echo "</center>";
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	
	listingdisc();
	
	
	$re = $db->sql_query("select no,title, content,language from $nukecprefix"."_ads_disclaimer where no='$nod'");
	list ($no,$title,$content,$language) = $db->sql_fetchrow($re);
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td align=\"center\" bgcolor=\"".$adsbgcolor5."\" colspan=\"2\">";
	echo "<strong>"._NUKECEDITDISCLAIM."</strong></td></tr>";

	echo "<form action=\"admin.php?op=NukeC30UpdateDisclaimer\" method=\"post\">"
		."<tr><td width=\"25%\" bgcolor=\"$adsbgcolor4\"><strong>"._NUKECDISCTITLE."</strong>\n"
		."</td><td bgcolor=\"$adsbgcolor2\"><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"254\" value=\"$title\" /></td></tr>"
		."<tr><td valign=\"top\"  bgcolor=\"$adsbgcolor4\"><strong>"._NUKECDISCCONTENT."</strong>\n"
		."</td><td  bgcolor=\"$adsbgcolor2\"><textarea name=\"content\" cols=\"60\" rows=\"25\">$content</textarea></td></tr>";

	echo "<tr><td  bgcolor=\"$adsbgcolor4\">"._NUKECLANGUAGE."</td><td  bgcolor=\"$adsbgcolor2\">";
	echo "<select name=\"disclanguage\">";
	$handle=opendir('language');
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
		$languageslist .= "$langFound ";
	    }
	}
	closedir($handle);
	$languageslist = explode(" ", $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
	        echo "<option value=\"$languageslist[$i]\" ";
	        if($languageslist[$i]==$language) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	echo "<option value=\"\" ";
	if ($language == "") {
		echo "selected";
	}
	
	echo ">"._NUKECALL."</option>\n";
	echo "</select>";
	echo "</td></tr>"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Update\" /></td></tr>"
		."<input type=\"hidden\" name=\"no\" value=\"$nod\" />"
		."</form>";
		
	echo "</table>";
	echo "</td></tr></table>";

	CloseTable();
	include_once("footer.php");
}

function NukeCUpdateDisclaimer($no,$title,$content,$disclanguage) {
		global $nukecprefix,$db;
	if (($title == "") or ($content == "")) {
		$errormsg = _NUKECDISCERROR3;
	}
	$re = $db->sql_query("select * from $nukecprefix"."_ads_disclaimer where language='$disclanguage' and no<>'$no'");
	if ($db->sql_numrows($re) > 0) {
		global $nukecprefix,$db,$bgcolor1,$bgcolor2;
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		if ($disclanguage == "") {
			$slclang = _NUKECALL;
		} else {
			$slclang = $disclanguage;
		}
		echo "<center>";
		echo "<font class=\"title\">"._NUKECDISCERRORTITLE."</font><br /><br />";
		echo "$errormsg";
		echo _NUKECDISCERROR1."\"<strong>$slclang</strong>\""._NUKECDISCERROR2."";
		echo "<br /><br /><a href=\"javascript:history.go(-1);\">"._NUKECGOBACK."</a>";
		echo "</center>";
		CloseTable();
		include_once("footer.php");
	} else {
		$db->sql_query("update $nukecprefix"."_ads_disclaimer set title='$title', content='$content', language='$disclanguage' where no='$no'");
		header("Location:admin.php?op=NukeC30Disclaimer&msgid=DiscUpdated");
	}
}

function NukeCDeleteDisclaimer($nod) {
	global $nukecprefix,$db;
	$db->sql_query("delete from $nukecprefix"."_ads_disclaimer where no='$nod'");
	header("Location:admin.php?op=NukeC30Disclaimer&msgid=DiscDeleted");
}

function listingdisc() {
	global $nukecprefix,$db, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	$re = $db->sql_query("select no,title, language from $nukecprefix"."_ads_disclaimer order by no");
	if ($db->sql_numrows($re) > 0) {
		echo "<br /><table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr bgcolor=\"".$adsbgcolor5."\"><td><strong>"._NUKECADSTITLE."</strong></td><td width=\"125\"><strong>"._NUKECLANGUAGE."</strong></td>\n"
			."<td width=\"110\">&nbsp;</td></tr>\n";
		
		while (list ($no,$title,$language) = $db->sql_fetchrow($re)) {
			if ($language == "") {
				$currlang = _NUKECALL;
			} else {
				$currlang = $language;
			}
			echo "<tr bgcolor=\"$adsbgcolor2\"><TD><a href=\"admin.php?op=NukeC30Disclaimer&nod=$no\">$title</a></td><td>$currlang</td>\n"
				."<td align=\"center\">\n"
				."[ <a href=\"admin.php?op=NukeC30EditDisclaimer&nod=$no\">"._NUKECEDIT."</a> | \n"
				."<a href=\"admin.php?op=NukeC30DeleteDisclaimer&nod=$no\" onclick=\"return confirm('"._NUKECONFIRMDELDISC."')\">"._NUKECDELETE."</a> ]</td>\n"
				." </tr>\n";
		}
		echo "</table>";
		echo "</td></tr></table>";
	
	} else {
		echo "<center>"._NUKECNODISCLAIM."</center>";
	}
}
global $nod,$msgid;
switch($op) {
	case "NukeC30Disclaimer" : NukeCDisclaimer($nod,$msgid);break;
	case "NukeC30AddDisclaimer":NukeCAddDisclaimer();break;
	case "NukeC30SaveDisclaimer":NukeCSaveDisclaimer($title,$content,$disclanguage);break;
	case "NukeC30EditDisclaimer":NukeCEditDisclaimer($nod);break;
	case "NukeC30UpdateDisclaimer":NukeCUpdateDisclaimer($no,$title,$content,$disclanguage);break;
	case "NukeC30DeleteDisclaimer":NukeCDeleteDisclaimer($nod) ;break;
	}

} else {
    echo "Access Denied";
}

?>
