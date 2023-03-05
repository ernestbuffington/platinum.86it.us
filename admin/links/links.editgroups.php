<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) { die('Illegal Access Detected!!!'); }
if($radminsuper==1) {
    adminmenu($admin_file.'.php?op=NSNGroups', _GR_ADMGRP, 'groups.png');
}

?>
