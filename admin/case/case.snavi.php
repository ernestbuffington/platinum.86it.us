<?php
	global $admin_file, $module_name;
	$module_name = "Snavi";
	
	switch($op) 
	{
		case 'Snavi':
		case 'Snavi_Main':
		case 'Snavi_Main_Config':
		case 'Snavi_News_Config':
		case 'Snavi_Menu_Items':
		case 'Snavi_Style_Sheet':
			include_once('admin/modules/snavi.php');			
			break;
			
	}

?>