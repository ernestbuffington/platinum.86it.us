<?php



/************************************************************************/

/* PHP-NUKE: Web Portal System                                          */

/* ===========================                                          */

/*                                                                      */

/* Copyright (c) 2006 by Francisco Burzi                                */

/* http://phpnuke.org                                                   */

/*                                                                      */

/* SimpleCart V0.81 for PHP-Nuke                                        */

/* Copyright (c) 2006 by Kevin Atwood                                   */

/* http://dadanuke.org                                                  */

/*                                                                      */

/* This program is free software. You can redistribute it and/or modify */

/* it under the terms of the GNU General Public License as published by */

/* the Free Software Foundation; either version 2 of the License.       */

/************************************************************************/



if (!defined('ADMIN_FILE')) {

	die ("Access Denied");

}



global $prefix, $db, $admin_file;

$aid = substr($aid, 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));

if ($row['radminsuper'] == 1) {



	function scmenu() {

		global $module_name, $admin_file;

		echo "<br />";

		OpenTable();

		echo "<center><strong>"._SCADMINMENU."</strong><br /><br />[ <a href=\"".$admin_file.".php?op=scmain\">"._SCADMINMENUGEN."</a> | <a href=\"".$admin_file.".php?op=scc1\">"._SCADMINMENUC1."</a> | <a href=\"".$admin_file.".php?op=scc2\">"._SCADMINMENUC2."</a> | <a href=\"".$admin_file.".php?op=scc3\">"._SCADMINMENUC3."</a> | <a href=\"".$admin_file.".php?op=scc4\">"._SCADMINMENUC4."</a> ]  <br />[ <a href=\"".$admin_file.".php?op=scmainpage\">"._SCADMINMENUMAIN."</a> | <a href=\"".$admin_file.".php?op=screferrals\">"._SCADMINMENUREFERRALS."</a> | <a href=\"".$admin_file.".php?op=scpolicies\">"._SCADMINMENUPOLICIES."</a> | <a href=\"".$admin_file.".php?op=scconditions\">"._SCADMINMENUTERMS."</a> ]</center>";

		CloseTable();

   }



	function scmain($save=0, $scmail=0, $scsubject=0, $sccontact=0, $sccontactsubject=0, $scname=0) { 

		global $prefix, $db, $bgcolor2, $sitename, $admin_file; 

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart_config SET scmail='$scmail', scsubject='$scsubject', sccontact='$sccontact', sccontactsubject='$sccontactsubject', scname='$scname'"); 

			Header("Location: ".$admin_file.".php?op=scmain"); 

			die(); 

		}    

		include_once("header.php"); 

		title("$sitename "._SCGENTITLE.""); 

		OpenTable(); 

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart_config")); 

		$result = $db->sql_query("SELECT scsubject, sccontactsubject, scname from ".$prefix."_simplecart_config"); 

		list($scsubject, $sccontactsubject, $scname) = $db->sql_fetchrow($result); 

		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"90%\" align=\"center\">" 

         ."<form method=\"POST\" action=\"".$admin_file.".php?op=scmain\">" 

         ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCCONTACTOPT."</strong><br /><br /></td>" 

         ."</tr>" 

         ."<tr><td width=\"70%\">"._SCMAILCATALOG."</td>" 

         ."<td width=\"30%\"><input type='text' name='scmail' value=".$row['scmail']." size='20' maxLength='255'></td></tr>" 

         ."<tr><td width=\"70%\">"._SCMAILCATALOGSUB."</td>" 

         ."<td width=\"30%\"><input type='text' name='scsubject' value='$scsubject' size='20' maxLength='255'></td></tr>" 

         ."<tr><td width=\"70%\">"._SCMAILCON."</td>" 

         ."<td width=\"30%\"><input type='text' name='sccontact' value=".$row['sccontact']." size='20' maxLength='255'></td></tr>" 

         ."<tr><td width=\"70%\">"._SCMAILCONSUB."</td>" 

         ."<td width=\"30%\"><input type='text' name='sccontactsubject' value='$sccontactsubject' size='20' maxLength='255'></td></tr>" 

         ."<tr><td width=\"70%\">"._SCMAILNAME."</td>" 

         ."<td width=\"30%\"><input type='text' name='scname' value='$scname' size='20' maxLength='255'></td></tr>" 

         ."<tr>" 

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scmain\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center></form>" 

         ."</td>" 

         ."</tr>" 

         ."</table>"; 

		CloseTable(); 

		scmenu(); 

		include_once("footer.php"); 

   }



	function scc1($save=0, $c1_desc=0, $c1=0, $c1p1_img=0, $c1p1_tit=0, $c1p1_desc=0, $c1p1_buy=0, $c1p1_cart=0, $c1p1_active=0, $c1p2_img=0, $c1p2_tit=0, $c1p2_desc=0, $c1p2_buy=0, $c1p2_cart=0, $c1p2_active=0, $c1p3_img=0, $c1p3_tit=0, $c1p3_desc=0, $c1p3_buy=0, $c1p3_cart=0, $c1p3_active=0, $c1p4_img=0, $c1p4_tit=0, $c1p4_desc=0, $c1p4_buy=0, $c1p4_cart=0, $c1p4_active=0, $c1p5_img=0, $c1p5_tit=0, $c1p5_desc=0, $c1p5_buy=0, $c1p5_cart=0, $c1p5_active=0, $c1p6_img=0, $c1p6_tit=0, $c1p6_desc=0, $c1p6_buy=0, $c1p6_cart=0, $c1p6_active=0, $c1p7_img=0, $c1p7_tit=0, $c1p7_desc=0, $c1p7_buy=0, $c1p7_cart=0, $c1p7_active=0, $c1p8_img=0, $c1p8_tit=0, $c1p8_desc=0, $c1p8_buy=0, $c1p8_cart=0, $c1p8_active=0) {

		global $prefix, $db, $bgcolor2, $sitename, $admin_file;

		define('NO_EDITOR', 1);	

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart_products SET c1_desc='$c1_desc', c1='$c1', c1p1_img='$c1p1_img', c1p1_tit='$c1p1_tit', c1p1_desc='$c1p1_desc', c1p1_buy='$c1p1_buy', c1p1_cart='$c1p1_cart', c1p1_active='$c1p1_active', c1p2_img='$c1p2_img', c1p2_tit='$c1p2_tit', c1p2_desc='$c1p2_desc', c1p2_buy='$c1p2_buy', c1p2_cart='$c1p2_cart', c1p2_active='$c1p2_active', c1p3_img='$c1p3_img', c1p3_tit='$c1p3_tit', c1p3_desc='$c1p3_desc', c1p3_buy='$c1p3_buy', c1p3_cart='$c1p3_cart', c1p3_active='$c1p3_active', c1p4_img='$c1p4_img', c1p4_tit='$c1p4_tit', c1p4_desc='$c1p4_desc', c1p4_buy='$c1p4_buy', c1p4_cart='$c1p4_cart', c1p4_active='$c1p4_active', c1p5_img='$c1p5_img', c1p5_tit='$c1p5_tit', c1p5_desc='$c1p5_desc', c1p5_buy='$c1p5_buy', c1p5_cart='$c1p5_cart', c1p5_active='$c1p5_active', c1p6_img='$c1p6_img', c1p6_tit='$c1p6_tit', c1p6_desc='$c1p6_desc', c1p6_buy='$c1p6_buy', c1p6_cart='$c1p6_cart', c1p6_active='$c1p6_active', c1p7_img='$c1p7_img', c1p7_tit='$c1p7_tit', c1p7_desc='$c1p7_desc', c1p7_buy='$c1p7_buy', c1p7_cart='$c1p7_cart', c1p7_active='$c1p7_active', c1p8_img='$c1p8_img', c1p8_tit='$c1p8_tit', c1p8_desc='$c1p8_desc', c1p8_buy='$c1p8_buy', c1p8_cart='$c1p8_cart', c1p8_active='$c1p8_active'");

			Header("Location: ".$admin_file.".php?op=scc1");

			die();

		}

		include_once("header.php");

		title("$sitename "._SCC1TITLE."");

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart_products "));

		$result = $db->sql_query("SELECT c1_desc, c1, c1p1_img, c1p1_tit, c1p1_desc, c1p1_buy, c1p1_cart, c1p1_active, c1p2_img, c1p2_tit, c1p2_desc, c1p2_buy, c1p2_cart, c1p2_active, c1p3_img, c1p3_tit, c1p3_desc, c1p3_buy, c1p3_cart, c1p3_active, c1p4_img, c1p4_tit, c1p4_desc, c1p4_buy, c1p4_cart, c1p4_active, c1p5_img, c1p5_tit, c1p5_desc, c1p5_buy, c1p5_cart, c1p5_active, c1p6_img, c1p6_tit, c1p6_desc, c1p6_buy, c1p6_cart, c1p6_active, c1p7_img, c1p7_tit, c1p7_desc, c1p7_buy, c1p7_cart, c1p7_active, c1p8_img, c1p8_tit, c1p8_desc, c1p8_buy, c1p8_cart, c1p8_active from ".$prefix."_simplecart_products ");

		list($c1_desc, $c1, $c1p1_img, $c1p1_tit, $c1p1_desc, $c1p1_buy, $c1p1_cart, $c1p1_active, $c1p2_img, $c1p2_tit, $c1p2_desc, $c1p2_buy, $c1p2_cart, $c1p2_active, $c1p3_img, $c1p3_tit, $c1p3_desc, $c1p3_buy, $c1p3_cart, $c1p3_active, $c1p4_img, $c1p4_tit, $c1p4_desc, $c1p4_buy, $c1p4_cart, $c1p4_active, $c1p5_img, $c1p5_tit, $c1p5_desc, $c1p5_buy, $c1p5_cart, $c1p5_active, $c1p6_img, $c1p6_tit, $c1p6_desc, $c1p6_buy, $c1p6_cart, $c1p6_active, $c1p7_img, $c1p7_tit, $c1p7_desc, $c1p7_buy, $c1p7_cart, $c1p7_active, $c1p8_img, $c1p8_tit, $c1p8_desc, $c1p8_buy, $c1p8_cart, $c1p8_active) = $db->sql_fetchrow($result);

		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"90%\" align=\"center\">"         

		 ."<form method=\"POST\" action=\"".$admin_file.".php?op=scc1\">"         

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCADMINMENUC1."</strong><br /><br /></td>"

         ."</tr>"    			

         ."<tr><td width=\"70%\">"._SCCDESC.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1_desc' value='$c1_desc' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1' value='$c1' size='50' maxLength='255'></td></tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P1."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p1_img' value='$c1p1_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p1_tit' value='$c1p1_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p1_desc\" rows=\"15\" cols=\"70\">".$row['c1p1_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p1_buy\" rows=\"15\" cols=\"70\">".$row['c1p1_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p1_cart\" rows=\"15\" cols=\"70\">".$row['c1p1_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p1_active==1) {

			echo "<input type='radio' name='c1p1_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p1_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p1_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p1_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P2."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p2_img' value='$c1p2_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p2_tit' value='$c1p2_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p2_desc\" rows=\"15\" cols=\"70\">".$row['c1p2_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p2_buy\" rows=\"15\" cols=\"70\">".$row['c1p2_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p2_cart\" rows=\"15\" cols=\"70\">".$row['c1p2_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p2_active==1) {

			echo "<input type='radio' name='c1p2_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p2_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p2_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p2_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P3."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p3_img' value='$c1p3_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p3_tit' value='$c1p3_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p3_desc\" rows=\"15\" cols=\"70\">".$row['c1p3_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p3_buy\" rows=\"15\" cols=\"70\">".$row['c1p3_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p3_cart\" rows=\"15\" cols=\"70\">".$row['c1p3_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p3_active==1) {

			echo "<input type='radio' name='c1p3_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p3_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p3_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p3_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P4."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p4_img' value='$c1p4_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p4_tit' value='$c1p4_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p4_desc\" rows=\"15\" cols=\"70\">".$row['c1p4_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p4_buy\" rows=\"15\" cols=\"70\">".$row['c1p4_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p4_cart\" rows=\"15\" cols=\"70\">".$row['c1p4_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p4_active==1) {

			echo "<input type='radio' name='c1p4_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p4_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p4_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p4_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P5."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p5_img' value='$c1p5_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p5_tit' value='$c1p5_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p5_desc\" rows=\"15\" cols=\"70\">".$row['c1p5_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p5_buy\" rows=\"15\" cols=\"70\">".$row['c1p5_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p5_cart\" rows=\"15\" cols=\"70\">".$row['c1p5_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p5_active==1) {

			echo "<input type='radio' name='c1p5_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p5_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p5_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p5_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P6."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p6_img' value='$c1p6_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p6_tit' value='$c1p6_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p6_desc\" rows=\"15\" cols=\"70\">".$row['c1p6_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p6_buy\" rows=\"15\" cols=\"70\">".$row['c1p6_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p6_cart\" rows=\"15\" cols=\"70\">".$row['c1p6_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p6_active==1) {

			echo "<input type='radio' name='c1p6_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p6_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p6_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p6_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P7."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p7_img' value='$c1p7_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p7_tit' value='$c1p7_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p7_desc\" rows=\"15\" cols=\"70\">".$row['c1p7_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p7_buy\" rows=\"15\" cols=\"70\">".$row['c1p7_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p7_cart\" rows=\"15\" cols=\"70\">".$row['c1p7_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p7_active==1) {

			echo "<input type='radio' name='c1p7_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p7_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p7_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p7_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P8."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p8_img' value='$c1p8_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c1p8_tit' value='$c1p8_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c1p8_desc\" rows=\"15\" cols=\"70\">".$row['c1p8_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c1p8_buy\" rows=\"15\" cols=\"70\">".$row['c1p8_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c1p8_cart\" rows=\"15\" cols=\"70\">".$row['c1p8_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c1p8_active==1) {

			echo "<input type='radio' name='c1p8_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p8_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c1p8_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c1p8_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc1\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center></form>"

         ."</td>"

         ."</tr>"		 

         ."</table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}



	function scc2($save=0, $c2_desc=0, $c2=0, $c2p1_img=0, $c2p1_tit=0, $c2p1_desc=0, $c2p1_buy=0, $c2p1_cart=0, $c2p1_active=0, $c2p2_img=0, $c2p2_tit=0, $c2p2_desc=0, $c2p2_buy=0, $c2p2_cart=0, $c2p2_active=0, $c2p3_img=0, $c2p3_tit=0, $c2p3_desc=0, $c2p3_buy=0, $c2p3_cart=0, $c2p3_active=0, $c2p4_img=0, $c2p4_tit=0, $c2p4_desc=0, $c2p4_buy=0, $c2p4_cart=0, $c2p4_active=0, $c2p5_img=0, $c2p5_tit=0, $c2p5_desc=0, $c2p5_buy=0, $c2p5_cart=0, $c2p5_active=0, $c2p6_img=0, $c2p6_tit=0, $c2p6_desc=0, $c2p6_buy=0, $c2p6_cart=0, $c2p6_active=0, $c2p7_img=0, $c2p7_tit=0, $c2p7_desc=0, $c2p7_buy=0, $c2p7_cart=0, $c2p7_active=0, $c2p8_img=0, $c2p8_tit=0, $c2p8_desc=0, $c2p8_buy=0, $c2p8_cart=0, $c2p8_active=0) {

		global $prefix, $db, $bgcolor2, $sitename, $admin_file;

		define('NO_EDITOR', 1);	

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart_services SET c2_desc='$c2_desc', c2='$c2', c2p1_img='$c2p1_img', c2p1_tit='$c2p1_tit', c2p1_desc='$c2p1_desc', c2p1_buy='$c2p1_buy', c2p1_cart='$c2p1_cart', c2p1_active='$c2p1_active', c2p2_img='$c2p2_img', c2p2_tit='$c2p2_tit', c2p2_desc='$c2p2_desc', c2p2_buy='$c2p2_buy', c2p2_cart='$c2p2_cart', c2p2_active='$c2p2_active', c2p3_img='$c2p3_img', c2p3_tit='$c2p3_tit', c2p3_desc='$c2p3_desc', c2p3_buy='$c2p3_buy', c2p3_cart='$c2p3_cart', c2p3_active='$c2p3_active', c2p4_img='$c2p4_img', c2p4_tit='$c2p4_tit', c2p4_desc='$c2p4_desc', c2p4_buy='$c2p4_buy', c2p4_cart='$c2p4_cart', c2p4_active='$c2p4_active', c2p5_img='$c2p5_img', c2p5_tit='$c2p5_tit', c2p5_desc='$c2p5_desc', c2p5_buy='$c2p5_buy', c2p5_cart='$c2p5_cart', c2p5_active='$c2p5_active', c2p6_img='$c2p6_img', c2p6_tit='$c2p6_tit', c2p6_desc='$c2p6_desc', c2p6_buy='$c2p6_buy', c2p6_cart='$c2p6_cart', c2p6_active='$c2p6_active', c2p7_img='$c2p7_img', c2p7_tit='$c2p7_tit', c2p7_desc='$c2p7_desc', c2p7_buy='$c2p7_buy', c2p7_cart='$c2p7_cart', c2p7_active='$c2p7_active', c2p8_img='$c2p8_img', c2p8_tit='$c2p8_tit', c2p8_desc='$c2p8_desc', c2p8_buy='$c2p8_buy', c2p8_cart='$c2p8_cart', c2p8_active='$c2p8_active'");

			Header("Location: ".$admin_file.".php?op=scc2");

			die();

		}

		include_once("header.php");

		title("$sitename "._SCC2TITLE."");

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart_services "));

		$result = $db->sql_query("SELECT c2_desc, c2, c2p1_img, c2p1_tit, c2p1_desc, c2p1_buy, c2p1_cart, c2p1_active, c2p2_img, c2p2_tit, c2p2_desc, c2p2_buy, c2p2_cart, c2p2_active, c2p3_img, c2p3_tit, c2p3_desc, c2p3_buy, c2p3_cart, c2p3_active, c2p4_img, c2p4_tit, c2p4_desc, c2p4_buy, c2p4_cart, c2p4_active, c2p5_img, c2p5_tit, c2p5_desc, c2p5_buy, c2p5_cart, c2p5_active, c2p6_img, c2p6_tit, c2p6_desc, c2p6_buy, c2p6_cart, c2p6_active, c2p7_img, c2p7_tit, c2p7_desc, c2p7_buy, c2p7_cart, c2p7_active, c2p8_img, c2p8_tit, c2p8_desc, c2p8_buy, c2p8_cart, c2p8_active from ".$prefix."_simplecart_services ");

		list($c2_desc, $c2, $c2p1_img, $c2p1_tit, $c2p1_desc, $c2p1_buy, $c2p1_cart, $c2p1_active, $c2p2_img, $c2p2_tit, $c2p2_desc, $c2p2_buy, $c2p2_cart, $c2p2_active, $c2p3_img, $c2p3_tit, $c2p3_desc, $c2p3_buy, $c2p3_cart, $c2p3_active, $c2p4_img, $c2p4_tit, $c2p4_desc, $c2p4_buy, $c2p4_cart, $c2p4_active, $c2p5_img, $c2p5_tit, $c2p5_desc, $c2p5_buy, $c2p5_cart, $c2p5_active, $c2p6_img, $c2p6_tit, $c2p6_desc, $c2p6_buy, $c2p6_cart, $c2p6_active, $c2p7_img, $c2p7_tit, $c2p7_desc, $c2p7_buy, $c2p7_cart, $c2p7_active, $c2p8_img, $c2p8_tit, $c2p8_desc, $c2p8_buy, $c2p8_cart, $c2p8_active) = $db->sql_fetchrow($result);

		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"90%\" align=\"center\">"         

		 ."<form method=\"POST\" action=\"".$admin_file.".php?op=scc2\">"         

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCADMINMENUC2."</strong><br /><br /></td>"

         ."</tr>"    			

         ."<tr><td width=\"70%\">"._SCCDESC.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2_desc' value='$c2_desc' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2' value='$c2' size='50' maxLength='255'></td></tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P9."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p1_img' value='$c2p1_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p1_tit' value='$c2p1_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p1_desc\" rows=\"15\" cols=\"70\">".$row['c2p1_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p1_buy\" rows=\"15\" cols=\"70\">".$row['c2p1_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p1_cart\" rows=\"15\" cols=\"70\">".$row['c2p1_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p1_active==1) {

			echo "<input type='radio' name='c2p1_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p1_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p1_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p1_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P10."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p2_img' value='$c2p2_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p2_tit' value='$c2p2_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p2_desc\" rows=\"15\" cols=\"70\">".$row['c2p2_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p2_buy\" rows=\"15\" cols=\"70\">".$row['c2p2_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p2_cart\" rows=\"15\" cols=\"70\">".$row['c2p2_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p2_active==1) {

			echo "<input type='radio' name='c2p2_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p2_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p2_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p2_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P11."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p3_img' value='$c2p3_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p3_tit' value='$c2p3_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p3_desc\" rows=\"15\" cols=\"70\">".$row['c2p3_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p3_buy\" rows=\"15\" cols=\"70\">".$row['c2p3_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p3_cart\" rows=\"15\" cols=\"70\">".$row['c2p3_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p3_active==1) {

			echo "<input type='radio' name='c2p3_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p3_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p3_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p3_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P12."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p4_img' value='$c2p4_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p4_tit' value='$c2p4_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p4_desc\" rows=\"15\" cols=\"70\">".$row['c2p4_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p4_buy\" rows=\"15\" cols=\"70\">".$row['c2p4_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p4_cart\" rows=\"15\" cols=\"70\">".$row['c2p4_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p4_active==1) {

			echo "<input type='radio' name='c2p4_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p4_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p4_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p4_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P13."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p5_img' value='$c2p5_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p5_tit' value='$c2p5_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p5_desc\" rows=\"15\" cols=\"70\">".$row['c2p5_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p5_buy\" rows=\"15\" cols=\"70\">".$row['c2p5_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p5_cart\" rows=\"15\" cols=\"70\">".$row['c2p5_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p5_active==1) {

			echo "<input type='radio' name='c2p5_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p5_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p5_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p5_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P14."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p6_img' value='$c2p6_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p6_tit' value='$c2p6_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p6_desc\" rows=\"15\" cols=\"70\">".$row['c2p6_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p6_buy\" rows=\"15\" cols=\"70\">".$row['c2p6_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p6_cart\" rows=\"15\" cols=\"70\">".$row['c2p6_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p6_active==1) {

			echo "<input type='radio' name='c2p6_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p6_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p6_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p6_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P15."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p7_img' value='$c2p7_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p7_tit' value='$c2p7_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p7_desc\" rows=\"15\" cols=\"70\">".$row['c2p7_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p7_buy\" rows=\"15\" cols=\"70\">".$row['c2p7_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p7_cart\" rows=\"15\" cols=\"70\">".$row['c2p7_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p7_active==1) {

			echo "<input type='radio' name='c2p7_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p7_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p7_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p7_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P16."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p8_img' value='$c2p8_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c2p8_tit' value='$c2p8_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c2p8_desc\" rows=\"15\" cols=\"70\">".$row['c2p8_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c2p8_buy\" rows=\"15\" cols=\"70\">".$row['c2p8_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c2p8_cart\" rows=\"15\" cols=\"70\">".$row['c2p8_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c2p8_active==1) {

			echo "<input type='radio' name='c2p8_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p8_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c2p8_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c2p8_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc2\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center></form>"

         ."</td>"

         ."</tr>"		 

         ."</table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}



	function scc3($save=0, $c3_desc=0, $c3=0, $c3p1_img=0, $c3p1_tit=0, $c3p1_desc=0, $c3p1_buy=0, $c3p1_cart=0, $c3p1_active=0, $c3p2_img=0, $c3p2_tit=0, $c3p2_desc=0, $c3p2_buy=0, $c3p2_cart=0, $c3p2_active=0, $c3p3_img=0, $c3p3_tit=0, $c3p3_desc=0, $c3p3_buy=0, $c3p3_cart=0, $c3p3_active=0, $c3p4_img=0, $c3p4_tit=0, $c3p4_desc=0, $c3p4_buy=0, $c3p4_cart=0, $c3p4_active=0, $c3p5_img=0, $c3p5_tit=0, $c3p5_desc=0, $c3p5_buy=0, $c3p5_cart=0, $c3p5_active=0, $c3p6_img=0, $c3p6_tit=0, $c3p6_desc=0, $c3p6_buy=0, $c3p6_cart=0, $c3p6_active=0, $c3p7_img=0, $c3p7_tit=0, $c3p7_desc=0, $c3p7_buy=0, $c3p7_cart=0, $c3p7_active=0, $c3p8_img=0, $c3p8_tit=0, $c3p8_desc=0, $c3p8_buy=0, $c3p8_cart=0, $c3p8_active=0) {

		global $prefix, $db, $bgcolor2, $sitename, $admin_file;

		define('NO_EDITOR', 1);	

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart_specials SET c3_desc='$c3_desc', c3='$c3', c3p1_img='$c3p1_img', c3p1_tit='$c3p1_tit', c3p1_desc='$c3p1_desc', c3p1_buy='$c3p1_buy', c3p1_cart='$c3p1_cart', c3p1_active='$c3p1_active', c3p2_img='$c3p2_img', c3p2_tit='$c3p2_tit', c3p2_desc='$c3p2_desc', c3p2_buy='$c3p2_buy', c3p2_cart='$c3p2_cart', c3p2_active='$c3p2_active', c3p3_img='$c3p3_img', c3p3_tit='$c3p3_tit', c3p3_desc='$c3p3_desc', c3p3_buy='$c3p3_buy', c3p3_cart='$c3p3_cart', c3p3_active='$c3p3_active', c3p4_img='$c3p4_img', c3p4_tit='$c3p4_tit', c3p4_desc='$c3p4_desc', c3p4_buy='$c3p4_buy', c3p4_cart='$c3p4_cart', c3p4_active='$c3p4_active', c3p5_img='$c3p5_img', c3p5_tit='$c3p5_tit', c3p5_desc='$c3p5_desc', c3p5_buy='$c3p5_buy', c3p5_cart='$c3p5_cart', c3p5_active='$c3p5_active', c3p6_img='$c3p6_img', c3p6_tit='$c3p6_tit', c3p6_desc='$c3p6_desc', c3p6_buy='$c3p6_buy', c3p6_cart='$c3p6_cart', c3p6_active='$c3p6_active', c3p7_img='$c3p7_img', c3p7_tit='$c3p7_tit', c3p7_desc='$c3p7_desc', c3p7_buy='$c3p7_buy', c3p7_cart='$c3p7_cart', c3p7_active='$c3p7_active', c3p8_img='$c3p8_img', c3p8_tit='$c3p8_tit', c3p8_desc='$c3p8_desc', c3p8_buy='$c3p8_buy', c3p8_cart='$c3p8_cart', c3p8_active='$c3p8_active'");

			Header("Location: ".$admin_file.".php?op=scc3");

			die();

		}

		include_once("header.php");

		title("$sitename "._SCC3TITLE."");

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart_specials "));

		$result = $db->sql_query("SELECT c3_desc, c3, c3p1_img, c3p1_tit, c3p1_desc, c3p1_buy, c3p1_cart, c3p1_active, c3p2_img, c3p2_tit, c3p2_desc, c3p2_buy, c3p2_cart, c3p2_active, c3p3_img, c3p3_tit, c3p3_desc, c3p3_buy, c3p3_cart, c3p3_active, c3p4_img, c3p4_tit, c3p4_desc, c3p4_buy, c3p4_cart, c3p4_active, c3p5_img, c3p5_tit, c3p5_desc, c3p5_buy, c3p5_cart, c3p5_active, c3p6_img, c3p6_tit, c3p6_desc, c3p6_buy, c3p6_cart, c3p6_active, c3p7_img, c3p7_tit, c3p7_desc, c3p7_buy, c3p7_cart, c3p7_active, c3p8_img, c3p8_tit, c3p8_desc, c3p8_buy, c3p8_cart, c3p8_active from ".$prefix."_simplecart_specials ");

		list($c3_desc, $c3, $c3p1_img, $c3p1_tit, $c3p1_desc, $c3p1_buy, $c3p1_cart, $c3p1_active, $c3p2_img, $c3p2_tit, $c3p2_desc, $c3p2_buy, $c3p2_cart, $c3p2_active, $c3p3_img, $c3p3_tit, $c3p3_desc, $c3p3_buy, $c3p3_cart, $c3p3_active, $c3p4_img, $c3p4_tit, $c3p4_desc, $c3p4_buy, $c3p4_cart, $c3p4_active, $c3p5_img, $c3p5_tit, $c3p5_desc, $c3p5_buy, $c3p5_cart, $c3p5_active, $c3p6_img, $c3p6_tit, $c3p6_desc, $c3p6_buy, $c3p6_cart, $c3p6_active, $c3p7_img, $c3p7_tit, $c3p7_desc, $c3p7_buy, $c3p7_cart, $c3p7_active, $c3p8_img, $c3p8_tit, $c3p8_desc, $c3p8_buy, $c3p8_cart, $c3p8_active) = $db->sql_fetchrow($result);

		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"90%\" align=\"center\">"         

		 ."<form method=\"POST\" action=\"".$admin_file.".php?op=scc3\">"         

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCADMINMENUC3."</strong><br /><br /></td>"

         ."</tr>"    			

         ."<tr><td width=\"70%\">"._SCCDESC.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3_desc' value='$c3_desc' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3' value='$c3' size='50' maxLength='255'></td></tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P17."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p1_img' value='$c3p1_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p1_tit' value='$c3p1_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p1_desc\" rows=\"15\" cols=\"70\">".$row['c3p1_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p1_buy\" rows=\"15\" cols=\"70\">".$row['c3p1_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p1_cart\" rows=\"15\" cols=\"70\">".$row['c3p1_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p1_active==1) {

			echo "<input type='radio' name='c3p1_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p1_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p1_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p1_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P18."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p2_img' value='$c3p2_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p2_tit' value='$c3p2_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p2_desc\" rows=\"15\" cols=\"70\">".$row['c3p2_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p2_buy\" rows=\"15\" cols=\"70\">".$row['c3p2_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p2_cart\" rows=\"15\" cols=\"70\">".$row['c3p2_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p2_active==1) {

			echo "<input type='radio' name='c3p2_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p2_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p2_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p2_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P19."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p3_img' value='$c3p3_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p3_tit' value='$c3p3_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p3_desc\" rows=\"15\" cols=\"70\">".$row['c3p3_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p3_buy\" rows=\"15\" cols=\"70\">".$row['c3p3_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p3_cart\" rows=\"15\" cols=\"70\">".$row['c3p3_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p3_active==1) {

			echo "<input type='radio' name='c3p3_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p3_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p3_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p3_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P20."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p4_img' value='$c3p4_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p4_tit' value='$c3p4_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p4_desc\" rows=\"15\" cols=\"70\">".$row['c3p4_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p4_buy\" rows=\"15\" cols=\"70\">".$row['c3p4_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p4_cart\" rows=\"15\" cols=\"70\">".$row['c3p4_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p4_active==1) {

			echo "<input type='radio' name='c3p4_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p4_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p4_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p4_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P21."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p5_img' value='$c3p5_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p5_tit' value='$c3p5_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p5_desc\" rows=\"15\" cols=\"70\">".$row['c3p5_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p5_buy\" rows=\"15\" cols=\"70\">".$row['c3p5_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p5_cart\" rows=\"15\" cols=\"70\">".$row['c3p5_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p5_active==1) {

			echo "<input type='radio' name='c3p5_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p5_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p5_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p5_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P22."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p6_img' value='$c3p6_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p6_tit' value='$c3p6_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p6_desc\" rows=\"15\" cols=\"70\">".$row['c3p6_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p6_buy\" rows=\"15\" cols=\"70\">".$row['c3p6_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p6_cart\" rows=\"15\" cols=\"70\">".$row['c3p6_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p6_active==1) {

			echo "<input type='radio' name='c3p6_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p6_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p6_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p6_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P23."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p7_img' value='$c3p7_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p7_tit' value='$c3p7_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p7_desc\" rows=\"15\" cols=\"70\">".$row['c3p7_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p7_buy\" rows=\"15\" cols=\"70\">".$row['c3p7_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p7_cart\" rows=\"15\" cols=\"70\">".$row['c3p7_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p7_active==1) {

			echo "<input type='radio' name='c3p7_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p7_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p7_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p7_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P24."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p8_img' value='$c3p8_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c3p8_tit' value='$c3p8_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c3p8_desc\" rows=\"15\" cols=\"70\">".$row['c3p8_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c3p8_buy\" rows=\"15\" cols=\"70\">".$row['c3p8_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c3p8_cart\" rows=\"15\" cols=\"70\">".$row['c3p8_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c3p8_active==1) {

			echo "<input type='radio' name='c3p8_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p8_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c3p8_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c3p8_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc3\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center></form>"

         ."</td>"

         ."</tr>"		 

         ."</table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}



	function scc4($save=0, $c4_desc=0, $c4=0, $c4p1_img=0, $c4p1_tit=0, $c4p1_desc=0, $c4p1_buy=0, $c4p1_cart=0, $c4p1_active=0, $c4p2_img=0, $c4p2_tit=0, $c4p2_desc=0, $c4p2_buy=0, $c4p2_cart=0, $c4p2_active=0, $c4p3_img=0, $c4p3_tit=0, $c4p3_desc=0, $c4p3_buy=0, $c4p3_cart=0, $c4p3_active=0, $c4p4_img=0, $c4p4_tit=0, $c4p4_desc=0, $c4p4_buy=0, $c4p4_cart=0, $c4p4_active=0, $c4p5_img=0, $c4p5_tit=0, $c4p5_desc=0, $c4p5_buy=0, $c4p5_cart=0, $c4p5_active=0, $c4p6_img=0, $c4p6_tit=0, $c4p6_desc=0, $c4p6_buy=0, $c4p6_cart=0, $c4p6_active=0, $c4p7_img=0, $c4p7_tit=0, $c4p7_desc=0, $c4p7_buy=0, $c4p7_cart=0, $c4p7_active=0, $c4p8_img=0, $c4p8_tit=0, $c4p8_desc=0, $c4p8_buy=0, $c4p8_cart=0, $c4p8_active=0) {

		global $prefix, $db, $bgcolor2, $sitename, $admin_file;

		define('NO_EDITOR', 1);	

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart_featured SET c4_desc='$c4_desc', c4='$c4', c4p1_img='$c4p1_img', c4p1_tit='$c4p1_tit', c4p1_desc='$c4p1_desc', c4p1_buy='$c4p1_buy', c4p1_cart='$c4p1_cart', c4p1_active='$c4p1_active', c4p2_img='$c4p2_img', c4p2_tit='$c4p2_tit', c4p2_desc='$c4p2_desc', c4p2_buy='$c4p2_buy', c4p2_cart='$c4p2_cart', c4p2_active='$c4p2_active', c4p3_img='$c4p3_img', c4p3_tit='$c4p3_tit', c4p3_desc='$c4p3_desc', c4p3_buy='$c4p3_buy', c4p3_cart='$c4p3_cart', c4p3_active='$c4p3_active', c4p4_img='$c4p4_img', c4p4_tit='$c4p4_tit', c4p4_desc='$c4p4_desc', c4p4_buy='$c4p4_buy', c4p4_cart='$c4p4_cart', c4p4_active='$c4p4_active', c4p5_img='$c4p5_img', c4p5_tit='$c4p5_tit', c4p5_desc='$c4p5_desc', c4p5_buy='$c4p5_buy', c4p5_cart='$c4p5_cart', c4p5_active='$c4p5_active', c4p6_img='$c4p6_img', c4p6_tit='$c4p6_tit', c4p6_desc='$c4p6_desc', c4p6_buy='$c4p6_buy', c4p6_cart='$c4p6_cart', c4p6_active='$c4p6_active', c4p7_img='$c4p7_img', c4p7_tit='$c4p7_tit', c4p7_desc='$c4p7_desc', c4p7_buy='$c4p7_buy', c4p7_cart='$c4p7_cart', c4p7_active='$c4p7_active', c4p8_img='$c4p8_img', c4p8_tit='$c4p8_tit', c4p8_desc='$c4p8_desc', c4p8_buy='$c4p8_buy', c4p8_cart='$c4p8_cart', c4p8_active='$c4p8_active'");

			Header("Location: ".$admin_file.".php?op=scc4");

			die();

		}

		include_once("header.php");

		title("$sitename "._SCC4TITLE."");

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart_featured "));

		$result = $db->sql_query("SELECT c4_desc, c4, c4p1_img, c4p1_tit, c4p1_desc, c4p1_buy, c4p1_cart, c4p1_active, c4p2_img, c4p2_tit, c4p2_desc, c4p2_buy, c4p2_cart, c4p2_active, c4p3_img, c4p3_tit, c4p3_desc, c4p3_buy, c4p3_cart, c4p3_active, c4p4_img, c4p4_tit, c4p4_desc, c4p4_buy, c4p4_cart, c4p4_active, c4p5_img, c4p5_tit, c4p5_desc, c4p5_buy, c4p5_cart, c4p5_active, c4p6_img, c4p6_tit, c4p6_desc, c4p6_buy, c4p6_cart, c4p6_active, c4p7_img, c4p7_tit, c4p7_desc, c4p7_buy, c4p7_cart, c4p7_active, c4p8_img, c4p8_tit, c4p8_desc, c4p8_buy, c4p8_cart, c4p8_active from ".$prefix."_simplecart_featured ");

		list($c4_desc, $c4, $c4p1_img, $c4p1_tit, $c4p1_desc, $c4p1_buy, $c4p1_cart, $c4p1_active, $c4p2_img, $c4p2_tit, $c4p2_desc, $c4p2_buy, $c4p2_cart, $c4p2_active, $c4p3_img, $c4p3_tit, $c4p3_desc, $c4p3_buy, $c4p3_cart, $c4p3_active, $c4p4_img, $c4p4_tit, $c4p4_desc, $c4p4_buy, $c4p4_cart, $c4p4_active, $c4p5_img, $c4p5_tit, $c4p5_desc, $c4p5_buy, $c4p5_cart, $c4p5_active, $c4p6_img, $c4p6_tit, $c4p6_desc, $c4p6_buy, $c4p6_cart, $c4p6_active, $c4p7_img, $c4p7_tit, $c4p7_desc, $c4p7_buy, $c4p7_cart, $c4p7_active, $c4p8_img, $c4p8_tit, $c4p8_desc, $c4p8_buy, $c4p8_cart, $c4p8_active) = $db->sql_fetchrow($result);

		echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"90%\" align=\"center\">"         

		 ."<form method=\"POST\" action=\"".$admin_file.".php?op=scc4\">"         

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCADMINMENUC4."</strong><br /><br /></td>"

         ."</tr>"    			

         ."<tr><td width=\"70%\">"._SCCDESC.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4_desc' value='$c4_desc' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4' value='$c4' size='50' maxLength='255'></td></tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P25."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p1_img' value='$c4p1_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p1_tit' value='$c4p1_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p1_desc\" rows=\"15\" cols=\"70\">".$row['c4p1_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p1_buy\" rows=\"15\" cols=\"70\">".$row['c4p1_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p1_cart\" rows=\"15\" cols=\"70\">".$row['c4p1_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p1_active==1) {

			echo "<input type='radio' name='c4p1_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p1_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p1_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p1_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P26."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p2_img' value='$c4p2_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p2_tit' value='$c4p2_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p2_desc\" rows=\"15\" cols=\"70\">".$row['c4p2_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p2_buy\" rows=\"15\" cols=\"70\">".$row['c4p2_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p2_cart\" rows=\"15\" cols=\"70\">".$row['c4p2_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p2_active==1) {

			echo "<input type='radio' name='c4p2_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p2_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p2_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p2_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P27."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p3_img' value='$c4p3_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p3_tit' value='$c4p3_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p3_desc\" rows=\"15\" cols=\"70\">".$row['c4p3_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p3_buy\" rows=\"15\" cols=\"70\">".$row['c4p3_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p3_cart\" rows=\"15\" cols=\"70\">".$row['c4p3_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p3_active==1) {

			echo "<input type='radio' name='c4p3_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p3_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p3_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p3_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P28."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p4_img' value='$c4p4_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p4_tit' value='$c4p4_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p4_desc\" rows=\"15\" cols=\"70\">".$row['c4p4_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p4_buy\" rows=\"15\" cols=\"70\">".$row['c4p4_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p4_cart\" rows=\"15\" cols=\"70\">".$row['c4p4_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p4_active==1) {

			echo "<input type='radio' name='c4p4_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p4_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p4_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p4_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P29."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p5_img' value='$c4p5_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p5_tit' value='$c4p5_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p5_desc\" rows=\"15\" cols=\"70\">".$row['c4p5_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p5_buy\" rows=\"15\" cols=\"70\">".$row['c4p5_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p5_cart\" rows=\"15\" cols=\"70\">".$row['c4p5_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p5_active==1) {

			echo "<input type='radio' name='c4p5_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p5_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p5_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p5_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P30."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p6_img' value='$c4p6_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p6_tit' value='$c4p6_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p6_desc\" rows=\"15\" cols=\"70\">".$row['c4p6_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p6_buy\" rows=\"15\" cols=\"70\">".$row['c4p6_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p6_cart\" rows=\"15\" cols=\"70\">".$row['c4p6_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p6_active==1) {

			echo "<input type='radio' name='c4p6_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p6_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p6_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p6_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P31."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p7_img' value='$c4p7_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p7_tit' value='$c4p7_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p7_desc\" rows=\"15\" cols=\"70\">".$row['c4p7_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p7_buy\" rows=\"15\" cols=\"70\">".$row['c4p7_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p7_cart\" rows=\"15\" cols=\"70\">".$row['c4p7_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p7_active==1) {

			echo "<input type='radio' name='c4p7_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p7_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p7_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p7_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center>"

         ."</td>"

         ."</tr>"		

		 ."<td width=\"100%\" colspan=\"2\"><hr color=\"$bgcolor2\" width=\"100%\"><strong>"._SCC1P32."</strong><br /><br /></td>"

         ."</tr>"		 

         ."<tr><td width=\"70%\">"._SCIMAGEURL.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p8_img' value='$c4p8_img' size='50' maxLength='255'></td></tr>"

         ."<tr><td width=\"70%\">"._SCCNAME.":</td>"

         ."<td width=\"30%\"><input type='text' name='c4p8_tit' value='$c4p8_tit' size='50' maxLength='255'></td></tr>"

         ."<tr><td>" . _SCCDESC . ":</td><td><textarea name=\"c4p8_desc\" rows=\"15\" cols=\"70\">".$row['c4p8_desc']."</textarea></td></tr>"

         ."<tr><td>" . _SCADDCART . ":<br /><br /><br /><input type='button' value='Button Factory' name='btnButton' ONCLICK=\"window.open('modules/SimpleCart/bf/addtocart.htm', 'ButtonFactory', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=560, height=820')\"></td><td><textarea name=\"c4p8_buy\" rows=\"15\" cols=\"70\">".$row['c4p8_buy']."</textarea></td></tr>"

         ."<tr><td>" . _SCVIEWCART . ":</td><td><textarea name=\"c4p8_cart\" rows=\"15\" cols=\"70\">".$row['c4p8_cart']."</textarea></td></tr>"

         ."<tr><td width=\"70%\">"._SCACTIVE."</td>"

		 ."<td width=\"30%\">";

         if ($c4p8_active==1) {

			echo "<input type='radio' name='c4p8_active' value='1' checked>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p8_active' value='0'>"._SCNO."";

			} else {

			echo "<input type='radio' name='c4p8_active' value='1'>"._SCYES." &nbsp;"

			."<input type='radio' name='c4p8_active' value='0' checked>"._SCNO."";

		}

		echo "</td></tr>"

         ."<td width=\"100%\" colspan=\"2\"><center><br /><input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scc4\"><br /><input type=\"submit\" value=\""._SCSAVE."\"></center></form>"

         ."</td>"

         ."</tr>"		 

         ."</table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}

 

	function scmainpage($save=0, $main=0) {

		global $prefix, $db, $sitename, $admin_file;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart SET main='$main'");

			Header("Location: ".$admin_file.".php?op=scmainpage");

			die();

		}

		include_once("header.php");

	    title("$sitename "._SCMAINPAGETITLE."");

        OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));

		$row['main'] = filter($row['main']);

		echo "<center><font class=\"title\"><strong>"._SCADMINMENUMAIN."</strong></font><br /><br /><i>"._SCSITENAMEEMBED."</i><br /><br />"

         ."<form method=\"POST\" action=\"".$admin_file.".php?op=scmainpage\">"

         .""._SCMAINPAGEBODY.":<br /><br /><textarea name=\"main\" rows=\"20\" cols=\"70\">".$row['main']."</textarea>";

		echo "<br /><br />"

         ."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scmainpage\"><br /><br /><input type=\"submit\" value=\""._SCSAVE."\">"

         ."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._SCMAINPAGENOTE."</i></td></tr></table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}



	function screferrals($save=0, $referrals=0) {

		global $prefix, $db, $sitename, $admin_file;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart SET referrals='$referrals'");

			Header("Location: ".$admin_file.".php?op=screferrals");

			die();

		}

		include_once("header.php");

	    title("$sitename "._SCREFERRALSTITLE."");

        OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));

		$row['referrals'] = filter($row['referrals']);

		echo "<center><font class=\"title\"><strong>"._SCADMINMENUREFERRALS."</strong></font><br /><br /><i>"._SCSITENAMEEMBED."</i><br /><br />"

         ."<form method=\"POST\" action=\"".$admin_file.".php?op=screferrals\">"

         .""._SCREFERRALSBODY.":<br /><br /><textarea name=\"referrals\" rows=\"20\" cols=\"70\">".$row['referrals']."</textarea>";

        echo "<br /><br />"

         ."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"screferrals\"><br /><br /><input type=\"submit\" value=\""._SCSAVE."\">"

         ."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._SCREFERRALSNOTE."</i></td></tr></table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}

	

	function scpolicies($save=0, $policies=0) {

		global $prefix, $db, $sitename, $admin_file;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart SET policies='$policies'");

			Header("Location: ".$admin_file.".php?op=scpolicies");

			die();

		}

		include_once("header.php");

	    title("$sitename "._SCPOLICIESTITLE."");

        OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));

		$row['policies'] = filter($row['policies']);

		echo "<center><font class=\"title\"><strong>"._SCADMINMENUPOLICIES."</strong></font><br /><br /><i>"._SCSITENAMEEMBED."</i><br /><br />"

         ."<form method=\"POST\" action=\"".$admin_file.".php?op=scpolicies\">"

         .""._SCPOLICIESBODY.":<br /><br /><textarea name=\"policies\" rows=\"20\" cols=\"70\">".$row['policies']."</textarea>";

        echo "<br /><br />"

         ."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scpolicies\"><br /><br /><input type=\"submit\" value=\""._SCSAVE."\">"

         ."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._SCPOLICIESNOTE."</i></td></tr></table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}



	function scconditions($save=0, $terms=0, $country=0) {

		global $prefix, $db, $sitename, $admin_file;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_simplecart SET terms='$terms', country='$country'");

			Header("Location: ".$admin_file.".php?op=scconditions");

			die();

		}

		include_once("header.php");

	    title("$sitename "._SCTERMSTITLE."");

        OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));

		$row['terms'] = filter($row['terms']);

		echo "<center><font class=\"title\"><strong>"._SCADMINMENUTERMS."</strong></font><br /><br /><i>"._SCTERMSSITENAMEEMBED."</i><br /><br />"

         ."<form method=\"POST\" action=\"".$admin_file.".php?op=scconditions\">"

         .""._SCTERMSBODY.":<br /><br /><textarea name=\"terms\" rows=\"20\" cols=\"70\">".$row['terms']."</textarea><br /><br />"

         .""._COUNTRYNAME.":<br /><br /><select name=\"country\">";

		$result = $db->sql_query("SELECT DISTINCT country FROM ".$prefix."_cities");

		while ($row2 = $db->sql_fetchrow($result)) {

			if ($row['country'] == $row2['country']) {

				$sel = "selected";

			} else {

				$sel = "";	

			}

			echo "<option value=\"".$row2['country']."\" $sel>".$row2['country']."</option>";

		}

		echo "</select><br /><br />"

         ."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"scconditions\"><br /><br /><input type=\"submit\" value=\""._SCSAVE."\">"

         ."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._SCTERMSNOTE."</i></td></tr></table>";

		CloseTable();

		scmenu();

		include_once("footer.php");

	}

	

	switch($op) {



		case "scmenu":

		scmenu();

		break;



		case "scmain": 

		scmain($save, $scmail, $scsubject, $sccontact, $sccontactsubject, $scname); 

		break;	

		

		case "scc1":

		scc1($save, $c1_desc, $c1, $c1p1_img, $c1p1_tit, $c1p1_desc, $c1p1_buy, $c1p1_cart, $c1p1_active, $c1p2_img, $c1p2_tit, $c1p2_desc, $c1p2_buy, $c1p2_cart, $c1p2_active, $c1p3_img, $c1p3_tit, $c1p3_desc, $c1p3_buy, $c1p3_cart, $c1p3_active, $c1p4_img, $c1p4_tit, $c1p4_desc, $c1p4_buy, $c1p4_cart, $c1p4_active, $c1p5_img, $c1p5_tit, $c1p5_desc, $c1p5_buy, $c1p5_cart, $c1p5_active, $c1p6_img, $c1p6_tit, $c1p6_desc, $c1p6_buy, $c1p6_cart, $c1p6_active, $c1p7_img, $c1p7_tit, $c1p7_desc, $c1p7_buy, $c1p7_cart, $c1p7_active, $c1p8_img, $c1p8_tit, $c1p8_desc, $c1p8_buy, $c1p8_cart, $c1p8_active);

		break;

		

		case "scc2":

		scc2($save, $c2_desc, $c2, $c2p1_img, $c2p1_tit, $c2p1_desc, $c2p1_buy, $c2p1_cart, $c2p1_active, $c2p2_img, $c2p2_tit, $c2p2_desc, $c2p2_buy, $c2p2_cart, $c2p2_active, $c2p3_img, $c2p3_tit, $c2p3_desc, $c2p3_buy, $c2p3_cart, $c2p3_active, $c2p4_img, $c2p4_tit, $c2p4_desc, $c2p4_buy, $c2p4_cart, $c2p4_active, $c2p5_img, $c2p5_tit, $c2p5_desc, $c2p5_buy, $c2p5_cart, $c2p5_active, $c2p6_img, $c2p6_tit, $c2p6_desc, $c2p6_buy, $c2p6_cart, $c2p6_active, $c2p7_img, $c2p7_tit, $c2p7_desc, $c2p7_buy, $c2p7_cart, $c2p7_active, $c2p8_img, $c2p8_tit, $c2p8_desc, $c2p8_buy, $c2p8_cart, $c2p8_active);

		break;

		

		case "scc3":

		scc3($save, $c3_desc, $c3, $c3p1_img, $c3p1_tit, $c3p1_desc, $c3p1_buy, $c3p1_cart, $c3p1_active, $c3p2_img, $c3p2_tit, $c3p2_desc, $c3p2_buy, $c3p2_cart, $c3p2_active, $c3p3_img, $c3p3_tit, $c3p3_desc, $c3p3_buy, $c3p3_cart, $c3p3_active, $c3p4_img, $c3p4_tit, $c3p4_desc, $c3p4_buy, $c3p4_cart, $c3p4_active, $c3p5_img, $c3p5_tit, $c3p5_desc, $c3p5_buy, $c3p5_cart, $c3p5_active, $c3p6_img, $c3p6_tit, $c3p6_desc, $c3p6_buy, $c3p6_cart, $c3p6_active, $c3p7_img, $c3p7_tit, $c3p7_desc, $c3p7_buy, $c3p7_cart, $c3p7_active, $c3p8_img, $c3p8_tit, $c3p8_desc, $c3p8_buy, $c3p8_cart, $c3p8_active);

		break;

		

		case "scc4":

		scc4($save, $c4_desc, $c4, $c4p1_img, $c4p1_tit, $c4p1_desc, $c4p1_buy, $c4p1_cart, $c4p1_active, $c4p2_img, $c4p2_tit, $c4p2_desc, $c4p2_buy, $c4p2_cart, $c4p2_active, $c4p3_img, $c4p3_tit, $c4p3_desc, $c4p3_buy, $c4p3_cart, $c4p3_active, $c4p4_img, $c4p4_tit, $c4p4_desc, $c4p4_buy, $c4p4_cart, $c4p4_active, $c4p5_img, $c4p5_tit, $c4p5_desc, $c4p5_buy, $c4p5_cart, $c4p5_active, $c4p6_img, $c4p6_tit, $c4p6_desc, $c4p6_buy, $c4p6_cart, $c4p6_active, $c4p7_img, $c4p7_tit, $c4p7_desc, $c4p7_buy, $c4p7_cart, $c4p7_active, $c4p8_img, $c4p8_tit, $c4p8_desc, $c4p8_buy, $c4p8_cart, $c4p8_active);

		break;

		

		case "scmainpage":

		scmainpage($save, $main);

		break;



		case "screferrals":

		screferrals($save, $referrals);

		break;



		case "scpolicies":

		scpolicies($save, $policies);

		break;

		

		case "scconditions":

		scconditions($save, $terms, $country);

		break;



	}



} else {

	echo "Access Denied";

}



?>

