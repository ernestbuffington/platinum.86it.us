<?php
# $Author: ejd $
# $Date: 2004/04/24 5:33:08 PM $
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
# Number of Items per Row 
	$TCol = 4;
# Number of Rows 
	$TRow = 2;
# Total Items
	$TItems = $TCol * $TRow;
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
	$isql = "update ".$prefix."_amazon_items set imp = imp + 1 where asin = '$Asin'";
	$iresult = $db->sql_query($isql);
	$xi = 1;
	while ($xi < $TItems)
	{
		$NAsin = GetAsin('');
		$isql = "update ".$prefix."_amazon_items set imp = imp + 1 where asin = '$NAsin'";
		$iresult = $db->sql_query($isql);
		$Asin .= "," . $NAsin;
		$xi++;
	}
	$amazon = amazon_search('AsinSearch', $Asin, '', 'lite', '');
	if(isset($amazon->errorMsg)) 
	{
	# Error with Requested Data, use the default ASIN.
		$Asin = $AMZDefault_Asin;
		$amazon = amazon_search('AsinSearch', $Asin, '', 'lite', '');
		$isql = "update ".$prefix."_amazon_items set imp = imp + 1 where asin = '$Asin'";
		$iresult = $db->sql_query($isql);
	}
	$content = "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
	$AMZColWidth = 100 / $TCol;
	$AMZ_Col = 0;
	foreach ($amazon->records as $ind => $arr)
	{
		if ($AMZ_Col == 0) 
		{
			# Start Row
			$content .= "<tr>\n";
		}
		# Start Column
		$AMZ_Col++;
		$content .= "<td valign=\"top\" align=\"center\" width=\"$AMZColWidth" . "%\">\n";
		# Extract fields of interest but first clear from previews pass.
		$Asin           = "";
		$ProductCatalog = "";
		$ProductName    = "";
		$ProductDescription = "";
		$Author         = "";
		$UPC            = "";
		$OurPrice       = "";
		$ListPrice      = "";
		$UsedPrice      = "";
		$CollectiblePrice   = "";
		$ThirdPartyNewPrice = "";
		$Savings        = "";
		$UsedPrice      = "";
		$ImageUrl       = "";
		$SalesRank      = "";
		$Rating         = "";
		$ReleaseDate    = "";
		$Manufacturer   = "";
		$Mpaa           = "";
		$Actor          = "";
		$Director       = "";
		$TotalResults   = "";
		$Feature        = "";
		$Availability   = "";
		$Media			= "";
		$Isbn           = "";
		$NumberOfOfferings = "";
		$Artist            = "";
		$Asin                  = $arr['asin'];
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
		$ImageUrl = AMZIS($Asin, 'T');
		$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=$Asin";
		$LinkStartStr = "<a href=\"$LinkURL\">";
		$content .=  $LinkStartStr;
		$content .=  "<img src=\"" . $ImageUrl . "\" border =\"0\" alt=\"$ProductName\">\n";
		$content .=  "</a><br />";
		if ($Artist)
		{
			$content .= "<strong>" . $Artist . "</strong><br />\n";
		}
		$content .=  $LinkStartStr;
		$content .=  "<strong>$ProductName</strong></a><br />\n";
		if ($OurPrice)
		{
			$content .=  "<strong>"._AMZBLKPRICE.":</strong> $OurPrice<br />\n";
		}
		$content .=  "</td>";
		if ($AMZ_Col == $TCol) 
		{
			$content .= "</tr>\n";
			$AMZ_Col = 0;
		}
	}
	$content .=  "</table>";
# Log
# 2.7 Center Block Created.
?>
