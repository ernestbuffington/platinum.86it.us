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
$quantity=0;
$prodTotal=0;
$result = $db->sql_query("SELECT itemID, prodID, optID, qty FROM ".$prefix."_cart_cartitems WHERE userID='$userinfo[user_id]' AND userType='$userinfo[type]'");
$c = 0;
while (list($iid, $sid, $optID, $qty) = $db->sql_fetchrow($result)) {
	$c++;
	$product = cartproductinfo($sid);
	$item = cartiteminfo($iid);
	$cost = $item['itemcost'];
	$total = $cost * $qty; 
	$prodTotal = $prodTotal + $total;
	$quantity = $quantity + $qty;
}
$content = "<center>";
if ($c == 0) { 
	$content .= "<i>"._EMPORIUM_BLOCK_CONTENTS_CARTISEMPTY."</i><br /><br />[ <a href=\"modules.php?name=$module_name\">"._EMPORIUM_BLOCK_CONTENTS_BROWSECATALOG."</a> ]"; 
} else {
	$content .= ""._EMPORIUM_BLOCK_CONTENTS_YOUHAVE."<strong>$quantity</strong>"._EMPORIUM_BLOCK_CONTENTS_CARTITEMS."<br />";
	$content .= "<strong>"._EMPORIUM_BLOCK_CONTENTS_PRODUCTTOTAL."".price_format($prodTotal)."</strong><br /><br />";
	$content .= "[ <a href=\"modules.php?name=$module_name&file=cart&c_op=showCart\">"._EMPORIUM_BLOCK_CONTENTS_CARTVIEW."</a> | ";
	$content .= "<a href=\"modules.php?name=$module_name&file=cart&c_op=emptyCart\">"._EMPORIUM_BLOCK_CONTENTS_EMPTYCART."</a> ]<br />";
	$content .= "[ <a href=\"modules.php?name=$module_name\">"._EMPORIUM_BLOCK_CONTENTS_BROWSECATALOG."</a> | <a href=\"modules.php?name=$module_name&file=checkout&c_op=Checkout\">"._EMPORIUM_BLOCK_CONTENTS_CHECKOUT."</a> ]";
}
?>
