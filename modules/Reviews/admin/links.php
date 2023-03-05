<?php

global $admin_file;
if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}
adminmenu("".$admin_file.".php?op=reviews", ""._REVIEWS."", "reviews.png");

?>
