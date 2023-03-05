<?php 
/************************************************************************/
/* NukeTreasury - Financial management for PHP-Nuke                      */
/* Copyright (c) 2004 by Dave Lawrence AKA Thrash                       */
/*                       thrash@fragnastika.com                         */
/*                       thrashn8r@hotmail.com                          */
/*                                                                      */
/* This program is free software; you can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* This program is distributed in the hope that it will be useful, but  */
/* WITHOUT ANY WARRANTY; without even the implied warranty of           */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU     */
/* General Public License for more details.                             */
/*                                                                      */
/* You should have received a copy of the GNU General Public License    */
/* along with this program; if not, write to the Free Software          */
/* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307  */
/* USA                                                                  */
/* Upgraded and cleaned up by Telli http://codezwiz.com                 */
/************************************************************************/


if (!preg_match("#modules.php#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

include_once("mainfile.php");

$module_name = basename(dirname(__FILE__));
$pagetitle = "- $module_name";

global  $admin, $user, $sitename, $slogan, $cookie, $prefix, $db, $nukeurl, $anonymous;

cookiedecode($user);

$username = $cookie[1];
if ($username == "") {
	$username = "Anonymous";
}

include_once("modules/Donations/config.php");

$PP_URL = $paypalUrl;
$swingd = $tr_config['swing_day'];
$PP_RECEIVER_EMAIL = $tr_config['receiver_email'];
$PP_ITEMNAME = $tr_config['pp_itemname'];
$PP_TY_URL = $tr_config['ty_url'];
$PP_CANCEL_URL = $tr_config['pp_cancel_url'];

if(!($swingd > 0 AND $swingd < 32))
	$swingd = 6;

if( date('d') >= $swingd)
{
	$query_Recordset1 = 'SELECT custom AS name, option_selection1 as showname, ';
	$query_Recordset1 .= 'DATE_FORMAT( payment_date, \'%b-%e\' ) AS date, ';
	$query_Recordset1 .= 'CONCAT(\'$\',SUM(mc_gross)) AS amt ';
	$query_Recordset1 .= ' FROM '.$prefix.'_don_transactions'
		. ' WHERE ( '.$prefix.'_don_transactions.payment_date >= DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) '
		. ' GROUP BY txn_id ORDER BY payment_date DESC';
				  
} else
{ 
		$query_Recordset1 = 'SELECT custom AS name, option_selection1 as showname, ';
//		if( $tr_config['don_show_date'] )
			$query_Recordset1 .= 'DATE_FORMAT( payment_date, \'%b-%e\' ) AS date, ';
//		else
//			$query_Recordset1 .= '\'\' AS date, ';
//		if( $tr_config['don_show_amt'] )
			$query_Recordset1 .= 'CONCAT(\'$\',SUM(mc_gross)) AS amt ';
//		else
//			$query_Recordset1 .= '\'\' AS amt ';
	
		$query_Recordset1 .= ' FROM '.$prefix.'_don_transactions'
			. ' WHERE ( '.$prefix.'_don_transactions.payment_date < DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) AND '.$prefix.'_don_transactions.payment_date > DATE_FORMAT( SUBDATE( NOW( ) , INTERVAL ' . $swingd . ' '
			. ' DAY ) , \'%Y-%m-' . $swingd . '\' ) '
			. ' GROUP BY txn_id ORDER BY payment_date DESC';

}

$Recordset1 = $db->sql_query($query_Recordset1, $ipnppd) or die(mysql_error());
$totalRows_Recordset1 = $db->sql_numrows($Recordset1);

// Insert the appropriate column headers
if( $tr_config[don_show_amt] )
	$DON_AMT = "Amount";
else
	$DON_AMT = "";

if( $tr_config[don_show_date] )
	$DON_DATE = "Date";
else
	$DON_DATE = "";
	
$ROWS_DONATORS = "";
// Fill out the donators table tag
while ($row_Recordset1 = $db->sql_fetchrow($Recordset1)) 
{
	if( $row_Recordset1['amt'] > "$0" )
	{
		$ROWS_DONATORS .= "<tr>";
		$ROWS_DONATORS .= "<td align='left' height='1'><font color='#0000FF'>&nbsp; ";
		if( strcmp($row_Recordset1['showname'],"Yes") == 0)
			$ROWS_DONATORS .= $row_Recordset1['name'];
		else
			$ROWS_DONATORS .= "Anonymous";
		$ROWS_DONATORS .= "</font></td>";
		$ROWS_DONATORS .= "<td width='55' align='left' height='1'><font color='#0000FF'>&nbsp;&nbsp;";
		if( $tr_config[don_show_amt] )
			$ROWS_DONATORS .= $row_Recordset1['amt'];
		$ROWS_DONATORS .=  "</font></td>";
		$ROWS_DONATORS .= "<td align='left' height='1'><font color='#0000FF'>&nbsp;&nbsp;";
		if( $tr_config[don_show_date] )
			$ROWS_DONATORS .= $row_Recordset1['date'];
		$ROWS_DONATORS .= "</font></td>";
		$ROWS_DONATORS .= "</tr>";
	}
} ; 

// Fill out some more template tags
$DON_BUTTON_SUBMIT = $tr_config[don_button_submit];
$DON_BUTTON_TOP = $tr_config[don_button_top];
$USERNAME = $username;
$PP_NO_SHIP = $tr_config[pp_get_addr] ? "0" : "1" ;
$PP_IMAGE_URL = $tr_config[pp_image_url];
$DON_TOP_IMG_DIMS = '';
if( is_numeric($tr_config[don_top_img_width]) )
	$DON_TOP_IMG_DIMS .= "width=\"$tr_config[don_top_img_width]\" ";
if( is_numeric($tr_config[don_top_img_height]) )
	$DON_TOP_IMG_DIMS .= "height=\"$tr_config[don_top_img_height]\" ";
$DON_SUB_IMG_DIMS = '';
if( is_numeric($tr_config[don_sub_img_width]) )
	$DON_SUB_IMG_DIMS .= "width=\"$tr_config[don_sub_img_width]\" ";
if( is_numeric($tr_config[don_sub_img_height]) )
	$DON_SUB_IMG_DIMS .= "height=\"$tr_config[don_sub_img_height]\" ";

$sql = $sql = "SELECT * FROM ".$prefix."_don_config WHERE name = 'don_text'";
$Recordset = $db->sql_query($sql, $ipnppd) or die(mysql_error());
$row = $db->sql_fetchrow($Recordset);
$DON_TEXT = $row[text];

$sql = "SELECT * from ".$prefix."_don_config WHERE name='don_amount' ORDER BY subtype";
$Recordset1 = $db->sql_query($sql, $ipnppd) or die(mysql_error());

$DONATION_AMOUNTS = "";
while ($row_Recordset1 = $db->sql_fetchrow($Recordset1)) 
{
	if( is_numeric($row_Recordset1[value]) && $row_Recordset1[value] > 0 )
	{
		if( $row_Recordset1[subtype] == $tr_config[don_amt_checked] )
			$checked = "checked";
		else
			$checked = "";
			
		$DONATION_AMOUNTS .= '<input type="radio" name="amount" value="' 
						   . $row_Recordset1[value] . '." '
						   . $checked . ' > $' . $row_Recordset1[value] . '<br>' . "\n";
	}
}

// Ok, output the page
include_once("header.php");
OpenTable();

$tmpl_file = "modules/Donations/Donations.html";
$thefile = implode("", file($tmpl_file));
$thefile = addslashes($thefile);
$thefile = "\$r_file=\"".$thefile."\";";
eval($thefile);
print $r_file;

echo "<br><br>$dentry<br>";
CloseTable();

include_once("footer.php");

?>