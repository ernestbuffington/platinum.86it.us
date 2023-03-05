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
if ($radminsuper==1) {
  adminmenu($admin_file.".php?op=BAMain", _BA_TITLE, "bnrads.gif");
}

?>