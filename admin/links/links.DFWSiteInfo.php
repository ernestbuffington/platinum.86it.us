<?php


if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
global $admin_file;
if ($radminsuper == 1) {
	adminmenu($admin_file . '.php?op=DFWAdmin', 'DFW Site Info', 'DFWSiteInfo.gif');
}


?>