<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

global $admin_file, $adveditor;
$adveditor = 0;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { die("Illegal Access Detected!!!"); }
if(defined("NSNGROUPS_IS_LOADED")) $grconfig = grget_configs();
else $op = 'NSNGroupsLoadError';
$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='15' cols='75'"; }
$result = $db->sql_query("SELECT `aid`, `email`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'");
list($aname, $amail, $radminsuper) = $db->sql_fetchrow($result);
if($radminsuper==1) {
  switch($op) {
    case "NSNGroups":include_once("admin/modules/nsngroups/NSNGroups.php");break;
    case "NSNGroupsAdd":include_once("admin/modules/nsngroups/NSNGroupsAdd.php");break;
    case "NSNGroupsAddSave":include_once("admin/modules/nsngroups/NSNGroupsAddSave.php");break;
    case "NSNGroupsConfig":include_once("admin/modules/nsngroups/NSNGroupsConfig.php");break;
    case "NSNGroupsConfigSave":include_once("admin/modules/nsngroups/NSNGroupsConfigSave.php");break;
    case "NSNGroupsDelete":include_once("admin/modules/nsngroups/NSNGroupsDelete.php");break;
    case "NSNGroupsDeleteConf":include_once("admin/modules/nsngroups/NSNGroupsDeleteConf.php");break;
    case "NSNGroupsEdit":include_once("admin/modules/nsngroups/NSNGroupsEdit.php");break;
    case "NSNGroupsEditSave":include_once("admin/modules/nsngroups/NSNGroupsEditSave.php");break;
    case "NSNGroupsEmpty":include_once("admin/modules/nsngroups/NSNGroupsEmpty.php");break;
    case "NSNGroupsEmptyConf":include_once("admin/modules/nsngroups/NSNGroupsEmptyConf.php");break;
    case "NSNGroupsLoadError":include_once("admin/modules/nsngroups/NSNGroupsLoadError.php");break;
    case "NSNGroupsUsersAdd":include_once("admin/modules/nsngroups/NSNGroupsUsersAdd.php");break;
    case "NSNGroupsUsersAddSave":include_once("admin/modules/nsngroups/NSNGroupsUsersAddSave.php");break;
    case "NSNGroupsUsersDelete":include_once("admin/modules/nsngroups/NSNGroupsUsersDelete.php");break;
    case "NSNGroupsUsersDeleteConf":include_once("admin/modules/nsngroups/NSNGroupsUsersDeleteConf.php");break;
    case "NSNGroupsUsersDeleteSave":include_once("admin/modules/nsngroups/NSNGroupsUsersDeleteSave.php");break;
    case "NSNGroupsUsersEmail":include_once("admin/modules/nsngroups/NSNGroupsUsersEmail.php");break;
    case "NSNGroupsUsersEmailSend":include_once("admin/modules/nsngroups/NSNGroupsUsersEmailSend.php");break;
    case "NSNGroupsUsersExpire":include_once("admin/modules/nsngroups/NSNGroupsUsersExpire.php");break;
    case "NSNGroupsUsersExpireDone":include_once("admin/modules/nsngroups/NSNGroupsUsersExpireDone.php");break;
    case "NSNGroupsUsersExpireSave":include_once("admin/modules/nsngroups/NSNGroupsUsersExpireSave.php");break;
    case "NSNGroupsUsersMove":include_once("admin/modules/nsngroups/NSNGroupsUsersMove.php");break;
    case "NSNGroupsUsersMoveSave":include_once("admin/modules/nsngroups/NSNGroupsUsersMoveSave.php");break;
    case "NSNGroupsUsersUpdate":include_once("admin/modules/nsngroups/NSNGroupsUsersUpdate.php");break;
    case "NSNGroupsUsersUpdateSave":include_once("admin/modules/nsngroups/NSNGroupsUsersUpdateSave.php");break;
    case "NSNGroupsUsersView":include_once("admin/modules/nsngroups/NSNGroupsUsersView.php");break;
    case "NSNGroupsView":include_once("admin/modules/nsngroups/NSNGroupsView.php");break;
  }
} else {
    echo "Access Denied";
}

?>

