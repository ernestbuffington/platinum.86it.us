<?php

	$db->sql_query("UPDATE `". $prefix ."_link_us` SET `site_status` = '1' WHERE `id` = '".$id."'");
	redirect($admin_file .'.php?op=active_sites');

?>