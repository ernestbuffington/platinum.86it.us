<?php

		$db->sql_uquery("DELETE FROM `".$prefix."_link_us` WHERE `id`='$id'");
        $db->sql_uquery("OPTIMIZE TABLE `".$prefix."_link_us`");
        redirect($admin_file.'.php?op=link_us');

?>