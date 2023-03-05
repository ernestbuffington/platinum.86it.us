<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN'))
{
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {

    list($email) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_id='$del_uid'"));
    if ($ya_config['servermail'] == 1) {
        $message = _SORRYTO." $sitename "._HASDELETE;
        if ($deletereason > "") {
            $deletereason = stripslashes($deletereason);
            $message .= "\r\n\r\n"._DELETEREASON."\r\n$deletereason";
        }
/*        $subject = _ACCTDELETE;
        ya_mail($email, $subject, $message, ''); */
    }
/******[START]******** Remove user from nuke_bbuser_group - sgtmudd **********/
 	 $db->sql_query("DELETE FROM nuke_bbuser_group WHERE user_id='$del_uid'");
	 $db->sql_query("DELETE FROM nuke_bbgroups WHERE user_id='$del_uid'");
     $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_bbuser_group");
     $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_bbgroups");
/******[END]********** Remove user from nuke_bbuser_group - sgtmudd **********/
    $db->sql_query("UPDATE ".$user_prefix."_users SET name='"._MEMDEL."', user_password='', user_website='', user_sig='', user_level='-1', user_active='0', user_allow_pm='0', points='0' WHERE user_id='$del_uid'");
    $pagetitle = ": "._USERADMIN." - "._ACCTDELETE;
    include_once("header.php");
    amain();
    echo '<br />';
    OpenTable();
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query' />\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
    echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'><strong>"._ACCTDELETE."</strong></td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
    echo "</table></center>\n";
    echo '</form>';
    CloseTable();
    include_once('footer.php');

}

?>