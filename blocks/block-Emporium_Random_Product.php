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
$result = $db->sql_query("select * from ".$prefix."_cart_products where prodActive='1'");
$numrows = $db->sql_numrows($result);
if($numrows == 0) {
	$content = ""._EMPORIUM_BLOCK_RANDOMPRODUCT_NOPRODUCTS."";
} else {
	srand((double)microtime()*1000000);
	while ($random = rand(1,$numrows)) {
		$random = $random - 1;
		$prodID = $db->sql_fetchrow($db->sql_query("SELECT prodID FROM ".$prefix."_cart_products WHERE prodActive='1' LIMIT $random, 1"));
		$product = cartproductinfo($prodID['prodID']);
		if ($product['prodActive']=='1') {
			$content = "<center>";
			if ($product['pthumb'] != ""){
				$content .= "<a href=\"modules.php?name=$module_name&file=product&c_op=viewprod&prodID=$product[prodID]\"><img src=\"".$cartconfig->value("thumbFolder")."$product[pthumb]\" width=\"".$cartconfig->value("thumbWidth")."\" border=\"0\" vspace=\"3\" hspace=\"3\"></a><br />";
        	}
			$content .= "<a href=\"modules.php?name=$module_name&file=product&c_op=viewprod&prodID=$product[prodID]\">$product[prodName]</a><br>".price_format(cartproductcost($product['prodID']))."<br />";
			$content .= "</center>";
			break; 
		}
	}
}
?>
