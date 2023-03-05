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

if ( !defined('BLOCK_FILE') ) {

    Header("Location: ../index.php");

    die();

}
global $prefix, $db;

include_once("modules/Donations/config.php");

	$swingd = $tr_config[swing_day];
	if(!($swingd > 0 AND $swingd < 32))
		$swingd = 6;
	
	$dmshowdate = $tr_config[dm_show_date];
	$dmshowamt = $tr_config[dm_show_amt];
	$DM_TITLE = $tr_config[dm_title];
	
	if(!$DM_TITLE)
		$DM_TITLE = "Help keep us going!";
		
	if(is_numeric($tr_config[dm_num_don]) && $tr_config[dm_num_don] > 0 )
		$dmlen = $tr_config[dm_num_don];
	else if (is_numeric($dmlen) && $dmlen ==0)
		$dmlen = -1;
	else
		$dmlen = 10;
		
	// Check the current day against the swing day to execute the proper query
	if( date('d') >= $swingd )
	{
		$query_Recordset1 = ' SELECT business, COUNT( mc_gross ) AS count, SUM( mc_gross ) AS gross, SUM( mc_gross - mc_fee ) AS net, DATE_FORMAT( NOW( ) , \'%M\' ) AS mon, '
			. ' DATE_FORMAT( SUBDATE( DATE_FORMAT( ADDDATE( NOW( ) , INTERVAL 1 MONTH ) , \'%Y-%c-1\' ) , INTERVAL 1 DAY ) , \' %b %e\' ) AS due_by, '
			. ' DATE_FORMAT( NOW( ) , \'%b\' ) AS mon_short'
			. ' FROM '.$prefix.'_don_transactions'
			. ' WHERE ( '.$prefix.'_don_transactions.payment_date >= DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) '
			. ' GROUP BY business';
	
		$query_Recordset3 = 'SELECT custom AS name, option_selection1 as showname, ';
		$query_Recordset3 .= 'DATE_FORMAT( payment_date, \'%b-%e\' ) AS date, ';
		$query_Recordset3 .= 'CONCAT(\'$\',SUM(mc_gross)) AS amt ';
		$query_Recordset3 .= ' FROM '.$prefix.'_don_transactions'
			. ' WHERE ( '.$prefix.'_don_transactions.payment_date >= DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) '
			. ' GROUP BY txn_id ORDER BY payment_date DESC';
	} else
	{
		$query_Recordset1 = ' SELECT business, COUNT( mc_gross ) AS count, SUM( mc_gross ) AS gross, SUM( mc_gross - mc_fee ) AS net, DATE_FORMAT( SUBDATE( NOW( ) , INTERVAL ' . $swingd . ' '
			. ' DAY ) , \'%M\' ) AS mon, \'Now!\' AS due_by, DATE_FORMAT( SUBDATE( NOW( ) , INTERVAL ' . $swingd . ' '
			. ' DAY ) , \'%b\' ) AS mon_short'
			. ' FROM '.$prefix.'_don_transactions'
			. ' WHERE ( '.$prefix.'_don_transactions.payment_date < DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) AND '.$prefix.'_don_transactions.payment_date > DATE_FORMAT( SUBDATE( NOW( ) , INTERVAL ' . $swingd . ' '
			. ' DAY ) , \'%Y-%m-' . $swingd . '\' )'
			. ' GROUP BY business ';
	
		$query_Recordset3 = 'SELECT custom AS name, option_selection1 as showname, ';
		$query_Recordset3 .= 'DATE_FORMAT( payment_date, \'%b-%e\' ) AS date, ';
		$query_Recordset3 .= 'CONCAT(\'$\',SUM(mc_gross)) AS amt ';
		$query_Recordset3 .= ' FROM '.$prefix.'_don_transactions'
			. ' WHERE ( '.$prefix.'_don_transactions.payment_date < DATE_FORMAT( NOW( ) , \'%Y-%m-' . $swingd . '\' ) ) AND '.$prefix.'_don_transactions.payment_date > DATE_FORMAT( SUBDATE( NOW( ) , INTERVAL ' . $swingd . ' '
			. ' DAY ) , \'%Y-%m-' . $swingd . '\' ) '
			. ' GROUP BY txn_id ORDER BY payment_date DESC';
	}
	
	// Get the donation totals
	$Recordset1 = $db->sql_query($query_Recordset1) or die(mysql_error());
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	//If there are not records, then get "null" data
	if( !$row_Recordset1 )
	{
		$query_Recordset1 = ' SELECT \'\' AS business, \'0\' AS count, \'0\' AS gross, \'0\' AS net, DATE_FORMAT( NOW( ) , \'%M\' ) AS mon, DATE_FORMAT( SUBDATE( DATE_FORMAT( ADDDATE( NOW( ) , INTERVAL 1 '
			. ' MONTH ) , \'%Y-%c-1\' ) , INTERVAL 1 '
			. ' DAY ) , \' %b %e\' ) AS due_by, DATE_FORMAT( NOW( ) , \'%b\' ) AS mon_short';  
		$Recordset1 = $db->sql_query($query_Recordset1) or die(mysql_error());
		$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	}
	 
	// Get the goal
	$query_Recordset2 = $sql = 'SELECT * FROM '.$prefix.'_don_config WHERE name=\'goal\' AND subtype=\'' . $row_Recordset1['mon_short'] . '\'';
	$Recordset2= $db->sql_query($query_Recordset2) or die(mysql_error());
	$row_Recordset2 = $db->sql_fetchrow($Recordset2); 
	
	// Set our remaining template vars
	$DM_MON = $row_Recordset1[mon];
	$DM_GOAL = sprintf('$%.02f', $row_Recordset2['value']);
	$DM_DUE = $row_Recordset1['due_by'];
	$DM_NUM = $row_Recordset1['count'];
	$DM_GROSS = sprintf('$%.02f',$row_Recordset1['gross']);
	$DM_NET = sprintf('$%.02f',$row_Recordset1['net']);
	$DM_LEFT = sprintf('$%.02f', $row_Recordset2['value'] - $row_Recordset1['net']);
	$DM_BUTTON = $tr_config[dm_button];
	$DM_BUTT_DIMS = '';
	if( is_numeric($tr_config[dm_img_width]) )
	$DM_BUTT_DIMS .= "width=\"$tr_config[dm_img_width]\" ";
	if( is_numeric($tr_config[dm_img_height]) )
	$DM_BUTT_DIMS .= "height=\"$tr_config[dm_img_height]\" ";


      // Load the template
	$tmpl_file = "modules/Donations/Donatometer.html";
	$thefile = implode("", file($tmpl_file));
	$thefile = addslashes($thefile);
	$thefile = "\$r_file=\"".$thefile."\";";
	eval($thefile);
	$content = $r_file;

	// Do we want to display the donators? 
	if(is_numeric($dmlen) && $dmlen >= 0 )
	{
		// Get the list of donators
		$Recordset3= $db->sql_query($query_Recordset3) or die(mysql_error());
	
	      $content .= "<br /><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">"
		         . "<tr><td align=\"center\" colspan=\"2\"><u>Donations</u></td></tr>"
	               . "<tr><td>"
                     . "<div align=\"right\"><a href=\"javascript:openwindow5()\">&copy;</a></div></td></tr>";

		// List all the donators
		$l = 0;
		while ( ($row_Recordset3 = $db->sql_fetchrow($Recordset3)) && ($i != $tr_config[dm_num_don]) )
		{
			// Refunded transactions will show up with $0 amount
			if( $row_Recordset3['amt'] > "$0" )
			{
				// Observe the user's wish regarding revealing their name
				if( strcmp($row_Recordset3['showname'],"Yes") == 0)
					$name = $row_Recordset3['name'];
				else
					$name = "Anonymous";
				
				if( !$dmshowamt && !$dmshowdate )
					$dmalign = "center";
				else
					$dmalign = "left";
				$content .= "<tr><td width=\"100%\" align=\"$dmalign\" colspan=\"2\">";
				$content .=  $name;
				if( $dmshowamt )
					$content .= " $row_Recordset3[amt]";
				if( $dmshowdate )
					$content .= " $row_Recordset3[date]";
				$content .= "</td></tr>";
                         
			}
			$l++;

		}  
		$content .= "</table>";
}
	
?>