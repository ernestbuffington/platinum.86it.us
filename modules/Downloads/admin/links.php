<?php

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

adminmenu("".$admin_file.".php?op=ns_edl_general", ""._DOWNLOAD."", "downloads.gif");


?>