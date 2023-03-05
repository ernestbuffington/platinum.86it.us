<?php
// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2004 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================

global $admin_file;
if ($admin_file == '') { $admin_file = 'admin'; }
if (!preg_match("/".$admin_file.".php/", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

if ($radminsuper==1) {
    adminmenu("".$admin_file.".php?op=shout", "Shout Box", "shoutbox.gif");
}

?>
