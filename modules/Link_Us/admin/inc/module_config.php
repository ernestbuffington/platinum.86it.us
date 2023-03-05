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

function module_config(){

	global $prefix, $db, $admin_file, $op;
	
	$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config"));
	
	OpenTable();
	
	if ($config['button_standard'] == 1){$standard_y = "checked";}
elseif ($config['button_standard'] == 0){$standard_n = "checked";}

	if ($config['button_banner'] == 1){$banner_y = "checked";}
elseif ($config['button_banner'] == 0){$banner_n = "checked";}

	if ($config['button_resource'] == 1){$resource_y = "checked";}
elseif ($config['button_resource'] == 0){$resource_n = "checked";}
	
echo "<table width='80%' border='1' align='center'><tr><th scope='col'>Module Configuration</th></tr></table>";
echo "<form action='".$admin_file.".php?op=update_module_settings' method='post'>";
echo "<table width='80%' border='1' cellpadding='3' cellspacing='3' align='center'>";
echo "  <tr>";
echo "    <td width='40%'><strong>Show Standard Buttons:</strong></td>";
echo "    <td width='40%'>Yes:<input name='button_standard' type='radio' value='1' ".$standard_y.">&nbsp;No:<input name='button_standard' type='radio' value='0' ".$standard_n."></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>Show Banner Buttons:</strong></td>";
echo "    <td width='40%'>Yes:<input name='button_banner' type='radio' value='1' ".$banner_y.">&nbsp;No:<input name='button_banner' type='radio' value='0' ".$banner_n."></td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>Show My Resource Buttons:</strong></td>";
echo "    <td width='40%'>Yes:<input name='button_resource' type='radio' value='1' ".$resource_y.">&nbsp;No:<input name='button_resource' type='radio' value='0' ".$resource_n."></td>";
echo "  </tr>";
echo "</table>";
echo "<input name='op' type='hidden' value='update_module_settings'>";
echo "<br /><div align='center'><input name='submit' type='submit' value='Update Module Settings'></div>";
echo "</form>";


	CloseTable();
}

switch($op){

	case 'module_config': module_config(); break;
	
}

?>