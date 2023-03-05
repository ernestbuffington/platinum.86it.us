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
/************************************************************************/
/* Module by Gaylen Fraley                                              */
/* http://ravenphpscripts.com                                           */
/* http://ravenwebhosting.com                                           */
/* For use with nuke 6.5+                           .                   */
/* Change History                                                       */
/* 06/25/2005 - Version 2.0.2 Released                                  */
/*            - Fixed bug: the resend password was empty                */
/* 06/24/2005 - Version 2.0.1 Released                                  */
/*            - Fixed bug: the buttons were not language independent    */
/*            - German language translation added (Susan)               */
/*              Thanks to Susann for discovering the bug!               */
/* 06/12/2005 - Version 2.0.0 Released                                  */
/*            - Converted to new sql layer                              */
/*            - Converted & to &amp; where appropriate                  */
/*            - Efficiency modifications                                */
/*            - Added auto-refresh code to redirect where appropriate   */
/*            - Added date and timestamp added to the Waiting screen    */
/*            - Added language defines                                  */
/*            - Miscellaneous other tweaks                              */
/* 05/19/2003 - Added Modification facility to allow the Admin to make  */
/*              selected modifications to the temporary record.         */
/* 05/18/2003 - Fixed password display in email and added hyperlink     */
/*              to the display to allow the Admin to activate the user  */
/*              right from the module. The password will now be changed */
/*              when resending the email.                               */
/* 05/09/2003 - Released                                                */
/************************************************************************/

require_once("mainfile.php");
include_once("header.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$userpage = 1;
OpenTable();
title("$sitename".':<br />'._PENDINGREGISTRATIONS);

if(!defined('MODULE_FILE') AND !preg_match("#modules.php#i", $_SERVER['PHP_SELF'])) {
	echo '<center><strong>'._NOACCESS._SPACE1._RDHOME._SPACE1._TWO._SPACE1._SECONDS.'</strong></center><br />';
	CloseTable();
	header("Refresh: "._TWO."; URL=index.php");
	include_once("footer.php");
	exit();
}

if (!is_admin($admin)) {
	echo (_ACCESSDENIED);
	CloseTable();
	include_once("footer.php");
	exit();
}

if ($db->sql_numrows($db->sql_query("select * from ".$user_prefix."_users_temp"))==0) {
	echo '<center><strong>'._NOWAITING._SPACE1._RDHOME._SPACE1._TWO._SPACE1._SECONDS.'</strong></center><br />';
	CloseTable();
	header("Refresh: "._TWO."; URL=index.php");
	include_once("footer.php");
	exit();
}

extract($_POST, EXTR_SKIP);
if (!isset($rsid)) $rsid=0;
$rsid = intval($rsid); 
if (isset($submit) && htmlentities($submit) == _LBLBTNRESEND) {
	for ($x=0; $x < 6; $x++) {
		mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr(_CONS, mt_rand(0, strlen(_CONS)-1), 1);
		$voc[$x] = substr(_VOWELS, mt_rand(0, strlen(_VOWELS)-1), 1);
	}
	$makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
	$result = $db->sql_query("select * from ".$user_prefix."_users_temp where user_id=".$rsid);
	if(!$result) {
		echo _ERROR."<br>";
		CloseTable();
		include_once("footer.php");
		exit();
	}
	list($user_id, $username, $name, $user_email, $user_password, $user_regdate, $check_num, $time) = $db->sql_fetchrow($result);
	$finishlink = "$nukeurl/modules.php?name=Your_Account&amp;op=activate&amp;username=$username&amp;check_num=$check_num";
	$message = ""._WELCOMETO." $sitename!\n\n"._YOUUSEDEMAIL." ($user_email) "._TOREGISTER." $sitename.\n\n "._TOFINISHUSER."\n\n $finishlink\n\n "._FOLLOWINGMEM."\n\n"._UNICKNAME." $username\n"._UPASSWORD." $makepass";
	$subject = ""._ACTIVATIONSUB."";
	$from = "$adminmail";
    $rc_email = mail($user_email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
    if (FALSE!==$rc_email) {
		echo _ACTMSGSENTLEFT._SPACE1.$username._SPACE1._ACTMSGSENTRIGHT;
		$result = $db->sql_query("update ".$user_prefix."_users_temp set user_password='".md5($makepass)."' where user_id=".$rsid);
		echo "<form method=\"post\" action=\"modules.php?name=".$module_name."\"><input type=\"submit\" value=\""._LBLBTNBACK."\"></form>";
	}
    else echo _SENDMAILERROR;
}
elseif (isset($delete) && htmlentities($delete) == _LBLBTNDELETE) {
	$result = $db->sql_query("delete from ".$user_prefix."_users_temp where user_id=".$rsid);
	if(!$result) {
		echo _ERROR."<br>";
		CloseTable();
		include_once("footer.php");
		exit();
	}
	echo '<center><strong>'._TEMPRECDELRD._SPACE1._TWO._SPACE1._SECONDS.'</strong></center><br />';
	CloseTable();
	header("Refresh: "._TWO."; URL=modules.php?name=".$module_name);
	include_once("footer.php");
	exit();
}
elseif (isset($update) && htmlentities($update) == _LBLBTNUPDATE) {
	$result = $db->sql_query("update ".$user_prefix."_users_temp set username='".$username."', user_email='".$user_email."', user_regdate='".$user_regdate."', check_num='".$check_num."', time='".$time."' where user_id=".$rsid);
	if(!$result) {
		echo _ERROR."<br>";
		CloseTable();
		include_once("footer.php");
		exit();
	}
	echo '<center><strong>'._TEMPRECMODRD._SPACE1._TWO._SPACE1._SECONDS.'</strong></center><br />';
	CloseTable();
	header("Refresh: "._TWO."; URL=modules.php?name=".$module_name);
	include_once("footer.php");
	exit();
}
elseif (isset($modify) && htmlentities($modify) == _LBLBTNMODIFY) {
	$result = $db->sql_query("select * from ".$user_prefix."_users_temp where user_id=".$rsid);
	if(!$result) {
		echo _ERROR."<br>";
		CloseTable();
		include_once("footer.php");
		exit();
	}
	list($user_id, $username, $name, $user_email, $user_password, $user_regdate, $check_num, $time) = $db->sql_fetchrow($result);
	echo "<form method=\"post\" action=\"modules.php?name=$module_name&amp;file=index&amp;action=modify&amp;rsid=$user_id\" name=\"modifyform$rsid\">";
	echo '<table width="50%">';
	echo '<tr><td align="right">'._LBLUSERID.'</td><td>'.$user_id.'</td></tr>';
	echo '<tr><td align="right">'._LBLUSERNAME.'</td><td><input name="username" value="'.$username.'"></td></tr>';
	echo '<tr><td align="right">'._LBLUSEREMAIL.'</td><td><input name="user_email" value="'.$user_email.'"></td></tr>';
	echo '<tr><td align="right">'._LBLUSERPASSWORD.'</td><td>'.$user_password.'</td></tr>';
	echo '<tr><td align="right">'._LBLUSERREGDATE.'</td><td><input name="user_regdate" value="'.$user_regdate.'"></td></tr>';
	echo '<tr><td align="right">'._LBLUSERCHECKNUM.'</td><td><input name="check_num" value="'.$check_num.'"></td></tr>';
	echo '<tr><td align="right">'._LBLUSERTIME.'</td><td><input name="time" value="'.$time.'"></td></tr>';
	echo '<tr><td colspan="2"><input type="submit" name="update" value="'._LBLBTNUPDATE.'"></td></tr>';
	echo '</table></form>';

}
else {
	$result = $db->sql_query("select * from ".$user_prefix."_users_temp");
	if(!$result) {
		echo _ERROR."<br>";
		CloseTable();
		include_once("footer.php");
		exit();
	}

	while (list($user_id, $username, $name, $user_email, $user_password, $user_regdate, $check_num, $time, $requestor) = $db->sql_fetchrow($result)) {
		$req = explode(":",$requestor);
  $rsid = intval($user_id);
		$requestor = "<a href=\"http://dnsstuff.com/tools/whois.ch?ip=".$req[0]."\" title=\"".$req[0]."\" target=\"_new_\">$requestor</a>";
		$finishlink = "<a href=\"$nukeurl/modules.php?name=Your_Account&amp;op=activate&amp;username=$username&amp;check_num=$check_num\" target=\"_blank\">$nukeurl/modules.php?name=Your_Account&amp;op=activate&amp;username=$username&amp;check_num=$check_num</a>";
		echo "<form method=\"post\" action=\"modules.php?name=$module_name&amp;file=index&amp;action=resend&amp;rsid=$user_id\" name=\"resendform$rsid\">";
		echo "<table width=\"100%\">
		<tr>		<td>"._LBLUSERNAME."</td><td>".$username."</td></tr>
		<tr><td>"._LBLUSEREMAIL."</td><td>".$user_email."</td></tr>
		<tr><td>"._LBLUSERREGDATE."</td><td>".date("F d, Y h:i:s A",$time)."</td></tr>
		<tr><td>"._REQUESTOR."</td><td>".$requestor."</td></tr>
		<tr><td>"._ACTLINK."</td><td>".$finishlink."</td></tr>
		<tr><td colspan=\"3\"><input type=\"submit\" name=\"submit\" value=\""._LBLBTNRESEND."\">&nbsp;&nbsp;<input type=\"submit\" name=\"modify\" value=\""._LBLBTNMODIFY."\">&nbsp;&nbsp;<input type=\"submit\" name=\"delete\" value=\""._LBLBTNDELETE."\"></td></tr></table>";
		echo "</form>";
	}
}
CloseTable();
include_once("footer.php");
?>