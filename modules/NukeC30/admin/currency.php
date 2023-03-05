<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to maintains Currencies in NukeC30 Addon
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

$devider = 10;



function NukeCadminCurrency($msgid,$NumEdit,$add) {
	global $nukecprefix,$db, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	echo "<script language=\"JavaScript\">\n"
		."function cekentry() {\n"
		."	var mu = document.formmatauang.kmu.value;\n"
		."	var ngr = document.formmatauang.negara.value;\n"
		." if ((mu == '') || (ngr == '')) {\n"
		." 	alert ('"._NUKECCURRCOUNTRYREQ."');\n"
		."	return false;\n"
		." } else { return true; }\n"
		."}\n"
		."</script>\n\n";
	//GraphicAdmin();
	OpenTable();
	echo "<br />";
	NukeCAdminMenu();
	
	$admintitle = "NukeC30 Ads Currency";
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$adsbgcolor2\" align=\"center\">";
	
	echo "<font><strong>$admintitle</strong></font>\n";
	if (isset($msgid) && ($msgid != "")) {
		echo "<strong>";
		switch ($msgid) {
			case "CurrDeleted": $MSGTEXT = _NUKECCURRDELETED;break;
			case "CurrAdded" : $MSGTEXT = _NUKECCURRADDED;break;
			case "CurrUpdated": $MSGTEXT = _NUKECCURRUPDATED;break;
		}
		echo "</strong>";
		echo "<br /><br />".$MSGTEXT;
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	echo "<br />";
	
	$re = $db->sql_query("select no,curr,country from ".$nukecprefix."_ads_currency order by no");
	
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">"
		."<tr bgcolor=\"".$adsbgcolor5."\">\n"
		."<td width=\"20\"><font class=\"content\"><strong>"._NUKECNO."</strong></font></td>\n"
		."<td><font class=\"content\"><strong>"._NUKECCURRENCY."</strong></font></td>\n"
		."<td><font class=\"content\"><strong>"._NUKECCOUNTRY."</strong></font></td>\n"
		."<td width=\"125\" align=\"center\">&nbsp;</td>\n"
		."</tr>\n";
	$i = 0;
		while (list ($no,$curr,$country) = $db->sql_fetchrow($re)) {
			$i++;
			if ($i % 2 == 0) {
				$bgc = $adsbgcolor2;
			} else {
				$bgc = $adsbgcolor4;
			}
			echo "<tr bgcolor=\"$bgc\"><td>$i</td><td>$curr</td><td>$country</td>\n"
				."<td align=\"center\">[ <a href=\"admin.php?op=NukeC30currency&NumEdit=$no\" class=\"content\"><strong>"._NUKECEDIT."</strong></a> \n"
				."| <a href=\"admin.php?op=NukeC30DeleteCurr&no=$no\" class=\"content\" onclick=\"return confirm('Are you sure to delete ?');\"><strong>"._NUKECDELETE."</strong></a> ]</td></tr>\n";
		}
	echo "</table>\n";
	echo "</td></tr></table>";
	
	if (isset($NumEdit) && ($NumEdit != "")) {
		echo "<br />";
		$sqlupdate = "select curr, country from ".$nukecprefix."_ads_currency where no='$NumEdit'";
		$re = $db->sql_query($sqlupdate);
		list ($curr,$country) = $db->sql_fetchrow($re);
		$curr = FixQuotes($curr);
		echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr><td bgcolor=\"".$adsbgcolor5."\" colspan=\"2\"><strong>"._NUKECEDITCURR."</strong></td></tr>";
		
		echo "<form name=\"formmatauang\" action=\"admin.php?op=NukeC30UpdateCurr\" method=\"post\" onsubmit=\"return cekentry();\">";
		echo "<input type=\"hidden\" name=\"NoCurr\" value=\"$NumEdit\" />";
		echo "<tr><td width=\"25%\" bgcolor=\"".$adsbgcolor4."\">"._NUKECCURRENCY."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"kmu\" value=\"$curr\" size=\"10\" maxlength=\"10\" /> ( <i>"._NUKECSAMPLE."</i> : \"US$\", \"Rp\")</td></tr>";
		echo "<tr><td bgcolor=\"".$adsbgcolor4."\">"._NUKECCOUNTRY."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"negara\" value=\"$country\" size=\"30\" maxlength=\"50\" /> ( <i>"._NUKECSAMPLE."</i> : \"Singapore\", \"Indonesia\")</td></tr>";
		echo "";
		echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Update\" /> [ <a href=\"admin.php?op=NukeC30DeleteCurr&no=$NumEdit\" class=\"content\" onclick=\"return confirm('"._NUKECDELCURRCONFIRM."');\"><strong>"._NUKECDELETE."</strong></a>  ]</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</td></tr></table>";
	}
	
		echo "<br />";
		echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\"><strong>"._NUKECADDCURRENCY."</strong></td></tr>";
		echo "<form name=\"formmatauang\" action=\"admin.php?op=NukeC30AddCurr\" method=\"post\" onsubmit=\"return cekentry();\">";
		echo "<tr><td  width=\"25%\" bgcolor=\"".$adsbgcolor4."\">"._NUKECCURRENCY."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"kmu\" size=\"10\" maxlength=\"10\" /> ( <i>"._NUKECSAMPLE."</i> : \"US$\", \"Rp\")</td></tr>";
		echo "<tr><td bgcolor=\"".$adsbgcolor4."\">"._NUKECCOUNTRY."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"negara\" size=\"30\" maxlength=\"50\" /> ( <i>"._NUKECSAMPLE."</i> : \"Singapore\", \"Indonesia\")</td></tr>";
		echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\"Submit\" /></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</td></tr></table>";

	CloseTable();
	include_once("footer.php");
}

function NukeCDeleteCurr($no){
	global $nukecprefix,$db;
	$sql = "delete from ".$nukecprefix."_ads_currency where no='$no'";
	$re = $db->sql_query($sql);
	if (!$re) {
		die(mysql_error());
	}
	header("Location:admin.php?op=NukeC30currency&msgid=CurrDeleted");
}

function NukeCUpdateCurr($NoCurr,$kmu,$negara) {
	global $nukecprefix,$db;
	$db->sql_query("update ".$nukecprefix."_ads_currency set curr='$kmu', country='$negara' where no='$NoCurr'");
	header("Location:admin.php?op=NukeC30currency&msgid=CurrUpdated");
}

function NukeCAddCurr($kmu,$negara) {
	global $nukecprefix,$db;
	$db->sql_query("insert into ".$nukecprefix."_ads_currency values('','$kmu','$negara')");
	header("Location:admin.php?op=NukeC30currency&msgid=CurrAdded");
}

global $msgid,$NumEdit,$add;
switch($op) {
	case "NukeC30UpdateCurr":NukeCUpdateCurr($NoCurr,$kmu,$negara);break;
	case "NukeC30AddCurr":NukeCAddCurr($kmu,$negara);break;
	case "NukeC30DeleteCurr": NukeCDeleteCurr($no);break;
	case "NukeC30EditCurr"; NukeCEditCurr();break;
	case "NukeC30currency" : NukeCadminCurrency($msgid,$NumEdit,$add);break;
	}

} else {
    echo "Access Denied";
}

?>
