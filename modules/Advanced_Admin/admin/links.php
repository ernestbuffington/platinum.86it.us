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

if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

global $admin_file;
adminmenu($admin_file.'.php?op=Advanced_Admin', _ADVANCED_ADMIN , 'aaba.png');

?>