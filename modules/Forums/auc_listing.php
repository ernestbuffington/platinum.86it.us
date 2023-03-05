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

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

if ($popup != "1") {
	$module_name = basename(dirname(__FILE__));
	require_once("modules/".$module_name."/nukebb.php");
} else {
	$phpbb_root_path = 'modules/Forums/';
}
define('IN_PHPBB', true); 
include_once($phpbb_root_path . 'extension.inc'); 
include_once($phpbb_root_path . 'common.'.$phpEx); 
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_auc.' . $phpEx);

// Start session management 
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata); 
// End session management 

		$group = (!empty($_POST['id'])) ? $_POST['id'] : $_GET['id']; 
		$exist = $_GET['group'];		
	
   		$template->set_filenames(array('body' => 'auc_listing_body.tpl') );	
		
		if($exist)
			{
			if($exist == "admins") 
				{
			$group_name = str_replace("%s", "", $lang['Admin_online_color']);		
			$g 			= ADMIN;
				}
			elseif($exist == "mods") 
				{
			$group_name = str_replace("%s", "", $lang['Mod_online_color']);
			$g 			= MOD;
				}
			elseif($exist == "less_admins") 
				{
			$group_name = str_replace("%s", "", $lang['Super_Mod_online_color']);	
			$g 			= LESS_ADMIN;
				}
									
		    $template->assign_vars(array(
			 "T_L" 		=> $lang['listing_left'], 
			 "T_C_2" 	=> $group_name, 
			 "T_R" 		=> $lang['listing_right'])
			 	); 
			 
		$i = 1;
					 										 	  
			$q = "SELECT * 
		 	   	  FROM ". USERS_TABLE ." 
           	   	  WHERE user_level = '". $g ."' 
              	  ORDER BY user_id ASC"; 
			$r 			= $db->sql_query($q);
			while($row1 = $db->sql_fetchrow($r))
				{
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2']; 
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2']; 
		
		$msn 		= ($row1['user_msnm']) ? '<a href="mailto: '. $row1['user_msnm'] .'"><img src="'. $images['icon_msnm'] .'" alt="'. $lang['MSNM'] .'" title="'. $lang['MSNM'] .'" border="0" /></a>' : '';
		$yim 		= ($row1['user_yim']) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target='. $row1['user_yim'] .'&amp;.src=pg"><img src="'. $images['icon_yim'] .'" alt="'. $lang['YIM'] .'" title="'. $lang['YIM'] .'" border="0" /></a>' : '';
		$aim 		= ($row1['user_aim']) ? '<a href="aim:goim?screenname='. $row1['user_aim'] .'&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] .'" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$icq 		= ($row1['user_icq']) ? '<a href="http://wwp.icq.com/scripts/contact.dll?msgto='. $row1['user_icq'] .'"><img src="' . $images['icon_icq'] .'" alt="'. $lang['ICQ'] .'" title="' . $lang['ICQ'] .'" border="0" /></a>' : '';	   
		$www 		= ($row1['user_website']) ? '<a href="'. $row1['user_website'] .'" target="_userwww"><img src="'. $images['icon_www'] . '" alt="'. $lang['Visit_website'] .'" title="'. $lang['Visit_website'] .'" border="0" /></a>' : '';
		$mailto 	= ($board_config['board_email_form']) ? append_sid("profile.$phpEx?mode=email&amp;". POST_USERS_URL .'='. $row1['user_id']) : 'mailto:'. $row1['user_email'];			
		$mail	 	= ($row1['user_email']) ? '<a href="'. $mailto .'"><img src="'. $images['icon_email'] .'" alt="'. $lang['Send_email'] .'" title="'. $lang['Send_email'] .'" border="0" /></a>' : '';
		$pmto	 	= append_sid("privmsg.$phpEx?mode=post&amp;". POST_USERS_URL ."=$row1[user_id]");
		$pm 		= '<a href="'. $pmto .'"><img src="'. $images['icon_pm'] .'" alt="'. $lang['Send_private_message'] .'" title="'. $lang['Send_private_message'] .'" border="0" /></a>';
		$pro 		= append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL ."=$row1[user_id]");
		$profile 	= '<a href="'. $pro .'"><img src="'. $images['icon_profile'] .'" alt="'. $lang['Profile'] .'" title="'. $lang['Profile'] .'" border="0" /></a>';		
		
		$info 		= $profile ." ". $pm;
		if($msn)	$info .= " ". $msn;
		if($yim)	$info .= " ". $yim;
		if($aim) 	$info .= " ". $aim;
		if($icq)	$info .= " ". $icq;
		if($www)	$info .= " ". $www;
		if($mail)	$info .= " ". $mail;
		
			if ($row1['user_level'] == ADMIN)
				$style_color = '#' . $theme['fontcolor3'];
			elseif ($row1['user_level'] == MOD)
				$style_color = '#' . $theme['fontcolor2'];
			elseif ($row['user_level'] == LESS_ADMIN)
				$style_color = '#' . $theme['fontcolor4'];
					
		    $template->assign_block_vars("colors", array(
			 "USER" 		=> "<font color='". $style_color ."'>". $row1['username'] ."</font>", 
			 "ROW_CLASS"	=> $row_class,
			 "INFO_LINE"	=> $info)
			 		); 
			$i++;		
				}			
			}
		elseif ($group)
			{ 
         $sql = "SELECT * 
		 		 FROM ". $prefix ."_bbadvanced_username_color
            	 WHERE group_id = '". $group ."' "; 
			if (!$result = $db->sql_query($sql)) 
    	    	message_die(GENERAL_ERROR, "Error Selecting Group Name.", "", __LINE__, __FILE__, $sql); 
			$row = $db->sql_fetchrow($result);
			 
		$i = 1;
					 										 	  
			$q = "SELECT * 
		 	   	  FROM ". USERS_TABLE ." 
           	   	  WHERE user_color_gi <> '' 
              	  ORDER BY username ASC"; 
			$r 		= $db->sql_query($q);
			$row1 	= $db->sql_fetchrowset($r);
			
			for ($a = 0; $a < count($row1); $a++)
				{
				if (!$row1[$a]['user_id'])
					break;
										
				if (preg_match('/--'. $group .'--/', $row1[$a]['user_color_gi']))
					{
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2']; 
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2']; 
				
				$msn 		= ($row1[$a]['user_msnm']) ? '<a href="mailto: '. $row1[$a]['user_msnm'] .'"><img src="'. $images['icon_msnm'] .'" alt="'. $lang['MSNM'] .'" title="'. $lang['MSNM'] .'" border="0" /></a>' : '';
				$yim 		= ($row1[$a]['user_yim']) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target='. $row1[$a]['user_yim'] .'&amp;.src=pg"><img src="'. $images['icon_yim'] .'" alt="'. $lang['YIM'] .'" title="'. $lang['YIM'] .'" border="0" /></a>' : '';
				$aim 		= ($row1[$a]['user_aim']) ? '<a href="aim:goim?screenname='. $row1[$a]['user_aim'] .'&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] .'" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
				$icq 		= ($row1[$a]['user_icq']) ? '<a href="http://wwp.icq.com/scripts/contact.dll?msgto='. $row1[$a]['user_icq'] .'"><img src="' . $images['icon_icq'] .'" alt="'. $lang['ICQ'] .'" title="' . $lang['ICQ'] .'" border="0" /></a>' : '';	   
				$www 		= ($row1[$a]['user_website']) ? '<a href="'. $row1[$a]['user_website'] .'" target="_userwww"><img src="'. $images['icon_www'] . '" alt="'. $lang['Visit_website'] .'" title="'. $lang['Visit_website'] .'" border="0" /></a>' : '';
				$mailto 	= ($board_config['board_email_form']) ? append_sid("profile.$phpEx?mode=email&amp;". POST_USERS_URL .'='. $row1[$a]['user_id']) : 'mailto:'. $row1[$a]['user_email'];			
				$mail	 	= ($row1[$a]['user_email']) ? '<a href="'. $mailto .'"><img src="'. $images['icon_email'] .'" alt="'. $lang['Send_email'] .'" title="'. $lang['Send_email'] .'" border="0" /></a>' : '';
				$pmto	 	= append_sid("privmsg.$phpEx?mode=post&amp;". POST_USERS_URL ."=". $row1[$a]['user_id']);
				$pm 		= '<a href="'. $pmto .'"><img src="'. $images['icon_pm'] .'" alt="'. $lang['Send_private_message'] .'" title="'. $lang['Send_private_message'] .'" border="0" /></a>';
				$pro 		= append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL ."=". $row1[$a]['user_id']);
				$profile 	= '<a href="'. $pro .'"><img src="'. $images['icon_profile'] .'" alt="'. $lang['Profile'] .'" title="'. $lang['Profile'] .'" border="0" /></a>';				
				$info 		= $profile .' '. $pm;
				
					if ($msn)
						$info .= ' '. $msn;
					if ($yim)	
						$info .= ' '. $yim;
					if ($aim) 
						$info .= ' '. $aim;
					if ($icq)	
						$info .= ' '. $icq;
					if ($www)
						$info .= ' '. $www;
					if ($mail)
						$info .= ' '. $mail;
			
				$i++;
						
				$template->assign_block_vars('colors', array(
					 'USER' 		=> CheckUsernameColor($row1[$a]['user_color_gc'], $row1[$a]['username']), 
					 'ROW_CLASS'	=> $row_class,
					 'INFO_LINE'	=> $info)
						); 
					}	
				}
			}
		else
			redirect('index.'. $phpEx, TRUE);
		
			if ($i == 1)
				message_die(GENERAL_MESSAGE, sprintf($lang['listing_none'], '<strong>'. $row['group_name'] .'</strong>'));
				
	$template->assign_vars(array(
		"T_L" 		=> $lang['listing_left'], 
		"T_C_2" 	=> $row['group_name'], 
		"T_R" 		=> $lang['listing_right'])
			); 
							
// Generate page
include_once('includes/page_header.'.$phpEx);
$template->pparse('body');
include_once('includes/page_tail.'.$phpEx);
?>
