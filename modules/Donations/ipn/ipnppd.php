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
/************************************************************************/

/* NOTE: This file is accessed by PayPal directly, and not through PHP-Nuke */

$ipnCheck = 1;

//include donations config file
include_once("../config.php");

global $db, $prefix, $dbhost, $dbname, $dbuname, $dbpass;

$ERR = 0;
$log = "";
$loglvl = $tr_config[ipn_dbg_lvl];
define(_ERR, 1);
define(_INF, 2);

if( isset($_GET[dbg]) )
	$dbg = 1;
else
	$dbg = 0;

if( $dbg )
{
	dprt("Debug mode activated", _INF);
	echo "<br>PHP-Nuke Treasury mod<br><br>PayPal Instant Payment Notification script<br><br>See below for status:<br>";
	echo "----------------------------------------------------------------<br>";
	$receiver_email = $tr_config['receiver_email'];
}

//$ipnppd = $db->sql_query($dbhost, $dbuname, $dbpass) or die(mysqli_error());

if( $db )
	dprt("Connection to db - OK!", _INF);
else
	dprt("Connection to db - **FAILED**", _ERR);

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) 
{
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
//$header .= "Host: www.sandbox.paypal.com\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$txn_type = $_POST['txn_type'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];

dprt("Opening connection and validating request with PayPal...", _INF);

//$fp = fsockopen ('www.paypal.com', 443, $errno, $errstr, 30);
$paypalUrl = str_replace("https://", "", $paypalUrl);
$fp = fsockopen ($paypalUrl, 443, $errno, $errstr, 30);

if (!$fp) {
	// HTTP ERROR
	dprt("FAILED to connect to PayPal", _ERR);
	die();
}

dprt("OK!", _INF);

fputs ($fp, $header . $req);

// Perform PayPal email account verification
if( !$dbg && strcasecmp( $_POST['business'], $tr_config['receiver_email']) != 0)
{
	dprt("Incorrect receiver email: $receiver_email , aborting", _ERR) ;
	$ERR = 1;
}

$insertSQL = "";
// Look for duplicate txn_id's
if( $txn_id )
{
	$sql = "SELECT * FROM ".$prefix."_don_transactions WHERE txn_id = '$txn_id'";
	$Recordset1 = $db->sql_query($sql) or die(mysqli_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1); 
	$NumDups = mysql_num_rows($Recordset1);
}

while (!$dbg && !$ERR && !feof($fp)) 
{
	$res = fgets ($fp, 1024);
	if ((strcmp ($res, "VERIFIED") == 0) || (strcmp ($res, "verified") == 0))
	{
		dprt("PayPal Verified", _INF);
		// Ok, PayPal has told us we have a valid IPN here

		// Check for a reversal for a refund
		if( strcmp($payment_status, "Refunded") == 0)
		{
			// Verify the reversal
			dprt("Transaction is a Refund", _INF);
			if( ($NumDups == 0) || strcmp($row_Recordset1[payment_status], "Completed") || 
				(strcmp($row_Recordset1[txn_type], "web_accept") != 0 && strcmp($row_Recordset1[txn_type], "send_money") != 0) )
			{
				// This is an error.  A reversal implies a pre-existing completed transaction
				dprt("IPN Error: Received refund but missing prior completed transaction", _ERR);
				foreach( $_POST as $key => $val )
				{
					dprt("$key => $val", $_ERR);
				}
				break;
			}
			if( $NumDups != 1 )
			{
				dprt("IPN Error: Received refund but multiple prior txn_id's encountered, aborting", _ERR);
				foreach( $_POST as $key => $val )
				{
					dprt("$key => $val", $_ERR);
				}
				break;
			}
			
			// We flip the sign of these amount so refunds can be handled correctly
			$mc_gross = -$_POST['mc_gross'];
			$mc_fee = -$_POST['mc_fee'];
			$insertSQL = sprintf("INSERT INTO ".$prefix."_don_transactions (`txn_id`,`business`,`item_name`, `item_number`, `quantity`, `invoice`, `custom`, `memo`, `tax`, `option_name1`, `option_selection1`, `option_name2`, `option_selection2`, `payment_status`, `payment_date`, `txn_type`, `mc_gross`, `mc_fee`, `mc_currency`, `settle_amount`, `exchange_rate`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `address_status`, `payer_email`, `payer_status`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
				$_POST['txn_id'],$_POST['business'],$_POST['item_name'],$_POST['item_number'],$_POST['quantity'],$_POST['invoice'],$_POST['custom'],$_POST['memo'],$_POST['tax'],$_POST['option_name1'],$_POST['option_selection1'],$_POST['option_name2'],$_POST['option_selection2'],$_POST['payment_status'],strftime('%Y-%m-%d %H:%M:%S',strtotime($_POST['payment_date'])),$_POST['txn_type'],$mc_gross,$mc_fee,$_POST['mc_currency'],$_POST['settle_amount'],$_POST['exchange_rate'],$_POST['first_name'],$_POST['last_name'],$_POST['address_street'],$_POST['address_city'],$_POST['address_state'],$_POST['address_zip'],$_POST['address_country'],$_POST['address_status'],$_POST['payer_email'],$_POST['payer_status']);

			// We're cleared to add this record
			dprt($insertSQL, _INF);
			$Result1 = $db->sql_query($insertSQL) or die(mysqli_error());
			dprt("SQL result = " . $Result1, _INF);
	
			break;
		} else // Look for anormal payment
		if( (strcmp($payment_status, "Completed") == 0) && ((strcmp($txn_type, "web_accept")== 0) || (strcmp($txn_type, "send_money")== 0)) )
		{
			dprt("Normal transaction", _INF);
			if( $lp ) fputs($lp, $payer_email . " " . $payment_status . " " . $_POST['payment_date'] . "\n");

			// Check for a duplicate txn_id
			if( $NumDups != 0 )
			{
				dprt("Valid IPN, but DUPLICATE txn_id! aborting", _ERR);
				foreach( $_POST as $key => $val )
				{
					dprt("$key => $val", $_ERR);
				}
				break;
			}
			
			$insertSQL = sprintf("INSERT INTO ".$prefix."_don_transactions (`txn_id`,`business`,`item_name`, `item_number`, `quantity`, `invoice`, `custom`, `memo`, `tax`, `option_name1`, `option_selection1`, `option_name2`, `option_selection2`, `payment_status`, `payment_date`, `txn_type`, `mc_gross`, `mc_fee`, `mc_currency`, `settle_amount`, `exchange_rate`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `address_status`, `payer_email`, `payer_status`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
				$_POST['txn_id'],$_POST['business'],$_POST['item_name'],$_POST['item_number'],$_POST['quantity'],$_POST['invoice'],$_POST['custom'],$_POST['memo'],$_POST['tax'],$_POST['option_name1'],$_POST['option_selection1'],$_POST['option_name2'],$_POST['option_selection2'],$_POST['payment_status'],strftime('%Y-%m-%d %H:%M:%S',strtotime($_POST['payment_date'])),$_POST['txn_type'],$_POST['mc_gross'],$_POST['mc_fee'],$_POST['mc_currency'],$_POST['settle_amount'],$_POST['exchange_rate'],$_POST['first_name'],$_POST['last_name'],$_POST['address_street'],$_POST['address_city'],$_POST['address_state'],$_POST['address_zip'],$_POST['address_country'],$_POST['address_status'],$_POST['payer_email'],$_POST['payer_status']);

			// We're cleared to add this record
			dprt($insertSQL, _INF);
			$Result1 = $db->sql_query($insertSQL) or die(mysqli_error());
			dprt("SQL result = " . $Result1, _INF);

			break;
		} else // We're not interested in this transaction, so we're done
		{
			dprt("Valid IPN, but not interested in this transaction", _ERR);
			foreach( $_POST as $key => $val )
			{
				dprt("$key => $val", $_ERR);
			}
			break;
		}
	}
	else if ((strcmp ($res, "INVALID") == 0) || (strcmp ($res, "invalid") == 0))
	{
		// log for manual investigation
		dprt("Invalid IPN transaction, this is an abnormal condition", _ERR);
		foreach( $_POST as $key => $val )
		{
			dprt("$key => $val", $_ERR);
		}
		break;
	}
}

if( $dbg )
{
	global $db, $prefix;
	$sql = "SELECT * FROM ".$prefix."_don_transactions LIMIT 10";
//	echo "Selecting database...";
//	$res = $db->sql_query($dbname);
//	if($res)
//		echo "OK!<br>"; 
//	 else
//		echo "<b>FAILED - err: $res</b><br>";
	echo "Executing test query...";
	$Result1 = $db->sql_query($sql) or die(mysqli_error());
	if($Result1)
		echo "PASSED!<br>";
	else
		echo "<b>FAILED</b><br>";
	echo "PayPal Receiver Email: $tr_config[receiver_email]<br>" ;
}

if( $log )
{
	global $db, $prefix;
	dprt("Logging events<br>\n", _INF);
	// Insert the log entry
	$sql = "INSERT INTO ".$prefix."_don_translog VALUES ('','" . strftime('%Y-%m-%d %H:%M:%S', time()) . "', '" 
		 . strftime('%Y-%m-%d %H:%M:%S',strtotime($_POST['payment_date'])) . "','" . addslashes($log) . "')";
	$Result1 = $db->sql_query($sql) or die(mysqli_error());

	// Clear out old log entries
	$sql = "SELECT id as lowid FROM ".$prefix."_don_translog ORDER BY id DESC LIMIT " . $tr_config[ipn_log_entries];
	$Result1 = $db->sql_query($sql) or die(mysqli_error());
	while($recordSet = $db->sql_fetchrow($Result1))
	{
		$lowid = $recordSet[lowid];
	}
	$sql =  "DELETE FROM ".$prefix."_don_translog WHERE id < '" . $lowid . "'";
	$Result1 = $db->sql_query($sql) or die(mysqli_error());
}

fclose ($fp);
if( $lp ) fputs($lp,"Exiting\n");
if( $lp ) fclose ($lp);

if( $dbg)
{
	echo "<br>----------------------------------------------------------------<br>";
	echo "If you don't see any error messages, you should be good to go!<br>";
}
	
function dprt($str, $clvl)
{
	global $dbg, $lp, $log, $loglvl;

	if( $lp ) fputs($lp, $str . "\n");
	if( $dbg ) echo $str . "<br>";
	if( $clvl <= $loglvl )
		$log .= $str . "\n";
}


?>