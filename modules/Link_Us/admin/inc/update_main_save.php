<?php
		
		$db->sql_uquery("UPDATE `".$prefix."_link_us_config` SET `user_submit`='$user_submit', `button_method`='$button_method', `button_height`='$button_height', `button_width`='$button_width', `button_banner_height`='$button_banner_height', `button_banner_width`='$button_banner_width', `button_ressource_height`='$button_ressource_height', `button_ressource_width`='$button_ressource_width', `upload_file`='$upload_file'");
        redirect($admin_file.'.php?op=admin_config');

?>