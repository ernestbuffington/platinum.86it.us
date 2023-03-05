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

function NukeCCustomContent($msg_id) {
	global $nukecprefix,$db, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	CustomContentheaderAdmin();
	listingcontent();
	CloseTable();
	include_once("footer.php");
}

function listingcontent() {
	global $nukecprefix,$db,$NukeCAddonName,$adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
	$re = $db->sql_query("select custom_id, custom_title, weight, active, language  from ".$nukecprefix."_ads_custom order by weight");
	if ($db->sql_numrows($re) > 0) {
		echo "<br /><table width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr bgcolor=\"".$adsbgcolor5."\"><td><strong>Title</strong></td><td width=\"100\" colspan=\"2\" align=\"center\" width=\"40\"><strong>Weight</strong></td>\n"
			."<td width=\"50\" align=\"center\"><strong>Status</strong></td><td width=\"75\"><strong>Language</strong></td>"
			."<td width=\"100\">&nbsp;</td></tr>\n";
		
		while (list ($custom_id, $custom_title, $weight, $active, $language) = $db->sql_fetchrow($re)) {
			if ($active == 1) {
				$imgstatus = "<img border=\"0\" src=\"modules/".$NukeCAddonName."/images/on.gif\" alt=\"Deactivate\" />";
			} else {
				$imgstatus = "<img border=\"0\" src=\"modules/".$NukeCAddonName."/images/off.gif\" alt=\"Activate\" />";
			}
			$linkstatus = "<a href=\"admin.php?op=NukeC30CustomContentChangeStatus&content_id=$custom_id\">$imgstatus</a>"; 
			echo "<tr bgcolor=\"".$adsbgcolor2."\"><TD>$custom_title</td><td width=\"10\">$weight</td>";
			echo "<td align=\"center\" width=\"40\">";
			$weight1 = $weight - 1;
	    	$weight3 = $weight + 1;
	    	$res = $db->sql_query("select custom_id from ".$nukecprefix."_ads_custom where weight='$weight1'");
	    	list ($cid1) = $db->sql_fetchrow($res);
	    	$con1 = "$cid1";
	    	$res2 = $db->sql_query("select custom_id from ".$nukecprefix."_ads_custom where weight='$weight3'");
	    	list ($cid2) = $db->sql_fetchrow($res2);
	    	$con2 = "$cid2";
			
			 if ($con1) {
				echo"<a href=\"admin.php?op=NukeC30CustomContentOrder&weight=$weight&bidori=$custom_id&weightrep=$weight1&bidrep=$con1\"><img src=\"images/up.gif\" alt=\""._BLOCKUP."\" title=\""._BLOCKUP."\" border=\"0\" hspace=\"3\" /></a>";
	    	}
	    	if ($con2) {
				echo "<a href=\"admin.php?op=NukeC30CustomContentOrder&weight=$weight&bidori=$custom_id&weightrep=$weight3&bidrep=$con2\"><img src=\"images/down.gif\" alt=\""._BLOCKDOWN."\" title=\""._BLOCKDOWN."\" border=\"0\" hspace=\"3\" /></a>";
	    	}
			if ($language != "") {
				$cplanguage = ucfirst($language);
			} else {
				$cplanguage = "All";
			}
			echo "</td>\n"
				."<td align=\"center\">$linkstatus</td><td>".$cplanguage."</td>"
				."<td align=\"center\">\n"
				."<a href=\"admin.php?op=NukeC30CustomContentEdit&nod=$custom_id\"><img src=\"modules/".$NukeCAddonName."/images/edit.gif\" border=\"0\" width=\"21\" height=\"21\" alt=\""._NUKECEDIT."\" /></a> \n"
				."<a href=\"admin.php?op=NukeC30CustomContentDelete&nod=$custom_id\" onclick=\"return confirm('"._NUKECONFIRMDELDISC."')\"><img src=\"modules/".$NukeCAddonName."/images/del.gif\" border=\"0\" width=\"21\" height=\"21\" alt=\""._NUKECDELETE."\" /></a></td>\n"
				." </tr>\n";
		}
		echo "</table>";
		echo "</td></tr></table>";
	} else {
		echo "<center>No Ads Duration Initialized</center>";
	}
}

function NukeCCustomContentAdd() {
	global $nukecprefix,$db,$currentlang;
	global $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once('header.php');
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	CustomContentheaderAdmin();
	echo '<br />';
	echo '<table width="95%" cellpadding="1" cellspacing="1" align="center" bgcolor="'.$adsbgcolor1.'"><tr><td bgcolor="$adsbgcolor3">';
	echo '<table width="100%" cellspacing="1" cellpadding="2" border="0">'
		.'<form name="cpsubmit" action="admin.php?op=NukeC30CustomContentSubmit" method="post">'
		.'<tr><td colspan="2" bgcolor="'.$adsbgcolor5.'" align="center"><strong>Add Custom Page</strong></td></tr>'
		.'<tr><td colspan="2" bgcolor="'.$adsbgcolor2.'"><strong>Title</strong> is only as identification at NukeC30 admin page and will not be viewed at NukeC30 modules pages, only <strong>Custom content </strong>will be viewed at NukeC30 Modules pages<br /> Both of them are required. HTML tags are allowed at Custom content, but please double check it.</td></tr>'
		.'<tr><td width="30%" bgcolor="'.$adsbgcolor2.'">Title</td><td bgcolor="'.$adsbgcolor4.'"><input type="text" name="cptitle" size="40" /></td></tr>'
		.'<tr><td bgcolor="'.$adsbgcolor2.'" valign="top">Custom Content</td><td bgcolor="'.$adsbgcolor4.'"><textarea cols="70" rows="25" name="cpcontent"></textarea></td></tr>'
		.'<tr><td bgcolor="'.$adsbgcolor2.'">Language</td><td bgcolor="'.$adsbgcolor4.'">';
	echo '<select name="cplanguage">';
	echo '<option value="selected">All</option>';
	$handle=opendir("language");
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
	        $languageslist .= "$langFound";
	    }
	}
	closedir($handle);
	$languageslist = explode('', $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
	        echo "option value=$languageslist[$i]";
		if($languageslist[$i]==$currentlang) echo 'selected';
		echo ''.ucfirst($languageslist[$i]).'</option>';
	    }
	}
	echo '</select>';
	echo '</td></tr>'
		.'<tr><td bgcolor="'.$adsbgcolor2.'">Activate</td><td bgcolor="'.$adsbgcolor4.'"><input type="radio" name="cpstatus" value="1" checked="checked" /> Yes <input type="radio" name="cpstatus" value="0" /> No</td></tr>'
		.'<tr><td colspan="2" align="center" bgcolor="'.$adsbgcolor5.'"><input type="submit" value="Submit Custom Page" /></td></tr>'
		.'</form></table>';
	echo '</td></tr></table>';
	CloseTable();
	include_once('footer.php');
}

function NukeCCustomContentSubmit($cptitle,$cpcontent,$cpstatus,$cplanguage) {
	global $nukecprefix,$db;
	if (($cptitle == "") or ($cpcontent == "")) {
		global $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
		include_once('header.php');
		//GraphicAdmin();
		OpenTable();
		NukeCAdminMenu();
		CustomContentheaderAdmin();
		echo '<br />';
		echo '<table align="center" width="95%" cellspacing="1" cellpadding="2" border="0" bgcolor="'.$adsbgcolor1.'"><tr><td bgcolor="'.$adsbgcolor5.'" align="center">';
		if ($cptitle == "") {
			echo 'Title is Required<br />';
		}
		if ($cpcontent == "") {
			echo 'Custom Content is required<br />';
		}
		echo '<br />The form is not complete, please click on back and complete the form';
		echo '<br /><a href="javascript:history.back(-1);">Back</a>';
		echo '</td></tr></table>';
		CloseTable();
		include_once('footer.php');
	} else {
		if ($cpstatus) { 
			$cpstatus = 1;
		} else { 
			$cpstatus = 0;
		}
		$cptitle = stripslashes(FixQuotes($cptitle));
    	$cpcontent = stripslashes(FixQuotes($cpcontent));
		$resultweight = $db->sql_query('select MAX(weight) from '.$nukecprefix.'_ads_custom');
		list($cpweight) = $db->sql_fetchrow($resultweight);
		$cpweight = $cpweight + 1;
		//$sqlinsert = 'insert into '.$nukecprefix.'_ads_custom values('','$cptitle','$cpcontent','$cpweight','$cpstatus','$cplanguage',NOW()');
		$db->sql_query('insert into`'.$nukecprefix.'_ads_custom` values(null,\'' . $cptitle . '\', \'' . $cpcontent . '\' , \'' . $cpweight . '\' , \'' . $cpstatus . '\' , \'' . $cplanguage . '\',NOW()\')');
		$msg = 'CPadded';
		header('location: admin.php?op=NukeC30CustomContent&msg_id=$msg');
	}
}
function NukeCCustomContentOrder($weight,$bidori,$weightrep,$bidrep) {
    global $nukecprefix, $db;
    $result = $db->sql_query("update nukec30_ads_custom set weight='$weight' where custom_id='$bidrep'");
    $result2 = $db->sql_query("update nukec30_ads_custom set weight='$weightrep' where custom_id='$bidori'");
    Header("Location: admin.php?op=NukeC30CustomContent");
}

function NukeC30CustomContentDelete($nod) {
	global $nukecprefix, $db;
    $result = $db->sql_query("delete from ".$nukecprefix."_ads_custom where custom_id='$nod'");
    Header("location: admin.php?op=NukeC30CustomContent&msg_id=CDeleted");
}

function NukeCCustomContentEdit($nod) {
	global $nukecprefix,$db;
	global $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5, $languageslist;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	CustomContentheaderAdmin();
	echo "<br />";
	$resultcontent = $db->sql_query("select custom_title, content, active ,language from ".$nukecprefix."_ads_custom where custom_id='$nod'");
	list ($cptitle, $cpcontent, $cpactive ,$cplanguage) = $db->sql_fetchrow($resultcontent);
	echo "<table width=\"95%\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\">\n"
		."<form name=\"cpsubmit\" action=\"admin.php?op=NukeC30CustomContentUpdate\" method=\"post\">"
		."<input type=\"hidden\" name=\"xcpid\" value=\"".$nod."\" />"
		."<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\" align=\"center\"><strong>Edit Custom Page</strong></td></tr>";
		//.'<tr><td colspan="2" bgcolor="'.$adsbgcolor2.'"><strong>Title</strong> is only as identification at NukeC30 admin page and will not be viewed at NukeC30 modules pages, only <strong>Custom content </strong>will be viewed at NukeC30 Modules pages<br /> Both of them are required. HTML tags are allowed at Custom content, but please double check it.</td></tr>';
		echo '<tr><td bgcolor="'.$adsbgcolor2.'">Title</td></tr><tr><td bgcolor="'.$adsbgcolor4.'"><input type="text" name="xcptitle"  size="80" value="'.$cptitle.'" /></td></tr>';
		//."<tr><td bgcolor=\"".$adsbgcolor2."\" valign=\"top\">Custom Content</td><td bgcolor=\"".$adsbgcolor4."\"><textarea cols=\"70\" rows=\"15\" name=\"xcpcontent\">$cpcontent</textarea></td></tr>\n"
echo '<tr><td><br /><br /><strong>Custom Content</strong><br /></td></tr><tr><td>';
    wysiwyg_textarea('xcpcontent', ''.$cpcontent.'', 'PHPNukeAdmin', 80, 25);
		echo '</td></tr><tr><td bgcolor="'.$adsbgcolor2.'">Language</td></tr><tr><td bgcolor="'.$adsbgcolor4.'">';
	echo '<select name="xcplanguage">';
	echo '<option value=""';
	if ($cplanguage == "") {
		echo "selected";
	}
	echo ">All</option>";
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
		if($languageslist[$i] == $cplanguage) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	echo "</select>";
	echo "</td></tr>";
	if ($cpactive == 1) {
		$radioactive = "<input type=\"radio\" name=\"xcpstatus\" value=\"1\" checked=\"checked\" /> Yes ";
		$radioinactive = "<input type=\"radio\" name=\"xcpstatus\" value=\"0\" /> No";
	} else {
		$radioactive = "<input type=\"radio\" name=\"xcpstatus\" value=\"1\" /> Yes ";
		$radioinactive = "<input type=\"radio\" name=\"xcpstatus\" value=\"0\" checked=\"checked\" /> No";
	}
	echo "<tr><td bgcolor=\"".$adsbgcolor2."\">Activate</td></tr><tr><td bgcolor=\"".$adsbgcolor4."\">".$radioactive." ".$radioinactive."</td></tr>"
		."<tr><td colspan=\"2\" align=\"center\" bgcolor=\"".$adsbgcolor5."\"><input type=\"submit\" value=\"Submit Custom Page\" /></td></tr>"
		."</form></table>";
	echo "</td></tr></table>\n";
	CloseTable();
	include_once("footer.php");
}

function NukeC30CustomContentUpdate($xcpid, $xcptitle, $xcpcontent, $xcpstatus, $xcplanguage) {
	global $nukecprefix,$db;
	if (($xcptitle == "") or ($xcpcontent == "")) {
		global $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
		include_once("header.php");
		//GraphicAdmin();
		OpenTable();
		NukeCAdminMenu();
		CustomContentheaderAdmin();
		echo "<br />";
		echo "<table align=\"center\" width=\"95%\" cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"".$adsbgcolor5."\" align=\"center\">";
		if ($xcptitle == "") {
			echo "Title is Required<br />";
		}
		if ($xcpcontent == "") {
			echo "Custom Content is required<br />";
		}
		echo "<br />The form is not complete, please click on back and complete the form";
		echo "<br /><a href=\"javascript:history.back(-1);\">Back</a>";
		echo "</td></tr> </table>";
		CloseTable();
		include_once("footer.php");
	} else {
		if ($xcpstatus) { 
			$xcpstatus = 1;
		} else { 
			$xcpstatus = 0;
		}
		$xcptitle = stripslashes(FixQuotes($xcptitle));
    	$xcpcontent = stripslashes(FixQuotes($xcpcontent));
		
		$sqlupdatecontent = "update ".$nukecprefix."_ads_custom set custom_title='$xcptitle', content='$xcpcontent', language='$xcplanguage', active='$xcpstatus' where custom_id='$xcpid'";
		$db->sql_query($sqlupdatecontent);
		
		$msg = "CUpdated";
		header("location: admin.php?op=NukeC30CustomContent&msg_id=$msg");
	}
}


function NukeCCustomContentChangeStatus($content_id) {
	global $nukecprefix,$db;
	$resultstatus = $db->sql_query("select active from ".$nukecprefix."_ads_custcpidom where custom_id='$content_id'");
	if (!$resultstatus) {
		die(mysql_error());
	}
	list ($status) = $db->sql_fetchrow($resultstatus);
	if ($status == 0) {
		$setto = 1;
		$msg = "CustomContentActivated";
	} else {
		$setto = 0;
		$msg = "CustomContentDeActivated";
	}
	$resultset = $db->sql_query("update ".$nukecprefix."_ads_custom set active='$setto' where custom_id='$content_id'");
	if (!$resultset) {
		die(mysql_error());
	}
	header("location: admin.php?op=NukeC30CustomContent&msg_id=$msg");
}

function CustomContentheaderAdmin() {
	global $msg_id,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	echo "<strong>Custom Content Pages</strong>";
	//echo "<br /><br />[ <a href=\"admin.php?op=NukeC30CustomContentAdd\">Add Custom Page</a> ]";
	if ((isset($msg_id)) && ($msg_id != "")) {
		echo "<br /><br /><center>";
		switch ($msg_id) {
			case "CPadded": echo "New Custom Content Added";break;
			case "CUpdated": echo "Custom content updated"; break;
			case "CDeleted": echo "Selected Custom content Deleted"; break;
			case "CustomContentActivated": echo "Selected custom content activated";break;
			case "CustomContentDeActivated": echo "Selected custom content deactivated";break;
		}
		echo "</center>";
	}
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}
global $msg_id;
switch($op) {
	case "NukeC30CustomContent" : NukeCCustomContent($msg_id);break;
	case "NukeC30CustomContentOrder": NukeCCustomContentOrder($weight,$bidori,$weightrep,$bidrep);break;
	case "NukeC30CustomContentAdd" : NukeCCustomContentAdd();break;
	case "NukeC30CustomContentEdit" : NukeCCustomContentEdit($nod);break;
	case "NukeC30CustomContentChangeStatus" : NukeCCustomContentChangeStatus($content_id);break;
	case "NukeC30CustomContentUpdate" : NukeC30CustomContentUpdate($xcpid, $xcptitle, $xcpcontent, $xcpstatus, $xcplanguage);break;
	case "NukeC30CustomContentDelete" : NukeC30CustomContentDelete($nod);
	case "NukeC30CustomContentSubmit": NukeCCustomContentSubmit($cptitle,$cpcontent,$cpstatus,$cplanguage);break;
	}

} else {
    echo "Access Denied";
}

?>
