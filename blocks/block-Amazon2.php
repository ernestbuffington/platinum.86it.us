<?php
# $Author: ejd $
# $Date: 2004/2/7 12:25:00 $
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
$SQL = "SELECT node, catalog FROM ".$prefix."_amazon_nodes where pnode is not null and locale = '$AMZLocale' order by RAND() LIMIT 1";
$result = $db->sql_query($SQL);
list($node, $catalog) = $db->sql_fetchrow($result);
$mode = Get_Cat_Mode($catalog);
$amazon = amazon_search('BrowseNodeSearch', $node, $mode, 'lite', '');
#$content = "<a name= \"scrollingCode\"></a>";
#$content .="<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"220\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>";
$content ="<div align=\"center\">\n";
$AMZ_Count = count($amazon->records);
if ($AMZ_Count < 1)
{
# No Similar Data is Available. Then use the default ASIN.
	$Asin = $AMZDefault_Asin;
	$amazon = amazon_search('SimilaritySearch', $Asin, '', 'lite', 1);
}
foreach($amazon->records as $ind => $arr)
{
# Extract fields of interest but first clear from previews pass.
	$Asin          = "";
	$ProductName   = "";
	$OurPrice      = "";
	$ListPrice     = "";
	$ImageUrl      = "";
	$Asin          = $arr['asin'];
	$ProductName   = $arr['productname'];
	$OurPrice      = $arr['ourprice'];
	$ListPrice     = $arr['listprice'];
	$Savings       = AMZsavings($ListPrice,$OurPrice);
	$ImageUrl      = $arr['imageurlsmall'];
	if ($Savings[1] > 0  && $AMZImgType != "NO")
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
	$prodName = $arr['productname'];
	if (strlen($prodName) > 50)
	{
		$prodName = rtrim(substr($prodName, 0, 50)).'&nbsp;...';
	}
	$content .=  $LinkStartStr;
	$content .=  "<strong>$ProductName</strong>";
	$content .=  "</a>";
	$content .=  "<br />\n";
	$content .=  $LinkStartStr;
	$content .=  "<img src=\"" . $ImageUrl . "\" vspace=\"2\" border =\"0\" alt=\"$ProductName\"></a>\n";
	$content .=  "<br />\n";
	if  ($arr['ourprice'] != '')
	{
		$OurPrice = AMZRemoveCurrency($arr['ourprice']);
		if (strtolower($OurPrice) == "too low to display")
		{
			$OurPrice = "" . _AMZTOOLOW . "";
		}
	}
	if ($arr['listprice'] != '')
	{
		$listprice = AMZRemoveCurrency($arr['listprice']);
	}
	$AMZCurrency = AMZGetCurrency();
	if ($listprice > $ourprice)
	{
		$content .= "" . _AMZBLKLSTPRICE . ": <strong>" . $AMZCurrency . "</strong><strike><strong>$listprice</strong></strike><br />";
	}
	$content .= "" . _AMZBLKPRICE . ": <font color=\"DarkRed\"><strong>" . $AMZCurrency . "</strong><strong>$OurPrice</strong></font><p>";
}
$content .="</div>";
?>
