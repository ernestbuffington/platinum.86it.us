<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}
@require_once("mainfile.php");
bacookiedecode($baclient);
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$index=1;
if(!($op)) { $op = "BAIndex"; }
$ba_config = baget_configs();
switch($op) {
  case "BAClientEdit":@include_once("modules/$module_name/public/BAClientEdit.php");break;
  case "BAClientEditSave":@include_once("modules/$module_name/public/BAClientEditSave.php");break;
  case "BAClientNew":@include_once("modules/$module_name/public/BAClientNew.php");break;
  case "BAClientNewSave":@include_once("modules/$module_name/public/BAClientNewSave.php");break;
  case "BAClientPassLost":@include_once("modules/$module_name/public/BAClientPassLost.php");break;
  case "BAClientPassMail":@include_once("modules/$module_name/public/BAClientPassMail.php");break;
  case "BAClientView":@include_once("modules/$module_name/public/BAClientView.php");break;
  case "BAImageEdit":@include_once("modules/$module_name/public/BAImageEdit.php");break;
  case "BAImageEditSave":@include_once("modules/$module_name/public/BAImageEditSave.php");break;
  case "BAImageList":@include_once("modules/$module_name/public/BAImageList.php");break;
  case "BAImageMail":@include_once("modules/$module_name/public/BAImageMail.php");break;
  case "BAImageView":@include_once("modules/$module_name/public/BAImageView.php");break;
  case "BAIndex":@include_once("modules/$module_name/public/BAIndex.php");break;
  case "BAgfx":@include_once("modules/$module_name/public/BAgfx.php");break;
  case "BALogin":@include_once("modules/$module_name/public/BALogin.php");break;
  case "BALogout":@include_once("modules/$module_name/public/BALogout.php");break;
}

?>