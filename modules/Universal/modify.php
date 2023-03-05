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
$index = getconfigvar("rightblocks"); 

$modtitle = getconfigvar("modtitle");
$pagetitle = "- $modtitle";
@require_once("mainfile.php");
$modulename = basename( dirname( __FILE__ ) );
get_lang($modulename);
@require_once("modules/$modulename/includes/error_checking.php");
@require_once("modules/$name/includes/headers.php");
@include_once("modules/$modulename/includes/user.php");

function modify_main($id) {
	global $prefix, $db, $mainprefix, $modulename, $user, $cookie;
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/wysiwyg.php");
	if (getconfigvar("onlyregusers") == 1) {
		if (is_user($user)) {
			// Do nothing - registered users are allowed to submit mod requests
		} else {
				$mainindex=1;
		mainheader($mainindex);
			$redirect = "modules.php?name=$modulename&file=add&op=request";
			$op2 = "&op=request";
			$file = "modify";
			user_login($redirect, $stop, $modulename, $op2, $file);
			@include_once("modules/$modulename/includes/credit-line.php");
			@include_once("footer.php");
			die();
		} 
	}
		// Check to see if user submitting modify request, is the same user who posted the item
		// Only works if Only Registered Users can post is set
		if (getconfigvar("limitmodrequests") == 1 AND getconfigvar("onlyregusers") == 1) {
		cookiedecode($user);
		$itemsubmitter = $db->sql_fetchrow($db->sql_query("SELECT submitter from ".$prefix."_".$mainprefix."_items where id = '$id'"));	
		if ($cookie[1] == $itemsubmitter[submitter]) {
			// Do nothing - User is the submitter
		} else {
				$mainindex=1;
		mainheader($mainindex);
			OpenTable();
			echo ""._MFONLYUSER."<br />";
			echo "<a href=\"modules.php?name=$modulename\">"._MFCLICKHERE."</a> "._MFONLYUSER2.".";
			CloseTable();
			@include_once("modules/$modulename/includes/credit-line.php");
			@include_once("footer.php");
			die();
		}
		}
		// End check
			$mainindex=1;
		mainheader($mainindex);
	$check = $db->sql_numrows($db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_modify where id = '$id' limit 0,1"));
	if ($check) {
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SUBMITMODREQUEST.":</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">&nbsp;</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SMERRORMESS."\n";
			echo "    <br />\n";
	$itemname = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_".$mainprefix."_items where id = '$id'"));
	$itemname2 = stripslashes($itemname[title]);
			echo "    "._SMFORITEM.": $itemname2<br />\n";
			echo "    "._SMPENDINGMESS."\n";
			echo "    </td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">&nbsp;</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SMTRYAGAIN."</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SMRETURNTO." ".getconfigvar("modtitle")." "._SMINDEX."</td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
	} else {
	$row = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_".$mainprefix."_items where id = '$id'"));
	$title = stripslashes($row[title]);
	$description = stripslashes($row[description]);
	$submitter = stripslashes($row[submitter]);
	if (isset($row[author])) $author = stripslashes($author);
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
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=modify\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
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
			echo "      <input type=\"text\" name=\"itemauthor\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('author')\" value=\"$author\"> ("._NEWITEMAUTHOR.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWWEBSITE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemwebsite\" size=\"27\" onMouseOver=\"helpline('website')\" maxlength=\"200\" value=\"$row[website]\"> ("._NEWWEBMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWTITLE.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"itemtitle\" size=\"27\" maxlength=\"120\" onMouseOver=\"helpline('title')\" value=\"$title\"> ("._NEWTITLEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOURNAME.":</td>\n";
			echo "      <td width=\"80%\">\n";
			echo "      <input type=\"text\" name=\"submitter\" size=\"27\" maxlength=\"100\" onMouseOver=\"helpline('username1')\" value=\"$submitter\"> ("._NEWNAMEMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWYOUREMAIL.".</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"email\" size=\"27\" value=\"$row[youremail]\" onMouseOver=\"helpline('femail2')\" maxlength=\"120\"> ("._NEWYOUREMESS.").\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\">"._NEWDESCRIP.":</td>\n";
			echo "      <td width=\"80%\"><input type=\"text\" name=\"descrip\" size=\"27\" value=\"$description\" onMouseOver=\"helpline('descript')\" maxlength=\"120\"> ("._NEWDESCRIPMESS.".)\n";
			echo "      </td>\n";
			echo "    </tr>\n";
			echo "    <tr>\n";
			echo "      <td width=\"20%\" valign=\"top\" rowspan=\"2\">"._NEWCONTENT.":<br />\n";
			echo "      ("._NEWHTML.").\n";
			echo "<br /><br /><center><center><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
			echo "</td>";
			$content2 = stripslashes($row[content]);
			$content2 = ($row[bbcode_uid] != '') ? preg_replace("/:(([a-z0-9]+:)?)".$row[bbcode_uid]."(=|\])/si",'\\3',$row[content]) : $row[content];
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
  			echo "      <select size=\"1\" name=\"op\"><option value=\"previewform\">"._NEWPREVIEW."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
			echo "		<input type=\"hidden\" name=\"id\" value=\"$id\">\n";
			echo "		<input type=\"hidden\" name=\"bbcode_uid\" value=\"$row[bbcode_uid]\">\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">\n";	
		}				
			echo "</form>\n";
		CloseTable();	
	}
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function previewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid, $itemlang) {
	global $prefix, $db, $modulename, $mainprefix;
	//checktitle($itemtitle);
	//checkbad($content);
	errors();
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	@require_once("modules/$modulename/includes/bbstuff.php");
	@require_once("modules/$modulename/includes/wysiwyg.php");
	$mainindex = 1;
		mainheader($mainindex);
    	$content2 = insert_bbcode_uid($content, $bbcode_uid);
 		$formattedcontent = parse_bbcode($content2,$bbcode_uid);
		$formattedcontent = stripslashes($formattedcontent);
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
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=modify\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">";
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
			echo "<br /><br /><center><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";		
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
  			echo "		<option value=\"previewform\">"._NEWPREVIEW."</option>\n";
			echo "      <option value=\"ItemPost2\">"._NEWPOST."</option>\n";
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
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function ItemPost2($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid) {
	global $prefix, $db, $mainprefix, $modulename;
	@require_once("modules/$modulename/includes/bbstuff.php");
	$content2= addslashes($content);
	$descrip2= addslashes($descrip);
	$submitter2= addslashes($submitter);
	$itemtitle2= addslashes($itemtitle);
	$itemauthor2= addslashes($itemauthor);
	$content2 = insert_bbcode_uid($content2, $bbcode_uid);
	$db->sql_query("INSERT into ".$prefix."_".$mainprefix."_modify VALUES ('$id', '$newcategory', '$itemauthor2', '$itemwebsite', '$itemtitle2', '$descrip2', '$content2', '$submitter2', '$email')");
	//echo "$newcategory<br />$itemauthor<br />$itemwebsite<br />$itemtitle<br />$submitter<br />$email<br />$descrip<br /><br />$content2<br /><br />";
	@include_once("header.php");
	@include_once("modules/$modulename/includes/js.php");
	$mainindex=1;
		mainheader($mainindex);
		OpenTable();
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">"._SMYOURREQUEST."<br />\n";
			echo "    "._SMWILLCHECK."</td>\n";
			echo "  </tr>\n";
			echo "  <tr>\n";
			echo "    <td width=\"100%\">\n";
			echo "    <p align=\"center\">[ <a href=\"modules.php?name=$modulename\">"._SMRETURNINDEX."</a> \n";
			echo "    ]</td>\n";
			echo "  </tr>\n";
			echo "</table>\n";
		CloseTable();
	@include_once("modules/$modulename/includes/credit-line.php");
	@include_once("footer.php");
}

function getparent($parentid,$title) {
    global $prefix, $db, $mainprefix;
    $result = $db->sql_query("select id, title, parentid from ".$prefix."_".$mainprefix."_categories where id=$parentid");
    list($cid, $ptitle, $pparentid) = $db->sql_fetchrow($result, $dbi);
    if ($ptitle!="") $title=$ptitle."/".$title;
    if ($pparentid!=0) {
	$title=getparent($pparentid,$title);
    }
    return $title;
}

switch ($op) {
	
	case "modify_main":
	modify_main($id);
	break;
	
	case "previewform":
	previewform($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid);
	break;
	
	case "ItemPost2":
	ItemPost2($id, $newcategory, $itemauthor, $itemwebsite, $itemtitle, $submitter, $email, $descrip, $content, $bbcode_uid);
	break;
	
	default:
	modify_main($id);
	break;
	
}

?>