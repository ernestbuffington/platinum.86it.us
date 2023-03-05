<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to maintain categories NukeC30 Addon
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


function NukeCAdminCatg(){ /* Start Function NukeCAdminCatg */
	global $NukeCAddonName,$nukecprefix,$db,$multilingual,$currentlang,$NukeCAddonName, $adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5;
	include_once("header.php");
	//GraphicAdmin();
	
	OpenTable();
	NukeCAdminMenu();
	$admintitle = _NUKECADMINTITLE." - "._NUKECADMINCATG;
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><TR><TD align=\"center\" bgcolor=\"".$adsbgcolor2."\" align=\"center\">";
	
	echo "<font><strong>$admintitle</strong></font>\n";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	echo "<br />";
	
	echo "<script>\n"
		."<!--\n"
		."  function ValidateAddCatg() {\n"
		."	var title = document.NukeCCatgForm.title.value;\n"
		."  if (title == \"\") {\n"
		." 		alert('Error :\\n"._NUKECADDCATGALERTTITLE."');\n"
		."		return false;"
		."	} else return true;\n"
		."	}\n"
		."//-->\n"
		."</script>\n";
	
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\"><strong>"._NUKECADDNEWCATG."</strong></td></tr>"
	  	."<form method=\"post\" action=\"admin.php\" name=\"NukeCCatgForm\" onsubmit=\"return ValidateAddCatg();\" enctype=\"multipart/form-data\">\n"
		."<tr><td width=\"30%\"  bgcolor=\"".$adsbgcolor4."\">\n"
		.""._NUKECCATGNAME." </td><td  bgcolor=\"".$adsbgcolor2."\">\n"
		."<input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\" /> (<i>"._NUKECREQUIRED."</i>)</td></tr>\n"
		."<tr><td width=\"30%\" valign=\"top\"  bgcolor=\"".$adsbgcolor4."\">\n"
		.""._NUKECCATGDESC." </td>\n"
		."<td  bgcolor=\"".$adsbgcolor2."\"><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea></td></tr>\n"
		."<tr><td valign=\"top\"  bgcolor=\"".$adsbgcolor4."\">"._NUKECUPLOADIMAGECATG."</td>\n"
		."<td valign=\"top\"  bgcolor=\"".$adsbgcolor2."\">";
	echo "<table><tr><td valign=\"top\">";
	echo "<select name=\"catgimage\" onchange=\"showNukeCCatgimage();\">";
		$direktori = "modules/".$NukeCAddonName."/imagecatg";
		$handle=opendir($direktori);
    	while ($file = readdir($handle)) {
			$filelist[] = $file;
    	}
    	asort($filelist);
    	while (list ($key, $file) = each ($filelist)) {
			preg_match("#.gif|.jpg#",$file);
			if ($file == "." || $file == "..") {
	    		$a=1;
			} else {
		    	echo "<option value=\"$file\" ";
				if ($file == "noimage.gif") {
					echo "selected";
				}
				
				echo ">$file</option>";
			}
    	}
		echo "</select></td><td><img src=\"modules/".$NukeCAddonName."/imagecatg/noimage.gif\" name=\"imagecatg\" alt=\"\" />";
	echo "</td></tr></table>";
	echo "</td></tr>\n";
	 if ($multilingual == 1) {
	echo "<tr><td width=\"30%\" bgcolor=\"".$adsbgcolor4."\">\n";
	echo ""._LANGUAGE.": </td><td bgcolor=\"".$adsbgcolor2."\">\n"
	    ."<select name=\"catglanguage\">\n";
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
	    if($languageslist[$i]==$currentlang) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	echo "</select></td></tr>";
    } else {
	echo "<input type=\"hidden\" name=\"catglanguage\" value=\"\" />\n";
    }
	echo "<input type=\"hidden\" name=\"toId\" value=\"0\" />\n"
		. "<input type=\"hidden\" name=\"op\" value=\"NukeC30SubmitCatg\" />\n"
		."<tr><td colspan=\"2\"  bgcolor=\"".$adsbgcolor1."\">\n"
		."<input type=\"submit\" value=\""._NUKECSUBMIT."\" /></td></tr>\n"
		."</form></table>\n";
	echo "</td></tr></table>";

	/* Add a New Sub-Category*/
	$sql = "select * from ".$nukecprefix."_ads_catg ";
	if ($multilingual) {
		$sql .= "where language ='$currentlang'";
	} else {
		$sql .= "where language =''";
	}
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
		echo "<br />";
		
		echo "<script>\n"
			."<!--\n"
			."  function ValidateAddCatg2() {\n"
			."	var title = document.NukeCCatgForm2.title.value;\n"
			."  if (title == \"\") {\n"
			." 		alert('Error : \\n"._NUKECADDCATGALERTTITLE."');\n"
			."		return false;\n"
			."	} else return true;\n"
			."	}\n"
			."//-->\n"
			."</script>\n";
			
		echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><TR><TD bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\"><strong>"._NUKECADDNEWSUBCATG."</strong></td></tr>"
		   ."<form method=\"post\" action=\"admin.php\" name=\"NukeCCatgForm2\" onsubmit=\"return ValidateAddCatg2();\" enctype=\"multipart/form-data\">"

		    ."<tr><td width=\"30%\" bgcolor=\"".$adsbgcolor4."\">"._NUKECCATGNAME."</td><td bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\" /> (<i>"._NUKECREQUIRED."</i>)&nbsp;"._NUKECIN."&nbsp;";
		$sql2 = "select id_catg, catg, parentid from ".$nukecprefix."_ads_catg ";
		if ($multilingual) {
			$sql2 .= "where language ='$currentlang'";
		} else {
			$sql2 .= "where language =''";
		}
		
		$result2=$db->sql_query("$sql2 order by parentid,catg");
		echo "<select name=\"toId\">\n";
		while(list($id_catg2, $catg2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) $catg2=getparent($parentid2,$catg2);
		    echo "<option value=\"$id_catg2\">$catg2</option>\n";
		}
		echo "</select></td></tr>\n"
			."<tr><td bgcolor=\"".$adsbgcolor4."\">"._NUKECCATGDESC."</td><td bgcolor=\"".$adsbgcolor2."\"><textarea name=\"cdescription\" cols=\"60\" rows=\"10\"></textarea></td></tr>\n"
		   	."<tr><td valign=\"top\" bgcolor=\"".$adsbgcolor4."\">"._NUKECUPLOADIMAGECATG."</td>\n"
			."<td bgcolor=\"".$adsbgcolor2."\">";
			
		echo "<table><tr><td valign=\"top\">";
		echo "<select name=\"catgimage\" onchange=\"showNukeCCatgimage2();\">";
		$direktori = "modules/".$NukeCAddonName."/imagecatg";
		$handle=opendir($direktori);
		while ($file = readdir($handle)) {
			$filelist[] = $file;
    	}
    	asort($filelist);
    	while (list ($key, $file) = each ($filelist)) {
			preg_match("#.gif|.jpg#",$file);
			if ($file == "." || $file == "..") {
	    		$a=1;
			} else {
		    	echo "<option value=\"$file\" ";
				if ($file == "noimage.gif") {
					echo "selected";
				}
				echo ">$file</option>";
			}
    	}
		echo "</select></td><td><img src=\"modules/".$NukeCAddonName."/imagecatg/noimage.gif\" name=\"imagecatg2\" alt=\"\" />";
		echo "</td></tr></table>";

		echo "</td></tr>\n"
			."<tr><td bgcolor=\"".$adsbgcolor4."\">Language</td><td bgcolor=\"".$adsbgcolor2."\">";
		if ($multilingual) {
			echo ucfirst($currentlang) ." (Current Language)";
		} else {
			echo "All";
		}
		
		echo "</td></tr>"
		    ."<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\""._NUKECSUBMIT."\" /></td></tr>\n";
			$sql = "select * from ".$nukecprefix."_ads_catg ";
		if ($multilingual) {
			echo "<input type=\"hidden\" name=\"catglanguage\" value=\"$currentlang\" />\n";
		} else {
			echo "<input type=\"hidden\" name=\"catglanguage\" value=\"\" />\n";
		}
		echo "<input type=\"hidden\" name=\"op\" value=\"NukeC30SubmitCatg\" />\n"
		    ."</form></table>";
		echo "</td></tr></table>";
		
	}
	// Modify Category
   if ($numrows>0) {
		echo "<br />";
		echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
		echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
		echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor5."\" ><strong>"._NUKECMODIFYCATG."</strong></td></tr>";
		
		echo "<form action=\"admin.php\" method=\"post\">";
		echo "<tr><td bgcolor=\"".$adsbgcolor2."\">"._NUKECCHOOSECATG." : <select name=\"CatgId\">";
		$sql2 = "select id_catg, catg, parentid from ".$nukecprefix."_ads_catg ";
		if ($multilingual) {
			$sql2 .= "where language ='$currentlang'";
		} else {
			$sql2 .= "where language =''";
		}
		$result2=$db->sql_query($sql2 ." order by parentid,catg");

		while(list($id_catg2, $catg2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) $catg2=getparent($parentid2,$catg2);
		    echo "<option value=\"$id_catg2\">$catg2</option>\n";
		}
		echo "</select></td></tr>\n";
		echo "<tr><td bgcolor=\"".$adsbgcolor4."\" >";
		echo "<input type=\"radio\" name=\"op\" value=\"NukeC30ModCatg\" checked> "._NUKECEDITCATG." ";
		echo "<input type=\"radio\" name=\"op\" value=\"NukeC30DeleteCatg\"> "._NUKECDELETECATG." ";
		echo "</td></tr>";
		echo "<tr><td bgcolor=\"".$adsbgcolor1."\" >";
		echo "<input type=\"submit\" value=\"Submit\" /></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</td></tr></table>";
	}
	echo "<br />";
	
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><tr><td bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">";
	echo "<tr><td colspan=\"2\"  bgcolor=\"".$adsbgcolor5."\" ><strong>"._NUKECUPLOADIMAGECATG."</strong></td></tr>";
	echo "<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor2."\" >";
	echo "(just a name without spaces - max 20 characters)<br />";
	echo "( e.g : <strong>for_sell</strong> will be uploaded as <strong>for_sell.[image_type]</strong>)";
	echo "</td></tr>";
	echo "<tr><td bgcolor=\"".$adsbgcolor4."\" >";
	echo "<form action=\"admin.php?op=NukeC30UploadCatgImg\" method=\"post\" enctype=\"multipart/form-data\">\n"
		."Image Name</td><td bgcolor=\"".$adsbgcolor2."\" ><input type=\"text\" name=\"imagename\" size=\"20\" maxlength=\"20\" /> (<i>e.g : for_sell</i>)</td></tr>"
		."<tr><td bgcolor=\"".$adsbgcolor4."\" >Browser Image</td><TD bgcolor=\"".$adsbgcolor2."\" ><input type=\"file\" name=\"imageupload\" size=\"50\" /></td></tr>"
		."<tr><td colspan=\"2\" bgcolor=\"".$adsbgcolor1."\"><input type=\"Submit\" value=\"Upload\" /></td></tr>"
		."</form>";
		
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}/*	 END Function NukeCAdminCatg */


function DoNukeCUploadCatgImg($imagename,$imageupload,$imageupload_name,$imageupload_type,$imageupload_size) {
	global $CatgPathRev, $CatgPath,$nukecprefix,$db,$NukeCAddonName,$MaxImgSize, $MaxImgHeight, $MaxImgWidth;
	global $adsbgcolor1,$adsbgcolor2,$adsbgcolor3,$adsbgcolor4,$adsbgcolor5;
	$UploadImageType = getImgType();
	if ($imagename == "") {
		$errorimagename = 1;
	}
	if (($imagename != "") && (preg_match("# #",$imagename))) {
		$errorinspace = 1;
	}
	if ($imageupload != "") {
		if ($imageupload_size > ($MaxImgSize * 1024)) {
			$errorsize = 1;
		}
		$imagecatgsize = getimagesize($imageupload);
		$imgwidth = $imagecatgsize[0];
		$imgheight = $imagecatgsize[1];
		if (($imgwidth > $MaxImgWidth) || ($imgheight > $MaxImgHeight)) {
			$errordimension = 1;
		}
		$imagecatgtype = basename($imageupload_type);
		if (!in_array($imagecatgtype,$UploadImageType)) $errortype = 1;
	} else {
		$errorfileempty = 1;
	}
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><TR><TD bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"".$adsbgcolor2."\">";
	
	
	$admintitle  = _NUKECUPLOADCATGTITLE;
	echo "<center><font class=\"title\"><strong>$admintitle</strong></font></center><br />\n";
	echo "<center>";
	if ($errorimagename || $errorsize || $errordimension || $errortype || $errorfileempty || $errorinspace){
		$admintitle = _NUKECADMINTITLE." - "._NUKECERRORADDCATG;
		if ($errorimagename) {
			echo "<br />"._NUKECIMAGENAMEEMPTY."<br />\n";
		}
		if ($errorinspace) {
			echo "<br />"._NUKECIMAGENAMEERRORSPACE."<br />\n";
		}
		if ($errorfileempty) {
			echo "<br />"._NUKECIMAGEUPLOADEMPTY."<br />\n";
		}
		if ($errorsize) {
			echo "<br />"._NUKECERRORMAXSIZEALLOWED." $UploadImageSize "._NUKECKB."<br />";
		}
		if ($errordimension) {
			echo "<br />"._NUKECERRORMAXDIMENSION." $UploadImageHeight x $UploadImagewidth "._NUKECPIXEL."<br />";
		}
		if ($errortype) {
			echo "<br />Allowed File Types are : ";
			for ($i = 0;$i<= sizeof($UploadImageType)-1;$i++) {
				echo "<strong>'.".$UploadImageType[$i]."'</strong>";
				if ($j != sizeof($UploadImageType)-1) {
					echo ", ";
				}
				$j++;
			}
		}
	} else {
		if ($imagecatgtype == "pjpeg") {
			$imagecatgtype = "jpeg";
		}
		$filename = $CatgPath.$imagename.".".$imagecatgtype;
    	$copyprocess = @copy ($imageupload, $filename);
		if ($copyprocess) {
			echo _NUKECFILE." <strong>".$imagename.".".$imagecatgtype."</strong> "._NUKECCATGIMGCOPIED;
		} else {
			echo _NUKECERRORCOPYCATGIMAGE;
		}
		echo "<br /><br /><img src=\"".$CatgPathRev."$imagename.".$imagecatgtype."\" />";
	}
	
	echo "<br /><br />[ <a href=\"javascript:history.go(-1);\">"._NUKECBACK."</a> ]";
	echo "</center>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}


/* Start NukeCSubmitCatg */
function NukeCSubmitCatg($title,$cdescription,$toId,$catgimage,$catglanguage){
	global $NukeCAddonName,$multilingual;
	global $nukecprefix,$db;
	$sql = "select * from ".$nukecprefix."_ads_catg where catg='$title' and parentid='$toId'";
	if ($multilingual) {
		$sql .= " and language='$catglanguage'";
	}
	$re = $db->sql_query($sql);
	if ($db->sql_numrows($re) > 0) {
		$errorexist = 1;
	}

	if ($errorexist) {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		$admintitle = _NUKECADMINTITLE." - "._NUKECERRORADDCATG;
		echo "<center><font class=\"title\"><strong>$admintitle</strong></font></center><br />\n";
		echo "<center>";
		if ($errorexist) {
			echo "<br />"._NUKECERRORCATGEXIST."<br />";
		}
		echo "<br /><br />[ <a href=\"javascript:history.go(-1);\">"._NUKECBACK."</a>]";
		echo "</center>";
		CloseTable();
		include_once("footer.php");
	} else {
		$res = $db->sql_query("select max(id_catg) from ".$nukecprefix."_ads_catg ");
		list($maxidcatg) = $db->sql_fetchrow($res);
		$nextidcatg = $maxidcatg + 1;
		
		$title = ucfirst(FixQuotes(filter_text($title, "nohtml")));
		if ($cdsecription != "") {
			$cdescription = FixQuotes(nl2br(filter_text($cdescription)));
		}
		if ($catgimage == "noimage.gif") {
			$catgimage = "";
		}
		$sqlinsert  = "insert into ".$nukecprefix."_ads_catg values('$nextidads','$title','$cdescription','$toId','$catgimage','$catglanguage','0')";
		$db->sql_query($sqlinsert);
		//header("Location:admin.php?op=NukeC30AdminDone&msgid=NewCatgDone");
		header("Location:admin.php?op=NukeC30AdminCatg&msgid=NewCatgDone");
	}
} /* End NukeCSubmitCatg  */

function NukeCModCatg($CatgId){ /* Start Function NukeCModCatg */
	global $nukecprefix,$db,$multilingual,$currentlang,$adsbgcolor1, $adsbgcolor2, $adsbgcolor3, $adsbgcolor4, $adsbgcolor5,$NukeCAddonName;
	include_once("header.php");
	//GraphicAdmin();
	OpenTable();
	NukeCAdminMenu();
	echo "<br />";
	$admintitle = _NUKECADMINTITLE." - "._NUKECEDITCATG;
	echo "<table  width=\"95%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" bgcolor=\"".$adsbgcolor1."\"><TR><TD bgcolor=\"$adsbgcolor3\">";
	echo "<table cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"100%\">\n"
		."<tr><td align=\"center\" bgcolor=\"".$adsbgcolor5."\" colspan=\"2\">";
	
	echo "<font><strong>$admintitle</strong></font></td></tr>\n";
	
	
	$res = $db->sql_query("select catg,catg_desc,image,language from ".$nukecprefix."_ads_catg where id_catg='$CatgId'");
	list($xcatg, $xcatg_desc, $ximage,$xlanguage) = $db->sql_fetchrow($res);
	if ($ximage == "") { $ximage = "noimage.gif";}
	echo "<form name=\"NukeCCatgForm\" action=\"admin.php?op=NukeC30SaveModCatg\" method=\"post\" enctype=\"multipart/form-data\">"
		."<input type=\"hidden\" name=\"CatgId\" value=\"$CatgId\" />"
		."<input type=\"hidden\" name=\"OldCatg\" value=\"$xcatg\" />"
		."<tr><td width=\"30%\" bgcolor=\"".$adsbgcolor4."\">"._NUKECCATGNAME."</td><td  bgcolor=\"".$adsbgcolor2."\"><input type=\"text\" name=\"chng_title\" value=\"$xcatg\" size=\"30\" /></td></tr>"
		."<tr><td width=\"30%\" valign=\"top\"  bgcolor=\"".$adsbgcolor4."\">"._NUKECCATGDESC."</td><td  bgcolor=\"".$adsbgcolor2."\"><textarea cols=\"40\" rows=\"6\" name=\"chng_cdescription\">".check_html($xcatg_desc,"nohtml")."</textarea></td></tr>"
		."<tr><td valign=\"top\"  bgcolor=\"".$adsbgcolor4."\"> "._NUKECIMGCATG." <br />";
	echo "</td><td bgcolor=\"".$adsbgcolor2."\">";
	echo "<table><tr><td valign=\"top\" >";
	echo "<select name=\"catgimage\" onChange=\"showNukeCCatgimage();\">";
		$direktori = "modules/".$NukeCAddonName."/imagecatg";
		$handle=opendir($direktori);
    	while ($file = readdir($handle)) {
			$filelist[] = $file;
    	}
    	asort($filelist);
		
    	while (list ($key, $file) = each ($filelist)) {
			preg_match("#.gif|.jpg#",$file);
			if ($file == "." || $file == "..") {
	    		$a=1;
			} else {
		    	echo "<option value=\"$file\" ";
				if ($file == $ximage) {
					echo "selected";
				}
				
				echo ">$file</option>";
			}
    	}
		echo "</select></td><td><img src=\"modules/".$NukeCAddonName."/imagecatg/$ximage\" name=\"imagecatg\" alt=\"\" />";
	echo "</td></tr></table>";
	echo "</td></tr>";
 	if ($multilingual == 1) {
		echo "<tr><td width=\"30%\">\n";
		echo ""._LANGUAGE.": </td><TD>\n"
		    ."<select name=\"chng_catglanguage\">\n";
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
		    if($languageslist[$i]==$xlanguage) echo "selected";
				echo ">".ucfirst($languageslist[$i])."</option>\n";
		    }
		}
		echo "</select></td></tr>";
    } else {
		echo "<input type=\"hidden\" name=\"chng_catglanguage\" value=\"\" />\n";
    }
	echo "<tr><td colspan=\"2\"  bgcolor=\"".$adsbgcolor1."\"><input type=\"submit\" value=\""._NUKECADMINSAVECHANGES."\" /></td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</td></tr></table>";
	CloseTable();
	include_once("footer.php");
}/* End Function NukeCModCatg */

function NukeCSaveModCatg($CatgId,$chng_title, $chng_cdescription,$catgimage_change, $chng_catglanguage,$OldCatg) {
	global $NukeCAddonName;
	global $nukecprefix,$db,$UploadImageSize,$UploadImagewidth,$UploadImageHeight,$UploadImageType,$multilingual;
	include_once("modules/".$NukeCAddonName."/config.php");
	if ($chng_title == "") {
		$errorTitle = 1;
	}
	if ($OldCatg != $chng_title) {
		$sql = "select * from ".$nukecprefix."_ads_catg where catg='$chng_title'";
		if ($multilingual) {
			$sql .= " and language='$chng_catglanguage'";
		}
		$res = $db->sql_query($sql);
		if ($db->sql_numrows($res) > 0) {
			$errorexist = 1;
		}
	}

	if ($errorTitle || $errorexist) {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		$admintitle = _NUKECADMINTITLE." - "._NUKECERRORADDCATG;
		echo "<center><font class=\"title\"><strong>$admintitle</strong></font></center><br />\n";
		echo "<center>";
		if ($errorTitle) {
			echo "<br />"._NUKECADDCATGALERTTITLE."<br />";
		}
		if ($errorexist) {
			echo "<br />"._NUKECERRORCATGEXIST."<br />";
		}
		
		echo "<br /><br />[ <a href=\"javascript:history.go(-1);\">"._NUKECBACK."</a>]";
		echo "</center>";
		CloseTable();
		include_once("footer.php");
	} else {
		$chng_title = FixQuotes(filter_text($chng_title, "nohtml"));
		$chng_cdescription = FixQuotes(nl2br(filter_text($chng_cdescription)));
		$sqlupdate = "update ".$nukecprefix."_ads_catg set catg='$chng_title', catg_desc='$chng_cdescription' ";
		if ($catgimage_change == "nomage.gif") {
			$sqlupdate .= ",image =''";
		} else {
			$sqlupdate .= ",image = '$catgimage_change'";
		}
		
		$sqlupdate .= ", language = '$chng_catglanguage' where id_catg='$CatgId' ";
		$re = $db->sql_query($sqlupdate);
		header("Location:admin.php?op=NukeC30AdminCatg");
	}
}

function NukeCDeleteCatg($CatgId,$ok=0){ /* Start Function NukeCDeleteCatg */
	global $nukecprefix,$db;
	$result = $db->sql_query("select * from ".$nukecprefix."_ads_catg where parentid=$CatgId");
	$nbsubcat = $db->sql_numrows($result);
	$result2 = $db->sql_query("select id_catg from ".$nukecprefix."_ads_catg where parentid=$CatgId");
	while(list($cid2) = $db->sql_fetchrow($result2)) {
		$result3 = $db->sql_query("select * from ".$nukecprefix."_ads_ads where id_catg=$cid2");
		$nblink += $db->sql_numrows($result3);
	}
    if($ok==1) {
	if ($nbsubcat > 0) {
    	$db->sql_query("delete from ".$nukecprefix."_ads_ads where id_catg=$CatgId");
    	$result2 = $db->sql_query("select id_catg from ".$nukecprefix."_ads_catg where parentid=$CatgId");
    	while(list($cid2) = $db->sql_fetchrow($result2)) {
			$db->sql_query("delete from ".$nukecprefix."_ads_ads where id_catg=$cid2");
		}
	    $db->sql_query("delete from ".$nukecprefix."_ads_catg where parentid=$CatgId");
	    $db->sql_query("delete from ".$nukecprefix."_ads_catg where id_catg=$CatgId");
	} else {
		$db->sql_query("delete from ".$nukecprefix."_ads_catg where id_catg=$CatgId");
	    $db->sql_query("delete from ".$nukecprefix."_ads_ads where id_catg=$CatgId");
	}
	Header("Location: admin.php?op=NukeC30AdminCatg");
    } else {
		include_once("header.php");
		//GraphicAdmin();
		NukeCAdminMenu();
		echo "<br />";
		OpenTable();
		$admintitle = _NUKECADMINTITLE." - "._NUKECDELETECATGCONFIRM;
		echo "<center><font class=\"title\"><strong>$admintitle</strong></font></center><br />\n";
		echo "<center>";
		echo ""._NUKECTHEREIS." <strong>$nbsubcat</strong> "._NUKECSUBCATGINDB." "._NUKECUNDERTHISCATG."<br />";
		echo ""._NUKECTHEREIS." <strong>$nblink</strong> "._NUKECLASSIFIEDS." "._NUKECUNDERTHISCATG."<br />";
		echo ""._NUKECDELETEWARNING."<br /><br />";
		echo "[ <a href=\"admin.php?op=NukeC30DeleteCatg&CatgId=$CatgId&ok=1\"><strong>"._NUKECYES."</strong></a> | <a href=\"admin.php?op=NukeC30AdminCatg\"><strong>"._NUKECNO."</strong></a>]";
		echo "</center>";
		CloseTable();
		include_once("footer.php");
	}
}/* End Function NukeCDeleteCatg */


switch($op) {
	case "NukeC30AdminCatg": NukeCAdminCatg();break;
	case "NukeC30SubmitCatg": NukeCSubmitCatg($title,$cdescription,$toId,$catgimage,$catglanguage);break;
	case "NukeC30ModCatg":NukeCModCatg($CatgId);break;
	case "NukeC30SaveModCatg":NukeCSaveModCatg($CatgId,$chng_title, $chng_cdescription,$catgimage, $chng_catglanguage,$OldCatg);break;
	case "NukeC30DeleteCatg":NukeCDeleteCatg($CatgId,$ok);break;
	case "NukeC30UploadCatgImg":DoNukeCUploadCatgImg($imagename,$imageupload,$imageupload_name,$imageupload_type,$imageupload_size);break;
}

} else {
    echo "Access Denied";
}

?>
