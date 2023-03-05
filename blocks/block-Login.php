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
    Header('Location: ../index.php');
    die();
}
global $admin, $user, $sitekey, $gfx_chk, $admin_file;
$content  = '<form onsubmit="this.submit.disabled=\'true\'" action="modules.php?name=Your_Account" method="post">';
$content .= '<center><font class="content">'._NICKNAME.'<br />';
$content .= '<input type="text" name="username" size="10" maxlength="25" /><br />';
$content .= _PASSWORD.'<br />';
$content .= '<input type="password" name="user_password" size="10" maxlength="20" /><br />';
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
$content .= security_code(array(2,4,5,7), 'stacked');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
$content .= '<br />';
$content .= '<input type="hidden" name="op" value="login" />';
$content .= '<input id="login_submit" type="submit" value="'._LOGIN.'" /></font></center></form>';
$content .= '<center><font class="content">'._ASREGISTERED.'</font></center>';
if (is_admin($admin) AND is_user($user)) {
    $content = '<center>'._ADMIN.'<br />[ <a href="'.$admin_file.'.php?op=logout">'._LOGOUT.'</a> ]</center>';
}
?>
