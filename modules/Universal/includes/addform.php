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

if (stristr($_SERVER['SCRIPT_NAME'], "addform.php")) {
	die("Illegal Desolate File Access");
}

global $prefix, $db, $user, $cookie, $admin, $modulename, $mainprefix, $currentlang;

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
			echo "<form method=\"POST\" action=\"modules.php?name=$modulename&file=add\" enctype=\"multipart/form-data\" name=\"postnew\" onsubmit=\"return checkData()\">\n";
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
	$result = $db->sql_query("select id, title from ".$prefix."_".$mainprefix."_categories order by title");
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
			echo "<br /><br /><center><input type=\"button\" onClick=\"javascript:pagebreak()\" onMouseOver=\"helpline('pagebreak')\" value=\""._INSERTPB."\"></center>\n";			
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
  			echo "      <select size=\"1\" name=\"op\"><option value=\"previewform\">"._NEWPREVIEW."</option>\n";
			echo "      </select> <input type=\"submit\" value=\""._NEWGO."!\"></td>\n";
			echo "    </tr>\n";
			echo "  </table>\n";
		if (getconfigvar("multilinguel") == 0) {	
			echo "		<input type=\"hidden\" name=\"itemlang\" value=\"english\">\n";	
		}				
			echo "</form>\n";
		CloseTable();

?>