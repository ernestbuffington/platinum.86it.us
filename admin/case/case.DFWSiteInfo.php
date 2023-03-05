<?php


if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}

switch ($op) {
	case 'DFWAdmin':
	case 'DFWSaveSettings':
	case 'DFWSaveTooltips':
	case 'DFWTagImage':
	case 'DFWSaveTagImage':
	case 'DFWSaveStaff':
	case 'DFWEditStaff':
	case 'DFWUpdateStaff':
	case 'DFWDeleteStaff':
	case 'DFWSaveImageSettings':
	case 'DFWSaveTooltipImageSettings':
    include_once('admin/modules/DFWSiteInfo.php');
}

?>