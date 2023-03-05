<?php
# $Author: ejd $
# $Date: 10/27/2004 6:38 AM $

/*******************************************************************************/
/* PHP-NUKE Addon : NukeAmazon Module                                          */
/* ==================================                                          */
/* Version: 2.7.2                                                              */
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
global $prefix, $db;

require_once("mainfile.php");
require_once("includes/NukeAmazon/class.AmazonLiteXMLParser.php");

function amazon_search($SearchType, $SearchTerm, $Mode, $Type, $AMZpage)
{
	global $db, $amazon_id, $AMZModule_Name, $admin, $prefix, $AMZShowXML, $AMZVer, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZCartID;

	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");

	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);

	$Search = urlencode($SearchTerm);
	$Mode = urlencode($Mode);

	if (!isset($AMZpage))
	{
		$AMZpage = '1';
	}
	$MarketPlace = false;
	if ($SearchType == 'MarketPlaceSearch')
	{
		$SearchType = 'AsinSearch';
		$MarketPlace = true;
	}
	if ($SearchType == 'SellerProfile')
	{
		$xml_end = 'sellerprofile';
	}
	elseif ($SearchType == 'BlendedSearch')
	{
		$xml_end = 'blendedsearch';
	}
	else
	{
		$xml_end = 'details';
	}

	if (isset($Mode) && ($SearchType == 'KeywordSearch' || $SearchType == 'BrowseNodeSearch' || $SearchType == 'ActorSearch' || $SearchType == 'DirectorSearch'  || $SearchType == 'ArtistSearch' || $SearchType == 'AuthorSearch' || $SearchType == 'ManufacturerSearch'))
	{
		$Search .= '&mode='.$Mode;
	}

	if ($AMZLocale == 'us' || $AMZLocale == 'jp')
	{
		$filename = 'http://xml.amazon.com';
	}
	else # At this time uk and de
	{
		$filename = 'http://xml-eu.amazon.com';
	}
	$filename .= '/onca/xml3?t='.$amazon_id.'&dev-t=1ZQT1KGQZ3BAHG3Z22R2&'
				.$SearchType.'='.$Search.'&type='.$Type;
# Check variations
	if ($Variations && $SearchType == 'KeywordSearch')
	{
		$filename .= '&var=yes';
	}

# Request Page Number $AMZpage
	$PageTxt = '&page=';
	if ($MarketPlace)
	{
		$PageTxt = '&offerpage=';
		$filename .= '&offer=' . $Mode . $PageTxt . $AMZpage;
	}
	if ($SearchType != 'BlendedSearch' && !$MarketPlace)
	{
		$filename .= $PageTxt . $AMZpage;
	}

# Request sorting type...
	if ($SearchType != 'SimilaritySearch' && $SearchType != 'BlendedSearch' && !$MarketPlace && $SearchType != 'SellerProfile')
	{
		$filename .= '&sort=+salesrank';
	}

# Output format: XML
	$filename .= '&f=xml';

# Request Locale
	$filename .= '&locale=' . $AMZLocale;

### Show Link to XML response
	if (is_admin($admin) && $AMZShowXML)
	{
		echo "<a href=\"$filename\" target=\"_blank\">XML URL</a> ";
	}

	$xml = amazon_xml_loadxml($filename);

/* Create parse object */
	$AmazonData = new AmazonLiteXMLParser($xml, $xml_end);

	return $AmazonData;
}

function AsinLocale($in)
{
	return $in;
}

function GetAsin($catalog)
{
	global $prefix, $db, $AMZDefault_Asin;
	$GetSQL = "SELECT asin FROM ".$prefix."_amazon_items";

	if ($catalog !='')
	{
		$GetSQL .= " WHERE category='$catalog'";
	}
	$GetSQL .= " ORDER BY RAND() LIMIT 1";

    $result = $db->sql_query($GetSQL);
	list($asin) = $db->sql_fetchrow($result);
	if ($asin=="")
	{
	# Get default Asin
		$asin = $AMZDefault_Asin;
	}

	Return $asin;
}

function AmazonProductDetail($amazon, $ImageSize, $MainProd, $cols, $AMZSEARCH)
{
	global $db, $amazon_id, $AMZModule_Name, $admin, $prefix, $AMZShowXML, $AMZVer, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $pagetitle, $AMZCartID;

	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");

	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);

	if(!is_array($amazon->records))
	{
	    echo 'Error!';
	    exit;
	}

# Change Error
# We encountered an error processing your request. Please retry.
# Confrontamos problemas al hacer su busqueda. Por favor trate luego.
/*
	if(isset($amazon->errorMsg))
	{
	    return "<center>{$amazon->errorMsg}</center>";
	    exit;
	}
*/
	$AMZCount = count($amazon->records);
	if ($AMZCount < 1)
	{
	# No Requested Data is Available. Then use the default ASIN.
		$Asin = $AMZDefault_Asin;
		$amazon = amazon_search('AsinSearch', $Asin, '', 'heavy', 1);
		$AMZCount = count($amazon->records);
	}

	$content = "";
	$showmore = true;
   	$count = 0;

#	Start Table
	$content = "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
	foreach($amazon->records as $ind => $arr)
	{
		if ($count == 0)
		{
	    	$content .= "<tr>\n";
		}
		$count++;
    	$content .= "<td>\n";

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
		$MinMarketPrice = "";
		$MarketPlacePrice = "";


# Total Results
		if($arr['totalresults'])
		{
			$TotalCount=$arr['totalresults'];
		}

# Show previous/more buttons
		if($AMZMore && !$MainProd && $showmore)
		{
			$showmore = false;
			$AMZpage = $AMZSEARCH[3];
			$Link = "modules.php?name=$AMZModule_Name&amp;op=More&amp;searchmode=$AMZSEARCH[0]&amp;keyword=" . AMZ_URL_Verify($AMZSEARCH[1]) . "&amp;mode=$AMZSEARCH[2]";
			if (!isset($TotalCount))
			{
				$TotalCount = $AMZSEARCH[4];
				$Link = "modules.php?name=$AMZModule_Name&amp;op=ShowFI&amp;catalog=$AMZSEARCH[2]";
			}
			$RemainingProducts = $TotalCount - ($AMZpage * 10);
			$NowShowing = ($AMZpage * 10)-9;
			$ToShowing = $NowShowing + $AMZCount - 1;
			$More_content = "<table width=\"100%\"><tr><td align=\"center\">";
			$More_content .= _AMZPRODUCTTOTAL1 . " $NowShowing ";
			$More_content .= _AMZPRODUCTTOTAL2 . " $ToShowing ";
			$More_content .= _AMZPRODUCTTOTAL3 . " $TotalCount ";
			$More_content .= "<br />";
			$More_content .= page_links($AMZpage, 10, $TotalCount, $Link);
			$More_content .= "</td></tr></table>\n";
			$content = $More_content . $content;
		}

# Product Info
		$Asin                = $arr['asin'];
		$ProductCatalog      = $arr['catalog'];
		$ProductName         = $arr['productname'];
		$UPC                 = $arr['upc'];
		$pagetitle           = "- " . $ProductName;
		if ($arr['productdescription'])
		{
			$ProductDescription = $arr['productdescription'];
		}

# Product Media
		if ($arr['media'])
		{
			$AMZTmp = $arr['media'];
			if ($AMZTmp == "DVD")
			{
				$AMZTmp = "<img src=\"http://g-images.amazon.com/images/G/01/detail/dvd-gray-medium.gif\" align=\"middle\" alt=\"DVD\"> ";
			}
			elseif ($AMZTmp == "VHS Tape")
			{
				$AMZTmp = "<img src=\"http://g-images.amazon.com/images/G/01/detail/vhs-gray-medium.gif\" align=\"middle\" alt=\"VHS\"> ";
			}
			# Audio CD
			$Media = "<strong>" . _AMZMEDIA . ":</strong>  " . $AMZTmp . "<br />";
		}

# Product Availability
		if ($arr['availability'])
		{
			$AMZAvail = $arr['availability'];
			$AMZBuyable = true;
			switch ($arr['availability'])
			{
				case "Usually ships in 24 hours":
					$AMZAvail = _AMZ24HRS;
					break;
				case "Usually ships in 1-2 business days":
					$AMZAvail = _AMZ12D;
					break;
				case "Usually ships in 2 to 3 days":
					$AMZAvail = _AMZ23D;
					break;
				case "Usually ships in 11 to 13 days":
					$AMZAvail = _AMZ1113D;
					break;
				case "Usually ships in 4 days":
					$AMZAvail = _AMZ4D;
					break;
				case "Usually ships in 3 to 5 days":
					$AMZAvail = _AMZ35D;
					break;
				case "Not yet released":
					$AMZAvail = _AMZNYR;
					$AMZBuyable = false;
					break;
				case "Usually ships in 1 to 2 weeks":
					$AMZAvail = _AMZ12WKS;
					break;
				case "Usually ships in 1 to 2 months":
					$AMZAvail = _AMZ12M;
					break;
				case "This item is not stocked or has been discontinued.":
					$AMZAvail = _AMZNS;
					$AMZBuyable = false;
					break;
				case "This item is currently not available.":
					$AMZAvail = _AMZNA;
					$AMZBuyable = false;
					break;
				case "THIS TITLE IS CURRENTLY NOT AVAILABLE. If you would like to purchase this title, we recommend that you occasionally check this page to see if it has become available.":
					$AMZAvail = _AMZNA;
					$AMZBuyable = false;
					break;
				case "Not yet published":
					$AMZAvail = _AMZNYP;
					break;
				case "Usually ships in 3 to 5 weeks":
					$AMZAvail = _AMZ35WKS;
					break;
				case "In stock soon. Order now to get in line. First come, first served.":
					$AMZAvail = _AMZISS;
					break;
				case "Out of Print--Limited Availability":
					$AMZBuyable = false;
					$AMZAvail = _AMZOOP;
					break;
				case "Special Order":
					$AMZBuyable = false;
					$AMZAvail = _AMZSO;
					break;
			}
			$Availability = "<strong>" . _AMZAVAILABLILITY . ":</strong>  " . $AMZAvail ."<br />";
		}
# ISBN
		if ($arr['isbn'])
		{
			$Isbn = "<strong>ISBN:</strong> " . $arr['isbn'] . "<br />";
		}
# Release Date
		if($arr['releasedate']) {$ReleaseDate="<strong>"._AMZRELEASE.":</strong> ".AMZFormatDate($arr['releasedate'])."<br />";}
# Age Group
		if($arr['agegroup'])
		{
			$AgeGroup = "<strong>"._AMZAGE.":</strong> " . $arr['agegroup'];
			$AgeGroup = str_replace ("months", _AMZMONTHS, $AgeGroup);
			$AgeGroup = str_replace (" years and up", "+ "._AMZYRS, $AgeGroup);
			$AgeGroup = str_replace ("years", _AMZYRS, $AgeGroup);
		}
# Catalog Image
		$CatImageUrl = catalog_image(strtolower($ProductCatalog));

# Manufacturer Publisher for books and magazine; studio for video, dvd, music; manufacturer for whatever..
# Manufacturer search options for valid searches.
		if($arr['manufacturer'])
		{
			if ($ProductCatalog == "DVD" || $ProductCatalog == "Video")
			{
				$Manf = ""._AMZSTUDIO."";
			}
			elseif ($ProductCatalog == "Book" || $ProductCatalog == "Magazine")
			{
				$Manf = ""._AMZPUBLISHER."";
			}
			elseif ($ProductCatalog == "Music")
			{
				$Manf = ""._AMZLABEL."";
			}
			else
			{
				$Manf = ""._AMZMANUFACTURER."";
			}
			$Manufacturer = "<strong>".$Manf.":</strong> ";
			$PCat = strtolower($ProductCatalog);
			if ($PCat == "photo" || $PCat == "video games" || $PCat == "personal computer" || $PCat == "electronics" || $PCat == "kitchen" || $PCat == "software" )
			{
				$Manufacturer .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ManufacturerSearch&amp;keyword=";
				$Manufacturer .= AMZ_URL_Verify($arr['manufacturer']) . "&amp;mode=" . Get_Cat_Mode(strtolower($ProductCatalog)) . "\">" . $arr['manufacturer'] . "</a>";
			}
			else
			{
				$Manufacturer .= $arr['manufacturer'];
			}
		}
# Book Author
		if(is_array($arr['author']))
		{
			$AuthorCount = count($arr['author']);
			if ($AuthorCount > 1)
			{
				$Author = "<strong>"._AMZAUTHORS.":</strong> ";
			}
			else
			{
				$Author = "<strong>"._AMZAUTHOR.":</strong> ";
			}
			$i = 0;
			while ($AuthorCount > $i)
			{
				if ($i > 0)
				{
					$Author .= ", ";
				}
				$Author .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=AuthorSearch&amp;keyword=";
				$Author .= 	AMZ_URL_Verify($arr['author'][$i]) . "&amp;mode=" . Get_Cat_Mode(strtolower($ProductCatalog)) . "\">" . $arr['author'][$i] . "</a>";
				$i++;
			}
		}
# Music Artist
		if(is_array($arr['artist']))
		{
			$ArtistCount = count($arr['artist']);
			if($ArtistCount > 1)
			{
				$Artist = "<strong>"._AMZARTISTS.":</strong> ";
			}
			else
			{
				$Artist = "<strong>"._AMZARTIST.":</strong> ";
			}
			$i = 0;
			while ($ArtistCount > $i)
			{
				if ($i > 0)
				{
					$Artist .= ", ";
				}
				$Artist .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ArtistSearch&amp;keyword=";
				$Artist .= AMZ_URL_Verify($arr['artist'][$i]) . "&amp;mode=" . Get_Cat_Mode(strtolower($ProductCatalog)) . "\">" . $arr['artist'][$i] . "</a>";
				$i++;
			}
		}
# Price
		$OurPrice            = $arr['ourprice'];
		if (strtolower($OurPrice) == "too low to display")
		{
			$OurPrice = "" . _AMZTOOLOW . "";
		}
		elseif ($OurPrice == "")
		{
			$OurPrice = $arr['listprice'];
		}
		$ListPrice = $arr['listprice'];
		if ($ListPrice == "")
		{
			$ListPrice = $OurPrice;
		}
		if ($ListPrice > $OurPrice)
		{
			$Savings = AMZsavings($ListPrice, $OurPrice);
		}

# Market Place Used & New price from:
		if ($arr['usedprice'] || $arr['collectibleprice'] || $arr['thirdpartynewprice'] || $arr['refurbishedprice'])
		{
			$MinMarketPrice = "";
			if ($arr['usedprice'])
			{
				$MinMarketPrice = AMZRemoveCurrency($arr['usedprice']);
			}
			if ($arr['thirdpartynewprice'])
			{
				if ($MinMarketPrice)
				{
					$MinMarketPrice = min($MinMarketPrice, AMZRemoveCurrency($arr['thirdpartynewprice']));
				}
				else
				{
					$MinMarketPrice = AMZRemoveCurrency($arr['thirdpartynewprice']);
				}
			}
			if ($arr['collectibleprice'])
			{
				if ($MinMarketPrice)
				{
					$MinMarketPrice = min($MinMarketPrice, AMZRemoveCurrency($arr['collectibleprice']));
				}
				else
				{
					$MinMarketPrice = AMZRemoveCurrency($arr['collectibleprice']);
				}

			}
			if ($arr['refurbishedprice'])
			{
				if ($MinMarketPrice)
				{
					$MinMarketPrice = min($MinMarketPrice, AMZRemoveCurrency($arr['refurbishedprice']));
				}
				else
				{
					$MinMarketPrice = AMZRemoveCurrency($arr['refurbishedprice']);
				}

			}
			$MinMarketPrice = AMZPriceFormat($MinMarketPrice , $AMZLocale);
			$MarketPlacePrice = "<a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=All\">". _AMZMKTPRICE . " " . $MinMarketPrice . "</a>";
		}

# FOR MOVIES
		if(isset($arr['mpaarating']))
		{
			$Mpaa = explode(" ",$arr['mpaarating']);
			$Rated = "<strong>" . _AMZRATED . ":</strong> ";
			if($Mpaa[0] =="G" || $Mpaa[0] =="PG" || $Mpaa[0] =="PG-13" || $Mpaa[0] =="R" )
			{
				$Rated .= "<img src=\"http://g-images.amazon.com/images/G/01/detail/" . strtolower($Mpaa[0]) . ".gif\" align=\"middle\" alt=\"" . $Mpaa[0] . "\">";
			}
			else
			{
				$Rated .= $Mpaa[0];
			}
		}
# Actors
		if(is_array($arr['actor']))
		{
			$ActorCount = count($arr['actor']);
			if($ActorCount > 1)
			{
				$Actor = "<strong>" . _AMZACTORS . ":</strong> ";
			}
			else
			{
				$Actor = "<strong>" . _AMZACTOR . ":</strong> ";
			}
			$i = 0;
			while ($ActorCount > $i)
			{
				if ($i > 0)
				{
					$Actor .= ", ";
				}
				$Actor .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ActorSearch&amp;keyword=";
				$Actor .= AMZ_URL_Verify($arr['actor'][$i]) . "&amp;mode=" . Get_Cat_Mode(strtolower($ProductCatalog)) . "\">" . $arr['actor'][$i] . "</a>";
				$i++;
			}
		}
# Directors
		if(is_array($arr['director']))
		{
			$DirectorCount=count($arr['director']);
			if($DirectorCount > 1)
			{
				$Director = "<strong>" . _AMZDIRECTORS . ":</strong> ";
			}
			else
			{
				$Director = "<strong>" . _AMZDIRECTOR . ":</strong> ";
			}
			$i = 0;
			while ($DirectorCount > $i)
			{
				if ($i > 0)
				{
					$Director .= ", ";
				}
				$Director .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=DirectorSearch&amp;keyword=";
				$Director .= AMZ_URL_Verify($arr['director'][$i]) . "&amp;mode=" . Get_Cat_Mode(strtolower($ProductCatalog)) . "\">" . $arr['director'][$i] . "</a>";
				$i++;
			}
		}
# FOR SOFTWARE / VIDEO GAMES ESRB RATING
		if($ESRBText=$arr['esrbrating'])
		{
			$ESRBrating = "<strong>" . _AMZESRBRATING . ":</strong> ";
			switch ($ESRBText)
			{
				case "Early Childhood":
					$ESRBrating .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/ratings/esrb-early_childhood.gif\" align=\"middle\" alt=\"Early Childhood\"> " . _AMZESRBEC . "";
					break;
				case "Everyone":
					$ESRBrating .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/ratings/esrb-everyone.gif\" align=\"middle\" alt=\"Everyone\"> " . _AMZESRBE . "";
					break;
				case "Teen":
					$ESRBrating .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/ratings/esrb-teen.gif\" align=\"middle\" alt=\"Teen\"> " . _AMZESRBT . "";
					break;
				case "Mature":
					$ESRBrating .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/ratings/esrb-mature.gif\" align=\"middle\" alt=\"Mature\"> " . _AMZESRBM . "";
					break;
				case "Adults Only":
					$ESRBrating .= "" . _AMZESRBAO . "";
					break;
				case "Rating Pending":
					$ESRBrating .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/ratings/esrb-rating-pending.gif\" align=\"middle\" alt=\"Rating Pending\"> " . _AMZESRBNR . "";
					break;
			}
		}
# FOR SOFTWARE / VIDEO GAMES PLATFORM
		if(isset($arr['platform']))
		{
			$Platforml  = implode(', ', $arr['platform']);
			switch ($arr['platform'][0])
			{
				case "PlayStation2":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-ps2.gif\" align=\"middle\" alt=\"PlayStation2\">";
					break;
				case "PlayStation":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-pstation.gif\" align=\"middle\" alt=\"PlayStation\">";
					break;
				case "Xbox":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/xbox/browse-xbox-blue.gif\" align=\"middle\" alt=\"Xbox\">";
					break;
				case "Windows":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Windows 95":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Windows 98":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Windows Me":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Windows 2000":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Windows XP":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-windows.gif\" align=\"middle\" alt=\"Windows\">";
					break;
				case "Game Boy Advance":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-gameboy-adv.gif\" align=\"middle\" alt=\"Game Boy Advance\">";
					break;
				case "GameCube":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/gamecube/browse-gamecube.gif\" align=\"middle\" alt=\"GameCube\">";
					break;
				case "Game Boy":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-gameboy.gif\" align=\"middle\" alt=\"Game Boy\">";
					break;
				case "Game Boy Color":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-gameboy.gif\" align=\"middle\" alt=\"Game Boy\">";
					break;
				case "Macintosh":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-mac.gif\" align=\"middle\" alt=\"Macintosh\">";
					break;
				case "Mac OS X":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-mac.gif\" align=\"middle\" alt=\"Macintosh\">";
					break;
				case "Nintendo 64":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-nin.gif\" align=\"middle\" alt=\"Nintendo 64\">";
					break;
				case "Sega Dreamcast":
					$PlatformImage .= "<img src=\"http://g-images.amazon.com/images/G/01/videogames/icons/browse-icon-dcast.gif\" align=\"middle\" alt=\"Sega Dreamcast\">";
					break;
			}
			$Platform   = "<strong>" . _AMZPLATFORM . ":</strong> " . $PlatformImage . " " . $Platforml;
		}

# Product Image
# Change this to get the width and height of the image
# to incorporate into the output html
		$size = GetImageSize($arr['imageurlsmall']);
# width for img tag
# 		{$size[3]}
		if ( $size[0] > 2 && $size[1] > 2 )
		{
			switch ($ImageSize)
			{
				case "small":
					$ImageUrl = $arr['imageurlsmall'];
					break;
				case "medium":
					$ImageUrl = $arr['imageurlmedium'];
					break;
				case "large":
					$ImageUrl = $arr['imageurllarge'];
					break;
			}
		}
		else
		{
			$catalog = strtolower($ProductCatalog);

			$sql = "SELECT no_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'";
			$result = $db->sql_query($sql);
			list($ImageUrl) = $db->sql_fetchrow($result);

			$NoImage = true;
		}

# Sales rank
		if(isset($arr['salesrank']))
		{
			$SalesRank = "<strong>" . _AMZRANK . ":</strong> " . $arr['salesrank'] . "<br />";
		}
# Customer Rating
		$Rating = number_format($arr['avgcustomerrating'], 1);
		if($Rating > 0)
		{
			$starimageurl = StarsImage($Rating);
			$AverageRating = "<strong>" . _AMZPOP . ":</strong> $starimageurl (" . $arr['totalcustomerreviews'] . " " . _AMZTOTALREVIEWS . ")<br />";
		}
# Product URL Link
		if ($MainProd)
		{
			# If items in cart add items to cart.
			if($AMZCartID && calculate_items($AMZCartID) > 0)
			{
				$URL="modules.php?name=$AMZModule_Name&amp;op=AddToCart&amp;asin=$Asin";
			}
			else # Go to Amazon Link
			{
				$URL="modules.php?name=$AMZModule_Name&amp;op=click&amp;asin=$Asin";
			}
			$LinkStartStr="<a href=\"$URL\">";
			# Update Product Views Stats
			if (!is_admin($admin))
			{
				if (AsinExist($Asin))
				{
					$sql = "update " . $prefix . "_amazon_items";
					$sql .= " set hits=hits+1 where asin='$Asin'";
					$result = $db->sql_query($sql);
				}
				elseif (AsinExistNF($Asin))
				{
					$sql = "update " . $prefix . "_amazon_not_item set hits=hits+1 where asin='$Asin'";
					$result = $db->sql_query($sql);
				}
				else
				{
					$sql = "insert into " . $prefix . "_amazon_not_item values (NULL, '$Asin', '1', '0' )";
					$result = $db->sql_query($sql);
				}
			}
		}
		else
		{
			$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=$Asin";
			$LinkStartStr="<a href=\"$LinkURL\">";
		}

# Product Browse Bar
		if ($MainProd)
		{
			# Home
			$bbtxt = "&nbsp;<strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=home\">Home</a> > ";
			# Catalog
			$bbarSQL = "SELECT node FROM ".$prefix."_amazon_nodes WHERE (catalog = '" . 			strtolower($ProductCatalog) . "' and pnode is null and locale = '" . $AMZLocale . "')";
			$result = $db->sql_query($bbarSQL);
			list($catalognode) = $db->sql_fetchrow($result);
			if ($catalognode)
			{
				$cartnode = "BrowseNodeSearch&amp;keyword=$catalognode&amp;mode=".strtolower(Get_Cat_Mode($ProductCatalog));
				$bbtxt .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=" . $cartnode . "\"> " . Get_Cat_Desc($ProductCatalog) . "</a> > ";
			}
			# Featured Product
			if(AsinExist($Asin) && is_admin($admin))
			{
				$bbtxt .= " <a href=\"modules.php?name=$AMZModule_Name&amp;op=ShowFI&amp;catalog=" . 			strtolower($ProductCatalog) . "\">" . _AMZFEATURED . "</a> > ";
			}
			# Product Name
			$bbtxt .= "$ProductName</strong>";
			$content .= AMZBorder($bbtxt);
		}
######################
# Start Content Here #
######################
		$content .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" width=\"100%\"><tr>\n";
		$content .= "<td width=\"40%\" valign=\"top\"><br />\n";
		$content .= "<h1><img src=\"" . $CatImageUrl . "\" border =\"0\" align=\"middle\" alt=\"$ProductCatalog\" > ";
		$content .= $LinkStartStr . "$ProductName</a>\n";
		$content .= AMZ_popgraphic($Asin);

		# Quick Add Starts
		if ($AMZQuickAdd && is_admin($admin))
		{
			if(AsinExist($Asin))
			{
				$content .= " <a href=\"modules.php?name=$AMZModule_Name&amp;op=Del&amp;asin=$Asin\" onclick=\"NewWindow(this.href,'name','250','250','yes');return false;\">[Del]</a>\n";
			}
			else
			{
				$content .= " <a href=\"modules.php?name=$AMZModule_Name&amp;op=Add&amp;asin=$Asin\" onclick=\"NewWindow(this.href,'name','250','250','yes');return false;\">[Add]</a>\n";
			}
		}

# Quick Add Ends
		$content .= "</h1><br />\n";
		$content .= "<table width=\"90%\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">\n";
		$content .= "<tr>\n";
		$content .= "<td width=\"200\" valign=\"top\" align=\"center\">\n";
		$content .= $LinkStartStr;
		if ($Savings[1] > 0 && !$NoImage && $AMZImgType != "NO")
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
		$content .= "<img src=\"" . $ImageUrl . "\" border =\"0\" alt=\"$ProductName\" >";
		$content .= "</a><br />";
		if ($MainProd && !$NoImage)
		{
			$content .= "<a href=\"".$arr['imageurllarge'] . "\" target=\"_blank\">";
			$content .= "<img src=\"images/NukeAmazon/zoom.gif\" WIDTH=\"12\" HEIGHT=\"13\" BORDER=\"0\"  ALIGN=\"middle\" alt=\"" . _AMZZOOM . "\" > " . _AMZZOOM . "</a><br />\n";
		}
		$content .= "</td>";
		$content .= "<td width=\"70%\" valign=\"top\" align=\"left\">\n";
		if ($ListPrice)
		{
			$content .= "<strong>" . _AMZLSTPRICE . ":</strong> <strike>$ListPrice</strike><br />\n";
		}
		if ($OurPrice)
		{
			$content .= "<font color=\"DarkRed\"><strong>" . _AMZPRICE . ": <big>$OurPrice</big></strong></font><br />";
		}
		if ($Savings[1] > 0)
		{
			$content .= "<strong>" . _AMZSAVE . ":</strong> " . AMZPriceFormat($Savings[0], $AMZLocale) . " ($Savings[1]% " . _AMZPERCENT . ")<br />";
		}
# Change Here when Available for others...
#		if ($MarketPlacePrice && ($AMZLocale == 'us' || $AMZLocale == 'uk' || $AMZLocale == 'de'))
		if ($MarketPlacePrice && $AMZLocale == 'us')

		{
			$content .=  $MarketPlacePrice . "<br />\n";
		}
		if ($Manufacturer)
		{
			$content .=  $Manufacturer . "<br />\n";
		}
		if ($Author)
		{
			$content .=  $Author . "<br />\n";
		}
		if ($Artist)
		{
			$content .=  $Artist . "<br />\n";
		}
		if ($Actor)
		{
			$content .=  $Actor . "<br />\n";
		}
		if ($Director)
		{
			$content .=  $Director . "<br />";
		}
		if ($Rated)
		{
			$content .=  $Rated . "<br />";
		}
		if ($ESRBrating)
		{
			$content .=  $ESRBrating . "<br />";
		}
		if ($Platform)
		{
			$content .=  $Platform . "<br />";
		}
		if ($AgeGroup)
		{
			$content .=  $AgeGroup . "<br />";
		}
		$content .= $ReleaseDate;
		$content .= $Availability;
		$content .= $AverageRating;
		$content .= $SalesRank;
		if ($Isbn)
		{
			$content .= $Isbn;
		}

# Add Product Buy Box
		if ($AMZBuyBox)
		{
			 if ($AMZLocale == 'us')
			{
				 $content .= AMZBuyBox($Asin);
			}
			else
			{
				$content .= "<br />";
				$content .= $LinkStartStr;
				if($AMZLocale == 'uk')
				{
					$content .= "Buy From <img src=\"https://ssl-images.amazon.com/images/G/02/associmg/uk_wh_logo4.gif\" border =\"0\" align=\"middle\" alt=\"Buy From Amazon.co.uk\">\n";
				}
				elseif($AMZLocale == 'de')
				{
					$content .= "<img src=\"http://images-eu.amazon.com/images/G/03/x-locale/common/buy-buttons/simple-add-to-cart.gif\" border =\"0\" align=\"middle\" alt=\"In den Einkaufswagen\">\n";
				}
				else #US, Need to find JP and the rest CA, FR
				{
					$content .= "<img src=\"https://ssl-images.amazon.com/images/G/01/associates/remote-buy-box/buy5.gif\" border =\"0\" align=\"middle\" alt=\"\">\n";
				}

				$content .= "</a>";
			}
		}

# Write Rewiew for this product
		if($MainProd && $AMZReviewMod)
		{
			$content .= "<br /><a href=\"modules.php?name=Reviews&amp;rop=write_review&amp;asin=$Asin\">" . _AMZReview . "</a>";
		}

	# Add to shopping cart
		if ($MainProd && $AMZBuyable)
		{
			$cartnode = str_replace("&amp;", ":", $cartnode);
			if ($AMZLocale == 'uk')
			{
				$content .= "<br /><a href=\"modules.php?name=$AMZModule_Name&amp;op=AddToCart&amp;asin=$Asin&amp;cartnode=$cartnode\"><img src=\"http://images-eu.amazon.com/images/G/02/x-locale/common/buy-buttons/add-to-cart-midsize.gif\" border=\"0\" alt=\"" . _AMZADDCart . "\"></a><br />";
			}
			elseif ($AMZLocale == 'de')
			{
				$content .= "<br /><a href=\"modules.php?name=$AMZModule_Name&amp;op=AddToCart&amp;asin=$Asin&amp;cartnode=$cartnode\"><img src=\"http://images-eu.amazon.com/images/G/03/x-locale/common/buy-buttons/simple-add-to-cart.gif\" border=\"0\" alt=\"" . _AMZADDCart . "\"></a><br />";
			}
			elseif ($AMZLocale == 'jp') # Check !!!!!!!
			{
				$content .= "<br /><a href=\"modules.php?name=$AMZModule_Name&amp;op=AddToCart&amp;asin=$Asin&amp;cartnode=$cartnode\"><img src=\"http://g-images.amazon.com/images/G/01/buttons/add-to-cart-yellow-short.gif\" border=\"0\" width=\"113\" height=\"23\" alt=\"" . _AMZADDCart . "\"></a><br />";
			}
			else # $AMZLocale == 'us'
			{
				$content .= "<br /><a href=\"modules.php?name=$AMZModule_Name&amp;op=AddToCart&amp;asin=$Asin&amp;cartnode=$cartnode\"><img src=\"http://g-images.amazon.com/images/G/01/buttons/add-to-cart-yellow-short.gif\" border=\"0\" width=\"113\" height=\"23\" alt=\"" . _AMZADDCart . "\"></a><br />";
			}
		}
		$content .= "</td></tr></table>\n";

# Product Description
		if ($ProductDescription !="")
		{
			$content .= "<br />";
			$content .= AMZBorder(_AMZDESC);
			$content .= $ProductDescription;
			$content .= "<br />";
		}
		# Product Features
		if(is_array($arr['feature']))
		{
			$FeatureCount = count($arr['feature']);
			$content .= "<table><tr><td><strong>Product Features:</strong></td></tr>";
			$i = 1;
			$content .= "<tr><td><UL>";
			while ($FeatureCount + 1 > $i)
			{
				$content .= "<li>" . $arr['feature'][$i-1];
				$i++;
			}
			$content .= "</ul></td></tr></table><br />";
		}
		if ($Media != "")
		{
			$content .= $Media;
		}
		if ($ProductCatalog == "Music")
		{
			# Music Tracks
			if(is_array($arr['track']))
			{
				$TrackCount = count($arr['track']);
				$TrackHalf = $TrackCount / 2 + $TrackCount % 2;
				$TrackHalf = (integer)$TrackHalf;
				$Track = AMZBorder(_AMZTRACK);
				$Track .= "<br /><table width = \"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
				$i = 1;
				$j = 0;
				while ($TrackHalf + 1 > $i)
				{
					$j++;
					if ($j % 2 == 0)
					{
						$backcolor = "$bgcolor1";
						$textcolor = "$textcolor1";
					}
					else
					{
						$backcolor = "$bgcolor2";
						$textcolor = "$textcolor2";
					}
					$Track .= "<tr valign=top>";
					$Track .= "<td bgcolor=\"$backcolor\" width = \"15\" align=\"right\"><font color=\"$textcolor\"><strong>" . $i . ".</strong></td><td bgcolor=\"$backcolor\" width = \"250\"><font color=\"$textcolor\">&nbsp;" . $arr['track'][$i-1];
					$Track .= "</td><td bgcolor=\"$backcolor\" >&nbsp;</td>";
					$TrackTemp = $i + $TrackHalf;
					if ($TrackCount + 1 > $TrackTemp )
					{
						$Track .= "<td bgcolor=\"$backcolor\" width = \"15\" align=\"right\"><font color=\"$textcolor\"><strong>";
						$Track .= $TrackTemp . ".</strong></td><td bgcolor=\"$backcolor\" width = \"250\"><font color=\"$textcolor\">&nbsp;" . $arr['track'][$i + $TrackHalf - 1];
						$Track .= "</td>";
					}
					else
					{
						$Track .= "<td bgcolor=\"$backcolor\" width = \"15\" align=\"right\"><font color=\"$textcolor\">";
						$Track .= "</td><td bgcolor=\"$backcolor\" width = \"250\"></td>";
					}
					$i++;
					$Track .= "</tr>\n";
				}
				$Track .= "</table><br />";
			}
			$content .= $Track;
		}
		# Accessory
		if(is_array($arr['accessory']))
		{
			$AccessoryCount = count($arr['accessory']);
			$Accessory = AMZBorder(_AMZRELATED1);
			$Accessory  .= "<table width = \"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
			$AMZType = 'lite';
			$AMZMainProduct = false;
			$keyword = implode(",", $arr['accessory']);
			$AccessoryAmazonData = amazon_search('AsinSearch', $keyword, strtolower($ProductCatalog), $AMZType, 1);

			foreach($AccessoryAmazonData->records as $ind => $a_arr)
			{
				$A_Asin         = $a_arr['asin'];
				$A_ProductName  = $a_arr['productname'];
				$A_OurPrice     = $a_arr['ourprice'];
				if (strtolower($A_OurPrice) == "too low to display")
				{
					$A_OurPrice = "" . _AMZTOOLOW . "";
				}
				if ($A_OurPrice == "")
				{
					$A_OurPrice = $a_arr['listprice'];
				}
				# Product Image
				$size = GetImageSize($a_arr['imageurlsmall']);
				if ( $size[0] > 2 && $size[1] > 2 )
				{
					$A_ImageUrl = $a_arr['imageurlsmall'];
				}
				else
				{
					$catalog = strtolower($ProductCatalog);

					$sql = "SELECT no_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'";
					$result = $db->sql_query($sql);
					list($A_ImageUrl) = $db->sql_fetchrow($result);
				}

				$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=" . $A_Asin;
				$LinkStartStr = "<a href=\"$LinkURL\">";
				$Accessory .= "<tr>";
				$Accessory .= "<td width =\"2%\">&nbsp;</td><td width=\"10%\" align=\"center\">";
				$Accessory .= $LinkStartStr ."<img src=\"" . $A_ImageUrl . "\" border=\"0\" alt=\"" . $A_ProductName . "\"></a>";
				$Accessory .= "</td><td width=\"56%\">";
				$Accessory .= $LinkStartStr . $A_ProductName . "</a>";
				$Accessory .= "</td><td width=\"30%\">";
				$Accessory .= "" . _AMZBLKPRICE . ": " . $A_OurPrice;
				$Accessory .= "</td><td width =\"2%\">&nbsp;";
				$Accessory .= "</td></tr>";
			}
			$Accessory .= "</table><br />";
			$content .=  $Accessory;
		}
		# Customer Reviews
		if ($AMZShowReview && !$AMZSingle && $MainProd)
		{
			if ($arr['avgcustomerrating'] > 0)
			{
				$content .= "<br />";
				$content .= AMZBorder(_AMZCUSTREVIEW);
				$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
				$content .= "<tr>";
				$content .= "<td width=\"5%\">&nbsp;</td><td width=\"85%\" valign=\"top\">";
				if (is_array($arr['rating']))
				{
					foreach ($arr['rating'] as $ind => $rate)
					{
						$Rating = number_format($rate, 1);
						$starimageurl = StarsImage($Rating);
						$content .= "<br />$starimageurl&nbsp;<strong>";
						$content .= $arr['summary'][$ind];
						$content .= "</strong><br /><br />";
						$content .= $arr['comment'][$ind];
						$content .= "<br /><br /><hr noshade width=\"100%\" size=\"1\">";
					}
				}
				$content .= "</td><td width=\"10%\" valign=\"top\">&nbsp;</td><td width=\"5%\" valign=\"top\">";
				$content .= "&nbsp;</td></tr></table>";
			}
		}
		# Similar Products
		if ($AMZShowSimilar)
		{
			if (is_array($arr['product']))
			{
				$content .= AMZBorder(_AMZSIMILAR);
				$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr>\n";
				$Num_Products = count($arr['product']);
				$TDWidth = 100 / $Num_Products;
				$AMZType = 'lite';
				$AMZMainProduct = false;
				$keyword = implode(",", $arr['product']);
				$SimilarAmazonData = amazon_search('AsinSearch', $keyword, strtolower($ProductCatalog), $AMZType, 1);
				foreach($SimilarAmazonData->records as $ind => $s_arr)
				{
					$S_Asin         = $s_arr['asin'];
					$S_ProductName  = $s_arr['productname'];
					$S_OurPrice     = $s_arr['ourprice'];
					if (strtolower($S_OurPrice) == "too low to display")
					{
						$S_OurPrice = "" . _AMZTOOLOW . "";
					}
					if ($S_OurPrice == "")
					{
						$S_OurPrice = $s_arr['listprice'];
					}
				# Product Image
					$size = GetImageSize($s_arr['imageurlsmall']);
					if ( $size[0] > 2 && $size[1] > 2 )
					{
						$S_ImageUrl = $s_arr['imageurlsmall'];
					}
					else
					{
						$catalog = strtolower($ProductCatalog);
						$sql = "SELECT no_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'";
						$result = $db->sql_query($sql);
						list($S_ImageUrl) = $db->sql_fetchrow($result);
					}
					$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=" . $S_Asin;
					$LinkStartStr = "<a href=\"$LinkURL\">";
					$content .= "<td valign=\"top\" align=\"center\" width=\"$TDWidth" . "%\">\n";
					$content .= $LinkStartStr ."<br /><img src=\"" . $S_ImageUrl . "\" border=\"0\" alt=\"" . $S_ProductName . "\"></a><br />";
					$content .= $LinkStartStr . $S_ProductName . "</a><br />";
					$content .= "" . _AMZBLKPRICE . ": " . $S_OurPrice;
					$content .= "</td>";
				}
				$content .= "</tr></table>";
			}
		}
		$content .= "</td></tr></table>";
		$content .= "</td>\n";
		if ($count == $cols)
		{
			$content .= "</tr>\n";
			$count = 0;
		}
	} # FOR statement

	$content .= "</table>\n";

# Search for Related Items in ...
	if (is_array($arr['browsename']))
	{
# BrowseId
		$content .= "<br />\n";
		$content .= AMZBorder(_AMZBROWSE . " " . Get_Cat_Desc(strtolower($ProductCatalog)) . " " . _AMZSEARCHIN);
		$content .= "<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"3\">\n";
		$content .= "<tr>\n";
		$bcount = 0;
		$i = 0;
		foreach ($arr['browsename'] as $ind => $browsename)
		{
			if ($bcount == 3)
			{
				$content .= "<tr>\n";
				$bcount = 0;
			}
			$content .= "<td width=\"33%\" valign=\"center\" align=\"left\">\n";
			$link = "";
			if ($arr['browseid'][$i])
			{
				$link = "<a href=\"modules.php?name=$AMZModule_Name&amp;op=BrowseNodeSearch&amp;keyword=";
				$link .= $arr['browseid'][$i];
				$link .= "&amp;mode=". urlencode(strtolower(Get_Cat_Mode(strtolower($ProductCatalog)))) . "\">";
			}
			if ($link != "")
			{
				$content .= $link;
			}
			else
			{
				$browsenamelink = AMZ_URL_Verify($browsename);
				$content .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ShowResults&amp;keyword=".urlencode($browsenamelink)."&amp;mode=".urlencode(Get_Cat_Mode(strtolower($ProductCatalog)))."\">";
			}
			$content .= "$browsename</a></td>\n";
			$bcount++;
			if ($bcount == 3)
			{
				$content .= "</tr>\n";
			}
			$i++;
		}
		if ($bcount == 3)
		{
			$content .= "</table>\n";
		}
		else
		{
			$content .= "</tr></table>\n";
		}

	} # IF statement

# Show previous/more buttons
		if($AMZMore && !$MainProd)
		{
			$content .= $More_content;
		}
		$content .= show_sub_catalog(strtolower($ProductCatalog));
	return $content;
}

function AMZBuyBox($Asin)
{
	Global $db, $amazon_id;

	$BoxTxt .= "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	$BoxTxt .= "function AMZpopUp(URL,NAME) {\n";
	$BoxTxt .= "amznwin=window.open(URL,NAME,'location=yes,scrollbars=yes,status=yes,toolbar=yes,resizable=yes,width=380,height=450,screenX=10,screenY=10,top=10,left=10');\n";
	$BoxTxt .= "amznwin.focus();}\n";
	$BoxTxt .= "document.open();\n";
	$BoxTxt .= "document.write(\"<br /><a href=javascript:AMZpopUp('http://buybox.amazon.com/exec/obidos/redirect?tag=$amazon_id&amp;link_code=xsc&amp;creative=23424&amp;camp=2025&amp;path=/dt/assoc/tg/aa/xml/assoc/-/$Asin/$amazon_id/ref=ac_bb5_,_amazon')><img src=http://rcm-images.amazon.com/images/G/01/associates/remote-buy-box/buy5.gif border=0 alt='Buy from Amazon.com'></a>\");\n";
	$BoxTxt .= "document.close();\n";
	$BoxTxt .= "</script>\n";
	$BoxTxt .= "<noscript>\n";
	$BoxTxt .= "<br /><form method=\"POST\" action=\"http://buybox.amazon.com/o/dt/assoc/handle-buy-box=$Asin\">\n";
	$BoxTxt .= "<input type=\"hidden\" name=\"asin.$Asin\" value=\"1\">\n";
	$BoxTxt .= "<input type=\"hidden\" name=\"tag-value\" value=\"$amazon_id\">\n";
	$BoxTxt .= "<input type=\"hidden\" name=\"tag_value\" value=\"$amazon_id\">\n";
	$BoxTxt .= "<input type=\"image\" name=\"submit.add-to-cart\" value=\"Buy from Amazon.com\" alt=\"Buy from Amazon.com\" src=\"http://rcm-images.amazon.com/images/G/01/associates/add-to-cart.gif\">\n";
	$BoxTxt .= "</form>\n";
	$BoxTxt .= "</noscript>\n";
	return $BoxTxt;
}

# Return savings
function AMZsavings($ListPrice, $OurPrice)
{
	Global $db, $AMZLocale;

	$ListPrice = AMZRemoveCurrency($ListPrice);
    $OurPrice = AMZRemoveCurrency($OurPrice);
	$Saved_Money = 0;

	if ($ListPrice != "" && $OurPrice && $ListPrice != $OurPrice && $OurPrice !== "" . _AMZTOOLOW . "" )
	{
		$Saved_Money = $ListPrice - $OurPrice;
		if ($ListPrice == 0)
		{
		    $ReturnArray[0] = 0;
		    $ReturnArray[1] = 0;
		}
		else
		{
			$Saved_Percentage = $Saved_Money / $ListPrice * 100;
			$Saved_Percentage = round($Saved_Percentage);
		    $ReturnArray[0] = $Saved_Money;
		    $ReturnArray[1] = $Saved_Percentage;
		}
	}
	else
	{
		$ReturnArray = array("", "");
	}
	return $ReturnArray;
}

function AMZGetCurrency()
{
Global $AMZLocale;
	$AMZCurrency = "$";
	switch ($AMZLocale)
	{
		case "us":
			$AMZCurrency = "$";
			break;
		case "uk":
			$AMZCurrency = "£";
			break;
		case "ca":
			$AMZCurrency = "$";
			break;
		case "de":
			$AMZCurrency = "EUR ";
			break;
		case "jp":
			$AMZCurrency = "¥";
			break;
		case "fr":
			$AMZCurrency = "$";
			break;
	}
	return $AMZCurrency;
}

function AMZRemoveCurrency($item)
{
# Removes all currency text and commas, spaces and dots.
# Converts $1,234.56 to 1234.56
# Converts EUR 1.234,56 to 1234.56
	if(strstr($item, ","))
	{
		$item = str_replace(".", "", $item); // replace dots (thousand seps) with blancs
		$item = str_replace(",", ".", $item); // replace ',' with '.'
	}
	if(preg_match("#([0-9\.]+)#", $item, $match))
	{ // search for number that may contain '.'
		return floatval($match[0]);
	}
	else
	{
		return floatval($item); // take some last chances with floatval
	}
}

function AMZNumberFormat($number, $AMZLocale)
{
	$number = AMZRemoveCurrency($number);
	if ($AMZLocale == 'fr')
	{
		$number = number_format($number, 2, ',', ' '); #French
	}
	elseif ($AMZLocale == 'de')
	{
		$number = number_format($number, 2, ',', '.'); #German
	}
	else
	{
		$number = number_format($number, 2); #US, UK
	}
	return $number;
}

function AMZPriceFormat($number, $AMZLocale)
{
	$number = AMZGetCurrency() . AMZNumberFormat($number, $AMZLocale);
	return $number;
}

function AMZFormatDate($strDate)
{
	Global $db, $AMZLocale;
	if ($AMZLocale == 'us' || $AMZLocale == 'uk')
	{
		$Adob = explode(" ", $strDate);
		$newdob = "";
		$datecount = count($Adob);
		if ($datecount == 1)
		{
			$newdob = $strDate;
			return $newdob;
		}
		elseif ($datecount > 2)
		{
			$m = 1;
			$y = 2;
			$newdob = $Adob[0] . "-";
		}
		else
		{
			$m = 0;
			$y = 1;
		}

		if ($Adob[$m] == "January,")
		{
			$month = _JANUARY;
		}
		if ($Adob[$m] == "February,")
		{
			$month = _FEBRUARY;
		}
		if ($Adob[$m] == "March,")
		{
			$month = _MARCH;
		}
		if ($Adob[$m] == "April,")
		{
			$month = _APRIL;
		}
		if ($Adob[$m] == "May,")
		{
			$month = _MAY;
		}
		if ($Adob[$m] == "June,")
		{
			$month = _JUNE;
		}
		if ($Adob[$m] == "July,")
		{
			$month = _JULY;
		}
		if ($Adob[$m] == "August,")
		{
			$month = _AUGUST;
		}
		if ($Adob[$m] == "September,")
		{
			$month = _SEPTEMBER;
		}
		if ($Adob[$m] == "October,")
		{
			$month = _OCTOBER;
		}
		if ($Adob[$m] == "November,")
		{
			$month = _NOVEMBER;
		}
		if ($Adob[$m] == "December,")
		{
			$month = _DECEMBER;
		}

		$newdob .= $month . "-" . $Adob[$y];
		return $newdob;
	}
	else
	{
		$newdob = $strDate;
		return $newdob;
	}
}

function AMZSearchForm()
{
	global $db, $amazon_associates_id, $AMZModule_Name, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $admin, $prefix, $AMZLocale;

	echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\" bgcolor=\"$bgcolor2\">\n"
		."<tr><td>\n"
		."<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\" bgcolor=\"$bgcolor1\">\n"
		."<tr><td align=\"center\">\n"
		."<strong>"._AMZSEARCH."</strong>&nbsp;&nbsp;\n"
		."<form style=\"display: inline;\" name=\"search\" action=\"modules.php?name=$AMZModule_Name\" method=\"POST\">\n"
		."<INPUT TYPE=\"hidden\" name=\"op\" value=\"ShowResults\">\n"
		."<INPUT TYPE=\"hidden\" name=\"page\" value=\"1\">\n"
		."<INPUT TYPE=\"text\" style=\"background:$bgcolor1;\" NAME=\"keyword\" SIZE=\"24\" maxlength=\"50\" VALUE=\"\">&nbsp;&nbsp;<strong>"._AMZSEARCHIN." </strong>&nbsp;&nbsp;\n"
		."<SELECT NAME=\"mode\" style=\"background:$bgcolor1;\">\n";
		$sql = "SELECT mode, l_catalog FROM ".$prefix."_amazon_catalog where locale = '$AMZLocale' order by mode";
		$result = $db->sql_query($sql);
		while (list($ASMode, $ASCat) = $db->sql_fetchrow($result))
		{
			echo "<OPTION VALUE=\"$ASMode\">";
			echo constant($ASCat);
			echo "</option>\n";
		}
		echo "</SELECT>&nbsp;<INPUT TYPE=\"IMAGE\" SRC=\"images/NukeAmazon/";
		if ($AMZLocale == 'de')
		{
			echo "los.gif\" ALT=\"GO\" VALUE=\"Go\" NAME=\"Los\" ";
		}
		else
		{
		echo "pdm-search-go-btn.gif\" ALT=\"GO\" VALUE=\"Go\" NAME=\"Go\" ";
		}
		echo "ALIGN=\"middle\">"
		."</form></td></tr></table>"
		."</td></tr></table>";
}

# Cleans expired cache entries
function AMZCacheClear()
{
	global $db, $amazon_xml_cache_maxtime, $prefix;
# Remove old cache data
	$sql = "delete from " . $prefix . "_amazon_cache where time < SUBDATE(now(), INTERVAL $amazon_xml_cache_maxtime SECOND)";
	$result = $db->sql_query($sql);

# Remove error requests
	$sql = "delete from " . $prefix . "_amazon_cache where xml like '%<ErrorMsg>%'";
	$result = $db->sql_query($sql);
	$sql = "delete from " . $prefix . "_amazon_cache where xml like '%Internal Server Error%'";
	$result = $db->sql_query($sql);

# Remove cart sessions older than 1 yr
	$sql = "delete from " . $prefix . "_amazon_cart where date < SUBDATE(now(), INTERVAL 1 YEAR)";
	$result = $db->sql_query($sql);
}

function AMZ_submit($asin)
{
	global $db, $admin, $prefix, $AMZModule_Name;
	if (is_admin($admin))
	{
		$amazon = amazon_search('AsinSearch', $asin, '', 'lite', '');
		foreach ($amazon->records as $ind => $arr)
		{
			$ProductCatalog = strtolower($arr['catalog']);
			$sql = "insert into " . $prefix . "_amazon_items";
			$sql .= " values (NULL, '$asin', '0', '".$ProductCatalog."', '0', '0')";
			$result = $db->sql_query($sql);

			$sql = "update " . $prefix . "_amazon_department set items=items+1 where r_catalog='$ProductCatalog'";
			$result = $db->sql_query($sql);

			$sql = "SELECT * FROM ".$prefix."_amazon_not_item WHERE asin = '$asin'";
			$result = $db->sql_query($sql);
			$numrows = $db->sql_numrows($result);

			if ($numrows > 0)
			{
				$sql = "delete from ".$prefix."_amazon_not_item WHERE asin = '$asin'";
				$result = $db->sql_query($sql);
			}
		}

		echo "<html>\n"
		."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
		."<title>$AMZModule_Name: Quick Product Add</title>\n"
		."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
		."<div align=\"center\"><strong>$asin</strong><br />Has been added<br />\n"
		."($ProductCatalog)<br />\n"
		."<img src=\"" . AMZIS($asin, 'T') . "\"><br /><br />\n"
		."[ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</div>\n"
		."</font>\n"
		."</body>\n"
		."</html>";
		die;
	}
	else
	{
		echo "<html>\n"
		."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
		."<title>$AMZModule_Name: Quick Product Add</title>\n"
		."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
		."<strong>Please</strong> - Play somewere else...<br />\n"
		."<center>[ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
		."</font>\n"
		."</body>\n"
		."</html>";
		die;
	}
}

function AMZ_remove($asin)
{
	global $db, $admin, $prefix;
	if (is_admin($admin))
	{
		$amazon = amazon_search('AsinSearch', $asin, '', 'lite', '');
		foreach ($amazon->records as $ind => $arr)
		{
			$ProductCatalog = strtolower($arr['catalog']);
			$sql = "update " . $prefix . "_amazon_department set items=items-1 where r_catalog='$ProductCatalog'";
			$result = $db->sql_query($sql);
		}
		$sql = "delete from ".$prefix."_amazon_items";
		$sql .= " WHERE asin = '$asin'";
		$result = $db->sql_query($sql);
		echo "<html>\n"
		."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
		."<title>$AMZModule_Name: Quick Product DELETE</title>\n"
		."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
		."<div align=\"center\"><strong>$asin</strong><br />Has been deleted<br />\n"
		."<img src=\"" . AMZIS($asin, 'T') . "\"><br /><br />\n"
		."[ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</div>\n"
		."</font>\n"
		."</body>\n"
		."</html>";
		die;
	}
	else
	{
		echo "<html>\n"
		."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
		."<title>$AMZModule_Name: Quick Product Delete</title>\n"
		."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
		."<strong>Please</strong> - Play somewere else...<br />\n"
		."<center>[ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
		."</font>\n"
		."</body>\n"
		."</html>";
		die;
	}
}

Function AsinExist($asin)
{
	global $db, $prefix;
	$sql = "SELECT * FROM ".$prefix."_amazon_items";
	$sql .= " WHERE asin = '$asin'";
	$result = $db->sql_query($sql);
	$numrows = $db->sql_numrows($result);
	if ($numrows > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
	break;
}

Function AsinExistNF($asin)
{
	global $db, $prefix;
	$sql = "SELECT * FROM ".$prefix."_amazon_not_item WHERE asin = '$asin'";
	$result = $db->sql_query($sql);
	$numrows = $db->sql_numrows($result);
	if ($numrows > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
	break;
}

Function Get_Catalog()
{
# This function gets all catalogs with featured items and returns a string with '+' as the divider
	global $db, $prefix, $AMZLocale;

	$sql = "SELECT r_catalog FROM ".$prefix."_amazon_department WHERE items >= 1 order by r_catalog";
	$result = $db->sql_query($sql);

	$AMZCatalog = "";

	while (list($cat) = $db->sql_fetchrow($result))
	{
		$AMZCatalog .= $cat . "+";
	}
	return $AMZCatalog;
}

Function Get_Cat_Desc($catalog)
{
# Returns the catalog description for $catalog
	global $db, $prefix, $AMZLocale;
	$catalog = strtolower($catalog);
	$sql = "SELECT l_catalog FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'  and locale = '$AMZLocale'";
	$result = $db->sql_query($sql);
	list($CatDescription) = $db->sql_fetchrow($result);
	return @constant($CatDescription);
}

Function Get_Cat_Mode($catalog)
{
# Returns the search mode for $catalog
	global $db, $prefix, $AMZLocale;
	$sql = "SELECT AMZLocale FROM " . $prefix . "_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale) = $db->sql_fetchrow($result);
	$catalog = strtolower($catalog);
	$sql = "SELECT mode FROM " . $prefix . "_amazon_catalog WHERE r_catalog = '$catalog' and locale = '$AMZLocale'";
	$result = $db->sql_query($sql);
	list($CatMode) = $db->sql_fetchrow($result);
	return $CatMode;
}

function AMZtitle($text)
{
# This function shows the Amazon Tile bar with the department catalog.

	global $db, $AMZModule_Name, $AMZCartID, $prefix, $AMZLocale, $bgcolor1, $bgcolor2, $admin, $HTTP_HOST, $textcolor2, $textcolor1;

# Determine total and quantity of items in Shopping Cart
	$total_price = calculate_price($AMZCartID);
	$items = calculate_items($AMZCartID);
	if(!$items) $items = "0";
	if(!$total_price) $total_price = "0.00";

	OpenTable();
	echo "<div align=\"center\">\n";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	echo "<tr>\n";
	echo "<td width=\"2\">&nbsp;</td>\n";
	$AMZCatalog = Get_Catalog();
	$AMZCatalog = explode("+", $AMZCatalog);
	$CatCount = count($AMZCatalog);
	$i = 0;
	while ($i < $CatCount - 1)
	{
		echo "<td style=\"border: 1px solid #000000; background-color:$bgcolor2; text-align: center\"><a style=\"text-decoration: none;color:$textcolor2;\" href=\"modules.php?name=$AMZModule_Name&amp;op=ShowFI&amp;catalog=".urlencode($AMZCatalog[$i]) ."\"><strong>" . Get_Cat_Desc($AMZCatalog[$i]) . "</strong></a></td>\n";
		echo "<td width=\"2\">&nbsp;</td>\n";
		$i++;
	}
	echo "</tr>\n";
	echo "</table>\n";

	echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"000000\" width=\"100%\"><tr><td>\n";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	echo "<tr><td style=\"background-color:$bgcolor1;height:20px;align:center;\">";

	echo "<table width=\"100%\" border=\"0\" cellspacing = \"0\" cellpadding=\"0\">\n";
	echo "<tr><td align = \"left\">\n";
    echo "&nbsp;<a href=\"modules.php?name=$AMZModule_Name\"><font class=\"title\"><strong>$text</strong></font></a></td>\n";
	if(is_admin($admin))
	{
		echo "<td align = \"center\" style=\"content\"><font class=\"content\">&nbsp;[<a href=\"admin.php?op=amazon\">NukeAmazon Admin Panel</a>]</font></td>";
	}
	echo "<td align = \"right\">";

# Shopping Cart Summary
		echo "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ShowCart\"><img src=\"images/NukeAmazon/cart.gif\" alt=\"" . _AMZYCart . " " . $items;
		if ($items > 1)
		{
			echo " " . _AMZITEMS;
		}
		else
		{
			echo " " . _AMZITEM;
		}
		echo "\" border=\"0\" height = \"11\" width =\"11\"></a> <a href=\"modules.php?name=$AMZModule_Name&amp;op=ShowCart\"><font class=\"title\">" . _AMZCART . ":</font></a> <a href=\"modules.php?name=$AMZModule_Name&amp;op=ShowCart\"><font class=\"title\">";

		echo AMZPriceFormat($total_price, $AMZLocale) . "</a>&nbsp;";
		echo "</font>";
#################################
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	echo "</td></tr></table></div>\n";
	CloseTable();
	echo "<br />";
}

Function StarsImage($Rating)
{
	$Star = explode(".", $Rating);
	$StarRatingGif = $Star[0];
	if ($Star[1] > 4)
	{
		$StarRatingGif .= "-5";
	}
	else
	{
		$StarRatingGif .= "-0";
	}
	$starimageurl = "<img src=\"http://g-images.amazon.com/images/G/01/x-locale/common/customer-reviews/stars-" . $StarRatingGif . ".gif\" width=\"64\" height=\"12\" align=\"middle\" alt = \"" . $Star[0];
	if ($Star[1] > 0)
	{
		$starimageurl .= "." . $Star[1];
	}
	$starimageurl .= " " . _AMZSTARS."\">";
	return $starimageurl;
}

function get_book_details($asin)
{
	global $db, $prefix;
	if(is_array($asin))
	{
		$det_count = count($asin);
		$asin = urlencode(implode(', ', $asin));
	}
	$AMZType = 'lite';
	$AMZMainProduct = false;
	$keyword = $asin;
	$BookData = amazon_search('AsinSearch', $keyword, '', $AMZType, 1);
	$i = 0;
	foreach($BookData->records as $ind => $b_arr)
	{
		$details['catalog'][$i] = $b_arr['catalog'];
		$details['productname'][$i] = $b_arr['productname'];
		$details['manufacturer'][$i] = $b_arr['manufacturer'];
		$details['image'][$i] = $b_arr['imageurlsmall'];
		$details['price'][$i] = AMZRemoveCurrency($b_arr['ourprice']);
		if (strtolower($b_arr['ourprice']) == "too low to display")
		{
			$details['price'][$i] = "" . _AMZTOOLOW . "";
		}
		if ($details['price'][$i] == "")
		{
			$details['price'][$i] = AMZRemoveCurrency($b_arr['listprice']);
		}
	# Product Image
		$size = GetImageSize($b_arr['imageurlsmall']);
		if ( $size[0] > 2 && $size[1] > 2 )
		{
			$details['image'][$i] = $b_arr['imageurlsmall'];
		}
		else
		{
			$catalog = strtolower($ProductCatalog);
			$sql = "SELECT no_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'";
			$result = $db->sql_query($sql);
			list($details['image'][$i]) = $db->sql_fetchrow($result);
		}
		$i++;
	}
	return $details;
}

function MarketPlaceDetail($amazon, $ImageSize, $MainProd, $cols, $AMZSEARCH)
{
	global $db, $prefix, $amazon_id, $AMZModule_Name, $AMZMore, $admin, $AMZShowReview, $AMZShowSimilar, $AMZQuickAdd, $AMZLocale, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2;

	if(!is_array($amazon->records))
	{
	    echo 'Error!';
	    exit;
	}

# Change Error
# We encountered an error processing your request. Please retry.
# Confrontamos problemas al hacer su busqueda. Por favor trate luego.
	if(isset($amazon->errorMsg))
	{
	    return "<center>{$amazon->errorMsg}</center>";
	    exit;
	}

	$AMZCount = count($amazon->records);

	$content = "";
	$showmore = true;

#	Start Table

#	$content .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\"><tr><td>\n";
	foreach($amazon->records as $ind => $arr)
	{
		if ($count == $cols)
		{
	    	$content .= "<tr><td>\n";
	    	$count = 0;
		}
# Extract fields of interest but first clear from previews pass.
		$Asin           = "";
		$ProductCatalog = "";
		$ProductName    = "";
		$Author         = "";
		$OurPrice       = "";
		$ListPrice      = "";
		$UsedPrice      = "";
		$CollectiblePrice   = "";
		$ThirdPartyNewPrice = "";
		$Savings        = "";
		$UsedPrice      = "";
		$ImageUrl       = "";
		$NumberOfOfferings = "";
		$MinMarketPrice = "";
		$MarketPlacePrice = "";


# Product Info
		$Asin                = $arr['asin'];
		$ProductName         = $arr['productname'];

# Price
		$OurPrice            = $arr['ourprice'];
		if (strtolower($OurPrice) == "too low to display")
		{
			$OurPrice = "" . _AMZTOOLOW . "";
		}
		$ListPrice           = $arr['listprice'];
		$Savings             = AMZsavings($ListPrice, $OurPrice);

# Product Image
		$size = GetImageSize($arr['imageurlsmall']);
		if ( $size[0] > 2 && $size[1] > 2 )
		{
			switch ($ImageSize)
			{
				case "small":
					$ImageUrl = $arr['imageurlsmall'];
					break;
				case "medium":
					$ImageUrl = $arr['imageurlmedium'];
					break;
				case "large":
					$ImageUrl = $arr['imageurllarge'];
					break;
			}
		}
		else
		{
			$catalog = strtolower($ProductCatalog);
			$sql = "SELECT no_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'";
			$result = $db->sql_query($sql);
			list($ImageUrl) = $db->sql_fetchrow($result);
			$NoImage = true;
		}

# MarketPlace Seller Profile
		if ($AMZSEARCH[0] == "SellerProfile")
		{
			if (count($arr['sellernickname'])==1)
			{
				$OverallFeedbackRating = number_format($arr['overallfeedbackrating'], 1);
				$starimageurl = StarsImage($OverallFeedbackRating);
				$NumberOfFeedback = $arr['numberoffeedback'];
				$StoreName = implode($arr['sellernickname']);
				$Feedback = count($arr['feedbackrating']);

				$Profile = "<table width=\"100%\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">";
				$Profile .= "<tr>";
				$Profile .= "<td width=\"80%\" valign=\"top\ align=\"center\">\n";
				$Profile .= "<strong>$StoreName</strong><p>";
				$Profile .= _AMZRATING . ": $starimageurl " . number_format($OverallFeedbackRating, 1) . " " . _AMZPRODUCTTOTAL3 . " 5.0  ($NumberOfFeedback Reviews)<br />";
				$Profile .= "</td>";
				$Profile .= "</tr>";
				$Profile .= "</table><br />";
				$Profile .= "<table width=\"80%\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">";
				$Profile .= "<tr>";
				$Profile .= "<td colspan=\"2\"><strong>" . _AMZFEEDBACK . ":</strong><p></td></tr>";
				$i =0;
				while ($Feedback > $i)
				{
					$Profile .= "<tr>";
					$Profile .= "<td width=\"10%\" valign=\"top\ valign=\"middle\">&nbsp;</td>\n";
					$Profile .= "<td width=\"80%\" valign=\"top\ valign=\"center\">\n";
					$Profile .= number_format($arr['feedbackrating'][$i], 1) . " " . _AMZPRODUCTTOTAL3 . " 5.0 : \"" . $arr['feedbackcomments'][$i] . "\"<br />";
					$Profile .= "<strong>" . _DATE . ":</strong> " . $arr['feedbackdate'][$i] . "&nbsp;&nbsp;";
					$Profile .= "<strong>" . _AMZRATER . ":</strong> " . $arr['feedbackrater'][$i] . "<hr>";
					$Profile .= "</td>";
					$Profile .= "<td width=\"10%\" valign=\"top\ align=\"center\">&nbsp;</td>\n";
					$Profile .= "</tr>";
					$i++;
				}
				$Profile .= "</table><br />";
			}
			else
			{
				$Profile = "<table width=\"100%\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">";
				$Profile .= "<tr>";
				$Profile .= "<td valign=\"top\ align=\"center\">\n";
				$Profile .= "No Data";
				$Profile .= "</td>";
				$Profile .= "</tr>";
				$Profile .= "</table><br />";
			}
		}

# MarketPlace Offer
		if ($arr['numberofofferings'])
		{
			$OfferContents = "<table border=\"0\" width=\"100%\">\n";
			$OfferContents .= "<tr>\n";
			$OfferContents .= "<td valign=\"top\">\n";
			$OfferContents .= "<img src=\"" . $ImageUrl . "\" border =\"0\" alt=\"$ProductName\">";
			$OfferContents .= "</td>";
			$OfferContents .= "<td align=\"left\" valign=\"top\">\n";
			$OfferContents .= "<h1>$ProductName</h1></td>\n";
			$OfferContents .= "<td width=\"200\" valign=\"top\" align=\"right\">";
			$OfferContents .= "<table width=\"200\" border=\"2\" cellspacing=\"2\" cellpadding=\"1\"><tr><td align=\"center\"><strong>". _AMZPRICEGLANCE ."</strong><br />";
			if ($ListPrice)
			{
				$OfferContents .= "<strong>" . _AMZLSTPRICE . ":</strong> <strike>$ListPrice</strike><br />";
			}
			if ($arr['thirdpartynewprice'])
			{
				$OfferContents .=  "<strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=ThirdPartyNew\">" . _AMZNEW . "</a></strong> " . _AMZFROM . " ". $arr['thirdpartynewprice'] . "<br />";
			}
			if ($arr['usedprice'])
			{
				$OfferContents .=  "<strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Used\">" . _AMZUSED . "</a></strong> " . _AMZFROM .  " " . $arr['usedprice'] . "<br />";
			}
			if ($arr['collectibleprice'])
			{
				$OfferContents .= "<strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Collectible\">" . _AMZCOLLECTIBLE . "</a></strong> " . _AMZFROM .  " " . $arr['collectibleprice'] . "<br />";
			}
			if ($arr['refurbishedprice'])
			{
				$OfferContents .= "<strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Refurbished\">" . _AMZREFURBISHED . "</a></strong> " . _AMZFROM . " " .  $arr['refurbishedprice'] . "<br />";
			}
			$OfferContents .= "</td></tr></table></td></tr></table>";

# Offerings
# Need to create a page system for showing the other pages
			$OfferContents .= "<table><tr><td>";
			$NumberOfOfferings = $arr['numberofofferings'];
			$Offerings = count($arr['offeringprice']);

			$market_condition = array ( "new" => _AMZNEW, "mint" => _AMZMINT, "good" => _AMZGOOD, "acceptable" => _AMZACCEPTABLE, "verygood" => _AMZVERYGOOD, "refurbished" => _AMZREFURBISHED);

			if ($Offerings > 0)
			{
				$i = 0;
				$OfferContents .= _AMZBROWSEBYT . ":   <strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=All\">" . _AMZALL . "</a></strong> ";
				if ($arr['thirdpartynewprice'])
				{
					$OfferContents .= " | <strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=ThirdPartyNew\">". _AMZNEW . "</a></strong>";
					$TypeTemp = true;
				}
				if ($arr['usedprice'])
				{
					$OfferContents .= " | <strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Used\">" . _AMZUSED . "</a></strong>";
					$TypeTemp = true;
				}
				if ($arr['collectibleprice'])
				{
					$OfferContents .=  " | <strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Collectible\">" . _AMZCOLLECTIBLE . "</a></strong>";
					$TypeTemp = true;
				}
				if ($arr['refurbishedprice'])
				{
					$OfferContents .=  " | <strong><a href=\"modules.php?name=$AMZModule_Name&amp;op=MarketPlaceSearch&amp;keyword=$Asin&amp;mode=Refurbished\">" . _AMZREFURBISHED . "</a></strong>";
				}
				$OfferContents .= "</td></tr></table>";
				$OfferContents .= "<br /><table>\n<tr><td width=\"15%\"><strong>" . _AMZBLKPRICE . "</strong></td>\n";
				$OfferContents .= "<td width=\"20%\" align=\"center\"><strong>" . _AMZCONDITION . "</strong></td>\n";
				$OfferContents .= "<td width=\"50%\"><strong>" . _AMZSELLERINFO . "</strong></td>\n";
				$OfferContents .= "<td width=\"15%\"></td>\n";
				$OfferContents .= "</tr><tr><td colspan=\"4\"><hr></td>\n";

				if ($AMZLocale == 'uk')
				{
					# UK
					$OfferContentsLink = "<input type=\"image\" name=\"submit.add-to-cart\" value=\"Buy From Amazon.co.uk\" alt=\"Buy from Amazon.co.uk\" src=\"http://images-eu.amazon.com/images/G/02/x-locale/common/buy-buttons/add-to-cart-midsize.gif\">\n";

				}
				elseif ($AMZLocale == 'de')
				{
					#DE
					$OfferContentsLink = "<input type=\"image\" name=\"submit.add-to-cart\" value=\"In den Einkaufswagen\" border=\"0\" alt=\"In den Einkaufswagen\" src=\"http://images-eu.amazon.com/images/G/03/x-locale/common/buy-buttons/simple-add-to-cart.gif\">\n";

				}
				elseif ($AMZLocale == 'jp')
				{
					#JP - check !!!!!!
					$OfferContentsLink = "<input type=\"image\" name=\"submit.add-to-cart\" value=\"In den Einkaufswagen\" border=\"0\" alt=\"In den Einkaufswagen\" src=\"http://images-eu.amazon.com/images/G/03/x-locale/common/buy-buttons/simple-add-to-cart.gif\">\n";

				}
				else
				{
					# US
					$OfferContentsLink = "<input type=\"image\" name=\"submit.add-to-cart\" value=\"Buy From Amazon.com\" alt=\"Buy from Amazon.com\" src=\"http://g-images.amazon.com/images/G/01/buttons/add-to-cart-yellow-short.gif \">\n";

				}
				while ($Offerings > $i)
				{

					$OfferContents .= "<tr style=\"border-bottom: 2px solid #000000;\">\n";
					$OfferContents .= "<td valign=\"top\"><strong>". $arr['offeringprice'][$i] . "</strong></td>\n";

					$OfferContents .= "<td valign=\"top\" align=\"center\">". $market_condition[$arr['condition'][$i]] . "</td>\n";

					$OfferContents .= "<td valign=\"top\"><strong>" . _AMZSELLER . ":</strong>";
					if ($AMZLocale == 'us')
					{
						$OfferContents .= $arr['sellernickname'][$i];
					}
					else
					{
						$OfferContents .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=SellerProfile&amp;keyword=".$arr['sellerid'][$i]."\">";
						$OfferContents .= $arr['sellernickname'][$i];
						$OfferContents .= "</a>\n";
					}
					if ($arr['sellerrating'][$i] > 0 )
					{
						$OfferContents .= " ". StarsImage(number_format($arr['sellerrating'][$i], 1));
					}
					$OfferContents .= "<br />\n";
					$OfferContents .= "<strong>" . _AMZSHIPS . ":</strong> " . $arr['sellerstate'][$i] . ", " . $arr['sellercountry'][$i] . "<br />" . $arr['exchangeavailability'][$i] . "<br />";
					$OfferContents .= "<strong>" . _AMZCOMMENTS . ":</strong> ". $arr['conditiontype'][$i] . "</td>\n";

					$OfferContents .= "<td valign=\"top\">";

					$OfferContents .= "<form method=\"POST\" action=\"http://www.amazon.";

					if ($AMZLocale == 'uk')
					{
						# UK
						$OfferContents .= "co.uk";
					}
					elseif ($AMZLocale == 'de')
					{
						#DE
						$OfferContents .= "de";
					}
					elseif ($AMZLocale == 'jp')
					{
						#JP - check!!!!!
						$OfferContents .= "co.jp";
					}
					else
					{
						# US
						$OfferContents .= "com";
					}
					$OfferContents .= "/exec/obidos/dt/assoc/handle-buy-box=$Asin\">\n";				
					$OfferContents .= "<input type=hidden name=\"exchange." . $arr['exchangeid'][$i] . ".$Asin." . $arr['sellerid'][$i] . "\" value=\"1\">\n";
					$OfferContents .= "<input type=\"hidden\" name=\"tag-value\" value=\"$amazon_id\">\n";
					$OfferContents .= "<input type=\"hidden\" name=\"tag_value\" value=\"$amazon_id\">\n";
					$OfferContents .= $OfferContentsLink;
					$OfferContents .= "</form></tr><tr><td colspan=\"4\"><hr></td>\n";
					$OfferContents .= "</tr>\n";

					$i++;
				}
				$OfferContents .= "</table><br />";
			}
			$OfferContents .= "</td></tr></table><br />";
		}
######################
# Start Content Here #
######################

		if ($OfferContents != "")
		{
			$content .= $OfferContents;
		}

		if ($Profile != "")
		{
			$content .= $Profile;
		}
	}
	return $content;
}

function featured_search($catalog, $page)
{
	global $db, $prefix, $AMZModule_Name;
	$perpage = 10;
	$sql = "select asin from ".$prefix."_amazon_items";
	$sql .= " where category = '". $catalog . "' order by hits DESC";
	$result = $db->sql_query($sql);
	$total_rows = $db->sql_numrows($result);

# Show Items
	if ($total_rows > 0)
	{
		$totalpages = ceil($total_rows / $perpage);
		if (!$page)
		{
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		$sql .= " limit $start, $perpage";
		$result = $db->sql_query($sql);
#	Start Count
		$count = 0;
		$asin_list = "$total_rows:";

		while(list($asin) = $db->sql_fetchrow($result))
		{
			if ($count > 0)
			{
				$asin_list .= ",";
			}
			$asin_list .= $asin;
			$count++;
		}
		return $asin_list;
	}
}

function catalog_image($catalog)
{
	global $db, $prefix, $AMZLocale;
	$catalog = strtolower($catalog);
	$sql = "SELECT button_image FROM ".$prefix."_amazon_catalog WHERE r_catalog = '$catalog'  and locale = '$AMZLocale'";
	$result = $db->sql_query($sql);
	list($CatImageUrl) = $db->sql_fetchrow($result);
	return $CatImageUrl;
}

function page_links($page, $perpage, $total_rows, $Link)
{
# Show Page Links
# Modify to show previous/more images
	# Is there more than 1 page...
	if ($total_rows > 0)
	{
		# Determina Number of pages
		$totalpages = ceil($total_rows / $perpage);

		# If Page number is not set then page number = 1
		if (!$page)
		{
			$page = 1;
		}
		# Determine start page..
		$start = $page - 5;

		# If lower than 1 then start page = 1
		if ($start < 1)
		{
			$start = 1;
		}

		# Determine End Page
		$end = $start + 9;

		# If higher than togal pages, then end = total pages and fix start.
		if ($end > $totalpages)
		{
			$end = $totalpages;
			$start = $end - 9;
			# Make shure start is not lower than 1.
			if ($start < 1)
			{
				$start = 1;
			}
		}
		$AMZPages = "";

		# If there are more than 1 page then show page numbers...
		if ($totalpages >= 2)
		{
			$AMZPages .= _AMZPAGE;
			$back = $page - 1;

			# Show 'Back' if back page is 1 or more
			if ($back >= 1 )
			{
				$AMZPages .= "<a href=\"$Link&amp;AMZpage=$back\">" . _AMZBACK . "</a>, ";
			}

			# Always show a link to Page 1
			if ($start > 1)
			{
				$AMZPages .= "<a href=\"$Link&amp;AMZpage=1\">1</a>, ";

				# If start is more than 2 then show ... between 1 and start
				if ($start > 2)
				{
					$AMZPages .= "... ";
				}
			}

			# Show Numbers from start to end
			for ($i = $start; $i <= $end; $i++)
			{
				# If page is the same as the number showing, then put the number with out a link.
				if ($page == $i)
				{
					$AMZPages .= "<strong>$page</strong>";
				}
				# ... else put the link to the page number.
				else
				{
					$AMZPages .= "<a href=\"$Link&amp;AMZpage=$i\">$i</a>";
				}
				if ($i != $end)
				{
					$AMZPages .= ", ";
				}
			}
			# Determine 'next' page
			$next = $page + 1;
			# If there are more pages, show a link to the last page.
			if ($end < $totalpages)
			{
				# Do we need to put a '...'
				if ($end < $totalpages - 1)
				{
					$AMZPages .= " ... ";
				}
				# Or do we need to put a ', '
				elseif ($end = $totalpages - 1)
				{
					$AMZPages .= ", ";
				}
				$AMZPages .= "<a href=\"$Link&amp;AMZpage=$totalpages\">$totalpages</a>";
			}

			# Show 'next' page link when needed.
			if ($next <= $totalpages)
			{
				$AMZPages .= ", <a href=\"$Link&amp;AMZpage=$next\">" . _AMZNEXT . "</a>";
			}
			$AMZPages .= " ";
#			$AMZPages .= "</center>";
			$AMZPages .= "<br />";
		}
		return $AMZPages;
	}
}

function show_catalog()
{
	global $db, $prefix, $AMZLocale, $AMZModule_Name, $bgcolor2;

	$sql = "SELECT AMZLocale FROM ".$prefix."_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale) = $db->sql_fetchrow($result);

	$sql = "SELECT catalog, node FROM ".$prefix."_amazon_nodes where pnode is null and locale = '$AMZLocale' order by catalog";
	$result = $db->sql_query($sql);
	echo AMZBorder(_AMZBrowseCatalogs);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\"><tr>\n";
	while (list($cat, $node) = $db->sql_fetchrow($result))
	{
		if ($count == 3) {
	    	echo "<tr>\n";
	    	$count = 0;
		}
		echo "<td width=\"33%\" valign=\"middle\" align=\"left\">\n";
		$link = "<a href=\"modules.php?name=$AMZModule_Name&amp;op=BrowseNodeSearch&amp;keyword=$node&amp;mode=". urlencode(strtolower(Get_Cat_Mode($cat))) . "\">";
		$desc = Get_Cat_Desc($cat);
		echo "$link<img src='" . catalog_image(strtolower($cat)) . "' border = \"0\" align=\"middle\" alt=\"$desc\"></a> $link" . $desc . "</a><br />";
		echo "</td>\n";
		$count++;
		if ($count == 3) {
			echo "</tr>\n";
		}
	}
	if ($count == 3)
	{
		echo "</table>\n";
	} else {
		echo "</tr></table>\n";
	}
}

function show_sub_catalog($catalog)
{
	global $db, $prefix, $AMZLocale, $AMZModule_Name, $bgcolor2;

	$sql = "SELECT AMZLocale, ImageType FROM ".$prefix."_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale, $AMZImgType) = $db->sql_fetchrow($result);
	$c_content = "";
	$sql = "SELECT node, description FROM ".$prefix."_amazon_nodes where pnode is not null and locale = '$AMZLocale' and catalog = '$catalog' order by RAND() LIMIT 15";
	$result = $db->sql_query($sql);
	$numrows = $db->sql_numrows($result);
	$c_content = "";
	if ($numrows > 0)
	{
		$c_content .= AMZBorder(Get_Cat_Desc($catalog));
		$c_content .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
		$c_content .= "<tr><td width=\"60%\">";
		$c_content .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\"><tr>\n";
		$count = 0;
		while (list($node, $desc) = $db->sql_fetchrow($result))
		{
			if ($count == 3)
			{
				$c_content .= "<tr>\n";
				$count = 0;
			}
			$c_content .= "<td width=\"33%\" valign=\"middle\" align=\"left\">\n";
			$link = "<a href=\"modules.php?name=$AMZModule_Name&amp;op=BrowseNodeSearch&amp;keyword=$node&amp;mode=". urlencode(strtolower(Get_Cat_Mode($catalog))) . "\">";
			$c_content .= $link . $desc . "</a>\n";
			$c_content .= "</td>\n";
			$count++;
			if ($count == 3)
			{
				$c_content .= "</tr>\n";
			}
		}
		if ($count == 3)
		{
			$c_content .= "</table>\n";
		}
		else
		{
			$c_content .= "</tr></table>\n";
		}
		$c_content .= "</td><td width=\"40%\">";

		$asin_show = GetAsin(strtolower($catalog));
		$c_rowspan = ceil($total_rows / 3);
		$shown = true;

		$AMZType = 'lite';
		$AMZMainProduct = false;
		$keyword = $asin_show;
		$BookData = amazon_search('AsinSearch', $keyword, strtolower($catalog), $AMZType, 1);

		$c_content .= "<table><tr><td width=\"20%\">\n";
		foreach ($BookData->records as $ind => $c_arr)
		{
			$Asin          = $c_arr['asin'];
			$ProductName   = $c_arr['productname'];
			$ListPrice     = $c_arr['listprice'];
			$OurPrice      = $c_arr['ourprice'];
			$Savings       = AMZsavings($ListPrice, $OurPrice);
			$ImageUrl      = $c_arr['imageurlsmall'];
			if ($Savings[1] > 0 )
			{
				if ($Savings[1] > 0 && !$NoImage && $AMZImgType != "NO")
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
			}
			$LinkURL = "modules.php?name=Amazon&amp;asin=$Asin";
			$LinkStartStr = "<a href=\"$LinkURL\">";

# Manufacturer Publisher for books and magazine; studio for video, dvd, music; manufacturer for whatever..
# Manufacturer search options for valid searches.
			if($c_arr['manufacturer'])
			{
				if ($catalog == "DVD" || $catalog == "Video")
				{
					$Manf = ""._AMZSTUDIO."";
				}
				elseif ($catalog == "Book" || $catalog == "Magazine")
				{
					$Manf = ""._AMZPUBLISHER."";
				}
				elseif ($catalog == "Music")
				{
					$Manf = ""._AMZLABEL."";
				}
				else
				{
					$Manf = ""._AMZMANUFACTURER."";
				}
				$Manufacturer = "<strong>".$Manf.":</strong> ";
				$PCat = strtolower($catalog);
				if ($PCat == "photo" || $PCat == "video games" || $PCat == "personal computer" || $PCat == "electronics" || $PCat == "kitchen" || $PCat == "software" )
				{
					$Manufacturer .= "<a href=\"modules.php?name=$AMZModule_Name&amp;op=ManufacturerSearch&amp;keyword=" . AMZ_URL_Verify($c_arr['manufacturer']) . "&amp;mode=".strtolower($catalog) . "\">" . $c_arr['manufacturer'] . "</a>";
				}
				else
				{
					$Manufacturer .= $c_arr['manufacturer'];
				}
			}
			$c_content .= $LinkStartStr;
			$c_content .= "<img src=\"".$ImageUrl."\" border =\"0\" alt=\"$ProductName\">";
			$c_content .= "</a>";
			$c_content .= "</td>\n";
			$c_content .= "<td width=\"80%\">\n";
			$c_content .= $LinkStartStr;
			$c_content .= "<strong>$ProductName</strong>";
			$c_content .= "</a>";
			$c_content .= "<br />";
			if ($ListPrice)
			{
				$c_content .= "<strong>" . _AMZLSTPRICE . ":</strong> <strike>$ListPrice</strike><br />";
			}
			if ($OurPrice)
			{
				$c_content .= "<font color=\"DarkRed\"><strong>" . _AMZPRICE . ": $OurPrice</strong></font><br />";
			}
			if ($Savings[1] > 0)
			{
				$c_content .= "<strong>" . _AMZSAVE . ":</strong> " . AMZPriceFormat($Savings[0], $AMZLocale);
				$c_content .= " ($Savings[1]% " . _AMZPERCENT . ")<br />";
			}
			if ($Manufacturer)
			{
				$c_content .= $Manufacturer;
				$c_content .= "<br />";
			}
			$c_content .= "<a href=\"modules.php?name=$AMZModule_Name&amp;asin=$Asin\">" . _AMZMORE . "</a>";

		}
		$c_content .= "</td></tr></table>\n";
		$c_content .= "</td></tr></table>\n";
	}
	return 	$c_content;
}

function show_all_catalog()
{
# This will show all catalogs where there are featured items
	global $db, $prefix, $AMZLocale, $AMZModule_Name, $bgcolor2;

	$sql = "SELECT r_catalog FROM ".$prefix."_amazon_department WHERE items >= 1 order by r_catalog";
	$result = $db->sql_query($sql);
	echo AMZBorder(_AMZBrowseCatalogs);
	echo "<br />";
	while (list($cat) = $db->sql_fetchrow($result))
	{
		echo show_sub_catalog($cat);
		echo "<br />";
	}
}

function AMZSimilar($amazon)
{
	global $db, $AMZModule_Name, $bgcolor1, $bgcolor2, $AMZImgType, $prefix, $AMZDefault_Asin;

	$content = 	"<table width=\"100%\" border=\"0\" BGCOLOR=\"$bgcolor2\" cellspacing=\"0\" cellpadding=\"1\">\n";
	$content .= "<tr><td align =\"center\"><table width=\"100%\" border=\"0\" BGCOLOR=\"$bgcolor1\" cellspacing=\"2\" cellpadding=\"2\">";
	$content .= "<tr><td align =\"center\" style=\"background-color:$bgcolor2\">\n";
	$content .= "<strong>" . _AMZRELATED . "</strong></td></tr>\n";
	$content .= "<tr><td align =\"center\" style=\"background-color:$bgcolor1\">\n";

	$AMZ_Similar_Count = count($amazon->records);
	if ($AMZ_Similar_Count < 1)
	{
	# No Similar Data is Available. Then use the default ASIN.
		$Asin = $AMZDefault_Asin;
		$amazon = amazon_search('SimilaritySearch', $Asin, '', 'lite', 1);
	}
	foreach($amazon->records as $ind => $arr) {

	# Extract fields of interest but first clear from previews pass.
		$Asin          = "";
		$ProductName   = "";
		$OurPrice      = "";
		$ListPrice     = "";
		$ImageUrl      = "";
		$Manufacturer  = "";

		$Asin          = $arr['asin'];
		$ProductName   = $arr['productname'];
		$Manufacturer  = $arr['manufacturer'];
		$OurPrice      = $arr['ourprice'];
		$ListPrice     = $arr['listprice'];

		$OurPrice            = $arr['ourprice'];
		if (strtolower($OurPrice) == "too low to display")
		{
			$OurPrice = "" . _AMZTOOLOW . "";
		}
		if ($OurPrice == "")
		{
			$OurPrice = $arr['listprice'];
		}
		$ListPrice = $arr['listprice'];
		if ($ListPrice == "")
		{
			$ListPrice = $OurPrice;
		}
		if ($ListPrice > $OurPrice)
		{
			$Savings = AMZsavings($ListPrice, $OurPrice);
		}
		$ImageUrl      = $arr['imageurlsmall'];
		if ($Savings[1] > 0 )
		{
			if ($Savings[1] > 0 && !$NoImage && $AMZImgType != "NO")
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
		}

		$LinkURL = "modules.php?name=$AMZModule_Name&amp;asin=$Asin";
		$LinkStartStr = "<a href=\"$LinkURL\">";

		$prodName = $arr['productname'];
		if (strlen($prodName) > 50)
		{
			$prodName = rtrim(substr($prodName, 0, 50)).'&nbsp;...';
		}

		$content .= $LinkStartStr . "<img src=\"" . $ImageUrl . "\" vspace=\"2\"  border=\"0\" alt=\"$ProductName\"></a><br />";

		$content .= $LinkStartStr . "$prodName</a>";
		$content .= "<br />";

# Price
		if ($listprice > $ourprice)
		{
			$content .= "" . _AMZBLKLSTPRICE . ": <strike><strong>$listprice</strong></strike><br />";
			$content .= "" . _AMZBLKPRICE . ": <font color=\"DarkRed\"><strong>$OurPrice</strong></font><br />";
		}
		else
		{
			 $content .= "" . _AMZBLKPRICE . ": <font color=\"DarkRed\"><strong>$OurPrice</strong></font><br />";
		}
		$content .= "<br />";

	}
	$content .= "</td></tr></table>";
	$content .= "</td></tr></table>";
	return $content;
}

function AMZBorder($text)
{
	global $db, $bgcolor1, $bgcolor2, $textcolor2, $textcolor1;

	$Aborder = "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"000000\" width=\"100%\"><tr><td>";
	$Aborder .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" width=\"100%\">\n";
	$Aborder .= "<tr><td align = \"left\">";
	$Aborder .= "<font color=\"$textcolor2\"><strong>$text</strong></font>";
	$Aborder .= "</td></tr></table>";
	$Aborder .= "</td></tr></table>\n";
	return 	$Aborder;
}

function node_desc($node)
{
	global $db, $prefix, $AMZLocale, $AMZModule_Name, $bgcolor2;

	$sql = "SELECT catalog, description FROM ".$prefix."_amazon_nodes where node = $node and locale = '$AMZLocale'";
	$result = $db->sql_query($sql);
	list($catalog, $node_desc) = $db->sql_fetchrow($result);
	$c_content = Get_Cat_Desc($catalog) . ": " . $node_desc;
	return $c_content;
}

function AMZ_popgraphic($asin) {
	global $db, $AMZ_Popular, $prefix;

	$sql = "SELECT hits FROM ".$prefix."_amazon_items";
	$sql .= " where asin='$asin'";
	$result = $db->sql_query($sql);
	list($hits) = $db->sql_fetchrow($result);
	$AMZ_Text = "";
    if ($hits >= $AMZ_Popular)
	{
		$AMZ_Text = "&nbsp;<img src=\"images/NukeAmazon/popular.gif\" width=\"13\" height=\"12\" border=\"0\" alt=\""._AMZPOPULAR."\">";
    }
	return $AMZ_Text;
}

# Shopping Cart Functions

function calculate_price($AMZCartID)
{
	global $db, $AMZModule_Name, $admin, $AMZCartID, $AMZLocale, $amazon_id, $prefix;
	$price = 0.0;
	// The shopping cart needs to verify the cookies
	if(!isset($_COOKIE['AMZCartID']))
	{
		$AMZCartID = md5(uniqid(rand()));
		setcookie("AMZCartID", $AMZCartID, time() + 31536000);
	}
	else
	{
		$AMZCartID = $_COOKIE['AMZCartID'];
		# sum total price for all items in shopping cart
		$SQL = "SELECT asin, quantity FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID'";
		$result = $db->sql_query($SQL);
		while(list($asin, $quantity) = $db->sql_fetchrow($result))
		{
			$amazon = amazon_search('AsinSearch', $asin, '', 'lite', '');
			foreach ($amazon->records as $ind => $arr)
			{
				$price += AMZRemoveCurrency($arr['ourprice']) * $quantity;
			}
		}
	}
	return $price;
}

function calculate_items($AMZCartID)
{
	global $db, $AMZModule_Name, $admin, $AMZCartID, $AMZLocale, $amazon_id, $prefix;
# sum total items in shopping cart
	$items = 0;
// The shopping cart needs to verify the cookies
	if(!isset($_COOKIE['AMZCartID']))
	{
		$AMZCartID = md5(uniqid(rand()));
		setcookie("AMZCartID", $AMZCartID, time() + 31536000);
	}
	else
	{
		$AMZCartID = $_COOKIE['AMZCartID'];
		# Determine total items in shopping cart
		$SQL = "SELECT sum(quantity) FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID'";
		$result = $db->sql_query($SQL);
		list($items) = $db->sql_fetchrow($result);
	  }
	return $items;
}

function AMZ_Cart($asin, $quantity, $save, $cartnode)
{
	global $db, $AMZModule_Name, $admin, $AMZCartID, $AMZLocale, $amazon_id, $prefix;

	if($asin)
	{
	# Add New item to cart
	# The shopping cart needs to verify the cookies
		if(!isset($_COOKIE['AMZCartID']))
		{
			$AMZCartID = md5(uniqid(rand()));
			setcookie("AMZCartID", $AMZCartID, time() + 31536000);
		}
		else
		{
			$AMZCartID = $_COOKIE['AMZCartID'];
		}
		$SQL = "SELECT quantity FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID' AND asin ='$asin'";
		$result = $db->sql_query($SQL);
		$numrows = $db->sql_numrows($result);
		// they don't have that product in their cart?  Put it in.
		if($numrows == 0)
		{
			$SQL = "INSERT INTO " . $prefix . "_amazon_cart values (NULL,'$AMZCartID','$asin','1', now())";
			$result = $db->sql_query($SQL);
		}
           // They have the product in their cart already?  Add the quantity they specified
           // to the product they have in their cart
		else
		{
				$sql = "update " . $prefix . "_amazon_cart set quantity=quantity+1 where session='$AMZCartID' AND asin='$asin'";
				$result = $db->sql_query($sql);
		}
	}
	# Update Cart
	if($save)
	{
		foreach ($quantity as $asin => $qty)
		{
			if($qty =="0")
			{
	           $SQL = "DELETE FROM " . $prefix . "_amazon_cart WHERE session='$AMZCartID' AND asin='$asin'";
			}
			else
			{
				$SQL = "UPDATE " . $prefix . "_amazon_cart SET quantity='$qty' ";
				$SQL .= "WHERE session='$AMZCartID' AND asin='$asin'";
			}
			$result = $db->sql_query($SQL);
		}
	}

	AMZCacheClear();

	include_once("header.php");
    include_once("includes/NukeAmazon/js.php");

	AMZtitle("" . _AMZCART . "");

	$AMZ_No_CheckOut = false;
	if($AMZCartID && calculate_items($AMZCartID) > 0)
	{
		display_cart($AMZCartID);
	}
	else
	{
		echo "<p>There are no items in your cart";
		$AMZCartID = $_COOKIE['AMZCartID'];
		echo "<hr>";
		$AMZ_No_CheckOut = true;
	}

	$target = "modules.php?name=$AMZModule_Name&amp;op=home";

# if we have just added an item to the cart, continue shopping in that category
	if($cartnode)
	{
		$cartnode = str_replace(":", "&amp;", $cartnode);
		$target = "modules.php?name=$AMZModule_Name&amp;op=" . $cartnode;
	}

	display_button($target, "continue-shopping", "Continue Shopping");

	$path = $PHP_SELF;
	$path = str_replace("show_cart.php", "", $path);

###########################################

	if (!$AMZ_No_CheckOut)
	{
		if ($AMZLocale == 'us')
		{
			$XMLServer = 'http://xml.amazon.com';
			$filename = $XMLServer . '/onca/xml3?ShoppingCart=add&f=xml&dev-t=D26KX4UZL7OM3R&t=' . $amazon_id;

			# sum total price for all items in shopping cart
			$SQL = "SELECT asin, quantity FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID'";
			$result = $db->sql_query($SQL);
			while(list($asin, $quantity) = $db->sql_fetchrow($result))
			{
				$amazon = amazon_search('AsinSearch', $asin, '', 'lite', '');
				foreach ($amazon->records as $ind => $arr)
				{
					$filename .= '&Asin.' . $asin . '=' . $quantity;
				}
			}

			$String = AMZ_file_get_contents($filename);

			$start = "<PurchaseUrl>";
			$end = "</PurchaseUrl>";
			$start_position = strpos($String, $start) + strlen($start);
			$end_position = strpos($String, $end);
			$length = $end_position - $start_position;

			$PurchaseUrl = trim(substr($String, $start_position, $length));

			# Verificar este error!!!!
			#
			# We encountered an error processing your cart please try later
			#
			$target = $PurchaseUrl;
			display_button($target, "start-checkout", "Proceed To Checkout");
		}
		else
		{
			echo "<center>";
			$SQL = "SELECT asin, quantity FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID'";
			$result = $db->sql_query($SQL);
			list($asin, $quantity) = $db->sql_fetchrow($result);
			if ($AMZLocale == 'uk')
			{
				echo "<form method=\"POST\" action=\"http://www.amazon.co.uk/exec/obidos/dt/assoc/handle-buy-box=$asin\">\n";
			}
			elseif ($AMZLocale == 'de')
			{
				echo "<form method=\"POST\" action=\"http://www.amazon.de/exec/obidos/dt/assoc/handle-buy-box=$asin\">\n";
			}
			else # JP
			{
				echo "<form method=\"POST\" action=\"http://www.amazon.co.jp/exec/obidos/dt/assoc/handle-buy-box=$asin\">\n";
			}
			echo "<input type=\"hidden\" name=\"asin.$asin\" value=\"$quantity\">\n";

			while(list($asin, $quantity) = $db->sql_fetchrow($result))
			{
				echo "<input type=\"hidden\" name=\"asin.$asin\" value=\"$quantity\">\n";
			}
			echo "<input type=\"hidden\" name=\"tag-value\" value=\"$amazon_id\">\n";
			echo "<input type=\"hidden\" name=\"tag_value\" value=\"$amazon_id\">\n";
			echo "<input type=\"hidden\" name=\"dev-tag-value\" value=\"D26KX4UZL7OM3R\">\n";
			if ($AMZLocale == 'uk')
			{
				echo "<input type=\"image\" name=\"submit.add-to-cart\" value=\"Buy From Amazon.co.uk\" alt=\"Buy from Amazon.co.uk\" src=\"http://g-images.amazon.com/images/G/02/x-locale/common/buttons/proceed-to-checkout-small.gif\">\n";
			}
			elseif ($AMZLocale == 'de')
			{
				echo "<input type=\"image\" name=\"submit.add-to-cart\" value=\"Zur Kasse gehen\" border=\"0\" alt=\"Zur Kasse gehen\" src=\"http://g-images.amazon.com/images/G/03/x-locale/common/buttons/proceed-to-checkout-small.gif\">\n";
			}
			else
			{
				#JP - check !!!!!!
				echo "<input type=\"image\" name=\"submit.add-to-cart\" value=\"In den Einkaufswagen\" border=\"0\" alt=\"In den Einkaufswagen\" src=\"http://images-eu.amazon.com/images/G/03/x-locale/common/buy-buttons/simple-add-to-cart.gif\">\n";
			}
			echo "</form>\n";
			echo "</center>";
		}
	}
	include_once("footer.php");
}

function display_button($target, $image, $alt)
{
	global $db, $AMZModule_Name;
	echo "<center><a href=\"$target\"><img src=\"images/NukeAmazon/$image" . ".gif\" alt=\"$alt\" border=0 height = 20 width = 124></a></center>";
}

function display_cart($AMZCartID, $change = true, $images = 1)
{
// display items in shopping cart
// optionally allow changes (true or false)
// optionally include images (1 - yes, 0 - no)

	global $db, $prefix, $AMZModule_Name, $AMZLocale, $amazon_id, $AMZCartID;

	$SQL = "SELECT asin, quantity FROM ". $prefix . "_amazon_cart WHERE session='$AMZCartID'";
	$result = $db->sql_query($SQL);

	echo "<table border = \"0\" width = \"100%\" cellspacing = \"0\">";
	echo "<FORM METHOD = \"POST\" ACTION=\"modules.php?name=$AMZModule_Name\">\n";
	echo "   <INPUT TYPE = \"HIDDEN\" NAME = \"op\" VALUE = \"ShowCart\">\n";
	echo "   <tr><th colspan = ". (1+$images) ." bgcolor=\"#cccccc\">Item</th>
          <th bgcolor=\"#cccccc\">" . _AMZBLKPRICE . "</th><th bgcolor=\"#cccccc\">Quantity</th>
          <th bgcolor=\"#cccccc\">Total</th></tr>";

  //display each item as a table row
	while(list($asin, $quantity) = $db->sql_fetchrow($result))
	{
		$book = get_book_details($asin);
		echo "<tr>";
		if($images ==true)
		{
			echo "<td align = left>";
			echo "<img src=\"" . $book['image'][0] . "\" border=\"0\">";
		}
		else
		{
			echo "&nbsp;";
		}
		echo "</td>";
		echo "<td align = left>";
		echo "<a href = \"modules.php?name=Amazon&amp;asin=$asin\">".$book['productname'][0]."</a>";
		echo "</td><td width = \"100\" align = \"center\">" . AMZPriceFormat($book['price'][0], $AMZLocale);
		echo "</td><td align = \"center\">";

		// if we allow changes, quantities are in text boxes
		if ($change == true)
		{
			echo "<input type = \"text\" size = \"3\" name = \"quantity[$asin]\" value = \"$quantity\" >";
		}
		else
		{
			echo $quantity;
		}
		echo "</td><td align = \"center\">" . AMZPriceFormat($book['price'][0]*$quantity, $AMZLocale);
	}
	// display total row
	$total_price = calculate_price($AMZCartID);
	$items = calculate_items($AMZCartID);
	echo "<tr>
		 <th colspan = ". (2+$images) ." bgcolor=\"#cccccc\">&nbsp;</td>
		 <th align = center bgcolor=\"#cccccc\">
		 $items
		 </th>
		 <th align = center bgcolor=\"#cccccc\">";
	echo  AMZPriceFormat($total_price, $AMZLocale) .
		 "</th>
         </tr>";
	// display save change button
	if($change == true)
	{

		echo "<tr>
			<td colspan = ". (2+$images) .">&nbsp;</td>
            <td align = center>
				<input type = \"hidden\" name = \"op\" value = \"AddToCart\">
				<input type = \"hidden\" name = \"save\" value = \"true\">
              <input type = \"image\" src = \"images/NukeAmazon/update-subtotal.gif\"
                     value =\"Save Changes\" \"border = \"0\" alt = \"Save Changes\">
            </td>
            <td>&nbsp;</td>
        </tr>";
	}
	echo "</form></table>";
}

# End Shopping Cart Functions

function AMZIS($asin, $size)
{
	global $db, $prefix;
	$sql = "SELECT AMZLocale FROM ".$prefix."_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale) = $db->sql_fetchrow($result);

	if ($AMZLocale == "us" || $AMZLocale == "ca")
	{
		$AMZImage_Server = "http://images.amazon.com/images/P/" . $asin . ".01." . $size . "ZZZZZZZ.jpg";
	}
	elseif ($AMZLocale == "jp")
	{
		$AMZImage_Server = "http://images.amazon.com/images/P/" . $asin . ".09." . $size . "ZZZZZZZ.jpg";
	}
	elseif ($AMZLocale == "uk")
	{
		$AMZImage_Server = "http://images-eu.amazon.com/images/P/" . $asin . ".02." . $size . "ZZZZZZZ.jpg";
	}
	elseif ($AMZLocale == "de")
	{
		$AMZImage_Server = "http://images-eu.amazon.com/images/P/" . $asin . ".03." . $size . "ZZZZZZZ.jpg";
	}
	elseif ($AMZLocale == "fr")
	{
		$AMZImage_Server = "http://images-eu.amazon.com/images/P/" . $asin . ".08." . $size . "ZZZZZZZ.jpg";
	}
	return $AMZImage_Server;
}

function AMZUpdateDepartmentStats()
{
# Update Product Department Statistics..
	global $prefix, $db;

	$sql = "SELECT AMZLocale FROM ".$prefix."_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale) = $db->sql_fetchrow($result);

	$sql = "SELECT r_catalog FROM ".$prefix."_amazon_catalog WHERE locale = '$AMZLocale'";
	$result = $db->sql_query($sql);
	while(list($catalog) = $db->sql_fetchrow($result))
	{
		$NEWSQL = "select count(*) from " . $prefix . "_amazon_items";
		$sql .= " where category = '$catalog'";
		$resultm = $db->sql_fetchrow($result);
		list($totalcatalog) = $db->sql_fetchrow($result);
		$nsql = "update " . $prefix . "_amazon_department set items=$totalcatalog where r_catalog='$catalog'";
		$nresult = $db->sql_query($nsql);
	}
}

function AMZ_URL_Verify($url)
{

	$url = str_replace ("(", "", $url);
	$url = str_replace (")", "", $url);
	$url = str_replace ('"', "", $url);
	$url = str_replace ("'", "", $url);
	$url = str_replace ("&", "", $url);
	$url = str_replace ("  ", " ", $url);
	$url = str_replace ("Ä", "AE", $url);
	$url = str_replace ("Æ", "AE", $url);
	$url = str_replace ("ä", "ae", $url);
	$url = str_replace ("æ", "ae", $url);
	$url = str_replace ("à", "a", $url);
	$url = str_replace ("á", "a", $url);
	$url = str_replace ("â", "a", $url);
	$url = str_replace ("â", "a", $url);
	$url = str_replace ("ã", "a", $url);
	$url = str_replace ("å", "a", $url);
	$url = str_replace ("À", "A", $url);
	$url = str_replace ("Á", "A", $url);
	$url = str_replace ("Â", "A", $url);
	$url = str_replace ("Ã", "A", $url);
	$url = str_replace ("Å", "A", $url);
	$url = str_replace ("Ç", "C", $url);
	$url = str_replace ("ç", "c", $url);
	$url = str_replace ("è", "e", $url);
	$url = str_replace ("é", "e", $url);
	$url = str_replace ("ê", "e", $url);
	$url = str_replace ("ë", "e", $url);
	$url = str_replace ("È", "E", $url);
	$url = str_replace ("É", "E", $url);
	$url = str_replace ("Ê", "E", $url);
	$url = str_replace ("Ë", "E", $url);
	$url = str_replace ("Ì", "I", $url);
	$url = str_replace ("Í", "I", $url);
	$url = str_replace ("Î", "I", $url);
	$url = str_replace ("Ï", "I", $url);
	$url = str_replace ("ì", "i", $url);
	$url = str_replace ("í", "i", $url);
	$url = str_replace ("î", "i", $url);
	$url = str_replace ("ï", "i", $url);
	$url = str_replace ("Ñ", "N", $url);
	$url = str_replace ("ñ", "n", $url);
	$url = str_replace ("Ö", "OE", $url);
	$url = str_replace ("ö", "oe", $url);
	$url = str_replace ("Ò", "O", $url);
	$url = str_replace ("Ó", "O", $url);
	$url = str_replace ("Ô", "O", $url);
	$url = str_replace ("Õ", "O", $url);
	$url = str_replace ("ò", "o", $url);
	$url = str_replace ("ó", "o", $url);
	$url = str_replace ("ô", "o", $url);
	$url = str_replace ("õ", "o", $url);
	$url = str_replace ("ß", "ss", $url);
	$url = str_replace ("Ù", "U", $url);
	$url = str_replace ("Ú", "U", $url);
	$url = str_replace ("Û", "U", $url);
	$url = str_replace ("Ü", "U", $url);
	$url = str_replace ("ù", "u", $url);
	$url = str_replace ("ú", "u", $url);
	$url = str_replace ("û", "u", $url);
	$url = str_replace ("û", "u", $url);
	$url = str_replace ("ü", "u", $url);
	$url = str_replace ("Ý", "Y", $url);
	$url = str_replace ("ý", "y", $url);
	$url = str_replace ("ÿ", "y", $url);
	$url = str_replace ("Ð", "D", $url);

	$url = urlencode ($url);
	return $url;
}

# Function to load the XML from File/URL [DATABASE]
function amazon_xml_loadxml($URL)
{
	global $db, $amazon_xml_cache_maxtime, $admin, $prefix;

# Define local file name
	$LocalFile = md5($URL);

# Check if xml is availible and cache age is not larger than defined
	$sql = "SELECT UNIX_TIMESTAMP(time) as unixtime, url, xml FROM ".$prefix."_amazon_cache WHERE url = '$LocalFile'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);

	$cTime = $row[unixtime];
	$cUrl = $row[url];
	$cXML = $row[xml];

	$AMZNow = time();
	if (($cTime + $amazon_xml_cache_maxtime) > $AMZNow )
	{
		$cXML = stripslashes($cXML);
		return $cXML;
	}
	else
	{
		$String = AMZ_file_get_contents($URL);
		# If no data is returned do not cache!
		if ($String != "0")
		{
			$sql = "insert into " . $prefix . "_amazon_cache values (NULL, now(), '$LocalFile', '".addslashes($String)."' )";
			$result = $db->sql_query($sql);
		}
		return $String;
	}
	return $String;
}

function AMZ_file_get_contents($filename)
{
	$fp = @fopen($filename, "r");
	if (!($fp))
	{
		return 0;
	}
	while (!feof($fp))
	{
		$temp .= utf8_decode(fread($fp, 4096));
	}
	fclose($fp);
	return $temp;
}

# $Log $
# Revision 2.7 ejd
#	- Fixed bug in accessories not showing correct items.
#	- Fixed bug not showing sub_catalog if not an admin.
#	- Quick Delete Added
#	- Minor optimizing of code.
#	- The HTML code has been HTML 4.01 Transitional Validated.
#	- Upgrade the Shopping Cart from sessions to database driven with a cookie.
#   - URL encoding enhancement for false urls
#	- Shopping Cart now available for UK and DE locales
#	   but adds only a quantity of 1 to the Amazon cart (probably an Amazon BUG)
#	- Proper currency formatting

# Revision 2.7.2 ejd
#	- Fixed Proper currency formatting.
#	- Fixed Calculated Savings error.
#	- Fixed product hits sql error.
#	- Fixed correct 'mode' for Amazon search.
#	- Fixed problem with accessories not showing.
#	- Fixed table bug for similar products
?>