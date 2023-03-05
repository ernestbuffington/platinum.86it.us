<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function del_review($id_del) {
    global $admin, $prefix, $db, $module_name;
    if (is_admin($admin)) {
    	$db->sql_query("delete from ".$prefix."_reviews where id = $id_del");
	$db->sql_query("delete from ".$prefix."_reviews_comments where rid='$id_del'");
	Header("Location: modules.php?name=$module_name");
    } else {
    	echo "ACCESS DENIED";
    }
}

?>