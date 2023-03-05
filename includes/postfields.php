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
if ( !defined('IN_PHPBB') )
{
        die("Hacking attempt");
        exit;
}
///////FIELDS MOD START///////////////
/*****************************************************************************/
/*     CONFIGURATION                                                         */
/*****************************************************************************/
$showfieldsarray = array('ALLFIELDS','Example1','_EXAMPLE2');//If ALLFIELDS appears in this array then all fields will be include_onced in posts, otherwise only those fields listed will be shown. Configure this yourself. If your field was preceded by the _ character (underscore) then this character should be include_onced.
/*****************************************************************************/
get_lang("Your_Account");
$ThemeSel = get_theme();
$customfields = "";
$id = $postrow[$i]['user_id'];
$result = $db->sql_query("SELECT * FROM ".$user_prefix."_users_field ORDER BY pos");
while ($sqlvalue = $db->sql_fetchrow($result)) 
{
	list($value) = $db->sql_fetchrow( $db->sql_query("SELECT value FROM ".$user_prefix."_users_value WHERE fid ='$sqlvalue[fid]' AND uid = '$id'"));
	if(in_array($sqlvalue[name], $showfieldsarray) || in_array('ALLFIELDS', $showfieldsarray))
	{
    	if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
	  	$public = $sqlvalue['public'];
		if((is_user($user)) || (is_admin($admin)))
		{
			$themeposter_fields = ($value != "" && $postrow[$i]['user_id'] != ANONYMOUS ) ? $name_exit . ': ' . $value : '';
    		$themeposter_fields = preg_replace("/.gif/", "", $themeposter_fields);
    		$themeposter_fields = "$themeposter_fields<br />";
		  	if ($public == "1")
	  		{
	  			$customfields .= $themeposter_fields;
  			}
  			elseif ($public == "0")
  			{
	  			if(is_admin($admin) || (($userdata['username'] == $cookie[1]) AND ($userdata['user_password'] == $cookie[2]) AND ($userdata['username'] == $postrow[$i]['username'])))
	  			{
		  			$customfields .= $themeposter_fields;
	  			}
	  			else
	  			{
		  			$customfields .= "";
	  			}
  			}
  			else
	  		{
	  			$customfields .= "";
	  		}  			
      	}
      	else
      	{
	     	$customfields .= ""; 
      	}
  	}
    else
    {
	    $customfields .= "";
    }
}
///////FIELDS MOD END/////////////
?>
