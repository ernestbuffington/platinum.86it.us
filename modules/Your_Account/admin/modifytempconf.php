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

    $stop = '';
    if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
    if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
    if ($stop == '') {
        $time = time();
//      $db->sql_query("UPDATE ".$user_prefix."_users_temp SET username='$chng_uname', name='$chng_realname',  user_email='$chng_email', user_regdate='$chng_regdate', time='$time' WHERE user_id='$chng_uid'");
        $db->sql_query("UPDATE ".$user_prefix."_users_temp SET username='$chng_uname', name='$chng_realname',  user_email='$chng_email' WHERE user_id='$chng_uid'");

      if (isset($nfield) && count($nfield) > 0) {
        foreach ($nfield as $key => $var) { 
        $nfield[$key] = ya_fixtext($nfield[$key]);
 	      if (($db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users_temp_field_values WHERE fid='$key' AND uid = '$chng_uid'"))) == 0) 
        {
	   	    $sql = "INSERT INTO ".$user_prefix."_users_temp_field_values (uid, fid, value) VALUES ('$chng_uid', '$key','$nfield[$key]')";
  		    $db->sql_query($sql);
	      }
	      else {
    	    $db->sql_query("UPDATE ".$user_prefix."_users_temp_field_values SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$chng_uid'");
		    } 
		    }
      }

        $pagetitle = ": "._USERADMIN." - "._ACCTMODIFY;
        include_once("header.php");
        amain();
        echo '<br />';
        OpenTable();
        echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
#        if (isset($query)) { echo "<input type='hidden' name='query' value='$query' />\n"; }
#        if (isset($min))   { echo "<input type='hidden' name='min' value='$min' />\n"; }
#        if (isset($xop))   { echo "<input type='hidden' name='op' value='$xop' />\n"; }
        echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<tr><td align='center'><strong>"._ACCTMODIFY."</strong></td></tr>\n";
        echo "<tr><td align='center'><input type='submit' value='"._RETURN2."' /></td></tr>\n";
        echo "</table></center>\n";
        echo '</form>';
        CloseTable();
        include_once('footer.php');
    } else {
        $pagetitle = ": "._USERADMIN;
        include_once("header.php");
        title(_USERADMIN);
        amain();
        echo '<br />';
        OpenTable();
        echo "<strong>$stop</strong>\n";
        CloseTable();
        include_once('footer.php');
        return;
    }

}

?>