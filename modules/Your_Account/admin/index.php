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
if (!defined('ADMIN_FILE'))
{
  header('Location: ../../../index.php');
  die ();
}
global $prefix, $db, $admin_file; 
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT title, admins FROM ' . $prefix . '_modules WHERE title=\''.$module_name.'\''));
$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
$admins = explode(',', $row['admins']);
$auth_user = 0;
for ($i = 0;$i < sizeof($admins);$i++) {
	if ($row2['name'] == $admins[$i] AND !empty($row['admins'])) {
		$auth_user = 1;
	}
}
$radminsuper = $row2['radminsuper'];
$radminuser = $auth_user;
if ($radminsuper == 1 || $radminuser == 1) { 
  require_once('modules/Your_Account/includes/constants.php');
  define('YA_ADMIN', true);
  if(!isset($op)) $op = '';
  include_once('modules/'.$module_name.'/includes/functions.php'); 
  if (!isset($ya_config)) $ya_config = ya_get_configs();
  get_lang($module_name);
  switch($op) { 
    default:
      $pagetitle = ': '._USERADMIN;
      include_once('header.php');
      title(_USERADMIN);
      amain();
      include_once('footer.php');
      break;
    case 'yaCredits':
      include_once('modules/'.$module_name.'/admin/credits.php');
      break;
    case 'yaCustomFields':
      include_once('modules/'.$module_name.'/admin/addfield.php');
      break;    
    case 'yaSaveFields':
      include_once('modules/'.$module_name.'/admin/saveaddfield.php');
      break;
    case 'yaDelField':
      include_once('modules/'.$module_name.'/admin/delfield.php');
      break;
    case 'yaDelFieldConf':
      include_once('modules/'.$module_name.'/admin/delfieldconf.php');
      break;
    case 'yaUsersConfig':
      include_once('modules/'.$module_name.'/admin/userconfig.php');
      break;
    case 'yaUsersConfigSave':
      include_once('modules/'.$module_name.'/admin/userconfigsave.php');
      break;
    case 'yaUsers':
    case 'yaListPending':
      include_once('modules/'.$module_name.'/admin/users.php');
      break;
    case 'yaAddUser':
      include_once('modules/'.$module_name.'/admin/adduser.php');
      break;
    case 'yaAddUserConf':
      include_once('modules/'.$module_name.'/admin/adduserconf.php');
      break;
    case 'yaSearchUser':
      include_once('modules/'.$module_name.'/admin/searchuser.php');
      break;
    case 'yaListUsers':
      include_once('modules/'.$module_name.'/admin/listusers.php');
      break;

    case 'approveUser':
      include_once('modules/'.$module_name.'/admin/approveuser.php');
      break;
    case 'yaApproveUserConf':
      include_once('modules/'.$module_name.'/admin/approveuserconf.php');
      break;
    case 'yaActivateUser':
      include_once('modules/'.$module_name.'/admin/activateuser.php');
      break;
    case 'yaActivateUserConf':
      include_once('modules/'.$module_name.'/admin/activateuserconf.php');
      break;
#    case 'yaAutoSuspend':
#      include_once('modules/'.$module_name.'/admin/autosuspend.php');
#      break;
#    case 'CookieConfig':
#      include_once('modules/'.$module_name.'/admin/menucookies.php');
#      break;
#    case 'CookieConfigSave':
#      include_once('modules/'.$module_name.'/admin/menucookiessave.php');
#      break;
    case 'yaDeleteUser':
      include_once('modules/'.$module_name.'/admin/deleteuser.php');
      break;
    case 'yaDeleteUserConf':
      include_once('modules/'.$module_name.'/admin/deleteuserconf.php');
      break;
    case 'yaDenyUser':
      include_once('modules/'.$module_name.'/admin/denyuser.php');
      break;
    case 'yaDenyUserConf':
      include_once('modules/'.$module_name.'/admin/denyuserconf.php');
      break;
    case 'yaDetailTemp':
      include_once('modules/'.$module_name.'/admin/detailstemp.php');
      break;
    case 'yaDetailsUser':
      include_once('modules/'.$module_name.'/admin/detailsuser.php');
      break;
    case 'yaModifyTemp':
      include_once('modules/'.$module_name.'/admin/modifytemp.php');
      break;
    case 'yaModifyTempConf':
      include_once('modules/'.$module_name.'/admin/modifytempconf.php');
      break;
    case 'modifyUser':
      include_once('modules/'.$module_name.'/admin/modifyuser.php');
      break;
    case 'yaModifyUserConf':
      include_once('modules/'.$module_name.'/admin/modifyuserconf.php');
      break;
    case 'yaPromoteUser':
      include_once('modules/'.$module_name.'/admin/promoteuser.php');
      break;
    case 'yaPromoteUserConf':
      include_once('modules/'.$module_name.'/admin/promoteuserconf.php');
      break;
    case 'yaRemoveUser':
      include_once('modules/'.$module_name.'/admin/removeuser.php');
      break;
    case 'yaRemoveUserConf':
      include_once('modules/'.$module_name.'/admin/removeuserconf.php');
      break;
    case 'yaResendMail':
      include_once('modules/'.$module_name.'/admin/resendmail.php');
      break;
    case 'yaResendMailConf':
      include_once('modules/'.$module_name.'/admin/resendmailconf.php');
      break;
    case 'yaRestoreUser':
      include_once('modules/'.$module_name.'/admin/restoreuser.php');
      break;
    case 'yaRestoreUserConf':
      include_once('modules/'.$module_name.'/admin/restoreuserconf.php');
      break;
    case 'yaSuspendUser':
      include_once('modules/'.$module_name.'/admin/suspenduser.php');
      break;
    case 'yaSuspendUserConf':
      include_once('modules/'.$module_name.'/admin/suspenduserconf.php');
      break;
  }
} 
else 
{ 
  echo 'Access Denied'; 
} 
?>