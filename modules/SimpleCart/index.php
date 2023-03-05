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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}



require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);



function themenu() {

	global $module_name, $op;

	echo "<br />";

	OpenTable();

	echo "<center><strong>"._SCMENU."</strong><br /><br />[ <a href=\"modules.php?name=$module_name&op=SimpleCart\">"._SCMAINPAGEMENU."</a> | <a href=\"modules.php?name=$module_name&op=products\">"._SCPRODUCTSMENU."</a> | <a href=\"modules.php?name=$module_name&op=services\">"._SCSERVICESMENU."</a> | <a href=\"modules.php?name=$module_name&op=specials\">"._SCSPECIALSMENU."</a> | <a href=\"modules.php?name=$module_name&op=featured\">"._SCFEATUREMENU."</a> ] <br />[ <a href=\"modules.php?name=$module_name&op=referrals\">"._SCREFERRALSMENU."</a> | <a href=\"modules.php?name=$module_name&op=policies\">"._SCPOLICIESMENU."</a> | <a href=\"modules.php?name=$module_name&op=terms\">"._SCTERMSMENU."</a> | <a href=\"modules.php?name=$module_name&op=contact\">"._SCCONTACTMENU."</a> ]</center>";

	CloseTable();

}



function SimpleCart() {

    global $prefix, $db, $sitename, $module_name;

    include_once("header.php");

    title("$sitename "._SCMAINPAGE."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";	

    $row = $db->sql_fetchrow($db->sql_query("SELECT main FROM ".$prefix."_simplecart"));

    $main = preg_replace("/\[sitename\]/", $sitename, $row['main']);

	$main = preg_replace("/\[country\]/", $row['country'], $main);	

    echo"<td><center>$main<br /><br />";

    echo "</center></table></td>";	

    CloseTable();

    themenu();

    include_once("footer.php");

}



function products() {

    global $sitename, $bgcolor1, $bgcolor2, $bgcolor3;

    include_once("header.php");

    title("$sitename "._SCPRODUCTS."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";

    $result = $db->sql_query("SELECT c1_desc, c1, c1p1_img, c1p1_tit, c1p1_desc, c1p1_buy, c1p1_cart, c1p1_active, c1p2_img, c1p2_tit, c1p2_desc, c1p2_buy, c1p2_cart, c1p2_active, c1p3_img, c1p3_tit, c1p3_desc, c1p3_buy, c1p3_cart, c1p3_active, c1p4_img, c1p4_tit, c1p4_desc, c1p4_buy, c1p4_cart, c1p4_active, c1p5_img, c1p5_tit, c1p5_desc, c1p5_buy, c1p5_cart, c1p5_active, c1p6_img, c1p6_tit, c1p6_desc, c1p6_buy, c1p6_cart, c1p6_active, c1p7_img, c1p7_tit, c1p7_desc, c1p7_buy, c1p7_cart, c1p7_active, c1p8_img, c1p8_tit, c1p8_desc, c1p8_buy, c1p8_cart, c1p8_active from ".$prefix."_simplecart_products");

    list($c1_desc, $c1, $c1p1_img, $c1p1_tit, $c1p1_desc, $c1p1_buy, $c1p1_cart, $c1p1_active, $c1p2_img, $c1p2_tit, $c1p2_desc, $c1p2_buy, $c1p2_cart, $c1p2_active, $c1p3_img, $c1p3_tit, $c1p3_desc, $c1p3_buy, $c1p3_cart, $c1p3_active, $c1p4_img, $c1p4_tit, $c1p4_desc, $c1p4_buy, $c1p4_cart, $c1p4_active, $c1p5_img, $c1p5_tit, $c1p5_desc, $c1p5_buy, $c1p5_cart, $c1p5_active, $c1p6_img, $c1p6_tit, $c1p6_desc, $c1p6_buy, $c1p6_cart, $c1p6_active, $c1p7_img, $c1p7_tit, $c1p7_desc, $c1p7_buy, $c1p7_cart, $c1p7_active, $c1p8_img, $c1p8_tit, $c1p8_desc, $c1p8_buy, $c1p8_cart, $c1p8_active) = $db->sql_fetchrow($result);

    echo "<tr>"

    ."<td colspan=\"4\"><br /><br />$c1_desc<br /><br /></td>"

    ."</tr>";

    echo "<tr><td width=\"100%\" colspan=\"2\"><strong>$c1</strong><hr color=\"$bgcolor2\" width=\"100%\"><br /></td></tr>";

    if ($c1p1_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p1_img\" ONCLICK=\"window.open('$c1p1_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c1p1_tit</strong><br /><br /> $c1p1_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p1_buy<br />$c1p1_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p2_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p2_img\" ONCLICK=\"window.open('$c1p2_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c1p2_tit</strong><br /><br /> $c1p2_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p2_buy<br />$c1p2_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p3_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p3_img\" ONCLICK=\"window.open('$c1p3_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c1p3_tit</strong><br /><br /> $c1p3_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p3_buy<br />$c1p3_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p4_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p4_img\" ONCLICK=\"window.open('$c1p4_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c1p4_tit</strong><br /><br /> $c1p4_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p4_buy<br />$c1p4_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p5_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p5_img\" ONCLICK=\"window.open('$c1p5_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c1p5_tit</strong><br /><br /> $c1p5_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p5_buy<br />$c1p5_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p6_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p6_img\" ONCLICK=\"window.open('$c1p6_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c1p6_tit</strong><br /><br /> $c1p6_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p6_buy<br />$c1p6_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p7_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p7_img\" ONCLICK=\"window.open('$c1p7_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c1p7_tit</strong><br /><br /> $c1p7_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p7_buy<br />$c1p7_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c1p8_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c1p8_img\" ONCLICK=\"window.open('$c1p8_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c1p8_tit</strong><br /><br /> $c1p8_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c1p8_buy<br />$c1p8_cart</td></tr>";

    } else {

        echo "";

    }

    echo "</table>";

    CloseTable();

    themenu();

    include_once("footer.php");

}



function services() {

    global $sitename, $bgcolor1, $bgcolor2, $bgcolor3;

    include_once("header.php");

    title("$sitename "._SCSERVICES."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";

    $result = $db->sql_query("SELECT c2_desc, c2, c2p1_img, c2p1_tit, c2p1_desc, c2p1_buy, c2p1_cart, c2p1_active, c2p2_img, c2p2_tit, c2p2_desc, c2p2_buy, c2p2_cart, c2p2_active, c2p3_img, c2p3_tit, c2p3_desc, c2p3_buy, c2p3_cart, c2p3_active, c2p4_img, c2p4_tit, c2p4_desc, c2p4_buy, c2p4_cart, c2p4_active, c2p5_img, c2p5_tit, c2p5_desc, c2p5_buy, c2p5_cart, c2p5_active, c2p6_img, c2p6_tit, c2p6_desc, c2p6_buy, c2p6_cart, c2p6_active, c2p7_img, c2p7_tit, c2p7_desc, c2p7_buy, c2p7_cart, c2p7_active, c2p8_img, c2p8_tit, c2p8_desc, c2p8_buy, c2p8_cart, c2p8_active from ".$prefix."_simplecart_services");

    list($c2_desc, $c2, $c2p1_img, $c2p1_tit, $c2p1_desc, $c2p1_buy, $c2p1_cart, $c2p1_active, $c2p2_img, $c2p2_tit, $c2p2_desc, $c2p2_buy, $c2p2_cart, $c2p2_active, $c2p3_img, $c2p3_tit, $c2p3_desc, $c2p3_buy, $c2p3_cart, $c2p3_active, $c2p4_img, $c2p4_tit, $c2p4_desc, $c2p4_buy, $c2p4_cart, $c2p4_active, $c2p5_img, $c2p5_tit, $c2p5_desc, $c2p5_buy, $c2p5_cart, $c2p5_active, $c2p6_img, $c2p6_tit, $c2p6_desc, $c2p6_buy, $c2p6_cart, $c2p6_active, $c2p7_img, $c2p7_tit, $c2p7_desc, $c2p7_buy, $c2p7_cart, $c2p7_active, $c2p8_img, $c2p8_tit, $c2p8_desc, $c2p8_buy, $c2p8_cart, $c2p8_active) = $db->sql_fetchrow($result);

    echo "<tr>"

    ."<td colspan=\"4\"><br /><br />$c2_desc<br /><br /></td>"

    ."</tr>";

    echo "<tr><td width=\"100%\" colspan=\"2\"><strong>$c2</strong><hr color=\"$bgcolor2\" width=\"100%\"><br /></td></tr>";

    if ($c2p1_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p1_img\" ONCLICK=\"window.open('$c2p1_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c2p1_tit</strong><br /><br /> $c2p1_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p1_buy<br />$c2p1_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p2_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p2_img\" ONCLICK=\"window.open('$c2p2_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c2p2_tit</strong><br /><br /> $c2p2_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p2_buy<br />$c2p2_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p3_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p3_img\" ONCLICK=\"window.open('$c2p3_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c2p3_tit</strong><br /><br /> $c2p3_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p3_buy<br />$c2p3_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p4_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p4_img\" ONCLICK=\"window.open('$c2p4_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c2p4_tit</strong><br /><br /> $c2p4_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p4_buy<br />$c2p4_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p5_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p5_img\" ONCLICK=\"window.open('$c2p5_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c2p5_tit</strong><br /><br /> $c2p5_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p5_buy<br />$c2p5_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p6_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p6_img\" ONCLICK=\"window.open('$c2p6_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c2p6_tit</strong><br /><br /> $c2p6_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p6_buy<br />$c2p6_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p7_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p7_img\" ONCLICK=\"window.open('$c2p7_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c2p7_tit</strong><br /><br /> $c2p7_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p7_buy<br />$c2p7_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c2p8_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c2p8_img\" ONCLICK=\"window.open('$c2p8_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c2p8_tit</strong><br /><br /> $c2p8_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c2p8_buy<br />$c2p8_cart</td></tr>";

    } else {

        echo "";

    }

    echo "</table>";

    CloseTable();

    themenu();

    include_once("footer.php");

}



function specials() {

    global $sitename, $bgcolor1, $bgcolor2, $bgcolor3;

    include_once("header.php");

    title("$sitename "._SCSPECIALS."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";

    $result = $db->sql_query("SELECT c3_desc, c3, c3p1_img, c3p1_tit, c3p1_desc, c3p1_buy, c3p1_cart, c3p1_active, c3p2_img, c3p2_tit, c3p2_desc, c3p2_buy, c3p2_cart, c3p2_active, c3p3_img, c3p3_tit, c3p3_desc, c3p3_buy, c3p3_cart, c3p3_active, c3p4_img, c3p4_tit, c3p4_desc, c3p4_buy, c3p4_cart, c3p4_active, c3p5_img, c3p5_tit, c3p5_desc, c3p5_buy, c3p5_cart, c3p5_active, c3p6_img, c3p6_tit, c3p6_desc, c3p6_buy, c3p6_cart, c3p6_active, c3p7_img, c3p7_tit, c3p7_desc, c3p7_buy, c3p7_cart, c3p7_active, c3p8_img, c3p8_tit, c3p8_desc, c3p8_buy, c3p8_cart, c3p8_active from ".$prefix."_simplecart_specials");

    list($c3_desc, $c3, $c3p1_img, $c3p1_tit, $c3p1_desc, $c3p1_buy, $c3p1_cart, $c3p1_active, $c3p2_img, $c3p2_tit, $c3p2_desc, $c3p2_buy, $c3p2_cart, $c3p2_active, $c3p3_img, $c3p3_tit, $c3p3_desc, $c3p3_buy, $c3p3_cart, $c3p3_active, $c3p4_img, $c3p4_tit, $c3p4_desc, $c3p4_buy, $c3p4_cart, $c3p4_active, $c3p5_img, $c3p5_tit, $c3p5_desc, $c3p5_buy, $c3p5_cart, $c3p5_active, $c3p6_img, $c3p6_tit, $c3p6_desc, $c3p6_buy, $c3p6_cart, $c3p6_active, $c3p7_img, $c3p7_tit, $c3p7_desc, $c3p7_buy, $c3p7_cart, $c3p7_active, $c3p8_img, $c3p8_tit, $c3p8_desc, $c3p8_buy, $c3p8_cart, $c3p8_active) = $db->sql_fetchrow($result);

    echo "<tr>"

    ."<td colspan=\"4\"><br /><br />$c3_desc<br /><br /></td>"

    ."</tr>";

    echo "<tr><td width=\"100%\" colspan=\"2\"><strong>$c3</strong><hr color=\"$bgcolor2\" width=\"100%\"><br /></td></tr>";

    if ($c3p1_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p1_img\" ONCLICK=\"window.open('$c3p1_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c3p1_tit</strong><br /><br /> $c3p1_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p1_buy<br />$c3p1_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p2_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p2_img\" ONCLICK=\"window.open('$c3p2_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c3p2_tit</strong><br /><br /> $c3p2_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p2_buy<br />$c3p2_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p3_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p3_img\" ONCLICK=\"window.open('$c3p3_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c3p3_tit</strong><br /><br /> $c3p3_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p3_buy<br />$c3p3_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p4_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p4_img\" ONCLICK=\"window.open('$c3p4_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c3p4_tit</strong><br /><br /> $c3p4_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p4_buy<br />$c3p4_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p5_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p5_img\" ONCLICK=\"window.open('$c3p5_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c3p5_tit</strong><br /><br /> $c3p5_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p5_buy<br />$c3p5_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p6_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p6_img\" ONCLICK=\"window.open('$c3p6_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c3p6_tit</strong><br /><br /> $c3p6_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p6_buy<br />$c3p6_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p7_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p7_img\" ONCLICK=\"window.open('$c3p7_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c3p7_tit</strong><br /><br /> $c3p7_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p7_buy<br />$c3p7_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c3p8_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c3p8_img\" ONCLICK=\"window.open('$c3p8_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c3p8_tit</strong><br /><br /> $c3p8_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c3p8_buy<br />$c3p8_cart</td></tr>";

    } else {

        echo "";

    }

    echo "</table>";

    CloseTable();

    themenu();

    include_once("footer.php");

}



function featured() {

    global $sitename, $bgcolor1, $bgcolor2, $bgcolor3;

    include_once("header.php");

    title("$sitename "._SCFEATURE."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";

    $result = $db->sql_query("SELECT c4_desc, c4, c4p1_img, c4p1_tit, c4p1_desc, c4p1_buy, c4p1_cart, c4p1_active, c4p2_img, c4p2_tit, c4p2_desc, c4p2_buy, c4p2_cart, c4p2_active, c4p3_img, c4p3_tit, c4p3_desc, c4p3_buy, c4p3_cart, c4p3_active, c4p4_img, c4p4_tit, c4p4_desc, c4p4_buy, c4p4_cart, c4p4_active, c4p5_img, c4p5_tit, c4p5_desc, c4p5_buy, c4p5_cart, c4p5_active, c4p6_img, c4p6_tit, c4p6_desc, c4p6_buy, c4p6_cart, c4p6_active, c4p7_img, c4p7_tit, c4p7_desc, c4p7_buy, c4p7_cart, c4p7_active, c4p8_img, c4p8_tit, c4p8_desc, c4p8_buy, c4p8_cart, c4p8_active from ".$prefix."_simplecart_featured");

    list($c4_desc, $c4, $c4p1_img, $c4p1_tit, $c4p1_desc, $c4p1_buy, $c4p1_cart, $c4p1_active, $c4p2_img, $c4p2_tit, $c4p2_desc, $c4p2_buy, $c4p2_cart, $c4p2_active, $c4p3_img, $c4p3_tit, $c4p3_desc, $c4p3_buy, $c4p3_cart, $c4p3_active, $c4p4_img, $c4p4_tit, $c4p4_desc, $c4p4_buy, $c4p4_cart, $c4p4_active, $c4p5_img, $c4p5_tit, $c4p5_desc, $c4p5_buy, $c4p5_cart, $c4p5_active, $c4p6_img, $c4p6_tit, $c4p6_desc, $c4p6_buy, $c4p6_cart, $c4p6_active, $c4p7_img, $c4p7_tit, $c4p7_desc, $c4p7_buy, $c4p7_cart, $c4p7_active, $c4p8_img, $c4p8_tit, $c4p8_desc, $c4p8_buy, $c4p8_cart, $c4p8_active) = $db->sql_fetchrow($result);

    echo "<tr>"

    ."<td colspan=\"4\"><br /><br />$c4_desc<br /><br /></td>"

    ."</tr>";

    echo "<tr><td width=\"100%\" colspan=\"2\"><strong>$c4</strong><hr color=\"$bgcolor2\" width=\"100%\"><br /></td></tr>";

    if ($c4p1_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p1_img\" ONCLICK=\"window.open('$c4p1_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c4p1_tit</strong><br /><br /> $c4p1_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p1_buy<br />$c4p1_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p2_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p2_img\" ONCLICK=\"window.open('$c4p2_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c4p2_tit</strong><br /><br /> $c4p2_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p2_buy<br />$c4p2_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p3_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p3_img\" ONCLICK=\"window.open('$c4p3_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c4p3_tit</strong><br /><br /> $c4p3_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p3_buy<br />$c4p3_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p4_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p4_img\" ONCLICK=\"window.open('$c4p4_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c4p4_tit</strong><br /><br /> $c4p4_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p4_buy<br />$c4p4_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p5_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p5_img\" ONCLICK=\"window.open('$c4p5_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c4p5_tit</strong><br /><br /> $c4p5_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p5_buy<br />$c4p5_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p6_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p6_img\" ONCLICK=\"window.open('$c4p6_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c4p6_tit</strong><br /><br /> $c4p6_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p6_buy<br />$c4p6_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p7_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p7_img\" ONCLICK=\"window.open('$c4p7_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor3\"><strong>$c4p7_tit</strong><br /><br /> $c4p7_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p7_buy<br />$c4p7_cart</td></tr>"

    ."<tr>"

    ."<td colspan=\"4\">&nbsp;</td>"

    ."</tr>";

    } else {

        echo "";

    }

    if ($c4p8_active==1) {

    echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><input type=\"image\" width=\"90\" height=\"115\" src=\"$c4p8_img\" ONCLICK=\"window.open('$c4p8_img', 'Product', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=500, height=500')\"></td><td bgcolor=\"$bgcolor1\"><strong>$c4p8_tit</strong><br /><br /> $c4p8_desc<br /><br /><br /><br />[ <a href=\"modules.php?name=Reviews&rop=write_review\">"._REVIEWIT."</a> | <a href=\"modules.php?name=Reviews\">"._READIT."</a> | <a href=\"modules.php?name=SimpleCart&op=contact\">"._TELLMORE."</a> ]<td align=\"center\" bgcolor=\"$bgcolor1\" nowrap>$c4p8_buy<br />$c4p8_cart</td></tr>";

    } else {

        echo "";

    }

    echo "</table>";

    CloseTable();

    themenu();

    include_once("footer.php");

}



function referrals() {

    global $prefix, $db, $sitename, $module_name;

    include_once("header.php");

    title("$sitename "._SCREFERALS."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";	

    $row = $db->sql_fetchrow($db->sql_query("SELECT referrals FROM ".$prefix."_simplecart"));

    $referrals = preg_replace("/\[sitename\]/", $sitename, $row['referrals']);

	$referrals = preg_replace("/\[country\]/", $row['country'], $referrals);	

    echo"<td><center>$referrals<br /><br />";

    echo "</center></table></td>";	

    CloseTable();

    themenu();

    include_once("footer.php");

}



function policies() {

    global $prefix, $db, $sitename;

    $today = getdate();

	$month = $today['mon'];

	if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}

	$year = $today['year'];	

    include_once("header.php");

    title("$sitename "._SCPOLICIES."");

    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";	

    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));

    $policies = preg_replace("/\[sitename\]/", $sitename, $row['policies']);

	$policies = preg_replace("/\[country\]/", $row['country'], $policies);	

    echo"<td><center>$policies<br /><br />"

    ."<p align='right'>".$row['country'].", $month $year</p>";	

    echo "</center></table></td>";	

    CloseTable();

    themenu();

    include_once("footer.php");

}



function terms() {

    global $prefix, $db, $sitename;

    $today = getdate();
	$month = $today['mon'];
	if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
	$year = $today['year'];	
    include_once("header.php");
    title("$sitename "._SCTERMS."");
    OpenTable();

    echo "<table border=\"0\" width=\"100%\" cellpadding=\"4\">";	

    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_simplecart"));
    $terms = preg_replace("/\[sitename\]/", $sitename, $row['terms']);

	$terms = preg_replace("/\[country\]/", $row['country'], $terms);	

    echo"<td><center>$terms<br /><br />"

    ."<p align='right'>".$row['country'].", $month $year</p>";	

    echo "</center></table></td>";	

    CloseTable();
    themenu();
    include_once("footer.php");
}



function contact() {

    global $module_name, $user, $adminmail, $sitename;

	define('NO_EDITOR', true);	

    include_once("header.php");

    title("$sitename "._SCCONTACT."");

    OpenTable();

    if($user)

    getusrinfo($user);

    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"90%\" align=\"center\">"

    ."<tr>"

    ."<font class=\"content\">"._SCCONTACT1." <br /> "._SCCONTACT2."</font>"

    ."<form method=\"post\" action=\"modules.php?name=$module_name&amp;file=contactinclude\">"

    ."<p><strong>"._SCCONTACTNAME.":</strong><br />"

    ."<input type=\"text\" name=\"sender\" value=\"$userinfo[uname]\" size=30></p>"

    ."<p><strong>"._SCCONTACTMAIL.":</strong><br />"

    ."<input type=\"text\" name=\"email\" value=\"$userinfo[email]\" size=30></p>"

    ."<P><strong>"._SCCONTACTURL.":</strong><br />"

    ."<input type=\"text\" name=\"url\" value=\"$userinfo[url]\" size=30></p>"

    ."<P><strong>"._SCCONTACTPHONE.":</strong><br />"

    ."<input type=\"text\" name=\"telefon\" value=\"$userinfo[telefon]\" size=30></p>"	

    ."<P><strong>"._SCCONTACTMESSAGE.":</strong><br />"

    ."<textarea name=\"comments\" cols=70 rows=15 wrap=virtual></textarea></p><br />"

    ."<i>"._HTMLNOTALLOWED2."</i><br /><br />"	

    ."</td>"

    ."</tr>"

    ."<tr> "

    ."<td colspan=\"2\">&nbsp;</td>"

    ."</tr>"

    ."<tr> "

    ."<td  colspan=\"2\" align=\"left\">";

    $hostip = getenv("REMOTE_ADDR");

    if (gethostbyaddr($hostip))

    $host = gethostbyaddr($hostip);

    else

    $host = 'Unknown';

    echo "<input type=hidden name=hostip value=$hostip>";

    echo "<input type=hidden name=host value=$host>";

    echo "<input type=hidden name=referer value=$referer>";

    echo "<input type=\"submit\" name=\"submit\" value=\""._SCCONTACTMESSAGESEND."\">";

    echo "<input type=\"reset\" name=\"reset\" title=\"Reset\">";

    echo "</td>"

    ."</tr>"

    ."</table>"

    ."</form>"

    ."</td>";

    CloseTable();

    themenu();

    include_once("footer.php");

}



switch($op) {



    default:

    SimpleCart();

    break;



    case "products":

    products();

    break;



    case "services":

    services();

    break;



    case "specials":

    specials();

    break;



    case "featured":

    featured();

    break;



    case "referrals":

    referrals();

    break;



    case "policies":

    policies();

    break;



    case "terms":

    terms();

    break;

		

    case "contact":

    contact();

    break;



}



?>
