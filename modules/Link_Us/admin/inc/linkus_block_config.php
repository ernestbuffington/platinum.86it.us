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

function linkus_block_config(){

	global $prefix, $db, $admin_file;
	
	$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config"));

OpenTable();

echo "<table width='80%' border='1' align='center'><tr><th scope='col'>Block Configuration</th></tr></table>";
echo "<form action='".$admin_file.".php?op=update_settings' method='post'>";
echo "<table width='80%' border='1' cellpadding='3' cellspacing='3' align='center'>";
echo "  <tr>";
echo "    <td width='40%'><strong>My Link Us Image:</strong></td>";
echo "    <td width='40%'><input name='my_image' type='text' size='60' value='".$config['my_image']."'><br />( example: http://www.mysite.com/button.gif )</td>";
echo "  </tr>";
 
	if ($config['fade_effect'] == 1){$fade_y ="checked";}
	if ($config['fade_effect'] == 0){$fade_n ="checked";}
  
echo "  <tr>";
echo "    <td width='40%'><strong>Enable Fade Effect:</strong></td>";
echo "    <td width='40%'>Yes:<input name='fade_effect' type='radio' value='1' ".$fade_y.">&nbsp;No:<input name='fade_effect' type='radio' value='0' ".$fade_n."></td>";
echo "  </tr>";
 
	if ($config['marquee'] == 1){$marquee_y ="checked";}
	if ($config['marquee'] == 0){$marquee_n ="checked";}
 
echo "  <tr>";
echo "    <td width='40%'><strong>Enable Marquee:</strong></td>";
echo "    <td width='40%'>Yes:<input name='marquee' type='radio' value='1' ".$marquee_y.">&nbsp;No:<input name='marquee' type='radio' value='0' ".$marquee_n."></td>";
echo "  </tr>";

	if ($config['marquee_direction'] == 1){$marquee_d_u ="checked";}
	if ($config['marquee_direction'] == 2){$marquee_d_d ="checked";}
	if ($config['marquee_direction'] == 3){$marquee_d_l ="checked";}
	if ($config['marquee_direction'] == 4){$marquee_d_r ="checked";}

echo "  <tr>";
echo "    <td width='40%'><strong>Marquee Direction:</strong></td>";
echo "    <td width='40%'>
	Up:<input name='marquee_direction' type='radio' value='1' ".$marquee_d_u.">&nbsp;
	Down:<input name='marquee_direction' type='radio' value='2' ".$marquee_d_d."></td>";
echo "  </tr>";
 
	if ($config['marquee_scroll'] == 1){$marquee_s_f ="checked";}
	if ($config['marquee_scroll'] == 2){$marquee_s_s ="checked";}

echo "  <tr>";
echo "    <td width='40%'><strong>Marquee Scroll Amount:</strong></td>";
echo "    <td width='40%'>Fast:<input name='marquee_scroll' type='radio' value='1' ".$marquee_s_f.">&nbsp;Slow:<input name='marquee_scroll' type='radio' value='2' ".$marquee_s_s."></td>";
echo "  </tr>";

	if ($config['block_height'] == 1){$block_height_100 ="checked";}
	if ($config['block_height'] == 2){$block_height_150 ="checked";}
	if ($config['block_height'] == 3){$block_height_200 ="checked";}
	if ($config['block_height'] == 4){$block_height_250 ="checked";}
	if ($config['block_height'] == 5){$block_height_300 ="checked";}

echo "  <tr>";
echo "    <td width='40%'><strong>Block Height:</strong></td>";
echo "    <td width='40%'>
	100px:<input name='block_height' type='radio' value='1' ".$block_height_100.">&nbsp;
	150px:<input name='block_height' type='radio' value='2' ".$block_height_150.">&nbsp;
	200px:<input name='block_height' type='radio' value='3' ".$block_height_200.">&nbsp;
	250px:<input name='block_height' type='radio' value='4' ".$block_height_250.">&nbsp;
	300px:<input name='block_height' type='radio' value='5' ".$block_height_300.">&nbsp;</td>";
echo "  </tr>";
 
	if ($config['show_clicks'] == 1){$show_clicks_y ="checked";}
	if ($config['show_clicks'] == 0){$show_clicks_n ="checked";}

echo "  <tr>";
echo "  	<td width='40%'><strong>Show Click Counter:</strong></td>";
echo "	<td width='40%'>Yes:<input name='show_clicks' type='radio' value='1' ".$show_clicks_y.">&nbsp;No:<input name='show_clicks' type='radio' value='0' ".$show_clicks_n."></td>";
echo "  </tr>";
 
	if ($config['button_seperate'] == 1){$button_seperate_hr ="checked";}
	if ($config['button_seperate'] == 2){$button_seperate_dot ="checked";}
	if ($config['button_seperate'] == 0){$button_seperate_none ="checked";}

echo "  <tr>";
echo "    <td width='40%'><strong>Button Seperation:</strong></td>";
echo "    <td width='40%'>
	Horizontal Line:<input name='button_seperate' type='radio' value='1' ".$button_seperate_hr.">&nbsp;
	Dotted Line:<input name='button_seperate' type='radio' value='2' ".$button_seperate_dot.">&nbsp;
	No Seperation:<input name='button_seperate' type='radio' value='0' ".$button_seperate_none."</td>";
echo "  </tr>";
echo "</table>";

echo "<br /><br />";

echo "<input name='op' type='hidden' value='update_settings'>";
echo "<center><input name='submit' type='submit' value='Update Block Config'></center>";
echo "</form>";

CloseTable();
}

switch($op){

	case 'linkus_block_config': linkus_block_config(); break;
	
}

?>