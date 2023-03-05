<?php


global $admin_file;
if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}
$module_name = "Reviews";
include_once("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

    case "reviews":
    case "mod_main":
    case "add_review":
    include_once("modules/$module_name/admin/index.php");
    break;

}

?>
