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
if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require_once("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
}
define('IN_PHPBB', true);
if ( (isset($_GET['mode']) && ($_GET['mode'] == 'viewprofile')) || (isset($_POST['mode']) && ($_POST['mode'] == 'viewprofile')) )
{
	define('IN_CASHMOD', true);
	define('CM_VIEWPROFILE',true);
}
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PROFILE, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}
else
{
	$sid = '';
}
//
// Set default email variables
//
$script_name = 'modules.php?name=Forums&file=profile';
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
$server_url = $server_protocol . $server_name . $server_port . $script_name;
// -----------------------
// Page specific functions
//
function gen_rand_string($hash)
{
	$rand_str = dss_rand();
	return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
}
//
// End page specific functions
// ---------------------------
//
// Start of program proper
//
if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
        $mode = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
        $mode = htmlspecialchars($mode);
        if ( $mode == 'viewprofile' )
        {
                include_once("includes/usercp_viewprofile.php");
                exit;
        }
        else if ( $mode == 'editprofile' || $mode == 'register' )
        {
                if ( !$userdata['session_logged_in'] && $mode == 'editprofile' )
                {
                    $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
                    header($header_location . append_sid("login.$phpEx?redirect=profile.$phpEx&mode=editprofile", true));
                    exit;
                }
                include_once("includes/usercp_register.php");
                exit;
        }
/*****************************************************/
/* Forum - Signature Editor Deluxe v.1.1.0     START */
/*****************************************************/
        else if ( $mode == 'signature' )
        {
            if ( !$userdata['session_logged_in'] && $mode == 'signature' )
            {
                $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
                header($header_location . append_sid("login.$phpEx?redirect=profile.$phpEx&mode=signature", true));
                exit;
            }
            include_once("includes/usercp_signature.php");
            exit;
        }
/*****************************************************/
/* Forum - Signature Editor Deluxe v.1.1.0       END */
/*****************************************************/
	else if ( $mode == 'confirm' )
	{
		// Visual Confirmation
		if ( $userdata['session_logged_in'] )
		{
			exit;
		}
		include_once('includes/usercp_confirm.'.$phpEx);
		exit;
	}
	else if ( $mode == 'sendpassword' )
	{
		include_once('includes/usercp_sendpasswd.'.$phpEx);
		exit;
	}
	else if ( $mode == 'activate' )
	{
		include_once('includes/usercp_activate.'.$phpEx);
		exit;
	}
	else if ( $mode == 'email' )
	{
		include_once('includes/usercp_email.'.$phpEx);
		exit;
	}
}
redirect(append_sid("index.$phpEx", true));
?>