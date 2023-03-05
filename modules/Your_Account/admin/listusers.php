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
    if ($query == 'w') {
      $titledef = _WAITINGUSERS;
      $usertable = '_users_temp';
      $namefield = 'name';
      $where ='';
    } else {
      $titledef = _YA_USERS;
      $usertable = '_users';
      $namefield = 'name';
      if ($query == '') 	{ $where = "WHERE user_id > '1'"; }
      if ($query == "a")	{ $where = "WHERE user_id > '1'"; }
      if ($query == "-1")	{ $where = "WHERE user_level = '-1' AND user_id > '1'"; }
      if ($query == "0")	{ $where = "WHERE user_level = '0' AND user_id > '1'"; }
      if ($query == "1")	{ $where = "WHERE user_level > '0' AND user_id > '1'"; }
    }

    if (!isset($min)) $min=0;
    $min = intval($min);
    if (!isset($max)) $max=$min+$ya_config['perpage'];
    $totalselected = $db->sql_numrows($db->sql_query('SELECT * FROM '.$user_prefix.$usertable.' '.$where));
    if ($totalselected == 0) {
      die();
    }
    echo '<table align="center" cellpadding="2" cellspacing="2" border="0">';
    echo '<tr><td><strong>'._USERNAME.' ('._USERID.')</strong></td>';
    echo '<td align="center"><strong>'._UREALNAME.'</strong></td>';
    echo '<td align="center"><strong>'._EMAIL.'</strong></td>';
    echo '<td align="center"><strong>'._REGDATE.'</strong></td>';
    if ($query <> 'w') echo '<td align="center"><strong>'._YA_LASTVISIT.'</strong></td>';
    echo '<td align="center"><strong>'._FUNCTIONS.'</strong></td></tr>';
    $result = $db->sql_query('SELECT * FROM '.$user_prefix.$usertable.' '.$where.' ORDER BY username LIMIT '.$min.','.$ya_config['perpage']);
    while($chnginfo = $db->sql_fetchrow($result)) {
      echo '<tr>';
      echo '<td>'.$chnginfo['username'].' ('.$chnginfo['user_id'].')</td>';
      echo '<td align="center">'.$chnginfo[$namefield].'</td>';
      echo '<td align="center">'.$chnginfo['user_email'].'</td>';
      echo '<td align="center">'.$chnginfo['user_regdate'].'</td>';
      if ($query <> 'w') {
        if ($chnginfo['lastsitevisit'] == 0) $last = _YA_NONEXPIRE;
        else $last = date("M d, Y g:i a", $chnginfo['lastsitevisit']);
        echo '<td align="center">'.$last.'</td>';
      }
      echo '<td align="center">';
      echo '<form action="'.$admin_file.'.php" method="post">';
      echo '<select name="op">';
      if ($query == 'w') {
        echo '<option value="yaDetailTemp">'._DETUSER.'</option>';
        echo '<option value="yaApproveUserConf">'._YA_APPROVE.'</option>';
        echo '<option value="yaActivateUser">'._YA_ACTIVATE.'</option>';
        echo '<option value="yaModifyTemp">'._MODIFY.'</option>';
        echo '<option value="yaDenyUser">'._DENY.'</option>';
        echo '<option value="yaResendMail">'._RESEND.'</option>';
      } else {
        echo '<option value="yaDetailsUser">'._DETUSER.'</option>';
        echo '<option value="modifyUser">'._MODIFY.'</option>';
        // suspended
        if ($chnginfo['user_level'] == 0) { echo '<option value="yaRestoreUser">'._RESTORE.'</option>'; }
        // deactivated
        if ($chnginfo['user_level'] == -1) { echo '<option value="yaRemoveUser">'._REMOVE.'</option>'; }
        // active
        if ($chnginfo['user_level'] > 0 AND $radminsuper == 1) { echo '<option value="yaPromoteUser">'._PROMOTE.'</option>'; }
        if ($chnginfo['user_level'] == 1) { echo '<option value="yaSuspendUser">'._SUSPEND.'</option>'; }
        if ($chnginfo['user_level'] > -1) { echo '<option value="yaDeleteUser">'._YA_DEACTIVATE.'</option>'; }
      }
      echo '</select><input type="submit" value="'._OK.'" />';
      echo '<input type="hidden" name="min" value="'.$min.'" />';
      echo '<input type="hidden" name="xop" value="'.$op.'" />';
      if ($query == 'w') {
        echo '<input type="hidden" name="apr_uid" value="'.$chnginfo['user_id'].'" />';
        echo '<input type="hidden" name="act_uid" value="'.$chnginfo['user_id'].'" />';
      }
      echo '<input type="hidden" name="chng_uid" value="'.$chnginfo['user_id'].'" />';
      echo '<input type="hidden" name="query" value="'.$query.'" />';
      echo '</form></td></tr>';
    }
    echo '</table>';
    echo '<br />';
    yapagenums($op, $totalselected, $ya_config['perpage'], $max, '', '', '', $query);
}
?>