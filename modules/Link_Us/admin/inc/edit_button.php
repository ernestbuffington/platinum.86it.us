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

		$id = $_GET['id'];
        $result = $db->sql_query("select * from ".$prefix."_link_us where id='$id'");
        $row = $db->sql_fetchrow($result);
		
		if($row['site_status'] == 0){$inactive = "checked";}
		if($row['site_status'] == 1){$active = "checked";}
		
        echo "<br>\n";
        OpenTable();
        echo "<center><table border='0' cellpadding='5' cellspacing='5'>";
        echo "<form action='".$admin_file.".php?op=edit_button_save' method='post'>";
        
        echo "<tr><td><strong>Site ID:</strong></td><td><strong>".$row['id']."</strong></tr></td>";	
			
        echo "<tr><td><strong>Site Name:</strong></td><td><input type='text' name='site_name' size='30' value='".$row['site_name']."'></tr></td>";
			
        echo "<tr><td><strong>Site URL:</strong></td><td><input type='text' name='site_url' size='60' value='".$row['site_url']."'></tr></td>";
				
        echo "<tr><td><strong>Site Image:</strong></td><td><input type='text' name='site_image' size='30' value='".$row['site_image']."'></tr></td>";		
	echo " <tr>";
	// Link-Us fix start - sgtmudd
echo "	<td width='40%'><strong>Site Image:</strong></td>";
if($config['button_method'] == 1){ $type = "type='input'"; } else { $type = "type='file'"; }
echo "      <td width='40%'><input name='site_image' ".$type." size='50'><br />( Available Image Types: Jpeg, JPG, Gif & PNG )</td>";
echo " </tr>";
	// Link-Us fix end - sgtmudd
        echo "<tr><td><strong>Date Added:</strong></td><td>".$row['date_added']."</tr></td>";	
			
        echo "<tr><td valign='top'><strong>Site Description's:</strong></td><td><textarea rows='5' cols='50' name='site_description'>".$row['site_description']."</textarea></tr></td>";		
		
		if($row['site_status'] == 1){
		echo "<tr><td><strong>Site Status:</strong></td><td>Active:<input name='site_status' type='radio' value='1' checked>&nbsp;Deactivated:<input name='site_status' type='radio' value='0'></td></tr>";
		}else{
		echo "<tr><td><strong>Site Status:</strong></td><td>Active:<input name='site_status' type='radio' value='1'>&nbsp;Deactivated:<input name='site_status' type='radio' value='0' checked></td></tr>";
		}
		
		echo "</table></center>";
		//echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "<center><input type='submit' value='Edit Button'></center>";		
        echo "</form>";		
        CloseTable();

?>