<?php
/*=======================================================================
 Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************
    Nuke-Evolution: Advanced Admin Block
    ===========================================================
    Copyright (c) 2009-2010 by DarkForgeGfx Development Team
    Author        : killigan
    Version       : 1.0.3
    Developer     : killigan - www.darkforgegfx.com
    Notes         : N/A
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
 	  Block completely recoded (SgtLegend)     v1.0.3       01/18/2009
 	  Block completely recoded                 v1.0.2       08/30/2009
      Admin Panel added                        v1.0.2       08/30/2009
 ************************************************************************/
 
/*if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}*/

switch($op) {

    case 'Advanced_Admin':
	case 'block_config':
	case 'block_config_save':
	case 'update_block_settings':
    include_once("modules/Advanced_Admin/admin/index.php");
    break;

}

?>