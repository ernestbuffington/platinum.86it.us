<?php

		$db->sql_query("UPDATE ".$prefix."_link_us_config SET button_standard='$button_standard', button_banner='$button_banner', button_resource='$button_resource'");
		redirect($admin_file.'.php?op=module_config');

?>