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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._CONTACTUS."";
$index = 1;


function ns_info() {
global $db, $module_name, $sitename, $prefix;
$result = $db->sql_query("select address from ".$prefix."_ns_contact_add");
list($address) = $db->sql_fetchrow($result);
$address = FixQuotes(nl2br($address));
echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" align=\"center\">";
echo "<tr><td align=\"left\">";
echo "$address";
echo "</td></tr></table><br />";
}


function ns_phone() {
global $db, $module_name, $sitename, $prefix;
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" align=\"center\">";
echo "<td align=\"left\"><strong>"._NSPHONENAME."</strong></td>";
echo "<td align=\"left\"><strong>"._NSPHONENUM."</strong></td>";
echo "<td align=\"left\"><strong>"._NSFAXNUM."</strong></td>";
$result = $db->sql_query("select pid, phone_name, phone_num, fax_num from ".$prefix."_ns_contact_phone order by phone_name");
    while(list($pid, $phone_name, $phone_num, $fax_num) = $db->sql_fetchrow($result)) {
$pid        = intval($pid);
$phone_name = stripslashes($phone_name);
$phone_num  = stripslashes($phone_num);
$fax_num    = stripslashes($fax_num);
echo "<tr><td align=\"left\">";
echo "<font class=\"content\">$phone_name</td>";
echo "<td align=\"left\">$phone_num</td>";
echo "<td align=\"left\">$fax_num</td></tr>";
    }
echo "</table><br /><br />";
}


function ns_form() {
global $db, $module_name, $sitename, $prefix,$cookie,$user_prefix;
include_once("header.php");
title("$sitename: "._CONTACTUS."");
OpenTable();
$result_s = $db->sql_query("select show_add from ".$prefix."_ns_contact_show");
list($show_add) = $db->sql_fetchrow($result_s);
$show_add = intval($show_add);
if ($show_add == 1) {
echo "<br /><br /><center><font class=\"title\"><u>"._ADDRESSINFO."</u></font></center><br />";
ns_info();
echo "<hr>";
}
$result_p = $db->sql_query("SELECT * FROM ".$prefix."_ns_contact_phone");
$num = $db->sql_numrows($result_p);
$num = intval($num);
if ($num > 0) {
echo "<br /><br /><center><font class=\"title\"><u>"._PHONEINFO."</u></font></center><br />";
ns_phone();
echo "<hr>";
}
echo "<br /><center><font class=\"title\">"._FORMHEADER." $sitename</font></center><br /><br />";
if (is_user($user)) {
	$result_ui = $db->sql_query("select name, uname, email from ".$user_prefix."_users where uname='$cookie[1]'");
	if(!$result_ui){
		$result_ui=$db->sql_query("select name,username,user_email from ".$user_prefix."_users where username='$cookie[1]'");
	}
	list($yn,$yun,$ye) = $db->sql_fetchrow($result_ui);
}
if ($yn != "") { $ns_un = $yn; } else { $ns_un = $yun; }
echo "<form action=\"modules.php?name=$module_name\" method=\"post\"";
echo "name=\"contact_plus\">";
echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\">";
echo "<tr><td align=\"left\" valign=\"middle\"><font class=\"content\"><strong>"._YOURNAME.":</strong></font> ";
echo "<font class=\"tiny\">("._OPTIONAL.")</font><br />";
echo "<input name=\"cname\" size=\"35\" value=\"$ns_un\"></td></tr>";
echo "<tr><td align=\"left\" valign=\"middle\">";
echo "<font class=\"content\"><strong>"._YOUREMAIL.":</strong></font><br />";
echo "<input name=\"from\" size=\"35\" value=\"$ye\"></td></tr>";
echo "<tr><td align=\"left\" valign=\"middle\">";
echo "<font class=\"content\"><strong>"._PLEASESELECT.":</strong></font><br />";
echo "<select name=\"dpid\">";
echo "<option value=\"\" selected>---------------------------------";
echo "<option value=\"\">";
    $result = $db->sql_query("select did, dept_name, dept_email from ".$prefix."_ns_contact_dept order by dept_name");
    while (list($did, $dept_name, $dept_email) = $db->sql_fetchrow($result)) {
                $did        = intval($did);
                $dept_name  = stripslashes($dept_name);
                $dept_email = stripslashes($dept_email);
		echo "<option value=\"$did\">$dept_name";
    }
echo "<option value=\"\">";
echo "</select></td></tr>";
echo "<tr><td align=\"left\" valign=\"middle\">";
echo "<font class=\"content\"><strong>"._YOURMESSAGE.":</strong></font><br />";
echo "<textarea cols=\"55\" name=\"message\" rows=\"12\" ></textarea></td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\" valign=\"middle\">";
echo "<input type=\"hidden\" name=\"op\" value=\"ns_send\">";
echo "<input type=\"submit\" name=\"submit\" value=\""._SEND."\">";
echo "&nbsp;&nbsp;<input type=\"reset\" value=\""._CLEAR."\">";
echo "</td></tr></table></form>";
echo "<br />";
Closetable();
include_once("footer.php");
}


function ns_send($dpid, $cname, $from, $email, $message) {
global $db, $module_name, $sitename, $prefix;
include_once("header.php");
title("$sitename: "._CONTACTUS."");
$from = strtolower($from);
if(preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/",$from)) {
} else {
OpenTable();
echo"<br /><center><font class=\"title\">"._INVALIDEMAIL.":<br /><br />"; 
echo"<font color=\"#CC0000\">$from</font><br /><br />"._INVALIDEMAIL2."</font>";

echo"<br /><br /><br /><font class=\"title\">"._PLEASEGO."</font>";
echo"<br /><br />";
echo"[ <a href=\"javascript:history.go(-1)\">"._BACK."</a> ]</center><br />";
CloseTable();
include_once("footer.php");
exit;
}
if ($dpid == "") {
OpenTable();
echo"<br /><center><font class=\"title\">"._SELECTDEPARTMENT."<br /><br />"; 
echo""._PLEASEGO3."</font>";
echo"<br /><br />";
echo"[ <a href=\"javascript:history.go(-1)\">"._BACK."</a> ]</center><br />";
CloseTable();
include_once("footer.php");
exit;
}
if ($message == "") {
OpenTable();
echo"<br /><center><font class=\"title\">"._NOMESSAGE."<br /><br />"; 
echo""._PLEASEGO2."</font>";
echo"<br /><br />";
echo"[ <a href=\"javascript:history.go(-1)\">"._BACK."</a> ]</center><br />";
CloseTable();
include_once("footer.php");
exit;
}
$result = $db->sql_query("select dept_name, dept_email from ".$prefix."_ns_contact_dept where did='$dpid'");
list($department, $dept_email)=$db->sql_fetchrow($result);
$department = stripslashes(trim($department));
$subject = $department;
$from = strip_tags(trim($from));
$message = stripslashes(trim($message));
$header  = ""._FROM.": "._CONTACTFORM." - $cname <$from>\r\n";
$header .= "\n";
$header .= ""._VISITOR.": $cname <$from>\r\n\n";
$header .= ""._TODEPARTMENT.": $department\r\n\n";
$header .= ""._MESSAGE.":\r\n";
$header .= "\n==============================================================";
@$send=mail($dept_email,$subject,$message,$header);
if ($send == 1) {
OpenTable();
echo "<br />";
echo "<br /><div align=\"center\"><font class=\"title\">"._THANKYOUFOR." $sitename</font>";
echo "<br /><br />"._EMAILSENT."<br />"._GETBACK."</div><br /><br />";
echo "<center>[ <a href=\"index.php\">"._HOME."</a> ] - ";
echo "[ <a href=\"modules.php?name=$module_name\">"._CONTACTFORM."</a> ]</center><br />";
echo "<br />";
CloseTable();
include_once("footer.php");
} else {
OpenTable();
echo"<center><font class=\"title\">"._ERROR2."</font>";
echo"<br />"._TRYAGAIN."<br />";
echo"[ <a href=\"modules.php?name=Contact\">"._BACK."</a> ]</center>";
CloseTable();
include_once("footer.php");
}
exit();
include_once("footer.php");
}

switch ($op) {

    case "ns_send":
    ns_send($dpid, $cname, $from, $email, $message);
    break;

    default:
    ns_form();
    break;

}

?>