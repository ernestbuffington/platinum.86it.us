<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ('Access Denied');
}
$module_name = 'Your_Account'; 
get_lang($module_name); 

// menelaos: dynamically insert the version number in the admin config panel image Copyright (c) 2004 :-)
include_once('modules/'.$module_name.'/includes/functions.php');
if (!isset($ya_config)) $ya_config = ya_get_configs();
$yaversion = $ya_config['version'];
if (extension_loaded("gd")) 
adminmenu($admin_file.'.php?op=yaAdmin', _EDITUSERS, 'users.png', '../../modules.php?name=Your_Account&amp;op=gfxadminimage&amp;yaversion='.$yaversion); 
else 
adminmenu($admin_file.'.php?op=yaAdmin', _EDITUSERS, 'users.png'); 

?>