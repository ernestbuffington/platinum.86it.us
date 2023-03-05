<?php
/********************************************************/
/* Site Credits Module for PHP-Nuke                     */
/* Version 1.0.1         4-03-04                        */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2004 by Codezwiz                    */
/********************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $admin_file;

if (($radminsuper==1) OR ($radminuser==1)) {
    adminmenu("".$admin_file.".php?op=credits", ""._CREDITS."", "credits.png");
}

?>
