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
/* Admin Image Control v1.0 by sgtmudd (sgtmudd@mach-hosting.com)              */
/* Copyright (c) 2017 sgtmudd http://platinumnukepro.com                       */
/*******************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}

include_once(NUKE_BASE_DIR. 'header.php');
		
Opentable();

$path=$_SERVER['DOCUMENT_ROOT']."/modules/".$module_name."/admin_images/";
$img_name=$_POST['img_name'];
$PathFile=$path.$img_name;
unlink($PathFile);

header('Location: '.$admin_file.'.php?op=Admin_Image_Control');
echo '<div align="center">Image Deleted.</div>';
CloseTable();
echo '<div align="right">Admin Image Control v1.0 Copyright &copy; 2017 sgtmudd - <a target="_blank" href="http://platinumnukepro.com">Platinum Nuke Pro</a></div>';

include_once(NUKE_BASE_DIR.'footer.php');
?>