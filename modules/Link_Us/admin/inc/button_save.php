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

	global $prefix, $db, $uploaddir;

function check_image_type($type) {
	switch($type) {
		case 'image/jpeg':
		case 'image/pjpeg':
		case 'image/jpg':
			return '.jpg';
			break;
		case 'image/gif':
			return '.gif';
			break;
		case 'image/png':
			return '.png';
			break;
		default:
			return false;
			break;
	}
	return false;
}

		if($config['button_method'] == 0){		
			
		if (!file_exists("$uploaddir")) {
			mkdir("$uploaddir", 0755);
		}
		
		if (check_image_type($_FILES['site_image']['type']) == false) echo 'ERROR! Unknown image format';
		if (move_uploaded_file($_FILES['site_image']['tmp_name'], $uploaddir . $_FILES['site_image']['name'])) {
			$img_upload = "".$uploaddir."".$_FILES['site_image']['name']."";
   			Header("Location: ".$admin_file.".php?op=link_us");
		}
		}else{
			$img_upload = $site_image;
		}
		$result = $db->sql_query("INSERT INTO `".$prefix."_link_us` values (NULL, '".$site_name."', '".$site_url."', '".$img_upload."', '".$site_description."', '0', '1', '".$date_added."', '".$button_type."')");
		
		if($another_button == 1){Header("Location: ".$admin_file.".php?op=add_button");}else{Header("Location: ".$admin_file.".php?op=link_us");}

?>