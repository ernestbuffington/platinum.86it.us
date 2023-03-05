<?php
######################################################################
# Emporium 2.3.5
######################################################################
# Copyright (c) 2004 by Michael Squires
# http://www.burnwave.com/
######################################################################
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
global $db, $prefix, $ab_config;
$module_name = "Shopping_Cart";
require_once("modules/$module_name/includes/minicore.php");
get_lang($module_name);
global $cartconfig;
$userinfo = cartuserinfo();
$currencies = $db->sql_query("SELECT currID, currency, currname FROM ".$prefix."_cart_currencies WHERE active='1' ORDER BY currency");
$content = "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><form method=\"post\" action=\"modules.php\"><input type=\"hidden\" name=\"name\" value=\"$module_name\"><input type=\"hidden\" name=\"file\" value=\"account\"><input type=\"hidden\" name=\"c_op\" value=\"setUserCurrency\"><tr><td align=center><select name=\"currID\" class=\"content\" onChange=\"submit()\">";
if($userinfo['myCurr'] == 0){ $sel = "SELECTED"; } else { $sel = ""; }
$content .= "<OPTION VALUE=\"0\" $sel>"._EMPORIUM_BLOCK_CURRENCIES_DEFAULTCURRENCY."";
while (list($currID, $currency, $currname) = $db->sql_fetchrow($currencies)) {
	if ($currID == $userinfo['myCurr']) { $sel = " SELECTED"; } else { $sel = ""; }
	$content .= "<option value=\"$currID\" $sel>$currency";
}
$content .= "</select></td></tr></form></table>";
$content .= "</center>";
?>
