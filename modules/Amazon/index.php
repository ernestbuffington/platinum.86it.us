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

$AMZCodeVer = "2.7.2";
if(!isset($_COOKIE['AMZCartID']))
{
	$AMZCartID = md5(uniqid(rand()));
	setcookie("AMZCartID", $AMZCartID, time() + 31536000);
}
else
{
	$AMZCartID = $_COOKIE['AMZCartID'];
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$AMZStore_Name = "Store";
$pagetitle = "- $AMZStore_Name";
#$index = 1;

require_once("includes/NukeAmazon/functions.php");

$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");

if ($result)
{
	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);
}

function Home()
{
    global $module_name, $db, $prefix, $AMZSingle, $admin, $AMZVer, $pagetitle, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2;

	AMZCacheClear();
	include_once("header.php");
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
	include_once("includes/NukeAmazon/js.php");

	AMZtitle("" . _AMZSTORE . "");

	OpenTable();
	AMZSearchForm();
	CloseTable();
	echo "<br />";

	OpenTable();
	show_all_catalog();
	CloseTable();
	echo "<br />";

	OpenTable();
	show_catalog();
	CloseTable();
	echo "<br />";

	OpenTable();
	echo "<center><strong>" . _AMZPRICENOTICE . "</strong></center>";
	CloseTable();

## START of Copyright notice ######################################################
# This software displays a copyright notice with the words:                       #
# "Powered by NukeAmazon [version number] © 2004 PrecioGasolina.com Amazon ©",    #
# to comply with the GNU/GPL license.  If you wish to use this interactive        #
# software without the copyright notice in it's output send e-mail to             #
# ejdiaz@preciogasolina.com to purchase a software package with out the copyright #
# notice.                                                                         #
###################################################################################
    $cpname = preg_replace("/_/", "/ /", $module_name);
	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\" >";
	echo "<tr><td align = left>";
    echo "Powered by <a href=\"http://preciogasolina.com/nukeamazon.html\">NukeAmazon</a> $AMZVer © 2004 <a href=\"http://preciogasolina.com\">PrecioGasolina.com</a>";
	echo "</td><td align = right>";
	echo "<a href=\"javascript:creditwindow()\">$cpname &copy;</a>";
	echo "</td></tr></table>";
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
## END of Copyright notice ########################################################
	include_once("footer.php");

}

function Amazon($asin)
{
    global $module_name, $db, $prefix, $AMZSingle, $admin, $AMZVer, $pagetitle, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $AMZStore_Name, $AMZCodeVer;

	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");

	if ($result)
	{
		list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);
	}

	$result = $db->sql_query("select count(*) from " . $prefix . "_amazon_items");
	$AMZ_Test_Items = false;
	if ($result)
	{
		list($AMZ_Test_Items) = $db->sql_fetchrow($result);
	}

	if ($AMZVer != $AMZCodeVer)
	{
		include_once("header.php");
		OpenTable();
		echo "<font class=\"title\"><center>There seems to be a problem with this module.<br />Please come back later.<br />Thank You.</center></font><br />";
		CloseTable();
		echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
		echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
		include_once("footer.php");
		die;
	}

	AMZCacheClear();

	if ($asin == "")
	{
		include_once("header.php");
	    include_once("includes/NukeAmazon/js.php");

		AMZtitle("" . _AMZSTORE . "");

		OpenTable();
		AMZSearchForm();
		CloseTable();
		echo "<br />";

		OpenTable();
		show_catalog();
		CloseTable();
		echo "<br />";

		OpenTable();
		show_all_catalog();
		CloseTable();
		echo "<br />";
	}
	else
	{
		$book_detail = get_book_details($asin);
		$pagetitle = "- " . $AMZStore_Name . " - " . $book_detail['productname'][0];
		include_once("header.php");
	    include_once("includes/NukeAmazon/js.php");

		$col = 1;
		$AMZpage = 1;
		$AMZType = 'heavy';
		$AMZMainProduct = true;
		$AmazonData = amazon_search('AsinSearch', $asin, '', $AMZType, $AMZpage);
		$ProductDetail = AmazonProductDetail($AmazonData, 'medium', $AMZMainProduct, $col, $AMZpage, '');

		$AMZType = 'lite';
		$searchmode = 'SimilaritySearch';
		$keyword = $asin;
		$mode = '';

		$AmazonSimilarData = amazon_search($searchmode, $keyword, $mode, $AMZType, $AMZpage);
		$Similar = AMZSimilar($AmazonSimilarData);

		AMZtitle("" . _AMZSTORE . "");

		OpenTable();
		AMZSearchForm();
		echo "<table><tr><td width=\"80%\" valign=\"top\">";
		echo $ProductDetail;
		echo "</td><td width=\"20%\" valign=\"top\">";
		echo $Similar;
		echo "</td></tr></table>";
		CloseTable();
		echo "<br />";
		OpenTable();
		show_catalog();
		CloseTable();
		echo "<br />";
	}

	OpenTable();
	echo "<center><strong>" . _AMZPRICENOTICE . "</strong></center>";
	CloseTable();
## START of Copyright notice ######################################################
# This software displays a copyright notice with the words:                       #
# "Powered by NukeAmazon [version number] © 2004 PrecioGasolina.com Amazon ©",    #
# to comply with the GNU/GPL license.  If you wish to use this interactive        #
# software without the copyright notice in it's output send e-mail to             #
# ejdiaz@preciogasolina.com to purchase a software package with out the copyright #
# notice.                                                                         #
###################################################################################
    $cpname = preg_replace("/_/", "/ /", $module_name);
	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\" >";
	echo "<tr><td align = left>";
    echo "Powered by <a href=\"http://preciogasolina.com/nukeamazon.html\">NukeAmazon</a> $AMZVer © 2004 <a href=\"http://preciogasolina.com\">PrecioGasolina.com</a>";
	echo "</td><td align = right>";
	echo "<a href=\"javascript:creditwindow()\">$cpname &copy;</a>";
	echo "</td></tr></table>";
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
## END of Copyright notice ########################################################
	include_once("footer.php");
}

function AmazonResults($searchmode, $keyword, $mode, $AMZpage)
{
    global $module_name, $db, $prefix, $AMZSingle, $admin, $AMZVer, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2;

	AMZCacheClear();
	include_once("header.php");
    include_once("includes/NukeAmazon/js.php");

	AMZtitle("" . _AMZSTORE . "");

	if (!isset($AMZpage))
	{
		$AMZpage = 1;
	}

	$col = 2;
	$AMZType = 'lite';
	$AMZMainProduct = false;

	OpenTable();
	AMZSearchForm();

	echo "<center><font class=\"title\"><strong>" . _AMZSEARCHR . "</strong></font></center><br />";

	$keyword = str_replace("{", "(", $keyword);
	$keyword= str_replace("}", ")", $keyword);

	echo "" . _AMZYOURSEARCH . ": <strong>";
	if ($searchmode == 'BrowseNodeSearch')
	{
		echo node_desc($keyword);
	}
	else
	{
		echo $keyword;
	}
	echo "</strong><br /><br />";
	$AmazonData = amazon_search($searchmode, $keyword, $mode, $AMZType, $AMZpage);

	$AMZSEARCH = array ($searchmode, $keyword, $mode, $AMZpage);

	echo AmazonProductDetail($AmazonData, 'medium', $AMZMainProduct, $col, $AMZSEARCH);
	CloseTable();

	echo "<br />";

	OpenTable();
	echo "<center><strong>" . _AMZPRICENOTICE . "</strong></center>";
	CloseTable();
## START of Copyright notice ######################################################
# This software displays a copyright notice with the words:                       #
# "Powered by NukeAmazon [version number] © 2004 PrecioGasolina.com Amazon ©",    #
# to comply with the GNU/GPL license.  If you wish to use this interactive        #
# software without the copyright notice in it's output send e-mail to             #
# ejdiaz@preciogasolina.com to purchase a software package with out the copyright #
# notice.                                                                         #
###################################################################################
    $cpname = preg_replace("/_/", "/ /", $module_name);
	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\" >";
	echo "<tr><td align = left>";
    echo "Powered by <a href=\"http://preciogasolina.com/nukeamazon.html\">NukeAmazon</a> $AMZVer © 2004 <a href=\"http://preciogasolina.com\">PrecioGasolina.com</a>";
	echo "</td><td align = right>";
	echo "<a href=\"javascript:creditwindow()\">$cpname &copy;</a>";
	echo "</td></tr></table>";
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
## END of Copyright notice ########################################################
	include_once("footer.php");

}

function ShowFI($catalog, $AMZpage)
{
    global $module_name, $db, $prefix, $AMZSingle, $admin, $AMZVer, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2;

	$catalog = urldecode($catalog);
	AMZCacheClear();

	include_once("header.php");
    include_once("includes/NukeAmazon/js.php");

	AMZtitle("" . _AMZSTORE . "");

	if (!isset($AMZpage))
	{
		$AMZpage = 1;
	}

	$col = 2;
	$AMZType = 'lite';
	$AMZMainProduct = false;
	OpenTable();
	AMZSearchForm();
	$perpage = 10;
	$AMZ_SQL = "select asin from ".$prefix."_amazon_items where category = '". $catalog . "' order by hits DESC";
	$result = $db->sql_query($AMZ_SQL);
	$total_rows = $db->sql_numrows($result);

	$keyword = explode(":", featured_search($catalog, $AMZpage));
	$AMZTotal = $keyword[0];
	echo "<br /><center>";
	$AmazonData = amazon_search('AsinSearch', $keyword[1], $catalog, $AMZType, $AMZpage);
	$AMZSEARCH = array ($searchmode, $keyword[1], $catalog, $AMZpage, $AMZTotal);
	echo AmazonProductDetail($AmazonData, 'medium', $AMZMainProduct, $col, $AMZSEARCH);
	echo "</center>";
	CloseTable();
	echo "<br />";
	OpenTable();
	echo "<center><strong>" . _AMZPRICENOTICE . "</strong></center>";
	CloseTable();
## START of Copyright notice ######################################################
# This software displays a copyright notice with the words:                       #
# "Powered by NukeAmazon [version number] © 2004 PrecioGasolina.com Amazon ©",    #
# to comply with the GNU/GPL license.  If you wish to use this interactive        #
# software without the copyright notice in it's output send e-mail to             #
# ejdiaz@preciogasolina.com to purchase a software package with out the copyright #
# notice.                                                                         #
###################################################################################
    $cpname = preg_replace("/_/", "/ /", $module_name);
	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\" >";
	echo "<tr><td align = left>";
    echo "Powered by <a href=\"http://preciogasolina.com/nukeamazon.html\">NukeAmazon</a> $AMZVer © 2004 <a href=\"http://preciogasolina.com\">PrecioGasolina.com</a>";
	echo "</td><td align = right>";
	echo "<a href=\"javascript:creditwindow()\">$cpname &copy;</a>";
	echo "</td></tr></table>";
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
## END of Copyright notice ########################################################
	include_once("footer.php");

}

function AmazonMarketResults($searchmode, $keyword, $mode, $AMZpage)
{
    global $module_name, $db, $prefix, $AMZSingle, $admin, $AMZVer, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2;
	AMZCacheClear();

	include_once("header.php");
    include_once("includes/NukeAmazon/js.php");

	AMZtitle("" . _AMZMARKET . "");

	if (!isset($AMZpage))
	{
		$AMZpage = 1;
	}

	$col = 2;
	$AMZType = 'heavy';
	$AMZMainProduct = true;

	OpenTable();
	AMZSearchForm();

	$AmazonData = amazon_search($searchmode, $keyword, $mode, $AMZType, $AMZpage);

	$AMZSEARCH = array ($searchmode, $keyword, $mode, $AMZpage);

	echo MarketPlaceDetail($AmazonData, 'medium', $AMZMainProduct, $col, $AMZSEARCH);

	CloseTable();

	echo "<br />";

	OpenTable();
	echo "<center><strong>" . _AMZPRICENOTICE . "</strong></center>";
	CloseTable();
## START of Copyright notice ######################################################
# This software displays a copyright notice with the words:                       #
# "Powered by NukeAmazon [version number] © 2004 PrecioGasolina.com Amazon ©",    #
# to comply with the GNU/GPL license.  If you wish to use this interactive        #
# software without the copyright notice in it's output send e-mail to             #
# ejdiaz@preciogasolina.com to purchase a software package with out the copyright #
# notice.                                                                         #
###################################################################################
    $cpname = preg_replace("/_/", " ", $module_name);
	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\" >";
	echo "<tr><td align = left>";
    echo "Powered by <a href=\"http://preciogasolina.com/nukeamazon.html\">NukeAmazon</a> $AMZVer © 2004 <a href=\"http://preciogasolina.com\">PrecioGasolina.com</a>";
	echo "</td><td align = right>";
	echo "<a href=\"javascript:creditwindow()\">$cpname &copy;</a>";
	echo "</td></tr></table>";
	echo "\n<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";
## END of Copyright notice ########################################################
	include_once("footer.php");
}

/********************************************/
/* Function to redirect the clicks to the   */
/* correct product url and add 1 click      */
/********************************************/
function clickproduct($asin)
{
    global $prefix, $db, $amazon_id, $AMZLocale, $amazon_token;

	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");

if ($result)
{
	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);
}

	$clickurl = "http://www.amazon.com";
	if ($AMZLocale == 'us')
	{
		$clickurl = "http://www.amazon.com";
	}
	elseif ($AMZLocale == 'uk')
	{
		$clickurl = "http://www.amazon.co.uk";
	}
	elseif ($AMZLocale == 'de')
	{
		$clickurl = "http://www.amazon.de";
	}
	elseif ($AMZLocale == 'jp')
	{
		$clickurl = "http://www.amazon.co.jp";
	}
	$clickurl .= "/exec/obidos/ASIN/$asin/$amazon_id" . "?dev-t=1ZQT1KGQZ3BAHG3Z22R2";

	if (AsinExist($asin))
	{
		$result = $db->sql_query("update ".$prefix."_amazon_items set clicks=clicks+1 where asin='$asin'");
	}
	else
	{
		if (AsinExistNF($asin))
		{
			$result = $db->sql_query("update " . $prefix . "_amazon_not_item set clicks=clicks+1 where asin='$asin'");
		}
		else
		{
			$result = $db->sql_query("insert into " . $prefix . "_amazon_not_item values (NULL, '$asin', '1', '1' )");
		}
	}

    Header("Location: $clickurl");
}

switch($op)
{

	default:
		Amazon($asin);
		break;
	case "home":
		Home();
		break;
	case "AsinSearch":
		Amazon($keyword);
		break;
	case "ShowFI":
		ShowFI($catalog, $AMZpage);
		break;
	case "MarketPlaceSearch":
		AmazonMarketResults('MarketPlaceSearch', $keyword, $mode, $AMZpage);
		break;
	case "SellerProfile":
		AmazonMarketResults('SellerProfile', $keyword, $mode, $AMZpage);
		break;
	case "ShowResults":
		AmazonResults('KeywordSearch', $keyword, $mode, $AMZpage);
		break;
	case "AuthorSearch":
		AmazonResults('AuthorSearch', $keyword, 'books', $AMZpage);
		break;
	case "ArtistSearch":
		AmazonResults('ArtistSearch', $keyword, 'music', $AMZpage);
		break;
	case "ActorSearch":
		AmazonResults('ActorSearch', $keyword, $mode, $AMZpage);
		break;
	case "DirectorSearch":
		AmazonResults('DirectorSearch', $keyword, $mode, $AMZpage);
		break;
	case "ManufacturerSearch":
		AmazonResults('ManufacturerSearch', $keyword, $mode, $AMZpage);
		break;
	case "BrowseNodeSearch":
		AmazonResults('BrowseNodeSearch', $keyword, $mode, $AMZpage);
		break;
	case "More":
		AmazonResults($searchmode, $keyword, $mode, $AMZpage);
		break;
	case "Add":
		AMZ_submit($asin);
		break;
	case "Del":
		AMZ_remove($asin);
		break;
	case "click":
		clickproduct($asin);
		break;
	case "AddToCart":
		AMZ_Cart($asin, $quantity, $save, $cartnode);
		break;
	case "ShowCart":
		AMZ_Cart($asin, $quantity, $save, $cartnode);
		break;
}
?>
