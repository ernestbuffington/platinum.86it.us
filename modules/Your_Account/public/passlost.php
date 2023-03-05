<?php

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke     		*/
/* ============================================                         		*/
/*                                                                      		*/
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                     		*/
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                		*/
/*                                                                      		*/
/* Contact author: escudero@phpnuke.org.br                              		*/
/* International Support Forum: http://ravenphpscripts.com/forum76.html 		*/
/*                                                                      		*/
/* This program is free software. You can redistribute it and/or modify 		*/
/* it under the terms of the GNU General Public License as published by 		*/
/* the Free Software Foundation; either version 2 of the License.       		*/
/*                                                                      		*/
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion	*/
/*********************************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    header("Location: ../../../index.php");
    die ();
}
if (!defined('CNBYA')) { echo "CNBYA protection"; exit; }

    if (!is_user($user)) {
        include_once("header.php");
// removed by menelaos dot hetnet dot nl
//      title(_USERREGLOGIN);
        Show_CNBYA_menu();

        if ($ya_config['servermail'] ==0) {
            OpenTable();
            echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
            echo "<form action=\"modules.php?name=$module_name\" method=\"post\">\n";
            echo "<td colspan=\"2\"><img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\">";
            echo "<font class=\"content\"><strong>"._PASSWORDLOST."</strong> "._NOPROBLEM."</td></tr><tr><td width=\"100%\">";

            echo "<table border=\"0\">\n";
            echo "<tr><td align='right'>"._NICKNAME.":</td><td><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\"></td></tr>\n";
            echo "<tr><td colspan='2' align='center'><strong>--"._OR."--</strong></td></tr>\n";
            echo "<tr><td align='right'>"._EMAIL.":</td><td><input type=\"text\" name=\"user_email\" size=\"15\" maxlength=\"50\"></td></tr>\n";
            echo "<tr><td>"._CONFIRMATIONCODE.":</td><td><input type=\"text\" name=\"code\" size=\"11\" maxlength=\"10\"></td></tr></table><br>\n";

            echo "</td><td valign=\"top\">";

            echo "<input type=\"hidden\" name=\"op\" value=\"mailpasswd\">\n";
            echo "<input type=\"submit\" value=\""._SENDPASSWORD."\"><br>\n";
// removed by menelaos dot hetnet dot nl
//          echo "<center><font class=\"content\">[ <a href=\"modules.php?name=$module_name\">"._USERLOGIN."</a> | <a href=\"modules.php?name=$module_name&op=new_user\">"._REGNEWUSER."</a> ]</font></center>\n";

            echo "</td></form></tr></table>";
            CloseTable();
        } else {
            title(_SERVERNOMAIL);
        }
        include_once("footer.php");
    } elseif(is_user($user)) {
        global $cookie;
        cookiedecode($user);
        Header("Location: modules.php?name=$module_name&op=userinfo&username=$cookie[1]");
    }

?>