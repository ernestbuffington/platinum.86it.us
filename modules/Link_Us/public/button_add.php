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

function add_button(){

	global $prefix, $db, $admin_file, $op;
	
	$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config"));

OpenTable();
echo "<form action='".$admin_file.".php?op=insert_button' method='post' enctype='multipart/form-data'>";
echo "<table width='80%' border='1' align='center'><tr><th scope='col'>Add Site Link Button</th></tr></table>";
echo "<table width='80%' border='1' align='center' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo "	<td width='40%'><strong>Site Name:</strong></td>";
echo "	<td width='40%'><input type='text' name='site_name' size='50'></td>";
echo " </tr>";
echo " <tr>";
echo "	<td width='40%'><strong>Site URL:</strong></td>";
echo "	<td width='40%'><input type='text' name='site_url' size='50'></td>";
echo " </tr>";
echo " <tr>";
echo "	<td width='40%'><strong>Site Image:</strong></td>";
if($config['button_method'] == 1){ $type = "type='input'"; } else { $type = "type='file'"; }
echo "      <td width='40%'><input name='site_image' ".$type." size='50'><br />( Available Image Types: Jpeg, JPG, Gif & PNG )</td>";
echo " </tr>";
echo " <tr>";
echo "	<td width='40%'><strong>Site Description:</strong></td>";
echo "	<td width='40%'><textarea cols='50' rows='5' name='site_description'></textarea></td>";
echo " </tr>";
echo " <tr>";
echo "     <td width='40%'><strong>Button Type:</strong></td>";
echo "     <td width='40%'>
	<input name='button_type' type='radio' value='1' checked> Standard Size Button ( Width = 88 x Height = 31 )<br />
	<input name='button_type' type='radio' value='2'> Banner Size Button ( Width = 468 x Height = 60 )<br />
	<input name='button_type' type='radio' value='3'> Resource Button ( Width = 88 x Height = 31 )</td>";
echo "   </tr>";
echo "</table>";
echo "<table width='80%' border='1' align='center' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo " 	<td width='80%' align='center'><strong>Add Another Button:</strong> <input name='another_button' type='radio' value='1'></td>";
echo " </tr>";
echo "</table>";
echo "<br />";
echo "<input name='site_hits' type='hidden' value='0'>";
echo "<input name='site_status' type='hidden' value='1'>";
echo "<input name='date_added' type='hidden' value='".date("d M, Y")."'>";
echo "<input name='op' type='hidden' value='insert_button'>";
echo "<center><input name='submit' type='submit' value='Add Button'></center>";
echo "</form>";
CloseTable();
}

switch($op){

	case 'add_button': add_button(); break;
	
}

?>