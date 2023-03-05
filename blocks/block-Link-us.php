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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
	global $prefix, $db, $sitename, $nukeurl;
echo "<script type='text/javascript' src='includes/javascript/visible.js'></script>";
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us"));
$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_link_us_config LIMIT 0,1"));
if($config['fade_effect'] == 1){
//$fade = 'style="filter:alpha(opacity=60);-moz-opacity:0.6" onMouseOver="makevisible(this,0)" onMouseOut="makevisible(this,1)"';
$settings = 'width="88" height="31" border="0" style="filter:alpha(opacity=60);-moz-opacity:0.6" onMouseOver="makevisible(this,0)" onMouseOut="makevisible(this,1)"';
}else{
      $settings = 'width="88" height="31" border="0"';
}
	if($config['marquee_direction'] == 1){$direction = "up";}
elseif($config['marquee_direction'] == 2){$direction = "down";}
elseif($config['marquee_direction'] == 3){$direction = "left";}
elseif($config['marquee_direction'] == 4){$direction = "right";}
	if ($config['button_seperate'] == 1){ $seperation ="<span style='width=100px; size=5;'><hr /></span>"; }
elseif ($config['button_seperate'] == 2){ $seperation ="<center>-------------------</center>"; }
elseif ($config['button_seperate'] == 0){ $seperation =""; }
	if($config['show_clicks'] == 1){$clicks = "<br />(Visits ".$site_hits." )";}
elseif($config['show_clicks'] == 0){$clicks = "";}
	if($config['block_height'] == 1){$height = "100";}
elseif($config['block_height'] == 2){$height = "150";}
elseif($config['block_height'] == 3){$height = "200";}
elseif($config['block_height'] == 4){$height = "250";}
elseif($config['block_height'] == 5){$height = "300";}
	if($config['marquee_scroll'] == 1){$amount = 3;}
elseif($config['marquee_scroll'] == 2){$amount = 2;}
/****[START]******************************
 [Block: Settings                        ]
******************************************/
$my_image = '<img src="'.$nukeurl.'/images/plat_button.gif" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31"><br />';
$linkus_settings = '<a href="'.$nukeurl.'" target="_blank"><img src="'.$config['my_image'].'" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31"></a><br />';
/****[END]********************************
 [Block: Settings                        ]
******************************************/
$content .= '<center>'.$my_image.'</center><br />';
$content .= '<center>';
$content .= '<span class="content"><textarea name="text" rows="3" cols="15">'.$linkus_settings.'</textarea></span>';
$content .= '<br /><br />';
$content .= '<a href="modules.php?name=Link_Us">View All Buttons</a><br />';
// Future Developement:
//if($config['User_submit'] == 1){ $content .= '<a href="modules.php?name=Link_Us?&op=submitbutton">Submit Button</a><br />'; }
//$content .= '<a href="modules/Link_Us/admin/inc/button_add.php">Submit Button</a><br />';
$content .= '</center>';
$content .= '<hr noshade>';
if($config['marquee'] == 1){
$content .= "<marquee direction='".$direction."' scrollamount='".$amount."' height='".$height."' onMouseover='this.stop()' onMouseout='this.start()'>";
}
$result = $db->sql_query("SELECT `id`, `site_name`, `site_url`, `site_image`, `site_hits` FROM ".$prefix."_link_us WHERE `site_status` = '1' AND `button_type`='1' OR `button_type`='3' ORDER BY id DESC");
while (list($id, $site_name, $site_url, $site_image, $site_hits) = $db->sql_fetchrow($result)) {
$content .= "<br /><center><a href='modules.php?name=Link_Us&op=visit&id=$id' target='_blank'><img src='".$site_image."' ".$settings." title='".$site_name."'></a>";
	if($config['show_clicks'] == 1){$clicks = "<br />(Clicks ".$site_hits." )";}
elseif($config['show_clicks'] == 0){$clicks = "";}
$content .= "".$clicks."";
$content .= "<br />".$seperation."</center>";}
if($config['marquee'] == 1){
$content .= "</marquee>";
}
$content .= "<br /><div align='center'>&copy;&nbsp;<a href='http://www.darkforgegfx.com' alt='DarkForge GFX' title='DarkForge GFX' target='_blank'>DarkForgeGFX</a></div>";
?>
