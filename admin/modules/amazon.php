<?php
# $Author: ejd $
# $Date: 10/04/2004 7:11 PM $
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
global $admin_file;
if (!preg_match("/".$admin_file.".php/", $PHP_SELF)) { die ("Access Denied"); }
$result = mysql_query("select name, radminsuper from ".$prefix."_authors where aid='$aid'");
list($name, $radminsuper) = mysql_fetch_row($result);
if ($radminsuper==1) {
function amazon($page){
global $hlpfile, $prefix, $multilingual, $bgcolor1, $bgcolor3, $db, $admin_file;
	require_once("includes/NukeAmazon/functions.php");
	$perpage = 21;
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	AMZHead();
# Update Product Department Statistics..
	$sql = "SELECT AMZLocale FROM " . $prefix . "_amazon_cfg";
	$result = $db->sql_query($sql);
	list($AMZLocale) = $db->sql_fetchrow($result);
	$AMZ_SQL = "select * from " . $prefix . "_amazon_items order by hits DESC";
	$result = $db->sql_query($AMZ_SQL);
	$total_rows = $db->sql_numrows($result);
#Add Item
	OpenTable();
	echo "<div align=\"center\">Add Amazon.com Item<br><form action=\"".$admin_file.".php\" method=\"post\">\n"
	."ASIN:&nbsp;<input type=\"text\" name=\"asin\" value=\"$asin\" size=\"11\" maxlength=\"10\">&nbsp;\n"
	. "<input type=\"hidden\" name=\"op\" value=\"am_add\">\n"
	. "<input type=\"submit\" value=\"Add item\"></form></div>\n";
	CloseTable();
	echo "<br>";
# Show Items
	if ($total_rows > 0)
	{
		$totalpages = ceil($total_rows / $perpage);
		if (!$page)
		{
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		$AMZ_SQL .= " limit $start, $perpage";
		if ($totalpages >= 2)
		{
			echo "<div align=\"center\">";
			echo "[ ";
			$back = $page - 1;
			if ($back >= 1 )
			{
				echo "<a href=\"".$admin_file.".php?op=amazon1&amp;page=$back\">Back</a>&nbsp;| ";
			}
			for ($i = 1; $i <= $totalpages; $i++)
			{
				if ($page == $i)
				{
					echo "<strong>$page</strong>";
				}
				else
				{
					echo "<a href=\"".$admin_file.".php?op=amazon1&amp;page=$i\">$i</a>";
				}
				if ($i != $totalpages)
				{
					echo " | ";
				}
			}
			$next = $page + 1;
			if ($next <= $totalpages)
			{
				echo " | <a href=\"".$admin_file.".php?op=amazon1&amp;page=$next\">Next</a>";
			}
			echo " ]";
			echo "</div>";
			echo "<br>";
		}
		$result = $db->sql_query($AMZ_SQL);
		OpenTable();
		echo "<div align=\"center\"><strong><big>WARNING! NO CONFIRMATION FOR PRODUCT DELETE.</big></strong><br>If you press the DELETE button the item will be deleted with out confirmation.</strong></div>";
		$curbg = $bgcolor1;
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
#	Start Count
		while(list($iid, $asin, $hits, $category) = $db->sql_fetchrow($result))
		{
			if ($count == 3) {
		    	echo "<tr>\n";
		    	$count = 0;
			}
			echo "<td width=\"40%\" valign=\"top\" valign=\"center\"><br><center>\n";
			$LinkURL = "modules.php?name=Amazon&amp;asin=$asin";
			echo "$asin ($category)<br><a href=\"$LinkURL\">"
				."<img src=\"" . AMZIS($asin, 'T') ."\" border=\"0\"></a>"
				."<br>Clicks: $hits<br>"
				."<form action=\"".$admin_file.".php\" method=\"post\">"
				."<input type=\"hidden\" name=\"op\" value=\"am_delete\">\n"
				."<input type=\"hidden\" name=\"iid\" value=\"$iid\">\n"
				."<input type=\"submit\" value=\"Delete\"></form>\n";
		    echo "</td>\n";
			$count++;
			if ($count == 3) {
				echo "</tr>\n";
			}
		} # While Loop
	    if ($count == 3) {
			echo "</table>\n";
	   	} else {
			echo "</tr></table>\n";
		}
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<div align=\"center\">Add Amazon.com Item<br><form action=\"".$admin_file.".php\" method=\"post\">\n"
		."ASIN:&nbsp;<input type=\"text\" name=\"asin\" value=\"$asin\" size=\"11\" maxlength=\"10\">&nbsp;\n"
		. "<input type=\"hidden\" name=\"op\" value=\"am_add\">\n"
		. "<input type=\"submit\" value=\"Add item\"></form></div>\n";
	 	 CloseTable();
	}
 	include_once("footer.php");
}
function am_submit($asin){
	global $db, $prefix, $admin_file;
	$sql = "delete from ".$prefix."_amazon_not_item WHERE asin = '$asin'";
	$result = $db->sql_query($sql);
	require_once("includes/NukeAmazon/functions.php");
	$amazon = amazon_search('AsinSearch', $asin, '', 'lite', '');
	foreach ($amazon->records as $ind => $arr)
	{
		$ProductCatalog = strtolower($arr['catalog']);
		# Insert Product
		$sql = "insert into " . $prefix . "_amazon_items values (NULL, '$asin', '0', '" . $ProductCatalog . "', '0', '0' )";
		$result = $db->sql_query($sql);
		# Update amazon_department table
		$sql = "update " . $prefix . "_amazon_department set items=items+1 where r_catalog='$ProductCatalog'";
		$result = $db->sql_query($sql);
	}
    Header("Location: ".$admin_file.".php?op=amazon");
}
function am_delete($iid){
	global $db, $prefix, $admin_file;
	$sql = "delete from ".$prefix."_amazon_items WHERE iid = $iid";
	$result = $db->sql_query($sql);
	 Header("Location: ".$admin_file.".php?op=amazon");
}
function am_reset_stats(){
	global $db, $prefix, $admin_file;
	$sql = "update ".$prefix."_amazon_items set imp=0, hits=0, clicks=0";
	$result = $db->sql_query($sql);
	Header("Location: ".$admin_file.".php?op=amazon");
}
function am_delete_all_nf(){
	global $db, $prefix, $admin_file;
	$sql = "delete from ".$prefix."_amazon_not_item";
	$result = $db->sql_query($sql);
	 Header("Location: ".$admin_file.".php?op=amazon");
}
function am_delete_nf($iid)
{
	global $db, $prefix, $admin_file;
	$sql = "delete from ".$prefix."_amazon_not_item WHERE iid = $iid";
	$result = $db->sql_query($sql);
	 Header("Location: ".$admin_file.".php?op=amazon");
}
function am_add($asin)
{
global $admin_file;
	require_once("includes/NukeAmazon/functions.php");
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\"><strong>Amazon Add Item</strong></font></div>";
    CloseTable();
	echo "<br>";
	OpenTable();
	echo "<strong>ASIN:</strong> $asin<br>"
	."<img src=\"" . AMZIS($asin, 'M') . "\"><br>\n"
	."<form action=\"".$admin_file.".php\" method=\"post\">"
	. "<input type=\"hidden\" name=\"op\" value=\"am_submit\">\n"
	. "<input type=\"hidden\" name=\"asin\" value=\"$asin\">\n"
	."<strong>Add This Item?</strong><br><input type=\"submit\" value=\"Yes, Add item\"> / <a href=\"".$admin_file.".php?op=amazon\">No</a>\n</form>";
    CloseTable();
	include_once("footer.php");
}
function Update_Catalog()
{
# This function gets all catalogs and finds the number of featured items
	global $prefix, $db, $AMZLocale, $admin_file;
	$sql = "SELECT catalog FROM ".$prefix."_amazon_catalog";
	$result = $db->sql_query($sql);
	while(list($catalog) = $db->sql_fetchrow($result))
	{
		$newsql = "select count(*) from " . $prefix . "_amazon_items where category = '$catalog'";
		$resultm = $db->sql_query($newsql);
		list($totalcatalog) = $db->sql_fetchrow($resultm);
		$newsql = "update " . $prefix . "_amazon_department set items=$totalcatalog where r_catalog='$catalog'";
		$resultm = $db->sql_query($newsql);
	}
}
function amz_report($page)
{
# This function Reports Clicks and Hits for all asins in database
# imp = Block Impressions
# hits = Product Details presented on this page
# click = Visitor sent to Amazon
	global $prefix, $db, $bgcolor2, $AMZSiteDir, $admin_file;
	require_once("includes/NukeAmazon/functions.php");
	$perpage = 25;
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	AMZHead();
    OpenTable();
	$AMZ_SQL = "select iid, asin, imp, hits, clicks from ".$prefix."_amazon_items order by clicks DESC, hits DESC";
	$result = $db->sql_query($AMZ_SQL);
	$total_rows = $db->sql_numrows($result);
	echo "<div align=\"center\"><font class=\"title\"><strong>NukeAmazon <i>Featured Products</i> Report</strong></font><br>";
	echo "Total <i>Featured Product</i> count: $total_rows<br>";
	if ($total_rows>0)
	{
		$totalpages = ceil($total_rows / $perpage);
		if (!$page)
		{
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		$AMZ_SQL .= " limit $start, $perpage";
		if ($totalpages >= 2)
		{
			echo "[ ";
			$back = $page - 1;
			if ($back >= 1 )
			{
				echo "<a href=\"".$admin_file.".php?op=amazon_rpt&amp;page=$back\">Back</a>&nbsp;| ";
			}
			for ($i = 1; $i <= $totalpages; $i++)
			{
				if ($page == $i)
				{
					echo "<strong>$page</strong>";
				}
				else
				{
					echo "<a href=\"".$admin_file.".php?op=amazon_rpt&amp;page=$i\">$i</a>";
				}
				if ($i != $totalpages)
				{
					echo " | ";
				}
			}
			$next = $page + 1;
			if ($next <= $totalpages)
			{
				echo " | <a href=\"".$admin_file.".php?op=amazon_rpt&amp;page=$next\">Next</a>";
			}
			echo " ]";
			echo "<br>";
		}
		$result = $db->sql_query($AMZ_SQL);
		echo "<font class=\"option\"><strong>ASIN Products</strong></font><br>";
		echo "<table width=100% border=0><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>ID</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>ASIN</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Image</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Impressions</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Hits</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Hits %</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Clicks</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Click %</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Action</strong></td>"
		."</tr><tr>";
		while (list($iid, $asin, $imp, $hits, $clicks) = $db->sql_fetchrow($result))
		{
			if($imp==0) {
				$hpercent = "0 %";
			} else {
				$hpercent = substr(100 * $hits / $imp, 0, 5)." %";
			}
			if($hits==0) {
				$cpercent = "0 %";
			} else {
				$cpercent = substr(100 * $clicks / $hits, 0, 5)." %";
			}
			$LinkURL = "modules.php?name=Amazon&amp;asin=$asin";
			echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$iid</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"$LinkURL\">$asin</a></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">"
				."<a href=\"$LinkURL\">"
				."<img src=\"". AMZIS($asin, 'T') . "\" border=\"0\"></a></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$imp</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$hits</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$hpercent</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$clicks</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$cpercent</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"".$admin_file.".php?op=am_delete&amp;iid=$iid\">Delete</a></td>"
				."</tr>";
		}
		echo "</table>";
	}
	echo "</div>";
	CloseTable();
	include_once("footer.php");
}
function amz_report_nf($page)
{
# This function Reports Clicks and Hits for all asins not featured in database
# hits = Product Details presented on this page
# click = Visitor sent to Amazon
	global $prefix, $db, $bgcolor2, $AMZSiteDir, $admin_file;
	require_once("includes/NukeAmazon/functions.php");
	$perpage = 25;
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	AMZHead();
	OpenTable();
	$AMZ_SQL = "select iid, asin, hits, clicks from ".$prefix."_amazon_not_item order by clicks DESC, hits DESC";
	$result = $db->sql_query($AMZ_SQL);
	$total_rows = $db->sql_numrows($result);
	echo "<div align=\"center\"><font class=\"title\"><strong>NukeAmazon <i>NOT Featured Products</i> Report</strong></font><br>";
	echo "Total <i>NOT Featured Product</i> count: $total_rows<br>";
	if ($total_rows>0)
	{
		$totalpages = ceil($total_rows / $perpage);
		if (!$page)
		{
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		$AMZ_SQL .= " limit $start, $perpage";
		if ($totalpages >= 2)
		{
			echo "[ ";
			$back = $page - 1;
			if ($back >= 1 )
			{
				echo "<a href=\"".$admin_file.".php?op=amazon_rpt_nf&amp;page=$back\">Back</a>&nbsp;| ";
			}
			for ($i = 1; $i <= $totalpages; $i++)
			{
				if ($page == $i)
				{
					echo "<strong>$page</strong>";
				}
				else
				{
					echo "<a href=\"".$admin_file.".php?op=amazon_rpt_nf&amp;page=$i\">$i</a>";
				}
				if ($i != $totalpages)
				{
					echo " | ";
				}
			}
			$next = $page + 1;
			if ($next <= $totalpages)
			{
				echo " | <a href=\"".$admin_file.".php?op=amazon_rpt_nf&amp;page=$next\">Next</a>";
			}
			echo " ]";
			echo "<br>";
		}
		$result = $db->sql_query($AMZ_SQL);
		echo "<table width=100% border=0><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>ID</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>ASIN</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Image</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Hits</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Clicks</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Click %</strong></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>Action</strong></td>"
		."</tr><tr>";
		while (list($iid, $asin, $hits, $clicks) = $db->sql_fetchrow($result))
		{
			if($hits==0) {
				$cpercent = "0 %";
			} else {
				$cpercent = substr(100 * $clicks / $hits, 0, 5)." %";
			}
			$LinkURL = "modules.php?name=Amazon&amp;asin=$asin";
			echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$iid</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"$LinkURL\">$asin</a></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">"
				."<a href=\"$LinkURL\">"
				."<img src=\"". AMZIS($asin, 'T') . "\" border=\"0\"></a></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$hits</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$clicks</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\">$cpercent</td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"".$admin_file.".php?op=am_delete_nf&amp;iid=$iid\">Delete</a> | <a href=\"".$admin_file.".php?op=am_add&amp;asin=$asin\">Add</a></td>"
				."</tr>";
		}
		echo "</table>";
	}
	echo "</div>";
	CloseTable();
	include_once("footer.php");
}
Function Update_AMZSettings($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML)
{
	global $prefix, $db, $admin_file;
	$sql = "UPDATE " . $prefix . "_amazon_cfg SET AMZ_id = '$amazon_id', cache_maxtime = '$amazon_xml_cache_maxtime', AMZMore = '$AMZMore', AMZSingle = '$AMZSingle', AMZQuickAdd = '$AMZQuickAdd', AMZShowReview = '$AMZShowReview', AMZShowSimilar = '$AMZShowSimilar', AMZLocale = '$AMZLocale', AMZReviewMod = '$AMZReviewMod', ImageType = '$AMZImgType', default_asin = '$AMZDefault_Asin', AMZ_Popular = '$AMZ_Popular', AMZBuyBox = '$AMZBuyBox', AMZShowXML = '$AMZShowXML'";
	$result = $db->sql_query($sql);
    Header("Location: ".$admin_file.".php?op=amazon_cfg");
}
Function AMZ_Configure($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML)
{
# Amazon Module Configuration
	global $prefix, $db, $admin_file;
	$result = $db->sql_query("SELECT AMZVer, AMZModule_Name, AMZ_id, cache_maxtime, AMZMore, AMZSingle, AMZQuickAdd, AMZShowReview, AMZShowSimilar, AMZLocale, AMZReviewMod, ImageType, default_asin, AMZ_Popular, AMZBuyBox, AMZShowXML FROM ".$prefix."_amazon_cfg");
	list($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML) = $db->sql_fetchrow($result);
#
# Get Values First
#
    if(!isset($amazon_id))                { $amazon_id = "[Amazon ID]" ; }
    if(!isset($amazon_xml_cache_maxtime)) { $amazon_xml_cache_maxtime = "3600" ; }
    if(!isset($AMZMore))                  { $AMZMore = true; }
    if(!isset($AMZSingle))                { $AMZSingle = false; }
    if(!isset($AMZQuickAdd))              { $AMZQuickAdd = true; }
    if(!isset($AMZShowReview))            { $AMZShowReview = true; }
    if(!isset($AMZShowSimilar))           { $AMZShowSimilar = true; }
    if(!isset($AMZReviewMod))             { $AMZReviewMod = true; }
    if(!isset($AMZLocale))                { $AMZLocale = "us"; }
    if(!isset($AMZVer))                   { $AMZVer = "2.6.5b1"; }
    if(!isset($AMZModule_Name))           { $AMZModule_Name = "Amazon"; }
    if(!isset($AMZImgType))               { $AMZImgType = "NO"; }
    if(!isset($AMZ_Popular))              { $AMZ_Popular = 25; }
    if(!isset($AMZBuyBox))                { $AMZBuyBox = true; }
    if(!isset($AMZShowXML))               { $AMZShowXML = false; }
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	AMZHead();
	OpenTable();
	echo "<form action=\"".$admin_file.".php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"op\" value=\"amz_update\">\n";
	echo "<div align=\"center\"><font class=\"option\"><strong>Amazon Module Configuration</strong></font></div>"
    ."<table border=\"0\"><tr><td>";
	echo "<input type=\"hidden\" name=\"AMZVer\" value=\"$AMZVer\">\n";
	echo "<input type=\"hidden\" name=\"AMZModule_Name\" value=\"$AMZModule_Name\">\n";
    echo "</td></tr><tr><td>";
	echo "<a href=\"http://www.amazon.com/associates\" target=\"_blank\">Amazon ID</a>:</td><td><input type=\"text\" name=\"amazon_id\" value=\"$amazon_id\" size=\"21\" maxlength=\"20\">";
    echo "</td></tr><tr><td>";
	echo "Max. Cache Time:</td><td><input type=\"text\" name=\"amazon_xml_cache_maxtime\" value=\"$amazon_xml_cache_maxtime\" size=\"11\" maxlength=\"10\">";
    echo "</td></tr><tr><td>";
	echo "Show More/Previews Buttons:</td><td>";
    if ($AMZMore==true) {
        echo "<input type=\"radio\" name=\"AMZMore\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZMore\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZMore\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZMore\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Show all Product Data in one page for Main and Related Products:<br>If <strong>YES</strong> the related products will be shown the same way the Main Product is shown.<br>If <strong>NO</strong> the related products data will be shown on the next page</td><td>";
    if ($AMZSingle==true) {
        echo "<input type=\"radio\" name=\"AMZSingle\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZSingle\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZSingle\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZSingle\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
		echo "Quick Add Product Offering to Database:</td><td>";
    if ($AMZQuickAdd==true) {
        echo "<input type=\"radio\" name=\"AMZQuickAdd\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZQuickAdd\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZQuickAdd\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZQuickAdd\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Show Product Reviews:</td><td>";
    if ($AMZShowReview==true) {
        echo "<input type=\"radio\" name=\"AMZShowReview\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowReview\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZShowReview\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowReview\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Use the Amazon Reviews Module?:</td><td>";
    if ($AMZReviewMod==true) {
        echo "<input type=\"radio\" name=\"AMZReviewMod\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZReviewMod\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZReviewMod\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZReviewMod\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Show Similar Products:</td><td>";
    if ($AMZShowSimilar==true) {
        echo "<input type=\"radio\" name=\"AMZShowSimilar\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowSimilar\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZShowSimilar\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowSimilar\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Amazon Locale:</td><td><select name='AMZLocale'>";
# United States
	echo "<option value = \"us\" ";
	if ($AMZLocale == "us")
	{
		echo  "selected";
	}
	echo ">United States</option>/n";
# United Kingdom
	echo "<option value = \"uk\" ";
	if ($AMZLocale == "uk")
	{
		echo  "selected";
	}
	echo ">United Kingdom</option>/n";
# Germany
	echo "<option value = \"de\" ";
	if ($AMZLocale == "de")
	{
		echo  "selected";
	}
	echo ">Germany</option>/n";
# Japan
	echo "<option value = \"jp\" ";
	if ($AMZLocale == "jp")
	{
		echo  "selected";
	}
	echo ">Japan</option>/n";
	echo "</select>";
    echo "</td></tr><tr><td>";
	echo "Image Type:</td><td><select name='AMZImgType'>";
	echo "<option value = \"NO\" ";
	if ($AMZImgType == "NO")
	{
		echo  "selected";
	}
	echo ">Normal, wo/percent</option>/n";
	echo "<option value = \"PI\" ";
	if ($AMZImgType == "PI")
	{
		echo  "selected";
	}
	echo ">Normal, w/percent</option>/n";
	echo "<option value = \"PC\" ";
	if ($AMZImgType == "PC")
	{
		echo  "selected";
	}
	echo ">Percent. w/Border and Shadow to right</option>/n";
	echo "<option value = \"PB\" ";
	if ($AMZImgType == "PB")
	{
		echo  "selected";
	}
	echo ">Percent. w/Border and Shadow to left</option>/n";
	echo "<option value = \"PU\" ";
	if ($AMZImgType == "PU")
	{
		echo  "selected";
	}
	echo ">Percent w/Image skewed to the left</option>/n";
	echo "</select>";
    echo "</td></tr><tr><td>";
	echo "Default ASIN:</td><td><input type=\"text\" name=\"AMZDefault_Asin\" value=\"$AMZDefault_Asin\" size=\"11\" maxlength=\"10\">";
    echo "</td></tr><tr><td>";
	echo "Number of Hits to become Popular:</td><td><input type=\"text\" name=\"AMZ_Popular\" value=\"$AMZ_Popular\" size=\"11\" maxlength=\"10\">";
    echo "</td></tr><tr><td>";
	echo "Show BuyBox:</td><td>";
    if ($AMZBuyBox==true) {
        echo "<input type=\"radio\" name=\"AMZBuyBox\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZBuyBox\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZBuyBox\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZBuyBox\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "Show XML Link (for DEBUG):</td><td>";
    if ($AMZShowXML==true) {
        echo "<input type=\"radio\" name=\"AMZShowXML\" value=\"1\" checked>Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowXML\" value=\"0\">No";
    } else {
        echo "<input type=\"radio\" name=\"AMZShowXML\" value=\"1\">Yes &nbsp;
        <input type=\"radio\" name=\"AMZShowXML\" value=\"0\" checked>No";
    }
    echo "</td></tr><tr><td>";
	echo "</td></tr></table>";
	echo "<input type=\"submit\" value=\"Save\"></form><br>\n\n";
	echo "<br>";
	CloseTable();
	include_once("footer.php");
}
function am_stats()
{
# This function Reports The Site Statistics Clicks and Hits for all asins in database
# imp = Block Impressions
# hits = Product Details presented on this page
# click = Visitor sent to Amazon
	global $prefix, $db, $bgcolor2, $AMZSiteDir, $admin_file;
	include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=amazon'>Amazon Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	AMZHead();
    OpenTable();
	$AMZ_SQL = "select count(*), sum(imp), sum(hits), sum(clicks), max(imp), max(hits), max(clicks) from ".$prefix."_amazon_items";
	$result = $db->sql_query($AMZ_SQL);
	list($AMZ_total_items, $AMZ_Imp, $AMZ_Hits, $AMZ_Clicks, $AMZ_MI, $AMZ_MH, $AMZ_MC) = $db->sql_fetchrow($result);
	$AMZ_SQL = "select count(*), sum(hits), sum(clicks), max(hits), max(clicks) from ".$prefix."_amazon_not_item";
	$result = $db->sql_query($AMZ_SQL);
	list($AMZ_total_items_nf, $AMZ_Hits_nf, $AMZ_Clicks_nf, $AMZ_MH_N, $AMZ_MC_N) = $db->sql_fetchrow($result);
	$AMZ_Site_Total_Items = $AMZ_total_items_nf + $AMZ_total_items;
	$AMZ_Site_Total_Hits = $AMZ_Hits_nf + $AMZ_Hits;
	$AMZ_Site_Total_Clicks = $AMZ_Clicks_nf + $AMZ_Clicks;
	if($AMZ_Imp==0) {
		$hpercent = "0&nbsp;%";
	} else {
		$hpercent = substr(100 * $AMZ_Hits / $AMZ_Imp, 0, 5)."&nbsp;%";
		$hpercent_tt = substr(100 * $AMZ_Site_Total_Hits / $AMZ_Imp, 0, 5)."&nbsp;%";
	}
	if($AMZ_Hits==0) {
		$cpercent = "0&nbsp;%";
		$AMZ_Hits = "0";
	} else {
		$cpercent = substr(100 * $AMZ_Clicks / $AMZ_Hits, 0, 5)."&nbsp;%";
	}
	if($AMZ_Hits_nf==0) {
		$cpercent_nf = "0&nbsp;%";
		$AMZ_Hits_nf = "0";
	} else {
		$cpercent_nf = substr(100 * $AMZ_Clicks_nf / $AMZ_Hits_nf, 0, 5)."&nbsp;%";
	}
	if($AMZ_Site_Total_Hits==0) {
		$cpercent_tt = "0&nbsp;%";
	} else {
		$cpercent_tt = substr(100 * $AMZ_Site_Total_Clicks / $AMZ_Site_Total_Hits, 0, 5)."&nbsp;%";
	}
	echo "<div align=\"center\">NukeAmazon Statitstics Report</div><br>";
	echo "<table border=0>";
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Description </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Item Count </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Impression </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Hits </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Hits % </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Clicks </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Clicks % </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Max Impression </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Max Hits </strong></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\"><strong> Max Clicks </strong></td>";
	echo "</tr>";
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"left\"> <a href=\"".$admin_file.".php?op=amazon_rpt\">Featured Items</a> </td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_total_items</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Imp</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Hits</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$hpercent</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Clicks</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$cpercent</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_MI</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_MH</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_MC</td>";
	echo "</tr>";
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"left\"> <a href=\"".$admin_file.".php?op=amazon_rpt_nf\">NOT Featured Items</a> </td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_total_items_nf</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">n/a</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">" . sprintf("%d",$AMZ_Hits_nf) . "</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">n/a</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">" . sprintf("%d",$AMZ_Clicks_nf) . "</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$cpercent_nf</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">n/a</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">" . sprintf("%d",$AMZ_MH_N) . "</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">" . sprintf("%d",$AMZ_MC_N) . "</td>";
	echo "</tr>";
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"right\"> Site Total </td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Site_Total_Items</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Imp</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Site_Total_Hits</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$hpercent_tt</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_Site_Total_Clicks</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$cpercent_tt</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$AMZ_MI</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">";
	echo max($AMZ_MH_N,$AMZ_MH);
	echo "</td>";
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">";
	echo max($AMZ_MC_N, $AMZ_MC);
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<div align=\"center\">";
	echo "<a href=\"".$admin_file.".php?op=amazon_reset\">Reset Featured Products Statistics</a> | ";
	echo "<a href=\"".$admin_file.".php?op=amazon_del_nf\">Delete Not Featured Items</a>";
	echo "</div>";
	CloseTable();
	include_once("footer.php");
}
function yes_no ($teststr)
{
	if ($teststr)
	{
		return "Yes";
	}
	else
	{
		return "No";
	}
}
function AMZHead()
{
global $admin_file;
	OpenTable();
    echo "<div align=\"center\"><font class=\"title\"><strong>Amazon Administration Menu</strong></font></div>";
	echo "<p>";
	# Amazon Options...Configure, Reports
	echo "<div align=\"center\"><a href=\"http://platinumnukepro.com/modules.php?name=Donations\">To see continued updates please <strong>Donate</strong></a> | <a href=\"".$admin_file.".php?op=amazon_cfg\">Preferences</a> | <a href=\"".$admin_file.".php?op=amazon\">Statistics</a> | <a href=\"".$admin_file.".php?op=amazon1\">Add/Remove</a> | <a href=\"".$admin_file.".php?op=amazon_rpt\">Report Featured</a> | <a href=\"".$admin_file.".php?op=amazon_rpt_nf\">Report *NOT* Featured</a>";
	echo "</div>";
	CloseTable();
	echo "<br>";
}
Update_Catalog();
switch ($op){
    case "amazon":
    am_stats();
    break;
	case "amazon1":
	amazon($page);
    break;
	case "amz_stats":
    am_stats();
    break;
	case "am_submit":
    am_submit($asin);
    break;
    case "am_delete":
    am_delete($iid);
    break;
    case "am_add":
    am_add($asin);
    break;
    case "am_delete_nf":
    am_delete_nf($iid);
    break;
	case "amazon_cfg":
	AMZ_Configure($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML);
    break;
    case "amz_update":
	Update_AMZSettings($AMZVer, $AMZModule_Name, $amazon_id, $amazon_xml_cache_maxtime, $AMZMore, $AMZSingle, $AMZQuickAdd, $AMZShowReview, $AMZShowSimilar, $AMZLocale, $AMZReviewMod, $AMZImgType, $AMZDefault_Asin, $AMZ_Popular, $AMZBuyBox, $AMZShowXML);
    break;
	case "amazon_rpt":
    amz_report($page);
    break;
	case "amazon_rpt_nf":
    amz_report_nf($page);
    break;
	case "amazon_reset":
    am_reset_stats();
    break;
	case "amazon_del_nf":
    am_delete_all_nf();
    break;
}
} else {
echo "Access Denied";
}
# $Log $
# Revision 2.7.2 ejd
#	- Fixed Delete: Not showing products.
?>
