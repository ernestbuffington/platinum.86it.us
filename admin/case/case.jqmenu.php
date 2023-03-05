<?php

/**
 * Genesis Jquery Menu Module
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     Genesis
 * @subpackage  JQMenu
 * @author      baxr6 <dfwcomputer@gmail.com>
 * @copyright   2009 by DFW Computers
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.dfwcomputer.com.au
 * @since       7.6.G.1
 */
 
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
switch ($op) {
	case 'jqmenu':
	case 'jqmenu_add_cat':
	case 'jqmenu_add_cat_img':
	case 'jqmenu_save_cat_img':
	case 'jqmenu_save_cat':
	case 'jqmenu_add_link':
	case 'jqmenu_save_link':
	case 'jqmenu_del_cat':
    case 'jqmenu_del_link':
		include_once('admin/modules/JQMenu.php');
		break;
}
?>