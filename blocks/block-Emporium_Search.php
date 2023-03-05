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
$content = "<center><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><form action=\"modules.php?name=$module_name&file=search\" method=\"post\"><tr><td align=center><font class=\"content\"><input type=\"text\" size=\"16\" name=\"query\" value=\"\"><br><input type=\"submit\" value=\""._EMPORIUM_BLOCK_SEARCH_SEARCH."\"></font><input type=\"hidden\" name=\"name\" value=\"$module_name\">";
$content .= "</td></tr></form></table></center>";
?>
