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
if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}
if (!defined('RNYA')) {
	header('Location: ../../../../index.php');
	die();
}

// Group Memberships

// menelaos: changed these routines to fist check if the database table exist
$checktable = $db->sql_fetchrow($db->sql_query("SHOW TABLES LIKE '".$prefix."_nsngr_users'"));
if ($checktable == 1) {
    $result11 = $db->sql_query("SELECT gid FROM ".$prefix."_nsngr_users WHERE uid='$usrinfo[user_id]' ORDER BY gid");
    if (($db->sql_numrows($result11) > 0)) {
        echo "<br />";
        OpenTable();
        echo "<strong>$usrinfo[username]'s "._MEMBERGROUPS.":</strong><br />\n";
        while(list($gid) = $db->sql_fetchrow($result11)) {
            list($gname) = $db->sql_fetchrow($db->sql_query("SELECT gname FROM ".$prefix."_nsngr_groups WHERE gid='$gid'"));
            echo "<li>$gname";
            if (is_admin($admin)) { echo " ($gid)"; }
            list($edate) = $db->sql_fetchrow($db->sql_query("SELECT edate FROM ".$prefix."_nsngr_users WHERE uid='$usrinfo[user_id]' AND gid='$gid'"));
            if ($edate != "") {
                if ($edate != "0000-00-00") {
                    echo "&nbsp;&nbsp;- <i>"._EXPIRES." $edate</i>";
                } else {
                    echo "&nbsp;&nbsp;- <i>"._NOTSET."</i>";
                }
            }
            echo "<br />\n";
        }
        CloseTable();
    }
}

?>