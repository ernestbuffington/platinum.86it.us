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
get_lang($modname);
switch ($op) {
  case "BAClient":
  case "BAClientAdd":
  case "BAClientAddSave":
  case "BAClientDelete":
  case "BAClientDeleteConf":
  case "BAClientEdit":
  case "BAClientEditSave":
  case "BAClientView":
  case "BAConfig":
  case "BAConfigSave":
  case "BAImage":
  case "BAImageAdd":
  case "BAImageAddSave":
  case "BAImageDelete":
  case "BAImageDeleteConf":
  case "BAImageEdit":
  case "BAImageEditSave":
  case "BAImageMail":
  case "BAImageView":
  case "BAMain":
  @include_once("modules/$modname/admin/index.php");
  break;
}

?>