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
LinkAdmin();
VideoStreamMenu();

if($_POST['editcat2']) {
	$result = $db->sql_query("UPDATE ".$prefix."_video_stream_categories SET name='".$_POST['catname']."', imgurl='".$_POST['catimage']."', permission='".$_POST['permission']."', adult='".$_POST['adult']."' WHERE id='".$_GET['id']."'");
	//if($_POST['permission']) {
		//$result = $db->sql_query("UPDATE ".$prefix."_video_stream_categories SET imgurl='".$_POST['catimage']."', permission='".$_POST['permission']."', adult='".$_POST['adult']."' WHERE id='".$_GET['id']."'");
	//}
}

if($_POST['addmaincat']) {
	$result = $db->sql_query("INSERT INTO ".$prefix."_video_stream_categories (name, imgurl, parent, permission, adult) VALUES('".$_POST['catname']."', '".$_POST['catimage']."', 0, '".$_POST['permission']."', '".$_POST['adult']."') ");
}

if($_POST['addsubcat']) {
	$result = $db->sql_query("INSERT INTO ".$prefix."_video_stream_categories (name, parent) VALUES('".$_POST['catname']."', '".$_POST['parent']."') ");
}

// Delete Category
if($_POST['deletecat']) {
	OpenTable();
	echo "<div align=\"center\" class=\"title\">"._DELCAT."</div><br /><br />";
	echo ""._COMFIRMCATDELETE." [ <a href=\"".$admin_file.".php?op=video_stream&amp;Submit=category&amp;delcat=".$_POST['parent']."&amp;comfirm=yes\">"._YES."</a> | <a href=\"".$admin_file.".php?op=video_stream&amp;Submit=category\">"._NO."</a> ]";
	CloseTable();
	echo "<br />";
}

if($delcat && $comfirm == "yes") {
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE parent='$delcat'");
	if($row = $db->sql_numrows($result) != 0) {
		OpenTable();
		echo "<div align=\"center\" class=\"title\">"._ERROR."</div><br /><br />";
		echo ""._DELCATNOTPARENT."";
		CloseTable();
		echo "<br />";
	} else {
		$result = $db->sql_query("DELETE FROM ".$prefix."_video_stream_categories WHERE id=$delcat");
		$result = $db->sql_query("UPDATE ".$prefix."_video_stream SET category=0 WHERE category=$delcat");
	}
}
// ************************

// Add Main Category
OpenTable();
echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"".$admin_file.".php?op=video_stream&Submit=category\">\n";
echo "  <strong>"._ADDMAINCAT.":</strong><br />\n";
echo "  "._CATNAME.": <input type=\"text\" name=\"catname\" /><br />\n";
echo "  "._CATIMAGE.": <input type=\"text\" name=\"catimage\" /><br />\n";
echo "  "._CATCANBEVIEWEDBY.": \n";
echo "  <select name=\"permission\">\n";
echo "    <option value=\"0\" selected>"._EVERYONE."</option>\n";
echo "    <option value=\"1\">"._REGMEMBERSONLY."</option>\n";
echo "  </select><br />\n";
echo "  "._REQUIREUSERTOACCEPT.": \n";
echo "  "._YES." <input name=\"adult\" type=\"radio\" value=\"1\" /> "._NO." <input name=\"adult\" type=\"radio\" value=\"0\" checked=\"checked\" /><br />\n";
echo "  <input type=\"submit\" name=\"addmaincat\" value=\""._ADDCAT."\" />\n";
echo "</form>\n";
CloseTable();

// Add Sub Category
echo "<br />";
OpenTable();
echo "<form id=\"form2\" name=\"form2\" method=\"post\" action=\"".$admin_file.".php?op=video_stream&Submit=category\">\n";
echo "  <p><strong>"._ADDSUBCAT.":</strong><br />\n";
echo "  <input type=\"text\" name=\"catname\" />\n";
echo "  "._VS_IN."<select name=\"parent\">\n";
$result9 = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories");
while($row9 = $db->sql_fetchrow($result9)) {
	$cid2 = intval($row9['id']);
	$ctitle2 = $row9['name'];
	$parentid2 = intval($row9['parent']);
	if ($parentid2!=0) {
		$ctitle2 = getparent($parentid2,$ctitle2);
	}
	echo "    <option value=\"$cid2\">$ctitle2</option>\n";
}	
echo "  </select></p>\n";
echo "  <input type=\"submit\" name=\"addsubcat\" value=\""._ADDCAT."\" />\n";
echo "</form>\n";
CloseTable(); 

// Delete Category
echo "<br />";
OpenTable();
echo "<form id=\"form3\" name=\"form3\" method=\"post\" action=\"".$admin_file.".php?op=video_stream&Submit=category\">\n";
echo "  <strong>"._DELCAT.":</strong><br />\n";
echo "  <select name=\"parent\">\n";
$result9 = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories");
	while($row9 = $db->sql_fetchrow($result9)) {
	$cid2 = intval($row9['id']);
	$ctitle2 = $row9['name'];
	$parentid2 = intval($row9['parent']);
	if ($parentid2!=0) {
		$ctitle2 = getparent($parentid2,$ctitle2);
	}
	echo "    <option value=\"$cid2\">$ctitle2</option>\n";
}	
echo "  </select><br /><br />\n";
echo "  <input type=\"submit\" name=\"deletecat\" value=\""._DELCAT."\" />\n";
echo "</form>";
CloseTable();

// Edit Category



echo "<br />";
OpenTable();
if ($_POST['editcat']) {
	$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories WHERE id='".$_POST['parent']."'");
	$row = $db->sql_fetchrow($result);
	echo "<form id=\"form4\" name=\"form4\" method=\"post\" action=\"".$admin_file.".php?op=video_stream&Submit=category&id=".$_POST['parent']."\">\n";
	echo "  <strong>"._EDITCAT.":</strong><br />\n";
	echo "  "._CATNAME.": <input type=\"text\" name=\"catname\" value=\"".$row['name']."\" /><br />\n";
	if ($row['parent'] == 0) {
		echo "  "._CATIMAGE.": <input type=\"text\" name=\"catimage\" value=\"".$row['imgurl']."\" /><br />\n";
		echo "  "._CATCANBEVIEWEDBY.": \n";
		echo "  <select name=\"permission\">\n";
		$selected[$row['permission']] = "selected";
		echo "    <option value=\"0\" ".$selected[0].">"._EVERYONE."</option>\n";
		echo "    <option value=\"1\" ".$selected[1].">"._REGMEMBERSONLY."</option>\n";
		echo "  </select><br />\n";
		$checked[$row['adult']] = "checked=\"checked\"";
		echo "  "._REQUIREUSERTOACCEPT.": \n";
		echo "  "._YES." <input name=\"adult\" type=\"radio\" value=\"1\" ".$checked[1]." /> "._NO." <input name=\"adult\" type=\"radio\" value=\"0\" ".$checked[0]." /><br />\n";
	}
	echo "  <input type=\"submit\" name=\"editcat2\" value=\""._EDITCAT."\" />\n";
	echo "</form>\n";
} else {
	echo "<form id=\"form4\" name=\"form4\" method=\"post\" action=\"".$admin_file.".php?op=video_stream&Submit=category\">\n";
	echo "  <strong>"._EDITCAT.":</strong><br />\n";
	echo "  <select name=\"parent\">\n";
	$result9 = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_categories");
		while($row9 = $db->sql_fetchrow($result9)) {
		$cid2 = intval($row9['id']);
		$ctitle2 = $row9['name'];
		$parentid2 = intval($row9['parent']);
		if ($parentid2!=0) {
			$ctitle2 = getparent($parentid2,$ctitle2);
		}
		echo "    <option value=\"$cid2\">$ctitle2</option>\n";
	}	
	echo "  </select><br /><br />\n";
	echo "  <input type=\"submit\" name=\"editcat\" value=\""._EDITCAT."\" />\n";
	echo "</form>";
}
CloseTable();
?>