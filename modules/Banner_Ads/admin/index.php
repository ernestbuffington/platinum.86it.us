<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

global $admin_file;
if(!defined('ADMIN_FILE')) {
  Header("Location: ../../".$admin_file.".php");
  die();
}
$modname = "Banner_Ads";
@require_once("mainfile.php");
get_lang($modname);
$index=1;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='$modname'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) { if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") { $auth_user = 1; } }
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
  $ba_config = baget_configs();
  switch($op) {
    case "BAClient":@include_once("modules/$modname/admin/BAClient.php");break;
    case "BAClientAdd":@include_once("modules/$modname/admin/BAClientAdd.php");break;
    case "BAClientAddSave":@include_once("modules/$modname/admin/BAClientAddSave.php");break;
    case "BAClientDelete":@include_once("modules/$modname/admin/BAClientDelete.php");break;
    case "BAClientDeleteConf":@include_once("modules/$modname/admin/BAClientDeleteConf.php");break;
    case "BAClientEdit":@include_once("modules/$modname/admin/BAClientEdit.php");break;
    case "BAClientEditSave":@include_once("modules/$modname/admin/BAClientEditSave.php");break;
    case "BAClientView":@include_once("modules/$modname/admin/BAClientView.php");break;
    case "BAConfig":@include_once("modules/$modname/admin/BAConfig.php");break;
    case "BAConfigSave":@include_once("modules/$modname/admin/BAConfigSave.php");break;
    case "BAImage":@include_once("modules/$modname/admin/BAImage.php");break;
    case "BAImageAdd":@include_once("modules/$modname/admin/BAImageAdd.php");break;
    case "BAImageAddSave":@include_once("modules/$modname/admin/BAImageAddSave.php");break;
    case "BAImageDelete":@include_once("modules/$modname/admin/BAImageDelete.php");break;
    case "BAImageDeleteConf":@include_once("modules/$modname/admin/BAImageDeleteConf.php");break;
    case "BAImageEdit":@include_once("modules/$modname/admin/BAImageEdit.php");break;
    case "BAImageEditSave":@include_once("modules/$modname/admin/BAImageEditSave.php");break;
    case "BAImageMail":@include_once("modules/$modname/admin/BAImageMail.php");break;
    case "BAImageView":@include_once("modules/$modname/admin/BAImageView.php");break;
    case "BAMain":@include_once("modules/$modname/admin/BAMain.php");break;
  }
} else {
  echo _BA_ACCDEN;
}

?>
