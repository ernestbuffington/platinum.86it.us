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
if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}
$module_name = basename(dirname(__FILE__));
global $prefix, $db, $admin_file;
require_once("modules/Your_Account/includes/constants.php");
if (!defined('CNBYA')) { echo "CNBYA protection"; exit; }
define('YA_ADMIN', true);
require_once("mainfile.php"); 
include_once("modules/$module_name/includes/functions.php");
get_lang($module_name); 

if(is_admin($admin)) {
    if(!is_array($admin)) { 
        $adm = base64_decode($admin); 
        $adm = explode(":", $adm); 
        $aname = "$adm[0]"; 
    } else { 
        $aname = "$admin[0]"; 
    } 
	list($radminsuper) = $db->sql_fetchrow($db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aname'")); 
	$radminuser = 0; 
	if ($Version_Num >= 7.5)  {
		$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Your_Account'")); 
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aname'")); 
		$admins = explode(",", $row['admins']); 
		for ($i=0; $i < sizeof($admins); $i++) { 
			if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") { 
				$radminuser = 1; 
			} 
		} 
	} else {
		list($radminuser) = $db->sql_fetchrow($db->sql_query("select radminuser from ".$prefix."_authors where aid='$aname'")); 
	}
} 


if ($radminsuper == 1 || $radminuser == 1) { 

// removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

switch($op) {

    default:
        $pagetitle = ": "._USERADMIN;
        include_once("header.php");
        title(_USERADMIN);
        amain();
        include_once("footer.php");
    break;

    case "addUser":
        include_once("modules/$module_name/admin/adduser.php");
    break;

    case "addUserConf":
        include_once("modules/$module_name/admin/adduserconf.php");
    break;

    case "approveUser":
        include_once("modules/$module_name/admin/approveuser.php");
    break;

    case "approveUserConf":
        include_once("modules/$module_name/admin/approveuserconf.php");
    break;

    case "activateUser":
        include_once("modules/$module_name/admin/activateuser.php");
    break;

    case "activateUserConf":
        include_once("modules/$module_name/admin/activateuserconf.php");
    break;

    case "autoSuspend":
        include_once("modules/$module_name/admin/autosuspend.php");
    break;

    case "credits":
        include_once("modules/$module_name/admin/credits.php");
    break;

    case "CookieConfig":
        include_once("modules/$module_name/admin/menucookies.php");
    break;
	
    case "CookieConfigSave":
        include_once("modules/$module_name/admin/menucookiessave.php");
    break;
	
    case "deleteUser":
        include_once("modules/$module_name/admin/deleteuser.php");
    break;

    case "deleteUserConf":
        include_once("modules/$module_name/admin/deleteuserconf.php");
    break;

    case "denyUser":
        include_once("modules/$module_name/admin/denyuser.php");
    break;

    case "denyUserConf":
        include_once("modules/$module_name/admin/denyuserconf.php");
    break;

    case "detailsTemp":
        include_once("modules/$module_name/admin/detailstemp.php");
    break;

    case "detailsUser":
        include_once("modules/$module_name/admin/detailsuser.php");
    break;

    case "findTemp":
        include_once("modules/$module_name/admin/findtemp.php");
    break;

    case "findUser":
        include_once("modules/$module_name/admin/finduser.php");
    break;

    case "listnormal":
        include_once("modules/$module_name/admin/listnormal.php");
    break;

    case "listpending":
        include_once("modules/$module_name/admin/listpending.php");
    break;

    case "listresults":
        include_once("modules/$module_name/admin/listresults.php");
    break;

    case "modifyTemp":
        include_once("modules/$module_name/admin/modifytemp.php");
    break;

    case "modifyTempConf":
        include_once("modules/$module_name/admin/modifytempconf.php");
    break;

    case "modifyUser":
        include_once("modules/$module_name/admin/modifyuser.php");
    break;

    case "modifyUserConf":
        include_once("modules/$module_name/admin/modifyuserconf.php");
    break;

    case "promoteUser":
        include_once("modules/$module_name/admin/promoteuser.php");
    break;

    case "promoteUserConf":
        include_once("modules/$module_name/admin/promoteuserconf.php");
    break;

    case "removeUser":
        include_once("modules/$module_name/admin/removeuser.php");
    break;

    case "removeUserConf":
        include_once("modules/$module_name/admin/removeuserconf.php");
    break;

    case "resendMail":
        include_once("modules/$module_name/admin/resendmail.php");
    break;

    case "resendMailConf":
        include_once("modules/$module_name/admin/resendmailconf.php");
    break;

    case "restoreUser":
        include_once("modules/$module_name/admin/restoreuser.php");
    break;

    case "restoreUserConf":
        include_once("modules/$module_name/admin/restoreuserconf.php");
    break;

    case "searchUser":
        include_once("modules/$module_name/admin/searchuser.php");
    break;

    case "suspendUser":
        include_once("modules/$module_name/admin/suspenduser.php");
    break;

    case "suspendUserConf":
        include_once("modules/$module_name/admin/suspenduserconf.php");
    break;

    case "UsersConfig":
        include_once("modules/$module_name/admin/userconfig.php");
    break;

    case "UsersConfigSave":
        include_once("modules/$module_name/admin/userconfigsave.php");
    break;
    
    case "addField":
        include_once("modules/$module_name/admin/addfield.php");
    break;
    
    case "saveaddField":
        include_once("modules/$module_name/admin/saveaddfield.php");
    break;
    
    case "delField":
        include_once("modules/$module_name/admin/delfield.php");
    break;
	
    case "delFieldConf":
        include_once("modules/$module_name/admin/delfieldconf.php");
    break;
	case "tosMain": /* Edit TOS Starts*/
	include_once("modules/$module_name/admin/tosmain.php");
	break;

	case "tosEdit":
	include_once("modules/$module_name/admin/tosedit.php");
	break;
	
	case "tosNew":
	include_once("modules/$module_name/admin/tosnew.php");
	break;
	
	case "tosPreview":
	include_once("modules/$module_name/admin/tospreview.php");
	break; /*Edit TOS Ends*/    
}

} else {
    echo "Access Denied";
}

?>