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
if (!defined('YA_ADMIN')) {
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {
    echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>';
    asearch();
    if (!empty($query)) {
      echo '<br />';
      $query = str_replace("\"",'',$query);
      $query = str_replace("\'",'',$query);
      if ($find == 'findUser') { $usertable = $user_prefix."_users"; } else { $usertable = $user_prefix."_users_temp"; }
      if ($match == 'equal') { $sign = "='$query'"; } else { $sign = "LIKE '%".$query."%'"; }
      if (!isset($min)) $min=0;
      $min = intval($min);
      if (!isset($max)) $max=$min+$ya_config['perpage'];
      $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM $usertable WHERE $what $sign"));
      if ($totalselected == 0) {
        die();
      }
      echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
      echo '<tr><td><strong>'._USERID.'</strong></td>';
      echo '<td><strong>'._USERNAME.'</strong></td>';
      echo '<td align="center"><strong>'._UREALNAME.'</strong></td>';
      echo '<td align="center"><strong>'._EMAIL.'</strong></td>';
      echo '<td align="center"><strong>'._REGDATE.'</strong></td>';
      echo '<td align="center"><strong>'._FUNCTIONS.'</strong></td></tr>';
      $sql = 'SELECT * FROM '.$usertable.' WHERE '.$what.' '.$sign.' ORDER BY username LIMIT '.$min.','.$ya_config['perpage'];
      $result = $db->sql_query($sql);
      while($chnginfo = $db->sql_fetchrow($result)) {
        echo '<tr>';
        echo '<td>'.$chnginfo['user_id'].'</td>';
        echo '<td>'.$chnginfo['username'].'</td>';
        echo '<td align="center">'.$chnginfo['name'].'</td>';
        echo '<td align="center">'.$chnginfo['user_email'].'</td>';
        echo '<td align="center">'.$chnginfo['user_regdate'].'</td>';
        echo '<td align="center">';
        echo '<form action="'.$admin_file.'.php" method="post"><input type="hidden" name="query" value="'.$query.'">';
        echo '<input type="hidden" name="find" value="'.$find.'">';
        echo '<input type="hidden" name="what" value="'.$what.'">';
        echo '<input type="hidden" name="match" value="'.$match.'">';
        echo '<input type="hidden" name="min" value="'.$min.'">';
        echo '<input type="hidden" name="xop" value="'.$op.'">';
        echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'">';
        echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'">';
        echo '<select name="op">';
        if ($find == 'tempUser') {
            echo '<option value="yaDetailTemp">'._DETUSER.'</option>';
            echo '<option value="yaModifyTemp">'._MODIFY.'</option>';
            echo '<option value="yaResendMail">'._RESEND.'</option>';
            echo '<option value="approveUser">'._YA_APPROVE.'</option>';
            echo '<option value="yaActivateUser">'._YA_ACTIVATE.'</option>';
            echo '<option value="yaDenyUser">'._DENY.'</option>';
        } else {
            echo '<option value="yaDetailsUser">'._DETUSER.'</option>';
            echo '<option value="modifyUser">'._MODIFY.'</option>';
            // suspended
            if ($chnginfo['user_level'] == 0) { echo '<option value="yaRestoreUser">'._RESTORE.'</option>'; }
            // deactivated
            if ($chnginfo['user_level'] == -1) { echo '<option value="yaRemoveUser">'._REMOVE.'</option>'; }
            // active
#            if ($chnginfo['user_level'] > 0 AND $radminsuper == 1) { echo '<option value="yaPromoteUser">'._PROMOTE.'</option>'; }
            if ($chnginfo['user_level'] == 1) { echo '<option value="yaSuspendUser">'._SUSPEND.'</option>'; }
            if ($chnginfo['user_level'] > -1) { echo '<option value="yaDeleteUser">'._YA_DEACTIVATE.'</option>'; }
        }
        echo '</select><input type="submit" value="'._OK.'"></form></td>';
        echo '</tr>';
      }
      echo '</table>';
      echo '<br />';
      yapagenums($op, $totalselected, $ya_config['perpage'], $max, $find, $what, $match, $query);
    }
    echo '</td></tr></table>';
}
?>