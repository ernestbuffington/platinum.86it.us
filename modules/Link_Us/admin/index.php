<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
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
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
/********************************************************************

                    DarkForgeGFX Link To Us
				  
	(c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
		
********************************************************************/

global $prefix, $db, $admin_file, $op, $uploaddir, $module_name;

$aid = substr("$aid", 0,25);
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1; 
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
include_once(NUKE_BASE_DIR.'header.php');
include_once(NUKE_BASE_DIR.'mainfile.php');

$module_name = "Link_Us";

define("NUKE_ADMIN_LINK_US_INCLUDES","modules/$module_name/admin/inc/");

$image_path = "modules/".$module_name."/buttons/";

include_once('modules/'.$module_name.'/admin/linktousversion.php');

	$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config"));

	$uploaddir = $config['upload_file'];

	function LinkusTableOpen() {
    	global $bgcolor1, $bgcolor2;

    	echo "<table width='100%' border='0' cellspacing='1' cellpadding='0' align='center'><tr><td class='extras'>\n";
    	echo "<table width='100%' border='0' cellspacing='1' cellpadding='8'><tr><td>\n";
	}

	function LinkusTableClose() {
		echo "</td></tr></table></td></tr></table>\n";
	}

	OpenTable();
	echo "<center><img src='modules/".$module_name."/admin/logo_linkus.png'></center>";
	echo "<center><a href='".$admin_file.".php?op=link_us'>Platinum Nuke Pro :: Link Us Module</a>";
	echo "<br /><br />";
	echo "[ <a href='".$admin_file.".php'>Return To Main Adminisitration</a> ]</center>";
	echo "<br />";
/*	
$data = eval(@file_get_contents("http://www.darkforgegfx.com/versionchecker/link_to_us.txt"));
if ($message2 == ""){$mess = "";}else{$mess ="<center>".$message2."</center><br>";}
if ($curversion == $linktous_Version){ $vercheck = "<center><font color='green'><strong>Your version is Current!</font></strong></center>";
}else{ $vercheck = "<center><font color='red'>".$message."</font><br><a href='".$download."'><font color='green'>Download From Here</font></a><center><br>";}

	echo "" . $mess . "" . $vercheck . "";

	echo "<br />";
*/
	echo "<table width='60%' border='1' align='center'>";
	echo "  <tr>";
	echo "    <td width='30%' align='center'><a href='".$admin_file.".php?op=add_button'><img src='modules/".$module_name."/images/admin/add.png' border='0'><br />Add Link Button</a></td>";
	echo "	<td width='30%' align='center'><a href='".$admin_file.".php?op=linkus_block_config'><img src='modules/".$module_name."/images/admin/preferences.png' border='0'><br />Block Config</a></td>";
	echo "    <td width='30%' align='center'><a href='".$admin_file.".php?op=module_config'><img src='modules/".$module_name."/images/admin/preferences.png' border='0'><br />Modules Config</a></td>";	
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td width='30%' align='center'><a href='".$admin_file.".php?op=admin_config'><img src='modules/".$module_name."/images/admin/supporters.png' border='0'><br />Link Us Admin Config</a></td>";
	echo "    <td width='30%' align='center'><a href='".$admin_file.".php?op=active_sites'><img src='modules/".$module_name."/images/admin/4nwho.png' border='0'><br />View Active Sites</a></td>";
	echo "    <td width='30%' align='center'><a href='".$admin_file.".php?op=inactive_sites'><img src='modules/".$module_name."/images/admin/messages.png' border='0'><br />Inactive Sites</a></td>";
	echo "  </tr>";
	echo "</table>";

	echo "<div align='right'><a href='http://www.darkforgegfx.com' target='_blank'>&copy; DarkForgeGFX</a></div>";
	CloseTable();

switch($op){

	case 'add_button': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'button_add.php'); 
	break;
		
	case 'insert_button': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'button_save.php');
	break;
	
	case 'edit_button':	
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'edit_button.php'); 
	break;
		
	case 'delete_button':
		$db->sql_query("DELETE FROM ".$prefix."_link_us WHERE id='$id'");
		$db->sql_query("OPTIMIZE TABLE ".$prefix."_link_us");
	break;	
	
	case 'edit_button_save': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'edit_button_save.php'); 
	break;
	
	case 'active_sites': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'active_sites.php'); 
	break;
	
	case 'inactive_sites': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'inactive_sites.php'); 
	break;
	
	case 'linkus_block_config': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'linkus_block_config.php'); 
	break;
	
	case 'update_settings':	
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'block_config_save.php'); 
	break;
	
	case 'module_config':
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'module_config.php'); 
	break;
	
	case 'update_module_settings':
		$db->sql_query("UPDATE ".$prefix."_link_us_config SET button_standard='$button_standard', button_banner='$button_banner', button_resource='$button_resource'");
		header("Location: ".$admin_file.".php?op=module_config");
	break;
	
	case 'admin_config': 
		include_once(NUKE_ADMIN_LINK_US_INCLUDES.'admin_config.php'); 
	break;
	
	case 'update_main':
		$db->sql_query("UPDATE ".$prefix."_link_us_config SET user_submit='$user_submit', button_method='$button_method', button_height='$button_height', button_width='$button_width', upload_file='$upload_file'");
		header("Location: ".$admin_file.".php?op=admin_config");
	break;
	
}

include_once(NUKE_BASE_DIR.'footer.php');
}

?>