<?php

/***************************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 7.9		*/
/* Written by: Jonathan Estrella					*/
/* http://metalrebelde.metropoliglobal.com			*/
/* Copyright (c) 2004-2006 Jonathan Estrella		/*
/**************************************************/

global $admin_file;
if (!preg_match("#".preg_quote($admin_file).".php#i", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
adminmenu("".$admin_file.".php?op=ContentPlus", ""._CONTENT."", "content.png");

?>