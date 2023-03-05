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

function admin_config(){

	global $prefix, $db, $admin_file;

OpenTable();

		$result = $db->sql_query("select * from ".$prefix."_link_us_config");
        $row = $db->sql_fetchrow($result);
		
		//$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config"));
		
		if($row['user_submit'] == 1){$users_y = "checked";}
	elseif($row['user_submit'] == 0){$users_n = "checked";}
	
		if($row['button_method'] == 1){$button_i = "checked";}
	elseif($row['button_method'] == 0){$button_u = "checked";}

echo "<table width='60%' border='1' align='center'><tr><th scope='col'>Main Link Us Configuration</th></tr></table>";

echo "<form action='".$admin_file.".php?op=update_main' method='post'>";

echo "<table width='60%' border='1' align='center' cellpadding='3' cellspacing='3'>
  <tr>
     <td width='30%'>Users Can Submit Site Button</td>
	 <td width='30%'>Yes:<input name='user_submit' type='radio' value='1' ".$users_y.">&nbsp;&nbsp;No:<input name='user_submit' type='radio' value='0' ".$users_n.">  </td>
  </tr>  
  <tr>
     <td width='30%'>Button Submit Method</td>
	 <td width='30%'>Link:<input name='button_method' type='radio' value='1' ".$button_i.">&nbsp;&nbsp;Upload:<input name='button_method' type='radio' value='0' ".$button_u."></td>
  </tr>  
  <tr>
     <td width='30%'>Button Size</td>
	 <td width='30%'>Height:<input name='button_height' type='text' size='10' value='".$row['button_height']."'>&nbsp;&nbsp;Width:<input name='button_width' type='text' size='10' value='".$row['button_width']."'></td>
  </tr>  
  <tr>
     <td width='30%'>Folder Upload Location</td>
	 <td width='30%'><input name='upload_file' type='text' size='35' value='".$row['upload_file']."'></td>
  </tr>
</table>
<input name='op' type='hidden' value='update_main'>
<center><input name='submit' type='submit' value='Update Main Config'></center>
</form>
";
CloseTable();
}

switch($op){

	case 'admin_config': 
		admin_config(); 
	break;
	
}

?>