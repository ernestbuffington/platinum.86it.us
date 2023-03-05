<?php
# $Author: ejd $
# $Date: 2004/04/24 6:02:49 PM $
/*******************************************************************************/
/* PHP-NUKE Addon : NukeAmazon Module                                          */
/* ==================================                                          */
/* Version: 2.7                                                                */
/* Copyright (c)2002-2004 by Edgardo J. Diaz (ejdiaz@preciogasolina.com)       */
/* http://preciogasolina.com                                                   */
/*                                                                             */
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
global $temp, $prefix, $db, $currentlang, $lang, $language, $newlang, $ab_config;
# Amazon Module Configuration
	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");
	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);
require_once("includes/NukeAmazon/functions.php");
if (isset($newlang))
{
	include_once("modules/$AMZModule_Name/language/lang-$newlang.php");
	$language = $newlang;
}
elseif (isset($lang))
{
    include_once("modules/$AMZModule_Name/language/lang-$lang.php");
    $language = $lang;
}
else
{
   include_once("modules/$AMZModule_Name/language/lang-$language.php"); 
}
	$Asin = GetAsin('');
	$amazon = amazon_search('AsinSearch', $Asin, '', 'lite', '');
	if(isset($amazon->errorMsg)) 
	{
	# Error with Requested Data, use the default ASIN.
		$Asin = $AMZDefault_Asin;
		$amazon = amazon_search('AsinSearch', $Asin, '', 'lite', '');
	}
	$isql = "update ".$prefix."_amazon_items set imp = imp + 1 where asin = '$Asin'";
	$iresult = $db->sql_query($isql);
	foreach ($amazon->records as $ind => $arr) {
# Extract fields of interest but first clear from previews pass.
		$ProductCatalog        = $arr['catalog'];
		if( is_array($arr['artist']))
		{
			$ArtistCount = count($arr['artist']);
			$Artist = "";
			$i = 0;
			while ($ArtistCount > $i)
			{
				if ($i > 0)
				{
					$Artist .= ", ";
				}
				$Artist .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ArtistSearch&amp;keyword=".urlencode($arr['artist'][$i])."&amp;mode=".strtolower($ProductCatalog)."\">".$arr['artist'][$i]."</a>";
				$i++;
			}
		}
		$ProductName           = $arr['productname'];
		$OurPrice              = $arr['ourprice'];
		if ($OurPrice == "")
		{
			$OurPrice = $arr['listprice'];
		}
		$ListPrice           = $arr['listprice'];
		$Savings             = AMZsavings($ListPrice,$OurPrice);
		if (strtolower($OurPrice) == "too low to display") 
		{
			$OurPrice = ""._AMZTOOLOW."";
		}
	}
	$ImageUrl = AMZIS($Asin, 'M');
	if ($Savings[1] > 0 && $AMZImgType != "NO")
	{
		if ($Savings[1] > 9)
		{
			$ImageUrl = str_replace (".01.", ".01._PE".$Savings[1]."_".$AMZImgType."_SC", $ImageUrl);
		}
		else
		{
			$ImageUrl = str_replace (".01.", ".01._PE0".$Savings[1]."_".$AMZImgType."_SC", $ImageUrl);
		}
		$ImageUrl = str_replace (".jpg", "_.jpg", $ImageUrl);
	}
	$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=$Asin";
	$LinkStartStr = "<a href=\"$LinkURL\">";
	$content = "<table width=\"149\"><tr><td width=\"149\" align=\"center\">\n";
	if ($Artist)
	{
		$content .= "<strong>" . $Artist . "</strong><br /><br />\n";
	}
	$content .=  $LinkStartStr;
	$content .=  "<img src=\"" . $ImageUrl . "\" border =\"0\" alt=\"$ProductName\">\n";
	$content .=  "</a><br />";
	$content .=  $LinkStartStr;
	$content .=  "<strong>$ProductName</strong>";
	$content .=  "</a>";
	$content .=  "<br />";
	if ($OurPrice)
	{
		$content .=  "<strong>"._AMZBLKPRICE.":</strong> $OurPrice</strong><br />\n";
	}
	if ($AMZBuyBox)
	{
		$content .= AMZBuyBox($Asin);
	}
	$content .=  "</td>";
	$content .=  "</tr>";
	$content .=  "</table>";
# Log
# 2.7 Fixed Impressions not counting.  Updated HTML.
?>
