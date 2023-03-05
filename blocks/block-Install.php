<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT aNY WaRRaNTY; without even the implied warranty of              */
/* MERCHaNTaBILITY or FITNESS FOR a PaRTICULaR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, Ma  02111-1307, USa. */
/*******************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File access");
}
global $admin_file; 

$content  .= "<div align=\"center\"><img src=images/pnpro_mirror_box450w.png></img><br /><br />";
$content  .= "<div align=\"center\"><h3><strong>Congratulations, you have successfully installed Platinum Nuke Pro v2.0!</strong></h3></div><br /><br />";
$content  .= "<div align=\"left\"><strong>If you did a manual install, please do the next three steps also:</strong><br />If you used the auto installer, please start at step three:<br /><br />";
$content  .= "<strong>Required <font color=\"purple\">1: </font><font color=green>Set the file & folder permissions by clicking <a href=\"setpermissions.php\" target=\"_blank\"><font color=\"red\"><u>HERE</u></font></font></a></strong>.<br /><br />";
$content  .= "<strong>Required <font color=\"purple\">2: </font><font color=green>Create an admininstrator account by clicking <a href=\"".$admin_file.".php\"><font color=\"red\"><u>HERE</u></font></font></a></strong>.<br /><br />";
$content  .= "<strong>Required <font color=\"purple\">3: </font><font color=green>Install IP-2-Country Tables <a href=\"ip2country.php\" target=\"_blank\"><font color=\"red\"><u>HERE</u></font></font></a></strong>.<br /><br />";
$content  .= "<strong><font color=\"purple\">OPTIONAL: </font><font color=green>Install Member Application Tables <a href=\"MA_Install_214.php\" target=\"_blank\"><font color=\"red\"><u>HERE</u></font></font></a></strong>.<br /><br />";
$content  .= "<br /><br /><strong><font color=\"purple\"><u>IMPORTANT NOTICE:</u></font><br /><br />Once you have installed the ip2country tables, Set the file & folder permissions and created your admin account and have created your Member application Tables (optional), <strong>remove the install files/folders by clicking <a href='manual_install_cleanup.php'><u>HERE</u>!</a></strong><br /><br />You now need to verify the following files and folders have been deleted: 'install.php', 'Ma_Install_212.php', 'ip2country.php' and the following folders:'install' and 'ip2c'.<br /><br />";
$content  .= "Then you can remove this block by deactivating the Install block in your Blocks admin area.<br /><br />";
$content  .= "<strong>For more detailed information on Installation and Features please view the documentation <a href=\"/docs/index.html\" target=\"_blank\"><font color=\"red\"><u>HERE</u></font></a></strong>.<br /><br /></div></div>";

?>