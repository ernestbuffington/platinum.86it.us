<?php

/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Clan Member Module
   ============================================
   Copyright (c) 2005 by DarkForgeGfx Development Team

   Filename      : copyright.php
   Author        : Lonestar
   Version       : 1.0.0
   Date          : 10/09/2007 (dd-mm-yyyy)

   Notes         : Clan Member Administration
************************************************************************/

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$author_name        = "DarkForgeGFX";
$author_email       = "darkforgegfx [at] darkforgegfx [dot] com";
$author_homepage    = "http://www.darkforgegfx.com";
$based_on           = "--";
$license            = "GPL";
$download_location  = "http://www.darkforgegfx.com";
$module_version     = "PNPv1";
$module_description = "To show and administrate several methods of backlinks to your website.";

show_copyright($author_name, $author_email, $author_homepage, $based_on, $license, $download_location, $module_version, $module_description);

?>