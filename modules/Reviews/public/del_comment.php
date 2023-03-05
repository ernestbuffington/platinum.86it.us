<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function del_comment($cid, $id) {
    global $admin, $prefix, $db, $module_name;
    if (is_admin($admin)) {
        $db->sql_query("delete from ".$prefix."_reviews_comments where cid='$cid'");
        Header("Location: modules.php?name=$module_name&amp;rop=showcontent&amp;id=$id");
    } else {
        echo "ACCESS DENIED";
    }
}

?>