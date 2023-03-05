<?php

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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekman             (mighty_y@portedmods.com) */
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/


global $admin_file, $prefix, $db, $aid;
if(empty($admin_file)){
  $admin_file="admin";
}
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) { die ("Access Denied"); }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Tutorials'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	function getparent($parentid,$title) {
		global $admin_file, $prefix,$db;
		$parentid = intval($parentid);
		$result= $db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories where tc_id='$parentid'");
		list($tc_id, $tc_title, $pparentid) = $db->sql_fetchrow($result);
		if ($tc_title!="") {
			$title=$tc_title."/".$title;
		}
		if ($pparentid!=0) {
			$title=getparent($pparentid,$title);
		}
		return $title;
	}

	function main (){
		global $admin_file, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo""._TUTAMAIN."";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function category(){
		global $admin_file, $db, $prefix, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\"><font class=\"content\"><center><strong>"._TUTADMINADDMAINCATEGORY."</strong></center><br /><br />"._TUTADMINNAME.": <input type=\"text\" name=\"tc_title\" size=\"30\" maxlength=\"100\"><br />"._TUTADMINDESCRIPTION.":<br /><textarea name=\"description\" cols=\"60\" rows=\"10\"></textarea><br /><input type=\"hidden\" name=\"op\" value=\"addcategory\"><input type=\"submit\" value=\""._TUTADMINADD."\"><br /></form>";
		CloseTable();
		echo "<br />";
		$result = $db->sql_query("select * from ".$prefix."_tutorials_categories");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\"><font class=\"content\"><center><strong>"._TUTADMINADDSUBCATEGORY."</strong></center></font><br /><br />"._TUTADMINNAME.": <input type=\"text\" name=\"tt_title\" size=\"30\" maxlength=\"100\"><br />"._TUTADMININ."&nbsp;";
			$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by parentid,tc_title");
			echo "<select name=\"tt_id\">";
			while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
				if ($parentid2!=0) {
					$tc_title2=getparent($parentid2,$tc_title2);
				}
				echo "<option value=\"$tc_id2\">$tc_title2</option>";
			}
			echo "</select><br />"._TUTADMINDESCRIPTION.":<br /><textarea name=\"tt_description\" cols=\"60\" rows=\"10\"></textarea><br /><input type=\"hidden\" name=\"op\" value=\"addsubcategory\"><input type=\"submit\" value=\""._TUTADMINADD."\"><br /></form>";
			CloseTable();
			echo "<br />";
		}
		echo "</td>";
		bottom();
	}

	function modcategory() {
		global $admin_file, $db, $prefix, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\"><font class=\"content\"><center><strong>"._TUTADMINMODCATEGORY."</strong></center></font><br /><br />";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by tc_title");
		echo ""._TUTADMINCATEGORY.": <br /><select name=\"cat\">";
		while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) {
				$tc_title2=getparent($parentid2,$tc_title2);
			}
			echo "<option value=\"$tc_id2\">$tc_title2</option>";
		}
		echo "</select><input type=\"hidden\" name=\"op\" value=\"modcat\"><br /><input type=\"submit\" value=\""._TUTADMINMODIFY."\"></form>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function transfercategory() {
		global $admin_file, $db, $prefix, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\"><font class=\"option\"><strong>"._TUTADMINTRANSFERTUTORIALS."</strong></font><br /><br />"._TUTADMINCATEGORY.": <select name=\"cidfrom\">";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by parentid,tc_title");
		while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) {
				$tc_title2=getparent($parentid2,$tc_title2);
			}
			echo "<option value=\"$tc_id2\">$tc_title2</option>";
		}
		echo "</select><br />"._TUTADMININ."&nbsp;"._TUTADMINCATEGORY.": <select name=\"cidto\">";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by parentid,tc_title");
		while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) {
				$tc_title2=getparent($parentid2,$tc_title2);
			}
			echo "<option value=\"$tc_id2\">$tc_title2</option>";
		}
		echo "</select><br /><input type=\"hidden\" name=\"op\" value=\"transfertut\"><input type=\"submit\" value=\""._TUTADMINTRANSFER."\"><br /></form>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function tutorial_form(){
		global $admin_file, $module_name;
		include_once("modules/$module_name/include/bbcode_javascript.php");
		echo ""._TUTADMINTUTORIALTEXT.":<br />";
		echo "<font class=\"tiny\">"._TUTADMINPAGEBREAK."</font><br />";
		echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\">";
		echo "<tr>";
		echo "<td valign=\"top\"><span class=\"gen\"> <span class=\"genmed\"> </span>";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
		echo "<tr align=\"right\" valign=\"middle\">";
		echo "<td>";
		echo "<p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\" align=\"left\"><span class=\"gen\">";
		echo "<span class=\"genmed\">";
		echo "&nbsp;<select name=\"fc\" onChange=\"BBCfc()\" dir=\"ltr\">";
		echo "<option selected value=\"black\" class=\"genmed\">"._TUTBBFONTCOLOR."</option>";
		echo "<option style=\"color:darkred;\" value=\"darkred\" class=\"genmed\">"._TUTBBDARKRED."</option>";
		echo "<option style=\"color:red;\" value=\"red\" class=\"genmed\">"._TUTBBRED."</option>";
		echo "<option style=\"color:orange;\" value=\"orange\" class=\"genmed\">"._TUTBBORANGE."</option>";
		echo "<option style=\"color:brown;\" value=\"brown\" class=\"genmed\">"._TUTBBBROWN."</option>";
		echo "<option style=\"color:yellow;\" value=\"yellow\" class=\"genmed\">"._TUTBBYELLOW."</option>";
		echo "<option style=\"color:green;\" value=\"green\" class=\"genmed\">"._TUTBBGREEN."</option>";
		echo "<option style=\"color:olive;\" value=\"olive\" class=\"genmed\">"._TUTBBOLIVE."</option>";
		echo "<option style=\"color:cyan;\" value=\"cyan\" class=\"genmed\">"._TUTBBCYAN."</option>";
		echo "<option style=\"color:blue;\" value=\"blue\" class=\"genmed\">"._TUTBBBLUE."</option>";
		echo "<option style=\"color:darkblue;\" value=\"darkblue\" class=\"genmed\">"._TUTBBDARKBLUE."</option>";
		echo "<option style=\"color:indigo;\" value=\"indigo\" class=\"genmed\">"._TUTBBINDIGO."</option>";
		echo "<option style=\"color:violet;\" value=\"violet\" class=\"genmed\">"._TUTBBVIOLET."</option>";
		echo "<option style=\"color:white;\" value=\"white\" class=\"genmed\">"._TUTBBWHITE."</option>";
		echo "<option style=\"color:black;\" value=\"black\" class=\"genmed\">"._TUTBBBLACK."</option>";
		echo "</select>&nbsp;&nbsp; <select name=\"fs\" onChange=\"BBCfs()\" dir=\"ltr\">";
		echo "<option selected value=\"7\" class=\"genmed\">"._TUTBBFONTSIZE."</option>";
		echo "<option value=\"7\" class=\"genmed\">"._TUTBBTINY."</option>";
		echo "<option value=\"9\" class=\"genmed\">"._TUTBBSMALL."</option>";
		echo "<option value=\"12\" class=\"genmed\">"._TUTBBNORMAL."</option>";
		echo "<option value=\"18\" class=\"genmed\">"._TUTBBLARGE."</option>";
		echo "<option  value=\"24\" class=\"genmed\">"._TUTBBHUGH."</option>";
		echo "</select> <span lang=\"ar-sy\">&nbsp;</span><select name=\"ft\" onChange=\"BBCft()\" dir=\"ltr\">";
		echo "<option selected value=\"Arial\" class=\"genmed\">Font type</option>";
		echo "<option value=\"Arial\" class=\"genmed\">Default font";
		echo "</option>";
		echo "<option value=\"Andalus\" class=\"genmed\">";
		echo "Andalus</option>";
		echo "<option value=\"Arial\" class=\"genmed\">";
		echo "Arial</option>";
		echo "<option value=\"Comic Sans MS\" class=\"genmed\">";
		echo "Comic Sans MS</option>";
		echo "<option value=\"Courier New\" class=\"genmed\">";
		echo "Courier New</option>";
		echo "<option value=\"Lucida Console\" class=\"genmed\">Lucida Console";
		echo "</option>";
		echo "<option value=\"Microsoft Sans Serif\" class=\"genmed\">";
		echo "Microsoft Sans Serif</option>";
		echo "<option value=\"Symbol\" class=\"genmed\">";
		echo "Symbol</option>";
		echo "<option value=\"Tahoma\" class=\"genmed\">";
		echo "Tahoma</option>";
		echo "<option value=\"Times New Roman\" class=\"genmed\">";
		echo "Times New Roman</option>";
		echo "<option value=\"Traditional Arabic\" class=\"genmed\">";
		echo "Traditional Arabic</option>";
		echo "<option value=\"Verdana\" class=\"genmed\">";
		echo "Verdana</option>";
		echo "<option value=\"Webdings\" class=\"genmed\">";
		echo "Webdings</option>";
		echo "<option value=\"Wingdings\" class=\"genmed\">";
		echo "Wingdings</option>";
		echo "</select></span></span></span><p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">";
		echo "<span class=\"genmed\"><span style=\"font-size: 5pt\">&nbsp;</span></span></td>";
		echo "</tr>";
		echo "<span class=\"gen\">";
		echo "<tr>";
		echo "<td width=\"450\">";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr>";
		echo "<td>";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr>";
		echo "<td>";
		echo "<p dir=\"ltr\" align=\"left\"><span class=\"gen\">";
		echo "<span class=\"genmed\">";
		echo "<span lang=\"ar-sy\">&nbsp;</span><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/justify.gif\" name=\"justify\" type=\"image\" onClick=\"BBCjustify()\" style=\"border-style: outset; border-width: 1\" alt=\"justify\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/right.gif\" name=\"right\" type=\"image\" onClick=\"BBCright()\" style=\"border-style: outset; border-width: 1\" alt=\"right\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/center.gif\" name=\"center\" type=\"image\" onClick=\"BBCcenter()\" style=\"border-style: outset; border-width: 1\" alt=\"center\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/left.gif\" name=\"left\" type=\"image\" onClick=\"BBCleft()\" style=\"border-style: outset; border-width: 1\" alt=\"left\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/bold.gif\" name=\"bold\" type=\"image\" onClick=\"BBCbold()\" style=\"border-style: outset; border-width: 1\" alt=\"bold\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/italic.gif\" name=\"italic\" type=\"image\" onClick=\"BBCitalic()\" style=\"border-style: outset; border-width: 1\" alt=\"italic\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/under.gif\" name=\"under\" type=\"image\" onClick=\"BBCunder()\" style=\"border-style: outset; border-width: 1\" alt=\"under line\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/fade.gif\" name=\"fade\" type=\"image\" onClick=\"BBCfade()\" style=\"border-style: outset; border-width: 1\" alt=\"fade\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/grad.gif\" name=\"grad\" type=\"image\" onClick=\"BBCgrad()\" style=\"border-style: outset; border-width: 1\" alt=\"gradient\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/rtl.gif\" name=\"dirrtl\" type=\"image\" onClick=\"BBCdir('rtl')\" style=\"border-style: outset; border-width: 1\" alt=\"Right to Left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ltr.gif\" name=\"dirltr\" type=\"image\" onClick=\"BBCdir('ltr')\" style=\"border-style: outset; border-width: 1\" alt=\"Left to Right\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqd.gif\" name=\"marqd\" type=\"image\" onClick=\"BBCmarqd()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to down\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqu.gif\" name=\"marqu\" type=\"image\" onClick=\"BBCmarqu()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to up\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marql.gif\" name=\"marql\" type=\"image\" onClick=\"BBCmarql()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqr.gif\" name=\"marqr\" type=\"image\" onClick=\"BBCmarqr()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to right\"></span></span></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td dir=\"rtl\">";
		echo "<p align=\"right\" dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">";
		echo "<span style=\"font-size: 5pt\">&nbsp;</span><p align=\"left\" dir=\"ltr\" style=\"margin-top: 0; margin-bottom: 0\"><span class=\"gen\">";
		echo "<span class=\"genmed\">";
		echo "&nbsp;<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/code.gif\" name=\"code\" type=\"image\" onClick=\"BBCcode()\" style=\"border-style: outset; border-width: 1\" alt=\"Code\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/quote.gif\" name=\"quote\" type=\"image\" onClick=\"BBCquote()\" style=\"border-style: outset; border-width: 1\" alt=\"Quote\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/url.gif\" name=\"url\" type=\"image\" onClick=\"BBCurl()\" style=\"border-style: outset; border-width: 1\" alt=\"URL\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/email.gif\" name=\"email\" type=\"image\" onClick=\"BBCmail()\" style=\"border-style: outset; border-width: 1\" alt=\"Email\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/web.gif\" name=\"web\" type=\"image\" onClick=\"BBCweb()\" style=\"border-style: outset; border-width: 1\" alt=\"Wep Page\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/img.gif\" name=\"img\" type=\"image\" onClick=\"BBCimg()\" style=\"border-style: outset; border-width: 1\" alt=\"Image\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/flash.gif\" name=\"flash\" type=\"image\" onClick=\"BBCflash()\" style=\"border-style: outset; border-width: 1\" alt=\"Flash\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/video.gif\" name=\"video\" type=\"image\" onClick=\"BBCvideo()\" style=\"border-style: outset; border-width: 1\" alt=\"Video\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/sound.gif\" name=\"stream\" type=\"image\" onClick=\"BBCstream()\" style=\"border-style: outset; border-width: 1\" alt=\"Stream\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ram.gif\" name=\"ram\" type=\"image\" onClick=\"BBCram()\" style=\"border-style: outset; border-width: 1\" alt=\"Real Media\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/hr.gif\" name=\"hr\" type=\"image\" onClick=\"BBChr()\" style=\"border-style: outset; border-width: 1\" alt=\"H-Line\">&nbsp;&nbsp;";
		echo "<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/plain.gif\" name=\"plain\" type=\"image\" onClick=\"BBCplain()\" style=\"border-style: outset; border-width: 1\" alt=\"Remove BBcode\"></span></td>";
		echo "</tr></table></td></tr></table></td></tr><tr>";
	}

	function addtutorial(){
		global $admin_file, $module_name, $db, $prefix;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<form method=\"post\" name=\"post\" action=\"".$admin_file.".php\"><font class=\"content\"><strong><center>"._TUTADMINADDNEWTUTORIAL."</center></strong><br /><br />"._TUTADMINTUTORIALNAME.": <input type=\"text\" name=\"t_title\" size=\"50\" maxlength=\"100\"><br />";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by tc_title");
		echo ""._TUTADMINCATEGORY.": <select name=\"tc_id\">";
		while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($parentid2!=0) {
				$tc_title2=getparent($parentid2,$tc_title2);
			}
			echo "<option value=\"$tc_id2\">$tc_title2</option>";
		}
		echo "</select><br /><br />"._TUTADMINDESCRIPTION255."<br /><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br /><br />";
		tutorial_form();
		echo "<td colspan=\"9\"><span class=\"gen\"><textarea name=\"message\" rows=\"40\" cols=\"100%\" wrap=\"virtual\" class=\"post\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\"></textarea></span></td></tr></table></span></td></tr></table>";
		echo ""._TUTADMINAUTHORNAME.": <input type=\"text\" name=\"author\" size=\"30\" maxlength=\"60\"><br /><br />"._TUTADMINAUTHOREMAIL.": <input type=\"text\" name=\"author_email\" size=\"30\" maxlength=\"60\"><br /><br />"._TUTADMINAUTHORHOMEPAGE.": <input type=\"text\" name=\"author_homepage\" size=\"30\" maxlength=\"200\" value=\"http://\"><br /><br />"._TUTADMINVERSION.": <input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\"><br /><br />";
		echo ""._TUTADMINLEVEL.":<br />";
		$result3=$db->sql_query("select sid, title from ".$prefix."_tutorials_levels order by weight ASC");
		echo "<select name=\"level\">";
		while(list($level_id, $level_title) = $db->sql_fetchrow($result3)) {
			echo "<option value=\"$level_id\">$level_title</option>";
		}
		echo "</select><br /><br />";
		echo "<input type=\"hidden\" name=\"op\" value=\"savetutorial\"><center><input type=\"submit\" value=\""._TUTADMINADDTUTORIAL."\"><br /></form>";
		CloseTable();
		echo "</td>";
		bottom();
	}
	function modifytutorial(){
		global $admin_file, $module_name, $db, $prefix;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><form method=\"post\" action=\"".$admin_file.".php\">";
		echo "<font class=\"content\"><strong><center>"._TUTADMINMODTUTORIAL."</center></strong><br /><br /><br />";
		echo "<select name=\"t_id\">";
		$result2=$db->sql_query("select t_id, t_title from ".$prefix."_tutorials_tutorials order by t_title");
		while(list($t_id, $t_title) = $db->sql_fetchrow($result2)) {
			echo "<option value=\"$t_id\">$t_title</option>";
		}
		echo "</select><br /><br /><br />";
		echo "<input type=\"hidden\" name=\"op\" value=\"modtutorial\">";
		echo "<input type=\"submit\" value=\""._TUTADMINMODIFY."\">";
		echo "</form><br />";
		echo "<form method=\"post\" action=\"".$admin_file.".php\">";
		echo "<font class=\"content\"><strong><center>"._TUTADMINMODTUTORIAL2."</center></strong><br /><br /><br />";
		echo ""._TUTADMINTUTORIALID."#:<br /><br /><input type=\"text\" name=\"t_id\" size=\"12\" maxlength=\"11\">";
		echo "<input type=\"hidden\" name=\"op\" value=\"modtutorial\"><br /><br />";
		echo "<input type=\"submit\" value=\""._TUTADMINMODIFY."\">";
		echo "</form></center>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function transfertut($cidfrom,$cidto) {
		global $admin_file, $prefix, $db, $module_name;
		$cidfrom = intval($cidfrom);
		$cidto = intval($cidto);
		$db->sql_query("update ".$prefix."_tutorials_tutorials set tc_id=$cidto where tc_id='$cidfrom'");
		Header("Location: ".$admin_file.".php?op=transfercategory");
	}

	function modtutorialsave($t_id, $t_title, $tc_id, $description, $t_text, $author, $author_email, $author_homepage, $hits, $version, $level) {
		global $admin_file, $prefix, $db, $module_name;
		include_once("modules/$module_name/include/bbstuff.php");
		$t_id = intval($t_id);
		if ($t_title=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTITLE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($description=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNODESCRIPTION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($t_text=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTUTORIAL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHOR."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_email=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORMAIL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_homepage=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORSITE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($version=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOVERSION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		$tc_id = explode("-", $tc_id);
		if ($tc_id[1]=="") {
			$tc_id[1] = 0;
		}
		$t_title = stripslashes(FixQuotes($t_title));
		$author = stripslashes(FixQuotes($author));
		$author_email = stripslashes(FixQuotes($author_email));
		$author_homepage = stripslashes(FixQuotes($author_homepage));
		$description = stripslashes(FixQuotes($description));
		$t_text = stripslashes(FixQuotes($t_text));
		$level = intval($level);
		$bbcode_uid = make_bbcode_uid();
		$t_text = insert_bbcode_uid($t_text, $bbcode_uid);
		$db->sql_query("update ".$prefix."_tutorials_tutorials set tc_id='$tc_id[0]', t_title='$t_title', t_text='$t_text', t_counter='$hits', version='$version', description='$description', author='$author', author_email='$author_email', author_homepage='$author_homepage', bbcode_uid='$bbcode_uid', level='$level' where t_id='$t_id'");
		Header("Location: ".$admin_file.".php?op=modifytutorial");
	}

	function modtutorial($t_id) {
		global $admin_file, $prefix, $db, $anonymous, $bgcolor1, $bgcolor2, $module_name;
		$t_id = intval($t_id);
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><font class=\"content\"><strong>"._TUTADMINMODTUTORIAL."</strong></font></center><br /><br />";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_tutorials WHERE t_id='$t_id'");
		list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result);
		$t_title = stripslashes($t_title);
		$description = stripslashes($description);
		$t_text = stripslashes($t_text);
		echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"post\">";
		echo ""._TUTADMINTUTORIALID.": <strong>$t_id</strong><br />";
		echo "<br />";
		if ($submitter != "") {
			echo ""._TUTADMINSUBMITTER.": <strong>$submitter</strong><br />";
			echo "<br />";
		}
		echo ""._TUTADMINTUTORIALNAME.":<br />";
		echo "<input type=\"text\" name=\"t_title\" value=\"$t_title\" size=\"50\" maxlength=\"100\">";
		echo "<br /><br />";
		$result2=$db->sql_query("select tc_id, tc_title from ".$prefix."_tutorials_categories order by tc_title");
		echo "<input type=\"hidden\" name=\"t_id\" value=\"$t_id\">";
		echo ""._TUTADMINCATEGORY.":<br />";
		echo "<select name=\"tc_id\">";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by parentid,tc_title");
		while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($cid2==$tc_id) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			if ($parentid2!=0) {
				$ctitle2=getparent($parentid2,$ctitle2);
			}
			echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
		}
		echo "</select>";
		echo "<br /><br />";
		echo ""._TUTADMINDESCRIPTION255.":<br />";
		echo "<textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea>";
		echo "<br /><br />";
		$t_text = ($bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)".$bbcode_uid."(=|\])/si",'\\3',$t_text) : $t_text;
		$t_text = substr_replace ($t_text, '', 0, 1);
		tutorial_form();
		echo "<td colspan=\"9\"><span class=\"gen\"><textarea name=\"message\" rows=\"40\" cols=\"100%\" wrap=\"virtual\" class=\"post\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\">$t_text</textarea></span></td></tr></table></span></td></tr></table>";
		echo ""._TUTADMINAUTHORNAME.":<br />";
		echo "<input type=\"text\" name=\"author\" size=\"50\" maxlength=\"100\" value=\"$author\">";
		echo "<br /><br />";
		echo ""._TUTADMINAUTHOREMAIL.":<br />";
		echo "<input type=\"text\" name=\"author_email\" size=\"50\" maxlength=\"100\" value=\"$author_email\">";
		echo "<br /><br />";
		echo ""._TUTADMINAUTHORHOMEPAGE.":<br />";
		echo "<input type=\"text\" name=\"author_homepage\" size=\"50\" maxlength=\"200\" value=\"$author_homepage\" value=\"http://\">";
		if ($author_homepage != "") {
			echo "&nbsp;[ <a href=\"$author_homepage\" target=\"_blank\">"._TUTADMINVISIT."</a> ]";
		}
		echo "<br /><br />";
		echo ""._TUTADMINVERSION.":<br />";
		echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\">";
		echo "<br /><br />";
		echo ""._TUTADMINLEVEL.":<br />";
		echo "<select name=\"level\">";
		$result3=$db->sql_query("select sid, title from ".$prefix."_tutorials_levels order by weight ASC");
		while(list($level_id, $level_title) = $db->sql_fetchrow($result3)) {
			if ($level_id==$level) {
				$sel37 = "selected";
			} else {
				$sel37 = "";
			}
			echo "<option value=\"$level_id\" $sel37>$level_title</option>";
		}
		echo "</select><br /><br />";
		echo ""._TUTADMINHITS.":<br />";
		echo "<input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\">";
		echo "<br /><br /><br /><br /><center>";
		echo "<input type=\"hidden\" name=\"op\" value=\"modtutorialsave\">";
		echo "<input type=\"submit\" value=\""._TUTADMINSAVECHANGES."\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._TUTADMINDELETE."\" title=\""._TUTADMINDELETE."\" onClick=\"";
		echo "window.location = '".$admin_file.".php?op=deltutorial&amp;t_id=$t_id'\">";
		echo "</form><br />";
		CloseTable();
		echo "<br />";
		OpenTable();
		$result5=$db->sql_query("SELECT ratingdbid, ratinguser, ratingcomments, ratingtimestamp FROM ".$prefix."_tutorials_votedata WHERE ratinglid='$t_id' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
		$totalcomments = $db->sql_numrows($result5);
		echo "<table valign='top' width='100%'>";
		echo "<tr><td colspan='7' valign='top'><strong>"._TUTADMINCOMMENTS.$totalcomments.")</strong><br /><br /></td></tr>";
		echo "<tr><td width='20' colspan='1'><strong>"._TUTADMINUSER."  </strong></td><td colspan=5><strong>"._TUTADMINCOMMENT."  </strong></td><td><strong><center>"._TUTADMINDELETE."</center></strong></td></tr>";
		if ($totalcomments == 0) echo "<tr><td colspan='7'><center><font color=cccccc>"._TUTADMINNOCOMMENTS."<br /><br /></font></center></td></tr>";
		$x=0;
		$colorswitch="$bgcolor1";
		while(list($ratingdbid, $ratinguser, $ratingcomments, $ratingtimestamp)=$db->sql_fetchrow($result5)) {
			$ratingcomments = stripslashes($ratingcomments);
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]);
			$formatted_date = date("F j, Y", $timestamp);
			echo "<tr><td valign='top' bgcolor='$colorswitch'>$ratinguser</td><td valign='top' colspan='5' bgcolor='$colorswitch'>$ratingcomments</td><td bgcolor='$colorswitch'><center><strong><a href='".$admin_file.".php?op=delcomment&t_id=$t_id&rid=$ratingdbid'>X</a></strong></center><br /><br /></td></tr>";
			$x++;
			if ($colorswitch=="$bgcolor1") {
				$colorswitch="$bgcolor2";
			} else {
				$colorswitch="$bgcolor1";
			}
		}
		$result5=$db->sql_query("SELECT ratingdbid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ".$prefix."_tutorials_votedata WHERE ratinglid='$t_id' AND ratinguser != 'outside' AND ratinguser != 'Anonymous' ORDER BY ratingtimestamp DESC");
		$totalvotes = $db->sql_numrows($result5);
		echo "<tr><td colspan=7><strong>"._TUTADMINREGVOTES.$totalvotes.")</strong><br /><br /></td></tr>";
		echo "<tr><td><strong>"._TUTADMINUSER."  </strong></td><td><strong>"._TUTADMINIPADDRESS."  </strong></td><td><strong>"._TUTADMINRATING."  </strong></td><td><strong>"._TUTADMINUAVGRATING."  </strong></td><td><strong>"._TUTADMINTOTALRATINGS."  </strong></td><td><strong>"._TUTADMINDATE."  </strong></td></font></strong><td><strong><center>"._TUTADMINDELETE."</center></strong></td></tr>";
		if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>"._TUTADMINNOREGVOTES."<br /><br /></font></center></td></tr>";
		$x=0;
		$colorswitch="$bgcolor1";
		while(list($ratingdbid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp)=sql_fetch_row($result5, $dbi)) {
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]);
			$formatted_date = date("F j, Y", $timestamp);
			$result2=$db->sql_query("SELECT rating FROM ".$prefix."_tutorials_votedata WHERE ratinguser = '$ratinguser'");
			$usertotalcomments = $db->sql_numrows($result2);
			$useravgrating = 0;
			while(list($rating2)=$db->sql_fetchrow($result2)) {
				$useravgrating = $useravgrating + $rating2;
			}
			$useravgrating = $useravgrating / $usertotalcomments;
			$useravgrating = number_format($useravgrating, 1);
			echo "<tr><td bgcolor=$colorswitch>$ratinguser</td><td bgcolor=$colorswitch>$ratinghostname</td><td bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$useravgrating</td><td bgcolor=$colorswitch>$usertotalcomments</td><td bgcolor=$colorswitch>$formatted_date  </font></strong></td><td bgcolor=$colorswitch><center><strong><a href=\"".$admin_file.".php?op=delvote&t_id=$t_id&rid=$ratingdbid\">X</a></strong></center><br /><br /></td></tr>";
			$x++;
			if ($colorswitch=="$bgcolor1") {
				$colorswitch="$bgcolor2";
			} else {
				$colorswitch="$bgcolor1";
			}
		}
		$result5=$db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM ".$prefix."_tutorials_votedata WHERE ratinglid='$t_id' AND ratinguser = 'Anonymous' ORDER BY ratingtimestamp DESC");
		$totalvotes = $db->sql_numrows($result5);
		echo "<tr><td colspan=7><strong>"._TUTADMINUNREGVOTES.$totalvotes.")</strong><br /><br /></td></tr>";
		echo "<tr><td colspan=2><strong>"._TUTADMINIPADDRESS."  </strong></td><td colspan=3><strong>"._TUTADMINRATING."  </strong></td><td><strong>"._TUTADMINDATE."  </strong></font></td><td><strong><center>"._TUTADMINDELETE."</center></strong></td></tr>";
		if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>"._TUTADMINNOUNREGVOTES."</font></center></td></tr>";
		$x=0;
		$colorswitch="$bgcolor1";
		while(list($ratingdbid, $rating, $ratinghostname, $ratingtimestamp)=sql_fetch_row($result5, $dbi)) {
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
			$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
			$date_array = explode("-", $ratingtime);
			$timestamp = mktime(0, 0, 0, $date_array["1"], $date_array["2"], $date_array["0"]);
			$formatted_date = date("F j, Y", $timestamp);
			echo "<td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></strong></td><td bgcolor=$colorswitch><center><strong><a href=\"".$admin_file.".php?op=delvote&t_id=$t_id&rid=$ratingdbid\">X</a></strong></center></td></tr>";
			$x++;
			if ($colorswitch=="$bgcolor1") {
				$colorswitch="$bgcolor2";
			} else {
				$colorswitch="$bgcolor1";
			}
		}
		echo "<tr><td colspan=6>&nbsp;</td></tr>";
		echo "</table>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function delcomment($t_id, $rid) {
		global $admin_file, $prefix, $db, $module_name;
		$t_id = intval($t_id);
		$rid = intval($rid);
		$db->sql_query("UPDATE ".$prefix."_tutorials_votedata SET ratingcomments='' WHERE ratingdbid='$rid'");
		$db->sql_query("UPDATE ".$prefix."_tutorials_tutorials SET totalcomments = (totalcomments - 1) WHERE t_id='$t_id'");
		Header("Location: ".$admin_file.".php?op=modtutorial&t_id=$t_id");
	}

	function delvote($t_id, $rid) {
		global $admin_file, $prefix, $db, $module_name;
		$t_id = intval($t_id);
		$rid = intval($rid);
		$db->sql_query("delete from ".$prefix."_tutorials_votedata where ratingdbid='$rid'");
		$voteresult = $db->sql_query("select rating, ratinguser, ratingcomments FROM ".$prefix."_tutorials_votedata WHERE ratinglid='$t_id'");
		$totalvotesDB = $db->sql_numrows($voteresult);
		include_once("include/voteinclude.php");
		$db->sql_query("UPDATE ".$prefix."_tutorials_tutorials SET tutorialsratingsummary=$finalrating,totalvotes=$totalvotesDB,totalcomments=$truecomments WHERE t_id='$t_id'");
		Header("Location: ".$admin_file.".php?op=modtutorial&t_id=$t_id");
	}

	function cleanvotes($ok=0) {
		global $admin_file, $prefix, $db, $module_name;
		if ($ok!='') {
			$totalvoteresult = $db->sql_query("select distinct ratinglid FROM ".$prefix."_tutorials_votedata");
			while(list($lid)=$db->sql_fetchrow($totalvoteresult)) {
				$voteresult = sql_query("select rating, ratinguser, ratingcomments FROM ".$prefix."_tutorials_votedata WHERE ratinglid='$lid'", $dbi);
				$totalvotesDB = sql_num_rows($voteresult, $dbi);
				include_once("include/voteinclude.php");
				sql_query("UPDATE ".$prefix."_tutorials_tutorials SET tutorialsratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid='$lid'", $dbi);
			}
			Header("Location: ".$admin_file.".php?op=tutorials");
		}
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><br /><br />";
		echo "<strong>"._TUTADMINSURECLEANVOTE."</strong><br />";
		echo "<br /><br />";
		echo "<input type=\"button\" value=\""._TUTADMINBYES."\" title=\""._TUTADMINYES."\" ";
		echo "onClick=\"window.location='".$admin_file.".php?op=cleanvotes&ok=1'\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._TUTADMINBNO."\" title=\""._TUTADMINNO."\" onClick=\"window.location='javascript:history.go(-1)'\">";
		echo "</center><br /><br />";
		CloseTable();
		echo"</td>";
		bottom();
	}

	function deltutorial($t_id, $ok=0) {
		global $admin_file, $prefix, $db, $module_name;
		$t_id = intval($t_id);
		if ($ok!='') {
			$db->sql_query("delete from ".$prefix."_tutorials_tutorials where t_id='$t_id'");
			Header("Location: ".$admin_file.".php?op=tutorials");
		}
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><br /><br />";
		echo "<strong>"._TUTADMINSUREDELTUTORIAL."</strong><br />";
		echo "<br /><br />";
		echo "<input type=\"button\" value=\""._TUTADMINBYES."\" title=\""._TUTADMINYES."\" ";
		echo "onClick=\"window.location='".$admin_file.".php?op=deltutorial&t_id=".$t_id."&ok=1'\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._TUTADMINBNO."\" title=\""._TUTADMINNO."\" onClick=\"window.location='javascript:history.go(-1)'\">";
		echo "</center><br /><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function modcat($cat) {
		global $admin_file, $db, $prefix, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		$cat = explode("-", $cat);
		if ($cat[1]=="") {
			$cat[1] = 0;
		}
		OpenTable();
		echo "<center><font class=\"content\"><strong>"._TUTADMINMODCATEGORY."</strong></font></center><br /><br />";
		if ($cat[1]==0) {
			$result=$db->sql_query("select tc_title, tc_description from ".$prefix."_tutorials_categories where tc_id='$cat[0]'");
			list($title,$cdescription) = $db->sql_fetchrow($result);
			$cdescription = stripslashes($cdescription);
			echo "<form action=\"".$admin_file.".php\" method=\"post\">"._TUTADMINNAME.": <input type=\"text\" name=\"tc_title\" value=\"$title\" size=\"51\" maxlength=\"50\"><br />"._TUTADMINDESCRIPTION255."<br /><textarea name=\"tc_description\" cols=\"60\" rows=\"10\">$cdescription</textarea><br /><input type=\"hidden\" name=\"tc_id\" value=\"$cat[0]\"><input type=\"hidden\" name=\"op\" value=\"modcatsave\"><table border=\"0\"><tr><td><input type=\"submit\" value=\""._TUTADMINSAVECHANGES."\"></form></td><td><form action=\"".$admin_file.".php\" method=\"post\"><input type=\"hidden\" name=\"tc_id\" value=\"$cat[0]\"><input type=\"hidden\" name=\"op\" value=\"modcatdelete\"><input type=\"submit\" value=\""._TUTADMINDELETE."\"></form></td></tr></table>";
		}
		CloseTable();
		echo "</td>";
		bottom();
	}

	function modcatsave($tc_id, $tc_title, $tc_description) {
		global $admin_file, $prefix, $db, $module_name;
		$tc_id = intval($tc_id);
		$db->sql_query("update ".$prefix."_tutorials_categories set tc_title='$tc_title', tc_description='$tc_description' where tc_id='$tc_id'");
		Header("Location: ".$admin_file.".php?op=modcategory");
	}

	function modcatdelete($tc_id, $ok=0) {
		global $admin_file, $prefix, $db, $module_name;
		$tc_id = intval($tc_id);
		if($ok==1) {
			$db->sql_query("delete from ".$prefix."_tutorials_categories where tc_id='$tc_id'");
			$db->sql_query("delete from ".$prefix."_tutorials_tutorials where tc_id='$tc_id'");
			$result = $db->sql_query("select tc_id from ".$prefix."_tutorials_categories where parentid='$tc_id'");
			while(list($tc_id2) = $db->sql_fetchrow($result)) {
				$db->sql_query("delete from ".$prefix."_tutorials_categories where tc_id='$tc_id2'");
				$db->sql_query("delete from ".$prefix."_tutorials_tutorials where tc_id='$tc_id2'");
			}
			Header("Location: ".$admin_file.".php?op=modcategory");
		} else {
			$result = $db->sql_query("select * from ".$prefix."_tutorials_categories where parentid='$tc_id'");
			$nbsubcat = $db->sql_numrows($result);
			$result2 = $db->sql_query("select tc_id from ".$prefix."_tutorials_categories where tc_id='$tc_id'");
			while(list($tc_id2) = $db->sql_fetchrow($result2)) {
				$result3 = $db->sql_query("select * from ".$prefix."_tutorials_tutorials where tc_id='$tc_id2'");
				$nblink = $db->sql_numrows($result3);
			}
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"option\">";
			echo "<strong>"._TUTADMINTHEREIS." $nbsubcat "._TUTADMINSUBCAT." "._TUTADMINATTACHEDTOCAT."</strong><br />";
			echo "<strong>"._TUTADMINTHEREIS." $nblink "._TUTMAINTUTORIALS." "._TUTADMINATTACHEDTOCAT."</strong><br />";
			echo "<strong>"._TUTADMINDELTUTORIALCATWARNING."</strong><br /><br />";
		}
		echo "[ <a href=\"".$admin_file.".php?op=modcatdelete&tc_id=$tc_id&amp;ok=1\">"._TUTADMINYES."</a> | <a href=\"".$admin_file.".php?op=modcategory\">"._TUTADMINNO."</a> ]<br /><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function addcategory($tc_title, $description) {
		global $admin_file, $prefix, $db, $module_name;
		$result = $db->sql_query("select tc_id from ".$prefix."_tutorials_categories where tc_title='$tc_title'");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORTHECATEGORY." $tc_title "._TUTADMINALREADYEXIST."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		} else {
			$db->sql_query("insert into ".$prefix."_tutorials_categories values (NULL, '$tc_title', '$description', '$parentid')");
			Header("Location: ".$admin_file.".php?op=category");
		}
	}

	function addsubcategory($tc_id, $tc_title, $description) {
		global $admin_file, $prefix, $db, $module_name;
		$tc_id = intval($tc_id);
		$result = $db->sql_query("select tc_id from ".$prefix."_tutorials_categories where tc_title='$tc_title' AND parentid='$tc_id'");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center>";
			echo "<font class=\"content\"><strong>"._TUTADMINERRORTHESUBCATEGORY." $tc_title "._TUTADMINALREADYEXIST."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		} else {
			$db->sql_query("insert into ".$prefix."_tutorials_categories values (NULL, '$tc_title', '$description', '$tc_id')");
			Header("Location: ".$admin_file.".php?op=category");
		}
	}

	function savetutorial($t_title, $tc_id, $description, $t_text, $author, $author_email, $author_homepage, $version, $level) {
		global $admin_file, $prefix, $db, $module_name;
		$tc_id = intval($tc_id);
		include_once("modules/$module_name/include/bbstuff.php");
		if ($t_title=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTITLE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($description=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNODESCRIPTION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($t_text=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTUTORIAL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHOR."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_email=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORMAIL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_homepage=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORSITE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($version=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOVERSION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		$tc_id = explode("-", $tc_id);
		if ($tc_id[1]=="") {
			$tc_id[1] = 0;
		}
		$t_title = stripslashes(FixQuotes($t_title));
		$author = stripslashes(FixQuotes($author));
		$author_email = stripslashes(FixQuotes($author_email));
		$author_homepage = stripslashes(FixQuotes($author_homepage));
		$description = stripslashes(FixQuotes($description));
		$t_text = stripslashes(FixQuotes($t_text));
		$level = intval($level);
		$bbcode_uid = make_bbcode_uid();
		$t_text = insert_bbcode_uid($t_text, $bbcode_uid);
		$db->sql_query("insert into ".$prefix."_tutorials_tutorials values (NULL, '$tc_id[0]', '$t_title', '$t_text', now(), '$t_counter', '$version', '$description', '', '$author', '$author_email', '$author_homepage', '', '', '', '$bbcode_uid', '$level')");
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<br /><center>";
		echo "<font class=\"content\">";
		echo ""._TUTADMINNEWTUTORIALADDED."<br /><br />";
		echo "[ <a href=\"".$admin_file.".php?op=addtutorial\">"._TUTADMINTUTORIALSADMIN."</a> ]</center><br /><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function bottom() {
		echo "<td width=\"8\">&nbsp;</td><td valign=\"top\" width=\"140\">";
		block();
		echo "<br />";
		second_block();
		echo "</td></tr></table>";
		include_once("footer.php");
	}

	function bottom2() {
		echo "<td width=\"8\">&nbsp;</td><td valign=\"top\" width=\"140\">";
		block();
		echo "<br />";
		second_block();
		echo "</td></tr></table>";
	}

	function config(){
		global $admin_file, $module_name, $db, $prefix;
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_tutorials_config"));
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><font class=\"option\">"._TUTADMINCONFIG."</font></center>";
		echo "<br />";
		echo "<form action=\"".$admin_file.".php\" method=\"post\">";
		echo "<table width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSPERPAGE.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xperpage' value='$row[tutsperpage]' size='10' maxlength='2'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSPOPPAGE.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xmostpoptut' value='$row[mostpoptutorials]' size='10' maxlength='2'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSTOPPAGE.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xtoptut' value='$row[toptutorials]' size='10' maxlength='2'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSSEARCHPAGE.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xsearchtut' value='$row[searchtutorials]' size='10' maxlength='2'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSMAXFAVS.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xmaxfavs' value='$row[maxfavs]' size='10' maxlength='2'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSPOPHITS.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xpopularhits' value='$row[hitsforpopular]' size='10' maxlength='5'>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSMINVOTES.":</td>";
		echo "<td align=\"left\" width=\"40%\">";
		echo "<input type='text' name='xvotemin' value='$row[tutorialvotemin]' size='10' maxlength='3'>";
		echo "</td></tr>";
		if ($row[anonwaitdays] == "1") {
			$sel1 = "selected";
		} elseif ($row[anonwaitdays] == "2") {
			$sel2 = "selected";
		} elseif ($row[anonwaitdays] == "3") {
			$sel3 = "selected";
		} elseif ($row[anonwaitdays] == "4") {
			$sel4 = "selected";
		} elseif ($row[anonwaitdays] == "5") {
			$sel5 = "selected";
		} elseif ($row[anonwaitdays] == "6") {
			$sel6 = "selected";
		} elseif ($row[anonwaitdays] == "7") {
			$sel7 = "selected";
		} elseif ($row[anonwaitdays] == "14") {
			$sel8 = "selected";
		}
		echo "<tr><td align=\"right\">"._TUTADMINTUTSNUMDAYS.":</td>";
		echo "<td align=\"left\" width=\"40%\"><select name=\"xwaitdays\">";
		echo "<option value=\"1\" $sel1>1 "._TUTADMINTUTSDAY."</option>";
		echo "<option value=\"2\" $sel2>2 "._TUTADMINTUTSDAYS."</option>";
		echo "<option value=\"3\" $sel3>3 "._TUTADMINTUTSDAYS."</option>";
		echo "<option value=\"4\" $sel4>4 "._TUTADMINTUTSDAYS."</option>";
		echo "<option value=\"5\" $sel5>5 "._TUTADMINTUTSDAYS."</option>";
		echo "<option value=\"6\" $sel6>6 "._TUTADMINTUTSDAYS."</option>";
		echo "<option value=\"$row[anonwaitdays]\">-----------</option>";
		echo "<option value=\"7\" $sel7>1 "._TUTADMINTUTSWEEK."</option>";
		echo "<option value=\"14\" $sel8>2 "._TUTADMINTUTSWEEKS."</option>";
		echo "</select>";
		echo "</td></tr>";
		if ($row[anonweight] == "1") {
			$sel1 = "selected";
		} elseif ($row[anonweight] == "2") {
			$sel2 = "selected";
		} elseif ($row[anonweight] == "3") {
			$sel3 = "selected";
		} elseif ($row[anonweight] == "4") {
			$sel4 = "selected";
		} elseif ($row[anonweight] == "5") {
			$sel5 = "selected";
		} elseif ($row[anonweight] == "6") {
			$sel6 = "selected";
		} elseif ($row[anonweight] == "7") {
			$sel7 = "selected";
		} elseif ($row[anonweight] == "8") {
			$sel8 = "selected";
		} elseif ($row[anonweight] == "9") {
			$sel9 = "selected";
		} elseif ($row[anonweight] == "10") {
			$sel10 = "selected";
		} elseif ($row[anonweight] == "11") {
			$sel11 = "selected";
		} elseif ($row[anonweight] == "12") {
			$sel12 = "selected";
		} elseif ($row[anonweight] == "13") {
			$sel13 = "selected";
		} elseif ($row[anonweight] == "14") {
			$sel14 = "selected";
		} elseif ($row[anonweight] == "15") {
			$sel15 = "selected";
		} elseif ($row[anonweight] == "16") {
			$sel16 = "selected";
		} elseif ($row[anonweight] == "17") {
			$sel17 = "selected";
		} elseif ($row[anonweight] == "18") {
			$sel18 = "selected";
		} elseif ($row[anonweight] == "19") {
			$sel19 = "selected";
		} elseif ($row[anonweight] == "20") {
			$sel20 = "selected";
		}
		echo "<tr><td align=\"right\">"._TUTADMINTUTSVERSUSVOTE.":</td>";
		echo "<td align=\"left\" width=\"40%\"><select name=\"xweight\">";
		echo "<option value=\"1\" $sel1>1</option>";
		echo "<option value=\"2\" $sel2>2</option>";
		echo "<option value=\"3\" $sel3>3</option>";
		echo "<option value=\"4\" $sel4>4</option>";
		echo "<option value=\"5\" $sel5>5</option>";
		echo "<option value=\"6\" $sel6>6</option>";
		echo "<option value=\"7\" $sel7>7</option>";
		echo "<option value=\"8\" $sel8>8</option>";
		echo "<option value=\"9\" $sel9>9</option>";
		echo "<option value=\"10\" $sel10>10</option>";
		echo "<option value=\"11\" $sel11>11</option>";
		echo "<option value=\"12\" $sel12>12</option>";
		echo "<option value=\"13\" $sel13>13</option>";
		echo "<option value=\"14\" $sel14>14</option>";
		echo "<option value=\"15\" $sel15>15</option>";
		echo "<option value=\"16\" $sel16>16</option>";
		echo "<option value=\"17\" $sel17>17</option>";
		echo "<option value=\"18\" $sel18>18</option>";
		echo "<option value=\"19\" $sel19>19</option>";
		echo "<option value=\"20\" $sel20>20</option>";
		echo "</select>";
		echo "</td></tr>";
		if ($row[mainvotedecimal] == "1") {
			$sel1 = "selected";
		} elseif ($row[mainvotedecimal] == "2") {
			$sel2 = "selected";
		} elseif ($row[mainvotedecimal] == "3") {
			$sel3 = "selected";
		} elseif ($row[mainvotedecimal] == "4") {
			$sel4 = "selected";
		}
		echo "<tr><td align=\"right\">"._TUTADMINTUTSMAINDECIMAL.":</td>";
		echo "<td align=\"left\" width=\"40%\"><select name=\"xmaindecimal\">";
		echo "<option value=\"1\" $sel1>1</option>";
		echo "<option value=\"2\" $sel2>2</option>";
		echo "<option value=\"3\" $sel3>3</option>";
		echo "<option value=\"4\" $sel4>4</option>";
		echo "</select>";
		echo "</td></tr>";
		if ($row[detailvotedecimal] == "1") {
			$sel1 = "selected";
		} elseif ($row[detailvotedecimal] == "2") {
			$sel2 = "selected";
		} elseif ($row[detailvotedecimal] == "3") {
			$sel3 = "selected";
		} elseif ($row[detailvotedecimal] == "4") {
			$sel4 = "selected";
		} elseif ($row[detailvotedecimal] == "5") {
			$sel5 = "selected";
		} elseif ($row[detailvotedecimal] == "6") {
			$sel6 = "selected";
		}
		echo "<tr><td align=\"right\">"._TUTADMINTUTSDETAILDECIMAL.":</td>";
		echo "<td align=\"left\" width=\"40%\"><select name=\"xdetaildecimal\">";
		echo "<option value=\"1\" $sel1>1</option>";
		echo "<option value=\"2\" $sel2>2</option>";
		echo "<option value=\"3\" $sel3>3</option>";
		echo "<option value=\"4\" $sel4>4</option>";
		echo "<option value=\"5\" $sel5>5</option>";
		echo "<option value=\"6\" $sel6>6</option>";
		echo "</select>";
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSSHOWBLOCKS.":</td>";
		echo "<td align=\"left\" width=\"30%\">";
		if ($row[rightblocks] == 1) {
			echo "<input type='radio' name='xrightblocks' value='1' checked> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xrightblocks' value='0'> "._TUTADMINNO."";
		} else {
			echo "<input type='radio' name='xrightblocks' value='1'> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xrightblocks' value='0' checked> "._TUTADMINNO."";
		}
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSSHOWNUM.":</td>";
		echo "<td align=\"left\" width=\"30%\">";
		if ($row[show_links_num] == 1) {
			echo "<input type='radio' name='xshowlinks' value='1' checked> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xshowlinks' value='0'> "._TUTADMINNO."";
		} else {
			echo "<input type='radio' name='xshowlinks' value='1'> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xshowlinks' value='0' checked> "._TUTADMINNO."";
		}
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSALLOWSUB.":</td>";
		echo "<td align=\"left\" width=\"30%\">";
		if ($row[submit_on] == 1) {
			echo "<input type='radio' name='xsubmit' value='1' checked> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xsubmit' value='0'> "._TUTADMINNO."";
		} else {
			echo "<input type='radio' name='xsubmit' value='1'> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xsubmit' value='0' checked> "._TUTADMINNO."";
		}
		echo "</td></tr>";
		echo "<tr><td align=\"right\">"._TUTADMINTUTSAPPROVE.":</td>";
		echo "<td align=\"left\" width=\"30%\">";
		if ($row[approve_on] == 1) {
			echo "<input type='radio' name='xapprove' value='1' checked> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xapprove' value='0'> "._TUTADMINNO."";
		} else {
			echo "<input type='radio' name='xapprove' value='1'> "._TUTADMINYES." &nbsp;";
			echo "<input type='radio' name='xapprove' value='0' checked> "._TUTADMINNO."";
		}
		echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
		echo "</table>";
		echo "<input type='hidden' name='file' value='admin'><input type='hidden' name='op' value='configsave'>";
		echo "<center><input type='submit' name=\"submit\" value='"._TUTADMINTUTSSAVECHANGES."'></center>";
		echo "</form>";
		echo "</center>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function configsave($xperpage, $xmostpoptut, $xtoptut, $xsearchtut, $xmaxfavs, $xpopularhits, $xvotemin, $xwaitdays, $xweight, $xmaindecimal, $xdetaildecimal, $xrightblocks, $xshowlinks, $xsubmit, $xapprove){
		global $admin_file, $db, $prefix, $module_name;
		$db->sql_query("UPDATE ".$prefix."_tutorials_config SET tutsperpage='$xperpage', hitsforpopular='$xpopularhits', toptutorials='$xtoptut', anonweight='$xweight', detailvotedecimal='$xdetaildecimal', mainvotedecimal='$xmaindecimal', mostpoptutorials='$xmostpoptut', tutorialvotemin='$xvotemin', show_links_num='$xshowlinks', maxfavs='$xmaxfavs', rightblocks='$xrightblocks', searchtutorials='$xsearchtut', anonwaitdays='$xwaitdays', submit_on='$xsubmit', approve_on='$xapprove'");
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<META HTTP-EQUIV='refresh' content='2;URL=".$admin_file.".php?op=config'>\n";
		echo "<center>"._TUTADMINSUCUPDATED."</center>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function StatusAdmin() {
		global $admin_file, $bgcolor2, $bgcolor4, $prefix, $db, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><font class=\"option\"><strong>"._TUTADMINLEVELCONFIG."</strong></font></center><br /><br /><br /><table border=\"1\" width=\"100%\"><tr><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._TUTADMINLEVELTITLE."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\" colspan=\"2\"><strong>"._TUTADMINLEVELWEIGHT."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._TUTADMINLEVELFUNCTIONS."</strong></tr>";
		$result = $db->sql_query("select sid, title, weight from ".$prefix."_tutorials_levels order by weight");
		while(list($sid, $title, $weight) = $db->sql_fetchrow($result)) {
			$weight1 = $weight - 1;
			$weight3 = $weight + 1;
			$res = $db->sql_query("select sid from ".$prefix."_tutorials_levels where weight='$weight1'");
			list ($sid1) = $db->sql_fetchrow($res);
			$con1 = "$sid1";
			$res2 = $db->sql_query("select sid from ".$prefix."_tutorials_levels where weight='$weight3'");
			list ($sid2) = $db->sql_fetchrow($res2);
			$con2 = "$sid2";
			echo "<tr><td align=\"center\">$title</td><td align=\"center\">&nbsp;$weight&nbsp;</td><td align=\"center\">";
			if ($con1) {
				echo"<a href=\"".$admin_file.".php?op=StatusOrder&weight=$weight&sidorg=$sid&weightrep=$weight1&sidrep=$con1\"><img src=\"images/up.gif\" alt=\""._TUTADMINLEVELUP."\" title=\""._TUTADMINLEVELUP."\" border=\"0\" hspace=\"3\"></a>";
			}
			if ($con2) {
				echo "<a href=\"".$admin_file.".php?op=StatusOrder&weight=$weight&sidorg=$sid&weightrep=$weight3&sidrep=$con2\"><img src=\"images/down.gif\" alt=\""._TUTADMINLEVELDOWN."\" title=\""._TUTADMINLEVELDOWN."\" border=\"0\" hspace=\"3\"></a>";
			}
			echo"</td>";
			echo "<td align=\"center\"><font class=\"content\">[ <a href=\"".$admin_file.".php?op=StatusEdit&sid=$sid\">"._TUTADMINLEVELEDIT."</a> | ";
			echo "<a href=\"".$admin_file.".php?op=StatusDelete&sid=$sid\">"._TUTADMINLEVELDELETE."</a>";
			echo " ]</font></td></tr>";
		}
		echo "</table>";
		CloseTable();
		echo "<br />";
		OpenTable();
		echo "<center><font class=\"option\"><strong>"._TUTADMINLEVELADDNEWLEVEL."</strong></font></center><br /><br /><form action=\"".$admin_file.".php\" method=\"post\"><table border=\"0\" width=\"100%\"><tr><td>"._TUTADMINLEVELTITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\"></td></tr></table><input type=\"hidden\" name=\"op\" value=\"StatusAdd\"><input type=\"submit\" value=\""._TUTADMINLEVELCREATELEVEL."\"></form>";
		CloseTable();
		echo"</td>";
		bottom();
	}

	function StatusEdit($sid) {
		global $admin_file, $bgcolor2, $bgcolor4, $prefix, $db, $module_name;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		$sid = intval($sid);
		$result = $db->sql_query("select title from ".$prefix."_tutorials_levels where sid='$sid'");
		list($title) = $db->sql_fetchrow($result);
		OpenTable();
		echo "<center><font class=\"option\"><strong>"._TUTADMINEDITLEVEL."</strong></font></center><br /><br /><form action=\"".$admin_file.".php\" method=\"post\"><table border=\"0\" width=\"100%\"><tr><td>"._TUTADMINLEVELTITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\" value=\"$title\"></td></tr></table><input type=\"hidden\" name=\"sid\" value=\"$sid\"><input type=\"hidden\" name=\"op\" value=\"StatusEditSave\"><input type=\"submit\" value=\""._TUTADMINSAVELEVEL."\"></form>";
		CloseTable();
		echo"</td>";
		bottom();
	}

	function StatusEditSave($title, $sid) {
		global $admin_file, $prefix, $db, $module_name;
		$title = stripslashes(FixQuotes($title));
		$db->sql_query("update ".$prefix."_tutorials_levels Set title='$title' where sid='$sid'");
		Header("Location: ".$admin_file.".php?op=StatusAdmin");
	}

	function StatusOrder ($weightrep,$weight,$sidrep,$sidorg) {
		global $admin_file, $prefix, $db, $module_name;
		$sidrep = intval($sidrep);
		$sidorg = intval($sidorg);
		$result = $db->sql_query("update ".$prefix."_tutorials_levels set weight='$weight' where sid='$sidrep'");
		$result2 = $db->sql_query("update ".$prefix."_tutorials_levels set weight='$weightrep' where sid='$sidorg'");
		Header("Location: ".$admin_file.".php?op=StatusAdmin");
	}

	function StatusAdd($title) {
		global $admin_file, $prefix, $db, $module_name;
		$title = stripslashes(FixQuotes($title));
		$result = $db->sql_query("select sid from ".$prefix."_tutorials_levels where title='$title'");
		$numrows = $db->sql_numrows($result);
		if($numrows==0){
			$result = $db->sql_query("SELECT weight FROM ".$prefix."_tutorials_levels ORDER BY weight DESC");
			list ($weight) = $db->sql_fetchrow($result);
			$weight++;
			$db->sql_query("insert into ".$prefix."_tutorials_levels values ('', '$title', '$weight')");
		}
		Header("Location: ".$admin_file.".php?op=StatusAdmin");
	}

	function StatusDelete($sid, $ok=0) {
		global $admin_file, $prefix, $db, $module_name;
		$sid = intval($sid);
		if ($ok) {
			$result = $db->sql_query("select weight from ".$prefix."_tutorials_levels where sid='$sid'");
			list($weight) = $db->sql_fetchrow($result);
			$result = $db->sql_query("select sid from ".$prefix."_tutorials_levels where weight>'$weight'");
			while (list($nsid) = $db->sql_fetchrow($result)) {
				$nsid = intval($nsid);
				$db->sql_query("update ".$prefix."_tutorials_levels set weight='$weight' where sid='$nsid'");
				$weight++;
			}
			$db->sql_query("delete from ".$prefix."_tutorials_levels where sid='$sid'");
			Header("Location: ".$admin_file.".php?op=StatusAdmin");
		} else {
			$result = $db->sql_query("select title from ".$prefix."_tutorials_levels where sid='$sid'");
			list($title) = $db->sql_fetchrow($result);
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<center><font class=\"option\"><strong>"._TUTADMINDELLEVEL."</strong></font></center>";
			echo "<br /><center>"._TUTADMINARESUREDELLEVEL." <i>$title</i>?";
			echo "<br /><br />[ <a href=\"".$admin_file.".php?op=StatusAdmin\">"._TUTADMINNO."</a> | <a href=\"".$admin_file.".php?op=StatusDelete&sid=$sid&ok=1\">"._TUTADMINYES."</a> ]</center>";
			CloseTable();
			echo"</td>";
			bottom();
		}
	}

	function tutsubmissions() {
		global $admin_file, $db, $prefix, $module_name, $bgcolor1, $bgcolor2, $bgcolor3, $locale, $user_prefix;
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><font class=\"content\"><strong>"._TUTADMINWAITINGSUBMISSIONS."</strong></font></center><br /><br />";
		echo"<table width=\"100%\">";
		$result = $db->sql_query("select t_submitid, t_title, submitter, t_submitdate from ".$prefix."_tutorials_submit order by t_submitid ASC");
		$i = $db->sql_numrows($result);
		echo"<tr><td width=\"47%\" bgcolor=".$bgcolor3." style=\"border: 1;border-style: solid; border-size: 1px;\"><strong>"._TUTMAINTUTORIAL."</strong></td><td width=\"30%\" align=\"center\" bgcolor=".$bgcolor3." style=\"border: 1;border-style: solid; border-size: 1px;\"><strong>"._TUTMAINSUBBY."</strong></td><td width=\"18%\" bgcolor=".$bgcolor3." style=\"border: 1;border-style: solid; border-size: 1px;\"><strong>"._TUTADMINSUBON."</strong></td></tr>";
		while(list($t_submitid, $t_title, $submitter, $t_submitdate) = $db->sql_fetchrow($result)) {
			$row_color = ( !($i % 2) ) ? $bgcolor1 : $bgcolor2;
			setlocale (LC_TIME, $locale);
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $t_submitdate, $datetime);
			$datetime = strftime(""._TUTMAINLINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
			$datetime = ucfirst($datetime);
			$datetime = str_replace ("-", " ", $datetime);
			$uidresult = $db->sql_query("select user_id from ".$user_prefix."_users where username='$submitter'");
			$uidrow = $db->sql_fetchrow($uidresult);
			$uid = $uidrow['user_id'];
			echo"<tr><td bgcolor=".$row_color." width=\"47%\"><a href=\"".$admin_file.".php?op=subedit&subid=".$t_submitid."\">".$t_title."</a></td><td bgcolor=".$row_color." width=\"30%\" align=\"center\"><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$uid\">".$submitter."</a></td><td bgcolor=".$row_color." width=\"18%\">".$datetime."</td></tr>";
			$i++;
		}
		echo"</table>";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function subedit($subid) {
		global $admin_file, $prefix, $db, $anonymous, $bgcolor1, $bgcolor2, $module_name;
		$subid = intval($subid);
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><font class=\"content\"><strong>"._TUTADMINAPPROVETUTORIAL."</strong></font></center><br /><br />";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_submit WHERE t_submitid='$subid'");
		list($t_id, $tc_id, $t_title, $t_text, $t_date, $hits, $version, $description, $tutorialsratingsummary, $author, $author_email, $author_homepage, $submitter, $totalvotes, $totalcomments, $bbcode_uid, $level)=$db->sql_fetchrow($result);
		$t_title = stripslashes($t_title);
		$description = stripslashes($description);
		$t_text = stripslashes($t_text);
		echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"post\">";
		echo "<input type=\"hidden\" name=\"subid\" value=\"$subid\">";
		echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
		echo ""._TUTADMINSUBMITTER.": <strong>$submitter</strong><br />";
		echo "<br />";
		echo ""._TUTADMINTUTORIALNAME.":<br />";
		echo "<input type=\"text\" name=\"t_title\" value=\"$t_title\" size=\"50\" maxlength=\"100\">";
		echo "<br /><br />";
		$result2=$db->sql_query("select tc_id, tc_title from ".$prefix."_tutorials_categories order by tc_title");
		echo ""._TUTADMINCATEGORY.":<br />";
		echo "<select name=\"tc_id\">";
		$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by parentid,tc_title");
		while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
			if ($cid2==$tc_id) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			if ($parentid2!=0) {
				$ctitle2=getparent($parentid2,$ctitle2);
			}
			echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
		}
		echo "</select>";
		echo "<br /><br />";
		echo ""._TUTADMINDESCRIPTION255.":<br />";
		echo "<textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea>";
		echo "<br /><br />";
		$t_text = ($bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)".$bbcode_uid."(=|\])/si",'\\3',$t_text) : $t_text;
		$t_text = substr_replace ($t_text, '', 0, 1);
		tutorial_form();
		echo "<td colspan=\"9\"><span class=\"gen\"><textarea name=\"message\" rows=\"40\" cols=\"100%\" wrap=\"virtual\" class=\"post\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\">$t_text</textarea></span></td></tr></table></span></td></tr></table>";
		echo ""._TUTADMINAUTHORNAME.":<br />";
		echo "<input type=\"text\" name=\"author\" size=\"50\" maxlength=\"100\" value=\"$author\">";
		echo "<br /><br />";
		echo ""._TUTADMINAUTHOREMAIL.":<br />";
		echo "<input type=\"text\" name=\"author_email\" size=\"50\" maxlength=\"100\" value=\"$author_email\">";
		echo "<br /><br />";
		echo ""._TUTADMINAUTHORHOMEPAGE.":<br />";
		echo "<input type=\"text\" name=\"author_homepage\" size=\"50\" maxlength=\"200\" value=\"$author_homepage\" value=\"http://\">";
		if ($author_homepage != "") {
			echo "&nbsp;[ <a href=\"$author_homepage\" target=\"_blank\">"._TUTADMINVISIT."</a> ]";
		}
		echo "<br /><br />";
		echo ""._TUTADMINVERSION.":<br />";
		echo "<input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\" value=\"$version\">";
		echo "<br /><br />";
		echo ""._TUTADMINLEVEL.":<br />";
		echo "<select name=\"level\">";
		$result3=$db->sql_query("select sid, title from ".$prefix."_tutorials_levels order by weight ASC");
		while(list($level_id, $level_title) = $db->sql_fetchrow($result3)) {
			if ($level_id==$level) {
				$sel37 = "selected";
			} else {
				$sel37 = "";
			}
			echo "<option value=\"$level_id\" $sel37>$level_title</option>";
		}
		echo "</select>";
		echo "<br /><br /><br /><br /><center>";
		echo "<input type=\"hidden\" name=\"op\" value=\"subapprove\">";
		echo "<input type=\"submit\" value=\""._TUTADMINAPPROVE."\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._TUTADMINDENY."\" title=\""._TUTADMINDENY."\" onClick=\"";
		echo "window.location = '".$admin_file.".php?op=subdeny&amp;subid=$subid'\">";
		echo "</form><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function subdeny($subid, $ok=0) {
		global $admin_file, $prefix, $db, $module_name;
		$subid = intval($subid);
		if ($ok!='') {
			$db->sql_query("delete from ".$prefix."_tutorials_submit where t_submitid='$subid'");
			Header("Location: ".$admin_file.".php?op=tutsubmissions");
		}
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<center><br /><br />";
		echo "<strong>"._TUTADMINSUREDENY."</strong><br />";
		echo "<br /><br />";
		echo "<input type=\"button\" value=\""._TUTADMINBYES."\" title=\""._TUTADMINYES."\" ";
		echo "onClick=\"window.location='".$admin_file.".php?op=subdeny&subid=".$subid."&ok=1'\">&nbsp;&nbsp;";
		echo "<input type=\"button\" value=\""._TUTADMINBNO."\" title=\""._TUTADMINNO."\" onClick=\"window.location='javascript:history.go(-1)'\">";
		echo "</center><br /><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}

	function subapprove($subid, $submitter, $t_title, $tc_id, $description, $t_text, $author, $author_email, $author_homepage, $version, $level) {
		global $admin_file, $prefix, $db, $module_name;
		$tc_id = intval($tc_id);
		$subid = intval($subid);
		include_once("modules/$module_name/include/bbstuff.php");
		if ($t_title=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTITLE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($description=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNODESCRIPTION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($t_text=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOTUTORIAL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHOR."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_email=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORMAIL."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($author_homepage=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOAUTHORSITE."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		if ($version=="") {
			include_once("header.php");
			OpenTable();
			echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
			CloseTable();
			echo "<br />";
			echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
			OpenTable();
			echo "<br /><center><font class=\"content\"><strong>"._TUTADMINERRORNOVERSION."</strong><br /><br />"._GOBACK."<br /><br />";
			CloseTable();
			echo "</td>";
			bottom();
		}
		$tc_id = explode("-", $tc_id);
		if ($tc_id[1]=="") {
			$tc_id[1] = 0;
		}
		$t_title = stripslashes(FixQuotes($t_title));
		$author = stripslashes(FixQuotes($author));
		$submitter = stripslashes(FixQuotes($submitter));
		$author_email = stripslashes(FixQuotes($author_email));
		$author_homepage = stripslashes(FixQuotes($author_homepage));
		$description = stripslashes(FixQuotes($description));
		$t_text = stripslashes(FixQuotes($t_text));
		$level = intval($level);
		$bbcode_uid = make_bbcode_uid();
		$t_text = insert_bbcode_uid($t_text, $bbcode_uid);
		$db->sql_query("insert into ".$prefix."_tutorials_tutorials values (NULL, '$tc_id[0]', '$t_title', '$t_text', now(), '$t_counter', '$version', '$description', '', '$author', '$author_email', '$author_homepage', '$submitter', '', '', '$bbcode_uid', '$level')");
		$db->sql_query("delete from ".$prefix."_tutorials_submit where t_submitid='$subid'");
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._TUTADMIN."</strong></font><br /><a href=\"".$admin_file.".php\">"._TUTADMINBACK."</a></center>";
		CloseTable();
		echo "<br />";
		echo "<table width=\"100%\" valign=\"top\"><tr><td valign='top'>";
		OpenTable();
		echo "<br /><center>";
		echo "<font class=\"content\">";
		echo ""._TUTADMINTUTORIALAPPROVED."<br /><br />";
		echo "[ <a href=\"".$admin_file.".php?op=tutsubmissions\">"._TUTADMINTUTORIALSADMIN."</a> ]</center><br /><br />";
		CloseTable();
		echo "</td>";
		bottom();
	}
	function block() {
		global $admin_file, $db, $prefix, $module_name;
		$admintitle  = "Admin Links";
		$adminblock .= "<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=tutorials\">";
		$adminblock .= ""._TUTADMINMAIN."</a> ";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=config\">";
		$adminblock .= ""._TUTADMINCONFIG."</a> ";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=StatusAdmin\">";
		$adminblock .= ""._TUTADMINLEVELCONFIG."</a> ";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td><hr>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=category\">";
		$adminblock .= ""._TUTADMINCAT."</a> ";
		$adminblock .= "</td></tr>";
		$result = $db->sql_query("select * from ".$prefix."_tutorials_categories");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			$adminblock .= "<tr><td>";
			$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=modcategory\">";
			$adminblock .= ""._TUTADMINMODCAT."</a> ";
			$adminblock .= "</td></tr>";
			$adminblock .= "<tr><td><hr>";
			$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=addtutorial\">";
			$adminblock .= ""._TUTADMINADDTUT."</a> ";
			$adminblock .= "</td></tr>";
			$adminblock .= "<tr><td>";
			$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=transfercategory\">";
			$adminblock .= ""._TUTADMINTRANSFERCAT."</a> ";
			$adminblock .= "</td></tr>";
			$adminblock .= "<tr><td>";
			$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=modifytutorial\">";
			$adminblock .= ""._TUTADMINMODTUT."</a> ";
			$adminblock .= "</td></tr>";
			$adminblock .= "<tr><td><hr>";
			$result = $db->sql_query("select * from ".$prefix."_tutorials_submit");
			$num = $db->sql_numrows($result);
			$adminblock .= "<strong>&#8226;</strong> <a href=\"".$admin_file.".php?op=tutsubmissions\">";
			$adminblock .= ""._TUTADMINWAITINGSUBMISSIONS."</a> - <strong>".$num;
			$adminblock .= "</strong></td></tr>";
		}
		$adminblock .= "</table>";
		themesidebox($admintitle, $adminblock);
	}

	function second_block() {
		global $admin_file, $module_name;
		$admintitle  = "Module Links";
		$adminblock .= "<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"modules.php?name=$module_name\">";
		$adminblock .= ""._TUTMAIN."</a>";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"modules.php?name=$module_name&t_op=NewTutorials\">";
		$adminblock .= ""._TUTMAINNEW."</a>";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"modules.php?name=$module_name&t_op=PopularTutorials\">";
		$adminblock .= ""._TUTMAINPOPULAR."</a>";
		$adminblock .= "</td></tr>";
		$adminblock .= "<tr><td>";
		$adminblock .= "<strong>&#8226;</strong> <a href=\"modules.php?name=$module_name&t_op=TopTutorials\">";
		$adminblock .= ""._TUTMAINTOPRATED."</a>";
		$adminblock .= "</td></tr>";
		$adminblock .= "</table>";
		themesidebox($admintitle, $adminblock);
	}
	switch($op) {
		default:
		main();
		break;

		case "category":
		category();
		break;

		case "addcategory":
		addcategory($tc_title, $description);
		break;

		case "addsubcategory":
		addsubcategory($tt_id, $tt_title, $tt_description);
		break;

		case "modcategory":
		modcategory();
		break;

		case "modcat":
		modcat($cat);
		break;

		case "modcatsave":
		modcatsave($tc_id, $tc_title, $tc_description);
		break;

		case "modcatdelete":
		modcatdelete($tc_id, $ok);
		break;

		case "transfercategory":
		transfercategory();
		break;

		case "transfertut":
		transfertut($cidfrom, $cidto);
		break;

		case "addtutorial":
		addtutorial();
		break;

		case "modifytutorial":
		modifytutorial();
		break;

		case "modtutorial":
		modtutorial($t_id);
		break;

		case "deltutorial":
		deltutorial($t_id, $ok);
		break;

		case "modtutorialsave":
		modtutorialsave($t_id, $t_title, $tc_id, $description, $message, $author, $author_email, $author_homepage, $hits, $version, $level);
		break;

		case "delcomment":
		delcomment($t_id, $rid);
		break;

		case "delvote":
		delvote($t_id, $rid);
		break;

		case "cleanvotes":
		cleanvotes($ok);
		break;

		case "config":
		config();
		break;

		case "savetutorial":
		savetutorial($t_title, $tc_id, $description, $message, $author, $author_email, $author_homepage, $version, $level);
		break;

		case "configsave":
		configsave($xperpage, $xmostpoptut, $xtoptut, $xsearchtut, $xmaxfavs, $xpopularhits, $xvotemin, $xwaitdays, $xweight, $xmaindecimal, $xdetaildecimal, $xrightblocks, $xshowlinks, $xsubmit, $xapprove);
		break;

		case "StatusAdmin":
		StatusAdmin();
		break;

		case "StatusOrder":
		StatusOrder ($weightrep,$weight,$sidrep,$sidorg);
		break;

		case "fixweight":
		fixweight();
		break;

		case "StatusAdd":
		StatusAdd($title);
		break;

		case "StatusEdit":
		StatusEdit($sid);
		break;

		case "StatusEditSave":
		StatusEditSave($title, $sid);
		break;

		case "StatusDelete":
		StatusDelete($sid, $ok);
		break;

		case "tutsubmissions":
		tutsubmissions();
		break;

		case "subedit":
		subedit($subid);
		break;

		case "subdeny":
		subdeny($subid, $ok);
		break;

		case "subapprove":
		subapprove($subid, $submitter, $t_title, $tc_id, $description, $message, $author, $author_email, $author_homepage, $version, $level);
		break;
	}
} else {
	include_once("header.php");
	OpenTable();
	echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"</center>";
	CloseTable();
	include_once("footer.php");
}

?>
