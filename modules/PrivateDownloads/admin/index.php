<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

$module_name = "PrivateDownloads";

require_once("mainfile.php");
get_lang($module_name);
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='$module_name'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
include_once("modules/$module_name/includes/functions.php");
$dl_config = gdget_configs();
if(!isset($op)) { $op="DLMain"; }

switch ($op) {

    case "DLMain":include_once("modules/$module_name/admin/Main.php");break;
    case "DLConfig":include_once("modules/$module_name/admin/Config.php");break;
    case "DLConfigSave":include_once("modules/$module_name/admin/ConfigSave.php");break;
    case "Categories":include_once("modules/$module_name/admin/Categories.php");break;
    case "CategoryActivate":include_once("modules/$module_name/admin/CategoryActivate.php");break;
    case "CategoryAdd":include_once("modules/$module_name/admin/CategoryAdd.php");break;
    case "CategoryAddSave":include_once("modules/$module_name/admin/CategoryAddSave.php");break;
    case "CategoryDeactivate":include_once("modules/$module_name/admin/CategoryDeactivate.php");break;
    case "CategoryDelete":include_once("modules/$module_name/admin/CategoryDelete.php");break;
    case "CategoryDeleteSave":include_once("modules/$module_name/admin/CategoryDeleteSave.php");break;
    case "CategoryModify":include_once("modules/$module_name/admin/CategoryModify.php");break;
    case "CategoryModifySave":include_once("modules/$module_name/admin/CategoryModifySave.php");break;
    case "CategoryTransfer":include_once("modules/$module_name/admin/CategoryTransfer.php");break;
    case "DownloadActivate":include_once("modules/$module_name/admin/DownloadActivate.php");break;
    case "DownloadAdd":include_once("modules/$module_name/admin/DownloadAdd.php");break;
    case "DownloadAddSave":include_once("modules/$module_name/admin/DownloadAddSave.php");break;
    case "DownloadBroken":include_once("modules/$module_name/admin/DownloadBroken.php");break;
    case "DownloadBrokenDelete":include_once("modules/$module_name/admin/DownloadBrokenDelete.php");break;
    case "DownloadBrokenIgnore":include_once("modules/$module_name/admin/DownloadBrokenIgnore.php");break;
    case "DownloadCheck":include_once("modules/$module_name/admin/DownloadCheck.php");break;
    case "DownloadDeactivate":include_once("modules/$module_name/admin/DownloadDeactivate.php");break;
    case "DownloadDelete":include_once("modules/$module_name/admin/DownloadDelete.php");break;
    case "DownloadModify":include_once("modules/$module_name/admin/DownloadModify.php");break;
    case "DownloadModifyRequests":include_once("modules/$module_name/admin/DownloadModifyRequests.php");break;
    case "DownloadModifyRequestsAccept":include_once("modules/$module_name/admin/DownloadModifyRequestsAccept.php");break;
    case "DownloadModifyRequestsIgnore":include_once("modules/$module_name/admin/DownloadModifyRequestsIgnore.php");break;
    case "DownloadModifySave":include_once("modules/$module_name/admin/DownloadModifySave.php");break;
    case "DownloadNew":include_once("modules/$module_name/admin/DownloadNew.php");break;
    case "DownloadNewDelete":include_once("modules/$module_name/admin/DownloadNewDelete.php");break;
    case "Downloads":include_once("modules/$module_name/admin/Downloads.php");break;
    case "DownloadTransfer":include_once("modules/$module_name/admin/DownloadTransfer.php");break;
    case "DownloadValidate":include_once("modules/$module_name/admin/DownloadValidate.php");break;
    case "ExtensionAdd":include_once("modules/$module_name/admin/ExtensionAdd.php");break;
    case "ExtensionAddSave":include_once("modules/$module_name/admin/ExtensionAddSave.php");break;
    case "ExtensionDelete":include_once("modules/$module_name/admin/ExtensionDelete.php");break;
    case "ExtensionModify":include_once("modules/$module_name/admin/ExtensionModify.php");break;
    case "ExtensionModifySave":include_once("modules/$module_name/admin/ExtensionModifySave.php");break;
    case "Extensions":include_once("modules/$module_name/admin/Extensions.php");break;
    case "FilesizeCheck":include_once("modules/$module_name/admin/FilesizeCheck.php");break;
    case "FilesizeValidate":include_once("modules/$module_name/admin/FilesizeValidate.php");break;

}

} else {
    Header("Location: ".$admin_file.".php");
}

?>
