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
$reviewsnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_cart_products_reviews WHERE date_published = '0000-00-00 00:00:00'")); 
$content = "<strong>·</strong> <a href=\"admin.php?op=CartProductReviewPendingList\">"._WREVIEWS."</a>: $reviewsnum";
$content .= "<br />";
$ordersnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_cart_orders WHERE viewDate='0000-00-00 00:00:00' and fileOrder='0'")); 
$content .= "<strong>·</strong> <a href=\"admin.php?op=CartOrders\">New Orders</a>: $ordersnum";
?>
